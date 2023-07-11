<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">
<span>
<a href="<?php echo $this->config->site_url()?>/specialisation">Specialisation</a></span> / <span>Add Course</span></div>
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
  <form action="<?php echo $this->config->site_url();?>/specialisation/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
<tr>
<td>Specialisation Name</td>
<td><input class="form-control hori" type="text" name="spcl_name" value="<?php echo $formdata['spcl_name'];?>" id="spcl_name"></td>
</tr>

<!-- 
<tr>
<td>Course</td>
 <td> <?php echo form_dropdown('course_id',$course, $formdata['course_id'],'class="form-control" id="course_id"');?> </td>	
</tr>
-->

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/specialisation" class="attach-subs subs">Cancel</a></span></td>
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

function validate()
{	
	if($('#spcl_name').val()=='')
	{
		alert('Please enter specialisation name');
		$('#spcl_name').focus();
		return false;
	}
	return true;
}


</script>		

