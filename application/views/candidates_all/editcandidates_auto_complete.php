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
<script src="<?php echo base_url('assets/js/jquery-ui.js');?>" ></script>
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


<div class="clearfix">
    <a href="<?php echo $this->config->site_url();?>/candidates_all" class="attach-subs subs pull-right">Listing</a>
    <a href="<?php echo $this->config->site_url();?>/candidates/profile_entry/<?php echo $candidate_id; ?>" class="attach-subs subs pull-right">Raw Data</a>
</div>

<div class="row">
	<div class="col-sm-6">

<table width="79%" class="hori-form">
   
    

    
    <tbody>
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form" name="candidate_form" >             
            <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
            <h2 class="srevHd">Personal Details</h2>
            
                <tr>
                    <td width="40%">Title</td>
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

				<tr>
                    <td>Linkedin URL</td>
                    <td><input class="form-control hori" type="text" name="linkedin_url" value="<?php echo $formdata['linkedin_url'];?>" id="linkedin_url"></td>
                </tr>                

				<tr>
                    <td>Facebook URL</td>
                    <td><input class="form-control hori" type="text" name="facebook_url" value="<?php echo $formdata['facebook_url'];?>" id="facebook_url"></td>
                </tr>  

                <tr>
                    <td>Job Folder</td>
                     <td>	
                            <select name="job_folder_id" id="job_folder_id" class="js-example-basic-single">

                            <?php foreach($job_folders as $key => $value){ ?>
                            <option <?php if($formdata['job_folder_id']==$key){?> selected="selected" <?php } ?> value="<?php echo $key; ?>"><?php echo $value; ?> 
                         </option>
                            <?php
                            }?>
                            </select> 
                     </td>
                </tr>
                
                
                <tr>
                   <td>Present Job Status</td>
                   <td>
<input id="cur_job_status" type="radio" name="cur_job_status" value="1"  <?php if($formdata['cur_job_status']==1)echo 'checked="checked"';?>  />No Job <br>

<input id="cur_job_status" type="radio" name="cur_job_status" value="2"  <?php if($formdata['cur_job_status']==2)echo 'checked="checked"';?>  />Working, But Need a Change <br>

<input id="cur_job_status" type="radio" name="cur_job_status" value="3"  <?php if($formdata['cur_job_status']==3)echo 'checked="checked"';?>  />Not Interested <br>

<input id="cur_job_status" type="radio" name="cur_job_status" value="4"  <?php if($formdata['cur_job_status']==4)echo 'checked="checked"';?>  />Seeking Good Opportunity <br>

<input id="cur_job_status" type="radio" name="cur_job_status" value="5"  <?php if($formdata['cur_job_status']==5)echo 'checked="checked"';?>  />Need a change
 <br>
<input id="cur_job_status" type="radio" name="cur_job_status" value="6"  <?php if($formdata['cur_job_status']==6)echo 'checked="checked"';?>  />Call after 1 Year <br>
    <input id="cur_job_status" type="radio" name="cur_job_status" value="7"  <?php if($formdata['cur_job_status']==7)echo 'checked="checked"';?>  />Call after this month    <br>  
                   </td>
                 </tr>
                 
                 
                <tr>
                    <td>Reg Status</td>
                    <td><input id="reg_status" type="radio" name="reg_status" value="1"  <?php if($formdata['reg_status']==1)echo 'checked="checked"';?>  />Registered&nbsp;
                    <input type="radio" name="reg_status" value="2" id="reg_status"  <?php if($formdata['reg_status']==2)echo 'checked="checked"';?> />Placed                   
                   </td>
                </tr>
                
                <tr>
                    <td>Lead Opportunity</td>
                    <td><input id="lead_opportunity" type="radio" name="lead_opportunity" value="1"  <?php if($formdata['lead_opportunity']==1)echo 'checked="checked"';?> />Cold 
                    &nbsp;<input type="radio" name="lead_opportunity" value="2" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==2)echo 'checked="checked"';?>/>
                    Warm &nbsp;&nbsp;<input id="lead_opportunity" type="radio" name="lead_opportunity" value="3"  <?php if($formdata['lead_opportunity']==3)echo 
                    'checked="checked"';?>  />Hot &nbsp;&nbsp;<input type="radio" name="lead_opportunity" value="0" id="lead_opportunity"  
                    <?php if($formdata['lead_opportunity']==0)echo 'checked="checked"';?> />Unknown&nbsp;</td>
                </tr>
                
               <tr>
                    <td>Lead Source</td>
                    <td>
 <input id="lead_source" type="radio" name="lead_source" value="1"  <?php if($formdata['lead_source']==1)echo 'checked="checked"';?> />By Admin 
                    &nbsp;
  <input type="radio" name="lead_source" value="2" id="lead_source"  <?php if($formdata['lead_source']==2)echo 'checked="checked"';?>/>
                    Online &nbsp;&nbsp;
 <input id="lead_source" type="radio" value="3" name="lead_source"   <?php if($formdata['lead_source']==3)echo 
                    'checked="checked"';?>  />Linkedin &nbsp;&nbsp;
 <input type="radio" name="lead_source" value="4" id="lead_source" <?php if($formdata['lead_source']==4)echo 'checked="checked"';?> />Facebook&nbsp;&nbsp; 
 <input type="radio" name="lead_source" value="5" id="lead_source" <?php if($formdata['lead_source']==5)echo 'checked="checked"';?> />Others&nbsp;&nbsp;</td>
                </tr>
                
                <tr>
                    <td colspan="2" id="step1-msg">
                    
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                    <span class="clearfix"> <!--- old Class: click-icons -->
                    <input type="button" class="attach-subs" value="Save" id="edit_candidate" style="width:180px;"><!--<input type="button" class="attach-subs subs" value="Skip" id="skip">
                    <!--<input type="button" class="attach-subs subs" value="Skip" id="skip">-->
                    <!--<a href="<?php echo $this->config->site_url();?>/data_entry/summary/<?php echo $formdata['candidate_id'] ?>" class="attach-subs subs">Done</a>-->
                    </span>
                    </td>
                </tr>
            </form>
    </tbody>
