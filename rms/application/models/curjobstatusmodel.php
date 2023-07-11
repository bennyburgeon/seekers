<?php 
class Curjobstatusmodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_cur_job_status';
    }
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as cur_job_status from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" cur_job_status_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['cur_job_status'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select * from pms_cur_job_status";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" cur_job_status_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by cur_job_status_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	function insert_record()
    {
		$data=array(
		'cur_job_status_name'=>$this->input->post('cur_job_status_name'),
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'cur_job_status_name'=>$this->input->post('cur_job_status_name'),
		);
       $this->db->where('cur_job_status', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('cur_job_status',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>