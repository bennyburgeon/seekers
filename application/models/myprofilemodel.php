<?php
class Myprofilemodel extends CI_Model{
	
	var $table_name	= "";
	var $insert_id 	= "";
	
	function __construct()
	{
		$this->admin_table = "pms_admin_users";
		
	}
	
	function single_admin($id)
	{
		$query = $this->db->get_where($this->admin_table,array('candidate_id'=>$id));
		return $query->row_array();
	}

	
	function update_record()
	{
		$data = array(
				"first_name" => $this->input->post("first_name"),
				"last_name" => $this->input->post("last_name"),
				"email" => $this->input->post("email"),
				"group_id" => $_SESSION['group_id'],
				"type_id" =>$this->input->post("type_id"),
				"address" => $this->input->post("address"),
				);
	  
	   $this->db->where('candidate_id', $this->input->post('candidate_id'));
	   $this->db->update($this->admin_table, $data);
	   
	   
	   
	   $id = $this->input->post('candidate_id');
		
		$this->load->library('upload');
		
		if (is_uploaded_file($_FILES['admin_img']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'uploads/candidates/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
			
			$this->upload->initialize($photo);
			
			if ($this->upload->do_upload('admin_img'))
				{
					$this->upload_file_name='';
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];	
					// handle file upload here
				}
		 }	
		
	}
	
}
?>