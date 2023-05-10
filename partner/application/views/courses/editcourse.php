<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">
<span>
<a href="<?php echo $this->config->site_url()?>courses">Courses</a></span> / <span>Edit Course</span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?></h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
  <form action="<?php echo $this->config->site_url();?>courses/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
<?php echo form_hidden('course_id', $formdata['course_id']);?>

<input type="hidden" name="univ_id" value="" />
<input type="hidden" name="subject_id" value="" />
<input type="hidden" name="inquiry" value="" />
<input type="hidden" name="course_details" value="" />

 
<tr>
<td>Courses Name</td>
<td><input class="form-control hori" type="text" name="course_name" value="<?php echo $formdata['course_name'];?>" id="course_name"></td>
</tr>
<tr>
<td>Level of Study</td>
 <td> <?php echo form_dropdown('level_study',  $levels, $formdata['level_study'],'class="form-control" id="level_study"');?> </td>	
</tr>

<!--
<tr>
<td>Mode of Study</td>
 <td> <?php echo form_dropdown('mode_id', $modes, $formdata['mode_id'],'class="form-control" id="mode_id"');?></td>	
</tr>

<tr>
<td>Qualification</td>
<td><input class="form-control hori" type="text" name="qualification" value="<?php echo $formdata['qualification'];?>" id="qualification"></td>
</tr>

<tr>
<td>Location</td>
<td><input class="form-control hori fo-icon-1" type="text" name="location" value="<?php echo $formdata['location'];?>" id="location"></td>
</tr>
<tr>
<td>By Distance Education ?</td>
<td>
 <label class="radio-inline">
      <input type="radio" name="by_distance" id="by_distance" value="1" <?php if($formdata['by_distance'] ==1){?> checked <?php } ?> >Yes</label>
    <label class="radio-inline">
<input type="radio" name="by_distance" id="by_distance" value="0" <?php if($formdata['by_distance'] ==0){?> checked <?php } ?> >No</label></td>
</tr>
<tr>

<tr>
<td>Duration</td>
<td><input class="form-control hori fo-icon-1" type="text" name="duration" value="<?php echo $formdata['duration'];?>" id="duration"></td>
</tr>

<tr>
<td>Start date</td>
<td><input class="form-control hori fo-icon-1" type="text" name="start_date" id="start_date" value="<?php echo $formdata['start_date'];?>"  ></td>
</tr>
<tr>
<td>Inquiry Details</td>
<td>
<?php //echo $this->ckeditor->editor('inquiry',$formdata['inquiry']);?>
</td>
</tr>

<tr>
<td>Type</td>
 <td> <?php 
					$options = array(
                  '1'  => 'National',
                  '2'    => 'International');
					echo form_dropdown('international', $options, $formdata['international'],'id="type"');
					?>
 </td>	
</tr>

<tr>
<td>Attach Files</td>
 <td> 
 <?php echo form_upload(array('name'=>'course_info_attach','class'=>'form-data'));?>
 </td>
</tr>
<tr>
<td>Course Details</td>
<td>
<?php //echo $this->ckeditor->editor('course_details',$formdata['course_details']);?>

</td>
</tr>
-->

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>courses" class="attach-subs subs">Cancel</a>
</span>
</td>
</tr>
</form>
</tbody>
</table>
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<script>
$(document).ready(function()
{
	$('#start_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
});	

function validate()
{	
	if($('#course_name').val()=='')
	{
		alert('Please enter course name');
		$('#course_name').focus();
		return false;
	}
	
   
	if($('#level_study').val()=='')
	{
		alert('Please select level');
		$('#level_study').focus();
		return false;
	}
	if($('#type').val()==0)
	{
		alert('Please select type');
		$('#type').focus();
		return false;
	}
		
/* 
	if($('#subject_id').val()== null)
	{
		alert('Please select subject');
		$('#subject_id').focus();
		return false;
	}
	if($('#univ_id').val()== null){
			alert('Please select university');
			$('#univ_id').focus();
			return false;
	}
	if($('#mode_id').val()==0)
	{
		alert('Please select mode of study');
		$('#mode_id').focus();
		return false;
	}
	if($('#qualification').val()==''){
			alert('Enter qualification');
			$('#qualification').focus();
			return false;
	}
    if($('#location').val()=='')
	{
		alert('Enter Location');
		$('#location').focus();
		return false;
	}
	
	if($('#duration').val()=='')
	{
		alert('Enter duration');
		$('#duration').focus();
		return false;
	}
	if($('#datepicker').val()=='')
	{
		alert('Select start date');
		$('#datepicker').focus();
		return false;
	}
	if($('#inquiry').val()=='')
	{
		alert('Please add enquiry details');
		$('#inquiry').focus();
		return false;
	}
	if($('#type').val()==0)
	{
		alert('Please select type');
		$('#type').focus();
		return false;
	}
	if($('#main_cont').val()=='')
	{
		alert('Please add course details');
		$('#main_cont').focus();
		return false;
	}
*/	
	return true;
}
</script>		

