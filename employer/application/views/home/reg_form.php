<div id="wrapper">


<!-- Header
================================================== -->
<header class="transparent sticky-header">
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="<?php echo $this->config->base_url();?>"><img src="<?php echo base_url('images/logo2.png');?>" alt="$this->config->item('company_name') Personnel Consultancy" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">
								<li><a href="<?php echo $this->config->site_url()?>" id="current">Home</a></li>
                <li><a href="<?php echo $this->config->base_url();?>index.php/about" id="current">About Us</a></li>
                <li><a href="<?php echo $this->config->base_url();?>index.php/industry" id="current">Industries</a></li>
			</ul>
			<ul class="float-right">
				<li><a href="tel:<?php echo  $this->config->item('company_mobile');?>"><i class="fa fa-mobile"></i> <?php echo  $this->config->item('company_mobile');?></a></li>
				<li><a href="#footer"><i class="fa fa-paper-plane"></i> Contact</a></li>
			</ul>
		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-list-ul" aria-hidden="true"></i>
 Menu</a>
		</div>

	</div>
</div>

</header>


<div class="clearfix"></div>

<!-- Banner
================================================== -->
<div id="banner">
	<div class="container">
		<div class="sixteen columns">
			
			<div class="search-container">
				<!-- Announce -->
			

			</div>

		</div>
	</div>
</div>




<div class="container">
	
	<!-- Recent Jobs -->
	<div class=" sixteen columns">
		<h3 class="margin-bottom-25">Register With Us</h3>
