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
							Files				<small>View / Edit Files</small>
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="<?php echo $this->config->site_url();?>dashboard">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
                            <li><a href="<?php echo $this->config->site_url();?>mytasks/files/<?php echo $tskid; ?>">Files</a>
                            <i class="icon-angle-right"></i>
                            </li>
							<li><a href="#">Edit Files</a>
                            <i class="icon-angle-right"></i>
                            </li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div id="page" class="dashboard">
					<!-- BEGIN OVERVIEW STATISTIC BARS-->
					
					<!-- END OVERVIEW STATISTIC BARS-->
					
					<!-- BEGIN OVERVIEW STATISTIC BLOCKS-->
					
					<!-- END OVERVIEW STATISTIC BLOCKS-->
					
					<div class="row-fluid">
            <?php if(validation_errors()!=''){?> 
              
                <div class="alert alert-error">
                    <button class="close" data-dismiss="alert">×</button>
                    <strong><?php echo validation_errors(); ?></strong>
                </div>
	         <? } ?> 
						<div class="span12">
                     <div class="tabbable tabbable-custom boxless">
                        <ul class="nav nav-tabs">
                           <li><a href="<?php echo $this->config->site_url();?>mytasks/files/<?php echo $tskid; ?>">View Files</a></li>
                           <li class="active"><a>Edit Files</a></li>
                        </ul>
                        <div class="tab-content">
                        	<div class="span8 responsive" data-tablet="span12 fix-margin" data-desktop="span8">
                        	<div class="widget">
                                 <div class="widget-body form">
                                    <!-- BEGIN FORM-->
                                    <form action="<?php echo $this->config->site_url();?>mytasks/updatefile/" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();"> 
                                    <?php echo form_hidden('task_id', $tskid);
										  echo form_hidden('file_id', $formdata['file_id']); 	
									 ?>
                                      <div class="control-group">
                                          <label class="control-label">Title</label>
                                          <div class="controls">
                                            <input type="text" id="file_title" name="file_title" value="<?php echo $formdata['file_title'];?>" placeholder="" class="span12" />
                                          </div>
                                       </div>
                                     
                                     
                                     <div class="control-group">
                                         <label class="control-label">File</label>
                                         <div class="controls">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                               <div class="input-append">
                                                  <div class="uneditable-input">
                                                     <i class="icon-file fileupload-exists"></i> 
                                                     <span class="fileupload-preview"></span>
                                                  </div>
                                                  <span class="btn btn-file">
                                                  <span class="fileupload-new">Select file</span>
                                                  <span class="fileupload-exists">Change</span>
                                                  
                                                  <?php echo form_upload(array('name'=>'file_path','class'=>'default'));?>
                                                  </span>
                                                  <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                               </div>
                                            </div>
                                         </div>
                                      </div>
                                      
                                     <div class="control-group">
                                          <label class="control-label">Description</label>
                                          <div class="controls">
                                           <textarea class="span12 ckeditor m-wrap" id="file_desc" name="file_desc" rows="6"><?php echo $formdata["file_desc"]; ?></textarea>
                                          </div>
                                       </div> 
                                       
                                    
									  <div class="control-group">
                                         <label class="control-label">Users</label>
                                         <div class="controls">
                                           <?php echo form_multiselect('user_id[]',  $task_team_list, $file_users,'class="input-medium"');?>
                                        </div>
                                      </div>
                                      
                                  <div class="control-group">
                                 <label class="control-label">Status</label>
                                 <div class="controls">
                                    <label class="radio">
                                    <div class="radio" id="uniform-undefined"><span class="checked"><input type="radio" name="active" value="1" <?php echo ($formdata["active"]==1)?'checked="checked"' : '';  ?> style="opacity: 0;"></span></div>
                                    Active
                                    </label>
                                    <label class="radio">
                                    <div class="radio" id="uniform-undefined"><span class="" ><input type="radio" name="active" value="0" <?php echo ($formdata["active"]==0)?'checked="checked"' : '';  ?>  style="opacity: 0;"></span></div>
                                    Inactive
                                    </label>  
                                 </div>
                              </div>
                                      
                                      <div class="form-actions">
                                        <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
                                          <button type="button" class="btn">Cancel</button>
                                       </div>
                                       
                                       
                                   </form>
                                    <!-- END FORM-->                
                                 </div>
                           </div>
                        </div>
                        
                        
                        </div>
                     </div>
                  </div>
						
					</div>
<script>

function validate()
{
	if($('#gallery_name').val()=='')
	{
		alert('Please enter caetgory name');
		$('#gallery_name').focus();
		return false;
	}
	return true;
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
