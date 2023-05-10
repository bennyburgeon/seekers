<?php 
class Contactmodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
    
	function __construct()
    {
		$this->table_name='pms_contact';
    }
	
	function record_count($search_email,$search_name,$search_mobile,$reg_status,$branch_id,$lead_opportunity,$lead_assigned,$lead_owner,$lead_source,$date_range,$date_from,$date_to) 
	{
		$sql="select count(*) as total_count from pms_contact a left join pms_contact_counselor c on a.candidate_id=c.candidate_id left join pms_branch b on a.branch_id=b.branch_id ";
		
				
		$cond='';
		
		if($reg_status!='' && $reg_status!='-1')
		{
			if($cond!='')
				$cond.=" and a.reg_status=". $reg_status ." ";
			else
				$cond =" a.reg_status =" . $reg_status . " ";
		}

		if($branch_id!='' && $branch_id!='-1')
		{
			if($cond!='')
				$cond.=" and a.branch_id=". $branch_id ." ";
			else
				$cond =" a.branch_id =" . $branch_id . " ";
		}
		
		if($search_mobile!='' && $search_mobile!='-1')
		{
			if($cond!='')
				$cond.=" and a.mobile like '%". $search_mobile ."%'";
			else
				$cond =" a.mobile like '%" . $search_mobile . "%' ";
		}
	
		if($search_email!='' && $search_email!='-1')
		{
			if($cond!='')
				$cond.=" and a.username like '%". $search_email ."%'";
			else
				$cond =" a.username like '%" . $search_email . "%'";
		}
		
		if($search_name!='' && $search_name!='-1')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $search_name ."%' ";
			else
				$cond =" a.first_name like '%" . $search_name . "%' ";
		}
		
		if($lead_opportunity!='' && $lead_opportunity!='-1')
		{
			if($cond!='')
				$cond.=" and a.lead_opportunity=". $lead_opportunity;
			else
				$cond =" a.lead_opportunity=" . $lead_opportunity;
		}

		if($lead_owner==1)
		{
			if($cond!='')
				$cond.=" and c.admin_id=". $_SESSION['admin_session'];
			else
				$cond =" c.admin_id=" . $_SESSION['admin_session'];
		}

		if($lead_source!='')
		{
			if($cond!='')
				$cond.=" and a.lead_source='". $lead_source."'";
			else
				$cond =" a.lead_source='" . $lead_source."'";
		}
		
		if($lead_owner==2)
		{
			// counselors
		}

		if($lead_assigned==1)
		{
			if($cond!='')
				$cond.=" and c.admin_id <> ''";
			else
				$cond =" c.admin_id <> ''";
		}

		if($lead_assigned==2)
		{
			if($cond!='')
				$cond.=" and a.candidate_id not in (select c.candidate_id from pms_contact_counselor)";
			else
				$cond.=" a.candidate_id not in (select c.candidate_id from pms_contact_counselor)";
		}
		
		if($date_from!='' && $date_to!='' && $date_range!='-1')
		{
			if($cond!='')
				$cond.=" and a.reg_date between '".$date_from."' and '".$date_to."'";
			else
				$cond =" a.reg_date between '".$date_from."' and '".$date_to."'";
		}						
	
		/*if($_SESSION['admin_session']!='')
		{
			if($cond!='')
				$cond.=" and c.admin_id=". $_SESSION['admin_session'];
			else
				$cond.=" c.admin_id=". $_SESSION['admin_session'];
		}*/

		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
			
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['total_count'];
	
	}
	
	function get_list($start,$limit,$search_email,$search_name,$search_mobile,$sort_by,$reg_status,$branch_id,$lead_opportunity,$lead_assigned,$lead_owner,$lead_source,$date_range,$date_from,$date_to)
	{

		$sql="SELECT a.*,b.branch_name FROM ".$this->table_name." a left join pms_contact_counselor c on a.candidate_id=c.candidate_id left join pms_branch b on a.branch_id=b.branch_id ";
		
		$cond='';

		if($reg_status!='' && $reg_status!='-1')
		{
			if($cond!='')
				$cond.=" and a.reg_status=". $reg_status ." ";
			else
				$cond =" a.reg_status =" . $reg_status . " ";
		}

		if($branch_id!='' && $branch_id!='-1')
		{
			if($cond!='')
				$cond.=" and a.branch_id=". $branch_id ." ";
			else
				$cond =" a.branch_id =" . $branch_id . " ";
		}
		
		if($search_email!='' && $search_email!='-1')
		{
			if($cond!='')
				$cond.=" and a.username like '%".$search_email."%' ";
			else
				$cond.=" a.username like '%".$search_email."%' ";
		}
	
		if($search_name!='' && $search_name!='-1')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%".$search_name."%' ";
			else
				$cond.=" a.first_name like '%".$search_name."%' ";
		}
		
		if($search_mobile!='' && $search_mobile!='-1')
		{
			if($cond!='')
				$cond.=" and a.mobile like '%".$search_mobile."%' ";
			else
				$cond.=" a.mobile like '%".$search_mobile."%' ";
		}
		if($lead_opportunity!='' && $lead_opportunity!='-1')
		{
			if($cond!='')
				$cond.=" and a.lead_opportunity=". $lead_opportunity;
			else
				$cond =" a.lead_opportunity=" . $lead_opportunity;
		}
		
		if($lead_owner==1)
		{
			if($cond!='')
				$cond.=" and c.admin_id=". $_SESSION['admin_session'];
			else
				$cond =" c.admin_id=" . $_SESSION['admin_session'];
		}

		if($lead_source!='')
		{
			if($cond!='')
				$cond.=" and a.lead_source='". $lead_source."'";
			else
				$cond =" a.lead_source='" . $lead_source."'";
		}
		
		if($lead_owner==2)
		{
			// counselors
		}

		if($lead_assigned==1)
		{
			if($cond!='')
				$cond.=" and c.admin_id <> ''";
			else
				$cond =" c.admin_id <> ''";
		}
	
		if($lead_assigned==2)
		{
			if($cond!='')
				$cond.=" and a.candidate_id not in (select c.candidate_id from pms_contact_counselor)";
			else
				$cond.=" a.candidate_id not in (select c.candidate_id from pms_contact_counselor)";
		}

		if($date_from!='' && $date_to!='' && $date_range!='-1')
		{
			if($cond!='')
				$cond.=" and a.reg_date between '".$date_from."' and '".$date_to."'";
			else
				$cond =" a.reg_date between '".$date_from."' and '".$date_to."'";
		}	
								
