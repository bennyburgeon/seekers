
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
<!--<div class="profile_top_right">
<br>
<a href="javascript:alert('Write Code');">Delete this Job</a>	&nbsp;&nbsp;&nbsp;
</div>-->
<div style="clear:both;"></div>
</div>


<div style="height:auto;">

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
                                <td width="25%"><span>Job Type</span></td>
                                <td width="29%"><span><?php echo $formdata['job_type'];?></span></td>
                            </tr>
                            
                            <tr>
                                <td><span><strong>Company Name</strong></span></td>
                                <td><span><?php echo $formdata['company_name'];?></span></td>
                                <td><span>Job Level</span></td>
                                <td><span><?php echo $formdata['job_level'];?></span></td>
                            </tr>
                            
                            <tr>
                                 <td><span><strong>Job Industry</strong></span></td>
                                <td><span><?php echo $formdata['industry'];?></span></td>
                                <td><span>Job Category</span></td>
                                <td><span><?php echo $formdata['category'];?></span></td>

                            </tr>
                            
                            <tr>
                                <td><span><strong>Job Work Level</strong></span></td>
                                <td><span><?php echo $formdata['work_level'];?></span></td>
                                <td><span>Functional Area</span></td>
                                <td><span><?php echo $formdata['fun_area'];?></span></td>

                            </tr>
                            
                            <tr>
                               <td><span><strong>Salary</strong></span></td>
                                <td><span><?php echo $formdata['salary_level'];?></span></td>
                                <td><span>Location</span></td>
                                <td><span><?php echo $formdata['job_location'];?></span></td>

                            </tr>
                            
                            <tr>
                                 <td><span><strong>Download Brochure</strong></span></td>
                                <td><?php if(file_exists('uploads/brochure/'.$formdata['brochure']) && $formdata['brochure']!=''){?>
                                <a href="<?php echo $upload_root.'uploads/brochure/'.$formdata['brochure'];?>" target="_blank">Download</a>
                                <?php } ?></td>
                                <td><span>Vacancies</span></td>
                                <td><span><?php echo $formdata['vacancies'];?></span></td>

                            </tr>
                           
                            <tr>
                                 <td><span><strong>Resident Location</strong></span></td>
                                <td><span><?php echo $formdata['res_location'];?></span></td>
                                <td><span>Job Posting Date</span></td>
                                <td><span>Date</span></td>

                            </tr>
                            
                            <tr>
                                <td><span><strong>Nationality</strong></span></td>
                                <td><span><?php echo $formdata['country_name'];?></span></td>
                                <td><span>Expires on</span></td>
                                <td><span>Date</span></td>

                            </tr>
                           
                            <tr>
                                 <td><span><strong>Gender</strong></span></td>
                                <td><span>
                                <?php if($formdata['gender']==1)echo 'Male'; else echo 'Female';?>
                                </span></td>
                                <td>Exp. join date</td>
                                <td>Date</td>
                              
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

    
            <tr>
              <td colspan="2" align="center" valign="top">
                <div class="tab-head mar-spec">
                  <h3>Candidates Applied</h3>
                </div>
                <p class="text-left" style="margin-top: 8px;"><a href="<?php echo $this->config->site_url();?>/jobs/addcandidate/<?php echo $formdata['job_id'];?>" class="btn btn-primary">Add more candidates</a></p>
              </td>
</tr>

<tr id="candidate_applied" <?php  if(empty($applied_candidates)) { ?> class="hide" <?php } ?>>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">

      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Date</th>
          <th></th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody >
        <?php foreach($applied_candidates as $candidate){?>
        
        <tr>
          	<td width="24%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a>&nbsp;<br>
<span class="label label-default" title="Email"><i class="fa fa-envelope" aria-hidden="true"></i></span>
<span class="label label-default" title="Education"><i class="fa fa-book" aria-hidden="true"></i></span>
<span class="label label-default" title="Skills"><i class="fa fa-star" aria-hidden="true"></i></span>
<span class="label label-default" title="Experience"><i class="fa fa-trophy" aria-hidden="true"></i></span>

<div class="clearfix" style="margin-bottom: 4px;"></div>
<a href="#" target="_blank" class="btn btn-xs btn-primary btn-icon"><i class="fa fa-eye" aria-hidden="true"></i></a>
<a href="<?php echo base_url();?>index.php/candidates_all/print_cv/<?php echo $candidate['candidate_id']?>" target="_blank" class="btn btn-xs btn-success btn-icon"><i class="fa fa-print" aria-hidden="true"></i></a>
<a href="<?php echo base_url();?>index.php/candidates_all/print_cv/<?php echo $candidate['candidate_id']?>" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i> CV</a>
</td>          
            <td width="14%"><?php echo $candidate['mobile'];?></a></td> 
            <td width="14%"><?php echo $candidate['username'];?></a><br>
 </td>
          
          <td width="12%">Date</td>
          <td width="11%"><?php echo $candidate['firstname'];?></td>
                
          <td width="25%">
            <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/shortlist2/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="shortlisted_candidate" class="btn btn-info btn-xs"> Short List </a>
            <a href="<?php echo base_url(); ?>index.php/jobs/reject_from_application/?job_app_id=<?php echo $candidate['job_app_id'];?>&job_id=<?php echo $formdata['job_id'];?>" id="reject_from_application" class="btn btn-warning btn-xs"> Reject</a>
            <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_applied_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_applied_candidate" class="btn btn-danger btn-xs btn-icon"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
          
          </tr>
     
          
          
       	<?php } ?>
        </tbody>
    </table>
	 </td>