<div id="small-dialog" class="zoom-anim-dialog mfp-show apply-popup">


					<div class="small-dialog-content">
						 <form id="register_form" action="<?php echo site_url('home/save_registration'); ?>"  class="formular" name="register_form" method="post" enctype="multipart/form-data">
       		<input type="hidden" name="candidate_id" id="candidate_id" value="">
            <input type="hidden" name="job_id"  id="job_id" value="">      
            <input type="hidden" name="lead_source"  id="lead_source" value="2">    
            
            <input type="text" name="first_name" value="" id="first_name" placeholder="Full Name">            
            <input type="text" name="username" value="" id="username" placeholder="Your Email" >            
			
            
              <div class="two-line">
             <div class="eight columns float-left"><input  type="text"  name="country_code" placeholder="Country Code" value="" id="country_code"></div>&nbsp;&nbsp;
             <div class="eight columns float-left"><input  type="text"  name="mobile" placeholder="Mobile Phone" value="" id="mobile"></div>
             
             </div>
             
             
            <input  type="text"  name="password" placeholder="Create  a Password" value="" id="password">
            
           <div class="margin-bottom-15">           
               <span style="display:inline-block;" >Gender</span>
               <label class="radio-inline">
               <input type="radio" name="gender_male" id="gender_male" value="1" checked="checked">Male</label>
               <label class="radio-inline">
               <input type="radio" name="gender_male" id="gender_female" value="0">Female</label>           
           </div>
           
             <div class="two-line">
             <div class="eight columns float-left"> <?php echo form_dropdown('nationality',  $nationality_list, '','data-placeholder="Filter by status" class="chosen-select-no-single" style="display: none;"');?></div>&nbsp;&nbsp;
             <div class="eight columns float-left"> <?php echo form_dropdown('present_nationality',  $current_nationality_list, '','data-placeholder="Filter by status" class="chosen-select-no-single" style="display: none;"');?></div>
             
             </div>
             
                                   
           <div class="margin-bottom-15">           
               <span style="display:inline-block;" >Present Job Status</span><br>
               <label class="radio-inline"><input type="radio" name="cur_job_status" value="1" checked="checked">No Job</label><br>
               <label class="radio-inline"><input type="radio" name="gender_male" value="2">Working, But Need a Change</label><br>
               <label class="radio-inline"><input type="radio" name="gender_male" value="4">Seeking Good Opportunity</label><br>
               <label class="radio-inline"><input type="radio" name="gender_male" value="6">Call after this month</label><br>
           </div>

             <div class="two-line">
             
             <div class="eight columns float-left"> <?php echo form_dropdown('level_id',  $edu_level_list, '','data-placeholder="Filter by status" class="chosen-select-no-single" style="display: none;"');?></div>&nbsp;&nbsp;
             <div class="eight columns float-left"><input type="text" name="course_name" value="" id="course_name" placeholder="Enter Course Name"></div>
             
             </div>
     
	
                 <div class="two-line">
             <div class="eight columns float-left"> <input type="text" name="company" value="" id="company" placeholder="Company"></div>&nbsp;&nbsp;
             <div class="eight columns float-left"><input type="text" name="designation" value="" id="designation" placeholder="Designation"></div>
             
             </div>
                 
                        
            <div class="two-line">
             <div class="eight columns float-left">
             <input class="form-control date-margin" type="text" readonly name="start_date" id="datepickfrom" value="" placeholder="From Date">
             </div>&nbsp;&nbsp;
              <div class="eight columns float-left">
              <input class="form-control date-margin" type="text" readonly name="end_date" id="datepickto" value="" placeholder="Till Date">
             </div>
             </div>
                            
                             
                             
		<!-- Select -->
        <div class="margin-bottom-15 margin-top-15">
		
         </div>
        

         
                            <div class="margin-bottom-15">
                            <span style="display:inline-block;" >Is this your present job?</span>
                            <label class="radio-inline">
            <input type="radio" name="present_job" id="present_job" value="1" checked="">Yes</label>
                            <label class="radio-inline">
            <input type="radio" name="present_job" id="present_job" value="0" checked="">No</label>
           
                            </div>

            <div class="two-line">
             <div class="eight columns float-left">
             <?php echo form_dropdown('industry_id',  $industry_list, '','data-placeholder="Filter by status" 	class="chosen-select-no-single" style="display: none;"');?>
             </div>&nbsp;&nbsp;
              <div class="eight columns float-left">
                <?php echo form_dropdown('func_id',  $functional_list, '','data-placeholder="Filter by status" 	class="chosen-select-no-single" style="display: none;"');?>
             </div>
             </div>

	         <div class="two-line">
             <div class="eight columns float-left"> <input  type="text" name="cur_ctc" id="cur_ctc" placeholder="Current CTC" value=""/></div>&nbsp;&nbsp;
             <div class="eight columns float-left"> <input type="text" name="exp_ctc" id="exp_ctc" placeholder="Expected CTC" value=""/></div>
             
             </div>

	         <div class="two-line">
             <div class="eight columns float-left"> <input  type="text" name="visa_status" id="visa_status" placeholder="VISA Status" value=""/></div>&nbsp;&nbsp;
             <div class="eight columns float-left"> <input type="text" name="release_noc" id="release_noc" placeholder="Release/NOC" value=""/></div>
             
             </div>

			<input type="text" name="app_notes" value="" id="app_notes" placeholder="Reason for Leaving">  
            <input type="text" name="skills" value="" id="skills" placeholder="Skills [Use ',' to separate]">  
                     
             <div class="two-line">
             <div class="eight columns float-left">
             <select data-placeholder="Filter by status" class="chosen-select-no-single"v name="notice_period" id="notice_period" style="display: none;">
			<option value="">Notice Period</option>
			<?php for($i=1;$i<=200;$i++){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                      <?php
                }?>
		</select>
             </div>&nbsp;&nbsp;
             <div class="eight columns float-left">
             	<select data-placeholder="Filter by status" name="exp_years" id="exp_years" class="chosen-select-no-single" style="display: none;">
			<option value="">Total Experience</option>
			 <?php for($i=1;$i<=30;$i += 0.5){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                      <?php
                }?>
		</select>
             </div>&nbsp;&nbsp;
             <div class="eight columns float-left">
             	<select data-placeholder="Filter by status" name="exp_years" id="exp_years" class="chosen-select-no-single" style="display: none;">
			<option value="">GCC Experience</option>
			 <?php for($i=1;$i<=30;$i += 0.5){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                      <?php
                }?>
		</select>
             </div>
             </div>
                            <!-- Select -->
        <div class="margin-bottom-15 margin-top-15">
		
         </div>
         <!-- Select -->
        <div class="margin-bottom-15 margin-top-15">
	
         </div>
							<!-- Upload CV -->
							<div class="upload-info"><strong>Upload your CV (optional)</strong> <span>Max. file size: 5MB</span></div>
							<div class="clearfix"></div>

							<label class="upload-btn">
							    
                                <?php echo form_upload(array('name'=>'cv_file','class'=>''));?>
							    <i class="fa fa-upload"></i> Browse
							</label>
					

							<div class="divider"></div>
							<!-- Upload Photo -->
							<div class="upload-info"><strong>Upload your Photo (optional)</strong> <span>Max. file size: 5MB</span></div>
							<div class="clearfix"></div>

							<label class="upload-btn">
							    
                                <?php echo form_upload(array('name'=>'cv_file','class'=>''));?>
							    <i class="fa fa-upload"></i> Browse
							</label>
					

							<div class="divider"></div>

  <button type="submit" class="send" id="save_registration" data-url="<?php echo site_url('home/save_registration'); ?>">Send Application</button>
						</form>
					</div>
					
				</div>
				<div class="clearfix"></div>
	
	</div>
	</div>


