<?php 
class Webservices extends CI_Controller {

	function webservices()
	{
		parent::__construct();
		$this->load->model('webservicemodel');
		$this->load->model('locationmodel');
		$this->load->model('statmodel');
		$this->load->model('campusmodel');
	//  Track how mobile app can restrict. 		
	}
	
	function index()
	{	
		if($this->input->get("reg_status")!='')
		{
			$this->data['reg_status']=$this->input->get("reg_status");
			$_SESSION['reg_status']=$this->input->get("reg_status");
		}
		
		if($this->input->post("reg_status")!='')
		{
			$this->data['reg_status']=$this->input->post("reg_status");
			$_SESSION['reg_status']=$this->input->post("reg_status");
		}		
	}

	function get_country()
	{
        $data_list =$this->webservicemodel->country_list();
        echo json_encode($data_list);
	}	

	function get_programs()
	{
        $data_list =$this->webservicemodel->edu_course_list();
        echo json_encode($data_list);
	}

	function get_edu_level()
	{
        $data_list =$this->webservicemodel->edu_level_list();
        echo json_encode($data_list);
	}			

	function get_industry()
	{
        $data_list =$this->webservicemodel->industry_list();
        echo json_encode($data_list);
	}	

	function get_university()
	{
        $data_list =$this->webservicemodel->university_list();
        echo json_encode($data_list);
	}

	function get_course_type()
	{
        $data_list =$this->webservicemodel->edu_course_type_list();
        echo json_encode($data_list);
	}	

	function get_function_area()
	{
        $data_list =$this->webservicemodel->functional_list();
        echo json_encode($data_list);
	}	

	function get_branches()
	{
        $data_list =$this->webservicemodel->branch_list();
        echo json_encode($data_list);
	}		

	function get_education_year()
	{
        $data_list =$this->webservicemodel->edu_years_list();
        echo json_encode($data_list);
	}

