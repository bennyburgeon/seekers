<table border="0" cellpadding="3" cellspacing="3" width="100%">
            <tbody>
                <tr>
                <td width="50" colspan="2" align="left" valign="top"><br><br></td>
                </tr>
                
                <tr>
                <td colspan="2" align="center" valign="top"><strong>Job Details [show this later]</strong></td>
                </tr>
                <!-- 
                <tr>
                <td colspan="2" align="center" valign="top">
                    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
                        <tbody>
                            <tr>
                                <td width="19%"><span style="border-top:1px solid #EEEEEE;">Job Title</span></td>
                                <td width="27%"><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['job_title'];?></span></td>
                                <td width="25%"><span style="border-top:1px solid #EEEEEE;">Job Type</span></td>
                                <td width="29%"><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['job_type'];?></span></td>
                            </tr>
                            
                            <tr>
                                <td><span style="border-top:1px solid #EEEEEE;">Company Name</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['company_name'];?></span></td>
                                <td><span style="border-top:1px solid #EEEEEE;">Job Level</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['job_level'];?></span></td>
                            </tr>
                            
                            <tr>
                                 <td><span style="border-top:1px solid #EEEEEE;">Job Industry</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['industry'];?></span></td>
                                <td><span style="border-top:1px solid #EEEEEE;">Job Category</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['category'];?></span></td>

                            </tr>
                            
                            <tr>
                                <td><span style="border-top:1px solid #EEEEEE;">Job Work Level</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['work_level'];?></span></td>
                                <td><span style="border-top:1px solid #EEEEEE;">Functional Area</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['fun_area'];?></span></td>

                            </tr>
                            
                            <tr>
                               <td><span style="border-top:1px solid #EEEEEE;">Salary</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['salary_level'];?></span></td>
                                <td><span style="border-top:1px solid #EEEEEE;">Location</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['job_location'];?></span></td>

                            </tr>
                            
                            <tr>
                                 <td><span style="border-top:1px solid #EEEEEE;">Download Brochure</span></td>
                                <td><?php if(file_exists('uploads/brochure/'.$formdata['brochure']) && $formdata['brochure']!=''){?>
                                <a href="<?php echo $upload_root.'uploads/brochure/'.$formdata['brochure'];?>" target="_blank">Download</a>
                                <?php } ?></td>
                                <td><span style="border-top:1px solid #EEEEEE;">Vacancies</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['vacancies'];?></span></td>

                            </tr>
                           
                            <tr>
                                 <td><span style="border-top:1px solid #EEEEEE;">Resident Location</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['res_location'];?></span></td>
                                <td><span style="border-top:1px solid #EEEEEE;">Job Posting Date</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo date("d-m-Y", strtotime($formdata['job_post_date']));?></span></td>

                            </tr>
                            
                            <tr>
                                <td><span style="border-top:1px solid #EEEEEE;">Nationality</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $formdata['country_name'];?></span></td>
                                <td><span style="border-top:1px solid #EEEEEE;">Expires on</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo date("d-m-Y", strtotime($formdata['job_expiry_date']));?></span></td>

                            </tr>
                           
                            <tr>
                                 <td><span style="border-top:1px solid #EEEEEE;">Gender</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;">
                                <?php if($formdata['gender']==1)echo 'Male'; else echo 'Female';?>
                                </span></td>
                                <td>Exp. join date</td>
                                <td><?php echo date("d-m-Y", strtotime($formdata['exp_join_date']));?></td>
                              
                            </tr>
                            
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    	</tbody>
            		</table>
             	 </td>
       		</tr>
				-->
    
            <tr>
              <td colspan="2" align="center" valign="top"><br>
                <strong>Candidates Applied</strong> [<a href="<?php echo $this->config->site_url();?>my_jobs/addcandidate/<?php echo $formdata['job_id'];?>">Add more candidates</a>]
              </td>
</tr>

