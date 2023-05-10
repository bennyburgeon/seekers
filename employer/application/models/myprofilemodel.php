<?php
class Myprofilemodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->admin_table = "pms_company_users";
		
	}
	function single_admin($id)
	{
		$query = $this->db->get_where($this->admin_table,array('user_id'=>$id));
		return $query->row_array();
	}

	
	function update_record()
	{
		$data = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"address" => $this->input->post("address"),
				);
	  
	   $this->db->where('user_id', $this->input->post('user_id'));
	   $this->db->update($this->admin_table, $data);
	   $id = $this->input->post('user_id');
		$this->load->library('upload');
		
	}
	
}
?>