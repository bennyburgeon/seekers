<?php 
class Shiftmanagermodel extends CI_Model 
{
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_client_shifts';
		$this->upload_file_name='';
    }
	
	function record_count($searchterm,$shift_status_id,$company_id,$shift_date) 
	{

		$sql = "select count(*)as client_shift_id from ".$this->table_name." a ";
		$cond = '';
			
		if($searchterm!='')
		{
			if($cond!=''){
				$cond .=" and a.shift_title like '%" . $searchterm . "%'";
			}
			else{
				$cond =" a.shift_title like '%" . $searchterm . "%'";
			} 
		} 

		if($company_id >0)
		{
			if($cond!=''){
				$cond .=" and a.company_id=" . $company_id;
			}
			else{
				$cond =" a.company_id=" . $company_id;
			} 
		}
		
		if($shift_status_id!='')
		{
			if($cond!=''){
				$cond .=" and a.shift_status_id=" . $shift_status_id;
			}
			else{
				$cond =" a.shift_status_id=" . $shift_status_id;
			} 
		}

		if($shift_date!='')
		{
			if($cond!=''){
				$cond.=" and a.shift_date='" . $shift_date."'";
			} 
			else{
				$cond=" a.shift_date='" . $shift_date."'";
			}  
		}
		
					
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
	
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['client_shift_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by,$shift_status_id,$company_id,$shift_date)
	{
		$sql="select a.*,b.company_name,c.shift_name, d.first_name,e.desig_name from ".$this->table_name." a left join pms_company b on a.company_id=b.company_id left join pms_shifts c on a.shift_id=c.shift_id left join pms_candidate d on a.candidate_id=d.candidate_id left join pms_designation e on a.desig_id=e.desig_id";
			
		$cond='';
		
	if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and a.shift_title like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.shift_title like '%" . $searchterm . "%'";
			}  
		} 

		if($shift_status_id!='')
		{
			if($cond!=''){
				$cond.=" and a.shift_status_id=" . $shift_status_id;
			} 
			else{
				$cond=" a.shift_status_id=" . $shift_status_id;
			}  
		}

		if($company_id >0)
		{
			if($cond!=''){
				$cond .=" and a.company_id=" . $company_id;
			}
			else{
				$cond =" a.company_id=" . $company_id;
			} 
		}

		if($shift_date!='')
		{
			if($cond!=''){
				$cond.=" and a.shift_date='" . $shift_date."'";
			} 
			else{
				$cond=" a.shift_date='" . $shift_date."'";
			}  
		}
		
					
		if($cond!='') $cond=' where '.$cond;

		$sql=$sql.$cond;

		$sql.=" order by a.client_shift_id ".$sort_by." limit ".$start.",".$limit;
		
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

	function get_candidate_list()
	{
		$sql='select DISTINCT a.candidate_id,a.first_name pms_candidate a order by first_name';		
		$query = $this->db->query($sql);	
		
		$dropdowns = $query->result();
		$dropDownList[0]='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->candidate_id] = $dropdown->first_name;
		}	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function insert_record()
    {
		$data=array(
				'shift_title'         => $this->input->post('shift_title'),
				'shift_date'          => $this->input->post('shift_date'),
				'created_on'          => date('Y-m-d') ,
				'location_id'        => $this->input->post('location_id'),
				'company_id'          => $this->input->post('company_id'),		
				'band_id'             => $this->input->post('band_id'),
				'shift_id'            => $this->input->post('shift_id'),
				'desig_id'            => $this->input->post('desig_id'),
				'shift_status_id'     => 1,
				'candidate_id'        => $this->input->post('candidate_id'),		
				'shift_details'       => $this->input->post('shift_details'),
				'admin_id'            => $_SESSION['vendor_session'],
				);
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }

	function update_record($id='')
	{
		if($id=='')return;
		
		$data=array(
		'shift_title'         => $this->input->post('shift_title'),
		'shift_date'          => $this->input->post('shift_date'),
		'created_on'          => date('Y-m-d') ,
		'location_id'        => $this->input->post('location_id'),
		'company_id'          => $this->input->post('company_id'),		
		'band_id'             => $this->input->post('band_id'),
		'shift_id'            => $this->input->post('shift_id'),
		'desig_id'            => $this->input->post('desig_id'),
		//'shift_status_id'     => $this->input->post('shift_status_id'),
		'candidate_id'        => $this->input->post('candidate_id'),		
		'shift_details'       => $this->input->post('shift_details'),
		'admin_id'            => $_SESSION['vendor_session'],
		);

       $this->db->where('client_shift_id', $id);
	   $this->db->update($this->table_name, $data);
	}
	
	 function insert_candidate_from_jobs($data)
	 {
			$this->db->insert('pms_candidate', $data);
			$id = $this->db->insert_id();
			return $id;
		}
		
	
	
	function insert_skill_details($client_shift_id,$p_id)
	{
		$this->db->query("delete from pms_job_to_skill where client_shift_id=".$client_shift_id);
		if(isset($_POST['skills']) && $_POST['skills']!='')
		{
			foreach($_POST['skills'] as $id)
			{
				
				$data=array
				(
					'client_shift_id'=>$client_shift_id,
					'skill_id'=>$id,
				
				);
			
			$this->db->insert('pms_job_to_skill',$data);
			}
		}
	}

	function download_cv($candidateId){
	
		$query=$this->db->query("select a.cv_file from pms_candidate a where a.candidate_id=".$candidateId);
		return $query->row_array();
	}
		
	function insert_domain_details($client_shift_id)
	{
		$this->db->query("delete from pms_job_to_domain where client_shift_id=".$client_shift_id);
		if(isset($_POST['domain_id']) && $_POST['domain_id']!='')
		{
			foreach($_POST['domain_id'] as $id)
			{
				
				$data=array
				(
					'client_shift_id'=>$client_shift_id,
					'domain_id'=>$id,
				
				);
			
			$this->db->insert('pms_job_to_domain',$data);
			}
		}
	}

	function copy_job($id)
    {
		$this->db->where('client_shift_id', $id);
		$query=$this->db->get('pms_client_shifts');
		$data=$query->row_array();
		unset($data['client_shift_id']);
		$data['shift_title']=$data['shift_title'].' - Copy';

        $this->db->insert($this->table_name, $data);
		$client_shift_id=$this->db->insert_id();

		$job_certifications = $this->get_certification_details($id);	
		
		if(count($job_certifications)>0)
		{
			foreach($job_certifications as $key => $val)
			{
				$data=array
				(
					'client_shift_id'=>$client_shift_id,
					'cert_id'=>$val['cert_id'],				
				);
			
			$this->db->insert('pms_job_to_certification',$data);
			}
		}
		
		$job_skill = $this->get_skill_details($id);
		if(count($job_skill)>0)
		{
			foreach($job_skill as $key => $val)
			{
				$data=array
				(
					'client_shift_id'=>$client_shift_id,
					'skill_id'=>$val['skill_id'],
				
				);			
			$this->db->insert('pms_job_to_skill',$data);
			}
		}

		$job_domain = $this->get_domain_details($id);
		if(count($job_domain)>0)
		{
			foreach($job_domain as $key => $val)
			{
				$data=array
				(
					'client_shift_id'=>$client_shift_id,
					'domain_id'=>$val['domain_id'],
				);
			$this->db->insert('pms_job_to_domain',$data);
			}
		}							
		return $client_shift_id;
    }

	function get_shift_details($client_shift_id)
    {
		$job_details=array();
		
		$query=$this->db->query("SELECT a.company_id,a.company_name,a.contact_name,a.contact_phone,a.contact_email,b.*,c.band_name,d.desig_name, e.shift_name, f.city_name
  FROM pms_company a inner join pms_client_shifts b on a.company_id=b.company_id inner join pms_bands c on b.band_id=c.band_id inner join pms_designation d on b.desig_id=d.desig_id inner join pms_shifts e on e.shift_id=b.shift_id inner join pms_city f on b.location_id=f.city_id where b.client_shift_id=".$client_shift_id);
		$job_details=$query->row_array();
		return $job_details;
    }

	function get_job_complete($client_shift_id)
    {
		$job_details=array();

		$query=$this->db->query("SELECT a.*,b.company_name, c.job_cat_name,d.salary_desc,e.city_name as job_lcoation_name FROM `pms_client_shifts` a inner join pms_company b on a.company_id=b.company_id left join pms_job_category c on a.job_cat_id=c.job_cat_id left join pms_job_salary d on a.salary_id=d.salary_id left join pms_city e on a.job_location=e.city_id where a.client_shift_id=".$client_shift_id);
		$job_details=$query->row_array();
		return $job_details;
    }
	
	function get_vendor($vendor_id)
    {
		$vendor_details=array();
		$this->db->where('vendor_id', $vendor_id);
		$query=$this->db->get('pms_vendors');
		$vendor_details=$query->row_array();
		return $vendor_details;
    }

	function check_recruiter_asigned($admin_id,$client_shift_id)
    {
		$total_count=0;
		$this->db->where('admin_id', $admin_id);
		$this->db->where('client_shift_id', $client_shift_id);
		$query=$this->db->get('pms_jobs_to_recruiter');
		$total_count=$query->num_rows();
		return $job_details;
    }

	function check_vendor_asigned($vendor_id,$client_shift_id)
    {
		$total_count=array();
		$this->db->where('vendor_id', $vendor_id);
		$this->db->where('client_shift_id', $client_shift_id);
		$query=$this->db->get('pms_jobs_to_vendors');
		$total_count=$query->num_rows();
		return $total_count;
    }
			
	function child_skill()
	{
		 $id=$this->input->get('id');
		//~ $id=1;
		$this->data['skillset']=$this->jobprocessmodel->get_child_skills($id);
		echo json_encode($this->data);
	}

	function addcandidate($data,$client_shift_id)
	{
		foreach ($data as $key => $val)
 		{
			$query = $this->db->query('SELECT * from pms_job_apps where client_shift_id='.$client_shift_id.' and candidate_id='.$val);
			if($query->num_rows()==0)
			{
				$data=array(
						'client_shift_id'=> $client_shift_id,
						'candidate_id' =>  $val,
						'applied_on' => date('Y-m-d') ,
						'cover_letter'=> '' ,
						'admin_id'   => $_SESSION['vendor_session'],
						'app_status_id'=> 1
						);
			$this->db->insert('pms_job_apps', $data);
			}
		}		
	}

	function get_job_folders()
    {
		$dropDownList=array();
		$dropDownList['']='Select Folder';	
		
	 	$query=$this->db->query("select * from pms_job_folder order by job_folder_id asc");
		
		$folder_list = $query->result();
		
		foreach($folder_list as $folder)
		{
			$dropDownList[$folder->job_folder_id] = $folder->job_folder_name;
		}
		return $dropDownList;
    }	

	function add_candidates_from_other_jobs($data)
	{
		$query = $this->db->query('SELECT * from pms_job_apps where client_shift_id='.$data['client_shift_id'].' and candidate_id='.$data['candidate_id']);
		if($query->num_rows()==0)
		{
			$this->db->insert('pms_job_apps', $data);
		}
	}

	function get_from_applicant_list($client_shift_id)
	{
		$query=$this->db->query('select * from pms_job_apps where client_shift_id='.$client_shift_id);
		return $query->result_array();
	}

	function get_from_short_listed_list($client_shift_id)
	{
		$query=$this->db->query('select a.* from pms_job_apps a inner join pms_job_apps_shortlisted b on a.job_app_id=b.app_id where  a.client_shift_id='.$client_shift_id);
		return $query->result_array();
	}

	function get_from_rejected_list($client_shift_id)
	{
		$query=$this->db->query('select * from pms_job_apps where app_status_id=2 and client_shift_id='.$client_shift_id);
		return $query->result_array();
	}

	function get_from_interview_list($client_shift_id)
	{
		$query=$this->db->query('select a.* from pms_job_apps a inner join pms_job_apps_interviews b on a.job_app_id=b.job_app_id where a.client_shift_id='.$client_shift_id);
		return $query->result_array();
	}
					
	function remove_from_apps($candidate_id,$job_app_id,$client_shift_id)
	{
		$query = $this->db->query('delete from pms_job_apps where candidate_id='.$candidate_id.' and job_app_id='.$job_app_id.' and app_status_id=1 and client_shift_id='.$client_shift_id);
		return 0;
	}
	
	function get_filter_count($id)
	{
		$where='';
		
		$sql='select DISTINCT count(a.candidate_id)as total_rec from  pms_candidate a left join pms_candidate_job_search b on a.candidate_id=b.candidate_id ';

		$where=' where a.candidate_id not in(select candidate_id from pms_job_apps where client_shift_id='.$id.') ';

		if($this->input->post('exp_years_min')!='')
		{
			if($where!='')
			{
				$where.=' and b.total_experience >='.$this->input->post('exp_years_min');
			}else
			{
				$where.=' b.total_experience >='.$this->input->post('exp_years_min');
			}
		}

		if($this->input->post('exp_years_max')!='')
		{
			if($where!='')
			{
				$where.=' and b.total_experience <='.$this->input->post('exp_years_max');
			}else
			{
				$where.=' b.total_experience <='.$this->input->post('exp_years_max');
			}
		}

		if($this->input->post('notice_min')!='')
		{
			if($where!='')
			{
				$where.=' and b.notice_period >='.$this->input->post('notice_min');
			}else
			{
				$where.=' b.notice_period >='.$this->input->post('notice_min');
			}
		}

		if($this->input->post('notice_max')!='')
		{
			if($where!='')
			{
				$where.=' and b.notice_period <='.$this->input->post('notice_max');
			}else
			{
				$where.=' b.notice_period <='.$this->input->post('notice_max');
			}
		}

	if($this->input->post('ctc_min')!='')
		{
			if($where!='')
			{
				$where.=' and b.current_ctc >='.$this->input->post('ctc_min');
			}else
			{
				$where.=' b.current_ctc >='.$this->input->post('ctc_min');
			}
		}

		if($this->input->post('ctc_max')!='')
		{
			if($where!='')
			{
				$where.=' and b.current_ctc <='.$this->input->post('ctc_max');
			}else
			{
				$where.=' b.current_ctc <='.$this->input->post('ctc_max');
			}
		}
				
		// any keywords - OR operation		
		$any_keywords=$this->input->post("any_keywords");
		$search_array=explode(',',trim($any_keywords));			
		if(is_array($search_array) && count($search_array)>0 && $any_keywords!='')
		{
			$search_criteria='';
			foreach($search_array as $key => $val)
			{
				if(substr($val,0,1)=='"' && substr(strrev($val),0,1)=='"')
				{
					$val=substr($val,1,strlen($val)-2);
					
					if($search_criteria!='')
						$search_criteria.=" or search_keywords like '%".trim($val)."%'";
					else
						$search_criteria.=" search_keywords like '%".trim($val)."%'";
				}

				//exit();
				$words_array=explode(' ',trim($val));	
				foreach($words_array as $word_key => $word_val)
				{
					if($search_criteria!='')
						$search_criteria.=" or search_keywords like '%".trim($word_val)."%'";
					else
						$search_criteria.=" search_keywords like '%".trim($word_val)."%'";
				}
			}

			if($where!='')
				$where.=" and a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
			else
				$where.=" a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
		}

		// any keywords - AND operation		
		$all_keywords=$this->input->post("all_keywords");	
		$search_array=explode(',',trim($all_keywords));		
		if(is_array($search_array) && count($search_array)>0 && $all_keywords!='')
		{
			$search_criteria='';
			foreach($search_array as $key => $val)
			{
				if($search_criteria!='')
					$search_criteria.=" and search_keywords like '%".$val."%'";
				else
					$search_criteria.=" search_keywords like '%".$val."%'";
			}
			
			if($where!='')
				$where.=" and a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
			else
				$where.=" a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
		}
		
		//job category				
		if($this->input->post('job_cat_id')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_job_profile where job_cat_id=' .$this->input->post('job_cat_id').') ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_job_profile where job_cat_id=' .$this->input->post('job_cat_id').') ';
			}
		}

		//functional area				
		if($this->input->post('func_id')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_job_profile where func_id=' .$this->input->post('func_id').') ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_job_profile where func_id=' .$this->input->post('func_id').') ';
			}
		}
		
		// skills		
		if($this->input->post('skills')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_to_skills_primary where skill_id in ('.$this->input->post('skills').')) ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_to_skills_primary where skill_id in ('.$this->input->post('skills').')) ';
			}
		}
		
		//certifications
		if($this->input->post('cert')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_to_certification where cert_id in ('.$this->input->post('cert').')) ';				
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_to_certification where cert_id in ('.$this->input->post('cert').')) ';				
			}
		}
		
		//level				
		if($this->input->post('desig_id')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_education where desig_id=' .$this->input->post('desig_id').') ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_education where desig_id=' .$this->input->post('desig_id').') ';
			}
		}

		//course				
		if($this->input->post('course_id')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_education where course_id=' .$this->input->post('course_id').') ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_education where course_id=' .$this->input->post('course_id').') ';
			}
		}

		//contracts				
		if($this->input->post('contract_start_date')!='' && $this->input->post('contract_end_date')!='')
		{
			if($where!='')
			{
				$where.=" and a.candidate_id in (select candidate_id from pms_candidate_contract where start_date >='" .$this->input->post('contract_start_date')."' and end_date <='".$this->input->post('contract_end_date')."')";
				
			}else
			{
				$where.=" a.candidate_id in (select candidate_id from pms_candidate_contract where start_date >='" .$this->input->post('contract_start_date')."' and end_date <='".$this->input->post('contract_end_date')."')";
			}
		}	
		
		if($where!='') $sql.=$where;		
	//echo $sql;exit();
		$query = $this->db->query($sql);

		$row=$query->row_array();
		return $row['total_rec'];
	}

	function get_filter_records($id,$start,$limit)
	{
		$records=array();

		$sql='select DISTINCT a.candidate_id,a.first_name,a.last_name,a.username, a.cv_file,a.exp_years,a.linkedin_url,a.gender,b.total_experience,b.notice_period,b.expected_ctc,b.current_ctc,b.gcc_experience,b.ctc_updated_on,(select DISTINCT candidate_id from pms_job_apps_emails where candidate_id=a.candidate_id and client_shift_id='.$id.')as emailed from  pms_candidate a left join pms_candidate_job_search b on a.candidate_id=b.candidate_id ';
		
		$where=' where a.candidate_id not in(select candidate_id from pms_job_apps where client_shift_id='.$id.') ';

		if($this->input->post('exp_years_min')!='')
		{
			if($where!='')
			{
				$where.=' and b.total_experience >='.$this->input->post('exp_years_min');
			}else
			{
				$where.=' b.total_experience >='.$this->input->post('exp_years_min');
			}
		}

		if($this->input->post('exp_years_max')!='')
		{
			if($where!='')
			{
				$where.=' and b.total_experience <='.$this->input->post('exp_years_max');
			}else
			{
				$where.=' b.total_experience <='.$this->input->post('exp_years_max');
			}
		}

		if($this->input->post('notice_min')!='')
		{
			if($where!='')
			{
				$where.=' and b.notice_period >='.$this->input->post('notice_min');
			}else
			{
				$where.=' b.notice_period >='.$this->input->post('notice_min');
			}
		}

		if($this->input->post('notice_max')!='')
		{
			if($where!='')
			{
				$where.=' and b.notice_period <='.$this->input->post('notice_max');
			}else
			{
				$where.=' b.notice_period <='.$this->input->post('notice_max');
			}
		}
		
		if($this->input->post('ctc_min')!='')
		{
			if($where!='')
			{
				$where.=' and b.current_ctc >='.$this->input->post('ctc_min');
			}else
			{
				$where.=' b.current_ctc >='.$this->input->post('ctc_min');
			}
		}

		if($this->input->post('ctc_max')!='')
		{
			if($where!='')
			{
				$where.=' and b.current_ctc <='.$this->input->post('ctc_max');
			}else
			{
				$where.=' b.current_ctc <='.$this->input->post('ctc_max');
			}
		}
				
		// any keywords - OR operation		
		$any_keywords=$this->input->post("any_keywords");
		$search_array=explode(',',trim($any_keywords));			
		if(is_array($search_array) && count($search_array)>0 && $any_keywords!='')
		{
			$search_criteria='';
			foreach($search_array as $key => $val)
			{
				if(substr($val,0,1)=='"' && substr(strrev($val),0,1)=='"')
				{
					$val=substr($val,1,strlen($val)-2);
					
					if($search_criteria!='')
						$search_criteria.=" or search_keywords like '%".trim($val)."%'";
					else
						$search_criteria.=" search_keywords like '%".trim($val)."%'";
				}

				//exit();
				$words_array=explode(' ',trim($val));	
				foreach($words_array as $word_key => $word_val)
				{
					if($search_criteria!='')
						$search_criteria.=" or search_keywords like '%".trim($word_val)."%'";
					else
						$search_criteria.=" search_keywords like '%".trim($word_val)."%'";
				}
			}

			if($where!='')
				$where.=" and a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
			else
				$where.=" a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
		}

		// any keywords - AND operation		
		$all_keywords=$this->input->post("all_keywords");	
		$search_array=explode(',',trim($all_keywords));		
		if(is_array($search_array) && count($search_array)>0 && $all_keywords!='')
		{
			$search_criteria='';
			foreach($search_array as $key => $val)
			{
				if($search_criteria!='')
					$search_criteria.=" and search_keywords like '%".$val."%'";
				else
					$search_criteria.=" search_keywords like '%".$val."%'";
			}
			
			if($where!='')
				$where.=" and a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
			else
				$where.=" a.candidate_id in (select candidate_id from pms_candidate_files where ".$search_criteria.") ";
		}
		
		//job category				
		if($this->input->post('job_cat_id')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_job_profile where job_cat_id=' .$this->input->post('job_cat_id').') ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_job_profile where job_cat_id=' .$this->input->post('job_cat_id').') ';
			}
		}

		//functional area				
		if($this->input->post('func_id')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_job_profile where func_id=' .$this->input->post('func_id').') ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_job_profile where func_id=' .$this->input->post('func_id').') ';
			}
		}
	
		// skills
		if($this->input->post('skills')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_to_skills_primary where skill_id in ('.$this->input->post('skills').')) ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_to_skills_primary where skill_id in ('.$this->input->post('skills').')) ';
			}
		}
		
		//certifications
		if($this->input->post('cert')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_to_certification where cert_id in ('.$this->input->post('cert').')) ';				
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_to_certification where cert_id in ('.$this->input->post('cert').')) ';				
			}
		}
		
		//level				
		if($this->input->post('desig_id')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_education where desig_id=' .$this->input->post('desig_id').') ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_education where desig_id=' .$this->input->post('desig_id').') ';
			}
		}

		//course				
		if($this->input->post('course_id')!='')
		{
			if($where!='')
			{
				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_education where course_id=' .$this->input->post('course_id').') ';
			}else
			{
				$where.=' a.candidate_id in (select candidate_id from pms_candidate_education where course_id=' .$this->input->post('course_id').') ';
			}
		}

		//contracts				
		if($this->input->post('contract_start_date')!='' && $this->input->post('contract_end_date')!='')
		{
			if($where!='')
			{
				$where.=" and a.candidate_id in (select candidate_id from pms_candidate_contract where start_date >='" .$this->input->post('contract_start_date')."' and end_date <='".$this->input->post('contract_end_date')."')";
				
			}else
			{
				$where.=" a.candidate_id in (select candidate_id from pms_candidate_contract where start_date >='" .$this->input->post('contract_start_date')."' and end_date <='".$this->input->post('contract_end_date')."')";
			}
		}		
		
		if($where!='') $sql.=$where;
		$sql.=" order by a.first_name limit ".$start.",".$limit; 
		$query=$this->db->query($sql);	
		//		echo $sql;
