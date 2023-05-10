<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forgottonpassword extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		 $this->data['page_name']= '';
		 $this->data['page_title']= 'seekersgulf.com';
		 $this->data['page_content']= '';
		 $this->data['page_short_content']= '';
		 $this->data['seo_title']= 'seekersgulf.com';
		 $this->data['seo_keyword']= 'seekersgulf.com';
		 $this->data['seo_meta_desc']= 'seekersgulf.com';
		 $this->data['page_banner']= 'seekersgulf.com';
	}

	public function index()
	{
		$data  = array(
			'script_name'	=> "scripts/home_script",
			'title'			=>	"Forogotton Password | seekersgulf.com",
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