/*		if($_SESSION['admin_session']!='')
		{
			if($cond!='')
				$cond.=" and c.admin_id=". $_SESSION['admin_session'];
			else
				$cond.=" c.admin_id=". $_SESSION['admin_session'];
		}*/

		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;

		$sql.=" order by a.first_name ".$sort_by." limit ".$start.",".$limit;		
		//echo $sql;
		//exit();
		$query = $this->db->query($sql);
		$list=$query->result_array();	
		//print_r($list);
		//exit();
		$lang_total=0;
		$lang_indvidual=0;
		
		foreach($list as $key => $val)
		{
			$grade_array=array();
			// THIS IS FOR PERSONAL DATA
			if($val['username']!=='')$grade_array[1]=1;
			if($val['password']!=='')$grade_array[1]+=1;
			if($val['first_name']!=='')$grade_array[1]+=1;
			if($val['gender']!=='')$grade_array[1]+=1;
			if($val['marital_status']!=='')$grade_array[1]+=1;
			if($val['date_of_birth']!=='')$grade_array[1]+=1;
			if($val['age']!=='')$grade_array[1]+=1;
			if($val['course_id']!=='')$grade_array[1]+=1;
			if($val['lead_source']!=='')$grade_array[1]+=1;
			if($val['mobile']!=='')$grade_array[1]+=1;
			
			// THIS IS FOR LANGUAGE 		
			if($val['eng_pte'] > 0)$lang_total=1;
			if($val['eng_pte_reading'] > 0  && $val['eng_pte_listening'] > 0 && $val['eng_pte_writing'] > 0 && $val['eng_pte_speaking'] > 0)$lang_indvidual=1;

			if($val['eng_ielts'] > 0)$lang_total=1;
			if($val['eng_ielts_reading'] > 0  && $val['eng_ielts_listening'] > 0 && $val['eng_ielts_writing'] > 0 && $val['eng_ielts_speaking'] > 0)$lang_indvidual=1;

			if($val['eng_tofel'] > 0)$lang_total=1;
			if($val['eng_tofel_reading'] > 0  && $val['eng_tofel_listening'] > 0 && $val['eng_tofel_writing'] > 0 && $val['eng_tofel_speaking'] > 0)$lang_indvidual=1;

			if($val['eng_oet'] > 0)$lang_total=1;
			if($val['eng_oet_reading'] > 0  && $val['eng_oet_listening'] > 0 && $val['eng_oet_writing'] > 0 && $val['eng_oet_speaking'] > 0)$lang_indvidual=1;
	
			$grade_array[2]=0;
			if($lang_total > 0 )$grade_array[2]+=1;
			if($lang_indvidual > 0 )$grade_array[2]+=1;
			
			
			if($val['passportno']!=='')$grade_array[2]=1;
			if($val['issued_date']!=='')$grade_array[2]+=1;
			if($val['expiry_date']!=='')$grade_array[2]+=1;
			if($val['eng_10th']!=='')$grade_array[2]+=1;
			if($val['eng_12th']!=='')$grade_array[2]+=1;

			if($grade_array[2]>0)
			{
				$grade_array[2]+=1; // NEED ONE MORE VALUE IN FUTURE
				$grade_array[2]+=1;  // NEED ONE MORE VALUE IN FUTURE
				$grade_array[2]+=1;  // NEED ONE MORE VALUE IN FUTURE
			}	
			
			// EDUCATION 
			// factors need to consider when creating a break down here. 
			// education year back
			// education repeat
			// mark percentage
			// this is profile completion status, consider this in recruitment logic 
			
			$grade_array[3]=0;
			$query = $this->db->query('select * from pms_contact_education where candidate_id='.$val['candidate_id'].' limit 0,1');
			$row=$query->row_array();
			if(count($row)>0)
			{
				if($row['level_id']!='')$grade_array[3]+=1;
				if($row['course_id']!='')$grade_array[3]+=1;
				if($row['spcl_id']!='')$grade_array[3]+=1;
				if($row['univ_id']!='')$grade_array[3]+=1;
				if($row['edu_year']!='')$grade_array[3]+=1;
				if($row['edu_country']!='')$grade_array[3]+=1;
				if($row['absesnse']!='')$grade_array[3]+=1;
				if($row['repeat']!='')$grade_array[3]+=1;
				if($row['year_back']!='')$grade_array[3]+=1;
				if($row['mark_percentage']!='')$grade_array[3]+=1;
    		}

			// CERTIFICATIONS

			$grade_array[4]=0;
			$query = $this->db->query('select count(candidate_id)as total_cert_count from pms_contact_to_certification where candidate_id='.$val['candidate_id']);
			$row=$query->row_array();
			if(count($row)>0)
			{
				$grade_array[4]=10;
    		}else
			{
				if($grade_array[3]>0)$grade_array[4]=10;
			}

			// JOB HISTORY/ PROFESSIONNAL SUMMARY 
			$grade_array[5]=0;
			$query = $this->db->query('select * from pms_contact_education where candidate_id='.$val['candidate_id']. ' limit 0,1');
			$row=$query->row_array();
			if(count($row)>0)
			{
				$grade_array[5]=10;
				// bring all experience here - total experience,experience less than 6 months, experience > 1 year, 2 year brings more rating
				// year gap from previous jobs, education, first job, cmpletly based on an algorithm for identifying experience, salary etc. 
    		}
			
			// SKILLS 
			$grade_array[6]=0;
			$query = $this->db->query('select count(candidate_id) as total_skill_count from pms_contact_to_skills where candidate_id='.$val['candidate_id']);
			$row=$query->row_array();
			if(count($row)>0)
			{
				$grade_array[6]=10;
    		}else
			{
				if($grade_array[3]>0)$grade_array[6]=10;
			}
			
						
			//QUESTIONNAIRE
			$grade_array[7]=0;
			$query = $this->db->query('select count(candidate_id)as total_syrvey from pms_contact_survey_result where candidate_id='.$val['candidate_id']);
			$row=$query->row_array();
			if(count($row)>0)
			{
				if($row['total_syrvey']>9)
					$grade_array[7]=10;
				else
					$grade_array[7]=$row['total_syrvey'];
    		}
			
			//FILES
			$grade_array[8]=0;
			$query = $this->db->query('select count(candidate_id)as total_files from pms_contact_files where candidate_id='.$val['candidate_id']);
			$row=$query->row_array();
			if(count($row)>0)
			{
				$grade_array[8]=10;
    		}
			
			// FOLLOW UP - FIND FOR ANY FOLLOW UP 
			$grade_array[9]=0;
			$query = $this->db->query('select count(candidate_id) as total_follow_up from pms_contact_followup where candidate_id='.$val['candidate_id']);
			$row=$query->row_array();
			if(count($row)>0)
			{
				$grade_array[9]=10;
    		}
			$grade_array[10]=10;
			$list[$key]['candidate_rating']=$grade_array;
			
		}
		//print_r($list);
		//	exit();
		return $list;
	}

	function candidate_delete($id)
	{
		$query = $this->db->query("select photo from pms_contact where md5(candidate_id)='".$id."'");
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
			unlink('uploads/photos/'.$row['photo']);
		}

		$query = $this->db->query("select cv_file from pms_contact where md5(candidate_id)='".$id."'");
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
			unlink('uploads/cvs/'.$row['cv_file']);
		}
		
		$query = $this->db->query("select file_type,file_id from pms_contact_files where md5(candidate_id)='".$id."'");
		if ($query->num_rows() > 0)
		{
			$row = $query->result_array();
			foreach($row as $key => $val)
			{
				if(file_exists('uploads/photos/'.$val['file_type']) && $val['file_type']!='')
				unlink('uploads/photos/'.$val['file_type']);
				$this->db->query("delete from pms_contact_files where file_id=".$val['file_id']);
			}
		}			
		
		// delete from admin to candidates list
		$this->db->query("delete from pms_contact_counselor where md5(candidate_id)='".$id."'");	
		// delete from candidate adress
		$this->db->query("delete from pms_contact_address where md5(candidate_id)='".$id."'");
		// delete from VISA approvals list
		$this->db->query("delete from pms_contact_visa_approval where md5(candidate_id)='".$id."'");
		// delete from applications 
		$this->db->query("delete from pms_contact_applications where md5(candidate_id)='".$id."'");
		// delete from cv files 
		$this->db->query("delete from pms_contact_cvfile where md5(candidate_id)='".$id."'");
		// delete from education
		$this->db->query("delete from pms_contact_education where md5(candidate_id)='".$id."'");
		// delete from candidate files uploaded
		$this->db->query("delete from pms_contact_files where md5(candidate_id)='".$id."'");
		// delete from candidate follow up
		$this->db->query("delete from pms_contact_followup where md5(candidate_id)='".$id."'");
		// delete from interviews
		$this->db->query("delete from pms_contact_interviews where md5(candidate_id)='".$id."'");
		// delete from job profile
		$this->db->query("delete from pms_contact_job_profile where md5(candidate_id)='".$id."'");
		// delete from notes 
		$this->db->query("delete from pms_contact_notes where md5(candidate_id)='".$id."'");
		// delete from survey result
		$this->db->query("delete from pms_contact_survey_result where md5(candidate_id)='".$id."'");
		// delete from certification
		$this->db->query("delete from pms_contact_to_certification where md5(candidate_id)='".$id."'");
		// delete from skills 
		$this->db->query("delete from pms_contact_to_skills where md5(candidate_id)='".$id."'");		
		// delete ticket folllow ups
		$this->db->query("delete from pms_tickets_followup where ticket_id in (select ticket_id from pms_tickets where md5(candidate_id)='".$id."')");		
		// delete from tickets 
		$this->db->query("delete from pms_tickets where md5(candidate_id)='".$id."'");
		// delete from sms email history
		$this->db->query("delete from pms_email_sms_history where md5(candidate_id)='".$id."'");	
		// delete from candidates
		$this->db->query("delete from pms_contact where md5(candidate_id)='".$id."'");		
	
		return;
	}
		
	function move_to_candidate($id)
	{
		$query = $this->db->query("select * from pms_contact where md5(candidate_id)='".$id."'");
		$row=$query->row_array();
		if($this->check_dups($row['username'],$row['mobile'])==true)
		{
			$candidate_id=$this->insert_candidate_from_contact($row);
			
			//porting education from contacts to candidates. 
			$query = $this->db->query("select * from pms_contact_education where md5(candidate_id)='".$id."'");
			$row=$query->result_array();

			foreach($row as $key => $val)
			{
				if(isset($val['eucation_id']))unset($val['eucation_id']);
				$val['candidate_id']=$candidate_id;
				$this->db->insert('pms_candidate_education', $val);
			}
			
			//end education porting from here.

			//porting job histgory from contacts to candidates. 
			$query = $this->db->query("select * from pms_contact_job_profile where md5(candidate_id)='".$id."'");
			$row=$query->result_array();

			foreach($row as $key => $val)
			{
				if(isset($val['job_profile_id']))unset($val['job_profile_id']);
				$val['candidate_id']=$candidate_id;
				$this->db->insert('pms_candidate_job_profile', $val);
			}
			//end job history porting from here.

			//porting tech skills from contacts to candidates. 
			$query = $this->db->query("select * from pms_contact_to_skills where md5(candidate_id)='".$id."'");
			$row=$query->result_array();
			foreach($row as $key => $val)
			{
				$val['candidate_id']=$candidate_id;
				$this->db->insert('pms_candidate_to_skills', $val);
			}
			
			//end tech skills porting from here.

			//porting Certifications from contacts to candidates. 
			$query = $this->db->query("select * from pms_contact_to_certification where md5(candidate_id)='".$id."'");
			$row=$query->result_array();
			foreach($row as $key => $val)
			{
				$val['candidate_id']=$candidate_id;
				$this->db->insert('pms_candidate_to_certification', $val);	
			}	

			//porting Questionnaire from contacts to candidates. 
			$query = $this->db->query("SELECT * FROM pms_contact_survey_result where md5(candidate_id)='".$id."'");
			$row=$query->result_array();
			foreach($row as $key => $val)
			{
				if(isset($val['result_id']))unset($val['result_id']);
				$val['candidate_id']=$candidate_id;
				$this->db->insert('pms_candidate_survey_result', $val);	
			}	
			// update candidate status to 1 
			$query = $this->db->query("update pms_candidate set reg_status=1 where candidate_id=".$candidate_id);
			
			//end certifications porting from here.
			return $candidate_id;
		}else
		{
			return '0';
		}
		return;
	}
	
	function check_dups($username,$mobile)
	{
		$this->db->where('username', $username);
		$this->db->where('mobile', $mobile);
		$query = $this->db->get('pms_candidate');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}	

	function insert_candidate_from_contact($data)
	{
		$contact_id=$data['candidate_id'];
		
		if(isset($data['extras']))unset($data['extras']);
		if(isset($data['candidate_id']))unset($data['candidate_id']);
		if(isset($data['new_candidate_id']))unset($data['new_candidate_id']);
		
		$this->db->insert('pms_candidate', $data);
        $id = $this->db->insert_id();
		$data =array(
			'candidate_id'=> $id,
			'admin_id'=> $_SESSION['admin_session'],
			'assigned_date'=> date('Y-m-d'),
		);

		$this->db->insert('pms_admin_candidates', $data);		
		
		$data =array(
			'contact_id'=> $contact_id,
		);
		$this->db->where('candidate_id', $id);
		$this->db->update('pms_candidate', $data);	

		$data =array(
			'new_candidate_id'=> $id,
		);
		$this->db->where('candidate_id', $contact_id);
		$this->db->update('pms_contact', $data);	
						
		return $id;
	}
		
	function file_list($candidate_id)
	{
		$query = $this->db->query('select * from pms_contact_files where candidate_id='.$candidate_id);
		return $query->result_array();
	}

   function detail_list($candidate_id)
   {
   		$query = $this->db->query('select a.*,b.address,c.course_name from pms_contact a left join pms_contact_address b on a.candidate_id=b.candidate_id left join pms_courses c on a.course_id=c.course_id where a.candidate_id='.$candidate_id);
	return $query->row_array();
   }
  
   function education_deatils($candidate_id)
   {
   		$query = $this->db->query('select a.*,c.*,d.level_name from pms_contact_education a inner join pms_contact b on a.candidate_id=b.candidate_id left join pms_courses c on a.course_id=c.course_id left join pms_education_level d on a.level_id=d.level_id where a.candidate_id='.$candidate_id.' order by a.eucation_id');
		return $query->result_array();
   }   

	 function follow_record($candidate_id)
    {
        $query=$this->db->query("select a.*,b.status_name,c.app_details from pms_contact_followup a left join pms_process_status b on a.status_id=b.status_id left join pms_contact_applications c on a.app_id=c.app_id where a.candidate_id=".$candidate_id);
		return $query->result_array();
	}
	
	 function select_record($id)
    {
        $query=$this->db->query("select a.*,b.status_name,c.app_details from pms_contact_followup a left join pms_process_status b on a.status_id=b.status_id left join pms_contact_applications c on a.app_id=c.app_id where candidate_follow_id=".$id." order by a.candidate_follow_id  desc");
		return $query->row_array();
	}
  
     function select_followup_list($candidate_id){
	 
   	  $query = $this->db->query('select * from pms_contact_followup where candidate_id='.$candidate_id);
	  return $query->result_array();
   }
	
	
	 function select_notes_record($id)
    {
        $query=$this->db->query("select * from pms_contact_notes where candidate_note_id=".$id);
		return $query->row_array();
	}
	
	 function select_interview_record($id)
    {
        $query=$this->db->query("select a.*,b.interview_type,c.int_status_name from pms_contact_interviews a inner join pms_contact_interview_types b on a.interview_type_id=b.interview_type_id inner join pms_contact_interview_status c on a.int_status_id=c.int_status_id where a.interview_id=".$id);
		return $query->row_array();
	}
	
	function select_aplication_record($id)
    {
              $query=$this->db->query("select a.*,b.univ_name,b.univ_id,c.course_name,c.level_study,d.status_name,e.intake_month,e.intake_id,f.campus_name from pms_contact_applications a left join pms_campus f on a.campus_id=f.campus_id left join pms_university b on f.univ_id=b.univ_id left join pms_courses c on a.course_id=c.course_id left join pms_process_status d on a.process_status_id=d.status_id left join pms_university_intake e on a.intake_id=e.intake_id where a.app_id=".$id);
		return $query->row_array();
	}

	function select_aplication_coe($candidate_id)
	{
		$query = $this->db->query("select distinct app_id,app_details from pms_contact_applications where app_id not in (select app_id from pms_contact_visa_approval) and app_status=1 and candidate_id=".$candidate_id);
		$dropdowns = $query->result();
		$dropDownList[0]='Select Program';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->app_id] = $dropdown->app_details;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	
	}

	

	 function cvfile_list($candidate_id)
    {
        $query=$this->db->query("select * from pms_contact_cvfile where candidate_id=".$candidate_id);
		return $query->result_array();
	}
	
	function email_sms_list($candidate_id)
    {
        $query=$this->db->query("select * from pms_email_sms_history where candidate_id=".$candidate_id);
		return $query->result_array();
	}

	function ticket_list($candidate_id)
    {
        $query=$this->db->query("select * from pms_tickets where candidate_id=".$candidate_id);
		return $query->result_array();
	}
		
	 function job_list($candidate_id)
    {
        $query=$this->db->query("select a.*,b.*,c.* from pms_contact_job_profile a left join pms_job_category b on a.job_cat_id=b.job_cat_id left join pms_job_functional_area c on a.func_id=c.func_id where a.candidate_id=".$candidate_id);
		return $query->result_array();
	}	

	 function all_counselor($candidate_id)
    {
        $query=$this->db->query("select admin_id, username, firstname from pms_admin_users where admin_id not in (select a.admin_id from pms_admin_users a inner join pms_contact_counselor b on a.admin_id=b.admin_id where b.candidate_id=".$candidate_id.") order by firstname");

		return $query->result_array();
	}	
	
	 function candidate_counselor($candidate_id)
    {
        $query=$this->db->query("select a.admin_id, a.username, a.firstname from pms_admin_users a inner join pms_contact_counselor b on a.admin_id=b.admin_id where b.candidate_id=".$candidate_id);

		return $query->result_array();
	}		

	 function candidate_skills($candidate_id)
    {
        $query=$this->db->query("SELECT a.skill_name FROM `pms_contact_skills` a inner join pms_contact_to_skills b on a.skill_id=b.skill_id where b.candidate_id=".$candidate_id." order by a.skill_name");
		return $query->result_array();
	}

	 function candidate_certifications($candidate_id)
    {
        $query=$this->db->query("SELECT a.cert_name FROM `pms_contact_certification` a inner join pms_contact_to_certification b on a.cert_id=b.cert_id where b.candidate_id=".$candidate_id." order by a.cert_name");
		return $query->result_array();
	}


	 function candidate_programs_suggestion_summary($candidate_id)
    {
		// select progams based on qualifications
		$query = $this->db->query("select a.course_id,a.course_name from pms_courses a inner join pms_contact_education b on a.course_id=b.course_id where b.candidate_id=".$candidate_id);
	
		$courses_list = $query->result_array();
		$suggestion_list=array();
		
		foreach($courses_list as $course)
		{
			$suggestion_list[$course['course_id']]['qualification']=$course['course_name'];
			$query=$this->db->query("select a.course_name,b.int_course_id from pms_courses a inner join pms_courses_international b on a.course_id=b.int_course_id where b.course_id=".$course['course_id']);
			$programs = $query->result_array();
			foreach($programs as $program)
			{
				$suggestion_list[$course['course_id']]['programs'][$program['int_course_id']]['course_name'] = $program['course_name'];
				// select campus where this course conduct.
				$query=$this->db->query("SELECT a.campus_name,a.campus_id,b.univ_name FROM `pms_campus` a inner join pms_university b on a.univ_id=b.univ_id inner join pms_campus_courses c on a.campus_id=c.campus_id inner join pms_courses d on c.course_id=d.course_id and c.course_id=".$program['int_course_id']);
				$campus_list=array();
				$all_campus = $query->result_array();
				foreach($all_campus as $campus)
				{
					$campus_list=array($campus['campus_id'] => 'Univ -: '.$campus['univ_name'] . ' , Campus-:  ' . $campus['campus_name']);
				}
				$suggestion_list[$course['course_id']]['programs'][$program['int_course_id']]['campus_list']=$campus_list;
				// campus list ends here

			}// programs end here
		} // courses end here
		return $suggestion_list;
	}



	 function education_list($candidate_id)
    {
        $query=$this->db->query("select a.*,b.*,c.*,d.*,e.*,f.* from pms_contact_education a left join pms_education_level b on a.level_id=b.level_id left join pms_courses c on a.
course_id=c.course_id left join pms_specialisation d on a.spcl_id=d.spcl_id left join pms_university e on a.univ_id=e.univ_id left join pms_course_type f on a.course_type_id=f.course_type_id  where candidate_id=".$candidate_id);
		return $query->result_array();
	}
		
	function interview_type_list()
	{
		$query = $this->db->query('select distinct interview_type_id,interview_type from pms_contact_interview_types order by interview_type desc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Interview Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->interview_type_id] = $dropdown->interview_type;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function admin_user_list()
	{
		$query = $this->db->query('select distinct admin_id,firstname from pms_admin_users order by firstname');
		$dropdowns = $query->result();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->admin_id] = $dropdown->firstname;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
		
	function university_list()
	{
		$query = $this->db->query('select distinct a.univ_id,a.univ_name from pms_university a inner join pms_campus b on a.univ_id=b.univ_id order by a.univ_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select University';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->univ_id] = $dropdown->univ_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

   	function course_list_level($level_id)
	{
		$query = $this->db->query("select distinct course_id,course_name from pms_courses where level_study=".$level_id." order by course_name desc");
		$dropdowns = $query->result();
		$dropDownList['']='Select Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
   	function campus_list($univ_id)
	{
		$query = $this->db->query("select distinct campus_id,campus_name from pms_campus where univ_id=".$univ_id." order by campus_name desc");
		$dropdowns = $query->result();
		$dropDownList['']='Select Campus';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->campus_id] = $dropdown->campus_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function intake_list()
	{
		$query = $this->db->query('select intake_id,intake_month from pms_university_intake order by intake_month asc');
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
		$dropDownList['']='Select Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function candidate_qualification_list($candidate_id)
	{
		$query = $this->db->query("SELECT a.course_id, b.course_name,a.candidate_id,c.level_name FROM `pms_contact_education` a inner join pms_courses b on a.course_id=b.course_id inner join pms_education_level c on b.level_study=c.level_id where a.candidate_id =".$candidate_id." order by b.course_name");
		
		$dropdowns = $query->result();
		$dropDownList['']='Select Qualification';
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
	
		function aplication_list($candidate_id)
	{
		$query = $this->db->query("select distinct app_id,app_details from pms_contact_applications where candidate_id=".$candidate_id);
		$dropdowns = $query->result();
		$dropDownList[0]='Select Program';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->app_id] = $dropdown->app_details;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
   function interview_status_list()
	{
		$query = $this->db->query('select * from  pms_contact_interview_status');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Interview Status';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->int_status_id] = $dropdown->int_status_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
   
    
   
    function notes_record($candidate_id)
    {
        $query=$this->db->query("select * from pms_contact_notes where candidate_id=".$candidate_id);
		return $query->result_array();
	}
	
	 function interview_record($candidate_id)
    {
        $query=$this->db->query("select a.*,b.interview_type,c.int_status_name from pms_contact_interviews a inner join pms_contact_interview_types b on a.interview_type_id=b.interview_type_id inner join pms_contact_interview_status c on a.int_status_id=c.int_status_id where a.candidate_id=".$candidate_id);
		return $query->result_array();
	}
	
	
	 function aplication_record($candidate_id)
    {
       // $query=$this->db->query("select a.*,b.campus_name,c.course_name,d.status_name,e.intake_month from pms_contact_applications a inner join pms_campus b on a.campus_id=b.campus_id inner join pms_courses c on a.course_id=c.course_id inner join pms_process_status d on a.process_status_id=d.status_id inner join pms_university_intake e on a.intake_id=e.intake_id where a.app_status=0 and a.candidate_id=".$candidate_id);

 		$query=$this->db->query("select a.*,b.campus_name,c.course_name,d.status_name,e.intake_month from pms_contact_applications a inner join pms_campus b on a.campus_id=b.campus_id inner join pms_courses c on a.course_id=c.course_id inner join pms_process_status d on a.process_status_id=d.status_id inner join pms_university_intake e on a.intake_id=e.intake_id where a.candidate_id=".$candidate_id);
 	   
		return $query->result_array();
	}

	 function visa_approval_list($candidate_id)
    {
        $query=$this->db->query("select a.* from pms_contact_visa_approval a where a.candidate_id=".$candidate_id);
	
		return $query->result_array();
	}

	 function coe_list($candidate_id)
    {
        $query=$this->db->query("select a.*,b.campus_name,c.course_name,d.status_name,e.intake_month from pms_contact_applications a inner join pms_campus b on a.campus_id=b.campus_id inner join pms_courses c on a.course_id=c.course_id left join pms_process_status d on a.process_status_id=d.status_id left join pms_university_intake e on a.intake_id=e.intake_id where a.app_status=1 and a.candidate_id=".$candidate_id);
	
		return $query->result_array();
	}
		
	 function drop_record($candidate_follow_id)
    {
		$this->db->where('candidate_follow_id',$candidate_follow_id);
		$this->db->delete('pms_contact_followup');
	}
	 function cvfile_drop_record($cvfile_id)
    {
		$this->db->where('cvfile_id',$cvfile_id);
		$this->db->delete('pms_contact_cvfile');
	}

	 function drop_job_item($job_profile_id)
    {
		$this->db->where('job_profile_id',$job_profile_id);
		$this->db->delete('pms_contact_job_profile');
	}

	 function drop_email_sms_item($email_sms_id)
    {
		$this->db->where('email_sms_id',$email_sms_id);
		$this->db->delete('pms_email_sms_history');
	}

	 function drop_ticket_item($ticket_id)
    {
		$this->db->where('ticket_id',$ticket_id);
		$this->db->delete('pms_tickets_followup');
		
		$this->db->where('ticket_id',$ticket_id);
		$this->db->delete('pms_tickets');
	}
		
	 function drop_edu_item($eucation_id)
    {

		$this->db->where('eucation_id',$eucation_id);
		$this->db->delete('pms_contact_education');
	}
			
	 function note_drop_record($candidate_note_id)
    {
		$this->db->where('candidate_note_id',$candidate_note_id);
		$this->db->delete('pms_contact_notes');
	}
	
	 function interview_drop_record($interview_id)
    {
		$this->db->where('interview_id',$interview_id);
		$this->db->delete('pms_contact_interviews');
	}
	
	 function aplication_drop_record($app_id)
    {
		$this->db->where('app_id',$app_id);
		$this->db->delete('pms_contact_visa_approval');

		$this->db->where('app_id',$app_id);
		$this->db->delete('pms_contact_followup');
			
		$this->db->where('app_id',$app_id);
		$this->db->delete('pms_contact_applications');
	}
	
	function get_addressbook() {     
        $query = $this->db->get('pms_contact');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
 function insert_csv_records($data) {
  $this->db->insert('pms_contact', $data);
  $id=$this->db->insert_id();
  return $id;
    }
	 
 function insert_csv1($data) {
        $this->db->insert('pms_contact_address', $data);
		$data1 = array(
				'candidate_id' => $data['candidate_id']
				);
		$this->db->insert('pms_contact_education', $data1);
		$data2 = array(
				'candidate_id' => $data['candidate_id']
				);
		$this->db->insert('pms_contact_job_profile', $data2);
    }
	

	function insert_record()
    {
				
				$data=array(
				'username'=>  $this->input->post('username'),
				'password'=>  md5($this->input->post("password")),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'reg_date' => date('Y-m-d'),
				'title' => $this->input->post('title'),
				'alternate_email' => $this->input->post('username'),
				'mobile' => $this->input->post('mobile'),
				'mobile_prefix' => $this->input->post('mobile_prefix'),
				'gender' =>  $this->input->post('gender') ,
				'marital_status' =>  $this->input->post('marital_status'),
				'date_of_birth' =>  $this->input->post('date_of_birth'),
				'exp_years' =>  $this->input->post('exp_years'),
				'exp_months' =>  $this->input->post('exp_months'),		
				'nationality' =>  $this->input->post('nationality'),
				'passportno' =>  $this->input->post('passportno'),
				'visa_type_id' =>  $this->input->post('visa_type_id'),					
				'driving_license' =>  $this->input->post('driving_license'),		
				'current_location' =>  $this->input->post('current_location'),		
				'city_id' =>   $this->input->post('city_id'),
				'state' =>   $this->input->post('state'),
				'religion_id' =>  $this->input->post('religion_id'),						
				'ref_id' =>  $this->input->post('ref_id'),
				'keywords' =>  $this->input->post('keywords'),
				'photo' =>  $this->input->post('photo'),
				'cv_file' =>  $this->input->post('cv_file'),
				'skills' =>  $this->input->post('skills')
				);
				
				$this->db->insert($this->table_name, $data);
				$this->new_id=$this->db->insert_id();
				
				if($this->new_id!='')
				{	
					$data=array(
					'candidate_id' => $this->new_id,
					'address'=> $this->input->post('address'),
					'mobile_prefix' => $this->input->post('mobile_prefix'),
					'mobile' => $this->input->post('mobile'),
					'land_prefix' => $this->input->post('land_prefix'),
					'land_phone'=> $this->input->post('land_phone'),
					'work_prefix' => $this->input->post('work_prefix'),
					'workphone' => $this->input->post('workphone'),
					'fax_prefix' => $this->input->post('fax_prefix'),
					'fax' => $this->input->post('fax') ,
					'zipcode' => $this->input->post('zipcode')
					);
					
					$this->db->insert('pms_contact_address', $data);
					
					$data=array(
					'candidate_id' => $this->new_id,
					'level_id'=> $this->input->post('level_id'),
					'course_id' => $this->input->post('course_id'),
					'spcl_id'=> $this->input->post('spcl_id'),
					'univ_id' => $this->input->post('univ_id'),
					'edu_year' => $this->input->post('edu_year'),
					'edu_country' => $this->input->post('edu_country'),
					'course_type_id' => $this->input->post('course_type_id')
					);
					
					$this->db->insert('pms_contact_education', $data);
					
					$data=array(
					'candidate_id' => $this->new_id,
					'organization'=> $this->input->post('organization'),
					'designation' => $this->input->post('designation'),
					'job_cat_id'=> $this->input->post('job_cat_id'),
					'func_id' => $this->input->post('func_id'),
					'responsibility' => $this->input->post('responsibility'),
					'from_date' => $this->input->post('from_date'),
					'to_date' => $this->input->post('to_date'),
					'monthly_salary' => $this->input->post('monthly_salary'),
					'currency_id' => $this->input->post('currency_id'),
					'present_job' => $this->input->post('present_job')
					);
					
					$this->db->insert('pms_contact_job_profile', $data);

					$this->load->library('upload');					
					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
						{         
							$photo['upload_path'] = 'uploads/photos/';
							$photo['allowed_types'] = 'png|jpg|jpeg|gif';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('photo'))
								{
									
									$this->upload_file_name='';
									$data =  $this->upload->data();	
									$this->upload_file_name=$data['file_name'];					
									$this->db->query("update ".$this->table_name." set photo='".$this->upload_file_name."' where candidate_id=".$this->new_id);
								}
						 }
						 
					
		
										$this->load->library('upload');					

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
									$this->db->query("update ".$this->table_name." set cv_file='".$this->upload_file_name."' where candidate_id=".$this->new_id);
								}
						 }		
			}	
		return;
    }
	
	function get_files($candidate_id){
		
		$query=$this->db->query("select * from pms_contact_files where candidate_id=".$candidate_id);
		return $query->result_array();
   		
   }
   function get_survey_result($id)
   {
   		$survey_result=array();
		
   		 $query = $this->db->query('SELECT a.question_id,a.question_title FROM `pms_contact_survey_questions` a order by a.question_id');
		 $result=$query->result_array();
		 foreach($result as $row)
		 {
		 	 $survey_result[$row['question_id']]=$row;
			 $query_question = $this->db->query('SELECT answer_title FROM `pms_contact_survey_answers` where question_id='.$row['question_id']);
			 $answer=$query_question->result_array();
			 
			 $survey_result[$row['question_id']]['answer'][0]=$answer[0]['answer_title'];
			 $survey_result[$row['question_id']]['answer'][1]=$answer[1]['answer_title'];

			 $query_result = $this->db->query('SELECT a.answer_value FROM `pms_contact_survey_result` a  where a.candidate_id='.$id.' and a.answer_id='.$row['question_id']);
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

   function get_skill_set()
   {
		$query = $this->db->query('SELECT a.skill_id, a.skill_name, b.candidate_id FROM pms_contact_skills a LEFT JOIN pms_contact_to_skills b ON a.skill_id = b.skill_id ORDER BY a.skill_name');
		
		$dropdowns = $query->result();
		$survey_result=array();
		foreach($dropdowns as $dropdown)
		{
			 $survey_result[$dropdown->skill_id] = array('skill_name' => $dropdown->skill_name, 'candidate_id' => $dropdown->candidate_id);
		}
	
		return $survey_result;
   }

   function get_skill_set_candidate($candidate_id)
   {
		$query = $this->db->query('SELECT a.skill_id, a.skill_name, b.candidate_id FROM pms_contact_skills a LEFT JOIN pms_contact_to_skills b ON a.skill_id = b.skill_id where b.candidate_id='.$candidate_id.' ORDER BY a.skill_name');
		
		$dropdowns = $query->result();
		$survey_result=array();
		foreach($dropdowns as $dropdown)
		{
			 $survey_result[] =$dropdown->skill_id;
		}
	
		return $survey_result;
   }


   function get_certifications_set()
   {
		$query = $this->db->query('SELECT a.cert_id, a.cert_name, b.candidate_id FROM pms_contact_certification a LEFT JOIN pms_contact_to_certification b ON a.cert_id = b.cert_id ORDER BY a.cert_name');
		
		$dropdowns = $query->result();
		$survey_result=array();
		foreach($dropdowns as $dropdown)
		{
			 $survey_result[$dropdown->cert_id] = array('cert_name' => $dropdown->cert_name, 'candidate_id' => $dropdown->candidate_id);
		}
	
		return $survey_result;
   }

   function get_certifications_set_candidate($candidate_id)
   {
		$query = $this->db->query('SELECT a.cert_id, a.cert_name, b.candidate_id FROM pms_contact_certification a LEFT JOIN pms_contact_to_certification b ON a.cert_id = b.cert_id where b.candidate_id='.$candidate_id.' ORDER BY a.cert_name');
		
		$dropdowns = $query->result();
		$survey_result=array();
		foreach($dropdowns as $dropdown)
		{
			 $survey_result[] = $dropdown->cert_id;
		}
	
		return $survey_result;
   }
      
   function get_one_record($id){
	   $query = $this->db->query('select * from pms_contact_files where file_id='.$id);
		return $query->row_array();
   }
   
      function get_one_file($candidate_id){

   		$query = $this->db->query('select photo from pms_contact where candidate_id='.$candidate_id);
		return $query->row_array();
		 
   }
   function delete_one_file($id){

   		$query = $this->db->query('select photo from pms_contact where candidate_id='.$id);
		return $query->row_array();
		 
   }
	
	
	
	function insert_file($candidate_id)
	{
		$data = array(
		
				'candidate_id' => $this->input->post('candidate_id'),
				'file_name' => $this->input->post('title'),
				'upload_date' => date('Y-m-d'),
				'status'       =>'',
				);
				$this->db->insert('pms_contact_files',$data);
				$id=$this->db->insert_id();
	$this->load->library('upload');					
					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
						{  
						     
							$photo['upload_path'] = 'uploads/photos/';
							$photo['allowed_types'] = 'png|jpg|jpeg|pdf|doc|docx|xls|xlsx|ppt|txt';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('photo'))
								{
			                     	$this->upload_file_name='';
									$data =  $this->upload->data();	
								 	$this->upload_file_name=$data['file_name'];	
									$this->db->query("update pms_contact_files set file_type='".$this->upload_file_name."' where file_id=".$id);
								}
						 }
						 
					return $id;
	}
	
	function update_file($candidate_id)
	{
		$this->load->library('upload');	
					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
						{         
							$photo['upload_path'] = 'uploads/photos/';
							$photo['allowed_types'] = 'png|jpg|jpeg|gif';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('photo'))
								{
									$this->upload_file_name='';
									$data =  $this->upload->data();									
									$this->upload_file_name=$data['file_name'];	
									$query = $this->db->query("select photo from pms_contact where candidate_id=".$this->input->post('candidate_id'));
									if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
										if($row['photo']!='no_photo.png'){
										unlink('uploads/photos/'.$row['photo']);
									}
								}
							$this->db->query("update ".$this->table_name." set photo='".$this->upload_file_name."' where candidate_id=".$this->input->post('candidate_id'));
							$this->db->query("update pms_contact_files set file_name='".$this->upload_file_name."',file_type='".$this->upload_file_name."' where file_name='".$row['photo']."' and candidate_id=".$candidate_id);

								}
						 }	
	}
	
	
	function delete_file($id)
	{
	$this->load->library('upload');	
	$query = $this->db->query("select photo from pms_contact where candidate_id=".$id);
									if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
										unlink('uploads/photos/'.$row['photo']);
									}

							$this->db->query("update ".$this->table_name." set photo='no_photo.png' where candidate_id=".$id);
										
$this->db->query("update pms_contact_files set file_name='no_photo.png',file_type='no_photo.png' where file_name='".$row['photo']."' and candidate_id=".$id);
}
	
	
	
	function update_record($id=NULL)
	{

				$data=array(
				'username'=>  $this->input->post('username'),
				'password'=>  $this->input->post('password'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'title' => $this->input->post('title'),
				'alternate_email' => $this->input->post('username'),
				'mobile' => $this->input->post('mobile'),
				'mobile_prefix' => $this->input->post('mobile_prefix'),
				'gender' =>  $this->input->post('gender') ,
				'marital_status' =>  $this->input->post('marital_status'),
				'date_of_birth' =>  $this->input->post('date_of_birth'),
				'exp_years' =>  $this->input->post('exp_years'),
				'exp_months' =>  $this->input->post('exp_months'),		
				'nationality' =>  $this->input->post('nationality'),
				'passportno' =>  $this->input->post('passportno'),	
				'visa_type_id' =>  $this->input->post('visa_type_id'),
				'driving_license' =>  $this->input->post('driving_license'),		
				'current_location' =>  $this->input->post('current_location'),		
				'city_id' =>   $this->input->post('city_id'),
				'state' =>   $this->input->post('state'),
				'religion_id' =>  $this->input->post('religion_id'),						
				'ref_id' =>  $this->input->post('ref_id'),
				'keywords' =>  $this->input->post('keywords'),
				'skills' =>  $this->input->post('skills')
				);
				
			   $this->db->where('candidate_id', $this->input->post('candidate_id'));
			   $this->db->update($this->table_name, $data);

				if($this->input->post('candidate_id')!='')
				{	
					$data=array(
					'candidate_id' => $this->input->post('candidate_id'),
					'address'=> $this->input->post('address'),
					'mobile_prefix' => $this->input->post('mobile_prefix'),
					'mobile' => $this->input->post('mobile'),
					'land_prefix' => $this->input->post('land_prefix'),
					'land_phone'=> $this->input->post('land_phone'),
					'work_prefix' => $this->input->post('work_prefix'),
					'workphone' => $this->input->post('workphone'),
					'fax_prefix' => $this->input->post('fax_prefix'),
					'fax' => $this->input->post('fax') ,
					'zipcode' => $this->input->post('zipcode')
					);
					
					$this->db->query("delete from pms_contact_address where candidate_id=".$this->input->post('candidate_id'));					
					$this->db->insert('pms_contact_address', $data);
					
					$data=array(
					'candidate_id' => $this->input->post('candidate_id'),
					'level_id'=> $this->input->post('level_id'),
					'course_id' => $this->input->post('course_id'),
					'spcl_id'=> $this->input->post('spcl_id'),
					'univ_id' => $this->input->post('univ_id'),
					'edu_year' => $this->input->post('edu_year'),
					'edu_country' => $this->input->post('edu_country'),
					'course_type_id' => $this->input->post('course_type_id')
					);
					
					$this->db->query("delete from pms_contact_education where candidate_id=".$this->input->post('candidate_id'));					
					$this->db->insert('pms_contact_education', $data);
					
					$data=array('candidate_id' => $this->input->post('candidate_id'),
					'organization'=> $this->input->post('organization'),
					'designation' => $this->input->post('designation'),
					'job_cat_id'=> $this->input->post('job_cat_id'),
					'func_id' => $this->input->post('func_id'),
					'responsibility' => $this->input->post('responsibility'),
					'from_date' => $this->input->post('from_date'),
					'to_date' => $this->input->post('to_date'),
					'monthly_salary' => $this->input->post('monthly_salary'),
					'currency_id' => $this->input->post('currency_id'),
					'present_job' => $this->input->post('present_job')
					);
					
					$this->db->query("delete from pms_contact_job_profile where candidate_id=".$this->input->post('candidate_id'));
					$this->db->insert('pms_contact_job_profile', $data);

			 }

					$this->load->library('upload');	

					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
						{         
							$photo['upload_path'] = 'uploads/photos/';
							$photo['allowed_types'] = 'png|jpg|jpeg|gif';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('photo'))
								{
									$this->upload_file_name='';
									$data =  $this->upload->data();									
									$this->upload_file_name=$data['file_name'];	
									$query = $this->db->query("select photo from pms_contact where candidate_id=".$this->input->post('candidate_id'));
									if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
										unlink('uploads/photos/'.$row['photo']);
									}
													
									$this->db->query("update ".$this->table_name." set photo='".$this->upload_file_name."' where candidate_id=".$this->input->post('candidate_id'));
								}
						 }	

						if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
							{         
							

								$photo['upload_path'] = 'uploads/cvs/';
								$photo['allowed_types'] =  'doc|docx|pdf|txt';
								$photo['max_size']	= '0';
								$photo['file_name'] = md5(uniqid(mt_rand()));
								
								$this->upload->initialize($photo);
								if ($this->upload->do_upload('cv_file'))
									{
										$this->upload_file_name='';
										$data =  $this->upload->data();									
										$this->upload_file_name=$data['file_name'];	
										$query = $this->db->query("select cv_file from pms_contact where candidate_id=".$this->input->post('candidate_id'));
										if ($query->num_rows() > 0)
										{
											$row = $query->row_array();
											if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
											unlink('uploads/cvs/'.$row['cv_file']);
										}
														
										$this->db->query("update ".$this->table_name." set cv_file='".$this->upload_file_name."' where candidate_id=".$this->input->post('candidate_id'));
									}
							}	
					
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
	function edit_course_list($level_study)
	{
		$query = $this->db->query('select distinct course_id, course_name from pms_courses where level_study='.$level_study.' order by course_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Course';
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
	function lead_source_list()
	{
		$query = $this->db->query('SELECT count(lead_source)as total_leads,lead_source FROM `pms_contact` group by lead_source ORDER BY lead_source ASC');
		$dropdowns = $query->result();
		$dropDownList['']='Lead Source';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->lead_source] = $dropdown->lead_source.'['.$dropdown->total_leads.']';
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
		$cur_year=date("Y");
		for($i=$cur_year;$i>=1970;$i--)
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
	
	
		 function insert_candidate_record(){
	 
	 $age='';
	 
	 if($this->input->post('date_of_birth')!='')$age = $this->get_age($this->input->post('date_of_birth'));
	
		$data =array(
			'username'=> $this->input->post('username'),
			'password'=> md5($this->input->post('password')),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'reg_date' => date("Y-m-d H:i:s"),
			'title' => $this->input->post('title'),
			'gender' => $this->input->post('gender') ,
			'marital_status' => $this->input->post('marital_status'),
			'marriage_date' => $this->input->post('marriage_date'),
			'engaged_date' => $this->input->post('engaged_date'),
			'mobile' => $this->input->post('mobile'),		
			'date_of_birth' => $this->input->post('date_of_birth'),
			'age' => $age,
			'children' => $this->input->post('children'),
			'course_id' => $this->input->post('course_id'),
			'branch_id' => $this->input->post('branch_id'),
			'lead_source' => $this->input->post('lead_source'),
			'reg_status' => $this->input->post('reg_status'),
			'lead_opportunity' => $this->input->post('lead_opportunity'),	
			'allow_mobile' => 1
		);
				
		$this->db->insert('pms_contact', $data);

        $id = $this->db->insert_id();
		$data =array(
			'candidate_id'=> $id,
			'admin_id'=> $_SESSION['admin_session'],
			'assigned_date'=> date('Y-m-d'),
		);
		$this->db->insert('pms_contact_counselor', $data);
		
		if($this->input->post('admin_id')!='' && $this->input->post('admin_id')!='0')
		{
			
			$this->db->where('admin_id',$this->input->post('admin_id'));
			$this->db->where('candidate_id',$id);
			$this->db->delete('pms_contact_counselor');
				$data =array(
					'candidate_id'=> $id,
					'admin_id'=> $this->input->post('admin_id'),
					'assigned_date'=> date('Y-m-d'),
				);
			$this->db->insert('pms_contact_counselor', $data);
		}
		return $id;
	}

	 function insert_candidate_record_scratch_pad(){
	 
	 $age='';
	 
	 if($this->input->post('date_of_birth')!='')$age = $this->get_age($this->input->post('date_of_birth'));
	
		$data =array(
			'username'=> $this->input->post('username'),
			'password'=> md5(date('Ymdhis')),
			'first_name' => $this->input->post('first_name'),
			'last_name' => '',
			'reg_date' => date("Y-m-d"),
			'title' => $this->input->post('title'),
			'gender' => $this->input->post('gender') ,
			'marital_status' => $this->input->post('marital_status'),
			'mobile' => $this->input->post('mobile'),		
			'date_of_birth' => $this->input->post('date_of_birth'),
			'age' => $age,
			'children' => $this->input->post('children'),
			'course_id' => $this->input->post('course_id'),
			'branch_id' => $this->input->post('branch_id'),
			'reg_status' => $this->input->post('reg_status'),
			'lead_opportunity' => $this->input->post('lead_opportunity'),
			'allow_mobile' => 1
		);
				
		$this->db->insert('pms_contact', $data);

        $id = $this->db->insert_id();
	
		$data =array(
			'candidate_id'=> $id,
			'admin_id'=> $_SESSION['admin_session'],
			'assigned_date'=> date('Y-m-d'),
		);
		$this->db->insert('pms_contact_counselor', $data);
		
		if($this->input->post('admin_id')!='' && $this->input->post('admin_id')!='0')
		{
			
			$this->db->where('admin_id',$this->input->post('admin_id'));
			$this->db->where('candidate_id',$id);
			$this->db->delete('pms_contact_counselor');
				$data =array(
					'candidate_id'=> $id,
					'admin_id'=> $this->input->post('admin_id'),
					'assigned_date'=> date('Y-m-d'),
				);
			$this->db->insert('pms_contact_counselor', $data);
		}
		return $id;
	}
		
	function GetAge($dob="1970-01-01") 
	{ 
			$dob=explode("-",$dob); 
			$curMonth = date("m");
			$curDay = date("j");
			$curYear = date("Y");
			$age = $curYear - $dob[0]; 
			if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2])) 
					$age--; 
			return $age; 
	}
	
	function insert_contact_detail_skip($candidateId){
		$data = array(
				'candidate_id' => $candidateId
				);
		$this->db->insert('pms_contact_address', $data);		
	}
	function insert_contact_detail($contactid){
		$data = array(
				'candidate_id' => $contactid,
				'address' => $this->input->post('address'),
				'mobile_prefix' => $this->input->post('mobile_prefix'),
				'land_prefix' => $this->input->post('land_prefix'),
				'land_phone' => $this->input->post('land_phone'),
				'work_prefix' => $this->input->post('work_prefix'),
				'workphone' => $this->input->post('workphone'),
				'fax_prefix'=> $this->input->post('fax_prefix'),
				'fax' => $this->input->post('fax'), 
				'location_id'=> $this->input->post('location_id'),
				'zipcode' => $this->input->post('zipcode')
		);
		$this->db->insert('pms_contact_address', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	function update_contact_detail($candidate_id){//updating while adding
		$data = array(
				'nationality'=> $this->input->post('nationality'),
				'state' => $this->input->post('state'),
				'city_id' => $this->input->post('city_id'),
				'current_location' => $this->input->post('current_location'),
				'religion_id' => $this->input->post('religion_id')
			    ); 	
		$this->db->where('candidate_id', $candidate_id);
		$this->db->update('pms_contact', $data); 
		return $this->db->affected_rows();
	}

	function get_passport_single_record($candidateId){
		$query=$this->db->query("select * from ".$this->table_name." where candidate_id=".$candidateId);
		return $query->row_array();
	}
	function edit_passport_detail($candidateId){
		$data = array(
				'passportno'=> $this->input->post('passportno'),
				'issued_date' => $this->input->post('issued_date'),
				'expiry_date' => $this->input->post('expiry_date'),
				'place_of_issue' => $this->input->post('place_of_issue'),
				'passport_nationality' => $this->input->post('passport_nationality'),
				'eng_pte' => $this->input->post('eng_pte'),
				'eng_pte_reading' => $this->input->post('eng_pte_reading'),
				'eng_pte_listening' => $this->input->post('eng_pte_listening'),
				'eng_pte_writing' => $this->input->post('eng_pte_writing'),
				'eng_pte_speaking' => $this->input->post('eng_pte_speaking'),				
				'eng_ielts' => $this->input->post('eng_ielts'),
				'eng_ielts_reading' => $this->input->post('eng_ielts_reading'),
				'eng_ielts_listening' => $this->input->post('eng_ielts_listening'),
				'eng_ielts_writing' => $this->input->post('eng_ielts_writing'),
				'eng_ielts_speaking' => $this->input->post('eng_ielts_speaking'),			
				'eng_tofel' => $this->input->post('eng_tofel'),
				'eng_tofel_reading' => $this->input->post('eng_tofel_reading'),
				'eng_tofel_listening' => $this->input->post('eng_tofel_listening'),
				'eng_tofel_writing' => $this->input->post('eng_tofel_writing'),
				'eng_tofel_speaking' => $this->input->post('eng_tofel_speaking'),	
				'eng_oet' => $this->input->post('eng_oet'),
				'eng_oet_reading' => $this->input->post('eng_oet_reading'),
				'eng_oet_listening' => $this->input->post('eng_oet_listening'),
				'eng_oet_writing' => $this->input->post('eng_oet_writing'),
				'eng_oet_speaking' => $this->input->post('eng_oet_speaking'),							
				'eng_gre' => $this->input->post('eng_gre'),
				'eng_gmat' => $this->input->post('eng_gmat'),
				'eng_sat' => $this->input->post('eng_sat'),
				'eng_10th' => $this->input->post('eng_10th'),
				'eng_12th' => $this->input->post('eng_12th'),
				'visa_start_date' => $this->input->post('visa_start_date'),
				'visa_end_date' => $this->input->post('visa_end_date'),
				'visa_nationality' => $this->input->post('visa_nationality'),
				'visa_type_id' => $this->input->post('visa_type_id'),
			    ); 	
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_contact', $data); 
	}
	
	function update_passport_detail($candidateId){//updating while adding
		$data = array(
				'passportno'=> $this->input->post('passportno'),
				'issued_date' => $this->input->post('issued_date'),
				'expiry_date' => $this->input->post('expiry_date'),
				'place_of_issue' => $this->input->post('place_of_issue'),
				'passport_nationality' => $this->input->post('passport_nationality'),
				'eng_pte' => $this->input->post('eng_pte'),
				'eng_pte_reading' => $this->input->post('eng_pte_reading'),
				'eng_pte_listening' => $this->input->post('eng_pte_listening'),
				'eng_pte_writing' => $this->input->post('eng_pte_writing'),
				'eng_pte_speaking' => $this->input->post('eng_pte_speaking'),				
				'eng_ielts' => $this->input->post('eng_ielts'),
				'eng_ielts_reading' => $this->input->post('eng_ielts_reading'),
				'eng_ielts_listening' => $this->input->post('eng_ielts_listening'),
				'eng_ielts_writing' => $this->input->post('eng_ielts_writing'),
				'eng_ielts_speaking' => $this->input->post('eng_ielts_speaking'),			
				'eng_tofel' => $this->input->post('eng_tofel'),
				'eng_tofel_reading' => $this->input->post('eng_tofel_reading'),
				'eng_tofel_listening' => $this->input->post('eng_tofel_listening'),
				'eng_tofel_writing' => $this->input->post('eng_tofel_writing'),
				'eng_tofel_speaking' => $this->input->post('eng_tofel_speaking'),
				'eng_oet' => $this->input->post('eng_oet'),
				'eng_oet_reading' => $this->input->post('eng_oet_reading'),
				'eng_oet_listening' => $this->input->post('eng_oet_listening'),
				'eng_oet_writing' => $this->input->post('eng_oet_writing'),
				'eng_oet_speaking' => $this->input->post('eng_oet_speaking'),								
				'eng_gre' => $this->input->post('eng_gre'),
				'eng_gmat' => $this->input->post('eng_gmat'),
				'eng_sat' => $this->input->post('eng_sat'),
				'eng_10th' => $this->input->post('eng_10th'),
				'eng_12th' => $this->input->post('eng_12th'),
				'visa_start_date' => $this->input->post('visa_start_date'),
				'visa_end_date' => $this->input->post('visa_end_date'),
				'visa_nationality' => $this->input->post('visa_nationality'),
				'visa_type_id' => $this->input->post('visa_type_id'),
			    ); 
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_contact', $data); 
		return $this->db->affected_rows();
	}
	
	function insert_education_detail_skip($candidateId)
	{
		$data = array(
				'candidate_id' => $candidateId,
				'level_id' => '',
				'course_id' => '',
				'spcl_id' => '',
				'univ_id' => '',
				'edu_year' => '',
				'edu_country' => '',
				'course_type_id' => '',
				'arrears' => '',
				'absesnse' => '',
				'repeat' => '',
				'year_back' => '',
				'mark_percentage' => '',
				'grade' => ''	
		);		
		$this->db->insert('pms_contact_education', $data);
		$id = $this->db->insert_id();
	}
	
	function insert_education_detail($candidateId){
		$data = array(
				'candidate_id' => $candidateId,
				'level_id' => $this->input->post('level_id'),
				'course_id' => $this->input->post('course_id'),
				'spcl_id' => $this->input->post('spcl_id'),
				'univ_id' => $this->input->post('univ_id'),
				'edu_year' => $this->input->post('edu_year'),
				'edu_country' => $this->input->post('edu_country'),
				'course_type_id' => $this->input->post('course_type_id'),
				'arrears' => $this->input->post('arrears'),
				'absesnse' => $this->input->post('absesnse'),
				'repeat' => $this->input->post('repeat'),
				'year_back' => $this->input->post('year_back'),
				'mark_percentage' => $this->input->post('mark_percentage'),
				'grade' => $this->input->post('grade'),
		);
		$this->db->insert('pms_contact_education', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	function insert_job_detail_skip($candidateId){
		$data = array(
				'candidate_id' => $candidateId
				);
		$this->db->insert('pms_contact_job_profile', $data);		
	}
	function insert_job_detail($candidateId){
		$data = array(
				'candidate_id' => $candidateId,
				'organization'=> $this->input->post('organization'),
				'designation' => $this->input->post('designation'),
				'job_cat_id'=> $this->input->post('job_cat_id'),
				'func_id' => $this->input->post('func_id'),
				'responsibility' => $this->input->post('responsibility'),
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'monthly_salary' => $this->input->post('monthly_salary'),
				'currency_id' => $this->input->post('currency_id'),
				'present_job' => $this->input->post('present_job'),
		);
		$this->db->insert('pms_contact_job_profile', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	function update_job_detail($candidateId){//updating while adding
		$data = array(
				'exp_years'=> $this->input->post('exp_years'),
				'exp_months' => $this->input->post('exp_months'),
				'skills' => $this->input->post('skills'),
			    ); 	
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_contact', $data); 
		return $this->db->affected_rows();
	}
	function update_candidate_record($candidateId){//edit profile
	
		 $age=$this->input->post('age');
		 
	 if($this->input->post('date_of_birth')!='') $age = $this->get_age($this->input->post('date_of_birth'));
	 
		$data =array(
			'username'=> $this->input->post('username'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'reg_date' => date("Y-m-d H:i:s"),
			'title' => $this->input->post('title'),
			'gender' => $this->input->post('gender') ,
			'marital_status' => $this->input->post('marital_status'),
			'marriage_date' => $this->input->post('marriage_date'),
			'engaged_date' => $this->input->post('engaged_date'),
			'mobile' => $this->input->post('mobile'),	
			'date_of_birth' => $this->input->post('date_of_birth'),
			'age' => $age,
			'children' => $this->input->post('children'),
			'course_id' => $this->input->post('course_id'),
			'branch_id' => $this->input->post('branch_id'),
			'lead_source' => $this->input->post('lead_source'),
			'reg_status' => $this->input->post('reg_status'),
			'lead_opportunity' => $this->input->post('lead_opportunity')			
		);
		$this->db->where('candidate_id',$candidateId);
		$this->db->update($this->table_name,$data);
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

	
	function get_address_single_record($candidateId){
		$query=$this->db->query("select * from pms_contact_address where candidate_id=".$candidateId);
		return $query->row_array();
	}
	function edit_contact_detail($candidateId){//edit profile
		$data = array(
				'candidate_id' => $candidateId,
				'address' => $this->input->post('address'),
				'mobile_prefix' => $this->input->post('mobile_prefix'),
				'land_prefix' => $this->input->post('land_prefix'),
				'land_phone' => $this->input->post('land_phone'),
				'work_prefix' => $this->input->post('work_prefix'),
				'workphone' => $this->input->post('workphone'),
				'fax_prefix'=> $this->input->post('fax_prefix'),
				'fax' => $this->input->post('fax'), 
				'zipcode' => $this->input->post('zipcode')
		);
		$this->db->where('candidate_id', $candidateId);
		$this->db->delete('pms_contact_address'); 
		$this->db->insert('pms_contact_address', $data); 
		
		$data1 = array(
				'nationality'=> $this->input->post('nationality'),
				'state' => $this->input->post('state'),
				'city_id' => $this->input->post('city_id'),
				'current_location' => $this->input->post('current_location'),
				'religion_id' => $this->input->post('religion_id')
			    ); 	
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_contact', $data1); 

	}
	
	function get_education_single_record($candidateId){
		$query=$this->db->query("select * from pms_contact_education where candidate_id=".$candidateId);
		return $query->row_array();
	}
	
	function edit_education_detail($candidateId){
		$data = array(
				'candidate_id' => $candidateId,
				'level_id' => $this->input->post('level_id'),
				'course_id' => $this->input->post('course_id'),
				'spcl_id' => $this->input->post('spcl_id'),
				'univ_id' => $this->input->post('univ_id'),
				'edu_year' => $this->input->post('edu_year'),
				'edu_country' => $this->input->post('edu_country'),
				'course_type_id' => $this->input->post('course_type_id'),
				'arrears' => $this->input->post('arrears'),
				'absesnse' => $this->input->post('absesnse'),
				'repeat' => $this->input->post('repeat'),
				'year_back' => $this->input->post('year_back'),
				'mark_percentage' => $this->input->post('mark_percentage'),
				'grade' => $this->input->post('grade'),
		);
		
		$this->db->where('candidate_id', $candidateId);
		$this->db->delete('pms_contact_education'); 
		$this->db->insert('pms_contact_education', $data); 
	}
	
	function get_job_single_record($candidateId){
		$query=$this->db->query("select a.*,b.exp_years,b.exp_months,b.skills from pms_contact_job_profile a left join pms_contact b on a.candidate_id=b.candidate_id where a.candidate_id=$candidateId");
		return $query->row_array();
	}
	
	function edit_job_detail($candidateId){//edit profile
		$data = array(
				'candidate_id' => $candidateId,
				'organization'=> $this->input->post('organization'),
				'designation' => $this->input->post('designation'),
				'job_cat_id'=> $this->input->post('job_cat_id'),
				'func_id' => $this->input->post('func_id'),
				'responsibility' => $this->input->post('responsibility'),
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'monthly_salary' => $this->input->post('monthly_salary'),
				'currency_id' => $this->input->post('currency_id'),
				'present_job' => $this->input->post('present_job'),
		);

		$this->db->where('candidate_id', $candidateId);
		$this->db->delete('pms_contact_job_profile'); 
		$this->db->insert('pms_contact_job_profile', $data); 
		
		$data1 = array(
				'exp_years'=> $this->input->post('exp_years'),
				'exp_months' => $this->input->post('exp_months'),
				'skills' => $this->input->post('skills'),
			    ); 
				
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_contact', $data1); 
		return $this->db->affected_rows();

	}

	function get_passport_details($candidateId){
		$query=$this->db->query("select * from ".$this->table_name." where candidate_id=".$candidateId);
		return $query->row_array();
	}
	
	function get_file_single_record($candidateId){
		$query=$this->db->query("select photo,cv_file from ".$this->table_name." where candidate_id=".$candidateId);
		return $query->row_array();
	}
	
	function get_single_record($candidateId){
	
		$query=$this->db->query("select a.*,b.level_study from ".$this->table_name." a left join pms_courses b on a.course_id=b.course_id where a.candidate_id=".$candidateId);
	
		return $query->row_array();
	}
	
	function insert_files($dataArr){
		$this->db->insert('pms_contact_files', $dataArr);
	}
	
	function update_files($dataArr){
		$query=$this->db->query("update pms_contact_files set file_name=".$dataArr['file_name']." where candidate_id=".$candidateId);
		
		$this->db->update('pms_contact_files', $dataArr);
	}
	
	function assign_admin_user($candidateId,$adminId){
		$query = $this->db->query("select id from pms_contact_counselor where admin_id=".$adminId." and candidate_id=".$candidateId);		
		if ($query->num_rows() == 0){

			$this->db->where('admin_id',$adminId);
			$this->db->where('candidate_id',$candidateId);
			$this->db->delete('pms_contact_counselor');
					
			$data = array(
				'admin_id' 		=> $adminId,
				'candidate_id'  => $candidateId,
				'assigned_date'=> date('Y-m-d'),
				);
		$this->db->insert('pms_contact_counselor', $data);
		//$id = $this->db->insert_id();
		return 1;
		}
		else{
			return 0;
		}
	}
	function getAdminEmail($adminId){
		$query = $this->db->query('select email,firstname from pms_admin_users where admin_id='.$adminId);
		return $query->row_array();
	}
	function get_admin_users_lists(){
	  $query = $this->db->query('select distinct admin_id, firstname, lastname from pms_admin_users order by firstname asc');
	  $dropdowns = $query->result();
	  $dropDownList[0]='Admin Users';
	  foreach($dropdowns as $dropdown)
	  {
		$dropDownList[$dropdown->admin_id] = $dropdown->firstname.' '.$dropdown->lastname;
	  }
	  $finalDropDown = $dropDownList;
	  return $finalDropDown;
 	}
}
?>