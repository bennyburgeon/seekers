<?php 
class interviewtypemodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_candidate_interview_types';
    }
	
	function record_count($searchterm) 
	{
		$sql = "select count(*) as interview_type_id from ".$this->table_name;
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" interview_type like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['interview_type_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="select * from ".$this->table_name;
	$cond='';
	if($searchterm!='')
	{
		if($cond!='')
		{
		//$cond.=" and candidate_id=".$candidateId;
		} 
		else
		{
			$cond=" interview_type like '%" . $searchterm . "%'";
		}  
	} 
		$cond="interview_type like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
	
		$sql.=" order by interview_type_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	function get_type_list()
	{
		$query = $this->db->query('SELECT interview_type_id,interview_type FROM `pms_candidate_interview_types` order by interview_type asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Interview Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->interview_type_id] = $dropdown->interview_type;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	
	
	
	
    
	function insert_record()
    {
		$data=array(
		'interview_type'=>$this->input->post('interview_type')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'interview_type'=>$this->input->post('interview_type')
		);

       $this->db->where('interview_type_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	function check_dup()
	{
		$this->db->where('interview_type', $this->input->post('interview_type'));
		if($this->input->get('interview_type_id') > 0)	$this->db->where('interview_type_id !=', $this->input->get('interview_type_id'));
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