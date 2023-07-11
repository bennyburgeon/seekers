<?php 
class Opportunity extends CI_Controller {

	function Opportunity()
	{
		parent::__construct();
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		
	}
	
	
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
		$this->load->model('opportunitymodel');
		
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
		$this->data['total_rows']= $this->opportunitymodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/opportunity/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->opportunitymodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Opportunity';
				
				
		$this->load->view('include/header');
		$this->load->view('opportunity/list',$this->data);				
		$this->load->view('include/footer');

		
	}	

	function add()
	{	
		$data['formdata']=array(
		'opp_name'=> '',
		//'status'=> ''
		);
		$data['page_head']= 'Add Opportunity';
		$this->load->model('opportunitymodel');
		if($this->input->post('opp_name'))
		{
			$this->form_validation->set_rules('opp_name', 'Opportunity Type Name', 'required');
			$this->form_validation->set_rules('con_grp_name_dup', 'Opportunity Type Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				
				$id=$this->opportunitymodel->insert_record();
				redirect('opportunity/?ins=1&id='.$id);
			}
				// load page again for validation
				$data['formdata']=array(
				'opp_name'=>$this->input->post('opp_name'),
				//'status'=>$this->input->post('status')
				);
		}
				$this->load->view('include/header');
				$this->load->view('opportunity/add',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$data['page_head']= 'Edit Opportunity';
			$this->db->where('opp_id', $id);
			$query=$this->db->get('pms_opportunity');
			$data['formdata']=$query->row_array();			
			$this->load->view('include/header');
			$this->load->view('opportunity/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$id = $this->input->post('opp_id'); 
		$data['page_head']= 'Edit Opportunity';
			if($this->input->post('opp_name'))
			{
				$this->form_validation->set_rules('opp_name', 'Opportunity Name', 'required');
				$this->form_validation->set_rules('con_grp_name_dup', 'Opportunity Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('opportunitymodel');
						$id=$this->opportunitymodel->update_record($id);
						redirect('opportunity/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'opp_id'=>$id,
						'opp_name'=>$this->input->post('opp_name'),
						//'status'=>$this->input->post('status')
						);
						$this->load->view('include/header');
						$this->load->view('opportunity/edit',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('opportunity');
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
			$this->db->where('opp_id', $id);
			$this->db->delete('pms_opportunity'); 
			redirect('opportunity/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('opp_id', $val);
					$this->db->delete('pms_opportunity'); 
				}
			redirect('opportunity/?rows='.$rows.'&del=1');
		}
	}
	function check_dups()
	{
		$this->db->where('opp_name', $this->input->post('opp_name'));
		if($this->input->post('opp_id') > 0)	$this->db->where('opp_id !=', $this->input->post('opp_id'));
		$query = $this->db->get('pms_opportunity');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'That name already used.');
			return false;
		}
	}

}
?>
