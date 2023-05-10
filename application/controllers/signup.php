<?php class Signup extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('signupmodel');
		$this->load->model('homepagemodel');
		$this->load->library('pagination');
		if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
		{
			redirect('dashboard');
		}
	}
	
	function index()
	{
		$this->data["edu_level_list"] = $this->signupmodel->edu_level_list();
		$this->data["industry_list"] = $this->signupmodel->industry_list();
		$this->data["functional_list"] = $this->signupmodel->functional_list();
		$this->data["nationality_list"] = $this->signupmodel->nationality_list();
		$this->data["current_nationality_list"] = $this->signupmodel->current_nationality_list();
		$this->data["passport_nationality_list"] = $this->signupmodel->passport_nationality_list();
		$this->data["country_intl_code"] = $this->signupmodel->country_intl_code();

		$this->data["country_list"] = $this->signupmodel->country_list_reg();
		$this->data["state_list"] = array('' => 'Select State');		
		$this->data["city_list"] = array('' => 'Select City');	
		$this->data['job_id']='';
		
		if($this->input->get('job_id'))
		{
			$this->data['job_id']=$this->input->get('job_id');
		}
		
		$this->data['industry_menu']=$this->homepagemodel->get_industry_menu();
		$this->data['home_summary']=$this->homepagemodel->get_home_summary();
				
		$this->data["visa_issued_list"]    = $this->signupmodel->visa_issued_list();
		$this->data["license_issued_list"] = $this->signupmodel->license_issued_list();
		
		$this->data["visa_type_list"] = $this->signupmodel->visa_type_list();
		$this->data["cur_job_status_list"] = $this->signupmodel->cur_job_status_list();

		$this->data["industry_list"]    = $this->signupmodel->industries_list();
		$this->data["func_list"]        = array('' => 'Select Function');				
		$this->data["desig_list"] =  array('' => 'Select Designation');

		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_image']        = 'http://seekersgulf.com/assets/img/logo.png';
		$this->data['og_url']          = 'http://seekersgulf.com/jobs/';
								
		$this->data['page_head']= 'Signup';

		$this->load->view('homepage-include/header', $this->data);
		$this->load->view('signup/signup',  $this->data);	
		$this->load->view('homepage-include/footer',  $this->data);		
	}

	function check_email(){

		$this->db->where('username', $this->input->post('username'));
		$query = $this->db->get('pms_candidate');
		$result	=	$query->row();

			if ($query->num_rows() > 0) { //avilable
				$status = array("status" => "1", "candidate_id" => '');
				echo json_encode($status);
			} 
			else { //doesn't exist
				$status = array("status" => "0", "candidate_id" => '');
				echo json_encode($status);
			}	
	}

	function check_mobile()
	{
		$this->db->where('mobile', $this->input->post('mobile'));
		$query = $this->db->get('pms_candidate');
		$result	=	$query->row();
			
			if ($query->num_rows() != 0) { //avilable
				$status = array("status" => "1", "candidate_id" => '');
				echo json_encode($status);
			} 
			else { //doesn't exist
				$status = array("status" => "0");
				echo json_encode($status);
			}
	}
		
	function confirm()
	{
		$this->data['page_title']      = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']        = $this->config->item('company_name');
		$this->data['og_image']        = 'http://seekersgulf.com/assets/img/logo.png';
		$this->data['og_url']          = 'http://seekersgulf.com/jobs/';
		
		$this->data['status']=$this->input->get('ins');
		$this->load->view('homepage-include/header',$this->data);
		$this->load->view('signup/confirm',$this->data);
		$this->load->view('homepage-include/footer',$this->data);
	}
