<footer class="login_footer"><?php echo $this->config->item('copy_right');?></footer>
<!--scripts-->
<script src="<?php //echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>

<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/animate_jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/maps.googleapis.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/map.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.canvasjs.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
<!--scripts-->

<script type="text/javascript">
	$('#job_cat_id').change(function() {
		
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');
			
	//if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/get_functional_by_industry/',
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
		  }
		});	
});

	$('#func_id').change(function() {
		
	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');
			
	//if($('#func_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/get_designation_by_function/',
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
			
	//if($('#desig_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/get_skills_by_designation/',
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

</body>
</html>
