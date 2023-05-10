<?php 
class Opportunitymodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_opportunity';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "select count(*)as opp_id from ".$this->table_name;
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" opp_name like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['opp_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
		$sql="select * from ".$this->table_name;
		$cond='';
		if($searchterm!='')
		{
		if($cond!=''){
		//$cond.=" and candidate_id=".$candidateId;
		} 
		else{
		$cond=" opp_name like '%" . $searchterm . "%'";
		}  
		} 
		$cond="opp_name like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by opp_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}
    
	function insert_record()
    {
		$data=array(
		'opp_name'=>$this->input->post('opp_name'),
		//'status'=>$this->input->post('status')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'opp_name'=>$this->input->post('opp_name'),
		//'status'=>$this->input->post('status')
		);

       $this->db->where('opp_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	
	function check_dup()
	{
		$this->db->where('opp_name', $this->input->post('opp_name'));
		if($this->input->get('id') > 0)	$this->db->where('opp_id !=', $this->input->get('id'));
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('typename', 'That name already used.');
			return false;
		}
	}
}
?>