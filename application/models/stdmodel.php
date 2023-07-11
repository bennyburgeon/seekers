<?php 
class stdmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_study_mode';
    }
	
	function record_count($searchterm) 
	{
		if($searchterm== ''){
			$query=$this->db->query("select count(*)as mode_id from ".$this->table_name);			
			$row=$query->row_array();
			return $row['mode_id'];
		}
		else{
			$query=$this->db->query("select count(*)as mode_id from ".$this->table_name." where mode_name like '%" . $searchterm . "%'");			
			$row=$query->row_array();
			return $row['mode_id'];
			}
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
    {
     		
			$query=$this->db->query("select * from pms_study_mode where mode_name like '%" . $searchterm . "%' order by mode_name ".$sort_by." limit ".$start.",".$limit);
		
		return $query->result_array();
    }
    
	function insert_record()
    {
		$data=array(
		'mode_name'=>$this->input->post('mode_name'),
		'mode_desc'=>$this->input->post('mode_desc')
		);
        $this->db->insert($this->table_name, $data);
		return $this->db->insert_id();
    }
	function update_record($id=NULL)
	{
		$data=array(
		'mode_name'=>$this->input->post('mode_name'),
		'mode_desc'=>$this->input->post('mode_desc')
		);

       $this->db->where('mode_id', $id);
	   $this->db->update($this->table_name, $data);

	}
	
	function check_dup()
	{
		$this->db->where('mode_name', $this->input->post('mode_name'));
		if($this->input->get('id') > 0)	$this->db->where('mode_id !=', $this->input->get('id'));
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('modename', 'That name already used.');
			return false;
		}
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('mode_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>