<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Candidates / <span><a href="<?php echo $this->config->site_url();?>candidates_all/candidate_view/<?php echo $candidate_id;?>" >Profile</a></span>&nbsp;&nbsp;&nbsp;  | &nbsp;&nbsp;&nbsp;<span><a href="<?php echo $this->config->site_url();?>candidates_all/">Back to listing</a></span></div>
</div>
<div class="row">
<div class="col-md-3">
<div class="profile_box">

<?php if($detail_list['photo']=='no_photo.png' or $detail_list['photo']==''){?>
<span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/no_photo.png'?>" class="profile_img" style="widtt:158px;"></span>	
<h2><?php echo $detail_list['first_name'];?></h2>
<div style="margin-left: -136px;margin-bottom: -50px;">
<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>candidates_all/img_update' style="margin-top: 19px;">
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
<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>candidates_all/img_update' style="margin-top: 19px;">
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload" id="imgfoto1">
<img src="<?php echo base_url('assets/images/browse.png');?>" >
<input type="file" class="upload"  name="photo" id="photo" />
</div>
</form>
</div>

<div style="margin-left: 78px;margin-top: -50px;">
<form id="img1_validate" class="img1_validate" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>candidates_all/deletefile1' >
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

<li><a href="<?php echo $this->config->site_url();?>candidates_all/summary/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>


<li><a href="<?php echo $this->config->site_url();?>candidates_all/candidate_view/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Follow-up</a></li>

<li><a href="<?php echo $this->config->site_url();?>candidates_all/edit/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Edit Profile</a></li>
<li><a href="<?php echo base_url();?>candidates_all/cvfile/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Profile Info</a></li>

<li><a href="<?php echo base_url();?>candidates_all/edu_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Education</a></li>

<li><a href="<?php echo base_url();?>candidates_all/job_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Job History</a></li>

<li><a href="<?php echo base_url();?>candidates_all/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>


<li><a href="<?php echo base_url();?>candidates_all/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li><a href="<?php echo base_url();?>candidates_all/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>

<li><a href="<?php echo base_url();?>candidates_all/candidate_programs/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Programs</a></li>

<li class="active"><a href="<?php echo base_url();?>candidates_all/candidate_coe/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>CoE</a></li>

<li><a href="<?php echo base_url();?>candidates_all/candidate_visa/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>VISA</a></li>

<li><a href="<?php echo base_url();?>candidates_all/questionnaire/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Questionnaire</a></li>

<li><a href="<?php echo base_url();?>candidates_all/candidate_file/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Manage Files</a></li>

<li><a href="<?php echo base_url();?>candidates_all/email_sms/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Email & SMS</a></li>

<li><a href="<?php echo base_url();?>candidates_all/tickets/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Complaints</a></li>

</ul>


</div>


</div>
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Candidate Programs</div>

<div style="clear:both;"></div>
</div>


<div class="profile_bottom" id="list_coe">
<div class="tasks profile">
<div id="responseapp"></div>
<?php foreach($coe_list as $coe){?>
<div class="slider_redesign" id="tr_<?php echo $coe['app_id'];?>">
<div class="side_adj second">

<h2>Program:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['app_details'];?></h2>
<h2>Student ID:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['student_id'];?></a></h2>
<h2>Course Code:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['course_code'];?></a></h2>
<h2>Total Semester:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['total_semester'];?></a></h2>
<h2>Fee Per Semester:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['fee_per_semester'];?></a></h2>
<h2>Annual Tution Fee:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['annual_tution_fee'];?></a></h2>
<h2>Total Tution Fee:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['total_tution_fee'];?></a></h2>
<h2>Course Duration:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['course_duration'];?></a></h2>
<h2>Course Commencement:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['course_commencement'];?></a></h2>
<h2>Orientation Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['orientation_date'];?></a></h2>
<h2>Start Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['start_date'];?></a></h2>
<h2>End Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['end_date'];?></a></h2>
<h2>Course Details:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['course_details'];?></a></h2>
<h2>Campus Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['campus_name'];?></a></h2>
<h2>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['course_name'];?></a></h2>
<h2>Status Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['status_name'];?></a></h2>
<h2>Intake:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $coe['intake_month'];?></a></h2>

</div>
</div>
<?php }?>

</div>
</div>





<div class="notes">
<ul>
<li id="li_program">Programs</li>
</ul>
  
     <!--Programs-->
    <div class="table-tech specs note" id="manage_coe">
    <div class="new_notes">
    <p id="success"></p>
    <p id="emails"></p>
    
    <form method="post" id="profile_followup" name="profile_followup" action="<?php  echo $this->config->site_url();?>candidates_all/candidate_coe" >
    <input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
      
    <table class="hori-form">
    <tbody>
    
    <tr>
    <td>Select Program</td>
    <td colspan="3"> <?php echo form_dropdown('cand_app_id',  $app_list_coe,'','id="cand_app_id"  class="table-group-action-input form-control input-medium"');?></td>
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
    
    
    
	<!--Programs-->
	

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>

<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script type="text/javascript">
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
			$("#responseapp").append(msg);
			$("#success").html('<div class="alert alert-success"> Successfully changed</div>');
			<!--Text field empty-->
			$('input[type="text"],textarea').val('');
				window.location='<?php echo site_url('candidates_all/candidate_coe'); ?>/<?php echo $candidate_id;?>';
			}
			});//end Ajax
			}//end Validation
			});//end button click 
			});
				
<!-- End CoE here -->				

<!-- --> 
		 
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

<!-- --> 


		 </script>
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">