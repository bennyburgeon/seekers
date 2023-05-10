<?php
class Clientcv extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('clientcvmodel'); 
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

			$details_row    = $this->clientcvmodel->get_candidate_id(md5($this->input->get('view')));
			
			if($details_row['candidate_id']<1)exit();
			
			$this->data['candidate_id']   =$details_row['candidate_id'];

			$this->data['job_details']     = $this->clientcvmodel->get_job_details($details_row['candidate_id'],1);
			
			$this->data['page_head']       = 'Candidate Profile';
			
			$this->data["personal"]        = $this->clientcvmodel->get_single_record($details_row['candidate_id']);

			
			$this->data["job_search"]        = $this->clientcvmodel->job_search($details_row['candidate_id']);

			$this->data['education']       = $this->clientcvmodel->education_list($details_row['candidate_id']);
			$this->data['profession']      = $this->clientcvmodel->get_profession($details_row['candidate_id']);
			$this->data['language_skills'] = $this->clientcvmodel->candidate_languages($details_row['candidate_id']);
			$this->data['tech_skills']     = $this->clientcvmodel->candidate_skills($details_row['candidate_id']);
			$this->data['certification']   = $this->clientcvmodel->candidate_certifications($details_row['candidate_id']);
			$this->data['domain']          = $this->clientcvmodel->candidate_domains($details_row['candidate_id']);
			$this->data['feedback']     = $this->clientcvmodel->get_consultant_feedback($details_row['candidate_id']);
					
			$this->data["profile_list"] = $this->clientcvmodel->profile_list($details_row['candidate_id']);
			
			$html_profile=$this->load->view('clientcv/print_cv',$this->data,true);	
			echo $html_profile;
			exit();
		}else
		{
			exit();
		}		
	}
}