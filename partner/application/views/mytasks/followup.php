  
        <link rel="stylesheet" href="<?php echo base_url();?>/assets/css/min.css">
        <link href="http://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/example1/colorbox.min.css" rel="stylesheet"/>
        <script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

        <script src="<?php //echo base_url();?>/assets/css/jquery-2.1.1.min.js"/>
        <script src="<?php echo base_url();?>/assets/css/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>/assets/css/jquery.colorbox-min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css"> <!-- for date picker -->        


<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
		 
		<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog"> <!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
			  <div class="toggler-close">
				</div>
</div>
			<!-- END STYLE CUSTOMIZER -->

			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					
					<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active">Followup Tickets</li>
      </ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
			<!-- END PAGE HEADER-->
              
              <?php if($this->input->get('ins')==1){?>  
                <div class="alert alert-success">
										<button class="close" data-dismiss="alert">×</button>
										<strong>Success!</strong> record added successfully.
			  </div>
              <?php } ?> 
              <?php if($this->input->get('update')==1){?>  
                <div class="alert alert-success">
										<button class="close" data-dismiss="alert">×</button>
										<strong>Success!</strong> record updated successfully.
			  </div>
              <?php } ?>               
              <?php if($this->input->get('del')==1){?> 
              
									<div class="alert alert-error">
										<button class="close" data-dismiss="alert">×</button>
										<strong>record deleted..</strong>
									</div>
			         <?php } ?>  
					 <div class="row">
				<div class="col-md-6">
					<!-- BEGIN SAMPLE TABLE PORTLET-->
					<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								Task Details</div>
							<div class="tools">
								<a class="collapse" href="javascript:;">
								</a>
								<a class="config" data-toggle="modal" href="#portlet-config">
								</a>
								<a class="reload" href="javascript:;">
								</a>
								<a class="remove" href="javascript:;">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table  border="0" class="table table-striped table-hover table-bordered">
                                  <tr>
                                    <td>Task ID</td>
                                    <td><?php echo $task_details['task_id'] ?></td>
                                  </tr>
                                  <tr>
                                    <td>Task Title</td>
                                    <td><?php echo $task_details['task_title'] ?></td>
                                  </tr>
                                  <tr>
                                    <td>Task Description</td>
                                    <td><?php echo $task_details['task_desc'] ?></td>
                                  </tr>
                                  <tr>
                                    <td>Status</td>
                                    <td><?php echo $task_details['task_status_name'] ?></td>
                                  </tr>
                                  <tr>
                                    <td>Priority</td>
                                    <td><?php echo $task_details['task_priority_name'] ?></td>
                                  </tr>
                                </table>
						  </div>
						</div>
					</div>
					<!-- END SAMPLE TABLE PORTLET-->

