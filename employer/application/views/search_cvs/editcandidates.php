<style>

    td.test {
    width:730px;
    padding: 0 5px 0 0;
    margin: 0;
    border: 0;
    }
  .ScrollStyle{
	overflow-y:auto;
    max-height:500px;
  }
</style>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages"><span>Home</span> / <span><?php echo $page_head;?></span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?></h3></div>



 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 
<div id ="step1">
<div class="table-tech specs hor">
<?php if($this->session->flashdata('msg')){?>
<div class="alert alert-success">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
		 <strong><?php echo $this->session->flashdata('msg');?></strong>
	</div>
<?php } ?> 


<table class="hori-form">
   
    
    <a href="<?php echo $this->config->site_url();?>/search_cvs" class="attach-subs subs pull-right">Listing</a>
    <a href="<?php echo $this->config->site_url();?>/search_cvs/profile_entry/<?php echo $candidate_id; ?>" class="attach-subs subs pull-right">Raw Data</a>
    
    
    <tbody>
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form" name="candidate_form" >             
            <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
            <h2 class="srevHd">Personal Details</h2>
            
            
                <tr>
                    <td>Title</td>
                    <td> <?php 
                    $options = array(
                    '1'  => 'Mr.',
                    '3'  => 'Mis.',
                    '4'  => 'Miss.',
                    '2'    => 'Mrs');
                    echo form_dropdown('title', $options, $formdata['title']);
                    ?>  </td>
                </tr>
                
                <tr>
                    <td>First name</td>
                    <td><input class="form-control hori" type="text" name="first_name" value="<?php echo $formdata['first_name'];?>" id="first_name"></td>
                </tr>
                
                <tr>
                    <td>Last name</td>
                    <td><input class="form-control hori fo-icon-1" type="text" name="last_name" value="<?php echo $formdata['last_name'];?>" id="last_name"></td>
                </tr>
                
                <tr>
                    <td>Email</td>
                    <td><input class="form-control hori " type="text" readonly name="username" value="<?php echo $formdata['username'];?>" id="username"></td>
                </tr>
                
                <tr>
                    <td>Gender</td>
                    <td> 
                    <?php 
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
                    ?>	
                    </td>	
                </tr>
                
                <tr>
                    <td>Marital Status</td>
                    
                    <td> 
                    <?php 
                    $data = array(
                    'name'        => 'marital_status',
                    'id'          => 'marital_status',
                    'value'       => '1',
                    'checked'     => '',
                    'style'       => 'margin:10px',
                    );
                    if($formdata['marital_status']=='1') $data['checked']='TRUE';
                    echo form_radio($data).'Married';
                    $data = array(
                    'name'        => 'marital_status',
                    'id'          => 'marital_status',
                    'value'       => '6',
                    'checked'     => '',
                    'style'       => 'margin:10px',
                    );
                    if($formdata['marital_status']=='6') $data['checked']='TRUE';
                    echo form_radio($data).'Never Married';
                    ?> </td>
                
                </tr>
                
                <tr>
                    <td>Mobile Phone</td>
                    <td><input type="hidden" name="mobile_prefix" value="" id="mobile_prefix">
                    <input style="width:200px;" type="text" name="mobile" maxlength="13" value="<?php echo $formdata['mobile'];?>" id="mobile">
                    </td>
                </tr>
                
                <tr>
                    <td>Date of Birth</td>
                    <td><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" value="<?php echo $formdata['date_of_birth'];?>" 
                    placeholder="Enter your DoB"></td>
                </tr>
                
                <?php /*?><tr>
                <td>Age</td>
                <td><input style="width:100px;" type="text" maxlength="2" name="age" value="<?php echo $formdata['age'];?>" placeholder="Age">
				[Just leave this if you enter a valid DoB, Age calculate automatically when save.]</td>
                </tr>
                
                <tr>
                <td>No of children</td>
                <td><input style="width:100px;" type="text" maxlength="2" name="children" value="<?php echo $formdata['children'];?>" placeholder="Children"></td>
                </tr>
                
                <?php */?>
                
                <tr>
                    <td>Lead Status</td>
                    <td><input id="reg_status" type="radio" name="reg_status" value="1"  <?php if($formdata['reg_status']==1)echo 'checked="checked"';?>  />PHP Dev. &nbsp;
                    <input type="radio" name="reg_status" value="2" id="reg_status"  <?php if($formdata['reg_status']==2)echo 'checked="checked"';?> />ASP.NET Dev. 
                    &nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="3"  <?php if($formdata['reg_status']==3)echo 'checked="checked"';?>  /> 
                    Designer &nbsp;&nbsp;<input type="radio" name="reg_status" value="4" id="reg_status"  <?php if($formdata['reg_status']==4)echo 'checked="checked"';?> />
                    SEO -Internet Marketing &nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="5"  <?php if($formdata['reg_status']==5)echo 
					'checked="checked"';?>  />JAVA Dev.&nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="6"  <?php if($formdata['reg_status']==6)
					echo 'checked="checked"';?>  />Oracle Dev.</td>
                </tr>
                
                <tr>
                    <td>Lead Opportunity</td>
                    <td><input id="lead_opportunity" type="radio" name="lead_opportunity" value="1"  <?php if($formdata['lead_opportunity']==1)echo 'checked="checked"';?> />Cold 
                    &nbsp;<input type="radio" name="lead_opportunity" value="2" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==2)echo 'checked="checked"';?>/>
                    Warm &nbsp;&nbsp;<input id="lead_opportunity" type="radio" name="lead_opportunity" value="3"  <?php if($formdata['lead_opportunity']==3)echo 
                    'checked="checked"';?>  />Hot &nbsp;&nbsp;<input type="radio" name="lead_opportunity" value="0" id="lead_opportunity"  
                    <?php if($formdata['lead_opportunity']==0)echo 'checked="checked"';?> />Unknown&nbsp;</td>
                </tr>
                
                <?php /*?><tr>
                <td>How did you come to know us?</td>
                <td><input class="form-control hori " type="text" name="lead_source" value="<?php echo $formdata['lead_source'];?>" placeholder="Lead Source"></td>
                </tr><?php */?>
                
                <tr>
                    <td colspan="2" id="step1-msg">
                    
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="button" class="attach-subs" value="Save" id="edit_candidate" style="width:180px;"><!--<input type="button" class="attach-subs subs" value="Skip" id="skip">
                    <!--<input type="button" class="attach-subs subs" value="Skip" id="skip">-->
                    <!--<a href="<?php echo $this->config->site_url();?>/search_cvs/summary/<?php echo $formdata['candidate_id'] ?>" class="attach-subs subs">Done</a>-->
                    </span>
                    </td>
                </tr>
            </form>
    </tbody>
