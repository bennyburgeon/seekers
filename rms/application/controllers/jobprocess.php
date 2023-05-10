<?php 
class Jobprocess extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
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
		$this->load->model('jobprocessmodel');
		
		$searchterm='';
		$job_priority='';
		$start=0;
		$job_status=1;
		$limit=25;
		$rows='';
		$sort_by = 'asc';
		$company_id='';
				
		if($this->input->get("limit"))
		{
			$limit=$this->input->get("limit");
		}		

		if($this->input->post("limit"))
		{
			$limit=$this->input->post("limit");
		}	
				
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
			$sort_by=$this->input->get("sort_by");
		}
		if($this->input->post('sort_by')!='')
		{
			$sort_by=$this->input->post("sort_by");
		}	

		if($this->input->get("company_id")!='')
		{
			$company_id=$this->input->get("company_id");
		}

		if($this->input->post("company_id")!='')
		{
			$company_id=$this->input->post("company_id");
		}

		if($this->input->get("job_status")!='')
		{
			$job_status=$this->input->get("job_status");
		}

		if($this->input->post("job_status")!='')
		{
			$job_status=$this->input->post("job_status");
		}

		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}
		
		if($this->input->post("rows")!='')
		{
			$rows=$this->input->post("rows");
		}
		
		if($this->input->post("searchterm"))
		{
			$searchterm=$this->input->post("searchterm");
			
		}
		
		if($this->input->get("searchterm"))
		{
			$searchterm=$this->input->get("searchterm");			
		}

		if($this->input->post("job_priority"))
		{
			$job_priority=$this->input->post("job_priority");
			
		}
		if($this->input->get("job_priority"))
		{
			$job_priority=$this->input->get("job_priority");			
		}

		$this->data['total_rows']= $this->jobprocessmodel->record_count($searchterm,$job_status,$company_id,$job_priority);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/jobprocess/?sort_by=$sort_by&searchterm=$searchterm$query_str&job_status=$job_status&company_id=$company_id&job_priority=$job_priority";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
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
		$this->data["records"] = $this->jobprocessmodel->get_list($start,$limit,$searchterm,$sort_by,$job_status,$company_id,$job_priority);
	
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["job_priority"]=$job_priority;
		$this->data["job_status"]=$job_status;
		$this->data['page_head'] = 'Manage Jobs || Access only for Super User';
		$this->data['company_id']=$company_id;
		
		$this->data["company"] = $this->jobprocessmodel->company_has_jobs($job_status);
		$this->data["admin_list"]=$this->jobprocessmodel->admin_list();
		
		$this->data["priority_list"] = array('' => 'Priority', '1' => 'High','2' => 'Medium','3' => 'Low');

		$this->load->view('include/header');
		$this->load->view('jobprocess/listjob',$this->data);				
		$this->load->view('include/footer');
	}	

	function add()
	{	
		$this->data['formdata']=array(
		'job_priority'        => '2' ,
		'job_title'           => '' ,
		'company_id'          => '' ,
		'job_desc'            => '' ,
		'job_cat_id'          => '' ,
		'job_cat_id'          => '' ,
		'func_id'             => '' ,
		'skill_id'            =>'',
		'cert_id'             =>'',
		'domain_id'           =>'',
		'job_type_id'         => '',
		'job_location'        => '' ,
		'res_location'        => '' ,
		'vacancies'           => '' ,
		'job_post_date'       => '' ,
		'job_expiry_date'     => '',
		'desired_profile'     => '' ,
		'brochure'            => '',
		'level_id'            => '',
		'gender'              => '1',
		'about_company'       => '',
		'job_contact'         => '',
		'salary_id'           => '',
		'exp_join_date'       => '',
		'job_keywords'        => '',
		'job_skills'          => '',
		'work_level_id'       => '',
		'exp_join_date'       => '',
		'contact_name'        => '',
		'contact_designation' => '',
		'contact_email'       => '', 
		'contact_phone'       => '',
		'contact_website'     => '',
		'country_id'          => '',
		'facebook'            => '',
		'twitter'             => '',
		'googleplus'          => '',
		'linkedin'            => '',
		'social_title'        => '',
		'social_content'      => '',
		'social_link'         => '',
		'social_link_image'   => '',
		'social_comment'      => '',
		);
		
		$this->load->model('jobprocessmodel');
		$this->load->model('countrymodel');
		$this->data["company"] = $this->jobprocessmodel->fill_company();
		$this->data["jobcategory"] = $this->jobprocessmodel->fill_jobcategory();
		$this->data["jobindustry"] = $this->jobprocessmodel->fill_jobindustry();
		$this->data["functional"] = array('' => 'Select Functional Role');
		$this->data["education"] = $this->jobprocessmodel->fill_education();
		$this->data["salary"] = $this->jobprocessmodel->fill_salary();
		$this->data["worklevel"]= $this->jobprocessmodel->fill_worklevel();
		$this->data["nationality"] = $this->countrymodel->country_list();
		$this->data["jobtype"] = $this->jobprocessmodel->jobtype_list();
		
		$this->data['skillset']=$this->jobprocessmodel->get_parent_skills();
		$this->data['cerifications']=$this->jobprocessmodel->get_cert();
		$this->data['domain']=$this->jobprocessmodel->get_domain();

		if($this->input->post('job_title')!='' && $this->input->post('company_id') != '0' )
		{
			$this->form_validation->set_rules('job_title', 'job name', 'required');
			$this->form_validation->set_rules('company_id', 'company name', 'required');
			//$this->form_validation->set_rules('job_title_dup', 'job name', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{
	
				$id=$this->jobprocessmodel->insert_record();
				$job_cert=$this->jobprocessmodel->insert_cert_details($id);
				$job_skill=$this->jobprocessmodel->insert_skill_details($id,$this->input->post('parent'));
				$job_domain=$this->jobprocessmodel->insert_domain_details($id);
				redirect('jobprocess/?ins=1&id='.$id);
			}
				
				$this->data['formdata']=array(				
				'job_priority'        => $this->input->post('job_priority') ,
				'job_title'           => $this->input->post('job_title') ,
				'company_id' => $this->input->post('company_id') ,
				'job_desc' => $this->input->post('job_desc') ,
				'job_cat_id'=> $this->input->post('job_cat_id') ,
				'job_cat_id'=> $this->input->post('job_cat_id') ,
				'func_id'=> $this->input->post('func_id') ,
				'skill_id'=> $this->input->post('skill_id') ,				
				'job_type_id' => $this->input->post('job_type_id'),
				'job_location'=> $this->input->post('job_location'),
				'res_location'=> $this->input->post('res_location') ,
				'vacancies'=> $this->input->post('vacancies') ,
				'job_post_date'=> $this->input->post('job_post_date') ,
				'job_expiry_date' => $this->input->post('job_expiry_date'),
				'desired_profile'=> $this->input->post('desired_profile') ,
				'brochure' => $this->input->post('brochure'),
				'level_id' => $this->input->post('level_id'),
				'gender' => $this->input->post('gender'),
				'about_company' => $this->input->post('about_company'),
				'job_contact' => $this->input->post('job_contact'),
				'salary_id' => $this->input->post('salary_id'),
				'exp_join_date' => $this->input->post('exp_join_date'),
				'job_keywords' => $this->input->post('job_keywords'),
				'job_skills' => $this->input->post('parent'),
				'work_level_id' => $this->input->post('work_level_id'),
				'exp_join_date' => $this->input->post('exp_join_date'),
				'contact_name' => $this->input->post('contact_name'),
				'contact_designation' => $this->input->post('contact_designation'),
				'contact_email' => $this->input->post('contact_email'), 
				'contact_phone' => $this->input->post('contact_phone'),
				'contact_website' => $this->input->post('contact_website'),
				'country_id' => $this->input->post('country_id'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'googleplus' => $this->input->post('googleplus'),
				'linkedin' => $this->input->post('linkedin'),
				'social_title'       => $this->input->post('social_title'),	
				'social_content'     => $this->input->post('social_content'),	
				'social_link'        => $this->input->post('social_link'),	
				'social_link_image'  => $this->input->post('social_link_image'),	
				'social_comment'     => $this->input->post('social_comment'),	
				);

		}
			$path = '../js/ckfinder';
			$width = '100%';
			$this->editor($path, $width);
			$this->data['page_head']= 'Add Jobs';
			$this->load->view('include/header');
			$this->load->view('jobprocess/addjob',$this->data);	
			$this->load->view('include/footer');
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

	function check_dups_username()
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
			
	function edit($id=null)
	{

		$data['page_head']= 'Edit Jobs';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		$this->load->model('countrymodel');
		$this->load->model('candidateallmodel');
			
		$data["company"] = $this->jobprocessmodel->fill_company();
		$data["jobindustry"] = $this->jobprocessmodel->fill_jobindustry();
		$data["jobcategory"] = $this->jobprocessmodel->fill_jobcategory();
		$data["functional"] = array('' => 'Select Functional Role');

		$data["education"] = $this->jobprocessmodel->fill_education();
		$data["salary"] = $this->jobprocessmodel->fill_salary();
		$data["worklevel"]= $this->jobprocessmodel->fill_worklevel();
		$data["nationality"] = $this->countrymodel->country_list();
		$data["jobtype"] = $this->jobprocessmodel->jobtype_list();
		$data['skill_list']=$this->jobprocessmodel->get_parent_skills();
		$data['cerifications']=$this->jobprocessmodel->get_cert();
		$data['domain']=$this->jobprocessmodel->get_domain();
		
		$data['page_head']= 'Edit Jobs';
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$data['formdata']=$query->row_array();
		if($data['formdata']['job_cat_id'] !=0)
		{
			$data["functional"] = $this->jobprocessmodel->function_list_by_category($data['formdata']['job_cat_id']);
		}
		if($data['formdata']['job_skills'] !=0)
		{
		 $data['childskill']=$this->jobprocessmodel->get_child_skills($data['formdata']['job_skills']);
		}
		//Job Certification details
		
		$job_certifications = $this->jobprocessmodel->get_certification_details($id);		
		$cerifications=array();
			
			foreach($job_certifications as $cert)
			{
				$cerifications[]=$cert['cert_id'];
			}
		$data['job_certifications']	=	$cerifications;
		
		//Job Skill details
				
		$job_skill = $this->jobprocessmodel->get_skill_details($id);		
		$skills = array();
			
			foreach($job_skill as $skill)
			{
				$skills[]=$skill['skill_id'];
			}
			
		$data['job_skills']	=	$skills;
		
		//Job Domain Knowledge
		$job_domain = $this->jobprocessmodel->get_domain_details($id);		
		$domain=array();
			
			foreach($job_domain as $dom)
			{
				$domain[]=$dom['domain_id'];
			}
		$data['job_domain']	=	$domain;
		
		
		$path = '../js/ckfinder';
			$width = '100%';
			$this->editor($path, $width);
			$this->load->view('include/header');
			$this->load->view('jobprocess/editjob',$data);	
			$this->load->view('include/footer');
	}	

	function copy_job($id=null)
	{
		if($id=='')redirect('jobprocess/');
		$this->data['page_head']= 'Copy Jobs';
		$this->data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		$id=$this->jobprocessmodel->copy_job($id);		
		redirect('jobprocess/edit/'.$id);
	}	
		
	function update(){
		$id = $this->input->post('job_id');
		$data['page_head']= 'Edit Jobs';
		$data['upload_root']=$this->config->item('base_url');
	
		$this->load->model('jobprocessmodel');
		$this->load->model('countrymodel');
		if(!empty($id))
		{
			if($this->input->post('job_title') && $this->input->post('comapny_id') == 0)
			{
				$this->form_validation->set_rules('job_title', 'job name', 'required');
				$this->form_validation->set_rules('company_id', 'company name', 'required');
				//$this->form_validation->set_rules('job_title_dup', 'job name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('jobprocessmodel');
						$id=$this->jobprocessmodel->update_record($id);
						$job_cert=$this->jobprocessmodel->insert_cert_details($this->input->post('job_id'));
						$job_skill=$this->jobprocessmodel->insert_skill_details($this->input->post('job_id'),$this->input->post('parent'));
						$job_domain=$this->jobprocessmodel->insert_domain_details($this->input->post('job_id'),$this->input->post('domain_id'));
						redirect('jobprocess/?update=1');
					}else
					{
						$data['formdata']=array(
						'job_priority'        => $this->input->post('job_priority') ,
						'job_id'              => $this->input->post('job_id'),
						'job_title'           => $this->input->post('job_title') ,
						'company_id'          => $this->input->post('company_id') ,
						'job_desc'            => $this->input->post('job_desc') ,
						'job_cat_id'          => $this->input->post('job_cat_id') ,
						'job_cat_id'          => $this->input->post('job_cat_id') ,
						'func_id'             => $this->input->post('func_id') ,
						'job_type_id'         => $this->input->post('job_type_id'),
						'job_type_id'         => $this->input->post('job_type_id'),
						'job_location'        => $this->input->post('job_location'),
						'res_location'        => $this->input->post('res_location') ,
						'vacancies'           => $this->input->post('vacancies') ,
						'job_post_date'       => $this->input->post('job_post_date') ,
						'job_expiry_date'     => $this->input->post('job_expiry_date'),
						'desired_profile'     => $this->input->post('desired_profile') ,
						'brochure'            => $this->input->post('brochure'),
						'level_id'            => $this->input->post('level_id'),
						'gender'              => $this->input->post('gender'),
						'about_company'       => $this->input->post('about_company'),
						'job_contact'         => $this->input->post('job_contact'),
						'salary_id'           => $this->input->post('salary_id'),
						'exp_join_date'       => $this->input->post('exp_join_date'),
						'job_keywords'        => $this->input->post('job_keywords'),
						'job_skills'          => $this->input->post('parent'),
						'work_level_id'       => $this->input->post('work_level_id'),
						'exp_join_date'       => $this->input->post('exp_join_date'),
						'contact_name'        => $this->input->post('contact_name'),
						'contact_designation' => $this->input->post('contact_designation'),
						'contact_email'       => $this->input->post('contact_email'), 
						'contact_phone'       => $this->input->post('contact_phone'),
						'contact_website'     => $this->input->post('contact_website'),
						'country_id'          => $this->input->post('country_id'),
						'facebook'            => $this->input->post('facebook'),
						'twitter'             => $this->input->post('twitter'),
						'googleplus'          => $this->input->post('googleplus'),
						'linkedin'            => $this->input->post('linkedin'),
						'social_title'        => $this->input->post('social_title'),	
						'social_content'      => $this->input->post('social_content'),	
						'social_link'         => $this->input->post('social_link'),	
						'social_link_image'   => $this->input->post('social_link_image'),	
						'social_comment'      => $this->input->post('social_comment'),	
						);
					}
			}
			else
			{
				redirect('jobprocess');
			}	
		}	
		else
			{
				redirect('jobprocess');
			}	
	}
	
	function assign_requirement()
	{
		$this->load->model('jobprocessmodel');
		

		$output_str='<table width="100%" border="1" cellpadding="3" cellspacing="3">
			  <tbody><tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">Recrutiers List</td></tr><tr><td colspan="3">&nbsp;</td></tr>';
			  
			  $this->data["records"]=array();
			  $this->data["records"] = $this->jobprocessmodel->get_assignment_recruiter($this->input->post('job_id'));

			  $output_str='<tr>
				  <td width="10%">#</td>
				  <td width="90%">Recrutier Name</td>
				  </tr>';
				  
				 if(count($this->data["records"]>0))
				 {
					 $i=0;
					 foreach($this->data["records"] as $key => $val)
					 {
						$i+=1;
						$output_str.='<tr>';					
						if($val['job_id']!='')	
							$output_str.='<td><input type="checkbox" name="admin_id[]" value="'.$key.'" checked></td>';
						else
							$output_str.='<td><input type="checkbox" name="admin_id[]" value="'.$key.'"></td>';
							
						$output_str.='<td width="90%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$val['username'].'</td>';
						$output_str.='</tr>';
					 }
				 }

			$output_str.='<tr><td colspan="3">&nbsp;</td></tr><tr><td colspan="3">Vendors List</td></tr><tr><td colspan="3">&nbsp;</td></tr>';
			  
			  $this->data["records"]=array();
			  
			  $this->data["records"] = $this->jobprocessmodel->get_assignment_vendor($this->input->post('job_id'));
			  
			  $output_str.='<tr>
				  <td width="10%">#</td>
				  <td width="90%">Vendor Name</td>
				  </tr>';
				  
				 if(count($this->data["records"]>0))
				 {
					 $i=0;
					 foreach($this->data["records"] as $key => $val)
					 {
						$i+=1;
						$output_str.='<tr>';						
						if($val['job_id']!='')	
							$output_str.='<td><input type="checkbox" name="vendor_id[]" value="'.$key.'" checked></td>';
						else
							$output_str.='<td><input type="checkbox" name="vendor_id[]" value="'.$key.'"></td>';

						$output_str.='<td width="90%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$val['username'].'</td>';
						$output_str.='</tr>';
					 }
				 }			  	 
			$output_str.='</tbody></table>';
			
		echo $output_str;
		exit();
	}
	
	function save_assignment()
	{
		$this->load->model('jobprocessmodel');
		
		$response=array(
						'success'            => 'false',
						); 	
		$job_details= $this->jobprocessmodel->get_job($this->input->post('job_id'));
				
		if($this->input->post('job_id')!='')
		{
				if($this->input->post('admin_id')!='')
				{
					// add admin id - 
					foreach($this->input->post('admin_id') as $key => $val)
					{
						 $val = $this->jobprocessmodel->add_recruiter_to_job($this->input->post('job_id'),$val);
					}
				}
				
				if($this->input->post('vendor_id')!='')
				{
					// add admin id - 
					foreach($this->input->post('vendor_id') as $key => $val)
					{
						if($this->jobprocessmodel->check_vendor_asigned($this->input->post('job_id'),$val)==0)
						{
							 $this->jobprocessmodel->add_vendor_to_job($this->input->post('job_id'),$val);
							 $vendor_details= $this->jobprocessmodel->get_vendor($val);							 
							 $this->email_vendor($vendor_details['email'],$vendor_details['firstname'],$job_details['job_title']);
						}
					}
				}
				
			$response=array(
						'status'            => 'success',
						); 	
    		header('Content-type: application/json');    					
			echo json_encode($response);				
		}
	}

	function email_vendor($email_to,$email_to_name,$job_title)
	{
			
			$data_array=array();
			
			if($email_to=='')$email_to=$this->config->item('email_from');
			if($email_to_name=='')$email_to=$this->config->item('email_reply_to_name');
			
			$email_subject='Invitation to new job';
			
			$email_text='You are invited to process job - '.$job_title ;
			$data_array='Please contact us if you have any questions.';
			
			$email_array=array(
				'email_to'               =>  $email_to,
				'email_to_name'          =>  $email_to_name,
				'email_cc'               =>  '',
				'email_from'             =>  $this->config->item('email_from'),
				'from_name'              =>  $this->config->item('from_name'),
				'email_reply_to'         =>  $this->config->item('email_reply_to'),
				'email_reply_to_name'    =>  $this->config->item('email_reply_to_name'),
				'subject'                =>  $email_subject,
				'salutation'             =>  $this->config->item('salutation'),
				'table_head'             =>  $this->config->item('table_head'),
				'text_before_table'      =>  $email_text,
				'table_rows'             =>  $data_array,
				'text_after_table'       =>  $this->config->item('text_after_table'),					
				'signature_name'         =>  $this->config->item('signature_name'),
				'signature'              =>  $this->config->item('signature'),
				'powered_by'             =>  $this->config->item('powered_by'),
				'powered_by_address'     =>  $this->config->item('powered_by_address'),
				'powered_by_phone'       =>  $this->config->item('powered_by_phone'),
				'powered_by_email'       =>  $this->config->item('powered_by_email'),
				'powered_by_web'         =>  $this->config->item('powered_by_web'),
				'date'                   =>  date('Y-m-d'),
				'email_template'         =>  'jobprocess/email_template_vendor',
			);
			
			$this->send_email($email_array);
			return 0;
	}
		
	// job summary page
	function manage($id=null)
	{

		$this->data['current_head']='summary';
		$this->data['page_head']= 'View Details';
		$this->data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		$this->load->model('countrymodel');
		$this->load->model('companymodel');
		$this->load->model('jobindmodel');
		$this->load->model('jobcatmodel');
		$this->load->model('jobareamodel');
		
		$this->load->model('jobtypemodel');
		$this->load->model('worklevelmodel');
		$this->load->model('levelmodel');
		$this->load->model('salarymodel');
		$this->load->model('skill_mgmt_model');

		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if(!empty($id))
		{
			$this->data['page_head']= 'Manage Job';
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$this->data['formdata']=$query->row_array();

			$this->data['formdata']['company_name']=$this->companymodel->get_company_name($this->data['formdata']['company_id']);
			$this->data['formdata']['industry']=$this->jobindmodel->get_industry_name($this->data['formdata']['job_cat_id']);
			$this->data['formdata']['category']=$this->jobcatmodel->get_category_name($this->data['formdata']['job_cat_id']);
			$this->data['formdata']['fun_area']=$this->jobareamodel->get_fun_area($this->data['formdata']['func_id']);
			
			$this->data['formdata']['job_type']=$this->jobtypemodel->get_job_type($this->data['formdata']['job_type_id']);
			$this->data['formdata']['job_level']=$this->levelmodel->get_level_name($this->data['formdata']['level_id']);
			$this->data['formdata']['work_level']=$this->worklevelmodel->get_work_level($this->data['formdata']['work_level_id']);	
			$this->data['formdata']['salary_level']=$this->salarymodel->get_salary_range($this->data['formdata']['salary_id']);
			
			$this->data['formdata']['country_name']=$this->countrymodel->get_country_name($this->data['formdata']['country_id']);
			$this->data['formdata']['skill']=$this->skill_mgmt_model->get_skill_name($this->data['formdata']['job_skills']);
			
			$this->data['applied_candidates']=$this->jobprocessmodel->get_candidate_list($id);
			$this->data['job_change_list']=$this->jobprocessmodel->job_change_list($id);
				
			$this->data['rejected_candidates']=$this->jobprocessmodel->rejected_candidates($id);
		
			$this->data['doc_verification_candidates']=$this->jobprocessmodel->doc_verification_candidates($id);
		
			$this->data['shortlisted']=$this->jobprocessmodel->get_shortlisted($id);

			$this->data['interview_list']=$this->jobprocessmodel->get_interview_list($id);
			$this->data['interview_history']=$this->jobprocessmodel->get_interview_history($id);
			
			$this->data['interview_rejection_list']=$this->jobprocessmodel->get_interview_rejection_list($id);
			//print_r($this->data['interview_history']);
			//exit();
	
			$this->data['candidates_selected']=$this->jobprocessmodel->candidates_selected($id);
			$this->data['offer_letters_issued']=$this->jobprocessmodel->offer_letters_issued($id);
			$this->data['offer_accepted']=$this->jobprocessmodel->offer_accepted($id);
			
			$this->data['invoice_generated']=$this->jobprocessmodel->invoice_generated($id);

			$this->data['invoice_list2']=$this->jobprocessmodel->invoice_generated($id);
			
			$this->data['interview_time_ar']=array(
						'7:00 AM' => '7:00 AM',
						'7:30 AM' => '7:30 AM',
						'8:00 AM' => '8:00 AM',
						'8:30 AM' => '8:30 AM',
						'9:00 AM' => '9:00 AM',
						'9:30 AM' => '9:30 AM',
						'10:00 AM' => '10:00 AM',
						'10:30 AM' => '10:30 AM',
						'11:00 AM' => '11:00 AM',
						'11:30 AM' => '11:30 AM',
						'12:00 PM' => '12:00 PM',
						'12:30 PM' => '12:30 PM',
						'1:00 PM' => '1:00 PM',
						'1:30 PM' => '1:30 PM',
						'2:00 PM' => '2:00 PM',
						'2:30 PM' => '2:30 PM',
						'3:00 PM' => '3:00 PM',
						'3:30 PM' => '3:30 PM',
						'4:00 PM' => '4:00 PM',
						'4:30 PM' => '4:30 PM',
						'5:00 PM' => '5:00 PM',
						'5:30 PM' => '5:30 PM',
						'6:00 PM' => '6:00 PM',
						'6:30 PM' => '6:30 PM',
						'7:00 PM' => '7:00 PM');

		
		$this->data["interview_type"] = $this->interviewtypemodel->get_type_list();
		$this->data["int_status_id"] = $this->interviewstatusmodel->get_model_list();
		
		$this->data["start_date"]= date('Y-m-d', strtotime($this->data["formdata"]['job_post_date'] .'- 30 days'));
		$this->data["end_date"]=date('Y-m-d', strtotime($this->data["formdata"]['job_expiry_date'] .'+ 30 days'));
		
		$this->data["contracts_ending"]=$this->jobprocessmodel->contracts_ending($id,$this->data["start_date"],$this->data["end_date"]);
		
			$this->load->view('include/header');
			//$this->load->view('include/job_sidebar',$this->data);
			$this->load->view('jobprocess/summary',$this->data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('jobprocess');
		}
	}

	function reject_interview()
	{
		$id     = $this->input->get('job_app_id');
		$c_id   = $this->input->get('candidate_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobprocessmodel');		
		
		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$result = $this->db->query(' SELECT * FROM pms_job_apps_selected WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")')->result();
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);
					header('Content-type: application/json');    					
					echo json_encode($response);
			}			
			else
			{
				$data=array(
					'reject_reason_id' => $this->input->post('reject_reason_id'),
					'reject_notes'     => $this->input->post('reject_notes'),
					'rejected_on'      => $this->input->post('rejected_on'),
					'interview_id'     => $this->input->post('interview_id'),					
					'job_app_id'	   => $this->input->post('job_app_id'),
					'candidate_id'     => $this->input->post('candidate_id'),
					);					
					$this->jobprocessmodel->reject_interview($data);					
					$response = array(
						'data' => '',
						'status'=>'success',
					);
					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}		
	}
		
	function add_to_shortlist()
	{
		$id = $this->input->get('job_id');
		$this->load->model('jobprocessmodel');
		$response=array(
						'status'            => 'failed',
						); 	
		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$data=array(
				'app_id'                => $this->input->post('job_app_id'),
				'candidate_id'          => $this->input->post('candidate_id'),
				'short_date'            => date('Y-m-d'),
				'feedback_education'    => $this->input->post('feedback_education'),
				'feedback_industry'     => $this->input->post('feedback_industry'),
				'feedback_skills'       => $this->input->post('feedback_skills'),
				'feedback_salary'       => $this->input->post('feedback_salary'),
				'feedback_general'      => $this->input->post('feedback_general'),
				'admin_id'              => $_SESSION['admin_session']
			);
			
			$this->jobprocessmodel->add_to_shortlist($data,$this->input->post('candidate_id'),$this->input->post('job_app_id'));
			$response=array(
						'status'            => 'success',
						); 	
    		header('Content-type: application/json');    					
			echo json_encode($response);
			exit();
		}else
		{
			header('Content-type: application/json');    					
			echo json_encode($response);
			exit();
		}
	}
	
	// Manage Summary & Reports
	function candidate_profile($candidate_id)
	{
		
		$this->data['candidate_id']=$candidate_id;
		
		$this->load->model('candidateallmodel');
		$this->load->model('countrymodel');
		
		$this->data["formdata"] = $this->candidateallmodel->get_single_record($candidate_id);
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		$this->data['candidate_languages'] = $this->candidateallmodel->candidate_languages($candidate_id);
		$this->data['education_details'] = $this->candidateallmodel->education_deatils($candidate_id);
		
		$this->data['job_history'] = $this->candidateallmodel->job_list($candidate_id);
		$this->data['followup_history'] = $this->candidateallmodel->get_followup_detail($candidate_id);
		
		$this->data['all_calls'] = $this->candidateallmodel->all_calls($candidate_id);
		$this->data['all_messages'] = $this->candidateallmodel->all_messages($candidate_id);
		$this->data['all_notes'] = $this->candidateallmodel->all_notes($candidate_id);
	
		$this->data['candidate_skill'] = $this->candidateallmodel->candidate_skills($candidate_id);
		
		//candidate doamin knowledge
		$this->data['candidate_domain'] = $this->candidateallmodel->candidate_domains($candidate_id);
		//Certification 
		
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
		$candidate_certifications =$this->candidateallmodel->candidate_languages($candidate_id);
		
		$languages=array();
		foreach($candidate_certifications as $lang)
		{
			$languages[]=$lang['lang_id'];
		}
		$this->data['candidate_language']	=	$languages;
		
		//Edit Education Modal
		
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

		//present contract details
		$this->data['contract']=$this->candidateallmodel->get_contract_detail($candidate_id);
		//category 
	
		$category = $this->candidateallmodel->get_cat_fun_list($candidate_id);
		
		$cat_list=array();
		
		foreach($category as $cat)
		{
			$cat_list[]=$cat['job_cat_id'];
		}
		$this->data['category_list']	=	$cat_list;
		$this->data['category_name']	=	$category;
		
		// funcional area
		$function = $this->candidateallmodel->get_cat_fun_list($candidate_id);
		
		$fun_list=array();
		foreach($function as $fun)
		{
			$fun_list[]=$fun['func_id'];
		}
		$this->data['function_list']	=	$fun_list;
		$this->data['function_name']	=	$function;
		//primary_skills
		$candidate_skills_primary = $this->candidateallmodel->candidate_skills_primary($candidate_id);
		
		$skills_primary=array();
		foreach($candidate_skills_primary as $skill)
		{
			$skills_primary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_primary']	=	$skills_primary; 
		
		$this->data['skills_primary']	        =	$candidate_skills_primary;
		$candidate_skills_secondary = $this->candidateallmodel->candidate_skills_secondary($candidate_id);
		
		$skills_secondary=array();
		foreach($candidate_skills_secondary as $skill)
		{
			$skills_secondary[]=$skill['skill_id'];
		}
		$this->data['candidate_skills_secondary']	=	$skills_secondary;
		
		$this->data['skills_secondary']	            =	$candidate_skills_secondary;

		$this->data['lang_details'] = $this->candidateallmodel->get_lang_details($candidate_id);
		
		$this->load->view("jobprocess/candidate_summary",$this->data);
	}
	
	function send_shortlisted()
	{
		$id = $this->input->post('job_id');
		$this->load->model('jobprocessmodel');		

		if($this->input->post('job_id')!='' && is_array($this->input->post('short_id')))
		{		
			$this->db->where('job_id', $this->input->post('job_id'));
			$query=$this->db->get('pms_jobs');
			$job_details=$query->row_array();

			if($this->input->post('email_subject')!='')
			{
				$email_subject   =$this->input->post('email_subject').' - '.$job_details['job_title'];			
			}else
			{
				$email_subject   ='Short Listed Candidates for job '.' - '.$job_details['job_title'];			
			}
			
			if($this->input->post('email_text')!='')
			{
				$email_text =$this->input->post('email_text');			
			}else
			{
				$email_text='Here is the list of matching candidate profiles for - '.$job_details['job_title'].', see below list.'	;	
			}	
						
			if($this->input->post('email_cc')!='')
			{
				$email_cc =$this->input->post('email_cc');			
			}else
			{
				$email_cc='';	
			}
			
			$short_id=$string=implode(",",$this->input->post('short_id'));;
			$list_shortlisted=$this->jobprocessmodel->get_shortlisted_client($this->input->post('job_id'),$short_id);
					
			$data_array=array();
			
			foreach($list_shortlisted as $key => $val)
			{
				$cv_hash=md5($val['candidate_id'].$val['job_app_id'].$val['short_id']);
				$email_url='select_applicant/client_feedback?ai='.md5($val['job_app_id']).'&ci='.md5($val['candidate_id']).'&si='.md5($val['short_id']);
				$email_to='';
				$email_to_name='';
				
				$data_array[]=array(
					'candidate_name'    =>  $val['first_name'].' '.$val['last_name'],
					'total_exp'         =>  $val['exp_years'],
					'current_ctc'       =>  $val['current_ctc'],
					'expected_ctc'      =>  $val['expected_ctc'],
					'notice_period'     =>  $val['notice_period'],
					'cv_url'            => '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/select_applicant/profile?view='.$cv_hash.'" target="_blank">View</a>',
					'accept_url'        => '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/'.$email_url.'&cf=1" target="_blank">Accept</a>',					
					'not_skilled'        =>    '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/'.$email_url.'&cf=2" target="_blank">Not Skilled</a>',
					'not_qualified'         =>    '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/'.$email_url.'&cf=3" target="_blank">Not Qualified</a>',
					'no_experience'           =>   '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/'.$email_url.'&cf=4" target="_blank">No Exp.</a>',
					'no_domain_exp'       =>    '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/'.$email_url.'&cf=5" target="_blank">No Domain Exp</a>',		
					'reject_url'        => '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/'.$email_url.'&cf=6" target="_blank">Reject</a>',						
					); 
					
			}
			
			$email_to='';
			$email_to_name='';
			
			if($email_to=='')$email_to=$this->config->item('email_from');
			if($email_to_name=='')$email_to=$this->config->item('email_reply_to_name');
			
			$email_array=array(
				'email_to'               =>  $email_to,
				'email_to_name'          =>  $email_to_name,
				'email_cc'               =>  $email_cc,
				'email_from'             =>  $this->config->item('email_from'),
				'from_name'              =>  $this->config->item('from_name'),
				'email_reply_to'         =>  $this->config->item('email_reply_to'),
				'email_reply_to_name'    =>  $this->config->item('email_reply_to_name'),
				'subject'                =>  $email_subject,
				'salutation'             =>  $this->config->item('salutation'),
				'table_head'             =>  $this->config->item('table_head'),
				'text_before_table'      =>  $email_text,
				'table_rows'             =>  $data_array,
				'text_after_table'       =>  $this->config->item('text_after_table'),					
				'signature_name'         =>  $this->config->item('signature_name'),
				'signature'              =>  $this->config->item('signature'),
				'powered_by'             =>  $this->config->item('powered_by'),
				'powered_by_address'     =>  $this->config->item('powered_by_address'),
				'powered_by_phone'       =>  $this->config->item('powered_by_phone'),
				'powered_by_email'       =>  $this->config->item('powered_by_email'),
				'powered_by_web'         =>  $this->config->item('powered_by_web'),
				'date'                   =>  date('Y-m-d'),
				'email_template'         =>  'jobprocess/email_template_shortlisted',
			);

			// EMAIL TO ADMIN
			$this->send_email($email_array);

			$list_shortlisted=$this->jobprocessmodel->update_shortlisted_status($short_id);
			// email ending here 
			$response=array(
						'status'            => 'success',
						); 	
    		header('Content-type: application/json');    					
			echo json_encode($response);
			exit();
		}else
		{
				$response=array(
						'status'            => 'failed',
						); 	
				header('Content-type: application/json');
				echo json_encode($response);
				exit();
		}
	}
	
	function changestat($id=null)
	{
		if($id=='')redirect('jobprocess');
		if($this->input->get('job_status')=='')redirect('jobprocess');
		$this->db->query("update pms_jobs set job_status=".$this->input->get('job_status')." where job_id=".$id);
		redirect('jobprocess?job_status=1');
	}
	
	function active_seekers($id=null)
	{

		$this->data['current_head']='summary';
		$this->data['page_head']= 'View Details';
		$this->data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		$this->load->model('countrymodel');
		$this->load->model('companymodel');
		$this->load->model('jobindmodel');
		$this->load->model('jobcatmodel');
		$this->load->model('jobareamodel');
		
		$this->load->model('jobtypemodel');
		$this->load->model('worklevelmodel');
		$this->load->model('levelmodel');
		$this->load->model('salarymodel');
		$this->load->model('skill_mgmt_model');

		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if(!empty($id))
		{
			
			$this->data['page_head']= 'Manage Job';
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$this->data['formdata']=$query->row_array();
			
			$this->data['formdata']['company_name']=$this->companymodel->get_company_name($this->data['formdata']['company_id']);
			$this->data['formdata']['industry']=$this->jobindmodel->get_industry_name($this->data['formdata']['job_cat_id']);
			$this->data['formdata']['category']=$this->jobcatmodel->get_category_name($this->data['formdata']['job_cat_id']);
			$this->data['formdata']['fun_area']=$this->jobareamodel->get_fun_area($this->data['formdata']['func_id']);
			
			$this->data['formdata']['job_type']=$this->jobtypemodel->get_job_type($this->data['formdata']['job_type_id']);
			$this->data['formdata']['job_level']=$this->levelmodel->get_level_name($this->data['formdata']['level_id']);
			$this->data['formdata']['work_level']=$this->worklevelmodel->get_work_level($this->data['formdata']['work_level_id']);	
			$this->data['formdata']['salary_level']=$this->salarymodel->get_salary_range($this->data['formdata']['salary_id']);
			
			$this->data['formdata']['country_name']=$this->countrymodel->get_country_name($this->data['formdata']['country_id']);
			$this->data['formdata']['skill']=$this->skill_mgmt_model->get_skill_name($this->data['formdata']['job_skills']);
			
			$this->data['active_seekers']=$this->jobprocessmodel->active_seekers($id);
	
		
			$this->data["interview_type"] = $this->interviewtypemodel->get_type_list();
			$this->data["int_status_id"] = $this->interviewstatusmodel->get_model_list();
			
			$this->data["start_date"]= date('Y-m-d', strtotime($this->data["formdata"]['job_post_date'] .'- 30 days'));
			$this->data["end_date"]=date('Y-m-d', strtotime($this->data["formdata"]['job_expiry_date'] .'+ 30 days'));
			
			$this->data["contracts_ending"]=$this->jobprocessmodel->contracts_ending($id,$this->data["start_date"],$this->data["end_date"]);
		
			$this->load->view('include/header');
			$this->load->view('include/job_sidebar',$this->data);
			$this->load->view('jobprocess/active_seekers',$this->data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('jobprocess');
		}
	}
	
// upcoming contracts
	function upcoming_contracts($id=null)
	{
		if($id=='')redirect('jobprocess');
		$this->load->model('jobprocessmodel');

		if(is_array($this->input->post('candidate_id')) && $this->input->post('job_id')!='' && $this->input->post('add_to_job')=='1')
		{
			$this->jobprocessmodel->addcandidate($this->input->post('candidate_id'),$this->input->post('job_id'));
			redirect('jobprocess/addcandidate/'.$this->input->post('job_id'));
		}
		
		if(is_array($this->input->post('candidate_id')) && $this->input->post('job_id')!='' && $this->input->post('invite_to_job')=='1')
		{			
			foreach ($this->input->post('candidate_id') as $key => $val)
 			{
				$this->db->where('job_id', $this->input->post('job_id'));
				$query=$this->db->get('pms_jobs');
				$job_details =$query->row_array();
				
				$this->db->where('candidate_id', $val);
				$query=$this->db->get('pms_candidate');
				$candidate_details =$query->row_array();			
				
				$subject=' Your Application Received for job - '.$job_details['job_title'];
				$email_content=$job_details['job_desc'];		
				$email_md_hash=md5($candidate_details['candidate_id'].$job_details['job_id']);
				$email_url='job_application?job_id='.$email_md_hash;
			
				$data = array(
					'candidate_id'          => $candidate_details['candidate_id'],
					'candidate_name'        => $candidate_details['first_name'],
					'job_id'                => $job_details['job_id'],
					'email'                 => $candidate_details['username'],
					'subject'               => $subject,
					'email_content'         => $email_content,
					'date_sent'             => date('Y-m-d'),
					'email_status'          => 1,
					'email_opened'          => 0,
					'date_opened'           => '',
					'date_filled'           => '',
					'email_md_hash'         => $email_md_hash,
					'base_email_url'        => $this->config->item('base_email_url'),
					'email_url'             => $this->config->item('base_email_url').'index.php/'.$email_url,
				);
		
				$email_id=$this->jobprocessmodel->send_jd($data);
				// take email data back from database.
				$email_jd=$this->jobprocessmodel->get_email_jd($email_id);
				
				$this->db->where('job_id', $email_jd['job_id']);
				$query=$this->db->get('pms_jobs');
				$job_details =$query->row_array();
				// send email
			
				$data_array=array(
					'Job Title:'          =>  $job_details['job_title'],
					'Total Vacancies:'    =>  $job_details['vacancies'],
					'Job Details:'        =>  $job_details['job_desc'],
					'Job Post Date:'      =>  $job_details['job_post_date'],
					'Expected Join Date:' =>  $job_details['exp_join_date'],
					'Vacancies:'          =>  $job_details['vacancies'],
					'Apply From:'        => '<a style="color:#000" href="'.$email_jd['email_url'].'" target="_blank">Click Here to Apply</a>',
									); 
														
				$email_array=array(
					'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
					'email_to_name'          =>  'Shyjo',
					'email_cc'               =>  '',
					'email_from'             =>  'shyjo@logicsoftonline.com',
					'from_name'              =>  'Logic Soft',
					'email_reply_to'         =>  'shaijotm@gmail.com',
					'email_reply_to_name'    =>  'Shyjo Mathew',
					'subject'                =>   $email_jd['email_content'],
					'salutation'             =>  'Dear '.$email_jd['candidate_name'].',',
					'table_head'             =>  'Job Opening',
					'text_before_table'      =>  'We have an opening for '.$job_details['job_title'].', see below details.',
					'table_rows'             =>  $data_array,
					'text_after_table'       =>  '---------------------------------',					
					'signature_name'         =>  'Logic Soft Consultancy Services',
					'signature'              =>  '',
					'date'                   =>  date('Y-m-d'),
					'email_template'         =>  'jobprocess/email_template',
				);
			// EMAIL TO ADMIN
				$this->send_email($email_array);
				redirect('jobprocess/addcandidate/'.$this->input->post('job_id'));
			}
		
		}
		
		$this->data['page_head']= 'Add Candidates';
		
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		$this->load->model('coursemodel');
		$this->load->model('countrymodel');
		$this->load->model('companymodel');
		$this->load->model('jobcatmodel');
		$this->load->model('jobareamodel');
		
		$this->load->model('jobtypemodel');
		$this->load->model('worklevelmodel');
		$this->load->model('levelmodel');
		$this->load->model('salarymodel');
			
		$this->load->model('candidatemodel');	
		$this->load->model('candidateallmodel');

		$this->data['upload_root']=$this->config->item('base_url');		
		$this->data['current_head']= 'add_candidate';		
		$this->data["postdata"]["skills"]='';
		$this->data["postdata"]["cert"]='';
		$this->data["postdata"]["level_id"]='';
		$this->data["postdata"]["course_id"]='';
		$this->data["postdata"]["spcl_id"]='';
		$this->data["postdata"]["exp_years"]='';
		$this->data["postdata"]["exp_months"]='';
		$this->data["postdata"]["contract_start_date"]='';
		$this->data["postdata"]["contract_end_date"]='';

		$this->data['start']=0;
		$this->data['limit']=50;

		// loading master/drop downs for filter
		$this->data["education"] = $this->jobprocessmodel->fill_education();
		$this->data['cerifications']=$this->jobprocessmodel->get_cert();

		$this->data['skill_list']=$this->candidateallmodel->get_parent_skills();
				
		//Education details
		$this->data["edu_level_list"] = $this->candidateallmodel->edu_level_list();
		$this->data["edu_course_list"] = $this->candidateallmodel->edu_course_list();
		$this->data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();

		$query = $this->db->query('SELECT job_post_date,job_expiry_date from pms_jobs where job_id='.$id);
		$result=$query->row();		
		
		$this->data['start_date']= date('Y-m-d', strtotime($result->job_post_date .'- 30 days'));
		$this->data['end_date']= date('Y-m-d', strtotime($result->job_expiry_date .'+ 30 days'));
	
		// total count for paging
		$this->data["total_rows"]=$this->jobprocessmodel->get_filter_count($id);

		//paging starts here 
		$config['base_url'] = $this->config->item('base_url')."index.php/jobprocess/upcoming_contracts/".$id."/?";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data["total_rows"];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =50;
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
		// paging ends here 
			
		$this->data['formdata']['job_id'] =$id;
			
		if($this->input->get("rows")!='')
		{
			$this->data['start']=$this->input->get("rows");
		}

		if($this->input->get('limit')!='')
		{
			$this->data['limit']=$this->input->get("limit");
		}
		else
		{
			$this->data['limit'] =50;
		}					
			
		$this->data["candidates"]=$this->jobprocessmodel->get_filter_records($id,$this->data['start'],$this->data['limit']);
	
		$this->data["postdata"]["job_id"]=$id;

		$this->data["postdata"]["skills"]=$this->input->post('skills');
		$this->data["postdata"]["cert"]=$this->input->post('cert');
		$this->data["postdata"]["level_id"]=$this->input->post('level_id');
		$this->data["postdata"]["course_id"]=$this->input->post('course_id');
		$this->data["postdata"]["spcl_id"]=$this->input->post('spcl_id');
		$this->data["postdata"]["exp_years"]=$this->input->post('exp_years');
		$this->data["postdata"]["exp_months"]=$this->input->post('exp_months');
			
		if($this->input->post('contract_start_date')!='' && $this->input->post('contract_end_date')!='')
		{
			$this->data["postdata"]["contract_start_date"]=$this->input->post('contract_start_date');
			$this->data["postdata"]["contract_end_date"]=$this->input->post('contract_end_date');
		}

		if($this->data["postdata"]["level_id"] !='')
		{
			$this->data["edu_course_list"] = $this->coursemodel->get_course_list($this->data["postdata"]["level_id"],1);
		}
		else{
			$this->data["edu_course_list"]  = array('' => 'Select Course');
		}
		
		$certs=array();
		
		if($this->data["postdata"]["cert"]!='')
		{
			$this->data["postdata"]["cert"]	=	explode(',',$this->data["postdata"]["cert"]);
		}
		else
		{
			$this->data["postdata"]["cert"]	= array();
		}
		
		foreach($this->data["postdata"]["cert"] as $cert)
		{
			$certs[]=$cert;
		}
		$this->data['candidate_certifications']	=	$certs;
		
		$skills=array();		
		if($this->data["postdata"]["skills"]!='')
		{
			$this->data["postdata"]["skills"]	=	explode(',',$this->data["postdata"]["skills"]);
		}
		else
		{
			$this->data["postdata"]["skills"]	= array();
		}
		
		foreach($this->data["postdata"]["skills"] as $skill)
		{
			$skills[]=$skill;
		}
		
		$this->data['candidate_skills']	=	$skills;
		$this->data['res']	=	array();
		$this->data['res1']	=	array();
		
		if(!empty($skill))
		{
			$qry	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$skill);
			$this->data['res']	= $res	=	$qry->result_array();
			
			$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
			$this->data['res1']	= $res1 =	$qry1->result_array();
			
			$this->data['child_skills']	=	$this->candidateallmodel->get_child_skills($res1[0]['skill_id']);
		}
		
		$this->load->view('include/header');
		//$this->load->view('include/job_sidebar',$this->data);
		$this->load->view('jobprocess/upcoming_contracts',$this->data);	
		$this->load->view('include/footer');

	
	}

	// job summary page
	function suggestions($id=null)
	{

		$this->data['current_head']='summary';
		$this->data['page_head']= 'View Details';
		$this->data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		$this->load->model('countrymodel');
		$this->load->model('companymodel');
		$this->load->model('jobindmodel');
		$this->load->model('jobcatmodel');
		$this->load->model('jobareamodel');
		
		$this->load->model('jobtypemodel');
		$this->load->model('worklevelmodel');
		$this->load->model('levelmodel');
		$this->load->model('salarymodel');
		$this->load->model('skill_mgmt_model');

		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if(!empty($id))
		{
			
			$this->data['page_head']= 'Manage Job';
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$this->data['formdata']=$query->row_array();

			$this->data['formdata']['company_name']=$this->companymodel->get_company_name($this->data['formdata']['company_id']);
			$this->data['formdata']['industry']=$this->jobindmodel->get_industry_name($this->data['formdata']['job_cat_id']);
			$this->data['formdata']['category']=$this->jobcatmodel->get_category_name($this->data['formdata']['job_cat_id']);
			$this->data['formdata']['fun_area']=$this->jobareamodel->get_fun_area($this->data['formdata']['func_id']);
			
			$this->data['formdata']['job_type']=$this->jobtypemodel->get_job_type($this->data['formdata']['job_type_id']);
			$this->data['formdata']['job_level']=$this->levelmodel->get_level_name($this->data['formdata']['level_id']);
			$this->data['formdata']['work_level']=$this->worklevelmodel->get_work_level($this->data['formdata']['work_level_id']);	
			$this->data['formdata']['salary_level']=$this->salarymodel->get_salary_range($this->data['formdata']['salary_id']);
			
			$this->data['formdata']['country_name']=$this->countrymodel->get_country_name($this->data['formdata']['country_id']);
			$this->data['formdata']['skill']=$this->skill_mgmt_model->get_skill_name($this->data['formdata']['job_skills']);
			
			$this->data['suggestions_list']=$this->jobprocessmodel->get_candidate_suggestions($id);

		
		$this->load->view('include/header');
		$this->load->view('include/job_sidebar',$this->data);
		$this->load->view('jobprocess/suggestions',$this->data);	
		$this->load->view('include/footer');
		
		}else
		{
			redirect('jobprocess');
		}
	}
	
//INSTRUCTION AND GUIDE LINES

	function instructions($id=null)
	{

		$data['current_head']= 'instructions';
		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		$this->load->model('countrymodel');
		
		if(!empty($id))
		{
			$data['page_head']= 'Manage Job';
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$data['formdata']=$query->row_array();
			
			$data['row']=$this->countrymodel->get_country($data['formdata']['country_id']);
			
			$this->load->view('include/header');
			$this->load->view('jobprocess/instructions',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('jobprocess');
		}
	}

	// adding candidates jobs, sending invites etc.	
	function search_candidate($id=null)
	{
		if($id=='')redirect('jobprocess');
		$this->load->model('jobprocessmodel');

		if(is_array($this->input->post('candidate_id')) && $this->input->post('job_id')!='' && $this->input->post('add_to_job')=='1')
		{
			$this->jobprocessmodel->addcandidate($this->input->post('candidate_id'),$this->input->post('job_id'));
			redirect('jobprocess/search_candidate/'.$this->input->post('job_id'));
		}
		
		if(is_array($this->input->post('candidate_id')) && $this->input->post('job_id')!='' && $this->input->post('invite_to_job')=='1')
		{			
			foreach ($this->input->post('candidate_id') as $key => $val)
 			{
				$this->db->where('job_id', $this->input->post('job_id'));
				$query=$this->db->get('pms_jobs');
				$job_details =$query->row_array();
				
				$this->db->where('candidate_id', $val);
				$query=$this->db->get('pms_candidate');
				$candidate_details =$query->row_array();			
				
				$subject=' Your Application Received for job - '.$job_details['job_title'];
				$email_content=$job_details['job_desc'];		
				$email_md_hash=md5($candidate_details['candidate_id'].$job_details['job_id']);
				$email_url='job_application?job_id='.$email_md_hash;
			
				$data = array(
					'candidate_id'          => $candidate_details['candidate_id'],
					'candidate_name'        => $candidate_details['first_name'],
					'job_id'                => $job_details['job_id'],
					'email'                 => $candidate_details['username'],
					'subject'               => $subject,
					'email_content'         => $email_content,
					'date_sent'             => date('Y-m-d'),
					'email_status'          => 1,
					'email_opened'          => 0,
					'date_opened'           => '',
					'date_filled'           => '',
					'email_md_hash'         => $email_md_hash,
					'base_email_url'        => $this->config->item('base_email_url'),
					'email_url'             => $this->config->item('base_email_url').'index.php/'.$email_url,
				);
		
				$email_id=$this->jobprocessmodel->send_jd($data);
				// take email data back from database.
				$email_jd=$this->jobprocessmodel->get_email_jd($email_id);
				
				$this->db->where('job_id', $email_jd['job_id']);
				$query=$this->db->get('pms_jobs');
				$job_details =$query->row_array();
				// send email
			
				$data_array=array(
					'Job Title:'          =>  $job_details['job_title'],
					'Total Vacancies:'    =>  $job_details['vacancies'],
					'Job Details:'        =>  $job_details['job_desc'],
					'Job Post Date:'      =>  $job_details['job_post_date'],
					'Expected Join Date:' =>  $job_details['exp_join_date'],
					'Vacancies:'          =>  $job_details['vacancies'],
					'Apply From:'        => '<a style="color:#000" href="'.$email_jd['email_url'].'" target="_blank">Click Here to Apply</a>',
									); 

				$email_array=array(
					'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
					'email_to_name'          =>  'Shyjo',
					'email_cc'               =>  '',
					'email_from'             =>  $this->config->item('email_from'),
					'from_name'              =>  $this->config->item('from_name'),
					'email_reply_to'         =>  $this->config->item('email_reply_to'),
					'email_reply_to_name'    =>  $this->config->item('email_reply_to_name'),
					'subject'                =>   $email_jd['email_content'],
					'salutation'             =>  'Dear '.$email_jd['candidate_name'].',',
					'table_head'             =>  'Job Opening',
					'text_before_table'      =>  'We have an opening for '.$job_details['job_title'].', see below details.',
					'table_rows'             =>  $data_array,
					'text_after_table'       =>  '---------------------------------',					
					'signature_name'         =>  $this->config->item('signature_name'),
					'signature'              =>  $this->config->item('signature'),
					'date'                   =>  date('Y-m-d'),
					'email_template'         =>  'jobprocess/email_template',
				);
			// EMAIL TO ADMIN
				$this->send_email($email_array);
				redirect('jobprocess/search_candidate/'.$this->input->post('job_id'));
			}
		}
		
		$this->data['page_head']= 'Add Candidates';
		
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		$this->load->model('coursemodel');
		$this->load->model('countrymodel');
		$this->load->model('companymodel');
		$this->load->model('jobcatmodel');
		$this->load->model('jobareamodel');
		
		$this->load->model('jobtypemodel');
		$this->load->model('worklevelmodel');
		$this->load->model('levelmodel');
		$this->load->model('salarymodel');
			
		$this->load->model('candidatemodel');	
		$this->load->model('candidateallmodel');

		$this->data['upload_root']=$this->config->item('base_url');		
		$this->data['current_head']= 'add_candidate';		
		$this->data["postdata"]["job_cat_id"]='';
		$this->data["postdata"]["func_id"]='';
		$this->data["postdata"]["skills"]='';
		$this->data["postdata"]["cert"]='';
		$this->data["postdata"]["level_id"]='';
		$this->data["postdata"]["course_id"]='';
		$this->data["postdata"]["spcl_id"]='';
		$this->data["postdata"]["exp_years"]='';
		$this->data["postdata"]["exp_months"]='';
		$this->data["postdata"]["contract_start_date"]='';
		$this->data["postdata"]["contract_end_date"]='';

		$this->data['start']=0;
		$this->data['limit']=50;

		// loading master/drop downs for filter
		$this->data["jobcategory"] = $this->jobprocessmodel->fill_jobcategory();
		$this->data["functional"] = array('' => 'Select Functional Role');
		$this->data["education"] = $this->jobprocessmodel->fill_education();
		$this->data["salary"] = $this->jobprocessmodel->fill_salary();
		$this->data["worklevel"]= $this->jobprocessmodel->fill_worklevel();
		$this->data["nationality"] = $this->countrymodel->country_list();
		$this->data['cerifications']=$this->jobprocessmodel->get_cert();
		$this->data["interview_type"] = $this->interviewtypemodel->get_type_list();
		$this->data["int_status_id"] = $this->interviewstatusmodel->get_model_list();

		$this->data['skill_list']=$this->candidateallmodel->get_parent_skills();
				
		//Education details
		$this->data["edu_level_list"] = $this->candidateallmodel->edu_level_list();
		$this->data["edu_course_list"] = $this->candidateallmodel->edu_course_list();
		$this->data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
		$this->data["years_list"] = $this->candidateallmodel->years_list();
		$this->data["months_list"] = $this->candidateallmodel->months_list();
		$this->data["jobtype"] = $this->jobprocessmodel->jobtype_list();

		$query = $this->db->query('SELECT job_post_date,job_expiry_date from pms_jobs where job_id='.$id);
		$result=$query->row();		
		
		$this->data['start_date']= date('Y-m-d', strtotime($result->job_post_date .'- 30 days'));
		$this->data['end_date']= date('Y-m-d', strtotime($result->job_expiry_date .'+ 30 days'));
		$this->data['contracts_ending']=$this->jobprocessmodel->contracts_ending($id,$this->data['start_date'],$this->data['end_date']);	
		
		// total count for paging
		$this->data["total_rows"]=$this->jobprocessmodel->get_filter_count($id);

		//paging starts here 
		$config['base_url'] = $this->config->item('base_url')."index.php/jobprocess/search_candidate/".$id."/?";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data["total_rows"];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =50;
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
		// paging ends here 
			
		$this->data['formdata']['job_id'] =$id;
			
		if($this->input->get("rows")!='')
		{
			$this->data['start']=$this->input->get("rows");
		}

		if($this->input->get('limit')!='')
		{
			$this->data['limit']=$this->input->get("limit");
		}
		else
		{
			$this->data['limit'] =50;
		}					

		if($this->input->post('any_keywords')!='')
		{
			$this->data['any_keywords']=$this->input->post("any_keywords");
		}
		else
		{
			$this->data['any_keywords'] ='';
		}

		if($this->input->post('all_keywords')!='')
		{
			$this->data['all_keywords']=$this->input->post("all_keywords");
		}
		else
		{
			$this->data['all_keywords'] ='';
		}
	
		$this->data["candidates"]=$this->jobprocessmodel->get_filter_records($id,$this->data['start'],$this->data['limit']);
	
		$this->data["postdata"]["job_id"]=$id;
		$this->data["postdata"]["job_cat_id"]=$this->input->post('job_cat_id');
		$this->data["postdata"]["func_id"]=$this->input->post('func_id');
		$this->data["postdata"]["skills"]=$this->input->post('skills');
		$this->data["postdata"]["cert"]=$this->input->post('cert');
		$this->data["postdata"]["level_id"]=$this->input->post('level_id');
		$this->data["postdata"]["course_id"]=$this->input->post('course_id');
		$this->data["postdata"]["spcl_id"]=$this->input->post('spcl_id');
		$this->data["postdata"]["exp_years"]=$this->input->post('exp_years');
		$this->data["postdata"]["exp_months"]=$this->input->post('exp_months');
			
		if($this->data["postdata"]["level_id"] !='')
		{
			$this->data["edu_course_list"] = $this->coursemodel->get_course_list($this->data["postdata"]["level_id"],1);
		}
		else{
			$this->data["edu_course_list"]  = array('' => 'Select Course');
		}
		
		if($this->data["postdata"]["func_id"] !='')
		{
			$this->data["functional"] = $this->jobprocessmodel->function_list_by_category($this->data["postdata"]["job_cat_id"]);
		}
		else{
			$this->data["functional"]  = array('' => 'Select Functional Role');
		}
	
		$certs=array();
		
		if($this->data["postdata"]["cert"]!='')
		{
			$this->data["postdata"]["cert"]	=	explode(',',$this->data["postdata"]["cert"]);
		}
		else
		{
			$this->data["postdata"]["cert"]	= array();
		}
		
		foreach($this->data["postdata"]["cert"] as $cert)
		{
			$certs[]=$cert;
		}
		$this->data['candidate_certifications']	=	$certs;
		
		$skills=array();		
		if($this->data["postdata"]["skills"]!='')
		{
			$this->data["postdata"]["skills"]	=	explode(',',$this->data["postdata"]["skills"]);
		}
		else
		{
			$this->data["postdata"]["skills"]	= array();
		}
		
		foreach($this->data["postdata"]["skills"] as $skill)
		{
			$skills[]=$skill;
		}

		
		$this->data['candidate_skills']	=	$skills;
		$this->data['res']	=	array();
		$this->data['res1']	=	array();
		
		if(!empty($skill))
		{
			$qry	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$skill);
			$this->data['res']	= $res	=	$qry->result_array();
			
			$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
			$this->data['res1']	= $res1 =	$qry1->result_array();
			
			$this->data['child_skills']	=	$this->candidateallmodel->get_child_skills($res1[0]['skill_id']);
		}
		
		$this->load->view('include/header');
		$this->load->view('jobprocess/candidates',$this->data);	
		$this->load->view('include/footer');	
	}

	function download_cv($id=null)
	{
		$this->load->model('candidateallmodel');  
		$this->data["personal"] = $this->candidateallmodel->get_single_record($id);
		$file_text='';
		if($this->data["personal"]['cv_file']!='' && file_exists('uploads/cvs/'.$this->data["personal"]['cv_file']))
		{
			$ext = pathinfo('uploads/cvs/'.$this->data["personal"]['cv_file'], PATHINFO_EXTENSION);			
			if($ext=='doc')
			{
				$file_text=$this->read_doc('uploads/cvs/'.$this->data["personal"]['cv_file']);
			}else if($ext=='docx')
			{
				$file_text=$this->read_docx('uploads/cvs/'.$this->data["personal"]['cv_file']);
			}
			else if($ext=='pdf')
			{
				$file_text='<embed src="http://localhost/ats-main/manage/uploads/sample.pdf" width="1000px" height="2100px" />';
				//'uploads/cvs/'.$this->data["personal"]['cv_file']
			}
			echo $file_text;
		}
		exit();
	}

	function read_doc($file_name)  
	{
		$fileHandle = fopen($file_name, "r");
		$line = @fread($fileHandle, filesize($file_name));   
		$lines = explode(chr(0x0D),$line);
		$outtext = array();
		foreach($lines as $thisline)
		  {
			$pos = strpos($thisline, chr(0x00));
			if (($pos !== FALSE)||(strlen($thisline)==0))
			  {
			  } else {
				$outtext[]= trim(htmlspecialchars(strip_tags($thisline))).nl2br(' ');
			  }
		  }
		  $line_array= implode("<br>", $outtext);
		return $line_array;
	}

	function read_docx($file_name)
	{
			$striped_content = '';
			$content = '';
	
			$zip = zip_open($file_name);
	
			if (!$zip || is_numeric($zip)) return false;
	
			while ($zip_entry = zip_read($zip)) {
	
				if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
	
				if (zip_entry_name($zip_entry) != "word/document.xml") continue;
	
				$content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
	
				zip_entry_close($zip_entry);
			}// end while
	
			zip_close($zip);
	
			$content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
			$content = str_replace('</w:r></w:p>', "\r\n", $content);
			$striped_content = strip_tags($content);
			$striped_content = nl2br($striped_content);
			return $striped_content;
		}
			
	function send_jd()
	{
		$id = $this->input->get('job_id');
		$this->load->model('jobprocessmodel');		
	
		if($this->input->get('candidate_id')!='' && $this->input->get('job_id')!='')
		{
			$this->db->where('job_id', $this->input->get('job_id'));
			$query=$this->db->get('pms_jobs');
			$job_details =$query->row_array();
			
			$this->db->where('candidate_id', $this->input->get('candidate_id'));
			$query=$this->db->get('pms_candidate');
			$candidate_details =$query->row_array();			
					
			$subject='Opening for - '.$job_details['job_title'];
			$email_content=$job_details['job_desc'];
			$date_str=date('Ymdhis');
			$email_md_hash=md5($candidate_details['candidate_id'].$this->input->get('job_id').$date_str);
			$email_url='job_application?job_id='.$email_md_hash;
			
			$data = array(
			    'candidate_id'          => $candidate_details['candidate_id'],
				'candidate_name'        => $candidate_details['first_name'],
				'job_id'                => $this->input->get('job_id'),
				'email'                 => $candidate_details['username'],
				'subject'               => $subject,
				'email_content'         => $email_content,
				'date_sent'             => date('Y-m-d'),
				'email_status'          => 1,
				'email_opened'          => 0,
				'date_opened'           => '',
				'date_filled'           => '',
				'email_md_hash'         => $email_md_hash,
				'base_email_url'        => $this->config->item('base_email_url'),
				'email_url'             => $this->config->item('base_email_url').'index.php/'.$email_url,
			);
		
			$email_id=$this->jobprocessmodel->send_jd($data);
			// take email data back from database.
			$email_jd=$this->jobprocessmodel->get_email_jd($email_id);
				
			$this->db->where('job_id', $email_jd['job_id']);
			$query=$this->db->get('pms_jobs');
			$job_details =$query->row_array();
			// send email
			
			$data_array=array(
				'Job Title:'          =>  $job_details['job_title'],
				'Total Vacancies:'    =>  $job_details['vacancies'],
				'Job Details:'        =>  $job_details['job_desc'],
				'Job Post Date:'      =>  $job_details['job_post_date'],
				'Expected Join Date:' =>  $job_details['exp_join_date'],
				'Vacancies:'          =>  $job_details['vacancies'],
				'Apply From:'        => '<a style="color:#000" href="'.$email_jd['email_url'].'" target="_blank">Click Here to Apply</a>',
								); 
			$email_array=array(
				'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
				'email_to_name'          =>  'Shyjo',
				'email_cc'               =>  '',
				'email_from'             =>  $this->config->item('email_from'),
				'from_name'              =>  $this->config->item('from_name'),
				'email_reply_to'         =>  $this->config->item('email_reply_to'),
				'email_reply_to_name'    =>  $this->config->item('email_reply_to_name'),
				'subject'                =>   $email_jd['subject'],
				'salutation'             =>  'Dear '.$email_jd['candidate_name'].',',
				'table_head'             =>  'Job Opening',
				'text_before_table'      =>  'We have an opening for '.$job_details['job_title'].', see below details.',
				'table_rows'             =>  $data_array,
				'text_after_table'       =>  '---------------------------------',					
				'signature_name'         =>  $this->config->item('signature_name'),
				'signature'              =>  $this->config->item('signature'),
				'date'                   =>  date('Y-m-d'),
				'email_template'         =>  'jobprocess/email_template',
			);
				
			// EMAIL TO ADMIN
			$this->send_email($email_array);
			// email ending here 
			$response=array(
						'candidate_id'          => $candidate_details['candidate_id'],
						'candidate_name'        => $candidate_details['first_name'],
						'job_id'                => $this->input->get('job_id'),
						'job_app_id'            => $this->input->get('job_app_id'),
						'success'            => 'success',
						); 	
		
    		header('Content-type: application/json');    					
			echo json_encode($response);
		}else
		{
				$response=array(
						'success'    => 'failed',
						); 	
				header('Content-type: application/json');    					
				echo json_encode($response);
		}
	}
	
	function send_mass_mail($id=null)
	{
		if($id=='')redirect('jobprocess');
		$this->load->model('jobprocessmodel');

		if($this->input->post('emails_list')!='')
		{
			$emails_list=explode(',',$this->input->post('emails_list'));
				
			$this->db->where('job_id', $this->input->post('job_id'));
			$query=$this->db->get('pms_jobs');
			$job_details =$query->row_array();
							
			if(is_array($emails_list))
			{
				foreach($emails_list as $key => $val)
				{
					if($val!='')
					{
						$subject=' Opportunity for - '.$job_details['job_title'];
						$email_content=$job_details['job_desc'];		
						$email_md_hash=md5($job_details['job_id']);
						$email_url='jobprocess/job_details?job_id='.$email_md_hash;
					
						$data = array(
							'candidate_id'          => '',
							'candidate_name'        => 'Candidate',
							'job_id'                => $job_details['job_id'],
							'email'                 => $val,
							'subject'               => $subject,
							'email_content'         => $email_content,
							'date_sent'             => date('Y-m-d'),
							'email_status'          => 1,
							'email_opened'          => 0,
							'date_opened'           => '',
							'date_filled'           => '',
							'email_md_hash'         => $email_md_hash,
							'base_email_url'        => $this->config->item('base_email_url'),
							'email_url'             => $this->config->item('base_email_url').'index.php/'.$email_url,
						);
	
						$email_id=$this->jobprocessmodel->send_jd_email($data);
						// take email data back from database.
						$email_jd=$this->jobprocessmodel->get_email_jd($email_id);
						// send email
					
						$data_array=array(
							'Job Title:'          =>  $job_details['job_title'],
							'Total Vacancies:'    =>  $job_details['vacancies'],
							'Job Details:'        =>  $job_details['job_desc'],
							'Job Post Date:'      =>  $job_details['job_post_date'],
							'Expected Join Date:' =>  $job_details['exp_join_date'],
							'Vacancies:'          =>  $job_details['vacancies'],
							'Apply From:'         => '<a style="color:#000" href="'.$email_jd['email_url'].'" target="_blank">Click Here to Apply</a>',
											); 

						$email_array=array(
							'email_to'               =>  $email_jd['email'],
							'email_to_name'          =>  $email_jd['candidate_name'],
							'email_cc'               =>  '',
							'email_from'             =>  'hr@unicornhr',
							'from_name'              =>  'Unicorn Personnel Consultancy Services',
							'email_reply_to'         =>  'hr@unicornhr',
							'email_reply_to_name'    =>  'Unicorn Personnel Consultancy Services ',
							'subject'                =>  $email_jd['subject'],
							'salutation'             =>  'Dear '.$email_jd['candidate_name'].',',
							'table_head'             =>  'Job Opening',
							'text_before_table'      =>  'We have an opening for '.$job_details['job_title'].', see below details.',
							'table_rows'             =>  $data_array,
							'text_after_table'       =>  '---------------------------------',					
							'signature_name'         =>  'Unicorn Personnel Consultancy Services',
							'signature'              =>  '',
							'date'                   =>  date('Y-m-d'),
							'email_template'         =>  'jobprocess/email_template',
						);
						// EMAIL TO ADMIN
						$this->send_email($email_array);
						
					}
				}
			}
			redirect('jobprocess/send_mass_mail/'.$this->input->post('job_id'));
		}
				
		$this->data['page_head']= 'Add Candidates';

		$this->data['upload_root']=$this->config->item('base_url');		
		$this->data['current_head']= 'add_candidate';		

		$this->data['start']=0;
		$this->data['limit']=50;

		// total count for paging
		$this->data["total_rows"]=$this->jobprocessmodel->get_filter_count_email($id);

		//paging starts here 
		$config['base_url'] = $this->config->item('base_url')."index.php/jobprocess/send_mass_mail/".$id."/?";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data["total_rows"];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =50;
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
		// paging ends here 
			
		$this->data['formdata']['job_id'] =$id;
			
		if($this->input->get("rows")!='')
		{
			$this->data['start']=$this->input->get("rows");
		}

		if($this->input->get('limit')!='')
		{
			$this->data['limit']=$this->input->get("limit");
		}
		else
		{
			$this->data['limit'] =50;
		}					
			
		$this->data["candidates"]=$this->jobprocessmodel->get_filter_records_email($id,$this->data['start'],$this->data['limit']);
	
		$this->data["postdata"]["job_id"]=$id;
		
		$this->load->view('include/header');
		//$this->load->view('include/job_sidebar',$this->data);
		$this->load->view('jobprocess/mass_email',$this->data);	
		$this->load->view('include/footer');
	}
	
	// send email
	function send_email($email_array=array())
	{
		$mail_body=$this->load->view($email_array['email_template'], $email_array,true);
	
		$headers   = '';		
		$headers = "MIME-Version: 1.0\r\n";
		$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers.= "From: ".$email_array['from_name']." <".$email_array['email_from'].">\r\n";		
		$headers.= "Reply-To: ".$email_array['email_reply_to_name']." <".$email_array['email_reply_to'].">\r\n";
		$headers.= "X-Mailer: PHP/".phpversion()."\r\n";
		
		mail($email_array['email_to'], $email_array['subject'], $mail_body, $headers);
		
		return 1;
	}
	
	// add from jobs to candidates, to job apps, skills, etc. 
	function add_candidate($job_id){
		
		$this->load->model('candidateallmodel');
		$this->load->model('jobprocessmodel');
		
		$this->load->library('upload');
		$this->form_validation->set_rules("first_name","Candidate Name","required");
		$this->form_validation->set_rules("username","Candidate Name","required");
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
				$id = $this->candidateallmodel->insert_candidate_from_jobs();
			}else
			{
				$id=$row['candidate_id'];
			}

			// take skills from this job 
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
			}
			// add an application to the job
			if($this->input->post('job_id')!='' && $id!='')
			{
				$data =array(
					'job_id'=> $this->input->post('job_id'),
					'candidate_id'=> $id,
					'applied_on'  => date('Y-m-d'),
					'app_status_id'  => 1,
					'admin_id'   => $_SESSION['admin_session'],
				);
				$this->db->insert('pms_job_apps', $data);	
			}
						
			// create course or take course id from existing
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

			// create company or take company id from existing	
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
							'company_id'=> $company_id,
							'organization'=> $this->input->post('company'),
							'designation'=> $this->input->post('designation'),
							'candidate_id'=> $id,
							);
					$this->db->insert('pms_candidate_job_profile', $data);
				}				
			}
			
			// create contract
			if($this->input->post('cur_ctc')!='' || $this->input->post('exp_ctc')!='' || $this->input->post('notice_period')!='' || $this->input->post('exp_years')!='')
			{
				$data =array(
				'start_date'=> $this->input->post('start_date'),
				'end_date'=> $this->input->post('end_date'),
				'cur_ctc'=> $this->input->post('cur_ctc'),
				'expct_ctc'=> $this->input->post('exp_ctc'),
				'notice_period'=> $this->input->post('notice_period'),
				'total_exp'=> $this->input->post('total_exp'),	
				'contract_created'=> date('Y-m-d'),
				'candidate_id'=> $id,
				);
				$this->db->insert('pms_candidate_contract', $data);	
				
				// update on job search table.
				$this->db->query("delete from pms_candidate_job_search where candidate_id=".$id);
				$data =array(
				'current_ctc'=> $this->input->post('cur_ctc'),
				'expected_ctc'=> $this->input->post('exp_ctc'),
				'notice_period'=> $this->input->post('notice_period'),
				'total_experience'=> $this->input->post('total_exp'),
				'candidate_id'=> $id,
				);
				$this->db->insert('pms_candidate_job_search', $data);
			}
			// upload CV file
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
							$this->candidateallmodel->insert_files($dataArr);
									$cv_file=1;
						}
					}
				}
			//success
			} 
			
			redirect('jobprocess/manage/'.$job_id.'?add=1');			
		}

		$this->data['job_change_list']=$this->jobprocessmodel->import_from_other_jobs($job_id);
		
		$this->data['page_head']= 'Manage Job';
		$this->data['formdata']['job_id']= $job_id;		

		$this->load->view('include/header');
		$this->load->view('jobprocess/add_candidate',$this->data);	
		$this->load->view('include/footer');
	}
	
	function shortlist($id=null)
	{
		$data['current_head']= 'shortlist';
		
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		$data["postdata"]["job_cat_id"]='';
		$data["postdata"]["func_id"]='';
		$data["postdata"]["country_id"]='';
				
		$this->load->model('jobprocessmodel');
		
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$data['formdata'] =$query->row_array();
		
		$data['interview_time_ar']=array(
						'7:00 AM' => '7:00 AM',
						'7:30 AM' => '7:30 AM',
						'8:00 AM' => '8:00 AM',
						'8:30 AM' => '8:30 AM',
						'9:00 AM' => '9:00 AM',
						'9:30 AM' => '9:30 AM',
						'10:00 AM' => '10:00 AM',
						'10:30 AM' => '10:30 AM',
						'11:00 AM' => '11:00 AM',
						'11:30 AM' => '11:30 AM',
						'12:00 PM' => '12:00 PM',
						'12:30 PM' => '12:30 PM',
						'1:00 PM' => '1:00 PM',
						'1:30 PM' => '1:30 PM',
						'2:00 PM' => '2:00 PM',
						'2:30 PM' => '2:30 PM',
						'3:00 PM' => '3:00 PM',
						'3:30 PM' => '3:30 PM',
						'4:00 PM' => '4:00 PM',
						'4:30 PM' => '4:30 PM',
						'5:00 PM' => '5:00 PM',
						'5:30 PM' => '5:30 PM',
						'6:00 PM' => '6:00 PM',
						'6:30 PM' => '6:30 PM',
						'7:00 PM' => '7:00 PM');

		
		$data["interview_type"] = $this->interviewtypemodel->get_type_list();
		$data["int_status_id"] = $this->interviewstatusmodel->get_model_list();

			
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{		
	
			$this->jobprocessmodel->shortlist($this->input->post('candidate_id'),$this->input->post('job_id'),$this->input->post('app_id'));
			//echo $this->db->last_query();exit;
			redirect('jobprocess/shortlist/'.$this->input->post('job_id'));
		}
				
		$data['upload_root']=$this->config->item('base_url');
			
		if($id!='')
		{
			$data['page_head']= 'Add Candidates';
			
			$this->load->model('countrymodel');
			$this->load->model('companymodel');
			$this->load->model('jobcatmodel');
			$this->load->model('jobareamodel');
			
			$this->load->model('jobtypemodel');
			$this->load->model('worklevelmodel');
			$this->load->model('levelmodel');
			$this->load->model('salarymodel');
			
			$this->load->model('candidatemodel');	
			
		
			$data["postdata"]["job_id"]=$id;
			$data["postdata"]["app_id"]=$this->input->get('app_id');

			$data['applied_candidates']=$this->jobprocessmodel->applied_candidates($id);

			$data['shortlisted_candidates']=$this->jobprocessmodel->get_shortlisted($id);
			
			$this->load->view('include/header');
			$this->load->view('include/job_sidebar',$data);
			$this->load->view('jobprocess/shortlist',$data);	
			$this->load->view('include/footer');

		}else
		{
			redirect('jobprocess/shortlist');
		}
	}

	function manage_rejection($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->post('job_app_id')!='')
		{		
			$data=array(
			'job_app_id'=> $this->input->post('job_app_id'),
			'rejected_on' => $this->input->post('rejected_on'),
			'reason_for_reject' =>  $this->input->post('reason_for_reject'),
			'rejected_by'=> $_SESSION['admin_session']
			);
				
			$this->jobprocessmodel->manage_rejection($this->input->post('job_app_id'),$data);
			$response = array(
			    'data' => '',
				'status'=>'success',
			);
			header('Content-type: application/json');
			echo json_encode($response);
			exit();
		}
				$response = array(
			    'data' => '',
				'status'=>'false',
			);
			header('Content-type: application/json');
			echo json_encode($response);
			exit();
	}
		
	function add_candidate_to_job()
	{
		$id = $this->input->get('job_id');
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('candidate_id')!='' && $this->input->get('job_id')!='')
		{
			
			$this->jobprocessmodel->addcandidate(array('candidate_id' => $this->input->get('candidate_id')),$this->input->get('job_id'));
			
			$this->db->where('job_id', $this->input->get('job_id'));
			$query=$this->db->get('pms_jobs');
			$job_details =$query->row_array();
			
			$this->db->where('candidate_id', $this->input->get('candidate_id'));
			$query=$this->db->get('pms_candidate');
			$candidate_details =$query->row_array();			
					
			$subject=' Your Application Received for job - '.$job_details['job_title'];
			$email_content=$job_details['job_desc'];		
			$email_md_hash=md5($candidate_details['candidate_id'].$this->input->get('job_id'));
			$email_url='job_application?job_id='.$email_md_hash;
			
			$data = array(
			    'candidate_id'          => $candidate_details['candidate_id'],
				'candidate_name'        => $candidate_details['first_name'],
				'job_id'                => $this->input->get('job_id'),
				'email'                 => $candidate_details['username'],
				'subject'               => $subject,
				'email_content'         => $email_content,
				'date_sent'             => date('Y-m-d'),
				'email_status'          => 1,
				'email_opened'          => 0,
				'date_opened'           => '',
				'date_filled'           => '',
				'email_md_hash'         => $email_md_hash,
				'base_email_url'        => $this->config->item('base_email_url'),
				'email_url'             => $this->config->item('base_email_url').'index.php/'.$email_url,
			);
		
			$email_id=$this->jobprocessmodel->send_jd($data);
			// take email data back from database.
			$email_jd=$this->jobprocessmodel->get_email_jd($email_id);
			
			$this->db->where('job_id', $email_jd['job_id']);
			$query=$this->db->get('pms_jobs');
			$job_details =$query->row_array();
			// send email
			
			$data_array=array(
				'Job Title:'          =>  $job_details['job_title'],
				'Total Vacancies:'    =>  $job_details['vacancies'],
				'Job Details:'        =>  $job_details['job_desc'],
				'Job Post Date:'      =>  $job_details['job_post_date'],
				'Expected Join Date:' =>  $job_details['exp_join_date'],
				'Vacancies:'          =>  $job_details['vacancies'],
				'Apply From:'        => '<a style="color:#000" href="'.$email_jd['email_url'].'" target="_blank">Click Here to Apply</a>',
								); 
			$email_array=array(
				'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
				'email_to_name'          =>  'Shyjo',
				'email_cc'               =>  '',
				'email_from'             =>  'shyjo@logicsoftonline.com',
				'from_name'              =>  'Logic Soft',
				'email_reply_to'         =>  'shaijotm@gmail.com',
				'email_reply_to_name'    =>  'Shyjo Mathew',
				'subject'                =>   $email_jd['email_content'],
				'salutation'             =>  'Dear '.$email_jd['candidate_name'].',',
				'table_head'             =>  'Job Opening',
				'text_before_table'      =>  'We have an opening for '.$job_details['job_title'].', see below details.',
				'table_rows'             =>  $data_array,
				'text_after_table'       =>  '---------------------------------',					
				'signature_name'         =>  'Logic Soft Consultancy Services',
				'signature'              =>  '',
				'date'                   =>  date('Y-m-d'),
				'email_template'         =>  'jobprocess/email_template',
			);
					
			// EMAIL TO ADMIN
			$this->send_email($email_array);
			// email ending here 
			$response=array(
						'candidate_id'          => $candidate_details['candidate_id'],
						'candidate_name'        => $candidate_details['first_name'],
						'job_id'                => $this->input->get('job_id'),
						'job_app_id'            => $this->input->get('job_app_id'),
						'success'            => 'success',
						); 	
								
    		header('Content-type: application/json');    					
			echo json_encode($response);
		}else
		{
				$response=array(
						'ess'            => 'failed',
						); 	
				header('Content-type: application/json');    					
				echo json_encode($response);
		}
	}

	function import_from_other_jobs()
	{
		$job_id = $this->input->post('cur_job_id');
		$this->load->model('jobprocessmodel');		
		$response=array(
					'success'            => 'failed',
					); 	
					
		if($this->input->post('cur_job_id')!='')
		{
			if($this->input->post('candidate_source')==1)
			{
				foreach($this->input->post('job_id') as $key => $val)
				{				
					$applicants_list=$this->jobprocessmodel->get_from_applicant_list($val);
					foreach($applicants_list as $key => $job_app)
					{
						unset($job_app['job_app_id']);					
						$job_app['job_id']=$job_id;
						$job_app['applied_on']=date('Y-m-d');
						$job_app['app_status_id']=1;
						$job_app['rejected_by']=0;
						$job_app['reason_for_reject']=0;
						$job_app['rejected_on']='0000-00-00';
						$job_app['admin_id']=$_SESSION['admin_session'];					
						$this->jobprocessmodel->add_candidates_from_other_jobs($job_app);
					}
				}
			}if($this->input->post('candidate_source')==2)
			{
				foreach($this->input->post('job_id') as $key => $val)
				{				
					$applicants_list=$this->jobprocessmodel->get_from_short_listed_list($val);
					
					foreach($applicants_list as $key => $job_app)
					{
						unset($job_app['job_app_id']);					
						$job_app['job_id']=$job_id;
						$job_app['applied_on']=date('Y-m-d');
						$job_app['app_status_id']=1;
						$job_app['rejected_by']=0;
						$job_app['reason_for_reject']=0;
						$job_app['rejected_on']='0000-00-00';
						$job_app['admin_id']=$_SESSION['admin_session'];					
						$this->jobprocessmodel->add_candidates_from_other_jobs($job_app);
					}
				}					
			}if($this->input->post('candidate_source')==3)
			{
				foreach($this->input->post('job_id') as $key => $val)
				{				
					$applicants_list=$this->jobprocessmodel->get_from_rejected_list($val);
					
					foreach($applicants_list as $key => $job_app)
					{
						unset($job_app['job_app_id']);					
						$job_app['job_id']=$job_id;
						$job_app['applied_on']=date('Y-m-d');
						$job_app['app_status_id']=1;
						$job_app['rejected_by']=0;
						$job_app['reason_for_reject']=0;
						$job_app['rejected_on']='0000-00-00';
						$job_app['admin_id']=$_SESSION['admin_session'];					
						$this->jobprocessmodel->add_candidates_from_other_jobs($job_app);
					}
				}	
					
			}if($this->input->post('candidate_source')==4)
			{
				foreach($this->input->post('job_id') as $key => $val)
				{				
					$applicants_list=$this->jobprocessmodel->get_from_interview_list($val);
					foreach($applicants_list as $key => $job_app)
					{
						unset($job_app['job_app_id']);					
						$job_app['job_id']=$job_id;
						$job_app['applied_on']=date('Y-m-d');
						$job_app['app_status_id']=1;
						$job_app['rejected_by']=0;
						$job_app['reason_for_reject']=0;
						$job_app['rejected_on']='0000-00-00';
						$job_app['admin_id']=$_SESSION['admin_session'];					
						$this->jobprocessmodel->add_candidates_from_other_jobs($job_app);
					}
				}					
					
			}
			redirect('jobprocess/add_candidate/'.$job_id.'?add=1');		
		}else
		{
			$response=array(
					'success'            => 'failed',
					); 	
			header('Content-type: application/json');    					
			echo json_encode($response);
		}
	}

	function save_job_change()
	{
		$id = $this->input->get('job_id');
		$this->load->model('jobprocessmodel');	

			
		if($this->input->post('candidate_id')!='' && $this->input->post('job_app_id')!='')
		{
			if(is_array($this->input->post('job_id')))
			{
				foreach($this->input->post('job_id') as $key => $val)
				{
					$this->jobprocessmodel->addcandidate(array('candidate_id' => $this->input->post('candidate_id')),$val);
				}
			}
			
			if($this->input->post('remove_from')==1)
			{
				$this->jobprocessmodel->remove_from_apps($this->input->post('candidate_id'),$this->input->post('job_app_id'),$this->input->post('cur_job_id'));
			}
			$response=array(
						'status'            => 'success',
						); 	
		}else
		{
				$response=array(
						'status'            => 'failed',
						); 	
		}
		header('Content-type: application/json');
		echo json_encode($response);
	}

	function add_feedback()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');

		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('short_id')!='' && $this->input->post('client_feedback')!='')
		{
			$job_id=$this->jobprocessmodel->add_feedback();	
			$response = array(
			    'data' => '',
				'status'=>'success',
			);
			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}
	}
	
	function send_interview_list()
	{
		$id = $this->input->get('job_id');
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('job_id')!='')
		{			
			$this->db->where('job_id', $this->input->get('job_id'));
			$query=$this->db->get('pms_jobs');
			$job_details=$query->row_array();
			
			$list_shortlisted=$this->jobprocessmodel->get_shortlisted_client($this->input->get('job_id'));
			$subject='Interview List - '.$job_details['job_title'];

			$data_array=array();
			
			foreach($list_shortlisted as $key => $val)
			{
				$email_md_hash=md5($val['candidate_id'].$this->input->get('job_id'));
				$email_url='job_application?job_id='.$email_md_hash;
						
				$data_array[]=array(
					'candidate_name'    =>  $val['first_name'].' '.$val['last_name'],
					'interview_date'    =>  $val['username'],
					'interview_time'    =>  $val['username'],
					'venue'             =>  $val['username'],
					'company'           =>  $val['username'],
					'designation'       =>  $val['username'],
					'total_exp'         =>  $val['exp_years'],
					'current_ctc'       =>  $val['exp_years'],
					'expected_ctc'      =>  $val['exp_years'],
					'notice_period'     =>  $val['exp_years'],
					'cv_url'            => '<a style="color:#000" href="'.$val['username'].'" target="_blank">CV</a>',
					'accept_url'        => '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/'.$email_url.'" target="_blank">Accept</a>',
					'reject_url'        => '<a style="color:#000" href="'.$this->config->item('base_email_url').'index.php/'.$email_url.'" target="_blank">Reject</a>',
					); 
			}
			
			// send email
			$email_array=array(
				'email_to'               =>  'shaijotm@gmail.com', //'abeservices@gmail.com',
				'email_to_name'          =>  'Shyjo',
				'email_cc'               =>  '',
				'email_from'             =>  'shyjo@logicsoftonline.com',
				'from_name'              =>  'Logic Soft',
				'email_reply_to'         =>  'shaijotm@gmail.com',
				'email_reply_to_name'    =>  'Shyjo Mathew',
				'subject'                =>   $subject,
				'salutation'             =>  'Dear Client',
				'table_head'             =>  'Candidates List',
				'text_before_table'      =>  'Interview List for job - '.$job_details['job_title'],
				'table_rows'             =>  $data_array,
				'text_after_table'       =>  'Please Confirm',					
				'signature_name'         =>  'Logic Soft Consultancy Services',
				'signature'              =>  'Shyjo Mathew',
				'date'                   =>  date('Y-m-d'),
				'email_template'         =>  'jobprocess/email_template_interviewlist',
			);
				
			// EMAIL TO ADMIN
			$this->send_email($email_array);
			// email ending here 
			$response=array(
						'job_id'             => $this->input->get('job_id'),
						'job_app_id'         => $this->input->get('job_app_id'),
						'success'            => 'success',
						); 	
								
    		header('Content-type: application/json');    					
			echo json_encode($response);
		}else
		{
				$response=array(
						'ess'            => 'failed',
						); 	
				header('Content-type: application/json');
				echo json_encode($response);
		}
	}

	function addinterview()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');

		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('title')!='' )
		{
			$data=array(
			'job_app_id'=> $this->input->post('job_app_id'),
			'candidate_id' => $this->input->post('candidate_id') ,
			'interview_date'=> date("Y-m-d H:i:s",strtotime($this->input->post('interview_date'))),
			'title'=> $this->input->post('title') ,
			'description' => $this->input->post('description'),
			'duration'=> $this->input->post('duration') ,
			'interview_time'=> $this->input->post('interview_time') ,
			'interview_type_id'=> $this->input->post('interview_type_id') ,
			'int_status_id'=> $this->input->post('int_status_id') ,
			'location' => $this->input->post('location'),
			);
			$job_id=$this->jobprocessmodel->add_interview($data,$this->input->post('candidate_id'),$this->input->post('job_app_id'));	
			$this->jobprocessmodel->add_interview_history($data,$this->input->post('candidate_id'),$this->input->post('job_app_id'));			
			
			/*
			//take interview list if we need to send using JSON. 			
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$formdata =$query->row_array();
			$interview_list =$this->jobprocessmodel->get_interview_list($id);            
			*/
			$response = array(
			    'data' => '',
				'status'=>'success',
			);

			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}
	}

	function add_calls()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');

		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$job_id=$this->jobprocessmodel->add_calls();	
			$response = array(
			    'data' => '',
				'status'=>'success',
			);
			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}
	}

	function add_ctc()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');

		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$job_id=$this->jobprocessmodel->add_ctc();	
			$response = array(
			    'data' => '',
				'status'=>'success',
			);
			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}
	}

	function add_notes()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');

		if($this->input->post('title')!='' && $this->input->post('candidate_id')!='')
		{
			$job_id=$this->jobprocessmodel->add_notes();	
			$response = array(
			    'data' => '',
				'status'=>'success',
			);
			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}
	}
	
	function add_message()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');

		if($this->input->post('message_text')!='' && $this->input->post('candidate_id')!='')
		{
			$job_id=$this->jobprocessmodel->add_message();	
			$response = array(
			    'data' => '',
				'status'=>'success',
			);
			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}
	}
		
	function select_candidate($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$data=array(
			'app_id'          => $this->input->post('app_id'),
			'candidate_id'    => $this->input->post('candidate_id') ,
			'feedback'        => $this->input->post('feedback') ,
			'select_date'     => date('Y-m-d'),
			);

			$this->jobprocessmodel->select_candidate($data,$this->input->post('app_id'));
			$response = array(
				'status'=>'success',
			    'data' =>'',
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	}
	
//get selected CAndidate

function get_select_candidate()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$formdata =$query->row_array();
		
		$interview_schedule = $this->jobprocessmodel->interview_schedule($id);
		
		$html1='';
		$html2='';
		if(!empty($interview_schedule)){
			
			$html1 ='<td colspan="2" align="center" valign="top"><br>
						<strong>Candidates Schedule for Another Job with same Skills,but not selected.</strong>
					</td>';
									
			
			$html2='<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
					 <tbody >
						  <tr>
							 <td bgcolor="#CCCCCC">Candidate</td>
							<td bgcolor="#CCCCCC">Interview Date</td>
							<td bgcolor="#CCCCCC">Time</td>
							<td bgcolor="#CCCCCC">Venue</td>
							<td bgcolor="#CCCCCC">Mode of Interview</td>
							<td bgcolor="#CCCCCC">Description</td>
							<td width="37%" bgcolor="#CCCCCC">Action</td>
						  </tr>';
						
					 foreach($interview_schedule as $interview)
					 {
						$datetime = explode(" ",$interview['interview_date']);
                         
						
						$html2.=' <tr>
									  <td width="13%"><a href="'.base_url().'index.php/candidates_all/summary/'.$interview['candidate_id'].'" target="_blank">'.$interview['first_name'].' '.$interview['last_name'].'</a></td>
									  <td width="13%">'.date("d-m-Y", strtotime($datetime[0])).'</td>
									  <td width="13%">'.$interview['interview_time'].'</td>
									  <td width="14%">'.$interview['location'].'</td>
									  <td width="12%">'.$interview['interview_type'].'</td>
									  <td width="11%">'.$interview['description'].'</td>
									  <td> <a href="javascript:;" onclick="select_candidate('.$interview['candidate_id'].','.$interview['job_app_id'].','.$formdata['job_id'].');" class="btn btn-primary btn-xs"> Select </a></td>';
								
						}
						
						$html2.=' </tbody> </table> ';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}

//get  CAndidate Contract

function get_candidate_contract()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$formdata =$query->row_array();
		
		//contracts ending between (jobstart date -30 days) and (job end date +30 days)
		/*$query = $this->db->query('SELECT job_post_date,job_expiry_date from pms_jobs where job_id='.$id);
		$result=$query->row();*/
		$start_date= date('Y-m-d', strtotime($formdata['job_post_date'] .'- 30 days'));
		$end_date= date('Y-m-d', strtotime($formdata['job_expiry_date'] .'+ 30 days'));
		
		$contracts_ending=$this->jobprocessmodel->contracts_ending($id,$start_date,$end_date);
		
		$html1='';
		$html2='';
		if(!empty($contracts_ending)){
			
			$html1 ='<td colspan="2" align="center" valign="top"><br>
	Candidates Contracts Falling Between '.date('d-m-Y',strtotime($start_date)).' and '.date('d-m-Y',strtotime($end_date)).'
</td>';
									
			
			$html2='<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					 <tbody >
						  <tr>
							 <td bgcolor="#CCCCCC">Candidate</td>
							<td bgcolor="#CCCCCC">Contract Start Date</td>
							<td bgcolor="#CCCCCC">Contract End Date</td>
							<td bgcolor="#CCCCCC">Action</td>
						  </tr>';
						
					 foreach($contracts_ending as $contract)
					 {
						
                         
						
						$html2.='<tr>
                              <td width="13%"><a href="'.base_url().'index.php/candidates_all/summary/'.$contract['candidate_id'].'" target="_blank">'. $contract['first_name'].' '.$contract['last_name'].'</a></td>
                              <td width="13%">'. date('d-m-Y',strtotime($contract['start_date'])).'</td>
                              <td width="13%">'. date('d-m-Y',strtotime($contract['end_date'])).'</td>
									  <td width="13%"> <a href="javascript:;" data-url="'.base_url().'index.php/jobprocess/add_to_job/?candidate_id='.$contract['candidate_id'].'&job_id='.$formdata['job_id'].'"  id="add_to_job"  > Add to Job </a></td>
									  </tr>';
								
						}
						
						$html2.=' </tbody> </table> ';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
//get Offer Issued
	function get_offer_issued()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$formdata =$query->row_array();
		
		$offer_letters_issued =$this->jobprocessmodel->offer_letters_issued($id);
		
		$html1='';
		$html2='';
		if(!empty($offer_letters_issued)){
			
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						<strong>Offer Letters Issued for Candidates below </strong>
					</td>';
					
			
			$html2='<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
					  <tbody >
					  <tr>
							<td bgcolor="#CCCCCC">Candidate</td>
							<td bgcolor="#CCCCCC">Offer Date</td>
							<td bgcolor="#CCCCCC">Salary Offered</td>
							
							<td bgcolor="#CCCCCC">Offer Status</td>
							
							<td width="24%" bgcolor="#CCCCCC">Action</td>
						</tr>';
						
						foreach($offer_letters_issued as $offerletter){
						

						
						$offer_status='';		  				
						if($offerletter['offer_status']==1)
						{
							$offer_status='Offered';
						}
						else if($offerletter['offer_status']==2)
						{
							$offer_status='Accepted';
						}
						else if($offerletter['offer_status']==3)
						{
							$offer_status='Rejected';
						}
						
						$html2.='<tr>
								  <td ><a href="'.base_url().'index.php/candidates_all/summary/'.$offerletter['candidate_id'].'" target="_blank">'.$offerletter['first_name'].' '.$offerletter['last_name'].'</a></td>
								  <td >'.date("d-m-Y", strtotime($offerletter['offer_date'])).'</td>
								  <td >'.$offerletter['salary_offered'].'</td>
								  
								  <td >'.$offer_status.'</td>
								
								  <td><a href="javascript:;"  data-url="'.base_url().'index.php/jobprocess/delete_offercandidate/?job_app_id='.$offerletter['app_id'].'&candidate_id='.$offerletter['candidate_id'].'&job_id='.$formdata['job_id'].'"  id="delete_offer_candidate" class="btn btn-danger btn-xs">X </a>  <a href="'.base_url().'index.php/candidates_all/summary/'.$offerletter['candidate_id'].'" target="_blank" class="btn btn-info btn-xs"> Profile </a>  <a href="javascript:;" onclick="accept_offer('.$formdata['job_id'].','.$offerletter['app_id'].','.$offerletter['candidate_id'].');" class="btn btn-success btn-xs"> Accept </a>  <a href="javascript:;" onclick="reject_offer('.$formdata['job_id'].','.$offerletter['app_id'].','.$offerletter['candidate_id'].');" class="btn btn-warning btn-xs"> Reject </a></td>';
								
						}
						
						$html2.=' </tbody> </table> ';

		}
	

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}

//REJECT OFFER
	function reject_offer($id=null)
	{ 
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$this->jobprocessmodel->reject_offer();

    
			$response = array(
			    
				'status'=>'success',
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	
	}
	
	function issue_offer()
	{ 
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
	
		if($this->input->post('app_id')!='')
		{
			$data=array(
			'app_id'              => $this->input->post('app_id'),
			'candidate_id'        => $this->input->post('candidate_id') ,
			'offer_date'          => $this->input->post('offer_date'),
			'salary_offered'      => $this->input->post('salary_offered'),
			'title'               => $this->input->post('title'),
			'offer_status'	      => 1,
			'offer_letter'        => 'Offer letter issued.',
			'negotiation'         => $this->input->post('negotiation'),
			);

			$this->jobprocessmodel->issue_offer($data,$this->input->post('app_id'));
			$response = array(
				'status'=>'success',
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	
	}

	function accept_offer($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$data=array(
			'app_id'                  => $this->input->post('app_id'),
			'offer_issued_date'       => date("Y-m-d",strtotime($this->input->post('offer_issued_date'))),
			'offer_accepted_date'     => date("Y-m-d",strtotime($this->input->post('offer_accepted_date'))),
			'join_date'               => date("Y-m-d",strtotime($this->input->post('join_date'))),
			'monthly_salary_offered'  => $this->input->post('monthly_salary_offered'),
			'total_ctc'               => $this->input->post('total_ctc'),
			'min_contract_months'     => $this->input->post('min_contract_months'),
			);
		
			$this->jobprocessmodel->accept_offer($data);			
			redirect('jobprocess/manage/'.$id);
		}

		$this->data['page_head']= 'Add Interviews';
		$this->data['candidate_id']=$this->input->get('candidate_id');
		$this->data['app_id']=$this->input->get('app_id');
		$this->data['formdata']['job_id']=$id;
			
		$this->load->view('include/header',$this->data);
		$this->load->view('jobprocess/offerletter',$this->data);	
		$this->load->view('include/footer',$this->data);		
	}

//GET ACCEPT OFFER LIST
	function get_offer_accepted()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		$this->load->model('companymodel');
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$formdata =$query->row_array();
		
		$offer_accepted = $this->jobprocessmodel->offer_accepted($id);

		$company_name=$this->companymodel->get_company_name($formdata['company_id']);
		$html1='';
		$html2='';
		
		if(!empty($offer_accepted)){
			
			$html1='<td colspan="2" align="center" valign="top"><br>
							
							<strong>Offer Accepted and Joined in '.$company_name.'</strong>
						</td>';
	
			$html2='<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
					  <tbody >
					  <tr>
						 <td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Accept Date</td>
						<td bgcolor="#CCCCCC">Accepted Salary</td>
						<td bgcolor="#CCCCCC">Min.Contract Months</td>

						<td width="37%" bgcolor="#CCCCCC">Actions</td>
					</tr>';
  				
				foreach($offer_accepted as $accepted){                                    
  
				
				$html2.='<tr>
						  <td width="20%"><a href="'.base_url().'index.php/candidates_all/summary/'.$accepted['candidate_id'].'" target="_blank">'.$accepted['first_name'].' '.$accepted['last_name'].'</a></td>
						  <td width="13%">'.date("d-m-Y", strtotime($accepted['offer_accepted_date'])).'</td>
						  <td width="14%">'.$accepted['monthly_salary_offered'].'</td>
						  <td width="29%">'.$accepted['min_contract_months'].'</td>

						  <td><p><a href="javascript:;" data-url="'.base_url().'index.php/jobprocess/delete_acceptcandidate/?job_id='.$formdata['job_id'].'&app_id='.$accepted['app_id'].'&candidate_id='.$accepted['candidate_id'].'&placement_id='.$accepted['placement_id'].'" id="delete_accept_candidate" class="btn btn-danger btn-xs">X </a> <a href="'.base_url().'index.php/candidates_all/summary/'.$accepted['candidate_id'].'" target="_blank" class="btn btn-info btn-xs"> Profile </a>&nbsp;<a href="javascript:;" onclick="create_invoice('.$formdata['job_id'].','.$accepted['app_id'].','.$accepted['candidate_id'].','. $accepted['placement_id'].');" class="btn btn-primary btn-xs">Invoice</a></p></td>';
					
				}
					
    		$html2 .=' </tbody> </table> ';
/* | <a href="javascript:;" onclick="create_visa('.$formdata['job_id'].','.$accepted['app_id'].','.$accepted['candidate_id'].','. $accepted['placement_id'].');"> Visa Details</a>*/
		}

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	

	function add_certificate()
	{
		$job_app_id =$this->input->post('job_app_id');
		$job_id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		
		$data = array(
			'app_id'     => $this->input->post('job_app_id'),
			'status'     =>$this->input->post('status'),
			'title'      => $this->input->post('title'),
		);
		
		$get_cert_id = $this->jobprocessmodel->add_certificate($data);
		
		$data = array(
			'data1' => '',
			'data2' => '',
			'status'=>'success',
		);
		redirect('jobprocess/manage/'.$job_id);
		//header('Content-type: application/json');    					
		//echo json_encode($data);
	}
	
//get certy attestaion details

	function get_cert_list()
	{
		$job_app_id =$this->input->post('job_app_id');
		$this->load->model('jobprocessmodel');
		$get_cert_list = $this->jobprocessmodel->get_cert_list($job_app_id);

		$response = array(
			'data1' => $get_cert_list,
			'data2' => '',
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	}

	function move_to_docs()
	{

		$app_id =$this->input->post('job_app_id');
		$this->load->model('jobprocessmodel');
		if($app_id!='')
		{
			$this->jobprocessmodel->move_to_docs($app_id );
			$response = array(
				'status'=>'success',
			);
			redirect('jobprocess/manage/'.$this->input->post('job_id').'/?updated=1');
			exit();
//			header('Content-type: application/json');
//			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
	}
	
	function create_doc()
	{
		$job_id =$this->input->post('job_id');
		$job_app_id =$this->input->post('job_app_id');
		
		$this->load->model('jobprocessmodel');

		if($this->input->post('job_app_id')!='' && $this->input->post('job_id')!='')
		{
			
			$data=array(
			'app_id'          => $this->input->post('job_app_id'),
			'date_send'       => date("Y-m-d"),
			'send_mode'       => $this->input->post('send_mode'),
			'send_by'         => $this->input->post('send_by'),
			'candidate_id'    => $this->input->post('candidate_id'),
			);
			$this->jobprocessmodel->create_doc($data,$job_app_id);
			//$response = array(
			//	'status'=>'success',
			//);
					
			redirect('jobprocess/manage/'.$job_id);
			//header('Content-type: application/json');
			//echo json_encode($response);
		}
		
	}
		
	function accept_job_offer()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if($this->input->post('app_id')!='' && $this->input->post('offer_accepted_date')!='' )
		{
			$data=array(
			'app_id'                  => $this->input->post('app_id'),
			'offer_issued_date'       => date("Y-m-d",strtotime($this->input->post('offer_issued_date'))),
			'offer_accepted_date'     => date("Y-m-d",strtotime($this->input->post('offer_accepted_date'))),
			'join_date'               => date("Y-m-d",strtotime($this->input->post('join_date'))),
			'monthly_salary_offered'  => $this->input->post('monthly_salary_offered'),
			'total_ctc'               => $this->input->post('total_ctc'),
			'min_contract_months'     => $this->input->post('min_contract_months'),
			);

			$this->jobprocessmodel->accept_offer($data,$this->input->post('app_id'));	

			$response = array(
				'status'=>'success',
			);
			header('Content-type: application/json');
			echo json_encode($response);
		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
	}

//CERT ATTEST
	function cert_attest()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' )
		{
			$this->jobprocessmodel->cert_attest();	
			
			$response = array(
			    
				'status'=>'success',
			);

			header('Content-type: application/json');
			echo json_encode($response);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
	}

	function create_visa()
	{
		$job_id =$this->input->post('job_id');
		$app_id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');

		if($this->input->post('app_id')!='' && $this->input->post('job_id')!='')
		{
			$data=array(
			'app_id'             => $app_id,
			'date'               => date("Y-m-d",strtotime($this->input->post('date'))),
			'date_issued'        => date("Y-m-d",strtotime($this->input->post('date_issued'))),
			'date_expiry'        => date("Y-m-d",strtotime($this->input->post('date_expiry'))),
			'passport_verified'  => $this->input->post('passport_verified'),
			'number'             => $this->input->post('number'),
			'description'        => $this->input->post('description'),
			);
		
			$this->jobprocessmodel->create_visa($data,$app_id);
			$response = array(
				'status'=>'success',
			);
			redirect('jobprocess/manage/'.$job_id);
//			header('Content-type: application/json');
//			echo json_encode($response);
		}
	}

	function create_medical()
	{
		
		$job_id =$this->input->post('job_id');
		$app_id =$this->input->post('app_id');		
		
		$this->load->model('jobsmodel');

		if($this->input->post('app_id')!='' && $this->input->post('job_id')!='')
		{
			$data=array(
			'app_id'          => $this->input->post('app_id'),
			'date'            => date("Y-m-d",strtotime($this->input->post('date'))),
			'title'           => $this->input->post('title'),
			'description'     => $this->input->post('description'),
			'candidate_id'    => $this->input->post('candidate_id'),
			);
			
			$this->jobsmodel->create_medical($data,$app_id);
			$response = array(
				'status'=>'success',
			);
			
//			header('Content-type: application/json');
//			echo json_encode($response);
			redirect('jobprocess/manage/'.$job_id);
		}
	}
	
			
	function create_invoice($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->post('placement_id')!='' && $this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$this->jobprocessmodel->create_invoice();			
			redirect('jobprocess/manage/'.$id);
		}
		$this->data['invoice_list']=$this->jobprocessmodel->invoice_generated($id);
		
		$this->data['page_head']= 'Add Interviews';
		$this->data['candidate_id']=$this->input->get('candidate_id');
		$this->data['app_id']=$this->input->get('app_id');
		$this->data['placement_id']=$this->input->get('placement_id');
		$this->data['formdata']['job_id']=$id;
			
		$this->load->view('include/header',$this->data);
		$this->load->view('jobprocess/create_invoice',$this->data);	
		$this->load->view('include/footer',$this->data);	
	}

	function create_invoice2()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
				
		if($this->input->post('placement_id')!='' && $this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('invoice_date')!='')
		{
			$data=array(
			'placement_id'       => $this->input->post('placement_id'),
			'invoice_date'       => date("Y-m-d",strtotime($this->input->post('invoice_date'))),
			'invoice_start_date' => date("Y-m-d",strtotime($this->input->post('invoice_start_date'))),
			'invoice_due_date'   => date("Y-m-d",strtotime($this->input->post('invoice_due_date'))),
			'replacement_date'   => date("Y-m-d",strtotime($this->input->post('replacement_date'))),
			'invoice_amount'     => $this->input->post('invoice_amount'),
			'invoice_status'     => $this->input->post('invoice_status'),
			'client_candidate'     => $this->input->post('client_candidate'),
			);
		
			$this->jobprocessmodel->create_invoice($data,$this->input->post('app_id'),$this->input->post('placement_id'));
			
//			$invoice_generated=$this->jobprocessmodel->invoice_generated($id);
			$response = array(
			    'data' => '',
				'status'=>'success',
			);

			header('Content-type: application/json');
			echo json_encode($response);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
		
		
	}

// both invoice deletion and get the list for AJAX display
	function delete_invoice()
	{
		$this->load->model('jobprocessmodel');
		$id     = $this->input->get('placement_id');
		$job_id = $this->input->get('job_id');

		$response = array(
					'status' => 'failed',
				);
		if($this->input->get('placement_id')!='')
		{
				$result = $this->db->query('DELETE FROM pms_job_apps_invoice WHERE placement_id ="'.$id.'"');
				$response = array(
					'status' => 'success',
				);
		}
		header('Content-type: application/json');    					
		echo json_encode($response);
		exit();			
	}
	// listing for ajax
	function get_invoice_list()
	{
		$job_id = $this->input->get('job_id');
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('placement_id')!='')
		{
				$this->db->where('job_id', $job_id);
				$query=$this->db->get('pms_jobs');
				$formdata =$query->row_array();
										
				$invoice_generated=$this->jobprocessmodel->invoice_generated($job_id);
				$count =count($invoice_generated);
				
			$html='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Invoice Date</td>
						<td bgcolor="#CCCCCC">Start Date</td>
						<td bgcolor="#CCCCCC">Due Date</td>
						<td bgcolor="#CCCCCC">Amt.</td>
						<td bgcolor="#CCCCCC">Status</td>
						 <td bgcolor="#CCCCCC">Created For</td>
						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($invoice_generated as $invoice){
				
					$invoice_status = "";                        
					if($invoice['invoice_status']=='1')
					{
						$invoice_status= 'Paid';
					}
					else if($invoice['invoice_status']=='2')
					{
						$invoice_status = 'Unpaid';
					}
					else if($invoice['invoice_status']=='3')
					{
						$invoice_status = 'Due';
					}
					else
					{ 
					$invoice_status = '';
					}
						
					$client_candidate = "";                        
					if($invoice['client_candidate']=='1')
					{
						$client_candidate= 'Client';
					}
					else if($invoice['client_candidate']=='2')
					{
						$client_candidate = 'Candidate';
					}
					else
					{  $client_candidate = '';}
           
		   $html.=' <tr>
                      <td width="13%"><a href="'.base_url().'index.php/candidates_all/summary/'.$invoice['candidate_id'].'" target="_blank">'.$invoice['first_name'].' '.$invoice['last_name'].'</a></td>
                      <td width="13%">'.$invoice['invoice_date'].'</td>
                      <td width="14%">'.$invoice['invoice_start_date'].'</td>
                      <td width="12%">'.$invoice['invoice_due_date'].'</td>
                      <td width="11%">'.$invoice['invoice_amount'].'</td>
                      <td width="11%">'.$invoice_status.'</td>
					   <td width="11%">'.$client_candidate.'</td>
                       <td><a href="'.base_url().'index.php/jobprocess/create_invoice/'.$formdata['job_id'].'/?placement_id='.$invoice['placement_id'].'&invoice_id='.$invoice['invoice_id'].'"> &nbsp;Edit&nbsp;</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/jobprocess/delete_invoice/?job_id='.$formdata['job_id'].'&placement_id='.$invoice['placement_id'].'&invoice_id='.$invoice['invoice_id'].'"  id="delete_invoice_candidate" >Delete</a>|<a href="'.base_url().'index.php/candidates_all/summary/'.$invoice['candidate_id'].'" target="_blank">Profile</a></td></tr>';
						
				}
				
				$html .=' </tbody> </table> ';
					
				$response = array(
					'data' => $html,
					'count'=> $count,
				);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
// both invoice deletion and get the list for AJAX display
				
	function delete_application($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->jobprocessmodel->delete_application($this->input->get('candidate_id'),$id);
			redirect('jobprocess/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_from_shortlist($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->jobprocessmodel->delete_from_shortlist($this->input->get('candidate_id'),$id);
			redirect('jobprocess/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_interview_schedule($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->jobprocessmodel->delete_interview_schedule($this->input->get('candidate_id'),$id);
			redirect('jobprocess/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_selected_candidate($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->jobprocessmodel->delete_selected_candidate($this->input->get('candidate_id'),$id);
			redirect('jobprocess/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_offer_letter($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->jobprocessmodel->delete_offer_letter($this->input->get('candidate_id'),$id);
			redirect('jobprocess/manage/'.$id.'/?del=1');
		}
		exit();
	}
	
	function delete_placed_candidate($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->jobprocessmodel->delete_placed_candidate($this->input->get('candidate_id'),$id);
			redirect('jobprocess/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_candidate_invoice($id=null)
	{
		$this->load->model('jobprocessmodel');
		if($this->input->get('placement_id')!='' && $this->input->get('invoice_id')!=''  & $id!='')
		{
			$this->jobprocessmodel->delete_candidate_invoice($this->input->get('placement_id'),$this->input->get('invoice_id'));
			redirect('jobprocess/manage/'.$id.'/?del=1');
		}
		exit();
	}
						
	function delete($id=null)
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		$this->load->model('jobprocessmodel');
		if(!empty($id))
		{		
			$delete_rec=array('0' => $id);
			$id=$this->jobprocessmodel->delete_records($delete_rec);
			
		}elseif(is_array($this->input->post('checkbox')))
		{
			$id=$this->jobprocessmodel->delete_records($this->input->post('checkbox'));
		}
		if($id==true)
			redirect('jobprocess/?rows='.$rows.'&del=1');
		else
			redirect('jobprocess/?rows='.$rows.'&del=0');
		
	}
	function check_dups()
	{
		$this->db->where('job_title', $this->input->post('job_title'));
		if($this->input->post('job_id') > 0)	$this->db->where('job_id !=', $this->input->post('job_id'));
		$query = $this->db->get('pms_jobs');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'job name already used.');
			return false;
		}
	}

	function do_upload()
	{
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'doc|docx|pdf';
		$config['max_size']	= '0';
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($this->input->post('brochure')))
		{
			$error = array('error' => $this->upload->display_errors());
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			return $data;
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
			$this->load->model('jobprocessmodel');
			$this->jobprocessmodel->delete_multiple_record($id_arr);
			redirect('jobprocess/?multi=1');
		}
		else{
			redirect('jobprocess');
		}
	}

	function manage_interview($id=null)
	{
		$data['current_head']= 'interview';
		
		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');

		
		if(!empty($id))
		{
			
			$data['page_head']= 'Manage Job';
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$data['formdata']=$query->row_array();
			
			$data['shortlisted']=$this->jobprocessmodel->get_shortlisted($id);
			//echo '<pre>';print_r($data['shortlisted']);exit;
			$data['interview_list']=$this->jobprocessmodel->get_interview_list($id);
			
			$data['interview_time_ar']=array(
						'7:00 AM' => '7:00 AM',
						'7:30 AM' => '7:30 AM',
						'8:00 AM' => '8:00 AM',
						'8:30 AM' => '8:30 AM',
						'9:00 AM' => '9:00 AM',
						'9:30 AM' => '9:30 AM',
						'10:00 AM' => '10:00 AM',
						'10:30 AM' => '10:30 AM',
						'11:00 AM' => '11:00 AM',
						'11:30 AM' => '11:30 AM',
						'12:00 PM' => '12:00 PM',
						'12:30 PM' => '12:30 PM',
						'1:00 PM' => '1:00 PM',
						'1:30 PM' => '1:30 PM',
						'2:00 PM' => '2:00 PM',
						'2:30 PM' => '2:30 PM',
						'3:00 PM' => '3:00 PM',
						'3:30 PM' => '3:30 PM',
						'4:00 PM' => '4:00 PM',
						'4:30 PM' => '4:30 PM',
						'5:00 PM' => '5:00 PM',
						'5:30 PM' => '5:30 PM',
						'6:00 PM' => '6:00 PM',
						'6:30 PM' => '6:30 PM',
						'7:00 PM' => '7:00 PM');

		
		$data["interview_type"] = $this->interviewtypemodel->get_type_list();
		$data["int_status_id"] = $this->interviewstatusmodel->get_model_list();


		
			$this->load->view('include/header');
			$this->load->view('include/job_sidebar',$data);
			$this->load->view('jobprocess/manage_interview',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('jobprocess');
		}
	}

		
	function manage_offer($id=null)
	{
		$data['current_head']= 'offer';
		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		

		
		if(!empty($id))
		{
			
			$data['page_head']= 'Manage Job';
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$data['formdata']=$query->row_array();
			
			$data['candidates_selected']=$this->jobprocessmodel->candidates_selected($id);
			$data['offer_letters_issued']=$this->jobprocessmodel->offer_letters_issued($id);
			
			
			$this->load->view('include/header');
			$this->load->view('include/job_sidebar',$data);
			$this->load->view('jobprocess/manage_offer',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('jobprocess');
		}
	}
	
	function manage_invoice($id=null)
	{
		$data['current_head']= 'invoice';
		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		

		
		if(!empty($id))
		{
			
			$data['page_head']= 'Manage Job';
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$data['formdata']=$query->row_array();
			
			$data['offer_accepted']=$this->jobprocessmodel->offer_accepted($id);
			$data['invoice_generated']=$this->jobprocessmodel->invoice_generated($id);
			$data['invoice_list2']=$this->jobprocessmodel->invoice_generated($id);
						
			$this->load->view('include/header');
			$this->load->view('include/job_sidebar',$data);
			$this->load->view('jobprocess/manage_invoice',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('jobprocess');
		}
	}
	
	function job_apps($id=null)
	{
		$this->data['current_head']= 'job_apps';
		$this->data['page_head']= 'Job Applications';
		$this->data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobprocessmodel');
		if(!empty($id))
		{
			$this->data['page_head']= 'Job Application';
			
			$this->load->model('jobprocessmodel');
			$this->load->model('interviewtypemodel');
			$this->load->model('interviewstatusmodel');
			
			$this->load->model('candidatemodel');	
			$this->load->model('candidateallmodel');
			
			$this->data["years_list"] = $this->candidateallmodel->years_list();
			$this->data["months_list"] = $this->candidateallmodel->months_list();
			
			$this->data["jobtype"] = $this->jobprocessmodel->jobtype_list();
			$this->data['applied_candidates']=$this->jobprocessmodel->get_candidate_list($id);
			$this->data['shortlisted'] =$this->jobprocessmodel->get_shortlisted($id);
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$this->data['formdata'] =$query->row_array();
			
			$sql="select DISTINCT a.* from  pms_candidate a inner join pms_candidate_job_profile b on a.candidate_id=b.candidate_id LEFT JOIN pms_candidate_to_skills c on a.candidate_id=c.candidate_id LEFT JOIN pms_candidate_education d on a.candidate_id=d.candidate_id LEFT JOIN pms_candidate_to_certification e on a.candidate_id=e.candidate_id ";
			
			$where=' where a.candidate_id not in(select candidate_id from pms_job_apps where job_id='.$id.')  ';
			
			if($this->input->post('job_cat_id')!='')$where=' and b.job_cat_id='.$this->input->post('job_cat_id');
		
			if($where!='') $sql.=$where;			
			
			$sql.="  limit 0,100";
				
			$query=$this->db->query($sql);
			//echo $this->db->last_query();
			$data["candidates"]=$query->result_array();
			//echo $query->num_rows();exit;
			$this->data['interview_time_ar']=array(
						'7:00 AM' => '7:00 AM',
						'7:30 AM' => '7:30 AM',
						'8:00 AM' => '8:00 AM',
						'8:30 AM' => '8:30 AM',
						'9:00 AM' => '9:00 AM',
						'9:30 AM' => '9:30 AM',
						'10:00 AM' => '10:00 AM',
						'10:30 AM' => '10:30 AM',
						'11:00 AM' => '11:00 AM',
						'11:30 AM' => '11:30 AM',
						'12:00 PM' => '12:00 PM',
						'12:30 PM' => '12:30 PM',
						'1:00 PM' => '1:00 PM',
						'1:30 PM' => '1:30 PM',
						'2:00 PM' => '2:00 PM',
						'2:30 PM' => '2:30 PM',
						'3:00 PM' => '3:00 PM',
						'3:30 PM' => '3:30 PM',
						'4:00 PM' => '4:00 PM',
						'4:30 PM' => '4:30 PM',
						'5:00 PM' => '5:00 PM',
						'5:30 PM' => '5:30 PM',
						'6:00 PM' => '6:00 PM',
						'6:30 PM' => '6:30 PM',
						'7:00 PM' => '7:00 PM');
			
			$this->data["interview_type"] = $this->interviewtypemodel->get_type_list();
			$this->data["int_status_id"] = $this->interviewstatusmodel->get_model_list();
			
			$this->load->view('include/header',$this->data);
			$this->load->view('include/job_sidebar',$this->data);
			$this->load->view('jobprocess/jobprocess_applied',$this->data);	
			$this->load->view('include/footer',$this->data);
		}else
		{
			redirect('jobprocess');
		}
	}
	
	function delete_applied_candidate()
	{
		
		$id     = $this->input->get('job_app_id');
		$c_id   = $this->input->get('candidate_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query(' SELECT * FROM pms_job_apps_shortlisted WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")')->result();
			
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);
					header('Content-type: application/json');    					
					echo json_encode($response);			
			}					
			else
			{					
					$result = $this->db->query('DELETE FROM pms_job_apps WHERE (job_app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
					$applied =$this->jobprocessmodel->get_candidate_list($job_id);
					$count =count($applied);
					$this->db->where('job_id', $job_id);
					$query=$this->db->get('pms_jobs');
					$formdata =$query->row_array();
					
					$html='
						<td colspan="2" align="center" valign="top">	
						
						<table border="1" cellpadding="3" cellspacing="3" width="95%">
						  <tbody >';
					
					foreach($applied as $candidate)
					{
						
						$html.='<tr>
								  <td width="44%"><a href="'.base_url().'index.php/candidates_all/summary/'.$candidate['candidate_id'].'" target="_blank">'.$candidate['first_name'].' '.$candidate['last_name'].'</a></td>
								  <td width="31%">'.$candidate['skills'].'</td>          
								  <td width="25%"><a href="javascript:;"  data-url="'.base_url().'index.php/jobprocess/shortlist2/?job_app_id='.$candidate['job_app_id'].'&candidate_id='.$candidate['candidate_id'].'&job_id='.$formdata['job_id'].'"  id="shortlisted_candidate" > Short List </a> | <a href="javascript:;"  data-url="'.base_url().'index.php/jobprocess/delete_applied_candidate/?job_app_id='.$candidate['job_app_id'].'&candidate_id='. $candidate['candidate_id'].'&job_id='.$formdata['job_id'].'"  id="delete_applied_candidate" > Delete </a></td>
          
         					  </tr>';
					}	
						
						
					$html .=' </tbody> </table> ';
			
					$response = array(
						'data' => $html,
						'status'=>'success',
						'count' => $count,
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
			
		
	}
	
	function delete_shortlisted_candidate()
	{
		
		$id     = $this->input->get('job_app_id');
		$c_id   = $this->input->get('candidate_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query('SELECT * FROM pms_job_apps_interviews WHERE (job_app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")')->result();
			
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{
					// remove from short list
					$result = $this->db->query(' DELETE FROM pms_job_apps_shortlisted WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
					// update in apps
					$this->db->query(' update pms_job_apps set app_status_id=1 where job_app_id='.$id.' AND candidate_id ='.$c_id);
					
					$shortlisted =$this->jobprocessmodel->get_shortlisted($job_id);
					$count = count($shortlisted);
					$this->db->where('job_id', $job_id);
					$query=$this->db->get('pms_jobs');
					$formdata =$query->row_array();
					
					$html='
						<td colspan="2" align="center" valign="top">
						
						
						<table border="1" cellpadding="3" cellspacing="3" width="95%">
						  <tbody >';
					
					
					
					foreach($shortlisted as $candidate){
						
						$html.='<tr>
								  <td width="44%"><a href="'.base_url().'index.php/candidates_all/summary/'.$candidate['candidate_id'].'" target="_blank">'.$candidate['first_name'].' '.$candidate['last_name'].'</a></td>
								  <td width="31%">'.$candidate['skills'].'</td>          
								 <td width="25%"> <a href="javascript:;"  onclick="interview('.$candidate['candidate_id'].','.$candidate['job_app_id'].','.$formdata['job_id'].')" >Interview</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/jobprocess/delete_shortlisted_candidate/?job_app_id='.$candidate['job_app_id'].'&candidate_id='.$candidate['candidate_id'].'&job_id='.$formdata['job_id'].'"  id="delete_shortlisted_candidate" >Remove</a></td>
			
								  
							   </tr>';		
			 
					}
						
						$html .=' </tbody> </table> ';
					
					
			
					$response = array(
						'data' => $html,
						'status'=>'success',
						'count' => $count,
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
			
		
	}
	
	function delete_selectedcandidate()
	{
		
		$id     = $this->input->get('job_app_id');
		$c_id   = $this->input->get('candidate_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query('SELECT * FROM pms_job_apps_offerletter WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")')->result();
				//echo $this->db->last_query();
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{
					
					$result = $this->db->query('DELETE FROM pms_job_apps_selected WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
					//$query = $this->db->query("update pms_job_apps_interviews set int_status='2' where job_app_id=".$id);
					//echo $this->db->last_query();
					$this->db->where('job_id', $job_id);
					$query=$this->db->get('pms_jobs');
					$formdata =$query->row_array();
					//$this->jobprocessmodel->common_delete2($this->input->get('app_id'),$this->input->get('candidate_id'),'pms_job_apps_interviews');
					$candidates_selected =$this->jobprocessmodel->candidates_selected($job_id);
					$count = count($candidates_selected);
					
					$html=' <td colspan="2" align="center" valign="top">
					<table border="1" cellpadding="3" cellspacing="3" width="95%">
						 <tbody >					
						  <tr>
							<td bgcolor="#CCCCCC">Candidate</td>
							<td bgcolor="#CCCCCC">Select Date</td>
							<td bgcolor="#CCCCCC">Time</td>
							<td bgcolor="#CCCCCC">Place</td>
							<td bgcolor="#CCCCCC">Duration</td>
							<td bgcolor="#CCCCCC">Feedback/Rate</td>
							<td width="37%" bgcolor="#CCCCCC">Description</td>
						  </tr>';
						
						  foreach($candidates_selected as $selected){
							  
							  $html.='<tr>
										  <td width="13%"><a href="'.base_url().'index.php/candidates_all/summary/'.$selected['candidate_id'].'" target="_blank">'.$selected['first_name'].' '.$selected['last_name'].'</a></td>
										  <td width="13%">'.date("d-m-Y", strtotime($selected['select_date'])).'</td>
										  <td width="14%">&nbsp;</td>
										  <td width="12%">&nbsp;</td>
										  <td width="11%">&nbsp;</td>
										  <td width="11%">'.$selected['feedback'].'</td>
										  <td><a href="javascript:;"  data-url="'.base_url().'index.php/jobprocess/delete_selectedcandidate/?job_app_id='.$selected['app_id'].'&candidate_id='.$selected['candidate_id'].'&job_id='.$formdata['job_id'].'"  id="delete_selected_candidate" >Remove </a>| <a href="javascript:;" onclick="issue_offer('.$formdata['job_id'].','.$selected['app_id'].','.$selected['candidate_id'].');" id="issue_offer"> Issue Offer </a>|<a href="'.base_url().'index.php/candidates_all/summary/'.$selected['candidate_id'].'" target="_blank"> Profile </a> </td>';
					
						   }
    
					$html .=' </tbody> </table> ';
			
					$response = array(
						'data' => $html,
						'status'=>'success',
						'count' => $count,
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
			
		
	}
	
	function delete_offercandidate()
	{
		
		$id     = $this->input->get('job_app_id');
		$c_id   = $this->input->get('candidate_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query('SELECT * FROM pms_job_apps_placement WHERE app_id ="'.$id.'" ' )->result();
				//echo $this->db->last_query();
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{
					
					$result = $this->db->query('DELETE FROM pms_job_apps_offerletter WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
					//echo $this->db->last_query();
					$this->db->where('job_id', $job_id);
					$query=$this->db->get('pms_jobs');
					$formdata =$query->row_array();
					//$this->jobprocessmodel->common_delete2($this->input->get('app_id'),$this->input->get('candidate_id'),'pms_job_apps_interviews');
					$data['offer_letters_issued']=$this->jobprocessmodel->offer_letters_issued($job_id);
					
					$offer_letters_issued =$this->jobprocessmodel->offer_letters_issued($job_id);
					$count= count($offer_letters_issued);
										

					$response = array(
						
						'status'=>'success',
						
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
			
		
	}
	
	function delete_acceptcandidate()
	{		
		$id         = $this->input->get('placement_id');
		$job_id     = $this->input->get('job_id');		
		$this->load->model('jobprocessmodel');				
		if($this->input->get('placement_id')!='')
		{
			$result = $this->db->query('SELECT * FROM pms_job_apps_invoice WHERE placement_id ="'.$this->input->get('placement_id').'" ' )->result();				
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);
					header('Content-type: application/json');    					
					echo json_encode($response);			
			}			
			else
			{
					$result = $this->db->query('DELETE FROM pms_job_apps_placement WHERE placement_id ="'.$id.'"');
					$response = array(
						'status'=>'success',
					);
					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
	}

	function add_to_job()
	{
		$job_id = $this->input->get('job_id');
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('job_id')!='' && $this->input->get('candidate_id')!='')
		{
		
				$result = $this->jobprocessmodel->add_to_job();

					$applied =$this->jobprocessmodel->get_candidate_list($job_id);
					$count =count($applied);
					$this->db->where('job_id', $job_id);
					$query=$this->db->get('pms_jobs');
					$formdata =$query->row_array();
					
					$html='
						<td colspan="2" align="center" valign="top">	
						
						<table border="1" cellpadding="3" cellspacing="3" width="95%">
						  <tbody >';
					
					foreach($applied as $candidate)
					{
						
						$html.='<tr>
								  <td width="44%"><a href="'.base_url().'index.php/candidates_all/summary/'.$candidate['candidate_id'].'" target="_blank">'.$candidate['first_name'].' '.$candidate['last_name'].'</a></td>
								  <td width="31%">'.$candidate['skills'].'</td>          
								  <td width="25%"><a href="javascript:;"  data-url="'.base_url().'index.php/jobprocess/shortlist2/?job_app_id='.$candidate['job_app_id'].'&candidate_id='.$candidate['candidate_id'].'&job_id='.$formdata['job_id'].'"  id="shortlisted_candidate" > Short List </a> | <a href="javascript:;"  data-url="'.base_url().'index.php/jobprocess/delete_applied_candidate/?job_app_id='.$candidate['job_app_id'].'&candidate_id='. $candidate['candidate_id'].'&job_id='.$formdata['job_id'].'"  id="delete_applied_candidate" > Delete</a></td>
          
         					  </tr>';
					}	
						
						
					$html .=' </tbody> </table> ';
			
					$response = array(
						'data' => $html,
						'status'=>'success',
						'count' => $count,
					);


					header('Content-type: application/json');    					
					echo json_encode($response);
			
		}
		}
		
	function edit_interview()
	{
		
		$id     = $this->input->get('job_app_id');
		$c_id = $this->input->get('candidate_id');
		
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('candidate_id')!='')
		{
				$this->db->where('job_app_id', $id);
				$this->db->where('candidate_id', $c_id);
				$query=$this->db->get('pms_job_apps_interviews');
				$formdata =$query->row_array();
				header('Content-type: application/json');    					
				echo json_encode($formdata);
		}
	}
			
	function delete_shortlisted()
	{
		
		$id     = $this->input->get('job_app_id');
		$c_id   = $this->input->get('candidate_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query('SELECT * FROM pms_job_apps_interviews WHERE (job_app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")')->result();
			
			if(!empty($result))
			{
					redirect('jobprocess/shortlist/'.$this->input->get('job_id').'/?del=1');
			}			
			
			else
			{
					
					$result = $this->db->query(' DELETE FROM pms_job_apps_shortlisted WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
					redirect('jobprocess/shortlist/'.$this->input->get('job_id').'/?del=2');
			}
		}
			
		
	}
	
//CREATE TICKET
	function create_ticket()
	{
		
		$id =$this->input->post('job_id');
		$this->load->model('jobprocessmodel');
				
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('date')!='')
		{
			$this->jobprocessmodel->create_ticket();
			
    
			$response = array(
			    
				'status'=>'success',
			);

			header('Content-type: application/json');
			echo json_encode($response);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
		
		
	}	

//DELETE TICKET DETAILS
	function delete_ticket()
	{
		
		$id     = $this->input->get('ticket_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobprocessmodel');		
		
		if($this->input->get('ticket_id')!='')
		{
			$result = $this->db->query('SELECT 	send_by,send_mode,travel_followup,pickup_followup,travel_confirmation,travel_document FROM pms_job_apps_ticket 
									   WHERE ticket_id ='.$id)->row_array();
			
			if(count(array_filter($result)) == count($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{			
				$result = $this->db->query('DELETE FROM pms_job_apps_ticket WHERE ticket_id ="'.$id.'"');
				
				$response = array(
					
					'status'=>'success',
					
				);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
	}	
//onchange get function	
	public function getfunction()
	{		
		$this->load->model('jobprocessmodel');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$data["function_list"] = $this->jobprocessmodel->function_list_by_category($_POST['category_id']);
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
}
?>
