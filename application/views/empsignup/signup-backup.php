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
     </table>
      <table width="100%">
      <tr>
        <td width="30%">Land Line (Optional)</td>
        <td width="15%"><input type="text" id="stdcode" name="stdcode" placeholder="Std Code" class="form-control logins" ></td>
        <td width="55%"><input type="text" id="telephone" placeholder="Land Line" name="telephone" class="form-control logins" value=""></td>
      </tr>
      </table>
      
      <table width="100%">
      <tr>
        <td width="30%">Mobile</td>
        <td width="15%"><input readonly type="text" id="ext" name="ext" value="+ 91" autocomplete="off" class="form-control logins" ></td>
        <td width="55%"><input type="text" id="contact_phone"  placeholder="Mobile" name="contact_phone" class="form-control logins" value=""></td>
      </tr>
      </table>
      <!--pattern="\d{3}[\-]\d{3}[\-]\d{4}"-->
      <table width="100%">
      <tr>
        <td width="30%"v>GST: (Optional)</td>
        <td width="70%" colspan="2"><!--<?php //echo form_upload(array('name'=>'gst_file','class'=>'form-data'));?>-->
          
          <input type="text" id="gstno" placeholder="GST No" name="gstno" class="form-control logins" value=""></td>
      </tr>
      <tr>
        <td>Industry</td>
        <td colspan="2"><?php echo form_dropdown('ind_id', $industry_list , $formdata['ind_id'],'class="form-control logins"  id="ind_id" ');?></td>
      </tr>
      
      <tr>
        <td>Company Logo: </td>
        <td><?php echo form_upload(array('name'=>'company_logo','class'=>'form-data','id'=>'company_logo'));?></td>
      </tr>
      
      <!-- <tr>
        <td>Upload Aadhar: </td>
        <td><?php //echo form_upload(array('name'=>'aadhar_file','class'=>'form-data'));?></td>
      </tr>
      <tr>
        <td>Upload PAN: </td>
        <td><?php //echo form_upload(array('name'=>'pan_file','class'=>'form-data'));?></td>
      </tr> -->
      
      
      <tr>
        <td colspan="3"><input type="checkbox" name="chk_terms" id="chk_terms" value="1"/>
          &nbsp;&nbsp;&nbsp; I Agree to <a target="_blank" href="<?php echo $this->config->item('home_url'); ?>terms">Terms & Conditions</a></td>
      </tr>
    </table>
    
    <!--
