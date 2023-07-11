<?php class Aboutus extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('aboutusmodel');
		$this->load->library('pagination');
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

		$this->load->view('home-include/header', $this->data);

		$this->load->view('aboutus/aboutus',  $this->data);	

		$this->load->view('home-include/footer',  $this->data);		

	}



	function confirm()

	{

		$this->data['status']=$this->input->get('ins');

		$this->data['marquee']=$this->load->view('home-include/header',$this->data,true);

		$this->load->view('home-include/header',$this->data);

		$this->load->view('home/aboutus',$this->data);

		$this->load->view('home-include/footer',$this->data);

	}

}

