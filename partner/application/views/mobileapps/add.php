<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?> </li>
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
<div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs font-green-sharp"></i>
                                        
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="reload" data-original-title="" title="">
                                            </a>
                                            <a href="javascript:;" class="remove" data-original-title="" title="">
                                            </a>
                                        </div>
                                    </div>
<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
  <form action="<?php echo $this->config->site_url();?>/mobileapps/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 

    
      
<tr>
<td>Title</td>
<td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["obj_title"] ?>"  name="obj_title" id="obj_title"></td>
</tr>

<tr>
<td>Content</td>
<td> <?php echo $this->ckeditor->editor('obj_content',$formdata['obj_content']);?></td>
</tr>

<tr>
    <td>App Type</td>
    <td><?php echo form_dropdown('obj_type', $mobile_apps, $formdata['obj_type'],'class="form-control hori" id="obj_type"');?></td>
    </tr>
    
    
<tr>
<td>Contact Name</td>
<td><input type="text" class="form-control" placeholder="Office Location" value="<?php echo $formdata["obj_contact_name"] ?>"  name="obj_contact_name" id="obj_contact_name"></td>
</tr>
<tr>
<td>Contact Phone</td>
<td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["obj_contact_phone"];?>"  name="obj_contact_phone" id="obj_contact_phone"></td>
</tr>

<tr>
<td>Contact Email</td>
<td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["obj_contact_email"];?>"  name="obj_contact_email" id="obj_contact_email"></td>
</tr>


<tr>
  <td>Office Location</td>
  <td>
  
  <input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["obj_office_loc"] ?>"  name="obj_office_loc" id="obj_office_loc">
  
 </td>	
</tr>

<tr>
  <td>Nearest Place</td>
  <td>
  
  <input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["obj_nearest_bus"] ?>"  name="obj_nearest_bus" id="obj_nearest_bus">
  
 </td>	
</tr>

<tr>
  <td>Latitude</td>
  <td>
  
  <input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["obj_latitude"] ?>"  name="obj_latitude" id="obj_latitude">
  
 </td>	
</tr>

<tr>
  <td>Longitude</td>
  <td>
  
  <input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["obj_longitude"] ?>"  name="obj_longitude" id="obj_longitude">
  
 </td>	
</tr>


<tr>
  <td colspan="2">
  <span class="click-icons">
  <input type="submit" class="attach-subs" value="Submit">
  <a href="<?php echo $this->config->site_url();?>/mobileapps" class="attach-subs subs">Cancel</a>
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
	if($('#obj_title').val()=='')
 {
  alert('Enter Title');
  $('#obj_title').focus();
  return false;
 }
return true;
 
}
</script>
