<?php
class Select_applicant extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('candidateallmodel'); 
	}
	
	function index($offset = 0)
	{		
		echo 'Thank you so much for your feedback. We contact you soon.';
		exit();
	}
	
	function profile()
	{
		if($this->input->get('view')!='')
		{
			$details_row    = $this->candidateallmodel->get_candidate_id($this->input->get('view'));
			
			if($details_row['candidate_id']<1)exit();
			
			$this->data['candidate_id']   =$details_row['candidate_id'];
			$this->data['short_id']       =$details_row['short_id'];
			$this->data['job_app_id']     =$details_row['job_app_id'];
			
			$this->data['page_head']       = 'Candidate Profile';
			
			$this->data["personal"]        = $this->candidateallmodel->get_single_record($details_row['candidate_id']);
			$this->data["job_search"]        = $this->candidateallmodel->job_search($details_row['candidate_id']);

			$this->data['education']       = $this->candidateallmodel->education_list($details_row['candidate_id']);
			$this->data['job_details']     = $this->candidateallmodel->get_job_details($details_row['candidate_id']);
			$this->data['language_skills'] = $this->candidateallmodel->candidate_languages($details_row['candidate_id']);
			$this->data['tech_skills']     = $this->candidateallmodel->candidate_skills($details_row['candidate_id']);
			$this->data['certification']   = $this->candidateallmodel->candidate_certifications($details_row['candidate_id']);
			$this->data['domain']          = $this->candidateallmodel->candidate_domains($details_row['candidate_id']);
			$this->data['short_lists']        = $this->candidateallmodel->get_shortlisted_details($details_row['short_id']);
					
			//print_r($this->data["language_skills"]);
			//exit();
			
			$this->data["profile_list"] = $this->candidateallmodel->profile_list($details_row['candidate_id']);
			
			//print_r($this->data["personal"]);
			//$this->load->view('include/header',$this->data);
			$this->load->view('candidates_all/print_cv',$this->data);	
			//$this->load->view('include/footer',$this->data);
		}else
		{
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
			$this->candidateallmodel->add_feedback_url($this->input->get('jobapp'), $this->input->get('candid'), $this->input->get('short'),$data);
			redirect('select_applicant');
			exit();
		}
		exit();
	}
	
	function add_feedback()
	{
		if($this->input->post('job_app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('short_id')!='')
		{
			$data=array(		
			'client_feedback' => $this->input->post('client_feedback'),
			'feedback_date'=> date('Y-m-d'),
			'client_notes' => $this->input->post('client_notes'),
			);
	
			$this->candidateallmodel->add_feedback_form($this->input->post('job_app_id'),$this->input->post('candidate_id'),$this->input->post('short_id'),$data);
		}
		redirect('select_applicant');
	}
}