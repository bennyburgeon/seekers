<?php 
class jobareamodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_functional_area';
    }
	
	function record_count($searchterm,$job_cat_id) 
	{
	
		$sql = "select count(distinct a.func_id)as func_id from pms_job_functional_area a left join pms_job_func_to_category c on a.func_id=c.func_id ";
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and a.func_area like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.func_area like '%" . $searchterm . "%'";
			}  
		} 

		if($job_cat_id!='')
		{
			if($cond!=''){
				$cond.=" and c.job_cat_id=" . $job_cat_id;
			} 
			else{
				$cond=" c.job_cat_id=" . $job_cat_id;
			}  
		}
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['func_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by,$job_cat_id)
	{
		$sql = " select distinct a.func_area, a.func_id, (select count(fc.func_id)total_industry from pms_job_func_to_category fc where fc.func_id=a.func_id)as total_industry from pms_job_functional_area a left join pms_job_func_to_category c on a.func_id=c.func_id ";
		$cond='';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and a.func_area like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.func_area like '%" . $searchterm . "%'";
			}  
		} 

		if($job_cat_id!='')
		{
			if($cond!=''){
				$cond.=" and c.job_cat_id=" . $job_cat_id;
			} 
			else{
				$cond=" c.job_cat_id=" . $job_cat_id;
			}  
		}
						
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
	
		$sql.=" order by a.func_area ".$sort_by." limit ".$start.",".$limit;

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
	   
	
	function insert_record($post_values)
    {
		$data=array(
		'func_area'      =>   trim($this->input->post('func_area')),
		);
        $this->db->insert($this->table_name, $data);
		$func_id= $this->db->insert_id();
		$job_cat_id=$post_values['job_cat_id'];
		if(is_array($job_cat_id))
		{
			foreach($job_cat_id as $key => $val)
			{
				$data =array(
				'func_id'=> $func_id,
				'job_cat_id'=> $val,
				);
				$this->db->insert('pms_job_func_to_category', $data);
			}			
		}
		return $func_id;
    }
	
	function job_cat_list()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList=array();
		$finalDropDown=array();
		$dropDownList['']='Select Industry';
		
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_cur_industry($func_id)
	{
		$query = $this->db->query('select job_cat_id from pms_job_func_to_category where func_id='.$func_id);
		$dropdowns = $query->result();
		$dropDownList=array();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[] = $dropdown->job_cat_id;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function update_record($id=NULL)
	{
		$data=array(
		'func_area'      =>   trim($this->input->post('func_area')),
		);
       
	   $this->db->where('func_id', $id);
	   $this->db->update($this->table_name, $data);

	   $this->db->where('func_id', $id);
	   $this->db->delete('pms_job_func_to_category');

	   $job_cat_id=$this->input->post('job_cat_id');
	   
		if(is_array($job_cat_id))
		{
			foreach($job_cat_id as $key => $val)
			{
				$data =array(
				'func_id'=> $id,
				'job_cat_id'=> $val,
				);
				$this->db->insert('pms_job_func_to_category', $data);
			}			
		}
		
		return $id;
		
	}
}
?>