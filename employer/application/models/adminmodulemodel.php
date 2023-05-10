<?php

class Adminmodulemodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	var $modules;

	function __construct()
	{
		$this->table_name = "pms_admin_modules";
		//$this->event_feature_table = "event_to_feature";
	}
	
	/*function get_list()
	{
		$query = $this->db->query("select 	module_id, module_name from ".$this->table_name);
		return $query->result_array();
	}*/
	

	function categoryChild($id,$arrcount=0) {
	    $query = $this->db->query("select module_id, module_name,module_class,status from ".$this->table_name."  where parent_id = $id ORDER BY `module_order` ASC");
		$module_list= $query->result();
		$children = array();
		$count = 0;
        # It has children, let's get them.
	
        foreach($module_list as $row)
		{
			$count++;
			$countdata = ($arrcount)?$arrcount.".".$count:$count;
            # Add the child to the list of children, and get its subchildren
            $children[$row->module_id] = array("count"=>$countdata,
												"id"=>$row->module_id,
												"name" =>$row->module_name,
												"module_class" =>$row->module_class,
												"status" =>$row->status,
												"sub"=>$this->categoryChild($row->module_id,$countdata));
        }
   	 return $children;
	}
	
	
	function categoryChild_($id,$arrcount=0,$start,$limit,$searchterm,$sort_by) {
	    $query = $this->db->query("select module_id, module_name,module_class,status from pms_admin_modules  where parent_id = ".$id." and module_name like '%" . $searchterm . "%' order by module_order ".$sort_by." limit ".$start.",".$limit);
		
		$module_list= $query->result();
		$children = array();
		$count = 0;
        # It has children, let's get them.
	
        foreach($module_list as $row)
		{
			$count++;
			$countdata = ($arrcount)?$arrcount.".".$count:$count;
            # Add the child to the list of children, and get its subchildren
            $children[$row->module_id] = array("count"=>$countdata,
												"id"=>$row->module_id,
												"name" =>$row->module_name,
												"module_class" =>$row->module_class,
												"status" =>$row->status,
												"sub"=>$this->categoryChild($row->module_id,$countdata,$start,$limit,$searchterm,$sort_by));
        }
   	 return $children;
	}
	function record_count($id,$arrcount=0,$start,$limit,$searchterm,$sort_by) {
		if($searchterm== ''){
			$query = $this->db->query("select module_id, module_name,module_class,status from pms_admin_modules  where parent_id = ".$id);
		}
		else{
	    	$query = $this->db->query("select module_id, module_name,module_class,status from pms_admin_modules  where parent_id = ".$id." and module_name like '%" . $searchterm . "%'");
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
            $children[$row->module_id] = array("count"=>$countdata,
												"id"=>$row->module_id,
												"name" =>$row->module_name,
												"module_class" =>$row->module_class,
												"status" =>$row->status,
												"sub"=>$this->record_count($row->module_id,$countdata,$start,$limit,$searchterm,$sort_by));
        }
   	 //return count($module_list);
	 return $count;
	}
	function record_count__($searchterm) 
	{
	
		$sql	= "select count(*)as module_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" module_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['module_id'];
				
		
	}
	function get_list($id,$arrcount=0,$start,$limit,$searchterm,$sort_by)
    {
		$sql="select module_id, module_name,module_class,status from ".$this->table_name;
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" parent_id =".$id." and type_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by module_order ".$sort_by." limit ".$start.",".$limit;
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
            $children[$row->module_id] = array("count"=>$countdata,
												"id"=>$row->module_id,
												"name" =>$row->module_name,
												"module_class" =>$row->module_class,
												"status" =>$row->status,
												"sub"=>$this->categoryChild($row->module_id,$countdata,'','','',''));
        }
   	 return $children;
		
    }	





	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('module_id'=>$id));
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
				"module_name" => $this->input->post("module_name"),
				"parent_id" =>  $this->input->post("parent_id"),
				"module_url" =>  $this->input->post("module_url"),
				"module_description" =>  $this->input->post("module_description"),
				"module_order" => $this->input->post("module_order"),
				"module_class" => $this->input->post("module_class"),
				"status" => $this->input->post("status"),
				);
	   $this->db->where('module_id', $this->input->post('module_id'));
	   $this->db->update($this->table_name, $data);
	}

	function delete_record($id)
	{
		$this->db->query("delete from ".$this->table_name." where module_id=".$id);
		return 1;
	}

	function module_ddl()
	{
		$query=$this->db->query("select module_id, module_name from ".$this->table_name ." where status=1");
		$module_list = $query->result();
		$dropDownList[0]='Select Module';
		foreach($module_list as $dropdown)
		{
			$dropDownList[$dropdown->module_id] = $dropdown->module_name;
		}
		return $dropDownList;
	}
	function module_ddl_parent()
	{
		$query=$this->db->query("select module_id, module_name from ".$this->table_name ." where status=1 AND parent_id=0 ORDER BY module_name ASC");
		$module_list = $query->result();
		$dropDownList[0]='Select Module';
		foreach($module_list as $dropdown)
		{
			$dropDownList[$dropdown->module_id] = $dropdown->module_name;
		}
		return $dropDownList;
	}
}
?>