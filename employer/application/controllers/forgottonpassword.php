<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgottonpassword extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		 $this->data['page_name']= '';
		 $this->data['page_title']= $this->config->item('website');
		 $this->data['page_content']= '';
		 $this->data['page_short_content']= '';
		 $this->data['seo_title']= $this->config->item('website');
		 $this->data['seo_keyword']= $this->config->item('website');
		 $this->data['seo_meta_desc']= $this->config->item('website');
		 $this->data['page_banner']= $this->config->item('website');
	}


	public function index()
	{
		$data  = array(
			'script_name'	=> "scripts/home_script",
			'title'			=>	"Forogotton Password | ".$this->config->item('website'),
			'active'		=> "forget_password"
		);


		$this->include_header($data);
		$this->load->view('forgottonpassword/forgotton_password');
		$this->include_footer($data);
	}
	
	public function include_header($data = array())
	{
		//$this->load->view('include/header',$data);
		//$this->load->view('public/pre-header',$data);
	}

	public function include_footer($data = array() )
	{
		//$this->load->view('public/footer',$data);
	}


}