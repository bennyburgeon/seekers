<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">


<style>
td, th {
    padding: 2px;
}
</style>


<div class="sidebar-area inner-pages">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box2 sides">
<h4>About:</h4>
<p>Lorem ipsum dolor sit amet diam nonummy nibh dolore.</p>
<h4>Contact:</h4>
<ul>
<li>Company Name</li>
<li>+97 254 2563 889</li>
<li>214 5454 878</li>
<li>4th Avenue, 2nd Street</li>
<li>somebody@test.com</li>
<li><a href="#">www.website.in</a></li>
<li class="social-p">
<a href="#"><img src="<?php echo base_url('assets/images/p_icon8.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon9.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon10.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon11.png');?>"></a>
</li>
</ul>
</div>

</div>
</div>

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/dasboard">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active">Manage Data </li>
      </ul>
</div>

<?php if($this->input->get('ins')==1){?>                 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Success !</strong>record added successfully.
</div>
<?php } ?>

<?php if($this->input->get('del')==1){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>record deleted..</strong>
</div>
<?php }?>

<?php if($this->input->get('update')==1){?>  
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>record updated successfully.
</div>
<?php }?>

<?php if($this->input->get('status')==1){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Success !</strong>Status changed successfully..
</div>
<?php } ?> 

<?php if($this->input->get('del')==2){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Error!! <?php echo $_SESSION['related_module'] ?> exists under property</strong>
</div>
<?php } ?> 


<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<!--
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/manage_data/multidelete?rows=<?php echo $rows;?>" >
</form>                           
-->
<div class="col-sm-2"></div>


<div class="col-sm-6">
<!--
first form
-->
<form id="candidate_form" class="formular" name="candidate_form" method="post" >
<!--
<form id="candidate_form" class="formular" name="candidate_form" method="post" action="<?php echo $this->config->site_url();?>/manage_data/addCandidate">
-->

  <input type="hidden" id="job_id" name="job_id" value="<?php echo $formdata['job_id']; ?>">
    
    </font></strong>
        
  
  <h2 class="srevHd">Personal Details</h2>
  
  <table class="enqTbl"  border="0" cellspacing="2" cellpadding="2" width="100%">

    <tr>
      <td>Title</td>
      <td>:</td>
      <td align="left"><?php 
				   $options = array(
                  '1'  => 'Mr.',
				  '3'  => 'Mis.',
				  '4'  => 'Miss.',
                  '2'    => 'Mrs');
				   echo form_dropdown('title', $options, $formdata['title']);
				  ?> </td>
    </tr>
    <tr>
      <td><span class="style1"> Full Name*</span></td>
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
      <td height="17" class="style1">Password*</td>
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
      <td class="style1">Gender</td>
      <td>:</td>
      <td align="left"><?php 
            $data = array(
            'name'        => 'gender',
            'id'          => 'gender',
            'value'       => '1',
            'checked'     => '',
            'style'       => 'margin:10px',
            );
            if($formdata['gender']=='1') $data['checked']='TRUE';
            echo form_radio($data).'Male';
            $data = array(
                'name'        => 'gender',
                'id'          => 'gender',
                'value'       => '0',
                'checked'     => '',
                'style'       => 'margin:10px',
                );
            if($formdata['gender']=='0') $data['checked']='TRUE';
            echo form_radio($data).'Female';
        ?> </td>
    </tr>
    <tr>
      <td class="style1">DoB</td>
      <td>:</td>
      <td align="left"><input type="date" class="hasDatepicker" name="date_of_birth" id="datepicker2" value="<?php echo $formdata['date_of_birth'];?>" placeholder="Enter your DoB"></td>
    </tr>

	</table>
	
	
	 
	
	 <table class="enqTbl"  border="0" cellspacing="2" cellpadding="2" width="100%">
	
  
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right"><label>
	  
	  
	  
        <input name="Register" type="button" class="btn" id="save_candidate" value="Register" />
 </label></td>
    </tr>
  </table>
</form>


<!--
first form ends
-->
<!--
2nd form 
-->

<h2 class="srevHd">Add Qualification</h2>
 
  <form class="formular"  method="post" id="candidate_form3" name="candidate_form3" > 
   
<table class="enqTbl">
	
	<input type="hidden" id="candidate_id1" value="<?php if(isset($candidate_id) && !empty($candidate_id)) echo $candidate_id;?>" name="candidate_id">
	
