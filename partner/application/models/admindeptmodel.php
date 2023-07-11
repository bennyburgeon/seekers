<?php
class Admindeptmodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = "pms_admin_departments";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{
		if($searchterm=='')
		{
			$sql="select count(*)as dep_id from pms_admin_departments";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['dep_id'];
		}
		else
		{
			$sql="select count(*)as dep_id from pms_admin_departments where dep_name like '%" . $searchterm . "%'";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['dep_id'];
		}		
	}

	function get_list()
	{
		$query = $this->db->query("select dep_id, dep_name, status from ".$this->table_name);
		return $query->result_array();
	}
	
	function get_list1($start,$limit,$sort_by,$searchterm)
	{
		
		$sql="select dep_id, dep_name, status from pms_admin_departments where dep_name like '%" . $searchterm . "%'";
		$sql.=" order by dep_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}

	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('dep_id'=>$id));
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
				"dep_name" => $this->input->post("dep_name"),
				"status" => $this->input->post("status")
				);
	   $this->db->where('dep_id', $this->input->post('dep_id'));
	   $this->db->update($this->table_name, $data);
	}

	function delete_record($id)
	{
			$this->db->delete($this->table_name,array('dep_id'=>$id));
			return 1;
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('dep_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	function get_ddl()
	{
		$query=$this->db->query("select dep_id, dep_name from ".$this->table_name ." where status=1");
		$cat_list = $query->result();
		foreach($cat_list as $dropdown)
		{
			$dropDownList[$dropdown->dep_id] = $dropdown->dep_name;
		}
		return $dropDownList;
	}
}
?>