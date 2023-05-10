<?php 
class levelmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_education_level';
    }
	
	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as level_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" level_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['level_id'];
	
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
	$cond=" level_name like '%" . $searchterm . "%'";
	}  
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by level_name ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	
    function get_level_name($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select level_name from pms_education_level where level_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['level_name'];
			}else
			{
				return '';
			}
	}
	
    
	function insert_record()
    {
		$data=array(
		'level_name'=>$this->input->post('level_name'),
		'level_status'=> '1'
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'level_name'=>$this->input->post('level_name'),
		'level_status'=> '1'
		);

       $this->db->where('level_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('level_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>