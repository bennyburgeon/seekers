<?php
class Agentsmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->admin_table = "pms_company_users";
	}
	
	function record_count($searchterm)
	{
		if($searchterm=='')
		{
			$sql="select count(*)as user_id from pms_company_users";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['user_id'];
		}
		else
		{
			$sql="select count(*)as user_id from pms_company_users where firstname like '%" . $searchterm . "%'";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['user_id'];
		}
	}
	
	function other_admin_list($id)
	{
		$query = $this->db->query("SELECT user_id,firstname,lastname,email,status FROM ".$this->admin_table);
		return $query->result_array();
	}
	
	function admin_list($start,$limit,$searchterm,$sort_by)
	{		
		$sql="select * from pms_company_users where username like '%" . $searchterm . "%' ";
		$sql.=" order by user_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function single_admin($id)
	{
		$query = $this->db->get_where($this->admin_table,array('user_id'=>$id));
		return $query->row_array();
	}
	function single_adminByUsername($id)
	{
		$query = $this->db->get_where($this->admin_table,array('username'=>$id));
		return $query->row_array();
	}
	
	
	function insert_record()
	{ 
		$data = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"password" => md5($this->input->post("password")),
				"company_id" => $this->input->post("company_id"),
				"address" => $this->input->post("address"),
				"status"=> 1
				);
				
		$this->db->insert($this->admin_table,$data);
		$id = $this->db->insert_id();
		
		return $id;
	}
	
	function update_record()
	{
		$data = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"company_id" => $this->input->post("company_id"),
				"address" => $this->input->post("address"),
				);

	   $this->db->where('user_id', $this->input->post('user_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   if($this->input->post('password')!='')
	   {
		   $data = array(
				"password" =>  md5($this->input->post("password"))
				);
		    $this->db->where('user_id', $this->input->post('user_id'));
	  		$this->db->update($this->admin_table, $data);
	   }
	   
	   $this->db->where('user_id', $this->input->post('user_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   $id = $this->input->post('user_id');
		
	}

	function fill_company()
	{
		$query = $this->db->query('select distinct company_id, company_name from pms_company order by company_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
		
	function delete_record($id)
	{
		if($id=='')return;
		$query = $this->db->query("select admin_prof_img_url from ".$this->admin_table." where admin_prof_img_url <> '' and user_id=".$id);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if(file_exists('uploads/agentsprofile/'.$row['admin_prof_img_url']) && $row['admin_prof_img_url']!='')
			unlink('uploads/agentsprofile/'.$row['admin_prof_img_url']);
		}
		$this->db->delete($this->admin_table,array('user_id'=>$id));
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('user_id',$id);
			$this->db->delete($this->admin_table);
		}	
    }
	
}
?>
