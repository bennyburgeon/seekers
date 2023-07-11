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
					<a href="<?php echo $this->config->site_url()?>">Home</a>
				</li>
				<li>
					<a href="<?php echo $this->config->site_url()?>/my_company"><?php echo $module_head?></a>
					
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
                        <form role="form" action="<?php echo $this->config->site_url();?>/my_company/import_csv"  enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate1();"> 
                        <?php if(validation_errors()!=''){?> 
                       <div class="alert alert-danger alert-dismissable">                            
                            <strong>Error !</strong> <?php echo strip_tags(validation_errors()); ?>
                        </div>
			        	<? } ?>
                        <div class="alert alert-danger alert-dismissable display-hide" id="group_error_show">                            
                           
                        </div>
                       <div class="form-body">  
                                                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Select CSV File</label>
                                    <input type="file" placeholder="Enter File Name"  name="userfile" id="csv_file_name" >	
                                    <input type="hidden" name="csv" value="1">									
                                </div>                                
                                
                            </div>
                            
                           
                               
                     	<div class="form-actions">
                                <button class="btn blue" type="submit">Submit</button>
                                <button class="btn default" type="button" onClick="window.location='<?php echo $this->config->site_url();?>/my_company';">Cancel</button>
                               
                            </div>
                            </form>
                            
						</div>
					</div>
				<div class="col-md-3"></div>	
			</div>
			
			<!-- END PAGE CONTENT INNER -->
		</div>
	</div>
    </div>
	<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<script>
    function validate1()
{
	if($('#csv_file_name').val()=='')
	{
		$('.alert').css('display','none');
		$('#group_error_show').css('display','block');
		$('#group_error_show').html("<strong>Error ! </strong> Select file");
		$('#user_grp_name').focus();
		return false;
	}
	return true;
}
</script>
