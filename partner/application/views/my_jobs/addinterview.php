<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>
<div class="row">
<div class="col-md-3">
<div class="profile_box">


<span id="loading"></span>


<ul>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/manage/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/addcandidate/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Manage Candidates</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/job_apps/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Job Applications</a></li>

<li  class="active"><a href="<?php echo $this->config->site_url();?>my_jobs/addinterview/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Manage Interviews</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/shortlist/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Candidates Shortlisted</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/offer_letters/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Offer Letters</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/app_closure/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>App. Closure</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/invoice/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Invoices</a></li>


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

<div class="slider_redesign" id="tr_1" >

<div class="side_adj second">

<h2>Test</h2>
<p>University: test</p>
<p>Specialization: test</p>
<p>Course Type: test</p>
<p>Course Type: test</p>
<p>Absence: test</p>
<p>Repeat: test</p>
<p>Year Back: test</p>
<p>Mark Percetage: test</p>
<p>Grade: test</p>
<div class="date_edit">
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="1" onClick="return validate(this.id);" >

</span>

</div>
</div>
</div>

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


<form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>my_jobs/addinterview/<?php echo $job_app_id;?>" onSubmit="return candidate_validate();"> 
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                    <input type="hidden" name="job_app_id" value="<?php echo $job_app_id;?>">
<table class="hori-form">
<tbody>

<tr>
<td>Interview Title</td>
 <td><?php echo form_input(array('name'=>'title', 'class' => 'smallinput'));?> </td>
</tr>


<tr>
<td>Interview Type</td>
 <td><?php echo form_dropdown('interview_type_id', $interview_type);?></td>
</tr>

<tr>
<td>Interview Status</td>
 <td><?php echo form_dropdown('int_status_id', $int_status_id);?></td>
</tr>

<tr>
<td>Location</td>
 <td><?php echo form_input(array('name'=>'location','class'=>'smallinput', 'value'=>$formdata['location']));?></td>
</tr>

<tr>
<td>Interview Date</td>
 <td><?php echo form_input(array('name'=>'interview_date','id' => 'datepicker','class'=>'width100', 'value'=>$formdata['interview_date']));?>  </td>
</tr>

<tr>
<td>Interview Time</td>
 <td><?php echo form_dropdown('interview_time', $interview_time_ar);?></td>
</tr>

<tr>
<td>Description</td>
 <td><?php echo form_input(array('name'=>'description', 'class' => 'smallinput'));?> </td>
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
				url: '<?php echo site_url('candidates/drop_edu_item'); ?>',
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
			  url: '<?php echo $this->config->site_url();?>/candidates/getcourses/',
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
