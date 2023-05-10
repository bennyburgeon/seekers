<?php
class Coursereport_model extends CI_Model {
	function Mailbox_model() {
		parent::__construct();		
	}
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as course_id from pms_courses a inner join pms_course_uni b on a.course_id = b.course_id inner join pms_university c on b.univ_id = c.univ_id";
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" a.course_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['course_id'];
		
		
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
	
		
		
		
		$sql="select a.*,c.univ_name from pms_courses a inner join pms_course_uni b on a.course_id = b.course_id inner join pms_university c on b.univ_id = c.univ_id";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" a.course_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by a.course_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
}	
?>	

	