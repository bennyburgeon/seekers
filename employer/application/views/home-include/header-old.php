<!DOCTYPE html>
<html dir="ltr" lang="en-US">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

	<title>
		<?php echo $page_title;?>
	</title>

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
		$( document ).ready( function () {
			$( '.carousel' ).carousel( {
				interval: 3000
			} )
		} );
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

						<li><a href="<?php echo $this->config->base_url();?>index.php/signup">Employer Login</a>
						</li>
						<li><a href="<?php echo $this->config->base_url();?>index.php/login">Employee Login</a>

						</li>
					</ul>
				</div>
				<!-- .top-links end -->

			</div>
			<div class="col_half fright col_last nobottommargin">

				<!-- Top Social
					============================================= -->
				<div id="top-social">
					<ul>
						<li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span><span class="ts-text">Facebook</span></a>
						</li>
						<li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span><span class="ts-text">Twitter</span></a>
						</li>
						<li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span><span class="ts-text">Instagram</span></a>
						</li>
						<li><a href="#" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+91 9446218338</span></a>
						</li>
						<li><a href="mailto:info@bellhospitalities.com" class="si-email3"><span class="ts-icon"><i class="icon-email3"></i></span><span class="ts-text">info@bellhospitalities.com</span></a>
						</li>
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
			<div id="logo"> <a href="<?php echo $this->config->base_url();?>index.php/home" class="standard-logo" data-dark-logo="<?php echo $this->config->base_url();?>images/logo-dark.png"><img src="<?php echo $this->config->base_url();?>images/logo.png" alt="Canvas Logo"></a> <a href="#" class="retina-logo" data-dark-logo="<?php echo $this->config->base_url();?>images/logo-dark@2x.png"><img src="<?php echo $this->config->base_url();?>images/logo@2x.png" alt="Canvas Logo"></a> </div>
			<!-- #logo end -->

			<ul class="header-extras">
				<li> <i class="i-plain icon-email3 nomargin"></i>
					<div class="he-text"> Drop an Email <span>info@bellhospitalities.com</span> </div>
				</li>
				<li> <i class="i-plain icon-call nomargin"></i>
					<div class="he-text"> Get in Touch <span>+91 9446218338</span> </div>
				</li>
			</ul>
		</div>
		<div id="header-wrap">


			<!-- Primary Navigation
				============================================= -->
			<nav id="primary-menu" class="style-2">
				<div class="container clearfix">
					<div id="primary-menu-trigger"><i class="icon-reorder"></i>
					</div>
					<ul>

						<li class="current">
							<a href="<?php echo $this->config->base_url();?>index.php/home">
								<div>Home</div>
							</a>
						</li>
						<li>
							<a href="http://hospitalitymanpower.com/page/aboutus.php">
								<div>About Us</div>
							</a>
						</li>
						<li>
							<a href="http://hospitalitymanpower.com/page/service+hospitality+manpower.php">
								<div>Services</div>
							</a>
						</li>
						<li>
							<a href="http://hospitalitymanpower.com/page/department.php">
								<div>Job Opening</div>
							</a>
						</li>
						<li>
							<a href="http://hospitalitymanpower.com/page/careers.php">
								<div>Careers</div>
							</a>
						</li>

						<li>
							<a href="http://hospitalitymanpower.com/page/contact+hospitality+manpower.php">
								<div>Contact Us</div>
							</a>
						</li>

					</ul>
					<!-- Top Search
						============================================= -->
					<div id="top-search">
						<a href="#" id="top-search-trigger"><i class="icon-search3"></i><i class="icon-line-cross"></i></a>
						<form action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Search: Type &amp; Hit Enter..">
						</form>
					</div>
					<!-- #top-search end -->
				</div>

			</nav>
			<!-- #primary-menu end -->

		</div>
	</header>
	<!-- #header end -->

	<div class="container-fluid top">
		<div class="row">

			<?php 
		
		if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
		{
		?>
			<div class="btn-group">
				<button type="button" onclick="window.location='<?php echo $this->config->base_url();?>index.php/candidates_all/summary';" class="btn btn-default bold">My Profile</button>

				<button type="button" onclick="window.location='<?php echo $this->config->base_url();?>index.php/logout';" class="btn btn-danger bold">Logout</button>

			</div>
			<?php 
		
		}
		?>


		</div>

	</div>

	<!--header ends-->