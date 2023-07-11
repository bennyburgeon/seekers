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
  <form action="<?php echo $this->config->site_url();?>/manage_attend/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
 <?php echo form_hidden('atten_id', $formdata['atten_id']);?>






<!--
new from
-->
<tr>
<td>Name</td>
<td>

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
<td>Date</td>
<td>
	
<input type="date" maxlength="5" placeholder="" class="form-control hori" id="date" name="date" value="<?php echo $formdata['date']; ?>">
</td>
</tr>
<tr>
<td>Time in</td>
<td>
<input type="time" maxlength="5" placeholder="" class="form-control hori" id="time_in" name="time_in" value="<?php echo $formdata['time_in']; ?>">
</td>
</tr>
<tr>
<td>Time out</td>
<td>

<input type="time" maxlength="5" placeholder="" class="form-control hori" id="time_out" name="time_out" value="<?php echo $formdata['time_out']; ?>">
</td>
</tr>



<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/manage_attend" class="attach-subs subs">Cancel</a>
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
