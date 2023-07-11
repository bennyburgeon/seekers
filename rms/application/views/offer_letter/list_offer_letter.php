<style>

th{
	font-weight:bold; font-family:Verdana, Geneva, sans-serif; 
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>
<?php if($this->input->get('ins')==1){?>  

<div class="alert alert-success">
				<button class="close" data-dismiss="alert">�</button>
				<strong>Success!</strong> record added successfully.
</div>
<?php } ?> 

<?php if($this->input->get('update')==1){?>  
 <div class="alert alert-success">
				<button class="close" data-dismiss="alert">�</button>
				<strong>Success!</strong> record updated successfully.
</div>
<?php } ?>  
             
<?php if($this->input->get('del')==1){?> 
		<div class="alert alert-success">
				<button class="close" data-dismiss="alert">�</button>
				<strong>record deleted..</strong>
			</div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/job_apps/multidelete?rows=<?php echo $rows;?>" >

<div class="right-btns">
<?php /*?><a href="<?php echo base_url();?>index.php/company/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a><?php */?>
</div>

        <table class="tool-table">
            <tbody>
                <form id="searchForm">
                    <tr>
                        <td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Job Title " value="<?php echo $searchterm != '' ? $searchterm: '' ;?>" style="width: 185px;"></td>
                        
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
    	
		<?php /*?><th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th><?php */?>
		<th><a href="<?php echo $this->config->site_url()?>/jobs?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>
        &rows=<?php echo $rows;?>">Company Name</a></th>
        <th>Job Title</th>	
		<th>Candidate Name</th>
		<th>Offer Date</th>
        <th>Status</th>
        		
	</tr>
 </thead>
 <tbody>

  	<?php 
	if($records!=NULL)
	{
		foreach($records as $result){ ?>
                        
		<tr class="odd gradeX">
		    <?php /*?><td>
              <div class="checker">
                <span>
                    <input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['candidate_id']?>" >
                </span>
              </div>
        	</td><?php */?>
            <td><?php echo $result['company_name']?></td>
			<td><?php echo $result['job_title']?></td>
            <td><?php echo $result['first_name'].' '.$result['last_name']?></td>
            <td><?php echo date("d-m-Y", strtotime($result['offer_date']));?></td>
            <td><?php echo $result['offer_letter'];?></td>
            
           <?php /*?><td>
              <a href="" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
                        
             <a href="" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
              <a href="" class="views" title="Manage Job"><img src="<?php echo base_url('assets/images/follows.png');?>"></a>
           
           </td><?php */?>
	</tr>

	<?php
	}}else{?>
        <tr>
            <td colspan="9" align="center">
                No Records Founds!!
            </td>
        </tr>
	<?php } ?>
		
</tbody>

</table>
<?php echo $pagination; ?>
</form>                           



<div class="sep-bar">

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
		window.location.href = '<?php echo $this->config->site_url();?>/offerletters?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/offerletters?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/offerletters?limit='+limits;
	});
});
</script>
