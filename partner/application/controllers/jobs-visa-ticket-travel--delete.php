<?php 
class Jobs extends CI_Controller {

	function jobs()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
	}


	function index()
	{	
		$this->load->library('pagination');
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
		if($_GET['limit']!='')
		$limit= $_GET['limit'];
		}
		else{
		$limit=25;
		}
		$rows='';
		$this->load->model('jobsmodel');
		
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
		$sort_by=$this->input->get("sort_by");
		}
		else
		{
		$sort_by = 'asc';
		}
		if($this->input->get("rows")!='')
		{
		$start=$this->input->get("rows");
		}
		if($this->input->get("rows")!='')
		{
		$rows=$this->input->get("rows");
		}
		
		if(isset($_GET['searchterm'])){
		if($_GET['searchterm']!='')
		$searchterm= $_GET['searchterm'];
		}
		$this->data['total_rows']= $this->jobsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."jobs/?sort_by=$sort_by&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
		$config['num_links'] = $this->data['total_rows'];
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['full_tag_close'] = '</ul></div>';
		$this->pagination->initialize($config);
		$this->data['pagination']=$this->pagination->create_links();
		$this->data["records"] = $this->jobsmodel->get_list($start,$limit,$searchterm,$sort_by);

		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
		$this->data['page_head'] = 'Manage Jobs';
				
				
		$this->load->view('include/header');
		$this->load->view('jobs/listjob',$this->data);				
		$this->load->view('include/footer');

		
	}	

	function manage($id=null)
	{

		$this->data['current_head']='summary';
		$this->data['page_head']= 'View Details';
		$this->data['upload_root']=$this->config->item('base_url');
		
		$this->load->model('jobsmodel');
		$this->load->model('countrymodel');
		$this->load->model('companymodel');
		$this->load->model('jobindmodel');
		$this->load->model('jobcatmodel');
		$this->load->model('jobareamodel');
		
		$this->load->model('jobtypemodel');
		$this->load->model('worklevelmodel');
		$this->load->model('levelmodel');
		$this->load->model('salarymodel');
		$this->load->model('skill_mgmt_model');

		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if(!empty($id))
		{
			
			$this->data['page_head']= 'Manage Job';
			$this->db->where('job_id', $id);
			$query=$this->db->get('pms_jobs');
			$this->data['formdata']=$query->row_array();
			
			$this->data['formdata']['company_name']=$this->companymodel->get_company_name($this->data['formdata']['company_id']);
			$this->data['formdata']['industry']=$this->jobindmodel->get_industry_name($this->data['formdata']['job_cat_id']);
			$this->data['formdata']['category']=$this->jobcatmodel->get_category_name($this->data['formdata']['job_cat_id']);
			$this->data['formdata']['fun_area']=$this->jobareamodel->get_fun_area($this->data['formdata']['func_id']);
			
			$this->data['formdata']['job_type']=$this->jobtypemodel->get_job_type($this->data['formdata']['job_type_id']);
			$this->data['formdata']['job_level']=$this->levelmodel->get_level_name($this->data['formdata']['level_id']);
			$this->data['formdata']['work_level']=$this->worklevelmodel->get_work_level($this->data['formdata']['work_level_id']);	
			$this->data['formdata']['salary_level']=$this->salarymodel->get_salary_range($this->data['formdata']['salary_id']);
			
			$this->data['formdata']['country_name']=$this->countrymodel->get_country_name($this->data['formdata']['country_id']);
			$this->data['formdata']['skill']=$this->skill_mgmt_model->get_skill_name($this->data['formdata']['job_skills']);
			
			$this->data['applied_candidates']=$this->jobsmodel->get_candidate_list($id);
			$this->data['rejected_candidates']=$this->jobsmodel->rejected_candidates($id);
		
			$this->data['shortlisted']=$this->jobsmodel->get_shortlisted($id);
			$this->data['interview_list']=$this->jobsmodel->get_interview_list($id);

			$this->data['candidates_selected']=$this->jobsmodel->candidates_selected($id);
			$this->data['offer_letters_issued']=$this->jobsmodel->offer_letters_issued($id);
			$this->data['offer_accepted']=$this->jobsmodel->offer_accepted($id);
			$this->data['invoice_generated']=$this->jobsmodel->invoice_generated($id);

			$this->data['invoice_list2']=$this->jobsmodel->invoice_generated($id);
			
			$this->data['interview_time_ar']=array(
						'7:00 AM' => '7:00 AM',
						'7:30 AM' => '7:30 AM',
						'8:00 AM' => '8:00 AM',
						'8:30 AM' => '8:30 AM',
						'9:00 AM' => '9:00 AM',
						'9:30 AM' => '9:30 AM',
						'10:00 AM' => '10:00 AM',
						'10:30 AM' => '10:30 AM',
						'11:00 AM' => '11:00 AM',
						'11:30 AM' => '11:30 AM',
						'12:00 PM' => '12:00 PM',
						'12:30 PM' => '12:30 PM',
						'1:00 PM' => '1:00 PM',
						'1:30 PM' => '1:30 PM',
						'2:00 PM' => '2:00 PM',
						'2:30 PM' => '2:30 PM',
						'3:00 PM' => '3:00 PM',
						'3:30 PM' => '3:30 PM',
						'4:00 PM' => '4:00 PM',
						'4:30 PM' => '4:30 PM',
						'5:00 PM' => '5:00 PM',
						'5:30 PM' => '5:30 PM',
						'6:00 PM' => '6:00 PM',
						'6:30 PM' => '6:30 PM',
						'7:00 PM' => '7:00 PM');

		
		$this->data["interview_type"] = $this->interviewtypemodel->get_type_list();
		$this->data["int_status_id"] = $this->interviewstatusmodel->get_model_list();
		
		$this->data["start_date"]= date('Y-m-d', strtotime($this->data["formdata"]['job_post_date'] .'- 30 days'));
		$this->data["end_date"]=date('Y-m-d', strtotime($this->data["formdata"]['job_expiry_date'] .'+ 30 days'));
		
		$this->data["contracts_ending"]=$this->jobsmodel->contracts_ending($id,$this->data["start_date"],$this->data["end_date"]);
		
			$this->load->view('include/header');
			$this->load->view('include/job_sidebar',$this->data);
			$this->load->view('jobs/summary',$this->data);	
			$this->load->view('include/footer');
		}else
		{
			redirect('jobs');
		}
	}


