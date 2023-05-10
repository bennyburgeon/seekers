
	<!-- BEGIN CONTAINER -->
	<div id="container" class="row-fluid">
		<!-- BEGIN SIDEBAR -->
		 
		 <?php echo $left_nav;?>
         
		<!-- END SIDEBAR -->
		<!-- BEGIN PAGE -->
		<div id="body">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM--><!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN STYLE CUSTOMIZER--><!-- END STYLE CUSTOMIZER-->    	
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
						<h3 class="page-title">
							Tasks				<small>Tasks Followups</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="<?php echo $this->config->site_url();?>/dashboard">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="<?php echo $this->config->site_url();?>/tasks/">Tasks</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Tasks Followups</a></li>
							
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
                 <?php if($this->input->get('ins')==1){?>
      <div class="alert alert-success">
        <button class="close" data-dismiss="alert">×</button>
        <strong>Success!</strong> record added successfully. </div>
      <? } ?>
      <?php if($this->input->get('err')==1){?>
      <div class="alert alert-error">
        <button class="close" data-dismiss="alert">×</button>
        <strong>Error in submitted data..</strong> </div>
      <? } ?>
				<div class="widget">
								<div class="widget-title">
									<h4><i class="icon-reorder"></i>Task Info : <?php echo $task["task_title"]; ?></h4>
																
								</div>
								<div class="widget-body">
									<div class="well">
										 <table class="table table-striped table-hover table-bordered" >
                              <thead>
                                 <tr>
                                    
                                     <th class="head1">Task ID</th>
                          			
                                    <th class="head1">Start Date</th>
                                    <th class="head0">Module</th>
                                    
                                    <th>Priority</th>
                                    <th>Status</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <tr>
                              <td class="text-info"><?php echo $task["task_id"]; ?></td>
                              <td class="text-info"><?php echo $task["start_date"]; ?></td>
                              <td class="text-info"><?php echo $task["task_module_name"]; ?></td>
                              <td class="text-info"><?php echo $task["task_priority_name"]; ?></td>
                              <td class="text-info"><?php echo $task["task_status_name"]; ?></td>
                              </tr>
                              </tbody>
                               </table>
                               <hr />
										<?php echo $task["task_desc"]; ?>
                                        
									</div>
									
								</div>
							</div>
                   <div class="widget">
								<div class="widget-title">
									<h4><i class="icon-reorder"></i>Updates</h4>
																
								</div>
                                <?php foreach($followups as $followup){ ?>
								<div class="widget-body" id="followup-<?php echo $followup["task_fl_id"]; ?>">
									<div class="well">
									<span class="span9"><h4 class="text-info"><?php echo $followup["task_fl_title"]; ?></h4></span><span class="span3"><a href="<?php echo $this->config->site_url();?>/tasks/followup/<?php echo $task["task_id"]; ?>?edit=1&fid=<?php echo $followup["task_fl_id"]; ?>" class="btn btn-primary"><i class="icon-pencil icon-white"></i> Edit</a>&nbsp;<button id="<?php echo $followup["task_fl_id"]; ?>" class="btn btn-danger" onclick="DeleteFollowup(this.id);"><i class="icon-remove icon-white"></i> Delete</button></span>
                                    <p>&nbsp;</p>
                                   <p> <i class="icon-comment"></i> by <i class="icon-user"></i><span class="text-info"> <?php echo ($followup["firstname"]);?></span> <i class="icon-calendar"></i> <?php echo $followup["task_fl_date_time"]; ?></p>
                                    <p> <i class="icon-folder-close"></i> Priority : <span class="text-info"><?php echo $followup["task_priority_name"]; ?></span></p>
                                     <p> <i class="icon-signin"></i> Status : <span class="text-info"><?php echo $followup["task_status_name"]; ?></span></p>
                                    <hr />	 
                               <?php echo $followup["task_fl_desc"]; 
							   
							   ?>
                               
									</div>
									
								</div>
                                <?php } ?>
							</div>
                            
                            
                            <div class="widget" id="editformdiv">
								<div class="widget-title">
									<h4><i class="icon-reorder"></i>Add an update</h4>
																
								</div>
								<div class="widget-body form">
									<form action="<?php echo $this->config->site_url();?>/tasks/<?php echo $actionURL; ?>" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();"> 
<?php echo form_hidden('task_id', $tskfollowup["task_id"]);
		echo form_hidden('task_fl_id', $tskfollowup["task_fl_id"]);
		

