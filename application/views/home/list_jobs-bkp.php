<form id="search_form" action="<?php echo site_url('home/'); ?>"  class="formular" name="search_form" method="get" enctype="multipart/form-data">
<div class="container-fluid searchbox">
  <div class="row box">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
        <div class="input-group">
          <input type="text" class="form-control input-lg searchbar" value="<?php echo $search_text?>" placeholder="S e a r c h ... Sales, Accounts, Marketing, Administration etc." name="search_text">
          <div class="input-group-btn">
            <button class="btn btn-default search_btn" type="submit"><i class="fa fa-search"></i></button>
          </div>
        </div>
    </div>
    <div class="col-sm-3"></div>
  </div>
</div>


<br />

<div class="container-fluid">
  <div class="container">
  
    <div class="panel panel-default">
    
    <?php echo $pagination;?>
    
      <div class="panel-heading"><strong>
      
        <h4><i class="fa fa-files-o" aria-hidden="true"></i><strong> Total Results</strong> <span class="badge "><?php echo $total_rows;?> </span></h4>
        </strong> 
        </div>
        
      <div class="panel-body">
      
        <div class="row box">
        
           <?php echo $left_search_form;?>
           
          <div class="col-sm-9">
          
          <?php 
				if(isset($jobs) && !empty($jobs))
				{
				 foreach($jobs as $job)
				 {
		  ?>
          
            <div class="panel panel-primary">
              <div class="panel-heading"><strong><a style="color:white;" href="<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>"><?php echo $job['job_title']; ?> <div style="float:right;">Job ID: SEEK-<?php echo $job['job_id']; ?></div></strong> </a></div>
              <div class="panel-body">
              <div class="col-sm-4 "><i class="fa fa-usd icon_color" aria-hidden="true"></i><strong> Salary:</strong>&nbsp;
			  <?php if($job['salary_desc']>=1){ ?>
			  <?php echo $this->config->item('currency_symbol');?> <?php echo $job['salary_desc']; ?>
              <?php }else{ ?>
              NA
              <?php } ?>
              
              </div>


              
		      <div class="col-sm-4"><i class="fa fa-map-marker icon_color" aria-hidden="true"></i> <strong>Location:</strong> <?php if($job['city_name']!='')echo $job['city_name'];else echo 'NA'; ?></div>
      	
      			<div class="col-sm-4 "><i class="fa fa-graduation-cap icon_color" aria-hidden="true"></i> <strong>Eligibility:</strong> <?php if($job['level_name']!='')echo $job['level_name'];else echo 'ANY';?></div>
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
				<?php if($job['country_name']!='')echo $job['country_name'];else echo 'ANY'; ?>
                </div>
                                 
                       <div class="col-sm-4"><i class="fa fa-calendar icon_color" aria-hidden="true"></i> <strong>Job Posted On:</strong> 
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
                
                <br />
                
                </div>
				<br>

				<br>
<?php echo $job['desired_profile']; ?>
                <br>
<br>

Share Using &nbsp;&nbsp;

	<a href="javascript:;" data-url="<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>" caption="<?php echo $job['job_title']; ?>" title="<?php echo strip_tags($job['desired_profile']); ?>" class="shareBtn" id="shareBtn"><span><i class="fa fa-facebook-official"></i></span></a>

              
&nbsp;&nbsp;
<a class="twitter-share-button"
  href="https://twitter.com/share"
  data-size="large"
  data-text="<?php echo strip_tags($job['desired_profile']); ?>"
  data-url="<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>"
  data-hashtags="seekersgulf"
  data-via="seekersgulf"
  data-related="twitterapi,twitter">
Tweet
</a>
&nbsp;&nbsp;

		<a href="javascript:;" onclick="javascript:linkedin('<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>','<?php echo strip_tags($job['job_title']); ?>','<?php echo strip_tags($job['desired_profile']); ?>','<?php echo $this->config->base_url();?>');" data-url="<?php echo $job['job_id']; ?>"><span><i class="fa fa-linkedin"></i></span></a>

                             
<?php if(isset($job['job_applied']) && $job['job_applied']>0){ ?>


<a href="javascript:;" class="btn btn-warning pull-right btn-xs" title="Already Applied for this Job">Applied</a>
                            
                            
<?php }else{ ?>    

                <button type="button" onClick="window.location='<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>'" class="btn btn-primary pull-right btn-sm"><strong>View & Apply</strong></button>

                                
<?php } ?>                

              
              </div>
            </div>
           
         	 <?php } }else{ ?>
             
             <div class="panel panel-primary">
              <div class="panel-heading"><strong>Empty Search Result....</strong> </div>
              <div class="panel-body">

             <br>
              <br>
              Your search shows an empty result. Please try with other options.<br>
                <br>
               
                <button type="button" onClick="window.location='<?php echo site_url('home/'); ?>';" class="btn btn-primary pull-right btn-sm"><strong>Reset All Search Filters</strong></button><br>
              </div>
            </div>
             <?php } ?>
           
            
          </div>
          
        </div>
         <?php echo $pagination;?>
      </div>
      
    </div>
  </div>
</div>

</form>

<script src="<?php echo base_url('scripts/jquery-2.1.3.min.js');?>"></script>
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script src="<?php echo base_url('scripts/jquery-1.11.3.min.js');?>"></script>
<script src="<?php echo base_url('scripts/bootstrap.min.js');?>"></script>

<script type="text/javascript">

var job_id=0;

$('#search_form_ajax').submit(function(evt) 
{
	   evt.preventDefault();
			if(!isContactValid) 
		   {
				return false;
			}

	  	$.ajax({
				type: "post",
				url: "<?php echo $this->config->site_url();?>/home/get_result",
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
<!--  Twitter Butoon -->

