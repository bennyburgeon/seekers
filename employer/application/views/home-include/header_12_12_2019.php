<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->

<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Stylesheets
	============================================= -->
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Roboto:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/custom/style.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/swiper.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/dark.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/font-icons.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/animate.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('magnific-popup.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/responsive.css');?>" rel="stylesheet" type="text/css"/>
<title>Oxy Jobs</title>
<meta name="description" content="Search for Jobs in IT industry in Kerala. Talk to employers directly, plan you career.">
<meta name="keywords" content="IT Jobs in Cochin, IT jobs in Kochi, React Native jobs in Cochin, PHP Jobs in Kochi, IT Jobs in Info Park, Technopark Jobs">
<meta property="fb:app_id" content="1843679489200752"/>
<meta property="og:site_name" content="<?php echo $og_site_name;?>"/>
<meta property="og:title" content="<?php echo $og_title;?>"/>
<meta property="og:type" content="website"/>
<meta property="og:url" content="<?php echo $og_url;?>"/>
<meta property="og:image" content="<?php echo $og_image;?>"/>
<meta property="og:locale" content="en_US"/>
<link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('css/dcalendar.picker.css');?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('js/jquery.min.js');?>"></script>
<link href="<?php echo base_url('css/styles.css');?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('font-awesome-4.7.0/css/font-awesome.css');?>" rel="stylesheet" type="text/css"/>
<script language="JavaScript" type="text/javascript">
  $(document).ready(function(){
    $('.carousel').carousel({
      interval: 3000
    })
  });    
</script>
</head>

<body class="stretched">

<!-- Top Bar
		============================================= -->
<div id="top-bar">
  <div class="container clearfix">
    <div class="col_half nobottommargin"> 
      
      <!-- Top Links
					============================================= -->
      <div class="top-links">
        <ul>
          <li><a href="<?php echo $this->config->base_url();?>employer"><font color="#EB0003">Employer Login</font></a></li>
          <li> <a href="<?php echo $this->config->base_url();?>login"><font color="#EB0003">Candidate Login</font></a></li>
          <?php 
		
						if(!isset($_SESSION['candidate_session']))
						{
					?>
          <li> <a href="<?php echo $this->config->base_url();?>signup">
            <div><font color="#EB0003">Need a Job ?? Signup Here</font></div>
            </a> </li>
          <?php } ?>
          <?php 
		
						if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
						{
					?>
          <li><a href="<?php echo $this->config->base_url();?>index.php/candidates_all/summary"><font color="#002BD3">My Profile</font></a></li>
          <li><a href="<?php echo $this->config->base_url();?>index.php/logout"><font color="#EB0003">Logout</font></a></li>
          <?php 
		
					}
					?>
        </ul>
      </div>
      <!-- .top-links end --> 
      
    </div>
    <div class="col_half fright col_last nobottommargin"> 
      
      <!-- Top Social
					============================================= -->
      <div id="top-social">
        <ul>
          <li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a> </li>
          <li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a> </li>
          <li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a> </li>
          <li><a href="#" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text"><?php echo $this->config->item('company_phone')?></span></a> </li>
          <li><a href="mailto:<?php echo $this->config->item('company_email')?>" class="si-email3"><span class="ts-icon"><i class="icon-email3"></i></span><span class="ts-text"><?php echo $this->config->item('company_email')?></span></a> </li>
        </ul>
      </div>
      <!-- #top-social end --> 
      
    </div>
  </div>
</div>
<!-- #top-bar end --> 

<!-- Header
		============================================= -->
