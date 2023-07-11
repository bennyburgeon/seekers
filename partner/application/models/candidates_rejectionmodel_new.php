<?php 
class Candidates_rejectionmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_candidate';
    }
	function app_rej_count($app_rej_search) 
	{
	
		$sql="SELECT count(a.candidate_id) as total_rec FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id ";
		
		$cond = '';
		$cond = 'b.app_status_id=2';
		
		if($app_rej_search!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $app_rej_search ."%' ";
			else
				$cond =" a.first_name like '%" . $app_rej_search . "%' ";
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
	
	
	function int_rej_count($int_rej_search) 
	{
	
		$sql="SELECT count(a.candidate_id) as total_rec FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id ";
		
		$cond = '';
		$cond.=' b.app_status_id=5';
		
		if($int_rej_search!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $int_rej_search ."%' ";
			else
				$cond =" a.first_name like '%" . $int_rej_search . "%' ";
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
	
	
	function offer_rej_count($offer_rej_search) 
	{
	
		$sql="SELECT count(a.candidate_id) as total_rec FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id ";
		
		$cond = '';
		$cond.=' b.app_status_id=8';
		
		if($offer_rej_search!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $offer_rej_search ."%' ";
			else
				$cond =" a.first_name like '%" . $offer_rej_search . "%' ";
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
	
	
	
	
	function app_rej($start,$limit,$app_rej_search,$sort_by)
	{
		
		$sql='SELECT a.candidate_id, a.first_name, a.last_name, b.app_status_id ';
		
				//$sql.=', (SELECT count(placement_id) FROM pms_job_apps_placement where app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_placed ';	
				
												
		$sql.=' FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id ';	
		
		$cond = "";
		$cond = 'b.app_status_id=2';	
		
	
		if($app_rej_search!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $app_rej_search ."%' ";
			else
				$cond =" a.first_name like '%" . $app_rej_search . "%' ";
		}
		
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.candidate_id desc limit ".$start.",".$limit;

		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}
	
	function int_rej($start,$limit,$int_rej_search,$sort_by)
	{
		
		$sql='SELECT a.candidate_id, a.first_name, a.last_name, b.app_status_id ';
		
				//$sql.=', (SELECT count(placement_id) FROM pms_job_apps_placement where app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_placed ';	
				
												
		$sql.=' FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id ';	
		
		$cond = "";
		$cond = 'b.app_status_id=5';	
		
	
		if($int_rej_search!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $int_rej_search ."%' ";
			else
				$cond =" a.first_name like '%" . $int_rej_search . "%' ";
		}
		
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.candidate_id desc limit ".$start.",".$limit;

		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}
	
	function offer_rej($start,$limit,$offer_rej_search,$sort_by)
	{
		
		$sql='SELECT a.candidate_id, a.first_name, a.last_name, b.app_status_id ';
		
				//$sql.=', (SELECT count(placement_id) FROM pms_job_apps_placement where app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_placed ';	
				
												
		$sql.=' FROM pms_candidate a inner join pms_job_apps b on b.candidate_id=a.candidate_id ';	
		
		$cond = "";
		$cond.=' b.app_status_id=8';	
		
	
		if($offer_rej_search!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $offer_rej_search ."%' ";
			else
				$cond =" a.first_name like '%" . $offer_rej_search . "%' ";
		}
		
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.candidate_id desc limit ".$start.",".$limit;

		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}
	
	
	function candidates_rejection_summary()
	{
		$query=$this->db->query('select count(app_status_id) as total_count,(CASE WHEN app_status_id=2 THEN "Application Rejected" WHEN app_status_id=5 THEN "Interview Rejected" WHEN app_status_id=8 THEN "Offer Rejected" END)as status from pms_job_apps group by status');
		
			return $query->result_array();
	}
	
	
	}

   
