<?php 
class Compliantprioritymodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
	
    function __construct()
    {
		$this->table_name='pms_tickets_priority';
    }
	
	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as ticket_priority_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" ticket_priority_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['ticket_priority_id'];
	
	}

	function get_list($no_rec, $offset)
    {
       	$query=$this->db->query("select * from pms_tickets_priority");
		return $query->result_array();
    }
    
	function get_all($start,$limit,$searchterm,$sort_by)
	{
	$sql="select * from ".$this->table_name;
	$cond='';
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	} 
	else{
	$cond=" ticket_priority_name like '%" . $searchterm . "%'";
	}  
	} 
	$cond="ticket_priority_name like '%" . $searchterm . "%'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by ticket_priority_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}	
    
	function insert_record()
    {
	
		$data=array(
		
				'ticket_priority_name'=> $this->input->post('ticket_priority_name'),
				'status' =>    $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		
	
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
			        'ticket_priority_id'=>$this->input->post('ticket_priority_id'),
					'ticket_priority_name'=>$this->input->post('ticket_priority_name'),
					'status'=> $this->input->post('status'),
		           );

       $this->db->where('ticket_priority_id', $this->input->post('ticket_priority_id'));
	   $this->db->update($this->table_name, $data);
	   
	  
	}
	
	
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_leads','key' => 'ticket_priority_id','Module'=>'Leads'));
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
	

	function is_used($id=null)
	{
		if($id=='') return false;
		
		$query = $this->db->query("select * from pms_tickets_priority where tech_id=".$id);	
		if ($query->num_rows() > 0)
		{
			
			return true;
		}else
		{
			return false;
		}
	}

	
    
	function check_dups($name='',$id='')
	{
		$this->db->query('ticket_priority_name', $name);
		if($id!='')	$this->db->where('ticket_priority_id !=', $id);		
		$query = $this->db->get('pms_opportunity');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
	
	 function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('ticket_priority_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>
