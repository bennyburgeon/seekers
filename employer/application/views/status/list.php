<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?> </li>
      </ul>
</div>
<?php  if($this->input->get('csv')==1){ ?> 
    <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>csv file uploaded successfully.
    </div>
<?php }?>
<?php if($this->input->get('upload_err')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>upload failed.</strong>
    </div>
<?php }?>
<?php if($this->input->get('file_type_err')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>support csv file only.</strong>
    </div>
<?php }?>
 <?php if($this->input->get('ins')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Sucess !</strong>record added successfully.
                </div>
                 <?php } 
                 if($this->input->get('multi')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Records !</strong>record added successfully.
                </div>
                
              <?php } 
			   if($this->input->get('del')==1){?> 
			   <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>record deleted..</strong>
                </div>
			         <?php }
					 
					 if($this->input->get('upd')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Sucess !</strong>record updated successfully.
                </div>
              <?php }?>
				

<div class="row">
<div class="col-sm-12">


<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/status/multidelete?rows=<?php echo $rows;?>" >

<div class="right-btns">
<a href="<?php echo base_url();?>index.php/status/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
</div>

<table class="tool-table">
<tbody>
<form id="searchForm">
<tr>
<td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Status Name" style="width: 185px;"></td>

<td>
<a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
</td>
</tr>
<!--</form>-->
</tbody>
</table>
<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit1">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
</div>
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>

<div style="clear:both;"></div>
<table class="tool-table new">
<thead>
							<tr role="row" class="heading">
                        <th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                       <th> <a href="<?php echo $this->config->site_url()?>/status?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Status Name</a></th>
                        <th>Staus</th>
                        <th>Icon</th>
                        <th>Image</th>
                        <th>Order</th>
                        <th>Actions</th>
							</tr>
							</thead>
                            
                    <tbody>
                    
        <?php 		if($records!=NULL)
		  {
foreach($records as $result){ ?>
                    
                    <tr class="odd gradeX">
                    
                   <td align="center"><input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['status_id']?>" >
</td>
                  
                    <td>
                    <?php echo $result["status_name"]; ?>
                    </td>
                    
                    <td>
                    <?php if($result['status']==1){?>
                    <a class="label label-sm label-success" href="#">Active</a>
                    <?php } ?>
                    
                    <?php if($result['status']==0){?>
                    <a class="label label-sm label-danger" href="#">Inactive</a>
                    <?php } ?>
                    </a>
                    </td>
                    
                    <td>
                    <?php if($result['icon_file_name']!=''){?>
                    <img src="<?php echo base_url();?>upload/status/<?php echo $result['icon_file_name'];?>" >
                    <?php }
					else{?>
                    <img src="<?php echo base_url();?>upload/status/no_image.png" >
					<?php }
					?>
                    </td>
                    <td>
                    <?php if($result['icon_inactive']!=''){?>
                    <img src="<?php echo base_url();?>upload/status/<?php echo $result['icon_inactive'];?>" >
                    <?php }
					else{?>
                    <img src="<?php echo base_url();?>upload/status/no_image.png" >
					<?php }
					?>
                    </td>
                    
                    <td>
                    <?php echo $result["status_order"]; ?>
                    </td>
                    
                    
                    <td>
                    <a href="<?php echo base_url();?>index.php/status/edit/<?php echo $result['status_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
                    
                    <a href="<?php echo base_url();?>index.php/status/delete/<?php echo $result['status_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
                    
                    </td>
                    
                    </tr>
                    
                <?php
		}}else{?>
					<tr>
						<td colspan="8" align="center">
							No Records Founds!!
						</td>
					</tr>
		   <?php } ?>
                    
                    </tbody>

</table>
</form>                           



<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit2">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
</div>
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>


<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
</div>
<script>

$(document).ready(function()
{
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$('#selectall').click(function(event)
	{  
		if(this.checked) 
		{ 
		$('.checkboxes').each(function() { 
		this.checked = true; 
		});
		}else{
		$('.checkboxes').each(function() { 
		this.checked = false;  
		});        
		}
	});
	
	$("#deleteall").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a data to delete.");
		return false;
		}
		if(count_checked >0) {
		if(confirm('Are You Sure?Delete Multiple Item')){
		$('#form1').submit();
		}
		}
	});
	$("#search").click(function(){
		var searchterm = $('#search_term').val(); 
		var rows = '<?php echo $rows;?>';
		window.location.href = '<?php echo $this->config->site_url();?>/status?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/status?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/status?limit='+limits;
	});
	
});
</script>
