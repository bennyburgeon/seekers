<!doctype html>

<html lang="en" class="no-js">

<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">



<title><?php echo $page_title;?></title>



<meta property="fb:app_id" content="796171677813841" />

<meta property="og:site_name" content="<?php echo $og_site_name;?>" />

<meta property="og:title" content="<?php echo $og_title;?>" />

<meta property="og:type" content="website" />

<meta property="og:url" content="<?php echo $og_url;?>" />

<meta property="og:image" content="<?php echo $og_image;?>" />

<meta property="og:locale" content="en_US" />





	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css');?>"> <!-- Bootstrap CSS -->



	<link rel="stylesheet" href="<?php echo base_url('css/custom-style.css');?>"> <!-- Demo CSS -->

	<link rel="stylesheet" href="<?php echo base_url('css/navik-horizontal-default-menu.min.css');?>"> <!-- Navik navigation CSS -->

	<link rel="stylesheet" href="<?php echo base_url('css/custom-style.css');?>"> <!-- Navik navigation CSS -->

    	<link rel="stylesheet" href="<?php echo base_url('css/font-awesome.min.css');?>"> <!-- Navik navigation CSS -->

	<link href="https://fonts.googleapis.com/css?family=Fira+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> <!-- Google fonts -->

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> <!-- Google fonts -->

    

<!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-180761028-1"></script>

<script>

  window.dataLayer = window.dataLayer || [];

  function gtag(){dataLayer.push(arguments);}

  gtag('js', new Date());



  gtag('config', 'UA-180761028-1');

</script>    



</head>

<body>

 <!-- Header -->   

<div class="top-header">

    <div class="container">

                <div class="row">     

       <div class="col-md-6 col-sm-12">

           <div class="toplinks">

           <a href="<?php echo $this->config->base_url();?>index.php/homepage"><i class="fa fa-envelope "></i>  jobs@logis.ae  </a> <a href="<?php echo $this->config->base_url();?>index.php/home"> <i class="fa fa-mobile"></i>WhatsApp : +971 50 3860610 </a>  </div>        

       </div>

             <div class="col-md-6 col-sm-6">              

        <ul class="social-icons">

                     <li><a class="facebook" target="_blank" href="http://facebook.com/seekershr"><i class="fab fa-facebook-f"></i></a></li>

                      <li><a class="facebook" target="_blank" href="http://linkedin.com/company/seekershr"><i class="fab fa-linkedin"></i></a></li>

                     <li><a class="twitter" target="_blank" href="http://www.twitter.com/seekersgulf"><i class="fab fa-twitter"></i></a></li>

                     <li><a class="dribbble" target="_blank" href="http://www.instagaram.com/seekershr"><i class="fab fa-instagram"></i></a></li>

                  </ul>            

                   </div>     

                    

       

