<?php 
class jobtypemodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_type ';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "select count(*)as job_type_id from ".$this->table_name;
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" job_type_name like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['job_type_id'];
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
		$cond=" job_type_name like '%" . $searchterm . "%'";
		}  
		} 
		$cond="job_type_name like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by job_type_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

	
    function get_job_type($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select job_type_name from pms_job_type where job_type_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['job_type_name'];
			}else
			{
				return '';
			}
	}
	
	function insert_record()
    {
		$data=array(
		'job_type_name'=>$this->input->post('job_type_name'),
		'job_type_desc'=>$this->input->post('job_type_desc')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'job_type_name'=>$this->input->post('job_type_name'),
		'job_type_desc'=>$this->input->post('job_type_desc')
		);

       $this->db->where('job_type_id', $id);
	   $this->db->update($this->table_name, $data);

	}
}
?>