<div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
					<div class="small-dialog-headline">
						<h2>Apply For This Job</h2>
					</div>

					<div class="small-dialog-content">
						 <form id="register_form" action="<?php echo site_url('home/save_registration'); ?>"  class="formular" name="register_form" method="post" enctype="multipart/form-data">
       		<input type="hidden" name="candidate_id" id="candidate_id" value="">
            <input type="hidden" name="job_id"  id="job_id" value="">      
            <input type="hidden" name="lead_source"  id="lead_source" value="2">    
            
            <input type="text" name="first_name" value="" id="first_name" placeholder="Full Name">            
            <input type="text" name="username" value="" id="username" placeholder="Your Email" >            
			
            
              <div class="two-line">
             <div class="eight columns float-left"><input  type="text"  name="country_code" placeholder="Country Code" value="" id="country_code"></div>&nbsp;&nbsp;
             <div class="eight columns float-left"><input  type="text"  name="mobile" placeholder="Mobile Phone" value="" id="mobile"></div>
             
             </div>
             
             
            <input  type="text"  name="password" placeholder="Create  a Password" value="" id="password">
            
           <div class="margin-bottom-15">           
               <span style="display:inline-block;" >Gender</span>
               <label class="radio-inline">
               <input type="radio" name="gender_male" id="gender_male" value="1" checked="checked">Male</label>
               <label class="radio-inline">
               <input type="radio" name="gender_male" id="gender_female" value="0">Female</label>           
           </div>
           
             <div class="two-line">
             <div class="eight columns float-left"> <?php echo form_dropdown('nationality',  $nationality_list, '','data-placeholder="Filter by status" class="chosen-select-no-single" style="display: none;"');?></div>&nbsp;&nbsp;
             <div class="eight columns float-left"> <?php echo form_dropdown('present_nationality',  $current_nationality_list, '','data-placeholder="Filter by status" class="chosen-select-no-single" style="display: none;"');?></div>
             
             </div>
             
                                   
           <div class="margin-bottom-15">           
               <span style="display:inline-block;" >Present Job Status</span><br>
               <label class="radio-inline"><input type="radio" name="cur_job_status" value="1" checked="checked">No Job</label><br>
               <label class="radio-inline"><input type="radio" name="gender_male" value="2">Working, But Need a Change</label><br>
               <label class="radio-inline"><input type="radio" name="gender_male" value="4">Seeking Good Opportunity</label><br>
               <label class="radio-inline"><input type="radio" name="gender_male" value="6">Call after this month</label><br>
           </div>

             <div class="two-line">
             
             <div class="eight columns float-left"> <?php echo form_dropdown('level_id',  $edu_level_list, '','data-placeholder="Filter by status" class="chosen-select-no-single" style="display: none;"');?></div>&nbsp;&nbsp;
             <div class="eight columns float-left"><input type="text" name="course_name" value="" id="course_name" placeholder="Enter Course Name"></div>
             
             </div>
     
	
                 <div class="two-line">
             <div class="eight columns float-left"> <input type="text" name="company" value="" id="company" placeholder="Company"></div>&nbsp;&nbsp;
             <div class="eight columns float-left"><input type="text" name="designation" value="" id="designation" placeholder="Designation"></div>
             
             </div>
                 
                        
            <div class="two-line">
             <div class="eight columns float-left">
             <input class="form-control date-margin" type="text" readonly name="start_date" id="datepickfrom" value="" placeholder="From Date">
             </div>&nbsp;&nbsp;
              <div class="eight columns float-left">
              <input class="form-control date-margin" type="text" readonly name="end_date" id="datepickto" value="" placeholder="Till Date">
             </div>
             </div>
                            
                             
                             
		<!-- Select -->
        <div class="margin-bottom-15 margin-top-15">
		
         </div>
        

         
                            <div class="margin-bottom-15">
                            <span style="display:inline-block;" >Is this your present job?</span>
                            <label class="radio-inline">
            <input type="radio" name="present_job" id="present_job" value="1" checked="">Yes</label>
                            <label class="radio-inline">
            <input type="radio" name="present_job" id="present_job" value="0" checked="">No</label>
           
                            </div>

            <div class="two-line">
             <div class="eight columns float-left">
             <?php echo form_dropdown('industry_id',  $industry_list, '','data-placeholder="Filter by status" 	class="chosen-select-no-single" style="display: none;"');?>
             </div>&nbsp;&nbsp;
              <div class="eight columns float-left">
                <?php echo form_dropdown('func_id',  $functional_list, '','data-placeholder="Filter by status" 	class="chosen-select-no-single" style="display: none;"');?>
             </div>
             </div>

	         <div class="two-line">
             <div class="eight columns float-left"> <input  type="text" name="cur_ctc" id="cur_ctc" placeholder="Current CTC" value=""/></div>&nbsp;&nbsp;
             <div class="eight columns float-left"> <input type="text" name="exp_ctc" id="exp_ctc" placeholder="Expected CTC" value=""/></div>
             
             </div>

	         <div class="two-line">
             <div class="eight columns float-left"> <input  type="text" name="visa_status" id="visa_status" placeholder="VISA Status" value=""/></div>&nbsp;&nbsp;
             <div class="eight columns float-left"> <input type="text" name="release_noc" id="release_noc" placeholder="Release/NOC" value=""/></div>
             
             </div>

			<input type="text" name="app_notes" value="" id="app_notes" placeholder="Reason for Leaving">  
            <input type="text" name="skills" value="" id="skills" placeholder="Skills [Use ',' to separate]">  
                     
             <div class="two-line">
             <div class="eight columns float-left">
             <select data-placeholder="Filter by status" class="chosen-select-no-single"v name="notice_period" id="notice_period" style="display: none;">
			<option value="">Notice Period</option>
			<?php for($i=1;$i<=200;$i++){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                      <?php
                }?>
		</select>
             </div>&nbsp;&nbsp;
             <div class="eight columns float-left">
             	<select data-placeholder="Filter by status" name="exp_years" id="exp_years" class="chosen-select-no-single" style="display: none;">
			<option value="">Total Experience</option>
			 <?php for($i=1;$i<=30;$i += 0.5){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                      <?php
                }?>
		</select>
             </div>&nbsp;&nbsp;
             <div class="eight columns float-left">
             	<select data-placeholder="Filter by status" name="exp_years" id="exp_years" class="chosen-select-no-single" style="display: none;">
			<option value="">GCC Experience</option>
			 <?php for($i=1;$i<=30;$i += 0.5){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                      <?php
                }?>
		</select>
             </div>
             </div>
                            <!-- Select -->
        <div class="margin-bottom-15 margin-top-15">
		
         </div>
         <!-- Select -->
        <div class="margin-bottom-15 margin-top-15">
	
         </div>
							<!-- Upload CV -->
							<div class="upload-info"><strong>Upload your CV (optional)</strong> <span>Max. file size: 5MB</span></div>
							<div class="clearfix"></div>

							<label class="upload-btn">
							    
                                <?php echo form_upload(array('name'=>'cv_file','class'=>''));?>
							    <i class="fa fa-upload"></i> Browse
							</label>
					

							<div class="divider"></div>
							<!-- Upload Photo -->
							<div class="upload-info"><strong>Upload your Photo (optional)</strong> <span>Max. file size: 5MB</span></div>
							<div class="clearfix"></div>

							<label class="upload-btn">
							    
                                <?php echo form_upload(array('name'=>'cv_file','class'=>''));?>
							    <i class="fa fa-upload"></i> Browse
							</label>
					

							<div class="divider"></div>

  <button type="submit" class="send" id="save_registration" data-url="<?php echo site_url('home/save_registration'); ?>">Send Application</button>
						</form>
					</div>
					
				</div>
                
                	
