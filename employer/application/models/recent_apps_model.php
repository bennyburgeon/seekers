<?php 
class Recent_apps_model extends CI_Model {
	
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
	
	function applications_list()
	{
		$job_apps_list=array();		
		$job_sql='select job_id,job_title from pms_jobs order by job_id desc';
		$query = $this->db->query($job_sql);
		$jobs_list=$query->result_array();
		
			foreach($jobs_list as $job_id)
			{
				$sql="select a.*,b.* from pms_candidate a inner join pms_job_apps b ON a.candidate_id=b.candidate_id where b.job_id=".$job_id['job_id'];
				$sql.=" order by b.applied_on desc";
				
				$query = $this->db->query($sql);
				$apps_list=$query->result_array();
				$data=array();

				foreach($apps_list as $app)
				{
						$data[]=$app;
				}
			
				if(count($data)>0)
				{
					$job_apps_list[]=array
							(
								'job_id' =>$job_id['job_id'],
								'job_title' => $job_id['job_title'],	
								'apps_list'	=> $data,
							);
				}
			}
		return $job_apps_list;
	}
}
?>	