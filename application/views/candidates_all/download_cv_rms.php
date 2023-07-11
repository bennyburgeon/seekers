

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
  <td><img style="width: 500%;" src="<?php echo base_url().'/images/logo-seekers.png' ?>" /></td>
    
  <tr> </tr>
    </tr>
  
</table>
<br />
<div id ="step2" style="margin-top: 10px;">
  <div class="specs hor">
         

         
		<?php echo form_hidden('candidate_id', $candidate_id);?>
        <?php echo form_hidden('short_id', $short_id);?>
		<?php echo form_hidden('job_app_id', $job_app_id);?>
      
      <div class="container">
      <table width="100%" border="0">
        <tbody>
          <tr>
<td>
<h3 class="name"><?php echo $personal['first_name'];?> &nbsp;<?php echo $personal['last_name'];?></h3>
       <h4><?php echo $job_details['job_title'];?></h4>
        
</td>
<td align="right">
<?php if(file_exists($this->config->item('photo_physical_url').$personal['photo']) && $personal['photo']!=''){?>
		
    <img class="picbox pull-right" src="<?php echo $this->config->item('photo_url').$personal['photo']; ?>" width="130" height="156" alt=""/>
    
    <?php }else{ ?>
    <img class="picbox pull-right" src="<?php echo base_url().'/rms/uploads/no_photo.png' ?>" width="130" height="156" alt=""/>
    
    <?php } ?>
</td>
          </tr>
        </tbody>
      </table>
      <div class="line"></div>
      </div>
    
  </div>
</div>
<div class="container">
  <table width="100%" border="0">
    <tbody>
      <tr>
        <td width="24%"  class="label_values" ><strong>Age &amp; Date of Birth</strong></td>
        <td width="22%"><?php echo $personal['age'];?>&nbsp;Years | <?php echo date("d, M Y", strtotime($personal['date_of_birth']));?></td>
        <td width="15%" class="label_values" >Current Salary</td>
        <td width="14%"><?php echo  $this->config->item('currency_symbol');?>
        <?php if(isset($job_search['current_ctc'])) echo number_format((float)$job_search['current_ctc'],2);else echo '0.00';?></td>
        
      </tr>
      <tr>
        <td class="label_values" ><strong>Gender</strong></td>
        <td ><?php if($personal['gender']=='1') echo 'Male';else echo 'Female';?></td>
        <td class="label_values">Expected <span class="label_values1">Salary</span></td>
        <td  ><?php echo  $this->config->item('currency_symbol');?>
        <?php if(isset($job_search['expected_ctc'])) echo number_format((float) $job_search['expected_ctc'],2);else echo '0.00';?></td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Nationality</strong></td>
        <td><?php echo $personal['country_name'];?></td>
        <td class="label_values" >Notice Period</td>
        <td><?php if(isset($job_search['notice_period']))echo $job_search['notice_period'];else echo '0';?> Days
</td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Marital Status</strong></td>
        <td><?php if($personal['marital_status']==1)echo 'Married';else echo 'Single';?></td>
        <td class="label_values" >Total Experience</td>
        <td><?php if(isset($job_search['notice_period']))echo $job_search['total_experience'];else echo '0';?> Years
</td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Driving License</strong></td>
        <td><?php if($personal['driving_license']==1) echo 'Yes'; if($personal['driving_license']==0)echo 'No';?></td>
        <td class="label_values" >Current Location</td>
        <td><?php echo $personal['current_location'];?></td>
      </tr>
      
      <tr>
        <td class="label_values" ><strong>Issued Country [License] </strong></td>
        <td><?php if(isset($personal['driving_license_issuance']))echo $personal['driving_license_issuance'];else echo 'NA'?></td>
        <td class="label_values" >VISA Status</td>
        <td><?php if(isset($personal['visa_type']))echo $personal['visa_type'];else echo 'NA'?></td>
      </tr>
      
      <tr>
        <td  class="label_values" ><strong>Languages Known</strong></td>
        <td><?php echo implode(',',$language_skills);?></td>
        <td class="label_values" >Reason for leaving</td>
        <td><?php if(isset($consultant_feedback['reason_to_leave']) && $consultant_feedback['reason_to_leave']!='')echo $consultant_feedback['reason_to_leave'];else echo 'NA';?></td>
      </tr>
    </tbody>
  </table>
</div>

