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
  
   <form action="<?php echo $this->config->site_url();?>/freelance/add" class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();"> 
      
<tr>
<td>Freelance Title</td>
<td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["part_title"] ?>"  name="part_title" id="part_title"></td>
</tr>

<tr>
<td>Contact Details</td>
<td> <?php echo $this->ckeditor->editor('contact_details',$formdata['contact_details']);?></td>
</tr>

<tr>
<td>Meeting Venue</td>
<td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["meeting_venue"];?>"  name="meeting_venue" id="meeting_venue"></td>
</tr>

<tr>
  <td>Start Date</td>
  <td>
  
  <input type="text"  class="form-control hori" placeholder="Enter text" value="<?php echo $formdata["start_date"] ?>"  name="start_date" id="start_date">
  
 </td>	
</tr>


<tr>
  <td>Time Allowed</td>
  <td>
  
  <input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["time_allowed"] ?>"  name="time_allowed" id="time_allowed">
  
 </td>	
</tr>


<tr>
<td>Duration</td>
<td><input type="text" class="form-control" placeholder="Duration" value="<?php echo $formdata["duration"] ?>"  name="duration" id="duration"></td>
</tr>

<tr>
  <td>Location Latitude</td>
  <td>
  
  <input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["office_latitude"] ?>"  name="office_latitude" id="office_latitude">
  
 </td>	
</tr>

<tr>
  <td>Location Longitude</td>
  <td>
  
  <input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["office_longitude"] ?>"  name="office_longitude" id="office_longitude">
  
 </td>	
</tr>


<tr>
  <td colspan="2">
  <span class="click-icons">
  <input type="submit" class="attach-subs" value="Submit">
  <a href="<?php echo $this->config->site_url();?>/freelance" class="attach-subs subs">Cancel</a>
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
	if($('#part_title').val()=='')
 {
  alert('Enter Title');
  $('#part_title').focus();
  return false;
 }
return true;
}

$(document).ready(function()
{
	$('#start_date').datepicker({
		dateFormat: "yy-mm-dd"
	});

});

</script>
