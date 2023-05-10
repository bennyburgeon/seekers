<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">



<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active">Add Skills  </li>
      </ul>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Admin module Add</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
<form action="<?php echo $this->config->site_url();?>/skill_mgmt/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 

<input type="hidden" name="parent_skill" value="0">

<tr>
<td>Skill Name</td>
<td>
<input type="text" class="form-control" name="skill_name" id="skill_name" value="<?php if(isset($formdata["skill_name"]) && !empty($formdata["skill_name"])) echo $formdata["skill_name"]; ?>" placeholder="Skill Name">
</td>
</tr>
<!-- 
<tr>
<td>Industry</td>
<td><?php //echo form_dropdown('job_cat_id', $industry_list , $formdata['job_cat_id'],'style="width:200px;" class="form-control"  id="job_cat_id" ');?></td>
</tr>

<tr>
<td>Functional Area</td>
<td><?php //echo form_dropdown('func_id', $func_list , $formdata['func_id'],'style="width:200px;" class="form-control"  id="func_id" ');?></td>
</tr>
-->
<tr>
<td>Designation</td>
<td><?php echo form_dropdown('desig_id[]', $desig_list , $formdata['desig_id'],'class="form-control hori" multiple="multiple" style="height:500px;" id="desig_id"');?></td>
</tr>


<tr>
<td>Status</td>
 <td> 
	 <label class="radio-inline">
	<input type="radio" name="active" id="optionsRadios25" value="1" <?php if($formdata["active"]==1){echo 'checked="checked"';} ?>> Active </label>
	<label class="radio-inline">
	<input type="radio" name="active" id="optionsRadios26" value="0" <?php if($formdata["active"]==0){echo 'checked="checked"';} ?>> Inactive </label></td>	
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/skill_mgmt" class="attach-subs subs">Cancel</a>
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
function validate()
{

if($('#skill_name').val()=='')
 {
  alert('Please enter skill name');
  $('#skill_name').focus();
  return false;
 }

 return true
}
</script>
<script type="text/javascript">
	$('#job_cat_id').change(function() {
		
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');

	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');	
			
	//if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/skill_mgmt/get_functional_by_industry/',
		  data: { job_cat_id: $('#job_cat_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#func_id').html('');
				  $.each(data.func_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#func_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#func_id').append('<option value="'+ index +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Select Functional Area</option');
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Select Designation</option');
		  }
		});	
});

	$('#func_id').change(function() {
		
	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');
			
	if($('#func_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/skill_mgmt/get_designation_by_function/',
		  data: { func_id: $('#func_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#desig_id').html('');
				  $.each(data.desig_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#desig_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#desig_id').append('<option value="'+ index +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Select Designation</option');
		  }
		});	
});
</script>