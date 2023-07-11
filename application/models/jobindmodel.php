<?php 
class jobindmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_job_category';
    }
		function record_count($searchterm) 
	{
	
	$sql = "select count(*)as job_cat_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" job_cat_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['job_cat_id'];
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
	$cond=" job_cat_name like '%" . $searchterm . "%'";
	}  
	} 
	$cond="job_cat_name like '%" . $searchterm . "%'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by job_cat_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	

    function get_industry_name($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select job_cat_name from pms_job_category where job_cat_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['job_cat_name'];
			}else
			{
				return '';
			}
	}
	   
	
	/*function fill_parent($parent=null)
	{	
		if($parent>0)
			$query = $this->db->query('select distinct job_cat_id, job_cat_name from  pms_job_category  where job_cat_parent=0 and job_cat_id <> '.$parent.' order by job_cat_name asc');
		else
			$query = $this->db->query('select distinct job_cat_id, job_cat_name from  pms_job_category  where job_cat_parent=0 order by job_cat_name asc');
						
		$dropdowns = $query->result();
		$dropDownList[0]='Select Parent';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}*/
    
	function insert_record()
    {
		$data=array(
		'job_cat_name'=>$this->input->post('job_cat_name'),
		
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'job_cat_name'=>$this->input->post('job_cat_name'),
		
		);

       $this->db->where('job_cat_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('job_cat_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>