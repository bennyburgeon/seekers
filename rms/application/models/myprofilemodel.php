<?php
class Myprofilemodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->admin_table = "pms_admin_users";
		
	}
	
	function image_list($id=NULL)
	{
		$query = $this->db->query("SELECT admin_prof_img_url FROM pms_admin_users where admin_id=".$id);
		return $query->result_array();
	}
	
	function single_admin($id)
	{
		$query = $this->db->get_where($this->admin_table,array('admin_id'=>$id));
		return $query->row_array();
	}

	
	function update_record()
	{
		$data = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"group_id" => $_SESSION['group_id'],
				"type_id" =>$this->input->post("type_id"),
				"address" => $this->input->post("address"),
				);
	  
	   $this->db->where('admin_id', $this->input->post('admin_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   
	   
	   $id = $this->input->post('admin_id');
		
		$this->load->library('upload');
		
		if (is_uploaded_file($_FILES['admin_img']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'uploads/adminprofile/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
			print_r($_FILES);
		exit();	
			$this->upload->initialize($photo);
			
			if ($this->upload->do_upload('admin_img'))
				{
					$this->upload_file_name='';
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];	
					$query = $this->db->query("select admin_prof_img_url from ".$this->admin_table." where admin_id=".$id);
					
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('uploads/adminprofile/'.$row['admin_prof_img_url']) && $row['admin_prof_img_url']!='')
						unlink('uploads/adminprofile/'.$row['admin_prof_img_url']);
					}
					$this->db->query("update ".$this->admin_table." set admin_prof_img_url='".$this->upload_file_name."' where admin_id=".$id);
				}
		 }	
		
	}
	
}
?>