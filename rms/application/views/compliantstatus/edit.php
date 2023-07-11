<div class="clearfix">
</div>
<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
	<div class="page-head">
		<div class="container">
			<!-- BEGIN PAGE TITLE -->
			
			<!-- END PAGE TITLE -->
            
			
			<!-- END PAGE TITLE -->
              <?php echo $menu_flow;?>
			
		</div>
	</div>
	<!-- END PAGE HEAD -->
	<!-- BEGIN PAGE CONTENT -->
		<div class="page-content">
        	<div class="container">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
            <!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="<?php echo $this->config->site_url()?>/compliantstatus"><?php echo $module_head?></a>
					<i class="fa fa-circle"></i>
				</li>
				<li class="active">
					<?php echo $module_action?>
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			
			
			<!-- BEGIN PAGE CONTENT INNER -->
			<div class="row">
            <div class="col-md-3"></div>
				<div class="col-md-6 ">
                               
	          <!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet light">
                    
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase"><?php echo $module_action?></span>
							</div>
							
						</div>
                        
						<div class="portlet-body form">
						<form action="<?php echo $this->config->site_url();?>/compliantstatus/update" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();">
                         
							 <?php if(validation_errors()!=''){?> 
                                  <div class="alert alert-danger alert-dismissable">                            
                                     <strong>Error !</strong> <?php echo strip_tags(validation_errors()); ?>
                                </div>
			        	      <? } ?>
			        	       <div class="alert alert-danger alert-dismissable display-hide" id="group_error_show">                            
                           
                               </div>
							
								<div class="form-body">
									
								          <?php echo form_hidden('ticket_status_id',$formdata['ticket_status_id']);?>
							  <div class="form-group">
										<label for="exampleInputEmail1">Compliant Status  Name</label>
                                         
                                            <input type="text" id="ticket_status_name" name="ticket_status_name" value="<?php echo $formdata['ticket_status_name'];?>" placeholder="" class="form-control" />
                                          
                                       </div>
                              

                                      
                                      <div class="form-actions">
									<button class="btn blue" type="submit">Submit</button>
									<button class="btn default" type="button" onClick="window.location='<?php echo $this->config->site_url();?>/compliantstatus';">Cancel</button></div>
                                   
                                  </div>
                                  </form>
                               </div>
                        
					</div>
                     <!-- END SAMPLE FORM PORTLET-->
				</div>
                
				
			</div>
                </div>                       
                  <!-- END Container-->                      
                  </div>                
                 <!-- END PAGE CONTENT-->
			
		
	</div>
	<!-- END CONTENT -->

<script>
//Add and edit page  

function validate()
{
	if($('#ticket_status_name').val()=='')
	{
		$('.alert').css('display','none');
		$('#group_error_show').css('display','block');
		$('#group_error_show').html("<strong>Error ! </strong> Enter a Status name");
		$('#ticket_status_name').focus();
		return false;
	}
	return true;
}
</script>
				
