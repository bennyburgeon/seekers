<?php 
class Recruiter_summary extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		$this->load->model('recruiter_summarymodel');
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
				
		
		$this->data["records"] = $this->recruiter_summarymodel->get_list($from_date,$to_date);
		
		$this->data["from_date"] = $from_date;		
		$this->data["to_date"] = $to_date;		

		
		$this->data['page_head'] = 'Recruiters Activity Report';				

		$this->load->view('include/header',$this->data);
		$this->load->view('recruiter_summary/recruitersummarylist',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	
}
?>
