<?php 
class Availabilitymodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_avail_to_join';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "select count(*)as avail_id from ".$this->table_name;
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" avail_name like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['avail_id'];
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
		$cond=" avail_name like '%" . $searchterm . "%'";
		}  
		} 
		$cond="avail_name like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by avail_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

	
	function insert_record()
    {
		$data=array(
		'avail_days'=>$this->input->post('avail_days'),
		'avail_name'=>$this->input->post('avail_name')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'avail_days'=>$this->input->post('avail_days'),
		'avail_name'=>$this->input->post('avail_name')
		);
       $this->db->where('avail_id', $id);
	   $this->db->update($this->table_name, $data);
	}
}
?>