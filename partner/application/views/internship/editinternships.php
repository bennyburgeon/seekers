<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>internship">Jobarea</a> <i class="icon-angle-right"></i> </li>
        <li><a href="#">Edit Internship</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/>
          <h3>Edit Internship</h3>
        </div>
        <?php if(validation_errors()!=''){?>
        <div class="alert alert-success alert-danger">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
          <strong><?php echo validation_errors(); ?></strong> </div>
        <?php } ?>
        <div class="table-tech specs hor">
          <table class="hori-form">
            <tbody>
            <form action="<?php echo $this->config->site_url();?>internship/update" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
              <?php echo form_hidden('internship_id', $formdata['internship_id']);?>
              <tr>
                <td>Company</td>
                <td><?php echo form_dropdown('company_id',  $company_list, $formdata['company_id'],'class="form-control" id="company_id"');?></td>
              </tr>
              
              <tr>
                <td>Internship Title</td>
                <td><input class="form-control hori" type="text" name="internship_name" placeholder="Title" value="<?php echo $formdata['internship_name'];?>" id="internship_name"></td>
              </tr>
              
               <tr>
                <td>Description</td>
                <td><?php echo $this->ckeditor->editor('description',$formdata['description'], 'id => description');?></td>
               </tr>
              
              <tr>
                <td>Duration</td>
                <td><input class="form-control hori" type="text" name="duration" placeholder="Duration in Days" value="<?php echo $formdata['duration'];?>" id="duration"></td>
              </tr>
             
              <tr>
                <td>Free / Paid</td>
                <td><input type="radio" name="free_paid" id="free_paid" value="1" <?php if($formdata['free_paid']==1)echo 'checked="checked"';?>> Free
                 <input type="radio" name="free_paid" id="free_paid" value="2" <?php if($formdata['free_paid']==2)echo 'checked="checked"';?>> Paid
                </td>
              </tr>
              
              <tr>
                <td>Start Date</td>
                <td><input class="form-control hori" type="text" name="start_date" readonly value="<?php echo $formdata['start_date'];?>" id="start_date"></td>
              </tr>
              
              <tr>
                <td>End Date</td>
                <td><input class="form-control hori" type="text" name="end_date" readonly value="<?php echo $formdata['end_date'];?>" id="end_date"></td>
              </tr>
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->site_url();?>internship" class="attach-subs subs">Cancel</a> </span></td>
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
$(document).ready(function()
{
	$('#start_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#end_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
});	

function validate()
{	
	 if($('#internship_name').val()=='')
	{
		alert('Enter Internship Name');
		$('#internship_name').focus();
		return false;
	}

     if($('#company_id').val()=='')
	{
		alert('select Company');
		$('#company_id').focus();
		return false;
	}
	if($('#duration').val()=='')
	{
		alert('Enter Duration');
		$('#duration').focus();
		return false;
	}
	if($('#start_date').val()=='')
	{
		alert('select Internship Start Date');
		$('#start_date').focus();
		return false;
	}
	if($('#end_date').val()=='')
	{
		alert('select Internship End Date');
		$('#end_date').focus();
		return false;
	}
	
		return true;
}


</script>
