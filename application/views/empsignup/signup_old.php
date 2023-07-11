<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="images/fav.ico">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/device.css');?>" rel="stylesheet" type="text/css">
<title>Recruitment CRM</title>
</head>
<body>
<!--top-section-->
<div class="top">
  <div class="logo-wrap"> <span class="logo"><img src="<?php echo base_url('assets/images/logo.png');?>"></span> </div>
  <div style="clear:both;"></div>
</div>
<div class="login_box">
  <form action="<?php echo $this->config->site_url();?>signup" class="form-horizontal" enctype="multipart/form-data" method="post" id="loginForm" name="frmentry"  >
    <?php
			$length = 18;
$randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, $length);
//echo $randomletter;
			 ?>
    <input type="hidden" name="company_hash" value="<?php echo $randomletter; ?>"/>
    <h2>Login</h2>
    <?php if($errmsg!=''){?>
    <div class="alert alert-success"><strong>
      <?php  echo  $errmsg;?>
      </strong></div>
    <?php } ?>
    <?php if($this->input->get('sent')==1){?>
    <strong>Sucess !</strong>Check your mail.
    <?php }?>
    <?php if($this->input->get('err')==1){?>
    <div class="alert alert-danger alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
      <strong>Enter Your Email.</strong> </div>
    <?php }?>
    <input type="text" id="contact_name" placeholder="Contact Name" name="contact_name" class="form-control logins" value="">
    <input type="text" id="contact_email" placeholder="Email" name="contact_email" class="form-control logins" value="">
    <input type="text" id="contact_phone" placeholder="Mobile" name="contact_phone" class="form-control logins" value="">
    <input type="text" id="company_name" placeholder="Company Name" name="company_name" class="form-control logins" value="">
    <input type="text" id="username" placeholder="Username" name="username" class="form-control logins" value="">
    <input type="password" id="password" placeholder="Password" name="password" class="form-control logins" value="">
    <br>
    <label>Package Validity</label>
    <br>
    <input type="radio" id="package1" name="package" value="1">
    One Month
    <input type="radio" id="package2" name="package" value="2" checked>
    Three Month
    <input type="radio" id="package3" name="package" value="3">
    Six Month
    <input type="radio" id="package4" name="package" value="4">
    One Year <br>
    
    <!--
<a href="javascript:void(0);" class="login_btn" onClick="validate()"><img src="<?php echo base_url('assets/images/login.png');?>"></a>--><br>
    <button type="button" class="btn green" onClick="validate()">Submit</button>
    
    <!--<a href="<?php echo $this->config->site_url();?>/forgottonpassword" class="forgot">Forgot Password?</a>-->
    <div style="clear:both;"></div>
  </form>
</div>
<div class="login_box_footer"><a href="<?php echo $this->config->site_url();?>login">Login</a></div>
<br>
<footer class="login_footer"><?php echo $this->config->item('powered_by')?> || <?php echo $this->config->item('powered_by_address')?> || <?php echo $this->config->item('powered_by_phone')?> || <?php echo $this->config->item('powered_by_email')?><br>
  <br>
</footer>
<!--scripts--> 
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/animate_jquery.js');?>"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/maps.googleapis.js');?>"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/map.js');?>"></script> 
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.canvasjs.min.js');?>"></script> 
<script src="<?php echo base_url('assets/js/custom.js');?>"></script> 
<!--scripts--> 
<script>

function validate()
{

	if($('#contact_name').val()=='')
	{
		alert('Please enter your name');
		$('#contact_name').focus();
		return false;
	}
	
	if($('#contact_email').val()=='')
	{
		alert('Please enter contact email');
		$('#contact_email').focus();
		return false;
	}
	if($('#contact_phone').val()=='')
	{
		alert('Please enter phone');
		$('#contact_phone').focus();
		return false;
	}
	if($('#company_name').val()=='')
	{
		alert('Please enter Company Name');
		$('#company_name').focus();
		return false;
	}
	if($('#username').val()=='')
	{
		alert('Please enter Username');
		$('#username').focus();
		return false;
	}	
	
    if($('#password').val()=='')
	{
		alert('Please enter Password');
		$('#password').focus();
		return false;
	}	
	$('#loginForm').submit();	
	//return true;
}

$( ":input" ).keypress(function( event ) {
  if ( event.which == 13 ) {
   //$('#loginForm').submit();
   validate();
  }
});

</script>
</body>
</html>