</table>


<?php if(isset($formdata['profile_list']['1'])){ ?><div class="ScrollStyle">
<table align="center"  border="1" style="margin-top:5%;" width="80%">
    <tr>
    <td><?php if(isset($formdata['profile_list']['1']))echo $formdata['profile_list']['1'];?></td>
    </tr>
</table></div>
<?php } ?>
<div style="clear:both;"></div>
</div>
</div>


<!--START PLANNING JOB CHANGE DETAILS-->

<div id ="step8">
<div class="table-tech specs hor">

<form class="form-horizontal form-bordered"  method="post" id="candidate_form8" name="candidate_form8" > 
  <h2>Planning for Job Change</h2>
        <table class="hori-form">
        	<tbody>
                <tr>
                    <td style="width:40%">When you are planning to search for  a new job?</td>
                    <td> 
 						<input class="form-control datepicker hori " readonly type="text" value="<?php echo $formdata['job_date'];?>" name="job_date" id="datepickfrom1"  
                        placeholder="Enter From Date YYYY-MM-DD"> 

                    </td>	
                </tr>
                
                <tr>
                    <td>Current CTC</td>
                    <td><input class="form-control hori" value="<?php echo $formdata['current_ctc'];?>" type="text" name="current_ctc" id="current_ctc"> </td>
                </tr>
                
                <tr>                
                    <td>Expected CTC</td>
                    <td><input class="form-control hori" value="<?php echo $formdata['expected_ctc'];?>" type="text" name="expected_ctc" id="expected_ctc"></td>

                </tr>
                
                <tr>
                    <td>Notice Period</td>
                     <td>	
                            <select name="notice_period" id="notice_period" class="js-example-basic-single">
                            <option value="">Select no of days</option>
                            <?php for($i=1;$i<=200;$i++){
                            ?>
                            <option <?php if($formdata['notice_period']==$i){?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?> Days</option>
                            <?php
                            }?>
                            </select> 
                     </td>
                </tr>
               
                <tr>
                    <td>Total Experience</td>
                    <td>
                            <select name="total_experience" id="total_experience" class="js-example-basic-single">
                            <option value="">Select no of years</option>
                            
                            <?php for($i=1;$i<=30;$i += 0.5){
                            ?>
                            <option <?php if($formdata['total_experience']==$i){?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?> Years</option>
                            <?php
                            }?>
                            </select>
                    </td>
                </tr>
               
                <tr>
                    <td>Present Location</td>
                    <td> 
                    <input value="<?php echo $formdata['present_location'];?>" class="form-control hori" type="text" name="present_location" id="present_location">
                    </td>
                </tr>
               
                             
                <tr>
                    <td>Preferred  Location</td>
                    <td> 
                    <input class="form-control hori" type="text" name="preferred_location" value="<?php echo $formdata['preferred_location'];?>" id="preferred_location">
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
                    
                    if($formdata['immediate_join']=='1') $data['checked']='TRUE';
                    echo form_radio($data).'Yes';
                    $data = array(
                    'name'        => 'immediate_join',
                    'id'          => 'immediate_join',
                    'value'       => '0',
                    'checked'     => '',
                    'style'       => 'margin:10px',
                    );
                    if($formdata['immediate_join']=='0') $data['checked']='TRUE';
                    echo form_radio($data).'No';
                    ?> </td>
                </tr>
                
                
                 <tr>
                    <td>Passport Number</td>
                    <td> 
                    <input class="form-control hori" type="text" name="passportno" value="<?php echo $formdata['passportno'];?>" id="passportno">
                    </td>
            	</tr>
            
            
                <tr>
                    <td class="style1">Passport Type</td>
                    
                    <td><?php 
                    $data = array(
                    'name'        => 'passport_type',
                    'id'          => 'passport_type',
                    'value'       => '1',
                    'checked'     => '',
                    'style'       => 'margin:0px',
                    );
                    
					 if($formdata['passport_type']=='1') $data['checked']='TRUE';
                    echo form_radio($data).'ECR';
                    
					$data = array(
                    'name'        => 'passport_type',
                    'id'          => 'passport_type',
                    'value'       => '2',
                    'checked'     => '',
                    'style'       => 'margin:10px',
                    );
                     if($formdata['passport_type']=='2') $data['checked']='TRUE';
                    echo form_radio($data).'ECNR';
                    ?> </td>
                </tr>
            
            	<tr>
                	<td colspan="2" id="step8-msg"></td>
                </tr>
                
                <tr>                
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="button" class="attach-subs" value="Save" id="edit_candidate8" style="width:180px;">
                    
                    </span>
                	</td>
                </tr>
        </tbody>
	</table>

</form>

<div style="clear:both;"></div>
</div>
</div>

<!--END PLANNING JOB CHANGE DETAILS-->





<!--START CONTACT DETAILS-->

<div id ="step2">
<div class="table-tech specs hor">

<form class="form-horizontal form-bordered"  method="post" id="candidate_form1" name="candidate_form1" > 
  <h2>Contact Details</h2>
        <table class="hori-form">
        	<tbody>
                <tr>
                    <td>Nationality</td>
                    <td> 
                    <?php  echo form_dropdown('nationality',  $country_list, $formdata['nationality'],'class="form-control js-example-basic-single" id="country_id" style="width:100%;"');?> 
                    <?php //echo form_dropdown('nationality',  $country_list, $formdata['nationality'],'class="form-control" id="state_id"');?> 
                    </td>	
                </tr>
                
                <tr>
                    <td>State</td>
                    <td>
                    
                    <?php echo form_dropdown('state',  $state_list, $formdata['state'],'class="form-control js-example-basic-single" id="state_id" style="width:100%;"');?>
                    
                    </td>
                </tr>
                
                <tr>                
                    <td>City</td>
                    <td>
                  
                    <?php echo form_dropdown('city_id',  $city_list, $formdata['city_id'],'class="form-control js-example-basic-single" id="city_id" style="width:100%;"');?>
                    </td>
                </tr>
                
                <tr>
                    <td>Current location</td>
                     <td> <?php echo form_dropdown('current_location',  $location_list, $formdata['current_location'],'class="form-control js-example-basic-single" id="location_id" style="width:100%;"');?> 
                     </td>
                </tr>
               
                <tr>
                    <td>Contact Address</td>
                    <td><input class="form-control hori" type="text" name="address" value="<?php echo $formdata['address'];?>" id="address"></td>
                </tr>
               
                <tr>
                    <td>Land Phone</td>
                    <td>
                    <input type="hidden" name="land_prefix" value="" id="land_prefix">
                    <input class="form-control hori " type="text" name="land_phone" value="<?php echo $formdata['land_phone'];?>" id="land_phone">
                    </td>
                </tr>
               
                <tr>
                    <td>Work Phone</td>
                    <td>
                    <input type="hidden" name="work_prefix" value="" id="work_prefix">
                    <input class="form-control hori " type="text" name="workphone" value="<?php echo $formdata['workphone'];?>" id="workphone">
                    </td>
                </tr>
               
                <tr>
                    <td>Fax</td>
                    <td>
                    <input type="hidden" name="fax_prefix" value="" id="fax_prefix">
                    <input class="form-control hori " type="text" name="fax" value="<?php echo $formdata['fax'];?>" id="fax">
                    </td>
                </tr>
                
                <tr>
                    <tr>
                    <td>Zip code</td>
                    <td><input class="form-control hori fo-icon-1" type="text" name="zipcode" value="<?php echo $formdata['zipcode'];?>" id="zipcode"></td>
                </tr>
                
                <input type="hidden" name="religion_id" value="" />
                <!-- 
                <tr>
                <td>Religion</td>
                 <td> <?php //echo form_dropdown('religion_id',  $religion_list, $formdata['religion_id'],'class="form-control" id="religion_id"');?> </td>
                </tr>
                -->
                <tr>
                    <td colspan="2" id="step2-msg">
                    
                    </td>
                </tr>
                
                <tr>                
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="button" class="attach-subs" value="Save" id="edit_candidate1" style="width:180px;">
                    
                    </span>
                	</td>
                </tr>
        </tbody>
	</table>

</form>
<?php if(isset($formdata['profile_list']['2'])){ ?>
<div class="ScrollStyle">
<table align="center"  border="1" style="margin-top:5%" width="80%">
<tr>
<td><?php if(isset($formdata['profile_list']['2']))echo $formdata['profile_list']['2'];?></td>
</tr>
</table>
</div>
<?php } ?>
<div style="clear:both;"></div>
</div>
</div>

<!--END CONTACT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step2">
<div class="table-tech specs hor">

<form class="form-horizontal form-bordered"  method="post" id="candidate_form2" name="candidate_form2" > 
  <h2>Language Details</h2>
        <table class="hori-form">
            <tbody>
            
                <tr>
                  	<td>Nationality</td>
                    <td><?php echo form_dropdown('passport_nationality',  $country_list, $formdata['passport_nationality'],'class="form-control js-example-basic-single" id="passport_nationality" style="width:100%"');?></td>
                </tr>
                
                <tr>
                  	<td>10th Marks</td>
                    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_10th" value="<?php echo $formdata['eng_10th'];?>" id="eng_10th"></td>
                </tr>
                
                <tr>
                  	<td>12th Marks</td>
                    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_12th" value="<?php echo $formdata['eng_12th'];?>" id="eng_12th"></td>
                </tr>
                
                <tr>
                  	<td>Graduation Mark</td>
                    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_grad" value="<?php echo $formdata['eng_grad'];?>" id="eng_grad"></td>
                </tr>
                
                <tr>
                  	<td>Post Graduation Mark</td>
                    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_post_grad" value="<?php echo $formdata['eng_post_grad'];?>" id="eng_post_grad"></td>
                </tr>
                
                <tr>
                    <td>Languages Known</td>
                    <td>
                    <?php foreach($lang_list as $lang){ ?>
                        <label style="font-weight:normal"><input <?php   if (in_array($lang['lang_id'], $candidate_language)){ ?> checked="checked" <?php  } ?>  type="checkbox" name="lang[]"  value="<?php echo $lang['lang_id'];?>" />&nbsp;<?php echo $lang['lang_name'];?></label>&nbsp;&nbsp;&nbsp;
                        
                    <?php } ?>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" id="step3-msg">              
                    </td>
                </tr>
               
                <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="button" class="attach-subs" value="SAVE" id="edit_candidate2" style="width:180px;">
                    
                    </span>
                </td>
                </tr>
            </tbody>
        </table>

</form>
<?php if(isset($formdata['profile_list']['5'])){ ?>
<div class="ScrollStyle">
<table align="center" border="1" style="margin-top:5%;" width="80%">
<tr>
<td><?php if(isset($formdata['profile_list']['5']))echo $formdata['profile_list']['5'];?></td>
</tr>
</table>
</div>
<?php } ?>
<div style="clear:both;"></div>
</div>
</div>
<!--END PASSPORT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step7">
<div class="table-tech specs hor">

<form class="form-horizontal form-bordered"  method="post" id="candidate_form7" name="candidate_form7" > 
<h2>Technical Skills,Certificates and Domain Knowledge</h2>
        <table class="hori-form">
            <tbody>
            
                <tr>
                </tr>
                <tr>
                    <td>Technical Skills</td>
                    <td> 
                    <select class="js-example-basic-multiple-cert" name="skills[]" multiple="multiple" id="multiple_skill" style="width:970px;">
                    
                    <?php foreach($all_child_skills as $skill){?>
                    <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                    <?php }?>
                    </select>
                    </td>
<!--                    <td> <select class="form-control" onchange="myFunction();" id="parent">
                    <option value="">Select Skill</option>
                    <?php foreach($skill_list as $key => $val){?>
                    <option <?php if(isset($res1[0]['skill_id']) && $res1[0]['skill_id']==$key){?> selected="selected" <?php } ?> value="<?php echo $key;?>"><?php echo $val['skill_name'];?></option>
                    <?php }?>
                    </select>
                    </td>-->
                </tr>
                
 <!--               <tr  id="skill-tr"  <?php if(empty($candidate_skills)){ ?> style="display:none" <?php }  ?>>                
                    <td>&nbsp;</td>
                    <td> 
                    <select class="js-example-basic-multiple-cert" name="skills[]" multiple="multiple" id="multiple_skill" style="width:970px;">
                    
                    <?php foreach($all_child_skills as $skill){?>
                    <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                    <?php }?>
                    </select>
                    </td>                
                </tr> -->
                
                
                
                <tr>
                    <td>Job Certification</td>
                    <td> <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_cert" name="cert[]" style="width: 970px;">
                    <?php foreach($cerifications as $cert){?>
                    <option <?php   if (in_array($cert['cert_id'], $candidate_certifications)){ ?> selected="selected" <?php  } ?>  value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
                    <?php }?>
                    </select>
                    </td>
                </tr>
                
                
                <tr>
                    <td>Domain Knowledge</td>
                    <td> <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_domain" name="domain[]" style="width: 970px;">
                    <?php foreach($domain as $dom){?>
                    <option <?php   if (in_array($dom['domain_id'], $candidate_domain)){ ?> selected="selected" <?php  } ?>  value="<?php echo $dom['domain_id'];?>"><?php echo $dom['domain_name'];?></option>
                    <?php }?>
                    </select>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" id="step7-msg">                
                    </td>
                    </tr>
                <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="button" class="attach-subs" value="SAVE" id="edit_candidate7" style="width:180px;">
                    
                    </span>
                	</td>
                </tr>
            </tbody>
        </table>

</form>
	<?php if(isset($formdata['profile_list']['6'])){?>
    <div class="ScrollStyle">
    <table align="left"  border="1" style="margin-top:5%" width="40%">
        <tr>
        <th align="center">Technical Details</th>
        </tr>
        <tr>
        <td><?php if(isset($formdata['profile_list']['6']))echo $formdata['profile_list']['6'];?></td>
        </tr>
    </table>
    </div>
    <?php } ?>
        
	<?php if(isset($formdata['profile_list']['7'])){ ?>
    <div class="ScrollStyle">
    <table align="center" border="1" style="margin-top:5%" width="40%">
            <tr>
            <th align="center">Certification Details</th>
            </tr>
            <tr>
            <td><?php if(isset($formdata['profile_list']['7']))echo $formdata['profile_list']['7'];?></td>
            </tr>
    </table>
    </div>
	<?php } ?>
    
    <?php if(isset($formdata['profile_list']['8'])){ ?>
    <div class="ScrollStyle">
    <table align="center" border="1" style="margin-top:1%" width="40%">
            <tr>
            <th align="center">Domain Details</th>
            </tr>
            <tr>
            <td><?php if(isset($formdata['profile_list']['8']))echo $formdata['profile_list']['8'];?></td>
            </tr>
    </table>
    </div>
	<?php } ?>
<div style="clear:both;"></div>
</div>
</div>
<!--END CERTIFICATIOn DETAILS-->

<!--BEGIN EDUCATION DETAILS -->
<div id ="step3" >

<!--<div class="table-tch specs hor" style="border-bottom: 1px solid #aeaeae;">-->
<div class="table-tech spes hor">
<div class="col-md-12 col-sm-12" style="border-bottom:1px solid #aeaeae;">
<div class="col-md-6 col-sm-6">

<form class="form-horizontal form-bordered"  method="post" id="candidate_form3" name="candidate_form3" >
<h2>Education Details</h2> 

    <table class="hori-form">
        <tbody>
        
            <tr>
                 <td>Level of Study</td>
                 <td> <?php echo form_dropdown('level_id',  $edu_level_list, '','class="js-example-basic-single  form-control edu-field" id="level_id"');?> </td>
            </tr>
            <tr>
                 <td>Course</td>
                 <td> <?php echo form_dropdown('course_id',  $edu_course_list, '','class="form-control edu-field js-example-basic-single" id="course_id_edu"');?> </td>
            </tr>
            <tr>
                <td>Specialization/Industry</td>
                 <td> <?php echo form_dropdown('spcl_id',  $edu_spec_list, '','class="form-control edu-field js-example-basic-single" id="spcl_id"');?> </td>
            </tr>
            <tr>
                 <td>University</td>
                 <td> <?php echo form_dropdown('univ_id',  $edu_univ_list, '','class="form-control edu-field js-example-basic-single" id="univ_id"');?> </td>
            </tr>
            
            <tr>
                 <td>College</td>
                 <td> <?php echo form_dropdown('college_id',  $edu_coll_list, '','class="form-control edu-field js-example-basic-single" id="coll_id"');?> </td>
            </tr>
            
            <tr>
                 <td>Year</td>
                 <td> <?php echo form_dropdown('edu_year',  $edu_years_list, '','class="form-control edu-field js-example-basic-single" id="edu_year"');?> </td>
            </tr>
            <tr>
                 <td>Country</td>
                 <td> <?php echo form_dropdown('edu_country',  $country_list, '','class="form-control edu-field js-example-basic-single" id="edu_country"');?> </td>
            </tr>
            <tr>
                 <td>Course Type</td>
                 <td> <?php echo form_dropdown('course_type_id',  $edu_course_type_list, '','class="form-control edu-field js-example-basic-single" id="course_type_id"');?> </td>
            </tr>
            
            
            <tr>
            <td>Arrears</td>
             <td> <input style="width:100px;" class="form-control  edu-field" placeholder="arrears"  type="text"  name="arrears" value="" id="arrears"> </td>
            </tr>
            
            <tr>
            <td>Absesnce</td>
             <td> <input style="width:100px;" class="form-control edu-field" placeholder="absesnse"  type="text"  name="absesnse" value="" id="absesnse"> </td>
            </tr>
            
            <tr>
            <td>Repeat</td>
             <td> <input style="width:100px;" class="form-control  edu-field" placeholder="repeat"  type="text"  name="repeat" value="" id="repeat"> </td>
            </tr>
            
            <tr>
            <td>Year Back</td>
             <td> <input style="width:100px;" class="form-control  edu-field" placeholder="year back"  type="text"  name="year_back" value="" id="year_back"> </td>
            </tr>
            
            <tr>
            <td>Total Percentage</td>
             <td> <input style="width:100px;" class="form-control  edu-field" placeholder="mark percentage"  type="text"  name="mark_percentage" value="" id="mark_percentage"> </td>
            </tr>
            
            <tr>
            <td>Grade</td>
             <td> <input style="width:100px;" class="form-control  edu-field" placeholder="grade"  type="text"  name="grade" value="" id="grade"> </td>
            </tr>
            <tr>
            <td colspan="2" id="step4-msg">
            
            </td>
            </tr>
            <tr>
            <td colspan="2">
            <span class="click-icons">
            <input type="button" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;">
            
            </span>
            </td>
            </tr>
        </tbody>
    </table>

</form>
<?php if(isset($formdata['profile_list']['3'])){ ?>
<div class="ScrollStyle">
<table align="center"  border="0" style="margin-top:5%;" width="80%">
<tr>
<td><?php if(isset($formdata['profile_list']['3']))echo $formdata['profile_list']['3'];?></td>
</tr>
</table>
</div>
<?php } ?>
<div style="clear:both;">
</div>
</div>

<div class="col-md-6 col-sm-6">
<span id="edu_details">
<?php echo $edu_view; ?>
</span>

</div>

</div>
</div>


</div>

<!--END EDUCATION DETAILS-->



<!--BEGIN JOB DEATILS-->
<div id ="step4" >

<div class="table-tech spes hor" >
<div class="col-md-12 col-sm-12" style="border-bottom:1px solid #aeaeae;">
<div class="col-md-6 col-sm-6">
<form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" > 
<h2>Job Details</h2>
    <table class="hori-form">    
        <tbody>
                <tr>                
                    <td>Organization Name</td>
                    <td><input class="form-control hori job-field" type="text" name="organization" value="" id="organization"></td>
                </tr>
                
                <tr>
                    <td>Designation</td>
                    <td><input class="form-control hori job-field" type="text" name="designation" value="" id="designation">
                </td>
                </tr>
                
                <tr>
                     <td>Industry</td>
                     <td> <?php echo form_dropdown('job_cat_id',  $industries_list, '','class="form-control job-field" id="job_cat_id"');?> </td>
                </tr>
                <tr>
                     <td>Category</td>
                     <td> <?php echo form_dropdown('job_cat_id',  $industry_list, '','class="form-control job-field" id="job_cat_id"');?> </td>
                </tr>
                
                <tr>
                     <td>Function/Role</td>
                     <td> <?php echo form_dropdown('func_id',  $functional_list, '','class="form-control job-field" id="func_id"');?> </td>
                </tr>
                
                
                <tr>
                    <td>Responsibilities</td>
                    <td>
                    <input class="form-control hori job-field" type="text" name="responsibility" value="" id="responsibility">
                    </td>
                </tr>
                
                <tr>
                    <td>From Date</td>
                    <td><input class="form-control hori datepicker job-field" type="text" name="from_date" id="datepickfrom" readonly
                    value="<?php echo $formdata['from_date'];?>" placeholder="Enter From Date Date YYYY-MM-DD"></td>
                </tr>
                <tr>
                    <td>To Date</td>
                    <td><input class="form-control hori datepicker job-field" type="text" readonly name="to_date" id="datepickto" value=""
                     placeholder="Enter To Date Date YYYY-MM-DD"></td>
                </tr>
                
                <tr>
                    <td>Current Salary</td>
                    <td><input type="hidden" name="currency_id" value="0" />
                    <input class="form-control hori job-field" type="text" name="monthly_salary" value=""  id="monthly_salary"></td>
                </tr>
                
                
                <tr>
                    <td>Is this your present job ?</td>
                    <td> 
                    <label class="radio-inline">
                    <input class="job-field" type="radio" name="present_job" id="present_job" value="1">Yes</label>
                    <label class="radio-inline">
                    <input class="job-field" type="radio" name="present_job" id="present_job" value="0">No</label>
                    
                    </td>
                </tr>
                                
                <tr>
                    <td>Total Experience</td>
                    <td> <?php echo form_dropdown('exp_years',  $years_list,'','class="form-control job-field" id="exp_years"');?>&nbsp; <?php echo form_dropdown('exp_months',  $months_list, '','class="form-control job-field" id="exp_months"');?>
                    </td>	
                </tr>
                               
                <tr>
                    <td>Skills</td>
                    <td>
                    <input class="form-control hori job-field" type="text" name="skills" id="skills" value="" placeholder="Enter your Skills ">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2" id="step5-msg">                
                    </td>
                </tr>
               
                <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="button" class="attach-subs" value="Save" id="edit_candidate4" style="width:180px;">
                    
                    </span>
                    </td>
                </tr>
        </tbody>
    </table>

</form>
<?php if(isset($formdata['profile_list']['4'])){ ?>
<div class="ScrollStyle">
<table align="center" border="1" style="margin-top:5%;" width="80%">
<tr>
<td><?php if(isset($formdata['profile_list']['4']))echo $formdata['profile_list']['4'];?></td>
</tr>
</table>
</div>
<?php } ?>
<div style="clear:both;"></div>
</div>


<div class="col-md-6 col-sm-6">
<span id="job_details">
<?php echo $job_view; ?>
</span>

</div>

</div>
</div>


</div>
<!--END JOB DEATILS-->

<!--BEGIN FILE DETAILS-->
<div id ="step5">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/search_cvs/editfiles" enctype="multipart/form-data"> 
 
    <table class="hori-form">
        <tbody>
                <tr><td><h2>Update CV & Photo</h2></td></tr>
                <tr>
                    <td>Upload your CV</td>
                    <td> 
                    <?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?>
                    </td>
                    <td id="cv">
<!--                    <?php if($formdata['cv_file']!=''){?><span id="cv-span"><a href="<?php echo base_url().'uploads/cvs/'.$formdata['cv_file'];?>" target="_blank" style="color:#0033FF">Download CV</a> &nbsp;||&nbsp;<a href="javascript:;" id="del-cv" style="color:#0033FF">Delete CV</a> </span><?php } ?>-->
                    </td>
                </tr>
               
                <tr>
                    <td>Upload your Photo</td>
                    <td> 
                    <?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?>
                    
                    </td>
                    <td id="photo">
<!--                    <?php if($formdata['photo']!=''){?><span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$formdata['photo'];?>" class="profile_img" style="width:158px;height:100px;"><br /><br /><a href="javascript:;" id="del-photo" style="color:#0033FF">Delete Photo</a>&nbsp;&nbsp;</span> <?php } ?> -->
                    </td>
                </tr>
                              <!--  <tr>
                    <td>Do you completed data updation?</td>
                    <td><input id="profile_completion" type="radio"  <?php if( $formdata['profile_completion']==3){?> checked <?php }?> name="profile_completion" value="3"   />Yes &nbsp;
                    <input type="radio" name="profile_completion" value="2" id="profile_completion"  <?php if( $formdata['profile_completion']!=3){?> checked <?php }?> />No 
                    &nbsp;&nbsp;</td>
                </tr>-->
                <tr>
                    <td colspan="2" id="step6-msg">
                    
                    </td>
                </tr>
               
                <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="submit" class="attach-subs" value="Save" id=""  style="width:180px;">
                    
                    </span>
                    </td>
                </tr>
        </tbody>
    </table>
<input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id"></div>
<div id="success"></div>
</form>
<div style="clear:both;"></div>
</div>

<!--END FILE DETAILS-->
<div id ="step6" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="" name=""   action="<?php echo site_url('search_cvs/profile_completion'); ?>/<?php echo $candidate_id ?>" > 
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

<table align="left" width="60%">

<tr>
<td>
<table class="hori-form">
<tbody>
                 
                 <tr>
                    <td>Do you completed data updation?</td>
                    <td><input id="profile_completion" type="radio"  <?php if( $formdata['profile_completion']==3){?> checked <?php }?> name="profile_completion" value="3"   />Yes &nbsp;
                    <input type="radio" name="profile_completion" value="2" id="profile_completion"  <?php if( $formdata['profile_completion']!=3){?> checked <?php }?> />No 
                    &nbsp;&nbsp;</td>
                </tr>



</tbody>
</table>

</td>


</tr>

<tr>
<td colspan="2" id="step1-msg">

</td>
</tr>
<tr>
<td align="center">



                    
<input type="submit" class="attach-subs tools" value="Done" id="" style="width:180px;">
        | 
        &nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('candidates'); ?>" class="attach-subs tools">
        <img src="http://localhost/recruitment-hub/admin/assets/images/plus.png">Back to Listing</a>
  
</td>
</tr>
</tbody>
</table>



</form>
<div style="clear:both;"></div>


</div>
<!--END JOB DEATILS-->


</div>
</div>
</div>
</div>
</section>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- form ends here-->
    
    <!-- centercontent -->
</div><!--bodywrapper-->
<!--<style> .bigdrop {
    width: 600px !important;
}</style>-->
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script src="<?php echo base_url('assets/js/jquery-ui.js');?>" ></script>
<script>

$('#simple').hide();
$('#multiple_cert').addClass('form-control hori');
$('#multiple_skill').addClass('form-control hori');
$(".js-example-basic-multiple-cert").select2();
$(".js-example-basic-single").select2();

show_cv_photo('<?php echo $candidate_id;?>');
function show_cv_photo(candidate_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {candidate_id:candidate_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/search_cvs/show_cv_photo/',
	
	   success: function(data){
		
	
			$('#cv').html(data.cv);
			$('#photo').html(data.photo);
	   }
			
	 }); 
}

//BEGIN FILE DETAILS


	   $('#candidate_form5').submit(function(evt){
		evt.preventDefault();
	   	var formData = new FormData(this);
	 
		
		//if(isContactValid) {

			$.ajax({
				type: "post",
				url: "<?php echo $this->config->site_url();?>/search_cvs/editfiles",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,

				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['success']=='true') 
						{
							$('#step6-msg').show();
							
							$('#step6-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>CV & Photo Updated Successfully</strong></div>');	
							$('#step6-msg').fadeOut(6000);
							
							show_cv_photo('<?php echo $candidate_id;?>');
                           
                           
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
		//} //end contact valid
   });//end button click function save*/
//END FILE DETAILS

function profile_complete() 
{
	var candidateId = '<?php echo $candidate_id ?>';
	//alert(candidateId);
	$.ajax({
		type: "post",
		url: "<?php echo site_url('search_cvs/check_profile_complete'); ?>"+'/'+candidateId,
		success: function(ret){
			
			if(ret['STATUS']==1) 
			{	
				return true;
			}
			else
			{return false;}
		}  
	}); 
}


function myFunction()
{
	
	var parnt =$('#parent').val();
	if(parnt!='')
	{
	
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
	else{
		$('#skill-tr').hide();
		$('#multiple_skill').val('');
		$('#multiple_skill').html('');
	}
}

function create_checkbox(res)
{ 
	var skillset=res['skillset'];
	var count=skillset['length'];
	

	if(count>0)
	{
	$('#skill-tr').show();
	$('#multiple_skill').val('');
	$('#multiple_skill').html('');
	$('#multiple_skill').append('<option value="">Select Skills</option>');
	for(var k=0;k<count;k++)
	{   

		var option	=	'<option value="'+skillset[k]['skill_id']+'">'+skillset[k]['skill_name']+'</option>';
		
		$('#multiple_skill').append(option);

	}
	}
	else{
		$('#skill-tr').hide();
		$('#multiple_skill').val('');
		$('#multiple_skill').html('');
	}
	
}




var userFlag = 0;
$( document ).ready(function() {
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
	
	$('#issued_date').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});	
	
	$('#expiry_date').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});
   function candidate_validate() {
		
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   
		if($('#username').val()=='')
		{
			alert('Enter email');
			$('#username').focus();
			return false;
		}
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test($('#username').val())){
			alert('Enter valid email');
			$('#username').focus();
			return false;
		}
		/*if($('#mobile').val()=='')
		{
			alert('Enter mobile');
			$('#mobile').focus();
			return false;
		}*/		
	    return true;
    }
   $('#edit_candidate').click(function(){
		var dataStringprop = $("#candidate_form").serialize();
			
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/editCandidate'); ?>",
				cache: false,				
				data: dataStringprop,
				success: function(json){ 
					try{		
						var ret = jQuery.parseJSON(json);
						$('#hdstep1').val(ret['SUCCESS_ID']);
						if(ret['STATUS']==1) {
							$('#step1-msg').show();
							
							$('#step1-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Personal Details Updated Successfully</strong></div>');	
							$('#step1-msg').fadeOut(6000);

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
		var profile = profile_complete();
   });//end button click function save*/
   
//CONTACT DETAILS VALIDATION AND SUBMIT
	function candidate_validate1() 
	{
		if($('#address').val()=='')
		{
			alert('Enter contact Address ');
			$('#address').focus();
			return false;
		} 
		return true;
	}

  
	
   $('#edit_candidate1').click(function(){
		var dataStringprop = $("#candidate_form1").serialize();
		
		var isContactValid = candidate_validate1();
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/editCandidateDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step2-msg').show();
							
							$('#step2-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Contact Details Updated Successfully</strong></div>');	
							$('#step2-msg').fadeOut(6000);
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
		var profile = profile_complete();
   });//end button click function save*/
   
//END CONTACT DETAILS VALIDATION AND SUBMIT

//BEGIN PASSPORT DETAILS

   function candidate_validate2() {
   return true;

    }
   $('#edit_candidate2').click(function(){ 
		var dataStringprop = $("#candidate_form2").serialize();
		
		var isContactValid = candidate_validate2();
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/editPassportDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step3-msg').show();
							
							$('#step3-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Language Details Updated Successfully</strong></div>');	
							$('#step3-msg').fadeOut(6000);
						   
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		} //end contact valid
		var profile = profile_complete();
   });//end button click function save*/

//END PASSPORT DETAILS

//BEGIN SKILLS AND CERTIFICATE
   $('#edit_candidate7').click(function(){ 
		var dataStringprop = $("#candidate_form7").serialize(); 
		
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/editSkillCertificateDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){ 
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step7-msg').show();
							
							$('#step7-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Skill and Certificate Details Updated Successfully</strong></div>');	
							$('#step7-msg').fadeOut(6000);
						   
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		//} //end contact valid
		var profile = profile_complete();
   });//end button click function save*/

//END SKILLS AND CERTIFICATE DETAILS

//BEGIN EDUCATION DEATILS

   function candidate_validate3() {
/*		if($('#level_id').val()==0)
		{
			alert('Select Level');
			$('#level_id').focus();
			return false;
		}   
*/		if($('#course_id').val()==0)
		{
			alert('Select course');
			$('#course_id').focus();
			return false;
		}
/*		if($('#spcl_id').val()==0)
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
*/	    return true;
    }
   $('#save_candidate3').click(function(){
		var dataStringprop = $("#candidate_form3").serialize();
		
		var isContactValid = candidate_validate3();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/addEducationDetail'); ?>"+'/'+candidateId,
				cache: false,
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step4-msg').show();
							
							$('#step4-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Education Details Added Successfully</strong></div>');	
							$('#step4-msg').fadeOut(6000);//edu_details
							$('#edu_details').html('');
							$('#edu_details').html(ret['VIEW']);//edu-field
							$('.edu-field').val('');
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
		var profile = profile_complete();
   });//end button click function save*/

//END EDUCATION DETAILS

//BEGIN PANNING JOB DEATILS

   function candidate_validate8() {
	    return true;
    }
   $('#edit_candidate8').click(function(){
		var dataStringprop = $("#candidate_form8").serialize();
		var isContactValid = candidate_validate8();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/editJobChangeDetail'); ?>"+'/'+candidateId,
				cache: false,
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step8-msg').show();
							
							$('#step8-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Job Change Details Updated Successfully</strong></div>');	
							$('#step8-msg').fadeOut(6000);//edu_details

						}
					}
					catch(e) {		
						alert('Exception occured while updating job change.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
   });//end button click function save*/

//END PANNING JOB DETAILS


//BEGIN DELETE EDUCATION
	$(document).on('click','.edu-delete',function()
	{ 
		var $this	=	$(this);
		var edu_id	=	$this.data('id');
		var candidateId = '<?php echo $candidate_id ?>';
		var isconfirm	=	confirm_delete();
		if(isconfirm){
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/deleteEducationDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: { edu_id:edu_id},
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							
							$('#step4-msg').show();
							$('#step4-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Education Details Deleted Successfully</strong></div>');
							$('#step4-msg').fadeOut(6000);
							
							$('#edu_details').html('');
							$('#edu_details').html(ret['VIEW']);//edu-field
							$('.edu-field').val('');
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
		}//end cofirm
		var profile = profile_complete();
   
	});//end button click function delete*
//END DELETE EDUCATION

//BEGIN JOB DETAILS

   function candidate_validate4() {
   //return true;
		if($('#organization').val()=='')
		{
			alert('Enter Organization');
			$('#organization').focus();
			return false;
		}   
		/*
		if($('#designation').val()=='')
		{
			alert('Enter Designation');
			$('#designation').focus();
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
		if($('#monthly_salary').val()=='')
		{
			alert('Add monthly salary');
			$('#monthly_salary').focus();
			return false;
		}   
		if($('#exp_years').val()=='')
		{
			alert('Add total experience');
			$('#edu_country').focus();
			return false;
		}
		if($('#skills').val()=='')
		{
			alert('Add your skills');
			$('#course_type_id').focus();
			return false;
		}
		*/
	    return true;
    }
   $('#edit_candidate4').click(function(){
		var dataStringprop = $("#candidate_form4").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/addJobDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step5-msg').show();
							$('#step5-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Job Details Added Successfully</strong></div>');	
							$('#step5-msg').fadeOut(6000);
							$('#job_details').html('');
							$('#job_details').html(ret['VIEW']);//edu-field
							$('.job-field').val('');
							}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax

		} //end contact valid
		var profile = profile_complete();
   });//end button click function save*/

//END JOB DETAILS

//BEGIN DELETE JOB
	$(document).on('click','.job-delete',function()
	{ 
		var $this	=	$(this);
		var job_id	=	$this.data('id');
		var candidateId = '<?php echo $candidate_id ?>';
		var isconfirm	=	confirm_delete();
		if(isconfirm){
			$.ajax({
				type: "post",
				url: "<?php echo site_url('search_cvs/deleteJobDetail'); ?>"+'/'+candidateId,
				cache: false,				
				data: { job_id:job_id},
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step5-msg').show();
							$('#step5-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Job Details Deleted Successfully</strong></div>');
							$('#step5-msg').fadeOut(6000);
							
							$('#job_details').html('');
							$('#job_details').html(ret['VIEW']);
							$('.job-field').val('');
						}
					}
					catch(e) {		
						alert('Exception occured while adding candidate.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}
			});//end ajax
	 }
	 var profile = profile_complete();
   
	});//end button click function delete*
//END DELETE JOB

//DELETE CONFIRMATION
	function confirm_delete()
	{
		if(confirm('Are You Sure Want To Delete?')){
			return true;
		}
		else{
			return false;
		}
	}
//END DELTE CONFIRMATION



//BEGIN DELETE PHOTO
	$(document).on('click','#del-photo',function()
	{ 

		var candidateId = '<?php echo $candidate_id ?>';
		var isconfirm	=	confirm_delete();
		if(isconfirm){
		$.ajax({
			type: "post",
			url: "<?php echo site_url('search_cvs/photo_delete'); ?>"+'/'+candidateId,
			cache: false,				
			
			success: function(json){
				try{		
					var ret = jQuery.parseJSON(json);
					if(ret['STATUS']==1) {
						
						$('#step6-msg').show();
						$('#step6-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Photo Deleted Successfully</strong></div>');
						$('#step6-msg').fadeOut(6000);
						$('#imgTab2').remove();

					}
				}
				catch(e) {		
					alert('Exception occured while adding candidate.');
				}		
			},
			error: function(){						
				alert('An Error has been found on Ajax request from contact save');
			}
		});//end ajax
		}
	
   
	});//end button click function delete*
//END DELETE PHOTO

//BEGIN DELETE CV
	$(document).on('click','#del-cv',function()
	{ 

		var candidateId = '<?php echo $candidate_id ?>';
		var isconfirm	=	confirm_delete();
		if(isconfirm){
		$.ajax({
			type: "post",
			url: "<?php echo site_url('search_cvs/cv_delete'); ?>"+'/'+candidateId,
			cache: false,				
			
			success: function(json){
				try{		
					var ret = jQuery.parseJSON(json);
					if(ret['STATUS']==1) {
						
						$('#step6-msg').show();
						$('#step6-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>CV Deleted Successfully</strong></div>');
						$('#step6-msg').fadeOut(6000);
						$('#cv-span').remove();

					}
				}
				catch(e) {		
					alert('Exception occured while adding candidate.');
				}		
			},
			error: function(){						
				alert('An Error has been found on Ajax request from contact save');
			}
		});//end ajax
		}
	
   
	});//end button click function delete*
//END DELETE CV

});   // end document.ready


