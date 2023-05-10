<?php 

class Dashboardmodel extends CI_Model {

	

	var $table_name='';

	var $insert_id='';

	

    function __construct()

    {

		

    }

	

	function get_status_list()

	{

		$sql="select * from pms_process_status";

		$cond='';

		if($cond!='')

		{

			//$cond.=" and candidate_id=".$candidateId;

		} 

		else{

			$cond=" status='1'";

		}

		

		if($cond!='') $cond=' where '.$cond;

		

		$sql=$sql.$cond;

		

		$sql.=" order by status_order asc";

		$query = $this->db->query($sql);

		return $query->result_array();

	}

	

	function total_interviews() 

	{

		$sql	= "select count(*)as interview_id from pms_job_apps_interviews";

		$cond	= '';

		if($cond!='') $cond=' where '.$cond;

		$sql=$sql.$cond;

		

		$query = $this->db->query($sql);

		$row=$query->row_array();

		return $row['interview_id'];

	}

	

	function offer_letters() 

	{

		$sql	= "select count(*)as offer_id from pms_job_apps_offerletter";

		$cond	= '';

		if($cond!='') $cond=' where '.$cond;

		$sql=$sql.$cond;

		

		$query = $this->db->query($sql);

		$row=$query->row_array();

		return $row['offer_id'];

	}

	

	function candidate_count(){

		$sql	= "select count(*)as candidate_id from pms_candidate";

		$cond	= '';

		if($cond!='') $cond=' where '.$cond;

		$sql=$sql.$cond;

		

		$query = $this->db->query($sql);

		$row=$query->row_array();

		return $row['candidate_id'];

	}

	

	function application_count(){

		$sql	= "select count(*)as job_app_id from pms_job_apps";

		$cond	= '';

		if($cond!='') $cond=' where '.$cond;

		$sql=$sql.$cond;

		

		$query = $this->db->query($sql);

		$row=$query->row_array();

		return $row['job_app_id'];

	}

	

	function get_complaint_list(){

		$sql = "select a.candidate_id,a.first_name,a.last_name,b.ticket_id,b.ticket_title,c.ticket_status_name from pms_candidate a inner join pms_tickets b on a.candidate_id = b.candidate_id inner join pms_tickets_status c on b.ticket_status_id = c.ticket_status_id order by b.ticket_id desc limit 5";

		

		$query = $this->db->query($sql);

		return $query->result_array();



	}

	

	function get_shortlisted()

