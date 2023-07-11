<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?></h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

    
      <form action="<?php echo $this->config->site_url();?>/compliantpriority/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
      								          <?php echo form_hidden('ticket_priority_id',$formdata['ticket_priority_id']);?>

    <tr>
    <td>Compliant Priority Name</td>
    <td> <input type="text" id="ticket_priority_name" name="ticket_priority_name" value="<?php echo $formdata['ticket_priority_name'];?>" placeholder="Enter Compliant Priority Name" class="form-control" /></td>
    </tr>
    <tr>
    <td>Status</td>
    <td>
        <label class="radio-inline">
        <input type="radio" name="status" id="status" value="1" <?php if($formdata['status'] ==1){?> checked <?php } ?> >Active</label>
        <label class="radio-inline">
        <input type="radio" name="status" id="status" value="0" <?php if($formdata['status'] ==0){?> checked <?php } ?> >Inactive</label>
</td>
    </tr>
   
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/compliantpriority" class="attach-subs subs">Cancel</a>
    </span>
    </td>
    </tr>
    </form>

</tbody>
</table>
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<script>
function validate()
{	
	if($('#ticket_priority_name').val()=='')
	{
		alert('Please enter Priority Name');
		$('#ticket_priority_name').focus();
		return false;
	}
   
	return true;
}


</script>		

