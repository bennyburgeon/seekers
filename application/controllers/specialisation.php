<?php 
class Specialisation extends CI_Controller {

	function Specialisation()
	{
		parent::__construct();
	    if(!isset($_SESSION['candidate_session']) || $_SESSION['candidate_session']=='')redirect('logout');
	}
	
	function index($offset = 0)
	{	
		$this->data['cur_page']=$this->router->class;
		$this->load->model('specialisationmodel');
		$this->load->library('pagination');

		$start=0;
		$this->data["course_id"]='';
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

		if($this->input->post("course_id")!='')
		{
			$this->data["course_id"]=$this->input->post("course_id");
		}

		if($this->input->get("course_id")!='')
		{
			$this->data["course_id"]=$this->input->get("course_id");
		}
		
		if($this->input->get("searchterm")!='')
		{
			$this->data["searchterm"]=$this->input->get("searchterm");
		}	
		if($this->input->post("searchterm")!='')
		{
			$this->data["searchterm"]=$this->input->post("searchterm");
		}		
		
		$this->data['total_rows']= $this->specialisationmodel->record_count($this->data["searchterm"],$this->data["course_id"]);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/specialisation/?sort_by=$sort_by&limit=$limit&searchterm=".$this->data["searchterm"]."&course_id=".$this->data["course_id"]."&$query_str";
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
		
		$this->data["page_head"]= "Manage Specialisation";
		// paging ends here
		$this->data["records"] = $this->specialisationmodel->get_list($start,$limit,$this->data["searchterm"],$sort_by,$this->data["course_id"]);
		$this->data["course"] = $this->specialisationmodel->fill_course();
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;

		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header',$this->data);
		$this->load->view('specialisation/listcourse',$this->data);				
		$this->load->view('include/footer',$this->data);
	}
	
	function add()
	{	
		$this->data['cur_page']=$this->router->class;
		$this->data['formdata']=array(
		'spcl_name'=> '' ,
		'course_id' => '' ,
		'spcl_name'=> '' ,
		);
		
		$this->load->model('specialisationmodel');	
					
		$this->data["course"] = $this->specialisationmodel->fill_course();		

		if($this->input->post('spcl_name'))
		{
			$this->form_validation->set_rules('spcl_name', 'specialization name', 'required');
			//$this->form_validation->set_rules('spcl_name_dup', 'specialization name', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->specialisationmodel->insert_record();
				redirect('specialisation/?ins=1&id='.$id);
			}
				// load page again for validation
				$this->data['formdata']=array(
				'spcl_name'=>$this->input->post('spcl_name'),
				'course_id'=>$this->input->post('course_id'),
				'spcl_name'=>$this->input->post('spcl_name'),
				);
		}
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->data['page_head']= 'Add Course';
		$this->load->view('include/header',$this->data);
		$this->load->view('specialisation/addcourse',$this->data);	
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
		$this->load->model('specialisationmodel');	
		$data['upload_root']=$this->config->item('base_url');
		$this->db->where('spcl_id', $id);
		$query=$this->db->get('pms_course_specialisation');
		$data['formdata']=$query->row_array();
		$data["course"] = $this->specialisationmodel->fill_course();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view('include/header',$this->data);
		$this->load->view('specialisation/editcourse',$data);	
		$this->load->view('include/footer',$this->data);

	}
	
	
	function update($id=null)
	{
         $id=$this->input->post('spcl_id');

	if(!empty($id))
		{
			if($this->input->post('spcl_name'))
			{
				$this->form_validation->set_rules('spcl_name', 'Specialisation Name', 'required');
				//$this->form_validation->set_rules('spcl_name_dup', 'Specialisation Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{
						$this->load->model('specialisationmodel');
						$id=$this->specialisationmodel->update_record($id);
						redirect('specialisation/?update=1');
					}else{
					
						// load page again for validation
						$data['formdata']=array(
						'spcl_id'=> $this->input->post('spcl_id'),
						'spcl_name'=>$this->input->post('spcl_name'),
						'course_id'=>$this->input->post('course_id'),
						'spcl_name'=>$this->input->post('spcl_name'),
						);
						
						$this->load->model('specialisationmodel');

		$data["course"] = $this->specialisationmodel->fill_course();
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$data['page_head']= 'Edit Course';

		$this->load->view('include/header',$this->data);
		$this->load->view('specialisation/editcourse',$data);	
		$this->load->view('include/footer',$this->data);
					}
			}
			else{
				redirect('specialisation');
				}
		}else{
			redirect('specialisation');
			}
	}
	
	function delete($id=null)
	{
		$this->data['cur_page']=$this->router->class;
		$this->load->model('specialisationmodel');
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		if(!empty($id))
		{		
			$delete_rec=array('0' => $id);
			$id=$this->specialisationmodel->delete_records($delete_rec);
		}elseif(is_array($this->input->post('checkbox')))
		{
			$id=$this->specialisationmodel->delete_records($this->input->post('checkbox'));
		}
		if($id==true)
			redirect('specialisation/?rows='.$rows.'&del=1');
		else
			redirect('specialisation/?rows='.$rows.'&del=0');
		
	}
	
	function check_dups()
	{
		$this->db->where('spcl_name', $this->input->post('spcl_name'));
		if($this->input->post('spcl_id') > 0)	$this->db->where('spcl_id !=', $this->input->post('spcl_id'));
		$query = $this->db->get('pms_course_specialisation');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'specialization name already used.');
			return false;
		}
	}
}
?>
