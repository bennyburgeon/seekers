<?php
class Companyusersmodel extends CI_Model{
	
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
		$sql="select a.*,b.company_name from pms_company_users a inner join pms_company b on b.company_id=a.company_id where a.username like '%" . $searchterm . "%' ";
		$sql.=" order by a.username asc limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function single_admin_old($id)
	{
		$query = $this->db->get_where($this->admin_table,array('user_id'=>$id));
		return $query->row_array();
	}
	
	
	function single_admin($id)
	{
		$sql="select a.*,b.company_name from pms_company_users a inner join pms_company b on b.company_id=a.company_id where a.user_id=".$id;
		$query = $this->db->query($sql);
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
				"status"=> 1,
				"payment_status" => 1,
				//"package"       =>$this->input->post("package")
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
				"payment_status" => 1,
				//"package"        =>$this->input->post("package")
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

	
	
	
	function fill_company_0()
	{
		$query = $this->db->query('select distinct a.company_id, a.company_name from pms_company a where a.company_id not in(select company_id from pms_company_users) order by a.company_id asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	function fill_company()
	{
		$query = $this->db->query('select distinct a.company_id, a.company_name from pms_company a order by a.company_name');
		$dropdowns = $query->result();
		$dropDownList['']='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	
	function company_list()
	{
		$query = $this->db->query('select distinct a.company_id, a.company_name from pms_company a order by a.company_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Company';
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
