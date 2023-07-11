<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>/jobs_ov">Jobs</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Add Jobs</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Add Jobs</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

<form action="<?php echo $this->config->site_url();?>/jobs_ov/add" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
    <tr>
      <td>Priority</td>
      <td><input id="job_priority" type="radio" name="job_priority" value="1"  <?php if($formdata['job_priority']==1)echo 'checked="checked"';?>  />High &nbsp;<input type="radio" name="job_priority" value="2" id="job_priority"  <?php if($formdata['job_priority']==2)echo 'checked="checked"';?> />Medium &nbsp;&nbsp;<input id="job_priority" type="radio" name="job_priority" value="3"  <?php if($formdata['job_priority']==3)echo 'checked="checked"';?>  />Low</td>
    </tr>
    <tr>
    <td>Job Title</td>
    <td> <input type="text" id="job_title" name="job_title" value="<?php echo $formdata['job_title'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
    <tr>
    <td>Company name</td>
    <td> 
    <?php echo form_dropdown('company_id', $company, $formdata['company_id'],'class="form-control hori" id="company_id"');?>
    </td>
    </tr>
    
    <tr>
    <td>Job Industry</td>
    <td>
     <?php echo form_dropdown('job_cat_id', $jobindustry, $formdata['job_cat_id'],'class="form-control hori" id="job_cat_id"');?>
    </td>
    </tr>
<!--     
    <tr>
    <td>Job Category</td>
    <td>
     <?php echo form_dropdown('job_cat_id', $jobcategory, $formdata['job_cat_id'],'class="form-control hori" id="job_cat_id"');?> 
    </td>
    </tr>
-->    
    <tr>
    <td>Job Functional Area</td>
    <td> 
    <?php echo form_dropdown('func_id', $functional, $formdata['func_id'],'class="form-control hori" id="func_id"');?>
    </td>
    </tr>
    
    <tr>
     <td>Job Skills</td>
        <td> <select class="form-control" onchange="myFunction();" id="parent" name="parent">
        <option value="">Select Skill</option>
            <?php foreach($skillset as $skill){?>
            	 <option value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
             
             <?php }?>
            </select>
        </td>
    </tr>
  
  	<tr  id="skill-tr"  <?php if(empty($candidate_skills)){ ?> style="display:none" <?php }  ?>>
    
    <td>&nbsp;</td>
        <td> 
        	<select class="js-example-basic-multiple-skill" name="skills[]" multiple="multiple" id="multiple_skill" style="width:970px;">
     			
            	<?php foreach($res as $skill){?>
                            <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
               <?php }?>
            </select>
        </td>
     
    </tr>
    
   <tr>
    <td>Job Certification</td>
        <td> <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_cert" name="cert_id[]"  style="width:970px;">
            <?php foreach($cerifications as $cert){?>
              <option value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
               <?php }?>
            </select>
        </td>
    </tr>
    
    <tr>
    <td>Domain Knowledge</td>
        <td> <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_domain" name="domain_id[]"  style="width:970px;">
            <?php foreach($domain as $dom){?>
              <option value="<?php echo $dom['domain_id'];?>"><?php echo $dom['domain_name'];?></option>
               <?php }?>
            </select>
        </td>
    </tr>
    
    <tr>
    <td>Job Type</td>
    <td> 
    <?php echo form_dropdown('job_type_id', $jobtype, $formdata['job_type_id'],'class="form-control hori"');?>
    </td>
    </tr>
    <tr>
    <td>Job location</td>
    <td>
     <?php echo form_dropdown('job_location', $job_location, $formdata['job_location'],'class="form-control hori"');?>
    <!--  <input type="text" id="job_location" name="job_location" value="<?php echo $formdata['job_location'];?>" placeholder="" class="form-control hori" /> -->
    </td>
    </tr>
    <tr>
    <td>Resident Location</td>
    <td> <input type="text" id="res_location" name="res_location" value="<?php echo $formdata['res_location'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    <tr>
    <td>Nationality</td>
    <td> <?php echo form_dropdown('country_id', $nationality, $formdata['country_id'],'class="form-control hori"');?>
    </td>
    </tr>
    <tr>
    <td>Gender</td>
    <td> 
    <?php 
						
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
						
					?>						
    
    </td>
    </tr>
    <tr>
    <td>Number of vacancies</td>
    <td> <input type="text" id="vacancies" name="vacancies" value="<?php echo $formdata['vacancies'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
    <tr>
    <td>Job posting date</td>
    <td> <input type="text" id="job_post_date" name="job_post_date" value="<?php echo $formdata['job_post_date'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
    <tr>
    <td>Job expiry date</td>
    <td> <input type="text" id="job_expiry_date" name="job_expiry_date" value="<?php echo $formdata['job_expiry_date'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
    <tr>
    <td>Expected join date</td>
    <td> <input type="text" id="exp_join_date" name="exp_join_date" value="<?php echo $formdata['exp_join_date'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>

    <tr>
    <td>Totalo Experience [Yrs]</td>
    <td> <input type="text" id="total_exp_needed" name="total_exp_needed" value="<?php echo $formdata['total_exp_needed'];?>" placeholder="Years of exp." class="form-control hori" />
    </td>
    </tr>
        
    
    <tr>
    <td>Attach Brochure</td>
    <td> <?php echo form_upload(array('name'=>'brochure','class'=>'smallinput', 'value'=>$formdata['brochure']));?>
    </td>
    </tr>
    
    <tr>
    <td>Highest education</td>
    <td> <?php echo form_dropdown('level_id', $education, $formdata['level_id'],'class="form-control hori"');?>
    </td>
    </tr>
    
    <tr>
    <td>Work Level</td>
    <td> <?php echo form_dropdown('work_level_id', $worklevel, $formdata['work_level_id'],'class="form-control hori"');?>
    </td>
    </tr>
    
    <tr>
    <td>Salary</td>
    <td> <?php echo form_dropdown('salary_id', $salary, $formdata['salary_id'],'class="form-control hori"');?>
    </td>
    </tr>
    
    <tr>
    <td>Desired Candidate Profile</td>
    <td>
    <input type="text" name="desired_profile" id="desired_profile" class="form-control hori" style="height:100px;" value="<?php echo $formdata['desired_profile'];?>" maxlength="200">
     <?php //echo $this->ckeditor->editor('desired_profile',$formdata['desired_profile']);?>
    </td>
    </tr>
    
    <tr>
    <td>Job Details</td>
    <td> <?php echo $this->ckeditor->editor('job_desc',$formdata['job_desc']);?>
    </td>
    </tr>
    

    
    <tr>
    <td>Job keywords</td>
    <td> <input type="text" id="job_keywords" name="job_keywords" value="<?php echo $formdata['job_keywords'];?>" placeholder="" class="form-control hori" />
    </td>
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
    
    -->
    
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
    <td>Web Link</td>
    <td> <input type="text" id="social_link" name="social_link" value="<?php echo $formdata['social_link'];?>" placeholder="Any Link? [To Social Media]" class="form-control hori" />
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
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/jobs_ov" class="attach-subs subs">Cancel</a>
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
			  url: '<?php echo $this->config->site_url();?>/jobs_ov/getfunction/',
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



</script>	