</div> </div>  </div>   

 <div class="header-bx">

            <div class="container">

                <div class="row"> 

                <div class="col-md-6 col-sm-6 col-12"> 

                

            <div class="logo" data-mobile-logo="<?php echo base_url('img/logo.jpeg');?>" data-sticky-logo="<?php echo base_url('img/logo.jpeg');?>">

                  <a href="<?php echo $this->config->base_url();?>index.php/homepage"><img src="<?php echo base_url('img/logo.jpeg');?>" alt="logo"/></a>

               </div>

                 

           </div>

                    <div class="col-md-6 col-sm-6 col-12"> 

                   <div class="register-btn ">

                   

                   <?php 		

		if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')

		{

		?>

<div class="btn-group">

          <button type="button" onclick="window.location='<?php echo $this->config->base_url();?>index.php/candidates_all/summary';" class="btn btn-default bold">My Profile</button>

         

         <button type="button" onclick="window.location='<?php echo $this->config->base_url();?>index.php/logout';"  class="btn btn-danger bold">Logout</button>

         

        </div>

        <?php 

		

		}else

		{

		?>

        <div class="btn-group">

           <a href="<?php echo $this->config->base_url();?>index.php/login" data-toggle="modal" data-target=".bs-example-modal-lg"> <i class="fa fa-lock" > </i> Login</a>

           <a href="<?php echo $this->config->base_url();?>index.php/signup" data-toggle="modal" data-target=".bs-example-modal1-lg"> <i class="fa fa-lock" > </i> Register</a>

        </div>

       <?php } ?>

       

                   

                 

                  <a href="https://wa.me/+971552546463"> <i class="fab fa-whatsapp"> </i> </a>

                  <a href="<?php echo $this->config->base_url();?>index.php/homepage"> <i class="fab fa-rocketchat"> </i> </a>

               </div>  

                    

                    

           </div>       

                    

                    

                    

       </div>

       </div>

       </div>

  <div class="navik-header header-shadow navik-mega-menu">

         <div class="container">

            <!-- Navik header -->

            <div class="navik-header-container">

               <!--Logo-->

           

               <!-- Burger menu -->

               <div class="burger-menu">

                  <div class="line-menu line-half first-line"></div>

                  <div class="line-menu"></div>

                  <div class="line-menu line-half last-line"></div>

               </div>

               <!--Navigation menu-->

               <nav class="navik-menu menu-caret submenu-top-border">

                  <ul>

                   <li class="submenu-right"><a href="<?php echo $this->config->base_url();?>index.php/homepage">Home</a>

                     </li>

                     

                     <li class="mega-menu">

                        <a href="<?php echo $this->config->base_url();?>index.php/home">All Jobs</a>

                        <ul>

                           <li>

                              <!-- Mega menu container -->

                              <div class="mega-menu-container">

                                 <div class="row">

                                    <!-- Column -->

                                    <?php if(is_array($industry_menu) && count($industry_menu)>0){?>

                                    <?php $counter=0;?>

                                                                       

                                    <?php foreach($industry_menu as $key => $ind){ $counter+=1;

									 ?>

                                    <div class="col-md-6 col-lg-4"> 

                                       <div class="mega-menu-box">

                                          <h4 class="mega-menu-heading"><a href="<?php echo $this->config->base_url();?>index.php/home?func_id=<?php echo $ind['func_id'];?>"><?php echo $ind['func_area'];?><?php echo ($counter%2);?></a></h4>

                                          <ul class="mega-menu-list">

                                          

                                           <?php foreach($ind['desig_list'] as $key1 => $func){?>

                                           

                                             <li>

                                                <a href="<?php echo $this->config->base_url();?>index.php/home?desig_id=<?php echo $func['desig_id'];?>"><?php echo $func['desig_name'];?></a>

                                             </li>

                                            <?php } ?>

                                            

                                          </ul>

                                       </div>

                                        </div>

                                        <?php } ?>

                                     

                                    <?php } ?>

                                    <!-- Column -->

                                    

                                    

                                    <!-- Column -->

                                 </div>

                              </div>

                           </li>



                        </ul>

                     </li>

                     <li class="submenu-left">

                        <a href="#">Candidate Services</a>

                        <ul>

							 <li><a href="<?php echo $this->config->base_url();?>index.php/cvwriting">Professional CV Writing</a></li>                           <li><a href="<?php echo $this->config->base_url();?>index.php/counselling">Career Counselling</a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/interviewtraining">Job Search & Interview Training</a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/jobsearch"> Job Search Assistance </a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/socialmedia">Social Media Presence</a></li>	                           <li><a href="<?php echo $this->config->base_url();?>index.php/jobalerts">Job Alerts</a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/cvhighlight">CV Highlight / Featured Profile</a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/cvdistribution">CV Distribution    </a></li>

                           <li class="dropdown"><a href="<?php echo $this->config->base_url();?>index.php/webinar">Webinar ( Interview Training )</a></li>

                                                      

                        </ul>

                     </li>

                     

                      <li class="submenu-left">

                        <a href="#">Employer Services</a>

                        <ul>

							<li><a href="<?php echo $this->config->base_url();?>index.php/jobposting">Job Posting </a></li>

                            <li><a href="<?php echo $this->config->base_url();?>index.php/cvsearch">CV Search</a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/rsoftware">Recruitment Software</a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/ebranding"> Employer Branding</a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/erecruitment">End to End Recruitment </a></li>	                           <li><a href="<?php echo $this->config->base_url();?>index.php/rpo">RPO</a></li>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/emptraining">Training & Induction </a></li>

                                                      

                        </ul>

                     </li>

                     

                     <li><a href="<?php echo $this->config->base_url();?>index.php/learning">Learning</a>

                     

                                          

                      <ul>

							<li><a href="<?php echo $this->config->base_url();?>index.php/learningcand">Candidates </a></li>

                            <li><a href="<?php echo $this->config->base_url();?>index.php/learningemp">Employers</a></li>

                        </ul>

                     

                     </li>

                     <li class="submenu-left">

                        <a href="<?php echo $this->config->base_url();?>index.php/signup">Registration</a>

                        <ul>

                           <li><a href="<?php echo $this->config->base_url();?>index.php/signup">Candidate Registration </a></li>

                           <li><a href="<?php echo $this->config->base_url();?>/employer/signup">Employer Registration</a></li>

                        </ul>

                     </li>

                     <li class="submenu-right"><a href="<?php echo $this->config->base_url();?>index.php/contact">Contact Us</a>

                     </li>

                  </ul>

               </nav>

        

            </div>

         </div>

      </div>

      <!-- Content ---->

	<!-- Content -->

<div class="intro-banner searchresult " style="background: url(<?php echo base_url('img/home-background-01.jpg');?>);">

    <div class="container"> 

      <div class="row">

        <div class="col-md-12">

          <div class="utf-banner-headline-text-part">

            <h3>Logistics & Supply Chain Jobs & Careers in the UAE</h3>

            

          </div>

        </div>

      </div>

        

        

                <form action="<?php echo $this->config->base_url();?>index.php/home" method="get" novalidate>

            <div class="row">

                <div class="col-lg-12 flx-just">

                    <div class="search-withbtn">

                  

                        <div class="Search-bx">

                            <input name="search_text" type="text" value="<?php echo $search_text;?>" class="form-control search-slt" placeholder="Enter Keyword">

                        </div>

                             <div class="drop-section">

                 <div class="dropdown">

  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown"><span class="dropdown-text"> Select Work Type</span>

  <span class="caret"></span></button>

  <ul class="dropdown-menu">

  

    <li class="divider"></li>

    <li>

    <a class="option-link" href="<?php echo $this->config->base_url();?>index.php/home">

    <label>

    <input name="options[]" type="checkbox" class="option justone" value="1"/> Full Time

    </label>

    </a>

    </li>

    

    <li>

    <a href="<?php echo $this->config->base_url();?>index.php/home"><label>

    	<input name="options[]" type="checkbox" class="option justone" value="2"/> Part Time

        </label>

    </a>

    </li>

    

    <li>

	    <a href="<?php echo $this->config->base_url();?>index.php/home">

        <label>

            <input name="options[]" type="checkbox" class="option justone" value="3"/> Per Hour

        </label>

    </a>

    </li>

    

  </ul>

  

</div>

                        </div>

                        <div class="btns-search">

                            <button type="submit" class="btn btn-danger wrn-btn">Search</button>

                        </div>

                    </div>

                </div>

            </div>

        </form>

        



    </div>

    

    

</div>