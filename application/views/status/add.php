<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages"><a href="<?php echo $this->config->site_url();?>/status">Status </a> / <span><?php echo $page_head;?></span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>status form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
  <form action="<?php echo $this->config->site_url();?>/status/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
<tr>
<td>Status Name</td>
<td>
<input type="text" placeholder="" class="form-control input-large" id="status_name" name="status_name" value="<?php echo $formdata['status_name'];?>">
</td>
</tr>
<tr>
<td>Status</td>
<td>
<label><input type="radio" name="status" id="optionsRadios1" value="1" <?php if($formdata['status']==1)echo 'checked="checked"';?>> Active</label>
<label><input type="radio" name="status" id="optionsRadios2" value="0" <?php if($formdata['status']==0)echo 'checked="checked"';?>> Inactive </label></td>
</tr>


<tr>
<td>Add Icon</td>
<td> 
<?php echo form_upload(array('name'=>'icon_file_name','class'=>'form-data','id'=>'icon_file_name'));?>
</td>
</tr>

<tr>
<td>Add Image</td>
<td> 
<?php echo form_upload(array('name'=>'icon_inactive','class'=>'form-data','id'=>'icon_inactive'));?>
</td>
</tr>

<tr>
<td>Add Order</td>
<td>
<div id="Parent">
<input type="text" placeholder="" class="form-control input-large" id="status_order" name="status_order" value="<?php echo $formdata['status_order'];?>">
</div>
</td>
</tr>

<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/status" class="attach-subs subs">Cancel</a>
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

<script type="text/javascript">
$(function() {
  $('#Parent').on('keydown', '#status_order', function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
})
function validate()
{
	if($('#status_name').val()=='')
	{
		alert('Please enter status name');
		$('#status_name').focus();
		return false;
	}
	if($('#icon_file_name').val()==''){
		alert('Please add icon');
		$('#icon_file_name').focus();
		return false;

	}
	if($('#icon_inactive').val()==''){
		alert('Please add image');
		$('#icon_inactive').focus();
		return false;

	}
	
	return true;
}
</script>		