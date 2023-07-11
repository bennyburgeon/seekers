<?php 
class Skill_mgmt extends CI_controller{
	function __construct()
	{
		parent::__construct();	
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');	
		//$controller_name = $this->router->fetch_class();
        //if(!in_array($controller_name, $_SESSION['module_url']))redirect('error_page');
		$_SESSION['admin_session']=1;
		$this->load->model("skill_mgmt_model");
		$this->data['cur_page_name']=config_item('page_title').' Modules ';
		$this->data['current_page_head']='Skills';
		$this->data['page'] = 'Skills';
		$this->data['module_head'] = 'Manage Skills';
		$this->data['module_explanation'] = 'add/edit/activate skills from here.';
		

		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['emails'] = '';	
		
		$this->data['cur_page']=$this->router->class;
		
	}
	
	function index()
	{
		$this->load->model('skill_mgmt_model');		
		$this->load->library('pagination');
		
		$this->data["searchterm"]='';
		$this->data["job_cat_id"]='';
		$this->data["func_id"]='';
		$this->data["desig_id"]='';
		
		$this->data["start"]=0;
		$this->data["limit"]=500;
		$this->data["rows"]='';
		$this->data["sort_by"] = 'asc';
		 

		if($this->input->get('limit')!='')
		{
			$limit=$this->input->get("limit");
		}

		if($this->input->post('limit')!='')
		{
			$limit=$this->input->post("limit");
		}
				
		if($this->input->get('sort_by')!='')
		{
			$this->data["sort_by"]=$this->input->get("sort_by");
		}

		if($this->input->post('sort_by')!='')
		{
			$this->data["sort_by"]=$this->input->post("sort_by");
		}
		
		
		if($this->input->get("rows")!='')
		{
			$this->data["rows"]=$this->input->get("rows");
		}
		if($this->input->post("rows")!='')
		{
			$this->data["rows"]=$this->input->post("rows");
		}

		if($this->input->get("searchterm")!='')
		{
			$this->data["searchterm"]=$this->input->get("searchterm");
		}
		if($this->input->post("searchterm")!='')
		{
			$this->data["searchterm"]=$this->input->post("searchterm");
		}		

		if($this->input->get("job_cat_id")!='')
		{
			$this->data["job_cat_id"]=$this->input->get("job_cat_id");
		}
		if($this->input->post("job_cat_id")!='')
		{
			$this->data["job_cat_id"]=$this->input->post("job_cat_id");
		}

		if($this->input->get("func_id")!='')
		{
			$this->data["func_id"]=$this->input->get("func_id");
		}
		if($this->input->post("func_id")!='')
		{
			$this->data["func_id"]=$this->input->post("func_id");
		}

		if($this->input->get("desig_id")!='')
		{
			$this->data["desig_id"]=$this->input->get("desig_id");
		}
		if($this->input->post("desig_id")!='')
		{
			$this->data["desig_id"]=$this->input->post("desig_id");
		}
								
		$this->data['total_rows']= $this->skill_mgmt_model->record_count($this->data["searchterm"],$this->data["job_cat_id"],$this->data["func_id"],$this->data["desig_id"]);
		
		$config['base_url'] = $this->config->item('base_url')."skill_mgmt/?sort_by=".$this->data["sort_by"]."&limit=".$this->data["limit"]."&searchterm=".$this->data["searchterm"]."&job_cat_id=".$this->data["job_cat_id"]."&func_id=".$this->data["func_id"]."&desig_id=".$this->data["desig_id"];
		
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$this->data["limit"];
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
		$this->data["records"] = $this->skill_mgmt_model->get_list($this->data["start"], $this->data["limit"], $this->data["sort_by"], $this->data["searchterm"],$this->data["job_cat_id"],$this->data["func_id"],$this->data["desig_id"]);
		
		$this->data["industry_list"] = $this->skill_mgmt_model->job_cat_list();
		
		if($this->data["job_cat_id"]!='')
		{
			 $this->data["func_list"]=$this->skill_mgmt_model->get_functional_by_industry($this->data["job_cat_id"]);
		}else{		
			$this->data["func_list"] =$this->skill_mgmt_model->all_func_list();
		}

		if($this->data["func_id"]!='')
		{
			 $this->data["desig_list"]=$this->skill_mgmt_model->get_designation_by_function($this->data["func_id"]);
		}else{		
			$this->data["desig_list"] =$this->skill_mgmt_model->all_designation();  
		}
		
		
		//print_r($_POST);
		//exit();
		
		$config['base_url'] = base_url().'skill_mgmt/?';
		
		$this->data['module_action'] = 'List All Skills';
		$this->data["page_head"]= "Manage Skills";
		$this->data["site_url"]= $this->config->site_url();
		
		$this->load->view("include/header",$this->data);
		$this->load->view("skill_mgmt/list",$this->data);
		$this->load->view("include/footer",$this->data);	
	}
	
