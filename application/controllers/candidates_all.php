<?php class Candidates_all extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('csvimport');
	  	if(!isset($_SESSION['candidate_session']) || $_SESSION['candidate_session']=='')redirect('logout');		
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
		redirect('candidates_all/summary/');
		exit();
	
	}
		
	function loadContacthtml($id) {
        $this->data['candidate_id'] = $id;
		$this->load->model('candidateallmodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["state_list"] 		= array(''=>'Select State'); //$this->statemodel->state_list();
		$this->data["city_list"] 		= array(''=>'Select City'); //$this->citymodel->city_list();	
        $this->data["location_list"] 	= array(''=>'Select Location');//$this->locationmodel->location_list();
		$this->data["religion_list"]    = $this->candidateallmodel->religion_list();

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
        $this->load->view('candidates_all/addcontactdetail', $this->data);
    }
	
	function addCandidateDetail($candidateId){
		$this->load->model('candidateallmodel');
		$id  = $this->candidateallmodel->insert_contact_detail($candidateId);
		$uid = $this->candidateallmodel->update_contact_detail($candidateId);
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
		$this->load->model('candidateallmodel');
		$this->load->model('visatypemodel');
		$this->data["formdata"]=$this->candidateallmodel->get_passport_details($id);
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidateallmodel->country_list();
		$this->load->view('candidates_all/addpassportdetail', $this->data);
	}

	function addPassportDetail($candidateId){
		$this->load->model('candidateallmodel');
		$uid = $this->candidateallmodel->update_passport_detail($candidateId);
		$status = array("STATUS" => "1");
		echo json_encode($status);
	}
	
	function loadEducationhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidateallmodel');
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
		$this->data["edu_level_list"] = $this->candidateallmodel->edu_level_list();
		$this->data["edu_years_list"] = $this->candidateallmodel->edu_years_list();
		$this->data["edu_course_list"] = $this->candidateallmodel->edu_course_list();
		$this->data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidateallmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidateallmodel->edu_course_type_list();
		$this->load->view('candidates_all/addeducationdetail',$this->data);
	}
	
	function addEducationDetail($candidateId){
		$this->load->model('candidateallmodel');
		$id  = $this->candidateallmodel->insert_education_detail($candidateId);
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
		$this->load->model('candidateallmodel');
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
		$this->data["industry_list"] = $this->candidateallmodel->industry_list();
		$this->data["functional_list"] = $this->candidateallmodel->functional_list();
		$this->data["currecy_list"] = $this->candidateallmodel->currency_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();
		$this->load->view('candidates_all/addjobdetail', $this->data);
	}


	//---------1111-----//
	function add_job_history()
	{
		$candidate_id=$_SESSION['candidate_session'];		
		$this->data['page_head']='job_history';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');

		//employment
		$this->data["industries_list"] = $this->candidateallmodel->industries_list();
		$this->data["industry_list"] = $this->candidateallmodel->industry_list();
		$this->data["functional_list"] = $this->candidateallmodel->functional_list();
		$this->data["currecy_list"] = $this->candidateallmodel->currency_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();
		
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidateallmodel->job_list($candidate_id);

		if($this->input->post('candidate_id')!='')
		{
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'organization'=> $this->input->post('organization'),
						'designation' => $this->input->post('designation'),
						'job_cat_id'=> $this->input->post('job_cat_id'),
						'func_id' => $this->input->post('func_id'),
						'desig_id' => $this->input->post('desig_id'),
						'responsibility' => $this->input->post('responsibility'),
						'from_date' => $this->input->post('from_date'),
						'to_date' => $this->input->post('to_date'),
						'present_job' => $this->input->post('present_job'),
				);
			$this->db->insert('pms_candidate_job_profile', $data);
			redirect('candidates_all/summary/');
		}
	}

	function update_desired_job()
	{
		{
		
			if( $this->input->post('candidate_id')!='')
			{
				$this->load->model('candidateallmodel');
				$candidate_id = $this->input->post('candidate_id');
				$skills=$this->input->post('skills');
				//$data_profile=[];
				// foreach($skills as $skill){
				// 	$data_profile =[
				// 		'desired_jobs' => $skill, 
				// 		'candidate_id' => $candidate_id,  
				// 	];
				// }
				$i = 0;
				foreach($skills as $key=>$skill)
				{
					  $data[$i]['desired_jobs'] = $skill;
					  $data[$i]['candidate_id'] = $candidate_id;
					  $i++;
				}
				
				$this->candidateallmodel->update_desired_jobs_record($candidate_id,$data);
				redirect('candidates_all/summary/?upd=1');
			}else
			{
				echo 'Invalid Data';
				exit();
			}
		}
	}
		
	function loadFilehtml($id)
	{
		if($id=='')exit();
	
		$this->data['candidate_id'] = $id;
		$this->load->model('candidateallmodel');
		$this->load->view('candidates_all/addfiledetail', $this->data);
	}

	// upload files from summary page.
	function upload_cv_photo()
	{
		
		$this->table_name='pms_candidate';
		$this->load->model('candidateallmodel');
		$this->load->library('upload');
		
		$candidate_id = $_SESSION['candidate_session'];	
		
		if($candidate_id!='')
		{
			if(isset($_FILES['cv_file'])){
				
				if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
				{       				
					$config['upload_path'] = $this->config->item('cv_upload_folder');
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
						exit($dataArr);
						$this->candidateallmodel->insert_files($dataArr);
					}
				}
			}
			
			if(isset($_FILES['photo']))
			{	
				
				if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
				{        
					$photo['upload_path'] = $this->config->item('photo_upload_folder');
					
					$photo['allowed_types'] = 'png|jpg|jpeg|gif';
					$photo['max_size']	= '0';
					$photo['file_name'] = md5(uniqid(mt_rand()));
					$this->load->library('upload');
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
						$this->candidateallmodel->insert_files($dataArr);
					}else{
						$error = array('error' => $this->upload->display_errors());
						print_r($error); 
					}
					
				}
			}	
			redirect('candidates_all/summary/');
		}else
		{
			redirect('candidates_all/summary/');
		}		
	}
	
	// add files
	function addfiles(){
		$this->table_name='pms_candidate';
		$this->load->model('candidateallmodel');
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
					$this->candidateallmodel->insert_files($dataArr);
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
					$this->candidateallmodel->insert_files($dataArr);
				}
			}
		}	
		
	}


	function loadEditContacthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidateallmodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["religion_list"]    = $this->candidateallmodel->religion_list();
		
		
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
		
		$this->data["formdata3"] = $this->candidateallmodel->get_address_single_record($id);
		if(count($this->data["formdata3"])<1)
		{
			$this->data["formdata3"]['address']='';
			$this->data["formdata3"]['land_phone']='';
			$this->data["formdata3"]['workphone']='';
			$this->data["formdata3"]['fax']='';
			$this->data["formdata3"]['zipcode']='';
		}
		$this->data['formdata'] = array_merge($this->data['formdata'],$this->data['formdata2'],$this->data["formdata3"]);
        $this->load->view('candidates_all/editcontactdetail', $this->data);

	}
	
	function editCandidateDetail($candidateId){
		$this->load->model('candidateallmodel');
        $this->candidateallmodel->edit_contact_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	function loadEditPassporthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidateallmodel');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidateallmodel->country_list();
		$this->data["formdata"] = $this->candidateallmodel->get_passport_single_record($id);
		$this->load->view('candidates_all/editpassportdetail', $this->data);
	}
	
	function editPassportDetail($candidateId)
	{
		$this->load->model('candidateallmodel');
        $this->candidateallmodel->edit_passport_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}


