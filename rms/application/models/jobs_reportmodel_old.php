<?php 
class Jobs_reportmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_job_apps';
    }
	
	function record_count($admin_id,$company_id,$searchterm) 
	{
	
		$sql="SELECT count(a.job_id) as total_rec FROM `pms_jobs` a inner join pms_company b on a.company_id=b.company_id inner join pms_jobs_to_recruiter c on a.job_id=c.job_id";	
		$cond = " job_status=1 ";
		$cond.= " and c.admin_id=".$_SESSION['admin_session'];
	
		if($admin_id!='')
		{
			if($cond!='')
			{
				$cond.=" and a.job_id in (select job_id from pms_jobs_to_recruiter where admin_id=" . $admin_id ." )";
			} 
			else{
				$cond.=" a.job_id in (select job_id from pms_jobs_to_recruiter where admin_id=" . $admin_id ." )";
			}  
		}

		if($company_id!='')
		{
			if($cond!='')
			{
				$cond.=" and a.company_id=" . $company_id;
			} 
			else{
				$cond=" a.company_id=" . $company_id;
			}  
		} 
        
         if($searchterm!='')
		{
			if($cond!='')
			{
				$cond.=" and a.job_title like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.job_title like '%" . $searchterm . "%'";
			}  
		} 


		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;

		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['total_rec'];
	
	}
    
    
	function get_list($start,$limit,$admin_id,$sort_by,$company_id,$searchterm)
	{
		
		$sql='SELECT DISTINCT a.*,b.company_name,(select count(job_app_id) from pms_job_apps where job_id=a.job_id)as total_apps ';
		
		$sql.=', (select count(job_app_id) from pms_job_apps japp where japp.app_status_id=2 and job_id=a.job_id)as total_apps_rejected ';
		
		$sql.=', (SELECT count(short_id) FROM pms_job_apps_shortlisted where app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_short_listed ';
		$sql.=', (SELECT count(interview_id) FROM pms_job_apps_interviews where job_app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_interview_scheduled ';

		$sql.=', (SELECT count(interview_id) FROM pms_job_apps_interviews where int_status=2 and job_app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_interview_rejected ';

		$sql.=', (SELECT count(select_id) FROM pms_job_apps_selected where app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_selected ';

		$sql.=', (SELECT count(offer_id) FROM pms_job_apps_offerletter where offer_status >=1 and app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_offered ';

		$sql.=', (SELECT count(offer_id) FROM pms_job_apps_offerletter where offer_status=2 and app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_offered_accepted ';

		$sql.=', (SELECT count(offer_id) FROM pms_job_apps_offerletter where offer_status=3 and app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_offered_rejected ';				

		$sql.=', (SELECT count(placement_id) FROM pms_job_apps_placement where app_id in (select job_app_id from pms_job_apps where job_id=a.job_id)) as total_placed ';	
										
		$sql.=' FROM pms_jobs a inner join pms_company b on b.company_id=a.company_id inner join pms_jobs_to_recruiter c on a.job_id=c.job_id ';	
		
		$cond = "";	
		$cond = " job_status=1 ";
		$cond.= " and c.admin_id=".$_SESSION['admin_session'];
	
		if($admin_id!='')
		{
			if($cond!='')
			{
				$cond.=" and a.job_id in (select job_id from pms_jobs_to_recruiter where admin_id=" . $admin_id ." )";
			} 
			else{
				$cond.=" a.job_id in (select job_id from pms_jobs_to_recruiter where admin_id=" . $admin_id ." )";
			}  
		}

		if($company_id!='')
		{
			if($cond!='')
			{
				$cond.=" and a.company_id=" . $company_id;
			} 
			else{
				$cond=" a.company_id=" . $company_id;
			}  
		} 
 
        
        if($searchterm!='')
		{
			if($cond!='')
			{
				$cond.=" and a.job_title like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.job_title like '%" . $searchterm . "%'";
			}  
		} 
        
       
	
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by total_apps desc limit ".$start.",".$limit;

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
	  $query = $this->db->query('SELECT DISTINCT a.company_id,a.company_name,a.contact_name from pms_company a inner join pms_jobs b on a.company_id=b.company_id order by a.company_name');
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
