<?php 
class Statusmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_process_status';
    }
	
	function record_count($searchterm) 
	{
	
	$sql = "select count(*)as status_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" status_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['status_id'];
	
	}
	 function insert_record()
	{ 
        $data = array(
				"status_name" => $this->input->post("status_name"),
				"status" => $this->input->post("status"),
				'icon_file_name'=> '',
				'status_order'=> $this->input->post('status_order'),
				'icon_inactive' => ''
                );
		$this->db->insert($this->table_name,$data);
        $insert_id=$this->db->insert_id();
        $this->load->library('upload');					
		if (is_uploaded_file($_FILES['icon_file_name']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'upload/status/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
		
			$this->upload->initialize($photo);
			if ($this->upload->do_upload('icon_file_name'))
			{
				$this->upload_file_name='';
				$data =  $this->upload->data();	
				$this->upload_file_name=$data['file_name'];					
				$this->db->query("update ".$this->table_name." set icon_file_name='".$this->upload_file_name."' where status_id=".$insert_id);
			}
		}
		if (is_uploaded_file($_FILES['icon_inactive']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'upload/status/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
		
			$this->upload->initialize($photo);
			if ($this->upload->do_upload('icon_inactive'))
			{
				$this->upload_file_name='';
				$data =  $this->upload->data();	
				$this->upload_file_name=$data['file_name'];					
				$this->db->query("update ".$this->table_name." set icon_inactive='".$this->upload_file_name."' where status_id=".$insert_id);
			}
		}
		
	}
	
	function update_record()
	{
		$status_id = $this->input->post('status_id');
		$data=array(
		'status_name'=> $this->input->post('status_name'),
		'status'=> $this->input->post('status'),
		'status_order'=> $this->input->post('status_order')
		
		);

       $this->db->where('status_id', $status_id);
	   $this->db->update($this->table_name, $data);
	   $this->load->library('upload');	
		if (is_uploaded_file($_FILES['icon_file_name']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'upload/status/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
		
			$this->upload->initialize($photo);
		
			if ($this->upload->do_upload('icon_file_name'))
			{
				$this->upload_file_name='';
				$data =  $this->upload->data();	
				$this->upload_file_name=$data['file_name'];	
				$query = $this->db->query("select icon_file_name from ".$this->table_name." where status_id=".$status_id);
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					if(file_exists('upload/status/'.$row['icon_file_name']) && $row['icon_file_name']!='')
						unlink('upload/status/'.$row['icon_file_name']);
				}
					$this->db->query("update ".$this->table_name." set icon_file_name='".$this->upload_file_name."' where status_id=".$status_id);
			}
		}	
		if (is_uploaded_file($_FILES['icon_inactive']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'upload/status/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
		
			$this->upload->initialize($photo);
		
			if ($this->upload->do_upload('icon_inactive'))
			{
				$this->upload_file_name='';
				$data =  $this->upload->data();	
				$this->upload_file_name=$data['file_name'];	
				$query = $this->db->query("select icon_inactive from ".$this->table_name." where status_id=".$status_id);
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					if(file_exists('upload/status/'.$row['icon_inactive']) && $row['icon_inactive']!='')
						unlink('upload/status/'.$row['icon_inactive']);
				}
					$this->db->query("update ".$this->table_name." set icon_inactive='".$this->upload_file_name."' where status_id=".$status_id);
			}
		}	
	}
	
	function delete($id=null)
	{
		if($id=='') return false;		
		$query = $this->db->query("select icon_file_name,icon_inactive from ".$this->table_name." where status_id=".$id);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			if(file_exists('upload/status/'.$row['icon_file_name']) && $row['icon_file_name']!='')
				unlink('upload/status/'.$row['icon_file_name']);
			if(file_exists('upload/status/'.$row['icon_inactive']) && $row['icon_inactive']!='')
				unlink('upload/status/'.$row['icon_inactive']);	
		}

		$this->db->where('status_id', $id);
		$this->db->delete('pms_process_status'); 
		
	}
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_state','key' => 'status_id','Module'=>'Status'));
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
	
	function check_dups($name='',$id='')
	{
		$this->db->query('status_name', $name);
		if($id!='')	$this->db->where('status_id !=', $id);		
		$query = $this->db->get('pms_status_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
	

	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="select * from ".$this->table_name;
	$cond='';
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	} 
	else{
	$cond=" status_name like '%" . $searchterm . "%' and status='1'";
	}  
	}  
	$cond="status_name like '%" . $searchterm . "%' and status='1'";
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by status_id ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('status_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
}
?>