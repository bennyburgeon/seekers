<?php
class Complaintreport_model extends CI_Model {
	function Mailbox_model() {
		parent::__construct();		
	}
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*) as ticket_id from pms_tickets a inner join pms_tickets_status b on a.ticket_status_id = b.ticket_status_id inner join pms_tickets_priority c on a.ticket_priority_id = c.ticket_priority_id";
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" a.ticket_title like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['ticket_id'];
		
		
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
	
		
		
		$sql="select a.*,b.ticket_status_name,c.ticket_priority_name from pms_tickets a inner join pms_tickets_status b on a.ticket_status_id = b.ticket_status_id inner join pms_tickets_priority c on a.ticket_priority_id = c.ticket_priority_id";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" a.ticket_title like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by a.ticket_title ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
}	
?>	

	