	{

		

		$query = $this->db->query('select a.*,b.*,c.short_id,c.app_id,c.short_date,c.admin_id,d.job_title,e.company_name from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_job_apps_shortlisted c on b.job_app_id=c.app_id inner join pms_jobs d on b.job_id=d.job_id  inner join pms_company e on d.company_id=e.company_id order by a.first_name asc limit 0,10');

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



	function get_selected()

	{

		

		$query = $this->db->query('SELECT a.*,c.first_name,c.last_name,c.username,c.mobile,d.job_title,e.company_name FROM `pms_job_apps_selected` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id inner join pms_jobs d on b.job_id=d.job_id  inner join pms_company e on d.company_id=e.company_id order by c.first_name asc limit 0,10');

		$dropdowns = $query->result_array();	



		return $dropdowns;

	}

	

	function get_offer_issued()

	{

		$query = $this->db->query('SELECT a.*,b.*,c.first_name,c.last_name,c.username,c.mobile,d.job_title,e.company_name FROM `pms_job_apps_offerletter` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id inner join pms_jobs d on b.job_id = d.job_id  inner join pms_company e on d.company_id=e.company_id order by c.first_name asc limit 0,10');

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



	function offer_accepted()

	{

		$query = $this->db->query('SELECT a.*,b.*,c.first_name,c.last_name,c.username,c.mobile,d.job_title,e.company_name FROM `pms_job_apps_placement` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on b.candidate_id=c.candidate_id inner join pms_jobs d on b.job_id = d.job_id  inner join pms_company e on d.company_id=e.company_id order by c.first_name asc limit 0,10');

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



	function get_invoice()

	{

		

		$query = $this->db->query('SELECT a.job_title ,a.job_id, a.company_id, b.job_app_id, d.invoice_id, d.invoice_date, d.invoice_status, d.invoice_amount, e.candidate_id,e.first_name,e.last_name,e.username,e.mobile,f.company_name FROM pms_jobs a INNER JOIN pms_job_apps b on b.job_id=a.job_id INNER JOIN pms_job_apps_placement c on c.app_id=b.job_app_id INNER JOIN pms_job_apps_invoice d on c.placement_id=d.placement_id INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id INNER JOIN pms_company f on a.company_id=f.company_id order by e.first_name asc limit 0,10 ');

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}	

	// values for graph

	function latest_applications_list()
	{
		$sql="SELECT a.job_id,b.applied_on,b.job_app_id,c.candidate_id, c.first_name, d.total_experience, d.notice_period";	
		$sql.=", (select sal.salary_amount from pms_job_salary sal where sal.salary_id=d.salary_id_ctc) as current_ctc ";
		$sql.=", (select sal.salary_amount from pms_job_salary sal where sal.salary_id=d.salary_id_ectc) as expected_ctc ";
		$sql.=" FROM pms_jobs a inner join pms_job_apps b on a.job_id=b.job_id inner join pms_job_apps_shortlisted jas on b.job_app_id=jas.app_id inner join pms_candidate c on b.candidate_id=c.candidate_id left join pms_candidate_job_search d on d.candidate_id=c.candidate_id where a.company_id=".$_SESSION['company_id']." order by b.job_app_id desc limit 0,10";
	
		$query = $this->db->query($sql);		
		$dropdowns = $query->result_array();
		return $dropdowns;
	}


	// values for graph

	function interviews_current_week($start_date,$end_date)

	{

		$query = $this->db->query("SELECT a.job_id,b.applied_on,c.candidate_id,c.first_name,d.*,e.* FROM pms_jobs a inner join pms_job_apps b on a.job_id=b.job_id inner join pms_candidate c on b.candidate_id=c.candidate_id left join pms_candidate_job_search d on d.candidate_id=c.candidate_id inner join pms_job_apps_interviews e on b.job_app_id=e.job_app_id where interview_date between '".$start_date."' and '".$end_date."' and a.company_id=".$_SESSION['company_id']." order by b.job_app_id desc limit 0,10");

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



	// values for graph

	function interviews_history()

	{

				$query = $this->db->query("SELECT a.job_id,b.applied_on,b.app_status_id,c.candidate_id,c.first_name,d.*,e.* FROM pms_jobs a inner join pms_job_apps b on a.job_id=b.job_id inner join pms_candidate c on b.candidate_id=c.candidate_id left join pms_candidate_job_search d on d.candidate_id=c.candidate_id inner join pms_job_apps_interviews e on b.job_app_id=e.job_app_id where a.company_id=".$_SESSION['company_id']." order by b.job_app_id desc limit 0,10");

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}

				

	function candidate_to_industry()

	{

		$query=$this->db->query('SELECT count(a.candidate_id) as total_candidates, b.job_cat_name FROM `pms_candidate_job_profile` a inner join pms_job_category b on a.job_cat_id=b.job_cat_id group by b.job_cat_name order by total_candidates desc');

		return $query->result_array();

	}



	function candidate_registration_history()

	{

		$query=$this->db->query('SELECT count(reg_date) as total_nos, reg_date FROM `pms_candidate` GROUP BY reg_date order by reg_date asc');

		return $query->result_array();

	}

		

	function candidates_to_functional_area()

	{

		$query=$this->db->query('SELECT count(a.candidate_id) as total_candidates, b.func_area FROM `pms_candidate_job_profile` a inner join pms_job_functional_area b on a.func_id=b.func_id group by b.func_area order by total_candidates desc');

		return $query->result_array();

	}

	

	function candidate_to_applications()

	{

		$query=$this->db->query("SELECT count(a.applied_on) as total, a.applied_on FROM `pms_job_apps` a group by a.applied_on order by a.applied_on asc");

		return $query->result_array();

	}

	

	function candidates_in_education_level()

	{

		  //$query=$this->db->query('select count(a.level_id) as total_count, b.level_name from pms_candidate_education a inner join pms_education_level b group by b.level_name');

		//return $query->result_array();

	}

	

	function candidates_in_specialisation()

	{

		//$query=$this->db->query('SELECT count(a.spcl_id) as total_count,b.spcl_name from pms_candidate_education a inner join pms_specialisation b on a.spcl_id=b.spcl_id group by b.spcl_name');

		//return $query->result_array();

	}

	

	// end here 

	

	function get_candidate_profile($candidateId){

	

		$query=$this->db->query("select a.* from ".$this->table_name." a where a.candidate_id=".$candidateId);

		return $query->row_array();

	}

	

}

?>	