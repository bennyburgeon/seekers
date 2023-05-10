<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" > 
<table class="hori-form">
<tbody>


<tr>
<td>Organization Name</td>
<td><input class="form-control hori" type="text" name="organization" value="<?php echo $formdata['organization'];?>" id="organization"></td>
</tr>
<tr>
<td>Designation</td>
<td>
+<input class="form-control hori " type="text" name="designation" value="<?php echo $formdata['designation'];?>" id="designation">
</td>
</tr>

<tr>
<td>Industry</td>
 <td> <?php echo form_dropdown('job_cat_id',  $industry_list, $formdata['job_cat_id'],'class="form-control" id="job_cat_id"');?> </td>
</tr>

<tr>
<td>Function/Role</td>
 <td> <?php echo form_dropdown('func_id',  $functional_list, $formdata['func_id'],'class="form-control" id="func_id"');?> </td>
</tr>


<tr>
<td>Responsibilities</td>
<td>
<input class="form-control hori " type="text" name="responsibility" value="<?php echo $formdata['responsibility'];?>" id="responsibility">
</td>
</tr>
<td>From Date</td>
<td><input class="form-control hori " type="text" name="from_date" id="datepickfrom" value="<?php echo $formdata['from_date'];?>" placeholder="Enter From Date"></td>
</tr>
</tr>
<td>To Date</td>
<td><input class="form-control hori " type="text" name="to_date" id="datepickto" value="<?php echo $formdata['to_date'];?>" placeholder="Enter To Date"></td>
</tr>
<tr>
<td>Current Salary</td>
<td>
<input class="form-control hori " type="text" name="monthly_salary" value="<?php echo $formdata['monthly_salary'];?>"  id="monthly_salary">-<?php echo form_dropdown('currency_id',  $currecy_list, $formdata['currency_id'],'class="form-control" id="currency_id"');?> 
</td>
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
<td>Total Experience</td>
 <td> <?php echo form_dropdown('exp_years',  $years_list, $formdata['exp_years'],'class="form-control" id="exp_years"');?>&nbsp; <?php echo form_dropdown('exp_months',  $months_list, $formdata['exp_months'],'class="form-control" id="exp_months"');?>
  </td>	
</tr>
<tr>

<tr>
<td>Skills</td>
<td>
<input class="form-control hori " type="text" name="skills" id="skills" value="<?php echo $formdata['skills'];?>" placeholder="Enter your Skills ">
</td>
</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="attach-subs" value="Save & Continue" id="save_candidate4" style="width: 153px;">
<input type="button" class="attach-subs subs" value="Skip" id="skip">
</span>
</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<script>
var userFlag = 0;
$( document ).ready(function() {
	
   function candidate_validate4() {
		if($('#organization').val()=='')
		{
			alert('Enter Organization');
			$('#organization').focus();
			return false;
		}   
		if($('#designation').val()=='')
		{
			alert('Enter Designation');
			$('#designation').focus();
			return false;
		}
		if($('#datepickfrom').val()=='')
		{
			alert('Add from date');
			$('#datepickfrom').focus();
			return false;
		}   
		if($('#datepickto').val()=='')
		{
			alert('Add to date');
			$('#datepickto').focus();
			return false;
		}
		if($('#monthly_salary').val()=='')
		{
			alert('Add monthly salary');
			$('#monthly_salary').focus();
			return false;
		}   
		if($('#exp_years').val()=='')
		{
			alert('Add total experience');
			$('#edu_country').focus();
			return false;
		}
		if($('#skills').val()=='')
		{
			alert('Add your skills');
			$('#course_type_id').focus();
			return false;
		}
	    return true;
    }
   $('#save_candidate4').click(function(){
		var dataStringprop = $("#candidate_form4").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('register/addJobDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							var img_path = '<?php echo base_url();?>assets/images/loader.gif';
							$("#step1").html('<img src="'+img_path+'" alt="Uploading...."/>');
                            var site_url = "<?php echo site_url('register/loadFilehtml'); ?>" +'/'+ candidateId;
                            $("#step1").load(site_url, function() {
                                //alert("success step2");
                            });
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });//end button click function save*/
});   // end document.ready

$('#skip').click(function(){
var candidateId = '<?php echo $candidate_id ?>';
var dataStringprop = $("#candidate_form4").serialize();
	$.ajax({
				type: "post",
				url: "<?php echo site_url('register/skip_step5'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						$('#hdstep1').val(ret['SUCCESS_ID']);
						if(ret['STATUS']==1) {
							var img_path = '<?php echo base_url();?>assets/images/loader.gif';
							$("#step1").html('<img src="'+img_path+'" alt="Uploading...."/>');
							var id = ret['SUCCESS_ID'];
                            var site_url = "<?php echo site_url('register/loadFilehtml'); ?>" +'/'+ id;
                            $("#step1").load(site_url, function() {
                                //alert("success step2");
                            });
						}
					}
					catch(e) {		
						alert('Exception occured while adding contact.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

});
</script>