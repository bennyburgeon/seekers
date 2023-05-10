<?php
class Reports_followupmodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = "pms_candidate_followup";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{
	
	$sql="select count(*)as candidate_follow_id from pms_candidate_followup a LEFT JOIN pms_candidate b on a.candidate_id=b.candidate_id LEFT join pms_candidate_applications c on a.app_id=c.app_id  ";
	
	$cond = '';
	
	if($searchterm!='')
	{
		if($cond!=''){
			$cond .=" and a.title like '%" . $searchterm . "%'";
		}
		else{
			$cond =" a.title like '%" . $searchterm . "%'";
		} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['candidate_follow_id'];
	
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
		$sql="select a.*,b.*,c.* from pms_candidate_followup a LEFT JOIN pms_candidate b on a.candidate_id=b.candidate_id LEFT join pms_candidate_applications c on a.app_id=c.app_id  ";
		$cond='';

	if($searchterm!='')
	{
		if($cond!=''){
			$cond .=" and a.title like '%" . $searchterm . "%'";
		}
		else{
			$cond =" a.title like '%" . $searchterm . "%'";
		} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by a.candidate_follow_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}

	
}
?>