	function add()
	{
		$this->data["formdata"] = array(
		"skill_name"        => '',
		"desig_id"        => '',
		"active"            => '1',
		);
		
		$this->data['module_action'] = 'Add New Skill';

		$this->data["page_head"]= "Add Skill";
		
		if($this->input->post("skill_name")!='')
		{ 
			 	$this->form_validation->set_rules("skill_name","Skill","required");
				$this->form_validation->set_rules('check_dups', 'Skill', 'callback_check_dups');
				if ($this->form_validation->run() == TRUE)
				{ 		
					$formdata = array(
					"skill_name" => $this->input->post("skill_name"),
					"active" => $this->input->post("active"),
					);
					$id = $this->skill_mgmt_model->insert_record($formdata);
					redirect('skill_mgmt/?ins=1');
				}else
				{
					$this->data["formdata"] = array(
					"skill_name" => $this->input->post("skill_name"),
					"active" => $this->input->post("active"),
					);			
				}
		}
		$this->data["desig_list"] = $this->skill_mgmt_model->all_designation();    
		
		$this->load->view("include/header",$this->data);	
		$this->load->view("skill_mgmt/add",$this->data);
		$this->load->view("include/footer",$this->data);	
	}

	function edit($id='')
	{
		$this->data['module_action'] = 'Edit Skill';
		$this->data["page_head"]= "Edit Skill";
		$this->load->model("skill_mgmt_model");
		
		if(!empty($id))
		{
			$this->data["formdata"] = $this->skill_mgmt_model->single_record($id);
		}
		
		//print_r($this->data["formdata"]);
		//exit();
		
		$this->data['cur_desig_list']=$this->skill_mgmt_model->cur_desig_list($id);
		
		$this->data["desig_list"] = $this->skill_mgmt_model->all_designation();  
		
		
		//print_r($this->data["cur_desig_list"]);
		//exit();
		
		$this->load->view("include/header",$this->data);	
		$this->load->view("skill_mgmt/edit",$this->data);
		$this->load->view("include/footer",$this->data);	
	}
	
