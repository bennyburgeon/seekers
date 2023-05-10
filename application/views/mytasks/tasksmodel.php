<?php
class Tasksmodel extends CI_Model{
	
	
	
	function __construct()
	{
		$this->task_table 		 = "pms_tasks";
		$this->project_table	 = "pms_projects";
		$this->task_modules 	 = "pms_task_module";
		$this->task_priority 	 = "pms_task_priority";
		$this->task_status 	 	 = "pms_task_status";
		$this->task_team 		 = "pms_task_team";
		$this->project_team 	 = "pms_project_team";
		$this->admin_users 		 = "pms_admin_users";
		$this->project_milestone = "pms_milestone";
		$this->task_followup 	 = "pms_task_followup";
		$this->task_files 	 	 = "pms_task_files";
		$this->task_file_users 	 	 = "pms_task_file_users";
	
	}
	
	function get_single_followup($id)
	{
		$query = $this->db->query("SELECT a.task_fl_id,a.task_fl_title,	a.task_fl_desc,a.task_fl_date_time,a.assigned_to,a.task_priority,a.task_status,a.task_id,b.status from ".$this->task_followup."  a join ".$this->task_table." b on a.task_id=b.task_id where task_fl_id=".$id);
		return $query->row_array();
	}
	
	function get_task_followups($id)
	{
		$query = $this->db->query("SELECT a.task_fl_id,a.task_fl_title,a.task_fl_desc,a.task_fl_date_time,a.task_id,b.first_name,c.task_status_name,d.task_priority_name from ".$this->task_followup." a join ".$this->admin_users." b on a.user_id=b.candidate_id join ".$this->task_status." c on a.task_status=c.task_status_id join ".$this->task_priority." d on a.task_priority=d.task_priority_id where a.task_id=".$id." order by a.task_fl_id desc");
		
		return $query->result_array();
	}
	
	function tasks_ddl()
	{
		$data = array();
		$query=$this->db->query("select task_id,task_title from ".$this->task_table." order by task_title");
		
		$dropDownList[0]='Select Task';
		$tasks_list = $query->result();
		
		foreach($tasks_list as $dropdown)
		{
			$dropDownList[$dropdown->task_id] = $dropdown->task_title;
		}
		return $dropDownList;
	}
	
	function tasks_ddl1($id)
	{
		$data = array();
		$query=$this->db->query("select task_id,task_title from ".$this->task_table." where task_id=".$id." order by task_title");
		
		$dropDownList[0]='Select Task';
		$tasks_list = $query->result();
		
		foreach($tasks_list as $dropdown)
		{
			$dropDownList[$dropdown->task_id] = $dropdown->task_title;
		}
		return $dropDownList;
	}
	
	function get_milestone_ddl($id)
	{
		$data = array();
		$query=$this->db->query("select milestone_id,milestone_title from ".$this->project_milestone." where project_id=".$id);
		$dropDownList = array();
		$milestone_list = $query->result();
		
		foreach($milestone_list as $dropdown)
		{
			$dropDownList[$dropdown->milestone_id] = $dropdown->milestone_title;
		}
		
		return $dropDownList;
	}
	
	function get_project_team_ddl($id)
	{
		$query = $this->db->query("SELECT a.user_id,b.first_name from ".$this->project_team." a JOIN ".$this->admin_users." b on a.user_id=b.candidate_id where a.project_id=".$id);
		$dropDownList = array();
		$customers_list = $query->result();
		foreach($customers_list as $dropdown)
		{
			$dropDownList[$dropdown->user_id] = $dropdown->first_name;
		}
		
		return $dropDownList;
	}
	
	function get_task_team_ddl($id)
	{
		$query = $this->db->query("SELECT a.user_id,b.first_name from ".$this->task_team." a JOIN ".$this->admin_users." b on a.user_id=b.candidate_id where a.task_id=".$id);
		$dropDownList[0]='Select User';
		$customers_list = $query->result();
		foreach($customers_list as $dropdown)
		{
			$dropDownList[$dropdown->user_id] = $dropdown->first_name;
		}
		
		return $dropDownList;
	}
	
