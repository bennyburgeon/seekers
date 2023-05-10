<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
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
  <form action="<?php echo $this->config->site_url();?>/tasks/update" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();"> 
  
    									 <?php echo form_hidden('task_id', $formdata["task_id"]);?>

                        
<tr>
<td>Select Candidate</td>
 <td><?php echo form_dropdown('candidate_id',  $admin_users_lists,$formdata["candidate_id"],'class="form-control" id="candidate_id"');?>  </td>	
</tr>


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

<td><?php echo form_dropdown('task_priority_id',  $task_priority_list,$formdata["task_module_id"],'class="form-control" id="task_priority_id"');?></td>
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
 <td><?php echo form_dropdown('candidate_id',  $admin_list,$formdata["candidate_id"],'class="form-control" id="candidate_id"');?>  </td>	
</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/tasks" class="attach-subs subs">Cancel</a></span></td>
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
var teamnum = 0;
function validate()
{
	if($('#task_title').val()=='')
	{
		alert('Please enter task title');
		$('#task_title').focus();
		return false;
	}
	if(CKEDITOR.instances['task_desc'].getData()==''){
		alert('Please enter task description');
		CKEDITOR.instances['task_desc'].focus();
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

	$('#project_team option').prop('selected', 'selected');
	$("#add").click(function() {
		
        $('#project_team_master :selected').each(function(i, selected){ 
			   if(teamnum == 0 ){$("#project_team > option").remove();}
			   var opt1 = $('<option />'); 
				   opt1.val($(selected).val());
				   opt1.text($(selected).text());
				   $('#project_team').append(opt1);
				   $('#project_team option').prop('selected', 'selected');
				   teamnum += 1;
 			   $("#project_team_master option[value='"+$(selected).val()+"']").remove();
		});
    });	
	
	$("#remove").click(function() {
		
        $('#project_team :selected').each(function(i, selected){ 
			   var opt1 = $('<option />'); 
				   opt1.val($(selected).val());
				   opt1.text($(selected).text());
				   $('#project_team_master').append(opt1);
				   $('#project_team option').prop('selected', 'selected');
				   teamnum = teamnum - 1;
 			   $("#project_team option[value='"+$(selected).val()+"']").remove();
		});
    });	
	
	
	
});

</script>					
	