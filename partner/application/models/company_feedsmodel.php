<?php 
class Company_feedsmodel extends CI_Model {
	var $table_name='';
    function __construct()
    {
		$this->table_name='pms_company';
    }
	
	function record_count($searchterm,$ind_id,$flp_status,$company_priority,$company_rating,$status,$flp_next_date,$date_added,$user_id,$unassigned,$city_id,$building_location) 
	{
	
	$sql = "select count(*)as company_id from ".$this->table_name ." a ";
	$cond = " a.status =1 and company_id in (select company_id from pms_company_to_recruiter where admin_id=".$_SESSION['vendor_session'].") ";
		
	if($searchterm!='')
	{
		if($cond!=''){
			$cond.=" and a.company_name like '%" . $searchterm . "%'";
		} 
		else{
			$cond=" a.company_name like '%" . $searchterm . "%'";
		}  
	} 
	
	if($ind_id!='')
	{
		if($cond!=''){
			$cond.=" and a.ind_id=" . $ind_id;
		} 
		else{
			$cond=" a.ind_id=".$ind_id;
		}  
	} 

	if($city_id!='')
	{
		if($cond!=''){
			$cond.=" and a.city_id=" . $city_id;
		} 
		else{
			$cond=" a.city_id=".$city_id;
		}  
	}
		
	if($flp_status!='')
	{
		if($cond!=''){
			$cond.=" and a.company_id in (select company_id from pms_company_followup where flp_status=" . $flp_status.") ";
		} 
		else{
			$cond.=" a.company_id in (select company_id from pms_company_followup where flp_status=" . $flp_status.") ";
		}  
	} 

	if($flp_next_date!='')
	{
		if($cond!=''){
			$cond.=" and a.company_id in (select company_id from pms_company_followup where flp_next_date='" . $flp_next_date."') ";
		} 
		else{
			$cond.=" a.company_id in (select company_id from pms_company_followup where flp_next_date='" . $flp_next_date."') ";
		}  
	} 
		

	if($company_priority!='')
	{
		if($cond!=''){
			$cond.=" and a.company_priority=" . $company_priority;
		} 
		else{
			$cond=" a.company_priority=".$company_priority;
		}  
	} 
	
	if($status!='')
	{
		if($cond!=''){
			$cond.=" and a.status=" . $status;
		} 
		else{
			$cond=" a.status=".$status;
		}  
	} 

	if($date_added!='')
	{
		if($cond!=''){
			$cond.=" and a.date_added=" . $date_added;
		} 
		else{
			$cond=" a.date_added=".$date_added;
		}  
	} 

	if($building_location!='')
	{
		if($cond!=''){
			$cond.=" and a.building_location='" . $building_location."'";
		} 
		else{
			$cond=" a.building_location='".$building_location."'";
		}  
	} 
	
	if($user_id!='')
	{
		if($cond!=''){
			$cond.=" and a.company_id in (select company_id from pms_company_to_recruiter where admin_id=" . $user_id.") ";
		} 
		else{
			$cond.=" a.company_id in (select company_id from pms_company_to_recruiter where admin_id=" . $user_id.") ";
		}  
	} 
				
	if($company_rating > 0)
	{
		if($cond!=''){
			$cond.=" and a.company_rating=" . $company_rating;
		} 
		else{
			$cond=" a.company_rating=".$company_rating;
		}  
	}

	if($unassigned > 0)
	{
		if($cond!=''){
			$cond.=" and a.company_id not in (select company_id from pms_company_to_recruiter)";
		} 
		else{
			$cond.=" a.company_id not in (select company_id from pms_company_to_recruiter)";
		}  
	}
					
	if($cond!='') $cond=' where '.$cond;
	
	$sql=$sql.$cond;

	$query = $this->db->query($sql);
	$row=$query->row_array();
	return $row['company_id'];
	
	}
	