	function update()
	{
		$this->data['module_action'] = 'Edit Skill';
		$this->load->model("skill_mgmt_model");		
		if($this->input->post("skill_name"))
		{ 
			$this->form_validation->set_rules("skill_name","Skill","required");
			$this->form_validation->set_rules('check_dups', 'Skill', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->skill_mgmt_model->update_record();
				redirect('skill_mgmt/?upd=1');
			}
			else
			{
				
				$this->data["page_head"]= "Edit Skills";
				
				$this->data["formdata"] = array(
				"skill_name" => $this->input->post("skill_name"),
				"skill_id" => $this->input->post("skill_id"),
				"active" => $this->input->post("active"),
				);
				$this->data['cur_desig_list']=$this->skill_mgmt_model->cur_desig_list($this->input->post("skill_id"));
				$this->data["desig_list"] =$this->skill_mgmt_model->all_designation();  
				
				$this->data['menu_flow_visted']=0;
				
				$this->load->view("include/header",$this->data);	
				$this->load->view("skill_mgmt/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	public function get_functional_by_industry()
	{
		$this->load->model('skill_mgmt_model');
		if(isset($_POST['job_cat_id']) && $_POST['job_cat_id']!='')
		{
			$data=array();
			$data["func_list"] = $this->skill_mgmt_model->get_functional_by_industry($_POST['job_cat_id']);
			$data = array('success' => true, 'func_list' => $data["func_list"]);
		}else{
			$data=array();
			$data["func_list"] = $this->skill_mgmt_model->all_func_list();
			$data = array('success' => true, 'func_list' => $data["func_list"]);
		}
		echo json_encode($data);
	}
	

	public function get_designation_by_function()
	{
		$this->load->model('skill_mgmt_model');
		if(isset($_POST['func_id']) && $_POST['func_id']!='')
		{
			$data=array();
			$data["desig_list"] = $this->skill_mgmt_model->get_designation_by_function($_POST['func_id']);
			$data = array('success' => true, 'desig_list' => $data["desig_list"]);
		}else{
			$data=array();
			$data["desig_list"] = $this->skill_mgmt_model->all_designation();
			$data = array('success' => true, 'desig_list' => $data["desig_list"]);
		}
		echo json_encode($data);
	}
		
	function changestat($id=null)
	{
		if($id=='')redirect('skill_mgmt');
		if($this->input->get('active')=='')redirect('skill_mgmt');
		$this->db->query("update pms_candidate_skills set active=".$this->input->get('active')." where skill_id=".$id);
		redirect('skill_mgmt?stat=1');
	}

	

	function check_dups()
	{ 
		if($this->input->post("skill_name")!='')
		{
			$this->db->where("skill_name",$this->input->post("skill_name"));
			if($this->input->post("skill_id"))
			{
				$this->db->where('skill_id !=', $this->input->post("skill_id"));
			}
			
			$query = $this->db->get("pms_candidate_skills");
			if($query->num_rows()==0) return true;
			else
			{
				$this->form_validation->set_message('check_dups',"Skill already exists");
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	
	function delete($id=0)
	{
		$this->load->model("skill_mgmt_model");		
		if(!empty($id))
		{						
			$result = $this->db->query('SELECT * FROM pms_candidate_to_skills WHERE skill_id ="'.$id.'" ' )->result();
			$result1 = $this->db->query('SELECT * FROM pms_job_to_skill WHERE skill_id ="'.$id.'" ' )->result();
			
			if((empty($result)) && (empty($result1)))
			{
				$result_val=$this->skill_mgmt_model->delete_record($id);
				redirect('skill_mgmt/?del='.$result_val);
			}
			else
			{
				redirect('skill_mgmt/?del=2');
			}
			
		}
		
		if($this->input->post("checkbox"))
		{	
			$result = $this->db->query('SELECT * FROM pms_candidate_to_skills WHERE skill_id ="'.$id.'" ' )->result();
			$result1 = $this->db->query('SELECT * FROM pms_job_to_skill WHERE skill_id ="'.$id.'" ' )->result();
			if((empty($result)) && (empty($result1)))
			{
			 	foreach ($this->input->post("checkbox") as $key => $val)
				{
					$this->skill_mgmt_model->delete_record($val);
				}
				redirect('skill_mgmt/?del=1');
			}
			else
			{
				redirect('skill_mgmt/?del=2');
			}
		}
		else
		{
			redirect('skill_mgmt');
		}
	}
	
	function multidelete()
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		
		if(count($id_arr)>0){
			
			$this->load->model('skill_mgmt_model');
			$result= $this->skill_mgmt_model->get_all_records($id_arr);
			$result1= $this->skill_mgmt_model->get_all_records1($id_arr);
			
			if((empty($result)) && (empty($result1)))
			{
				redirect('skill_mgmt/?multi=1');
			}
			else
			{
				redirect('skill_mgmt/?multi=2');}
			}
			else{
				redirect('skill_mgmt');
			}
	}
}
?>
