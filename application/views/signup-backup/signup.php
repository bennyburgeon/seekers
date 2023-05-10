
<!--search results--> 
<br />
<div class="container-fluid">
  <div class="container">
  
    <div class="panel panel-default">
    <div style="padding-right:10px;">
   
</div>
      <div class="panel-heading"><strong>
      
        <h4><i class="fa fa-share" aria-hidden="true"></i><strong> Register your Profile</strong> </h4>
        </strong> 
        </div>
        
      <div class="panel-body">
      
        <div class="row box">
        
		<div class="col-sm-2"></div>
        
       <form id="register_form" action="<?php echo site_url('signup/save_registration'); ?>"  class="formular" name="register_form" method="post" enctype="multipart/form-data">

    <input type="hidden" name="lead_source"  id="lead_source" value="2">  
    
<div class="col-sm-8">
            <div class="panel panel-success">
              <div class="panel-heading"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i> Register Now</strong></div>
              <br />
              
              <div class="panel-body">
              <div class="panel panel-info">
  <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Personal Details</div>
  <div class="panel-body"><input type="text" name="first_name" class="form-control input-sm" placeholder="Your Name" id="first_name"><br />
                            <input type="text" name="username" class="form-control input-sm" placeholder="Your Email" id="username"><br />
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          
  <?php echo form_dropdown('country_code',  $country_intl_code, '','data-placeholder="Filter by status" class="form-control input-sm" ');?>
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          <input type="text" name="mobile" class="form-control input-sm" placeholder="Mobile Phone" id="mobile">
                        </div></div>
                            </div>
                            <input type="text" class="form-control input-sm" name="password" placeholder="Create Password" id="password"><br />
                            <label for="sel1">Gender: </label>
                            
                            <label class="radio-inline"><input type="radio" id="gender_male" name="gender">Male</label>
							<label class="radio-inline"><input type="radio" id="gender_female" name="gender">Female</label><br />
                            
                            <div class="form-group">
                        <div class="form-group">
                          <label for="sel1">Nationality:</label>
                           <?php echo form_dropdown('nationality',  $nationality_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                        </div>
                        
                        <div class="form-group">
                          <label for="sel1">Currently Located:</label>
                          <?php echo form_dropdown('current_location',  $current_nationality_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                          
                        </div>
                        </div>
                            
                            </div>
                            </div>
              
                        
                        <div class="panel panel-default">
                        <div class="panel-body">
                        	
                            <label for="sel1">Present job status: </label><br />
                            <label class="radio-inline"><input type="radio" value="1" name="cur_job_status">No Job</label><br />
							<label class="radio-inline"><input type="radio" value="2" name="cur_job_status">Working, But Need a Change</label><br />
                            <label class="radio-inline"><input type="radio" value="4" name="cur_job_status">Seeking Good Opportunity</label><br />
                            <label class="radio-inline"><input type="radio" value="6"  name="cur_job_status">Call after this month</label><br />
                            
                            </div>
                            </div>	
                        
                        <div class="panel panel-info">
                        <div class="panel-body">
                        <label for="sel1">Education: </label><br />
                          <label for="sel1"></label>
                          
                          <?php echo form_dropdown('level_id',  $edu_level_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?>
                          
                          <label for="sel1"></label>
                          <input type="text" name="course_name" class="form-control input-sm" placeholder="Course Name" id="course_name">
                          </div>
                          </div>
                        
                        <div class="panel panel-success">
                        <div class="panel-body">
                            
                            <input type="text" class="form-control input-sm" name="company" placeholder="Company" id="company"><br />
                            <input type="text" class="form-control input-sm"  name="designation" placeholder="Designation" id="designation"><br />
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1">From: </label><br />
                          <input type="text" class="form-control input-sm " placeholder="YYYY-MM-DD" id="datepickfrom" name="from_date"><br />
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1">To: </label><br />
                          <input type="text" class="form-control input-sm " id="datepickto" placeholder="YYYY-MM-DD" name="to_date"><br />
                        </div></div>
                            </div>
                            
                            <label for="sel1">Is this your present job?  </label>
                            
                            <label class="radio-inline"><input type="radio" value="1" name="present_job">Yes</label>
                            
							<label class="radio-inline"><input type="radio" value="0" name="present_job">No</label><br />
                            
                          <label for="sel1"></label>
                          <?php echo form_dropdown('industry_id',  $industry_list, '','data-placeholder="Filter by status" 	class="form-control input-sm"');?>
                          
                        
                          <label for="sel1"></label>
                          <?php echo form_dropdown('func_id',  $functional_list, '','data-placeholder="Filter by status" 	class="form-control input-sm"');?>
                          <br />
                        
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
							                          
                          <input type="text" class="form-control input-sm" name="current_ctc" placeholder="Current CTC" id="current_ctc">
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <input type="text" class="form-control input-sm" placeholder="Expected CTC" name="expected_ctc" id="expected_ctc">
                        </div></div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          <input type="text" class="form-control input-sm" placeholder="Visa Status" name="visa_status" id="visa_status">
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <input type="text" class="form-control input-sm" placeholder="Release / NOC" name="release_noc" id="release_noc">
                        </div></div>
                            </div>
                            <input type="text" class="form-control input-sm" placeholder="Reason for leaving" name="reason_to_leave" id="reason_to_leave"><br />
                             <input type="text" class="form-control input-sm" placeholder="Skills [Use ',' to separate]" name="skills" id="skills"><br />
                            
                            
                            
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          <select class="form-control input-sm" id="sel1">
                            <option value="">Notice Period</option>
                          <?php for($i=1;$i<=200;$i++){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                      <?php
                }?>
                          </select>
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <label for="sel1"></label>
                          <select class="form-control input-sm" id="sel1">
                            <option value="">Total Experience</option>
			 <?php for($i=1;$i<=30;$i += 0.5){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                      <?php
                }?>
                          </select>
                        </div></div>
                            </div>
                            <label for="sel1"></label>
                          <select class="form-control input-sm" id="sel1">
                            <option value="">GCC Experience</option>
			 <?php for($i=1;$i<=30;$i += 0.5){
                ?>
                      <option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                      <?php
                }?>
                          </select>
                          </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          <label for="sel1">CV: </label>
                        </div></div>
                            <div class="col-sm-6"> 
                            <?php echo form_upload(array('name'=>'cv_file','class'=>'class="btn btn-primary pull-right btn-sm"'));?>
                        
                        </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          <label for="sel1">Upload Your Photo: </label>
                        </div></div>
                            <div class="col-sm-6"> <div class="form-group">
                          <?php echo form_upload(array('name'=>'photo','class'=>'class="btn btn-primary"'));?>
                        </div></div>
                            </div>
                          
   <button type="button" id="sbumit_form" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Send Application </strong></button>
                        
              
              </div>
            </div>
          </div>
</form>
          

          
        </div>
        
      </div>
      
    </div>
  </div>
</div>


<script src="<?php echo base_url('scripts/jquery-2.1.3.min.js');?>"></script>

<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script src="<?php echo base_url('scripts/jquery-1.11.3.min.js');?>"></script>
<script src="<?php echo base_url('scripts/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('scripts/dcalendar.picker.js');?>"></script>

<script type="text/javascript">
	$('#datepickfrom').dcalendarpicker();
	$('#datepickto').dcalendarpicker();
</script>

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
	
$('#sbumit_form').click(function(evt) 
{
	   evt.preventDefault();
	   var isContactValid = candidate_validate();
			if(!isContactValid) 
		   {
				return false;
			}

	  	$.ajax({
				type: "post",
				url: "<?php echo $this->config->site_url();?>/signup/check_email",
				cache: false,				
				data: {username:$('#username').val()},
				success: function(data){ 
					try{		
						var ret = jQuery.parseJSON(data);
						if(ret['status']=='1') 
						{
							alert('Email already exist. Please change.');
							return false;
						}else 
						{
							$('#register_form').submit();
							return true;
						}
					}
					catch(e) {		
						alert('Exception occured while chekcing email duplication');
						return false;
					}	
				},
				error: function(){						
					alert('An Error has been found on Ajax request from duplicate check [Email]');
					return false;
				}
			});//end ajax
});
/*
$('a').click(function(e){
	e.preventDefault();
	job_id = $(this).attr('data-url');
	$('#job_id').val(job_id);
	return false;
	});
*/

</script>

<!-- Facebook like button -->

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1319993951390227',
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