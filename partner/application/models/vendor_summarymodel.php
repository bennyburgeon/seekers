<?php 
class Vendor_summarymodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_vendors';
    }
	
	function get_list($from_date,$to_date)
	{
		$sql='SELECT a.* from pms_vendors a where a.vendor_id='.$_SESSION['vendor_session'];
		$cond='';
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.firstname ";
		$query = $this->db->query($sql);
		$result_rray = $query->result_array();
	  	$all_records=array();
		foreach($result_rray as $row)
		{
		  	$all_records[]=array('vendor_id'                => $row['vendor_id'], 
							'firstname'                    => $row['firstname'],							
							'total_jobs'                   => $this->get_total_jobs_added($row['vendor_id'],$from_date,$to_date),
							'total_apps'                   => $this->get_total_cvs_added($row['vendor_id'],$from_date,$to_date), 
							'total_apps_feedback'          => $this->get_total_cvs_feedback($row['vendor_id'],$from_date,$to_date), 
							'total_apps_rejected'          => $this->get_total_cvs_rejected($row['vendor_id'],$from_date,$to_date), 
							'total_short_listed'           => $this->get_total_cvs_shortlisted($row['vendor_id'],$from_date,$to_date),
							'total_interview_scheduled'    => $this->get_total_cvs_interviews($row['vendor_id'],$from_date,$to_date),
							'total_interview_rejected'     => $this->get_total_cvs_interviews_rejected($row['vendor_id'],$from_date,$to_date), 
							'total_selected'               => $this->get_total_cvs_selected($row['vendor_id'],$from_date,$to_date),
							'total_offered'                => $this->get_total_cvs_offered($row['vendor_id'],$from_date,$to_date),
							'total_offered_accepted'       => $this->get_total_cvs_offer_accepted($row['vendor_id'],$from_date,$to_date), 
							'total_offered_rejected'       => $this->get_total_cvs_offer_rejected($row['vendor_id'],$from_date,$to_date), 
							'total_placed'                 => $this->get_total_cvs_placements($row['vendor_id'],$from_date,$to_date),
							'total_invoiced'                 => $this->get_total_cvs_invoiced($row['vendor_id'],$from_date,$to_date),
							);
		}
		//print_r($all_records);
		//exit();
		return $all_records;	
	}

    function get_total_jobs_added($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(vendor_id) as total_rec from pms_candidate_to_vendors where vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and job_post_date between '".$from_date."' and '".$to_date."'";
		
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
	
    function get_total_cvs_added($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where b.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.applied_on between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_feedback($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		$sql="select count(b.vendor_id)as total_rec from pms_candidate_job_search a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where b.vendor_id=".$vendor_id;
		if($from_date!='' && $to_date!='')$sql.=" and a.update_date between '".$from_date."' and '".$to_date."'";
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
	
    function get_total_cvs_rejected($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where a.rejected_by=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.rejected_on between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_shortlisted($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps_shortlisted a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where b.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.short_date between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_interviews($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps_interviews a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where b.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.interview_date between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_interviews_rejected($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps_interviews_rejection a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where b.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.interview_date between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_selected($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps_selected a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where b.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.selected_date between '".$from_date."' and '".$to_date."'";
		
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
		
						
    function get_total_cvs_offered($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps_offerletter a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where b.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.offer_date between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_offer_accepted($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps_offerletter a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where a.offer_status=2 and b.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.offer_date between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_offer_rejected($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(b.vendor_id)as total_rec from pms_job_apps_offerletter a inner join pms_candidate_to_vendors b on a.candidate_id=b.candidate_id where a.offer_status=3 and b.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.offer_date between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_placements($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(c.vendor_id)as total_rec from pms_job_apps_placement a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate_to_vendors c on c.candidate_id=b.candidate_id where c.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and a.created_on between '".$from_date."' and '".$to_date."'";
		
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

    function get_total_cvs_invoiced($vendor_id,$from_date,$to_date)
	{
		if($vendor_id < 1) return '0';
		
		$sql="select count(c.vendor_id)as total_rec from pms_job_apps_invoice d inner join pms_job_apps_placement a on a.placement_id=d.placement_id inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate_to_vendors c on c.candidate_id=b.candidate_id where c.vendor_id=".$vendor_id;
		
		if($from_date!='' && $to_date!='')$sql.=" and d.invoice_date between '".$from_date."' and '".$to_date."'";
		
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
		$query=$this->db->query("SELECT a.*,b.firstname FROM pms_job_apps a inner join pms_admin_users b on a.vendor_id=b.vendor_id order by a.applied_on desc limit 0,10"); 		
		return $query->result_array();
	}
	
	function bde_to_lead_collection()
	{
		$query=$this->db->query('SELECT count(a.vendor_id) as total_leads, b.firstname FROM `pms_job_apps_calls` a inner join pms_admin_users b on a.vendor_id=b.vendor_id group by b.firstname order by total_leads desc');
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
