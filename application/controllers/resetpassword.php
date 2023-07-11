<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resetpassword extends CI_Controller {

	function __construct()
	{
	   	parent::__construct();
		 $this->data['page_name']= '';
		 $this->data['page_title']= 'Seekers Consultancy LLC';
		 $this->data['page_content']= '';
		 $this->data['page_short_content']= '';
		 $this->data['seo_title']= 'Seekers Consultancy LLC';
		 $this->data['seo_keyword']= 'Seekers Consultancy LLC';
		 $this->data['seo_meta_desc']= 'Seekers Consultancy LLC';
		 $this->data['page_banner']= 'Seekers Consultancy LLC';
	}
	
	public function index()
	{
		$this->data['pass_status'] = '';
		
		if($this->input->post('candidate_id'))
		{
			$array=array(
					'password' => md5($this->input->post('password'))
					);
					
			 $this->db->update('pms_candidate_password_change', array('status'=>0), array('md5(candidate_id)' =>$this->input->post('candidate_id')));
			 $this->db->update('pms_candidate', $array,array('md5(candidate_id)' => $this->input->post('candidate_id')));
			 $this->send_confirmation($this->input->post('candidate_id'));	
			 redirect('login');
		}
		
		if($this->input->get('candidate_id'))
		{
			$this->data['candidate_id'] = $this->input->get('candidate_id');
		}else{
			exit();
		}
		
		$this->data['pass_status']='';
		$query = $this->db->query("select * from pms_candidate_password_change where md5(candidate_id)='".$this->data['candidate_id']."'");
	   	$this->data['pass_status'] = $query->row_array();
		$this->load->view('forgottonpassword/reset_password',$this->data);
	}
	
	public function sendpasswordlink()
	{
		
		
		//echo "SELECT * from pms_candidate where username='".$this->input->post('username')."'";
		//exit();
		if($this->input->post('username'))
		{
			$query = $this->db->query("SELECT * from pms_candidate where username='".$this->input->post('username')."'");
			if($query->num_rows() > 0)
			{	
				$row = $query->row_array();	
				$unique_id = md5(uniqid($row["candidate_id"], true));
				$username = $this->input->post('username');			
				$id = md5($row["candidate_id"]);		
				$query1 = $this->db->query("SELECT * from pms_candidate_password_change where md5(candidate_id)='".$id."'");
				//echo "SELECT * from pms_candidate_password_change where md5(candidate_id)='".$id."'";
				//exit();
				if($query1->num_rows() > 0)	
				{
					$row1 = $query1->row_array();	
					$this->db->where('md5(candidate_id)', $id);
					$this->db->delete('pms_candidate_password_change'); 
				}	
				
				$array=array(
					'unique_id'          => $unique_id,
					'candidate_id'         => $id,
					'status'             => 1
					);
					
				$this->db->where('md5(candidate_id)', $id);
				$this->db->where('status', '1');			
				$this->db->delete('pms_candidate_password_change'); 
				
				$this->db->insert('pms_candidate_password_change', $array);	
								
				if($this->sentmail($id,$username))
				{
					redirect('login?sent=1');
				}
				else
				{	
					redirect('login?err=1');
				}
			}else
			{
				redirect('login?err=1');
			}
		}
		//$this->load->view('public/header',$this->data);
		//$this->load->view('public/pre-header',$this->data);
		$this->load->view('forgottonpassword/forgotton_password',$this->data);
		//$this->load->view('public/footer',$this->data);
	}
	
	public function sentmail($id = '',$username = '')
	{
		$query = $this->db->query("SELECT * FROM pms_candidate where md5(candidate_id) ='".$id."'");
		
		$row = $query->row_array();
		$subject = ' Recover Password - logis.ae ';
		
		$mail_body='<!DOCTYPE html>
			<head><title>Seekers Consultancy LLC - Recover Password - logis.ae</title>
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
				  <td align="center" valign="bottom" style="font:Bold 15px Arial, Helvetica, sans-serif; color:#67bd3c; padding-top:18px;"><span style="color:#3b3b3b;">WhatsApp :</span> +971 50 3860 610 </td>
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
							<br /><p>
						  	As per your request, to change the password of logis.ae candidate log in, please click the link below :-<br />
						  	<br />
							<a style="color:#000000" href="'.base_url().'index.php/resetpassword/?candidate_id='.$id.'" target="_blank"> Please click here to change your password:<br>'.base_url().'index.php/resetpassword/?candidate_id='.$id.'
						 </a></p>
						 
						  <p>Thank You ! <br>
						 Seekers Consultancy LLC</p></td>
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
					 <p style="text-align:center; font-weight:bold;">Seekers Consultancy LLC.</p>

			<center>
			Seekers Consultancy LLC,  P.O Box 20893, Dubai, UAE || Phone: +971 4 2693600 || WhatsApp : +971 50 3860 610 || Email: info@seekershr.com</center></p></td>
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
		
		
		$name = $row['first_name']." ".$row['last_name'];
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('jobs@logis.ae','SeekersHR');
		$this->email->to($username);
		$this->email->subject($subject);
		$this->email->message($mail_body);
		
		if($this->email->send())
		{			
			
			return 1;
		}
		else
		{
			return 0;
		}
		
		//echo $mail_body;
		//exit();
		//
		
		
	}

	public function send_confirmation($candiadte_id)
	{
		$query = $this->db->query("SELECT * FROM pms_candidate where md5(candidate_id) ='".$candiadte_id."'");
		
		$row = $query->row_array();
		$subject = ' Password Changed ';
		
		$mail_body='<!DOCTYPE html>
			<head><title>Seekers Consultancy LLC - Password Changed</title>
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
				  <td align="center" valign="bottom" style="font:Bold 15px Arial, Helvetica, sans-serif; color:#67bd3c; padding-top:18px;"><span style="color:#3b3b3b;">WhatsApp :</span>+971 50 3860 610 </td>
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
							<br /><p>
						  	Password changed succesfully.</p>
						  <p>Thank You ! <br>
						  Seekers Consultancy LLC</p></td>
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
					 <p style="text-align:center; font-weight:bold;">Seekers Consultancy LLC.</p>

		<center>
			Seekers Consultancy LLC,  P.O Box 20893, Dubai, UAE || Phone: +971 4 2693600 || WhatsApp : +971 50 3860 610 || Email: info@seekershr.com</center></p></td>
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
		
		$name = $row['first_name']." ".$row['last_name'];
		$username = $row['username'];
		
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('jobs@logis.ae', 'SeekersHR');
		$this->email->to($username);
		$this->email->subject($subject);
		$this->email->message($mail_body);
		
		//echo $mail_body;
		//exit();
		
		
		if($this->email->send())
		{			
			return 1;
		}
		else
		{
			return 0;
		}
	}
		
}