<a href="javascript:void(0);" class="login_btn" onClick="validate()"><img src="<?php echo base_url('assets/images/login.png');?>"></a>--><br>
    <input style="margin-left: 34%; background-color: #2980b9; color: aliceblue;" type="submit" name="submit" id="submit" class="btn green"/>
    
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
    
    if($('#ext').val()=='')
	{
		alert('Please enter Mobile extention');
		$('#ext').focus();
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


<div class="joblisting">
  <div class="container"> 

  <div>
  <!-- item1 -->         
  <div class="col-md-8 col-lg-8 col-sm-12 mx-auto">
    <form id="register_form" action="<?php echo site_url('signup/save_registration'); ?>"  class="formular" name="register_form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="lead_source"  id="lead_source" value="2">
    <input type="hidden" name="cur_job_status" value="3">
    <input type="hidden" name="passportno" value="">
    <input type="hidden" name="passportno" value="">
    <input type="hidden" name="passport_type" value="">
    <input type="hidden" name="issued_date" value="">
    <input type="hidden" name="expiry_date" value="">
    <input type="hidden" name="place_of_issue" value="">
    <input type="hidden" name="passport_nationality" value="">
    <input type="hidden" name="visa_nationality" value="">
    <input type="hidden" name="visa_start_date" value="">
    <input type="hidden" name="visa_end_date" value="">
    <input type="hidden" name="lead_source"  id="lead_source" value="2">
    <input type="hidden" name="hrcode"  id="hrcode" value="">
    <input type="hidden" name="job_id" id="job_id" value="<?php echo $job_id?>" >      
    <input type="hidden" name="referral" id="referral" value="<?php echo $referral?>" >      
    <div class="panel panel-success filterstyle registerfrm "> 
        <div class="panel-headingsd"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i> Register Now</strong></div>

        <div class="panel-body">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Personal Details</div>
            <div class="panel-body">
                <label for="sel1">Create Your Account</label> 
                <div class="form-group">
                    <input type="text" name="first_name" value="" class="form-control input-sm" placeholder="Your Full Name" id="first_name">
                </div>
                <div class="form-group">
                    <input type="text" name="username" class="form-control input-sm" placeholder="Your Email / Username" id="username">
                    <a href="javascript:;" id="check_email" onclick="return check_email();">Check Availabiltiy</a>&nbsp;&nbsp;&nbsp;<span id="check_msg"></span>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control input-sm" name="password" placeholder="Create Password" id="password"><br>
                    <input type="password" class="form-control input-sm" name="c_password" placeholder="Confirm Password" id="c_password">
                </div>
                
                <div class="form-group">
                    <label for="sel1">Mobile</label>
                    <input type="text" name="mobile" class="form-control input-sm" placeholder="Mobile Phone" maxlength="10" id="mobile">
                </div>
            </div>
        </div>
        <!--<div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Lookign for a Full time job ? Fill Salary & Notice Period</div>
        <div class="row">
            <div class="col-sm-4"> 
                <label for="sel1">Current Salary</label>
                <div class="form-group">
                    <?php echo form_dropdown('current_ctc', $current_ctc, '','class="form-control hori"  id="current_ctc" ');?>
                </div>
            </div>            
            <div class="col-sm-4" style="overflow:hidden;"> 
                <label for="sel1">Expected Salary</label>
                <?php echo form_dropdown('expected_ctc', $expected_ctc, '','class="form-control hori"  id="expected_ctc" ');?>                
            </div>
            <div class="col-sm-4" style="overflow:hidden;"> 
                <label for="sel1">Notice Period[For Fulltime Job]</label>
                <select class="form-control input-sm" id="sel1" name="notice_period">
                    <option value="">Notice Period</option>
                    <option value="Immediate">Immediate</option>
                    <option value="7 Days">7 Days</option>
                    <?php for($i=10;$i<=90;$i += 10){?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                    <?php }?>
                </select>        
            </div>
            <div class="col-sm-4" style="overflow:hidden;"> 
                <label for="sel1">Total Experience</label>
                <select class="form-control input-sm" id="sel1" name="total_experience">
                    <option value="">Total Experience</option>
                    <?php for($i=1;$i<=40;$i += 1){?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                    <?php }?>
                </select>       
            </div>
        </div> -->
        <!--<div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Looking for a Part Time works ? Fill your expectation</div>     		
        <div class="row">
            <div class="col-sm-4" style="overflow:hidden;"> 
              <div class="form-group">
                <label for="sel1">Availability in Weekdays </label>
                <select class="form-control input-sm" id="availability_weekdays" name="availability_weekdays">
                    <option value="">In Weekdays</option>
				    <?php for($i=4;$i<=250;$i += 2){?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Hours</option>
                    <?php }?>
                </select>  
              </div>  
            </div>
        
            <div class="col-sm-4" style="overflow:hidden;"> 
              <div class="form-group">
                <label for="sel1">Availability in Weekdends</label>
                <select class="form-control input-sm" id="availability_weekend" name="availability_weekend">
                    <option value="">In Weekdends</option>
                    <?php for($i=4;$i<=250;$i += 2){ ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Hours</option>
                    <?php  }?>
                </select>
              </div>
            </div>
            <div class="col-sm-4" style="overflow:hidden;">
              <div class="form-group"> 
                <label for="sel1">Availability in Holidays</label>
                <select class="form-control input-sm" id="availability_holidays" name="availability_holidays">
                    <option value="">In Holidays</option>
                    <?php for($i=4;$i<=250;$i += 2){?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?> Hours</option>
                    <?php } ?>
                </select> 
              </div>           
            </div>                            
        </div>
        <div class="row">
            <div class="col-sm-4" style="overflow:hidden;"> 
              <div class="form-group">
                <label for="sel1">Rate per Hour</label>
                <input type="text" name="hourly_rate" class="form-control input-sm" placeholder="INR/Hour" maxlength="10" id="hourly_rate">
              </div>
            </div>
        </div> -->
        <!--<div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i>Select Skills and Experience</div>
        <div class="row">
            <div class="col-sm-6"> 
                <label for="sel1">Skill 1</label>
                <div class="form-group">
                    <?php echo form_dropdown('skill1', $all_skills_list, (array_key_exists(0, $cur_skills_list)) ? $cur_skills_list[0]['skill_id'] : '','class="form-control skill-id"  id="skill1" readonly');?>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="sel1">Total Experience in Skill 1</label>
                <div class="form-group">
                    <input type="text" name="exp_skill1" class="form-control input-sm skill-exp" placeholder="Years of Exp in Skill 1" maxlength="10" id="exp_skill1">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="sel1">Skill 2</label>
                <div class="form-group">
                    <?php echo form_dropdown('skill2', $all_skills_list, (array_key_exists(1, $cur_skills_list)) ? $cur_skills_list[1]['skill_id'] : '','class="form-control skill-id"  id="skill2" ');?>
                </div>
            </div>
            <div class="col-sm-6"> 
                <label for="sel1">Total Experience in Skill 2</label>
                <div class="form-group">
                    <input type="text" name="exp_skill2" class="form-control input-sm skill-exp" placeholder="Years of Exp in Skill 2" maxlength="10" id="exp_skill2">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"> 
                <label for="sel1">Skill 3</label>
                <div class="form-group">
                    <?php echo form_dropdown('skill3', $all_skills_list, (array_key_exists(2, $cur_skills_list)) ? $cur_skills_list[2]['skill_id'] : '','class="form-control skill-id"  id="skill3" ');?>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="sel1">Total Experience in Skill 3</label>
                <div class="form-group">
                    <input type="text" name="exp_skill3" class="form-control input-sm skill-exp" placeholder="Years of Exp in Skill 3" maxlength="10" id="exp_skill3">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6"> 
                <label for="sel1">Skill 4</label>
                <div class="form-group">
                    <?php echo form_dropdown('skill4', $all_skills_list, (array_key_exists(3, $cur_skills_list)) ? $cur_skills_list[3]['skill_id'] : '','class="form-control skill-id"  id="skill4" ');?>
                </div> 
            </div>
            <div class="col-sm-6">
                <label for="sel1">Total Experience in Skill 4</label>
                <div class="form-group">
                    <input type="text" name="exp_skill4" class="form-control input-sm skill-exp" placeholder="Years of Exp in Skill 4" maxlength="10" id="exp_skill4">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="sel1">Skill 5</label>
                <div class="form-group">
                    <?php echo form_dropdown('skill5', $all_skills_list, (array_key_exists(4, $cur_skills_list)) ? $cur_skills_list[4]['skill_id'] : '','class="form-control skill-id"  id="skill5" ');?>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="sel1">Total Experience in Skill 5</label>
                <div class="form-group">
                    <input type="text" name="exp_skill5" class="form-control input-sm skill-exp" placeholder="Years of Exp in Skill 5" maxlength="10" id="exp_skill5">
                </div>
            </div>
        </div>  -->  
       
        <!--<div class="row">
            <div class="col-sm-6"> 
                <div class="form-group">
                    <label for="sel1">CV: </label>
                </div>
            </div>
            <div class="col-sm-6" style="overflow:hidden;"> 
                <input type="file" name="cv_file" value="" class="">                        
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="sel1">Upload  Photo: </label>
                </div>
            </div>
            <div class="col-sm-6" style="overflow:hidden;"> 
                <input type="file" name="photo" value="" class="">                        </div>
            </div>
        </div>-->
        <div class="row">
            <div class="col-sm-6" style="overflow:hidden;"> 
            <input type="checkbox" name="chk_terms" id="chk_terms" value="1" checked/>
          &nbsp;&nbsp;&nbsp; I Agree to the <a target="_blank" href="<?php echo base_url(); ?>terms">Terms & Conditions</a>                     
            </div>
        </div>                          
        <button type="button" id="submit_form" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Register </strong></button>
    </div>
    </form>
  </div>

</div>             
<!-- item1 -->    
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
<script>
$( function() {
    $( "#date_of_birth" ).datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: "1950:<?php echo date('Y')?>",
        dateFormat: "yy-mm-dd"
    });
} );

