<?php 
class Candidates_rejectionmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_candidate';
    }
	
	
	
	
	function record_count($search_name) 
	{
	
		$sql="SELECT count(a.candidate_id) as total_rec FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id ";
		
		$cond = '';
		$cond = 'b.app_status_id=2';
		$cond.=' or b.app_status_id=5';
		$cond.=' or b.app_status_id=8';
		
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
		
		$sql='SELECT distinct a.candidate_id, a.first_name, a.last_name, b.app_status_id ';
		
				//$sql.=', (SELECT count(placement_id) FROM pms_job_apps_placement where app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_placed ';	
				
												
		$sql.=' FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id ';	
		
		$cond = "";
		$cond = 'b.app_status_id=2';
		$cond.=' or b.app_status_id=5';
		$cond.=' or b.app_status_id=8';	
		
	
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

   