//		exit();
		$records=$query->result_array();	
		return $records;		
	}
		
	function get_filter_count_email($id)
	{
		$sql='select count(*) as total_rec from  pms_job_apps_emails where client_shift_id='.$id;
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['total_rec'];
	}
	
	function get_filter_records_email($id,$start,$limit)
	{
		$records=array();
		
		$sql='select * from pms_job_apps_emails a where client_shift_id='.$id;

		$sql.=" order by a.candidate_name limit ".$start.",".$limit; 
		$query=$this->db->query($sql);	
		$records=$query->result_array();	

		return $records;		
	}
		
	function add_to_job()
	{
		
			$query = $this->db->query('SELECT * from pms_job_apps where client_shift_id='.$this->input->get('client_shift_id').' and candidate_id='.$this->input->get('candidate_id'));
			if($query->num_rows()==0)
			{
				$data=array(
						'client_shift_id'=> $this->input->get('client_shift_id') ,
						'candidate_id' =>  $this->input->get('candidate_id'),
						'applied_on' => date('Y-m-d') ,
						'cover_letter'=> '' ,
						'app_status_id'=> 1
						);
			$this->db->insert('pms_job_apps', $data);
			}
			
	}

	function add_candidate_to_shift($client_shift_id,$candidate_id)
	{
		$data=array(
				'candidate_id' =>  $candidate_id,
				'shift_status_id' => '2',
				);
				
				
		$this->db->where('client_shift_id', $client_shift_id);
		$this->db->update('pms_client_shifts', $data);
		return 0;
	}

	function add_candidate_to_shift_re_assign($client_shift_id,$candidate_id)
	{
		
		$data=array(
				'candidate_id' =>  $candidate_id,
				'shift_status_id' => '4',
				);
							
		$this->db->where('client_shift_id', $client_shift_id);
		$this->db->update('pms_client_shifts', $data);
		return 0;
	}
	
	function add_vendor_to_job($client_shift_id,$vendor_id)
	{
		$data=array(
				'client_shift_id'=> $client_shift_id,
				'vendor_id' =>  $vendor_id,
				);
		$this->db->insert('pms_jobs_to_vendors', $data);
	}
			
	function delete_application($candidate_id,$client_shift_id)
	{
		$query = $this->db->query('delete from pms_job_apps where client_shift_id='.$client_shift_id.' and candidate_id='.$candidate_id);
		return 0;
	}

	function delete_candidate_invoice($placement_id,$invoice_id)
	{
		$query = $this->db->query('delete from pms_job_apps_invoice where invoice_id='.$invoice_id.' and placement_id='.$placement_id);
		return 0;
	}

	function add_calls()
	{
		$call_date=$this->input->post('call_date');
		if($call_date=='')$call_date=date('Y-m-d');

		$data=array(		
		'app_id'=> $this->input->post('job_app_id'),
		'candidate_id' => $this->input->post('candidate_id') ,
		'cur_job_status'=> $this->input->post('cur_job_status'),
		'call_date' => $call_date,
		'call_time' => $this->input->post('call_time'),
		'call_notes'=> $this->input->post('call_notes') ,
		'admin_id'=> $_SESSION['vendor_session'],
		);
		$id=$this->db->insert('pms_job_apps_calls', $data);
		
		if($this->input->post('cur_ctc')!='' || $this->input->post('exp_ctc')!='' || $this->input->post('exp_years')!='' || $this->input->post('notice_period')!='')
		{
			$data=array(		
			'current_ctc'=> $this->input->post('cur_ctc'),
			'expected_ctc' => $this->input->post('exp_ctc'),
			'total_experience'=> $this->input->post('exp_years'),
			'notice_period' => $this->input->post('notice_period'),
			);
			$this->db->where('candidate_id', $this->input->post('candidate_id'));
			$this->db->where('job_app_id', $this->input->post('job_app_id'));
			$this->db->update('pms_job_apps', $data);
		}
		
		return $id;
	}
	
	function add_feedback()
	{
		$feedback_date=$this->input->post('feedback_date');
		if($feedback_date=='')$call_date=date('Y-m-d');
		
		if($this->input->post('short_id')!='' || $this->input->post('candidate_id')!='' || $this->input->post('app_id')!='' || $this->input->post('client_feedback')!='')
		{
			$data=array(		
			'client_feedback' => $this->input->post('client_feedback'),
			'feedback_date'=> $feedback_date,
			'client_notes' => $this->input->post('client_notes'),
			);
			$this->db->where('candidate_id', $this->input->post('candidate_id'));
			$this->db->where('app_id', $this->input->post('app_id'));
			$this->db->where('short_id', $this->input->post('short_id'));
			$this->db->update('pms_job_apps_shortlisted', $data);
		}		
		return 0;
	}
	
	function add_ctc()
	{
		if($this->input->post('cur_ctc')!='' || $this->input->post('exp_ctc')!='' || $this->input->post('exp_years')!='' || $this->input->post('notice_period')!='')
		{
			$data=array(		
			'current_ctc'=> $this->input->post('cur_ctc'),
			'expected_ctc' => $this->input->post('exp_ctc'),
			'total_experience'=> $this->input->post('exp_years'),
			'notice_period' => $this->input->post('notice_period'),
			);
			$this->db->where('candidate_id', $this->input->post('candidate_id'));
			$this->db->where('job_app_id', $this->input->post('job_app_id'));
			$this->db->update('pms_job_apps', $data);
		}
		return '';
	}

	function add_notes()
	{
		$note_date=$this->input->post('note_date');
		if($note_date=='')$note_date=date('Y-m-d');

		$data=array(		
		'title'=> $this->input->post('title'),
		'candidate_id' => $this->input->post('candidate_id') ,
		'notes'=> $this->input->post('notes_text'),
		'note_date' => $note_date,
		//'admin_id'=> $_SESSION['vendor_session'],
		);
		$id=$this->db->insert('pms_candidate_notes', $data);
		return $id;
	}

	function add_message()
	{
		$message_date=$this->input->post('message_date');
		if($message_date=='')$message_date=date('Y-m-d');

		$data=array(
		'candidate_id' => $this->input->post('candidate_id') ,
		'message_title'=> '',
		'message_text'=> $this->input->post('message_text'),
		'message_date' => $message_date,
		'message_time'      => time(),
		'message_status'    => 0,	
		'admin_id'=> $_SESSION['vendor_session'],
		);
		$id=$this->db->insert('pms_candidate_messages', $data);
		return $id;
	}
					
	function add_to_shortlist($data,$candidate_id,$job_app_id)
	{
		$this->db->query("delete from pms_job_apps_shortlisted where app_id=".$job_app_id." and candidate_id=".$candidate_id);
		$id=$this->db->insert('pms_job_apps_shortlisted', $data);
		$this->db->query("update pms_job_apps set app_status_id=3 where job_app_id=".$job_app_id." and candidate_id=".$candidate_id);
		return $id;
	}
	
	function add_consultant_feedback($data,$candidate_id)
	{
		$query = $this->db->query('SELECT * from pms_candidate_job_search where candidate_id='.$candidate_id);
		if($query->num_rows()>0)
		{
			$this->db->where('candidate_id', $candidate_id);
			$this->db->update('pms_candidate_job_search', $data);
		}else
		{
			$this->db->insert('pms_candidate_job_search', $data);				
		}
		return 1;
	}

	function get_consultant_feedback($candidate_id)
	{
		$query = $this->db->query('SELECT * from pms_candidate_job_search where candidate_id='.$candidate_id);
		if($query->num_rows()>0)
		{
			$records=$query->row_array();
			return $records;
		}else
		{
			$records=array(
				'candidate_id'          => $candidate_id,
				'feedback_education'    => '',
				'feedback_industry'     => '',
				'feedback_skills'       => '',
				'feedback_salary'       => '',
				'feedback_general'      => '',
			);
			return $records;	
		}
	}
			
	function add_interview($data,$candidate_id,$job_app_id)
	{
		$this->db->query("delete from pms_job_apps_interviews where job_app_id=".$job_app_id." and candidate_id=".$candidate_id);
		$this->db->insert('pms_job_apps_interviews', $data);
		$this->db->query("update pms_job_apps set app_status_id=4 where job_app_id=".$job_app_id." and candidate_id=".$candidate_id);
		return;		
	}

	function add_interview_history($data,$candidate_id,$job_app_id)
	{
		$this->db->insert('pms_job_apps_interviews_history', $data);
		return;		
	}
		
	function reject_interview($data)
	{ 
		$id=$this->db->insert('pms_job_apps_interviews_rejection', $data);

		$this->db->query("update pms_job_apps_interviews set rejected_by=".$_SESSION['vendor_session']." where interview_id=".$data['candidate_id']);
		//echo $this->db->last_query();
		return $id;
	}
		
	function send_jd($data)
	{
		$this->db->query("delete from pms_job_apps_emails where candidate_id=".$data['candidate_id']." and client_shift_id=".$data['client_shift_id']." and email_status=1");
		$this->db->insert('pms_job_apps_emails', $data);
		$id=$this->db->insert_id();
		return $id;
	}

	function send_jd_email($data)
	{
		$this->db->query("delete from pms_job_apps_emails where client_shift_id=".$data['client_shift_id']." and email='".$data['email']."' and email_status=1");
		$this->db->insert('pms_job_apps_emails', $data);
		$id=$this->db->insert_id();
		return $id;
	}

	function get_email_jd($email_id)
	{
		$row=array();
		$query = $this->db->query("select * from  pms_job_apps_emails where email_id=".$email_id);
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();			
		}
		return $row;
	}

	function select_candidate()
	{
		$data=array(
		'app_id'          => $this->input->post('app_id'),
		'candidate_id'    => $this->input->post('candidate_id') ,
		'feedback'        => $this->input->post('feedback') ,
		'admin_id'=> $_SESSION['vendor_session'],
		'select_date'     => date('Y-m-d'),
		);
		$this->db->query("delete from pms_job_apps_selected where app_id=".$this->input->post('app_id')." and candidate_id=".$this->input->post('candidate_id'));
		$id=$this->db->insert('pms_job_apps_selected', $data);
		
		$data1=array(
		'int_status'          => 1,
		);
		
		$this->db->where('candidate_id', $this->input->post('candidate_id'));
		$this->db->where('job_app_id', $this->input->post('app_id'));
	   	$this->db->update('pms_job_apps_interviews', $data1);
		
		return $id;
	}

