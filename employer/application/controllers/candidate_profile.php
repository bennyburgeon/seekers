<?php 
class Candidate_profile extends CI_Controller {


	function client_cv($id='')
	{
		$this->load->model('clientcvmodel');
		if($id!='')
		{
            $details_row    = $this->clientcvmodel->get_profile_rms($id);
			if($details_row['candidate_id']!='')
            {
			$candidate_id    =   $details_row['candidate_id'];
			
			if($candidate_id < 1)exit();
			
			$this->data['candidate_id']   =$candidate_id;
			//$this->data['job_id']         =$job_id;
			

			$this->data['page_head']       = 'Candidate Profile';			
			$this->data["personal"]        = $this->clientcvmodel->get_single_record($candidate_id);			
			$this->data["job_search"]        = $this->clientcvmodel->job_search($candidate_id);
			$this->data['education']       = $this->clientcvmodel->education_list($candidate_id);
			$this->data['profession']      = $this->clientcvmodel->get_profession($candidate_id);
			$this->data['language_skills'] = $this->clientcvmodel->candidate_languages($candidate_id);
			$this->data['skills_primary']     = $this->clientcvmodel->candidate_skills($candidate_id);
			$this->data['skills_secondary']     = $this->clientcvmodel->candidate_skills($candidate_id);
			
			$this->data['certifications']   = $this->clientcvmodel->candidate_certifications($candidate_id);
			$this->data['domain']          = $this->clientcvmodel->candidate_domains($candidate_id);
			$this->data['feedback']     = $this->clientcvmodel->get_consultant_feedback($candidate_id);

//primary_skills
			$candidate_skills_primary = $this->clientcvmodel->candidate_skills_primary($this->data['candidate_id']);
			
			$skills_primary=array();
			foreach($candidate_skills_primary as $skill)
			{
				$skills_primary[]=$skill['skill_name'];
			}
			
			$this->data['skills_primary']	        =	implode(', ',$skills_primary);
				
			//secondary skills
			$candidate_skills_secondary = $this->clientcvmodel->candidate_skills_secondary($this->data['candidate_id']);
			
			$skills_secondary=array();
			foreach($candidate_skills_secondary as $skill)
			{
				$skills_secondary[]=$skill['skill_name'];
			}
			$this->data['skills_secondary']	        =	implode(', ',$skills_secondary);

			//certificates
			$candidate_certifications = $this->clientcvmodel->candidate_certifications($this->data['candidate_id']);
			
			$certifications=array();
			foreach($candidate_certifications as $cert)
			{
				$certifications[]=$cert['cert_name'];
			}
			$this->data['certifications']	        =	implode(', ',$certifications);
								
			$this->data["profile_list"] = $this->clientcvmodel->profile_list($candidate_id);
			
			$html_profile=$this->load->view('clientcv/print_cv',$this->data,true);	
			echo $html_profile;
			exit();
		}
        }
        else
		{
			exit();
		}		
	}

}
?>
