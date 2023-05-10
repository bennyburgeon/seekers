<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
    <div id ="step2">
        <div class="table-tech specs hor">
        
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form1" name="candidate_form1" > 
                <table class="hori-form">
                    <tbody>
                        <tr>
                            <td>Nationality</td>
                            <td> 
                            <?php  echo form_dropdown('nationality',  $country_list, $formdata['nationality'],'class="form-control" id="country_id"');?> 
                            <?php //echo form_dropdown('nationality',  $country_list, $formdata['nationality'],'class="form-control" id="state_id"');?> 
                            </td>	
                        </tr>
                        
                        <tr>
                            <td>State</td>
                            <td>
                            <!--<input class="form-control hori " type="text" name="state" id="state_id" value="<?php echo $formdata['state'];?>" placeholder="Enter your State">-->
                            <?php echo form_dropdown('state',  $state_list, $formdata['state'],'class="form-control" id="state_id"');?>                            
                            </td>
                        </tr>
                        
                        <tr>
                            <td>City</td>
                            <td>
                            <!--<input class="form-control hori " type="text" name="city_id" value="<?php echo $formdata['city_id'];?>" placeholder="Enter your City ">-->
                            <?php echo form_dropdown('city_id',  $city_list, $formdata['city_id'],'class="form-control" id="city_id"');?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Current location</td>
                            <td> <?php echo form_dropdown('current_location',  $location_list, $formdata['current_location'],'class="form-control" id="location_id"');?> 
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Contact Address</td>
                            <td><input class="form-control hori" type="text" name="address" value="<?php echo $formdata['address'];?>" id="address"></td>
                        </tr>
                       
                        <tr>
                            <td>Land Phone</td>
                            <td>
                            <input type="hidden" name="land_prefix" value="" id="land_prefix">
                            <input class="form-control hori " type="text" name="land_phone" value="<?php echo $formdata['land_phone'];?>" id="land_phone">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Work Phone</td>
                            <td>
                            <input type="hidden" name="work_prefix" value="" id="work_prefix">
                            <input class="form-control hori " type="text" name="workphone" value="<?php echo $formdata['workphone'];?>" id="workphone">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Fax</td>
                            <td>
                            <input type="hidden" name="fax_prefix" value="" id="fax_prefix">
                            <input class="form-control hori " type="text" name="fax" value="<?php echo $formdata['fax'];?>" id="fax">
                            </td>
                        </tr>
                       
                        <tr>
                            <td>Zip code</td>
                            <td><input class="form-control hori fo-icon-1" type="text" name="zipcode" value="<?php echo $formdata['zipcode'];?>" id="zipcode"></td>
                        </tr>
                        
                        <input type="hidden" name="religion_id" value="" />
                        <!-- 
                        <tr>
                            <td>Religion</td>
                            <td> <?php //echo form_dropdown('religion_id',  $religion_list, $formdata['religion_id'],'class="form-control" id="religion_id"');?> </td>
                        </tr>
                        -->
                        
                        <tr>
                            <td colspan="2">
                            <span class="click-icons">
                            <input type="button" class="attach-subs" value="Save & Continue" id="save_candidate1" style="width:180px;">
                            <input type="button" class="attach-subs subs" value="Skip" id="skip">
                            <a href="<?php echo $this->config->site_url();?>/candidates_all" class="attach-subs subs">Done</a>
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
   function candidate_validate1() {
		
	    return true;
    }
   $('#save_candidate1').click(function(){

		var dataStringprop = $("#candidate_form1").serialize();
		var isContactValid = candidate_validate1();
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates_all/addCandidateDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							var img_path = '<?php echo base_url();?>assets/images/loader.gif';
							$("#step1").html('<img src="'+img_path+'" alt="Uploading...."/>');
                            var site_url = "<?php echo site_url('candidates_all/loadPassporthtml'); ?>" +'/'+ candidateId;
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


<script type="text/javascript">
$('#country_id').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');
		
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getcity/',
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

$('#city_id').change(function() {

	jQuery('#location_id').html('');
	jQuery('#location_id').append('<option value="">Select Location</option');
		
	if($('#state_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getlocation/',
		  data: { city_id: $('#city_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#location_id').html('');
				jQuery('#location_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){              
			  if(data.success==true)
			  {
                              jQuery('#location_id').html('');                              				  
				  $.each(data.location_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#location_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#location_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#location_id').html('');
				jQuery('#location_id').append('<option value="">Select Location</option');
		  }
		});	
});

$('#skip').click(function(){
var candidateId = '<?php echo $candidate_id ?>';
var dataStringprop = $("#candidate_form1").serialize();
	$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates_all/skip_step2'); ?>"+'/'+candidateId,
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
                            var site_url = "<?php echo site_url('candidates_all/loadPassporthtml'); ?>" +'/'+ id;
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