
<!--search results--> 
<br />
<div class="container-fluid">
  <div class="container">
  
    <div class="panel panel-default">
    <div style="padding-right:10px;">
   
</div>
      <div class="panel-heading"><strong>
      
        <h4><i class="fa fa-share" aria-hidden="true"></i><strong> Apply For This Job</strong> </h4>
        </strong> 
        </div>
        
      <div class="panel-body">
      
        <div class="row box">
        
        <?php echo $left_reg_form;?>
          
          <div class="col-sm-8">
          <div class="panel panel-primary">
          <div class="panel-heading"><strong><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;<?php echo $job['job_title']; ?></strong> </div>
          
          <div class="panel-body">
              
          <div class="col-sm-4 "><i class="fa fa-usd icon_color" aria-hidden="true"></i><strong> Salary:</strong> <?php echo $job['salary_desc']; ?></div>
          <div class="col-sm-4"><i class="fa fa-map-marker icon_color" aria-hidden="true"></i> <strong>Location:</strong> <?php echo $job['job_location']; ?></div>
          <div class="col-sm-4 "><i class="fa fa-graduation-cap icon_color" aria-hidden="true"></i> <strong>Eligibility:</strong> <?php echo $job['level_name']; ?></div>
      
          <div class="col-sm-4 "><i class="fa fa-industry icon_color" aria-hidden="true"></i> <strong>Industry:</strong><?php echo $job['job_cat_name']; ?>, <?php echo $job['func_area']; ?>, <?php if(isset($job['role_name'])) echo $job['role_name']; echo $job['func_area']; ?><br /></div>
          <div class="col-sm-4"><i class="fa fa-calendar icon_color" aria-hidden="true"></i> <strong>Job Post Date:</strong> <?php echo date("d-m-Y", strtotime($job['job_post_date'])); ?></div>
          
          <div class="col-sm-4 ">adasd</div>

              
      <br />
              <br />
              <br /><br />
              
			<strong>Job Description</strong><br /><br />
            
             <?php echo $job['job_desc']; ?>

<strong>Skills Required:</strong><br /><br />


 <?php echo $job['desired_profile'];?>
 
 
 
<strong>Educational Qualifications:</strong> Graduation in Polymers/Plastic/Chemical/Composites.<br /><br />

<strong>Company Profile</strong>

<br /><br />

<?php  echo $job['about_company']; ?>


<br /><br />
<ul class="list-1">
			<li>Work Level: <?php echo $job['work_level']; ?></li>
            <li>Brochure: <?php echo $job['brochure']; ?></li>
            <li>Res Location: <?php echo $job['res_location']; ?></li>
            <li>Country: <?php echo $job['country_name']; ?></li>
            <li>Contact Name: <?php echo $job['contact_name']; ?></li>
            <li>Contact Designation: <?php echo $job['contact_designation']; ?></li>
            <li>Contact Email: <?php echo $job['contact_email']; ?></li>
            <li>Contact Phone: <?php echo $job['contact_phone']; ?></li>
            <li>Contact Website: <?php echo $job['contact_website']; ?></li>
            <li>Facebook: <?php echo $job['facebook']; ?></li>
            <li>Twitter: <?php echo $job['twitter']; ?></li>
            <li>Google Plus: <?php echo $job['googleplus']; ?></li>
            <li>Linkedin: <?php echo $job['linkedin']; ?></li>
	</ul>
 <br />
                <ul>
<li>Salary:<?php echo $job['salary_desc']; ?></li>
<li>Vacancies:<?php echo $job['vacancies'];?></li>
<li>Job Post Date:<?php echo date("d-m-Y", strtotime($job['job_post_date'])); ?></li> 
<li>Last Date: <?php echo date("d-m-Y", strtotime($job['job_expiry_date'])); ?></li> 
<li>Exp. Join Date Date: <?php echo date("d-m-Y", strtotime($job['exp_join_date'])); ?>  </li>
<li>Industry: IT , Application Programming </li>
<li>Location: <?php echo $job['job_location']; ?> </li>
<li>Eligibility:</li> 

<li>Preferred Gender:<?php if($job['gender'] =='1')echo 'Female'; else if($job['gender'] == '2') echo 'Male'; else echo 'No Preference' ;?></li>
 
 
  <br>
 
                </ul>
                
                    Share Using: 		<a href="javascript:;" data-url="<?php echo $this->config->base_url();?>index.php/home/job_details?id=<?php echo md5($job['job_id']); ?>" caption="<?php echo $job['social_title']; ?>" title="<?php echo $job['social_content']; ?>" class="shareBtn" id="shareBtn"><span><i class="fa fa-facebook-official"></i></span></a>
&nbsp;&nbsp;
<a class="twitter-share-button"
  href="https://twitter.com/share"
  data-size="large"
  data-text="<?php echo $job['social_title']; ?>"
  data-url="<?php echo $this->config->base_url();?>index.php/home/job_details?id=<?php echo md5($job['job_id']); ?>"
  data-hashtags="example,demo"
  data-via="shyjo_mathew"
  data-related="twitterapi,twitter">
Tweet
</a>


&nbsp;&nbsp;


		<a href="javascript:;" onclick="javascript:linkedin('<?php echo $this->config->base_url();?>index.php/home/job_details?id=<?php echo md5($job['job_id']); ?>','<?php echo $job['social_title']; ?>','<?php echo $job['social_content']; ?>','<?php echo $this->config->base_url();?>');" data-url="<?php echo $job['job_id']; ?>"><span><i class="fa fa-linkedin"></i></span></a>
        
        &nbsp;&nbsp;
        
                             <a href="https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=81abyzu708bcg0&redirect_uri=http://www.seekersgulf.com/index.php/authentic/oauth_primary&state=<?php echo md5($job['job_id']); ?>&scope=r_basicprofile r_emailaddress" target="_blank" data-url="<?php echo md5($job['job_id']); ?>" >Sign In With Linkedin</a>

<br>
                
                
              
              </div>
            </div>            
          </div>


          
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

  function candidate_validate() 
  {

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
				url: "<?php echo $this->config->site_url();?>/home/check_email",
				cache: false,				
				data: {username:$('#username').val()},
				success: function(data){ 
					try{		
						var ret = jQuery.parseJSON(data);
						alert(ret['STATUS']);
						if(ret['STATUS']=='0') 
						{
							$('#register_form').submit();
							return true;
						}else if(ret['STATUS']=='1') 
						{
							alert('Email already exist. Please change.');
							return false;
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