<?php 
class Rpt_followupmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		
    }
	
	function get_status_list()
	{
		$sql="select * from pms_process_status";
		$cond='';
		if($cond!=''){
		//$cond.=" and candidate_id=".$candidateId;
		} 
		else{
			$cond=" status='1'";
		}  
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by status_order asc";
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}
	function follow_up_count() 
	{
		$sql	= "select count(*)as candidate_follow_id from pms_candidate_followup";
		$cond	= '';
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['candidate_follow_id'];
	}
	function course_count() 
	{
		$sql	= "select count(*)as course_id from pms_courses";
		$cond	= '';
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['course_id'];
	}
	function candidate_count(){
		$sql	= "select count(*)as candidate_id from pms_candidate";
		$cond	= '';
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['candidate_id'];
	}
	function application_count(){
		$sql	= "select count(*)as app_id from pms_candidate_applications";
		$cond	= '';
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['app_id'];
	}
	function get_interview_list(){
		$sql="select a.*,b.* from pms_candidate a inner join pms_candidate_interviews b ON a.candidate_id=b.candidate_id";
		$cond="b.interview_date >= DATE_ADD(CURDATE(), INTERVAL 1 DAY) ";
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by b.interview_date desc limit 5";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	function get_complaint_list(){
		$sql = "select a.candidate_id,a.first_name,a.last_name,b.ticket_id,b.ticket_title,c.ticket_status_name from pms_candidate a inner join pms_tickets b on a.candidate_id = b.candidate_id inner join pms_tickets_status c on b.ticket_status_id = c.ticket_status_id order by b.ticket_id desc limit 5";
		
		$query = $this->db->query($sql);
		return $query->result_array();

	}
}
?>	