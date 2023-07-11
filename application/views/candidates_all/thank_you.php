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
<script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');?>"></script>
<link href="<?php echo base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css');?>" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css');?>">
<title><?php echo $this->config->item('company_name');?>Thank you.</title>
<style>
@media print {
.hidden-print {
	display: none !important;
}
.name {
	color: #2980b9 !important;
	-webkit-print-color-adjust: exact;
}
h5 {
	background-color: #eee !important;
	-webkit-print-color-adjust: exact;
}
.line {
	background-color: #999 !important;
	-webkit-print-color-adjust: exact;
}
.label {
	border: none;
	font-size: 12px;
	color: #fff !important;
	background-color: #337ab7 !important;
	-webkit-print-color-adjust: exact;
}
}
.name {
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
	font-size: 40px;
	color: #2980b9;
	font-weight: bold;
	-webkit-print-color-adjust: exact;
}
.profile {
	width: 150px;
	height: 150px;
}
.line {
	margin-top: 10px;
	margin-bottom: 20px;
	background-color: #eee;
	width: 100%;
	height: 1px;
}
h5 {
	margin-top: 15px;
	padding: 10px;
	font-size: 18px;
	font-weight: bold;
	background-color: #eee !important;
	border: 1px solid #ccc;
	border-radius: 3px;
}
.picbox {
	padding: 5px;
	border: 1px solid #333;
}
.specs td {
	padding: 0px;
}
table, td, tr {
}
</style>
</head>
<body>

<!--top-section-->
<div class="top">
<div class="logo-wrap">
  <div style="clear:both;"></div>
</div>
<!--top-section-->

<section class="bot-sep">
<div class="section-wrap">
<table width="100%" border="0" cellpadding="4" cellspacing="4">
  <tr>
    <td><img src="<?php echo base_url(); ?>images/logo.png" /></td>
    <td align="right"><?php echo $this->config->item('company_name');?> <br />
     <?php echo $this->config->item('powered_by_address');?> <br />
       <?php echo $this->config->item('powered_by_phone');?> <br />
      <?php echo $this->config->item('powered_by_email');?> <br />
      <?php echo $this->config->item('powered_by_web');?> </td>
  <tr> </tr>
    </tr>
  
</table>
<br />
<div id ="step2" style="margin-top: 10px;">
  <div class="specs hor">
         

         
		
    <div class="container">
        <h3 class="name">Thanks for your feedback. We will get back to you soon.</h3>
       <!-- <h4>Division Manager – Food Service</h4>  -->
        <div class="line"></div>
      </div>
    
  </div>
</div>



<br>

</body>

<script>

function myFunction() {
     window.print();
}

</script> 
