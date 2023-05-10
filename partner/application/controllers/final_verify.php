<?php 
class Final_verify extends CI_Controller {
	function final_verify()
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
		//configure base path of ckeditor folder
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
		//$this->data['reg_status']=$_SESSION['reg_status'];
		$this->data['reg_status']='';
		$this->data['skills']='';
		$this->data['level_id']='';
		$this->data['course_id']='';
		$this->data['spcl_id']='';
		$this->data['exp_years']='';
		$this->data['rows']='';
		$this->load->model('finalverificationmodel');
		$this->load->model('coursemodel');
		 

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


		if($this->input->get("job_type")!='')
		{ 
			$this->data['reg_status']=$this->input->get("job_type");
			//$_SESSION['reg_status']=$this->input->get("lreg_status");
		}
		
		if($this->input->post("job_type")!='')
		{ 
			$this->data['reg_status']=$this->input->post("job_type");
			//$_SESSION['reg_status']=$this->input->post("reg_status");
		}		
		
		$this->data['total_rows']= $this->finalverificationmodel->record_count($this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['reg_status'],$this->data['branch_id'],$this->data['skills'],$this->data['level_id'],$this->data['course_id'],$this->data['spcl_id'],$this->data['exp_years']);
		$this->data['cur_page']=$this->router->class;
		
		
		
		$config['base_url'] = $this->config->item('base_url')."final_verify/?sort_by=".$this->data['sort_by']."&limit=".$this->data['limit']."&search_name=".$this->data['search_name']."&search_email=".$this->data['search_email']."&search_mobile=".$this->data['search_mobile']."&"."job_type=".$this->data['reg_status']."&branch_id=".$this->data['branch_id']."&skills=".$this->data["skills"]."&level_id=".$this->data["level_id"]."&course_id=".$this->data["course_id"]."&spcl_id=".$this->data["spcl_id"]."&exp_years=".$this->data["exp_years"];
		
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$this->data['limit'];
		$config['num_links'] = 10;
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
	
		$this->data["records"] = $this->finalverificationmodel->get_list($this->data['start'],$this->data['limit'],$this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['sort_by'],$this->data['reg_status'],$this->data['branch_id'],$this->data['skills'],$this->data['level_id'],$this->data['course_id'],$this->data['spcl_id'],$this->data['exp_years']);
//print_r($this->data["records"]);exit;
		$this->load->model('finalverificationmodel'); 
		
		$this->data['page_head']= 'Manage Candidates';		
		$this->data['formdata']=array('admin_id' =>'');

		
		$this->load->view('include/header',$this->data);
		$this->load->view('final_verify/candidateslist',$this->data);				
		$this->load->view('include/footer',$this->data);
	
	}
		
	function add()
	{	
		$this->load->model('finalverificationmodel');
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
			'lead_opportunity' => '0',
			'branch_id' => '',
			'level_study' => '',
			'admin_id' => '',
			'cv_file'  =>'',
		);
		
		$this->data["edu_course_list"] = $this->finalverificationmodel->edu_course_list();
		$this->data["level_list"] = $this->coursemodel->fill_levels();
		$this->data["branch_list"] = $this->finalverificationmodel->branch_list();
		$this->data['admin_users_lists']= $this->finalverificationmodel->get_admin_users_lists();
		
		$this->data['page_head']= 'Add Candidate';
		$this->load->view('include/header',$this->data);
		$this->load->view('final_verify/addcandidates',$this->data);	
		$this->load->view('include/footer',$this->data);
	}

