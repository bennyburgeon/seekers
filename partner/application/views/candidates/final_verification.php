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

<?php if($this->input->get('upd')==2){?>  

    <div class="alert alert-success alert-dismissable" style="color:#F00;">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <h4><b>Verification failed !</b>Profile not Complete.</h4>
    </div>
<?php }?>


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

     <a href="<?php echo $this->config->site_url();?>/candidates/" class="attach-subs subs pull-right">Listing </a>
    <a href="<?php echo $this->config->site_url();?>/candidates/profile_entry/<?php echo $candidate_id; ?>" class="attach-subs subs pull-right">Raw Data</a>
        <a href="<?php echo $this->config->site_url();?>/candidates/edit/<?php echo $candidate_id; ?>" class="attach-subs subs pull-right">Update</a>

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form1" name="candidate_form1" > 
      
      <?php echo form_hidden('candidateId', $candidate_id);?>
      <h2 class="srevHd">Personal Details</h2>
      
    <table align="left" width="45%" border="0">
    
        <tr>
        <td>First Name</td>
        <td><?php echo $personal['first_name'];?></td>
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
        <td><?php echo $personal['gender'];?></td>
        </tr>
        
        <tr>
        <td>Marital Status</td>
        <td><?php echo $personal['marital_status'];?></td>
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
  
</form>
<table align="right" width="40%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['1']))echo $profile_list['1'];?></td>
</tr>
</table>
<div style="clear:both;"></div>
</div>
</div>

<!--START CONTACT DETAILS-->

<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form2" name="candidate_form2" action="<?php echo site_url('data_mgmt/editCandidateDetail'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $candidate_id);?>
  <h2 class="srevHd">Address</h2>
    <table align="left" width="45%" border="0">
    
        <tr>
        <td>First Name</td>
        <td><?php echo $personal['first_name'];?></td>
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
        <td><?php echo $personal['gender'];?></td>
        </tr>
        
        <tr>
        <td>Marital Status</td>
        <td><?php echo $personal['marital_status'];?></td>
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
        
        <table align="right" width="40%" border="0">
        <tr>
        <td>&nbsp;<?php if(isset($profile_list['2']))echo $profile_list['2'];?></td>
        </tr>
    </table>

</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END CONTACT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form3" name="candidate_form3" action="<?php echo site_url('data_mgmt/addEducationDetail'); ?>/<?php echo $candidate_id ?>"  > 
  <?php echo form_hidden('candidateId', $candidate_id);?>
  
    <h2 class="srevHd">Education</h2>
     <div style="float:left;">
		<?php if(is_array($education)){?>
        <?php foreach($education as $item){?>
       
    	<table align="left" width="115%" border="1" style="margin-top:30px;">
            <tr>
            <td><b>Level Name</b></td>
            <td><?php echo $item['level_name'];?></td>
            </tr>
            
            <tr>
            <td><b>Course Name</b></td>
            <td><?php echo $item['course_name'];?></td>
            </tr>
            
            <tr>
            <td><b>Specialized in</b></td>
            <td><?php echo $item['spcl_name'];?></td>
            </tr>
            
            <tr>
            <td><b>University</b></td>
            <td><?php echo $item['univ_name'];?></td>
            </tr>
            
            <tr>
            <td><b>Type</b></td>
            <td><?php echo $item['course_type'];?></td>
            </tr>
            
            <tr>
            <td><b>Year</b></td>
            <td><?php echo $item['edu_year'];?></td>
            </tr>
            
        </table>
    	<?php } }?>
	</div>
    
    <table align="right" width="40%" border="0">
    <tr>
    <td>&nbsp;<?php if(isset($profile_list['3']))echo $profile_list['3'];?></td>
    </tr>
    </table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<!--END PASSPORT DETAILS-->

