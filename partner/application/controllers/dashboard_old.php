<?php
class Dashboard extends CI_controller
 {
	
     function __construct()
	 {
        parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->data['cur_page']=$this->router->class;
     }

     function index()
	 {		 
	 	$this->load->model('dashboardmodel');

		// graph data //		
		// latest leads list
		$this->data["latest_leads_list"]=$this->dashboardmodel->latest_leads_list();
		
		// leads collected by BDEs
		$this->data["total_jobs_industry_based"]=$this->dashboardmodel->total_jobs_industry_based();

		// 
		$this->data["total_jobs_functional_based"]=$this->dashboardmodel->total_jobs_functional_based();
		
		$this->data["total_jobs_designation_based"]=$this->dashboardmodel->total_jobs_designation_based();
		
		// leads collected by BDEs
		$this->data["candidate_profile_collection"]=$this->dashboardmodel->candidate_profile_collection();
			
		//lead status summary
		$this->data["cur_job_status_summary"]=$this->dashboardmodel->cur_job_status_summary();
	
		// my follow ups

		$this->data["cv_source_summary"]=$this->dashboardmodel->cv_source_summary();
		
		// summary of lead opportunity
		$this->data["candidate_to_industry"]=$this->dashboardmodel->candidate_to_industry();
		// graph data end here 
		
		// report based on package
		$this->data["report_based_on_package"]=$this->dashboardmodel->report_based_on_package();
		// report based on job process
		$this->data["job_process_summary"]=$this->dashboardmodel->job_process_summary();
		
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