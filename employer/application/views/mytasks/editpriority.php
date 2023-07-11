<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
  <form action="<?php echo $this->config->site_url();?>/taskspriority/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
  
  <?php echo form_hidden('task_priority_id', $formdata['task_priority_id']);?>

<tr>
<td>Task Priority Name</td>
<td>
<input type="text" placeholder="" class="form-control input-large" id="task_priority_name" name="task_priority_name" value="<?php echo $formdata['task_priority_name'];?>">
</td>
</tr>
<tr>
<td>Status</td>
<td>
<label><input type="radio" name="status" id="status" value="1" <?php if($formdata['status']==1)echo 'checked="checked"';?>> Active</label>
<label><input type="radio" name="status" id="status" value="0" <?php if($formdata['status']==0)echo 'checked="checked"';?>> Inactive </label></td>
</tr>

<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/taskspriority" class="attach-subs subs">Cancel</a>
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

function validate()
{
	if($('#task_priority_name').val()=='')
	{
		alert('Please enter Priority name');
		$('#task_priority_name').focus();
		return false;
	}
	if($('#status').val()=='')
	{
		alert('Please select status');
		$('#status').focus();
		return false;
	}
	return true;
}

</script>					
		