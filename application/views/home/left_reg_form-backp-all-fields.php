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
  
                            <label for="sel1">Title: </label> 
                                                         
                            <label class="radio-inline"><input type="radio" value="1" id="marital_status" name="title" checked>Mr.</label>
							<label class="radio-inline"><input type="radio" value="2" id="marital_status" name="title">Ms.</label>
                            <label class="radio-inline"><input type="radio" value="3" id="marital_status" name="title">Mrs.</label>
                            
                            <br />
                            
  <input type="text" name="first_name" value="" class="form-control input-sm" placeholder="Your Full Name" id="first_name"><br />
                            <input type="text" name="username" value="" class="form-control input-sm" placeholder="Your Email / Username" id="username">
                            
<a href="javascript:;" id="check_email" onclick="return check_email();">Check Availabiltiy</a>&nbsp;&nbsp;&nbsp;<span id="check_msg"></span><br>
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          
  <?php echo form_dropdown('mobile_prefix',  $country_intl_code, '','data-placeholder="Filter by status" class="form-control input-sm" ');?>
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          <input type="text" name="mobile" class="form-control input-sm" placeholder="Mobile Phone" maxlength="11" id="mobile">
                        </div></div>
                            </div>
                            <input type="text" class="form-control input-sm" name="password" placeholder="Create Password" id="password"><br />
                             <input type="text" class="form-control input-sm" name="age" placeholder="Age" id="age"><br />
                            
                            <label for="sel1">Gender: </label>
                            
                            <label class="radio-inline"><input type="radio" value="1" id="gender_male" name="gender" checked>Male</label>
							<label class="radio-inline"><input type="radio" value="2" id="gender_female" name="gender">Female</label><br />
                            
                            <label for="sel1">Marital Status: </label>                            
                            <label class="radio-inline"><input type="radio" value="1" id="marital_status" name="marital_status">Married</label>
							<label class="radio-inline"><input type="radio" value="2" id="marital_status" name="marital_status" checked>Unmarried</label><br />
                            
                            <div class="form-group">
                        <div class="form-group">
                          <label for="sel1">Nationality:</label>
                           <?php echo form_dropdown('nationality',  $nationality_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                        </div>
                        
                        <div class="form-group">
                          <label for="sel1">Currently Located:</label>
                          <?php echo form_dropdown('current_location',  $current_nationality_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                          
                        </div>
                        </div>
                            
                            </div>
                            </div>
              
                        
                        <div class="panel panel-default">
                        <div class="panel-body">
                        	
                          <label for="sel1">VISA Details</label><br />
                            
                            

                          <label for="sel1">Type</label>
                          
                          <?php echo form_dropdown('visa_type_id',  $visa_type_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                <br />
                 <input type="text" class="form-control input-sm" placeholder="Release / NOC" name="release_noc" id="release_noc">
                            <label for="sel1">Driving License?</label>                            
                            <label class="radio-inline"><input type="radio" value="Yes" id="marital_status" name="driving_license">Yes</label>
							<label class="radio-inline"><input type="radio" value="No" id="marital_status" name="driving_license" checked>No</label><br />


                          <label for="sel1">License Issued From</label>
                          
                          <?php echo form_dropdown('driving_license_country',  $visa_issued_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                                                      
                            </div>
                            </div>	
                        
                        <div class="panel panel-info">
                        <div class="panel-body">
                        <label for="sel1">Education: </label><br />
                          <label for="sel1"></label>
                          
                          <?php echo form_dropdown('level_id',  $edu_level_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                          
                          <label for="sel1"></label>
                          <input type="text" name="course_name" class="form-control input-sm" placeholder="Course Name" id="course_name">
                          
                           <label for="sel1"></label>
                          
                          <?php echo form_dropdown('spcl_id',  $edu_special_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                          
                          
                          </div>
                          </div>
                        
                        <div class="panel panel-success">
                        <div class="panel-body">
                            <label for="sel1">Professional: </label><br />
                            <input type="text" class="form-control input-sm" name="company" placeholder="Company" id="company"><br />
                            <input type="text" class="form-control input-sm"  name="designation" placeholder="Designation" id="designation"><br />
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1">From: </label><br />
                          <input type="text" class="form-control input-sm " placeholder="YYYY-MM-DD" id="datepickfrom" name="from_date"><br />
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1">To: </label><br />
                          <input type="text" class="form-control input-sm " id="datepickto" placeholder="YYYY-MM-DD" name="to_date"><br />
                        </div></div>
                            </div>
                            
                            <label for="sel1">Is this your present job?  </label>
                            
                            <label class="radio-inline"><input type="radio" value="1" name="present_job">Yes</label>
                            
							<label class="radio-inline"><input type="radio" value="0" name="present_job">No</label><br />
                            
                          <label for="sel1"></label>
                          <?php echo form_dropdown('industry_id',  $industry_list, '','data-placeholder="Filter by status" 	class="form-control input-sm"');?>
                          
                        
                          <label for="sel1"></label>
                          <?php echo form_dropdown('func_id',  $functional_list, '','data-placeholder="Filter by status" 	class="form-control input-sm"');?>
                          </div>
                          </div>

<div class="panel panel-success">
                        <div class="panel-body">
                            <label for="sel1">Salary Expectation: </label><br />
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
							                          
                          <input type="text" class="form-control input-sm" name="current_ctc" placeholder="Current CTC" id="current_ctc">
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <input type="text" class="form-control input-sm" placeholder="Expected CTC" name="expected_ctc" id="expected_ctc">
                        </div></div>
                            </div>
                            
                            
                            
                            <input type="text" class="form-control input-sm" placeholder="Reason for leaving" name="reason_to_leave" id="reason_to_leave"><br />
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          <select class="form-control input-sm" id="sel1">
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
                          <select class="form-control input-sm" id="sel1">
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
                            <div class="col-sm-6"> 
                            <?php echo form_upload(array('name'=>'cv_file','class'=>''));?>
                        
                        </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          <label for="sel1">Upload  Photo: </label>
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <?php echo form_upload(array('name'=>'photo','class'=>''));?>
                        </div></div>
                            </div>
                          
   <button type="button" id="sbumit_form" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Application </strong></button>
                        
              
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