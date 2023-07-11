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

<title>CRM for Recruitment</title>


<style>

@media print {
  .hidden-print {
    display: none !important;
  }
  body {
      font-size: 14px;
      line-height: normal;
  }
}
    .srevHd {
        color: #000;
        background: #d8d8d8;
        padding: 10px;
    }
    .specs td {
        padding: 3px 0;
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

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">

<div>
    
 </div>

 <table width="100%" border="0">
    <tr>
        <td>Company Logo</td>
        <td align="right">Sed ut perspiciatis unde<br>omnis iste natus error sit voluptatem<br>accusantium doloremque<br>+91 987658965</td>
    </tr>
 </table>

  <div id ="step2" style="margin-top: 10px;">
    <div class="specs hor">
        
        <form class="form-horizontal form-bordered"  method="post" id="candidate_form1" name="candidate_form1" > 
        
			<?php echo form_hidden('candidateId', $candidate_id);?>
            <h3 class="srevHd">Personal Details</h3>
            
            <table align="left" width="70%" border="0">
            
                <tr>
                <td width="260">First Name</td>
                <td width="300"><?php echo $personal['first_name'];?></td>
                </tr>
                
                <tr>
                <td>Last Name</td>
                <td><?php echo $personal['last_name'];?></td>
                </tr>
                
                <tr>
                <td>Email</td>
                <td><?php echo $personal['username'];?></td>
                </tr>
                
                <tr>
                <td>Gender</td>
                <td><?php if($personal['gender']==1 )echo 'Male' ; else if($personal['gender']==0 ) echo 'Female';?></td>
                </tr>
                
                <tr>
                <td>Marital Status</td>
                <td><?php if($personal['marital_status']==1 )echo 'Married' ; else if($personal['marital_status']==0 ) echo 'Never Married';?></td>
                </tr>
                
                <tr>
                <td>DoB</td>
                <td><?php echo $personal['date_of_birth'];?></td>
                </tr>
                
                <tr>
                <td>Mobile</td>
                <td><?php echo $personal['mobile'];?></td>
                </tr>  
            </table>
        
        
        <div style="clear:both;"></div>
    </div>
</div>

<!--START CONTACT DETAILS-->
<?php if(!empty($address)){?>
<div id ="step2">
    <div class="specs hor">
    
      <h3 class="srevHd">Address</h3>
        <table align="left" width="70%" border="0">
        
            <tr>
            <td  width="260">Nationality</td>
            <td width="300"><?php if(!empty($address)) echo $address['country_name'];?></td>
            </tr>
            
            <tr>
            <td>State</td>
            <td><?php if(!empty($address)) echo $address['state_name'];?></td>
            </tr>
            
            <tr>
            <td>City</td>
            <td><?php if(!empty($address)) echo $address['city_name'];?></td>
            </tr>
            
            <tr>
            <td>Current Location</td>
            <td><?php if(!empty($address)) echo $address['location_name'];?></td>
            </tr>
            
            <tr>
            <td>Contact Address</td>
            <td><?php if(!empty($address)) echo $address['address'];?></td>
            </tr>
            
            <tr>
            <td>Landphone</td>
            <td><?php if(!empty($address)) echo $address['land_prefix'].$address['land_phone'];?></td>
            </tr>
            
            <tr>
            <td>WorkPhone</td>
            <td><?php if(!empty($address)) echo $address['work_prefix'].$address['workphone'];?></td>
            </tr>
            
             <tr>
            <td>Fax</td>
            <td><?php  if(!empty($address))echo $address['fax_prefix'].$address['fax'];?></td>
            </tr>
            
             <tr>
            <td>Zip code</td>
            <td><?php if(!empty($address)) echo $address['zipcode'];?></td>
            </tr>
      </table>
    
    <div style="clear:both;"></div>
    </div>
</div>
<?php }?>
<!--END CONTACT DETAILS-->

<!--START PASSPORT DETAILS-->

<?php if(!empty($education)){?>
<div id ="step2">
<div class="specs hor">  
    <h3 class="srevHd">Education</h3>
     <div>
		
        <?php foreach($education as $item){
			$i=0;?>
       
    	<table align="left" width="70%" border="0">
            <tr >
            <td width="260">Level Name</td>
            <td width="300"><?php echo $item['level_name'];?></td>
            </tr>
            
            <tr>
            <td>Course Name</td>
            <td><?php echo $item['course_name'];?></td>
            </tr>
            
            <tr>
            <td>Specialized in</td>
            <td><?php echo $item['spcl_name'];?></td>
            </tr>
            
            <tr>
            <td>University</td>
            <td><?php echo $item['univ_name'];?></td>
            </tr>
            
            <tr>
            <td>Type</td>
            <td><?php echo $item['course_type'];?></td>
            </tr>
            
            <tr>
            <td>Year</td>
            <td><?php echo $item['edu_year'];?></td>
            </tr>
            
        </table>
        
        <?php $i++; if($i/2!=0) { ?> </br> <?php } ?> 
      
    	<?php   } ?>
	</div>    
  
	<div style="clear:both;"></div>
</div>

<?php   } ?>



<!--END PASSPORT DETAILS-->

<!--START PASSPORT DETAILS-->
<?php if(!empty($job_details)){?>

<div id ="step2">
	<div class="specs hor">
    
   	 <h3 class="srevHd">Job History</h3>
     <div>
  	
        <?php foreach($job_details as $item){ $i=0;?>
  
           <table align="left" width="70%" border="0">
                <tr>
                <td width="260">Organization</td>
                <td width="300"><?php echo $item['organization'];?></td>
                </tr>
                
                <tr>
                <td>Designation</td>
                <td><?php echo $item['designation'];?></td>
                </tr>
                
                <tr>
                <td>Responsiblity</td>
                <td><?php echo $item['responsibility'];?></td>
                </tr>
                
                <tr>
                <td>From Date</td>
                <td><?php echo $item['from_date'];?></td>
                </tr>
                
                <tr>
                <td>To Date</td>
                <td><?php echo $item['to_date'];?></td>
                </tr>
                
                <tr>
                <td>Salary/Month</td>
                <td><?php echo $item['monthly_salary'];?></td>
                </tr>
            
            </table>
            <?php $i++; if($i/2!=0) { ?> </br> <?php } ?> 
      
    	<?php   } ?>
    
 		</div>
	 
		<div style="clear:both;"></div>
	</div>
</div>
<?php }?>
<!--END CERTIFICATIOn DETAILS-->

<!--BEGIN EDUCATION DETAILS -->

<?php if(!empty($language_skills)){?> 
<div id ="step3" >
    <div class="specs hor">
      
    
        <h3 class="srevHd">Language Skills</h3>
        
			<?php if(is_array($language_skills)){?>
            <table align="left" width="70%" border="0">
                <tr>
                <td colspan="2">Language Skill</td>
                </tr>
                
                <?php foreach($language_skills as $item){?>
                <tr>
                <td colspan="2"><?php echo $item['lang_name'];?></td>
                </tr>
                <?php } ?>
            </table>
            <?php } ?>    
    		
    	<div style="clear:both;"></div>
    </div>
</div>
<?php }?>
<!--END EDUCATION DETAILS-->



<!--BEGIN JOB DEATILS-->
<?php if(!empty($tech_skills)){?>
    
<div id ="step2" >
	<div class="specs hor">
	
        <h3 class="srevHd">Tech Skills</h3>
        <?php if(is_array($tech_skills)){?>
            <table align="left" width="70%" border="0">
                <tr>
                <td colspan="2">Skill Name</td>
                </tr>
                
                
                <?php foreach($tech_skills as $item){?>
                <tr>
                <td colspan="2"><?php echo $item['skill_name'];?></td>
                </tr>
                <?php } ?>
            </table>
        <?php } ?>
  
		<div style="clear:both;"></div>
	</div>
</div>
<?php }?>
<!--END Skill DEATILS-->

<?php if(!empty($certification)){?>
        
<div id ="step4" >

	<div class="specs hor">
     
            <h3 class="srevHd">Certification</h3>
            <?php if(is_array($certification)){?>
            <table align="left" width="70%" border="0">
                <tr>
                <td colspan="2">Cert Name</td>
                </tr>
                
                <?php foreach($certification as $item){?>
                <tr>
                <td colspan="2"><?php echo $item['cert_name'];?></td>
                </tr>
                <?php } ?>
            </table>
            <?php } ?>
        
		<div style="clear:both;"></div>
	</div>
</div>
 <?php }?>   
           

<!--END Certification DEATILS-->

<?php if(!empty($domain)){?>
<div id ="step4" >

	<div class="specs hor">       
        
            <h3 class="srevHd">Industry</h3>
            <?php if(is_array($domain)){?>
                <table align="left" width="70%" border="0">
                    <tr>
                    <td colspan="2">Domain Name</td>
                    </tr>
                    
                    <?php foreach($domain as $item){?>
                    <tr>
                    <td colspan="2"><?php echo $item['domain_name'];?></td>
                    </tr>
                <?php } ?>
            </table>
            <?php } ?>
       
            
		<div style="clear:both;"></div>
	</div>
</div>
 <?php }?>    

<!--END industry DEATILS-->

<?php if(!empty($sports)){?>
<div id ="step4" >
	<div class="specs hor">
 
     
        <h3 class="srevHd">Sports & Games</h3>
        <?php if(is_array($sports)){?>
        
            <table align="left" width="40%" border="1">
                <tr>
                <td colspan="2">Sport Details</td>
                </tr>
                
                <?php foreach($sports as $item){?>
                <tr>
                <td colspan="2"><?php echo $item['sport_details'];?></td>        
                </tr>        
                <?php } ?>
            </table>
            
            <?php } ?>
            
   
	<div style="clear:both;"></div>
	</div>
</div>
<?php }?>
<!--END Sports N Games DEATILS-->

<?php if(!empty($social)){?>

<div id ="step4" >
<div class="specs hor">

    <h3 class="srevHd">Social</h3>
        <?php if(is_array($social)){?>
        
        <table align="left" width="40%" border="1">
            <tr>
            <td>Title</td>
            <td>Link</td>
            </tr>
            <?php foreach($social as $item){?>
            
            <tr>
            <td><?php echo $item['social_title'];?></td>
            <td><?php echo $item['social_link'];?></td>
            </tr>
            <?php } ?>
        </table>
        
        
        <?php } ?>
   

<div style="clear:both;"></div>
</div>
</div>
<?php }?>
<!--END Social DEATILS-->
<br/>

<div id ="step4" >

 
        <table align="center">
            <tr>
                <td >    
              <button onClick="myFunction()" class="attach-subs hidden-print">PRINT</button> 
            </td>
            </tr>
        </table>
</form>
<div style="clear:both;"></div>
</div>



</div>
</div>
</div>
</section>

    
</div><!--bodywrapper-->
<!--<style> .bigdrop {
    width: 600px !important;
}</style>-->

<script>

function myFunction() {
     window.print();
}

</script>
