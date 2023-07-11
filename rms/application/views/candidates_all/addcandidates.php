<style>

    td.test {
    width:730px;
    padding: 0 5px 0 0;
    margin: 0;
    border: 0;
    }
   
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<section class="bot-sep">
    <div class="section-wrap">
        <div class="row">
        	<div class="col-sm-12 pages"><span>Home</span> / <span><?php echo $page_head;?></span></div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?></h3></div>
					<?php if(validation_errors()!=''){?> 
                    <div class="alert alert-success alert-danger">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong><?php echo validation_errors(); ?></strong>
                    </div>
                    <?php } ?>
                     
                    <div id ="step1">
                    <div class="table-tech specs hor">
                            <table class="hori-form">
                                <tbody>
                                    <form class="form-horizontal form-bordered"  method="post" id="candidate_form" name="candidate_form" action="<?php echo $this->config->site_url();?>/candidates_all/addCandidate" > 
                                    
                                    <input type="hidden" name="last_name" value="">
                                            
                                            
                                        <tr>
                                            <td>Title</td>
                                            <td colspan="2"> <?php 
												$options = array(
												'1'  => 'Mr.',
												'3'  => 'Mis.',
												'4'  => 'Miss.',
												'2'  => 'Mrs');
												echo form_dropdown('title', $options, $formdata['title']);
												?>  
                                             </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>First name<span style="color:#F40004;">*</span></td>
                                            <td colspan="2"><input class="form-control hori" type="text" name="first_name" value="<?php echo $formdata['first_name'];?>" 
                                            id="first_name" placeholder="Enter your First name"></td>
                                        </tr>
<!--                                        
                                        <tr>
                                            <td>Last name</td>
                                            <td><input class="form-control hori fo-icon-1" type="text" name="last_name" value="<?php echo $formdata['last_name'];?>" 
                                            id="last_name" placeholder="Enter your Last name">
                                            </td>
