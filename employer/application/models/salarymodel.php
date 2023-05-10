<?php 
class salarymodel extends CI_Model {

	var $table_name='';

    function __construct()
    {
		$this->table_name='pms_job_salary';
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
		
		$query = $this->db->query("select salary_amount from pms_job_salary where salary_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['salary_amount'];
			}else
			{
				return '';
			}
	}
	
	function insert_record()
    {
		$data=array(
		'salary_amount'=>$this->input->post('salary_amount'),
		'salary_desc'=>$this->input->post('salary_desc')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'salary_amount'=>$this->input->post('salary_amount'),
		'salary_desc'=>$this->input->post('salary_desc')
		);
       $this->db->where('salary_id', $id);
	   $this->db->update($this->table_name, $data);
	}
}
?>