//AFTER ADD CANDIDATES :-EDITOR FORM
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

		$this->load->model('finalverificationmodel');  

		
		$this->data["formdata"] = $this->finalverificationmodel->get_single_record($id);
		$this->data["formdata"]['profile_list'] = $this->finalverificationmodel->profile_list($id);

		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
						

		$this->load->view('include/header',$this->data);
		$this->load->view('final_verify/profile_entry',$this->data);	
		$this->load->view('include/footer',$this->data);
	}
	
	function addCandidate(){
		$this->load->model('finalverificationmodel');
		$this->load->library('upload');
		$this->form_validation->set_rules("first_name","Candidate Name","required");
		$this->form_validation->set_rules('check_dups', 'Email Address', 'callback_check_dups');

		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->finalverificationmodel->insert_candidate_record();
			if ($id != '') { 
			
					
				if(isset($_FILES['cv_file'])){
					if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
					{       				
						$config['upload_path'] = 'uploads/cvs/';
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
							$this->finalverificationmodel->insert_files($dataArr);
									$cv_file=1;
						}
					}
				}
			
				//success
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

	
	function loadContacthtml($id) {
        $this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["state_list"] 		= array(''=>'Select State'); //$this->statemodel->state_list();
		$this->data["city_list"] 		= array(''=>'Select City'); //$this->citymodel->city_list();	
        $this->data["location_list"] 	= array(''=>'Select Location');//$this->locationmodel->location_list();
		$this->data["religion_list"]    = $this->finalverificationmodel->religion_list();

		$this->data['formdata']=array(
				'address' =>'',
				'mobile_prefix' =>'',
				'mobile' => '',
				'land_prefix' =>'',
				'land_phone' =>'',
				'work_prefix' => '',
				'workphone' =>'',
				'fax_prefix'=> '',
				'fax' => '',
				'zipcode' =>'',
				'nationality'=> '',
				'state' => '',
				'city_id' =>'',
				'current_location' =>'',
				'religion_id' =>'',

		);
        $this->load->view('final_verify/addcontactdetail', $this->data);
    }
	
	function skip_step2($candidateId){
		$this->load->model('finalverificationmodel');
		//$this->finalverificationmodel->insert_contact_detail_skip($candidateId);		
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}

	function step_back($candidateId){
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
		
	function addCandidateDetail($candidateId){
		$this->load->model('finalverificationmodel');
		$id  = $this->finalverificationmodel->insert_contact_detail($candidateId);
		$uid = $this->finalverificationmodel->update_contact_detail($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	function loadPassporthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->load->model('visatypemodel');
		$this->data["formdata"]=$this->finalverificationmodel->get_passport_details($id);
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->finalverificationmodel->country_list();
		$this->load->view('final_verify/addpassportdetail', $this->data);
	}
	
	function skip_step3($candidateId){
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function addPassportDetail($candidateId){
		$this->load->model('finalverificationmodel');
		$uid = $this->finalverificationmodel->update_passport_detail($candidateId);
		$status = array("STATUS" => "1");
		echo json_encode($status);
	}
	
	function loadEducationhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->load->model('countrymodel');
		
		$this->data['education']=array(
				'level_id'=> 0,
				'course_id' => 0,
				'spcl_id'=> 0,
				'univ_id' => 0,
				'edu_year' => '',
				'edu_country' => 0,
				'course_type_id' => 0,
				'arrears' => '',
				'absesnse' => '',
				'repeat' => '',
				'year_back' => '',
				'mark_percentage' => '',
				'grade' => ''
				);
				
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->finalverificationmodel->edu_level_list();
		$this->data["edu_years_list"] = $this->finalverificationmodel->edu_years_list();
		$this->data["edu_course_list"] = $this->finalverificationmodel->edu_course_list();
		$this->data["edu_spec_list"] = $this->finalverificationmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->finalverificationmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->finalverificationmodel->edu_course_type_list();
		$this->load->view('final_verify/addeducationdetail',$this->data);
	}
	
	function skip_step4($candidateId){
		$this->load->model('finalverificationmodel');
		//$this->finalverificationmodel->insert_education_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function addEducationDetail($candidateId){
		$this->load->model('finalverificationmodel');
		$id  = $this->finalverificationmodel->insert_education_detail($candidateId);
		$view	=	$this->educationDetails($candidateId);
       
        if ($id > 0) { //success
            $status = array("STATUS" => "1","VIEW"=>$view);
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	function loadJobhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->data['formdata']=array(
				'organization'=> '',
				'designation' => '',
				'job_cat_id'=> '',
				'func_id' => '',
				'responsibility' => '',
				'from_date' => '',
				'to_date' => '',
				'monthly_salary' => '',
				'currency_id' => '',
				'present_job' => '',
				'exp_years' => '',
				'exp_months' =>'',
				'skills' => ''
		);
		//employment
		$this->data["industry_list"] = $this->finalverificationmodel->industry_list();
		$this->data["functional_list"] = $this->finalverificationmodel->functional_list();
		$this->data["currecy_list"] = $this->finalverificationmodel->currency_list();
		$this->data["years_list"] = $this->finalverificationmodel->years_list();
		$this->data["months_list"] = $this->finalverificationmodel->months_list();
		$this->load->view('final_verify/addjobdetail', $this->data);
	}
	
	function skip_step5($candidateId){
		$this->load->model('finalverificationmodel');
		//$this->finalverificationmodel->insert_job_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	function skip_step1($candidateId){
		$this->load->model('finalverificationmodel');
		//$this->finalverificationmodel->insert_job_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}	
	function addJobDetail($candidateId)
	{
		$this->load->model('finalverificationmodel');
		$id  = $this->finalverificationmodel->insert_job_detail($candidateId);
		$uid = $this->finalverificationmodel->update_job_detail($candidateId);
		$view	=	$this->jobDetails($candidateId);
       
        if ($id > 0) { //success
            $status = array("STATUS" => "1","VIEW"=>$view);
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }
	}
	
	function loadFilehtml($id)
	{
		if($id=='')exit();
	
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->load->view('final_verify/addfiledetail', $this->data);
	}

	// upload files from summary page.
	function upload_cv_photo($candidate_id)
	{
		$this->table_name='pms_candidate';
		$this->load->model('finalverificationmodel');
		$this->load->library('upload');
		$candidate_id = $this->input->post('candidate_id');	
		if($candidate_id!='')
		{
			if(isset($_FILES['cv_file'])){
				if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
				{       				
					$config['upload_path'] = 'uploads/cvs/';
					$config['allowed_types'] = 'doc|docx|pdf|txt';
					$config['max_size']	= '0';
					$config['file_name'] = md5(uniqid(mt_rand()));
					$this->upload->initialize($config);	
				
					if ($this->upload->do_upload('cv_file'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$dataArr = array(
							'file_name' => $this->upload_file_name,
							'file_type'=> $this->upload_file_name,
							'candidate_id' => $candidate_id
						);
						$this->finalverificationmodel->insert_files($dataArr);
					}
				}
			}
			
			if(isset($_FILES['photo']))
			{	
				if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
				{         
					$photo['upload_path'] = 'uploads/photos/';
					$photo['allowed_types'] = 'png|jpg|jpeg|gif';
					$photo['max_size']	= '0';
					$photo['file_name'] = md5(uniqid(mt_rand()));
				
					$this->upload->initialize($photo);
					if ($this->upload->do_upload('photo'))
					{
					
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$dataArr = array(
							'file_name' => $this->upload_file_name,
							'file_type'=> $this->upload_file_name,
							'candidate_id' => $candidate_id
						);
						$this->finalverificationmodel->insert_files($dataArr);
					}
				}
			}	
			redirect('final_verify/summary/'.$this->input->post('candidate_id'));
		}else
		{
			redirect('final_verify');
		}		
	}
	
	// add files
	function addfiles(){
		$this->table_name='pms_candidate';
		$this->load->model('finalverificationmodel');
		$this->load->library('upload');		
		$candidate_id = $this->input->post('candidate_id');	

		$survey_array=array();
		foreach($_POST as $key => $val)
		{
			if($key!='candidate_id' && $key!='cv_file' && $key!='photo')
			{
				$key=str_replace('qt_','',$key);
				$survey_array[]=array('candidate_id' => $candidate_id,'answer_id' => $key, 'answer_value' => $val);
			}
		}
		if(count($survey_array)>0)
		{
			$this->db->query("delete from pms_candidate_survey_result where candidate_id=".$candidate_id);
			foreach($survey_array as $item => $val)
			{
				$this->db->insert('pms_candidate_survey_result', $val);
			}
		}
			
		if(isset($_FILES['cv_file'])){
			if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
			{       				
				$config['upload_path'] = 'uploads/cvs/';
				$config['allowed_types'] = 'doc|docx|pdf|txt';
				$config['max_size']	= '0';
				$config['file_name'] = md5(uniqid(mt_rand()));
				$this->upload->initialize($config);	
			
				if ($this->upload->do_upload('cv_file'))
				{
					$this->upload_file_name='';
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];					
					$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					$dataArr = array(
						'file_name' => $this->upload_file_name,
						'file_type'=> $this->upload_file_name,
						'candidate_id' => $candidate_id
					);
					$this->finalverificationmodel->insert_files($dataArr);
				}
			}
		}
		
		if(isset($_FILES['photo'])){	
			if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
			{         
				$photo['upload_path'] = 'uploads/photos/';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
			
				$this->upload->initialize($photo);
				if ($this->upload->do_upload('photo'))
				{
				
					$this->upload_file_name='';
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];					
					$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					$dataArr = array(
						'file_name' => $this->upload_file_name,
						'file_type'=> $this->upload_file_name,
						'candidate_id' => $candidate_id
					);
					$this->finalverificationmodel->insert_files($dataArr);
				}
			}
		}	
		
	}
	
	// Edit Cnadidate
	function edit($id=null)
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
			'lead_opportunity' => '0',
			'branch_id' => '',
			'level_study' => '',
		);
		$this->data['page_head']= 'Edit Profile';

//Loading Models
		$this->load->model('finalverificationmodel');  
		$this->load->model('coursemodel'); 
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->load->model('visatypemodel');
		$this->load->model('jobsmodel');
		
		$this->data["formdata"] = $this->finalverificationmodel->get_single_record($id);
		
//Certification and Technical Skilss
		
		$this->data['cerifications']=$this->jobsmodel->get_cert();
		$candidate_certifications = $this->finalverificationmodel->candidate_certifications($id);
		
		$cerifications=array();
		foreach($candidate_certifications as $cert)
		{
			$cerifications[]=$cert['cert_id'];
		}
		$this->data['candidate_certifications']	=	$cerifications;
//skills
		
		$this->data['skill_list']=$this->finalverificationmodel->get_parent_skills();
		
		$candidate_skills = $this->finalverificationmodel->candidate_skills($id);
		
		$skills=array();
		foreach($candidate_skills as $skill)
		{
			$skills[]=$skill['skill_id'];
		}
		$this->data['candidate_skills']	=	$skills;
		
		$this->data['res']	=	array();
		$this->data['res1']	=	array();
		
		if(!empty($skill))
		{
		$skill	=	implode(',',$skills);	
		$qry	=	$this->db->query('select * from pms_candidate_skills where parent_skill !=0 and  skill_id in ('.$skill.') ');
		$this->data['res']	= $res	=	$qry->result_array();
		
		$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
		$this->data['res1']	= $res1 =	$qry1->result_array();
		
		$this->data['child_skills']	=	$this->finalverificationmodel->get_child_skills($res1[0]['skill_id']);
		}
		
//all child skills		
		$this->data['all_child_skills']	=	$this->finalverificationmodel->child_skills();
//domain knowledge
		
		$this->data['domain']=$this->finalverificationmodel->get_domain();
		$candidate_domain = $this->finalverificationmodel->get_domain_details($id);
		
		$domain=array();
		foreach($candidate_domain as $dom)
		{
			$domain[]=$dom['domain_id'];
		}
		$this->data['candidate_domain']	=	$domain;
		
//Planning Job Change Details
		$this->data["formdata8"] = $this->finalverificationmodel->job_search($id);
		if(count($this->data["formdata8"])<1)
		{
			$this->data["formdata8"]['job_date']='';
			$this->data["formdata8"]['current_ctc']='';
			$this->data["formdata8"]['expected_ctc']='';
			$this->data["formdata8"]['notice_period']='';
			$this->data["formdata8"]['total_experience']='';
			$this->data["formdata8"]['present_location']='';
			$this->data["formdata8"]['preferred_location']='';
			$this->data["formdata8"]['immediate_join']='';
		}
		
//Language Deatils
		$this->data['lang_list']=$this->finalverificationmodel->get_language_set();
		$candidate_certifications =$this->finalverificationmodel->candidate_languages($id);
		
		$languages=array();
		foreach($candidate_certifications as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
//Contact Details
		$location_id = $this->data['formdata']['current_location'];
		$query1=$this->db->query("select a.*,b.*,c.* from pms_locations a join pms_city b  on a.city_id = b.city_id inner join pms_state c  on c.state_id = b.state_id   where a.location_id=".$location_id);			
        $this->data['formdata2']=$query1->row_array();	
			
		if(!isset($this->data['formdata']['nationality'])) $this->data['formdata']['nationality'] = 0;
		if(!isset($this->data['formdata']['state']))$this->data['formdata']['state'] = 0;
		if(!isset($this->data['formdata']['city_id']))$this->data['formdata']['city_id'] = 0;
		
		$this->data["city_list"] = $this->cittymodel->city_list_by_state($this->data['formdata']['state']);
		$this->data["state_list"] = $this->statmodel->state_list($this->data['formdata']['nationality']);		
		$this->data["location_list"] = $this->locationmodel->location_list($this->data['formdata']['city_id']); 
		$this->data["country_list"] = $this->countrymodel->country_list_by_state_city_location();
		
		$this->data["formdata3"] = $this->finalverificationmodel->get_address_single_record($id);
		if(count($this->data["formdata3"])<1)
		{
			$this->data["formdata3"]['address']='';
			$this->data["formdata3"]['land_phone']='';
			$this->data["formdata3"]['workphone']='';
			$this->data["formdata3"]['fax']='';
			$this->data["formdata3"]['zipcode']='';
		}

//Passport Details
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->finalverificationmodel->country_list();
		$this->data["formdata4"] = $this->finalverificationmodel->get_passport_single_record($id);

//Education Details
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->finalverificationmodel->edu_level_list();
		$this->data["edu_years_list"] = $this->finalverificationmodel->edu_years_list();
		//$this->data["edu_course_list"] = $this->finalverificationmodel->edu_course_list();
		$this->data["edu_course_list"]  = array('' => 'Select Course');
		
		$this->data["edu_spec_list"] = $this->finalverificationmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->finalverificationmodel->edu_univ_list();
		$this->data["edu_coll_list"] = $this->finalverificationmodel->edu_coll_list();
		$this->data["edu_course_type_list"] = $this->finalverificationmodel->edu_course_type_list();
		$this->data["formdata5"] = $this->finalverificationmodel->get_education_single_record($id);
		if(count($this->data["formdata5"])<1)
		{
				$this->data['formdata5']['level_id'] = '';
				$this->data['formdata5']['course_id'] = '';
				$this->data['formdata5']['spcl_id'] = '';
				$this->data['formdata5']['univ_id'] = '';
				$this->data['formdata5']['college_id'] = '';
				$this->data['formdata5']['edu_year'] = '';
				$this->data['formdata5']['edu_country'] = '';
				$this->data['formdata5']['course_type_id'] = '';
				$this->data['formdata5']['arrears'] = '';
				$this->data['formdata5']['absesnse'] = '';
				$this->data['formdata5']['repeat'] = '';
				$this->data['formdata5']['year_back'] = '';
				$this->data['formdata5']['mark_percentage'] = '';
				$this->data['formdata5']['grade'] = '';
		}
//Job Details
		$this->data["industries_list"] = $this->finalverificationmodel->industries_list();		
		$this->data["industry_list"] = $this->finalverificationmodel->industry_list();
		$this->data["functional_list"] = $this->finalverificationmodel->functional_list();
		$this->data["currecy_list"] = $this->finalverificationmodel->currency_list();
		$this->data["years_list"] = $this->finalverificationmodel->years_list();
		$this->data["months_list"] = $this->finalverificationmodel->months_list();
		$this->data["formdata6"] = $this->finalverificationmodel->get_job_single_record($id);
		
		if(count($this->data["formdata6"])<1)
		{
			$this->data['formdata6']['organization'] = '';
			$this->data['formdata6']['job_cat_id'] = '';
			$this->data['formdata6']['designation'] = '';
			$this->data['formdata6']['func_id'] = '';
			$this->data['formdata6']['responsibility'] = '';
			$this->data['formdata6']['from_date'] = '';
			$this->data['formdata6']['to_date'] = '';
			$this->data['formdata6']['monthly_salary'] = '';
			$this->data['formdata6']['currency_id'] = '';
			$this->data['formdata6']['present_job'] = '';
			$this->data['formdata6']['exp_years'] = '';
			$this->data['formdata6']['exp_months'] = '';
			$this->data['formdata6']['skills'] = '';		
		}
		
//FILE DEATILS
		$this->data['survey_result']=$this->finalverificationmodel->get_survey_result($id);
		$this->data["formdata7"] = $this->finalverificationmodel->get_file_single_record($id);
		
		$this->data['formdata'] = array_merge($this->data['formdata'],$this->data['formdata2'],$this->data["formdata3"],$this->data["formdata4"],$this->data["formdata5"],$this->data["formdata6"],$this->data["formdata7"],$this->data["formdata8"]);	
		
			$this->data["formdata"]['profile_list'] = $this->finalverificationmodel->profile_list($id);
		
		$this->data["edu_view"]	=	$this->educationDetails($id);
		$this->data["job_view"]	=	$this->jobDetails($id);
		$this->load->view('include/header',$this->data);
		$this->load->view('final_verify/editcandidates',$this->data);	
		$this->load->view('include/footer',$this->data);
	}
	
//SHOW CV AND PHOTOT AJAX
	function show_cv_photo()
	{
		$id =$this->input->post('candidate_id');
		$this->load->model('finalverificationmodel');
		
		$formdata = $this->finalverificationmodel->get_single_record($id);

		
		$cv='';
		$photo='';
		if($formdata['cv_file']!=''){
			$cv ='<span id="cv-span"><a href="'. base_url().'uploads/cvs/'.$formdata['cv_file'].'" target="_blank" style="color:#0033FF">Download CV</a> &nbsp;||&nbsp;<a href="javascript:;" id="del-cv" style="color:#0033FF">Delete CV</a> </span>';
		}
		 if($formdata['photo']!=''){  
			$photo='<span id="imgTab2"><img src="'. base_url().'uploads/photos/'.$formdata['photo'].'" class="profile_img" style="width:158px;height:100px;"><br /><br /><a href="javascript:;" id="del-photo" style="color:#0033FF">Delete Photo</a>&nbsp;&nbsp;</span>';

		}
	
				
		$response = array(
			'cv' => $cv,
			'photo' => $photo,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
	function editCandidate(){
		$candidateId = $this->input->post('candidateId');
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_candidate_record($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditContacthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["religion_list"]    = $this->finalverificationmodel->religion_list();
		
		
		$query=$this->db->query("select * from pms_candidate where candidate_id=".$id);			
		$this->data['formdata']=$query->row_array();
		
		$location_id = $this->data['formdata']['current_location'];
		
		$query1=$this->db->query("select a.*,b.*,c.* from pms_locations a join pms_city b  on a.city_id = b.city_id inner join pms_state c  on c.state_id = b.state_id   where a.location_id=".$location_id);			
        $this->data['formdata2']=$query1->row_array();	
			
		if(!isset($this->data['formdata']['nationality'])) $this->data['formdata']['nationality'] = 0;
		if(!isset($this->data['formdata']['state']))$this->data['formdata']['state'] = 0;
		if(!isset($this->data['formdata']['city_id']))$this->data['formdata']['city_id'] = 0;
		
		$this->data["city_list"] = $this->cittymodel->city_list_by_state($this->data['formdata']['state']);
		$this->data["state_list"] = $this->statmodel->state_list($this->data['formdata']['nationality']);		
		$this->data["location_list"] = $this->locationmodel->location_list($this->data['formdata']['city_id']); 
		$this->data["country_list"] = $this->countrymodel->country_list_by_state_city_location();
		
		$this->data["formdata3"] = $this->finalverificationmodel->get_address_single_record($id);
		if(count($this->data["formdata3"])<1)
		{
			$this->data["formdata3"]['address']='';
			$this->data["formdata3"]['land_phone']='';
			$this->data["formdata3"]['workphone']='';
			$this->data["formdata3"]['fax']='';
			$this->data["formdata3"]['zipcode']='';
		}
		$this->data['formdata'] = array_merge($this->data['formdata'],$this->data['formdata2'],$this->data["formdata3"]);
        $this->load->view('final_verify/editcontactdetail', $this->data);

	}
	
	function editCandidateDetail($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->edit_contact_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	function loadEditPassporthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->finalverificationmodel->country_list();
		$this->data["formdata"] = $this->finalverificationmodel->get_passport_single_record($id);
		$this->load->view('final_verify/editpassportdetail', $this->data);
	}
	
	function editPassportDetail($candidateId)
	{
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->edit_passport_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditEducationhtml($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->finalverificationmodel->edu_level_list();
		$this->data["edu_years_list"] = $this->finalverificationmodel->edu_years_list();
		$this->data["edu_course_list"] = $this->finalverificationmodel->edu_course_list();

		$this->data["edu_spec_list"] = $this->finalverificationmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->finalverificationmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->finalverificationmodel->edu_course_type_list();
		$this->data["formdata"] = $this->finalverificationmodel->get_education_single_record($id);
		if(count($this->data["formdata"])<1)
		{
				$this->data['formdata']['level_id'] = '';
				$this->data['formdata']['course_id'] = '';
				$this->data['formdata']['spcl_id'] = '';
				$this->data['formdata']['univ_id'] = '';
				$this->data['formdata']['edu_year'] = '';
				$this->data['formdata']['edu_country'] = '';
				$this->data['formdata']['course_type_id'] = '';
				$this->data['formdata']['arrears'] = '';
				$this->data['formdata']['absesnse'] = '';
				$this->data['formdata']['repeat'] = '';
				$this->data['formdata']['year_back'] = '';
				$this->data['formdata']['mark_percentage'] = '';
				$this->data['formdata']['grade'] = '';
		}
		$this->load->view('final_verify/editeducationdetail',$this->data);
	}

//EDUCATION DETAILS
	function educationDetails($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		
		
		$edu_level = $this->finalverificationmodel->edu_level_list();
		
		$course = $this->finalverificationmodel->edu_course_list();

		$spec = $this->finalverificationmodel->edu_spec_list();


		
		$results = $this->finalverificationmodel->get_education_details($id);
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
		
		
		$education_details_view	=	$this->load->view('final_verify/education_details',$this->data,true);
		return $education_details_view;
	}
	
	function editEducationDetail($candidateId)
	{
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->edit_education_detail($candidateId);
		
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function editJobChangeDetail($candidateId)
	{
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->edit_job_change_detail($candidateId);
		 $this->finalverificationmodel->edit_passport_num_type($candidateId);
		
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditJobhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->data["industry_list"] = $this->finalverificationmodel->industry_list();
		$this->data["functional_list"] = $this->finalverificationmodel->functional_list();
		$this->data["currecy_list"] = $this->finalverificationmodel->currency_list();
		$this->data["years_list"] = $this->finalverificationmodel->years_list();
		$this->data["months_list"] = $this->finalverificationmodel->months_list();
		$this->data["formdata"] = $this->finalverificationmodel->get_job_single_record($id);
		
		if(count($this->data["formdata"])<1)
		{
			$this->data['formdata']['organization'] = '';
			$this->data['formdata']['job_cat_id'] = '';
			$this->data['formdata']['designation'] = '';
			$this->data['formdata']['func_id'] = '';
			$this->data['formdata']['responsibility'] = '';
			$this->data['formdata']['from_date'] = '';
			$this->data['formdata']['to_date'] = '';
			$this->data['formdata']['monthly_salary'] = '';
			$this->data['formdata']['currency_id'] = '';
			$this->data['formdata']['present_job'] = '';
			$this->data['formdata']['exp_years'] = '';
			$this->data['formdata']['exp_months'] = '';
			$this->data['formdata']['skills'] = '';		
		}
		
		$this->load->view('final_verify/editjobdetail', $this->data);
	}
	
//JOB DETAILS
	function jobDetails($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		
		$industry_list = $this->finalverificationmodel->industry_list();
		$functional_list = $this->finalverificationmodel->functional_list();

		
		$results = $this->finalverificationmodel->get_job_details($id);
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
		
		
		$job_details_view	=	$this->load->view('final_verify/job_details',$this->data,true);
		return $job_details_view;
	}
	
	function editJobDetail($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->edit_job_detail($candidateId);
		
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}

		
	function loadEditFilehtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('finalverificationmodel');
		$this->data['survey_result']=$this->finalverificationmodel->get_survey_result($id);
		$this->data["formdata"] = $this->finalverificationmodel->get_file_single_record($id);	

		$this->load->view('final_verify/editfiledetail', $this->data);
	}

	// edit files
	function editfiles($candidate_id=''){
		$this->table_name='pms_candidate';
		$this->load->model('finalverificationmodel');
		$candidate_id = $this->input->post('candidate_id');	
		
//updating profile completion value		
		$this->db->query("update pms_candidate set profile_completion='".$this->input->post('profile_completion')."' where candidate_id=".$candidate_id);
		
		$this->load->library('upload');		

		$survey_array=array();
		foreach($_POST as $key => $val)
		{
			if($key!='candidate_id' && $key!='cv_file' && $key!='photo')
			{
				$key=str_replace('qt_','',$key);
				$survey_array[]=array('candidate_id' => $candidate_id,'answer_id' => $key, 'answer_value' => $val);
			}
		}
		
		if(count($survey_array)>0)
		{
			$this->db->query("delete from pms_candidate_survey_result where candidate_id=".$candidate_id);
			foreach($survey_array as $item => $val)
			{
				$this->db->insert('pms_candidate_survey_result', $val);
			}
		}
		
		if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'uploads/photos/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
		
			$this->upload->initialize($photo);
				if ($this->upload->do_upload('photo'))
				{
				
					$this->upload_file_name='';
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];	
					$query = $this->db->query("select photo from pms_candidate where candidate_id=".$this->input->post('candidate_id'));
									if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
										unlink('uploads/photos/'.$row['photo']);
									}
				
					$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					
	
	$this->db->query("update pms_candidate_files set file_name='".$this->upload_file_name."',file_type='".$this->upload_file_name."' where file_name='".$row['photo']."' and candidate_id=".$candidate_id);
				}
			}

			if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
			{       				
						$config['upload_path'] = 'uploads/cvs/';
						$config['allowed_types'] = 'doc|docx|pdf|txt';
						$config['max_size']	= '0';
						$config['file_name'] = md5(uniqid(mt_rand()));
						$this->upload->initialize($config);	
						if ($this->upload->do_upload('cv_file'))
						{
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];	
							
						$query = $this->db->query("select cv_file from pms_candidate where candidate_id=".$this->input->post('candidate_id'));
						if ($query->num_rows() > 0)
						{
							$row = $query->row_array();
							if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
							unlink('uploads/cvs/'.$row['cv_file']);
						}
						$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$this->db->query("update pms_candidate_files set file_name='".$this->upload_file_name."',file_type='".$this->upload_file_name."' where file_name='".$row['cv_file']."' ");
		
						}
			}	
			
			$data = array('success' => 'true');			
			echo json_encode($data);
			exit();
		}		

	// import csv
	function import_csv()
    {    
        $this->data['page_head'] = 'Import CSV';
        $this->data['cur_page']=$this->router->class;
		
		$this->load->model('finalverificationmodel');
		
        $config['upload_path'] = 'upload/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size']    = '1000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
        $config['overwrite']  = 'TRUE';
        $config['file_name']  = date('Ymdhis');

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
			$this->load->view('include/header',$this->data);    
			$this->load->view('final_verify/import_csv',$this->data);                
			$this->load->view('include/footer',$this->data);        
        }
        else
        {
            $data = $this->upload->data();
            $this->fileName = $data['file_name'];
            $pathToFile = $config['upload_path'].$this->fileName;

            if( !file_exists( $pathToFile )) die( 'File could not be found at: ' . $pathToFile );
            $file = fopen($pathToFile,"r");
	
            $keys = fgetcsv($file);			
			
            while (!feof($file)) {
                $contacts_data = fgetcsv($file);
				
                if(count($keys)!=count($contacts_data))
                {
                    continue;
                }
                else
                {
                    if(!empty($contacts_data))
                    {
                        $contacts[] = array_combine($keys, $contacts_data);
                    }
                }
            }

		
             for($i=0;$i<count($contacts);$i++)
			 {
				 
               $res = $contacts[$i];
				if($res['username'] != '')
				{
						$qry	=	$this->db->query("select * from pms_candidate where username ='".$res['username']."'");
						$result	=	$qry->row_array(); 
						
							if(empty($result))
							{
							
								
								$data=array(
								'username'   => $res['username'] ,
								'password'   => md5($res['password']),
								'first_name' => $res['first_name'] ,
								'last_name'  => $res['last_name'] ,
								'reg_date'   => date('Y-m-d'),
								'mobile'     => $res['mobile'] ,
								'date_of_birth' => date("Y-m-d ",strtotime($res['date_of_birth'])),
								'passportno'    => $res['passportno'],				
								'passport_type' => $res['passport_type'],
								
								);
								
								$id = $this->finalverificationmodel->insert_csv_records($data);
								
								//data1 start
								$level_id      = $this->common('pms_education_level',$res['level']);
								$data1 = array(
								'candidate_id' => $id,
								'level_id'     => $level_id,
								'course_id'    => $this->check_course('pms_courses',$res['course'],$level_id),
								'college_id'   => $this->common('pms_colleges',$res['college']),
								'edu_year'     => $res['edu_year'],
								
								);
								
								$this->finalverificationmodel->insert_csv_edu($data1);
								
								//data2 start
								$category_id   =  $this->common('pms_job_category',$res['category']);
								$data2 = array(
								'candidate_id' => $id,
								'organization' => $res['organization'],
								'designation'  => $res['designation'],
								'job_cat_id'   => $category_id,
								'func_id'      => $this->check_fun_area('pms_courses',$res['functional_area'],$category_id),
								'from_date'    => $res['from_date'],
								'to_date'      => $res['to_date'],				
								'present_job'  => $res['present_job'],
								);
								
								$this->finalverificationmodel->insert_csv_job($data2);
								
								//data3 start
								
								$skills = explode('|',$res['skills']);
								
								for($i=0;$i<count($skills);$i++)
								
								{
								
									$data3 = array(
									'candidate_id' => $id,
									'skill_id'     => $this->check_skills('pms_candidate_skills',$skills[$i]),
									
									);
									
									$this->finalverificationmodel->insert_csv_skills($data3);
								}
								
								//data4 start
								$cert = explode('|',$res['certifications']);					
								for($i=0;$i<count($cert);$i++)
								
								{
								
									$data4 = array(
									'candidate_id' => $id,
									'cert_id'      => $this->common('pms_candidate_certification',$cert[$i]),
									
									);
									
									$this->finalverificationmodel->insert_csv_cert($data4);
								}
								
								//data5 start
								$domain = explode('|',$res['domains']);
								for($i=0;$i<count($domain);$i++)
								
								{
								
									$data5 = array(
									'candidate_id' => $id,
									'domain_id'    => $this->common('pms_candidate_domain', $domain[$i]),
									
									);
									
									$this->finalverificationmodel->insert_csv_domain($data5);
								}
								
								//data6 start
								$lang = explode('|',$res['languages']);
								for($i=0;$i<count($lang);$i++)
								
								{
								
									$data6 = array(
									'candidate_id' => $id,
									'lang_id'      =>  $this->common('pms_languages',$lang[$i]),
									
									);
									
									$this->finalverificationmodel->insert_csv_lang($data6);
								}
									
								//data7 start
								$data7 = array(
								'candidate_id'      => $id,
								'job_date'          => $res['job_date'],
								'current_ctc'       => $res['current_ctc'],				
								'expected_ctc'      => $res['expected_ctc'],
								'notice_period'     => $res['notice_period'],				
								'total_experience'  => $res['total_experience'],
								'present_location'  => $res['present_location'],
								'preferred_location'=> $res['preferred_location'],				
								'immediate_join'    => $res['immediate_join'],
								
								);
							
								$this->finalverificationmodel->insert_csv_job_search($data7);
							
																
						}
						
				}
				
            }
			redirect('final_verify/?csv=1');
        }  
		      
    }
	
	//common function for csv import
	
	function common($table_name,$field_value)
	{
		switch($table_name)
		{
			case "pms_education_level":
			$label = 'level_id';
			$field = 'level_name';
			break;
			
			case "pms_colleges":
			$label = 'college_id';
			$field = 'college_name';
			break;
			
			case "pms_candidate_certification":
			$label = 'cert_id';
			$field = 'cert_name';
			break;
			
			case "pms_candidate_domain":
			$label = 'domain_id';
			$field = 'domain_name';
			break;
			
			case "pms_languages":
			$label = 'lang_id';
			$field = 'lang_name';
			break;
			
			case "pms_job_category":
			$label = 'job_cat_id';
			$field = 'job_cat_name';
			break;
		}
	
		 $qry	    =	$this->db->query("select ".$label." as id from ".$table_name." where ".$field." ='".$field_value."'");
		 $result	=	$qry->row_array(); 
		
			if (!empty($result))
			{
				return $result['id'];
			}
			else
			{
				$data =array(
						$field => $field_value	 
						);
				
				$this->db->insert($table_name, $data); 
				$new_id=$this->db->insert_id();
				return $new_id;
			}
	}
	
	//checking course from csv 
	function check_course($table_name,$field_value,$level_id)
	{
		$this->db->select('*');				
		$this->db->where('course_name',$field_value);	
		$query = $this->db->get($table_name);
		$result =$query->row_array(); 
		
			if (!empty($result))
			{
				  	return $result['course_id'];
				
			}
			
			else
			{
				$data =array(
						'course_name' => $field_value	,
						'level_study' => $level_id
						);
				$this->db->insert($table_name, $data); 
				$new_id=$this->db->insert_id();
				return $new_id;
			}
		
	}
	
	
	
	//checking functional area from csv 
	function check_fun_area($table_name,$field_value,$category_id)
	{
		$this->db->select('*'); 
		$this->db->where('func_area',$field_value);			
		$this->db->where('job_cat_id',$category_id);
		$query = $this->db->get($table_name);
		$result =$query->row_array(); 
		
			if (!empty($result))
			{
				return $result['func_id'];
			}
			else
			{
				$data =array(
						'func_area' => $field_value	,
						'job_cat_id'=> $category_id
						);
				$this->db->insert($table_name, $data); 
				$new_id=$this->db->insert_id();
				return $new_id;
			}
	}
	
	//checking skills from csv 
	function check_skills($table_name,$field_value)
	{
		$this->db->select('*'); 
		$this->db->where('skill_name',$field_value);			
		$query = $this->db->get($table_name);
		$result =$query->row_array(); 
		
			if (!empty($result))
			{
				return $result['skill_id'];
			}
			else
			{
				$data =array(
						'parent_skill' => 1,
						'skill_name' => $field_value	,
						'non_it'=> 1,
						'active'=> 1
						
						);
				$this->db->insert($table_name, $data); 
				$new_id=$this->db->insert_id();
				return $new_id;
			}
	}
	
	
	
	
	// import xml
	function import_xml()
    {    
        $this->data['page_head'] = 'Import XML';
        $this->data['cur_page']=$this->router->class;
        if($_POST)
		{
			redirect('final_verify');
		}
		
			
		$this->load->view('include/header',$this->data);    
		$this->load->view('final_verify/import_xml',$this->data);                
		$this->load->view('include/footer',$this->data);        
		      
    }


	//Candidate View
	function candidate_view($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);

		if($this->input->post('candidate_id')!='')
			{
				$data=array(
				'reg_status'      => $this->input->post('reg_status'),
				'fee_comments'        => $this->input->post('fee_comments'),
				'fee_date'        => $this->input->post('fee_date'),
				'fee_amount'        => $this->input->post('fee_amount')
				);
				
 			   $this->db->where('candidate_id', $this->input->post('candidate_id'));
			   $this->db->update('pms_candidate', $data);
			   redirect('final_verify/candidate_view/'.$this->input->post('candidate_id'));
		}
						
		$this->data['list']=$this->finalverificationmodel->follow_record($candidate_id);
		$this->data['note_list']=$this->finalverificationmodel->notes_record($candidate_id);		
		$this->data['coe_list']=$this->finalverificationmodel->coe_list($candidate_id);
		$this->data['visa_approval_list']=$this->finalverificationmodel->visa_approval_list($candidate_id);

		$this->data['interview_list']=$this->finalverificationmodel->interview_record($candidate_id);
		$this->data['aplication_list']=$this->finalverificationmodel->aplication_record($candidate_id);
		
		$this->data['interview_status_list']=$this->finalverificationmodel->interview_status_list();		
		$this->data['app_list']=$this->finalverificationmodel->aplication_list($candidate_id);
		$this->data['app_list_coe']=$this->finalverificationmodel->select_aplication_coe($candidate_id);
		$this->data['admin_user_list']=$this->finalverificationmodel->admin_user_list();
		$this->data['interview_type_list']=$this->finalverificationmodel->interview_type_list();
		$this->data['university_list']=$this->finalverificationmodel->university_list();
		$this->data['campus_list']=array('' => 'Select Campus');
		$this->data['intake_list']=$this->finalverificationmodel->intake_list();
		$this->data['course_list']=array('' => 'Select Course');;
		$this->data['level_list']=$this->coursemodel->fill_levels();
		$this->data['status_list']=$this->finalverificationmodel->status_list();

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_view",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	// Manage Summary & Reports
	function summary($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['msg']='';
		if($this->input->get('del_cv')==1)$this->data['msg']='CV Deleted successfully';
		if($this->input->get('del_photo')==1)$this->data['msg']='Photo Deleted successfully';
		$this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->load->model('finalverificationmodel');
		$this->load->model('countrymodel');
		$this->data["formdata"] = $this->finalverificationmodel->get_single_record($candidate_id);
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		$this->data['candidate_languages'] = $this->finalverificationmodel->candidate_languages($candidate_id);
		$this->data['education_details'] = $this->finalverificationmodel->education_deatils($candidate_id);
		$this->data['job_history'] = $this->finalverificationmodel->job_list($candidate_id);
		$this->data['all_counselor'] = $this->finalverificationmodel->all_counselor($candidate_id);
		$this->data['candidate_counselor'] = $this->finalverificationmodel->candidate_counselor($candidate_id);
		$this->data['candidate_skill'] = $this->finalverificationmodel->candidate_skills($candidate_id);
		
//candidate doamin knowledge
		$this->data['candidate_domain'] = $this->finalverificationmodel->candidate_domains($candidate_id);
		
		$this->data['candidate_certifications'] = $this->finalverificationmodel->candidate_certifications($candidate_id);
	
		$this->data['candidate_programs_summary'] = $this->finalverificationmodel->candidate_programs_summary($candidate_id);

	
		$this->data['candidate_coe_summary'] = $this->finalverificationmodel->candidate_coe_summary($candidate_id);
		$this->data['candidate_visa_summary'] = $this->finalverificationmodel->candidate_visa_summary($candidate_id);

		$this->data['candidate_questionnaire_summary'] = $this->finalverificationmodel->get_survey_result($candidate_id);
		$this->data['candidate_files_summary'] = $this->finalverificationmodel->get_files($candidate_id);
		$this->data['candidate_complaints_summary'] = $this->finalverificationmodel->ticket_list($candidate_id);

//Job Search details(candidate_job_serach)
		$this->data['job_search'] = $this->finalverificationmodel->job_search($candidate_id);
		//print_r($this->data['job_search']);exit;
//Edit skill Modal

		$this->data['skill_list']=$this->finalverificationmodel->get_parent_skills();
		
		$candidate_skills = $this->finalverificationmodel->candidate_skills($candidate_id);
		
		$skills=array();
		foreach($candidate_skills as $skill)
		{
			$skills[]=$skill['skill_id'];
		}
		$this->data['candidate_skills']	=	$skills;
		
		$this->data['res']	=	array();
		$this->data['res1']	=	array();
		
		if(!empty($skill))
		{
		$skill	=	implode(',',$skills);	
		$qry	=	$this->db->query('select * from pms_candidate_skills where parent_skill !=0 and  skill_id in ('.$skill.') ');
		$this->data['res']	= $res	=	$qry->result_array();
		
		$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
		$this->data['res1']	= $res1 =	$qry1->result_array();
		
		$this->data['child_skills']	=	$this->finalverificationmodel->get_child_skills($res1[0]['skill_id']);
		}
		
//Edit Language Modal
		//Language Deatils
		$this->data['lang_list']=$this->finalverificationmodel->get_language_set();
		$candidate_certifications =$this->finalverificationmodel->candidate_languages($candidate_id);
		
		$languages=array();
		foreach($candidate_certifications as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
		
//Edit Education Modal
		
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"]   = $this->finalverificationmodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->finalverificationmodel->edu_years_list();
		
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->finalverificationmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->finalverificationmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->finalverificationmodel->edu_course_type_list();
//Job History Modal
		//employment
		$this->data["industries_list"] = $this->finalverificationmodel->industries_list();
		$this->data["industry_list"] = $this->finalverificationmodel->industry_list();
		$this->data["functional_list"] = $this->finalverificationmodel->functional_list();
		$this->data["currecy_list"] = $this->finalverificationmodel->currency_list();
		$this->data["years_list"] = $this->finalverificationmodel->years_list();
		$this->data["months_list"] = $this->finalverificationmodel->months_list();
	
		
//applied jobs of candidate		
		$this->data['applied_jobs']=$this->finalverificationmodel->get_job_list($candidate_id);

//shortlisted jobs
		$this->data['shortlisted']=$this->finalverificationmodel->get_shortlisted($candidate_id);

//interview scheduled jobs
		$this->data['interview_list']=$this->finalverificationmodel->get_interview_list($candidate_id);

//selected jobs
		$this->data['jobs_selected']=$this->finalverificationmodel->jobs_selected($candidate_id);

//offer letters issued
		$this->data['offer_letters_issued']=$this->finalverificationmodel->offer_letters_issued($candidate_id);
		
//offer accepted
		$this->data['offer_accepted']=$this->finalverificationmodel->offer_accepted($candidate_id);

//invoice genereted
		$this->data['invoice_generated']=$this->finalverificationmodel->invoice_generated($candidate_id);

//present contract details
		$this->data['contract_details']=$this->finalverificationmodel->get_contract_detail($candidate_id);
		
//Profile completion status
		$this->data['profile_completion']=$this->finalverificationmodel->get_profile_status($candidate_id);

//Profile Assessment status
		$this->data['profile_assessment']=$this->finalverificationmodel->get_profile_assessment($candidate_id);
		
//All language details
		$this->data['lang_details']=$this->finalverificationmodel->get_lang_details($candidate_id);
		
			if($this->input->post('candidate_id')!=''){
					foreach($this->input->post('admin_id') as $key => $val)
					{
						$this->db->where('admin_id',$val);
						$this->db->where('candidate_id',$this->input->post('candidate_id'));
						$this->db->delete('pms_admin_candidates');
						
							if($this->input->post('action')=='Add')
							{
								$data=array(
								'candidate_id'   =>$this->input->post('candidate_id'),
								'admin_id'        =>$val,
								'assigned_date'   => date('Y-m-d'),
								);			
								$this->db->insert('pms_admin_candidates',$data);
							}
					}
				redirect('final_verify/summary/'.$candidate_id);
			}
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_summary",$this->data);
		$this->load->view("include/footer",$this->data);
	}


	// candidate programs
	function candidate_programs($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->load->model('coursemodel');
		
		$this->data['edit_mode']='';
		$this->data['app_id']='';

		$this->data['single_application']=array('univ_id' => '',
											'campus_id' => '',
											'level_study' => '',
											'course_id' => '',
											'candidate_course_id' => '',
											'intake_id' => '',
											'process_status_id' => '',
											'app_details' => '',
											'total_semester' => '',
											'fee_per_semester' => '',
											'annual_tution_fee' => '',
											'total_tution_fee' => '',
											 );
											 
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$data=array(
			'candidate_id'        => $this->input->post('candidate_id'),
			'campus_id'       =>  $this->input->post('campus_id'),
			'course_id'           => $this->input->post('course_id'),
			'intake_id'           =>  $this->input->post('intake_id'),
			'app_details'         => $this->input->post('app_details'),
			'process_status_id'   => $this->input->post('status_id'),	
			'candidate_course_id'   => $this->input->post('candidate_course_id'),
			'total_semester'      =>     $this->input->post('total_semester'),
			'fee_per_semester'    =>     $this->input->post('fee_per_semester'),
			'annual_tution_fee'   =>     $this->input->post('annual_tution_fee'),
			'created_by'          =>     $_SESSION['vendor_session'],
			'total_tution_fee'    =>     $this->input->post('total_tution_fee')
			);
			$this->db->where('app_id',$this->input->post('app_id'));
			$this->db->where('candidate_id',$this->input->post('candidate_id'));
			$this->db->update('pms_candidate_applications',$data);

		// update suggestion logic from here
			$this->finalverificationmodel->update_suggestion_module($this->input->post('candidate_id'), $this->input->post('campus_id'), $this->input->post('course_id'), $this->input->post('total_semester'), $this->input->post('fee_per_semester'), $this->input->post('annual_tution_fee'), $this->input->post('total_tution_fee'),$this->input->post('candidate_course_id'));
		// end here	
					
			redirect('final_verify/candidate_programs/'.$this->input->post('candidate_id').'/?upd=1');
		}

if($this->input->get('education')!='')
		{
			$this->data['single_application']['candidate_course_id']=$this->input->get('education');
		}
		if($this->input->get('univ_id')!='')
		{
			$this->data['single_application']['univ_id']=$this->input->get('univ_id');
		}

		if($this->input->get('campus_id')!='')
		{
			$this->data['single_application']['campus_id']=$this->input->get('campus_id');
		}
		if($this->input->get('campus_id')!='')
		{
			$this->data['single_application']['campus_id']=$this->input->get('campus_id');
		}
		if($this->input->get('course_id')!='')
		{
			$this->data['single_application']['course_id']=$this->input->get('course_id');
			$this->data['single_application']['app_details']=$this->finalverificationmodel->create_program_name($this->data['single_application']['course_id']);
		}					

		if($this->input->get('level_study')!='')
		{
			$this->data['single_application']['level_study']=$this->input->get('level_study');
		}				
		
		$this->data['aplication_list']=$this->finalverificationmodel->aplication_record($candidate_id); // application lists - 	
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id); // candidate details
		$this->data['university_list']=$this->finalverificationmodel->university_list(); // university list		
		$this->data['intake_list']=$this->finalverificationmodel->intake_list(); // intake list 		
		$this->data['level_list']=$this->coursemodel->fill_levels(); // education levels
		$this->data['status_list']=$this->finalverificationmodel->status_list(); // application process status list
		$this->data['campus_list']=array('' => 'Select Campus');
		$this->data['course_list']=array('' => 'Select Course');

		if($this->data['single_application']['univ_id']>0)
			$this->data['campus_list']=$this->finalverificationmodel->campus_list($this->data['single_application']['univ_id']);
		if($this->data['single_application']['level_study']>0)
			$this->data['course_list']=$this->finalverificationmodel->course_list_level($this->data['single_application']['level_study']);
			
		$this->data['candidate_qualification_list']=$this->finalverificationmodel->candidate_qualification_list($candidate_id); 
		// candidate's qualification for higher studies
		// edit mode		
		if($this->input->get('app_id')!='')
		{
			$this->data['single_application']=$this->finalverificationmodel->select_aplication_record($this->input->get('app_id'));
			if(count($this->data['single_application'])>0)
			{
				if($this->data['single_application']['univ_id']>0)$this->data['campus_list']=$this->finalverificationmodel->campus_list($this->data['single_application']['univ_id']);
				if($this->data['single_application']['level_study']>0)$this->data['course_list']=$this->finalverificationmodel->course_list_level($this->data['single_application']['level_study']);
				$this->data['app_id']=$this->input->get('app_id');
				$this->data['edit_mode']=1;
			}
		}
		// update program		
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_programs",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	// Create an application	
	function aplication()
	{
		// if no candidate id, exit from here. 
		$dataArr='Error';
		if($this->input->post('candidate_id')=='')
		{
			echo $dataArr;
			exit();	
		}
	
		$this->load->model('finalverificationmodel');
		
		$data=array(
		'candidate_id'        =>     $this->input->post('candidate_id'),
		'campus_id'           =>     $this->input->post('campus_id'),
		'app_created'         =>     date('Y-m-d'),
		'course_id'           =>     $this->input->post('course_id'),
		'intake_id'           =>     $this->input->post('intake_id'),
		'app_details'         =>     $this->input->post('app_details'),
		'process_status_id'   =>     $this->input->post('status_id'),
		'candidate_course_id' =>     $this->input->post('candidate_course_id'),	
		'total_semester'      =>     $this->input->post('total_semester'),
		'fee_per_semester'    =>     $this->input->post('fee_per_semester'),
		'annual_tution_fee'   =>     $this->input->post('annual_tution_fee'),
		'total_tution_fee'    =>     $this->input->post('total_tution_fee'),
		'created_by'          =>     $_SESSION['vendor_session'],
		'app_status'          =>   '0'
		);
		
		$this->db->insert('pms_candidate_applications',$data);
		
		$id=$this->db->insert_id();
		// update suggestion logic from here
		$this->finalverificationmodel->update_suggestion_module($this->input->post('candidate_id'), $this->input->post('campus_id'), $this->input->post('course_id'), $this->input->post('total_semester'), $this->input->post('fee_per_semester'), $this->input->post('annual_tution_fee'), $this->input->post('total_tution_fee'),$this->input->post('candidate_course_id'));
		// end here
				
		$this->data['aplication_list']=$this->finalverificationmodel->select_aplication_record($id);		
		
	
		$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$this->input->post('candidate_id'));
		$row = $query->row_array();
		$subject = 'Application';

		// sending SMS from here
		//$this->send_sms($row['mobile'],$row['first_name'],$msg);
		$msg='New program created successfully.';
		$this->send_sms('9895251980',$row['first_name'],$msg);
		//send_email from here
		
		$data =array(
		'Course Name:'=> $this->data['aplication_list']['course_name'],
		'University '=> $this->data['aplication_list']['univ_name'],
		'Application Status' => $this->data['aplication_list']['status_name'],
		'Others' => $this->data['aplication_list']['app_details'],
		'Your Name: ' => $row['first_name'],
		'Your Mobile Number: ' => $row['mobile'],
		);
		// email to candidate
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com',
			'email_to_name'          =>  $row['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$this->send_email($email_array);
		// end here 
		
		// EMAIL TO ADMIN
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
			'email_to_name'          =>  'ABE Services [Cochin]',
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE CRM',
			'email_reply_to'         =>  'abeservices@gmail.com',
			'email_reply_to_name'    =>  'ABE CRM',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear admin,',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',				
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);
		
		$dataArr = $this->load->view('final_verify/candidate_aplication_list', $this->data,TRUE);	
		echo $dataArr;
		exit();		
	}

	// CoE entry.
	function candidate_coe($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);

		$this->data['coe_list']=$this->finalverificationmodel->coe_list($candidate_id);
		$this->data['app_list_coe']=$this->finalverificationmodel->select_aplication_coe($candidate_id);
		$this->data['status_list']=$this->finalverificationmodel->status_list();

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_coe",$this->data);
		$this->load->view("include/footer",$this->data);
	}


	// CoE update on an application
	function create_coe(){
		
		// if no candidate id, exit from here. 
		$dataArr='Error';
		if($this->input->post('candidate_id')=='')
		{
			echo $dataArr;
			exit();	
		}
		
		$this->load->model('finalverificationmodel');

		$this->data=array(
		'process_status_id'       => $this->input->post('cand_app_id'),
		'coe_title'               => $this->input->post('coe_title'),
		'student_id'              => $this->input->post('student_id'),
		'course_code'             => $this->input->post('course_code'),		
		'annual_tution_fee'       => $this->input->post('annual_tution_fee'),
		'course_duration'         => $this->input->post('course_duration'),
		'course_commencement'     => $this->input->post('course_commencement'),
		'orientation_date'        => $this->input->post('orientation_date'),
		'start_date'              => $this->input->post('start_date'),
		'end_date'                => $this->input->post('end_date'),
		'course_details'          => $this->input->post('course_details'),	
		'app_status'              => '1',
		);
		
		$this->db->where('candidate_id', $this->input->post('candidate_id'));
		$this->db->where('app_id', $this->input->post('cand_app_id'));
		$this->db->update('pms_candidate_applications', $this->data); 
		
		// take all related data into the arary to send email and sms
		$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*  FROM  pms_candidate a inner join pms_candidate_applications b on a.candidate_id=b.candidate_id inner join pms_courses c on b.course_id=c.course_id inner join pms_education_level d on c.level_study=d.level_id inner join pms_university_intake e on b.intake_id=e.intake_id where a.candidate_id =".$this->input->post('candidate_id')." and b.app_id=".$this->input->post('cand_app_id')." and b.app_status=1");
		$row = $query->row_array();

		// sending SMS from here
		//$this->send_sms($row['mobile'],$row['first_name'],$msg);
		$msg='Certificate of Enrollment received for your program.';
		$this->send_sms('9895251980',$row['first_name'],$msg);
		//send_email from here
		
		$data =array(
		'Certificate of Enrollment'   => $row['coe_title'],
		'Student ID'                  => $row['student_id'],
		'Course Code'                 => $row['course_code'],		
		'Annual Tution Fee'           => $row['annual_tution_fee'],
		'Course Duration'             => $row['course_duration'],
		'Course Commencement'         => $row['course_commencement'],
		'Orientation Date'            => $row['orientation_date'],
		'Start Date'                  => $row['start_date'],
		'End Date'                    => $row['end_date'],
		'Course Details'              => $row['course_details'],
		);
		//email to candidate
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com',
			'email_to_name'          =>  $row['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$this->send_email($email_array);
		
		// EMAIL TO ADMIN
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
			'email_to_name'          =>  'ABE Services [Cochin]',
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE CRM',
			'email_reply_to'         =>  'abeservices@gmail.com',
			'email_reply_to_name'    =>  'ABE CRM',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',				
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);
		$this->send_email($email_array);
		// email function ends here.
		exit();
	}

	//Candidate View
	function candidate_visa($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);

		$this->data['visa_approval_list']=$this->finalverificationmodel->visa_approval_list($candidate_id);
		$this->data['app_list_coe']=$this->finalverificationmodel->select_aplication_visa($candidate_id);

		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_visa",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	// VISA update on an application
	function create_visa(){

		$dataArr='Error';
		
		if($this->input->post('candidate_id')=='')
		{
			echo $dataArr;
			exit();	
		}
	
		$this->load->model('finalverificationmodel');

		$data=array(
		'app_id'             =>  $this->input->post('app_id'),
		'candidate_id'       =>  $this->input->post('candidate_id'),
		'visa_apprv_date'    =>  $this->input->post('visa_apprv_date'),		
		'travel_date'        =>  $this->input->post('travel_date'),
		'date_of_join'       =>  $this->input->post('date_of_join'),
		'sms_text'           =>  $this->input->post('sms_text'),
		'email_text'         =>  $this->input->post('email_text'),
		'comments'           =>  $this->input->post('comments'),
		'date_invoice'       =>  date('Y-m-d'),
		'app_won_by'         =>  $_SESSION['vendor_session'],
		);
	
		$this->db->insert('pms_candidate_visa_approval', $data); 
	
		$data=array(
		'app_status'              => '2',
		);

		$this->db->where('candidate_id', $this->input->post('candidate_id'));
		$this->db->where('app_id', $this->input->post('app_id'));
		$this->db->update('pms_candidate_applications', $data); 

		// take all related data into the arary to send email and sms
		$query = $this->db->query("SELECT a.*,b.*,c.*,d.*,e.*,f.*  FROM  pms_candidate a inner join pms_candidate_applications b on a.candidate_id=b.candidate_id inner join pms_courses c on b.course_id=c.course_id inner join pms_education_level d on c.level_study=d.level_id inner join pms_university_intake e on b.intake_id=e.intake_id inner join pms_candidate_visa_approval f on b.app_id=f.app_id where a.candidate_id =".$this->input->post('candidate_id')." and b.app_id=".$this->input->post('app_id')." and b.app_status=2");
		$row = $query->row_array();

		// sending SMS from here
		//$this->send_sms($row['mobile'],$row['first_name'],$msg);
		$msg='VISA approved.';
		$this->send_sms('9895251980',$row['first_name'],$msg);
		//send_email from here
		
		$data =array(
		'Visa Approved Date'   => $row['visa_apprv_date'],
		'Travel Date'                  => $row['travel_date'],
		'Date of Join'                 => $row['date_of_join'],		
		'Details'           => $row['comments'],
		);
		
		//email to candidate
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com',
			'email_to_name'          =>  $row['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$this->send_email($email_array);
		
		// EMAIL TO ADMIN
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
			'email_to_name'          =>  'ABE Services [Cochin]',
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE CRM',
			'email_reply_to'         =>  'abeservices@gmail.com',
			'email_reply_to_name'    =>  'ABE CRM',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',				
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);
		$this->send_email($email_array);
		// email function ends here.
				
		exit();		
	}
	
	
