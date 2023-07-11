<?php 
class Test_c extends CI_Controller {

	function Campus()
	{
		parent::__construct();
	    if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	}
	
	function index($offset = 0)
	{	

		$query = $this->db->query('SELECT a.candidate_id, b.eucation_id,b.level_id, b.course_id,c.course_name,c.international FROM pms_candidate a inner join pms_candidate_education b on a.candidate_id=b.candidate_id inner join pms_courses c on b.course_id=c.course_id where c.international=2 order by c.international');
		$dropdowns = $query->result_array();
		
		foreach($dropdowns as $list)
		{
			$this->db->where('course_name', $list['course_name']);
			$this->db->where('international', '1');
			$query = $this->db->get('pms_courses');
			
			if ($query->num_rows() == 0)
			{
				// insert course
				// update candidate education table to connect proper
				$data=array(
					'course_name'    => $list['course_name'],
					'international'  => 1,
					'level_study'    => $list['level_id']
				);
				$this->db->insert('pms_courses', $data);
				$new_id=$this->db->insert_id();
				
				// update candidate education database using new course id and existing level id, 
				$data=array(
				'level_id'=> $list['level_id'],
				'course_id'=> $new_id,
				);
				
			  $this->db->where('eucation_id', $list['eucation_id']);
			  $this->db->where('candidate_id', $list['candidate_id']);
			  $this->db->update('pms_candidate_education', $data);
				//echo 'Not Found<br><br><br><br>';
			}else{
				// found then leave for no reason. 
			}
		}
		
	exit();
	
	}
	


	function connect($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']= 'Connect Campus';
		$this->load->model('campusmodel');	
		$this->data['upload_root']=$this->config->item('base_url');
	
		if($this->input->post('add')=='Add' && is_array($this->input->post('course_id')))
		{
				foreach($this->input->post('course_id') as $key => $val)
				{
					// load page again for validation
					$data=array(
					'campus_id'=> $this->input->post('campus_id'),
					'course_id'=>$val,
					);
					$this->db->where('campus_id', $this->input->post('campus_id'));
					$this->db->where('course_id', $val);
					$this->db->delete('pms_campus_courses');

					$this->db->where('campus_id', $this->input->post('campus_id'));
					$this->db->where('course_id', $val);
					$this->db->delete('pms_campus_courses_fees');
																
					$this->db->insert('pms_campus_courses', $data);
					$this->db->insert('pms_campus_courses_fees', $data);
				}
						
				redirect('campus/connect/'.$id);
		}
		
		if($this->input->post('fee_details')=='Update' && $this->input->post('campus_id')!='')
		{
			foreach($_POST as $key => $val)
				{
					
					if($key!='campus_id' && $key!='fee_details')
					{
						$annual_living_cost=($val[5] * $val[6] * 53);
						
						$data=array(
						'campus_id'  => $this->input->post('campus_id'),		
						'course_id'  => $key,
						'total_semester'  => $val[0],
						'fee_per_semester'  => $val[1],
						'repeat'  => $val[36],
						'year_back'  => $val[37],
						'scholarship'  => $val[38],
						);
						
						$this->db->where('campus_id', $this->input->post('campus_id'));
						$this->db->where('course_id', $key);
						$this->db->delete('pms_campus_courses_fees');
						
						$this->db->insert('pms_campus_courses_fees', $data);
					}
				}
			redirect('campus/connect/'.$id);
		}
		


	}
	
