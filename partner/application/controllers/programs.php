<?php 
class Programs extends CI_Controller {

	function Programs()
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
		$this->data['reg_status']=$_SESSION['reg_status'];

		$this->data['rows']='';
		$this->load->model('candidatemodel');
		

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
		
		if($this->input->post("reg_status")!='')
		{
			$this->data['reg_status']=$this->input->post("reg_status");
			$_SESSION['reg_status']=$this->input->post("reg_status");
		}		
		
		$this->data['total_rows']= $this->candidatemodel->record_count($this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['reg_status'],$this->data['branch_id']);
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."candidates/?sort_by=".$this->data['sort_by']."&limit=".$this->data['limit']."&search_name=".$this->data['search_name']."&search_email=".$this->data['search_email']."&search_mobile=".$this->data['search_mobile']."&"."lreg_status=".$this->data['reg_status']."&branch_id=".$this->data['branch_id'];
		
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
	
		$this->data["records"] = $this->candidatemodel->get_list($this->data['start'],$this->data['limit'],$this->data['search_email'],$this->data['search_name'],$this->data['search_mobile'],$this->data['sort_by'],$this->data['reg_status'],$this->data['branch_id']);

		$this->load->model('candidatemodel'); 
		
		$this->data['page_head']= 'Manage Candidates';		
		$this->data['formdata']=array('admin_id' =>'');
		$this->data['admin_users_lists']= $this->candidatemodel->get_admin_users_lists();
		$this->data["branch_list"] = $this->candidatemodel->branch_list();