	function get_list($start,$limit,$searchterm,$ind_id,$flp_status,$sort_by,$company_priority,$company_rating,$status,$flp_next_date,$date_added,$user_id,$unassigned,$city_id,$building_location)
	{
		$sql="select a.*,b.firstname as created_by,(select flp_date from pms_company_followup where company_id=a.company_id order by flp_id desc limit 0,1) as flp_date,(select count(flp_id) from pms_company_followup where company_id=a.company_id) as total_flp,(select flp_next_date from pms_company_followup where company_id=a.company_id order by flp_id desc limit 0,1) as flp_next_date,(select flp_notes from pms_company_followup where company_id=a.company_id order by flp_id desc limit 0,1) as flp_notes,(select flp_status from pms_company_followup where company_id=a.company_id order by flp_id desc limit 0,1) as flp_status,(select firstname from pms_admin_users ad inner join pms_company_followup cpl on ad.admin_id=cpl.admin_id where cpl.company_id=a.company_id order by cpl.flp_id desc limit 0,1) as firstname, (select count(*) as total_jobs from pms_jobs jb where jb.company_id=a.company_id) as total_jobs from ".$this->table_name." a left join pms_admin_users b on a.user_id=b.admin_id ";	
		
		$cond = " a.status =1 and company_id in (select company_id from pms_company_to_recruiter where admin_id=".$_SESSION['vendor_session'].") ";

		if($searchterm!='')
		{
			if($cond!='')
			{
				$cond.=" and a.company_name like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.company_name like '%" . $searchterm . "%'";
			}  
		} 

		if($ind_id!='')
		{
			if($cond!=''){
				$cond.=" and a.ind_id=" . $ind_id;
			} 
			else{
				$cond=" a.ind_id=".$ind_id;
			}  
		} 

		if($city_id!='')
		{
			if($cond!=''){
				$cond.=" and a.city_id=" . $city_id;
			} 
			else{
				$cond=" a.city_id=".$city_id;
			}  
		} 
		
		if($status!='')
		{
			if($cond!=''){
				$cond.=" and a.status=" . $status;
			} 
			else{
				$cond=" a.status=".$status;
			}  
		}
	
		if($flp_status!='')
		{
			if($cond!=''){
				$cond.=" and a.company_id in (select company_id from pms_company_followup where flp_status=" . $flp_status.") ";
			} 
			else{
				$cond.=" a.company_id in (select company_id from pms_company_followup where flp_status=" . $flp_status.") ";
			}  
		} 

	if($date_added!='')
	{
		if($cond!=''){
			$cond.=" and a.date_added=" . $date_added;
		} 
		else{
			$cond=" a.date_added=".$date_added;
		}  
	} 

	if($building_location!='')
	{
		if($cond!=''){
			$cond.=" and a.building_location='" . $building_location."'";
		} 
		else{
			$cond=" a.building_location='".$building_location."'";
		}  
	} 
	
	if($user_id!='')
	{
		if($cond!=''){
			$cond.=" and a.company_id in (select company_id from pms_company_to_recruiter where admin_id=" . $user_id.") ";
		} 
		else{
			$cond.=" a.company_id in (select company_id from pms_company_to_recruiter where admin_id=" . $user_id.") ";
		}  
	} 
	
	if($flp_next_date!='')
	{
		if($cond!=''){
			$cond.=" and a.company_id in (select company_id from pms_company_followup where flp_next_date='" . $flp_next_date."') ";
		} 
		else{
			$cond.=" a.company_id in (select company_id from pms_company_followup where flp_next_date='" . $flp_next_date."') ";
		}  
	} 
	
		if($company_priority!='')
		{
			if($cond!=''){
				$cond.=" and a.company_priority=" . $company_priority;
			} 
			else{
				$cond=" a.company_priority=".$company_priority;
			}  
		} 
		
		if($company_rating > 0)
		{
			if($cond!=''){
				$cond.=" and a.company_rating=" . $company_rating;
			} 
			else{
				$cond=" a.company_rating=".$company_rating;
			}  
		}

		if($unassigned > 0)
		{
			if($cond!=''){
				$cond.=" and a.company_id not in (select company_id from pms_company_to_recruiter)";
			} 
			else{
				$cond.=" a.company_id not in (select company_id from pms_company_to_recruiter)";
			}  
		}
					
		if($cond!='') $cond=' where '.$cond;
		
		$sql=$sql.$cond;
		
		$sql.=" order by a.company_name ".$sort_by." limit ".$start.",".$limit;
		//$sql.=" order by a.company_name ".$sort_by." limit 0,10";
		$query = $this->db->query($sql);

		return $query->result_array();	
	}

