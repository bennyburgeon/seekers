<?php 
class Interviewstatus extends CI_Controller {

	function interviewstatus()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	}
	
	function index()
	{	$this->load->library('pagination');
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
		$this->load->model('interviewstatusmodel');
		
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
		$this->data['total_rows']= $this->interviewstatusmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/interviewstatus/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->interviewstatusmodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Interview Status';
				
				
		$this->load->view('include/header');
		$this->load->view('interviewstatus/list',$this->data);				
		$this->load->view('include/footer');

		
	}	

	
	
	
	function add()
	{	
		$this->data['formdata']=array(
		'int_status_name'=> ''
		);
		
		$this->data['page_head']= 'Add Interview Status';
		$this->load->model('interviewstatusmodel');
		
		if($this->input->post('int_status_name'))
		{
			$this->form_validation->set_rules('int_status_name', 'Interview Status Name', 'required');
			$this->form_validation->set_rules('int_status_name_dup', 'Interview Status Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->interviewstatusmodel->insert_record();
				redirect('interviewstatus/?ins=1&id='.$id);
			}
				// load page again for validation
				$this->data['formdata']=array(
				'int_status_name'=>$this->input->post('int_status_name'),
				);
		}

		$this->load->view('include/header');
		$this->load->view('interviewstatus/add',$this->data);				
		$this->load->view('include/footer');
		
	}

	// edxit and update pages here 	
	
	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->data['page_head']= 'Edit Interview Status';			
			$this->db->where('int_status_id', $id);
			$query=$this->db->get('pms_candidate_interview_status');
			$this->data['formdata']=$query->row_array();			

			$this->load->view('include/header');
			$this->load->view('interviewstatus/edit',$this->data);				
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
	
	$id = $this->input->post('int_status_id'); 
	$this->data['page_head']= 'Edit Interview Status';
			if($this->input->post('int_status_name'))
			{ 
				$this->form_validation->set_rules('int_status_name', 'Interview Status Name', 'required');
				$this->form_validation->set_rules('int_status_name_dup', 'Interview Status Name', 'callback_check_dups');
				
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('interviewstatusmodel');
						$id=$this->interviewstatusmodel->update_record($id);
						redirect('interviewstatus/?update=1');
					}else{
						// load page again for validation
						$this->data['formdata']=array(
						'int_status_id'=>$id,
						'int_status_name'=>$this->input->post('int_status_name'),
						);
	
						$this->load->view('include/header');
						$this->load->view('interviewstatus/edit',$this->data);				
						$this->load->view('include/footer');
					}
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
			$this->db->where('int_status_id', $id);
			$this->db->delete('pms_candidate_interview_status'); 
			redirect('interviewstatus/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('int_status_id', $val);
					$this->db->delete('pms_candidate_interview_status'); 
				}
			redirect('interviewstatus/?rows='.$rows.'&del=1');
		}
	}
	function check_dups()
	{
	
		$this->db->where('int_status_name', $this->input->post('int_status_name'));
		if($this->input->post('int_status_id') > 0)	$this->db->where('int_status_id !=', $this->input->post('int_status_id'));
		$query = $this->db->get('pms_candidate_interview_status');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'That name already used.');
			return false;
		}
	}

}
?>
