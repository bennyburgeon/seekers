<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>
<div class="row">
<div class="col-md-3">
<div class="profile_box">

<?php if($detail_list['photo']=='no_photo.png' or $detail_list['photo']==''){?>
<span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/no_photo.png'?>" class="profile_img" style="widtt:158px;"></span>	

<h2><?php echo $detail_list['first_name'];?></h2>

<div style="margin-left: -136px;margin-bottom: -50px;">

<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/contact/img_update' style="margin-top: 19px;">
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload">
<img src="<?php echo base_url('assets/images/browse.png');?>">
<input type="file" class="upload"  name="photo" id="photo" />
</div>
</form>
</div>


<div id="imgfoto" style="margin-top: -22px; margin-left: 76px;"></div>
<?php } else{?>

<span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$detail_list['photo'];?>" class="profile_img" style="width:158px;"></span>
<h2><?php echo $detail_list['first_name'];?></h2>

<div style="margin-top: 20px;margin-left: 30px;"> 

<div style="margin-left: -135px;">
<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/contact/img_update' style="margin-top: 19px;">
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload" id="imgfoto1">
<img src="<?php echo base_url('assets/images/browse.png');?>" >
<input type="file" class="upload"  name="photo" id="photo" />
</div>
</form>
</div>

<div style="margin-left: 78px;margin-top: -50px;">
<form id="img1_validate" class="img1_validate" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/contact/deletefile1' >
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload" id="imgfoto">
<a href="" class="attach-subs subs profile_btn" >delete</a>
</div>
</form>
</div>
</div>	
	
<?php }	?>
<span id="loading"></span>

<ul style="margin-top: 73px;">

<li class="active"><a href="<?php echo $this->config->site_url();?>/contact/summary/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>

<li><a href="<?php echo $this->config->site_url();?>/contact/candidate_view/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Follow-up</a></li>
<li><a href="<?php echo $this->config->site_url();?>/contact/edit/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Edit Profile</a></li>
<li><a href="<?php echo base_url();?>index.php/contact/cvfile/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Profile Info</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/edu_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Education</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/job_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Job History</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>

</ul>


</div>



</div>
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
<div class="profile_top_right">
<br />
<a href="<?php echo base_url();?>index.php/contact/move_to_candidate/<?php echo md5($detail_list['candidate_id']);?>" onClick="if(!confirm('Are you sure ?, want to move this into candidates ?')) return false;">Move to Candidates</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/contact/candidate_delete/<?php echo md5($detail_list['candidate_id']);?>" onClick="if(!confirm('Are you sure ?, want to delete this ?')) return false;">Delete this profile</a>	&nbsp;&nbsp;&nbsp;
</div>
<div style="clear:both;"></div>
</div>


<div style="border:solid;height:auto;">

<table width="100%" border="0" cellspacing="3" cellpadding="3">

  <tr>
    <td colspan="2" align="left" valign="top"><br />
<?php echo $msg;?><br /></td>
    </tr>
  <tr>
    <td align="left" valign="top" width="50%">
    <div class="profile_box2">
    
    <table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td  bgcolor="#CCCCCC"><h4>About:</h4></td>
    <td  bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>Name : </td>
    <td bgcolor="#CCCCCC"><?php echo $detail_list['first_name'];?></td>
  </tr>
  <tr>
    <td>Mobile : </td>
    <td bgcolor="#CCCCCC"><?php echo $detail_list['mobile'];?></td>
  </tr>
  <tr>
    <td>Address : </td>
    <td bgcolor="#CCCCCC"><?php echo $detail_list['address'];?></td>
  </tr>
  <tr>
    <td>Username : </td>
    <td bgcolor="#CCCCCC"><?php echo $detail_list['username'];?></td>
  </tr>
  <tr>
    <td>Email :</td>
    <td bgcolor="#CCCCCC"><?php echo $detail_list['username'];?></td>
  </tr>
  <tr>
    <td>Age : </td>
    <td bgcolor="#CCCCCC"><?php echo $detail_list['age'];?></td>
  </tr>
  <tr>
    <td>Gender :</td>
    <td bgcolor="#CCCCCC"><?php if($detail_list['gender']==1) echo 'Male'; if($detail_list['gender']==0)echo 'Female';?></td>
  </tr>
  <tr>
    <td>Registered On : </td>
    <td bgcolor="#CCCCCC"><?php echo $detail_list['reg_date'];?></td>
  </tr>
  <tr>
    <td>DoB :</td>
    <td bgcolor="#CCCCCC"> <?php echo $detail_list['date_of_birth'];?></td>
  </tr>
  <tr>
    <td>Interested Program: </td>
    <td bgcolor="#CCCCCC"><?php echo $detail_list['course_name'];?></td>
  </tr>
  <tr>
    <td>Marital Status:</td>
    <td bgcolor="#CCCCCC"><?php if($detail_list['marital_status']==1) echo 'Married'; if($detail_list['marital_status']==2)echo 'Engaged';if($detail_list['marital_status']==3)echo 'Separated';if($detail_list['marital_status']==4)echo 'Divorced';if($detail_list['marital_status']==5)echo 'Widowed';if($detail_list['marital_status']==6)echo 'Never Married';?><br />
