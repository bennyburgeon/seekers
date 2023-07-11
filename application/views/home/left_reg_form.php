<?php 
if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
{
?>
                    
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
Please go to 'My Seekers' after Job Application, make sure that your profile updated.</label><br />
        <br />
                        

<div class="panel panel-success">
                        
                          </div>

<?php if(isset($job['job_applied']) && $job['job_applied']>0){ ?>

<a href="javascript:;" class="btn btn-warning pull-right btn-xs" title="Already Applied for this Job">Applied</a>

<?php }else{ ?>                                                                                


<form id="apply_form" action="<?php echo site_url('home/apply_jobs'); ?>"  class="formular" name="apply_form" method="post" enctype="multipart/form-data">

    <input type="hidden" name="job_id"  id="job_id" value="<?php echo $job['job_id'];?>">

 <button type="submit" id="button_apply_jobs" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Apply </strong></button>
 </form>
                           
 
<?php } ?>                        
              
              </div>
            </div>
          </div>
</form>
<?php }else{ ?>
<form id="register_form" action="<?php echo site_url('home/save_registration'); ?>"  class="formular" name="register_form" method="post" enctype="multipart/form-data">

    <input type="hidden" name="job_id"  id="job_id" value="<?php echo $job['job_id'];?>">
    
    <input type="hidden" name="lead_source"  id="lead_source" value="2">  
    <input type="hidden" name="cur_job_status" value="3">
    
     <input type="hidden" name="date_of_birth" value="">
     
      <input type="hidden" name="passportno" value="">
      <input type="hidden" name="passport_type" value="">
      <input type="hidden" name="issued_date" value="">
      <input type="hidden" name="expiry_date" value="">
      <input type="hidden" name="place_of_issue" value="">
 	  <input type="hidden" name="passport_nationality" value="">
      
      <input type="hidden" name="visa_nationality" value="">
      <input type="hidden" name="visa_start_date" value="">
      <input type="hidden" name="visa_end_date" value="">

                    
<div class="col-sm-4">
            <div class="panel panel-success">
              <div class="panel-heading"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i> Register Now</strong></div>
              <br />
              
              <div class="panel-body">
              <div class="panel panel-info">
  <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Personal Details</div>
  <div class="panel-body">
  
 <label for="sel1">Create Your Account</label> 
  
                            <input type="text" name="username" value="" class="form-control input-sm" placeholder="Your Email / Username" id="username">
                            
							<a href="javascript:;" id="check_email" onclick="return check_email();">Check Availabiltiy</a>&nbsp;&nbsp;&nbsp;<span id="check_msg"></span>

							<br>
                            <br>

                              <div class="form-group">
                            <input type="password" class="form-control input-sm" name="password" placeholder="Create Password" id="password"><br />
                            <input type="password" class="form-control input-sm" name="c_password" placeholder="Confirm Password" id="c_password"><br />
                            </div>
<label for="sel1">Personal Details</label><br>


                            <label for="sel1">Title: </label> 
                                                         
                            <label class="radio-inline"><input type="radio" value="1" id="p_title" name="title" checked>Mr.</label>
							<label class="radio-inline"><input type="radio" value="2" id="p_title" name="title">Ms.</label>
                            <label class="radio-inline"><input type="radio" value="3" id="p_title" name="title">Mrs.</label>
                            
                            <br />
                            
  							<input type="text" name="first_name" value="" class="form-control input-sm" placeholder="Your Full Name" id="first_name"><br />
    

                                                        
                            <div class="form-group">
                            
                            <!-- 
                             <input type="text" class="form-control input-sm" maxlength="2" name="age" placeholder="Age" id="age"><br>
							-->
                            
                            <input type="text" class="form-control input-sm" name="date_of_birth" placeholder="Date of Birth" id="date_of_birth"><br />
                                                       
                            </div> 
                                                       
                            <label for="sel1">Gender: </label>
                            
                            <label class="radio-inline"><input type="radio" value="1" id="gender_male" name="gender" checked>Male</label>
							<label class="radio-inline"><input type="radio" value="2" id="gender_female" name="gender">Female</label><br />
                            
                            <label for="sel1">Marital Status: </label>                            
                            <label class="radio-inline"><input type="radio" value="1" id="marital_status" name="marital_status">Married</label>
							<label class="radio-inline"><input type="radio" value="2" id="marital_status" name="marital_status" checked>Single</label><br />
                              
      					<div class="form-group">
                          <label for="sel1">Nationality:</label>
                           <?php echo form_dropdown('nationality',  $nationality_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                        </div>
                        
                        <div class="form-group">
                           <label for="sel1">Country</label>
                           <?php echo form_dropdown('country_id',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="country_id"');?>
                           
                           <label for="sel1">State</label>
                           <?php echo form_dropdown('state_id',  $state_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="state_id"');?>
                           
                          <label for="sel1">City:</label>
                          <?php echo form_dropdown('city_id',  $city_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="city_id"');?>
                          
                        </div>    

                       <div class="row">

                       <div class="col-sm-6"> 
                            
                       <div class="form-group">
                          <label for="sel1"></label>
                          <input type="text" name="mobile" class="form-control input-sm" placeholder="Mobile Phone" maxlength="11" id="mobile">
                        </div>

                      
                                                
                        </div>
                        
                       </div>
                                                   
                            </div>
                            </div>
              
                        
                        <div class="panel panel-info">
                         <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> VISA Details</div>
                        <div class="panel-body">
                        	
                            <div class="form-group">
                        <!-- 
                        <div class="form-group">
                          <label for="sel1">Passport Number:</label>
                          <input type="text" name="passportno" placeholder="Passport Number" class="form-control input-sm" value="" maxlength="25">
                        </div>

                        <div class="form-group">
                          <label for="sel1">Issued From:</label>
                          <?php echo form_dropdown('passport_nationality',  $passport_nationality_list,'','class="form-control input-sm" id="passport_nationality"');?>
                        </div>
                       -->        
                        
                        
                          <label for="sel1">VISA Type</label><br />
                            
                            

                          
                          <?php echo form_dropdown('visa_type_id',  $visa_type_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                <br />
                 
       						<label for="sel1">Release / NOC</label>   <br>                         
                            <label class="radio-inline"><input type="radio" value="Available" id="release_noc" name="release_noc" checked>Available</label>
							<label class="radio-inline"><input type="radio" value="Not Available" id="release_noc" name="release_noc">Not Available</label>
                           
                        </div>
 
                            <label for="sel1">Driving License?</label>                            
                            <label class="radio-inline"><input type="radio" value="1" id="driving_license_yes" onClick="$('#driving_license_row').show();" name="driving_license">Yes</label>
							<label class="radio-inline"><input type="radio" value="0" id="driving_license_no" onClick="$('#driving_license_row').hide();" name="driving_license">No</label>

						</div>
                        
                        <div  class="panel-body" id="driving_license_row">
                          <label for="sel1">License Issued From</label>
                          
                          <?php echo form_dropdown('driving_license_country',  $license_issued_list, '','id="driving_license_country" data-placeholder="Filter by status" class="form-control input-sm"');?>
                                                      
                            </div>
                            </div>	
                        
                        
                        
                        

<div class="panel panel-info">
 <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Salary Details</div>
                        <div class="panel-body">
                            <label for="sel1">Salary Expectation: </label><br />
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
							                          
                        <?php echo $this->config->item('currency_symbol');?>  &nbsp;  <input type="text" class="form-control input-sm" name="current_ctc" placeholder="Current CTC" id="current_ctc">
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                      <?php echo $this->config->item('currency_symbol');?>  &nbsp;    <input type="text" class="form-control input-sm" placeholder="Expected CTC" name="expected_ctc" id="expected_ctc">
                        </div></div>
                            </div>
                            
                            
                            
                            <input type="text" class="form-control input-sm" placeholder="Reason for leaving" name="reason_to_leave" id="reason_to_leave"><br />
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          <select class="form-control input-sm" id="sel1" name="notice_period">
                            <option value="">Notice Period</option>
                          <?php for($i=1;$i<=200;$i++){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                      <?php
                }?>
                          </select>
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          <select class="form-control input-sm" id="sel1" name="total_experience">
                            <option value="">Total Experience</option>
			 <?php for($i=1;$i<=30;$i += 0.5){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                      <?php
                }?>
                          </select>
                        </div></div>
                            </div>
                            <label for="sel1"></label>
                          <select class="form-control input-sm" id="sel1">
                            <option value="">GCC Experience</option>
			 <?php for($i=1;$i<=30;$i += 0.5){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                      <?php
                }?>
                          </select>
                          </div>
                          </div>
                                                    
                          <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          <label for="sel1">CV: </label>
                        </div></div>
                            <div class="col-sm-6" style="overflow:hidden;"> 
                            <?php echo form_upload(array('name'=>'cv_file','class'=>''));?>
                        
                        </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          <label for="sel1">Upload  Photo: </label>
                        </div></div>
                            <div class="col-sm-6"  style="overflow:hidden;"> 
                          <?php echo form_upload(array('name'=>'photo','class'=>''));?>
                        </div>
                            </div>
                          
   <button type="button" id="submit_form" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Application </strong></button>
                        
              
              </div>
            </div>
          </div>
</form>

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