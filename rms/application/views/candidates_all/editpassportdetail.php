<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form2" name="candidate_form2" > 
<table class="hori-form">
<tbody>



<tr>
<td>Passport Number</td>
<td>
<input class="form-control hori" type="text" name="passportno" value="<?php echo $formdata['passportno'];?>" id="passportno"></td>
</tr>

<tr>
<td>Place of issue</td>
<td><input class="form-controlhori" type="text" name="place_of_issue" value="<?php echo $formdata['place_of_issue'];?>" id="place_of_issue"></td>
</tr>


<tr>
  <td>Issue Date</td>
    <td><input class="form-controlhori" type="text" name="issued_date" value="<?php echo $formdata['issued_date'];?>" id="issued_date"></td>
</tr>

<tr>
  <td>Exp. date</td>
    <td><input class="form-controlhori " type="text" name="expiry_date" value="<?php echo $formdata['expiry_date'];?>" id="expiry_date"></td>
</tr>

<tr>
  <td>Nationality</td>
    <td><?php echo form_dropdown('passport_nationality',  $country_list, $formdata['passport_nationality'],'class="form-control" id="passport_nationality"');?></td>
</tr>

<tr>
  <td>Eng PTE[Score]</td>
    <td>
    
    <input style="width:100px;" placeholder="Total"  type="text"  name="eng_pte" value="<?php echo $formdata['eng_pte'];?>" id="eng_pte"> | 
    <input style="width:100px;" placeholder="Reading"  type="text"  name="eng_pte_reading" value="<?php echo $formdata['eng_pte_reading'];?>" id="eng_pte_reading"> | 
    <input style="width:100px;" placeholder="Listening"  type="text"  name="eng_pte_listening" value="<?php echo $formdata['eng_pte_listening'];?>" id="eng_pte_listening">|
    <input style="width:100px;" placeholder="Writing"  type="text"  name="eng_pte_writing" value="<?php echo $formdata['eng_pte_writing'];?>" id="eng_pte_writing">|
    <input style="width:100px;" placeholder="Speaking"  type="text"  name="eng_pte_speaking" value="<?php echo $formdata['eng_pte_speaking'];?>" id="eng_pte_speaking">
    
    
    </td>
</tr>

<tr>
  <td>IELTS</td>
    <td>
    
        <input style="width:100px;" placeholder="Total"  type="text"  name="eng_ielts" value="<?php echo $formdata['eng_ielts'];?>" id="eng_ielts"> | 
    <input style="width:100px;" placeholder="Reading"  type="text"  name="eng_ielts_reading" value="<?php echo $formdata['eng_ielts_reading'];?>" id="eng_ielts_reading"> | 
    <input style="width:100px;" placeholder="Listening"  type="text"  name="eng_ielts_listening" value="<?php echo $formdata['eng_ielts_listening'];?>" id="eng_ielts_listening">|
    <input style="width:100px;" placeholder="Writing"  type="text"  name="eng_ielts_writing" value="<?php echo $formdata['eng_ielts_writing'];?>" id="eng_ielts_writing">|
    <input style="width:100px;" placeholder="Speaking"  type="text"  name="eng_ielts_speaking" value="<?php echo $formdata['eng_ielts_speaking'];?>" id="eng_ielts_speaking">

    </td>
</tr>

<tr>
  <td>TOFEL</td>
    <td>    <input style="width:100px;" placeholder="Total"  type="text"  name="eng_tofel" value="<?php echo $formdata['eng_tofel'];?>" id="eng_tofel"> | 
    <input style="width:100px;" placeholder="Reading"  type="text"  name="eng_tofel_reading" value="<?php echo $formdata['eng_tofel_reading'];?>" id="eng_tofel_reading"> | 
    <input style="width:100px;" placeholder="Listening"  type="text"  name="eng_tofel_listening" value="<?php echo $formdata['eng_tofel_listening'];?>" id="eng_tofel_listening">|
    <input style="width:100px;" placeholder="Writing"  type="text"  name="eng_tofel_writing" value="<?php echo $formdata['eng_tofel_writing'];?>" id="eng_tofel_writing">|
    <input style="width:100px;" placeholder="Speaking"  type="text"  name="eng_tofel_speaking" value="<?php echo $formdata['eng_tofel_speaking'];?>" id="eng_tofel_speaking">
