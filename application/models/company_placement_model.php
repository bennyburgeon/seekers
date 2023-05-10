<?php
class Company_placement_model extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = " pms_job_apps_placement";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{

		$sql="SELECT count(*) as job_id FROM pms_jobs a INNER JOIN pms_job_apps b on b.job_id=a.job_id INNER JOIN pms_job_apps_placement c on c.app_id=b.job_app_id  INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id INNER JOIN pms_company f on a.company_id=f.company_id";
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" f.company_id =". $searchterm ;
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		
		$row=$query->row_array();
		return $row['job_id'];
	
	}
	
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="SELECT a.job_title,a.job_id,a.company_id,b.job_app_id,c.offer_accepted_date,c.join_date,e.first_name,e.last_name,f.company_name FROM pms_jobs a INNER JOIN pms_job_apps b on b.job_id=a.job_id INNER JOIN pms_job_apps_placement c on c.app_id=b.job_app_id  INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id INNER JOIN pms_company f on a.company_id=f.company_id ";
		
		$cond='';
		if($searchterm!='')
		{
			if($cond!='')
			{
				//$cond.=" and candidate_id=".$candidateId;
			} 
			else
			{
				$cond =" f.company_id =". $searchterm ;
			}  
		} 
		//$cond="a.job_title like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by a.job_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	function get_all_company()
	{
		$query=$this->db->query("select company_id,company_name from pms_company order by company_name asc");
		$dropdowns = $query->result();
		$dropDownList['0']='Select Company for Search';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	
}
