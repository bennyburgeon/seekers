<?php 
class Admintype extends CI_controller{
	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->load->model("admintypemodel");
		$this->data['cur_page_name']=config_item('page_title').' Admin Type ';
		$this->data['current_page_head']='Types';
		$this->data['page'] = 'admin_types';
		$this->data['module_head'] = 'Manage Types';
		$this->data['module_explanation'] = 'add/edit/activate admin types from here.';

		$this->data['tasks'] ='';
		$this->data['todos'] = '';
		$this->data['messages'] = '';
		$this->data['emails'] = '';	
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
		 	 $limit=5;
		 }
		$rows='';
		$this->load->model('admintypemodel');
		
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
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->admintypemodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."admintype/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
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
		$this->data["records"] = $this->admintypemodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		
		$config['base_url'] = base_url().'branch/?';
		
		$this->load->model("admintypemodel");
		$this->data['module_action'] = 'List All Admin Types';		
	
		$this->data["page_head"]= "Manage Admin Types";
		$this->data['menu_flow_visted']=0;
		
		
		
		$this->load->view("include/header");	
		$this->load->view("admintype/list",$this->data);
		$this->load->view("include/footer");	
	}
	
	function ExportRecord()
	{
		
		$CsvData	=	array();
		$CsvData[]	=	array('Exported Result');	
		$CsvData[]	=	array();
		$DispData	=	array(
								'Sr No.',
								'Type Name',							
							);
		$CsvData[]	=	$DispData;		
		$TempInfo = $this->admintypemodel->get_list();
		if(empty($TempInfo))
		{
			$CsvData[] = array('Sorry No Admin Type Found.');
		}
		else
		{
			$sr_no = 1;
			foreach($TempInfo as $key=>$val)
			{
				$DispData  = array(
									$sr_no,
									$val['type_name'],
							);
				$CsvData[]	=	$DispData;
				$sr_no = $sr_no + 1;
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
		$data['records'] = $this->admintypemodel->get_list();
		$this->load->library('pdf');
		$this->pdf->load_view('admintype/GeneratePDF',$data);
		$this->pdf->render();
		$this->pdf->stream("GeneratePDF".date("YmdHis")."pdf");
	}


	function add()
	{ 
		$this->data["formdata"] = array(
		"type_name" => '',
		"status"=>'1'
		);
		$this->data['module_action'] = 'Add new Admin Type';	
		$this->data["page_head"]= "Add Admin Type";
		$this->load->model("admintypemodel");
		if($this->input->post("type_name"))
		{ 
			$this->form_validation->set_rules("type_name","Admin Type","required");
			$this->form_validation->set_rules('check_dups', 'Admin Type', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 
				$formdata = array(
				"type_name" => $this->input->post("type_name"),
				"status" => $this->input->post("status")
				); 
				$id = $this->admintypemodel->insert_record($formdata);
				redirect('admintype/?ins=1');
			}
		}
		
		$this->load->model("adminmodulemodel");
		$this->data["modules"] = $this->adminmodulemodel->categoryChild(0);
		$this->data['menu_flow_visted']=0;
		
		
		
		$this->load->view("include/header");	
		$this->load->view("admintype/add",$this->data);
		$this->load->view("include/footer");
	}

	function edit($id='')
	{
		$this->data['module_action'] = 'Edit Admin Type';
		$this->data["page_head"]= "Edit Admin Type";
		$this->load->model("admintypemodel");
		if(!empty($id))
		{
			$this->data["formdata"] = $this->admintypemodel->single_record($id);
			
		
		}
		
		$this->load->model("adminmodulemodel");
		$this->data["modules"] = $this->adminmodulemodel->categoryChild(0);
		$this->data['menu_flow_visted']=0;
		
		
		$this->load->view("include/header");	
		$this->load->view("admintype/edit",$this->data);
		$this->load->view("include/footer");
	}

	function update()
	{
		$this->data['module_action'] = 'Edit Admin Type';
		$this->load->model("admintypemodel");
		if($this->input->post("type_name"))
		{ 
			$this->form_validation->set_rules("type_name","Admin Type","required");
			$this->form_validation->set_rules('check_dups', 'Admin Type', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 			
				$this->admintypemodel->update_record();
				redirect('admintype/?upd=1');
			}
			else
			{
				$this->data["page_head"]= "Edit Admin Type";
				$this->data["formdata"] = array(
				"type_name" => $this->input->post("type_name"),
				"type_id" => $this->input->post("type_id"),
				"status" => $this->input->post("status"),

				);

		
		$this->load->view("include/header",$this->data);	
		$this->load->view("admintype/edit",$this->data);
		$this->load->view("include/footer",$this->data);
			}
		}
	}

	function delete($id='')
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$this->load->model("admintypemodel");
		if(!empty($id)){
			$msg =$this->admintypemodel->delete_record($id);
			redirect('admintype/?rows='.$rows.'&del='.$msg);
			exit;
		}
		elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
				{
					$msg =$this->admintypemodel->delete_record($val);
					if($msg==2) break;
				}
			redirect('admintype/?rows='.$rows.'&del='.$msg);	
		}
		else{
			redirect('admintype');
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
			$this->load->model('admintypemodel');
			$this->admintypemodel->delete_multiple_record($id_arr);
			redirect('admintype/?rows='.$rows.'&del=1');
		}
		else{
			redirect('admintype');
		}
	}

	function check_dups()
	{ 
		$this->db->where("type_name",$this->input->post("type_name"));
		if($this->input->post("type_id")!='')$this->db->where("type_id <> ",$this->input->post("type_id"));
		$query = $this->db->get("pms_admin_user_types");
		if($query->num_rows()==0) return true;
		else{
			$this->form_validation->set_message('check_dups',"Admin type already exists");
			return false;
		}
	}
	
	function manage()
	{
		$data = array('success' => false);

		$this->load->model("admintypemodel");
		
		if($this->input->post("type_name") && $this->input->post("type_id")=='')
		{ 
			$this->form_validation->set_rules("type_name","Admin Type","required");
			$this->form_validation->set_rules('check_dups', 'Admin Type', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 			
				$formdata = array(
					"type_name" => $this->input->post("type_name"),
					'ordering'  => $this->input->post("ordering")
					);
				$id = $this->admintypemodel->insert_record($formdata);		
				$data = array('success' => true,'type_id' => $id);		
			}
			else
			{
				$data = array('success' => 'dups');
			}
		}elseif($this->input->post("type_name") && $this->input->post("type_id")!='')
		{ 
			$this->form_validation->set_rules("type_name","Admin Type","required");
			$this->form_validation->set_rules('check_dups', 'Admin Type', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{ 			
				$this->admintypemodel->update_record();	
				$data = array('success' => true,'type_id' => $this->input->post("type_id"));		
			}
			else
			{
				$data = array('success' => 'dups');
			}
		}

		echo json_encode($data);
	}

	function deletetype()
	{
		$this->load->model("admintypemodel");
		$id=$this->input->post('type_id');
		if($id!=''){
			$msg =$this->admintypemodel->delete_record($this->input->post('type_id'));
			$data = array('success' => 'true');	
		}
		else{
			$data = array('success' => 'false');
		}
		echo json_encode($data);
	}
}
?>