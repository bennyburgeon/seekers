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
  
  <?php echo form_hidden('candidateId', $candidate_id);?>
  <h2 class="srevHd">Personal Details</h2>
  
<table align="left" width="45%" border="0">

<tr>
<td>First Name</td>
<td><?php echo $personal['first_name'];?></td>
</tr>

<tr>
<td>Last Name</td>
<td><?php echo $personal['last_name'];?></td>
</tr>

<tr>
<td>Email</td>
<td><?php echo $personal['username'];?></td>
</tr>

<tr>
<td>Gender</td>
<td><?php echo $personal['gender'];?></td>
</tr>

<tr>
<td>Marital Status</td>
<td><?php echo $personal['marital_status'];?></td>
</tr>

<tr>
<td>DoB</td>
<td><?php echo $personal['date_of_birth'];?></td>
</tr>

<tr>
<td>Mobile</td>
<td><?php echo $personal['mobile'];?></td>
</tr>



</table>
  
</form>
<table align="right" width="50%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['1']))echo $profile_list['1'];?></td>
</tr>
</table>
<div style="clear:both;"></div>
</div>
</div>

<!--START CONTACT DETAILS-->

<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form2" name="candidate_form2" action="<?php echo site_url('data_mgmt/editCandidateDetail'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $candidate_id);?>
  <h2 class="srevHd">Address</h2>
<table align="left" width="45%" border="0">

<tr>
<td>First Name</td>
<td><?php echo $personal['first_name'];?></td>
</tr>

<tr>
<td>Last Name</td>
<td><?php echo $personal['last_name'];?></td>
</tr>

<tr>
<td>Email</td>
<td><?php echo $personal['username'];?></td>
</tr>

<tr>
<td>Gender</td>
<td><?php echo $personal['gender'];?></td>
</tr>

<tr>
<td>Marital Status</td>
<td><?php echo $personal['marital_status'];?></td>
</tr>

<tr>
<td>DoB</td>
<td><?php echo $personal['date_of_birth'];?></td>
</tr>

<tr>
<td>Mobile</td>
<td><?php echo $personal['mobile'];?></td>
</tr>
</table>

<table align="right" width="35%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['2']))echo $profile_list['2'];?></td>
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
  <?php echo form_hidden('candidateId', $candidate_id);?>
  
<h2 class="srevHd">Education</h2>
<?php if(is_array($education)){?>
<?php foreach($education as $item){?>
<div style="float:left;">
<table align="left" width="40%" border="1">
<tr>
<td>Level Name</td>
<td><?php echo $item['level_name'];?></td>
</tr>

<tr>
<td>Course Name</td>
<td><?php echo $item['course_name'];?></td>
</tr>

<tr>
<td>Specialized in</td>
<td><?php echo $item['spcl_name'];?></td>
</tr>

<tr>
<td>University</td>
<td><?php echo $item['univ_name'];?></td>
</tr>

<tr>
<td>Type</td>
<td><?php echo $item['course_type'];?></td>
</tr>

<tr>
<td>Year</td>
<td><?php echo $item['edu_year'];?></td>
</tr>

</table>


</div>


<?php } ?>

<?php } ?>
<table align="right" width="50%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['3']))echo $profile_list['3'];?></td>
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
  
 <?php echo form_hidden('candidateId', $candidate_id);?>


<h2 class="srevHd">Job History</h2>
<?php if(is_array($job_details)){?>
<?php foreach($job_details as $item){?>
<div style="float:left;">
<table align="left" width="40%" border="1">
<tr>
<td>Organization</td>
<td><?php echo $item['organization'];?></td>
</tr>

<tr>
<td>Designation</td>
<td><?php echo $item['designation'];?></td>
</tr>

<tr>
<td>Responsiblity</td>
<td><?php echo $item['responsibility'];?></td>
</tr>

<tr>
<td>From Date</td>
<td><?php echo $item['from_date'];?></td>
</tr>

<tr>
<td>To Daye</td>
<td><?php echo $item['to_date'];?></td>
</tr>

<tr>
<td>Salary/Month</td>
<td><?php echo $item['monthly_salary'];?></td>
</tr>

</table>

</div>

<?php } ?>

<?php } ?>


<table align="right" width="35%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['4']))echo $profile_list['4'];?></td>
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
  <?php echo form_hidden('candidateId', $candidate_id);?>

<h2 class="srevHd">Language Skills</h2>

<?php if(is_array($language_skills)){?>
<table align="left" width="40%" border="1">
<tr>
<td colspan="2">Language Skill</td>
</tr>
<?php foreach($language_skills as $item){?>
<tr>
<td colspan="2"><?php echo $item['lang_name'];?></td>
</tr>
<?php } ?>
</table>
<?php } ?>

