<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="images/fav.ico">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/device.css');?>" rel="stylesheet" type="text/css">
<title>CRM</title>
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
<form role="form" action="<?php echo $this->config->site_url();?>/resetpassword/sendpasswordlink" method="post" enctype="multipart/form-data" name="forget_pass"  id="forgotpwd">
<h2>forgot password ?</h2>
<p>Enter your e-mail address below to reset your password.</p>
<input type="email" class="form-control logins"  id="username" name="username">
<a href="javascript:void(0);" class="sub_btn forg" onClick="validate_form()"><img src="<?php echo base_url('assets/images/submits.png');?>"></a>
<a href="<?php echo $this->config->site_url();?>/login" class="sub_btn forg"><img src="<?php echo base_url('assets/images/back.png');?>"></a>
</form>


<div style="clear:both;"></div>
</div>
<div class="login_box_footer"></div>

<footer class="login_footer"><?php echo $this->config->item('copy_right');?></footer>

<!--scripts-->
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/animate_jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/maps.googleapis.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/map.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.canvasjs.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
<!--scripts-->
<script type="text/javascript">
function validate_form()
{
	if(document.forget_pass.username.value=='')
	{
		alert('Please enter email');
		document.forget_pass.username.focus();
		return false;
	}
	else{
		$('#forgotpwd').submit();
	}
	
	//document.loginfrm.submit();
	//return true;
}
</script>
</body>
</html>
