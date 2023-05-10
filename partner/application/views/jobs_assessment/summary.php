<div class="col-md-12">
<div class="profile_top">
<div class="profile_top_left">Summary &nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url();?>index.php/jobs_assessment/search_candidate/<?php echo $formdata['job_id'];?>">Search Candidates</a> &nbsp;&nbsp;&nbsp;||	

<!-- <a href="<?php echo base_url();?>index.php/jobs_assessment/send_mass_mail/<?php echo $formdata['job_id'];?>">Mass Email</a>	&nbsp;&nbsp;&nbsp; || 
&nbsp;&nbsp;&nbsp; --> 
&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>index.php/jobs_assessment/add_candidate/<?php echo $formdata['job_id'];?>">Add New Candidate</a>	&nbsp;&nbsp;&nbsp; ||</div>  

<div style="clear:both;"></div>
</div>

<div >

        <table border="0" cellpadding="3" cellspacing="3" width="100%">
            <tbody>
                
                <tr>
                <td colspan="2" align="center" valign="top">
                  <div class="tab-head mar-spec"><h3>Job Details</h3></div>
                </td>
                </tr>
                
                <tr>
                <td colspan="2" align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">

                        <tbody>
                            <tr>
                                <td width="19%"><span><strong>Job Title</strong></span></td>
                                <td width="27%"><span><?php echo $formdata['job_title'];?></span></td>
                                <td width="25%"><strong><span>Job Type</span></strong></td>
                                <td width="29%"><span><?php echo $formdata['job_type'];?></span></td>
                            </tr>
                            
                            <tr>
                                <td><span><strong>Company Name</strong></span></td>
                                <td><span><?php echo $formdata['company_name'];?></span></td>
                                <td><strong><span>Job Level</span></strong></td>
                                <td><span><?php echo $formdata['job_level'];?></span></td>
                            </tr>
                            
                            <tr>
                                 <td><span><strong>Job Industry</strong></span></td>
                                <td><span><?php echo $formdata['job_cat_name'];?></span></td>
                                <td><strong>Functional Area</strong></td>
                                <td><?php echo $formdata['fun_area'];?></td>

                            </tr>
                            
                            <tr>
                                <td><span><strong>Job Work Level</strong></span></td>
                                <td><span><?php echo $formdata['work_level'];?></span></td>
                                <td><strong>Vacancies</strong></td>
                                <td><?php echo $formdata['vacancies'];?></td>

                            </tr>
                            
                            <tr>
                               <td><strong>Job Location</strong></td>
                                <td><?php echo $formdata['job_lcoation_name'];?></td>
                                <td><strong>Salary</strong></td>
                                <td><?php echo $formdata['salary_desc'];?></td>

                            </tr>
                            
                            <tr>
                                 <td><strong>Preferred Gender</strong></td>
                                <td><?php if($formdata['gender']==1)echo 'Female';?>
                                  <?php if($formdata['gender']==2)echo 'Male';?>
                                <?php if($formdata['gender']==0)echo 'No Preference';?></td>
                                <td><strong>Job Posting Date</strong></td>
                                <td><?php echo $formdata['job_post_date'];?></td>

                            </tr>
                           
                            <tr>
                                 <td><strong>Expires on</strong></td>
                                <td><?php echo $formdata['job_expiry_date'];?></td>
                                <td><strong>Exp. join date</strong></td>
                                <td><?php echo $formdata['exp_join_date'];?></td>

                            </tr>
                            
                            <tr>
                                <td colspan="4"><strong>Download JD</strong>
                                  <?php if(file_exists('uploads/brochure/'.$formdata['brochure']) && $formdata['brochure']!=''){?>
                                  <a href="<?php echo $upload_root.'uploads/brochure/'.$formdata['brochure'];?>" target="_blank">Download</a>
                                <?php }else echo 'Not Uploaded'; ?></td>
                            </tr>
							<?php if($formdata['instructions']!=''){?>
							<tr>
                                <td colspan="4"><strong>Instructions to Recruiter</strong>
                                <?php echo $formdata['instructions'];?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
            		</table>
             	 </td>
       		</tr>

    
<tr>
      <td colspan="2" align="center" valign="top">
        <div class="tab-head mar-spec">
          <h3>Job Description </h3><div style="float:right;"><a id="toggle_jd" href="javascript:;" class="tab-head mar-spec">Show/Hide</a></div>
        </div>
      </td>
</tr>

<tr id="jd_details" style="display:none;">
    <td colspan="2" align="center" valign="top">
    
    <table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-condensed">
      <tbody>
        <tr>
          	<td>
			<?php echo $formdata['desired_profile'];?>
 	      </td>
        </tr>
        <tr>
          	<td>
			<?php echo $formdata['job_desc'];?>
 	      </td>
        </tr>
                
        </tbody>
    </table>
    
	 </td>
</tr>

<?php  if(!empty($applied_candidates)) { ?>

<tr>
              <td colspan="2" align="center" valign="top">
                <div class="tab-head mar-spec">
                  <h3>Candidates Applied&nbsp;&nbsp;[<?php echo count($applied_candidates);?>]&nbsp;&nbsp; [Rejected and shortlisted will not be in this list.]</h3><div style="float:right;"><a id="toggle_applied" href="javascript:;" class="tab-head mar-spec">View All</a></div>
                </div>

              </td>
</tr>

<tr id="candidate_applied_list" style="display:none;">
    <td colspan="2" align="center" valign="top">
    
    <table border="1" cellpadding="1" cellspacing="1" width="100%" class="table table-bordered table-condensed">

      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>App. Date</th>
          <th>Manager</th>
          <th>CTC</th>
          <th>ECTC</th>
          <th>Exp.</th>
          <th>Notice</th>
          </tr>
      </thead>

      <tbody >
        <?php foreach($applied_candidates as $candidate){?>
        
        <tr>
          	<td width="22%"><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $candidate['candidate_id'];?>);"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a>
            </td>
          	<td width="8%"><?php echo $candidate['mobile'];?>
</td> 
            <td width="16%"><?php echo $candidate['username'];?> <br>
           
 </td>
          
          <td width="7%"><?php echo $candidate['applied_on'];?>
</td>
          <td width="9%"><?php echo $candidate['firstname'];?></td>
          <td width="13%"><strong>
            <?php if($candidate['current_ctc']!='')echo $candidate['current_ctc'];else echo 'Nil'; ?>
          </strong>
      
 	      </td>
          <td width="14%"><strong>
            <?php if($candidate['expected_ctc']!='')echo $candidate['expected_ctc'];else echo 'Nil'; ?>
          </strong></td>
          <td width="5%"><strong>
            <?php if($candidate['total_experience']!='')echo $candidate['total_experience'];else echo 'Nil'; ?>
          </strong></td>
          <td width="6%"><strong>
            <?php if($candidate['notice_period']!='')echo $candidate['notice_period'];else echo 'Nil'; ?>
          </strong></td>
          </tr>
     	<tr>
         <td colspan="9">
         <table width="100%" border="0">
  <tbody>
    <tr>
      <td width="68%" align="right" valign="middle">
      
      <div style="float:left">CV Source:<a href="javascript:;" title="CV Source"  id="cv_source" class="btn btn-info btn-xs"><?php if($candidate['lead_source']==1)echo 'Recruiter';if($candidate['lead_source']==2)echo 'Web/Social Media';if($candidate['lead_source']==3)echo 'Vendor';if($candidate['lead_source']==4)echo 'Mobile';if($candidate['lead_source']==5 || $candidate['lead_source']=='')echo 'Source not updated';?></a>
      
         ||
     
<!-- 

   <a href="javascript:;" class="btn btn-warning btn-xs" title="View Profile" onclick="candidate_profile(<?php echo $candidate['candidate_id'];?>);">Master CV</a>

          
  <?php if($candidate['cv_file']!='' && file_exists('uploads/cvs/'.$candidate['cv_file'])){?>
        
  <a href="javascript:;" onclick="candidate_cv(<?php echo $candidate['candidate_id'];?>);" id="download_cv" data-url="<?php echo base_url();?>index.php/jobs_assessment/download_cv/<?php echo $candidate['candidate_id']?>" title="View CV" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i> Candidate CV</a>

  <?php }else{ ?>
   <span class="blink">No CV</span>
   <?php } ?>

   ||
   
-->

 <a href="javascript:;" class="btn btn-warning btn-xs" title="View Profile" onclick="open_client_cv(<?php echo $candidate['candidate_id'];?>,<?php echo $formdata['job_id'];?>);">Client CV</a>
                 
   ||        

 <a href="<?php echo base_url(); ?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id'];?>" target="_blank" title="Change Job"  class="btn btn-info btn-xs"> Edit Profile </a>

  </div>

 <?php if($candidate['total_calls']>0){?>
        
        <a href="javascript:;" title="<?php echo $candidate['last_call_date'];?> | <?php echo $candidate['last_call_note'];?> | <?php if($candidate['cur_job_status']==1)echo 'No Job';if($candidate['cur_job_status']==2)echo 'Working, But Need a Change';if($candidate['cur_job_status']==3)echo 'Not Interested';if($candidate['cur_job_status']==4)echo 'Seeking Good Opportunity';if($candidate['cur_job_status']==5)echo 'Need a change ';if($candidate['cur_job_status']==6)echo 'Call after 1 Year';if($candidate['cur_job_status']==7)echo 'Call after this month ';?>" onclick="add_calls(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/add_calls/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="add_calls" class="btn btn-info btn-xs"> Notes [<?php echo $candidate['total_calls'];?>] </a>
        
<?php }else{ ?>
        
<a href="javascript:;" title="No Calls Made" onclick="add_calls(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/add_calls/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="add_calls" class="btn btn-danger btn-xs"> Add Notes [?] </a>
        
<?php } ?>
        
<!--         
<a href="javascript:;" title="Add Notes" onclick="add_notes(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/add_notes/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="add_notes" class="btn btn-info btn-xs"> Notes </a>
-->


<a href="javascript:;" title="Update Consultant's Feedback" onclick="add_consultant_feedback(<?php echo $candidate['candidate_id'];?>,<?php echo $formdata['job_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/add_consultant_feedback/?candidate_id=<?php echo $candidate['candidate_id'];?>"  id="add_consultant_feedback" class="btn btn-<?php if($candidate['consultant_feedback']!='')echo 'info';else echo 'danger';?> btn-xs"> Consultant's Feedback</a>
        
        <?php if($candidate['app_status_id']==1){?>
        
        <a href="javascript:;" title="Short List this candidate" onclick="add_to_shortlist(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/add_to_shortlist/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="add_to_shortlist" class="btn btn-info btn-xs"> Short List </a>
        
        <a href="javascript:;" data-url="<?php echo base_url(); ?>index.php/jobs_assessment/reject_from_application/?job_app_id=<?php echo $candidate['job_app_id'];?>&job_id=<?php echo $formdata['job_id'];?>" title="Reject this candidate" onclick="manage_rejection(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);"  id="reject_from_application" class="btn btn-warning btn-xs"> Reject</a>

        <a href="javascript:;" title="Change Job"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/change_job/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>" onclick="manage_job_change(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" id="change_job" class="btn btn-info btn-xs"> Change Job </a>
        
<?php } ?>

        <!-- 
        <a href="javascript:;" title="Send Message" onclick="add_message(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/add_message/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="add_msg" class="btn btn-info btn-xs"> Msg to Mobile </a>

                   
        <a href="javascript:;" title="Update CTC" onclick="add_ctc(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/add_ctc/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="update_ctc" class="btn btn-info btn-xs"> CTC </a>

  <a href="javascript:;" title="Send Job Description by Email"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/send_jd/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="send_jd"><span class="label label-default"><i class="fa fa-envelope" aria-hidden="true"></i></span></a> &nbsp; 
  -->

        
  <?php if($candidate['linkedin_url']!=''){?>
  
  ||
  
        <a href="<?php echo $candidate['linkedin_url']?>" title="View Linkedin Profile" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i>Lin</a>
  <?php } ?>
        
        
</td>
    </tr>
  </tbody>
</table>

      
                  
         </td>

        </tr>
          
          
       	<?php } ?>
        </tbody>
    </table>

    
	 </td>
</tr>

<?php } ?> 

<?php  if(!empty($rejected_candidates)) { ?>
<tr>
              <td colspan="2" align="center" valign="top">
                <div class="tab-head mar-spec"><h3>Candidates Rejected &nbsp;&nbsp;[<?php echo count($rejected_candidates);?>]</h3><div style="float:right;"><a id="toggle_rejected" href="javascript:;" class="tab-head mar-spec">View All</a></div></div>  
              </td>
</tr>

<tr id="candidate_rejected" style="display:none;">
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
      
       <thead>
        <tr>
          <th>Candidate</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Date</th>
          <th>Recruiter</th>
          <th>Reason</th>
          <th>Action</th>
        </tr>
      </thead>
      
      <tbody >
      
      
        <?php foreach($rejected_candidates as $candidate){?>
        <tr>
          	<td width="25%"><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $candidate['candidate_id'];?>);"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>    
                  
            <td width="15%"><?php echo $candidate['mobile'];?></a></td> 
            <td width="15%"><?php echo $candidate['username'];?></a></td>
			<td width="15%"><?php echo $candidate['rejected_on'];?></td>
          	<td width="10%"><?php echo $candidate['firstname'];?></td>
            <td width="16%">
            
			<?php if($candidate['reason_for_reject']==1)echo 'Lack of Education';?>
            <?php if($candidate['reason_for_reject']==2)echo 'Not Qualified';?>
            <?php if($candidate['reason_for_reject']==3)echo 'Not Skilled';?>
            <?php if($candidate['reason_for_reject']==4)echo 'Not much experienced';?>
            
            <?php if($candidate['reason_for_reject']==5)echo 'Need Industry/Skill Change';?>
            <?php if($candidate['reason_for_reject']==6)echo 'Issue with Location';?>
            <?php if($candidate['reason_for_reject']==7)echo 'Candidate Profile is not Good';?>
            <?php if($candidate['reason_for_reject']==8)echo 'Bad Company Profile - Candidate Exprience ';?>
            
             <?php if($candidate['reason_for_reject']==9)echo 'Looking for Good Company Profile';?>
             <?php if($candidate['reason_for_reject']==10)echo 'Lack of Domain Experience';?>
             <?php if($candidate['reason_for_reject']==11)echo 'Issues with Office Time';?>
             <?php if($candidate['reason_for_reject']==12)echo 'Issues with Contract-Bond ';?>
             
             <?php if($candidate['reason_for_reject']==13)echo 'Problem with Salary ';?>             
             <?php if($candidate['reason_for_reject']==14)echo 'Issues with Language';?>
             <?php if($candidate['reason_for_reject']==15)echo 'No Response - Call/Email';?>
             <?php if($candidate['reason_for_reject']==16)echo 'Problem with Notice Period';?>
             <?php if($candidate['reason_for_reject']==17)echo 'Applied to Same Company';?>
             
             <?php if($candidate['reason_for_reject']==18)echo 'Not Interested';?>
             <?php if($candidate['reason_for_reject']==19)echo 'Interested - But in Wrong job App';?>
             <?php if($candidate['reason_for_reject']==20)echo 'Dont Know!';?>
             
             <?php if($candidate['reason_for_reject']==21)echo 'Call After Six Months';?>
             <?php if($candidate['reason_for_reject']==22)echo 'Call After 1 Year';?>
             
             
            </td>
          <td width="4%">
          
                  <a href="javascript:;" data-url="<?php echo base_url(); ?>index.php/jobs_assessment/reject_from_application/?job_app_id=<?php echo $candidate['job_app_id'];?>&job_id=<?php echo $formdata['job_id'];?>" title="Reject this candidate" onclick="manage_rejection(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);"  id="reject_from_application" class="btn btn-warning btn-xs"> Update</a>
          
          </td>
          
          </tr>
       	<?php } ?>
        </tbody>
    </table>
	 </td>
</tr>

<?php } ?> 

