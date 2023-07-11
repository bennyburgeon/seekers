<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <div class="col-sm-12 pages"> <span> <a href="<?php echo $this->config->site_url()?>products">Products</a></span> / <span>Add Products</span></div>
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
        <div class="table-tech specs hor">
          <table class="hori-form">
            <tbody>
            <form action="<?php echo $this->config->site_url();?>products/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data">
              
               <tr>
                <td>Company</td>
                <td><?php echo form_dropdown('company_id',  $company_list, $formdata['company_id'],'class="form-control" id="company_id"');?></td>
              </tr>
              
              
              <tr>
                <td>Products Name</td>
                <td><input class="form-control hori" type="text" name="product_name" value="<?php echo $formdata['product_name'];?>" id="product_name"></td>
              </tr>
             
              <tr>
                <td>Products Details</td>
                <td><input class="form-control hori" type="text" name="product_details" value="<?php echo $formdata['product_details'];?>" id="product_details">
                 <?php //echo $this->ckeditor->editor('product_details');?>
                </td>
              </tr>
              
              <tr>
                <td>Products URL</td>
                <td><input class="form-control hori" type="text" name="product_url" value="<?php echo $formdata['product_url'];?>" id="product_url"></td>
              </tr>
              
              <tr>
                <td>Products Image</td>
                <td><input class="form-control hori" type="file" name="product_image" value="<?php echo $formdata['product_image'];?>" id="product_image"></td>
              </tr>
              
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->site_url();?>products" class="attach-subs subs">Cancel</a> </span></td>
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
$(document).ready(function()
{
	$('#start_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
});	

function validate()
{	
	

     if($('#company_id').val()=='')
	{
		alert('Please select Company');
		$('#company_id').focus();
		return false;
	}
	if($('#product_name').val()=='')
	{
		alert('Please enter product name');
		$('#product_name').focus();
		return false;
	}
	
		return true;
}


</script>
