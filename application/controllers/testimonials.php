<?php 
class Testimonials extends CI_Controller {

	function testimonials()
	{
		parent::__construct();
	  if(!isset($_SESSION['candidate_session']) || $_SESSION['candidate_session']=='')redirect('logout');

	}
	function editor($path,$width) {
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

	function index()
	{	
		$this->load->library('pagination');
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=5;
		}
		$rows='';
		$this->load->model('testimonialsmodel');
		
		// paging starts here
		
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
		
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->testimonialsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/testimonials/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->testimonialsmodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Testimonials';
				
				
		$this->load->view('include/header');
		$this->load->view('testimonials/list',$this->data);				
		$this->load->view('include/footer');

		
	}	
	function add()
	{	
		$data['formdata']=array(
		'test_title'=> '',
		'test_desc'=> '',
		'test_client_name'=> '',
		'test_email'=> '',
		'test_phone'=> ''
		);
		
		$this->load->model('testimonialsmodel');	
		
		if($this->input->post('test_title'))
		{
			$this->form_validation->set_rules('test_title', 'testimonials', 'required');
			$this->form_validation->set_rules('test_title_dup', 'testimonials title', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->testimonialsmodel->insert_record();
				redirect('testimonials/?ins=1&id='.$id);
			}
				// load page again for validation
				$data['formdata'] =	array(
				'test_title' =>$this->input->post('test_title'),
				'test_desc' => $this->input->post('test_desc'),
				'test_client_name' =>$this->input->post('test_client_name'),
				'test_email' =>$this->input->post('test_email'),
				'test_phone' =>$this->input->post('test_phone')
				);
		}
		
				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);

				$this->data['page_head']= 'Add Testimonials';
				$this->load->view('include/header');
				$this->load->view('testimonials/add',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$data['page_head']= 'Edit Testimonials';
			$this->db->where('test_id', $id);
			$query=$this->db->get('pms_testimonials');
			$data['formdata']=$query->row_array();
			
			$this->load->model('testimonialsmodel');	

			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);

			$this->load->view('include/header');
			$this->load->view('testimonials/edit',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$id = $this->input->post('test_id');
		$data['page_head']= 'Edit Testimonials';
		$this->load->model('testimonialsmodel');
		if(!empty($id))
		{
			if($this->input->post('test_title'))
			{
							


				$this->form_validation->set_rules('test_title', 'Testimonials Name', 'required');
				$this->form_validation->set_rules('test_title_dup', 'Testimonials Name', 'callback_check_dups');
				
					if ($this->form_validation->run() == TRUE)
					{
						$id=$this->testimonialsmodel->update_record($id);
						redirect('testimonials/?update=1');
					}else{
						$data['formdata'] =	array(
						'test_id'=>$id,
						'test_title'=>$this->input->post('test_title'),
						'test_desc'=> $this->input->post('test_desc'),
						'test_client_name'=>$this->input->post('test_client_name'),
						'test_email'=>$this->input->post('test_email'),
						'test_phone'=>$this->input->post('test_phone')
						);						
							
						$this->load->view('common/header');
						$this->load->view('testimonials/edittest',$data);	
						$this->load->view('common/footer');
					}
			}else
			{
				redirect('testimonials');
			}			
		}else
		{
			redirect('testimonials');
		}
	}
	
	function delete($id=null)
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}

		if(!empty($id))
		{
			$this->db->where('test_id', $id);
			$this->db->delete('pms_testimonials'); 
			redirect('testimonials/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('test_id', $val);
					$this->db->delete('pms_testimonials'); 
				}
			redirect('testimonials/?rows='.$rows.'&del=1');
		}
	}
	function check_dups()
	{
		$this->db->where('test_title', $this->input->post('test_title'));
		if($this->input->post('test_id') > 0)	$this->db->where('test_id !=', $this->input->post('test_id'));
		$query = $this->db->get('pms_testimonials');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Testimonials name already used.');
			return false;
		}
	}
}
?>
