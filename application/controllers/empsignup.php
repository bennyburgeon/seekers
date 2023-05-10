<?php class Empsignup extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('empsignupmodel');
		/*if(isset($_SESSION['renew_session'])) 
		{
			unset($_SESSION['company_session']);
			unset($_SESSION['renew_session']);
			redirect('signup/success?ins=1');
		} */
	
	}
	
	function index()
	{
		$this->data['formdata']=array(
		'ind_id'      	 => '',
        'state_id'       => '',
        'city_id'        => '',
		'country_id'     => '',
            
		);

		$this->data['errmsg']='';
		$check_dups='false';
       	
 	    $this->load->model('homepagemodel'); 
		
        $this->load->model('empsignupmodel');
		$this->data["country_list"] = $this->empsignupmodel->country_list();
        $this->data["state_list"] = $this->empsignupmodel->state_list();
		//$this->data["state_list"] = array(''=>'Select State');	
		$this->data["city_list"] = array(''=>'Select City');
		
		if($this->input->post('contact_name'))
		{
			$check_dups=$this->check_username($this->input->post('contact_email'));	
			if($check_dups==true)redirect('empsignup?dups=1');
			$id=$this->empsignupmodel->insert_employer();
			
			if($id!=''){				
		
			$query = $this->db->query("SELECT a.user_id,a.email, a.username, a.password,a.firstname,a.lastname,a.address, a.payment_status, b.company_id,b.company_name, b.contact_name, b.contact_email, b.contact_phone, a.package,c.package_exp_date, c.emp_package_status, c.emp_credit_id from pms_company_users a inner join pms_company b on a.company_id=b.company_id left join pms_employer_credits c on c.user_id=a.user_id where a.username='".$this->input->post('contact_email')."' and a.password='".md5($this->input->post('password'))."' and a.status=1");
			
			if ($query->num_rows() > 0)
			{
			 $row = $query->row_array();
				
					  
						$_SESSION['company_session']       		   =$row['user_id'];
						$_SESSION['company_username']       		   =$row['email'];
						$_SESSION['company_id']             		   =$row['company_id'];
						$_SESSION['company_name']           		   =$row['company_name'];
						$_SESSION['company_firstname']              =$row['firstname'];
						$_SESSION['company_lastname']               =$row['lastname'];
						$_SESSION['company_address']                =$row['address'];
						$_SESSION['user_id']     				   =$row['user_id'];
						$_SESSION['contact_name']				   =$row['contact_name'];
						$_SESSION['contact_email']				   =$row['contact_email'];
						$_SESSION['contact_phone']				   =$row['contact_phone'];
						$_SESSION['package']      				   =$row['package'];
						$_SESSION['username']   					   =$row['username'];
						$_SESSION['password']  					   =$row['password'];
						$_SESSION['company_id']  				   =$row['company_id'];
						//$_SESSION['company_menu_list']                  =$this->categoryChild(0);
					   redirect($this->config->item('employer_url').'?reg=1');
			} 
		}			 
			//redirect('login/?ins=1');
		}
        
		
		$this->data["left_search_form"]='';
		$this->data["current_controller"]=$this->router->class;
		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_description']  = $this->config->item('company_name');
		$this->data['og_image']        = $this->config->item('website').'/assets/img/logo.png';
		$this->data['og_url']          = $this->config->item('website');

		$this->data['industry_menu']=$this->homepagemodel->get_industry_menu();
		$this->data['home_summary']=$this->homepagemodel->get_home_summary();
						
        $this->data["industry_list"] = $this->empsignupmodel->industry_list();
		$this->data['page_title']='';
		if($this->input->get('dups')==1)
		{
			$this->data['errmsg']='<p style="margin-top:-11px">Username exists, please change.</p>';
		}

		$this->load->view('homepage-include/header', $this->data);
		$this->load->view('empsignup/signup',  $this->data);	
		$this->load->view('homepage-include/footer',  $this->data);		
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
				'date_of_birth'         => $this->input->post('date_of_birth'),
				
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
				'status_updated_on'     => date('Y-m-d'),
				
				'device_type'           => '',
				'job_folder_id'         => 2,
				'lead_opportunity'      => 2,
				'lead_source'           => 2,
				'reg_status'            => 1,
				'lead_opportunity'      => 1,
				'allow_mobile'          => 1
				);
				//print_r($data);
			//	exit();
				$id = $this->empsignupmodel->insert_candidate_from_jobs($data);
			
				// take skills from this job 
				// add job application
				
				// update job search form
				
				$data =array(
					'candidate_id'        => $id,
					'current_ctc'         => $this->input->post('current_ctc'),
					'expected_ctc'        => $this->input->post('expected_ctc'),
					'ctc_updated_on'      => date('Y-m-d'),
					'ctc_updated_by'      => 0,
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
				$this->db->query("delete from pms_job_apps where candidate_id=".$id); // delete any unwated records here before.
				
				$this->db->query("delete from pms_candidate_job_search where candidate_id=".$id);
				$this->db->insert('pms_candidate_job_search', $data);	
	
				// upload CV & Photo files
				if ($id != '') 
				{ 			
						// insert industry
					if($this->input->post('job_cat_id')!='')
					{
							$this->db->where('job_cat_id',$this->input->post('job_cat_id'));
							$this->db->where('candidate_id',$id);
							$this->db->delete('pms_candidate_to_industry');
						
							$data =array(
								'candidate_id'=> $id,
								'job_cat_id'=> $this->input->post('job_cat_id'),
							);
						$this->db->insert('pms_candidate_to_industry', $data);
					}
			
					// insert functional area
					if($this->input->post('func_id')!='')
					{
							$this->db->where('func_id ',$this->input->post('func_id'));
							$this->db->where('candidate_id',$id);
							$this->db->delete('pms_candidate_to_funcional');
						
							$data =array(
								'candidate_id'=> $id,
								'func_id'=> $this->input->post('func_id'),
							);
						$this->db->insert('pms_candidate_to_funcional', $data);
					}
					
					// insert designation
					if($this->input->post('desig_id')!='' && $this->input->post('desig_id')!='0' && $id >0)
					{
							$this->db->where('desig_id',$this->input->post('desig_id'));
							$this->db->where('candidate_id',$id);
							$this->db->delete('pms_candidate_to_designation');
						
							$data =array(
								'candidate_id'=> $id,
								'desig_id'=> $this->input->post('desig_id'),
							);
						$this->db->insert('pms_candidate_to_designation', $data);
					}
			
					$pref_city_id=$this->input->post('pref_city_id');
					if(is_array($pref_city_id))
					{
						foreach($pref_city_id as $key => $val)
						{
							$this->db->where('city_id',$val);
							$this->db->where('candidate_id',$id);
							$this->db->delete('pms_candidate_to_location');
							
							$data =array(
							'candidate_id'=> $id,
							'city_id'=> $val,
							);
							$this->db->insert('pms_candidate_to_location', $data);
						}			
					}
		
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
								$this->db->query("update pms_candidate set cv_file='".$this->upload_file_name."' where candidate_id=".$id);
								$dataArr = array(
									'file_name' => $this->upload_file_name,
									'file_type'=> $this->upload_file_name,
									'candidate_id' => $id,
									'upload_date' => date('Y-m-d'),
								);
								$this->empsignupmodel->insert_files($dataArr);
								$cv_file=1;
							}
						}
					
					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
					{         
						$photo['upload_path'] = $this->config->item('photo_upload_folder');
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
							$this->empsignupmodel->insert_files($dataArr);
						}
					}
					// create session
					$query = $this->db->query("SELECT candidate_id, username, password,first_name,last_name from pms_candidate where candidate_id=".$id);
					if ($query->num_rows() > 0)
					{
					   $row = $query->row_array();
					   $_SESSION['candidate_session']=$row['candidate_id'];
					   $_SESSION['candidate_username']=$row['username'];
					   $_SESSION['candidate_password']=$row['password'];
					   $_SESSION['candidate_first_name']=$row['first_name'];
					   $_SESSION['candidate_last_name']=$row['last_name'];
					   redirect('candidates_all/summary?registation=success');
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
	
	
	
	function check_email(){
		
		$this->db->where('email', $this->input->post('email'));

		$query = $this->db->get('pms_company_users');
		$result	=	$query->row();
			
			if ($query->num_rows() != 0) { //avilable
				
				$status = array("STATUS" => "1", "user_id" => $result->user_id);
				echo json_encode($status);
			} 
			else { //doesn't exist
				$status = array("STATUS" => "0");
				echo json_encode($status);
			}
		
	}
	
	
	function check_mobile(){
		
		$this->db->where('mobile', $this->input->post('mobile'));

		$query = $this->db->get('pms_company_users');
		$result	=	$query->row();
			
			if ($query->num_rows() != 0) { //avilable
				
				$status = array("STATUS" => "1", "user_id" => $result->user_id);
				echo json_encode($status);
			} 
			else { //doesn't exist
				$status = array("STATUS" => "0");
				echo json_encode($status);
			}
		
	}
	
	function check_username()
	{
		
		$this->db->where('username', $this->input->post('contact_email'));
		$query = $this->db->get('pms_company_users');
		$result	=	$query->row();
		
			if ($query->num_rows() > 0) 
			{ //avilable
				return true;
			} 
			else 
			{ //doesn't exist
				return false;
			}	
	}
	
	function check_mobile_old()
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
		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_image']        = 'http://seekersgulf.com/assets/img/logo.png';
		$this->data['og_url']          = 'http://seekersgulf.com/jobs/';
		
		$this->data['status']=$this->input->get('ins');
		$this->load->view('homepage-include/header',$this->data);
		$this->load->view('signup/confirm',$this->data);
		$this->load->view('homepage-include/footer',$this->data);
	}

	public function getstate()
	{
		$this->load->model('empsignupmodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->empsignupmodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{ 
		$this->load->model('empsignupmodel');
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->empsignupmodel->city_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
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
	
	
	function success()
	{
		$this->data['errmsg']='';
		if($this->input->get('ins')==1)
		{
			$this->data["list_packages"] = $this->empsignupmodel->list_packages();
		    $this->data["selected_packages"] = $this->empsignupmodel->selected_packages();
		
				$this->load->view('include/header',$this->data);
				$this->load->view('signup/success',$this->data);
				$this->load->view('include/footer',$this->data);
		}
		
	}
	function categoryChild($id)
	{
		  $query = $this->db->query("SELECT m.module_id, m.module_name,m.module_class,m.module_url,m.status,m.module_order FROM pms_company_modules m WHERE m.status=1 and m.parent_id = $id ORDER BY m.module_order ASC");
	
	    $module_list= $query->result();

	   
	    $children = array();
	    # It has children, let's get them.
	    foreach($module_list as $row)
		{
            $children[$row->module_id] = array(	"id"=>$row->module_id,
				"name"=>$row->module_name,
				"url"=>$row->module_url,
				"module_class" =>$row->module_class,
				"status" =>$row->status,
				"parent"=>$id,
				"ordering"=>$row->module_order,
				"sub"=>$this->categoryChild($row->module_id)
			);
        }		
   	 	return $children;
	}	
	
			

}