//get certy attestaion details

	function get_cert_attest()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobsmodel');
		
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$formdata =$query->row_array();
		
		$get_cert_attest = $this->jobsmodel->get_cert_attest($id);

		
		$html1='';
		$html2='';
		if(!empty($get_cert_attest)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						Certificate Attestation
					</td>';
					
		   
			$html2 =	'<td colspan="2" align="center" valign="top">
						<table border="1" cellpadding="3" cellspacing="3" width="95%" >
						<tbody >
						<tr>
						 <td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Title</td>
						<td bgcolor="#CCCCCC">Status</td>
						

						<td width="37%" bgcolor="#CCCCCC">Actions</td>
					</tr>';
  				
				foreach($get_cert_attest as $cert_attest){                                    
  				$status='';
				if($cert_attest['status']==1)
				{
					$status="Not Required";
				}
				else if($cert_attest['status']==2)
				{
					$status="Required";
				}
				else if($cert_attest['status']==3)
				{
					$status="Already Done";
				}
				else if($cert_attest['status']==4)
				{
					$status="On Process";
				}
				else if($cert_attest['status']==5)
				{
					$status="Completed";
				}
				$html2.='<tr>
						  <td width="20%"><a href="'.base_url().'candidates_all/summary/'.$cert_attest['candidate_id'].'" target="_blank">'.$cert_attest['first_name'].' '.$cert_attest['last_name'].'</a></td>
						 
						  <td width="30%">'.$cert_attest['title'].'</td>
						  <td width="26%">'.$status.'</td>

						  <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="'.base_url().'jobs/delete_attest/?job_id='.$formdata['job_id'].'&app_id='.$cert_attest['app_id'].'&candidate_id='.$cert_attest['candidate_id'].'&cert_id='.$cert_attest['cert_id'].'" id="delete_attest" >Remove </a>|<a href="'.base_url().'candidates_all/summary/'.$cert_attest['candidate_id'].'" target="_blank"> Profile </a> | <a href="javascript:;" onclick="create_visa('.$formdata['job_id'].','.$cert_attest['app_id'].','.$cert_attest['candidate_id'].');"> Visa Details</a>  </td>';
						
				}
					
    		$html2 .=' </tbody> </table> ';
/* | <a href="javascript:;" onclick="cert_attest('.$formdata['job_id'].','.$cert_attest['app_id'].','.$cert_attest['candidate_id'].','. $cert_attest['placement_id'].');"> Certificate Attestation</a>*/
		}

		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}

