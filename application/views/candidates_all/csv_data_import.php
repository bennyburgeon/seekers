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
<li class="active"><a href="<?php echo base_url();?>index.php/candidates_all/cvfile/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Profile Info</a></li>

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
<div class="profile_box2">
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

<h4>Passport Details:</h4>

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
Eng. 12th : <?php echo $detail_list['eng_12th'];?><br />

</div>


</div>
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">View CV</div>
<div class="profile_top_right">
<ul>
<li id="leads_btn">Cv File</li>
</ul>
</div>
<div style="clear:both;"></div>
</div>



<div class="notes">
    <div class="table-tech specs note">
    <div class="new_notes">
    <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
    -->
    <p id="result"></p>
    <p id="deletemessage"></p>

    <?php echo $error;?>

    <form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/csv_data_import/<?php echo $candidate_id;?>'  onsubmit="return check_title();">
    <table class="hori-form">
    <tbody>
    <tr>
    <td>Upload Title:</td>
    <td>
    <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>"/>
         <textarea name="title" id="title" class="text_area"></textarea>
    </td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit"  class="attach-subs" value="Upload" id="upload_but"/>

    </span>
    </td>
    </tr>
    </tbody>
    </table>
    </form>
    </div>
    
   
    <div style="clear:both;"></div>
    </div>

	<!--Followup-->



<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>

<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script type="text/javascript">

function check_title() 
{
	if($('#title').val()=='')
	{
		alert('Please add a name for the file.');
		$('#title').focus();
		return false;
	}
	 return true;
}

function validate(file_id)
{
		if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+file_id;
		$.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/deletefile'); ?>',
        data:{ 
        file_id:file_id,
        },
        success: function(msg) {
		$("#result").html('');
        $(row).fadeOut("slow");
	   $("#deletemessage").html('<div class="alert alert-danger"><strong>Success!</strong> The data has been Deleted.</div>');

        }
        });//end Ajax
		}
		}
         <!--Followup-->
		 
		 
		 		   
		 
		 </script>
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
