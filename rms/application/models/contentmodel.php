<?php 
class Contentmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_content_share';
    }
    
	function get_all()
    {
       	$query=$this->db->query("select * from pms_content_share order by content_id desc");
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
	    
	function admin_users_list()
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
		
	function insert_record()
    {
		date_default_timezone_set('Asia/Calcutta');
		$date = date('Y-m-d H:i:s');
		
		$data=array(
		'content_title'    =>$this->input->post('content_title'),	
		'user_id'      => $_SESSION['admin_session'],	
		'actual_text'     =>$this->input->post('actual_text'),
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		return $id;
    }

	function insert_notification_users($content_id,$user_id)
    {
		$data=array(
		'content_id'    =>   $content_id,	
		'user_id'    =>   $user_id,	
		);
		
        $this->db->insert('pms_content_share_users', $data);		
		$id=$this->db->insert_id();
		return $id;
    }
		
	function update_record($id = '')
	{
		$data=array(
		'content_title'    =>$this->input->post('content_title'),	
		'actual_text'     =>$this->input->post('actual_text')
		);
       $this->db->where('content_id', $this->input->post('content_id'));
	   $this->db->update($this->table_name, $data);
	   return true;
	}
	
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as content_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" content_title like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['content_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select * from ".$this->table_name;
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" content_title like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by content_title ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('content_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>