</tr>

<tr>
              <td colspan="2" align="center" valign="top">
                <div class="tab-head mar-spec"><h3>Candidates Rejected</h3></div>
                <p class="text-left" style="margin-top: 8px;"><a href="<?php echo $this->config->site_url();?>/jobs/all_rejected/<?php echo $formdata['job_id'];?>" class="btn btn-warning">View All Rejected</a></p>
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
          <td width="8%"><?php /*?> <a href="<?php echo base_url(); ?>index.php/jobs/shortlist/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php echo base_url(); ?>index.php/jobs/reovecandidate/<?php echo $candidate['job_app_id'];?>/?app_id=<?php echo $formdata['job_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>">Delete Application</a><?php */?> <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_applied_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_applied_candidate" class="btn btn-danger btn-xs"> X</a></td>
          
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
<tr id="candidate_contract1"></tr>
<tr id="candidate_contract2"></tr>
<!--<tr>
<td colspan="2" align="center" valign="top"><br>
	Candidates Contracts Falling Between <?php echo date('d-m-Y',strtotime($start_date)); ?> and <?php echo date('d-m-Y',strtotime($end_date)); ?>
</td>
</tr>-->
<!--CANDIDATES CONTARCT FALLING BETWEEN END-->
<!--<td colspan="2" align="center" valign="top">
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

</tr>-->
<tr>
	<td colspan="2" align="center" valign="top" id="short" <?php  if(empty($shortlisted)) { ?> class="hide" <?php } ?>>

      <div class="tab-head mar-spec"><h3>Candidates Shortlisted</h3></div>
    </td>
</tr>

