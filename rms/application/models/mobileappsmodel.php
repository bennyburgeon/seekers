<?php
class mobileappsmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->table_name = "pms_objects";
	}
	
	function record_count($searchterm)
	{
		if($searchterm=='')
		{
			$sql="select count(*)as obj_id from pms_objects";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['obj_id'];
		}
		else
		{
			$sql="select count(*)as obj_id from pms_objects where obj_title like '%" . $searchterm . "%'";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['obj_id'];
		}
	}
	
	function other_admin_list($id)
	{
		$query = $this->db->query("SELECT obj_id,obj_title,obj_content,obj_contact_name,status FROM ".$this->admin_table);
		return $query->result_array();
	}
	
	function admin_list($start,$limit,$searchterm,$sort_by)
	{		
		$sql="select * from pms_objects where obj_contact_phone like '%" . $searchterm . "%' ";
		$sql.=" order by obj_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function single_admin($id)
	{
		$query = $this->db->get_where($this->table_name,array('obj_id'=>$id));
		return $query->row_array();
	}
	function single_adminByobj_contact_phone($id)
	{
		$query = $this->db->get_where($this->table_name,array('obj_contact_phone'=>$id));
		return $query->row_array();
	}
	
	
	function insert_record()
	{ 
		$data = array(
			"obj_title"                => $this->input->post("obj_title"),
			"obj_content"              => $this->input->post("obj_content"),
			"obj_type"                 => $this->input->post("obj_type"),
			"obj_contact_name"         => $this->input->post("obj_contact_name"),
			"obj_contact_phone"        => $this->input->post("obj_contact_phone"),
			"obj_contact_email"        => $this->input->post("obj_contact_email"),
			"obj_office_loc"           => $this->input->post("obj_office_loc"),
			"obj_nearest_bus"          => $this->input->post("obj_nearest_bus"),
			"obj_latitude"             => $this->input->post("obj_latitude"),
			"obj_longitude"            => $this->input->post("obj_longitude"),
			"obj_status"               => "1"
			);	
									
		$this->db->insert($this->table_name,$data);
		$id = $this->db->insert_id();
		
		return $id;
	}
	
	function update_record()
	{
		$data = array(
			"obj_title"                => $this->input->post("obj_title"),
			"obj_content"              => $this->input->post("obj_content"),
			"obj_type"                 => $this->input->post("obj_type"),
			"obj_contact_name"         => $this->input->post("obj_contact_name"),
			"obj_contact_phone"        => $this->input->post("obj_contact_phone"),
			"obj_contact_email"        => $this->input->post("obj_contact_email"),
			"obj_office_loc"           => $this->input->post("obj_office_loc"),
			"obj_nearest_bus"          => $this->input->post("obj_nearest_bus"),
			"obj_latitude"             => $this->input->post("obj_latitude"),
			"obj_longitude"            => $this->input->post("obj_longitude"),
			"obj_status"               => "1"
			);	

	   $this->db->where('obj_id', $this->input->post('obj_id'));
	   $this->db->update($this->table_name, $data);

		return;		
	}

	function fill_mobile_app_types()
	{
		$query = $this->db->query('select mobile_app_id, mobile_app_name from pms_mobile_apps order by mobile_app_id asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Content Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->mobile_app_id] = $dropdown->mobile_app_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
		
	function delete_record($id)
	{
		if($id=='')return;
		$this->db->delete('pms_objects',array('obj_id'=>$id));
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) 
		{			
			$this->db->where('obj_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
}
?>
