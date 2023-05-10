<?php 
class Campus extends CI_Controller {

	function Campus()
	{
		parent::__construct();
	    if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
	}
	
	function index($offset = 0)
	{	
		$this->data['cur_page']=$this->router->class;
		$this->load->model('campusmodel');
		$this->load->library('pagination');

		$start=0;
		$this->data["univ_id"]='';
		$this->data["searchterm"]='';
		
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

		if($this->input->post("univ_id")!='')
		{
			$this->data["univ_id"]=$this->input->post("univ_id");
		}

		if($this->input->get("univ_id")!='')
		{
			$this->data["univ_id"]=$this->input->get("univ_id");
		}
		if($this->input->get("searchterm")!='')
		{
			$this->data["searchterm"]=$this->input->get("searchterm");
		}	
		if($this->input->post("searchterm")!='')
		{
			$this->data["searchterm"]=$this->input->post("searchterm");
		}		
		
		$this->data['total_rows']= $this->campusmodel->record_count($this->data["searchterm"],$this->data["univ_id"]);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/campus/?sort_by=$sort_by&limit=$limit&searchterm=".$this->data["searchterm"]."&univ_id=".$this->data["univ_id"]."&$query_str";
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
		
		$this->data["page_head"]= "Manage Campus";
		// paging ends here
		$this->data["records"] = $this->campusmodel->get_list($start,$limit,$this->data["searchterm"],$sort_by,$this->data["univ_id"]);
		$this->data["university"] = $this->campusmodel->fill_university();
		
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;

		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header',$this->data);
		$this->load->view('campus/listcourse',$this->data);				
		$this->load->view('include/footer',$this->data);
	}
	
	function add()
	{	
		$this->data['cur_page']=$this->router->class;
		$this->data['formdata']=array(
		'campus_name'=> '' ,
		'univ_id' => '' ,
		'address'=> '' ,
		);
		
		$this->load->model('campusmodel');	
					
		$this->data["university"] = $this->campusmodel->fill_university();		

		if($this->input->post('campus_name'))
		{
			$this->form_validation->set_rules('campus_name', 'campus name', 'required');
			//$this->form_validation->set_rules('campus_name_dup', 'campus name', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->campusmodel->insert_record();
				redirect('campus/?ins=1&id='.$id);
			}
				// load page again for validation
				$this->data['formdata']=array(
				'campus_name'=>$this->input->post('campus_name'),
				'univ_id'=>$this->input->post('univ_id'),
				'address'=>$this->input->post('address'),
				);
		}
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->data['page_head']= 'Add Course';
		$this->load->view('include/header',$this->data);
		$this->load->view('campus/addcourse',$this->data);	
		$this->load->view('include/footer',$this->data);
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

	function edit($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$data['page_head']= 'Edit Course';
		$this->load->model('campusmodel');	
		$data['upload_root']=$this->config->item('base_url');
		$this->db->where('campus_id', $id);
		$query=$this->db->get('pms_campus');
		$data['formdata']=$query->row_array();
		$data["university"] = $this->campusmodel->fill_university();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view('include/header',$this->data);
		$this->load->view('campus/editcourse',$data);	
		$this->load->view('include/footer',$this->data);

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
						'annual_tution_fee'  => $val[2],
						'total_tution_fee'  => $val[3],
						'course_duration'  => '',
						'wkly_living_cost'  => $val[4],
						'wkly_hourly_rate'  => $val[5],
						'wkly_total_hrs'  => $val[6],
						'annual_living_cost'  => $annual_living_cost,
						'ielts_overall'  => $val[7],
						'ielts_r'  => $val[8],
						'ielts_w'  => $val[9],
						'ielts_l'  => $val[10],
						'ielts_s'  => $val[11],
						'pte_overall'  => $val[12],
						'pte_r'  => $val[13],
						'pte_w'  => $val[14],
						'pte_l'  => $val[15],
						'pte_s'  => $val[16],
						'oet_overall'  => $val[17],
						'oet_r'  => $val[18],
						'oet_w'  => $val[19],
						'oet_l'  => $val[20],
						'oet_s'  => $val[21],		
						'tofel_overall'  => $val[22],
						'tofel_r'  => $val[23],
						'tofel_w'  => $val[24],
						'tofel_l'  => $val[25],
						'tofel_s'  => $val[26],
						'gre'  => $val[27],
						'gmat'  => $val[28],
						'sat'  => $val[29],
						'10th'  => $val[30],
						'12th'  => $val[31],
						'total_percentage'  => $val[32],
						'grade'  => $val[33],
						'arrears'  => $val[34],
						'absense'  => $val[35],
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
		
		if($this->input->post('remove') && is_array($this->input->post('cur_course_id')))
		{
				foreach($this->input->post('cur_course_id') as $key => $val)
				{
					$this->db->where('campus_id', $this->input->post('campus_id'));
					$this->db->where('course_id', $val);
					$this->db->delete('pms_campus_courses');

					$this->db->where('campus_id', $this->input->post('campus_id'));
					$this->db->where('course_id', $val);
					$this->db->delete('pms_campus_courses_fees');
										
				}
				redirect('campus/connect/'.$id);
		}
		
		$this->data['formdata']= $this->campusmodel->get_campus_info($id);
		$this->data["course_list"] = $this->campusmodel->get_course_list($id);
		$this->data["cur_course_list"] = $this->campusmodel->get_cur_course_list($id);
		$this->data["cur_fee_list"] = $this->campusmodel->get_cur_fees_list($id);
		
		$this->load->view('include/header',$this->data);
		$this->load->view('campus/connect',$this->data);	
		$this->load->view('include/footer',$this->data);

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

		$data["university"] = $this->campusmodel->fill_university();
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$data['page_head']= 'Edit Course';

		$this->load->view('include/header',$this->data);
		$this->load->view('campus/editcourse',$data);	
		$this->load->view('include/footer',$this->data);
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
}
?>