//REJECT OFFER
	function reject_offer()
	{ 
		$data=array(
		'app_id'          => $this->input->post('app_id'),
		'admin_id'                => $_SESSION['vendor_session'],
		'candidate_id'    => $this->input->post('candidate_id') ,
		'reason'      => $this->input->post('reason'),
		'offer_status'	=> 3,
		);
		
		$this->db->where('app_id', $this->input->post('app_id'));
	   	$this->db->update('pms_job_apps_offerletter', $data);
		//echo $this->db->last_query();
		
	}

	function get_single_candiadte($candidateId){
	
		$query=$this->db->query("select * from pms_candidate where candidate_id=".$candidateId);
		return $query->row_array();
	}
		
	function issue_offer()
	{ 
		$data=array(
		'app_id'          => $this->input->post('app_id'),
		'candidate_id'    => $this->input->post('candidate_id') ,
		'offer_date'      => $this->input->post('offer_date'),
		'salary_offered'      => $this->input->post('salary_offered'),
		'title'      => $this->input->post('title'),
		'offer_status'	=> 1,
		'offer_letter'    => 'Offer letter issued.',
		'admin_id'=> $_SESSION['vendor_session'],
		'negotiation'                  => $this->input->post('negotiation'),
		);
		
		$this->db->query("delete from pms_job_apps_offerletter where app_id=".$this->input->post('app_id')." and candidate_id=".$this->input->post('candidate_id'));
		$id=$this->db->insert('pms_job_apps_offerletter', $data);
		//echo $this->db->last_query();
		return $id;
	}

