<?php 
class Manage_data_model extends CI_Model {
	
	var $table_name='';
	var $insert_id='';
	
    
	
	
	
	//~ function get_list($start,$limit,$searchterm,$sort_by)
    //~ {
		//~ $a=$_SESSION['company_session'];
		//~ $sql="select a.*, b.firstname, b.lastname from ".$this->table_name." a join pms_admin_users b where a.admin_id = b.admin_id and a.admin_id=$a";
		//~ $cond='';
		//~ if($searchterm!='')
		//~ {
			//~ if($cond!=''){
			//~ 
			//~ }	
			//~ else{
				//~ $sql="select a.*, b.firstname, b.lastname from ".$this->table_name." a join pms_admin_users b";
				//~ $cond=" a.date_from like '%" . $searchterm . "%' and b.admin_id=a.admin_id ";
			//~ }		
		//~ } 
		//~ if($cond!='') $cond=' where '.$cond;
		//~ $sql=$sql.$cond;
		//~ $sql.=" order by date_from ".$sort_by." limit ".$start.",".$limit;
		//~ $query = $this->db->query($sql);
		//~ return $query->result_array();
		//~ 
    //~ }
	//~ function insert_record()
    //~ {
		//~ 
		//~ $data=array(
		//~ 'admin_id'=> $this->input->post('name'),
		//~ 'date_from'=> $this->input->post('date_from'),
		//~ 'date_to'=> $this->input->post('date_to'),
		//~ 'leave_type'=> $this->input->post('leave_type'),
		//~ 'session_type'=> $this->input->post('session_type'),
		//~ 'leave_status'=> $this->input->post('leave_status'),
		//~ 'approved_by'=> 0
		//~ );
		 //~ $this->db->insert($this->table_name, $data);		
		//~ $id=$this->db->insert_id();
	    //~ return $this->db->insert_id();
    //~ }
    
    //~ function update_record()
	//~ {
		//~ $data=array(
		//~ 'admin_id'=> $this->input->post('name'),
		//~ 'date_from'=> $this->input->post('date_from'),
		//~ 'date_to'=> $this->input->post('date_to'),
		//~ 'leave_type'=> $this->input->post('leave_type'),
		//~ 'session_type'=> $this->input->post('session_type'),
		//~ 'leave_status'=> $this->input->post('leave_status'),
		//~ 'approved_by'=> $_SESSION['company_session']
		//~ );
		//~ $this->db->where('leave_id', $this->input->post('leave_id'));
	    //~ $this->db->update('pms_admin_leave', $data);
	//~ }
	
	
	//~ function delete($id=null)
	//~ {
		//~ if($id=='') return false;		
		//~ $this->db->where('leave_id', $id);
		//~ $this->db->delete('pms_admin_leave');		
	//~ }
	//~ 
	//~ function delete_multiple_record($id_arr)
    //~ {
		//~ foreach ($id_arr as $id) {
			//~ 
			//~ $this->db->where('leave_id',$id);
			//~ $this->db->delete($this->table_name);
		//~ }	
    //~ }
    
    
	function update_passport_detail($candidateId)
	{
		
		 $lang=$_POST['lang'];
		foreach($lang as $lan)
		{$langdata=array
		(
		'lang_id'=>$lan,
		'candidate_id'=>$candidateId
		);
		$this->db->insert('pms_cand_lang', $langdata);
		
		}
		$data = array(
				
				'passport_nationality' => $this->input->post('passport_nationality'),

				'eng_10th' => $this->input->post('eng_10th'),
				'eng_12th' => $this->input->post('eng_12th')
				
				
			    ); 
			   
		$this->db->where('candidate_id', $candidateId);
		$this->db->update('pms_candidate', $data); 
		return $this->db->affected_rows();
	}
	
	
	
	
	
	function is_related($id)
	{
		$master_tables = array(array('table'=>'pms_state','key' => 'branch_id','Module'=>'Branch'));
		$is_related = FALSE;
		foreach($master_tables as $table){
			$query=$this->db->query("select * from ".$table['table']." where ".$table['key']."=".$id);
			$num_rows = (int) $query->num_rows();
			if($num_rows){
				$is_related = TRUE;
				$_SESSION['related_module'] = $table['Module'];
				break;
			}
		}
		return $is_related;
	}

	
	function check_dups($name='',$id='')
	{
		$this->db->query('branch_name', $name);
		if($id!='')	$this->db->where('branch_id !=', $id);		
		$query = $this->db->get('pms_branch_description');
		if ($query->num_rows() == 0)
			return true;
		else{
			return false;
		}
	}
	
	
	