	function get_years_list()
	{
        $data_list =$this->webservicemodel->years_list();
        echo json_encode($data_list);
	}
function get_messages_list()
	{
//        $data_list =$this->webservicemodel->years_list();
	$msg_list=array(
			'1' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ), 
			'2' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '1' ),
			'3' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '2' ) ,
			'4' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'5' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '1' ),
			'6' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'7' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '1' ),
			'8' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'9' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'10' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'11' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'12' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'13' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'14' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'15' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'16' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'17' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'18' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'19' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
			'20' =>  array('title' => 'This is first title', 'message' => 'this is sample message to test', 'date' =>  '2015-11-01' , 'time' => '01:01 AM', 'status' => '0' ),
	);
	
        echo json_encode($msg_list);
	}		

	function get_messages_list_new($candidate_id)
	{
		$data = array('success' => false);
		$message_list =$this->webservicemodel->get_messages_list($candidate_id);
		if(count()>0)
		{
        	echo json_encode($message_list);
		}else
		{
			echo json_encode($data);
		}
		exit();
	}		

	function get_education_list($candidate_id)
	{
		  $data_list =$this->webservicemodel->get_education_list($candidate_id);
		  $final_array=array();
		  $i=0;
		  foreach($data_list as $key => $val)
		  {
			$final_array["'$i'"] = $val;
			$i+=1;
		  }
		  //print_r($final_array);	  
		  echo json_encode($final_array);
	}		

	function get_job_list($candidate_id)
	{
        $data_list =$this->webservicemodel->get_job_list($candidate_id);
      	$final_array=array();
		  $i=0;
		  foreach($data_list as $key => $val)
		  {
			$final_array["'$i'"] = $val;
			$i+=1;
		  }
		  //print_r($final_array);	  
		  echo json_encode($final_array);

	}		

	function get_skill_set($candidate_id)
	{
        $data_list =$this->webservicemodel->get_skill_set($candidate_id);
		//print_r($data_list);	 // should be an arary to get it properly
        echo json_encode($data_list);
	}

	function get_certification_list($candidate_id)
	{
        $data_list =$this->webservicemodel->get_certification_list($candidate_id);
		//print_r($data_list);	 // should be an arary to get it properly
        echo json_encode($data_list);
	}
						
	// Get Locations
	public function getstate()
	{
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


	public function getlocation()
	{
		
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

	public function check_dups()
	{
		$data = array('success' => false, 'username' => 'false', 'mobile' => 'not-checked');		
		$postdata = file_get_contents("php://input");
		$vars=json_decode($postdata);

		if(is_object($vars) && $vars->username!='')
		{
			if($this->check_admin_permission($vars->username,$vars->mobile)==true)
			{
				$this->db->where('username', $vars->username);
				$this->db->where('mobile', $vars->mobile);
				$query = $this->db->get('pms_candidate');
				$row=$query->row_array();				
				$data = array('success' => 'override', 'candidate_id' => $row['candidate_id'], 'encypt_key' => md5($row['candidate_id']));
				$this->send_sms($row['mobile'],$row['candidate_id']); // send otp for registered already, added by admin and they can use the mobileapp.
				echo json_encode($data);
				exit();
			}

			$this->db->where('username', $vars->username);
			$query = $this->db->get('pms_candidate');
			if ($query->num_rows() == 0)
			{
				$this->db->where('mobile', $vars->mobile);
				$query = $this->db->get('pms_candidate');
				if ($query->num_rows() == 0)
				{
					$data = array('success' => 'true', 'mobile' => 'true',  'username' => 'true');
					echo json_encode($data);
					exit();
				}else
				{
					$data = array('success' => 'false', 'username' => 'true', 'mobile' => 'false');
					echo json_encode($data);
					exit();
				}
			}else{
				$data = array('success' => 'false', 'username' => 'false', 'mobile' => 'not-checked');
				echo json_encode($data);
				exit();
			}
		}else
		{
				echo json_encode($data);
				exit();
		}
	}

	public function check_admin_permission($username,$mobile)
	{
		$this->db->where('username', $username);
		$this->db->where('mobile', $mobile);
		$query = $this->db->get('pms_candidate');
		if ($query->num_rows() == 1)
		{	
			$row=$query->row_array();
			if($row['allow_mobile']==1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}		
	}
	
	public function add_candidate()
	{
	    $postdata = file_get_contents("php://input");
	    $vars=json_decode($postdata);
	    
		if(is_object($vars) && $vars->username!='')
		{
				$password=mt_rand(100000, 999999);
				$data =array(
				'username'=> $vars->username,
				'first_name'  => $vars->first_name,
				'reg_date' => date("Y-m-d H:i:s"),
				'mobile' => $vars->mobile,	
				'password'=> md5($password),
				'device_type' => 1,
				'reg_status' => 1,
				);
			
			$id = $this->webservicemodel->insert_candidate($data);
			if ($id != '') { //success
				$status = array("status" => "true", "candidate_id" => $id, 'encypt_key' => md5($id));
				$this->send_sms($vars->mobile,$id); // sending OTP for fresher, 
				
				// email to candidate
				$data =array(
				'Email/Username:'=> $this->input->post('username'),
				'Password: '=> $password,
				'You can login from here:' => '<a href="http://www.abepvtltd.com/candidate">Student Login</a>',
				'Full Name: ' => $this->input->post('first_name'),
				'Mobile: ' => $this->input->post('mobile'),		
				);
											
				$email_array=array(
					'email_to'               =>  $this->input->post('username'),
					'email_to_name'          =>  $this->input->post('first_name'),
					'email_cc'               =>  '',
					'email_from'             =>  'info@abeservices.biz',
					'from_name'              =>  'ABE Services',
					'email_reply_to'         =>  'info@abeservices.biz',
					'email_reply_to_name'    =>  'ABE Services',
					'subject'                =>  'New student registration',
					'salutation'              =>  'Dear '.$this->input->post('first_name').',',
					'table_head'             =>  'ABE Services',
					'text_before_table'      =>  'Your Personal Details',
					'table_rows'             =>  $data,
					'text_after_table'       =>  '-------------',					
					'signature_name'         =>  'ABE Services',
					'signature'              =>  '',
					'date'                   =>  date('Y-m-d'),
				);
				$this->send_email($email_array);
				// email to candidate end here
				
				// EMAIL TO ADMIN
				$data =array(
				'Email'=> $this->input->post('username'),
				'Name' => $this->input->post('first_name'),
				'Mobile' => $this->input->post('mobile'),		
				);

				$email_array=array(
					'email_to'               =>  'abeservices@gmail.com', //'abeservices@gmail.com',
					'email_to_name'          =>  'ABE Services [Cochin]',
					'email_cc'               =>  '',
					'email_from'             =>  'info@abeservices.biz',
					'from_name'              =>  'ABE CRM',
					'email_reply_to'         =>  'abeservices@gmail.com',
					'email_reply_to_name'    =>  'ABE CRM',
					'subject'                =>  'New student registration',
					'salutation'             =>  'New student information.',
					'table_head'             =>  'ABE Services',
					'text_before_table'      =>  '---------------------------------',
					'table_rows'             =>  $data,
					'text_after_table'       =>  '---------------------------------',					
					'signature_name'         =>  'ABE Services',
					'signature'              =>  '',
					'date'                   =>  date('Y-m-d'),
				);

				$this->send_email($email_array);
				// email to admin end here

				echo json_encode($status);
			}
			else { //failure
				$status = array("status" => "false");
				echo json_encode($status);
			}
		}else
		{
			$status = array("status" => "error");
			echo json_encode($status);
		}
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


	public function update_profile()
	{
	    $postdata = file_get_contents("php://input");
	    $vars=json_decode($postdata);
	   // $this->input->post = json_decode(file_get_contents('php://input'), true);

		if(is_object($vars) && $vars->candidate_id!='')
		{
			$data =array(			
			'first_name' => $vars->first_name, // changed by Anu
			'last_name' => $vars->last_name,
			'reg_date' => date("Y-m-d H:i:s"),
			'title' => $vars->title,
			'gender' => $vars->gender,
			'marital_status' => $vars->marital_status,
			'marriage_date' => $vars->marriage_date,
			'engaged_date' => $vars->engaged_date,
			'date_of_birth' => $vars->date_of_birth,
			'age' => $vars->age,
			'children' => $vars->children,
			'course_id' => $vars->course_id,
			'branch_id' => $vars->branch_id,
			'lead_source' => $vars->lead_source,
			'reg_status' => 0
			);
  

			$id = $this->webservicemodel->update_candidate_profile($data,$vars->candidate_id);
			if ($id != '') { //success
				$status = array("status" => "true", "candidate_id" => $id, 'encypt_key' => md5($id));
				echo json_encode($status);
			}
			else { //failure
				$status = array("status" => "false");
				echo json_encode($status);
			}
		}else
		{
			$status = array("status" => "error");
			echo json_encode($status);
		}
	}

	public function update_education_history()
	{
        $postdata = file_get_contents("php://input");
	    $vars=json_decode($postdata);
            //print_r($vars);
            //exit();
		if(is_object($vars) && $vars->candidate_id!='')
		{
			$data = array(
				'candidate_id' => $vars->candidate_id,
				'level_id' => $vars->level_id,
				'course_id' => $vars->course_id,
				'spcl_id' => $vars->spcl_id,
				'univ_id' => $vars->univ_id,
				'edu_year' => $vars->edu_year,
				'edu_country' => $vars->edu_country,
				'course_type_id' => $vars->course_type_id,
				'arrears' => $vars->arrears,
				'absesnse' => $vars->absesnse,
				'repeat' => $vars->repeat,
				'year_back' => $vars->year_back,
				'mark_percentage' => $vars->mark_percentage 
			);
  
			$id = $this->webservicemodel->update_education_history($data,$vars->candidate_id);
			if ($id != '') { //success
				$status = array("status" => "true", "candidate_id" => $id, 'encypt_key' => md5($id));
				echo json_encode($status);
			}
			else { //failure
				$status = array("status" => "false");
				echo json_encode($status);
			}
		}else
		{
			$status = array("status" => "error");
			echo json_encode($status);
		}
	}

	public function update_certification($candidate_id)
	{
            $postdata = file_get_contents("php://input");
	   		$vars=json_decode($postdata);
			
		if(is_object($vars) && is_array($vars->Certification))
		{
			foreach($vars->Certification as $key => $val)
			{
				$data = array(
				'candidate_id' => $val->candidate_id,
				'cert_id' => $val->cert_id,
				);
				$this->webservicemodel->update_certifications($data,$val->candidate_id,$val->cert_id);
			}
			$status = array("status" => "true");
			echo json_encode($status);
			exit();
		}
		else 
		{ //failure
			$status = array("status" => "false");
			echo json_encode($status);
			exit();
		}
	}

	public function update_skills($candidate_id)
	{
            $postdata = file_get_contents("php://input");
	   		$vars=json_decode($postdata);
			
		if(is_object($vars) && is_array($vars->Skills))
		{
			foreach($vars->Skills as $key => $val)
			{
				$data = array(
				'candidate_id' => $val->candidate_id,
				'skill_id' => $val->skill_id,
				);
				$this->webservicemodel->update_skills($data,$val->candidate_id,$val->skill_id);
			}
			$status = array("status" => "true");
			echo json_encode($status);
			exit();
		}
		else 
		{ //failure
			$status = array("status" => "false");
			echo json_encode($status);
			exit();
		}
	}

	function get_questionnaire_list($candidate_id,$question_id='')
	{
        $data_list =$this->webservicemodel->get_survey_result($candidate_id);
		//print_r($data_list);	 // should be an arary to get it properly
        echo json_encode($data_list);
	}
	
	public function update_questionnaire($candidate_id,$question_id='')
	{
            $postdata = file_get_contents("php://input");
	   		$vars=json_decode($postdata);
			if(is_object($vars))
			{
				foreach($vars as $key => $val)
				{
					foreach($val as $key => $val1)
					{
						$data = array(
						'candidate_id' => $val1->candidate_id,
						'answer_value' => $val1->answer_value,
						'answer_id' => $val1->question_id,
						);
						$this->webservicemodel->update_questionnaire($data,$val1->candidate_id,$val1->question_id);						
					}
				}
				$status = array("status" => "true",'question_id' => '1');
				echo json_encode($status);
				exit();	
			}
			else 
			{ //failure
				$status = array("status" => "false",'question_id' => '0');
				echo json_encode($status);
				exit();
			}
	}

	public function update_job_history()
	{
        $postdata = file_get_contents("php://input");
	    $vars=json_decode($postdata);
		if(is_object($vars) && $vars->candidate_id!='')
		{
			$data = array(
				'candidate_id' => $vars->candidate_id,
				'organization'=> $vars->organization,
				'designation' => $vars->designation,
				'job_cat_id'=> $vars->job_cat_id,
				'func_id' => $vars->func_id,
				'responsibility' => $vars->responsibility,
				'from_date' => $vars->from_date,
				'to_date' => $vars->to_date,
				'monthly_salary' => $vars->monthly_salary, 
				'present_job' => $vars->present_job
			);

		$data1 = array(
				'exp_years'=> $vars->exp_years,
				'exp_months' => $vars->exp_months,
				'skills' => $vars->skills
			    ); 
				
			$id = $this->webservicemodel->update_job_history($data,$data1,$vars->candidate_id);
			if ($id != '') { //success
				$status = array("status" => "true", "candidate_id" => $id, 'encypt_key' => md5($id));
				echo json_encode($status);
			}
			else { //failure
				$status = array("status" => "false");
				echo json_encode($status);
			}
		}else
		{
			$status = array("status" => "error");
			echo json_encode($status);
		}
	}

	public function update_language_skills()
	{
		 $postdata = file_get_contents("php://input");
	    $vars=json_decode($postdata);
		if(is_object($vars) && $vars->candidate_id!='')
		{
			$data = array(
				'passportno'=> $vars->passport_number,
				'issued_date' => $vars->issue_date,
				'expiry_date' => $vars->exp_date,
				'place_of_issue' => $vars->place_of_issue ,
				'passport_nationality' => $vars->passport_nationality ,
				'eng_pte' => $vars->eng_pte ,
				'eng_pte_reading' => $vars->eng_pte_reading ,
				'eng_pte_listening' => $vars->eng_pte_listening ,
				'eng_pte_writing' => $vars->eng_pte_writing,
				'eng_pte_speaking' => $vars->eng_pte_speaking ,				
				'eng_ielts' => $vars->eng_ielts ,
				'eng_ielts_reading' => $vars->eng_ielts_reading ,
				'eng_ielts_listening' => $vars->eng_ielts_listening ,
				'eng_ielts_writing' => $vars->eng_ielts_writing ,
				'eng_ielts_speaking' => $vars->eng_ielts_speaking ,			
				'eng_tofel' => $vars->eng_tofel ,
				'eng_tofel_reading' => $vars->eng_tofel_reading ,
				'eng_tofel_listening' => $vars->eng_tofel_listening ,
				'eng_tofel_writing' => $vars->eng_tofel_writing ,
				'eng_tofel_speaking' => $vars->eng_tofel_speaking ,	
				'eng_oet' => $vars->eng_oet ,
				'eng_oet_reading' => $vars->eng_oet_reading ,
				'eng_oet_listening' => $vars->eng_oet_listening ,
				'eng_oet_writing' => $vars->eng_oet_writing ,
				'eng_oet_speaking' => $vars->eng_oet_speaking ,							
				'eng_gre' => $vars->eng_gre ,
				'eng_gmat' => $vars->eng_gmat ,
				'eng_sat' => $vars->eng_sat ,
				'eng_10th' => $vars->eng_10th ,
				'eng_12th' => $vars->eng_12th 
			  ); 	

			$id = $this->webservicemodel->update_language_skills($data,$vars->candidate_id);
		
			if ($id != '') { //success
				$status = array("status" => "true", "candidate_id" => $id, 'encypt_key' => md5($id));
				echo json_encode($status);
			}
			else { //failure
				$status = array("status" => "false");
				echo json_encode($status);
			}
		}else
		{
			$status = array("status" => "error");
			echo json_encode($status);
		}
	}

	public function check_sms()
	{
		$data = array('success' => false);		
		$postdata = file_get_contents("php://input");
		$vars=json_decode($postdata);
		
		if(is_object($vars) && $vars->encypt_key!='')
		{
			$this->db->where('md5(candidate_id)', $vars->encypt_key);
			$this->db->where('otp_status', '0');						
			$query = $this->db->get('pms_candidate_otp');
			if ($query->num_rows() == 1)
			{
					$row=$query->row_array();
					$data = array('success' => 'true','otp_number' => $row['otp_number']);
					echo json_encode($data);
					exit();
			}else{
				$data = array('success' => 'false');
				echo json_encode($data);
				exit();
			}
		}else
		{
				$data = array('success' => 'noval');	
				echo json_encode($data);
				exit();
		}
	}


	public function send_sms($mobile,$candidate_id)
	{
			$otp=mt_rand(100000, 999999);
			$sms_text='Dear candidate, a One Time Password is generated which needs to authenticate your mobile number. Your OTP is: '.$otp;
			$sms_text=str_replace(' ','%20',$sms_text);
			$response=file_get_contents('http://sms.logicsms.in/api/sendmsg.php?user=abeservices&pass=grandstream2015&sender=ABECCH&phone='.$mobile.'&text='.$sms_text.'&priority=sdnd&stype=normal');
			$data = array(
				'candidate_id'=> $candidate_id,
				'mobile' => $mobile,
				'otp_number' => $otp,
				'otp_status' => 0 ,
				'candidate_id_encypt' => md5($candidate_id) ,
				'otp_date' => time()
		  );
		  $id = $this->webservicemodel->insert_otp_info($data);
		  return $id;
	}
}
?>
