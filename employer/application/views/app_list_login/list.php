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
<div class="logo-wrap">
<span class="logo"><img src="<?php echo base_url('assets/images/logo.png');?>"></span>
</div>
<div style="clear:both;"></div>
</div>



<div class="login_box">
<form action="<?php echo $this->config->site_url();?>/app_list_login" class="form-horizontal" enctype="multipart/form-data" method="post" id="loginForm" name="frmentry"  > 
<h2>Login</h2>

<?php if($errmsg!=''){?> 
 <strong><div class="alert alert-success"><?php  echo  $errmsg;?></strong></div>
 <?php } ?> 
 <?php if($this->input->get('sent')==1){?>  
<strong>Sucess !</strong>Check your mail.
<?php }?> 

<?php if($this->input->get('err')==1){?> 
	<div class="alert alert-danger alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Enter Your Email.</strong>
    </div>
<?php }?>
<input type="text" id="username" name="username" class="form-control logins" value="">
<input type="password" id="password" name="password" class="form-control logins" value="">

<a href="javascript:void(0);" class="login_btn" onClick="validate()"><img src="<?php echo base_url('assets/images/login.png');?>"></a>
 <!--<button type="submit" class="btn green">Submit</button>-->
<!-- <div class="checkbox logins"><label><input type="checkbox"> Remember</label></div> -->
<!--<a href="<?php echo $this->config->site_url();?>/forgottonpassword" class="forgot">Forgot Password?</a>-->
<div style="clear:both;"></div>
</form>
</div>
<div class="login_box_footer"><a href="<?php echo $this->config->site_url();?>/signup">Create an account</a></div>

<footer class="login_footer"><?php echo $this->config->item('powered_by')?> ||  <?php echo $this->config->item('powered_by_address')?> || <?php echo $this->config->item('powered_by_phone')?> || <?php echo $this->config->item('powered_by_email')?></footer>
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
	
	if($('#username').val()=='')
	{
		alert('Please enter Username');
		$('#username').focus();
		return false;
	}
    else if($('#password').val()=='')
	{
		alert('Please enter Password');
		$('#password').focus();
		return false;
	}
	else{
		$('#loginForm').submit();
	}
	
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
