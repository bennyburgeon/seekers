<?php 
class Vendor_summary extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->load->model('vendor_summarymodel');
		$this->data['cur_page']=$this->router->class;
	}
	
	function index()
	{	
		$from_date='';
		$to_date='';

		if($this->input->get("from_date")!='')
		{
			$from_date=$this->input->get("fr	om_date");
		}
		if($this->input->get("to_date")!='')
		{
			$to_date=$this->input->get("to_date");
		}
				
		
		$this->data["records"] = $this->vendor_summarymodel->get_list($from_date,$to_date);
		
		$this->data["from_date"] = $from_date;		
		$this->data["to_date"] = $to_date;		

		
		$this->data['page_head'] = 'My Activity Report';				

		$this->load->view('include/header',$this->data);
		$this->load->view('vendor_summary/vendorsummarylist',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	
}
?>
