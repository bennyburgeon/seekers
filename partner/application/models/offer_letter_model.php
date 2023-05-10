<?php 
class offer_letter_model extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_job_apps_offerletter';
		$this->upload_file_name='';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "SELECT count(*)as job_id 
				FROM pms_job_apps_offerletter
				INNER JOIN pms_job_apps
					on pms_job_apps.job_app_id = pms_job_apps_offerletter.app_id
				INNER JOIN pms_jobs 
					on pms_jobs.job_id = pms_job_apps.job_id
				INNER JOIN pms_company
					on pms_company.company_id = pms_jobs.company_id
				INNER JOIN pms_candidate
					on pms_candidate.candidate_id=pms_job_apps_offerletter.candidate_id";
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" job_title like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		$row=$query->row_array();
		return $row['job_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
		$sql="SELECT pms_job_apps_offerletter.*
					,pms_job_apps.job_id
					,pms_jobs.company_id
					,pms_jobs.job_title
					, pms_candidate.first_name
					,pms_candidate.last_name
					,pms_company.company_name
				FROM pms_job_apps_offerletter
				INNER JOIN pms_job_apps
					on pms_job_apps.job_app_id = pms_job_apps_offerletter.app_id
				INNER JOIN pms_jobs 
					on pms_jobs.job_id = pms_job_apps.job_id
				INNER JOIN pms_company
					on pms_company.company_id = pms_jobs.company_id
				INNER JOIN pms_candidate
					on pms_candidate.candidate_id=pms_job_apps_offerletter.candidate_id";
		$cond='';
		if($searchterm!='')
		{
			if($cond!='')
			{
				//$cond.=" and candidate_id=".$candidateId;
			} 
			else
			{
				$cond="pms_jobs.job_title like '%" . $searchterm . "%'";
			}  
		} 
		$cond="pms_jobs.job_title like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by job_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result_array();
	
	}



	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('candidate_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	

}
?>