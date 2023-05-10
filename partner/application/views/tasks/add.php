<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

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
  <form action="<?php echo $this->config->site_url();?>tasks/add" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();"> 
  
<!--     
<tr>
<td>Select Candidate</td>
 <td><?php echo form_dropdown('candidate_id',  $admin_users_lists,$formdata["candidate_id"],'class="form-control" id="candidate_id"');?>  </td>	
</tr>
-->

<tr>
<td>Task Title</td>
<td><input name="task_title" type="text" class="form-control" id="task_title" value="<?php echo $formdata["task_title"]; ?>" maxlength="200" placeholder="Enter Your Task Title" /></td>
</tr>

<tr>
<td>Start Date</td>
 <td>  <input type="text" id="start_date" class="form-control p m-ctrl-medium date-picker" name="start_date" value="<?php echo $formdata["start_date"]; ?>" placeholder="Start Date" /> </td>	
</tr>

<tr>
<td>Due Date</td>
<td><input type="text" id="due_date" class="form-control m-wrap m-ctrl-medium date-picker" name="due_date" value="<?php echo $formdata["due_date"]; ?>" placeholder="Due Date" /></td>
</tr>

<tr>
<td>Task Priority</td>

<td><?php echo form_dropdown('task_priority_id',  $task_priority_list,$formdata["task_priority_id"],'class="form-control" id="task_priority_id"');?></td>
</tr>
<tr>
<td>Task Status</td>
 <td><?php echo form_dropdown('task_status_id',  $task_status_list,$formdata["task_status_id"],'class="form-control" id="task_status_id"');?>  </td>	
</tr>


<tr>
<td>Task Description</td>
 <td> 
 <?php echo $this->ckeditor->editor('task_desc',$formdata['task_desc']);?> </td>
</tr>

<tr>
<td>Admin user</td>
 <td><?php echo form_dropdown('admin_id',  $admin_list,$formdata["admin_id"],'class="form-control" id="admin_id"');?>  </td>	
</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>tasks" class="attach-subs subs">Cancel</a></span></td>
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
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<?php /*?><script src="<?php echo $this->config->base_url()?>/js/jquery-1.11.0.min.js"></script><?php */?>
<script>
var teamnum = 0;
function validate()
{

	
	if($('#task_title').val()=='')
	{
		alert('Please enter task title');
		$('#task_title').focus();
		return false;
	}
		if($('#task_priority_id').val()==0)
	{
		alert('Please Select Priority');
		$('#task_priority_id').focus();
		return false;
	}
		if($('#task_status_id').val()==0)
	{
		alert('Please Select  task Status');
		$('#task_status_id').focus();
		return false;
	}
	if(CKEDITOR.instances['task_desc'].getData()==''){
		alert('Please enter task description');
		CKEDITOR.instances['task_desc'].focus();
		return false;
	}

if($('#admin_id').val()=='0')
	{
		alert('Please Select User');
		$('#admin_id').focus();
		return false;
	}
	
	return true;
}
/*var $j=jQuery.noConflict();*/
$(document).ready(function(){
	$('#start_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	$('#due_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	$('#project_id').change(function(){
		
		$("#milestone_id > option").remove();
		$("#task_team > option").remove();
		 var opt1 = $('<option />'); 
				   opt1.val(0);
				   opt1.text("Select milestone");
				   $('#milestone_id').append(opt1); 
		$.ajax({
					url: "<?php echo $this->config->site_url();?>tasks/getmilestone",	
					type: "POST",	
					data: "project_id="+jQuery('#project_id').val(),	
					cache: false,
					success: function (data) {
						
						$.each(data, function(index) {
								 var opt = $('<option />'); 
								 opt.val(data[index].id);
								 opt.text(data[index].title);
								 $('#milestone_id').append(opt); 
	 
						 });
						
					}	
					});
					
					
		$.ajax({
					url: "<?php echo $this->config->site_url();?>tasks/getteam",	
					type: "POST",	
					data: "project_id="+jQuery('#project_id').val(),	
					cache: false,
					success: function (data) {
						
						$.each(data, function(index) {
								 var opt = $('<option />'); 
								 opt.val(data[index].id);
								 opt.text(data[index].name);
								 $('#task_team').append(opt); 
	 
						 });
						
					}	
					});
		});
});

</script>					
