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

<li><a href="<?php echo base_url();?>candidates_all/candidate_coe/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>CoE</a></li>

<li class="active"><a href="<?php echo base_url();?>candidates_all/candidate_visa/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>VISA</a></li>


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



<div class="profile_bottom" id="visa_coe_approval">
<div class="tasks profile">
<div id="responseapp"></div>
<?php foreach($visa_approval_list as $visa){?>
<div class="slider_redesign" id="tr_<?php echo $visa['app_id'];?>">
<div class="side_adj second">

<h2>Visa Apprved Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $visa['visa_apprv_date'];?></h2>
<h2>Travel Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $visa['travel_date'];?></a></h2>
<h2>Joining Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $visa['date_of_join'];?></a></h2>
<div class="date_edit">
<span class="dates"><?php echo $visa['comments'];?></span>

</div>
</div>
</div>
<?php }?>

</div>
</div>





<div class="notes">
<ul>
<li id="li_program">Programs</li>
</ul>
  
  
    
 <!-- Visa Approval -->
    <div class="table-tech specs note" id="visa_tab">
    <div class="new_notes">
    <p id="success_visa"></p>
    <p id="response_visa"></p>
    <p id="deletemessage_visa"></p>
    
    <form method="post" id="profile_followup" name="profile_followup" action="<?php  echo $this->config->site_url();?>candidates_all/create_visa" >
    <input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
      
    <table class="hori-form">
    <tbody>
    
    <tr>
    <td>Select Program</td>
    <td colspan="3"> <?php echo form_dropdown('app_id',  $app_list_coe,'','id="app_id"  class="table-group-action-input form-control input-medium"');?></td>
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
	<!-- Start VISA Approval -->
	
		$(document).ready(function (){
			function VISA_validate() {
			if($('#app_id').val()=='0')
			{
				alert('Please select program');
				$('#app_id').focus();
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
			var app_id=$('#app_id').val();
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
				window.location='<?php echo site_url('candidates_all/candidate_visa'); ?>/<?php echo $candidate_id;?>';
			}
			});//end Ajax
			}//end Validation
			});//end button click 
			});
				

	
	<!-- End VISA here -->				

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