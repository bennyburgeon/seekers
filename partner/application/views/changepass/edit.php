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

<!-- BEGIN SAMPLE FORM PORTLET-->
<?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<?php if($this->input->get('upd')==1){?> 
<div class="alert alert-success">
<button class="close" data-dismiss="alert">×</button>
<strong>Password updated successfully. </strong>
</div>
<?php } ?>



<div class="col-sm-12 pages">
<a href="<?php echo $this->config->site_url();?>">Home</a> / <a href="<?php echo $this->config->site_url();?>/changepass">Change Password</a></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-7.png');?>" alt=""/><h3>Change password form</h3></div>
<div class="table-tech specs hor">
<table class="hori-form">
<form action="<?php echo $this->config->site_url();?>changepass/" class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" id="changepwdForm" name="frmentry" > 
<tbody>
<tr>
<td>Old Password</td>
<td>
<input type="password" placeholder="Enter Older Password" value=""  name="old_pass" id="old_pass" class="form-control hori">
</td>
</tr>
<tr>
<td>New Password</td>
<td><input type="password" placeholder="Enter New Password" value=""  name="newpass" id="newpass" class="form-control hori"></td>
</tr>
<tr>
<td>Confirm Password</td>
<td><input type="password" placeholder="Enter Confirm Password" value=""  name="cpassword" id="cpassword" class="form-control hori"></td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<a href="javascript:void(0);" class="attach-subs" onclick="return validate()">Submit</a>
<a href="<?php echo $this->config->site_url();?>/changepass" class="attach-subs subs">Cancel</a>
</span>
</td>
</tr>
</tbody>
</form>
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
	if($('#old_pass').val()==''){
		alert('Enter Your Old Password');
		$('#old_pass').focus();
		return false;
	}
	
	else if($('#newpass').val()==''){
		alert('Enter Your New Password');
		$('#newpass').focus();
		return false;
	}
	else if($('#cpassword').val()==''){
		alert('Enter Your Confirm Password');
		$('#cpassword').focus();
		return false;
	}
	else{
	
			if($('#old_pass').val()!='' && $('#newpass').val()!=$('#cpassword').val())
			{
				alert('Did Not Matching For Change Password');
				$('#cpassword').focus();
				return false;
			}
			else{
				$('#changepwdForm').submit();
			}
			//return true;
	}		
}
</script>	
