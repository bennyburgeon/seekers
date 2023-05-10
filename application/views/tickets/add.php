<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">
<span>
<a href="<?php echo $this->config->site_url()?>/tickets">Tickets</a></span> / <span>Add Ticket</span></div>
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
<form action="<?php echo $this->config->site_url();?>/tickets/add" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();">

<input type="hidden" name="candidate_id" value="<?php echo $_SESSION['candidate_session'];?>">				
    
                    
<tr>
<td>Name</td>
<td> <input type="text" placeholder="Enter Name" value="<?php echo $formdata["name"] ?>"  name="name" id="name" class="form-control">
</td>
</tr>

<tr>
<td>Email</td>
 <td> <input type="text" id="email" name="email" value="<?php echo $formdata['email'];?>" placeholder="Email Address"  class="form-control" />
 </td>	
</tr>

<tr>
<td>Phone</td>
<td><input type="text" id="phone" name="phone" value="<?php echo $formdata['phone'];?>" placeholder="Enter Phone Number" class="form-control" />
</td>
</tr>
<tr>
<td>Ticket Title</td>

<td> <input type="text" id="ticket_title" name="ticket_title" value="<?php echo $formdata['ticket_title'];?>" placeholder="" class="form-control" /></td>
</tr>
<tr>
<td>Ticket Description</td>

<td> 
<!--<textarea class="form-control ckeditor m-wrap" name="ticket_description" rows="6" id="ticket_description"><?php echo $formdata['ticket_description'];?></textarea>-->
<?php echo $this->ckeditor->editor('ticket_description',$formdata['ticket_description']);?>

</td>
</tr>
<tr>
<td>Ticket Status</td>
 <td> <?php echo form_dropdown('ticket_status_id',  $tickets_status_list,$formdata["ticket_status_id"],'id="ticket_status_id" class="table-group-action-input form-control input-medium"');?>
  </td>	
</tr>

<tr>
  <td>Ticket Priority</td>
  <td>
    <?php echo form_dropdown('ticket_priority_id',  $tickets_priority_list,$formdata["ticket_priority_id"],'id="ticket_priority_id" class="table-group-action-input form-control input-medium"');?>
    </td>
</tr>
<tr>
  <td colspan="2">
  <span class="click-icons">
  <input type="submit" class="attach-subs" value="Submit">
  <a href="<?php echo $this->config->site_url();?>/tickets" class="attach-subs subs">Cancel</a>
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
	
	if($('#name').val()=='')
	{
		alert('Please enter name');
		$('#name').focus();
		return false;
	}
	if($('#ticket_title').val()=='')
	{
		alert('Please enter Ticket Title');
		$('#ticket_title').focus();
		return false;
	}
	

	return true;
}

</script>					
				