//CERT ATTEST
	function cert_attest()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobsmodel');
		$this->load->model('interviewtypemodel');
		$this->load->model('interviewstatusmodel');
		
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' )
		{
			$this->jobsmodel->cert_attest();	
			
			$response = array(
			    
				'status'=>'success',
			);

			header('Content-type: application/json');
			echo json_encode($response);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
	}
	
//get visa details

	function get_visa_details()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobsmodel');
		
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$formdata =$query->row_array();
		
		$visa_details=$this->jobsmodel->visa_details($id);

		
		$html1='';
		$html2='';
		if(!empty($visa_details)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						Visa Follow Up / Visa Receipt 
					</td>';
					
		   
			$html2='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Received Date</td>
						<td bgcolor="#CCCCCC">Visa Number</td>
						<td bgcolor="#CCCCCC">Date of Issue</td>
						<td bgcolor="#CCCCCC">Date of Expiry</td>
						<td bgcolor="#CCCCCC">Verified Passport</td>
						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($visa_details as $visa){
				$verified='';
				if($visa['passport_verified']==1)
				{
					$verified='Yes';
				}
				else if($visa['passport_verified']==2)
				{
					$verified='No';
				}
		   $html2.=' <tr>
                      <td width="13%"><a href="'.base_url().'candidates_all/summary/'.$visa['candidate_id'].'" target="_blank">'.$visa['first_name'].' '.$visa['last_name'].'</a></td>
                      <td width="13%">'.$visa['date'].'</td>
                      <td width="14%">'.$visa['number'].'</td>
                      <td width="13%">'.$visa['date_issued'].'</td>
						<td width="13%">'.$visa['date_expiry'].'</td>
						<td width="10%">'.$verified.'</td>
                       <td><a href="javascript:;" onclick="create_medical('.$formdata['job_id'].','.$visa['app_id'].','.$visa['candidate_id'].');">Create Medical</a>|<a href="javascript:;"  data-url="'.base_url().'jobs/delete_visa/?job_id='.$formdata['job_id'].'&app_id='.$visa['app_id'].'&visa_id='.$visa['visa_id'].'"  id="delete_visa_candidate" >Delete</a></td></tr>';
						
				}
				
				$html2 .=' </tbody> </table> ';
/* | <a href="javascript:;" onclick="cert_attest('.$formdata['job_id'].','.$cert_attest['app_id'].','.$cert_attest['candidate_id'].','. $cert_attest['placement_id'].');"> Certificate Attestation</a>*/
		}


				
				
		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
//CREATE VISA
	function create_visa()
	{
		
		$id =$this->input->post('job_id');
		$this->load->model('jobsmodel');
				
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('date')!='')
		{
			$this->jobsmodel->create_visa();
			
					
    
			$response = array(
			   
				'status'=>'success',
			);

			header('Content-type: application/json');
			echo json_encode($response);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
		
		
	}

