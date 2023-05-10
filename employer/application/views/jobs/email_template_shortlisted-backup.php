<!DOCTYPE html>
					<head>
					
					<title>Seekers Consultancy LLC</title>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
					
					<style type="text/css">
					
					body{width:100%;margin:0px;padding:0px;background:#fff;text-align:left;}
					html{width: 100%; }
					img {border:0px;text-decoration:none;display:block; outline:none;}
					a,a:hover{color:#FF7600;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
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
					<table width="1200" align="center" border="0" cellspacing="0" cellpadding="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;">
                        
                        
                        <table width="1200" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
						  <tr>
							<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#000; padding-top:30px; padding-bottom:30px;">

					
					<table width="1200" border="0" cellspacing="0" cellpadding="0" class="main">
					  <tr>
						<td align="left" valign="top"></td>
						</tr>
					  <tr>
						<td align="left" valign="top">
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
						  <tr>
							<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom">
                            
                            
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
							  <tr>
							    <td width="50%" align="left" valign="top" style="font:Normal 15px Arial, Helvetica, sans-serif; color:#000; padding:8px 0px 6px 4px; line-height:22px;"><img src="<?php echo base_url(); ?>assets/images/logo.png" /></td>
							    <td width="50%" align="left" valign="top" style="font:Normal 15px Arial, Helvetica, sans-serif; color:#000; padding:8px 0px 6px 4px; line-height:22px;"><?php echo $this->config->item('company_name');?> <br />
     <?php echo $this->config->item('powered_by_address');?> <br />
       <?php echo $this->config->item('powered_by_phone');?> <br />
      <font color="#5900FF"><?php echo $this->config->item('powered_by_email');?></font> <br />
      <font color="#5900FF"><?php echo $this->config->item('powered_by_web');?></font></td>
						      </tr>
							  <tr>

								<td colspan="2" align="left" valign="top" style="font:Normal 15px Arial, Helvetica, sans-serif; color:#000; padding:8px 0px 6px 4px; line-height:22px;"><p><strong>
                                
                                
                                Dear <?php echo $email_to_name;?>,
                                
                                </strong><br /><br />
                                
Kindly find the attached profiles as per your requirements. <br><br>

Please click on the "view" against each candidate to get the CV displayed. Our consultant's evaluation and interview report is given in detail in all the profiles. 
<br><br>
At the end of each CV there is option to write your comments. Kindly mention your feedback in the space given for us to improve our search or proceed further. 
<br><br>


								<?php echo $text_before_table;?>
								
                                
                                <br />
								<p>
                                
                                <table width="100%" border="1" cellpadding="5">
                              <tbody>
                                <tr>
                                    <td width="4%" align="center" valign="middle"><strong>#</strong></td>
                                  <td width="30%"><strong> Name</strong></td>
                                   <td width="20%"><strong>Nationality</strong></td>
                                  <td width="11%"><strong> Total Experience</strong></td>
                                  <td width="10%"><strong>Current Salary</strong></td>
                                  <td width="11%"><strong>Expected Salary</strong></td>
                                  <td width="7%"><strong>Notice</strong></td>
                                  <td width="7%"><strong>CV</strong></td>
                                  </tr>
                                
                               <?php  if(is_array($table_rows)) 
							   {
									$i=0;
								   foreach($table_rows as $key => $val)
								   {
								   $i+=1;
								   ?>
									   <tr>
										  <td align="center" valign="middle"><?php echo $i;?></td>
										  <td><?php echo $val['candidate_name'];?></td>
                                           <td><?php if($val['nationality']!='')echo $val['nationality'];else echo 'Not Updated';?></td>
										  <td><?php if($val['total_exp']!='')echo $val['total_exp'].' &nbsp; Years';else echo ' &nbsp; Not Updated';?></td>
										  <td>
										  <?php if($val['current_ctc']>=1){?>
										  	<?php echo  $this->config->item('currency_symbol');?>&nbsp;<?php echo number_format((float)$val['current_ctc'],2);?>
											<?php }else{?>Not Updated<?php } ?>
                                            </td>
										  <td>
										  <?php if($val['expected_ctc']>=1){?>
										  <?php echo  $this->config->item('currency_symbol');?>&nbsp;<?php echo number_format((float)$val['expected_ctc'],2);?>
                                          <?php }else{?>Not Updated<?php } ?>
                                          </td>
										  <td><?php if($val['notice_period']!='')echo $val['notice_period'].' &nbsp; Days';else echo ' &nbsp; Not Updated';?></td>
										  <td><?php echo $val['cv_url'];?></td>
                                        </tr>
								   <?php } ?>
                               <?php } ?>
                                 </tbody>
</table>
								  </p>

E Mail :<strong> <a style="color:#000;" onClick="mailto:<?php echo $email_from;?>;"><?php echo $email_from;?></a></strong>, 
Website : <a href="http://<?php echo $website;?>" target="_blank" style="color:#000;"><strong><?php echo $website;?></strong></a>   <br><br>

               					<br />
                                
                                <p>
								<?php echo $text_after_table;?>
                                </p>
                                 
                                 Kindly let us have your feedback at the earliest.
                                                        
								  <p>Best regards, <br>  
                                  <br>
								 
                                 <strong> <?php echo $from_name;?></strong><br>
                                  <strong><?php echo $designation;?></strong><br>                                  
                                  Mobile: <strong><?php echo $mobile;?></strong><br>
                                 <strong> <?php echo $company_name;?></strong><br>
                                  <?php echo $pobox_address;?><br>
                                  Tel: <?php echo $telephone;?><br>
                                  E-Mail: <strong> <a style="color:#000;" onClick="mailto:<?php echo $email_from;?>;"><?php echo $email_from;?></a></strong>, <br>
                                  Skype:<?php echo $skype;?><br>
                                  Website: <a href="http://<?php echo $website;?>" target="_blank" style="color:#000;"><strong><?php echo $website;?></strong></a> <br><br>

<p>
This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed.  Any opinions expressed in the email are those of the individual and not necessarily the company. If you are not the intended recipient or the person responsible for delivering to the intended recipient, be advised that you have received this email in error and that any use is strictly prohibited.   
</p>
                                  
                                  
                   
                                  </td>
								</tr>
							  </table>
                              
                              </td>
						  </tr>
						  </table>
						
						</td>
					  </tr>
					</table>
					
							  </td>
						  </tr>
						  
						  <tr>

							<td align="center" valign="top">
							<!--  Footer Part Start-->
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="main">
							  
							  
							  <tr>
								<td align="center" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
                                <p><strong><?php echo $powered_by;?><br> 
                                <?php echo $powered_by_address;?><br>
                                <?php echo $powered_by_phone;?><br>
         <a href="http://www.seekersgulf.com"  onClick="mailto:jenson@seekersgulf.com;" style="color:#000;"><?php echo $powered_by_email;?></a><br>
          <a href="http://www.seekersgulf.com" target="_blank" style="color:#00;"><?php echo $powered_by_web;?></a><br></p>
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