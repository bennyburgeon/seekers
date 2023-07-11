<?php 
class Intakes extends CI_Controller {

	function intakes()
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
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=25;
		}
		$rows='';
		$this->load->model('intakesmodel');
		
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
		$sort_by=$this->input->get("sort_by");
		}
		else
		{
		$sort_by = 'asc';
		}
		if($this->input->get("rows")!='')
		{
		$start=$this->input->get("rows");
		}
		if($this->input->get("rows")!='')
		{
		$rows=$this->input->get("rows");
		}
		
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->intakesmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/intakes/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->intakesmodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Intakes';
				
				
		$this->load->view('include/header');
		$this->load->view('intakes/listintakes',$this->data);				
		$this->load->view('include/footer');
	}	

	function add()
	{	
		$data['formdata']=array(
		'intake_start'=> '' ,
		'intake_end' => '' ,
		'join_date' => '' ,
		'campus_id'=> '' ,
		'job_cat_id'=> '' ,
		
		);
		
		$this->load->model('intakesmodel');
		$this->load->model('countrymodel');
		//$this->load->model('candidateallmodel');	
		$data["company"] = $this->intakesmodel->fill_company();
		$data["university"] = $this->intakesmodel->get_university();
	
			
		
		if($this->input->post('campus_id') )
		{
			
			$this->form_validation->set_rules('campus_id', 'college name', 'required');
			
			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->intakesmodel->insert_record();
				redirect('intakes/?ins=1');
			}
				
				$data['formdata']=array(
				'intake_start' => $this->input->post('intake_start'),
				'intake_end'   => $this->input->post('intake_end'),
				'join_date'    => $this->input->post('join_date') ,
				'campus_id'    => $this->input->post('campus_id') ,
							
				);exit;

		}
				
				$this->data['page_head']= 'Add Intakes';
				$this->load->view('include/header');
				$this->load->view('intakes/addintakes',$data);	
				$this->load->view('include/footer');
	}

	
	function edit($id=null)
	{

		$data['page_head']= 'Edit Jobs';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('intakesmodel');
		
		$data['intake_details']=$this->intakesmodel->get_intake_details($id);
		$data["university"] = $this->intakesmodel->get_university();
		$data["college_list"] = $this->intakesmodel->get_colleges();
		
		$this->load->view('include/header');
		$this->load->view('intakes/editintakes',$data);	
		$this->load->view('include/footer');
	}	
	
	
	
	function update(){
		$id = $this->input->post('intake_id');
		$data['page_head']= 'Edit Jobs';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('intakesmodel');
		$this->load->model('countrymodel');
		if(!empty($id))
		{
			if($this->input->post('campus_id'))
			{
					$this->form_validation->set_rules('campus_id', 'college name', 'required');
					
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('intakesmodel');
						$id=$this->intakesmodel->update_record($id);
						
						redirect('intakes/?update=1');
					}
					else
					{
						$data['formdata']=array(
							'intake_start' => $this->input->post('intake_start'),
							'intake_end'   => $this->input->post('intake_end'),
							'join_date'    => $this->input->post('join_date') ,
							'campus_id'    => $this->input->post('campus_id') ,
							);
					}
			}
			else
			{
				redirect('intakes');
			}	
		}	
		else
			{
				redirect('intakes');
			}	
	}
	
	
	
	//onchange get College
	public function getcollege()
	{		
		$this->load->model('intakesmodel');
		if(isset($_POST['univ_id']) && $_POST['univ_id']!='')
		{
			$data=array();
			$data["college_list"] = $this->intakesmodel->college_list_by_university($_POST['univ_id']);
			$college  ='';
			
			//print_r($data["course_list"]);exit;
			
			foreach($data["college_list"] as $key=>$value)
			{
				$college.='<option value="'. $key .'">' . $value . '</option>';
			}
			
			$data = array('success' => true, 'college_list' => $college);
		}
		else
		{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}

	// intakes single delete
	
	function delete($id=null)
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		$this->load->model('intakesmodel');
		if(!empty($id))
		{		
			
			$id=$this->intakesmodel->delete_records($id);
			
		}elseif(is_array($this->input->post('checkbox')))
		{
			$id=$this->intakesmodel->delete_records($this->input->post('checkbox'));
		}
		if($id==true)
			redirect('intakes/?del=1');
		else
			redirect('intakes/?del=2');
		
	}
	
	// intakes multiple delete
	
	function multidelete(){
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
			$this->load->model('intakesmodel');
			$this->intakesmodel->delete_multiple_record($id_arr);
			redirect('intakes/?multi=1');
		}
		else{
			redirect('intakes');
		}
	}

	

	function manage($id=null)
	{

		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('intakesmodel');
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
			
			$data['page_head']= 'Manage Job';

			$data['intake']=$this->intakesmodel->intake_details($id);
			
			//$data['applied_candidates']=$this->intakesmodel->get_candidate_list($id);
			
		/*	$data['formdata']['company_name']=$this->companymodel->get_company_name($data['formdata']['company_id']);
			$data['formdata']['industry']=$this->jobindmodel->get_industry_name($data['formdata']['job_cat_id']);
			$data['formdata']['category']=$this->jobcatmodel->get_category_name($data['formdata']['job_cat_id']);
			$data['formdata']['fun_area']=$this->jobareamodel->get_fun_area($data['formdata']['func_id']);
			
			$data['formdata']['job_type']=$this->jobtypemodel->get_job_type($data['formdata']['job_type_id']);
			$data['formdata']['job_level']=$this->levelmodel->get_level_name($data['formdata']['level_id']);
			$data['formdata']['work_level']=$this->worklevelmodel->get_work_level($data['formdata']['work_level_id']);	
			$data['formdata']['salary_level']=$this->salarymodel->get_salary_range($data['formdata']['salary_id']);
			
			$data['formdata']['country_name']=$this->countrymodel->get_country_name($data['formdata']['country_id']);
			$data['formdata']['skill']=$this->skill_mgmt_model->get_skill_name($data['formdata']['job_skills']);
			
			$data['applied_candidates']=$this->intakesmodel->get_candidate_list($id);
			$data['shortlisted']=$this->intakesmodel->get_shortlisted($id);
			$data['interview_list']=$this->intakesmodel->get_interview_list($id);
			//echo $this->db->last_query();
			$data['candidates_selected']=$this->intakesmodel->candidates_selected($id);
			$data['offer_letters_issued']=$this->intakesmodel->offer_letters_issued($id);
			$data['offer_accepted']=$this->intakesmodel->offer_accepted($id);
			$data['invoice_generated']=$this->intakesmodel->invoice_generated($id);

			$data['invoice_list2']=$this->intakesmodel->invoice_generated($id);


			
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
		//echo $this->db->last_query();
		$data["int_status_id"] = $this->interviewstatusmodel->get_model_list();*/
			$data["edu_level_list"] = $this->intakesmodel->edu_level_list();
			
			$data["edu_course_list"] = array('' => 'Select Course');
			$this->load->view('include/header');
			$this->load->view('intakes/summary',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('intakes');
		}
	}