<tr id="candidate_applied" <?php  if(empty($applied_candidates)) { ?> class="hide" <?php } ?>>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
      <tbody >
        <?php foreach($applied_candidates as $candidate){?>
        
        <tr>
          	<td width="24%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a>&nbsp;<br>
Email|Edu.|Skills|Exp.|
<a href="<?php echo base_url();?>index.php/candidates_all/print_cv/<?php echo $candidate['candidate_id']?>" target="_blank">P</a> |
<a href="<?php echo base_url();?>index.php/candidates_all/print_cv/<?php echo $candidate['candidate_id']?>" target="_blank">CV</a>
</td>          
            <td width="14%"><?php echo $candidate['mobile'];?></a></td> 
            <td width="14%"><?php echo $candidate['username'];?></a><br>
 </td>
          
          <td width="12%"><?php echo date('d, M',strtotime($candidate['applied_on']));?></td>
          <td width="11%"><?php echo $candidate['firstname'];?></td>
                
          <td width="25%"><a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/shortlist2/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="shortlisted_candidate" class="btn btn-info btn-xs"> Short List </a> | <a href="<?php echo base_url(); ?>my_jobs/reject_from_application/?job_app_id=<?php echo $candidate['job_app_id'];?>&job_id=<?php echo $formdata['job_id'];?>" id="reject_from_application" > Reject</a> |xzcxzc <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_applied_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_applied_candidate" class="btn btn-danger btn-xs"> X</a></td>
          
          </tr>
     
          
          
       	<?php } ?>
        </tbody>
    </table>
	 </td>
</tr>

<tr>
              <td colspan="2" align="center" valign="top"><br>
                <strong>Candidates Rejected</strong> [<a href="<?php echo $this->config->site_url();?>my_jobs/all_rejected/<?php echo $formdata['job_id'];?>">View All Rejected</a>]
              </td>
</tr>

<tr id="candidate_applied" <?php  if(empty($rejected_candidates)) { ?> class="hide" <?php } ?>>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
      <tbody >
        <?php foreach($rejected_candidates as $candidate){?>
        <tr>
          	<td width="24%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>          
            <td width="14%"><?php echo $candidate['mobile'];?></a></td> 
            <td width="14%"><?php echo $candidate['username'];?></a></td>
			<td width="14%"><?php echo $candidate['rejected_on'];?></td>
          	<td width="9%"><?php echo $candidate['firstname'];?></td>
            <td width="9%">
			<?php if($candidate['reason_for_reject']==1)echo 'Wrong Profile';?>
            <?php if($candidate['reason_for_reject']==2)echo 'No Response';?>
            <?php if($candidate['reason_for_reject']==3)echo 'Not Intersted';?>
            <?php if($candidate['reason_for_reject']==4)echo 'Bad Client Profile';?>
            </td>
          <td width="8%"> <a href="<?php echo base_url(); ?>my_jobs/shortlist/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php echo base_url(); ?>my_jobs/reovecandidate/<?php echo $candidate['job_app_id'];?>/?app_id=<?php echo $formdata['job_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>">Delete Application</a> <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_applied_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_applied_candidate" class="btn btn-danger btn-xs"> X</a></td>
          
          </tr>
       	<?php } ?>
        </tbody>
    </table>
	 </td>
</tr>


<!-- Candidates Schedule for Another job with same skills  BEGIN-->

<tr id="candidate_schedule1"></tr>
<tr id="candidate_schedule2"></tr>


<!--END Candidates Schedule for Another job with same skills -->

<!--CANDIDATES CONTARCT FALLING BETWEEN BEGIN-->
<tr id="candidate_contract11"></tr>
<tr id="candidate_contract12"></tr>
<tr>
<td colspan="2" align="center" valign="top"><br>
	Candidates Contracts Falling Between <?php echo date('d-m-Y',strtotime($start_date)); ?> and <?php echo date('d-m-Y',strtotime($end_date)); ?>
</td>
</tr>
<!--CANDIDATES CONTARCT FALLING BETWEEN END-->
<td colspan="2" align="center" valign="top">
					 <table border="1" cellpadding="3" cellspacing="3" width="95%">
					 <tbody >
						  <tr>
							 <td bgcolor="#CCCCCC">Candidate</td>
							<td bgcolor="#CCCCCC">Contract Start Date</td>
							<td bgcolor="#CCCCCC">Contract End Date</td>
							
						  </tr>
					<?php
					 foreach($contracts_ending as $contract)
					 {
						$datetime = '';
                         
						?>
						 <tr>
                              <td width="13%"><a href="#" target="_blank"><?php echo $contract['first_name'].' '.$contract['last_name'];?></a></td>
                              <td width="13%"><?php echo date('d-m-Y',strtotime($contract['start_date'])); ?></td>
                              <td width="13%"><?php echo date('d-m-Y',strtotime($contract['end_date'])); ?></td>

									
					<?php 	} ?>
						
						</tbody> </table> 
<tr>

</tr>
<tr>
	<td colspan="2" align="center" valign="top" id="short" <?php  if(empty($shortlisted)) { ?> class="hide" <?php } ?>><br>
    <strong>Candidates Shortlisted</strong>
    </td>
