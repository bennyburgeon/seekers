<?php 
class Worklevelmodel extends CI_Model 
{

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_work_level';
    }

	 function record_count($searchterm) 
	{
	
	$sql = "select count(*)as work_level_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" work_level like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['work_level_id'];
	
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
	$cond=" work_level like '%" . $searchterm . "%'";
	}  
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by work_level ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}

    function get_work_level($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select work_level from pms_job_work_level where work_level_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['work_level'];
			}else
			{
				return '';
			}
	}
	
	function insert_record()
    {
		$data=array(
		'work_level'=>$this->input->post('work_level')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }

	function update_record($id=NULL)
	{
		$data=array(
		'work_level'=>$this->input->post('work_level')
		);
       $this->db->where('work_level_id', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('work_level_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>