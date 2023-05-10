<?php //print_r( $skill_list);exit; ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
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
<?php if($this->session->flashdata('msg')){?>
<div class="alert alert-success">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
		 <strong><?php echo $this->session->flashdata('msg');?></strong>
	</div>
<?php } ?> 

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form1" name="candidate_form1" > 
  
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
  <h2 class="srevHd">Personal Details</h2>
  <table align="left" width="50%">
<tbody>
<tr>
<td>Title</td>
<td> <?php 
				   $options = array(
                  '1'  => 'Mr.',
				  '3'  => 'Mis.',
				  '4'  => 'Miss.',
                  '2'    => 'Mrs');
				   echo form_dropdown('title', $options, $formdata['title']);
				  ?>  </td>
</tr>
<tr>
<td>First name</td>
<td><input class="form-control hori" type="text" name="first_name" value="<?php echo $formdata['first_name'];?>" id="first_name"></td>
</tr>
<tr>
<td>Last name</td>
<td><input class="form-control hori fo-icon-1" type="text" name="last_name" value="<?php echo $formdata['last_name'];?>" id="last_name"></td>
</tr>
<tr>
<td>Email</td>
<td><input class="form-control hori " type="text" readonly name="username" value="<?php echo $formdata['username'];?>" id="username"></td>
</tr>
<tr>
<td>Gender</td>
 <td> 
		<?php 
            $data = array(
            'name'        => 'gender',
            'id'          => 'gender',
            'value'       => '1',
            'checked'     => '',
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
<td>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>Married</td>
    <td><input type="radio" name="marital_status" value="1" <?php if($formdata['marital_status']==1)echo 'checked="checked"';?>/></td>
    <td>Date of Marriage</td>
    <td><input type="text" name="marriage_date" id="datepicker" value="<?php echo $formdata['marriage_date'];?>" readonly placeholder="yyyy-mm-dd" /> </td>
  </tr>

<tr>
    <td>Engaged</td>
    <td><input type="radio" name="marital_status" value="2"  <?php if($formdata['marital_status']==2)echo 'checked="checked"';?> /></td>
    <td>Date of intented marriage</td>
    <td><input type="text" name="engaged_date" id="datepicker1" value="<?php echo $formdata['engaged_date'];?>" readonly placeholder="yyyy-mm-dd" /></td>
  </tr>
  
<tr>
    <td>Separated</td>
    <td><input type="radio" name="marital_status" value="3"  <?php if($formdata['marital_status']==3)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  

<tr>
    <td>Divorced</td>
    <td><input type="radio" name="marital_status" value="4"  <?php if($formdata['marital_status']==4)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<tr>
    <td>Widowed</td>
    <td><input type="radio" name="marital_status" value="5"  <?php if($formdata['marital_status']==5)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
<tr>
    <td>Never Married</td>
    <td><input type="radio" name="marital_status" value="6"  <?php if($formdata['marital_status']==6)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
       
</table>

</td>
</tr>



<tr>
<td>Mobile Phone</td>
<td><input type="hidden" name="mobile_prefix" value="" id="mobile_prefix">
  <input style="width:200px;" type="text" name="mobile" maxlength="13" value="<?php echo $formdata['mobile'];?>" id="mobile">
</td>
</tr>

<tr>
<td>Date of Birth</td>
<td><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" value="<?php echo $formdata['date_of_birth'];?>" placeholder="Enter your DoB"></td>
</tr>

<tr>
<td>Age</td>
<td><input style="width:100px;" type="text" maxlength="2" name="age" value="<?php echo $formdata['age'];?>" placeholder="Age">[Just leave this if you enter a valid DoB, Age calculate automatically when save.]</td>
</tr>

<tr>
<td>No of children</td>
<td><input style="width:100px;" type="text" maxlength="2" name="children" value="<?php echo $formdata['children'];?>" placeholder="Children"></td>
</tr>



<tr>
  <td>Lead Status</td>
  <td><input id="reg_status" type="radio" name="reg_status" value="1"  <?php if($formdata['reg_status']==1)echo 'checked="checked"';?>  />Leads &nbsp;<input type="radio" name="reg_status" value="2" id="reg_status"  <?php if($formdata['reg_status']==2)echo 'checked="checked"';?> />Registered &nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="3"  <?php if($formdata['reg_status']==3)echo 'checked="checked"';?>  />Closed &nbsp;&nbsp;<input type="radio" name="reg_status" value="4" id="reg_status"  <?php if($formdata['reg_status']==4)echo 'checked="checked"';?> />On Hold &nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="5"  <?php if($formdata['reg_status']==5)echo 'checked="checked"';?>  />Cancelled&nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="6"  <?php if($formdata['reg_status']==6)echo 'checked="checked"';?>  />Migration</td>
</tr>

<tr>
  <td>Lead Opportunity</td>
  <td><input id="lead_opportunity" type="radio" name="lead_opportunity" value="1"  <?php if($formdata['lead_opportunity']==1)echo 'checked="checked"';?>  />Cold &nbsp;<input type="radio" name="lead_opportunity" value="2" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==2)echo 'checked="checked"';?> />Warm &nbsp;&nbsp;<input id="lead_opportunity" type="radio" name="lead_opportunity" value="3"  <?php if($formdata['lead_opportunity']==3)echo 'checked="checked"';?>  />Hot &nbsp;&nbsp;<input type="radio" name="lead_opportunity" value="0" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==0)echo 'checked="checked"';?> />Unknown&nbsp;</td>
