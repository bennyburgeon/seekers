<?php //print_r( $skill_list);exit; ?>
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
    <div style="margin-left:1030px;margin-bottom: -50px;">
    
    <a href="<?php echo $this->config->site_url();?>/candidates" class="attach-subs subs">Back</a>
    </div>
<tbody>
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form" name="candidate_form" action="<?php echo site_url('candidates/editCandidate'); ?>/<?php echo $candidate_id ?>" > 
  
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

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>Married</td>
    <td><input type="radio" name="marital_status" value="1" <?php if($formdata['marital_status']==1)echo 'checked="checked"';?>/></td>
    <td>Date of Marriage</td>
    <td><input type="text" name="marriage_date" id="datepicker" value="<?php echo $formdata['marriage_date'];?>" readonly placeholder="yyyy-mm-dd" /> </td>
  </tr>

<tr>
    <td>Engaged</td>
    <td><input type="radio" name="marital_status" value="2"  <?php if($formdata['marital_status']==2)echo 'checked="checked"';?> /></td>
    <td>Date of intented marriage</td>
    <td><input type="text" name="engaged_date" id="datepicker1" value="<?php echo $formdata['engaged_date'];?>" readonly placeholder="yyyy-mm-dd" /></td>
  </tr>
  
<tr>
    <td>Separated</td>
    <td><input type="radio" name="marital_status" value="3"  <?php if($formdata['marital_status']==3)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  

<tr>
    <td>Divorced</td>
    <td><input type="radio" name="marital_status" value="4"  <?php if($formdata['marital_status']==4)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<tr>
    <td>Widowed</td>
    <td><input type="radio" name="marital_status" value="5"  <?php if($formdata['marital_status']==5)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
<tr>
    <td>Never Married</td>
    <td><input type="radio" name="marital_status" value="6"  <?php if($formdata['marital_status']==6)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
       
</table>

</td>
</tr>



<tr>
<td>Mobile Phone</td>
<td><input type="hidden" name="mobile_prefix" value="" id="mobile_prefix">
  <input style="width:200px;" type="text" name="mobile" maxlength="13" value="<?php echo $formdata['mobile'];?>" id="mobile">
</td>
</tr>

<tr>
<td>Date of Birth</td>
<td><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" value="<?php echo $formdata['date_of_birth'];?>" placeholder="Enter your DoB"></td>
</tr>

<tr>
<td>Age</td>
<td><input style="width:100px;" type="text" maxlength="2" name="age" value="<?php echo $formdata['age'];?>" placeholder="Age">[Just leave this if you enter a valid DoB, Age calculate automatically when save.]</td>
</tr>

<tr>
<td>No of children</td>
<td><input style="width:100px;" type="text" maxlength="2" name="children" value="<?php echo $formdata['children'];?>" placeholder="Children"></td>
</tr>



<tr>
  <td>Lead Status</td>
  <td><input id="reg_status" type="radio" name="reg_status" value="1"  <?php if($formdata['reg_status']==1)echo 'checked="checked"';?>  />Leads &nbsp;<input type="radio" name="reg_status" value="2" id="reg_status"  <?php if($formdata['reg_status']==2)echo 'checked="checked"';?> />Registered &nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="3"  <?php if($formdata['reg_status']==3)echo 'checked="checked"';?>  />Closed &nbsp;&nbsp;<input type="radio" name="reg_status" value="4" id="reg_status"  <?php if($formdata['reg_status']==4)echo 'checked="checked"';?> />On Hold &nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="5"  <?php if($formdata['reg_status']==5)echo 'checked="checked"';?>  />Cancelled&nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="6"  <?php if($formdata['reg_status']==6)echo 'checked="checked"';?>  />Migration</td>
</tr>
<tr>

<tr>
  <td>Lead Opportunity</td>
  <td><input id="lead_opportunity" type="radio" name="lead_opportunity" value="1"  <?php if($formdata['lead_opportunity']==1)echo 'checked="checked"';?>  />Cold &nbsp;<input type="radio" name="lead_opportunity" value="2" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==2)echo 'checked="checked"';?> />Warm &nbsp;&nbsp;<input id="lead_opportunity" type="radio" name="lead_opportunity" value="3"  <?php if($formdata['lead_opportunity']==3)echo 'checked="checked"';?>  />Hot &nbsp;&nbsp;<input type="radio" name="lead_opportunity" value="0" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==0)echo 'checked="checked"';?> />Unknown&nbsp;</td>
</tr>

<tr>
<td>How did you come to know us?</td>
<td><input class="form-control hori " type="text" name="lead_source" value="<?php echo $formdata['lead_source'];?>" placeholder="Lead Source"></td>
</tr>
<tr>
<td colspan="2" id="step-msg">

