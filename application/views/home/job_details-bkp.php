
<!--search results--> 
<br />
<div class="container-fluid">
  <div class="container">
  
    <div class="panel panel-default">
    <div style="padding-right:10px;">
   
</div>
      <div class="panel-heading"><strong>
      
        <h4><i class="fa fa-share" aria-hidden="true"></i><strong> Apply For This Job</strong> 
        
<?php 
	if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
	{
?>
<a href="#" class="btn btn-warning pull-right btn-xs" title="Already Applied for this Job">Welcome <?php echo $_SESSION['candidate_first_name'];?> !!</a>

<?php 
	}else{
?>

        
<a href="<?php echo $this->config->base_url();?>index.php/login/?job_id=<?php echo md5($job['job_id']); ?>" class="btn btn-warning pull-right btn-xs" title="Already Applied for this Job">Login & Aplly for this Job</a>

<?php } ?>

                            </h4>
        </strong> 
        </div>
        
      <div class="panel-body">
      
        <div class="row box">
        
        <?php echo $left_reg_form;?>
          
          <div class="col-sm-8">
          <div class="panel panel-primary">
          <div class="panel-heading"><strong><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;<?php echo $job['job_title']; ?></strong> </div>
          
          <div class="panel-body">
              
                     <div class="col-sm-4 "><i class="fa fa-usd icon_color" aria-hidden="true"></i><strong> Salary:</strong>&nbsp;<?php echo $this->config->item('currency_symbol');?> <?php echo $job['salary_desc']; ?></div>
              
		      <div class="col-sm-4"><i class="fa fa-map-marker icon_color" aria-hidden="true"></i> <strong>Location:</strong> 
			  <?php if($job['city_name']!='')echo $job['city_name'];else echo 'Na'; ?></div>
      	
      			<div class="col-sm-4 "><i class="fa fa-graduation-cap icon_color" aria-hidden="true"></i> <strong>Eligibility:</strong> 
				<?php if($job['level_name']!='')echo $job['level_name'];else echo 'ANY'; ?></div>
<br>
<br>
          <div class="col-sm-4 "><i class="fa fa-eyedropper icon_color" aria-hidden="true"></i><strong> Experience:</strong>&nbsp;
		  
		  
		  <?php if($job['exp_range']!=''){ ?>
			  <?php echo $job['exp_range']; ?>
              <?php }else{ ?>
              NA
              <?php } ?>
              		  
          
          </div>


                <div class="col-sm-4 "><i class="fa fa-flag icon_color" aria-hidden="true"></i><strong> Nationality:</strong>&nbsp;
				<?php if($job['country_name']!='')echo $job['country_name'];else echo 'ANY'; ?></div>
                                 
                       <div class="col-sm-4"><i class="fa fa-calendar icon_color" aria-hidden="true"></i> <strong>Posted On:</strong> 
					   <?php echo date("d-m-Y", strtotime($job['job_post_date'])); ?></div>
      <br>
<br>
                       <div class="col-sm-4"><i class="fa fa-calendar icon_color" aria-hidden="true"></i> <strong>Gender:</strong> 

                       
					   <?php if($job['gender']=='0')echo 'No Preference'; ?>
                        <?php if($job['gender']=='1')echo 'Female'; ?>
                         <?php if($job['gender']=='2')echo 'Male'; ?>
                       
                       
                       </div>

      			<div class="col-sm-8 "><i class="fa fa-industry icon_color" aria-hidden="true"></i> <strong>Industry:</strong> 
                       
                <?php if($job['job_cat_name']!='')echo $job['job_cat_name'];else echo 'NA' ?>
               
               
               <!-- 
                <?php if($job['func_area']!='')echo ','.$job['func_area'];?>
               -->
               
                
                <br /></div>
                
              
      <br />
             
           <br>

              
			<strong>Job Description</strong><br /><br />
            
             <?php echo $job['job_desc']; ?>


<strong>Desired Candidate Profile</strong><br /><br />

 <?php echo $job['desired_profile'];?>
 
<br>
<br>

 
 <ul>

<li>Work Level: <?php if($job['work_level']!='')echo $job['work_level'];else echo 'ANY'; ?></li>
<li>Current Location: <?php if($job['res_location']!='')echo $job['res_location'];else echo 'NA' ?></li>
             
