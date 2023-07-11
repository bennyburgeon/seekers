<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?></h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

    
      <form action="<?php echo $this->config->site_url();?>trainingcenter/add?<?php echo $query_string;?>" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
    <tr>
    <td> Trainingcenter Name</td>
    <td colspan="2"> <input type="text" id="center_name" name="center_name" value="<?php echo $formdata['center_name'];?>" placeholder=" Enter Trainingcenter Name" class="form-control" /></td>
    </tr>

    
    <tr>
    <td>Attach Logo</td>
    <td> <?php echo form_upload(array('name'=>'center_logo','class'=>'smallinput', ''));?>
    </td>
    </tr>
        
    <tr>
    <td> Trainingcenter Type</td>
    <td colspan="2"><?php echo form_dropdown('type_id', $type_list , $formdata['type_id'],'class="form-control"  id="type_id" ');?>
	</td>
    </tr>

    <tr>
    <td>Industry</td>
    <td colspan="2"><?php echo form_dropdown('ind_id', $industry_list , $formdata['ind_id'],'class="form-control"  id="ind_id" ');?>
</td>
    </tr>
        

    
    <tr>
    <td>Rating</td>
    <td colspan="2"><?php echo form_dropdown('center_rating', $company_rating_list , $formdata['center_rating'],'class="form-control"  id="center_rating" ');?>
</td>
    </tr>
        

      <tr>
    <td>Trainingcenter Phone</td>
    <td colspan="2"> <input type="text" id="center_phone" name="center_phone" value="<?php echo $formdata['center_phone'];?>" placeholder="Enter Trainingcenter Phone" class="form-control" />	
</td>
    </tr>

      <tr>
    <td>Contact Name</td>
    <td colspan="2"> <input type="text" id="contact_name" name="contact_name" value="<?php echo $formdata['contact_name'];?>" placeholder="Enter Contact Name" class="form-control" />
</td>
    </tr>

      <tr>
    <td>Designation</td>
    <td colspan="2"> <input type="text" id="designation" name="designation" value="<?php echo $formdata['designation'];?>" placeholder="Enter Designation" class="form-control" />
</td>
    </tr>
    
      <tr>
    <td>Notes</td>
    <td colspan="2"> <input type="text" id="contact_name_notes" name="contact_name_notes" value="<?php echo $formdata['contact_name_notes'];?>" placeholder="Enter Contact Name Notes" class="form-control" />
</td>
    </tr> 
       
    <tr>
    <td>Contact Email</td>
    <td colspan="2">  <input type="text" id="contact_email" name="contact_email" value="<?php echo $formdata['contact_email'];?>" placeholder="Enter Contact Email" class="form-control" />
    </td>
    </tr>

      <tr>
    <td>Contact Phone</td>
    <td>  <input type="text" id="contact_phone" name="contact_phone" value="<?php echo $formdata['contact_phone'];?>" placeholder="Enter Contact Phone" class="form-control" />	
</td>

    <td><input type="text" id="contact_phone_ext" name="contact_phone_ext" value="<?php echo $formdata['contact_phone_ext'];?>" placeholder="Ext." class="form-control" /></td>
      </tr>

<tr>
<td>Phone 1</td>
<td colspan="2">    <input type="text" id="contact_phone_1" name="contact_phone_1" value="<?php echo $formdata['contact_phone_1'];?>" placeholder="Alternate Phone" class="form-control" />
</td>
</tr>

<tr>
<td>Phone 2</td>
<td colspan="2">    <input type="text" id="contact_phone_2" name="contact_phone_2" value="<?php echo $formdata['contact_phone_2'];?>" placeholder="Alternate Phone" class="form-control" />
</td>
</tr>

<tr>
<td>Facebook</td>
<td colspan="2">    <input type="text" id="contact_facebook" name="contact_facebook" value="<?php echo $formdata['contact_facebook'];?>" placeholder="FB Link" class="form-control" />
</td>
</tr>

<tr>
<td>LInkedin</td>
<td colspan="2">    <input type="text" id="contact_linkedin" name="contact_linkedin" value="<?php echo $formdata['contact_linkedin'];?>" placeholder="Linkedin Link" class="form-control" />
</td>
</tr>

<tr>
<td>Twitter</td>
<td colspan="2">    <input type="text" id="contact_twitter" name="contact_twitter" value="<?php echo $formdata['contact_twitter'];?>" placeholder="Twitter Link" class="form-control" />
</td>
</tr>

<tr>
<td>Location Map</td>
<td colspan="2">    <input type="text" id="location_map" name="location_map" value="<?php echo $formdata['location_map'];?>" placeholder="Location Map" class="form-control" />
</td>
</tr>

