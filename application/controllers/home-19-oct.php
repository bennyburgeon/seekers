<?php class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('homemodel');
		$this->load->library('pagination');
	}
	
	function index()
	{
		$start=0;
		$limit=10;
		$rows='';
		$sort_by='desc';
		
		$city_id='';
		$job_cat_id='';
		$func_id='';
		$desig_id='';
		$skill_id='';
		
		$level_id='';
		$job_type_id='';
		$skill_id='';		
		
		$salary_id='';
		$search_text='';
		$total_exp_needed='';
		
		if($this->input->get('limit')!='')
		{
			$limit=$this->input->get("limit");
		}

		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}
		
		if($this->input->get('city_id')!='')
		{
			$city_id=$this->input->get("city_id");
		}

		if($this->input->get('job_cat_id')!='')
		{
			$job_cat_id=$this->input->get("job_cat_id");
		}

		if($this->input->get('func_id')!='')
		{
			$func_id=$this->input->get("func_id");
		}

		if($this->input->get('desig_id')!='')
		{
			$desig_id=$this->input->get("desig_id");
		}
		
		if($this->input->get('skill_id')!='')
		{
			$skill_id=$this->input->get("skill_id");
		}
				
		if($this->input->get('level_id')!='')
		{
			$level_id=$this->input->get("level_id");
		}

		if($this->input->get('job_type_id')!='')
		{
			$job_type_id=$this->input->get("job_type_id");
		}

		if($this->input->get('skill_id')!='')
		{
			$skill_id=$this->input->get("skill_id");
		}

		if($this->input->get('rows')!='')
		{
			$rows=$this->input->get("rows");
		}

		if($this->input->get('salary_id')!='')
		{
			$salary_id=$this->input->get("salary_id");
		}

		if($this->input->get('search_text')!='')
		{
			$search_text=$this->input->get("search_text");
		}

		if($this->input->get('total_exp_needed')!='')
		{
			$total_exp_needed=$this->input->get("total_exp_needed");
		}
		
		$this->data['total_rows']= $this->homemodel->record_count($search_text,$func_id,$job_cat_id,$desig_id,$skill_id,$salary_id,$job_type_id,$level_id,$city_id,$total_exp_needed);

		// paging start from here 
		$config['base_url'] = $this->config->item('base_url')."index.php/home/?sort_by=&$sort_by&limit=$limit&&row=$rows&search_text=$search_text&func_id=$func_id&job_cat_id=$job_cat_id&desig_id=$desig_id&skill_id=$skill_id&job_type_id=$job_type_id&level_id=$level_id&total_exp_needed=$total_exp_needed";
		
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
		$config['num_links'] = 5;
		$config['full_tag_open'] = '<div class="paginations"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = ' <li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active">';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['full_tag_close'] = '</ul></div>';

		$config['anchor_class'] = 'class="page-link"';
		
		$this->pagination->initialize($config);		
		$this->data['pagination']=$this->pagination->create_links();
		// paging ends  here
																						
		$this->data['jobs']=$this->homemodel->get_all_jobs($start,$limit,$sort_by,$search_text,$func_id,$job_cat_id,$desig_id,$skill_id,$salary_id,$job_type_id,$level_id,$city_id,$total_exp_needed);
		$this->data['total_rows']=array();
		$this->data['total_rows']=count($this->data['jobs']);
		$this->data['industry_menu']=$this->homemodel->get_industry_menu();
		//echo '<pre>';
		//print_r($this->data['jobs']);
		//echo '</pre>';
		//exit();
		$this->data['total_jobs']=array();
		$this->data['total_jobs']=count($this->data['jobs']);
		
		$this->data["edu_level_list"] = $this->homemodel->edu_level_list();

		$this->data["nationality_list"] = $this->homemodel->nationality_list();

		$this->data["country_list"] = $this->homemodel->country_list();

		$this->data["industry_list"]    = $this->homemodel->industries_list();
		$this->data["func_list"]        = $this->homemodel->functional_list();
				
		if($job_cat_id!='')
		{
			 $this->data["func_list"]=$this->homemodel->get_functional_by_industry($job_cat_id);
		}else{		
			$this->data["func_list"] = $this->homemodel->all_func_list();
		}

		if($func_id!='')
		{
			 $this->data["desig_list"]=$this->homemodel->get_designation_by_function($func_id);
		}else{		
			$this->data["desig_list"] =  $this->homemodel->all_designation_list();
		}

		if($desig_id!='0' && $desig_id!='')
		{
			 $this->data["skill_list"]=  $this->homemodel->get_skills_by_designation($desig_id);
		}else{		
			$this->data["skill_list"] =  $this->homemodel->all_skills_list();
		}
		
		$this->data["state_list"] = array('' => 'Select State');		
		$this->data["city_list"] = array('' => 'Select City');	
				
		//$this->data["city_list"] = $this->homemodel->city_list();
		
		$this->data["salary_list"] = $this->homemodel->salary_list();
		$this->data["current_nationality_list"] = $this->homemodel->current_nationality_list();
		$this->data["country_intl_code"] = $this->homemodel->country_intl_code();
		
		$this->data["experience"] =$this->homemodel->experience_list();
		
		$this->data['page_head']= 'Jobs Listing';
		
		$this->data['limit']= $limit;
		
		$this->data['city_id']= $city_id;
		$this->data['job_cat_id']= $job_cat_id;
		$this->data['func_id']= $func_id;
		$this->data['desig_id']= $desig_id;
		$this->data['skill_id']= $skill_id;
		
		
		$this->data['level_id']= $level_id;
		$this->data['job_type_id']= $job_type_id;
		$this->data['skill_id']= $skill_id;
		$this->data['salary_id']= $salary_id;
		$this->data['search_text']= $search_text;
		$this->data['total_exp_needed']= $total_exp_needed;
		
		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_image']        = 'http://seekersgulf.com/assets/img/logo.png';
		$this->data['og_url']          = 'http://seekersgulf.com/jobs/';


		$client_id        = $this->config->item('CLIENT_ID');
		$client_secret    = $this->config->item('CLIENT_SECRET');
		$redirect_url     = urlencode($this->config->item('REDIRECT_URL'));
		$base_url         = urlencode($this->config->item('base_url'));
		$scope            = $this->config->item('SCOPES');
		
		$url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&
			client_id=" . $client_id . "&
			redirect_uri=" . $redirect_url . "&scope=" . $scope;
		
		$this->data['linkedin_url']= $url;	
	
		//echo($this->data['linkedin_url']);
		//exit();
					
		$this->data['rows']= $rows;		
	
		$this->data["left_search_form"]=$this->load->view('home/left_search_form',$this->data,true);
		
		$this->load->view('home-include/header', $this->data);
		$this->load->view('home/list_jobs',  $this->data);	
		$this->load->view('home-include/footer',  $this->data);		
	}

	function reg_form()
	{
		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_image']        = 'http://seekersgulf.com/assets/img/logo.png';
		$this->data['og_url']          = 'http://seekersgulf.com/jobs/';
				
		$this->data['jobs']=$this->homemodel->get_all_jobs();
		
		$this->data["edu_level_list"] = $this->homemodel->edu_level_list();
		$this->data["industry_list"] = $this->homemodel->industry_list();
		$this->data["functional_list"] = $this->homemodel->functional_list();
		$this->data["nationality_list"] = $this->homemodel->nationality_list();
		$this->data["current_nationality_list"] = $this->homemodel->current_nationality_list();
		
		$this->data['page_head']= 'Personal Data';
	
		$this->load->view('home-include/header', $this->data);
		$this->load->view('home/reg_form',  $this->data);	
		$this->load->view('home-include/footer',  $this->data);		
	}

	function check_email()
	{
		if($this->input->post('username')!='')
		{
			$this->db->where('username', $this->input->post('username'));
			$query = $this->db->get('pms_candidate');
			$result	=	$query->row();
	
				if ($query->num_rows() != 0) { //avilable
					
					$status = array("STATUS" => "1", "candidate_id" => $result->candidate_id);
					echo json_encode($status);
				} 
				else { //doesn't exist
					$status = array("STATUS" => "0");
					echo json_encode($status);
				}
		}else
		{
			$status = array("STATUS" => "2");
			echo json_encode($status);
		}
	}

	public function get_functional_by_industry()
	{
		$this->load->model('homemodel');
		if(isset($_POST['job_cat_id']) && $_POST['job_cat_id']!='')
		{
			$data=array();
			$data["func_list"] = $this->homemodel->get_functional_by_industry($_POST['job_cat_id']);
			$data = array('success' => true, 'func_list' => $data["func_list"]);
		}else{
			$data=array();
			$data["func_list"] = $this->homemodel->all_func_list();
			$data = array('success' => true, 'func_list' => $data["func_list"]);
		}
		echo json_encode($data);
	}
	

	public function get_designation_by_function()
	{
		$this->load->model('homemodel');
		if(isset($_POST['func_id']) && $_POST['func_id']!='')
		{
			$data=array();
			$data["desig_list"] = $this->homemodel->get_designation_by_function($_POST['func_id']);
			$data = array('success' => true, 'desig_list' => $data["desig_list"]);
		}else{
			$data=array();
			$data["desig_list"] = $this->homemodel->all_designation_list();
			$data = array('success' => true, 'desig_list' => $data["desig_list"]);
		}
		echo json_encode($data);				
	}
	
	public function get_skills_by_designation()
	{
		$this->load->model('homemodel');
		if(isset($_POST['desig_id']) && $_POST['desig_id']!='')
		{
			$data=array();
			$data["skill_list"] = $this->homemodel->get_skills_by_designation($_POST['desig_id']);
			$data = array('success' => true, 'skill_list' => $data["skill_list"]);
		}else{
			$data=array();
			$data["skill_list"] = $this->homemodel->all_skills_list();
			$data = array('success' => true, 'skill_list' => $data["skill_list"]);
		}
		echo json_encode($data);	
		
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
		
	function job_details()
	{
		$id=$this->input->get('job_id');
		$this->data['industry_menu']=$this->homemodel->get_industry_menu();
		$this->data['job']=$this->homemodel->job_details_by_id($id);
		if(!is_array($this->data['job']))exit();

		$this->data["edu_level_list"] = $this->homemodel->edu_level_list();
		$this->data["edu_special_list"] = $this->homemodel->edu_spec_list();
		
		$this->data["industry_list"] = $this->homemodel->industry_list();
		$this->data["functional_list"] = $this->homemodel->functional_list();
		$this->data["nationality_list"] = $this->homemodel->nationality_list();
		$this->data["current_nationality_list"] = $this->homemodel->current_nationality_list();
		$this->data["passport_nationality_list"] = $this->homemodel->passport_nationality_list();
		$this->data["country_intl_code"] = $this->homemodel->country_intl_code();
		
		$this->data["country_list"] = $this->homemodel->country_list_reg();

		$this->data["state_list"] = array('' => 'Select State');		
		$this->data["city_list"] = array('' => 'Select City');	
		
		$this->data["visa_issued_list"] = $this->homemodel->visa_issued_list();
		$this->data["license_issued_list"] = $this->homemodel->license_issued_list();
		
		$this->data["visa_type_list"] = $this->homemodel->visa_type_list();

		$this->data['page_title']      = $this->data['job']['job_title'];
		$this->data['og_site_name']    = strip_tags($this->data['job']['job_title']);
		$this->data['og_title']        = $this->data['job']['job_title'];
		$this->data['og_image']        = 'http://seekersgulf.com/assets/img/logo.png';
		$this->data['og_url']          = $this->config->base_url().'index.php/home/job_details?id='.md5($this->data['job']['job_id']);

		$client_id        = $this->config->item('CLIENT_ID');
		$client_secret    = $this->config->item('CLIENT_SECRET');
		$redirect_url     = urlencode($this->config->item('REDIRECT_URL'));
		$base_url         = urlencode($this->config->item('base_url'));
		$scope            = $this->config->item('SCOPES');
		
		$url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&
			client_id=" . $client_id . "&
			redirect_uri=" . $redirect_url . "&scope=" . $scope;
		
		$this->data['linkedin_url']= $url;	
						
		$this->data["left_reg_form"]=$this->load->view('home/left_reg_form',$this->data,true);

		$this->load->view('home-include/header',$this->data);
		$this->load->view('home/job_details',$this->data);
		$this->load->view('home-include/footer',$this->data);
	}
	public function getstate()
	{
		$this->load->model('homemodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->homemodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{ 
		$this->load->model('homemodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->homemodel->city_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	function confirm()
	{
		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_image']        = 'http://seekersgulf.com/assets/img/logo.png';
		$this->data['og_url']          = 'http://seekersgulf.com/jobs/';
		
		$this->data['industry_menu']=$this->homemodel->get_industry_menu();
		
		$this->data['prstatus']='applied';
		$this->load->view('home-include/header',$this->data);
		$this->load->view('home/confirm',$this->data);
		$this->load->view('home-include/footer',$this->data);
	}
		
	function save_registration()
	{

		$this->load->library('upload');
		
		$this->form_validation->set_rules("first_name","First Name","required");
		$this->form_validation->set_rules("username","Username / Email","required");

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
				//$age=$this->input->post('age');
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
					
					'mobile'                => $this->input->post('mobile'),
					'mobile_prefix'         => $this->input->post('mobile_prefix'),				
	
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
	
					'cur_job_status'        => $this->input->post('cur_job_status'),				
					
					'device_type'           => '',
					'job_folder_id'         => 2,
					'lead_opportunity'      => 2,
					'lead_source'           => 2,
					'reg_status'            => 1,
					'lead_opportunity'      => 1,
					'allow_mobile'          => 1
				);

				$id = $this->homemodel->insert_candidate_from_jobs($data);
			
				// take skills from this job 
				// add job application
				if($this->input->post('job_id')!='')
				{
					$this->db->where('job_id', $this->input->post('job_id'));
					$query = $this->db->get('pms_jobs');
					$row_job=$query->row_array();
		
					$this->db->where('job_id', $this->input->post('job_id'));
					$query = $this->db->get('pms_job_to_skill');
					$row_job_skill=$query->result_array();
					
					// fill skill of the candidate
					foreach($row_job_skill as $key => $val)
					{
						$this->db->query("delete from pms_candidate_to_skills_primary where candidate_id=".$id." and skill_id=".$val['skill_id']);
						$data =array(
							'skill_id'=> $val['skill_id'],
							'candidate_id'=> $id,
						);
						$this->db->insert('pms_candidate_to_skills_primary', $data);	
					}
					
					// check for data
					$query = $this->db->query('SELECT * from pms_job_apps where job_id='.$this->input->post('job_id').' and candidate_id='.$id);
					if($query->num_rows()==0)
					{
						// add an application to the job				
						$data =array(
							'candidate_id'        => $id,
							'applied_on'          => date('Y-m-d'),
							'job_id'              => $this->input->post('job_id'),
							'current_ctc'         => $this->input->post('current_ctc'),
							'expected_ctc'        => $this->input->post('expected_ctc'),
							'notice_period'       => $this->input->post('notice_period'),
							'total_experience'    => $this->input->post('total_experience'),
							'visa_status'         => $this->input->post('visa_status'),
							'release_noc'         => $this->input->post('release_noc'),
							'reason_to_leave'     => $this->input->post('reason_to_leave'),
							'gcc_experience'      => $this->input->post('gcc_experience'),
							'cur_job_status'      => $this->input->post('cur_job_status'),
							'app_status_id'       => 1,
							'admin_id'            => '',
						);
						$this->db->insert('pms_job_apps', $data);	
					}
				}
				
				// update job search form
				$data =array(
					'candidate_id'        => $id,
					'current_ctc'         => $this->input->post('current_ctc'),
					'expected_ctc'        => $this->input->post('expected_ctc'),
					'notice_period'       => $this->input->post('notice_period'),
					'total_experience'    => $this->input->post('total_experience'),
					'reason_to_leave'     => $this->input->post('reason_to_leave'),
					'gcc_experience'      => $this->input->post('gcc_experience'),
					'preferred_location'    => $this->input->post('current_location'),
					'present_location'    => $this->input->post('current_location'),
					
					'immediate_join'      => '',
					'feedback_date'       => '',

					'feedback_general'    => '',
					'feedback_language'   => '',
					'feedback_education'  => '',
					'feedback_salary'     => '',
					'feedback_skills'     => '',
					'feedback_domain'     => '',
					'feedback_industry'   => '',
					'feedback_projects'   => '',
					'feedback_social'     => '',
					'feedback_concepts'   => '',
					'feedback_activities' => '',
					'feedback_vision'     => '',
					'feedback_job_change' => '',
					'feedback_attitude'   => '',
					'feedback_personality'=> '',
					'feedback_interaction'=> '',
					'feedback_team_work'  => '',
					'feedback_corporate_exposure' => '',
					
				);
				$this->db->query("delete from pms_candidate_job_search where candidate_id=".$id);
				$this->db->insert('pms_candidate_job_search', $data);	
	
				// create course or take course id from existing
				/*
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
				*/
				// create company or take company id from existing	
				/*
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
				*/
				
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
								$this->homemodel->insert_files($dataArr);
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
							$this->homemodel->insert_files($dataArr);
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
					   redirect('candidates_all/summary?registation=success');
					}else
					{
						redirect('home/confirm/?ins=1');
					}		
				} 

			}else
			{
				redirect('home/confirm/?ins=1');
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

function apply_jobs_from_login()
	{
		
		if($this->input->get('job_id')!='' && isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
		{
			$query = $this->db->query("SELECT job_id,job_title from pms_jobs where md5(job_id)='".$this->input->get('job_id')."'");			
			$job_details=$query->row_array();
			
		$query = $this->db->query("SELECT * from pms_job_apps where job_id=".$job_details['job_id']." and candidate_id=".$_SESSION['candidate_session']);	
			if($query->num_rows()==0)
			{
				$data =array(
					'candidate_id'        => $_SESSION['candidate_session'],
					'job_id'              => $job_details['job_id'],
					'applied_on'          => date('Y-m-d'),
					'app_status_id'       => 1,
				);
				$this->db->insert('pms_job_apps', $data);	
				$this->db->where('job_id', $this->input->post('job_id'));
				$query = $this->db->get('pms_jobs');
				$row_job=$query->row_array();
				// Email start from here
				$email_array=array(
					'email_to'               =>  $_SESSION['username'],
					//'email_to'               =>  'athiratk21@gmail.com',
					'email_to_name'          =>  $_SESSION['candidate_first_name'],
					'email_cc'               =>  '',
					'email_from'             =>  $this->config->item('email_from'),
					'from_name'              =>  $this->config->item('from_name'),
					'job_title'              =>  $job_details['job_title'],
					'mobile'                 =>  $this->config->item('company_phone'),
					'website'                =>  $this->config->item('company_website'),
					'company_name'           =>  $this->config->item('company_name'),
					'pobox_address'          =>  $this->config->item('powered_by_address'), 
					'telephone'              =>  '',	
					'skype'                  =>  $this->config->item('Skype'),	
					'email_reply_to'         =>  $this->config->item('email_reply_to'),
					'email_reply_to_name'    =>  $this->config->item('email_reply_to_name'),
					'subject'                =>  'Application Received',
					'salutation'             =>  $this->config->item('salutation'),
					'table_head'             =>  $this->config->item('table_head'),
					//'text_before_table'      =>  $text_before_table,
					//'table_rows'             =>  $data_array,
					//'text_after_table'       =>  $text_after_table,					
					'signature_name'         =>  $this->config->item('signature_name'),
					'signature'              =>  $this->config->item('signature'),
					'powered_by'             =>  $this->config->item('powered_by'),
					'powered_by_address'     =>  $this->config->item('powered_by_address'),
					'powered_by_address1'    =>  $this->config->item('powered_by_address1'),
					'powered_by_phone'       =>  $this->config->item('powered_by_phone'),
					'powered_by_email'       =>  $this->config->item('powered_by_email'),
					'powered_by_web'         =>  $this->config->item('powered_by_web'),
					'date'                   =>  date('d-m-Y'),
					'email_template'         =>  'home/email_template_job_application',
				);
					$this->send_email($email_array);
					//Email script end here
					redirect('candidates_all/summary?applied=1');
			}else
			{
				redirect('home');
			}
		}else
		{
			redirect('home');
		}
	}

function send_email($email_array=array())

	{

		$mail_body=$this->load->view($email_array['email_template'], $email_array,true);

		

		//echo $mail_body;

		//exit();

		

		$headers   = '';		

		$headers = "MIME-Version: 1.0\r\n";

		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";

		$headers.= "From: ".$email_array['from_name']." <".$email_array['email_from'].">\r\n";	

	

		if(isset($email_array['email_cc']) && $email_array['email_cc']!='')

		$headers.= "CC: Company Name <".$email_array['email_cc'].">\r\n";

			

//		$headers.= "From: ".$email_array['from_name']." <".$email_array['email_from'].">\r\n";		

		$headers.= "Reply-To: ".$email_array['email_reply_to_name']." <".$email_array['email_reply_to'].">\r\n";

		$headers.= "X-Mailer: PHP/".phpversion()."\r\n";

		mail($email_array['email_to'], $email_array['subject'], $mail_body, $headers);

		//echo $headers;

		

		//echo '<br><br>';

		

		//echo $mail_body;

		

		//exit();

		return 1;

	}
	
	function get_age($birthday)
	{ 
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

	function apply_jobs()
	{
		if($this->input->post('job_id')!='' && isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
		{
			$query = $this->db->query('SELECT * from pms_job_apps where job_id='.$this->input->post('job_id').' and candidate_id='.$_SESSION['candidate_session']);
			if($query->num_rows()==0)
			{
				$data =array(
					'candidate_id'        => $_SESSION['candidate_session'],
					'job_id'              => $this->input->post('job_id'),
					'applied_on'          => date('Y-m-d'),
					'app_status_id'       => 1,
				);
				$this->db->insert('pms_job_apps', $data);	
				redirect('home/confirm/?aplied=1');
			}else
			{
				redirect('home');
			}
		}else
		{
			redirect('home');
		}
	}
}
