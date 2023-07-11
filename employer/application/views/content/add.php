<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">



<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active">Add Notification  </li>
      </ul>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Notification form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
   <form action="<?php echo $this->config->site_url();?>/content/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
<table class="hori-form">
<tbody>
<tr>
<td>Title</td>
<td>
<input type="text" placeholder="Enter Title" value="<?php echo $formdata["content_title"] ?>"  name="content_title" id="content_title" class="form-control"></td>
</tr>



<tr>
<td>Text</td>
    <td><?php echo $this->ckeditor->editor('actual_text',$formdata['actual_text']);?></td>
</tr>

<tr>
  <td>Target Group</td>
  <td><?php echo form_dropdown('user_grp_id', $admin_group_list, $formdata['user_grp_id'],'class="form-control"');?></td>
</tr>



<tr>
  <td>Target Users</td>
  <td><?php echo form_dropdown('admin_id[]', $admin_users_list, $formdata['admin_id'],'class="form-control" multiple');?></td>
</tr>

<tr>
<td>Upload Filte</td>
    <td><?php echo form_upload(array('name'=>'content_file','class'=>'smallinput', 'value'=>$formdata['content_file']));?></td>
</tr>

<tr>

<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/content" class="attach-subs subs">Cancel</a></span></td>
</tr>
</tbody>
</table>
</form>
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>


 <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<?php /*?><script src="<?php echo $this->config->base_url()?>/js/jquery-1.11.0.min.js"></script><?php */?>
<script>
var teamnum = 0;
function validate()
{
	
	if($('#content_title').val()=='')
	{
		alert('Please enter task title');
		$('#content_title').focus();
		return false;
	}
	if(CKEDITOR.instances['actual_text'].getData()==''){
		alert('Please enter task description');
		CKEDITOR.instances['actual_text'].focus();
		return false;
	}

	return true;
}
</script>					