<tr id="candidate_shortlisted"  <?php  if(empty($shortlisted)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    
    
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">

      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach($shortlisted as $candidate){?>
        <tr>
           <td width="29%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>          
            <td width="19%"><?php echo $candidate['mobile'];?></a></td> 
            <td width="39%"><?php echo $candidate['username'];?></a></td>
                 
         <td width="13%"> <a href='javascript:;'  onclick="interview(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" class="btn btn-primary btn-xs">Interview</a><?php /*?><a href="<?php echo base_url(); ?>index.php/jobs/addinterview/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $postdata['job_id'];?>">Interview</a><?php */?> <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_shortlisted_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_shortlisted_candidate" class="btn btn-danger btn-xs">X</a></td>
          </tr>

       <?php } ?>
        </tbody>
     </table>
    </td>
</tr>
      
  


<tr>
    <td colspan="2" align="center" valign="top" id="inter" <?php  if(empty($interview_list)) { ?> class="hide" <?php } ?>>
    <div class="tab-head mar-spec"><h3>Interviews Scheduled</h3></div>
    </td>
</tr>

<tr id="candidate_interview"  <?php  if(empty($interview_list)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">
        <thead>
          <tr>
            <th>Candidate</th>
            <th>Interview Date</th>
            <th>Time</th>
            <th>Venue</th>
            <th>Mode of Interview</th>
            <th>Description</th>
            <th width="37%">Action</th>
          </tr>
        </thead>
          <tbody >
              
              <?php foreach($interview_list as $interview){
                  $datetime = explode(" ",$interview['interview_date']);?>
                                                
              
                <tr>
                  <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $interview['candidate_id']?>" target="_blank"><?php echo $interview['first_name'].' '.$interview['last_name'];?></a></td>
                  <td width="13%">Date</td>
                  <td width="13%"><?php echo $interview['interview_time'];?></td>
                  <td width="14%"><?php echo $interview['location'];?></td>
                  <td width="12%"><?php echo $interview['interview_type'];?></td>
                  <td width="11%"><?php echo $interview['description'];?></td>
                 
                  <td>
                  <p>
                    <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/edit_interview/?job_app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="edit_interview" class="btn btn-primary btn-xs">Change</a>
                    <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_interview_candidate/?job_app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_interview_candidate" class="btn btn-danger btn-xs">X </a>
                    <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $interview['candidate_id']?>" target="_blank" class="btn btn-info btn-xs"> Profile </a>
                    </p>
                    <a href="javascript:;"  <?php /*?>data-url="<?php echo base_url(); ?>index.php/jobs/select_candidate/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>"<?php */?>onclick="select_candidate(<?php echo $interview['candidate_id'];?>,<?php echo $interview['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" class="btn btn-primary btn-xs"> Select </a></td>
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
                        <th width="26%">Action</th>
                  </tr>
              </thead>
                  <tbody >
                  
                  <?php foreach($candidates_selected as $selected){?>
                                                    
                  
                    <tr>
                      <td width="19%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $selected['candidate_id']?>" target="_blank"><?php echo $selected['first_name'].' '.$selected['last_name'];?></a></td>
                      <td width="19%">date</td>
                      
                       <td width="36%"><?php echo $selected['feedback'];?></td>
                      <td><a href="#" data-reveal-id="interview" data-animation="fade" class="btn btn-primary btn-xs">Change</a> <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_selectedcandidate/?job_app_id=<?php echo $selected['app_id'];?>&candidate_id=<?php echo $selected['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_selected_candidate" class="btn btn-danger btn-xs">X </a> <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $selected['candidate_id']?>" target="_blank" class="btn btn-info btn-xs"> Profile </a> <a href='javascript:;' onclick="issue_offer(<?php echo $formdata['job_id'];?>,<?php echo $selected['app_id'];?>,<?php echo $selected['candidate_id'];?>);" id="issue_offer" class="btn btn-info btn-xs"> Issue Offer </a></td>
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
    <td colspan="2" align="center" valign="top" id="invoice" <?php  if(empty($invoice_generated)) { ?> class="hide" <?php } ?>>
    <div class="tab-head mar-spec"><h3>Invoice against this Job</h3></div>
    <p style="margin-top: 8px;" class="text-left"><a href="<?php echo base_url(); ?>index.php/jobs/create_invoice/<?php echo $formdata['job_id'];?>" class="btn btn-primary">View All</a></p>      </td></tr>

<tr id="candidate_invoice" <?php  if(empty($invoice_generated)) { ?> class="hide" <?php } ?>>
  <td colspan="2" align="center" valign="top">
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
        <thead>
          <tr>
            <tr>
                <th>Candidate</th>
                <th>Invoice Date</th>
                <th>Start Date</th>
                <th>Due Date</th>
                <th>Amt.</th>
                <th>Status</th>
                <th>Created For</th>
                <th width="37%">Action</th>
              </tr>
          </tr>
        </thead>
          <tbody >
          
              
              <?php foreach($invoice_generated as $invoice){?>                                                
              
                <tr>
                  <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $invoice['candidate_id']?>" target="_blank"><?php echo $invoice['first_name'].' '.$invoice['last_name'];?></a></td>
                  <td width="13%">date</td>
                  <td width="14%">date</td>
                  <td width="12%">date</td>
                  <td width="11%"><?php echo $invoice['invoice_amount'];?></td>
                  <td width="11%"><?php if($invoice['invoice_status']=='1')echo 'Paid';if($invoice['invoice_status']=='2')echo 'Unpaid';if($invoice['invoice_status']=='3')echo 'Due';?></td>		
                  <td width="11%"><?php if($invoice['client_candidate']=='1')echo 'Client';if($invoice['client_candidate']=='2')echo 'Candidate';?></td>
                  <td>
                  <p>
                  <a href="<?php echo base_url(); ?>index.php/jobs/create_invoice/?job_id=<?php echo $formdata['job_id'];?>/?placement_id=<?php echo $invoice['placement_id'];?>&invoice_id=<?php echo $invoice['invoice_id'];?>" class="btn btn-primary btn-xs">Edit</a>
                  <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_invoice/?job_id=<?php echo $formdata['job_id'];?>&placement_id=<?php echo $invoice['placement_id'];?>&invoice_id=<?php echo $invoice['invoice_id'];?>"  id="delete_invoice_candidate" class="btn btn-danger btn-xs">X</a>
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


<!---------- Modal1 for Interview--------------------->

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="enquiry-modal-label">
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
            
            
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form3" name="candidate_form3"> 
             		<input type="hidden" name="candidate_id" id="candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="job_id" value="<?php echo $formdata['job_id'];?>">      
               
                <table class="hori-form">
                <tbody>
                
                <tr>
                <td>Interview Title</td>
                 <td><?php echo form_input(array('name'=>'title','id' =>'title', 'class' => 'smallinput'));?> </td>
                </tr>
                
                
                <tr>
                <td>Interview Type</td>
                <td><?php echo form_dropdown('interview_type_id', $interview_type,'','id = "type_id"');?></td>
                </tr>
                
                <tr>
                <td>Interview Status</td>
                 <td><?php echo form_dropdown('int_status_id', $int_status_id,'','id = "status_id"');?></td>
                </tr>
                
                <tr>
                <td>Location</td>
                 <td><?php echo form_input(array('name'=>'location','id'=>'location','class'=>'smallinput'));?></td>
                </tr>
                
                <tr>
                <td>Interview Date</td>
                 <td><input type="text" name="interview_date" class="smallinput datepicker" id="datepicker"  /></td>
                </tr>
                
                <tr>
                <td>Interview Time</td>
                 <td><?php echo form_dropdown('interview_time', $interview_time_ar);?></td>
                </tr>
                
                <tr>

                <td>Description</td>
                 <td><?php echo form_input(array('name'=>'description', 'id'=>'description','class' => 'smallinput'));?> </td>
                </tr>
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs/addinterview2" />
                  <?php /*?><input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;"><?php */?>
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
</section>

<!------------------------ MODAL FOR ISSUE OFFER BEGIN------------------>

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
                              data-url="<?php echo $this->config->site_url();?>/jobs/issue_offer" />
                              <?php /*?><input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;"><?php */?>
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
</section>

<!------------------------ MODAL FOR ISSUE OFFER END------------------>

<!------------------------ MODAL for REJECT OFFER------------------>

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
                              data-url="<?php echo $this->config->site_url();?>/jobs/reject_offer" />
                              <?php /*?><input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;"><?php */?>
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
<!------------------------ REJECT ODFFER MODEL END------------------------------->

<!------------------------ modal2 for Accept offer------------------>

<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="enquiry-modal-label">
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
                              data-url="<?php echo $this->config->site_url();?>/jobs/accept_offer2" />
                              <?php /*?><input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;"><?php */?>
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
</div>
</section>

<!------------------------ modal3 for Invoice------------------>

<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Invoice List</div>
                    
                
                <?php /*?><div class="profile_bottom" id="leads">
                    
                          <div class="slider_redesign" id="tr_1" >
                        
                            <div class="side_adj second">
                            <?php foreach($invoice_list2 as $invoice_list){?>
                                <h2><?php echo $invoice_list['first_name'];?></h2>
                                <p>Offer Issued On:<?php echo $invoice_list['offer_issued_date'];?></p>
                                <p>Accepted On: <?php echo $invoice_list['offer_accepted_date'];?></p>
                                <p>Join Date: <?php echo $invoice_list['join_date'];?></p>
                                <p>Monthly Salary: <?php echo $invoice_list['monthly_salary_offered'];?></p>
                                <p>CTC: <?php echo $invoice_list['total_ctc'];?></p>
                                <?php if (isset($invoice_list['invoice_date'])){?><p>Invoice On: <?php echo $invoice_list['invoice_date'];?></p><?php }?>
                                 <?php if (isset($invoice_list['invoice_date'])){?><p>Start From: <?php echo $invoice_list['invoice_start_date'];?></p><?php }?>
                                 <?php if (isset($invoice_list['invoice_date'])){?><p>Due On: <?php echo $invoice_list['invoice_due_date'];?></p><?php }?>
                                 <?php if (isset($invoice_list['invoice_date'])){?><p>Amount: <?php echo $invoice_list['invoice_amount'];?></p><?php }?>
                                <?php if (isset($invoice_list['invoice_date'])){?><p>Status: <?php if($invoice_list['invoice_status']=='1') echo 'Paid';if($invoice_list['invoice_status']=='2') echo 'Unpaid';if($invoice_list['invoice_status']=='3') echo 'Due';?></p><?php }?>
                           <?php }?>
                            
                            </div>
                	   </div>
                
               	     </div><?php */?>
                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" > 
                  
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
                              <input type="button" class="attach-subs" value="Save" id="save_candidate5" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs/create_invoice2" />
                              <?php /*?><input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;"><?php */?>
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

<!--MODAL FOR CERT ATTEST BEGIN--------------------->
<div class="modal fade" id="myModalCert" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Certificate Attestation</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="cert_form" name="cert_form" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id_cert"value="">
                  <input type="hidden" name="app_id" id="app_id_cert" value="">
                  <input type="hidden" name="placement_id" id="placement_id_cert" value="">
                  <input type="hidden" name="job_id" id="job_id_cert" value="">
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                            <td>Title</td>
                             <td><input type="text" name="title" class="smallinput" id="title"/></td>
                        </tr>
                        
                        <tr>
                            <td>Status</td>
                             <td>
                                 <select name="status" class="smallinput form-control" id="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Not Required</option>
                                    <option value="2">Required</option>
                                    <option value="3">Already Done</option>
                                    <option value="4">On Process</option>
                                    <option value="5">Completed</option>
                                 </select>
                             </td>
                        </tr>
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_cert" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs/cert_attest" />
                              <?php /*?><input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;"><?php */?>
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

<!--MODAL FOR CERT ATTEST END-------------------->

<!--MODAL FOR VISA START------------------->
<div class="modal fade" id="myModalVisa" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Visa Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_visa" name="candidate_form_visa" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id4"value="">
                  <input type="hidden" name="app_id" id="app_id4" value="">
                  <input type="hidden" name="placement_id" id="placement_id4" value="">
                  <input type="hidden" name="job_id" id="job_id4" value="">
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                            <td> Date Received</td>
                             <td><input type="text" name="date" class="smallinput datepicker" id="datepicker" readonly /></td>
                        </tr>
                        
                        <tr>
                            <td>Visa Number</td>
                             <td><input type="text" name="number" class="smallinput"/></td>
                        </tr>
                        
                        <tr>
                            <td>Date of Issue</td>
                             <td><input type="text" name="date_issued" class="smallinput datepicker"readonly/></td>
                        </tr>
                        <tr>
                            <td>Date of Expiry</td>
                             <td><input type="text" name="date_expiry" class="smallinput datepicker" readonly/></td>
                        </tr>
                        <tr>
                             <td>Verified Passport Details?</td>
                             <td><input type="radio"  name="passport_verified" value="1">&nbsp;Yes&nbsp;
                             <input type="radio"  name="passport_verified" value="2" >&nbsp;No&nbsp;
                             
                        </tr>
                        

                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_visa" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs/create_visa" />

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
<!--MODAL FOR VISA END----------------------------->

<!--MODAL FOR VISA DOCUMENT START-------------->
<div class="modal fade" id="myModalDoc" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Visa Process Document</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_doc" name="candidate_form_doc" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id_doc"value="">
                  <input type="hidden" name="app_id" id="app_id_doc" value="">
                  
                  <input type="hidden" name="job_id" id="job_id_doc" value="">
                  <table class="hori-form">
                    <tbody>
                        <tr>
                            <td>Mode of Send</td>
                             <td>                                 
                             	<select name="send_mode" class="smallinput form-control" id="send_mode">
                                    <option value="">Select Mode</option>
                                    <option value="1">Courier</option>
                                    <option value="2">Email</option>

                                 </select>
                               </td>
                        </tr>
                        <tr>
                            <td> Send By</td>

                             <td><input type="radio"  name="send_by" value="1">&nbsp;Company&nbsp;
                             <input type="radio"  name="send_by" value="2" >&nbsp;Candidate&nbsp;
                             
                        </tr>
                        
                        

                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_doc" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs/create_doc" />

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
<!--MODAL FOR VISA DOCUMENT END------------------------------------------->

<!--MODAL FOR MEDICAL START-->
<div class="modal fade" id="myModalMedical" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Medical Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_medical" name="candidate_form_medical" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id5"value="">
                  <input type="hidden" name="app_id" id="app_id5" value="">
                  
                  <input type="hidden" name="job_id" id="job_id5" value="">
                  <table class="hori-form">
                    <tbody>
                        <tr>
                            <td>Title</td>
                             <td><input type="text" name="title" class="smallinput"/></td>
                        </tr>
                        <tr>
                            <td> Date</td>
                             <td><input type="text" name="date" class="smallinput datepicker" id="datepicker"/></td>
                        </tr>
                        
                        <tr>
                            <td>Description</td>
                             <td><textarea name="description" rows="4" cols="30"  class="smallinput" ></textarea></td>
                        </tr>
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_medical" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs/create_medical" />

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
<!--MODAL FOR MEDICAL END-->

<!--MODAL FOR TICKET START-->
<div class="modal fade" id="myModalTicket" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Ticket & Travel Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_ticket" name="candidate_form_ticket" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id6"value="">
                  <input type="hidden" name="app_id" id="app_id6" value="">
                  
                  <input type="hidden" name="job_id" id="job_id6" value="">
                  <table class="hori-form">
                    <tbody>

                        <tr>
                            <td>eTicket Number</td>
                             <td><input type="text" name="number" class="smallinput"/></td>
                        </tr>
                        <tr>
                            <td> Date of Travel</td>
                             <td><input type="text" name="date" class="smallinput datepicker" id="datepicker"/></td>
                        </tr>
                        <tr>
                            <td> Boarding Sector</td>
                             <td><input type="text" name="boarding_sector" class="smallinput" id=""/></td>
                        </tr>
                        <tr>
                            <td>Flight Details</td>
                             <td><textarea name="description" rows="4" cols="30"  class="smallinput" ></textarea></td>
                        </tr>
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_ticket" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs/create_ticket" />

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
<!--MODAL FOR TICKET END----------------------------------------->

<!--MODAL FOR TICKET FOLLOWUP START---------------------------------->

<div class="modal fade" id="myModalFollowup" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Ticket & Travel Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	
       
                
                 <form class="form-horizontal form-bordered"  method="post" id="candidate_form_followup" name="candidate_form_followup" enctype="multipart/form-data" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id_followup"value="">
                  <input type="hidden" name="app_id" id="app_id_followup" value="">
                  
                  <input type="hidden" name="job_id" id="job_id_followup" value="">
                  <table class="hori-form">
                   <tbody>

                        <tr>
                            <td>Travel Document</td>
                              <td><?php echo form_upload(array('name'=>'travel_document','class'=>'form-data'));?> </td>
                        </tr>
                        <tr>
                            <td>Mode of Send</td>
                             <td>                                 
                             	<select name="send_mode" class="smallinput form-control" id="send_mode" style="width:150px;">
                                    <option value="">Select Mode</option>
                                    <option value="1">Courier</option>
                                    <option value="2">Email</option>

                                 </select>
                               </td>
                        </tr>
                        <tr>
                            <td> Send By</td>

                             <td><input type="radio"  name="send_by" value="1">&nbsp;Company&nbsp;
                             <input type="radio"  name="send_by" value="2" >&nbsp;Candidate&nbsp;
                             
                        </tr>
                        <tr>
                            <td>Travel Follow Up</td>
                             <td><textarea name="travel_followup" rows="4" cols="30"  class="smallinput" ></textarea></td>
                        </tr>
                        <tr>
                            <td>Pick Up Follow Up</td>
                             <td><textarea name="pickup_followup" rows="4" cols="30"  class="smallinput"  ></textarea></td>
                        </tr>
                        <tr>
                            <td>Travel Confirmation</td>
                            <td><input type="radio"  name="travel_confirmation" value="1">&nbsp;Complete&nbsp;
                             <input type="radio"  name="travel_confirmation" value="2" >&nbsp;Uncomplete&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Send Email</td>
                            <td><input type="radio"  name="send_email" value="yes">&nbsp;Yes&nbsp;
                             <input type="radio"  name="send_email" value="no" >&nbsp;No&nbsp;</td>
                        </tr>
                        <tr>
                        <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="submit" class="attach-subs" value="Save" id="save_followup" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs/create_followup" />

                              </span>
                          </td>
                	   </tr>
                      </tbody>
                  </table>
                
                </form>
                   
	<!--Followup-->

          
    
  </div>
</div>



<!------------------------ end modal3------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
<!--MODAL FOR TICKET FOLLOWUP END-->
</section>

<!------------------------ modal4 for Select on interview schedule------------------>


</section>


<script type="text/javascript">

//GET CANDIDATES CONTRACT FALLING
get_candidate_contract('<?php echo $formdata['job_id'];?>');
function get_candidate_contract(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_candidate_contract/',
	
	   success: function(data){ 
		
		
			$('#candidate_contract1').html(data.data1);
			$('#candidate_contract2').html(data.data2);
	   }
			
	 }); 
}

get_select_candidate('<?php echo $formdata['job_id'];?>');
function get_select_candidate(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_select_candidate/',
	
	   success: function(data){ 
		
		
			$('#candidate_schedule1').html(data.data1);
			$('#candidate_schedule2').html(data.data2);
	   }
			
	 }); 
}

//get_visa_details('<?php echo $formdata['job_id'];?>');
function get_visa_details(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_visa_details/',
	
	   success: function(data){ 
		
		
			$('#visa_details1').html(data.data1);
			$('#visa_details2').html(data.data2);
	   }
			
	 }); 
}

