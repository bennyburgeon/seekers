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
  <form action="<?php echo $this->config->site_url();?>signup" class="form-horizontal" enctype="multipart/form-data" method="post" id="loginForm" name="frmentry" onSubmit="return validate()"  >
    <?php
			$length = 18;
$randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, $length);
//echo $randomletter;
			 ?>
    <input type="hidden" name="company_hash" value="<?php echo $randomletter; ?>"/>
    <h2>Employer Registration</h2>
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
    <table style="width:100%">
      <tr>
        <td width="30%">Email / Username</td>
        <td width="70%"><input type="text" id="contact_email" placeholder="Email" name="contact_email" class="form-control logins" value=""></td>
      </tr>
      <tr>
        <td>Create Password</td>
        <td colspan="2"><input type="password" id="password" placeholder="Password" name="password" class="form-control logins" value=""></td>
      </tr>
      <tr>
        <td>Confirm Password</td>
        <td colspan="2"><input type="password" id="c_password" placeholder="Confirm Password" name="c_password" class="form-control logins" value=""></td>
      </tr>
      <tr>
        <td>Company</td>
        <td colspan="2"><input type="text" id="company_name" placeholder="Company Name" name="company_name" class="form-control logins" value=""></td>
      </tr>
      <tr>
        <td>Address</td>
        <td colspan="2"><input type="text" id="address" placeholder="Address" name="address" class="form-control logins" value=""></td>
      </tr>
     <!-- <tr>
        <td>Country</td>
        <td colspan="2"><?php //echo form_dropdown('country_id', $country_list , $formdata['country_id'],'class="form-control logins"  id="country_id" ');?></td>
      </tr>-->
      <tr>
        <td>State</td>
        <td colspan="2"><?php echo form_dropdown('state_id', $state_list , $formdata['state_id'],'class="form-control logins"  id="state_id" ');?></td>
      </tr>
      <tr>
        <td>City</td>
        <td colspan="2"><?php echo form_dropdown('city_id', $city_list , $formdata['city_id'],'class="form-control logins"  id="city_id" ');?></td>
      </tr>
      <tr>
        <td>Pincode</td>
        <td colspan="2"><input type="text" id="pincode" placeholder="Pincode" name="pincode" class="form-control logins" value=""></td>
      </tr>
      <tr>
        <td>Contact Name</td>
        <td colspan="2"><input type="text" id="contact_name" placeholder="Contact Name" name="contact_name" class="form-control logins" value=""></td>
      </tr>
      
      
      <tr>
        <td>Designation</td>
        <td colspan="2"><input type="text" id="designation" placeholder="Designation" name="designation" class="form-control logins" value=""></td>
      </tr>
      <tr>
        <td>Mobile</td>
        <td colspan="2"><input type="text" id="contact_phone"  placeholder="Mobile" name="contact_phone" class="form-control logins" value=""></td>
      </tr>
      <tr>
        <td>Industry</td>
        <td colspan="2"><?php echo form_dropdown('ind_id', $industry_list , $formdata['ind_id'],'class="form-control logins"  id="ind_id" ');?></td>
      </tr>
      <tr>
        <td>Company Logo: </td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><input type="checkbox" name="chk_terms" id="chk_terms" value="1"/>
          &nbsp;&nbsp;&nbsp; I Agree to <a target="_blank" href="<?php echo $this->config->item('home_url'); ?>terms">Terms & Conditions</a></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="left"><input style="margin-left: 1%; background-color: #2980b9; color: aliceblue;" type="submit" name="submit" id="submit" class="btn green"/></td>
      </tr>
     </table>

      <input type="hidden" name="stdcode" value="" >
      <input type="hidden" name="telephone"value="">
      
      <!--pattern="\d{3}[\-]\d{3}[\-]\d{4}"-->
      
    
    <!--
<a href="javascript:void(0);" class="login_btn" onClick="validate()"><img src="<?php echo base_url('assets/images/login.png');?>"></a>--><br>

    <!--<a href="<?php echo $this->config->site_url();?>/forgottonpassword" class="forgot">Forgot Password?</a>-->
    <div style="clear:both;"></div>
  </form>
</div>
<br>
<br>
<br>
<div style="margin-top: -67px;" class="login_box_footer"><a href="<?php echo $this->config->site_url();?>login">Login</a></div>
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
    
    //document.addEventListener('contextmenu', event => event.preventDefault());
	
	$('#country_id').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');
		
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>signup/getstate/',
		  data: { country_id: $('#country_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#state_id').html('');
				  $.each(data.state_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#state_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#state_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Select State</option');
		  }
		});	
});
    
    $('#state_id').change(function() {

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
		
	if($('#state_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>signup/getcity/',
		  data: { state_id: $('#state_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#city_id').html('');
				  $.each(data.city_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#city_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#city_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Select City</option');
		  }
		});	
});

function validate()
{
    
	
	if($('#contact_email').val()=='')
	{
		alert('Please enter Username / Email');
		$('#contact_email').focus();
		return false;
	}	
	
	
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

		if(!pattern.test($('#contact_email').val())){

			alert('Enter valid email');

			$('#contact_email').focus();

			return false;

		}

	
	
    if($('#password').val()=='')
	{
		alert('Please enter Password');
		$('#password').focus();
		return false;
	}	
	
	if($('#password').val()=='')
	{
		alert('Please enter Password');
		$('#password').focus();
		return false;
	}	
	
	if($('#c_password').val()!=$('#password').val())
		{
			alert('Password mismatch, please correct');
			$('#c_password').focus();
			return false;
		}
		
		if($('#company_name').val()=='')
	{
		alert('Please enter Company Name');
		$('#company_name').focus();
		return false;
	}
    
    if($('#address').val()=='')
	{
		alert('Please enter address');
		$('#address').focus();
		return false;
	}
    if($('#state_id').val()=='' || $('#state_id').val()==0)
	{
		alert('Please select your state');
		$('#state_id').focus();
		return false;
	}
    
    if($('#city_id').val()=='' || $('#city_id').val()==0)
	{
		alert('Please select your city');
		$('#city_id').focus();
		return false;
	}
    
    if($('#pincode').val()=='')
	{
		alert('Please enter your pincode');
		$('#pincode').focus();
		return false;
	}
    
    if($('#designation').val()=='')
	{
		alert('Please enter your designation');
		$('#designation').focus();
		return false;
	}
    
   
    if($('#contact_phone').val()=='')
	{
		alert('Please enter Mobile');
		$('#contact_phone').focus();
		return false;
	}
    
    var phoneno = /^\d{10}$/;
     if(!$('#contact_phone').val().match(phoneno))
        {
       alert('Please enter ten digit mobile number');
		$('#contact_phone').focus();
		return false;
     } 
	
	if($('#contact_name').val()=='')
	{
		alert('Please enter your name');
		$('#contact_name').focus();
		return false;
	}
	
		
	
	
   var terms = $("input#chk_terms");

        if (terms.is(":checked")) {
            send_data(terms.val());
        } else {
            alert("Please check Terms & Conditions");
        }	return false;
		
	
	//$('#loginForm').submit();	
	return true;
}

/*$( ":input" ).keypress(function( event ) {
  if ( event.which == 13 ) {
   //$('#loginForm').submit();
   validate();
  }
});*/

</script>
</body>
</html>
