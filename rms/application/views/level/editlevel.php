<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages"><span>Home</span> / <span>Edit Level</span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Level form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

    
      <form action="<?php echo $this->config->site_url();?>/level/update/<?php echo $formdata['level_id'];?>" class="form-horizontal form-bordered"  method="post" id="frmpages" name="frmpages" onSubmit="return validate();" enctype="multipart/form-data"> 
       <?php echo form_hidden('level_id', $formdata['level_id']);?>
    <tr>
    <td>Expert Level Name</td>
    <td><input class="form-control hori" type="text" name="level_name" value="<?php echo $formdata['level_name'];?>" placeholder="Enter Level Name"></td>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Update" name="updpage">
    <a href="<?php echo $this->config->site_url();?>/level" class="attach-subs subs">Cancel</a>
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

