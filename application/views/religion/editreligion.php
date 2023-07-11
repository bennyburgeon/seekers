<div class="sidebar-area inner-pages">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box2 sides">
<h4>About:</h4>
<p>Lorem ipsum dolor sit amet diam nonummy nibh dolore.</p>
<h4>Contact:</h4>
<ul>
<li>Company Name</li>
<li>+97 254 2563 889</li>
<li>214 5454 878</li>
<li>4th Avenue, 2nd Street</li>
<li>somebody@test.com</li>
<li><a href="#">www.website.in</a></li>
<li class="social-p">
<a href="#"><img src="<?php echo base_url('assets/images/p_icon8.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon9.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon10.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon11.png');?>"></a>
</li>
</ul>
</div>

</div>
</div>

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"><?php echo $page_head;?>  </li>
      </ul>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Religion form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
   
      <form action="<?php echo $this->config->site_url();?>/religion/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
                            <?php echo form_hidden('rel_id', $formdata['rel_id']);?>

    <tr>
    <td>Religion Name</td>
    <td><input class="form-control hori" type="text" name="rel_name" value="<?php echo $formdata['rel_name'];?>" placeholder="Enter Religion " id="rel_name"></td>
    </tr>
 
   
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/religion" class="attach-subs subs">Cancel</a>
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
	
 if($('#rel_name').val()=='' )
 {
	  alert('Enter religion name');
	  $('#rel_name').focus();
	  return false;
 }
 return true;
}
</script>
