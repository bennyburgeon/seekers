<form class="form-horizontal form-bordered" action="<?php echo site_url('candidates_apps/update_job_details'); ?>"  method="post" id="update_job_form" name="update_job_form" > 

<input type="hidden" name="job_profile_id"  value="<?php echo $job_profile_id?>">
<input type="hidden" name="candidate_id"  value="<?php echo $candidate_id?>">
<input type="hidden" name="designation"  value="">

<table class="hori-form">
<tbody>
<tr>
<td>Organization Name</td>
<td><input class="form-control hori" type="text" name="organization" value="<?php echo $formdata['organization'];?>" id="organization"></td>
</tr>

<tr>
<td>Job Location</td>
<td><input class="form-control hori " type="text" name="job_location" value="<?php echo $formdata['job_location'];?>" id="job_location">
</td>
</tr>


<tr>
<td>Industry</td>
 <td> <?php echo form_dropdown('job_cat_id',  $industry_list, $formdata['job_cat_id'],'class="form-control" id="job_cat_id_prof_edit_old"');?> </td>
</tr>

<tr>
<td>Department</td>
 <td> <?php echo form_dropdown('func_id',  $functional_list, $formdata['func_id'],'class="form-control" id="func_id_prof_edit_old"');?> </td>
</tr>

<tr>
  <td>Designation</td>
  <td><?php echo form_dropdown('desig_id',  $designation_list, $formdata['desig_id'],'class="form-control" id="desig_id_prof_edit"');?></td>
</tr>
<tr>
<td>Responsibilities</td>
<td>
<textarea class="form-control hori" name="responsibility" id="responsibility"><?php echo $formdata['responsibility'];?></textarea>

</td>
</tr>
    
     <tr>
                      <td>Montly Salary</td>
                      <td><input class="form-control" placeholder="Montly Salary" type="text" name="monthly_salary" value="<?php echo $formdata['monthly_salary'];?>" id="monthly_salary"></td>
                    </tr>
                        <tr>
                      <td>Verified ?</td>
                      <td><label class="radio-inline">
                          <input type="radio" name="salary_verified" id="salary_verified" value="1" <?php  if($formdata['salary_verified']==1) echo 'checked';?>>
                          Yes</label>
                        <label class="radio-inline">
                          <input type="radio" name="salary_verified" id="salary_verified" value="2" <?php  if($formdata['salary_verified']==2) echo 'checked';?>>
                          No</label></td>
                    </tr>
                         <tr>
                      <td>Document Verified Based On</td>
                      <td><select class="form-control" name="doc_verified" id="doc_verified">
                          <option value="" selected="true" disabled="disabled">select</option>
                         <option value="1" <?php  if($formdata['doc_verified']==1) echo 'selected';?>>Bank Statement</option>
                         <option value="2" <?php  if($formdata['doc_verified']==2) echo 'selected';?>>Salary Certificate</option>
                         </select></td>
                    </tr>
    <tr>
<td>From Date</td>
<td><input class="form-control hori" type="text" name="from_date" id="date_from_prof" value="<?php echo $formdata['from_date'];?>" placeholder="YYYY-MM-DD"></td>
</tr>
</tr>
<td>To Date</td>
<td><input class="form-control hori" type="text" name="to_date" id="date_to_prof" value="<?php echo $formdata['to_date'];?>" placeholder="YYYY-MM-DD"></td>
</tr>



<tr>
<td>Is this your present job ?</td>
 <td> 
      <label class="radio-inline">
      <input type="radio" name="present_job" id="present_job" value="1" <?php if($formdata['present_job']==1){?> checked <?php } ?> >Yes</label>
    <label class="radio-inline">
<input type="radio" name="present_job" id="present_job" value="0" <?php if($formdata['present_job']==0){?> checked <?php } ?> >No</label>
                
 </td>
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
<script>
$('#job_cat_id_prof_edit').change(function() {
	jQuery('#func_id_prof_edit').html('');
	jQuery('#func_id_prof_edit').append('<option value="">Select Department</option');

	jQuery('#desig_id_prof_edit').html('');
	jQuery('#desig_id_prof_edit').append('<option value="">Select Designation</option');
			
	if($('#job_cat_id_prof_edit').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getdepartment/',
		  data: { job_cat_id: $('#job_cat_id_prof_edit').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#func_id_prof_edit').html('');
				jQuery('#func_id_prof_edit').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#func_id_prof_edit').html('');
				  $.each(data.department_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#func_id_prof_edit').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#func_id_prof_edit').append('<option value="'+ index +'">'+ value +'</option');
				 });
						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#func_id_prof_edit').html('');
				jQuery('#func_id_prof_edit').append('<option value="">Select Department</option');
		  }
		});	
});

$('#func_id_prof_edit').change(function() {

	jQuery('#desig_id_prof_edit').html('');
	jQuery('#desig_id_prof_edit').append('<option value="">Select Designation</option');
			
	if($('#func_id_prof_edit').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getdesignation/',
		  data: { func_id: $('#func_id_prof_edit').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#desig_id_prof_edit').html('');
				jQuery('#desig_id_prof_edit').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#desig_id_prof_edit').html('');
				  $.each(data.designation_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#desig_id_prof_edit').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#desig_id_prof_edit').append('<option value="'+ index +'">'+ value +'</option');
				 });					
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#desig_id_prof_edit').html('');
				jQuery('#desig_id_prof_edit').append('<option value="">Select Designation</option');
		  }
		});	
});


$('#date_from_prof').datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	yearRange: "c-100:c+100"
	});
	
$('#date_to_prof').datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	yearRange: "c-100:c+100"
	});

</script>