//CERT ATTESTATTION
	function cert_attest()
	{ 
		$data=array(
		'app_id'       => $this->input->post('app_id'),
		
		'title'     => $this->input->post('title'),
		'status'     => $this->input->post('status'),
		'candidate_id'     => $this->input->post('candidate_id'),
		);
		$this->db->query("delete from pms_job_apps_cert where app_id=".$this->input->post('app_id'));
		$this->db->insert('pms_job_apps_cert', $data);
		
		return 0;
	}
	
	function accept_offer()
	{
		$data=array(
		'app_id'                  => $this->input->post('app_id'),
		'admin_id'                => $_SESSION['vendor_session'],
		'offer_issued_date'       => date("Y-m-d",strtotime($this->input->post('offer_issued_date'))),
		'offer_accepted_date'     => date("Y-m-d",strtotime($this->input->post('offer_accepted_date'))),
		'join_date'               => date("Y-m-d",strtotime($this->input->post('join_date'))),
		'monthly_salary_offered'  => $this->input->post('monthly_salary_offered'),
		'total_ctc'               => $this->input->post('total_ctc'),
		'min_contract_months'     => $this->input->post('min_contract_months'),
		);
		
		$this->db->query("delete from pms_job_apps_placement where app_id=".$this->input->post('app_id'));
		$this->db->insert('pms_job_apps_placement', $data);
		
		$data	=	array();
		$data=array(
			'offer_status'       => 2,
		);
		$this->db->where('app_id', $this->input->post('app_id'));
	   	$this->db->update('pms_job_apps_offerletter', $data);
		return 0;
	}

	function create_invoice()
	{
		$data=array(
		'placement_id'       => $this->input->post('placement_id'),
		'invoice_date'       => date("Y-m-d",strtotime($this->input->post('invoice_date'))),
		'invoice_start_date' => date("Y-m-d",strtotime($this->input->post('invoice_start_date'))),
		'invoice_due_date'   => date("Y-m-d",strtotime($this->input->post('invoice_due_date'))),
		'replacement_date'   => date("Y-m-d",strtotime($this->input->post('replacement_date'))),
		'invoice_amount'     => $this->input->post('invoice_amount'),
		'invoice_status'     => $this->input->post('invoice_status'),
		'client_candidate'     => $this->input->post('client_candidate'),
		'admin_id'                => $_SESSION['vendor_session'],
		);
		$this->db->query("delete from pms_job_apps_invoice where placement_id=".$this->input->post('placement_id'));
		$this->db->insert('pms_job_apps_invoice', $data);
		//echo $this->db->last_query();
		return 0;
	}