</tr>

<tr id="candidate_shortlisted"  <?php  if(empty($shortlisted)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
      <tbody>
        <?php foreach($shortlisted as $candidate){?>
        <tr>
           <td width="29%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>          
            <td width="19%"><?php echo $candidate['mobile'];?></a></td> 
            <td width="39%"><?php echo $candidate['username'];?></a></td>
                 
         <td width="13%"> 
         
         <a href='javascript:;'  onclick="interview(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" class="btn btn-primary btn-xs">Interview</a>
         
         <a href="<?php echo base_url(); ?>my_jobs/addinterview/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $candidate['job_id'];?>">asdasdasInterview</a>| 
         
         <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_shortlisted_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_shortlisted_candidate" class="btn btn-danger btn-xs">X</a>
         
         </td>
          </tr>

       <?php } ?>
        </tbody>
     </table>
    </td>
</tr>
      
  


<tr>
    <td colspan="2" align="center" valign="top" id="inter" <?php  if(empty($interview_list)) { ?> class="hide" <?php } ?>><br>
        <strong>Interviews Scheduled</strong>
    </td>
</tr>

<tr id="candidate_interview"  <?php  if(empty($interview_list)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
          <tbody >
              <tr>
                 <td bgcolor="#CCCCCC">Candidate</td>
                <td bgcolor="#CCCCCC">Interview Date</td>
                <td bgcolor="#CCCCCC">Time</td>
                <td bgcolor="#CCCCCC">Venue</td>
                <td bgcolor="#CCCCCC">Mode of Interview</td>
                <td bgcolor="#CCCCCC">Description</td>
                
                <td width="37%" bgcolor="#CCCCCC">Action</td>
              </tr>
              <?php foreach($interview_list as $interview){
                  $datetime = explode(" ",$interview['interview_date']);?>
                                                
              
                <tr>
                  <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $interview['candidate_id']?>" target="_blank"><?php echo $interview['first_name'].' '.$interview['last_name'];?></a></td>
                  <td width="13%"><?php echo date("d-m-Y", strtotime($datetime[0]));?></td>
                  <td width="13%"><?php echo $interview['interview_time'];?></td>
                  <td width="14%"><?php echo $interview['location'];?></td>
                  <td width="12%"><?php echo $interview['interview_type'];?></td>
                  <td width="11%"><?php echo $interview['description'];?></td>
                 
                  <td>
                  <p>
                    <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/edit_interview/?job_app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="edit_interview" class="btn btn-primary btn-xs">Change</a>
                    <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_interview_candidate/?job_app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_interview_candidate" class="btn btn-danger btn-xs">X </a>
                    <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $interview['candidate_id']?>" target="_blank" class="btn btn-info btn-xs"> Profile </a>
                    </p>
                    <a href="javascript:;"  <?php /*?>data-url="<?php echo base_url(); ?>my_jobs/select_candidate/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>"<?php */?>onclick="select_candidate(<?php echo $interview['candidate_id'];?>,<?php echo $interview['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" class="btn btn-primary btn-xs"> Select </a></td>
                </tr>
            
        		<?php } ?> 
            
         </tbody>
    </table>
    </td>
</tr>



<tr>
    <td colspan="2" align="center" valign="top" id="sel" <?php  if(empty($candidates_selected)) { ?> class="hide" <?php } ?>><br><strong>Candidates Selected</strong></td>
</tr>

<tr id="candidate_selected" <?php  if(empty($candidates_selected)) { ?> class="hide" <?php } ?>>
    <td colspan="2" align="center" valign="top">
            <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
                  <tbody >
                  <tr>
                     	<td bgcolor="#CCCCCC">Candidate</td>
                        <td bgcolor="#CCCCCC">Select Date</td>
                       
                        <td bgcolor="#CCCCCC">Feedback/Rate</td>
                        <td width="26%" bgcolor="#CCCCCC">Action</td>
                  </tr>
                  <?php foreach($candidates_selected as $selected){?>
                                                    
                  
                    <tr>
                      <td width="19%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $selected['candidate_id']?>" target="_blank"><?php echo $selected['first_name'].' '.$selected['last_name'];?></a></td>
                      <td width="19%"><?php echo date("d-m-Y", strtotime($selected['select_date']));?></td>
                      
                       <td width="36%"><?php echo $selected['feedback'];?></td>
                      <td><a href="#" data-reveal-id="interview" data-animation="fade" class="btn btn-primary btn-xs">Change</a> <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_selectedcandidate/?job_app_id=<?php echo $selected['app_id'];?>&candidate_id=<?php echo $selected['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_selected_candidate" class="btn btn-danger btn-xs">X </a> <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $selected['candidate_id']?>" target="_blank" class="btn btn-info btn-xs"> Profile </a> <a href='javascript:;' onclick="issue_offer(<?php echo $formdata['job_id'];?>,<?php echo $selected['app_id'];?>,<?php echo $selected['candidate_id'];?>);" id="issue_offer" class="btn btn-info btn-xs"> Issue Offer </a></td>
                    </tr>
                    
                <?php } ?> 
                    
                    </tbody>
            </table>  
     </td>
</tr>
<tr id="candidate_offer1"></tr>
<tr id="candidate_offer2"></tr>

<tr id="offer_accepted1"></tr>
<tr id="offer_accepted2"></tr>

<tr id="cert_attest1"></tr>
<tr id="cert_attest2"></tr>

<tr id="visa_details1"></tr>
<tr id="visa_details2"></tr>

<tr id="medical_details1"></tr>
<tr id="medical_details2"></tr>



<tr id="visa_doc1"></tr>
<tr id="visa_doc2"></tr>

<tr id="ticket_details1"></tr>
<tr id="ticket_details2"></tr>

<tr id="ticket_followup1"></tr>
<tr id="ticket_followup2"></tr>
<tr>
    <td colspan="2" align="center" valign="top" id="invoice" <?php  if(empty($invoice_generated)) { ?> class="hide" <?php } ?>><br>
      <strong>Invoice against this Job</strong> [<a href="<?php echo base_url(); ?>my_jobs/create_invoice/<?php echo $formdata['job_id'];?>"> &nbsp;View All&nbsp; </a>]</td></tr>

<tr id="candidate_invoice" <?php  if(empty($invoice_generated)) { ?> class="hide" <?php } ?>>
  <td colspan="2" align="center" valign="top">
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
          <tbody >
          
              <tr>
                <td bgcolor="#CCCCCC">Candidate</td>
                <td bgcolor="#CCCCCC">Invoice Date</td>
                <td bgcolor="#CCCCCC">Start Date</td>
                <td bgcolor="#CCCCCC">Due Date</td>
                <td bgcolor="#CCCCCC">Amt.</td>
                <td bgcolor="#CCCCCC">Status</td>
                <td bgcolor="#CCCCCC">Created For</td>
                <td width="37%" bgcolor="#CCCCCC">Action</td>
              </tr>
              <?php foreach($invoice_generated as $invoice){?>                                                
              
                <tr>
                  <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $invoice['candidate_id']?>" target="_blank"><?php echo $invoice['first_name'].' '.$invoice['last_name'];?></a></td>
                  <td width="13%"><?php echo date('d-m-Y',strtotime($invoice['invoice_date']));?></td>
                  <td width="14%"><?php echo date('d-m-Y',strtotime($invoice['invoice_start_date']));?></td>
                  <td width="12%"><?php echo date('d-m-Y',strtotime($invoice['invoice_due_date']));?></td>
                  <td width="11%"><?php echo $invoice['invoice_amount'];?></td>
                  <td width="11%"><?php if($invoice['invoice_status']=='1')echo 'Paid';if($invoice['invoice_status']=='2')echo 'Unpaid';if($invoice['invoice_status']=='3')echo 'Due';?></td>		
                  <td width="11%"><?php if($invoice['client_candidate']=='1')echo 'Client';if($invoice['client_candidate']=='2')echo 'Candidate';?></td>
                  <td>
                  <p>
                  <a href="<?php echo base_url(); ?>my_jobs/create_invoice/?job_id=<?php echo $formdata['job_id'];?>/?placement_id=<?php echo $invoice['placement_id'];?>&invoice_id=<?php echo $invoice['invoice_id'];?>" class="btn btn-primary btn-xs">Edit</a>
                  <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_invoice/?job_id=<?php echo $formdata['job_id'];?>&placement_id=<?php echo $invoice['placement_id'];?>&invoice_id=<?php echo $invoice['invoice_id'];?>"  id="delete_invoice_candidate" class="btn btn-danger btn-xs">X</a>
                   </p>       
                 <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $invoice['candidate_id']?>" target="_blank" class="btn btn-info btn-xs">Profile</a>
                   
                   </td>
                </tr>
                
            <?php } ?> 
            
         </tbody>
      </table>  
   </td>
</tr>

                        
</tbody>
</table>