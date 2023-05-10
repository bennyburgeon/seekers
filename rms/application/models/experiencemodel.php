<?php 
class Experiencemodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_experience';
    }
	
	function record_count() 
	{
        return $this->db->count_all($this->table_name);
    }
    
	function get_list()
    {
       	$query=$this->db->get($this->table_name);
		return $query->result_array();
    }

    function get_salary_range($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select exp_from from pms_job_experience where exp_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['exp_from'];
			}else
			{
				return '';
			}
	}
	
	function insert_record()
    {
		$data=array(
		'exp_range'=>$this->input->post('exp_range')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	
	function update_record($id=NULL)
	{
		$data=array(
		'exp_range'=>$this->input->post('exp_range')
		);
       $this->db->where('exp_id', $id);
	   $this->db->update($this->table_name, $data);
	}
}
?>