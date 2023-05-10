<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?> </li>
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
<div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs font-green-sharp"></i>
                                        
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="reload" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="remove" data-original-title="" title="">
                                            </a>
                                        </div>
                                    </div>
<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
  <form action="<?php echo $this->config->site_url();?>admin/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
  
    <?php echo form_hidden('nickname', $formdata["nickname"]);?>
    
    
<tr>
<td>First Name</td>
<td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["firstname"] ?>"  name="firstname" id="firstname"></td>
</tr>
<tr>
<td>Last name</td>
<td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["lastname"] ?>"  name="lastname" id="lastname"></td>
</tr>
<tr>
<td>Email address</td>
<td><input type="text" class="form-control" placeholder="Email Address" value="<?php echo $formdata["email"] ?>"  name="email" id="email"></td>
</tr>


<tr>
<td>User name</td>
<td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["username"];?>"  name="username" id="username"></td>
</tr>

<tr>
<td>Password</td>
 <td> <input type="password" class="form-control" placeholder="Password" name="password" id="password"></td>	
</tr>

<tr>
<td>Confirm password</td>
 <td> <input type="password" class="form-control" placeholder="Password" name="admin_cpassword" id="admin_cpassword"></td>
</tr>


<tr>
<td>Company Name</td>
 <td> <input type="company_name" class="form-control" placeholder="Company Name" name="company_name" id="company_name"></td>
</tr>


<tr>
<td>Designation</td>
 <td> <input type="designation" class="form-control" placeholder="Designation" name="designation" id="designation"></td>
</tr>

<tr>
<td>Mobile</td>
 <td> <input type="mobile" class="form-control" placeholder="Mobile" name="mobile" id="mobile"></td>
</tr>

<tr>
<td>Telephone </td>
 <td> <input type="telephone" class="form-control" placeholder="Telephone" name="telephone" id="telephone"></td>
</tr>

<tr>
<td>Skype</td>
 <td> <input type="skype" class="form-control" placeholder="Skype" name="skype" id="skype"></td>
</tr>


<tr>
<td>Website</td>
 <td> <input type="website" class="form-control" placeholder="Website" name="website" id="website"></td>
</tr>

<tr>
<td>Address</td>
 <td>
 <?php echo $this->ckeditor->editor('address',$formdata['address']);?></td>	
</tr>

<tr>
<td>Building & Post Box</td>
 <td> <input type="pobox_address" class="form-control" placeholder="Building & Post Box" name="pobox_address" id="pobox_address"></td>
</tr>

<tr>
  <td>Group name</td>
  <td><?php echo form_dropdown('group_id',  $group_list,$formdata["group_id"],'class="form-control" id="group_id"');?>	</td>	
</tr>

<tr>
  <td colspan="2">
  <span class="click-icons">
  <input type="submit" class="attach-subs" value="Submit">
  <a href="<?php echo $this->config->site_url();?>admin" class="attach-subs subs">Cancel</a>
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
	if($('#firstname').val()=='')
	{
		alert('Enter Your First Name');
		$('#firstname').focus();
		return false;
	}
	
	if($('#email').val()=='')
	 {
		  alert('Enter Your Email');
		  $('#email').focus();
		  return false;
	 }
	 
 var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	
	if(!pattern.test($('#email').val())){
		alert('Enter valid email');
			$('#email').focus();
		return false;
	}
	
	if($('#username').val()=='')
	{
		alert('Enter Your Username');
		$('#username').focus();
		return false;
	}
 
	if($('#password').val()=='')
	{
		alert('Enter Your Password');
		$('#password').focus();
		return false;
	}
 
	if($('#admin_cpassword').val()=='')
	{
		alert('Enter Your Confirm Password');
		$('#admin_cpassword').focus();
		return false;
	}
	
	if($('#password').val()!='' && $('#admin_cpassword').val()!=$('#password').val())
	{
		alert('Password and confirm password mismatch');
		$('#admin_cpassword').focus();
		return false;
	}
	return true; 
}
</script>