</script>


<!--START FETCHING STATE,CITY,LOCATION-->

<script type="text/javascript">
$('#country_id').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');
		
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/search_cvs/getstate/',
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
		  url: '<?php echo $this->config->site_url();?>/search_cvs/getcity/',
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
				  jQuery('#city_id').append(data.city_list);

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
		  url: '<?php echo $this->config->site_url();?>/search_cvs/getlocation/',
		  data: { city_id: $('#city_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#location_id').html('');
				jQuery('#location_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){              
			  if(data.success==true)
			  {
                     jQuery('#location_id').html('');                              				  									 					jQuery('#location_id').append(data.location_list);

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

	$('#level_id').change(function() 
	{
	
		jQuery('#course_id_edu').html('');
		jQuery('#course_id_edu').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/search_cvs/getcourses/',
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
					  jQuery('#course_id_edu').append(data.course_list);

					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
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
	
//ORGANISATION AUTO COMPLETE
 $('#organization').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
    $element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/search_cvs/get_all_organisation', type: "GET", data:{organization: $('#organization').val()},dataType: "json", success:function(data) 																																							   {
		 if (data == null) 
		 {
		  $(".ui-autocomplete").hide();
		 } else 
		 {
		  response(data);
		 }
   }                                              
   }));
  },
  select: function(event, ui) {
    // window.location.href = ui.item.url;
  },
 });
 
