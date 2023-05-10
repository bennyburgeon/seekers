<?php 
class Availability extends CI_Controller {

	function availability()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	}
	
	/*function index($offset = 0)
	{
		$this->load->model('availabilitymodel');
		
		$this->data['total_rows']= $this->availabilitymodel->record_count();
		$this->data['page_head']= 'Manage Availability';
		
		$config['base_url'] = base_url().'index.php/availability/?';
		$config['total_rows'] = $this->data['total_rows'];		
		$this->pagination->initialize($config);
		
		if($this->input->get('per_page') > 0) $offset=$this->input->get('per_page');
		
		//$this->db->limit();
		$this->data['records']=$this->availabilitymodel->get_list($this->pagination->per_page,$offset);

  	    $this->data['pagination'] = $this->pagination->create_links();

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('common/header');
		$this->load->view('availability/listavailability',$this->data);				
		$this->load->view('common/footer');		
	}	*/
	
	function index()
	{	
		$this->load->library('pagination');
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=5;
		}
		$rows='';
		$this->load->model('availabilitymodel');
		
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
		$sort_by=$this->input->get("sort_by");
		}
		else
		{
		$sort_by = 'asc';
		}
		if($this->input->get("rows")!='')
		{
		$start=$this->input->get("rows");
		}
		if($this->input->get("rows")!='')
		{
		$rows=$this->input->get("rows");
		}
		
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->availabilitymodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/availability/?sort_by=$sort_by&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
		$config['num_links'] = $this->data['total_rows'];
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['full_tag_close'] = '</ul></div>';
		$this->pagination->initialize($config);
		$this->data['pagination']=$this->pagination->create_links();
		$this->data["records"] = $this->availabilitymodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Availability';
				
				
		$this->load->view('include/header');
		$this->load->view('availability/listavailability',$this->data);				
		$this->load->view('include/footer');

		
	}	

	function add()
	{	
		$data['formdata']=array(
		'avail_days'=> '',
		'avail_name'=> ''
		);
		$this->load->model('availabilitymodel');		
		if($this->input->post('avail_name'))
		{
			$this->form_validation->set_rules('avail_name', 'Availability', 'required');
			$this->form_validation->set_rules('avail_name_dup', 'Availability', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->availabilitymodel->insert_record();
				redirect('availability/?ins=1&id='.$id);
			}
				// load page again for validation
				$data['formdata']=array(
				'avail_days'=>$this->input->post('avail_days'),
				'avail_name'=>$this->input->post('avail_name')
				);
		}
				$this->data['page_head']= 'Add Availability';
				$this->load->view('include/header');
				$this->load->view('availability/addavailability',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('availabilitymodel');

			$data['page_head']= 'Edit Availability';
			$this->db->where('avail_id', $id);
			$query=$this->db->get('pms_avail_to_join');
			$data['formdata']=$query->row_array();

			$this->load->view('include/header');
			$this->load->view('availability/editavailability',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$id = $this->input->post('avail_id');
		$data['page_head']= 'Edit Availability';
		$this->load->model('availabilitymodel');
		if(!empty($id))
		{
			if($this->input->post('avail_name'))
			{
				
				$this->form_validation->set_rules('avail_name', 'Availability Name', 'required');
				$this->form_validation->set_rules('avail_name_dup', 'Availability Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->availabilitymodel->update_record($id);
						redirect('availability/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'avail_id'=>$id,
						'avail_days'=>$this->input->post('avail_days'),
						'avail_name'=>$this->input->post('avail_name')
						);
						
						$this->load->view('include/header');
						$this->load->view('availability/editavailability',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('availability');
			}			
		}else
		{
			redirect('availability');
		}
	}
	
	function delete($id=null)
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		if(!empty($id))
		{
			$this->db->where('avail_id', $id);
			$this->db->delete('pms_avail_to_join'); 
			redirect('availability/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
				
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('avail_id', $val);
					$this->db->delete('pms_avail_to_join'); 
				}
			redirect('availability/?rows='.$rows.'&del=1');
		}
	}
	function check_dups()
	{
		$this->db->where('avail_name', $this->input->post('avail_name'));
		if($this->input->post('avail_id') > 0)	$this->db->where('avail_id !=', $this->input->post('avail_id'));
		$query = $this->db->get('pms_avail_to_join');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Name already used.');
			return false;
		}
	}
}
?>