//create visa
	function create_visa()
	{
		$data=array(
		'app_id'       => $this->input->post('app_id'),
		'date'       => date("Y-m-d",strtotime($this->input->post('date'))),
		'date_issued'       => date("Y-m-d",strtotime($this->input->post('date_issued'))),
		'date_expiry'       => date("Y-m-d",strtotime($this->input->post('date_expiry'))),
		'passport_verified'       => $this->input->post('passport_verified'),
		'number'     => $this->input->post('number'),
		'description'     => $this->input->post('description'),
		'candidate_id'     => $this->input->post('candidate_id'),
		);
		$this->db->query("delete from pms_job_apps_visa where app_id=".$this->input->post('app_id'));
		$this->db->insert('pms_job_apps_visa', $data);
		//echo $this->db->last_query();
		return 0;
	}

//create visa doc
	function create_doc()
	{
		$data=array(
		'app_id'       => $this->input->post('app_id'),
		'date_send'       => date("Y-m-d"),
		'send_mode'     => $this->input->post('send_mode'),
		'send_by'     => $this->input->post('send_by'),
		'candidate_id'     => $this->input->post('candidate_id'),
		);
		$this->db->query("delete from pms_job_apps_document where app_id=".$this->input->post('app_id'));
		$this->db->insert('pms_job_apps_document', $data);
		
		return 0;
	}

