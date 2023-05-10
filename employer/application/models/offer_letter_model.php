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
				FROM pms_job_apps_offerletter a
				INNER JOIN pms_job_apps b
					on b.job_app_id = a.app_id
				INNER JOIN pms_jobs  c
					on c.job_id = b.job_id
				INNER JOIN pms_candidate d
					on d.candidate_id=a.candidate_id";
		$cond = '';
		
		$cond.=" c.company_id=".$_SESSION['company_id'];
		
		
		if($searchterm!='')
		{
			if($cond!=''){
			$cond =" and job_title like '%" . $searchterm . "%'";
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
		$sql="SELECT a.*, b.job_id, c.company_id, c.job_title, d.first_name, d.last_name FROM pms_job_apps_offerletter a INNER JOIN pms_job_apps b
					on b.job_app_id = a.app_id INNER JOIN pms_jobs  c on c.job_id = b.job_id INNER JOIN pms_candidate d on d.candidate_id=a.candidate_id";
		
		$cond='';
		$cond.=" c.company_id=".$_SESSION['company_id'];
		
		if($searchterm!='')
		{
			if($cond!='')
			{
				$cond=" and c.job_title like '%" . $searchterm . "%'";
			} 
			else
			{
				$cond=" c.job_title like '%" . $searchterm . "%'";
			}  
		} 
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by job_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		
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