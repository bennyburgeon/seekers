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

<div class="top">
  <div class="logo-wrap"> <span class="logo"><img src="<?php echo base_url('assets/images/logo.png');?>"></span> </div>
  <div class="toggle-top"><span><img src="<?php echo base_url('assets/images/toggle-hover.png');?>"/></span><span><img src="<?php echo base_url('assets/images/toggle-active.png');?>"/></span></div>
  <div class="top-right-section"><span><a style="font-weight: 600; font-size: 15px;" href="<?php echo $this->config->site_url();?>/app_list_logout">Logout</a></span> </div>
  <div style="clear:both;"></div>
</div>
</div>

