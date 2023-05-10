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
<div class="col-sm-12 pages"><a href="<?php echo $this->config->site_url();?>/branch">Branch </a> / <span><?php echo $page_head;?></span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>branch form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
  <form action="<?php echo $this->config->site_url();?>/branch/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
<tr>
<td>Branch Name</td>
<td>
<input type="text" placeholder="" class="form-control hori" id="branch_name" name="branch_name" value="<?php echo $formdata['branch_name'];?>">
</td>
</tr>

<tr>
<td>Branch Code</td>
<td>
<input type="text" maxlength="5" placeholder="" class="form-control hori" id="branch_code" name="branch_code" value="<?php echo $formdata['branch_code'];?>">
</td>
</tr>

<tr>
<td>Status</td>
<td>
<label><input type="radio" name="status" id="optionsRadios1" value="1" <?php if($formdata['status']==1)echo 'checked="checked"';?> class="hor-check"> Active</label>
<label><input type="radio" name="status" id="optionsRadios2" value="0" <?php if($formdata['status']==0)echo 'checked="checked"';?> class="hor-check"> Inactive </label></td>
</tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/branch" class="attach-subs subs">Cancel</a>
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