//INSTRUCTION AND GUIDE LINES

	function instructions($id=null)
	{

		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('intakesmodel');
		$this->load->model('countrymodel');
		
		
		if(!empty($id))
		{
			
			$data['page_head']= 'Manage Job';
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$data['formdata']=$query->row_array();
			
			$data['row']=$this->countrymodel->get_country($data['formdata']['country_id']);
			
			$this->load->view('include/header');
			$this->load->view('intakes/instructions',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('intakes');
		}
	}
	
	function addcandidate($id=null)
	{
		$data["postdata"]["job_cat_id"]='';
		$data["postdata"]["func_id"]='';
		$data["postdata"]["skills"]='';
		$data["postdata"]["cert"]='';
		$data["postdata"]["level_id"]='';
		$data["postdata"]["course_id"]='';
		$data["postdata"]["spcl_id"]='';
		$data["postdata"]["exp_years"]='';
		$data["postdata"]["exp_months"]='';
		$data["postdata"]["contract_start_date"]='';
		$data["postdata"]["contract_end_date"]='';
		//$data["postdata"]["country_id"]='';
				
		$this->load->model('intakesmodel');
		
		if(is_array($this->input->post('delete_rec')) && $this->input->post('intake_id')!='')
		{ 
			$this->intakesmodel->addcandidate($this->input->post('delete_rec'),$this->input->post('intake_id'));
			redirect('intakes/addcandidate/'.$this->input->post('intake_id'));
		}
				
		$data['upload_root']=$this->config->item('base_url');
			
		if($id!='')
		{
			$data['page_head']= 'Add Candidates';
			
			$this->load->model('intakesmodel');
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
			$data["jobcategory"] = $this->intakesmodel->fill_jobcategory();
			$data["functional"] = array('' => 'Select Functional Role');
			$data["education"] = $this->intakesmodel->fill_education();
			$data["salary"] = $this->intakesmodel->fill_salary();
			$data["worklevel"]= $this->intakesmodel->fill_worklevel();
			$data["nationality"] = $this->countrymodel->country_list();
			$data['cerifications']=$this->intakesmodel->get_cert();
//Education details
			$data["edu_level_list"] = $this->candidateallmodel->edu_level_list();
			//$data["edu_course_list"] = $this->candidateallmodel->edu_course_list();
			

			
			$data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
			
			$data["years_list"] = $this->candidateallmodel->years_list();
			$data["months_list"] = $this->candidateallmodel->months_list();
			
			$data["jobtype"] = $this->intakesmodel->jobtype_list();
			$data['applied_candidates']=$this->intakesmodel->get_candidate_list($id);
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$data['formdata'] =$query->row_array();
			
			$sql='select DISTINCT a.*,g.total_exp from  pms_candidate a LEFT join pms_candidate_job_profile b on a.candidate_id=b.candidate_id LEFT JOIN pms_candidate_to_skills_primary c on a.candidate_id=c.candidate_id LEFT JOIN pms_candidate_education d on a.candidate_id=d.candidate_id LEFT JOIN pms_candidate_to_certification e on a.candidate_id=e.candidate_id LEFT JOIN pms_candidate_contract g on a.candidate_id=g.candidate_id';
			
			$where=' where a.candidate_id not in(select candidate_id from pms_intake_candidate where intake_id='.$id.')  ';
			
//contracts ending between (jobstart date -30 days) and (job end date +30 days)
		$query = $this->db->query('SELECT intake_start,intake_end from pms_intakes where intake_id='.$id);
		$result=$query->row();
		$data['start_date']= date('Y-m-d', strtotime($result->intake_start .'- 30 days'));
		$data['end_date']= date('Y-m-d', strtotime($result->intake_end .'+ 30 days'));
		//$data['contracts_ending']=$this->intakesmodel->contracts_ending($id,$data['start_date'],$data['end_date']);
			
			
			if($this->input->post('job_cat_id')!='')$where=' and b.job_cat_id='.$this->input->post('job_cat_id');
		
			if($this->input->post('func_id')!='')
				if($where!='')
				{
					$where.=' and b.func_id='.$this->input->post('func_id');
				}else
				{
					$where.=' b.func_id='.$this->input->post('func_id');
				}
				
				if($this->input->post('exp_years')!='')
				if($where!='')
				{
					$where.=' and g.total_exp="'.$this->input->post('exp_years').' "';
				}else
				{
					$where.=' g.total_exp="'.$this->input->post('exp_years').' "';
				}

				
				if($this->input->post('contract_start_date')!='' && $this->input->post('contract_end_date')!=''){ 
				if($where!='')
				{
					$where.=' and g.end_date between "'.$this->input->post('contract_start_date').'" and "'.$this->input->post('contract_end_date').'"';
				}else
				{
					$where.=' g.end_date between "'.$this->input->post('contract_start_date').'" and "'.$this->input->post('contract_end_date').'"';
				}
				}
			
				if($this->input->post('exp_months')!='')
				if($where!='')
				{
					$where.=' and a.exp_months='.$this->input->post('exp_months');
				}else
				{
					$where.=' a.exp_months='.$this->input->post('exp_months');
				}
				
				
			//print_r($this->input->post('skills'));exit;
			if($this->input->post('skills')!='')
				if($where!='')
				{
					$where.=' and c.skill_id in ('.$this->input->post('skills').') ';
				}else
				{
					$where.=' c.skill_id in ('.$this->input->post('skills').') ';
				}
//certifications
				if($this->input->post('cert')!='')
				if($where!='')
				{
					$where.=' and e.cert_id in ('.$this->input->post('cert').') ';
				}else
				{
					$where.=' e.cert_id in ('.$this->input->post('cert').') ';
				}
//level				
				if($this->input->post('level_id')!='')
				if($where!='')
				{
					$where.='and d.level_id =' .$this->input->post('level_id').' ';
				}else
				{
					$where.=' d.level_id =' .$this->input->post('level_id').' ';
				}
//course				
				if($this->input->post('course_id')!='')
				if($where!='')
				{
					$where.='and d.course_id =' .$this->input->post('course_id').' ';
				}else
				{
					$where.=' d.course_id =' .$this->input->post('course_id').' ';
				}
				
//specilalistion				
				if($this->input->post('spcl_id')!='')
				if($where!='')
				{
					$where.='and d.spcl_id =' .$this->input->post('spcl_id').' ';
				}else
				{
					$where.=' d.spcl_id =' .$this->input->post('spcl_id').' ';
				}
			/*if($this->input->post('country_id')!='')
				if($where!='')
				{
					$where.=' and a.current_location='.$this->input->post('country_id');
				}else
				{
					$where.=' a.current_location='.$this->input->post('country_id');
				}*/
			
			if($where!='') $sql.=$where;			

			$data["postdata"]["intake_id"]=$id;
			$data["postdata"]["job_cat_id"]=$this->input->post('job_cat_id');
			$data["postdata"]["job_cat_id"]=$this->input->post('job_cat_id');
			$data["postdata"]["func_id"]=$this->input->post('func_id');
			$data["postdata"]["skills"]=$this->input->post('skills');
			$data["postdata"]["cert"]=$this->input->post('cert');
			$data["postdata"]["level_id"]=$this->input->post('level_id');
			$data["postdata"]["course_id"]=$this->input->post('course_id');
			$data["postdata"]["spcl_id"]=$this->input->post('spcl_id');
			$data["postdata"]["exp_years"]=$this->input->post('exp_years');
			$data["postdata"]["exp_months"]=$this->input->post('exp_months');
			if($this->input->post('contract_start_date')!='' && $this->input->post('contract_end_date')!='')
			{
				$data["postdata"]["contract_start_date"]=$this->input->post('contract_start_date');
				$data["postdata"]["contract_end_date"]=$this->input->post('contract_end_date');
			}
			else if(empty($_POST)){
				$data["postdata"]["contract_start_date"]=$data['start_date'];
				$data["postdata"]["contract_end_date"]=$data['end_date'];
			}
			//$data["postdata"]["country_id"]=$this->input->post('country_id');	
			
			$query=$this->db->query($sql);
			//echo $this->db->last_query();exit;
			$data["candidates"]=$query->result_array();//print_r($data["candidates"]);exit;
			//echo $query->num_rows();exit;
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

			if($data["postdata"]["level_id"] !='')
			{
				$data["edu_course_list"] = $this->coursemodel->get_course_list($data["postdata"]["level_id"],1);
			}
			else{
				$data["edu_course_list"]  = array('' => 'Select Course');
			}
			
		$data["interview_type"] = $this->interviewtypemodel->get_type_list();
		$data["int_status_id"] = $this->interviewstatusmodel->get_model_list();

//Certification and Technical Skilss

		
		$data['skill_list']=$this->candidateallmodel->get_parent_skills();
		//print_r($data['skill_list']);exit;
		$certs=array();
		
		if($data["postdata"]["cert"]!='')
		{
			$data["postdata"]["cert"]	=	explode(',',$data["postdata"]["cert"]);
		}
		else{
				$data["postdata"]["cert"]	= array();
			}
		
		foreach($data["postdata"]["cert"] as $cert)
		{
			$certs[]=$cert;
		}
		$data['candidate_certifications']	=	$certs;
		
		$skills=array();
		
		if($data["postdata"]["skills"]!='')
		{
			$data["postdata"]["skills"]	=	explode(',',$data["postdata"]["skills"]);
		}
		else{
				$data["postdata"]["skills"]	= array();
			}
		
		foreach($data["postdata"]["skills"] as $skill)
		{
			$skills[]=$skill;
		}
		$data['candidate_skills']	=	$skills;

		$data['res']	=	array();
		$data['res1']	=	array();
		
		if(!empty($skill))
		{
		$qry	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$skill);
		$data['res']	= $res	=	$qry->result_array();
		
		$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
		$data['res1']	= $res1 =	$qry1->result_array();
		
		$data['child_skills']	=	$this->candidateallmodel->get_child_skills($res1[0]['skill_id']);
		}
		
			$this->load->view('include/header');
			$this->load->view('intakes/candidates',$data);	
			$this->load->view('include/footer');

		}else
		{
			redirect('intakes');
		}
	}