<!-- Candidates Schedule for Another job with same skills  BEGIN-->

<tr>
	<td colspan="2" align="center" valign="top" id="short" <?php  if(empty($shortlisted)) { ?> class="hide" <?php } ?>>

      <div class="tab-head mar-spec"><h3>Candidates Shortlisted&nbsp;&nbsp;[<?php echo count($shortlisted);?>]</h3> 
      <div style="float:right;"><a id="toggle_shortlisted" href="javascript:;" class="tab-head mar-spec">View All</a></div>
    
      
      </div>
    </td>
</tr>

<tr id="candidate_shortlisted" style="display:none;">

    <td colspan="2" align="center" valign="top">
    
     <a href='javascript:;'  onclick="send_shortlisted(<?php echo $formdata['job_id'];?>);" class="btn btn-warning btn-xs">Send This to Client</a><br><br>

<form class="form-horizontal form-bordered" action="<?php echo $this->config->site_url();?>/jobs_assessment/send_shortlisted"  method="post" id="shortlisted_form" name="shortlisted_form"> 

    <div class="modal fade" id="shortlisted_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes" style="height:auto;">
            <ul>
            	<li id="tab_2btn">Send to Client</li>            
            </ul>
            
            <div class="table-tech specs note">
            <div class="new_notes11">
            <div class="alert alert-info"><strong>Info!</strong> You can edit all details. Fill CC to get a copy of this email.</div>
             		<input type="hidden" name="candidate_id" id="shortlisted_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="shortlisted_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="shortlisted_job_id" value="<?php echo $formdata['job_id'];?>">      

                <table class="hori-form">
                <tbody>

				<tr>
                   <td>Contact Name</td>
                   <td>
                               
                    <input id="contact_name" type="text" name="contact_name" value="<?php echo $company_info['contact_name'];?>" placeholder="Contact Name" />                 [Phone: <?php echo $company_info['contact_phone'];?>]&nbsp;[Ext.: <?php echo $company_info['contact_phone_ext'];?>]
				  </td>
                 </tr>


				<tr>
                   <td>Designation</td>
                   <td>
                               
                    <input id="contact_designation" type="text" name="contact_designation" value="<?php echo $company_info['designation'];?>" placeholder="Designation" />                  
				  </td>
                 </tr>


				<tr>
                   <td>Email</td>
                   <td>
                               
                    <input id="contact_email" type="text" name="contact_email" value="<?php echo $company_info['contact_email'];?>" placeholder="Contact Email" />                  
				  </td>
                 </tr>
                
				<tr>
                   <td>Subject</td>
                   <td>
                               
                    <input id="email_subject" type="text" name="email_subject" value="Short Listed Candidates for job- <?php echo $formdata['job_title'];?>" placeholder="Please enter subject here" />                  
				  </td>
                 </tr>
                 
                <tr>
                   <td>CC To</td>
                   <td>
                               
                    <input id="email_cc" type="text" name="email_cc" value="" placeholder="Please enter your email" />                  
    </td>
                 </tr>
                <tr>

                <td>Email Content</td>
                 <td><?php echo form_textarea(array('name'=>'email_text', 'id' => 'email_text','class' => 'smallinput','rows' => '8', 'value' => 'Here is the list of matching candidate profiles for - '.$formdata['job_title'].', see below list'));?> </td>
                </tr>
    
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_shortlisted" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/send_shortlisted" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
           
        </div>
        
             
        <!--Followup-->
          
      </div>
      
      <div style="clear:both;"></div>
            </div>
            <!--Followup-->
        
            
    	
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">

      <thead>
        <tr>
          <th>&nbsp;</th>
          <th>Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Applied</th>
          <th>Short Listed On</th>
          <th>Feedback-Client</th>
          <th>Status</th>
          <th>Interview</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($shortlisted as $candidate){?>
        <tr>
           <td width="2%"><?php if($candidate['app_status_id']==3){?><input type="checkbox" name="short_id[]" id="short_id[]" value="<?php echo $candidate['short_id'];?>"><?php }else{ ?># <?php } ?>
           </td>
           <td width="20%"><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $candidate['candidate_id'];?>);"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a>
           <?php if($candidate['total_submission']>0){;?>
           <br>
<p>Submissions:<?php echo $candidate['total_submission'];?> Time(s).</p>
<?php } ?>
</td>          
            <td width="6%"><?php echo $candidate['mobile'];?></a></td> 
            <td width="6%"><?php echo $candidate['username'];?></a></td>
            <td width="5%"><?php echo $candidate['applied_on'];?></td>
            <td width="11%"><?php echo $candidate['short_date'];?></td>
            <td width="19%">           <?php if($candidate['client_feedback']<1)echo 'No Feedback';?>
              <?php if($candidate['client_feedback']==1)echo 'Selected';?>
              <?php if($candidate['client_feedback']==2)echo 'Not Skilled';?>
              <?php if($candidate['client_feedback']==3)echo 'Not Qualified.';?>
              <?php if($candidate['client_feedback']==4)echo 'No Exp.';?>
              <?php if($candidate['client_feedback']==5)echo 'No Domain Exp';?>
              <?php if($candidate['client_feedback']==6)echo 'Rejected';?> || 
              
              <a href='javascript:;'  onclick="add_feedback(<?php echo $candidate['short_id'];?>,<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" class="btn btn-warning btn-xs">Change</a>
              <br>
              
               <?php if($candidate['client_feedback']>=1)echo $candidate['client_notes'];?>               
               </td>
            
            <td width="15%">
            
            <?php if($candidate['client_feedback_status']==0) echo 'Shortlisted';?>
            <?php if($candidate['client_feedback_status']==1) echo 'Waiting Client Feedback';?>
            <?php if($candidate['client_feedback_status']==2) echo 'Feedback Received';?>
            <?php if($candidate['feedback_date']!='0000-00-00' && $candidate['client_feedback_status']==2)echo '['.$candidate['feedback_date'].']';?>           
            </td>
                 
         <td width="16%"><?php if($candidate['app_status_id']==3){?> <a href='javascript:;'  onclick="add_interview(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" class="btn btn-primary btn-xs">Interview</a>  || <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/delete_shortlisted_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_shortlisted_candidate" class="btn btn-danger btn-xs">X</a> 
		 
		 <?php }else{?>Scheduled<?php } ?>       
           
           
         </td>
          </tr>

       <?php } ?>
   
        </tbody>
     </table>
 </form>
    </td>
