<?php 
class Candidates_intrw_summarymodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_candidate';
    }
	
	function record_count($search_name) 
	{
	
		$sql="SELECT count(b.candidate_id) as total_rec FROM pms_candidate a inner join pms_job_apps_shortlisted b on a.candidate_id=b.candidate_id ";	
		
		$cond = "";
		$cond =" b.candidate_id not in(select candidate_id from pms_job_apps_interviews ) ";
		
		
		if($search_name!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $search_name ."%' ";
			else
				$cond =" a.first_name like '%" . $search_name . "%' ";
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
	
	function get_list($start,$limit,$search_name,$sort_by)
	{
		
		$sql='SELECT a.candidate_id, a.first_name, a.last_name, b.short_date, c.applied_on ';
		
														
		$sql.=' FROM pms_candidate a inner join pms_job_apps_shortlisted b on a.candidate_id=b.candidate_id inner join pms_job_apps c on a.candidate_id=c.candidate_id ';	
		
		$cond = "";
		$cond =" b.candidate_id not in(select candidate_id from pms_job_apps_interviews) ";
		
	
		if($search_name!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $search_name ."%' ";
			else
				$cond =" a.first_name like '%" . $search_name . "%' ";
		}
		
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.candidate_id desc limit ".$start.",".$limit;

		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}

   

	
		
}
?>
