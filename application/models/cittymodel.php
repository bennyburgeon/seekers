<?php 
class Cittymodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_city';
    }
	
	function record_count($country_id,$state_id,$searchterm) 
	{
	
		$sql  = "select count(*)as city_id from ".$this->table_name;
		$sql .= " inner join pms_state c on pms_city.state_id = c.state_id "  ;
		$cond	= '';
		
		if($country_id!='')
		{
			if($cond!=''){
				$cond.=" and c.country_id =".$country_id;
			}
			else{
				$cond =" c.country_id =".$country_id;
			}	
		} 
		
		if($state_id!='')
		{
			if($cond!=''){
				$cond.=" and c.state_id =".$state_id;
			}
			else
			{
				$cond =" c.state_id =".$state_id;
			}	
		} 
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and pms_city.city_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" pms_city.city_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['city_id'];
				
		
	}
	function get_list($start,$limit,$country_id,$state_id,$searchterm,$sort_by)
    { 
		$sql="select a.*,b.* from pms_city a inner join pms_city_description b ON a.city_id=b.city_id  inner join pms_state c on a.state_id = c.state_id " ;
		$cond='';
		if($country_id!='')
		{
			if($cond!=''){
				$cond.=" and c.country_id =".$country_id;
			}
			else{
				$cond =" c.country_id =".$country_id;
			}	
		} 
		
		if($state_id!='')
		{
			if($cond!=''){
				$cond.=" and c.state_id =".$state_id;
			}
			else
			{
				$cond =" c.state_id =".$state_id;
			}	
		} 
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and b.city_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" b.city_name like '%" . $searchterm . "%'";
			}	
		} 
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by b.city_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }

	

	function city_list($state_id='')
    {
		$dropDownList=array();
		$dropDownList['']='Select City';
		
		if($state_id=='')
			return $dropDownList;
		else
	       	$query=$this->db->query("SELECT a . * , b . * FROM pms_city a INNER JOIN pms_city_description b ON a.city_id= b.city_id where a.state_id=".$state_id." order by b.city_name asc");	
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
    }	
	
	function get_city_list()
    {
		$dropDownList=array();
		$dropDownList['']='Select City';
		
       	$query=$this->db->query("select a.*,b.* from pms_city a inner join pms_city_description b ON a.city_id=b.city_id order by b.city_name asc");
		
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
		
       	$query=$this->db->query("select a.*,b.* from pms_city a inner join pms_city_description b ON a.city_id=b.city_id  inner join pms_locations c ON a.city_id=c.city_id order by b.city_name asc");
		
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
		$dropDownList['']='Select City';
		
		if($state_id=='')
			return $dropDownList;
		else
	       	$query=$this->db->query("SELECT a.* , b.* FROM pms_city a INNER JOIN pms_city_description b ON a.city_id= b.city_id where a.state_id=".$state_id." order by b.city_name asc");	
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
		'city_name'=> $this->input->post('city_name'),
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
		'city_name'=> $this->input->post('city_name'),
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
	function delete_record($id)
	{
		$this->db->delete('pms_city',array('city_id'=>$id));
		$this->db->delete('pms_city_description',array('city_id'=>$id));
		
	}
	
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('city_id',$id);
			$this->db->delete($this->table_name);
		}	
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
	
	function get_all_records($id_arr)
    {
		$ids_array = array();

		foreach ($id_arr as $id) 
		{			
			$query = $this->db->query("select * from pms_candidate where city_id=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				$this->db->delete('pms_city',array('city_id'=>$id));
				$this->db->delete('pms_city_description',array('city_id'=>$id));
			}
		}
		return $ids_array;
		
    }
}
?>