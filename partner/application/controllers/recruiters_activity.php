<?php 
class Recruiters_activity extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->load->model('recruiters_activitymodel');
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
				
		
		$this->data["records"] = $this->recruiters_activitymodel->get_list($from_date,$to_date);
		
		$this->data["from_date"] = $from_date;		
		$this->data["to_date"] = $to_date;		

		
		$this->data['page_head'] = 'Recruiters Activity Report';				

		$this->load->view('include/header',$this->data);
		$this->load->view('recruiters_activity/recruitersactivitylist',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	
}
?>
