<?php 
class Jobapps extends CI_Controller {

	function Jobapps()
	{
		parent::__construct();
			  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
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
		$this->load->model('jobappsmodel');
		
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
		$this->data['total_rows']= $this->jobappsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."jobapps/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		
		// paging ends here
		$this->data["records"] = $this->jobappsmodel->get_list($start,$limit,$searchterm,$sort_by);
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["limit"]=$limit;
		$this->data['page_head'] = 'Manage Job Apps';	
	

		$this->load->view('include/header');
		$this->load->view('jobapps/pagelist',$this->data);				
		$this->load->view('include/footer');		
		
	}	
	
	function add()
	{	
	 $data['formdata']=array(
		        'page_title'=>'',
				'page_content'=>'',
				'short_desc'=>'',
				'seo_keyword'=>'',
				'seo_title'=>'',
				'seo_meta_desc'=>'',
		);
		 $this->load->model('jobappsmodel');
		if($this->input->post('page_title'))
		{
			$this->form_validation->set_rules('page_title', 'Page Name', 'required');
			$this->form_validation->set_rules('page_title_dup', 'page_title', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{		
				$this->jobappsmodel->insert();
				redirect('jobapps/?ins=1');
				
			}
			
				// load page again for validation
				$data['formdata']=	$data=array(
				'page_title'=>$this->input->post('page_title'),
				'page_content'=>$this->input->post('page_content'),
				'short_desc'=>$this->input->post('short_desc'),
				'seo_keyword'=>$this->input->post('seo_keyword'),
				'seo_title'=>$this->input->post('seo_title'),
				'seo_meta_desc'=>$this->input->post('seo_meta_desc'),
				);
		}
			   $path = '../js/ckfinder';
		       $width = '700px';
		       $this->editor($path, $width);
			   $data['page_head']= 'Add Job apps';

				$this->load->view('include/header');
				$this->load->view('jobapps/addpage',$data);	
				$this->load->view('include/footer');
			
	
		
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('page_id', $id);
			$query=$this->db->get('pms_cms_pages');
			$data['formdata']=$query->row_array();
			
			   $path = '../js/ckfinder';
		       $width = '700px';
		       $this->editor($path, $width);
			$data['page_head']= 'Edit Job apps';

			$this->load->view('include/header');
			$this->load->view('jobapps/editpage',$data);	
			$this->load->view('include/footer');
		}
	}


	
	function update($id=null)
	{
		$id=$this->input->post('page_id');
		 $this->load->model('jobappsmodel');

		if(!empty($id))
		{
			if($this->input->post('page_title'))
			{
				$this->form_validation->set_rules('page_title', 'Page Name', 'required');
				$this->form_validation->set_rules('page_title_dup', 'page_title', 'callback_check_dups');
	
					if ($this->form_validation->run() == TRUE)
					{
					$this->jobappsmodel->update($id);
						redirect('jobapps/?upd=1');
					}else{
						// load page again for validation
						$data['formdata']=	$data=array(
						'page_id'=>$id,
						'page_title'=>$this->input->post('page_title'),
						'page_content'=>$this->input->post('page_content'),
						'short_desc'=>$this->input->post('short_desc'),
						'seo_keyword'=>$this->input->post('seo_keyword'),
						'seo_title'=>$this->input->post('seo_title'),
						'seo_meta_desc'=>$this->input->post('seo_meta_desc'),
						);
				
			   $path = '../js/ckfinder';
		       $width = '700px';
		       $this->editor($path, $width);
			   			$data['page_head']= 'Edit Job apps';

						$this->load->view('include/header');
						$this->load->view('jobapps/editpage',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('jobapps');
			}			
		}else
		{
			redirect('jobapps');
		}
	}
	
	function check_dups()
	{
		$this->db->where('page_title', $this->input->post('page_title'));
		if($this->input->post('page_id') > 0)	$this->db->where('page_id !=', $this->input->post('page_id'));
		$query = $this->db->get('pms_cms_pages ');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Page Title name already used.');
			return false;
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('page_id', $id);
			$this->db->delete('pms_cms_pages'); 
			redirect('jobapps?del=1');
		}	
	}
	
	function multidelete(){
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
		 $this->load->model('jobappsmodel');
			$this->jobappsmodel->delete_multiple_record($id_arr);
			redirect('jobapps/?multi=1');
		}
		else{
			redirect('jobapps');
		}
	}
		
	
}
?>