<tbody>

<tr>
<td>Level of Study</td>
 <td> <?php echo form_dropdown('level_id',  $edu_level_list, $education['level_id'],'class="form-control" id="level_id"');?> </td>
</tr>
<br/>
<tr>
<td>Course</td>
 <td> <?php echo form_dropdown('course_id',  $edu_course_list, $education['course_id'],'class="form-control" id="course_id_edu"');?> </td>
</tr>
<tr>
<td>Specialization</td>
 <td> <?php echo form_dropdown('spcl_id',  $edu_spec_list, $education['spcl_id'],'class="form-control" id="spcl_id"');?> </td>
</tr>
<tr>
<td>University</td>
 <td> <?php echo form_dropdown('univ_id',  $edu_univ_list, $education['univ_id'],'class="form-control" id="univ_id"');?> </td>
</tr>
<tr>
<td>Year</td>
 <td> <?php echo form_dropdown('edu_year',  $edu_years_list, $education['edu_year'],'class="form-control" id="edu_year"');?> </td>
</tr>

<tr>
<td>Course Type</td>
 <td> <?php echo form_dropdown('course_type_id',  $edu_course_type_list, $education['course_type_id'],'class="form-control" id="course_type_id"');?> </td>
</tr>


<tr>
<td>Arrears</td>
 <td> <input style="width:100px;" placeholder="arrears"  type="text"  name="arrears" value="<?php echo $education['arrears'];?>" id="arrears"> </td>
</tr>

<tr>
<td>Absesnce</td>
 <td> <input style="width:100px;" placeholder="absesnse"  type="text"  name="absesnse" value="<?php echo $education['absesnse'];?>" id="absesnse"> </td>
</tr>

<tr>
<td>Repeat</td>
 <td> <input style="width:100px;" placeholder="repeat"  type="text"  name="repeat" value="<?php echo $education['repeat'];?>" id="repeat"> </td>
</tr>

<tr>
<td>Year Back</td>
 <td> <input style="width:100px;" placeholder="year_back"  type="text"  name="year_back" value="<?php echo $education['year_back'];?>" id="year_back"> </td>
</tr>

<tr>
<td>Total Percentage</td>
 <td> <input style="width:100px;" placeholder="mark_percentage"  type="text"  name="mark_percentage" value="<?php echo $education['mark_percentage'];?>" id="mark_percentage"> </td>
</tr>

<tr>
<td>Grade</td>
 <td> <input style="width:100px;" placeholder="grade"  type="text"  name="grade" value="<?php echo $education['grade'];?>" id="grade"> </td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="btn" value="Save" id="save_candidate3" style="width: 153px;">
</span>
</td>
</tr>
</tbody>
</table>

</form>



<!--
2nd form ends
-->
<!--
3rd form-->


<h2 class="srevHd">Add Passport &amp; Language Details</h2>

<form class="formular"  method="post" id="candidate_form2" name="candidate_form2" > 
<table class="enqTbl">
	
	<input type="hidden" id="candidate_id2" value="<?php if(isset($candidate_id) && !empty($candidate_id)) echo $candidate_id;?>" name="candidate_id">
<tbody>



<tr>
  <td>Nationality</td>
    <td><?php echo form_dropdown('passport_nationality',  $country_list, $formdata_passport['passport_nationality'],' id="passport_nationality"');?></td>
</tr>







<tr>
	<td>Languages Known</td>
	<td><input type="checkbox" name="lang[]"  value="1" />English<br />
		<input type="checkbox" name="lang[]"  value="2" />Hindi<br />
		<input type="checkbox" name="lang[]"  value="3" />Malayalam<br />
	</td>
</tr>

<tr>
  <td>10th Marks</td>
    <td><input class="txtFeild" placeholder="Total %" type="text" name="eng_10th" value="<?php echo $formdata_passport['eng_10th'];?>" id="eng_10th"></td>
</tr>

<tr>
  <td>12th Marks</td>
    <td><input class="txtFeild" placeholder="Total %" type="text" name="eng_12th" value="<?php echo $formdata_passport['eng_12th'];?>" id="eng_12th"></td>
</tr>



<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="btn" value="Save & Continue" id="save_candidate2" style="width:180px;">
</span></td>
</tr>

</tbody>
</table>