    function get_company_name($id)
	{
		if($id < 1) return '';
		
		$query = $this->db->query("select company_name from pms_company where company_id=".$id);
			if ($query->num_rows() > 0)
			{
				$row = $query->row_array();
				return $row['company_name'];
			}else
			{
				return '';
			}
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

	function bde_list()
	{
		$data = array();
		$query=$this->db->query("select admin_id,username from pms_admin_users");
		$dropDownList = array();
		$dropDownList['']='Select BDE';

		$admin_list = $query->result();
		
		foreach($admin_list as $dropdown)
		{
			$dropDownList[$dropdown->admin_id] = $dropdown->username;
		}
		
		return $dropDownList;
	}
	
	function add_calls()
	{
		$data=array(		
		'flp_date'             => $this->input->post('flp_date'),
		'company_id'           => $this->input->post('company_id'),
		'flp_next_date'        => $this->input->post('flp_next_date') ,
		'flp_notes'            => $this->input->post('flp_notes'),
		'flp_status'           => $this->input->post('flp_status'),
		'lead_status'          => $this->input->post('status'),
		'lead_status_date'     => date('Y-m-d'),
		'admin_id'             => $_SESSION['vendor_session'],
		);
		
		$id=$this->db->insert('pms_company_followup', $data);
		
		if($this->input->post('company_rating')!='')
		{
				$data =	array(
				'company_rating'        => $this->input->post('company_rating'),
				);
		
			   $this->db->where('company_id', $this->input->post('company_id'));
			   $this->db->update('pms_company', $data);
		}
				
		if($this->input->post('company_priority')!='')
		{
				$data =	array(
				'company_priority'      => $this->input->post('company_priority'),	
				);
		
			   $this->db->where('company_id', $this->input->post('company_id'));
			   $this->db->update('pms_company', $data);
		}
		
		if($this->input->post('status')!='' &&  $this->input->post('status')>0)
		{
				$data =	array(
				'status'        => $this->input->post('status'),
				);
				
			   $this->db->where('company_id', $this->input->post('company_id'));
			   $this->db->update('pms_company', $data);
		}		
				
		return $id;
	}

	function add_task_assignment($data)
	{		
		$this->db->insert('pms_tasks',$data);
		$id = $this->db->insert_id();		
		return $id;
	}
	
	function add_task()
	{		
		$data = array(
				"task_title"          => $this->input->post("task_title"),
				"candidate_id"        => '0',
				"start_date"          => date("Y-m-d ",strtotime($this->input->post("start_date"))),
				"due_date"            => $this->input->post("due_date"),
				"admin_id"            => $this->input->post("admin_id"),
				"task_priority_id"    => '1',
				"task_status_id"      => '1',
				"task_desc"           => $this->input->post("task_desc"),
				"status"              => 1				
				);
		$this->db->insert('pms_tasks',$data);
		$id = $this->db->insert_id();		
	}
	function add_jobs()
	{
		$data=array(
				'job_title'=> $this->input->post('job_title') ,
				'company_id' => $this->input->post('company_id') ,
				'job_desc' => $this->input->post('job_desc') ,
				'job_type_id' => $this->input->post('job_type_id'),
				'job_location'=> $this->input->post('job_location'),
				'vacancies'=> $this->input->post('vacancies') ,
				'job_post_date'=> $this->input->post('job_post_date') ,
				'job_expiry_date' => $this->input->post('job_expiry_date'),
				'contact_name' => $this->input->post('contact_name'),
				'contact_designation' => $this->input->post('contact_designation'),
				'contact_email' => $this->input->post('contact_email'), 
				'contact_phone' => $this->input->post('contact_phone'),
				
				'job_status' => 1,
				);	
					
        $this->db->insert('pms_jobs', $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
	}

	function get_assignment_recruiter($company_id)
	{
		$query=$this->db->query("select a.admin_id,a.username,(select company_id from pms_company_to_recruiter b where b.admin_id=a.admin_id and b.company_id=".$company_id.") as company_id from pms_admin_users a ");
		
		$dropDownList = array();
		$admin_list = $query->result();
		
		foreach($admin_list as $dropdown)
		{
			$dropDownList[$dropdown->admin_id] = array('username' => $dropdown->username, 'company_id' => $dropdown->company_id);
		}
		return $dropDownList;
	}

	function add_recruiter_to_company($company_id,$admin_id)
	{
		$data=array(
				'company_id'=> $company_id,
				'admin_id' =>  $admin_id,
				);
		$this->db->insert('pms_company_to_recruiter', $data);
		return 0;
	}
					
    function get_company($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select a.*,b.city_id,b.city_name,c.state_id, c.state_name,d.country_id, d.country_name from pms_company a inner join pms_city b on a.city_id=b.city_id inner join pms_state c on b.state_id=c.state_id inner join pms_country d on c.country_id=d.country_id where a.company_id=".$id);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}
	function get_single_company($id)
	{
		if($id=='') return '';
						
		$query = $this->db->query("select * from pms_company  where company_id=".$id);
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}else
		{
			return array();
		}
	}

	function insert_record()
    {
		$data =	array(
		'company_name'        => $this->input->post('company_name'),
		'type_id'             => $this->input->post('type_id'),
		'ind_id'              => $this->input->post('ind_id'),
		'company_rating'      => $this->input->post('company_rating'),
		'company_priority'    => $this->input->post('company_priority'),	
		'company_address'     => $this->input->post('company_address'),
		'company_email'       => $this->input->post('company_email'),
		'company_phone'       => $this->input->post('company_phone'),
		'company_profile'     => $this->input->post('company_profile'),
		'specialties'         => $this->input->post('specialties'),
		'company_size'        => $this->input->post('company_size'),
		'founded'             => $this->input->post('founded'),
		'contact_name'        => $this->input->post('contact_name'),
		'designation'       => $this->input->post('designation'),
		'contact_name_notes'=> $this->input->post('contact_name_notes'),
		'contact_email'       => $this->input->post('contact_email'),
		'city_id'             => $this->input->post('city_id'),
		'building_location'  =>$this->input->post('building_location'),
		'date_added'          => date('Y-m-d'),
		'contact_phone'       => $this->input->post('contact_phone'),
		'contact_phone_1'    => $this->input->post('contact_phone_1'),
		'contact_phone_2'    => $this->input->post('contact_phone_2'),
		'contact_facebook'   => $this->input->post('contact_facebook'),		
		'contact_linkedin'   => $this->input->post('contact_linkedin'),
		'contact_twitter'    => $this->input->post('contact_twitter'),
		'location_map'       => $this->input->post('location_map'),
		'google_map'         => $this->input->post('google_map'),	
		'contact_phone_ext'  => $this->input->post('contact_phone_ext'),
		'company_website'     => $this->input->post('company_website'),
		'twitter'             => $this->input->post('twitter'),
		'facebook'            => $this->input->post('facebook'),
		'linkedin'            => $this->input->post('linkedin'),
		'googleplus'          => $this->input->post('googleplus'),
		'status'              => 1,
		'user_id'             => $_SESSION['vendor_session']				
		);

        $this->db->insert($this->table_name, $data);
		$id=$this->db->insert_id();
		
		$data=array(
			'company_id'      => $id,
			'admin_id'        => $_SESSION['vendor_session']
		);
		
		$this->db->insert('pms_company_to_recruiter', $data);
		return $this->db->insert_id();
    }

	function get_calls_history($company_id)
	{
			$sql=" select a.*,b.* from pms_company_followup a inner join pms_admin_users b on a.admin_id=b.admin_id where a.company_id=".$company_id;
			$query = $this->db->query($sql);
			return $query->result_array();	
	}
	
	function update_record($id=NULL)
	{

/*	
	if($this->input->post('state_name')!='')
		{
			$query = $this->db->query("select state_id from pms_state where state_name='".$this->input->post('state_name')."'");					
			if ($query->num_rows() == 0 && $this->input->post('country_id')!='')
			{
				$data=array(
					'country_id'  => $this->input->post('country_id'),
					'state_name'=>  $this->input->post('state_name')
				);
				$this->db->insert('pms_state', $data);
				$state_id=$this->db->insert_id();
			}elseif($query->num_rows() > 0 )
			{
				$row = $query->row_array();
				$state_id=$row['state_id'];
			}
		}
		
		if($this->input->post('city_name')!='')
		{
			$query = $this->db->query("select city_id from pms_city  where city_name='".$this->input->post('city_name')."'");					
			if ($query->num_rows() == 0 && $state_id!='')
			{
				$data=array(
					'city_name'=>  $this->input->post('city_name'),
					'state_id'=>  $state_id
				);
				$this->db->insert('pms_city', $data);
				$city_id=$this->db->insert_id();
			}elseif($query->num_rows() > 0 )
			{
				$row = $query->row_array();
				$city_id=$row['city_id'];
			}
		}
	*/
	
		$data =	array(
		'company_name'          => $this->input->post('company_name'),
		'type_id'               => $this->input->post('type_id'),
		'ind_id'            => $this->input->post('ind_id'),
		'company_rating'        => $this->input->post('company_rating'),
		'company_priority'   => $this->input->post('company_priority'),	
		'company_address'       => $this->input->post('company_address'),
		'company_email'         => $this->input->post('company_email'),
		'company_phone'         => $this->input->post('company_phone'),
		'company_profile'       => $this->input->post('company_profile'),
		'specialties'           => $this->input->post('specialties'),
		'company_size'          => $this->input->post('company_size'),
		'founded'               => $this->input->post('founded'),
		'city_id'               => $this->input->post('city_id'),
		'building_location'  =>$this->input->post('building_location'),
		'contact_name'          => $this->input->post('contact_name'),
		'designation'           => $this->input->post('designation'),
		'contact_name_notes'    => $this->input->post('contact_name_notes'),
		'contact_email'         => $this->input->post('contact_email'),
		'contact_phone'         => $this->input->post('contact_phone'),
		'contact_phone_1'       => $this->input->post('contact_phone_1'),
		'contact_phone_2'       => $this->input->post('contact_phone_2'),
		'contact_facebook'      => $this->input->post('contact_facebook'),		
		'contact_linkedin'      => $this->input->post('contact_linkedin'),
		'contact_twitter'       => $this->input->post('contact_twitter'),	
		'location_map'       => $this->input->post('location_map'),
		'google_map'         => $this->input->post('google_map'),	
		'contact_phone_ext'     => $this->input->post('contact_phone_ext'),
		'company_website'       => $this->input->post('company_website'),
		'twitter'               => $this->input->post('twitter'),
		'facebook'              => $this->input->post('facebook'),
		'linkedin'              => $this->input->post('linkedin'),
		'googleplus'            => $this->input->post('googleplus'),
		'user_id'               => $_SESSION['vendor_session']			
		);

       $this->db->where('company_id', $id);
	   $this->db->update($this->table_name, $data);
	   
		if(isset($_POST['opportunity']) && is_array($_POST['opportunity']))
		{
			$this->db->query('delete from  pms_company_opportunity where company_id='.$id);
			foreach($_POST['opportunity'] as $key => $val)
			{
				$data=array(
					'company_id' => $id,
					'opp_id' => $val
				);
				$this->db->insert('	', $data);
			}
		}
	}
	
	function type_list()
	{
		$query = $this->db->query('select distinct type_id, type_name from pms_company_type order by type_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Type';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->type_id] = $dropdown->type_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}

	function industry_list_search()
	{
		$query = $this->db->query('select a.job_cat_id, a.job_cat_name from pms_job_category a inner join pms_company b on a.job_cat_id=b.ind_id order by a.job_cat_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Indsutry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_cat_id] = $dropdown->job_cat_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
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

	function opp_list()
	{
		$query = $this->db->query('select distinct opp_id, opp_name from pms_opportunity order by opp_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Oppotunity';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->opp_id] = $dropdown->opp_name;
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

	function building_loc_list()
	{
		$query = $this->db->query("select building_location from pms_company where building_location != '' group by building_location order by building_location asc ");
		$dropdowns = $query->result();
		
		$dropDownList['']='Select Building';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->building_location] = $dropdown->building_location;
		}
	
		$finalDropDown = $dropDownList;

		return $finalDropDown;
	}	

	function cur_opportunity($id)
	{
		$query = $this->db->query('select distinct opp_id, company_id from pms_company_opportunity where company_id='.$id);
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
	 function insert_csv_records($data)
    {
        $this->db->insert('pms_company', $data);
        $id=$this->db->insert_id();
        $this->db->query('update pms_company set user_id='.$_SESSION['vendor_session']);
        return $id;
        
    }
  function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('company_id',$id);
			$this->db->delete($this->table_name);
		}	
    }
	
}
?>
