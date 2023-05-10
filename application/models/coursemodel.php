<?php 
class coursemodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_courses';
		$this->upload_file_name='';
    }

	function record_count($searchterm,$international,$level_study) 
	{
		$sql="select count(*)as course_id from pms_courses a ";
		$cond	= '';

		if($international!='')
		{
			 $cond ="  a.international='" . $international . "' ";
		}

		if($level_study!='')
		{
			if($cond!=''){
			   $cond .="  and a.level_study=" . $level_study . "";
			}
			else{
				 $cond ="  a.level_study=" . $level_study . "";
			}	
		} 
			
		if($searchterm!='')
		{
			if($cond!='')
			{
			  $cond .=" and a.course_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" a.course_name like '%" . $searchterm . "%'";
			}	
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;

		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['course_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by,$international,$level_study)
    {
		$sql="select a.*,(select count(course_id) from pms_courses_international where course_id=a.course_id)as total_count from ".$this->table_name." a ";
		
		$cond	= '';

		if($international!='')
		{
			 $cond ="  a.international='" . $international . "' ";
		}
				
		if($level_study!='')
		{
			if($cond!=''){
			   $cond .="  and a.level_study=" . $level_study . "";
			}
			else{
				 $cond ="  a.level_study=" . $level_study . "";
			}	
		} 

		if($searchterm!='')
		{
			if($cond!=''){
			  $cond .=" and a.course_name like '%" . $searchterm . "%'";
			}
			else{
				$cond =" a.course_name like '%" . $searchterm . "%'";
			}	
		} 
				
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		$sql.=" order by a.course_name ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
    }

	function get_international($course_id)
	{
		if($course_id=='')return;

		$query = $this->db->query('select level_id,level_name from pms_education_level order by disp_order');
		$levels_list=array();
		$course_list=array();
		$levels_list = $query->result_array();
		foreach($levels_list as $levels => $level)
		{	
			$query = $this->db->query("select course_id,course_name from ".$this->table_name." where international=2 and level_study=".$level['level_id']." and course_id not in (select int_course_id from pms_courses_international where course_id=".$course_id." ) order by course_name ");
			$courses = $query->result_array();
			if(count($courses)>0)$course_list[$level['level_name']]=$courses;
			
		}
		return $course_list;
	}
	
	function get_international_current($course_id)
	{
		if($course_id=='')return;

		$query = $this->db->query('select level_id,level_name from pms_education_level order by disp_order');
		$levels_list=array();
		$course_list=array();
		$levels_list = $query->result_array();
		foreach($levels_list as $levels => $level)
		{	
		$query = $this->db->query("select  a.course_id,a.course_name from pms_courses a inner join pms_courses_international b on a.course_id=b.int_course_id where b.course_id=".$course_id." and a.level_study=".$level['level_id']." order by a.course_name");
			
			$courses = $query->result_array();
			if(count($courses)>0)$course_list[$level['level_name']]=$courses;
			
		}
		return $course_list;
	}
	
	function insert_record()
    {
		
		if (is_uploaded_file($_FILES['course_info_attach']['tmp_name'])) 
		{            
			$config['upload_path'] = 'uploads/course';
			$config['allowed_types'] = 'doc|docx|pdf|png|jpg|jpeg|gif';
			$config['max_size']	= '0';
			$config['file_name'] = md5(uniqid(mt_rand()));
			
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('course_info_attach'))
				{
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];
				}
				else
				{
					$this->upload_file_name='';
				}
		}
		
		$data=array(
		'course_name'=>$this->input->post('course_name'),
		'level_study'=>$this->input->post('level_study'),
		'course_details'=>$this->input->post('course_details'),
		'mode_id'=>$this->input->post('mode_id'),
		'qualification'=>$this->input->post('qualification'),
		'location'=>$this->input->post('location'),
		'duration'=>$this->input->post('duration'),
		'start_date'=>$this->input->post('start_date'),
		'inquiry'=>$this->input->post('inquiry'),
		'by_distance'=>$this->input->post('by_distance'),
		'international'=>$this->input->post('international'),
		'course_info_attach'=>$this->upload_file_name		
		);
		
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		
		if(is_array($this->input->post('subject_id')))
		{
			foreach ($this->input->post('subject_id') as $value)
			{
				if($value > 0)
				{
					$data=array(
					'subject_id' => $value,
					'course_id' => $this->new_id
					);
					$this->db->insert('pms_course_sub', $data);					
				}
			}
		}

		if(is_array($this->input->post('univ_id')))
		{
			foreach ($this->input->post('univ_id') as $value)
			{
				if($value > 0)
				{
					$data=array(
					'univ_id' => $value,
					'course_id' => $this->new_id
					);
					$this->db->insert('pms_course_uni', $data);
				}
			}
		}
		
		return $this->new_id;		
    }
	
	function update_record($id)
	{
		
		$data=array(
		'course_name'=>$this->input->post('course_name'),
		'level_study'=>$this->input->post('level_study'),
		'course_details'=>$this->input->post('course_details'),
		'mode_id'=>$this->input->post('mode_id'),
		'qualification'=>$this->input->post('qualification'),
		'location'=>$this->input->post('location'),
		'duration'=>$this->input->post('duration'),
		'start_date'=>$this->input->post('start_date'),
		'inquiry'=>$this->input->post('inquiry'),
		'by_distance'=>$this->input->post('by_distance'),
		'international'=>$this->input->post('international'),
		);
       $this->db->where('course_id', $id);
	   $this->db->update($this->table_name, $data);
		
		if (is_uploaded_file($_FILES['course_info_attach']['tmp_name'])) 
		{            
			$config['upload_path'] = 'uploads/';
			$config['allowed_types'] = 'doc|docx|pdf';
			$config['max_size']	= '0';
			$config['file_name'] = md5(uniqid(mt_rand()));			
			$this->load->library('upload', $config);		
			
			if ($this->upload->do_upload('course_info_attach'))
			{
				$data =  $this->upload->data();	
				$this->upload_file_name=$data['file_name'];
				$query = $this->db->query("select course_info_attach from pms_courses where course_id=".$id);
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					if(file_exists('uploads/'.$row['course_info_attach']) && $row['course_info_attach']!='')
					unlink('uploads/'.$row['course_info_attach']);
				}
			$query = $this->db->query("update pms_courses set course_info_attach='".$this->upload_file_name."' where course_id=".$id);
				
			}
		}

		if(is_array($this->input->post('subject_id')))
		{
			$query = $this->db->query("delete from pms_course_sub where course_id=".$id);
			foreach ($this->input->post('subject_id') as $value)
			{
				if($value > 0)
				{
					$data=array(
					'subject_id' => $value,
					'course_id' => $id
					);
					$this->db->insert('pms_course_sub', $data);					
				}
			}
		}

		if(is_array($this->input->post('univ_id')))
		{
			$query = $this->db->query("delete from pms_course_uni where course_id=".$id);
			foreach ($this->input->post('univ_id') as $value)
			{
				if($value > 0)
				{
					$data=array(
					'univ_id' => $value,
					'course_id' => $id
					);
					$this->db->insert('pms_course_uni', $data);
				}
			}
		}		
	}

	function fill_levels()
	{
		$query = $this->db->query('select distinct level_id, level_name from  pms_education_level order by level_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Level';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->level_id] = $dropdown->level_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_modes()
	{
		$query = $this->db->query('select distinct mode_id, mode_name from pms_study_mode order by mode_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Mode';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->mode_id] = $dropdown->mode_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_course_list($level_study)
	{
		$query = $this->db->query('select course_id, course_name from pms_courses where level_study='.$level_study.' order by course_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function fill_subject()
	{
		$query = $this->db->query('select distinct subject_id, subject_name from pms_subject order by subject_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Subject';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->subject_id] = $dropdown->subject_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_cur_subjects($id='')
	{
		if($id=='')return array();
		$query = $this->db->query('select distinct subject_id from pms_course_sub where course_id='.$id);
		$dropdowns = $query->result();
		$array_list=array();
		
		foreach($dropdowns as $dropdown)
		{
			 $array_list[] = $dropdown->subject_id;
		}
		return $array_list;
	}

	function get_course_info($course_id)
	{
		if($course_id=='')return array();
		$query = $this->db->query('select a.*,b.* from pms_courses a inner join pms_education_level b on a.level_study=b.level_id where a.course_id='.$course_id);
		$row = $query->row_array();
		return $row;
	}
	
	function fill_university()
	{
		$query = $this->db->query('select distinct univ_id, univ_name from pms_university order by univ_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select University';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->univ_id] = $dropdown->univ_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_cur_university($id='')
	{
		if($id=='')return array();
		$query = $this->db->query('select distinct univ_id from pms_course_uni where course_id='.$id);
		$dropdowns = $query->result();
		$array_list=array();
		
		foreach($dropdowns as $dropdown)
		{
			 $array_list[] = $dropdown->univ_id;
		}
		return $array_list;
	}


	function delete_records($delete_rec=array())	
	{
		if(is_array($delete_rec))
		{
			 foreach ($delete_rec as $key => $val)
 				{
					$query = $this->db->query("select course_info_attach from pms_courses courses where course_id=".$val);
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('uploads/'.$row['course_info_attach']) && $row['course_info_attach']!='')
						unlink('uploads/'.$row['course_info_attach']);
					}
					$this->db->where('course_id', $val);
					$this->db->delete('pms_courses'); 
				}
			return true;
		}else
		{
			return false;
		}
	}
	
	
}
?>