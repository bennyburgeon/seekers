<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>
<?php //if(isset($ins) && $ins==1){?>
<?php if($this->input->get('ins')==1){?>  

<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> record added successfully.
</div>
<?php } ?> 
<?php if($this->input->get('update')==1){?>  
 <div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> record updated successfully.
</div>
<?php } ?>               
<?php if($this->input->get('del')==1){?> 
		<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>record(s) deleted..</strong>
			</div>
<?php } ?>                             
				

<div class="row">
<div class="col-sm-12">


<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">


<div class="right-btns">
<a href="<?php echo $this->config->site_url();?>/designation/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>


<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>


</div>

<table class="tool-table">
<tbody>
<form  method="get" action="<?php echo $this->config->site_url();?>/designation" name="frm_search" id="frm_search">

<tr>
<td><input class="form-control" type="text" name="searchterm" value="<?php echo $searchterm?>" id="search_term" placeholder="Search Desigantion" style="width: 185px;"></td>
<td><?php echo form_dropdown('job_cat_id', $industry_list , $job_cat_id,'style="width:200px;" class="form-control"  id="job_cat_id" ');?></td>
<td><?php echo form_dropdown('func_id', $func_list , $func_id,'style="width:200px;" class="form-control"  id="func_id" ');?></td>
<td>
<a href="#"  class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="btn_search"></a> 
</td>
<td>
<a href="<?php echo $this->config->site_url();?>/designation" class="btn btn-primary btn-xs">Clear Search</a>
</td>



</tr>
</form>

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

<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/designation/delete?rows=<?php echo $rows;?>" >

<table class="tool-table new">
<thead>
								<tr role="row" class="heading">
<th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                                       
                                        
                                         <th><a href="<?php echo $this->config->site_url()?>/designation?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>&func_id=<?php echo $func_id;?>&job_cat_id=<?php echo $job_cat_id;?>">Designation</a></th>
                                         <th>Function</th>
                                    <th>Edit	</th>
								</tr>
</thead>
<tbody>

 <?php 		if($records!=NULL)
		  {
foreach($records as $result){ ?>
<tr class="odd gradeX">
                        <td>
                        <div class="checker">
                        <span>
                        <input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['desig_id']?>" >
                        </span>
                        </div>
                        </td>
                         <td><?php echo $result['desig_name']?></td>
                        
                         <td><?php echo $result['total_count']?></td>
                         
                        <td>
                        <a href="<?php echo $this->config->site_url();?>/designation/edit/<?php echo $result['desig_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
                        
                        <a href="<?php echo $this->config->site_url();?>/designation/delete/<?php echo $result['desig_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
                      
                        
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


	$('#btn_search').click(function(event)
	{ 
		$('#frm_search').submit();
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
	
	
});
</script>


<script type="text/javascript">
	$('#job_cat_id').change(function() {
		
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');
			
	//if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/designation/get_functional_by_industry/',
		  data: { job_cat_id: $('#job_cat_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#func_id').html('');
				  $.each(data.func_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#func_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#func_id').append('<option value="'+ index +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Select Functional Area</option');
		  }
		});	
});
</script>