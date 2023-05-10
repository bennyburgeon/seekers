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
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?></h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

    
      <form action="<?php echo $this->config->site_url();?>/profcert/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
                            <?php echo form_hidden('cert_id', $formdata['cert_id']);?>

    <tr>
    <td>Certificate Name</td>
    <td><input class="form-control hori" type="text" name="cert_name" id="cert_name" value="<?php echo $formdata['cert_name'];?>" placeholder="Enter Certificate Name"></td>
    </tr>
 
    <td>Certificate Description</td>
    <td>
    <?php echo $this->ckeditor->editor('cert_authority',$formdata['cert_authority']);?>
    </td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/profcert" class="attach-subs subs">Cancel</a>
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
	if($('#cert_name').val()==''){
		alert('Enter Your Certification');
		$('#cert_name').focus();
		return false;
	}
	
			return true;
	
}
</script>	
