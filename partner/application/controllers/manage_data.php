<?php 
class Manage_data extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		//~ $this->load->model('coursemodel');
		$this->load->model('manage_data_model');
		
		
		
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');

	}
	
	function index()
	{
		$this->load->library('pagination');
		$searchterm='';
		$rows='';
		$this->load->model('manage_data_model');
		// paging starts here
		//~ $this->data['total_rows']= $this->manage_data_model->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$this->data['cur_page']=$this->router->class;
		$this->load->model('manage_data_model'); 
		$this->data['page_head']= 'Manage Data';		
		$config['base_url'] = base_url().'manage_data/?';	
		
		
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
			'lead_source' => '',
			'reg_status' => '',
			'level_study' => '',
			'intake' => '',
			'cur_level_study' => '',
			'cur_course_id' => '',
			'job_id'=>''
		);
		if($this->input->get('job_id')!='')
		{
			$this->data['formdata']['job_id']=$this->input->get('job_id');
		}
		
		
		$this->data["edu_course_list"] = array('' => 'Select Course');
		$this->data["branch_list"] = $this->manage_data_model->branch_list();
		$this->data["level_list"] = $this->manage_data_model->fill_levels();
		
		
		
		//~ $this->data['candidate_id'] = $id;

		$this->data['education']=array(
				'level_id'=> $this->input->post('level_id'),
				'course_id' => $this->input->post('course_id'),
				'spcl_id'=> $this->input->post('spcl_id'),
				'univ_id' => $this->input->post('univ_id'),
				'edu_year' => $this->input->post('edu_year'),
				'course_type_id' => $this->input->post('course_type_id'),
				'arrears' => '',
				'absesnse'  => '',
				'repeat'  => '',
				'year_back'  => '',
				'mark_percentage'  => '',
				'grade'  => ''			
				);
				
		$this->data["country_list"] 	= $this->manage_data_model->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->manage_data_model->edu_level_list();
		$this->data["edu_years_list"] = $this->manage_data_model->edu_years_list();
		
		$this->data["edu_course_list"] = array('' => 'Select Course');
		$this->data["edu_spec_list"] = $this->manage_data_model->edu_spec_list();
		$this->data["edu_univ_list"] = $this->manage_data_model->edu_univ_list();
		$this->data["edu_course_type_list"] = $this->manage_data_model->edu_course_type_list();
		//~ $this->load->view('signup/addeducationdetail',$this->data);

		$this->data['formdata_passport']=array(
				'passport_nationality' => '',
				'languages_known' => '',
				'eng_10th' => '',
				'eng_12th' =>'',
				'languages_known' => ''
		);
				
		$this->data["visatype_list"] = $this->manage_data_model->visatype_list();
		$this->data["country_list"] = $this->manage_data_model->country_list();
		
		$qry1="select * from pms_candidate_survey_questions";
		
		$ques=$this->db->query($qry1);
		if(isset($ques) && !empty($ques)){$this->data["quest"]=$ques->result();}
		
		
		$queslist=$ques->result();

				foreach($queslist as $queslist)
				{
					$id=$queslist->question_id;

					$mydata[$id] = $this->manage_data_model->getanswersbyid($id);
				}
		if(isset($mydata) && !empty($mydata)){$this->data['answers1']=$mydata;}
	
		
		$this->data['skillset']=$this->manage_data_model->get_skills();
		$this->data['parentskill']=$this->manage_data_model->get_parent_skills();
		
		$this->data['cerifications']=$this->manage_data_model->get_cert();
		
		
		$this->data['formdata_job']=array(
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
		$this->data["industry_list"] = $this->manage_data_model->industry_list();
		$this->data["functional_list"] = $this->manage_data_model->functional_list();
		$this->data["currecy_list"] = $this->manage_data_model->currency_list();
		$this->data["years_list"] = $this->manage_data_model->years_list();
		$this->data["months_list"] = $this->manage_data_model->months_list();
		
		
		
		$this->data["country_list"] 	= $this->manage_data_model->country_list_by_state_city_location();
		$this->data["state_list"] 		= array(''=>'Select State'); //$this->statemodel->state_list();
		$this->data["city_list"] 		= array(''=>'Select City'); //$this->citymodel->city_list();	
        $this->data["location_list"] 	= array(''=>'Select Location');//$this->locationmodel->location_list();
		$this->data["religion_list"]    = $this->manage_data_model->religion_list();

		$this->data['formdata_contact']=array(
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
		
		
		$this->load->view('include/header');
		$this->load->view('manage_data/list',$this->data);				
		$this->load->view('include/footer');
	}	

	public function getcourses()
	{
		if(isset($_POST['level_study']) && $_POST['level_study']!='' && isset($_POST['int_val']) && $_POST['int_val']!='')
		{
			$data=array();
			$data["course_list"] = $this->manage_data_model->get_course_list($_POST['level_study'],$_POST['int_val']);
			$data = array('success' => true, 'course_list' => $data["course_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	
	
	function addEducationDetail($candidateId)
	{

		$id  = $this->manage_data_model->insert_education_detail($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1","id"=>$candidateId);
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0","id"=>"");
            echo json_encode($status);
        }	
	}
	
	
	public function getstate()
	{
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->manage_data_model->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
		public function getcity()
	{
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->manage_data_model->city_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getlocation()
	{
		if(isset($_POST['city_id']) && $_POST['city_id']!='')
		{
			$data=array();
			$data["location_list"] = $this->manage_data_model->location_list($_POST['city_id']);
			$data = array('success' => true, 'location_list' => $data["location_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	
	
	
	function child_skill()
	{
		 $id=$this->input->get('id');
		//~ $id=1;
		$this->data['skillset']=$this->manage_data_model->get_child_skills($id);
		echo json_encode($this->data);
	}
	
	
	
	
	public function addCandidate()
	{
	
		date_default_timezone_set("Asia/Kolkata");
		$data = array('success' => 'false', 'username' => 'false', 'mobile' => 'false' , 'id' => '');
		if($this->input->post('username')!='' && $this->input->post('mobile')!='')
		{
			$this->db->where('username', $this->input->post('username'));
			$query = $this->db->get('pms_candidate');
			if ($query->num_rows() == 0)
			{
				$this->db->where('mobile', $this->input->post('mobile'));
				$query = $this->db->get('pms_candidate');
				if ($query->num_rows() == 0)
				{
					
				$age='';
	 			if($this->input->post('date_of_birth')!='' & $age=='') $age = floor((time() - strtotime($this->input->post('date_of_birth'))) / 31556926);
	 			$password=$this->input->post('pass');
				
				$data =array(
				'username'=> $this->input->post('username'),
				'password'=> md5($password),
				'first_name' => $this->input->post('first_name'),
				'reg_date' => date("Y-m-d H:i:s"),
				'title' => $this->input->post('title'),
				'gender' => $this->input->post('gender') ,
				'mobile' => $this->input->post('mobile'),		
				'date_of_birth' => $this->input->post('date_of_birth'),
				'age' => $age,
				'lead_source' => 'Website',
				'reg_status' => 1
			);
		// save to contacts
		
			$id = $this->manage_data_model->insert_candidate_record($data);			
			//~ $id=22;
			if ($id != '')
			{
				$this->db->where('candidate_id',$id);
				$res=$this->db->get('pms_candidate');
				$val=$res->row();
				$dt=array(
				'job_id'=>$this->input->post('job_id'),
				'candidate_id'=>$id,
				'applied_on'=>$val->reg_date
				);
				$this->db->insert('pms_job_apps',$dt);
				 
				 $_SESSION['candidate_session']=$id;
				 $_SESSION['username']=$val->username;
				$data = array('success' => 'true', 'mobile' => 'true',  'username' => 'true', 'id' => $id);			
			}
		}else
				{
					$data = array('success' => 'false', 'username' => 'true', 'mobile' => 'false' , 'id' => '');
					echo json_encode($data);
					exit();
				}
			}else{
				$data = array('success' => 'false', 'username' => 'false', 'mobile' => 'false' , 'id' => '');
				echo json_encode($data);
				exit();
			}
					echo json_encode($data);
				exit();	
		}
		else
		{
			echo json_encode($data);
			exit();
		}
	}
	
	
	
	function addPassportDetail($candidateId){
		
		$uid = $this->manage_data_model->update_passport_detail($candidateId);
		$status = array("STATUS" => "1");
		echo json_encode($status);
	}
	
	
	
	
	function addQuestionnaire($candidateId)
	{
		$this->table_name='pms_candidate';
		$this->load->library('upload');		
		$candidate_id = $this->input->post('candidate_id');	

		$survey_array=array();
		foreach($_POST as $key => $val)
		{
			if($key!='candidate_id' && $key!='cv_file' && $key!='photo')
			{
				$key=str_replace('qt_','',$key);
				if($key == '1'){
					if($this->input->post('date_1'))
					{
						$date = $this->input->post('date_1');
						$survey_array[]=array('candidate_id' => $candidate_id, 'answer_id' => $val,'extras' => $date);
					}
					else $survey_array[]=array('candidate_id' => $candidate_id, 'answer_id' => $val);
				}
				else $survey_array[]=array('candidate_id' => $candidate_id, 'answer_id' => $val);
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
		$status = array("STATUS" => "1");
		echo json_encode($status);
	}
	
	function addSkillDetail($candidateId)
	{
	 $id  = $this->manage_data_model->insert_skill_details($candidateId);
		
		
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	function addcertificationDetail($candidateId)
	{
	 $id  = $this->manage_data_model->insert_cert_details($candidateId);
		
		
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	
	function addJobDetail($candidateId)
	{
		$id  = $this->manage_data_model->insert_job_detail($candidateId);
		$uid = $this->manage_data_model->update_job_detail($candidateId);
        if ($id > 0) { //success
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
	
	function addCandidateDetail($candidateId)
	{
		$id  = $this->manage_data_model->insert_contact_detail($candidateId);
		$uid = $this->manage_data_model->update_contact_detail($candidateId);
        if ($id > 0) { //success
			// send emails
            $status = array("STATUS" => "1");
            echo json_encode($status);
        } else { //failure
            $status = array("STATUS" => "0");
            echo json_encode($status);
        }	
	}
	
		function addfiles(){

		$this->table_name='pms_candidate';
		$this->load->library('upload');		
		$candidate_id = $this->input->post('candidate_id');	
	
		if($this->input->post('candidate_id')!=''){
			if(isset($_FILES['cv_file'])){
				if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
				{  
					$config['upload_path'] = './assets/userimages/';
					$config['allowed_types'] = 'doc|docx|pdf|txt';
					$config['max_size']	= '0';
					$config['file_name'] = md5(uniqid(mt_rand()));
					$this->upload->initialize($config);	
		
					if ($this->upload->do_upload('cv_file'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update ".$this->table_name." set cv_file='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					}
					
				}
			}
		
			if(isset($_FILES['photo'])){	
				if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
				{         
				
					$photo['upload_path'] = './assets/userimages/';
					$photo['allowed_types'] = 'png|jpg|jpeg|gif';
					$photo['max_size']	= '0';
					$photo['file_name'] = md5(uniqid(mt_rand()));
				
					$this->upload->initialize($photo);
					if ($this->upload->do_upload('photo'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update ".$this->table_name." set photo='".$this->upload_file_name."' where candidate_id=".$candidate_id);
					}
					
				}
			}	
		}		
		
		redirect('manage_data',"refresh");	
	}
	
	
	
	
	

	
 
		

}
?>
