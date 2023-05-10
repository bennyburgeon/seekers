<?php 
class Manage_leave_model extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_admin_leave';
    }
	
	function insert_record()
    {
		
		$data=array(
		'admin_id'=> $this->input->post('name'),
		'date_from'=> $this->input->post('date_from'),
		'date_to'=> $this->input->post('date_to'),
		'leave_type'=> $this->input->post('leave_type'),
		'session_type'=> $this->input->post('session_type'),
		'leave_status'=> $this->input->post('leave_status'),
		'approved_by'=> $_SESSION['company_session']
		);
		//print_r($data);die;
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
	
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		
		$data=array(
		'admin_id'=> $this->input->post('name'),
		'date_from'=> $this->input->post('date_from'),
		'date_to'=> $this->input->post('date_to'),
		'leave_type'=> $this->input->post('leave_type'),
		'session_type'=> $this->input->post('session_type'),
		'leave_status'=> $this->input->post('leave_status'),
		'approved_by'=> $_SESSION['company_session']
		);
 //~ print_r($data);die;
       $this->db->where('leave_id', $this->input->post('leave_id'));
	   $this->db->update('pms_admin_leave', $data);	  		
	   //~ $this->load->library('upload');	
	}
	
	function delete($id=null)
	{
		if($id=='') return false;		
		$this->db->where('leave_id', $id);
		$this->db->delete('pms_admin_leave');		
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('leave_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_state','key' => 'branch_id','Module'=>'Branch'));
		$is_related = FALSE;
		foreach($master_tables as $table){
			$query=$this->db->query("select * from ".$table['table']." where ".$table['key']."=".$id);
			$num_rows = (int) $query->num_rows();
			if($num_rows){
				$is_related = TRUE;
				$_SESSION['related_module'] = $table['Module'];
				break;
			}
		}
		return $is_related;
	}

	
	function check_dups($name='',$id='')
	{
		$this->db->query('branch_name', $name);
		if($id!='')	$this->db->where('branch_id !=', $id);		
		$query = $this->db->get('pms_branch_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
	
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as leave_id from ".$this->table_name." a join pms_admin_users b";
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" b.firstname like '%" . $searchterm . "%' and b.admin_id=a.admin_id";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		//echo $sql;
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['leave_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		
		
		
		//~ $sql="select a.*, b.firstname, b.lastname, (select pms_admin_users.firstname from pms_admin_users, pms_admin_leave where pms_admin_users.admin_id = pms_admin_leave.approved_by) as fname from ".$this->table_name." a join pms_admin_users b where a.admin_id = b.admin_id";
		$sql="select a.*, b.firstname, b.lastname from ".$this->table_name." a join pms_admin_users b where a.admin_id = b.admin_id";
		$cond='';
		
		
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond=" b.admin_id=a.admin_id";
			}	
			else{
				//~ $cond=" branch_name like '%" . $searchterm . "%'";
				//~ $sql="select a.*, b.firstname, b.lastname, (select pms_admin_users.firstname from pms_admin_users, pms_admin_leave where pms_admin_users.admin_id = pms_admin_leave.approved_by) as fname from ".$this->table_name." a join pms_admin_users b";
				$sql="select a.*, b.firstname, b.lastname from ".$this->table_name." a join pms_admin_users b";
				$cond=" b.firstname like '%" . $searchterm . "%' and b.admin_id=a.admin_id";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by date_from ".$sort_by." limit ".$start.",".$limit;
		//~ echo $sql;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	function get_all_admins()
	{
		$row=$this->db->get('pms_admin_users');
		if($row->num_rows()>0)
		{
			foreach($row->result() as $q)
		{
			$data[]=$q;
			}
		}
		//~ print_r($data);die;
		return $data;
	}
}
?>
