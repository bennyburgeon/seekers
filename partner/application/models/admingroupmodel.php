<?php
class Admingroupmodel extends CI_Model{

	var $table_name	= "";
	var $insert_id 	= "";

	function __construct()
	{
		$this->table_name = "pms_admin_user_groups";
		$this->admin_permission = "pms_admin_permission";
	}
	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as user_grp_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" user_grp_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['user_grp_id'];
	
	}
	
function get_list($start,$limit,$sort_by,$searchterm)
	{ 
	$sql="select * from ".$this->table_name;
	$cond='';
	if($searchterm!='')
	{
		if($cond!=''){
		//$cond.=" and candidate_id=".$candidateId;
		} 
		else{
			$cond=" user_grp_name like '%" . $searchterm . "%'";
		}  
	} 
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by user_grp_id ".$sort_by." limit ".$start.",".$limit;
	
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}

	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('user_grp_id'=>$id));
		return $query->row_array();
	}

	function get_group_permission($id)
	{
		$query = $this->db->query("select module_id from ".$this->admin_permission." where group_id=".$id);
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
					$admin_modules=array(
					'group_id'        => $id,
					'module_id'       => $module
					);
					$this->db->insert($this->admin_permission, $admin_modules);
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

	   if(is_array($this->input->post('modules')))

			{

				$this->db->delete($this->admin_permission,array('group_id'=>$this->input->post('user_grp_id')));

				foreach($this->input->post('modules') as $module)

				{

					$admin_modules=array(

					'group_id'        => $this->input->post('user_grp_id'),

					'module_id'       => $module

					);

					$this->db->insert($this->admin_permission, $admin_modules);

				}

			}

	}

	

	function delete_record($id)

	{

			$this->db->delete($this->table_name,array('user_grp_id'=>$id));

			$this->db->delete($this->admin_permission,array('group_id'=>$id));

			return 1;
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