<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Resetpassword extends CI_Controller {

	function __construct()
	{
	   	 parent::__construct();
		 $this->data['page_name']= '';
		 $this->data['page_title']= 'SeekEasy.in';
		 $this->data['page_content']= '';
		 $this->data['page_short_content']= '';
		 $this->data['seo_title']= 'Seekeasy.in';
		 $this->data['seo_keyword']= 'Seekeasy.in';
		 $this->data['seo_meta_desc']= 'Seekeasy.in';
		 $this->data['page_banner']= 'Seekeasy.in';
	}
	
	public function index()
	{
		$this->data['pass_status'] = '';
		
		if($this->input->post('user_id'))
		{
				$array=array(
						'password' => md5($this->input->post('password'))
				);
						
			 $this->db->update('pms_admin_password_change', array('status'=>0), array('md5(admin_id)' =>$this->input->post('user_id')));
			 $this->db->update('pms_admin_users', $array,array('md5(admin_id)' => $this->input->post('user_id')));
			 redirect('login');
		}
		
		if($this->input->get('admin_id'))
		{
			$this->data['user_id'] = $this->input->get('admin_id');
		}else{
			exit();
		}
		
		$this->data['pass_status']='';
		$query = $this->db->query("select * from pms_admin_password_change where md5(admin_id)='".$this->data['user_id']."'");
	   	$this->data['pass_status'] = $query->row_array();
		$this->load->view('forgottonpassword/reset_password',$this->data);
	}
	
	public function sendpasswordlink()
	{
		if($this->input->post('email'))
		{
			$query = $this->db->query("SELECT * from pms_admin_users where email='".$this->input->post('email')."'");
			if($query->num_rows() > 0)
			{	
				$row = $query->row_array();	
				$unique_id = md5(uniqid($row["admin_id"], true));
				$email = $this->input->post('email');			
				$id = md5($row["admin_id"]);		
				$query1 = $this->db->query("SELECT * from pms_admin_password_change where md5(admin_id)='".$id."'");
				
				if($query1->num_rows() > 0)	
				{
					$row1 = $query1->row_array();	
					$this->db->where('md5(admin_id)', $id);
					$this->db->delete('pms_admin_password_change'); 
				}	
				
				$array=array(
					'unique_id'          => $unique_id,
					'admin_id'         => $id,
					'status'             => 1
					);
					
				$this->db->where('md5(admin_id)', $id);
				$this->db->where('status', '1');			
				$this->db->delete('pms_admin_password_change'); 
				
				$this->db->insert('pms_admin_password_change', $array);	
								
				if($this->sentmail($id,$email))
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
	
	public function sentmail($id = '',$email = '')
	{
		$query = $this->db->query("SELECT * FROM pms_admin_users where md5(admin_id) ='".$id."'");
		
		$row = $query->row_array();
		$subject = ' Recover Password ';
		
		$mail_body='<!DOCTYPE html>
			<head><title>SeekEasy.com - Reset Password</title>
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
						 
						 <!--  Logo Part Start-->
						 
						  <table border="0" align="left" cellpadding="0" cellspacing="0" class="two-left">
					  <tr>
					   <td align="center" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"><img src="'.$this->config->item("assets_url").'frontend/layout/img/logo.png" width="141" height="42" alt="" /></td>
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
						<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$row['firstname'].',</strong><br />
							<br /><p>
						  	As per your request for change password, please click on below link.<br />
						  	Your login details are as below:<br />
							Please click here to change your password:<br>'.base_url().'index.php/resetpassword/?admin_id='.$id.'
						  </p>
						  <p>Thank You ! <br>
						 SeekEasy.com</p></td>
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
					 <p style="text-align:center; font-weight:bold;">SeekEasy. Your Recruitment Solutions Provider.</p><br />
			
			<br />
			<center>
			Seekers Consultancy LLC. P.O Box. 20893, Dubai, UAE || Phone:+971 4 26 93 600 || Email: info@seekersgulf.com</center></p></td>
					  </tr>
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
						
						<!--  Social Media Part Start-->
						<table width="102" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$this->config->item("assets_url").'frontend/layout/img/facebook-icon.png" width="27" height="28" alt="" /></a></td>
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$this->config->item("assets_url").'frontend/layout/img/twitter-icon.png" width="27" height="28" alt="" /></a></td>
					 
			
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$this->config->item("assets_url").'frontend/layout/img/linkedin-icon.png" width="27" height="28" alt="" /></a></td>
				
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
		
		$name = $row['firstname']." ".$row['lastname'];
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('shyjo@unicornhr.in',$name);
		$this->email->to($email);
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
	}
}