?>
									  
                                       <div class="control-group">
                                          <label class="control-label">Date</label>
                                          <div class="controls">
                                            <input type="text" id="task_fl_date_time" class="m-wrap m-ctrl-medium date-picker" name="task_fl_date_time" value="<?php echo $tskfollowup["task_fl_date_time"]; ?>" placeholder="" />
                                          </div>
                                       </div>
                                       
                                       
                                      <div class="control-group">
                                          <label class="control-label">Followup Title</label>
                                          <div class="controls">
                                            <input type="text" id="task_fl_title" name="task_fl_title" value="<?php echo $tskfollowup["task_fl_title"]; ?>" placeholder="" class="input-xxlarge" />
                                          </div>
                                       </div>

                                             <div class="control-group">
                                          <label class="control-label">Description</label>
                                          <div class="controls">
                                           <textarea class="span12 ckeditor m-wrap" id="task_fl_desc" name="task_fl_desc" rows="6"><?php echo $tskfollowup["task_fl_desc"]; ?></textarea>
                                          </div>
                                       </div>
                                          
                                          
                                          <div class="control-group">
                                          <label class="control-label">Status</label>
                                          <div class="controls">
                                            <?php echo form_dropdown('task_status',$task_status_list,$tskfollowup["task_status"],'id="task_status"');?>
                                          </div>
                                       </div>                            
                                         
                                         <div class="control-group">
                                          <label class="control-label">Priority</label>
                                          <div class="controls">
                                            <?php echo form_dropdown('task_priority',  $task_priority_list,$tskfollowup["task_priority"],'id="task_priority"');?>
                                          </div>
                                       </div>
                                    
                                    <div class="control-group">
                                          <label class="control-label">Assign</label>
                                          <div class="controls">
                                            <?php echo form_dropdown('assigned_to',  $task_team,$tskfollowup["assigned_to"],'id="assigned_to"');?>
                                          </div>
                                       </div>
                                       
                                 <div class="control-group">
                                 <label class="control-label">Active</label>
                                 <div class="controls">
                                    <label class="radio">
                                    <div class="radio" id="uniform-undefined"><span <?php if($tskfollowup["active"]==1){ ?>class="checked" <?php } ?>><input type="radio" name="active" value="1" <?php if($tskfollowup["active"]==1){ ?> checked="checked" <?php } ?> style="opacity: 0;"></span></div>
                                    Open
                                    </label>
                                    <label class="radio">
                                    <div class="radio" id="uniform-undefined"><span <?php if($tskfollowup["active"]==0){ ?>class="checked" <?php } ?> ><input type="radio" name="active" value="0" <?php if($tskfollowup["active"]==0){ ?> checked="checked" <?php } ?>  style="opacity: 0;"></span></div>
                                    Closed
                                    </label>  
                                 </div>
                              </div>     
                                     
                         <div class="form-actions">
                               <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                               <button type="button" class="btn">Cancel</button>
                          </div>
                                       
                                       
                                   </form>
									
								</div>
							</div>
<script type="text/javascript">
<?php if($this->input->get("edit") == 1 ){?>
document.getElementById('editformdiv').scrollIntoView(true);
<?php } ?>	
function validate()
{
	if($('#fl_date').val()=='')
	{
		alert('Please enter date');
		$('#fl_date').focus();
		return false;
	}
	if($('#fl_title').val()=='')
	{
		alert('Please enter followup title');
		$('#fl_title').focus();
		return false;
	}
	if($('#fl_desc').val()=='')
	{
		alert('Please enter description');
		$('#fl_desc').focus();
		return false;
	}
	if($('#project_folder').val()==0)
	{
		alert('Please select project folder');
		$('#project_folder').focus();
		return false;
	}
	if($('#dev_status_id').val()==0)
	{
		alert('Please select development status');
		$('#dev_status_id').focus();
		return false;
	}
	return true;
}
/*var $j=jQuery.noConflict();*/
$(document).ready(function(){
	
	$('.date-picker').datepicker();
	
});
function DeleteFollowup(id)
{
	
	$.ajax({
					url: "<?php echo $this->config->site_url();?>/tasks/delete_followup",	
					type: "POST",	
					data: "id="+id,	
					cache: false,
					success: function (data) {
						$("#followup-"+id).remove();
						alert("Record Deleted");
					}	
					});
				
}
</script>					
				</div>
				<!-- END PAGE CONTENT-->
		  </div>
			<!-- END PAGE CONTAINER-->		
	  </div>
		<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
