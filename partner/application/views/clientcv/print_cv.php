<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<link rel="shortcut icon" href="images/fav.ico">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/device.css');?>" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css');?>">
<title><?php echo $this->config->item('company_name');?>-<?php echo $personal['first_name'];?> &nbsp;<?php echo $personal['last_name'];?></title>
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

.label_values {
	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
	font-size: 15px;
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
.label_values1 {	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
	font-size: 15px;
	color: #2980b9;
	font-weight: bold;
	-webkit-print-color-adjust: exact;
}
.label_values2 {	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
	font-size: 15px;
	color: #2980b9;
	font-weight: bold;
	-webkit-print-color-adjust: exact;
}
.label_values3 {	font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";
	font-size: 15px;
	color: #2980b9;
	font-weight: bold;
	-webkit-print-color-adjust: exact;
}
</style>
</head>
<body>

<form class="form-horizontal form-bordered" action="<?php echo $this->config->site_url();?>/select_applicant/add_feedback" method="post" id="feedback_form" name="feedback_form">

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
    <td><img src="<?php echo base_url(); ?>assets/images/logo.png" /></td>
    <td align="right"><?php echo $this->config->item('company_name');?> <br />
     <?php echo $this->config->item('powered_by_address');?> <br />
       <?php echo $this->config->item('powered_by_phone');?> <br />
      <?php echo $this->config->item('powered_by_email');?> <br />
      <?php echo $this->config->item('powered_by_web');?> </td>
    </tr>
  
</table>
<br />
<div id ="step2" style="margin-top: 10px;">
  <div class="specs hor">
         
      
      <div class="container">
        <h3 class="name"><?php echo $personal['first_name'];?> &nbsp;<?php echo $personal['last_name'];?></h3>
       <h4><?php //echo $job_details['job_title'];?></h4>
        <div class="line"></div>
      </div>
    
  </div>
</div>
<div class="container">
  <table width="100%" border="0">
    <tbody>
      <tr>
        <td width="24%"  class="label_values" ><strong>Age &amp; Date of Birth</strong></td>
        <td width="22%"><?php if($personal['age']>1)echo $personal['age'].' Years';else echo 'Not Updated';?>&nbsp; | <?php if($personal['date_of_birth']!='' && $personal['date_of_birth']!='0000-00-00')echo date("d, M Y", strtotime($personal['date_of_birth']));else echo 'Not Updated';?></td>
        <td width="15%" class="label_values" >Current Salary</td>
        <td width="14%"><?php echo  $this->config->item('currency_symbol');?>
        <?php if(isset($job_search['current_ctc'])) echo number_format((double)$job_search['current_ctc'],2);else echo '0.00';?></td>
        <td width="25%" rowspan="8">
        
        <?php if(file_exists('uploads/photos/'.$personal['photo']) && $personal['photo']!=''){?><span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$personal['photo'];?>" style="width:158px;height:100px;"><br /></span> 
					  
					  <?php }else{ ?> 
                      
                      <img src="<?php echo base_url().'assets/images/no_photo.png';?>">
                       
                      <?php } ?>
                      

        </td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Gender</strong></td>
        <td ><?php if($personal['gender']==1) echo 'Male'; if($personal['gender']==0)echo 'Female';?></td>
        <td class="label_values">Expected <span class="label_values1">Salary</span></td>
        <td  ><?php echo  $this->config->item('currency_symbol');?>
        <?php if(isset($job_search['expected_ctc'])) echo number_format((double)$job_search['expected_ctc'],2);else echo '0.00';?></td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Nationality</strong></td>
        <td><?php echo $personal['nationality_name'];?></td>
        <td class="label_values" >Notice Period</td>
        <td><?php if(isset($job_search['notice_period'])) echo $job_search['notice_period'].' &nbsp;Days';?></td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Marital Status</strong></td>
        <td><?php if($personal['marital_status']==1) echo 'Married'; else echo 'Never Married';?></td>
        <td class="label_values" >Total Experience</td>
        <td><?php if(isset($job_search['notice_period']))echo $job_search['notice_period'];else echo '0';?>&nbsp; Years
</td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Driving License</strong></td>
        <td><?php if($personal['driving_license']==1) echo 'Yes'; if($personal['driving_license']==0)echo 'No';?></td>
        <td class="label_values" >Current Location</td>
        <td><?php echo $personal['current_location_name'];?></td>
      </tr>
      
      <tr>
        <td class="label_values" ><strong>Issued Country [License] </strong></td>
        <td><?php echo $personal['driving_license_country_name'];?></td>
        <td class="label_values" >VISA Status</td>
        <td><?php echo $personal['visa_type'];?></td>
      </tr>
      
      <tr>
        <td  class="label_values" ><strong>Languages Known</strong></td>
        <td><?php echo implode(',',$language_skills);?></td>
        <td class="label_values" >Reason for leaving</td>
        <td><?php if(isset($job_search['reason_to_leave']) && $job_search['reason_to_leave']!='')echo $job_search['reason_to_leave'];else echo 'Not Updated';?></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="container">

  <h5>Consultant’s Feedback on Candidate’s Competency</h5>

  <table width="100%" border="0">
    <tbody>

      <tr>
        <td width="24%"  class="label_values" ><strong>General Feedback</strong></td>
        <td width="76%">
		
		<?php if(isset($feedback['feedback_general'])&& $feedback['feedback_general']!='')echo $feedback['feedback_general'];else echo 'Not Updated';?>
        
        </td>
      </tr>
          
      <tr>
        <td class="label_values" ><strong>Industry Experience</strong></td>
        <td>
		
        <?php if(isset($feedback['feedback_industry'])&& $feedback['feedback_industry']!='')echo $feedback['feedback_industry'];else echo 'Not Updated';?>
        
        
        </td>
      </tr>

      <tr>
        <td class="label_values" ><strong>Education</strong></td>
        <td>
		        <?php if(isset($feedback['feedback_education'])&& $feedback['feedback_education']!='')echo $feedback['feedback_education'];else echo 'Not Updated';?>
        
        </td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Skills</strong></td>
        <td>
		<?php if(isset($feedback['feedback_skills'])&& $feedback['feedback_skills']!='')echo $feedback['feedback_skills'];else echo 'Not Updated';?>
        </td>
      </tr>
      <tr>
        <td class="label_values"><strong>Salary</strong></td>
        <td >
		<?php if(isset($feedback['feedback_salary'])&& $feedback['feedback_salary']!='')echo $feedback['feedback_salary'];else echo 'Not Updated';?>
        
        </td>
      </tr>
            
    </tbody>
  </table>
</div>

<!-- 
<div class="container">

  <h5>Candidates Self Evaluation</h5>

  <table width="100%" border="0">
    <tbody>
      <tr>
        <td><h4>Give a brief description about your exposure in the Marketing and sales or Fashion Industry?</h4></td>
      </tr>
      <tr>
        <td>brief description</td>
      </tr>
    </tbody>
  </table>
  <table width="100%" border="0">
    <tbody>
      <tr>
        <td><h4>What are the main brands you are familiar with / handled?</h4></td>
      </tr>
      <tr>
        <td>brief description</td>
      </tr>
    </tbody>
  </table>
</div>
-->
<?php if(!empty($profession)){?>
<div class="container">

 <h5>Professional Experience</h5>

<?php foreach($profession as $item){ $i=0;?>

<table width="100%" border="0" cellpadding="5" cellspacing="5">
    <h4><?php echo $item['designation'];?></h4>
    <tbody>
      <tr>
        <td width="24%" class="label_values" ><strong>Company Name</strong></td>
        <td width="76%"><strong><?php echo $item['organization'];?></strong> &nbsp;&nbsp; &nbsp;&nbsp;(&nbsp;From: <?php echo $item['from_date'];?>&nbsp;&nbsp; &nbsp;&nbsp;To: &nbsp;&nbsp;<?php echo $item['to_date'];?>)</td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Location</strong></td>
        <td>Dubai, United Arab Emirates</td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Indusry</strong></td>
        <td><?php echo $item['job_cat_name'];?></td>
      </tr>
      <!-- 
      <tr>
        <td class="label_values" ><strong>Functional Area</strong></td>
        <td><?php echo $item['func_area'];?></td>
      </tr>
      -->
      <tr>
        <td colspan="2">&nbsp;</td>
      </tr>      
      <tr>
        <td class="label_values" ><strong>Responsibilities</strong></td>
        <td><?php echo $item['responsibility'];?></td>
      </tr>
    </tbody>
  </table>
<div class="line"></div>
<?php } ?>
  
</div>
<?php } ?>
<?php if(!empty($education)){?>

<div class="container">
  <h5>Education</h5>
  <table width="100%" border="0">
    <tbody>
      <tr>
        <td width="11%" class="label_values" >Education Level</td>
        <td width="19%"  class="label_values" >Course</td>
        <td width="19%"  class="label_values" >Specialisation</td>
        <td width="26%" class="label_values">University</td>
        <td width="15%" class="label_values" >Country</td>
        <td width="10%" class="label_values">Year</td>
      </tr>
 <?php foreach($education as $item)
 {
			$i=0;
?>


      <tr>
        <td><strong><?php echo $item['level_name'];?></strong></td>
        <td><strong><?php echo $item['course_name'];?></strong></td>
        <td><strong>Finance</strong></td>
        <td><strong><?php echo $item['univ_name'];?></strong>&nbsp;</td>
        <td><strong>India</strong></td>
        <td><strong><?php echo $item['edu_year'];?></strong></td>
      </tr>
    
<?php } ?>
    </tbody>
  </table>
  <div class="line"></div>
</div>
<?php } ?>

<?php if(!empty($tech_skills)){?>
<div class="container ">
  <h5>Skills</h5>
  <?php foreach($tech_skills as $item){ echo $item['skill_name'];} ?>
</div>
<?php } ?>
<br>

</form>
</body>

<script>

function myFunction() {
     window.print();
}

</script> 
