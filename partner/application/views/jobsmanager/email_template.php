<!DOCTYPE html>
					<head>
					
					<title>$this->config->item('company_name') Personnel Consultancy</title>
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
					<table width="600" align="center" border="0" cellspacing="0" cellpadding="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;">
                        
                        
                        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
						  <tr>
							<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#000; padding-top:30px; padding-bottom:30px;" class="header-space">
							
							
							 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
							   <tr>
					
								 <td align="center" valign="top" style="font:Normal 18px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;">
								 
							<?php echo $table_head;?>
							

							</td>
						</tr>
					</table>
					
					<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
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
                               <?php  if(is_array($table_rows)) 
							   {
							   foreach($table_rows as $key => $val)
							   {
							   
							   ?>
									<h3><?php echo $key;?>:<?php echo $val;?></h3>
                               <?php } ?>
                               <?php } ?>
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
                                <p><strong><?php echo $this->config->item('company_name'); ?></strong><br> 
                                
<br>
<strong>Phone</strong>: <?php echo $this->config->item('phone_number'); ?><br>
<strong>e-mail</strong> : <?php echo $this->config->item('company_gmail'); ?> | <strong>web</strong> : <?php echo $this->config->item('company_website'); ?></p>
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