</tr>

<tr>
    <td colspan="2" align="center" valign="top" id="inter" <?php  if(empty($interview_list)) { ?> class="hide" <?php } ?>>
    <div class="tab-head mar-spec"><h3>Interviews Scheduled</h3></div>
    </td>
</tr>

<tr id="candidate_interview"  <?php  if(empty($interview_list)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    <a href='javascript:;'  class="btn btn-warning btn-xs">Interview List</a><br><br>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>Candidate</th>
            <th> Date</th>
            <th>Time</th>
            <th>Venue</th>
            <th>Mode</th>
            <th>Description</th>
            <th width="14%">Action</th>
          </tr>
        </thead>
          <tbody >
              
              <?php foreach($interview_list as $interview){
                  $datetime = explode(" ",$interview['interview_date']);?>
                <tr>
                  <td width="11%"><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $interview['candidate_id'];?>);"><?php echo $interview['first_name'].' '.$interview['last_name'];?></a></td>
                  <td width="16%"><?php echo $interview['interview_date'];?></td>
                  <td width="14%"><?php echo $interview['interview_time'];?></td>
                  <td width="10%"><?php echo $interview['location'];?></td>
                  <td width="13%"><?php echo $interview['interview_type'];?></td>
                  <td width="22%"><?php echo $interview['description'];?></td>
                  <td>
                  
                  
          <?php if($interview['total_rejection']==0  && $interview['selected']==0){?>       
                    <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/edit_interview/?job_app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="edit_interview" class="btn btn-primary btn-xs">Change</a>
                    
                  
                    <a href="javascript:;" onclick="select_candidate(<?php echo $interview['candidate_id'];?>,<?php echo $interview['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" class="btn btn-primary btn-xs"> Select </a>
                    
                    <a href="javascript:;" onclick="reject_interview_fn(<?php echo $interview['candidate_id'];?>,<?php echo $interview['job_app_id'];?>,<?php echo $interview['interview_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/reject_interview/"  id="reject_interview" class="btn btn-danger btn-xs">Reject </a>
                    <?php }else{ ?>
                    	 <?php if($interview['selected']>0){?> 
                            <a href="javascript:;" data-url=""  class="btn btn-primary btn-xs">Selected </a>
                           <?php }elseif($interview['total_rejection']>0){ ?>
                            <a href="javascript:;" data-url=""  class="btn btn-danger btn-xs">Rejected </a>
                           <?php } ?>
                    <?php } ?>
                    
                    
                    </td>
                </tr>
        		<?php } ?> 
            
                 
         </tbody>
    </table>
    </td>
</tr>

<tr id="candidate_interview_history"  <?php  if(empty($interview_history)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    <a href='javascript:;'  class="btn btn-warning btn-xs">Interview History</a><br><br>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>Candidate</th>
            <th>Applied On</th>
            <th>Interview Date</th>
            <th>Time</th>
            <th>Venue</th>
            <th>Mode</th>
            <th>Description</th>
            </tr>
        </thead>
          <tbody >
              
              <?php foreach($interview_history as $interview){
                  $datetime = explode(" ",$interview['interview_date']);?>
                <tr>
                  <td width="12%"><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $interview['candidate_id'];?>);"><?php echo $interview['first_name'].' '.$interview['last_name'];?></a></td>
                  <td width="16%"><?php echo $interview['applied_on'];?></td>
                  <td width="15%"><?php echo $interview['interview_date'];?></td>
                  <td width="11%"><?php echo $interview['interview_time'];?></td>
                  <td width="16%"><?php echo $interview['location'];?></td>
                  <td width="9%"><?php echo $interview['interview_type'];?></td>
                  <td width="21%"><?php echo $interview['description'];?></td>
                </tr>
        		<?php } ?> 
            
                 
         </tbody>
    </table>
    </td>
</tr>

<tr id="candidate_interview_rejection"  <?php  if(empty($interview_rejection_list)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    <a href='javascript:;'  class="btn btn-warning btn-xs">Rejected Candidates</a><br><br>
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>Candidate</th>
            <th>Interview Date</th>
            <th>Rejected On</th>
            <th>Reason</th>
            <th>Notes</th>
            </tr>
        </thead>
          <tbody >
              
              <?php foreach($interview_rejection_list as $interview){
                  $datetime = explode(" ",$interview['interview_date']);?>
                                                
              
                <tr>
                  <td width="11%"><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $interview['candidate_id'];?>);"><?php echo $interview['first_name'].' '.$interview['last_name'];?></a></td>
                  
                  <td width="11%"><?php echo $interview['interview_date'];?></td>
                  <td width="11%"><?php echo $interview['rejected_on'];?></td>
                  <td width="11%">
				  
				  <?php if($interview['reject_reason_id']==1)echo 'Poor Performance';?>
                  <?php if($interview['reject_reason_id']==2)echo 'Not Impressive';?>
                  <?php if($interview['reject_reason_id']==3)echo 'Negative Attitude';?>
                  <?php if($interview['reject_reason_id']==4)echo 'Being Dishonest';?>
                  <?php if($interview['reject_reason_id']==5)echo 'Uninteresting Interview Answers';?>
                  <?php if($interview['reject_reason_id']==6)echo 'Arriving Late';?>
                  <?php if($interview['reject_reason_id']==7)echo 'Being Rude';?>
                  <?php if($interview['reject_reason_id']==8)echo 'Not upto the mark';?>
                  <?php if($interview['reject_reason_id']==9)echo 'Technical Rejection';?>
                  <?php if($interview['reject_reason_id']==10)echo 'Salary expectations are not met';?>
                  
                  </td>
                  <td width="12%"><?php echo $interview['reject_notes'];?></td>
                </tr>
        		<?php } ?> 
            
                 
         </tbody>
    </table>
    </td>
</tr>


<tr>
    <td colspan="2" align="center" valign="top" id="sel" <?php  if(empty($candidates_selected)) { ?> class="hide" <?php } ?>>
      <div class="tab-head mar-spec"><h3>Candidates Selected</h3></div>
      </td>
</tr>

