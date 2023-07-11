<?php 
class Notificationsmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_recruiter_messages';
    }
    
	function get_all()
    {
       	$query=$this->db->query("select * from pms_recruiter_messages order by message_id desc");
		return $query->result_array();
    }

	function admin_group_list()
    {
		$query = $this->db->query("select DISTINCT user_grp_id,user_grp_name from pms_admin_user_groups a inner join pms_admin_users b on a.user_grp_id=b.group_id order by user_grp_name ");			
		$rows_list = $query->result();
		$return_list = array();
		foreach($rows_list as $row)
		{
			$return_list[$row->user_grp_id] = $row->user_grp_name;
		}
		return $return_list;
    }
	    
	function admin_users_list_old()
    {
		$query = $this->db->query("select admin_id,firstname from pms_admin_users order by firstname ");			
		$rows_list = $query->result();
		$return_list = array();
		foreach($rows_list as $row)
		{
			$return_list[$row->admin_id] = $row->firstname;
		}
		return $return_list;
    }
	
	
	
	function admin_users_list()
    {
		$query = $this->db->query("select vendor_id,firstname,lastname from pms_vendors order by firstname ");			
		$rows_list = $query->result();
		$return_list = array();
		foreach($rows_list as $row)
		{
			$return_list[$row->vendor_id] = $row->firstname .'&nbsp;'. $row->lastname;
		}
		return $return_list;
    }
	

	function admin_users_group($group_id)
    {
		$query = $this->db->query("select admin_id,firstname from pms_admin_users where group_id=".$group_id);			
		$rows_list = $query->result();
		$return_list = array();
		foreach($rows_list as $row)
		{
			$return_list[$row->admin_id] = $row->firstname;
		}
		return $return_list;
    }
		
	function insert_record($data)
    {
		$this->db->insert('pms_recruiter_messages', $data);		
		$id=$this->db->insert_id();
		return $id;
    }

	function insert_notification_users($not_id,$user_id)
    {
		$data=array(
		'not_id'    =>   $not_id,	
		'user_id'    =>   $user_id,	
		);
		
        $this->db->insert('pms_notifications_users', $data);		
		$id=$this->db->insert_id();
		return $id;
    }
		
	function update_record($id = '')
	{
		$data=array(
		'text_message'    =>$this->input->post('text_message'),	
		'not_text'     =>$this->input->post('not_text')
		);
       $this->db->where('not_id', $this->input->post('not_id'));
	   $this->db->update($this->table_name, $data);
	   return true;
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
				$cond =" text_message like '%" . $searchterm . "%'";
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
		$sql="select distinct a.* ";
		
		$sql.=", (select firstname as message_from_user from pms_vendors c where c.vendor_id=a.message_from) as message_from_user ";
		
		$sql.=", (select firstname as message_to_user from pms_vendors d where d.vendor_id=a.message_to) as message_to_user ";
		
		
		$sql.= "from pms_recruiter_messages a ";
		
		$cond='';
				
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" a.text_message like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by a.text_message ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('not_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>
