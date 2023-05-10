<?php 
class Testimonialsmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_testimonials';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "select count(*)as test_id from ".$this->table_name;
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" test_title like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['test_id'];
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
		$cond=" test_title like '%" . $searchterm . "%'";
		}  
		} 
		$cond="test_title like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by test_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

	
    
	function insert_record()
    {
		$data =	array(
		'test_title' => $this->input->post('test_title'),
		'test_desc' => $this->input->post('test_desc'),
		'test_client_name' => $this->input->post('test_client_name'),
		'test_email' => $this->input->post('test_email'),
		'test_phone' => $this->input->post('test_phone')				
		);
		
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	
	function update_record($id=NULL)
	{
		$data =	array(
		'test_title' => $this->input->post('test_title'),
		'test_desc' => $this->input->post('test_desc'),
		'test_client_name' => $this->input->post('test_client_name'),
		'test_email' => $this->input->post('test_email'),
		'test_phone' => $this->input->post('test_phone')				
		);

       $this->db->where('test_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	

}
?>