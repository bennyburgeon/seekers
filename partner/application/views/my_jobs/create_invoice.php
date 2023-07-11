

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>
<div class="row">
<div class="col-md-3">
<div class="profile_box">


<span id="loading"></span>


<ul>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/manage/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/addcandidate/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Manage Candidates</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/job_apps/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Job Applications</a></li>

<li ><a href="<?php echo $this->config->site_url();?>my_jobs/addinterview/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Manage Interviews</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/shortlist/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Candidates Shortlisted</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/offer_letters/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Offer Letters</a></li>

<li><a href="<?php echo $this->config->site_url();?>my_jobs/app_closure/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>App. Closure</a></li>

<li class="active"><a href="<?php echo $this->config->site_url();?>my_jobs/invoice/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Invoices</a></li>


</ul>




</div>


</div>
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Invoice List</div>
<div class="profile_top_right">

</div>
<div style="clear:both;"></div>
</div>

<div class="profile_bottom" id="leads">
<div class="tasks profile">

<div id="response"></div>

<div class="slider_redesign" id="tr_1" >

<div class="side_adj second">

<?php if(!empty($invoice_list)){ foreach($invoice_list as $invoice_list){?>
<h2><?php echo $invoice_list['first_name'];?></h2>
<p>Offer Issued On:<?php echo $invoice_list['offer_issued_date'];?></p>
<p>Accepted On: <?php echo $invoice_list['offer_accepted_date'];?></p>
<p>Join Date: <?php echo $invoice_list['join_date'];?></p>
<p>Monthly Salary: <?php echo $invoice_list['monthly_salary_offered'];?></p>
<p>CTC: <?php echo $invoice_list['total_ctc'];?></p>
<?php if (isset($invoice_list['invoice_date'])){?><p>Invoice On: <?php echo $invoice_list['invoice_date'];?></p><?php }?>
<?php if (isset($invoice_list['invoice_date'])){?><p>Start From: <?php echo $invoice_list['invoice_start_date'];?></p><?php }?>
<?php if (isset($invoice_list['invoice_date'])){?><p>Due On: <?php echo $invoice_list['invoice_due_date'];?></p><?php }?>
<?php if (isset($invoice_list['invoice_date'])){?><p>Amount: <?php echo $invoice_list['invoice_amount'];?></p><?php }?>
<?php if (isset($invoice_list['invoice_date'])){?><p>Status: <?php if($invoice_list['invoice_status']=='1') echo 'Paid';if($invoice_list['invoice_status']=='2') echo 'Unpaid';if($invoice_list['invoice_status']=='3') echo 'Due';?></p><?php }?>
<?php } ?>
<div class="date_edit">

<span class="edit_delete">

<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="1" onClick="return validate(this.id);" >

</span>

</div>
<?php } ?>
</div>
</div>

</div>
</div>


<div class="notes">

   
	<!--Followup-->

    <div class="table-tech specs note">
    <div class="new_notes">
    <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
    -->
    <p id="result"></p>
    <p id="deletemessage"></p>


<form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>my_jobs/create_invoice/<?php echo $formdata['job_id'];?>" onSubmit="return candidate_validate();"> 
  
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
  <input type="hidden" name="app_id" value="<?php echo $app_id;?>">
  <input type="hidden" name="placement_id" value="<?php echo $placement_id;?>">
  
<table class="hori-form">
<tbody>



<tr>
<td>Invoice Date</td>
 <td><?php echo form_input(array('name'=>'invoice_date', 'class' => 'smallinput'));?> </td>
</tr>

<tr>
<td>Invoice Start Date</td>
 <td><?php echo form_input(array('name'=>'invoice_start_date', 'class' => 'smallinput'));?> </td>
</tr>

<tr>
<td>Invoice Due Date</td>
 <td><?php echo form_input(array('name'=>'invoice_due_date', 'class' => 'smallinput'));?> </td>
</tr>

<tr>
<td>Replacement Date</td>
 <td><?php echo form_input(array('name'=>'replacement_date', 'class' => 'smallinput'));?>  </td>
</tr>

<tr>
<td>Invoice Amount</td>
 <td><?php echo form_input(array('name'=>'invoice_amount', 'class' => 'smallinput'));?> </td>
</tr>

<tr>
<td>Invoice Status</td>
 <td><input type="radio"  name="invoice_status" value="1">&nbsp;Paid&nbsp;<input type="radio"  name="invoice_status" value="2"  checked>&nbsp;Unpaid&nbsp;<input type="radio"  name="invoice_status" value="3">&nbsp;Due</td>
</tr>


<tr>
  <td colspan="2">
  <span class="click-icons">
  <input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;">
  </span>
  </td>
</tr>
</tbody>
</table>

</form>
    </div>
    
   
    <div style="clear:both;"></div>
    </div>

	<!--Followup-->



<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>

<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script type="text/javascript">
   function candidate_validate() 
   {
/*		if($('#level_id').val()==0)
		{
			alert('Select Level');
			$('#level_id').focus();
			return false;
		}   
*/	
/*		if($('#spcl_id').val()==0)
		{
			alert('Select specialization');
			$('#spcl_id').focus();
			return false;
		}   
		if($('#univ_id').val()==0)
		{
			alert('Select University');
			$('#univ_id').focus();
			return false;
		}
		if($('#edu_year').val()==0)
		{
			alert('Select year');
			$('#edu_year').focus();
			return false;
		}   
		if($('#edu_country').val()=='')
		{
			alert('Select Country');
			$('#edu_country').focus();
			return false;
		}
		if($('#course_type_id').val()==0)
		{
			alert('Select Course type');
			$('#course_type_id').focus();
			return false;
		}
*/	    return true;
    }


</script>
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
