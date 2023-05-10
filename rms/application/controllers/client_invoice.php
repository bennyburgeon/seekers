<?php 
class Client_invoice extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');


	}
	
	
	function index()
	{
		
		$this->load->library('pagination');
		$company_id='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=25;
		}
		$rows='';
		$this->load->model('client_invoice_model');
		$this->load->model('company_placement_model');
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
		
		if(isset($_GET['company_id']))
		{
			if($_GET['company_id']!='')
			$company_id= $_GET['company_id'];
		}
		if($this->input->post('company_id')!='')
		{

			$company_id	=	$this->input->post('company_id');
		}
		
		$this->data['total_rows']= $this->client_invoice_model->record_count($company_id);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."index.php/client_invoice/?sort_by=$sort_by&company_id=$company_id$query_str";
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
		
		$this->data["records"] = $this->client_invoice_model->get_list($start,$limit,$company_id,$sort_by);
		$this->data['company_list'] =$this->company_placement_model->get_all_company();
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["company_id"]=$company_id;


		$this->data['page_head'] = 'Client Invoice list';
		$this->load->view('include/header');
		$this->load->view('invoice/client_invoice_list',$this->data);				
		$this->load->view('include/footer');

		
	}	
	
}

