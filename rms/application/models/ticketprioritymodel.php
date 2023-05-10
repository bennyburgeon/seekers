<?php 
class ticketprioritymodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_tickets_priority';
    }
	
	function record_count($searchterm) 
	{
	
		$sql	= "select count(*)as ticket_priority_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
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
				$cond=" ticket_priority_name like '%" . $searchterm . "%'";
			}		
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by ticket_priority_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }
    
	function insert_record()
    {
		$data=array(
			'ticket_priority_name'=> $this->input->post('ticket_priority_name'),
			'status'=> $this->input->post('status')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
			'ticket_priority_name'=> $this->input->post('ticket_priority_name'),
			'status'=> $this->input->post('status')
		);

       $this->db->where('ticket_priority_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	function check_dup()
	{
		$this->db->where('ticket_priority_name', $this->input->post('ticket_priority_name'));
		if($this->input->get('id') > 0)	$this->db->where('ticket_priority_id !=', $this->input->get('id'));
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('typename', 'That name already used.');
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