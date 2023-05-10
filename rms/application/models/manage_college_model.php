<?php
class Manage_college_model extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = "pms_colleges";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{
		if($searchterm==''){
		$sql="select count(*)as college_id from pms_colleges";
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['college_id'];
		}
		else{
		$sql="select count(*)as college_id from pms_colleges where college_name like '%" . $searchterm . "%'";
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['college_id'];
		}
		
	}

	function get_list()
	{
		$query = $this->db->query("select college_id, college_name from ".$this->table_name);
		return $query->result_array();
	}
	
	function get_list1($start,$limit,$sort_by,$searchterm)
	{
		
		$sql="select college_id, college_name from pms_colleges where college_name like '%" . $searchterm . "%'";
		$sql.=" order by college_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}

	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('college_id'=>$id));
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
				"college_name" => $this->input->post("college_name"),
				//"status" => $this->input->post("status")
				);
	   $this->db->where('college_id', $this->input->post('college_id'));
	   $this->db->update($this->table_name, $data);
	}

	function delete_record($id)
	{
			$this->db->delete($this->table_name,array('college_id'=>$id));
			return 1;
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('college_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	function get_ddl()
	{
		$query=$this->db->query("select college_id, college_name from ".$this->table_name ." where status=1");
		$cat_list = $query->result();
		foreach($cat_list as $dropdown)
		{
			$dropDownList[$dropdown->college_id] = $dropdown->college_name;
		}
		return $dropDownList;
	}
	
	function get_all_records($id_arr)
    {
		$ids_array = array();

		foreach ($id_arr as $id) 
		{			
			$query = $this->db->query("select * from pms_candidate_education where college_id=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				$this->db->delete($this->table_name,array('college_id'=>$id));
			}
		}
		return $ids_array;
		
    }
	
}
?>