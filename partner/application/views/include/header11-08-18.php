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

<title><?php echo $this->config->item('powered_by')?> ||  <?php echo $this->config->item('powered_by_phone')?> || <?php echo $this->config->item('powered_by_email')?></title>
</head>
<body>
<div id="page">
<!--top-section-->
<div class="top">
<div class="logo-wrap">
<span class="logo"><img src="<?php echo base_url('assets/images/logo.png');?>"></span>
</div>
<div class="toggle-top"><span><img src="<?php echo base_url('assets/images/toggle-hover.png');?>"/></span><span><img src="<?php echo base_url('assets/images/toggle-active.png');?>"/></span></div>
<div class="top-right-section">
<span><a href="<?php echo $this->config->site_url();?>/home">Home</a></span>
<span><a href="<?php echo $this->config->site_url();?>/changepass">Change Password</a></span>
<span><a href="<?php echo $this->config->site_url();?>/myprofile">My Profile</a></span>
<span><a href="<?php echo $this->config->site_url();?>/scratchpad">Scratch Pad</a></span>
<span><a href="<?php echo $this->config->site_url();?>/logout">Logout</a></span>

<span><?php if($_SESSION['admin_prof_img_url']!='' && file_exists('uploads/adminprofile/'.$_SESSION['admin_prof_img_url'])){?><img src="<?php echo base_url();?>uploads/adminprofile/<?php echo $_SESSION['admin_prof_img_url'];?>" width="31"><?php } ?><a href="#"><?php echo $_SESSION['firstname'].''.$_SESSION['lastname'];?></a></span>
</div>
<div style="clear:both;"></div>
</div>
<!--top-section-->

<!--nav-section-->
<header>
<div class="toggle"><span><img src="<?php echo base_url('assets/images/toggle-active.png');?>"/></span><span><img src="<?php echo base_url('assets/images/toggle-hover.png');?>"/></span></div>
<nav class="main-page home-page-center">

<ul>
<?php
              foreach($_SESSION['menu_list_vendor'] as $result)
			  { 
             ?>
                      		<li>
                                <a href="<?php echo $this->config->site_url().'/'.$result["url"];?>">
                                    <img src="<?php echo base_url('assets/images/icon-1.png');?>"/><br>
                                    <?php echo $result["name"];?>
                                </a> 
                           
                             <?php  if(is_array($result["sub"]) && count($result["sub"])>0){	 ?>   
                               <ul class="nav-second right_side">
										 <?php
                                          foreach($result["sub"] as $item)
                                          { 
                                         ?>
                                        <li><a href="<?php echo $this->config->site_url().'/'.$item["url"];?>"><?php echo $item["name"];?></a></li>  
					                 <?php } ?>                               
		                        </ul>
        					<?php } ?>   
                             </li>                  
                      
             <?php } ?>
</ul>    
   
</nav>
<div style="clear:both;"></div>
</header>
