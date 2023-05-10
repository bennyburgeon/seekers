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

<li><a href="<?php echo $this->config->site_url();?>/contact/summary/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>

<li><a href="<?php echo $this->config->site_url();?>/contact/candidate_view/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Follow-up</a></li>
<li><a href="<?php echo $this->config->site_url();?>/contact/edit/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Edit Profile</a></li>
<li><a href="<?php echo base_url();?>index.php/contact/cvfile/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Profile Info</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/edu_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Education</a></li>

<li class="active"><a href="<?php echo base_url();?>index.php/contact/job_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Job History</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>


</ul>



</div>


</div>
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Job History</div>

<div style="clear:both;"></div>
</div>



<div class="profile_bottom" id="leads">
<div class="tasks profile">

<div id="response"></div>
<?php 
 foreach($cv_fileist as $cv_fileist1){?>
<div class="slider_redesign" id="tr_<?php echo $cv_fileist1['job_profile_id'];?>" >

<div class="side_adj second">

<h2>Company: <?php echo $cv_fileist1['organization'];?></h2>
<p>Designation: <?php echo $cv_fileist1['designation'];?></p>
<p>Industry: <?php echo $cv_fileist1['job_cat_name'];?></p>
<p>Function/Role: <?php echo $cv_fileist1['func_area'];?></p>
<p>Salary/Month: <?php echo $cv_fileist1['monthly_salary'];?></p>
<div class="date_edit">
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $cv_fileist1['job_profile_id'];?>" onClick="return validate(this.id)" >
</span>

</div>
</div>
</div>
<?php }?>


</div>
</div>

<div class="notes">
<ul>
<li id="tab_2btn">Add Job</li>


</ul>

   
	<!--Followup-->

    <div class="table-tech specs note">
    <div class="new_notes">
    <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
    -->
    <p id="result"></p>
    <p id="deletemessage"></p>

    <?php echo $error;?>

<form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/contact/job_history/<?php echo $candidate_id;?>" onSubmit="return candidate_validate();" > 
<table class="hori-form">
<tbody>

<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
<tr>
<td>Organization Name</td>
<td><input class="form-control hori" type="text" name="organization" value="<?php echo $formdata['organization'];?>" id="organization"></td>
</tr>
<tr>
<td>Designation</td>
<td><input class="form-control hori " type="text" name="designation" value="<?php echo $formdata['designation'];?>" id="designation">
</td>
</tr>

<tr>
<td>Industry</td>
 <td> <?php echo form_dropdown('job_cat_id',  $industry_list, $formdata['job_cat_id'],'class="form-control" id="job_cat_id"');?> </td>
</tr>

<tr>
<td>Function/Role</td>
 <td> <?php echo form_dropdown('func_id',  $functional_list, $formdata['func_id'],'class="form-control" id="func_id"');?> </td>
</tr>


<tr>
<td>Responsibilities</td>
<td>
<input class="form-control hori " type="text" name="responsibility" value="<?php echo $formdata['responsibility'];?>" id="responsibility">
</td>
</tr>
<td>From Date</td>
<td><input type="text" name="from_date" id="datepickfrom" value="<?php echo $formdata['from_date'];?>" placeholder="Enter From Date Date YYYY-MM-DD"></td>
</tr>
</tr>
<td>To Date</td>
<td><input type="text" name="to_date" id="datepickto" value="<?php echo $formdata['to_date'];?>" placeholder="Enter To Date Date YYYY-MM-DD"></td>
</tr>
<tr>
<td>Current Salary</td>
<td>
<input class="form-control hori " type="text" name="monthly_salary" value="<?php echo $formdata['monthly_salary'];?>"  id="monthly_salary">
<input type="hidden" name="currency_id" value="" />
</td>
</tr>


<tr>
<td>Is this your present job ?</td>
 <td> 
      <label class="radio-inline">
      <input type="radio" name="present_job" id="present_job" value="1" <?php if($formdata['present_job']==1){?> checked <?php } ?> >Yes</label>
    <label class="radio-inline">
<input type="radio" name="present_job" id="present_job" value="0" <?php if($formdata['present_job']==0){?> checked <?php } ?> >No</label>
                
 </td>
</tr>


<tr>
<td>Total Experience</td>
 <td> <?php echo form_dropdown('exp_years',  $years_list, $formdata['exp_years'],'class="form-control" id="exp_years"');?>&nbsp; <?php echo form_dropdown('exp_months',  $months_list, $formdata['exp_months'],'class="form-control" id="exp_months"');?>
  </td>	
</tr>
<tr>

<tr>
<td>Skills</td>
<td>
<input class="form-control hori " type="text" name="skills" id="skills" value="<?php echo $formdata['skills'];?>" placeholder="Enter your Skills ">
</td>
</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Save" id="save_candidate4" style="width:180px;">
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script type="text/javascript">

		function validate(job_profile_id){

			var row = "#tr_" + job_profile_id;
		
		if(confirm('Are you sure you want to delete?')){
	
		$.ajax({
			type:"POST",
			url: '<?php echo site_url('contact/drop_job_item'); ?>',
			data:{ 
			job_profile_id:job_profile_id,
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
$( document ).ready(function() {		 

	$('#datepickfrom').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});

	$('#datepickto').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});


function candidate_validate() {
		if($('#organization').val()=='')
		{
			alert('Enter Organization');
			$('#organization').focus();
			return false;
		}   
		/*
		if($('#designation').val()=='')
		{
			alert('Enter Designation');
			$('#designation').focus();
			return false;
		}
		if($('#datepickfrom').val()=='')
		{
			alert('Add from date');
			$('#datepickfrom').focus();
			return false;
		}   
		if($('#datepickto').val()=='')
		{
			alert('Add to date');
			$('#datepickto').focus();
			return false;
		}
		if($('#monthly_salary').val()=='')
		{
			alert('Add monthly salary');
			$('#monthly_salary').focus();
			return false;
		}   
		if($('#exp_years').val()=='')
		{
			alert('Add total experience');
			$('#edu_country').focus();
			return false;
		}
		if($('#skills').val()=='')
		{
			alert('Add your skills');
			$('#course_type_id').focus();
			return false;
		}
		*/
	    return true;
    }		 

		 		   
});		 


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
		 
