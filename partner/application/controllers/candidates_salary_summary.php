<?php 
class Candidates_salary_summary extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		//$_SESSION['vendor_session']=1;
		$this->load->model('statemodel');
		$this->load->model('countrymodel');
		$this->load->model('citymodel');
		$this->load->model('candidates_salary_summarymodel');
		$this->data['cur_page']=$this->router->class;
	}
	
	function editor($path,$width) 
	{
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
	
	function index()
	{	
		$this->load->library('pagination');
		$this->load->model('candidates_salary_summarymodel');
		
		$this->data['search_name']='';
		$this->data['start']=0;
		$this->data['limit']=100;
		$this->data['rows']='';
		
		
        if($this->input->get('limit')!='')
		{
			$this->data['limit']=$this->input->get("limit");
		}
		else
		{
			$this->data['limit'] =50;
		}

		if($this->input->get('sort_by')!='')
		{
			$this->data['sort_by']=$this->input->get("sort_by");
		}
		else
		{
			$this->data['sort_by'] = 'asc';
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['start']=$this->input->get("rows");
		}
		
		if($this->input->get("rows")!='')
		{
			$this->data['rows']=$this->input->get("rows");
		}
		
		if($this->input->get('search_name'))
		{
			$this->data['search_name']=$this->input->get('search_name');
		}

		if($this->input->post('search_name'))
		{
			$this->data['search_name']=$this->input->post('search_name');
		}
		
		
		$this->data['total_rows']= $this->candidates_salary_summarymodel->record_count($this->data['search_name']);
		
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		
		$config['base_url'] = $this->config->item('base_url')."candidates_salary_summary/?sort_by=".$this->data['sort_by']."&limit=".$this->data['limit']."&search_name=".$this->data['search_name'];
		
			
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$this->data['limit'];
		$config['num_links'] = 10;
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
		
	
		$this->data["records"] = $this->candidates_salary_summarymodel->get_list($this->data['start'],$this->data['limit'],$this->data['search_name'],$this->data['sort_by']);
		
			
		$this->data['page_head'] = 'Candidates Salary based Report';				

	
		$this->load->view('include/header',$this->data);
		$this->load->view('candidates_salary_summary/list',$this->data);
		$this->load->view('include/footer',$this->data);
	}	
	


	

	function check_dups()
	{
		$this->db->where('company_name', $this->input->post('company_name'));
		if($this->input->post('app_id') > 0)	$this->db->where('app_id !=', $this->input->post('app_id'));
		$query = $this->db->get('pms_job_apps');
		
		if ($query->num_rows() == 0)
			return true;
		else{
			$this->form_validation->set_message('check_dups', 'Company name already used.');
			return false;
		}
	}
	
	public function getstate()
	{
		$this->load->model('statemodel');
		if(isset($_POST['country_id']) && $_POST['country_id']!='')
		{
			$data=array();
			$data["state_list"] = $this->statemodel->state_list_by_city($_POST['country_id']);
			$data = array('success' => true, 'state_list' => $data["state_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function getcity()
	{ 
		$this->load->model('citymodel');
		
		if(isset($_POST['state_id']) && $_POST['state_id']!='')
		{
			$data=array();
			$data["city_list"] = $this->citymodel->city_list_by_state($_POST['state_id']);
			$data = array('success' => true, 'city_list' => $data["city_list"]);
		}else{
			$data = array('success' => false);
		}
		echo json_encode($data);
	}
	
	public function sentmail($id = '',$username = '')
	{
		$id       = $this->input->get('candidate_id');
		
		    $this->db->where('candidate_id',$id);
			$this->db->delete('pms_candidate_email');
			
			$data =array(
			'candidate_id' => $id,
			'email_date'   => date('Y-m-d'),
			'email_status' =>1
			);
		$this->db->insert('pms_candidate_email', $data);
		
		$query = $this->db->query("select md5(concat(candidate_id,username)) as candidate_hash,first_name,last_name,username from pms_candidate where candidate_id='".$id."'");
		$row = $query->row_array();
			
		$subject = ' Candidate Profile Updation ';
		
		$mail_body='<!DOCTYPE html>
			<head><title>'.$this->config->item('websites').' - Reset Password</title>
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
					<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
					   <tr>
			
						 <td align="center" valign="top">

					
					<!--  Call Part Start-->
					<table  border="0" align="right" cellpadding="0" cellspacing="0" class="two-left">
			  <tr>
				  <td align="center" valign="bottom" style="font:Bold 15px Arial, Helvetica, sans-serif; color:#67bd3c; padding-top:18px;"><span style="color:#3b3b3b;">Call Us :</span> Phone:+91 799 485 2225 </td>
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
						<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$row['first_name'].',</strong><br />
							<p>
						  	Please Click here to update your Profile Details:<br>http://'.$this->config->item('websites').'hr.in/register/cvbuilder/?ch='.$row['candidate_hash'].'
						  </p>
						  <p>Thank You ! <br>
						 '.$this->config->item('web_site').'</p></td>
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
					 <p style="text-align:center; font-weight:bold;">'.$this->config->item('web_site').'</p>

			<center>
			'.$this->config->item('company_name').' || '.$this->config->item('powered_by_address').' '.$this->config->item('powered_by_address1').' || Telephone: '.$this->config->item('phone_number').' || Email: '.$this->config->item('company_gmail').'</center></p></td>
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
		
		//echo $mail_body;
		//exit();
		
		$headers="From:". $this->config->item('websites')." \r\n";
		$headers.='Reply-To: '.$this->config->item('websites').'\r\n';
		$headers.='X-Mailer: PHP/' . phpversion().'\r\n';
		$headers.= 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=iso-8859-1 \r\n';
		mail($row['username'], $subject, $mail_body, $headers);
			
			redirect('candidates_salary_summary/');
			exit();
			
		
	}
	
	

}
?>
