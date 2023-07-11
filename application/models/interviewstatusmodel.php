<?php 
class interviewstatusmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_candidate_interview_status';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "select count(*) as int_status_id from ".$this->table_name;
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" int_status_name like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['int_status_id'];
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
	$cond=" int_status_name like '%" . $searchterm . "%'";
	}  
	} 
	$cond="int_status_name like '%" . $searchterm . "%'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by int_status_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}

	
		function get_model_list()
	{
		$query = $this->db->query('SELECT int_status_id,int_status_name FROM `pms_candidate_interview_status` order by int_status_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Interview Status';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->int_status_id] = $dropdown->int_status_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	
    
	function insert_record()
    {
		$data=array(
		'int_status_name'=>$this->input->post('int_status_name')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	
	function update_record($id=NULL)
	{
		$data=array(
		'int_status_name'=>$this->input->post('int_status_name')
		);

       $this->db->where('int_status_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	
	function check_dup()
	{
		$this->db->where('int_status_name', $this->input->post('int_status_name'));
		if($this->input->get('int_status_id') > 0)	$this->db->where('int_status_id !=', $this->input->get('int_status_id'));
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