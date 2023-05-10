<?php
class Skill_mgmt_model extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	var $modules;

	function __construct()
	{
		$this->table_name = "pms_candidate_skills";
		//$this->event_feature_table = "event_to_feature";
	}	
	
	function record_count( $searchterm, $job_cat_id, $func_id, $desig_id) 
	{
		$sql	= "select count(*)as total_records from ".$this->table_name." a left join pms_designation b on a.desig_id=b.desig_id ";
		$cond	= '';		

		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" a.skill_name like '%".$searchterm."%'";
			}
			else{
				$cond=" a.skill_name like '%".$searchterm."%'";
			}	
		} 

		if($desig_id!='')
		{
			if($cond!=''){
				$cond.=" and a.desig_id=" . $desig_id;
			} 
			else{
				$cond=" a.desig_id=" . $desig_id;
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
				$cond.=" and b.func_id in (select ftc.func_id from pms_job_func_to_category ftc where ftc.job_cat_id=" . $job_cat_id.")";
			} 
			else{
				$cond.=" b.func_id in (select ftc.func_id from pms_job_func_to_category ftc where ftc.job_cat_id=" . $job_cat_id.")";
			}  
		}		
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['total_records'];
	}
	
	function get_list($start, $limit, $sort_by, $searchterm, $job_cat_id, $func_id, $desig_id)
    {		
		$sql="select a.*,b.desig_name from ".$this->table_name." a left join pms_designation b on a.desig_id=b.desig_id ";
		$cond='';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" a.skill_name like '%".$searchterm."%'";
			}
			else{
				$cond=" a.skill_name like '%".$searchterm."%'";
			}	
		} 

		if($desig_id!='')
		{
			if($cond!=''){
				$cond.=" and a.desig_id=" . $desig_id;
			} 
			else{
				$cond=" a.desig_id=" . $desig_id;
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
					$cond.=" and b.func_id in (select ftc.func_id from pms_job_func_to_category ftc where ftc.job_cat_id=" . $job_cat_id.")";
				} 
				else{
					$cond.=" b.func_id in (select ftc.func_id from pms_job_func_to_category ftc where ftc.job_cat_id=" . $job_cat_id.")";
				}  
			}						
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		//echo $sql;
		//exit();
		$sql.=" order by skill_name ".$sort_by." limit ".$start.",".$limit;
		
		$query = $this->db->query($sql);
		$module_list= $query->result_array();
		
	   	return $module_list;
		
    }

	function single_record($id)
	{
		$sql="select a.*, b.func_id, d.job_cat_id from ".$this->table_name." a left join pms_designation b on a.desig_id=b.desig_id left join pms_job_functional_area c on b.func_id=c.func_id left join pms_job_func_to_category d on d.func_id=c.func_id where a.skill_id=".$id;
		
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	function insert_record($data)
	{ 
		
		$this->db->insert($this->table_name,$data);		
		$skill_id=$this->db->insert_id();
		
	   $this->db->where('skill_id', $skill_id);
	   $this->db->delete('pms_skills_to_designation');
	   		
		$desig_id=$this->input->post('desig_id');
		if(is_array($desig_id))
		{
			foreach($desig_id as $key => $val)
			{
				$data =array(
				'skill_id'=> $skill_id,
				'desig_id'=> $val,
				);
				$this->db->insert('pms_skills_to_designation', $data);
			}			
		}
		return $skill_id;		
	}

	function update_record()
	{
		$skill_id=$this->input->post('skill_id');
		
		$data = array(
				"skill_name" => $this->input->post("skill_name"),
				"parent_skill" =>  $this->input->post("parent_skill"),
				"active" => $this->input->post("active"),
				);
	   $this->db->where('skill_id', $skill_id);
	   $this->db->update($this->table_name, $data);
	   
	   $this->db->where('skill_id', $skill_id);
	   $this->db->delete('pms_skills_to_designation');
	   		
		$desig_id=$this->input->post('desig_id');
		if(is_array($desig_id))
		{
			foreach($desig_id as $key => $val)
			{
				$data =array(
				'skill_id'=> $skill_id,
				'desig_id'=> $val,
				);
				$this->db->insert('pms_skills_to_designation', $data);
			}			
		}
		
		return;
		
	}

	function delete_record($id)
	{		
		$result = $this->db->query('SELECT * FROM '.$this->table_name.' WHERE parent_skill ='.$id)->result();
		if(empty($result))
			{				
				$this->db->query("delete from ".$this->table_name." where skill_id=".$id);
				$this->db->query("delete from pms_skills_to_designation where skill_id=".$id);
				return 1;
			}else
			{
				return 3;
			}	
	}

	function cur_desig_list($skill_id)
	{
		$query = $this->db->query('select desig_id from pms_skills_to_designation where skill_id='.$skill_id);
		$dropdowns = $query->result();
		$dropDownList=array();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[] = $dropdown->desig_id;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	
	
	function module_ddl()
	{
		$query=$this->db->query("select skill_id, skill_name from ".$this->table_name ." where active=1");
		$module_list = $query->result();
		$dropDownList[0]='Select Skill';
		foreach($module_list as $dropdown)
		{
			$dropDownList[$dropdown->skill_id] = $dropdown->skill_name;
		}
		return $dropDownList;
	}
	function module_ddl_parent()
	{
		$query=$this->db->query("select skill_id, skill_name from ".$this->table_name ." where active=1 AND parent_skill=0 ORDER BY skill_name ASC");
		$module_list = $query->result();
		$dropDownList[0]='Select Parent Skill';
		foreach($module_list as $dropdown)
		{
			$dropDownList[$dropdown->skill_id] = $dropdown->skill_name;
		}
		return $dropDownList;
	}
	
	function get_all_records($id_arr)
    {
		$ids_array = array();

		foreach ($id_arr as $id) 
		{			
			$query = $this->db->query("select * from pms_candidate_to_skills where skill_id=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				 $this->db->where('skill_id',$id);
				 $this->db->delete($this->table_name);
			}
		}
		return $ids_array;
		
    }
	
	function get_all_records1($id_arr)
    {
		$ids_array = array();

		foreach ($id_arr as $id) 
		{			
			$query = $this->db->query("select * from pms_job_to_skill where skill_id=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				$this->db->where('skill_id',$id);
			    $this->db->delete($this->table_name);
			}
		}
		return $ids_array;
		
    }
	
	 function get_skill_name($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select skill_name from pms_candidate_skills where skill_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['skill_name'];
			}else
			{
				return '';
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
	
	function func_list()
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
	

	function all_designation()
    {
		$query=$this->db->query("select distinct desig_id, desig_name from pms_designation order by desig_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Designation';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->desig_id] = $dropdown->desig_name;
		}		
		return $dropDownList;
    }
		
	function get_designation_by_function($func_id='')
    {
		$query=$this->db->query("select distinct desig_id, desig_name from pms_designation where func_id=".$func_id." order by desig_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Designation';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->desig_id] = $dropdown->desig_name;
		}		
		return $dropDownList;
    }
	
	function categoryChild($id,$arrcount=0) {
	    $query = $this->db->query("select skill_id, skill_name,active from ".$this->table_name."  where parent_skill = $id ORDER BY `skill_name` ASC");
		$module_list= $query->result();
		$children = array();
		$count = 0;
        # It has children, let's get them.
	
        foreach($module_list as $row)
		{
			$count++;
			$countdata = ($arrcount)?$arrcount.".".$count:$count;
            # Add the child to the list of children, and get its subchildren
            $children[$row->skill_id] = array("count"=>$countdata,
												"id"=>$row->skill_id,
												"name" =>$row->skill_name,												
												"active" =>$row->active,
												"sub"=>$this->categoryChild($row->skill_id,$countdata));
        }
   	 return $children;
	}
	
}
?>