</div>
<script src="<?php echo base_url('scripts/jquery-2.1.3.min.js');?>"></script>

<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script src="<?php echo base_url('scripts/jquery-1.11.3.min.js');?>"></script>
<script src="<?php echo base_url('scripts/bootstrap.min.js');?>"></script>

<script type="text/javascript">

var job_id=0;
/* form validation */
  function candidate_validate() {
		
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   
 
		if($('#username').val()=='')
		{
			alert('Enter username');
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
	    return true;
    }
	
/* form validation ends here */
	
$('#register_form').submit(function(evt) {
	   evt.preventDefault();
	   var formData = new FormData(this);
	   var isContactValid = candidate_validate();
		if(isContactValid) 
		{				
			  $.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data:formData,
				dataType: "json",
				cache:false,
				contentType: false,
				processData: false,
			   success: function(data) 
			   {
				 if(data.status == 'success'){
					 alert('We have received your application. Thank you!');
					 $("#register_form").trigger( "reset" );
					 $('.mfp-close').click();					
				 }
				 else
				 {
					 alert('Please fill the data');
				 }
				},
				error: function(data) {
				   alert("Some unknown error occured");
				}
				});
		}
});

/*
$('a').click(function(e){
	//e.preventDefault();
	
	return false;
});
*/
</script>

