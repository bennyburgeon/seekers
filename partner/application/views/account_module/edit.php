
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
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/>
          <h3>Accounts form</h3>
        </div>
        <?php if(validation_errors()!=''){?>
        <div class="alert alert-success alert-danger">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
          <strong><?php echo validation_errors(); ?></strong> </div>
        <?php } ?>
        <div class="table-tech specs hor">
          <table class="hori-form">
            <tbody>
            <form action="<?php echo $this->config->site_url();?>/account_module/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data">
              <?php echo form_hidden('account_id', $formdata['account_id']);?>
              <tr>
                <td>Account Type</td>
                <td><?php echo form_dropdown('account_type_id', $acc_type_list, $formdata['account_type_id'],'class="form-control hori" id="account_type_id"');?></td>
              </tr>
              <tr>
                <td>Account Code</td>
                <td><input class="form-control hori" type="text" name="account_code" id="account_code" value="<?php echo $formdata['account_code'];?>" placeholder="Enter Account Code"></td>
              </tr>
              <tr>
                <td>Account Name</td>
                <td><input class="form-control hori" type="text" name="account_name" id="account_name" value="<?php echo $formdata['account_name'];?>" placeholder="Enter Account Name"></td>
              </tr>
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->site_url();?>/account_module" class="attach-subs subs">Cancel</a> </span></td>
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
	
 if($('#account_name').val()=='' )
 {
	  alert('Enter Account');
	  $('#account_name').focus();
	  return false;
 }
 
 return true;
}
</script> 
