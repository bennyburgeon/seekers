<?php 
class Shortlist_summary_model extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_candidate';
    }
	
	function record_count($search_name,$shortlist_status) 
	{
	
		$sql="SELECT count(b.candidate_id) as total_rec FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id left join pms_job_apps_shortlisted c on b.job_app_id=c.app_id inner join pms_jobs d on b.job_id=d.job_id";
		
		$cond = '';
		
		if($search_name!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $search_name ."%' ";
			else
				$cond =" a.first_name like '%" . $search_name . "%' ";
		}
		
		if($shortlist_status==1)
		{
			if($cond!='')
			$cond.=" and b.job_app_id in (select app_id from pms_job_apps_shortlisted ) ";
			else
				$cond.=" b.job_app_id in (select app_id from pms_job_apps_shortlisted ) ";
		}
		
		if($shortlist_status==2)
		{
			if($cond!='')
			$cond.=" and b.job_app_id not in (select app_id from pms_job_apps_shortlisted ) ";
			else
				$cond.=" b.job_app_id not in (select app_id from pms_job_apps_shortlisted ) ";
		}
		
		

		if($cond!='') $cond=' where '.$cond;
			
		$sql=$sql.$cond;
		$query = $this->db->query($sql);
		//echo $sql; exit();
		if($query->num_rows()>0)
		{
			$list=$query->row_array();
			return $list['total_rec'];
		}else{
			return '0';
		}
	}
	
	function get_list($start,$limit,$search_name,$sort_by,$shortlist_status)
	{
		
		$sql='SELECT a.candidate_id, a.first_name, a.last_name, b.applied_on, c.short_date, d.job_title';
		
				$sql.=", (select DATEDIFF('".date('Y-m-d')."', b.applied_on) as date_difference from pms_job_apps ja where ja.candidate_id=a.candidate_id limit 0,1) as date_difference ";	
				
												
		$sql.=' FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id left join pms_job_apps_shortlisted c on b.job_app_id=c.app_id inner join pms_jobs d on b.job_id=d.job_id';	
		
		$cond = "";
		
		if($search_name!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $search_name ."%' ";
			else
				$cond =" a.first_name like '%" . $search_name . "%' ";
		}
		
		
		if($shortlist_status==1)
		{
			if($cond!='')
			$cond.=" and b.job_app_id in (select app_id from pms_job_apps_shortlisted ) ";
			else
				$cond.=" b.job_app_id in (select app_id from pms_job_apps_shortlisted ) ";
		}
		
		if($shortlist_status==2)
		{
			if($cond!='')
			$cond.=" and b.job_app_id not in (select app_id from pms_job_apps_shortlisted ) ";
			else
				$cond.=" b.job_app_id not in (select app_id from pms_job_apps_shortlisted ) ";
		}
		
		
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by b.applied_on desc limit ".$start.",".$limit;

		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}

   

	
		
}
?>