<!--START PASSPORT DETAILS-->
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4"  action="<?php echo site_url('data_mgmt/addJobDetail'); ?>/<?php echo $candidate_id ?>"> 
  
 <?php echo form_hidden('candidateId', $candidate_id);?>
    
    <h2 class="srevHd">Job History</h2>
    <div style="float:left;">
		<?php if(is_array($job_details)){?>
        <?php foreach($job_details as $item){?>
  
       <table align="left" width="115%" border="1" style="margin-top:30px;">
            <tr>
            <td><b>Organization</b></td>
            <td><?php echo $item['organization'];?></td>
            </tr>
            
            <tr>
            <td><b>Designation</b></td>
            <td><?php echo $item['designation'];?></td>
            </tr>
            
            <tr>
            <td><b>Responsiblity</td>
            <td><?php echo $item['responsibility'];?></td>
            </tr>
            
            <tr>
            <td><b>From Date</b></td>
            <td><?php echo $item['from_date'];?></td>
            </tr>
            
            <tr>
            <td><b>To Date</b></td>
            <td><?php echo $item['to_date'];?></td>
            </tr>
            
            <tr>
            <td><b>Salary/Month</b></td>
            <td><?php echo $item['monthly_salary'];?></td>
            </tr>
        
        </table>
    
    <?php } }?>
 
	 </div>

    <table align="right" width="40%" border="0">
        <tr>
        <td>&nbsp;<?php if(isset($profile_list['4']))echo $profile_list['4'];?></td>
        </tr>
    </table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<!--END CERTIFICATIOn DETAILS-->

<!--BEGIN EDUCATION DETAILS -->
<div id ="step3" >
<div class="table-tech specs hor">


  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5"  action="<?php echo site_url('data_mgmt/editLanguageDetail'); ?>/<?php echo $candidate_id ?>" >
  <?php echo form_hidden('candidateId', $candidate_id);?>

    <h2 class="srevHd">Language Skills</h2>
    
    <?php if(is_array($language_skills)){?>
        <table align="left" width="40%" border="1">
            <tr>
            <td colspan="2"><b>Language Skill</b></td>
            </tr>
            <?php foreach($language_skills as $item){?>
            <tr>
            <td colspan="2"><?php echo $item['lang_name'];?></td>
            </tr>
        	<?php } ?>
        </table>
    <?php } ?>

<table align="right" width="40%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['5']))echo $profile_list['5'];?></td>
</tr>
</table>


</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END EDUCATION DETAILS-->



<!--BEGIN JOB DEATILS-->
<div id ="step2" >

<div class="table-tech specs hor">

 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form6" name="candidate_form6"   action="<?php echo site_url('data_mgmt/editSkillDetail'); ?>/<?php echo $candidate_id ?>" > 
<?php echo form_hidden('candidateId', $candidate_id);?>

    <h2 class="srevHd">Tech Skills</h2>
    <?php if(is_array($tech_skills)){?>
        <table align="left" width="40%" border="1">
            <tr>
            <td colspan="2"><b>Skill Name</b></td>
            </tr>
            <?php foreach($tech_skills as $item){?>
            <tr>
            <td colspan="2"><?php echo $item['skill_name'];?></td>
            </tr>
            <?php } ?>
        </table>
    <?php } ?>


