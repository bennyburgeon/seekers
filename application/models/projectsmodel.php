<?php 
class Projectsmodel extends CI_Model{
	
	
	
	function __construct()
	{
		
		$this->project_folder = "pms_project_folder";
		$this->project_type = "pms_project_type";
		$this->project_dev_status = "pms_project_dev_status";
		$this->project_company = "pms_company";
		$this->project_admin_users = "pms_admin_users";
		$this->project_table = "pms_projects";
		$this->project_followup = "pms_project_followup";
		$this->project_cust_notes = "pms_pjt_customer_notes";
		$this->project_team = "pms_project_team";
		$this->project_files = "pms_project_files";
		$this->project_file_users = "pms_project_file_users";
		
	}
	
	
	function project_folder_ddl()
	{
		$query=$this->db->query("select project_folder_id,project_folder_name from ".$this->project_folder." where status=1 order by project_folder_name" );
		$folder_list = $query->result();
		$dropDownList[0]='Select Project Folder';
		foreach($folder_list as $dropdown)
		{
			$dropDownList[$dropdown->project_folder_id] = $dropdown->project_folder_name;
		}
		return $dropDownList;
	}
	
	function project_type_ddl()
	{
		$query=$this->db->query("select project_type_id,project_type_name from ".$this->project_type." where status=1 order by project_type_name" );
		$type_list = $query->result();
		$dropDownList[0]='Select Project Type';
		foreach($type_list as $dropdown)
		{
			$dropDownList[$dropdown->project_type_id] = $dropdown->project_type_name;
		}
		return $dropDownList;
	}
	
	function project_dev_status_ddl()
	{
		$query=$this->db->query("select dev_status_id,dev_status_name from ".$this->project_dev_status." where status=1 order by dev_status_name" );
		$dev_list = $query->result();
		$dropDownList[0]='Select Development Status';
		foreach($dev_list as $dropdown)
		{
			$dropDownList[$dropdown->dev_status_id] = $dropdown->dev_status_name;
		}
		return $dropDownList;
	}
	
	function project_customers_ddl()
	{
		$query=$this->db->query("select company_id,company_name,contact_name from ".$this->project_company." /*where status=1*/ order by contact_name" );
		$customers_list = $query->result();
		$dropDownList[0]='Select Client';
		foreach($customers_list as $dropdown)
		{
			$dropDownList[$dropdown->company_id] = $dropdown->contact_name.', '.$dropdown->company_name;
		}
		return $dropDownList;
	}
	
	function project_owner_ddl()
	{
		$query=$this->db->query("select candidate_id,first_name from ".$this->project_admin_users." where status=1 order by first_name" );
		$customers_list = $query->result();
		$dropDownList[0]='Select Project Owner';
		foreach($customers_list as $dropdown)
		{
			$dropDownList[$dropdown->candidate_id] = $dropdown->first_name;
		}
		return $dropDownList;
	}
	
	function project_manager_ddl()
	{
		$query=$this->db->query("select candidate_id,first_name from ".$this->project_admin_users." where status=1 order by first_name" );
		$customers_list = $query->result();
		$dropDownList[0]='Select Project Manager';
		foreach($customers_list as $dropdown)
		{
			$dropDownList[$dropdown->candidate_id] = $dropdown->first_name;
		}
		return $dropDownList;
	}
	
	function project_team_ddl()
	{
		$query=$this->db->query("select candidate_id,first_name from ".$this->project_admin_users." where status=1 order by first_name" );
		$customers_list = $query->result();
		foreach($customers_list as $dropdown)
		{
			$dropDownList[$dropdown->candidate_id] = $dropdown->first_name;
		}
		return $dropDownList;
	}
	
	function projects_list()
	{
		$query = $this->db->query("SELECT a.project_id,a.start_date,a.end_date,a.project_name,a.project_code,a.status,b.dev_status_name,c.contact_name,c.company_name,d.project_folder_name FROM ".$this->project_table." a JOIN ".$this->project_dev_status." b on a.dev_status_id=b.dev_status_id JOIN ".$this->project_company." c on a.client_id=c.company_id JOIN ".$this->project_folder." d on a.project_folder_name=d.project_folder_id order by a.project_name ");
		return $query->result_array();
	}
	
