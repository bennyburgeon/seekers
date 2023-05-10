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
<div class="col-sm-12 pages">
<span>
<a href="<?php echo $this->config->site_url()?>/dashboard">Home</a></span> / <span>Tickets</span>
</span>
</div>
</div>

<?php if($this->input->get('ins')==1){?>                 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>record added successfully.
</div>
<?php } ?>

<?php if($this->input->get('del')==1){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>record deleted..</strong>
</div>
<?php }?>

<?php if($this->input->get('upd')==1){?>  
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>record updated successfully.
</div>
<?php }?>

<?php if($this->input->get('status')==1){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>Status changed successfully..
</div>
<?php } ?> 

<?php if($this->input->get('del')==2){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Error!! <?php echo $_SESSION['related_module'] ?> exists under property</strong>
</div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-2.png');?>" alt=""/><h3><?php echo $page_head;?></h3></div>
<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/tickets/delete?rows=<?php echo $rows;?>" >

<div class="right-btns">
<a href="<?php echo base_url();?>index.php/tickets/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
</div>

<table class="tool-table">
<tbody>
<form id="searchForm">
<tr>
<td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Tickets" style="width: 185px;"></td>

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
<th><input name="" type="checkbox" value="" id="selectall"></th>
<th>
<a href="<?php echo $this->config->site_url();?>/tickets?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';}?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Title</a>
</th>

    <th>Description</th>
    <th>Date </th>
    <!--<th>Time</th>-->
    <th>Status</th>
    <th>Priority</th>
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
			<td align="center"><input type="checkbox" name="checkbox[]"  class="checkboxes" value="<?php echo $result['ticket_id']?>" ></td>
                                    <td><?php echo $result['ticket_title']?></td>
                                    <td><?php echo substr($result['ticket_description'],0,50);?></td>
                                    <td><?php echo $result['ticket_date']?></td>
                                    <?php /*?><td><?php echo $result['ticket_time']?></td><?php */?>
                                    <td><?php echo $result['ticket_status_name']?></td>
                                    <td><?php echo $result['ticket_priority_name']?></td>
                                    <td>
                                    
                                    <?php if($result['status']==1){?>
	   	                                <a class="btn btn-xs blue-hoki green" href="<?php echo $this->config->site_url();?>/tickets/changestat/<?php echo $result['ticket_id']?>?stat=0">Active</a>
                                    <?php } ?>
                                    
    								<?php if($result['status']==0){?>
                                    <a class="btn btn-xs blue-hoki red" href="<?php echo $this->config->site_url();?>/tickets/changestat/<?php echo $result['ticket_id']?>?stat=1">Disabled</a>
                                   <?php } ?>
            <td>
            <a href="<?php  echo $this->config->site_url();?>/tickets/followup/<?php echo $result['ticket_id']?>" class="views" title="Follow"><img src="<?php echo base_url('assets/images/follows.png');?>"></a>

			<a href="<?php echo base_url();?>index.php/tickets/edit/<?php echo $result['ticket_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
			<a href="<?php echo base_url();?>index.php/tickets/delete/<?php echo $result['ticket_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>

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
<?php //echo $pagination; ?>
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
		window.location.href = '<?php echo $this->config->site_url();?>/tickets?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/tickets?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/tickets?limit='+limits;
	});
	
});
</script>
<script>
 jQuery('#group-checkable').change(function () {
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
jQuery('#alldelete').click(function () {
	var totcount=0;
	$("#sample_1 .checkboxes").each(function(){
		if (this.checked) {
		 totcount=1;
		}
	});
	
	if(totcount==0){
		alert('Please make a selection');
		return false;
	}else{
	if (confirm("Are you sure to delete this row ?") == true) {
		var arr=[];

		$.each($("input[id='delete_rec']:checked"),function(){
			arr.push($(this).val());
		});
		
		$.ajax({
			  type: 'POST',
			  url: '<?php  echo $this->config->site_url();?>/tickets/delete',
			  data: { delete_rec:arr},
			  dataType: 'json',
			  beforeSend:function(){
			  },
			  success:function(data)
			  {
					oTable.fnDeleteRow(nRow);
					//alert("Deleted!)");	
					window.location="<?php  echo $this->config->site_url();?>/tickets/?del=1";					  
			  },
			  error:function(){
				window.location="<?php  echo $this->config->site_url();?>/tickets/?del=1";
				//alert('Problem with server. Pelase try again');.
				oTable.fnDeleteRow(nRow);
				return true;
				
			  }
			});	
		}
	}
		
		
});
			
</script>