</form>
<!--
3rd form ends
-->
<!--
4th form
-->
<h2 class="srevHd">Update Questionnaire</h2>
 <form class="form-horizontal form-bordered"  method="post" id="frm_questionnaire" name="frm_questionnaire"  enctype="multipart/form-data"> 
<table class="hori-form" border=1>
	
	<input type="hidden" id="candidate_id3" value="<?php if(isset($candidate_id) && !empty($candidate_id)) echo $candidate_id;?>" name="candidate_id">
<tbody>


<?php
$j=1;
if(isset($answers1) && (!empty($answers1)))
					{
						foreach($quest as $quest){

							$id=$quest->question_id;
							?>
						<tr><td><?php echo $quest->question_title; ?></td>
							<?php 
							 if(!empty($answers1[$id])){
		 
		  $i=1; ?> <td> <?php 
					foreach($answers1[$id] as $answer1)
									{
										
										$gn =  $answer1->answer_title;
										
										
										
								?>
								
								<input type="radio" name="qt_<?php echo $j; ?>" id="radio<?php echo $i; ?>" value="<?php echo $answer1->answer_id; ?>" /> <?php echo $gn; ?><?php if($i==2 && $j==1) { ?><div class="des" style="display:none;"><input type="date" name="date_1" id="datepicker2" placeholder="date"></div><?php } ?><br>
								<?php  		
										$i++; }
										?>
										</td>
										<?php 
										
										$j++;
									}
									
										?>


 </tr>

<?php } } ?>




<tr>
	
<td colspan="2">
<span class="click-icons">
<input type="button" class="btn" value="Save & Continue" id="save_questionnaire"  style="width:180px;">

</span></td>
</tr>
</tbody>
</table>

<div id="success"></div>
</form>
<!--
4th form ends
-->
<!--
5th form
-->
<h2 class="srevHd">Add Skills</h2>

<form class="formular"  method="post" id="save_candidate_skill" name="save_candidate_skill" > 
	
	<select name="parent" id="parent" onchange="myFunction()">
		<option value="">Select your skill type</option>
<?php foreach($parentskill as $ps){
	?>
	<option value="<?php echo $ps['skill_id']; ?>"><?php echo $ps['skill_name']; ?></option>
	<?php
	}?>
</select>
<script>

