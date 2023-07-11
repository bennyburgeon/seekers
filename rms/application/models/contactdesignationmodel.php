<?php 
class Contactdesignationmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_contact_designation';
    }
	

	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as des_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" des_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['des_id'];
	
	}

	function record_count_all() 
	{
		// write some other logic
        return $this->db->count_all($this->table_name);
    }
	
	function record_count_criteria() 
	{
        // write proper script for this.
		return $this->db->count_all($this->table_name);
    }


	function get_list($no_rec, $offset)
    {                         
       	$query=$this->db->query("SELECT * FROM `pms_contact_designation`");
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
	$cond=" des_name like '%" . $searchterm . "%'";
	}  
	} 
	$cond="des_name like '%" . $searchterm . "%'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by des_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	
	function designation_list()
    {
       	$query=$this->db->query("SELECT * FROM `pms_contact_designation`");
		$state_ist = $query->result();
		$dropDownList['']='Select Designation';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->des_id] = $dropdown->des_name;
		}
		return $dropDownList;
    }	
	
	function insert_record()
    {
		$data=array(		
		'des_name'=> $this->input->post('des_name'),		
		'status'=> $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);		
		
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		
		'des_name'=> $this->input->post('des_name'),		
		'status'=> $this->input->post('status')		
		);

       $this->db->where('des_id', $this->input->post('des_id'));
	   $this->db->update($this->table_name, $data);
	   
		
			
	}
	
	
	function delete($id=null)
	{
		if($id=='') return false;		
		
		else{
			$this->db->where('des_id', $id);
			$this->db->delete('pms_contact_designation'); 					
			return 1;
		}
		
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('des_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	function check_dups($name='',$id='')
	{
		$this->db->query('des_name', $name);
		if($id!='')	$this->db->where('des_id !=', $id);		
		$query = $this->db->get('pms_contact_designation');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
}
?>