<li><?php if($job['salary_desc']>=1){?>Salary <?php echo $this->config->item('currency_symbol');?>  : <?php echo $job['salary_desc']; ?><?php }else{?>NA<?php } ?></li>

<!-- <li>Vacancies:<?php echo $job['vacancies'];?></li> -->

<li> Posted on:

<?php echo date("F", strtotime($job['job_post_date'])); ?> <?php echo date("d", strtotime($job['job_post_date'])); ?>th<?php echo date(" Y", strtotime($job['job_post_date'])); ?>

</li> 
<li>Last date of Application: <?php echo date("F", strtotime($job['job_expiry_date'])); ?> <?php echo date("d", strtotime($job['job_expiry_date'])); ?>th<?php echo date(" Y", strtotime($job['job_expiry_date'])); ?> </li> 
<li>Expected Joining Date: 

<?php echo date("F", strtotime($job['exp_join_date'])); ?> <?php echo date("d", strtotime($job['exp_join_date'])); ?>th<?php echo date(" Y", strtotime($job['exp_join_date'])); ?>

</li>
<li>Eligibility:  <?php if($job['level_name']!='')echo $job['level_name'];else echo 'ANY'; ?></li> 

<!-- 
<li>Preferred Gender:<?php if($job['gender'] =='1')echo 'Female'; else if($job['gender'] == '2') echo 'Male'; else echo 'No Preference' ;?></li>
 -->
 
  <br>
  </ul>

  Share Using: 		
  
  <a href="javascript:;" data-url="<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>" caption="<?php echo $job['job_title']; ?>" title="<?php echo $job['social_content']; ?>" class="shareBtn" id="shareBtn"><span><i class="fa fa-facebook-official"></i></span></a>
  
&nbsp;&nbsp;
<a class="twitter-share-button"
  href="https://twitter.com/share"
  data-size="large"
  data-text="<?php echo strip_tags($job['desired_profile']); ?>"
  data-url="<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>"
  data-hashtags="#<?php echo $job['job_title']; ?>"
  data-via="seekersgulf"
  data-related="twitterapi,twitter">
Tweet
</a>


&nbsp;&nbsp;


		<a href="javascript:;" onclick="javascript:linkedin('<?php echo $this->config->base_url();?>index.php/home/job_details?id=<?php echo md5($job['job_id']); ?>','<?php echo $job['job_title']; ?>','<?php echo strip_tags($job['desired_profile']); ?>','<?php echo $this->config->base_url();?>');" data-url="<?php echo $job['job_id']; ?>"><span><i class="fa fa-linkedin"></i></span></a>
        
        &nbsp;&nbsp;
<!--         
                             <a href="https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=81abyzu708bcg0&redirect_uri=http://www.unicornhr.in/index.php/authentic/oauth_primary&state=<?php echo md5($job['job_id']); ?>&scope=r_basicprofile r_emailaddress" target="_blank" data-url="<?php echo md5($job['job_id']); ?>" >Sign In With Linkedin</a>

<br>
-->                
                
              
              </div>
            </div>            
          </div>


          
        </div>
        
      </div>
      
    </div>
  </div>
</div>


<script type="text/javascript">

var job_id=0;
/* form validation */

  function candidate_validate() 
  {

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

		if($('#password').val()=='')
		{
			alert('Enter Password');
			$('#password').focus();
			return false;
		}

		if($('#c_password').val()=='')
		{
			alert('Confirm Your Password');
			$('#c_password').focus();
			return false;
		}
		
		if($('#c_password').val()!=$('#password').val())
		{
			alert('Password mismatch, please correct');
			$('#c_password').focus();
			return false;
		}
					  
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   
		
		if($('#mobile').val()=='')
		{
			alert('Enter mobile');
			$('#mobile').focus();
			return false;
		}

		var mobile_check=getValidNumber($('#mobile').val());

		if(mobile_check==false)
		{
			alert('Please enter valid mobile number');
			$('#mobile').focus();
			return false;
		}
		
		 if($('#driving_license_yes').is(':checked')) 
		 { 
			if($('#driving_license_country').val()=='')
			{
				alert("Please select country of Driving License issued"); 
				return false;
			}
		 }
		 
		return true;
    }

	function getValidNumber(value)
	{
		var a = value;
		var filter = /^[0-9-+]+$/;
		
		if (filter.test(a)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
		
/* form validation ends here */
	
$('#submit_form').click(function(evt) 
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