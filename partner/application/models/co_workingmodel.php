<?php
class Co_workingmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->table_name = "pms_co_coworking_space";
	}
	
	function record_count($searchterm)
	{
		if($searchterm=='')
		{
			$sql="select count(*)as co_work_id from pms_co_coworking_space";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['co_work_id'];
		}
		else
		{
			$sql="select count(*)as co_work_id from pms_co_coworking_space where co_work_title like '%" . $searchterm . "%'";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['co_work_id'];
		}
	}
	
	function other_admin_list($id)
	{
		$query = $this->db->query("SELECT co_work_id,co_work_title,address,vacant_from,status FROM ".$this->admin_table);
		return $query->result_array();
	}
	
	function admin_list($start,$limit,$searchterm,$sort_by)
	{		
		$sql="select * from pms_co_coworking_space where co_work_title like '%" . $searchterm . "%' ";
		$sql.=" order by co_work_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function single_admin($id)
	{
		$query = $this->db->get_where($this->table_name,array('co_work_id'=>$id));
		return $query->row_array();
	}
	function single_adminByobj_contact_phone($id)
	{
		$query = $this->db->get_where($this->table_name,array('co_work_title'=>$id));
		return $query->row_array();
	}
	
	
	function insert_record()
	{ 
		$data = array(
			"co_work_title"                => $this->input->post("co_work_title"),
			"address"              => $this->input->post("address"),
			"vacant_from"         => $this->input->post("vacant_from"),
			"contact_name"        => $this->input->post("contact_name"),
			"vacancy_status"           => $this->input->post("vacancy_status"),
			"monthly_rent"          => $this->input->post("monthly_rent"),
			"office_latitude"             => $this->input->post("office_latitude"),
			"office_longitude"            => $this->input->post("office_longitude"),
			"list_status"               => "1"
			);	
									
		$this->db->insert($this->table_name,$data);
		$id = $this->db->insert_id();
		
		return $id;
	}
	
	function update_record()
	{
		$data = array(
			"co_work_title"                => $this->input->post("co_work_title"),
			"address"              => $this->input->post("address"),
			"vacant_from"         => $this->input->post("vacant_from"),
			"contact_name"        => $this->input->post("contact_name"),
			"vacancy_status"           => $this->input->post("vacancy_status"),
			"monthly_rent"          => $this->input->post("monthly_rent"),
			"office_latitude"             => $this->input->post("office_latitude"),
			"office_longitude"            => $this->input->post("office_longitude"),
			"list_status"               => "1"
			);	

	   $this->db->where('co_work_id', $this->input->post('co_work_id'));
	   $this->db->update($this->table_name, $data);

		return;		
	}

		
	function delete_record($id)
	{
		if($id=='')return;
		$this->db->delete('pms_co_coworking_space',array('co_work_id'=>$id));
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) 
		{			
			$this->db->where('co_work_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
}
?>
