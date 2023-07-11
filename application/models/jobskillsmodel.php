<?php 
class jobskillsmodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_skills ';
    }
	
	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as skill_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" skill_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['skill_id'];
	}
    
	function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="select * from ".$this->table_name;
	$cond='';
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	} 
	else{
	$cond=" skill_name like '%" . $searchterm . "%'";
	}  
	} 
	$cond="skill_name like '%" . $searchterm . "%'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by skill_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	
	function insert_record()
    {
		$data=array(
		'skill_name'=>$this->input->post('skill_name'),
		'skill_desc'=>$this->input->post('skill_desc')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'skill_name'=>$this->input->post('skill_name'),
		'skill_desc'=>$this->input->post('skill_desc')
		);

       $this->db->where('skill_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('skill_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>