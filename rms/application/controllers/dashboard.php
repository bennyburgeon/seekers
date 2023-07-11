<?php
class Dashboard extends CI_controller
 {
	
     function __construct()
	 {
        parent::__construct();
	  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');
		$this->data['cur_page']=$this->router->class;
     }

     function index()
	 {
	    
	 	$this->load->model('dashboardmodel');

		// graph data //		
		// latest leads list
		$this->data["latest_leads_list"]=$this->dashboardmodel->latest_leads_list();
		
		// leads collected by BDEs
		$this->data["bde_to_lead_collection"]=$this->dashboardmodel->bde_to_lead_collection();

		// leads collected by BDEs
		$this->data["candidate_profile_collection"]=$this->dashboardmodel->candidate_profile_collection();
			
		//lead status summary
		$this->data["lead_status_summary"]=$this->dashboardmodel->lead_status_summary();
	
		// my follow ups
		$this->data["followup_history"]=$this->dashboardmodel->followup_history();
		$this->data["followup_status_summary"]=$this->dashboardmodel->followup_status_summary();

		// summary of lead opportunity
		$this->data["lead_opportunity"]=$this->dashboardmodel->lead_opportunity();
		// graph data end here 
		
		
		// cound on dashboard
		$this->data['total_interviews']		= $this->dashboardmodel->total_interviews();
		$this->data['offer_letters']		= $this->dashboardmodel->offer_letters();
		$this->data['candidate_count']		= $this->dashboardmodel->candidate_count();
		$this->data['application_count']	= $this->dashboardmodel->application_count();
	
		$this->load->view('include/header', $this->data);
		$this->load->view('dashboard/list', $this->data);
		$this->load->view('include/footer', $this->data);
          
     }
	 
	public function image_create() 
	  {
			$path = dirname(__FILE__);
			$finalPath = dirname($path) . '/assets/graph_data';
			$chartnum=$_POST['chartnum'];
			$a = $_POST[$chartnum];
			if ($a != '') 
			{
				$imageData1 = file_get_contents($a);
				file_put_contents($finalPath . '/'.$_POST['chartnum'].'.png', $imageData1);
			}
		}
	}
			
?>