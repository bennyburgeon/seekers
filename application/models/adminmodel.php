<?php
class Adminmodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->admin_table = "pms_admin_users";
		$this->group_table = "pms_admin_user_groups";
		$this->type_table = "pms_admin_user_types";
		$this->dept_table = "pms_admin_departments";
		$this->admin_dept_table = "pms_admin_to_department";
	}
	
	function record_count($searchterm)
	{
		if($searchterm==''){
		$sql="select count(*)as candidate_id from pms_candidate";
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['candidate_id'];
		}
		else{
		$sql="select count(*)as candidate_id from pms_candidate where first_name like '%" . $searchterm . "%'";
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['candidate_id'];
	}
	}
	
	function other_admin_list($id)
	{
		$query = $this->db->query("SELECT candidate_id,first_name,last_name,email,status FROM ".$this->admin_table);
		return $query->result_array();
	}
	
	function admin_list($start,$limit,$searchterm,$sort_by)
	{
		
		$sql="select * from pms_candidate where username like '%" . $searchterm . "%' ";
		$sql.=" order by candidate_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function single_admin($id)
	{
		$query = $this->db->get_where($this->admin_table,array('candidate_id'=>$id));
		return $query->row_array();
	}
	function single_adminByUsername($id)
	{
		$query = $this->db->get_where($this->admin_table,array('username'=>$id));
		return $query->row_array();
	}
	
	function getadmindept($id)
	{
		$query =  $this->db->query("SELECT dept_id FROM ".$this->admin_dept_table." where candidate_id=".$id);
		return array_map('current', $query->result_array());
	}
	
	function insert_record()
	{ 
		$data = array(
				"first_name" => $this->input->post("first_name"),
				"last_name" => $this->input->post("last_name"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"password" => md5($this->input->post("password")),
				"group_id" => $this->input->post("group_id"),
				"type_id" =>$this->input->post("type_id"),
				"address" => $this->input->post("address"),
				"status"=> 1
				);
				
		$this->db->insert($this->admin_table,$data);
		$id = $this->db->insert_id();
		
			if(is_array($this->input->post('dept_id')))
			{
				foreach($this->input->post('dept_id') as $dept)
				{
					$admin_department=array(
					'candidate_id'        => $id,
					'dept_id'       => $dept
					);
					$this->db->insert($this->admin_dept_table, $admin_department);
				}
			}
		
		return $id;
	}

	function insert_ajax()
	{ 
		$data = array(
			"first_name" => $this->input->post("first_name"),
			"last_name" => $this->input->post("last_name"),
			"email" => $this->input->post("email"),
			"username" => $this->input->post("username"),
			"password" => md5($this->input->post("password")),
			"group_id" => '5',
			"type_id" => '0',
			"address" => $this->input->post("address"),
			//"city" => $this->input->post("city_name"),
			//"country" => $this->input->post("country"),
			"telephone" => $this->input->post("telephone"),
			"status"=> '1'				
			);
	
		$this->db->insert($this->admin_table,$data);
		$id = $this->db->insert_id();
		return $id;
	}
		
	function update_record()
	{
		$data = array(
				"first_name" => $this->input->post("first_name"),
				"last_name" => $this->input->post("last_name"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"group_id" => $this->input->post("group_id"),
				"type_id" =>$this->input->post("type_id"),
				"address" => $this->input->post("address"),
				"status"=> 1
				);
	  
	   $this->db->where('candidate_id', $this->input->post('candidate_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   if($this->input->post('password')!='')
	   {
		   $data = array(
				"password" =>  md5($this->input->post("password"))
				);
		    $this->db->where('candidate_id', $this->input->post('candidate_id'));
	  		$this->db->update($this->admin_table, $data);
	   }
	   
	   $this->db->where('candidate_id', $this->input->post('candidate_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   $id = $this->input->post('candidate_id');
		
		
		
		if(is_array($this->input->post('dept_id')))
			{
				$this->db->delete($this->admin_dept_table,array('candidate_id'=>$id));
				foreach($this->input->post('dept_id') as $dept)
				{
					$admin_department=array(
					'candidate_id'        => $id,
					'dept_id'       => $dept
					);
					$this->db->insert($this->admin_dept_table, $admin_department);
				}
			}
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('candidate_id',$id);
			$this->db->delete($this->admin_table);
		}	
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
	
	function type_ddl()
	{
		$query=$this->db->query("select type_id, type_name from ".$this->type_table );
		$type_list = $query->result();
		$dropDownList[0]='Select Type';
		foreach($type_list as $dropdown)
		{
			$dropDownList[$dropdown->type_id] = $dropdown->type_name;
		}
		return $dropDownList;
	}
	
	function department_ddl()
	{
		$query=$this->db->query("select dep_id, dep_name from ".$this->dept_table );
		$dep_list = $query->result();
		
		foreach($dep_list as $dropdown)
		{
			$dropDownList[$dropdown->dep_id] = $dropdown->dep_name;
		}
		return $dep_list;
	}

}
?>
