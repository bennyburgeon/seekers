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
                    <strong>Records !</strong>record Deleted successfully.
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


<div class="right-btns">
<a href="<?php echo base_url();?>index.php/mytasks/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
</div>

<form id="searchForm" method="get" action="<?php  echo $this->config->site_url();?>/mytasks/">
<table class="tool-table">
<tbody>
<tr>
<td><input class="form-control" type="text" name="searchterm" value="<?php echo $searchterm;?>" id="search_term" placeholder="Search Task Title" style="width: 185px;"></td>
<td><input type="radio" name="date_range" id="date_range" value="1" <?php if($date_range==1)echo 'checked="checked"';?> /> Today's [<?php echo date('d M Y');?>] </td>
<td><input type="radio" name="date_range" id="date_range" value="2" <?php if($date_range==2)echo 'checked="checked"';?> /> Due on -- <?php echo date('d M');?></td>
<td><input type="radio" name="date_range" id="date_range" value="3" <?php if($date_range==3)echo 'checked="checked"';?> /> Upcoming</td>
<td><input type="radio" name="date_range" id="date_range" value="4" <?php if($date_range==4)echo 'checked="checked"';?> /> All</td>
<td>
<input type="submit" class="btn btn-default btn-circle" value="Search" id="submit"></td>
</tr>
<tr>
<td colspan="6"><table width="100%" border="1">
  <tr>
    <td><input type="radio" name="status" id="status" value="1" <?php if($status==1)echo 'checked="checked"';?> />Open</td>
    <td><input type="radio" name="status" id="status" value="2" <?php if($status==2)echo 'checked="checked"';?> />Closed</td>
    <td><input type="radio" name="status" id="status" value="3" <?php if($status==3)echo 'checked="checked"';?> />
    Dropped</td>
    <td><input type="radio" name="status" id="status" value="0" <?php if($status=='0')echo 'checked="checked"';?> />All</td>
    <td>&nbsp;</td>
    <td><input type="radio" name="priority" id="priority" value="1" <?php if($priority==1)echo 'checked="checked"';?> />High</td>
    <td><input type="radio" name="priority" id="priority" value="2" <?php if($priority==2)echo 'checked="checked"';?> />Medium</td>
    <td><input type="radio" name="priority" id="priority" value="3" <?php if($priority==3)echo 'checked="checked"';?> />Low</td>
    <td><input type="radio" name="priority" id="priority" value="0" <?php if($priority==0)echo 'checked="checked"';?> />All</td>
  </tr>
</table></td>

</tr>
<!--</form>-->
</tbody>
</table>
</form>
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/mytasks/multidelete?rows=<?php echo $rows;?>" >
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
    <th> <a href="<?php echo $this->config->site_url()?>/mytasks?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Task Title</a></th>
    <th>Creator</th>
    <th>Priority</th>
    <th>Status</th>
    <th>Start Date</th>
    <th>Due Date</th>
    <th>Due Days</th>
    <th>Last Flp Dt.</th>    
    <th>Followup</th>
    <th>Actions</th>
</tr>
</thead>
                    <tbody>
                    
        <?php 		if($records!=NULL)
		  {
foreach($records as $result){ ?>
                    
                    <tr class="odd gradeX">
                    
                   <td align="center"><input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['task_id']?>" ></td>
    <td>
			<?php if($result['lead_opportunity']==1){echo '<p style="color:#5BEF00">';}?> 
            <?php if($result['lead_opportunity']==2){echo '<p style="color:#2000F3">';}?> 
            <?php if($result['lead_opportunity']==3){echo '<p style="color:#F90000">';}?>
            <?php if($result['lead_opportunity']==0){echo '<p style="color:##000">';}?>
              
              <?php echo $result["task_title"]; ?>
              
              </p>                          
							
	</td>
                            <td ><?php if($result["task_priority_id"]==1){ echo '<font color="#FF0000">'; echo $result["task_priority_name"];echo '</font>';}else{echo $result["creator"];} ?></td>
                            <td ><?php if($result["task_priority_id"]==1){ echo '<font color="#FF0000">'; echo $result["task_priority_name"];echo '</font>';}else{echo $result["task_priority_name"];} ?></td>
                            <td><?php echo $result["task_status_name"]; ?></td>
                            <td><?php if($result["start_date"]!='0000-00-00')echo date('d M',strtotime ($result["start_date"]));else echo 'Na';?></td>
                            <td><?php if($result["due_date"]!='0000-00-00')echo date('d M',strtotime ($result["due_date"]));else echo 'Na';?></td>
                            <td><?php if($result["flp_date_diff"]<0){?><font color="#FF0000"><b><?php echo $result["flp_date_diff"];?></b></font><?php }else{?><?php echo $result["flp_date_diff"];?><?php } ?></td>
                            <td><?php if($result["last_flp_date"]!=''){echo date('d M',strtotime ($result["last_flp_date"]));}else echo 'No Update';?></td>
                            <td><a href="<?php  echo $this->config->site_url();?>/mytasks/followup/<?php echo $result["task_id"]; ?>">Follow-up</a></td>
                    
                               <td>
                    <a href="<?php echo base_url();?>index.php/mytasks/edit/<?php echo $result['task_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
                    <!--
                    <a href="<?php echo base_url();?>index.php/mytasks/delete/<?php echo $result['task_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
                   -->
                   
                      <a class="tooltips" data-original-title="Follow up" href="<?php  echo $this->config->site_url();?>/mytasks/followup/<?php echo $result["task_id"]; ?>"><i class="icon-share-alt"></i></a>
                    
                           
                            <a class="tooltips" data-original-title="Attachments" href="<?php  echo $this->config->site_url();?>/mytasks/files/<?php echo $result["task_id"]; ?>"><i class="icon-folder-open"></i></a>
                            
                            <?php $data_orginal_title = ($result["status"]==1)? 'Open': 'Closed'; 
							$icon_class =($result["status"]==1)? 'icon-ok': 'icon-remove' 
							?>
<a id="<?php echo $result["task_id"]; ?>" onclick="togglestatus(this.id);" class="tooltips" data-original-title="<?php echo $data_orginal_title; ?>"><i class="<?php echo $icon_class; ?>"></i></a>                    </td>
                    </tr>
                    
                <?php
		}}else{?>
					<tr>
						<td colspan="13" align="center">
							No Records Found !!						</td>
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
		window.location.href = '<?php echo $this->config->site_url();?>/mytasks?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/mytasks?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/mytasks?limit='+limits;
	});
	
});
</script>
