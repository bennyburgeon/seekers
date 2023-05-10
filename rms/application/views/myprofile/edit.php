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
<strong>Profile updated successfully. </strong>
</div>
<?php } ?>	



<div class="col-sm-12 pages">
<a href="<?php echo $this->config->site_url();?>">Home</a> / <a href="<?php echo $this->config->site_url();?>/myprofile">My Profile</a></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-7.png');?>" alt=""/><h3>profile form</h3></div>
<div class="table-tech specs hor">
<table class="hori-form">
<form action="<?php echo $this->config->site_url();?>/myprofile/index" class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" id="profileForm" name="frmentry" > 
<?php echo form_hidden('admin_id', $_SESSION['admin_session']);?>
<tbody>
<tr>
<td>First name</td>
<td>
<input type="text" placeholder="Enter First Name" value="<?php echo $formdata["firstname"] ?>"  name="firstname" id="firstname" class="form-control hori">
</td>
</tr>
<tr>
<td>Last name</td>
<td><input type="text" placeholder="Enter Last Name" value="<?php echo $formdata["lastname"] ?>"  name="lastname" id="lastname" class="form-control hori"></td>
</tr>
<tr>
<td>Address</td>
<td><input type="text" placeholder="Enter Address" value="<?php echo $formdata["address"] ?>"  name="address" id="address" class="form-control hori"></td>
</tr>
<tr>
<td>Email Address</td>
<td><input type="text" placeholder="Enter Email" value="<?php echo $formdata["email"] ?>"  name="email" id="email" class="form-control hori">	</td>
</tr>
<tr>
<td>User name</td>
<td><input type="text" placeholder="Enter Username" value="<?php echo $formdata["username"];?>" readonly="readonly"  name="username" id="username" class="form-control hori"></td>
</tr>
<tr>
<td>Image file</td>
<td>
<input type="file" name="admin_img" value=""><br>
<?php if($image_list[0]['admin_prof_img_url']==''){?>
<img src="<?php echo base_url();?>uploads/adminprofile/no_photo.png" width="125px">
	
<?php }else{?>
<img src="<?php echo base_url();?>uploads/adminprofile/<?php echo $image_list[0]['admin_prof_img_url'];?>" width="125px">
<?php } ?>
</td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<a href="javascript:void(0);" class="attach-subs" onclick="return validate()">Submit</a>
<a href="#" class="attach-subs subs">Cancel</a>
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
	
	if($('#lastname').val()=='')
	{
		alert('Please enter lastname');
		$('#lastname').focus();
		return false;
	}
	else{
		$('#profileForm').submit();
	}
	//return true;
}
</script>	