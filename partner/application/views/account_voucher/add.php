

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?>  </li>
      </ul>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Accounts form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
   <form action="<?php echo $this->config->site_url();?>/account_voucher/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
   
   <tr>
    <td>Voucher Code</td>
    <td><input class="form-control hori" type="text" name="voucher_code" value="<?php echo $formdata['voucher_code'];?>" placeholder="Enter Voucher Code" id="voucher_code"></td>
    </tr>
    <tr>
    <td>Voucher Amount</td>
    <td><input class="form-control hori" type="text" name="voucher_amount" value="<?php echo $formdata['voucher_amount'];?>" placeholder="Enter Voucher Amount" id="voucher_amount"></td>
    </tr>
    
    <tr>
    <td>Voucher Date</td>
    <td><input class="datepicker form-control hori" type="text" name="voucher_date" value="<?php echo $formdata['voucher_date'];?>" placeholder="Enter Voucher Date" id="voucher_date"></td>
    </tr>
    
    <tr>
    <td>Debit</td>
    <td><?php echo form_dropdown('debit', $account_list,'','class="form-control hori" id="account_id"');?></td>
  </tr>
    
    <tr>
    <td>Amount</td>
     <td><input class="form-control hori" type="text" name="amount" value="<?php echo $formdata['amount'];?>" placeholder="Enter Amount" id="amount"></td>
    </tr>
    
    
    <tr>
    <td>Credit</td>
    <td><?php echo form_dropdown('credit', $account_list, '','class="form-control hori" id="account_id"');?></td>
  </tr>
    
    <tr>
    <td>Narration</td>
    <td><input class="form-control hori" type="text" name="narration" value="<?php echo $formdata['narration'];?>" placeholder="Narration" id="narration"></td>
    </tr>
    
   <tr>
    <td>Approved by</td>
    <td><?php echo form_dropdown('approved_by', $admin_list, '','class="form-control hori" id="approved_by"');?></td>
  </tr>
    
    
     <tr>
    <td>Prepared by</td>
    <td><?php echo form_dropdown('prepared_by', $admin_list, '','class="form-control hori" id="prepared_by"');?></td>
  </tr>
    
    
     
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/account_voucher" class="attach-subs subs">Cancel</a>
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

 $('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});
 
 
function validate()
{
	
 if($('#account_name').val()=='' )
 {
	  alert('Enter Account');
	  $('#account_name').focus();
	  return false;
 }

 return true;
}
</script>
