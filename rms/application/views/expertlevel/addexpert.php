<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?> </li>
      </ul></div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Expert Level form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

    
      <form action="<?php echo $this->config->site_url();?>/expertlevel/add" class="form-horizontal form-bordered"  method="post" id="frmjexpert" name="frmjexpert" onSubmit="return validate();" enctype="multipart/form-data"> 
    <tr>
    <td>Expert Level Name</td>
    <td><input class="form-control hori" type="text" name="exp_level" value="<?php echo $formdata['exp_level'];?>" placeholder="Enter Expert Level Name"></td>
    </tr>
    <td>Expert Level From</td>
    <td><input class="form-control hori " type="text" name="exp_level_from" value="<?php echo $formdata['exp_level_from'];?>" placeholder="Enter Expert Level From"></td>
    </tr>
    
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit" name="addrec">
    <a href="<?php echo $this->config->site_url();?>/expertlevel" class="attach-subs subs">Cancel</a>
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