$('.skill-id').change(function(e){
    var cIndex = $('.skill-id').index(this);
    var skillId  = $(this).val();
    if ( skillId != '' ){
        $('.skill-id').each(function( index ){ 
            if ( $(this).val() == skillId &&  cIndex != index  ){
                alert('Duplicate  skill selection !');
                return false;
            }
        });
    }
    
})

</script> 
<script type="text/javascript">
var job_id=0;
/* form validation */
function candidate_validate() {
    if($('#first_name').val()==''){
        alert('Enter Your Name');
        $('#first_name').focus();
        return false;
    }   
    /* if ( validateSkill() == false ){
        return false;
    } */
	if($('#username').val()==''){
		alert('Enter Email/Username');
		$('#username').focus();
		return false;
	}
    if($('#password').val()=='')
	{
		alert('Enter Your Password');
		$('#password').focus();
		return false;
	}
    if($('#c_password').val()==''){
		alert('Confirm Your Password');
		$('#c_password').focus();
		return false;
	}
	if($('#c_password').val()!=$('#password').val())
	{
		alert('Password mismatch, please correct');
		$('#c_password').focus();
		return false;
	}
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	if(!pattern.test($('#username').val())){
		alert('Enter valid email');
		$('#username').focus();
		return false;
	}
	if($('#mobile').val()=='')
	{
		alert('Enter mobile');
		$('#mobile').focus();
		return false;
	}
	var mobile_check=getValidNumber($('#mobile').val());
	if(mobile_check==false)
	{
		alert('Please enter valid mobile number');
		$('#mobile').focus();
		return false;
	}
    return true;
}
function validateSkill(){
    var skillSelected =  $(".skill-id").filter(function(){
            return +this.value > 0;
        }).length;

    if ( skillSelected < 3 ){
        alert("Select any three skills minimum !");
        return false;
    }
    var valid = true;
    $('.skill-id').each(function( index ){ 
        if ( $(this).val() != ''  && $('.skill-exp').eq(index).val() == '' ){
            $('.skill-exp').eq(index).focus();
            alert('Enter experience  in selected skill !');
            valid = false;
            return false;
        }
    });
    return valid;
}

