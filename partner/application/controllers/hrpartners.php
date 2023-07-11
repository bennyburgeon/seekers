<?php
class Hrpartners extends CI_controller
 {
	function __construct()
	{
		parent::__construct();	
	   
	   if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Partners ';
		$this->data['current_page_head']='HR Partners';
		$this->data['page'] = 'Partners';
		$this->data['module_head'] = 'Manage HR Partners';
		$this->data['module_explanation'] = 'add/edit/activate users from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['emails'] = '';	
		$this->load->model("hrpartnersmodel");
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
	    $this->data['module_action'] = 'List All Partners';
		$this->data["page_head"]= "Manage HR Partners";
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
		
		$this->data['total_rows']= $this->hrpartnersmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."hrpartners/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->hrpartnersmodel->admin_list($start,$limit,$searchterm,$sort_by);
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Partners';
		$this->load->view("include/header",$this->data);
		$this->load->view("hrpartners/list",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				"firstname" => "",
				"lastname" => "",
				"email" => "",
				"mobile" => "",
				"username" => "",
				"password" =>"",
				"hr_partner_code" => "",
				"address" => "",
				"status"=>"1"
				);
				
		$this->data['page_head'] = 'Add HR Partners';

		if($this->input->post("firstname"))
		{ 
			$this->form_validation->set_rules("firstname","First Name","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');
			$this->form_validation->set_rules('check_code', 'Partner Code', 'callback_check_code');

			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->hrpartnersmodel->insert_record();
				redirect('hrpartners/?ins=1');
			}
			
			$this->data["formdata"] = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"mobile" => $this->input->post("mobile"),
				"username" => $this->input->post("username"),
				"hr_partner_code" => $this->input->post("hr_partner_code"),
				"address" => $this->input->post("address"),
				"status"=>$this->input->post("status")
				);
		}
		
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
			
		$this->load->view("include/header");
		$this->load->view("hrpartners/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit HR Partners';
		if(!empty($id))
		{
			$this->data["formdata"] = $this->hrpartnersmodel->single_admin($id);
		}

		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("hrpartners/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit HR Partners';
		$this->data['module_action'] = 'Update HR Partners';
		if($this->input->post("firstname"))
		{ 
			
			$this->form_validation->set_rules("firstname","First Name","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');
			$this->form_validation->set_rules('check_code', 'Partner Code', 'callback_check_code');
			
			if ($this->form_validation->run() == TRUE)
			{ 			
				$this->hrpartnersmodel->update_record();
				redirect('hrpartners/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
				"hr_partner_id" => $this->input->post("hr_partner_id"),
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"mobile" => $this->input->post("mobile"),
				"username" => $this->input->post("username"),
				"hr_partner_code" => $this->input->post("hr_partner_code"),
				"address" => $this->input->post("address"),
				"status"=>$this->input->post("status")
				);

				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
		
				$this->load->view("include/header",$this->data);
				$this->load->view("hrpartners/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		if($id!='')
		{
			$this->hrpartnersmodel->delete_record($id);
			redirect('hrpartners/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->hrpartnersmodel->delete_record($val);
					}
				redirect('hrpartners/?del=1');
			}
			else
			{
				redirect('hrpartners');
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
		
		if(count($id_arr)>0)
		{
			$this->load->model('hrpartnersmodel');
			$this->hrpartnersmodel->delete_multiple_record($id_arr);
			redirect('hrpartners/?multi=1');
		}
		else{
			redirect('hrpartners');
		}
	}
	function changestat($id=null)
	{
		if($id=='')redirect('hrpartners');
		if($this->input->get('status')=='')redirect('hrpartners');
		$this->db->query("update pms_hr_partners set status=".$this->input->get('status')." where hr_partner_id=".$id);
		redirect('hrpartners?status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("username",$this->input->post("username"));
		if($this->input->post("hr_partner_id")){$this->db->where('hr_partner_id !=', $this->input->post("hr_partner_id"));}
		$query = $this->db->get("pms_hr_partners");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Partners username already exists");
			return false;
		}
	}

	function check_code()
	{ 
		$this->db->where("hr_partner_code",$this->input->post("hr_partner_code"));
		if($this->input->post("hr_partner_id")){$this->db->where('hr_partner_id !=', $this->input->post("hr_partner_id"));}
		$query = $this->db->get("pms_hr_partners");
		if($query->num_rows()==0) 
			return true;
		else{
			$this->form_validation->set_message('check_code',"Partners partner code already exists already exists");
			return false;
		}
	}
		
}
?>