</td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="attach-subs" value="Save" id="edit_candidate" style="width:180px;"><!--<input type="button" class="attach-subs subs" value="Skip" id="skip">
<!--<input type="button" class="attach-subs subs" value="Skip" id="skip">-->
<!--<a href="<?php echo $this->config->site_url();?>/candidates/summary/<?php echo $formdata['candidate_id'] ?>" class="attach-subs subs">Done</a>-->
</span>
</td>
</tr>
</form>
</tbody>
</table>
<div style="clear:both;"></div>
</div>
</div>

<!--START CONTACT DETAILS-->

<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form1" name="candidate_form1" action="<?php echo site_url('candidates/update_profile_personal'); ?>/<?php echo $candidate_id ?>" > 
  <input type="hidden" name="cv_category_id" value="1">
<table align="center" width="90%">
<tbody>
  <tr>
    <td colspan="2"><h2>Personal</h2></td>
  </tr>
  
  <tr>
<td colspan="2"><?php if(isset($formdata['profile_list']['1']))echo $this->ckeditor->editor('cv_file1',html_entity_decode($formdata['profile_list']['1']));else echo $this->ckeditor->editor('cv_file1')?> &nbsp;</td>
</tr>

<tr>
<td colspan="2" id="step1-msg">

</td>
</tr>

<tr>

<td align="center">

<input type="button" class="attach-subs" value="Save" id="edit_candidate1" style="width:180px;">

</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END CONTACT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form2" name="candidate_form2" action="<?php echo site_url('candidates/update_profile_address'); ?>/<?php echo $candidate_id ?>" > 
  <input type="hidden" name="cv_category_id" value="2">
<table align="center" width="90%">
<tbody>
<tr>
  <td><h2>Address</h2></td>
</tr>
<tr>
  <td><?php if(isset($formdata['profile_list']['2']))echo $this->ckeditor->editor('cv_file2',html_entity_decode($formdata['profile_list']['2']));else echo $this->ckeditor->editor('cv_file2')?> &nbsp; </td>
  </tr>

<tr>
<td id="step2-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="SAVE" id="edit_candidate2" style="width:180px;">

</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<!--END PASSPORT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form3" name="candidate_form3" action="<?php echo site_url('candidates/update_profile_education'); ?>/<?php echo $candidate_id ?>" > 
  <input type="hidden" name="cv_category_id" value="3">
<table align="center" width="90%">
<tbody>
   


    
  	<tr>
  	  <td><h2>Education</h2></td>
	  </tr>
  	<tr>
    <td> <?php if(isset($formdata['profile_list']['3']))echo $this->ckeditor->editor('cv_file3',html_entity_decode($formdata['profile_list']['3']));else echo $this->ckeditor->editor('cv_file3')?>   &nbsp; </td>
        </tr>

<tr>
<td id="step3-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="SAVE" id="edit_candidate3" style="width:180px;">

</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<!--END CERTIFICATIOn DETAILS-->

<!--BEGIN EDUCATION DETAILS -->
<div id ="step3" >
<div class="table-tech specs hor">


  <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo site_url('candidates/update_profile_profession'); ?>/<?php echo $candidate_id ?>">
  <input type="hidden" name="cv_category_id" value="4">
<table align="center" width="90%">
<tbody>

<tr>
  <td><h2>Professional History</h2></td>
</tr>
<tr>
  <td> <?php if(isset($formdata['profile_list']['4']))echo $this->ckeditor->editor('cv_file4',html_entity_decode($formdata['profile_list']['4']));else echo $this->ckeditor->editor('cv_file4')?> &nbsp;</td>
  </tr>
<tr>
<td id="step4-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="save_candidate4" style="width:180px;">


</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END EDUCATION DETAILS-->



<!--BEGIN JOB DEATILS-->
<div id ="step2" >

<div class="table-tech specs hor">

 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo site_url('candidates/update_profile_language'); ?>/<?php echo $candidate_id ?>"> 
  <input type="hidden" name="cv_category_id" value="5">
<table align="center" width="90%"><tr><td>    <h2>Language Skills</h2></td></tr>

<tr>
  
<tr>

<td>
<?php if(isset($formdata['profile_list']['5']))echo $this->ckeditor->editor('cv_file5',html_entity_decode($formdata['profile_list']['5']));else echo $this->ckeditor->editor('cv_file5')?>
</td>
</tr>

<tr>
<td  id="step5-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="edit_candidate5" style="width:180px;">

</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>



</div>
<!--END JOB DEATILS-->


</div>

<div id ="step4" >

