<?php 
class Aboutusmodel extends CI_Model {

	function __construct()
    {
		$this->table_name='pms_jobs';
    }

	function record_count($search_text,$salary_id,$skill_id,$job_type_id,$level_id,$func_id,$job_cat_id,$city_id)
	{
		 $sql="select count(job_id)as total_jobs from pms_jobs a left join pms_job_category b on  a.job_cat_id= b.job_cat_id left join pms_company c on a.company_id=c.company_id left join pms_job_functional_area d on  d.func_id=a.func_id left join pms_education_level e on a.level_id=e.level_id left join pms_job_work_level f on a.work_level_id=f.work_level_id left join pms_country g on  a.country_id=g.country_id left join pms_job_salary h on  a.salary_id=h.salary_id left join pms_job_type j on a.job_type_id=j.job_type_id ";
	
		$cond = " a.job_status=1 ";	

	if($search_text!='')
		{
			if($cond!='')
			{
				$cond.=" and concat(job_title,job_desc,desired_profile,job_keywords) like '%".$search_text."%'";
			} 
			else{
				$cond.=" concat(job_title,job_desc,desired_profile,job_keywords) like '%".$search_text."%'";
			}  
		} 

		if($job_cat_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_cat_id=" . $job_cat_id;
			} 
			else{
				$cond=" a.job_cat_id=".$job_cat_id;
			}  
		} 

		if($func_id!='')
		{
			if($cond!=''){
				$cond.=" and a.func_id=" . $func_id;
			} 
			else{
				$cond=" a.func_id=".$func_id;
			}  
		} 

		if($level_id !='')
		{
			if($cond!=''){
				$cond.=" and a.level_id=" . $level_id;
			} 
			else{
				$cond=" a.level_id=".$level_id;
			}  
		}
				
		if($job_type_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_type_id=" . $job_type_id;
			} 
			else{
				$cond=" a.job_type_id=".$job_type_id;
			}  
		}
	
		if($salary_id!='')
		{
			if($cond!=''){
				$cond.=" and a.salary_id=" . $salary_id;
			} 
			else{
				$cond=" a.salary_id=".$salary_id;
			}  
		}

		if($salary_id!='')
		{
			if($cond!=''){
				$cond.=" and a.salary_id=" . $salary_id;
			} 
			else{
				$cond=" a.salary_id=".$salary_id;
			}  
		}

	
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
	
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['total_jobs'];	
	}
	
	function get_list($start,$limit,$sort_by,$search_text,$salary_id,$skill_id,$job_type_id,$level_id,$func_id,$job_cat_id,$city_id)
	{
		$sql="select a.* from pms_jobs a ";	
		$cond = " a.job_status=1 ";	
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.job_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);

		return $query->result_array();	
	}

	function industries_list()
	{
		$query = $this->db->query('select distinct a.job_cat_id, a.job_cat_name from pms_job_category a where a.job_cat_id in (select job_cat_id from pms_jobs where job_status=1) order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Industry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function functional_list()
	{
		//$query = $this->db->query('select distinct func_id, func_area from pms_job_functional_area order by func_area asc');
		
		$query = $this->db->query('select distinct a.func_id, a.func_area from pms_job_functional_area a where a.func_id in (select func_id from pms_jobs where job_status=1) order by func_area asc');
		
		
		$dropdowns = $query->result();
		$dropDownList[0]='Select Role';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->func_id] = $dropdown->func_area;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function nationality_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='What is your Nationality?';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function current_nationality_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Where are you Currently Located?';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}			

	function visa_issued_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='VISA Issued From';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function city_list()
    {
		$dropDownList=array();
		$dropDownList['']='Select City';
		
       	$query=$this->db->query("select a.city_id,a.city_name from pms_city a order by a.city_name");
		
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
    }	

	function salary_list()
    {
		$dropDownList=array();
		
       	$query=$this->db->query("select a.salary_id,a.salary_desc from pms_job_salary a order by a.salary_amount");
		
		$state_ist = $query->result();
		$dropDownList['']='Select Salary';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->salary_id] = $dropdown->salary_desc;
		}
		return $dropDownList;
    }
					
	function get_all_skills($job_id)
	{
		$qry="SELECT a.skill_name FROM `pms_candidate_skills` a INNER JOIN pms_job_to_skill b ON a.skill_id=b.skill_id where b.job_id=".$job_id;
		$res=$this->db->query($qry);
		$skills=array();
		if($res->num_rows()>0)
		{
			foreach($res->result_array() as $row)
			{
				$skills[]=$row['skill_name'];
			}
		}
		return $skills;
	}

	function get_all_domains($job_id)
	{
		$qry="SELECT a.domain_name FROM `pms_candidate_domain` a INNER JOIN pms_job_to_domain b ON a.domain_id=b.domain_id where b.job_id=".$job_id;
		$res=$this->db->query($qry);
		$domains=array();
		if($res->num_rows()>0)
		{
			foreach($res->result_array() as $row)
			{
				$domains[]=$row['domain_name'];
			}
		}
		return $domains;
	}

	function get_all_certifications($job_id)
	{
		$qry="SELECT a.cert_name FROM `pms_candidate_certification` a INNER JOIN pms_job_to_certification b ON a.cert_id=b.cert_id where b.job_id=".$job_id;
		$res=$this->db->query($qry);
		$certs=array();
		if($res->num_rows()>0)
		{
			foreach($res->result_array() as $row)
			{
				$certs[]=$row['cert_name'];
			}
		}
		return $certs;
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

	function insert_candidate_from_jobs($data)
	 {

			$this->db->insert('pms_candidate', $data);
			$id = $this->db->insert_id();
			return $id;
		}

 	function insert_candidate_from_linkedin($data)
 	{
		$this->db->insert('pms_candidate', $data);
        $id = $this->db->insert_id();
		return $id;
	}

	function insert_files($dataArr)
	{
			$this->db->insert('pms_candidate_files', $dataArr);
			$id=$this->db->insert_id();
			return $id;
	}

    function country_intl_code()
    {

		$query=$this->db->query("select a.* from pms_country a where a.intl_dial_prefix <> '' and a.intl_code <>'' order by a.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Country Code';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->intl_dial_prefix.' '.$dropdown->intl_code;
		}
		return $dropDownList;
    }

	function visa_type_list()
	{
		$query = $this->db->query('select visa_type_id,visa_type from pms_job_visa_type order by visa_type asc');
		$dropdowns = $query->result();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->visa_type_id] = $dropdown->visa_type;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function edu_spec_list()
	{
		$query = $this->db->query('select distinct spcl_id, spcl_name from pms_specialisation order by spcl_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Specilization';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->spcl_id] = $dropdown->spcl_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
			
			
}
