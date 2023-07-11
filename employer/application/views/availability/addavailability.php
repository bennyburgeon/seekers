<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>/availability">Availability</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Add Availability</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Add Availability</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

<form action="<?php echo $this->config->site_url();?>/availability/add" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
    <tr>
    <td>Availability Name</td>
    <td> <input type="text" id="avail_name" name="avail_name" value="<?php echo $formdata['avail_name'];?>" placeholder="" class="span12" />
    </td>
    </tr>
    <tr>
    <td>Available Days</td>
    <td> <input type="text" id="avail_days" name="avail_days" value="<?php echo $formdata['avail_days'];?>" placeholder="" class="span12" />
    </td>
    </tr>
    
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/availability" class="attach-subs subs">Cancel</a>
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
	if($('#avail_name').val()=='')
	{
		alert('Please enter availability name');
		$('#avail_name').focus();
		return false;
	}
	return true;
}

</script>	
