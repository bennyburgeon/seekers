<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
        <li><a href="<?php echo $this->config->site_url();?>/jobroles">Job Role</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Edit Job Role</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Edit Job Role</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

<form action="<?php echo $this->config->site_url();?>/jobroles/update" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
<?php echo form_hidden('role_id', $formdata['role_id']);?>
    <tr>
    <td>Role Name</td>
    <td> <input type="text" id="role_name" name="role_name" value="<?php echo $formdata['role_name'];?>" placeholder="" class="form-control" />
    </td>
    </tr>
    <tr>
    <td>Role Description</td>
    <td><?php echo $this->ckeditor->editor('role_desc',$formdata['role_desc']);?>
    </td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/jobroles" class="attach-subs subs">Cancel</a>
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
	if($('#role_name').val()=='')
	{
		alert('Please enter role name');
		$('#role_name').focus();
		return false;
	}
	return true;
}

</script>	
