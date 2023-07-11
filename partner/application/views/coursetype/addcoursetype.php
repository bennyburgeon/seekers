<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active">Course type</li>
      </ul>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Course type form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

    
      <form action="<?php echo $this->config->site_url();?>/course_type/add" class="form-horizontal form-bordered"  method="post" id="frmlevel" name="frmlevel" onSubmit="return validate();" enctype="multipart/form-data"> 
    <tr>
    <td>Course Type</td>
    <td><input class="form-control hori" type="text" name="course_type" id="course_type" value="<?php echo $formdata['course_type'];?>" placeholder="Enter Course Type"></td>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit" name="addrec">
    <a href="<?php echo $this->config->site_url();?>/course_type" class="attach-subs subs">Cancel</a>
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
	if($('#course_type').val()==''){
		alert('Enter Course Type');
		$('#course_type').focus();
		return false;
	}
	
			return true;
			
}
</script>	