	function update($id=null)
	{
         $id=$this->input->post('campus_id');

	if(!empty($id))
		{
			if($this->input->post('campus_name'))
			{
				$this->form_validation->set_rules('campus_name', 'Campus Name', 'required');
				//$this->form_validation->set_rules('campus_name_dup', 'Campus Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('campusmodel');
						$id=$this->campusmodel->update_record($id);
						redirect('campus/?update=1');
					}else{
					
						// load page again for validation
						$data['formdata']=array(
						'campus_id'=> $this->input->post('campus_id'),
						'campus_name'=>$this->input->post('campus_name'),
						'univ_id'=>$this->input->post('univ_id'),
						'address'=>$this->input->post('address'),
						);
						
						$this->load->model('campusmodel');

	
					}
			}
			else{
				redirect('campus');
				}
		}else{
			redirect('campus');
			}
	}

	
	function delete($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$this->load->model('campusmodel');
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		if(!empty($id))
		{		
			$delete_rec=array('0' => $id);
			$id=$this->campusmodel->delete_records($delete_rec);
		}elseif(is_array($this->input->post('checkbox')))
		{
			$id=$this->campusmodel->delete_records($this->input->post('checkbox'));
		}
		if($id==true)
			redirect('campus/?rows='.$rows.'&del=1');
		else
			redirect('campus/?rows='.$rows.'&del=0');
		
	}
	
	function check_dups()
	{
		$this->db->where('campus_name', $this->input->post('campus_name'));
		if($this->input->post('campus_id') > 0)	$this->db->where('campus_id !=', $this->input->post('campus_id'));
		$query = $this->db->get('pms_campus');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'campus name already used.');
			return false;
		}
	}


	function insert_record()
    {
		$data=array(
			'campus_name'=>$this->input->post('campus_name'),
			'address'=>$this->input->post('address'),
			'univ_id'=>$this->input->post('univ_id'),
		);
		
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }

	// add from university controller
	function insert_campus()
    {
		$data=array(
			'campus_name'=>$this->input->post('campus_name'),
			'univ_id'=>$this->input->post('univ_id'),
		);
		
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }
		
	function update_record($id)
	{
		$data=array(
		'campus_name'=>$this->input->post('campus_name'),
		'address'=>$this->input->post('address'),
		'univ_id'=>$this->input->post('univ_id'),
		);
		
       $this->db->where('campus_id', $id);
	   $this->db->update($this->table_name, $data);
	}


	function get_campus_list($university_id)
	{
		$query = $this->db->query('select campus_id, campus_name from pms_campus where univ_id='.$university_id.' order by campus_name');
		$dropdowns = $query->result();
		$dropDownList['']='Slect Campus';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->campus_id] = $dropdown->campus_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_campus_info($campus_id)
	{
		if($campus_id=='')return array();
		$query = $this->db->query('select a.*,b.* from pms_campus a inner join pms_university b on a.univ_id=b.univ_id where a.campus_id='.$campus_id);
		$row = $query->row_array();
		return $row;
	}

	function get_course_list($campus_id)
	{
		if($campus_id=='')return;
		
		$query = $this->db->query('select course_name,course_id from pms_courses where international=2 and course_id not in (select course_id from pms_campus_courses where campus_id='.$campus_id.') order by course_name');
		$dropDownList=array();
		$dropdowns = $query->result();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
		return $dropDownList;
	}

	function get_cur_course_list($campus_id)
	{
		if($campus_id=='')return;
		
		$query = $this->db->query('select a.course_name,a.course_id from pms_courses a inner join pms_campus_courses b on a.course_id=b.course_id where a.international=2 and b.campus_id='.$campus_id.' order by a.course_name');
		$dropdowns = $query->result();
		$dropDownList=array();

		
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
		
		return $dropDownList;
	}

	function get_cur_fees_list($campus_id)
	{
		if($campus_id=='')return;
		
		$query = $this->db->query('select a.course_name,a.course_id as course_id_temp,c.* from pms_courses a inner join pms_campus_courses b on a.course_id=b.course_id left join pms_campus_courses_fees c on b.campus_id=c.campus_id and b.course_id=c.course_id where a.international=2 and b.campus_id='.$campus_id.' order by a.course_name');
		$dropdowns = $query->result_array();
		$dropDownList=array();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown['course_id_temp']] = $dropdown;
		}

		return $dropDownList;
	}
		
	function delete_records($delete_rec=array())	
	{
		if(is_array($delete_rec))
		{
			 foreach ($delete_rec as $key => $val)
 				{
					$this->db->where('campus_id', $val);
					$this->db->delete('pms_campus'); 
				}
			return true;
		}else
		{
			return false;
		}
	}
	
		
}
?>
