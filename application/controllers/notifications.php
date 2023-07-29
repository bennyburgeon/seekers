<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notifications extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['candidate_session']) || $_SESSION['candidate_session']=='')redirect('logout');
		$this->load->model("notificationsmodel");
		$this->data['cur_page_name']=config_item('page_title').' Messages ';
		$this->data['current_page_head']='Messages';
		$this->data['page'] = 'notification';
		$this->data['module_head'] = 'Messages';
		$this->data['module_explanation'] = 'add/edit/activate Messages from here.';
		$this->load->model("generalmodel");
	}
	
	function editor($path,$width) 
	{
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
   function index($offset = 0)
	{
		$this->load->model('candidateallmodel');
		$this->load->model('notificationsmodel');
		$candidate_id=$_SESSION['candidate_session'];
		$this->data['detail_list'] = $this->candidateallmodel->detail_list($candidate_id);
		$this->data["formdata"]  = $this->candidateallmodel->get_single_record($candidate_id);
		$searchterm='';
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=50;
		 }
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
		$this->data["records"] = $this->notificationsmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->load->view("candidate-profile/header",$this->data);
		$this->load->view("candidate-profile/include/sidebar",$this->data);
		$this->load->view("candidate-profile/include/head",$this->data);
		$this->load->view("candidate-profile/notification",$this->data);
		$this->load->view("candidate-profile/footer",$this->data);
		
	}
	function index1($offset = 0)
	{
		$this->load->library('pagination');
		$searchterm='';
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=50;
		 }
		$rows='';
		$this->load->model('notificationsmodel');
		
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
		
		$this->data['total_rows']= $this->notificationsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/notifications/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		$this->data["records"] = $this->notificationsmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
			
		$this->data['module_action'] = 'Messages';
		$this->data["page_head"]= "Messages";
		$this->load->model('notificationsmodel');
		$this->data['page_head']= 'Manage Messages';
		$limit=20;	
		$config['base_url'] = base_url().'index.php/notifications/?';
	
		$cnt	=	ceil($this->data['total_rows']/$limit);	
		$this->data['pages']=$cnt;
		$this->data['limit']=$limit;
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header',$this->data);
		$this->load->view('notifications/list',$this->data);				
		$this->load->view('include/footer',$this->data);
		
	}
	
	function manage_message()
	{
			$data=array(
			'message_date'      => date('Y-m-d'),
			'message_time'      => time(),
			'message_title'     => '',
			'message_text'      => $this->input->post('message_text'),			
			'message_status'    => 0,	
			'candidate_id'          => $_SESSION['candidate_session'],		
			);
			$this->db->insert('pms_candidate_messages',$data);
			redirect('notifications');
	}		
}
?>
