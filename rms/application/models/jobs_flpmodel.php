<?php 
class Jobs_flpmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_job_apps';
    }
	
	function record_count($admin_id,$ind_id,$call_date_from,$call_date_to,$candidate_id,$company_id,$job_id) 
	{
	
		$sql="SELECT count(a.app_call_id) as total_rec FROM `pms_job_apps_calls` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_jobs c on b.job_id=c.job_id inner join pms_company d on d.company_id=c.company_id inner join pms_candidate e on a.candidate_id=e.candidate_id inner join pms_admin_users f on a.admin_id=f.admin_id ";	
		$cond = "";
	
		if($admin_id!='')
		{
			if($cond!='')
			{
				$cond.=" and a.admin_id=" . $admin_id;
			} 
			else{
				$cond=" a.admin_id=" . $admin_id;
			}  
		} 

		if($company_id!='')
		{
			if($cond!='')
			{
				$cond.=" and d.company_id=" . $company_id;
			} 
			else{
				$cond=" d.company_id=" . $company_id;
			}  
		} 

		if($candidate_id!='')
		{
			if($cond!='')
			{
				$cond.=" and e.candidate_id=" . $candidate_id;
			} 
			else{
				$cond=" e.candidate_id=" . $candidate_id;
			}  
		} 

		if($job_id!='')
		{
			if($cond!='')
			{
				$cond.=" and c.job_id=" . $job_id;
			} 
			else{
				$cond=" c.job_id=" . $job_id;
			}  
		}
		
		if($call_date_from!='')
		{
			if($cond!=''){
				$cond.=" and a.call_date >= '" . $call_date_from."'";
			} 
			else{
				$cond=" a.call_date >= '" . $call_date_from."'";
			}  
		} 

		if($call_date_to!='')
		{
			if($cond!=''){
				$cond.=" and a.call_date <='" . $call_date_to."'";
			} 
			else{
				$cond=" a.call_date <='" . $call_date_to."'";
			}  
		} 		

		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;

		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['total_rec'];
	
	}
	
	function get_list($start,$limit,$admin_id,$ind_id,$sort_by,$call_date_from,$call_date_to,$candidate_id,$company_id,$job_id)
	{
		$sql='SELECT a.*,c.job_title,e.first_name,e.mobile,f.firstname as recruiter,( CASE WHEN a.cur_job_status=0 THEN "Unknown" WHEN a.cur_job_status=1 THEN "No Job" WHEN a.cur_job_status=2 THEN "But Need a Change" WHEN a.cur_job_status=3 THEN "Not Interested" WHEN a.cur_job_status=4 THEN "Seeking Good Opportunity" WHEN a.cur_job_status=5 THEN "Need a change" WHEN a.cur_job_status=6 THEN "Call after 1 Year" WHEN a.cur_job_status=6 THEN "Call after this month" END)as job_status FROM `pms_job_apps_calls` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_jobs c on b.job_id=c.job_id inner join pms_company d on d.company_id=c.company_id inner join pms_candidate e on a.candidate_id=e.candidate_id inner join pms_admin_users f on a.admin_id=f.admin_id';	
		
		$cond = "";	

		if($admin_id!='')
		{
			if($cond!='')
			{
				$cond.=" and a.admin_id=" . $admin_id;
			} 
			else{
				$cond.=" a.admin_id=" . $admin_id;
			}  
		} 

		if($company_id!='')
		{
			if($cond!='')
			{
				$cond.=" and d.company_id=" . $company_id;
			} 
			else{
				$cond.=" d.company_id=" . $company_id;
			}  
		} 

		if($candidate_id!='')
		{
			if($cond!='')
			{
				$cond.=" and e.candidate_id=" . $candidate_id;
			} 
			else{
				$cond.=" e.candidate_id=" . $candidate_id;
			}  
		} 

		if($job_id!='')
		{
			if($cond!='')
			{
				$cond.=" and c.job_id=" . $job_id;
			} 
			else{
				$cond.=" c.job_id=" . $job_id;
			}  
		}
						
		if($call_date_from!='')
		{
			if($cond!=''){
				$cond.=" and a.call_date >='" . $call_date_from."'";
			} 
			else{
				$cond.=" a.call_date>='" . $call_date_from."'";
			}  
		} 

		if($call_date_to!='')
		{
			if($cond!=''){
				$cond.=" and a.call_date <='" . $call_date_to."'";
			} 
			else{
				$cond.=" a.call_date <='" . $call_date_to."'";
			}  
		} 
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.app_call_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		
		return $query->result_array();	
	}

    function get_company_name($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select company_name from pms_job_apps where app_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['company_name'];
			}else
			{
				return '';
			}
	}

	function bde_lists()
	{
	  $query = $this->db->query('select distinct admin_id, firstname, lastname from pms_admin_users order by firstname asc');
	  $dropdowns = $query->result();
	  $dropDownList['']='BDEs';
	  foreach($dropdowns as $dropdown)
	  {
		$dropDownList[$dropdown->admin_id] = $dropdown->firstname.' '.$dropdown->lastname;
	  }
	  $finalDropDown = $dropDownList;
	  return $finalDropDown;
 	}

	function candidate_list()
	{
	  $query = $this->db->query('SELECT DISTINCT a.candidate_id,a.first_name,a.last_name from pms_candidate a inner join pms_job_apps_calls b on a.candidate_id=b.candidate_id order by a.first_name ');
	  $dropdowns = $query->result();
	  $dropDownList['']='Candidates';
	  foreach($dropdowns as $dropdown)
	  {
		$dropDownList[$dropdown->candidate_id] = $dropdown->first_name.' '.$dropdown->last_name;
	  }
	  $finalDropDown = $dropDownList;
	  return $finalDropDown;
 	}
	
	function jobs_list()
	{
	  $query = $this->db->query('SELECT DISTINCT a.job_id,a.job_title from pms_jobs a inner join pms_job_apps b on a.job_id=b.job_id inner join pms_job_apps_calls c on b.job_app_id=c.app_id order by a.job_title ');
	  $dropdowns = $query->result();
	  $dropDownList['']='Jobs';
	  foreach($dropdowns as $dropdown)
	  {
		$dropDownList[$dropdown->job_id] = $dropdown->job_title;
	  }
	  $finalDropDown = $dropDownList;
	  return $finalDropDown;
 	}
	
	function company_list()
	{
	  $query = $this->db->query('SELECT DISTINCT a.company_id,a.company_name,a.contact_name from pms_company a inner join pms_jobs b on a.company_id=b.company_id inner join pms_job_apps c on b.job_id=c.job_id inner join pms_job_apps_calls d on c.job_app_id=d.app_id order by a.company_name');
	  $dropdowns = $query->result();
	  $dropDownList['']='Company';
	  foreach($dropdowns as $dropdown)
	  {
		$dropDownList[$dropdown->company_id] = $dropdown->company_name.' || '.$dropdown->contact_name;
	  }
	  $finalDropDown = $dropDownList;
	  return $finalDropDown;
 	}
				
	function get_calls_history($app_id)
	{
			$sql='select a.*,b.*,( CASE WHEN a.cur_job_status=0 THEN "Unknown" WHEN a.cur_job_status=1 THEN "No Job" WHEN a.cur_job_status=2 THEN "But Need a Change" WHEN a.cur_job_status=3 THEN "Not Interested" WHEN a.cur_job_status=4 THEN "Seeking Good Opportunity" WHEN a.cur_job_status=5 THEN "Need a change" WHEN a.cur_job_status=6 THEN "Call after 1 Year" WHEN a.cur_job_status=6 THEN "Call after this month" END)as job_status from pms_job_apps_calls a inner join pms_admin_users b on a.admin_id=b.admin_id where a.app_id='.$app_id;
			$query = $this->db->query($sql);
			return $query->result_array();	
	}
	
	function industry_list()
	{
		$query = $this->db->query('select a.job_cat_id, a.job_cat_name from pms_job_category a order by a.job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Indsutry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

function country_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Country';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}		

	function cur_opportunity($id)
	{
		$query = $this->db->query('select distinct opp_id, app_id from pms_company_opportunity where app_id='.$id);
		$dropdowns = $query->result();
		$dropDownList=array();
		$i=0;
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$i] = $dropdown->opp_id;
			 $i++;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	

	function get_extras($id)
	{
			if($id!='')
			{
				$query = $this->db->query("SELECT a.city_id, b.state_id,c.country_id FROM `pms_city` a inner join pms_state b on a.state_id=b.state_id inner join pms_country c on b.country_id=b.country_id inner join pms_job_apps d on a.city_id=d.city_id where d.app_id=".$id);
				
				if ($query->num_rows()> 0)
				{
					$row = $query->row_array();
					return $row;
				}else
				{
					return array();
				}
			}
	}


// values for graph
	function latest_leads_list()
	{
		$query=$this->db->query("SELECT a.*,b.firstname FROM pms_job_apps a inner join pms_admin_users b on a.admin_id=b.admin_id order by a.applied_on desc limit 0,10"); 		
		return $query->result_array();
	}
	
	function bde_to_lead_collection()
	{
		$query=$this->db->query('SELECT count(a.admin_id) as total_leads, b.firstname FROM `pms_job_apps_calls` a inner join pms_admin_users b on a.admin_id=b.admin_id group by b.firstname order by total_leads desc');
		return $query->result_array();
	}
	
	function call_status_summary()
	{
		$query=$this->db->query('select count(a.cur_job_status) as total_count,( CASE WHEN a.cur_job_status="null" THEN "Unknown" WHEN a.cur_job_status=1 THEN "No Job" WHEN a.cur_job_status=2 THEN "But Need a Change" WHEN a.cur_job_status=3 THEN "Not Interested" WHEN a.cur_job_status=4 THEN "Seeking Good Opportunity" WHEN a.cur_job_status=5 THEN "Need a change" WHEN a.cur_job_status=6 THEN "Call after 1 Year" WHEN a.cur_job_status=6 THEN "Call after this month" END)as status from  pms_job_apps_calls a group by status');
		return $query->result_array();
	}
	
	function followup_history()
	{
		$query=$this->db->query("SELECT count(a.call_date) as total, a.call_date FROM `pms_job_apps_calls` a group by a.call_date order by a.call_date asc");
		return $query->result_array();
	}
	
	function process_status_percentage()
	{
$job_process_summary=array();

		$query = $this->db->get('pms_job_apps');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Job Applications', 'total_count' => $total_rows);		

		$query = $this->db->get('pms_job_apps_calls');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Calls Made','total_count' => $total_rows);	
		
		$query = $this->db->get('pms_job_apps_shortlisted');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Shortlisted', 'total_count' => $total_rows);
		
		$query = $this->db->get('pms_job_apps_interviews');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Interviews' , 'total_count' => $total_rows);

		$query = $this->db->get('pms_job_apps_interviews_rejection');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Rejection' , 'total_count' => $total_rows);
		
		$query = $this->db->get('pms_job_apps_offerletter');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Offers Given', 'total_count' => $total_rows);

		$query = $this->db->get('pms_job_apps_selected');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Selections', 'total_count' => $total_rows);

		$query = $this->db->get('pms_job_apps_placement');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Placements' , 'total_count'=> $total_rows);
		
		$query = $this->db->get('pms_job_apps_invoice');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Invoice', 'total_count' => $total_rows);
						
		return $job_process_summary;
	}
	
	function job_process_summary()
	{
		$job_process_summary=array();

		$query = $this->db->get('pms_job_apps');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Job Applications', 'total_count' => $total_rows);		

		$query = $this->db->get('pms_job_apps_calls');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Calls Made','total_count' => $total_rows);	
		
		$query = $this->db->get('pms_job_apps_shortlisted');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Shortlisted', 'total_count' => $total_rows);
		
		$query = $this->db->get('pms_job_apps_interviews');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Interviews' , 'total_count' => $total_rows);

		$query = $this->db->get('pms_job_apps_interviews_rejection');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Rejection' , 'total_count' => $total_rows);
		
		$query = $this->db->get('pms_job_apps_offerletter');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Offers Given', 'total_count' => $total_rows);

		$query = $this->db->get('pms_job_apps_selected');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Selections', 'total_count' => $total_rows);

		$query = $this->db->get('pms_job_apps_placement');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Placements' , 'total_count'=> $total_rows);
		
		$query = $this->db->get('pms_job_apps_invoice');
		$total_rows=$query->num_rows();		
		$job_process_summary[]=array('process_category' => 'Total Invoice', 'total_count' => $total_rows);
						
		return $job_process_summary;
	}
	// end here 
		
}
?>
