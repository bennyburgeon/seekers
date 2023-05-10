<?php 
class Packagesmodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_packages';
    }
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as package_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" package_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['package_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select * from pms_packages";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" package_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by package_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	function insert_record()
    {
		$data=array(
		'package_name'=>$this->input->post('package_name'),
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'package_name'=>$this->input->post('package_name'),
		);
       $this->db->where('package_id', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('package_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>