<?php 
class Admingroup extends CI_controller{
	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->load->model("admingroupmodel");
		$this->data['cur_page_name']=config_item('page_title').' Groups ';
		$this->data['current_page_head']='Groups';
		$this->data['page'] = 'admin_groups';
		$this->data['module_head'] = 'Manage Groups';
		$this->data['module_explanation'] = 'add/edit/activate user groups from here.';

		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['emails'] = '';	
		
		$this->data['cur_page']=$this->router->class;
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

		$this->load->library('pagination');
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=15;
		}
		$rows='';
		$this->load->model('admingroupmodel');
		
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
		$sort_by=$this->input->get("sort_by");
		}
		else
		{
		$sort_by = 'asc';
		}
		if($this->input->get("rows")!='')
		{
		$start=$this->input->get("rows");
		}
		if($this->input->get("rows")!='')
		{
		$rows=$this->input->get("rows");
		}
		
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->admingroupmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = $get;
		$query_str ='';
		if($query_str=='')$query_str;
		
		
		$config['base_url'] = $this->config->item('base_url')."admingroup/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] = $limit;
		$config['num_links'] = $this->data['total_rows'];
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
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
		$this->data["records"] = $this->admingroupmodel->get_list($start,$limit,$sort_by,$searchterm);
		$this->data["sort_by"]=$sort_by;
		$this->data["rows"]=$start;
		$this->data["searchterm"]=$searchterm;
		
		$this->load->view("include/header",$this->data);
		$this->load->view("admingroup/list",$this->data);		
		$this->load->view("include/footer",$this->data);

	}
	function ExportRecord()
	{
		$CsvData	=	array();
		$CsvData[]	=	array('Exported Result');	
		$CsvData[]	=	array();
		$DispData	=	array(
								'Group ID',
								'Group Name',							
							);
		$CsvData[]	=	$DispData;		
		$TempInfo = $this->admingroupmodel->get_list();	
		if(empty($TempInfo))
		{
			$CsvData[] = array('Sorry No Admin Group Found.');
		}
		else
		{
			foreach($TempInfo as $key=>$val)
			{
				$DispData  = array(
									$val['user_grp_id'],
									$val['user_grp_name'],
							);
				$CsvData[]	=	$DispData;
			}
		}
		$file_name	=	"GreenOak_Property".date("YmdHis").".csv";
		error_reporting(0);
		header( 'Content-Type: text/csv' );
		header( 'Content-Disposition: attachment;filename='.$file_name);
		$fp = fopen('php://output', 'w');		
		foreach ($CsvData as $key=>$val) {
			fputcsv($fp, $val);
		}
		fclose($fp);
		$contLength = ob_get_length();
		header( 'Content-Length: '.$contLength);	
	}
	
	function GeneratePDF()
	{
		$data['records'] = $this->admingroupmodel->get_list();
		$this->load->library('pdf');
		$this->pdf->load_view('admingroup/GeneratePDF',$data);
		$this->pdf->render();
		$this->pdf->stream("GeneratePDF".date("YmdHis")."pdf");
	}

	function add()
	{
		$this->data["formdata"] = array(
		"user_grp_name" => ''
		);
		$this->data['module_action'] = 'Add Group';
		$this->data["page_head"]= "Add Admin Group";
		$this->form_validation->set_rules("user_grp_name","Admin Group","required");
		if($this->input->post("user_grp_name"))
		{ 
			
			$this->form_validation->set_rules('check_dups', 'Admin Group', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 
				$data = array(
				"user_grp_name" => $this->input->post("user_grp_name"),
				"status" => $this->input->post("status")
				);
				$id = $this->admingroupmodel->insert_record($data);
				redirect('admingroup/?ins=1');
			}
		}

		$this->load->model("adminmodulemodel");
		$this->data["modules"] = $this->adminmodulemodel->categoryChild(0);
		$this->data['menu_flow_visted']=0;
		$path = '../js/ckfinder';
		$width = '700px';
		$this->editor($path, $width);
		$this->load->view("include/header",$this->data);	
		$this->load->view("admingroup/add",$this->data);	
		$this->load->view("include/footer",$this->data);
		
	}

	function edit($id='')
	{
		$this->data["page_head"]= "Edit Admin Group";
		$this->data['module_action'] = 'Edit Group';
		if(!empty($id))
		{
			$this->load->model("adminmodulemodel");
			$this->data["modules"] = $this->adminmodulemodel->categoryChild(0);
			$this->data["formdata"] = $this->admingroupmodel->single_record($id);
			$this->data["admin_modules"] = $this->admingroupmodel->get_group_permission($id);
		}
				     $path = '../js/ckfinder';
		     $width = '700px';
		    $this->editor($path, $width);
		$this->load->view("include/header",$this->data);	
		$this->load->view("admingroup/edit",$this->data);	
		$this->load->view("include/footer",$this->data);		
		
	}

	function update()
	{
		$this->data["page_head"]= "Edit Admin Group";
		if($this->input->post("user_grp_name"))
		{ 
			$this->form_validation->set_rules("user_grp_name","Admin Group","required");
			$this->form_validation->set_rules('check_dups', 'Admin Group', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 		
				$this->admingroupmodel->update_record();
				redirect('admingroup/?upd=1');
			}
			else
			{
				$this->data["page_head"]= "Edit Admin Group";
				$this->data['module_action'] = 'Edit Group';

				$this->data["formdata"] = array(
				"user_grp_name" => $this->input->post("user_grp_name"),
				"user_grp_id" => $this->input->post("user_grp_id"),
				"status" => $this->input->post("status")
				);
								     $path = '../js/ckfinder';
		     $width = '700px';
		    $this->editor($path, $width);
		$this->load->model("adminmodulemodel");
		$this->data["admin_modules"] = $this->admingroupmodel->get_group_permission($this->input->post("user_grp_id"));
		$this->data["modules"] = $this->adminmodulemodel->categoryChild(0);
		$this->load->view("include/header",$this->data);	
		$this->load->view("admingroup/edit",$this->data);	
		$this->load->view("include/footer",$this->data);	
			}
		}
	}

	function delete($id='')
	{
		//redirect('admingroup/?upd=1');
		if(!empty($id)){
			$msg =$this->admingroupmodel->delete_record($id);
			redirect('admingroup/?del='.$msg);
			exit;
		}
		elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('delete_rec') as $key => $val)
				{
					$msg =$this->admingroupmodel->delete_record($val);
					if($msg==2) break;
				}
			redirect('admingroup/?del='.$msg);	
		}
		else{
			redirect('admingroup');
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
			$this->load->model('admingroupmodel');
			$this->admingroupmodel->delete_multiple_record($id_arr);
			redirect('admingroup/?multi=1');
		}
		else{
			redirect('admingroup');
		}
	}

	function check_dups()
	{ 
		$this->db->where("user_grp_name",$this->input->post("user_grp_name"));
		if($this->input->post("user_grp_id"))
		
		{
			$this->db->where('user_grp_id !=', $this->input->post("user_grp_id"));
		}
		$query = $this->db->get("pms_admin_user_groups");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Admin group already exists");
			return false;
		}
	}
	
	function changestat($id=null)
	{
		if($id=='')redirect('admingroup');
		if($this->input->get('stat')=='')redirect('admingroup');
		$this->db->query("update pms_admin_user_groups set status=".$this->input->get('stat')." where user_grp_id=".$id);
		redirect('admingroup?stat=1');
	}
}

?>