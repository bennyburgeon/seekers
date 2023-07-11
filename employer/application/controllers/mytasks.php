<?php
class Mytasks extends CI_controller{
	
	function Mytasks()
	{
	  parent::__construct();	
	  if(!isset($_SESSION['company_session']) || $_SESSION['company_session']=='')redirect('logout');
	  $this->data['cur_page']=$this->router->class;
	  $this->load->model("mytasksmodel");
	  date_default_timezone_set('Asia/Calcutta');
	}
	
	function editor($path,$width) 
	{
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
   }
   
	function index($offset = 0)
	{
		$this->load->library('pagination');
		$this->data['searchterm']='';
		$this->data['date_range']=4;
		$this->data['priority']=0;
		$this->data['status']=0;		
		$start=0;
		
		if(isset($_GET['limit']))
		{
			if($_GET['limit']!='')$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=15;
		 }
		
		$rows='';
		
		if($this->input->get('sort_by')!='')
		{
			$sort_by=$this->input->get("sort_by");
		}
		else
		{
			$sort_by = 'desc';
		}
		
		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		
		if($this->input->get("date_range")!='')
		{
			$this->data['date_range']= $this->input->get("date_range");
		}

		if($this->input->post("date_range")!='')
		{
			$this->data['date_range']= $this->input->post("date_range");
		}
		
		if(isset($_GET['searchterm']))
		{
			if($_GET['searchterm']!='')
			$this->data['searchterm']= $_GET['searchterm'];
		}

		if($this->input->get("status")!='')
		{
			$this->data['status']= $this->input->get("status");
		}
		if($this->input->post("status")!='')
		{
			$this->data['status']= $this->input->post("status");
		}

		if($this->input->get("priority")!='')
		{
			$this->data['priority']= $this->input->get("priority");
		}
		
		if($this->input->post("priority")!='')
		{
			$this->data['priority']= $this->input->post("priority");
		}
		
		$this->data['total_rows']= $this->mytasksmodel->record_count($this->data['searchterm'],$this->data['date_range'],$this->data['priority'],$this->data['status']);
	
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."mytasks/?date_range=".$this->data["date_range"]."&sort_by=$sort_by&limit=$limit&searchterm=".$this->data["searchterm"]."&$query_str&priority=".$this->data["priority"]."&status=".$this->data["status"];
		
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
		
		$this->data["page_head"]= "Manage Tasks";
		// paging ends here
		$this->data["records"] = $this->mytasksmodel->get_list($start,$limit,$this->data["searchterm"],$sort_by,$this->data['date_range'],$this->data['priority'],$this->data['status']);

		$this->data['admin_users_lists']= $this->mytasksmodel->get_candidate_list();

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
			
		$this->load->view("include/header",$this->data);
		$this->load->view("mytasks/list",$this->data);
		$this->load->view("include/footer",$this->data);

	}
	
