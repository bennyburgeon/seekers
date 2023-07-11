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
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?> </h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
      <form action="<?php echo $this->config->site_url();?>/university/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
                          <?php echo form_hidden('univ_id', $formdata['univ_id']);?>

    <tr>
    <td>University Name</td>
    <td><input class="form-control hori" type="text" name="univ_name" value="<?php echo $formdata['univ_name'];?>" id="univ_name"></td>
    </tr>
    <tr>
    <td>Address</td>
    <td>
    <input  name="univ_address"  id="univ_address" class="form-control hori " type="text" value="<?php echo $formdata['univ_address'];?>"></td>
    </tr>
    <tr>
    <td>Country</td>
    <td><?php echo form_dropdown('country_id', $country_list , $formdata['country_id'],'class="form-control" id="country_id"');?></td>
    </tr>
     <tr>
    <td>Website</td>
    <td><input class="form-control hori " type="text" name="univ_website" value="<?php echo $formdata['univ_website'];?>" id="univ_website"></td>
    </tr>
     
    
     <tr>
    <td>Logo</td>
     <td> 
     <?php echo form_upload(array('name'=>'univ_logo','class'=>'form-data'));?>
     <?php if($formdata['univ_logo']==''){}else{?>
     <img src="<?php echo base_url().'upload/univlogo/'.$formdata['univ_logo'];?>" style="width:100px"/>
     <?php } ?>     </td>
    </tr>
    

    
    <tr>
    <td>Type</td>
     <td>

     <input type="radio" name="univ_type" value="1" <?php if($formdata['univ_type']==1)echo 'checked="checked"';?>>National&nbsp; 
     <input type="radio" name="univ_type" value="2" <?php if($formdata['univ_type']==2)echo 'checked="checked"';?>>International&nbsp; 
                         
                     </td>	
    </tr>
    
 <tr>
    <td>University Grade</td>
     <td>
     
     <input type="radio" name="univ_grade" value="1" <?php if($formdata['univ_grade']==1)echo 'checked="checked"';?>>Grade I &nbsp; 
     <input type="radio" name="univ_grade" value="2" <?php if($formdata['univ_grade']==2)echo 'checked="checked"';?>>Grade II &nbsp; 
     <input type="radio" name="univ_grade" value="3" <?php if($formdata['univ_grade']==3)echo 'checked="checked"';?>>Grade III &nbsp;
</td>	
    </tr> 
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/university" class="attach-subs subs">Cancel</a>    </span>    </td>
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
	if($('#univ_name').val()=='')
	{
		alert('Please enter university name');
		$('#univ_name').focus();
		return false;
	}
	return true;
}


</script>		


