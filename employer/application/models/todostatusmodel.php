<?php 
class Todostatusmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
	
    function __construct()
    {
		$this->table_name='pms_todo_status';
    }
	
	function record_count($searchterm) 
	{
		
			if($searchterm==''){
		$sql="select count(*)as status_id from pms_todo_status";
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['status_id'];
		}
		else{
		$sql="select count(*)as status_id from pms_todo_status where status_name like '%" . $searchterm . "%'";
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['status_id'];
	}
	
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
    {
				
		$sql="select * from pms_todo_status where status_name like '%" . $searchterm . "%' ";
		$sql.=" order by status_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
  
    }
	
	function insert_record()
    {
		$data=array(
		'status_id'   =>$this->input->post('status_id'),	
		'status_name'  => $this->input->post('status_name'),	
		//'active'=> $this->input->post('active')
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		'status_id'=>$this->input->post('status_id'),	
		'status_name'  => $this->input->post('status_name'),	
		//'active'=> $this->input->post('active')
		);

       $this->db->where('status_id', $this->input->post('status_id'));
	   $this->db->update($this->table_name, $data);
	}
	
	function delete($id=null)
	{
		if($id=='') return false;
		
		$query = $this->db->query("select * from ".$this->table_name." where status_id=".$id);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();

			//if($this->is_used($id)==true)return $row['status_name'];
			
			
		}		
				
		$this->db->where('status_id', $id);
		$this->db->delete('pms_todo_status'); 
		
		return true;
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('status_id',$id);
			$this->db->delete($this->table_name);
		}	
    }

	function leadfolder_array($id='')
    {
		if($id!='')
			$query = $this->db->query("SELECT a.category_id,b.category_name FROM `pms_category` a inner join pms_category_description b on a.category_id=b.category_id where a.parent_id=0 and a.category_id <> " .$id. " order by b.category_name ");			
		else
			$query = $this->db->query("SELECT a.category_id,b.category_name FROM `pms_category` a inner join pms_category_description b on a.category_id=b.category_id where a.parent_id=0 order by b.category_name");					
			
		$parent_list = $query->result();
		$final_list=array();
		foreach($parent_list as $item)		
		{
			if($id!='')
				$query = $this->db->query("SELECT a.category_id,b.category_name FROM `pms_category` a inner join pms_category_description b on a.category_id=b.category_id where a.parent_id=".$item->category_id." and a.category_id <> ".$id." order by b.category_name");
			else
				$query = $this->db->query("SELECT a.category_id,b.category_name FROM `pms_category` a inner join pms_category_description b on a.category_id=b.category_id where a.parent_id=".$item->category_id." order by b.category_name");			
				
			$child_list = $query->result();
			$node=array();

			foreach($child_list as $child)		
			{
				$node[$child->category_id] = $child->category_name;
			}
			$final_list[]=array('id' => $item->category_id,'name'=> $item->category_name, 'child' => $node);
			
		}
		return $final_list;
    }
    
	function check_dups($name='',$id='')
	{
		$this->db->query('status_name', $name);
		if($id!='')	$this->db->where('status_id !=', $id);		
		$query = $this->db->get('pms_todo_status');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
}
?>