<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<link rel="shortcut icon" href="images/fav.ico">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/device.css');?>" rel="stylesheet" type="text/css">
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<title><?php echo $this->config->item('logo_url');?></title>
</head>
<body>
<div id="page">
<!--top-section-->
<div class="top">
<div class="logo-wrap">
<span class="logo"><img width="459px;" height="86px;" src="<?php echo base_url('assets/images/logo.jpeg');?>"></span>
</div>
<div class="toggle-top"><span><img src="<?php echo base_url('assets/images/toggle-hover.png');?>"/></span><span><img src="<?php echo base_url('assets/images/toggle-active.png');?>"/></span></div>
<div class="top-right-section">
<span><a href="<?php echo $this->config->site_url();?>/home">Home - All Jobs</a></span>

<span><a href="<?php echo $this->config->site_url();?>/notifications">My Messages</a></span>
<span><a href="<?php echo $this->config->site_url();?>/changepass">Change Password</a></span>
<span><a href="<?php echo $this->config->site_url();?>/logout">Logout</a></span>

<span><?php echo $_SESSION['candidate_first_name'];?></span>


</div>
<div style="clear:both;"></div>
</div>
<!--top-section-->

<!--nav-section-->
<header>
<div class="toggle"><span><img src="<?php echo base_url('assets/images/toggle-active.png');?>"/></span><span><img src="<?php echo base_url('assets/images/toggle-hover.png');?>"/></span></div>
<nav class="main-page home-page-center">
<ul>

<li><a href="<?php echo $this->config->site_url();?>/home"><span><img src="<?php echo base_url('assets/images/icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/icon-hover-1.png');?>"></span>View All Jobs</a></li>

<li><a href="<?php echo $this->config->site_url();?>/candidates_all/summary"><span><img src="<?php echo base_url('assets/images/icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/icon-hover-1.png');?>"></span>My Profile</a></li>

<li><a href="<?php echo $this->config->site_url();?>/interviews/"><span><img src="<?php echo base_url('assets/images/icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/icon-hover-2.png');?>"></span>All Interviews</a></li>
<!-- 
<li><a href="<?php echo $this->config->site_url();?>/notifications"><span><img src="<?php echo base_url('assets/images/icon-7.png');?>"></span><span><img src="<?php echo base_url('assets/images/icon-hover-7.png');?>"></span>My Messages</a></li>
-->
<li><a href="<?php echo $this->config->site_url();?>/changepass"><span><img src="<?php echo base_url('assets/images/icon-7.png');?>"></span><span><img src="<?php echo base_url('assets/images/icon-hover-7.png');?>"></span>Change Password</a></li>

</nav>
<div style="clear:both;"></div>
</header>
