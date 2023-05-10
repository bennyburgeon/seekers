<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
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
            <form action="<?php echo $this->config->site_url();?>events/add" class="form-horizontal form-bordered" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();">
              <tr>
                <td>Event Title</td>
                <td><input type="text" class="form-control" placeholder="Enter Title" value="<?php echo $formdata["event_title"] ?>"  name="event_title" id="event_title"></td>
              </tr>
              <tr>
                <td>Description</td>
                <td><?php echo $this->ckeditor->editor('description',$formdata['description'], ' id =>"description" ');?></td>
              </tr>
              <tr>
                <td>Contact Email</td>
                <td><input type="text" class="form-control" placeholder="Contact Email" value="<?php echo $formdata["contact_email"];?>"  name="contact_email" id="contact_email"></td>
              </tr>
              <tr>
                <td>Venue</td>
                <td><input type="text" class="form-control" placeholder="Venue" value="<?php echo $formdata["event_venue"];?>"  name="event_venue" id="event_venue"></td>
              </tr>
              <tr>
                <td>Event From Date</td>
                <td><input type="text" class="form-control" placeholder="From Date" value="<?php echo $formdata["from_date"] ?>"  name="from_date" id="from_date" readonly></td>
              </tr>
              <tr>
                <td>Event To Date</td>
                <td><input type="text" class="form-control" placeholder="To Date" value="<?php echo $formdata["to_date"] ?>"  name="to_date" id="to_date" readonly></td>
              </tr>
              
              
              <tr>
                <td>Event Start time</td>
                <td><input type="text" class="form-control" placeholder="Start Time" value="<?php echo $formdata["start_time"] ?>"  name="start_time" id="start_time" ></td>
              </tr>
              
              <tr>
                <td>Event End time</td>
                <td><input type="text" class="form-control" placeholder="End Time" value="<?php echo $formdata["end_time"] ?>"  name="end_time" id="end_time" ></td>
              </tr>
              
              <tr>
                <td>Organized by</td>
                <td><input type="text" class="form-control" placeholder="Organized by" value="<?php echo $formdata["organized_by"] ?>"  name="organized_by" id="organized_by"></td>
              </tr>
             
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->site_url();?>events" class="attach-subs subs">Cancel</a> </span></td>
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
	if($('#event_title').val()=='')
 {
  alert('Enter Title');
  $('#event_title').focus();
  return false;
 }
 
 if($('#description').val()=='')
 {
  alert('Enter Description');
  $('#description').focus();
  return false;
 }
 

 if($('#contact_email').val()=='')
{
	alert('Enter Email');
	$('#contact_email').focus();
	return false;
}

var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
if(!pattern.test($('#contact_email').val())){
	alert('Enter valid email');
	$('#contact_email').focus();
	return false;
}
 
 
 if($('#event_venue').val()=='')
 {
  alert('Enter Venue');
  $('#event_venue').focus();
  return false;
 }
 
 if($('#from_date').val()=='')
 {
  alert('Select From Date');
  $('#from_date').focus();
  return false;
 }
 
 if($('#to_date').val()=='')
 {
  alert('Select To Date');
  $('#to_date').focus();
  return false;
 }
 
 if($('#start_time').val()=='')
 {
  alert('Enter Event Start Time');
  $('#start_time').focus();
  return false;
 }
 
 if($('#end_time').val()=='')
 {
  alert('Enter Event End Time');
  $('#end_time').focus();
  return false;
 }
return true;
}

$(document).ready(function()
{
	$('#from_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#to_date').datepicker({
		dateFormat: "yy-mm-dd"
	});

});

</script> 
