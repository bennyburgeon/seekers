<?php 
class Tickets extends CI_Controller {

	function Tickets()
	{
		parent::__construct();
	  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
	  $this->data['cur_page']=$this->router->class;
		$this->load->model('ticketsmodel');
	}
	function editor($path,$width) {
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
  }
	function index($offset = 0)
	{	
		
		$this->load->library('pagination');
		$searchterm='';
		$start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
				$limit= $_GET['limit'];
		}
		else{
		 $limit=5;
		}

		$rows='';
		
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
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
				$searchterm= $_GET['searchterm'];
		}

		$this->data['total_rows']= $this->ticketsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."tickets/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
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
		
		$this->data["page_head"]= "Manage Tickets";
		// paging ends here
		$this->data["records"] = $this->ticketsmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;

		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header',$this->data);
		$this->load->view('tickets/list',$this->data);	
		$this->load->view('include/footer',$this->data);		
		
	}
	
	function add()
	{	
		$this->data['formdata']=array(
		'ticket_title' => '',
		'ticket_description'         => '',
		'ticket_date'       => '',
		'ticket_time'           => '',
		'ticket_status_id'      => '',
		'ticket_priority_id'       => '',
		'candidate_id'           => '',
		'name'         => '',
		'email'         => '',
		'phone'        => '',
		'status'        => ''		
		);
		
		
		
		$this->load->model('ticketsmodel');
			
		$this->data["tickets_status_list"] = $this->ticketsmodel->status_list();
		$this->data["tickets_priority_list"] = $this->ticketsmodel->priority_list();
		$this->data["candidate_list"] = $this->ticketsmodel->candidate_ddl();

		if($this->input->post('name'))
		{
			$this->form_validation->set_rules('name', 'name', 'required');
			$this->form_validation->set_rules('check_dups', 'Name', 'callback_check_dups');

			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->ticketsmodel->insert_record(); 
				redirect('tickets/?ins=1');
			}
				// load page again for validation
				$this->data['formdata']=array(						
						'ticket_title' => $this->input->post('ticket_title'),
						'ticket_description' => $this->input->post('ticket_description'),
						'ticket_date' => $this->input->post('ticket_date'),
						'ticket_time' => $this->input->post('ticket_time'),
						'ticket_status_id' => $this->input->post('ticket_status_id'),
						'ticket_priority_id' => $this->input->post('ticket_priority_id'),
						'candidate_id' => $this->input->post('candidate_id'),
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'phone' => $this->input->post('phone'),
						'status' => $this->input->post('status')			
				);
		}
		
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);	
	     	$this->data['page_head']= 'Add Tickets';	
			$this->load->view('include/header',$this->data);
			$this->load->view('tickets/add',$this->data);				
			$this->load->view('include/footer',$this->data);				
	}

