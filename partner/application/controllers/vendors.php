<?php
class Vendors extends CI_controller
 {
	function __construct()
	{
		parent::__construct();	
	   
	   if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Vendors ';
		$this->data['current_page_head']='Company Vendors';
		$this->data['page'] = 'Vendors';
		$this->data['module_head'] = 'Manage Vendors';
		$this->data['module_explanation'] = 'add/edit/activate vendors from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['emails'] = '';	
		$this->load->model("vendorsmodel");
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
	    $this->data['module_action'] = 'List Vendors';
		$this->data["page_head"]= "Manage Vendors";
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
		
		$this->data['total_rows']= $this->vendorsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."vendors/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->vendorsmodel->admin_list($start,$limit,$searchterm,$sort_by);
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Vendors';
		$this->load->view("include/header",$this->data);
		$this->load->view("vendors/list",$this->data);
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
				"address" => "",
				"job_cat_id"   => "",
				"grade_id"   => "",
				"status"=>"1"
				);
		$this->data["grade_list"] = array(
				"1" => "Entry Level",
				"2" => "Middle Level",
				"3" => "Senior Level",
				"4" => "Top Level",
				);		
		$this->data["jobindustry"] = $this->vendorsmodel->fill_industry();
		
		$this->data['page_head'] = 'Add Vendors';
		
		if($this->input->post("firstname"))
		{ 
			$this->form_validation->set_rules("firstname","Vendor Name","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->vendorsmodel->insert_record();
				redirect('vendors/?ins=1');
			}
			$this->data["formdata"] = array(
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"address" => $this->input->post("address"),
				"job_cat_id"   => $this->input->post("job_cat_id"),
				"grade_id"   => $this->input->post("grade_id"),
				"status"=>$this->input->post("status")
				);
		}
		
		
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("vendors/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Vendors';
		if(!empty($id))
		{
			$this->data["formdata"] = $this->vendorsmodel->single_admin($id);
		}
		
		$this->data["grade_list"] = array(
				"1" => "Entry Level",
				"2" => "Middle Level",
				"3" => "Senior Level",
				"4" => "Top Level",
				);		
		$this->data["jobindustry"] = $this->vendorsmodel->fill_industry();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("vendors/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Vendors';
		$this->data['module_action'] = 'Update Vendors';
		
		$this->data["grade_list"] = array(
				"1" => "Entry Level",
				"2" => "Middle Level",
				"3" => "Senior Level",
				"4" => "Top Level",
				);		
		$this->data["jobindustry"] = $this->vendorsmodel->fill_industry();
				
		if($this->input->post("firstname"))
		{ 
			$this->form_validation->set_rules("firstname","Vendors Name","required");
			$this->form_validation->set_rules('check_dups', 'Username', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{ 			

				$this->vendorsmodel->update_record();
				redirect('vendors/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
				"vendor_id" => $this->input->post("vendor_id"),
				"firstname" => $this->input->post("firstname"),
				"lastname" => $this->input->post("lastname"),
				"email" => $this->input->post("email"),
				"username" => $this->input->post("username"),
				"address" => $this->input->post("address"),
				"job_cat_id"   => $this->input->post("job_cat_id"),
				"grade_id"   => $this->input->post("grade_id"),
				"status"=>$this->input->post("status")
				);


			$path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header",$this->data);
		$this->load->view("vendors/edit",$this->data);
		$this->load->view("include/footer",$this->data);

			}
		}
	}

	function delete($id='')
	{
		if($_SESSION['vendor_session']==$id) redirect('vendors');
		if($id!='')
		{
			$this->vendorsmodel->delete_record($id);
			redirect('vendors/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->vendorsmodel->delete_record($val);
					}
				redirect('vendors/?del=1');
			}
			else
			{
				redirect('vendors');
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
			$this->load->model('vendorsmodel');
			$this->vendorsmodel->delete_multiple_record($id_arr);
			redirect('vendors/?multi=1');
		}
		else{
			redirect('vendors');
		}
	}
	function changestat($id=null)
	{
		if($id=='')redirect('vendors');
		if($this->input->get('status')=='')redirect('vendors');
		$this->db->query("update pms_vendors set status=".$this->input->get('status')." where vendor_id=".$id);
		redirect('vendors?status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("username",$this->input->post("username"));
		if($this->input->post("vendor_id")){$this->db->where('vendor_id !=', $this->input->post("vendor_id"));}
		$query = $this->db->get("pms_vendors");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Users username already exists");
			return false;
		}
	}
}
?>