<?php 
class Contactmodel extends CI_Model 
{

	function __construct()
    {
		$this->table_name='pms_jobs';
    }

    function get_all_jobs()
    {
		$sql="select a.job_title, a.job_id, a.job_post_date, a.desired_profile, c.company_name, d.func_area, b.job_cat_name , e.level_name, f.work_level, g.country_name, h.salary_desc, j.job_type_name,z.city_name,je.exp_range from pms_jobs a left join pms_job_category b on  a.job_cat_id= b.job_cat_id left join pms_company c on a.company_id=c.company_id left join pms_job_functional_area d on  d.func_id=a.func_id left join pms_education_level e on a.level_id=e.level_id left join pms_job_work_level f on a.work_level_id=f.work_level_id left join pms_country g on a.country_id=g.country_id left join pms_job_salary h on  a.salary_id=h.salary_id left join pms_job_type j on a.job_type_id=j.job_type_id left join pms_city z on a.job_location=z.city_id left join pms_job_experience je on a.total_exp_needed=je.exp_id ";
	
		$sql.=" order by a.job_post_date desc limit 0,6";
		  
		$res=$this->db->query($sql);
		return $res->result_array();
	}
	
	function get_industry_menu()
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

	function get_functions($job_cat_id)
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

			
}
