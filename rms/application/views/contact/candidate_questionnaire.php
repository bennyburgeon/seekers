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

<li><a href="<?php echo base_url();?>index.php/contact/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>

</ul>


</div>


</div>
<div class="col-md-9">




<div class="notes">
<ul>
<li id="tab_2btn">Questionnaire</li>


</ul>

   
	<!--Followup-->

    <div class="table-tech specs note">
    <div class="new_notes">
    <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
    -->
    <p id="result"></p>
    <p id="deletemessage"></p>

<?php if($cv_file!=''){?><p id="result" style="color:#0000FF"><?php echo $cv_file;?></p><?php } ?>
<?php if($photo_file!=''){?><p id="result" style="color:#0000FF"><?php echo $photo_file;?></p><?php } ?>

    
<form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/contact/questionnaire/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 
<table class="hori-form">
<tbody>

<?php 

		 foreach($survey_result as $key => $val)
		 {
?>		 
<tr>
  <td>
<?php 
			echo $val['question_title'];
?>
</td>
 <td>
<?php 			
			foreach($val['answer'] as $answer_id => $answer_val)
			{
				if($survey_result[$key]['answer_value']!='' && $answer_val==$survey_result[$key]['answer_value'])
					echo '<input type="radio" name="qt_'.$val['question_id'].'" id="radio" value="'.$answer_val.'" checked="checked" />'.$answer_val;
				else
					echo '<input type="radio" name="qt_'.$val['question_id'].'" id="radio" value="'.$answer_val.'"/>'.$answer_val;
			}
?>
</td>
<?php } ?>
</tr>

<tr>
<td>Upload your CV</td>
 <td> 
 <?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?>
 </td>
</tr>
<tr>
<td>Upload your Photo</td>
 <td> 
 <?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?>
                                                        
 </td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
</span>
</td>
</tr>
</tbody>
</table>
<input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id"></div>
<div id="success"></div>
</form>
    </div>
    
   
    <div style="clear:both;"></div>
    </div>

	<!--Followup-->
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script language="javascript">

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

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
