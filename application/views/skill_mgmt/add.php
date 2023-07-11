<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

<div class="sidebar-area inner-pages">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box2 sides">
<h4>About:</h4>
<p>Lorem ipsum dolor sit amet diam nonummy nibh dolore.</p>
<h4>Contact:</h4>
<ul>
<li>Company Name</li>
<li>+97 254 2563 889</li>
<li>214 5454 878</li>
<li>4th Avenue, 2nd Street</li>
<li>somebody@test.com</li>
<li><a href="#">www.website.in</a></li>
<li class="social-p">
<a href="#"><img src="<?php echo base_url('assets/images/p_icon8.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon9.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon10.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon11.png');?>"></a>
</li>
</ul>
</div>

</div>
</div>

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active">Add Module  </li>
      </ul>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Admin module Add</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
<form action="<?php echo $this->config->site_url();?>/skill_mgmt/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
<tr>
<td>Skill Name</td>
<td>
<input type="text" class="form-control" name="skill_name" id="skill_name" value="<?php if(isset($formdata["skill_name"]) && !empty($formdata["skill_name"])) echo $formdata["skill_name"]; ?>" placeholder="Skill Name">
</td>
</tr>
<!--
<tr>
<td>Skill link name</td>
<td><input type="text" class="form-control" name="module_url" id="module_url" value="<?php echo $formdata["module_url"]; ?>" placeholder="Skill URL"></td>
</tr>
-->
<tr>
<td>Parent Skill</td>
<td> <?php echo form_dropdown('parent_skill',  $modules_list,$formdata["parent_skill"],'id="parent_skill" class="form-control"');?></td>
</tr>


<tr>
<td>Status</td>
 <td> 
	 <label class="radio-inline">
	<input type="radio" name="active" id="optionsRadios25" value="1" <?php if($formdata["active"]==1){echo 'checked="checked"';} ?>> Active </label>
	<label class="radio-inline">
	<input type="radio" name="active" id="optionsRadios26" value="0" <?php if($formdata["active"]==0){echo 'checked="checked"';} ?>> Inactive </label></td>	
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/skill_mgmt" class="attach-subs subs">Cancel</a>
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
	
	if($('#password').val()!='' && $('#admin_cpassword').val()!=$('#password').val())
 {
  alert('Password and confirm password mismatch');
  $('#admin_cpassword').focus();
  return false;
 }

 
}
</script>
