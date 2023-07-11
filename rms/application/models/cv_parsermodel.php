<?php 

class Cv_parsermodel extends CI_Model {
	
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
    
	function __construct()
    {
		$this->table_name='pms_candidate';
    }

	function record_count($any_keywords,$all_keywords,$skills,$designation,$edu_level,$indsutry) 
	{
		$sql="select count(*) as total_rec  from pms_candidate a ";
		//echo $any_keywords;
		//exit();
		// any keywords - OR operation
		$cond='';
		$search_array=explode(',',trim($any_keywords));			
		if(is_array($search_array) && count($search_array)>0 && $any_keywords!='')
		{
			
			$search_criteria='';
			foreach($search_array as $key => $val)
			{
				if(substr($val,0,1)=='"' && substr(strrev($val),0,1)=='"')
				{
					$val=substr($val,1,strlen($val)-2);
					
					if($search_criteria!='')
						$search_criteria.=" or search_keywords like '%".trim($val)."%'";
					else
						$search_criteria.=" search_keywords like '%".trim($val)."%'";
				}

				//exit();
				$words_array=explode(' ',trim($val));	
				foreach($words_array as $word_key => $word_val)
				{
					if($search_criteria!='')
						$search_criteria.=" or search_keywords like '%".trim($word_val)."%'";
					else
						$search_criteria.=" search_keywords like '%".trim($word_val)."%'";
				}
			}

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
		}

		// any keywords - AND operation			
		$search_array=explode(',',trim($all_keywords));		
		if(is_array($search_array) && count($search_array)>0 && $all_keywords!='')
		{
			$cond='';	
			$search_criteria='';
			foreach($search_array as $key => $val)
			{
				if($search_criteria!='')
					$search_criteria.=" and search_keywords like '%".$val."%'";
				else
					$search_criteria.=" search_keywords like '%".$val."%'";
			}
			
			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
		}
		
		// criteria for skills
		if($skills!='')
		{
			$search_criteria='';
			$search_criteria.=" skill_id in (".$skills.")";

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_to_skills where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_to_skills where ".$search_criteria.") ";
		}

		// criteria for designation
		if($designation!='')
		{
			$search_criteria='';
			$search_criteria.=" desig_id in (".$designation.")";

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_to_designation where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_to_designation where ".$search_criteria.") ";
		}

		// criteria for industry 
		if($edu_level!='')
		{
			$search_criteria='';
			$search_criteria.=" level_id in (".$edu_level.")";

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_education where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_education where ".$search_criteria.") ";
		}
		
		// criteria for industry 
		if($indsutry!='')
		{
			$search_criteria='';
			$search_criteria.=" job_cat_id in (".$indsutry.")";

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_to_industry where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_to_industry where ".$search_criteria.") ";
		}
						
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		///echo $sql;
		//exit();
		$query = $this->db->query($sql);
		
		$row=$query->row_array();
		return $row['total_rec'];	
	}
	
	function get_list($start,$limit,$sort_by,$any_keywords,$all_keywords,$skills,$designation,$edu_level,$indsutry)
	{
	
		$sql="select a.*,(select flp.title from pms_candidate_followup flp where flp.candidate_id=a.candidate_id order by flp.candidate_follow_id desc limit 0,1)as fl_title,(select flp1.description from pms_candidate_followup flp1 where flp1.candidate_id=a.candidate_id order by flp1.candidate_follow_id desc limit 0,1)as fl_desc,(select count(flp2.candidate_follow_id) from pms_candidate_followup flp2 where flp2.candidate_id=a.candidate_id)as total_flp from pms_candidate a ";		
		
		$cond='';		
		$search_array=explode(',',trim($any_keywords));
		
		if(is_array($search_array) && count($search_array)>0 && $any_keywords!='')
		{			
			$search_criteria='';
			foreach($search_array as $key => $val)
			{
				if(substr($val,0,1)=='"' && substr(strrev($val),0,1)=='"')
				{
					$val=substr($val,1,strlen($val)-2);
					
					if($search_criteria!='')
						$search_criteria.=" or search_keywords like '%".trim($val)."%'";
					else
						$search_criteria.=" search_keywords like '%".trim($val)."%'";
				}

				//exit();
				$words_array=explode(' ',trim($val));	
				foreach($words_array as $word_key => $word_val)
				{
					if($search_criteria!='')
						$search_criteria.=" or search_keywords like '%".trim($word_val)."%'";
					else
						$search_criteria.=" search_keywords like '%".trim($word_val)."%'";
				}
			}

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
		}

				
		$search_array=explode(',',trim($all_keywords));
		
		if(is_array($search_array) && count($search_array)>0 && $all_keywords!='')
		{
			$cond='';
			$search_criteria='';
			foreach($search_array as $key => $val)
			{
				if($search_criteria!='')
					$search_criteria.=" and search_keywords like '%".$val."%'";
				else
					$search_criteria.=" search_keywords like '%".$val."%'";
			}
			
			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
		}
		
		// criteria for skills
		if($skills!='')
		{
			$search_criteria='';
			$search_criteria.=" skill_id in (".$skills.")";

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_to_skills where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_to_skills where ".$search_criteria.") ";
		}

		// criteria for designation
		if($designation!='')
		{
			$search_criteria='';
			$search_criteria.=" desig_id in (".$designation.")";

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_to_designation where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_to_designation where ".$search_criteria.") ";
		}

		// criteria for industry 
		if($edu_level!='')
		{
			$search_criteria='';
			$search_criteria.=" level_id in (".$edu_level.")";

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_education where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_education where ".$search_criteria.") ";
		}
		
		// criteria for industry 
		if($indsutry!='')
		{
			$search_criteria='';
			$search_criteria.=" job_cat_id in (".$indsutry.")";

			if($cond!='')
				$cond.=" and a.candidate_id in (select candidate_id from pms_candidate_to_industry where ".$search_criteria.") ";
			else
				$cond.=" a.candidate_id in (select candidate_id from pms_candidate_to_industry where ".$search_criteria.") ";
		}			
	
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.first_name ".$sort_by." limit ".$start.",".$limit;		
		//echo $sql;
