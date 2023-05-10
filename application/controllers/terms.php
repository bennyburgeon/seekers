<?php class Terms extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('homepagemodel');
	}

	function index()
	{
		$this->data["left_search_form"]='';
		$this->data["current_controller"]=$this->router->class;
		$this->data['page_title']   = $this->config->item('company_name');
		$this->data['og_site_name']    = $this->config->item('company_name');
		$this->data['og_title']    = $this->config->item('company_name');
		$this->data['og_description']  = $this->config->item('company_name');
		$this->data['og_image']        = $this->config->item('website').'/assets/img/logo.png';
		$this->data['og_url']          = $this->config->item('website');
		$this->data['service_type']='';
		
		$this->data['industry_menu']=$this->homepagemodel->get_industry_menu();
		$this->data['home_summary']=$this->homepagemodel->get_home_summary();

		

		$this->load->view('homepage-include/header', $this->data);

		$this->load->view('terms/terms',  $this->data);	

		$this->load->view('homepage-include/footer',  $this->data);		

	}
	
}

