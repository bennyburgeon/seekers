<?php 
class Contact extends CI_Controller {

	function Contact()
	{
		parent::__construct();
		
	  	if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		if(!isset($_SESSION['reg_status']) || $_SESSION['reg_status']=='')$_SESSION['reg_status']=1;
		$this->load->library('csvimport');
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
		
		$this->data['reg_status']=-1;		
		$this->data['lead_opportunity']=-1;
		$this->data['lead_assigned']=-1;
		$this->data['lead_owner']=-1;
		$this->data['lead_source']='';

		$this->data['date_range']=-1;
		
		$this->data['date_from']=''; // canculate it from function - from date
		$this->data['date_to']='';   // calculate it from function - to date

		$this->data['rows']='';
		$this->load->model('contactmodel');
		

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
					
		if($this->input->get("lreg_status")!='')
		{
			$this->data['reg_status']=$this->input->get("lreg_status");
			$_SESSION['reg_status']=$this->input->get("lreg_status");
		}
		
		if($this->input->post("lreg_status")!='')
		{
			$this->data['reg_status']=$this->input->post("lreg_status");
			$_SESSION['reg_status']=$this->input->post("lreg_status");
		}	

		if($this->input->post("lead_opportunity")!='')
		{
			$this->data['lead_opportunity']=$this->input->post("lead_opportunity");
		}

		if($this->input->get("lead_opportunity")!='')
		{
			$this->data['lead_opportunity']=$this->input->get("lead_opportunity");
		}					

		if($this->input->post("lead_source")!='')
		{
			$this->data['lead_source']=$this->input->post("lead_source");
		}

		if($this->input->get("lead_source")!='')
		{
			$this->data['lead_source']=$this->input->get("lead_source");
		}
		
		if($this->input->post("lead_owner")!='')
		{
			$this->data['lead_owner']=$this->input->post("lead_owner");
		}

		if($this->input->get("lead_owner")!='')
		{
			$this->data['lead_owner']=$this->input->get("lead_owner");
		}

		if($this->input->post("lead_assigned")!='')
		{
			$this->data['lead_assigned']=$this->input->post("lead_assigned");
		}

		if($this->input->get("lead_assigned")!='')
		{
			$this->data['lead_assigned']=$this->input->get("lead_assigned");
		}

		if($this->input->post("date_range")!='' && $this->input->post("date_range")!='-1')
		{
				$date_array=$this->get_date_range($this->input->post("date_range"));
				if(is_array($date_array) && isset($date_array['date_from']) && isset($date_array['date_to']))
				{
					$this->data['date_from']=$date_array['date_from'];
					$this->data['date_to']=$date_array['date_to'];
				}
			$this->data['date_range']=$this->input->post("date_range");
		}

		if($this->input->get("date_range")!=''  && $this->input->get("date_range")!='-1')
		{
				$date_array=$this->get_date_range($this->input->get("date_range"));
				if(is_array($date_array) && isset($date_array['date_from']) && isset($date_array['date_to']))
				{
					$this->data['date_from']=$date_array['date_from'];
					$this->data['date_to']=$date_array['date_to'];
				}
			$this->data['date_range']=$this->input->get("date_range");
		}
									
		$this->data['total_rows']= $this->contactmodel->record_count($this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['reg_status'],$this->data['branch_id'],$this->data['lead_opportunity'],$this->data['lead_assigned'],$this->data['lead_owner'],$this->data['lead_source'],$this->data['date_range'],$this->data['date_from'],$this->data['date_to']);

		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."index.php/contact/?sort_by=".$this->data['sort_by']."&limit=".$this->data['limit']."&search_name=".$this->data['search_name']."&search_email=".$this->data['search_email']."&search_mobile=".$this->data['search_mobile']."&"."lreg_status=".$this->data['reg_status']."&branch_id=".$this->data['branch_id'].'&lead_source='.$this->data['lead_source'];
		
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
	
		$this->data["records"] = $this->contactmodel->get_list($this->data['start'],$this->data['limit'],$this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['sort_by'],$this->data['reg_status'],$this->data['branch_id'],$this->data['lead_opportunity'],$this->data['lead_assigned'],$this->data['lead_owner'],$this->data['lead_source'],$this->data['date_range'],$this->data['date_from'],$this->data['date_to']);

		$this->load->model('contactmodel'); 
		
		$this->data['page_head']= 'Manage Contacts';		
		$this->data['formdata']=array('admin_id' =>'');
		$this->data['admin_users_lists']= $this->contactmodel->get_admin_users_lists();
		$this->data["branch_list"] = $this->contactmodel->branch_list();
		$this->data["lead_source_list"] = $this->contactmodel->lead_source_list();
	
	  
		$this->load->view('include/header',$this->data);
		$this->load->view('contact/contactslist',$this->data);				
		$this->load->view('include/footer',$this->data);
	}
	function get_date_range($option)
	{
		$date_from='';
		$date_to='';
		
		switch ($option)
		{
		case '1':
				$date_from = date('Y-m-d',mktime() - 24*3600);     
				$date_to = date('Y-m-d', mktime()); 
				break;
		case '2':
				$date_from = date('Y-m-d',mktime(0, 0, 0, date('m'), date('d')-1, date('Y')));     
				$date_to = date('Y-m-d',mktime(23, 59, 59, date('m'), date('d')-1, date('Y'))); 			
				break;
		case '3':
				$date_from = date('Y-m-d', mktime(0, 0, 0, date('n'), date('j'), date('Y')) - ((date('N')-1)*3600*24));     
				$date_to = date('Y-m-d', mktime()); 			
			break;
		case '4':
				$date_from = date('Y-m-d', mktime(0, 0, 0, date('n'), date('j')-6, date('Y')) - ((date('N'))*3600*24));     
				$date_to = date('Y-m-d', mktime(23, 59, 59, date('n'), date('j'), date('Y')) - ((date('N'))*3600*24));  			
			break;
		case '5':
				$date_from = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));     
				$date_to = date('Y-m-d',mktime()); 			
			break;
		case '6':
				$date_from = date('Y-m-d', mktime () - 30 * 3600 * 24);     
				$date_to = date('Y-m-d', mktime());  			
			break;
		case '7':
				$date_from = date('Y-m-d', mktime() - 30*3600*24);
				$date_to = date('Y-m-d', mktime()); 			
			break;
		case '8':
				$date_from = date('Y-m-d', mktime(0, 0, 0, 1, 1, date('Y')));     
				$date_to = date('Y-m-d',mktime()); 			
			break;															
		case '9':
				$date_from = date('Y-m-d', mktime(0, 0, 0, 1, 1, date('Y')-1));     
				$date_to = date('Y-m-d', mktime(23, 59, 59, 12, 31, date('Y')-1)); 			
			break;
								
