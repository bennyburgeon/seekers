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

    
      <form action="<?php echo $this->config->site_url();?>/jobapps/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
    <tr>
    <td>Page Title</td>
    <td><input class="form-control hori" type="text" name="page_title" value="<?php echo $formdata["page_title"]; ?>" id="page_title" placeholder="Enter Page Title"></td>
    </tr>
    <tr>
    <td>Page Content</td>
    <td><?php echo $this->ckeditor->editor('page_content',$formdata['page_content']);?></td>
    </tr>
    <tr>
    <td>Short Description</td>
         <td><?php echo $this->ckeditor->editor('short_desc',$formdata['short_desc']);?></td>
    </tr>
 
      <tr>
    <td>SEO Title</td>
    <td><input class="form-control hori" type="text" name="seo_title" value="<?php echo $formdata["seo_title"]; ?>" id="seo_title" placeholder="Enter SEO Title"></td>
    </tr>
      <tr>
    <td>SEO Meta Description</td>
    <td><input class="form-control hori" type="text" name="seo_meta_desc" value="<?php echo $formdata["seo_meta_desc"]; ?>" id="seo_meta_desc" placeholder="Enter SEO Meta Description"></td>
    </tr>
        <tr>
    <td>SEO Meta Keyword</td>
    <td><input class="form-control hori" type="text" name="seo_keyword" value="<?php echo $formdata["seo_keyword"]; ?>" id="seo_keyword" placeholder="Enter SEO Meta Keyword"></td>
    </tr>
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/jobapps" class="attach-subs subs">Cancel</a>
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
	if($('#page_title').val()=='')
	{
		alert('Please enter Page title');
		$('#page_title').focus();
		return false;
	}
   
	return true;
}


</script>		

