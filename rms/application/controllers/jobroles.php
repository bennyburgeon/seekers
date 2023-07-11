<?php 
class Jobroles extends CI_Controller {

	function jobroles()
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
		$this->load->model('jobrolemodel');
		
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
		$this->data['total_rows']= $this->jobrolemodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/jobroles/?sort_by=$sort_by&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->jobrolemodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage job role';
				
				
		$this->load->view('include/header');
		$this->load->view('jobroles/listjobrole',$this->data);				
		$this->load->view('include/footer');

		
	}	
	
	
	function add()
	{	
		$data['formdata']=array(
		'role_name'=> '',
		'role_desc'=> ''
		);
		$this->load->model('jobrolemodel');		
		if($this->input->post('role_name'))
		{
			$this->form_validation->set_rules('role_name', 'Job Role', 'required');
			$this->form_validation->set_rules('jobrole_dup', 'Job Role', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->jobrolemodel->insert_record();
				redirect('jobroles/?ins=1&id='.$id);
			}
				// load page again for validation
				$data['formdata']=array(
				'role_name'=>$this->input->post('role_name'),
				'role_desc'=>$this->input->post('role_desc')
				);
		}
		
		
		$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->data['page_head']= 'Add Job Role';
				$this->load->view('include/header');
				$this->load->view('jobroles/addjobrole',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('jobrolemodel');

			$data['page_head']= 'Edit Job Role';
			$this->db->where('role_id', $id);
			$query=$this->db->get('pms_job_role');
			$data['formdata']=$query->row_array();
			$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
			$this->load->view('include/header');
			$this->load->view('jobroles/editjobrole',$data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$id = $this->input->post('role_id'); 
		$data['page_head']= 'Edit Job Role';
		$this->load->model('jobrolemodel');
		if(!empty($id))
		{
			if($this->input->post('role_name'))
			{
				
				$this->form_validation->set_rules('role_name', 'Job Role Name', 'required');
				$this->form_validation->set_rules('jobrole_dup', 'Job Role Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->jobrolemodel->update_record($id);
						redirect('jobroles/?update=1');
					}else{
						// load page again for validation
						$data['formdata']=array(
						'role_id'=>$id,
						'role_name'=>$this->input->post('role_name'),
						'role_desc'=>$this->input->post('role_desc')
						);
						
						$this->load->view('include/header');
						$this->load->view('jobroles/editjobrole',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('jobroles');
			}			
		}else
		{
			redirect('jobroles');
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
			$this->db->where('role_id', $id);
			$this->db->delete('pms_job_role'); 
			redirect('jobroles/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
				
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('role_id', $val);
					$this->db->delete('pms_job_role'); 
				}
			redirect('jobroles/?rows='.$rows.'&del=1');
		}
	}
	function check_dups()
	{
		$this->db->where('role_name', $this->input->post('role_name'));
		if($this->input->post('role_id') > 0)	$this->db->where('role_id !=', $this->input->post('role_id'));
		$query = $this->db->get('pms_job_role');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Role name already used.');
			return false;
		}
	}
}
?>
