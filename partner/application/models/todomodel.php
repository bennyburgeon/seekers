<?php 
class Todomodel extends CI_Model
{
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		$this->table_name='pms_todo';
    }
	
	function record_count($searchterm) 
	{
		$sql	= "select count(*) as todo_id from ".$this->table_name." a inner join pms_todo_description b ON a.todo_id=b.todo_id";
		$cond	= '';
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and connum=".$connum;
			}
			else{
				$cond =" a.created_by=".$_SESSION['vendor_session']." and b.title like '%" . $searchterm . "%'";
			}	
		} 
		else{
			$cond = " a.created_by=".$_SESSION['vendor_session'];
		}
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['todo_id'];
				
		
	}

	function get_list($start,$limit,$searchterm,$sort_by)
    {
		$sql="select a.*,b.* from pms_todo a inner join pms_todo_description b ON a.todo_id=b.todo_id";
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				//$cond.=" and connum=".$connum;
			}	
			else{
				$cond=" a.created_by=".$_SESSION['vendor_session']." and b.title like '%" . $searchterm . "%'";
			}		
		} 
		$cond=" a.created_by=".$_SESSION['vendor_session'];

		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by b.title ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
		
    }

	
	/*function get_list($no_rec, $offset)
    {
	
       	$query=$this->db->query("select a.*,b.* from pms_todo a inner join pms_todo_description b ON a.todo_id=b.todo_id where a.created_by=".$_SESSION['vendor_session']);
		return $query->result_array();
    }*/
    
	function get_all()
    {
       	$query=$this->db->query("select a.*,b.* from pms_todo a inner join pms_todo_description b ON a.todo_id=b.todo_id where b.language_id=1 and a.created_by=".$_SESSION['vendor_session']);
		return $query->result_array();
    }	

	function todo_array()
    {
		$query = $this->db->query("SELECT a.todo_group_id,a.todo_group_name FROM `pms_todo_group` a order by a.todo_group_name");			
		$state_ist = $query->result();
		$dropDownList = array();
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->todo_group_id] = $dropdown->todo_group_name;
		}
		return $dropDownList;
    }
	
		function todo_status()
    {
		$query = $this->db->query("SELECT * from pms_todo_status");			
		$status_ist = $query->result();
		$dropDownList = array();
		foreach($status_ist as $dropdown)
		{
			$dropDownList[$dropdown->status_id] = $dropdown->status_name;
		}
		return $dropDownList;
    }
    
	function insert_record()
    {
		$prod_main=array(
		'start_date'        => $this->input->post('start_date'),
		'end_date'          => $this->input->post('end_date'),
		'start_time'        => $this->input->post('start_time'),
		'end_time'          => $this->input->post('end_time'),
		'todo_group_id'     => $this->input->post('todo_group_id'),
		'todo_priority_id'  => $this->input->post('todo_priority_id'), 
		'status_id'         => $this->input->post('status_id'),
		'assigned_to'       => $this->input->post('assigned_to'),
		'created_by'        => 0,
		'link_url'          => '',
		'parent_id'         => 0,
		'drop_box'          => '',
		'created_by'           => $_SESSION['vendor_session']
		);

        $this->db->insert('pms_todo', $prod_main);		
		$id=$this->db->insert_id();

		if($id!='')
		{
			$prod_seo=array(
			'todo_id'         => $id,
			'language_id'        => '1',
			'title'       => $this->input->post('title'),
			'description'        => $this->input->post('description'),
			);
			
			$this->db->insert('pms_todo_description', $prod_seo);
					
			/*$prod_seo=array(
			'todo_id'         => $id,
			'language_id'        => '2',			
			'title'       => $this->input->post('title_ar'),
			'description'       => $this->input->post('description'),
			);
			$this->db->insert('pms_todo_description', $prod_seo);*/		
		}
		
		$this->load->library('upload');					
		// image 1
		if (is_uploaded_file($_FILES['attachment']['tmp_name'])) 
			{         
				$photo['upload_path'] = 'uploads/todo';
				$photo['allowed_types'] = 'png|jpg|jpeg|gif|doc|docx|xls|xlsx|txt|rtf';
				$photo['max_size']	= '0';
				$photo['file_name'] = md5(uniqid(mt_rand()));
				
				$this->upload->initialize($photo);
				
				if ($this->upload->do_upload('attachment'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];		
						
						$this->db->query("update pms_todo set attachment='".$this->upload_file_name."' where todo_id=".$id);
					}
			 }
		return $this->db->insert_id();
    }
	
	function update_record()
	{
			$prod_main=array(
			'start_date'        => $this->input->post('start_date'),
			'end_date'          => $this->input->post('end_date'),
			'start_time'        => $this->input->post('start_time'),
			'end_time'          => $this->input->post('end_time'),
			'todo_group_id'     => $this->input->post('todo_group_id'),
			'todo_priority_id'  => $this->input->post('todo_priority_id'), 
			'status_id'         => $this->input->post('status_id'),
			'assigned_to'       => $this->input->post('assigned_to'),
			'created_by'        => 0,
			'link_url'          => '',
			'parent_id'         => 0,
			'drop_box'          => '',
			'created_by'           => $_SESSION['vendor_session']
			);

		   $this->db->where('todo_id', $this->input->post('todo_id'));
		   $this->db->update($this->table_name, $prod_main);
		   
		   $this->db->where('todo_id', $this->input->post('todo_id'));
		   $this->db->delete('pms_todo_description'); 

			$prod_seo=array(
			'todo_id'         => $this->input->post('todo_id'),
			'language_id'        => '1',
			'title'       => $this->input->post('title'),
			'description'       => $this->input->post('description'),
			);
			
			$this->db->insert('pms_todo_description', $prod_seo);

			/*$prod_seo=array(
			'todo_id'         => $this->input->post('todo_id'),
			'language_id'        => '2',
			'title'       => $this->input->post('title_ar'),
			'description'       => $this->input->post('description_ar'),
			);			
			$this->db->insert('pms_todo_description', $prod_seo);*/

			$this->load->library('upload');			
		
		// check for file upload1
		if (is_uploaded_file($_FILES['attachment']['tmp_name'])) 
		{         
			$photo['upload_path'] = 'uploads/todo';
			$photo['allowed_types'] = 'png|jpg|jpeg|gif|doc|docx|xls|xlsx|txt|rtf';
			$photo['max_size']	= '0';
			$photo['file_name'] = md5(uniqid(mt_rand()));
			
			$this->upload->initialize($photo);
			
			if ($this->upload->do_upload('attachment'))
				{
					$this->upload_file_name='';
					$data =  $this->upload->data();									
					$this->upload_file_name=$data['file_name'];	
					
					$query = $this->db->query("select attachment from pms_todo where todo_id=".$this->input->post('todo_id'));
					
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('uploads/todo/'.$row['attachment']) && $row['attachment']!='')
						unlink('uploads/todo/'.$row['attachment']);
					}
					
					$this->db->query("update pms_todo set attachment='".$this->upload_file_name."' where todo_id=".$this->input->post('todo_id'));
				
					// ends here 						
				}
		 }
	}
	
	function delete($id=null)
	{
		if($id=='') return false;
		$query = $this->db->query("select attachment from pms_todo where todo_id=".$id);			
		$img_list=$query->result_array();
		
		foreach($img_list as $result)
		{
			if(file_exists('uploads/todo/'.$result['attachment']) && $result['attachment']!='')
			unlink('uploads/todo/'.$result['attachment']);
		}				
		
		$this->db->where('todo_id', $id);
		$this->db->delete('pms_todo'); 
		
		$this->db->where('todo_id', $id);
		$this->db->delete('pms_todo_description'); 
		
	}
	
	function check_dups($name='',$id='')
	{
		$this->db->query('title', $name);
		if($id!='')	$this->db->where('todo_id !=', $id);		
		$query = $this->db->get('pms_todo_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
}
?>