//designation AUTO COMPLETE
 $('#designation').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
    $element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/search_cvs/get_all_designation', type: "GET", data:{designation: $('#designation').val()},dataType: "json", success:function(data) {
     if (data == null) {
      $(".ui-autocomplete").hide();
     } else {
      response(data);
     }
                                              }                                              }));
  },
  select: function(event, ui) {
    // window.location.href = ui.item.url;
  },
 });
 
//RESPONSIBILTY AUTO COMPLETE
 $('#responsibility').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
    $element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/search_cvs/get_all_responsibility', type: "GET", data:{responsibility: $('#responsibility').val()},dataType: "json", success:function(data) {
     if (data == null) {
      $(".ui-autocomplete").hide();
     } else {
      response(data);
     }
                                              }                                              }));
  },
  select: function(event, ui) {
    // window.location.href = ui.item.url;
  },
 });
 
 //onchange of job_category

	$('#job_cat_id').change(function() 
	{
	
		jQuery('#func_id').html('');
		jQuery('#func_id').append('<option value="">Select Function</option');
			
		if($('#job_cat_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/search_cvs/getfunction/',
			  data: { category_id: $('#job_cat_id').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#func_id').html('');
					  jQuery('#func_id').append(data.function_list);

					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Please try again');
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Select Function</option');
			  }
			});	
	});
 
</script>
<!--END FETCHING STATE,CITY,LOCATION-->