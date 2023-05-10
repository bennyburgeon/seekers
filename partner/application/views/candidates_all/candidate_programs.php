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

<li class="active"><a href="<?php echo base_url();?>candidates_all/candidate_programs/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Programs</a></li>

<li><a href="<?php echo base_url();?>candidates_all/candidate_coe/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>CoE</a></li>

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


<div class="profile_bottom" id="programs">
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
<span class="dates">Created On: <?php echo $aplication_list1['app_created'];?></span>
<span class="edit_delete">

<a href="<?php echo base_url();?>candidates_all/candidate_programs/<?php echo $detail_list['candidate_id'];?>?app_id=<?php echo $aplication_list1['app_id'];?>"><img src="<?php echo base_url('assets/images/profile_edit.png');?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $aplication_list1['app_id'];?>" onClick="return app_validate(this.id)" >
</span>

</div>
</div>
</div>
<?php } ?>

</div>
</div>





<div class="notes">
<ul>
<li id="li_program">Programs</li>
</ul>
  
     <!--Programs-->
    <div class="table-tech specs note" id="programs">
    <div class="new_notes">
      <p id="resultapp"></p>
    <p id="deleteapp"></p>
       <form method="post" id="candidate_aplication" name="candidate_aplication" action="<?php  echo $this->config->site_url();?>candidates_all/candidate_programs/<?php echo $detail_list['candidate_id'];?>">

    <input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
	<input type="hidden" value="<?php echo $app_id;?>" name="app_id" id="app_id">
           
       
    <table class="hori-form">
    <tbody>
    <tr>
    <td>University</td>
    <td>
   <?php echo form_dropdown('univ_id',  $university_list,$single_application['univ_id'],'id="univ_id"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>
    
    <tr>
      <td>Campus</td>
      <td><?php echo form_dropdown('campus_id',  $campus_list,$single_application['campus_id'],'id="campus_id"  class="table-group-action-input form-control input-medium"');?> </td>
    </tr>

    <tr>
    <td>Level of Study</td>
    <td>
    <?php echo form_dropdown('level_study',  $level_list,$single_application['level_study'],'id="level_study"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>
        
    <tr>
    <td>Course</td>
    <td>
    <?php echo form_dropdown('course_id', $course_list,$single_application['course_id'],'id="course_id"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>

    <tr>
    <td>Qualification</td>
    <td>
    <?php echo form_dropdown('candidate_course_id', $candidate_qualification_list,$single_application['candidate_course_id'],'id="candidate_course_id"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>
    
    <tr>
    <td>Intake</td>
    <td>
    <?php echo form_dropdown('intake_id',  $intake_list,$single_application['intake_id'],'id="intake_id"  class="table-group-action-input form-control input-medium"');?>    </td>
    </tr>
        
    <tr>
    <td>Process status</td>
    <td colspan="2"> <?php echo form_dropdown('status_id',  $status_list,$single_application['process_status_id'],'id="status_id"  class="table-group-action-input form-control input-medium"');?></td>
    </tr>
     <tr>
    <td>Name this Program</td>
    <td colspan="2"><input type="text" name="app_details" class="form-control hori" id="app_details" value="<?php echo $single_application['app_details'];?>" placeholder="Name this program" /></td>
    </tr>

<tr>
    <td>Total Semester</td>
    <td colspan="2"><input type="text" name="total_semester" maxlength="10" style="width:100px;" id="total_semester" value="<?php echo $single_application['total_semester'];?>" placeholder="Total Sem." /></td>
    </tr>


<tr>
    <td>Fee/Semester</td>
    <td colspan="2"><input type="text" name="fee_per_semester" maxlength="10" style="width:100px;" id="fee_per_semester" value="<?php echo $single_application['fee_per_semester'];?>" placeholder="Fee/Sem." /></td>
    </tr>

	<tr>
    <td>Annual Tution Fee</td>
    <td colspan="2"><input type="text" maxlength="10" name="annual_tution_fee" style="width:100px;" id="annual_tution_fee" value="<?php echo $single_application['annual_tution_fee'];?>" placeholder="Fee/Annum" /></td>
    </tr>
    

	<tr>
    <td>Total Tution Fee</td>
    <td colspan="2"><input type="text" name="total_tution_fee" maxlength="10" style="width:100px;" id="total_tution_fee" value="<?php echo $single_application['total_tution_fee'];?>" placeholder="Total Fee" /></td>
    </tr>
            
    <tr>
    <td colspan="2">
<span class="click-icons">
	 <?php if($edit_mode==1){?>
	      <input type="button" name="update" id="update" class="attach-subs" value="Update" >
          <a href="<?php  echo $this->config->site_url();?>candidates_all/candidate_programs/<?php echo $detail_list['candidate_id'];?>" class="attach-subs subs">Cancel</a>
      <?php }else{ ?>
	      <input type="button" name="create_app" id="create_app" class="attach-subs" value="Save" >      
      <?php } ?>
          
</span>
   
   
     
   
    </td>
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
		if($('#candidate_course_id').val()=='0' || $('#candidate_course_id').val()=='')
		{
			alert('Select Qualification');
			$('#candidate_course_id').focus();
			return false;
		}

		if($('#candidate_course_id').val()=='')
		{
			alert('Please select qualification');
			$('#candidate_course_id').focus();
			return false;
		}
							
		if($('#status_id').val()=='0')
		{
			alert('Select Your Process Status');
			$('#status_id').focus();
			return false;
		}

		if($('#app_details').val()=='')
		{
			alert('Please name the application.');
			$('#app_details').focus();
			return false;
		}
				
	     return true;
    }
		
	$('#create_app').click(function()
			{
			var dataStringprop = $("#candidate_aplication").serialize();
			var isCandiadte_aplicationValid =aplication_validate();
				if(isCandiadte_aplicationValid) {
					$("#create_app").prop('value', 'Wait....');
					$.ajax({
					type:"POST",
					url: '<?php echo site_url('candidates_all/aplication'); ?>',
						data:dataStringprop,
						success: function(msg) {
							$("#deleteapp").html('');
							$("#responseapp").append(msg);
							$("#resultapp").html('<div class="alert alert-success">Successfully Added</div>');
							$('input[type="text"],textarea').val('');
							$("#create_app").prop('value', 'Save');
						}
					});//end Ajax
				}//end Validation
			});//end button click 


			$('#update').click(function(){
			var isCandiadte_aplicationValid =aplication_validate();
				if(isCandiadte_aplicationValid) {
					$('#candidate_aplication').submit()
					//return false;
				}//end Validation
			});//end update button click 				
		
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
				success: function(msg) 
			{
				$("#resultapp").html('');
				$('input[type="text"],textarea').val('');
				$(row).fadeOut("slow");
				$("#deleteapp").html('<div class="alert alert-success"><strong>Success!</strong> The page has been Deleted.</div>');
				//window.location='<?php echo site_url('candidates_all/candidate_view'); ?>/<?php echo $candidate_id;?>';
			}
        });//end Ajax
		}
		}
			    <!--Programs--> 

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
			  url: '<?php echo $this->config->site_url();?>candidates_all/getcampus/',
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
			  url: '<?php echo $this->config->site_url();?>candidates_all/getcourses/',
			  data: { level_study: $('#level_study').val(),int_val:2},
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
// level filtering end here 		 
		 </script>
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">