//create medical
	function create_medical()
	{
		$data=array(
		'app_id'       => $this->input->post('app_id'),
		'date'       => date("Y-m-d",strtotime($this->input->post('date'))),
		'title'     => $this->input->post('title'),
		'description'     => $this->input->post('description'),
		'candidate_id'     => $this->input->post('candidate_id'),
		);
		$this->db->query("delete from pms_job_apps_medical where app_id=".$this->input->post('app_id'));
		$this->db->insert('pms_job_apps_medical', $data);
		
		return 0;
	}

//create ticket
	function create_ticket()
	{
		$data=array(
		'app_id'       => $this->input->post('app_id'),
		'date'       => date("Y-m-d",strtotime($this->input->post('date'))),
		
		'number'     => $this->input->post('number'),
		'description'     => $this->input->post('description'),
		'boarding_sector'     => $this->input->post('boarding_sector'),
		'candidate_id'     => $this->input->post('candidate_id'),
		);
		$this->db->query("delete from pms_job_apps_ticket where app_id=".$this->input->post('app_id'));
		$this->db->insert('pms_job_apps_ticket', $data);
		
		return 0;
	}

//create ticket FOLLOWUP
	function create_followup($data)
	{
		
		$this->db->where('app_id', $this->input->post('app_id'));
		$this->db->where('candidate_id', $this->input->post('candidate_id'));
	   	$this->db->update('pms_job_apps_ticket', $data);
		return 0;
	}
	function admin_list()
	{
		$data = array();
		$query=$this->db->query("select admin_id,username from pms_admin_users");
		$dropDownList = array();
		$dropDownList[0]='Select User';

		$admin_list = $query->result();
		
		foreach($admin_list as $dropdown)
		{
			$dropDownList[$dropdown->admin_id] = $dropdown->username;
		}
		
		return $dropDownList;
	}

	function get_staff_list($shift_date,$band_id,$desig_id, $gender, $shift_id)
	{
		
		$query=$this->db->query("select a.candidate_id,a.first_name,b.*,j.shift_name,c.band_name,d.city_name,(select desig_name from pms_designation g inner join pms_candidate_to_designation h on g.desig_id=h.desig_id where h.candidate_id =a.candidate_id limit 0,1)as desig_name,pc.cert_name,datediff(rc.expiry_date,curdate())as total_days,rc.expiry_date from pms_candidate a inner join pms_candidate_available_dates b on a.candidate_id=b.candidate_id inner join pms_shifts j on b.shift_id=j.shift_id left join pms_bands c on a.band_id=c.band_id left join pms_city d on a.city_id=d.city_id left join pms_job_req_certification rc on a.candidate_id=rc.candidate_id left join pms_job_prof_certificates pc on rc.cert_id=pc.cert_id  where b.avail_date='".$shift_date."' and b.shift_id=".$shift_id);
		
		$dropDownList = array();
		$admin_list = $query->result_array();
		return $admin_list;
	}


	function get_assignment_vendor($client_shift_id)
	{
		$query=$this->db->query("select a.vendor_id,a.username, (select client_shift_id from pms_jobs_to_vendors b where b.vendor_id=a.vendor_id and b.client_shift_id=".$client_shift_id.") as client_shift_id from pms_vendors a ");
		$dropDownList = array();
		$admin_list = $query->result();
		
		foreach($admin_list as $dropdown)
		{
			$dropDownList[$dropdown->vendor_id] =array('username' => $dropdown->username, 'client_shift_id' => $dropdown->client_shift_id);
		}		
		return $dropDownList;
	}
					
