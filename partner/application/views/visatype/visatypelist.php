<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">


<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>dasboard">Home</a> </li>
        <li class="active">Visatype </li>
      </ul>
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
				

<div class="row">
<div class="col-sm-12">

<span  >
<h5>&nbsp;</h5>
</span>



<span  >
<h5>&nbsp;</h5>
</span>

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>visatype/delete?rows=<?php echo $rows;?>" >


<div class="right-btns">
<a href="<?php echo base_url();?>visatype/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<!-- 
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
-->
</div>

<table class="tool-table">
<tbody>
<form id="searchForm">
<tr>
<td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Visatype" style="
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
                        	 <th width="24">
<div class="checker">#</div>
</th>   
                            <th width="68">
                                    <a href="<?php echo $this->config->site_url();?>visatype?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';}?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Visa Type</a></th>
                          <th width="179" class="head0">Visa Type Description</th>
                            <th width="50" class="head0">Actions</th>
                        </tr>
</thead>
<tbody>
<?php 
$i=0;
				foreach($records as $result){ 
				$i+=1;
			?>
                        <tr>
                        	<td>
	<div class="checker">
    	<span>
    		
            <?php echo $i;?>
            <!-- <input type="checkbox" name="checkbox[]" id="checkbox" value="<?php echo $result['visa_type_id']?>" class="checkboxes"> --> 
            
            
        </span>
	</div>
</td>
                            <td><?php echo $result['visa_type']?></td>
                            <td><?php echo substr($result['visa_desc'],0,50);?></td>
                            <td class="center">
                            
                            <a href="<?php echo base_url();?>visatype/edit/<?php echo $result['visa_type_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
                            <!-- 
			<a href="<?php echo base_url();?>visatype/delete/<?php echo $result['visa_type_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
            -->
                            </td>
                        </tr>
                        
                        <?php
						}
						?>
                        
                        
                        <?php 
						if($total_rows==0){
						?>
                         <tr>
                        <td colspan="4" align="center">No records found</td>
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
		window.location.href = '<?php echo $this->config->site_url();?>visatype?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>visatype?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>visatype?limit='+limits;
	});
	
});
</script>
