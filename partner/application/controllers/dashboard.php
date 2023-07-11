<?php
class Dashboard extends CI_controller
 {
	
     function __construct()
	 {
        parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');	
		//$controller_name = $this->router->fetch_class();
        //if(!in_array($controller_name, $_SESSION['module_url']))redirect('error_page');
		$this->data['cur_page']=$this->router->class;
     }

     function index()
	 {		 
	 	$this->load->model('dashboardmodel');

		$week_range=$this->rangeWeek(date('Y-m-d'));
		
		$this->data["start_date"]=$week_range['start_date'];
		$this->data["end_date"]=$week_range['end_date'];
		
		//$this->data["latest_tasks"]      =$this->dashboardmodel->latest_tasks();
		$this->data["my_latest_jobs"]    =$this->dashboardmodel->my_latest_jobs();
		$this->data["latest_interviews"] =$this->dashboardmodel->latest_interviews($week_range['start_date'],$week_range['end_date']);
		
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
		
		//client feedback popup
		
		$this->data['client_feedback']        = $this->dashboardmodel->get_client_feedback();
		
		// cound on dashboard
		$this->data['total_interviews']		= $this->dashboardmodel->total_interviews();
		$this->data['offer_letters']		= $this->dashboardmodel->offer_letters();
		$this->data['candidate_count']		= $this->dashboardmodel->candidate_count();
		$this->data['application_count']	= $this->dashboardmodel->application_count();
	
		$this->load->view('include/header', $this->data);
		$this->load->view('dashboard/list', $this->data);
		$this->load->view('include/footer', $this->data);
          
     }

		public function rangeWeek ($datestr) {
			   date_default_timezone_set (date_default_timezone_get());
			   $dt = strtotime ($datestr);
			   return array (
				 "start_date" => date ('N', $dt) == 1 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('last monday', $dt)),
				 "end_date" => date('N', $dt) == 7 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('next sunday', $dt))
			   );
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