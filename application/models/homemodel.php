<?php 
class Homemodel extends CI_Model {

	function __construct()
    {
		$this->table_name='pms_jobs';
    }
  
	function record_count($search_text,$func_id,$job_cat_id,$desig_id,$skill_id,$salary_id,$job_type_id,$level_id,$city_id,$total_exp_needed)
	
	{
		 $sql="select count(job_id)as total_jobs from pms_jobs a left join pms_job_category b on  a.job_cat_id= b.job_cat_id left join pms_company c on a.company_id=c.company_id left join pms_job_functional_area d on  d.func_id=a.func_id left join pms_education_level e on a.level_id=e.level_id left join pms_job_work_level f on a.work_level_id=f.work_level_id left join pms_country g on  a.country_id=g.country_id left join pms_job_salary h on  a.salary_id=h.salary_id left join pms_job_type j on a.job_type_id=j.job_type_id ";
	
		$cond = " a.job_status=1 ";	

		if($search_text!='')
		{
			if($cond!='')
			{
				$cond.=" and a.job_title like '%".$search_text."%'";
			} 
			else{
				$cond.=" a.job_title like '%".$search_text."%'";
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

		if($desig_id!='')
		{
			if($cond!=''){
				$cond.=" and a.desig_id=" . $desig_id;
			} 
			else{
				$cond=" a.desig_id=".$desig_id;
			}  
		} 

		if($skill_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_id in (select jk.job_id from pms_job_to_skill jk where jk.skill_id=" . $skill_id.") ";
			} 
			else{
				$cond=" a.desig_id=".$skill_id;
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

		if($total_exp_needed!='')
		{
			if($cond!=''){
				$cond.=" and a.total_exp_needed=" . $total_exp_needed;
			} 
			else{
				$cond=" a.total_exp_needed=".$total_exp_needed;
			}  
		}
	
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
	
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['total_jobs'];	
	}
	  
    function get_all_jobs($start,$limit,$sort_by,$search_text,$func_id,$job_cat_id,$desig_id,$skill_id,$salary_id,$job_type_id,$level_id,$city_id,$total_exp_needed)
    {
		$sql='select a.*, c.company_name, c.company_logo, c.contact_linkedin, d.func_area, b.job_cat_name , e.level_name, f.work_level, g.country_name, h.salary_desc, j.job_type_name,z.city_name,je.exp_range ';
		
		if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
		{
			$sql.=",(select jp.job_app_id from pms_job_apps jp where a.job_id=jp.job_id and jp.candidate_id=".$_SESSION['candidate_session']." limit 0,1 ) as job_applied ";
		}
		 
		 $sql.=" from pms_jobs a left join pms_job_category b on  a.job_cat_id= b.job_cat_id left join pms_company c on a.company_id=c.company_id left join pms_job_functional_area d on  d.func_id=a.func_id left join pms_education_level e on a.level_id=e.level_id left join pms_job_work_level f on a.work_level_id=f.work_level_id left join pms_country g on a.country_id=g.country_id left join pms_job_salary h on  a.salary_id=h.salary_id left join pms_job_type j on a.job_type_id=j.job_type_id left join pms_city z on a.job_location=z.city_id left join pms_job_experience je on a.total_exp_needed=je.exp_id ";
	
		$cond = " a.job_status=1 ";	

	if($search_text!='')
		{
			if($cond!='')
			{
				$cond.=" and a.job_title like '%".$search_text."%'";
			} 
			else{
				$cond.=" a.job_title like '%".$search_text."%'";
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

		if($desig_id!='')
		{
			if($cond!=''){
				$cond.=" and a.desig_id=" . $desig_id;
			} 
			else{
				$cond=" a.desig_id=".$desig_id;
			}  
		} 

		if($skill_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_id in (select jk.job_id from pms_job_to_skill jk where jk.skill_id=" . $skill_id.") ";
			} 
			else{
				$cond=" a.desig_id=".$skill_id;
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

		if($city_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_location=" . $city_id;
			} 
			else{
				$cond=" a.job_location=".$city_id;
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

		if($total_exp_needed!='')
		{
			if($cond!=''){
				$cond.=" and a.total_exp_needed=" . $total_exp_needed;
			} 
			else{
				$cond=" a.total_exp_needed=".$total_exp_needed;
			}  
		}
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		$sql.=" order by a.job_post_date ".$sort_by." limit ".$start.",".$limit;
		  
		$res=$this->db->query($sql);
		$newdata=array();
			if($res->num_rows()>0)
			{
				foreach($res->result_array() as $row)
				{
					$row['skill_list'][]=$this->get_all_skills($row['job_id']);
					$row['domains_list'][]=$this->get_all_domains($row['job_id']);
					$row['certifications_list'][]=$this->get_all_certifications($row['job_id']);					
					$newdata[]=$row;
				}
			}
		return $newdata;;
	}

function get_industry_menu_backup()
    {
		$sql="select job_cat_id, job_cat_name from pms_job_category where job_cat_id in (select job_cat_id from pms_job_functional_area) limit 0,6";
		  
		$res=$this->db->query($sql);
		$job_cat_list=array();
			if($res->num_rows()>0)
			{
				foreach($res->result_array() as $row)
				{
					$job_cat_list[]=array('job_cat_id' => $row['job_cat_id'], 'job_cat_name' => $row['job_cat_name'], 'func_list' => $this->get_functions($row['job_cat_id']));
				}
			}
		return $job_cat_list;
	}

function get_industry_menu()
    {
		$sql="select func_id, func_area from pms_job_functional_area where func_id in (select func_id from pms_designation_to_function) and  show_in_menu=1 order by func_area asc limit 0,6 ";
		  
		$res=$this->db->query($sql);
		$job_cat_list=array();
			if($res->num_rows()>0)
			{
				foreach($res->result_array() as $row)
				{
					$job_cat_list[]=array('func_id' => $row['func_id'], 'func_area' => $row['func_area'], 'desig_list' => $this->get_functions($row['func_id']));
				}
			}
		return $job_cat_list;
	}

	function get_functions($func_id)
	{
		$qry="SELECT * FROM pms_designation a inner join pms_designation_to_function b on a.desig_id=b.desig_id where b.func_id=".$func_id." limit 0,6";

		$res=$this->db->query($qry);
		$func_list=array();
		if($res->num_rows()>0)
		{
			foreach($res->result_array() as $row)
			{
				$func_list[]=array('desig_id' => $row['desig_id'] , 'desig_name' => $row['desig_name']);
			}
		}
		return $func_list;
	}

	function get_functions_backup($job_cat_id)
	{
		$qry="SELECT * FROM pms_job_functional_area where job_cat_id=".$job_cat_id." limit 0,5";
		$res=$this->db->query($qry);
		$func_list=array();
		if($res->num_rows()>0)
		{
			foreach($res->result_array() as $row)
			{
				$func_list[]=array('func_id' => $row['func_id'] , 'func_area' => $row['func_area']);
			}
		}
		return $func_list;
	}

	function get_functional_by_industry($job_cat_id='')
    {
		$query=$this->db->query("select distinct a.func_id, a.func_area from pms_job_functional_area a inner join pms_job_func_to_category b on a.func_id=b.func_id where b.job_cat_id=".$job_cat_id." order by a.func_area");
		$state_ist = $query->result();
		$dropDownList['']='Select Functional Area';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[" ".$dropdown->func_id] = $dropdown->func_area;
		}		
		return $dropDownList;
    }

function all_func_list()
	{
		$dropDownList=array();
		$finalDropDown =array();
		$dropDownList['']='Select Functional Area';
		$query = $this->db->query('select distinct func_id, func_area from pms_job_functional_area order by func_area asc');
		$dropdowns = $query->result();
		
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[" ".$dropdown->func_id] = $dropdown->func_area;
		}	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_designation_by_function($func_id='')
    {
		$query=$this->db->query("select distinct a.desig_id, a.desig_name from pms_designation a inner join pms_designation_to_function b on a.desig_id=b.desig_id where b.func_id=".$func_id." order by a.desig_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Designation';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[" ".$dropdown->desig_id] = $dropdown->desig_name;
		}		
		return $dropDownList;
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
		
	function get_skills_by_designation($desig_id='')
    {
		$query=$this->db->query("select skill_id,skill_name from pms_candidate_skills where desig_id=".$desig_id." order by skill_name asc");
		$state_ist = $query->result();
		$dropDownList['']='Select Skills';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[" ".$dropdown->skill_id] = $dropdown->skill_name;
		}		
		return $dropDownList;
    }

	function all_skills_list()
    {
		$query=$this->db->query("select skill_id,skill_name from pms_candidate_skills order by skill_name asc");
		$state_ist = $query->result();
		$dropDownList['']='Select Skills';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[" ".$dropdown->skill_id] = $dropdown->skill_name;
		}		
		return $dropDownList;
    }	
			

		
	function job_details_by_key($key)
	{
		$qry="select * from pms_jobs  where	md5(job_id)='".$key."'";		
		
		$res=$this->db->query($qry);
		return $res->row_array();		
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
		//$query = $this->db->query('select distinct func_id, func_area from pms_job_functional_area order by func_area asc');
		
		$query = $this->db->query('select distinct a.func_id, a.func_area from pms_job_functional_area a where a.func_id in (select func_id from pms_jobs where job_status=1) order by func_area asc');
		
		
		$dropdowns = $query->result();
		$dropDownList['']='Functional Area';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->func_id] = $dropdown->func_area;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function country_list()
	{
		$query = $this->db->query("select distinct a.country_id, a.country_name from pms_country a inner join pms_state b on a.country_id=b.country_id order by a.country_name asc");
		$dropdowns = $query->result();
		
		$dropDownList['']='Select Country';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function country_list_reg()
	{
		$query = $this->db->query("select distinct a.country_id, a.country_name from pms_country a  order by a.country_name asc");
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
			$dropDownList[" ".$dropdown->state_id] = $dropdown->state_name;
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
			$dropDownList[" ".$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
    }
	


	function experience_list()
	{
		$query = $this->db->query('select distinct exp_id, exp_range from pms_job_experience order by exp_id asc');
		$dropdowns = $query->result();
		$dropDownList['']='Experience Level';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->exp_id] = $dropdown->exp_range;
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

	function passport_nationality_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Passport Issued From';
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
		
       	$query=$this->db->query("select a.salary_id,a.salary_desc from pms_job_salary a order by a.salary_id asc");
		
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

		$qry='select a.*, c.company_name, c.company_logo, c.contact_linkedin, c.company_website, d.func_area, b.job_cat_name , e.level_name, f.work_level, g.country_name, h.salary_desc, j.job_type_name,z.city_name,je.exp_range ';
		
		if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
		{
			$qry.=",(select jp.job_app_id from pms_job_apps jp where a.job_id=jp.job_id and jp.candidate_id=".$_SESSION['candidate_session']." limit 0,1 ) as job_applied ";
		}
		 
		 $qry.=" from pms_jobs a left join pms_job_category b on  a.job_cat_id= b.job_cat_id left join pms_company c on a.company_id=c.company_id left join pms_job_functional_area d on  d.func_id=a.func_id left join pms_education_level e on a.level_id=e.level_id left join pms_job_work_level f on a.work_level_id=f.work_level_id left join pms_country g on a.country_id=g.country_id left join pms_job_salary h on  a.salary_id=h.salary_id left join pms_job_type j on a.job_type_id=j.job_type_id left join pms_city z on a.job_location=z.city_id left join pms_job_experience je on je.exp_id=a.total_exp_needed  where a.job_status=1 and md5(a.job_id)='".$id."'";
	
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
		$qry="select distinct pms_jobs.job_cat_id,pms_job_category.job_cat_name from pms_jobs join pms_job_category where pms_job_category.job_cat_id= pms_jobs.job_cat_id";
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
		$dropDownList['']='Select Education Level';
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