<table align="right" width="55%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['5']))echo $profile_list['5'];?></td>
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
<?php echo form_hidden('candidateId', $candidate_id);?>

<h2 class="srevHd">Tech Skills</h2>
<?php if(is_array($tech_skills)){?>
<table align="left" width="40%" border="1">
<tr>
<td colspan="2">Skill Name</td>
</tr>
<?php foreach($tech_skills as $item){?>
<tr>
<td colspan="2"><?php echo $item['skill_name'];?></td>
</tr>
<?php } ?>
</table>
<?php } ?>


<table align="right" width="35%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['6']))echo $profile_list['6'];?></td>
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
  <?php echo form_hidden('candidateId', $candidate_id);?>
  

<h2 class="srevHd">Certification</h2>
<?php if(is_array($certification)){?>
<table align="left" width="40%" border="1">
<tr>
<td colspan="2">Cert Name</td>
</tr>
<?php foreach($certification as $item){?>
<tr>
<td colspan="2"><?php echo $item['cert_name'];?></td>
</tr>
<?php } ?>
</table>
<?php } ?>


<table align="right" width="35%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['7']))echo $profile_list['7'];?></td>
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
  <?php echo form_hidden('candidateId', $candidate_id);?>

<h2 class="srevHd">Industry Experience [Projects]</h2>
<?php if(is_array($projects)){?>
<table align="left" width="40%" border="1">

<?php foreach($projects as $item){?>
<tr><td>
<table align="left" border="1">
<tr>
<td>Project Title</td>
<td><?php echo $item['project_title'];?></td>
</tr>

<tr>
<td>Project Description</td>
<td><?php echo $item['project_desc'];?></td>
</tr>

<tr>
<td>Keywords</td>
<td><?php echo $item['project_keywords'];?></td>
</tr>

<tr>
<td>Links</td>
<td><?php echo $item['project_links'];?></td>
</tr>


</table>

</td></tr>
<?php } ?>
</table>
<?php } ?>

<table align="right" width="40%" border="1">
<tr>
<td>&nbsp;<?php if(isset($profile_list['8']))echo $profile_list['8'];?></td>
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
  <?php echo form_hidden('candidateId', $candidate_id);?>


<h2 class="srevHd">Sports & Games</h2>
<?php if(is_array($sports)){?>

<table align="left" width="40%" border="1">
<tr>
<td colspan="2">Sport Details</td>
</tr>
<?php foreach($sports as $item){?>
<tr>
<td colspan="2"><?php echo $item['sport_details'];?></td>

</tr>




<?php } ?>
</table>

<?php } ?>


<table align="right" width="35%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['9']))echo $profile_list['9'];?></td>
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
 <?php echo form_hidden('candidateId', $candidate_id);?>


<h2 class="srevHd">Social</h2>
<?php if(is_array($social)){?>

<table align="left" width="40%" border="1">
<tr>
<td>Title</td>
<td>Link</td>
</tr>
<?php foreach($social as $item){?>

<tr>
<td><?php echo $item['social_title'];?></td>
<td><?php echo $item['social_link'];?></td>
</tr>
<?php } ?>
</table>


<?php } ?>


<table align="right" width="35%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['10']))echo $profile_list['10'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>


</div>
<!--END JOB DEATILS-->


</div>

<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="frm_language_status" name="frm_language_status"   action="<?php echo site_url('data_mgmt/update_language_status'); ?>/<?php echo $candidate_id ?>" > 
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

<table align="left" width="90%"><tr><td>    <h2>All Language Details</h2></td></tr>

