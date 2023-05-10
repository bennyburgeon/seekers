<?php 
class intakesmodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_intakes';
		$this->upload_file_name='';
    }
	
	function record_count($searchterm) 
	{
		$sql="select count(*)as intake_id from pms_intakes a inner join pms_colleges b on a.campus_id = b.college_id inner join pms_university c on b.univ_id = c.univ_id";
		
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" c.univ_name like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['intake_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
		$sql="select a.*,b.*,c.* from pms_intakes a inner join pms_colleges b on a.campus_id = b.college_id inner join pms_university c on b.univ_id = c.univ_id";
		
		$cond='';
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			} 
			else{
			$cond=" c.univ_name like '%" . $searchterm . "%'";
			}  
		} 
		//$cond="job_title like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$sql.=" order by intake_id ".$sort_by." limit ".$start.",".$limit;
		$query = $this->db->query($sql);
		return $query->result_array();
	
	}

	function intake_details($id)
	{
		$query=$this->db->query("SELECT a.*,b.*,c.* FROM `pms_intakes` a left join pms_colleges b on a.campus_id=b.college_id left join pms_university c on b.univ_id=c.univ_id where a.intake_id=".$id);
		return $query->row_array();
	}

	function get_job_dashboard($no_rec, $offset)
	{
		$query=$this->db->query("SELECT a.job_id,a.job_title,b.company_name, c.job_cat_name,a.job_post_date FROM `pms_jobs` a inner join pms_company b on a.company_id=b.company_id inner join pms_job_category c on a.job_cat_id=c.job_cat_id order by a.job_post_date desc limit $offset,$no_rec");
		return $query->result_array();
	}

	function get_industry_total()
	{
			$query=$this->db->query("SELECT count(a.job_cat_id) as job_cat_id, b.job_cat_name FROM `pms_candidate` a inner join pms_job_category b on a.job_cat_id=b.job_cat_id group by a.job_cat_id order by b.job_cat_name");
		return $query->result_array();
	}
	
	function industry_summary($no_rec, $offset)
	{
		$query=$this->db->query("SELECT count(a.job_cat_id)as totalind, sum(a.vacancies) vacancy,a.job_cat_id,b.job_cat_name FROM `pms_jobs` a inner join pms_job_category b on a.job_cat_id=b.job_cat_id group by a.job_cat_id order by totalind desc limit $offset,$no_rec");
		return $query->result_array();	
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
	
	
	function insert_skill_details($job_id,$p_id)
	{
		$this->db->query("delete from pms_job_to_skill where job_id=".$job_id);
		if(isset($_POST['skills']) && $_POST['skills']!='')
		{
			foreach($_POST['skills'] as $id)
			{
				
				$data=array
				(
					'job_id'=>$job_id,
					'skill_id'=>$id,
				
				);
			
			$this->db->insert('pms_job_to_skill',$data);
			}
		}
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
	
	
	function child_skill()
	{
		 $id=$this->input->get('id');
		//~ $id=1;
		$this->data['skillset']=$this->jobsmodel->get_child_skills($id);
		echo json_encode($this->data);
	}
	
	
	function addcandidate($data,$intake_id)
	{
		foreach ($data as $key => $val)
 		{
			$query = $this->db->query('SELECT * from pms_intake_candidate where intake_id='.$intake_id.' and candidate_id='.$val);
			if($query->num_rows()==0)
			{
				$data=array(
						'intake_id'=> $this->input->post('intake_id') ,
						'candidate_id' =>  $val,

						);
			$this->db->insert('pms_intake_candidate', $data);
			}
		}		
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

	function add_interview()
	{
		$data=array(
		'job_app_id'=> $this->input->post('job_app_id'),
		'candidate_id' => $this->input->post('candidate_id') ,
		'interview_date'=> date("Y-m-d H:i:s",strtotime($this->input->post('interview_date'))),
		'title'=> $this->input->post('title') ,
		'description' => $this->input->post('description'),
		'duration'=> $this->input->post('duration') ,
		'interview_time'=> $this->input->post('interview_time') ,
		'interview_type_id'=> $this->input->post('interview_type_id') ,
		'int_status_id'=> $this->input->post('int_status_id') ,
		'location' => $this->input->post('location'),
		);
		
		$this->db->query("delete from pms_job_apps_interviews where job_app_id=".$this->input->post('job_app_id')." and candidate_id=".$this->input->post('candidate_id'));
		$this->db->insert('pms_job_apps_interviews', $data);
		//echo $this->db->last_query();
		$query = $this->db->query("select job_id from  pms_job_apps where job_app_id=".$this->input->post('job_app_id'));
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row_array();
			return $row['job_id'];
		}
	}
		function edu_level_list()
	{
		$query = $this->db->query('select distinct level_id, level_name from pms_education_level order by level_name asc');
		$dropdowns = $query->result();
		$dropDownList['']='Select Education Level';
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
		$dropDownList['']='Select Course';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->course_id] = $dropdown->course_name;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	function shortlist2()
	{
		$data=array(
		'app_id'          => $this->input->get('job_app_id'),
		'candidate_id'    => $this->input->get('candidate_id') ,
		'short_date'     => date('Y-m-d'),
		'candidate_id'=> $_SESSION['candidate_session']
		);
		$this->db->query("delete from pms_job_apps_shortlisted where app_id=".$this->input->get('job_app_id')." and candidate_id=".$this->input->get('candidate_id'));
		$id=$this->db->insert('pms_job_apps_shortlisted', $data);
		return $id;
	}
	
	function select_candidate()
	{
		$data=array(
		'app_id'          => $this->input->post('app_id'),
		'candidate_id'    => $this->input->post('candidate_id') ,
		'feedback'        => $this->input->post('feedback') ,
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
		'candidate_id'    => $this->input->post('candidate_id') ,
		'reason'      => $this->input->post('reason'),
		'offer_status'	=> 3,

		);
		
		$this->db->where('app_id', $this->input->post('app_id'));
	   	$this->db->update('pms_job_apps_offerletter', $data);
		//echo $this->db->last_query();
		
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

//create visa
	function create_program()
	{
		$data=array(
			'intake_id'       => $this->input->post('intake_id'),
			'course_id'       => $this->input->post('course_id'),
			'candidate_id'     => $this->input->post('candidate_id'),

		);
		$this->db->query("delete from pms_intake_programs where intake_id=".$this->input->post('intake_id'));
		$this->db->insert('pms_intake_programs', $data);
	
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
	
//delete ticket FOLLOWUP
	function delete_followup($id)
	{
		$data=array(
			
		'send_by'     =>'',
		'send_mode'     => '',
		'travel_followup'     => '',
		'pickup_followup'     =>'',
		'travel_confirmation'     => '',
		);

		$this->db->where('ticket_id',$id);
		
	   	$this->db->update('pms_job_apps_ticket', $data);
		return 0;
	}	

	function get_candidate_list($intake_id)
	{
		if($intake_id=='')return;
		$query = $this->db->query('select DISTINCT a.*,b.* from pms_candidate a inner join pms_intake_candidate b on a.candidate_id=b.candidate_id where b.intake_id='.$intake_id.' ');

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
	
	function get_shortlisted($job_id)
	{
		if($job_id=='')return;
		$query = $this->db->query('select a.*,b.*,c.short_id,c.app_id,c.short_date,c.candidate_id from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_job_apps_shortlisted c on b.job_app_id=c.app_id where b.job_id='.$job_id);
		$dropdowns = $query->result_array();	
		return $dropdowns;
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
					'candidate_id'=> $_SESSION['candidate_session']
					);
			$this->db->insert('pms_job_apps_shortlisted', $data_short);
		}		
	}
			
	function get_interview_list($job_id)
	{
		if($job_id=='')return;
		$query = $this->db->query('SELECT a.*,c.first_name,c.last_name,d.interview_type FROM `pms_job_apps_interviews` a inner join pms_job_apps b on a.job_app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id left join pms_candidate_interview_types d on d.interview_type_id=a.interview_type_id where a.int_status !=2 AND b.job_id='.$job_id);
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
		$query = $this->db->query('SELECT a.*,c.first_name,c.last_name FROM `pms_job_apps_selected` a inner join pms_job_apps b on a.app_id=b.job_app_id inner join pms_candidate c on a.candidate_id=c.candidate_id where b.job_id='.$job_id);
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
		$query = $this->db->query('SELECT a.*,b.first_name,b.last_name FROM pms_candidate_contract a inner join pms_candidate b on a.candidate_id=b.candidate_id where  a.end_date between "'.$start_date.'" and "'.$end_date.'"');
		
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
		$query = $this->db->query('select distinct job_ind_id, job_ind_name from pms_job_industries order by job_ind_name asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Job Industry';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->job_ind_id] = $dropdown->job_ind_name;
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

	function fill_education()
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
		$query = $this->db->query('select distinct salary_id, salary_amount from pms_job_salary order by salary_amount asc');
		$dropdowns = $query->result();
		$dropDownList[0]='Select Salary';
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->salary_id] = $dropdown->salary_amount;
		}
	
		$finalDropDown = $dropDownList;
		return $finalDropDown;
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
/*----------------------start-------------------------------------------*/	
// insert intake details	
	
	function insert_record()
    {
		
		$data=array(
			'intake_start' =>  date('Y-m-d',strtotime($this->input->post('intake_start'))),
			'intake_end'   =>  date('Y-m-d',strtotime($this->input->post('intake_end'))),
			'join_date'    => $this->input->post('join_date') ,
			'campus_id'    => $this->input->post('campus_id') ,
									
		);	
			
		$this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }
	
	
	function update_record($id='')
	{
		if($id=='')return;
		else
		{
				$data=array(
					'intake_start' =>  date('Y-m-d',strtotime($this->input->post('intake_start'))),
					'intake_end'   =>  date('Y-m-d',strtotime($this->input->post('intake_end'))),
					'join_date'    => $this->input->post('join_date') ,
					'campus_id'    => $this->input->post('campus_id') ,
				);	

			   $this->db->where('intake_id', $id);
			   $this->db->update($this->table_name, $data);
		
		}
		
	}
	
	
	// get all College details	
	
	function get_colleges()
	{
		$query = $this->db->query('select * from  pms_colleges  order by college_name asc');
		 return $query->result_array();
	}

	
// get all university details	
	
	function get_university()
	{
		$query = $this->db->query('select * from  pms_university a  inner join pms_colleges b on a.univ_id = b.univ_id  order by univ_name asc');
		$dropdowns = $query->result();
		$dropDownList[]='Select University';
		
		foreach($dropdowns as $dropdown)
		{
			 $dropDownList[$dropdown->univ_id] = $dropdown->univ_name;
		}
			
		$finalDropDown = $dropDownList;
		return $finalDropDown;
	}
	
	// geting  function by category
	function college_list_by_university($univ_id='')
    {
		$dropDownList=array();
		$dropDownList['']='Select College';	
		
		if($univ_id!='')
		{		
		 	$query=$this->db->query("select * from pms_colleges  where univ_id=".$univ_id." order by college_name asc");
		}
		else
		{
            $query=$this->db->query("select * from pms_colleges order by college_name asc");
		}
		
		$college_list = $query->result();
		
		foreach($college_list as $dropdown)
		{
			$dropDownList[$dropdown->college_id] = $dropdown->college_name;
		}
		return $dropDownList;
    }
	
	function get_intake_details($id)
	{
		$query=$this->db->query('select a.*,b.*,c.* from pms_intakes a inner join pms_colleges b on a.campus_id = b.college_id inner join pms_university c on b.univ_id = c.univ_id  where intake_id='.$id.' order by univ_name asc');
		 return $query->row_array();
	}
	
	
	function delete_records($id)	
	{
		
		
		$this->db->where('intake_id', $id);
		$this->db->delete($this->table_name);
		
	}
	
	function delete_multiple_record($id_arr)
    {
		foreach ($id_arr as $id) {
			
			$this->db->where('intake_id',$id);
			$this->db->delete($this->table_name);
			//echo $this->db->last_query();
		}
		
    }
}
?>