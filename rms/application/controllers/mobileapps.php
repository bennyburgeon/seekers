<?php
class Mobileapps extends CI_controller
 {
	function __construct()
	{
		parent::__construct();
	   if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Mobile Appss ';
		$this->data['current_page_head']='Mobile Apps';
		$this->data['page'] = 'Mobile Appss';
		$this->data['module_head'] = 'Manage Mobile Apps';
		$this->data['module_explanation'] = 'add/edit/activate usres from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['obj_contact_names'] = '';	
		$this->load->model('mobileappsmodel');
	}
	
	function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
   }

     function index()	 
	 {
		 
	    $this->data['module_action'] = 'List All Mobile Appss';
		$this->data["page_head"]= "Manage Mobile Apps";
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		 $this->load->library('pagination');
		 $searchterm='';
		 $start=0;
		 $limit=25;
		
		if($this->input->get("rows")!='')
		{
			$start=$this->input->get("rows");
		}
		if($this->input->get('sort_by')!='')
		{
			$sort_by=$this->input->get("sort_by");
		}
		else
		{
			$sort_by = 'asc';
		}
		
		if($this->input->get('searchterm')!='')
		$searchterm=$this->input->get("searchterm");
		
		$this->data['total_rows']= $this->mobileappsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."index.php/mobileapps/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] = $limit;
		$config['num_links'] = $this->data['total_rows'];
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
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
		$this->data["records"] = $this->mobileappsmodel->admin_list($start,$limit,$searchterm,$sort_by);
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Mobile Appss';
		$this->load->view("include/header",$this->data);
		$this->load->view("mobileapps/list",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				"obj_title"                => "",
				"obj_content"              => "",
				"obj_type"                 =>   "",
				"obj_contact_name"         => "",
				"obj_contact_phone"        => "",
				"obj_contact_email"        => "",
				"obj_office_loc"           => "",
				"obj_nearest_bus"          => "",
				"obj_latitude"             => "",
				"obj_longitude"            => "",
				"obj_status"               =>"1"
				);
		$this->data['page_head'] = 'Add Mobile Apps';

		if($this->input->post("obj_title"))
		{ 
			$this->form_validation->set_rules("obj_content","Mobile Apps Name","required");
//			$this->form_validation->set_rules('check_dups', 'obj_contact_phone', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->mobileappsmodel->insert_record();
				redirect('mobileapps/?ins=1');
			}
			$this->data["formdata"] = array(
				"obj_title"                => $this->input->post("obj_title"),
				"obj_content"              => $this->input->post("obj_content"),
				"obj_type"                 => $this->input->post("obj_type"),
				"obj_contact_name"         => $this->input->post("obj_contact_name"),
				"obj_contact_phone"        => $this->input->post("obj_contact_phone"),
				"obj_contact_email"        => $this->input->post("obj_contact_email"),
				"obj_office_loc"           => $this->input->post("obj_office_loc"),
				"obj_nearest_bus"          => $this->input->post("obj_nearest_bus"),
				"obj_latitude"             => $this->input->post("obj_latitude"),
				"obj_longitude"            => $this->input->post("obj_longitude"),
				"obj_status"               => "1"
				);
		}
		
		$this->data["mobile_apps"] = $this->mobileappsmodel->fill_mobile_app_types();
		
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("mobileapps/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Mobile Apps';
		if(!empty($id))
		{
			$this->data["formdata"] = $this->mobileappsmodel->single_admin($id);
		}

		$this->data["mobile_apps"] = $this->mobileappsmodel->fill_mobile_app_types();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("mobileapps/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Mobile Apps';
		$this->data['module_action'] = 'Update Mobile Apps';
		if($this->input->post("obj_title"))
		{ 
			$this->form_validation->set_rules("obj_content","Mobile Apps Name","required");
//			$this->form_validation->set_rules('check_dups', 'obj_contact_phone', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 
				$this->mobileappsmodel->update_record();
				redirect('mobileapps/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
					"obj_title"                => $this->input->post("obj_title"),
					"obj_content"              => $this->input->post("obj_content"),
					"obj_type"                 => $this->input->post("obj_type"),
					"obj_contact_name"         => $this->input->post("obj_contact_name"),
					"obj_contact_phone"        => $this->input->post("obj_contact_phone"),
					"obj_contact_email"        => $this->input->post("obj_contact_email"),
					"obj_office_loc"           => $this->input->post("obj_office_loc"),
					"obj_nearest_bus"          => $this->input->post("obj_nearest_bus"),
					"obj_latitude"             => $this->input->post("obj_latitude"),
					"obj_longitude"            => $this->input->post("obj_longitude"),
					"obj_status"               => "1"
					);	

				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->load->view("include/header",$this->data);
				$this->load->view("mobileapps/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		if($id!='')
		{
			$this->mobileappsmodel->delete_record($id);
			redirect('mobileapps/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->mobileappsmodel->delete_record($val);
					}
				redirect('mobileapps/?del=1');
			}
			else
			{
				redirect('mobileapps');
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
			$this->load->model('mobileappsmodel');
			$this->mobileappsmodel->delete_multiple_record($id_arr);
			redirect('mobileapps/?multi=1');
		}
		else{
			redirect('mobileapps');
		}
	}
	function changestat($id=null)
	{
		if($id=='')redirect('mobileapps');
		if($this->input->get('obj_status')=='')redirect('mobileapps');
		$this->db->query("update pms_objects set obj_status=".$this->input->get('obj_status')." where obj_id=".$id);
		redirect('mobileapps?obj_status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("obj_contact_phone",$this->input->post("obj_contact_phone"));
		if($this->input->post("obj_id")){$this->db->where('obj_id !=', $this->input->post("obj_id"));}
		$query = $this->db->get("pms_objects");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Mobile Appss obj_contact_phone already exists");
			return false;
		}
	}
}
?>