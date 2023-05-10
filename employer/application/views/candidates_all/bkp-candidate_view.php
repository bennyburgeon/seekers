<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Candidates / <span><a href="<?php echo $this->config->site_url();?>/candidates_all/candidate_view/<?php echo $candidate_id;?>" >Profile</a></span>&nbsp;&nbsp;&nbsp;  | &nbsp;&nbsp;&nbsp;<span><a href="<?php echo $this->config->site_url();?>/candidates_all/">Back to listing</a></span></div>
</div>
<div class="row">
<div class="col-md-3">
<div class="profile_box">

<?php if($detail_list['photo']=='no_photo.png' or $detail_list['photo']==''){?>
<span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/no_photo.png'?>" class="profile_img" style="widtt:158px;"></span>	
<h2><?php echo $detail_list['first_name'];?></h2>
<div style="margin-left: -136px;margin-bottom: -50px;">
<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/img_update' style="margin-top: 19px;">
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload">
<img src="<?php echo base_url('assets/images/browse.png');?>">
<input type="file" class="upload"  name="photo" id="photo" />
</div>
</form>
</div>
<div id="imgfoto" style="margin-top: -22px; margin-left: 76px;"></div>
<?php } else{ ?>

<span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$detail_list['photo'];?>" class="profile_img" style="width:158px;"></span>
<h2><?php echo $detail_list['first_name'];?></h2>

<div style="margin-top: 20px;margin-left: 30px;"> 

<div style="margin-left: -135px;">
<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/img_update' style="margin-top: 19px;">
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload" id="imgfoto1">
<img src="<?php echo base_url('assets/images/browse.png');?>" >
<input type="file" class="upload"  name="photo" id="photo" />
</div>
</form>
</div>

<div style="margin-left: 78px;margin-top: -50px;">
<form id="img1_validate" class="img1_validate" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/deletefile1' >
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload" id="imgfoto">
<a href="" class="attach-subs subs profile_btn" >delete</a>
</div>
</form>
</div>
</div>	
	
<?php }	?>
<span id="loading"></span>

<!--<h3>Developer</h3>
-->




<ul style="margin-top: 73px;">

<li><a href="<?php echo $this->config->site_url();?>/candidates_all/summary/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>


<li class="active"><a href="<?php echo $this->config->site_url();?>/candidates_all/candidate_view/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Follow-up</a></li>

<li><a href="<?php echo $this->config->site_url();?>/candidates_all/edit/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Edit Profile</a></li>
<li><a href="<?php echo base_url();?>index.php/candidates_all/cvfile/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Profile Info</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/edu_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Education</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/job_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Job History</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>


<li><a href="<?php echo base_url();?>index.php/candidates_all/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/questionnaire/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Questionnaire</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/candidate_file/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Manage Files</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/email_sms/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Email & SMS</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/tickets/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Complaints</a></li>

</ul>


</div>


</div>
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Candidate View</div>
<div class="profile_top_right">
<ul>
<li id="followup_btn">Follow up</li>
<li id="notes_btn">Notes</li>
<li id="interviews_btn">Interviews</li>
<?php if($detail_list['reg_status']==1){?>
<li id="registration_btn">Registration</li>
<?php } ?>
<?php if($detail_list['reg_status']==1){?>

<li id="program_btn">Programs</li>
<li id="coe_btn">CoE</li>
<li id="visa_approval_btn">Visa</li>
<?php } ?>

</ul>
</div>
<div style="clear:both;"></div>
</div>



<div class="profile_bottom" id="followup">
<div class="tasks profile">

<div id="response"></div>
<?php 
 foreach($list as $followup_list1){?>
<div class="slider_redesign" id="tr_<?php echo $followup_list1['candidate_follow_id'];?>" >
<div class="side_adj second">

<h2>Followup Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $followup_list1['title'];?></h2>
<?php if($followup_list1['status_name']!=''){?>
<h2>Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $followup_list1['status_name'];?></h2>
<?php } ?>
<?php if($followup_list1['app_details']!=''){?>
<h2>Program	:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $followup_list1['app_details'];?></h2>
<?php } ?>
<h2>Description:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $followup_list1['description'];?></h2>
<div class="date_edit">
<span class="dates"><?php echo $followup_list1['flp_date'];?></span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $followup_list1['candidate_follow_id'];?>" onClick="return validate(this.id)" >

</span>

</div>
</div>
</div>
<?php }?>


</div>
</div>

<div class="profile_bottom" id="notes">
<div class="tasks profile">
<div id="response1"></div>
<?php foreach($note_list as $note_list1){?>
<div class="slider_redesign" id="tr_<?php echo $note_list1['candidate_note_id'];?>">
<div class="side_adj second">

<h2>Note Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $note_list1['title'];?></h2>
<h2>Note Description:&nbsp;&nbsp;<?php echo $note_list1['notes'];?></h2>
<div class="date_edit">
<span class="dates"><?php echo $note_list1['note_date'];?></span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" onClick="return note_validate(this.id)" id="<?php echo $note_list1['candidate_note_id'];?>" >

</span>

</div>
</div>
</div>
<?php }?>

