<?php 
class Jobcategory extends CI_Controller {

	function Jobcategory()
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
		$this->load->model('jobcatmodel');
		
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
		$this->data['total_rows']= $this->jobcatmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/jobcategory/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->jobcatmodel->get_list($start,$limit,$searchterm,$sort_by);
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["limit"]=$limit;
		$this->data['page_head'] = 'Manage Job Category';		
	
		$this->load->view('include/header');
		$this->load->view('jobcat/jobcatlist',$this->data);				
		$this->load->view('include/footer');		
	}	
	function add()
	{	
		$data['formdata']=array(
		'job_cat_name'=> '',
		'job_cat_parent'=> ''
		);
		$this->load->model('jobcatmodel');		
		$data["job_cat_list"] = $this->jobcatmodel->fill_parent();
		if($this->input->post('job_cat_name'))
		{
			$this->form_validation->set_rules('job_cat_name', 'job category name', 'required');
			$this->form_validation->set_rules('jobcat_name_dup', 'job category name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->jobcatmodel->insert_record();
				redirect('jobcategory/?ins=1');
			}
				// load page again for validation
				$data['formdata']=array(
				'job_cat_name'=>$this->input->post('job_cat_name'),
				'job_cat_parent'=>$this->input->post('job_cat_parent')
				);
		}
				$data['page_head']= 'Add Category';
				$this->load->view('include/header');
				$this->load->view('jobcat/addjobcat',$data);	
				$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('jobcatmodel');
			$data["job_cat_list"] = $this->jobcatmodel->fill_parent($id);

			$data['page_head']= 'Edit Job Category';
			$this->db->where('job_cat_id', $id);
			$query=$this->db->get('pms_job_category');
			$data['formdata']=$query->row_array();

			$this->load->view('include/header');
			$this->load->view('jobcat/editjobcat',$data);	
			$this->load->view('include/footer');
		}
	}

	function update()
	{
		$id=$this->input->post('job_cat_id');
		$data['page_head']= 'Edit Job Category';
		$this->load->model('jobcatmodel');
		$data["job_cat_list"] = $this->jobcatmodel->fill_parent($id);
		if(!empty($id))
		{
			if($this->input->post('job_cat_name'))
			{
				
				$this->form_validation->set_rules('job_cat_name', 'Category Name', 'required');
				$this->form_validation->set_rules('jobcat_name_dup', 'Category Name', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->jobcatmodel->update_record($id);
						redirect('jobcategory/?upd=1');
					}else{
						// load page again for validation
						$data['formdata']=	array(
						'job_cat_id'=>$id,
						'job_cat_name'=>$this->input->post('job_cat_name'),
						'job_cat_parent'=>$this->input->post('job_cat_parent')
						);
						
						$this->load->view('include/header');
						$this->load->view('jobcat/editjobcat',$data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('jobcategory');
			}			
		}else
		{
			redirect('jobcategory');
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
		$this->load->model('jobcatmodel');
			$this->jobcatmodel->delete_multiple_record($id_arr);
			redirect('jobcategory/?multi=1');
		}
		else{
			redirect('jobcategory');
		}
	}
	
	function delete($id=null)
	{
		if(!empty($id))
		{
			$this->db->where('job_cat_id', $id);
			$this->db->delete('pms_job_category'); 
			redirect('jobcategory/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
				
			 foreach ($this->input->post('delete_rec') as $key => $val)
 				{
					$this->db->where('job_cat_id', $val);
					$this->db->delete('pms_job_category'); 
				}
			redirect('jobcategory/?del=1');
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
			$this->form_validation->set_message('check_dups', 'Category name already used.');
			return false;
		}
	}

}
?>
