<?php
class Usersmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		
		$this->user_table = "pms_partners";
		$this->group_table = "pms_partner_groups";
		
	}
	
	function group_ddl()
	{
		$query=$this->db->query("select user_grp_id, user_grp_name from ".$this->group_table );
		$group_list = $query->result();
		$dropDownList[0]='Select Group';
		foreach($group_list as $dropdown)
		{
			$dropDownList[$dropdown->user_grp_id] = $dropdown->user_grp_name;
		}
		return $dropDownList;
	}
	
	function user_list()
	{
		$query = $this->db->query("SELECT customer_id,firstname,lastname,email FROM ".$this->user_table);
		return $query->result_array();
	}
	
	function single_user($id)
	{
		$query = $this->db->get_where($this->user_table,array('customer_id'=>$id));
		return $query->row_array();
	}
	
	
	
	
	function insert_record()
	{ 
			
			
		$data =  array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"password" => $this->input->post("password"),
				"address" => $this->input->post("address"),
				"telephone" => $this->input->post("telephone"),
				"partner_group_id" => $this->input->post("partner_group_id"),
				"status"=>$this->input->post("status")
				);
		$this->db->insert($this->user_table,$data);
		$id = $this->db->insert_id();
		
		return $id;
		
	}
	
	function update_record()
	{
		$data =  array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"address" => $this->input->post("address"),
				"telephone" => $this->input->post("telephone"),
				"partner_group_id" => $this->input->post("partner_group_id"),
				"status"=>$this->input->post("status")
				);
	   
	 
	   $this->db->where('customer_id', $this->input->post('customer_id'));
	   $this->db->update($this->user_table, $data);
	   
	    if($this->input->post('password'))
	   {
		   $data = array(
				"password" => $this->input->post("password")
				);
		    $this->db->where('customer_id', $this->input->post('customer_id'));
	  		$this->db->update($this->user_table, $data);
	   }
	   		
	   $this->db->where('customer_id', $this->input->post('customer_id'));
	   $this->db->update($this->user_table, $data);
	   
	   $id = $this->input->post('customer_id');
		
		
	}
	
	function delete_record($id)
	{
		$this->db->delete($this->user_table,array('customer_id'=>$id));
	}
}
?>