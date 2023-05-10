<?php 
class Citymodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_city';
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
       	$query=$this->db->query("select a.*,b.* from pms_city a inner join pms_city_description b ON a.city_id=b.city_id order by b.city_name");
		return $query->result_array();
    }
    
	function get_all()
    {
       	$query=$this->db->query("select a.*,b.* from pms_city a inner join pms_city_description b ON a.city_id=b.city_id order by b.city_name");
		return $query->result_array();
    }	
	
	function city_list($state_id='')
    {
		$dropDownList=array();
		$dropDownList['']='Select City';
		
		if($state_id=='')
			return $dropDownList;
		else
	       	$query=$this->db->query("SELECT a . * , b . * FROM pms_city a INNER JOIN pms_city_description b ON a.city_id= b.city_id where a.state_id=".$state_id." order by b.city_name");	
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
    }	
	
	function city_list_by_state($state_id='')
    {
		$dropDownList=array();
		$dropDownList['0']='Select City';
		
		if($state_id=='')
			return $dropDownList;
		else
	       	$query=$this->db->query("SELECT a . * , b . * FROM pms_city a INNER JOIN pms_city_description b ON a.city_id= b.city_id where a.state_id=".$state_id." order by b.city_name");	
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
    }	
		
	
function get_city_list_by_location()
    {
		$dropDownList=array();
		$dropDownList['']='Select City';
		
       	$query=$this->db->query("select a.*,b.* from pms_city a inner join pms_city_description b ON a.city_id=b.city_id  inner join pms_locations c ON a.city_id=c.city_id order by b.city_name");
		
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
    }	

	function insert_record()
    {
		$data=array(
		//'city_name'=> $this->input->post('city_name'),
		'state_id'=> $this->input->post('state_id'),
		'sort_order'=> $this->input->post('sort_order'),
		'status'=> $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		
		if($id!='')
		{
			$data=array(
			'city_id'=> $id,
			'city_name'=> $this->input->post('city_name'),
			'language_id'=> '1'
			);
			$this->db->insert('pms_city_description', $data);			
		}
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		//'city_name'=> $this->input->post('city_name'),
		'state_id'=> $this->input->post('state_id'),
		'sort_order'=> $this->input->post('sort_order'),
		'status'=> $this->input->post('status')
		);

       $this->db->where('city_id', $this->input->post('city_id'));
	   $this->db->update($this->table_name, $data);
	   
	   $this->db->where('city_id', $this->input->post('city_id'));
	   $this->db->delete('pms_city_description'); 

	   $data=array(
	   'city_id'=> $this->input->post('city_id'),
	   'city_name'=> $this->input->post('city_name'),
	   'language_id'=> '1'
	   );

		$this->db->insert('pms_city_description', $data);		
		$this->load->library('upload');	
	}
	
	/*function delete($id=null)
	{
		if($id=='') return false;		

		$this->db->where('city_id', $id);
		$this->db->delete('pms_city'); 
		$this->db->where('city_id', $id);
		$this->db->delete('pms_city_description'); 
	}*/
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_locations','key' => 'city_id','Module'=>'City'));
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
			$this->db->where('city_id', $id);
			$this->db->delete('pms_city'); 
			$this->db->where('city_id', $id);
			$this->db->delete('pms_city_description');
			return 1;
		}
		

	}*/
	
	
	
	function delete_record($id)

	{
			$this->db->where('city_id', $id);
			$this->db->delete('pms_city'); 
			$this->db->where('city_id', $id);
			$this->db->delete('pms_city_description'); 
			return 1;
	}
	function check_dups($name='',$id='')
	{
		$this->db->query('city_name', $name);
		if($id!='')	$this->db->where('city_id !=', $id);		
		$query = $this->db->get('pms_city_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
}
?>
