<?php 
if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
{
?>

<form id="apply_form" action="<?php echo site_url('home/apply_jobs'); ?>"  class="formular" name="apply_form" method="post" enctype="multipart/form-data">
  <input type="hidden" name="job_id"  id="job_id" value="<?php echo $job['job_id'];?>">
  <?php if($hrcode!=''){?>
  <input type="hidden" name="hr_partner_code" id="hr_partner_code" value="<?php echo $hrcode;?>">
  <br />
  <?php }?>
  <div class="col-sm-4">
    <div class="panel panel-success">
      <div class="panel-heading"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i> Apply Now </strong></div>
      <br />
      <div class="panel-body">
        <label for="sel1">Your profile is already registered with us. <br>
          <br>
          <br>
          <br>
          <br>
          Please go to 'My Profile' after Job Application, make sure that your profile updated.</label>
        <br />
        <br />
        <div class="panel panel-success"> </div>
        <?php if(isset($job['job_applied']) && $job['job_applied']>0){ ?>
        <a href="javascript:;" class="btn btn-warning pull-right btn-xs" title="Already Applied for this Job">Applied</a>
        <?php }else{ ?>
        <button type="submit" id="button_apply_jobs" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Apply </strong></button>
        <?php } ?>
      </div>
    </div>
  </div>
</form>
<?php }else{ ?>
<div class="col-sm-4">
  <form id="register_form" action="<?php echo site_url('home/save_registration'); ?>"  class="formular" name="register_form" method="post" enctype="multipart/form-data">
    <input type="hidden" name="job_id"  id="job_id" value="<?php echo $job['job_id'];?>">
    <input type="hidden" name="lead_source"  id="lead_source" value="2">
    <input type="hidden" name="cur_job_status" value="3">
    <input type="hidden" name="passportno" value="">
    <input type="hidden" name="passport_type" value="">
    <input type="hidden" name="issued_date" value="">
    <input type="hidden" name="expiry_date" value="">
    <input type="hidden" name="place_of_issue" value="">
    <input type="hidden" name="passport_nationality" value="">
    <input type="hidden" name="visa_nationality" value="">
    <input type="hidden" name="visa_start_date" value="">
    <input type="hidden" name="visa_end_date" value="">
    <div class="panel panel-success">
      <div class="panel-heading"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i> Register Now</strong></div>
      <br />
      <div class="panel-body">
      
      
      <div class="panel panel-info">
          <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Personal Details</div>
          <div class="panel-body">
            <label for="sel1">Title: </label>
            <label class="radio-inline">
              <input type="radio" value="1" id="p_title" name="title" checked>
              Mr.</label>
            <label class="radio-inline">
              <input type="radio" value="2" id="p_title" name="title">
              Ms.</label>
            <label class="radio-inline">
              <input type="radio" value="3" id="p_title" name="title">
              Mrs.</label>
            <input type="text" name="first_name" value="" class="form-control input-sm" placeholder="Your Full Name" id="first_name">
            <br />
            <div class="form-group">
              <label for="sel1">Mobile: </label>
              <input type="text" name="mobile" class="form-control input-sm" placeholder="Mobile Phone" maxlength="11" id="mobile">
            </div>
            
          </div>
        </div>
      
        <div class="panel panel-info">
          <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i>Create Your Account</div>
          <div class="panel-body">
            <label for="sel1">Email</label>
            <input type="text" name="username" value="" class="form-control input-sm" placeholder="Your Email / Username" id="username">
            <a href="javascript:;" id="check_email" onclick="return check_email();">Check Availabiltiy</a>&nbsp;&nbsp;&nbsp;<span id="check_msg"></span> <br>
            <br>
            <div class="form-group">
              <label for="sel1">Create a Password</label>
              <input type="password" class="form-control input-sm" name="password" placeholder="Create Password" id="password">
              <br />
              <input type="password" class="form-control input-sm" name="c_password" placeholder="Confirm Password" id="c_password">
            </div>
          </div>
        </div>
        
        
        <div class="row">
          <div class="col-sm-6">
            
          </div>
        
        </div>
        
        
        <button type="button" id="submit_form" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Application </strong></button>
      </div>
    </div>
  </form>
</div>
<script language="javascript">
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
				url: "<?php echo $this->config->site_url();?>/home/check_email",
				cache: false,				
				data: {username:$('#username').val()},
				success: function(data){ 
					try{		
						var ret = jQuery.parseJSON(data);
						$('#check_msg').attr('style', ''); 
		   				$('#check_msg').hide();
						if(ret['STATUS']==0) 
						{
                            $('#check_msg').html('<i>Email address does not exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
			   				$('#check_msg').show();
							alert('Email / Username available !');
							return true;
						}else if(ret['STATUS']==1)
						{
                            $('#check_msg').html('<i>Email address already exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
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
		  url: '<?php echo $this->config->site_url();?>/home/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/home/getcity/',
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
</script>
<?php } ?>
