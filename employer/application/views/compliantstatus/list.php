
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN PAGE HEAD -->
<div class="page-head">
  <div class="container"> 
	<!-- BEGIN PAGE TITLE -->
   
			<!-- END PAGE TITLE -->
              <?php echo $menu_flow;?>
    <!-- END PAGE TITLE --> 
      </div>
</div>
	<!-- BEGIN SIDEBAR 
      
        <!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
		<div class="page-content">
	<div class="page-content-wrapper">
	
			   <div class="container"> 
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			 <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
              <h4 class="modal-title">Delete confirmation</h4>
            </div>
            <div class="modal-body">Do you want to delete selected records ?  </div>
            <div class="modal-footer">
              <button type="button" class="btn blue" onclick="document.actionfrm.submit();">Yes, Delete</button>
              <button type="button" class="btn default" data-dismiss="modal">No, Cancel</button>
            </div>
          </div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

			<!-- BEGIN PAGE HEADER-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN BREADCRUMB-->
					<ul class="page-breadcrumb breadcrumb">
						
						<li>
							
							<a href="<?php echo $this->config->site_url();?>/dashboard">Home</a>
							<i class="fa fa-circle"></i>
						</li>
						<li>
							<a href="#"><?php echo $module_head?></a>
							<i class="fa fa-circle"></i>
						</li>
						<li class="active"> <?php echo $module_action?> </li>
							
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
				  </div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
              
              <div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
              
              <?php if($this->input->get('ins')==1){?>  
                <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Sucess !</strong> one record added.
                </div>
              <? } ?> 
              <?php if($this->input->get('update')==1){?>  
			   <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                   <strong>Success!</strong> record updated successfully.
                </div>
                
              <? } ?>               
              <?php if($this->input->get('del')==1){?> 
                 <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong>Delete !</strong> record(s) deleted.
            </div>
			         <? } ?>  
					   <?php if($this->input->get('stat')==1){?> 
              
							<div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Status changed successfully..</strong>
									</div>
			         <? } ?> 
			         
			         
			                                          
				<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i><span class="caption-subject font-green-sharp bold uppercase"><?php echo $module_head?></span>
							</div>
							  <div class="actions btn-set">
                <button class="btn green-haze btn-circle" onclick="window.location='<?php echo $this->config->site_url();?>/compliantstatus/add';"><i class="fa fa-check"></i> Add</button>
                <button id="alldelete" class="btn red btn-circle"  onclick="return confirmDeleteAll();"><i class="fa fa-check"></i> Delete</button>
              </div>
						</div>
						<div class="portlet-body">
                        			
							<form action="<?php echo $this->config->site_url();?>/compliantstatus/delete" method="post" name="actionfrm">
                                   <table class="table table-striped table-bordered table-hover" id="table_comp_status" >
							          <thead>
							            <tr>
								          <th class="table-checkbox">
									        <input type="checkbox" class="group-checkable" data-set="#table_comp_status .checkboxes"/>
								          </th>
								         <th>ID </th>
                                          <th>Status Name </th>
                                          <th>Status</th>
                                          <th>Edit</th>
                                          <th>Delete</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                              
            <?php 
				foreach($records as $result){ 
			?>
                 <tr class="odd gradeX">
                    <td><input type="checkbox" class="checkboxes" id="delete_rec" name="delete_rec[]" value="<?php echo $result['ticket_status_id']?>" /></td>
                   <td class="center"><?php echo $result['ticket_status_id']; ?></td>
                    <td><?php echo $result['ticket_status_name']?></td>
                     <td>
                                    
									<?php if($result['status']==1){?>
	   	                                <a class="label label-sm label-success" href="<?php echo $this->config->site_url();?>/compliantstatus/changestat/<?php echo $result['ticket_status_id']?>?stat=0">Active</a>
                                    <?php } ?>
                                    
    								<?php if($result['status']==0){?>
                                    <a class="label label-sm label-danger" href="<?php echo $this->config->site_url();?>/compliantstatus/changestat/<?php echo $result['ticket_status_id']?>?stat=1">Inactive</a>
                                   <?php } ?>

                                    </td>
                    <td><a  href="<?php  echo $this->config->site_url();?>/compliantstatus/edit/<?php echo $result['ticket_status_id']?>" class="btn default btn-xs purple"> <i class="fa fa-edit"></i> Edit</a></td>
                    <td><a href="<?php  echo $this->config->site_url();?>/compliantstatus/delete/<?php echo $result['ticket_status_id']?>" onclick="return confirm('Are you sure you want to delete?')"class="btn btn-xs red"> <i class="fa fa-trash-o"></i> Delete</a></td>
                 </tr>
            <?php  } ?>                   
                              </tbody>
                           </table>
                   <!-- END FORM--> 
                             </form>
                              </div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
			
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	</div>
	<!-- END CONTENT -->
	<script>
		function confirmDelete(id)
{     bootbox.confirm("Are you sure you want to delete ?", function(result) {
        if(result==true){
			window.location=baseUrlQuery+'index.php/compliantstatus/delete/'+id;
           	return true;
		}
      }); 
	  return false;
 }
function confirmDeleteAll()
{     
	
	bootbox.confirm("Are you sure you want to delete ?", function(result) {		
		if(result==true){
			document.actionfrm.submit();
           	return true;
		}
      }); 
	  return false;
 }
//validation scripts//



 var initTableModules = function () {

        var table = $('#table_comp_status');
        // begin first table
        table.dataTable({
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            },{
                "orderable": false
            }],
            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "search": "My search: ",
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper = jQuery('#sample_1_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    }





	</script>

