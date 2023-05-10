<?php 
class expertmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_job_exp_level';
    }
	

		 function record_count($searchterm) 
	{
	
	$sql = "select count(*)as exp_level_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" exp_level like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['exp_level_id'];
	
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
	$cond=" exp_level like '%" . $searchterm . "%'";
	}  
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by exp_level ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	} 
	
	function insert_record()
    {
		$data=array(
		'exp_level'=>$this->input->post('exp_level'),
		'exp_level_from'=>$this->input->post('exp_level_from')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'exp_level'=>$this->input->post('exp_level'),
		'exp_level_from'=>$this->input->post('exp_level_from')
		);

       $this->db->where('exp_level_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('exp_level_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>