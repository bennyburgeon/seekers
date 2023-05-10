<?php 
class Reports_followup extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');


	}
	
	
	function index(){
		
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
		$this->load->model('reports_followupmodel');
		
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
		$this->data['total_rows']= $this->reports_followupmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."reports_followup/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm&limit=$limit$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['num_links'] = 5;
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
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
		$this->data["records"] = $this->reports_followupmodel->get_list($start,$limit,$searchterm,$sort_by);


		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data["limit"]=$limit;


		$this->data['page_head'] = 'Followup list';
		$this->load->view('include/header');
		$this->load->view('reports_followup/list',$this->data);				
		$this->load->view('include/footer');

		
	}	
	
}
?>
