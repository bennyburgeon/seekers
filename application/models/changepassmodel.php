<?php
class Changepassmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->admin_table = "pms_candidate";
	}
	
	function update_record()
	{
		$data = array(
				
				"password"=>md5($this->input->post("newpass"))
				);
	  
	   $this->db->where('candidate_id', $_SESSION['candidate_session']);
	   $this->db->update($this->admin_table, $data);
	   
	}

}
?>