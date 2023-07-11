<?php 
class visatypemodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_visa_type';
    }
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as visa_type_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" visa_type like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['visa_type_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select * from pms_job_visa_type";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" visa_type like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by visa_type ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	

	function visatype_list()
	{
		$query = $this->db->query('select distinct visa_type_id, visa_type from pms_job_visa_type order by visa_type asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Visa Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->visa_type_id] = $dropdown->visa_type;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function insert_record()
    {
		$data=array(
		'visa_type'=>$this->input->post('visa_type'),
		'visa_desc'=>$this->input->post('visa_desc')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'visa_type'=>$this->input->post('visa_type'),
		'visa_desc'=>$this->input->post('visa_desc')
		);
       $this->db->where('visa_type_id', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('visa_type_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>