<?php 

class Vconversionmodel extends CI_Model {

	var $table_name='';

    function __construct()

    {

		$this->table_name='pms_candidate';

    }

	

	function record_count($search_name) 

	{	

	

		$sql='SELECT count(a.candidate_id) as total_rec FROM `pms_candidate` a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_jobs c on b.job_id=c.job_id inner join pms_candidate_to_vendors d on d.candidate_id=a.candidate_id';

		$cond = " b.app_status_id=9 ";	
		$cond .= " and d.vendor_id=".$_SESSION['vendor_session'];
	

		if($search_name!='')

		{

			if($cond!='')

				$cond.=" and a.first_name like '%". $search_name ."%' ";

			else

				$cond =" a.first_name like '%" . $search_name . "%' ";

		}



		



		if($cond!='') $cond=' where '.$cond;

		

		$sql=$sql.$cond;



		$query = $this->db->query($sql);

		$row=$query->row_array();

		return $row['total_rec'];

	}

	

	function get_list($start,$limit,$search_name,$sort_by)

	{

		

		$sql='SELECT a.first_name,a.mobile,a.username, plc.join_date,plc.monthly_salary_offered, b.app_status_id,c.job_title,cp.company_name,vd.firstname as vendor_name,vd.vendor_id, ct.city_name ';

		

		//$sql.=' (select ) ';

		$sql.=' from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_jobs c on b.job_id=c.job_id inner join pms_company cp on c.company_id=cp.company_id inner join pms_job_apps_placement plc on b.job_app_id=plc.app_id inner join pms_candidate_to_vendors d on d.candidate_id=a.candidate_id inner join pms_vendors vd on d.vendor_id=vd.vendor_id left join pms_city ct on a.city_id=ct.city_id';

		$cond = " b.app_status_id=9 ";	
		$cond .= " and d.vendor_id=".$_SESSION['vendor_session'];

		if($search_name!='')
		{
			if($cond!='')
				$cond.=" and a.first_name like '%". $search_name ."%' ";
			else
				$cond =" a.first_name like '%" . $search_name . "%' ";
		}	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		$sql.=" order by a.first_name asc limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();	
	}
}

?>