//------------here---------//	
	function update_resume_headline()
	{
	
		if( $this->input->post('candidate_id')!='')
		{
			$this->load->model('candidateallmodel');
			$candidate_id = $this->input->post('candidate_id');

			
			$data_profile =array(
				'headline'         => $this->input->post('headline'),  
				'candidate_id'         => $this->input->post('candidate_id'),  
			);
			
			$this->candidateallmodel->update_headline_record($candidate_id,$data_profile,);
			redirect('candidates_all/summary/?upd=1');
		}else
		{
			echo 'Invalid Data';
			exit();
		}
	}

	function update_candidate_profile()
	{
	
		if( $this->input->post('candidate_id')!='')
		{
			$this->load->model('candidateallmodel');
			$age=$this->input->post('age');
			$candidate_id = $this->input->post('candidate_id');

		 	if($this->input->post('date_of_birth')!='') $age = $this->get_age($this->input->post('date_of_birth'));
			
			$data_profile =array(
				'first_name'         => $this->input->post('first_name'),
				//'last_name'          => $this->input->post('last_name'),
				'gender'             => $this->input->post('gender') ,
				'marital_status'     => $this->input->post('marital_status'),

				'mobile'                => $this->input->post('mobile'),
				'mobile_prefix'         => $this->input->post('mobile_prefix'),				
				
				'mobile1'                =>  $this->input->post('mobile1'),
				'mobile_prefix1'         => $this->input->post('mobile_prefix1'),	
				'alternate_email'         => $this->input->post('alternate_email'),		
				'cur_job_status'       => $this->input->post('cur_job_status'),		
				'age'                => $age,
				'date_of_birth'      => $this->input->post('date_of_birth'),	
				'passportno'         => $this->input->post('passportno'),
				'visa_type_id'       => $this->input->post('visa_type_id'),
				'nationality'       => $this->input->post('nationality'),
				'city_id'           => $this->input->post('city_id'),
				'skills'           => $this->input->post('skills'),
				'fee_comments'           => $this->input->post('fee_comments'),
				'driving_license'          => $this->input->post('driving_license'),
				'driving_license_country'  => $this->input->post('driving_license_country'),	
				'linkedin_url'	        => $this->input->post('linkedin_url'),   
			);
			
			if($this->input->post('password')!='')$data_profile['password']= md5($this->input->post('password'));
			
			$data_job = array(
					'candidate_id' => $candidate_id,
					'current_ctc' => $this->input->post('current_ctc'),
					'expected_ctc' => $this->input->post('expected_ctc'),
					'notice_period' => $this->input->post('notice_period'),
					'total_experience' => $this->input->post('total_experience'),
					'reason_to_leave'        => $this->input->post('reason_to_leave'),
			);
			$this->candidateallmodel->update_candidate_record($candidate_id,$data_profile,$data_job);
			redirect('candidates_all/summary/?upd=1');
		}else
		{
			echo 'Invalid Data';
			exit();
		}
	}

	/////////////////
	function update_personal_profile()
	{
	
		if( $this->input->post('candidate_id')!='')
		{
			$this->load->model('candidateallmodel');
			$age=$this->input->post('age');
			$candidate_id = $this->input->post('candidate_id');

		 	if($this->input->post('date_of_birth')!='') $age = $this->get_age($this->input->post('date_of_birth'));
			
			$data_profile =array(
				'first_name'         => $this->input->post('first_name'),
				//'last_name'          => $this->input->post('last_name'),
				'gender'             => $this->input->post('gender') ,
				'marital_status'     => $this->input->post('marital_status'),

				'mobile'                => $this->input->post('mobile'),
				'mobile_prefix'         => $this->input->post('mobile_prefix'),				
				
				'mobile1'                =>  $this->input->post('mobile1'),
				'mobile_prefix1'         => $this->input->post('mobile_prefix1'),	
				'alternate_email'         => $this->input->post('alternate_email'),		
						
				'age'                => $age,
				'date_of_birth'      => $this->input->post('date_of_birth'),	
				'passportno'         => $this->input->post('passportno'),
				'nationality'       => $this->input->post('nationality'),
				'city_id'           => $this->input->post('city_id'),
				//'fee_comments'           => $this->input->post('fee_comments'),
				//'skills'           => $this->input->post('skills'),
				  
			);
			
			if($this->input->post('password')!='')$data_profile['password']= md5($this->input->post('password'));
			
			$data_job = array();
			$this->candidateallmodel->update_candidate_record($candidate_id,$data_profile,$data_job);
			redirect('candidates_all/summary/?upd=1');
		}else
		{
			echo 'Invalid Data';
			exit();
		}
	}
	function update_professional_profile()
	{
	
		if( $this->input->post('candidate_id')!='')
		{
			$this->load->model('candidateallmodel');
			$age=$this->input->post('age');
			$candidate_id = $this->input->post('candidate_id');
			if($this->input->post('driving_license')==1){
				$country=$this->input->post('driving_license_country');
			}else{
				$country=0;
			}
			$data_profile =array(
				'visa_type_id'       => $this->input->post('visa_type_id'),
				'driving_license'          => $this->input->post('driving_license'),
				'driving_license_country'  => $country,	
				'linkedin_url'	        => $this->input->post('linkedin_url'),
				'cur_job_status'       => $this->input->post('cur_job_status'), 
				  
			);
			$data_job = array(
					'candidate_id' => $candidate_id,
					'current_ctc' => $this->input->post('current_ctc'),
					'expected_ctc' => $this->input->post('expected_ctc'),
					'notice_period' => $this->input->post('notice_period'),
					'total_experience' => $this->input->post('total_experience'),
					'reason_to_leave'        => $this->input->post('reason_to_leave'),
			);
			$this->candidateallmodel->update_candidate_record($candidate_id,$data_profile,$data_job);
			redirect('candidates_all/summary/?upd=1');
		}else
		{
			echo 'Invalid Data';
			exit();
		}
	}
	function update_otherdetails()
	{
	
		if( $this->input->post('candidate_id')!='')
		{
			$this->load->model('candidateallmodel');
			$candidate_id = $this->input->post('candidate_id');
			$data_profile =array(
				'fee_comments'           => $this->input->post('fee_comments'), 
			);
			
			$data_job = array();
			$this->candidateallmodel->update_candidate_record($candidate_id,$data_profile,$data_job);
			redirect('candidates_all/summary/?upd=1');
		}else
		{
			echo 'Invalid Data';
			exit();
		}
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
			
	function loadEditEducationhtml()
	{
		// start from here.\
		$this->data['candidate_id'] =  $_SESSION['candidate_session'];
		
		$this->data['edu_id'] =  $this->input->get('edu_id');
		
		$this->load->model('candidateallmodel');
		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list();
		$this->data["edu_level_list"] = $this->candidateallmodel->edu_level_list();
		$this->data["edu_years_list"] = $this->candidateallmodel->edu_years_list();
		$this->data["edu_course_list"] = $this->candidateallmodel->edu_course_list();

		$this->data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidateallmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidateallmodel->edu_course_type_list();
		$this->data["formdata"] = $this->candidateallmodel->get_education_single_record($this->data['edu_id']);
		
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
		$data=$this->load->view('candidates_all/editeducationdetail',$this->data,true);
		echo $data;
		exit();
	}

	//EDUCATION DETAILS
	function educationDetails($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('candidateallmodel');
		
		$edu_level = $this->candidateallmodel->edu_level_list();
		$course = $this->candidateallmodel->edu_course_list();
		$spec = $this->candidateallmodel->edu_spec_list();
		
		$results = $this->candidateallmodel->get_education_details($id);
		$form_data	=	array();
		
		foreach($results as $result)
		{ 
			$form_data[]	=	array(
								  'level_name'	=>	isset($edu_level[$result["level_id"]])?$edu_level[$result["level_id"]]:"",
								  'course_name'	=>	isset($course[$result["course_id"]])?$course[$result["course_id"]]:"",
								 'spec_name'	=>	isset($spec[$result["spcl_id"]])?$spec[$result["spcl_id"]]:"",
								 'grade'	    =>	$result["grade"],
								 'eucation_id'	=>	$result["eucation_id"],
								  );
		}
		
		$this->data["form_data"]	=	$form_data;		
		$education_details_view	    =	$this->load->view('candidates_all/education_details',$this->data,true);
		return $education_details_view;
	}

	function edu_history_2()
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='education';
	   $this->data['error']='';
		$this->data['candidate_id']=$_SESSION['candidate_session'];
		$this->load->model('candidateallmodel');

		$this->data['formdata']=array(
				'level_id'=> '',
				'course_id' => '',
				'spcl_id'=> '',
				'univ_id' => '',
				'univ_name' => '',
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
		$this->data["edu_level_list"]   = $this->candidateallmodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->candidateallmodel->edu_years_list();
		//$this->data["edu_course_list"]  = $this->candidateallmodel->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidateallmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidateallmodel->edu_course_type_list();

		//data for left panel
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($this->data['candidate_id']);
		
		$this->data['cv_fileist']=$this->candidateallmodel->education_list($this->data['candidate_id']);
		//print_r($this->data['cv_fileist']);
		//exit();
		if($this->input->post('candidate_id')!='')
		{
				$data = array(
						'candidate_id' => $this->input->post('candidate_id'),
						'level_id'     => $this->input->post('level_id'),
						'course_id'    => $this->input->post('course_id'),
						'spcl_id'      => $this->input->post('spcl_id'),
						'univ_id'      =>$this->input->post('univ_id'),
						'univ_name'      => $this->input->post('univ_name'),
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
			//redirect('candidates_all/edu_history/'.$this->input->post('candidate_id'));
			redirect('candidates_all/summary/');
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new education details";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_all/candidate_edu_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	
	function update_education()
	{
		$this->load->model('candidateallmodel');
		$candidate_id=$_SESSION['candidate_session'];
		$data = array(
				'candidate_id'      => $this->input->post('candidate_id'),
				'level_id'          => $this->input->post('level_id'),
				'course_id'         => $this->input->post('course_id'),
				'spcl_id'           => $this->input->post('spcl_id'),
				'univ_name'           => $this->input->post('univ_name'),
				'edu_year'          => $this->input->post('edu_year'),
				'edu_country'       => $this->input->post('edu_country'),
				'course_type_id'    => $this->input->post('course_type_id'),
				'arrears'           => $this->input->post('arrears'),
				'absesnse'          => $this->input->post('absesnse'),
				'repeat'            => $this->input->post('repeat'),
				'year_back'         => $this->input->post('year_back'),
				'mark_percentage'   => $this->input->post('mark_percentage'),
				'grade'             => $this->input->post('grade'),
		);


		$this->candidateallmodel->update_education($data,$this->input->post('edu_id'),$candidate_id);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidate_id);
		redirect('candidates_all/summary?edu_upd=1');
        //echo json_encode($status);
	}
	
	function editJobChangeDetail($candidateId)
	{
		$this->load->model('candidateallmodel');
        $this->candidateallmodel->edit_job_change_detail($candidateId);
		 $this->candidateallmodel->edit_passport_num_type($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditJobhtml()
	{
		$this->data['job_profile_id'] = $this->input->get('job_profile_id');
		$this->data['candidate_id'] = $_SESSION['candidate_session'];
	
		$this->load->model('candidateallmodel');
		
		$this->data["industry_list"] = $this->candidateallmodel->industries_list();
		$this->data["functional_list"] = $this->candidateallmodel->functional_list();
		$this->data["currecy_list"] = $this->candidateallmodel->currency_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();
		$this->data["formdata"] = $this->candidateallmodel->get_job_single_record($this->data['job_profile_id']);
		
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
		
		$output_string=$this->load->view('candidates_all/editjobdetail', $this->data,true);
		echo $output_string;
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
	
	function update_job_details()
	{
		$data = array(
				'candidate_id' => $this->input->post('candidate_id'),
				'organization'=> $this->input->post('organization'),
				'designation' => $this->input->post('designation'),
				'job_cat_id'=> $this->input->post('job_cat_id'),
				'func_id' => $this->input->post('func_id'),
				'desig_id' => $this->input->post('desig_id'),
				'responsibility' => $this->input->post('responsibility'),
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'monthly_salary' => $this->input->post('monthly_salary'),
				'currency_id' => $this->input->post('currency_id'),
				'present_job' => $this->input->post('present_job'),
		);

		//print_r($_POST);
		//exit();
		
		$this->load->model('candidateallmodel');
		
		$job_profile_id=$this->input->post('job_profile_id');
		$candidate_id=$this->input->post('candidate_id');
		
        $job_profile_id=$this->candidateallmodel->update_job_details($data,$job_profile_id,$candidate_id);
		
		redirect('candidates_all/summary?prof_upd=1');
		
        //$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        //echo json_encode($status);
	}

	function loadEditFilehtml($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('candidateallmodel');
		$this->data['survey_result']=$this->candidateallmodel->get_survey_result($id);
		$this->data["formdata"] = $this->candidateallmodel->get_file_single_record($id);	
		$this->load->view('candidates_all/editfiledetail', $this->data);
	}

	// edit files
	function editfiles(){
		$this->table_name='pms_candidate';
		$this->load->model('candidateallmodel');
		$candidate_id = $this->input->post('candidate_id');		
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
	
	//Candidate View
	function candidate_view($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='follow_up';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);

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
			   redirect('candidates_all/candidate_view/');
		}
						
		$this->data['list']=$this->candidateallmodel->follow_record($candidate_id);
		$this->data['note_list']=$this->candidateallmodel->notes_record($candidate_id);		
		$this->data['coe_list']=$this->candidateallmodel->coe_list($candidate_id);
		$this->data['visa_approval_list']=$this->candidateallmodel->visa_approval_list($candidate_id);

		$this->data['interview_list']=$this->candidateallmodel->interview_record($candidate_id);
		$this->data['aplication_list']=$this->candidateallmodel->aplication_record($candidate_id);
		
		$this->data['interview_status_list']=$this->candidateallmodel->interview_status_list();		
		$this->data['app_list']=$this->candidateallmodel->aplication_list($candidate_id);
		$this->data['app_list_coe']=$this->candidateallmodel->select_aplication_coe($candidate_id);
		$this->data['admin_user_list']=$this->candidateallmodel->admin_user_list();
		$this->data['interview_type_list']=$this->candidateallmodel->interview_type_list();
		$this->data['university_list']=$this->candidateallmodel->university_list();
		$this->data['campus_list']=array('' => 'Select Campus');
		$this->data['intake_list']=$this->candidateallmodel->intake_list();
		$this->data['course_list']=array('' => 'Select Course');;
		$this->data['level_list']=$this->coursemodel->fill_levels();
		$this->data['status_list']=$this->candidateallmodel->status_list();

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_all/candidate_view",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	// Manage Summary & Reports
	function summary()
	{
		
		$candidate_id=$_SESSION['candidate_session'];

		$this->data['registation_msg']='';
		$this->data['applied_msg']='';
		
		if($this->input->get('registation')!='')
		{
			$this->data['registation_msg']='You have registered successfully. Please update your education and work history. You can add any number of details here.';
		}
		
		if($this->input->get('applied')==1)
		{
			$this->data['applied_msg']=' Thank you for applying. If your profile is shortlisted for the role, one of our consultant will be in touch with you soon.';
		}
		
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='summary';
	    $this->data['msg']='';
		
		if($this->input->get('del_cv')==1)$this->data['msg']='CV Deleted successfully';
		if($this->input->get('del_photo')==1)$this->data['msg']='Photo Deleted successfully';
		
		$this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		
		$this->load->model('candidateallmodel');
		$this->load->model('candidateallmodel');
		$this->load->model('countrymodel');

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
		
		$this->data['edit_job_html']='';
		if($this->input->get('edit_job')==1 && $this->input->get('job_profile_id')>0 && $_SESSION['candidate_session'] > 0)
		{
				$this->data['job_profile_id'] = $this->input->get('job_profile_id');
				$this->data['candidate_id'] = $_SESSION['candidate_session'];
				
				$this->data["formdata_job"]             = $this->candidateallmodel->get_job_single_record($this->data['job_profile_id']);
				$this->data["location_ids_pros"]        = $this->candidateallmodel->get_location_ids_job_profile($this->data['job_profile_id']);
			
				$this->data["formdata_job"]["country_id"] = $this->data["location_ids_pros"]["country_id"];
				$this->data["formdata_job"]["state_id"]   = $this->data["location_ids_pros"]["state_id"];
				$this->data["formdata_job"]["city_id"]    = $this->data["location_ids_pros"]["city_id"];	

				$this->data["country_list"] 	= $this->countrymodel->country_list();
				$this->data["state_list"] 	    = $this->candidateallmodel->state_list_by_country($this->data["formdata_job"]["country_id"]);
			
				$this->data["city_list"] 	    = $this->candidateallmodel->location_list_by_state($this->data["formdata_job"]["state_id"]);				

				$this->data["industries_list"] = $this->candidateallmodel->industries_list();
				
				if($this->data["formdata_job"]["job_cat_id"]>0)
					$this->data["functional_list"] =$this->candidateallmodel->get_functional_by_industry($this->data["formdata_job"]["job_cat_id"]);
				else
					$this->data["functional_list"] = $this->candidateallmodel->functional_list();

				if($this->data["formdata_job"]["func_id"]>0)
					$this->data["designation_list"] =$this->candidateallmodel->get_designation_by_function($this->data["formdata_job"]["func_id"]);
				else
					$this->data["designation_list"] = $this->candidateallmodel->desig_list();
							
				$this->data["currecy_list"]         = $this->candidateallmodel->currency_list();
				$this->data["years_list"]           = $this->candidateallmodel->years_list();
				$this->data["months_list"]          = $this->candidateallmodel->months_list();
				
				$this->data['edit_job_html']=$this->load->view('candidates_all/editjobdetail', $this->data,true);
		}
				
		$this->data["formdata"]               = $this->candidateallmodel->get_single_record($candidate_id);

		
//------------here-----------//

		$this->data["headline"]               = $this->candidateallmodel->get_headline_record($candidate_id);
		$this->data["desired_jobs"]               = $this->candidateallmodel->get_desired_jobs_record($candidate_id);
		$this->data["functional_list_data"] = $this->candidateallmodel->functional_list_data();
		$this->data["location_ids"]			  = $this->candidateallmodel->get_country_state_city_ids($candidate_id);
		
		$this->data["formdata"]["country_id"] = $this->data["location_ids"]["country_id"];
		$this->data["formdata"]["state_id"]   = $this->data["location_ids"]["state_id"];
		$this->data["formdata"]["city_id"]    = $this->data["location_ids"]["city_id"];
		
		$this->data['visa_type_list']=$this->candidateallmodel->visa_type_list();
		
		$this->data["cur_job_status_list"] = $this->candidateallmodel->cur_job_status_list();
		
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		$this->data['candidate_languages'] = $this->candidateallmodel->candidate_languages($candidate_id);
		$this->data['education_details'] = $this->candidateallmodel->education_deatils($candidate_id);

		$this->data['job_history'] = $this->candidateallmodel->job_list($candidate_id);
		
		//print_r($this->data['job_history']);
		//exit();
	
		$this->data['followup_history'] = $this->candidateallmodel->get_followup_detail($candidate_id);
		
		$this->data['all_messages'] = $this->candidateallmodel->all_messages($candidate_id);
	
		$this->data['candidate_skill'] = $this->candidateallmodel->candidate_skills($candidate_id);
		
		//candidate doamin knowledge
		$this->data['candidate_domain'] = $this->candidateallmodel->candidate_domains($candidate_id);
		$this->data['admin_user_list']=$this->candidateallmodel->admin_user_list();
		//Certification 
		
		$this->data['cerifications']=$this->candidateallmodel->get_cert();
		$candidate_certifications = $this->candidateallmodel->candidate_certifications($candidate_id);
		
		$cerifications=array();
		foreach($candidate_certifications as $cert)
		{
			$cerifications[]=$cert['cert_id'];
		}
		$this->data['candidate_certifications_id']	=	$cerifications;
		$this->data['candidate_certifications']	=	$candidate_certifications;
		
		$this->data['candidate_questionnaire_summary'] = $this->candidateallmodel->get_survey_result($candidate_id);
		$this->data['candidate_files_summary'] = $this->candidateallmodel->get_files($candidate_id);
		$this->data['candidate_complaints_summary'] = $this->candidateallmodel->ticket_list($candidate_id);

		//Job Search details(candidate_job_serach)
		$this->data['job_search'] = $this->candidateallmodel->job_search($candidate_id);
		//$this->data['feedback_projects'] = $this->data['job_search']['feedback_projects'];
		//print_r($this->data['job_search']);exit;
		//Edit skill Modal

		$this->data['skill_list']=$this->candidateallmodel->get_parent_skills();
		
		$candidate_skills = $this->candidateallmodel->candidate_skills($candidate_id);
		
		$skills=array();
		foreach($candidate_skills as $skill)
		{
			$skills[]=$skill['skill_id'];
		}
		$this->data['candidate_skills']	=	$skills;

		
		//all child skills		
		$this->data['all_child_skills']	=	$this->candidateallmodel->child_skills();
		
		//Edit Language Modal
		//Language Deatils
		$this->data['lang_list']=$this->candidateallmodel->get_language_set();
		$candidate_languages =$this->candidateallmodel->candidate_languages($candidate_id);
		
		$languages=array();
		foreach($candidate_languages as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
		//print_r($languages);
		//exit();
		
		//Edit Education Modal
		
		$this->data["country_list"] 	        = $this->countrymodel->country_list();

		$this->data["state_list"] 	    = $this->candidateallmodel->state_list_by_country($this->data["formdata"]["country_id"]);
		$this->data["city_list"] 	    = $this->candidateallmodel->location_list_by_state($this->data["formdata"]["state_id"]);
				
		$this->data["nationality_list"] 	    = $this->countrymodel->country_list();
		$this->data["current_location_list"] 	= $this->countrymodel->country_list();
		$this->data["city_list"]                = $this->candidateallmodel->city_list();
		
		$this->data["edu_level_list"]   = $this->candidateallmodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->candidateallmodel->edu_years_list();
		//$this->data["edu_course_list"]  = $this->candidateallmodel->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidateallmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidateallmodel->edu_course_type_list();

		//employment
		$this->data["industries_list"] = $this->candidateallmodel->industries_list();
		$this->data["functional_list"] = $this->candidateallmodel->functional_list();
		$this->data["designation_list"] = $this->candidateallmodel->desig_list();	
				
		$this->data["currecy_list"] = $this->candidateallmodel->currency_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();
		
		//suggested jobs to candidate		
		$this->data['suggested_jobs']=$this->candidateallmodel->get_suggested_jobs($candidate_id);	
				
		//applied jobs of candidate		
		$this->data['applied_jobs']=$this->candidateallmodel->get_job_list($candidate_id);

		//shortlisted jobs
		$this->data['shortlisted']=$this->candidateallmodel->get_shortlisted($candidate_id);

		//interview scheduled jobs
		$this->data['interview_list']=$this->candidateallmodel->get_interview_list($candidate_id);

		//selected jobs
		$this->data['jobs_selected']=$this->candidateallmodel->jobs_selected($candidate_id);

		//offer letters issued
		$this->data['offer_letters_issued']=$this->candidateallmodel->offer_letters_issued($candidate_id);
		
		//offer accepted
		$this->data['offer_accepted']=$this->candidateallmodel->offer_accepted($candidate_id);

		//invoice genereted
		$this->data['invoice_generated']=$this->candidateallmodel->invoice_generated($candidate_id);


		//all child skills		
		$this->data['all_child_skills']	=	$this->candidateallmodel->child_skills();

		//present contract details
		$this->data['contract']=$this->candidateallmodel->get_contract_detail($candidate_id);
		//print_r($this->data['contract']);
		//exit();
		//contracts months
	
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


		/*--------------------------------------------------------------------------*/		
		//category /industry
		$category = $this->candidateallmodel->get_cat_list($candidate_id);		
		$cat_list=array();		
		foreach($category as $cat)
		{
			$cat_list[]=$cat['job_cat_id'];
		}
		$this->data['category_list']	=	$cat_list;
		$this->data['category_name']	=	$category;
		
		
		// funcional area
		$function = $this->candidateallmodel->get_function_list($candidate_id);
		
		$fun_list=array();
		foreach($function as $fun)
		{
			$fun_list[]=$fun['func_id'];
		}
		$this->data['function_list']	=	$fun_list;
		$this->data['function_name']	=	$function;


		// designation list
		$designation = $this->candidateallmodel->get_designation_list($candidate_id);		
		$desig_list=array();
		foreach($designation as $desig)
		{
			$desig_list[]=$desig['desig_id'];
		}
		$this->data['desig_list']	=	$desig_list;
		$this->data['desig_name']	=	$designation;				
		
		/*-----------------------------------------------------------------*/
		
		//primary_skills
		$candidate_skills_primary = $this->candidateallmodel->candidate_skills_primary($candidate_id);
		
		$skills_primary=array();
		foreach($candidate_skills_primary as $skill)
		{
			$skills_primary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_primary']	=	$skills_primary; 
		
		$this->data['skills_primary']	        =	$candidate_skills_primary;
	

			//secondary skills
		$candidate_skills_secondary = $this->candidateallmodel->candidate_skills_secondary($candidate_id);
		
		$skills_secondary=array();
		foreach($candidate_skills_secondary as $skill)
		{
			$skills_secondary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_secondary']	=	$skills_secondary;
		
		$this->data['skills_secondary']	            =	$candidate_skills_secondary;

		//Language Deatails pms_candidate_language
		//$this->data['lang_details'] = $this->candidateallmodel->get_lang_details($candidate_id);
		

		/*--------------------------------------------------------------------------*/
		
		if($this->input->post('candidate_id')!=''){
				foreach($this->input->post('candidate_id') as $key => $val)
				{
					$this->db->where('candidate_id',$val);
					$this->db->where('candidate_id',$this->input->post('candidate_id'));
					$this->db->delete('pms_admin_candidates');
					
						if($this->input->post('action')=='Add')
						{
							$data=array(
							'candidate_id'   =>$this->input->post('candidate_id'),
							'candidate_id'        =>$val,
							'assigned_date'   => date('Y-m-d'),
							);			
							$this->db->insert('pms_admin_candidates',$data);
						}
				}
			redirect('candidates_all/summary/');
		}
		
		$this->load->view("candidate-profile/header",$this->data);
		$this->load->view("candidate-profile/include/sidebar",$this->data);
		$this->load->view("candidate-profile/include/head",$this->data);
		$this->load->view("candidate-profile/dashboard",$this->data);
		$this->load->view("candidate-profile/footer",$this->data);
		//print_r($this->data["formdata"]);
		//exit();
		// $this->load->view("include/header",$this->data);
		// $this->load->view("candidates_all/candidate_summary",$this->data);
		// $this->load->view("include/footer",$this->data);
	}
	function summary1()
	{
		
		$candidate_id=$_SESSION['candidate_session'];

		$this->data['registation_msg']='';
		$this->data['applied_msg']='';
		
		if($this->input->get('registation')!='')
		{
			$this->data['registation_msg']='You have registered successfully. Please update your education and work history. You can add any number of details here.';
		}
		
		if($this->input->get('applied')==1)
		{
			$this->data['applied_msg']=' Thank you for applying. If your profile is shortlisted for the role, one of our consultant will be in touch with you soon.';
		}
		
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='summary';
	    $this->data['msg']='';
		
		if($this->input->get('del_cv')==1)$this->data['msg']='CV Deleted successfully';
		if($this->input->get('del_photo')==1)$this->data['msg']='Photo Deleted successfully';
		
		$this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		
		$this->load->model('candidateallmodel');
		$this->load->model('candidateallmodel');
		$this->load->model('countrymodel');

		$path = '../js/ckfinder';
		$width = '100%';
		$this->editor($path, $width);
		
		$this->data['edit_job_html']='';
		if($this->input->get('edit_job')==1 && $this->input->get('job_profile_id')>0 && $_SESSION['candidate_session'] > 0)
		{
				$this->data['job_profile_id'] = $this->input->get('job_profile_id');
				$this->data['candidate_id'] = $_SESSION['candidate_session'];
				
				$this->data["formdata_job"]             = $this->candidateallmodel->get_job_single_record($this->data['job_profile_id']);
				$this->data["location_ids_pros"]        = $this->candidateallmodel->get_location_ids_job_profile($this->data['job_profile_id']);
			
				$this->data["formdata_job"]["country_id"] = $this->data["location_ids_pros"]["country_id"];
				$this->data["formdata_job"]["state_id"]   = $this->data["location_ids_pros"]["state_id"];
				$this->data["formdata_job"]["city_id"]    = $this->data["location_ids_pros"]["city_id"];	

				$this->data["country_list"] 	= $this->countrymodel->country_list();
				$this->data["state_list"] 	    = $this->candidateallmodel->state_list_by_country($this->data["formdata_job"]["country_id"]);
			
				$this->data["city_list"] 	    = $this->candidateallmodel->location_list_by_state($this->data["formdata_job"]["state_id"]);				

				$this->data["industries_list"] = $this->candidateallmodel->industries_list();
				
				if($this->data["formdata_job"]["job_cat_id"]>0)
					$this->data["functional_list"] =$this->candidateallmodel->get_functional_by_industry($this->data["formdata_job"]["job_cat_id"]);
				else
					$this->data["functional_list"] = $this->candidateallmodel->functional_list();

				if($this->data["formdata_job"]["func_id"]>0)
					$this->data["designation_list"] =$this->candidateallmodel->get_designation_by_function($this->data["formdata_job"]["func_id"]);
				else
					$this->data["designation_list"] = $this->candidateallmodel->desig_list();
							
				$this->data["currecy_list"]         = $this->candidateallmodel->currency_list();
				$this->data["years_list"]           = $this->candidateallmodel->years_list();
				$this->data["months_list"]          = $this->candidateallmodel->months_list();
				
				$this->data['edit_job_html']=$this->load->view('candidates_all/editjobdetail', $this->data,true);
		}
				
		$this->data["formdata"]               = $this->candidateallmodel->get_single_record($candidate_id);
		$this->data["location_ids"]			  = $this->candidateallmodel->get_country_state_city_ids($candidate_id);
		
		$this->data["formdata"]["country_id"] = $this->data["location_ids"]["country_id"];
		$this->data["formdata"]["state_id"]   = $this->data["location_ids"]["state_id"];
		$this->data["formdata"]["city_id"]    = $this->data["location_ids"]["city_id"];
		
		$this->data['visa_type_list']=$this->candidateallmodel->visa_type_list();
		
		$this->data["cur_job_status_list"] = $this->candidateallmodel->cur_job_status_list();
		
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		$this->data['candidate_languages'] = $this->candidateallmodel->candidate_languages($candidate_id);
		$this->data['education_details'] = $this->candidateallmodel->education_deatils($candidate_id);

		$this->data['job_history'] = $this->candidateallmodel->job_list($candidate_id);
		
		//print_r($this->data['job_history']);
		//exit();
	
		$this->data['followup_history'] = $this->candidateallmodel->get_followup_detail($candidate_id);
		
		$this->data['all_messages'] = $this->candidateallmodel->all_messages($candidate_id);
	
		$this->data['candidate_skill'] = $this->candidateallmodel->candidate_skills($candidate_id);
		
		//candidate doamin knowledge
		$this->data['candidate_domain'] = $this->candidateallmodel->candidate_domains($candidate_id);
		$this->data['admin_user_list']=$this->candidateallmodel->admin_user_list();
		//Certification 
		
		$this->data['cerifications']=$this->candidateallmodel->get_cert();
		$candidate_certifications = $this->candidateallmodel->candidate_certifications($candidate_id);
		
		$cerifications=array();
		foreach($candidate_certifications as $cert)
		{
			$cerifications[]=$cert['cert_id'];
		}
		$this->data['candidate_certifications_id']	=	$cerifications;
		$this->data['candidate_certifications']	=	$candidate_certifications;
		
		$this->data['candidate_questionnaire_summary'] = $this->candidateallmodel->get_survey_result($candidate_id);
		$this->data['candidate_files_summary'] = $this->candidateallmodel->get_files($candidate_id);
		$this->data['candidate_complaints_summary'] = $this->candidateallmodel->ticket_list($candidate_id);

		//Job Search details(candidate_job_serach)
		$this->data['job_search'] = $this->candidateallmodel->job_search($candidate_id);
		//$this->data['feedback_projects'] = $this->data['job_search']['feedback_projects'];
		//print_r($this->data['job_search']);exit;
		//Edit skill Modal

		$this->data['skill_list']=$this->candidateallmodel->get_parent_skills();
		
		$candidate_skills = $this->candidateallmodel->candidate_skills($candidate_id);
		
		$skills=array();
		foreach($candidate_skills as $skill)
		{
			$skills[]=$skill['skill_id'];
		}
		$this->data['candidate_skills']	=	$skills;

		
		//all child skills		
		$this->data['all_child_skills']	=	$this->candidateallmodel->child_skills();
		
		//Edit Language Modal
		//Language Deatils
		$this->data['lang_list']=$this->candidateallmodel->get_language_set();
		$candidate_languages =$this->candidateallmodel->candidate_languages($candidate_id);
		
		$languages=array();
		foreach($candidate_languages as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
		//print_r($languages);
		//exit();
		
		//Edit Education Modal
		
		$this->data["country_list"] 	        = $this->countrymodel->country_list();

		$this->data["state_list"] 	    = $this->candidateallmodel->state_list_by_country($this->data["formdata"]["country_id"]);
		$this->data["city_list"] 	    = $this->candidateallmodel->location_list_by_state($this->data["formdata"]["state_id"]);
				
		$this->data["nationality_list"] 	    = $this->countrymodel->country_list();
		$this->data["current_location_list"] 	= $this->countrymodel->country_list();
		$this->data["city_list"]                = $this->candidateallmodel->city_list();
		
		$this->data["edu_level_list"]   = $this->candidateallmodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->candidateallmodel->edu_years_list();
		//$this->data["edu_course_list"]  = $this->candidateallmodel->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidateallmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidateallmodel->edu_course_type_list();

		//employment
		$this->data["industries_list"] = $this->candidateallmodel->industries_list();
		$this->data["functional_list"] = $this->candidateallmodel->functional_list();
		$this->data["designation_list"] = $this->candidateallmodel->desig_list();	
				
		$this->data["currecy_list"] = $this->candidateallmodel->currency_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();
		
		//suggested jobs to candidate		
		$this->data['suggested_jobs']=$this->candidateallmodel->get_suggested_jobs($candidate_id);	
				
		//applied jobs of candidate		
		$this->data['applied_jobs']=$this->candidateallmodel->get_job_list($candidate_id);

		//shortlisted jobs
		$this->data['shortlisted']=$this->candidateallmodel->get_shortlisted($candidate_id);

		//interview scheduled jobs
		$this->data['interview_list']=$this->candidateallmodel->get_interview_list($candidate_id);

		//selected jobs
		$this->data['jobs_selected']=$this->candidateallmodel->jobs_selected($candidate_id);

		//offer letters issued
		$this->data['offer_letters_issued']=$this->candidateallmodel->offer_letters_issued($candidate_id);
		
		//offer accepted
		$this->data['offer_accepted']=$this->candidateallmodel->offer_accepted($candidate_id);

		//invoice genereted
		$this->data['invoice_generated']=$this->candidateallmodel->invoice_generated($candidate_id);


		//all child skills		
		$this->data['all_child_skills']	=	$this->candidateallmodel->child_skills();

		//present contract details
		$this->data['contract']=$this->candidateallmodel->get_contract_detail($candidate_id);
		//print_r($this->data['contract']);
		//exit();
		//contracts months
	
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


		/*--------------------------------------------------------------------------*/		
		//category /industry
		$category = $this->candidateallmodel->get_cat_list($candidate_id);		
		$cat_list=array();		
		foreach($category as $cat)
		{
			$cat_list[]=$cat['job_cat_id'];
		}
		$this->data['category_list']	=	$cat_list;
		$this->data['category_name']	=	$category;
		
		
		// funcional area
		$function = $this->candidateallmodel->get_function_list($candidate_id);
		
		$fun_list=array();
		foreach($function as $fun)
		{
			$fun_list[]=$fun['func_id'];
		}
		$this->data['function_list']	=	$fun_list;
		$this->data['function_name']	=	$function;


		// designation list
		$designation = $this->candidateallmodel->get_designation_list($candidate_id);		
		$desig_list=array();
		foreach($designation as $desig)
		{
			$desig_list[]=$desig['desig_id'];
		}
		$this->data['desig_list']	=	$desig_list;
		$this->data['desig_name']	=	$designation;				
		
		/*-----------------------------------------------------------------*/
		
		//primary_skills
		$candidate_skills_primary = $this->candidateallmodel->candidate_skills_primary($candidate_id);
		
		$skills_primary=array();
		foreach($candidate_skills_primary as $skill)
		{
			$skills_primary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_primary']	=	$skills_primary; 
		
		$this->data['skills_primary']	        =	$candidate_skills_primary;
	

			//secondary skills
		$candidate_skills_secondary = $this->candidateallmodel->candidate_skills_secondary($candidate_id);
		
		$skills_secondary=array();
		foreach($candidate_skills_secondary as $skill)
		{
			$skills_secondary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_secondary']	=	$skills_secondary;
		
		$this->data['skills_secondary']	            =	$candidate_skills_secondary;

		//Language Deatails pms_candidate_language
		//$this->data['lang_details'] = $this->candidateallmodel->get_lang_details($candidate_id);
		

		/*--------------------------------------------------------------------------*/
		
		if($this->input->post('candidate_id')!=''){
				foreach($this->input->post('candidate_id') as $key => $val)
				{
					$this->db->where('candidate_id',$val);
					$this->db->where('candidate_id',$this->input->post('candidate_id'));
					$this->db->delete('pms_admin_candidates');
					
						if($this->input->post('action')=='Add')
						{
							$data=array(
							'candidate_id'   =>$this->input->post('candidate_id'),
							'candidate_id'        =>$val,
							'assigned_date'   => date('Y-m-d'),
							);			
							$this->db->insert('pms_admin_candidates',$data);
						}
				}
			redirect('candidates_all/summary/');
		}
		
		
		//print_r($this->data["formdata"]);
		//exit();
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates_all/candidate_summary",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	public function get_functional_by_industry()
	{
		$this->load->model('candidateallmodel');
		if(isset($_GET['job_cat_id']) && $_GET['job_cat_id']!='')
		{
			$data=array();
			$data["func_list"] = $this->candidateallmodel->get_functional_by_industry($_GET['job_cat_id']);
			$data = array('success' => true, 'func_list' => $data["func_list"]);
		}else{
			$data=array();
			$data["func_list"] = $this->candidateallmodel->all_func_list();
			$data = array('success' => true, 'func_list' => $data["func_list"]);
		}
		echo json_encode($data);
	}

	public function get_designation_by_function()
	{
		$this->load->model('candidateallmodel');
		if(isset($_POST['func_id']) && $_POST['func_id']!='')
		{
			$data=array();
			$data["desig_list"] = $this->candidateallmodel->get_designation_by_function($_POST['func_id']);
			$data = array('success' => true, 'desig_list' => $data["desig_list"]);
		}else{
			$data=array();
			$data["desig_list"] = $this->candidateallmodel->all_designation_list();
			$data = array('success' => true, 'desig_list' => $data["desig_list"]);
		}
		echo json_encode($data);				
	}
	
	public function get_skills_by_designation()
	{
		$this->load->model('candidateallmodel');
		if(isset($_POST['desig_id']) && $_POST['desig_id']!='')
		{
			$data=array();
			$data["skill_list"] = $this->candidateallmodel->get_skills_by_designation($_POST['desig_id']);
			$data = array('success' => true, 'skill_list' => $data["skill_list"]);
		}else{
			$data=array();
			$data["skill_list"] = $this->candidateallmodel->all_skills_list();
			$data = array('success' => true, 'skill_list' => $data["skill_list"]);
		}
		echo json_encode($data);	
		
	}	

	function update_skills()
	{
		$this->data['candidate_id']=$_SESSION['candidate_session'];
		$this->load->model('candidateallmodel');
		
		if($this->input->post('candidate_id')!='')
		{
			$data = array(
					'candidate_id'       => $this->input->post('candidate_id'),
					'feedback_projects'  => $this->input->post('feedback_projects'),
			);

			$this->db->where('candidate_id', $this->data['candidate_id']);
			$query = $this->db->get('pms_candidate_job_search');
			
			if ($query->num_rows() > 0)
			{
				$this->db->where('candidate_id', $this->data['candidate_id']);
				$this->db->update('pms_candidate_job_search',$data);
			}else
			{
				$this->db->insert('pms_candidate_job_search', $data);
			}
			redirect('candidates_all/summary/');
		}
	}
	
	function remove_job_app()
	{
		$this->load->model('candidateallmodel');
		if($this->input->get('candidate_id')!='' && $this->input->get('job_id')!='')
		{
			$this->candidateallmodel->remove_job_app($this->input->get('candidate_id'),$this->input->get('job_id'));
			redirect('candidates_all/summary/'.'?upd=1');
		}else
		{
			echo 'No Details';
		}
	}
		
	// Manage Summary & Reports
	function invoice($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		$this->data['education_details'] = $this->candidateallmodel->education_deatils($candidate_id);
		$this->data['job_history'] = $this->candidateallmodel->job_list($candidate_id);
		$this->data['all_counselor'] = $this->candidateallmodel->all_counselor($candidate_id);
		$this->data['candidate_counselor'] = $this->candidateallmodel->candidate_counselor($candidate_id);

		if($this->input->post('candidate_id')!=''){
		
		foreach($this->input->post('candidate_id') as $key => $val)
		{
			$this->db->where('candidate_id',$val);
			$this->db->where('candidate_id',$this->input->post('candidate_id'));
			$this->db->delete('pms_admin_candidates');
			
			if($this->input->post('action')=='Add')
			{
				$data=array(
				'candidate_id'   =>$this->input->post('candidate_id'),
				'candidate_id'        =>$val,
				'assigned_date'=> date('Y-m-d'),
				);			
				$this->db->insert('pms_admin_candidates',$data);
			}
		}
			
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates_all/candidate_summary",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates_all/candidate_invoice",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	// Manage Job History
	function job_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='job_history';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');


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
		$this->data["industries_list"] = $this->candidateallmodel->industries_list();
		$this->data["industry_list"] = $this->candidateallmodel->industry_list();
		$this->data["functional_list"] = $this->candidateallmodel->functional_list();
		$this->data["currecy_list"] = $this->candidateallmodel->currency_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();

		
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidateallmodel->job_list($candidate_id);

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
			redirect('candidates_all/job_history/');
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_all/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	function job_history_2()
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='job_history';
	    $this->data['error']='';
		$this->data['candidate_id']=$_SESSION['candidate_session'];;
		$this->load->model('candidateallmodel');


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
		$this->data["industries_list"] = $this->candidateallmodel->industries_list();
		$this->data["industry_list"] = $this->candidateallmodel->industry_list();
		$this->data["functional_list"] = $this->candidateallmodel->functional_list();
		$this->data["currecy_list"] = $this->candidateallmodel->currency_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();

		
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($this->data['candidate_id']);
		
		$this->data['cv_fileist']=$this->candidateallmodel->job_list($this->data['candidate_id']);

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
			redirect('candidates_all/summary/');
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_all/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Education History
	function edu_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='education';
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');

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
		$this->data["edu_level_list"]   = $this->candidateallmodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->candidateallmodel->edu_years_list();
		//$this->data["edu_course_list"]  = $this->candidateallmodel->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidateallmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidateallmodel->edu_course_type_list();

		//data for left panel
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidateallmodel->education_list($candidate_id);
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
			redirect('candidates_all/edu_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new education details";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_all/candidate_edu_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	

	// Manage Lang History
	function lang_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='lang_skill';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidateallmodel->country_list();
		$this->data["formdata"] = $this->candidateallmodel->get_passport_single_record($candidate_id);
		
		
		
		//Edit Language Modal
		//Language Deatils
		$this->data['lang_list']=$this->candidateallmodel->get_language_set();
		$candidate_certifications =$this->candidateallmodel->candidate_languages($candidate_id);
		
		$languages=array();
		foreach($candidate_certifications as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
		//employment
		
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		
		if($this->input->post('candidate_id')!=''){

			   $this->candidateallmodel->edit_passport_detail($this->input->post('candidate_id'));
			   redirect('candidates_all/lang_history/');
		}
		else
		{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_all/candidate_lang_history",$this->data);
			$this->load->view("include/footer",$this->data);


		}	
	}
	
	function lang_history_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='lang_skill';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');

		if($this->input->post('candidate_id')!=''){

			   $this->candidateallmodel->edit_passport_detail($this->input->post('candidate_id'));
			   redirect('candidates_all/summary/');
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("include/candidate_sidebar",$this->data);
			$this->load->view("candidates_all/candidate_lang_history",$this->data);
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
		$this->load->model('candidateallmodel');
		$this->data['survey_result']=$this->candidateallmodel->get_survey_result($candidate_id);
		
		$this->data['cv_file']='';
		$this->data['photo_file']='';
		
		$cv_file=0;
		$photo_file=0;
		if($this->input->get('cv_file')==1)$this->data['cv_file']='CV Uploaded Successfully, please view it from summary page.';
		if($this->input->get('photo_file')==1)$this->data['photo_file']='Photo Uploaded Successfully, please view it from summary page.';
		
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->candidateallmodel->job_list($candidate_id);
		
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
							$this->candidateallmodel->insert_files($dataArr);
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
							$this->candidateallmodel->insert_files($dataArr);
							$photo_file=1;
						}
					}
				}
			   redirect('candidates_all/questionnaire/'.$this->input->post('candidate_id').'?cv_file='.$cv_file.'&photo_file='.$photo_file);
		}else{
			$path = '../js/ckfinder';
			$width = '100%';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates_all/candidate_questionnaire",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

// tech skills

	function skills($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='tech_skill';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		
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
			   redirect('candidates_all/skills/'.'?upd=1');
		}

		$this->data['skill_list']=$this->candidateallmodel->get_skill_set();
		$this->data['skill_list_current']=$this->candidateallmodel->get_skill_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->candidateallmodel->job_list($candidate_id);
				
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_all/candidate_skills",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function add_certification($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		
		if($this->input->post('candidate_id'))
		{
			
			$this->candidateallmodel->insert_cert_details($this->input->post('candidate_id'));
			redirect('candidates_all/summary/'.'?upd=1');
		}
		
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update certification here";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_all/candidate_summary",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function skills_2($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		
		if($this->input->post('candidate_id'))
		{
			
			$this->candidateallmodel->insert_skill_details($this->input->post('candidate_id'));
			redirect('candidates_all/summary/'.'?upd=1');
		}
		
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_all/candidate_skills",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	// certifications

	function certifications($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='certification';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		
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
			   redirect('candidates_all/certifications/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['certifications_list']=$this->candidateallmodel->get_certifications_set();
		$this->data['certifications_list_current']=$this->candidateallmodel->get_certifications_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->candidateallmodel->job_list($candidate_id);
		
		$path = '../js/ckfinder';
		$width = '100%';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_all/candidate_certifications",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	// Follow up
	function followup()
	{
		$this->load->model('candidateallmodel');
		if(isset($_POST['candidate_id']))
		{
			//date_default_timezone_set("Asia/Kolkata"); 
			
			$data=array(
			'candidate_id'   =>$_POST['candidate_id'],
			'title'          =>$_POST['followup_title'],
			//'status_id'      =>$_POST['status_id'],
			//'app_id'         =>$_POST['app_id'],
			'candidate_id'       => $_SESSION['candidate_session'],
			'description'    =>$_POST['followup_desc'],
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
					'task_title'          =>  $_POST['followup_title'].' - On- '.$_POST['flp_date_reminder'].' - '.$_POST['flp_time_reminder'],
					'start_date'          =>  date('Y-m-d'),
					'due_date'            =>  $_POST['flp_date_reminder'],
					'task_desc'           =>  $_POST['followup_desc'],
					'candidate_id'            =>  $_POST['assigned_to'],
					//'project_id'          =>  $_POST['app_id'],
					'candidate_id'        =>  $_POST['candidate_id'],
					'candidate_follow_id' => $id,
				);			
				$query_task=$this->db->insert('pms_tasks',$data);				
			}
			
			
			/*$this->data['single_list']=$this->candidateallmodel->select_record($id);
		
			$dataArr = $this->load->view('candidates_all/candidatefollowup_list', $this->data,TRUE);
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
				}*/
			redirect('candidates_all/summary/'.'?upd=1');
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
	$this->load->model('candidateallmodel');
	$this->data['note_list']=$this->candidateallmodel->select_notes_record($id);
	$dataArr = $this->load->view('candidates_all/candidatenotes_list', $this->data,TRUE);
	echo $dataArr;
	
	}

	// Drop Records from Follow up
	function drop(){
		 $candidate_follow_id=$_POST['candidate_follow_id'];
		
		$this->load->model('candidateallmodel');
		 $this->candidateallmodel->drop_record($candidate_follow_id);
		$dataArr = $this->load->view('candidates_all/candidate_view');
		echo $dataArr;
	}
	
	function cvfile_drop(){
		$cvfile_id=$_POST['cvfile_id'];
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->cvfile_drop_record($cvfile_id);		          
	}

	function drop_job_item()
	{
		$job_profile_id=$this->input->post('job_profile_id');
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->drop_job_item($job_profile_id);
	}
	
//DELETE EDUCATION DETAILS
	function deleteEducationDetail($candidateId)
	{
		$edu_id=$this->input->post('edu_id');
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->drop_edu_item($edu_id);
		$view	=	$this->educationDetails($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId,"VIEW"=>$view);
        echo json_encode($status);
	}
	function drop_email_sms_item()
	{
		$email_sms_id=$this->input->post('email_sms_id');
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->drop_email_sms_item($email_sms_id);
	}

	function drop_ticket_item()
	{
		$ticket_id=$this->input->post('ticket_id');
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->drop_ticket_item($ticket_id);
	}
		
	function drop_edu_item(){
		$eucation_id=$this->input->post('eucation_id');
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->drop_edu_item($eucation_id);
	}	
	
	function drop_notes(){
		 $candidate_note_id=$_POST['candidate_note_id'];
		
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->note_drop_record($candidate_note_id);
		$dataArr = $this->load->view('candidates_all/candidate_view');
		echo $dataArr;
		          
	}
	
	function drop_interviews(){
		 $interview_id=$_POST['interview_id'];
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->interview_drop_record($interview_id);
		$dataArr = $this->load->view('candidates_all/candidate_view');
		echo $dataArr;
		          
	}
	
    function drop_aplication(){
		 $app_id=$_POST['app_id'];
		$this->load->model('candidateallmodel');
		$this->candidateallmodel->aplication_drop_record($app_id);
		$dataArr = $this->load->view('candidates_all/candidate_view');
		echo $dataArr;
		          
	}
		
	function candidate_file($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='manage_file';
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
	   if($this->input->post('title')!='')
	   {
   	
			 if(isset($_FILES['photo']))
			 {
					if(!$candidate_id='')
					{
						$this->load->model('candidateallmodel');
						$id=$this->candidateallmodel->insert_file($candidate_id);
						redirect('candidates_all/candidate_file/'.$this->input->post('candidate_id'));
					}
			}
		}
		$this->data['file_list']=$this->candidateallmodel->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		$this->load->view("include/candidate_sidebar",$this->data);
		$this->load->view("candidates_all/manage_files",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function csv_data_import($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);

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
		$this->data['file_list']=$this->candidateallmodel->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		
		$this->load->view("candidates_all/csv_data_import",$this->data);
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
						$this->load->model('candidateallmodel');
						$id=$this->candidateallmodel->insert_file($candidate_id);
						$this->data['upload_list']=$this->candidateallmodel->get_one_record($id);
						$replay=$this->load->view("candidates_all/upload_file",$this->data,TRUE);
						echo $replay;
					}
					else
					{
						redirect("candidates_all/candidate_file");
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
						  $this->load->model('candidateallmodel');
						   $this->candidateallmodel->update_file($candidate_id);
	
							 $this->data['single_file']=$this->candidateallmodel->get_one_file($candidate_id);
	
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
		
			          $this->load->model('candidateallmodel');
					   $this->candidateallmodel->delete_file($id);
					    $this->data['delete_file']=$this->candidateallmodel->delete_one_file($id);
						
                           echo $this->data['delete_file']['photo'];  //$replay=$this->load->view("candidates_all/delete_file",$this->data,TRUE);
					         //echo $replay;
			
		}
	
	}

	function delete_cv()
	{
		$id=$_SESSION['candidate_session'];
		
		if(!empty($id))
		{
			$query = $this->db->query("select cv_file from pms_candidate where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists($this->config->item('cv_upload_folder').$row['cv_file']) && $row['cv_file']!='')
				{	
					unlink($this->config->item('cv_upload_folder').$row['cv_file']);
				}
				$this->db->query("update  pms_candidate set cv_file='' where candidate_id=".$id);
			}
			redirect("candidates_all/summary/");
		}else
		{
			redirect("candidates_all/summary/");
		}
	}

	function delete_photo()
	{
		$id=$_SESSION['candidate_session'];
		
		if(!empty($id))
		{
			$query = $this->db->query("select photo from pms_candidate where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists($this->config->item('photo_upload_folder').$row['photo']) && $row['photo']!='')
				{	
					unlink($this->config->item('photo_upload_folder').$row['photo']);
				}
				$this->db->query("update  pms_candidate set photo='' where candidate_id=".$id);
			}
			redirect("candidates_all/summary/");
		}else
		{
			redirect("candidates_all/summary/");
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
		$this->load->model('candidateallmodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->candidateallmodel->location_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
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

// onchange get course
	public function getcourses()
	{		
		$this->load->model('coursemodel');
		
		if(isset($_POST['level_study']) && $_POST['level_study']!='')
		{
			$data=array();
			$data["course_list"] = $this->coursemodel->get_course_list($_POST['level_study']);			
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
		$this->load->model('candidateallmodel');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$data["function_list"] = $this->candidateallmodel->function_list_by_category($_POST['category_id']);
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

//onchange getlocation

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
				//@mail($email_array['email_to'], $email_array['subject'], $mail_body, implode("\r\n", $headers));
				if(@mail($email_array['email_to'], $email_array['subject'], $mail_body, implode("\r\n", $headers)))
				{
				
					return 1;
				}
				else
				{
					return 0;}
	}
// email ends here	
	
	function change_status()
	{
		$this->load->model('candidateallmodel');
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
	

//APPLY JOB
	function apply_job($candidateId,$jobId)
	{
		if($candidateId !='' && $jobId !='')
		{
		$this->load->model('candidateallmodel');
        $this->candidateallmodel->apply_job($candidateId,$jobId);
		}
		redirect("candidates_all/summary/".$candidateId);
	}
	
	function editSkillCertificateDetail($candidateId)
	{ 
		$this->load->model('candidateallmodel');
	 	$id  = $this->candidateallmodel->insert_skill_details($candidateId);
		
		$id  = $this->candidateallmodel->insert_cert_details($candidateId);
		
		$id  = $this->candidateallmodel->insert_domain_details($candidateId);
		
		
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
//Send reset pwd link

	function resetpassword()
	{
			
		$qry	=$this->db->query('select * from pms_candidate where candidate_id='.$_POST['candidate_id']);
		$res	=	$qry->row_array();
		if(count($res)>0)
		{
			$qry1	=$this->db->query('select * from pms_password_change where candidate_id='.$_POST['candidate_id']);
			if($qry1->num_rows() > 0)
			{
				$unique_id = md5(uniqid($res["candidate_id"], true));
				$id = $_POST['candidate_id'];				
				$array=array(
					'unique_id'          => $unique_id,
					'candidate_id'       => $id,
					'status'             => 1
					);
				$this->db->where('candidate_id', $res["candidate_id"]);
				$this->db->update('pms_password_change', $array);	
			}
			else
			{
				$unique_id = md5(uniqid($res["candidate_id"], true));
				$id = $_POST['candidate_id'];				
				$array=array(
					'unique_id'          => $unique_id,
					'candidate_id'       => $id,
					'status'             => 1
					);
				
				$this->db->insert('pms_password_change', $array);	
			}
		
		
		$data =array(
		'Reset Password Link:'=>'http://recruitmenthub.net/candidate/index.php/resetpassword/?candidate_id='.$_POST['candidate_id'],
		
		);


// email to candidate
		$email_array=array(
			'email_to'               =>  $res['username'],
			'email_to_name'          =>  $res['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'Reset Password Link',
			'salutation'              =>  'Dear '.$res['first_name'].$res['last_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  '',
			'table_rows'             =>  $data,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$status = $this->send_email($email_array);
		$response = array(
			    'data' => $status,
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	}
	
	//onchange get function by multiple	
	public function getfunction_multiple()
	{		
		$html='';
		$this->load->model('candidateallmodel');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$function_list = $this->candidateallmodel->function_list_by_category_multiple($_POST['category_id']);
			 
			$data = array('success' => true, 'function_list' => $function_list);
		}
		else
		{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

//EDIT Category and functional area

	function editCategory($candidateId)
	{
		$this->load->model('candidateallmodel');
	 	$id  = $this->candidateallmodel->insert_functional($candidateId);
		redirect('candidates_all/summary/'.$this->input->post('candidate_id').'?upd=1');
	}	
	
	
//EDIT PRIMARY AND SECONDARY SKILLS
	function editSkills($candidateId)
	{
		$this->load->model('candidateallmodel');
	 	$id  = $this->candidateallmodel->insert_skills($candidateId);
		redirect('candidates_all/summary/'.'?upd=1');
		
	}

//Add Contract Details


	//print candidate Cv

	function print_cv($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		
		$this->data['candidate_id'] = $id;
		
		$this->data['page_head']= 'Profile';

		$this->load->model('candidateallmodel');  
	

		$this->data["personal"] = $this->candidateallmodel->get_single_record($id);
		$this->data['address'] = $this->candidateallmodel->get_address($id);
		$this->data['education'] = $this->candidateallmodel->education_list($id);
		$this->data['job_details'] = $this->candidateallmodel->get_job_details($id);
		$this->data['language_skills'] = $this->candidateallmodel->candidate_languages($id);
		$this->data['tech_skills'] = $this->candidateallmodel->candidate_skills($id);
		$this->data['certification'] = $this->candidateallmodel->candidate_certifications($id);
		$this->data['domain'] = $this->candidateallmodel->candidate_domains($id);
		$this->data['sports'] = $this->candidateallmodel->candidate_sports($id);
		$this->data['social'] = $this->candidateallmodel->candidate_social($id);
		$this->data['contract'] = $this->candidateallmodel->get_contract_detail($id);
		$this->data['formdata'] = $this->candidateallmodel->get_lang_details($id);

		$this->data["profile_list"] = $this->candidateallmodel->profile_list($id);
					

		//$this->load->view('include/header',$this->data);
		$this->load->view('candidates_all/print_cv',$this->data);	
		//$this->load->view('include/footer',$this->data);
	}

	function download_cv($id=null)
	{
		$this->load->model('candidateallmodel');  
		$this->data["personal"] = $this->candidateallmodel->get_single_record($id);
		if($this->data["personal"]['cv_file']!='' && file_exists('uploads/cvs/'.$this->data["personal"]['cv_file']))
		{
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'.basename($this->data["personal"]['cv_file']).'"');
			header('Expires: 0');
			header('Cache-Control: must-revalidate');
			header('Pragma: public');
			header('Content-Length: ' . filesize('uploads/cvs/'.$this->data["personal"]['cv_file']));
			readfile('uploads/cvs/'.$this->data["personal"]['cv_file']);
			exit;
		}
		exit();
	}
		
//GET CANDIDATE EDUCATION
	function get_candidate_education()
	{
		$candidate_id =$this->input->post('candidate_id');
		$this->load->model('candidateallmodel');
		
		
		$education_details = $this->candidateallmodel->education_deatils($candidate_id);

		
		$html1='';
		$html2='';
		if(!empty($education_details))
		{
			
			$html1 ='<td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Education</h3></div></td>';
									
			
			$html2='<td colspan="2" align="center" valign="top" class="borderTopNone"> 
    
            			<table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
						  
						  <thead>
						  <tr>
							<th>Level of study</th>
							<th>Course</th>
							<th>Arrears</th>
							<th>Absense</th>
							<th>Repeat</th>
							<th>Year Back</th>
							<th>Percenage</th>
							<th>Action</th>
						  </tr></thead><tbody>';
						
					 foreach($education_details as $key => $val)
					 {
						 
						
						$html2.='<tr>
									<td>'.$val['level_name'].'</td>
									<td>'. $val['course_name'].'</td>
									<td>'. $val['arrears'].'</td>
									<td>'.$val['absesnse'].'</td>
									<td>'. $val['repeat'].'</td>
									<td>'. $val['year_back'].'</td>
									<td>'.  $val['mark_percentage'].'</td>
									<td><a href="javascript:;"  data-url="'.base_url().'index.php/candidates_all/delete_candidate_edu/?id='.$val['eucation_id'].'" id="delete_candidate_edu" class="btn btn-danger btn-xs">Delete</td>
         		 				</tr>';
								
						}
						
						$html2.=' </tbody> </table> </td>';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
//delete candidate education	
	function delete_candidate_edu()
	{
		
		$eucation_id     = $this->input->get('eucation_id');	
		$candidate_id     = $this->input->get('candidate_id');	
		
		$this->load->model('candidateallmodel');		
		
		if($eucation_id!='' && $candidate_id!='')
		{
			$result = $this->db->query('DELETE FROM pms_candidate_education WHERE eucation_id ="'.$eucation_id.'" ' );					
			redirect('candidates_all/summary/'.$candidate_id.'?upd=1');
		}
	}
	
	//GET CANDIDATE PROFESSIOANL DETAILS
	function get_candidate_professional()
	{
		$candidate_id =$this->input->post('candidate_id');
		$this->load->model('candidateallmodel');
		
		
		$job_history = $this->candidateallmodel->job_list($candidate_id);

		
		$html1='';
		$html2='';
		if(!empty($job_history))
		{
			
			$html1 ='<td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Professional Summary</h3></div></td>';
									
			
			$html2=' <td colspan="2" align="center" valign="top" class="borderTopNone">
					<table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
						<thead>
						  <tr>
							<td>Organization</td>
							<td>Designation</td>
							<td>Resp.</td>
							<td>From</td>
							<td>To</td>
							<td>Salary</td>
							<td>Job Industry</td>
							<td>Job Category</td>
							<td>Fun. Area</td>
							<td>Action</td>
						  </tr></thead><tbody>';
						
					 foreach($job_history as $key => $val)
					 {	
					 	if($val['present_job']==1)
						{
							$date= date('Y-m-d'); 
						}
						else
						{ 
							$date=$val['to_date'];
						}
						 
						
						$html2.=' <tr>
									<td>'.$val['organization'].'</td>
									<td>'.$val['designation'].'</td>
									<td>'.$val['responsibility'].'</td>
									<td>'. $val['from_date'].'</td>
									<td>'.$date.'</td>
									<td>'.$val['monthly_salary'].'</td>
									<td>'.$val['job_cat_name'].'</td>
									<td>'.$val['job_cat_name'].'</td>
									<td>'. $val['func_area'].'</td>
                  
									<td><a href="javascript:;"  data-url="'.base_url().'index.php/candidates_all/delete_candidate_prof/?id='.$val['job_profile_id'].'" id="delete_candidate_prof" class="btn btn-danger btn-xs">Delete</td>
         		 				</tr>';
								
						}
						
						$html2.=' </tbody> </table> </td>';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
//delete candidate Professional details	
	function delete_candidate_prof()
	{
		
		$id     = $this->input->get('id');	
		
		$this->load->model('candidateallmodel');		
		
		if($this->input->get('id')!='')
		{

			$result = $this->db->query('DELETE FROM pms_candidate_job_profile WHERE job_profile_id ="'.$id.'" ' );		
					
			$response = array(
			
				'status'=>'success',
			
			);
		}
		redirect('candidates_all/summary/');
		header('Content-type: application/json');    					
		echo json_encode($response);
			
		
	}
	
	//GET CANDIDATE PRESENT CONTRACT
	function get_present_contract()
	{
		$candidate_id =$this->input->post('candidate_id');
		$this->load->model('candidateallmodel');
		
		
		$contract = $this->candidateallmodel->get_contract_detail($candidate_id);

		
		$html1='';
		$html2='';
		if(!empty($contract))
		{
			
			if($contract['present_status'] == 1)
			{
				$status = 'No Job';
			}
			else if($contract['present_status'] == 2)
			{
				$status = 'Not interested in Job Change';
			}
			else if($contract['present_status'] == 3)
			{
				$status = 'Need a change';
			}
			else if($contract['present_status'] == 4)
			{
				$status = 'Call me after 1 year';
			}
			else if($contract['present_status'] == 5)
			{
				$status = 'Call me after thsi month';
			}
			else 
			{
				$status = '';
			}
			
			$html1 ='<td colspan="2" align="center" valign="top"><br />Present Contract Details</td>';
									
			
			$html2='  <td colspan="2" align="center" valign="top">
						<table width="95%" border="1" cellspacing="3" cellpadding="3">
						
							<tr>
							<td bgcolor="#CCCCCC">Start Date</td>
							<td bgcolor="#CCCCCC">End Date</td>
							<td bgcolor="#CCCCCC">Total Months</td>
							<td bgcolor="#CCCCCC">Total Experience</td>
							<td bgcolor="#CCCCCC">Present Status</td>
							<td bgcolor="#CCCCCC">Action</td>
							</tr>';
					
						
			$html2.=' <tr>
							<td>'.$contract['start_date'].'</td>
							<td>'.$contract['end_date'].'</td>
							<td>'.$contract['total_months'].'</td>
							<td>'. $contract['total_exp'].'</td>   
							<td>'. $status.'</td>   
							<td><a href="javascript:;"  data-url="'.base_url().'index.php/candidates_all/delete_candidate_contract/?id='.$contract['candidate_id'].'" id="delete_candidate_contract" >Delete</td>
						</tr>';
								
					
						
		    $html2.= ' </tbody> </table> </td>';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
//DELETE PRESENT CONTRACT	
	function delete_candidate_contract()
	{
		$id     = $this->input->get('id');	
		$this->load->model('candidateallmodel');		
		if($this->input->get('id')!='')
		{
			$result = $this->db->query('DELETE FROM pms_candidate_contract WHERE contract_id ="'.$id.'" ' );				
			redirect('candidates_all/summary/');	
			exit();
		}
		redirect('candidates_all/summary/');	
	}
	
//DELETE CANDIDATE FOLLOWUP	
	function delete_candidate_followup()
	{
		$id     = $this->input->get('id');	
		$this->load->model('candidateallmodel');		
		if($this->input->get('id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query('DELETE FROM pms_candidate_followup WHERE candidate_follow_id ="'.$id.'" ' );	
			redirect('candidates_all/summary/'.'?upd=1');	
		}
		//header('Content-type: application/json');    					
		//echo json_encode($response);
	}
	
	function manage_email($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']='email_sms';
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidateallmodel');
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		$this->data['email_sms_list']=$this->candidateallmodel->email_sms_list($candidate_id);

		if($candidate_id!='')
		{
			$data=array(
			'message_date'      => date('Y-m-d'),
			'message_time'      => time(),
			'message_title'     => '',
			'message_text'      => $this->input->post('email_text'),			
			'message_status'    => 0,	
			'candidate_id'      => $_SESSION['candidate_session'],		
			);
			$this->db->insert('pms_candidate_messages',$data);
			$id=$this->db->insert_id();
		}
		redirect('candidates_all/summary/?status=sent');
	}
	
}