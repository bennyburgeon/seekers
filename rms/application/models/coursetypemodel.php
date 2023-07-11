<?php 
class Coursetypemodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_course_type';
    }

	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as course_type_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" course_type like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['course_type_id'];
	
	}
	
    function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="select * from ".$this->table_name;
	$cond='';
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and connum=".$connum;
	} 
	else{
	$cond=" course_type like '%" . $searchterm . "%'";
	}  
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by course_type_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	
    
	function insert_record()
    {
		$data=array(
		'course_type'=>$this->input->post('course_type'),
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	
	function update_record($id=NULL)
	{
		$data=array(
		'course_type'=>$this->input->post('course_type'),
		);

       $this->db->where('course_type_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('course_type_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>