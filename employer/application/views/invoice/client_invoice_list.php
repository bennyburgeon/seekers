
<?php //echo $company_id;exit; ?><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
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
				<strong>record deleted..</strong>
			</div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">


<div class="right-btns">
<?php /*?><a href="<?php echo base_url();?>index.php/company/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a><?php */?>
<!--<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>-->
</div>

        <table class="tool-table">
            <tbody>
                <form id="searchForm"  method="post" action="<?php echo $this->config->site_url()?>/client_invoice/">
                    <tr>
                         <td style="width:60%;"> <?php echo form_dropdown('company_id',  $company_list,$company_id,'id="company_id"  class="table-group-action-input form-control input-medium"');?></td>
                        
                        <td>
							<input type="submit" id="submit"  value="Search" class="btn btn-primary btn-circle" />
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
    	
<!--		<th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>-->

        <th><a href="<?php echo $this->config->site_url()?>/client_invoice?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&company_id=<?php echo $company_id;?>&rows=<?php echo $rows;?>">Job Title</a></th>
        
        <th>Company Name</th>	
		<th>Candidate Name</th>
		<th>Invoice Date</th>
        <th>Amount</th>
		<th>Payment Status</th>	
       	
	</tr>
 </thead>
 <tbody>

  	<?php 
	if($records!=NULL)
	{
		foreach($records as $result){ ?>
                        
		<tr class="odd gradeX">

            <td><?php echo $result['job_title']?></td>
            <td><?php echo $result['company_name']?></td>
			
            <td><?php echo $result['first_name'].' '.$result['last_name']?></td>
            <td><?php if($result['invoice_date']==0){echo '';}else{ echo date("d-m-Y", strtotime($result['invoice_date']));}?></td>
            <td><?php echo $result['invoice_amount'];?></td>
            <td><?php if($result['invoice_status']==1){ echo "Paid";}else if($result['invoice_status']==2){ echo "Unpaid";}else if($result['invoice_status']==3){echo "Due";}?></td>
            

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


	
	
	
});
</script>
