<?php 
class Signupmodel extends CI_Model {

	function __construct()
    {
		$this->table_name='pms_jobs';
    }
    
    function get_all_jobs($start,$limit,$sort_by,$search_text,$salary_id,$skill_id,$job_type_id,$level_id,$func_id,$job_cat_id,$city_id)
    {
		 $sql="select a.*, c.company_name, d.func_area, b.job_cat_name , e.level_name, f.work_level, g.country_name, h.salary_desc, j.job_type_name from pms_jobs a left join pms_job_category b on  a.job_cat_id= b.job_cat_id left join pms_company c on a.company_id=c.company_id left join pms_job_functional_area d on  d.func_id=a.func_id left join pms_education_level e on a.level_id=e.level_id left join pms_job_work_level f on a.work_level_id=f.work_level_id left join pms_country g on  a.country_id=g.country_id left join pms_job_salary h on  a.salary_id=h.salary_id left join pms_job_type j on a.job_type_id=j.job_type_id ";
	
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
		$sql.=" order by a.job_id ".$sort_by." limit ".$start.",".$limit;
		  
		$res=$this->db->query($sql);
		
			if($res->num_rows()>0)
			{
				foreach($res->result_array() as $row)
				{
					$row['skill_list'][]=$this->get_all_skills($row['job_id']);
					$row['domains_list'][]=$this->get_all_domains($row['job_id']);
					$row['certifications_list'][]=$this->get_all_certifications($row['job_id']);
					
					$newdata[]=$row;
				}
			return $newdata;
			}
		return false;
	}