<tr id="candidate_selected" <?php  if(empty($candidates_selected)) { ?> class="hide" <?php } ?>>
    <td colspan="2" align="center" valign="top">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">
            <thead>
               <tr>
                     	<th>Candidate</th>
                        <th>Select Date</th>
                       
                        <th>Feedback/Rate</th>
                        <th width="17%">Action</th>
                  </tr>
              </thead>
                  <tbody >
                  
                  <?php foreach($candidates_selected as $selected){?>
                                                    
                  
                    <tr>
                      <td width="19%"><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $selected['candidate_id'];?>);"><?php echo $selected['first_name'].' '.$selected['last_name'];?></a></td>
                      <td width="19%"><?php echo $selected['select_date'];?></td>
                      
                       <td width="45%"><?php echo $selected['feedback'];?></td>
                      <td>
                      <?php if($selected['offered']==0){?>
                      <a href='javascript:;' onclick="issue_offer(<?php echo $formdata['job_id'];?>,<?php echo $selected['app_id'];?>,<?php echo $selected['candidate_id'];?>);" id="issue_offer" class="btn btn-info btn-xs"> Issue Offer </a> &nbsp;<a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/delete_selectedcandidate/?job_app_id=<?php echo $selected['app_id'];?>&candidate_id=<?php echo $selected['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_selected_candidate" class="btn btn-danger btn-xs">X </a>
                      <?php }else{ ?>
                      Offered
                      <?php } ?>
                      
                      
                      </td>
                    </tr>
                    
                <?php } ?> 
                    
                    </tbody>
            </table>  
     </td>
</tr>

<tr id="candidate_offer1">
    <td colspan="2" align="center" valign="top" id="sel" <?php  if(empty($offer_letters_issued)) { ?> class="hide" <?php } ?>>
      <div class="tab-head mar-spec"><h3>Offer Letters Issued for Candidates below </h3></div>
      </td>
</tr>
                    
<tr id="candidate_offer2"  <?php  if(empty($offer_letters_issued)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
					 <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">
					 <thead>
					  <tr>
							<th width="11%">Candidate</th>
							<th width="12%">Offer Date</th>
							<th width="15%">Salary Offered</th>
							
							<th width="23%">Offer Status</th>
							<th width="25%">Reject Reason</th>
							
							<th width="14%">Action</th>
						</tr>    
    </thead>
  <tbody>

        <?php 
			foreach($offer_letters_issued as $offerletter)
			{
				$offer_status='';		  				
				if($offerletter['offer_status']==1)$offer_status='Offered';
				if($offerletter['offer_status']==2)$offer_status='Accepted';
				if($offerletter['offer_status']==3)$offer_status='Rejected';
			?>

<tr>
	<td ><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $offerletter['candidate_id'];?>);"><?php echo $offerletter['first_name'].' '.$offerletter['last_name'];?></a></td>
	<td ><?php echo date("d-m-Y", strtotime($offerletter['offer_date']))?></td>
    <td ><?php echo $offerletter['salary_offered']?></td>
    <td >

	<?php if($offerletter['offer_status']==1){?>		
	    <a href="javascript:;" class="btn btn-success btn-xs"> <?php echo $offer_status;?> </a>
    <?php }elseif($offerletter['offer_status']==2){ ?>
    	<a href="javascript:;" class="btn btn-success btn-xs"> <?php echo $offer_status;?> </a>
    <?php }elseif($offerletter['offer_status']==3){ ?>
	    <a href="javascript:;" class="btn btn-danger btn-xs"><?php echo $offer_status;?> </a>
    <?php } ?>
    </td>
    
    <td ><?php echo $offerletter['reason']?></td>
    
    <td>
     	
    <?php if($offerletter['offer_status']==1){?>		
    
      <a href="javascript:;" onclick="accept_offer(<?php echo $formdata['job_id'].','.$offerletter['app_id'].','.$offerletter['candidate_id']?>);" class="btn btn-success btn-xs"> Accept </a>  <a href="javascript:;" onclick="reject_offer(<?php echo $formdata['job_id'].','.$offerletter['app_id'].','.$offerletter['candidate_id']?>);" class="btn btn-warning btn-xs"> Reject </a>&nbsp;<a href="javascript:;"  data-url="<?php echo base_url().'index.php/jobs_assessment/delete_offercandidate/?job_app_id='.$offerletter['app_id'].'&candidate_id='.$offerletter['candidate_id'].'&job_id='.$formdata['job_id'];?>"  id="delete_offer_candidate" class="btn btn-danger btn-xs">X </a>
      
      <?php }else{ ?>
      Status Changed
      <?php } ?>
      
      
      </td>                                  
          </tr>

       <?php } ?>
   
        </tbody>
     </table>

    </td>
</tr>

<tr id="offer_accepted1">
    <td colspan="2" align="center" valign="top" id="sel" <?php  if(empty($offer_accepted)) { ?> class="hide" <?php } ?>>
      <div class="tab-head mar-spec"><h3>Offer Accepted</h3></div>
      </td>
</tr>

<tr id="offer_accepted2">

        <td colspan="2" align="center" valign="top" <?php  if(empty($offer_accepted)) { ?> class="hide" <?php } ?>>
         <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
          <tbody >
          <tr>
             <td>Candidate</td>
            <td>Accept Date</td>
            <td>Accepted Salary</td>
            <td>Min.Contract Months</td>
            <td width="18%">Actions</td>
        </tr>
        
        <?php 
			foreach($offer_accepted as $accepted)
			{
			?>
				<tr>
				 <td width="33%">
                 <a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $accepted['candidate_id'];?>);">
				 <?php echo $accepted['first_name'].' '.$accepted['last_name'];?>
                 </a>
                 </td>
				 <td width="14%"><?php echo date("d-m-Y", strtotime($accepted['offer_accepted_date']))?></td>
			  	 <td width="19%"><?php echo $accepted['monthly_salary_offered'];?></td>
				 <td width="16%"><?php echo $accepted['min_contract_months'];?></td>
			     <td>
                 
                 <p> <a href="javascript:;" onclick="create_invoice(<?php echo $formdata['job_id'].','.$accepted['app_id'].','.$accepted['candidate_id'].','. $accepted['placement_id']?>);" class="btn btn-primary btn-xs">Invoice</a>&nbsp;<a href="javascript:;" data-url="<?php echo base_url().'index.php/jobs_assessment/delete_acceptcandidate/?job_id='.$formdata['job_id'].'&app_id='.$accepted['app_id'].'&candidate_id='.$accepted['candidate_id'].'&placement_id='.$accepted['placement_id']?>" id="delete_accept_candidate" class="btn btn-danger btn-xs">X </a></p></td>
                 
           		</tr>                                   
                    
                    <?php } ?>
 </tbody>
     </table>

</tr>



<tr>
    <td colspan="2" align="center" valign="top" id="invoice" <?php  if(empty($invoice_generated)) { ?> class="hide" <?php } ?>>
    <div class="tab-head mar-spec"><h3>Invoice against this Job</h3></div>
      </td></tr>

<tr id="candidate_invoice" <?php  if(empty($invoice_generated)) { ?> class="hide" <?php } ?>>
  <td colspan="2" align="center" valign="top">
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
        <thead>
            <tr>
                <th>Candidate</th>
                <th>Inv. Date</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Amt.</th>
                <th>Status</th>
                <th>For</th>
                <th width="7%">Action</th>
          </tr>
        </thead>
          <tbody >
          
              
              <?php foreach($invoice_generated as $invoice){?>                                                
              
                <tr>
                  <td width="17%"><a href="javascript:;" title="View Profile" onclick="candidate_profile(<?php echo $invoice['candidate_id'];?>);"><?php echo $invoice['first_name'].' '.$invoice['last_name'];?></a></td>
                  <td width="11%"><?php echo $invoice['invoice_date'];?></td>
                  <td width="11%"><?php echo $invoice['invoice_start_date'];?></td>
                  <td width="14%"><?php echo $invoice['invoice_due_date'];?></td>
                  <td width="14%"><?php echo $invoice['invoice_amount'];?></td>
                  <td width="13%"><?php if($invoice['invoice_status']=='1')echo 'Paid';if($invoice['invoice_status']=='2')echo 'Unpaid';if($invoice['invoice_status']=='3')echo 'Due';?></td>		
                  <td width="13%"><?php if($invoice['client_candidate']=='1')echo 'Client';if($invoice['client_candidate']=='2')echo 'Candidate';?></td>
                  <td>
                  <p><!--
                  <a href="<?php echo base_url(); ?>index.php/jobs_assessment/create_invoice/?job_id=<?php echo $formdata['job_id'];?>/?placement_id=<?php echo $invoice['placement_id'];?>&invoice_id=<?php echo $invoice['invoice_id'];?>" class="btn btn-primary btn-xs">Edit</a> -->
                  <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs_assessment/delete_invoice/?job_id=<?php echo $formdata['job_id'];?>&placement_id=<?php echo $invoice['placement_id'];?>&invoice_id=<?php echo $invoice['invoice_id'];?>"  id="delete_invoice_candidate" class="btn btn-danger btn-xs">X</a>
                   </p>       
                 
                   
                   </td>
                </tr>
                
            <?php } ?> 
            
         </tbody>
      </table>  
   </td>
</tr>

                        
</tbody>
</table>

<!---------- Modal1 for Calls--------------------->

