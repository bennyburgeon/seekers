<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>/jobs">Jobs</a> <i class="icon-angle-right"></i> </li>
        <li><a href="#">Edit Jobs</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/>
          <h3>Edit Jobs</h3>
        </div>
        <?php if(validation_errors()!=''){?>
        <div class="alert alert-success alert-danger">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
          <strong><?php echo validation_errors(); ?></strong> </div>
        <?php } ?>
        <div class="table-tech specs hor">
          <table class="hori-form">
            <tbody>
            <form action="<?php echo $this->config->site_url();?>/jobs/update" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
              <?php echo form_hidden('job_id', $formdata['job_id']);?>
              <tr>
                <td>Priority</td>
                <td><input id="job_priority" type="radio" name="job_priority" value="1"  <?php if($formdata['job_priority']==1)echo 'checked="checked"';?>  />
                  Immediate Joinin [0 Notice Peiord] &nbsp;
                  <input type="radio" name="job_priority" value="2" id="job_priority"  <?php if($formdata['job_priority']==2)echo 'checked="checked"';?> />
                  1 - 2 Weeks &nbsp;&nbsp;
                  <input id="job_priority" type="radio" name="job_priority" value="3"  <?php if($formdata['job_priority']==3)echo 'checked="checked"';?>  />
                  1 Month</td>
              </tr>
              <tr>
                <td>Job Title</td>
                <td><input type="text" id="job_title" name="job_title" value="<?php echo $formdata['job_title'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Job Description</td>
                <td><?php echo $this->ckeditor->editor('job_desc',$formdata['job_desc']);?></td>
              </tr>
              <tr>
                <td>Job Skills</td>
                <td><select class="form-control" onchange="myFunction();" id="parent"  name="parent">
                    <?php foreach($skill_list as $list){?>
                    <option <?php if($list['skill_id']== $formdata['job_skills']){?> selected="selected" <?php } ?> value="<?php echo $list['skill_id'];?>"><?php echo $list['skill_name'];?></option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td>Salary(Per Annum)</td>
                <td><?php echo form_dropdown('salary_id', $salary, $formdata['salary_id'],'class="form-control hori"');?></td>
              </tr>
              <tr>
                <td colspan="2">Hide Salary from jobseekers:&nbsp;
                <input type="checkbox" name="hide_salary" value="1" <?php if($formdata['hide_salary']==1)echo 'checked';?>> </td>
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
                <td>Job location</td>
                <td><?php echo form_dropdown('job_location', $city_list, $formdata['job_location'],'class="form-control hori"  id="city_id" ');?></td>
              </tr>
              <tr>
                <td> International Location(s) of Job </td>
                <td><?php echo form_dropdown('intl_locations', $intl_locations, $formdata['intl_locations'],'class="form-control hori" id="intl_locations" ');?></td>
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
                <td>Qualification</td>
                <td><?php echo form_dropdown('level_id', $education, $formdata['level_id'],'class="form-control hori"');?></td>
              </tr>
              <tr>
                <td>Number of vacancies</td>
                <td><input type="text" id="vacancies" name="vacancies" value="<?php echo $formdata['vacancies'];?>" placeholder="" class="form-control hori" /></td>
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
                <td>Age Limit</td>
                <td><input type="text" id="age_limit" name="age_limit" value="<?php echo $formdata['age_limit'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Max Notice period (in days) </td>
                <td><input type="text" id="max_notice_period" name="max_notice_period" value="<?php echo $formdata['max_notice_period'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
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
                <td>Company Name</td>
                <td><?php echo form_dropdown('company_id', $company, $formdata['company_id'],'class="form-control hori" id="company_id"');?></td>
              </tr>
              <tr>
                <td>Package</td>
                <td><?php echo form_dropdown('package_id', $package_list, $formdata['package_id'],'class="form-control hori" id="package_id"');?></td>
              </tr>
              <tr>
                <td>Business Type</td>
                <td><?php echo form_dropdown('business_type_id', $business_type, $formdata['business_type_id'],'class="form-control hori" id="business_type_id"');?></td>
              </tr>
              <tr  id="skill-tr"  <?php if(empty($job_skills)){ ?> style="display:none" <?php }  ?>>
                <td>&nbsp;</td>
                <td><select class="js-example-basic-multiple-skill" name="skills[]" multiple="multiple" id="multiple_skill" style="width:970px;">
                    <?php foreach($childskill as $c_skill){?>
                    <option <?php   if (in_array($c_skill['skill_id'], $job_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $c_skill['skill_id'];?>"><?php echo $c_skill['skill_name'];?></option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td>Job Certification</td>
                <td><select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_cert" name="cert_id[]" style="width:970px;">
                    <?php foreach($cerifications as $cert){?>
                    <option <?php   if (in_array($cert['cert_id'], $job_certifications)){ ?> selected="selected" <?php  } ?>  value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td>Domain Knowledge</td>
                <td><select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_domain" name="domain_id[]"  style="width:970px;">
                    <?php foreach($domain as $dom){?>
                    <option <?php   if (in_array($dom['domain_id'], $job_domain)){ ?> selected="selected" <?php  } ?>  value="<?php echo $dom['domain_id'];?>"><?php echo $dom['domain_name'];?></option>
                    <?php }?>
                  </select></td>
              </tr>
              <tr>
                <td>Job Type</td>
                <td><?php echo form_dropdown('job_type_id', $jobtype, $formdata['job_type_id'],'class="form-control hori"');?></td>
              </tr>
              
              <tr>
                <td>Resident Location</td>
                <td><input type="text" id="res_location" name="res_location" value="<?php echo $formdata['res_location'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Nationality</td>
                <td><?php echo form_dropdown('country_id', $nationality, $formdata['country_id'],'class="form-control hori"');?></td>
              </tr>
              <tr>
                <td>Job posting date</td>
                <td><input type="text" id="job_post_date" name="job_post_date" value="<?php echo $formdata['job_post_date'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Job expiry date</td>
                <td><input type="text" id="job_expiry_date" name="job_expiry_date" value="<?php echo $formdata['job_expiry_date'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Expected join date</td>
                <td><input type="text" id="exp_join_date" name="exp_join_date" value="<?php echo $formdata['exp_join_date'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              <tr>
                <td>Total Experience</td>
                <td><?php echo form_dropdown('total_exp_needed', $experience_list, $formdata['total_exp_needed'],'class="form-control hori"');?></td>
              </tr>
              <tr>
                <td>Attach Brochure</td>
                <td><?php echo form_upload(array('name'=>'brochure','class'=>'smallinput', 'value'=>$formdata['brochure']));?></td>
              </tr>
              <tr>
                <td>Work Level</td>
                <td><?php echo form_dropdown('work_level_id', $worklevel, $formdata['work_level_id'],'class="form-control hori"');?></td>
              </tr>
              <tr>
                <td>Desired Candidate Profile</td>
                <td><input type="text" name="desired_profile" id="desired_profile" class="form-control hori" style="height:100px;" value="<?php echo $formdata['desired_profile'];?>" maxlength="200">
                  <?php //echo $this->ckeditor->editor('desired_profile',$formdata['desired_profile']);?></td>
              </tr>
              <tr>
                <td>Instrcutions to Recruiters</td>
                <td><input type="text" name="instructions" id="instructions" class="form-control hori" style="height:100px;" value="<?php echo $formdata['instructions'];?>" maxlength="200"></td>
              </tr>
              
              <!-- 
    
    <tr>
    <td>Job keywords</td>
    <td> <input type="text" id="job_keywords" name="job_keywords" value="<?php echo $formdata['job_keywords'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
 
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
    <td>Contact Name</td>
    <td> <input type="text" id="contact_name" name="contact_name" value="<?php echo $formdata['contact_name'];?>" placeholder="" class="form-control hori" />
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
    <td>Contact Phone</td>
    <td> <input type="text" id="contact_phone" name="contact_phone" value="<?php echo $formdata['contact_phone'];?>" placeholder="" class="form-control hori" />
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


	<tr>
      <td>Mode of Job Application</td>
      <td>
      <input id="mode_of_application" type="radio" name="mode_of_application" value="1"  <?php if($formdata['mode_of_application']==1)echo 'checked="checked"';?>  />Register/Login & Apply &nbsp;
      <input type="radio" name="mode_of_application" value="2" id="mode_of_application"  <?php if($formdata['mode_of_application']==2)echo 'checked="checked"';?> />Apply by Email &nbsp;&nbsp;
      <input id="mode_of_application" type="radio" name="mode_of_application" value="3"  <?php if($formdata['mode_of_application']==3)echo 'checked="checked"';?>  />From External Link</td>
    </tr>
    
     <tr>
    <td>External Web Link</td>
    <td> <input type="text" id="social_link" name="social_link" value="<?php echo $formdata['social_link'];?>" placeholder="Any Link? Where candidate can register and submit applciation" class="form-control hori" />
    </td>
    </tr>
-->
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->site_url();?>/jobs" class="attach-subs subs">Cancel</a> </span></td>
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
<script>

$(".js-example-basic-multiple-cert").select2();
$(".js-example-basic-multiple-skill").select2();

//onchange of job_category

function validate()
{
	if($('#job_title').val()=='')
	{
		alert('Please enter job title');
		$('#job_title').focus();
		return false;
	}
	
	else if($('#company_id').val()== 0)
	{
		alert('Please select company name');
		$('#company_id').focus();
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
	$(".js-example-basic-multiple-skill").hide();
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
		//i+=1;
		//j=i%3;
		//var checks="<td><input type='checkbox' name='skills[]' value='add'/>"+skillset[k]['skill_name']+"</td>";
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
<script type="text/javascript">
	$('#job_cat_id').change(function() {
		
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');

	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');
			
	if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/jobs/get_functional_by_industry/',
		  data: { job_cat_id: $('#job_cat_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Loading...</option');
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
		  url: '<?php echo $this->config->site_url();?>/jobs/get_designation_by_functional/',
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

</script>
