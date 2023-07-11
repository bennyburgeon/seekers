<?php
class Vendorsmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->admin_table = "pms_vendors";
	}
	
	function record_count($searchterm)
	{
		if($searchterm=='')
		{
			$sql="select count(*)as vendor_id from pms_vendors";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['vendor_id'];
		}
		else
		{
			$sql="select count(*)as vendor_id from pms_vendors where firstname like '%" . $searchterm . "%'";
			$query = $this->db->query($sql);
			$row=$query->row_array();
			return $row['vendor_id'];
		}
	}
	
	function other_admin_list($id)
	{
		$query = $this->db->query("SELECT vendor_id,firstname,lastname,email,status FROM ".$this->admin_table);
		return $query->result_array();
	}
	
	function admin_list($start,$limit,$searchterm,$sort_by)
	{		
		$sql="select * from pms_vendors where username like '%" . $searchterm . "%' ";
		$sql.=" order by vendor_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function single_admin($id)
	{
		$query = $this->db->get_where($this->admin_table,array('vendor_id'=>$id));
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
				"job_cat_id"   => $this->input->post("job_cat_id"),
				"grade_id"   => $this->input->post("grade_id"),				
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
				"job_cat_id"   => $this->input->post("job_cat_id"),
				"grade_id"   => $this->input->post("grade_id"),
				"address" => $this->input->post("address"),
				);

	   $this->db->where('vendor_id', $this->input->post('vendor_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   if($this->input->post('password')!='')
	   {
		   $data = array(
				"password" =>  md5($this->input->post("password"))
				);
		    $this->db->where('vendor_id', $this->input->post('vendor_id'));
	  		$this->db->update($this->admin_table, $data);
	   }
	   
	   $this->db->where('vendor_id', $this->input->post('vendor_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   $id = $this->input->post('vendor_id');
		
	}
	function fill_industry()
	{
		$query = $this->db->query("select job_cat_id, job_cat_name from pms_job_category where job_cat_name <> '' order by job_cat_name asc");
		$dropdowns = $query->result();
		$dropDownList['']='Select Industry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
		
	function delete_record($id)
	{
		if($id=='')return;
		$this->db->delete($this->admin_table,array('vendor_id'=>$id));
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('vendor_id',$id);
			$this->db->delete($this->admin_table);
		}	
    }
	
}
?>
