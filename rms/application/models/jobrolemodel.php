<?php 
class jobrolemodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_role';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "select count(*)as role_id from ".$this->table_name;
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" role_name like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['role_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
		$sql="select * from ".$this->table_name;
		$cond='';
		if($searchterm!='')
		{
		if($cond!=''){
		//$cond.=" and candidate_id=".$candidateId;
		} 
		else{
		$cond=" role_name like '%" . $searchterm . "%'";
		}  
		} 
		$cond="role_name like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by role_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

	
	function insert_record()
    {
		$data=array(
		'role_name'=>$this->input->post('role_name'),
		'role_desc'=>$this->input->post('role_desc')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'role_name'=>$this->input->post('role_name'),
		'role_desc'=>$this->input->post('role_desc')
		);
       $this->db->where('role_id', $id);
	   $this->db->update($this->table_name, $data);
	}
}
?>