	function industries_list()
	{
		$query = $this->db->query('select distinct a.job_cat_id, a.job_cat_name from pms_job_category a order by a.job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Industry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
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

		
	function job_details_by_key($key)
	{
		$qry="select * from pms_jobs  where	md5(job_id)='".$key."'";		
		
		$res=$this->db->query($qry);
		return $res->row_array();		
	}

	function industry_list()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
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

	function nationality_list()
	{
		$query = $this->db->query('select distinct a.country_id, b.country_name from pms_country a inner join pms_country_description b on a.country_id=b.country_id order by b.country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='What is your Nationality?';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function all_designation_list()
    {
		$query=$this->db->query("select distinct desig_id, desig_name from pms_designation order by desig_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Designation';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[" ".$dropdown->desig_id] = $dropdown->desig_name;
		}		
		return $dropDownList;
    }
	
	function current_nationality_list()
	{
		$query = $this->db->query('select distinct a.country_id, b.country_name from pms_country a inner join pms_country_description b on a.country_id=b.country_id order by b.country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Where are you Currently Located?';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}			

	function passport_nationality_list()
	{
		$query = $this->db->query('select distinct a.country_id, b.country_name from pms_country a inner join pms_country_description b on a.country_id=b.country_id order by b.country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Passport Issued From';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function country_list_reg()
	{
		$query = $this->db->query("select distinct a.country_id, b.country_name from pms_country a inner join pms_country_description b on a.country_id=b.country_id order by b.country_name asc");
		$dropdowns = $query->result();
		
		$dropDownList['']='Select Country';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
function country_list()
	{
		$query = $this->db->query("select distinct a.country_id, concat(a.country_name,' [+ ',intl_dial_prefix,' ',intl_code,']')as country_name from pms_country a inner join pms_state b on a.country_id=b.country_id order by country_name asc");
		$dropdowns = $query->result();
		
		$dropDownList[0]='Select Country';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
  function state_list_by_city($country_id='')
    {
		if($country_id !='')
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_city b ON a.state_id=b.state_id where a.country_id=".$country_id." order by a.state_name");
		else
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_city b ON a.state_id=b.state_id order by a.state_name");
					
		$state_ist = $query->result();
		
		
		$dropDownList['']='Select State';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->state_id] = $dropdown->state_name;
		}
		
		return $dropDownList;
    }	

	function city_list_by_state($state_id='')
    {
		$dropDownList=array();
		$dropDownList['0']='Select City';
		
		if($state_id=='')
			return $dropDownList;
		else
	       	$query=$this->db->query("SELECT a . * , b . * FROM pms_city a INNER JOIN pms_city_description b ON a.city_id= b.city_id where a.state_id=".$state_id." order by b.city_name");	
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
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

	function license_issued_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='License Issued From';
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
					
	function job_details_by_id($id)
	{
		$qry="select pms_jobs.*,
		 pms_company.company_name, 
		 pms_job_functional_area.func_area,
		 pms_job_category.job_cat_name ,
		 pms_education_level.level_name,
		 pms_job_work_level.work_level,
		 pms_country.country_name,
		  pms_job_salary.salary_desc,
		 pms_job_type.job_type_name,
		 pms_candidate_skills.skill_name
		 from pms_jobs left join pms_job_category on  pms_job_category.job_cat_id= pms_jobs.job_cat_id
		 left join pms_company on pms_jobs.company_id=pms_company.company_id 
		 left join pms_job_functional_area on  pms_job_functional_area.func_id=pms_jobs.func_id
		 left join pms_education_level  on 	pms_jobs.level_id=pms_education_level.level_id
		 left join pms_job_work_level on   pms_jobs.work_level_id=pms_job_work_level.work_level_id
		 left join pms_country on  pms_jobs.country_id=pms_country.country_id
		 left join pms_job_type on   pms_jobs.job_type_id=pms_job_type.job_type_id 
		  left join pms_job_salary on  pms_jobs.salary_id=pms_job_salary.salary_id
		 left join pms_candidate_skills on  pms_jobs.job_skills = pms_candidate_skills.skill_id
		  where
		  md5(pms_jobs.job_id)='".$id."'";		

		$res=$this->db->query($qry);
		if($res->num_rows()>0)
		{
			$newdata=$res->row_array();
			return $newdata;
		}
		return false;		
	}
	

	function get_all_jobs_company($id)
    {
		$qry="select pms_jobs.*,
		 pms_company.company_name, 
		 pms_job_functional_area.func_area,
		 pms_job_category.job_cat_name ,
		 pms_education_level.level_name,
		 pms_job_work_level.work_level,
		 pms_country.country_name,
		 pms_job_type.job_type_name
		 from pms_jobs left join pms_job_category on  pms_job_category.job_cat_id= pms_jobs.job_cat_id
		 left join pms_company on pms_jobs.company_id=pms_company.company_id 
		 left join pms_job_functional_area on  pms_job_functional_area.func_id=pms_jobs.func_id
		 left join pms_education_level  on 	pms_jobs.level_id=pms_education_level.level_id
		 left join pms_job_work_level on   pms_jobs.work_level_id=pms_job_work_level.work_level_id
		 left join pms_country on  pms_jobs.country_id=pms_country.country_id
		 left join  pms_job_type on   pms_jobs.job_type_id=pms_job_type.job_type_id 
		  where pms_jobs.company_id=$id";
		  
		$res=$this->db->query($qry);
			if($res->num_rows()>0)
			{
				
				foreach($res->result() as $row)
				{
					$newdata[]=$row;
					
				}
				
				
				return $newdata;
			}
		return false;
	}

	function get_all_jobs_country($id)
    {
		 $qry="select pms_jobs.*,
		 pms_company.company_name, 
		 pms_job_functional_area.func_area,
		 pms_job_category.job_cat_name ,
		 pms_education_level.level_name,
		 pms_job_work_level.work_level,
		 pms_country.country_name,
		 pms_job_type.job_type_name
		 from pms_jobs left join pms_job_category on  pms_job_category.job_cat_id= pms_jobs.job_cat_id
		 left join pms_company on pms_jobs.company_id=pms_company.company_id 
		 left join pms_job_functional_area on  pms_job_functional_area.func_id=pms_jobs.func_id
		 left join pms_education_level  on 	pms_jobs.level_id=pms_education_level.level_id
		 left join pms_job_work_level on   pms_jobs.work_level_id=pms_job_work_level.work_level_id
		 left join pms_country on  pms_jobs.country_id=pms_country.country_id
		 left join  pms_job_type on   pms_jobs.job_type_id=pms_job_type.job_type_id 
		  where
		  pms_jobs.country_id=$id";
		  
		$res=$this->db->query($qry);
			if($res->num_rows()>0)
			{
				
				foreach($res->result() as $row)
				{
					$newdata[]=$row;
					
				}
				
				
				return $newdata;
			}
		return false;
	}

	
	function get_jobs_industry()
	{
		$qry="select distinct job_cat_id,job_cat_name from pms_job_category order by job_cat_name ";
		$res=$this->db->query($qry);
		//$res=$this->db->get($this->table_name);
			if($res->num_rows()>0)
			{
				foreach($res->result() as $row)
				{
					$newdata[]=$row;
					
				}
				
				return $newdata;
			}
		return false;
		
	}
	function get_jobs_country()
	{
		$qry="select distinct pms_jobs.country_id,pms_country.country_name from pms_jobs join pms_country where pms_country.country_id= pms_jobs.country_id";
		$res=$this->db->query($qry);
		//$res=$this->db->get($this->table_name);
			if($res->num_rows()>0)
			{
				foreach($res->result() as $row)
				{
					$newdata[]=$row;
					
				}
				
				return $newdata;
			}
		return false;
		
	}
	function get_jobs_company()
	{
		$qry="select distinct pms_jobs.company_id,pms_company.company_name from pms_jobs join pms_company where pms_company.company_id= pms_jobs.company_id";
		$res=$this->db->query($qry);
		//$res=$this->db->get($this->table_name);
			if($res->num_rows()>0)
			{
				foreach($res->result() as $row)
				{
					$newdata[]=$row;
					
				}
				
				return $newdata;
			}
		return false;
		
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

	function cur_job_status_list()
	{
		$query = $this->db->query('select cur_job_status, cur_job_status_name from pms_cur_job_status order by cur_job_status asc');
		$dropdowns = $query->result();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->cur_job_status] = $dropdown->cur_job_status_name;
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