<div class="table-tech specs hor">
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form6" name="candidate_form6" action="<?php echo site_url('candidates/update_profile_tech_skills'); ?>/<?php echo $candidate_id ?>"> 
  <input type="hidden" name="cv_category_id" value="6">
  
<table align="center" width="90%"><tr><td>    <h2>Tech Skills</h2></td></tr>

<tr>
  
<tr>

<td>
<?php if(isset($formdata['profile_list']['6']))echo $this->ckeditor->editor('cv_file6',html_entity_decode($formdata['profile_list']['6']));else echo $this->ckeditor->editor('cv_file6')?>
</td>
</tr>

<tr>
<td  id="step6-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="edit_candidate6" style="width:180px;">

</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>
</div>

<!--END JOB DEATILS-->


</div>


<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form7" name="candidate_form7" action="<?php echo site_url('candidates/update_profile_certification'); ?>/<?php echo $candidate_id ?>">
  <input type="hidden" name="cv_category_id" value="7"> 
<table align="center" width="90%"><tr><td>    <h2>Certification</h2></td></tr>

<tr>
  
<tr>

<td>
<?php if(isset($formdata['profile_list']['7']))echo $this->ckeditor->editor('cv_file7',html_entity_decode($formdata['profile_list']['7']));else echo $this->ckeditor->editor('cv_file7')?>
</td>
</tr>

<tr>
<td  id="step7-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="edit_candidate7" style="width:180px;">

</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>

</div>
<!--END JOB DEATILS-->


</div>


<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form8" name="candidate_form8" action="<?php echo site_url('candidates/update_profile_projects'); ?>/<?php echo $candidate_id ?>"> 
  <input type="hidden" name="cv_category_id" value="8">
<table align="center" width="90%"><tr><td>    <h2>Industry Experience [Projects]</h2></td></tr>

<tr>
  
<tr>

<td>
<?php if(isset($formdata['profile_list']['8']))echo $this->ckeditor->editor('cv_file8',html_entity_decode($formdata['profile_list']['8']));else echo $this->ckeditor->editor('cv_file8')?>
</td>
</tr>

<tr>
<td  id="step8-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="edit_candidate8" style="width:180px;">

</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>

</div>
<!--END JOB DEATILS-->


</div>

<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form9" name="candidate_form9" action="<?php echo site_url('candidates/update_profile_sports'); ?>/<?php echo $candidate_id ?>"> 
  <input type="hidden" name="cv_category_id" value="9">
<table align="center" width="90%"><tr><td>    <h2>Sports & Games</h2></td></tr>

<tr>
  
<tr>

<td>
<?php if(isset($formdata['profile_list']['9']))echo $this->ckeditor->editor('cv_file9',html_entity_decode($formdata['profile_list']['9']));else echo $this->ckeditor->editor('cv_file9')?>
</td>
</tr>

<tr>
<td  id="step9-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="edit_candidate9" style="width:180px;">

</td>
</tr>
</tbody>
</table>

</form>
<div style="clear:both;"></div>


</div>
<!--END JOB DEATILS-->


</div>

<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form10" name="candidate_form10" action="<?php echo site_url('candidates/update_profile_social'); ?>/<?php echo $candidate_id ?>"> 
  <input type="hidden" name="cv_category_id" value="10">
<table align="center" width="90%"><tr><td>    <h2>Social</h2></td></tr>

<tr>
  
<tr>

<td>
<?php if(isset($formdata['profile_list']['10']))echo $this->ckeditor->editor('cv_file10',html_entity_decode($formdata['profile_list']['10']));else echo $this->ckeditor->editor('cv_file10')?>
</td>
</tr>

<tr>
<td  id="step10-msg">

</td>
</tr>
<tr>
<td align="center">

<input type="button" class="attach-subs" value="Save" id="edit_candidate10" style="width:180px;">

</td>
</tr>

<tr>
<td>
<!--<div class="right-btns">
<a href="<?php echo site_url('candidates'); ?>" class="attach-subs tools"><img src="http://localhost/recruitment-hub/admin/assets/images/plus.png">Back to Listing</a>
</div>-->

</td>

</tr>


</tbody>
</table>

</form>
<div style="clear:both;"></div>


</div>
<!--END JOB DEATILS-->


</div>
<div id ="step6" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="" name=""   action="<?php echo site_url('candidates/profile_completion'); ?>/<?php echo $candidate_id ?>" > 
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

<table align="left" width="60%">

<tr>
<td>
<table class="hori-form">
<tbody>
                  <tr>
                    <td >
                <?php if($formdata['cv_file']!=''){?><a href="<?php echo base_url().'uploads/cvs/'.$formdata['cv_file'];?>" target="_blank"   class="attach-subs tools">Download CV</a> <?php } ?> </td>
                  </tr>