</td>
</tr>

<tr>
  <td>OET</td>
    <td>    <input style="width:100px;" placeholder="Total"  type="text"  name="eng_oet" value="<?php echo $formdata['eng_oet'];?>" id="eng_oet"> | 
    <input style="width:100px;" placeholder="Reading"  type="text"  name="eng_oet_reading" value="<?php echo $formdata['eng_oet_reading'];?>" id="eng_oet_reading"> | 
    <input style="width:100px;" placeholder="Listening"  type="text"  name="eng_oet_listening" value="<?php echo $formdata['eng_oet_listening'];?>" id="eng_oet_listening">|
    <input style="width:100px;" placeholder="Writing"  type="text"  name="eng_oet_writing" value="<?php echo $formdata['eng_oet_writing'];?>" id="eng_oet_writing">|
    <input style="width:100px;" placeholder="Speaking"  type="text"  name="eng_oet_speaking" value="<?php echo $formdata['eng_oet_speaking'];?>" id="eng_oet_speaking">
</td>
</tr>

<tr>
  <td>GRE</td>
    <td><input class="form-control hori " type="text" name="eng_gre" value="<?php echo $formdata['eng_gre'];?>" id="eng_gre"></td>
</tr>

<tr>
  <td>GMAT</td>
    <td><input class="form-control hori " type="text" name="eng_gmat" value="<?php echo $formdata['eng_gmat'];?>" id="eng_gmat"></td>
</tr>

<tr>
  <td>SAT</td>
    <td><input class="form-control hori " type="text" name="eng_sat" value="<?php echo $formdata['eng_sat'];?>" id="eng_sat"></td>
</tr>

<tr>
  <td>10th Marks</td>
    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_10th" value="<?php echo $formdata['eng_10th'];?>" id="eng_10th"></td>
</tr>

<tr>
  <td>12th Marks</td>
    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_12th" value="<?php echo $formdata['eng_12th'];?>" id="eng_12th"></td>
</tr>


<!--
<tr>
<td>Driving License</td>
<td><input class="form-control hori " type="text" name="driving_license" value="<?php //echo $formdata['driving_license'];?>" id="driving_license"></td>
</tr>
-->
<tr>
<td>Visa type</td>
 <td> <?php echo form_dropdown('visa_type_id',  $visatype_list, $formdata['visa_type_id'],'class="form-control" id="visa_type_id"');?> </td>

</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="attach-subs" value="Update & Continue" id="edit_candidate2" style="width:180px;">
<input type="button" class="attach-subs subs" value="Back" id="step_back">
<input type="button" class="attach-subs subs" value="Skip" id="skip">
<a href="<?php echo $this->config->site_url();?>/candidates_all/summary/<?php echo $candidate_id ?>" class="attach-subs subs">Done</a>
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
   function candidate_validate2() {
   return true;
		if($('#passportno').val()=='')
		{
			alert('Enter passport number');
			$('#passportno').focus();
			return false;
		}   
		if($('#driving_license').val()=='')
		{
			alert('Enter driving liscence number');
			$('#driving_license').focus();
			return false;
		}
	    return true;
    }
   $('#edit_candidate2').click(function(){
		var dataStringprop = $("#candidate_form2").serialize();
		var isContactValid = candidate_validate2();
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates_all/editPassportDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							var img_path = '<?php echo base_url();?>assets/images/loader.gif';
							$("#step1").html('<img src="'+img_path+'" alt="Uploading...."/>');
                            var site_url = "<?php echo site_url('candidates_all/summary'); ?>" +'/'+ candidateId;
                           window.location=site_url;
						   
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
var dataStringprop = $("#candidate_form2").serialize();
	$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates_all/skip_step3'); ?>"+'/'+candidateId,
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
                            var site_url = "<?php echo site_url('candidates_all/summary'); ?>" +'/'+ id;
                           window.location=site_url;
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

$('#step_back').click(function(){
var candidateId = '<?php echo $formdata['candidate_id'] ?>';
var dataStringprop = $("#candidate_form").serialize();
	$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates_all/step_back'); ?>"+'/'+candidateId,
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
                            var site_url = "<?php echo site_url('candidates_all/loadEditContacthtml'); ?>" +'/'+ id;
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