get_offer_issued('<?php echo $formdata['job_id'];?>');
function get_offer_issued(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_offer_issued/',
	
	   success: function(data){ 
		

			$('#candidate_offer1').html(data.data1);
			$('#candidate_offer2').html(data.data2);
	   }
			
	 }); 
}

//get offer accepted
get_offer_accepted('<?php echo $formdata['job_id'];?>');
function get_offer_accepted(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_offer_accepted/',
	
	   success: function(data){
		
	
			$('#offer_accepted1').html(data.data1);
			$('#offer_accepted2').html(data.data2);
	   }
			
	 }); 
}

//get certificate attestation
//get_cert_attest('<?php echo $formdata['job_id'];?>');
function get_cert_attest(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_cert_attest/',
	
	   success: function(data){
		
	
			$('#cert_attest1').html(data.data1);
			$('#cert_attest2').html(data.data2);
	   }
			
	 }); 
}
//get visa doc//
//get_visa_doc('<?php echo $formdata['job_id'];?>');
function get_visa_doc(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_visa_document/',
	
	   success: function(data){
		
	
			$('#visa_doc1').html(data.data1);
			$('#visa_doc2').html(data.data2);
	   }
			
	 }); 
}

//get medical doc
//get_medical_details('<?php echo $formdata['job_id'];?>');
function get_medical_details(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_medical_details/',
	
	   success: function(data){
		
	
			$('#medical_details1').html(data.data1);
			$('#medical_details2').html(data.data2);
	   }
			
	 }); 
}
//get_ticket_details('<?php echo $formdata['job_id'];?>');
function get_ticket_details(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_ticket_details/',
	
	   success: function(data){
		
	
			$('#ticket_details1').html(data.data1);
			$('#ticket_details2').html(data.data2);
	   }
			
	 }); 
}
//get_ticket_followup('<?php echo $formdata['job_id'];?>');
function get_ticket_followup(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/jobs/get_ticket_followup/',
	
	   success: function(data){
		
	
			$('#ticket_followup1').html(data.data1);
			$('#ticket_followup2').html(data.data2);
	   }
			
	 }); 
}
$('input[type=text]').addClass('form-control');