Number of Children: <?php echo $detail_list['children'];?></td>
  </tr>
  <tr>
    <td>Lead Source: </td>
    <td bgcolor="#CCCCCC"> <?php echo $detail_list['lead_source'];?></td>
  </tr>
  <tr>
    <td colspan="2"><br />
<br />
<?php if($detail_list['cv_file']!=''){?><a href="<?php echo base_url().'uploads/cvs/'.$detail_list['cv_file'];?>" target="_blank" style="color:#0033FF">Download CV</a> &nbsp;||&nbsp;<a href="<?php echo site_url().'/contact/delete_cv/'.$candidate_id.'/';?>" style="color:#0033FF">Delete CV</a> <?php } ?> </td>
  </tr>
  
  <tr><td colspan="2">
  
   <?php if($detail_list['photo']!=''){?><span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$detail_list['photo'];?>" class="profile_img" style="width:158px;height:100px;"><br /><br /><a href="<?php echo site_url().'/contact/delete_photo/'.$candidate_id.'/';?>" style="color:#0033FF">Delete Photo</a>&nbsp;&nbsp;</span> <?php } ?> 
  
  </td></tr>
</table>
</div></td>
    <td align="left" valign="top"><div class="profile_box2"><h4>Passport Details:</h4>

Passport No : <?php echo $detail_list['passportno'];?><br />
Issued Date : <?php echo $detail_list['issued_date'];?><br />
Expiry Date : <?php echo $detail_list['expiry_date'];?><br />
Place of Issue : <?php echo $detail_list['place_of_issue'];?><br />

<h4>Language Skill:</h4>
<?php if($detail_list['eng_pte']!=''){?>

PTE : <?php echo $detail_list['eng_pte'];?>, R = <?php echo $detail_list['eng_pte_reading'];?>, W = <?php echo $detail_list['eng_pte_writing'];?>, L = <?php echo $detail_list['eng_pte_listening'];?>, S = <?php echo $detail_list['eng_pte_speaking'];?><br />

<?php } ?>

<?php if($detail_list['eng_ielts']!=''){?>

IELTS : <?php echo $detail_list['eng_ielts'];?>, R = <?php echo $detail_list['eng_ielts_reading'];?>, W = <?php echo $detail_list['eng_ielts_writing'];?>, L = <?php echo $detail_list['eng_ielts_listening'];?>, S = <?php echo $detail_list['eng_ielts_speaking'];?><br />

<?php } ?>

<?php if($detail_list['eng_tofel']!=''){?>

TOFEL : <?php echo $detail_list['eng_tofel'];?>, R = <?php echo $detail_list['eng_tofel_reading'];?>, W = <?php echo $detail_list['eng_tofel_writing'];?>, L = <?php echo $detail_list['eng_tofel_listening'];?>, S = <?php echo $detail_list['eng_tofel_speaking'];?><br />

<?php } ?>

<?php if($detail_list['eng_gre']!=''){?>
	GRE : <?php echo $detail_list['eng_gre'];?><br />
<?php } ?>

<?php if($detail_list['eng_sat']!=''){?>
	GMAT : <?php echo $detail_list['eng_sat'];?><br />
<?php } ?>

<?php if($detail_list['eng_sat']!=''){?>
	SAT : <?php echo $detail_list['eng_sat'];?><br />
<?php } ?>

<?php if($detail_list['eng_10th']!=''){?>
	Eng. 10th : <?php echo $detail_list['eng_10th'];?><br />
<?php }else{ ?>
	Eng. 10th : Not Updated.<br />

<?php } ?>

<?php if($detail_list['eng_12th']!=''){?>
	Eng. 12th : <?php echo $detail_list['eng_12th'];?><br />
<?php }else{ ?>

Eng. 12th : Not Updated.<br />
<?php } ?>
<br />
<br />
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td><table width="90%" border="0" cellspacing="1" cellpadding="1">
 <tr><td  bgcolor="#CCCCCC"><strong>Skills</strong></td></tr>
  <?php foreach($candidate_skills as $key => $val){?>
     <tr><td><?php echo $val['skill_name'];?></td></tr>
   <?php } ?>
    
  
</table></td>
    <td align="left" valign="top"><table width="90%" border="0" cellspacing="1" cellpadding="1">
      <tr>
        <td  bgcolor="#CCCCCC"><strong>Certifications</strong></td>
      </tr>
      <?php foreach($candidate_certifications as $key => $val){?>
      <tr>
        <td><?php echo $val['cert_name'];?></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
</table>

</div></td>
  </tr>
      
  <tr>
    <td colspan="2" align="left" valign="top">
<form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/contact/upload_cv_photo/<?php echo $detail_list['candidate_id'];?>" enctype="multipart/form-data"> 
<input type="hidden" name="candidate_id" value="<?php echo $detail_list['first_name'];?>" />
<table class="hori-form">
<tbody>



<tr>
<td>Upload your CV</td>
 <td> 
 <?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?> </td>
</tr>
<tr>
<td>Upload your Photo</td>
 <td> 
 <?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?> </td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Upload" id="save_candidate2"  style="width:180px;">
</span></td>
</tr>
</tbody>
</table>
<input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
<div id="success"></div>
</form></td>
        </tr>

<?php if(count($education_details)>0){?>     

      <tr>
    <td colspan="2" align="center" valign="top"><br />
      Education    </td></tr>
  <tr>
    <td colspan="2" align="left" valign="top"> 
    
    <table width="100%" border="1" cellspacing="3" cellpadding="3">
  <tr>
    <td bgcolor="#CCCCCC">Level of study</td>
    <td bgcolor="#CCCCCC">Course</td>
    <td bgcolor="#CCCCCC">Arrears</td>
    <td bgcolor="#CCCCCC">Absense</td>
    <td bgcolor="#CCCCCC">Repeat</td>
    <td bgcolor="#CCCCCC">Year Back</td>
    <td bgcolor="#CCCCCC">Percenage</td>
  </tr>
  <?php foreach($education_details as $key => $val){?>
  <tr>
    <td><?php echo $val['level_name'];?></td>
    <td><?php echo $val['course_name'];?></td>
    <td><?php echo $val['arrears'];?></td>
    <td><?php echo $val['absesnse'];?></td>
    <td><?php echo $val['repeat'];?></td>
    <td><?php echo $val['year_back'];?></td>
    <td><?php echo $val['mark_percentage'];?></td>
  </tr>
  <?php } ?>
</table> </td>
    </tr>
<?php } ?>

<?php if(count($job_history)>0){?>
    
    <tr>
    <td colspan="2" align="center" valign="top"><br />
      Professional Summary    </td></tr>
  <tr>
    <td colspan="2" align="left" valign="top">
    <table width="100%" border="1" cellspacing="3" cellpadding="3">
  <tr>
    <td bgcolor="#CCCCCC">Organization</td>
    <td bgcolor="#CCCCCC">Designation</td>
    <td bgcolor="#CCCCCC">Resp.</td>
    <td bgcolor="#CCCCCC">From</td>
    <td bgcolor="#CCCCCC">To</td>
    <td bgcolor="#CCCCCC">Salary</td>
    <td bgcolor="#CCCCCC">Job Category</td>
    <td bgcolor="#CCCCCC">Fun. Area</td>
  </tr>
  <?php foreach($job_history as $key => $val){?>
  <tr>
    <td><?php echo $val['organization'];?></td>
    <td><?php echo $val['designation'];?></td>
    <td><?php echo $val['responsibility'];?></td>
    <td><?php echo $val['from_date'];?></td>
    <td><?php echo $val['to_date'];?></td>
    <td><?php echo $val['monthly_salary'];?></td>
    <td><?php echo $val['job_cat_name'];?></td>
    <td><?php echo $val['func_area'];?></td>
  </tr>
  <?php } ?>
</table>  </td>
    </tr>

<?php } ?>

<?php if(count($candidate_questionnaire_summary)>0){?>
    
<tr>
    <td colspan="2" align="center" valign="top"><br />
      Questionnaire    </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    <table width="80%" border="1" cellspacing="3" cellpadding="3">
  <tr>
    <td colspan="7" bgcolor="#CCCCCC">Question</td>
    <td bgcolor="#CCCCCC">Answer</td>
  </tr>
  <?php foreach($candidate_questionnaire_summary as $key => $val){?>
  <tr>
    <td colspan="7"><?php echo $val['question_title'];?></td>
    <td><?php echo $val['answer_value'];?></td>
  </tr>
  <?php } ?>
</table>  </td>
    </tr>

<?php } ?>    

<?php if(count($candidate_programs_suggestion_summary)>0){?>
    
<tr>
    <td colspan="2" align="center" valign="top"><br />
     Suggested Programs   </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    <table width="80%" border="1" cellspacing="3" cellpadding="3">
  <?php foreach($candidate_programs_suggestion_summary as $key => $val){
  
  if(isset($val['programs'])){
  
  ?>
  <tr>
    <td colspan="8" bgcolor="#CCCCCC">Qualification: <?php echo $val['qualification'];?><br />
</td>
  </tr>
   <?php foreach($val['programs'] as $programs => $program){?>
  <tr>
    <td colspan="8">&nbsp;&nbsp;&nbsp;Program: <?php echo $program['course_name'];?>
<br />
<?php foreach($program['campus_list'] as $campus_id => $campus){?>&nbsp;&nbsp;&nbsp;<?php echo $campus;?><br /><?php } ?>
    </td>
  </tr>   

  <?php } ?>
 
  <?php } ?>
  
  <?php } ?>
</table>  </td>
    </tr>

<?php } ?>


<?php if(count($candidate_files_summary)>0){?>

<tr>
    <td colspan="2" align="center" valign="top"><br />
      Updated Files    </td></tr>    

<tr>
    <td colspan="2" align="left" valign="top">
    <table width="90%" border="1" cellspacing="3" cellpadding="3">
  <tr>
    <td colspan="8" bgcolor="#CCCCCC">File Name</td>
  </tr>
  <?php foreach($candidate_files_summary as $key => $val){?>
  <tr>
    <td colspan="8"><?php echo $val['file_name'];?></td>
  </tr>
  <?php } ?>
</table>  </td>
    </tr>

<?php } ?>


<?php if(count($candidate_complaints_summary)>0){?>

<tr>
    <td colspan="2" align="center" valign="top"><br />
      Queries    </td></tr>    

<tr>
    <td colspan="2" align="left" valign="top">
    <table width="100%" border="1" cellspacing="3" cellpadding="3">
  <tr>
    <td colspan="5" bgcolor="#CCCCCC">Title</td>
    <td bgcolor="#CCCCCC">Date</td>
    <td bgcolor="#CCCCCC">Status</td>
  </tr>
  <?php foreach($candidate_complaints_summary as $key => $val){?>
  <tr>
    <td colspan="5"><?php echo $val['task_title'];?></td>
    <td><?php echo $val['start_date'];?></td>
    <td><?php echo $val['status'];?></td>
  </tr>
  <?php } ?>
</table>  </td>
    </tr>

<?php } ?>
                    

  <tr>
    <td align="center" valign="top"><br>
<br>
<form class="form-horizontal form-bordered"  method="post" id="summary" name="summary" action="<?php echo $this->config->site_url();?>/contact/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate();"> 
<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
<?php if(count($all_counselor)>0){?>
<table width="90%" border="1" cellspacing="1" cellpadding="1">

<tr>
    <td colspan="2">All Counselors</td>    
  </tr>

<?php foreach($all_counselor as $key => $val){?>

  <tr>
    <td><input type="checkbox" name="admin_id[]" value="<?php echo $val['admin_id'];?>" id=""></td>
    <td><?php echo $val['firstname'];?></td>
  </tr>
 
  
  <?php } ?>
   <tr>
    <td colspan="2"><input type="submit" name="action" value="Add"> 
    [Select and click on add to add more counselors]</td>
    </tr>
</table>
<?php } ?>
</form>
<br>
<br></td>
    <td align="left" valign="top"><br>
      <br>
<form class="form-horizontal form-bordered"  method="post" id="summary1" name="summary1" action="<?php echo $this->config->site_url();?>/contact/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate1();"> 
<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
<table width="90%" border="1" cellspacing="1" cellpadding="1">

<tr>
    <td colspan="2">List of counselors managing this candidate.</td>    
  </tr>

<?php foreach($candidate_counselor as $key => $val){?>

  <tr>
    <td><input type="checkbox" name="admin_id[]" value="<?php echo $val['admin_id'];?>" id=""></td>
    <td><?php echo $val['firstname'];?></td>
  </tr>
  
  <?php } ?>
   <tr>
    <td colspan="2"><input type="submit" name="action" value="Remove"> 
    [Select and cliclk remove existing counselors]</td>
    </tr>
</table>
</form>
<br>
<br></td>
  </tr>
</table>

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>

<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<script language="javascript">
function summary_validate() 
{
	return true;
}

function summary_validate1() 
{
	return true;
}

$(document).ready(function()
{
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
});
</script>