<div class="tab-content">
					<div id="tab_0" class="tab-pane active">
					<div class="portlet green box">
                    
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i> Add Followup 
							</div>
							<div class="tools">
								<a class="collapse" href="">
								</a>
								<a href="#portlet-config" data-toggle="modal" class="config">
								</a>
								<a class="reload" href="">
								</a>
								<a class="remove" href="">
								</a>
							</div>
						</div>
                        <div class="portlet-body form">
				 <form action="<?php echo $this->config->site_url()?>mytasks/addfllowup/<?php echo $task_details['task_id'];?>" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmadd" name="frmadd" onSubmit="return validate();">
	
    <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $task_details['candidate_id'];?>" />
     <input type="hidden" name="task_id" id="task_id" value="<?php echo $task_details['task_id'];?>" />
     
   <div id="result"></div>
   <div id="deletemessage"></div>	
              

				 			  <div class="form-group">
                                          <label class="col-md-3 control-label">Title</label>
                                   <div class="col-md-4">
                                    <input type="text" id="title" name="title" value=""  placeholder="Enter Title" class="form-control" />
                                  </div>
                                 </div>
                                <div class="form-group">
                                          <label class="col-md-3 control-label">Description</label>
                                   <div class="col-md-7">
                                    <textarea class="form-control ckeditor m-wrap" name="description" rows="6" id="description"></textarea>
                                  </div>
                                 </div>


								<div class="form-group">
                                          <label class="col-md-3 control-label">Priority</label>
                                  <div class="col-md-4">
                                    <?php echo form_dropdown('task_priority_id',  $task_priority_list,$task_details['task_priority_id'],'id="task_priority_id"  class="table-group-action-input form-control input-medium"');?>
                                  </div>
                                 </div>
                                 

                                <div class="form-group">
                                          <label class="col-md-3 control-label">Status</label>
                                  <div class="col-md-4">
                                    <?php echo form_dropdown('task_status_id',  $task_status_list,$task_details['task_status_id'],'id="task_status_id"  class="table-group-action-input form-control input-medium"');?>
                                  </div>
                                 </div>
                                  <div class="form-group">
                                          <label class="col-md-3 control-label">Date</label>
                                  <div class="col-md-4">
								  	<div class="input-icon">
															<i class="fa fa-calendar"></i>
															<input type="text" id="date" name="date" data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" size="16" class="form-control date-picker">
														</div>
                                    
                                    <input name="task_fl_id" type="hidden" id="task_fl_id" value="0" />
                                  </div>
                                 </div>                              

								<div class="form-group">
                                          <label class="col-md-3 control-label">Change Task Date To.</label>
                                  <div class="col-md-4">
								  	<div class="input-icon">
															<i class="fa fa-calendar"></i>
															<input type="text" id="due_date" name="due_date" value="" placeholder="yyyy-mm-dd" size="16" class="form-control date-picker">
														</div>
                                  </div>
                                 </div>
                                 
                                 
								 <div class="form-group">
                                          <label class="col-md-3 control-label">Send Email</label>
                                  <div class="col-md-4">
                                    
                                   <input name="send_mail" type="checkbox" id="send_mail" value="1" />
                                  </div>
                                 </div> 
                                  <div class="form-actions fluid">
										<div class="col-md-offset-3 col-md-9">
											<input type="submit" class="btn btn-success" id="exampleInputPassword2" value="submit">
											
										</div>
									</div> 
                                      </form>                               
                                 

<script type="text/javascript">
		    <!--Followup-->

