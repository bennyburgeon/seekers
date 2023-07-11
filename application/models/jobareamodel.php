<?php 
class jobareamodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_functional_area';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "select count(*)as func_id from pms_job_functional_area a inner join pms_job_category b ON a.job_cat_id=b.job_cat_id";
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" func_area like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['func_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
		$sql = "select a.*,b.* from pms_job_functional_area a inner join pms_job_category b ON a.job_cat_id=b.job_cat_id";
		$cond='';
		if($searchterm!='')
		{
		if($cond!=''){
		//$cond.=" and candidate_id=".$candidateId;
		} 
		else{
		$cond=" a.func_area like '%" . $searchterm . "%'";
		}  
		} 
		$cond="a.func_area like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by a.func_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

    function get_fun_area($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select func_area from pms_job_functional_area where func_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['func_area'];
			}else
			{
				return '';
			}
	}
	   
	
	function insert_record()
    {
		$data=array(
		'func_area'=>$this->input->post('func_area'),
		'job_cat_id'=>$this->input->post('job_cat_id')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	
	function job_cat_list()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Category';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	
	function update_record($id=NULL)
	{
		$data=array(
		'func_area'=>$this->input->post('func_area'),
		'job_cat_id'=>$this->input->post('job_cat_id')
		);
       $this->db->where('func_id', $id);
	   $this->db->update($this->table_name, $data);
	}
}
?>