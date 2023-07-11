<?php 
class jobsmodel extends CI_Model {
	var $table_name='';
	var $upload_file_name='';
	var $new_id='';
	
    function __construct()
    {
		$this->table_name='pms_jobs';
		$this->upload_file_name='';
    }
	
	function record_count($searchterm) 
	{
	
		$sql = "select count(*)as job_id from ".$this->table_name;
		$cond = '';
		
		if($searchterm!='')
		{
			if($cond!=''){
			//$cond.=" and candidate_id=".$candidateId;
			}
			else{
			$cond =" job_title like '%" . $searchterm . "%'";
			} 
		} 
	
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;
		
		$query = $this->db->query($sql);
		$row=$query->row_array();
		return $row['job_id'];
	}
	
	function get_list($start,$limit,$searchterm,$sort_by)
	{
		$sql="select a.*,(select count(job_app_id) from pms_job_apps where job_id=a.job_id)as total_apps,b.* from ".$this->table_name." a left join pms_company b on a.company_id=b.company_id ";
		$cond='';
		
		if($searchterm!='')
		{
			if($cond!=''){
				$cond=" and a.job_title like '%" . $searchterm . "%'";
			} 
			else{
				$cond=" a.job_title like '%" . $searchterm . "%'";
			}  
		} 
		
		$cond=" a.job_title like '%" . $searchterm . "%'";
		if($cond!='') $cond=' where '.$cond;
		$sql=$sql.$cond;

		$sql.=" order by a.job_id ".$sort_by." limit ".$start.",".$limit;
		
		$query = $this->db->query($sql);
		return $query->result_array();
	
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
				'job_title'=> $this->input->post('job_title') ,
				'company_id' => $this->input->post('company_id') ,
				'job_desc' => $this->input->post('job_desc') ,
				'job_cat_id'=> $this->input->post('job_cat_id') ,
				'func_id'=> $this->input->post('func_id') ,
				'job_type_id' => $this->input->post('job_type_id'),
				'job_location'=> $this->input->post('job_location'),
				'res_location'=> $this->input->post('res_location') ,
				'vacancies'=> $this->input->post('vacancies') ,
				'job_post_date'=> $this->input->post('job_post_date') ,
				'job_expiry_date' => $this->input->post('job_expiry_date'),
				'gender' => $this->input->post('gender'),
				'desired_profile'=> $this->input->post('desired_profile') ,
				'brochure' => $this->upload_file_name,
				'level_id' => $this->input->post('level_id'),				
				'about_company' => $this->input->post('about_company'),
				'job_contact' => $this->input->post('job_contact'),
				'salary_id' => $this->input->post('salary_id'),
				'exp_join_date' => $this->input->post('exp_join_date'),
				'job_keywords' => $this->input->post('job_keywords'),
				'job_skills' => $this->input->post('parent'),
				'work_level_id' => $this->input->post('work_level_id'),
				'contact_name' => $this->input->post('contact_name'),
				'contact_designation' => $this->input->post('contact_designation'),
				'contact_email' => $this->input->post('contact_email'), 
				'contact_phone' => $this->input->post('contact_phone'),
				'contact_website' => $this->input->post('contact_website'),
				'country_id' => $this->input->post('country_id'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'googleplus' => $this->input->post('googleplus'),
				'linkedin' => $this->input->post('linkedin'),
				'social_title'        => $this->input->post('social_title'),	
				'social_content'      => $this->input->post('social_content'),	
				'social_link'         => $this->input->post('social_link'),	
				'social_link_image'   => $this->input->post('social_link_image'),	
				'social_comment'      => $this->input->post('social_comment'),					
				);	
					
        $this->db->insert($this->table_name, $data);
		$this->new_id=$this->db->insert_id();
		return $this->new_id;		
    }