<table align="right" width="40%" border="0">
<tr>
<td>&nbsp;<?php if(isset($profile_list['6']))echo $profile_list['6'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<!--END Skill DEATILS-->


<div id ="step4" >

<div class="table-tech specs hor">
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form7" name="candidate_form7"   action="<?php echo site_url('data_mgmt/editCertificateDetail'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $candidate_id);?>
  

	<h2 class="srevHd">Certification</h2>
	<?php if(is_array($certification)){?>
    <table align="left" width="40%" border="1">
        <tr>
        	<td colspan="2"><b>Cert Name</b></td>
        </tr>
        
		<?php foreach($certification as $item){?>
        <tr>
        	<td colspan="2"><?php echo $item['cert_name'];?></td>
        </tr>
        <?php } ?>
    </table>
	<?php } ?>
        
        
    <table align="right" width="40%" border="0">
        <tr>
        <td>&nbsp;<?php if(isset($profile_list['7']))echo $profile_list['7'];?></td>
        </tr>
    </table>

</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END Certification DEATILS-->


<div id ="step4" >

<div class="table-tech specs hor">
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form7" name="candidate_form7"   action="<?php echo site_url('data_mgmt/editCertificateDetail'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $candidate_id);?>
  

	<h2 class="srevHd">Industry</h2>
	<?php if(is_array($domain)){?>
    <table align="left" width="40%" border="1">
        <tr>
        	<td colspan="2"><b>Domain Name</b></td>
        </tr>
        
		<?php foreach($domain as $item){?>
        <tr>
        	<td colspan="2"><?php echo $item['domain_name'];?></td>
        </tr>
        <?php } ?>
    </table>
	<?php } ?>
        
        
    <table align="right" width="40%" border="0">
        <tr>
        <td>&nbsp;<?php if(isset($profile_list['8']))echo $profile_list['8'];?></td>
        </tr>
    </table>

</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END industry DEATILS-->


<div id ="step4" >
<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form9" name="candidate_form9"   action="<?php echo site_url('data_mgmt/addSports'); ?>/<?php echo $candidate_id ?>" > 
  <?php echo form_hidden('candidateId', $candidate_id);?>


    <h2 class="srevHd">Sports & Games</h2>
    <?php if(is_array($sports)){?>

    <table align="left" width="40%" border="1">
        <tr>
        	<td colspan="2"><b>Sport Details</b></td>
        </tr>
        
		<?php foreach($sports as $item){?>
            <tr>
            <td colspan="2"><?php echo $item['sport_details'];?></td>        
            </tr>        
        <?php } ?>
    </table>
    
    <?php } ?>
    

    <table align="right" width="40%" border="0">
        <tr>
        <td>&nbsp;<?php if(isset($profile_list['9']))echo $profile_list['9'];?></td>
        </tr>
    </table>

</form>
<div style="clear:both;"></div>
</div>
</div>

<!--END Sports N Games DEATILS-->

<div id ="step4" >
<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form10" name="candidate_form10"   action="<?php echo site_url('data_mgmt/addSocial'); ?>/<?php echo $candidate_id ?>" > 
 <?php echo form_hidden('candidateId', $candidate_id);?>


<h2 class="srevHd">Social</h2>
	<?php if(is_array($social)){?>
    
    <table align="left" width="40%" border="1">
        <tr>
        <td><b>Title</b></td>
        <td><b>Link</b></td>
        </tr>
        <?php foreach($social as $item){?>
        
        <tr>
        <td><?php echo $item['social_title'];?></td>
        <td><?php echo $item['social_link'];?></td>
        </tr>
        <?php } ?>
    </table>
    
    
    <?php } ?>
    
    
    <table align="right" width="40%" border="0">
        <tr>
        <td>&nbsp;<?php if(isset($profile_list['10']))echo $profile_list['10'];?></td>
        </tr>
    </table>

</form>
<div style="clear:both;"></div>
</div>
</div>
<!--END Social DEATILS-->

<div id ="step4" >
<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="frm_contract" name="frm_contract" > 
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

    <table align="left" width="90%"><tr><td>    <h2>Present Contract Details</h2></td></tr>
  
                    
        <tr>
          
            <td>
            <input style="width:200px;" placeholder="Start Date"  type="text"  name="start_date" readonly="readonly"
            value="<?php if(!empty($contract))echo $contract['start_date'];?>" id="datepicker1">&nbsp;&nbsp;&nbsp;&nbsp;
            <input style="width:200px;" placeholder="End Date"  type="text"  name="end_date" value="<?php if(!empty($contract))echo $contract['end_date'];?>" 
            readonly="readonly" id="datepicker2"> 
            &nbsp;&nbsp;&nbsp;&nbsp;
            
            <?php  $selected = (!empty($contract)) ?$contract['total_months'] : 0;
			echo form_dropdown('total_months', $contract_months,$selected,'id="total_months"');?>
            
            </td>
        </tr>
        
        
      
        <tr>
        	<td colspan="2" id="step3-msg">&nbsp;&nbsp;</td>
        </tr>
    
    	<tr>
            <td align="center">        
            <input type="button" class="attach-subs" value="Update" id="update_contract" style="width:180px;">        
            </td>
    	</tr>
  </tbody>
</table>
</form>
<div style="clear:both;"></div>
</div>

</div>
<!--------End Present Contract Detals---------------->

<div id ="step4" >
<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="frm_language_status" name="frm_language_status" > 
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

<table align="left" width="90%"><tr><td>    <h2>All Language Details</h2></td></tr>

    <tr>
        <td><table class="hori-form" border="1">
          <tbody>
           
            
            <tr>
              <td>PTE</td>
                <td>
                Total :<?php if(!empty($formdata))echo $formdata[0]['eng_pte'];?> | 
                Reading : <?php if(!empty($formdata)) echo $formdata[0]['eng_pte_reading'];?> | 
                Listening : <?php if(!empty($formdata)) echo $formdata[0]['eng_pte_listening'];?>|
                Writing : <?php if(!empty($formdata)) echo $formdata[0]['eng_pte_writing'];?>|
                Speaking : <?php if(!empty($formdata)) echo $formdata[0]['eng_pte_speaking'];?>
                
                </td>
            </tr>
             <tr>
                <td>IELTS</td>
                <td>
                Total : <?php if(!empty($formdata))echo $formdata[0]['eng_ielts'];?> | 
               Reading : <?php if(!empty($formdata)) echo $formdata[0]['eng_ielts_reading'];?> | 
                Listening : <?php if(!empty($formdata)) echo $formdata[0]['eng_ielts_listening'];?>|
               Writing : <?php if(!empty($formdata)) echo $formdata[0]['eng_ielts_writing'];?>|
                Speaking : <?php if(!empty($formdata)) echo $formdata[0]['eng_ielts_speaking'];?>
                
                </td>
            </tr>
            
            
            <tr>
              <td>OET</td>
                <td>
                
             Total : <?php if(!empty($formdata))echo $formdata[0]['eng_oet'];?> | 
             Reading :   <?php if(!empty($formdata))echo $formdata[0]['eng_oet_reading'];?> | 
             Listening :    <?php if(!empty($formdata))echo $formdata[0]['eng_oet_listening'];?>|
              Writing :  <?php if(!empty($formdata))echo $formdata[0]['eng_oet_writing'];?>|
              Speaking : <?php if(!empty($formdata))echo $formdata[0]['eng_oet_speaking'];?>
                
                </td>
            </tr>
            <tr>
              <td>TOFEL</td>
                <td>
               Total : <?php if(!empty($formdata))echo $formdata[0]['eng_tofel'];?> | 
               Reading :  <?php if(!empty($formdata))echo $formdata[0]['eng_tofel_reading'];?> | 
               Listening : <?php if(!empty($formdata))echo $formdata[0]['eng_tofel_listening'];?>|
               Writing : <?php if(!empty($formdata))echo $formdata[0]['eng_tofel_writing'];?>|
               Speaking :  <?php if(!empty($formdata))echo $formdata[0]['eng_tofel_speaking'];?>
                
                </td>
            </tr>
             <tr>
                <td>GRE</td>
                <td><?php if(!empty($formdata))echo $formdata[0]['eng_gre'];?></td>
            </tr>
            
            <tr>
                <td>GMAT</td>
                <td><?php if(!empty($formdata))echo $formdata[0]['eng_gmat'];?></td>
            </tr>
            
            <tr>
                <td>SAT</td>
                <td><?php if(!empty($formdata))echo $formdata[0]['eng_sat'];?></td>
            </tr>
            
            <tr>
                <td>10th Marks</td>
                <td><?php if(!empty($formdata))echo $formdata[0]['eng_10th'];?></td>
            </tr>
            
            <tr>
                <td>12th Marks</td>
                <td><?php if(!empty($formdata))echo $formdata[0]['eng_12th'];?></td>
            </tr>
            
            <tr>
                <td>Eng Grad</td>
                <td><?php if(!empty($formdata))echo $formdata[0]['eng_grad'];?></td>
            </tr>
            
            <tr>
                <td>Eng Post Grad</td>
                <td><?php if(!empty($formdata))echo $formdata[0]['eng_post_grad'];?></td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>

    <tr>
    <td colspan="2" id="step4-msg">&nbsp;&nbsp;</td>
    </tr>
    
    <tr>
    
    </tr>
</tbody>
</table>



</form>
<div style="clear:both;"></div>

</div>
</div>
<!--END Lang DEATILS-->



<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="frm_profile_status" name="frm_profile_status"   action="<?php echo site_url('candidates/update_profile_status'); ?>/<?php echo $candidate_id ?>" > 
  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

<table align="left" width="40%"><tr><td>    <h2>Profile Completion Status</h2></td></tr>

<tr>
<td>
<table class="hori-form">
<tbody>

<tr>
  <td>Personal</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_1']) && $profile_status['profile_stat_1']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_1']) && $profile_status['profile_stat_1']==0){echo 'No';} ?>
  
  </td>
