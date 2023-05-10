<?php 
class Adminmodule extends CI_controller{
	function __construct()
	{
		parent::__construct();	
	 // if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']==''//)redirect('logout');
		$_SESSION['admin_session']=1;
		$this->load->model("adminmodulemodel");
		$this->data['cur_page_name']=config_item('page_title').' Modules ';
		$this->data['current_page_head']='Modules';
		$this->data['page'] = 'admin_module';
		$this->data['module_head'] = 'Manage Admin Modules';
		$this->data['module_explanation'] = 'add/edit/activate admin modules from here.';
		

		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['emails'] = '';	
		
		$this->data['cur_page']=$this->router->class;
		
	}
	
	function index()
	{
		
		//$this->data["records"] = $this->adminmodulemodel->categoryChild(0);			
		
		
		$this->load->library('pagination');
		$searchterm='';
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=100;
		 }
		$rows='';
		$this->load->model('adminmodulemodel');
		
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
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		

		$this->data['total_rows']= $this->adminmodulemodel->record_count(0,'','','',$searchterm,'');
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		
		$config['base_url'] = $this->config->item('base_url')."index.php/adminmodule/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->adminmodulemodel->categoryChild(0,'',$start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$config['base_url'] = base_url().'index.php/adminmodule/?';
		
		$this->data['module_action'] = 'List All Modules';
		$this->data["page_head"]= "Manage Admin Modules";
		$this->data["site_url"]= $this->config->site_url();
		
		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("adminmodule/list",$this->data);
		$this->load->view("include/footer",$this->data);	
	}
	
	function add()
	{
		$this->data["formdata"] = array(
		"module_name" => '',
		"parent_id" => '',
		"module_url" => '',
		"module_description" => '',
		"module_order" => '',
		'module_class' => '',
		"status" => '1',
		);
		
		$this->data['module_action'] = 'Add New Module';

		$this->data["page_head"]= "Add Admin Module";
		if($this->input->post("module_name"))
		{ 
			$this->form_validation->set_rules("module_name","Admin Module","required");
			$this->form_validation->set_rules('check_dups', 'Admin Module', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 
				$formdata = array(
				"module_name" => $this->input->post("module_name"),
				"parent_id" =>  $this->input->post("parent_id"),
				"module_url" =>  $this->input->post("module_url"),
				"module_description" =>  $this->input->post("module_description"),
				"module_order" => $this->input->post("module_order"),
				'module_class' => $this->input->post("module_class"),
				"status" => $this->input->post("status"),
				);
				$id = $this->adminmodulemodel->insert_record($formdata);
				redirect('adminmodule/?ins=1');
			}else
			{
				$this->formdata = array(
				"module_name" => $this->input->post("module_name"),
				"parent_id" =>  $this->input->post("parent_id"),
				"module_url" =>  $this->input->post("module_url"),
				"module_description" =>  $this->input->post("module_description"),
				"module_order" => $this->input->post("module_order"),
				'module_class' => $this->input->post("module_class"),
				"status" => $this->input->post("status"),
				);			
			}
		}
		$this->data["modules_list"] = $this->adminmodulemodel->module_ddl_parent();
		$this->data['menu_flow_visted']=0;
		//$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu']='';
		$this->load->view("include/header",$this->data);	
		$this->load->view("adminmodule/add",$this->data);
		$this->load->view("include/footer",$this->data);	
	}

	function edit($id='')
	{
		$this->data['module_action'] = 'Edit Admin Module';
		$this->data["page_head"]= "Edit Admin Module";
		$this->load->model("adminmodulemodel");
		if(!empty($id))
		{
			$this->data["formdata"] = $this->adminmodulemodel->single_record($id);
		}
		$this->data["modules_list"] = $this->adminmodulemodel->module_ddl_parent();
	
		
		$this->load->view("include/header",$this->data);	
		$this->load->view("adminmodule/edit",$this->data);
		$this->load->view("include/footer",$this->data);	
	}
	
	function update()
	{
		$this->data['module_action'] = 'Edit Admin Module';
		$this->load->model("adminmodulemodel");
		if($this->input->post("module_name"))
		{ 
			$this->form_validation->set_rules("module_name","Admin Module","required");
			$this->form_validation->set_rules('check_dups', 'Admin Module', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->adminmodulemodel->update_record();
				redirect('adminmodule/?upd=1');
			}
			else
			{
				$this->data["page_head"]= "Edit Admin Module";
				$this->data["type"] = array(
				"module_name" => $this->input->post("module_name"),
				"module_id" => $this->input->post("module_id"),
				"module_order" => $this->input->post("module_order"),
				'module_class' => $this->input->post("module_class"),
				"status" => $this->input->post("status"),
				);

				$this->data['menu_flow_visted']=0;
				
				$this->load->view("include/header",$this->data);	
				$this->load->view("adminmodule/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function changestat($id=null)
	{
		if($id=='')redirect('adminmodule');
		if($this->input->get('stat')=='')redirect('adminmodule');
		$this->db->query("update pms_admin_modules set status=".$this->input->get('stat')." where module_id=".$id);
		redirect('adminmodule?stat=1');
	}

	function delete($id='')
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$this->load->model("adminmodulemodel");
		
		if(!empty($id)){
			$msg =$this->adminmodulemodel->delete_record($id);
			redirect('adminmodule/?rows='.$rows.'&del='.$msg);
			exit;
		}
		elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
				{
					$msg =$this->adminmodulemodel->delete_record($val);
					if($msg==2) break;
				}
			redirect('adminmodule/?rows='.$rows.'&del='.$msg);	
		}
		else{
			redirect('adminmodule');
		}
	}

	function check_dups()
	{ 
	
		if($this->input->post("module_name")!='divider'){
			$this->db->where("module_name",$this->input->post("module_name"));
			if($this->input->post("module_id")){$this->db->where('module_id !=', $this->input->post("module_id"));}
			$query = $this->db->get("pms_admin_modules");
			if($query->num_rows()==0) return true;
			else{
				$this->form_validation->set_message('check_dups',"Admin group already exists");
				return false;
			}
		}else{
			return true;
		}
	}
}
?>