
<!--search results--> 
<br />
<div class="container-fluid">
  <div class="container">
  
    <div class="panel panel-default">
    <div style="padding-right:10px;">
   
</div>
      <div class="panel-heading"><strong>
      
        <h4><i class="fa fa-share" aria-hidden="true"></i><strong> Register your Profile</strong> </h4>
        </strong> 
        </div>
        
      <div class="panel-body">
      
        <div class="row box">
        
		<div class="col-sm-2"></div>


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
    
<div class="col-sm-8">
            <div class="panel panel-success">
              <div class="panel-heading"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i> Register Now</strong></div>
              <br />
              
              <div class="panel-body">
              <div class="panel panel-info">
  <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Personal Details</div>
  
  
  <div class="panel-body">
  
   <label for="sel1">Create Your Account</label> 

  <input type="text" name="username" class="form-control input-sm" placeholder="Your Email / Username" id="username">
  <a href="javascript:;" id="check_email" onclick="return check_email();">Check Availabiltiy</a>&nbsp;&nbsp;&nbsp;<span id="check_msg"></span><br><br>


    <input type="password" class="form-control input-sm" name="password" placeholder="Create Password" id="password"><br />
    <input type="password" class="form-control input-sm" name="c_password" placeholder="Confirm Password" id="c_password"><br />                            

  <label for="sel1">Personal Details</label> 
<br>

                            <label for="sel1">Title: </label> 
                                                         
                            <label class="radio-inline"><input type="radio" value="1" id="p_title" name="title" checked>Mr.</label>
							<label class="radio-inline"><input type="radio" value="2" id="p_title" name="title">Ms.</label>
                            <label class="radio-inline"><input type="radio" value="3" id="p_title" name="title">Mrs.</label>
                            
                            <br />
                                					 

  <input type="text" name="first_name" class="form-control input-sm" placeholder="Your Name" id="first_name"><br />

						<div class="form-group">
                          <label for="sel1">Mobile</label>
                          <input type="text" name="mobile" class="form-control input-sm" placeholder="Mobile Phone" maxlength="11" id="mobile">
                        </div>
                        
<!--                               
   <input type="text" class="form-control input-sm" maxlength="2" name="age" placeholder="Age" id="age"><br />
