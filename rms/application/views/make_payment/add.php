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
          <form action="<?php echo $this->config->base_url();?>index.php/make_payment/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data">
            <table>
              <tr>
                <td colspan="2">Select Company</td>
                <td colspan="6"><?php echo form_dropdown('company_id', $company, $formdata['company_id'],'class="form-control hori" id="company_id"');?></td>
              </tr>
            </table>
            <br>
            <table border="1">
              <tbody>
                <tr>
                  <th width="13%" colspan="2">Select Package</th>
                  <th width="9%">Total Jobs</th>
                  <th width="9%">Amount</th>
                  <th width="12%">Job Ad Validity</th>
                  <th width="13%">Package Validity</th>
                  <th width="15%">Resume Download</th>
                  <th width="13%">Price per Job Ad</th>
                </tr>
                <?php foreach($list_packages as $key => $val){ ?>
                <tr>
                  <td width="3%"><input style="width:13px; height: 13px;" type="radio" id="package_id" name="package_id" value="<?php echo $val['package_id'];?>"></td>
                  <td width="10%"><?php echo $val['package_name']; ?></td>
                  <td><?php echo $val['total_job_ads']; ?></td>
                  <td><?php echo $val['package_amount'];?></td>
                  <td>30 Days</td>
                  <td><?php if($val['total_job_ads']==1) { echo '1 Month'; }
									else if($val['total_job_ads']==5) { echo '3 Month'; }
									else if($val['total_job_ads']==10) { echo '6 Month'; }
									else if($val['total_job_ads']==25) { echo '1 Year'; } ?></td>
                  <td>Unlimited</td>
                  <td><?php echo $val['amount_per_job'];?></td>
                </tr>
                <?php } ?>
                <tr>
              </tbody>
            </table>
            <br>
            <td colspan="2"><span class="click-icons">
              <input type="submit" class="attach-subs" value="Submit">
              <a href="<?php echo $this->config->base_url();?>index.php/make_payment" class="attach-subs subs">Cancel</a> </span></td>
            </tr>
          </form>
          
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
function validate()
{
	
	if($('#company_id').val()==0)
 {
  alert('Select your Company');
  $('#company_id').focus();
  return false;
 }
	
	
	if (!$("input[name='package_id']:checked").val()) 
	{
		alert('Select any Package');
		$('#package_id').focus();
		return false;
	}
	
	
}
</script> 
