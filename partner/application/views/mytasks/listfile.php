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
							Task Files				<small>Manage Files From Here</small>
					  </h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="<?php echo $this->config->site_url();?>dashboard">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="<?php echo $this->config->site_url();?>mytasks/">Tasks</a>
                            <i class="icon-angle-right"></i>
                            </li>
							<li><a href="<?php echo $this->config->site_url();?>mytasks/files/<?php echo $tskid; ?>">Files</a>
                            
                            </li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
				  </div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
              
              <?php if($this->input->get('ins')==1){?>  
                <div class="alert alert-success">
										<button class="close" data-dismiss="alert">×</button>
										<strong>Success!</strong> record added successfully.
			  </div>
              <? } ?> 
              
              <?php if($this->input->get('del')==1){?> 
              
									<div class="alert alert-error">
										<button class="close" data-dismiss="alert">×</button>
										<strong>record deleted..</strong>
									</div>
			         <? } ?>                             
				<div id="page" class="dashboard">
					<!-- BEGIN OVERVIEW STATISTIC BARS-->
					
					<!-- END OVERVIEW STATISTIC BARS-->
					
					<!-- BEGIN OVERVIEW STATISTIC BLOCKS-->
					
					<!-- END OVERVIEW STATISTIC BLOCKS-->
					
					<div class="row-fluid">
                    	
						<div class="span12">
                     <div class="tabbable tabbable-custom boxless">
                        <ul class="nav nav-tabs">
                           <li class="active"><a>View Files</a></li>
                           <li><a href="<?php echo $this->config->site_url();?>mytasks/addfile/?tsk=<?php echo $tskid; ?>" >Add Files</a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                              <div>
                                    <!-- BEGIN FORM-->
						<form action="<?php echo $this->config->site_url();?>mytasks/delete_file" method="post" name="actionfrm">
                         <?php echo form_hidden('task_id', $tskid); ?>
                                   <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                              <thead>
                                 <tr>
                                    <th><input type="checkbox" class="group-checkable" data-set="#sample_editable_1 .checkboxes" />
                                    <a class="icon-remove" href="javascript:;"></a>
                                    <th>File Name</th>
                                   
                                   
                                    <th>Download</th>
                                    <th>Edit</th>
                                 </tr>
                              </thead>
                              <tbody>
                              
            <?php 
				foreach($records as $result){ 
			?>
                              
                                 <tr class="">
                                    <td><input type="checkbox" class="checkboxes" id="delete_rec" name="delete_rec[]" value="<?php echo $result['file_id']?>" /></td>
                                    <td><?php echo $result['file_title']?></td>
                                    
                                    
                                    <td><a target="_blank" href="<?php echo $this->config->item('upload_url').'taskfiles/'.$result['file_path'];?>"><?php echo $result["file_path"]; ?></a></td>
                                    <td><a  href="<?php  echo $this->config->site_url();?>mytasks/editfile/?fl_id=<?php echo $result['file_id']?>&tsk=<?php echo $tskid;  ?>">Edit</a></td>
                                 </tr>
            <?php  } ?>                   
                                 
                              </tbody>
                           </table>
                                    <!-- END FORM--> 
                                 </form>
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