-->                            
                            <input type="text" class="form-control input-sm" name="date_of_birth" placeholder="Date of Birth" id="date_of_birth"><br />
                                                        <br />
                            <label for="sel1">Gender: </label>
                            
                            <label class="radio-inline"><input type="radio" id="gender_male" name="gender" checked>Male</label>
							<label class="radio-inline"><input type="radio" id="gender_female" name="gender">Female</label><br />

                            <label for="sel1">Marital Status: </label>        
                            
                            <label class="radio-inline"><input type="radio" value="2" id="marital_status" name="marital_status" checked>Single</label>                    
                            <label class="radio-inline"><input type="radio" value="1" id="marital_status" name="marital_status">Married</label>

							
                            <br>

                         <!-- 
                        <div class="form-group">
                          <label for="sel1">Nationality:</label>
                           <?php echo form_dropdown('nationality',  $nationality_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                        </div>
                        -->
                        <div class="form-group">
                        <!-- 
                           <label for="sel1">Country</label>
                           <?php echo form_dropdown('country_id',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="country_id"');?>
                           
                           <label for="sel1">State</label>
                           <?php echo form_dropdown('state_id',  $state_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="state_id"');?>
                           -->
                          <label for="sel1">Currently Located:</label>
                          <?php echo form_dropdown('city_id',  $current_location_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="city_id"');?>
                          
                        </div>
        
        
        				<div class="form-group">
                        
                           <label for="sel1">Preferred Locations</label>
                           <?php echo form_dropdown('pref_city_id[]',  $current_location_list, '','data-placeholder="Filter by status" multiple class="form-control input-sm" id="pref_city_id" style="height:200px;"');?>
                           
                           <label for="sel1">Industry</label>
                           <?php echo form_dropdown('job_cat_id',  $industry_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="job_cat_id"');?>
                           
                          <label for="sel1">Functional Area</label>
                          <?php echo form_dropdown('func_id',  $functional_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="func_id"');?>
                          
                          <label for="sel1">Designation/Role</label>
                          <?php echo form_dropdown('desig_id',  $roles_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="desig_id"');?>
                          
                        </div>
                        
                                                                
                           
                        
                            </div>
                            </div>
<!-- 
<div class="panel panel-info">
  <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> VISA Details</div>
  
  <div class="panel-body">

                            
                            <div class="form-group">
                           <label for="sel1">VISA Type:</label>
                         <?php echo form_dropdown('visa_type_id',  $visa_type_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                         </div>

 <label for="sel1">Release / NOC</label>   <br>                         
                            <label class="radio-inline"><input type="radio" value="Available" id="release_noc" name="release_noc" checked>Available</label>
							<label class="radio-inline"><input type="radio" value="Not Available" id="release_noc" name="release_noc">Not Available</label>
                        
                        
                        <br>
<br>

                        						
                        <div class="form-group">
                          <label for="sel1">Passport Number:</label>
                          <input type="text" name="passportno" placeholder="Passport Number" class="form-control input-sm" value="" maxlength="25">
                        </div>

                        <div class="form-group">
                          <label for="sel1">Issued From:</label>
                          <?php echo form_dropdown('passport_nationality',  $passport_nationality_list,'','class="form-control input-sm" id="passport_nationality"');?>
                        </div>

                           <div class="form-group">
                            <label for="sel1">Driving License?</label>                            
                            <label class="radio-inline"><input type="radio" value="1" id="driving_license_yes" onClick="$('#driving_license_row').show();" name="driving_license">Yes</label>
							<label class="radio-inline"><input type="radio" value="0" id="driving_license_no" onClick="$('#driving_license_row').hide();" name="driving_license">No</label><br />

                        <div  id="driving_license_row">
                          <label for="sel1">License Issued From</label>                          
                          <?php echo form_dropdown('driving_license_country',  $license_issued_list, '',' id="driving_license_country" data-placeholder="Filter by status" class="form-control input-sm"');?>
                        </div>
						</div>




                 
                            
                            </div>
 </div>
--> 
                                                    
                        <div class="panel panel-info">
                          <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Salary Preferences</div>
                          
                        <div class="panel-body">
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
							                          <?php echo  $this->config->item('currency_symbol');?> &nbsp;
                          <input type="text" class="form-control input-sm" name="current_ctc" placeholder="Current CTC" id="current_ctc">
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <?php echo  $this->config->item('currency_symbol');?> &nbsp;<input type="text" class="form-control input-sm" placeholder="Expected CTC" name="expected_ctc" id="expected_ctc">
                        </div></div>
                            </div>
<!-- 
                            <input type="text" class="form-control input-sm" placeholder="Reason for leaving" name="reason_to_leave" id="reason_to_leave"><br />  -->
                            
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
                            <label for="sel1">Current Job Status</label>
                          <?php echo form_dropdown('cur_job_status',  $job_status, '',' class="form-control input-sm" id="cur_job_status"');?>
                          </div>
                          </div>

<div class="panel panel-info">
                           <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Upload CV & Photo</div><br>
<br>

                     <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          &nbsp;&nbsp;&nbsp;<label for="sel1">Upload CV: [DOC, DOCX, PDF] </label>
                        </div>
                        
                        </div>
                            <div class="col-sm-6"> 
                            <?php echo form_upload(array('name'=>'cv_file','class'=>'class="btn btn-primary pull-right btn-sm"'));?>
                        
                        </div>
                            </div>
                     </div>
                     
                     
                            <div class="row">
                            <div class="col-sm-6"> 
                            
                            <div class="form-group">
                          
                         &nbsp;&nbsp;&nbsp;<label for="sel1">Upload Photo: [JPG, PNG] </label>
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <?php echo form_upload(array('name'=>'photo','class'=>'class="btn btn-primary"'));?>
                        </div></div>
                            </div><br>
</div>
   <button type="button" id="sbumit_form" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Application </strong></button>
                        
              
              </div>
            </div>
          </div>
</form>
          

          
        </div>
        
      </div>
      
    </div>
  </div>
</div>


<script src="<?php echo base_url('scripts/jquery-2.1.3.min.js');?>"></script>

<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script src="<?php echo base_url('scripts/jquery-1.11.3.min.js');?>"></script>
<script src="<?php echo base_url('scripts/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('scripts/dcalendar.picker.js');?>"></script>

<script type="text/javascript">
	$('#date_of_birth').dcalendarpicker();
	$('#datepickto').dcalendarpicker();
</script>

<script type="text/javascript">

var job_id=0;
/* form validation */
  function candidate_validate() {

		if($('#username').val()=='')
		{
			alert('Enter username');
			$('#username').focus();
			return false;
		}

		if($('#password').val()=='')
		{
			alert('Enter Password');
			$('#password').focus();
			return false;
		}

		if($('#c_password').val()=='')
		{
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
				
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
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

	 if($('#driving_license_yes').is(':checked')) 
	 { 
	 	if($('#driving_license_country').val()=='')
		{
		 	alert("Please select country of Driving License issued"); 
			return false;
		}
	 }

	    return true;
    }

	function getValidNumber(value)
	{
		var a = value;
		var filter = /^[0-9-+]+$/;
		
		if (filter.test(a)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
/* form validation ends here */
	
$('#sbumit_form').click(function(evt) 
{
	   evt.preventDefault();
	   var isContactValid = candidate_validate();
			if(!isContactValid) 
		   {
				return false;
		   }
	  	$.ajax({
				type: "post",
				url: "<?php echo $this->config->site_url();?>/signup/check_email",
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
				url: "<?php echo $this->config->site_url();?>/signup/check_email",
				cache: false,				
				data: {username:$('#username').val()},
				success: function(data){ 
					try{		
						var ret = jQuery.parseJSON(data);
						$('#check_msg').attr('style', ''); 
		   				$('#check_msg').hide();
						if(ret['status']==0) 
						{
                            $('#check_msg').html('<i>Email address does not exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
			   				$('#check_msg').show();
							alert('Email / Username available !');
							return true;
						}else if(ret['status']==1)
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
		  url: '<?php echo $this->config->site_url();?>/signup/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/signup/getcity/',
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