
<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>CRM for Recruitment</title>


<meta name="description" content="CRM" />


<meta name="keywords" content="CRM" />

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">



  <link href="<?php echo base_url('css/bootstrap.css');?>" rel="stylesheet">
  
    
	 <link href="<?php echo base_url('css/abe-style.css');?>" rel="stylesheet" type="text/css" />
	

 <link href="<?php echo base_url('css/abe-mobile.css');?>" rel="stylesheet" type="text/css" />
<!-- functions all jquery -->
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

<div class="container">
  <div class="subWrapp banner-01">
    <div class="pageHd">
      <h1>Registration</h1>
    </div>
    <div class="subContent">
<div class="regBlk" id="step12">

			<?php if($this->session->flashdata('msg')){?>
            	<div class="alert alert-success fade in">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                     <?php echo $this->session->flashdata('msg');?>
                </div>
           <?php } ?> 
            <?php if($this->session->flashdata('err_msg')){?>
            	<div class="alert alert-danger fade in">
                    <i class="icon-remove close" data-dismiss="alert"></i>
                     <?php echo $this->session->flashdata('err_msg');?>
                </div>
           <?php } ?>  
           
			    <form id="candidate_form"  class="formular" name="candidate_form" method="post" enctype="multipart/form-data">

  <input type="hidden" id="job_id" name="job_id" value="<?php echo $formdata['job_id']; ?>">
    
    </font></strong>
        
  
  <h2 class="srevHd">Personal Details</h2>
  
  <table class="enqTbl"  border="0" cellspacing="2" cellpadding="2" width="100%">

    <tr>
      <td><span class="style1">
	  
	  
	  
	  Full Name*</span></td>
      <td >:</td>
      <td align="left">
      
      <input type="text" class="txtFeild"  name="first_name" value="<?php echo $formdata['first_name'];?>" id="first_name" placeholder="Enter Full Name">      </td>
    </tr>
    <tr>
      <td height="17" class="style1">e-Mail*</td>
      <td>:</td>
      <td align="left"><label>
      <input class="txtFeild" type="text" name="username" value="<?php echo $formdata['username'];?>" id="username" placeholder="Enter your Email">
      </label></td>
    </tr>
    <tr>
      <td height="17" class="style1">Password</td>
      <td>:</td>
      <td align="left"><label>
      <input class="txtFeild" type="password" name="pass" value="<?php echo $formdata['password'];?>" id="pass" placeholder="Password">
      </label></td>
    </tr>
    <tr>
      <td class="style1">Mobile*</td>
      <td>:</td>
      <td align="left"><label>
      
        <input class="txtFeild" style="width:100px;"  type="text"  name="mobile" maxlength="13" placeholder="Mobile Phone" value="<?php echo $formdata['mobile'];?>" id="mobile">
      [10 digit number]</label></td>
    </tr>
    
    <tr>
      <td class="style1">DoB</td>
      <td>:</td>
      <td align="left"><input type="text" readonly name="date_of_birth" id="datepicker2" value="<?php echo $formdata['date_of_birth'];?>" placeholder="Enter your DoB"></td>
    </tr>

        
	</table>
	
	
	
	 <table class="enqTbl"  border="0" cellspacing="2" cellpadding="2" width="100%">
	
   
	
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>

    </tr>
  </table>

	   
	<h2 class="srevHd">Add Qualification</h2>
 
  
   
<table class="enqTbl">
<tbody>

<tr>
<td style="width:30%">Level of Study*</td>
 <td> <?php echo form_dropdown('level_id',  $edu_level_list, $education['level_id'],'class="form-control" id="level_id"');?> </td>
</tr>
<tr>
<td>Course*</td>
 <td> <?php echo form_dropdown('course_id',  $edu_course_list, $education['course_id'],'class="form-control" id="course_id_edu"');?> </td>
</tr>

<tr>
<td>College</td>
 <td> <?php echo form_dropdown('college_id',  $college_list, '','class="form-control" id="" style="width:70%;"');?> </td>
</tr>

<tr>
<td>Year</td>
 <td> <?php echo form_dropdown('edu_year',  $edu_years_list, $education['edu_year'],'class="form-control" id="edu_year"');?> </td>
</tr>




</tbody>
</table>


   
<!--JOB ADD HTLM BEGIN-->
<h2 class="srevHd">Present/Last Job </h2>

<table class="enqTbl">
<tbody>


