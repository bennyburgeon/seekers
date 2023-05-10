<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages"><a href="<?php echo $this->config->site_url();?>city">City</a> / <?php echo $page_head;?> </span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>edit city form</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="sidebar-area inner-pages">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box sides">
<ul>
<li class="active"><a href="#">Overview</a></li>
<li><a href="#">Account Settings</a></li>
</ul>
</div>
</div>
</div>
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
        <tbody>
        <form action="<?php echo $this->config->site_url();?>city/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
        <?php echo form_hidden('city_id', $formdata['city_id']);?>
        
            <tr>
                <td>Country Name</td>
                <td>
                    <select class="form-control hori" id="country_id" name="country_id">                                   
                    <?php foreach($country_list as $key=>$country){ ?>
                    <option value="<?php echo $key;?>" <?php echo ($key == $formdata['country_id'] ? 'selected="selected"' : ''); ?>><?php echo $country;?></option>
                    <?php } ?>
                    </select>
                </td>
            </tr>
            
            <tr>
                <td>State Name</td>
                <td>
                <select class="form-control hori" id="state_id" name="state_id">                                   
                <?php foreach($state_list as $key=>$state){ ?>
                <option value="<?php echo $key;?>" <?php echo ($key == $formdata['state_id'] ? 'selected="selected"' : ''); ?>><?php echo $state;?></option>
                <?php } ?>
                </select>
                </td>
            </tr>
            
            <tr>
                <td>City Name</td>
                <td>
                <input type="text" id="city_name" name="city_name" value="<?php echo $formdata['city_name'];?>" placeholder="" class="form-control hori" />
                </td>
            </tr>
            
            <tr>
                <td>Status</td>
                <td>
                <label><input type="radio" name="status" id="uniform-undefined" value="1" <?php if($formdata['status']==1)echo 'checked="checked"';?> 
                class="hor-check"> Active</label>
                <label><input type="radio" name="status" id="uniform-undefined" value="0" <?php if($formdata['status']==0)echo 'checked="checked"';?> 
                class="hor-check"> Inactive </label>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <span class="click-icons">
                <input type="submit" class="attach-subs" value="Submit">
                <a href="<?php echo $this->config->site_url();?>city" class="attach-subs subs">Cancel</a>
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
	if($('#country_id').val()=='')
	{
		alert('Please enter country name');
		$('#country_id').focus();
		return false;
	}

	if($('#state_id').val()=='0')
	{
		alert('Please enter state name');
		$('#state_id').focus();
		return false;
	}
	
	if($('#city_name').val()=='')
	{
		alert('Please enter city name');
		$('#city_name').focus();
		return false;
	}
	return true;
}

$('#country_id').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');
		
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>city/getstate/',
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
				
</script>
	