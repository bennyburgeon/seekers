<form class="form-horizontal form-bordered" action="<?php echo site_url('candidates_all/update_job_details'); ?>"  method="post" id="update_job_form" name="update_job_form" > 

<input type="hidden" name="job_profile_id"  value="<?php echo $job_profile_id?>">
<input type="hidden" name="candidate_id"  value="<?php echo $candidate_id?>">

<table class="hori-form">
<tbody>

<tr>
<td>Is this your present job ?</td>
 <td> 
      <label class="radio-inline">
      <input type="radio" name="present_job" id="present_job" value="1" <?php if($formdata_job['present_job']==1){?> checked <?php } ?> >Yes</label>
    <label class="radio-inline">
<input type="radio" name="present_job" id="present_job" value="0" <?php if($formdata_job['present_job']==0){?> checked <?php } ?> >No</label>
                
 </td>
</tr>

<tr>
<td>Organization Name</td>
<td><input class="form-control hori" type="text" name="organization" value="<?php echo $formdata_job['organization'];?>" id="organization"></td>
</tr>
<tr>
<td>Designation</td>
<td><input class="form-control hori " type="text" name="designation" value="<?php echo $formdata_job['designation'];?>" id="designation">
</td>
</tr>

<tr>
<td>Industry</td>
 <td> <?php echo form_dropdown('job_cat_id',  $industries_list, $formdata_job['job_cat_id'],'class="form-control" id="job_cat_id"');?> </td>
</tr>

<tr>
<td>Function</td>
 <td> <?php echo form_dropdown('func_id',  $functional_list, $formdata_job['func_id'],'class="form-control" id="func_id"');?> </td>
</tr>

<tr>
                    <td>Designation</td>
                     <td> <?php echo form_dropdown('desig_id',  $designation_list, $formdata_job['desig_id'],'class="form-control" id="desig_id"');?> </td>
                </tr>  

<tr>
<td>Responsibilities</td>
<td>

<?php echo $this->ckeditor->editor('responsibility',$formdata_job['responsibility']);?>

</td>
</tr>


<td>From Date</td>
<td><input class="form-control hori " type="text" name="from_date" id="datepickfrom" value="<?php echo $formdata_job['from_date'];?>" placeholder="Enter From Date Date YYYY-MM-DD"></td>
</tr>
</tr>
<td>To Date</td>
<td><input class="form-control hori " type="text" name="to_date" id="datepickto" value="<?php echo $formdata_job['to_date'];?>" placeholder="Enter To Date Date YYYY-MM-DD"></td>
</tr>





<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Update Job Profile" id="update_job_profile" style="width:180px;">

 ||  <input type="button" class="attach-subs" onClick="window.location='<?php echo site_url('candidates_all/summary'); ?>/'" value="Cancel" id="cancel_update_job_profile" style="width:180px;">
 
</span>
</td>
</tr>
</tbody>
</table>
</form>