<tr>
<td>Organization Name*</td>
<td><input class="form-control hori" type="text" name="organization" value="<?php echo $job['organization'];?>" id="organization"></td>
</tr>
<tr>
<td>Designation</td>
<td><input class="form-control hori " type="text" name="designation" value="<?php echo $job['designation'];?>" id="designation">
</td>
</tr>

<td>From Date</td>
<td>

	<input class="form-control hori " type="text" name="from_date" id="datepickfrom" value="<?php echo $job['from_date'];?>" placeholder="Enter From Date"></td>


</tr>
</tr>
<td>To Date</td>
<td>

	<input class="form-control hori " type="text" name="to_date" id="datepickto" value="<?php echo $job['to_date'];?>" placeholder="Enter To Date"></td>


</tr>

<tr>
<td>Is this your present job ?</td>
 <td> 
      <label class="radio-inline">
      <input type="radio" name="present_job" id="present_job" value="1" <?php if($job['present_job']==1){?> checked <?php } ?> >Yes</label>
    <label class="radio-inline">
<input type="radio" name="present_job" id="present_job" value="0" <?php if($job['present_job']==0){?> checked <?php } ?> >No</label>
                
 </td>
</tr>



</tbody>
</table>


<!--JOB ADD HTML ENDS-->

<!--SKILLS DEATILS BEGIN -->
<h2 class="srevHd">Add Skills</h2>


	
	<select name="parent" id="parent" onChange="myFunction()">
		<option value="">Select your skill type</option>
<?php foreach($parentskill as $ps){
	?>
	<option value="<?php echo $ps['skill_id']; ?>"><?php echo $ps['skill_name']; ?></option>
	<?php
	}?>
</select>


<table class="enqTbl" id="skill_tab" >
<tbody>
	<div id="addg"></div>




<tr>
	<td></td>
	<td>
	</td>
</tr>



</tbody>
</table>



<!--SKILL DETAILS ENDS-->

<!--CERTIFICATION HTML BEGINS-->
<h2 class="srevHd">Add Certification Details</h2>


<table class="enqTbl">
<tbody>



<tr>
<?php 
$i=0;
 foreach($cerifications as $cert)
		 {
		  $i+=1;
 $j=$i%3;
?>

  <td><input type="checkbox" name="cert[]" value="<?php echo $cert['cert_id']; ?>"/></td>

 <td><?php echo $cert['cert_name']; ?></td>
 <?php if($j==0)echo '</tr><tr>';?>
<?php } ?>
</tr>

<tr>
	<td></td>
	<td>
	</td>
</tr>


</tbody>
</table>



<!--CERTIFICATION HTML ENDS-->

<!--DOMAIN HTML BEGINS-->
<h2 class="srevHd">Add Domain Details</h2>


<table class="enqTbl">
<tbody>



<tr>
<?php 
$i=0;
 foreach($domains as $domain)
		 {
		  $i+=1;
 $j=$i%4;
?>

  <td><input type="checkbox" name="domain[]" value="<?php echo $domain['domain_id']; ?>"/>
 <?php echo $domain['domain_name']; ?></td>
 <?php if($j==0)echo '</tr><tr>';?>
<?php } ?>
</tr>

<tr>
	<td></td>
	<td>
	</td>
</tr>


</tbody>
</table>



<!--DOMAIN HTML ENDS-->

<!--LANGUAGE HTML BEGINS-->
<h2 class="srevHd">Language Details</h2>


<table class="enqTbl">
<tbody>



<tr>
<tr>
	<td>Languages Known</td>
	<td><input type="checkbox" name="lang[]"  value="1" />&nbsp;English &nbsp; &nbsp;
		<input type="checkbox" name="lang[]"  value="2" />&nbsp;Hindi &nbsp; &nbsp;
		<input type="checkbox" name="lang[]"  value="3" />&nbsp;Malayalam &nbsp; &nbsp;
        <input type="checkbox" name="lang[]"  value="4" />&nbsp;Arabic &nbsp; &nbsp;
        <input type="checkbox" name="lang[]"  value="5" />&nbsp;Tamil &nbsp; &nbsp;
        <input type="checkbox" name="lang[]"  value="6" />&nbsp;Telugu &nbsp; &nbsp;
	</td>
</tr>

<tr>
	<td></td>
	<td>
	</td>
</tr>


</tbody>
</table>



<!--LANGUAGE HTML ENDS-->

<!--UPLOAD FILE BEGIN-->
<h2 class="srevHd">Update CV &amp; Photo</h2>

<table class="hori-form">
<tbody>



<tr>
<td>Upload your CV</td>
 <td> 
 <?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?> </td>