</tr>

<tr>
  <td>Address</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_2']) && $profile_status['profile_stat_2']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_2']) && $profile_status['profile_stat_2']==0){echo 'No';} ?>
  
  </td>
</tr>

<tr>
  <td>Education</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_3']) && $profile_status['profile_stat_3']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_3']) && $profile_status['profile_stat_3']==0){echo 'No';} ?>
  
  </td>
</tr>

<tr>
  <td>Profession</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_4']) && $profile_status['profile_stat_4']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_4']) && $profile_status['profile_stat_4']==0){echo 'No';} ?>
  
  </td>
</tr>


<tr>
  <td>Language</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_5']) && $profile_status['profile_stat_5']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_5']) && $profile_status['profile_stat_5']==0){echo 'No';} ?>
  
  </td>
</tr>

<tr>
  <td>Tech Skills</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_6']) && $profile_status['profile_stat_6']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_6']) && $profile_status['profile_stat_6']==0){echo 'No';} ?>
  
  </td></tr>

<tr>
  <td>Certification</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_7']) && $profile_status['profile_stat_7']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_7']) && $profile_status['profile_stat_7']==0){echo 'No';} ?>
  
  </td>
</tr>

<tr>
  <td>Projects</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_8']) && $profile_status['profile_stat_8']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_8']) && $profile_status['profile_stat_8']==0){echo 'No';} ?>
  
  </td>
