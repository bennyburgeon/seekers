<?php 
class universitymodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_university';
    }
	
	 function record_count($searchterm) 
	{
	
	$sql = "select count(*)as univ_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" univ_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['univ_id'];
	
	}
	   
	 function get_list($start,$limit,$searchterm,$sort_by)
	{
	$sql="select * from ".$this->table_name;
	$cond='';
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and connum=".$connum;
	} 
	else{
	$cond=" univ_name like '%" . $searchterm . "%'";
	}  
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by univ_name ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	} 
	
	function insert_record()
    {
		$data=array(
		'univ_name'=>$this->input->post('univ_name'),
		'univ_address'=>$this->input->post('univ_address'),
		'univ_details'=>$this->input->post('univ_details'),
		'univ_phone'=>$this->input->post('univ_phone'),
		'univ_mobile'=>$this->input->post('univ_mobile'),
		'univ_email'=>$this->input->post('univ_email'),
		'univ_map'=>$this->input->post('univ_map'),
		'univ_logo'=>'',
		'univ_banner'=>'',
		'univ_website'=>$this->input->post('univ_website'),
		'univ_type'=>$this->input->post('univ_type')
		
		);
        $this->db->insert($this->table_name, $data);
		$id=$this->db->insert_id();
		$this->load->library('upload');					
					if (is_uploaded_file($_FILES['univ_logo']['tmp_name'])) 
						{         
							$photo['upload_path'] = 'upload/univlogo/';
							$photo['allowed_types'] = 'png|jpg|jpeg|gif';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('univ_logo'))
								{
									
									$this->upload_file_name='';
									$data =  $this->upload->data();	
									$this->upload_file_name=$data['file_name'];					
									$this->db->query("update ".$this->table_name." set univ_logo='".$this->upload_file_name."' where univ_id=".$id);
								}
						 }
						 
					
		
										$this->load->library('upload');					

						if (is_uploaded_file($_FILES['univ_banner']['tmp_name'])) 
						{       				

							$config['upload_path'] = 'upload/univbanner/';
							$config['allowed_types'] = 'png|jpg|jpeg|gif';
							$config['max_size']	= '0';
							$config['file_name'] = md5(uniqid(mt_rand()));
							$this->upload->initialize($config);	

							if ($this->upload->do_upload('univ_banner'))
								{
									$this->upload_file_name='';
									$data =  $this->upload->data();	
									$this->upload_file_name=$data['file_name'];					
									$this->db->query("update ".$this->table_name." set univ_banner='".$this->upload_file_name."' where univ_id=".$id);
								}
						 }		
		return ;
		
    }
	function update_record($id=NULL)
	{
		
		$data=array(
		'univ_name'=>$this->input->post('univ_name'),
		'univ_address'=>$this->input->post('univ_address'),
		'univ_details'=>$this->input->post('univ_details'),
		'univ_phone'=>$this->input->post('univ_phone'),
		'univ_mobile'=>$this->input->post('univ_mobile'),
		'univ_email'=>$this->input->post('univ_email'),
		'univ_map'=>$this->input->post('univ_map'),
		'univ_website'=>$this->input->post('univ_website'),
		'univ_type'=>$this->input->post('univ_type')
		
		);

       $this->db->where('univ_id', $id);
	   $this->db->update($this->table_name, $data);
	 
		$this->load->library('upload');	

					if (is_uploaded_file($_FILES['univ_logo']['tmp_name'])) 
						{    
							$photo['upload_path'] = 'upload/univlogo/';
							$photo['allowed_types'] = 'png|jpg|jpeg|gif';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('univ_logo'))
								{
									$this->upload_file_name='';
									$data =  $this->upload->data();									
								    $this->upload_file_name=$data['file_name'];
									$query = $this->db->query("select univ_logo from pms_university where univ_id=".$id);
									
									$row = $query->row_array();
									
									
			                           	if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('upload/univlogo/'.$row['univ_logo']) && $row['univ_logo']!='')
										unlink('upload/univlogo/'.$row['univ_logo']);
									}
													
									$this->db->query("update ".$this->table_name." set univ_logo='".$this->upload_file_name."' where univ_id=".$id);
								}
						 }	
						 
		$this->load->library('upload');					

						if (is_uploaded_file($_FILES['univ_banner']['tmp_name'])) 
						{       				

							$photo['upload_path'] = 'upload/univbanner/';
							$photo['allowed_types'] = 'png|jpg|jpeg|gif';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('univ_banner'))
								{
									$this->upload_file_name='';
									$data =  $this->upload->data();									
								    $this->upload_file_name=$data['file_name'];
									$query = $this->db->query("select univ_banner from pms_university where univ_id=".$id);
									
									$row = $query->row_array();
									if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('upload/univbanner/'.$row['univ_banner']) && $row['univ_banner']!='')
										unlink('upload/univbanner/'.$row['univ_banner']);
									}
													
									$this->db->query("update ".$this->table_name." set univ_banner='".$this->upload_file_name."' where univ_id=".$id);
								}
						 }	
					
					


	}
	
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('univ_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	
	function delete_record($id)

	{
		$this->db->delete('pms_university',array('univ_id'=>$id));

	}
}
?>