// edxit and update pages here 

	function edit($id=null)
	{
		if(!empty($id))
		{
			$this->data['page_head']= 'Edit Tickets';
			$this->db->where('ticket_id', $id);
			$query=$this->db->get('pms_tickets');
			
			$this->data['formdata']=$query->row_array();
			
			$this->load->model('ticketsmodel');
				
			$this->data["tickets_status_list"] = $this->ticketsmodel->status_list();
			$this->data["tickets_priority_list"] = $this->ticketsmodel->priority_list();
			$this->data["candidate_list"] = $this->ticketsmodel->candidate_ddl();		
			$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);	
			$this->load->view('include/header',$this->data);
			$this->load->view('tickets/edit',$this->data);				
			$this->load->view('include/footer',$this->data);	
		}
	}
	
	function update($id=null)
	{
		$id=$this->input->post('ticket_id');
		$this->data['page_head']= 'Edit Tickets';
		$this->load->model('ticketsmodel');
		if(!empty($id))
		{
			if($this->input->post('name'))
			{
				$this->form_validation->set_rules('name', 'name', 'required');
				$this->form_validation->set_rules('name', 'Name', 'callback_check_dups');

					if ($this->form_validation->run() == TRUE)
					{
						$id=$this->ticketsmodel->update_record($id);
						redirect('tickets/?upd=1');
					}else{
							
						$this->data["tickets_status_list"] = $this->ticketsmodel->status_list();
						$this->data["tickets_priority_list"] = $this->ticketsmodel->priority_list();
						$this->data["candidate_list"] = $this->ticketsmodel->candidate_ddl();

						$this->data['formdata']=array(		
								'ticket_id' => $this->input->post('ticket_id'),		
								'ticket_title' => $this->input->post('ticket_title'),
								'ticket_description' => $this->input->post('ticket_description'),
								'ticket_date' => $this->input->post('ticket_date'),
								'ticket_time' => $this->input->post('ticket_time'),
								'ticket_status_id' => $this->input->post('ticket_status_id'),
								'ticket_priority_id' => $this->input->post('ticket_priority_id'),
								'candidate_id' => $this->input->post('candidate_id'),
								'name' => $this->input->post('name'),
								'email' => $this->input->post('email'),
								'phone' => $this->input->post('phone'),
								'status' => $this->input->post('status')			
						);
									$path = '../js/ckfinder';
			$width = '700px';
			$this->editor($path, $width);	
					$this->load->view('include/header');
					$this->load->view('tickets/edit',$this->data);				
					$this->load->view('include/footer');	
				}
			}else
			{
				redirect('tickets');
			}			
		}else
		{
			redirect('tickets');
		}
	}
	
	function delete($id=null)
	{
		$this->load->model('ticketsmodel');
		if(!empty($id))
		{
			$id=$this->ticketsmodel->delete($id);
			redirect('tickets/?del=1');
		}elseif(is_array($this->input->post('delete_rec')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
				{
					$id=$this->ticketsmodel->delete($val);
				}
			redirect('tickets/?del=1');
		}else
		{
			redirect('tickets');
		}
	}
	
	function check_dups()
	{
		$this->db->where('ticket_title', $this->input->post('ticket_title'));
		if($this->input->post('ticket_id') > 0)	$this->db->where('ticket_id !=', $this->input->post('ticket_id'));
		$query = $this->db->get('pms_tickets');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Ticket Title already used.');
			return false;
		}
	}
	function followup($id)
	{
		//$user = $_SESSION['vendor_session'];
  		if(isset($_SESSION['vendor_session'])!=''){
			$this->load->model('ticketsmodel');
			$this->load->model('usersmodel');
			
			$this->data['row_ticket']=$this->ticketsmodel->get_ticket($id);
			$customer_id = (int) $this->data['row_ticket']['candidate_id'];
			$this->data['row_user']=$this->usersmodel->single_user($customer_id);
			$this->data["tickets_status_list"] = $this->ticketsmodel->status_list();
			$this->data["followup_list"] = $this->ticketsmodel->get_followup_list($id);
			$this->data['logged_user_details'] = $this->ticketsmodel->logged_user_details();
			
			
			
				
			$this->load->view('include/header',$this->data);
			$this->load->view('tickets/followup',$this->data);				
			$this->load->view('include/footer',$this->data);	
		}
		else{
  			redirect('home/logout');
  		}		
	}
	function addfllowup($id='')
	{
		$this->load->model('ticketsmodel');
		$this->load->model('usersmodel');
		$ticket_id = $id;
		if(isset($_POST['title']) && $id!='')
		
		{
			
			$data=array(
				'ticket_id'=> $id,
				'tkt_fp_description' => $_POST['description'],
				'title' => $_POST['title'],
				'tkt_status_id' => $_POST['status'],
				'tkt_fp_date'  => date("Y-m-d", strtotime($_POST['date']))
				);
				$this->db->insert('pms_tickets_followup', $data);	
				$id=$this->db->insert_id();
				$this->load->model('ticketsmodel');
				
				
				
			//	if(isset($_POST['followup_mail'])){
				
				
					$data["candidateId"] = $this->ticketsmodel->getTicketCandidate($ticket_id);
					
					$data['candidateMail'] = $this->ticketsmodel->getcandidateMail($data["candidateId"]["candidate_id"]);
					
					$data['logged_user_details'] = $this->ticketsmodel->logged_user_details();
					
					
					
					$subject = 'Ticket Followup';
		$logopath = base_url('assets/images/logo.png');
		$fb = base_url('assets/images/p_icon8.png');;
		$twtr = base_url('assets/images/p_icon9.png');;
		$lkdn = base_url('assets/images/p_icon10.png');;
		$mail_body		=	'	
		<!DOCTYPE html>
			<head>
			
			<title>GreenOaksProperty.com</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
			
			<style type="text/css">
			
			body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
			html{width: 100%; }
			img {border:0px;text-decoration:none;display:block; outline:none;}
			a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
			table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  
			
			img[class=imageScale]			{}
			
			.main-bg{ background:#3b3b3b;}
			.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
			.space1{padding:35px 35px 35px 35px;}
			.contact-space{padding:15px 24px 15px 24px;}
			table[class=social]{ text-align:right;}
			.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
			.border-bg{ border-top:#67bd3c solid 4px;}
			.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
			.borter-inner-top{ border-top:#37a166 solid 1px;}
			.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
			.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
			.header-space{padding:0px 20px 0px 20px;}
			
			@media only screen and (max-width:640px)
			
			{
				body{width:auto!important;}
				.main{width:440px !important;margin:0px; padding:0px;}
				.two-left{width:440px !important; text-align: center!important;}
				.two-left-inner{width: 376px !important; text-align: center!important;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			
			@media only screen and (max-width:479px)
			{
				 body{width:auto!important;}
				.main{width:280px !important;margin:0px; padding:0px;}
				.two-left{width: 280px !important; text-align: center!important;}
				.two-left-inner{width: 216px !important; text-align: center!important;}
				.space1{padding:35px 0px 35px 0px;}
				table[class=social]{ width:100%; text-align:center; margin-top:20px;}
				table[class=contact]{ width:100%; text-align:center; font:12px;}
				.contact-space{padding:15px 0px 15px 0px;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			</style>
			</head>
			
			<body>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
			  <tr>
				<td align="center" valign="top" style="padding:50px 0px 50px 0px;">
				
			  <!--  Main Table Start-->
				
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top">
					
					<!--  Header Part Start-->
					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
							<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>
						  </tr>
						</table></td>
					  </tr>
					  </table>
					  
					  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">

				  <tr>
					<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space">
					
					
					 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					   <tr>
			
						 <td align="center" valign="top">
						 
						 <!--  Logo Part Start-->
						 
						  <table border="0" align="left" cellpadding="0" cellspacing="0" class="two-left">
					  <tr>
					   <td align="center" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"><img src="'.$logopath.'" width="141" height="42" alt="" /></td>
					  </tr>
					</table>
					
					<!--  Logo Part End-->
					
					<!--  Call Part Start-->
					<table  border="0" align="right" cellpadding="0" cellspacing="0" class="two-left">
			  <tr>
				  <td align="center" valign="bottom" style="font:Bold 15px Arial, Helvetica, sans-serif; color:#67bd3c; padding-top:18px;"><span style="color:#3b3b3b;">Call Us :</span> '.$this->config->item("mobile").'</td>
			  </tr>
			</table>
			<!--  Call Part End-->
						 
						 </td>
					   </tr>
					 </table></td>
					</tr>
				</table></td>
				</tr>
			</table>
			
			<!--  Banner Part Start-->
			<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top">&nbsp;</td>
				</tr>
			  <tr>
				<td align="left" valign="top">
				
				<!--  Banner Text Start-->
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$data["candidateMail"]['first_name'].',</strong><br />
							<br /><p>
						  	Your Ticket Followed up by '.$data["logged_user_details"]["firstname"].'
						  </p>
						  <p>Thank You ! <br>
						  CRM</p></td>
						</tr>
					  </table></td>
				  </tr>
				  </table>
				<!--  Banner Text End-->
				
				</td>
			  </tr>
			</table>
			
			<!--  Banner Part End-->
			
			<!--  Header Part End-->
			
			
					  
					  </td>
				  </tr>
				  
				  <tr>
					<td align="left" valign="top">
					<!--  Footer Part Start-->
					<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
					  
					  
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
					 <p style="text-align:center; font-weight:bold;">5 stripes - your custom mixed organic cereals.</p><br />
			
			<br />
			<center>
			'.$this->config->item("address").'</center></p></td>
					  </tr>
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
						
						<!--  Social Media Part Start-->
						<table width="102" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$fb.'" width="27" height="28" alt="" /></a></td>
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$twtr.'" width="27" height="28" alt="" /></a></td>
					 
			
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$lkdn.'" width="27" height="28" alt="" /></a></td>
				
						  </tr>
						</table>
						<!--  Social Media Part End-->
						
						</td>
					  </tr>
					</table>
					<!--  Footer Part End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Main Table End-->
				
				</td>
			  </tr>
			</table>
			</body>
			
			</html>
		';
					$this->load->library('email');
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					$this->email->from($data['logged_user_details']['email'],$data['logged_user_details']['firstname']);
					$this->email->to($data['candidateMail']['username']);
					$this->email->subject($subject);
					$this->email->message($mail_body);
					$this->email->send();
				//}
				$this->data['followup_list']=$this->ticketsmodel->select_record($id);
				$dataArr = $this->load->view('tickets/ticketfollowup_list', $this->data,TRUE);

				echo $dataArr;
				//$data= $this->ticketsmodel->get_ticket_followup($id);
				//$data['action'] = 'add';
		}
		
		
	}
	function delfllowup(){
		 $_POST['tkt_fp_id'];
		$this->load->model('ticketsmodel');
		if(isset($_POST['tkt_fp_id']))		
		{			
			$this->db->where('tkt_fp_id', $_POST['tkt_fp_id']);
			$this->db->delete('pms_tickets_followup'); 
			echo '<div class="alert alert-success">Record Deleted</div>';
		}else
		{
			redirect('tickets');
		}
	}
	function updatefllowup(){
		$this->load->model('ticketsmodel');
		if(isset($_POST['tkt_fp_id']))		
		{			
			$data= $this->ticketsmodel->get_ticket_followup($_POST['tkt_fp_id']);
			$data['success'] = 'true';
			
		}else
		{
			$data=array('success' => 'false');
		}
		echo json_encode($data);
	}
	
	function changestat($id=null)
	{
		if($id=='')redirect('tickets');
		if($this->input->get('stat')=='')redirect('tickets');
		$this->db->query("update pms_tickets set status=".$this->input->get('stat')." where ticket_id=".$id);
		redirect('tickets?stat=1');

	}
}
?>