</tr>

<tr>
<td>How did you come to know us?</td>
<td><input class="form-control hori " type="text" name="lead_source" value="<?php echo $formdata['lead_source'];?>" placeholder="Lead Source"></td>
</tr>
<tr>
<td colspan="2" id="step1-msg">

</td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="attach-subs" value="Save" id="save_button_1" style="width:180px;">
</span>
</td>
</tr>

</tbody>
</table>
</form>
<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['1']))echo $formdata['profile_list']['1'];?></td>
</tr>
</table>
<div style="clear:both;"></div>
</div>
</div>

<!--START CONTACT DETAILS-->

<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form2" name="candidate_form2" action="<?php echo site_url('data_mgmt/editCandidateDetail'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<table align="left" width="45%">
<tbody>
  <tr>
    <td colspan="2"><h2>Address</h2></td>
  </tr>
  <tr>
<td colspan="2"><table>
<tbody>


<tr>
<td>Nationality</td>
 <td> 
 <?php  echo form_dropdown('nationality',  $country_list, $formdata['nationality'],'class="form-control" id="country_id"');?> 
 
 </td>	
</tr>

<tr>
<td>State</td>
<td>
<!--<input class="form-control hori " type="text" name="state" id="state_id" value="<?php echo $formdata['state'];?>" placeholder="Enter your State">-->
<?php echo form_dropdown('state',  $state_list, $formdata['state'],'class="form-control" id="state_id"');?>

</td>
</tr>
<tr>

<td>City</td>
<td>
<!--<input class="form-control hori " type="text" name="city_id" value="<?php echo $formdata['city_id'];?>" placeholder="Enter your City ">-->
<?php echo form_dropdown('city_id',  $city_list, $formdata['city_id'],'class="form-control" id="city_id"');?>
</td>
</tr>

<tr>
<td>Current location</td>
 <td> <?php echo form_dropdown('current_location',  $location_list, $formdata['current_location'],'class="form-control" id="location_id"');?> 
 </td>
</tr>
<tr>
<td>Contact Address</td>
<td><input class="form-control hori" type="text" name="address" value="" id="address"></td>
</tr>
<tr>
<td>Land Phone</td>
<td>
<input type="hidden" name="land_prefix" value="" id="land_prefix">
<input class="form-control hori " type="text" name="land_phone" value="" id="land_phone">
</td>
</tr>
<tr>
<td>Work Phone</td>
<td>
<input type="hidden" name="work_prefix" value="" id="work_prefix">
<input class="form-control hori " type="text" name="workphone" value="" id="workphone">
</td>
</tr>
<tr>
<td>Fax</td>
<td>
<input type="hidden" name="fax_prefix" value="" id="fax_prefix">
<input class="form-control hori " type="text" name="fax" value="" id="fax">
</td>
</tr>
<tr>
<tr>
<td>Zip code</td>
<td><input class="form-control hori fo-icon-1" type="text" name="zipcode" value="" id="zipcode"></td>
</tr>

</tbody>
</table></td>
</tr>

<tr>
  <tr>
<td> This will be stored only once even if you press save more than one.</td>
</tr>
<tr>
<td colspan="2" id="step2-msg">

</td>
</tr>

<tr>

<td align="center">

<input type="button" class="attach-subs" value="Save" id="save_button_2" style="width:180px;">

</td>
</tr>
</tbody>
</table>

<table align="right" width="45%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['2']))echo $formdata['profile_list']['2'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END CONTACT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form3" name="candidate_form3" action="<?php echo site_url('data_mgmt/addEducationDetail'); ?>/<?php echo $candidate_id ?>"  > 
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<table align="left" width="60%">
<tbody>
<tr>
  <td><h2>Education </h2></td>
</tr>
<tr>
  <td><table>
<tbody>

<tr>
  <td>College</td>
  <td><?php echo form_dropdown('college_id',  $college_list, '','class="form-control edu-field" id="college_id"');?></td>
</tr>
<tr>
<td>Level of Study</td>
 <td> <?php echo form_dropdown('level_id',  $edu_level_list, '','class="form-control edu-field" id="level_id"');?> </td>
</tr>
<tr>
<td>Course</td>
 <td> <?php echo form_dropdown('course_id',  $edu_course_list, '','class="form-control edu-field" id="course_id"');?> </td>
</tr>
<tr>
<td>Specialization/Industry</td>
 <td> <?php echo form_dropdown('spcl_id',  $edu_spec_list, '','class="form-control edu-field" id="spcl_id"');?> </td>
</tr>
<tr>
<td>University</td>
 <td> <?php echo form_dropdown('univ_id',  $edu_univ_list, '','class="form-control edu-field" id="univ_id"');?> </td>
</tr>
<tr>
<td>Year</td>
 <td> <?php echo form_dropdown('edu_year',  $edu_years_list, '','class="form-control edu-field" id="edu_year"');?> </td>
</tr>
<tr>
<td>Country</td>
 <td> <?php echo form_dropdown('edu_country',  $country_list, '','class="form-control edu-field" id="edu_country"');?> </td>
</tr>
<tr>
<td>Course Type</td>
 <td> <?php echo form_dropdown('course_type_id',  $edu_course_type_list, '','class="form-control edu-field" id="course_type_id"');?> </td>
</tr>


<tr>
<td>Arrears</td>
 <td> <input style="width:100px;" class="form-control  edu-field" placeholder="arrears"  type="text"  name="arrears" value="" id="arrears"> </td>
</tr>

<tr>
<td>Absesnce</td>
 <td> <input style="width:100px;" class="form-control edu-field" placeholder="absesnse"  type="text"  name="absesnse" value="" id="absesnse"> </td>
</tr>

<tr>
<td>Repeat</td>
 <td> <input style="width:100px;" class="form-control  edu-field" placeholder="repeat"  type="text"  name="repeat" value="" id="repeat"> </td>
</tr>

<tr>
<td>Year Back</td>
 <td> <input style="width:100px;" class="form-control  edu-field" placeholder="year back"  type="text"  name="year_back" value="" id="year_back"> </td>
</tr>

<tr>
<td>Total Percentage</td>
 <td> <input style="width:100px;" class="form-control  edu-field" placeholder="mark percentage"  type="text"  name="mark_percentage" value="" id="mark_percentage"> </td>
</tr>

<tr>
<td>Grade</td>
 <td> <input style="width:100px;" class="form-control  edu-field" placeholder="grade"  type="text"  name="grade" value="" id="grade"> </td>
</tr>
<tr>
<td colspan="2" id="step3-msg">

</td>
</tr>
</tbody>
</table></td>
  </tr>
<tr>
<td>
If you add more than one, it will be recorded in the database. 
</td>
</tr>
<tr>
<td id="step3-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="SAVE" id="save_button_3" style="width:180px;">

</td>
</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['3']))echo $formdata['profile_list']['3'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<!--END PASSPORT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4"  action="<?php echo site_url('data_mgmt/addJobDetail'); ?>/<?php echo $candidate_id ?>"> 
  
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<table width="40%" align="left">    <h2>Job Details</h2></td></tr>

<tr>

<td>Organization Name</td>
<td><input class="form-control hori job-field" type="text" name="organization" value="" id="organization"></td>
</tr>
<tr>
<td>Designation</td>
<td><input class="form-control hori job-field" type="text" name="designation" value="" id="designation">
</td>
</tr>

<tr>
<td>Industry</td>
 <td> <?php echo form_dropdown('job_cat_id',  $industry_list, '','class="form-control job-field" id="job_cat_id"');?> </td>
</tr>

<tr>
<td>Function/Role</td>
 <td> <?php echo form_dropdown('func_id',  $functional_list, '','class="form-control job-field" id="func_id"');?> </td>
</tr>


<tr>
<td>Responsibilities</td>
<td>
<input class="form-control hori job-field" type="text" name="responsibility" value="" id="responsibility">
</td>
</tr>
<td>From Date</td>
<td><input class="form-control hori datepicker job-field" type="text" name="from_date" id="datepickfrom" value="" placeholder="yyyy-mm-dd"></td>
</tr>
</tr>
<td>To Date</td>
<td><input class="form-control hori datepicker job-field" type="text" name="to_date" id="datepickto" value="" placeholder="yyyy-mm-dd"></td>
</tr>
<tr>
<td>Current Salary</td>
<td><input type="hidden" name="currency_id" value="0" />
<input class="form-control hori job-field" type="text" name="monthly_salary" value=""  id="monthly_salary">

</td>
</tr>


<tr>
<td>Is this your present job ?</td>
 <td> 
      <label class="radio-inline">
      <input class="job-field" type="radio" name="present_job" id="present_job" value="1">Yes</label>
    <label class="radio-inline">
<input class="job-field" type="radio" name="present_job" id="present_job" value="0">No</label>
                
 </td>
</tr>


<tr>
<td>Total Experience</td>
 <td> <?php echo form_dropdown('exp_years',  $years_list,'','class="form-control job-field" id="exp_years"');?>&nbsp; <?php echo form_dropdown('exp_months',  $months_list, '','class="form-control job-field" id="exp_months"');?>
  </td>	
</tr>
<tr>

<tr>
<td>Skills</td>
<td>
<input class="form-control hori job-field" type="text" name="skills" id="skills" value="" placeholder="Enter your Skills ">
</td>
</tr>
<tr>
<td>
If you add more than one, it will be recorded in the database. 
</td>
</tr>
<tr>
<td colspan="2" id="step4-msg">

</td>
</tr>
<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="attach-subs" value="Save" id="save_button_4" style="width:180px;">

</span>
</td>
</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['4']))echo $formdata['profile_list']['4'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<!--END CERTIFICATIOn DETAILS-->

<!--BEGIN EDUCATION DETAILS -->
<div id ="step3" >
<div class="table-tech specs hor">


  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5"  action="<?php echo site_url('data_mgmt/editLanguageDetail'); ?>/<?php echo $candidate_id ?>" >
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<table align="left" width="60%">
<tbody>

<tr>
  <td><h2>Language Skills</h2></td>
</tr>
<tr>
<td> This will be stored only once in the database, even if you save many times.
</td>
</tr>
<tr>
  <td> <table class="hori-form">
<tbody>

<tr>
  <td>Nationality</td>
    <td><?php echo form_dropdown('passport_nationality',  $country_list, $formdata['passport_nationality'],'class="form-control" id="passport_nationality"');?></td>
</tr>



<tr>
  <td>10th Marks</td>
    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_10th" value="<?php echo $formdata['eng_10th'];?>" id="eng_10th"></td>
</tr>

<tr>
  <td>12th Marks</td>
    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_12th" value="<?php echo $formdata['eng_12th'];?>" id="eng_12th"></td>
</tr>
<tr>
  <td>Graduation Mark</td>
    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_grad" value="<?php echo $formdata['eng_grad'];?>" id="eng_grad"></td>
</tr>

<tr>
  <td>Post Graduation Mark</td>
    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_post_grad" value="<?php echo $formdata['eng_post_grad'];?>" id="eng_post_grad"></td>
</tr>
<tr>
	<td>Languages Known</td>
	<td>
    <?php foreach($lang_list as $lang){ ?>
  		<label style="font-weight:normal"><input  type="checkbox" name="lang[]"  value="<?php echo $lang['lang_id'];?>" />&nbsp;<?php echo $lang['lang_name'];?></label>&nbsp;&nbsp;&nbsp;
		
    <?php } ?>
	</td>
</tr>

<tr>
<td colspan="2" id="step5-msg">

</td>
</tr>
</tbody>
</table></td>
  </tr>
<tr>
<td id="step4-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="save_button_5" style="width:180px;">


</td>
</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['5']))echo $formdata['profile_list']['5'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END EDUCATION DETAILS-->



<!--BEGIN JOB DEATILS-->
<div id ="step2" >

<div class="table-tech specs hor">

 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form6" name="candidate_form6"   action="<?php echo site_url('data_mgmt/editSkillDetail'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<table align="left" width="60%"><tr><td>    <h2>Tech Skills</h2></td></tr>

<tr>
  <tr>
<td> This will be stored only once in the database, even if you save many times.
</td>
</tr>
<tr>

<td>
<table width="60%" align="left">
<tbody>



<tr>


</tr>
  	<tr>
    <td>Technical Skills</td>
        <td> <select class="form-control" onchange="myFunction();" id="parent">
        <option value="">Select Skill</option>
            <?php foreach($skill_list as $key => $val){?>
              <option <?php if(isset($res1[0]['skill_id']) && $res1[0]['skill_id']==$key){?> selected="selected" <?php } ?> value="<?php echo $key;?>"><?php echo $val['skill_name'];?></option>
               <?php }?>
            </select>
        </td>
    </tr>
  
  	<tr  id="skill-tr"  <?php if(empty($candidate_skills)){ ?> style="display:none" <?php }  ?>>
    
    <td>&nbsp;</td>
        <td> 
        	<select class="js-example-basic-multiple-cert" name="skills[]" multiple="multiple" id="multiple_skill" style="width:500px;">
     			
            	<?php foreach($child_skills as $skill){?>
                            <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
               <?php }?>
            </select>
        </td>
     
    </tr>
   


    
  	

<tr>
<td colspan="2" id="step6-msg">

</td>
</tr>
</tbody>
</table>
</td>
</tr>

<tr>
<td  id="step5-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="save_button_6" style="width:180px;">

</td>
</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['6']))echo $formdata['profile_list']['6'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>



</div>
<!--END JOB DEATILS-->


</div>

<div id ="step4" >

<div class="table-tech specs hor">
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form7" name="candidate_form7"   action="<?php echo site_url('data_mgmt/editCertificateDetail'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
  
<table align="left" width="60%"><tr><td>    <h2>Certification</h2></td></tr>

<tr>
  
<tr>
    <td>Job Certification</td>
        <td> <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_cert" name="cert[]" style="width: 500px;">
            <?php foreach($cerifications as $cert){?>
              <option value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
               <?php }?>
            </select>
        </td>
    </tr>
    <tr>
<td> This will be stored only once in the database, even if you save many times.
</td>
</tr>

<tr>
<td colspan="2" id="step7-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="save_button_7" style="width:180px;">

</td>
</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['7']))echo $formdata['profile_list']['7'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>
</div>

<!--END JOB DEATILS-->


</div>


<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form8" name="candidate_form8"   action="<?php echo site_url('data_mgmt/addProjects'); ?>/<?php echo $candidate_id ?>" >
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<table align="left" width="60%"><tr><td>    <h2>Industry Experience [Projects]</h2></td></tr>

<tr>
  <tr>
<td> This will be stored more than one if you hit save more than one.</td>
</tr>
<tr>

<td>
<table class="hori-form">
<tbody>

<tr>
  <td>Project Title</td>
  <td><input class="form-control hori " placeholder="" type="text" name="project_title" value="" id="project_title"></td>
</tr>

<tr>
  <td>Project Description</td>
    <td><input class="form-control hori " placeholder="" type="text" name="project_desc" value="" id="project_desc"></td>
</tr>
<tr>
  <td>Project Keywords</td>
    <td><input class="form-control hori " placeholder="" type="text" name="project_keywords" value="" id="project_keywords"></td>
</tr>

<tr>
  <td>Project Links</td>
  <td><input class="form-control hori " placeholder="" type="text" name="project_links" value="" id="project_links"></td>
</tr>
</tbody>
</table>
</td>
</tr>

<tr>
<td colspan="2" id="step8-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="save_button_8" style="width:180px;">

</td>
</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['8']))echo $formdata['profile_list']['8'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>

</div>
<!--END JOB DEATILS-->


</div>


<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form9" name="candidate_form9"   action="<?php echo site_url('data_mgmt/addSports'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<table align="left" width="60%"><tr><td>    <h2>Sports & Games</h2></td></tr>

<tr>
  <tr>
<td> This will be stored more than one if you hit save more than one.</td>
</tr>
<tr>

<td>
<table class="hori-form">
<tbody>

<tr>
  <td>Sports Details</td>
  <td><input class="form-control hori " placeholder="" type="text" name="sport_details" value="" id="sport_details"></td>
</tr>

</tbody>
</table>
</td>
</tr>


<tr>
<td colspan="2" id="step9-msg">

</td>
</tr>

<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="save_button_9" style="width:180px;">

</td>
</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['9']))echo $formdata['profile_list']['9'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>

</div>
<!--END JOB DEATILS-->


</div>

<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form10" name="candidate_form10"   action="<?php echo site_url('data_mgmt/addSocial'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<table align="left" width="60%"><tr><td>    <h2>Social</h2></td></tr>

<tr>
  
<tr>

<td>
<table class="hori-form">
<tbody>

<tr>
  <td>Social Name</td>
  <td><input class="form-control hori " placeholder="" type="text" name="social_title" value="" id="social_title"></td>
</tr>

<tr>
  <td>Social Links</td>
  <td><input class="form-control hori " placeholder="" type="text" name="social_link" value="" id="social_link"></td>
</tr>

</tbody>
</table>
</td>
</tr>
<tr>
  <tr>
<td> This will be stored more than one if you hit save more than one.</td>
</tr>
<tr>
<td colspan="2" id="step10-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="save_button_10" style="width:180px;">

</td>
</tr>
<tr>
<td>
<div class="right-btns">
<a href="<?php echo site_url('data_mgmt'); ?>" class="attach-subs tools"><img src="http://localhost/recruitment-hub/admin/assets/images/plus.png">Back to Listing</a>
</div>
</td>

</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['10']))echo $formdata['profile_list']['10'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>


</div>
<!--END JOB DEATILS-->


</div>



</div>
</div>
</section>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- form ends here-->
    
    <!-- centercontent -->
</div><!--bodywrapper-->
<!--<style> .bigdrop {
    width: 600px !important;
}</style>-->
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script>

$('#simple').hide();
$('#multiple_cert').addClass('form-control hori');
$('#multiple_skill').addClass('form-control hori');
$(".js-example-basic-multiple-cert").select2();


function myFunction()
	{
	
	  var parnt =$('#parent').val();
	  $.ajax({
      type: "get",
      async: true,
      url: "<?php echo site_url('manage_data/child_skill'); ?>",
      data: {'id':parnt},
      dataType: "json",
      success: function(res) {
       
       create_checkbox(res);
     
     console.log(res['skillset']);
    
							} 
			});  
   }

function create_checkbox(res)
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


var userFlag = 0;
$( document ).ready(function() {
	$('#datepicker2').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});		

   function candidate_validate() 
   {
	    return true;
    }
	
   $('#save_button_1').click(function(){
		var dataStringprop = $("#candidate_form1").serialize();
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates_all/editCandidate'); ?>",
				cache: false,				
				data: dataStringprop,
				success: function(json){ 
					try{		
						var ret = jQuery.parseJSON(json);
						$('#hdstep1').val(ret['SUCCESS_ID']);
						if(ret['STATUS']==1) {
							$('#step1-msg').show();							
							$('#step1-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Personal Details Updated Successfully</strong></div>');	
							$('#step1-msg').fadeOut(6000);
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
   
//CONTACT DETAILS VALIDATION AND SUBMIT

   function candidate_validate1() 
   {
	    return true;
    }

   $('#save_button_2').click(function(){
		var dataStringprop = $("#candidate_form2").serialize();
		
		var isContactValid = true;
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/editCandidateDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step2-msg').show();							
							$('#step2-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step2-msg').fadeOut(6000);
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
   });//end button click function save*/
   
//END CONTACT DETAILS VALIDATION AND SUBMIT

//BEGIN PASSPORT DETAILS

   function candidate_validate2() {
   return true;

    }
   $('#save_button_3').click(function(){ 
		
		var dataStringprop = $("#candidate_form3").serialize();
		var isContactValid = true;
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/addEducationDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step3-msg').show();							
							$('#step3-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step3-msg').fadeOut(6000);						   
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
   });//end button click function save*/

//END PASSPORT DETAILS

//BEGIN SKILLS AND CERTIFICATE
   $('#save_button_4').click(function(){ 
		var dataStringprop = $("#candidate_form4").serialize();
		//var isContactValid = candidate_validate2();
		//if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/addJobDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){ 
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step4-msg').show();							
							$('#step4-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step4-msg').fadeOut(6000);						   
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		//} //end contact valid
   });//end button click function save*/

//END SKILLS AND CERTIFICATE DETAILS

//BEGIN EDUCATION DEATILS

   function candidate_validate3() {
	    return true;
    }
   $('#save_button_5').click(function(){
	
		var dataStringprop = $("#candidate_form5").serialize();
		var isContactValid = true;
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/editLanguageDetail'); ?>"+'/'+candidateId,
				cache: false,
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step5-msg').show();							
							$('#step5-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step5-msg').fadeOut(6000);
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });//end button click function save*/

//END EDUCATION DETAILS

//BEGIN JOB DETAILS

   function candidate_validate4() {
		
	    return true;
    }
   $('#save_button_6').click(function(){
		
		var dataStringprop = $("#candidate_form6").serialize();
		var isContactValid = true;
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/editSkillDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step6-msg').show();							
							$('#step6-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step6-msg').fadeOut(6000);
							}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });//end button click function save*/

   $('#save_button_7').click(function(){
		
		var dataStringprop = $("#candidate_form7").serialize();
		var isContactValid = true;
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/editCertificateDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step7-msg').show();							
							$('#step7-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step7-msg').fadeOut(6000);
							}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });//end button click function save*/
   
   $('#save_button_8').click(function(){
		
		var dataStringprop = $("#candidate_form8").serialize();
		var isContactValid = true;
		if(isContactValid) {
			
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/addProjects'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step8-msg').show();							
							$('#step8-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step8-msg').fadeOut(6000);
							}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });//end button click function save*/

   $('#save_button_9').click(function(){
		
		var dataStringprop = $("#candidate_form9").serialize();
		var isContactValid = true;
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/addSports'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step9-msg').show();							
							$('#step9-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step9-msg').fadeOut(6000);
							}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });//end button click function save*/

   $('#save_button_10').click(function(){
		
		var dataStringprop = $("#candidate_form10").serialize();
		var isContactValid = true;
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/addSocial'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step10-msg').show();							
							$('#step10-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step10-msg').fadeOut(6000);
							}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });//end button click function save*/


//END JOB DETAILS
});   // end document.ready


</script>

<script type="text/javascript">
$('#country_id').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');
		
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getcity/',
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

$('#city_id').change(function() {

	jQuery('#location_id').html('');
	jQuery('#location_id').append('<option value="">Select Location</option');
		
	if($('#state_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getlocation/',
		  data: { city_id: $('#city_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#location_id').html('');
				jQuery('#location_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){              
			  if(data.success==true)
			  {
                              jQuery('#location_id').html('');                              				  
				  $.each(data.location_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#location_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#location_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#location_id').html('');
				jQuery('#location_id').append('<option value="">Select Location</option');
		  }
		});	
});

</script>