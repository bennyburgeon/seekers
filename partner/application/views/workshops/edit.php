<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
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
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/>
          <h3><?php echo $page_head;?></h3>
        </div>
        <?php if(validation_errors()!=''){?>
        <div class="alert alert-success alert-danger">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
          <strong><?php echo validation_errors(); ?></strong> </div>
        <?php } ?>
        <div class="portlet-title">
          <div class="caption"> <i class="fa fa-cogs font-green-sharp"></i> </div>
          <div class="tools"> <a href="javascript:;" class="collapse" data-original-title="" title=""> </a> <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a> <a href="javascript:;" class="reload" data-original-title="" title=""> </a> <a href="javascript:;" class="remove" data-original-title="" title=""> </a> </div>
        </div>
        <div class="table-tech specs hor">
          <table class="hori-form">
            <tbody>
            <form action="<?php echo $this->config->site_url();?>workshops/update" class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();">
              <?php echo form_hidden('interview_id', $formdata["interview_id"]);?>
               <input type="hidden" name="event_type" value="4">
             
              <tr>
                <td>Title</td>
                <td>
				
                <input type="text" class="form-control" placeholder="Enter Title" value="<?php echo $formdata["walkin_title"];?>"  name="walkin_title" id="walkin_title">
			                
                </td>
              </tr>
              
              <tr>
                <td>Workshop Type</td>
                <td><?php echo form_dropdown('interview_type_id', $interview_type_list, $formdata['interview_type_id'],'class="form-control hori" id="interview_type_id"');?></td>
              </tr>
              <tr>
                <td>Venue</td>
                <td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["venue"];?>"  name="venue" id="venue"></td>
              </tr>
              <tr>
                <td>Workshop Date From</td>
                <td><input type="text"  class="form-control hori" placeholder="Enter text" value="<?php echo $formdata["interview_date_from"] ?>"  name="interview_date_from" id="interview_date_from"></td>
              </tr>
              <tr>
                <td>Workshop Date To</td>
                <td><input type="text"  class="form-control hori" placeholder="Enter text" value="<?php echo $formdata["interview_date_to"] ?>"  name="interview_date_to" id="interview_date_to"></td>
              </tr>
              <tr>
                <td>Workshop Time From</td>
                <td><?php echo form_dropdown('interview_time_from', $time_array, $formdata['interview_time_from'],'class="form-control hori" id="interview_time_from"');?></td>
              </tr>
              <tr>
                <td>Workshop Time To</td>
                <td><?php echo form_dropdown('interview_time_to', $time_array, $formdata['interview_time_to'],'class="form-control hori" id="interview_time_to"');?></td>
              </tr>
              <tr>
                <td>Report At</td>
                <td><?php echo form_dropdown('report_time', $time_array, $formdata['report_time'],'class="form-control hori" id="report_time"');?></td>
              </tr>
              <tr>
                <td>Duration</td>
                <td><input type="text" class="form-control" placeholder="Duration" value="<?php echo $formdata["duration"] ?>"  name="duration" id="duration"></td>
              </tr>
              <tr>
                <td>Contact Name</td>
                <td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["contact_name"] ?>"  name="contact_name" id="contact_name"></td>
              </tr>
              <tr>
                <td>Contact Email</td>
                <td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["contact_email"] ?>"  name="contact_email" id="contact_email"></td>
              </tr>
              <tr>
                <td>Contact Phone</td>
                <td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["contact_phone"] ?>"  name="contact_phone" id="contact_phone"></td>
              </tr>
              <tr>
                <td>Materials</td>
                <td><input type="text" class="form-control" placeholder="List of materials to bring" value="<?php echo $formdata["materials"] ?>"  name="materials" id="materials"></td>
              </tr>
              <tr>
                <td>Attach Route Map</td>
                <td colspan="2"><?php echo form_upload(array('name'=>'file_name','class'=>'smallinput', ''));?></td>
              </tr>
              <tr>
                <td>Location Latitude</td>
                <td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["office_latitude"] ?>"  name="office_latitude" id="office_latitude"></td>
              </tr>
              <tr>
                <td>Location Longitude</td>
                <td><input type="text" class="form-control" placeholder="Enter text" value="<?php echo $formdata["office_longitude"] ?>"  name="office_longitude" id="office_longitude"></td>
              </tr>
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->site_url();?>workshops" class="attach-subs subs">Cancel</a> </span></td>
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
	if($('#walkin_title').val()=='')
	 {
		  alert('Please enter title');
		  $('#walkin_title').focus();
		  return false;
	}
	return true; 
}

$(document).ready(function()
{
	$('#interview_date_from').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#interview_date_to').datepicker({
		dateFormat: "yy-mm-dd"
	});	
});

</script>
