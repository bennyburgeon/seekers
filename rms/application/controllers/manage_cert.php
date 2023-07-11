<?php 
class Manage_cert extends CI_controller{
	
	function Manage_cert()
	{
		parent::__construct();	
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		
		$this->load->model("manage_cert_model");
		$this->data['cur_page_name']=config_item('page_title').' Certifications ';
		$this->data['current_page_head']='Certifications';
		$this->data['page'] = 'manage_cert';
		$this->data['module_head'] = 'Manage Certifications';
		$this->data['module_explanation'] = 'add/edit/activate Certificationss from here.';


		$this->data['tasks']	 =	'';
		$this->data['todos']	 =	'';
		$this->data['messages']	 =	'';
		$this->data['emails'] 	 =	'';	
		
	}

	function index()
	{
		$this->data['module_action'] = 'List All Certificationss';		
		$this->data["records"] = $this->manage_cert_model->get_list();
		$this->data["page_head"]= "Manage Admin Certificationss";
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
		$this->data['total_rows']= $this->manage_cert_model->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = $get;
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/manage_cert/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->manage_cert_model->get_list1($start,$limit,$sort_by,$searchterm);
		$this->data["sort_by"]=$sort_by;
		$this->data["rows"]=$start;
		$this->data["searchterm"]=$searchterm;

		$this->data['page_head'] = 'Manage Certifications';	

		$this->load->view("include/header",$this->data);
		$this->load->view("manage_cert/list",$this->data);
		$this->load->view("include/footer",$this->data);
	}
	
	function add()
	{
		$this->data['page_head'] = 'Add Certifications';	
		$this->data["formdata"] = array(
		"cert_name" => '',
		//"status" => '1'
		);
		$this->data["page_head"]= "Add Certifications";
		$this->load->model("manage_cert_model");
		if($this->input->post("cert_name"))
		{ 
			$this->form_validation->set_rules("cert_name","Admin Certifications","required");
			$this->form_validation->set_rules('check_dups', 'Admin Certifications', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 
				$formdata = array(
				"cert_name" => $this->input->post("cert_name"),
				//"status" => $this->input->post("status")
				);
				$id = $this->manage_cert_model->insert_record($formdata);
				redirect('manage_cert/?ins=1');
			}
		}
		/*$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
		$this->load->view("include/header",$this->data);
		$this->load->view("manage_cert/add",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Certifications';	
		$this->load->model("manage_cert_model");
		if(!empty($id))
		{
			$this->data["formdata"] = $this->manage_cert_model->single_record($id);
		}
		/*$this->data['menu_flow_visted']=0;
		$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
		$this->load->view("include/header",$this->data);
		$this->load->view("manage_cert/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data["page_head"]= "Edit  Certifications";
		$this->load->model("manage_cert_model");
		if($this->input->post("cert_name"))
		{ 
			$this->form_validation->set_rules("cert_name","Admin Certifications","required");
			$this->form_validation->set_rules('check_dups', 'Admin Certifications', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->manage_cert_model->update_record();
				redirect('manage_cert/?upd=1');
			}
			else
			{
				$this->data["page_head"]= "Edit Certifications";
				$this->data["formdata"] = array(
				"cert_name" => $this->input->post("cert_name"),
				"cert_id" => $this->input->post("cert_id"),
				//"status" => $this->input->post("status")
				);
				/*$this->data['menu_flow_visted']=0;
				$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
				$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);*/
		
				$this->load->view("include/header",$this->data);
				$this->load->view("manage_cert/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	

	function check_dups()
	{ 
		$this->db->where("cert_name",$this->input->post("cert_name"));
		if($this->input->post("cert_id")){$this->db->where('cert_id !=', $this->input->post("cert_id"));}
		$query = $this->db->get("pms_candidate_certification");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Admin dept already exists");
			return false;
		}
	}
	
	function update_inline()
	{
		$this->load->model("manage_cert_model");
		if($this->input->post("cert_name"))
		{ 
			$this->form_validation->set_rules("cert_name","Admin Certifications","required");
			$this->form_validation->set_rules('check_dups', 'Admin Certifications', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->manage_cert_model->update_record();
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
		$this->load->model("manage_cert_model");
		if(!empty($id)){
			$msg =$this->manage_cert_model->delete_record($id);
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
			
			$this->load->model('manage_cert_model');
			$result= $this->manage_cert_model->get_all_records($id_arr);
			$result1= $this->manage_cert_model->get_all_records1($id_arr);
			if((empty($result)) && (empty($result1)))
			{
				redirect('manage_cert/?multi=1');
			}
			else
			{
				redirect('manage_cert/?multi=2');}
		}
		else{
			redirect('manage_cert');
		}
	}
	
	function delete($id=0)
	{
		$this->load->model("manage_cert_model");
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id)){
			$result = $this->db->query('SELECT * FROM pms_candidate_to_certification WHERE cert_id ="'.$id.'" ' )->result();
			$result1 = $this->db->query('SELECT * FROM pms_job_to_certification WHERE cert_id ="'.$id.'" ' )->result();
			if((empty($result)) && (empty($result1)))
			{
				$this->manage_cert_model->delete_record($id);
				redirect('manage_cert/?del=1');
			}
			else
			{
				redirect('manage_cert/?del=2');
			}
			
		}
		if($this->input->post("checkbox"))
		{	
			$result = $this->db->query('SELECT * FROM pms_candidate_to_certification WHERE cert_id ="'.$id.'" ' )->result();
			$result1 = $this->db->query('SELECT * FROM pms_job_to_certification WHERE cert_id ="'.$id.'" ' )->result();
			if((empty($result)) && (empty($result1)))
			{
			 	foreach ($this->input->post("checkbox") as $key => $val)
				{
					$this->manage_cert_model->delete_record($val);
				}
				redirect('manage_cert/?del=1');
			}
			else
			{
				redirect('manage_cert/?del=2');
			}
		}
		else
		{
			redirect('manage_cert');
		}
	}

}

?>