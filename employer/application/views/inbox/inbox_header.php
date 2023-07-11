<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.0
Version: 3.2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo $cur_page_name;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url();?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url();?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>
<!-- BEGIN:File Upload Plugin CSS files-->
<link href="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css" rel="stylesheet"/>
<link href="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet"/>
<link href="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css" rel="stylesheet"/>
<!-- END:File Upload Plugin CSS files-->
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url();?>assets/admin/pages/css/inbox.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->


<!-- BEGIN PAGE STYLES -->
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/admin/pages/css/inbox.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="../my-inbox/favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
<!-- BEGIN HEADER -->
<div class="page-header">
	<!-- BEGIN HEADER TOP -->
	<div class="page-header-top">
		<div class="container">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/admin/layout3/img/logo-default3.png" alt="logo" class="logo-default"></a>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler"></a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">

     <!-- new li -->
                    <li class="dropdown hidden-xs"><ul class="newMenu col-md-6">
                    	<li>
								<a href="<?php echo site_url('dashboard');?>">
								Home </a> 
							</li> <li><span class="separator"></span></li>                              
							<li>
								<a href="<?php echo site_url('notifications');?>">
								Announcements </a> 
							</li> <li><span class="separator"></span></li>
							<li><a href="<?php echo site_url('todo');?>">
								My Calendar </a>
							</li>

                         <li><span class="separator"></span></li>
							<li>




								<a href="<?php echo site_url('my_inbox');?>">
								My Inbox <span class="badge badge-danger">
								<?php echo count($emails);?></span>
								</a>
							</li>
                        <li><span class="separator"></span></li>
							<li>



								<a href="<?php echo site_url('mytasks');?>">
								 My Tasks <span class="badge badge-success">
								<?php echo count($tasks);?> </span>
								</a>
							</li> 

							 <li><span class="separator"></span></li>
							 <li>
								<a href="<?php echo site_url('emailsettings');?>">								
								Email Settings </a>
								
							</li>
                            
<li><span class="separator"></span></li>
							<li>
								<a href="<?php echo site_url();?>/logout">
								Log Out </a>
							</li>
						</ul></li>
                    <!-- end new li -->


					
					
					<li class="droddown dropdown-separator">
						<span class="separator"></span>
					</li>
					<!-- BEGIN INBOX DROPDOWN -->
					<li class="dropdown dropdown-extended dropdown-dark dropdown-inbox" id="header_inbox_bar">
						
						<ul class="dropdown-menu">
							<li class="external">
								<h3>You have <strong><?php echo count($messages);?>  New</strong> Messages</h3>
								<a href="<?php echo site_url('my_messages');?>">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
									<?php foreach($messages as $record){?>
                                    <li>
										<a href="inbox.html?a=view">
                                        <?php if($record['admin_prof_img_url']!='' && file_exists('uploads/adminprofile/'.$record['admin_prof_img_url'])){?>
										<span class="photo">
										<img src="<?php echo base_url().'uploads/adminprofile/'.$record['admin_prof_img_url'];?>" class="img-circle" alt="" width="40">
										</span>
                                        <?php } ?>
										<span class="subject">
										<span class="from">
										<?php echo $record['firstname'];?> </span>
										<span class="time">Just Now </span>
										</span>
										<span class="message">
										<?php echo $record['message'];?> </span>
										</a>
									</li>
                                    <?php } ?>
                                    
									
									
								</ul>
							</li>
						</ul>
					</li>
					<!-- END INBOX DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<li class="dropdown dropdown-user dropdown-dark">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<?php if(isset($_SESSION['admin_prof_img_url']) && $_SESSION['admin_prof_img_url']!='' && file_exists('uploads/adminprofile/'.$_SESSION['admin_prof_img_url'])){?>                        
	                        <img alt="" width="40" class="img-circle" src="<?php echo base_url();?>uploads/adminprofile/<?php echo $_SESSION['admin_prof_img_url'];?>">
                        <?php } ?>
						<span class="username username-hide-mobile"><?php echo $_SESSION['company_username'];?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="<?php echo site_url('myprofile');?>">
								<i class="icon-user"></i> My Profile </a>
							</li>
							<li>
								<a href="<?php echo site_url('todo');?>">
								<i class="icon-calendar"></i> My Calendar </a>
							</li>
							<li>
								<a href="<?php echo site_url('my_inbox');?>">
								<i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger">
								<?php echo count($emails);?>  </span>
								</a>
							</li>
							<li>
								<a href="<?php echo site_url('mytasks');?>">
								<i class="icon-rocket"></i> My Tasks <span class="badge badge-success">
								<?php echo count($tasks);?>  </span>
								</a>
							</li>
							                           
							<li class="divider">
							</li>
							<li>
								<a href="<?php echo site_url();?>/logout">
								<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
	</div>
	<!-- END HEADER TOP -->
	<?php echo $menu;?>