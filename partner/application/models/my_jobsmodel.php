<?php 
class My_jobsmodel extends CI_Model 
{
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';

    function __construct()
    {
		$this->table_name='pms_jobs';
		$this->upload_file_name='';
    }
	
	function record_count($searchterm,$job_status,$company_id,$job_priority,$package_id) 
	{

		$sql = "select count(*)as job_id from pms_jobs a inner join pms_jobs_to_vendors jr on jr.job_id=a.job_id ";
		$cond = '';
		$cond=' jr.vendor_id='.$_SESSION['vendor_session'];

		if($searchterm!='')
		{
			if($cond!=''){
				$cond .=" and a.job_title like '%" . $searchterm . "%'";
			}
			else{
				$cond =" a.job_title like '%" . $searchterm . "%'";
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
		
		if($package_id >0)
		{
			if($cond!=''){
				$cond .=" and a.package_id=" . $package_id;
			}
			else{
				$cond =" a.package_id=" . $package_id;
			} 
		}
		
		if($job_status!='')
		{
			if($cond!=''){
				$cond .=" and a.job_status=" . $job_status;
			}
			else{
				$cond =" a.job_status=" . $job_status;
			} 
		}

		if($job_priority!='')
		{
			if($cond!=''){
				$cond .=" and a.job_priority=" . $job_priority;
			}
			else{
				$cond =" a.job_priority=" . $job_priority;
			} 
		}
					
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['job_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by,$job_status,$company_id,$job_priority,$package_id)
	{
		$sql="select a.*,(select count(job_app_id) from pms_job_apps where job_id=a.job_id)as total_apps,";
		$sql.= " (select count(job_app_id) from pms_job_apps where job_id=a.job_id and app_status_id=2)as total_rejected,b.*,c.package_name ";
		$sql.=" from ".$this->table_name." a inner join pms_jobs_to_vendors jr on jr.job_id=a.job_id  ";
		$sql.=" left join pms_company b on a.company_id=b.company_id ";
		$sql.=" left join pms_packages c on a.package_id=c.package_id ";

		$cond='';
		$cond=' jr.vendor_id='.$_SESSION['vendor_session'];

		if($searchterm!='')
		{
			if($cond!=''){
				$cond.=" and a.job_title like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.job_title like '%" . $searchterm . "%'";
			}  

		} 

		if($job_status!='')

		{

			if($cond!=''){

				$cond.=" and a.job_status=" . $job_status;

			} 

			else{

				$cond=" a.job_status=" . $job_status;

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

		

		if($package_id >0)

		{

			if($cond!=''){

				$cond .=" and a.package_id=" . $package_id;

			}

			else{

				$cond =" a.package_id=" . $package_id;

			} 

		}



		if($job_priority!='')

		{

			if($cond!=''){

				$cond .=" and job_priority=" . $job_priority;

			}

			else{

				$cond =" job_priority=" . $job_priority;

			} 

		}

								

		if($cond!='') $cond=' where '.$cond;



		$sql=$sql.$cond;



		$sql.=" order by a.job_post_date ".$sort_by." limit ".$start.",".$limit;

		

		$query = $this->db->query($sql);

		return $query->result_array();

	

	}

	function get_candidate_list($job_id)
	{
		if($job_id=='')return;
	
	$sql='select DISTINCT a.username,a.first_name,a.lead_source,a.linkedin_url,a.last_name,a.mobile,a.candidate_id,a.cv_file,a.client_cv_file,b.applied_on,b.job_app_id,b.job_id,d.current_ctc,d.notice_period,d.total_experience, vd.firstname, ';
	
		$sql.=" (select sal.salary_amount from pms_job_salary sal where sal.salary_id=d.salary_id_ctc) as current_ctc, ";
		$sql.=" (select sal.salary_amount from pms_job_salary sal where sal.salary_id=d.salary_id_ectc) as expected_ctc, ";
	
	$sql.='(select cur_job_status from pms_job_apps_calls where candidate_id=a.candidate_id and app_id=b.job_app_id  order by app_call_id desc limit 0,1)as cur_job_status,';

	$sql.=" b.app_status_id from pms_candidate a inner join pms_candidate_to_vendors cv on a.candidate_id=cv.candidate_id inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_jobs jb on b.job_id=jb.job_id inner join pms_vendors vd on cv.vendor_id=vd.vendor_id left join pms_candidate_job_search d on a.candidate_id=d.candidate_id  where b.job_id=".$job_id." and cv.vendor_id=".$_SESSION['vendor_session']." order by b.app_status_id asc";
	
		$query = $this->db->query($sql);
		
		$dropdowns = $query->result_array();
		
		return $dropdowns;

	}

	

	function insert_record()

    {

		

		if (is_uploaded_file($_FILES['brochure']['tmp_name'])) 

		{            

			$config['upload_path'] = 'uploads/brochure/';

			$config['allowed_types'] = 'doc|docx|pdf|xls|xlsx|jpg|png|txt';

			$config['max_size']	= '0';

			$config['file_name'] = md5(uniqid(mt_rand()));

			

			$this->load->library('upload', $config);

		

			if ($this->upload->do_upload('brochure'))

				{

					$data =  $this->upload->data();	

					$this->upload_file_name=$data['file_name'];

				}

				else

				{

					$this->upload_file_name='';

				}

		}

		

					

		

				$data=array(

				'job_priority'              => $this->input->post('job_priority') ,

				'job_title'                 => $this->input->post('job_title') ,

				'company_id'                => $this->input->post('company_id') ,

				'package_id'                => $this->input->post('package_id') ,

				'job_desc'                  => $this->input->post('job_desc') ,

				'job_cat_id'                => $this->input->post('job_cat_id') ,

				'job_cat_id'                => $this->input->post('job_cat_id') ,

				'func_id'                   => $this->input->post('func_id') ,

				'desig_id'                  => $this->input->post('desig_id'),

				'job_type_id'               => $this->input->post('job_type_id'),

				'job_location'              => $this->input->post('job_location'),

                'job_loc'                   => $this->input->post('job_loc'),

                'min_age'                   => $this->input->post('min_age'),

                'max_age'                   => $this->input->post('max_age'),

                'course_name'               => $this->input->post('course_name'),

				'res_location'              => $this->input->post('res_location') ,

				'vacancies'                 => $this->input->post('vacancies') ,

				'job_post_date'             => $this->input->post('job_post_date') ,

				'job_expiry_date'           => $this->input->post('job_expiry_date'),

				'gender'                    => $this->input->post('gender'),

				'desired_profile'           => $this->input->post('desired_profile') ,

				'brochure'                  => $this->upload_file_name,

				'level_id'                  => $this->input->post('level_id'),

				'total_exp_needed'          => $this->input->post('total_exp_needed'),		

				'about_company'             => $this->input->post('about_company'),

				'job_contact'               => $this->input->post('job_contact'),

				'salary_id'                 => $this->input->post('salary_id'),

				'exp_join_date'             => $this->input->post('exp_join_date'),

				'job_keywords'              => $this->input->post('job_keywords'),

				'job_skills'                => $this->input->post('parent'),

				'work_level_id'             => $this->input->post('work_level_id'),

				'business_type_id'          => $this->input->post('business_type_id'),

				'contact_name'              => $this->input->post('contact_name'),

				'contact_designation'       => $this->input->post('contact_designation'),

				'contact_email'             => $this->input->post('contact_email'), 

				'contact_phone'             => $this->input->post('contact_phone'),

				'contact_website'           => $this->input->post('contact_website'),

				'country_id'                => $this->input->post('country_id'),

                'state_id'                  => $this->input->post('state_id'),

				'facebook'                  => $this->input->post('facebook'),

				'twitter'                   => $this->input->post('twitter'),

				'googleplus'                => $this->input->post('googleplus'),

				'linkedin'                  => $this->input->post('linkedin'),

				'social_title'              => $this->input->post('social_title'),	

				'social_content'            => $this->input->post('social_content'),	

				'social_link'               => $this->input->post('social_link'),	

				'social_link_image'         => $this->input->post('social_link_image'),	

				'social_comment'            => $this->input->post('social_comment'),	

				'job_priority'              => 1,

				'job_status'                => 1,

				'mode_of_application'       => $this->input->post('mode_of_application'),	

				'instructions'              => $this->input->post('instructions'),

				'hide_salary'               => $this->input->post('hide_salary'),

				'intl_locations'            => $this->input->post('intl_locations'),

				'age_limit'                 => $this->input->post('age_limit'),

				'max_notice_period'         => $this->input->post('max_notice_period'),

				'documents_required'        => $this->input->post('documents_required'),

				'response_mode'             => $this->input->post('response_mode'),

				'contact_email_id'          => $this->input->post('contact_email_id'),

				'product_id'                => $this->input->post('product_id'),

				'work_duration'             => $this->input->post('work_duration'),

				'hourly_rate'               => $this->input->post('hourly_rate'),

				'job_skill_name'            => $this->input->post('job_skill_name'),

                'min_salary'                => $this->input->post('min_salary'),

                'max_salary'                => $this->input->post('max_salary'),

				'job_update_date'           => date('Y-m-d'),		

				);	

					

        $this->db->insert($this->table_name, $data);

		$id=$this->db->insert_id();

		return $id;	

		

		

			

    }

	

	

	

	function delete_job($id)

	{	

	

	$query = $this->db->query("select brochure from pms_jobs where job_id='".$id."'");

		if ($query->num_rows() > 0)

		{

			$row = $query->row_array();

			if(file_exists('uploads/'.$row['brochure']) && $row['brochure']!='')

			unlink('uploads/'.$row['brochure']);

		}



	

		$this->db->query("delete from pms_jobs_to_vendors where job_id='".$id."'");

		$this->db->query("delete from pms_jobs_to_vendors where job_id='".$id."'");

		$this->db->query("delete from pms_job_followup where job_id='".$id."'");

		$this->db->query("delete from pms_job_notes where job_id='".$id."'");

		$this->db->query("delete from pms_job_apps_emails where job_id='".$id."'");

		$this->db->query("delete from pms_job_to_certification where job_id='".$id."'");

		$this->db->query("delete from pms_job_apps where job_id='".$id."'");

		$this->db->query("delete from pms_job_to_skill where job_id='".$id."'");

		$this->db->query("delete from pms_job_to_domain where job_id='".$id."'");

		$this->db->query("delete from pms_jobs where job_id='".$id."'");	

		return;

	}

	

	    function get_salary($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select salary_amount from pms_job_salary where salary_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['salary_amount'];
			}else
			{
				return '';
			}
	}

	function intl_locations_list()

    {

       	$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id order by b.country_name");

		$state_ist = $query->result();

		$dropDownList['']='Select Location';

		foreach($state_ist as $dropdown)

		{

			$dropDownList[$dropdown->country_id] = $dropdown->country_name;

		}



		return $dropDownList;

    }	

	

   function insert_candidate_from_jobs($data)

	 {

			$this->db->insert('pms_candidate', $data);

			$id = $this->db->insert_id();

			return $id;

		}

		

	function insert_cert_details($job_id)

	{

		$this->db->query("delete from pms_job_to_certification where job_id=".$job_id);

		if(isset($_POST['cert_id']) && $_POST['cert_id']!='')

		{

			foreach($_POST['cert_id'] as $id)

			{

				

				$data=array

				(

					'job_id'=>$job_id,

					'cert_id'=>$id,

				

				);

			

			$this->db->insert('pms_job_to_certification',$data);

			}

		}

	}

	

	function insert_skill_details($job_id,$skills)

	{

		$this->db->query("delete from pms_job_to_skill where job_id=".$job_id);

		if(isset($skills) && $skills!='')

		{

			foreach($skills as $id)

			{				

				$data=array

				(

					'job_id'=>$job_id,

					'skill_id'=>$id,

				

				);

			

			$this->db->insert('pms_job_to_skill',$data);

			}

			

			$query=$this->db->query("select a.skill_name from pms_candidate_skills a inner join pms_job_to_skill b on a.skill_id=b.skill_id where b.job_id=".$job_id);

	  $skills = $query->result_array();

	  $data = array();

	  foreach($skills as $id => $val)

			{

		  $data[]=$val['skill_name'];

				}

		  $data_string= implode(',',$data); 

		 

		  $data=array(		

				'job_skill_name'=> $data_string,

	             ); 

				$this->db->where('job_id', $job_id);

				$this->db->update('pms_jobs', $data);

				

	      return $job_id;

		  exit(); 

			}

		}



	function download_cv($candidateId){

	

		$query=$this->db->query("select a.cv_file from pms_candidate a where a.candidate_id=".$candidateId);

		return $query->row_array();

	}

		

	function insert_domain_details($job_id)

	{

		$this->db->query("delete from pms_job_to_domain where job_id=".$job_id);

		if(isset($_POST['domain_id']) && $_POST['domain_id']!='')

		{

			foreach($_POST['domain_id'] as $id)

			{

				

				$data=array

				(

					'job_id'=>$job_id,

					'domain_id'=>$id,

				

				);

			

			$this->db->insert('pms_job_to_domain',$data);

			}

		}

	}



	function copy_job($id)

    {

		$this->db->where('job_id', $id);

		$query=$this->db->get('pms_jobs');

		$data=$query->row_array();

		unset($data['job_id']);

		$data['job_title']=$data['job_title'].' - Copy';



        $this->db->insert($this->table_name, $data);

		$job_id=$this->db->insert_id();



		$job_certifications = $this->get_certification_details($id);	

		

		if(count($job_certifications)>0)

		{

			foreach($job_certifications as $key => $val)

			{

				$data=array

				(

					'job_id'=>$job_id,

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

				

					'job_id'=>$job_id,

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

					'job_id'=>$job_id,

					'domain_id'=>$val['domain_id'],

				);

			$this->db->insert('pms_job_to_domain',$data);

			}

		}							

		return $job_id;

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



	function business_type_list()

	{

		$query = $this->db->query('select distinct business_type_id, business_type_name from pms_business_type order by business_type_id asc');

		$dropdowns = $query->result();

			

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->business_type_id] = $dropdown->business_type_name;

		}

			

		$finalDropDown = $dropDownList;

		return $finalDropDown;

	}

		

	function get_job($job_id)

    {

		$job_details=array();

		$this->db->where('job_id', $job_id);

		$query=$this->db->get('pms_jobs');

		$job_details=$query->row_array();

		return $job_details;

    }



	function get_job_complete($job_id)
    {
		$job_details=array();
		
		$sql="SELECT a.*,b.company_name, c.job_cat_name,d.salary_desc,e.city_name as job_lcoation_name ";		
		
		$sql.=", (select expm.exp_range from pms_job_experience expm where expm.exp_id=a.min_experience) as min_experience_val ";
		$sql.=", (select expx.exp_range from pms_job_experience expx where expx.exp_id=a.max_experience) as max_experience_val ";
		
		$sql.=" FROM pms_jobs a inner join  pms_jobs_to_vendors jv on a.job_id=jv.job_id inner join pms_company b on a.company_id=b.company_id left join pms_job_category c on a.job_cat_id=c.job_cat_id left join pms_job_salary d on a.salary_id=d.salary_id left join pms_city e on a.job_location=e.city_id where a.job_id=".$job_id." and jv.vendor_id=".$_SESSION['vendor_session'];
		
		$query=$this->db->query($sql);
		$job_details=$query->row_array();
		return $job_details;
    }


	function get_education_levels($id)
    {
        $query=$this->db->query("SELECT a.* FROM `pms_education_level` a inner join pms_job_to_edu_level b on a.level_id=b.level_id inner join pms_jobs c on c.job_id=b.job_id where c.job_id=".$id." order by a.level_name asc");
		return $query->result_array();
	}
		

	function get_vendor($vendor_id)

    {

		$vendor_details=array();

		$this->db->where('vendor_id', $vendor_id);

		$query=$this->db->get('pms_vendors');

		$vendor_details=$query->row_array();

		return $vendor_details;

    }



	function check_recruiter_asigned($vendor_id,$job_id)

    {

		$total_count=0;

		$this->db->where('vendor_id', $vendor_id);

		$this->db->where('job_id', $job_id);

		$query=$this->db->get('pms_jobs_to_vendors');

		$total_count=$query->num_rows();

		return $job_details;

    }



	function check_vendor_asigned($vendor_id,$job_id)

    {

		$total_count=array();

		$this->db->where('vendor_id', $vendor_id);

		$this->db->where('job_id', $job_id);

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



    

       function get_desig_name($id)

	{

		if($id < 1) return '';

		

		$query = $this->db->query("select desig_name from pms_designation where desig_id=".$id);

			if ($query->num_rows() > 0)

			{

				$row = $query->row_array();

				return $row['desig_name'];

			}else

			{

				return '';

			}

	}

    

      function get_state_name($id)

	{

		if($id < 1) return '';

		

		$query = $this->db->query("select state_name from pms_state where state_id=".$id);

			if ($query->num_rows() > 0)

			{

				$row = $query->row_array();

				return $row['state_name'];

			}else

			{

				return '';

			}

	}

     function get_city_name($id)

	{

		if($id < 1) return '';

		

		$query = $this->db->query("select city_name from pms_city where city_id=".$id);

			if ($query->num_rows() > 0)

			{

				$row = $query->row_array();

				return $row['city_name'];

			}else

			{

				return '';

			}

	}

     function get_exp_range($id)

	{

		if($id < 1) return '';

		

		$query = $this->db->query("select exp_range from pms_job_experience where exp_id=".$id);

			if ($query->num_rows() > 0)

			{

				$row = $query->row_array();

				return $row['exp_range'];

			}else

			{

				return '';

			}

	}

    

	function addcandidate($data,$job_id)

	{

		foreach ($data as $key => $val)

 		{

			$query = $this->db->query('SELECT * from pms_job_apps where job_id='.$job_id.' and candidate_id='.$val);

			if($query->num_rows()==0)

			{

				$data=array(

						'job_id'=> $job_id,

						'candidate_id' =>  $val,

						'applied_on' => date('Y-m-d') ,

						'cover_letter'=> '' ,

						'vendor_id'   => $_SESSION['vendor_session'],

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

		$query = $this->db->query('SELECT * from pms_job_apps where job_id='.$data['job_id'].' and candidate_id='.$data['candidate_id']);

		if($query->num_rows()==0)

		{

			$this->db->insert('pms_job_apps', $data);

		}

	}



	function get_from_applicant_list($job_id)

	{

		$query=$this->db->query('select * from pms_job_apps where job_id='.$job_id);

		return $query->result_array();

	}



	function get_from_short_listed_list($job_id)

	{

		$query=$this->db->query('select a.* from pms_job_apps a inner join pms_job_apps_shortlisted b on a.job_app_id=b.app_id where  a.job_id='.$job_id);

		return $query->result_array();

	}



	function get_from_rejected_list($job_id)

	{

		$query=$this->db->query('select * from pms_job_apps where app_status_id=2 and job_id='.$job_id);

		return $query->result_array();

	}



	function get_from_interview_list($job_id)

	{

		$query=$this->db->query('select a.* from pms_job_apps a inner join pms_job_apps_interviews b on a.job_app_id=b.job_app_id where a.job_id='.$job_id);

		return $query->result_array();

	}

					

	function remove_from_apps($candidate_id,$job_app_id,$job_id)

	{

		$query = $this->db->query('delete from pms_job_apps where candidate_id='.$candidate_id.' and job_app_id='.$job_app_id.' and app_status_id=1 and job_id='.$job_id);

		return 0;

	}

	

	function get_filter_count($id)

	{

		$where='';

		

		$sql='select DISTINCT count(a.candidate_id)as total_rec from  pms_candidate a left join pms_candidate_job_search b on a.candidate_id=b.candidate_id ';



		$where=' where a.candidate_id not in(select candidate_id from pms_job_apps where job_id='.$id.') ';



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

		if($this->input->post('level_id')!='')

		{

			if($where!='')

			{

				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_education where level_id=' .$this->input->post('level_id').') ';

			}else

			{

				$where.=' a.candidate_id in (select candidate_id from pms_candidate_education where level_id=' .$this->input->post('level_id').') ';

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



		$sql='select DISTINCT a.candidate_id,a.first_name,a.last_name,a.username, a.cv_file,a.exp_years,a.linkedin_url,a.gender,b.total_experience,b.notice_period,b.expected_ctc,b.current_ctc,b.gcc_experience,b.ctc_updated_on,(select DISTINCT candidate_id from pms_job_apps_emails where candidate_id=a.candidate_id and job_id='.$id.')as emailed from  pms_candidate a left join pms_candidate_job_search b on a.candidate_id=b.candidate_id ';

		

		$where=' where a.candidate_id not in(select candidate_id from pms_job_apps where job_id='.$id.') ';



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

		if($this->input->post('level_id')!='')

		{

			if($where!='')

			{

				$where.=' and a.candidate_id in (select candidate_id from pms_candidate_education where level_id=' .$this->input->post('level_id').') ';

			}else

			{

				$where.=' a.candidate_id in (select candidate_id from pms_candidate_education where level_id=' .$this->input->post('level_id').') ';

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

		$sql='select count(*) as total_rec from  pms_job_apps_emails where job_id='.$id;

		$query = $this->db->query($sql);

		$row=$query->row_array();

		return $row['total_rec'];

	}

	

	function get_filter_records_email($id,$start,$limit)

	{

		$records=array();

		

		$sql='select * from pms_job_apps_emails a where job_id='.$id;



		$sql.=" order by a.candidate_name limit ".$start.",".$limit; 

		$query=$this->db->query($sql);	

		$records=$query->result_array();	



		return $records;		

	}

		

	function add_to_job()

	{

		

			$query = $this->db->query('SELECT * from pms_job_apps where job_id='.$this->input->get('job_id').' and candidate_id='.$this->input->get('candidate_id'));

			if($query->num_rows()==0)

			{

				$data=array(

						'job_id'=> $this->input->get('job_id') ,

						'candidate_id' =>  $this->input->get('candidate_id'),

						'applied_on' => date('Y-m-d') ,

						'cover_letter'=> '' ,

						'app_status_id'=> 1

						);

			$this->db->insert('pms_job_apps', $data);

			}

			

	}



	function add_recruiter_to_job($job_id,$vendor_id)

	{

		$data=array(

				'job_id'=> $job_id,

				'vendor_id' =>  $vendor_id,

				);

		$this->db->insert('pms_jobs_to_vendors', $data);

		return 0;

	}



	function add_vendor_to_job($job_id,$vendor_id)

	{

		$data=array(

				'job_id'=> $job_id,

				'vendor_id' =>  $vendor_id,

				);

		$this->db->insert('pms_jobs_to_vendors', $data);

	}

			

	function delete_application($candidate_id,$job_id)

	{

		//$query = $this->db->query("select job_id from  pms_job_apps where job_app_id=".$this->input->post('job_app_id'));		

		//if ($query->num_rows() > 0)

		//{

		//	$row = $query->row_array();

		//	return $row['job_id'];

		//}



		$query = $this->db->query('delete from pms_job_apps where job_id='.$job_id.' and candidate_id='.$candidate_id);

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

		'vendor_id'=> $_SESSION['vendor_session'],

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

		//'vendor_id'=> $_SESSION['vendor_session'],

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

		'vendor_id'=> $_SESSION['vendor_session'],

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

				'package_id'            => '',

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

		$this->db->where('job_app_id', $this->input->post('job_app_id'));

		$this->db->query("update pms_job_apps set app_status_id=5 where job_app_id=".$this->input->post('job_app_id')." and candidate_id=".$data['candidate_id']);



		//echo $this->db->last_query();

		return $id;

	}

		

	function send_jd($data)

	{

		$this->db->query("delete from pms_job_apps_emails where candidate_id=".$data['candidate_id']." and job_id=".$data['job_id']." and email_status=1");

		$this->db->insert('pms_job_apps_emails', $data);

		$id=$this->db->insert_id();

		return $id;

	}



	function send_jd_email($data)

	{

		$this->db->query("delete from pms_job_apps_emails where job_id=".$data['job_id']." and email='".$data['email']."' and email_status=1");

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

		'vendor_id'=> $_SESSION['vendor_session'],

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

		$this->db->query("update pms_job_apps set app_status_id=6 where job_app_id=".$this->input->post('app_id')." and candidate_id=".$data['candidate_id']);

		return $id;

	}



//REJECT OFFER

	function reject_offer()

	{ 

		$data=array(

		'app_id'          => $this->input->post('app_id'),

		'vendor_id'                => $_SESSION['vendor_session'],

		'candidate_id'    => $this->input->post('candidate_id') ,

		'reason'      => $this->input->post('reason'),

		'offer_status'	=> 3,

		);

		

		$this->db->where('app_id', $this->input->post('app_id'));

	   	$this->db->update('pms_job_apps_offerletter', $data);

		$this->db->query("update pms_job_apps set app_status_id=8 where job_app_id=".$this->input->post('app_id')." and candidate_id=".$this->input->post('candidate_id'));

		

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

		'vendor_id'=> $_SESSION['vendor_session'],

		'negotiation'                  => $this->input->post('negotiation'),

		);

		

		$this->db->query("delete from pms_job_apps_offerletter where app_id=".$this->input->post('app_id')." and candidate_id=".$this->input->post('candidate_id'));

		$id=$this->db->insert('pms_job_apps_offerletter', $data);

		

		$this->db->query("update pms_job_apps set app_status_id=7 where job_app_id=".$this->input->post('app_id')." and candidate_id=".$this->input->post('candidate_id'));

		

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

		'vendor_id'                => $_SESSION['vendor_session'],

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

		

		$this->db->query("update pms_job_apps set app_status_id=9 where job_app_id=".$this->input->post('app_id')." and candidate_id=".$this->input->post('candidate_id'));

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

		'vendor_id'                => $_SESSION['vendor_session'],

		);

		$this->db->query("delete from pms_job_apps_invoice where placement_id=".$this->input->post('placement_id'));

		$this->db->insert('pms_job_apps_invoice', $data);

		$this->db->query("update pms_job_apps set app_status_id=10 where job_app_id=".$this->input->post('app_id')." and candidate_id=".$this->input->post('candidate_id'));

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

		$query=$this->db->query("select vendor_id,username from pms_vendors");

		$dropDownList = array();

		$dropDownList[0]='Select User';



		$admin_list = $query->result();

		

		foreach($admin_list as $dropdown)

		{

			$dropDownList[$dropdown->vendor_id] = $dropdown->username;

		}

		

		return $dropDownList;

	}



	function get_assignment_recruiter($job_id)

	{

		$query=$this->db->query("select a.vendor_id,a.username,(select job_id from pms_jobs_to_vendors b where b.vendor_id=a.vendor_id and b.job_id=".$job_id.") as job_id from pms_vendors a where a.group_id=19");

		

		$dropDownList = array();

		$admin_list = $query->result();

		

		foreach($admin_list as $dropdown)

		{

			$dropDownList[$dropdown->vendor_id] = array('username' => $dropdown->username, 'job_id' => $dropdown->job_id);

		}

		return $dropDownList;

	}



	function get_assignment_vendor($job_id)

	{

		$query=$this->db->query("select a.vendor_id,a.username, (select job_id from pms_jobs_to_vendors b where b.vendor_id=a.vendor_id and b.job_id=".$job_id.") as job_id from pms_vendors a ");

		$dropDownList = array();

		$admin_list = $query->result();

		

		foreach($admin_list as $dropdown)

		{

			$dropDownList[$dropdown->vendor_id] =array('username' => $dropdown->username, 'job_id' => $dropdown->job_id);

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

	function update_record($id='')

	{

		if($id=='')return;



		$data=array(

		'job_priority'                  => $this->input->post('job_priority') ,

		'job_title'                     => $this->input->post('job_title') ,

		'company_id'                    => $this->input->post('company_id') ,

		'package_id'                    => $this->input->post('package_id') ,

		'job_desc'                      => $this->input->post('job_desc') ,

		'job_cat_id'                    => $this->input->post('job_cat_id') ,

		'job_cat_id'                    => $this->input->post('job_cat_id') ,

		'func_id'                       => $this->input->post('func_id') ,

		'desig_id'                      => $this->input->post('desig_id'),

		'job_type_id'                   => $this->input->post('job_type_id'),

        'min_salary'                    => $this->input->post('min_salary'),

        'max_salary'                    => $this->input->post('max_salary'),

        'min_age'                       => $this->input->post('min_age'),

        'max_age'                       => $this->input->post('max_age'),

        'course_name'                   => $this->input->post('course_name'),

        'job_loc'                       => $this->input->post('job_loc'),

		'job_location'                  => $this->input->post('job_location'),

		'res_location'                  => $this->input->post('res_location') ,

		'vacancies'                     => $this->input->post('vacancies') ,

		'job_post_date'                 => $this->input->post('job_post_date') ,

		'job_expiry_date'               => $this->input->post('job_expiry_date'),

		'gender'                        => $this->input->post('gender'),

		'desired_profile'               => $this->input->post('desired_profile') ,

		'brochure'                      => $this->upload_file_name,

		'level_id'                      => $this->input->post('level_id'),

		'total_exp_needed'              => $this->input->post('total_exp_needed'),	

		'about_company'                 => $this->input->post('about_company'),

		'job_contact'                   => $this->input->post('job_contact'),

		'salary_id'                     => $this->input->post('salary_id'),

		'exp_join_date'                 => $this->input->post('exp_join_date'),

		'job_keywords'                  => $this->input->post('job_keywords'),

		'job_skills'                    => $this->input->post('parent'),

		'work_level_id'                 => $this->input->post('work_level_id'),

		'business_type_id'              => $this->input->post('business_type_id'),

		'contact_name'                  => $this->input->post('contact_name'),

		'contact_designation'           => $this->input->post('contact_designation'),

		'contact_email'                 => $this->input->post('contact_email'), 

		'contact_phone'                 => $this->input->post('contact_phone'),

		'contact_website'               => $this->input->post('contact_website'),

		'country_id'                    => $this->input->post('country_id'),

        'state_id'                      => $this->input->post('state_id'),

		'facebook'                      => $this->input->post('facebook'),

		'twitter'                       => $this->input->post('twitter'),

		'googleplus'                    => $this->input->post('googleplus'),

		'linkedin'                      => $this->input->post('linkedin'),

		'social_title'                  => $this->input->post('social_title'),	

		'social_content'                => $this->input->post('social_content'),	

		'social_link'                   => $this->input->post('social_link'),	

		'social_link_image'             => $this->input->post('social_link_image'),	

		'social_comment'                => $this->input->post('social_comment'),	

		'mode_of_application'           => $this->input->post('mode_of_application'),	

		'instructions'                  => $this->input->post('instructions'),	

		'hide_salary'                   => $this->input->post('hide_salary'),

		'intl_locations'    			=> $this->input->post('intl_locations'),

		'age_limit'          			=> $this->input->post('age_limit'),

		'max_notice_period'  			=> $this->input->post('max_notice_period'),

		'documents_required' 			=> $this->input->post('documents_required'),

		'response_mode'       			=> $this->input->post('response_mode'),

		'contact_email_id'    			=> $this->input->post('contact_email_id'),

		'product_id'          			=> $this->input->post('product_id'),

		'work_duration'   				=> $this->input->post('work_duration'),

		'hourly_rate'         			=> $this->input->post('hourly_rate'),

		'job_skill_name'         		=> $this->input->post('job_skill_name'),	

		'job_update_date'      			=> $this->input->post('job_update_date'),					

		);



       $this->db->where('job_id', $id);

	   $this->db->update($this->table_name, $data);

		

		if (is_uploaded_file($_FILES['brochure']['tmp_name'])) 

		{            

			$config['upload_path'] = 'uploads/brochure/';

			$config['allowed_types'] = 'doc|docx|pdf|xls|xlsx|jpg|png|txt';

			$config['max_size']	= '0';

			$config['file_name'] = md5(uniqid(mt_rand()));			

			$this->load->library('upload', $config);		

			

			if ($this->upload->do_upload('brochure'))

			{

				$data =  $this->upload->data();	

				$this->upload_file_name=$data['file_name'];

				$query = $this->db->query("select brochure from pms_jobs where job_id=".$id);

				if ($query->num_rows() > 0)

				{

					$row = $query->row_array();

					if(file_exists('uploads/brochure/'.$row['brochure']) && $row['brochure']!='')

					unlink('uploads/'.$row['brochure']);

				}

			$query = $this->db->query("update pms_jobs set brochure='".$this->upload_file_name."' where job_id=".$id);

			}

		}

	}



	function active_seekers($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.applied_on,b.vendor_id,b.rejected_by,b.app_status_id,c.job_title,d.company_name,e.*,f.*,g.*,h.*,j.* FROM `pms_candidate` a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_jobs c on b.job_id=c.job_id inner join pms_company d on c.company_id=d.company_id left join pms_job_apps_interviews e on b.job_app_id=e.job_app_id left join pms_job_apps_shortlisted f on b.job_app_id=f.app_id left join pms_job_apps_selected g on b.job_app_id=g.app_id left join pms_job_apps_offerletter h on b.job_app_id=h.app_id left join pms_candidate_job_search j on j.candidate_id=a.candidate_id where c.job_id='.$job_id.' order by b.applied_on');

	

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

	

	function job_change_list($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('select a.job_id,a.job_title,b.company_name from pms_jobs a left join pms_company b on a.company_id=b.company_id where a.job_id <> '.$job_id.' order by a.job_title ');

		

		$dropdowns = $query->result_array();	

		

		return $dropdowns;

	}



	function import_from_other_jobs($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('select DISTINCT a.job_id,a.job_title,b.company_name,(select count(pms_job_apps.job_app_id) as total_apps from pms_job_apps where job_id=a.job_id)as total_jobs,(select count(pms_job_apps.job_app_id) as total_apps from pms_job_apps where job_id=a.job_id and app_status_id=2)as total_rejected from pms_jobs a left join pms_company b on a.company_id=b.company_id where a.job_id <> '.$job_id.' order by a.job_title ');

		$dropdowns = $query->result_array();		

		return $dropdowns;

	}

		

	function get_candidate_suggestions($job_id)

	{

		if($job_id=='')return;

		

		$query = $this->db->query('SELECT a.*,(select candidate_id from pms_job_apps where candidate_id=a.candidate_id and job_id=1)as applied,b.* FROM `pms_candidate` a left join pms_candidate_job_search b on a.candidate_id=b.candidate_id where a.candidate_id in (select candidate_id from pms_candidate_to_skills where skill_id in (SELECT skill_id from pms_job_to_skill where job_id=1)) order by a.first_name ');



		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



	function get_job_skills($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT b.skill_id FROM `pms_jobs` a inner join pms_job_to_skill b on a.job_id=b.job_id inner join pms_candidate_skills c on c.skill_id=b.skill_id where b.job_id=1 ');

		

		$dropdowns = $query->result_array();	



		return $dropdowns;

	}

		

	function rejected_candidates($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('select a.*,b.job_app_id,b.rejected_on,b.reason_for_reject,c.firstname from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id left join pms_vendors c on b.rejected_by=c.vendor_id where b.job_id='.$job_id.'  and app_status_id=2 order by b.applied_on desc');

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}

	

	function applied_candidates($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('select a.*,b.job_app_id from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id where b.job_id='.$job_id.' and b.candidate_id not in (select pms_job_apps_shortlisted.candidate_id from pms_job_apps_shortlisted inner join pms_job_apps on pms_job_apps_shortlisted.app_id=pms_job_apps.job_app_id where pms_job_apps.job_id='.$job_id.') order by b.applied_on desc');

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



    function get_user_info($vendor_id)

	{

		if($vendor_id < 1) return '';

		

		$query = $this->db->query("select * from pms_vendors where vendor_id=".$vendor_id);

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

				

	function get_shortlisted_client($job_id,$short_id)

	{

		if($job_id=='')return;

		$query = $this->db->query("select a.*,b.job_app_id,c.short_id,c.app_id,c.short_date,d.job_id,d.job_title,e.total_experience,e.current_ctc,e.expected_ctc,e.notice_period,f.country_name as nationality from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_job_apps_shortlisted c on b.job_app_id=c.app_id inner join pms_jobs d on b.job_id=d.job_id left join pms_candidate_job_search e on a.candidate_id=e.candidate_id left join pms_country f on a.nationality=f.country_id where b.job_id=".$job_id." and c.short_id in (".$short_id.")");

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

		$query = $this->db->query("select distinct a.country_id, concat(a.country_name,' [+ ',intl_dial_prefix,' ',intl_code,']')as country_name from pms_country a inner join pms_state b on a.country_id=b.country_id order by a.sort_order asc");

		$dropdowns = $query->result();

		

		$dropDownList[0]='Select Country';

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->country_id] = $dropdown->country_name;

		}

	

		$finalDropDown = $dropDownList;

		return $finalDropDown;

	}

    

    function fill_education()

	{

		$query = $this->db->query('select distinct level_id, level_name from pms_education_level order by level_id asc');

		$dropdowns = $query->result();

		$dropDownList[0]='Select Education Level';

		

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->level_id] = $dropdown->level_name;

		}

			

		$finalDropDown = $dropDownList;

		return $finalDropDown;

	}

		

	function update_shortlisted_status($job_id,$short_id)

	{

		if($job_id=='')return;

		$query = $this->db->query("update pms_job_apps_shortlisted set client_feedback_status=1 where short_id in (".$short_id.")");

		$query = $this->db->query("update pms_job_apps_shortlisted set total_submission=total_submission+1 where short_id in (".$short_id.")");

		return;

	}

		

	function shortlist($data,$job_id,$app_id)

	{

		foreach ($data as $key => $val)

 		{

			$query = $this->db->query('delete from pms_job_apps_shortlisted where app_id='.$app_id[$key].' and candidate_id='.$val);

			$data_short=array(

					'app_id'=> $app_id[$key],

					'candidate_id' =>  $val,

					'short_date' => date('Y-m-d') ,

					'vendor_id'=> $_SESSION['vendor_session']

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



	function get_shortlisted($job_id)
	{
		if($job_id=='')return;
		$query = $this->db->query('select a.*,b.*,c.*,d.current_ctc,d.expected_ctc,d.notice_period,d.total_experience from pms_candidate a inner join pms_candidate_to_vendors cv on cv.candidate_id=a.candidate_id inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_job_apps_shortlisted c on b.job_app_id=c.app_id left join pms_candidate_job_search d on a.candidate_id=d.candidate_id where b.job_id='.$job_id.' order by a.first_name');
		$dropdowns = $query->result_array();	
		return $dropdowns;
	}			

		

	function get_interview_list($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.applied_on,c.first_name,c.last_name,d.interview_type,(select count(interview_id) from pms_job_apps_interviews_rejection e where interview_id=a.interview_id)as total_rejection,(select count(app_id) from pms_job_apps_selected f where f.app_id=a.job_app_id)as selected FROM `pms_job_apps_interviews` a inner join pms_job_apps b on a.job_app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id left join pms_candidate_interview_types d on d.interview_type_id=a.interview_type_id where a.int_status !=2 AND b.job_id='.$job_id.' order by c.first_name');

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



	function get_interview_history($job_id)

	{

		if($job_id=='')return;

		// interview history

		$query = $this->db->query('SELECT a.*,b.applied_on,c.first_name,c.last_name,d.interview_type,(select count(interview_id) from pms_job_apps_interviews_rejection e where interview_id=a.interview_id)as total_rejection,(select count(app_id) from pms_job_apps_selected f where f.app_id=a.job_app_id)as selected FROM `pms_job_apps_interviews_history` a inner join pms_job_apps b on a.job_app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id left join pms_candidate_interview_types d on d.interview_type_id=a.interview_type_id where a.int_status !=2 AND b.job_id='.$job_id.' order by c.first_name');

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}

	

	function get_interview_rejection_list($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.applied_on,c.first_name,c.last_name,d.interview_type,e.* FROM `pms_job_apps_interviews` a left join pms_job_apps b on a.job_app_id=b.job_app_id left join pms_candidate c on a.candidate_id=c.candidate_id left join pms_candidate_interview_types d on d.interview_type_id=a.interview_type_id inner join pms_job_apps_interviews_rejection e on e.interview_id=a.interview_id  where e.reject_reason_id > 0 and b.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}

		

//Candidates Schedule for Another job with same skills

	function interview_schedule($job_id)

	{ 

		if($job_id=='')return;



		

		$query = $this->db->query('SELECT d.*,a.first_name,a.last_name,e.interview_type FROM  pms_job_apps b  inner join pms_job_to_skill c on b.job_id=c.job_id inner join pms_job_apps_interviews d on d.job_app_id=b.job_app_id inner join pms_candidate a on b.candidate_id=a.candidate_id left join pms_candidate_interview_types e on e.interview_type_id=d.interview_type_id where b.job_id !='.$job_id.' and c.skill_id in (select skill_id from pms_job_to_skill where job_id='.$job_id.') and d.int_status!=1  group by b.job_app_id order by d.int_status asc');

				

		

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}

	

	function candidates_selected($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,c.first_name,c.last_name,(select count(app_id)as offered from pms_job_apps_offerletter d where d.app_id=a.app_id)as offered FROM `pms_job_apps_selected` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id where b.job_id='.$job_id);

		$dropdowns = $query->result_array();	



		return $dropdowns;

	}



	function offer_letters_issued($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.*,c.first_name,c.last_name FROM `pms_job_apps_offerletter` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id where b.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



	function offer_accepted($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.*,c.first_name,c.last_name FROM `pms_job_apps_placement` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on b.candidate_id=c.candidate_id where b.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



	function invoice_generated($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.*,d.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_placement c on a.job_app_id=c.app_id inner join pms_job_apps_invoice d on c.placement_id=d.placement_id where a.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}	



//contracts ending between (jobstart date -30 days) and (job end date +30 days)

	function contracts_ending($job_id,$start_date,$end_date)

	{

/*		$query = $this->db->query('SELECT job_post_date,job_expiry_date from pms_jobs where job_id='.$job_id);

		$result=$query->row();

		$start_date= date('Y-m-d', strtotime($result->job_post_date .'- 30 days'));

		$end_date= date('Y-m-d', strtotime($result->job_expiry_date .'+ 30 days'));*/

		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,b.linkedin_url,b.cv_file FROM pms_candidate_contract a inner join pms_candidate b on a.candidate_id=b.candidate_id where  a.end_date between "'.$start_date.'" and "'.$end_date.'"');

		

		return $query->result_array();

	}

	

//GET CERT ATTEST

	function get_cert_attest($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_cert c on a.job_app_id=c.app_id  where a.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}

	

//VISA DETAILS DELETE

	function visa_details($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_visa c on a.job_app_id=c.app_id  where a.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}

	

//VISA DOCUMENT

	function visa_documents($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_document c on a.job_app_id=c.app_id  where a.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}

//MEDICAL DETAILS DELETE

	function medical_details($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.* FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_medical c on a.job_app_id=c.app_id  where a.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



//TICKET DETAILS DELETE

	function ticket_details($job_id)

	{

		if($job_id=='')return;

		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.*,d.placement_id FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_ticket c on a.job_app_id=c.app_id inner join `pms_job_apps_placement` d  on d.app_id=a.job_app_id  where a.job_id='.$job_id);

		$dropdowns = $query->result_array();	

		return $dropdowns;

	}



//TICKET FOLLUW UP DETAILS 

	function ticket_followup($job_id)

	{

		if($job_id=='')return;

		

		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name,c.*,d.placement_id FROM pms_job_apps a inner join pms_candidate b on a.candidate_id=b.candidate_id inner join pms_job_apps_ticket c on a.job_app_id=c.app_id inner join `pms_job_apps_placement` d  on d.app_id=a.job_app_id  where a.job_id='.$job_id.' and ( c.travel_document !="" or c.send_by !=0 or c.send_mode !=0 or c.travel_followup !="" or c.pickup_followup !="" or c.travel_confirmation !=0 ) ');

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

	

	function product_list_old()

	{

		$query = $this->db->query('select a.product_id, a.product_name, b.company_id, b.company_name from pms_products a inner join pms_company b on a.company_id=b.company_id group by b.company_name order by product_name asc');

		$dropdowns = $query->result();

		$dropDownList[0]='Select Product';

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->product_id] = $dropdown->product_name .' &nbsp; | &nbsp;'. $dropdown->company_name;

		}

	

		$finalDropDown = $dropDownList;

		return $finalDropDown;

	}

	

	

	function product_list($company_id='')

    {

		if($company_id !='')

			$query=$this->db->query("select a.* from pms_products a where a.company_id=".$company_id." order by a.product_name");

		

		$product_ist = $query->result();

				

		$dropDownList['']='Select Product';

		

		foreach($product_ist as $dropdown)

		{

			$dropDownList[$dropdown->product_id] = $dropdown->product_name;

		}

		

		return $dropDownList;

    }	

	

	

	



	function fill_package()

	{

		$query = $this->db->query('select distinct package_id, package_name from pms_packages order by package_id asc');

		$dropdowns = $query->result();

		$dropDownList[0]='Select Package';

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->package_id] = $dropdown->package_name;

		}

	

		$finalDropDown = $dropDownList;

		return $finalDropDown;

	}

	

		

	function company_has_jobs($job_status)

	{

		$query = $this->db->query('select distinct a.company_id, a.company_name from pms_company a inner join pms_jobs b on a.company_id=b.company_id where b.job_status='.$job_status.' order by a.company_name asc');

		$dropdowns = $query->result();

		$dropDownList[0]='Select Company';

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->company_id] = $dropdown->company_name;

		}

	

		$finalDropDown = $dropDownList;

		return $finalDropDown;

	}

	

	

	function package_list()

	{

		$query = $this->db->query('select distinct a.package_id, a.package_name from pms_packages a order by a.package_name asc');

		$dropdowns = $query->result();

		$dropDownList['']='Select Packages';

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->package_id] = $dropdown->package_name;

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

	function fill_worklevel()

	{

		$query = $this->db->query('select distinct work_level_id, work_level from pms_job_work_level order by work_level asc');

		$dropdowns = $query->result();

		$dropDownList[0]='Select Work Level';

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->work_level_id] = $dropdown->work_level;

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



	



	function jobtype_list()

	{

		$query = $this->db->query('select distinct job_type_id, job_type_name from pms_job_type order by job_type_name asc');

		$dropdowns = $query->result();

		$dropDownList[0]='Select Job Type';

		

		foreach($dropdowns as $dropdown)

		{

			 $dropDownList[$dropdown->job_type_id] = $dropdown->job_type_name;

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

			 

			 $dropDownList[$dropdown->salary_id] = 'INR'.'&nbsp'. $dropdown->salary_desc.'&nbsp'.'Lacs / Annum';

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

					$query = $this->db->query("select brochure from pms_jobs where job_id=".$val);

					if ($query->num_rows() > 0)

					{

						$row = $query->row_array();

						if(file_exists('uploads/brochure/'.$row['brochure']) && $row['brochure']!='')

						unlink('uploads/brochure/'.$row['brochure']);

					}

					$this->db->where('job_id', $val);

					$this->db->delete('pms_jobs'); 

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

			

			$this->db->where('job_id',$id);

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

	

	function skill_names($id='')

   {

	  $query=$this->db->query("select a.* from pms_candidate_skills a inner join pms_job_to_skill b on a.skill_id=b.skill_id where a.parent_skill=".$id." order by a.skill_name asc");

	  return $query->result_array();

	}

	

	

	function get_cert()

   {

	  $query=$this->db->query("select cert_id,cert_name from pms_candidate_certification order by cert_name asc");

	  return $query->result_array();

	 

	}

	function get_certification_details($id)

	{

		$query=$this->db->query('select * from pms_job_to_certification where job_id='.$id);

		 return $query->result_array();

	}

	

	function get_skill_details($id)

	{

		$query=$this->db->query('select * from pms_job_to_skill where job_id='.$id);

		 return $query->result_array();

	}

	function get_domain()

   {

	  $query=$this->db->query("select domain_id,domain_name from pms_candidate_domain order by domain_name asc ");

	  return $query->result_array();

	 

	}

	

	function get_domain_details($id)

	{

		$query=$this->db->query('select * from pms_job_to_domain where job_id='.$id);

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

	

	function get_functional_by_industry($job_cat_id='')

    {

		$query=$this->db->query("select distinct func_id, func_area from pms_job_functional_area where job_cat_id=".$job_cat_id." order by func_area");

		$state_ist = $query->result();

		$dropDownList['']='Select Functional Area';

		

		foreach($state_ist as $dropdown)

		{

			$dropDownList[$dropdown->func_id] = $dropdown->func_area;

		}		

		return $dropDownList;

    }

	

	function get_designation_by_functional($func_id='')

    {

		$query=$this->db->query("select distinct desig_id, desig_name from pms_designation where func_id=".$func_id." order by desig_name");

		$state_ist = $query->result();

		$dropDownList['']='Select Designation';

		

		foreach($state_ist as $dropdown)

		{

			$dropDownList[$dropdown->desig_id] = $dropdown->desig_name;

		}		

		return $dropDownList;

    }

	

	

	function qualification_level($job_id)

    {

        $query=$this->db->query("SELECT a.level_id,a.level_name FROM `pms_education_level` a inner join pms_job_to_edu_level b on a.level_id=b.level_id where b.job_id=".$job_id." order by a.level_name");

		$dropdowns = $query->result_array();

		$survey_result=array();

		foreach($dropdowns as $key => $val)

		{

			 $survey_result[$val['level_id']] = $val['level_name'];

		}

		return $survey_result;

	}	

	

	

	

	function update_qualification_level($job_id, $level_id)

	{	

			$this->db->where('job_id',$job_id);

			$this->db->delete('pms_job_to_edu_level');

			if(is_array($level_id))

			{

				foreach($level_id as $key => $val)

				{

					$data =array(

					'job_id'=> $job_id,

					'level_id'=> $val,

					);

					$this->db->insert('pms_job_to_edu_level', $data);

				}			

			}

	}



}

?>