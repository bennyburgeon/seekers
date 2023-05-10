<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/>
          <h3><?php echo $page_head;?></h3>
        </div>
        <?php if(validation_errors()!=''){?>
        <div class="alert alert-success alert-danger">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
          <strong><?php echo validation_errors(); ?></strong> </div>
        <?php } ?>
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> </div>
          <div class="tools"> <a href="javascript:;" class="collapse" data-original-title="" title=""> </a> <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a> <a href="javascript:;" class="reload" data-original-title="" title=""> </a> <a href="javascript:;" class="remove" data-original-title="" title=""> </a> </div>
        </div>
        <div class="table-tech specs hor">
          <table class="hori-form">
            <tbody>
            <form action="<?php echo $this->config->base_url();?>index.php/make_payment/update" class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();">
              <?php echo form_hidden('user_id', $formdata["user_id"]);?>
              <?php echo form_hidden('company_id', $formdata["company_id"]);?>
              <tr>
                <td>Company name</td>
                <td><?php echo form_dropdown('company_id', $company_list, $formdata['company_id'],'class="form-control hori" id="company_id" disabled');?></td>
              </tr>
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
                <td><input type="password" class="form-control" placeholder="Password" name="password" id="password"></td>
              </tr>
              <tr>
                <td>Confirm password</td>
                <td><input type="password" class="form-control" placeholder="Password" name="admin_cpassword" id="admin_cpassword"></td>
              </tr>
              <tr>
                <td>Package Validity</td>
                <td><input type="radio" id="package1" name="package" value="1">
                  One Month
                  <input type="radio" id="package2" name="package" value="2" checked>
                  Three Month
                  <input type="radio" id="package3" name="package" value="3">
                  Six Month
                  <input type="radio" id="package4" name="package" value="4">
                  One Year </td>
              </tr>
              <tr>
                <td>Address</td>
                <td><?php echo $this->ckeditor->editor('address',$formdata['address']);?></td>
              </tr>
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->base_url();?>index.php/make_payment" class="attach-subs subs">Cancel</a> </span></td>
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

if($('#email').val()=='')
 {
	  alert('Enter Your Email');
	  $('#email').focus();
	  return false;
 }

var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	if(!pattern.test($('#email').val()))
	{
		alert('Enter valid email');
			$('#email').focus();
		return false;
	}
 	if($('#firstname').val()=='')
 {
  alert('Enter Your First Name');
  $('#firstname').focus();
  return false;
 }
 	if($('#username').val()=='')
 {
  alert('Enter Your Username');
  $('#username').focus();
  return false;
 }

 
}
</script> 