</tr>
<tr>
<td>Upload your Photo</td>
 <td> 
 <?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?> </td>
</tr>


</tbody>
</table>
<!--UPLOAD FILE END-->

<!--Planning for Job Change BEGIN-->
<h2 class="srevHd">Planning for Job Change</h2>

<table class="hori-form">
<tbody>

<tr>
<td>When you are planning to search for  a new job?</td>
 <td> 
 	<input class="form-control hori " type="text" name="job_date" id="job_date"  placeholder="Enter  Date"> </td>
</tr>

<tr>
<td>Current CTC</td>
 <td> 
<input class="form-control hori" type="text" name="current_ctc" value="" id="current_ctc"> </td>
</tr>
<tr>
<td>Expected CTC</td>
 <td> 
 <input class="form-control hori" type="text" name="expected_ctc" value="" id="expected_ctc"></td>
</tr>

<tr>
<td>Notice Period</td>
 <td> 
	<select name="notice_period" id="notice_period" >
		<option value="">Select no of days</option>
<?php for($i=1;$i<=200;$i++){
	?>
	<option value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
	<?php
	}?>
	</select>
  </td>
</tr>

<tr>
<td>Total Experience</td>
 <td> 
	<select name="total_experience" id="total_experience" >
		<option value="">Select no of years</option>
        
<?php for($i=1;$i<=30;$i += 0.5){
	?>
	<option value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
	<?php
	}?>
	</select>
  </td>
</tr>
<tr>
<td>Present Location</td>
 <td> 
 <input class="form-control hori" type="text" name="present_location" value="" id="present_location">
  </td>
</tr>
<tr>
<td>Preferred  Location</td>
 <td> 
 <input class="form-control hori" type="text" name="preferred_location" value="" id="preferred_location">
  </td>
</tr>
    <tr>
      <td class="style1">Are you ready for an immediate joining ?</td>
      
      <td><?php 
            $data = array(
            'name'        => 'immediate_join',
            'id'          => 'immediate_join',
            'value'       => '1',
            'checked'     => '',
            'style'       => 'margin:0px',
            );
            
            echo form_radio($data).'Yes';
            $data = array(
                'name'        => 'immediate_join',
                'id'          => 'immediate_join',
                'value'       => '0',
                'checked'     => '',
                'style'       => 'margin:10px',
                );
           
            echo form_radio($data).'No';
        ?> </td>
    </tr>




</tbody>
</table>

<!--Planning for Job Change End-->

<!--Apply Job BEGIN-->

<h2 class="srevHd">Please select which job you are interested</h2>

<table class="hori-form">
<tbody>


<tr>
<td>Jobs</td>
 <td> 
	<select name="job_id" id="job_id" >
		<option value="">Select Job</option>
<?php foreach($jobs as $job ){
	?>
	<option value="<?php echo $job["job_id"]; ?>"><?php echo $job["job_title"]; ?></option>
	<?php
	}?>
	</select>
  </td>
</tr>

<tr>
<td colspan="2" id="success">
</td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="btn" value="Save & Done" id="save_candidate"  style="width:180px;">
</span></td>
</tr>
</tbody>
</table>

<!--Apply Job Ends-->
<div ></div>

</form>

	   </div>
    </div>
    
    
    
    
  </div>


<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/animate_jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.canvasjs.min.js');?>"></script>

<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script>
var userFlag = 0;
$( document ).ready(function() 
{
	$('#job_date').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});
		
	$('#datepicker').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});


	$('#datepicker1').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"

	});

	$('#datepicker2').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"

	});
	$('#datepickfrom').datepicker({ 
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"

	});
	$('#datepickto').datepicker({ 
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"

	});
});
   function validate() { 
		
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   
 
		if($('#username').val()=='')
		{
			alert('Enter e-mail');
			$('#username').focus();
			return false;
		}
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test($('#username').val())){
			alert('Enter valid email');
			$('#username').focus();
			return false;
		}

		
		if($('#mobile').val()=='')
		{
			alert('Enter mobile');
			$('#mobile').focus();
			return false;
		}		
	

//education validate
		if($('#level_id').val()==0)
		{
			alert('Select Level');
			$('#level_id').focus();
			return false;
		}   
		if($('#course_id_edu').val()==0 || $('#course_id_edu').val()=='')
		{
			alert('Select course');
			$('#course_id_edu').focus();
			return false;
		}

