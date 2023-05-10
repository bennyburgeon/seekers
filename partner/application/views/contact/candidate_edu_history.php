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

<li class="active"><a href="<?php echo base_url();?>index.php/contact/edu_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Education</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/job_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Job History</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li><a href="<?php echo base_url();?>index.php/contact/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>

</ul>




</div>


</div>
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Education History</div>
<div class="profile_top_right">

</div>
<div style="clear:both;"></div>
</div>



<div class="profile_bottom" id="leads">
<div class="tasks profile">

<div id="response"></div>
<?php 
 foreach($cv_fileist as $cv_fileist1){?>
<div class="slider_redesign" id="tr_<?php echo $cv_fileist1['eucation_id'];?>" >

<div class="side_adj second">

<h2><?php echo $cv_fileist1['course_name'];?> | <?php echo $cv_fileist1['level_name'];?></h2>
<p>University: <?php echo $cv_fileist1['univ_name'];?></p>
<p>Specialization: <?php echo $cv_fileist1['spcl_name'];?></p>
<p>Course Type: <?php echo $cv_fileist1['course_type'];?></p>
<p>Course Type: <?php echo $cv_fileist1['arrears'];?></p>
<p>Absence: <?php echo $cv_fileist1['absesnse'];?></p>
<p>Repeat: <?php echo $cv_fileist1['repeat'];?></p>
<p>Year Back: <?php echo $cv_fileist1['year_back'];?></p>
<p>Mark Percetage: <?php echo $cv_fileist1['mark_percentage'];?></p>
<p>Grade: <?php echo $cv_fileist1['grade'];?></p>
<div class="date_edit">
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $cv_fileist1['eucation_id'];?>" onClick="return validate(this.id);" >

</span>

</div>
</div>
</div>
<?php }?>


</div>
</div>

<div class="notes">
<ul>
<li id="tab_2btn">Education</li>


</ul>

   
	<!--Followup-->

    <div class="table-tech specs note">
    <div class="new_notes">
    <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
    -->
    <p id="result"></p>
    <p id="deletemessage"></p>

    <?php echo $error;?>

<form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/contact/edu_history/<?php echo $candidate_id;?>" onSubmit="return candidate_validate();"> 
<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
<table class="hori-form">
<tbody>

<tr>
<td>Level of Study</td>
 <td> <?php echo form_dropdown('level_id',  $edu_level_list, $formdata['level_id'],'class="form-control" id="level_id"');?> </td>
</tr>
<tr>
<td>Course</td>
 <td> <?php echo form_dropdown('course_id',  $edu_course_list, $formdata['course_id'],'class="form-control" id="course_id"');?> </td>
</tr>
<tr>
<td>Specialization</td>
 <td> <?php echo form_dropdown('spcl_id',  $edu_spec_list, $formdata['spcl_id'],'class="form-control" id="spcl_id"');?> </td>
</tr>
<tr>
<td>University</td>
 <td> <?php echo form_dropdown('univ_id',  $edu_univ_list, $formdata['univ_id'],'class="form-control" id="univ_id"');?> </td>
</tr>
<tr>
<td>Year</td>
 <td> <?php echo form_dropdown('edu_year',  $edu_years_list, $formdata['edu_year'],'class="form-control" id="edu_year"');?> </td>
</tr>
<tr>
<td>Country</td>
 <td> <?php echo form_dropdown('edu_country',  $country_list, $formdata['edu_country'],'class="form-control" id="edu_country"');?> </td>
</tr>
<tr>
<td>Course Type</td>
 <td> <?php echo form_dropdown('course_type_id',  $edu_course_type_list, $formdata['course_type_id'],'class="form-control" id="course_type_id"');?> </td>
</tr>

<tr>
<td>Arrears</td>
 <td> <input style="width:100px;" placeholder="arrears"  type="text"  name="arrears" value="<?php echo $formdata['arrears'];?>" id="arrears"> </td>
</tr>

<tr>
<td>Absence</td>
 <td> <input style="width:100px;" placeholder="absesnse"  type="text"  name="absesnse" value="<?php echo $formdata['absesnse'];?>" id="absesnse"> </td>
</tr>

<tr>
<td>Repeat</td>
 <td> <input style="width:100px;" placeholder="repeat"  type="text"  name="repeat" value="<?php echo $formdata['repeat'];?>" id="repeat"> </td>
</tr>

<tr>
<td>Year Back</td>
 <td> <input style="width:100px;" placeholder="year_back"  type="text"  name="year_back" value="<?php echo $formdata['year_back'];?>" id="year_back"> </td>
</tr>

<tr>
<td>Total %</td>
 <td> <input style="width:100px;" placeholder="mark_percentage"  type="text"  name="mark_percentage" value="<?php echo $formdata['mark_percentage'];?>" id="mark_percentage"> </td>
</tr>

<tr>
<td>Grade</td>
 <td> <input style="width:100px;" placeholder="grade"  type="text"  name="grade" value="<?php echo $formdata['grade'];?>" id="mark_percentage"> </td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;">
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

		function validate(eucation_id){

			var row = "#tr_" + eucation_id;
		
		if(confirm('Are you sure you want to delete?'))
		{
	
			$.ajax({
				type:"POST",
				url: '<?php echo site_url('contact/drop_edu_item'); ?>',
				data:{ 
				eucation_id:eucation_id,
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
		 

   function candidate_validate() 
   {
/*		if($('#level_id').val()==0)
		{
			alert('Select Level');
			$('#level_id').focus();
			return false;
		}   
*/		if($('#course_id').val()==0)
		{
			alert('Select course');
			$('#course_id').focus();
			return false;
		}
/*		if($('#spcl_id').val()==0)
		{
			alert('Select specialization');
			$('#spcl_id').focus();
			return false;
		}   
		if($('#univ_id').val()==0)
		{
			alert('Select University');
			$('#univ_id').focus();
			return false;
		}
		if($('#edu_year').val()==0)
		{
			alert('Select year');
			$('#edu_year').focus();
			return false;
		}   
		if($('#edu_country').val()=='')
		{
			alert('Select Country');
			$('#edu_country').focus();
			return false;
		}
		if($('#course_type_id').val()==0)
		{
			alert('Select Course type');
			$('#course_type_id').focus();
			return false;
		}
*/	    return true;
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


// level study course filtering 

	$('#level_id').change(function() 
	{	
		jQuery('#course_id').html('');
		jQuery('#course_id').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/contact/getcourses/',
			  data: { level_study: $('#level_id').val(),int_val:1},
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
					 /* sorting start hrre */
					var my_options = $("#course_id option");
					var selected = $("#course_id").val(); /* preserving original selection, step 1 */
					my_options.sort(function(a,b) {
						if (a.text > b.text) return 1;
						else if (a.text < b.text) return -1;
						else return 0
					})
					$("#course_id").empty().append( my_options );
					$("#course_id").val(selected); /* preserving original selection, step 2 */
				  /* sorting end hrre */
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
	
//


</script>
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