</tr>

<tr>
  <td>Sports</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_9']) && $profile_status['profile_stat_9']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_9']) && $profile_status['profile_stat_9']==0){echo 'No';} ?>
  
  </td>
</tr>

<tr>
  <td>Social</td>
  <td>
  <?php if(is_array($profile_status) && isset($profile_status['profile_stat_10']) && $profile_status['profile_stat_10']==1){echo 'Yes';}else if(is_array($profile_status) && isset($profile_status['profile_stat_10']) && $profile_status['profile_stat_10']==0){echo 'No';} ?>
  
  </td>
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

</tr>
</tbody>
</table>

<table align="right" width="40%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['10']))echo $formdata['profile_list']['10'];?></td>
</tr>
</table>

</form>
<div style="clear:both;"></div>


</div>
<!--END JOB DEATILS-->


</div>

<div id ="step4" >

<div class="table-tech specs hor">
 
  <form class="form-horizontal form-bordered"  method="post" id="frm_profile_assessment" name="frm_profile_assessment"   action="<?php echo site_url('candidates/update_profile_assessment'); ?>/<?php echo $candidate_id ?>" > 

<input type="hidden" name="candidate_id" value="<?php echo $candidate_id ?>">

<table align="left" width="90%"><tr><td>    <h2>Profile Assessment</h2></td></tr>
<tr>
<td>

