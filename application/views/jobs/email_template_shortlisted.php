<!DOCTYPE html>
					<head>
					
					<title>Seekers</title>
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
					<table width="1200" align="center" border="0" cellspacing="0" cellpadding="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;">
                        
                        
                        <table width="1200" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
						  <tr>
							<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#000; padding-top:30px; padding-bottom:30px;" class="header-space">
							
							
							 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
							   <tr>
					
								 <td align="center" valign="top" style="font:Normal 18px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;">
								 
							<?php echo $table_head;?>
							

							</td>
						</tr>
					</table>
					
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

								<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>
                                
                                
                                <?php echo $salutation;?>
                                
                                
                                </strong><br />
                                
                                
								<?php echo $text_before_table;?>
								
                                
                                <br />
								<p>
                                
                                <table width="100%" border="1" cellpadding="5">
                              <tbody>
                                <tr>
                                    <td width="4%" align="center" valign="middle"><strong>#</strong></td>
                                  <td width="16%"><strong> Name</strong></td>
                                  <td width="44%"><strong>Education</strong></td>
                                  <td width="4%"><strong>Company</strong></td>
                                  <td width="4%"><strong>Designation</strong></td>
                                  <td width="4%"><strong> Exp.</strong></td>
                                  <td width="4%"><strong>CTC</strong></td>
                                  <td width="4%"><strong>. CTC</strong></td>
                                  <td width="4%"><strong>Notice</strong></td>
                                  <td width="4%"><strong>CV</strong></td>
                                  <td width="4%"><strong>Accept</strong></td>
                                  <td width="4%"><strong>Reject</strong></td>                                  
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
										  <td><?php echo $val['level_name'];?>, <?php echo $val['education'];?></td>
										  <td><?php echo $val['company'];?></td>
										  <td><?php echo $val['designation'];?></td>
										  <td><?php echo $val['total_exp'];?></td>
										  <td><?php echo $val['current_ctc'];?></td>
										  <td><?php echo $val['expected_ctc'];?></td>
										  <td><?php echo $val['notice_period'];?></td>
										  <td><?php echo $val['cv_url'];?></td>
										  <td><?php echo $val['accept_url'];?></td>
										  <td><?php echo $val['reject_url'];?></td>
								  </tr>
								   <?php } ?>
                               <?php } ?>
                                 </tbody>
</table>
								  </p>

               					<br />
                                
                                <p>
								<?php echo $text_after_table;?>
                                </p>
                                                                  
								  <p>Thank You ! <br>
                                  <?php echo $signature_name;?><br>
                                   <?php echo $signature;?>
                                  
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
                                <p><strong>Seekers<br> 
                                Dubai, United Arab Emirates
<br>
<strong>Phone</strong>: +91 971 426 93 600<br>
<strong>e-mail</strong> : info@seekersgulf.com | <strong>web</strong> : www.seekersgulf.com</p>
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