	function get_project($id)
	{
		$query = $this->db->query("SELECT a.project_id,a.start_date,a.end_date,a.project_name,a.project_code,a.project_desc,a.project_folder_name,a.dev_status_id,b.first_name from ".$this->project_table." a JOIN ".$this->project_admin_users." b on a.project_pm = b.candidate_id where a.project_id=".$id);
		return $query->row_array();
	}
	
	function get_project_followups($id)
	{
		$query = $this->db->query("SELECT a.fl_title,a.fl_id,a.fl_date,a.fl_desc,a.file_path,a.project_id,b.project_folder_name,c.dev_status_name,(SELECT first_name from ".$this->project_admin_users." where candidate_id=a.user_id) as username,(SELECT contact_name from ".$this->project_company." where customer_id=a.client_user_id) as client_name,d.note_title,d.note_desc,d.note_date from ".$this->project_followup." a JOIN ".$this->project_folder." b on a.project_folder = b.project_folder_id JOIN ".$this->project_dev_status." c on a.dev_status_id = c.dev_status_id LEFT OUTER JOIN ".$this->project_cust_notes." d on d.followup_id=a.fl_id where a.project_id=".$id." ORDER BY a.fl_id");
		return $query->result_array();
	}
	
	function get_single_project($id)
	{
		$query = $this->db->query("SELECT * FROM ".$this->project_table." WHERE project_id=".$id);
		return $query->row_array();
	}	
	
	function get_project_team_ddl($id)
	{
		$query = $this->db->query("SELECT a.user_id,b.first_name from ".$this->project_team." a JOIN ".$this->project_admin_users." b on a.user_id=b.candidate_id where a.project_id=".$id);
		$dropDownList = array();
		$customers_list = $query->result();
		foreach($customers_list as $dropdown)
		{
			$dropDownList[$dropdown->user_id] = $dropdown->first_name;
		}
		
		return $dropDownList;
	}
	
	
	function insert_record()
	{ 
		
		$data = array(
				"project_name" => $this->input->post("project_name"),
				"project_code" => $this->input->post("project_code"),
				"project_folder_name" => $this->input->post("project_folder_name"),
				"project_type" => $this->input->post("project_type"),
				"dev_status_id" => $this->input->post("dev_status_id"),
				"start_date" => date("Y-m-d ",strtotime($this->input->post("start_date"))),
				"end_date" =>  date("Y-m-d ",strtotime($this->input->post("end_date"))),
				"client_id" => $this->input->post("client_id"),
				"project_owner" => $this->input->post("project_owner"),
				"project_pm" => $this->input->post("project_manager"),
				"is_billable" => $this->input->post("is_billable"),
				"project_est_cost" => $this->input->post("project_est_cost"),
				"client_budget" => $this->input->post("client_budget"),
				"project_actual_cost" => $this->input->post("project_actual_cost"),
				"estimated_hours" => $this->input->post("estimated_hours"),
				"actual_hours" => $this->input->post("actual_hours"),
				"alert_when" => $this->input->post("alert_when"),
				"status" => $this->input->post("status"),
				"project_desc" => $this->input->post("project_desc")
				
				);
				
		$this->db->insert($this->project_table,$data);
		$id = $this->db->insert_id();
		
		if(is_array($this->input->post('project_team')))
			{
				foreach($this->input->post('project_team') as $team)
				{
					$pjt_team=array(
					'user_id'        => $team,
					'project_id'       => $id 
					);
					$this->db->insert($this->project_team, $pjt_team);
				}
			}
	}
	
