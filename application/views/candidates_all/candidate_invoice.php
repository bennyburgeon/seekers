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

<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/img_update' style="margin-top: 19px;">
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

<ul style="margin-top: 73px;">

<li><a href="<?php echo $this->config->site_url();?>/candidates_all/summary/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>

<li><a href="<?php echo $this->config->site_url();?>/candidates_all/candidate_view/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Follow-up</a></li>
<li><a href="<?php echo $this->config->site_url();?>/candidates_all/edit/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Edit Profile</a></li>
<li><a href="<?php echo base_url();?>index.php/candidates_all/cvfile/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Profile Info</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/edu_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Education</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/job_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Job History</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/candidate_programs/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Programs</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/candidate_coe/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>CoE</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/candidate_visa/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>VISA</a></li>


<li><a href="<?php echo base_url();?>index.php/candidates_all/questionnaire/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Questionnaire</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/candidate_file/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Manage Files</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/email_sms/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Email & SMS</a></li>


<li><a href="<?php echo base_url();?>index.php/candidates_all/tickets/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Complaints</a></li>
</ul>


</div>



</div>
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
<div class="profile_top_right">

</div>
<div style="clear:both;"></div>
</div>


<div style="border:solid;height:auto;">

<table width="100%" border="0" cellspacing="3" cellpadding="3">
  <tr>
    <td align="left" valign="top" width="50%"><div class="profile_box2">
<h4>About:</h4>
Name : <?php echo $detail_list['first_name'];?><br />
Mobile : <?php echo $detail_list['mobile'];?><br />
Address : <?php echo $detail_list['address'];?><br />
Username : <?php echo $detail_list['username'];?><br />
Email : <?php echo $detail_list['username'];?><br />
Age : <?php echo $detail_list['age'];?><br />
Gender : <?php if($detail_list['gender']==1) echo 'Male'; if($detail_list['gender']==2)echo $detail_list['gender'];?><br />
Registered On : <?php echo $detail_list['reg_date'];?><br />
DoB : <?php echo $detail_list['date_of_birth'];?><br />
Interested Program: <?php echo $detail_list['course_name'];?><br />
Marital Status: <?php if($detail_list['marital_status']==1) echo 'Single'; if($detail_list['marital_status']==2)echo $detail_list['Married'];?><br />
Number of Children: <?php echo $detail_list['children'];?><br />
Lead Source:  <?php echo $detail_list['lead_source'];?><br />



</div></td>
    <td align="left" valign="top"><div class="profile_box2"><h4>Passport Details:</h4>

Passport No : <?php echo $detail_list['passportno'];?><br />
Issued Date : <?php echo $detail_list['issued_date'];?><br />
Expiry Date : <?php echo $detail_list['expiry_date'];?><br />
Place of Issue : <?php echo $detail_list['place_of_issue'];?><br />

<h4>Language Skill:</h4>

PTE : <?php echo $detail_list['eng_pte'];?>, R = <?php echo $detail_list['eng_pte_reading'];?>, W = <?php echo $detail_list['eng_pte_writing'];?>, L = <?php echo $detail_list['eng_pte_listening'];?>, S = <?php echo $detail_list['eng_pte_speaking'];?><br />
IELTS : <?php echo $detail_list['eng_ielts'];?>, R = <?php echo $detail_list['eng_ielts_reading'];?>, W = <?php echo $detail_list['eng_ielts_writing'];?>, L = <?php echo $detail_list['eng_ielts_listening'];?>, S = <?php echo $detail_list['eng_ielts_speaking'];?><br />
TOFEL : <?php echo $detail_list['eng_tofel'];?>, R = <?php echo $detail_list['eng_tofel_reading'];?>, W = <?php echo $detail_list['eng_tofel_writing'];?>, L = <?php echo $detail_list['eng_tofel_listening'];?>, S = <?php echo $detail_list['eng_tofel_speaking'];?><br />

GRE : <?php echo $detail_list['eng_gre'];?><br />
GMAT : <?php echo $detail_list['eng_sat'];?><br />
SAT : <?php echo $detail_list['eng_sat'];?><br />
Eng. 10th : <?php echo $detail_list['eng_10th'];?><br />
Eng. 12th : <?php echo $detail_list['eng_12th'];?><br /></div></td>
  </tr>
      <tr>
    <td colspan="2" align="center" valign="top">Education    </td></tr>
  <tr>
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
    <tr>
    <td colspan="2" align="center" valign="top">Professional Summary    </td></tr>
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
    
    <!-- 
  <tr>
    <td align="left" valign="top">Profile Completion Report<br>
      Profile - Name, Email, Phone, DoB, Address , Location, Preferred Program, age<br>
      English - All English Variable<br>
      Education - min educations and its arears, back year etc<br>
      Job - Job with salary, years, industry, match with education<br>
      Skills - Create Skill for each profile<br>
      Check Linked in for more categories</td>
    <td align="left" valign="top">Devide candidate profile into 5 or 6 sections and measure the number of elements filled and its range of values, create graphs or data based on it. take 10 fields from each section and evaluate it. <br>
      <br></td>
  </tr>  
  -->
  <!-- 
  
  <tr>
    <td align="left" valign="top">Candidate Eligibility Report<br>
      Each program will have a criteria, take that and connect with candidate profile and match each of them.</td>
    <td align="left" valign="top">Check Candidate profile with matching courses, match with university or course requirements and find whether the candidate is eligible for any programs.</td>
  </tr>
  
  -->
  <tr>
    <td align="center" valign="middle"><br>
<br>
<form class="form-horizontal form-bordered"  method="post" id="summary" name="summary" action="<?php echo $this->config->site_url();?>/candidates_all/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate();"> 
<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
<table width="90%" border="1" cellspacing="1" cellpadding="1">

<tr>
    <td colspan="2">All Counselors</td>    
  </tr>

<?php foreach($all_counselor as $key => $val){?>

  <tr>
    <td><input type="checkbox" name="candidate_id[]" value="<?php echo $val['candidate_id'];?>" id=""></td>
    <td><?php echo $val['first_name'];?></td>
  </tr>
 
  
  <?php } ?>
   <tr>
    <td colspan="2"><input type="submit" name="action" value="Add"> 
    [Select and click on add to add more counselors]</td>
    </tr>
</table>
</form>
<br>
<br>


</td>
    <td align="left" valign="top"><br>
      <br>
<form class="form-horizontal form-bordered"  method="post" id="summary1" name="summary1" action="<?php echo $this->config->site_url();?>/candidates_all/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate1();"> 
<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
<table width="90%" border="1" cellspacing="1" cellpadding="1">

<tr>
    <td colspan="2">List of counselors managing this candidate.</td>    
  </tr>

<?php foreach($candidate_counselor as $key => $val){?>

  <tr>
    <td><input type="checkbox" name="candidate_id[]" value="<?php echo $val['candidate_id'];?>" id=""></td>
    <td><?php echo $val['first_name'];?></td>
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
</script>