<script type="text/javascript">
   $(document).ready(function() 
   {
	   $('a').click(function(e) 
	   {
		   if($(this).attr("href")=='#small-dialog')
		   {
				e.preventDefault();
				job_id = $(this).attr('data-url');		
				$('#job_id').val(job_id);
		  }else
		  {
			  return true;
		  }
		}); 
   }); 
</script>

<!-- Facebook like button -->

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1843679489200752',
	   cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

</script>

<script>
	
$('.shareBtn').click(function(e){
  FB.ui({
  method: 'feed',
  link: $(this).attr('data-url'),
  caption: $(this).attr('title'),
  description: $(this).attr('caption'),
}, function(response){});
});


<!-- Facebook like button -->

</script>

<script type="in/Login"></script>

<!--  Linkedin Butoon -->

<script>
function linkedin(job_url,job_title,job_summary,link_source) {
   window.open('http://www.linkedin.com/shareArticle?mini=true&url='+job_url+'&title='+job_title+'&summary='+job_summary+'&source='+link_source, '', 'left=0,top=0,width=650,height=420,personalbar=0,toolbar=0,scrollbars=0,resizable=0');
}

</script>
<!--  Linkedin Butoon end here -->


<!--  Twitter Butoon -->
<script>

window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };
  return t;
}
(document, "script", "twitter-wjs"));
twttr.widgets.load();
</script>
<!--  Twitter Butoon -->