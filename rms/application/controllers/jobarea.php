<?php 
class Jobarea extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');	
		//$controller_name = $this->router->fetch_class();
        //if(!in_array($controller_name, $_SESSION['module_url']))redirect('error_page');
	}
	
	function index()
	{	
		$this->load->library('pagination');
		$searchterm='';
		$job_cat_id='';
		
		$start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
				$limit= $_GET['limit'];
			}
		else{
			$limit=25;
		}
		$rows='';
		$this->load->model('jobareamodel');
		
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

		if($this->input->get("job_cat_id")!='')
		{
			$job_cat_id=$this->input->get("job_cat_id");
		}
		
		if($this->input->post("job_cat_id")!='')
		{
			$job_cat_id=$this->input->post("job_cat_id");
		}
		
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->jobareamodel->record_count($searchterm,$job_cat_id);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/jobarea/?sort_by=$sort_by&searchterm=$searchterm$query_str&job_cat_id=".$job_cat_id;
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
		$this->data["records"] = $this->jobareamodel->get_list($start,$limit,$searchterm,$sort_by,$job_cat_id);
		$this->data["industry_list"] = $this->jobareamodel->job_cat_list();
		//echo $job_cat_id;
		//exit();
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["job_cat_id"]=$job_cat_id;
		$this->data['page_head'] = 'Manage functional area';				
				
		$this->load->view('include/header');
		$this->load->view('jobarea/jobarealist',$this->data);				
		$this->load->view('include/footer');		
	}	
	
	function add()
	{	
		$this->data['formdata']=array(
		'func_area'=> '',
		'job_cat_id'=> ''
		);
		
		$this->data['formdata']['job_cat_id']=array();
		
		$this->load->model('jobareamodel');
		$this->data["industry_list"] = $this->jobareamodel->job_cat_list();
		
		if($this->input->post('func_area'))
		{
			
			$this->form_validation->set_rules('func_area', 'Functional area', 'required');
			$this->form_validation->set_rules('func_area_dup', 'Functional area', 'callback_check_dups');
			
			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->jobareamodel->insert_record($_POST);
				
				redirect('jobarea/?ins=1&id='.$id);
			}
				// load page again for validation
				$this->data['formdata']=array(
				'func_area'=>$this->input->post('func_area'),
				'job_cat_id'=>$this->input->post('job_cat_id')
				);
				if(!is_array($this->data['formdata']['job_cat_id']))$this->data['formdata']['job_cat_id']=array();
				//print_r($_POST);
				//exit();
				
		}
				$this->data['page_head']= 'Add functional area';
				$this->load->view('include/header');
				$this->load->view('jobarea/addjobarea',$this->data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('jobareamodel');
			$this->data["industry_list"] = $this->jobareamodel->job_cat_list();

			$this->data['page_head']= 'Edit functional area';
			$this->db->where('func_id', $id);
			$query=$this->db->get('pms_job_functional_area');
			$this->data['formdata']=$query->row_array();
			
			$this->data['cur_industry']=$this->jobareamodel->get_cur_industry($id);
			
			//print_r($this->data['cur_industry']);
			//exit();

			if($this->input->get("rows")!='')
			{
				$this->data['formdata']['rows']=$this->input->get("rows");
			}	else
			{
				$this->data['formdata']['rows']='';
			}
							
			if($this->input->get("searchterm")!='')
			{
				$this->data['formdata']['searchterm']= $this->input->get("searchterm");
			}else
			{
				$this->data['formdata']['searchterm']='';
			}


//print_r($this->data['formdata']);
//exit();

			$this->load->view('include/header');
			$this->load->view('jobarea/editjobarea',$this->data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$id = $this->input->post('func_id'); 
		$this->data['page_head']= 'Edit functional area';
		$this->load->model('jobareamodel');
		$this->data["industry_list"] = $this->jobareamodel->job_cat_list();
		if(!empty($id))
		{
			if($this->input->post('func_area'))
			{
				
				$this->form_validation->set_rules('func_area', 'Functional area', 'required');
				$this->form_validation->set_rules('func_area_dup', 'Functional area', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->jobareamodel->update_record($id);
						redirect('jobarea/?update=1');
					}else{
						// load page again for validation
						$this->data['formdata']=array(
						'func_id'=>$id,
						'func_area'=>$this->input->post('func_area'),
						'job_cat_id'=>$this->input->post('job_cat_id'),
						'rows'=>$this->input->post('rows'),
						'searchterm'=>$this->input->post('searchterm')						
						);
						$this->data['cur_industry']=$this->input->post('job_cat_id');
						$this->load->view('include/header');
						$this->load->view('jobarea/editjobarea',$this->data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('jobarea');
			}			
		}else
		{
			redirect('jobarea');
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
			// check this in designation 
			$this->db->where('func_id', $id);
			$query = $this->db->get('pms_designation');
		
			if ($query->num_rows() > 0)
			{
				redirect('jobarea/?del=error&designation=1');
			}

			$this->db->where('func_id', $id);
			$this->db->delete('pms_job_func_to_category'); 
			
			$this->db->where('func_id', $id);
			$this->db->delete('pms_job_functional_area'); 
			
			redirect('jobarea/?rows='.$rows.'&del=1');
			
		}elseif(is_array($this->input->post('checkbox')))
		{
				
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					// check this in designation
					$this->db->where('func_id', $val);
					$query = $this->db->get('pms_designation');
				
					if ($query->num_rows() > 0)
					{
						redirect('jobarea/?del=error&designation=1');
					}
			
					$this->db->where('func_id', $id);
					$this->db->delete('pms_job_func_to_category'); 
			
					$this->db->where('func_id', $val);
					$this->db->delete('pms_job_functional_area'); 
				}
			redirect('jobarea/?rows='.$rows.'&del=1');
		}
	}
	
	function check_dups()
	{
		$this->db->where('func_area', $this->input->post('func_area'));
		//$this->db->where('job_cat_id =', $this->input->post('job_cat_id'));
		
		if($this->input->post('func_id') > 0)	$this->db->where('func_id !=', $this->input->post('func_id'));
		$query = $this->db->get('pms_job_functional_area');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Functional name already used.');
			return false;
		}
	}
}
?>
