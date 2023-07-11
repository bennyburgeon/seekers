<?php 
class Recruiters_activitymodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_job_apps';
    }
	
	function get_list($from_date,$to_date)
	{
		$sql='SELECT a.*,b.* from pms_admin_users a inner join pms_admin_user_groups b on a.group_id=b.user_grp_id where a.admin_id='.$_SESSION['vendor_session'];
		$cond='';
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.firstname ";
		$query = $this->db->query($sql);
		$result_rray = $query->result_array();
	  	$all_records=array();
		foreach($result_rray as $row)
		{
		  	$all_records[]=array('admin_id'                => $row['admin_id'], 
							'firstname'                    => $row['firstname'],							
							'total_jobs'                   => $this->get_total_jobs_added($row['admin_id'],$from_date,$to_date),
							'total_apps'                   => $this->get_total_cvs_added($row['admin_id'],$from_date,$to_date), 
							'total_apps_feedback'          => $this->get_total_cvs_feedback($row['admin_id'],$from_date,$to_date), 
							'total_apps_rejected'          => $this->get_total_cvs_rejected($row['admin_id'],$from_date,$to_date), 
							'total_short_listed'           => $this->get_total_cvs_shortlisted($row['admin_id'],$from_date,$to_date),
							'total_interview_scheduled'    => $this->get_total_cvs_interviews($row['admin_id'],$from_date,$to_date),
							'total_interview_rejected'     => $this->get_total_cvs_interviews_rejected($row['admin_id'],$from_date,$to_date), 
							'total_selected'               => $this->get_total_cvs_selected($row['admin_id'],$from_date,$to_date),
							'total_offered'                => $this->get_total_cvs_offered($row['admin_id'],$from_date,$to_date),
							'total_offered_accepted'       => $this->get_total_cvs_offer_accepted($row['admin_id'],$from_date,$to_date), 
							'total_offered_rejected'       => $this->get_total_cvs_offer_rejected($row['admin_id'],$from_date,$to_date), 
							'total_placed'                 => $this->get_total_cvs_placements($row['admin_id'],$from_date,$to_date),
							'total_invoiced'                 => $this->get_total_cvs_invoiced($row['admin_id'],$from_date,$to_date),
							);
		}
		//print_r($all_records);
		//exit();
		return $all_records;	
	}

    function get_total_jobs_added($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		//$sql="select count(admin_id)as total_rec from pms_jobs where admin_id=".$admin_id;
		$sql="select count(a.job_id)as total_rec from pms_jobs_to_recruiter a inner join pms_jobs b on a.job_id=b.job_id where a.admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and b.job_post_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}
	
    function get_total_cvs_added($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps where admin_id=".$admin_id;
		//echo $sql; exit();
		if($from_date!='' && $to_date!='')$sql.=" and applied_on between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_feedback($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		$sql="select count(admin_id)as total_rec from pms_candidate_job_search where admin_id=".$admin_id;
		if($from_date!='' && $to_date!='')$sql.=" and update_date between '".$from_date."' and '".$to_date."'";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}
	
    function get_total_cvs_rejected($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps where rejected_by=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and rejected_on between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_shortlisted($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_shortlisted where admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and short_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_interviews($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_interviews where admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and interview_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_interviews_rejected($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_interviews where rejected_by=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and interview_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_selected($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_selected where admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and selected_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}
		
						
    function get_total_cvs_offered($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_offerletter where admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and offer_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_offer_accepted($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_offerletter where offer_status=2 and admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and offer_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_offer_rejected($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_offerletter where offer_status=3 and admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and offer_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_placements($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_placement where admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and created_on between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
		}
	}

    function get_total_cvs_invoiced($admin_id,$from_date,$to_date)
	{
		if($admin_id < 1) return '0';
		
		$sql="select count(admin_id)as total_rec from pms_job_apps_invoice where admin_id=".$admin_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and invoice_date between '".$from_date."' and '".$to_date."'";
		
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['total_rec'];
		}else
		{
			return '0';
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