// Manage Email & SMS
	function email_sms($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		$this->data['email_sms_list']=$this->finalverificationmodel->email_sms_list($candidate_id);
	
		if($this->input->post('send_type')!='')
		{
			$data=array(
			'candidate_id'   => $this->input->post('candidate_id'),
			'date_sent'      => date('Y-m-d H:i:s'),
			'subject'        => $this->input->post('subject'),
			'email_text'     => $this->input->post('email_text'),
			'sms_text'       => $this->input->post('sms_text'),
			'user_id'        => $_SESSION['vendor_session'],
			'send_type'      => $this->input->post('send_type'),
			);				
			$this->db->insert('pms_email_sms_history',$data);
			$id=$this->db->insert_id();

			// take all related data into the arary to send email and sms
			$query = $this->db->query("SELECT a.* FROM  pms_candidate a where a.candidate_id =".$this->input->post('candidate_id'));
			$row = $query->row_array();
			if($this->input->post('send_type')==2)
			{
				// SMS only
				$msg=$this->input->post('sms_text');
				$this->send_sms('9895251980',$row['first_name'],$msg);
			}elseif($this->input->post('send_type')==1)			
			{
				//Email Only
				$data =array(
				'Message'   => $this->input->post('email_text'),
				);
			
				//email to candidate
				$email_array=array(
					'email_to'               =>  'shaijotm@gmail.com',
					'email_to_name'          =>  $row['first_name'],
					'email_cc'               =>  '',
					'email_from'             =>  'info@abeservices.biz',
					'from_name'              =>  'ABE Services',
					'email_reply_to'         =>  'info@abeservices.biz',
					'email_reply_to_name'    =>  'ABE Services',
					'subject'                =>  $this->input->post('subject'),
					'salutation'              =>  'Dear '.$row['first_name'].',',
					'table_head'             =>  'ABE Services',
					'text_before_table'      =>  'You have a message from ABE services.',
					'table_rows'             =>  $data,
					'text_after_table'       =>  '-------------',					
					'signature_name'         =>  'ABE Services',
					'signature'              =>  '',

					'date'                   =>  date('Y-m-d'),
				);
				$this->send_email($email_array);
			}elseif($this->input->post('send_type')==3)
			{
				// sending SMS & Email

				$msg='Message From ABE.';
				$this->send_sms('9895251980',$row['first_name'],$msg);				
				$data =array(
				'Message'   => '',
				);
			
				//email to candidate
				$email_array=array(
					'email_to'               =>  'shaijotm@gmail.com',
					'email_to_name'          =>  $row['first_name'],
					'email_cc'               =>  '',
					'email_from'             =>  'info@abeservices.biz',
					'from_name'              =>  'ABE Services',
					'email_reply_to'         =>  'info@abeservices.biz',
					'email_reply_to_name'    =>  'ABE Services',
					'subject'                =>  'New Program Selected',
					'salutation'              =>  'Dear '.$row['first_name'].',',
					'table_head'             =>  'ABE Services',
					'text_before_table'      =>  'New program created, here is the details.',
					'table_rows'             =>  $data,
					'text_after_table'       =>  '-------------',					
					'signature_name'         =>  'ABE Services',
					'signature'              =>  '',
					'date'                   =>  date('Y-m-d'),
				);
				$this->send_email($email_array);
				//email function ends here.					
			}
			redirect('final_verify/email_sms/'.$candidate_id);
		}
		$this->data['error']="Fill subject and email content to send to the candidate.";
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_email_sms",$this->data);
		$this->load->view("include/footer",$this->data);
	}
