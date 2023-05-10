<?php 
class universitymodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_university';
    }
	function record_count($searchterm,$univ_type)
	{
	
		$sql	= "select count(*)as univ_id from ".$this->table_name;
		$cond	= '';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond .=" and univ_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" univ_name like '%" . $searchterm . "%'";
			}	
		} 

		if($univ_type!='')
		{
			if($cond!=''){
				$cond.=" and univ_type=".$univ_type;
			}
			else{
				$cond=" univ_type=".$univ_type;
			}	
		} 
				
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['univ_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by,$univ_type)
    {
		$sql="select univ_id,univ_name,univ_address from ".$this->table_name;
		$cond='';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and univ_name like '%" . $searchterm . "%'";
			}	
			else{
				$cond=" univ_name like '%" . $searchterm . "%'";
			}		
		} 

		if($univ_type!='')
		{
			if($cond!=''){
				$cond.=" and univ_type=".$univ_type;
			}
			else{
				$cond=" univ_type=".$univ_type;
			}	
		} 
				
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by univ_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);

		$university_list=$query->result_array();
		$final_array=array();
		foreach($university_list as $key => $val)
		{
			$query = $this->db->query("select campus_name from pms_campus where univ_id=".$val['univ_id']);
			$campus_array=array();
			if($query->num_rows>0)
			{
				$campus_list=$query->result_array();
				
				foreach($campus_list as $campus)
				{
					$campus_array[]=$campus['campus_name'];
				}				
			}
			$final_array[$val['univ_id']]['univ_name']=$val['univ_name'];
			$final_array[$val['univ_id']]['campus']=$campus_array;
		}
		
		return $final_array;		
    }
    
	function insert_record()
    {
		$data=array(
		'univ_name'=>$this->input->post('univ_name'),
		'univ_address'=>$this->input->post('univ_address'),
		'univ_details'=>$this->input->post('univ_details'),
		'country_id'=>$this->input->post('country_id'),
		'univ_website'=>$this->input->post('univ_website'),
		'univ_type'=>$this->input->post('univ_type'),
		'univ_grade'=> $this->input->post('univ_grade')		
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
		return ;
		
    }
	
	function update_record($id=NULL)
	{
		
		$data=array(
		'univ_name'=>$this->input->post('univ_name'),
		'univ_address'=>$this->input->post('univ_address'),
		'univ_details'=>$this->input->post('univ_details'),
		'country_id'=>$this->input->post('country_id'),
		'univ_website'=>$this->input->post('univ_website'),
		'univ_type'=>$this->input->post('univ_type'),
		'univ_grade'=> $this->input->post('univ_grade'),		
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
	
	function get_all_records($id_arr)
    {
		$ids_array = array();

		foreach ($id_arr as $id) 
		{			
			$query = $this->db->query("select * from pms_candidate_education where univ_id=".$id)->result();			
			
			if(!empty($query ))
			{
				$ids_array[] = $id;
			}
			else
			{				
				$result = $this->db->query('DELETE FROM pms_university WHERE univ_id ="'.$id.'"');
				//echo $this->db->last_query();
			}
		}
		return $ids_array;
		
    }
	
}
?>