<?php
class Select_applicant extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('clientcvmodel'); 
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('pdf');
	}
	
	
	function index($offset = 0)
	{		
		$this->data['company_name']='';
		$this->load->view('candidates_all/thank_you',$this->data);		
	}
	
	function profile()
	{
		if($this->input->get('view')!='')
		{
			
			$details_row    = $this->clientcvmodel->get_candidate_id($this->input->get('view'));
			
			//print_r($details_row);
			//exit();
			
			if($details_row['candidate_id']<1)exit();

			$this->data['candidate_id']   =$details_row['candidate_id'];
			$this->data['short_id']       =$details_row['short_id'];
			$this->data['job_app_id']     =$details_row['job_app_id'];
			
			$this->data['job_details']     = $this->clientcvmodel->get_job_details($this->data['candidate_id'],$this->data['job_app_id']);
			$this->data['page_head']       = 'Candidate Profile';
			$this->data["personal"]        = $this->clientcvmodel->get_single_record($this->data['candidate_id']);
			$this->data["job_search"]      = $this->clientcvmodel->job_search($this->data['candidate_id']);
			$this->data['education']                = $this->clientcvmodel->education_list($this->data['candidate_id']);
			$this->data['profession']               = $this->clientcvmodel->get_profession($this->data['candidate_id']);
			$this->data['language_skills']          = $this->clientcvmodel->candidate_languages($this->data['candidate_id']);
			$this->data['tech_skills']              = $this->clientcvmodel->candidate_skills($this->data['candidate_id']);
			$this->data['certification']            = $this->clientcvmodel->candidate_certifications($this->data['candidate_id']);
			$this->data['domain']                   = $this->clientcvmodel->candidate_domains($this->data['candidate_id']);
			$this->data['consultant_feedback']      = $this->clientcvmodel->get_consultant_feedback($this->data['candidate_id']);			
			$this->data["profile_list"]             = $this->clientcvmodel->profile_list($this->data['candidate_id']);
			
			//print_r($this->data["personal"]);
			//exit();
			
			//print_r($this->data["personal"]);
			//$this->load->view('include/header',$this->data);
			$this->load->view('candidates_all/print_cv',$this->data);	
			//$this->load->view('include/footer',$this->data);
		}else
		{
			exit();
		}		
	}

	function profile_rms()
	{
		
		if($this->input->get('candidate_id')!='' && $this->input->get('job_app_id')!='')
		{		
			$candidate_id           =  $this->input->get('candidate_id');
			$job_app_id             =  $this->input->get('job_app_id');
			
			$details_row    = $this->clientcvmodel->get_profile_rms($candidate_id);
		
				//print_r($details_row);
			//exit();
			if($details_row['candidate_id']<1)exit();
		
			$this->data['candidate_id']   =$details_row['candidate_id'];
			$this->data['short_id']       ='0';
			$this->data['job_app_id']               = $job_app_id;
			
			$this->data['job_details']              = $this->clientcvmodel->get_job_details_rms($this->data['candidate_id'],$job_app_id);
			

			$this->data['page_head']                = 'Candidate Profile';
			$this->data["personal"]                 = $this->clientcvmodel->get_single_record($this->data['candidate_id']);
			$this->data["job_search"]               = $this->clientcvmodel->job_search($this->data['candidate_id']);
			$this->data['education']                = $this->clientcvmodel->education_list($this->data['candidate_id']);
			$this->data['profession']               = $this->clientcvmodel->get_profession($this->data['candidate_id']);
			$this->data['language_skills']          = $this->clientcvmodel->candidate_languages($this->data['candidate_id']);
			$this->data['tech_skills']              = $this->clientcvmodel->candidate_skills($this->data['candidate_id']);
			$this->data['certification']            = $this->clientcvmodel->candidate_certifications($this->data['candidate_id']);
			$this->data['domain']                   = $this->clientcvmodel->candidate_domains($this->data['candidate_id']);
			$this->data['consultant_feedback']      = $this->clientcvmodel->get_consultant_feedback($this->data['candidate_id']);			
			$this->data["profile_list"]             = $this->clientcvmodel->profile_list($this->data['candidate_id']);
			
			$this->load->view('candidates_all/print_cv_rms',$this->data);	
		}else
		{
			exit();
		}		
	}

	function download_profile($paper = 'a4', $orientation = 'portrait') {
		
		if($this->input->get('candidate_id')!='' && $this->input->get('job_app_id')!=''){	
			$candidate_id           =  $this->input->get('candidate_id');
			$job_app_id             =  $this->input->get('job_app_id');
			$details_row    = $this->clientcvmodel->get_profile_rms($candidate_id);
			if($details_row['candidate_id']<1)exit();
			$this->data['candidate_id']   =$details_row['candidate_id'];
			$this->data['short_id']       ='0';
			$this->data['job_app_id']               = $job_app_id;
			$this->data['job_details']              = $this->clientcvmodel->get_job_details_rms($this->data['candidate_id'],$job_app_id);
			$this->data['page_head']                = 'Candidate Profile';
			$this->data["personal"]                 = $this->clientcvmodel->get_single_record($this->data['candidate_id']);
			$this->data["job_search"]               = $this->clientcvmodel->job_search($this->data['candidate_id']);
			$this->data['education']                = $this->clientcvmodel->education_list($this->data['candidate_id']);
			$this->data['profession']               = $this->clientcvmodel->get_profession($this->data['candidate_id']);
			$this->data['language_skills']          = $this->clientcvmodel->candidate_languages($this->data['candidate_id']);
			$this->data['tech_skills']              = $this->clientcvmodel->candidate_skills($this->data['candidate_id']);
			$this->data['certification']            = $this->clientcvmodel->candidate_certifications($this->data['candidate_id']);
			$this->data['domain']                   = $this->clientcvmodel->candidate_domains($this->data['candidate_id']);
			$this->data['consultant_feedback']      = $this->clientcvmodel->get_consultant_feedback($this->data['candidate_id']);			
			$this->data["profile_list"]             = $this->clientcvmodel->profile_list($this->data['candidate_id']);
			
			
			$this->pdf->folder('assets/pdf/');
			$filename = $paper.'-'.$orientation.'.pdf';
			$this->pdf->filename($filename);
			$this->pdf->paper($paper, $orientation);
			$this->pdf->html($this->load->view('candidates_all/download_cv_rms',$this->data, true));
			if($this->pdf->create('download')) {
				redirect();
			}	

		}else{
			exit();
		}
	}

	
	
			
	function client_feedback()
	{
		if($this->input->get('jobapp')!='' && $this->input->get('candid')!='' && $this->input->get('cf')!='' && $this->input->get('short')!='')
		{

			$data=array(		
			'client_feedback' => $this->input->get('cf'),
			'feedback_date'=> date('Y-m-d'),
			'client_notes' => 'Feedback from client.',
			);
			$this->clientcvmodel->add_feedback_url($this->input->get('jobapp'), $this->input->get('candid'), $this->input->get('short'),$data);
			redirect('select_applicant');
			exit();
		}
		exit();
	}
	
	function add_feedback()
	{
		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('short_id')!='')
		{
			$client_feedback=$this->input->post('client_feedback');
			$data=array(		
			'client_feedback'              => $client_feedback,
			'client_feedback_status'       => 2,
			'feedback_date'                => date('Y-m-d'),
			'client_notes'                 => $this->input->post('client_notes'),
			);
			$this->clientcvmodel->add_feedback_form($this->input->post('job_app_id'),$this->input->post('candidate_id'),$this->input->post('short_id'),$data);
			if($client_feedback==1 && $this->input->post('interview_date')!='')$this->addinterview();
			redirect('select_applicant');
		}
		
	}
	
	function addinterview()
	{
		$this->load->model('clientcvmodel');
		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('title')!='' )
		{
			$data=array(
			'job_app_id'         => $this->input->post('job_app_id'),
			'candidate_id'       => $this->input->post('candidate_id') ,
			'interview_date'     => date("Y-m-d H:i:s",strtotime($this->input->post('interview_date'))),
			'title'              => $this->input->post('title') ,
			'description'        => 'Interview scheduled by client',
			'duration'           => 'NA' ,
			'interview_time'     => 'NA' ,
			'interview_type_id'  => $this->input->post('interview_type_id') ,
			'int_status_id'      => '' ,
			'location'           => 'Confirm with Client',
			);
			$job_id=$this->clientcvmodel->add_interview($data,$this->input->post('candidate_id'),$this->input->post('job_app_id'));	

			$data=array(
			'job_app_id'         => $this->input->post('job_app_id'),
			'candidate_id'       => $this->input->post('candidate_id') ,
			'interview_date'     => date("Y-m-d H:i:s",strtotime($this->input->post('interview_date'))),
			'title'              => $this->input->post('title') ,
			'description'        => 'Interview scheduled by client',
			'duration'           => 'NA' ,
			'interview_time'     => 'NA' ,
			'interview_type_id'  => $this->input->post('interview_type_id') ,
			'int_status_id'      => '' ,
			'location'           => 'Confirm with Client',
			);
			
			$this->clientcvmodel->add_interview_history($data,$this->input->post('candidate_id'),$this->input->post('job_app_id'));
		}
		
	}



}