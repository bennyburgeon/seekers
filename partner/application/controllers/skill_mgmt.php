<?php 
class Skill_mgmt extends CI_controller{
	function __construct()
	{
		parent::__construct();	
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$_SESSION['vendor_session']=1;
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
		
		//$this->data["records"] = $this->skill_mgmt_model->categoryChild(0);			
		
		
		$this->load->library('pagination');
		$this->data["searchterm"]='';
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=500;
		 }
		$rows='';
		$this->load->model('skill_mgmt_model');
		
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
		
		$this->data['total_rows']= $this->skill_mgmt_model->record_count($this->data["searchterm"]);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		
		$config['base_url'] = $this->config->item('base_url')."skill_mgmt/?sort_by=$sort_by&limit=$limit&searchterm=".$this->data["searchterm"]."$query_str";
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
		$this->data["records"] = $this->skill_mgmt_model->get_list(0,'',$start,$limit,$this->data["searchterm"],$sort_by);
		$this->data["skill_list"] = $this->skill_mgmt_model->module_ddl_parent();

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		
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
		"skill_name" => '',
		"parent_skill" => '',
		"active" => '1',
		);
		
		$this->data['module_action'] = 'Add New Skill';

		$this->data["page_head"]= "Add Skill";
		if($this->input->post("skill_name"))
		{ 
			 
				$formdata = array(
				"skill_name" => $this->input->post("skill_name"),
				"parent_skill" =>  $this->input->post("parent_skill"),
				"active" => $this->input->post("active"),
				);
				$id = $this->skill_mgmt_model->insert_record($formdata);
				
				if($this->input->post("parent_skill")!='0')
				{
					redirect('skill_mgmt/?ins=1&searchterm='.$this->input->post("parent_skill"));
				}else
				{
					redirect('skill_mgmt/?ins=1');
				}
				
			}else
			{
				$this->formdata = array(
				"skill_name" => $this->input->post("skill_name"),
				"parent_skill" =>  $this->input->post("parent_skill"),
				"active" => $this->input->post("active"),
				);			
			}
	
		$this->data["modules_list"] = $this->skill_mgmt_model->module_ddl_parent();
		$this->data['menu_flow_visted']=0;
		//$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu']='';
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
		$this->data["modules_list"] = $this->skill_mgmt_model->module_ddl_parent();
	
		
		$this->load->view("include/header",$this->data);	
		$this->load->view("skill_mgmt/edit",$this->data);
		$this->load->view("include/footer",$this->data);	
	}
	
	function update()
	{
		$this->data['module_action'] = 'Edit Skill';
		$this->load->model("skill_mgmt_model");
		$this->data["modules_list"] = $this->skill_mgmt_model->module_ddl_parent();
		if($this->input->post("skill_name"))
		{ 
			$this->form_validation->set_rules("skill_name","Skill","required");
			//$this->form_validation->set_rules('check_dups', 'Skill', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->skill_mgmt_model->update_record();
				redirect('skill_mgmt/?upd=1&searchterm='.$this->input->post("parent_skill"));
			}
			else
			{
				
				$this->data["page_head"]= "Edit Skills";
				
				$this->data["formdata"] = array(
				"skill_name" => $this->input->post("skill_name"),
				"skill_id" => $this->input->post("skill_id"),
				//~ "module_order" => $this->input->post("module_order"),
				
				"active" => $this->input->post("active"),
				);

				$this->data['menu_flow_visted']=0;
				
				$this->load->view("include/header",$this->data);	
				$this->load->view("skill_mgmt/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
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
	
		if($this->input->post("skill_name")!='divider')
		{
			$this->db->where("skill_name",$this->input->post("skill_name"));
			$this->db->where("parent_skill !=",$this->input->post("parent_skill"));
			
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
			return true;
		}
	}
	
	function delete($id=0)
	{
		$this->load->model("skill_mgmt_model");
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id)){
			$result = $this->db->query('SELECT * FROM pms_candidate_to_skills WHERE skill_id ="'.$id.'" ' )->result();
			$result1 = $this->db->query('SELECT * FROM pms_job_to_skill WHERE skill_id ="'.$id.'" ' )->result();
			if((empty($result)) && (empty($result1)))
			{
				$this->skill_mgmt_model->delete_record($id);
				redirect('skill_mgmt/?del=1');
			}
			else
			{
				redirect('skill_mgmt/?del=2');
			}
			
		}
		if($this->input->post("checkbox"))
		{	
			$result = $this->db->query('SELECT * FROM pms_candidate_to_skill WHERE cert_id ="'.$id.'" ' )->result();
			$result1 = $this->db->query('SELECT * FROM pms_job_to_skills WHERE cert_id ="'.$id.'" ' )->result();
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
