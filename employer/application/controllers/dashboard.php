<?php
class Dashboard extends CI_controller
 {
	
     function __construct()
	 {
        parent::__construct();
	  if(!isset($_SESSION['company_session']) || $_SESSION['company_session']=='')redirect('logout');
		$this->data['cur_page']=$this->router->class;
     }

     function index()
	 {		 
	 	$this->load->model('dashboardmodel');

		$week_range=$this->rangeWeek(date('Y-m-d'));
		
		$this->data["start_date"]=$week_range['start_date'];
		$this->data["end_date"]=$week_range['end_date'];
		
		// latest leads list
		$this->data["interviews_current_week"]=$this->dashboardmodel->interviews_current_week($week_range['start_date'],$week_range['end_date']);
				
		//print_r($this->data["interviews_current_week"]);
		//exit();
		 
		// latest leads list
		$this->data["latest_applications_list"]=$this->dashboardmodel->latest_applications_list();
				//print_r($this->data["latest_applications_list"]);
				//exit();
		// latest leads list
		$this->data["interviews_history"]=$this->dashboardmodel->interviews_history();
						
		// leads collected by BDEs
		$this->data["candidate_to_industry"]=$this->dashboardmodel->candidate_to_industry();
		
		//print_r($this->data["candidate_to_industry"]);
		//exit();
		
		// leads collected by BDEs
		$this->data["candidate_registration_history"]=$this->dashboardmodel->candidate_registration_history();
			
		//lead status summary
		$this->data["candidates_to_functional_area"]=$this->dashboardmodel->candidates_to_functional_area();
	
		// my follow ups
		$this->data["candidate_to_applications"]=$this->dashboardmodel->candidate_to_applications();
		$this->data["candidates_in_education_level"]=$this->dashboardmodel->candidates_in_education_level();

		// summary of lead opportunity
		$this->data["candidates_in_specialisation"]=$this->dashboardmodel->candidates_in_specialisation();
		// graph data end here 
		
		// cound on dashboard
		$this->data['total_interviews']		= $this->dashboardmodel->total_interviews();
		$this->data['offer_letters']		= $this->dashboardmodel->offer_letters();
		$this->data['candidate_count']		= $this->dashboardmodel->candidate_count();
		$this->data['application_count']	= $this->dashboardmodel->application_count();
	
		//print_r ($this->rangeMonth(date('Y-m-d'))); // format: YYYY-M-D
 		//print_r ($this->rangeWeek(date('Y-m-d')));
// 		exit();
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

	public function rangeMonth ($datestr) {
	   date_default_timezone_set (date_default_timezone_get());
	   $dt = strtotime ($datestr);
	   return array (
		 "start_date" => date ('Y-m-d', strtotime ('first day of this month', $dt)),
		 "end_date" => date ('Y-m-d', strtotime ('last day of this month', $dt))
	   );
	 }

	 public function rangeWeek ($datestr) {
	   date_default_timezone_set (date_default_timezone_get());
	   $dt = strtotime ($datestr);
	   return array (
		 "start_date" => date ('N', $dt) == 1 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('last monday', $dt)),
		 "end_date" => date('N', $dt) == 7 ? date ('Y-m-d', $dt) : date ('Y-m-d', strtotime ('next sunday', $dt))
	   );
	 }
	
	
	function client_cv()
	{		
		if($this->input->post('candidate_id')!='')
		{
			$candidate_id    =   $this->input->post('candidate_id');			
			if($candidate_id < 1)exit();		
			$html_profile='<iframe width="100%;" scrolling="yes" height="800px;" src="'.$this->config->item('client_cv_preview').'profile_rms?candidate_id='.md5($candidate_id).'"></iframe>';			 
			echo $html_profile;
			exit();
		}else
		{
			exit();
		}
	}

	 
	 
 		
	}
			
?>