<?php
class Mock_tests extends CI_controller
 {
	function __construct()
	{
		parent::__construct();
	   if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Mock Tests ';
		$this->data['current_page_head']='Mock Tests';
		$this->data['page'] = 'Mock Tests';
		$this->data['module_head'] = 'Manage Mock Tests';
		$this->data['module_explanation'] = 'add/edit/activate usres from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['obj_contact_names'] = '';	
		$this->load->model('mock_testsmodel');
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
	    $this->data['module_action'] = 'List All Mock Tests';
		$this->data["page_head"]= "Manage Mock Tests";
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
		
		$this->data['total_rows']= $this->mock_testsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."mock_tests/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->mock_testsmodel->walkin_list($start,$limit,$searchterm,$sort_by);
		//print_r($this->data["records"]);
		//exit();
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Mock Tests';
		$this->load->view("include/header",$this->data);
		$this->load->view("mock_tests/list",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				"walkin_title"                => "",
				"interview_type_id"           => "",
				"contact_name"                => "",
				"contact_email"               => "",
				"contact_phone"               => "",
				"job_id"                      => "",
				"duration"                    => "",
				"venue"                       => "",
				"interview_date_from"         => "",
				"interview_time_from"         => "",
				"interview_date_to"           => "",
				"interview_time_to"           => "",
				"office_latitude"             => "",
				"office_longitude"            => "",
				"int_status_id"               =>"1",
				"materials"                   => "",
				"report_time"                 => "",
				"event_type"                 => "5",
				);
				
				$this->data["interview_type_list"] = array(
				"1"                => "Telephonic",				
				"2"                => "HR",
				"3"                => "Face to Face",
				"4"                => "Technical",
				);
				
				$this->data["time_array"] =$this->get_time_array();
				
				
		$this->data['page_head'] = 'Add Mock Tests';

		if($this->input->post("walkin_title"))
		{ 
			$this->form_validation->set_rules("walkin_title","Mock Tests Title","required");
			//$this->form_validation->set_rules("event_type","Event Type","required");
			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->mock_testsmodel->insert_record();
				redirect('mock_tests/?ins=1');
			}
			$this->data["formdata"] = array(
				"walkin_title"                => $this->input->post("walkin_title"),
				"contact_name"                => $this->input->post("contact_name"),
				"contact_email"               => $this->input->post("contact_email"),
				"contact_phone"               => $this->input->post("contact_phone"),
				"job_id"                      => $this->input->post("job_id"),
				"duration"                    => $this->input->post("duration"),
				"venue"                       => $this->input->post("venue"),
				"interview_date_from"         => $this->input->post("interview_date_from"),
				"interview_time_from"         => $this->input->post("interview_time_from"),
				"interview_date_to"           => $this->input->post("interview_date_to"),
				"interview_time_to"           => $this->input->post("interview_time_to"),
				"office_latitude"             => $this->input->post("office_latitude"),
				"office_longitude"            => $this->input->post("office_longitude"),
				"int_status_id"               => "1",
				"materials"                   => $this->input->post("materials"),
				"report_time"                 => $this->input->post("report_time"),
				"event_type"                 => $this->input->post("event_type"),
				"interview_type_id"          => $this->input->post("interview_type_id"),
				"user_id"                    => $_SESSION['vendor_session']
				);
		}
		
		$this->data["job_list"] = $this->mock_testsmodel->get_job_list();
		
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("mock_tests/add",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Mock Tests';
		if(!empty($id))
		{
			$this->data["formdata"] = $this->mock_testsmodel->single_admin($id);
		}
		$this->data["interview_type_list"] = array(
				"1"                => "Telephonic",				
				"2"               => "HR",
				"3"               => "Face to Face",
				"4"                => "Technical",
				);
		$this->data["time_array"] =$this->get_time_array();
		$this->data["job_list"] = $this->mock_testsmodel->get_job_list();
		
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("mock_tests/edit",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Mock Tests';
		$this->data['module_action'] = 'Update Mock Tests';
		$this->data["interview_type_list"] = array(
				"1"                => "Telephonic",				
				"2"               => "HR",
				"3"               => "Face to Face",
				"4"                => "Technical",
				);
				
		$this->data["time_array"] =$this->get_time_array();
		if($this->input->post("walkin_title"))
		{ 
			$this->form_validation->set_rules("walkin_title","Mock Tests Title","required");
			//$this->form_validation->set_rules("event_type","Event Type","required");
		
			if ($this->form_validation->run() == TRUE)
			{ 
				$this->mock_testsmodel->update_record();
				redirect('mock_tests/?upd=1');
			}
			else
			{
			$this->data["formdata"] = array(
				"walkin_title"                => $this->input->post("walkin_title"),
				"contact_name"                => $this->input->post("contact_name"),
				"contact_email"               => $this->input->post("contact_email"),
				"contact_phone"               => $this->input->post("contact_phone"),
				"job_id"                      => $this->input->post("job_id"),
				"duration"                    => $this->input->post("duration"),
				"venue"                       => $this->input->post("venue"),
				"interview_date_from"         => $this->input->post("interview_date_from"),
				"interview_time_from"         => $this->input->post("interview_time_from"),
				"interview_date_to"           => $this->input->post("interview_date_to"),
				"interview_time_to"           => $this->input->post("interview_time_to"),
				"office_latitude"             => $this->input->post("office_latitude"),
				"office_longitude"            => $this->input->post("office_longitude"),
				"int_status_id"               => "1",
				"materials"                   => $this->input->post("materials"),
				"report_time"                 => $this->input->post("report_time"),
				"event_type"                 => $this->input->post("event_type"),
				"interview_type_id"                 => $this->input->post("interview_type_id"),
				"user_id"                    => $_SESSION['vendor_session']
				);

				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->load->view("include/header",$this->data);
				$this->load->view("mock_tests/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		if($id!='')
		{
			$this->mock_testsmodel->delete_record($id);
			redirect('mock_tests/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->mock_testsmodel->delete_record($val);
					}
				redirect('mock_tests/?del=1');
			}
			else
			{
				redirect('mock_tests');
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
			$this->load->model('mock_testsmodel');
			$this->mock_testsmodel->delete_multiple_record($id_arr);
			redirect('mock_tests/?multi=1');
		}
		else{
			redirect('mock_tests');
		}
	}
	
	function changestat($id=null)
	{
		if($id=='')redirect('mock_tests');
		if($this->input->get('int_status')=='')redirect('mock_tests');
		$this->db->query("update pms_walkins set int_status=".$this->input->get('int_status')." where interview_id=".$id);
		redirect('walkins?int_status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("walkin_title",$this->input->post("walkin_title"));
		if($this->input->post("interview_id")){$this->db->where('interview_id !=', $this->input->post("interview_id"));}
		$query = $this->db->get("pms_walkins");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Mock Tests title already exists");
			return false;
		}
	}
	
	function get_time_array()
	{ 
		$time_array=array();
		$time_array = array(
				"7:00 AM"        => "7:00 AM",
				"7:30 AM"        => "7:30 AM",
				"8:00 AM"        => "8:00 AM",
				"8:30 AM"        => "8:30 AM",
				"9:00 AM"        => "9:00 AM",
				"9:30 AM"        => "9:30 AM",
				"10:00 AM"       => "10:00 AM",
				"10:30 AM"       => "10:30 AM" ,
				"11:00 AM"       => "11:00 AM",	
				"11:30 AM"       => "11:30 AM",	
				"12:00 Noon"     => "12:00 Noon",				
				"12:30 PM"       => "12:30 PM",
				"01:00 PM"       => "01:00 PM",
				"01:30 PM"       => "01:30 PM",
				"02:00 PM"       => "02:00 PM",
				"02:30 PM"       => "02:30 PM",
				"03:00 PM"       => "03:00 PM",
				"03:30 PM"       => "03:30 PM",
				"04:30 PM"       => "04:00 PM",
				"04:30 PM"       => "04:30 PM",
				"05:30 PM"       => "05:00 PM",
				"05:30 PM"       => "05:30 PM",
				"06:30 PM"       => "06:00 PM",
				"06:30 PM"       => "06:30 PM",
				"07:00 PM"       => "07:00 PM",
				);
		return $time_array;	
	}
}
?>