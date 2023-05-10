<style>
th{
	color: #4a924b;
}
.blinking {
	background-color: #004A7F;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	border: none;
	color: #FFFFFF;
	cursor: pointer;
	display: inline-block;
	font-family: Arial;
	font-size: 16px;
	padding: 2px 8px;
	text-align: center;
	text-decoration: none;
	-webkit-animation: glowing 1500ms infinite;
	-moz-animation: glowing 1500ms infinite;
	-o-animation: glowing 1500ms infinite;
	animation: glowing 1500ms infinite;
}
 @-webkit-keyframes glowing {
 0% {
 background-color: #2980b9;
 -webkit-box-shadow: 0 0 3px #B20000;
}
 50% {
 background-color: #2980b9;
 -webkit-box-shadow: 0 0 10px #FF0000;
}
 100% {
 background-color: #2980b9;
 -webkit-box-shadow: 0 0 3px #B20000;
}
}
</style>
<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>
<div class="container-fluid">
  <div class="container">
    <div class="panel panel-default">
      <div style="padding-right:10px;"> </div>
      <div class="panel-body">
        <div class="row box">
          <div class="col-sm-1"></div>
          <div class="col-sm-10">
            <div class="panel panel-success">
              <div class="panel-heading"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i>Please Make Your Payment</strong></div>
             
              <div class="panel-body"> 
              <div style="margin-left: 30%;">
               <?php foreach($selected_packages as $payment => $pay){ ?>
               <?php if($pay['payment_status']==1 && $pay['emp_package_status']==1){ ?>
              
               <span class="blinking">You already activated 
			   						<b><?php if($pay['total_job_ads']==1) { echo '1 Month'; }
									else if($pay['total_job_ads']==5) { echo '3 Month'; }
									else if($pay['total_job_ads']==10) { echo '6 Month'; }
									else if($pay['total_job_ads']==25) { echo '1 Year'; } ?></b> Package!</span>
			   <?php } } ?> </div>
              <br>
              <?php if($this->input->get('error')==1){?>
  <div class="alert alert-success">
    <button class="close" data-dismiss="alert">x</button>
    <strong style="color: #ff2b09;">Package already activated.</strong> </div>
  <?php } ?>
                <table>
                  <tbody>
                  <form method="post" action="<?php echo $this->config->site_url();?>payment_process/add_package" >
                    <tr>
                      <td colspan="2">Name</td>
                      <td colspan="6"><?php echo $_SESSION['contact_name']; ?></td>
                     </tr>
                    <tr>
                      <td colspan="2">Email</td>
                      <td colspan="6"><?php echo $_SESSION['contact_email']; ?></td>
                    </tr>
                    <tr>
                      <td colspan="2">Phone</td>
                      <td colspan="6"><?php echo $_SESSION['contact_phone']; ?></td>
                    </tr>
                    </tbody>
                   </table><br>

                   <table>
                       <tbody>
                            <tr>
                              <th width="13%" colspan="2">Select Package</th>
                              <th width="9%">Total Jobs</th>
                              <th width="9%">Amount</th>
                              <th width="12%">Job Ad Validity</th>
                              <th width="13%">Package Validity</th>
                              <th width="15%">Resume Download</th>
                              <th width="13%">Total [Incl. GST 18%]</th>
                            </tr>
                            <?php foreach($list_packages as $key => $val){ ?>
                            <tr>
                              <td width="3%"><input style="width:13px; height: 13px;" type="radio" id="package_id" name="package_id" value="<?php echo $val['package_id'];?>"></td>
                              <td width="10%"><?php echo $val['package_name']; ?></td>
                              <td><?php echo $val['total_job_ads']; ?></td>
                              <td><?php echo number_format($val['package_amount'],2);?></td>
                              <td>30 Days</td>
                              <td>

								
								<?php 
							  		if($val['total_job_ads']==1) { echo '1 Month'; }
									else if($val['total_job_ads']==5) { echo '3 Months'; }
									else if($val['total_job_ads']==10) { echo '6 Months'; }
									else if($val['total_job_ads']==25) { echo '12 Months';}
									else if($val['total_job_ads']==50) { echo '12 Months';}
									else if($val['total_job_ads']==100) { echo '12 Months';}
									else if($val['total_job_ads']==200) { echo '12 Months'; } 
								?>  
                                    </td>
                              <td>Unlimited</td>
                              <td><?php echo number_format($val['total_gst_amount'],2);?></td>
                            </tr>
                            <?php } ?>
                          </tbody>
                        </table><br>
                 <tr>
                      <td  style="border-style: hidden;" colspan="3"><span class="click-icons">
                        <input style="background-color: #40a244; color: aliceblue;" type="submit" value="Select Package" id="submit_form">
                        <!--<a style="background-color: #e1e4e4; border-radius: 4px; padding: 8px; border: 1px solid #9e9595; color: #1d1c1b;" href="<?php //echo base_url(); ?>logout">Cancel</a>-->
                    </tr>
                  </form>
                  
                <br>
                <br>
                <?php if($packages!=NULL) { ?>
                <table>
                  <tbody>
                  <form method="post" action="<?php echo $this->config->site_url();?>payment_process/payment_summary" >
                  
                  			 <tr>
                              <th width="9%">Select Package</th>
                              <th width="9%">Total Jobs</th>
                              <th width="9%">Amount</th>
                              <th width="12%">Job Ad Validity</th>
                              <th width="17%">Package Validity</th>
                              <th width="15%">Resume Download</th>
                              <th width="13%">Total [Incl. GST 18%]</th>
                            </tr>
                            <?php foreach($packages as $keys => $value){ 
							//print_r($selected_packages); exit();?>
                            <tr>
                              <td><?php echo $value['package_name']; ?></td>
                              <td><?php echo $value['total_job_ads']; ?></td>
                              <td><?php echo number_format($value['package_amount'],2);?></td>
                              <td>30 Days</td>
                              <td><b><?php if($value['package_id']==1) { echo '1 Month'; }
									else if($value['package_id']==2) { echo '3 Month'; }
									else if($value['package_id']==3) { echo '6 Month'; }
									else if($value['package_id']==4) { echo '1 Year'; } ?></b><br>
									Start Date:  <?php echo $value['package_start_date'];?><br>
                                    End Date  :   <?php echo $value['package_exp_date'];?></td>
                              <td>Unlimited</td>
                              <td><?php echo number_format($value['total_gst_amount'],2);?></td>
                            </tr>
                           <?php  
                            $key    = 'ahbWP0rC';
                            $salt   = 'VK8mDTZlkB';
                            $txnid  = "Txn" . rand(10000,99999999);
                            $amount = $value['package_amount'];
							$package_start_date = $value['package_start_date'];
							$package_exp_date = $value['package_exp_date'];
                            $pinfo  = 'Shopping Cart';
                            $fname  = $_SESSION['contact_name'];
                            $email  = $_SESSION['contact_email'];
                            $mobile = $_SESSION['contact_phone'];
                            $udf5   = 'BOLT_KIT_PHP7';
                        
                            $hash=hash('sha512', $key.'|'.$txnid.'|'.$amount.'|'.$pinfo.'|'.$fname.'|'.$email.'|||||'.$udf5.'||||||'.$salt);
                        ?>
                                <input type="hidden" id="udf5" name="udf5" value="<?php echo $udf5; ?>" />
                                <input type="hidden" id="surl" name="surl" value="<?php echo $this->config->site_url(); ?>payment_process/payment_summary" />
                                <input type="hidden" name="fname" id="fname" value="<?php echo $fname; ?>" />
                                <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
                                <input type="hidden" name="mobile" id="mobile" value="<?php echo $mobile; ?>" />
                                <input type="hidden" name="key" id="key" value="<?php echo $key; ?>" />
                                <input type="hidden" name="salt" id="salt" value="<?php echo $salt; ?>" />
                                <input type="hidden" name="txnid" id="txnid" value="<?php echo  $txnid; ?>" />
                                <input type="hidden" name="amount" id="amount" value="<?php echo $amount; ?>" />
                                <input type="hidden" name="pinfo" id="pinfo" value="<?php echo $pinfo; ?>" />
                                <input type="hidden" name="hash" id="hash" value="<?php echo $hash; ?>" />
                                <input type="hidden" name="package_start_date" id="package_start_date" value="<?php echo $package_start_date; ?>" />
                                <input type="hidden" name="package_exp_date" id="package_exp_date" value="<?php echo $package_exp_date; ?>" />
                            
                            <?php } ?>
                          </tbody>
                        </table><br>
                       
</td>
                    </tr>
                    <tr>
                      <td  style="border-style: hidden;" colspan="3"><span class="click-icons">
                        <input style="background-color: #40a244; color: aliceblue;" type="submit" value="Pay Now" onclick=" launchBOLT(); return false; ">
                   	<a style="background-color: #e1e4e4; border-radius: 4px; padding: 8px; border: 1px solid #9e9595; color: #1d1c1b;" href="<?php echo base_url(); ?>payment_process/cancel">Cancel</a>
                    </tr>
                   
                  </form>
                  </tbody>
                  
                </table>
                  <?php } ?>
              </div>
            </div>
          </div>
           <div class="col-sm-1"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
    
$('#submit_form').click(function()
  {
	if (!$("input[name='package_id']:checked").val()) 
	{
		alert('Select any Package');
		$('#package_id').focus();
		return false;
	}
	return true;
 });
</script>

<script type="text/javascript">
    
		function launchBOLT()
		{
                        
			bolt.launch({
			key: $('#key').val(),
			txnid: $('#txnid').val(), 
			hash: $('#hash').val(),
			amount: $('#amount').val(),
			firstname: $('#fname').val(),
			email: $('#email').val(),
			phone: $('#mobile').val(),
			productinfo: $('#pinfo').val(),
			udf5: $('#udf5').val(),
			surl : $('#surl').val(),
			furl: $('#surl').val(),
			package_start_date: $('#package_start_date').val(),
			package_exp_date: $('#package_exp_date').val(),
			mode: 'dropout'	
			});
		}
</script> 
