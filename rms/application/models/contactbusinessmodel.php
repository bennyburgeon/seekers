<?php
class Contactbusinessmodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = "pms_contact_business";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as business_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" business_type like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['business_id'];
	
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
	$cond=" business_type like '%" . $searchterm . "%'";
	}  
	} 
	$cond="business_type like '%" . $searchterm . "%'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by business_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}

	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('business_id'=>$id));
		return $query->row_array();
	}
    function insert_record()
	{ 
        $data = array(
				"business_type" => $this->input->post("business_type"),
				"status" => $this->input->post("status")
                );
		$this->db->insert($this->table_name,$data);
        $insert_id=$this->db->insert_id();
        return $insert_id;
	}
     function update_record()
	{
     //echo $this->input->post('business_id');
		$data = array(
				"business_type" => $this->input->post("business_type"),
				"status" => $this->input->post("status"),
            
				);
        $this->db->where('business_id', $this->input->post('business_id'));
	   $this->db->update($this->table_name, $data);
       
        
        
       
	}
     function delete_record($id)
	{
			$this->db->delete($this->table_name,array('business_id'=>$id));
			return 1;
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('business_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
}
?>