function getValidNumber(value)
{
	var a = value;
	var filter = /^[0-9-+]+$/;
	if (filter.test(a)) {
		return true;
	}
	else {
		return false;
	}
}

/* form validation ends here */

	
$('#submit_form').click(function(evt) {
    evt.preventDefault();
    var isContactValid = candidate_validate();
    if(!isContactValid) {
    	return false;
    }
	$.ajax({
		type: "post",
		url: "<?php echo $this->config->site_url();?>signup/check_email",
		cache: false,				
		data: {username:$('#username').val()},
		success: function(data){ 
			try{		
				var ret = jQuery.parseJSON(data);
				if(ret['status']=='1') 
				{
					alert('Email already exist. Please change.');
					return false;
				}else 
				{
					$('#register_form').submit();
					return true;
				}
			}
			catch(e) {		
				alert('Exception occured while chekcing email duplication');
				return false;
			}	
		},
		error: function(){						
			alert('An Error has been found on Ajax request from duplicate check [Email]');
			return false;
		}
	});//end ajax
});

function check_email()
{
    var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
    var email=$('#username').val();					
    if($('#username').val()=='')
    {
    	alert('Enter Username or Email');
    	$('#username').focus();
    	return false;
    }
    if(!pattern.test($('#username').val())){
    	alert('Enter valid email');
    	$('#username').focus();
    	return false;
    }

    $.ajax({
    	type: "post",
    	url: "<?php echo $this->config->site_url();?>signup/check_email",
    	cache: false,				
    	data: {username:$('#username').val()},
    	success: function(data){ 
    		try{		
    			var ret = jQuery.parseJSON(data);
    			$('#check_msg').attr('style', ''); 
    			$('#check_msg').hide();
    			if(ret['status']==0) {
                    $('#check_msg').html('<i>Email address does not exist.</i>');
       				$('#check_msg').css('color','#2B983F');
       				$('#check_msg').show();
    				alert('Email / Username available !');
    				return true;
    			}else if(ret['status']==1){
                    $('#check_msg').html('<i>Email address already exist.</i>');
       				$('#check_msg').css('color','#f30808');
       				$('#check_msg').show();
    				alert('Email exists, please change, or click login -> change password to get access.');
    				return false;
    			}
    		}
    		catch(e) {		
    			alert('Exception occured while adding contact.');
    			return false;
    		}	
    	},
    	error: function(){						
    		alert('An Error has been found on Ajax request from contact save');
    		return false;
    	}
    });//end ajax
}
</script> 
<script type="text/javascript">
$('#country_id').change(function() {
	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');
	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
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
			    if(data.success==true){
                    jQuery('#state_id').html('');
                        $.each(data.state_list, function (index, value) {
                        if(index=='')
                    	    jQuery('#state_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
                        else
                            jQuery('#state_id').append('<option value="'+ index +'">'+ value +'</option');
				 });
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
			if(data.success==true){
                jQuery('#city_id').html('');
                $.each(data.city_list, function (index, value) {
					if(index=='')
						jQuery('#city_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					else
						jQuery('#city_id').append('<option value="'+ index +'">' + value + '</option');
				});
            }else{
			  	alert(data.success);

			}

		},error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Select City</option');
		}
	});	

});
</script> 
<script type="text/javascript">
	$('#job_cat_id').change(function() {
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');
	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');
	if($('#job_cat_id').val()=='')return;
		$.ajax({
            type: 'POST',
            url: '<?php echo $this->config->site_url();?>signup/get_functional_by_industry/',
            data: { job_cat_id: $('#job_cat_id').val()},
            dataType: 'json',
            beforeSend:function(){
            	jQuery('#func_id').html('');
            	jQuery('#func_id').append('<option value="">Loading...</option');
            },
            success:function(data){
                if(data.success==true){
				    jQuery('#func_id').html('');
                    $.each(data.func_list, function (index, value) {
                        if(index=='')
                            jQuery('#func_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
                        else
						    jQuery('#func_id').append('<option value="'+ index +'">'+ value +'</option');

				    });						
			     }
		 	},
		    error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Select Functional Area</option');

		    }
		});	

});
$('#func_id').change(function() {
	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');
	if($('#func_id').val()=='')return;
	$.ajax({
        type: 'POST',
        url: '<?php echo $this->config->site_url();?>signup/get_designation_by_functional/',
        data: { func_id: $('#func_id').val()},
        dataType: 'json',
        beforeSend:function(){
        	jQuery('#desig_id').html('');
        	jQuery('#desig_id').append('<option value="">Loading...</option');
        },
        success:function(data){
            if(data.success==true)
            {
                jQuery('#desig_id').html('');
                $.each(data.desig_list, function (index, value) {
                    if(index=='')
                        jQuery('#desig_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
                    else
                        jQuery('#desig_id').append('<option value="'+ index +'">'+ value +'</option');
                });						
            }
        },
        error:function(){
            alert('Problem with server. Pelase try again');
            jQuery('#desig_id').html('');
            jQuery('#desig_id').append('<option value="">Select Designation</option');
        }
	});	
});
</script>               
</div> 
</div>
</div>
