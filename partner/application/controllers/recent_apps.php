<?php
class Recent_apps extends CI_controller
 {
     function __construct()
	 {
        parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->data['cur_page']=$this->router->class;
     }

     function index()
	 {		 
	 	$this->load->model('recent_apps_model');

		$this->data["applications_list"]=$this->recent_apps_model->applications_list();

//latest candidate matches
		
		$query = $this->db->query("select c.first_name,c.last_name,c.username,c.mobile,d.job_title,c.candidate_id from pms_candidate_to_skills_primary a inner join pms_job_to_skill b on a.skill_id=b.skill_id inner join  pms_candidate c on c.candidate_id=a.candidate_id inner join pms_jobs d on b.job_id=d.job_id  group by c.candidate_id order by c.reg_date desc limit 0,10");
		$this->data["candidate_matches"] = $query->result_array();
		
// contract details of candidate
		$query=$this->db->query("SELECT a.first_name,a.mobile,a.username,b.* FROM pms_candidate a inner join pms_candidate_contract b on a.candidate_id=b.candidate_id order by a.reg_date desc limit 0,10"); 
		$this->data["contract_details"]=$query->result_array();
		

		//$this->data['menu_flow']= $this->load->view("includes/flow",$this->data,true);
		$this->load->view('include/header', $this->data);
		$this->load->view('recent_apps/list', $this->data);
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