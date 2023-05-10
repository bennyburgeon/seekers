<?php
class Dashboard extends CI_controller
 {
	
     function __construct()
	 {
        parent::__construct();
	  if(!isset($_SESSION['candidate_session']) || $_SESSION['candidate_session']=='')redirect('logout');
	   redirect('candidates_all/summary/');
		$this->data['cur_page']=$this->router->class;
     }

     function index()
	 {	
	    
	 	$this->load->model('dashboardmodel');
		
		
		
		$this->data["my_messages"]=$this->dashboardmodel->my_messages();
	
		$this->data['interview_list']		= $this->dashboardmodel->get_interview_list();
		

		
		$this->data['shortlisted']          = $this->dashboardmodel->get_shortlisted();
		$this->data['selected']             = $this->dashboardmodel->get_selected();
		$this->data['offer']                = $this->dashboardmodel->get_offer_issued();
		$this->data['accepted']             = $this->dashboardmodel->offer_accepted();

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
			
/*
	echo '<pre>';
	echo '<code>';
	print_r($this->data["all_branch_history"]);
	echo '</code>';
	echo '</pre>';
*/
			
?>