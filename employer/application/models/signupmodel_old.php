<?php 
class Signupmodel extends CI_Model {

	function __construct()
    {
		$this->table_name='pms_jobs';
    }
    
    function get_all_jobs($start,$limit,$sort_by,$search_text,$salary_id,$skill_id,$job_type_id,$level_id,$func_id,$job_cat_id,$city_id)
    {
		 $sql="select a.*, c.company_name, d.func_area, b.job_cat_name , e.level_name, f.work_level, g.country_name, h.salary_desc, j.job_type_name from pms_jobs a left join pms_job_category b on  a.job_cat_id= b.job_cat_id left join pms_company c on a.company_id=c.company_id left join pms_job_functional_area d on  d.func_id=a.func_id left join pms_education_level e on a.level_id=e.level_id left join pms_job_work_level f on a.work_level_id=f.work_level_id left join pms_country g on  a.country_id=g.country_id left join pms_job_salary h on  a.salary_id=h.salary_id left join pms_job_type j on a.job_type_id=j.job_type_id ";
	
		$cond = " a.job_status=1 ";	

	if($search_text!='')
		{
			if($cond!='')
			{
				$cond.=" and concat(job_title,job_desc,desired_profile,job_keywords) like '%".$search_text."%'";
			} 
			else{
				$cond.=" concat(job_title,job_desc,desired_profile,job_keywords) like '%".$search_text."%'";
			}  
		} 

		if($job_cat_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_cat_id=" . $job_cat_id;
			} 
			else{
				$cond=" a.job_cat_id=".$job_cat_id;
			}  
		} 

		if($func_id!='')
		{
			if($cond!=''){
				$cond.=" and a.func_id=" . $func_id;
			} 
			else{
				$cond=" a.func_id=".$func_id;
			}  
		} 

		if($level_id !='')
		{
			if($cond!=''){
				$cond.=" and a.level_id=" . $level_id;
			} 
			else{
				$cond=" a.level_id=".$level_id;
			}  
		}
				
