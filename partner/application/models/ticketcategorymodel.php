<?php

class Ticketcategorymodel extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	var $modules;

	function __construct()
	{
		$this->table_name = "pms_ticket_category";
		//$this->event_feature_table = "event_to_feature";
	}
	
	/*function get_list()
	{
		$query = $this->db->query("select 	ticket_category_id, category_name from ".$this->table_name);
		return $query->result_array();
	}*/
	

	function categoryChild($id,$arrcount=0) {
	    $query = $this->db->query("select * from ".$this->table_name."  where parent_id = $id ORDER BY `category_order` ASC");
		$module_list= $query->result();
		$children = array();
		$count = 0;
        # It has children, let's get them.
	
        foreach($module_list as $row)
		{
			$count++;
			$countdata = ($arrcount)?$arrcount.".".$count:$count;
            # Add the child to the list of children, and get its subchildren
            $children[$row->ticket_category_id] = array("count"=>$countdata,
												"id"=>$row->ticket_category_id,
												"name" =>$row->category_name,
												"status" =>$row->status,
												"sub"=>$this->categoryChild($row->ticket_category_id,$countdata));
        }
   	 return $children;
	}
	
	
	function categoryChild_($id,$arrcount=0,$start,$limit,$searchterm,$sort_by) {
	    $query = $this->db->query("select ticket_category_id, category_name,status from pms_ticket_category  where parent_id = ".$id." and category_name like '%" . $searchterm . "%' order by category_order ".$sort_by." limit ".$start.",".$limit);
		
		$module_list= $query->result();
		$children = array();
		$count = 0;
        # It has children, let's get them.
	
        foreach($module_list as $row)
		{
			$count++;
			$countdata = ($arrcount)?$arrcount.".".$count:$count;
            # Add the child to the list of children, and get its subchildren
            $children[$row->ticket_category_id] = array("count"=>$countdata,
												"id"=>$row->ticket_category_id,
												"name" =>$row->category_name,
												"status" =>$row->status,
												"sub"=>$this->categoryChild($row->ticket_category_id,$countdata,$start,$limit,$searchterm,$sort_by));
        }
   	 return $children;
	}
	function record_count($id,$arrcount=0,$start,$limit,$searchterm,$sort_by) {
		if($searchterm== ''){
			$query = $this->db->query("select ticket_category_id, category_name,status from pms_ticket_category  where parent_id = ".$id);
		}
		else{
	    	$query = $this->db->query("select ticket_category_id, category_name,status from pms_ticket_category  where parent_id = ".$id." and category_name like '%" . $searchterm . "%'");
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
            $children[$row->ticket_category_id] = array("count"=>$countdata,
												"id"=>$row->ticket_category_id,
												"name" =>$row->category_name,
												"status" =>$row->status,
												"sub"=>$this->record_count($row->ticket_category_id,$countdata,$start,$limit,$searchterm,$sort_by));
        }
   	 //return count($module_list);
	 return $count;
	}
	function record_count__($searchterm) 
	{
	
		$sql	= "select count(*)as ticket_category_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" category_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['ticket_category_id'];
				
		
	}
	function get_list($id,$arrcount=0,$start,$limit,$searchterm,$sort_by)
    {
		$sql="select ticket_category_id, category_name,status from ".$this->table_name;
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
		
		$sql.=" order by category_order ".$sort_by." limit ".$start.",".$limit;
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
            $children[$row->ticket_category_id] = array("count"=>$countdata,
												"id"=>$row->ticket_category_id,
												"name" =>$row->category_name,
												"status" =>$row->status,
												"sub"=>$this->categoryChild($row->ticket_category_id,$countdata,'','','',''));
        }
   	 return $children;
		
    }	





	function single_record($id)
	{
		$query = $this->db->get_where($this->table_name,array('ticket_category_id'=>$id));
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
				"category_name" => $this->input->post("category_name"),
				"parent_id" =>  $this->input->post("parent_id"),
				"category_order" => $this->input->post("category_order"),
				"status" => $this->input->post("status"),
				);
	   $this->db->where('ticket_category_id', $this->input->post('ticket_category_id'));
	   $this->db->update($this->table_name, $data);
	}

	function delete_record($id)
	{
		$this->db->query("delete from ".$this->table_name." where ticket_category_id=".$id);
		return 1;
	}
	
	
	function module_ddl()
	{
		$query=$this->db->query("select ticket_category_id, category_name from ".$this->table_name ." where status=1");
		$module_list = $query->result();
		$dropDownList[0]='Select Module';
		foreach($module_list as $dropdown)
		{
			$dropDownList[$dropdown->ticket_category_id] = $dropdown->category_name;
		}
		return $dropDownList;
	}
	function category_parent()
	{
		$query=$this->db->query("select ticket_category_id, category_name from ".$this->table_name ." where status=1 AND parent_id=0 ORDER BY category_name ASC");
		$module_list = $query->result();
		$dropDownList['']='Select Module';
		foreach($module_list as $dropdown)
		{
			$dropDownList[$dropdown->ticket_category_id] = $dropdown->category_name;
		}
		return $dropDownList;
	}
}
?>