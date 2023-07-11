<div class="sidebar-area inner-pages">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box sides">
<ul>
<li class="active"><a href="#">Overview</a></li>
<li><a href="#">Account Settings</a></li>
</ul>
</div>
</div>
</div>
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages"><a href="<?php echo $this->config->site_url();?>/contact">Contacts</a> / <?php echo $page_head;?> </span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>edit leave form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
  <form action="<?php echo $this->config->site_url();?>/manage_leave/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
 <?php echo form_hidden('leave_id', $formdata['leave_id']);?>






<!--
new from
-->
<tr>
<td>Name</td>
<td>
<!--
<input type="text" placeholder="" class="form-control hori" id="name" name="name" value="">
-->
<select class="form-control hori" name="name" id="name">
<?php
if(isset($admins) && !empty($admins))
{
	 foreach($admins as $admin)
{
	?>

	<option value="<?php echo $admin->admin_id; ?>" <?php if($formdata['admin_id']==$admin->admin_id) { ?> selected<?php } ?> > <?php echo  $admin->firstname; echo $admin->lastname;?></option>

	<?php } 
	}
	?>
</select>
</td>
</tr>

<tr>
<td>From Date</td>
<td>
	
<input type="date" maxlength="5" placeholder="" class="form-control hori" id="date_from" name="date_from" value="<?php echo $formdata['date_from']; ?>" required>
</td>
</tr>
<tr>
<td>To Date</td>
<td>
<input type="date" maxlength="5" placeholder="" class="form-control hori" id="date_to" name="date_to" value="<?php echo $formdata['date_to']; ?>" required>
</td>
</tr>
<tr>
<td>Type</td>
<td>

<input type="radio" name="leave_type" value="1" <?php if($formdata['leave_type']==1){ ?> checked <?php } ?>> Halfday<br/>
<input type="radio" name="leave_type" value="2" <?php if($formdata['leave_type']==2){ ?> checked <?php } ?>> Fullday<br/>
<input type="radio" name="leave_type" value="0" <?php if($formdata['leave_type']==0){ ?> checked <?php } ?>> None

</td>
</tr>
<tr>
<td>Session</td>
<td>

<input type="radio" name="session_type" value="1" <?php if($formdata['session_type']==1){ ?> checked <?php } ?>> Morning<br/>
<input type="radio" name="session_type" value="2" <?php if($formdata['session_type']==2){ ?> checked <?php } ?>> Afternoon<br/>
<input type="radio" name="session_type" value="0" <?php if($formdata['session_type']==0){ ?> checked <?php } ?>> None
</td>
</tr>

<tr>
<td>Status</td>
<td>
<input type="radio" name="leave_status" value="1" <?php if($formdata['leave_status']==1){ ?> checked <?php } ?>> Pending<br/>
<input type="radio" name="leave_status" value="2" <?php if($formdata['leave_status']==2){ ?> checked <?php } ?>> Approved<br/>
<input type="radio" name="leave_status" value="3" <?php if($formdata['leave_status']==3){ ?> checked <?php } ?>> Rejected

</td>
</tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/manage_leave" class="attach-subs subs">Cancel</a>
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
<script type="text/javascript">
function validate()
{
	if($('#branch_name').val()=='')
	{
		alert('Please enter branch name');
		$('#branch_name').focus();
		return false;
	}
	return true;
}


</script>		