-->                                        </tr>
                                        
                                        <tr>
                                        	<td>Email ( Username ) <span style="color:#F40004;">*</span></td>
                                            <td colspan="2"><input class="form-control hori " type="text" name="username"  value="" 
                                            id="username" placeholder="Enter your Email"><a href="javascript:;" id="check_email" onclick="return check_email();">Check Availabiltiy</a>&nbsp;&nbsp;&nbsp;<span id="check_msg"></span></td>
                                            
                                        </tr>
                                        
                                        
                                                                              <tr>
                                            <td>Password<span style="color:#F40004;">*</span></td>
                                            <td colspan="2"><input class="form-control hori" type="password" name="password" value="" id="password" placeholder="">
                                            </td>
                                        </tr>


                                                                               
                                       <tr>
											<td>Confirm Password<span style="color:#F40004;">*</span></td>
											<td colspan="2"><input class="form-control hori " type="password" name="cpassword" value="<?php echo $formdata['cpassword'];?>" 
											id="cpassword" placeholder="Enter your Confirm Password">
											</td>
                                        </tr>

                                           <tr>
                                            <td>Alternate Email</td>
                                            <td colspan="2"><input class="form-control hori " type="text" placeholder="Alternate Email" name="alternate_email"  value="<?php echo $formdata['alternate_email'];?>"> 
                                            </td>
                                        </tr>
                                                                                
                                        <tr>
                                            <td>Gender</td>
                                            <td colspan="2"> 
												<?php 
                                                $data = array(
                                                'name'        => 'gender',
                                                'id'          => 'gender',
                                                'value'       => '1',
                                                'checked'     => '1',
                                                'style'       => 'margin:10px',
                                                );
                                                if($formdata['gender']=='1') $data['checked']='TRUE';
                                                echo form_radio($data).'Male';
                                                $data = array(
                                                'name'        => 'gender',
                                                'id'          => 'gender',
                                                'value'       => '0',
                                                'checked'     => '',
                                                'style'       => 'margin:10px',
                                                );
                                                if($formdata['gender']=='0') $data['checked']='TRUE';
                                                echo form_radio($data).'Female';
                                                ?> 
                                             </td>	
                                        </tr>
                                        
                                        <tr>
                                            <td>Marital Status</td>                                        
                                            <td colspan="2"> 
                                            <?php 
                                            $data = array(
                                            'name'        => 'marital_status',
                                            'id'          => 'marital_status',
                                            'value'       => '1',
                                            'checked'     => '',
                                            'style'       => 'margin:10px',
                                            );
                                            if($formdata['marital_status']=='1') $data['checked']='TRUE';
                                            echo form_radio($data).'Married';
                                            $data = array(
                                            'name'        => 'marital_status',
                                            'id'          => 'marital_status',
                                            'value'       => '6',
                                            'checked'     => '',
                                            'style'       => 'margin:10px',
                                            );
                                            if($formdata['marital_status']=='6') $data['checked']='TRUE';
                                            echo form_radio($data).'Single';
                                            ?> </td>	
                                        </tr>
                                        
                                        <tr>
                                            <td>Mobile Phone<span style="color:#F40004;">*</span></td>
                                            <td><input type="text" name="mobile_prefix" class="form-control input-sm" style="width:100px;" placeholder="Country Code" maxlength="5" value="+971" id="mobile_prefix"></td>
                                            <td><input style="width:200px;"  type="text"  name="mobile" maxlength="13" placeholder="Mobile Phone" 
                                            value="<?php echo $formdata['mobile'];?>" id="mobile"></td>
                                        </tr>
                                        
                                         <tr>
                                            <td>Alternate Mobile Phone</td>
                                            <td><input type="text" name="mobile_prefix1" style="width:100px;" class="form-control input-sm" placeholder="Country Code" value="+971" maxlength="5" id="mobile_prefix1"></td>
                                            <td><input style="width:200px;"  type="text"  name="mobile1" maxlength="20" placeholder="Alternate Mobile Phone" 
                                            value="<?php echo $formdata['mobile1'];?>" id="mobile1"></td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td colspan="2"><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" 
                                            value="<?php echo $formdata['date_of_birth'];?>" placeholder="Enter your DOB"></td>
                                        </tr>

               


				<tr>
                    <td>Nationality</td>
                    <td colspan="2"> <?php echo form_dropdown('nationality',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="nationality"');?></td>
                </tr> 
                
				<tr>
                    <td>Country<span style="color:#F40004;">*</span></td>
                    <td colspan="2"> <?php echo form_dropdown('country_id',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="country_id"');?></td>
                </tr>  

				<tr>
                    <td>State<span style="color:#F40004;">*</span></td>
                    <td colspan="2"> <?php echo form_dropdown('state_id',  $state_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="state_id"');?></td>
                </tr>  

				<tr>
                    <td>City</td>
                    <td colspan="2"><?php echo form_dropdown('city_id',  $city_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="city_id"');?> </td>
                </tr>                                  


<tr>
                    <td>Current Employer</td>
                    <td colspan="2"><input class="form-control hori" type="text" name="organization" value="<?php echo $formdata['organization'];?>" id="organization"></td>
                </tr> 

<tr>
                    <td>Current Designation</td>
                    <td colspan="2"><input class="form-control hori" type="text" name="designation" value="<?php echo $formdata['designation'];?>" id="designation"></td>
                </tr> 

				<tr>
                    <td>Total Experience</td>
                    <td colspan="2"><input class="form-control hori" type="text" name="total_exp" value="<?php echo $formdata['total_exp'];?>" id="total_exp"></td>
                </tr> 

				<tr>
                    <td>Salary Expectation</td>
                    <td colspan="2"><input class="form-control hori" type="text" name="expected_ctc" value="<?php echo $formdata['expected_ctc'];?>" id="expected_ctc"></td>
                </tr>  
                                                                
				<tr>
                    <td>Industry</td>
                    <td colspan="2"> <?php echo form_dropdown('job_cat_id',  $industry_list, '',' id="job_cat_id" data-placeholder="Filter by status" class="form-control input-sm"');?>              </td>
                </tr>  


				<tr>
                    <td>Functional Area</td>
                    <td colspan="2"><?php echo form_dropdown('func_id',  $func_list, '',' id="func_id" data-placeholder="Filter by status" class="form-control input-sm"');?>                     </td>
                </tr> 
                
                
   				<tr>
                    <td>Role</td>
                    <td colspan="2"><?php echo form_dropdown('desig_id',  $desig_list, '',' id="desig_id" data-placeholder="Filter by status" class="form-control input-sm"');?>            </td>
                </tr> 

   				
                
                                
				<tr>
                    <td>Linkedin URL</td>
                    <td colspan="2"><input class="form-control hori" type="text" name="linkedin_url" value="<?php echo $formdata['linkedin_url'];?>" id="linkedin_url"></td>
                </tr>                

				<tr>
                    <td>Facebook URL</td>
                    <td colspan="2"><input class="form-control hori" type="text" name="facebook_url" value="<?php echo $formdata['facebook_url'];?>" id="facebook_url"></td>
                </tr> 
                                                        
                                       

				<tr>
                    <td>Job Folder</td>
                     <td colspan="2">	
                            <select name="job_folder_id" id="job_folder_id" class="js-example-basic-single">

                            <?php foreach($job_folders as $key => $value){ ?>
                            <option <?php if($formdata['job_folder_id']==$key){?> selected="selected" <?php } ?> value="<?php echo $key; ?>"><?php echo $value; ?> 
                         </option>
                            <?php
                            }?>
                            </select> 
                     </td>
                </tr>
              
                <tr>
                   <td>Present Job Status</td>
                <td colspan="2">
							                   
				 <?php echo form_dropdown('cur_job_status',  $cur_job_status_list, '',' id="cur_job_status" data-placeholder="Filter by status" class="form-control input-sm"');?>
                 
                
			    </td>
                 </tr>
                  <!--                                          
                                        <tr>
                                            <td>Reg Status</td>
                                            <td><input id="reg_status" type="radio" name="reg_status" value="1"  <?php if($formdata['reg_status']==1)echo 'checked="checked"';?>  />Registered&nbsp;<input type="radio" name="reg_status" value="2" id="reg_status"  <?php if($formdata['reg_status']==2)echo 'checked="checked"';?> />Placed</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Lead Opportunity</td>
                                            <td><input id="lead_opportunity" type="radio" name="lead_opportunity" value="1"  <?php if($formdata['lead_opportunity']==1)echo 'checked="checked"';?>  />Cold &nbsp;<input type="radio" name="lead_opportunity" value="2" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==2)echo 'checked="checked"';?> />Warm &nbsp;&nbsp;<input id="lead_opportunity" type="radio" name="lead_opportunity" value="3"  <?php if($formdata['lead_opportunity']==3)echo 'checked="checked"';?>  />Hot &nbsp;&nbsp;<input type="radio" name="lead_opportunity" value="0" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==0)echo 'checked="checked"';?> />Unknown&nbsp;
                                            </td>
                                        </tr>

<tr>
                    <td>Lead Source</td>
                    <td>
 <input id="lead_source" type="radio" name="lead_source" value="1"  <?php if($formdata['lead_source']==1)echo 'checked="checked"';?> />
  Recruiter 
                    &nbsp;
                    <input type="radio" name="lead_source" value="2" id="lead_source"  <?php if($formdata['lead_source']==2)echo 'checked="checked"';?>/>
                    Online/Web/Social &nbsp;&nbsp;
                    <input id="lead_source" type="radio" value="3" name="lead_source"   <?php if($formdata['lead_source']==3)echo 
                    'checked="checked"';?>  />
                    Vendor &nbsp;&nbsp;
                    <input type="radio" name="lead_source" value="4" id="lead_source" <?php if($formdata['lead_source']==4)echo 'checked="checked"';?> />
                    Mobile&nbsp;&nbsp; 
                    <input type="radio" name="lead_source" value="5" id="lead_source" <?php if($formdata['lead_source']==5)echo 'checked="checked"';?> />
                    No Idea! </td>
                </tr>
-->                                                        
                                         <tr>
                                            <td>Upload your CV</td>
                                            <td colspan="2"> 
                                            <?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?>
                                            </td>
                                            
                                        </tr>

                                         <tr>
                                            <td>Upload your Photo</td>
                                            <td colspan="2"> 
                                            <?php echo form_upload(array('name'=>'photo','class'=>'class="btn btn-primary"'));?> 
                                            </td>
                                            
                                        </tr>
                                                                                
                                           
                                        <tr>
                                            <td colspan="3">
                                            <span class="click-icons">
                                            <input type="submit" class="attach-subs" value="Save & Continue" id="save_candidate" style="width:180px;" 
                                            data-url="<?php echo $this->config->site_url();?>/candidates_all/addCandidate" />
                                            <a href="<?php echo $this->config->site_url();?>/candidates_all" class="attach-subs subs">Back</a></span></td>
                                            
                                            </span>
                                            </td>
                                       </tr>
                                    </form>
                                </tbody>
                            </table>
                    	<div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- form ends here-->
    
    <!-- centercontent -->
    
</div><!--bodywrapper-->
<script>
function check_email()
{
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		var email=$('#username').val();					
		if($('#username').val()=='')
		{
			alert('Enter username');
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
				url: "<?php echo $this->config->site_url();?>/candidates_all/check_email",
				cache: false,				
				data: {email:$('#username').val()},
				success: function(data){ 
					try{		
						var ret = jQuery.parseJSON(data);
						$('#check_msg').attr('style', ''); 
		   				$('#check_msg').hide();
						if(ret['STATUS']==0) 
						{
//doesnt;exist
							
                            $('#check_msg').html('<i>Email address not exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
			   				$('#check_msg').show();
                            
						}else if(ret['STATUS']==1)
						{
                            $('#check_msg').html('<i>Email address already exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
			   				$('#check_msg').show();
						}
					}
					catch(e) {		
						alert('Exception occured while adding contact.');
					}	
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
}

var userFlag = 0;
$( document ).ready(function() {
	$('#datepicker').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});
	$('#datepicker1').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"

	});
	$('#datepicker2').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"

	});


   
   
   
   


//END CHECK EMAIL

   function candidate_validate() {
		
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   
 
 		var name_check=getValidName($('#first_name').val());
		if(name_check==false)
		{
			alert('Please enter valid name');
			$('#first_name').focus();
			return false;
		}
		
		if($('#username').val()=='')
		{
			alert('Enter username');
			$('#username').focus();
			return false;
		}
		
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test($('#username').val())){
			alert('Enter valid email');
			$('#username').focus();
			return false;
		}

		if($('#password').val()=='')
		{
			alert('Enter Password');
			$('#password').focus();
			return false;
		}
		
		if($('#cpassword').val()=='')
		{
			alert('Confirm Your Password');
			$('#cpassword').focus();
			return false;
		}

		if($('#cpassword').val()!=$('#password').val())
		{
			alert('Password mismatch, please correct');
			$('#cpassword').focus();
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

		if($('#country_id').val()=='')
		{
			alert('Select Country');
			$('#country_id').focus();
			return false;
		}  

		if($('#state_id').val()=='')
		{
			alert('Select State');
			$('#state_id').focus();
			return false;
		}  
				
	    return true;
    }



function getValidName(value)
	{
		var a = value;
		var filter = /^[a-z .-]+$/i;
		
		if (filter.test(a)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
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
		
   $('#candidate_form').submit(function(evt){
		evt.preventDefault(); 
		var dataStringprop = $("#candidate_form").serialize();
		var $this = $(this);
		var $url =$('#save_candidate').data('url');       
     	var formData = new FormData(this);
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$.ajax({
				type: "post",
				url: $url,
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						$('#hdstep1').val(ret['SUCCESS_ID']);
						if(ret['STATUS']==1) 
						{

							var id = ret['SUCCESS_ID'];
                            
                            window.location.href = "<?php echo site_url('candidates_all/summary'); ?>" +'/'+ id;

						}else if(ret['STATUS']==2)
						{
							alert('Email address already exist, please change and save again.');
							return;
						}
					}
					catch(e) {		
						alert('Exception occured while adding contact.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
   });//end button click function save*/


    var now = new Date();
    var month = (now.getMonth() + 1);               
    var day = now.getDate();
    if(month < 10) 
        month = "0" + month;
    if(day < 10) 
        day = "0" + day;
    var today = now.getFullYear() + '-' + month + '-' + day;
    $('#password').val(today);


});   // end document.ready



</script>
<script language="javascript">

$(document).ready(function()
{
	$('#job_cat_id').change(function() {
			jQuery('#func_id').html('');
			jQuery('#func_id').append('<option value="">Select Function</option');
			
	//		jQuery('#desig_id').html('');
	//		jQuery('#desig_id').append('<option value="">Select Designation</option');		
	
	//		jQuery('#skill_id').html('');
	//		jQuery('#skill_id').append('<option value="">Select Skills</option');		
				
			//if($('#job_cat_id').val()=='')return;
			
				$.ajax({
				  type: 'POST',
				  url: '<?php echo $this->config->site_url();?>/jobs/getfunction/',
				  data: { job_cat_id: $('#job_cat_id').val()},
				  dataType: 'json',
				  
				  beforeSend:function(){
						jQuery('#func_id').html('');
						jQuery('#func_id').append('<option value="">Loading...</option');
	//					jQuery('#desig_id').html('');
	//					jQuery('#desig_id').append('<option value="">Select Designation</option');		
				  },
				  
				  success:function(data){
				  
					  if(data.success==true)
					  {
						  jQuery('#func_id').html('');
						  $.each(data.func_list, function (index, value) 
						  {
							  if(index=='')
								 jQuery('#func_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
							 else
								 jQuery('#func_id').append('<option value="'+ index +'">'+ value +'</option');
						 });
					 
					  }else
					  {
						alert(data.success);
					  }
					},
				  
				  error:function(){
						alert('Problem with server. Please try again');
						jQuery('#func_id').html('');
						jQuery('#func_id').append('<option value="">Select Function</option');
	
	//					jQuery('#desig_id').html('');
	//					jQuery('#desig_id').append('<option value="">Select Designation</option');		
				  }
				});	
		});
	$('#func_id').change(function() {
			
		jQuery('#desig_id').html('');
		jQuery('#desig_id').append('<option value="">Select Designation</option');
		
	//	jQuery('#skill_id').html('');
	//	jQuery('#skill_id').append('<option value="">Select Skills</option');
		
				
		//if($('#func_id').val()=='')return;
		
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/jobs/get_designation_by_function/',
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
					  $.each(data.desig_list, function (index, value) 
					  {
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
});

	$('#country_id').change(function() {
		
	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
			
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/jobs/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/jobs/getcity/',
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
