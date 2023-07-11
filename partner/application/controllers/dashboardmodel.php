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
		if($cond!=''){
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
	
	function get_interview_list(){
		$sql="select a.*,b.* from pms_candidate a inner join pms_candidate_interviews b ON a.candidate_id=b.candidate_id";
		$cond="b.interview_date >= DATE_ADD(CURDATE(), INTERVAL 1 DAY) ";
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by b.interview_date desc limit 5";
		$query = $this->db->query($sql);
		return $query->result_array();
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
	function latest_leads_list()
	{
		$query=$this->db->query("SELECT a.*,b.firstname FROM pms_company a inner join pms_admin_users b on a.user_id=b.admin_id order by a.date_added desc limit 0,10"); 		
		return $query->result_array();
	}
	
	function total_jobs_industry_based()
	{
		$query=$this->db->query('SELECT count(a.job_cat_id) as total_count, b.job_cat_name FROM `pms_jobs` a inner join pms_job_category b on a.job_cat_id=b.job_cat_id group by b.job_cat_name ');
		return $query->result_array();
	}

	function total_jobs_functional_based()
	{
		$query=$this->db->query('SELECT count(a.func_id) as total_count, b.func_area FROM `pms_jobs` a inner join pms_job_functional_area b on a.func_id=b.func_id group by b.func_area');
		return $query->result_array();
	}

	function total_jobs_designation_based()
	{
		$query=$this->db->query('SELECT count(a.desig_id) as total_count, b.desig_name FROM `pms_jobs` a inner join pms_designation b on a.desig_id=b.desig_id group by b.desig_name');
		return $query->result_array();
	}
		
	function candidate_profile_collection()
	{
		$query=$this->db->query('SELECT count(reg_date) as total_nos, reg_date FROM `pms_candidate` GROUP BY reg_date order by reg_date asc');
		return $query->result_array();
	}
		
	function cur_job_status_summary()
	{
		$query=$this->db->query('SELECT count(a.cur_job_status)as total_count,b.cur_job_status_name as status FROM `pms_candidate` a inner join pms_curernt_job_status b on a.cur_job_status=b.cur_job_status group by a.cur_job_status ');
		return $query->result_array();
	}
	
	function followup_history()
	{
		$query=$this->db->query("SELECT count(a.flp_date) as total, a.flp_date FROM `pms_company_followup` a group by a.flp_date order by a.flp_date asc");
		return $query->result_array();
	}
	
	function followup_status()
	{
		 $query=$this->db->query('select count(flp_status) as total_count,( CASE WHEN flp_status=0 THEN "Unknown" WHEN flp_status=1 THEN "We Have Openings" WHEN flp_status=2 THEN "No Openings" WHEN flp_status=3 THEN "Call after a month" WHEN flp_status=4 THEN "Already have vendor" WHEN flp_status=5 THEN "We have in house team" WHEN flp_status=6 THEN "Became Client" WHEN flp_status=7 THEN "Do not Disturb" END)as flp_status from pms_company_followup group by flp_status');
		return $query->result_array();
	}
	
	function candidate_to_industry()
	{
		$query=$this->db->query('SELECT count(a.job_cat_id) as total_count,b.job_cat_name from pms_candidate_to_industry a left join pms_job_category b on a.job_cat_id=b.job_cat_id group by b.job_cat_name');
		return $query->result_array();
	}
	
	function cv_source_summary()
	{
		  $query=$this->db->query('SELECT count(lead_source)as total_count,( CASE WHEN lead_source=0 THEN "Unknown" WHEN lead_source=1 THEN "Web" WHEN lead_source=2 THEN "Admin" WHEN lead_source=3 THEN "Mobile" END)as lead_source FROM `pms_candidate` ');
		return $query->result_array();
	}	
	// end here 
	
	function select_all_tasks()
    {
      $query=$this->db->query("select a.*,(select max(task_fl_date) from pms_task_followup where task_id=a.task_id) as last_flp_date,DATEDIFF(a.due_date,'".date('Y-m-d')."') as flp_date_diff, b.task_status_name,c.task_priority_name,d.username,e.first_name,(select firstname from pms_admin_users ad where ad.admin_id=a.assigned_by)as creator from pms_tasks a left join pms_task_status b on a.task_status_id=b.task_status_id left join pms_task_priority c on a.task_priority_id=c.task_priority_id left join pms_admin_users d on d.admin_id=a.admin_id left join pms_candidate e on a.candidate_id=e.candidate_id"); 
		return $query->result_array();
	}
	
	
}
?>	