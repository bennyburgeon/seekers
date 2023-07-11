<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>/availability">Testimonials</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Add Testimonials</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Add Testimonials</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

<form action="<?php echo $this->config->site_url();?>/testimonials/add" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
    <tr>
    <td>Testimonials Title</td>
    <td> <input type="text" id="test_title" name="test_title" value="<?php echo $formdata['test_title'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    <tr>
    <td>Client Name</td>
    <td> <input type="text" id="test_client_name" name="test_client_name" value="<?php echo $formdata['test_client_name'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    <tr>
    <td>Email</td>
    <td> <input type="text" id="test_email" name="test_email" value="<?php echo $formdata['test_email'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    <tr>
    <td>Phone</td>
    <td> <input type="text" id="test_phone" name="test_phone" value="<?php echo $formdata['test_phone'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
        <tr>
    <td>Testimonials</td>
    <td> 
           <?php echo $this->ckeditor->editor('test_desc',$formdata['test_desc']);?>

    </td>
    </tr>


    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/testimonials" class="attach-subs subs">Cancel</a>
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
	if($('#test_title').val()=='')
	{
		alert('Please enter testimonial title');
		$('#test_title').focus();
		return false;
	}
	return true;
}

</script>	