		$this->load->view('include/header',$this->data);
		$this->load->view('candidates/candidateslist',$this->data);				
		$this->load->view('include/footer',$this->data);
	
	}
		
	function add()
	{	
		$this->load->model('candidatemodel');
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
			'reg_status' => '0',
			'branch_id' => '',
			'level_study' => '',
		);
		
		$this->data["edu_course_list"] = $this->candidatemodel->edu_course_list();
		$this->data["level_list"] = $this->coursemodel->fill_levels();
		$this->data["branch_list"] = $this->candidatemodel->branch_list();

		$this->data['page_head']= 'Add Candidate';
		$this->load->view('include/header',$this->data);
		$this->load->view('candidates/addcandidates',$this->data);	
		$this->load->view('include/footer',$this->data);
	}
	
	function addCandidate(){
		$this->load->model('candidatemodel');
		
		$this->form_validation->set_rules("first_name","Candidate Name","required");
		$this->form_validation->set_rules('check_dups', 'Email Address', 'callback_check_dups');

		if ($this->form_validation->run() == TRUE)
		{ 
			$id = $this->candidatemodel->insert_candidate_record();
			if ($id != '') { //success
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
		$this->load->model('candidatemodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["state_list"] 		= array(''=>'Select State'); //$this->statemodel->state_list();
		$this->data["city_list"] 		= array(''=>'Select City'); //$this->citymodel->city_list();	
        $this->data["location_list"] 	= array(''=>'Select Location');//$this->locationmodel->location_list();
		$this->data["religion_list"]    = $this->candidatemodel->religion_list();

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
        $this->load->view('candidates/addcontactdetail', $this->data);
    }
	
	function skip_step2($candidateId){
		$this->load->model('candidatemodel');
		//$this->candidatemodel->insert_contact_detail_skip($candidateId);		
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}

	function step_back($candidateId){
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
		
	function addCandidateDetail($candidateId){
		$this->load->model('candidatemodel');
		$id  = $this->candidatemodel->insert_contact_detail($candidateId);
		$uid = $this->candidatemodel->update_contact_detail($candidateId);
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
		$this->load->model('candidatemodel');
		$this->load->model('visatypemodel');
		$this->data["formdata"]=$this->candidatemodel->get_passport_details($id);
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidatemodel->country_list();
		$this->load->view('candidates/addpassportdetail', $this->data);
	}
	
	function skip_step3($candidateId){
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function addPassportDetail($candidateId){
		$this->load->model('candidatemodel');
		$uid = $this->candidatemodel->update_passport_detail($candidateId);
		$status = array("STATUS" => "1");
		echo json_encode($status);
	}
	
	function loadEducationhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatemodel');
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
		$this->data["edu_level_list"] = $this->candidatemodel->edu_level_list();
		$this->data["edu_years_list"] = $this->candidatemodel->edu_years_list();
		$this->data["edu_course_list"] = $this->candidatemodel->edu_course_list();
		$this->data["edu_spec_list"] = $this->candidatemodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidatemodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidatemodel->edu_course_type_list();
		$this->load->view('candidates/addeducationdetail',$this->data);
	}
	
	function skip_step4($candidateId){
		$this->load->model('candidatemodel');
		//$this->candidatemodel->insert_education_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function addEducationDetail($candidateId){
		$this->load->model('candidatemodel');
		$id  = $this->candidatemodel->insert_education_detail($candidateId);
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
		$this->load->model('candidatemodel');
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
		$this->data["industry_list"] = $this->candidatemodel->industry_list();
		$this->data["functional_list"] = $this->candidatemodel->functional_list();
		$this->data["currecy_list"] = $this->candidatemodel->currency_list();
		$this->data["years_list"] = $this->candidatemodel->years_list();
		$this->data["months_list"] = $this->candidatemodel->months_list();
		$this->load->view('candidates/addjobdetail', $this->data);
	}
	
	function skip_step5($candidateId){
		$this->load->model('candidatemodel');
		//$this->candidatemodel->insert_job_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	function skip_step1($candidateId){
		$this->load->model('candidatemodel');
		//$this->candidatemodel->insert_job_detail_skip($candidateId);
		$status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}	
	function addJobDetail($candidateId){
		$this->load->model('candidatemodel');
		$id  = $this->candidatemodel->insert_job_detail($candidateId);
		$uid = $this->candidatemodel->update_job_detail($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	

	}
	
	function loadFilehtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatemodel');
		$this->load->view('candidates/addfiledetail', $this->data);
	}

	// upload files from summary page.
	function upload_cv_photo($candidate_id)
	{
		$this->table_name='pms_candidate';
		$this->load->model('candidatemodel');
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
						$this->candidatemodel->insert_files($dataArr);
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
						$this->candidatemodel->insert_files($dataArr);
					}
				}
			}	
			redirect('candidates/summary/'.$this->input->post('candidate_id'));
		}else
		{
			redirect('candidates');
		}		
	}
	
	// add files
	function addfiles(){
		$this->table_name='pms_candidate';
		$this->load->model('candidatemodel');
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
					$this->candidatemodel->insert_files($dataArr);
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
					$this->candidatemodel->insert_files($dataArr);
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
		$this->load->model('candidatemodel');  
		$this->load->model('coursemodel');  
		$this->data["formdata"] = $this->candidatemodel->get_single_record($id);
		$this->data['level_list']=$this->coursemodel->fill_levels();
		
		if(isset($this->data["formdata"]['level_study']) && $this->data["formdata"]['level_study']!='')
			$this->data["edu_course_list"] = $this->candidatemodel->edit_course_list($this->data["formdata"]['level_study']);
		else
			$this->data["edu_course_list"] = array('' => 'Select Course');
			
		$this->data["branch_list"] = $this->candidatemodel->branch_list();
		$this->load->view('include/header',$this->data);
		$this->load->view('candidates/editcandidates',$this->data);	
		$this->load->view('include/footer',$this->data);
	}
	
	function editCandidate(){
		$candidateId = $this->input->post('candidateId');
		$this->load->model('candidatemodel');
        $this->candidatemodel->update_candidate_record($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditContacthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatemodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');
		$this->data["religion_list"]    = $this->candidatemodel->religion_list();
		
		
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
		
		$this->data["formdata3"] = $this->candidatemodel->get_address_single_record($id);
		if(count($this->data["formdata3"])<1)
		{
			$this->data["formdata3"]['address']='';
			$this->data["formdata3"]['land_phone']='';
			$this->data["formdata3"]['workphone']='';
			$this->data["formdata3"]['fax']='';
			$this->data["formdata3"]['zipcode']='';
		}
		$this->data['formdata'] = array_merge($this->data['formdata'],$this->data['formdata2'],$this->data["formdata3"]);
        $this->load->view('candidates/editcontactdetail', $this->data);

	}
	
	function editCandidateDetail($candidateId){
		$this->load->model('candidatemodel');
        $this->candidatemodel->edit_contact_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}
	
	function loadEditPassporthtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatemodel');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidatemodel->country_list();
		$this->data["formdata"] = $this->candidatemodel->get_passport_single_record($id);
		$this->load->view('candidates/editpassportdetail', $this->data);
	}
	
	function editPassportDetail($candidateId)
	{
		$this->load->model('candidatemodel');
        $this->candidatemodel->edit_passport_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditEducationhtml($id)
	{
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatemodel');
		$this->load->model('countrymodel');
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->candidatemodel->edu_level_list();
		$this->data["edu_years_list"] = $this->candidatemodel->edu_years_list();
		$this->data["edu_course_list"] = $this->candidatemodel->edu_course_list();

		$this->data["edu_spec_list"] = $this->candidatemodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidatemodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidatemodel->edu_course_type_list();
		$this->data["formdata"] = $this->candidatemodel->get_education_single_record($id);
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
		$this->load->view('candidates/editeducationdetail',$this->data);
	}
	
	function editEducationDetail($candidateId)
	{
		$this->load->model('candidatemodel');
        $this->candidatemodel->edit_education_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);
	}
	
	function loadEditJobhtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatemodel');
		$this->data["industry_list"] = $this->candidatemodel->industry_list();
		$this->data["functional_list"] = $this->candidatemodel->functional_list();
		$this->data["currecy_list"] = $this->candidatemodel->currency_list();
		$this->data["years_list"] = $this->candidatemodel->years_list();
		$this->data["months_list"] = $this->candidatemodel->months_list();
		$this->data["formdata"] = $this->candidatemodel->get_job_single_record($id);
		
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
		
		$this->load->view('candidates/editjobdetail', $this->data);
	}
	
	function editJobDetail($candidateId){
		$this->load->model('candidatemodel');
        $this->candidatemodel->edit_job_detail($candidateId);
        $status = array("STATUS" => "1", "SUCCESS_ID" => $candidateId);
        echo json_encode($status);

	}

		
	function loadEditFilehtml($id){
		$this->data['candidate_id'] = $id;
		$this->load->model('candidatemodel');
		$this->data['survey_result']=$this->candidatemodel->get_survey_result($id);
		$this->data["formdata"] = $this->candidatemodel->get_file_single_record($id);	

		$this->load->view('candidates/editfiledetail', $this->data);
	}

	// edit files
	function editfiles(){
		$this->table_name='pms_candidate';
		$this->load->model('candidatemodel');
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
			$this->load->view('candidates/import_csv',$this->data);                
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

            for($i=0;$i<count($contacts);$i++){
                $data = $contacts[$i];
			    $this->load->model('candidatemodel');
                $this->candidatemodel->insert_csv_records($data);
            }
			    redirect('candidates/?csv=1');
        }  
		      
    }

	//Candidate View
	function candidate_view($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		$this->load->model('coursemodel');
		
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);

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
			   redirect('candidates/candidate_view/'.$this->input->post('candidate_id'));
		}
						
		$this->data['list']=$this->candidatemodel->follow_record($candidate_id);
		$this->data['note_list']=$this->candidatemodel->notes_record($candidate_id);		
		$this->data['coe_list']=$this->candidatemodel->coe_list($candidate_id);
		$this->data['visa_approval_list']=$this->candidatemodel->visa_approval_list($candidate_id);

		$this->data['interview_list']=$this->candidatemodel->interview_record($candidate_id);
		$this->data['aplication_list']=$this->candidatemodel->aplication_record($candidate_id);
		
		$this->data['interview_status_list']=$this->candidatemodel->interview_status_list();		
		$this->data['app_list']=$this->candidatemodel->aplication_list($candidate_id);
		$this->data['app_list_coe']=$this->candidatemodel->select_aplication_coe($candidate_id);
		$this->data['admin_user_list']=$this->candidatemodel->admin_user_list();
		$this->data['interview_type_list']=$this->candidatemodel->interview_type_list();
		$this->data['university_list']=$this->candidatemodel->university_list();
		$this->data['campus_list']=array('' => 'Select Campus');
		$this->data['intake_list']=$this->candidatemodel->intake_list();
		$this->data['course_list']=array('' => 'Select Course');;
		$this->data['level_list']=$this->coursemodel->fill_levels();
		$this->data['status_list']=$this->candidatemodel->status_list();

		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates/candidate_view",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function candidate_program($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);

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
			   redirect('candidates/candidate_view/'.$this->input->post('candidate_id'));
		}
						
		$this->data['aplication_list']=$this->candidatemodel->aplication_record($candidate_id);
		
		$this->data['interview_status_list']=$this->candidatemodel->interview_status_list();		
		$this->data['app_list']=$this->candidatemodel->aplication_list($candidate_id);
		$this->data['app_list_coe']=$this->candidatemodel->select_aplication_coe($candidate_id);
		$this->data['admin_user_list']=$this->candidatemodel->admin_user_list();
		$this->data['university_list']=$this->candidatemodel->university_list();
		$this->data['campus_list']=array();
		$this->data['intake_list']=$this->candidatemodel->intake_list();
		$this->data['course_list']=$this->candidatemodel->course_list();
		$this->data['status_list']=$this->candidatemodel->status_list();

		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates/candidate_program",$this->data);
		$this->load->view("include/footer",$this->data);
	}


	// Manage CV Email & SMS
	function email_sms($candidate_id)
	{

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);

			$this->data['email_sms_list']=$this->candidatemodel->email_sms_list($candidate_id);
		
			if($this->input->post('send_type')!='')
			{
				$data=array(
				'candidate_id'   => $this->input->post('candidate_id'),
				'date_sent'      => date('Y-m-d H:i:s'),
				'subject'        => $this->input->post('subject'),
				'email_text'      => $this->input->post('email_text'),
				'sms_text'      => $this->input->post('sms_text'),
				'user_id'      => $_SESSION['vendor_session'],
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
				redirect('candidates/email_sms/'.$candidate_id);
			}
			
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			$this->data['error']="Fill subject and email content to send to the candidate.";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_email_sms",$this->data);
			$this->load->view("include/footer",$this->data);
	}

	// Manage CV Email & SMS
	function tickets($candidate_id)
	{

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);

			$this->data['ticket_list']=$this->candidatemodel->ticket_list($candidate_id);
		
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
				redirect('candidates/tickets/'.$candidate_id);
			}
			
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			$this->data['error']="Fill appropriate details and send to candidates.";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_complaints",$this->data);
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
		$this->load->model('candidatemodel');
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);
		$this->data['education_details'] = $this->candidatemodel->education_deatils($candidate_id);
		$this->data['job_history'] = $this->candidatemodel->job_list($candidate_id);
		$this->data['all_counselor'] = $this->candidatemodel->all_counselor($candidate_id);
		$this->data['candidate_counselor'] = $this->candidatemodel->candidate_counselor($candidate_id);
		$this->data['candidate_skills'] = $this->candidatemodel->candidate_skills($candidate_id);
		$this->data['candidate_certifications'] = $this->candidatemodel->candidate_certifications($candidate_id);
	
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
			
			redirect('candidates/summary/'.$candidate_id);
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_summary",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_summary",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Summary & Reports
	function invoice($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);
		$this->data['education_details'] = $this->candidatemodel->education_deatils($candidate_id);
		$this->data['job_history'] = $this->candidatemodel->job_list($candidate_id);
		$this->data['all_counselor'] = $this->candidatemodel->all_counselor($candidate_id);
		$this->data['candidate_counselor'] = $this->candidatemodel->candidate_counselor($candidate_id);

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
			
			redirect('candidates/summary/'.$candidate_id);
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_summary",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_invoice",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

		
	// Manage CV File
	function cvfile($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->candidatemodel->cvfile_list($candidate_id);
		
		if($this->input->post('cvfile')!=''){
			$data=array(
			'candidate_id'   =>$this->input->post('candidate_id'),
			'cv_file'        =>$this->input->post('cvfile'),
			);
			
			$this->db->insert('pms_candidate_cvfile',$data);
			$id=$this->db->insert_id();
			
			redirect('candidates/cvfile/'.$candidate_id);
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_cvfile",$this->data);
			$this->load->view("include/footer",$this->data);
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
				$this->editor($path, $width,$height);
			$this->data['error']="Copy & Paste Candidate Info Here, this can be multiple copy & paste.";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_cvfile",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Job History
	function job_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');


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
		$this->data["industry_list"] = $this->candidatemodel->industry_list();
		$this->data["functional_list"] = $this->candidatemodel->functional_list();
		$this->data["currecy_list"] = $this->candidatemodel->currency_list();
		$this->data["years_list"] = $this->candidatemodel->years_list();
		$this->data["months_list"] = $this->candidatemodel->months_list();

		
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidatemodel->job_list($candidate_id);

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
			redirect('candidates/job_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new job history";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_job_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

	// Manage Education History
	function edu_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');

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
		$this->data["edu_level_list"]   = $this->candidatemodel->edu_level_list();
		$this->data["edu_years_list"]   = $this->candidatemodel->edu_years_list();
		//$this->data["edu_course_list"]  = $this->candidatemodel->edu_course_list();
		
		$this->data["edu_course_list"]  = array('' => 'Select Course');

		$this->data["edu_spec_list"] = $this->candidatemodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->candidatemodel->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->candidatemodel->edu_course_type_list();

		//data for left panel
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);
		
		$this->data['cv_fileist']=$this->candidatemodel->education_list($candidate_id);
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
			redirect('candidates/edu_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please add new education details";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_edu_history",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}
	
	// Manage Lang History
	function lang_history($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		$this->load->model('visatypemodel');
		$this->data["visatype_list"] = $this->visatypemodel->visatype_list();
		$this->data["country_list"] = $this->candidatemodel->country_list();
		$this->data["formdata"] = $this->candidatemodel->get_passport_single_record($candidate_id);
		
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
		$this->data["industry_list"] = $this->candidatemodel->industry_list();
		$this->data["functional_list"] = $this->candidatemodel->functional_list();
		$this->data["currecy_list"] = $this->candidatemodel->currency_list();
		$this->data["years_list"] = $this->candidatemodel->years_list();
		$this->data["months_list"] = $this->candidatemodel->months_list();

		
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);


		$this->data['cv_fileist']=$this->candidatemodel->job_list($candidate_id);
		
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
			   $this->db->update('pms_candidate', $data);
			   redirect('candidates/lang_history/'.$this->input->post('candidate_id'));
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_lang_history",$this->data);
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
		$this->load->model('candidatemodel');
		$this->data['survey_result']=$this->candidatemodel->get_survey_result($candidate_id);
		
		$this->data['cv_file']='';
		$this->data['photo_file']='';
		
		$cv_file=0;
		$photo_file=0;
		if($this->input->get('cv_file')==1)$this->data['cv_file']='CV Uploaded Successfully, please view it from summary page.';
		if($this->input->get('photo_file')==1)$this->data['photo_file']='Photo Uploaded Successfully, please view it from summary page.';
		
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);

		$this->data['cv_fileist']=$this->candidatemodel->job_list($candidate_id);
		
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
							$this->candidatemodel->insert_files($dataArr);
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
							$this->candidatemodel->insert_files($dataArr);
							$photo_file=1;
						}
					}
				}
			   redirect('candidates/questionnaire/'.$this->input->post('candidate_id').'?cv_file='.$cv_file.'&photo_file='.$photo_file);
		}else{
			$path = '../js/ckfinder';
			$width = '700px';
			$height = '900px';
			$this->editor($path, $width,$height);
			
			$this->data['error']="Please update language skills here";
			$this->load->view("include/header",$this->data);
			$this->load->view("candidates/candidate_questionnaire",$this->data);
			$this->load->view("include/footer",$this->data);
		}	
	}