<table class="hori-form" border="1">
<tbody>

<tr>
  <td>Language</td>
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['language']) && $profile_assessment['language']==10){echo 'Exceptional';}?></td>
  


</tr>

<tr>
  <td>Attitude</td>
  
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['attitude']) && $profile_assessment['attitude']==10){echo 'Exceptional';}?></td>
  
  

</tr>

<tr>
  <td>Tech Skills</td>
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['tech_skills']) && $profile_assessment['tech_skills']==10){echo 'Exceptional';}?></td>
  
</tr>

<tr>
  <td>Ind. Exp.</td>
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['industry_exp']) && $profile_assessment['industry_exp']==10){echo 'Exceptional';}?></td>
  
</tr>

<tr>
  <td>Personality</td>
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['personality']) && $profile_assessment['personality']==10){echo 'Exceptional';}?></td>
   
</tr>

<tr>
  <td>Interaction</td>
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['interaction']) && $profile_assessment['interaction']==10){echo 'Exceptional';}?></td>
   
</tr>

<tr>
  <td>Team Work</td>
  
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['team_work']) && $profile_assessment['team_work']==10){echo 'Exceptional';}?></td>
  
  
</tr>

<tr>
  <td>Cop. Exp.</td>
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['corporate_exp']) && $profile_assessment['corporate_exp']==10){echo 'Exceptional';}?></td>
  
  
</tr>

<tr>
  <td>Edu. Abroad</td>
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['overseas_edu']) && $profile_assessment['overseas_edu']==10){echo 'Exceptional';}?></td>
  
 
</tr>

<tr>
  <td>Migration</td>
  <td><?php if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==1){echo 'Poor';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==2){echo 'Marginal';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==3){echo 'Fair';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==4){echo 'Satisfactory';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==5){echo 'Average';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==6){ echo 'Good';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==7){echo 'Very Good';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==8){echo 'Excellent';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==9){echo 'Outstanding';}else if(is_array($profile_assessment) && isset($profile_assessment['migration']) && $profile_assessment['migration']==10){echo 'Exceptional';}?></td>
  
   
</tr>

</tbody>
</table>

</td>
</tr>
<tr>
    <td colspan="2" id="step2-msg">
    
    </td>
</tr>
<tr>
    
</tr>
</tbody>
</table>

<table align="right" width="35%" border="0">
<tr>
<td><?php if(isset($formdata['profile_list']['10']))echo $formdata['profile_list']['10'];?></td>
</tr>
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
  <td>Do you complete final verification process?</td>
  <td><input type="radio" name="profile_completion" <?php if( $personal['profile_completion']==5){?> checked <?php }?> value="5" >Yes&nbsp;<input type="radio" name="profile_completion" <?php if( $personal['profile_completion']!=5){?> checked <?php }?> value="4" >No&nbsp;</td>
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
    <p><!-- form ends here-->
      
      <!-- centercontent -->
    </p>
    
</div><!--bodywrapper-->
<!--<style> .bigdrop {
    width: 600px !important;
}</style>-->
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script>

var userFlag = 0;
$( document ).ready(function() {
							 
$('#update_contract').click(function(){ 
		var dataStringprop = $("#frm_contract").serialize();
		var isContactValid = contract_validate();
		if(isContactValid) {
		var candidateId = '<?php echo $candidate_id ?>';
			$.ajax({
				type: "post",
				url: "<?php echo site_url('candidates/add_contract_details'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						if(ret['STATUS']==1) {
							$('#step3-msg').show();
							
							$('#step3-msg').html('<div class="alert alert-success"><button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button><strong>Contract Details Updated Successfully</strong></div>');	
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
   });//end button click function save*/

	 function contract_validate() {
		
		if($('#total_months').val()== 0)
		{
			alert('Please select Total months');
			$('#total_months').focus();
			return false;
		}
		
	    return true;
    }
	
	
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
	    myearRange: "c-50:c+1"

	});
	
});   // end document.ready




</script>