function myFunction()
	{
	
	  var parnt =$('#parent').val();
	  $.ajax({
      type: "get",
      async: true,
      url: "<?php echo site_url('manage_data/child_skill'); ?>",
      data: {'id':parnt},
      dataType: "json",
      success: function(res) {
       
       create_checkbox(res);
     
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
	$('#addg').append(tr);
	for(var k=0;k<count;k++)
	{   
		i+=1;
		j=i%3;
		var checks="<td><input type='checkbox' name='skills[]' value='add'/>"+skillset[k]['skill_name']+"</td>";
		
		
		$('#addg').append(checks);
		if(j==0){ var tend="</tr><tr>";
			$('#addg').append(tend);
			 }
	}
	var ttend="</td>"
	$('#addg').append(ttend);
	
}

</script>

<table class="enqTbl" id="skill_tab" >
	<input type="hidden" id="candidate_id4" value="<?php if(isset($candidate_id) && !empty($candidate_id)) echo $candidate_id;?>" name="candidate_id">
<tbody>
	<div id="addg"></div>


<tr>
	<td></td>
	<td>
	</td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="btn" value="Save & Continue" id="save_candidate_skill1" style="width:180px;">
</span></td>
</tr>

</tbody>
</table>

</form>

<!--
5th form ends
-->
<!--
6th form
-->

<h2 class="srevHd">Add Certification Details</h2>

<form class="formular"  method="post" id="candidate_form_cert" name="candidate_form_cert" > 
<table class="enqTbl">
	<input type="hidden" id="candidate_id5" value="<?php if(isset($candidate_id) && !empty($candidate_id)) echo $candidate_id;?>" name="candidate_id">
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








<tr>
<td colspan="4">
<span class="click-icons">
<input type="button" class="btn" value="Save & Continue" id="candidate_form_cert1" style="width:180px;">
</span></td>
</tr>

</tbody>
</table>

</form>



<!--
6th form ends
-->
<!--
7th form 
-->

<h2 class="srevHd">Add Job/Professional Info</h2>

  <form class="formular"  method="post" id="candidate_form_job" name="candidate_form_job" > 
<table class="enqTbl">
	<input type="hidden" id="candidate_id6" value="<?php if(isset($candidate_id) && !empty($candidate_id)) echo $candidate_id;?>" name="candidate_id">
<tbody>


<tr>
<td>Organization Name</td>
<td><input class="form-control hori" type="text" name="organization" value="<?php echo $formdata_job['organization'];?>" id="organization"></td>
</tr>
<tr>
<td>Designation</td>
<td><input class="form-control hori " type="text" name="designation" value="<?php echo $formdata_job['designation'];?>" id="designation">
</td>
</tr>

<tr>
<td>Industry</td>
 <td> <?php echo form_dropdown('job_cat_id',  $industry_list, $formdata_job['job_cat_id'],'class="form-control" id="job_cat_id"');?> </td>
</tr>

<tr>
<td>Function/Role</td>
 <td> <?php echo form_dropdown('func_id',  $functional_list, $formdata_job['func_id'],'class="form-control" id="func_id"');?> </td>
</tr>


<tr>
<td>Responsibilities</td>
<td>
<input class="form-control hori " type="text" name="responsibility" value="<?php echo $formdata_job['responsibility'];?>" id="responsibility">
</td>
</tr>
<td>From Date</td>
<td>

	<input class="form-control hori " type="date" name="from_date" id="datepickfrom" value="<?php echo $formdata_job['from_date'];?>" placeholder="Enter From Date"></td>

</tr>
</tr>
<td>To Date</td>
<td>

	<input class="form-control hori " type="date" name="to_date" id="datepickto" value="<?php echo $formdata_job['to_date'];?>" placeholder="Enter To Date"></td>


</tr>
<tr>
<td>Current Salary</td>
<td>
<input class="form-control hori " type="text" name="monthly_salary" value="<?php echo $formdata_job['monthly_salary'];?>"  id="monthly_salary">
<input type="hidden" name="currency_id" value="" /></td>
</tr>


<tr>
<td>Is this your present job ?</td>
 <td> 
      <label class="radio-inline">
      <input type="radio" name="present_job" id="present_job" value="1" <?php if($formdata_job['present_job']==1){?> checked <?php } ?> >Yes</label>
    <label class="radio-inline">
<input type="radio" name="present_job" id="present_job" value="0" <?php if($formdata_job['present_job']==0){?> checked <?php } ?> >No</label>
                
 </td>
</tr>


<tr>
<td>Total Experience</td>
 <td> <?php echo form_dropdown('exp_years',  $years_list, $formdata_job['exp_years'],'class="form-control" id="exp_years"');?>&nbsp; <?php echo form_dropdown('exp_months',  $months_list, $formdata_job['exp_months'],'class="form-control" id="exp_months"');?>
  </td>	
</tr>
<tr>

<tr>
<td>Skills</td>
<td>
<input class="form-control hori " type="text" name="skills" id="skills" value="<?php echo $formdata_job['skills'];?>" placeholder="Enter your Skills ">
</td>
</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="btn" value="Save & Continue" id="candidate_form_job1" style="width: 153px;">
</span>
</td>
</tr>
</tbody>
</table>

</form>



<!--7th form ends
-->
<!--8th form ends
-->
<h2 class="srevHd">Add Contact Details</h2>
 
  <form class="formular"  method="post" id="candidate_form_contact" name="candidate_form_contact" > 
<table class="enqTbl" >
	
	<input type="hidden" id="candidate_id7" value="<?php if(isset($candidate_id) && !empty($candidate_id)) echo $candidate_id;?>" name="candidate_id">

<tbody>


<tr>
<td>Nationality</td>
 <td> 
 <?php  echo form_dropdown('nationality',  $country_list, $formdata_contact['nationality'],'class="form-control" id="country_id"');?> 
 </td>	
</tr>

<tr>
<td>State</td>
<td>

<?php echo form_dropdown('state',  $state_list, $formdata_contact['state'],'class="form-control" id="state_id"');?>

</td>
</tr>
<tr>

<td>City</td>
<td>
<?php echo form_dropdown('city_id',  $city_list, $formdata_contact['city_id'],'class="form-control" id="city_id"');?>
</td>
</tr>

<tr>
<td>Current location</td>
 <td> <?php echo form_dropdown('location_id',  $location_list, $formdata_contact['current_location'],'class="form-control" id="location_id"');?> 
 </td>
</tr>
<tr>
<td>Contact Address</td>
<td><input class="form-control hori" type="text" name="address" value="<?php echo $formdata_contact['address'];?>" id="address"></td>
</tr>
<tr>
<td>Land Phone</td>
<td>
<input type="hidden" name="land_prefix" value="" id="land_prefix">
<input class="form-control hori " type="text" name="land_phone" value="<?php echo $formdata_contact['land_phone'];?>" id="land_phone">
</td>
</tr>
<tr>
<td>Work Phone</td>
<td>
<input type="hidden" name="work_prefix" value="" id="work_prefix">
<input class="form-control hori " type="text" name="workphone" value="<?php echo $formdata_contact['workphone'];?>" id="workphone">
</td>
</tr>
<tr>
<td>Fax</td>
<td>
<input type="hidden" name="fax_prefix" value="" id="fax_prefix">
<input class="form-control hori " type="text" name="fax" value="<?php echo $formdata_contact['fax'];?>" id="fax">
</td>
</tr>
<tr>
<tr>
<td>Zip code</td>
<td><input class="form-control hori fo-icon-1" type="text" name="zipcode" value="<?php echo $formdata_contact['zipcode'];?>" id="zipcode"></td>
</tr>
<input type="hidden" name="religion_id" value="" />
<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="btn" value="Save & Continue" id="candidate_form_contact1" style="width:180px;">
</span>
</td>
</tr>
</tbody>
</table>

</form>


<!--8th form ends
-->



<!--9th form 
-->

<h2 class="srevHd">Update CV &amp; Photo</h2>
 <form class="form-horizontal form-bordered"  method="post" id="candidate_form_file" name="candidate_form_file" action="<?php echo $this->config->site_url();?>/manage_data/addfiles" enctype="multipart/form-data"> 
<table class="hori-form">
	<input type="hidden" id="candidate_id8" value="<?php if(isset($candidate_id) && !empty($candidate_id)) echo $candidate_id;?>" name="candidate_id">

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

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="btn" value="Save & Done" id="candidate_form_file1"  style="width:180px;">
</span></td>
</tr>
</tbody>
</table>


<div id="success"></div>
</form>


<!--9th form ends
-->






</div>
<div class="col-sm-4">
</div>


<div style="clear:both;"></div>


</div>
</div>


</div>
</div>
</div>
</div>
</section>
</div>
<script>
	$( document ).ready(function() 
{
	
	//validate candidate form
	 function candidate_validate() {
		
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   
 
		if($('#username').val()=='')
		{
			alert('Enter username');
			$('#username').focus();
			return false;
		}
		if($('#pass').val()=='')
		{
			alert('Enter password');
			$('#pass').focus();
			return false;
		}   
		if($('#cpassword').val()=='')
		{
			alert('Enter confirm password');
			$('#cpassword').focus();
			return false;
		}
		if( $('#password').val()!=$('#cpassword').val())
		{
			alert('Did Not Matching For Change Password');
			$('#cpassword').focus();
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

	return true;
    }
	
	
 $('#save_candidate').click(function(){
	   
		var dataStringprop = $("#candidate_form").serialize();
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$("#save_candidate").prop('value', 'Please wait....');
			$.ajax({
				type: "post",
				url: "<?php echo site_url('/manage_data/addCandidate'); ?>",
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['success']=='true') 
						{
							 var id = ret['id'];
							 document.getElementById('candidate_id1').value=id;
						}
						else if(ret['username']=='false') 
						{
							alert('Email address already exist, please change and register again.');
							jQuery('#cur_course_id').html('');
							jQuery('#cur_course_id').append('<option value="">Register</option');
							return;
						}
						else if(ret['mobile']=='false')
						{
							alert('Mobile already exist, please change and save again.');
							jQuery('#cur_course_id').html('');
							jQuery('#cur_course_id').append('<option value="">Register</option');
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
   
   
   
   
   
   
   
   
   //course selection
   
   $('#level_id').change(function() 
	{
	
		jQuery('#course_id_edu').html('');
		jQuery('#course_id_edu').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/manage_data/getcourses/',
			  data: { level_study: $('#level_id').val(),int_val:1},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#course_id_edu').html('');
					jQuery('#course_id_edu').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#course_id_edu').html('');
					  $.each(data.course_list, function (index, value) 
					  {
						  if(index=='')
							 jQuery('#course_id_edu').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#course_id_edu').append('<option value="'+ index +'">' + value + '</option');
					 });
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
   
   
   
   //save education
   
   
   function candidate_validate3() {
		if($('#level_id').val()==0)
		{
			alert('Select Level');
			$('#level_id').focus();
			return false;
		}   
		if($('#course_id').val()==0)
		{
			alert('Select course');
			$('#course_id').focus();
			return false;
		}
		if($('#spcl_id').val()==0)
		{
			alert('Select specialization');
			$('#spcl_id').focus();
			return false;
		}   
		if($('#univ_id').val()==0)
		{
			alert('Select University');
			$('#univ_id').focus();
			return false;
		}
		if($('#edu_year').val()==0)
		{
			alert('Select year');
			$('#edu_year').focus();
			return false;
		}   
		if($('#edu_country').val()=='')
		{
			alert('Select Country');
			$('#edu_country').focus();
			return false;
		}
		if($('#course_type_id').val()==0)
		{
			alert('Select Course type');
			$('#course_type_id').focus();
			return false;
		}
	    return true;
    }
   
   
   
     
   $('#save_candidate3').click(function(){
	   
		var dataStringprop = $("#candidate_form3").serialize();
		var isContactValid = candidate_validate3();
		if(isContactValid) {
			var candidateId = document.getElementById('candidate_id1').value;
		
			 $.ajax({
				 type: "post",
				 url: "<?php echo site_url('manage_data/addEducationDetail'); ?>"+'/'+candidateId,
				 cache: false,				
				 data: dataStringprop,
				  success: function(json) {
					
						 var ret = jQuery.parseJSON(json);
					    if(ret['STATUS']==1)
						{
							document.getElementById('candidate_id2').value=candidateId;
						}
					
					 
				 },
				 error: function(){						
					 alert('An Error has been found on Ajax request from contact save');
				  }
				
			 });//end ajax

		} //end contact valid
   });//end button click function save*/
   
   
   
   
   function candidate_validate2() {
   return true;
		if($('#passportno').val()=='')
		{
			alert('Enter passport number');
			$('#passportno').focus();
			return false;
		}   
		if($('#driving_license').val()=='')
		{
			alert('Enter driving liscence number');
			$('#driving_license').focus();
			return false;
		}
	    return true;
    }
    
    
   
   $('#save_candidate2').click(function(){
   
		var dataStringprop = $("#candidate_form2").serialize();
		
		var isContactValid = candidate_validate2();
		if(isContactValid) {
		var candidateId = document.getElementById('candidate_id2').value;
			$.ajax({
				type: "post",
				url: "<?php echo site_url('manage_data/addPassportDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					
							//~ alert(candidateId);
							document.getElementById('candidate_id3').value=candidateId;
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
   });
   
   $("#radio2").click(function(){
        $(".des").show();
    });
    
    
    
      $('#save_questionnaire').click(function(){

		var dataStringprop = $("#frm_questionnaire").serialize();
		isContactValid=true;
		if(isContactValid) {
			var candidateId = document.getElementById('candidate_id3').value;
			$.ajax({
				type: "post",
				url: "<?php echo site_url('manage_data/addQuestionnaire'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
							
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							
							//~ alert(candidateId);
							 document.getElementById('candidate_id4').value=candidateId;
							
						}
					
							
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });
   
   
   
   function candidate_validate_skill() {
   
		if($('#skill').val()=='')
		{
			alert('Enter skills');
			$('#skill').focus();
			return false;
		}   
		
	    return true;
    }
    
    
   $('#save_candidate_skill1').click(function(){
   
		var dataStringprop = $("#save_candidate_skill").serialize();
		var str1=$("form input[type='checkbox']:checked").map(function(){return this.name+"="+this.value;}).get().join("&");
		 
		
		var isContactValid = candidate_validate_skill();
		if(isContactValid) {
		var candidateId = document.getElementById('candidate_id4').value;
			$.ajax({
				type: "post",
				
				url: "<?php echo site_url('manage_data/addSkillDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
							
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							
							 //~ alert(candidateId);
							 document.getElementById('candidate_id5').value=candidateId;
						}
					
							
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
   });
   
   function candidate_validate_cert() {
   
		if($('#certifications').val()=='')
		{
			alert('Enter certifications');
			$('#certifications').focus();
			return false;
		}   
		
	    return true;
    }
   $('#candidate_form_cert1').click(function(){
   
		var dataStringprop = $("#candidate_form_cert").serialize();
		
		var isContactValid = candidate_validate_cert();
		if(isContactValid) {
		var candidateId = document.getElementById('candidate_id5').value;
			$.ajax({
				type: "post",
				url: "<?php echo site_url('manage_data/addcertificationDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
							
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							
                             //~ alert(candidateId);
							 document.getElementById('candidate_id6').value=candidateId;
                            
						}
					
							
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
   });
   
   function candidate_form_job() {
		if($('#organization').val()=='')
		{
			alert('Enter Organization');
			$('#organization').focus();
			return false;
		}   
		if($('#datepickfrom').val()=='')
		{
			alert('Add from date');
			$('#datepickfrom').focus();
			return false;
		}   
		if($('#datepickto').val()=='')
		{
			alert('Add to date');
			$('#datepickto').focus();
			return false;
		}
		if($('#exp_years').val()=='')
		{
			alert('Add total experience');
			$('#edu_country').focus();
			return false;
		}
	    return true;
    }
   $('#candidate_form_job1').click(function(){
		var dataStringprop = $("#candidate_form_job").serialize();
		var isContactValid = candidate_form_job();
		if(isContactValid) {
			var candidateId = document.getElementById('candidate_id6').value;
			$.ajax({
				type: "post",
				url: "<?php echo site_url('manage_data/addJobDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
							
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) 
						{
							//~ alert(candidateId);
							 document.getElementById('candidate_id7').value=candidateId;
                           
                            
						}
					
							
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });
   
   
   $('#country_id').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');
		
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/manage_data/getstate',
		  data: { country_id: $('#country_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#state_id').html('');
				  $.each(data.state_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#state_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#state_id').append('<option value="'+ index +'">'+ value +'</option');
				 });
						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Select State</option');
		  }
		});	
	});
    
    
$('#state_id').change(function() {

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
		
	if($('#state_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/manage_data/getcity',
		  data: { state_id: $('#state_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#city_id').html('');
				  $.each(data.city_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#city_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#city_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Select City</option');
		  }
		});	
	});

$('#city_id').change(function() {

	jQuery('#location_id').html('');
	jQuery('#location_id').append('<option value="">Select Location</option');
		
	if($('#state_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/manage_data/getlocation',
		  data: { city_id: $('#city_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#location_id').html('');
				jQuery('#location_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){              
			  if(data.success==true)
			  {
                              jQuery('#location_id').html('');                              				  
				  $.each(data.location_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#location_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#location_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#location_id').html('');
				jQuery('#location_id').append('<option value="">Select Location</option');
		  }
		});	
});
   
   
   function candidate_validate_contact() 
   {
	    return true;
   }
   $('#candidate_form_contact1').click(function(){
		var candidateId = document.getElementById('candidate_id7').value;
		var dataStringprop = $("#candidate_form_contact").serialize();
		var isContactValid = candidate_validate_contact();
		if(isContactValid) {
			$.ajax({
				type: "post",
				url: "<?php echo site_url('manage_data/addCandidateDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
							
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							
                            //~ alert(candidateId);
							 document.getElementById('candidate_id8').value=candidateId;
                            
						}
					
							
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save blahblah');
				}
			});//end ajax
		} //end contact valid
   });
   
   
   
   $('#candidate_form_file1').on('submit', function(e){
	
	 e.preventDefault();
		//$("#preview").html('<img src="'+img_path+'" alt="Uploading...."/>');
		 $(this).ajaxSubmit({success:function(data){ 
			if(($.trim(data)=='Choose cv file')||($.trim(data) == 'Choose photo')||($.trim(data) == 'Choose file')||($.trim(data) == 'Image file size max 1 MB')||($.trim(data) == 'failed')){
				alert(data);
			}
			else{
				
				var img_path = '<?php echo base_url();?>assets/images/loader.gif';
				$("#step1").html('<img src="'+img_path+'" alt="Uploading...." width="30" height="30"/>');
				$('#success').html('successfully uploaded');
				$("#step1").html(data);
			}	
		}
		});
});
   
   
   
 });
   </script>
