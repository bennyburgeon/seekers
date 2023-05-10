<?php
class Tasks extends CI_controller{
	
	function Tasks()
	{
		parent::__construct();	
	    if(!isset($_SESSION['company_session']) || $_SESSION['company_session']=='')redirect('logout');
	    $this->data['cur_page']=$this->router->class;
		$this->load->model("tasksmodel");
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
		$this->data['priority']='';
		$this->data['status']='';
		$this->data['admin_id']='';
		$start=0;
		
		if($this->input->get('limit')!=''){
			$limit= $this->input->get('limit');
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
			$sort_by = ' desc ';
		}
		
		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if($this->input->get("admin_id")!='')
		{
			$this->data['admin_id']=$this->input->get("admin_id");
		}
		if($this->input->get("date_range")!='')
		{
			$this->data['date_range']= $this->input->get("date_range");
		}
		
		if($this->input->post("date_range")!='')
		{
			$this->data['date_range']= $this->input->post("date_range");
		}

		if($this->input->get("status"))
		{
			$this->data['status']= $this->input->get("status");
		}
		
		if($this->input->post("status"))
		{
			$this->data['status']= $this->input->post("status");
		}

		if($this->input->get("priority"))
		{
			$this->data['priority']= $this->input->get("priority");
		}
		
		if($this->input->post("priority"))
		{
			$this->data['priority']= $this->input->post("priority");
		}
		
		if(isset($_GET['searchterm']))
		{
			if($_GET['searchterm']!='')
			$this->data['searchterm']= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->tasksmodel->record_count($this->data['searchterm'],$this->data['date_range'],$this->data['priority'],$this->data['status'],$this->data["admin_id"]);
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."tasks/?date_range=".$this->data["date_range"]."&sort_by=$sort_by&limit=$limit&searchterm=".$this->data["searchterm"]."&priority=".$this->data["priority"]."&status=".$this->data["status"]."&admin_id=".$this->data["admin_id"];
		
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
		$this->data["records"] = $this->tasksmodel->get_list($start,$limit,$this->data["searchterm"],$sort_by,$this->data['date_range'],$this->data['priority'],$this->data['status'],$this->data["admin_id"]);
		
		$this->data['admin_users_lists']= $this->tasksmodel->get_admin_users_lists();

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;

		
		$this->load->view("include/header",$this->data);
		$this->load->view("tasks/list",$this->data);
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
				"task_desc" => "",
				"admin_id" =>"",
				"status" => ""				
				);
	
		if($this->input->post("task_title")){

		$this->form_validation->set_rules("task_title","Task Title","required");
	
		if ($this->form_validation->run() == TRUE)
			{
				$id = $this->tasksmodel->insert_record();
				redirect('tasks/?ins=1');
			}
			
			
		$this->data["formdata"] = array(
				"task_title" => $this->input->post("task_title"),
				"candidate_id" => $this->input->post("candidate_id"),
				"start_date" =>$this->input->post("start_date"),
				"due_date" =>$this->input->post("due_date"),
				"admin_id" => $this->input->post("admin_id"),
				"task_module_id" => $this->input->post("task_module_id"),
				"task_priority_id"=>  $this->input->post("task_priority_id"),
				"task_status_id" => $this->input->post("task_status_id"),
				"task_desc" => $this->input->post("task_desc"),						
				);
		}

		$this->data["task_module_list"]=$this->tasksmodel->task_module_ddl();
		$this->data["task_priority_list"]=$this->tasksmodel->task_priority_ddl();
		$this->data["task_status_list"]=$this->tasksmodel->task_status_ddl();
		$this->data["admin_list"]=$this->tasksmodel->admin_list();

		$this->data['admin_users_lists']= $this->tasksmodel->get_candidate_list();			
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);	

		
		$this->load->view("include/header",$this->data);
		$this->load->view("tasks/add",$this->data);
		$this->load->view("include/footer",$this->data);
		
	}
	
	function edit($id='')
	{
		$this->data["page_head"]= "Edit Task ";
		
		$this->data["formdata"] = array(
				"task_title" => "",
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
				"status" => "",
				"candidate_id" => ""
				);
		
		
		if(!empty($id))
		{
			$this->data["formdata"] = $this->tasksmodel->get_task($id);
			}
		
		$this->data["task_module_list"]=$this->tasksmodel->task_module_ddl();
		$this->data["task_priority_list"]=$this->tasksmodel->task_priority_ddl();
		$this->data["task_status_list"]=$this->tasksmodel->task_status_ddl();
		$this->data["admin_list"]=$this->tasksmodel->admin_list();

		$this->data['admin_users_lists']= $this->tasksmodel->get_candidate_list();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);	

		$this->load->view("include/header",$this->data);
		$this->load->view("tasks/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function update()
	{
		$id=$this->input->post('task_id');
		if($this->input->post("task_title")){
			
		$this->form_validation->set_rules("task_title","Task Title","required");
		$this->form_validation->set_rules('check_ups', 'Title', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 			
				$this->tasksmodel->update_record();
				redirect('tasks/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
				"task_id" => $this->input->post("task_id"),
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
				"status" => $this->input->post("status"),
				"candidate_id" => $this->input->post("candidate_id")				
				);
				
			
				$this->data["predecessor_list"]=$this->tasksmodel->tasks_ddl1($id);
				$this->data["successor_list"]=$this->tasksmodel->tasks_ddl1($id);
				$this->data["task_module_list"]=$this->tasksmodel->task_module_ddl();
				$this->data["task_priority_list"]=$this->tasksmodel->task_priority_ddl();
				$this->data["task_status_list"]=$this->tasksmodel->task_status_ddl();
				$this->data["admin_list"]=$this->tasksmodel->admin_list();
				$this->data['admin_users_lists']= $this->tasksmodel->get_candidate_list();

				$this->data["page_head"]= "Edit Task ";
				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);	
				$this->load->view("include/header",$this->data);
				$this->load->view("tasks/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function followup($id)
	{
		$this->load->model('projectsmodel');
		$this->load->model('tasksmodel');
		$this->load->model('adminmodel');
		$this->data['admin_users_lists']= $this->tasksmodel->get_candidate_list();
		
		$this->data['task_details']=$this->tasksmodel->get_task($id);

		
		$this->data["task_status_list"]=$this->tasksmodel->task_status_ddl();
		$this->data["task_priority_list"]=$this->tasksmodel->task_priority_ddl();
		$this->data["followup_list"] = $this->tasksmodel->get_followup_list($id);


		$this->load->view('include/header',$this->data);
		$this->load->view('tasks/followup',$this->data);				
		$this->load->view('include/footer',$this->data);	
	}
	
	function addfllowup($id='')
	{
		$this->load->model('projectsmodel');
		$this->load->model('tasksmodel');
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
				
				$this->load->model('tasksmodel');
				$this->data['followup_list']=$this->tasksmodel->select_record($flp_id);
				$dataArr = $this->load->view('tasks/taskfollowup_list', $this->data,TRUE);
				echo $dataArr;
			}else{
				redirect('tasks/followup/'.$id);
			}				
	}
	
	function delfllowup()
	{
		$_POST['task_fl_id'];
		$this->load->model('tasksmodel');
		if(isset($_POST['task_fl_id']))		
		{			
			$this->db->where('task_fl_id', $_POST['task_fl_id']);
			$this->db->delete('pms_task_followup'); 
		}else
		{
			redirect('tasks');
		}
	}
	
	function updatefllowup()
	{
		$this->load->model('projectsmodel');
		if(isset($_POST['task_fl_id']))		
		{			
			$data= $this->tasksmodel->get_tasks_followup($_POST['task_fl_id']);
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
				$this->tasksmodel->insert_followup();
				redirect('tasks/followup/'.$this->input->post("task_id").'?ins=1');
			}
		else{
			redirect('tasks/followup/'.$this->input->post("task_id").'?err=1');
		}
			
	}
	
	function update_followup()
	{
		$this->form_validation->set_rules("task_fl_title","Followup Title","required");
		$this->form_validation->set_rules("task_fl_desc","Followup Description","required");
		
		if ($this->form_validation->run() == TRUE)
			{ 	
				$this->tasksmodel->update_followup();
				redirect('tasks/followup/'.$this->input->post("task_id").'?upd=1');
			}
		else
		{
			redirect('tasks/followup/'.$this->input->post("task_id").'?edit=1&fid='.$this->input->post("fid").'&err=1');
		}
	}
	
	function delete_followup()
	{
		if($this->input->post("id"))
		{
			$this->tasksmodel->delete_followup($this->input->post("id"));
		}
		
	}
	

	function toggle_status()
	{
		if($this->input->post("id")){
			
			$this->tasksmodel->toggle_status();
			}
	}
	
	function files($id)
	{
		$this->data["records"] = $this->tasksmodel->files_list($id);
		$this->data["page_head"]= "Manage Files";
		$this->data["tskid"] = $id;
		
		$this->load->view("common/header",$this->data);
		$this->data['left_nav']=$this->load->view('common/leftmenu',$this->data,true);	
		$this->load->view("tasks/listfile",$this->data);
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
				$this->tasksmodel->insert_file();
				redirect('tasks/files/'.$this->input->get("tsk"));
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
		
		$this->data["task_team_list"]=$this->tasksmodel->get_task_team_ddl($this->data["tskid"]);	
		
		
		
		$this->load->view("common/header",$this->data);
		$this->data['left_nav']=$this->load->view('common/leftmenu',$this->data,true);	
		$this->load->view("tasks/addfile",$this->data);
		$this->load->view("common/footer",$this->data);
	}
	
	function editfile()
	{
		$data['site_url']=$this->config->item('site_url');
		$this->data["tskid"] = $this->input->get("tsk");
		
		if($this->input->get("task_fl_id")){
			$this->data["formdata"] = $this->tasksmodel->get_file_detail($this->input->get("task_fl_id"));	
			$this->data["task_team_list"]=$this->tasksmodel->get_task_team_ddl($this->data["tskid"]);	
			$this->data["file_users"] = $this->tasksmodel->get_file_users($this->input->get("task_fl_id"));	
		}
		$this->data["tskid"] = $this->input->get("tsk");
		
		$this->load->view("common/header");
		$this->data['left_nav']=$this->load->view('common/leftmenu',$this->data,true);	
		$this->load->view("tasks/editfile",$this->data);
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
				$this->tasksmodel->update_file();
				redirect('tasks/files/'.$this->input->post("task_id"));
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
			$this->load->model('tasksmodel');
			$this->tasksmodel->delete_multiple_record($id_arr);
			redirect('tasks/?multi=1');
		}
		else{
			redirect('tasks');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('task_id', $id);
			$this->db->delete('pms_tasks'); 
			redirect('tasks/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('task_id', $val);
					$this->db->delete('pms_tasks'); 
				}
			redirect('tasks/?del=1');
		}
	}
	
	function delete_file()
	{
		if($this->input->post("delete_rec"))
		{
			 foreach ($this->input->post("delete_rec") as $key => $val)
				{
					$this->tasksmodel->delete_file($val);
				}
			redirect('tasks/files/'.$this->input->post("task_id").'?del=1');
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
		if($id=='')redirect('tasks');
		if($this->input->get('stat')=='')redirect('tasks');
		$this->db->query("update pms_tasks set status=".$this->input->get('stat')." where task_id =".$id);
		redirect('tasks?stat=1');

	}
	
	
}

?>