<?php 
class Webservicemodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
    
	function __construct()
    {
		$this->table_name='pms_candidate';
    }
	

   function file_list($candidate_id)
   {
   		$query = $this->db->query('select * from pms_candidate_files where candidate_id='.$candidate_id);
		return $query->result_array();
   }

	function select_aplication_coe($candidate_id)
	{
		$query = $this->db->query("select distinct app_id,app_details from pms_candidate_applications where app_id not in (select app_id from pms_candidate_visa_approval) and app_status=1 and candidate_id=".$candidate_id);
		$dropdowns = $query->result();
		$dropDownList[0]='Select Aplication';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->app_id] = $dropdown->app_details;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	
	}
		
	function interview_type_list()
	{
		$query = $this->db->query('select distinct interview_type_id,interview_type from pms_candidate_interview_types order by interview_type desc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Interview Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->interview_type_id] = $dropdown->interview_type;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

		
	function university_list()
	{
		$query = $this->db->query('select distinct a.univ_id,a.univ_name from pms_university a inner join pms_campus b on a.univ_id=b.univ_id order by a.univ_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select University';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->univ_id] = $dropdown->univ_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function intake_list()
	{
		$query = $this->db->query('select intake_id,intake_month from pms_university_intake order by intake_id asc');
		$dropdowns = $query->result();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->intake_id] = $dropdown->intake_month;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
      
   	function course_list()
	{
		$query = $this->db->query('select distinct course_id,course_name from pms_courses order by course_name desc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

 	function status_list()
	{
		$query = $this->db->query('select distinct status_id,status_name from pms_process_status order by status_order asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Process Status';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->status_id] = $dropdown->status_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	
   function interview_status_list()
	{
		$query = $this->db->query('select * from  pms_candidate_interview_status');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Interview Status';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->int_status_id] = $dropdown->int_status_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
   

   function get_skill_set($candidate_id)
   {
		$query = $this->db->query('SELECT skill_id, skill_name FROM pms_candidate_skills ORDER BY skill_name');
		$all_skills= $query->result_array();

		$query = $this->db->query('SELECT a.skill_id FROM pms_candidate_skills a INNER JOIN pms_candidate_to_skills b ON a.skill_id = b.skill_id where b.candidate_id='.$candidate_id);
		$current_skills= $query->result_array();
		$skill_list=array();
		
		foreach($all_skills as $skill)
		{
			if(is_array($current_skills) && isset($current_skills[$skill['skill_id']]))
				 $skill_list[$skill['skill_id']] = array('skill_id' => $skill['skill_id'], 'skill_name' => $skill['skill_name'], 'checked' => 1);
			 else
			 	$skill_list[$skill['skill_id']] = array('skill_id' => $skill['skill_id'], 'skill_name' => $skill['skill_name'], 'checked' => 0);
		}

		return $skill_list;
   }


   function get_certification_list($candidate_id)
   {

		$query = $this->db->query('SELECT cert_id, cert_name FROM pms_candidate_certification ORDER BY cert_name');
		$all_cert= $query->result_array();

		$query = $this->db->query('SELECT a.cert_id FROM pms_candidate_certification a INNER JOIN pms_candidate_to_certification b ON a.cert_id = b.cert_id where b.candidate_id='.$candidate_id);
		$current_cert= $query->result_array();
		$cert_list=array();
		
		foreach($all_cert as $cert)
		{
			if(is_array($current_cert) && isset($current_cert[$cert['cert_id']]))
				 $cert_list[$cert['cert_id']] = array('cert_id' => $cert['cert_id'], 'cert_name' => $cert['cert_name'], 'checked' => 1);
			 else
			 	$cert_list[$cert['cert_id']] = array('cert_id' => $cert['cert_id'], 'cert_name' => $cert['cert_name'], 'checked' => 0);
		}

		return $cert_list;
   }
      
   function get_one_record($id){
	   $query = $this->db->query('select * from pms_candidate_files where file_id='.$id);
		return $query->row_array();
   }


	function country_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Country';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function religion_list()
	{
		$query = $this->db->query('select distinct rel_id, rel_name from pms_religion  order by rel_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Religion';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->rel_id] = $dropdown->rel_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	
	function currency_list()
	{
		$query = $this->db->query('select distinct cur_id, cur_short_name from pms_currency_master  order by cur_short_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Currency';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->cur_id] = $dropdown->cur_short_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	function ref_list()
	{
		$query = $this->db->query('select distinct ref_id, ref_name from pms_reference order by ref_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Reference';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->ref_id] = $dropdown->ref_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function edu_level_list()
	{
		$query = $this->db->query('select distinct level_id, level_name from pms_education_level order by level_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Education Level';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->level_id] = $dropdown->level_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function edu_course_list()
	{
		$query = $this->db->query('select distinct course_id, course_name from pms_courses order by course_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function branch_list()
	{
		$query = $this->db->query('select distinct branch_id, branch_name from pms_branch order by branch_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Branch';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->branch_id] = $dropdown->branch_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function edu_spec_list()
	{
		$query = $this->db->query('select distinct spcl_id, spcl_name from pms_specialisation order by spcl_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Specilization';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->spcl_id] = $dropdown->spcl_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function edu_univ_list()
	{
		$query = $this->db->query('select distinct univ_id, univ_name from pms_university where univ_type=1 order by univ_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select University';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->univ_id] = $dropdown->univ_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	

	function edu_course_type_list()
	{
		$query = $this->db->query('select distinct course_type_id, course_type from pms_course_type order by course_type asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Course Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_type_id] = $dropdown->course_type;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

   function get_survey_result($id)
   {
   		$survey_result=array();
		
   		 $query = $this->db->query('SELECT a.question_id,a.question_title FROM `pms_candidate_survey_questions` a order by a.question_id');
		 $result=$query->result_array();
		 foreach($result as $row)
		 {
		 	 $survey_result[$row['question_id']]=$row;
			 $query_question = $this->db->query('SELECT answer_title FROM `pms_candidate_survey_answers` where question_id='.$row['question_id']);
			 $answer=$query_question->result_array();
			 
			 $survey_result[$row['question_id']]['answer'][0]=$answer[0]['answer_title'];
			 $survey_result[$row['question_id']]['answer'][1]=$answer[1]['answer_title'];

			 $query_result = $this->db->query('SELECT a.answer_value FROM `pms_candidate_survey_result` a  where a.candidate_id='.$id.' and a.answer_id='.$row['question_id']);
			if ($query_result->num_rows() > 0)
			{
				$answer=$query_result->row_array();
				$survey_result[$row['question_id']]['answer_value']=$answer['answer_value'];
			}else
			{
				$survey_result[$row['question_id']]['answer_value']='';
			}
		 }
		 return $survey_result;
   }

   function get_certifications_set()
   {
		$query = $this->db->query('SELECT a.cert_id, a.cert_name, b.candidate_id FROM pms_candidate_certification a LEFT JOIN pms_candidate_to_certification b ON a.cert_id = b.cert_id ORDER BY a.cert_name');
		
		$dropdowns = $query->result();
		$survey_result=array();
		foreach($dropdowns as $dropdown)
		{
			 $survey_result[$dropdown->cert_id] = array('cert_name' => $dropdown->cert_name, 'candidate_id' => $dropdown->candidate_id);
		}
	
		return $survey_result;
   }	
	function industry_list()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Industry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function functional_list()
	{
		$query = $this->db->query('select distinct func_id, func_area from pms_job_functional_area order by func_area asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Function';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->func_id] = $dropdown->func_area;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
				
	function edu_years_list()
	{
		$dropDownList[0]='Select Year';
		for($i=1970;$i<=2014;$i++)
		{
			 $dropDownList[$i] = $i;
		}
		return $dropDownList;
	}


	function years_list()
	{
		$dropDownList[0]='0 Year';
		for($i=1;$i<=20;$i++)
		{
			 $dropDownList[$i] = $i.' Years';
		}
		return $dropDownList;
	}

	function months_list()
	{
		$dropDownList[0]='0 Month';
		for($i=1;$i<=12;$i++)
		{
			 $dropDownList[$i] = $i.' Months';
		}
		return $dropDownList;
	}
	
	function state_list_by_country($country_id='')    
	{
		if($country_id !='')
	
			$query=$this->db->query("select * from pms_state where country_id=".$country_id);
		else
			$query=$this->db->query("select * from pms_state where country_id=".$country_id);
					
		$state_list = $query->result();
		
		
		$dropDownList['']='Select State';
		
		foreach($state_list as $dropdown)
		{
			$dropDownList[$dropdown->state_id] = $dropdown->state_name;
		}
		
		return $dropDownList;
    }	
	
	function location_list_by_state($state_id='')
    {
		if($state_id !='')
			$query=$this->db->query("select * from pms_locations where state_id=".$state_id);
		else
			$query=$this->db->query("select * from pms_locations where state_id=".$state_id);
					
		$location_list = $query->result();
		$dropDownList['']='Select Location';
		
		foreach($location_list as $dropdown)
		{
			$dropDownList[$dropdown->location_id] = $dropdown->location;
		}
		return $dropDownList;
    }	

	function get_passport_single_record($candidateId)
	{
		$query=$this->db->query("select * from ".$this->table_name." where candidate_id=".$candidateId);
		return $query->row_array();
	}
	
	function get_admin_users_lists(){
	  $query = $this->db->query('select distinct admin_id, firstname, lastname from pms_admin_users order by admin_id asc');
	  $dropdowns = $query->result();
	  $dropDownList[0]='Select Admin Users';
	  foreach($dropdowns as $dropdown)
	  {
		$dropDownList[$dropdown->admin_id] = $dropdown->firstname.' '.$dropdown->lastname;
	  }
	  $finalDropDown = $dropDownList;
	  return $finalDropDown;
 	}	

	function get_education_list($candidate_id)
	{
	  $query = $this->db->query('SELECT a.eucation_id,b.course_name,a.mark_percentage from  `pms_candidate_education` a inner join pms_courses b on a.course_id=b.course_id where a.candidate_id='.$candidate_id);
	  $list = $query->result_array();	  
	  return $list;
 	}

	function get_job_list($candidate_id)
	{
	  $query = $this->db->query('SELECT a.job_profile_id,a.organization,a.designation,a.from_date,a.to_date from  `pms_candidate_job_profile` a where a.candidate_id='.$candidate_id);
	  $list = $query->result_array();
	  return $list;
 	}
			
	 function insert_candidate($data){
	
		$this->db->insert('pms_candidate', $data);
        $id = $this->db->insert_id();
		return $id;
	}

	 function update_candidate_profile($data,$candidate_id)
	 {
		$this->db->where('candidate_id', $candidate_id);
		$this->db->update($this->table_name,$data);
		return $candidate_id;
	}

	 function update_education_history($data,$candidate_id){
		$this->db->where('candidate_id',$candidate_id);
		$this->db->insert('pms_candidate_education', $data);
		return $candidate_id;
	}

	 function update_certifications($data,$candidate_id,$cert_id){
		$this->db->where('candidate_id',$candidate_id);
		$this->db->where('cert_id',$cert_id);
		$this->db->delete('pms_candidate_to_certification');

		$this->db->insert('pms_candidate_to_certification', $data);
		return $candidate_id;
	}

	 function update_skills($data,$candidate_id,$skill_id){
		$this->db->where('candidate_id',$candidate_id);
		$this->db->where('skill_id',$skill_id);
		$this->db->delete('pms_candidate_to_skills');

		$this->db->insert('pms_candidate_to_skills', $data);
		return $candidate_id;
	}

	 function update_questionnaire($data,$candidate_id,$answer_id){
		$this->db->where('candidate_id',$candidate_id);
		$this->db->where('answer_id',$answer_id);
		$this->db->delete('pms_candidate_survey_result');

		$this->db->insert('pms_candidate_survey_result', $data);
		return $candidate_id;
	}
				
	 function insert_otp_info($data){
		$this->db->where('candidate_id', $data['candidate_id']);
		$this->db->where('otp_status',0);
		$this->db->update('pms_candidate_otp',array('otp_status' => '3'));	
		
		$this->db->insert('pms_candidate_otp', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	
	function update_language_skills($data,$candidate_id)
	{
		$this->db->where('candidate_id', $candidate_id);
		$this->db->update('pms_candidate', $data); 
		return $candidate_id;
	}

	function update_job_history($data,$data1,$candidate_id)
	{
		$this->db->insert('pms_candidate_job_profile', $data); 
		$this->db->where('candidate_id', $candidate_id);
		$this->db->update('pms_candidate', $data1); 
		return $candidate_id;
	}
}
?>