<tr>
<td><table class="hori-form" border="1">
  <tbody>
    <tr>
      <td>IELTS</td>
      <td><input style="width:100px;" placeholder="Total"  type="text"  name="eng_pte" value="" id="eng_pte"></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>PTE</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>OET</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>TOFEL</td>
      <td><input type="radio" name="industry_exp" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==1)echo 'checked';?>>
        Poor</td>
      <td><input type="radio" name="industry_exp" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==2)echo 'checked';?>>
        Marginal</td>
      <td><input type="radio" name="industry_exp" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==3)echo 'checked';?>>
        Fair</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>GRE</td>
      <td><input type="radio" name="personality" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==1)echo 'checked';?>>
        Poor</td>
      <td><input type="radio" name="personality" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==2)echo 'checked';?>>
        Marginal</td>
      <td><input type="radio" name="personality" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==3)echo 'checked';?>>
        Fair</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>GMAT</td>
      <td><input type="radio" name="interaction" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==1)echo 'checked';?>>
        Poor</td>
      <td><input type="radio" name="interaction" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==2)echo 'checked';?>>
        Marginal</td>
      <td><input type="radio" name="interaction" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==3)echo 'checked';?>>
        Fair</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>SAT</td>
      <td><input type="radio" name="team_work" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==1)echo 'checked';?>>
        Poor</td>
      <td><input type="radio" name="team_work" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==2)echo 'checked';?>>
        Marginal</td>
      <td><input type="radio" name="team_work" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==3)echo 'checked';?>>
        Fair</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Eng 10th</td>
      <td><input type="radio" name="corporate_exp" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==1)echo 'checked';?>>
        Poor</td>
      <td><input type="radio" name="corporate_exp" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==2)echo 'checked';?>>
        Marginal</td>
      <td><input type="radio" name="corporate_exp" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==3)echo 'checked';?>>
        Fair</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Eng 12th</td>
      <td><input type="radio" name="overseas_edu" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==1)echo 'checked';?>>
        Poor</td>
      <td><input type="radio" name="overseas_edu" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==2)echo 'checked';?>>
        Marginal</td>
      <td><input type="radio" name="overseas_edu" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==3)echo 'checked';?>>
        Fair</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Eng. Grad</td>
      <td><input type="radio" name="migration" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==1)echo 'checked';?>>
        Poor</td>
      <td><input type="radio" name="migration" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==2)echo 'checked';?>>
        Marginal</td>
      <td><input type="radio" name="migration" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==3)echo 'checked';?>>
        Fair</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Eng Post Grad</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table></td>


</tr>

<tr>
<td colspan="2" id="step3-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Update" id="eng_button" style="width:180px;">

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

<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="frm_profile_status" name="frm_profile_status"   action="<?php echo site_url('data_mgmt/update_profile_status'); ?>/<?php echo $candidate_id ?>" > 
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

<table align="left" width="50%"><tr><td>    <h2>Profile Completion Status</h2></td></tr>

<tr>
<td>
<table class="hori-form">
<tbody>

<tr>
  <td>Persoanl</td>
  <td><input type="radio" name="profile_stat_1" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_1']) && $profile_status['profile_stat_1']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_1" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_1']) && $profile_status['profile_stat_1']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

<tr>
  <td>Address</td>
  <td><input type="radio" name="profile_stat_2" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_2']) && $profile_status['profile_stat_2']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_2" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_2']) && $profile_status['profile_stat_2']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

<tr>
  <td>Education</td>
  <td><input type="radio" name="profile_stat_3" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_3']) && $profile_status['profile_stat_3']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_3" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_3']) && $profile_status['profile_stat_3']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

<tr>
  <td>Profession</td>
  <td><input type="radio" name="profile_stat_4" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_4']) && $profile_status['profile_stat_4']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_4" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_4']) && $profile_status['profile_stat_4']==0)echo 'checked';?>>No&nbsp;</td>
</tr>


<tr>
  <td>Language</td>
  <td><input type="radio" name="profile_stat_5" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_5']) && $profile_status['profile_stat_5']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_5" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_5']) && $profile_status['profile_stat_5']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

<tr>
  <td>Tech Skills</td>
  <td><input type="radio" name="profile_stat_6" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_6']) && $profile_status['profile_stat_6']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_6" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_6']) && $profile_status['profile_stat_6']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

<tr>
  <td>Certification</td>
  <td><input type="radio" name="profile_stat_7" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_7']) && $profile_status['profile_stat_7']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_7" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_7']) && $profile_status['profile_stat_7']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

<tr>
  <td>Projects</td>
  <td><input type="radio" name="profile_stat_8" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_8']) && $profile_status['profile_stat_8']==1)echo 'checked';?> >Yes&nbsp;<input type="radio" name="profile_stat_8" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_8']) && $profile_status['profile_stat_8']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

<tr>
  <td>Sports</td>
  <td><input type="radio" name="profile_stat_9" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_9']) && $profile_status['profile_stat_9']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_9" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_9']) && $profile_status['profile_stat_9']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

<tr>
  <td>Social</td>
  <td><input type="radio" name="profile_stat_10" value="1" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_10']) && $profile_status['profile_stat_10']==1)echo 'checked';?>>Yes&nbsp;<input type="radio" name="profile_stat_10" value="0" <?php if(is_array($profile_status) && isset($profile_status['profile_stat_10']) && $profile_status['profile_stat_10']==0)echo 'checked';?>>No&nbsp;</td>
</tr>

</tbody>
</table>

</td>


</tr>

<tr>
<td colspan="2" id="step1-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Update" id="profile_button" style="width:180px;">

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

<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="frm_profile_assessment" name="frm_profile_assessment"   action="<?php echo site_url('data_mgmt/update_profile_assessment'); ?>/<?php echo $candidate_id ?>" > 

<input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