//		exit();
		$query = $this->db->query($sql);
		
		$list=$query->result_array();
		
		$list=$this->get_skills_all($list);
		$list=$this->professional_list($list);
		$list=$this->last_job_app($list);
		//print_r($list);
		//exit();
		return $list;
	}

	function admin_list()
	{
		$data = array();
		$query=$this->db->query("select admin_id,username from pms_admin_users");
		$dropDownList = array();
		$dropDownList[0]='Select User';

		$admin_list = $query->result();
		
		foreach($admin_list as $dropdown)
		{
			$dropDownList[$dropdown->admin_id] = $dropdown->username;
		}
		
		return $dropDownList;
	}

	function add_follow_up()
	{
		$data=array(		
		'status_id'             => $this->input->post('cur_job_status'),
		'candidate_id'          => $this->input->post('candidate_id'),
		'title'                 => 'Candidate Call-' ,
		'description'           => $this->input->post('flp_notes'),
		'flp_date'              => $this->input->post('start_date'),
		'admin_id'              => $_SESSION['admin_session'],
		);
		$id=$this->db->insert('pms_candidate_followup', $data);
		return $id;
	}

	function add_task()
	{		
		$data = array(
				"task_title"          => $this->input->post("task_title"),
				"candidate_id"        => $this->input->post("candidate_id"),
				"start_date"          => date("Y-m-d ",strtotime($this->input->post("start_date"))),
				"due_date"            => $this->input->post("due_date"),
				"admin_id"            => $this->input->post("admin_id"),
				"task_priority_id"    => '1',
				"task_status_id"      => '1',
				"task_desc"           => $this->input->post("task_desc"),
				"status"              => 1				
				);
		$this->db->insert('pms_tasks',$data);
		$id = $this->db->insert_id();		
	}
		
  function get_skills_all($candidate_list)
   {

	if(count($candidate_list)==0)return $candidate_list;
	
	foreach($candidate_list as $key => $val)	   
	{
		$query = $this->db->query("SELECT a.skill_id, a.skill_name FROM pms_candidate_skills a inner join pms_candidate_to_skills b on a.skill_id=b.skill_id  where b.candidate_id=".$val['candidate_id']." ORDER BY a.skill_name ASC");
		
		$dropdowns = $query->result();
		$skills_list=array();
		
		foreach($dropdowns as $dropdown)
		{
			 $skills_list[] = $dropdown->skill_name;
		}
		$candidate_list[$key]['skill_set']=implode(',',$skills_list);
	}
	return $candidate_list;
   }

  function professional_list($candidate_list)
   {

	if(count($candidate_list)==0)return $candidate_list;
	
	foreach($candidate_list as $key => $val)	   
	{
		$query = $this->db->query("SELECT a.organization, a.designation,b.company_name FROM pms_candidate_job_profile a inner join pms_company b on a.company_id=b.company_id  where a.candidate_id=".$val['candidate_id']." ORDER BY b.company_name ASC");
		
		$dropdowns = $query->result();
		$job_profile=array();
		
		foreach($dropdowns as $dropdown)
		{
			 $job_profile[] = $dropdown->company_name;
		}
		$candidate_list[$key]['job_profile']=implode(',',$job_profile);
	}

	return $candidate_list;
   }

  function last_job_app($candidate_list)
   {

	if(count($candidate_list)==0)return $candidate_list;
	
	foreach($candidate_list as $key => $val)	   
	{
		$query = $this->db->query("SELECT a.job_id, a.job_title,b.applied_on FROM pms_jobs a inner join pms_job_apps b on a.job_id=b.job_id  where b.candidate_id=".$val['candidate_id']." ORDER BY a.job_title ASC");
		
		$dropdowns = $query->result();
		$job_apps=array();
		
		foreach($dropdowns as $dropdown)
		{
			 $job_apps[] = $dropdown->job_title;
		}
		$candidate_list[$key]['job_apps']=implode(',',$job_apps);
	}

	return $candidate_list;
   }
         
   
	function get_single_record($candidateId){
	
		$query=$this->db->query("select a.*,b.level_study from ".$this->table_name." a left join pms_courses b on a.course_id=b.course_id where a.candidate_id=".$candidateId);
		return $query->row_array();
	}

   function detail_list($candidate_id)
   {
   		$query = $this->db->query('select a.*,b.address,c.course_name from pms_candidate a left join pms_candidate_address b on a.candidate_id=b.candidate_id left join pms_courses c on a.course_id=c.course_id where a.candidate_id='.$candidate_id);
	return $query->row_array();
   }

	function candidate_languages($candidate_id)
    {
        $query=$this->db->query("SELECT a.lang_id,a.lang_name FROM `pms_languages` a inner join pms_cand_lang b on a.lang_id=b.lang_id where b.candidate_id=".$candidate_id." order by a.lang_name");
		return $query->result_array();
	}
	
   function education_deatils($candidate_id)
   {
   		$query = $this->db->query('select a.*,c.*,d.level_name from pms_candidate_education a inner join pms_candidate b on a.candidate_id=b.candidate_id left join pms_courses c on a.course_id=c.course_id left join pms_education_level d on a.level_id=d.level_id where a.candidate_id='.$candidate_id.' order by a.eucation_id');
		return $query->result_array();
   } 
	 function job_list($candidate_id)
    {
        $query=$this->db->query("select a.*,b.*,c.*,d.* from pms_candidate_job_profile a left join pms_job_category b on a.job_cat_id=b.job_cat_id left join pms_job_functional_area c on a.func_id=c.func_id left join pms_job_category d on a.job_cat_id=d.job_cat_id where a.candidate_id=".$candidate_id);
		return $query->result_array();
	}	

	 function all_counselor($candidate_id)
    {
		$query=$this->db->query("select admin_id, username, firstname from pms_admin_users where admin_id not in (select a.admin_id from pms_admin_users a inner join pms_admin_candidates b on a.admin_id=b.admin_id where b.candidate_id=".$candidate_id.") order by firstname");
		return $query->result_array();
	}	
	
	 function candidate_counselor($candidate_id)
    {
        $query=$this->db->query("select a.admin_id, a.username, a.firstname from pms_admin_users a inner join pms_admin_candidates b on a.admin_id=b.admin_id where b.candidate_id=".$candidate_id);
		return $query->result_array();
	}		


	 function candidate_skills($candidate_id)
    {
        $query=$this->db->query("SELECT a.skill_name,a.skill_id FROM `pms_candidate_skills` a inner join pms_candidate_to_skills b on a.skill_id=b.skill_id where b.candidate_id=".$candidate_id." order by a.skill_name asc");
		return $query->result_array();
	}

	
	 function candidate_certifications($candidate_id)
    {
        $query=$this->db->query("SELECT a.cert_name,a.cert_id FROM `pms_candidate_certification` a inner join pms_candidate_to_certification b on a.cert_id=b.cert_id where b.candidate_id=".$candidate_id." order by a.cert_name");
		return $query->result_array();
	}
 function candidate_programs_summary($candidate_id)
    {
        $query=$this->db->query("SELECT a.app_details,b.campus_name, c.univ_name, d.course_name,e.level_name FROM `pms_candidate_applications`  a inner join pms_campus b on a.campus_id=b.campus_id inner join pms_university c on c.univ_id=b.univ_id inner join pms_courses d on a.course_id=d.course_id inner join pms_education_level e on e.level_id=d.level_study where a.candidate_id=".$candidate_id);
		return $query->result_array();
	}

 function candidate_coe_summary($candidate_id)
    {
        $query=$this->db->query("SELECT a.*,b.campus_name, c.univ_name, d.course_name FROM `pms_candidate_applications`  a inner join pms_campus b on a.campus_id=b.campus_id inner join pms_university c on c.univ_id=b.univ_id inner join pms_courses d on a.course_id=d.course_id where a.app_status=1 and a.candidate_id=".$candidate_id);
		return $query->result_array();
	}

	 function candidate_visa_summary($candidate_id)
    {
        $query=$this->db->query("SELECT a.*,b.campus_name, c.univ_name, d.course_name,e.* FROM `pms_candidate_applications`  a inner join pms_campus b on a.campus_id=b.campus_id inner join pms_university c on c.univ_id=b.univ_id inner join pms_courses d on a.course_id=d.course_id inner join pms_candidate_visa_approval e on a.app_id=e.app_id where a.app_status=1 and a.candidate_id=".$candidate_id);
		return $query->result_array();
	}

