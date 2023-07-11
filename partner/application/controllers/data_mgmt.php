<?php 
class Data_mgmt extends CI_Controller {

	function Data_mgmt()
	{
		parent::__construct();
		$this->load->library('csvimport');
	  	if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		if(!isset($_SESSION['reg_status']) || $_SESSION['reg_status']=='')$_SESSION['reg_status']=1;
		
	}
	
	function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folderbreak_up
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
   }
	
	function index()
	{	
		$this->load->library('pagination');
		$this->data['limit']='';
		$this->data['searchterm']='';
		$this->data['search_name']='';
		$this->data['search_email']='';
		$this->data['search_mobile']='';
		$this->data['branch_id']='';
		$this->data['start']=0;
		$this->data['reg_status']=$_SESSION['reg_status'];
		$this->data['skills']='';
		$this->data['level_id']='';
		$this->data['course_id']='';
		$this->data['spcl_id']='';
		$this->data['rows']='';
		$this->load->model('datamgmtmodel');
		//print_r($_GET);exit;

		if($this->input->get('limit')!='')
		{
			$this->data['limit']=$this->input->get("limit");
		}
		else
		{
			$this->data['limit'] =100;
		}

		if($this->input->get('sort_by')!='')
		{
			$this->data['sort_by']=$this->input->get("sort_by");
		}
		else
		{
			$this->data['sort_by'] = 'asc';
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['start']=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['rows']=$this->input->get("rows");
		}
		
		if($this->input->get('search_name'))
		{
			$this->data['search_name']=$this->input->get('search_name');
		}

		if($this->input->post('search_name'))
		{
			$this->data['search_name']=$this->input->post('search_name');
		}

		if($this->input->get('search_email'))
		{
			$this->data['search_email']=$this->input->get('search_email');
		}

		if($this->input->post('search_email'))
		{
			$this->data['search_email']=$this->input->post('search_email');
		}

		if($this->input->get('search_mobile'))
		{
			$this->data['search_mobile']=$this->input->get('search_mobile');
		}

		if($this->input->post('search_mobile'))
		{
			$this->data['search_mobile']=$this->input->post('search_mobile');
		}

		if($this->input->get('branch_id'))
		{
			$this->data['branch_id']=$this->input->get('branch_id');
		}

		if($this->input->post('branch_id'))
		{
			$this->data['branch_id']=$this->input->post('branch_id');
		}
		
		if($this->input->get('skills'))
		{
			
			
			$this->data['skills']	=	$this->input->get('skills');
		}	
		
		if($this->input->post('skills'))
		{

			$this->data['skills']	=	$this->input->post('skills');
		}	
//education level		
		if($this->input->get('level_id'))
		{
			
			
			$this->data['level_id']	=	$this->input->get('level_id');
		}	
		
		if($this->input->post('level_id'))
		{

			$this->data['level_id']	=	$this->input->post('level_id');
		}
//course
		if($this->input->get('course_id'))
		{
			
			
			$this->data['course_id']	=	$this->input->get('course_id');
		}	
		
		if($this->input->post('course_id'))
		{

			$this->data['course_id']	=	$this->input->post('course_id');
		}
		
//specilaisation 
		if($this->input->get('spcl_id'))
		{
			
			
			$this->data['spcl_id']	=	$this->input->get('spcl_id');
		}	
		
		if($this->input->post('spcl_id'))
		{

			$this->data['spcl_id']	=	$this->input->post('spcl_id');
		}
		
		if($this->input->get("lreg_status")!='')
		{
			$this->data['reg_status']=$this->input->get("lreg_status");
			$_SESSION['reg_status']=$this->input->get("lreg_status");
		}
		
		if($this->input->post("reg_status")!='')
		{
			$this->data['reg_status']=$this->input->post("reg_status");
			$_SESSION['reg_status']=$this->input->post("reg_status");
		}		
		
		$this->data['total_rows']= $this->datamgmtmodel->record_count($this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['reg_status'],$this->data['branch_id'],$this->data['skills'],$this->data['level_id'],$this->data['course_id'],$this->data['spcl_id']);
		$this->data['cur_page']=$this->router->class;
		
		
		
		$config['base_url'] = $this->config->item('base_url')."data_mgmt/?sort_by=".$this->data['sort_by']."&limit=".$this->data['limit']."&search_name=".$this->data['search_name']."&search_email=".$this->data['search_email']."&search_mobile=".$this->data['search_mobile']."&"."lreg_status=".$this->data['reg_status']."&branch_id=".$this->data['branch_id']."&skills=".$this->data["skills"]."&level_id=".$this->data["level_id"]."&course_id=".$this->data["course_id"]."&spcl_id=".$this->data["spcl_id"];
		
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$this->data['limit'];
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
	
		$this->data["records"] = $this->datamgmtmodel->get_list($this->data['start'],$this->data['limit'],$this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['sort_by'],$this->data['reg_status'],$this->data['branch_id'],$this->data['skills'],$this->data['level_id'],$this->data['course_id'],$this->data['spcl_id']);
//print_r($this->data["records"]);exit;
		$this->load->model('datamgmtmodel'); 
		
		$this->data['page_head']= 'Manage Candidates';		
		$this->data['formdata']=array('admin_id' =>'');
		
	// Technical Skilss
		$this->load->view('include/header',$this->data);
		$this->load->view('data_mgmt/candidateslist',$this->data);				
		$this->load->view('include/footer',$this->data);
	}
	
	function profile_data()
	{	
		$this->load->model('datamgmtmodel');
		$this->load->model('coursemodel');
		
		$this->data['cur_page']=$this->router->class;
		$this->data['formdata']=array(
			'title' => '',
			'first_name' => '',
			'last_name' => '',
			'username'=> '',
			'password'=> '',
			'cpassword'=> '',	
			'gender' => '1' ,
			'marital_status' => '',	
			'mobile' => '',	
			'date_of_birth' => '',
			'age' => '',
			'children' => '',
			'course_id' => '',
			'lead_source' => '',
			'reg_status' => '1',
			'lead_opportunity' => '1',
			'branch_id' => '',
			'level_study' => '',
			'admin_id' => '',
		);
		
		$this->data["edu_course_list"] = $this->datamgmtmodel->edu_course_list();
		$this->data["level_list"] = $this->coursemodel->fill_levels();
		$this->data["branch_list"] = $this->datamgmtmodel->branch_list();
		$this->data['admin_users_lists']= $this->datamgmtmodel->get_admin_users_lists();
		
		$this->data['page_head']= 'Add Candidate';
		$this->load->view('include/header',$this->data);
		$this->load->view('data_mgmt/profile_data',$this->data);	
		$this->load->view('include/footer',$this->data);
	}

