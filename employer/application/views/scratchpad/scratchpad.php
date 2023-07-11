<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>

<section class="bot-sep">
<div class="section-wrap">
<div class="row">

<!-- BEGIN SAMPLE FORM PORTLET-->

<div class="col-sm-12 pages">
<a href="<?php echo $this->config->site_url();?>">Home</a> / <a href="<?php echo $this->config->site_url();?>/scratchpad">Scratchpad</a></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-7.png');?>" alt=""/><h3>scratchpad form</h3></div>
<div class="table-tech specs hor">
<table class="hori-form" border="0">

<tbody>
<tr>
<td colspan="3">
<table width="100%" border="1">
  <tr>
    <td colspan="3">List here</td>
  </tr>
<?php 
foreach($scratch_list as $key => $val)
{
?>  
  <tr>
    <td width="25%"><?php if($val['datetime']!='' && $val['datetime']!='0000-00-00 00:00:00')echo date('d F, Y,  D h:i:s A',$val['datetime']);?></td>
    <td width="66%"><?php echo $val['scratch_content'];?></td>
     <td width="9%"><a href="<?php echo base_url();?>index.php/scratchpad/delete/<?php echo $val['scratch_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>	</td>
  </tr>

<?php 
}
?>
</table></td>
</tr>
<tr>
<td colspan="3" align="center" valign="middle"><?php if($message!=''){?>  
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo $message;?>
</div>
<?php }?></td>
</tr>
<tr>
<td colspan="3" bgcolor="#CCCCCC">
Manage Scratch Pad</td>
</tr>

<tr>
 
  <td width="55%">Create Notes</td>
  <td width="45%">Create Task</td>
</tr>
<tr>

<td valign="top">
<form action="<?php echo $this->config->site_url();?>/scratchpad/update" class="form-horizontal form-bordered"  method="post" id="scratch_form" name="scratch_form" enctype="multipart/form-data"> 

<?php echo $this->ckeditor->editor('scratch_content',$formdata['scratch_content']);?>

<br />
<input type="button" style="width:180px;" id="save_scratch" value="Save" class="attach-subs">
</form>
</td>

<td  valign="top"><form action="<?php echo $this->config->site_url();?>/scratchpad/create_task" class="form-horizontal form-bordered"  method="post" id="task_form" name="task_form" enctype="multipart/form-data"> 

<table width="100%" border="0">
  <tr>
    <td><input type="text" name="task_title" value="<?php echo $taskinfo['task_title'];?>" id="task_title" placeholder="Title" /></td>
  </tr>
  
  <tr>
    <td><input type="radio" name="task_priority_id" value="1" <?php if($taskinfo['task_priority_id']==1)echo 'checked="checked"';?>/>
      High <br />
      <input type="radio" name="task_priority_id" readonly value="2"  <?php if($taskinfo['task_priority_id']==2)echo 'checked="checked"';?> />
      Medium <br />
      <input type="radio" name="task_priority_id" value="3"  <?php if($taskinfo['task_priority_id']==3)echo 'checked="checked"';?>/>
      Low <br />      </td>
  </tr>

<tr>
    <td><input type="radio" name="task_status_id" value="1" <?php if($taskinfo['task_status_id']==1)echo 'checked="checked"';?>/>
    Open
    <br />
      <input type="radio" name="task_status_id" readonly value="2"  <?php if($taskinfo['task_status_id']==2)echo 'checked="checked"';?> />
      Dropped
      <br />
      <input type="radio" name="task_status_id" value="3"  <?php if($taskinfo['task_status_id']==3)echo 'checked="checked"';?>/>
      Closed      <br />      </td>
  </tr>  

  <tr>
    <td><input style="width:200px;" type="text" name="due_date" maxlength="20" readonly id="datepicker1" value="<?php echo $taskinfo['due_date'];?>" placeholder="Due On" /></td>
  </tr>
  
  <tr>
    <td><?php echo form_dropdown('admin_id',  $admin_list, $taskinfo['admin_id'],'class="form-control" id="admin_id"');?></td>
  </tr>
  <tr>
    <td><textarea  data-provide="markdown"id="task_desc"   name="task_desc" rows="5" class="form-control horiz"></textarea></td>
  </tr>
</table>

</form>
<br />
<input type="button" style="width:180px;" id="save_task" value="Create Task" class="attach-subs">
</td>
<td>
</td>
</tr>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

</tbody>