function get_files($candidate_id){
		
		$query=$this->db->query("select * from pms_candidate_files where candidate_id=".$candidate_id);
		return $query->result_array();
   		
   }

	function job_search($candidate_id)
    {
        $query=$this->db->query("SELECT * FROM `pms_candidate_job_search` where candidate_id=".$candidate_id."");
		return $query->row_array();
	}

//GET ALL PARENT SKILL
   function get_skill_list()
   {
		$query = $this->db->query('SELECT a.skill_id, a.skill_name FROM pms_candidate_skills a where a.parent_skill<>0 ORDER BY a.skill_name ASC');
		
		$dropdowns = $query->result();
		$survey_result=array();
		foreach($dropdowns as $dropdown)
		{
			 $survey_result[$dropdown->skill_id] =$dropdown->skill_name;
		}
	
		return $survey_result;
   }
	

	function get_edu_level_list()
	{
		$query = $this->db->query('select distinct level_id, level_name from pms_education_level order by level_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Education Level';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->level_id] = $dropdown->level_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}


// geting  function by category
	function get_rps_data($rps_id='')
    {
        $query=$this->db->query("select * from pms_pdf_search where rps_id=".$rps_id);
		return $query->row_array();	
    }	
		
 function insert_candidate_record($data)
 {
	$age='';
	if($data['date_of_birth']!='')$age = $this->get_age($data['date_of_birth']);
	$this->db->insert('pms_candidate', $data);
	$id = $this->db->insert_id();
	return $id;
}

