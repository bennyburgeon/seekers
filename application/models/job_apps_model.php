<?php 
class job_apps_model extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_job_apps';
		$this->upload_file_name='';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "SELECT count(*)as job_id FROM pms_job_apps
				INNER JOIN pms_jobs 
					on pms_jobs.job_id = pms_job_apps.job_id
				INNER JOIN pms_company
					on pms_company.company_id = pms_jobs.company_id
				INNER JOIN pms_candidate
					on pms_candidate.candidate_id=pms_job_apps.candidate_id";
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" pms_jobs.job_id =". $searchterm ;
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		
		$row=$query->row_array();
		return $row['job_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
		$sql="SELECT pms_job_apps.*
					,pms_jobs.job_title
					, pms_candidate.first_name
					,pms_candidate.last_name
					,pms_company.company_name
				FROM pms_job_apps
				INNER JOIN pms_jobs 
					on pms_jobs.job_id = pms_job_apps.job_id
				INNER JOIN pms_company
					on pms_company.company_id = pms_jobs.company_id
				INNER JOIN pms_candidate
					on pms_candidate.candidate_id=pms_job_apps.candidate_id";
		$cond='';
		if($searchterm!='')
		{
			if($cond!='')
			{
				//$cond.=" and candidate_id=".$candidateId;
			} 
			else
			{
				$cond="pms_jobs.job_id =". $searchterm ;
			}  
		} 
		//$cond="pms_jobs.job_id =". $searchterm ;;
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by job_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result_array();
	
	}


	function get_job_dashboard($no_rec, $offset)
	{
		$query=$this->db->query("SELECT a.job_id,a.job_title,b.company_name, c.job_cat_name,a.job_post_date FROM `pms_jobs` a inner join pms_company b on a.company_id=b.company_id inner join pms_job_category c on a.job_cat_id=c.job_cat_id order by a.job_post_date desc limit $offset,$no_rec");
		return $query->result_array();
	}


	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('candidate_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
	 function detail_list2($candidate_id)
   	{
   		$query = $this->db->query('select a.*,b.address,c.course_name from pms_candidate a left join pms_candidate_address b on a.candidate_id=b.candidate_id left join pms_courses c on a.course_id=c.course_id where a.candidate_id='.$candidate_id);
	return $query->row_array();
  	}
	
	
	function detail_list($app_id)
   {
   		$query = $this->db->query('select * from pms_job_apps where job_app_id='.$app_id);
	return $query->row_array();
   }
   
   
   function follow_record($app_id)
    {
        $query=$this->db->query("select a.*,b.status_name from pms_job_followup a left join pms_process_status b on a.status_id=b.status_id  where a.app_id=".$app_id);
		return $query->result_array();
	}
	 
	function notes_record($app_id)
    {
        $query=$this->db->query("select * from pms_job_notes where job_app_id=".$app_id);
		return $query->result_array();
	}
	
	  
	function status_list()
	{
		$query = $this->db->query('select distinct status_id,status_name from pms_process_status order by status_order asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Process Status';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->status_id] = $dropdown->status_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function admin_user_list()
	{
		$query = $this->db->query('select distinct candidate_id,first_name from pms_candidate order by first_name');
		$dropdowns = $query->result();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->candidate_id] = $dropdown->first_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function job_details()
	{
		$query = $this->db->query('SELECT pms_job_apps.*
					,pms_jobs.job_title
					, pms_candidate.first_name
					,pms_candidate.last_name
					,pms_company.company_name
				FROM pms_job_apps
				INNER JOIN pms_jobs 
					on pms_jobs.job_id = pms_job_apps.job_id
				INNER JOIN pms_company
					on pms_company.company_id = pms_jobs.company_id
				INNER JOIN pms_candidate
					on pms_candidate.candidate_id=pms_job_apps.candidate_id');
		return $query->result_array();
	}
	function select_notes_record($id)
    {
        $query=$this->db->query("select * from pms_candidate_notes where candidate_note_id=".$id);
		return $query->row_array();
	}
	
	
	function get_all_jobs()
	{
		$query=$this->db->query("select job_id,job_title from pms_jobs order by job_title asc");
		$dropdowns = $query->result();
		$dropDownList['0']='Select Job for Search';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_id] = $dropdown->job_title;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
		
}
?>