//job validate
		
		if($('#organization').val()=='')
		{
			alert('Enter Organization');
			$('#organization').focus();
			return false;
		}   

		
	    return true;
    }
	   $('#candidate_form').submit(function(evt){
		evt.preventDefault();
	   	var formData = new FormData(this);
	 
		var isContactValid = validate();
		if(isContactValid) {

			$.ajax({
				type: "post",
				url: "<?php echo site_url('register/addcandidate'); ?>",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,

				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['success']=='true') 
						{
							$('#success').show();
							
							$('#success').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>You have successfully registered with ABE Services, One of our team members will contact you soon.</strong></div>');	
							$('#success').fadeOut(8000);
                           
                           
                           
						}else if(ret['username']=='false') 
						{
							alert('Email address already exist, please change and register again.');
/*							jQuery('#cur_course_id').html('');
							jQuery('#cur_course_id').append('<option value="">Register</option');*/
							return;
						}else if(ret['mobile']=='false')
						{
							alert('Mobile already exist, please change and save again.');
/*							jQuery('#cur_course_id').html('');
							jQuery('#cur_course_id').append('<option value="">Register</option');*/
							return;
						}
					}
					catch(e) {		
						alert('Exception occured while adding contact.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
   });//end button click function save*/
	   
	   
// level and course filtering ends here

// level of study starts here to filter course 
	$('#cur_level_study').change(function() 
	{
	
		jQuery('#cur_course_id').html('');
		jQuery('#cur_course_id').append('<option value="">Select Course</option');
			
		if($('#cur_level_study').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/register/getcourses/',
			  data: { level_study: $('#cur_level_study').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#cur_course_id').html('');
					jQuery('#cur_course_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#cur_course_id').html('');
					  $.each(data.course_list, function (index, value) 
					  {

						  if(index=='')
							 jQuery('#cur_course_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#cur_course_id').append('<option value="'+ index +'">' + value + '</option');
					 });
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#cur_course_id').html('');
					jQuery('#cur_course_id').append('<option value="">Select Course</option');
			  }
			});	
	});

// level and course filtering ends here




//EDUCATION DETAILS SCRIPT BEDIN


// filter education level and courses 
	$('#level_id').change(function() 
	{
	
		jQuery('#course_id_edu').html('');
		jQuery('#course_id_edu').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/register/getcourses/',
			  data: { level_study: $('#level_id').val(),int_val:1},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#course_id_edu').html('');
					jQuery('#course_id_edu').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  { //alert(data.course_list);
				  
					  jQuery('#course_id_edu').html('');
					  jQuery('#course_id_edu').append(data.course_list);
												 
					  //for (var i = 0; i < crse.length; i++)
					 /* $.each(data.course_list, function (index, value) 
					  {
							 jQuery('#course_id_edu').append('<option value="'+ index +'" selected="selected">' + value + '</option>');
						
						  
					 });*/
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#course_id_edu').html('');
					jQuery('#course_id_edu').append('<option value="">Select Course</option');
			  }
			});	
	});
// filter education level and courses  - end here 

//EDUCATION DETAILS SCRIPT ENDS

//JOB DETAILS SCRIPT BEGIN
$('#ui-datepicker-div').remove();


   
//JOB DEATILS SCRIPT ENDS

//SKILLS DEATILS SCRIPT
function myFunction()
	{
		
		
	  var parnt =$('#parent').val();
	  //alert(parnt);
	  $.ajax({
      type: "get",
      async: true,
      //~ url: "<?php echo $this->config->base_url(); ?>/child_skill",
      url: "<?php echo site_url('register/child_skill'); ?>",
      data: {'id':parnt},
      dataType: "json",
      success: function(res) {
       //alert("hi");
       create_checkbox(res);
     //  $("#checkbox_create").show();
     console.log(res['skillset']);
    
							} 
			});  
   }

function create_checkbox(res)
{ 
	var skillset=res['skillset'];
	var count=skillset['length'];
	var tr="<br/><tr>";
	var i=0;j=0;
	$('#addg').html('');
	$('#addg').append(tr);
	for(var k=0;k<count;k++)
	{   
		i+=1;
		j=i%4;
		var checks='<td><input type="checkbox"  name="skills[]" value="'+skillset[k]['skill_id']+'"/>'+skillset[k]['skill_name']+'</td>';
		
		
		$('#addg').append(checks);
		if(j==0){ var tend="</tr><tr>";
			$('#addg').append(tend);
			 }
	}
	var ttend="</td>"
	$('#addg').append(ttend);
	//alert(skillset['length']);
}
//SKILL DEATILS SCRIPT ENDS
</script>



<div class="clear"></div>
</div>

</body>
</html>