<div class="container">

  <h5>Consultant’s Feedback on Candidate’s Competency</h5>

  <table width="100%" border="0">
    <tbody>

      <tr>
        <td width="25%" class="label_values" ><strong>Education</strong></td>
        <td width="75%"><?php if(isset($consultant_feedback['feedback_education']) && $consultant_feedback['feedback_education']!='') echo $consultant_feedback['feedback_education'];else echo 'NA';?></td>
      </tr>
      
      <tr>
        <td class="label_values" ><strong>Experience</strong></td>
        <td><?php if(isset($consultant_feedback['feedback_industry']) && $consultant_feedback['feedback_industry']!='') echo $consultant_feedback['feedback_industry'];else echo 'NA';?></td>
      </tr>


      <tr>
        <td class="label_values" ><strong>Skills</strong></td>
        <td><?php if(isset($consultant_feedback['feedback_skills']) && $consultant_feedback['feedback_skills']!='') echo $consultant_feedback['feedback_skills'];else echo 'NA';?></td>
      </tr>
      <tr>
        <td class="label_values"><strong>Salary</strong></td>
        <td ><?php if(isset($consultant_feedback['feedback_salary']) && $consultant_feedback['feedback_salary']!='') echo $consultant_feedback['feedback_salary'];else echo 'NA';?></td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Others</strong></td>
        <td><?php if(isset($consultant_feedback['feedback_general']) && $consultant_feedback['feedback_general']!='') echo $consultant_feedback['feedback_general'];else echo 'NA';?></td>
      </tr>
            
    </tbody>
  </table>
</div>
<?php if(!empty($profession)){?>
<div class="container">

 <h5>Professional Experience</h5>

<?php foreach($profession as $item){ $i=0;?>

<table width="100%" border="0" cellpadding="5" cellspacing="5">
    <h4><?php echo $item['designation'];?></h4>
    <tbody>
      <tr>
        <td width="25%" class="label_values" ><strong>Company Name</strong></td>
        <td width="75%">
        <?php 
		if($item['present_job']==1){		 
		?>
        <strong><font color="#12AF00"><?php echo $item['organization'];?></font></strong> &nbsp;&nbsp; &nbsp;&nbsp;(&nbsp;From: <?php echo date("d M Y", strtotime($item['from_date']));?>&nbsp;&nbsp; &nbsp;&nbsp;To: &nbsp;&nbsp;Till Date)
        <?php }else{ ?>
         <strong><font color="#12AF00"><?php echo $item['organization'];?></font></strong> &nbsp;&nbsp; &nbsp;&nbsp;(&nbsp;From: <?php echo date("d M Y", strtotime($item['from_date']));?>&nbsp;&nbsp; &nbsp;&nbsp;To: &nbsp;&nbsp;<?php echo date("d M Y", strtotime($item['to_date']));?>)
        <?php } ?>
        
        </td>
      </tr>
      
      <tr>
        <td class="label_values" ><strong>Location</strong></td>
        <td><font color="#0079D1"><strong><?php if(isset($item['city_name'])&& $item['city_name']!='') echo $item['city_name'];else echo 'NA';?></strong></font></td>
      </tr>
	   
      <tr>
        <td class="label_values" ><strong>Indusry</strong></td>
        <td><?php echo $item['job_cat_name'];?></td>
      </tr>
      <tr>
        <td class="label_values" ><strong>Designation</strong></td>
        <td><font color="#F3002D"><strong><?php echo $item['designation'];?></strong></font></td>
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
        <td align="left" valign="middle" class="label_values" ><strong>Responsibilities</strong></td>
        <td align="left" valign="middle"><?php echo $item['responsibility'];?></td>
      </tr>
    </tbody>
  </table>
<div class="line"></div>
<?php } ?>
  
</div>
<?php } ?>
<?php if(!empty($education)){?>

<div class="container">
  <h5>Education and Professional Certifications</h5>
  <table  border="0">
    <tbody>
      <tr>
        <td class="label_values" >Education Level</td>
        <td class="label_values" >Course</td>
        <td class="label_values" >Specialisation</td>
        <td class="label_values">University</td>
        <td width="15%" class="label_values" >Country</td>
        <td class="label_values">Year</td>
      </tr>
 <?php foreach($education as $item)
 {
			$i=0;
?>


      <tr>
        <td><strong><?php echo $item['level_name'];?></strong></td>
        <td><strong><?php echo $item['course_name'];?></strong></td>
        <td><strong><?php echo $item['spcl_name'];?></strong></td>
        <td><strong><?php echo $item['univ_name'];?></strong></td>
        <td><strong><?php echo $item['country_name'];?></strong></td>
        <td><strong><?php echo $item['edu_year'];?></strong></td>
      </tr>
    
<?php } ?>
    </tbody>
  </table>
  <div class="line"></div>
</div>
<?php } ?>

<?php if(!empty($job_search['feedback_projects'])){?>
<div class="container ">
  <h5> Objectives, Skills, Attributes, Achievements & Projects</h5>
  <?php echo $job_search['feedback_projects']; ?>
</div>
<?php } ?>

<br>


</body>

