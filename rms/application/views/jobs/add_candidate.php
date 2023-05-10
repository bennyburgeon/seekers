
<div class="col-md-12">

<div class="profile_top">
<div class="profile_top_left">
<a href="<?php echo base_url();?>index.php/jobs/manage/<?php echo $formdata['job_id'];?>">Summary</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp; 
<a href="<?php echo base_url();?>index.php/jobs/search_candidate/<?php echo $formdata['job_id'];?>">Search Candidates</a> &nbsp;&nbsp;&nbsp;	
<!-- 
||
&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url();?>index.php/jobs/send_mass_mail/<?php echo $formdata['job_id'];?>">Mass Email</a>	&nbsp;&nbsp;&nbsp; 
-->
||&nbsp;&nbsp;&nbsp;
Add New Candidate</div>  

<div style="clear:both;"></div>
</div>

<table width="100%" border="0">
  <tbody>
    <tr>
      <td align="left" valign="top"><div class="profile_box">

<h2>Add Candidate</h2><br>

<form name="quick_form" action="<?php echo base_url().'index.php/jobs/add_candidate/';?><?php echo $formdata['job_id'];?>" method="post" onSubmit="return validate();" enctype="multipart/form-data">

<input type="hidden" name="job_id" value="<?php echo $formdata['job_id'];?>">

<table width="90%" border="1" bordercolor="#f4f4f4" align="center">
  <tbody>
    <tr>
      <td colspan="2">All detials like Industry, Skills etc will be taken from the JD automatically.</td>
    </tr>
   
    <tr>
      <td width="10%" align="left" valign="middle">Title</td>
      <td width="90%" align="left" valign="middle">
      <input type="radio" value="1" id="p_title" name="title" checked="">Mr.
      <input type="radio" value="2" id="p_title" name="title">Ms.<br>
	  <input type="radio" value="3" id="p_title" name="title">Mrs.
      
      </td>
    </tr>
       
    <tr>
      <td width="37%" align="left" valign="middle">Full Name<span style="color:#F40004;">*</span></td>
      <td width="63%" align="left" valign="middle"><input type="text" name="first_name" placeholder="Full Name" id="first_name" value="" width="200px;" /></td>
    </tr>

    <tr>
      <td align="left" valign="middle">Email/Username<span style="color:#F40004;">*</span></td>
      <td align="left" valign="middle"><input type="text" name="username" placeholder="Email" id="username" value="" width="200px;" /></td>
    </tr>

    <tr>
      <td align="left" valign="middle">Password</td>
      <td align="left" valign="middle"><input type="password" name="password" placeholder="Password" id="password" value="" width="200px;" /></td>
    </tr>

    <tr>
      <td align="left" valign="middle">Confirm Password</td>
      <td align="left" valign="middle"><input type="password" name="c_password" placeholder="Confirm Password" id="c_password" value="" width="200px;" /></td>
    </tr>
    
    <tr>
          <td align="left" valign="middle">Mobile<span style="color:#F40004;">*</span></td>
          <td align="left" valign="middle"><table width="90%" border="0">
            <tbody>
              <tr>
                <td>Prefix</td>
                <td><input type="text" name="mobile_prefix"  placeholder="Prefix" id="mobile_prefix" maxlength="4" value="+971" width="200px;" /></td>
                <td>Mobile</td>
                <td><input type="text" name="mobile" placeholder="Mobile" id="mobile" maxlength="10" value="" width="200px;" /></td>
                </tr>
              </tbody>
            </table></td>
        </tr>

    <tr>
          <td align="left" valign="middle">Secondary Mobile</td>
          <td align="left" valign="middle"><table width="90%" border="0">
            <tbody>
              <tr>
                <td>Prefix</td>
                <td><input type="text" name="mobile_prefix1"  placeholder="Prefix" id="mobile_prefix1" maxlength="4" value="+971" width="200px;" /></td>
                <td>Mobile</td>
                <td><input type="text" name="mobile1" placeholder="Mobile" id="mobile1" maxlength="10" value="" width="200px;" /></td>
                </tr>
              </tbody>
            </table></td>
        </tr>
            

    <tr>
      <td align="left" valign="middle">Alternate Email</td>
      <td align="left" valign="middle"><input type="text" name="alternate_email" placeholder="Email" id="alternate_email" value="" /></td>
    </tr>
        
        
    <tr>
      <td align="left" valign="middle">Linkedin Profile</td>
      <td align="left" valign="middle"><input type="text" name="linkedin_url" placeholder="Linkedin" id="linkedin_url" value="" width="200px;" class="form-control edu-field" /></td>
    </tr>
    <strong>
    </strong>    
    <tr>
      <td align="left" valign="middle">Highest Edu. Level</td>
      <td align="left" valign="middle"><select name="level_id" class="form-control edu-field" id="level_id">
        <option value="" selected="selected">Select Education Level</option>
        <option value="16">Certificate Course</option>
        <option value="14">Diploma</option>
        <option value="11">Graduate</option>
        <option value="12">HSC</option>
        <option value="10">Post Graduate</option>
        <option value="15">Research</option>
        <option value="13">SSLC</option>
        </select></td>
    </tr>
    <tr>
      <td align="left" valign="middle">Highest Edu.</td>
      <td align="left" valign="middle"><input type="text" name="course_name" placeholder="Education" id="course_name" value="" width="200px;" /></td>
    </tr>