</div>
</div>

<?php if($detail_list['reg_status']==1){?>

<div class="profile_bottom" id="registration">
<div class="tasks profile">
<div id="response2"></div>

<div class="slider_redesign" id="tr_">
<div class="side_adj second">

<h2>Comments: <?php echo $detail_list['fee_comments'];?></h2>
<h2>Registraion Date:<?php echo $detail_list['fee_date'];?></h2>
<h2>Registraion Fees: INR <?php echo $detail_list['fee_amount'];?></h2>
<div class="date_edit">
Candidate registration is completed.

</div>
</div>
</div>

</div>
</div>

<?php } ?>
<div class="profile_bottom" id="interviews">
<div class="tasks profile">
<div id="response2"></div>
<?php foreach($interview_list as $interview_list1){?>
<div class="slider_redesign" id="tr_<?php echo $interview_list1['interview_id'];?>">
<div class="side_adj second">

<h2>Interview title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list1['title'];?></h2>
<h2>Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list1['description'];?></h2>
<h2>Interview Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list1['interview_date'];?></h2>
<h2>Interview Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list1['interview_time'];?></h2>
<h2>Duration:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list1['duration'];?></h2>
<h2>Interview Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list1['interview_type'];?></h2>
<h2>Interview Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list1['int_status_name'];?></h2>
<h2>Interview Location:&nbsp;<?php echo $interview_list1['location'];?></h2>
<div class="date_edit">
<span class="dates">21 Jun 2015 at 02:30 PM</span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $interview_list1['interview_id'];?>" onClick="return int_validate(this.id)" >
</span>

</div>
</div>
</div>
<?php }?>

</div>
</div>

<?php if($detail_list['reg_status']==1){?>

<div class="profile_bottom" id="program">
<div class="tasks profile">
<div id="responseapp"></div>
<?php foreach($aplication_list as $aplication_list1){?>
<div class="slider_redesign" id="tr_<?php echo $aplication_list1['app_id'];?>">
<div class="side_adj second">

<h2>University Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $aplication_list1['campus_name'];?></h2>
<h2>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php echo $aplication_list1['course_name'];?></h2>
<h2>Program Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $aplication_list1['status_name'];?></h2>
<h2>Program Details:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $aplication_list1['app_details'];?></h2>

<div class="date_edit">
<span class="dates">21 Jun 2015 at 02:30 PM</span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $aplication_list1['app_id'];?>" onClick="return app_validate(this.id)" >
</span>

</div>
</div>
</div>
<?php }?>

</div>
</div>

<div class="profile_bottom" id="coe">
<div class="tasks profile">
<div id="responseapp"></div>
<?php foreach($coe_list as $coe){?>
<div class="slider_redesign" id="tr_<?php echo $coe['app_id'];?>">
<div class="side_adj second">

<h2>Program:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['app_details'];?></h2>
<h2>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['course_name'];?></a></h2>

<div class="date_edit">
<span class="dates"><?php echo $coe['orientation_date'];?></span>

</div>
</div>
</div>
<?php }?>

</div>
</div>

<div class="profile_bottom" id="visa_approval">
<div class="tasks profile">
<div id="responseapp"></div>
<?php foreach($visa_approval_list as $visa){?>
<div class="slider_redesign" id="tr_<?php echo $visa['app_id'];?>">
<div class="side_adj second">

<h2>Visa Apprved Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $visa['visa_apprv_date'];?></h2>
<h2>Travel Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $visa['travel_date'];?></a></h2>
<h2>Date of join Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $visa['date_of_join'];?></a></h2>
<div class="date_edit">
<span class="dates"><?php echo $visa['comments'];?></span>

</div>
</div>
</div>
<?php }?>

</div>
</div>

<?php } ?>


