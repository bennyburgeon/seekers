<?php 
class Courses extends CI_Controller {

	function Courses()
	{
		parent::__construct();
		if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	
	}
	
	function editor($path,$width) 
	{
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }
	function index($offset = 0)
	{	
		$this->data['cur_page']=$this->router->class;
		$this->load->model('coursemodel');
		$this->load->library('pagination');
		
		$this->data["searchterm"]='';
		$this->data["international"]='';
		$this->data["level_study"]='';

		$searchterm='';
		$start=0;
		 if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=55;
		 }
		$rows='';
		
		if($this->input->get('sort_by')!='')
		{
			$sort_by=$this->input->get("sort_by");
		}
		else
		{
			$sort_by = 'asc';
		}
		
		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		if($this->input->get("international")!='')
		{
			$this->data["international"]=$this->input->get("international");
		}

		if($this->input->get("level_study")!='')
		{
			$this->data["level_study"]=$this->input->get("level_study");
		}
						
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$this->data["searchterm"]= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->coursemodel->record_count($this->data["searchterm"],$this->data["international"],$this->data["level_study"]);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/courses/?sort_by=$sort_by&limit=$limit&searchterm=".$this->data["searchterm"]."&international=".$this->data["international"]."&level_study=".$this->data["level_study"]."&$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
		$config['num_links'] = $this->data['total_rows'];
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['full_tag_close'] = '</ul></div>';
		$this->pagination->initialize($config);
		$this->data['pagination']=$this->pagination->create_links();
		
		$this->data["page_head"]= "Manage Courses";
		// paging ends here
		$this->data["records"] = $this->coursemodel->get_list($start,$limit,$this->data["searchterm"],$sort_by,$this->data["international"],$this->data["level_study"]);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;
		
		$this->data["levels"] = $this->coursemodel->fill_levels();
		