<div class="modal fade" id="calls_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Calls</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered"  method="post" id="calls_form" name="calls_form"> 
            
             		<input type="hidden" name="candidate_id" id="call_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="call_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="call_job_id" value="<?php echo $formdata['job_id'];?>">      
               
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Present Job Status</td>
                   <td>
                   
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="1"  checked="checked" />No Job <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="2"/>Working, But Need a Change <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="3"/>Not Interested <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="4"/>Seeking Good Opportunity <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="5"/>Need a change <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="6"/>Call after 1 Year <br>
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="7"/>Call after this month                     
    </td>
                 </tr>
                
                <tr>
                <td>Call Date</td>
                 <td><input type="text" name="call_date" class="smallinput datepicker" readonly id="datepicker" value="<?php echo date('Y-d-m');?>"  /></td>
                </tr>
                
                <tr>
                <td>Call Time</td>
                 <td><?php echo form_dropdown('call_time', $interview_time_ar);?></td>
                </tr>
                
                <tr>

                <td>Notes</td>
                 <td><?php echo form_input(array('name'=>'call_notes', 'id'=>'call_notes','class' => 'smallinput'));?> </td>
                </tr>
                
                <!-- 
                <tr>
                  <td colspan="2"><table width="100%" border="0">
                    <tbody>
                      <tr>
                        <td><input type="text" name="cur_ctc" class="smallinput" placeholder="Cur CTC"  /></td>
                        <td><input type="text" name="exp_ctc" class="smallinput" placeholder="EXP CTC" /></td>
                        <td><input type="text" name="exp_years" class="smallinput" placeholder="Total Exp" /></td>
                        <td><input type="text" name="notice_period" class="smallinput" placeholder="Notice"  /></td>
                      </tr>
                    </tbody>
                  </table></td>
                </tr>
                
                -->
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_calls" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/add_calls" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="add_to_shortlist_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Feedback</li>            
            </ul>
            <!--Followup--><br>
<br>

        
            <div class="table-tech specs note">
            <div class="new_notes">
            <div class="alert alert-info"><strong>Info!</strong>&nbsp;This job application will be moved from this list to shortlisted.</div>
            
            <form class="form-horizontal form-bordered"  method="post" id="add_to_shortlist_form"  action="<?php echo $this->config->site_url();?>/jobs_assessment/add_to_shortlist"  name="add_to_shortlist_form"> 
            
             		<input type="hidden" name="candidate_id" id="add_to_shortlist_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="add_to_shortlist_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="add_to_shortlist_job_id" value="<?php echo $formdata['job_id'];?>">      
               		<input type="hidden" name="recruiter_feedback_date" value="<?php echo date('Y-m-d')?>">
                    
                <table class="hori-form">
                <tbody>
                                                                                    
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Shortlist" id="save_to_short_list" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/add_to_shortlist" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="rejection_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="rejection">
            <ul>
            	<li id="tab_2btn">Reject Applications</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered" action="<?php echo $this->config->site_url();?>/jobs_assessment/manage_rejection"  method="post" id="rejection_form" name="rejection_form"> 
            
             		<input type="hidden" name="candidate_id" id="rej_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="rej_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="rej_job_id" value="<?php echo $formdata['job_id'];?>">      
               
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Present Job Status</td>
                   <td>
                   
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="1"  checked="checked" />Lack of Education <br>                    
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="2"/>Not Qualified <br>                    
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="3"/>Not Skilled <br>                    
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="4"/>Not much experienced <br>                    
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="5"/>Need Industry/Skill Change <br>                    
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="6"/>Issue with Location  <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="7"/>Candidate Profile is not Good <br>  
                    
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="8"/>Bad Company Profile - Candidate Exprience <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="9"/>Looking for Good Company Profile <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="10"/>Lack of Domain Experience  <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="11"/>Issues with Office Time <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="12"/>Issues with Contract-Bond <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="13"/>Problem with Salary <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="14"/>Issues with Language <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="15"/>NO Response - Call/Email <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="16"/>Problem with Notice Period <br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="17"/>Applied to Same Company <br>  
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="18"/>Not Interested<br>
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="19"/>Interested - But in Wrong job App<br> 
                    <input id="cur_job_status" type="radio" name="reason_for_reject" value="20"/>Dont Know!<br> 
                    
                     <input id="cur_job_status" type="radio" name="reason_for_reject" value="21"/>Call After Six Months<br> 
                     
                      <input id="cur_job_status" type="radio" name="reason_for_reject" value="22"/>Call After 1 Year<br>        
        
       
    </td>
                 </tr>
                
                <tr>
                <td>Call Date</td>
                 <td><input type="text" value="<?php echo date('Y-m-d')?>" name="rejected_on" class="smallinput datepicker" readonly id="datepicker"  /></td>
                </tr>

                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_rejection" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/manage_rejection" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="change_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="rejection">
            <ul>
            	<li id="tab_2btn">Jobs List - Select Any Job</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            
            <form class="form-horizontal form-bordered" action="<?php echo $this->config->site_url();?>/jobs_assessment/save_job_change"  method="post" id="change_form" name="change_form"> 
            
             		<input type="hidden" name="candidate_id" id="change_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="change_job_app_id" value="">    
                     <input type="hidden" name="cur_job_id"  id="change_job_id" value="<?php echo $formdata['job_id'];?>">      

                <table class="hori-form">
                <tbody>
                <tr bgcolor="#E3E3E3">
                   <td> <input type="checkbox" name="remove_from" value="1"></td>
                   <td>Remove from this job</td>
                 </tr>
                 
                  <?php 
				   
				   foreach($job_change_list as $key => $val)
				   {
					?>
				<tr>
                   <td> <input type="checkbox" name="job_id[]" value="<?php echo $val['job_id'];?>"></td>
                   <td><?php echo $val['job_title'];?><br><?php echo $val['company_name'];?></td>
                 </tr>
                 <?php    
				   }
				   
				   ?>

                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Change Job" id="save_job_change" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/save_job_change" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="feedback_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Feedback</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">

            <p id="result"></p>
            <p id="deletemessage"></p>

