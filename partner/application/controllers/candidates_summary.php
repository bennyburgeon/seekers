<?php 
class Candidates_summary extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		//$_SESSION['vendor_session']=1;
		$this->load->model('statemodel');
		$this->load->model('countrymodel');
		$this->load->model('citymodel');
		$this->load->model('candidates_summarymodel');
		$this->data['cur_page']=$this->router->class;
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

	

	function index()

	{	

		$this->load->library('pagination');

		$reg_status='';

		$start=0;

		//$limit=50;

		if($this->input->get('limit')!=''){

			$limit= $this->input->get('limit');

		 }

		 else{

		 	 $limit=50;

		 }

		$rows='';

		

		$rows='';

		$search_name='';

		

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

		

		if($this->input->post("rows")!='')

		{

			$rows=$this->input->post("rows");

		}

		

		if($this->input->get('search_name'))

		{

			$search_name=$this->input->get('search_name');

		}



		if($this->input->post('search_name'))

		{

			$search_name=$this->input->post('search_name');

		}

		

		

		

		$this->data['total_rows']= $this->candidates_summarymodel->record_count($search_name);

		

		$get = $this->input->get ( NULL, TRUE );

		$page = (int) $this->input->get ( 'rows', TRUE );

		$query_str ='';

		

		if($query_str=='')$query_str;

		

		$this->data['cur_page']=$this->router->class;

		

		$config['base_url'] = $this->config->item('base_url')."candidates_summary/?sort_by=$sort_by&search_name=$search_name";

		

		$config['page_query_string'] = TRUE;

		$config['total_rows'] = $this->data['total_rows'];

		$config['query_string_segment'] = 'rows';

		$config['per_page'] =$limit;

		//$config['num_links'] = 10;

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

		$this->data["records"] = $this->candidates_summarymodel->get_list($start,$limit,$search_name,$sort_by);

		

		

		$this->data["sort_by"] = $sort_by;

		$this->data["rows"] = $rows;

		

		$this->data["search_name"] = $search_name;

		

		$this->data['page_head'] = 'Candidates Summary';				



		

		$this->load->view('include/header',$this->data);

		$this->load->view('candidates_summary/candidatessummarylist',$this->data);

		$this->load->view('include/footer',$this->data);

	}	

	



}

?>