$(document).ready(function()
{
	$('#due_date').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$('#date').datepicker({
		dateFormat: "yy-mm-dd"
	});	
});	
			
        $(document).ready(function (){
		function task_validate()
		 {
			
			if($('#title').val()=='')
			{
			alert('Please title');
			$('#title').focus();
			return false;
			}
			if($('#description').val()=='')
			{
			alert('Please description');
			$('#description').focus();
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
		
       $("#frmadd").submit(function (e){
        e.preventDefault();
		var url = $(this).attr('action');
        var title=$('#title').val();
        var description=$('#description').val();
        var status=$('#status').val();
		var date=$('#date').val();
		var due_date=$('#due_date').val();
		var task_fl_id=$('#task_fl_id').val();
		var candidate_id=$('#candidate_id').val();
		var task_priority_id=$('#task_priority_id').val();
		var task_status_id=$('#task_status_id').val();		
		var isTaskValid = task_validate();
		if(isTaskValid) {
        $.ajax({
        type:"POST",
        url: url,
        data:{ title:title,
		description:description,
		status:status,
		date:date,
		due_date:due_date,
		candidate_id:candidate_id,
		task_priority_id:task_priority_id,
		task_status_id:task_status_id,
		task_fl_id:task_fl_id},	
        success: function(msg) {
		$("#deletemessage").html('');
        $("#response").append(msg);
		$("#result").html('<div class="alert alert-success"> Successfully Added</div>');
		<!--Text field empty-->
        $('#title').val('');
		$('#description').val('');        }
        });//end Ajax
		}//end Validation
        });//end button click 
        });
			

	function del(id){
		if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+id;
		 $.ajax({
        type:"POST",
        url: '<?php echo $this->config->site_url()?>mytasks/delfllowup',
        data:{ 
        task_fl_id:id,
        },
        success: function(msg) {
		$("#result").html('');
		$('#title').val('');
		$('#description').val('');
        $(row).fadeOut("slow");
		$("#deletemessage").html('<div class="alert alert-success"> Successfully Deleted</div>');
        }
        });//end Ajax
		}
		}


</script>                                    
                               
<!-- END FORM--> 
                                 
                            </div>
                          </div>
                           <div class="tab-pane " id="tab_2">
                              <div class="widget">
                                 
                                 <div class="widget-body form">
                                    <!-- BEGIN FORM-->
                                   
                                    <!-- END FORM-->                
                                 </div>
                              </div>
                           </div>
                          
                       </div>
                     </div>
                                         
				</div>
				<?php if($task_details['username']!=''){?>
				<div class="col-md-6">
					<!-- BEGIN CONDENSED TABLE PORTLET-->
					<div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-picture"></i>Candidate Details
							</div>
							<div class="tools">
								<a class="collapse" href="javascript:;">
								</a>
								<a class="config" data-toggle="modal" href="#portlet-config">
								</a>
								<a class="reload" href="javascript:;">
								</a>
								<a class="remove" href="javascript:;">
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-hover">
								<tbody>
								 <tr>
                                    <th>Candidate Name</th>
                                    <td><?php echo $task_details['first_name'].'&nbsp;'.$task_details['last_name'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Email</th>
                                    <td><?php echo $task_details['username'] ?></td>
                                  </tr>
                                  <tr>
                                    <th>Mobile</th>
                                    <td><?php echo $task_details['mobile'] ?></td>
                                  </tr>
                                  <tr>
                                    <th colspan="2">
                                    <?php if($task_details['candidate_id']!=''){?>
                                    <a href="<?php echo base_url();?>candidates_all/summary/<?php echo $task_details['candidate_id'];?>" target="_blank">Open Candidate Profile</a><?php } ?>
                                    
                                    
                                    
                                    </th>
                                  </tr>
								</tbody>
								</table>
						  </div>
						</div>
					</div>
					<!-- END CONDENSED TABLE PORTLET-->
				</div>
                
                <?php } ?>
                
                                    
                <div class="col-md-6">
					<!-- BEGIN CONDENSED TABLE PORTLET-->
					<div class="portlet box red">
					<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>Followups
							</div>
							<div class="tools">
								<a class="collapse" href="javascript:;">
								</a>
								<a class="config" data-toggle="modal" href="#portlet-config">
								</a>
								<a class="reload" href="javascript:;">
								</a>
								<a class="remove" href="javascript:;">
								</a>
							</div>
						</div>
                        

   
                <table class="table table-hover" id="response">
                <tbody>
                
                <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
                <th>Action</th>
                
                </tr>
               <?php 
				foreach($followup_list as $followup){
				 ?>
                <tr id="tr_<?php echo $followup['task_fl_id'] ?>">
                <td><?php echo $followup['task_fl_title'] ?></td>
                <td><?php echo $followup['task_fl_desc'] ?></td>
                <td><?php echo $followup['task_fl_date'] ?></td>
                <td><?php echo $followup['task_status_name'] ?></td>
                <td><input type="button" id="<?php echo $followup['task_fl_id'] ?>" onClick="del(this.id)" value="Delete"></td>
                
                </tr>
                <?php 
                }
                ?>
                

                </tbody>
               
                </table>
                
				</div>

					<!-- END CONDENSED TABLE PORTLET-->
				</div>
					
					</div>
					
				</div>
				<!-- END PAGE CONTENT-->
		  </div>
			<!-- END PAGE CONTAINER-->		
	  </div>
		<!-- END PAGE -->

	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