	function apply_job($candidate_id,$job_id)
	{
		
		$data=array(
					'job_id'=> $job_id ,
					'candidate_id' =>  $candidate_id,
					'applied_on' => date('Y-m-d') ,
					'cover_letter'=> '' ,
					'app_status_id'=> 1
					);
		$id=$this->db->insert('pms_job_apps', $data);
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
				print_r($val);
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
		
	
	function child_skill()
	{
		 $id=$this->input->get('id');
		//~ $id=1;
		$this->data['skillset']=$this->jobsmodel->get_child_skills($id);
		echo json_encode($this->data);
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
						'app_status_id'=> 1
						);
			$this->db->insert('pms_job_apps', $data);
			}
		}		
	}

	function get_filter_count($id)
	{
	
		$sql='select DISTINCT count(a.candidate_id)as total_rec from  pms_candidate a ';

		$where=' where a.candidate_id not in(select candidate_id from pms_job_apps where job_id='.$id.') ';

		if($this->input->post('exp_years')!='')
		{
			if($where!='')
			{
				$where.=' and a.exp_years >='.$this->input->post('exp_years');
			}else
			{
				$where.=' a.exp_years >='.$this->input->post('exp_years');
			}
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
	
		$query = $this->db->query($sql);
		

		$row=$query->row_array();
		return $row['total_rec'];
	}

	function get_filter_records($id,$start,$limit)
	{
		$records=array();

		$sql='select DISTINCT a.candidate_id,a.first_name,a.last_name,a.username, a.cv_file,a.exp_years,a.linkedin_url,a.gender,a.exp_years,(select DISTINCT candidate_id from pms_job_apps_emails where candidate_id=a.candidate_id and job_id='.$id.')as emailed from  pms_candidate a ';
		
		$where=' where a.candidate_id not in(select candidate_id from pms_job_apps where job_id='.$id.') ';

				if($this->input->post('exp_years')!='')
		{
			if($where!='')
			{
				$where.=' and a.exp_years >='.$this->input->post('exp_years');
			}else
			{
				$where.=' a.exp_years >='.$this->input->post('exp_years');
			}
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
		'candidate_id'=> $_SESSION['candidate_session'],
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
		//'candidate_id'=> $_SESSION['candidate_session'],
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
		'message_title'=> $this->input->post('message_title'),
		'message_text'=> $this->input->post('message_text'),
		'message_date' => $message_date,
		'candidate_id'=> $_SESSION['candidate_session'],
		);
		$id=$this->db->insert('pms_candidate_messages', $data);
		return $id;
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
	function update_record($id='')
	{
		if($id=='')return;
		
				$data=array(
				'job_title'=> $this->input->post('job_title') ,
				'company_id' => $this->input->post('company_id') ,
				'job_desc' => $this->input->post('job_desc') ,
				'job_cat_id'=> $this->input->post('job_cat_id') ,
				'func_id'=> $this->input->post('func_id') ,
				'job_type_id' => $this->input->post('job_type_id'),
				'job_location'=> $this->input->post('job_location'),
				'res_location'=> $this->input->post('res_location') ,
				'vacancies'=> $this->input->post('vacancies') ,
				'job_post_date'=> $this->input->post('job_post_date') ,
				'job_expiry_date' => $this->input->post('job_expiry_date'),
				'gender' => $this->input->post('gender'),
				'desired_profile'=> $this->input->post('desired_profile') ,
				'brochure' => $this->upload_file_name,
				'level_id' => $this->input->post('level_id'),				
				'about_company' => $this->input->post('about_company'),
				'job_contact' => $this->input->post('job_contact'),
				'salary_id' => $this->input->post('salary_id'),
				'exp_join_date' => $this->input->post('exp_join_date'),
				'job_keywords' => $this->input->post('job_keywords'),
				'job_skills' => $this->input->post('parent'),
				'work_level_id' => $this->input->post('work_level_id'),
				'contact_name' => $this->input->post('contact_name'),
				'contact_designation' => $this->input->post('contact_designation'),
				'contact_email' => $this->input->post('contact_email'), 
				'contact_phone' => $this->input->post('contact_phone'),
				'contact_website' => $this->input->post('contact_website'),
				'country_id' => $this->input->post('country_id'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'googleplus' => $this->input->post('googleplus'),
				'linkedin' => $this->input->post('linkedin'),
				'social_title'        => $this->input->post('social_title'),	
				'social_content'      => $this->input->post('social_content'),	
				'social_link'         => $this->input->post('social_link'),	
				'social_link_image'   => $this->input->post('social_link_image'),	
				'social_comment'      => $this->input->post('social_comment'),					
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
		$query = $this->db->query('SELECT a.*,b.applied_on,b.candidate_id,b.rejected_by,b.app_status_id,c.job_title,d.company_name,e.*,f.*,g.*,h.*,j.* FROM `pms_candidate` a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_jobs c on b.job_id=c.job_id inner join pms_company d on c.company_id=d.company_id left join pms_job_apps_interviews e on b.job_app_id=e.job_app_id left join pms_job_apps_shortlisted f on b.job_app_id=f.app_id left join pms_job_apps_selected g on b.job_app_id=g.app_id left join pms_job_apps_offerletter h on b.job_app_id=h.app_id left join pms_candidate_job_search j on j.candidate_id=a.candidate_id where c.job_id='.$job_id.' order by b.applied_on');
	
		$dropdowns = $query->result_array();	

		return $dropdowns;
	}


	function get_candidate_list($job_id)
	{
		if($job_id=='')return;
		$query = $this->db->query('select DISTINCT a.username,a.first_name,a.linkedin_url,a.last_name,a.mobile,a.candidate_id,a.cv_file,b.applied_on,b.job_app_id,b.job_id,c.first_name,b.current_ctc,b.notice_period,b.total_experience,b.expected_ctc,(select count(*) from pms_job_apps_calls where candidate_id=a.candidate_id and app_id=b.job_app_id)as total_calls,(select call_date from pms_job_apps_calls where candidate_id=a.candidate_id and app_id=b.job_app_id order by app_call_id desc limit 0,1)as last_call_date,(select call_notes from pms_job_apps_calls where candidate_id=a.candidate_id and app_id=b.job_app_id  order by app_call_id desc limit 0,1)as last_call_note,(select cur_job_status from pms_job_apps_calls where candidate_id=a.candidate_id and app_id=b.job_app_id  order by app_call_id desc limit 0,1)as cur_job_status from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id left join pms_candidate c on b.candidate_id=c.candidate_id left join pms_candidate_job_search d on a.candidate_id=d.candidate_id where b.job_id='.$job_id.'  and app_status_id=1 order by b.applied_on desc');
		
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
		$query = $this->db->query('select a.*,b.job_app_id,b.rejected_on,b.reason_for_reject,c.first_name from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id left join pms_candidate c on b.rejected_by=c.candidate_id where b.job_id='.$job_id.'  and app_status_id=2 order by b.applied_on desc');
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

	function get_shortlisted_client($job_id)
	{
		if($job_id=='')return;
		$query = $this->db->query('select a.*,b.*,c.short_id,c.app_id,c.short_date,d.* from pms_candidate a inner join pms_job_apps b on a.candidate_id=b.candidate_id inner join pms_job_apps_shortlisted c on b.job_app_id=c.app_id inner join pms_jobs d on b.job_id=d.job_id where b.job_id='.$job_id);
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

	function reject_from_application($job_app_id)
	{

		$data_reject=array(
				'job_app_id'=> $this->input->get('job_app_id'),
				'rejected_on' => date('Y-m-d') ,
				'reason_for_reject' => 1,
				'app_status_id' => 2,
				'rejected_by'=> $_SESSION['candidate_session']
				);

		$this->db->where('job_app_id', $this->input->get('job_app_id'));
	   	$this->db->update('pms_job_apps', $data_reject);
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

}
?>