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

    
      <form action="<?php echo $this->config->site_url();?>/company_calls/add" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
    <tr>
    <td> Company Name</td>
    <td> <input type="text" id="company_name" name="company_name" value="<?php echo $formdata['company_name'];?>" placeholder=" Enter Company Name" class="form-control" /></td>
    </tr>
    
    <tr>
    <td> Company Type</td>
    <td><?php echo form_dropdown('type_id', $type_list , $formdata['type_id'],'class="form-control"  id="type_id" ');?>
	</td>
    </tr>
    
    <tr>
    <td>Priority</td>
    <td><?php echo form_dropdown('company_priority', $company_priority_list , $formdata['company_priority'],'class="form-control"  id="company_priority" ');?>
</td>
    </tr>

    <tr>
    <td>Industry</td>
    <td colspan="2"><?php echo form_dropdown('ind_id', $industry_list , $formdata['ind_id'],'class="form-control"  id="ind_id" ');?>
</td>
    </tr>
        
    <tr>
    <td>Rating</td>
    <td><?php echo form_dropdown('company_rating', $company_rating_list , $formdata['company_rating'],'class="form-control"  id="company_rating" ');?>
</td>
    </tr>
        

      <tr>
    <td>Company Phone</td>
    <td> <input type="text" id="company_phone" name="company_phone" value="<?php echo $formdata['company_phone'];?>" placeholder="Enter Company Phone" class="form-control" />	
</td>
    </tr>

      <tr>
    <td>Contact Name</td>
    <td> <input type="text" id="contact_name" name="contact_name" value="<?php echo $formdata['contact_name'];?>" placeholder="Enter Contact Name" class="form-control" />
</td>
    </tr>

      <tr>
    <td>Contact Email</td>
    <td>  <input type="text" id="contact_email" name="contact_email" value="<?php echo $formdata['contact_email'];?>" placeholder="Enter Contact Email" class="form-control" />
</td>
    </tr>

      <tr>
    <td>Contact Phone</td>
    <td>  <input type="text" id="contact_phone" name="contact_phone" value="<?php echo $formdata['contact_phone'];?>" placeholder="Enter Contact Phone" class="form-control" />	
</td>
    </tr>

      <tr>
    <td>Website</td>
    <td>    <input type="text" id="company_website" name="company_website" value="<?php echo $formdata['company_website'];?>" placeholder="Enter Website" class="form-control" />
</td>
</tr>
      
     <tr>
    <td>Country</td>
    <td><?php echo form_dropdown('country_id', $country_list , $formdata['country_id'],'class="form-control"  id="country_id" ');?>
</td>
    </tr>
    
      <tr>
    <td>State</td>
    <td><?php echo form_dropdown('state_id', $state_list , $formdata['state_id'],'class="form-control"  id="state_id" ');?>
</td>
    </tr>
      <tr>
    <td>City</td>
    <td><?php echo form_dropdown('city_id', $city_list , $formdata['city_id'],'class="form-control"  id="city_id" ');?>
</td>
    </tr>
    
        </tr>
      <tr>
    <td>Address</td>
    <td> 
    <textarea id="company_address" name="company_address" rows="8" placeholder=" Enter Company Address" class="form-control" ><?php echo $formdata['company_address'];?></textarea>
    <?php // echo $this->ckeditor->editor('company_address',$formdata['company_address']);?></td>
    </tr>
    
     </tr>
      <tr>
    <td>Company Email</td>
    <td><input type="text" id="company_email" name="company_email" value="<?php echo $formdata['company_email'];?>" placeholder=" Enter Company Email" class="form-control" />	</textarea>
</td>
    </tr>


<tr>
    <td>Specialties</td>
    <td>  <input type="text" id="specialties" name="specialties" value="<?php echo $formdata['specialties'];?>" placeholder="Enter Specialties" class="form-control" />	
</td>
    </tr>
    
<tr>
    <td>Company Size</td>
    <td>  <input type="text" id="company_size" name="company_size" value="<?php echo $formdata['company_size'];?>" placeholder="Enter Company Size" class="form-control" />	
</td>
    </tr>
    

<tr>
    <td>Founded</td>
    <td>  <input type="text" id="founded" name="founded" value="<?php echo $formdata['founded'];?>" placeholder="Enter Founded" class="form-control" />	
</td>
    </tr>

      <tr>
    <td>Google+</td>
    <td>     <input type="text" id="googleplus" name="googleplus" value="<?php echo $formdata['googleplus'];?>" placeholder=" Enter Google+" class="form-control" />	
</td>
  
   
    <tr>
    <td>Twitter+</td>
    <td>      <input type="text" id="twitter" name="twitter" value="<?php echo $formdata['twitter'];?>" placeholder="Enter Twitter" class="form-control" />	
</td>
    
     <tr>
    <td>Facebook</td>
    <td><input type="text" id="facebook" name="facebook" value="<?php echo $formdata['facebook'];?>" placeholder="Enter Facebook" class="form-control" />
</td>
    
     <tr>
    <td>Linkedin</td>
    <td>  <input type="text" id="linkedin" name="linkedin" value="<?php echo $formdata['linkedin'];?>" placeholder="Enter Linkedin" class="form-control" />	
</td>
    
      <tr>
    <td>Company Profile</td>
    <td><?php echo $this->ckeditor->editor('company_profile',$formdata['company_profile']);?></td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>/company_calls" class="attach-subs subs">Cancel</a>
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
	if($('#company_name').val()=='')
	{
		alert('Please enter company name');
		$('#company_name').focus();
		return false;
	}
/*	
	if($('#type_id').val()=='0')
	{
		alert('Please select company type');
		$('#type_id').focus();
		return false;
	}	
	if($('#company_email').val()!=''){
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test($('#company_email').val())){
			alert('Enter valid email');
			$('#company_email').focus();
			return false;
		}
	}
	if($('#company_email').val()!=''){
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
		if(isNaN($('#company_phone').val())){
			alert('Enter valid number');
			$('#company_phone').focus();
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
		
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/company_calls/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/company_calls/getcity/',
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