$(document).on('click', '#shortlisted_candidate', function(){
														
  if(window.confirm("Are You Sure to Shortlist the Candidate?")){
  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({
	
	   type: 'POST',
	
	   url: $url,
	
	   success: function(data){
		
			$('#short').removeClass();
			$('#candidate_shortlisted').removeClass();			
			$('#candidate_shortlisted').html(data.data);
	   }
			
	 }); 
  }
});

function interview(id1,id2,id3)
{
	$('#candidate_id').val(id1);
   	$('#job_app_id').val(id2);
	$('#job_id').val(id3);
    $('#myModal').modal();
}

$(document).on('click', '#save_candidate3', function(){ 

		var $this = $(this);

		var $url = $this.data('url');
     	
        $.ajax({
			
			type: 'POST',

			url: $url,

			data: $('#candidate_form3').serialize(),

			dataType: "json",

			success: function(data) {

				 if(data.status == 'success'){
					
					$('#myModal').modal('hide');					
					$('#inter').removeClass();
					$('#candidate_interview').removeClass();
					$('#candidate_interview').html(data.data);
					$("#candidate_form3").trigger( "reset" );
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});



function select_candidate(id1,id2,id3)
{
	$('#candidate_id3').val(id1);
   	$('#app_id3').val(id2);
	$('#job_id3').val(id3);
    $('#myModal3').modal();
}

$(document).on('click', '#save_candidate6', function(){ 
													 
		var $this = $(this);

		var $url = $this.data('url');
     	
        $.ajax({
			
			type: 'POST',

			url: $url,

			data: $('#candidate_form6').serialize(),

			dataType: "json",

			success: function(data) {

				 if(data.status == 'success'){
					 
					$('#myModal3').modal('hide');	
					$('#sel').removeClass();
					$('#candidate_selected').removeClass();
					$('#candidate_selected').html(data.data);
					$("#candidate_form3").trigger( "reset" );
					get_select_candidate('<?php echo $formdata['job_id'];?>');
					
				 }
				 else
				 {
					 alert('please Fill the data');
				 }

			}
		});

	});




function accept_offer(id1,id2,id3)
{
	$('#job_id1').val(id1);
	$('#app_id1').val(id2);
	$('#candidate_id1').val(id3);
    $('#myModal1').modal('show');
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

//CREEATE CERT ATTEST
function cert_attest(id1,id2,id3,id4)
{
	$('#job_id_cert').val(id1);
	$('#app_id_cert').val(id2);
	$('#candidate_id_cert').val(id3);
	$('#placement_id_cert').val(id4);
	$('#myModalCert').modal('show');
}

//SAVE CERT ATTEST
$(document).on('click', '#save_cert', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#cert_form').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalCert').modal('hide');
					get_cert_attest('<?php echo $formdata['job_id'];?>');

					$("#cert_form").trigger( "reset" );
					
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

					$('#myModal1').modal('hide');
					$("#candidate_form4").trigger( "reset" );
					get_offer_accepted('<?php echo $formdata['job_id'];?>');
					get_offer_issued('<?php echo $formdata['job_id'];?>');
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
	$('#myModal2').modal('show');
}



//CREEATE VISA
function create_visa(id1,id2,id3,id4)
{
	$('#job_id4').val(id1);
	$('#app_id4').val(id2);
	$('#candidate_id4').val(id3);
	$('#placement_id4').val(id4);
	$('#myModalVisa').modal('show');
}


//CREATE MEDICAL

function create_medical(id1,id2,id3)
{ 
	$('#job_id5').val(id1);
	$('#app_id5').val(id2);
	$('#candidate_id5').val(id3);
	
	$('#myModalMedical').modal('show');
}

//CREATE DOCUMENT

function create_document(id1,id2,id3)
{ 
	$('#job_id_doc').val(id1);
	$('#app_id_doc').val(id2);
	$('#candidate_id_doc').val(id3);
	
	$('#myModalDoc').modal('show');
}
//SAVE VISA DOC DETAILS
$(document).on('click', '#save_doc', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_doc').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalDoc').modal('hide');
					get_visa_doc('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_doc").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});


//SAVE MEDICAL DETAILS
$(document).on('click', '#save_medical', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_medical').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalMedical').modal('hide');
					get_medical_details('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_medical").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
//CREATE AND SAVE TICKET DETAILS BEGIN

function create_ticket(id1,id2,id3)
{ 
	$('#job_id6').val(id1);
	$('#app_id6').val(id2);
	$('#candidate_id6').val(id3);
	
	$('#myModalTicket').modal('show');
}


	$(document).on('click', '#save_ticket', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_ticket').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalTicket').modal('hide');
					get_ticket_details('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_ticket").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

//CREATE AND SAVE TICKET DETAILS END

//CREATE AND SAVE TICKET FOLLOWUP BEGIN

function create_followup(id1,id2,id3)
{ 
	$('#job_id_followup').val(id1);
	$('#app_id_followup').val(id2);
	$('#candidate_id_followup').val(id3);
	
	$('#myModalFollowup').modal('show');
}


	$('#candidate_form_followup').submit(function(evt){
		evt.preventDefault(); 
		
		var $this = $(this);
		var $url =$('#save_followup').data('url');       
     	var formData = new FormData(this);
        $.ajax({
			
			type: 'POST',
			url: $url,
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalFollowup').modal('hide');
					get_ticket_followup('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_followup").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

//CREATE AND SAVE TICKET FOLLOW END

//SAVE VISA DETAILS
$(document).on('click', '#save_visa', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_visa').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){

					$('#myModalVisa').modal('hide');
					get_visa_details('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_visa").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});


$(document).on('click', '#save_candidate5', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form5').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){

					$('#myModal2').modal('hide');
					$('#invoice').removeClass();
					$('#candidate_invoice').removeClass();	
					$('#candidate_invoice').html(data.data);
					$("#candidate_form5").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

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
				if(data.count == 0)
				{
					$('#apply').addClass('hide');
					$('#candidate_applied').addClass('hide');
					
				} 
				else
				{
				
					$('#candidate_applied').html(data.data);
				}

	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in shortlist');
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
					$('#short').addClass('hide');
					$('#candidate_shortlisted').addClass('hide');
					
				} 
				else
				{
					
					$('#candidate_shortlisted').html(data.data);
				}
				
				
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Interview');
			}
	   }
			
	 }); 
  }
});


$(document).on('click', '#delete_interview_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');	 
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   
		   if(data.status == 'success')
		   {	if(data.count == 0)
				{
					$('#inter').addClass('hide');
					$('#candidate_interview').addClass('hide');
					
				} 
				else
				{
					$('#candidate_interview').html(data.data);}
				
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in SelectedList');
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
					$('#sel').addClass('hide');
					$('#candidate_selected').addClass('hide');
					
				} 
				else
				{
					$('#candidate_selected').html(data.data);
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

//ADD TO JOB BEGIN
$(document).on('click', '#add_to_job', function(){																													
 if(window.confirm("Are You Sure to add the Candidate to this Job?")){
  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {		

				if(data.count == 0)
				{
					$('#apply').addClass('hide');
					$('#candidate_applied').addClass('hide');
					
				} 
				else
				{
				
					$('#candidate_applied').html(data.data);
				}
				
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

			get_offer_accepted('<?php echo $formdata['job_id'];?>');
			
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Visa Details ');
			}
	   }
			
	 }); 
  }
});


$(document).on('click', '#delete_attest', function(){																													
  if(window.confirm("Are You Sure to delete?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {	   			

			get_cert_attest('<?php echo $formdata['job_id'];?>');
			
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Visa Details ');
			}
	   }
			
	 }); 
  }
});



$(document).on('click', '#delete_invoice_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   	if(data.count == 0)
				{
					$('#invoice').addClass('hide');
					$('#candidate_invoice').addClass('hide');
					
				} 
				else
				{
					$('#candidate_invoice').html(data.data);	   	
				}  
	   }
			
	 }); 
  }
});

