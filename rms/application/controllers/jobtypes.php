<?php 
class Jobtypes extends CI_Controller {

	function jobtypes()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
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
		$this->load->model('jobtypemodel');
		
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
		$this->data['total_rows']= $this->jobtypemodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/jobtypes/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->jobtypemodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Job Type';
				
				
		$this->load->view('include/header');
		$this->load->view('jobtypes/jobtypelist',$this->data);				
		$this->load->view('include/footer');

		
	}	

	
	function add()
	{	
		$data['formdata']=array(
		'job_type_name'=> '',
		'job_type_desc'=> ''
		);
		$this->load->model('jobtypemodel');		
		if($this->input->post('job_type_name'))
		{
			$this->form_validation->set_rules('job_type_name', 'job type', 'required');
			$this->form_validation->set_rules('jobtype_name_dup', 'job job type', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->jobtypemodel->insert_record();
				redirect('jobtypes/?ins=1&id='.$id);
			}
				// load page again for validation
				$data['formdata']=array(
				'job_type_name'=>$this->input->post('job_type_name'),
				'job_type_desc'=>$this->input->post('job_type_desc')
				);
		}
		
							$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);

				$this->data['page_head']= 'Add State';
				$this->load->view('include/header');
				$this->load->view('jobtypes/addjobtype',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('jobtypemodel');

			$data['page_head']= 'Edit Job Type';
			$this->db->where('job_type_id', $id);
			$query=$this->db->get('pms_job_type ');
			$data['formdata']=$query->row_array();
							$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);

			$this->load->view('include/header');
			$this->load->view('jobtypes/editjobtype',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$id = $this->input->post('job_type_id');
		$data['page_head']= 'Edit Job Type';
		$this->load->model('jobtypemodel');
		if(!empty($id))
		{
			if($this->input->post('job_type_name'))
			{
				
				$this->form_validation->set_rules('job_type_name', 'Job Type Name', 'required');
				$this->form_validation->set_rules('jobtype_name_dup', 'Job Type Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->jobtypemodel->update_record($id);
						redirect('jobtypes/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'job_type_id'=>$id,
						'job_type_name'=>$this->input->post('job_type_name'),
						'job_type_desc'=>$this->input->post('job_type_desc')
						);
						
						$this->load->view('include/header');
						$this->load->view('jobtypes/editjobtype',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('jobtypes');
			}			
		}else
		{
			redirect('jobtypes');
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
			$this->db->where('job_type_id', $id);
			$this->db->delete('pms_job_type '); 
			redirect('jobtypes/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
				
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('job_type_id', $val);
					$this->db->delete('pms_job_type '); 
				}
			redirect('jobtypes/?rows='.$rows.'&del=1');
		}
	}
	function check_dups()
	{
		$this->db->where('job_type_name', $this->input->post('job_type_name'));
		if($this->input->post('job_type_id') > 0)	$this->db->where('job_type_id !=', $this->input->post('job_type_id'));
		$query = $this->db->get('pms_job_type ');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'name already used.');
			return false;
		}
	}

}
?>
