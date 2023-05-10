<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form3" name="candidate_form3" > 
<table class="hori-form">
<tbody>

<tr>
<td>Level of Study</td>
 <td> <?php echo form_dropdown('level_id',  $edu_level_list, $formdata['level_id'],'class="form-control" id="level_id"');?> </td>
</tr>
<tr>
<td>Course</td>
 <td> <?php echo form_dropdown('course_id',  $edu_course_list, $formdata['course_id'],'class="form-control" id="course_id"');?> </td>
</tr>
<tr>
<td>Specialization/Industry</td>
 <td> <?php echo form_dropdown('spcl_id',  $edu_spec_list, $formdata['spcl_id'],'class="form-control" id="spcl_id"');?> </td>
</tr>
<tr>
<td>University</td>
 <td> <?php echo form_dropdown('univ_id',  $edu_univ_list, $formdata['univ_id'],'class="form-control" id="univ_id"');?> </td>
</tr>
<tr>
<td>Year</td>
 <td> <?php echo form_dropdown('edu_year',  $edu_years_list, $formdata['edu_year'],'class="form-control" id="edu_year"');?> </td>
</tr>
<tr>
<td>Country</td>
 <td> <?php echo form_dropdown('edu_country',  $country_list, $formdata['edu_country'],'class="form-control" id="edu_country"');?> </td>
</tr>
<tr>
<td>Course Type</td>
 <td> <?php echo form_dropdown('course_type_id',  $edu_course_type_list, $formdata['course_type_id'],'class="form-control" id="course_type_id"');?> </td>
</tr>


<tr>
<td>Arrears</td>
 <td> <input style="width:100px;" placeholder="arrears"  type="text"  name="arrears" value="<?php echo $formdata['arrears'];?>" id="arrears"> </td>
</tr>

<tr>
<td>Absesnce</td>
 <td> <input style="width:100px;" placeholder="absesnse"  type="text"  name="absesnse" value="<?php echo $formdata['absesnse'];?>" id="absesnse"> </td>
</tr>

<tr>
<td>Repeat</td>
 <td> <input style="width:100px;" placeholder="repeat"  type="text"  name="repeat" value="<?php echo $formdata['repeat'];?>" id="repeat"> </td>
</tr>

<tr>
<td>Year Back</td>
 <td> <input style="width:100px;" placeholder="year_back"  type="text"  name="year_back" value="<?php echo $formdata['year_back'];?>" id="year_back"> </td>
</tr>

<tr>
<td>Total Percentage</td>
 <td> <input style="width:100px;" placeholder="mark_percentage"  type="text"  name="mark_percentage" value="<?php echo $formdata['mark_percentage'];?>" id="mark_percentage"> </td>
</tr>

<tr>
<td>Grade</td>
 <td> <input style="width:100px;" placeholder="grade"  type="text"  name="grade" value="<?php echo $formdata['grade'];?>" id="grade"> </td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="attach-subs" value="Update & Continue" id="save_candidate3" style="width:180px;">
<input type="button" class="attach-subs subs" value="Back" id="step_back">
<input type="button" class="attach-subs subs" value="Skip" id="skip_edu">
<a href="<?php echo $this->config->site_url();?>/contact" class="attach-subs subs">Done</a>
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
   function candidate_validate3() {
/*		if($('#level_id').val()==0)
		{
			alert('Select Level');
			$('#level_id').focus();
			return false;
		}   
*/		if($('#course_id').val()==0)
		{
			alert('Select course');
			$('#course_id').focus();
			return false;
		}
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
   $('#save_candidate3').click(function(){
		var dataStringprop = $("#candidate_form3").serialize();
		var isContactValid = candidate_validate3();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('contact/editEducationDetail'); ?>"+'/'+candidateId,
				cache: false,
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							var img_path = '<?php echo base_url();?>assets/images/loader.gif';
							$("#step1").html('<img src="'+img_path+'" alt="Uploading...."/>');
                            var site_url = "<?php echo site_url('contact/loadEditJobhtml'); ?>" +'/'+ candidateId;
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


$('#skip_edu').click(function(){

var candidateId = '<?php echo $candidate_id; ?>';
var dataStringprop = $("#candidate_form3").serialize();
	$.ajax({
				type: "post",
				url: "<?php echo site_url('contact/skip_step2'); ?>"+'/'+ candidateId,
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
							//alert(id);
                            var site_url = "<?php echo site_url('contact/loadEditJobhtml'); ?>" +'/'+ id;
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

$('#step_back').click(function(){

var candidateId = '<?php echo $candidate_id; ?>';
var dataStringprop = $("#candidate_form").serialize();
	$.ajax({
				type: "post",
				url: "<?php echo site_url('contact/step_back'); ?>"+'/'+candidateId,
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
                            var site_url = "<?php echo site_url('contact/loadEditPassporthtml'); ?>" +'/'+ id;
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