<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<link rel="shortcut icon" href="images/fav.ico">
<meta charset="utf-8">
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
<section class="bot-sep">

<div class="row">
<div class="col-md-12">

    <div class="clearfix">
    
    <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table">

              
              <tr>
                <td align="left" valign="top" colspan="2">
                <div class="row">
                <div class="col-sm-6">
                
                  <div class="tab-head mar-spec"><h3>About</h3></div>
                    <table width="95%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                     
                      <tr>
                        <td colspan="2">
                        
                          <?php if($detail_list['photo']!=''){?><span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$detail_list['photo'];?>" class="profile_img" style="width:158px;height:100px;"><br /><br /><a href="<?php echo site_url().'/candidates/delete_photo/'.$candidate_id.'/';?>" style="color:#0033FF">Delete Photo</a>&nbsp;&nbsp;</span> <?php }else{ ?> 
                          
                           <img src="<?php echo base_url().'uploads/photos/no_photo.png';?>">
                           
                          <?php } ?>
                        
                        
                       </td>
                      </tr>
                      <tr>
                        <td>Name : </td>
                        <td><?php echo $detail_list['first_name'];?></td>
                      </tr>
                      
                      <tr>
                        <td>Mobile : </td>
                        <td><?php echo $detail_list['mobile'];?></td>
                      </tr>
                      
                      <tr>
                        <td>Address : </td>
                        <td><?php echo $detail_list['address'];?></td>
                      </tr>
                      
                      <tr>
                        <td>Username : </td>
                        <td><?php echo $detail_list['username'];?></td>
                      </tr>
                      
                      <tr>
                        <td>Email :</td>
                        <td><?php echo $detail_list['username'];?></td>
                      </tr>
                      
                      <tr>
                        <td>Age : </td>
                        <td><?php echo $detail_list['age'];?></td>
                      </tr>
                      
                      <tr>
                        <td>Gender :</td>
                        <td><?php if($detail_list['gender']==1) echo 'Male'; if($detail_list['gender']==0)echo 'Female';?></td>
                      </tr>
                     
                      <tr>
                        <td>Registered On : </td>
                        <td><?php echo $detail_list['reg_date'];?></td>
                      </tr>
                      
                      <tr>
                        <td>DoB :</td>
                        <td> <?php echo $detail_list['date_of_birth'];?></td>
                      </tr>
                      
                      <tr>
                        <td>Interested Program: </td>
                        <td><?php echo $detail_list['course_name'];?></td>
                      </tr>
                     
                      <tr>
                        <td>Marital Status:</td>
                        <td><?php if($detail_list['marital_status']==1) echo 'Married'; if($detail_list['marital_status']==2)echo 'Engaged';if($detail_list['marital_status']==3)echo 'Separated';if($detail_list['marital_status']==4)echo 'Divorced';if($detail_list['marital_status']==5)echo 'Widowed';if($detail_list['marital_status']==6)echo 'Never Married';?><br />
                    Number of Children: <?php echo $detail_list['children'];?></td>
                      </tr>
                     
                      <tr>
                        <td>Lead Source: </td>
                        <td> <?php echo $detail_list['lead_source'];?></td>
                      </tr>
                     
                      
                      
              
                </table>
              </div>
    
              <div class="col-sm-6">
          <div class="profile_box2" style="margin-top: 15px;">
                
                <h4>Planning for Job Change:</h4>
    
                
                <?php if(isset($job_search['job_date']) && $job_search['job_date']!=0){?>
                    When you are planning to search for a new job? : <?php echo $job_search['job_date'];?><br />
                <?php }else{ ?>
                    When you are planning to search for a new job? : Not Updated.<br />
                
                <?php } ?>
                
                <?php if( isset($job_search['current_ctc']) && $job_search['current_ctc']!=''){?>
                   Current CTC: <?php echo $job_search['current_ctc'];?><br />
                <?php }else{ ?>
                
                Current CTC : Not Updated.<br />
                <?php } ?>
                
                <?php if( isset($job_search['expected_ctc']) && $job_search['expected_ctc']!=''){?>
                   Expected CTC : <?php echo $job_search['expected_ctc'];?><br />
                <?php }else{ ?>
                
                Expected CTC  : Not Updated.<br />
                <?php } ?>
                <?php if(isset($job_search['notice_period']) && $job_search['notice_period']!=''){?>
                    Notice Period : <?php echo $job_search['notice_period'];?><br />
                <?php }else{ ?>
                
                Notice Period  : Not Updated.<br />
                <?php } ?>
                
               <?php if(isset($job_search['total_experience']) && $job_search['total_experience']!=''){?>
                   Total Experience : <?php echo $job_search['total_experience'];?><br />
                <?php }else{ ?>
                
                Total Experience  : Not Updated.<br />
                <?php } ?>
                
                <?php if(isset($job_search['immediate_join']) && $job_search['immediate_join']!=''){?>
                   Are you ready for an immediate joining ? : <?php if($job_search['immediate_join']==1){ echo 'Yes';}else if($job_search['immediate_join']==0){ echo 'No';}?><br />
                <?php }else{ ?>
                
                Are you ready for an immediate joining ?  : Not Updated.<br />
                <?php } ?>
                <br />
                <h4>Language Skill:</h4>
    
                
                <?php if(!empty($lang_details) && $lang_details[0]['eng_10th']!=''){?>
                    Eng. 10th : <?php echo $lang_details[0]['eng_10th'];?><br />
                <?php }else{ ?>
                    Eng. 10th : Not Updated.<br />
                
                <?php } ?>
                
                <?php if(!empty($lang_details) && $lang_details[0]['eng_12th']!=''){?>
                    Eng. 12th : <?php echo $lang_details[0]['eng_12th'];?><br />
                <?php }else{ ?>
                
                Eng. 12th : Not Updated.<br />
                <?php } ?>
                
                 <?php if(!empty($lang_details) && $lang_details[0]['eng_grad']!=''){?>
                    Eng. Graduation : <?php echo $lang_details[0]['eng_grad'];?><br />
                <?php }else{ ?>
                
                Eng. Graduation  : Not Updated.<br />
                <?php } ?>
                 <?php if(!empty($lang_details) && $lang_details[0]['eng_post_grad']!=''){?>
                    Eng. Post Graduation : <?php echo $lang_details[0]['eng_post_grad'];?><br />
                <?php }else{ ?>
                
                Eng. Post Graduation  : Not Updated.<br />
                <?php } ?>
                
                <?php if(!empty($candidate_languages)){?>
                    Languages Known :
                    <?php
                    $language='';
                    foreach($candidate_languages as $lang)
                    {
                        $language	=	$language.$lang['lang_name'].',';
                    }
                    echo rtrim($language, ",");
                    ?>
                    
                    <br />
                <?php }else{ ?>
                
                Languages Known  : Not Updated.<br />
                <?php } ?>
                <br />
    <br />
    
    <div class="table-responsive">
    <table width="100%" border="0" cellpadding="1" cellspacing="1">
    
    <?php if(is_array($candidate_skill)&& count($candidate_skill)>0){?>
      <tr>
        <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Skills</th>
                  </tr>
                </thead>
                <tbody>
                 <tr>
                    <td>
                <?php foreach($candidate_skill as $key => $val){?>
               <?php echo $val['skill_name'];?>,
                <?php } ?>
                </td>
                </tr>
    
                
                </tbody>
            </table>
        </td>
    </tr>
    <?php } ?>
    
    <?php if(is_array($candidate_certifications)&& count($candidate_certifications)>0){?>
    <tr>    
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Certifications</th>
                  </tr>
                </thead>
                <tbody>
                 <?php foreach($candidate_certifications as $key => $val){?>
                 <tr>
                     <td><?php echo $val['cert_name'];?></td>
                 </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>
    <?php } ?>
    
    <?php if(is_array($candidate_domain)&& count($candidate_domain)>0){?>
    <tr>    
            <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Domain Knowledge</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($candidate_domain as $key => $val){?>
                <tr>
                    <td><?php echo $val['domain_name'];?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>    
    <?php } ?>
    
    </table>
    
      </div>
    
    </br>
     
        </div>
        </div>
    </div>
    
       </td> 
      </tr> 
          
    <!--START Contract details and Language-->
    
        <?php if(count($category_name)>0){?>
        <tr>
            <td colspan="2" align="center" valign="top" class="borderTopNone"> 
              <div class="tab-head mar-spec"><h3>Designation</h3></div>
            
            </td>
        </tr>
            
           <tr>
            <td colspan="2" align="center" valign="top"  class="borderTopNone"> 
        
                 <table width="100%" border="1" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                 <thead>
                    <tr>
            
                        <td>Industry </td>
                         <td>Function/Role</td>
                                           
                    </tr> 
            </thead>         
                      <?php $orderids = array(0); $k=0;$i=0;  foreach($category_name as $category){ $flag = 0;?>
                   
                   
                      <?php if(!in_array( $category['job_cat_id'],$orderids)){ array_push($orderids, $category['job_cat_id']); $flag = 1; $k++; ?>
                      
                        <td><?php echo $category['job_cat_name'];?></td>
                        <td class="selector">
                             <?php foreach($function_name as $function){?>  
                                                  
                                    <?php $i++; if($category['job_cat_id']==$function['job_cat_id']) echo "<span>" .$function['func_area'] . "</span>";?>
                             <?php }?>
                         </td> 
                        
                   <?php if($flag) echo '</tr>'; ?>
                      
                   <?php } }?>
                     
                  
                </table> 
                
            </td>
        </tr>
        <?php } ?>
        
        
      <!--START Technical skilla primary nad secondary-->
    
       <?php if(count($skills_primary)>0){?>
        <tr>
            <td colspan="2" align="center" valign="top" class="borderTopNone"> 
              <div class="tab-head mar-spec"><h3>Technical Skills Primary,Secondary</h3></div>
            
            </td>
        </tr>
        
        <tr>
            <td align="right" valign="top" class="borderTopNone">        
            
                <table width="100%" border="1" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                
                <thead>
                <tr>
                <th colspan="2">Primary Skills</th>    
                </tr>
                </thead>
                <tbody>
                
                    <?php foreach($skills_primary as $primary){ ?>
                    
                    <tr>
                     <td><?php echo $primary['skill_name'];?></td>
                    </tr>            
                
                <?php } ?>
                </tbody>
                </table>
            
            
            <br>
            <br>
            </td>
            
            
            <td align="right" valign="top" class="borderTopNone">
            
            
            <table width="95%" border="1" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
            
            <thead>
            <tr>
            <th colspan="2">Secondary Skills</th>    
            </tr>
            </thead>
            
            <tbody>
                    
            <?php foreach($skills_secondary as $secondary){ ?>
            
            <tr>
            <td><?php echo $secondary['skill_name'];?></td>
            </tr>            
            
            <?php } ?>
            </tbody>
            </table>
            
            
            </td>
        </tr>
        <?php }?>
        
    
    <!-------------------------Education Details------------------------>	
    
    <?php if(count($education_details)>0){?>
    
     <tr>
            <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Education</h3></div></td>
       </tr>
    
       <tr id="candidate_education2">
    
    <td colspan="2" align="center" valign="top" class="borderTopNone"> 
        
                            <table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
                              
                              <thead>
                              <tr>
                                <th>Level of study</th>
                                <th>Course</th>
                                <th>Arrears</th>
                                <th>Absense</th>
                                <th>Repeat</th>
                                <th>Year Back</th>
                                <th>Percenage</th>
                              </tr></thead><tbody>
                     
                     <?php foreach($education_details as $key => $val){?>
                      <tr>
                        <td><?php echo $val['level_name'];?></td>
                        <td><?php echo $val['course_name'];?></td>
                        <td><?php echo $val['arrears'];?></td>
                        <td><?php echo $val['absesnse'];?></td>
                        <td><?php echo $val['repeat'];?></td>
                        <td><?php echo $val['year_back'];?></td>
                        <td><?php echo $val['mark_percentage'];?></td>
                         </tr>
                     <?php } ?>
                    </tbody>
                </table> 
            </td>
        </tr>
    <?php } ?>	
    
     <!-----------------End PROFESSIONAL SUMMARy---------------------->	
        
        <?php if(count($job_history)>0){?>
        
        <tr>
            <td colspan="2" align="center" valign="top"><br />Professional Summary</td>
        </tr>
          
        <tr>        
            <td colspan="2" align="center" valign="top">
                <table width="95%" border="1" cellspacing="3" cellpadding="3">
             
                      <tr>
                        <td>Organization</td>
                        <td>Designation</td>
                        <td>Resp.</td>
                        <td>From</td>
                        <td>To</td>
                        <td>Salary</td>
                        <td>Job Industry</td>
                        <td>Job Category</td>
                        <td>Fun. Area</td>
                      </tr>
                     
                     
                      <?php foreach($job_history as $key => $val){?>
                      <tr>
                        <td><?php echo $val['organization'];?></td>
                        <td><?php echo $val['designation'];?></td>
                        <td><?php echo $val['responsibility'];?></td>
                        <td><?php echo $val['from_date'];?></td>
                        <td><?php if($val['present_job']==1){echo date('Y-m-d'); }else{ echo $val['to_date'];}?></td>
                        <td><?php echo $val['monthly_salary'];?></td>
                        <td><?php echo $val['job_cat_name'];?></td>
                        <td><?php echo $val['job_cat_name'];?></td>
                        <td><?php echo $val['func_area'];?></td>
                      </tr>
                 <?php } ?>
               </table>  
            </td>
        </tr>
        <?php } ?>
     
    
        <?php if(count($contract)>0){?>
    
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Present Contract Details</h3></div> </td></tr>
          
        <tr>        
            <td colspan="2" align="center" valign="top" class="borderTopNone">
                <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
             
                      <tr>
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Total Months</td>
                        <td>Total Experience</td>
                      </tr>
                     
                     
                     
                      <tr>
                        <td><?php echo $contract['start_date'];?></td>
                        <td><?php echo $contract['end_date'];?></td>
                        <td><?php echo $contract['total_months'];?></td>
                        <td><?php echo $contract['total_exp'];?></td>                    
                      </tr>
              
               </table>  
            </td>
        </tr>
        <?php } ?>
        
       
       <!----------------Followup Details---------------------------->
    
        <?php if(count($followup_history)>0){?>
            
        <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>FollowUp History</h3></div> </td></tr>
         
        <tr><td colspan="2" align="center" valign="top" class="borderTopNone">
                             <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                <td>Title</td>
                                <td>Description</td>
                                <td>Followup Date</td>
                                <td>Reminder Date</td>
                                <td>Reminder Time</td>
                                <td>Responsible By</td>
                                </tr>
                               </thead>
                               <tbody>
            
         <?php     foreach($followup_history as $key => $val)
                         {	
        ?>		 	
                            
                                    <tr>
                                        <td><?php echo $val['title']?></td>
                                        <td><?php echo $val['description']?></td>
                                        <td><?php echo $val['flp_date']?></td>
                                        <td><?php echo $val['flp_date_reminder']?></td>
                                        <td><?php echo $val['flp_time_reminder']?></td>
                                        <td><?php echo $val['username']?></td>
                                    </tr>;
                    <?php } ?>
                    
                    </tbody>
             
             </table> 
             
             
             </td>
             
            </tr>
                                
        <?php } ?>                        
    
    
    <?php if(count($candidate_complaints_summary)>0){?>
        
        <tr>
            <td colspan="2" align="center" valign="top"><br />
              Queries    </td></tr>    
        
        <tr>
            <td colspan="2" align="center" valign="top">
                    <table width="95%" border="1" cellspacing="3" cellpadding="3">
                      <tr>
                        <td colspan="5" bgcolor="#CCCCCC">Title</td>
                        <td bgcolor="#CCCCCC">Date</td>
                        <td bgcolor="#CCCCCC">Status</td>
                      </tr>
                      <?php foreach($candidate_complaints_summary as $key => $val){?>
                      <tr>
                        <td colspan="5"><?php echo $val['task_title'];?></td>
                        <td><?php echo $val['start_date'];?></td>
                        <td><?php echo $val['status'];?></td>
                      </tr>
                      <?php } ?>
                </table>  
            </td>
         </tr>
        
        <?php } ?>
      
    
      <!--START APPLIED JOBS-->
      <?php if(!empty($applied_jobs)){ ?>
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Jobs Applied</h3></div></td></tr>
    
    <tr>
        <td colspan="2" align="center" valign="top" class="borderTopNone">
        
        
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
        <thead>
          <tr>
                <th>Jobs</th>
                <th>Applied On</th>
                </tr>
          </thead>
          <tbody>
             
            <?php foreach($applied_jobs as $job){?>
            <tr>
              <td width="80%"><a href="#"><?php echo $job['job_title'];?></a></td>
              <td width="10%"><?php  echo $job['applied_on'];?></td>          
              </tr>
             
                                        <?php  } ?>
            </tbody></table>
        
        
        
          </td>
        </tr>
    <?php } ?>
    <!--END APPLIED JOBS-->
    
    <!--START SHORTLISTED JOBS-->
    <?php if(!empty($shortlisted)){ ?>
    <tr>
        <td colspan="2" align="center" valign="top"><br>
          <div class="tab-head mar-spec"><h3>Jobs Shortlisetd</h3></div></td></tr>
    
    <tr>
        <td colspan="2" align="center" valign="top" class="borderTopNone">
        
        
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
        <thead>
          <tr>
                <th>Jobs</th>
                <th>Shortlisted On</th>
             </tr>
          </thead>
          <tbody>
             
            <?php foreach($shortlisted as $job){?>
            <tr>
              <td width="44%"><a href="#"><?php echo $job['job_title'];?></a></td>
              <td width="31%"><?php  echo $job['short_date'];?></td>          
          <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs_assessment/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs_assessment/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>-->
              
              </tr>
             
                                        <?php  } ?>
            </tbody></table>
        
        
        
          </td>
        </tr>
    <?php } ?>
    <!--END SHORTLISTED JOBS-->
    
    <!--START INTERVIEW JOBS-->
    <?php if(!empty($interview_list)){ ?>
    
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Interviews Scheduled</h3></div></td></tr>
    
    <tr>
        <td colspan="2" align="center" valign="top">
        
        
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
          <tbody>
             <tr>
                <td>Jobs</td>
                <td>Interview Date</td>
             </tr>
            <?php foreach($interview_list as $job){?>
            <tr>
              <td width="44%"><a href="#"><?php echo $job['job_title'];?></a></td>
              <td width="31%"><?php  echo date('Y-m-d',strtotime($job['interview_date']));?></td>          
          <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs_assessment/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs_assessment/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>-->
              
              </tr>
             
                                        <?php  } ?>
            </tbody></table>
        
        
        
          </td>
        </tr>
    <?php } ?>
    <!--END INTERVIEW JOBS-->
    
    <!--START SELECTED JOBS-->
    <?php if(!empty($jobs_selected)){ ?>
    
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Jobs Selected</h3></div></td></tr>
    
    <tr>
        <td colspan="2" align="center" valign="top">
        
        
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
          <tbody>
             <tr>
                <td>Jobs</td>
                <td>Selected Date</td>
             </tr>
            <?php foreach($jobs_selected as $job){?>
            <tr>
              <td width="44%"><a href="#"><?php echo $job['job_title'];?></a></td>
              <td width="31%"><?php  echo $job['select_date'];?></td>          
          <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs_assessment/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs_assessment/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>-->
              
              </tr>
             
                                        <?php  } ?>
            </tbody></table>
        
        
        
          </td>
        </tr>
    <?php } ?>
    <!--END INTERVIEW JOBS-->
    
    <!--START OFFER LETTER ISSUED JOBS-->
    <?php if(!empty($offer_letters_issued)){ ?>
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Offer Letters Issued Jobs</h3></div></td></tr>
    
    
    <tr>
        <td colspan="2" align="center" valign="top">
        
        
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
          <tbody>
             <tr>
                <td>Jobs</td>
                <td>Issued Date</td>
             </tr>
            <?php foreach($offer_letters_issued as $job){?>
            <tr>
              <td width="44%"><a href="#"><?php echo $job['job_title'];?></a></td>
              <td width="31%"><?php  echo $job['offer_date'];?></td>          
    
              
              </tr>
             
                                        <?php  } ?>
            </tbody></table>
        
        
        
          </td>
        </tr>
    <?php } ?>
    <!--END OFFER LETTER ISSUED JOBS-->
    
    <!--START  Offer Accepted and Joined JOBS-->
    <?php if(!empty($offer_accepted)){ ?>
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Offer Accepted and Joined Jobs</h3></div></td></tr>
    
    <tr>
        <td colspan="2" align="center" valign="top">
        
        
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
          <tbody>
             <tr>
                <td>Jobs</td>
                <td>Join Date</td>
             </tr>
            <?php foreach($offer_accepted as $job){?>
            <tr>
              <td width="44%"><a href="#"><?php echo $job['job_title'];?></a></td>
              <td width="31%"><?php  echo $job['join_date'];?></td>          
    
              
              </tr>
             
             <?php  } ?>
            </tbody></table>
        
        
        
          </td>
        </tr>
    <?php } ?>
    <!--END  Offer Accepted and Joined JOBS-->
    
    <!--START  INVOICE JOBS-->
    <?php if(!empty($invoice_generated)){ ?>
    
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Invoice Generated Jobs</h3></div></td></tr>
    
    <tr>
    
        <td colspan="2" align="center" valign="top">
        
        
        <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
          <tbody>
             <tr>
                <td>Jobs</td>
                <td>Invoice Date</td>
                <td>Start Date</td>
                <td>Due Date</td>
                <td>Amt.</td>
                <td>Status</td>
             </tr>
      <?php foreach($invoice_generated as $invoice){?>
                                        
      
        <tr>
          <td width="13%"><a href="<?php echo base_url(); ?>index.php/candidates/summary/<?php echo $invoice['candidate_id'];?>/" target="_blank"><?php echo $invoice['job_title'];?></a></td>
          <td width="13%"><?php echo $invoice['invoice_date'];?></td>
          <td width="14%"><?php echo $invoice['invoice_start_date'];?></td>
          <td width="12%"><?php echo $invoice['invoice_due_date'];?></td>
          <td width="11%"><?php echo $invoice['invoice_amount'];?></td>
          <td width="11%"><?php if($invoice['invoice_status']=='1')echo 'Paid';if($invoice['invoice_status']=='2')echo 'Unpaid';if($invoice['invoice_status']=='3')echo 'Due';?></td>
    
        </tr>
        
    <?php } ?> 
            </tbody></table>
        
        
        
          </td>
        </tr>
    <?php } ?>
    <!--END  INVOICE JOBS-->
    
    <?php if(count($candidate_files_summary)>0){?>
        
        <tr>
            <td colspan="2" align="center" valign="top"  class="borderTopNone"><div class="tab-head mar-spec"><h3>Updated Files</h3></div></td></tr>    
        
        <tr>
            <td colspan="2" align="center" valign="top" class="borderTopNone">
                <table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
                      <thead>
                        <tr>
                          <th colspan="8">File Name</th>    
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach($candidate_files_summary as $key => $val){?>
                      <tr>
                        <td colspan="8"><?php echo $val['file_name'];?></td>
                      </tr>
                      <?php } ?>
                      </tbody>
                </table>  
            </td>
        </tr>
        
        <?php } ?>
    
    <!--START USER AREA-->
    <?php if(count($all_calls)>0){?>
        <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>All Calls</h3></div> </td></tr>
        <tr><td colspan="2" align="center" valign="top" class="borderTopNone">
          
         <table width="100%" border="1" cellspacing="1" cellpadding="0" class="table table-bordered table-condensed">
    
                <?php foreach($all_calls as $key => $call){?>
                <tr>
                <td width="20%"><?php echo $call['call_date'];?>,<?php echo $call['call_time'];?>, <?php echo $call['firstname'];?></td>
                <td>Status: <?php echo $call['call_notes'];?></td>
                <td>
                    <?php if($call['cur_job_status']==1)echo 'No Job';?>
                    <?php if($call['cur_job_status']==2)echo 'Working, But Need a Change';?>
                    <?php if($call['cur_job_status']==3)echo 'Not Interested';?>
                    <?php if($call['cur_job_status']==4)echo 'Seeking Good Opportunity';?>
                    
                    <?php if($call['cur_job_status']==5)echo 'Need a change';?>
                    <?php if($call['cur_job_status']==6)echo 'Call after 1 Year';?>
                    <?php if($call['cur_job_status']==7)echo 'Call after this month ';?>
    
                </td>
                            
                </tr>
             
                <?php } ?>
                
            </table>
    
      </td>
      </tr>
      <?php } ?>
    
    <?php if(count($all_notes)>0){?>  
        <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>All Notes</h3></div> </td></tr>
        <tr>
        <td colspan="2" align="center" valign="top" class="borderTopNone">
         <table width="100%" border="1" cellspacing="1" cellpadding="0" class="table table-bordered table-condensed">
                <?php foreach($all_notes as $key => $note){?>
                <tr>
                <td width="20%"><?php echo $note['note_date'];?>, <?php echo $note['title'];?></td>
                <td><?php echo $note['notes'];?></td>
                </tr>
                <?php } ?>
        </table>
      </td>
      </tr>
     <?php } ?>
     
    <?php if(count($all_messages)>0){?>  
        <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>All Messages</h3></div> </td></tr>
        <tr><td colspan="2" align="center" valign="top" class="borderTopNone">
         <table width="100%" border="1" cellspacing="1" cellpadding="0" class="table table-bordered table-condensed">
    
                <?php foreach($all_messages as $key_msg => $main_message){?>
                <tr>
                <td width="20%"><?php echo $main_message['message_date'];?>, <?php echo $main_message['firstname'];?></td>
                <td><?php echo $main_message['message_text'];?></td>
                </tr>         
                <?php } ?>
          </table>
      </td>
      </tr>
    <?php } ?>  
    
        
     <!--USER AREA END-->
    </table>
    
    
    <!-----------------------MANAGE EMAIL---------------------->
    
    
    </div>
</div>
</div>
</section>

</body>
</html>