		if($job_type_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_type_id=" . $job_type_id;
			} 
			else{
				$cond=" a.job_type_id=".$job_type_id;
			}  
		}
	
		if($salary_id!='')
		{
			if($cond!=''){
				$cond.=" and a.salary_id=" . $salary_id;
			} 
			else{
				$cond=" a.salary_id=".$salary_id;
			}  
		}

		if($salary_id!='')
		{
			if($cond!=''){
				$cond.=" and a.salary_id=" . $salary_id;
			} 
			else{
				$cond=" a.salary_id=".$salary_id;
			}  
		}

		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		$sql.=" order by a.job_id ".$sort_by." limit ".$start.",".$limit;
		  
		$res=$this->db->query($sql);
		
			if($res->num_rows()>0)
			{
				foreach($res->result_array() as $row)
				{
					$row['skill_list'][]=$this->get_all_skills($row['job_id']);
					$row['domains_list'][]=$this->get_all_domains($row['job_id']);
					$row['certifications_list'][]=$this->get_all_certifications($row['job_id']);
					
					$newdata[]=$row;
				}
			return $newdata;
			}
		return false;
	}

	function record_count($search_text,$salary_id,$skill_id,$job_type_id,$level_id,$func_id,$job_cat_id,$city_id)
	{
		 $sql="select count(job_id)as total_jobs from pms_jobs a left join pms_job_category b on  a.job_cat_id= b.job_cat_id left join pms_company c on a.company_id=c.company_id left join pms_job_functional_area d on  d.func_id=a.func_id left join pms_education_level e on a.level_id=e.level_id left join pms_job_work_level f on a.work_level_id=f.work_level_id left join pms_country g on  a.country_id=g.country_id left join pms_job_salary h on  a.salary_id=h.salary_id left join pms_job_type j on a.job_type_id=j.job_type_id ";
	
		$cond = " a.job_status=1 ";	

	if($search_text!='')
		{
			if($cond!='')
			{
				$cond.=" and concat(job_title,job_desc,desired_profile,job_keywords) like '%".$search_text."%'";
			} 
			else{
				$cond.=" concat(job_title,job_desc,desired_profile,job_keywords) like '%".$search_text."%'";
			}  
		} 

		if($job_cat_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_cat_id=" . $job_cat_id;
			} 
			else{
				$cond=" a.job_cat_id=".$job_cat_id;
			}  
		} 

		if($func_id!='')
		{
			if($cond!=''){
				$cond.=" and a.func_id=" . $func_id;
			} 
			else{
				$cond=" a.func_id=".$func_id;
			}  
		} 

		if($level_id !='')
		{
			if($cond!=''){
				$cond.=" and a.level_id=" . $level_id;
			} 
			else{
				$cond=" a.level_id=".$level_id;
			}  
		}
				
		if($job_type_id!='')
		{
			if($cond!=''){
				$cond.=" and a.job_type_id=" . $job_type_id;
			} 
			else{
				$cond=" a.job_type_id=".$job_type_id;
			}  
		}
	
		if($salary_id!='')
		{
			if($cond!=''){
				$cond.=" and a.salary_id=" . $salary_id;
			} 
			else{
				$cond=" a.salary_id=".$salary_id;
			}  
		}

		if($salary_id!='')
		{
			if($cond!=''){
				$cond.=" and a.salary_id=" . $salary_id;
			} 
			else{
				$cond=" a.salary_id=".$salary_id;
			}  
		}

	
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
	
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['total_jobs'];	
	}
	
	function get_list($start,$limit,$sort_by,$search_text,$salary_id,$skill_id,$job_type_id,$level_id,$func_id,$job_cat_id,$city_id)
	{
		$sql="select a.* from pms_jobs a ";	
		$cond = " a.job_status=1 ";	
		
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.job_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);

		return $query->result_array();	
	}

		
	function job_details_by_key($key)
	{
		$qry="select * from pms_jobs  where	md5(job_id)='".$key."'";		
		
		$res=$this->db->query($qry);
		return $res->row_array();		
	}

	function industry_list()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Industry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function functional_list()
	{
		$query = $this->db->query('select distinct func_id, func_area from pms_job_functional_area order by func_area asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Role';
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
	// job status
	function get_job_status()
    {
		$dropDownList=array();
		$dropDownList['']='Select Status';	
		
	 	$query=$this->db->query("select * from pms_curernt_job_status order by cur_job_status asc");
		
		$folder_list = $query->result();
		
		foreach($folder_list as $folder)
		{
			$dropDownList[$folder->cur_job_status] = $folder->cur_job_status_name;
		}
		return $dropDownList;
    }
	
	function nationality_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='What is your Nationality?';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function current_nationality_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Where are you Currently Located?';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}			

	function passport_nationality_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Passport Issued From';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
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
	
		
	function visa_issued_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='VISA Issued From';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function license_issued_list()
	{
		$query = $this->db->query('select distinct country_id, country_name from pms_country order by country_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='License Issued From';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
		
			
	function city_list()
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

	function salary_list()
    {
		$dropDownList=array();
		
       	$query=$this->db->query("select a.salary_id,a.salary_desc from pms_job_salary a order by a.salary_amount");
		
		$state_ist = $query->result();
		$dropDownList['']='Select Salary';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->salary_id] = $dropdown->salary_desc;
		}
		return $dropDownList;
    }
					
	

	function get_all_domains($job_id)
	{
		$qry="SELECT a.domain_name FROM `pms_candidate_domain` a INNER JOIN pms_job_to_domain b ON a.domain_id=b.domain_id where b.job_id=".$job_id;
		$res=$this->db->query($qry);
		$domains=array();
		if($res->num_rows()>0)
		{
			foreach($res->result_array() as $row)
			{
				$domains[]=$row['domain_name'];
			}
		}
		return $domains;
	}

	function get_all_certifications($job_id)
	{
		$qry="SELECT a.cert_name FROM `pms_candidate_certification` a INNER JOIN pms_job_to_certification b ON a.cert_id=b.cert_id where b.job_id=".$job_id;
		$res=$this->db->query($qry);
		$certs=array();
		if($res->num_rows()>0)
		{
			foreach($res->result_array() as $row)
			{
				$certs[]=$row['cert_name'];
			}
		}
		return $certs;
	}		

	function edu_level_list()
	{
		$query = $this->db->query('select distinct level_id, level_name from pms_education_level order by level_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Education Level';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->level_id] = $dropdown->level_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function insert_candidate_from_jobs($data)
	 {

			$this->db->insert('pms_candidate', $data);
			$id = $this->db->insert_id();
			return $id;
		}

 	function insert_candidate_from_linkedin($data)
	 {
			$this->db->insert('pms_candidate', $data);
			$id = $this->db->insert_id();
			return $id;
		}

	function insert_files($dataArr)
	{
			$this->db->insert('pms_candidate_files', $dataArr);
			$id=$this->db->insert_id();
			return $id;
	}

    function country_intl_code()
    {

		$query=$this->db->query("select a.* from pms_country a where a.intl_dial_prefix <> '' and a.intl_code <>'' order by a.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Country Code';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->intl_dial_prefix.' '.$dropdown->intl_code;
		}
		return $dropDownList;
    }

	function visa_type_list()
	{
		$query = $this->db->query('select visa_type_id,visa_type from pms_job_visa_type order by visa_type asc');
		$dropdowns = $query->result();
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->visa_type_id] = $dropdown->visa_type;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function edu_spec_list()
	{
		$query = $this->db->query('select distinct spcl_id, spcl_name from pms_specialisation order by spcl_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Specilization';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->spcl_id] = $dropdown->spcl_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
			
	function insert_employer()
    {
		$this->upload_file_name='';
		
		if (isset($_FILES['company_logo']) && is_uploaded_file($_FILES['company_logo']['tmp_name'])) 
		{            
		
			$config['upload_path'] = '../rms/uploads/company_logo/';
			$config['allowed_types'] = 'jpg|png|jpeg|bmp';
			
			$config['max_size']	= '0';
			
			$config['file_name'] = md5(uniqid(mt_rand()));
			
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('company_logo'))
				{
					$data =  $this->upload->data();	
					$this->upload_file_name=$data['file_name'];
				}
				else
				{
					$this->upload_file_name='';
				}
		}
		
		 if($this->input->post('package')==1) {
		   $to_date     = date('Y-m-d', strtotime("+30 days"));
	   } 
		 else if($this->input->post('package')==2) {
		   $to_date     = date('Y-m-d', strtotime("+90 days"));
	   } 
		 else if($this->input->post('package')==3) {
		   $to_date     = date('Y-m-d', strtotime("+180 days"));
	   } 
		 else if($this->input->post('package')==4) {
		   $to_date     = date('Y-m-d', strtotime("+360 days"));
	   }  
			
			
		$data =	array(
		'company_name'        => $this->input->post('company_name'),
		'company_hash'        => $this->input->post('company_hash'),
		'contact_name'        => $this->input->post('contact_name'),
		'contact_email'       => $this->input->post('contact_email'),
		'date_added'          => date('Y-m-d'),
		'contact_phone'       => $this->input->post('contact_phone'),
		'company_logo'        => $this->upload_file_name,
		'status'              => 1,
		);

        $this->db->insert('pms_company', $data);
		$id=$this->db->insert_id();
		
		$data =	array(
		'email'              => $this->input->post('contact_email'),
		'username'           => $this->input->post('username'),
		'password'           => md5($this->input->post('password')),
		'firstname'          => $this->input->post('contact_name'),
		'mobile'             => $this->input->post('contact_phone'),
		'company_id'         => $id,
		'status'             => 1,
		'payment_status'     => 0,
		'package'            => $this->input->post('package'),
		'from_date'			 => date('Y-m-d'),
		'to_date'			 => $to_date
				
		);

        $this->db->insert('pms_company_users', $data);		
		return $id;
    }
	
	function payment_summary()
    {
		
		$company_id = $_SESSION['company_id'];
		$user_id    = $_SESSION['user_id'];
		$data =	array(
		'company_id'   => $company_id,
		'fname'        => $this->input->post('firstname'),
		'email'        => $this->input->post('email'),
		'mobile'       => $this->input->post('phone'),
		'txnid'        => $this->input->post('txnid'),
		'amount'       => $this->input->post('amount'),
		'date'         => date("Y-m-d h:i:s A"),
		'status'       => 1,
		'username'     => $_SESSION['username'],
		);
//print_r($data); exit();
        $this->db->insert('pms_payment_summary', $data);
		$id = $this->db->insert_id();
		
		$datas =	array(
		'payment_status'       => 1,
		);
		$this->db->where('company_id', $company_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('pms_company_users', $datas);
		
			return $id;
    }
	
	function invoice_list($id)
    {

        $query=$this->db->query("select * from pms_payment_summary where payment_id=".$id);
		return $query->row_array();
	}
	
	function user_details($id)
    {

        $query=$this->db->query("select * from pms_company where company_id=".$id);
		//return $query->result_array();
		return $query->row_array();
	}
	
				
}