//delete ticket FOLLOWUP
	function delete_followup($id)
	{
		$data=array(			
		'send_by'                 =>'',
		'send_mode'               => '',
		'travel_followup'         => '',
		'pickup_followup'         =>'',
		'travel_confirmation'     => '',
		);

		$this->db->where('ticket_id',$id);
		
	   	$this->db->update('pms_job_apps_ticket', $data);
		return 0;
	}	

	function cancel_shift($client_shift_id)
	{
		$data=array(			
			'shift_status_id'  =>  '3',
			'candidate_id'  =>  '',
		);

		$this->db->where('client_shift_id',$client_shift_id);		
	   	$this->db->update('pms_client_shifts', $data);
		return 0;
	}

	function skip_shift($client_shift_id)
	{
		$data=array(			
			'shift_status_id'  =>  '5',
			'candidate_id'  =>  '',
		);

		$this->db->where('client_shift_id',$client_shift_id);		
	   	$this->db->update('pms_client_shifts', $data);
		return 0;
	}

	function drop_shift_client($client_shift_id)
	{
		$data=array(			
			'shift_status_id'  =>  '6',
			'candidate_id'  =>  '',
		);

		$this->db->where('client_shift_id',$client_shift_id);		
	   	$this->db->update('pms_client_shifts', $data);
		return 0;
	}

	function re_open_shift($client_shift_id)
	{
		$data=array(			
			'shift_status_id'  =>  '1',
			'candidate_id'  =>  '',
		);

		$this->db->where('client_shift_id',$client_shift_id);		
	   	$this->db->update('pms_client_shifts', $data);
		return 0;
	}
	
	function active_seekers($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.applied_on,b.admin_id,b.rejected_by,b.app_status_id,c.shift_title,d.company_name,e.*,f.*,g.*,h.*,j.* FROM `pms_candidate` a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_client_shifts c on b.client_shift_id=c.client_shift_id inner join pms_company d on c.company_id=d.company_id left join pms_job_apps_interviews e on b.job_app_id=e.job_app_id left join pms_job_apps_shortlisted f on b.job_app_id=f.app_id left join pms_job_apps_selected g on b.job_app_id=g.app_id left join pms_job_apps_offerletter h on b.job_app_id=h.app_id left join pms_candidate_job_search j on j.candidate_id=a.candidate_id where c.client_shift_id='.$client_shift_id.' order by b.applied_on');
	
		$dropdowns = $query->result_array();	

		return $dropdowns;
	}

	function job_location()
    {
		$dropDownList=array();
		$dropDownList['']='Select City';
		
       	$query=$this->db->query("select a.city_id,a.city_name from pms_city a order by a.city_name");
		
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
    }
	
	function job_change_list($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('select a.client_shift_id,a.shift_title,b.company_name from pms_client_shifts a left join pms_company b on a.company_id=b.company_id where a.client_shift_id <> '.$client_shift_id.' order by a.shift_title ');
		
		$dropdowns = $query->result_array();	
		
		return $dropdowns;
	}

	function import_from_other_jobs($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('select DISTINCT a.client_shift_id,a.shift_title,b.company_name,(select count(pms_job_apps.job_app_id) as total_apps from pms_job_apps where client_shift_id=a.client_shift_id)as total_jobs,(select count(pms_job_apps.job_app_id) as total_apps from pms_job_apps where client_shift_id=a.client_shift_id and app_status_id=2)as total_rejected from pms_client_shifts a left join pms_company b on a.company_id=b.company_id where a.client_shift_id <> '.$client_shift_id.' order by a.shift_title ');
		$dropdowns = $query->result_array();		
		return $dropdowns;
	}
		
	function get_candidate_suggestions($client_shift_id)
	{
		if($client_shift_id=='')return;
		
		$query = $this->db->query('SELECT a.*,(select candidate_id from pms_job_apps where candidate_id=a.candidate_id and client_shift_id=1)as applied,b.* FROM `pms_candidate` a left join pms_candidate_job_search b on a.candidate_id=b.candidate_id where a.candidate_id in (select candidate_id from pms_candidate_to_skills where skill_id in (SELECT skill_id from pms_job_to_skill where client_shift_id=1)) order by a.first_name ');

		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

	function get_job_skills($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT b.skill_id FROM `pms_client_shifts` a inner join pms_job_to_skill b on a.client_shift_id=b.client_shift_id inner join pms_candidate_skills c on c.skill_id=b.skill_id where b.client_shift_id=1 ');
		
		$dropdowns = $query->result_array();	

		return $dropdowns;
	}
		
	function rejected_candidates($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('select a.*,b.job_app_id,b.rejected_on,b.reason_for_reject,c.firstname from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id left join pms_admin_users c on b.rejected_by=c.admin_id where b.client_shift_id='.$client_shift_id.'  and app_status_id=2 order by b.applied_on desc');
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
	
	function applied_candidates($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('select a.*,b.job_app_id from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id where b.client_shift_id='.$client_shift_id.' and b.candidate_id not in (select pms_job_apps_shortlisted.candidate_id from pms_job_apps_shortlisted inner join pms_job_apps on pms_job_apps_shortlisted.app_id=pms_job_apps.job_app_id where pms_job_apps.client_shift_id='.$client_shift_id.') order by b.applied_on desc');
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

    function get_company_info($company_id)
	{
		if($company_id < 1) return '';
		
		$query = $this->db->query("select * from pms_company where company_id=".$company_id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row;
			}else
			{
				return array();
			}
	}

    function get_user_info($admin_id)
	{
		if($admin_id < 1) return '';
		
		$query = $this->db->query("select * from pms_admin_users where admin_id=".$admin_id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row;
			}else
			{
				return array();
			}
	}

	function get_extras($id)
	{
			if($id!='')
			{
				$query = $this->db->query("SELECT a.city_id, b.state_id,c.country_id FROM `pms_city` a inner join pms_state b on a.state_id=b.state_id inner join pms_country c on b.country_id=b.country_id inner join pms_company d on a.city_id=d.city_id where d.company_id=".$id);
				
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
				
	function get_shortlisted_client($client_shift_id,$short_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query("select a.*,b.job_app_id,c.short_id,c.app_id,c.short_date,d.client_shift_id,d.shift_title,e.total_experience,e.current_ctc,e.expected_ctc,e.notice_period,f.country_name as nationality from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_job_apps_shortlisted c on b.job_app_id=c.app_id inner join pms_client_shifts d on b.client_shift_id=d.client_shift_id left join pms_candidate_job_search e on a.candidate_id=e.candidate_id left join pms_country f on a.nationality=f.country_id where b.client_shift_id=".$client_shift_id." and c.short_id in (".$short_id.")");
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

	function state_list_by_city($country_id='')
    {
		if($country_id !='')
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_city b ON a.state_id=b.state_id where a.country_id=".$country_id." order by a.state_name");
		else
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_city b ON a.state_id=b.state_id order by a.state_name");
					
		$state_ist = $query->result();
		
		
		$dropDownList['']='Select State';
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->state_id] = $dropdown->state_name;
		}
		
		return $dropDownList;
    }	

	function city_list_by_state($state_id='')
    {
		$dropDownList=array();
		$dropDownList['0']='Select City';
		
		if($state_id=='')
			return $dropDownList;
		else
	       	$query=$this->db->query("SELECT a . * , b . * FROM pms_city a INNER JOIN pms_city_description b ON a.city_id= b.city_id where a.state_id=".$state_id." order by b.city_name");	
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->city_id] = $dropdown->city_name;
		}
		return $dropDownList;
    }
		
	function country_list()
	{
		$query = $this->db->query("select distinct a.country_id, concat(a.country_name,' [+ ',intl_dial_prefix,' ',intl_code,']')as country_name from pms_country a inner join pms_state b on a.country_id=b.country_id order by country_name asc");
		$dropdowns = $query->result();
		
		$dropDownList[0]='Select Country';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
		
	function update_shortlisted_status($client_shift_id,$short_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query("update pms_job_apps_shortlisted set client_feedback_status=1 where short_id in (".$short_id.")");
		$query = $this->db->query("update pms_job_apps_shortlisted set total_submission=total_submission+1 where short_id in (".$short_id.")");
		return;
	}
		
	function shortlist($data,$client_shift_id,$app_id)
	{
		foreach ($data as $key => $val)
 		{
			$query = $this->db->query('delete from pms_job_apps_shortlisted where app_id='.$app_id[$key].' and candidate_id='.$val);
			$data_short=array(
					'app_id'=> $app_id[$key],
					'candidate_id' =>  $val,
					'short_date' => date('Y-m-d') ,
					'admin_id'=> $_SESSION['vendor_session']
					);
			$this->db->insert('pms_job_apps_shortlisted', $data_short);
		}		
	}

	function manage_rejection($job_app_id)
	{
		$data_reject=array(
				'job_app_id'=> $this->input->post('job_app_id'),
				'rejected_on' => $this->input->post('rejected_on'),
				'reason_for_reject' =>  $this->input->post('reason_for_reject'),
				'app_status_id' => 2,
				'rejected_by'=> $_SESSION['vendor_session']
				);

		$this->db->where('job_app_id', $this->input->post('job_app_id'));
	   	$this->db->update('pms_job_apps', $data_reject);
	}

	function get_shortlisted($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('select a.*,b.*,c.*,d.current_ctc,d.expected_ctc,d.notice_period,d.total_experience from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_job_apps_shortlisted c on b.job_app_id=c.app_id left join pms_candidate_job_search d on a.candidate_id=d.candidate_id where b.client_shift_id='.$client_shift_id.' order by a.first_name');
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}			
		
	function get_interview_list($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.applied_on,c.first_name,c.last_name,d.interview_type,(select count(interview_id) from pms_job_apps_interviews_rejection e where interview_id=a.interview_id)as total_rejection,(select count(app_id) from pms_job_apps_selected f where f.app_id=a.job_app_id)as selected FROM `pms_job_apps_interviews` a inner join pms_job_apps b on a.job_app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id left join pms_candidate_interview_types d on d.interview_type_id=a.interview_type_id where a.int_status !=2 AND b.client_shift_id='.$client_shift_id.' order by c.first_name');
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

	function get_interview_history($client_shift_id)
	{
		if($client_shift_id=='')return;
		// interview history
		$query = $this->db->query('SELECT a.*,b.applied_on,c.first_name,c.last_name,d.interview_type,(select count(interview_id) from pms_job_apps_interviews_rejection e where interview_id=a.interview_id)as total_rejection,(select count(app_id) from pms_job_apps_selected f where f.app_id=a.job_app_id)as selected FROM `pms_job_apps_interviews_history` a inner join pms_job_apps b on a.job_app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id left join pms_candidate_interview_types d on d.interview_type_id=a.interview_type_id where a.int_status !=2 AND b.client_shift_id='.$client_shift_id.' order by c.first_name');
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
	
	function get_interview_rejection_list($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.applied_on,c.first_name,c.last_name,d.interview_type,e.* FROM `pms_job_apps_interviews` a left join pms_job_apps b on a.job_app_id=b.job_app_id left join pms_candidate c on a.candidate_id=c.candidate_id left join pms_candidate_interview_types d on d.interview_type_id=a.interview_type_id inner join pms_job_apps_interviews_rejection e on e.interview_id=a.interview_id  where e.reject_reason_id > 0 and b.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
		
//Candidates Schedule for Another job with same skills
	function interview_schedule($client_shift_id)
	{ 
		if($client_shift_id=='')return;

		
		$query = $this->db->query('SELECT d.*,a.first_name,a.last_name,e.interview_type FROM  pms_job_apps b  inner join pms_job_to_skill c on b.client_shift_id=c.client_shift_id inner join pms_job_apps_interviews d on d.job_app_id=b.job_app_id inner join pms_candidate a on b.candidate_id=a.candidate_id left join pms_candidate_interview_types e on e.interview_type_id=d.interview_type_id where b.client_shift_id !='.$client_shift_id.' and c.skill_id in (select skill_id from pms_job_to_skill where client_shift_id='.$client_shift_id.') and d.int_status!=1  group by b.job_app_id order by d.int_status asc');
				
		
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
	
	function candidates_selected($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,c.first_name,c.last_name,(select count(app_id)as offered from pms_job_apps_offerletter d where d.app_id=a.app_id)as offered FROM `pms_job_apps_selected` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id where b.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	

		return $dropdowns;
	}

	function offer_letters_issued($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.*,c.first_name,c.last_name FROM `pms_job_apps_offerletter` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id where b.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

	function offer_accepted($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.*,c.first_name,c.last_name FROM `pms_job_apps_placement` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on b.candidate_id=c.candidate_id where b.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

	function invoice_generated($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.*,d.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_placement c on a.job_app_id=c.app_id inner join pms_job_apps_invoice d on c.placement_id=d.placement_id where a.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}	

//contracts ending between (jobstart date -30 days) and (job end date +30 days)
	function contracts_ending($client_shift_id,$start_date,$end_date)
	{
/*		$query = $this->db->query('SELECT job_post_date,job_expiry_date from pms_client_shifts where client_shift_id='.$client_shift_id);
		$result=$query->row();
		$start_date= date('Y-m-d', strtotime($result->job_post_date .'- 30 days'));
		$end_date= date('Y-m-d', strtotime($result->job_expiry_date .'+ 30 days'));*/
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,b.linkedin_url,b.cv_file FROM pms_candidate_contract a inner join pms_candidate b on a.candidate_id=b.candidate_id where  a.end_date between "'.$start_date.'" and "'.$end_date.'"');
		
		return $query->result_array();
	}
	
//GET CERT ATTEST
	function get_cert_attest($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_cert c on a.job_app_id=c.app_id  where a.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
	
//VISA DETAILS DELETE
	function visa_details($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_visa c on a.job_app_id=c.app_id  where a.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
	
//VISA DOCUMENT
	function visa_documents($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_document c on a.job_app_id=c.app_id  where a.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
//MEDICAL DETAILS DELETE
	function medical_details($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_medical c on a.job_app_id=c.app_id  where a.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

//TICKET DETAILS DELETE
	function ticket_details($client_shift_id)
	{
		if($client_shift_id=='')return;
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.*,d.placement_id FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_ticket c on a.job_app_id=c.app_id inner join `pms_job_apps_placement` d  on d.app_id=a.job_app_id  where a.client_shift_id='.$client_shift_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}

//TICKET FOLLUW UP DETAILS 
	function ticket_followup($client_shift_id)
	{
		if($client_shift_id=='')return;
		
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.*,d.placement_id FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_ticket c on a.job_app_id=c.app_id inner join `pms_job_apps_placement` d  on d.app_id=a.job_app_id  where a.client_shift_id='.$client_shift_id.' and ( c.travel_document !="" or c.send_by !=0 or c.send_mode !=0 or c.travel_followup !="" or c.pickup_followup !="" or c.travel_confirmation !=0 ) ');
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}
	
	function fill_company()
	{
		$query = $this->db->query('select distinct company_id, company_name from pms_company order by company_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_bands()
	{
		$query = $this->db->query('select distinct band_id, band_name from pms_bands order by band_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Band';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->band_id] = $dropdown->band_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
		
	function company_has_jobs($shift_status_id)
	{
		$query = $this->db->query('select distinct a.company_id, a.company_name from pms_company a inner join pms_client_shifts b on a.company_id=b.company_id order by a.company_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Company';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function fill_jobcategory()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Job Category';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
//Job INDUSTRIES DROPDOWN LIST
	function fill_jobindustry()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Job Industry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	function fill_shift_name()
	{
		$query = $this->db->query('select distinct shift_id, shift_name from pms_shifts order by shift_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Shift';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->shift_id] = $dropdown->shift_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_functional()
	{
		$query = $this->db->query('select distinct func_id, func_area from pms_job_functional_area order by func_area asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Functional Area';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->func_id] = $dropdown->func_area;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_roles()
	{
		$query = $this->db->query('select distinct desig_id, desig_name from pms_designation order by desig_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Role';
		
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->desig_id] = $dropdown->desig_name;
		}
			
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_shift_status()
	{
		$query = $this->db->query('select distinct shift_status_id, shift_status_name from pms_shift_status order by shift_status_id asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Shift Status';
		
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->shift_status_id] = $dropdown->shift_status_name;
		}
			
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_salary()
	{
		$query = $this->db->query('select distinct salary_id, salary_desc from pms_job_salary order by salary_amount asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Salary';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->salary_id] = $dropdown->salary_desc;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function fill_experience()
	{
		$query = $this->db->query('select distinct exp_id, exp_range from pms_job_experience order by exp_id asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Experience';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->exp_id] = $dropdown->exp_range;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function delete_records($delete_rec=array())	
	{
		if(is_array($delete_rec))
		{
			 foreach ($delete_rec as $key => $val)
 				{
					$this->db->where('client_shift_id', $val);
					$this->db->delete('pms_client_shifts'); 
				}
			return true;
		}else
		{
			return false;
		}
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('client_shift_id',$id);
			$this->db->delete($this->table_name);
			//echo $this->db->last_query();
		}
		
    }
	
	function get_skills()
   {
	  $query=$this->db->query("select skill_id,skill_name from pms_candidate_skills order by skill_name asc");
	   return $query->result_array();
	}
	
	function get_parent_skills()
   {
	  $query=$this->db->query("select skill_id,skill_name from pms_candidate_skills where parent_skill=0 order by skill_name asc");
	   return $query->result_array();
	}
	
   function get_child_skills($id)
   {
	  $query=$this->db->query("select * from pms_candidate_skills where parent_skill=".$id." order by skill_name asc");
	  return $query->result_array();
	}
	
	function get_cert()
   {
	  $query=$this->db->query("select cert_id,cert_name from pms_candidate_certification order by cert_name asc");
	  return $query->result_array();
	 
	}
	function get_certification_details($id)
	{
		$query=$this->db->query('select * from pms_job_to_certification where client_shift_id='.$id);
		 return $query->result_array();
	}
	
	function get_skill_details($id)
	{
		$query=$this->db->query('select * from pms_job_to_skill where client_shift_id='.$id);
		 return $query->result_array();
	}
	function get_domain()
   {
	  $query=$this->db->query("select domain_id,domain_name from pms_candidate_domain order by domain_name asc ");
	  return $query->result_array();
	 
	}
	
	function get_domain_details($id)
	{
		$query=$this->db->query('select * from pms_job_to_domain where client_shift_id='.$id);
		 return $query->result_array();
	}
	// geting  function by category
	function function_list_by_category($category_id='')
    {
		$dropDownList=array();
		$dropDownList['']='Select Function';	
		
		if($category_id!='')
		{		
		 	$query=$this->db->query("select * from pms_job_functional_area  where job_cat_id=".$category_id." order by func_area asc");
		}
		else
		{
            $query=$this->db->query("select * from pms_job_functional_area order by func_area asc");
		}
		
		$function_list = $query->result();
		
		foreach($function_list as $dropdown)
		{
			$dropDownList[$dropdown->func_id] = $dropdown->func_area;
		}

		return $dropDownList;
    }	

}
?>