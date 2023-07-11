<?php 
class Branchmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_branch';
    }
	
	function insert_record()
    {
		$data=array(
		'branch_name'=> $this->input->post('branch_name'),
		'branch_code'=> $this->input->post('branch_code'),
		'status'=> $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
	
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		'branch_name'=> $this->input->post('branch_name'),
		'status'=> $this->input->post('status')
		);

       $this->db->where('branch_id', $this->input->post('branch_id'));
	   $this->db->update($this->table_name, $data);	  		
	   $this->load->library('upload');	
	}
	
	function delete($id=null)
	{
		if($id=='') return false;		
		$this->db->where('branch_id', $id);
		$this->db->delete('pms_branch');		
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('branch_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_state','key' => 'branch_id','Module'=>'Branch'));
		$is_related = FALSE;
		foreach($master_tables as $table){
			$query=$this->db->query("select * from ".$table['table']." where ".$table['key']."=".$id);
			$num_rows = (int) $query->num_rows();
			if($num_rows){
				$is_related = TRUE;
				$_SESSION['related_module'] = $table['Module'];
				break;
			}
		}
		return $is_related;
	}

	
	function check_dups($name='',$id='')
	{
		$this->db->query('branch_name', $name);
		if($id!='')	$this->db->where('branch_id !=', $id);		
		$query = $this->db->get('pms_branch_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
	
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as branch_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" branch_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['branch_id'];
				
		
	}
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select * from ".$this->table_name;
		$cond='';
		
		
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" branch_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by branch_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	
}
?>