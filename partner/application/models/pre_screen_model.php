<?php
class Pre_screen_model extends CI_Model{
	var $table_name	= "";
	var $insert_id 	= "";
	function __construct()
	{
		$this->table_name = " pms_job_pre_screening";
		//$this->event_feature_table = "event_to_feature";
	}
	
	function record_count($searchterm,$pre_screen_date) 
	{

		$sql="SELECT count(*) as candidate_id FROM pms_candidate a inner join pms_job_pre_screening b on a.candidate_id=b.candidate_id ";
		
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and  a.first_name like '%" . $searchterm . "%'";
			}
			else{
			$cond =" a.first_name like '%" . $searchterm . "%'";
			} 
		} 
		
		if(($pre_screen_date!='')) 
		{
			if($cond!=''){
				$cond.=" and b.pre_screen_date = '".$pre_screen_date."' ";
			}
			else
			{
				$cond =" b.pre_screen_date = '".$pre_screen_date."' ";
			} 
		} 
		
		
		
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		
		$row=$query->row_array();
		return $row['candidate_id'];
	
	}
	
	
	function get_list($start,$limit,$searchterm,$pre_screen_date,$sort_by)
	{
	$sql="select a.first_name, a.mobile, a.payment_status, b.*,c.username, d.company_name FROM pms_candidate a inner join pms_job_pre_screening b on a.candidate_id=b.candidate_id left join pms_admin_users c on b.admin_id=c.admin_id left join pms_company d on d.company_id=b.company_id";
		
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and  a.first_name like '%" . $searchterm . "%'";
			}
			else{
			$cond =" a.first_name like '%" . $searchterm . "%'";
			} 
		} 
		
		if(($pre_screen_date!='')) 
		{
			if($cond!=''){
				$cond.=" and b.pre_screen_date = '".$pre_screen_date."' ";
			}
			else
			{
				$cond =" b.pre_screen_date = '".$pre_screen_date."' ";
			} 
		} 
		//$cond="a.first_name like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by b.pre_screen_date ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		//echo $this->db->last_query();
		return $query->result_array();
	
	}
	
	function update_status_select($id)
	{
		$query = $this->db->query("update pms_job_pre_screening set int_status='1' where interview_id=".$id);
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

	function get_current_schedule($candidate_id,$month,$year)
	{
		$data = array();		
		$query=$this->db->query("select candidate_id,day(avail_date)as avail_date from pms_candidate_available_dates where candidate_id=".$candidate_id." and month(avail_date)=".$month." and year(avail_date)=".$year);		
		$dropDownList = array();
		$admin_list = $query->result();		
		
		foreach($admin_list as $dropdown)
		{
			$dropDownList[$dropdown->avail_date] = '<p class="btn btn-primary btn-xs"></p>';
		}
		//print_r($dropDownList);
		//exit();
		return $dropDownList;
	}
	
	function update_shift_vacancy($candidate_id,$avail_date,$month,$year)
	{
		$avail_date=date('Y-m-d',mktime(0,0,0,$month,$avail_date,$year));
		$data=array(
		'candidate_id'    => $candidate_id,
		'avail_date'      => $avail_date,
		);
		
		$this->db->where('candidate_id', $candidate_id);
		$this->db->where('avail_date', $avail_date);
		$this->db->delete('pms_candidate_available_dates');
			
		$id=$this->db->insert('pms_candidate_available_dates', $data);		
		return $id;		
	}	
	
	function update_status_reject($id)
	{
		$query = $this->db->query("update pms_job_pre_screening set int_status='2' where interview_id=".$id);
		
	}

	
}