<form class="form-horizontal form-bordered" action="<?php echo $this->config->site_url();?>/jobs_assessment/add_feedback"  method="post" id="feedback_form" name="feedback_form">
            		<input type="hidden" name="short_id" id="feedback_short_id" value="">
             		<input type="hidden" name="candidate_id" id="feedback_candidate_id" value="">
                    <input type="hidden" name="app_id"  id="feedback_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="feedback_job_id" value="<?php echo $formdata['job_id'];?>">      
               
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Change Client Feedback to</td>
                   <td>
                               
                    <input id="client_feedback" type="radio" name="client_feedback" value="0" />No Feedback<br>                    
                    <input id="client_feedback" type="radio" name="client_feedback" value="1" checked/>Selected<br>                    
                    <input id="client_feedback" type="radio" name="client_feedback" value="2"/>Not Skilled<br>                    
                    <input id="client_feedback" type="radio" name="client_feedback" value="3"/>Not Qualified.<br>                    
                    <input id="client_feedback" type="radio" name="client_feedback" value="4"/>No Exp.<br>                    
                    <input id="client_feedback" type="radio" name="client_feedback" value="5"/>No Domain Exp<br>
                    <input id="client_feedback" type="radio" name="client_feedback" value="6"/>Rejected                  
    </td>
                 </tr>
                
                <tr>
                <td>Date</td>
                 <td><input type="text" name="feedback_date" class="smallinput datepicker" readonly id="datepicker"  /></td>
                </tr>
                
                <tr>

                <td>Notes</td>
                 <td><?php echo form_input(array('name'=>'client_notes', 'id'=>'client_notes','class' => 'smallinput'));?> </td>
                </tr>
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save Feedback" id="save_feedback" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/add_feedback" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="ctc_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Interview</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            <form class="form-horizontal form-bordered"  method="post" id="ctc_form" name="ctc_form"> 
             		<input type="hidden" name="candidate_id" id="ctc_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="ctc_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="ctc_job_id" value="<?php echo $formdata['job_id'];?>">      
               
                <table class="hori-form">
                <tbody>
                
                <tr>
                  <td colspan="2"><table width="100%" height="" border="0">
                    <tbody>
                      <tr>
                        <td><input type="text" name="cur_ctc" class="smallinput" placeholder="Cur CTC"  /></td>
                        <td><input type="text" name="exp_ctc" class="smallinput" placeholder="EXP CTC" /></td>
                        <td><input type="text" name="exp_years" class="smallinput" placeholder="Total Exp" /></td>
                        <td><input type="text" name="notice_period" class="smallinput" placeholder="Notice"  /></td>
                      </tr>
                    </tbody>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_ctc" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/add_ctc" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="notes_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Interview</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered"  method="post" id="notes_form" name="notes_form"> 
             		<input type="hidden" name="candidate_id" id="notes_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="notes_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="notes_job_id" value="<?php echo $formdata['job_id'];?>">      
               
                <table class="hori-form">
                <tbody>
              
                <tr>
                <td>Date</td>
                 <td><input type="text" name="note_date" class="smallinput datepicker" readonly id="datepicker"  /></td>
                </tr>

                <tr>
                <td>Title</td>
                 <td><?php echo form_input(array('name'=>'title', 'id'=>'title','class' => 'smallinput'));?> </td>
                </tr>
                
                <tr>
                <td>Notes</td>
                 <td><?php echo form_input(array('name'=>'notes_text', 'id'=>'notes_text','class' => 'smallinput'));?> </td>
                </tr>
                
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_notes" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/add_notes" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="message_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Message</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered" action="<?php echo $this->config->site_url();?>/jobs_assessment/add_message"  method="post" id="message_form" name="message_form"> 
             		<input type="hidden" name="candidate_id" id="msg_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="msg_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="msg_job_id" value="<?php echo $formdata['job_id'];?>">      
               
                <table class="hori-form">
                <tbody>	
                
			<tr>
                <td>Message</td>
                 <td><?php echo form_input(array('name'=>'message_text', 'id'=>'message_title','style' => 'width:400px;height:100px;'));?> </td>
                </tr>
                                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_message" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/add_message" />
                 
                  </span>
                  </td>
                </tr>
                
                
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="interview_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Interview</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered"  method="post" id="interview_form" name="interview_form" action="<?php echo $this->config->site_url();?>/jobs_assessment/addinterview"> 
             		<input type="hidden" name="candidate_id" id="int_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="int_job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="int_job_id" value="<?php echo $formdata['job_id'];?>">      
               
                <table class="hori-form">
                <tbody>
                
                <tr>
                <td>Interview Title</td>
                 <td><?php echo form_input(array('name'=>'title','id' =>'int_title', 'class' => 'smallinput'));?> </td>
                </tr>
                
                
                <tr>
                <td>Interview Type</td>
                <td><?php echo form_dropdown('interview_type_id', $interview_type,'','id = "int_type_id"');?></td>
                </tr>
                
                <tr>
                <td>Interview Status</td>
                 <td><?php echo form_dropdown('int_status_id', $int_status_id,'','id = "int_status_id"');?></td>
                </tr>
                
                <tr>
                <td>Location</td>
                 <td><?php echo form_input(array('name'=>'location','id'=>'int_location','class'=>'smallinput'));?></td>
                </tr>
                
                <tr>
                <td>Interview Date</td>
                 <td><input type="text" name="interview_date" class="smallinput datepicker" id="int_datepicker"  /></td>
                </tr>
                
                <tr>
                <td>Interview Time</td>
                 <td><?php echo form_dropdown('interview_time', $interview_time_ar);?></td>
                </tr>
                
                <tr>

                <td>Description</td>
                 <td><?php echo form_input(array('name'=>'description', 'id'=>'int_description','class' => 'smallinput'));?> </td>
                </tr>
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_interview" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/addinterview" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="reject_interview_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Reject</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered"  method="post" id="reject_interview_form" name="interview_form" action="<?php echo $this->config->site_url();?>/jobs_assessment/reject_interview"> 
             		<input type="hidden" id="reject_candidate_id" name="candidate_id" value="">
                    <input type="hidden" id="reject_job_app_id"  name="job_app_id" value="">    
                     <input type="hidden" id="reject_job_id"  name="job_id" value="<?php echo $formdata['job_id'];?>"> 
                      <input type="hidden" id="reject_interview_id"  name="interview_id" value="">         
               
                <table class="hori-form">
                <tbody>
                
                <tr>
                <td>Reason</td>
                 <td>
                 
                 <input type="radio" name="reject_reason_id" value="1" checked>Poor Performance<br>
                <input type="radio" name="reject_reason_id" value="2">Not Impressive<br>
                <input type="radio" name="reject_reason_id" value="3">Negative Attitude<br>
                <input type="radio" name="reject_reason_id" value="4">Being Dishonest<br>
                <input type="radio" name="reject_reason_id" value="5">Uninteresting Interview Answers.<br>
                <input type="radio" name="reject_reason_id" value="6">Arriving late.<br>
                <input type="radio" name="reject_reason_id" value="7">Being Rude<br>
                <input type="radio" name="reject_reason_id" value="8">Not upto the mark <br>
                <input type="radio" name="reject_reason_id" value="9">Technical Rejection<br>
                <input type="radio" name="reject_reason_id" value="10">Salary expectations are not met
                 </td>
                </tr>
               
                <tr>
                <td>Date</td>
                 <td><input type="text" name="rejected_on" value="<?php echo date('Y-m-d');?>" class="smallinput datepicker" id="rejected_on"  /></td>
                </tr>
                
                <tr>

                <td>Notes</td>
                 <td><textarea name="reject_notes" cols="40" rows="10" id="reject_notes" style="width:400px;height:100px;"></textarea></td>
                </tr>
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Reject" id="reject_interview_button" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/reject_interview"/>
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="select_candidate_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="profile_top">
                
                <form class="form-horizontal form-bordered"  method="post" id="select_candidate_form" name="select_candidate_form" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id_select"value="">
                  <input type="hidden" name="app_id" id="app_id_select" value="">
                  <input type="hidden" name="job_id" id="job_id_select" value="">
                  
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                            <td>Feedback</td>
                             <td><textarea name="feedback" cols="30" rows="4"></textarea></td>
                        </tr>
                        
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="select_candidate_btn"  
                             data-url="<?php echo base_url(); ?>index.php/jobs_assessment/select_candidate/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>" />
                              </span>
                          </td>
                	   </tr>
                      </tbody>
                  </table>
                
                </form>
                   
	<!--Followup-->

   </span>  
  </div>
</div>

<!------------------------ end modal4------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="issue_offer_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Issue Offer</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered"  method="post" id="issue_offer_form" name="issue_offer_form"> 
             		<input type="hidden" name="candidate_id" id="candidate_id_io" value="">
                    <input type="hidden" name="app_id"  id="app_id_io" value="">    
                     <input type="hidden" name="job_id"  id="job_id_io" value="">      
                
                <table class="hori-form">
                	<tbody>
						 
                         <tr>
                            <td>Title</td>
                            <td><input type="text" name="title" class="smallinput"/></td>
                        </tr>
                        
                         <tr>
                            <td>Offer Issued on</td>
                            <td><input type="text" name="offer_date" class="smallinput datepicker" id="datepicker"  readonly/></td>
                        </tr>
                       
                        <tr>
                            <td>Salary Offered</td>
                            <td><input type="text" name="salary_offered" class="smallinput"/></td>
                        </tr>
                        
                        <tr>
                             <td>Is it Negotiable?</td>
                             <td><input type="radio"  name="negotiation" value="1">&nbsp;Yes&nbsp;
                             <input type="radio"  name="negotiation" value="2" >&nbsp;No&nbsp;
                             
                        </tr>
                      <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_issue_offer" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs_assessment/issue_offer" />
                             
                              </span>
                          </td>
                	   </tr>
                    </tbody>
              </table>
            
            </form>
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="myModal_reject" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
           
                </div>
            
    <div class="notes">
        <div class="table-tech specs note">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
                
               <form class="form-horizontal form-bordered"  method="post" id="reject_form" name="reject_form"> 
             		<input type="hidden" name="candidate_id" id="candidate_id_reject" value="">
                    <input type="hidden" name="app_id"  id="app_id_reject" value="">    
                     <input type="hidden" name="job_id"  id="job_id_reject" value="">      
                
                <table class="hori-form">
                	<tbody>
 
                        <tr>
                        <td>Reason</td>
                         <td><textarea  name="reason" rows="4" cols="30" class="smallinput" id="reason"></textarea></td>
                        </tr>
                        

                      <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_reject" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs_assessment/reject_offer" />
                             
                              </span>
                          </td>
                	   </tr>
                    </tbody>
              </table>
                        
        </form>
    </div>
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>

<div style="clear:both;"></div>
</div>
</div>
</div>


<div class="modal fade" id="accept_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
           
                </div>
            
    <div class="notes">
        <div class="table-tech specs note">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
                
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4"> 
             		<input type="hidden" name="candidate_id" id="candidate_id1" value="">
                    <input type="hidden" name="app_id"  id="app_id1" value="">    
                     <input type="hidden" name="job_id"  id="job_id1" value="">      
                
                <table class="hori-form">
                	<tbody>


                        
                        <tr>
                        <td>Offer Accepted Date</td>
                         <td><input type="text" name="offer_accepted_date" class="smallinput datepicker" id="datepicker"  readonly/></td>
                        </tr>
                        
                        <tr>
                        <td>Planned Join Date</td>
                           <td><input type="text" name="join_date" class="smallinput datepicker" id="datepicker"  readonly/></td>
                        </tr>
                        
                        <tr>
                        <td>Accepted Salary</td>
                         <td><?php echo form_input(array('name'=>'monthly_salary_offered', 'class' => 'smallinput'));?>  </td>
                        </tr>
                        
                        <tr>
                        <td>Total CTC</td>
                         <td><?php echo form_input(array('name'=>'total_ctc', 'class' => 'smallinput'));?> </td>
                        </tr>
                        
                        <tr>
                        <td>Min. Contract Months</td>
                         <td>
						 <select class="smallinput form-control"  id="min_contract_months" name="min_contract_months">
                         <option value="">Select Months</option>
                         <?php for($i=1;$i<=36;$i++){ ?>
                            <option value="<?php echo $i; ?>"><?php echo $i.' months'; ?></option>
                         <?php } ?>  
                          </select>
	<?php //echo form_input(array('name'=>'min_contract_months', 'class' => 'smallinput'));?> </td>
                        </tr>

                        
                      <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_candidate4" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs_assessment/accept_offer2" />
                              
                              </span>
                          </td>
                	   </tr>
                    </tbody>
              </table>
                        
        </form>
    </div>
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>

<!------------------------ end modal2------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>


