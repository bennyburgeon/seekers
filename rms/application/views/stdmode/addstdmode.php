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
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active">Add Study Mode </li>
      </ul>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Study Mode form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
<form action="<?php echo $this->config->site_url();?>/stdmode/add" class="form-horizontal form-bordered"  method="post" id="frmcountry" name="frmcountry" onSubmit="return validate();" enctype="multipart/form-data"> 
    <tr>
    <td>Study Mode Name</td>
    <td><input class="form-control hori" type="text" name="mode_name" value="<?php echo $formdata['mode_name'];?>" placeholder="Enter Study Mode Name" id="mode_name"></td>
    </tr>
    <tr>
    <tr>
    <td>Short Name</td>
    <td><input class="form-control hori" type="text" name="mode_desc" value="<?php echo $formdata['mode_desc'];?>" placeholder="Enter Short Name" id="mode_desc"></td>
    </tr>
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Add" name="addrec">
    <a href="<?php echo $this->config->site_url();?>/stdmode" class="attach-subs subs">Cancel</a>
    </span>
    </td>
    </tr>
    </form></tbody>
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
	
 if($('#mode_name').val()=='' )
 {
	  alert('Enter study mode name');
	  $('#mode_name').focus();
	  return false;
 }
  if($('#mode_desc').val()=='' )
 {
	  alert('Enter Short Name');
	  $('#mode_desc').focus();
	  return false;
 }
 return true;
}
</script>
