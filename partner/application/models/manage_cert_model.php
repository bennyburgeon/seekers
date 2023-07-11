<?php
class Manage_cert_model extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = "pms_candidate_certification";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{
		if($searchterm==''){
		$sql="select count(*)as cert_id from pms_candidate_certification";
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['cert_id'];
		}
		else{
		$sql="select count(*)as cert_id from pms_candidate_certification where cert_name like '%" . $searchterm . "%'";
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['cert_id'];
		}
		
	}

	function get_list()
	{
		$query = $this->db->query("select cert_id, cert_name from ".$this->table_name);
		return $query->result_array();
	}
	
	function get_list1($start,$limit,$sort_by,$searchterm)
	{
		
		$sql="select cert_id, cert_name from pms_candidate_certification where cert_name like '%" . $searchterm . "%'";
		$sql.=" order by cert_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
	}

	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('cert_id'=>$id));
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
				"cert_name" => $this->input->post("cert_name"),
				//"status" => $this->input->post("status")
				);
	   $this->db->where('cert_id', $this->input->post('cert_id'));
	   $this->db->update($this->table_name, $data);
	}

	function delete_record($id)
	{
			$this->db->delete($this->table_name,array('cert_id'=>$id));
			return 1;
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('cert_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	function get_ddl()
	{
		$query=$this->db->query("select cert_id, cert_name from ".$this->table_name ." where status=1");
		$cat_list = $query->result();
		foreach($cat_list as $dropdown)
		{
			$dropDownList[$dropdown->cert_id] = $dropdown->cert_name;
		}
		return $dropDownList;
	}
	
	function get_all_records($id_arr)
    {
		$ids_array = array();

		foreach ($id_arr as $id) 
		{			
			$query = $this->db->query("select * from pms_candidate_to_certification where cert_id=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				 $this->db->where('cert_id',$id);
				 $this->db->delete($this->table_name);
			}
		}
		return $ids_array;
		
    }
	
	function get_all_records1($id_arr)
    {
		$ids_array = array();

		foreach ($id_arr as $id) 
		{			
			$query = $this->db->query("select * from pms_job_to_certification where cert_id=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				$this->db->where('cert_id',$id);
			    $this->db->delete($this->table_name);
			}
		}
		return $ids_array;
		
    }
}
?>