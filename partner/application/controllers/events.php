<?php
class Events extends CI_controller
 {
	function __construct()
	{
		parent::__construct();
	   if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Event ';
		$this->data['current_page_head']='Event';
		$this->data['page'] = 'Event';
		$this->data['module_head'] = 'Manage Event';
		$this->data['module_explanation'] = 'add/edit/activate records from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['obj_contact_names'] = '';	
		$this->load->model('eventsmodel');
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
		 
	    $this->data['module_action'] = 'List All Event';
		$this->data["page_head"]= "Manage Event";
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		 $this->load->library('pagination');
		 $searchterm='';
		 $start=0;
		 $limit=25;
		 $rows='';
		 		
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
		
		$this->data['total_rows']= $this->eventsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."events/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->eventsmodel->admin_list($start,$limit,$searchterm,$sort_by);
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Event';
		$this->load->view("include/header",$this->data);
		$this->load->view("events/list",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				"event_title"      => "",
				"description"      => "",
				"contact_email"    => "",
				"event_venue"      => "",
				"from_date"        => "",
				"to_date"          => "",
				"organized_by"     => "",
				"start_time"       => "",
				"end_time"         => "",
				);
		$this->data['page_head'] = 'Add Event';

		if($this->input->post("event_title"))
		{ 
			$this->form_validation->set_rules("event_title","Event Name","required");
			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->eventsmodel->insert_record();
				redirect('events/?ins=1');
			}
			$this->data["formdata"] = array(
				"event_title"      => $this->input->post("event_title"),
				"description"      => $this->input->post("description"),
				"contact_email"    => $this->input->post("contact_email"),
				"event_venue"      => $this->input->post("event_venue"),
				"from_date"        => $this->input->post("from_date"),
				"to_date"          => $this->input->post("to_date"),
				"organized_by"     => $this->input->post("organized_by"),
				"start_time"       => $this->input->post("start_time"),
				"end_time"         => $this->input->post("end_time"),
				);
		}
		
		
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("events/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Event';
		if(!empty($id))
		{
			$this->data["formdata"] = $this->eventsmodel->single_admin($id);
		}
	
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("events/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Event';
		$this->data['module_action'] = 'Update Event';
		if($this->input->post("event_title"))
		{ 
			$this->form_validation->set_rules("event_title","Event Name","required");

			if ($this->form_validation->run() == TRUE)
			{ 
				$this->eventsmodel->update_record();
				redirect('events/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
					"event_title"      => $this->input->post("event_title"),
					"description"      => $this->input->post("description"),
					"contact_email"    => $this->input->post("contact_email"),
					"event_venue"      => $this->input->post("event_venue"),
					"from_date"        => $this->input->post("from_date"),
					"to_date"          => $this->input->post("to_date"),
					"organized_by"     => $this->input->post("organized_by"),
					"start_time"       => $this->input->post("start_time"),
					"end_time"         => $this->input->post("end_time"),
					);	

				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->load->view("include/header",$this->data);
				$this->load->view("events/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		if($id!='')
		{
			$this->eventsmodel->delete_record($id);
			redirect('events/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->eventsmodel->delete_record($val);
					}
				redirect('events/?del=1');
			}
			else
			{
				redirect('events');
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
			$this->load->model('eventsmodel');
			$this->eventsmodel->delete_multiple_record($id_arr);
			redirect('events/?multi=1');
		}
		else{
			redirect('events');
		}
	}
	
	function changestat($id=null)
	{
		if($id=='')redirect('events');
		if($this->input->get('list_status')=='')redirect('events');
		$this->db->query("update pms_events set list_status=".$this->input->get('list_status')." where event_id=".$id);
		redirect('events?list_status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("event_title",$this->input->post("event_title"));
		if($this->input->post("event_id")){$this->db->where('event_id !=', $this->input->post("event_id"));}
		$query = $this->db->get("pms_events");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Event title already exists");
			return false;
		}
	}
}
?>