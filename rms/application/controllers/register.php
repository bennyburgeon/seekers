<?php 
class Register extends CI_Controller {

	function Register()
	{
		parent::__construct();
		$this->load->model('coursemodel');
		$this->load->model('registermodel');
		$this->load->model('signupmodel');
		$this->load->model('countrymodel');
		$this->load->model('statmodel');
		$this->load->model('cittymodel');
		$this->load->model('locationmodel');		
		$this->load->model('visatypemodel');		
	}
	
	function index($offset = 0)
	{		
		$this->data['page_head']= 'Manage Candidate';
		$config['base_url'] = base_url().'index.php/register/?';

		//echo $this->generateRandomString();
		//exit();
		

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
			//~ 'course_id' => '',
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
		$this->data["branch_list"] = $this->registermodel->branch_list();
		$this->data["level_list"] = $this->coursemodel->fill_levels();
		
		$this->data['page_head']= 'Personal Data';
		
		
//Educational Data		
		

		$this->data['education']=array(
				'level_id'=> $this->input->post('level_id'),
				'course_id' => $this->input->post('course_id'),
				'spcl_id'=> $this->input->post('spcl_id'),
				'univ_id' => $this->input->post('univ_id'),
				'edu_year' => $this->input->post('edu_year'),
				//~ 'edu_country' => $this->input->post('edu_country'),
				'course_type_id' => $this->input->post('course_type_id'),
				'arrears' => '',
				'absesnse'  => '',
				'repeat'  => '',
				'year_back'  => '',
				'mark_percentage'  => '',
				'grade'  => ''			
				);
				
		$this->data["country_list"] 	= $this->countrymodel->country_list_by_state_city_location();
		$this->data["edu_level_list"] = $this->registermodel->edu_level_list();
		$this->data["edu_years_list"] = $this->registermodel->edu_years_list();
		
		//$this->data["edu_course_list"] = $this->registermodel->edu_course_list();
		$this->data["edu_course_list"] = array('' => 'Select Course');
		$this->data["edu_spec_list"] = $this->registermodel->edu_spec_list();
		$this->data["edu_univ_list"] = $this->registermodel->edu_univ_list();
		$this->data["college_list"] = $this->registermodel->college_list();
		$this->data["edu_course_type_list"] = $this->registermodel->edu_course_type_list();

//JOB DATAILS
		$this->data['job']=array(
				'organization'=> '',
				'designation' => '',
				'from_date' => '',
				'to_date' => '',
				'present_job' => '',
				
		);
		//employment
		$this->data["industry_list"] = $this->registermodel->industry_list();
		$this->data["functional_list"] = $this->registermodel->functional_list();
		$this->data["currecy_list"] = $this->registermodel->currency_list();
		$this->data["years_list"] = $this->registermodel->years_list();
		$this->data["months_list"] = $this->registermodel->months_list();

//JOBS
		$this->data["jobs"] = $this->registermodel->get_jobs();
		
//SKILLS DETAILS
		
		$this->data['skillset']=$this->registermodel->get_skills();
		$this->data['parentskill']=$this->registermodel->get_parent_skills();

//Certification Details
		$this->data['cerifications']=$this->registermodel->get_cert();

//Domain Details
		$this->data['domains']=$this->registermodel->get_domains();
		
		$this->load->view('register/index',$this->data);	
		

	}

//REGISTER CANDIDATE 
	function addcandidate()
	{ 
		if($_POST)
		{
		
//checking username already exist or not
			$this->db->where('username', $this->input->post('username'));
			$query = $this->db->get('pms_candidate');
			if ($query->num_rows() != 0)
			{
				$data = array('success' => 'false', 'username' => 'false', 'mobile' => 'false' , 'id' => '');
				echo json_encode($data);
				exit();
					
				/*$this->session->set_flashdata('err_msg','Email address already exist, please change and register again.');
				redirect('register');*/
			}

//checking mobile already exist or not
			$this->db->where('mobile', $this->input->post('mobile'));
			$query = $this->db->get('pms_candidate');
			if ($query->num_rows() != 0)
			{
				$data = array('success' => 'false', 'username' => 'true', 'mobile' => 'false' , 'id' => '');
				echo json_encode($data);
				exit();
				
			/*	$this->session->set_flashdata('err_msg','Mobile already exist, please change and save again.');
				redirect('register');*/
			}
			
			
			$age='';
			if($this->input->post('date_of_birth')!='' & $age=='') $age = floor((time() - strtotime($this->input->post('date_of_birth'))) / 31556926);
			
			if($this->input->post('pass')!='')
			{
				$password=$this->input->post('pass');
			}
			else{
				$password=date('Y-m-d H:i:s');
			}
			
			$data =array(
				'username'=> $this->input->post('username'),
				'password'=> md5($password),
				'first_name' => $this->input->post('first_name'),
				'reg_date' => date("Y-m-d H:i:s"),
				'mobile' => $this->input->post('mobile'),		
				'date_of_birth' => $this->input->post('date_of_birth'),
				'age' => $age,
				//~ 'course_id' => $this->input->post('course_id'),
				'lead_source' => 'Website',
				'reg_status' => 1
			);
			
// save to candidates
			$id = $this->registermodel->insert_candidate_record($data);			
			
			if ($id != '')
			{
				$this->db->where('candidate_id',$id);
				$res=$this->db->get('pms_candidate');
				$val=$res->row();
				
				if($this->input->post('job_id')!='')
				{
					$dt=array(
						'job_id'=>$this->input->post('job_id'),
						'candidate_id'=>$id,
						'applied_on'=>$val->reg_date,
						'app_status_id' => 1,
					);
					$this->db->insert('pms_job_apps',$dt);
				}
				 $_SESSION['candidate_session']=$id;
				 $_SESSION['username']=$val->username;
				 
//save education details
			$this->registermodel->insert_education_detail($id);

//save job details
			$this->registermodel->insert_job_detail($id);
			
//save skills details
			$this->registermodel->insert_skill_details($id);

//save certification details
			$this->registermodel->insert_cert_details($id);
			
//save domain details
			$this->registermodel->insert_domain_details($id);
			
// save job planning details
			$this->registermodel->insert_job_search($id);
			
// save languages
			$this->registermodel->update_passport_detail($id);				
			}


			
//save files
		
		$this->table_name='pms_candidate';
		$this->load->library('upload');		
		$candidate_id = $id;	
	
		if($id !=''){ 
			if(isset($_FILES['cv_file'])){ 
				if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
				{       			
				
					 $config['upload_path'] = '../admin/uploads/cvs/';
					//$config['upload_path'] = './assets/userimages/';
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
				
					 $photo['upload_path'] = '../admin/uploads/photos/';
					//$photo['upload_path'] = './assets/userimages/';
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
			
			$data = array('success' => 'true', 'mobile' => 'true',  'username' => 'true', 'id' => $id);			
			echo json_encode($data);
			exit();
			/*$this->session->set_flashdata('msg','You have successfully registered with ABE Services, One of our team members will contact you soon.');
			redirect('register');*/
 	
	
		}
		
		
	}
	
	public function getcourses()
	{
		if(isset($_POST['level_study']) && $_POST['level_study']!='' && isset($_POST['int_val']) && $_POST['int_val']!='')
		{
			$data=array();
			$data["course_list"] = $this->coursemodel->get_course_list($_POST['level_study'],$_POST['int_val']);
			//$course='<option value="">Select Course</option>';
			$course	='';
			
			//print_r($data["course_list"]);exit;
			
			foreach($data["course_list"] as $key=>$value)
			{
				$course.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'course_list' => $course);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	function test_otp()
	{
		$this->send_sms('9895011980','10','Shyjo Mathew');
	}
	// send SMS
	public function send_sms($mobile,$candidate_id,$first_name)
	{
			$otp=mt_rand(100000, 999999);
			//$sms_text='Dear candidate, a One Time Password is generated which needs to authenticate your mobile number. Your OTP is: '.$otp;
			
			$sms_text='Dear '.$first_name.', You have successfully registered with ABE Services, One of our team members will contact you soon.';
			
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
		  $id = $this->registermodel->insert_otp_info($data);
		  return $candidate_id;
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

// send email
	function test_email()
	{
				$data =array(
				'Email:'=> 'test',								
				'Full Name: ' =>  'test',	
				'Gender : ' =>  'test',	
				'Mobile: ' =>  'test',		
				'DoB: ' =>  'test',	
				'Prorgam Opted: ' =>  'test',	
				'Level of Study: ' =>  'test',
				);

				$email_array=array(
					'email_to'               =>  'pradeep@abeservices.biz', //'abeservices@gmail.com',
					'email_to_name'          =>  'ABE Services [Cochin]',
					'email_cc'               =>  '',
					'email_from'             =>  'leads@abepvtltd.com',
					'from_name'              =>  'ABE CRM',
					'email_reply_to'         =>  'shaijotm@gmail.com',
					'email_reply_to_name'    =>  'Shyjo Mathew',
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
								
				// EMAIL TO ADMIN
				$this->send_email($email_array);
								
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

	function child_skill()
	{
		$id=$this->input->get('id');
		//~ $id=1;
		$this->data['skillset']=$this->registermodel->get_child_skills($id);
		echo json_encode($this->data);
	}
}