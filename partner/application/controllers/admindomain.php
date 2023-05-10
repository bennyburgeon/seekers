<?php 
class Admindomain extends CI_controller{
		function __construct()
	{
		parent::__construct();	
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->load->model("admindomainmodel");
		$this->data['cur_page_name']=config_item('page_title').' Domain ';
		$this->data['current_page_head']='Domain';
		$this->data['page'] = 'admin_domain';
		$this->data['module_head'] = 'Manage Domain';
		$this->data['module_explanation'] = 'add/edit/activate domains from here.';


		$this->data['tasks']	 =	'';
		$this->data['todos']	 =	'';
		$this->data['messages']	 =	'';
		$this->data['emails'] 	 =	'';	
		
	}

	function index()
	{
		$this->load->model("admindomainmodel");
		$this->data['module_action'] = 'List All Domains';		
		$this->data["records"] = $this->admindomainmodel->get_list();
		$this->data["page_head"]= "Manage Admin Domains";
		$this->data['menu_flow_visted']=0;
		
		$this->load->library('pagination');
		$start=0;
		if(isset($_GET['limit']))
		{
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		}
		else
		{
			$limit=10;
		}
		$searchterm='';
		// paging starts here
		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}
		if($this->input->get("sort_by")!='')
		{
			$sort_by=$this->input->get("sort_by");
		}
		else{
			$sort_by='asc';
			}
		if($this->input->get("searchterm")!='')
		{
			$searchterm=$this->input->get("searchterm");
		}
		$this->data['total_rows']= $this->admindomainmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = $get;
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."admindomain/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] = $limit;
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
		$this->data["records"] = $this->admindomainmodel->get_list1($start,$limit,$sort_by,$searchterm);
		$this->data["sort_by"]=$sort_by;
		$this->data["rows"]=$start;
		$this->data["searchterm"]=$searchterm;

		$this->data['page_head'] = 'Manage Domain';	

		$this->load->view("include/header",$this->data);
		$this->load->view("admindomain/list",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function add()
	{
		$this->data['page_head'] = 'Add Domain';	
		$this->data["formdata"] = array(
		"domain_name" => '',
		"active" => '1'
		);
		$this->data["page_head"]= "Add Admin Domain";
		$this->load->model("admindomainmodel");
		if($this->input->post("domain_name"))
		{ 
			$this->form_validation->set_rules("domain_name","Admin Domain","required");
			$this->form_validation->set_rules('check_dups', 'Admin Domain', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 
				$formdata = array(
				"domain_name" => $this->input->post("domain_name"),
				"active" => $this->input->post("active")
				);
				$id = $this->admindomainmodel->insert_record($formdata);
				redirect('admindomain/?ins=1');
			}
		}
		/*$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
		$this->load->view("include/header",$this->data);
		$this->load->view("admindomain/add",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Domain';	
		$this->load->model("admindomainmodel");
		if(!empty($id))
		{
			$this->data["formdata"] = $this->admindomainmodel->single_record($id);
		}
		/*$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
		$this->load->view("include/header",$this->data);
		$this->load->view("admindomain/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data["page_head"]= "Edit  Domain";
		$this->load->model("admindomainmodel");
		if($this->input->post("domain_name"))
		{ 
			$this->form_validation->set_rules("domain_name","Admin Domain","required");
			$this->form_validation->set_rules('check_dups', 'Admin Domain', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->admindomainmodel->update_record();
				redirect('admindomain/?upd=1');
			}
			else
			{
				$this->data["page_head"]= "Edit Admin Domain";
				$this->data["formdata"] = array(
				"domain_name" => $this->input->post("domain_name"),
				"domain_id" => $this->input->post("domain_id"),
				"active" => $this->input->post("active")
				);
				/*$this->data['menu_flow_visted']=0;
				$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
				$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
				$this->load->view("include/header",$this->data);
				$this->load->view("admindomain/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	

	function check_dups()
	{ 
		$this->db->where("domain_name",$this->input->post("domain_name"));
		if($this->input->post("domain_id")){$this->db->where('domain_id !=', $this->input->post("domain_id"));}
		$query = $this->db->get("pms_candidate_domain");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Admin domain already exists");
			return false;
		}
	}
	
	function update_inline()
	{
		$this->load->model("admindomainmodel");
		if($this->input->post("domain_name"))
		{ 
			$this->form_validation->set_rules("domain_name","Admin Domain","required");
			$this->form_validation->set_rules('check_dups', 'Admin Domain', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->admindomainmodel->update_record();
				echo "1";
				exit;
			}
			
		}
		echo "0";
		exit;
	}
	
	function delete_inline()
	{
		$id=$this->input->post("id");
		$this->load->model("admindomainmodel");
		if(!empty($id)){
			$msg =$this->admindomainmodel->delete_record($id);
			echo "1";
			exit;
		}
		echo "0";
		exit;			
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
			
			$this->load->model('admindomainmodel');
			$result= $this->admindomainmodel->get_all_records($id_arr);
			$result1= $this->admindomainmodel->get_all_records1($id_arr);
			if((empty($result)) && (empty($result1)))
			{
				redirect('admindomain/?multi=1');
			}
			else
			{
				redirect('admindomain/?multi=2');}
		}
		else{
			redirect('admindomain');
		}
	}
	
	function delete($id=0)
	{
		$this->load->model("admindomainmodel");
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id)){
			$result = $this->db->query('SELECT * FROM pms_candidate_to_domain WHERE domain_id ="'.$id.'" ' )->result();
			$result1 = $this->db->query('SELECT * FROM pms_job_to_domain WHERE domain_id ="'.$id.'" ' )->result();
			if((empty($result)) && (empty($result1)))
			{
				$this->admindomainmodel->delete_record($id);
				redirect('admindomain/?del=1');
			}
			else
			{
				redirect('admindomain/?del=2');
			}
			
		}
		if($this->input->post("checkbox"))
		{	
			$result = $this->db->query('SELECT * FROM pms_candidate_to_domain WHERE domain_id ="'.$id.'" ' )->result();
			$result1 = $this->db->query('SELECT * FROM pms_job_to_domain WHERE domain_id ="'.$id.'" ' )->result();
			if((empty($result)) && (empty($result1)))
			{
			 	foreach ($this->input->post("checkbox") as $key => $val)
				{
					$this->admindomainmodel->delete_record($val);
				}
				redirect('admindomain/?del=1');
			}
			else
			{
				redirect('admindomain/?del=2');
			}
		}
		else
		{
			redirect('admindomain');
		}
	}

}
