<?php
class Freelance extends CI_controller
 {
	function __construct()
	{
		parent::__construct();
	   if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Freelance ';
		$this->data['current_page_head']='Freelance';
		$this->data['page'] = 'Freelance';
		$this->data['module_head'] = 'Manage Freelance';
		$this->data['module_explanation'] = 'add/edit/activate records from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['obj_contact_names'] = '';	
		$this->load->model('freelancemodel');
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
		 
	    $this->data['module_action'] = 'List All Freelance';
		$this->data["page_head"]= "Manage Freelance";
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
		
		$this->data['total_rows']= $this->freelancemodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."freelance/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->freelancemodel->admin_list($start,$limit,$searchterm,$sort_by);
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Freelance';
		$this->load->view("include/header",$this->data);
		$this->load->view("freelance/list",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				"part_title"                => "",
				"contact_details"              => "",
				"duration"         => "",
				"meeting_venue"        => "",
				"start_date"           => "",
				"time_allowed"          => "",
				"office_latitude"             => "",
				"office_longitude"            => "",
				"part_status"               =>"1"
				);
		$this->data['page_head'] = 'Add Freelance';

		if($this->input->post("part_title"))
		{ 
			$this->form_validation->set_rules("contact_details","Freelance Name","required");
			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->freelancemodel->insert_record();
				redirect('freelance/?ins=1');
			}
			$this->data["formdata"] = array(
				"part_title"                => $this->input->post("part_title"),
				"contact_details"              => $this->input->post("contact_details"),
				"duration"         => $this->input->post("duration"),
				"meeting_venue"        => $this->input->post("meeting_venue"),
				"start_date"           => $this->input->post("start_date"),
				"time_allowed"          => $this->input->post("time_allowed"),
				"office_latitude"             => $this->input->post("office_latitude"),
				"office_longitude"            => $this->input->post("office_longitude"),
				"part_status"               => "1"
				);
		}
		
		
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("freelance/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Freelance';
		if(!empty($id))
		{
			$this->data["formdata"] = $this->freelancemodel->single_admin($id);
		}
	
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("freelance/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Freelance';
		$this->data['module_action'] = 'Update Freelance';
		if($this->input->post("part_title"))
		{ 
			$this->form_validation->set_rules("contact_details","Freelance Name","required");

			if ($this->form_validation->run() == TRUE)
			{ 
				$this->freelancemodel->update_record();
				redirect('freelance/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
					"part_title"                => $this->input->post("part_title"),
					"contact_details"              => $this->input->post("contact_details"),
					"duration"         => $this->input->post("duration"),
					"meeting_venue"        => $this->input->post("meeting_venue"),
					"start_date"           => $this->input->post("start_date"),
					"time_allowed"          => $this->input->post("time_allowed"),
					"office_latitude"             => $this->input->post("office_latitude"),
					"office_longitude"            => $this->input->post("office_longitude"),
					"part_status"               => "1"
					);	

				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->load->view("include/header",$this->data);
				$this->load->view("freelance/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		if($id!='')
		{
			$this->freelancemodel->delete_record($id);
			redirect('freelance/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->freelancemodel->delete_record($val);
					}
				redirect('freelance/?del=1');
			}
			else
			{
				redirect('freelance');
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
			$this->load->model('freelancemodel');
			$this->freelancemodel->delete_multiple_record($id_arr);
			redirect('freelance/?multi=1');
		}
		else{
			redirect('freelance');
		}
	}
	
	function changestat($id=null)
	{
		if($id=='')redirect('freelance');
		if($this->input->get('part_status')=='')redirect('freelance');
		$this->db->query("update pms_part_time set part_status=".$this->input->get('part_status')." where part_id=".$id);
		redirect('freelance?part_status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("part_title",$this->input->post("part_title"));
		if($this->input->post("part_id")){$this->db->where('part_id !=', $this->input->post("part_id"));}
		$query = $this->db->get("pms_part_time");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Freelance title already exists");
			return false;
		}
	}
}
?>