<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
    </div>
    <?php if($this->input->get('ins')==1){?>
    <div class="alert alert-success">
      <button class="close" data-dismiss="alert">×</button>
      <strong>Success!</strong> record added successfully. </div>
    <?php } ?>
    <?php if($this->input->get('update')==1){?>
    <div class="alert alert-success">
      <button class="close" data-dismiss="alert">×</button>
      <strong>Success!</strong> record updated successfully. </div>
    <?php } ?>
    <?php if($this->input->get('del')==1){?>
    <div class="alert alert-success">
      <button class="close" data-dismiss="alert">×</button>
      <strong>record deleted..</strong> </div>
    <?php } ?>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/>
          <h3><?php echo $page_head;?></h3>
        </div>
        <div class="table-tech specs">
          <div class="right-btns"> </div>
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <table class="tool-table new">
            <thead>
              <tr role="row" class="heading">
                <th><a href="<?php echo $this->config->site_url()?>client_invoice?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&rows=<?php echo $rows;?>">Job Title</a></th>
                <th>Candidate Name</th>
                <th>Invoice Date</th>
                <th>Amount</th>
                <th>Payment Status</th>
              </tr>
            </thead>
            <tbody>
              <?php 
	if($records!=NULL)
	{
		foreach($records as $result){ ?>
              <tr class="odd gradeX">
                <td><?php echo $result['job_title']?></td>
                <td><?php echo $result['first_name'].' '.$result['last_name']?></td>
                <td><?php echo ($result['invoice_date']!='0000-00-00' && $result['invoice_date']!='') ? date("d-m-Y", strtotime($result['invoice_date'])) : '';?></td>
                <td><?php echo $result['invoice_amount'];?></td>
                <td><?php if($result['invoice_status']==1){ echo "Paid";}else if($result['invoice_status']==2){ echo "Unpaid";}else if($result['invoice_status']==3){echo "Due";}?></td>
              </tr>
              <?php
	}}else{?>
              <tr>
                <td colspan="9" align="center"> No Records Founds!! </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <?php echo $pagination; ?>
          <div class="sep-bar">
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
<script>

$(document).ready(function()
{
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd"
	});


	
	
	
});
</script>