			default:
				break;
		}
		return array('date_from' => $date_from, 'date_to' => $date_to);
	}
	function add()
	{	
		$this->load->model('contactmodel');
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
		
		$this->data["edu_course_list"] = $this->contactmodel->edu_course_list();
		$this->data["level_list"] = $this->coursemodel->fill_levels();
		$this->data["branch_list"] = $this->contactmodel->branch_list();
		$this->data['admin_users_lists']= $this->contactmodel->get_admin_users_lists();
		
		$this->data['page_head']= 'Add Candidate';
		$this->load->view('include/header',$this->data);
		$this->load->view('contact/addcandidates',$this->data);	
		$this->load->view('include/footer',$this->data);
	}
	
	function addCandidate(){
		$this->load->model('contactmodel');
		if ($this->input->post('username')!='')
		{ 
			$id = $this->contactmodel->insert_candidate_record();
			if ($id != '') { 
				$status = array("STATUS" => "1", "SUCCESS_ID" => $id);
				echo json_encode($status);
			} 
			else { 
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
		$this->load->model('contactmodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["state_list"] 		= array(''=>'Select State'); //$this->statemodel->state_list();
		$this->data["city_list"] 		= array(''=>'Select City'); //$this->citymodel->city_list();	
        $this->data["location_list"] 	= array(''=>'Select Location');//$this->locationmodel->location_list();
		$this->data["religion_list"]    = $this->contactmodel->religion_list();

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
        $this->load->view('contact/addcontactdetail', $this->data);
    }
	
	function skip_step2($candidateId){
		$this->load->model('contactmodel');
		//$this->contactmodel->insert_contact_detail_skip($candidateId);		
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}

	function step_back($candidateId){
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
		
	function addCandidateDetail($candidateId){
		$this->load->model('contactmodel');
		$id  = $this->contactmodel->insert_contact_detail($candidateId);
		$uid = $this->contactmodel->update_contact_detail($candidateId);
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
		$this->load->model('contactmodel');
		$this->load->model('visatypemodel');
		$this->data["formdata"]=$this->contactmodel->get_passport_details($id);
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->contactmodel->country_list();
		$this->load->view('contact/addpassportdetail', $this->data);
	}
	
	function skip_step3($candidateId){
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function addPassportDetail($candidateId){
		$this->load->model('contactmodel');
		$uid = $this->contactmodel->update_passport_detail($candidateId);
		$status = array("STATUS" => "1");
		echo json_encode($status);
	}
	
	function loadEducationhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('contactmodel');
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
		$this->data["edu_level_list"] = $this->contactmodel->edu_level_list();
		$this->data["edu_years_list"] = $this->contactmodel->edu_years_list();
		$this->data["edu_course_list"] = $this->contactmodel->edu_course_list();
		$this->data["edu_spec_list"] = $this->contactmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->contactmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->contactmodel->edu_course_type_list();
		$this->load->view('contact/addeducationdetail',$this->data);
	}
	
	function skip_step4($candidateId){
		$this->load->model('contactmodel');
		//$this->contactmodel->insert_education_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function addEducationDetail($candidateId){
		$this->load->model('contactmodel');
		$id  = $this->contactmodel->insert_education_detail($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	function loadJobhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('contactmodel');
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
		$this->data["industry_list"] = $this->contactmodel->industry_list();
		$this->data["functional_list"] = $this->contactmodel->functional_list();
		$this->data["currecy_list"] = $this->contactmodel->currency_list();
		$this->data["years_list"] = $this->contactmodel->years_list();
		$this->data["months_list"] = $this->contactmodel->months_list();
		$this->load->view('contact/addjobdetail', $this->data);
	}
	
	function skip_step5($candidateId){
		$this->load->model('contactmodel');
		//$this->contactmodel->insert_job_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	function skip_step1($candidateId){
		$this->load->model('contactmodel');
		//$this->contactmodel->insert_job_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}	
	function addJobDetail($candidateId){
		$this->load->model('contactmodel');
		$id  = $this->contactmodel->insert_job_detail($candidateId);
		$uid = $this->contactmodel->update_job_detail($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	

	}
	
	function loadFilehtml($id){
	
		if($id=='')exit();	
	
		$this->data['candidate_id'] = $id;
		$this->load->model('contactmodel');
		$this->load->view('contact/addfiledetail', $this->data);
	}

	// upload files from summary page.
	function upload_cv_photo($candidate_id)
	{
		$this->table_name='pms_contact';
		$this->load->model('contactmodel');
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
						$this->db->query("update pms_contact set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$dataArr = array(
							'file_name' => $this->upload_file_name,
							'file_type'=> $this->upload_file_name,
							'candidate_id' => $candidate_id
						);
						$this->contactmodel->insert_files($dataArr);
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
						$this->db->query("update pms_contact set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$dataArr = array(
							'file_name' => $this->upload_file_name,
							'file_type'=> $this->upload_file_name,
							'candidate_id' => $candidate_id
						);
						$this->contactmodel->insert_files($dataArr);
					}
				}
			}	
			redirect('contact/summary/'.$this->input->post('candidate_id'));
		}else
		{
			redirect('contact');
		}		
	}
	
	// add files
	function addfiles(){
		$this->table_name='pms_contact';
		$this->load->model('contactmodel');
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
			$this->db->query("delete from pms_contact_survey_result where candidate_id=".$candidate_id);
			foreach($survey_array as $item => $val)
			{
				$this->db->insert('pms_contact_survey_result', $val);
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
					$this->db->query("update pms_contact set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					$dataArr = array(
						'file_name' => $this->upload_file_name,
						'file_type'=> $this->upload_file_name,
						'candidate_id' => $candidate_id
					);
					$this->contactmodel->insert_files($dataArr);
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
					$this->db->query("update pms_contact set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					$dataArr = array(
						'file_name' => $this->upload_file_name,
						'file_type'=> $this->upload_file_name,
						'candidate_id' => $candidate_id
					);
					$this->contactmodel->insert_files($dataArr);
				}
			}
		}		
	}
	
	// Edit Cnadidate
	function edit($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$candidateId = $id;
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
			'branch_id' => '',
			'level_study' => '',
		);
		$this->data['page_head']= 'Edit Profile';
		$this->load->model('contactmodel');  
		$this->load->model('coursemodel');  
		$this->data["formdata"] = $this->contactmodel->get_single_record($id);
	
		$this->data['level_list']=$this->coursemodel->fill_levels();
		
		if(isset($this->data["formdata"]['level_study']) && $this->data["formdata"]['level_study']!='')
			$this->data["edu_course_list"] = $this->contactmodel->edit_course_list($this->data["formdata"]['level_study']);
		else
			$this->data["edu_course_list"] = array('' => 'Select Course');
			
		$this->data["branch_list"] = $this->contactmodel->branch_list();
		$this->load->view('include/header',$this->data);
		$this->load->view('contact/editcandidates',$this->data);	
		$this->load->view('include/footer',$this->data);
	}
	
	function editCandidate(){
		$candidateId = $this->input->post('candidateId');
		$this->load->model('contactmodel');
        $this->contactmodel->update_candidate_record($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditContacthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('contactmodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["religion_list"]    = $this->contactmodel->religion_list();
		
		
		$query=$this->db->query("select * from pms_contact where candidate_id=".$id);			
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
		
		$this->data["formdata3"] = $this->contactmodel->get_address_single_record($id);
		if(count($this->data["formdata3"])<1)
		{
			$this->data["formdata3"]['address']='';
			$this->data["formdata3"]['land_phone']='';
			$this->data["formdata3"]['workphone']='';
			$this->data["formdata3"]['fax']='';
			$this->data["formdata3"]['zipcode']='';
		}
		$this->data['formdata'] = array_merge($this->data['formdata'],$this->data['formdata2'],$this->data["formdata3"]);
        $this->load->view('contact/editcontactdetail', $this->data);

	}
	
	function editCandidateDetail($candidateId){
		$this->load->model('contactmodel');
        $this->contactmodel->edit_contact_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	function loadEditPassporthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('contactmodel');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->contactmodel->country_list();
		$this->data["formdata"] = $this->contactmodel->get_passport_single_record($id);
		$this->load->view('contact/editpassportdetail', $this->data);
	}
	
	function editPassportDetail($candidateId)
	{
		$this->load->model('contactmodel');
        $this->contactmodel->edit_passport_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditEducationhtml($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('contactmodel');
		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->contactmodel->edu_level_list();
		$this->data["edu_years_list"] = $this->contactmodel->edu_years_list();
		$this->data["edu_course_list"] = $this->contactmodel->edu_course_list();

		$this->data["edu_spec_list"] = $this->contactmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->contactmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->contactmodel->edu_course_type_list();
		$this->data["formdata"] = $this->contactmodel->get_education_single_record($id);
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
		$this->load->view('contact/editeducationdetail',$this->data);
	}
	
	function editEducationDetail($candidateId)
	{
		$this->load->model('contactmodel');
        $this->contactmodel->edit_education_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditJobhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('contactmodel');
		$this->data["industry_list"] = $this->contactmodel->industry_list();
		$this->data["functional_list"] = $this->contactmodel->functional_list();
		$this->data["currecy_list"] = $this->contactmodel->currency_list();
		$this->data["years_list"] = $this->contactmodel->years_list();
		$this->data["months_list"] = $this->contactmodel->months_list();
		$this->data["formdata"] = $this->contactmodel->get_job_single_record($id);
		
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
		
		$this->load->view('contact/editjobdetail', $this->data);
	}
	
	function editJobDetail($candidateId){
		$this->load->model('contactmodel');
        $this->contactmodel->edit_job_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}

		
	function loadEditFilehtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('contactmodel');
		$this->data['survey_result']=$this->contactmodel->get_survey_result($id);
		$this->data["formdata"] = $this->contactmodel->get_file_single_record($id);	

		$this->load->view('contact/editfiledetail', $this->data);
	}

	// edit files
	function editfiles(){
		$this->table_name='pms_contact';
		$this->load->model('contactmodel');
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
			$this->db->query("delete from pms_contact_survey_result where candidate_id=".$candidate_id);
			foreach($survey_array as $item => $val)
			{
				$this->db->insert('pms_contact_survey_result', $val);
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
					$query = $this->db->query("select photo from pms_contact where candidate_id=".$this->input->post('candidate_id'));
									if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
										unlink('uploads/photos/'.$row['photo']);
									}
				
					$this->db->query("update pms_contact set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					
	
	$this->db->query("update pms_contact_files set file_name='".$this->upload_file_name."',file_type='".$this->upload_file_name."' where file_name='".$row['photo']."' and candidate_id=".$candidate_id);
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
							
						$query = $this->db->query("select cv_file from pms_contact where candidate_id=".$this->input->post('candidate_id'));
						if ($query->num_rows() > 0)
						{
							$row = $query->row_array();
							if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
							unlink('uploads/cvs/'.$row['cv_file']);
						}
						$this->db->query("update pms_contact set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
						$this->db->query("update pms_contact_files set file_name='".$this->upload_file_name."',file_type='".$this->upload_file_name."' where file_name='".$row['cv_file']."' ");
		
						}
			}	
		}		
	//Candidate View
	function candidate_view($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);

		if($this->input->post('candidate_id')!='')
			{
				$data=array(
				'reg_status'      => $this->input->post('reg_status'),
				'fee_comments'        => $this->input->post('fee_comments'),
				'fee_date'        => $this->input->post('fee_date'),
				'fee_amount'        => $this->input->post('fee_amount')
				);
				
 			   $this->db->where('candidate_id', $this->input->post('candidate_id'));
			   $this->db->update('pms_contact', $data);
			   redirect('contact/candidate_view/'.$this->input->post('candidate_id'));
		}
						
		$this->data['list']=$this->contactmodel->follow_record($candidate_id);
		$this->data['note_list']=$this->contactmodel->notes_record($candidate_id);		
		$this->data['coe_list']=$this->contactmodel->coe_list($candidate_id);
		$this->data['visa_approval_list']=$this->contactmodel->visa_approval_list($candidate_id);

		$this->data['interview_list']=$this->contactmodel->interview_record($candidate_id);
		$this->data['aplication_list']=$this->contactmodel->aplication_record($candidate_id);
		
		$this->data['interview_status_list']=$this->contactmodel->interview_status_list();		
		$this->data['app_list']=$this->contactmodel->aplication_list($candidate_id);
		$this->data['app_list_coe']=$this->contactmodel->select_aplication_coe($candidate_id);
		$this->data['admin_user_list']=$this->contactmodel->admin_user_list();
		$this->data['interview_type_list']=$this->contactmodel->interview_type_list();
		$this->data['university_list']=$this->contactmodel->university_list();
		$this->data['campus_list']=array('' => 'Select Campus');
		$this->data['intake_list']=$this->contactmodel->intake_list();
		$this->data['course_list']=array('' => 'Select Course');;
		$this->data['level_list']=$this->coursemodel->fill_levels();
		$this->data['status_list']=$this->contactmodel->status_list();

		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/candidate_view",$this->data);
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
		
		$this->load->model('contactmodel');
		
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);
		$this->data['education_details'] = $this->contactmodel->education_deatils($candidate_id);
		$this->data['job_history'] = $this->contactmodel->job_list($candidate_id);
		$this->data['all_counselor'] = $this->contactmodel->all_counselor($candidate_id);
		$this->data['candidate_counselor'] = $this->contactmodel->candidate_counselor($candidate_id);
		$this->data['candidate_skills'] = $this->contactmodel->candidate_skills($candidate_id);
		$this->data['candidate_certifications'] = $this->contactmodel->candidate_certifications($candidate_id);
		
		$this->data['candidate_questionnaire_summary'] = $this->contactmodel->get_survey_result($candidate_id);
	
		$this->data['candidate_programs_suggestion_summary'] = $this->contactmodel->candidate_programs_suggestion_summary($candidate_id);
		
		$this->data['candidate_files_summary'] = $this->contactmodel->get_files($candidate_id);
		$this->data['candidate_complaints_summary'] = $this->contactmodel->ticket_list($candidate_id);
			
		if($this->input->post('candidate_id')!='')
		{
		
			foreach($this->input->post('admin_id') as $key => $val)
			{
				$this->db->where('admin_id',$val);
				$this->db->where('candidate_id',$this->input->post('candidate_id'));
				$this->db->delete('pms_contact_counselor');
					if($this->input->post('action')=='Add')
					{
						$data=array(
						'candidate_id'   =>$this->input->post('candidate_id'),
						'admin_id'        =>$val,
						'assigned_date'   => date('Y-m-d'),
						);			
						$this->db->insert('pms_contact_counselor',$data);
					}
			}
			redirect('contact/summary/'.$candidate_id);
		}
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/candidate_summary",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	// candidate programs
	function candidate_programs($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->load->model('coursemodel');
		
		$this->data['edit_mode']='';
		$this->data['app_id']='';

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
			'total_tution_fee'    =>     $this->input->post('total_tution_fee')			
			);
			
			$this->db->where('app_id',$this->input->post('app_id'));
			$this->db->where('candidate_id',$this->input->post('candidate_id'));
			$this->db->update('pms_contact_applications',$data);
		// update suggestion logic from here
			$this->contactmodel->update_suggestion_module($this->input->post('candidate_id'), $this->input->post('campus_id'), $this->input->post('course_id'), $this->input->post('total_semester'), $this->input->post('fee_per_semester'), $this->input->post('annual_tution_fee'), $this->input->post('total_tution_fee'),$this->input->post('candidate_course_id'));
		// end here			
			redirect('contact/candidate_programs/'.$this->input->post('candidate_id').'/?upd=1');
		}
				
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id); // candidate details
		$this->data['aplication_list']=$this->contactmodel->aplication_record($candidate_id); // application lists - 		
		$this->data['university_list']=$this->contactmodel->university_list(); // university list		
		$this->data['intake_list']=$this->contactmodel->intake_list(); // intake list 		
		$this->data['level_list']=$this->coursemodel->fill_levels(); // education levels
		$this->data['status_list']=$this->contactmodel->status_list(); // application process status list
		$this->data['campus_list']=array('' => 'Select Campus');
		$this->data['course_list']=array('' => 'Select Course');
					
		$this->data['candidate_qualification_list']=$this->contactmodel->candidate_qualification_list($candidate_id); // candidate's qualification for higher studies


		// edit mode		
		if($this->input->get('app_id')!='')
		{
			$this->data['single_application']=$this->contactmodel->select_aplication_record($this->input->get('app_id'));
			if(count($this->data['single_application'])>0)
			{
				if($this->data['single_application']['univ_id']>0)$this->data['campus_list']=$this->contactmodel->campus_list($this->data['single_application']['univ_id']);
				if($this->data['single_application']['level_study']>0)$this->data['course_list']=$this->contactmodel->course_list_level($this->data['single_application']['level_study']);
				$this->data['app_id']=$this->input->get('app_id');
				$this->data['edit_mode']=1;
			}
		}else
		{
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
		}
		// update program		
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/candidate_programs",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	
	// Create an application	
	function aplication(){
	
	// if no candidate id, exit from here. 
	
	if($this->input->post('candidate_id')=='')
	{
		echo $dataArr;
		exit();	
	}
	
	$this->load->model('contactmodel');
	
	$data=array(
	'candidate_id'        =>       $this->input->post('candidate_id'),
	'campus_id'           =>       $this->input->post('campus_id'),
	'app_created'         =>       date('Y-m-d'),
	'course_id'           =>       $this->input->post('course_id'),
	'intake_id'           =>       $this->input->post('intake_id'),
	'app_details'         =>       $this->input->post('app_details'),
	'process_status_id'   =>       $this->input->post('status_id'),
	'candidate_course_id' =>     $this->input->post('candidate_course_id'),	
	'total_semester'      =>     $this->input->post('total_semester'),
	'fee_per_semester'    =>     $this->input->post('fee_per_semester'),
	'annual_tution_fee'   =>     $this->input->post('annual_tution_fee'),
	'total_tution_fee'    =>     $this->input->post('total_tution_fee')
	);
		
		$this->db->insert('pms_contact_applications',$data);
		$id=$this->db->insert_id();
		// update suggestion logic from here
		$this->contactmodel->update_suggestion_module($this->input->post('candidate_id'), $this->input->post('campus_id'), $this->input->post('course_id'), $this->input->post('total_semester'), $this->input->post('fee_per_semester'), $this->input->post('annual_tution_fee'), $this->input->post('total_tution_fee'),$this->input->post('candidate_course_id'));
		// end here
		
				
		$this->data['aplication_list']=$this->contactmodel->select_aplication_record($id);		
		$dataArr = $this->load->view('contact/candidate_aplication_list', $this->data,TRUE);
		echo $dataArr;
		exit();	
		$query = $this->db->query("SELECT *  FROM  pms_contact where candidate_id =".$_POST['candidate_id']);
			$row = $query->row_array();
			$subject = 'Application';
			$mail_body		=	'	
			<!DOCTYPE html>
				<head>
				
				<title>GreenOaksProperty.com</title>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
				
				<style type="text/css">
				
				body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
				html{width: 100%; }
				img {border:0px;text-decoration:none;display:block; outline:none;}
				a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
				table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  
				
				img[class=imageScale]			{}
				
				.main-bg{ background:#3b3b3b;}
				.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
				.space1{padding:35px 35px 35px 35px;}
				.contact-space{padding:15px 24px 15px 24px;}
				table[class=social]{ text-align:right;}
				.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
				.border-bg{ border-top:#67bd3c solid 4px;}
				.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
				.borter-inner-top{ border-top:#37a166 solid 1px;}
				.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
				.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
				.header-space{padding:0px 20px 0px 20px;}
				
				@media only screen and (max-width:640px)
				
				{
					body{width:auto!important;}
					.main{width:440px !important;margin:0px; padding:0px;}
					.two-left{width:440px !important; text-align: center!important;}
					.two-left-inner{width: 376px !important; text-align: center!important;}
					.header-space{padding:30px 0px 30px 0px;}
				}
				
				@media only screen and (max-width:479px)
				{
					 body{width:auto!important;}
					.main{width:280px !important;margin:0px; padding:0px;}
					.two-left{width: 280px !important; text-align: center!important;}
					.two-left-inner{width: 216px !important; text-align: center!important;}
					.space1{padding:35px 0px 35px 0px;}
					table[class=social]{ width:100%; text-align:center; margin-top:20px;}
					table[class=contact]{ width:100%; text-align:center; font:12px;}
					.contact-space{padding:15px 0px 15px 0px;}
					.header-space{padding:30px 0px 30px 0px;}
				}
				</style>
				</head>
				
				<body>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
				  <tr>
					<td align="center" valign="top" style="padding:50px 0px 50px 0px;">
					
				  <!--  Main Table Start-->
					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top">
						
						<!--  Header Part Start-->
						
						<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							  <tr>
								<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
								<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>
							  </tr>
							</table></td>
						  </tr>
						  </table>
						  
						  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space">
						
						
						 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
						   <tr>
				
							 <td align="center" valign="top">
							 
						
						
						<!--  Call Part Start-->
						</td>
					</tr>
				</table>
				
				<!--  Banner Part Start-->
				<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				  <tr>
					<td align="left" valign="top">&nbsp;</td>
					</tr>
				  <tr>
					<td align="left" valign="top">
					
					<!--  Banner Text Start-->
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$row['first_name'].',</strong><br />
								<br /><p>
								<h3>University Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['aplication_list']['univ_name'].'</h3>
								<h3>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['aplication_list']['course_name'].'</h3>
	<h3>Application Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['aplication_list']['status_name'].'</h3>
	
	<h3>Applicatibn Details:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['aplication_list']['app_details'].'</h3>
							  </p>
							  <p>Thank You ! <br>
							  </p></td>
							</tr>
						  </table></td>
					  </tr>
					  </table>
					<!--  Banner Text End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Banner Part End-->
				
				<!--  Header Part End-->
				
				
						  
						  </td>
					  </tr>
					  
					  <tr>
						<td align="left" valign="top">
						<!--  Footer Part Start-->
						<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
						  
						  
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
						 <br />
				
				<br />
				<center>
				'.$this->config->item("address").'</center></p></td>
						  </tr>
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
							
							
							
							</td>
						  </tr>
						</table>
						<!--  Footer Part End-->
						
						</td>
					  </tr>
					</table>
					
					<!--  Main Table End-->
					
					</td>
				  </tr>
				</table>
				</body>
				
				</html>
			';
		
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
	// CoE entry.
	function candidate_coe($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);

		$this->data['coe_list']=$this->contactmodel->coe_list($candidate_id);
		$this->data['app_list']=$this->contactmodel->aplication_list($candidate_id);
		$this->data['app_list_coe']=$this->contactmodel->select_aplication_coe($candidate_id);
		$this->data['status_list']=$this->contactmodel->status_list();

		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/candidate_coe",$this->data);
		$this->load->view("include/footer",$this->data);
	}


	//Candidate View
	function candidate_visa($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);

		$this->data['list']=$this->contactmodel->follow_record($candidate_id);
		$this->data['note_list']=$this->contactmodel->notes_record($candidate_id);		
		$this->data['coe_list']=$this->contactmodel->coe_list($candidate_id);
		$this->data['visa_approval_list']=$this->contactmodel->visa_approval_list($candidate_id);

		$this->data['interview_list']=$this->contactmodel->interview_record($candidate_id);
		$this->data['aplication_list']=$this->contactmodel->aplication_record($candidate_id);
		
		$this->data['interview_status_list']=$this->contactmodel->interview_status_list();		
		$this->data['app_list']=$this->contactmodel->aplication_list($candidate_id);
		$this->data['app_list_coe']=$this->contactmodel->select_aplication_coe($candidate_id);
		$this->data['admin_user_list']=$this->contactmodel->admin_user_list();
		$this->data['interview_type_list']=$this->contactmodel->interview_type_list();
		$this->data['university_list']=$this->contactmodel->university_list();
		$this->data['campus_list']=array('' => 'Select Campus');
		$this->data['intake_list']=$this->contactmodel->intake_list();
		$this->data['course_list']=array('' => 'Select Course');;
		$this->data['level_list']=$this->coursemodel->fill_levels();
		$this->data['status_list']=$this->contactmodel->status_list();

		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/candidate_visa",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	// Manage Email & SMS
	function email_sms($candidate_id)
	{

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);

			$this->data['email_sms_list']=$this->contactmodel->email_sms_list($candidate_id);
		
			if($this->input->post('send_type')!='')
			{
				$data=array(
				'candidate_id'   => $this->input->post('candidate_id'),
				'date_sent'      => date('Y-m-d H:i:s'),
				'subject'        => $this->input->post('subject'),
				'email_text'      => $this->input->post('email_text'),
				'sms_text'      => $this->input->post('sms_text'),
				'user_id'      => $_SESSION['admin_session'],
				'send_type'      => $this->input->post('send_type'),
				);
					
				$this->db->insert('pms_email_sms_history',$data);
				$id=$this->db->insert_id();
					
				 /*$subject=$_POST['subject'];
				 $text_email=$_POST['text_email'];
				 $email=$_POST['email'];
				//Load the email library
				$this->load->library('Email');
				$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'localhost',
				'smtp_port' => 425,
				'smtp_user' => 'shaijotm@gmail.com', // change it to yours
				'smtp_pass' => '', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
				); 
				
				$this->load->library('Email', $config); 
				$this->email->from('shaijotm@gmail.com', 'Message');
				$this->email->to($email);
				$this->email->subject($subject); 
				$this->email->message($text_email);
				if (!$this->email->send()) 
				{
					echo 'Your e-mail has been do not sent!';
					show_error($this->email->print_debugger());
					exit();
				}*/
				redirect('contact/email_sms/'.$candidate_id);
			}
			
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			$this->data['error']="Fill subject and email content to send to the candidate.";
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_email_sms",$this->data);
			$this->load->view("include/footer",$this->data);
	}

	// import csv
	function import_csv()
    {    
        $this->data['page_head'] = 'Import CSV';
        $this->data['cur_page']=$this->router->class;
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
			$this->load->view('contact/import_csv',$this->data);                
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
                        $contact[] = array_combine($keys, $contacts_data);
                    }
                }
            }

            for($i=0;$i<count($contact);$i++){
                $data = $contact[$i];
			    $this->load->model('contactmodel');
                $this->contactmodel->insert_csv_records($data);
            }
			    redirect('contact/?csv=1');
        }  
		      
    }


	// Manage complaints
	function tickets($candidate_id)
	{

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);

			$this->data['ticket_list']=$this->contactmodel->ticket_list($candidate_id);
		
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
					
				 /*$subject=$_POST['subject'];
				 $text_email=$_POST['text_email'];
				 $email=$_POST['email'];
				//Load the email library
				$this->load->library('Email');
				$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'localhost',
				'smtp_port' => 425,
				'smtp_user' => 'shaijotm@gmail.com', // change it to yours
				'smtp_pass' => '', // change it to yours
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'wordwrap' => TRUE
				); 
				
				$this->load->library('Email', $config); 
				$this->email->from('shaijotm@gmail.com', 'Message');
				$this->email->to($email);
				$this->email->subject($subject); 
				$this->email->message($text_email);
				if (!$this->email->send()) 
				{
					echo 'Your e-mail has been do not sent!';
					show_error($this->email->print_debugger());
					exit();
				}*/
				redirect('contact/tickets/'.$candidate_id);
			}
			
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			$this->data['error']="Fill appropriate details and send to candidates.";
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_complaints",$this->data);
			$this->load->view("include/footer",$this->data);
	}


	// Manage Summary & Reports
	function invoice($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);
		$this->data['education_details'] = $this->contactmodel->education_deatils($candidate_id);
		$this->data['job_history'] = $this->contactmodel->job_list($candidate_id);
		$this->data['all_counselor'] = $this->contactmodel->all_counselor($candidate_id);
		$this->data['candidate_counselor'] = $this->contactmodel->candidate_counselor($candidate_id);

		if($this->input->post('candidate_id')!=''){
		
		foreach($this->input->post('admin_id') as $key => $val)
		{
			$this->db->where('admin_id',$val);
			$this->db->where('candidate_id',$this->input->post('candidate_id'));
			$this->db->delete('pms_contact_counselor');
			
			if($this->input->post('action')=='Add')
			{
				$data=array(
				'candidate_id'   =>$this->input->post('candidate_id'),
				'admin_id'        =>$val,
				'assigned_date'=> date('Y-m-d'),
				);			
				$this->db->insert('pms_contact_counselor',$data);
			}
		}
			
			redirect('contact/summary/'.$candidate_id);
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_summary",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_invoice",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

		
	// Manage CV File
	function cvfile($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->contactmodel->cvfile_list($candidate_id);
		
		if($this->input->post('cvfile')!=''){
			$data=array(
			'candidate_id'   =>$this->input->post('candidate_id'),
			'cv_file'        =>$this->input->post('cvfile'),
			);
			
			$this->db->insert('pms_contact_cvfile',$data);
			$id=$this->db->insert_id();
			
			redirect('contact/cvfile/'.$candidate_id);
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_cvfile",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_cvfile",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Job History
	function job_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');


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
		$this->data["industry_list"] = $this->contactmodel->industry_list();
		$this->data["functional_list"] = $this->contactmodel->functional_list();
		$this->data["currecy_list"] = $this->contactmodel->currency_list();
		$this->data["years_list"] = $this->contactmodel->years_list();
		$this->data["months_list"] = $this->contactmodel->months_list();

		
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->contactmodel->job_list($candidate_id);

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
			$this->db->insert('pms_contact_job_profile', $data);
			redirect('contact/job_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Education History
	function edu_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');

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
		$this->data["edu_level_list"]   = $this->contactmodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->contactmodel->edu_years_list();
		//$this->data["edu_course_list"]  = $this->contactmodel->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->contactmodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->contactmodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->contactmodel->edu_course_type_list();

		//data for left panel
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->contactmodel->education_list($candidate_id);
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

			$this->db->insert('pms_contact_education', $data);
			redirect('contact/edu_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new education details";
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_edu_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	// Manage Lang History
	function lang_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->contactmodel->country_list();
		$this->data["formdata"] = $this->contactmodel->get_passport_single_record($candidate_id);
		
		if(count($this->data["formdata"])<1)
		{
			$this->data['formdata']=array(
					'passportno'       => '',
					'place_of_issue'   => '',
					'issued_date'      => '',
					'expiry_date'      => '',
					'country_list'     => '',
					'passport_nationality' => '',
					'eng_pte' => '',
					'eng_pte_reading' => '',
					'eng_pte_listening' => '',
					'eng_pte_writing' => '',
					'eng_pte_speaking' => '',
					'eng_ielts' =>'',
					'eng_ielts_reading' => '',
					'eng_ielts_listening' => '',
					'eng_ielts_writing' => '',
					'eng_ielts_speaking' => '',
					'eng_tofel' => '',
					'eng_tofel_reading' => '',
					'eng_tofel_listening' => '',
					'eng_tofel_writing' => '',
					'eng_tofel_speaking' => '',
					'eng_oet' => '',
					'eng_oet_reading' => '',
					'eng_oet_listening' => '',
					'eng_oet_writing' => '',
					'eng_oet_speaking' => '',					
					'eng_gre' => '',
					'eng_gmat' => '',
					'eng_sat' => '',
					'eng_10th' => '',
					'eng_12th' => '',
					'visa_type_id' => ''
			);
		}
		
		//employment
		$this->data["industry_list"] = $this->contactmodel->industry_list();
		$this->data["functional_list"] = $this->contactmodel->functional_list();
		$this->data["currecy_list"] = $this->contactmodel->currency_list();
		$this->data["years_list"] = $this->contactmodel->years_list();
		$this->data["months_list"] = $this->contactmodel->months_list();

		
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);


		$this->data['cv_fileist']=$this->contactmodel->job_list($candidate_id);
		
		if($this->input->post('candidate_id')!=''){
							$data=array(
							'passportno'       => $this->input->post('passportno'),
							'place_of_issue'   => $this->input->post('place_of_issue'),
							'issued_date'      => $this->input->post('issued_date'),
							'expiry_date'      => $this->input->post('expiry_date'),
							'passport_nationality' => $this->input->post('passport_nationality'),
							'eng_pte' => $this->input->post('eng_pte'),
							'eng_pte_reading' => $this->input->post('eng_pte_reading'),
							'eng_pte_listening' => $this->input->post('eng_pte_listening'),
							'eng_pte_writing' => $this->input->post('eng_pte_writing'),
							'eng_pte_speaking' => $this->input->post('eng_pte_speaking'),
							'eng_ielts' => $this->input->post('eng_ielts'),
							'eng_ielts_reading' => $this->input->post('eng_ielts_reading'),
							'eng_ielts_listening' => $this->input->post('eng_ielts_listening'),
							'eng_ielts_writing' => $this->input->post('eng_ielts_writing'),
							'eng_ielts_speaking' => $this->input->post('eng_ielts_speaking'),
							'eng_tofel' => $this->input->post('eng_tofel'),
							'eng_tofel_reading' => $this->input->post('eng_tofel_reading'),
							'eng_tofel_listening' => $this->input->post('eng_tofel_listening'),
							'eng_tofel_writing' => $this->input->post('eng_tofel_writing'),
							'eng_tofel_speaking' => $this->input->post('eng_tofel_speaking'),
							'eng_oet' => $this->input->post('eng_oet'),
							'eng_oet_reading' => $this->input->post('eng_oet_reading'),
							'eng_oet_listening' => $this->input->post('eng_oet_listening'),
							'eng_oet_writing' => $this->input->post('eng_oet_writing'),
							'eng_oet_speaking' => $this->input->post('eng_oet_speaking'),							
							'eng_gre' => $this->input->post('eng_gre'),
							'eng_gmat' => $this->input->post('eng_gmat'),
							'eng_sat' => $this->input->post('eng_sat'),
							'eng_10th' => $this->input->post('eng_10th'),
							'eng_12th' => $this->input->post('eng_12th'),
							'visa_type_id' => $this->input->post('visa_type_id')
							);
						
			   $this->db->where('candidate_id', $this->input->post('candidate_id'));
			   $this->db->update('pms_contact', $data);
			   redirect('contact/lang_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_lang_history",$this->data);
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
		$this->load->model('contactmodel');
		$this->data['survey_result']=$this->contactmodel->get_survey_result($candidate_id);
		
		$this->data['cv_file']='';
		$this->data['photo_file']='';
		
		$cv_file=0;
		$photo_file=0;
		if($this->input->get('cv_file')==1)$this->data['cv_file']='CV Uploaded Successfully, please view it from summary page.';
		if($this->input->get('photo_file')==1)$this->data['photo_file']='Photo Uploaded Successfully, please view it from summary page.';
		
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->contactmodel->job_list($candidate_id);
		
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
					$this->db->query("delete from pms_contact_survey_result where candidate_id=".$candidate_id);
					foreach($survey_array as $item => $val)
					{
						$this->db->insert('pms_contact_survey_result', $val);
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
							$this->db->query("update pms_contact set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $candidate_id
							);
							$this->contactmodel->insert_files($dataArr);
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
							$this->db->query("update pms_contact set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
							$dataArr = array(
								'file_name' => $this->upload_file_name,
								'file_type'=> $this->upload_file_name,
								'candidate_id' => $candidate_id
							);
							$this->contactmodel->insert_files($dataArr);
							$photo_file=1;
						}
					}
				}
			   redirect('contact/questionnaire/'.$this->input->post('candidate_id').'?cv_file='.$cv_file.'&photo_file='.$photo_file);
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("contact/candidate_questionnaire",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

// tech skills

function skills($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		
		if($this->input->post('candidate_id'))
		{
			if(is_array($this->input->post('skill')))
			{
				$this->db->query("delete from pms_contact_to_skills where candidate_id=".$candidate_id);
				foreach($this->input->post('skill') as $key => $val)
				{				
					$data=array('skill_id' => $val , 'candidate_id' => $this->input->post('candidate_id'));
					
					$this->db->insert('pms_contact_to_skills', $data);
				}
			}else
			{
				
				$this->db->query("delete from pms_contact_to_skills where candidate_id=".$candidate_id);
				
			}
			   redirect('contact/skills/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['skill_list']=$this->contactmodel->get_skill_set();
		$this->data['skill_list_current']=$this->contactmodel->get_skill_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->contactmodel->job_list($candidate_id);
				
		$path = '../js/ckfinder';
		$width = '700px';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/candidate_skills",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
// certifications

function certifications($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		
		if($this->input->post('candidate_id'))
		{
			if(is_array($this->input->post('certifications')))
			{
				$this->db->query("delete from pms_contact_to_certification where candidate_id=".$candidate_id);
				foreach($this->input->post('certifications') as $key => $val)
				{				
					$data=array('cert_id' => $val , 'candidate_id' => $this->input->post('candidate_id'));
					$this->db->insert('pms_contact_to_certification', $data);
				}
			}else
			{
				$this->db->query("delete from pms_contact_to_certification where candidate_id=".$candidate_id);
			}
			   redirect('contact/certifications/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['certifications_list']=$this->contactmodel->get_certifications_set();
		$this->data['certifications_list_current']=$this->contactmodel->get_certifications_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->contactmodel->job_list($candidate_id);
		
		$path = '../js/ckfinder';
		$width = '700px';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/candidate_certifications",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	// Follow up
	function followup()
	{
		$this->load->model('contactmodel');
		if(isset($_POST['candidate_id']))
		{
			//date_default_timezone_set("Asia/Kolkata"); 
			
			$data=array(
			'candidate_id'   =>$_POST['candidate_id'],
			'title'          =>$_POST['title'],
			'description'    =>$_POST['desc'],
			'admin_id'       => $_SESSION['admin_session'],
			'flp_date'       => date('Y-m-d h:m:s A')
			);
			
			if($this->input->post('future_followup')==1)
			{
				$data['flp_date_reminder']=$_POST['flp_date_reminder'];
				$data['flp_time_reminder']=$_POST['flp_time_reminder'];
				$data['assigned_to']      =$_POST['assigned_to'];
			}

			$query1=$this->db->insert('pms_contact_followup',$data);
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
					'task_priority_id'    =>  2,
					'task_status_id'      =>  1,
					'status'              =>  1,
				);
				$query_task=$this->db->insert('pms_tasks',$data);
			}
			
			$this->data['single_list']=$this->contactmodel->select_record($id);
		
			$dataArr = $this->load->view('contact/candidatefollowup_list', $this->data,TRUE);
			echo $dataArr;
			exit();
		}	
	}
	
	
	// Create New Note
	function notes(){
		
	$data=array(
	'candidate_id'   =>$_POST['candidate_id'],
	'title'          =>$_POST['title'],
	'notes'          =>$_POST['note']
	);
	
	$this->db->insert('pms_contact_notes',$data);
	$id=$this->db->insert_id();
	$this->load->model('contactmodel');
	$this->data['note_list']=$this->contactmodel->select_notes_record($id);
	$dataArr = $this->load->view('contact/candidatenotes_list', $this->data,TRUE);
	echo $dataArr;
	
	}
	
	// Schedule an interview
	function interview(){

	$data=array(
	'candidate_id'     =>$_POST['candidate_id'],
	'interview_date'   =>$_POST['interview_date'],
	'title'            =>$_POST['title'],
	'description'        =>$_POST['interview'],
	'duration'         =>$_POST['duration'],
	'interview_time'   =>$_POST['interview_time'],
	'interview_type_id'=>$_POST['interview_type'],
	'int_status_id'    =>$_POST['interview_status'],
	'location'         =>$_POST['location'],
	);
	$this->db->insert('pms_contact_interviews',$data);
	$id=$this->db->insert_id();
	$this->load->model('contactmodel');
	$this->data['interview_list']=$this->contactmodel->select_interview_record($id);
	$dataArr = $this->load->view('contact/candidateinterview_list', $this->data,TRUE);
	echo $dataArr;
	
	$query = $this->db->query("SELECT *  FROM  pms_contact where candidate_id =".$_POST['candidate_id']);
		$row = $query->row_array();
		$subject = 'Interview';
		$mail_body		=	'	
		<!DOCTYPE html>
			<head>
			
			<title>GreenOaksProperty.com</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
			
			<style type="text/css">
			
			body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
			html{width: 100%; }
			img {border:0px;text-decoration:none;display:block; outline:none;}
			a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
			table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  
			
			img[class=imageScale]			{}
			
			.main-bg{ background:#3b3b3b;}
			.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
			.space1{padding:35px 35px 35px 35px;}
			.contact-space{padding:15px 24px 15px 24px;}
			table[class=social]{ text-align:right;}
			.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
			.border-bg{ border-top:#67bd3c solid 4px;}
			.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
			.borter-inner-top{ border-top:#37a166 solid 1px;}
			.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
			.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
			.header-space{padding:0px 20px 0px 20px;}
			
			@media only screen and (max-width:640px)
			
			{
				body{width:auto!important;}
				.main{width:440px !important;margin:0px; padding:0px;}
				.two-left{width:440px !important; text-align: center!important;}
				.two-left-inner{width: 376px !important; text-align: center!important;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			
			@media only screen and (max-width:479px)
			{
				 body{width:auto!important;}
				.main{width:280px !important;margin:0px; padding:0px;}
				.two-left{width: 280px !important; text-align: center!important;}
				.two-left-inner{width: 216px !important; text-align: center!important;}
				.space1{padding:35px 0px 35px 0px;}
				table[class=social]{ width:100%; text-align:center; margin-top:20px;}
				table[class=contact]{ width:100%; text-align:center; font:12px;}
				.contact-space{padding:15px 0px 15px 0px;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			</style>
			</head>
			
			<body>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
			  <tr>
				<td align="center" valign="top" style="padding:50px 0px 50px 0px;">
				
			  <!--  Main Table Start-->
				
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top">
					
					<!--  Header Part Start-->
					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
							<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>
						  </tr>
						</table></td>
					  </tr>
					  </table>
					  
					  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space">
					
					
					 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					   <tr>
			
						 <td align="center" valign="top">
						 
					
					
					<!--  Call Part Start-->
					</td>
				</tr>
			</table>
			
			<!--  Banner Part Start-->
			<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top">&nbsp;</td>
				</tr>
			  <tr>
				<td align="left" valign="top">
				
				<!--  Banner Text Start-->
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$row['first_name'].',</strong><br />
							<br /><p>
							<h3>Interview title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['interview_list']['title'].'</h3>
							<h3>Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['interview_list']['description'].'</h3>
<h3>Interview Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['interview_list']['interview_date'].'</h3>

<h3>Interview Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['interview_list']['interview_time'].'</h3>
<h3>Duration:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['interview_list']['duration'].'</h3>
<h3>Interview Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['interview_list']['interview_type'].'</h3>
<h3>Interview Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['interview_list']['int_status_name'].'</h3>
<h3>Interview Location:&nbsp;'. $this->data['interview_list']['location'].'</h3>


						  </p>
						  <p>Thank You ! <br>
						  </p></td>
						</tr>
					  </table></td>
				  </tr>
				  </table>
				<!--  Banner Text End-->
				
				</td>
			  </tr>
			</table>
			
			<!--  Banner Part End-->
			
			<!--  Header Part End-->
			
			
					  
					  </td>
				  </tr>
				  
				  <tr>
					<td align="left" valign="top">
					<!--  Footer Part Start-->
					<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
					  
					  
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
					 <br />
			
			<br />
			<center>
			'.$this->config->item("address").'</center></p></td>
					  </tr>
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
						
						
						
						</td>
					  </tr>
					</table>
					<!--  Footer Part End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Main Table End-->
				
				</td>
			  </tr>
			</table>
			</body>
			
			</html>
		';
		
		$name = $row['first_name']." ".$row['last_name'];
		$email = $row['username'];
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('shaijotm@gmail.com',$name);
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



	// Create a VISA	
	function visa_approval(){
		$data=array(
		'candidate_id'        =>$_POST['candidate_id'],
		'campus_id'       =>$_POST['campus_id'],
		'course_id'           =>$_POST['course_id'],
		'intake_id'           =>$_POST['intake_id'],
		'app_details'         =>$_POST['app_details'],
		'process_status_id'   =>$_POST['status_id'],	
		);
		$this->db->insert('pms_contact_applications',$data);
		 $id=$this->db->insert_id();
		$this->load->model('contactmodel');
		$this->data['aplication_list']=$this->contactmodel->select_aplication_coe($id);
		$dataArr = $this->load->view('contact/candidate_aplication_list', $this->data,TRUE);
		echo $dataArr;
		exit();	
		$query = $this->db->query("SELECT *  FROM  pms_contact where candidate_id =".$_POST['candidate_id']);
			$row = $query->row_array();
			$subject = 'Application';
			$mail_body		=	'	
			<!DOCTYPE html>
				<head>
				
				<title>GreenOaksProperty.com</title>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
				
				<style type="text/css">
				
				body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
				html{width: 100%; }
				img {border:0px;text-decoration:none;display:block; outline:none;}
				a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
				table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  
				
				img[class=imageScale]			{}
				
				.main-bg{ background:#3b3b3b;}
				.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
				.space1{padding:35px 35px 35px 35px;}
				.contact-space{padding:15px 24px 15px 24px;}
				table[class=social]{ text-align:right;}
				.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
				.border-bg{ border-top:#67bd3c solid 4px;}
				.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
				.borter-inner-top{ border-top:#37a166 solid 1px;}
				.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
				.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
				.header-space{padding:0px 20px 0px 20px;}
				
				@media only screen and (max-width:640px)
				
				{
					body{width:auto!important;}
					.main{width:440px !important;margin:0px; padding:0px;}
					.two-left{width:440px !important; text-align: center!important;}
					.two-left-inner{width: 376px !important; text-align: center!important;}
					.header-space{padding:30px 0px 30px 0px;}
				}
				
				@media only screen and (max-width:479px)
				{
					 body{width:auto!important;}
					.main{width:280px !important;margin:0px; padding:0px;}
					.two-left{width: 280px !important; text-align: center!important;}
					.two-left-inner{width: 216px !important; text-align: center!important;}
					.space1{padding:35px 0px 35px 0px;}
					table[class=social]{ width:100%; text-align:center; margin-top:20px;}
					table[class=contact]{ width:100%; text-align:center; font:12px;}
					.contact-space{padding:15px 0px 15px 0px;}
					.header-space{padding:30px 0px 30px 0px;}
				}
				</style>
				</head>
				
				<body>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
				  <tr>
					<td align="center" valign="top" style="padding:50px 0px 50px 0px;">
					
				  <!--  Main Table Start-->
					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top">
						
						<!--  Header Part Start-->
						
						<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							  <tr>
								<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
								<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>
							  </tr>
							</table></td>
						  </tr>
						  </table>
						  
						  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space">
						
						
						 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
						   <tr>
				
							 <td align="center" valign="top">
							 
						
						
						<!--  Call Part Start-->
						</td>
					</tr>
				</table>
				
				<!--  Banner Part Start-->
				<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				  <tr>
					<td align="left" valign="top">&nbsp;</td>
					</tr>
				  <tr>
					<td align="left" valign="top">
					
					<!--  Banner Text Start-->
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$row['first_name'].',</strong><br />
								<br /><p>
								<h3>University Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['aplication_list']['univ_name'].'</h3>
								<h3>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['aplication_list']['course_name'].'</h3>
	<h3>Application Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['aplication_list']['status_name'].'</h3>
	
	<h3>Applicatibn Details:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['aplication_list']['app_details'].'</h3>
							  </p>
							  <p>Thank You ! <br>
							  </p></td>
							</tr>
						  </table></td>
					  </tr>
					  </table>
					<!--  Banner Text End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Banner Part End-->
				
				<!--  Header Part End-->
				
				
						  
						  </td>
					  </tr>
					  
					  <tr>
						<td align="left" valign="top">
						<!--  Footer Part Start-->
						<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
						  
						  
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
						 <br />
				
				<br />
				<center>
				'.$this->config->item("address").'</center></p></td>
						  </tr>
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
							
							
							
							</td>
						  </tr>
						</table>
						<!--  Footer Part End-->
						
						</td>
					  </tr>
					</table>
					
					<!--  Main Table End-->
					
					</td>
				  </tr>
				</table>
				</body>
				
				</html>
			';
		
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
	// CoE update on an application
	function create_coe(){

		$this->load->model('contactmodel');

		$this->data=array(
		'process_status_id'       =>$_POST['cand_app_id'],
		'coe_title'               =>$_POST['coe_title'],
		'student_id'              =>$_POST['student_id'],
		'course_code'             =>$_POST['course_code'],		
		'annual_tution_fee'       =>$_POST['annual_tution_fee'],
		'course_duration'         =>$_POST['course_duration'],
		'course_commencement'     =>$_POST['course_commencement'],
		'orientation_date'        =>$_POST['orientation_date'],
		'start_date'              =>$_POST['start_date'],
		'end_date'                =>$_POST['end_date'],
		'course_details'          =>$_POST['course_details'],	
		'app_status'              => '1',
		);
		
		$this->db->where('candidate_id', $_POST['candidate_id']);
		$this->db->where('app_id', $_POST['cand_app_id']);
		$this->db->update('pms_contact_applications', $this->data); 
		
	
		$query = $this->db->query("SELECT *  FROM  pms_contact where candidate_id =".$_POST['candidate_id']);
			$row = $query->row_array();
			$subject = 'Application';
			$mail_body		=	'	
			<!DOCTYPE html>
				<head>
				
				<title>GreenOaksProperty.com</title>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
				
				<style type="text/css">
				
				body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
				html{width: 100%; }
				img {border:0px;text-decoration:none;display:block; outline:none;}
				a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
				table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  
				
				img[class=imageScale]			{}
				
				.main-bg{ background:#3b3b3b;}
				.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
				.space1{padding:35px 35px 35px 35px;}
				.contact-space{padding:15px 24px 15px 24px;}
				table[class=social]{ text-align:right;}
				.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
				.border-bg{ border-top:#67bd3c solid 4px;}
				.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
				.borter-inner-top{ border-top:#37a166 solid 1px;}
				.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
				.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
				.header-space{padding:0px 20px 0px 20px;}
				
				@media only screen and (max-width:640px)
				
				{
					body{width:auto!important;}
					.main{width:440px !important;margin:0px; padding:0px;}
					.two-left{width:440px !important; text-align: center!important;}
					.two-left-inner{width: 376px !important; text-align: center!important;}
					.header-space{padding:30px 0px 30px 0px;}
				}
				
				@media only screen and (max-width:479px)
				{
					 body{width:auto!important;}
					.main{width:280px !important;margin:0px; padding:0px;}
					.two-left{width: 280px !important; text-align: center!important;}
					.two-left-inner{width: 216px !important; text-align: center!important;}
					.space1{padding:35px 0px 35px 0px;}
					table[class=social]{ width:100%; text-align:center; margin-top:20px;}
					table[class=contact]{ width:100%; text-align:center; font:12px;}
					.contact-space{padding:15px 0px 15px 0px;}
					.header-space{padding:30px 0px 30px 0px;}
				}
				</style>
				</head>
				
				<body>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
				  <tr>
					<td align="center" valign="top" style="padding:50px 0px 50px 0px;">
					
				  <!--  Main Table Start-->
					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top">
						
						<!--  Header Part Start-->
						
						<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							  <tr>
								<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
								<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>
							  </tr>
							</table></td>
						  </tr>
						  </table>
						  
						  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space">
						
						
						 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
						   <tr>
				
							 <td align="center" valign="top">
							 
						
						
						<!--  Call Part Start-->
						</td>
					</tr>
				</table>
				
				<!--  Banner Part Start-->
				<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				  <tr>
					<td align="left" valign="top">&nbsp;</td>
					</tr>
				  <tr>
					<td align="left" valign="top">
					
					<!--  Banner Text Start-->
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$row['first_name'].',</strong><br />
								<br /><p>
								<h3>University Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['coe_title'].'</h3>
								<h3>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['coe_title'].'</h3>
	<h3>Application Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['coe_title'].'</h3>
	
	<h3>Applicatibn Details:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['coe_title'].'</h3>
							  </p>
							  <p>Thank You ! <br>
							  </p></td>
							</tr>
						  </table></td>
					  </tr>
					  </table>
					<!--  Banner Text End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Banner Part End-->
				
				<!--  Header Part End-->
				
				
						  
						  </td>
					  </tr>
					  
					  <tr>
						<td align="left" valign="top">
						<!--  Footer Part Start-->
						<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
						  
						  
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
						 <br />
				
				<br />
				<center>
				'.$this->config->item("address").'</center></p></td>
						  </tr>
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
							
							
							
							</td>
						  </tr>
						</table>
						<!--  Footer Part End-->
						
						</td>
					  </tr>
					</table>
					
					<!--  Main Table End-->
					
					</td>
				  </tr>
				</table>
				</body>
				
				</html>
			';
		
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

	// VISA update on an application
	function create_visa(){

		$this->load->model('contactmodel');

		$data=array(
		'app_id'             =>  $_POST['app_id'],
		'candidate_id'       =>  $_POST['candidate_id'],
		'visa_apprv_date'    =>  $_POST['visa_apprv_date'],		
		'travel_date'        =>  $_POST['travel_date'],
		'date_of_join'       =>  $_POST['date_of_join'],
		'sms_text'           =>  $_POST['sms_text'],
		'email_text'         =>  $_POST['email_text'],
		'comments'           =>  $_POST['comments'],
		'date_invoice'       =>  date('Y-m-d')
		);
		
		$this->db->insert('pms_contact_visa_approval', $data); 
		exit();		
	
		$query = $this->db->query("SELECT *  FROM  pms_contact where candidate_id =".$_POST['candidate_id']);
			$row = $query->row_array();
			$subject = 'Application';
			$mail_body		=	'	
			<!DOCTYPE html>
				<head>
				
				<title>GreenOaksProperty.com</title>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
				<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
				
				<style type="text/css">
				
				body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
				html{width: 100%; }
				img {border:0px;text-decoration:none;display:block; outline:none;}
				a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
				table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  
				
				img[class=imageScale]			{}
				
				.main-bg{ background:#3b3b3b;}
				.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
				.space1{padding:35px 35px 35px 35px;}
				.contact-space{padding:15px 24px 15px 24px;}
				table[class=social]{ text-align:right;}
				.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
				.border-bg{ border-top:#67bd3c solid 4px;}
				.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
				.borter-inner-top{ border-top:#37a166 solid 1px;}
				.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
				.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
				.header-space{padding:0px 20px 0px 20px;}
				
				@media only screen and (max-width:640px)
				
				{
					body{width:auto!important;}
					.main{width:440px !important;margin:0px; padding:0px;}
					.two-left{width:440px !important; text-align: center!important;}
					.two-left-inner{width: 376px !important; text-align: center!important;}
					.header-space{padding:30px 0px 30px 0px;}
				}
				
				@media only screen and (max-width:479px)
				{
					 body{width:auto!important;}
					.main{width:280px !important;margin:0px; padding:0px;}
					.two-left{width: 280px !important; text-align: center!important;}
					.two-left-inner{width: 216px !important; text-align: center!important;}
					.space1{padding:35px 0px 35px 0px;}
					table[class=social]{ width:100%; text-align:center; margin-top:20px;}
					table[class=contact]{ width:100%; text-align:center; font:12px;}
					.contact-space{padding:15px 0px 15px 0px;}
					.header-space{padding:30px 0px 30px 0px;}
				}
				</style>
				</head>
				
				<body>
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
				  <tr>
					<td align="center" valign="top" style="padding:50px 0px 50px 0px;">
					
				  <!--  Main Table Start-->
					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top">
						
						<!--  Header Part Start-->
						
						<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
							  <tr>
								<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
								<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>
							  </tr>
							</table></td>
						  </tr>
						  </table>
						  
						  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space">
						
						
						 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
						   <tr>
				
							 <td align="center" valign="top">
							 
						
						
						<!--  Call Part Start-->
						</td>
					</tr>
				</table>
				
				<!--  Banner Part Start-->
				<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
				  <tr>
					<td align="left" valign="top">&nbsp;</td>
					</tr>
				  <tr>
					<td align="left" valign="top">
					
					<!--  Banner Text Start-->
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$row['first_name'].',</strong><br />
								<br /><p>
								<h3>University Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Test</h3>
								<h3>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Test</h3>
	<h3>Application Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;test</h3>
	
	<h3>Applicatibn Details:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;test</h3>
							  </p>
							  <p>Thank You ! <br>
							  </p></td>
							</tr>
						  </table></td>
					  </tr>
					  </table>
					<!--  Banner Text End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Banner Part End-->
				
				<!--  Header Part End-->
				
				
						  
						  </td>
					  </tr>
					  
					  <tr>
						<td align="left" valign="top">
						<!--  Footer Part Start-->
						<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
						  
						  
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
						 <br />
				
				<br />
				<center>
				Test</center></p></td>
						  </tr>
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
							
							
							
							</td>
						  </tr>
						</table>
						<!--  Footer Part End-->
						
						</td>
					  </tr>
					</table>
					
					<!--  Main Table End-->
					
					</td>
				  </tr>
				</table>
				</body>
				
				</html>
			';
		
		
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
		
		$this->load->model('contactmodel');
		 $this->contactmodel->drop_record($candidate_follow_id);
		$dataArr = $this->load->view('contact/candidate_view');
		echo $dataArr;
	}
	
	function cvfile_drop(){
		$cvfile_id=$_POST['cvfile_id'];
		$this->load->model('contactmodel');
		$this->contactmodel->cvfile_drop_record($cvfile_id);		          
	}

	function drop_job_item()
	{
		$job_profile_id=$this->input->post('job_profile_id');
		$this->load->model('contactmodel');
		$this->contactmodel->drop_job_item($job_profile_id);
	}

	function drop_email_sms_item()
	{
		$email_sms_id=$this->input->post('email_sms_id');
		$this->load->model('contactmodel');
		$this->contactmodel->drop_email_sms_item($email_sms_id);
	}

	function drop_ticket_item()
	{
		$ticket_id=$this->input->post('ticket_id');
		$this->load->model('contactmodel');
		$this->contactmodel->drop_ticket_item($ticket_id);
	}
		
	function drop_edu_item(){
		$eucation_id=$this->input->post('eucation_id');
		$this->load->model('contactmodel');
		$this->contactmodel->drop_edu_item($eucation_id);
	}	
	
	function drop_notes(){
		 $candidate_note_id=$_POST['candidate_note_id'];
		
		$this->load->model('contactmodel');
		$this->contactmodel->note_drop_record($candidate_note_id);
		$dataArr = $this->load->view('contact/candidate_view');
		echo $dataArr;
		          
	}
	
	
	 function drop_interviews(){
		 $interview_id=$_POST['interview_id'];
		$this->load->model('contactmodel');
		$this->contactmodel->interview_drop_record($interview_id);
		$dataArr = $this->load->view('contact/candidate_view');
		echo $dataArr;
		          
	}
	
	
	 function drop_aplication(){
		 $app_id=$_POST['app_id'];
		$this->load->model('contactmodel');
		$this->contactmodel->aplication_drop_record($app_id);
		$dataArr = $this->load->view('contact/candidate_view');
		echo $dataArr;
		          
	}
	
		
	function candidate_file($candidate_id)
	{
	

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);
	   if($this->input->post('title')!='')
	   {
   	
			 if(isset($_FILES['photo']))
			 {
					if(!$candidate_id='')
					{
						$this->load->model('contactmodel');
						$id=$this->contactmodel->insert_file($candidate_id);
						redirect('contact/candidate_file/'.$this->input->post('candidate_id'));
					}
			}
		}
		$this->data['file_list']=$this->contactmodel->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/manage_files",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function csv_data_import($candidate_id)
	{
	

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('contactmodel');
		$this->data['detail_list'] = $this->contactmodel->detail_list($candidate_id);

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
		$this->data['file_list']=$this->contactmodel->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		$this->load->view("contact/csv_data_import",$this->data);
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
						$this->load->model('contactmodel');
						$id=$this->contactmodel->insert_file($candidate_id);
						$this->data['upload_list']=$this->contactmodel->get_one_record($id);
						$replay=$this->load->view("contact/upload_file",$this->data,TRUE);
						echo $replay;
					}
					else
					{
						redirect("contact/candidate_file");
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
						  $this->load->model('contactmodel');
						   $this->contactmodel->update_file($candidate_id);
	
							 $this->data['single_file']=$this->contactmodel->get_one_file($candidate_id);
	
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
			$this->db->delete('pms_contact_files'); 
		}
	}
	
		function deletefile1()
	{
			 $id=$this->input->post('candidate_id');
		if(!empty($id))
		{
		
			          $this->load->model('contactmodel');
					   $this->contactmodel->delete_file($id);
					    $this->data['delete_file']=$this->contactmodel->delete_one_file($id);
						
                           echo $this->data['delete_file']['photo'];  //$replay=$this->load->view("contact/delete_file",$this->data,TRUE);
					         //echo $replay;
			
		}
	
	}

	function delete_cv($id)
	{
		if(!empty($id))
		{
			$query = $this->db->query("select cv_file from pms_contact where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
				{	
					unlink('uploads/cvs/'.$row['cv_file']);
				}
				$this->db->query("update  pms_contact set cv_file='' where candidate_id=".$id);
			}
			redirect("contact/summary/".$id."?del_cv=1");
		}else
		{
			redirect("contact/summary/".$id);
		}
	}

	function delete_photo($id)
	{
		if(!empty($id))
		{
			$query = $this->db->query("select photo from pms_contact where candidate_id=".$id);
			
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
				{
					unlink('uploads/photos/'.$row['photo']);
				}
				$this->db->query("update pms_contact set photo='' where candidate_id=".$id);
			}
			redirect("contact/summary/".$id."?del_photo=1");
		}else
		{
			redirect("contact/summary/".$id);
		}
	}
	
	function candidate_delete($id)
	{
		$this->load->model('contactmodel');
		if(!empty($id))
		{
			$this->contactmodel->candidate_delete($id);
			redirect('contact/?del=1');
		}
	}

	function move_to_candidate($id)
	{
		$this->load->model('contactmodel');
		if(!empty($id))
		{
			$id=$this->contactmodel->move_to_candidate($id);
			if($id=='0')
				redirect('contact/?dups=1');
			elseif($id>0)
				redirect('candidates/summary/'.$id);
		}
	}
	

	function check_dups()
	{
		$this->db->where('username', $this->input->post('username'));
		//if($this->input->post('candidate_id') > 0)	$this->db->where('candidate_id !=', $this->input->post('candidate_id'));
		$query = $this->db->get('pms_contact');
		
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
		$this->load->model('contactmodel');
		$candidatesArr	= $_POST['selectedArr'];
		$adminId		= $_POST['admin_id'];
		for($i=0;$i<count($candidatesArr);$i++){
			$id = $this->contactmodel->assign_admin_user($candidatesArr[$i],$adminId);
		}
		/***************************** send mail to admin user ***************************/
		$data["adminEmail"] = $this->contactmodel->getAdminEmail($adminId);
		$subject = 'Assignment';
		$logopath = base_url('assets/images/logo.png');
		$fb = base_url('assets/images/p_icon8.png');;
		$twtr = base_url('assets/images/p_icon9.png');;
		$lkdn = base_url('assets/images/p_icon10.png');;
		$mail_body		=	'	
		<!DOCTYPE html>
			<head>
			
			<title>GreenOaksProperty.com</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
			
			<style type="text/css">
			
			body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
			html{width: 100%; }
			img {border:0px;text-decoration:none;display:block; outline:none;}
			a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
			table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  
			
			img[class=imageScale]			{}
			
			.main-bg{ background:#3b3b3b;}
			.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
			.space1{padding:35px 35px 35px 35px;}
			.contact-space{padding:15px 24px 15px 24px;}
			table[class=social]{ text-align:right;}
			.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
			.border-bg{ border-top:#67bd3c solid 4px;}
			.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
			.borter-inner-top{ border-top:#37a166 solid 1px;}
			.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
			.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
			.header-space{padding:0px 20px 0px 20px;}
			
			@media only screen and (max-width:640px)
			
			{
				body{width:auto!important;}
				.main{width:440px !important;margin:0px; padding:0px;}
				.two-left{width:440px !important; text-align: center!important;}
				.two-left-inner{width: 376px !important; text-align: center!important;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			
			@media only screen and (max-width:479px)
			{
				 body{width:auto!important;}
				.main{width:280px !important;margin:0px; padding:0px;}
				.two-left{width: 280px !important; text-align: center!important;}
				.two-left-inner{width: 216px !important; text-align: center!important;}
				.space1{padding:35px 0px 35px 0px;}
				table[class=social]{ width:100%; text-align:center; margin-top:20px;}
				table[class=contact]{ width:100%; text-align:center; font:12px;}
				.contact-space{padding:15px 0px 15px 0px;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			</style>
			</head>
			
			<body>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
			  <tr>
				<td align="center" valign="top" style="padding:50px 0px 50px 0px;">
				
			  <!--  Main Table Start-->
				
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top">
					
					<!--  Header Part Start-->
					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
							<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>
						  </tr>
						</table></td>
					  </tr>
					  </table>
					  
					  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space">
					
					
					 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					   <tr>
			
						 <td align="center" valign="top">
						 
						 <!--  Logo Part Start-->
						 
						  <table border="0" align="left" cellpadding="0" cellspacing="0" class="two-left">
					  <tr>
					   <td align="center" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"><img src="'.$logopath.'" width="141" height="42" alt="" /></td>
					  </tr>
					</table>
					
					<!--  Logo Part End-->
					
					<!--  Call Part Start-->
					<table  border="0" align="right" cellpadding="0" cellspacing="0" class="two-left">
			  <tr>
				  <td align="center" valign="bottom" style="font:Bold 15px Arial, Helvetica, sans-serif; color:#67bd3c; padding-top:18px;"><span style="color:#3b3b3b;">Call Us :</span> '.$this->config->item("mobile").'</td>
			  </tr>
			</table>
			<!--  Call Part End-->
						 
						 </td>
					   </tr>
					 </table></td>
					</tr>
				</table></td>
				</tr>
			</table>
			
			<!--  Banner Part Start-->
			<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top">&nbsp;</td>
				</tr>
			  <tr>
				<td align="left" valign="top">
				
				<!--  Banner Text Start-->
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$data["adminEmail"]['firstname'].',</strong><br />
							<br /><p>
						  	A list of candidates assigned to you.
						  </p>
						  <p>Thank You ! <br>
						  CRM</p></td>
						</tr>
					  </table></td>
				  </tr>
				  </table>
				<!--  Banner Text End-->
				
				</td>
			  </tr>
			</table>
			
			<!--  Banner Part End-->
			
			<!--  Header Part End-->
			
			
					  
					  </td>
				  </tr>
				  
				  <tr>
					<td align="left" valign="top">
					<!--  Footer Part Start-->
					<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
					  
					  
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
					 <p style="text-align:center; font-weight:bold;">5 stripes - your custom mixed organic cereals.</p><br />
			
			<br />
			<center>
			'.$this->config->item("address").'</center></p></td>
					  </tr>
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
						
						<!--  Social Media Part Start-->
						<table width="102" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$fb.'" width="27" height="28" alt="" /></a></td>
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$twtr.'" width="27" height="28" alt="" /></a></td>
					 
			
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$lkdn.'" width="27" height="28" alt="" /></a></td>
				
						  </tr>
						</table>
						<!--  Social Media Part End-->
						
						</td>
					  </tr>
					</table>
					<!--  Footer Part End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Main Table End-->
				
				</td>
			  </tr>
			</table>
			</body>
			
			</html>
		';
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
		$this->load->model('contactmodel');
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
			$this->db->update('pms_contact',$data);
		}		
		echo '1';
		exit;
	}
}
?>