	function get_all_admins()
	{
		$row=$this->db->get('pms_admin_users');
		if($row->num_rows()>0)
		{
			foreach($row->result() as $q)
		{
			$data[]=$q;
			}
		}
		//~ print_r($data);die;
		return $data;
	}
	
	
	
	//~ new add ons
	
	
	
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
	
	
	function fill_levels()
	{
		$query = $this->db->query('select distinct level_id, level_name from  pms_education_level order by level_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Level';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->level_id] = $dropdown->level_name;
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
	function edu_years_list()
	{
		$dropDownList[0]='Select Year';
		for($i=1970;$i<=date('Y');$i++)
		{
			 $dropDownList[$i] = $i;
		}
		return $dropDownList;
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
	
	function get_course_list($level_study,$int_val)
	{
		$query = $this->db->query('select course_id, course_name from pms_courses where level_study='.$level_study.' and international='.$int_val.' order by course_name');
		$dropdowns = $query->result();
		$dropDownList['']='Slect Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
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
	
	function state_list_by_city($country_id='')
    {

		if($country_id !='')
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id inner join pms_city c ON a.state_id=c.state_id where a.country_id=".$country_id." order by b.state_name");
		else
			$query=$this->db->query("select a.*,b.* from pms_state a inner join pms_state_description b ON a.state_id=b.state_id  inner join pms_city c ON a.state_id=c.state_id order by b.state_name");
					
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
		$dropDownList['']='Select City';
		
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
    
    	function location_list($city_id='')
    {
		$dropDownList=array();
		$dropDownList['']='Select Location';	
		
		if($city_id!='')			
                     $query=$this->db->query("select a.*,b.* from pms_locations a inner join pms_locations_description b ON a.location_id=b.location_id	 where a.city_id=".$city_id." order by b.location_name");
		else
                    $query=$this->db->query("select a.*,b.* from pms_locations a inner join pms_locations_description b ON a.location_id=b.location_id order by b.location_name");
		
		$state_ist = $query->result();
		
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->location_id] = $dropdown->location_name;
		}
		return $dropDownList;
    }
    	
	
	 function country_list_by_state_city_location($country_id='')
    {

		$query=$this->db->query("select a.*,b.* from pms_country a inner join pms_country_description b ON a.country_id=b.country_id inner join pms_state c ON a.country_id=c.country_id inner join pms_city d ON c.state_id=d.state_id inner join pms_locations f ON d.city_id=f.city_id order by b.country_name");
		$state_ist = $query->result();
		$dropDownList['']='Select Country';
		foreach($state_ist as $dropdown)
		{
			$dropDownList[$dropdown->country_id] = $dropdown->country_name;
		}
		return $dropDownList;
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
	
	function visatype_list()
	{
		$query = $this->db->query('select distinct visa_type_id, visa_type from pms_job_visa_type order by visa_type asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Visa Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->visa_type_id] = $dropdown->visa_type;
		}
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	function get_files($candidate_id){
		
		$query=$this->db->query("select * from pms_candidate_files where candidate_id=".$candidate_id);
		return $query->result_array();
   		
   }
   public function getanswersbyid($id)
	{
		$qry="select * from pms_candidate_survey_answers where question_id=$id";
		$res=$this->db->query($qry);
		
		return $res->result();
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
	
	function get_cert()
   {
	  $query=$this->db->query("select * from pms_candidate_certification");
	  return $query->result_array();
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
	
	
	 function insert_candidate_record($data)
   {
		$this->db->insert('pms_candidate', $data);
        $id = $this->db->insert_id();
       
		return $id;
	}
	
	function get_child_skills($id)
   {
	  $query=$this->db->query("select * from pms_candidate_skills where parent_skill=$id order by skill_name asc");
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
		//~ $id = $this->db->insert_id();
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
		
		//~ $id = $this->db->insert_id();
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
				'location_id' => $this->input->post('location_id'),
				'zipcode' => $this->input->post('zipcode')
		);
		$this->db->insert('pms_candidate_address', $data);
        $id = $this->db->insert_id();
		return $id;
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
}
?>
