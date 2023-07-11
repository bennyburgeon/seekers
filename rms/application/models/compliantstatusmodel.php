<?php 
class Compliantstatusmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
	
    function __construct()
    {
		$this->table_name='pms_tickets_status';
    }
	
	function record_count() 
	{
        return $this->db->count_all($this->table_name);
    }

	function get_list($no_rec, $offset)
    {
       	$query=$this->db->query("select * from pms_tickets_status");
		return $query->result_array();
    }
    
	function get_all()
    {
       	$query=$this->db->query("select * from pms_tickets_status");
		return $query->result_array();
    }	
    
	function insert_record()
    {
	
		$data=array(
		
				'ticket_status_name'=> $this->input->post('ticket_status_name'),
				'status' =>    $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		
	
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		
				'ticket_status_name'=> $this->input->post('ticket_status_name'),
				
				
		);

       $this->db->where('ticket_status_id', $this->input->post('ticket_status_id'));
	   $this->db->update($this->table_name, $data);
	   
	  
	}
	
	
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_leads','key' => 'ticket_status_id','Module'=>'Leads'));
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
		
		$query = $this->db->query("select * from pms_tickets_status where tech_id=".$id);	
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
		$this->db->query('ticket_status_name', $name);
		if($id!='')	$this->db->where('ticket_status_id !=', $id);		
		$query = $this->db->get('pms_tickets_status');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
}
?>
