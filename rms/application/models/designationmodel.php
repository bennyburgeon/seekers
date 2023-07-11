<?php 
class Designationmodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_designation';
    }
	
	function record_count($searchterm,$func_id, $job_cat_id) 
	{
	
		$sql = "select count(*)as desig_id from pms_designation a left join pms_designation_to_function b ON a.desig_id=b.desig_id";
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and a.desig_name like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.desig_name like '%" . $searchterm . "%'";
			}  
		} 

		if($func_id!='')
		{
			if($cond!=''){
				$cond.=" and b.func_id=" . $func_id;
			} 
			else{
				$cond=" b.func_id=" . $func_id;
			}  
		}

		if($job_cat_id!='')
		{
			if($cond!=''){
				$cond.=" and b.func_id in (select fc.func_id from pms_job_func_to_category fc where fc.job_cat_id=" . $job_cat_id.") ";
			} 
			else{
				$cond.=" b.func_id in (select fc.func_id from pms_job_func_to_category fc where fc.job_cat_id=" . $job_cat_id.") ";
			}  
		}		
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['desig_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by,$func_id, $job_cat_id)
	{
		$sql = "select distinct a.*,(select count(pdf.desig_id) from pms_designation_to_function pdf where pdf.desig_id=a.desig_id) as total_count from pms_designation a left join pms_designation_to_function b on a.desig_id=b.desig_id ";
		$cond='';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and a.desig_name like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.desig_name like '%" . $searchterm . "%'";
			}  
		} 

		if($func_id!='')
		{
			if($cond!=''){
				$cond.=" and b.func_id=" . $func_id;
			} 
			else{
				$cond=" b.func_id=" . $func_id;
			}  
		}

		if($job_cat_id!='')
		{
			if($cond!=''){
				$cond.=" and b.func_id in (select fc.func_id from pms_job_func_to_category fc where fc.job_cat_id=" . $job_cat_id.") ";
			} 
			else{
				$cond.=" b.func_id in (select fc.func_id from pms_job_func_to_category fc where fc.job_cat_id=" . $job_cat_id.") ";
			}  
		}	
						
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by a.desig_name ".$sort_by." limit ".$start.",".$limit;
		
		//echo $sql;
		//exit();
		
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

    function get_desig($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select a.*,c.job_cat_id from pms_designation a left join  pms_job_functional_area b on a.func_id=b.func_id left join pms_job_category c on b.job_cat_id=c.job_cat_id where a.desig_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row;
			}else
			{
				return '';
			}
	}

	function cur_func_list($desig_id)
	{
		$query = $this->db->query('select func_id from pms_designation_to_function where desig_id='.$desig_id);
		$dropdowns = $query->result();
		$dropDownList=array();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[] = $dropdown->func_id;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	   
	
	function insert_record()
    {
		$data=array(
		'desig_name'     =>   trim($this->input->post('desig_name')),
		);
        $this->db->insert($this->table_name, $data);
		$desig_id= $this->db->insert_id();
	   		
		$func_id=$this->input->post('func_id');
		if(is_array($func_id))
		{
			foreach($func_id as $key => $val)
			{
				$data =array(
				'desig_id'=> $desig_id,
				'func_id'=> $val,
				);
				$this->db->insert('pms_designation_to_function', $data);
			}			
		}
		return $desig_id;
    }

	
	function update_record($id=NULL)
	{
		$data=array(
		'desig_name'      =>   trim($this->input->post('desig_name')),
		);
       $this->db->where('desig_id', $id);
	   $this->db->update($this->table_name, $data);

	   $this->db->where('desig_id', $id);
	   $this->db->delete('pms_designation_to_function');
	   $func_id=$this->input->post('func_id');

		if(is_array($func_id))
		{
			foreach($func_id as $key => $val)
			{
				$data =array(
				'desig_id'=> $id,
				'func_id'=> $val,
				);
				$this->db->insert('pms_designation_to_function', $data);
			}			
		}
	}
		
	function job_cat_list()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Industry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function all_func_list()
	{
		$dropDownList=array();
		$finalDropDown =array();
		$dropDownList['']='Select Functional Area';
		$query = $this->db->query('select distinct func_id, func_area from pms_job_functional_area order by func_area asc');
		$dropdowns = $query->result();
		
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->func_id] = $dropdown->func_area;
		}	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_functional_by_industry($job_cat_id='')
    {
		$query=$this->db->query("select distinct a.func_id, a.func_area from pms_job_functional_area a inner join pms_job_func_to_category b on a.func_id=b.func_id where b.job_cat_id=".$job_cat_id." order by a.func_area");
		$state_ist = $query->result();
		$dropDownList['']='Select Functional Area';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->func_id] = $dropdown->func_area;
		}		
		return $dropDownList;
    }

}
?>