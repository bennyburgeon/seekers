<div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-heading"><i class="fa fa-filter" aria-hidden="true"></i><strong> Search Filter</strong></div>
              <br />
              <div class="form-group col-xs-12">
   <button type="button" onClick="window.location='<?php echo site_url('home/'); ?>';" class="btn btn-primary pull-right btn-sm"><strong>Clear Filters</strong></button><br>
<br>


  <label for="sel1">Country</label>
                           <?php echo form_dropdown('country_id',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="country_id"');?>
                           
                           <label for="sel1">State</label>
                           <?php echo form_dropdown('state_id',  $state_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="state_id"');?>
                           
                          <label for="sel1">City:</label>
                          <?php echo form_dropdown('city_id',  $city_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="city_id"');?>
                          
                
                <label for="sel1">Industry</label>
                
       			<?php echo form_dropdown('job_cat_id',  $industry_list, $job_cat_id,' class="form-control input-sm" id="job_cat_id"');?>
               <br />
                <label for="location">Functional Area</label>
              <?php echo form_dropdown('func_id',  $func_list, $func_id,' class="form-control input-sm" id="func_id"');?>               
                <br />
                <label for="location">Designation</label>
              <?php echo form_dropdown('desig_id',  $desig_list, $desig_id,' class="form-control input-sm" id="desig_id"');?>               
                <br />

                <label for="location">Skill</label>
              <?php echo form_dropdown('skill_id',  $skill_list, $skill_id,' class="form-control input-sm" id="skill_id"');?>               
                <br />

                <label for="location">Education Level</label>

 				<?php echo form_dropdown('level_id',  $edu_level_list, $level_id,' class="form-control input-sm"');?>
                
				<br />
                <label for="location">Experience</label>
 				<?php echo form_dropdown('total_exp_needed',  $experience, $total_exp_needed,' class="form-control input-sm"');?>

                <br />
                <label for="location">Salary [<?php echo $this->config->item('currency_symbol');?> ]</label>
                <?php echo form_dropdown('salary_id',  $salary_list, $salary_id,' class="form-control input-sm"');?>                
                
                <br />
                <label for="location">Job Type</label>
                
                <div class="radio">                 
                  <label><input type="radio" name="job_type_id" value="1" <?php if($job_type_id==1)echo 'checked';?>>Full Time</label>
                </div>
               
                <div class="radio">
                  <label><input type="radio" name="job_type_id" value="2" <?php if($job_type_id==2)echo 'checked';?>>Part Time</label>
                </div>
                
                <div class="radio">
                  <label><input type="radio" name="job_type_id"  value="3" <?php if($job_type_id==3)echo 'checked';?>>Hourly Basis</label>
                </div>
           		 
                 <div class="radio">
                  <label><input type="radio" name="job_type_id"  value="4" <?php if($job_type_id==4)echo 'checked';?>>Contract Job</label>
                </div>

            	<div class="radio">
                  <label><input type="radio" name="job_type_id"  value="5" <?php if($job_type_id==5)echo 'checked';?>>Weekly Basis</label>
                </div>   
            	<div class="radio">
                  <label><input type="radio" name="job_type_id"  value="6" <?php if($job_type_id==6)echo 'checked';?>>Monthly Basis</label>
                </div>  
                
                                                                           
                <br />
                  <div class="form-group">
                  <label for="usr">Skills</label>
                  <input type="text" name="skill_id" class="form-control" value="<?php echo $skill_id; ?>" placeholder="PHP, HTML, JAVA etc." id="skill_id">
                </div>
              
                               
              </div>
              <div class="panel-body"><button type="submit" onClick="" class="btn btn-primary pull-right btn-sm"><strong>Filter</strong></button></div>
            </div>

          </div>

<script type="text/javascript">
$('#country_id').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
			
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/home/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/home/getcity/',
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
<script type="text/javascript">
	$('#job_cat_id').change(function() {
		
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');

	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');	
			
	//if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/home/get_functional_by_industry/',
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
		  url: '<?php echo $this->config->site_url();?>/home/get_designation_by_function/',
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


$('#desig_id').change(function() {
		
	jQuery('#skill_id').html('');
	jQuery('#skill_id').append('<option value="">Select Skills</option');
			
	if($('#desig_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/home/get_skills_by_designation/',
		  data: { desig_id: $('#desig_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#skill_id').html('');
				jQuery('#skill_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#skill_id').html('');
				  $.each(data.skill_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#skill_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#skill_id').append('<option value="'+ index +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#skill_id').html('');
				jQuery('#skill_id').append('<option value="">Select Skills</option');
		  }
		});	
});

</script>          