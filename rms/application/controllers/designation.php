<?php 
class Designation extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');	
		//$controller_name = $this->router->fetch_class();
       // if(!in_array($controller_name, $_SESSION['module_url']))redirect('error_page');
	}
	
	function index()
	{	
		$this->load->library('pagination');
		$searchterm='';
		$job_cat_id='';
		$func_id='';
		
		$start=0;
		if(isset($_GET['limit']))
		{
			if($_GET['limit']!='')
				$limit= $_GET['limit'];
		}
		else{
			$limit=500;
		}
		$rows='';
		$this->load->model('designationmodel');
		
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

		if($this->input->get("func_id")!='')
		{
			$func_id=$this->input->get("func_id");
		}
		
		if($this->input->post("func_id")!='')
		{
			$func_id=$this->input->post("func_id");
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
		
		$this->data['total_rows']= $this->designationmodel->record_count($searchterm,$func_id, $job_cat_id);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('site_url')."/designation/?sort_by=$sort_by&searchterm=$searchterm$query_str&func_id=".$func_id."&job_cat_id=".$job_cat_id;
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
		$this->data["records"] = $this->designationmodel->get_list($start,$limit,$searchterm,$sort_by,$func_id, $job_cat_id);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["job_cat_id"]=$job_cat_id;
		$this->data["func_id"]=$func_id;
		$this->data['page_head'] = 'Manage Designation';		

		$this->data["industry_list"] = $this->designationmodel->job_cat_list();
		if($this->data["job_cat_id"]!='')
		{
			 $this->data["func_list"]=$this->designationmodel->get_functional_by_industry($this->data["job_cat_id"]);
		}else{		
			$this->data["func_list"] = $this->designationmodel->all_func_list();
		}
				
		$this->load->view('include/header');
		$this->load->view('designation/designationlist',$this->data);				
		$this->load->view('include/footer');		
	}	
	
	function add()
	{	
		$this->data['formdata']=array(
		'desig_name'=> '',
		'job_cat_id'=> '',
		'func_id'    => '',
		);
		$this->load->model('designationmodel');
		if($this->input->post('desig_name'))
		{
			$this->form_validation->set_rules('desig_name', 'Designation', 'required');
			$this->form_validation->set_rules('desig_name_dup', 'Designation', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{				
				$id=$this->designationmodel->insert_record();
				redirect('designation/?ins=1&id='.$id);
			}
				$this->data['formdata']=array(
				'desig_name'=>$this->input->post('desig_name'),
				'job_cat_id'=>$this->input->post('job_cat_id'),
				'func_id'    => $this->input->post('func_id'),
				);
		}
		
		
		
		$this->data["industry_list"] = $this->designationmodel->job_cat_list();		
		if($this->input->post('job_cat_id')!='')
		{
			 $this->data["func_list"]=$this->designationmodel->get_functional_by_industry($this->input->post('job_cat_id'));
		}else{		
			$this->data["func_list"] = $this->designationmodel->all_func_list();
		}
		
		$this->data['page_head']= 'Add Designation';
		$this->load->view('include/header');
		$this->load->view('designation/adddesignation',$this->data);	
		$this->load->view('include/footer');
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->load->model('designationmodel');

			$this->data['page_head']= 'Edit Designation';
			
			$this->data['formdata']=$this->designationmodel->get_desig($id);						
			$this->data["industry_list"] = $this->designationmodel->job_cat_list();
			
			$this->data['cur_func_list']=$this->designationmodel->cur_func_list($id);
			
			if($this->data['formdata']['job_cat_id']>0)
			{
				 $this->data["func_list"]=$this->designationmodel->get_functional_by_industry($this->data['formdata']['job_cat_id']);
			}else{		
				$this->data["func_list"] = $this->designationmodel->all_func_list();
			}
			
			$this->load->view('include/header');
			$this->load->view('designation/editdesignation',$this->data);	
			$this->load->view('include/footer');
		}
	}

	function update($id=null)
	{
		$id = $this->input->post('desig_id'); 
		$this->data['page_head']= 'Edit Designation';
		$this->load->model('designationmodel');
		
		if(!empty($id))
		{
			if($this->input->post('desig_name'))
			{
				$this->form_validation->set_rules('desig_name', 'Designation', 'required');
				$this->form_validation->set_rules('desig_name_dup', 'Designation', 'callback_check_dups');
					if ($this->form_validation->run() == TRUE)
					{						
						$id=$this->designationmodel->update_record($id);
						redirect('designation/?update=1');
					}else{
						$this->data["industry_list"] = $this->designationmodel->job_cat_list();
						if($this->input->post('job_cat_id')>0)
						{
							 $this->data["func_list"]=$this->designationmodel->get_functional_by_industry($this->input->post('job_cat_id'));
						}else{		
							$this->data["func_list"] = $this->designationmodel->all_func_list();
						}		
						$this->data['cur_func_list']=$this->designationmodel->cur_func_list($id);
						// load page again for validation
						$this->data['formdata']=array(
						'desig_id'=>$id,
						'desig_name'=>$this->input->post('desig_name'),
						'job_cat_id'=>$this->input->post('job_cat_id'),
						'func_id'    => $this->input->post('func_id'),
						);
						
						$this->load->view('include/header');
						$this->load->view('designation/editdesignation',$this->data);	
						$this->load->view('include/footer');
					}
			}else
			{
				redirect('designation');
			}			
		}else
		{
			redirect('designation');
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
			$this->db->where('desig_id', $id);
			$this->db->delete('pms_designation'); 
			
			$this->db->where('desig_id', $id);
	   		$this->db->delete('pms_designation_to_function');

			redirect('designation/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{			
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('desig_id', $val);
					$this->db->delete('pms_designation'); 

					$this->db->where('desig_id', $id);
					$this->db->delete('pms_designation_to_function');
				}
			redirect('designation/?rows='.$rows.'&del=1');
		}
	}

	public function get_functional_by_industry()
	{
		$this->load->model('designationmodel');
		if(isset($_POST['job_cat_id']) && $_POST['job_cat_id']!='')
		{
			$data=array();
			$data["func_list"] = $this->designationmodel->get_functional_by_industry($_POST['job_cat_id']);
			$data = array('success' => true, 'func_list' => $data["func_list"]);
		}else{
			$data=array();
			$data["func_list"] = $this->designationmodel->all_func_list();
			$data = array('success' => true, 'func_list' => $data["func_list"]);			
		}
		echo json_encode($data);
	}
		
	function check_dups()
	{
		$this->db->where('desig_name', $this->input->post('desig_name'));
		//$this->db->where('func_id =', $this->input->post('func_id'));
		
		if($this->input->post('desig_id') > 0)	$this->db->where('desig_id !=', $this->input->post('desig_id'));
		
		$query = $this->db->get('pms_designation');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Designation already used.');
			return false;
		}
	}
}
?>
