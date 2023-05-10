<script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script>

<div class="container-fluid">
  <div class="container">
    <div class="panel panel-default">
      <div style="padding-right:10px;"> </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <div class="panel-body">
        <div class="row box">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <div class="panel panel-success">
              <div class="panel-heading"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i>Please Make Your Payment</strong></div>
              <br />
              <div class="panel-body"> <br>
                <table>
                  <tbody>
                  <form method="post" action="<?php echo $this->config->site_url();?>signup/payment_summary" >
                  <?php if($_SESSION['package']==1) { $_SESSION['package']=500; }
				        else if($_SESSION['package']==2) { $_SESSION['package']=1000; }
						else if($_SESSION['package']==3) { $_SESSION['package']=1500; }
						else if($_SESSION['package']==4) { $_SESSION['package']=2000; } ?>
                  
                    <?php  
				$key    = '7r4Wnvnl';
				$salt   = 'OMoM7rtF5B';
				$txnid  = "Txn" . rand(10000,99999999);
				$amount = $_SESSION['package'];
				$pinfo  = 'Shopping Cart';
				$fname  = $_SESSION['contact_name'];
				$email  = $_SESSION['contact_email'];
				$mobile = $_SESSION['contact_phone'];
				$udf5   = 'BOLT_KIT_PHP7';
            
            	$hash=hash('sha512', $key.'|'.$txnid.'|'.$amount.'|'.$pinfo.'|'.$fname.'|'.$email.'|||||'.$udf5.'||||||'.$salt);
            ?>
                    <input type="hidden" id="udf5" name="udf5" value="<?php echo $udf5; ?>" />
                    <input type="hidden" id="surl" name="surl" value="<?php echo $this->config->site_url(); ?>signup/payment_summary" />
                    <input type="hidden" name="fname" id="fname" value="<?php echo $fname; ?>" />
                    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
                    <input type="hidden" name="mobile" id="mobile" value="<?php echo $mobile; ?>" />
                    <input type="hidden" name="key" id="key" value="<?php echo $key; ?>" />
                    <input type="hidden" name="salt" id="salt" value="<?php echo $salt; ?>" />
                    <input type="hidden" name="txnid" id="txnid" value="<?php echo  $txnid; ?>" />
                    <input type="hidden" name="amount" id="amount" value="<?php echo $amount; ?>" />
                    <input type="hidden" name="pinfo" id="pinfo" value="<?php echo $pinfo; ?>" />
                      <input type="hidden" name="hash" id="hash" id="hash" value="<?php echo $hash; ?>" />
                    
                    <tr>
                      <td  style="border-style: hidden;" colspan="3"><span class="click-icons">
                        <input style="background-color: #40a244; color: aliceblue;" type="submit" value="Pay Now" onclick=" launchBOLT(); return false; ">
                        <a style="background-color: #e1e4e4; border-radius: 4px; padding: 8px; border: 1px solid #9e9595; color: #1d1c1b;" href="<?php echo base_url(); ?>/logout">Cancel</a>
                    </tr>
                  </form>
                    </tbody>
                  
                </table><br>
<br>

              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
    </div>
  </div>
</div>
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
			mode: 'dropout'	
			});
		}
</script> 
