<?php
class Internship extends CI_controller
 {
	function __construct()
	{
		parent::__construct();
	   if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		
		$this->data['cur_page_name']=config_item('page_title').' Internship ';
		$this->data['current_page_head']='Internship';
		$this->data['page'] = 'Internship';
		$this->data['module_head'] = 'Manage Internship';
		$this->data['module_explanation'] = 'add/edit/activate records from here.';
		
		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['obj_contact_names'] = '';	
		$this->load->model('internshipmodel');
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
		 
	    $this->data['module_action'] = 'List All Internship';
		$this->data["page_head"]= "Manage Internship";
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
		
		$this->data['total_rows']= $this->internshipmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;
		
		$this->load->library('pagination');

		$config['base_url'] = $this->config->item('base_url')."internship/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->internshipmodel->get_list($start,$limit,$searchterm,$sort_by);
		$this->data["company_list"] = $this->internshipmodel->company_list();
		$this->data["rows"]=$start;
		$this->data["sort_by"]=$sort_by;
		$this->data["searchterm"]=$searchterm;
		$this->data['pahe_head'] = 'Manage Internship';
		$this->load->view("include/header",$this->data);
		$this->load->view("internship/listinternships",$this->data);
		$this->load->view("include/footer",$this->data);
     }
	 
	function add()
	{
		$this->data["formdata"] = array(
				'company_id'=> '',
				'duration'  => '',
				'free_paid'  => '',
				'start_date'  => '',
				'end_date'  => '',
				'internship_name'  => '',
				'description'  => '',
				);
		$this->data['page_head'] = 'Add Internship';
		$this->data["company_list"] = $this->internshipmodel->company_list();

		if($this->input->post("internship_name"))
		{ 
			$this->form_validation->set_rules("internship_name","Internship Name","required");
			if ($this->form_validation->run() == TRUE)
			{ 
				$id = $this->internshipmodel->insert_record();
				redirect('internship/?ins=1');
			}
			$this->data["formdata"] = array(
				'duration'=>$this->input->post('duration'),
				'company_id'=>$this->input->post('company_id'),
				'free_paid'=>$this->input->post('free_paid'),
				'start_date'=>$this->input->post('start_date'),
				'end_date'=>$this->input->post('end_date'),
				'internship_name'=>$this->input->post('internship_name'),
				'description'=>$this->input->post('description'),
				);
		}
		
		
			 $path = '../js/ckfinder';
		    $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header");
		$this->load->view("internship/addinternships",$this->data);
		$this->load->view("include/footer");
	}
	
	function edit($id='')
	{
		$this->data['page_head'] = 'Edit Internship';
		
		$this->data["company_list"] = $this->internshipmodel->company_list();
		if(!empty($id))
		{
			$this->data["formdata"] = $this->internshipmodel->single_admin($id);
		}
	
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);		
		
		$this->load->view("include/header",$this->data);
		$this->load->view("internship/editinternships",$this->data);
		$this->load->view("include/footer",$this->data);
	}

	function update()
	{
		$this->data['page_head'] = 'Edit Internship';
		$this->data['module_action'] = 'Update Internship';
		
		$this->data["company_list"] = $this->internshipmodel->company_list();
		if($this->input->post("internship_name"))
		{ 
			$this->form_validation->set_rules("internship_name","Internship Name","required");

			if ($this->form_validation->run() == TRUE)
			{ 
				$this->internshipmodel->update_record();
				redirect('internship/?upd=1');
			}
			else
			{
				$this->data["formdata"] = array(
					'duration'=>$this->input->post('duration'),
					'company_id'=>$this->input->post('company_id'),
					'free_paid'=>$this->input->post('free_paid'),
					'start_date'=>$this->input->post('start_date'),
					'end_date'=>$this->input->post('end_date'),
					'internship_name'=>$this->input->post('internship_name'),
					'description'=>$this->input->post('description'),
					);	

				$path = '../js/ckfinder';
				$width = '700px';
				$this->editor($path, $width);
				$this->load->view("include/header",$this->data);
				$this->load->view("internship/edit",$this->data);
				$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		if($id!='')
		{
			$this->internshipmodel->delete_record($id);
			redirect('internship/?del=1');
		}
			if($this->input->post("delete_rec"))
			{
				 foreach ($this->input->post("delete_rec") as $key => $val)
					{
						$this->internshipmodel->delete_record($val);
					}
				redirect('internship/?del=1');
			}
			else
			{
				redirect('internship');
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
			$this->load->model('internshipmodel');
			$this->internshipmodel->delete_multiple_record($id_arr);
			redirect('internship/?multi=1');
		}
		else{
			redirect('internship');
		}
	}
	
	function changestat($id=null)
	{
		if($id=='')redirect('internship');
		if($this->input->get('list_status')=='')redirect('internship');
		$this->db->query("update pms_internships set list_status=".$this->input->get('list_status')." where internship_id=".$id);
		redirect('internship?list_status=1');
	}
	
	function check_dups()
	{ 
		$this->db->where("internship_name",$this->input->post("internship_name"));
		if($this->input->post("internship_id")){$this->db->where('internship_id !=', $this->input->post("internship_id"));}
		$query = $this->db->get("pms_internships");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Internship title already exists");
			return false;
		}
	}
}
?>