// add cv scraping text to personal record
function insert_profile_personal($candidate_d,$data,$cv_category_id)
{
	$this->db->where('candidate_id', $candidate_d);
	$this->db->where('cv_category_id', $cv_category_id);
	$this->db->delete('pms_candidate_cvfile');
			
	$this->db->insert('pms_candidate_cvfile', $data); 
}

function get_age($dob="1970-01-01") 
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

function insert_files($dataArr)
{
	$this->db->insert('pms_candidate_files', $dataArr);
}

//INSERT PRIMARY AND SECONDARY SKILLS
	function insert_skills($candidate_id,$skill_list)
	{ 
		if(is_array($skill_list) && count($skill_list)>0)
		{ 
			foreach($skill_list as $key => $val)
			{ 
				if($val!='')
				{
					$this->db->query("delete from pms_candidate_to_skills where skill_id=".$val." and candidate_id=".$candidate_id);	
					$data=array(
						'candidate_id'   =>$candidate_id,
						'skill_id'       =>$val
					);
					$this->db->insert('pms_candidate_to_skills',$data);
				}
			}
		}
		return $candidate_id;
	}		




// getting  industry
	function get_industry_list()
    {
        $query=$this->db->query("select * from pms_job_category order by job_cat_name asc");
		$industry_list = $query->result();
		
		foreach($industry_list as $dropdown)
		{
			$dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
		return $dropDownList;
    }	



// getting designation
	function get_designation_list()
    {
        $query=$this->db->query("select * from pms_designation order by desig_name asc");
		$desig_list = $query->result();
		
		foreach($desig_list as $dropdown)
		{
			$dropDownList[$dropdown->desig_id] = $dropdown->desig_name;
		}
		return $dropDownList;
    }	
		
}