<header id="header" class="sticky-style-2">
  <div class="container clearfix"> 
    
    <!-- Logo
				============================================= -->
    <div id="logo"> <a href="<?php echo $this->config->base_url();?>index.php/home" class="standard-logo" data-dark-logo="<?php echo $this->config->base_url();?>images/logo-dark.png"> <img src="<?php echo $this->config->base_url();?>images/logo.png" alt="Oxy Jobs"> </a> </div>
    <!-- #logo end -->
    
    <ul class="header-extras">
      <li> <i class="i-plain icon-email3 nomargin"></i>
        <div class="he-text"> Drop an Email <span><?php echo $this->config->item('company_email')?></span> </div>
      </li>
      <li> <i class="i-plain icon-call nomargin"></i>
        <div class="he-text"> Get in Touch <span><?php echo $this->config->item('company_phone')?></span> </div>
      </li>
    </ul>
  </div>
  <div id="header-wrap"> 
    
    <!-- Primary Navigation
				============================================= -->
    <nav id="primary-menu" class="style-2">
      <div class="container clearfix">
        <div id="primary-menu-trigger"><i class="icon-reorder"></i> </div>
        <ul>
          <li> <a href="<?php echo $this->config->base_url();?>home">
            <div><font color="#002BD3">All Jobs</font></div>
            </a> </li>
            
             <li> <a href="<?php echo $this->config->base_url();?>summary">
            <div><font color="#002BD3">Summary</font></div>
            </a> </li>
            
            
          <li> <a href="<?php echo $this->config->base_url();?>walkins">
            <div><font color="#002BD3">Walkins</font></div>
            </a> </li>
            
             <li> <a href="<?php echo $this->config->base_url();?>sales_job">
            <div><font color="#002BD3">Sales Jobs</font></div>
            </a> </li>
            
            <!--<li> <a href="<?php echo $this->config->base_url();?>co_working">
            <div><font color="#002BD3">Co-working</font></div>
            </a> </li>-->
            
            <li> <a href="<?php echo $this->config->base_url();?>events">
            <div><font color="#002BD3">Events</font></div>
            </a> </li>
          <li> <a href="<?php echo $this->config->base_url();?>internship">
            <div><font color="#002BD3">Internships</font></div>
            </a> </li>
            <li class="current"> <a href="<?php echo $this->config->base_url();?>freelance">
            <div>Freelance</div>
            </a> </li>
         <!-- <li class="current"> <a href="<?php echo $this->config->base_url();?>index.php/company">
            <div>Employers</div>
            </a> </li>
          <li> <a href="<?php echo $this->config->base_url();?>index.php/innovations">
            <div><font color="#002BD3">Innovations</font></div>
            </a> </li>
          <li> <a href="<?php echo $this->config->base_url();?>index.php/co_working">
            <div><font color="#002BD3">Co-working</font></div>
            </a> </li>
          <li> <a href="<?php echo $this->config->base_url();?>index.php/events">
            <div><font color="#002BD3">Events</font></div>
            </a> </li>
          <li> <a href="<?php echo $this->config->base_url();?>index.php/auditing">
            <div><font color="#002BD3">Auditing</font></div>
            </a> </li>
          <li> <a href="<?php echo $this->config->base_url();?>index.php/start_up">
            <div><font color="#002BD3">Start-up</font></div>
            </a> </li> --> 
          <br>
          
          <!-- 
						<li>
							<a href="<?php echo $this->config->base_url();?>index.php/home">
								<div>Virtual Job Fair</div>
							</a>
						</li>
                        
						

						<li>
							<a href="<?php echo $this->config->base_url();?>index.php/home">
								<div>Workshops</div>
							</a>
						</li>
                        
                      
                        
                        
						<li>
							<a href="<?php echo $this->config->base_url();?>index.php/home">
								<div>Webinars</div>
							</a>
						</li>
						
						
						<li>
							<a href="<?php echo $this->config->base_url();?>index.php/home">
								<div>Internships</div>
							</a>
						</li>
                        
                          -->
          
        </ul>
        
        <!-- Top Search
						============================================= --> 
        
        <!-- #top-search end --> 
      </div>
    </nav>
    <!-- #primary-menu end --> 
    
  </div>
</header>
<!-- #header end --> 

<!--header ends--> 
