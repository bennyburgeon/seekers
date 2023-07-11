<?php 
class Manage_college extends CI_controller{
	
	function Manage_college()
	{
		parent::__construct();	
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->load->model("manage_college_model");
		$this->data['cur_page_name']=config_item('page_title').' College ';
		$this->data['current_page_head']='College';
		$this->data['page'] = 'manage_college';
		$this->data['module_head'] = 'Manage College';
		$this->data['module_explanation'] = 'add/edit/activate College from here.';


		$this->data['tasks']	 =	'';
		$this->data['todos']	 =	'';
		$this->data['messages']	 =	'';
		$this->data['emails'] 	 =	'';	
		
	}

	function index()
	{
		$this->data['module_action'] = 'List All College';		
		$this->data["records"] = $this->manage_college_model->get_list();
		$this->data["page_head"]= "Manage Admin College";
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
			$limit=100;
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
		$this->data['total_rows']= $this->manage_college_model->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = $get;
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."manage_college/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->manage_college_model->get_list1($start,$limit,$sort_by,$searchterm);
		$this->data["sort_by"]=$sort_by;
		$this->data["rows"]=$start;
		$this->data["searchterm"]=$searchterm;

		$this->data['page_head'] = 'Manage College';	

		$this->load->view("include/header",$this->data);
		$this->load->view("manage_college/list",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function add()
	{
		$this->data['page_head'] = 'Add College';	
		$this->data["formdata"] = array(
		"college_name" => '',
		//"status" => '1'
		);
		$this->data["page_head"]= "Add College";
		$this->load->model("manage_college_model");
		if($this->input->post("college_name"))
		{ 
			$this->form_validation->set_rules("college_name","Admin College","required");
			$this->form_validation->set_rules('check_dups', 'Admin College', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 
				$formdata = array(
				"college_name" => $this->input->post("college_name"),
				//"status" => $this->input->post("status")
				);
				$id = $this->manage_college_model->insert_record($formdata);
				redirect('manage_college/?ins=1');
			}
		}
		/*$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
		$this->load->view("include/header",$this->data);
		$this->load->view("manage_college/add",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function edit($id='')
	{
		$this->data['page_head'] = 'Edit College';	
		$this->load->model("manage_college_model");
		if(!empty($id))
		{
			$this->data["formdata"] = $this->manage_college_model->single_record($id);
		}
		/*$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
		$this->load->view("include/header",$this->data);
		$this->load->view("manage_college/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data["page_head"]= "Edit  College";
		$this->load->model("manage_college_model");
		if($this->input->post("college_name"))
		{ 
			$this->form_validation->set_rules("college_name","Admin College","required");
			$this->form_validation->set_rules('check_dups', 'Admin College', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->manage_college_model->update_record();
				redirect('manage_college/?upd=1');
			}
			else
			{
				$this->data["page_head"]= "Edit College";
				$this->data["formdata"] = array(
				"college_name" => $this->input->post("college_name"),
				"cert_id" => $this->input->post("cert_id"),
				//"status" => $this->input->post("status")
				);
				/*$this->data['menu_flow_visted']=0;
				$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
				$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
				$this->load->view("include/header",$this->data);
				$this->load->view("manage_college/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	
	
	
	function check_dups()
	{ 
		$this->db->where("college_name",$this->input->post("college_name"));
		if($this->input->post("cert_id")){$this->db->where('cert_id !=', $this->input->post("cert_id"));}
		$query = $this->db->get("pms_colleges");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Admin dept already exists");
			return false;
		}
	}
	
	function update_inline()
	{
		$this->load->model("manage_college_model");
		if($this->input->post("college_name"))
		{ 
			$this->form_validation->set_rules("college_name","Admin College","required");
			$this->form_validation->set_rules('check_dups', 'Admin College', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->manage_college_model->update_record();
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
		$this->load->model("manage_college_model");
		if(!empty($id)){
			$msg =$this->manage_college_model->delete_record($id);
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
			$this->load->model('manage_college_model');
			$result= $this->manage_college_model->get_all_records($id_arr);
			if(!empty($result))
			{
				redirect('manage_college/?multi=2');
			}
			else
			{
				redirect('manage_college/?multi=1');}
		}
		else{
			redirect('manage_college');
		}
	}
	
	function delete($id=0)
	{
		$this->load->model("manage_college_model");
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id)){
			$result = $this->db->query('SELECT * FROM pms_candidate_education WHERE college_id ="'.$id.'" ' )->result();
			if(empty($result))
			{
				$this->manage_college_model->delete_record($id);
				redirect('manage_college/?del=1');
			}
			else
			{
				redirect('manage_college/?del=2');
			}
			
		}
		if($this->input->post("checkbox"))
		{	
			$result = $this->db->query('SELECT * FROM pms_candidate_education WHERE college_id ="'.$id.'" ' )->result();
			if(empty($result))
			{
			 	foreach ($this->input->post("checkbox") as $key => $val)
				{
					$this->manage_college_model->delete_record($val);
				}
				redirect('manage_college/?del=1');
			}
			else
			{
				redirect('manage_college/?del=2');
			}
		}
		else
		{
			redirect('manage_college');
		}
	}

}

?>