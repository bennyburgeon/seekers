<?php
class Companyusers extends CI_controller
 {
	function __construct()
	{
		parent::__construct();	
	   
	   if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Users ';
		$this->data['current_page_head']='Company Users';
		$this->data['page'] = 'Users';
		$this->data['module_head'] = 'Manage Company Users';
		$this->data['module_explanation'] = 'add/edit/activate usres from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['emails'] = '';	
		$this->load->model("companyusersmodel");
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
	    $this->data['module_action'] = 'List All Users';
		$this->data["page_head"]= "Manage Company Users";
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		// paging starts here
		// paging starts here
		
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
		
		$this->data['total_rows']= $this->companyusersmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."companyusers/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->companyusersmodel->admin_list($start,$limit,$searchterm,$sort_by);
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Users';
		$this->load->view("include/header",$this->data);
		$this->load->view("companyusers/list",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				"firstname" => "",
				"lastname" => "",
				"email" => "",
				"username" => "",
				"password" =>"",
				"company_id" => "",
				"address" => "",
				"status"=>"1"
				);
		$this->data['page_head'] = 'Add Company Users';

		if($this->input->post("firstname"))
		{ 
			$this->form_validation->set_rules("firstname","Agent Name","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->companyusersmodel->insert_record();
				redirect('companyusers/?ins=1');
			}
			$this->data["formdata"] = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"company_id" => $this->input->post("company_id"),
				"address" => $this->input->post("address"),
				"status"=>$this->input->post("status")
				);
		}
		
		$this->data["company"] = $this->companyusersmodel->fill_company();
		
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("companyusers/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Company Users';
		if(!empty($id))
		{
			$this->data["formdata"] = $this->companyusersmodel->single_admin($id);
		}

		$this->data["company"] = $this->companyusersmodel->fill_company();
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("companyusers/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Company Users';
		$this->data['module_action'] = 'Update Company Users';
		if($this->input->post("firstname"))
		{ 
			$this->form_validation->set_rules("firstname","Users Name","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 			

				$this->companyusersmodel->update_record();
				redirect('companyusers/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
				"user_id" => $this->input->post("user_id"),
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"company_id" => $this->input->post("company_id"),
				"address" => $this->input->post("address"),
				"status"=>$this->input->post("status")
				);


			$path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("companyusers/edit",$this->data);
		$this->load->view("include/footer",$this->data);

			}
		}
	}

	function delete($id='')
	{
		if($_SESSION['vendor_session']==$id) redirect('companyusers');
		if($id!='')
		{
			$this->companyusersmodel->delete_record($id);
			redirect('companyusers/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->companyusersmodel->delete_record($val);
					}
				redirect('companyusers/?del=1');
			}
			else
			{
				redirect('companyusers');
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
			$this->load->model('companyusersmodel');
			$this->companyusersmodel->delete_multiple_record($id_arr);
			redirect('companyusers/?multi=1');
		}
		else{
			redirect('companyusers');
		}
	}
	function changestat($id=null)
	{
		if($id=='')redirect('companyusers');
		if($this->input->get('status')=='')redirect('companyusers');
		$this->db->query("update pms_company_users set status=".$this->input->get('status')." where user_id=".$id);
		redirect('companyusers?status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("username",$this->input->post("username"));
		if($this->input->post("user_id")){$this->db->where('user_id !=', $this->input->post("user_id"));}
		$query = $this->db->get("pms_company_users");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Users username already exists");
			return false;
		}
	}
}
?>