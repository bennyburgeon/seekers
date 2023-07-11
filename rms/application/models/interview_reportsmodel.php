<?php
class Interview_reportsmodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = " pms_candidate_interviews";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as interview_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" title like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['interview_id'];
	
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="SELECT a.*,b.interview_type,c.int_status_name FROM pms_candidate_interviews a LEFT JOIN pms_candidate_interview_types b on b.interview_type_id=a.interview_type_id LEFT JOIN  pms_candidate_interview_status c on c.int_status_id=a.int_status_id";
	$cond='';
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	} 
	else{
	$cond=" a.title like '%" . $searchterm . "%'";
	}  
	} 
	$cond="a.title like '%" . $searchterm . "%'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by a.interview_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}

	
}
?>