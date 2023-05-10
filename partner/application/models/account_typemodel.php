<?php 
class Account_typemodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_account_types';
    }
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as account_type_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" account_type_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['account_type_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select * from pms_account_types";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" account_type_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by account_type_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	function insert_record()
    {
		$data=array(
		'account_type_name'=>$this->input->post('account_type_name'),
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'account_type_name'=>$this->input->post('account_type_name'),
		);
       $this->db->where('account_type_id', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('account_type_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>