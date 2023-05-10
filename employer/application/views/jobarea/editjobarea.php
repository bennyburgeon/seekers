<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>/jobarea">Jobarea</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Edit functional area</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Edit functional area</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

<form action="<?php echo $this->config->site_url();?>/jobarea/update" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
<?php echo form_hidden('func_id', $formdata['func_id']);?>
    <tr>
    <td>Functional Area</td>
    <td> <input type="text" id="func_area" name="func_area" value="<?php echo $formdata['func_area'];?>" placeholder="" class="form-control" />
    </td>
    </tr>
    
<input type="hidden" name="job_cat_id" value="">
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/jobarea" class="attach-subs subs">Cancel</a>
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
	if($('#func_area').val()=='')
	{
		alert('Please enter functional');
		$('#func_area').focus();
		return false;
	}
	return true;
}

</script>	