<div class="modal fade" id="invoice_model" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Invoice List</div>

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="invoice_form" name="invoice_form" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id2"value="">
                  <input type="hidden" name="app_id" id="app_id2" value="">
                  <input type="hidden" name="placement_id" id="placement_id2" value="">
                  <input type="hidden" name="job_id" id="job_id2" value="">
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                            <td>Invoice Date</td>
                             <td><input type="text" name="invoice_date" class="smallinput datepicker" id="datepicker"  /></td>
                        </tr>
                        
                        <tr>
                            <td>Invoice Start Date</td>
                             <td><input type="text" name="invoice_start_date" class="smallinput datepicker" id="datepicker" /></td>
                        </tr>
                        
                        <tr>
                            <td>Invoice Due Date</td>
                             <td><input type="text" name="invoice_due_date" class="smallinput datepicker" id="datepicker"  /></td>
                        </tr>
                        
                        <tr>
                            <td>Replacement Date</td>
                             <td><input type="text" name="replacement_date" class="smallinput datepicker" id="datepicker" /></td>
                        </tr>
                        
                        <tr>
                            <td>Invoice Amount</td>
                             <td><?php echo form_input(array('name'=>'invoice_amount', 'class' => 'smallinput'));?> </td>
                        </tr>
                        
                        <tr>
                             <td>Invoice Status</td>
                             <td><input type="radio"  name="invoice_status" value="1">&nbsp;Paid&nbsp;
                             <input type="radio"  name="invoice_status" value="2"  checked>&nbsp;Unpaid&nbsp;
                             <input type="radio"  name="invoice_status" value="3">&nbsp;Due</td>
                        </tr>
                        
                        <tr>
                             <td>Created For</td>
                             <td><input type="radio"  name="client_candidate" value="1">&nbsp;Client&nbsp;
                             <input type="radio"  name="client_candidate" value="2"  checked>&nbsp;Candidate&nbsp;</td>
                        </tr>
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="invoice_btn" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs_assessment/create_invoice2" />
                             
                              </span>
                          </td>
                	   </tr>
                      </tbody>
                  </table>
                
                </form>
                   
	<!--Followup-->

          
      </div>
    </div>
  </div>
</div>

<!------------------------ end modal3------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="candidate_profile"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:1000px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br><h3>Profile</h3>
        <div id="show_candidate_profile" style="overflow: scroll;"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="client_cv_modal"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:1200px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br><h3>Client's CV</h3>
        <div id="show_client_cv" style="overflow: scroll;"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="candidate_cv"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:1000px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br><h3>Candidate CV</h3>
        <div id="show_candidate_cv" style="overflow: scroll;"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="consultant_feedback"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:800px;height:600px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br><h3>Consultants Feedback</h3>
         
         <div class="alert alert-info"><strong>Info!</strong>&nbsp;Update consultant's feedback from here. This will be showed to the client when submit a CV.</div>
         
        <div id="show_consultant_feedback" style="width:750px;height:400px;">Loading...</div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


</div>
</div>
</section>

<script type="text/javascript">

$('input[type=text]').addClass('form-control');

<!--  loading on window on load  --> 

<!---- Interview selection  list load, get selection, all selection related activities ----->
//get selected
//get_select_candidate('<?php echo $formdata['job_id'];?>');
function get_select_candidate(job_id)
{ 
	$.ajax({
	   type: 'POST',
		data: {job_id:job_id},
		dataType: "json",
	   url: '<?php echo base_url(); ?>index.php/jobs_assessment/get_select_candidate/',
	   success: function(data){ 
			$('#candidate_schedule1').html(data.data1);
			$('#candidate_schedule2').html(data.data2);
	   }
	 }); 
}

// candidate selection
function select_candidate(id1,id2,id3)
{
	$('#candidate_id_select').val(id1);
   	$('#app_id_select').val(id2);
	$('#job_id_select').val(id3);
    $('#select_candidate_modal').modal();
}

$(document).on('click', '#select_candidate_btn', function(){ 													 
		var $this = $(this);
		var $url = $this.data('url'); 
	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#select_candidate_form').serialize(),
			dataType: "json",
			success: function(data) {
	
				 if(data.status == 'success'){					
				 	location.reload();
				/*
					$('#select_candidate_modal').modal('hide');	
					$('#sel').removeClass();
					$('#candidate_selected').removeClass();
					$('#candidate_selected').html(data.data);
					$("#select_candidate_form").trigger( "reset" );
					get_select_candidate('<?php echo $formdata['job_id'];?>');					
				*/					
				 }
				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});
	});

<!---- end here  ----->

$(document).on('click', '#invoice_btn', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
						
			type: 'POST',
			url: $url,
			data: $('#invoice_form').serialize(),
			dataType: "json",
			success: function(data) {
	
				if(data.status == 'success')
				{
					location.reload();
					//$('#invoice_model').modal('hide');
					//$('#invoice').removeClass();
					//$('#candidate_invoice').removeClass();	
					//$('#candidate_invoice').html(data.data);
					//$("#invoice_form").trigger( "reset" );					
				 }
				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});

	});
	
// get offer issued
//get_offer_issued('<?php echo $formdata['job_id'];?>');
function get_offer_issued(job_id)
{ 
	$.ajax({	
	   type: 'POST',		
		data: {job_id:job_id},
		dataType: "json",		
	   url: '<?php echo base_url(); ?>index.php/jobs_assessment/get_offer_issued/',	
	   success: function(data){ 
			$('#candidate_offer1').html(data.data1);
			$('#candidate_offer2').html(data.data2);
	   }			
	 }); 
}

//get offer accepted
//get_offer_accepted('<?php echo $formdata['job_id'];?>');
function get_offer_accepted(job_id)
{ 
	$.ajax({	
	   type: 'POST',		
		data: {job_id:job_id},
		dataType: "json",		
	   url: '<?php echo base_url(); ?>index.php/jobs_assessment/get_offer_accepted/',	
	   success: function(data){	
			$('#offer_accepted1').html(data.data1);
			$('#offer_accepted2').html(data.data2);
	   }			
	 });
}

$(document).on('click', '#shortlisted_candidate', function()
{
  if(window.confirm("Are You Sure to Shortlist the Candidate?"))
  {
	  var $url= $(this).attr('data-url');
	 $.ajax({
	   type: 'POST',
	   url: $url,
	   success: function(data){
		   location.reload();
//			$('#short').removeClass();
//			$('#candidate_shortlisted').removeClass();			
//			$('#candidate_shortlisted').html(data.data);
	   }
	 }); 
  }
});

$(document).on('click', '#send_jd', function()
{
  if(window.confirm("Are sou sure want to email candidate with Job Description?"))
  {  
	 var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   //alert(data.email); - how to access json array, data is object set and email is one of the keys
		   	alert('Emailed to '+data.candidate_name);
	   }
	 }); 
  }
});

$(document).on('click', '#send_shortlisted_cehck_this', function()
{
  if(window.confirm("Are sou sure want to email list to client?"))
  {  
	 var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   //alert(data.email); - how to access json array, data is object set and email is one of the keys
		   	alert('Emailed...');
	   }
	 }); 
  }
});

$(document).on('click', '#send_interview_list', function()
{
  if(window.confirm("Are sou sure want to email candidate list for interview?"))
  {  
	 var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){

		   //alert(data.email); - how to access json array, data is object set and email is one of the keys
		   	alert('Emailed....');
	   }
	 }); 
  }
});

/* interview related function modal window, add form, edit form etc. */

function add_calls(id1,id2,id3){
	$('#call_candidate_id').val(id1);
   	$('#call_job_app_id').val(id2);
	$('#call_job_id').val(id3);
    $('#calls_modal').modal();
}

function add_to_shortlist(id1,id2,id3){
	$('#add_to_shortlist_candidate_id').val(id1);
   	$('#add_to_shortlist_job_app_id').val(id2);
	$('#add_to_shortlist_job_id').val(id3);
    $('#add_to_shortlist_modal').modal();
}


function add_ctc(id1,id2,id3){
	$('#ctc_candidate_id').val(id1);
   	$('#ctc_job_app_id').val(id2);
	$('#ctc_job_id').val(id3);
    $('#ctc_modal').modal();
}

function add_notes(id1,id2,id3){
	$('#notes_candidate_id').val(id1);
   	$('#notes_job_app_id').val(id2);
	$('#notes_job_id').val(id3);
    $('#notes_modal').modal();
}

function add_message(id1,id2,id3){
	$('#msg_candidate_id').val(id1);
   	$('#msg_job_app_id').val(id2);
	$('#msg_job_id').val(id3);
    $('#message_modal').modal();
}

function send_shortlisted(job_id)
{
	if ($('input[name*="short_id"]:checked').length <= 0) 
	{
        alert("Please select candidates.");
		return false;
    }
	
	$('#shortlisted_short_id').val(job_id);
	$('#shortlisted_job_id').val(job_id);
    $('#shortlisted_modal').modal();
}

function add_feedback(id1,id2,id3,id4){
	
	$('#feedback_short_id').val(id1);
	$('#feedback_candidate_id').val(id2);
   	$('#feedback_job_app_id').val(id3);
	$('#feedback_job_id').val(id4);
    $('#feedback_modal').modal();
}

function manage_rejection(id1,id2,id3){
	$('#rej_candidate_id').val(id1);
   	$('#rej_job_app_id').val(id2);
	$('#rej_job_id').val(id3);
    $('#rejection_modal').modal();
}

function manage_job_change(id1,id2,id3){
	$('#change_candidate_id').val(id1);
   	$('#change_job_app_id').val(id2);
	$('#change_job_id').val(id3);
    $('#change_modal').modal();
}

function add_interview(id1,id2,id3){
	$('#int_candidate_id').val(id1);
   	$('#int_job_app_id').val(id2);
	$('#int_job_id').val(id3);
    $('#interview_modal').modal();
}

