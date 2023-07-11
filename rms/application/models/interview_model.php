<?php
class Interview_model extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = " pms_job_apps_interviews";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm,$from_date,$to_date) 
	{

		$sql="SELECT count(*) as job_id FROM pms_jobs a INNER JOIN pms_job_apps b on b.job_id=a.job_id INNER JOIN pms_job_apps_interviews c on c.job_app_id=b.job_app_id INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id LEFT JOIN pms_candidate_interview_status f on f.int_status_id=c.int_status_id LEFT JOIN pms_candidate_interview_types g on c.interview_type_id=g.interview_type_id";
		
		$cond='';
        $cond = " a.job_id in (select job_id from pms_jobs_to_recruiter where admin_id=".$_SESSION['admin_session'].") ";
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and  a.job_title like '%" . $searchterm . "%'";
			}
			else{
			$cond =" a.job_title like '%" . $searchterm . "%'";
			} 
		} 
		
		if(($from_date!='') && ($to_date!='')) 
		{
			if($cond!=''){
				$cond.=" and c.interview_date >= '".$from_date."' AND c.interview_date <= '".$to_date."' ";
			}
			else
			{
				$cond =" c.interview_date >= '".$from_date."' AND c.interview_date <= '".$to_date."' ";
			} 
		} 
		
		
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		
		$row=$query->row_array();
		return $row['job_id'];
	
	}
	
	
	function get_list($start,$limit,$searchterm,$from_date,$to_date,$sort_by)
	{
	$sql="SELECT a.job_title,a.job_id,cmp.company_name,b.job_app_id,b.candidate_id,c.interview_id,c.interview_date,c.interview_time,c.int_status,e.first_name,e.last_name,f.int_status_name,g.interview_type FROM pms_jobs a INNER JOIN pms_job_apps b on b.job_id=a.job_id INNER JOIN pms_job_apps_interviews c on c.job_app_id=b.job_app_id INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id inner join pms_company cmp on a.company_id=cmp.company_id LEFT JOIN pms_candidate_interview_status f on f.int_status_id=c.int_status_id LEFT JOIN pms_candidate_interview_types g on c.interview_type_id=g.interview_type_id";
		
		$cond='';
        $cond = " a.job_id in (select job_id from pms_jobs_to_recruiter where admin_id=".$_SESSION['admin_session'].") ";
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and  a.job_title like '%" . $searchterm . "%'";
			}
			else{
			$cond =" a.job_title like '%" . $searchterm . "%'";
			} 
		} 
		
		if(($from_date!='') && ($to_date!='')) 
		{
			if($cond!=''){
				$cond.=" and c.interview_date >= '".$from_date."' AND c.interview_date <= '".$to_date."' ";
			}
			else
			{
				$cond =" c.interview_date >= '".$from_date."' AND c.interview_date <= '".$to_date."' ";
			} 
		} 
		//$cond="a.job_title like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by a.job_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	
	function update_status_select($id)
	{
		$query = $this->db->query("update pms_job_apps_interviews set int_status='1' where interview_id=".$id);
		$data=array(
		'app_id'          => $this->input->get('app_id'),
		'candidate_id'    => $this->input->get('candidate_id') ,
		'feedback'        => 'Selected' ,
		'select_date'     => date('Y-m-d'),
		);
		$this->db->query("delete from pms_job_apps_selected where app_id=".$this->input->get('app_id')." and candidate_id=".$this->input->get('candidate_id'));
		$id=$this->db->insert('pms_job_apps_selected', $data);
		//echo $this->db->last_query();exit;
		return $id;
		
	}
	
	function update_status_reject($id)
	{
		$query = $this->db->query("update pms_job_apps_interviews set int_status='2' where interview_id=".$id);
		
	}

	
}
