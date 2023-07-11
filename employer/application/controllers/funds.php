<?php 
class Funds extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	   if(!isset($_SESSION['company_session']) || $_SESSION['company_session']=='')redirect('logout');
	   if(!isset($_SESSION['company_id']) || $_SESSION['company_id']=='')redirect('logout');
	}
	
	
	function index()
	{	

		$this->data["error_msg"] = '';
		$this->data["records"] = $this->fundsmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->load->view('include/header');
		$this->load->view('funds/fund_payment',$this->data);				
		$this->load->view('include/footer');
	}	

	
}
?>
