<?php
class Rpt_followup extends CI_controller
 {
	
     function __construct()
	 {
        parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->data['cur_page']=$this->router->class;
     }

     function index()
	 {	
	 
	 	$this->load->model('rpt_followupmodel');
		
		$this->data["all_branch_history"]=array();
		// corrected form of array
		
		for($i=0;$i<30;$i++)
		{
			$last_30=date("Y-m-d", mktime(0, 0, 0, date("m"), date("d")-$i,   date("Y")));
			$query_branch=$this->db->query("SELECT * from pms_branch order by branch_name");
			$branch_list=$query_branch->result_array();
			$node_array=array();
			foreach($branch_list as $key => $val)
			{
				$query=$this->db->query("SELECT count(a.flp_date)total, a.flp_date,c.branch_name FROM `pms_candidate_followup` a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_branch c on b.branch_id=c.branch_id where c.branch_id=".$val['branch_id']." and a.flp_date='".$last_30."' group by a.flp_date");	
				if($query->num_rows()>0)
				{
					$row=$query->row_array();
					$node_array[$val['branch_name']]=$row['total'];
				}else
				{
					$node_array[$val['branch_name']]='null';
				}
			}
			if(count($node_array)>0)
			$this->data["all_branch_history"][$last_30]=$node_array;
			
/*			echo '<pre>';
			echo '<code>';
			print_r($this->data["all_branch_history"]);
			echo '</code>';
			echo '</pre>';*/
		}
		
		// ends here 
//		exit();
		
        $query=$this->db->query("SELECT count(flp_date) as total, flp_date FROM `pms_candidate_followup` group by flp_date order by flp_date asc");
		$this->data["follow_up_history"]=$query->result_array();
		
        $query=$this->db->query("SELECT count( a.branch_id ) AS totalsale, b.branch_name, b.branch_id FROM `pms_candidate` a LEFT JOIN pms_branch b ON a.branch_id = b.branch_id GROUP BY b.branch_name order by b.branch_name");
		$this->data["sales_branch"]=$query->result_array();

        $query=$this->db->query("SELECT count(a.course_id)as total,b.course_name FROM `pms_candidate` a left join pms_courses b on a.course_id=b.course_id group by b.course_name order by b.course_name");
		$this->data["courses_opted"]=$query->result_array();

        $query=$this->db->query("SELECT a.univ_name,count(b.candidate_id)as total FROM `pms_university` a inner join pms_candidate_applications b on a.univ_id=b.campus_id group by a.univ_name");
		$this->data["univ_opted"]=$query->result_array();
		
		//	print_r($this->data["sales_branch"]);
		//exit();
		 $query=$this->db->query("select a.*,b.task_status_name,c.task_priority_name,d.username from pms_tasks a inner join pms_task_status b ON a.task_status_id=b.task_status_id inner join pms_task_priority c on a.task_priority_id=c.task_priority_id inner join pms_admin_users d on d.admin_id=a.admin_id order by a.task_status_id desc limit 5");
		$this->data["tasks"]=$query->result_array();
	
		
		$query=$this->db->query("SELECT a.*,b.* FROM pms_process_status a inner JOIN pms_candidate_applications b ON a.status_id=b.process_status_id inner JOIN pms_candidate c ON b.candidate_id=c.candidate_id order by a.status_id limit 0,10"); 
		$this->data["candidate_list"]=$query->result_array();
		
		$query=$this->db->query("SELECT * FROM pms_process_status order by status_order asc");
		$this->data["process_status_list"]=$query->result_array();
		
	

		$this->data["statusArr"] = $this->rpt_followupmodel->get_status_list();
		
		$this->data['follow_up_count']		= $this->rpt_followupmodel->follow_up_count();
		$this->data['course_count']			= $this->rpt_followupmodel->course_count();
		$this->data['candidate_count']		= $this->rpt_followupmodel->candidate_count();
		$this->data['application_count']	= $this->rpt_followupmodel->application_count();
		
		$this->data['interview_list']		= $this->rpt_followupmodel->get_interview_list();
		$this->data['complaint_list']		= $this->rpt_followupmodel->get_complaint_list();
		
		
		//$this->data['menu_flow']= $this->load->view("includes/flow",$this->data,true);
		$this->load->view('include/header', $this->data);
		$this->load->view('rpt_followup/list', $this->data);
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