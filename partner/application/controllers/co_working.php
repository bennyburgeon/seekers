<?php
class Co_working extends CI_controller
 {
	function __construct()
	{
		parent::__construct();
	   if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Co-Working ';
		$this->data['current_page_head']='Co-Working';
		$this->data['page'] = 'Co-Working';
		$this->data['module_head'] = 'Manage Co-Working';
		$this->data['module_explanation'] = 'add/edit/activate records from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['obj_contact_names'] = '';	
		$this->load->model('co_workingmodel');
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
		 
	    $this->data['module_action'] = 'List All Co-Working';
		$this->data["page_head"]= "Manage Co-Working";
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
		
		$this->data['total_rows']= $this->co_workingmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."co_working/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->co_workingmodel->admin_list($start,$limit,$searchterm,$sort_by);
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Co-Working';
		$this->load->view("include/header",$this->data);
		$this->load->view("co_working/list",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				"co_work_title"                => "",
				"address"              => "",
				"vacant_from"         => "",
				"contact_name"        => "",
				"vacancy_status"           => "",
				"monthly_rent"          => "",
				"office_latitude"             => "",
				"office_longitude"            => "",
				"list_status"               =>"1"
				);
		$this->data['page_head'] = 'Add Co-Working';

		if($this->input->post("co_work_title"))
		{ 
			$this->form_validation->set_rules("co_work_title","Co-Working Name","required");
			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->co_workingmodel->insert_record();
				redirect('co_working/?ins=1');
			}
			$this->data["formdata"] = array(
				"co_work_title"                => $this->input->post("co_work_title"),
				"address"              => $this->input->post("address"),
				"vacant_from"         => $this->input->post("vacant_from"),
				"contact_name"        => $this->input->post("contact_name"),
				"vacancy_status"           => $this->input->post("vacancy_status"),
				"monthly_rent"          => $this->input->post("monthly_rent"),
				"office_latitude"             => $this->input->post("office_latitude"),
				"office_longitude"            => $this->input->post("office_longitude"),
				"list_status"               => "1"
				);
		}
		
		
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("co_working/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Co-Working';
		if(!empty($id))
		{
			$this->data["formdata"] = $this->co_workingmodel->single_admin($id);
		}
	
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("co_working/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Co-Working';
		$this->data['module_action'] = 'Update Co-Working';
		if($this->input->post("co_work_title"))
		{ 
			$this->form_validation->set_rules("co_work_title","Co-Working Name","required");

			if ($this->form_validation->run() == TRUE)
			{ 
				$this->co_workingmodel->update_record();
				redirect('co_working/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
					"co_work_title"                => $this->input->post("co_work_title"),
					"address"              => $this->input->post("address"),
					"vacant_from"         => $this->input->post("vacant_from"),
					"contact_name"        => $this->input->post("contact_name"),
					"vacancy_status"           => $this->input->post("vacancy_status"),
					"monthly_rent"          => $this->input->post("monthly_rent"),
					"office_latitude"             => $this->input->post("office_latitude"),
					"office_longitude"            => $this->input->post("office_longitude"),
					"co_work_id"            => $this->input->post("co_work_id"),
					"list_status"               => "1"
					);	

				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->load->view("include/header",$this->data);
				$this->load->view("co_working/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		if($id!='')
		{
			$this->co_workingmodel->delete_record($id);
			redirect('co_working/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->co_workingmodel->delete_record($val);
					}
				redirect('co_working/?del=1');
			}
			else
			{
				redirect('co_working');
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
			$this->load->model('co_workingmodel');
			$this->co_workingmodel->delete_multiple_record($id_arr);
			redirect('co_working/?multi=1');
		}
		else{
			redirect('co_working');
		}
	}
	
	function changestat($id=null)
	{
		if($id=='')redirect('co_working');
		if($this->input->get('list_status')=='')redirect('co_working');
		$this->db->query("update pms_co_coworking_space set list_status=".$this->input->get('list_status')." where co_work_id=".$id);
		redirect('co_working?list_status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("co_work_title",$this->input->post("co_work_title"));
		if($this->input->post("co_work_id")){$this->db->where('co_work_id !=', $this->input->post("co_work_id"));}
		$query = $this->db->get("pms_co_coworking_space");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Co-Working title already exists");
			return false;
		}
	}
}
?>