</table>
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<script>
var userFlag = 0;
$( document ).ready(function() {

	$('#datepicker').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});

	$('#datepicker1').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});
		
	function scratch_validate()
	{
		if($('#scratch_content').val()=='')
		{
			alert('Please enter Content');
			$('#scratch_content').focus();
			return false;
		}	
		return true;
	}

   function candidate_validate() {
		
		if($('#first_name').val()=='')
		{
			alert('Please enter first name');
			$('#first_name').focus();
			return false;
		}   
 
		if($('#username').val()=='')
		{
			alert('Please enter email');
			$('#username').focus();
			return false;
		}
	
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test($('#username').val())){
			alert('Enter valid email');
			$('#username').focus();
			return false;
		}
		
		if($('#mobile').val()=='')
		{
			alert('Enter mobile');
			$('#mobile').focus();
			return false;
		}		

		if($('#level_study').val()=='')
		{
			alert('Pelase select education level');
			$('#level_study').focus();
			return false;
		}	
		

		if($('#course_id').val()=='')
		{
			alert('Please select interested program');
			$('#course_id').focus();
			return false;
		}	

		if($('#edu_level_study').val()=='')
		{
			alert('Pelase select education level');
			$('#edu_level_study').focus();
			return false;
		}	
		
		if($('#edu_course_id').val()=='')
		{
			alert('Please select qualification');
			$('#edu_course_id').focus();
			return false;
		}	
								
	    return true;
    }

   function task_validate() {
		
		if($('#task_title').val()=='')
		{
			alert('Please add task title');
			$('#task_title').focus();
			return false;
		}   
 
		if($('#datepicker1').val()=='')
		{
			alert('Pelase enter a due date');
			$('#datepicker1').focus();
			return false;
		}
	    return true;
    }

	
   $('#save_candidate').click(function(){
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$("#candidate_form").submit();
		} //end contact valid
   });//end button click function save*/

   $('#save_task').click(function(){
		var isContactValid = task_validate();
		if(isContactValid) {
			$("#task_form").submit();
		} //end contact valid
   });//end button click function save*/

   $('#save_scratch').click(function(){
		var isContactValid = scratch_validate();
		
		if(isContactValid) {
			$("#scratch_form").submit();
		} //end contact valid
   });//end button click function save*/   
      
});   // end document.ready

	$('#level_study').change(function() 
	{
		jQuery('#course_id').html('');
		jQuery('#course_id').append('<option value="">Select Course</option');

		if($('#level_study').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates/getcourses/',
			  data: { level_study: $('#level_study').val(),int_val:2},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#course_id').html('');
					jQuery('#course_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#course_id').html('');
					  var val_ar=new Array();
					  $.each(data.course_list, function (index, value) 
					  {
						  if(index=='')
							 jQuery('#course_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#course_id').append('<option value="'+ index +'">' + value + '</option');
					 });
				 /* sorting start hrre */
					var my_options = $("#course_id option");
					var selected = $("#course_id").val(); /* preserving original selection, step 1 */
					my_options.sort(function(a,b) {
						if (a.text > b.text) return 1;
						else if (a.text < b.text) return -1;
						else return 0
					})
					$("#course_id").empty().append( my_options );
					$("#course_id").val(selected); /* preserving original selection, step 2 */
				  /* sorting end hrre */

				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#course_id').html('');
					jQuery('#course_id').append('<option value="">Select Course</option');
			  }
			});	
	});

	$('#edu_level_study').change(function() 
	{
		jQuery('#edu_course_id').html('');
		jQuery('#edu_course_id').append('<option value="">Select Course</option');

		if($('#edu_level_study').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates/getcourses/',
			  data: { level_study: $('#edu_level_study').val(),int_val:1},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#edu_course_id').html('');
					jQuery('#edu_course_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#edu_course_id').html('');
					  var val_ar=new Array();
					  $.each(data.course_list, function (index, value) 
					  {
						  if(index=='')
							 jQuery('#edu_course_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#edu_course_id').append('<option value="'+ index +'">' + value + '</option');
					 });
				 /* sorting start hrre */
					var my_options = $("#edu_course_id option");
					var selected = $("#edu_course_id").val(); /* preserving original selection, step 1 */
					my_options.sort(function(a,b) {
						if (a.text > b.text) return 1;
						else if (a.text < b.text) return -1;
						else return 0
					})
					$("#edu_course_id").empty().append( my_options );
					$("#edu_course_id").val(selected); /* preserving original selection, step 2 */
				  /* sorting end hrre */

				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#edu_course_id').html('');
					jQuery('#edu_course_id').append('<option value="">Select Course</option');
			  }
			});	
	});

	
</script>	