// onchange get course
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
	
	
	function shortlist($id=null)
	{
		
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		$data["postdata"]["job_cat_id"]='';
		$data["postdata"]["func_id"]='';
		$data["postdata"]["country_id"]='';
				
		$this->load->model('intakesmodel');
		
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
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
	
			$this->intakesmodel->shortlist($this->input->post('candidate_id'),$this->input->post('intake_id'),$this->input->post('app_id'));
			//echo $this->db->last_query();exit;
			redirect('intakes/shortlist/'.$this->input->post('intake_id'));
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
			
		
			$data["postdata"]["intake_id"]=$id;
			$data["postdata"]["app_id"]=$this->input->get('app_id');

			$data['applied_candidates']=$this->intakesmodel->applied_candidates($id);

			$data['shortlisted_candidates']=$this->intakesmodel->get_shortlisted($id);
			
			$this->load->view('include/header');
			$this->load->view('intakes/shortlist',$data);	
			$this->load->view('include/footer');

		}else
		{
			redirect('intakes/shortlist');
		}
	}
	
	function shortlist2()
	{
		$id = $this->input->get('intake_id');
		$this->load->model('intakesmodel');		
		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$this->intakesmodel->shortlist2();
			
			$shortlisted =$this->intakesmodel->get_shortlisted($id);
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$formdata =$query->row_array();
			
			$html='
						<td colspan="2" align="center" valign="top">
						
						
						<table border="1" cellpadding="3" cellspacing="3" width="95%">
						  <tbody >';
					
					
					
					foreach($shortlisted as $candidate){
						
						$html.='<tr>
								  <td width="44%"><a href="#" target="_blank">'.$candidate['first_name'].' '.$candidate['last_name'].'</a></td>
								  <td width="31%">'.$candidate['skills'].'</td>          
								 <td width="25%"> <a href="javascript:;"  onclick="interview('.$candidate['candidate_id'].','.$candidate['job_app_id'].','.$formdata['intake_id'].')" >Interview</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_shortlisted_candidate/?job_app_id='.$candidate['job_app_id'].'&candidate_id='.$candidate['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="delete_shortlisted_candidate" >Remove From List</a></td>
			
								  
							   </tr>';		
			 
					}
						
						$html .=' </tbody> </table> ';
					
    
			
    
			$response = array(
			    'data' => $html,
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	
			
		
	}

	function addinterview($id='null')
	{
		$this->load->model('intakesmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
	
		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('title')!='' )
		{
			$intake_id=$this->intakesmodel->add_interview();	
			redirect('intakes/manage/'.$id);

		
		}
		
		$this->data['formdata']=array(
		'job_app_id'=> '' ,
		'candidate_id' => '' ,
		'company_id' => '' ,
		'interview_date'=> '' ,
		'title'=> '' ,
		'description' => '',
		'duration'=> '' ,
		'interview_time'=> '' ,
		'interview_type_id'=> '' ,
		'int_status_id'=> '' ,
		'location' => '',
		);

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


		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$this->data['page_head']= 'Add Interviews';
			$this->data['candidate_id']=$this->input->get('candidate_id');
			$this->data['job_app_id']=$this->input->get('job_app_id');
			$this->data['formdata']['intake_id']=$this->input->get('intake_id');
			$this->load->view('include/header',$this->data);
			$this->load->view('intakes/addinterview',$this->data);	
			$this->load->view('include/footer',$this->data);


		}
		else
		{
			redirect('intakes/manage/'.$id);}

			
	}


	function addinterview2()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('title')!='' )
		{
			$intake_id=$this->intakesmodel->add_interview();	
			
			
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$formdata =$query->row_array();
					
			$interview_list =$this->intakesmodel->get_interview_list($id);
			
            
					
					$html='<td colspan="2" align="center" valign="top">
    				
					<table border="1" cellpadding="3" cellspacing="3" width="95%">					
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
  				
				foreach($interview_list as $interview){
					  $datetime = explode(" ",$interview['interview_date']);
					  
			$html.=	'<tr>
						  <td width="13%"><a href="#" target="_blank">'.$interview['first_name'].' '.$interview['last_name'].'</a></td>
						  <td width="13%">'.date("d-m-Y", strtotime($datetime[0])).'</td>
						  <td width="13%">'.$interview['interview_time'].'</td>
						  <td width="14%">'.$interview['location'].'</td>
						  <td width="12%">'.$interview['interview_type'].'</td>
						  <td width="11%">'.$interview['description'].'</td>
						  <td><a href="javascript:;"  data-url="'.base_url().'index.php/intakes/edit_interview/?job_app_id='.$interview['job_app_id'].'&candidate_id='.$interview['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="edit_interview" >Change</a> |<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_interview_candidate/?job_app_id='.$interview['job_app_id'].'&candidate_id='.$interview['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="delete_interview_candidate" >Remove </a>| <a href="'.base_url().'index.php/intakes/removeschedule/?intake_id=10&intid=12" target="_blank"> View Profile </a> | <a href="javascript:;"  onclick="select_candidate('.$interview['candidate_id'].','.$interview['job_app_id'].','.$formdata['intake_id'].')" > Select </a></td>';
   
						
				}
				
				$html .=' </tbody> </table> ';
					
    
			$response = array(
			    'data' => $html,
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
		$this->load->model('intakesmodel');

		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$this->intakesmodel->select_candidate();
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$formdata =$query->row_array();
			//$this->intakesmodel->common_delete2($this->input->get('app_id'),$this->input->get('candidate_id'),'pms_job_apps_interviews');
			$candidates_selected =$this->intakesmodel->candidates_selected($id);
			
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
										  <td width="13%"><a href="#" target="_blank">'.$selected['first_name'].' '.$selected['last_name'].'</a></td>
										  <td width="13%">'.date("d-m-Y", strtotime($selected['select_date'])).'</td>
										  <td width="14%">&nbsp;</td>
										  <td width="12%">&nbsp;</td>
										  <td width="11%">&nbsp;</td>
										  <td width="11%">'.$selected['feedback'].'</td>
										  <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_selectedcandidate/?job_app_id='.$selected['app_id'].'&candidate_id='.$selected['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="delete_selected_candidate" >Remove </a>| <a href="'.base_url().'index.php/intakes/removeschedule/?intake_id=10&intid=12" target="_blank"> View Profile </a> | <a href="javascript:;" onclick="issue_offer('.$formdata['intake_id'].','.$selected['app_id'].','.$selected['candidate_id'].');" id="issue_offer"> Issue Offer </a></td>';
					
						   }
    
			$html .=' </tbody> </table> ';
    
			$response = array(
				'status'=>'success',
			    'data' => $html,
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	
	}
	
//get selected CAndidate

function get_select_candidate()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$interview_schedule = $this->intakesmodel->interview_schedule($id);
		
		$html1='';
		$html2='';
		if(!empty($interview_schedule)){
			
			$html1 ='<td colspan="2" align="center" valign="top"><br>
						Candidates Schedule for Another Job with same Skills,but not selected.
					</td>';
									
			
			$html2='<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
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
									  <td width="13%"><a href="#" target="_blank">'.$interview['first_name'].' '.$interview['last_name'].'</a></td>
									  <td width="13%">'.date("d-m-Y", strtotime($datetime[0])).'</td>
									  <td width="13%">'.$interview['interview_time'].'</td>
									  <td width="14%">'.$interview['location'].'</td>
									  <td width="12%">'.$interview['interview_type'].'</td>
									  <td width="11%">'.$interview['description'].'</td>
									  <td> <a href="javascript:;" onclick="select_candidate('.$interview['candidate_id'].','.$interview['job_app_id'].','.$formdata['intake_id'].');" > Select </a></td>';
								
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

function get_candidate_intake()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');

		$applied_candidates=$this->intakesmodel->get_candidate_list($id);


		$html1 ='    <td colspan="2" align="center" valign="top"><br>
      Candidates Applied [<a href="'.$this->config->site_url().'/intakes/addcandidate/'.$id.'">Add more candidates</a>]
    </td>';
		$html2='';
		if(!empty($applied_candidates)){
			

									
			
			$html2='<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					 <tbody >';
						 
						
					 foreach($applied_candidates as $candidate)
					 {
						$passport_type='';
                        if($candidate['passport_type']==1){ 
							$passport_type= 'ECR';
						}
						else if($candidate['passport_type']==2){ 
							$passport_type= 'ECNR';
						} 
						
						$html2.='<tr>
          							<td width="20%"><a href="#" target="_blank">'.$candidate['first_name'].' '.$candidate['last_name'].'</a></td>
          							<td width="20%">'. $candidate['username'].'</td>
									<td width="15%">'. $candidate['mobile'].'</td>
									
          							<td width="10%">'.$passport_type.'</td>
          
									  <td width="10%">'. $candidate['skills'].'</td>  

									  <td width="25%"><a href="javascript:;"  onclick="create_program('.$candidate['candidate_id'].','.$id.');"  id="create_program"> Create Program </a>  | <a href="javascript:;"  data-url="'. base_url().'index.php/intakes/delete_applied_candidate/?intake_candidate_id='. $candidate['intake_candidate_id'].'&candidate_id='. $candidate['candidate_id'].'&intake_id='.$id.'"  id="delete_applied_candidate" > Delete Application</a></td>
          
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
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$offer_letters_issued =$this->intakesmodel->offer_letters_issued($id);
		
		$html1='';
		$html2='';
		if(!empty($offer_letters_issued)){
			
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						Offer Letters Issued for Candidates below 
					</td>';
					
			
			$html2='<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
							<td bgcolor="#CCCCCC">Candidate</td>
							<td bgcolor="#CCCCCC">Offer Date</td>
							<td bgcolor="#CCCCCC">Salary Offered</td>
							
							<td bgcolor="#CCCCCC">Offer Status</td>
							<td width="24%" bgcolor="#CCCCCC">Reason</td>
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
								  <td ><a href="#" target="_blank">'.$offerletter['first_name'].' '.$offerletter['last_name'].'</a></td>
								  <td >'.date("d-m-Y", strtotime($offerletter['offer_date'])).'</td>
								  <td >'.$offerletter['salary_offered'].'</td>
								  
								  <td >'.$offer_status.'</td>
								  <td >'.$offerletter['reason'].'</td>
								  <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_offercandidate/?job_app_id='.$offerletter['app_id'].'&candidate_id='.$offerletter['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="delete_offer_candidate" >Remove </a>| <a href="'.base_url().'index.php/intakes/removeschedule/?intake_id=10&intid=12" target="_blank"> View Profile </a> | <a href="javascript:;" onclick="accept_offer('.$formdata['intake_id'].','.$offerletter['app_id'].','.$offerletter['candidate_id'].');"> Accept Offer </a> | <a href="javascript:;" onclick="reject_offer('.$formdata['intake_id'].','.$offerletter['app_id'].','.$offerletter['candidate_id'].');"> Reject Offer </a></td>';
								
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
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$this->intakesmodel->reject_offer();

    
			$response = array(
			    
				'status'=>'success',
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	
	}
	
	function issue_offer($id=null)
	{ 
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$this->intakesmodel->issue_offer();

    
			$response = array(
			    
				'status'=>'success',
			);

    		header('Content-type: application/json');    					
			echo json_encode($response);
		}
	
	}

	function accept_offer($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$this->intakesmodel->accept_offer();			
			redirect('intakes/manage/'.$id);
		}

		$this->data['page_head']= 'Add Interviews';
		$this->data['candidate_id']=$this->input->get('candidate_id');
		$this->data['app_id']=$this->input->get('app_id');
		$this->data['formdata']['intake_id']=$id;
			
		$this->load->view('include/header',$this->data);
		$this->load->view('intakes/offerletter',$this->data);	
		$this->load->view('include/footer',$this->data);		
	}

//GET ACCEPT OFFER LIST
	function get_offer_accepted()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		$this->load->model('companymodel');
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$offer_accepted = $this->intakesmodel->offer_accepted($id);

		$company_name=$this->companymodel->get_company_name($formdata['company_id']);
		$html1='';
		$html2='';
		
		if(!empty($offer_accepted)){
			
			$html1='<td colspan="2" align="center" valign="top"><br>
							
							Offer Accepted and Joined in '.$company_name.'
						</td>';
	
			$html2='<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
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
						  <td width="20%"><a href="#" target="_blank">'.$accepted['first_name'].' '.$accepted['last_name'].'</a></td>
						  <td width="13%">'.date("d-m-Y", strtotime($accepted['offer_accepted_date'])).'</td>
						  <td width="14%">'.$accepted['monthly_salary_offered'].'</td>
						  <td width="29%">'.$accepted['min_contract_months'].'</td>

						  <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_acceptcandidate/?intake_id='.$formdata['intake_id'].'&app_id='.$accepted['app_id'].'&candidate_id='.$accepted['candidate_id'].'&placement_id='.$accepted['placement_id'].'" id="delete_accept_candidate" >Remove </a>| <a href="'.base_url().'index.php/intakes/removeschedule/?intake_id=10&intid=12" target="_blank"> View Profile </a>| <a href="javascript:;" onclick="cert_attest('.$formdata['intake_id'].','.$accepted['app_id'].','.$accepted['candidate_id'].','. $accepted['placement_id'].');"> Certificate Attestation</a></td>';
						
				}
					
    		$html2 .=' </tbody> </table> ';
/* | <a href="javascript:;" onclick="create_visa('.$formdata['intake_id'].','.$accepted['app_id'].','.$accepted['candidate_id'].','. $accepted['placement_id'].');"> Visa Details</a>*/
		}

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
//get certy attestaion details

	function get_cert_attest()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$get_cert_attest = $this->intakesmodel->get_cert_attest($id);

		
		$html1='';
		$html2='';
		if(!empty($get_cert_attest)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						Certificate Attestation
					</td>';
					
		   
			$html2 =	'<td colspan="2" align="center" valign="top">
						<table border="1" cellpadding="3" cellspacing="3" width="95%" >
						<tbody >
						<tr>
						 <td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Title</td>
						<td bgcolor="#CCCCCC">Status</td>
						

						<td width="37%" bgcolor="#CCCCCC">Actions</td>
					</tr>';
  				
				foreach($get_cert_attest as $cert_attest){                                    
  				$status='';
				if($cert_attest['status']==1)
				{
					$status="Not Required";
				}
				else if($cert_attest['status']==2)
				{
					$status="Required";
				}
				else if($cert_attest['status']==3)
				{
					$status="Already Done";
				}
				else if($cert_attest['status']==4)
				{
					$status="On Process";
				}
				else if($cert_attest['status']==5)
				{
					$status="Completed";
				}
				$html2.='<tr>
						  <td width="20%"><a href="#" target="_blank">'.$cert_attest['first_name'].' '.$cert_attest['last_name'].'</a></td>
						 
						  <td width="30%">'.$cert_attest['title'].'</td>
						  <td width="26%">'.$status.'</td>

						  <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_attest/?intake_id='.$formdata['intake_id'].'&app_id='.$cert_attest['app_id'].'&candidate_id='.$cert_attest['candidate_id'].'&cert_id='.$cert_attest['cert_id'].'" id="delete_attest" >Remove </a>| <a href="'.base_url().'index.php/intakes/removeschedule/?intake_id=10&intid=12" target="_blank"> View Profile </a> | <a href="javascript:;" onclick="create_visa('.$formdata['intake_id'].','.$cert_attest['app_id'].','.$cert_attest['candidate_id'].');"> Visa Details</a>  </td>';
						
				}
					
    		$html2 .=' </tbody> </table> ';
/* | <a href="javascript:;" onclick="cert_attest('.$formdata['intake_id'].','.$cert_attest['app_id'].','.$cert_attest['candidate_id'].','. $cert_attest['placement_id'].');"> Certificate Attestation</a>*/
		}

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
	function accept_offer2()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if($this->input->post('app_id')!='' && $this->input->post('offer_accepted_date')!='' )
		{
			$this->intakesmodel->accept_offer();	
			
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
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' )
		{
			$this->intakesmodel->cert_attest();	
			
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
	
	function create_invoice($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->post('placement_id')!='' && $this->input->post('app_id')!='' && $this->input->post('candidate_id')!='')
		{
			$this->intakesmodel->create_invoice();			
			redirect('intakes/manage/'.$id);
		}
		$this->data['invoice_list']=$this->intakesmodel->invoice_generated($id);
		
		$this->data['page_head']= 'Add Interviews';
		$this->data['candidate_id']=$this->input->get('candidate_id');
		$this->data['app_id']=$this->input->get('app_id');
		$this->data['placement_id']=$this->input->get('placement_id');
		$this->data['formdata']['intake_id']=$id;
			
		$this->load->view('include/header',$this->data);
		$this->load->view('intakes/create_invoice',$this->data);	
		$this->load->view('include/footer',$this->data);	
	}

	function create_invoice2()
	{
		
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
				
		if($this->input->post('placement_id')!='' && $this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('invoice_date')!='')
		{
			$this->intakesmodel->create_invoice();
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$formdata =$query->row_array();
		
			$invoice_generated=$this->intakesmodel->invoice_generated($id);
			
			
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
				
					$invoice_status = "ferfer";                        
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
						
					$client_candidate = "sadsad";                        
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
                      <td width="13%"><a href="'.base_url().'index.php/candidates/summary/'.$invoice['candidate_id'].'/" target="_blank">'.$invoice['first_name'].' '.$invoice['last_name'].'</a></td>
                      <td width="13%">'.$invoice['invoice_date'].'</td>
                      <td width="14%">'.$invoice['invoice_start_date'].'</td>
                      <td width="12%">'.$invoice['invoice_due_date'].'</td>
                      <td width="11%">'.$invoice['invoice_amount'].'</td>
                      <td width="11%">'.$invoice_status.'</td>
					  <td width="11%">'.$client_candidate.'</td>
                       <td><a href="'.base_url().'index.php/intakes/create_invoice/'.$formdata['intake_id'].'/?placement_id='.$invoice['placement_id'].'&invoice_id='.$invoice['invoice_id'].'"> &nbsp;Edit&nbsp;</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_invoice/?intake_id='.$formdata['intake_id'].'&placement_id='.$invoice['placement_id'].'&invoice_id='.$invoice['invoice_id'].'"  id="delete_invoice_candidate" >Delete</a>|<a href="'.base_url().'index.php/candidates/summary/'.$invoice['candidate_id'].'/" target="_blank"> &nbsp;Profile&nbsp;</a></td></tr>';
						
				}
				
				$html .=' </tbody> </table> ';
					
    
			$response = array(
			    'data' => $html,
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

//get visa details

	function get_visa_details()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$visa_details=$this->intakesmodel->visa_details($id);

		
		$html1='';
		$html2='';
		if(!empty($visa_details)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						Visa Follow Up / Visa Receipt 
					</td>';
					
		   
			$html2='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Received Date</td>
						<td bgcolor="#CCCCCC">Visa Number</td>
						<td bgcolor="#CCCCCC">Date of Issue</td>
						<td bgcolor="#CCCCCC">Date of Expiry</td>
						<td bgcolor="#CCCCCC">Verified Passport</td>
						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($visa_details as $visa){
				$verified='';
				if($visa['passport_verified']==1)
				{
					$verified='Yes';
				}
				else if($visa['passport_verified']==2)
				{
					$verified='No';
				}
		   $html2.=' <tr>
                      <td width="13%"><a href="'.base_url().'index.php/candidates/summary/'.$visa['candidate_id'].'/" target="_blank">'.$visa['first_name'].' '.$visa['last_name'].'</a></td>
                      <td width="13%">'.$visa['date'].'</td>
                      <td width="14%">'.$visa['number'].'</td>
                      <td width="13%">'.$visa['date_issued'].'</td>
						<td width="13%">'.$visa['date_expiry'].'</td>
						<td width="10%">'.$verified.'</td>
                       <td><a href="javascript:;" onclick="create_medical('.$formdata['intake_id'].','.$visa['app_id'].','.$visa['candidate_id'].');">Create Medical</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_visa/?intake_id='.$formdata['intake_id'].'&app_id='.$visa['app_id'].'&visa_id='.$visa['visa_id'].'"  id="delete_visa_candidate" >Delete</a></td></tr>';
						
				}
				
				$html2 .=' </tbody> </table> ';
/* | <a href="javascript:;" onclick="cert_attest('.$formdata['intake_id'].','.$cert_attest['app_id'].','.$cert_attest['candidate_id'].','. $cert_attest['placement_id'].');"> Certificate Attestation</a>*/
		}


				
				
		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}

//CREATE PROGRAM
	function create_program()
	{
		
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
				
		if($this->input->post('intake_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('course_id')!='')
		{
			$this->intakesmodel->create_program();
			
					
    
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
	
//CREATE VISA
	function create_visa()
	{
		
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
				
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('date')!='')
		{
			$this->intakesmodel->create_visa();
			
					
    
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

//GET VISA PROCESS DOCUMENT


	function get_visa_document()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$visa_documents=$this->intakesmodel->visa_documents($id);

		
		$html1='';
		$html2='';
		if(!empty($visa_documents)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						Visa Process Document
					</td>';
					
		   
			$html2='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Mode of Send</td>
						<td bgcolor="#CCCCCC">Send By</td>
						<td bgcolor="#CCCCCC">Send Date</td>

						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($visa_documents as $visa){
				$mode='';
				$send_by='';
				if($visa['send_mode']==1)
				{
					$mode='Courier';
				}
				else if($visa['send_mode']==2)
				{
					$mode='Email';
				}
				
				if($visa['send_by']==1)
				{
					$send_by='Company';
				}
				else if($visa['send_by']==2)
				{
					$send_by='Candidate';
				}
		   $html2.=' <tr>
                      <td width="13%"><a href="'.base_url().'index.php/candidates/summary/'.$visa['candidate_id'].'/" target="_blank">'.$visa['first_name'].' '.$visa['last_name'].'</a></td>
                      <td width="13%">'.$mode.'</td>
                      <td width="14%">'.$send_by.'</td>
                      <td width="36%">'.date('d-m-Y',strtotime($visa['date_send'])).'</td>

                       <td><a href="javascript:;" onclick="create_ticket('.$formdata['intake_id'].','.$visa['app_id'].','.$visa['candidate_id'].');"> Ticket & Travel</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_visa_document/?intake_id='.$formdata['intake_id'].'&app_id='.$visa['app_id'].'&doc_id='.$visa['doc_id'].'"  id="delete_visa_document" >Delete</a></td></tr>';
						
				}
				
				$html2 .=' </tbody> </table> ';

		}


				
				
		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
//GET MEDICAL DETAILS
	function get_medical_details()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$medical_details=$this->intakesmodel->medical_details($id);

		
		$html1='';
		$html2='';
		if(!empty($medical_details)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						 Medical Details
					</td>';
					
		   

			
			
			$html2='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Title</td>
						<td bgcolor="#CCCCCC">Date</td>
						
						<td bgcolor="#CCCCCC">Description</td>

						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($medical_details as $medical){
				
					                        

           
		   $html2.=' <tr>
                      <td width="13%"><a href="'.base_url().'index.php/candidates/summary/'.$medical['candidate_id'].'/" target="_blank">'.$medical['first_name'].' '.$medical['last_name'].'</a></td>
					   <td width="14%">'.$medical['title'].'</td>
                      <td width="13%">'.date('d-m-Y',strtotime($medical['date'])).'</td>
                     
                      <td width="36%">'.$medical['description'].'</td>

                       <td><a href="javascript:;" onclick="create_document('.$formdata['intake_id'].','.$medical['app_id'].','.$medical['candidate_id'].');"> Visa Process Document</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_medical/?intake_id='.$formdata['intake_id'].'&app_id='.$medical['app_id'].'&medical_id='.$medical['medical_id'].'"  id="delete_medical_candidate" >Delete</a></td></tr>';
						
				}
				
				$html2 .=' </tbody> </table> ';

		}


				
				
		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}

//GET TICKET DETAILS
	function get_ticket_details()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$ticket_details=$this->intakesmodel->ticket_details($id);

		
		$html1='';
		$html2='';
		if(!empty($ticket_details)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						 Ticket & Travel Details
					</td>';
					
		   

			
			
			$html2='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						
						<td bgcolor="#CCCCCC">eTicket Number</td>
						<td bgcolor="#CCCCCC">Date of Travel</td>
						<td bgcolor="#CCCCCC">Boarding Sector</td>
						<td bgcolor="#CCCCCC">Flight Details</td>

						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($ticket_details as $ticket){
				
		  		 $html2.=' <tr>
                      <td width="13%"><a href="'.base_url().'index.php/candidates/summary/'.$ticket['candidate_id'].'/" target="_blank">'.$ticket['first_name'].' '.$ticket['last_name'].'</a></td>
					  
					  <td width="14%">'.$ticket['number'].'</td>
                      <td width="13%">'.date('d-m-Y',strtotime($ticket['date'])).'</td>
                      <td width="14%">'.$ticket['boarding_sector'].'</td>
                      <td width="22%">'.$ticket['description'].'</td>

                       <td><a href="javascript:;" onclick="create_followup('.$formdata['intake_id'].','.$ticket['app_id'].','.$ticket['candidate_id'].','.$ticket['placement_id'].');">Travel Followup</a> | <a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_ticket/?intake_id='.$formdata['intake_id'].'&app_id='.$ticket['app_id'].'&ticket_id='.$ticket['ticket_id'].'&placement_id='.$ticket['placement_id'].'"  id="delete_ticket_candidate" >Delete</a></td></tr>';
						
				}
				/*<a href="javascript:;" onclick="create_ticket('.$formdata['intake_id'].','.$ticket['app_id'].','.$ticket['candidate_id'].');">Ticket & Travel</a>|*/
				
				$html2 .=' </tbody> </table> ';

		}

				
		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
//GET TICKET FOLLOWUP
	function get_ticket_followup()
	{
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
		
		$this->db->where('intake_id', $id);
		$query=$this->db->get('pms_intakes');
		$formdata =$query->row_array();
		
		$ticket_details=$this->intakesmodel->ticket_followup($id);

		
		$html1='';
		$html2='';
		$travel_confirmation='';
		if(!empty($ticket_details)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						Travel Followup Details
					</td>';
			
			
			$html2='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						
						<td bgcolor="#CCCCCC">Travel Document</td>
						<td bgcolor="#CCCCCC">Send By</td>
						<td bgcolor="#CCCCCC">Send Mode</td>
						<td bgcolor="#CCCCCC">Travel Follow Up</td>
						<td bgcolor="#CCCCCC">Pickup Follow Up</td>
						<td bgcolor="#CCCCCC">Travel Confirmation</td>
						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($ticket_details as $ticket){
				$mode='';
				$send_by='';
				$travel_confirmation='';
				$download='';
				if($ticket['send_mode']==1)
				{
					$mode='Courier';
				}
				else if($ticket['send_mode']==2)
				{
					$mode='Email';
				}
				
				if($ticket['send_by']==1)
				{
					$send_by='Company';
				}
				else if($ticket['send_by']==2)
				{
					$send_by='Candidate';
				}
				if($ticket['travel_confirmation']==1)
				{
					$travel_confirmation='Complete';
				}
				else if($ticket['travel_confirmation']==2)
				{
					$travel_confirmation='Uncomplete';
				}
				if($ticket['travel_document']!='')
				{
					$download='<a href="'.base_url().'uploads/travel_document/'.$ticket['travel_document'].'" target="_blank" style="color:#0033FF">Download</a>';
				}

		  		 $html2.=' <tr>
                      <td width="13%"><a href="'.base_url().'index.php/candidates/summary/'.$ticket['candidate_id'].'/" target="_blank">'.$ticket['first_name'].' '.$ticket['last_name'].'</a></td>
					 
					  <td width="14%">'.$download.'</td>
                      <td width="13%">'.$send_by.'</td>
                      <td width="14%">'.$mode.'</td>
                      <td width="32%">'.$ticket['travel_followup'].'</td>
 					 <td width="32%">'.$ticket['pickup_followup'].'</td>
					 <td width="32%">'.$travel_confirmation.'</td>
                       <td><a href="javascript:;" onclick="create_invoice('.$formdata['intake_id'].','.$ticket['app_id'].','.$ticket['candidate_id'].','.$ticket['placement_id'].');">Create Invoice</a> | <a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_followup/?intake_id='.$formdata['intake_id'].'&app_id='.$ticket['app_id'].'&ticket_id='.$ticket['ticket_id'].'&placement_id='.$ticket['placement_id'].'"  id="delete_followup" >Delete</a></td></tr>';
						
				}
			
				$html2 .=' </tbody> </table> ';

		}

				
		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
//CREATE TRAVEL FOLLOWUP

	function create_followup()
	{
		$this->load->model('intakesmodel');
		$this->load->library('upload');
		$candidate_id = $this->input->post('candidate_id');	
		if($candidate_id!='')
		{ 
			if(isset($_FILES['travel_document']) && $_FILES['travel_document']['error']!=4){
				if (is_uploaded_file($_FILES['travel_document']['tmp_name'])) 
				{       				
					$config['upload_path'] = 'uploads/travel_document/';
					$config['allowed_types'] = 'doc|docx|pdf|txt';
					$config['max_size']	= '0';
					$config['file_name'] = md5(uniqid(mt_rand()));
					$this->upload->initialize($config);	
				
					if ($this->upload->do_upload('travel_document'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];		
						$dataArr=array(
		
							'travel_document'       => $this->upload_file_name,		
							'send_by'     			=> $this->input->post('send_by'),
							'send_mode'     		=> $this->input->post('send_mode'),
							'travel_followup'     	=> $this->input->post('travel_followup'),
							'pickup_followup'     	=> $this->input->post('pickup_followup'),
							'travel_confirmation'   => $this->input->post('travel_confirmation'),
							);
						$this->intakesmodel->create_followup($dataArr);
					}

				}
			}
			else
			{ 
				$dataArr=array(
		
							'travel_document'       => '',		
							'send_by'     			=> $this->input->post('send_by'),
							'send_mode'     		=> $this->input->post('send_mode'),
							'travel_followup'     	=> $this->input->post('travel_followup'),
							'pickup_followup'     	=> $this->input->post('pickup_followup'),
							'travel_confirmation'   => $this->input->post('travel_confirmation'),
							);
				$this->intakesmodel->create_followup($dataArr);
			}
			
			if( $this->input->post('send_email')=='yes')
			{ 
				$mode='';
				$send_by='';
				$travel_confirmation='';
				if($this->input->post('send_mode')==1)
				{
					$mode='Courier';
				}
				else if($this->input->post('send_mode')==2)
				{
					$mode='Email';
				}
				
				if($this->input->post('send_by')==1)
				{
					$send_by='Company';
				}
				else if($this->input->post('send_by')==2)
				{
					$send_by='Candidate';
				}
				
				if($this->input->post('travel_confirmation')==1)
				{
					$travel_confirmation='Complete';
				}
				else if($this->input->post('travel_confirmation')==2)
				{
					$travel_confirmation='Uncomplete';
				}
				
				$qry	=$this->db->query('select * from pms_candidate where candidate_id='.$candidate_id);
				$res	=	$qry->row_array();		

				$dataArr=array(
		
								
							'Send By'     			=> $send_by,
							'Send Mode'     		=> $mode,
							'Travel Followup'     	=> $this->input->post('travel_followup'),
							'Pickup Followup'     	=> $this->input->post('pickup_followup'),
							'Travel Confirmation'   => $travel_confirmation,
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
			'subject'                =>  'Travel Follow Up Details',
			'salutation'              =>  'Dear '.$res['first_name'].$res['last_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  '',
			'table_rows'             =>  $dataArr,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$status = $this->send_email($email_array);
			}
			$response_array['status'] = 'success';
			header('Content-type: application/json');
			echo json_encode($response_array);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
		
		
	}

//DELETE TICKET FOLLOWUP

	function delete_followup()
	{
		$id = $this->input->get('ticket_id');
		$intake_id = $this->input->get('intake_id');
		$c_id = $this->input->get('candidate_id');
		$app_id = $this->input->get('app_id');
		$p_id = $this->input->get('placement_id');
		
		$this->load->model('intakesmodel');		
		if($this->input->get('ticket_id')!='')
		{
			$result = $this->db->query('SELECT * FROM pms_job_apps_invoice WHERE placement_id ='.$p_id)->result();
			
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
					$query = $this->db->query("select travel_document from pms_job_apps_ticket where ticket_id=".$id);
					
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('uploads/travel_document/'.$row['travel_document']) && $row['travel_document']!='')
						{	
							unlink('uploads/travel_document/'.$row['travel_document']);
						}
						$this->db->query("update  pms_job_apps_ticket set travel_document='' where ticket_id=".$id);
						$this->intakesmodel->delete_followup($id);
					}
					else
					{
						$this->intakesmodel->delete_followup($id);
					}
					
					$response = array(
						'status' => 'success',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
			
			
		}	
	}
		
//CREATE DOCUMENT
	function create_doc()
	{
		
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
				
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('send_mode')!='')
		{
			$this->intakesmodel->create_doc();
			
    
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
	
//CREATE MEDICAL
	function create_medical()
	{
		
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
				
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('date')!='')
		{
			$this->intakesmodel->create_medical();
			
    
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
	

	
	function delete_application($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->intakesmodel->delete_application($this->input->get('candidate_id'),$id);
			redirect('intakes/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_from_shortlist($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->intakesmodel->delete_from_shortlist($this->input->get('candidate_id'),$id);
			redirect('intakes/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_interview_schedule($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->intakesmodel->delete_interview_schedule($this->input->get('candidate_id'),$id);
			redirect('intakes/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_selected_candidate($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->intakesmodel->delete_selected_candidate($this->input->get('candidate_id'),$id);
			redirect('intakes/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_offer_letter($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->intakesmodel->delete_offer_letter($this->input->get('candidate_id'),$id);
			redirect('intakes/manage/'.$id.'/?del=1');
		}
		exit();
	}
	
	function delete_placed_candidate($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->get('app_id')!='' && $this->input->get('candidate_id')!=''  & $id!='')
		{
			$this->intakesmodel->delete_placed_candidate($this->input->get('candidate_id'),$id);
			redirect('intakes/manage/'.$id.'/?del=1');
		}
		exit();
	}

	function delete_candidate_invoice($id=null)
	{
		$this->load->model('intakesmodel');
		if($this->input->get('placement_id')!='' && $this->input->get('invoice_id')!=''  & $id!='')
		{
			$this->intakesmodel->delete_candidate_invoice($this->input->get('placement_id'),$this->input->get('invoice_id'));
			redirect('intakes/manage/'.$id.'/?del=1');
		}
		exit();
	}
						

	function check_dups()
	{
		$this->db->where('job_title', $this->input->post('job_title'));
		if($this->input->post('intake_id') > 0)	$this->db->where('intake_id !=', $this->input->post('intake_id'));
		$query = $this->db->get('pms_intakes');
		
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
	



	function manage_interview($id=null)
	{
		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('intakesmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');

		
		if(!empty($id))
		{
			
			$data['page_head']= 'Manage Job';
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$data['formdata']=$query->row_array();
			
			$data['shortlisted']=$this->intakesmodel->get_shortlisted($id);
			//echo '<pre>';print_r($data['shortlisted']);exit;
			$data['interview_list']=$this->intakesmodel->get_interview_list($id);
			
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
			$this->load->view('intakes/manage_interview',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('intakes');
		}
	}
	
	function manage_offer($id=null)
	{
		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('intakesmodel');
		

		
		if(!empty($id))
		{
			
			$data['page_head']= 'Manage Job';
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$data['formdata']=$query->row_array();
			
			$data['candidates_selected']=$this->intakesmodel->candidates_selected($id);
			$data['offer_letters_issued']=$this->intakesmodel->offer_letters_issued($id);
			
			
			$this->load->view('include/header');
			$this->load->view('intakes/manage_offer',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('intakes');
		}
	}
	
	function manage_invoice($id=null)
	{
		$data['page_head']= 'View Details';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('intakesmodel');
		

		
		if(!empty($id))
		{
			
			$data['page_head']= 'Manage Job';
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$data['formdata']=$query->row_array();
			
			$data['offer_accepted']=$this->intakesmodel->offer_accepted($id);
			$data['invoice_generated']=$this->intakesmodel->invoice_generated($id);
			$data['invoice_list2']=$this->intakesmodel->invoice_generated($id);
						
			$this->load->view('include/header');
			$this->load->view('intakes/manage_invoice',$data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('intakes');
		}
	}
	
	function job_apps($id=null)
	{
		$data['page_head']= 'Job Applications';
		$data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('intakesmodel');
		

		
		if(!empty($id))
		{
			

			$data['page_head']= 'Job Application';
			
			$this->load->model('intakesmodel');
			$this->load->model('interviewtypemodel');
			$this->load->model('interviewstatusmodel');
			
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
			$data["jobcategory"] = $this->intakesmodel->fill_jobcategory();
			$data["functional"] = $this->intakesmodel->fill_functional();
			$data["education"] = $this->intakesmodel->fill_education();
			$data["salary"] = $this->intakesmodel->fill_salary();
			$data["worklevel"]= $this->intakesmodel->fill_worklevel();
			$data["nationality"] = $this->countrymodel->country_list();
			$data['cerifications']=$this->intakesmodel->get_cert();
//Education details
			$data["edu_level_list"] = $this->candidateallmodel->edu_level_list();
			$data["edu_course_list"] = $this->candidateallmodel->edu_course_list();
			$data["edu_spec_list"] = $this->candidateallmodel->edu_spec_list();
			
			$data["years_list"] = $this->candidateallmodel->years_list();
			$data["months_list"] = $this->candidateallmodel->months_list();
			
			$data["jobtype"] = $this->intakesmodel->jobtype_list();
			$data['applied_candidates']=$this->intakesmodel->get_candidate_list($id);
			$data['shortlisted'] =$this->intakesmodel->get_shortlisted($id);
			$this->db->where('intake_id', $id);
			$query=$this->db->get('pms_intakes');
			$data['formdata'] =$query->row_array();
			
			$sql='select DISTINCT a.* from  pms_candidate a inner join pms_candidate_job_profile b on a.candidate_id=b.candidate_id LEFT JOIN pms_candidate_to_skills c on a.candidate_id=c.candidate_id LEFT JOIN pms_candidate_education d on a.candidate_id=d.candidate_id LEFT JOIN pms_candidate_to_certification e on a.candidate_id=e.candidate_id';
			
			$where=' where a.candidate_id not in(select candidate_id from pms_job_apps where intake_id='.$id.')  ';
			
			if($this->input->post('job_cat_id')!='')$where=' and b.job_cat_id='.$this->input->post('job_cat_id');
		
			if($this->input->post('func_id')!='')
				if($where!='')
				{
					$where.=' and b.func_id='.$this->input->post('func_id');
				}else
				{
					$where.=' b.func_id='.$this->input->post('func_id');
				}
				
				if($this->input->post('exp_years')!='')
				if($where!='')
				{
					$where.=' and a.exp_years='.$this->input->post('exp_years');
				}else
				{
					$where.=' a.exp_years='.$this->input->post('exp_years');
				}
				
				if($this->input->post('exp_months')!='')
				if($where!='')
				{
					$where.=' and a.exp_months='.$this->input->post('exp_months');
				}else
				{
					$where.=' a.exp_months='.$this->input->post('exp_months');
				}
			//print_r($this->input->post('skills'));exit;
			if($this->input->post('skills')!='')
				if($where!='')
				{
					$where.=' and c.skill_id in ('.$this->input->post('skills').') ';
				}else
				{
					$where.=' c.skill_id in ('.$this->input->post('skills').') ';
				}
//certifications
				if($this->input->post('cert')!='')
				if($where!='')
				{
					$where.=' and e.cert_id in ('.$this->input->post('cert').') ';
				}else
				{
					$where.=' e.cert_id in ('.$this->input->post('cert').') ';
				}
//level				
				if($this->input->post('level_id')!='')
				if($where!='')
				{
					$where.='and d.level_id =' .$this->input->post('level_id').' ';
				}else
				{
					$where.=' d.level_id =' .$this->input->post('level_id').' ';
				}
//course				
				if($this->input->post('course_id')!='')
				if($where!='')
				{
					$where.='and d.course_id =' .$this->input->post('course_id').' ';
				}else
				{
					$where.=' d.course_id =' .$this->input->post('course_id').' ';
				}
				
//specilalistion				
				if($this->input->post('spcl_id')!='')
				if($where!='')
				{
					$where.='and d.spcl_id =' .$this->input->post('spcl_id').' ';
				}else
				{
					$where.=' d.spcl_id =' .$this->input->post('spcl_id').' ';
				}
			/*if($this->input->post('country_id')!='')
				if($where!='')
				{
					$where.=' and a.current_location='.$this->input->post('country_id');
				}else
				{
					$where.=' a.current_location='.$this->input->post('country_id');
				}*/
			
			if($where!='') $sql.=$where;			

			$data["postdata"]["intake_id"]=$id;
			$data["postdata"]["job_cat_id"]=$this->input->post('job_cat_id');
			$data["postdata"]["job_cat_id"]=$this->input->post('job_cat_id');
			$data["postdata"]["func_id"]=$this->input->post('func_id');
			$data["postdata"]["skills"]=$this->input->post('skills');
			$data["postdata"]["cert"]=$this->input->post('cert');
			$data["postdata"]["level_id"]=$this->input->post('level_id');
			$data["postdata"]["course_id"]=$this->input->post('course_id');
			$data["postdata"]["spcl_id"]=$this->input->post('spcl_id');
			$data["postdata"]["exp_years"]=$this->input->post('exp_years');
			$data["postdata"]["exp_months"]=$this->input->post('exp_months');
			//$data["postdata"]["country_id"]=$this->input->post('country_id');	
			
			$query=$this->db->query($sql);
			//echo $this->db->last_query();
			$data["candidates"]=$query->result_array();
			//echo $query->num_rows();exit;
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

//Certification and Technical Skilss

		
		/*$data['skill_list']=$this->candidateallmodel->get_parent_skills();
		//print_r($data['skill_list']);exit;
		$certs=array();
		
		if($data["postdata"]["cert"]!='')
		{
			$data["postdata"]["cert"]	=	explode(',',$data["postdata"]["cert"]);
		}
		else{
				$data["postdata"]["cert"]	= array();
			}
		
		foreach($data["postdata"]["cert"] as $cert)
		{
			$certs[]=$cert;
		}
		$data['candidate_certifications']	=	$certs;
		
		$skills=array();
		
		if($data["postdata"]["skills"]!='')
		{
			$data["postdata"]["skills"]	=	explode(',',$data["postdata"]["skills"]);
		}
		else{
				$data["postdata"]["skills"]	= array();
			}
		
		foreach($data["postdata"]["skills"] as $skill)
		{
			$skills[]=$skill;
		}
		$data['candidate_skills']	=	$skills;

		$data['res']	=	array();
		$data['res1']	=	array();
		
		if(!empty($skill))
		{
		$qry	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$skill);
		$data['res']	= $res	=	$qry->result_array();
		
		$qry1	=	$this->db->query('select * from pms_candidate_skills where skill_id='.$res[0]['parent_skill']);
		$data['res1']	= $res1 =	$qry1->result_array();
		
		$data['child_skills']	=	$this->candidateallmodel->get_child_skills($res1[0]['skill_id']);
		}*/
		
			$this->load->view('include/header');
			$this->load->view('intakes/jobs_applied',$data);	
			$this->load->view('include/footer');

		
		}else
		{
			redirect('intakes');
		}
	}
	
	
	function delete_applied_candidate()
	{
		
		
		$c_id   = $this->input->get('candidate_id');
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('intake_id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query(' SELECT * FROM pms_intake_programs WHERE (intake_id ="'.$intake_id.'" AND candidate_id ="'.$c_id.'")')->result();
			
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
					
					$result = $this->db->query('DELETE FROM pms_intake_candidate WHERE (intake_id ="'.$intake_id.'" AND candidate_id ="'.$c_id.'")');
					$applied =$this->intakesmodel->get_candidate_list($intake_id);
					$count =count($applied);
					
					$response = array(
						
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
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
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
					
					$result = $this->db->query(' DELETE FROM pms_job_apps_shortlisted WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
					$shortlisted =$this->intakesmodel->get_shortlisted($intake_id);
					$count = count($shortlisted);
					$this->db->where('intake_id', $intake_id);
					$query=$this->db->get('pms_intakes');
					$formdata =$query->row_array();
					
					$html='
						<td colspan="2" align="center" valign="top">
						
						
						<table border="1" cellpadding="3" cellspacing="3" width="95%">
						  <tbody >';
					
					
					
					foreach($shortlisted as $candidate){
						
						$html.='<tr>
								  <td width="44%"><a href="#" target="_blank">'.$candidate['first_name'].' '.$candidate['last_name'].'</a></td>
								  <td width="31%">'.$candidate['skills'].'</td>          
								 <td width="25%"> <a href="javascript:;"  onclick="interview('.$candidate['candidate_id'].','.$candidate['job_app_id'].','.$formdata['intake_id'].')" >Interview</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_shortlisted_candidate/?job_app_id='.$candidate['job_app_id'].'&candidate_id='.$candidate['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="delete_shortlisted_candidate" >Remove From List</a></td>
			
								  
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
	
	function delete_interview_candidate()
	{
		
		$id     = $this->input->get('job_app_id');
		$c_id   = $this->input->get('candidate_id');
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
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
					
					$result = $this->db->query('DELETE FROM pms_job_apps_interviews WHERE (job_app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
					//echo $this->db->last_query();
					$interview_list=$this->intakesmodel->get_interview_list($intake_id);
					$count = count($interview_list);
					$this->db->where('intake_id', $intake_id);
					$query=$this->db->get('pms_intakes');
					$formdata =$query->row_array();
					
					$html='<td colspan="2" align="center" valign="top">
    				
					<table border="1" cellpadding="3" cellspacing="3" width="95%">					
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
  				
				foreach($interview_list as $interview){
					  $datetime = explode(" ",$interview['interview_date']);
					  
			$html.=	'<tr>
						  <td width="13%"><a href="#" target="_blank">'.$interview['first_name'].' '.$interview['last_name'].'</a></td>
						  <td width="13%">'.date("d-m-Y", strtotime($datetime[0])).'</td>
						  <td width="10%">'.$interview['interview_time'].'</td>
						  <td width="14%">'.$interview['location'].'</td>
						  <td width="10%">'.$interview['interview_type'].'</td>
						  <td width="10%">'.$interview['description'].'</td>
						  <td><a href="javascript:;"  data-url="'.base_url().'index.php/intakes/edit_interview/?job_app_id='.$interview['job_app_id'].'&candidate_id='.$interview['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="edit_interview" >Change</a> |<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_interview_candidate/?job_app_id='.$interview['job_app_id'].'&candidate_id='.$interview['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="delete_interview_candidate" >Remove </a>| <a href="'.base_url().'index.php/intakes/removeschedule/?intake_id=10&intid=12" target="_blank"> View Profile </a> | <a href="javascript:;"  onclick="select_candidate('.$interview['candidate_id'].','.$interview['job_app_id'].','.$formdata['intake_id'].')" > Select </a></td>';
   
						
				}
				
				$html .=' </tbody> </table> ';
					
			
					$response = array(
						'data' => $html,
						'status'=>'success',
						'count' =>$count,
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
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
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
					$query = $this->db->query("update pms_job_apps_interviews set int_status='2' where job_app_id=".$id);
					//echo $this->db->last_query();
					$this->db->where('intake_id', $intake_id);
					$query=$this->db->get('pms_intakes');
					$formdata =$query->row_array();
					//$this->intakesmodel->common_delete2($this->input->get('app_id'),$this->input->get('candidate_id'),'pms_job_apps_interviews');
					$candidates_selected =$this->intakesmodel->candidates_selected($intake_id);
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
										  <td width="13%"><a href="#" target="_blank">'.$selected['first_name'].' '.$selected['last_name'].'</a></td>
										  <td width="13%">'.date("d-m-Y", strtotime($selected['select_date'])).'</td>
										  <td width="14%">&nbsp;</td>
										  <td width="12%">&nbsp;</td>
										  <td width="11%">&nbsp;</td>
										  <td width="11%">'.$selected['feedback'].'</td>
										  <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_selectedcandidate/?job_app_id='.$selected['app_id'].'&candidate_id='.$selected['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="delete_selected_candidate" >Remove </a>| <a href="'.base_url().'index.php/intakes/removeschedule/?intake_id=10&intid=12" target="_blank"> View Profile </a> | <a href="javascript:;" onclick="issue_offer('.$formdata['intake_id'].','.$selected['app_id'].','.$selected['candidate_id'].');" id="issue_offer"> Issue Offer </a></td>';
					
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
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
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
					$this->db->where('intake_id', $intake_id);
					$query=$this->db->get('pms_intakes');
					$formdata =$query->row_array();
					//$this->intakesmodel->common_delete2($this->input->get('app_id'),$this->input->get('candidate_id'),'pms_job_apps_interviews');
					$data['offer_letters_issued']=$this->intakesmodel->offer_letters_issued($intake_id);
					
					$offer_letters_issued =$this->intakesmodel->offer_letters_issued($intake_id);
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
		
		$id     = $this->input->get('placement_id');
		$intake_id     = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('placement_id')!='')
		{

			$result = $this->db->query('SELECT * FROM pms_job_apps_visa WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
				
			/*if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{*/
					
					$result = $this->db->query('DELETE FROM pms_job_apps_placement WHERE placement_id ="'.$id.'"');
					
					$response = array(
						
						'status'=>'success',
						
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			//}
		}
			
		
	}

//DELETE ATTEST
	function delete_attest()
	{
		
		$id     = $this->input->get('cert_id');
		$intake_id     = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('cert_id')!='')
		{

			/*$result = $this->db->query('SELECT * FROM pms_job_apps_cert WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
				
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{*/
					
					$result = $this->db->query('DELETE FROM pms_job_apps_cert WHERE cert_id ="'.$id.'"');
					
					$response = array(
						
						'status'=>'success',
						
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			//}
		}
			
		
	}
	
	function delete_invoice()
	{
		
		$id     = $this->input->get('placement_id');
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('placement_id')!='')
		{
							
				$result = $this->db->query('DELETE FROM pms_job_apps_invoice WHERE placement_id ="'.$id.'"');
				//echo $this->db->last_query();
				$this->db->where('intake_id', $intake_id);
				$query=$this->db->get('pms_intakes');
				//echo $this->db->last_query();exit;
				$formdata =$query->row_array();
				
										
				$invoice_generated=$this->intakesmodel->invoice_generated($intake_id);
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
				
					$invoice_status = "ferfer";                        
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
						
					$client_candidate = "sadsad";                        
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
                      <td width="13%"><a href="'.base_url().'index.php/candidates/summary/'.$invoice['candidate_id'].'/" target="_blank">'.$invoice['first_name'].' '.$invoice['last_name'].'</a></td>
                      <td width="13%">'.$invoice['invoice_date'].'</td>
                      <td width="14%">'.$invoice['invoice_start_date'].'</td>
                      <td width="12%">'.$invoice['invoice_due_date'].'</td>
                      <td width="11%">'.$invoice['invoice_amount'].'</td>
                      <td width="11%">'.$invoice_status.'</td>
					   <td width="11%">'.$client_candidate.'</td>
                       <td><a href="'.base_url().'index.php/intakes/create_invoice/'.$formdata['intake_id'].'/?placement_id='.$invoice['placement_id'].'&invoice_id='.$invoice['invoice_id'].'"> &nbsp;Edit&nbsp;</a>|<a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_invoice/?intake_id='.$formdata['intake_id'].'&placement_id='.$invoice['placement_id'].'&invoice_id='.$invoice['invoice_id'].'"  id="delete_invoice_candidate" >Delete</a>|<a href="'.base_url().'index.php/candidates/summary/'.$invoice['candidate_id'].'/" target="_blank"> &nbsp;Profile&nbsp;</a></td></tr>';
						
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
//DELETE VISA DOCUMENT
	function delete_visa_document()
	{
		
		$id     = $this->input->get('doc_id');
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('doc_id')!='')
		{ 
			/*$result = $this->db->query('SELECT * FROM pms_job_apps_document WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
				
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{	*/			
				$result = $this->db->query('DELETE FROM pms_job_apps_document WHERE doc_id ="'.$id.'"');

				
				$response = array(
					
					'status'=>'success',
					
				);

					header('Content-type: application/json');    					
					echo json_encode($response);
			//}
		}
		}
		
//DELETE VISA DETAILS
	function delete_visa()
	{
		
		$id     = $this->input->get('visa_id');
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('visa_id')!='')
		{ 
			$result = $this->db->query('SELECT * FROM pms_job_apps_medical WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
				
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
				$result = $this->db->query('DELETE FROM pms_job_apps_visa WHERE visa_id ="'.$id.'"');

				
				$response = array(
					
					'status'=>'success',
					
				);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
		}


		
//DELETE MEDICAL DETAILS
	function delete_medical()
	{
		
		$id     = $this->input->get('medical_id');
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('medical_id')!='')
		{
			/*$result = $this->db->query('SELECT * FROM pms_job_apps_ticket WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
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
			{	*/			
				$result = $this->db->query('DELETE FROM pms_job_apps_medical WHERE medical_id ="'.$id.'"');

				$response = array(
					
					'status'=>'success',
					
				);

					header('Content-type: application/json');    					
					echo json_encode($response);
			//}
		}
		}
	
	function add_to_job()
	{
		
		
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('intake_id')!='' && $this->input->get('candidate_id')!='')
		{
		
				$result = $this->intakesmodel->add_to_job();

					$applied =$this->intakesmodel->get_candidate_list($intake_id);
					$count =count($applied);
					$this->db->where('intake_id', $intake_id);
					$query=$this->db->get('pms_intakes');
					$formdata =$query->row_array();
					
					$html='
						<td colspan="2" align="center" valign="top">	
						
						<table border="1" cellpadding="3" cellspacing="3" width="95%">
						  <tbody >';
					
					foreach($applied as $candidate)
					{
						
						$html.='<tr>
								  <td width="44%"><a href="#" target="_blank">'.$candidate['first_name'].' '.$candidate['last_name'].'</a></td>
								  <td width="31%">'.$candidate['skills'].'</td>          
								  <td width="25%"><a href="javascript:;"  data-url="'.base_url().'index.php/intakes/shortlist2/?job_app_id='.$candidate['job_app_id'].'&candidate_id='.$candidate['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="shortlisted_candidate" > Short List </a> | <a href="javascript:;"  data-url="'.base_url().'index.php/intakes/delete_applied_candidate/?job_app_id='.$candidate['job_app_id'].'&candidate_id='. $candidate['candidate_id'].'&intake_id='.$formdata['intake_id'].'"  id="delete_applied_candidate" > Delete Application</a></td>
          
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
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('candidate_id')!='')
		{
							
				//$query = $this->db->query('SELECT * FROM pms_job_apps_interviews WHERE (job_app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
				$this->db->where('job_app_id', $id);
				$this->db->where('candidate_id', $c_id);
				$query=$this->db->get('pms_job_apps_interviews');
				//echo $this->db->last_query();
				$formdata =$query->row_array();
				//print_r($formdata);
				
				header('Content-type: application/json');    					
				echo json_encode($formdata);
		}
	}
			
	function delete_shortlisted()
	{
		
		$id     = $this->input->get('job_app_id');
		$c_id   = $this->input->get('candidate_id');
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
		if($this->input->get('job_app_id')!='' && $this->input->get('candidate_id')!='')
		{
			$result = $this->db->query('SELECT * FROM pms_job_apps_interviews WHERE (job_app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")')->result();
			
			if(!empty($result))
			{
					redirect('intakes/shortlist/'.$this->input->get('intake_id').'/?del=1');
			}			
			
			else
			{
					
					$result = $this->db->query(' DELETE FROM pms_job_apps_shortlisted WHERE (app_id ="'.$id.'" AND candidate_id ="'.$c_id.'")');
					redirect('intakes/shortlist/'.$this->input->get('intake_id').'/?del=2');
			}
		}
			
		
	}
	

	
//CREATE TICKET
	function create_ticket()
	{
		
		$id =$this->input->post('intake_id');
		$this->load->model('intakesmodel');
				
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('date')!='')
		{
			$this->intakesmodel->create_ticket();
			
    
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

//DELETE TICKET DETAILS
	function delete_ticket()
	{
		
		$id     = $this->input->get('ticket_id');
		$intake_id = $this->input->get('intake_id');
		
		$this->load->model('intakesmodel');		
		
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
		$this->load->model('intakesmodel');
		if(isset($_POST['category_id']) && $_POST['category_id']!='')
		{
			$data=array();
			$data["function_list"] = $this->intakesmodel->function_list_by_category($_POST['category_id']);
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