//GET VISA PROCESS DOCUMENT


	function get_visa_document()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobsmodel');
		
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$formdata =$query->row_array();
		
		$visa_documents=$this->jobsmodel->visa_documents($id);

		
		$html1='';
		$html2='';
		if(!empty($visa_documents)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						Visa Process Document
					</td>';
					
		   
			$html2='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Mode of Send</td>
						<td bgcolor="#CCCCCC">Send By</td>
						<td bgcolor="#CCCCCC">Send Date</td>

						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($visa_documents as $visa){
				$mode='';
				$send_by='';
				if($visa['send_mode']==1)
				{
					$mode='Courier';
				}
				else if($visa['send_mode']==2)
				{
					$mode='Email';
				}
				
				if($visa['send_by']==1)
				{
					$send_by='Company';
				}
				else if($visa['send_by']==2)
				{
					$send_by='Candidate';
				}
		   $html2.=' <tr>
                      <td width="13%"><a href="'.base_url().'candidates_all/summary/'.$visa['candidate_id'].'" target="_blank">'.$visa['first_name'].' '.$visa['last_name'].'</a></td>
                      <td width="13%">'.$mode.'</td>
                      <td width="14%">'.$send_by.'</td>
                      <td width="36%">'.date('d-m-Y',strtotime($visa['date_send'])).'</td>

                       <td><a href="javascript:;" onclick="create_ticket('.$formdata['job_id'].','.$visa['app_id'].','.$visa['candidate_id'].');"> Ticket & Travel</a>|<a href="javascript:;"  data-url="'.base_url().'jobs/delete_visa_document/?job_id='.$formdata['job_id'].'&app_id='.$visa['app_id'].'&doc_id='.$visa['doc_id'].'"  id="delete_visa_document" >Delete</a></td></tr>';
						
				}
				
				$html2 .=' </tbody> </table> ';

		}


				
				
		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}
	
//GET MEDICAL DETAILS
	function get_medical_details()
	{
		$id =$this->input->post('job_id');
		$this->load->model('jobsmodel');
		
		$this->db->where('job_id', $id);
		$query=$this->db->get('pms_jobs');
		$formdata =$query->row_array();
		
		$medical_details=$this->jobsmodel->medical_details($id);

		
		$html1='';
		$html2='';
		if(!empty($medical_details)){
			$html1 ='
					<td colspan="2" align="center" valign="top"><br>
						
						 Medical Details
					</td>';
					
		   

			
			
			$html2='	 <td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					  <tbody >
					  <tr>
						<td bgcolor="#CCCCCC">Candidate</td>
						<td bgcolor="#CCCCCC">Title</td>
						<td bgcolor="#CCCCCC">Date</td>
						
						<td bgcolor="#CCCCCC">Description</td>

						<td width="37%" bgcolor="#CCCCCC">Action</td>
					 </tr>';
 		
  			foreach($medical_details as $medical){
				
					                        

           
		   $html2.=' <tr>
                      <td width="13%"><a href="'.base_url().'candidates_all/summary/'.$medical['candidate_id'].'" target="_blank">'.$medical['first_name'].' '.$medical['last_name'].'</a></td>
					   <td width="14%">'.$medical['title'].'</td>
                      <td width="13%">'.date('d-m-Y',strtotime($medical['date'])).'</td>
                     
                      <td width="36%">'.$medical['description'].'</td>

                       <td><a href="javascript:;" onclick="create_document('.$formdata['job_id'].','.$medical['app_id'].','.$medical['candidate_id'].');"> Visa Process Document</a>|<a href="javascript:;"  data-url="'.base_url().'jobs/delete_medical/?job_id='.$formdata['job_id'].'&app_id='.$medical['app_id'].'&medical_id='.$medical['medical_id'].'"  id="delete_medical_candidate" >Delete</a></td></tr>';
						
				}
				
				$html2 .=' </tbody> </table> ';

		}


				
				
		$response = array(
			'data1' => $html1,
			'data2' => $html2,
			'status'=>'success',
		);

		header('Content-type: application/json');    					
		echo json_encode($response);
	
	}


