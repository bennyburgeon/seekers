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
	
	/*function get_list()
	{
		$query = $this->db->query("select 	skill_id, skill_name from ".$this->table_name);
		return $query->result_array();
	}*/
	

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
	
	/*
	function categoryChild_($id,$arrcount=0,$start,$limit,$searchterm,$sort_by) {
	    $query = $this->db->query("select skill_id, skill_name,active from pms_candidate_skills  where parent_skill = ".$id." and skill_name like '%" . $searchterm . "%' order by skill_id ".$sort_by." limit ".$start.",".$limit);
		
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
												"sub"=>$this->categoryChild($row->skill_id,$countdata,$start,$limit,$searchterm,$sort_by));
        }
   	 return $children;
	}
	*/
	
	function record_count__($id,$arrcount=0,$start,$limit,$searchterm,$sort_by) {
		if($searchterm== ''){
			$query = $this->db->query("select skill_id, skill_name,active from pms_candidate_skills  where parent_skill = ".$id);
		}
		else{
	    	$query = $this->db->query("select skill_id, skill_name,active from pms_candidate_skills  where parent_skill = ".$id." and skill_name like '%" . $searchterm . "%'");
		}	
		
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
												"sub"=>$this->record_count($row->skill_id,$countdata,$start,$limit,$searchterm,$sort_by));
        }
   	 //return count($module_list);
	 return $count;
	}
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as skill_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond="skill_id =" . $searchterm ;
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['skill_id'];
				
		
	}
	function get_list($id,$arrcount=0,$start,$limit,$searchterm,$sort_by)
    {
		$sql="select skill_id, skill_name,active,parent_skill from ".$this->table_name;
		$cond=' parent_skill=0 ';
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and skill_id=".$searchterm;
			}	
			else{
				$cond="skill_id =" . $searchterm ;
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by skill_name ".$sort_by." limit ".$start.",".$limit;

		
		$query = $this->db->query($sql);
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
												"sub"=>$this->categoryChild($row->skill_id,$countdata,'','','',''));
        }
   	 return $children;
		
    }	


	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('skill_id'=>$id));
		return $query->row_array();
	}

	function insert_record($data)
	{ 
		$this->db->insert($this->table_name,$data);
		return $this->db->insert_id();
	}

	function update_record()
	{
		$data = array(
				"skill_name" => $this->input->post("skill_name"),
				"parent_skill" =>  $this->input->post("parent_skill"),
				//~ "module_url" =>  $this->input->post("module_url"),
				//~ "module_description" =>  $this->input->post("module_description"),
				//~ "module_order" => $this->input->post("module_order"),
				
				"active" => $this->input->post("active"),
				);
	   $this->db->where('skill_id', $this->input->post('skill_id'));
	   $this->db->update($this->table_name, $data);
	}

	function delete_record($id)
	{
		$this->db->query("delete from ".$this->table_name." where skill_id=".$id);
		return 1;
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
	
}
?>
