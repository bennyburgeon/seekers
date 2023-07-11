<?php 
class Salespersonmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='tally_sales_man';
    }
	
	function insert_record()
    {
		$data=array(
		'user_name'=> $this->input->post('user_name'),
		'user_login'=> $this->input->post('user_login'),
		'user_password'=> $this->input->post('user_password'),		
		'user_status'=> $this->input->post('user_status')
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
	
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		'user_name'=> $this->input->post('user_name'),
		'user_login'=> $this->input->post('user_login'),	
		'user_password'=> $this->input->post('user_password'),
		'user_status'=> $this->input->post('user_status'),
		);

       $this->db->where('user_id', $this->input->post('user_id'));
	   $this->db->update($this->table_name, $data);	  		
	   $this->load->library('upload');	
	}
	
	function delete($id=null)
	{
		if($id=='') return false;		
		$this->db->where('user_id', $id);
		$this->db->delete('tally_sales_man');		
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('user_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_state','key' => 'user_id','Module'=>'Sales Person'));
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
		$this->db->query('user_name', $name);
		if($id!='')	$this->db->where('user_id !=', $id);		
		$query = $this->db->get('tally_sales_man_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
	
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as user_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" user_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['user_id'];
				
		
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
				$cond=" user_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by user_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
	
	
}
?>