<tr>
<td>Google Map</td>
<td colspan="2">    <input type="text" id="google_map" name="google_map" value="<?php echo $formdata['google_map'];?>" placeholder="Google Map" class="form-control" />
</td>
</tr>


<tr>
<td>Website</td>
<td colspan="2">    <input type="text" id="center_website" name="center_website" value="<?php echo $formdata['center_website'];?>" placeholder="Enter Website" class="form-control" />
</td>
</tr>
      
     <tr>
    <td>Country</td>
    <td colspan="2"><?php echo form_dropdown('country_id', $country_list , $formdata['country_id'],'class="form-control"  id="country_id" ');?>
</td>
    </tr>
    
      <tr>
    <td>State</td>
    <td colspan="2"><?php echo form_dropdown('state_id', $state_list , $formdata['state_id'],'class="form-control"  id="state_id" ');?>
</td>
    </tr>
      <tr>
    <td>City</td>
    <td colspan="2"><?php echo form_dropdown('city_id', $city_list , $formdata['city_id'],'class="form-control"  id="city_id" ');?>
</td>
    </tr>

<tr>
<td>Building</td>
<td colspan="2"><input type="text" id="building_location" name="building_location" value="<?php echo $formdata['building_location'];?>" placeholder="Enter Building" class="form-control" />
</td>
</tr>
    
        </tr>
      <tr>
    <td>Address</td>
    <td colspan="2"> 
    <textarea id="center_address" name="center_address" rows="8" placeholder=" Enter Trainingcenter Address" class="form-control" ><?php echo $formdata['center_address'];?></textarea>
    <?php // echo $this->ckeditor->editor('center_address',$formdata['center_address']);?></td>
    </tr>
    
     </tr>
      <tr>
    <td>Trainingcenter Email</td>
    <td colspan="2"><input type="text" id="center_email" name="center_email" value="<?php echo $formdata['center_email'];?>" placeholder=" Enter Trainingcenter Email" class="form-control" />	</textarea>
</td>
    </tr>


<tr>
    <td>Specialties</td>
    <td colspan="2">  <input type="text" id="specialties" name="specialties" value="<?php echo $formdata['specialties'];?>" placeholder="Enter Specialties" class="form-control" />	
</td>
    </tr>
    
  

<tr>
    <td>Founded</td>
    <td colspan="2">  <input type="text" id="founded" name="founded" value="<?php echo $formdata['founded'];?>" placeholder="Enter Founded" class="form-control" />	
</td>
    </tr>

      <tr>
    <td>Google+</td>
    <td colspan="2">     <input type="text" id="googleplus" name="googleplus" value="<?php echo $formdata['googleplus'];?>" placeholder=" Enter Google+" class="form-control" />	
</td>
  
   
    <tr>
    <td>Twitter+</td>
    <td colspan="2">      <input type="text" id="twitter" name="twitter" value="<?php echo $formdata['twitter'];?>" placeholder="Enter Twitter" class="form-control" />	
</td>
    
     <tr>
    <td>Facebook</td>
    <td colspan="2"><input type="text" id="facebook" name="facebook" value="<?php echo $formdata['facebook'];?>" placeholder="Enter Facebook" class="form-control" />
</td>
    
     <tr>
    <td>Linkedin</td>
    <td colspan="2">  <input type="text" id="linkedin" name="linkedin" value="<?php echo $formdata['linkedin'];?>" placeholder="Enter Linkedin" class="form-control" />	
</td>
    
      <tr>
    <td>Trainingcenter Profile</td>
    <td colspan="2"><?php echo $this->ckeditor->editor('center_profile',$formdata['center_profile']);?></td>
    </tr>
    
    <tr>
    <td colspan="3">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>trainingcenter?<?php echo $query_string;?>" class="attach-subs subs">Cancel</a>
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
	if($('#center_name').val()=='')
	{
		alert('Please enter company name');
		$('#center_name').focus();
		return false;
	}
/*	
	if($('#type_id').val()=='0')
	{
		alert('Please select company type');
		$('#type_id').focus();
		return false;
	}	
	if($('#center_email').val()!=''){
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test($('#center_email').val())){
			alert('Enter valid email');
			$('#center_email').focus();
			return false;
		}
	}
	if($('#center_email').val()!=''){
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test($('#contact_email').val())){
			alert('Enter valid email');
			$('#contact_email').focus();
			return false;
		}
	}
		if(isNaN($('#contact_phone').val())){
			alert('Enter valid number');
			$('#contact_phone').focus();
			return false;
		}
		if(isNaN($('#center_phone').val())){
			alert('Enter valid number');
			$('#center_phone').focus();
			return false;
		}
*/

	return true;
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
		  url: '<?php echo $this->config->site_url();?>trainingcenter/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>trainingcenter/getcity/',
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

