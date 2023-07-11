<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">
<span>
<a href="<?php echo $this->config->site_url()?>/todo">Todo</a></span> / <span>Add Todo</span></div>
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
<form action="<?php echo $this->config->site_url();?>/todo/add" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();">
  
    
                    
<tr>
<td>Todo Title</td>
<td><input type="text" id="title" name="title" value="<?php echo $formdata['title'];?>" placeholder="" class="form-control" /></td>
</tr>

<tr>
<td>Start Date</td>
 <td> <input type="text" id="start_date" name="start_date" value="<?php echo $formdata['start_date'];?>" placeholder="" class="form-control date-picker" />
 </td>	
</tr>

<tr>
<td>End Date</td>
<td> <input type="text" id="end_date" name="end_date" value="<?php echo $formdata['end_date'];?>" placeholder="" class="form-control date-picker" />
</td>
</tr>
<tr>
<td>Start Time</td>

<td><input type="text" id="start_time" name="start_time" value="<?php echo $formdata['start_time'];?>" placeholder="" class="form-control" /></td>
</tr>
<tr>
<td>End Time</td>

<td> <input type="text" id="end_time" name="end_time" value="<?php echo $formdata['end_time'];?>" placeholder="" class="form-control" /></td>
</tr>
<tr>
<td>Group</td>
 <td> <?php echo form_dropdown('todo_group_id', $todo_group_id, $formdata['todo_group_id'],'class="form-control"');?>
  </td>	
</tr>

<tr>
<td>Status</td>
 <td><?php echo form_dropdown('status_id', $status_list, $formdata['status_id'],'class="form-control"');?>
   </td>
</tr>
<tr>
<td>Details</td>

<td>
<!--<textarea class="form-control ckeditor m-wrap" name="description" rows="6"><?php echo $formdata['description'];?></textarea>-->
<?php echo $this->ckeditor->editor('description',$formdata['description']);?>

</td>
</tr>
<tr>
<td>Photo</td>
 <td> 
  <div class="fileupload fileupload-new" data-provides="fileupload">
                                               <div>
                                                  
                                                  <span class="btn default btn-file">
                                                  <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                                  <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                  
                                                 <?php echo form_upload(array('name'=>'attachment','class'=>'smallinput', 'value'=>$formdata['attachment']));?>
                                                  </span>
                                                  <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i>Remove</a>
                                               </div>
                                            </div>
  </td>	
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/todo" class="attach-subs subs">Cancel</a>
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
	$('#end_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
});	

function validate()
{
	if($('#title').val()=='')
	{
		alert('Please enter title');
		$('#title').focus();
		return false;
	}
	
	return true;
}
</script>		
		