<?php 
class Countrymodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_country';
    }
	
	function record_count($searchterm) 
	{
		 $sql = "select count(*)as country_id from ".$this->table_name;
		$cond = '';

		if($searchterm!='')
		{
			if($cond!=''){
				$cond .=" and country_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" country_name like '%" . $searchterm . "%'";
			} 
		} 
		
		if($cond!='') $cond=' where '.$cond;

		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['country_id'];
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

	
	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id";
		$cond='';

		if($searchterm!='')
		{
			$cond=" a.country_name like '%" . $searchterm . "%'";
		} 
		
		if($cond!='') $cond=' where '.$cond;
	
		$sql=$sql.$cond;
		
		$sql.=" order by b.country_name ".$sort_by." limit ".$start.",".$limit;
		
	
		
		$query = $this->db->query($sql);
		return $query->result_array();
	
       	
    }
    
	function get_all()
    {
       	$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id order by b.country_name");
		return $query->result_array();
    }
	
	function country_list()
    {
       	$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id order by b.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}

		return $dropDownList;
    }	
	
	function country_list_add_state()
    {
       	$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id order by b.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}

		return $dropDownList;
    }	
	
	function country_list_add_city()
    {
       	$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id inner join pms_state c ON                                 a.country_id = c.country_id  order by b.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}

		return $dropDownList;
    }	
	
	function country_list_add_location()
    {
       	$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id inner join pms_state c ON                                 a.country_id = c.country_id  inner join pms_city d ON c.state_id = d.state_id order by b.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}

		return $dropDownList;
    }	
	
	
	function country_list_by_state($country_id='')
    {

		$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id inner join pms_state c ON a.country_id=c.country_id order by b.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
		return $dropDownList;
    }
	
	
    function country_list_by_state_city($country_id='')
    {

		$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id inner join pms_state c ON a.country_id=c.country_id inner join pms_city d ON c.state_id=d.state_id  order by b.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
		return $dropDownList;
    }
	
	
    function country_list_by_state_city_location($country_id='')
    {

		$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id inner join pms_state c ON a.country_id=c.country_id inner join pms_city d ON c.state_id=d.state_id inner join pms_locations f ON d.city_id=f.city_id order by b.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
		return $dropDownList;
    }

    function country_list_only($country_id='')
    {

		$query=$this->db->query("select a.* from pms_country a order by a.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
		return $dropDownList;
    }
		   
	function insert_record()
    {
		$data=array(
		'country_name'=> $this->input->post('country_name'),
		'sort_order'=> $this->input->post('sort_order'),
		'status'=> $this->input->post('status'),
		'visa'=> $this->input->post('visa'),
		'medical'=> $this->input->post('medical'),
		'docs_required'=> $this->input->post('docs_required'),
		'visa_process'=> $this->input->post('visa_process'),
		'intl_code'            => $this->input->post('intl_code'),
		'intl_dial_prefix'     => $this->input->post('intl_dial_prefix'),
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		
		if($id!='')
		{
			$data=array(
			'country_id'=> $id,
			'country_name'=> $this->input->post('country_name'),
			'language_id'=> '1'
			);
			$this->db->insert('pms_country_description', $data);			
		}
		
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		//'country_name'=> $this->input->post('country_name'),
		'sort_order'=> $this->input->post('sort_order'),
		'status'=> $this->input->post('status'),
		'visa'=> $this->input->post('visa'),
		'medical'=> $this->input->post('medical'),
		'docs_required'=> $this->input->post('docs_required'),
		'visa_process'=> $this->input->post('visa_process'),
		'intl_code'            => $this->input->post('intl_code'),
		'intl_dial_prefix'     => $this->input->post('intl_dial_prefix'),
		);

       $this->db->where('country_id', $this->input->post('country_id'));
	   $this->db->update($this->table_name, $data);
	   
	   $this->db->where('country_id', $this->input->post('country_id'));
	   $this->db->delete('pms_country_description'); 

	   $data=array(
	   'country_id'=> $this->input->post('country_id'),
	   'country_name'=> $this->input->post('country_name'),
	   'language_id'=> '1'
	   );

		$this->db->insert('pms_country_description', $data);		
		$this->load->library('upload');	
	}
	
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_state','key' => 'country_id','Module'=>'Country'));
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
	
	function delete($id=null)
	{
		if($id=='') return false;		
		
		if($this->is_related($id)){
			return 2;
		}else{
			$this->db->where('country_id', $id);
			$this->db->delete('pms_country'); 
			$this->db->where('country_id', $id);
			$this->db->delete('pms_country_description');
			return 1;
		}
		

	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('country_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	function check_dups($name='',$id='')
	{
		$this->db->query('country_name', $name);
		if($id!='')	$this->db->where('country_id !=', $id);		
		$query = $this->db->get('pms_country_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
	
	 function get_country_name($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select country_name from pms_country where country_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['country_name'];
			}else
			{
				return '';
			}
	}

//GET COUNTRY DETAILS BY ID
	function get_country($id)
	{ 
		if($id < 1) return '';
		
		$query = $this->db->query("select * from pms_country where country_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row;
			}else
			{
				return '';
			}
	}
	
	
	function get_all_records($id_arr)
    {
		$ids_array = array();

		foreach ($id_arr as $id) 
		{			
			$query = $this->db->query("select * from pms_candidate where nationality=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				$this->db->where('country_id', $id);
				$this->db->delete('pms_country'); 
				$this->db->where('country_id', $id);
				$this->db->delete('pms_country_description'); 
			}
		}
		return $ids_array;
		
    }
}
?>
