<?php 
class Tasksmodule extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
	}

	
	function index($offset = 0)
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
		$this->load->model('tasksmodulemodel');
		
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
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}

		$this->data['total_rows']= $this->tasksmodulemodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."tasksmodule/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		
		// paging ends here
		$this->data["records"] = $this->tasksmodulemodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
	
		$this->load->model('tasksmodulemodel');
		$this->data['page_head']= 'Manage Task Module';
		$config['base_url'] = base_url().'tasksmodule/?';
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header');
		$this->load->view('tasks/module',$this->data);				
		$this->load->view('include/footer');
	}	

	function add()
	{	
		$this->data['formdata']=array(
		'task_module_id'=> '',
		'task_module_name'=> '',
		'status'=> ''
		
		);
		
		$this->load->model('tasksmodulemodel');		
		//$this->data["parent_list"] = $this->categorymodel->parent_list();
		
		$this->data["leadfolder_list"] = $this->tasksmodulemodel->leadfolder_array();
		
		
		if($this->input->post('task_module_name'))
		{
			$this->form_validation->set_rules('task_module_name', 'Source Name', 'required');
			$this->form_validation->set_rules('check_dups', 'Source Name', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->tasksmodulemodel->insert_record();
				redirect('tasksmodule/?ins=1');
			}
				$this->data['formdata']=array(
				'task_module_id'=> $this->input->post('task_module_id'),
				'task_module_name'=> $this->input->post('task_module_name'),
				'status' =>    $this->input->post('active')
				
				);				
		}
				$this->data['page_head']= 'Add Task';
				
				$this->load->view('include/header');
				$this->load->view('tasks/addmodule',$this->data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$data['site_url']=$this->config->item('site_url');
		
		$data['formdata']=array(
		'task_module_id'=> '',
		'task_module_name'  => '',
		'status'=> ''
		);
		
		if(!empty($id))
		{
			$this->load->model('tasksmodulemodel');	
			
			$data["leadfolder_list"] = $this->tasksmodulemodel->leadfolder_array($id);
		
			$data['page_head']= 'Edit Task';
			
			$query=$this->db->query("SELECT * FROM pms_task_module where task_module_id =".$id);
			$data['formdata']=$query->row_array();			
			
			$this->load->view('include/header');
			$this->load->view('tasks/editmodule',$data);	
			$this->load->view('include/footer');
		}
		{
			//redirect('categories');	
		}
	}

	function changestat($id=null)
	{
		if($id=='')redirect('tasksmodule');
		if($this->input->get('stat')=='')redirect('tasksmodule');
		$this->db->query("update pms_task_module set status=".$this->input->get('stat')." where task_module_id =".$id);
		redirect('tasksmodule?stat=1');

	}

	function update($id=null)
	{
		$data['page_head']= 'Edit Task';
		$this->load->model('tasksmodulemodel');
		
			if($this->input->post('task_module_id'))
			{

				//$data["parent_list"] = $this->leadfoldermodel->parent_list();	
		
				$this->form_validation->set_rules('task_module_id', 'Source Name', 'required');
				$this->form_validation->set_rules('check_dups', 'Source Name', 'callback_check_dups');
				
				if ($this->form_validation->run() == TRUE)
				{
					$id=$this->tasksmodulemodel->update_record($id);
					redirect('tasksmodule/?update=1');
				}
				
			$query=$this->db->query("SELECT * FROM pms_task_module where task_module_id =".$this->input->post("task_module_id"));
			$data['formdata']=$query->row_array();	
				$this->load->view('include/header');
				$this->load->view('tasks/editmodule',$data);	
				$this->load->view('include/footer');					
			}else
			{
				redirect('tasksmodule');
			}			
	}

	function check_dups()
	{
		$this->db->where('task_module_name', $this->input->post('task_module_name'));
		if($this->input->post('task_module_id') > 0)	$this->db->where('task_module_id  !=', $this->input->post('task_module_id'));
		$query = $this->db->get('pms_task_module');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Task name already used, pelase change');
			return false;
		}
	}	

	function delete($id=null)
	{
		$this->load->model('tasksmodulemodel');
		$error_msg=true;
		if(!empty($id))
		{
			$del_status=$this->tasksmodulemodel->delete($id);

			/*if($del_status==true)
				$_SESSION['del_error']='Task deleted successfully.';
			else
				$_SESSION['del_error']='Cannot delete '.$del_status.', Lead Folder used in products. Delete products under this category.';*/
				
			redirect('tasksmodule/?del=1');
			
		}elseif(is_array($this->input->post('delete_rec')))
		{
			$_SESSION['del_error']=array();
			
			foreach ($this->input->post('delete_rec') as $key => $val)
			{
				//$del_status=true;
				$del_status=$this->tasksmodulemodel->delete($val);
				//if($del_status==false)$_SESSION['del_error'][]=$del_status;
			}
			
			/*if($del_status==true && count($_SESSION['del_error'])==0)
				$_SESSION['del_error']='Task deleted successfully.';
			else
				$_SESSION['del_error'].='Cannot delete '.implode(',',$_SESSION['del_error']).'. Delete products under this category.';*/				
				
			redirect('tasksmodule/?del=1');
		}else
		{
			redirect('tasksmodule');
		}
	}
	
	function multidelete(){
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
			$this->load->model('tasksmodulemodel');
			$this->tasksmodulemodel->delete_multiple_record($id_arr);
			redirect('tasksmodule/?multi=1');
		}
		else{
			redirect('tasksmodule');
		}
	}
}
?>