</table>

</div>

<div class="col-sm-6">
<br>
<?php if(isset($formdata['profile_list']['1'])){ ?><div class="ScrollStyle">
<table align="center"  border="0" style="margin-top:5%;" width="90%">
    <tr>
    <td><?php if(isset($formdata['profile_list']['1']))echo html_entity_decode($formdata['profile_list']['1']);?></td>
    </tr>
</table></div>
<?php } ?>

	</div>
</div>

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
 						<input class="form-control datepicker hori " readonly type="text" value="<?php echo $formdata['job_date'];?>" name="job_date" 
                        id="datepickfrom1"  
                        placeholder="Enter From Date YYYY-MM-DD"> 

                    </td>	
                </tr>
                
                <tr>
                    <td>Current CTC</td>
                    <td><input class="form-control hori" value="<?php echo $formdata['current_ctc'];?>" type="text" name="current_ctc" 
                    id="current_ctc"> </td>
                </tr>
                
                <tr>                
                    <td>Expected CTC</td>
                    <td><input class="form-control hori" value="<?php echo $formdata['expected_ctc'];?>" type="text" name="expected_ctc"
                    id="expected_ctc"></td>

                </tr>
                
                <tr>
                    <td>Notice Period</td>
                     <td>	
                            <select name="notice_period" id="notice_period" class="js-example-basic-single">
                            <option value="">Select no of days</option>
                            <?php for($i=1;$i<=200;$i++){
                            ?>
                            <option <?php if($formdata['notice_period']==$i){?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?> 
                            Days</option>
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
                            <option <?php if($formdata['total_experience']==$i){?> selected="selected" <?php } ?> value="<?php echo $i; ?>"><?php echo $i; ?> 
                            Years</option>
                            <?php
                            }?>
                            </select>
                    </td>
                </tr>
               
                <tr>
                    <td>Present Location</td>
                    <td> <input class="form-control hori job-field" type="text" name="present_location" value="<?php echo $formdata['present_location'];?>" 
                    id="present_location">
                 
                    </td>
                </tr>
               
                             
                <tr>
                    <td>Preferred  Location</td>
                    <td><input class="form-control hori job-field" type="text" name="preferred_location" value="<?php echo $formdata['preferred_location'];?>" 
					id="preferred_location"> 
					
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
                    <span class="clearfix">
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
  <h2>Contact Details</h2>

<div class="row">
	<div class="col-sm-6">

<form class="form-horizontal form-bordered"  method="post" id="candidate_form1" name="candidate_form1" > 

        <table class="hori-form">
        	<tbody>

                <tr>
                    <td>Nationality</td>
                    <td>  
 
                   <?php 
					
					$id='';
					$value	=	'';
					foreach($country_list as $key=>$val)
					{

						if($formdata['nationality'] !='' && $formdata['nationality']==$key)
						{ 
							$id	=	$key;
							$value	=	$val;
						}
						
					}
					
					?>

                  	<input class="form-control hori country" type="text" name="country"  value="<?php echo $value; ?>" id="country">
                     
                    <input class="form-control hori " type="hidden" name="country_id"  value="<?php echo $id; ?>" id="country_id">
                 
                    </td>	
                </tr>
                
                <tr>
                    <td>State</td>
                    <td>
                    
                    <?php 
					
					$id='';
					$value	=	'';
					foreach($state_list as $key=>$val)
					{

						if($formdata['state'] !='' && $formdata['state']==$key)
						{ 
							$id	=	$key;
							$value	=	$val;
						}
						
					}
					?>
                    <input class="form-control hori " type="text" name="state"  value="<?php echo $value; ?>" id="state">
                    <input class="form-control hori " type="hidden" name="state_id"  value="<?php echo $id; ?>" id="state_id">
                    
                    
                    </td>
                </tr>
                
                <tr>                
                    <td>City</td>
                    <td>
                    <?php 
					
					$id='';
					$value	=	'';
					foreach($city_list as $key=>$val)
					{

						if($formdata['city_id'] !='' && $formdata['city_id']==$key)
						{ 
							$id	=	$key;
							$value	=	$val;
						}
						
					}
					?>
                    <input class="form-control hori " type="text" name="city"  value="<?php echo $value; ?>" id="city">
                    <input class="form-control hori " type="hidden" name="city_id"  value="<?php echo $id; ?>" id="city_id">
                    
<!--                    <?php echo form_dropdown('city_id',  $city_list, $formdata['city_id'],'class="form-control js-example-basic-single" id="city_id" style="width:100%;"');?>-->
                    </td>
                </tr>
                
                <tr>
                    <td>Current location</td>
                     <td> 
					 
                   <?php 
					
					$id='';
					$value	=	'';
					foreach($location_list as $key=>$val)
					{

						if($formdata['current_location'] !='' && $formdata['current_location']==$key)
						{ 
							$id	=	$key;
							$value	=	$val;
						}
						
					}
					?>
                    <input class="form-control hori " type="text" name="location"  value="<?php echo $value; ?>" id="location">
                    <input class="form-control hori " type="hidden" name="location_id"  value="<?php echo $id; ?>" id="location_id">
                    
<!--					 <?php echo form_dropdown('current_location',  $location_list, $formdata['current_location'],'class="form-control js-example-basic-single" id="location_id" style="width:100%;"');?>--> 
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

   
                <tr>
                    <td colspan="2" id="step2-msg">
                    
                    </td>
                </tr>
              
                <tr>                
                    <td colspan="2">
                    <span class="clearfix"> <!--- old Class: click-icons -->
                    <input type="button" class="attach-subs" value="Save" id="edit_candidate1" style="width:180px;">
                    
                    </span>
                	</td>
                </tr>
        </tbody>
	</table>


</form>

</div>

<div class="col-sm-6">

<?php if(isset($formdata['profile_list']['2'])){ ?>
<div class="ScrollStyle">
<table align="center"  border="0" style="margin-top:5%" width="90%">
<tr>
<td><?php if(isset($formdata['profile_list']['2']))echo html_entity_decode($formdata['profile_list']['2']);?></td>
</tr>
</table>
</div>
<?php } ?>

	</div>
</div>

<div style="clear:both;"></div>
</div>
</div>

<!--END CONTACT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step2">
<div class="table-tech specs hor">
  <h2>Language Details</h2>
<div class="row">
	<div class="col-sm-6">
<form class="form-horizontal form-bordered"  method="post" id="candidate_form2" name="candidate_form2" > 

        <table class="hori-form">
            <tbody>
            
                <tr>
                  	<td>10th Marks</td>
                    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_10th" value="<?php if(!empty($lang_details))echo $lang_details[0]['eng_10th'];?>" id="eng_10th"></td>
                </tr>
                
                <tr>
                  	<td>12th Marks</td>
                    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_12th" value="<?php if(!empty($lang_details))echo $lang_details[0]['eng_12th'];?>" id="eng_12th"></td>
                </tr>
                
                <tr>
                  	<td>Graduation Mark</td>
                    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_grad" value="<?php if(!empty($lang_details))echo $lang_details[0]['eng_grad'];?>" id="eng_grad"></td>
                </tr>
                
                <tr>
                  	<td>Post Graduation Mark</td>
                    <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_post_grad" value="<?php if(!empty($lang_details))echo $lang_details[0]['eng_post_grad'];?>" id="eng_post_grad"></td>
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
                    <span class="clearfix">
                    <input type="button" class="attach-subs" value="SAVE" id="edit_candidate2" style="width:180px;">
                    
                    </span>
                </td>
                </tr>
            </tbody>
        </table>

</form>
</div>
<div class="col-sm-6">

<?php if(isset($formdata['profile_list']['5'])){ ?>
<div class="ScrollStyle">
<table align="center" border="0" width="90%">
<tr>
<td><?php if(isset($formdata['profile_list']['5']))echo html_entity_decode($formdata['profile_list']['5']);?></td>
</tr>
</table>
</div>
<?php } ?>

	</div>
</div>


<div style="clear:both;"></div>
</div>
</div>
<!--END PASSPORT DETAILS-->

<!--START CERTIFICATIOn DETAILS-->
<div id ="step7">

<div class="table-tech spes hor">
<div class="col-md-12 col-sm-12" style="border-bottom:1px solid #aeaeae;">
<h2>Technical Skills,Certificates and Domain Knowledge</h2>
<div class="col-md-6 col-sm-6">

<form class="form-horizontal form-bordered"  method="post" id="candidate_form7" name="candidate_form7" > 

        <table class="hori-form">
            <tbody>
            
                <tr>
                    <td>Technical Skills</td>
                    <td> 
                    <select class="js-example-basic-multiple-cert" name="skills[]" multiple="multiple" id="multiple_skill" style="width:300px;">
                    
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
                    <td> <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_cert" name="cert[]" style="width: 300px;">
                    <?php foreach($cerifications as $cert){?>
                    <option <?php   if (in_array($cert['cert_id'], $candidate_certifications)){ ?> selected="selected" <?php  } ?>  value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
                    <?php }?>
                    </select>
                    </td>
                </tr>
                
                
                <tr>
                    <td>Domain Knowledge</td>
                    <td> <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_domain" name="domain[]" style="width: 300px;">
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
                    <div class="clearfix"><br></div>
                    </span>
                	</td>
                </tr>
            </tbody>
        </table>

</div>

<div class="col-md-6 col-sm-6">

<table class="hori-form">
    <tbody>
    
        <tr>
            <td>New Skills</td>
            <td><input class="form-control" type="text" name ="new_skill" id="new_skill" style="width: 300px;"/></td> 
        </tr>
    
        <tr>
            <td>New Cert.</td>
            <td><input class="form-control" type="text" name ="new_cert" id="new_cert" style="width: 300px;"/></td> </td>
        </tr>
   
        <tr>
            <td>New Domain</td>
            <td><input class="form-control" type="text" name ="new_domain" id="new_domain" style="width: 300px;"/></td> 
        </tr>        

        <tr>
            <td colspan="2" id="step7-msg-new">                
            </td>
        </tr>
        
        <tr>
            <td>
            <span class="click-icons">
            <input type="button" class="attach-subs" value="ADD & SAVE" id="edit_candidate7_new" style="width:180px;" >                    
            </span>
            </td>
        </tr>
    </tbody>
</table>




</div>
</form>

</div>
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
                 <td>
                
                  	<input class="form-control hori" type="text" name="level"  value="" id="level">
                     
                    <input class="form-control hori " type="hidden" name="level_id"  value="" id="level_id">
                 </td>
                    
<!--                 <td> <?php echo form_dropdown('level_id',  $edu_level_list, '','class="js-example-basic-single  form-control edu-field" id="level_id"');?> </td>-->
            </tr>
            <tr>
                 <td>Course</td>
                 <td>
                
                  	<input class="form-control hori" type="text" name="course"  value="" id="course">
                     
                    <input class="form-control hori " type="hidden" name="course_id"  value="" id="course_id">
                 </td>
                 
<!--                 <td> <?php echo form_dropdown('course_id',  $edu_course_list, '','class="form-control edu-field js-example-basic-single" id="course_id_edu"');?> </td>-->
            </tr>
            <tr>
                <td>Specialization/Industry</td>
                <td>
                
                  	<input class="form-control hori" type="text" name="spcl"  value="" id="spcl">
                     
                    <input class="form-control hori " type="hidden" name="spcl_id"  value="" id="spcl_id">
                 </td>
<!--                 
                 <td> <?php echo form_dropdown('spcl_id',  $edu_spec_list, '','class="form-control edu-field js-example-basic-single" id="spcl_id"');?> </td>-->
            </tr>
            <tr>
                 <td>University</td>
                 <td>
                
                  	<input class="form-control hori" type="text" name="univ"  value="" id="univ">
                     
                    <input class="form-control hori " type="hidden" name="univ_id"  value="" id="univ_id">
                 </td>
                 
<!--                 <td> <?php echo form_dropdown('univ_id',  $edu_univ_list, '','class="form-control edu-field js-example-basic-single" id="univ_id"');?> </td>-->
            </tr>
            
            <tr>
                 <td>College</td>
                 
                 <td>
                
                  	<input class="form-control hori" type="text" name="coll"  value="" id="coll">
                     
                    <input class="form-control hori " type="hidden" name="coll_id"  value="" id="coll_id">
                 </td>
                 
<!--                 <td> <?php echo form_dropdown('college_id',  $edu_coll_list, '','class="form-control edu-field js-example-basic-single" id="coll_id"');?> </td>-->
            </tr>
            
            <tr>
                 <td>Year</td>
                 <td>
                
                  	<input class="form-control hori" type="text" name="edu_year"  value="" id="edu_year">
                     
                 </td>
                 
<!--                 <td> <?php echo form_dropdown('edu_year',  $edu_years_list, '','class="form-control edu-field js-example-basic-single" id="edu_year"');?> </td>-->
            </tr>
            <tr>
                 <td>Country</td>
                 <td>
                
                  	<input class="form-control hori" type="text" name="edu_country"  value="" id="edu_country">
                     
                    <input class="form-control hori " type="hidden" name="edu_country_id"  value="" id="edu_country_id">
                 </td>
                 
<!--                 <td> <?php echo form_dropdown('edu_country',  $country_list, '','class="form-control edu-field js-example-basic-single" id="edu_country"');?> </td>-->
            </tr>
            <tr>
                 <td>Course Type</td>
                 <td>
                
                  	<input class="form-control hori" type="text" name="course_type"  value="" id="course_type">
                     
                    <input class="form-control hori " type="hidden" name="course_type_id"  value="" id="course_type_id">
                 </td>
<!--                 <td> <?php echo form_dropdown('course_type_id',  $edu_course_type_list, '','class="form-control edu-field js-example-basic-single" id="course_type_id"');?> </td>-->
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
            <span class="clearfix">
            <input type="button" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;">
            <div class="clearfix"><br></div>
            </span>
            </td>
            </tr>
        </tbody>
    </table>

</form>



<div style="clear:both;">
</div>
</div>

<div class="col-md-6 col-sm-6">
<span id="edu_details">
<?php echo $edu_view; ?>
</span>


<?php if(isset($formdata['profile_list']['3'])){ ?>
<div class="ScrollStyle">
<table align="center" border="0" style="margin-top:5%;" width="90%">
<tr>
<td><?php if(isset($formdata['profile_list']['3']))echo html_entity_decode($formdata['profile_list']['3']);?></td>
</tr>
</table>
</div>
<?php } ?>

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
<form class="form-horizontal form-bordered"  method="post" id="manage_profession_frm" name="manage_profession_frm" action="<?php echo site_url('data_entry/addJobDetail'); ?>/<?php echo $candidate_id ?>" > 
<h2>Job Details</h2>
    <table class="hori-form">    
        <tbody>
                <tr>                
                    <td>Organization Name</td>
                    <td><input class="form-control hori job-field" type="text" name="organization" value="" id="organization"></td>
                </tr>
                
                <tr>
                    <td>Designation</td>
                    <td><input class="form-control hori job-field" type="text" name="designation" value="" id="designation"></td>
                </tr>
                
                <tr>
                	<td>Industry</td>
                     <td><input class="form-control hori job-field" type="text" name="job_cat_id" value=""  id="job_cat_id"> </td>
                    
                </tr>
                
              
                <tr>
                    <td>Category</td>
                    <td>                    
                    <input class="form-control hori " type="text" name="job_cat"  value="<?php echo $value; ?>" id="job_cat">
                    <input class="form-control hori " type="hidden" name="job_cat_id"  value="<?php echo $id; ?>" id="job_cat_id">
                    </td>
                </tr>
                
                <tr>
                    <td>Function/Role</td>
                    <td>
                     <input class="form-control hori " type="text" name="func"  value="<?php echo $value; ?>" id="func">
                    <input class="form-control hori " type="hidden" name="func_id"  value="<?php echo $id; ?>" id="func_id">
                  
                    </td>
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
                               
                <?php /*?><tr>
                    <td>Skills</td>
                    <td>
                    <input class="form-control hori job-field" type="text" name="skills" id="skills" value="" placeholder="Enter your Skills ">
                    </td>
                </tr><?php */?>
                
                <tr>
                    <td colspan="2" id="step5-msg">                
                    </td>
                </tr>
               
                <tr>
                    <td colspan="2">
                    <span class="clearfix">
                    <input type="button" class="attach-subs" value="Save" id="manage_profession" style="width:180px;">
                    <div class="clearfix"><br></div>
                    </span>
                    </td>
                </tr>
        </tbody>
    </table>

</form>

<div style="clear:both;"></div>
</div>


<div class="col-md-6 col-sm-6">
<span id="job_details">
<?php echo $job_view; ?><br />
</br>
</span>


<?php if(isset($formdata['profile_list']['4'])){ ?>
<div class="ScrollStyle">
<table align="center" border="0" style="margin-top:5%;" width="90%">
<tr>
<td><?php if(isset($formdata['profile_list']['4']))echo html_entity_decode($formdata['profile_list']['4']);?></td>
</tr>
</table>
</div>
<?php } ?>

</div>

</div>
</div>


</div>
<!--END JOB DEATILS-->

<!--BEGIN FILE DETAILS-->
<div id ="step5">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/data_entry/editfiles" enctype="multipart/form-data"> 
 
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
                    <span class="clearfix">
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
 
  <form class="form-horizontal form-bordered"  method="post" id="" name=""   action="<?php echo site_url('data_entry/profile_completion'); ?>/<?php echo $candidate_id ?>" > 
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
      
        &nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('candidates_all'); ?>" class="attach-subs tools">
        <img src="<?php echo base_url();?>assets/images/plus.png"> Back to Listing</a>
  
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
		
	   url: '<?php echo base_url(); ?>index.php/data_entry/show_cv_photo/',
	
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
				url: "<?php echo $this->config->site_url();?>/data_entry/editfiles",
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
		url: "<?php echo site_url('data_entry/check_profile_complete'); ?>"+'/'+candidateId,
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
				url: "<?php echo site_url('data_entry/editCandidate'); ?>",
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
				url: "<?php echo site_url('data_entry/editCandidateDetail'); ?>"+'/'+candidateId,
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
				url: "<?php echo site_url('data_entry/editPassportDetail'); ?>"+'/'+candidateId,
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
				url: "<?php echo site_url('data_entry/editSkillCertificateDetail'); ?>"+'/'+candidateId,
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
		if($('#course').val()=='')
		{
			alert('Select course');
			$('#course').focus();
			return false;
		}
	    return true;
    }
	
   $('#save_candidate3').click(function(){
		var dataStringprop = $("#candidate_form3").serialize();
		
		var isContactValid = candidate_validate3();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_entry/addEducationDetail'); ?>"+'/'+candidateId,
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
				url: "<?php echo site_url('data_entry/editJobChangeDetail'); ?>"+'/'+candidateId,
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
				url: "<?php echo site_url('data_entry/deleteEducationDetail'); ?>"+'/'+candidateId,
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

   function manage_profession_validate() {
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
	
   $('#manage_profession').click(function(){
		var dataStringprop = $("#manage_profession_frm").serialize();
		var isContactValid = manage_profession_validate();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_entry/addJobDetail'); ?>"+'/'+candidateId,
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
							$('#job_cat').val('');
							$('#func').val('');
							
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
				url: "<?php echo site_url('data_entry/deleteJobDetail'); ?>"+'/'+candidateId,
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
			url: "<?php echo site_url('data_entry/photo_delete'); ?>"+'/'+candidateId,
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
			url: "<?php echo site_url('data_entry/cv_delete'); ?>"+'/'+candidateId,
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

	$('#level_id').change(function() 
	{
		jQuery('#course_id_edu').html('');
		jQuery('#course_id_edu').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/data_entry/getcourses/',
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
    $element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/data_entry/get_all_organisation', type: "GET", data:{organization: $('#organization').val()},dataType: "json", success:function(data) 																																							   {
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
    $element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/data_entry/get_all_designation', type: "GET", data:{designation: $('#designation').val()},dataType: "json", success:function(data) {
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
    $element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/data_entry/get_all_responsibility', type: "GET", data:{responsibility: $('#responsibility').val()},dataType: "json", success:function(data) {
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
 
//COUNTRY AUTO COMPLETE
 $('#country').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_country',
			type: "POST", 
			data:{country: $('#country').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
	   		var id = ui.item.id;
           var name = ui.item.label;
           $("#country_id").val(id);
          // return false;
    // window.location.href = ui.item.url;
  },
 });
 
  $('#state').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  
  if($('#country').val()=='')
  {
	  alert('Please Enter the Country');
	  return false;
  }
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_state',
			type: "POST", 
			data:{country_id: $('#country_id').val(),state: $('#state').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#state_id").val(id);
    // window.location.href = ui.item.url;
  },
 });

//STATE AUTOCOMPLETE ENDS

//CITY AUTOCOMPLETE BEGIN
$('#city').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  
  if($('#country').val()=='')
  {
	  alert('Please Enter the Country');
	  return false;
  }
   
  if($('#state').val()=='')
  {
	  alert('Please Enter the State');
	  return false;
  }
  
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_city',
			type: "POST", 
			data:{country_id: $('#country_id').val(),state_id: $('#state_id').val(),city:$('#city').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#city_id").val(id);
    // window.location.href = ui.item.url;
  },
 });

//LOCATION AUTOCOMPLETE BEGIN
$('#location').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  
  if($('#country').val()=='')
  {
	  alert('Please Enter  Country');
	  return false;
  }
   
  if($('#state').val()=='')
  {
	  alert('Please Enter  State');
	  return false;
  }
  
  if($('#city').val()=='')
  {
	  alert('Please Enter  City');
	  return false;
  }
  
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_location',
			type: "POST", 
			data:{country_id: $('#country_id').val(),state_id: $('#state_id').val(),city_id:$('#city_id').val(),location:$('#location').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#location_id").val(id);
  },
 });

