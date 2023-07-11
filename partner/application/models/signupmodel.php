<?php 
class signupmodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
    
	function __construct()
    {
		$this->table_name='pms_candidate';
    }
	
	function get_addressbook() { 	
        $query = $this->db->get('pms_candidate');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
	function insert_csv($data) {
        $this->db->insert('pms_candidate', $data);
		$id=$this->db->insert_id();
		return $id;
    }

	function branch_list()
	{
		$query = $this->db->query('select distinct branch_id, branch_name from pms_branch order by branch_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Branch';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->branch_id] = $dropdown->branch_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	
	function insert_csv1($data) {
        $this->db->insert('pms_candidate_address', $data);
    }
 	function get_single_record($candidateId){
		$query=$this->db->query("select * from ".$this->table_name." where candidate_id=".$candidateId);
		return $query->row_array();
	}
	function get_address_single_record($candidateId){
		$query=$this->db->query("select * from pms_candidate_address where candidate_id=".$candidateId);
		return $query->row_array();
	}
	function get_passport_single_record($candidateId){
		$query=$this->db->query("select passportno,driving_license,visa_type_id from ".$this->table_name." where candidate_id=".$candidateId);
		return $query->row_array();
	}
	function get_education_single_record($candidateId){
		$query=$this->db->query("select * from pms_candidate_education where candidate_id=".$candidateId);
		return $query->row_array();
	}
	function get_job_single_record($candidateId){
		$query=$this->db->query("select a.*,b.exp_years,b.exp_months,b.skills from pms_candidate_job_profile a inner join pms_candidate b on a.candidate_id=b.candidate_id where a.candidate_id=$candidateId");
		return $query->row_array();
	}
	function get_file_single_record($candidateId){
		$query=$this->db->query("select photo,cv_file from ".$this->table_name." where candidate_id=".$candidateId);
		return $query->row_array();
	}
	
	 function insert_otp_info($data){
		$this->db->where('candidate_id', $data['candidate_id']);
		$this->db->where('otp_status',0);
		$this->db->update('pms_candidate_otp',array('otp_status' => '3'));	
		
		$this->db->insert('pms_candidate_otp', $data);
        $id = $this->db->insert_id();
		return $id;
	}
		
    
	function record_count($searchterm) 
	{
        //return $this->db->count_all($this->table_name);
		if($searchterm== ''){
			$query=$this->db->query("select count(*)as candidate_id from ".$this->table_name);			
			$row=$query->row_array();
			return $row['candidate_id'];
		}
		else{
			$query=$this->db->query("select count(*)as candidate_id from ".$this->table_name." where first_name like '%" . $searchterm . "%'");			
			$row=$query->row_array();
			return $row['candidate_id'];
		}
    }

	function get_list($start,$limit,$searchterm,$sort_by)
    {
     		
		$query=$this->db->query("select a.*,b.mobile_prefix,b.mobile from pms_candidate a inner join pms_candidate_address b on a.candidate_id=b.candidate_id where a.first_name like '%" . $searchterm . "%' order by a.first_name ".$sort_by." limit ".$start.",".$limit);
		return $query->result_array();
    }

   function file_list($candidate_id){
   		$query = $this->db->query('select * from pms_candidate_files where candidate_id='.$candidate_id);
		return $query->result_array();
   }
   
   function insert_candidate_record($data)
   {
		$this->db->insert('pms_candidate', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	function update_candidate_record($candidateId){//edit profile
		$data =array(
			'username'=> $this->input->post('username'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'reg_date' => date("Y-m-d H:i:s"),
			'title' => $this->input->post('title'),
			'gender' => $this->input->post('gender') ,
			'marital_status' => $this->input->post('marital_status'),		
			'date_of_birth' => $this->input->post('date_of_birth'),
		);
		$this->db->where('candidate_id',$candidateId);
		$this->db->update($this->table_name,$data);
	}
	function insert_candidate_record_skip1()
	{
		$data =array(
			'reg_date' => date("Y-m-d H:i:s"),
			'title' => $this->input->post('title'),
		);
		$this->db->insert('pms_candidate', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	function insert_contact_detail($contactid){
		
		$data = array(
				'candidate_id' => $contactid,
				'address' => $this->input->post('address'),
				'mobile' => $this->input->post('mobile'),
				'land_phone' => $this->input->post('land_phone'),
				'workphone' => $this->input->post('workphone'),
				'fax' => $this->input->post('fax'), 
				'location_id' =>$this->input->post('current_location'),
				'zipcode' => $this->input->post('zipcode')
		);
		$this->db->insert('pms_candidate_address', $data);
		
        $id = $this->db->insert_id();
		$data1 = array(
			'nationality'=> $this->input->post('nationality'),
			'state' => $this->input->post('state'),
			'city_id' => $this->input->post('city_id'),
			'current_location' => $this->input->post('current_location'),
			'religion_id' => $this->input->post('religion_id')
		); 	
		$this->db->where('candidate_id', $contactid);
		$this->db->update('pms_candidate', $data1); 
		
		return $id;
	}
	function insert_contact_detail_skip($candidateId){
		$data = array(
				'candidate_id' => $candidateId
				);
		$this->db->insert('pms_candidate_address', $data);		
	}
	function edit_contact_detail($candidateId){//edit profile
		$data = array(
				'candidate_id' => $candidateId,
				'address' => $this->input->post('address'),
				'mobile_prefix' => $this->input->post('mobile_prefix'),
				'mobile' => $this->input->post('mobile'),
				'land_prefix' => $this->input->post('land_prefix'),
				'land_phone' => $this->input->post('land_phone'),
				'work_prefix' => $this->input->post('work_prefix'),
				'workphone' => $this->input->post('workphone'),
				'fax_prefix'=> $this->input->post('fax_prefix'),
				'fax' => $this->input->post('fax'), 
				'zipcode' => $this->input->post('zipcode')
		);
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate_address', $data); 
		
		$data1 = array(
				'nationality'=> $this->input->post('nationality'),
				'state' => $this->input->post('state'),
				'city_id' => $this->input->post('city_id'),
				'current_location' => $this->input->post('current_location'),
				'religion_id' => $this->input->post('religion_id')
			    ); 	
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate', $data1); 

	}
	function update_contact_detail($candidate_id){//updating while adding
		$data = array(
				'nationality'=> $this->input->post('nationality'),
				'city_id' => $this->input->post('city_id'),
				'current_location' => $this->input->post('current_location'),
				'religion_id' => $this->input->post('religion_id')
			    ); 	
		$this->db->where('candidate_id', $candidate_id);
		$this->db->update('pms_candidate', $data); 
		return $this->db->affected_rows();
	}
	function edit_passport_detail($candidateId){
		$data = array(
				'passportno'=> $this->input->post('passportno'),
				'driving_license' => $this->input->post('driving_license'),
				'visa_type_id' => $this->input->post('visa_type_id'),
			    ); 	
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate', $data); 
	}
	function update_passport_detail($candidateId)
	{//updating while adding
		if(isset($_POST['lang'])){
		 $lang=$_POST['lang'];
		//$lang_str=implode(",",$lang);
		//~ print_r($lang_str);die;
		
		foreach($lang as $lan)
		{$langdata=array
		(
		'lang_id'=>$lan,
		'candidate_id'=>$candidateId
		);
		$this->db->insert('pms_cand_lang', $langdata);
		
		}
		}
		$data = array(
				
				'passport_nationality' => $this->input->post('passport_nationality'),

				'eng_10th' => $this->input->post('eng_10th'),
				'eng_12th' => $this->input->post('eng_12th'),
				'eng_grad' => $this->input->post('eng_grad'),
				'eng_post_grad' => $this->input->post('eng_post_grad'),
			    ); 
			   
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate', $data);
		return $this->db->affected_rows();
	}
	function insert_education_detail($candidateId){
		$data = array(
				'candidate_id' => $candidateId,
				'level_id' => $this->input->post('level_id'),
				'course_id' => $this->input->post('course_id'),
				'spcl_id' => $this->input->post('spcl_id'),
				'univ_id' => $this->input->post('univ_id'),
				'edu_year' => $this->input->post('edu_year'),
				//~ 'edu_country' => $this->input->post('edu_country'),
				'course_type_id' => $this->input->post('course_type_id'),
				'arrears' => $this->input->post('arrears'),
				'absesnse' => $this->input->post('absesnse'),
				'repeat' => $this->input->post('repeat'),
				'year_back' => $this->input->post('year_back'),
				'mark_percentage' => $this->input->post('mark_percentage'),
				'grade' => $this->input->post('grade'),
		);
		$this->db->insert('pms_candidate_education', $data);
        $id = $this->db->insert_id();
		return $id;
	}

	function get_passport_details($candidateId){
		$query=$this->db->query("select * from ".$this->table_name." where candidate_id=".$candidateId);
		return $query->row_array();
	}	
	function insert_education_detail_skip($candidateId){
		$data = array(
				'candidate_id' => $candidateId
				);
		$this->db->insert('pms_candidate_education', $data);
	}
	function edit_education_detail($candidateId){
		$data = array(
				'candidate_id' => $candidateId,
				'level_id' => $this->input->post('level_id'),
				'course_id' => $this->input->post('course_id'),
				'spcl_id' => $this->input->post('spcl_id'),
				'univ_id' => $this->input->post('univ_id'),
				'edu_year' => $this->input->post('edu_year'),
				//~ 'edu_country' => $this->input->post('edu_country'),
				'course_type_id' => $this->input->post('course_type_id')
		);
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate_education', $data); 
	}
	function insert_job_detail($candidateId){
		$data = array(
				'candidate_id' => $candidateId,
				'organization'=> $this->input->post('organization'),
				'designation' => $this->input->post('designation'),
				'job_cat_id'=> $this->input->post('job_cat_id'),
				'func_id' => $this->input->post('func_id'),
				'responsibility' => $this->input->post('responsibility'),
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'monthly_salary' => $this->input->post('monthly_salary'),
				'currency_id' => $this->input->post('currency_id'),
				'present_job' => $this->input->post('present_job'),
		);
		$this->db->insert('pms_candidate_job_profile', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	function insert_job_detail_skip($candidateId){
		$data = array(
				'candidate_id' => $candidateId
				);
		$this->db->insert('pms_candidate_job_profile', $data);		
	}
	function edit_job_detail($candidateId){//edit profile
		$data = array(
				'candidate_id' => $candidateId,
				'organization'=> $this->input->post('organization'),
				'designation' => $this->input->post('designation'),
				'job_cat_id'=> $this->input->post('job_cat_id'),
				'func_id' => $this->input->post('func_id'),
				'responsibility' => $this->input->post('responsibility'),
				'from_date' => $this->input->post('from_date'),
				'to_date' => $this->input->post('to_date'),
				'monthly_salary' => $this->input->post('monthly_salary'),
				'currency_id' => $this->input->post('currency_id'),
				'present_job' => $this->input->post('present_job'),
		);
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate_job_profile', $data); 
		
		$data1 = array(
				'exp_years'=> $this->input->post('exp_years'),
				'exp_months' => $this->input->post('exp_months'),
				'skills' => $this->input->post('skills'),
			    ); 	
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate', $data1); 
		return $this->db->affected_rows();

	}
	function update_job_detail($candidateId){//updating while adding
		$data = array(
				'exp_years'=> $this->input->post('exp_years'),
				'exp_months' => $this->input->post('exp_months'),
				'skills' => $this->input->post('skills'),
			    ); 	
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate', $data); 
		return $this->db->affected_rows();
	}
	
	
	
	
	function get_one_record($id){
   		$query = $this->db->get_where('pms_candidate_files',array('file_id' => $id ));
		return $query->row_array();
   }
	
	
	function insert_file($candidate_id)
	{
		$data = array(
		
				'candidate_id' => $this->input->post('candidate_id'),
				'file_name' => $this->input->post('title'),
				'status'       =>'',
				);
				$this->db->insert('pms_candidate_files',$data);
				$id=$this->db->insert_id();
	$this->load->library('upload');					
					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
						{  
						     
							$photo['upload_path'] = 'uploads/files/';
							$photo['allowed_types'] = 'png|jpg|jpeg|pdf|doc|docx|xls|xlsx|ppt|txt';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('photo'))
								{
			                     	$this->upload_file_name='';
									$data =  $this->upload->data();	
								 	$this->upload_file_name=$data['file_name'];	
									$this->db->query("update pms_candidate_files set file_type='".$this->upload_file_name."' where file_id=".$id);
									
								}
						 }
						 
					return $id;

	}
	
	
	
	
	function update_record($id=NULL)
	{

				$state_id='';
				$city_id=0;
				
				if($this->input->post('state')!='')
				{
					$query = $this->db->query("select state_id from pms_state where state_name='".$this->input->post('state')."'");
					if ($query->num_rows() == 0 && $this->input->post('current_location')!='')
					{
						$data=array(
							'state_name'=>  $this->input->post('state'),
						);
						$this->db->insert('pms_state', $data);
						$state_id=$this->db->insert_id();
					}elseif($query->num_rows() > 0 )
					{
						$row = $query->row_array();
						$state_id=$row['state_id'];
					}
				}

				if($this->input->post('city_id')!='')
				{
					$query = $this->db->query("select city_id from pms_city  where city_name='".$this->input->post('city_id')."'");					
					if ($query->num_rows() == 0 && $state_id!='')
					{
						$data=array(
							'city_name'=>  $this->input->post('city_id'),
							'state_id'=>  $state_id
						);
						$this->db->insert('pms_city', $data);
						$city_id=$this->db->insert_id();
					}elseif($query->num_rows() > 0 )
					{
						$row = $query->row_array();
						$city_id=$row['state_id'];
					}else
					{
						$data=array(
							'city_name'=>  $this->input->post('city_id'),
							'state_id'=>  '0'
						);						
					}
				}
					
				$data=array(
				'username'=>  $this->input->post('username'),
				'password'=>  $this->input->post('password'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'title' => $this->input->post('title'),
				'alternate_email' => $this->input->post('username'),
				'mobile' => $this->input->post('mobile'),
				'mobile_prefix' => $this->input->post('mobile_prefix'),
				'gender' =>  $this->input->post('gender') ,
				'marital_status' =>  $this->input->post('marital_status'),
				'date_of_birth' =>  $this->input->post('date_of_birth'),
				'exp_years' =>  $this->input->post('exp_years'),
				'exp_months' =>  $this->input->post('exp_months'),		
				'nationality' =>  $this->input->post('nationality'),
				'passportno' =>  $this->input->post('passportno'),	
				'visa_type_id' =>  $this->input->post('visa_type_id'),
				'driving_license' =>  $this->input->post('driving_license'),		
				'current_location' =>  $this->input->post('current_location'),		
				'city_id' =>  $city_id,
				'religion_id' =>  $this->input->post('religion_id'),						
				'ref_id' =>  $this->input->post('ref_id'),
				'keywords' =>  $this->input->post('keywords'),
				'skills' =>  $this->input->post('skills')
				);
				
			   $this->db->where('candidate_id', $this->input->post('candidate_id'));
			   $this->db->update($this->table_name, $data);

				if($this->input->post('candidate_id')!='')
				{	
					$data=array(
					'candidate_id' => $this->input->post('candidate_id'),
					'address'=> $this->input->post('address'),
					'mobile_prefix' => $this->input->post('mobile_prefix'),
					'mobile' => $this->input->post('mobile'),
					'land_prefix' => $this->input->post('land_prefix'),
					'land_phone'=> $this->input->post('land_phone'),
					'work_prefix' => $this->input->post('work_prefix'),
					'workphone' => $this->input->post('workphone'),
					'fax_prefix' => $this->input->post('fax_prefix'),
					'fax' => $this->input->post('fax') ,
					'zipcode' => $this->input->post('zipcode')
					);
					
					$this->db->query("delete from pms_candidate_address where candidate_id=".$this->input->post('candidate_id'));					
					$this->db->insert('pms_candidate_address', $data);
					
					$data=array(
					'candidate_id' => $this->input->post('candidate_id'),
					'level_id'=> $this->input->post('level_id'),
					'course_id' => $this->input->post('course_id'),
					'spcl_id'=> $this->input->post('spcl_id'),
					'univ_id' => $this->input->post('univ_id'),
					'edu_year' => $this->input->post('edu_year'),
					//~ 'edu_country' => $this->input->post('edu_country'),
					'course_type_id' => $this->input->post('course_type_id')
					);
					
					$this->db->query("delete from pms_candidate_education where candidate_id=".$this->input->post('candidate_id'));					
					$this->db->insert('pms_candidate_education', $data);
					
					$data=array('candidate_id' => $this->input->post('candidate_id'),
					'organization'=> $this->input->post('organization'),
					'designation' => $this->input->post('designation'),
					'job_cat_id'=> $this->input->post('job_cat_id'),
					'func_id' => $this->input->post('func_id'),
					'responsibility' => $this->input->post('responsibility'),
					'from_date' => $this->input->post('from_date'),
					'to_date' => $this->input->post('to_date'),
					'monthly_salary' => $this->input->post('monthly_salary'),
					'currency_id' => $this->input->post('currency_id'),
					'present_job' => $this->input->post('present_job')
					);
					
					$this->db->query("delete from pms_candidate_job_profile where candidate_id=".$this->input->post('candidate_id'));
					$this->db->insert('pms_candidate_job_profile', $data);

			 }

					$this->load->library('upload');	

					if (is_uploaded_file($_FILES['photo']['tmp_name'])) 
						{         
							$photo['upload_path'] = 'uploads/photos/';
							$photo['allowed_types'] = 'png|jpg|jpeg|gif';
							$photo['max_size']	= '0';
							$photo['file_name'] = md5(uniqid(mt_rand()));
							
							$this->upload->initialize($photo);
							if ($this->upload->do_upload('photo'))
								{
									$this->upload_file_name='';
									$data =  $this->upload->data();									
									$this->upload_file_name=$data['file_name'];	
									$query = $this->db->query("select photo from pms_candidate where candidate_id=".$this->input->post('candidate_id'));
									if ($query->num_rows() > 0)
									{
										$row = $query->row_array();
										if(file_exists('uploads/photos/'.$row['photo']) && $row['photo']!='')
										unlink('uploads/photos/'.$row['photo']);
									}
													
									$this->db->query("update ".$this->table_name." set photo='".$this->upload_file_name."' where candidate_id=".$this->input->post('candidate_id'));
								}
						 }	

						if (is_uploaded_file($_FILES['cv_file']['tmp_name'])) 
							{         
							

								$photo['upload_path'] = 'uploads/cvs/';
								$photo['allowed_types'] =  'doc|docx|pdf|txt';
								$photo['max_size']	= '0';
								$photo['file_name'] = md5(uniqid(mt_rand()));
								
								$this->upload->initialize($photo);
								if ($this->upload->do_upload('cv_file'))
									{
										$this->upload_file_name='';
										$data =  $this->upload->data();									
										$this->upload_file_name=$data['file_name'];	
										$query = $this->db->query("select cv_file from pms_candidate where candidate_id=".$this->input->post('candidate_id'));
										if ($query->num_rows() > 0)
										{
											$row = $query->row_array();
											if(file_exists('uploads/cvs/'.$row['cv_file']) && $row['cv_file']!='')
											unlink('uploads/cvs/'.$row['cv_file']);
										}
														
										$this->db->query("update ".$this->table_name." set cv_file='".$this->upload_file_name."' where candidate_id=".$this->input->post('candidate_id'));
									}
							}	
					
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
	
	function religion_list()
	{
		$query = $this->db->query('select distinct rel_id, rel_name from pms_religion  order by rel_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Religion';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->rel_id] = $dropdown->rel_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	
	function currency_list()
	{
		$query = $this->db->query('select distinct cur_id, cur_short_name from pms_currency_master  order by cur_short_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Currency';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->cur_id] = $dropdown->cur_short_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	function ref_list()
	{
		$query = $this->db->query('select distinct ref_id, ref_name from pms_reference order by ref_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Reference';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->ref_id] = $dropdown->ref_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
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

	function edu_course_list()
	{
		$query = $this->db->query('select distinct course_id, course_name from pms_courses order by course_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function edu_spec_list()
	{
		$query = $this->db->query('select distinct spcl_id, spcl_name from pms_specialisation order by spcl_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Specilization';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->spcl_id] = $dropdown->spcl_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function edu_univ_list()
	{
		$query = $this->db->query('select distinct univ_id, univ_name from pms_university order by univ_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select University';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->univ_id] = $dropdown->univ_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}	

	function edu_course_type_list()
	{
		$query = $this->db->query('select distinct course_type_id, course_type from pms_course_type order by course_type asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Course Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_type_id] = $dropdown->course_type;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function get_course_info($course_id)
	{
		$query = $this->db->query('select a.course_name,b.level_name from pms_courses a inner join pms_education_level b on a.level_study=b.level_id where a.course_id='.$course_id);
		$return_val=array();
		$return_val = $query->row_array();		
		return $return_val;
	}

	function industry_list()
	{
		$query = $this->db->query('select distinct job_cat_id, job_cat_name from pms_job_category order by job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Industry';
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
				
	function edu_years_list()
	{
		$dropDownList[0]='Select Year';
		for($i=1970;$i<=date('Y');$i++)
		{
			 $dropDownList[$i] = $i;
		}
		return $dropDownList;
	}


	function years_list()
	{
		$dropDownList[0]='0 Year';
		for($i=1;$i<=20;$i++)
		{
			 $dropDownList[$i] = $i.' Years';
		}
		return $dropDownList;
	}

	function months_list()
	{
		$dropDownList[0]='0 Month';
		for($i=1;$i<=12;$i++)
		{
			 $dropDownList[$i] = $i.' Months';
		}
		return $dropDownList;
	}
		function insert_files($dataArr){
		$this->db->insert('pms_candidate_files', $dataArr);
		$id=$this->db->insert_id();
		return $id;
	}
	function get_files($candidate_id){
		
		$query=$this->db->query("select * from pms_candidate_files where candidate_id=".$candidate_id);
		return $query->result_array();
   		
   }
   
   function get_skills()
   {
	  $query=$this->db->query("select * from pms_candidate_skills limit 0,25");
	  return $query->result_array();
	}
   function get_parent_skills()
   {
	  $query=$this->db->query("select * from pms_candidate_skills where parent_skill=0");
	  return $query->result_array();
	}
   function get_child_skills($id)
   {
	  $query=$this->db->query("select * from pms_candidate_skills where parent_skill=$id order by skill_name asc");
	  return $query->result_array();
	}
   
   function get_cert()
   {
	  $query=$this->db->query("select * from pms_candidate_certification");
	  return $query->result_array();
	}
	function insert_skill_details($candidate_id)
	{ 
		$id=1;
		if(isset($_POST['skills']) && $_POST['skills']!='')
		{ 
		foreach($_POST['skills'] as $checkbox)
		{ 
			$data=array
			(
			'candidate_id'=>$candidate_id,
			'skill_id'=>$checkbox
			);
			
			$this->db->insert('pms_candidate_to_skills',$data);
			
		
		}
		}
		
		return $id;
			
	}
	
	function insert_cert_details($candidate_id)
	{
		
		$id=1;
		if(isset($_POST['cert']) && $_POST['cert']!='')
		{
			foreach($_POST['cert'] as $checkbox)
		{
			//~ echo $checkbox . ' ';
			$data=array
			(
			'cert_id'=>$checkbox,
			'candidate_id'=>$candidate_id
			
			);
			
			$this->db->insert('pms_candidate_to_certification',$data);
			
			
			
		}
	 }
		
			return $id;
			
	}
	
	
	public function getanswersbyid($id)
	{
		$qry="select * from pms_candidate_survey_answers where question_id=$id";
		$res=$this->db->query($qry);
		
		return $res->result();
	}
	
}
?>
