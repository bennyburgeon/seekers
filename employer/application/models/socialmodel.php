<?php 
class socialmodel extends CI_Model 
{

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_social_media';
    }
		function record_count($searchterm) 
	{
	
	$sql = "select count(*)as media_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" media_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['media_id'];
	
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
	$cond=" media_name like '%" . $searchterm . "%'";
	}  
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by media_name ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	
	
	function insert_record()
    {
		$data=array(
		'media_name'=>$this->input->post('media_name'),
		'media_link'=>$this->input->post('media_link')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }

	function update_record($id=NULL)
	{
		$data=array(
		'media_name'=>$this->input->post('media_name'),
		'media_link'=>$this->input->post('media_link')
		);
       $this->db->where('media_id', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('media_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>