<?php 
class Notificationsmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_candidate_messages';
    }
    
function insert_record()
    {
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d H:i:s');
		
		$data=array(
		'message_text'    =>$this->input->post('message_text'),	
		'user_id'      => $_SESSION['candidate_session'],	
		'not_text'     =>$this->input->post('not_text'),
		"start_date"   => date("Y-m-d ",strtotime($this->input->post("start_date"))),
		"due_date"     =>date("Y-m-d ",strtotime($this->input->post("due_date"))),
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		return $id;
    }

	
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as not_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" message_text like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['not_id'];
	
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$query=$this->db->query("SELECT a.*,b.first_name,c.firstname as recruiter,c.admin_id FROM pms_candidate_messages a inner join pms_candidate b on a.candidate_id=b.candidate_id left join pms_admin_users c on a.admin_id=c.admin_id where a.candidate_id=".$_SESSION['candidate_session']." order by a.message_id desc");
		return $query->result_array();
    }
	
}
?>