<div class="notes">
<ul>
<li id="tab_1btn">Followup</li>
<li id="tab_2btn">Notes</li>
<li id="tab_3btn">Interview</li>
<?php if($detail_list['reg_status']==0){?>
<li id="tab_4btn">Registration</li>
<?php } ?>
<?php if($detail_list['reg_status']==1){?>
<li id="tab_5btn">Programs</li>
<li id="tab_6btn">CoE</li>
<li id="tab_7btn">Visa Approval</li>
<?php } ?>
</ul>

   
	<!--Followup-->

    <div class="table-tech specs note" id="tab_1">
    <div class="new_notes">
    <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
    -->
    <p id="result"></p>

    <p id="deletemessage"></p>

  <form method="post" id="profile_followup" name="profile_followup" action="<?php  echo $this->config->site_url();?>/candidates_all/followup" >
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
    <table class="hori-form">
    <tbody>
    <tr>
    <td width="200">Enter Title</td>
    <td width="139" colspan="2">
       <input name="followup_title" type="text" id="followup_title" class="text_box">    </td>
    </tr>
    
    <tr>
    <td>Program Details</td>
    <td colspan="3"> <?php echo form_dropdown('app_id',  $app_list,'','id="app_id"  class="table-group-action-input form-control input-medium"');?></td>
    </tr>
    
    <tr>
    <td>Process status</td>
    <td colspan="3"> <?php echo form_dropdown('status_id',  $status_list,'','id="status_idd"  class="table-group-action-input form-control input-medium"');?></td>
    </tr>
    
     <tr>
    <td>Enter Description</td>
    <td colspan="2">
       <textarea name="followup_desc" cols="" rows="" class="text_area" id="followup_desc"></textarea>    </td>
    </tr>

    <tr>
    <td colspan="4">Schedule this for a date in future?
      <input type="checkbox" name="future_followup" value="1" id="future_followup" />      &nbsp;Yes</td>
    </tr>

    
    <tr>
      <td>Date</td>
      <td colspan="3"><table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td><input type="text" name="flp_date_reminder" id="flp_date_reminder" readonly="readonly" value="" style="width:100px;"/></td>
          <td>Time</td>
          <td><input type="text" name="flp_time_reminder" id="flp_time_reminder" value="" style="width:100px;"/>&nbsp;eg. 10:15 AM</td>
        </tr>
      </table></td>
    </tr>
    <tr>
    <td>Responsibile by</td>
    <td colspan="3"><?php echo form_dropdown('assigned_to',  $admin_user_list,'','id="assigned_to"  class="table-group-action-input form-control input-medium"');?>&nbsp;</td>
    </tr>
        
    <tr>
    <td colspan="3">
    <span class="click-icons">
      <input type="button" name="sub" id="sub" class="attach-subs" value="Save" >
    <a href="#" class="attach-subs subs">Cancel</a>    </span>    </td>
    </tr>
    </tbody>
    </table>
    </form>

    </div>
    
   
    <div style="clear:both;"></div>
    </div>

	<!--Followup-->

	<!--Notes-->
    <div class="table-tech specs note" id="tab_2">
    <div class="new_notes">
    <!--<div class="alert alert-warning"><strong>Warning!</strong> Your monthly traffic is reaching limit.</div>
    -->
        <p id="result1"></p>

    <p id="deletemessage1"></p>
    <form method="post" id="candidate_notes" name="candidate_notes" action="<?php  echo $this->config->site_url();?>/candidates_all/notes" >
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
    <h3>Create New Note:</h3>
    <input name="note_title" type="text" class="text_box" id="note_title">
    <h3>Enter Description:</h3>
    <textarea name="note_desc" cols="" rows="" class="text_area" id="note_desc"></textarea>
    <span class="click-icons">
     <input type="button" name="sub1" id="sub1" class="attach-subs" value="Save" >
    <a href="" class="attach-subs subs">Cancel</a>
    </span>
    </form>
     </div>

    <div style="clear:both;"></div>
    </div>
  	 <!--Notes-->

 	 <!--Interview-->
    <div class="table-tech specs note" id="tab_3">
    <div class="new_notes">
    <!--<div class="alert alert-danger"><strong>Error!</strong> The daily cronjob has failed.</div>
    -->
            <p id="result2"></p>

    <p id="deletemessage2"></p>
    <form method="post" id="candidate_interview" name="candidate_interview" action="<?php  echo $this->config->site_url();?>/candidates_all/interview" >
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
    <h3>Interview Title:</h3>
    <input name="interview_title" id="interview_title"  type="text" class="text_box">
    <h3>Interview Date:</h3>
    <input name="interview_date" id="interview_date" type="text" class="text_box">
    <h3>Interview Time:</h3>
    <input name="interview_time" id="interview_time" type="text" class="text_box">
    <h3>Duration:</h3>
    <input name="duration" id="duration" type="text" class="text_box">
    <h3>Description:</h3>
    <textarea name="interview" id="interview" cols="" rows="" class="text_area"></textarea>
    <table class="hori-form">
    <tbody>
    
    <tr>
    <td>Interview type</td>
    <td>
   <?php echo form_dropdown('interview_type',  $interview_type_list,'','id="interview_type"  class="table-group-action-input form-control input-medium"');?>
    </td>
    </tr>
    
    <tr>
    <td>Interview Status</td>
    <td>
    <?php echo form_dropdown('interview_status',  $interview_status_list,'','id="interview_status"  class="table-group-action-input form-control input-medium"');?>
    </td>
    </tr>
    
    <tr>
    <td>Location</td>
    <td colspan="2"><input class="form-control hori" type="text" name="location" id="location" placeholder="Enter  Location"></td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
      <input type="button" name="sub2" id="sub2" class="attach-subs" value="Save" >
    <a href="#" class="attach-subs subs">Cancel</a>
    </span>
    </td>
    </tr>
    </tbody>
    </table>
    </form>
    </div>
    <div style="clear:both;"></div>
    </div>
	<!--Interview-->

