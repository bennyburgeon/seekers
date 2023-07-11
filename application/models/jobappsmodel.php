<?php 
class jobappsmodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_cms_pages ';
    }
	
	function record_count($searchterm) 
	{
	$sql = "select count(*)as page_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" page_title like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['page_id'];
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
	$cond=" page_title like '%" . $searchterm . "%'";
	}  
	} 
	$cond="page_title like '%" . $searchterm . "%'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by page_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	
	function insert() 
	{
				$data=array(
				'page_title'=>$this->input->post('page_title'),
				'page_content'=>$this->input->post('page_content'),
				'short_desc'=>$this->input->post('short_desc'),
				'seo_keyword'=>$this->input->post('seo_keyword'),
				'seo_title'=>$this->input->post('seo_title'),
				'seo_meta_desc'=>$this->input->post('seo_meta_desc'),
				);
				$this->db->insert($this->table_name,$data);
	}
	
	function update($id) 
	{
	// save data into the db.
						$data=array(
						'page_title'=>$this->input->post('page_title'),
						'page_content'=>$this->input->post('page_content'),
						'short_desc'=>$this->input->post('short_desc'),
						'seo_keyword'=>$this->input->post('seo_keyword'),
						'seo_title'=>$this->input->post('seo_title'),
						'seo_meta_desc'=>$this->input->post('seo_meta_desc'),
						);
						$this->db->where('page_id', $id);
						$this->db->update($this->table_name, $data);
	
	}
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('page_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>