<?php
class Aplication_reportsmodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = " pms_candidate_applications";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{
	
	$sql = "select count(*) as app_id from pms_candidate_applications a inner join pms_campus b on a.campus_id=b.campus_id";
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" b.univ_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['app_id'];
	
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="SELECT a.*,b.campus_name,c.course_name,d.status_name FROM pms_candidate_applications a LEFT JOIN pms_campus b on a.campus_id=b.campus_id LEFT JOIN  pms_courses c on c.course_id=a.course_id LEFT JOIN  pms_process_status d on d.status_id=a.process_status_id";
	$cond='';
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	} 
	else{
	$cond=" b.univ_name like '%" . $searchterm . "%'";
	}  
	} 
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by a.app_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}

	
}
?>