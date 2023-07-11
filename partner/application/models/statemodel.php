<?php 
class Statemodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_state';
    }
	
	function record_count() 
	{
        return $this->db->count_all($this->table_name);
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
       	$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id order by b.state_name");
		return $query->result_array();
    }
    
	function get_all()
    {
       	$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id order by b.state_name");
		
		return $query->result_array();
    }	
	
	function state_list($country_id='')
    {

		if($country_id !='')
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id inner join pms_city c ON                                  a.state_id = c.state_id where a.country_id=".$country_id." order by b.state_name");
		else
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id inner join pms_city c ON                                 a.state_id = c.state_id order by b.state_name");
					
		$state_ist = $query->result();
		
		
		$dropDownList['']='Select State';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->state_id] = $dropdown->state_name;
		}
		
		return $dropDownList;
    }	
  function state_list_by_city($country_id='')
    {

		if($country_id !='')
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id inner join pms_city c ON a.state_id=c.state_id where a.country_id=".$country_id." order by b.state_name");
		else
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id  inner join pms_city c ON a.state_id=c.state_id order by b.state_name");
					
		$state_ist = $query->result();
		
		
		$dropDownList['']='Select State';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->state_id] = $dropdown->state_name;
		}
		
		return $dropDownList;
    }	
	
	

	function insert_record()
    {
		$data=array(
		'state_name'=> $this->input->post('state_name'),
		'country_id'=> $this->input->post('country_id'),
		'sort_order'=> $this->input->post('sort_order'),
		'status'=> $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		
		if($id!='')
		{
			$data=array(
			'state_id'=> $id,
			'state_name'=> $this->input->post('state_name'),
			'language_id'=> '1'
			);
			$this->db->insert('pms_state_description', $data);			
		}
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		'state_name'=> $this->input->post('state_name'),
		'country_id'=> $this->input->post('country_id'),
		'sort_order'=> $this->input->post('sort_order'),
		'status'=> $this->input->post('status')
		);

       $this->db->where('state_id', $this->input->post('state_id'));
	   $this->db->update($this->table_name, $data);
	   
	   $this->db->where('state_id', $this->input->post('state_id'));
	   $this->db->delete('pms_state_description'); 

	   $data=array(
	   'state_id'=> $this->input->post('state_id'),
	   'state_name'=> $this->input->post('state_name'),
	   'language_id'=> '1'
	   );

		$this->db->insert('pms_state_description', $data);		
		$this->load->library('upload');	
	}
	
	/*function delete($id=null)
	{
		if($id=='') return false;		

		$this->db->where('state_id', $id);
		$this->db->delete('pms_state'); 
		$this->db->where('state_id', $id);
		$this->db->delete('pms_state_description'); 
	}*/
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_city','key' => 'state_id','Module'=>'City'));
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
	/*function delete($id=null)
	{
		if($id=='') return false;		
		
		if($this->is_related($id)){
			return 2;
		}else{
			$this->db->where('state_id', $id);
			$this->db->delete('pms_state'); 
			$this->db->where('state_id', $id);
			$this->db->delete('pms_state_description'); 
			return 1;
		}
		

	}*/
	
	function delete_record($id)

	{
			$this->db->where('state_id', $id);
			$this->db->delete('pms_state'); 
			$this->db->where('state_id', $id);
			$this->db->delete('pms_state_description'); 
			return 1;
	}
	
	function check_dups($name='',$id='')
	{
		$this->db->query('state_name', $name);
		if($id!='')	$this->db->where('state_id !=', $id);		
		$query = $this->db->get('pms_state_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
}
?>
