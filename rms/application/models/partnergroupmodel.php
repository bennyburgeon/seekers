<?php
class Partnergroupmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->table_name = "pms_partner_groups";
		$this->partner_permission = "pms_partner_permission";
	}
	
	function get_list()
	{
		$query = $this->db->query("select user_grp_id, user_grp_name, status from ".$this->table_name);
		return $query->result_array();
	}
	
	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('user_grp_id'=>$id));
		return $query->row_array();
	}
	
	function get_group_permission($id)
	{
		$query = $this->db->query("select module_id from ".$this->partner_permission." where group_id=".$id);
		return array_map('current', $query->result_array());
	}
	
	function insert_record($data)
	{ 
	
		$this->db->insert($this->table_name,$data);
		$id =  $this->db->insert_id();
		
		if(is_array($this->input->post('modules')))
			{
				foreach($this->input->post('modules') as $module)
				{
					$partner_modules=array(
					'group_id'        => $id,
					'module_id'       => $module
					);
					$this->db->insert($this->partner_permission, $partner_modules);
				}
			}
	}
	
	function update_record()
	{
		$data = array(
				"user_grp_name" => $this->input->post("user_grp_name"),
				"status" => $this->input->post("status")
				);
		
	   $this->db->where('user_grp_id', $this->input->post('user_grp_id'));
	   $this->db->update($this->table_name, $data);
	   
	   $this->db->delete($this->partner_permission,array('group_id'=>$this->input->post('user_grp_id')));
	   if(is_array($this->input->post('modules')))
			{
				
				foreach($this->input->post('modules') as $module)
				{
					$partner_modules=array(
					'group_id'        => $this->input->post('user_grp_id'),
					'module_id'       => $module
					);
					$this->db->insert($this->partner_permission, $partner_modules);
				}
			}
	}
	
	function delete_record($id)
	{
		//$query = $this->db->query("select event_id from ".$this->event_feature_table." where user_grp_id=".$id);

		//if ($query->num_rows() == 0)
		//{
			$this->db->delete($this->table_name,array('user_grp_id'=>$id));
			$this->db->delete($this->partner_permission,array('group_id'=>$id));
			return 1;
		//}
		//else
		//{
		//	return 2;
		//}
	}
	
	function get_ddl()
	{
		$query=$this->db->query("select user_grp_id, user_grp_name from ".$this->table_name ." where status=1");
		$cat_list = $query->result();
		foreach($cat_list as $dropdown)
		{
			$dropDownList[$dropdown->user_grp_id] = $dropdown->user_grp_name;
		}
		return $dropDownList;
	}
}
?>