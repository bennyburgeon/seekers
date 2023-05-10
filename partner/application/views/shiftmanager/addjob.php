<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>/shiftmanager">Shifts</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Add Shift</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/>
<h3>Add Shift</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<form action="<?php echo $this->config->site_url();?>/shiftmanager/add" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
<table class="hori-form">
<tbody>
    
    <tr>
    <td>Shift Title</td>
    <td> <input type="text" id="shift_title" name="shift_title" value="<?php echo $formdata['shift_title'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
    <tr>
    <td>Shift Date</td>
    <td> <input type="text" id="shift_date" name="shift_date" value="<?php echo $formdata['shift_date'];?>" placeholder="" class="form-control hori" />
    </td>
    </tr>
    
    <tr>
    <td>Company name</td>
    <td> 
    <?php echo form_dropdown('company_id', $company, $formdata['company_id'],'class="form-control hori" id="company_id"');?>
    </td>
    </tr>

    <tr>
    <td>Band</td>
    <td> 
    <?php echo form_dropdown('band_id', $band_list, $formdata['band_id'],'class="form-control hori" id="band_id"');?>
    </td>
    </tr>
   <!-- 
    <tr>
    <td>Shift Status</td>
    <td> 
    <?php echo form_dropdown('shift_status_id', $shift_status_list, $formdata['shift_status_id'],'class="form-control hori"');?>
    </td>
    </tr>
-->
    <tr>
    <td>Country</td>
    <td>
     <?php echo form_dropdown('country_id', $country_list, $formdata['country_id'],'class="form-control hori" id="country_id"  id="country_id" ');?>
    </td>
    </tr>

    <tr>
    <td>State</td>
    <td>
     <?php echo form_dropdown('state_id', $state_list, $formdata['state_id'],'class="form-control hori"  id="state_id" ');?>
    </td>
    </tr>

    <tr>
      <td>Job location</td>
      <td>
        <?php echo form_dropdown('location_id', $city_list, $formdata['location_id'],'class="form-control hori"  id="city_id" ');?>
        </td>
    </tr>
    
    <tr>
      <td>Gender</td>
      <td> 
        <?php 
						
						$data = array(
						'name'        => 'gender',
						'id'          => 'gender',
						'value'       => '2',
						'checked'     => '',
						'style'       => 'margin:10px',
						);
						if($formdata['gender']=='2') $data['checked']='TRUE';
						echo form_radio($data).'Male';
						$data = array(
							'name'        => 'gender',
							'id'          => 'gender',
							'value'       => '1',
							'checked'     => '',
							'style'       => 'margin:10px',
							);
						if($formdata['gender']=='1') $data['checked']='TRUE';
						echo form_radio($data).'Female';

						$data = array(
							'name'        => 'gender',
							'id'          => 'gender',
							'value'       => '0',
							'checked'     => '',
							'style'       => 'margin:10px',
							);
							
						if($formdata['gender']=='0') $data['checked']='TRUE';
						echo form_radio($data).'No Preference';						
						
					?>						
        
        </td>
    </tr>
    

    <tr>
      <td>Designation/Role</td>
      <td> <?php echo form_dropdown('desig_id', $roles_list, $formdata['desig_id'],'class="form-control hori"');?>
        </td>
    </tr>
    
    <tr>
      <td>Shift Name</td>
      <td> <?php echo form_dropdown('shift_id', $shift_list, $formdata['shift_id'],'class="form-control hori"');?>
        </td>
    </tr>
    
    <tr>
      <td colspan="2">
        <span class="click-icons">
          <input type="submit" class="attach-subs" value="Create">
          <a href="<?php echo $this->config->site_url();?>/shiftmanager" class="attach-subs subs">Cancel</a>
          </span>
        </td>
    </tr>


</tbody>
</table>
</form>

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>

<script type="text/javascript">

$(".js-example-basic-multiple-cert").select2();
$(".js-example-basic-multiple-skill").select2();

//onchange of job_category

	$('#job_cat_id').change(function() 
	{
	
		jQuery('#func_id').html('');
		jQuery('#func_id').append('<option value="">Select Function</option');
			
		if($('#job_cat_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/shiftmanager/getfunction/',
			  data: { category_id: $('#job_cat_id').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#func_id').html('');
					  jQuery('#func_id').append(data.function_list);

					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Please try again');
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Select Function</option');
			  }
			});	
	});

function validate()
{
	if($('#shift_title').val()=='')
	{
		alert('Please enter job title');
		$('#shift_title').focus();
		return false;
	}
	
	else if($('#company_id').val()== 0)
	{
		alert('Please select company name');
		$('#company_id').focus();
		return false;
	}
	return true;
}
$(document).ready(function()
{
	$('#job_post_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#job_expiry_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#shift_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
});



function myFunction()
{
	  var parnt =$('#parent').val();
      if(parnt!='')
	  {
	  $.ajax({
      type: "get",
      async: true,
      url: "<?php echo site_url('manage_data/child_skill'); ?>",
      data: {'id':parnt},
      dataType: "json",
      success: function(res) {
       
       create_selectbox(res);
     
     console.log(res['skillset']);
    
							} 
			}); 
	  }
	  else{
		  	$('#skill-tr').hide();
		 	$('#multiple_skill').val('');
			$('#multiple_skill').html('');
	 }
   }

function create_selectbox(res)
{ 
	var skillset=res['skillset'];
	var count=skillset['length'];
	

	if(count>0)
	{
    
	$('#skill-tr').show();
    $('#multiple_skill').val('');
	$('#multiple_skill').html('');
	$('#multiple_skill').append('<option value="">Select Skills</option>');
        for(var k=0;k<count;k++)
        {   
            
            var option	=	'<option value="'+skillset[k]['skill_id']+'">'+skillset[k]['skill_name']+'</option>';
            
            $('#multiple_skill').append(option);
    
        }
	}
	else{
		$('#skill-tr').hide();
		$('#multiple_skill').val('');
		$('#multiple_skill').html('');
	}
	
}
</script>	

<script type="text/javascript">
	$('#country_id').change(function() {
		
	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
			
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/shiftmanager/getstate/',
		  data: { country_id: $('#country_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#state_id').html('');
				  $.each(data.state_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#state_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#state_id').append('<option value="'+ index +'">'+ value +'</option');
				 });
						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Select State</option');
		  }
		});	
});
	$('#state_id').change(function() {

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
		
	if($('#state_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/shiftmanager/getcity/',
		  data: { state_id: $('#state_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#city_id').html('');
				  $.each(data.city_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#city_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#city_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Select City</option');
		  }
		});	
});
</script>
          