	function update_record()
	{
		$data = array(
				"project_name" => $this->input->post("project_name"),
				"project_code" => $this->input->post("project_code"),
				"project_folder_name" => $this->input->post("project_folder_name"),
				"project_type" => $this->input->post("project_type"),
				"dev_status_id" => $this->input->post("dev_status_id"),
				"start_date" => date("Y-m-d ",strtotime($this->input->post("start_date"))),
				"end_date" =>  date("Y-m-d ",strtotime($this->input->post("end_date"))),
				"client_id" => $this->input->post("client_id"),
				"project_owner" => $this->input->post("project_owner"),
				"project_pm" => $this->input->post("project_manager"),
				"is_billable" => $this->input->post("is_billable"),
				"project_est_cost" => $this->input->post("project_est_cost"),
				"client_budget" => $this->input->post("client_budget"),
				"project_actual_cost" => $this->input->post("project_actual_cost"),
				"estimated_hours" => $this->input->post("estimated_hours"),
				"actual_hours" => $this->input->post("actual_hours"),
				"alert_when" => $this->input->post("alert_when"),
				"status" => $this->input->post("status"),
				"project_desc" => $this->input->post("project_desc")
				
				);
				
	   $this->db->where('project_id', $this->input->post('project_id'));
	   $this->db->update($this->project_table, $data);
	   
	   
	   if(is_array($this->input->post('project_team')))
			{
				$this->db->delete($this->project_team,array('project_id'=>$this->input->post('project_id')));
				foreach($this->input->post('project_team') as $team)
				{
					$pjt_team=array(
					'user_id'        => $team,
					'project_id'       => $this->input->post('project_id')
					);
					$this->db->insert($this->project_team, $pjt_team);
				}
			}
	}
	
	
	/*function delete_record($id)
	{
		$this->db->delete($this->project_table,array('project_id'=>$id));
		$this->db->delete($this->project_team,array('project_id'=>$id));
		$query = $this->db->query("select file_path from ".$this->project_followup." where project_id=".$id);
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('../uploads/projectfollowups/'.$row['file_path']) && $row['file_path']!='')
						unlink('../uploads/projectfollowups/'.$row['file_path']);
					}
		$this->db->delete($this->project_followup,array('project_id'=>$id));
		$this->db->delete($this->project_cust_notes,array('project_id'=>$id));
	}*/
	
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_project_team','key' => 'project_id ','Module'=>'Project Team'),array('table'=>'pms_tasks','key' => 'project_id ','Module'=>'Tasks'));
		$is_related = FALSE;
		foreach($master_tables as $table){
			$query=$this->db->query("select * from ".$table['table']." where ".$table['key']."=".$id);
			$num_rows = (int) $query->num_rows();
			if($num_rows){
				$is_related = TRUE;
				$_SESSION['related_module'] = $table['Module'];
				break;
			}
		}
		return $is_related;
	}
	function delete_record($id=null)
	{
		if($id=='') return false;		
		
		if($this->is_related($id)){
			return 2;
		}else{
			$this->db->delete($this->project_table,array('project_id'=>$id));
			$this->db->delete($this->project_team,array('project_id'=>$id));
			$query = $this->db->query("select file_path from ".$this->project_followup." where project_id=".$id);
						if ($query->num_rows() > 0)
						{
							$row = $query->row_array();
							if(file_exists('../uploads/projectfollowups/'.$row['file_path']) && $row['file_path']!='')
							unlink('../uploads/projectfollowups/'.$row['file_path']);
						}
			$this->db->delete($this->project_followup,array('project_id'=>$id));
			$this->db->delete($this->project_cust_notes,array('project_id'=>$id)); 
			return 1;
		}
		

	}
	
	function get_single_followup($id)
	{
		$query = $this->db->query("SELECT a.fl_id,a.fl_title,a.fl_date,a.project_folder,a.dev_status_id,a.fl_desc,a.file_path,b.cust_note_id,b.note_title,b.note_desc from ".$this->project_followup." a LEFT OUTER JOIN ".$this->project_cust_notes." b on a.fl_id = b.followup_id where a.fl_id=".$id);
		
		return $query->row_array();
	}
	
	function insert_followup()
	{
		$data = array(
				"fl_title" => $this->input->post("fl_title"),
				"fl_date" => date("Y-m-d",strtotime($this->input->post("fl_date"))),
				"fl_desc" => $this->input->post("fl_desc"),
				"user_id" => $_SESSION['candidate_session'],
				"project_id" => $this->input->post("project_id"),
				"project_folder" => $this->input->post("project_folder"),
				"dev_status_id" => $this->input->post("dev_status_id")
				
				);
		
		$this->db->insert($this->project_followup,$data);
		$id = $this->db->insert_id();
		
		$this->load->library('upload');		
		
		if (is_uploaded_file($_FILES['file_path']['tmp_name'])) 
			{         

				$photo['upload_path'] = '../uploads/projectfollowups/';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif|pdf|doc|docx|xls|xlsx';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
				
				$this->upload->initialize($photo);
				
				if ($this->upload->do_upload('file_path'))
					{ 
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update ".$this->project_followup." set file_path='".$this->upload_file_name."' where fl_id=".$id);
				
					}
				else{
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
					exit;
				}
			 }
		
	   
		   $data_pjt = array(
					"project_folder_name" => $this->input->post("project_folder"),
					"dev_status_id" => $this->input->post("dev_status_id")
					);
		   
		   $this->db->where('project_id', $this->input->post('project_id'));
		   $this->db->update($this->project_table, $data_pjt);
			
			
		$data_notes = array(
				"note_title" => $this->input->post("note_title"),
				"note_desc" => $this->input->post("note_desc"),
				"note_date" => date("Y-m-d",strtotime($this->input->post("fl_date"))),
				"project_id" => $this->input->post("project_id"),
				"followup_id" => $id
				);
				
		$this->db->insert($this->project_cust_notes,$data_notes);
		
		if(is_array($this->input->post('project_manager')))
			{
				/*$message = 'New followup added to Project';
				$this->load->library('email');

				$this->email->from('noreply@shyjo.pw', 'NoReply');
				$this->email->subject('Follow up added');
				$this->email->message($message);
				foreach($this->input->post('project_manager') as $team)
				{
					
					$this->email->to($this->input->post('email'));
					$this->email->send();
				
				}*/
			}
		
	}
	
	function update_followup()
	{
		$data = array(
				"fl_title" => $this->input->post("fl_title"),
				"fl_date" => date("Y-m-d",strtotime($this->input->post("fl_date"))),
				"fl_desc" => $this->input->post("fl_desc"),
				"user_id" => $_SESSION['candidate_session'],
				"project_id" => $this->input->post("project_id"),
				"project_folder" => $this->input->post("project_folder"),
				"dev_status_id" => $this->input->post("dev_status_id")
				
				);
				
	   $this->db->where('fl_id', $this->input->post('fl_id'));
	   $this->db->update($this->project_followup, $data);		
		
	   
		$this->load->library('upload');		
		
		if (is_uploaded_file($_FILES['file_path']['tmp_name'])) 
			{         

				$photo['upload_path'] = '../uploads/projectfollowups/';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif|pdf|doc|docx|xls|xlsx';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
				
				$this->upload->initialize($photo);
				
				if ($this->upload->do_upload('file_path'))
					{ 
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update ".$this->project_followup." set file_path='".$this->upload_file_name."' where fl_id=".$this->input->post("fl_id"));
				
					}
				else{
					$error = array('error' => $this->upload->display_errors());
					print_r($error);
					exit;
				}
			 }
			 
			 
			$data_pjt = array(
					"project_folder_name" => $this->input->post("project_folder"),
					"dev_status_id" => $this->input->post("dev_status_id")
					);
		   
		   $this->db->where('project_id', $this->input->post('project_id'));
		   $this->db->update($this->project_table, $data_pjt);
			
		  
		  if($this->input->post('cust_note_id')){
		   	
			$data_notes = array(
				"note_title" => $this->input->post("note_title"),
				"note_desc" => $this->input->post("note_desc"),
				"note_date" => date("Y-m-d",strtotime($this->input->post("fl_date"))),
				"project_id" => $this->input->post("project_id"),
				"followup_id" =>$this->input->post("fl_id")
				);	
				
				 $this->db->where('cust_note_id', $this->input->post('cust_note_id'));
		   		 $this->db->update($this->project_cust_notes, $data_notes);
		  }
		  
		  if(is_array($this->input->post('project_manager')))
			{
				/*$message = 'New followup added to Project';
				$this->load->library('email');

				$this->email->from('noreply@shyjo.pw', 'NoReply');
				$this->email->subject('Follow up added');
				$this->email->message($message);
				foreach($this->input->post('project_manager') as $team)
				{
					
					$this->email->to($this->input->post('email'));
					$this->email->send();
				
				}*/
			}
		
	}
	
	
	function delete_followup($id)
	{
		$query = $this->db->query("select file_path from ".$this->project_followup." where fl_id=".$id);
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('../uploads/projectfollowups/'.$row['file_path']) && $row['file_path']!='')
						unlink('../uploads/projectfollowups/'.$row['file_path']);
					}
		$this->db->delete($this->project_followup,array('fl_id'=>$id));
		$this->db->delete($this->project_cust_notes,array('followup_id'=>$id));
	}
	
	function files_list($id)
	{
			$query=$this->db->query("select file_id,file_title,file_path from ".$this->project_files." where project_id=".$id);
			return $query->result_array();
	}
	
	function insert_file()
	{
			
				
	   $this->load->library('upload');		
		
		if (is_uploaded_file($_FILES['file_path']['tmp_name'])) 
			{         

				$photo['upload_path'] = '../uploads/projectfiles/';
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
							"project_id" => $this->input->post("project_id"),
							"file_title" => $this->input->post("file_title"),
							"file_path" => $this->upload_file_name,
							"file_desc" => $this->input->post("file_desc"),
							"status" => $this->input->post("status")
							);
						$this->db->insert($this->project_files,$data);
						$id = $this->db->insert_id();
						
						if(is_array($this->input->post('user_id')))
							{ 
								foreach($this->input->post('user_id') as $user)
								{
									$file_users=array(
									'user_id'        => $user,
									'file_id'       => $id 
									);
									$this->db->insert($this->project_file_users, $file_users);
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
	   $this->db->update($this->project_files, $data);	
		
	   if(is_array($this->input->post('user_id')))
			{  
			    $this->db->delete($this->project_file_users,array('file_id'=>$this->input->post('file_id')));
				foreach($this->input->post('user_id') as $user)
				{
					$file_users=array(
					'user_id'        => $user,
					'file_id'       => $this->input->post('file_id') 
					);
					$this->db->insert($this->project_file_users, $file_users);
				}
			}	
		
	   $this->load->library('upload');		
		
		if (is_uploaded_file($_FILES['file_path']['tmp_name'])) 
			{         
				$photo['upload_path'] = '../uploads/projectfiles/';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif|pdf|doc|docx|xls|xlsx';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
				
				$this->upload->initialize($photo);
				
				if ($this->upload->do_upload('file_path'))
					{ 
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						
						$query = $this->db->query("select file_path from ".$this->project_files." where file_id=".$this->input->post('file_id'));
						if ($query->num_rows() > 0)
						{
							$row = $query->row_array();
							if(file_exists('../uploads/projectfiles/'.$row['file_path']) && $row['file_path']!='')
							unlink('../uploads/projectfiles/'.$row['file_path']);
						}
						
						$this->db->query("update ".$this->project_files." set file_path='".$this->upload_file_name."' where file_id=".$this->input->post('file_id'));
						
						
				
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
		$query = $this->db->query("select file_path from ".$this->project_files." where file_id=".$id);		
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if(file_exists('../uploads/projectfiles/'.$row['file_path']) && $row['file_path']!='')
			unlink('../uploads/projectfiles/'.$row['file_path']);
		}	
		$this->db->delete($this->project_files,array('file_id'=>$id));
	}
	
	function get_file_detail($id)
	{
		$query = $this->db->query("SELECT * FROM ".$this->project_files." WHERE file_id=".$id);
		return $query->row_array();
	}
	
	function get_file_users($id)
	{
		$query =  $this->db->query("SELECT user_id FROM ".$this->project_file_users." where file_id=".$id);
		return array_map('current', $query->result_array());
	
	}
	function get_followup_list($id){
		$query = $this->db->query("select a.*,b.* from pms_project_followup a inner join pms_project_dev_status b ON a.dev_status_id=b.dev_status_id
where a.project_id = $id order by fl_id   ASC ");
		return $query->result_array();
	}
	function get_projects_followup($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select a.*,b.* from pms_project_followup a inner join pms_project_dev_status b ON a.dev_status_id=b.dev_status_id where a.fl_id = ".$id);
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