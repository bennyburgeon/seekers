<?php 
class Tasksstatusmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
	
    function __construct()
    {
		$this->table_name='pms_task_status';
    }
	
	
		function record_count($searchterm) 
	{
	
	$sql = "select count(*)as task_status_id from ".$this->table_name;
	$cond = '';
	
	if($searchterm!='')
	{
	if($cond!=''){
	//$cond.=" and candidate_id=".$candidateId;
	}
	else{
	$cond =" task_status_name like '%" . $searchterm . "%'";
	} 
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['task_status_id'];
	
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
	$cond=" task_status_name like '%" . $searchterm . "%'";
	}  
	} 
	
	if($cond!='') $cond=' where '.$cond;
	$sql=$sql.$cond;
	
	$sql.=" order by task_status_name ".$sort_by." limit ".$start.",".$limit;
	$query = $this->db->query($sql);
	return $query->result_array();
	
	}
	
	function insert_record()
    {
		$data=array(
		'task_status_id'   =>$this->input->post('task_status_id'),	
		'task_status_name'  => $this->input->post('task_status_name'),	
		'status'=> $this->input->post('status')
		);
		
        $this->db->insert($this->table_name, $data);		
		$id=$this->db->insert_id();
		
	/*	if($id!='')
		{
			$data=array(
			'category_id'=> $id,
			'category_name'=> $this->input->post('category_name'),
			
			'description'=> $this->input->post('description'),
			'meta_description'=> $this->input->post('meta_description'),
			'meta_title'=> $this->input->post('meta_title'),
			'meta_keyword'=> $this->input->post('meta_keyword')			
			);
			$this->db->insert('pms_category_description', $data);			
		}*/
		/*
		$this->load->library('upload');					
		if (is_uploaded_file($_FILES['category_img']['tmp_name'])) 
			{         

				$photo['upload_path'] = '../uploads/category/';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
				
				$this->upload->initialize($photo);
				
				if ($this->upload->do_upload('category_img'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];					
						$this->db->query("update ".$this->table_name." set category_img='".$this->upload_file_name."' where category_id=".$id);

						// resize uplaoded images to a particular size.					
						$config['image_library'] = 'gd2';
						$config['source_image'] = $data['full_path'];
						
						$config['create_thumb'] = FALSE;   //true creates a thuimbnail of the image and preseve the original one
						//$config['new_image'] = '/path/to/new_image.jpg';  //creating new iamge and preserve the original
						
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 765;
						$config['height'] = 252;					
	
						$this->load->library('image_lib', $config);										

						$this->image_lib->resize();					
						// ends here 						
					}
			 }
		*/	 
		return $this->db->insert_id();
    }
	
	function update_record()
	{
		$data=array(
		'task_status_id'=>$this->input->post('task_status_id'),	
		'task_status_name'  => $this->input->post('task_status_name'),	
		'status'=> $this->input->post('status')
		);

       $this->db->where('task_status_id', $this->input->post('task_status_id'));
	   $this->db->update($this->table_name, $data);
	   
	   /*$this->db->where('category_id', $this->input->post('category_id'));
	   $this->db->delete('pms_category_description'); 

		$data=array(
		'category_id'=> $this->input->post('category_id'),
		'category_name'=> $this->input->post('category_name'),
		'description'=> $this->input->post('description'),
		'meta_description'=> $this->input->post('meta_description'),
		'meta_title'=> $this->input->post('meta_title'),
		'meta_keyword'=> $this->input->post('meta_keyword')			
		);
			
		$this->db->insert('pms_category_description', $data);*/
		/*
		$this->load->library('upload');	
		
		
		if (is_uploaded_file($_FILES['category_img']['tmp_name'])) 
		{         
			$photo['upload_path'] = '../uploads/category/';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
			
			$this->upload->initialize($photo);
			
			
			
			if ($this->upload->do_upload('category_img'))
				{
					$this->upload_file_name='';
					$data =  $this->upload->data();									
					$this->upload_file_name=$data['file_name'];	
					$query = $this->db->query("select category_img from ".$this->table_name." where category_id=".$this->input->post('category_id'));
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('../uploads/category/'.$row['category_img']) && $row['category_img']!='')
						unlink('../uploads/category/'.$row['category_img']);
					}
					
					$this->db->query("update ".$this->table_name." set category_img='".$this->upload_file_name."' where category_id=".$this->input->post('category_id'));
					
					// resize uplaoded images to a particular size.					
					$config['image_library'] = 'gd2';
					$config['source_image'] = $data['full_path'];
					
					$config['create_thumb'] = FALSE;   //true creates a thuimbnail of the image and preseve the original one
					//$config['new_image'] = '/path/to/new_image.jpg';  //creating new iamge and preserve the original
					
					$config['maintain_ratio'] = TRUE;
					$config['width'] = 765;
					$config['height'] = 252;					

					$this->load->library('image_lib', $config);										

					$this->image_lib->resize();					
					// ends here 						
				}
			
			
		 }	*/		
	}
	

	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_tasks','key' => 'task_status_id','Module'=>'Tasks'));
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
			$this->db->where('task_status_id', $id);
			$this->db->delete('pms_task_status');  
			return 1;
		}
		

	}
	

	function leadfolder_array($id='')
    {
		if($id!='')
			$query = $this->db->query("SELECT a.category_id,b.category_name FROM `pms_category` a inner join pms_category_description b on a.category_id=b.category_id where a.parent_id=0 and a.category_id <> " .$id. " order by b.category_name ");			
		else
			$query = $this->db->query("SELECT a.category_id,b.category_name FROM `pms_category` a inner join pms_category_description b on a.category_id=b.category_id where a.parent_id=0 order by b.category_name");					
			
		$parent_list = $query->result();
		$final_list=array();
		foreach($parent_list as $item)		
		{
			if($id!='')
				$query = $this->db->query("SELECT a.category_id,b.category_name FROM `pms_category` a inner join pms_category_description b on a.category_id=b.category_id where a.parent_id=".$item->category_id." and a.category_id <> ".$id." order by b.category_name");
			else
				$query = $this->db->query("SELECT a.category_id,b.category_name FROM `pms_category` a inner join pms_category_description b on a.category_id=b.category_id where a.parent_id=".$item->category_id." order by b.category_name");			
				
			$child_list = $query->result();
			$node=array();

			foreach($child_list as $child)		
			{
				$node[$child->category_id] = $child->category_name;
			}
			$final_list[]=array('id' => $item->category_id,'name'=> $item->category_name, 'child' => $node);
			
		}
		return $final_list;
    }
    
	function check_dups($name='',$id='')
	{
		$this->db->query('task_status_name', $name);
		if($id!='')	$this->db->where('task_status_id !=', $id);		
		$query = $this->db->get('pms_task_status');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('task_status_id',$id);
			$this->db->delete($this->table_name);
		}	
    }

}
?>