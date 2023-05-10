<?php
class Invoice_model extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = " pms_job_apps_invoice";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm,$status) 
	{

		$sql="SELECT count(*) as job_id FROM pms_jobs a INNER JOIN pms_job_apps b on b.job_id=a.job_id INNER JOIN pms_job_apps_placement c on c.app_id=b.job_app_id INNER JOIN pms_job_apps_invoice d on c.placement_id=d.placement_id INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id INNER JOIN pms_company f on a.company_id=f.company_id";
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and a.job_title like '%" . $searchterm . "%'";
			}
			else{
				$cond =" a.job_title like '%" . $searchterm . "%'";
			} 
		} 
		
		if($status!='') 
		{
			if($cond!=''){
				$cond.=" and d.invoice_status= '".$status."'  ";
			}
			else
			{
				$cond =" d.invoice_status= '".$status."' ";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		
		$row=$query->row_array();
		return $row['job_id'];
	
	}
	
	
	function get_list($start,$limit,$searchterm,$status,$sort_by)
	{
	
	$sql="SELECT a.job_title,a.job_id,a.company_id,b.job_app_id,d.invoice_id,d.invoice_date,d.invoice_status,d.invoice_amount,e.first_name,e.last_name,f.company_name FROM pms_jobs a INNER JOIN pms_job_apps b on b.job_id=a.job_id INNER JOIN pms_job_apps_placement c on c.app_id=b.job_app_id INNER JOIN pms_job_apps_invoice d on c.placement_id=d.placement_id INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id INNER JOIN pms_company f on a.company_id=f.company_id ";
		
		$cond='';
		if($searchterm!='')
		{
			if($cond!='')
			{
				$cond.=" and a.job_title like '%" . $searchterm . "%'";
			} 
			else
			{
				$cond="a.job_title like '%" . $searchterm . "%'";
			}  
		} 
		if($status!='') 
		{
			if($cond!=''){
				$cond.=" and d.invoice_status= '".$status."'  ";
			}
			else
			{
				$cond =" d.invoice_status= '".$status."' ";
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

	
}