// Schedule an interview
	function interview(){
	
		if($this->input->post('candidate_id')=='')
		{
			echo 'Error';
			exit();
		}
		
		$data=array(
		'candidate_id'     => $this->input->post('candidate_id'),
		'interview_date'   => $this->input->post('interview_date'),
		'title'            => $this->input->post('title'),
		'description'      => $this->input->post('interview'),
		'duration'         => $this->input->post('duration'),
		'interview_time'   => $this->input->post('interview_time'),
		'interview_type_id'=> $this->input->post('interview_type'),
		'int_status_id'    => $this->input->post('interview_status'),
		'location'         => $this->input->post('location'),
		);

		$this->db->insert('pms_candidate_interviews',$data);
		$id=$this->db->insert_id();
		$this->load->model('finalverificationmodel');
		$this->data['interview_list']=$this->finalverificationmodel->select_interview_record($id);
		$dataArr = $this->load->view('final_verify/candidateinterview_list', $this->data,TRUE);
	
	
	// take all related data into the arary to send email and sms
		$query = $this->db->query("SELECT a.*  FROM  pms_candidate a where a.candidate_id =".$this->input->post('candidate_id'));
		$row = $query->row_array();

		// sending SMS from here
		//$this->send_sms($row['mobile'],$row['first_name'],$msg);
		$msg='An interview scheduled from ABE srvices, please contact for further details.';
		$this->send_sms('9895251980',$row['first_name'],$msg);
		//send_email from here
		
		$data =array(
		'Interview Date'        => $this->input->post('interview_date'),
		'Interview for'         => $this->input->post('title'),
		'Details'               => $this->input->post('interview'),		
		'Duration'              => $this->input->post('duration'),
		'Interview Time'        => $this->input->post('interview_time'),
		);
		
		//email to candidate
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com',
			'email_to_name'          =>  $row['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'An Interview Scheduled',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'An interview scheduled, please find details below.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$this->send_email($email_array);
		
		// EMAIL TO ADMIN
		$email_array=array(
			'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
			'email_to_name'          =>  'ABE Services [Cochin]',
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE CRM',
			'email_reply_to'         =>  'abeservices@gmail.com',
			'email_reply_to_name'    =>  'ABE CRM',
			'subject'                =>  'New Program Selected',
			'salutation'              =>  'Dear '.$row['first_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  'New program created, here is the details.',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',				
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);
		$this->send_email($email_array);
		// email function ends here.
		echo $dataArr;
		exit();
	}
	
	
	// Manage complaints
	function tickets($candidate_id)
	{

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);

			$this->data['ticket_list']=$this->finalverificationmodel->ticket_list($candidate_id);
		
			if($this->input->post('send_type')!='')
			{
				$data=array(
				'candidate_id'   => $this->input->post('candidate_id'),
				'ticket_date'      => date('Y-m-d H:i:s'),
				'ticket_title'        => $this->input->post('ticket_title'),
				'ticket_description'      => $this->input->post('ticket_description'),
				);
					
				$this->db->insert('pms_tickets',$data);
				$id=$this->db->insert_id();
				redirect('final_verify/tickets/'.$candidate_id);
			}
			
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			$this->data['error']="Fill appropriate details and send to candidates.";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_complaints",$this->data);
			$this->load->view("include/footer",$this->data);
	}
	

	// Manage Summary & Reports
	function invoice($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		$this->data['education_details'] = $this->finalverificationmodel->education_deatils($candidate_id);
		$this->data['job_history'] = $this->finalverificationmodel->job_list($candidate_id);
		$this->data['all_counselor'] = $this->finalverificationmodel->all_counselor($candidate_id);
		$this->data['candidate_counselor'] = $this->finalverificationmodel->candidate_counselor($candidate_id);

		if($this->input->post('candidate_id')!=''){
		
		foreach($this->input->post('admin_id') as $key => $val)
		{
			$this->db->where('admin_id',$val);
			$this->db->where('candidate_id',$this->input->post('candidate_id'));
			$this->db->delete('pms_admin_candidates');
			
			if($this->input->post('action')=='Add')
			{
				$data=array(
				'candidate_id'   =>$this->input->post('candidate_id'),
				'admin_id'        =>$val,
				'assigned_date'=> date('Y-m-d'),
				);			
				$this->db->insert('pms_admin_candidates',$data);
			}
		}
			
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_summary",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_invoice",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

		
	// Manage CV File
	function cvfile($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->finalverificationmodel->cvfile_list($candidate_id);
		
		if($this->input->post('cvfile')!=''){
			$data=array(
			'candidate_id'   =>$this->input->post('candidate_id'),
			'cv_file'        =>$this->input->post('cvfile'),
			);
			
			$this->db->insert('pms_candidate_cvfile',$data);
			$id=$this->db->insert_id();
			
			redirect('final_verify/cvfile/'.$candidate_id);
			$path = '../js/ckfinder';
			$width = '100%';
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_cvfile",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_cvfile",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Job History
	function job_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');


		$this->data['formdata']=array(
				'organization'=> '',
				'designation' => '',
				'job_cat_id'=> '',
				'func_id' => '',
				'responsibility' => '',
				'from_date' => '',
				'to_date' => '',
				'monthly_salary' => '',
				'currency_id' => '',
				'present_job' => '',
				'exp_years' => '',
				'exp_months' =>'',
				'skills' => ''
		);
		//employment
		$this->data["industry_list"] = $this->finalverificationmodel->industry_list();
		$this->data["functional_list"] = $this->finalverificationmodel->functional_list();
		$this->data["currecy_list"] = $this->finalverificationmodel->currency_list();
		$this->data["years_list"] = $this->finalverificationmodel->years_list();
		$this->data["months_list"] = $this->finalverificationmodel->months_list();

		
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->finalverificationmodel->job_list($candidate_id);

		if($this->input->post('candidate_id')!=''){
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'organization'=> $this->input->post('organization'),
						'designation' => $this->input->post('designation'),
						'job_cat_id'=> $this->input->post('job_cat_id'),
						'func_id' => $this->input->post('func_id'),
						'responsibility' => $this->input->post('responsibility'),
						'from_date' => $this->input->post('from_date'),
						'to_date' => $this->input->post('to_date'),
						'monthly_salary' => $this->input->post('monthly_salary'),
						'currency_id' => $this->input->post('currency_id'),
						'present_job' => $this->input->post('present_job'),
				);
			$this->db->insert('pms_candidate_job_profile', $data);
			redirect('final_verify/job_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	
	
	function job_history_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');


		$this->data['formdata']=array(
				'organization'=> '',
				'designation' => '',
				'job_cat_id'=> '',
				'job_cat_id'=> '',
				'func_id' => '',
				'responsibility' => '',
				'from_date' => '',
				'to_date' => '',
				'monthly_salary' => '',
				'currency_id' => '',
				'present_job' => '',
				'exp_years' => '',
				'exp_months' =>'',
				'skills' => ''
		);
		//employment
		$this->data["industries_list"] = $this->finalverificationmodel->industries_list();
		$this->data["industry_list"] = $this->finalverificationmodel->industry_list();
		$this->data["functional_list"] = $this->finalverificationmodel->functional_list();
		$this->data["currecy_list"] = $this->finalverificationmodel->currency_list();
		$this->data["years_list"] = $this->finalverificationmodel->years_list();
		$this->data["months_list"] = $this->finalverificationmodel->months_list();

		
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->finalverificationmodel->job_list($candidate_id);

		if($this->input->post('candidate_id')!=''){
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'organization'=> $this->input->post('organization'),
						'designation' => $this->input->post('designation'),
						'job_cat_id'=> $this->input->post('job_cat_id'),
						'job_cat_id'=> $this->input->post('job_cat_id'),
						'func_id' => $this->input->post('func_id'),
						'responsibility' => $this->input->post('responsibility'),
						'from_date' => $this->input->post('from_date'),
						'to_date' => $this->input->post('to_date'),
						'monthly_salary' => $this->input->post('monthly_salary'),
						'currency_id' => $this->input->post('currency_id'),
						'present_job' => $this->input->post('present_job'),
				);
			$this->db->insert('pms_candidate_job_profile', $data);
			redirect('final_verify/summary/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Education History
	function edu_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');

		$this->data['formdata']=array(
				'level_id'=> '',
				'course_id' => '',
				'spcl_id'=> '',
				'univ_id' => '',
				'edu_year' => '',
				'edu_country' => '',
				'course_type_id' => '',
				'arrears' => '',
				'absesnse' => '',
				'repeat' => '',
				'year_back' => '',
				'mark_percentage' => '',
				'grade' => ''
		);

		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"]   = $this->finalverificationmodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->finalverificationmodel->edu_years_list();
		//$this->data["edu_course_list"]  = $this->finalverificationmodel->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->finalverificationmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->finalverificationmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->finalverificationmodel->edu_course_type_list();

		//data for left panel
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->finalverificationmodel->education_list($candidate_id);
		//print_r($this->data['cv_fileist']);
		//exit();
		if($this->input->post('candidate_id')!='')
		{
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'level_id'     => $this->input->post('level_id'),
						'course_id'    => $this->input->post('course_id'),
						'spcl_id'      => $this->input->post('spcl_id'),
						'univ_id'      => $this->input->post('univ_id'),
						'edu_year'     => $this->input->post('edu_year'),
						'edu_country'  => $this->input->post('edu_country'),
						'course_type_id' => $this->input->post('course_type_id'),
						'arrears' => $this->input->post('arrears'),
						'absesnse' => $this->input->post('absesnse'),
						'repeat' => $this->input->post('repeat'),
						'year_back' => $this->input->post('year_back'),
						'mark_percentage' => $this->input->post('mark_percentage'),
						'grade' => $this->input->post('grade'),
				);

			$this->db->insert('pms_candidate_education', $data);
			redirect('final_verify/edu_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new education details";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_edu_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	
	
	
	function edu_history_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');

		$this->data['formdata']=array(
				'level_id'=> '',
				'course_id' => '',
				'spcl_id'=> '',
				'univ_id' => '',
				'edu_year' => '',
				'edu_country' => '',
				'course_type_id' => '',
				'arrears' => '',
				'absesnse' => '',
				'repeat' => '',
				'year_back' => '',
				'mark_percentage' => '',
				'grade' => ''
		);

		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"]   = $this->finalverificationmodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->finalverificationmodel->edu_years_list();
		//$this->data["edu_course_list"]  = $this->finalverificationmodel->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->finalverificationmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->finalverificationmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->finalverificationmodel->edu_course_type_list();

		//data for left panel
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->finalverificationmodel->education_list($candidate_id);
		//print_r($this->data['cv_fileist']);
		//exit();
		if($this->input->post('candidate_id')!='')
		{
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'level_id'     => $this->input->post('level_id'),
						'course_id'    => $this->input->post('course_id'),
						'spcl_id'      => $this->input->post('spcl_id'),
						'univ_id'      => $this->input->post('univ_id'),
						'edu_year'     => $this->input->post('edu_year'),
						'edu_country'  => $this->input->post('edu_country'),
						'course_type_id' => $this->input->post('course_type_id'),
						'arrears' => $this->input->post('arrears'),
						'absesnse' => $this->input->post('absesnse'),
						'repeat' => $this->input->post('repeat'),
						'year_back' => $this->input->post('year_back'),
						'mark_percentage' => $this->input->post('mark_percentage'),
						'grade' => $this->input->post('grade'),
				);

			$this->db->insert('pms_candidate_education', $data);
			//redirect('final_verify/edu_history/'.$this->input->post('candidate_id'));
			redirect('final_verify/summary/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new education details";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_edu_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	
	
	
	// Manage Lang History
	function lang_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->finalverificationmodel->country_list();
		$this->data["formdata"] = $this->finalverificationmodel->get_passport_single_record($candidate_id);
		
		
		
		//Edit Language Modal
		//Language Deatils
		$this->data['lang_list']=$this->finalverificationmodel->get_language_set();
		$candidate_certifications =$this->finalverificationmodel->candidate_languages($candidate_id);
		
		$languages=array();
		foreach($candidate_certifications as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
		//employment
		
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		
		if($this->input->post('candidate_id')!=''){

			   $this->finalverificationmodel->edit_passport_detail($this->input->post('candidate_id'));
			   redirect('final_verify/lang_history/'.$this->input->post('candidate_id'));
		}
		else
		{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_lang_history",$this->data);
			$this->load->view("include/footer",$this->data);


		}	
	}
	

	function lang_history_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');

		if($this->input->post('candidate_id')!=''){

			   $this->finalverificationmodel->edit_passport_detail($this->input->post('candidate_id'));
			   redirect('final_verify/summary/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_lang_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Questionnaire
	function questionnaire($candidate_id)
	{
		$this->load->library('upload');
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->data['survey_result']=$this->finalverificationmodel->get_survey_result($candidate_id);
		
		$this->data['cv_file']='';
		$this->data['photo_file']='';
		
		$cv_file=0;
		$photo_file=0;
		if($this->input->get('cv_file')==1)$this->data['cv_file']='CV Uploaded Successfully, please view it from summary page.';
		if($this->input->get('photo_file')==1)$this->data['photo_file']='Photo Uploaded Successfully, please view it from summary page.';
		
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->finalverificationmodel->job_list($candidate_id);
		
		if($this->input->post('candidate_id')!='')
		{
				$survey_array=array();
				foreach($_POST as $key => $val)
				{
					if($key!='candidate_id' && $key!='cv_file' && $key!='photo')
					{
						$key=str_replace('qt_','',$key);
						$survey_array[]=array('candidate_id' => $candidate_id,'answer_id' => $key, 'answer_value' => $val);
					}
				}
				if(count($survey_array)>0)
				{
					$this->db->query("delete from pms_candidate_survey_result where candidate_id=".$candidate_id);
					foreach($survey_array as $item => $val)
					{
						$this->db->insert('pms_candidate_survey_result', $val);
					}
				}
					
				if(isset($_FILES['cv_file'])){
					if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
					{       				
						$config['upload_path'] = 'uploads/cvs/';
						$config['allowed_types'] = 'doc|docx|pdf|txt';
						$config['max_size']	= '0';
						$config['file_name'] = md5(uniqid(mt_rand()));
						$this->upload->initialize($config);	
					
						if ($this->upload->do_upload('cv_file'))
						{
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];					
							$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $candidate_id
							);
							$this->finalverificationmodel->insert_files($dataArr);
									$cv_file=1;
						}
					}
				}
				
				if(isset($_FILES['photo'])){	
					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
					{         
						$photo['upload_path'] = 'uploads/photos/';
						$photo['allowed_types'] = 'png|jpg|jpeg|gif';
						$photo['max_size']	= '0';
						$photo['file_name'] = md5(uniqid(mt_rand()));
					
						$this->upload->initialize($photo);
						if ($this->upload->do_upload('photo'))
						{
						
							$this->upload_file_name='';
							$data =  $this->upload->data();	
							$this->upload_file_name=$data['file_name'];					
							$this->db->query("update pms_candidate set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $candidate_id
							);
							$this->finalverificationmodel->insert_files($dataArr);
							$photo_file=1;
						}
					}
				}
			   redirect('final_verify/questionnaire/'.$this->input->post('candidate_id').'?cv_file='.$cv_file.'&photo_file='.$photo_file);
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("final_verify/candidate_questionnaire",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

// tech skills

	function skills($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		
		if($this->input->post('candidate_id'))
		{
			if(is_array($this->input->post('skill')))
			{
				$this->db->query("delete from pms_candidate_to_skills where candidate_id=".$candidate_id);
				foreach($this->input->post('skill') as $key => $val)
				{				
					$data=array('skill_id' => $val , 'candidate_id' => $this->input->post('candidate_id'));
					
					$this->db->insert('pms_candidate_to_skills', $data);
				}
			}else
			{
				
				$this->db->query("delete from pms_candidate_to_skills where candidate_id=".$candidate_id);
				
			}
			   redirect('final_verify/skills/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['skill_list']=$this->finalverificationmodel->get_skill_set();
		$this->data['skill_list_current']=$this->finalverificationmodel->get_skill_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->finalverificationmodel->job_list($candidate_id);
				
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_skills",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	

	function skills_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		
		if($this->input->post('candidate_id'))
		{
			
			$this->finalverificationmodel->insert_skill_details($this->input->post('candidate_id'));
			redirect('final_verify/summary/'.$this->input->post('candidate_id').'?upd=1');
		}
		
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_skills",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
// certifications

function certifications($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		
		if($this->input->post('candidate_id'))
		{
			if(is_array($this->input->post('certifications')))
			{
				$this->db->query("delete from pms_candidate_to_certification where candidate_id=".$candidate_id);
				foreach($this->input->post('certifications') as $key => $val)
				{				
					$data=array('cert_id' => $val , 'candidate_id' => $this->input->post('candidate_id'));
					$this->db->insert('pms_candidate_to_certification', $data);
				}
			}else
			{
				$this->db->query("delete from pms_candidate_to_certification where candidate_id=".$candidate_id);
			}
			   redirect('final_verify/certifications/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['certifications_list']=$this->finalverificationmodel->get_certifications_set();
		$this->data['certifications_list_current']=$this->finalverificationmodel->get_certifications_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->finalverificationmodel->job_list($candidate_id);
		
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/candidate_certifications",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	// Follow up
	function followup()
	{
		$this->load->model('finalverificationmodel');
		if(isset($_POST['candidate_id']))
		{
			//date_default_timezone_set("Asia/Kolkata"); 
			
			$data=array(
			'candidate_id'   =>$_POST['candidate_id'],
			'title'          =>$_POST['title'],
			'status_id'      =>$_POST['status_id'],
			'app_id'         =>$_POST['app_id'],
			'admin_id'       => $_SESSION['vendor_session'],
			'description'    =>$_POST['desc'],
			'flp_date'       => date('Y-m-d h:m:s A')
			);
			
			if($this->input->post('future_followup')==1)
			{
				$data['flp_date_reminder']=$_POST['flp_date_reminder'];
				$data['flp_time_reminder']=$_POST['flp_time_reminder'];
				$data['assigned_to']      =$_POST['assigned_to'];
			}

			$query1=$this->db->insert('pms_candidate_followup',$data);
			$id=$this->db->insert_id();
			
			if($this->input->post('future_followup')==1)
			{
				// insert into tasks table
				$data=array(
					'task_title'          =>  $_POST['title'].' - On- '.$_POST['flp_date_reminder'].' - '.$_POST['flp_time_reminder'],
					'start_date'          =>  date('Y-m-d'),
					'due_date'            =>  $_POST['flp_date_reminder'],
					'task_desc'           =>  $_POST['desc'],
					'admin_id'            =>  $_POST['assigned_to'],
					'project_id'          =>  $_POST['app_id'],
					'candidate_id'        =>  $_POST['candidate_id'],
					'candidate_follow_id' => $id,
				);			
				$query_task=$this->db->insert('pms_tasks',$data);				
			}
			
			
			$this->data['single_list']=$this->finalverificationmodel->select_record($id);
		
			$dataArr = $this->load->view('final_verify/candidatefollowup_list', $this->data,TRUE);
			echo $dataArr;
			exit();
			
				$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
				$row = $query->row_array();
				$subject = 'Follow-up';
				$mail_body		=	'				';
				
				$name = $row['first_name']." ".$row['last_name'];
				$email = $row['username'];
				$this->load->library('email');
				$config['wordwrap'] = TRUE;
				$config['mailtype'] = 'html';
				$this->email->initialize($config);
				$this->email->from('info@abeservices.biz',$name);
				$this->email->to($email);
				$this->email->subject($subject);
				$this->email->message($mail_body);
				if($this->email->send())
				{
					
					return 1;
				}
				else
				{
					return 0;
				}
		}	
	}
	
	
	// Create New Note
	function notes(){
		
	$data=array(
	'candidate_id'   =>$_POST['candidate_id'],
	'title'          =>$_POST['title'],
	'notes'          =>$_POST['note']
	);
	
	$this->db->insert('pms_candidate_notes',$data);
	$id=$this->db->insert_id();
	$this->load->model('finalverificationmodel');
	$this->data['note_list']=$this->finalverificationmodel->select_notes_record($id);
	$dataArr = $this->load->view('final_verify/candidatenotes_list', $this->data,TRUE);
	echo $dataArr;
	
	}
	
	

	// Create an application	
	function visa_approval(){
		$data=array(
		'candidate_id'        =>$_POST['candidate_id'],
		'campus_id'       =>$_POST['campus_id'],
		'course_id'           =>$_POST['course_id'],
		'intake_id'           =>$_POST['intake_id'],
		'app_details'         =>$_POST['app_details'],
		'process_status_id'   =>$_POST['status_id'],	
		);
		$this->db->insert('pms_candidate_applications',$data);
		 $id=$this->db->insert_id();
		$this->load->model('finalverificationmodel');
		$this->data['aplication_list']=$this->finalverificationmodel->select_aplication_coe($id);
		$dataArr = $this->load->view('final_verify/candidate_aplication_list', $this->data,TRUE);
		echo $dataArr;
		exit();	
		$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
			$row = $query->row_array();
			$subject = 'Application';
			$mail_body		=	'';
		
		$name = $row['first_name']." ".$row['last_name'];
		$email = $row['username'];
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('info@abeservices.biz',$name);
		$this->email->to('shaijotm@gmail.com');
		$this->email->subject($subject);
		$this->email->message($mail_body);
		if($this->email->send())
		{
			
			return 1;
		}
		else
		{
			return 0;
		}
	
	}
	


		
	// Drop Records from Follow up
	function drop(){
		 $candidate_follow_id=$_POST['candidate_follow_id'];
		
		$this->load->model('finalverificationmodel');
		 $this->finalverificationmodel->drop_record($candidate_follow_id);
		$dataArr = $this->load->view('final_verify/candidate_view');
		echo $dataArr;
	}
	
	function cvfile_drop(){
		$cvfile_id=$_POST['cvfile_id'];
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->cvfile_drop_record($cvfile_id);		          
	}

	function drop_job_item()
	{
		$job_profile_id=$this->input->post('job_profile_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_job_item($job_profile_id);
	}
	
	function deleteJobDetail($candidateId)
	{
		$job_id=$this->input->post('job_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_job_item($job_id);
		$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId,"VIEW"=>$view);
        echo json_encode($status);
	}

//DELETE EDUCATION DETAILS
	function deleteEducationDetail($candidateId)
	{
		$edu_id=$this->input->post('edu_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_edu_item($edu_id);
		$view	=	$this->educationDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId,"VIEW"=>$view);
        echo json_encode($status);
	}
	function drop_email_sms_item()
	{
		$email_sms_id=$this->input->post('email_sms_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_email_sms_item($email_sms_id);
	}

	function drop_ticket_item()
	{
		$ticket_id=$this->input->post('ticket_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_ticket_item($ticket_id);
	}
		
	function drop_edu_item(){
		$eucation_id=$this->input->post('eucation_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_edu_item($eucation_id);
	}	
	
	function drop_notes(){
		 $candidate_note_id=$_POST['candidate_note_id'];
		
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->note_drop_record($candidate_note_id);
		$dataArr = $this->load->view('final_verify/candidate_view');
		echo $dataArr;
		          
	}
	
	
	 function drop_interviews(){
		 $interview_id=$_POST['interview_id'];
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->interview_drop_record($interview_id);
		$dataArr = $this->load->view('final_verify/candidate_view');
		echo $dataArr;
		          
	}
	
	
	 function drop_aplication(){
		 $app_id=$_POST['app_id'];
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->aplication_drop_record($app_id);
		$dataArr = $this->load->view('final_verify/candidate_view');
		echo $dataArr;
		          
	}
	
		
	function candidate_file($candidate_id)
	{
	

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);
	   if($this->input->post('title')!='')
	   {
   	
			 if(isset($_FILES['photo']))
			 {
					if(!$candidate_id='')
					{
						$this->load->model('finalverificationmodel');
						$id=$this->finalverificationmodel->insert_file($candidate_id);
						redirect('final_verify/candidate_file/'.$this->input->post('candidate_id'));
					}
			}
		}
		$this->data['file_list']=$this->finalverificationmodel->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/manage_files",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function csv_data_import($candidate_id)
	{
	

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('finalverificationmodel');
		$this->data['detail_list'] = $this->finalverificationmodel->detail_list($candidate_id);

	   if($this->input->post('title')!='')
	   {
			$items=split(',',$_POST['title']);
		
			foreach($items as $key => $val)
			{
				$data=array(		
				'city_id'=> 34,
				'zipcode'=> '',     
				'status'=> 1
				);
				
				$this->db->insert('pms_locations', $data);
				
				$id=$this->db->insert_id();
			
			echo '<pre>';
			echo '<code>';
			print_r($data);
			echo '</code>';
			echo '</pre>';
			
			$data=array(
			'location_id'=>$id,
			'location_name'=> trim($val),
			'language_id'=> '1'
			);
			
			$this->db->insert('pms_locations_description', $data);			


   			echo '<pre>';
			echo '<code>';
			print_r($data);
			echo '</code>';
			echo '</pre>';
			
			}
/*			echo '<pre>';
			echo '<code>';
			print_r($items);
			echo '</code>';
			echo '</pre>';*/

			 exit();
		}
		$this->data['file_list']=$this->finalverificationmodel->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		$this->load->view("final_verify/csv_data_import",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function savefile()
	{
	   $candidate_id=$this->input->post('candidate_id');
	   if($this->input->post('title')!='')
	   {
		 if(isset($_FILES['photo']))
		 {
					if(!$candidate_id='')
					{
						$this->load->model('finalverificationmodel');
						$id=$this->finalverificationmodel->insert_file($candidate_id);
						$this->data['upload_list']=$this->finalverificationmodel->get_one_record($id);
						$replay=$this->load->view("final_verify/upload_file",$this->data,TRUE);
						echo $replay;
					}
					else
					{
						redirect("final_verify/candidate_file");
					}
				}
			else{
				 echo "Choose file";
				}
	   }
	   else
	   {
		  echo "Enter Your Title"; 
	   }
	}

	function img_update(){
				  $candidate_id=$this->input->post('candidate_id');
	
	 if(isset($_FILES['photo'])){
						  $this->load->model('finalverificationmodel');
						   $this->finalverificationmodel->update_file($candidate_id);
	
							 $this->data['single_file']=$this->finalverificationmodel->get_one_file($candidate_id);
	
								echo $this->data['single_file']['photo'];
	 }
	 else{
		 echo "Choose file"; 
		 }
	 }

	function deletefile()
	{
		  $id=$_POST['file_id'];
		if(!empty($id))
		{
			$this->db->where('file_id', $id);
			$this->db->delete('pms_candidate_files'); 
		}
	}
	
		function deletefile1()
	{
			 $id=$this->input->post('candidate_id');
		if(!empty($id))
		{
		
			          $this->load->model('finalverificationmodel');
					   $this->finalverificationmodel->delete_file($id);
					    $this->data['delete_file']=$this->finalverificationmodel->delete_one_file($id);
						
                           echo $this->data['delete_file']['photo'];  //$replay=$this->load->view("final_verify/delete_file",$this->data,TRUE);
					         //echo $replay;
			
		}
	
	}

	function delete_cv($id)
	{
		if(!empty($id))
		{
			$query = $this->db->query("select cv_file from pms_candidate where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
				{	
					unlink('uploads/cvs/'.$row['cv_file']);
				}
				$this->db->query("update  pms_candidate set cv_file='' where candidate_id=".$id);
			}
			redirect("final_verify/summary/".$id."?del_cv=1");
		}else
		{
			redirect("final_verify/summary/".$id);
		}
	}

	
	function candidate_delete($id)
	{
		$this->load->model('finalverificationmodel');
		if(!empty($id))
		{
			$this->finalverificationmodel->candidate_delete($id);
			redirect('final_verify/?del=1');
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
			$city	='';
			
			//print_r($data["course_list"]);exit;
			
			foreach($data["city_list"] as $key=>$value)
			{
				$city.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'city_list' => $city);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

	public function getcampus()
	{
	
		$this->load->model('campusmodel');
		if(isset($_POST['univ_id']) && $_POST['univ_id']!='')
		{
			$data=array();
			$data["campus_list"] = $this->campusmodel->get_campus_list($_POST['univ_id']);
			$data = array('success' => true, 'campus_list' => $data["campus_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

//onchange getcourse
	public function getcourses()
	{
		
		$this->load->model('coursemodel');
		if(isset($_POST['level_study']) && $_POST['level_study']!='' && isset($_POST['int_val']) && $_POST['int_val']!='')
		{
			$data=array();
			$data["course_list"] = $this->coursemodel->get_course_list($_POST['level_study'],$_POST['int_val']);
			
			$course	='';
			
			
			foreach($data["course_list"] as $key=>$value)
			{
				$course.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'course_list' => $course);
			
			//$data = array('success' => true, 'course_list' => $data["course_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
//onchange get function	
	public function getfunction()
	{		
		$this->load->model('finalverificationmodel');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$data["function_list"] = $this->finalverificationmodel->function_list_by_category($_POST['category_id']);
			
			$function	='';
			
			//print_r($data["course_list"]);exit;
			
			foreach($data["function_list"] as $key=>$value)
			{
				$function.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'function_list' => $function);
		}
		else
		{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

//onchange get function by multiple	
	public function getfunction_multiple()
	{		
		$html='';
		$this->load->model('finalverificationmodel');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$function_list = $this->finalverificationmodel->function_list_by_category_multiple($_POST['category_id']);
			 
			$data = array('success' => true, 'function_list' => $function_list);
		}
		else
		{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	
//onchnge get location		
	public function getlocation()
	{
		$this->load->model('locationmodel');
		if(isset($_POST['city_id']) && $_POST['city_id']!='')
		{
			$data=array();
			$data["location_list"] = $this->locationmodel->location_list($_POST['city_id']);
			$location	='';

			
			foreach($data["location_list"] as $key=>$value)
			{
				$location.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'location_list' => $location);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	// Assign Candidate
	public function assignAdmin()
	{
		$this->load->model('finalverificationmodel');
		$candidatesArr	= $_POST['selectedArr'];
		$adminId		= $_POST['admin_id'];
		for($i=0;$i<count($candidatesArr);$i++){
			$id = $this->finalverificationmodel->assign_admin_user($candidatesArr[$i],$adminId);
		}
		/***************************** send mail to admin user ***************************/
		$data["adminEmail"] = $this->finalverificationmodel->getAdminEmail($adminId);
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
// send SMS
	public function send_sms($mobile,$first_name,$msg)
	{
			$otp=mt_rand(100000, 999999);
			$sms_text='Dear '.$first_name.', '.$msg;
			
			$sms_text=str_replace(' ','%20',$sms_text);
			$response=file_get_contents('http://sms.logicsms.in/api/sendmsg.php?user=abeservices&pass=grandstream2015&sender=ABECCH&phone='.$mobile.'&text='.$sms_text.'&priority=sdnd&stype=normal');
		  return;
	}
	
	
	// send email
	function send_email($email_array=array())
	{
				$mail_body=$this->load->view('signup/email_template', $email_array,true);
				$headers   = array();
				$headers[] = "MIME-Version: 1.0";
				$headers[] = "Content-type: text/html; charset=iso-8859-1";
				$headers[] = "From: ".$email_array['from_name']." <".$email_array['email_from'].">";
				$headers[] = "Reply-To: ".$email_array['email_reply_to_name']." <".$email_array['email_reply_to'].">";
				$headers[] = "Subject: ".$email_array['subject'];
				$headers[] = "X-Mailer: PHP/".phpversion();
				@mail($email_array['email_to'], $email_array['subject'], $mail_body, implode("\r\n", $headers));
	}
// email ends here	
	
	function change_status()
	{
		$this->load->model('finalverificationmodel');
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
			redirect("final_verify/summary/".$id."?del_photo=1");
		}else
		{
			redirect("final_verify/summary/".$id);
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

//APPLY JOB
	function apply_job($candidateId,$jobId)
	{
		if($candidateId !='' && $jobId !='')
		{
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->apply_job($candidateId,$jobId);
		}
		redirect("final_verify/summary/".$candidateId);
	}
	
	function editSkillCertificateDetail($candidateId)
	{ 
		$this->load->model('finalverificationmodel');
	 	$id  = $this->finalverificationmodel->insert_skill_details($candidateId);
		
		$id  = $this->finalverificationmodel->insert_cert_details($candidateId);
		
		$id  = $this->finalverificationmodel->insert_domain_details($candidateId);
		
		
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}

//FETCHING ALL ORGANISTAION AUTOCOMPLETE
 public function get_all_organisation() {
  $keyword = $this->input->get('organization');

   $result = $this->db->query(' SELECT * FROM pms_candidate_job_profile WHERE (organization LIKE "%'.$keyword.'%" ) group by organization  ORDER BY organization ASC LIMIT 40')->result();
  //echo $this->db->last_query();
  
  $return = array();
  foreach( $result as $model ) {
   $return[] = array(
    'label' => $model->organization,
    'id' => $model->organization,
    
   );
  }
  header('Content-type: application/json');
  die(json_encode($return));
 }
 
//FETCHING ALL DESIGNATION AUTOCOMPLETE
 public function get_all_designation() {
  $keyword = $this->input->get('designation');

   $result = $this->db->query(' SELECT * FROM pms_candidate_job_profile WHERE (designation LIKE "%'.$keyword.'%" ) group by designation  ORDER BY designation ASC LIMIT 40')->result();
  //echo $this->db->last_query();
  
  $return = array();
  foreach( $result as $model ) {
   $return[] = array(
    'label' => $model->designation,
    'id' => $model->designation,
    
   );
  }
  header('Content-type: application/json');
  die(json_encode($return));
 } 
 
 //FETCHING ALL RESPONSIBILITY AUTOCOMPLETE
 public function get_all_responsibility() {
  $keyword = $this->input->get('responsibility');

   $result = $this->db->query(' SELECT * FROM pms_candidate_job_profile WHERE (responsibility LIKE "%'.$keyword.'%" ) group by responsibility  ORDER BY responsibility ASC LIMIT 40')->result();
  //echo $this->db->last_query();
  
  $return = array();
  foreach( $result as $model ) {
   $return[] = array(
    'label' => $model->responsibility,
    'id' => $model->responsibility,
    
   );
  }
  header('Content-type: application/json');
  die(json_encode($return));
 } 

/* start here 10 functions */	 
// step 1
	function update_profile_personal($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_personal($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 2
	function update_profile_address($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_address($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 3
	function update_profile_education($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_education($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 4
	function update_profile_profession($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_profession($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 5
	function update_profile_language($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_language($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}

	// step 6
	function update_profile_tech_skills($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_tech_skills($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
		
	// step 7
	function update_profile_certification($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_certification($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}

	// step 8
	function update_profile_projects($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_projects($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
		
	// step 9
	function update_profile_sports($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_sports($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	// step 10
	function update_profile_social($candidateId){
		$this->load->model('finalverificationmodel');
        $this->finalverificationmodel->update_profile_social($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
										
/* end here 10 functions */	 


	function profile_approval($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		
		$this->data['candidate_id'] = $id;
		
		$this->data['page_head']= 'Edit Profile';

		$this->load->model('finalverificationmodel');  
		$this->load->model('locationmodel');  
		$this->load->model('cittymodel');  
		$this->load->model('statmodel'); 
		$this->load->model('countrymodel');   

		$this->data["personal"] = $this->finalverificationmodel->get_single_record($id);
		$this->data['address'] = $this->finalverificationmodel->get_address($id);
		$this->data['education'] = $this->finalverificationmodel->education_list($id);
		$this->data['job_details'] = $this->finalverificationmodel->get_job_details($id);
		$this->data['language_skills'] = $this->finalverificationmodel->candidate_languages($id);
		$this->data['tech_skills'] = $this->finalverificationmodel->candidate_skills($id);
		$this->data['certification'] = $this->finalverificationmodel->candidate_certifications($id);
		$this->data['domain'] = $this->finalverificationmodel->candidate_domains($id);
		$this->data['sports'] = $this->finalverificationmodel->candidate_sports($id);
		$this->data['social'] = $this->finalverificationmodel->candidate_social($id);
		$this->data['contract'] = $this->finalverificationmodel->get_contract_detail($id);
		$this->data['formdata'] = $this->finalverificationmodel->get_lang_details($id);
		$this->data['profile_status'] = $this->finalverificationmodel->get_profile_status($id);
		$this->data['profile_assessment'] = $this->finalverificationmodel->get_profile_assessment($id);
		
		$this->data["industry_list"] = $this->finalverificationmodel->multiple_industry_list();
		$this->data["functional_list"] = $this->finalverificationmodel->multiple_functional_list();
		
		$this->data['contract_months']=array(
						'0' => 'Select Total Months',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
						'32' => '32',
						'33' => '33',
						'34' => '34',
						'35' => '35',
						'36' => '36'
						);
		
		
		$this->data["profile_list"] = $this->finalverificationmodel->profile_list($id);
		
		//category 
		$category = $this->finalverificationmodel->get_cat_fun_list($id);
		
		$cat_list=array();
		foreach($category as $cat)
		{
			$cat_list[]=$cat['job_cat_id'];
		}
		$this->data['category_list']	=	$cat_list;
		
		
		// funcional area
		$function = $this->finalverificationmodel->get_cat_fun_list($id);
		
		$fun_list=array();
		foreach($function as $fun)
		{
			$fun_list[]=$fun['func_id'];
		}
		$this->data['function_list']	=	$fun_list;
		
		
		
//skills
		
		$this->data['skill_list']=$this->finalverificationmodel->get_parent_skills();

//primary_skills
		$candidate_skills_primary = $this->finalverificationmodel->candidate_skills_primary($id);
		
		$skills_primary=array();
		foreach($candidate_skills_primary as $skill)
		{
			$skills_primary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_primary']	=	$skills_primary;
		
		/*$this->data['res']	=	array();
		$this->data['res1']	=	array();
		
		if(!empty($skill))
		{
		$skill	=	implode(',',$skills);	
		$qry	=	$this->db->query('select * from pms_candidate_skills where parent_skill !=0 and  skill_id in ('.$skill.') ');
		$this->data['res']	= $res	=	$qry->result_array();
		
		$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
		$this->data['res1']	= $res1 =	$qry1->result_array();
		
		$this->data['child_skills']	=	$this->finalverificationmodel->get_child_skills($res1[0]['skill_id']);
		}*/

//secondary skills



		$candidate_skills_secondary = $this->finalverificationmodel->candidate_skills_secondary($id);
		
		$skills_secondary=array();
		foreach($candidate_skills_secondary as $skill)
		{
			$skills_secondary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_secondary']	=	$skills_secondary;
		
//all child skills		
		$this->data['all_child_skills']	=	$this->finalverificationmodel->child_skills();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$height = '900px';
		$this->editor($path, $width,$height);
						

		$this->load->view('include/header',$this->data);
		$this->load->view('final_verify/profile_approve',$this->data);	
		$this->load->view('include/footer',$this->data);
	}
	
	
//EDIT CAtegory and functional area
	function editCategory($candidateId)
	{
		$this->load->model('finalverificationmodel');
	 	$id  = $this->finalverificationmodel->insert_functional($candidateId);

		
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}	
	
	
	
	
//EDIT PRIMARY AND SECONDARY SKILLS
	function editSkills($candidateId)
	{
		$this->load->model('finalverificationmodel');
	 	$id  = $this->finalverificationmodel->insert_skills($candidateId);

		
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	
	
//FINAL VERIFICATION 
	function final_verification($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		
		$this->data['candidate_id'] = $id;
		
		$this->data['page_head']= 'Edit Profile';

		$this->load->model('finalverificationmodel');  
		$this->load->model('locationmodel');  
		$this->load->model('cittymodel');  
		$this->load->model('statmodel'); 
		$this->load->model('countrymodel');   

		$this->data["personal"] = $this->finalverificationmodel->get_single_record($id);
		$this->data['address'] = $this->finalverificationmodel->get_address($id);
		$this->data['education'] = $this->finalverificationmodel->education_list($id);
		$this->data['job_details'] = $this->finalverificationmodel->get_job_details($id);
		$this->data['language_skills'] = $this->finalverificationmodel->candidate_languages($id);
		$this->data['tech_skills'] = $this->finalverificationmodel->candidate_skills($id);
		$this->data['certification'] = $this->finalverificationmodel->candidate_certifications($id);
		$this->data['domain'] = $this->finalverificationmodel->candidate_domains($id);
		$this->data['sports'] = $this->finalverificationmodel->candidate_sports($id);
		$this->data['social'] = $this->finalverificationmodel->candidate_social($id);
		$this->data['contract'] = $this->finalverificationmodel->get_contract_detail($id);//print_r($this->data['contract']);exit;
		$this->data['formdata'] = $this->finalverificationmodel->get_lang_details($id);
		$this->data['profile_status'] = $this->finalverificationmodel->get_profile_status($id);
		$this->data['profile_assessment'] = $this->finalverificationmodel->get_profile_assessment($id);
		$this->data["years_list"] = $this->finalverificationmodel->years_list();
		
		$this->data["industry_list"] = $this->finalverificationmodel->multiple_industry_list();
		$this->data["functional_list"] = $this->finalverificationmodel->multiple_functional_list();
		
		
		//category 
		$category = $this->finalverificationmodel->get_cat_fun_list($id);
		
		$cat_list=array();
		foreach($category as $cat)
		{
			$cat_list[]=$cat['job_cat_id'];
		}
		$this->data['category_list']	=	$cat_list;
		
		
		// funcional area
		$function = $this->finalverificationmodel->get_cat_fun_list($id);
		
		$fun_list=array();
		foreach($function as $fun)
		{
			$fun_list[]=$fun['func_id'];
		}
		$this->data['function_list']	=	$fun_list;
		
		
		$this->data["profile_list"] = $this->finalverificationmodel->profile_list($id);

//skills
		
		$this->data['skill_list']=$this->finalverificationmodel->get_parent_skills();

//primary_skills
		$candidate_skills_primary = $this->finalverificationmodel->candidate_skills_primary($id);
		
		$skills_primary=array();
		foreach($candidate_skills_primary as $skill)
		{
			$skills_primary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_primary']	=	$skills_primary;
		
	//secondary skills
		$candidate_skills_secondary = $this->finalverificationmodel->candidate_skills_secondary($id);
		
		$skills_secondary=array();
		foreach($candidate_skills_secondary as $skill)
		{
			$skills_secondary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_secondary']	=	$skills_secondary;
		
	//all child skills		
		$this->data['all_child_skills']	=	$this->finalverificationmodel->child_skills();

		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
						

		$this->load->view('include/header',$this->data);
		$this->load->view('final_verify/final_verification',$this->data);	
		$this->load->view('include/footer',$this->data);
	}
	function add_lang_details($candidateId){
		$this->load->model('finalverificationmodel');
		$uid = $this->finalverificationmodel->update_lang_detail($candidateId);
		if($uid){
			$status = array("STATUS" => "1");
			echo json_encode($status);
		}
	}
	
	function add_contract_details($candidateId){
		$this->load->model('finalverificationmodel');
		$uid = $this->finalverificationmodel->update_contract_detail($candidateId);
		if($uid){
			$status = array("STATUS" => "1");
			echo json_encode($status);
		}
	}
	
	function change_contract_details($candidateId){
		$this->load->model('finalverificationmodel');
		$uid = $this->finalverificationmodel->update_contract_detail($candidateId);
		if($uid){
			redirect('final_verify/summary/'.$candidateId.'?upd=1');
		}
	}
	
	function update_profile_status($candidateId)
	{
		$this->load->model('finalverificationmodel');
	 	$id  = $this->finalverificationmodel->update_profile_status($candidateId);
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
		$this->load->model('finalverificationmodel');
	 	$id  = $this->finalverificationmodel->update_profile_assessment($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	function process_completed($candidateId)
	{ 
		$this->load->model('finalverificationmodel');
		
		$profile  = $this->finalverificationmodel->get_profile_status($candidateId);
		if(count(array_filter($profile))== 12)
		{
			$this->finalverificationmodel->process_completed($candidateId);
			redirect('final_verify/?upd=1');
		}
		else
		{
			redirect('final_verify/profile_approval/'.$candidateId.'?upd=2');}
	}
	
	function profile_completion($candidateId)
	{ 
		$this->db->query("update pms_candidate set profile_completion=".$this->input->post('profile_completion')." where candidate_id=".$candidateId);

		redirect('final_verify/?upd=1');
		
	}
	function check_profile_complete($candidate_id)
	{
		
		$result  = $this->db->query('SELECT * FROM pms_candidate WHERE candidate_id ="'.$candidate_id.'" ' )->result();
		$result1 = $this->db->query('SELECT * FROM pms_candidate_address WHERE candidate_id ="'.$candidate_id.'" ' )->result();
		$result2 = $this->db->query('SELECT * FROM pms_candidate_to_skills WHERE candidate_id ="'.$candidate_id.'" ' )->result();
		$result3 = $this->db->query('SELECT * FROM pms_candidate_to_certification WHERE candidate_id ="'.$candidate_id.'" ' )->result();
		$result4 = $this->db->query('SELECT * FROM pms_candidate_to_domain WHERE candidate_id ="'.$candidate_id.'" ' )->result();
		$result5 = $this->db->query('SELECT * FROM pms_candidate_education WHERE candidate_id ="'.$candidate_id.'" ' )->result();
		$result6 = $this->db->query('SELECT * FROM pms_candidate_job_profile WHERE candidate_id ="'.$candidate_id.'" ' )->result();
		$result7 = $this->db->query('SELECT * FROM pms_cand_lang WHERE candidate_id ="'.$candidate_id.'" ' )->result();
		if((!empty($result)) &&(!empty($result1)) &&(!empty($result2)) && (!empty($result3)) && (!empty($result4)) && (!empty($result5))&&(!empty($result6)) && (!empty($result7)))
		{
			$this->db->query("update pms_candidate set profile_completion=1 where candidate_id=".$candidate_id);
			$status = array("STATUS" => "1");
            echo json_encode($status);
		}
		else
		{
			$this->db->query("update pms_candidate set profile_completion=0 where candidate_id=".$candidate_id);
			$status = array("STATUS" => "0");
            echo json_encode($status);
		}
	}
	function check_email(){
		
		$this->db->where('username', $this->input->post('email'));

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
		
	}
	
	/*------------------STRAT-----------------*/
	
	// delete personal details
	function deletePersonalDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_personal_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	
	// delete Address details
	function deleteAddressDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_contact_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	// delete Education details
	function deleteEducationHistoryDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_education_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	// delete Address details
	function deleteJobHistoryDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_jobs_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	// delete Address details
	function deleteLanguageDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_language_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function deleteSkillDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_skill_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function deleteCertDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_cert_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function deleteDomainDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_domain_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function deleteGameDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_game_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function deleteSocialDetail($candidateId)
	{
		$cat_id = $this->input->post('cat_id');
		$this->load->model('finalverificationmodel');
		$this->finalverificationmodel->drop_social_item($cat_id,$candidateId);
		//$view	=	$this->jobDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	//onchange get function by multiple	
	public function get_category_function_multiple()
	{		
		$html='';
		$this->load->model('finalverificationmodel');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$function_list = $this->finalverificationmodel->function_list_by_category_multiple($_POST['category_id']);
			 
			$data = array('success' => true, 'function_list' => $function_list);
		}
		else
		{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	
		
	
}

