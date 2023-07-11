<?php

class Admintypemodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = "pms_admin_user_types";
		//$this->event_feature_table = "event_to_feature";
	}

	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as type_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" type_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['type_id'];
				
		
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
				$cond=" type_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by type_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }	

	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('type_id'=>$id));
		return $query->row_array();
	}

	function insert_record($data)
	{ 
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}

	function update_record()
	{
		$data = array(
				"type_name" => $this->input->post("type_name"),
				"ordering" => $this->input->post("ordering"),
				"status" => $this->input->post("status")
				);
	   $this->db->where('type_id', $this->input->post('type_id'));
	   $this->db->update($this->table_name, $data);
	}
	function delete_record($id)
	{
			$this->db->delete($this->table_name,array('type_id'=>$id));
			return 1;
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('type_id',$id);
			$this->db->delete($this->table_name);
		}	
    }

	function get_ddl()
	{
		$query=$this->db->query("select type_id, type_name,ordering from ".$this->table_name);
		$cat_list = $query->result();
		foreach($cat_list as $dropdown)
		{
			$dropDownList[$dropdown->type_id] = $dropdown->type_name;
		}
		return $dropDownList;
	}
}
?>