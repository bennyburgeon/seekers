<!doctype html>
<html>
<head>
<link rel="shortcut icon" href="images/fav.ico">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/device.css');?>" rel="stylesheet" type="text/css">
<title>SeekEasy.com</title>
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
<?php if($pass_status['status']=='0'){ ?> <p class="center"><label class="color-red"><?php echo 'Invalid/Expired Link.'; ?></label></p> <?php } else{?>
<form action="<?php echo $this->config->site_url()?>/resetpassword" role="form" name="reset_pass" method="post" enctype="multipart/form-data" class="form-horizontal" id="resetForm">
<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id;?>" />
<h2>Reset Password</h2>
<input type="password" id="password" name="password" class="form-control logins" >
<input type="password" id="cpassword" name="cpassword" class="form-control logins" >
<a href="javascript:void(0);" class="login_btn" onclick="validate_form()"><img src="<?php echo base_url('assets/images/reset.png');?>"></a>
 <!--<button type="submit" class="btn green">Submit</button>-->
<div style="clear:both;"></div>
</form>
 <?php } ?>



</div>
<div class="login_box_footer"></div>

<footer class="login_footer">Seekers Consultancy LLC. P.O Box. 20893, Dubai, UAE || Phone:+971 4 26 93 600 || Email: info@seekersgulf.com</footer>
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
	function validate_form()
	{
		if(document.reset_pass.password.value=='')
		{
			alert('Please enter password');
			document.reset_pass.password.focus();
			return false;
		}
		else if(document.reset_pass.cpassword.value=='')
		{
			alert('Please confirm password');
			document.reset_pass.cpassword.focus();
			return false;
		}
		else{
			if(document.reset_pass.password.value != document.reset_pass.cpassword.value)
			{
				alert('Password is not match');
				document.reset_pass.cpassword.focus();
				return false;
			}
			else{
				$('#resetForm').submit();
			}
			//return true;
		}	
	}
</script> 


</body>
</html>