//CREATE TRAVEL FOLLOWUP
	function create_followup()
	{
		$this->load->model('jobsmodel');
		$this->load->library('upload');
		$candidate_id = $this->input->post('candidate_id');	
		if($candidate_id!='')
		{ 
			if(isset($_FILES['travel_document']) && $_FILES['travel_document']['error']!=4){
				if (is_uploaded_file($_FILES['travel_document']['tmp_name'])) 
				{       				
					$config['upload_path'] = 'uploads/travel_document/';
					$config['allowed_types'] = 'doc|docx|pdf|txt';
					$config['max_size']	= '0';
					$config['file_name'] = md5(uniqid(mt_rand()));
					$this->upload->initialize($config);	
				
					if ($this->upload->do_upload('travel_document'))
					{
						$this->upload_file_name='';
						$data =  $this->upload->data();	
						$this->upload_file_name=$data['file_name'];		
						$dataArr=array(
		
							'travel_document'       => $this->upload_file_name,		
							'send_by'     			=> $this->input->post('send_by'),
							'send_mode'     		=> $this->input->post('send_mode'),
							'travel_followup'     	=> $this->input->post('travel_followup'),
							'pickup_followup'     	=> $this->input->post('pickup_followup'),
							'travel_confirmation'   => $this->input->post('travel_confirmation'),
							);
						$this->jobsmodel->create_followup($dataArr);
					}

				}
			}
			else
			{ 
				$dataArr=array(
		
							'travel_document'       => '',		
							'send_by'     			=> $this->input->post('send_by'),
							'send_mode'     		=> $this->input->post('send_mode'),
							'travel_followup'     	=> $this->input->post('travel_followup'),
							'pickup_followup'     	=> $this->input->post('pickup_followup'),
							'travel_confirmation'   => $this->input->post('travel_confirmation'),
							);
				$this->jobsmodel->create_followup($dataArr);
			}
			
			if( $this->input->post('send_email')=='yes')
			{ 
				$mode='';
				$send_by='';
				$travel_confirmation='';
				if($this->input->post('send_mode')==1)
				{
					$mode='Courier';
				}
				else if($this->input->post('send_mode')==2)
				{
					$mode='Email';
				}
				
				if($this->input->post('send_by')==1)
				{
					$send_by='Company';
				}
				else if($this->input->post('send_by')==2)
				{
					$send_by='Candidate';
				}
				
				if($this->input->post('travel_confirmation')==1)
				{
					$travel_confirmation='Complete';
				}
				else if($this->input->post('travel_confirmation')==2)
				{
					$travel_confirmation='Uncomplete';
				}
				
				$qry	=$this->db->query('select * from pms_candidate where candidate_id='.$candidate_id);
				$res	=	$qry->row_array();		

				$dataArr=array(
		
								
							'Send By'     			=> $send_by,
							'Send Mode'     		=> $mode,
							'Travel Followup'     	=> $this->input->post('travel_followup'),
							'Pickup Followup'     	=> $this->input->post('pickup_followup'),
							'Travel Confirmation'   => $travel_confirmation,
							); 
// email to candidate
		$email_array=array(
			'email_to'               =>  $res['username'],
			'email_to_name'          =>  $res['first_name'],
			'email_cc'               =>  '',
			'email_from'             =>  'info@abeservices.biz',
			'from_name'              =>  'ABE Services',
			'email_reply_to'         =>  'info@abeservices.biz',
			'email_reply_to_name'    =>  'ABE Services',
			'subject'                =>  'Travel Follow Up Details',
			'salutation'              =>  'Dear '.$res['first_name'].$res['last_name'].',',
			'table_head'             =>  'ABE Services',
			'text_before_table'      =>  '',
			'table_rows'             =>  $dataArr,
			'text_after_table'       =>  '-------------',					
			'signature_name'         =>  'ABE Services',
			'signature'              =>  '',
			'date'                   =>  date('Y-m-d'),
		);		
		$status = $this->send_email($email_array);
			}
			$response_array['status'] = 'success';
			header('Content-type: application/json');
			echo json_encode($response_array);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
		
		
	}

//DELETE TICKET FOLLOWUP

	function delete_followup()
	{
		$id = $this->input->get('ticket_id');
		$job_id = $this->input->get('job_id');
		$c_id = $this->input->get('candidate_id');
		$app_id = $this->input->get('app_id');
		$p_id = $this->input->get('placement_id');
		
		$this->load->model('jobsmodel');		
		if($this->input->get('ticket_id')!='')
		{
			$result = $this->db->query('SELECT * FROM pms_job_apps_invoice WHERE placement_id ='.$p_id)->result();
			
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{
					$query = $this->db->query("select travel_document from pms_job_apps_ticket where ticket_id=".$id);
					
					if ($query->num_rows() > 0)
					{
						$row = $query->row_array();
						if(file_exists('uploads/travel_document/'.$row['travel_document']) && $row['travel_document']!='')
						{	
							unlink('uploads/travel_document/'.$row['travel_document']);
						}
						$this->db->query("update  pms_job_apps_ticket set travel_document='' where ticket_id=".$id);
						$this->jobsmodel->delete_followup($id);
					}
					else
					{
						$this->jobsmodel->delete_followup($id);
					}
					
					$response = array(
						'status' => 'success',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
			
			
		}	
	}
		
//CREATE DOCUMENT
	function create_doc()
	{
		
		$id =$this->input->post('job_id');
		$this->load->model('jobsmodel');
				
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('send_mode')!='')
		{
			$this->jobsmodel->create_doc();
			
    
			$response = array(
			    
				'status'=>'success',
			);

			header('Content-type: application/json');
			echo json_encode($response);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
		
		
	}
	
//CREATE MEDICAL
	function create_medical()
	{
		
		$id =$this->input->post('job_id');
		$this->load->model('jobsmodel');
				
		if($this->input->post('app_id')!='' && $this->input->post('candidate_id')!='' && $this->input->post('date')!='')
		{
			$this->jobsmodel->create_medical();
			
    
			$response = array(
			    
				'status'=>'success',
			);

			header('Content-type: application/json');
			echo json_encode($response);

		}
		else
		{
			$response_array['status'] = 'failure';
			header('Content-type: application/json');
			echo json_encode($response_array);
		}	
		
		
	}
	
//DELETE ATTEST
	function delete_attest()
	{
		
		$id     = $this->input->get('cert_id');
		$job_id     = $this->input->get('job_id');
		
		$this->load->model('jobsmodel');		
		
		if($this->input->get('cert_id')!='')
		{

			/*$result = $this->db->query('SELECT * FROM pms_job_apps_cert WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
				
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{*/
					
					$result = $this->db->query('DELETE FROM pms_job_apps_cert WHERE cert_id ="'.$id.'"');
					
					$response = array(
						
						'status'=>'success',
						
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			//}
		}
			
		
	}

//DELETE VISA DOCUMENT
	function delete_visa_document()
	{
		
		$id     = $this->input->get('doc_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobsmodel');		
		
		if($this->input->get('doc_id')!='')
		{ 
			/*$result = $this->db->query('SELECT * FROM pms_job_apps_document WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
				
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{	*/			
				$result = $this->db->query('DELETE FROM pms_job_apps_document WHERE doc_id ="'.$id.'"');

				
				$response = array(
					
					'status'=>'success',
					
				);

					header('Content-type: application/json');    					
					echo json_encode($response);
			//}
		}
		}
		
//DELETE VISA DETAILS
	function delete_visa()
	{
		
		$id     = $this->input->get('visa_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobsmodel');		
		
		if($this->input->get('visa_id')!='')
		{ 
			$result = $this->db->query('SELECT * FROM pms_job_apps_medical WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
				
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{				
				$result = $this->db->query('DELETE FROM pms_job_apps_visa WHERE visa_id ="'.$id.'"');

				
				$response = array(
					
					'status'=>'success',
					
				);

					header('Content-type: application/json');    					
					echo json_encode($response);
			}
		}
		}

//DELETE MEDICAL DETAILS
	function delete_medical()
	{
		
		$id     = $this->input->get('medical_id');
		$job_id = $this->input->get('job_id');
		
		$this->load->model('jobsmodel');		
		
		if($this->input->get('medical_id')!='')
		{
			/*$result = $this->db->query('SELECT * FROM pms_job_apps_ticket WHERE app_id ="'.$this->input->get('app_id').'" ' )->result();
				//echo $this->db->last_query();
			if(!empty($result))
			{
					$response = array(
						'status' => 'failed',
					);

					header('Content-type: application/json');    					
					echo json_encode($response);
			
			}			
			
			else
			{	*/			
				$result = $this->db->query('DELETE FROM pms_job_apps_medical WHERE medical_id ="'.$id.'"');

				$response = array(
					
					'status'=>'success',
					
				);

					header('Content-type: application/json');    					
					echo json_encode($response);
			//}
		}
		}

}
?>