	function add()
	{
		
				
		$this->data["page_head"]= "Add Task ";
		
		$this->data["formdata"] = array(
				"task_title" => "",
				"candidate_id" => "",
				"start_date" =>"",
				"due_date" =>"",
				"project_folder_id" =>"",
				"task_module_id" => "",
				"task_priority_id"=>  "",
				"task_status_id" => "",
				"unbillable_hrs" => "",
				"billable_hrs" =>"",
				"actual_hrs" => "",
				"task_desc" => "",
				"admin_id" =>"",
				"status" => ""				
				);
	
		
		if($this->input->post("task_title")){
			
		$this->form_validation->set_rules("task_title","Task Title","required");
		//$this->form_validation->set_rules('check_dups', 'Title', 'callback_check_dups');

		
		if ($this->form_validation->run() == TRUE)
			{
		
				$id = $this->mytasksmodel->insert_record();
				redirect('mytasks/?ins=1');
			}
			
			
		$this->data["formdata"] = array(
				"task_title" => $this->input->post("task_title"),
				"candidate_id" => $this->input->post("candidate_id"),
				"start_date" =>$this->input->post("start_date"),
				"due_date" =>$this->input->post("due_date"),
				"project_folder_id" => $this->input->post("project_folder_id"),
				"admin_id" => $this->input->post("admin_id"),
				"task_module_id" => $this->input->post("task_module_id"),
				"task_priority_id"=>  $this->input->post("task_priority_id"),
				"task_status_id" => $this->input->post("task_status_id"),
				"unbillable_hrs" => $this->input->post("unbillable_hrs"),
				"billable_hrs" => $this->input->post("billable_hrs"),
				"actual_hrs" => $this->input->post("actual_hrs"),
				"task_desc" => $this->input->post("task_desc"),
				"status" => $this->input->post("status")
				
				);
		}
		
		$this->data["task_module_list"]=$this->mytasksmodel->task_module_ddl();
		$this->data["task_priority_list"]=$this->mytasksmodel->task_priority_ddl();
		$this->data["task_status_list"]=$this->mytasksmodel->task_status_ddl();
		$this->data["admin_list"]=$this->mytasksmodel->admin_list();
		$this->data['admin_users_lists']= $this->mytasksmodel->get_candidate_list();
			
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);	

		
		$this->load->view("include/header",$this->data);
		$this->load->view("mytasks/add",$this->data);
		$this->load->view("include/footer",$this->data);
		
	}
	
	function edit($id='')
	{
		$this->data["page_head"]= "Edit Task ";
		
		$this->data["formdata"] = array(
				"task_title" => "",
				"candidate_id" => "",
				"start_date" =>"",
				"due_date" =>"",
				"project_folder_id" =>"",
				"task_module_id" => "",
				"task_priority_id"=>  "",
				"task_status_id" => "",
				"unbillable_hrs" => "",
				"billable_hrs" =>"",
				"actual_hrs" => "",
				"task_desc" => "",
				"admin_id" =>"",
				"status" => ""
				
				);
		
		
		if(!empty($id))
		{
			$this->data["formdata"] = $this->mytasksmodel->get_task($id);
			}
		
		$this->data["task_module_list"]=$this->mytasksmodel->task_module_ddl();
		$this->data["task_priority_list"]=$this->mytasksmodel->task_priority_ddl();
		$this->data["task_status_list"]=$this->mytasksmodel->task_status_ddl();
		$this->data["admin_list"]=$this->mytasksmodel->admin_list();
		$this->data['admin_users_lists']= $this->mytasksmodel->get_candidate_list();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);	

		$this->load->view("include/header",$this->data);
		$this->load->view("mytasks/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function update()
	{
		$id=$this->input->post('task_id');
		if($this->input->post("task_title")){
			
		$this->form_validation->set_rules("task_title","Task Title","required");
		//$this->form_validation->set_rules('check_ups', 'Title', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 			
				$this->mytasksmodel->update_record();
				redirect('mytasks/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
				"task_id" => $this->input->post("task_id"),
				"candidate_id" => $this->input->post("candidate_id"),
				"task_title" => $this->input->post("task_title"),
				"start_date" => date("Y-m-d ",strtotime($this->input->post("start_date"))),
				"due_date" =>date("Y-m-d ",strtotime($this->input->post("due_date"))),
				"project_folder_id" => $this->input->post("project_folder_id"),
				"admin_id" => $this->input->post("admin_id"),
				"task_module_id" => $this->input->post("task_module_id"),
				"task_priority_id"=>  $this->input->post("task_priority_id"),
				"task_status_id" => $this->input->post("task_status_id"),
				"unbillable_hrs" => $this->input->post("unbillable_hrs"),
				"billable_hrs" => $this->input->post("billable_hrs"),
				"actual_hrs" => $this->input->post("actual_hrs"),
				"task_desc" => $this->input->post("task_desc"),
				"status" => $this->input->post("status")				
				);
				
			
				$this->data["predecessor_list"]=$this->mytasksmodel->tasks_ddl1($id);
				$this->data["successor_list"]=$this->mytasksmodel->tasks_ddl1($id);
				$this->data["task_module_list"]=$this->mytasksmodel->task_module_ddl();
				$this->data["task_priority_list"]=$this->mytasksmodel->task_priority_ddl();
				$this->data["task_status_list"]=$this->mytasksmodel->task_status_ddl();
				$this->data["admin_list"]=$this->mytasksmodel->admin_list();
				$this->data['admin_users_lists']= $this->mytasksmodel->get_candidate_list();
				
				$this->data["page_head"]= "Edit Task ";
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);	
				$this->load->view("include/header",$this->data);
				$this->load->view("mytasks/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function followup($id)
	{
		$this->load->model('projectsmodel');
		$this->load->model('mytasksmodel');
		$this->load->model('adminmodel');
		$this->data['admin_users_lists']= $this->mytasksmodel->get_candidate_list();

		$this->data['task_details']=$this->mytasksmodel->get_task($id);

		$this->data["task_status_list"]=$this->mytasksmodel->task_status_ddl();
		$this->data["task_priority_list"]=$this->mytasksmodel->task_priority_ddl();
		$this->data["followup_list"] = $this->mytasksmodel->get_followup_list($id);

		$this->load->view('include/header',$this->data);
		$this->load->view('mytasks/followup',$this->data);				
		$this->load->view('include/footer',$this->data);	
	}
	
	function addfllowup($id='')
	{
		$this->load->model('projectsmodel');
		$this->load->model('mytasksmodel');
		$this->load->model('adminmodel');
		$task_id = $id;
		
		if(isset($_POST['title']) && $id!='')
		{

			$data=array(
				'task_id'=> $id,
				'task_fl_desc' => $_POST['description'],
				'task_fl_title' => $_POST['title'],
				'task_status' => $_POST['task_status_id'],
				'task_priority' => $_POST['task_priority_id'],
				'task_fl_date'  => date("Y-m-d", strtotime($_POST['date']))
				);
				$this->db->insert('pms_task_followup', $data);	
				$flp_id=$this->db->insert_id();

				// update task priority and status
					$data=array(
					'task_status_id' => $_POST['task_status_id'],
					'task_priority_id' => $_POST['task_priority_id'],
					);
				$this->db->where('task_id', $id);
	  			 $this->db->update('pms_tasks', $data);
				// end here 
				
				// update task due date
				if($_POST['due_date']!='')
				 {
				// update task priority and status
					$data=array(
					'due_date' => $_POST['due_date'],
					);
					$this->db->where('task_id', $id);
	  			 	$this->db->update('pms_tasks', $data);
				 }
				//end up here				
				
				// update candidate follow up  start here.
				if($_POST['candidate_id']!='')
				{
					$data=array(
					'candidate_id'   =>$_POST['candidate_id'],
					'title'          =>$_POST['title'],
					'description'    =>$_POST['description'],
					'flp_date'       => date('Y-m-d h:m:s A')
					);
					$this->db->insert('pms_candidate_followup', $data);	
				}
				// end here 

				$this->load->model('mytasksmodel');
				$this->data['followup_list']=$this->mytasksmodel->select_record($flp_id);

				$dataArr = $this->load->view('mytasks/taskfollowup_list', $this->data,TRUE);
				echo $dataArr;
			}else{
				
				redirect('mytasks');

			}				
			
	}
	
	function delfllowup(){
		  $_POST['task_fl_id'];
		$this->load->model('mytasksmodel');
		if(isset($_POST['task_fl_id']))		
		{			
			$this->db->where('task_fl_id', $_POST['task_fl_id']);
			$this->db->delete('pms_task_followup'); 
		}else
		{
			redirect('mytasks');
		}
	}
	function updatefllowup(){
		$this->load->model('projectsmodel');
		if(isset($_POST['task_fl_id']))		
		{			
			$data= $this->mytasksmodel->get_tasks_followup($_POST['task_fl_id']);
			$data['success'] = 'true';
			
		}else
		{
			$data=array('success' => 'false');
		}
		echo json_encode($data);
	}
	function add_followup()
	{
		
		$this->form_validation->set_rules("task_fl_title","Followup Title","required");
		$this->form_validation->set_rules("task_fl_desc","Followup Description","required");
			
		if ($this->form_validation->run() == TRUE)
			{ 			
				$this->mytasksmodel->insert_followup();
				redirect('mytasks/followup/'.$this->input->post("task_id").'?ins=1');
			}
		else{
			redirect('mytasks/followup/'.$this->input->post("task_id").'?err=1');
		}
			
	}
	
	function update_followup()
	{
		$this->form_validation->set_rules("task_fl_title","Followup Title","required");
		$this->form_validation->set_rules("task_fl_desc","Followup Description","required");
		
		if ($this->form_validation->run() == TRUE)
			{ 	
				$this->mytasksmodel->update_followup();
				redirect('mytasks/followup/'.$this->input->post("task_id").'?upd=1');
			}
		else
		{
			redirect('mytasks/followup/'.$this->input->post("task_id").'?edit=1&fid='.$this->input->post("fid").'&err=1');
		}
	}
	
	function delete_followup()
	{
		if($this->input->post("id")){
			$this->mytasksmodel->delete_followup($this->input->post("id"));
		}
		
	}
	
		
	function toggle_status()
	{
		if($this->input->post("id")){
			
			$this->mytasksmodel->toggle_status();
			}
	}
	
	function files($id)
	{
		$this->data["records"] = $this->mytasksmodel->files_list($id);
		$this->data["page_head"]= "Manage Files";
		$this->data["tskid"] = $id;
		
		$this->load->view("common/header",$this->data);
		$this->data['left_nav']=$this->load->view('common/leftmenu',$this->data,true);	
		$this->load->view("mytasks/listfile",$this->data);
		$this->load->view("common/footer",$this->data);
	}
	
	function addfile()
	{
		if($this->input->post('file_title'))
		{
			$this->form_validation->set_rules('file_title', 'File Title', 'required');
			$this->form_validation->set_rules('task_id', 'Task details', 'required');
			$this->form_validation->set_rules('check_file_dups', 'File Name', 'callback_check_file_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				$this->mytasksmodel->insert_file();
				redirect('mytasks/files/'.$this->input->get("tsk"));
			}
			
		}
		
		$this->data["formdata"] = array(
				"file_id" => $this->input->post("file_id"),
				"task_id" => $this->input->post("task_id"),
				"file_title" => $this->input->post("file_title"),
				"file_path" => $this->input->post("file_path"),
				"file_desc" => $this->input->post("file_desc"),
				"status" => $this->input->post("status")
				);
		$this->data["tskid"] = $this->input->get("tsk");
		
		$this->data["task_team_list"]=$this->mytasksmodel->get_task_team_ddl($this->data["tskid"]);	
		$this->load->view("common/header",$this->data);
		$this->data['left_nav']=$this->load->view('common/leftmenu',$this->data,true);	
		$this->load->view("mytasks/addfile",$this->data);
		$this->load->view("common/footer",$this->data);
	}
	
	function editfile()
	{
		$data['site_url']=$this->config->item('site_url');
		$this->data["tskid"] = $this->input->get("tsk");
		
		if($this->input->get("task_fl_id")){
			$this->data["formdata"] = $this->mytasksmodel->get_file_detail($this->input->get("task_fl_id"));	
			$this->data["task_team_list"]=$this->mytasksmodel->get_task_team_ddl($this->data["tskid"]);	
			$this->data["file_users"] = $this->mytasksmodel->get_file_users($this->input->get("task_fl_id"));	
		}
		$this->data["tskid"] = $this->input->get("tsk");
		
		$this->load->view("common/header");
		$this->data['left_nav']=$this->load->view('common/leftmenu',$this->data,true);	
		$this->load->view("mytasks/editfile",$this->data);
		$this->load->view("common/footer");
		
		
	}
	
	function updatefile()
	{
		if($this->input->post('file_title'))
		{
			$this->form_validation->set_rules('file_title', 'File Name', 'required');
			$this->form_validation->set_rules('task_id', 'Task details', 'required');
			$this->form_validation->set_rules('check_file_dups', 'File Name', 'callback_check_file_dups');
			
			if ($this->form_validation->run() == TRUE)
			{
				$this->mytasksmodel->update_file();
				redirect('mytasks/files/'.$this->input->post("task_id"));
			}
		}
		
		$this->data["formdata"] = array(
				"file_id" => $this->input->post("file_id"),
				"task_id" => $this->input->post("task_id"),
				"file_title" => $this->input->post("file_title"),
				"file_desc" => $this->input->post("file_desc"),
				"status" => $this->input->post("status")
				);
		
	}
	
	function multidelete(){
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
			$this->load->model('mytasksmodel');
			$this->mytasksmodel->delete_multiple_record($id_arr);
			redirect('mytasks/?multi=1');
		}
		else{
			redirect('mytasks');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('task_id', $id);
			$this->db->delete('pms_tasks'); 
			redirect('mytasks/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('task_id', $val);
					$this->db->delete('pms_tasks'); 
				}
			redirect('mytasks/?del=1');
		}
	}
	
	function delete_file()
	{
		if($this->input->post("delete_rec"))
		{
			 foreach ($this->input->post("delete_rec") as $key => $val)
				{
					$this->mytasksmodel->delete_file($val);
				}
			redirect('mytasks/files/'.$this->input->post("task_id").'?del=1');
		}
	}
	
	function check_dups()
	{
		$this->db->where('task_title', $this->input->post('task_title'));
		if($this->input->post('task_id') > 0)	$this->db->where('task_id !=', $this->input->post('task_id'));
		$query = $this->db->get('pms_tasks');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', "Task title already exists");
			return false;
		}
	}
	
	
	function changestat($id=null)
	{
		
		if($id=='')redirect('mytasks');
		if($this->input->get('stat')=='')redirect('mytasks');
		$this->db->query("update pms_tasks set status=".$this->input->get('stat')." where task_id =".$id);
		redirect('mytasks?stat=1&searchterm='.$this->input->get('searchterm').'&date_range='.$this->input->get('date_range'));

	}
	
	
}

?>