$(document).on('click', '#save_calls', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#calls_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#calls_modal').modal('hide');					
					location.reload();
					$("#calls_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

$(document).on('click', '#save_to_short_list', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#add_to_shortlist_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#add_to_shortlist_modal').modal('hide');		
					alert('Candidate Shortlisted.');			
					location.reload();
					$("#add_to_shortlist_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});	
	
$(document).on('click', '#save_rejection', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({
			type: 'POST',
			url: $url,
			data: $('#rejection_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#rejection_modal').modal('hide');					
					location.reload();
					$("#rejection_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});
	
$(document).on('click', '#save_job_change', function(){ 
		var $this = $(this);
		var $url = $this.data('url');  
			   	
        $.ajax({
			type: 'POST',
			url: $url,
			data: $('#change_form').serialize(),
			dataType: "json",
			success: function(data) 
			{
				 if(data.status == 'success'){		
				
					$('#change_modal').modal('hide');					
					location.reload();
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

$(document).on('click', '#save_feedback', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#feedback_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#feedback_modal').modal('hide');		
					alert('Feedback updated.');			
					location.reload();
					$("#feedback_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});		

$(document).on('click', '#save_ctc', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#ctc_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#ctc_modal').modal('hide');					
					location.reload();
					$("#ctc_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});
	
$(document).on('click', '#save_notes', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#notes_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#notes_modal').modal('hide');					
					//refersh page or load data.
					alert('Notes Added');
					location.reload();
					$("#notes_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

$(document).on('click', '#save_message', function(){ 

		var $this = $(this);
		var $url = $this.data('url');  
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#message_form').serialize(),
			dataType: "json",
			success: function(data) {
				
				 if(data.status == 'success'){					
					$('#message_modal').modal('hide');					
					alert('Messages Added');
					location.reload();
					$("#message_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});
	
$(document).on('click', '#save_interview', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#interview_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){				
				 	location.reload();
					$('#interview_modal').modal('hide');					
					//$('#inter').removeClass();
					//$('#candidate_interview').removeClass();
					//$('#candidate_interview').html(data.data);
					$("#interview_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});

	});
	
$(document).on('click', '#edit_interview', function(){ 
	var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   datatype: 'json',
	   success: function (data) {			
			var selectedDateTime = data.interview_date;
			var splitarray = new Array(); 
			splitarray= selectedDateTime.split(" "); 			
			$('#int_job_app_id').val(data.job_app_id);
			$('#int_candidate_id').val(data.candidate_id);
			$('#int_title').val(data.title);
			$('#interview_date').val(data.interview_date);
			$('#int_type_id').val(data.interview_type_id);
			$('#int_status_id').val(data.int_status_id);			
			$('#int_location').val(data.location);
			$('#int_datepicker').val(splitarray[0]);
			$('#int_description').val(data.description);
			$('#interview_modal').modal('show');			
   		 }			
	 }); 
});

function reject_interview_fn(id1,id2,id3)
{
	$('#reject_candidate_id').val(id1);
	$('#reject_job_app_id').val(id2);
	$('#reject_interview_id').val(id3);
    $('#reject_interview_modal').modal('show');
}

$(document).on('click', '#reject_interview_button', function(){																													
  if(window.confirm("Are You Sure to reject this Candidate?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   data: $('#reject_interview_form').serialize(),
	   success: function(data){		   
		   if(data.status == 'success')
		   {	
		   		$("#reject_interview_form").trigger( "reset" );
				$('#reject_interview_modal').modal('hide');
				location.reload();
			} 
		   else
		   {
			   alert('Cannot able to delete we have entry in Selected List');
		   }
	   }			
	 }); 
  }
});

$(document).on('click', '#save_shortlisted', function(){ 
		var $this = $(this);
		var $url = $this.data('url');    
		if($('#contact_name').val()=='')
		{
			alert('Please enter contact name');
			return false;
		}
		
		if($('#contact_email').val()=='')
		{
			alert('Please enter contact email');
			return false;
		}
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#shortlisted_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){		
				 alert('Success, emailed to client..');
					$('#shortlisted_modal').modal('hide');					
					location.reload();
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

<!-- Interview end here --> 

function accept_offer(id1,id2,id3)
{
	$('#job_id1').val(id1);
	$('#app_id1').val(id2);
	$('#candidate_id1').val(id3);
    $('#accept_modal').modal('show');
}

//REJECT OFFER SCRIPT BEGIN
//REJECT OFFER ONCLICK 
function reject_offer(id1,id2,id3)
{
	$('#job_id_reject').val(id1);
	$('#app_id_reject').val(id2);
	$('#candidate_id_reject').val(id3);
    $('#myModal_reject').modal('show');
}
//SAVE REJECT OFFER 
$(document).on('click', '#save_reject', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#reject_form').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 
					location.reload();
					$('#myModal_reject').modal('hide');
					get_offer_issued('<?php echo $formdata['job_id'];?>');
					$("#reject_form").trigger( "reset" );					
				 }
				 else
				 {
					 alert('please Fill the data');}
				}
		});

	});
//REJECT OFFER SCRIPT ENDS

//ISSUE OFFER SCRIPT BEGIN
//ONCLICK ISSUE OFFER
function issue_offer(id1,id2,id3)
{
	$('#job_id_io').val(id1);
	$('#app_id_io').val(id2);
	$('#candidate_id_io').val(id3);
    $('#issue_offer_modal').modal('show');
}


//SAVE OFFER ISSUE DETAILS
$(document).on('click', '#save_issue_offer', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#issue_offer_form').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 
					location.reload();
					$('#issue_offer_modal').modal('hide');
					get_offer_issued('<?php echo $formdata['job_id'];?>');
				
					$("#issue_offer_form").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
//ISSUE OFFER SCRIPT ENDS

$(document).on('click', '#save_candidate4', function(){ 

		var $this = $(this);
		var $url = $this.data('url');
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form4').serialize(),
			dataType: "json",

			success: function(data) {

				 if(data.status == 'success'){
					location.reload();
					//$('#accept_modal').modal('hide');
					//$("#candidate_form4").trigger( "reset" );
					//get_offer_accepted('<?php echo $formdata['job_id'];?>');
					//get_offer_issued('<?php echo $formdata['job_id'];?>');
				 }

				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});

	});

function create_invoice(id1,id2,id3,id4)
{
	$('#job_id2').val(id1);
	$('#app_id2').val(id2);
	$('#candidate_id2').val(id3);
	$('#placement_id2').val(id4);
	$('#invoice_model').modal('show');
}

$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});

$(document).on('click', '#delete_applied_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');	 
	
	$.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {			
			  location.reload();
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in shortlisted list.');
			}
	   }
			
	 }); 
  }
});

$(document).on('click', '#delete_shortlisted_candidate', function(){
																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {			
				if(data.count == 0)
				{ 
					location.reload();
				} 
				else
				{
					location.reload();
				}				
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in interview list');
			}
	   }
	 }); 
  }
});


$(document).on('click', '#delete_selected_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {			
				if(data.count == 0)
				{
					//$('#sel').addClass('hide');
					//$('#candidate_selected').addClass('hide');
					
				} 
				else
				{
					location.reload();
					//$('#candidate_selected').html(data.data);
				}
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in OfferIssued');
			}
	   }
			
	 }); 
  }
});

$(document).on('click', '#delete_offer_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){
  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {
				get_offer_issued('<?php echo $formdata['job_id'];?>');				
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Offer Accepted');
			}
	   }
			
	 }); 
  }
});

//ADD TO JOB END
$(document).on('click', '#delete_accept_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   if(data.status == 'success')
		   {
			   location.reload();
				//get_offer_accepted('<?php echo $formdata['job_id'];?>');			
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in invoice ');
		   }
	   }
			
	 }); 
  }
});

$(document).on('click', '#delete_invoice_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the invoice?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		  
		   	if(data.status =='success')
				{
					alert('Invoice deleted successfully.');
					location.reload();
					//$('#invoice').addClass('hide');
					//$('#candidate_invoice').addClass('hide');					
				} 
				else
				{
					$('#candidate_invoice').html(data.data);	   	
				}  
	   }
			
	 }); 
  }
});

function candidate_profile(candidate_profile){
	
	$('#show_candidate_profile').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/jobs_assessment/candidate_profile/"+candidate_profile,
			method: "POST",
  			data: { candidate_profile : candidate_profile },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_candidate_profile').html(data);
			}
			
		});
    $('#candidate_profile').modal();
}

function open_client_cv(candidate_id,job_id)
{
	$('#show_client_cv').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/jobs_assessment/client_cv/?view="+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id,job_id : job_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_client_cv').html(data);
			}
		});
    $('#client_cv_modal').modal();
}

function candidate_cv(candidate_id){
	
	$('#show_candidate_cv').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/jobs_assessment/download_cv/"+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_candidate_cv').html(data);
			}
			
		});
    $('#candidate_cv').modal();
}

function add_consultant_feedback(candidate_id,job_id){
	
	$('#show_consultant_feedback').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/jobs_assessment/open_consultant_feedback/"+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id,job_id : job_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_consultant_feedback').html(data);
			}
			
		});
    $('#consultant_feedback').modal();
}

$( "#toggle_jd" ).click(function() {
  $( "#jd_details" ).toggle("slow");
});

$( "#toggle_rejected" ).click(function() {
  $( "#candidate_rejected" ).toggle("slow");
});

$( "#toggle_applied" ).click(function() {
	
  $( "#candidate_applied_list" ).toggle("slow");
});

$( "#toggle_shortlisted" ).click(function() {
	
  $( "#candidate_shortlisted" ).toggle("slow");
});

</script>