<tr>
      <td align="left" valign="middle">Nationality</td>
      <td align="left" valign="middle"><?php echo form_dropdown('nationality',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="nationality"');?></td>
    </tr>

<tr>
      <td align="left" valign="middle">Country<span style="color:#F40004;">*</span></td>
      <td align="left" valign="middle"><?php echo form_dropdown('country_id',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="country_id"');?></td>
    </tr>

<tr>
      <td align="left" valign="middle">State<span style="color:#F40004;">*</span></td>
      <td align="left" valign="middle"><?php echo form_dropdown('state_id',  $state_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="state_id"');?></td>
    </tr>        
    <tr>
      <td align="left" valign="middle">City</td>
      <td align="left" valign="middle"><?php echo form_dropdown('city_id',  $city_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="city_id"');?></td>
    </tr>
    <tr>
      <td align="left" valign="middle">Present Company</td>
      <td align="left" valign="middle"><input type="text" name="organization" placeholder="Company" id="organization" value="" width="200px;" /></td>
    </tr>
    
    <tr>
      <td align="left" valign="middle">Designation</td>
      <td align="left" valign="middle"><input type="text" name="designation" placeholder="Designation" id="designation" value="" width="200px;" /></td>
    </tr>

    <tr>
      <td align="left" valign="middle">Total Experience</td>
      <td align="left" valign="middle"><input type="text" name="total_experience" placeholder="Total Exp." id="total_experience" value="" width="200px;" /></td>
    </tr>
    
    <tr>
      <td align="left" valign="middle">Industry</td>
      <td align="left" valign="middle"> <?php echo form_dropdown('job_cat_id',  $industry_list, '',' id="job_cat_id" data-placeholder="Filter by status" class="form-control input-sm"');?>  </td>
    </tr>

    <tr>
      <td align="left" valign="middle">Functional Area</td>
      <td align="left" valign="middle"> <?php echo form_dropdown('func_id',  $func_list, '',' id="func_id" data-placeholder="Filter by status" class="form-control input-sm"');?>  </td>
    </tr>    

    <tr>
      <td align="left" valign="middle">Designation</td>
      <td align="left" valign="middle"><?php echo form_dropdown('desig_id',  $desig_list, '',' id="desig_id" data-placeholder="Filter by status" class="form-control input-sm"');?>  </td>
    </tr>
        
    <tr>
      <td align="left" valign="middle">Date Period</td>
      <td align="left" valign="middle"><table width="90%" border="0">
        <tbody>
          <tr>
            <td>Fr</td>
            <td><input type="text" name="start_date" placeholder="yyyy-mm-dd" class="datepicker"  value="" width="100px;" readonly /></td>
            <td>To</td>
            <td><input type="text" name="end_date" placeholder="yyyy-mm-dd" class="datepicker"  value="" width="100px;" readonly /></td>
            </tr>
          </tbody>
        </table></td>
    </tr>

                <tr>
                   <td>Present Job Status</td>
                   <td valign="middle" align="left"><?php echo form_dropdown('cur_job_status',  $cur_job_status_list, '',' id="cur_job_status" data-placeholder="Filter by status" class="form-control input-sm"');?> </td>
                 </tr>
                 
                     
    <tr>
      <td colspan="2" align="left" valign="middle"></td>
    </tr>
        
    <tr>
      <td align="left" valign="middle">CTC &amp; Exp.</td>
      <td align="left" valign="middle"><table width="90%" border="0">
        <tbody>
          <tr>
            <td>Cur.</td>
            <td><input type="text" name="cur_ctc" placeholder="Cur. CTC" id="cur_ctc" value="" width="100px;" /></td>
            <td>Exp CTC.</td>
            <td><input type="text" name="exp_ctc" placeholder="Expected CTC" id="exp_ctc" value="" width="100px;" /></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td colspan="2" align="left" valign="middle"></td>
    </tr>
    <tr>
      <td align="left" valign="middle">Notice Period &amp; Exp.</td>
      <td align="left" valign="middle"><table width="90%" border="0">
        <tbody>
          <tr>
            <td>Notice</td>
            <td><input type="text" name="notice_period" placeholder="Days" id="notice_period" value="" width="100px;" /></td>
            <td>Experience</td>
            <td><input type="text" name="exp_years" placeholder="Years" id="exp_years" value="" width="50px;" /></td>
            </tr>
          </tbody>
        </table></td>
    </tr>


    <tr>
      <td colspan="2" align="left" valign="middle"><?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?>
      <br> Please upload DOC, DOCX, PDF etc. Other formats will not be accepted. 
      </td>
    </tr>

    <tr>
      <td colspan="2" align="left" valign="middle"><input type="submit" name="save_candidate" value="Add Profile"> </td>
    </tr>
</tbody>
</table>

</form>
<script language="javascript">
function validate()
{
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	if($('#first_name').val()=='')
	{
		alert('Please Enter Full Name');
		$('#first_name').focus();
		return false;
	}

		
	if($('#username').val()=='')
	{
		alert('Please Enter Username or Email');
		$('#username').focus();
		return false;
	}


	
	if(!pattern.test($('#username').val())){
		alert('Please Enter valid email');
		$('#username').focus();
		return false;
	}

	if($('#mobile').val()=='')
	{
		alert('Please Enter Mobile');
		$('#mobile').focus();
		return false;
	}
	
	if($('#country_id').val()=='')
	{
		alert('Select Country');
		$('#country_id').focus();
		return false;
	}  

	if($('#state_id').val()=='')
	{
		alert('Select State');
		$('#state_id').focus();
		return false;
	}  
		
			
	return true;
}

$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});


</script>

</div></td>
      <td  align="left" valign="top"><div class="profile_box">

<h2>Add From Other Applications</h2><br>

<form name="quick_form" action="<?php echo base_url().'index.php/jobs/import_from_other_jobs/';?><?php echo $formdata['job_id'];?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="cur_job_id" value="<?php echo $formdata['job_id'];?>">

<table width="95%" border="1" bordercolor="#f4f4f4" align="center" cellpadding="3" cellspacing="3">
  <tbody>
    <tr>
      <td colspan="4">Bring all candidates from other job applications</td>
    </tr>
				 <?php 
				   
				   foreach($job_change_list as $key => $val)
				   {
					   if($val['total_jobs']>0){
					?>
				<tr>
                   <td width="8%" align="center"> <input type="checkbox" name="job_id[]" value="<?php echo $val['job_id'];?>"></td>
                   <td width="46%" align="left"><?php echo $val['job_title'];?><br><?php echo $val['company_name'];?></td>
                   <td width="23%" align="left">Total Apps: <?php echo $val['total_jobs']?></td>
                   <td width="23%" align="left">Total Rejected: <?php echo $val['total_rejected']?></td>
                 </tr>
                 <?php    
					}
				   }
				   
				   ?>
    <tr>
      <td colspan="4"><input type="radio" name="candidate_source" value="1" checked> 
        Take 
        All Applicants &nbsp;&nbsp;&nbsp;<input type="radio" name="candidate_source" value="2">&nbsp;&nbsp;&nbsp;Take Short Listed&nbsp;&nbsp;&nbsp;<input type="radio" name="candidate_source" value="3">&nbsp;&nbsp;&nbsp;Take Rejected&nbsp;&nbsp;&nbsp;<input type="radio" name="candidate_source" value="4">&nbsp;&nbsp;&nbsp;Take from Interview List</td>
      </tr>
    <tr>
      <td colspan="4"><input type="submit" name="import_candidate" value="Add from these Jobs"> </td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
  </tbody>
</table>

</form>

</div></td>
    </tr>
  </tbody>
</table>








  
</section>

<script language="javascript">

$(document).ready(function()
{
	$('#job_cat_id').change(function() {
			jQuery('#func_id').html('');
			jQuery('#func_id').append('<option value="">Select Function</option');
			
	//		jQuery('#desig_id').html('');
	//		jQuery('#desig_id').append('<option value="">Select Designation</option');		
	
	//		jQuery('#skill_id').html('');
	//		jQuery('#skill_id').append('<option value="">Select Skills</option');		
				
			//if($('#job_cat_id').val()=='')return;
			
				$.ajax({
				  type: 'POST',
				  url: '<?php echo $this->config->site_url();?>/jobs/getfunction/',
				  data: { job_cat_id: $('#job_cat_id').val()},
				  dataType: 'json',
				  
				  beforeSend:function(){
						jQuery('#func_id').html('');
						jQuery('#func_id').append('<option value="">Loading...</option');
	//					jQuery('#desig_id').html('');
	//					jQuery('#desig_id').append('<option value="">Select Designation</option');		
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
					 
					  }else
					  {
						alert(data.success);
					  }
					},
				  
				  error:function(){
						alert('Problem with server. Please try again');
						jQuery('#func_id').html('');
						jQuery('#func_id').append('<option value="">Select Function</option');
	
	//					jQuery('#desig_id').html('');
	//					jQuery('#desig_id').append('<option value="">Select Designation</option');		
				  }
				});	
		});
	$('#func_id').change(function() {
			
		jQuery('#desig_id').html('');
		jQuery('#desig_id').append('<option value="">Select Designation</option');
		
	//	jQuery('#skill_id').html('');
	//	jQuery('#skill_id').append('<option value="">Select Skills</option');
		
				
		//if($('#func_id').val()=='')return;
		
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/jobs/get_designation_by_function/',
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
	$('#country_id').change(function() {
		
	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
			
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/jobs/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/jobs/getcity/',
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

});
</script>