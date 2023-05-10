<?php
class Admin extends CI_controller
 {
	function __construct()
	{
		parent::__construct();	
	  	if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->load->model("adminmodel");
		$this->load->model("adminmodulemodel");
		$this->data['cur_page_name']=config_item('page_title').' Admin Users ';
		$this->data['current_page_head']='Admin Users';
		$this->data['page'] = 'admin_users';
		$this->data['module_head'] = 'Manage Admin Users';
		$this->data['module_explanation'] = 'add/edit/activate admin users from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['emails'] = '';	
		
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
		$this->data["page_head"]= "Manage Admin Users";
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
		
		$this->data['total_rows']= $this->adminmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."index.php/admin/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->load->model("adminmodulemodel");
		$this->data["records"] = $this->adminmodel->admin_list($start,$limit,$searchterm,$sort_by);
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Users';
		$this->load->view("include/header",$this->data);
		$this->load->view("admin/list",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				"email"              => "",
				"username"           => "",
				"password"           => "",
				"firstname"          => "",
				"lastname"           => "",
				"nickname"           => "",
				"designation"        => "",				
				"company_name"       => "",
				"address"            => "",
				"mobile"             => "",
				"telephone"          => "",
				"skype"              => "",
				"website"            => "",
				"pobox_address"      => "",
				"building"           => "",
				"facebook"           => "",
				"twitter"            => "",
				"linkedin"           => "",
				"logo_url"           => "",
				"type_id"            => "",
				"group_id"           => "",
				"branch_id"          => "",
				"active"             => "",				
				"admin_last_login_time"     => "",	
				"admin_last_login_ip"       => "",
				"admin_privilage"           => "",
				"admin_prof_img_url"        => "",
				"id_proof"                  => "",
				"joining_date"              => "",
				"joining_salary"            => "",
				"current_salary"            => "",
				"resigned_on"               => "",
				"remarks"                   => "",	
				"smtp_outgoing_server"      => "",
				"smtp_incoming_server"      => "",
				"smtp_username"             => "",
				"smtp_password"             => "",
				"smtp_port"                 => "",
				"status"                    => "1"
				);
				
		$this->data['page_head'] = 'Add Users';
		$this->data["group_list"] = $this->adminmodel->group_ddl();
		$this->data["type_list"] = $this->adminmodel->type_ddl();
		$this->data["dept_list"] = $this->adminmodel->department_ddl();

		if($this->input->post("firstname"))
		{ 
			$this->form_validation->set_rules("firstname","Admin Name","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 
				$data = array(
				"email"                     => $this->input->post("email"),
				"username"                  => $this->input->post("username"),
				"password"                  => $this->input->post("password"),
				"firstname"                 => $this->input->post("firstname"),
				"lastname"                  => $this->input->post("lastname"),
				"nickname"                  => $this->input->post("nickname"),
				"designation"               => $this->input->post("designation"),			
				"company_name"              => $this->input->post("company_name"),
				"address"                   => $this->input->post("address"),
				"mobile"                    => $this->input->post("mobile"),
				"telephone"                 => $this->input->post("telephone"),
				"skype"                     => $this->input->post("skype"),
				"website"                   => $this->input->post("website"),
				"pobox_address"             => $this->input->post("pobox_address"),
				"building"                  => "",
				"facebook"                  => "",
				"twitter"                   => "",
				"linkedin"                  => "",
				"logo_url"                  => "",
				"type_id"                   => $this->input->post("type_id"),
				"group_id"                  => $this->input->post("group_id"),
				"branch_id"                 => "",
				"active"                    => "",				
				"admin_last_login_time"     => "",	
				"admin_last_login_ip"       => "",
				"admin_privilage"           => "",
				"admin_prof_img_url"        => "",
				"id_proof"                  => "",
				"joining_date"              => "",
				"joining_salary"            => "",
				"current_salary"            => "",
				"resigned_on"               => "",
				"remarks"                   => "",	
				"smtp_outgoing_server"      => "",
				"smtp_incoming_server"      => "",
				"smtp_username"             => "",
				"smtp_password"             => "",
				"smtp_port"                 => "",
				"status"                    => 1
				);
				$id = $this->adminmodel->insert_record($data);
				redirect('admin/?ins=1');
			}
							
			$this->data["formdata"] = array(
					"email"                     => $this->input->post("email"),
					"username"                  => $this->input->post("username"),
					"password"                  => $this->input->post("password"),
					"firstname"                 => $this->input->post("firstname"),
					"lastname"                  => $this->input->post("lastname"),
					"nickname"                  => $this->input->post("nickname"),
					"designation"               => $this->input->post("designation"),			
					"company_name"              => $this->input->post("company_name"),
					"address"                   => $this->input->post("address"),
					"mobile"                    => $this->input->post("mobile"),
					"telephone"                 => $this->input->post("telephone"),
					"skype"                     => $this->input->post("skype"),
					"website"                   => $this->input->post("website"),
					"pobox_address"             => $this->input->post("pobox_address"),
					"building"                  => "",
					"facebook"                  => "",
					"twitter"                   => "",
					"linkedin"                  => "",
					"logo_url"                  => "",
					"type_id"                   => $this->input->post("type_id"),
					"group_id"                  => $this->input->post("group_id"),
					"branch_id"                 => "",
					"active"                    => "",				
					"admin_last_login_time"     => "",	
					"admin_last_login_ip"       => "",
					"admin_privilage"           => "",
					"admin_prof_img_url"        => "",
					"id_proof"                  => "",
					"joining_date"              => "",
					"joining_salary"            => "",
					"current_salary"            => "",
					"resigned_on"               => "",
					"remarks"                   => "",	
					"smtp_outgoing_server"      => "",
					"smtp_incoming_server"      => "",
					"smtp_username"             => "",
					"smtp_password"             => "",
					"smtp_port"                 => "",
					"status"                    => 1
					);
				
		}
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("admin/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Users';
		if(!empty($id))
		{
			if($this->input->get('delimg')=='1')
			{
				$query = $this->db->query("select admin_prof_img_url from event_admin_users where admin_id=".$id);
				if ($query->num_rows() > 0)
				{
					$row = $query->row_array();
					if(file_exists('../uploads/adminprofile/'.$row['admin_prof_img_url']) && $row['admin_prof_img_url']!=''){
						$this->db->query("update event_admin_users set admin_prof_img_url='' where admin_id=".$id);
						unlink('../uploads/adminprofile/'.$row['admin_prof_img_url']); 
					}
				}
			}
			
			//$this->data["formdata"] = $this->adminmodel->single_admin($id);
			
			$this->data["departments"] = $this->adminmodel->getadmindept($id);
			$this->data["formdata"] = $this->adminmodel->single_admin($id);
			$this->data["group_list"] = $this->adminmodel->group_ddl();
			$this->data["type_list"] = $this->adminmodel->type_ddl();
			$this->data["dept_list"] = $this->adminmodel->department_ddl();

		
		}
		
		     $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);		
			
			
		$this->load->view("include/header",$this->data);
		$this->load->view("admin/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Users';
		//if($_SESSION['vendor_session']==$this->input->post('admin_id')) redirect('admin');
		$this->data['module_action'] = 'Update Users';
		if($this->input->post("firstname"))
		{ 
			$this->form_validation->set_rules("firstname","Admin Name","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 
				$data = array(
					"email"                     => $this->input->post("email"),
					"username"                  => $this->input->post("username"),
					"firstname"                 => $this->input->post("firstname"),
					"lastname"                  => $this->input->post("lastname"),
					"nickname"                  => $this->input->post("nickname"),
					"designation"               => $this->input->post("designation"),			
					"company_name"              => $this->input->post("company_name"),
					"address"                   => $this->input->post("address"),
					"mobile"                    => $this->input->post("mobile"),
					"telephone"                 => $this->input->post("telephone"),
					"skype"                     => $this->input->post("skype"),
					"website"                   => $this->input->post("website"),
					"pobox_address"             => $this->input->post("pobox_address"),
					"building"                  => "",
					"facebook"                  => "",
					"twitter"                   => "",
					"linkedin"                  => "",
					"logo_url"                  => "",
					"type_id"                   => $this->input->post("type_id"),
					"group_id"                  => $this->input->post("group_id"),
					"branch_id"                 => "",
					"active"                    => "",				
					"admin_last_login_time"     => "",	
					"admin_last_login_ip"       => "",
					"admin_privilage"           => "",
					"admin_prof_img_url"        => "",
					"id_proof"                  => "",
					"joining_date"              => "",
					"joining_salary"            => "",
					"current_salary"            => "",
					"resigned_on"               => "",
					"remarks"                   => "",	
					"smtp_outgoing_server"      => "",
					"smtp_incoming_server"      => "",
					"smtp_username"             => "",
					"smtp_password"             => "",
					"smtp_port"                 => "",
					"status"                    => 1
					);
				$this->adminmodel->update_record($data);
				redirect('admin/?upd=1');
			}
			else
			{
					$this->data["formdata"] = array(
					"email"                     => $this->input->post("email"),
					"username"                  => $this->input->post("username"),
					"firstname"                 => $this->input->post("firstname"),
					"lastname"                  => $this->input->post("lastname"),
					"nickname"                  => $this->input->post("nickname"),
					"designation"               => $this->input->post("designation"),			
					"company_name"              => $this->input->post("company_name"),
					"address"                   => $this->input->post("address"),
					"mobile"                    => $this->input->post("mobile"),
					"telephone"                 => $this->input->post("telephone"),
					"skype"                     => $this->input->post("skype"),
					"website"                   => $this->input->post("website"),
					"pobox_address"             => $this->input->post("pobox_address"),
					"building"                  => "",
					"facebook"                  => "",
					"twitter"                   => "",
					"linkedin"                  => "",
					"logo_url"                  => "",
					"type_id"                   => $this->input->post("type_id"),
					"group_id"                  => $this->input->post("group_id"),
					"branch_id"                 => "",
					"active"                    => "",				
					"admin_last_login_time"     => "",	
					"admin_last_login_ip"       => "",
					"admin_privilage"           => "",
					"admin_prof_img_url"        => "",
					"id_proof"                  => "",
					"joining_date"              => "",
					"joining_salary"            => "",
					"current_salary"            => "",
					"resigned_on"               => "",
					"remarks"                   => "",	
					"smtp_outgoing_server"      => "",
					"smtp_incoming_server"      => "",
					"smtp_username"             => "",
					"smtp_password"             => "",
					"smtp_port"                 => "",
					"status"                    => 1
					);
					
				$this->data["group_list"] = $this->adminmodel->group_ddl();
				$this->data["type_list"] = $this->adminmodel->type_ddl();
				$this->data["dept_list"] = $this->adminmodel->department_ddl();

			$path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
			
		$this->load->view("include/header",$this->data);
		$this->load->view("admin/edit",$this->data);
		$this->load->view("include/footer",$this->data);

			}
		}
	}

	function delete($id='')
	{
		if($_SESSION['vendor_session']==$id) redirect('admin');
		if($id!='')
		{
			$this->adminmodel->delete_record($id);
			redirect('admin/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->adminmodel->delete_record($val);
					}
				redirect('admin/?del=1');
			}
			else
			{
				redirect('admin');
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
			$this->load->model('adminmodel');
			$this->adminmodel->delete_multiple_record($id_arr);
			redirect('admin/?multi=1');
		}
		else{
			redirect('admin');
		}
	}
	function changestat($id=null)
	{
		if($_SESSION['vendor_session']==$id) redirect('admin');
		if($id=='')redirect('admin');
		if($this->input->get('status')=='')redirect('admin');
		$this->db->query("update pms_admin_users set status=".$this->input->get('status')." where admin_id=".$id);
		redirect('admin?status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("username",$this->input->post("username"));
		if($this->input->post("admin_id")){$this->db->where('admin_id !=', $this->input->post("admin_id"));}
		$query = $this->db->get("pms_admin_users");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Admin username already exists");
			return false;
		}
	}
}
?>