/* - old code, check and remove 

	function save_registration(){

		$this->load->library('upload');
		$this->form_validation->set_rules("first_name","Candidate Name","required");
		$this->form_validation->set_rules("username","Candidate Name","required");

		$id='';
		$row_job_skill=array();
		$course_id='';
		$company_id='';	
		
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->db->where('username', $this->input->post('username'));
			$query = $this->db->get('pms_candidate');
			$row=$query->row_array();
			if(count($row)== 0)
			{
				$id = $this->signupmodel->insert_candidate_from_jobs();
			}else
			{
				$id=$row['candidate_id'];
			}
			
			// create course or take course id from existing
			if($this->input->post('level_id')!='' && $this->input->post('course_name')!='')
			{
				$this->db->where('level_study', $this->input->post('level_id'));
				$this->db->where('course_name', $this->input->post('course_name'));
				$query = $this->db->get('pms_courses');
				
				$row_course=$query->row_array();
				if(count($row_course)== 0)
				{
					$data =array(
						'level_study'=> $this->input->post('level_id'),
						'course_name'=> $this->input->post('course_name'),
					);					
					$this->db->insert('pms_courses', $data);
					$course_id=$this->db->insert_id();
				}else
				{
					$course_id=$row_course['course_id'];
				}
				
				// create education
				if($course_id!='')
				{
					$data =array(
						'level_id'=> $this->input->post('level_id'),
						'course_id'=> $course_id,
						'candidate_id'=> $id,
					);
					$this->db->insert('pms_candidate_education', $data);
				}							
			}

			// create company or take company id from existing	
			if($this->input->post('company')!='')
			{
				$this->db->where('company_name', $this->input->post('company'));
				$query = $this->db->get('pms_company');
				
				$row_company=$query->row_array();
				if(count($row_company)== 0)
				{
					$data =array(
						'company_name'=> $this->input->post('company'),
					);
					$this->db->insert('pms_company', $data);
					$company_id=$this->db->insert_id();
				}else
				{
					$company_id=$row_company['company_id'];									
				}
				// create job profile
				if($company_id!='')
				{
					$data =array(
							'company_id'       => $company_id,
							'organization'     => $this->input->post('company'),
							'designation'      => $this->input->post('designation'),
							'from_date'        => $this->input->post('from_date'),
							'to_date'          => $this->input->post('to_date'),
							'present_job'      => $this->input->post('present_job'),
							'job_cat_id'      => $this->input->post('industry_id'),
							'func_id'      => $this->input->post('func_id'),
							'candidate_id'     => $id,
							);
					$this->db->insert('pms_candidate_job_profile', $data);
				}				
			}
			
			// create contract
			if($this->input->post('cur_ctc')!='' || $this->input->post('exp_ctc')!='' || $this->input->post('notice_period')!='' || $this->input->post('exp_years')!='')
			{
				$this->db->query("delete from pms_candidate_job_search where candidate_id=".$id);				
				$data =array(
				'current_ctc'          => $this->input->post('current_ctc'),
				'expected_ctc'         => $this->input->post('expected_ctc'),
				'notice_period'        => $this->input->post('notice_period'),
				'total_experience'     => $this->input->post('total_experience'),
				'candidate_id'         => $id,
				);
				$this->db->insert('pms_candidate_job_search', $data);	
			}
				
			// upload CV file
			if ($id != '') 
			{ 			
				if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
					{       				
						$config['upload_path'] = '../manage/uploads/cvs/';
						$config['allowed_types'] = 'doc|docx|pdf|txt';
						$config['max_size']	= '0';
						$config['file_name'] = md5(uniqid(mt_rand()));
						$this->upload->initialize($config);	
					
						if ($this->upload->do_upload('cv_file'))
						{
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];					
							$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $id,
								'upload_date' => date('Y-m-d'),
							);
							$this->signupmodel->insert_files($dataArr);
							$cv_file=1;
						}
					}
				
				if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
				{         
					$photo['upload_path'] = '../manage/uploads/photos/';
					$photo['allowed_types'] = 'png|jpg|jpeg|gif';
					$photo['max_size']	= '0';
					$photo['file_name'] = md5(uniqid(mt_rand()));
				
					$this->upload->initialize($photo);
					if ($this->upload->do_upload('photo'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$id);
						$dataArr = array(
							'file_name' => $this->upload_file_name,
							'file_type'=> $this->upload_file_name,
							'candidate_id' => $id
						);
						$this->signupmodel->insert_files($dataArr);
					}
				}
			} 
			redirect('signup/confirm/?ins=1');
//			$status = array("status" => "success", "candidate_id" => $id, "job_id" => $this->input->post('job_id'));
//			echo json_encode($status);
//			exit();
		}		
		else
		{
			$status = array("status" => "false", "candidate_id" => '0', "job_id" => $this->input->post('job_id'));
			echo json_encode($status);
			exit();
		}
		
		$status = array("status" => "false", "candidate_id" => '-1', "job_id" => $this->input->post('job_id'));
		echo json_encode($status);
		exit();
	}
*/

	public function getstate()
	{
		$this->load->model('signupmodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->signupmodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{ 
		$this->load->model('signupmodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->signupmodel->city_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
		
	function save_registration()
	{
		$this->load->library('upload');
		//print_r($_POST);
		//exit();
		$this->form_validation->set_rules("first_name","First Name","required");
		$this->form_validation->set_rules("username","Username / Email","required");
		//echo date("Y-m-d",strtotime($this->input->post('date_of_birth')));
		//exit();
		$id='';
		$row_job_skill=array();
		$course_id='';
		$company_id='';	
		
		if ($this->form_validation->run() == TRUE)
		{ 
			$this->db->where('username', $this->input->post('username'));
			$query = $this->db->get('pms_candidate');
			$row=$query->row_array();
			
			if(count($row)== 0)
			{
				$age=$this->input->post('age');
				
				$age='';
				
				if($this->input->post('date_of_birth')!='' && $this->input->post('date_of_birth')!='0000-00-00') 
				$age = $this->get_age($this->input->post('date_of_birth'));
				
				$data =array(
				'username'              => $this->input->post('username'),
				'password'              => md5($this->input->post('password')),
				'first_name'            => $this->input->post('first_name'),
				'last_name'             => '',	
				'reg_date'              => date("Y-m-d"),			
				'title' 				=> $this->input->post('title'),
				'gender'                => $this->input->post('gender'),
				'marital_status' 		=> $this->input->post('marital_status'),
				'age' 				    => $age,
				'date_of_birth'         => date("Y-m-d",strtotime($this->input->post('date_of_birth'))),
				
				'mobile'                => $this->input->post('mobile_prefix_code').''. $this->input->post('mobile'),
				'mobile_prefix'         => $this->input->post('mobile_prefix'),				
				
				'mobile1'                =>  $this->input->post('mobile1'),
				'mobile_prefix1'         => $this->input->post('mobile_prefix1'),	
				'alternate_email'         => $this->input->post('alternate_email'),					
				
				'nationality'           => $this->input->post('nationality'),				
				'city_id'               => $this->input->post('city_id'),
				
				'passportno'            => $this->input->post('passportno'),
				'passport_type'         => $this->input->post('passport_type'), // ECR or ECNR
				'issued_date'           => $this->input->post('issued_date'),
				'expiry_date'			=> $this->input->post('expiry_date'),				
				'place_of_issue'		=> $this->input->post('place_of_issue'),
				'passport_nationality'	=> $this->input->post('passport_nationality'),
				
				'visa_type_id'          => $this->input->post('visa_type_id'),
				'visa_nationality'      => $this->input->post('visa_nationality'),
				'visa_start_date'       => $this->input->post('visa_start_date'),
				'visa_end_date'         => $this->input->post('visa_end_date'),	
				'release_noc'           => 	$this->input->post('release_noc'),	

				'driving_license'           => $this->input->post('driving_license'),
				'driving_license_country'   => $this->input->post('driving_license_country'),
				'linkedin_url'	        => $this->input->post('linkedin_url'),   
				'cur_job_status'        => $this->input->post('cur_job_status'),				
				
				'device_type'           => '',
				'job_folder_id'         => 2,
				'lead_opportunity'      => 2,
				'lead_source'           => 2,
				'reg_status'            => 1,
				'lead_opportunity'      => 1,
				'allow_mobile'          => 1
				);
				//print_r($data);
				//exit();
				$id = $this->signupmodel->insert_candidate_from_jobs($data);
			
				$this->db->query("delete from pms_candidate_job_profile where candidate_id=".$id); // delete any unwated records here before.
				$job_data =array(
				'job_cat_id'              => $this->input->post('job_cat_id'),
				'func_id'              => $this->input->post('func_id'),
				'desig_id'            => $this->input->post('desig_id'),				
				'organization'            => $this->input->post('organization'),
				'total_experience'            => $this->input->post('total_experience'),
				'candidate_id'             => $id,					
				);
				$this->db->insert('pms_candidate_job_profile', $job_data);	
				// take skills from this job 
				// add job application
				
				// update job search form
				$this->db->query("delete from pms_job_apps where candidate_id=".$id); // delete any unwated records here before.
			if($this->input->post('total_experience')!='' || $this->input->post('expected_ctc')!='')
			{
				$this->db->query("delete from pms_candidate_job_search where candidate_id=".$id);				
				$data =array(
				'expected_ctc'         => $this->input->post('expected_ctc'),
				'total_experience'     => $this->input->post('total_experience'),
				'candidate_id'         => $id,
				);
				$this->db->insert('pms_candidate_job_search', $data);	
			}
				
			
				// upload CV & Photo files
				if ($id != '') 
				{ 			
					if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
					{       				
							$config['upload_path'] = 'rms/uploads/cvs/';
							$config['allowed_types'] = 'doc|docx|pdf|txt';
							$config['max_size']	= '0';
							$config['file_name'] = md5(uniqid(mt_rand()));
							$this->upload->initialize($config);	
						
							if ($this->upload->do_upload('cv_file'))
							{
								$this->upload_file_name='';
								$data =  $this->upload->data();	
								$this->upload_file_name=$data['file_name'];					
								$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$id);
								$dataArr = array(
									'file_name' => $this->upload_file_name,
									'file_type'=> $this->upload_file_name,
									'candidate_id' => $id,
									'upload_date' => date('Y-m-d'),
								);
								$this->signupmodel->insert_files($dataArr);
								$cv_file=1;
							}
						}
					
					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
					{         
						$photo['upload_path'] = 'rms/uploads/photos/';
						$photo['allowed_types'] = 'png|jpg|jpeg|gif';
						$photo['max_size']	= '0';
						$photo['file_name'] = md5(uniqid(mt_rand()));
					
						$this->upload->initialize($photo);
						if ($this->upload->do_upload('photo'))
						{
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];					
							$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $id
							);
							$this->signupmodel->insert_files($dataArr);
						}
					}
					// create session
					$query = $this->db->query("SELECT candidate_id, username, password,first_name,last_name from pms_candidate where candidate_id=".$id);
					if ($query->num_rows() > 0)
					{
					   $row = $query->row_array();
					   $_SESSION['candidate_session']=$row['candidate_id'];
					   $_SESSION['username']=$row['username'];
					   $_SESSION['password']=$row['password'];
					   $_SESSION['candidate_first_name']=$row['first_name'];
					   $_SESSION['candidate_last_name']=$row['last_name'];
					   
					   if($this->input->post('job_id')!='')
					   {
								redirect('home/job_details?job_id='.$this->input->post('job_id'));
					   }else
					   {
							redirect('candidates_all/summary?registation=success');
					   }
					}else
					{
						redirect('signup/confirm/?ins=1');
					}		
				} 

			}else
			{
				redirect('signup/confirm/?ins=1');
			}
		}		
		else
		{
			$status = array("status" => "false", "candidate_id" => '0', "job_id" => 1);
			echo json_encode($status);
			exit();
		}
		
		$status = array("status" => "false", "candidate_id" => '-1', "job_id" => 1);
		echo json_encode($status);
		exit();
	}

	function get_age($birthday){ 
		$age = strtotime($birthday);
		
		if($age === false){ 
			return false; 
		} 
		
		list($y1,$m1,$d1) = explode("-",date("Y-m-d",$age)); 
		
		$now = strtotime("now"); 
		
		list($y2,$m2,$d2) = explode("-",date("Y-m-d",$now)); 
		
		$age = $y2 - $y1; 
		
		if((int)($m2.$d2) < (int)($m1.$d1)) 
			$age -= 1; 
			
		return $age; 
	} 
			
}
