<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">
<span>
<a href="<?php echo $this->config->site_url()?>trainingcenter">Courses</a></span> / <span>Edit Course</span></div>
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
  <form action="<?php echo $this->config->site_url();?>trainingcenter/connect/<?php echo $formdata['center_id'];?>" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
<?php echo form_hidden('center_id', $formdata['center_id']);?>

<tr>
<td><?php echo $formdata['center_name'];?></td>
<td>Selected Courses</td>
</tr>

<tr>
<td width="50%">


<select multiple name="national[]" id="national" size="20" class="form-control">

<?php foreach($national as $level => $course){ ?>
	<optgroup label="<?php echo $level;?>">
	<?php foreach($course as $key => $val){ ?>
	<option value="<?php echo $val['course_id']?>"><?php echo $val['course_name']?></option>
	<?php     
    }
    ?>
</optgroup>
	<?php 
    }
    ?>
	</select>

</td>
 <td width="50%">
 
 
 <select multiple name="international[]" id="international" size="20" class="form-control">

<?php foreach($international as $level => $course){ ?>
	<optgroup label="<?php echo $level;?>">
	<?php foreach($course as $key => $val){ ?>
	<option value="<?php echo $val['course_id']?>"><?php echo $val['course_name']?></option>
	<?php     
    }
    ?>
</optgroup>
	<?php 
    }
    ?>
	</select>
 
 </td>	
</tr>


<tr>
<td>Select and click on Add </td>
 <td>Select and click on Remove</td>	
</tr>


<tr>
<td><span class="click-icons">
  <input type="submit" class="attach-subs" name="add" value="Add">
</span></td>
<td><span class="click-icons">
  <input type="submit" class="attach-subs" name="remove" value="Remove">
</span></td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons"><a href="<?php echo $this->config->site_url();?>trainingcenter" class="attach-subs subs">Back</a></span></td>
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

	return true;
}
</script>		

