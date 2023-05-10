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

</td>
</tr>
<td>From Date</td>
<td><input class="form-control hori " type="text" name="from_date" id="datepickfrom" value="<?php echo $formdata_job['from_date'];?>" placeholder="yyyy-mm-dd"></td>
</tr>
</tr>
<td>To Date</td>
<td><input class="form-control hori " type="text" name="to_date" id="datepickto" value="<?php echo $formdata_job['to_date'];?>" placeholder="yyyy-mm-dd"></td>
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
<td>Function/Role</td>
 <td> <?php echo form_dropdown('func_id',  $functional_list, $formdata_job['func_id'],'class="form-control" id="func_id"');?> </td>
</tr>

<td>Designation</td>
                     <td> <?php echo form_dropdown('desig_id',  $designation_list, $formdata_job['desig_id'],'class="form-control" id="desig_id"');?> </td>
                </tr>  

    <td>Country</td>
      <td colspan="3"><?php echo form_dropdown('country_id',  $country_list, $formdata_job['country_id'],'class="form-control" id="country_id_pros"');?></td>
    </tr>
    
    <tr>
      <td>State</td>
      <td colspan="3"><?php echo form_dropdown('state_id',  $state_list,$formdata_job['state_id'],'class="form-control" id="state_id_pros"');?></td>
    </tr>
    
    <tr>
      <td>City</td>
      <td colspan="3"><?php echo form_dropdown('city_id',   $city_list,$formdata_job['city_id'],'class="form-control" id="city_id_pros"');?></td>
    </tr>

<tr>
<td>Responsibilities</td>
<td>
<!-- 
<input class="form-control hori " type="text" name="responsibility" value="<?php echo $formdata_job['responsibility'];?>" id="responsibility">
-->


<?php echo $this->ckeditor->editor('responsibility',$formdata_job['responsibility']);?>

<!-- <textarea name="responsibility" cols="" rows="" class="text_area" id="responsibility"><?php echo $formdata_job['responsibility'];?></textarea> -->


<tr>
  <td colspan="2">
  <span class="click-icons">
  <input type="submit" class="attach-subs" value="Update Job Profile" id="update_job_profile" style="width:180px;"> ||  <input type="button" class="attach-subs" onClick="window.location='<?php echo site_url('candidates_all/summary'); ?>/<?php echo $candidate_id?>'" value="Cancel" id="cancel_update_job_profile" style="width:180px;">
  </span>
  </td>
</tr>

</tbody>
</table>

</form>

<script>
var userFlag = 0;
$( document ).ready(function() {
   function candidate_validate4() {
   return true;
		if($('#organization').val()=='')
		{
			alert('Enter Organization');
			$('#organization').focus();
			return false;
		}   
	    return true;
    }
	
$('#edit_candidate4').click(function(){
		var dataStringprop = $("#candidate_form4").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates_all/update_job_details'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							var img_path = '<?php echo base_url();?>assets/images/loader.gif';
							$("#step1").html('<img src="'+img_path+'" alt="Adding new...."/>');
                            var site_url = "<?php echo site_url('candidates_all/loadEditFilehtml'); ?>" +'/'+ candidateId;
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

</script>