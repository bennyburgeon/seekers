<?php 
class Locationmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_locations';
    }
	
	function record_count($country_id,$state_id,$city_id,$searchterm) 
	{
	
		$sql	= "select count(*) as location_id from pms_locations a inner join pms_locations_description b ON a.location_id=b.location_id ";
		
			$sql .= " inner join pms_city c on a.city_id = c.city_id "  ;
			$sql .= " inner join pms_state d on c.state_id = d.state_id "  ;
				$cond	= '';
		
		if($country_id!='')
		{
			if($cond!=''){
				$cond.=" and d.country_id =".$country_id;
			}
			else{
				$cond =" d.country_id =".$country_id;
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
		
		if($city_id!='')
		{
			if($cond!=''){
				$cond.=" and c.city_id =".$city_id;
			}
			else
			{
				$cond =" c.city_id =".$city_id;
			}	
		} 
		if($searchterm!='')
		{
			if($cond!=''){
			$cond.=" and  b.location_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" b.location_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		
		$row=$query->row_array();
		
		return $row['location_id'];
				
		
	}
	function get_list($start,$limit,$country_id,$state_id,$city_id,$searchterm,$sort_by)
    {
		$sql="select a.*,b.* from pms_locations a inner join pms_locations_description b ON a.location_id=b.location_id ";
		
			$sql .= " inner join pms_city c on a.city_id = c.city_id "  ;
			$sql .= " inner join pms_state d on c.state_id = d.state_id "  ;
		
		$cond	= '';
		
		if($country_id!='')
		{
			if($cond!=''){
				$cond.=" and d.country_id =".$country_id;
			}
			else{
				$cond =" d.country_id =".$country_id;
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
		
		if($city_id!='')
		{
			if($cond!=''){
				$cond.=" and c.city_id =".$city_id;
			}
			else
			{
				$cond =" c.city_id =".$city_id;
			}	
		} 
		if($searchterm!='')
		{
			if($cond!=''){
			$cond.=" and  b.location_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" b.location_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by b.location_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }

	
	
	/*function record_count() 
	{
        return $this->db->count_all($this->table_name);
        }*/

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
	
	/*
	function get_list($no_rec, $offset)
    {
       	$query=$this->db->query("select a.*,b.* from pms_locations a inner join pms_locations_description b ON a.location_id=b.location_id order by b.location_name");
		return $query->result_array();
    }*/
    
	function get_all()
    {
       	$query=$this->db->query("select a.*,b.* from pms_locations a inner join pms_locations_description b ON a.location_id=b.location_id order by b.location_name");
		return $query->result_array();
    }	
	
	function location_list($city_id='')
    {
		$dropDownList=array();
		$dropDownList['']='Select Location';	
		
		if($city_id!='')			
                     $query=$this->db->query("select a.*,b.* from pms_locations a inner join pms_locations_description b ON a.location_id=b.location_id	 where a.city_id=".$city_id." order by b.location_name asc");
		else
                    $query=$this->db->query("select a.*,b.* from pms_locations a inner join pms_locations_description b ON a.location_id=b.location_id order by b.location_name asc");
		
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->location_id] = $dropdown->location_name;
		}
		return $dropDownList;
    }	
	
	

	function insert_record()
    {
		$data=array(		
		'city_id'=> $this->input->post('city_id'),
                'zipcode'=> $this->input->post('zipcode'),     
		'status'=> $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);
        
		$id=$this->db->insert_id();
		
		if($id!='')
		{
			$data=array(
			'location_id'=> $id,
			'location_name'=> $this->input->post('locaton_name'),
			'language_id'=> '1'
			);
			$this->db->insert('pms_locations_description', $data);			
		}
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(		
		'city_id'=> $this->input->post('city_id'),
                'zipcode'=> $this->input->post('zipcode'),     
		'status'=> $this->input->post('status')
		);

           $this->db->where('location_id', $this->input->post('location_id'));
	   $this->db->update($this->table_name, $data);
	   
	   $this->db->where('location_id', $this->input->post('location_id'));
	   $this->db->delete('pms_locations_description'); 

	   $data=array(
			'location_id'=> $this->input->post('location_id'),
			'location_name'=> $this->input->post('locaton_name'),
			'language_id'=> '1'
			);
          $this->db->insert('pms_locations_description', $data);			
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
		$master_tables = array(array('table'=>'pms_property','key' => 'location_id','Module'=>'Location'),array('table'=>'pms_leads','key' => 'location_id','Module'=>'Leads'),array('table'=>'pms_contacts','key' => 'location_id','Module'=>'Contacts'));
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
			$this->db->where('location_id', $id);
			$this->db->delete('pms_locations'); 
			$this->db->where('location_id', $id);
			$this->db->delete('pms_locations_description');
			return 1;
		}
		

	}*/
	
	function delete_record($id)
	{
		$this->db->delete('pms_locations',array('location_id'=>$id));
		$this->db->delete('pms_locations_description',array('location_id'=>$id));
		
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('location_id',$id);
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
			$query = $this->db->query("select * from pms_candidate where current_location=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				$this->db->delete('pms_locations',array('location_id'=>$id));
				$this->db->delete('pms_locations_description',array('location_id'=>$id));
			}
		}
		return $ids_array;
		
    }
	
	
}
?>
