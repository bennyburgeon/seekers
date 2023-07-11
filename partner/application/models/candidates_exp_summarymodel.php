<?php 
class Candidates_exp_summarymodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_candidate';
    }
	
	function record_count($search_name) 
	{
	
		$sql="SELECT count(a.candidate_id) as total_rec FROM pms_candidate a  ";	
		
		$cond = "";
		$cond = " a.candidate_id not in(select candidate_id from pms_candidate_job_profile )";
		
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
		
		$sql='SELECT distinct a.candidate_id, a.first_name, a.last_name, a.reg_date, b.email_date ';
		
				$sql.=", (select DATEDIFF('".date('Y-m-d')."', b.email_date) as email_date_difference from pms_candidate_email je where je.candidate_id=a.candidate_id limit 0,1) as email_date_difference ";	
				
												
		$sql.=' FROM pms_candidate a left join pms_candidate_email b on a.candidate_id=b.candidate_id';	
		
		$cond = "";
		$cond = " a.candidate_id not in(select candidate_id from pms_candidate_job_profile )";
		
	
		if($search_name!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $search_name ."%' ";
			else
				$cond =" a.first_name like '%" . $search_name . "%' ";
		}
		
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.first_name asc limit ".$start.",".$limit;

		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}

   

	
		
}
?>
