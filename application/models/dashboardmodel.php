<?php 
class Dashboardmodel extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    function __construct()
    {
		
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
	
	function get_interview_list()
	{
		$sql="select a.candidate_id,b.*,c.applied_on,d.job_title,e.interview_type from pms_candidate a inner join pms_job_apps_interviews b ON a.candidate_id=b.candidate_id  inner join pms_job_apps c on c.job_app_id=b.job_app_id inner join pms_jobs d on d.job_id=c.job_id left join pms_candidate_interview_types e on e.interview_type_id=b.interview_type_id where a.candidate_id=".$_SESSION['candidate_session']." order by b.interview_date desc";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	
	function get_shortlisted()
	{
		
		$query = $this->db->query("select a.*,b.*,c.short_id,c.app_id,c.short_date,c.candidate_id,d.job_title,e.company_name from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_job_apps_shortlisted c on b.job_app_id=c.app_id inner join pms_jobs d on b.job_id=d.job_id  inner join pms_company e on d.company_id=e.company_id where c.candidate_id=".$_SESSION['candidate_session']." order by a.first_name asc");
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

	function get_selected()
	{
		
		$query = $this->db->query("SELECT a.*,c.first_name,c.last_name,c.username,c.mobile,d.job_title,e.company_name FROM `pms_job_apps_selected` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id inner join pms_jobs d on b.job_id=d.job_id  inner join pms_company e on d.company_id=e.company_id where c.candidate_id=".$_SESSION['candidate_session']." order by c.first_name asc");
		$dropdowns = $query->result_array();	

		return $dropdowns;
	}
	
	function get_offer_issued()
	{
		
		$query = $this->db->query("SELECT a.*,b.*,c.first_name,c.last_name,c.username,c.mobile,d.job_title,e.company_name FROM `pms_job_apps_offerletter` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id inner join pms_jobs d on b.job_id = d.job_id  inner join pms_company e on d.company_id=e.company_id where c.candidate_id=".$_SESSION['candidate_session']." order by c.first_name asc");
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

	function offer_accepted()
	{
		
		$query = $this->db->query("SELECT a.*,b.*,c.first_name,c.last_name,c.username,c.mobile,d.job_title,e.company_name FROM `pms_job_apps_placement` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on b.candidate_id=c.candidate_id inner join pms_jobs d on b.job_id = d.job_id  inner join pms_company e on d.company_id=e.company_id where c.candidate_id=".$_SESSION['candidate_session']." order by c.first_name asc");
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
	function my_messages()
	{
				$query=$this->db->query("SELECT a.*,b.firstname FROM pms_candidate_messages a left join pms_admin_users b on a.admin_id=b.admin_id where a.candidate_id=".$_SESSION['candidate_session']." order by a.message_id desc limit 0,10");		
		return $query->result_array();
	}
}
?>	