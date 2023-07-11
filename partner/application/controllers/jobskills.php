<?php 
class Jobskills extends CI_Controller {

	function jobskills()
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

	
	function index($offset = 0)
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
		$this->load->model('jobskillsmodel');
		
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
		$this->data['total_rows']= $this->jobskillsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."jobskills/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->jobskillsmodel->get_list($start,$limit,$searchterm,$sort_by);
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["limit"]=$limit;
		$this->data['page_head'] = 'Manage Job Skills';	
	

		$this->load->view('include/header');
		$this->load->view('jobskills/jobskillslist',$this->data);				
		$this->load->view('include/footer');		
	}	
	function add()
	{	
		$data['formdata']=array(
		'skill_name'=> '',
		'skill_desc'=> ''
		);
		$this->load->model('jobskillsmodel');		
		if($this->input->post('skill_name'))
		{
			$this->form_validation->set_rules('skill_name', 'job skill', 'required');
			$this->form_validation->set_rules('jobskill_name_dup', 'job skill', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->jobskillsmodel->insert_record();
				redirect('jobskills/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'skill_name'=>$this->input->post('skill_name'),
				'skill_desc'=>$this->input->post('skill_desc')
				);
		}
				     $path = '../js/ckfinder';
		     $width = '700px';
		    $this->editor($path, $width);
				$data['page_head']= 'Add Job Skill';
				$this->load->view('include/header');
				$this->load->view('jobskills/addjobskills',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('jobskillsmodel');

			$data['page_head']= 'Edit Job Skills';
			$this->db->where('skill_id', $id);
			$query=$this->db->get('pms_job_skills ');
			$data['formdata']=$query->row_array();
		     $path = '../js/ckfinder';
		     $width = '700px';
		    $this->editor($path, $width);
			$this->load->view('include/header');
			$this->load->view('jobskills/editjobskills',$data);	
			$this->load->view('include/footer');
		}
	}

	function update()
	{
		$id=$this->input->post('skill_id');

		$data['page_head']= 'Edit Job Skills';
		$this->load->model('jobskillsmodel');
		if(!empty($id))
		{
			if($this->input->post('skill_name'))
			{
				$this->form_validation->set_rules('skill_name', 'Job Skills Name', 'required');
				$this->form_validation->set_rules('jobskill_name_dup', 'Job Skills Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->jobskillsmodel->update_record($id);
						redirect('jobskills/?upd=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'skill_id'=>$id,
						'skill_name'=>$this->input->post('skill_name'),
						'skill_desc'=>$this->input->post('skill_desc')
						);
			 $path = '../js/ckfinder';
		     $width = '700px';
		    $this->editor($path, $width);
						$this->load->view('include/header');
						$this->load->view('jobskills/editjobskills',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('jobskills');
			}			
		}else
		{
			redirect('jobskills');
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
		$this->load->model('jobskillsmodel');
			$this->jobskillsmodel->delete_multiple_record($id_arr);
			redirect('jobskills/?multi=1');
		}
		else{
			redirect('jobskills');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('skill_id', $id);
			$this->db->delete('pms_job_skills '); 
			redirect('jobskills/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
				
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('skill_id', $val);
					$this->db->delete('pms_job_skills '); 
				}
			redirect('jobskills/?del=1');
		}
	}
	function check_dups()
	{
		$this->db->where('skill_name', $this->input->post('skill_name'));
		if($this->input->post('skill_id') > 0)	$this->db->where('skill_id !=', $this->input->post('skill_id'));
		$query = $this->db->get('pms_job_skills ');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Skill name already used.');
			return false;
		}
	}
}
?>
