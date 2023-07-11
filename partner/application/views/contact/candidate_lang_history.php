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

<li><a href="<?php echo base_url();?>index.php/contact/job_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Job History</a></li>

<li class="active"><a href="<?php echo base_url();?>index.php/contact/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>
</ul>


</div>




</div>
<div class="col-md-9">

<div class="notes">
<ul>
<li id="tab_2btn">Language Skill</li>


</ul>

   
	<!--Followup-->

    <div class="table-tech specs note">
    <div class="new_notes">
    <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
    -->
    <p id="result"></p>
    <p id="deletemessage"></p>

    <?php echo $error;?>

<form class="form-horizontal form-bordered"  method="post" id="candidate_validate" name="candidate_validate" action="<?php echo $this->config->site_url();?>/contact/lang_history/<?php echo $candidate_id;?>" onSubmit="return candidate_validate();" >

<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>" />

<table class="hori-form">
<tbody>



<tr>
<td>Passport Number</td>
<td>
<input class="form-control hori" type="text" name="passportno" value="<?php echo $formdata['passportno'];?>" id="passportno"></td>
</tr>

<tr>
<td>Place of issue</td>
<td><input class="form-controlhori" type="text" name="place_of_issue" value="<?php echo $formdata['place_of_issue'];?>" id="place_of_issue"></td>
</tr>


<tr>
  <td>Issue Date</td>
    <td><input class="form-controlhori" type="text" name="issued_date" value="<?php echo $formdata['issued_date'];?>" id="issued_date"></td>
</tr>

<tr>
  <td>Exp. date</td>
    <td><input class="form-controlhori " type="text" name="expiry_date" value="<?php echo $formdata['expiry_date'];?>" id="expiry_date"></td>
</tr>

<tr>
  <td>Nationality</td>
    <td><?php echo form_dropdown('passport_nationality',  $country_list, $formdata['passport_nationality'],'class="form-control" id="passport_nationality"');?></td>
</tr>

<tr>
  <td>Eng PTE</td>
    <td>
    
    <input style="width:100px;" placeholder="Total"  type="text"  name="eng_pte" value="<?php echo $formdata['eng_pte'];?>" id="eng_pte"> | 
    <input style="width:100px;" placeholder="Reading"  type="text"  name="eng_pte_reading" value="<?php echo $formdata['eng_pte_reading'];?>" id="eng_pte_reading"> | 
    <input style="width:100px;" placeholder="Listening"  type="text"  name="eng_pte_listening" value="<?php echo $formdata['eng_pte_listening'];?>" id="eng_pte_listening">|
    <input style="width:100px;" placeholder="Writing"  type="text"  name="eng_pte_writing" value="<?php echo $formdata['eng_pte_writing'];?>" id="eng_pte_writing">|
    <input style="width:100px;" placeholder="Speaking"  type="text"  name="eng_pte_speaking" value="<?php echo $formdata['eng_pte_speaking'];?>" id="eng_pte_speaking">
    
    
    </td>
</tr>

<tr>
  <td>IELTS</td>
    <td>
    
        <input style="width:100px;" placeholder="Total"  type="text"  name="eng_ielts" value="<?php echo $formdata['eng_ielts'];?>" id="eng_ielts"> | 
    <input style="width:100px;" placeholder="Reading"  type="text"  name="eng_ielts_reading" value="<?php echo $formdata['eng_ielts_reading'];?>" id="eng_ielts_reading"> | 
    <input style="width:100px;" placeholder="Listening"  type="text"  name="eng_ielts_listening" value="<?php echo $formdata['eng_ielts_listening'];?>" id="eng_ielts_listening">|
    <input style="width:100px;" placeholder="Writing"  type="text"  name="eng_ielts_writing" value="<?php echo $formdata['eng_ielts_writing'];?>" id="eng_ielts_writing">|
    <input style="width:100px;" placeholder="Speaking"  type="text"  name="eng_ielts_speaking" value="<?php echo $formdata['eng_ielts_speaking'];?>" id="eng_ielts_speaking">

    </td>
</tr>

<tr>
  <td>TOFEL</td>
    <td>    <input style="width:100px;" placeholder="Total"  type="text"  name="eng_tofel" value="<?php echo $formdata['eng_tofel'];?>" id="eng_tofel"> | 
    <input style="width:100px;" placeholder="Reading"  type="text"  name="eng_tofel_reading" value="<?php echo $formdata['eng_tofel_reading'];?>" id="eng_tofel_reading"> | 
    <input style="width:100px;" placeholder="Listening"  type="text"  name="eng_tofel_listening" value="<?php echo $formdata['eng_tofel_listening'];?>" id="eng_tofel_listening">|
    <input style="width:100px;" placeholder="Writing"  type="text"  name="eng_tofel_writing" value="<?php echo $formdata['eng_tofel_writing'];?>" id="eng_tofel_writing">|
    <input style="width:100px;" placeholder="Speaking"  type="text"  name="eng_tofel_speaking" value="<?php echo $formdata['eng_tofel_speaking'];?>" id="eng_tofel_speaking">
</td>
</tr>

<tr>
  <td>OET</td>
    <td>    <input style="width:100px;" placeholder="Total"  type="text"  name="eng_oet" value="<?php echo $formdata['eng_oet'];?>" id="eng_oet"> | 
    <input style="width:100px;" placeholder="Reading"  type="text"  name="eng_oet_reading" value="<?php echo $formdata['eng_oet_reading'];?>" id="eng_oet_reading"> | 
    <input style="width:100px;" placeholder="Listening"  type="text"  name="eng_oet_listening" value="<?php echo $formdata['eng_oet_listening'];?>" id="eng_oet_listening">|
    <input style="width:100px;" placeholder="Writing"  type="text"  name="eng_oet_writing" value="<?php echo $formdata['eng_oet_writing'];?>" id="eng_oet_writing">|
    <input style="width:100px;" placeholder="Speaking"  type="text"  name="eng_oet_speaking" value="<?php echo $formdata['eng_oet_speaking'];?>" id="eng_oet_speaking">
</td>
</tr>

<tr>
  <td>GRE</td>
    <td><input class="form-control hori " type="text" name="eng_gre" value="<?php echo $formdata['eng_gre'];?>" id="eng_gre"></td>
</tr>

<tr>
  <td>GMAT</td>
    <td><input class="form-control hori " type="text" name="eng_gmat" value="<?php echo $formdata['eng_gmat'];?>" id="eng_gmat"></td>
</tr>

<tr>
  <td>SAT</td>
    <td><input class="form-control hori " type="text" name="eng_sat" value="<?php echo $formdata['eng_sat'];?>" id="eng_sat"></td>
</tr>

<tr>
  <td>10th Marks</td>
    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_10th" value="<?php echo $formdata['eng_10th'];?>" id="eng_10th"></td>
</tr>

<tr>
  <td>12th Marks</td>
    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_12th" value="<?php echo $formdata['eng_12th'];?>" id="eng_12th"></td>
</tr>


<!--
<tr>
<td>Driving License</td>
<td><input class="form-control hori " type="text" name="driving_license" value="<?php //echo $formdata['driving_license'];?>" id="driving_license"></td>
</tr>
-->
<tr>
<td>Visa type</td>
 <td> <?php echo form_dropdown('visa_type_id',  $visatype_list, $formdata['visa_type_id'],'class="form-control" id="visa_type_id"');?> </td>

</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Update" id="edit_candidate2" style="width:180px;">
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
function candidate_validate() 
{
	alert('');
	return true;
	if($('#passportno').val()=='')
	{
		alert('Enter passport number');
		$('#passportno').focus();
		return false;
	}   
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
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