// Edit Cnadidate
	

	function process_completed($candidateId)
	{
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->process_completed($candidateId);
		redirect('data_mgmt/?upd=1');
	}

	function addCandidate(){
		$this->load->model('datamgmtmodel');
		
		$this->form_validation->set_rules("first_name","Candidate Name","required");
		$this->form_validation->set_rules('check_dups', 'Email Address', 'callback_check_dups');

		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->datamgmtmodel->insert_candidate_record();
			if ($id != '') { //success
				$this->session->set_flashdata('msg','Candidate added successfully!');
				$status = array("STATUS" => "1", "SUCCESS_ID" => $id);
				echo json_encode($status);
			} 
			else { //failure
				$status = array("STATUS" => "0");
				echo json_encode($status);
			}
		}else
		{
			$status = array("STATUS" => "2", "SUCCESS_ID" => '0');
			echo json_encode($status);
		}
	}
			
	function addCandidateDetail($candidateId){
		$this->load->model('datamgmtmodel');
		$id  = $this->datamgmtmodel->insert_contact_detail($candidateId);
		$uid = $this->datamgmtmodel->update_contact_detail($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	function editCandidate(){
		$candidateId = $this->input->post('candidateId');
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_candidate_record($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	
/* updating candidate profile */
	function profile_entry($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		
		$this->data['candidate_id'] = $id;
		$this->data['formdata']=array(
			'title' => '',
			'first_name' => '',
			'last_name' => '',
			'username'=> '',
			'password'=> '',
			'cpassword'=> '',	
			'gender' => '1' ,
			'marital_status' => '',	
			'mobile' => '',		
			'date_of_birth' => '',
			'age' => '',
			'children' => '',
			'course_id' => '',
			'lead_source' => '',
			'lead_opportunity' => '1',
			'branch_id' => '',
			'level_study' => '',
		);
		$this->data['page_head']= 'Edit Profile';

		$this->load->model('datamgmtmodel');  

		
		$this->data["formdata"] = $this->datamgmtmodel->get_single_record($id);
		$this->data["formdata"]['profile_list'] = $this->datamgmtmodel->profile_list($id);

		$path = '../js/ckfinder';
		$width = '700px';
		$height = '900px';
		$this->editor($path, $width,$height);
						

		$this->load->view('include/header',$this->data);
		$this->load->view('data_mgmt/profile_entry',$this->data);	
		$this->load->view('include/footer',$this->data);
	}	
	
	// step 1
	function update_profile_personal($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_personal($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 2
	function update_profile_address($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_address($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 3
	function update_profile_education($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_education($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 4
	function update_profile_profession($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_profession($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 5
	function update_profile_language($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_language($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}

	// step 6
	function update_profile_tech_skills($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_tech_skills($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
		
	// step 7
	function update_profile_certification($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_certification($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}

	// step 8
	function update_profile_projects($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_projects($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
		
	// step 9
	function update_profile_sports($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_sports($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 10
	function update_profile_social($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->update_profile_social($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
										
/* end here 10 functions */		

/* here is to update into candidate database */
	function profile_breakup($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		
		$this->data['candidate_id'] = $id;
		$this->data['formdata']=array(
			'title' => '',
			'first_name' => '',
			'last_name' => '',
			'username'=> '',
			'password'=> '',
			'cpassword'=> '',	
			'gender' => '1' ,
			'marital_status' => '',	
			'mobile' => '',		
			'date_of_birth' => '',
			'age' => '',
			'children' => '',
			'address' => '',
			'course_id' => '',
			'lead_source' => '',
			'lead_opportunity' => '1',
			'branch_id' => '',
			'level_study' => '',
		);
		$this->data['page_head']= 'Edit Profile';

		$this->load->model('datamgmtmodel');  
		$this->load->model('locationmodel');  
		$this->load->model('cittymodel');  
		$this->load->model('statmodel'); 
		$this->load->model('countrymodel');   

		$this->data["formdata"] = $this->datamgmtmodel->get_single_record($id);
		$this->data["city_list"] = $this->cittymodel->city_list_by_state($this->data['formdata']['state']);
		$this->data["state_list"] = $this->statmodel->state_list($this->data['formdata']['nationality']);		
		$this->data["location_list"] = $this->locationmodel->location_list($this->data['formdata']['city_id']); 
		$this->data["country_list"] = $this->countrymodel->country_list_by_state_city_location();
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->datamgmtmodel->edu_level_list();
		$this->data["college_list"] = $this->datamgmtmodel->college_list();
		$this->data["edu_years_list"] = $this->datamgmtmodel->edu_years_list();
		$this->data["edu_course_list"] = $this->datamgmtmodel->edu_course_list();
		$this->data["edu_spec_list"] = $this->datamgmtmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->datamgmtmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->datamgmtmodel->edu_course_type_list();
		$this->data["industry_list"] = $this->datamgmtmodel->industry_list();
		$this->data["functional_list"] = $this->datamgmtmodel->functional_list();
		$this->data["currecy_list"] = $this->datamgmtmodel->currency_list();
		$this->data["years_list"] = $this->datamgmtmodel->years_list();
		$this->data["months_list"] = $this->datamgmtmodel->months_list();						
		$this->data['lang_list']=$this->datamgmtmodel->get_language_set();
		$this->data['skill_list']=$this->datamgmtmodel->get_parent_skills();
		$this->skills=array();
		$this->data['cerifications']=$this->datamgmtmodel->get_cert();
		$languages=array();
		
		$this->data['lang_list']=$this->datamgmtmodel->get_language_set();
		$candidate_certifications =$this->datamgmtmodel->candidate_languages($id);
				
		$this->data["formdata"]['profile_list'] = $this->datamgmtmodel->profile_list($id);

		$path = '../js/ckfinder';
		$width = '700px';
		$height = '900px';
		$this->editor($path, $width,$height);
						

		$this->load->view('include/header',$this->data);
		$this->load->view('data_mgmt/profile_breakup',$this->data);	
		$this->load->view('include/footer',$this->data);
	}	

/* here is to update into candidate database */
	function profile_approval($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		
		$this->data['candidate_id'] = $id;
		
		$this->data['page_head']= 'Edit Profile';

		$this->load->model('datamgmtmodel');  
		$this->load->model('locationmodel');  
		$this->load->model('cittymodel');  
		$this->load->model('statmodel'); 
		$this->load->model('countrymodel');   

		$this->data["personal"] = $this->datamgmtmodel->get_single_record($id);
		$this->data['address'] = $this->datamgmtmodel->get_address($id);
		$this->data['education'] = $this->datamgmtmodel->education_list($id);
		$this->data['job_details'] = $this->datamgmtmodel->get_job_details($id);
		$this->data['language_skills'] = $this->datamgmtmodel->candidate_languages($id);
		$this->data['tech_skills'] = $this->datamgmtmodel->candidate_skills($id);
		$this->data['certification'] = $this->datamgmtmodel->candidate_certifications($id);
		$this->data['projects'] = $this->datamgmtmodel->candidate_projects($id);
		$this->data['sports'] = $this->datamgmtmodel->candidate_sports($id);
		$this->data['social'] = $this->datamgmtmodel->candidate_social($id);
		$this->data['profile_status'] = $this->datamgmtmodel->get_profile_status($id);
		$this->data['profile_assessment'] = $this->datamgmtmodel->get_profile_assessment($id);
		
		//print_r($this->data['profile_status']);
		//exit();

		// get all details just like above , address, education, profession, etc.
		// setup an approval status for profile_assess table
		// update language, ielts, oet, pte etc 
		// create a table for all english fields if possible
		// update the candidate tablee with assessment on all - thikn more. 
		
		
		$this->data["profile_list"] = $this->datamgmtmodel->profile_list($id);

		$path = '../js/ckfinder';
		$width = '700px';
		$height = '900px';
		$this->editor($path, $width,$height);
						

		$this->load->view('include/header',$this->data);
		$this->load->view('data_mgmt/profile_approve',$this->data);	
		$this->load->view('include/footer',$this->data);
	}	
	
	function editCandidateDetail($candidateId){
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->edit_contact_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}

	function addEducationDetail($candidateId){
		$this->load->model('datamgmtmodel');
		$id  = $this->datamgmtmodel->insert_education_detail($candidateId);
		$view	=	$this->educationDetails($candidateId);
       
        if ($id > 0) { //success
            $status = array("STATUS" => "1","VIEW"=>$view);
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}

//EDUCATION DETAILS
	function educationDetails($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('datamgmtmodel');
		
		
		$edu_level = $this->datamgmtmodel->edu_level_list();
		
		$course = $this->datamgmtmodel->edu_course_list();

		$spec = $this->datamgmtmodel->edu_spec_list();


		
		$results = $this->datamgmtmodel->get_education_details($id);
		$form_data	=	array();
		
		foreach($results as $result)
		{ 
			$form_data[]	=	array(
								  'level_name'	=>	isset($edu_level[$result["level_id"]])?$edu_level[$result["level_id"]]:"",
								  'course_name'	=>	isset($course[$result["course_id"]])?$course[$result["course_id"]]:"",
								 'spec_name'	=>	isset($spec[$result["spcl_id"]])?$spec[$result["spcl_id"]]:"",
								 'grade'	=>	$result["grade"],
								 
								 'eucation_id'	=>	$result["eucation_id"],
								  );	

		}
		$this->data["form_data"]	=	$form_data;		
		$education_details_view	=	$this->load->view('candidates_all/education_details',$this->data,true);
		return $education_details_view;
	}

	function addJobDetail($candidateId)
	{
		$this->load->model('datamgmtmodel');
		$id  = $this->datamgmtmodel->insert_job_detail($candidateId);
		$uid = $this->datamgmtmodel->update_job_detail($candidateId);
		$view	=	$this->jobDetails($candidateId);
       
        if ($id > 0) { //success
            $status = array("STATUS" => "1","VIEW"=>$view);
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }
	}

//JOB DETAILS
	function jobDetails($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('candidateallmodel');
		
		$industry_list = $this->candidateallmodel->industry_list();
		$functional_list = $this->candidateallmodel->functional_list();

		
		$results = $this->candidateallmodel->get_job_details($id);
		$form_data	=	array();
		
		foreach($results as $result)
		{ 
			$form_data[]	=	array(
								  'job_profile_id'	=>	$result["job_profile_id"],
								  'industry'	=>	isset($industry_list[$result["job_cat_id"]])?$industry_list[$result["job_cat_id"]]:"",
								  'function'	=>	isset($functional_list[$result["func_id"]])?$functional_list[$result["func_id"]]:"",
								
								 'organization'	=>	$result["organization"],
								 
								 'designation'	=>	$result["designation"],
								  );	

		}
		$this->data["form_data"]	=	$form_data;
		
		
		$job_details_view	=	$this->load->view('candidates_all/job_details',$this->data,true);
		return $job_details_view;
	}
	
	function editLanguageDetail($candidateId)
	{
		$this->load->model('datamgmtmodel');
        $this->datamgmtmodel->edit_language_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function editSkillDetail($candidateId)
	{ 
		$this->load->model('datamgmtmodel');
	 	$id  = $this->datamgmtmodel->insert_skill_details($candidateId);
		
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}

	function editCertificateDetail($candidateId)
	{ 
		$this->load->model('datamgmtmodel');
		 $id  = $this->datamgmtmodel->insert_cert_details($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}	

	function addProjects($candidateId)
	{ 
		$this->load->model('datamgmtmodel');
	 	$id  = $this->datamgmtmodel->add_projects($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}	

	function addSports($candidateId)
	{ 
		$this->load->model('datamgmtmodel');
	 	$id  = $this->datamgmtmodel->add_sports($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}

	function addSocial($candidateId)
	{ 
		$this->load->model('datamgmtmodel');
	 	$id  = $this->datamgmtmodel->add_social($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}	

	function update_profile_status($candidateId)
	{
		$this->load->model('datamgmtmodel');
	 	$id  = $this->datamgmtmodel->update_profile_status($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}

	function update_profile_assessment($candidateId)
	{
		$this->load->model('datamgmtmodel');
	 	$id  = $this->datamgmtmodel->update_profile_assessment($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
		
	function candidate_delete($id)
	{
		$this->load->model('datamgmtmodel');
		if(!empty($id))
		{
			$this->datamgmtmodel->candidate_delete($id);
			redirect('data_mgmt/?del=1');
		}
	}

	function check_dups()
	{
		$this->db->where('username', $this->input->post('username'));
		//if($this->input->post('candidate_id') > 0)	$this->db->where('candidate_id !=', $this->input->post('candidate_id'));
		$query = $this->db->get('pms_candidate');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Username/Email already used.');
			return false;
		}
	}
	
	// Get Locations
	public function getstate()
	{
		$this->load->model('statmodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->statmodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{
		$this->load->model('cittymodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->cittymodel->city_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}


	public function getcourses()
	{
		
		$this->load->model('coursemodel');
		if(isset($_POST['level_study']) && $_POST['level_study']!='' && isset($_POST['int_val']) && $_POST['int_val']!='')
		{
			$data=array();
			$data["course_list"] = $this->coursemodel->get_course_list($_POST['level_study'],$_POST['int_val']);
			$data = array('success' => true, 'course_list' => $data["course_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
		
	public function getlocation()
	{
		$this->load->model('locationmodel');
		if(isset($_POST['city_id']) && $_POST['city_id']!='')
		{
			$data=array();
			$data["location_list"] = $this->locationmodel->location_list($_POST['city_id']);
			$data = array('success' => true, 'location_list' => $data["location_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	// Assign Candidate
	public function assignAdmin()
	{
		$this->load->model('datamgmtmodel');
		$candidatesArr	= $_POST['selectedArr'];
		$adminId		= $_POST['admin_id'];
		for($i=0;$i<count($candidatesArr);$i++){
			$id = $this->datamgmtmodel->assign_admin_user($candidatesArr[$i],$adminId);
		}
		/***************************** send mail to admin user ***************************/
		$data["adminEmail"] = $this->datamgmtmodel->getAdminEmail($adminId);
		$subject = 'Assignment';
		$logopath = base_url('assets/images/logo.png');
		$fb = base_url('assets/images/p_icon8.png');;
		$twtr = base_url('assets/images/p_icon9.png');;
		$lkdn = base_url('assets/images/p_icon10.png');;
		$mail_body		=	'';
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('info@abeservices.biz','Shaijo');
		//$this->email->to($data["adminEmail"]['email']);
		$this->email->to('shaijotm@gmail.com');
		$this->email->subject($subject);
		$this->email->message($mail_body);
		//$this->email->send();
		/*********************************************************************************/
		echo $id;
		exit;
	}

	
	function change_status()
	{
		$this->load->model('datamgmtmodel');
		$candidatesArr	= $_POST['selectedArr'];
		$reg_status		= $_POST['reg_status'];
		//$candidatesArr=array(0 => 10, 1 => 12);
		//$reg_status		= 4;
		for($i=0;$i<count($candidatesArr);$i++)
		{
				$data=array(
				'reg_status'=>  $reg_status
				);
			$this->db->where('candidate_id',$candidatesArr[$i]);
			$this->db->update('pms_candidate',$data);
		}		
		echo '1';
		exit;
	}
	
	function delete_photo($id)
	{
		if(!empty($id))
		{
			$query = $this->db->query("select photo from pms_candidate where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
				{
					unlink('uploads/photos/'.$row['photo']);
				}
				$this->db->query("update  pms_candidate set photo='' where candidate_id=".$id);
			}
			redirect("data_mgmt/summary/".$id."?del_photo=1");
		}else
		{
			redirect("data_mgmt/summary/".$id);
		}
	}

//DELETE PHOTO AJAX
	function photo_delete($candidateId)
	{
		if(!empty($candidateId))
		{
			$query = $this->db->query("select photo from pms_candidate where candidate_id=".$candidateId);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
				{
					unlink('uploads/photos/'.$row['photo']);
				}
				$this->db->query("update  pms_candidate set photo='' where candidate_id=".$candidateId);
			}
			$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        	echo json_encode($status);
		}else
		{
			$status = array("STATUS" => "0");
        	echo json_encode($status);
		}

	}

//DELETE CV AJAX
	function cv_delete($candidateId)
	{
		
		if(!empty($candidateId))
		{
			$query = $this->db->query("select cv_file from pms_candidate where candidate_id=".$candidateId);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
				{	
					unlink('uploads/cvs/'.$row['cv_file']);
				}
				$this->db->query("update  pms_candidate set cv_file='' where candidate_id=".$candidateId);
			}
			$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        	echo json_encode($status);
		}else
		{
			$status = array("STATUS" => "0");
        	echo json_encode($status);
		}
		
	}

}