//ZIPCODE AUTOCOMPLETE BEGIN
$('#zipcode').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  

   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_zipcode',
			type: "POST", 
			data:{zipcode:$('#zipcode').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		
    // window.location.href = ui.item.url;
  },
 });

 $('#country').on('input', function() { 
	
//id
		$('#country_id').val('');
		$('#state_id').val('');
		$('#city_id').val('');
		$('#location_id').val('');
		
//label		
		$('#state').val('');
		$('#city').val('');
		$('#location').val('');
	


});


$('#state').on('input', function() { 
	
//id
		
		$('#state_id').val('');
		$('#city_id').val('');
		$('#location_id').val('');
		
//label		
		
		$('#city').val('');
		$('#location').val('');
	

});

$('#city').on('input', function() { 
	
//id
		$('#city_id').val('');
		$('#location_id').val('');
		
//label		
		
		$('#location').val('');
	
});
	
	$('#location').on('input', function() { 
	
//id
		$('#location_id').val('');

	});

<!--END DERIN 25/8/2016-->

/*-------------------START AMBILY (26/8/2016)-------------------*/

//Present Location  AUTO COMPLETE

	$('#present_location').autocomplete({ 
		minLength: 1,
		source: function(request, response){ 
			var $this = $(this);
			var $element = $(this.element);
			var previous_request = $element.data( "jqXHR" );
			if( previous_request ) {
				previous_request.abort();
			}
		
			$element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/data_entry/get_all_present_location', type: "GET", data:{present_location: $('#present_location').val()},dataType: "json", success:function(data) 																																							   				{
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
	
	//Preffered Location  AUTO COMPLETE

	$('#preferred_location').autocomplete({ 
		minLength: 1,
		source: function(request, response){ 
			var $this = $(this);
			var $element = $(this.element);
			var previous_request = $element.data( "jqXHR" );
			if( previous_request ) {
				previous_request.abort();
			}

		
			$element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/data_entry/get_all_preferred_location', type: "GET", data:{preferred_location: $('#preferred_location').val()},dataType: "json", success:function(data) 																																							   				{
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
	
	//Preffered Location  AUTO COMPLETE

	$('#passport_nationality').autocomplete({ 
		minLength: 1,
		source: function(request, response){ 
			var $this = $(this);
			var $element = $(this.element);
			var previous_request = $element.data( "jqXHR" );
			if( previous_request ) {
				previous_request.abort();
			}
		
			$element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/data_entry/get_all_passport_nationality', type: "GET", data:{passport_nationality: $('#passport_nationality').val()},dataType: "json", success:function(data) 																																							   				{
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
	
	//BEGIN SKILLS AND CERTIFICATE N DOMAIN NEW
   $('#edit_candidate7_new').click(function(){ 
		
		var dataStringprop = $("#candidate_form7").serialize(); 
		
		var candidateId = '<?php echo $candidate_id ?>';
		var isContactValid = validate_new_data();
		if(isContactValid) 
		{
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_entry/add_new_skill_cert_domain'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){ 
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step7-msg-new').show();
							
							$('#step7-msg-new').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong> Details Added Successfully</strong></div>');	
							$('#step7-msg-new').fadeOut(6000);
							 window.location.reload();
						   
						}
						
						else if(ret['STATUS1']==1) {
							$('#step7-msg').show();
							
							$('#step7-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Skill ,Certificate And Domain Details Updated Successfully</strong></div>');	
							$('#step7-msg').fadeOut(6000);
							 window.location.reload();
						   
						}
						else
						{
							$('#step7-msg-new').show();							
							$('#step7-msg-new').html('<div class="alert alert-success" style="color:#F00;"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Duplicate Data Entries...</strong></div>');	
							$('#step7-msg-new').fadeOut(6000);}
							 window.location.reload();
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

//END SKILLS AND CERTIFICATE DETAILS


// validate new data
 	function validate_new_data() {
		
		if(($('#new_skill').val()=='') &&  ($('#new_cert').val()=='') && ($('#new_domain').val()==''))
		{
			alert('Enter New Data');
			$('#new_skill').focus();
			return false;
		}  	
		
	    return true;
   }
   
  
   //JOB INDUSTRY  AUTO COMPLETE

	$('#job_cat_id').autocomplete({ 
		minLength: 1,
		source: function(request, response){ 
			var $this = $(this);
			var $element = $(this.element);
			var previous_request = $element.data( "jqXHR" );
			if( previous_request ) {
				previous_request.abort();
			}
		
			$element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/data_entry/get_all_job_industry', type: "GET", data:{job_cat_id: $('#job_cat_id').val()},dataType: "json", success:function(data) 																																							   				{
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

	 //JOB CATEGORY  AUTO COMPLETE

	$('#job_cat').autocomplete({ 
		minLength: 1,
		
		source: function(request, response){ 
			var $this = $(this);
			var $element = $(this.element);
			var previous_request = $element.data( "jqXHR" );
			if( previous_request ) {
				previous_request.abort();
			}
		
			$element.data('jqXHR',$.ajax({url:'<?php echo $this->config->site_url();?>/data_entry/get_all_job_category', type: "GET", data:{job_cat_id: $('#job_cat').val()},dataType: "json", success:function(data) 																																							   				{
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
			var id = ui.item.id;
			var name = ui.item.label;
			$("#job_cat_id").val(id);	
		},
	});
	
///Auto complete code for FUNCTION/ROLE	

$('#func').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  
  if($('#job_cat').val()=='')
  {
	  alert('Please Enter the Category');
	  $('#job_cat_id').focus();
	  return false;
  }
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_function_by_category',
			type: "POST", 
			data:{job_cat_id: $('#job_cat_id').val(),func: $('#func').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  	$(".ui-autocomplete").hide();
				 } 
				 else 
				 { 
				  	response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
			var id = ui.item.id;
			var name = ui.item.label;
			$("#func_id").val(id);		
    
  },
 });


$('#job_cat').on('input', function() { 
	
//id
		$('#job_cat_id').val('');
		$('#func_id').val('');
		
//label		
		
		$('#func').val('');
	
});
	
 
 /*------------------------STOP AMBILY- (26/8/2016)------------*/

<!--BEGIN DERIN 26/8/2016-->


//LEVEL OF STUDY AUTO COMPLETE
 $('#level').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_level',
			type: "POST", 
			data:{level: $('#level').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
	   		var id = ui.item.id;
           var name = ui.item.label;
           $("#level_id").val(id);
          // return false;
    // window.location.href = ui.item.url;
  },
 });

//COURSE AUTOCOMPLETE
  $('#course').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  
  if($('#level').val()=='')
  {
	  alert('Please Enter the Level of Study');
	  return false;
  }
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_course',
			type: "POST", 
			data:{level_id: $('#level_id').val(),course: $('#course').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#course_id").val(id);
    // window.location.href = ui.item.url;
  },
 });

//COURSE AUTOCOMPLETE ENDS

//SPECILISATION AUTOCOMPLETE BEGIN
$('#spcl').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_spcl',
			type: "POST", 
			data:{spcl:$('#spcl').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#spcl_id").val(id);
    // window.location.href = ui.item.url;
  },
 });

//UNIVERSITY AUTOCOMPLETE BEGIN
$('#univ').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  
   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_univ',
			type: "POST", 
			data:{univ:$('#univ').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#univ_id").val(id);
    // window.location.href = ui.item.url;
  },
 });

//UNIVERSITY AUTOCOMPLETE END

//COLLEGE AUTOCOMPLETE BEGIN
$('#coll').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  

   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   
  if($('#univ').val()=='')
  {
	  alert('Please Enter the University');
	  return false;
  }
  
   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_coll',
			type: "POST", 
			data:{univ_id:$('#univ_id').val(),coll:$('#coll').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#coll_id").val(id);	
    // window.location.href = ui.item.url;
  },
 });

//YEAR AUTOCOMPLETE BEGIN
$('#edu_year').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  

   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   

   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_year',
			type: "POST", 
			data:{edu_year:$('#edu_year').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
	
    // window.location.href = ui.item.url;
  },
 });

//COUNTRY AUTOCOMPLETE BEGIN
$('#edu_country').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  

   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   

   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_country',
			type: "POST", 
			data:{country:$('#edu_country').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#edu_country_id").val(id);
    // window.location.href = ui.item.url;
  },
 });

//COURSE TYPE AUTOCOMPLETE BEGIN
$('#course_type').autocomplete({ 
  minLength: 1,
  source: function(request, response){ 
  

   var $this = $(this);
   var $element = $(this.element);
   var previous_request = $element.data( "jqXHR" );
   if( previous_request ) {
    previous_request.abort();
   }
   

   $element.data('jqXHR',
		$.ajax({
			url:'<?php echo $this->config->site_url();?>/data_entry/get_all_course_type',
			type: "POST", 
			data:{course_type:$('#course_type').val()},
			dataType: "json", 
			success:function(data) 																																							   			{
				 if (data == null) 
				 {
				  $(".ui-autocomplete").hide();
				 } else 
				 { 
				  response(data);
				 }
   			}                                             
   		})
	);
  },
  select: function(event, ui) {
		var id = ui.item.id;
	   	var name = ui.item.label;
	   	$("#course_type_id").val(id);
    // window.location.href = ui.item.url;
  },
 });

 $('#level').on('input', function() { 
	
//id
		$('#level_id').val('');
		$('#course_id').val('');

		
//label		
		$('#course').val('');

});

$('#univ').on('input', function() { 
	
//id

		
		$('#univ_id').val('');
		$('#coll_id').val('');
		
		
//label		
		
		$('#coll').val('');
		
});

<!--END DERIN 26/8/2016-->

</script>
<!--END FETCHING STATE,CITY,LOCATION-->