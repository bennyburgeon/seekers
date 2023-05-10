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
<a href="<?php echo $this->config->site_url()?>/dashboard">Home</a></span> / <span>Specialisation</span>
</span>
</div>
</div>

<?php if($this->input->get('ins')==1){?>  

<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>record added successfully.
</div>

<?php } 
if($this->input->get('del')==1){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>record deleted..</strong>
</div>
<?php }

if($this->input->get('update')==1){?>  

<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>record updated successfully.
</div>
<?php }?>


<?php if($this->session->flashdata('pic')) { ?>
<div class="alert alert-success">
<script>alert("please select anyone");</script>
</div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-2.png');?>" alt=""/><h3><?php echo $page_head;?></h3></div>
<div class="table-tech specs">



<div class="right-btns">
<a href="<?php echo base_url();?>index.php/specialisation/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
</div>

<table class="tool-table">
<tbody>
<tr><td colspan="2"><form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/specialisation/?rows=<?php echo $rows;?>" >
<tr>
<td>&nbsp;
  <input class="form-control" type="text" value="<?php echo $searchterm;?>" name="searchterm" id="search_term" placeholder="Search Specialisation " style="width: 185px;" />
</td>

<td><?php echo form_dropdown('course_id',$course, $course_id,' style="width=300px;" id="course_id"');?></td>
<td>
<input type="submit" name="submit" value="Search"/></td>
</tr>
<!--</form>-->
<tr><td colspan="2"></tbody>
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
</form>
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/specialisation/multidelete?rows=<?php echo $rows;?>" >
<div style="clear:both;"></div>
<table class="tool-table new">
<thead>
<tr>
<th><input name="" type="checkbox" value="" id="selectall"></th>
<th>
<a href="<?php echo $this->config->site_url();?>/specialisation?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';}?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Specialisation</a></th>

 <th>Course</th>
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
			<td align="center"><input type="checkbox" name="checkbox[]"  class="checkboxes" value="<?php echo $result['spcl_id']?>" ></td>
                            <td><?php echo $result['spcl_name']?></td>
                            <td><?php echo $result['course_name']?></td>
            <td>
			<a href="<?php echo base_url();?>index.php/specialisation/edit/<?php echo $result['spcl_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
			<a href="<?php echo base_url();?>index.php/specialisation/delete/<?php echo $result['spcl_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>

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
		window.location.href = '<?php echo $this->config->site_url();?>/specialisation?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/specialisation?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/specialisation?limit='+limits;
	});
	
});
</script>
