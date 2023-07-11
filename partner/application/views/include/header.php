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
<title><?php echo $this->config->item('powered_by')?>||<?php echo $this->config->item('powered_by_phone')?>||<?php echo $this->config->item('powered_by_email')?></title>
</head>

<body>
<div id="page">

<!--top-section-->

<div class="top">
  <div class="logo-wrap"> <span class="logo"><img src="<?php echo base_url('assets/images/logo.png');?>"></span> </div>
  <div class="toggle-top"><span><img src="<?php echo base_url('assets/images/toggle-hover.png');?>"/></span><span><img src="<?php echo base_url('assets/images/toggle-active.png');?>"/></span></div>
  <div class="top-right-section"> <span><a href="<?php echo $this->config->site_url();?>home">Home</a></span> <span><a href="<?php echo $this->config->site_url();?>changepass">Change Password</a></span> <span><a href="<?php echo $this->config->site_url();?>myprofile">My Profile</a></span> 
    
    <!-- <span><a href="<?php //echo $this->config->site_url();?>notifications">My Messages</a></span> 

      <span><a href="<?php //echo $this->config->site_url();?>scratchpad">Scratch Pad</a></span>--> 
    
    <span><a href="<?php echo $this->config->site_url();?>logout">Logout</a></span> <span> 
    
    <!-- <?php //if($_SESSION['admin_prof_img_url']!='' && file_exists('uploads/adminprofile/'.$_SESSION['admin_prof_img_url'])){?>

    <img src="<?php //echo base_url();?>uploads/adminprofile/<?php //echo $_SESSION['admin_prof_img_url'];?>" width="31">

    <?php //} ?>--> 
    
    <a href="#"><?php echo $_SESSION['vendor_firstname'].''.$_SESSION['vendor_lastname'];?></a></span> </div>
  <div style="clear:both;"></div>
</div>

<!--top-section--> 

<!--nav-section-->

<header>
  <div class="toggle"><span><img src="<?php echo base_url('assets/images/toggle-active.png');?>"/></span><span><img src="<?php echo base_url('assets/images/toggle-hover.png');?>"/></span></div>
  <nav class="main-page home-page-center">
    <ul>
      <li> <a href="<?php echo $this->config->site_url().'candidates_own';?>"> <img src="<?php echo base_url('assets/images/icon-1.png');?>"><br>
        My Candidates </a> </li>
        
      <li> <a href="<?php echo $this->config->site_url().'my_jobs';?>"> <img src="<?php echo base_url('assets/images/icon-1.png');?>"><br>
        My Jobs </a> </li>
        
        <ul>
        <li>
        
        <a href="#"> <img src="<?php echo base_url('assets/images/icon-1.png');?>"><br>
        Report </a>
        
        <ul class="nav-second right_side">
          <li><a href="<?php echo $this->config->site_url().'vendor_summary';?>"> Activity Report </a></li>
          <li><a href="<?php echo $this->config->site_url().'jobs_report';?>">Job Process Report </a></li>
          <li><a href="<?php echo $this->config->site_url().'candidates_summary';?>">Candidates Summary </a></li>
         <li><a href="<?php echo $this->config->site_url().'vconversion';?>">Conversion Summary </a></li>
        </ul>
         </li>
        </ul>
    </ul>
  </nav>
  
  
  <div style="clear:both;"></div>
</header>
