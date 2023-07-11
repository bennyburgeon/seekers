<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo $page_title;?></title>

<meta property="fb:app_id" content="1319993951390227" />
<meta property="og:site_name" content="<?php echo $og_site_name;?>" />
<meta property="og:title" content="<?php echo $og_title;?>" />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?php echo $og_url;?>" />
<meta property="og:image" content="<?php echo $og_image;?>" />
<meta property="og:locale" content="en_US" />

<link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url('js/jquery.min.js');?>"></script>
<script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>

<script language="JavaScript" type="text/javascript">
  $(document).ready(function(){
    $('.carousel').carousel({
      interval: 3000
    })
  });    
</script>
<link href="<?php echo base_url('css/styles.css');?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('font-awesome-4.7.0/css/font-awesome.css');?>" rel="stylesheet" type="text/css" />
  
  
  

<!-- Date Picker start --> 
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#date_of_birth" ).datepicker({
		yearRange: "c-100:c",
		dateFormat: "dd-mm-yy",
		maxDate: null,
      changeMonth: true,
      changeYear: true
    });
  } );
  </script>
 <!-- Date Picker end --> 
 
 
</head>

<body>


 

<!--header section-->
<header>
  <div class="container-fluid top">
    <div class="row">
      <a href="http://www.seekersgulf.com">  
			<div class="col-sm-4 logo"></div>  
	  </a>
      <div class="col-sm-5"></div>
      <div class="col-sm-7 ">
        <ul class="nav navbar-nav">
          <li class="active bold"><a href="<?php echo $this->config->base_url();?>index.php/home">All Jobs</a></li>
        </ul>
        
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
          <button type="button" onclick="window.location='<?php echo $this->config->base_url();?>index.php/login';" class="btn btn-default bold">Login</button>
          <button type="button" onclick="window.location='<?php echo $this->config->base_url();?>index.php/signup';"  class="btn btn-danger bold">Register</button>
        </div>
       <?php } ?>
       
      </div>
    </div>
  </div>

</header>

<!--header ends--> 

<!--search bar-->



<!--search bar ends--> 

<!--search results--> 

