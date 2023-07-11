<?php 
class Admindept extends CI_controller{
	function Admindept()
	{
		parent::__construct();	
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		
		$this->load->model("admindeptmodel");
		$this->data['cur_page_name']=config_item('page_title').' Department ';
		$this->data['current_page_head']='Department';
		$this->data['page'] = 'admin_dept';
		$this->data['module_head'] = 'Manage Department';
		$this->data['module_explanation'] = 'add/edit/activate departments from here.';


		$this->data['tasks']	 =	'';
		$this->data['todos']	 =	'';
		$this->data['messages']	 =	'';
		$this->data['emails'] 	 =	'';	
		
	}

	function index()
	{
		$this->data['module_action'] = 'List All Departments';		
		$this->data["records"] = $this->admindeptmodel->get_list();
		$this->data["page_head"]= "Manage Admin Departments";
		$this->data['menu_flow_visted']=0;
		
		$this->load->library('pagination');
		$start=0;
		$limit=2;
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
		$this->data['total_rows']= $this->admindeptmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = $get;
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/admindept/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->admindeptmodel->get_list1($start,$limit,$sort_by,$searchterm);
		$this->data["sort_by"]=$sort_by;
		$this->data["rows"]=$start;
		$this->data["searchterm"]=$searchterm;

		$this->data['page_head'] = 'Manage Department';	

		$this->load->view("include/header",$this->data);
		$this->load->view("admindept/list",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function add()
	{
		$this->data['page_head'] = 'Add Department';	
		$this->data["formdata"] = array(
		"dep_name" => '',
		"status" => '1'
		);
		$this->data["page_head"]= "Add Admin Department";
		$this->load->model("admindeptmodel");
		if($this->input->post("dep_name"))
		{ 
			$this->form_validation->set_rules("dep_name","Admin Department","required");
			$this->form_validation->set_rules('check_dups', 'Admin Department', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 
				$formdata = array(
				"dep_name" => $this->input->post("dep_name"),
				"status" => $this->input->post("status")
				);
				$id = $this->admindeptmodel->insert_record($formdata);
				redirect('admindept/?ins=1');
			}
		}
		/*$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
		$this->load->view("include/header",$this->data);
		$this->load->view("admindept/add",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Department';	
		$this->load->model("admindeptmodel");
		if(!empty($id))
		{
			$this->data["formdata"] = $this->admindeptmodel->single_record($id);
		}
		/*$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
		$this->load->view("include/header",$this->data);
		$this->load->view("admindept/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data["page_head"]= "Edit  Department";
		$this->load->model("admindeptmodel");
		if($this->input->post("dep_name"))
		{ 
			$this->form_validation->set_rules("dep_name","Admin Department","required");
			$this->form_validation->set_rules('check_dups', 'Admin Department', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->admindeptmodel->update_record();
				redirect('admindept/?upd=1');
			}
			else
			{
				$this->data["page_head"]= "Edit Admin Department";
				$this->data["formdata"] = array(
				"dep_name" => $this->input->post("dep_name"),
				"dep_id" => $this->input->post("dep_id"),
				"status" => $this->input->post("status")
				);
				/*$this->data['menu_flow_visted']=0;
				$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
				$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
				$this->load->view("include/header",$this->data);
				$this->load->view("admindept/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		
		$this->load->model("admindeptmodel");
		if(!empty($id)){
			$msg =$this->admindeptmodel->delete_record($id);
			redirect('admindept/?del='.$msg);
			exit;
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$msg =$this->admindeptmodel->delete_record($val);
					if($msg==2) break;
				}
			redirect('admindept/?del='.$msg);	
		}
		else{
			redirect('admindept');
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
			$this->load->model('admindeptmodel');
			$this->admindeptmodel->delete_multiple_record($id_arr);
			redirect('admindept/?multi=1');
		}
		else{
			redirect('admindept');
		}
	}

	function check_dups()
	{ 
		$this->db->where("dep_name",$this->input->post("dep_name"));
		if($this->input->post("dep_id")){$this->db->where('dep_id !=', $this->input->post("dep_id"));}
		$query = $this->db->get("pms_admin_departments");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Admin dept already exists");
			return false;
		}
	}
	
	function update_inline()
	{
		$this->load->model("admindeptmodel");
		if($this->input->post("dep_name"))
		{ 
			$this->form_validation->set_rules("dep_name","Admin Department","required");
			$this->form_validation->set_rules('check_dups', 'Admin Department', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->admindeptmodel->update_record();
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
		$this->load->model("admindeptmodel");
		if(!empty($id)){
			$msg =$this->admindeptmodel->delete_record($id);
			echo "1";
			exit;
		}
		echo "0";
		exit;			
	}

}

?>