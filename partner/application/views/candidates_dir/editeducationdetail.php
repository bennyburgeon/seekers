<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="update_education_frm" action="<?php echo $this->config->site_url();?>candidates_dir/update_education/" name="update_education_frm" > 
  
  <input type="hidden" name="edu_id" value="<?php echo $edu_id;?>"?>
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>"?>
   
<table class="hori-form">
<tbody>

<tr>
<td>Level of Study</td>
<td> <?php echo form_dropdown('level_id',  $edu_level_list, $formdata['level_id'],'class="form-control" id="upd_level_id"');?> </td>
    
</tr>

<tr>
<td>Course</td>
<td><input type="text" name="course" class="form-control" placeholder="Course"  id="course" value="<?php echo $formdata['course']; ?>">  </td>
</tr>

<tr>
<td>Specialization/Industry</td>
<td> <input type="text" name="spcl" class="form-control" placeholder="Specialization"  id="spcl" value="<?php echo $formdata['spcl']; ?>"></td>
</tr>

<tr>
<td>University</td>
<td><input type="text" name="univ" class="form-control" placeholder="University"  id="univ" value="<?php echo $formdata['univ']; ?>"></td>
</tr>

<tr>
<td>Year</td>
<td>  <input type="text" name="edu_year" class="form-control" placeholder="Year"  id="edu_year" value="<?php echo $formdata['edu_year']; ?>"> </td>
</tr>
    
 <tr>
<td>Mark Percentage</td>
<td><input type="text" name="mark_percentage" class="form-control" placeholder="University"  id="mark_percentage" value="<?php echo $formdata['mark_percentage']; ?>"></td>
</tr>

<tr>
<td>Country</td>
<td> <input type="text" name="edu_country" class="form-control" placeholder="Country"  id="edu_country" value="<?php echo $formdata['edu_country']; ?>"> </td>
</tr>

<tr>
<td>Course Type</td>
<td> <input type="text" name="course_type" class="form-control" placeholder="Course Type"  id="course_type" value="<?php echo $formdata['course_type']; ?>"></td>
</tr>
<!-- 
<tr>
<td>Arrears</td>
<td> <input style="width:100px;" placeholder="arrears"  type="text"  name="arrears" value="<?php echo $formdata['arrears'];?>" id="upd_arrears"> </td>
</tr>

<tr>
<td>Absesnce</td>
<td> <input style="width:100px;" placeholder="absesnse"  type="text"  name="absesnse" value="<?php echo $formdata['absesnse'];?>" id="upd_absesnse"> </td>
</tr>

<tr>
<td>Repeat</td>
<td> <input style="width:100px;" placeholder="repeat"  type="text"  name="repeat" value="<?php echo $formdata['repeat'];?>" id="upd_repeat"> </td>
</tr>

<tr>
<td>Year Back</td>
<td> <input style="width:100px;" placeholder="year_back"  type="text"  name="year_back" value="<?php echo $formdata['year_back'];?>" id="upd_year_back"> </td>
</tr>

<tr>
<td>Total Percentage</td>
<td> <input style="width:100px;" placeholder="mark_percentage"  type="text"  name="mark_percentage" value="<?php echo $formdata['mark_percentage'];?>" id="upd_mark_percentage"> </td>
</tr>

<tr>
<td>Grade</td>
 <td> <input style="width:100px;" placeholder="grade"  type="text"  name="grade" value="<?php echo $formdata['grade'];?>" id="upd_grade"> </td>
</tr>
-->
<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Save" id="update_education" style="width:180px;">
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
   function update_edu_validate() {
		if($('#upd_level_id').val()==0)
		{
			alert('Select Level');
			$('#upd_level_id').focus();
			return false;
		}   
		if($('#upd_course_id').val()==0)
		{
			alert('Select course');
			$('#upd_course_id').focus();
			return false;
		}
	    return true;
    }
});
$(document).on('click', '#edit_edu', function()
{ 
	
	var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,
	   dataType: "html",
	   success: function (data) 
	   {	
			$('#data_holder').html(data);
					
   	   }			
	 }); 
	$('#edit_education').modal('show');	
}


$('#upd_level_id').change(function() 
	{	
		jQuery('#upd_course_id').html('');
		jQuery('#upd_course_id').append('<option value="">Select Course</option');
			
		if($('#upd_level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_all/getcourses/',
			  data: { level_study: $('#level_id').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#upd_course_id').html('');
					jQuery('#upd_course_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#upd_course_id').html('');
					  jQuery('#upd_course_id').append(data.course_list);

				 /* sorting start hrre */
					var my_options = $("#upd_course_id option");
					var selected = $("#upd_course_id").val(); /* preserving original selection, step 1 */
					my_options.sort(function(a,b) {
						if (a.text > b.text) return 1;
						else if (a.text < b.text) return -1;
						else return 0
					})
					$("#upd_course_id").empty().append( my_options );
					$("#upd_course_id").val(selected); /* preserving original selection, step 2 */
				  /* sorting end hrre */					 
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#upd_course_id').html('');
					jQuery('#upd_course_id').append('<option value="">Select Course</option');
			  }
			});	
	});
	
	

</script>