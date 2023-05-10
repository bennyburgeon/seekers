<?php
class Uploadfile_reportsmodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = " pms_candidate_files";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{
	
	$sql = "select count(*) as file_id from pms_candidate_files";
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" file_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['file_id'];
	
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="SELECT * from pms_candidate_files";
	$cond='';
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	} 
	else{
	$cond=" file_name like '%" . $searchterm . "%'";
	}  
	} 
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by file_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}

	
}
?>