<tr>
  <td>Do you complete raw data entry?</td>
  <td><input type="radio" name="profile_completion" <?php if( $formdata['profile_completion']==2){?> checked <?php }?> value="2" >Yes&nbsp;<input type="radio" name="profile_completion" <?php if( $formdata['profile_completion']!=2){?> checked <?php }?> value="1" >No&nbsp;</td>
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

var userFlag = 0;
$( document ).ready(function() {
	$('#datepicker2').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});		

   function candidate_validate() 
   {
	    return true;
    }
	
   $('#edit_candidate').click(function(){
		var dataStringprop = $("#candidate_form").serialize();
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/editCandidate'); ?>",
				cache: false,				
				data: dataStringprop,
				success: function(json){ 
					try{		
						var ret = jQuery.parseJSON(json);
						$('#hdstep1').val(ret['SUCCESS_ID']);
						if(ret['STATUS']==1) {
							$('#step-msg').show();							
							$('#step-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Personal Details Updated Successfully</strong></div>');	
							$('#step-msg').fadeOut(6000);
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
   
//CONTACT DETAILS VALIDATION AND SUBMIT

   function candidate_validate1() 
   {
	    return true;
    }

   $('#edit_candidate1').click(function(){
	   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();

	
		var dataStringprop = $("#candidate_form1").serialize();
		var isContactValid = candidate_validate1();
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_personal'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step1-msg').show();							
							$('#step1-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step1-msg').fadeOut(6000);
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
   });//end button click function save*/
   
//END CONTACT DETAILS VALIDATION AND SUBMIT

//BEGIN PASSPORT DETAILS

   function candidate_validate2() {
   return true;

    }
   $('#edit_candidate2').click(function(){ 
   
   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dataStringprop = $("#candidate_form2").serialize();
		var isContactValid = candidate_validate2();
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_address'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step2-msg').show();							
							$('#step2-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
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
   });//end button click function save*/

//END PASSPORT DETAILS

//BEGIN SKILLS AND CERTIFICATE
   $('#edit_candidate3').click(function(){ 

for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		   
		var dataStringprop = $("#candidate_form3").serialize();
		//var isContactValid = candidate_validate2();
		//if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_education'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){ 
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step3-msg').show();							
							$('#step3-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
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
		//} //end contact valid
   });//end button click function save*/

//END SKILLS AND CERTIFICATE DETAILS

//BEGIN EDUCATION DEATILS

   function candidate_validate3() {
	    return true;
    }
   $('#save_candidate4').click(function(){
	   
	   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dataStringprop = $("#candidate_form4").serialize();
		var isContactValid = candidate_validate3();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_profession'); ?>"+'/'+candidateId,
				cache: false,
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step4-msg').show();							
							$('#step4-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step4-msg').fadeOut(6000);
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
   });//end button click function save*/

//END EDUCATION DETAILS

//BEGIN JOB DETAILS

   function candidate_validate4() {
		
	    return true;
    }
   $('#edit_candidate5').click(function(){
	   
	   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dataStringprop = $("#candidate_form5").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_language'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step5-msg').show();							
							$('#step5-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step5-msg').fadeOut(6000);
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
   });//end button click function save*/

   $('#edit_candidate6').click(function(){
	   
	   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dataStringprop = $("#candidate_form6").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_tech_skills'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step6-msg').show();							
							$('#step6-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step6-msg').fadeOut(6000);
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
   });//end button click function save*/
   
   
   $('#edit_candidate7').click(function(){
	   
	   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dataStringprop = $("#candidate_form7").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_certification'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step7-msg').show();							
							$('#step7-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
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

		} //end contact valid
   });//end button click function save*/

   $('#edit_candidate8').click(function(){
	   
	   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dataStringprop = $("#candidate_form8").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_projects'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step8-msg').show();							
							$('#step8-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step8-msg').fadeOut(6000);
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
   });//end button click function save*/

   $('#edit_candidate9').click(function(){
	   
	   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dataStringprop = $("#candidate_form9").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_sports'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step9-msg').show();							
							$('#step9-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step9-msg').fadeOut(6000);
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
   });//end button click function save*/

   $('#edit_candidate10').click(function(){
	   
	   for ( instance in CKEDITOR.instances )
    	CKEDITOR.instances[instance].updateElement();
		
		var dataStringprop = $("#candidate_form10").serialize();
		var isContactValid = candidate_validate4();
		if(isContactValid) {
			var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/update_profile_social'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {							
							$('#step10-msg').show();							
							$('#step10-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Details Updated Successfully...</strong></div>');	
							$('#step10-msg').fadeOut(6000);
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
   });//end button click function save*/


//END JOB DETAILS
});   // end document.ready


</script>