<!--DELETE VISA DETAILS BEGIN-->
$(document).on('click', '#delete_visa_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	if(data.status == 'success')
		 {
				get_visa_details('<?php echo $formdata['job_id'];?>');
		  }
		  else{
				alert('Cannot able to delete we have entry in Medical Details ');  
		  }
	   }
			
	 }); 
  }
});

<!-- DELETE VISA DOCUMENT-->

$(document).on('click', '#delete_visa_document', function(){																													
  if(window.confirm("Are You Sure to delete ?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	if(data.status == 'success')
		 {
				get_visa_doc('<?php echo $formdata['job_id'];?>');
		  }
		  else{
				alert('Cannot able to delete we have entry in Medical Details ');  
		  }
	   }
			
	 }); 
  }
});

<!--DELETE MEDICAL DETAILS BEGIN-->
$(document).on('click', '#delete_medical_candidate', function(){																													
  if(window.confirm("Are You Sure to delete ?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	if(data.status == 'success')
		 {

			get_medical_details('<?php echo $formdata['job_id'];?>');   	
				
		 }
		 else{
				alert('Cannot able to delete we have entry in Ticket & Travel Details ');  
		  }
	   }
			
	 }); 
  }
});
<!--DELETE TICKET DETAILS BEGIN-->
$(document).on('click', '#delete_ticket_candidate', function(){																													
  if(window.confirm("Are You Sure to delete ?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	 if(data.status == 'success')
		 {
			get_ticket_details('<?php echo $formdata['job_id'];?>');
		 }
		 else{
			 alert('Cannot able to delete we have entry in travel followup');
		 }
	   }
			
	 }); 
  }
});
<!--DELETE VISA DETAILS END-->

<!--DELETE TICKET FOLLOWUP BEGIN-->
$(document).on('click', '#delete_followup', function(){																													
  if(window.confirm("Are You Sure to delete ?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	 if(data.status == 'success')
		 {
			get_ticket_followup('<?php echo $formdata['job_id'];?>');
		 }
		 else{
			 alert('Cannot able to delete we have entry in Invoice ');
		 }
	   }
			
	 }); 
  }
});
<!--DELETE FOLLOWUP END-->

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
			
			$('#job_app_id').val(data.job_app_id);
			$('#candidate_id').val(data.candidate_id);
			$('#title').val(data.title);
			$('#type_id').val(data.interview_type_id);
			$('#status_id').val(data.int_status_id);			
			$('#location').val(data.location);
			$('#datepicker').val(splitarray[0]);
			$('#description').val(data.description);
			$('#myModal').modal('show');
			
   		 }
			
	 }); 
 
});





</script>

