<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active">Add Notification </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/>
          <h3>Notification form</h3>
        </div>
        <?php if(validation_errors()!=''){?>
        <div class="alert alert-success alert-danger">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
          <strong><?php echo validation_errors(); ?></strong> </div>
        <?php } ?>
        <div class="table-tech specs hor">
          <form action="<?php echo $this->config->site_url();?>notifications/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data">
            <table class="hori-form">
              <tbody>
               
                <tr>
                  <td>Message</td>
                  <td><?php echo $this->ckeditor->editor('text_message',$formdata['text_message']);?></td>
                </tr>
              
                 <tr>
                  <td>Target Users</td>
                  <td><?php echo form_dropdown('message_to[]', $admin_users_list, $formdata['message_to'],'class="form-control" multiple');?></td>
                </tr>
                
                <tr>
                  <td colspan="2"><span class="click-icons">
                    <input type="submit" class="attach-subs" value="Submit">
                    <a href="<?php echo $this->config->site_url();?>notifications" class="attach-subs subs">Cancel</a></span></td>
                </tr>
              </tbody>
            </table>
          </form>
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<?php /*?><script src="<?php echo $this->config->base_url()?>/js/jquery-1.11.0.min.js"></script><?php */?>
<script>
var teamnum = 0;
function validate()
{
	
	if($('#not_title').val()=='')
	{
		alert('Please enter task title');
		$('#not_title').focus();
		return false;
	}
	if(CKEDITOR.instances['not_text'].getData()==''){
		alert('Please enter task description');
		CKEDITOR.instances['not_text'].focus();
		return false;
	}

	return true;
}
</script>