<table align="left" width="90%"><tr><td>    <h2>Profile Assessment</h2></td></tr>
<tr>
<td>

<table class="hori-form" border="1">
<tbody>

<tr>
  <td>Language</td>
  <td><input type="radio" name="language" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="language" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="language" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="language" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="language" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="language" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="language" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="language" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="language" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="language" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Attitude</td>
  <td><input type="radio" name="attitude" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="attitude" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="attitude" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="attitude" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="attitude" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="attitude" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="attitude" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="attitude" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="attitude" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="attitude" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Tech Skills</td>
    <td><input type="radio" name="tech_skills" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="tech_skills" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="tech_skills" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="tech_skills" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="tech_skills" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="tech_skills" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="tech_skills" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="tech_skills" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="tech_skills" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="tech_skills" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Ind. Exp.</td>
   <td><input type="radio" name="industry_exp" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="industry_exp" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="industry_exp" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="industry_exp" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="industry_exp" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="industry_exp" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="industry_exp" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="industry_exp" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="industry_exp" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="industry_exp" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Personality</td>
    <td><input type="radio" name="personality" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="personality" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="personality" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="personality" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="personality" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="personality" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="personality" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="personality" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="personality" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="personality" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Interaction</td>
   <td><input type="radio" name="interaction" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="interaction" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="interaction" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="interaction" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="interaction" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="interaction" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="interaction" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="interaction" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="interaction" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="interaction" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Team Work</td>
  <td><input type="radio" name="team_work" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="team_work" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="team_work" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="team_work" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="team_work" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="team_work" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="team_work" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="team_work" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="team_work" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="team_work" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Cop. Exp.</td>
    <td><input type="radio" name="corporate_exp" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="corporate_exp" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="corporate_exp" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="corporate_exp" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="corporate_exp" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="corporate_exp" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="corporate_exp" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="corporate_exp" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="corporate_exp" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="corporate_exp" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Edu. Abroad</td>
   <td><input type="radio" name="overseas_edu" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="overseas_edu" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="overseas_edu" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="overseas_edu" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="overseas_edu" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="overseas_edu" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="overseas_edu" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="overseas_edu" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="overseas_edu" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="overseas_edu" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==10)echo 'checked';?>>Exceptional</td>
</tr>

<tr>
  <td>Migration</td>
    <td><input type="radio" name="migration" value="1" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==1)echo 'checked';?>>Poor</td>
  <td><input type="radio" name="migration" value="2" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==2)echo 'checked';?>>Marginal</td>
  <td><input type="radio" name="migration" value="3"  <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==3)echo 'checked';?>>Fair</td>
  <td><input type="radio" name="migration" value="4" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==4)echo 'checked';?>>Satisfactory</td>
  <td><input type="radio" name="migration" value="5" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==5)echo 'checked';?>>Average</td>
  <td><input type="radio" name="migration" value="6" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==6)echo 'checked';?>>Good</td>
  <td><input type="radio" name="migration" value="7" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==7)echo 'checked';?>>Very Good</td>
  <td><input type="radio" name="migration" value="8" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==8)echo 'checked';?>>Excellent</td>
  <td><input type="radio" name="migration" value="9" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==9)echo 'checked';?>>Outstanding</td>
  <td><input type="radio" name="migration" value="10" <?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==10)echo 'checked';?>>Exceptional</td>
</tr>

</tbody>
</table>

</td>
</tr>
<tr>
<td colspan="2" id="step2-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Update" id="profile_assessment" style="width:180px;"> 

<div class="right-btns">
<a href="<?php echo site_url('data_mgmt/process_completed'); ?>/<?php echo $candidate_id ?>" class="attach-subs tools"><img src="http://localhost/recruitment-hub/admin/assets/images/plus.png">Done</a> &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('data_mgmt'); ?>" class="attach-subs tools"><img src="http://localhost/recruitment-hub/admin/assets/images/plus.png">Back to Listing</a>
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
    <p><!-- form ends here-->
      
      <!-- centercontent -->
    </p>
    
</div><!--bodywrapper-->
<!--<style> .bigdrop {
    width: 600px !important;
}</style>-->
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script>

var userFlag = 0;
$( document ).ready(function() {
	
$('#profile_button').click(function(){
		
		var dataStringprop = $("#frm_profile_status").serialize();
		var isContactValid = true;
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/update_profile_status'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step1-msg').show();							
							$('#step1-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step1-msg').fadeOut(6000);
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

$('#profile_assessment').click(function(){
		
		var dataStringprop = $("#frm_profile_assessment").serialize();
		var isContactValid = true;
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/update_profile_assessment'); ?>"+'/'+candidateId,
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
      
   
});   // end document.ready


</script>
