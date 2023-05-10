<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>jobs">Jobs</a> <i class="icon-angle-right"></i> </li>
        <li><a href="#">Add Jobs</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/>
          <h3>Add Jobs</h3>
        </div>
        <?php if(validation_errors()!=''){?>
        <div class="alert alert-success alert-danger">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
          <strong><?php echo validation_errors(); ?></strong> </div>
        <?php } ?>
        <div class="table-tech specs hor">
          <table class="hori-form">
            <tbody>
            <form action="<?php echo $this->config->site_url();?>jobs/add" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
              <input type="hidden" name="job_title" value="Job Title"/>
              <input type="hidden" name="job_location" value=""/>
              <input type="hidden" name="res_location" value=""/>
              <input type="hidden" name="social_link" value=""/>
              <!--<input type="hidden" name="desired_profile" value=""/>-->
              <input type="hidden" name="job_desc" value=""/>
              <input type="hidden" name="job_keywords" value=""/>
              <input type="hidden" name="company_id" value="<?php echo $_SESSION['company_id'];?>">
              
              <input type="hidden" name="emp_credit_id" value="<?php echo $job_to_pkg['emp_credit_id'];?>"/>
              <input type="hidden" name="amount_per_job" value="<?php echo $job_to_pkg['amount_per_job'];?>"/>
              
            <input type="hidden" id="res_location" name="res_location" value="<?php echo $formdata['res_location'];?>" placeholder="Resident Location" class="form-control hori" />
              <tr>
                <td>Job Title</td>
                <td><input type="text" id="job_title" name="job_title" value="<?php echo $formdata['job_title'];?>" placeholder="Job Title" class="form-control hori" /></td>
              </tr>
              <tr>
                <td colspan="2">Show logo on website:&nbsp;
                  <input type="checkbox" name="show_logo" value="1" <?php if($formdata['show_logo']==1)echo 'checked';?>></td>
              </tr>
                 <tr>
                <td>Job Industry</td>
                <td><?php echo form_dropdown('job_cat_id', $jobindustry, $formdata['job_cat_id'],'class="form-control hori" id="job_cat_id"');?></td>
              </tr>
              <tr>
                <td>Functional Area</td>
                <td><?php echo form_dropdown('func_id', $functional, $formdata['func_id'],'class="form-control hori" id="func_id"');?></td>
              </tr>
              <tr>
                <td>Designation</td>
                <td><?php echo form_dropdown('desig_id', $roles_list, $formdata['desig_id'],'class="form-control hori" id="desig_id"');?></td>
              </tr>
                 <tr>
                <td>Min Salary</td>
                <td><input type="text" id="min_salary" name="min_salary" value="<?php echo $formdata['min_salary'];?>" placeholder="Min Salary" class="form-control hori" /></td>
              </tr>
                  <tr>
                <td>Max Salary</td>
                <td><input type="text" id="max_salary" name="max_salary" value="<?php echo $formdata['max_salary'];?>" placeholder="Max Salary" class="form-control hori" /></td>
              </tr>
                <tr>
                <td>Number of vacancies</td>
                <td><input type="text" id="vacancies" name="vacancies" value="<?php echo $formdata['vacancies'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
                <tr>
                <td>Country</td>
                <td><?php echo form_dropdown('country_id', $country_list, $formdata['country_id'],'class="form-control hori" id="country_id"  id="country_id" ');?></td>
              </tr>
              <tr>
                <td>State</td>
                <td><?php echo form_dropdown('state_id', $state_list, $formdata['state_id'],'class="form-control hori"  id="state_id" ');?></td>
              </tr>
             <tr>
                <td>City</td>
                <td><?php echo form_dropdown('job_location', $city_list, $formdata['job_location'],'class="form-control hori"  id="city_id" ');?></td>
              </tr>
                <tr>
                <td>Job location</td>
                <td><input type="text" id="job_loc" name="job_loc" value="<?php echo $formdata['job_loc'];?>" placeholder="Job location" class="form-control hori" /></td>
              </tr>
                 <tr>
                <td>Qualification</td>
                <td><?php echo form_dropdown('level_id', $education, $formdata['level_id'],'class="form-control hori"');?></td>
              </tr>
                <tr>
                <td>Course Name</td>
                <td><input type="text" id="course_name" name="course_name" value="<?php echo $formdata['course_name'];?>" placeholder="Course Name" class="form-control hori" /></td>
              </tr>
                 <tr>
                <td>Total Experience [Yrs]</td>
                <td><?php 
	
	$total_exp_list = array(
						'1'        => '1 Years',
						'2'        => '2 Years',
						'3'        => '3 Years',
						'4'        => '4 Years',
						'5'        => '5 Years',
						'6'        => '6 Years',
						'7'        => '7 Years',
						'8'        => '8 Years',
						'9'        => '9 Years',
						'10'        => '10 Years',
						'11'        => '11 Years',
						'12'        => '12 Years',
						'13'        => '13 Years',
						'14'        => '14 Years',
						'15'        => '15 Years',
						'16'        => '16 Years',
						'17'        => '17 Years',
						'18'        => '18 Years',
						'19'        => '19 Years',
						'20'        => '20 Years',
						'21'        => '21 Years',
						'22'        => '22 Years',
						'23'        => '23 Years',
						'24'        => '24 Years',
						'25'        => '25 Years',
						'30'        => '30+ Years',
						);
	
	?>
                  <?php echo form_dropdown('total_exp_needed', $total_exp_list, $formdata['total_exp_needed'],'class="form-control hori"');?></td>
              </tr>
                 <tr>
                <td>Min Age</td>
                <td><input type="text" id="min_age" name="min_age" value="<?php echo $formdata['min_age'];?>" placeholder="Min Age" class="form-control hori" /></td>
              </tr>
                 <tr>
                <td>Max Age</td>
                <td><input type="text" id="max_age" name="max_age" value="<?php echo $formdata['max_age'];?>" placeholder="Max Age" class="form-control hori" /></td>
              </tr>
                 <tr>
                <td>Gender Preference</td>
                <td><?php 
						
						$data = array(
						'name'        => 'gender',
						'id'          => 'gender',
						'value'       => '2',
						'checked'     => '',
						'style'       => 'margin:10px',
						);
						if($formdata['gender']=='2') $data['checked']='TRUE';
						echo form_radio($data).'Male';
						$data = array(
							'name'        => 'gender',
							'id'          => 'gender',
							'value'       => '1',
							'checked'     => '',
							'style'       => 'margin:10px',
							);
						if($formdata['gender']=='1') $data['checked']='TRUE';
						echo form_radio($data).'Female';

						$data = array(
							'name'        => 'gender',
							'id'          => 'gender',
							'value'       => '0',
							'checked'     => '',
							'style'       => 'margin:10px',
							);
							
						if($formdata['gender']=='0') $data['checked']='TRUE';
						echo form_radio($data).'No Preference';						
						
					?></td>
              </tr>
              <tr>
                <td>Job Description</td>
                <td><?php echo $this->ckeditor->editor('job_desc',$formdata['job_desc']);?></td>
              </tr>
                <tr>
                <td>Desired Candidate Profile</td>
                <td>
                <?php echo $this->ckeditor->editor('desired_profile',$formdata['desired_profile']);?></td>
              </tr>
                <tr>
                <td>Work Level</td>
                <td><?php echo form_dropdown('work_level_id', $worklevel, $formdata['work_level_id'],'class="form-control hori"');?></td>
              </tr>
                <tr>
                <td>Skills</td>
                <td><input type="text" id="job_skill_name" name="job_skill_name" value="" placeholder="Job Skills" class="form-control hori" /></td>
                </tr>
              <tr>
                <td>Job Skills</td>
                <td><select class="form-control" onchange="myFunction();" id="parent" name="parent">
                    <option value="">Select Skill</option>
                    <?php foreach($skillset as $skill){?>
                    <option value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                    <?php }?>
                  </select></td>
              </tr>
                
                <tr>
                <td>Max Notice period (in days) </td>
                <td><input type="text" id="max_notice_period" name="max_notice_period" value="<?php echo $formdata['max_notice_period'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
                
              <!--<tr>
                <td>Salary(Per Annum)</td>
                <td><?php //echo form_dropdown('salary_id', $salary, $formdata['salary_id'],'class="form-control hori"');?></td>
              </tr> -->
                
              <tr>
                <td colspan="2">Hide Salary from jobseekers:&nbsp;
                  <input type="checkbox" name="hide_salary" value="1" <?php if($formdata['hide_salary']==1)echo 'checked';?>></td>
              </tr>
              
              <!--<tr>
                <td> International Location(s) of Job </td>
                <td><?php //echo form_dropdown('intl_locations', $intl_locations, $formdata['intl_locations'],'class="form-control hori" id="intl_locations" ');?></td>
              </tr>-->
             
             
                
              
             
             
                 <!-- <tr>
                <td>Priority</td>
                <td><input id="job_priority" type="radio" name="job_priority" value="1"  <?php //if($formdata['job_priority']==1)echo 'checked="checked"';?>  />
                  Immediate Joinin [0 Notice Peiord] &nbsp;
                  <input type="radio" name="job_priority" value="2" id="job_priority"  <?php //if($formdata['job_priority']==2)echo 'checked="checked"';?> />
                  1 - 2 Weeks &nbsp;&nbsp;
                  <input id="job_priority" type="radio" name="job_priority" value="3"  <?php //if($formdata['job_priority']==3)echo 'checked="checked"';?>  />
                  1 Month </td>
              </tr> -->
              
              <tr>
                <td>Documents required at the time of Interview</td>
                <td><input type="text" id="documents_required" name="documents_required" value="<?php echo $formdata['documents_required'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Seeker will respond you at ?</td>
                <td><input type="radio" name="response_mode" value="1" <?php if($formdata['response_mode']==1)echo 'checked';?>>
                  &nbsp;Email &nbsp;
                  <input type="radio" name="response_mode" value="2" <?php if($formdata['response_mode']==2)echo 'checked';?>>
                  &nbsp;Contact Details &nbsp;
                  <input type="radio" name="response_mode" value="3" <?php if($formdata['response_mode']==3)echo 'checked';?>>
                  &nbsp;Walkin &nbsp;
                  <input type="radio" name="response_mode" value="4" <?php if($formdata['response_mode']==4)echo 'checked';?>>
                  &nbsp;All &nbsp; </td>
              </tr>
              <tr>
                <td>Mailing Email ID </td>
                <td><input type="text" id="contact_email_id" name="contact_email_id" value="<?php echo $formdata['contact_email_id'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Contact Person</td>
                <td><input type="text" id="contact_name" name="contact_name" value="<?php echo $formdata['contact_name'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Contact Number</td>
                <td><input type="text" id="contact_phone" name="contact_phone" value="<?php echo $formdata['contact_phone'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Package</td>
                <td><?php echo form_dropdown('package_id', $package_list, $formdata['package_id'],'class="form-control hori" id="package_id"');?></td>
              </tr>
              <tr  id="skill-tr"  <?php if(empty($candidate_skills)){ ?> style="display:none" <?php }  ?>>
                <td>&nbsp;</td>
                <td><select class="js-example-basic-multiple-skill" name="skills[]" multiple="multiple" id="multiple_skill" style="width:970px;">
                    <?php foreach($res as $skill){?>
                    <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td>Job Certification</td>
                <td><select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_cert" name="cert_id[]"  style="width:970px;">
                    <?php foreach($cerifications as $cert){?>
                    <option value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td>Domain Knowledge</td>
                <td><select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_domain" name="domain_id[]"  style="width:970px;">
                    <?php foreach($domain as $dom){?>
                    <option value="<?php echo $dom['domain_id'];?>"><?php echo $dom['domain_name'];?></option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td>Job Type</td>
                <td><?php echo form_dropdown('job_type_id', $jobtype, $formdata['job_type_id'],'class="form-control hori"');?></td>
              </tr>
              
              <!--<tr>
                <td>Nationality</td>
                <td><?php //echo form_dropdown('country_id', $nationality, $formdata['country_id'],'class="form-control hori"');?></td>
              </tr>-->
              <!--<tr>
                <td>Number of vacancies</td>
                <td><?php 
	
	/* $vacancies_list = array(
						'1'        => '1 Nos',
						'2'        => '2 Nos',
						'3'        => '3 Nos',
						'4'        => '4 Nos',
						'5'        => '5 Nos',
						'6'        => '6 Nos',
						'7'        => '7 Nos',
						'8'        => '8 Nos',
						'9'        => '9 Nos',
						'10'        => '10 Nos',
						'11'        => '11 Nos',
						'12'        => '12 Nos',
						'13'        => '13 Nos',
						'14'        => '14 Nos',
						'15'        => '15 Nos',
						'16'        => '16 Nos',
						'17'        => '17 Nos',
						'18'        => '18 Nos',
						'19'        => '19 Nos',
						'20'        => '20 Nos',
						'21'        => '21 Nos',
						'22'        => '22 Nos',
						'23'        => '23 Nos',
						'24'        => '24 Nos',
						'25'        => '25 Nos',
						'30'        => '30+ Nos',
						);
	
	?>
                  <?php echo form_dropdown('vacancies', $vacancies_list, $formdata['vacancies'],'class="form-control hori"');*/?></td>
              </tr>-->
                             <input type="hidden" id="job_post_date" name="job_post_date" value="<?php echo $formdata['job_post_date'];?>" placeholder="" class="form-control hori" />
                             <input type="hidden" id="job_expiry_date" name="job_expiry_date" value="<?php echo $formdata['job_expiry_date'];?>" placeholder="" class="form-control hori" />
                             <input type="hidden" id="exp_join_date" name="exp_join_date" value="<?php echo $formdata['exp_join_date'];?>" placeholder="" class="form-control hori" />
             
              <tr>
                <td>Attach Brochure</td>
                <td><?php echo form_upload(array('name'=>'brochure','class'=>'smallinput', 'value'=>$formdata['brochure']));?></td>
              </tr>
              
              
              
              <!--      

    <tr>
    <td>About Company</td>
    <td> <?php echo $this->ckeditor->editor('about_company',$formdata['about_company']);?>
    </td>
    </tr>
    
    <tr>
    <td>Contact Details</td>
    <td> <?php echo $this->ckeditor->editor('job_contact',$formdata['job_contact']);?>
    </td>
    </tr>
        
     

     <tr>
    <td>Contact Designation</td>
    <td> <input type="text" id="contact_designation" name="contact_designation" value="<?php echo $formdata['contact_designation'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>

     <tr>
    <td>Contact Email</td>
    <td> <input type="text" id="contact_email" name="contact_email" value="<?php echo $formdata['contact_email'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>

     <tr>
    <td>Contact Website</td>
    <td> <input type="text" id="contact_website" name="contact_website" value="<?php echo $formdata['contact_website'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
 
    
     <tr>
    <td>Facebook</td>
    <td> <input type="text" id="facebook" name="facebook" value="<?php echo $formdata['facebook'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
     <tr>
    <td>Twitter</td>
    <td> <input type="text" id="twitter" name="twitter" value="<?php echo $formdata['twitter'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
     <tr>
    <td>Google Plus</td>
    <td> <input type="text" id="googleplus" name="googleplus" value="<?php echo $formdata['googleplus'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
     <tr>
    <td>Linkedin</td>
    <td> <input type="text" id="linkedin" name="linkedin" value="<?php echo $formdata['linkedin'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    

     <tr>
    <td>Title [For Social Media]</td>
    <td> <input type="text" id="social_title" name="social_title" value="<?php echo $formdata['social_title'];?>" placeholder="Title [For in Social Media]" class="form-control hori" />
    </td>
    </tr>

     <tr>
    <td>Main Content [Social Media Content]</td>
    <td> <input type="text" id="social_content" name="social_content" value="<?php echo $formdata['social_content'];?>" placeholder="Main Content [Social Media Content]" class="form-control hori" />
    </td>
    </tr>

    

     <tr>
    <td>Link to image [To be displayed in social media]</td>
    <td> <input type="text" id="social_link_image" name="social_link_image" value="<?php echo $formdata['social_link_image'];?>" placeholder="Link to image [To be displayed in social media]" class="form-control hori" />
    </td>
    </tr>

     <tr>
    <td>A Comment [Needed for Linkedin]</td>
    <td> <input type="text" id="social_comment" name="social_comment" value="<?php echo $formdata['social_comment'];?>" placeholder="A Comment [Needed for Linkedin]" class="form-control hori" />
    </td>
    </tr>                    
   -->
              
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->site_url();?>jobs" class="attach-subs subs">Cancel</a> </span></td>
              </tr>
            </form>
              </tbody>
            
          </table>
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">

$(".js-example-basic-multiple-cert").select2();
$(".js-example-basic-multiple-skill").select2();

//onchange of job_category

	$('#job_cat_id').change(function() 
	{
	
		jQuery('#func_id').html('');
		jQuery('#func_id').append('<option value="">Select Function</option');
			
		if($('#job_cat_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>jobs/getfunction/',
			  data: { category_id: $('#job_cat_id').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#func_id').html('');
					  jQuery('#func_id').append(data.function_list);

					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Please try again');
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Select Function</option');
			  }
			});	
	});

function validate()
{
	if($('#job_title').val()=='')
	{
		alert('Please enter job title');
		$('#job_title').focus();
		return false;
	}
	
    if($('#parent').val()=='')
	{
		alert('Please Select skill name');
		$('#parent').focus();
		return false;
	}
    
	return true;
}
$(document).ready(function()
{
	$('#job_post_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#job_expiry_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#exp_join_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
});



function myFunction()
{
	  var parnt =$('#parent').val();
      if(parnt!='')
	  {
	  $.ajax({
      type: "get",
      async: true,
      url: "<?php echo site_url('manage_data/child_skill'); ?>",
      data: {'id':parnt},
      dataType: "json",
      success: function(res) {
       
       create_selectbox(res);
     
     console.log(res['skillset']);
    
							} 
			}); 
	  }
	  else{
		  	$('#skill-tr').hide();
		 	$('#multiple_skill').val('');
			$('#multiple_skill').html('');
	 }
   }

function create_selectbox(res)
{ 
	var skillset=res['skillset'];
	var count=skillset['length'];
	

	if(count>0)
	{
    
	$('#skill-tr').show();
    $('#multiple_skill').val('');
	$('#multiple_skill').html('');
	$('#multiple_skill').append('<option value="">Select Skills</option>');
        for(var k=0;k<count;k++)
        {   
            
            var option	=	'<option value="'+skillset[k]['skill_id']+'">'+skillset[k]['skill_name']+'</option>';
            
            $('#multiple_skill').append(option);
    
        }
	}
	else{
		$('#skill-tr').hide();
		$('#multiple_skill').val('');
		$('#multiple_skill').html('');
	}
	
}


$('#country_id').change(function() {
		
	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
			
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>jobs/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>jobs/getcity/',
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
