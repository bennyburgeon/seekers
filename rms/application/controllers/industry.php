<?php 
class Industry extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');	
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
			$limit=50;
		}
		$rows='';
		$this->load->model('industrymodel');
		
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
		
		if(isset($_GET['searchterm']))
		{
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->industrymodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/industry/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->industrymodel->get_list($start,$limit,$searchterm,$sort_by);
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["limit"]=$limit;
		$this->data['page_head'] = 'Manage Job Industry';		
	
		$this->load->view('include/header');
		$this->load->view('industry/jobcatlist',$this->data);				
		$this->load->view('include/footer');		
	}	
	function add()
	{	
		$data['formdata']=array(
		'job_cat_name'=> '',
		);
		$this->load->model('industrymodel');		
		if($this->input->post('job_cat_name'))
		{
			$this->form_validation->set_rules('job_cat_name', 'job category name', 'required');
			$this->form_validation->set_rules('jobcat_name_dup', 'job category name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->industrymodel->insert_record();
				redirect('industry/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'job_cat_name'=>$this->input->post('job_cat_name'),
				);
		}
				$data['page_head']= 'Add Industry';
				$this->load->view('include/header');
				$this->load->view('industry/addjobcat',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('industrymodel');

			$data['page_head']= 'Edit Job Industry';
			$this->db->where('job_cat_id', $id);
			$query=$this->db->get('pms_job_category');
			$data['formdata']=$query->row_array();

			$this->load->view('include/header');
			$this->load->view('industry/editjobcat',$data);	
			$this->load->view('include/footer');
		}
	}

	function update()
	{
		$id=$this->input->post('job_cat_id');
		$data['page_head']= 'Edit Job Industry';
		$this->load->model('industrymodel');
		if(!empty($id))
		{
			if($this->input->post('job_cat_name'))
			{
				
				$this->form_validation->set_rules('job_cat_name', 'Industry Name', 'required');
				$this->form_validation->set_rules('jobcat_name_dup', 'Industry Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->industrymodel->update_record($id);
						redirect('industry/?upd=1');
					}else{
						// load page again for validation
						$data['formdata']=	array(
						'job_cat_id'=>$id,
						'job_cat_name'=>$this->input->post('job_cat_name'),
						);
						
						$this->load->view('include/header');
						$this->load->view('industry/editjobcat',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('industry');
			}			
		}else
		{
			redirect('industry');
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
		$this->load->model('industrymodel');
			$this->industrymodel->delete_multiple_record($id_arr);
			redirect('industry/?multi=1');
		}
		else{
			redirect('industry');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			
			// check this industry in company 
			$this->db->where('ind_id', $id);
			$query = $this->db->get('pms_company');
		
			if ($query->num_rows() > 0)
			{
				redirect('industry/?del=error&company=1');
			}

			// check this industry in jobs 
			$this->db->where('job_cat_id', $id);
			$query = $this->db->get('pms_jobs');
		
			if ($query->num_rows() > 0)
			{
				redirect('industry/?del=error&jobs=1');
			}

			// check in connection table to functional area.
			$this->db->where('job_cat_id', $id);
			$query = $this->db->get('pms_job_func_to_category');
			if ($query->num_rows() > 0)
			{
				redirect('industry/?del=error&function=1');
			}

			//check this industry in candidate job profile 
			$this->db->where('job_cat_id', $id);
			$query = $this->db->get('pms_candidate_job_profile');
			if ($query->num_rows() > 0)
			{
				redirect('industry/?del=error&jobprofile=1');
			}
					
					
			$this->db->where('job_cat_id', $id);
			$this->db->delete('pms_job_func_to_category'); 
					
			$this->db->where('job_cat_id', $id);
			$this->db->delete('pms_job_category'); 
			redirect('industry/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					// check this industry in company 
					$this->db->where('ind_id', $val);
					$query = $this->db->get('pms_company');
				
					if ($query->num_rows() > 0)
					{
						redirect('industry/?del=error&company=1');
					}
		
					// check this industry in jobs 
					$this->db->where('job_cat_id', $val);
					$query = $this->db->get('pms_jobs');
				
					if ($query->num_rows() > 0)
					{
						redirect('industry/?del=error&jobs=1');
					}
		
					// check this industry in candidate job profile 
					$this->db->where('job_cat_id', $val);
					$query = $this->db->get('pms_candidate_job_profile');
					if ($query->num_rows() > 0)
					{
						redirect('industry/?del=error&jobprofile=1');
					}					
					
					$this->db->where('job_cat_id', $val);
					$this->db->delete('pms_job_category'); 
				}
			redirect('industry/?del=1');
		}
	}
	function check_dups()
	{
		$this->db->where('job_cat_name', $this->input->post('job_cat_name'));
		if($this->input->post('job_cat_id') > 0)	$this->db->where('job_cat_id !=', $this->input->post('job_cat_id'));
		$query = $this->db->get('pms_job_category');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Industry name already used.');
			return false;
		}
	}

}
?>