// tech skills

function skills($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		
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
			   redirect('candidates/skills/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['skill_list']=$this->candidatemodel->get_skill_set();
		$this->data['skill_list_current']=$this->candidatemodel->get_skill_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->candidatemodel->job_list($candidate_id);
				
		$path = '../js/ckfinder';
		$width = '700px';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates/candidate_skills",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
// certifications

function certifications($candidate_id)
	{
		$this->data['cur_page']=$this->router->class;
	    $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		
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
			   redirect('candidates/certifications/'.$this->input->post('candidate_id').'?upd=1');
		}

		$this->data['certifications_list']=$this->candidatemodel->get_certifications_set();
		$this->data['certifications_list_current']=$this->candidatemodel->get_certifications_set_candidate($candidate_id);
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);
		$this->data['cv_fileist']=$this->candidatemodel->job_list($candidate_id);
		
		$path = '../js/ckfinder';
		$width = '700px';
		$height = '900px';
		$this->editor($path, $width,$height);
		
		$this->data['error']="Please update skills here";
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates/candidate_certifications",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	// Follow up
	function followup()
	{
		$this->load->model('candidatemodel');
		if(isset($_POST['candidate_id']))
		{
			//date_default_timezone_set("Asia/Kolkata"); 
			
			$data=array(
			'candidate_id'   =>$_POST['candidate_id'],
			'title'          =>$_POST['title'],
			'status_id'      =>$_POST['status_id'],
			'app_id'         =>$_POST['app_id'],
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
					'task_title'   =>$_POST['title'].' - On- '.$_POST['flp_date_reminder'].' - '.$_POST['flp_time_reminder'],
					'start_date'   => date('Y-m-d'),
					'due_date'     =>$_POST['flp_date_reminder'],
					'task_desc'    =>$_POST['desc'],
					'admin_id'     => $_POST['assigned_to']
				);
				
				$query_task=$this->db->insert('pms_tasks',$data);
				
				// insert into todo list
				$data=array(
					'start_date'   => date('Y-m-d'),
					'end_date'     =>$_POST['flp_date_reminder'],
					'start_time'    =>$_POST['flp_time_reminder'],
					'assigned_to'     => $_POST['assigned_to'],
					'created_by'     => $_SESSION['vendor_session']
				);
				$query_task=$this->db->insert('pms_todo',$data);
				$todo_id=$this->db->insert_id();
					$data=array(
					'title'   =>$_POST['title'].' - On- '.$_POST['flp_date_reminder'].' - '.$_POST['flp_time_reminder'],
					'todo_id'   => $todo_id,
					'description'     =>$_POST['desc'],
				);
				$query_task=$this->db->insert('pms_todo_description',$data);				
			}
			
			
			$this->data['single_list']=$this->candidatemodel->select_record($id);
		
			$dataArr = $this->load->view('candidates/candidatefollowup_list', $this->data,TRUE);
			echo $dataArr;
			exit();
			
				$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
				$row = $query->row_array();
				$subject = 'Follow-up';
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
									<h3>Followup Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['single_list']['title'].'</h3>
									<h3>Followup Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['single_list']['status_name'].'</h3>
		<h3>Followup Application:&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['single_list']['app_details'].'</h3>
		<h3>Followup Description:&nbsp;&nbsp;&nbsp;&nbsp;'. $this->data['single_list']['description'].'</h3>
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
	$this->load->model('candidatemodel');
	$this->data['note_list']=$this->candidatemodel->select_notes_record($id);
	$dataArr = $this->load->view('candidates/candidatenotes_list', $this->data,TRUE);
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
	$this->db->insert('pms_candidate_interviews',$data);
	$id=$this->db->insert_id();
	$this->load->model('candidatemodel');
	$this->data['interview_list']=$this->candidatemodel->select_interview_record($id);
	$dataArr = $this->load->view('candidates/candidateinterview_list', $this->data,TRUE);
	echo $dataArr;
	
	$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
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

	// Create an application	
	function aplication(){
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
		$this->load->model('candidatemodel');
		$this->data['aplication_list']=$this->candidatemodel->select_aplication_record($id);
		$dataArr = $this->load->view('candidates/candidate_aplication_list', $this->data,TRUE);
		echo $dataArr;
		exit();	
		$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
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
		$this->load->model('candidatemodel');
		$this->data['aplication_list']=$this->candidatemodel->select_aplication_coe($id);
		$dataArr = $this->load->view('candidates/candidate_aplication_list', $this->data,TRUE);
		echo $dataArr;
		exit();	
		$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
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

		$this->load->model('candidatemodel');

		$data=array(
		'process_status_id'           =>$_POST['process_status_id'],
		'coe_title'           =>$_POST['coe_title'],
		'student_id'         =>$_POST['student_id'],
		'course_code'   =>$_POST['course_code'],		
		'annual_tution_fee'   =>$_POST['annual_tution_fee'],
		'course_duration'   =>$_POST['course_duration'],
		'course_commencement'   =>$_POST['course_commencement'],
		'orientation_date'   =>$_POST['orientation_date'],
		'start_date'   =>$_POST['start_date'],
		'end_date'   =>$_POST['end_date'],
		'course_details'   =>$_POST['course_details'],	
		'app_status'   => '1',
		);
		
		$this->db->where('candidate_id', $_POST['candidate_id']);
		$this->db->where('app_id', $_POST['cand_app_id']);
		$this->db->update('pms_candidate_applications', $data); 
		
	
		$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
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

	// VISA update on an application
	function create_visa(){

		$this->load->model('candidatemodel');

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
		
		$this->db->insert('pms_candidate_visa_approval', $data); 
		exit();		
	
		$query = $this->db->query("SELECT *  FROM  pms_candidate where candidate_id =".$_POST['candidate_id']);
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
		
		$this->load->model('candidatemodel');
		 $this->candidatemodel->drop_record($candidate_follow_id);
		$dataArr = $this->load->view('candidates/candidate_view');
		echo $dataArr;
	}
	
	function cvfile_drop(){
		$cvfile_id=$_POST['cvfile_id'];
		$this->load->model('candidatemodel');
		$this->candidatemodel->cvfile_drop_record($cvfile_id);		          
	}

	function drop_job_item()
	{
		$job_profile_id=$this->input->post('job_profile_id');
		$this->load->model('candidatemodel');
		$this->candidatemodel->drop_job_item($job_profile_id);
	}

	function drop_email_sms_item()
	{
		$email_sms_id=$this->input->post('email_sms_id');
		$this->load->model('candidatemodel');
		$this->candidatemodel->drop_email_sms_item($email_sms_id);
	}

	function drop_ticket_item()
	{
		$ticket_id=$this->input->post('ticket_id');
		$this->load->model('candidatemodel');
		$this->candidatemodel->drop_ticket_item($ticket_id);
	}
		
	function drop_edu_item(){
		$eucation_id=$this->input->post('eucation_id');
		$this->load->model('candidatemodel');
		$this->candidatemodel->drop_edu_item($eucation_id);
	}	
	
	function drop_notes(){
		 $candidate_note_id=$_POST['candidate_note_id'];
		
		$this->load->model('candidatemodel');
		$this->candidatemodel->note_drop_record($candidate_note_id);
		$dataArr = $this->load->view('candidates/candidate_view');
		echo $dataArr;
		          
	}
	
	
	 function drop_interviews(){
		 $interview_id=$_POST['interview_id'];
		$this->load->model('candidatemodel');
		$this->candidatemodel->interview_drop_record($interview_id);
		$dataArr = $this->load->view('candidates/candidate_view');
		echo $dataArr;
		          
	}
	
	
	 function drop_aplication(){
		 $app_id=$_POST['app_id'];
		$this->load->model('candidatemodel');
		$this->candidatemodel->aplication_drop_record($app_id);
		$dataArr = $this->load->view('candidates/candidate_view');
		echo $dataArr;
		          
	}
	
		
	function candidate_file($candidate_id)
	{
	

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);
	   if($this->input->post('title')!='')
	   {
   	
			 if(isset($_FILES['photo']))
			 {
					if(!$candidate_id='')
					{
						$this->load->model('candidatemodel');
						$id=$this->candidatemodel->insert_file($candidate_id);
						redirect('candidates/candidate_file/'.$this->input->post('candidate_id'));
					}
			}
		}
		$this->data['file_list']=$this->candidatemodel->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates/manage_files",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function csv_data_import($candidate_id)
	{
	

		$this->data['cur_page']=$this->router->class;
	   $this->data['error']='';
		$this->data['candidate_id']=$candidate_id;
		$this->load->model('candidatemodel');
		$this->data['detail_list'] = $this->candidatemodel->detail_list($candidate_id);

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
		$this->data['file_list']=$this->candidatemodel->file_list($candidate_id);
		$this->load->view("include/header",$this->data);
		$this->load->view("candidates/csv_data_import",$this->data);
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
						$this->load->model('candidatemodel');
						$id=$this->candidatemodel->insert_file($candidate_id);
						$this->data['upload_list']=$this->candidatemodel->get_one_record($id);
						$replay=$this->load->view("candidates/upload_file",$this->data,TRUE);
						echo $replay;
					}
					else
					{
						redirect("candidates/candidate_file");
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
						  $this->load->model('candidatemodel');
						   $this->candidatemodel->update_file($candidate_id);
	
							 $this->data['single_file']=$this->candidatemodel->get_one_file($candidate_id);
	
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
		
			          $this->load->model('candidatemodel');
					   $this->candidatemodel->delete_file($id);
					    $this->data['delete_file']=$this->candidatemodel->delete_one_file($id);
						
                           echo $this->data['delete_file']['photo'];  //$replay=$this->load->view("candidates/delete_file",$this->data,TRUE);
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
			redirect("candidates/summary/".$id."?del_cv=1");
		}else
		{
			redirect("candidates/summary/".$id);
		}
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
			redirect("candidates/summary/".$id."?del_photo=1");
		}else
		{
			redirect("candidates/summary/".$id);
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('candidate_id', $id);
			$this->db->delete('pms_candidate'); 
			redirect('candidates/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('candidate_id', $val);
					$this->db->delete('pms_candidate'); 
				}
			redirect('candidates/?del=1');
		}
	}
	function multidelete(){

		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
			$this->load->model('candidatemodel');
			$this->candidatemodel->delete_multiple_record($id_arr);
			redirect('candidates/?multi=1');
		}
		else{
			redirect('candidates');
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
		if(isset($_POST['level_study']) && $_POST['level_study']!='')
		{
			$data=array();
			$data["course_list"] = $this->coursemodel->get_course_list($_POST['level_study']);
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
		$this->load->model('candidatemodel');
		$candidatesArr	= $_POST['selectedArr'];
		$adminId		= $_POST['admin_id'];
		for($i=0;$i<count($candidatesArr);$i++){
			$id = $this->candidatemodel->assign_admin_user($candidatesArr[$i],$adminId);
		}
		/***************************** send mail to admin user ***************************/
		$data["adminEmail"] = $this->candidatemodel->getAdminEmail($adminId);
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
		$this->load->model('candidatemodel');
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
}
?>