<?php if($detail_list['reg_status']==0){?>
     <!--Registration Upload-->
    <div class="table-tech specs note" id="tab_4">
    <div class="new_notes">
   <p id="result4"></p>
    <p id="deletemessage4"></p>
    <form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/candidate_view/<?php echo $candidate_id;?>'>
    <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>" />
	
    <h3>Registration:</h3>
    
    <table class="hori-form">
    <tbody>
 <tr>
    <td>This candidate has paid fees for<br />
 registration and take further steps.</td>
    <td>
<input type="checkbox" name="reg_status" value="1" checked="checked" />
   
    </td>
    </tr> 
 <tr>
    <td>Date</td>
    <td>
<input type="text" name="fee_date" id="fee_date" class="text_box" value="" placeholder="yyyy-mm-dd" maxlength="10"/>
   
    </td>
    </tr>    
 <tr>
    <td>Fees Amount</td>
    <td>
<input type="text" name="fee_amount" id="fee_amount" class="text_box" value="" placeholder="Fee INR 0.00" maxlength="10"/>
   
    </td>
    </tr>       
    <tr>
    <td>Fee Details</td>
    <td>
<input type="text" name="fee_comments" id="fee_comments" class="text_box">
   
    </td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <a href=""><input type="submit"  class="attach-subs" value="Update" id="upload_but"/></a>
    </span>
    </td>
    </tr>
    </tbody>
    </table>
    </form>
    </div>
    <div style="clear:both;"></div>
    </div>
    <!-- Registration End Here -->
<?php } ?>    
     <!--Programs-->
    <div class="table-tech specs note" id="tab_5">
    <div class="new_notes">
    <!--<div class="alert alert-danger"><strong>Error!</strong> The daily cronjob has failed.</div>
    -->
    <p id="resultapp"></p>
    <p id="deleteapp"></p>
    <form method="post" id="candidate_aplication" name="candidate_aplication" action="<?php  echo $this->config->site_url();?>/candidates_all/aplication" >
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
    <table class="hori-form">
    <tbody>
    <tr>
    <td>University</td>
    <td>
   <?php echo form_dropdown('univ_id',  $university_list,'','id="univ_id"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>
    
    <tr>
      <td>Campus</td>
      <td><?php echo form_dropdown('campus_id',  $campus_list,'','id="campus_id"  class="table-group-action-input form-control input-medium"');?> </td>
    </tr>

    <tr>
    <td>Level of Study</td>
    <td>
    <?php echo form_dropdown('level_study',  $level_list,'','id="level_study"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>
        
    <tr>
    <td>Course</td>
    <td>
    <?php echo form_dropdown('course_id', $course_list,'','id="course_id"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>

    <tr>
    <td>Intake</td>
    <td>
    <?php echo form_dropdown('intake_id',  $intake_list,'','id="intake_id"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>
        
    <tr>
    <td>Process status</td>
    <td colspan="2"> <?php echo form_dropdown('status_id',  $status_list,'','id="status_id"  class="table-group-action-input form-control input-medium"');?></td>
    </tr>
     <tr>
    <td>Program Details</td>
    <td colspan="2"> <textarea name="app_details" cols="" rows="" class="text_area" id="app_details"></textarea> </td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
      <input type="button" name="app" id="app" class="attach-subs" value="Save" >
    <a href="#" class="attach-subs subs">Cancel</a>    </span>    </td>
    </tr>
    </tbody>
    </table>
    </form>
    </div>
    <div style="clear:both;"></div>
    </div>
	<!--Programs-->

	<!-- CoE Update -->
    <div class="table-tech specs note" id="tab_6">
    <div class="new_notes">
    <p id="success"></p>
    <p id="emails"></p>
    
    <form method="post" id="profile_followup" name="profile_followup" action="<?php  echo $this->config->site_url();?>/candidates_all/followup" >
    <input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
      
    <table class="hori-form">
    <tbody>
    
    <tr>
    <td>Select Program</td>
    <td colspan="3"> <?php echo form_dropdown('cand_app_id',  $app_list,'','id="cand_app_id"  class="table-group-action-input form-control input-medium"');?></td>
    </tr>

    <tr>
    <td>Process status</td>
    <td colspan="3"> <?php echo form_dropdown('status_id',  $status_list,'','id="status_idd"  class="table-group-action-input form-control input-medium"');?></td>
    </tr>
        
    <tr>
    <td width="200">Enter Title</td>
    <td width="139" colspan="2">
       <input name="coe_title" type="text" id="coe_title" class="text_box"></td>
    </tr>
    
	<tr>
    <td width="200">Provider Student Id</td>
    <td width="139" colspan="2">
       <input name="student_id" type="text" id="student_id" class="text_box"></td>
    </tr>
    
	<tr>
    <td width="200">Course Code</td>
    <td width="139" colspan="2">
       <input name="course_code" type="text" id="course_code" class="text_box"></td>
    </tr>
    
	<tr>
    <td width="200">Annual Tution Fee</td>
    <td width="139" colspan="2">
       <input name="annual_tution_fee" type="text" id="annual_tution_fee" class="text_box"></td>
    </tr>

	<tr>
    <td width="200">Duration</td>
    <td width="139" colspan="2">
    <input name="course_duration" type="text" id="course_duration" class="text_box"></td>
    </tr>
       
	<tr>
    <td width="200">Commencement</td>
    <td width="139" colspan="2">
    <input name="course_commencement" type="text" id="course_commencement" class="text_box"></td>
    </tr>

	<tr>
    <td width="200">Orientation date</td>
    <td width="139" colspan="2">
       <input name="orientation_date" type="text" id="orientation_date" class="text_box"></td>
    </tr>

	<tr>
    <td width="200">Start Date</td>
    <td width="139" colspan="2">
       <input name="start_date" type="text" placeholder="YYYY-MM-DD" id="start_date" class="text_box">    </td>
    </tr>
    

	<tr>
    <td width="200">End Date</td>
    <td width="139" colspan="2">
       <input name="end_date" type="text" placeholder="YYYY-MM-DD" id="end_date" class="text_box">    </td>
    </tr>
    
     <tr>
    <td>Enter Details of Closure</td>
    <td colspan="2">
       <textarea name="course_details" cols="" rows="" class="text_area" id="course_details"></textarea>    </td>
    </tr>

    <tr>
    <td colspan="3">
    <span class="click-icons">
      <input type="button" name="coebutton" id="coebutton" class="attach-subs" value="Save" >
      </span>    </td>
    </tr>
    </tbody>
    </table>
    </form>
    </div>
    <div style="clear:both;"></div>
    </div>
	<!--CoE Update-->

 <!-- Visa Approval -->
    <div class="table-tech specs note" id="tab_7">
    <div class="new_notes">
    <p id="success_visa"></p>
    <p id="response_visa"></p>
    <p id="deletemessage_visa"></p>
    
    <form method="post" id="profile_followup" name="profile_followup" action="<?php  echo $this->config->site_url();?>/candidates_all/followup" >
    <input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
      
    <table class="hori-form">
    <tbody>
    
    <tr>
    <td>Select Program</td>
    <td colspan="3"> <?php echo form_dropdown('visa_cand_app_id',  $app_list_coe,'','id="visa_cand_app_id"  class="table-group-action-input form-control input-medium"');?></td>
    </tr>

	<tr>
    <td width="200"> Visa Approved Date</td>
    <td width="139" colspan="2">
       <input name="visa_apprv_date" type="text" id="visa_apprv_date" placeholder="YYYY-MM-DD"  maxlength="10" class="text_box"></td>
    </tr>

	<tr>
    <td width="200">Date to travel</td>
    <td width="139" colspan="2">
       <input name="travel_date" type="text" placeholder="YYYY-MM-DD" id="travel_date" maxlength="10" class="text_box">    </td>
    </tr>

	<tr>
    <td width="200">Join Date</td>
    <td width="139" colspan="2">
       <input name="date_of_join" type="text" placeholder="YYYY-MM-DD" id="date_of_join" maxlength="10" class="text_box">    </td>
    </tr>
    
     <tr>
    <td>SMS - 100 Characters</td>
    <td colspan="2">
       <textarea name="sms_text" cols="" rows="2" class="text_area" id="sms_text"></textarea>    </td>
    </tr>

     <tr>
    <td>Emails</td>
    <td colspan="2">
       <textarea name="email_text" cols="" rows="" class="text_area" id="email_text"></textarea>    </td>
    </tr>        
    
     <tr>
    <td>Other Details</td>
    <td colspan="2">
       <textarea name="comments" cols="" rows="" class="text_area" id="comments"></textarea>    </td>
    </tr>

    <tr>
    <td colspan="3">
    <span class="click-icons">
      <input type="button" name="visabutton" id="visabutton" class="attach-subs" value="Save" >
      </span>    </td>
    </tr>
    </tbody>
    </table>
    </form>
    </div>
    <div style="clear:both;"></div>
    </div>
	<!-- Visa Approval -->
	

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>

<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script type="text/javascript">
		    <!--Followup-->
        $(document).ready(function (){
		function followup_validate() {
		if($('#followup_title').val()=='')
		{
			alert('Enter Your Title');
			$('#followup_title').focus();
			return false;
		}
	     return true;
    }
		
        $('#sub').click(function(){
        var candidate_id=$('#candidate_id').val();
        var title=$('#followup_title').val();
		var status_id=$('#status_idd').val();
		var future_followup=$('#future_followup').val();
		var flp_date_reminder=$('#flp_date_reminder').val();
		var flp_time_reminder=$('#flp_time_reminder').val();
		var assigned_to=$('#assigned_to').val();
		var app_id=$('#app_id').val();
        var desc=$('#followup_desc').val();
		var isCandiadteValid = followup_validate();
		if(isCandiadteValid) {
        $.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/followup'); ?>',
        data:{ 
        candidate_id:candidate_id,
        title: title,
		status_id:status_id,
		future_followup:future_followup,
		flp_date_reminder:flp_date_reminder,
		flp_time_reminder:flp_time_reminder,
		assigned_to:assigned_to,
		app_id:app_id,
        desc: desc,
        },
        success: function(msg) {
		$("#deletemessage").html('');
        $("#response").append(msg);
		$("#result").html('<div class="alert alert-success"><strong>Success!</strong> The page has been added.</div>');
		<!--Text field empty-->
		$('input[type="text"],textarea').val('');
        }
        });//end Ajax
		}//end Validation
        });//end button click 
        });
	
		function validate(id){
		if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+id;
		$.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/drop'); ?>',
        data:{ 
        candidate_follow_id:id,
        },
        success: function(msg) {
		$("#result").html('');
        $(row).fadeOut("slow");
	   $("#deletemessage").html('<div class="alert alert-success"><strong>Success!</strong> The page has been Deleted.</div>');
	   		$('input[type="text"],textarea').val('');
        }
        });//end Ajax
		}
		}
         <!--Followup-->
		 
		 
		 		    <!--Notes-->
			$(document).ready(function (){
		function notes_validate() {
		if($('#note_title').val()=='')
		{
			alert('Enter Note Title');
			$('#note_title').focus();
			return false;
		}
		if($('#note_desc').val()=='')
		{
			alert('Enter Your Notes');
			$('#note_desc').focus();
			return false;
		}   
		
	     return true;
    }
		
        $('#sub1').click(function(){
        var candidate_id=$('#candidate_id').val();
        var title=$('#note_title').val();
        var note=$('#note_desc').val();
		var isCandiadte_noteValid = notes_validate();
		if(isCandiadte_noteValid) {
        $.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/notes'); ?>',
        data:{ 
        candidate_id:candidate_id,
        title: title,
        note: note,
        },
        success: function(msg) {
		$("#deletemessage1").html('');
        $("#response1").append(msg);
		$("#result1").html('<div class="alert alert-success"><strong>Success!</strong> The page has been added.</div>');
		<!--Text field empty-->
		$('input[type="text"],textarea').val('');
        }
        });//end Ajax
		}//end Validation
        });//end button click 
        });
			
		function note_validate(note_id){
		if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+note_id;
		 $.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/drop_notes'); ?>',
        data:{ 
        candidate_note_id:note_id,
        },
        success: function(msg) {
		$("#result1").html('');
		$('input[type="text"],textarea').val('');
        $(row).fadeOut("slow");
		$("#deletemessage1").html('<div class="alert alert-success"><strong>Success!</strong> The page has been Deleted.</div>');
		
        }
        });//end Ajax
		}
		}
			    <!--Notes-->  
			
			
			<!--Interview-->
			$(document).ready(function (){
		function interview_validate() {
		if($('#interview_title').val()=='')
		{
			alert('Enter Your Title');
			$('#interview_title').focus();
			return false;
		}
		if($('#datepicker').val()=='')
		{
			alert('Enter Interview Date');
			$('#datepicker').focus();
			return false;
		}
		
		if($('#interview_time').val()=='')
		{
			alert('Enter Interview Time');
			$('#interview_time').focus();
			return false;
		}
		
		if($('#duration').val()=='')
		{
			alert('Enter Duration Time');
			$('#duration').focus();
			return false;
		}
				if($('#interview').val()=='')
		{
			alert('Enter Your Interviews');
			$('#interview').focus();
			return false;
		}
		
		if($('#interview_type').val()=='0')
		{
			alert('Select Interview Type');
			$('#interview_type').focus();
			return false;
		}
		if($('#interview_status').val()=='0')
		{
			alert('Select Interview Status');
			$('#interview_status').focus();
			return false;
		}
		
	   
		if($('#location').val()=='')
		{
			alert('Enter Interview location');
			$('#location').focus();
			return false;
		}
		
	     return true;
    }
		
        $('#sub2').click(function(){
        var candidate_id=$('#candidate_id').val();
        var title=$('#interview_title').val();
        var interview_date=$('#interview_date').val();
		var interview_time=$('#interview_time').val();
        var duration=$('#duration').val();
        var interview_type=$('#interview_type').val();
		var interview_status=$('#interview_status').val();
		var location=$('#location').val();
        var interview=$('#interview').val();

		var isCandiadte_interviewValid = interview_validate();
		if(isCandiadte_interviewValid) {
        $.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/interview'); ?>',
        data:{ 
        candidate_id:candidate_id,
        title: title,
        interview_date: interview_date,
		interview_time:interview_time,
        duration: duration,
        location: location,
        interview_type:interview_type,
        interview_status: interview_status,
        interview: interview
		},
        success: function(msg) {
		$("#deletemessage2").html('');
        $("#response2").append(msg);
		$("#result2").html('<div class="alert alert-success"> Successfully Added</div>');
		<!--Text field empty-->
		$('input[type="text"],textarea').val('');
        }
        });//end Ajax
		}//end Validation
        });//end button click 
        });
			
		function int_validate(interview_id){
		if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+interview_id;
		$.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/drop_interviews'); ?>',
        data:{ 
        interview_id:interview_id,
        },
			success: function(msg) {
			$("#result2").html('');
			$('input[type="text"],textarea').val('');
			$(row).fadeOut("slow");
			$("#deletemessage2").html('<div class="alert alert-success"><strong>Success!</strong> The page has been Deleted.</div>');
			
			}
        });//end Ajax
		}
		}
			    <!--Interview--> 

	<!-- Start CoE -->
		$(document).ready(function (){
			function CoE_validate() {
			if($('#cand_app_id').val()=='0')
			{
				alert('Please select program');
				$('#app_id').focus();
				return false;
			}
			
			if($('#student_id').val()=='')
			{
				alert('Enter student ID');
				$('#student_id').focus();
				return false;
			}
			
			if($('#start_date').val()=='')
			{
				alert('Enter start date');
				$('#start_date').focus();
				return false;
			}
			
			if($('#end_date').val()=='')
			{
				alert('Enter end date');
				$('#end_date').focus();
				return false;
			}
			
			 return true;
		}
			
			$('#coebutton').click(function(){
			var cand_app_id=$('#cand_app_id').val();
			var candidate_id=$('#candidate_id').val();
			var process_status_id=$('#process_status_id').val();
			var coe_title=$('#coe_title').val();
			var student_id=$('#student_id').val();

			var course_code=$('#course_code').val();
			var annual_tution_fee=$('#annual_tution_fee').val();
			var course_duration=$('#course_duration').val();
			var course_commencement=$('#course_commencement').val();

			var orientation_date=$('#orientation_date').val();
			var start_date=$('#start_date').val();
			var end_date=$('#end_date').val();
			var course_details=$('#course_details').val();
							
			var is_coe_validate = CoE_validate();
			
			if(is_coe_validate) {
			$.ajax({
			type:"POST",
			url: '<?php echo site_url('candidates_all/create_coe'); ?>',
			data:{
				candidate_id:candidate_id,
				cand_app_id: cand_app_id,
				process_status_id: process_status_id,
				coe_title:coe_title,
				student_id: student_id,
				course_code: course_code,
				annual_tution_fee:annual_tution_fee,
				course_duration: course_duration,
				course_commencement: course_commencement,
				orientation_date: orientation_date,
				start_date: start_date,
				end_date: end_date,
				course_details: course_details,				
			},
			success: function(msg) {
			$("#deletemessage2").html('');
			$("#response2").append(msg);
			$("#success").html('<div class="alert alert-success"> Successfully changed</div>');
			<!--Text field empty-->
			$('input[type="text"],textarea').val('');
				window.location='<?php echo site_url('candidates_all/candidate_view'); ?>/<?php echo $candidate_id;?>';
			}
			});//end Ajax
			}//end Validation
			});//end button click 
			});
				

	
	<!-- End CoE here -->				

	<!-- Start VISA Approval -->
	
		$(document).ready(function (){
			function VISA_validate() {
			if($('#visa_cand_app_id').val()=='0')
			{
				alert('Please select program');
				$('#visa_cand_app_id').focus();
				return false;
			}
			
			if($('#visa_apprv_date').val()=='')
			{
				alert('Enter VISA date');
				$('#visa_apprv_date').focus();
				return false;
			}
			
			if($('#date_of_join').val()=='')
			{
				alert('Enter join date');
				$('#date_of_join').focus();
				return false;
			}
			 return true;
		}
			
			$('#visabutton').click(function(){
			var app_id=$('#visa_cand_app_id').val();
			var candidate_id=$('#candidate_id').val();
			var visa_apprv_date=$('#visa_apprv_date').val();
			var travel_date=$('#travel_date').val();
			var date_of_join=$('#date_of_join').val();


			var sms_text=$('#sms_text').val();
			var email_text=$('#email_text').val();
			var comments=$('#comments').val();

			var is_coe_validate = VISA_validate();
			
			if(is_coe_validate) {
			$.ajax({
			type:"POST",
			url: '<?php echo site_url('candidates_all/create_visa'); ?>',
			data:{
				candidate_id:candidate_id,
				app_id: app_id,
				visa_apprv_date: visa_apprv_date,
				travel_date:travel_date,
				date_of_join: date_of_join,
				sms_text: sms_text,
				email_text:email_text,
				comments: comments,
			},
			success: function(msg) {
			$("#deletemessage_visa").html('');
			$("#response_visa").append(msg);
			$("#success_visa").html('<div class="alert alert-success"> Successfully created visa info.</div>');
			<!--Text field empty-->
			$('input[type="text"],textarea').val('');
				window.location='<?php echo site_url('candidates_all/candidate_view'); ?>/<?php echo $candidate_id;?>';
			}
			});//end Ajax
			}//end Validation
			});//end button click 
			});
				

	
	<!-- End VISA here -->				
				
			<!--Programs-->
			$(document).ready(function (){
		function aplication_validate() {
		
		if($('#univ_id').val()=='0' || $('#univ_id').val()=='')
		{
			alert('Select Your University');
			$('#univ_id').focus();
			return false;
		}

		if($('#campus_id').val()=='0' || $('#campus_id').val()=='')
		{
			alert('Select Your Campus');
			$('#campus_id').focus();
			return false;
		}

		if($('#level_study').val()=='0' || $('#level_study').val()=='')
		{
			alert('Select level of study');
			$('#level_study').focus();
			return false;
		}
						
		if($('#course_id').val()=='0' || $('#course_id').val()=='')
		{
			alert('Select Your Course');
			$('#level_study').focus();
			return false;
		}
		
		if($('#status_id').val()=='0')
		{
			alert('Select Your Process Status');
			$('#status_id').focus();
			return false;
		}
		
	     return true;
    }
		
        $('#app').click(function(){
        var candidate_id=$('#candidate_id').val();
        var campus_id=$('#campus_id').val();
        var course_id=$('#course_id').val();
		var intake_id=$('#intake_id').val();
		var status_id=$('#status_id').val();
        var app_details=$('#app_details').val();		

		var isCandiadte_aplicationValid =aplication_validate();
		if(isCandiadte_aplicationValid) {
        $.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/aplication'); ?>',
        data:{ 
			candidate_id:candidate_id,
			campus_id: campus_id,
			course_id: course_id,
			intake_id: intake_id,
			status_id: status_id,
			app_details: app_details,
		},
        success: function(msg) {
			$("#deleteapp").html('');
			$("#responseapp").append(msg);
			$("#resultapp").html('<div class="alert alert-success">Successfully Added</div>');
			<!--Text field empty-->
			$('input[type="text"],textarea').val('');
			window.location='<?php echo site_url('candidates_all/candidate_view'); ?>/<?php echo $candidate_id;?>';
        }
        });//end Ajax
		}//end Validation
        });//end button click 
        });
			
		function app_validate(app_id){
		if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+app_id;
		$.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/drop_aplication'); ?>',
        data:{ 
        app_id:app_id,
        },
        success: function(msg) {
		$("#resultapp").html('');
		$('input[type="text"],textarea').val('');
        $(row).fadeOut("slow");
		$("#deleteapp").html('<div class="alert alert-success"><strong>Success!</strong> The page has been Deleted.</div>');
		window.location='<?php echo site_url('candidates_all/candidate_view'); ?>/<?php echo $candidate_id;?>';
        }
        });//end Ajax
		}
		}
			    <!--Programs--> 
		

			
		function validate(id){
		if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+id;
		 $.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/drop'); ?>',
        data:{ 
        candidate_follow_id:id,
        },
        success: function(msg) {
		$("#result").html('');
		$('input[type="text"],textarea').val('');
        $(row).fadeOut("slow");
		$("#deletemessage").html('<div class="alert alert-success"><strong>Success!</strong> The page has been Deleted.</div>');
		
        }
        });//end Ajax
		}
		}
         <!--Email-->
		 
		 
		  <!--File 1-->  
			$('.imageform1').on('change', function(e)
			{
				e.preventDefault();
				var img_path1 = '<?php echo base_url();?>assets/images/loader.gif';
				$("#loading").html('<img src="'+img_path1+'" alt="Uploading...." width="150" height="100"/>');
					$(this).ajaxSubmit({success:function(data)
					{ 
						 var img_path = '<?php echo base_url();?>uploads/photos/'+data;
						 $("#imgTab2").html('<img src="'+img_path+'" class="profile_img" width="158">');
						 $("#imgfoto").html('<a href="" class="attach-subs subs profile_btn">delete</a>');
						 $("#loading").html('');
					}	
				});
        	});     
		  <!--File 1-->  
			$('.img1_validate').on('click', function(e)
			{
				e.preventDefault();
					$(this).ajaxSubmit({success:function(data)
					{ 
						$("#imgfoto").html('');
						var img_path = '<?php echo base_url();?>uploads/photos/'+data;
						$("#imgTab2").html('<img src="'+img_path+'" class="profile_img" width="158">');
					}	
		
				});
       	 });     
		 <!--File 1--> 
		 


	$('#univ_id').change(function() 
	{
	
		jQuery('#campus_id').html('');
		jQuery('#campus_id').append('<option value="">Select Campus</option');
			
		if($('#univ_id').val()=='')return;
	
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_all/getcampus/',
			  data: { univ_id: $('#univ_id').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#campus_id').html('');
					jQuery('#campus_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#campus_id').html('');
					  $.each(data.campus_list, function (index, value) 
					  {
						  if(index=='')
							 jQuery('#campus_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#campus_id').append('<option value="'+ index +'">' + value + '</option');
					 });
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#campus_id').html('');
					jQuery('#campus_id').append('<option value="">Select City</option');
			  }
			});	
	});

// filter level and courses list 
	$('#level_study').change(function() 
	{
	
		jQuery('#course_id').html('');
		jQuery('#course_id').append('<option value="">Select Course</option');
			
		if($('#level_study').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_all/getcourses/',
			  data: { level_study: $('#level_study').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#course_id').html('');
					jQuery('#course_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#course_id').html('');
					  $.each(data.course_list, function (index, value) 
					  {
						  if(index=='')
							 jQuery('#course_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#course_id').append('<option value="'+ index +'">' + value + '</option');
					 });
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#course_id').html('');
					jQuery('#course_id').append('<option value="">Select Course</option');
			  }
			});	
	});
// level filtering end here 		 
		 </script>
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

<script>

$(document).ready(function()
{
	$('#interview_date').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$('#flp_date_reminder').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
});
</script>