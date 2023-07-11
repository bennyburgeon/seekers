<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<div class="sidebar-area inner-pages">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box2 sides">
<h4>About:</h4>
<p>Lorem ipsum dolor sit amet diam nonummy nibh dolore.</p>
<h4>Contact:</h4>
<ul>
<li>Company Name</li>
<li>+97 254 2563 889</li>
<li>214 5454 878</li>
<li>4th Avenue, 2nd Street</li>
<li>somebody@test.com</li>
<li><a href="#">www.website.in</a></li>
<li class="social-p">
<a href="#"><img src="<?php echo base_url('assets/images/p_icon8.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon9.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon10.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon11.png');?>"></a>
</li>
</ul>
</div>

</div>
</div>

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/dasboard">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"><?php echo $page_head;?> </li>
      </ul>
</div>

 <?php if($this->input->get('ins')==1){?>  
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Success!</strong> record added successfully.
                </div>
                
              <?php } ?> 
              <?php if($this->input->get('update')==1){?>  
                 <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                   <strong>Success!</strong> record updated successfully.
                </div>
              <?php } ?> 
              <?php if($this->input->get('del')==1){?> 
               <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong>Delete !</strong> record(s) deleted.
            </div>
			         <?php } ?>  
                     <?php      if($this->input->get('del')==2){?> 
              
						<div class="alert alert-success alert-dismissable">
						<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
						<strong>Error!! <?php echo $_SESSION['related_module'] ?> exists under ticket status</strong>
									</div>
			         <?php } ?>            

                    <?php if($this->input->get('stat')==1){?> 
              
							<div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Status changed successfully..</strong>
									</div>
			         <?php } ?> 


<div class="row">
<div class="col-sm-12">


<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/ticketstatus/delete?rows=<?php echo $rows;?>" >

<div class="right-btns">
<a href="<?php echo base_url();?>index.php/ticketstatus/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
</div>

<table class="tool-table">
<tbody>
<form id="searchForm">
<tr>
<td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Ticketstatus" style="
    width: 185px;
"></td>

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
<tr>
<th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
 <th>
                                    <a href="<?php echo $this->config->site_url();?>/ticketstatus?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';}?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Ticket Status</a></th>
                                    <th>Status</th>
                                   
                                    <th>Actions</th>
							</tr>
</thead>
<tbody>

<?php 
	if($records!=NULL)
						  {
    foreach($records as $result){ 
    ?>
    <tr>
    <td>
	<div class="checker">
    	<span>
    		<input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['ticket_status_id']?>" >
        </span>
	</div>
</td>
    <td><?php echo $result['ticket_status_name']?></td>
     <td>
                                    
									<?php if($result['status']==1){?>
	   	                             <span class="label label-success"> <a href="<?php echo $this->config->site_url();?>/ticketstatus/changestat/<?php echo $result['ticket_status_id']?>?stat=0">Active</a> </span>

                                    <?php } ?>
                                    
    								<?php if($result['status']==0){?>
                                    <span class="label label-danger"> <a href="<?php echo $this->config->site_url();?>/ticketstatus/changestat/<?php echo $result['ticket_status_id']?>?stat=1">Inactive</a> </span>
                                   <?php } ?>

                                    </td>
    
    <td>
    <a href="<?php  echo $this->config->site_url();?>/ticketstatus/edit/<?php echo $result['ticket_status_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
			<a href="<?php  echo $this->config->site_url();?>/ticketstatus/delete/<?php echo $result['ticket_status_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
    </td>
    </tr>
    <?php }
  }else{?>
									<tr>
										<td colspan="8" align="center">
											No Records Founds!!
										</td>
									</tr>
						   <?php } ?>    </tbody>

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
		window.location.href = '<?php echo $this->config->site_url();?>/ticketstatus?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/ticketstatus?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/ticketstatus?limit='+limits;
	});
	
});
</script>