		$this->load->view('include/header',$this->data);
		$this->load->view('courses/listcourse',$this->data);				
		$this->load->view('include/footer',$this->data);
	}
	
	function add()
	{	
		$this->data['cur_page']=$this->router->class;
		$this->data['formdata']=array(
		'course_name'=> '' ,
		'level_study' => '' ,
		'univ_id' => '' ,
		'course_details' => '' ,
		'subject_id'=> '' ,
		'mode_id'=> '' ,
		'qualification'=> '' ,
		'location'=> '' ,
		'duration'=> '' ,
		'start_date'=> '' ,
		'inquiry'=> '' ,
		'by_distance'=> '' ,
		'international'=> '' ,
		'course_info_attach' => ''
		);
		
		$this->load->model('coursemodel');	
					
		$this->data["levels"] = $this->coursemodel->fill_levels();
		$this->data["modes"] = $this->coursemodel->fill_modes();
		$this->data["subject"] = $this->coursemodel->fill_subject();
		$this->data["university"] = $this->coursemodel->fill_university();		

		if($this->input->post('course_name'))
		{
			$this->form_validation->set_rules('course_name', 'courses name', 'required');
			$this->form_validation->set_rules('course_name_dup', 'ducplicate courses name', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->coursemodel->insert_record();
				redirect('courses/?ins=1&id='.$id);
			}
				// load page again for validation
				$this->data['formdata']=array(
				'course_name'=>$this->input->post('course_name'),
				'course_details'=>$this->input->post('course_details'),
				'level_study'=>$this->input->post('level_study'),
				'subject_id'=>$this->input->post('subject_id'),
				'univ_id'=>$this->input->post('univ_id'),
				'mode_id'=>$this->input->post('mode_id'),
				'qualification'=>$this->input->post('qualification'),
				'location'=>$this->input->post('location'),
				'duration'=>$this->input->post('duration'),
				'start_date'=>$this->input->post('start_date'),
				'inquiry'=>$this->input->post('inquiry'),
				'by_distance'=>$this->input->post('by_distance'),
				'international'=>$this->input->post('international'),
				'course_info_attach'=>$this->input->post('course_info_attach')
				);
		}
		
				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->data['page_head']= 'Add Course';
				$this->load->view('include/header',$this->data);
				$this->load->view('courses/addcourse',$this->data);	
				$this->load->view('include/footer',$this->data);
	}

	function edit($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$data['page_head']= 'Edit Course';
		$this->load->model('coursemodel');	
		$data['upload_root']=$this->config->item('base_url');
		$this->db->where('course_id', $id);
		$query=$this->db->get('pms_courses');
		$data['formdata']=$query->row_array();
		$data["levels"] = $this->coursemodel->fill_levels();
		$data["modes"] = $this->coursemodel->fill_modes();
		$data["subject"] = $this->coursemodel->fill_subject();
		$data["university"] = $this->coursemodel->fill_university();
		
		$data['formdata']["subject_id"] = $this->coursemodel->fill_cur_subjects($id);
		$data['formdata']["univ_id"] = $this->coursemodel->fill_cur_university($id);
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view('include/header',$this->data);
		$this->load->view('courses/editcourse',$data);	
		$this->load->view('include/footer',$this->data);

	}

	function connect($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$this->data['page_head']= 'Connect Course';
		$this->load->model('coursemodel');	
		$this->data['upload_root']=$this->config->item('base_url');

		if($this->input->post('add') && is_array($this->input->post('national')))
		{
				foreach($this->input->post('national') as $key => $val)
				{
					// load page again for validation
					$data=array(
					'course_id'=> $this->input->post('course_id'),
					'int_course_id'=>$val,
					);
					$this->db->where('course_id', $this->input->post('course_id'));
					$this->db->where('int_course_id', $val);
					$this->db->delete('pms_courses_international');
											
					$this->db->insert('pms_courses_international', $data);
				}
				redirect('courses/connect/'.$id);
		}

		if($this->input->post('remove') && is_array($this->input->post('international')))
		{
				foreach($this->input->post('international') as $key => $val)
				{
					$this->db->where('course_id', $this->input->post('course_id'));
					$this->db->where('int_course_id', $val);
					$this->db->delete('pms_courses_international');
				}
				redirect('courses/connect/'.$id);
		}
		
		$this->data['formdata']= $this->coursemodel->get_course_info($id);
		$this->data["national"] = $this->coursemodel->get_international($id);

		$this->data["international"] = $this->coursemodel->get_international_current($id);

		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view('include/header',$this->data);
		$this->load->view('courses/connect',$this->data);	
		$this->load->view('include/footer',$this->data);

	}

	
	
		function update($id=null)
	{
         $id=$this->input->post('course_id');
		 
	if(!empty($id))
		{
			if($this->input->post('international'))
			{
				$this->form_validation->set_rules('course_name', 'Courses Name', 'required');
				$this->form_validation->set_rules('course_name_dup', 'Courses Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('coursemodel');
						$id=$this->coursemodel->update_record($id);
						redirect('courses/?update=1');
					}else{
					
						// load page again for validation
						$data['formdata']=array(
						'course_id'=> $this->input->post('course_id'),
						'course_name'=>$this->input->post('course_name'),
						'course_details' => $this->input->post('course_details'),
						'level_study'=>$this->input->post('level_study'),
						'subject_id'=>$this->input->post('subject_id'),
						'univ_id'=>$this->input->post('univ_id'),
						'mode_id'=>$this->input->post('mode_id'),
						'qualification'=>$this->input->post('qualification'),
						'location'=>$this->input->post('location'),
						'duration'=>$this->input->post('duration'),
						'start_date'=>$this->input->post('start_date'),
						'inquiry'=>$this->input->post('inquiry'),
						'by_distance'=>$this->input->post('by_distance'),
						'international'=>$this->input->post('international'),
						);
												$this->load->model('coursemodel');

     	$data["levels"] = $this->coursemodel->fill_levels();
		$data["modes"] = $this->coursemodel->fill_modes();
		$data["subject"] = $this->coursemodel->fill_subject();
		$data["university"] = $this->coursemodel->fill_university();
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$data['page_head']= 'Edit Course';

		$this->load->view('include/header',$this->data);
		$this->load->view('courses/editcourse',$data);	
		$this->load->view('include/footer',$this->data);
					}
			}
			else{
				redirect('courses');
				}
		}else{
			redirect('courses');
			}
	}
	function delete($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$this->load->model('coursemodel');
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		if(!empty($id))
		{		
			$delete_rec=array('0' => $id);
			$id=$this->coursemodel->delete_records($delete_rec);
		}elseif(is_array($this->input->post('checkbox')))
		{
			$id=$this->coursemodel->delete_records($this->input->post('checkbox'));
		}
		if($id==true)
			redirect('courses/?rows='.$rows.'&del=1');
		else
			redirect('courses/?rows='.$rows.'&del=0');
		
	}
	
	function check_dups()
	{
		$this->db->where('course_name', $this->input->post('course_name'));
		
		if($this->input->post('course_id') > 0)	    $this->db->where('course_id !=', $this->input->post('course_id'));
		if($this->input->post('level_study') > 0)	$this->db->where('level_study', $this->input->post('level_study'));
		if($this->input->post('international') > 0)	$this->db->where('international', $this->input->post('international'));
		
		$query = $this->db->get('pms_courses');
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'courses name already used.');
			return false;
		}
	}

	function do_upload()
	{
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'doc|docx|pdf';
		$config['max_size']	= '0';
		//$config['max_width']  = '1024';
		//$config['max_height']  = '768';
		//print_r($_FILES);
//		echo $this->input->post('course_info_attach');
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($this->input->post('course_info_attach')))
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
			exit();
			return false;
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());

			return $data;
		}
	}

}
?>