	function get_task_details($id)
	{
		$query = $this->db->query("SELECT a.task_id,a.task_title,a.start_date,a.task_desc,b.task_module_name,c.task_priority_name,d.task_status_name from ".$this->task_table." a JOIN ".$this->task_modules." b on a.task_module_id = b.task_module_id JOIN ".$this->task_priority." c on a.task_priority_id=c.task_priority_id JOIN ".$this->task_status." d on a.task_status_id=d.task_status_id where a.task_id=".$id);
		
		return $query->row_array();
	}
	
	
	function get_task($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select a.*,b.*,c.* from pms_tasks a inner join pms_task_status b ON a.task_status_id=b.task_status_id inner join pms_task_priority c ON a.task_priority_id=c.task_priority_id where a.task_id = ".$id);
		
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}
	
	function select_record($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select a.*,b.* from pms_task_followup a inner join pms_task_status b ON a.task_status=b.task_status_id where a.task_fl_id = ".$id);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}
	
	
	function tasks_list()
	{
		$query = $this->db->query("select a.*,b.task_status_name,c.task_priority_name from ".$this->task_table." a inner join pms_task_status b on a.task_status_id=b.task_status_id inner join pms_task_priority c on a.task_priority_id=c.task_priority_id order by a.task_title");
		
		return $query->result_array();
	}
	
	function project_ddl()
	{
		$query=$this->db->query("select project_id,project_name from ".$this->project_table." where status=1 order by project_name" );
		$project_list = $query->result();
		$dropDownList[0]='Select Project';
		foreach($project_list as $dropdown)
		{
			$dropDownList[$dropdown->project_id] = $dropdown->project_name;
		}
		return $dropDownList;
	}
	
	function task_module_ddl()
	{
		$query=$this->db->query("select task_module_id,task_module_name from ".$this->task_modules." where status=1 order by task_module_name" );
		$task_module_list = $query->result();
		$dropDownList[0]='Select Module';
		foreach($task_module_list as $dropdown)
		{
			$dropDownList[$dropdown->task_module_id] = $dropdown->task_module_name;
		}
		return $dropDownList;
	}
	
	function task_priority_ddl()
	{
		$query=$this->db->query("select task_priority_id,task_priority_name from ".$this->task_priority." where status=1 order by task_priority_name" );
		$task_priority_list = $query->result();
		$dropDownList[0]='Select Priority';
		foreach($task_priority_list as $dropdown)
		{
			$dropDownList[$dropdown->task_priority_id] = $dropdown->task_priority_name;
		}
		return $dropDownList;
	}
	
	function task_status_ddl()
	{
		$query=$this->db->query("select task_status_id,task_status_name from ".$this->task_status." where status=1 order by task_status_name" );
		$task_status_list = $query->result();
		$dropDownList[0]='Select Status';
		foreach($task_status_list as $dropdown)
		{
			$dropDownList[$dropdown->task_status_id] = $dropdown->task_status_name;
		}
		return $dropDownList;
	}
	
	function project_team_ddl($id)
	{
		$data = array();
		$query=$this->db->query("select a.user_id,b.first_name from ".$this->project_team." a join ".$this->admin_users." b on a.user_id=b.candidate_id where project_id=".$id);
		
		$team_list = $query->result();
		
		foreach($team_list as $dropdown)
		{
			$dropDownList["id"] = $dropdown->user_id;
			$dropDownList["name"] = $dropdown->first_name;
			array_push($data,$dropDownList);
		}
		
		return $data;
	}
	
	function milestone_ddl($id)
	{
		$data = array();
		$query=$this->db->query("select milestone_id,milestone_title from ".$this->project_milestone." where project_id=".$id);
		
		$milestone_list = $query->result();
		
		foreach($milestone_list as $dropdown)
		{
			$dropDownList["id"] = $dropdown->milestone_id;
			$dropDownList["title"] = $dropdown->milestone_title;
			array_push($data,$dropDownList);
		}
		
		return $data;
	}
	
	function insert_record()
	{
		 
		
		$data = array(
				"task_title" => $this->input->post("task_title"),
				"start_date" => date("Y-m-d ",strtotime($this->input->post("start_date"))),
				"due_date" =>date("Y-m-d ",strtotime($this->input->post("due_date"))),
				"project_id" =>'7',
				"project_folder_id" => $this->input->post("project_folder_id"),
				"task_module_id" => $this->input->post("task_module_id"),
				"task_priority_id"=>  $this->input->post("task_priority_id"),
				"task_status_id" => $this->input->post("task_status_id"),
				"unbillable_hrs" => $this->input->post("unbillable_hrs"),
				"billable_hrs" => $this->input->post("billable_hrs"),
				"actual_hrs" => $this->input->post("actual_hrs"),
				"task_desc" => $this->input->post("task_desc"),
				"predecessor" => $this->input->post("predecessor"),
				"successor" => $this->input->post("successor"),
				"milestone_id" => $this->input->post("milestone_id"),
				"status" => $this->input->post("status")
				
				);
				
		$this->db->insert($this->task_table,$data);
		$id = $this->db->insert_id();
		
		if($this->input->post('task_team'))
			{
				
					$tsk_team=array(
					'user_id'        => $this->input->post('task_team'),
					'task_id'       => $id 
					);
					$this->db->insert($this->task_team, $tsk_team);
				
			}
	
	}
	
	
	function update_record()
	{
		$data = array(
				"task_title" => $this->input->post("task_title"),
				"start_date" => date("Y-m-d ",strtotime($this->input->post("start_date"))),
				"due_date" =>date("Y-m-d ",strtotime($this->input->post("due_date"))),
				"project_id" =>'7',
				"project_folder_id" => $this->input->post("project_folder_id"),
				"task_module_id" => $this->input->post("task_module_id"),
				"task_priority_id"=>  $this->input->post("task_priority_id"),
				"task_status_id" => $this->input->post("task_status_id"),
				"unbillable_hrs" => $this->input->post("unbillable_hrs"),
				"billable_hrs" => $this->input->post("billable_hrs"),
				"actual_hrs" => $this->input->post("actual_hrs"),
				"task_desc" => $this->input->post("task_desc"),
				"predecessor" => $this->input->post("predecessor"),
				"successor" => $this->input->post("successor"),
				"milestone_id" => $this->input->post("milestone_id"),
				"status" => $this->input->post("status")
				
				);
				
	   $this->db->where('task_id', $this->input->post('task_id'));
	   $this->db->update($this->task_table, $data);
	   
	   
	   if(($this->input->post('task_team')))
			{
				$this->db->delete($this->task_team,array('task_id'=>$this->input->post('task_id')));
				
					$tsk_team=array(
					'user_id'        => $this->input->post('task_team'),
					'task_id'       => $this->input->post('task_id')
					);
					$this->db->insert($this->task_team, $tsk_team);
				
			}
	}
	
	function insert_followup()
	{
		$data = array(
				"task_fl_title" => $this->input->post("task_fl_title"),
				"task_fl_date_time" => date("Y-m-d",strtotime($this->input->post("task_fl_date_time"))),
				"task_fl_desc" => $this->input->post("task_fl_desc"),
				"user_id" => $_SESSION['candidate_session'],
				"task_id" => $this->input->post("task_id"),
				"task_status" => $this->input->post("task_status"),
				"task_priority" => $this->input->post("task_priority"),
				"assigned_to" => $this->input->post("assigned_to")
				
				);
		
			$this->db->insert($this->task_followup,$data);
			$id = $this->db->insert_id();
			
		    $data_tsk = array(
					"task_status_id" => $this->input->post("task_status"),
					"task_priority_id" => $this->input->post("task_priority"),
					"status" => $this->input->post("status")
					);
		   
		   $this->db->where('task_id', $this->input->post('task_id'));
		   $this->db->update($this->task_table, $data_tsk);
			
		
	}
	
	function update_followup()
	{
		$data = array(
				"task_fl_title" => $this->input->post("task_fl_title"),
				"task_fl_date_time" => date("Y-m-d",strtotime($this->input->post("task_fl_date_time"))),
				"task_fl_desc" => $this->input->post("task_fl_desc"),
				"user_id" => $_SESSION['candidate_session'],
				"task_id" => $this->input->post("task_id"),
				"task_status" => $this->input->post("task_status"),
				"task_priority" => $this->input->post("task_priority"),
				"assigned_to" => $this->input->post("assigned_to")
		);
				
	   $this->db->where('task_fl_id', $this->input->post('task_fl_id'));
	   $this->db->update($this->task_followup, $data);		
		
	      $data_tsk = array(
					"task_status_id" => $this->input->post("task_status"),
					"task_priority_id" => $this->input->post("task_priority"),
					"status" => $this->input->post("status")
					);
		   
		   $this->db->where('task_id', $this->input->post('task_id'));
		   $this->db->update($this->task_table, $data_tsk);
		 
	}
	
	
	function delete_followup($id)
	{
		$this->db->delete($this->task_followup,array('task_fl_id'=>$id));
		
	}
	
	function toggle_status()
	{
			
			$this->db->query("update ".$this->task_table." set status= IF(status=1, 0, 1) where task_id=".$this->input->post("id"));
			exit;
			
	}
	
	
	function files_list($id)
	{
			$query=$this->db->query("select file_id,file_title,file_path from ".$this->task_files." where task_id=".$id);
			return $query->result_array();
	}
	
	function insert_file()
	{
			
				
	   $this->load->library('upload');		
		
		if (is_uploaded_file($_FILES['file_path']['tmp_name'])) 
			{         

				$photo['upload_path'] = '../uploads/taskfiles/';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif|pdf|doc|docx|xls|xlsx';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
				
				$this->upload->initialize($photo);
				
				if ($this->upload->do_upload('file_path'))
					{ 
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$data = array(
							"task_id" => $this->input->post("task_id"),
							"file_title" => $this->input->post("file_title"),
							"file_path" => $this->upload_file_name,
							"file_desc" => $this->input->post("file_desc"),
							"status" => $this->input->post("status")
							);
						$this->db->insert($this->task_files,$data);
						$id = $this->db->insert_id();
						
						if(is_array($this->input->post('user_id')))
							{ 
								foreach($this->input->post('user_id') as $user)
								{
									$file_users=array(
									'user_id'        => $user,
									'file_id'       => $id 
									);
									$this->db->insert($this->task_file_users, $file_users);
								}
							}
						
				
					}
				else{
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
					exit;
				}
			 }
	
	}
	
	function update_file()
	{
		
		$data = array(
				"file_title" => $this->input->post("file_title"),
				"file_desc" => $this->input->post("file_desc"),
				"status" => $this->input->post("status")
				);
	   $this->db->where('file_id', $this->input->post('file_id'));
	   $this->db->update($this->task_files, $data);	
		
	   if(is_array($this->input->post('user_id')))
			{  
			    $this->db->delete($this->task_file_users,array('file_id'=>$this->input->post('file_id')));
				foreach($this->input->post('user_id') as $user)
				{
					$file_users=array(
					'user_id'        => $user,
					'file_id'       => $this->input->post('file_id') 
					);
					$this->db->insert($this->task_file_users, $file_users);
				}
			}	
		
	   $this->load->library('upload');		
		
		if (is_uploaded_file($_FILES['file_path']['tmp_name'])) 
			{         
				$photo['upload_path'] = '../uploads/taskfiles/';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif|pdf|doc|docx|xls|xlsx';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
				
				$this->upload->initialize($photo);
				
				if ($this->upload->do_upload('file_path'))
					{ 
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						
						$query = $this->db->query("select file_path from ".$this->task_files." where file_id=".$this->input->post('file_id'));
						if ($query->num_rows() > 0)
						{
							$row = $query->row_array();
							if(file_exists('../uploads/taskfiles/'.$row['file_path']) && $row['file_path']!='')
							unlink('../uploads/taskfiles/'.$row['file_path']);
						}
						
						$this->db->query("update ".$this->task_files." set file_path='".$this->upload_file_name."' where file_id=".$this->input->post('file_id'));
						
						
				
					}
				else{
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
					exit;
				}
			 }
	
	}
	
	function delete_file($id)
	{
		$query = $this->db->query("select file_path from ".$this->task_files." where file_id=".$id);		
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if(file_exists('../uploads/taskfiles/'.$row['file_path']) && $row['file_path']!='')
			unlink('../uploads/taskfiles/'.$row['file_path']);
		}	
		$this->db->delete($this->task_files,array('file_id'=>$id));
	}
	
	function get_file_detail($id)
	{
		$query = $this->db->query("SELECT * FROM ".$this->task_files." WHERE file_id=".$id);
		return $query->row_array();
	}
	
	function get_file_users($id)
	{
		$query =  $this->db->query("SELECT user_id FROM ".$this->task_file_users." where file_id=".$id);
		return array_map('current', $query->result_array());
	
	}
	function get_followup_list($id){
		$query = $this->db->query("select a.*,b.* from pms_task_followup a inner join pms_task_status b ON a.task_status=b.task_status_id
where a.task_id = $id order by task_fl_id   ASC ");
		return $query->result_array();
	}
	function get_tasks_followup($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select a.*,b.* from pms_task_followup a inner join pms_task_status b ON a.task_status=b.task_status_id where a.task_fl_id = ".$id);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}
	
	
}
?>