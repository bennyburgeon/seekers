<section class="bot-sep">
<div class="section-wrap">
<div class="row">
  <div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="profile_top">
      <div class="profile_top_left">Summary</div>
      <div class="profile_top_right">
        <ul>
          <li><a href="<?php echo $this->config->site_url();?>/candidates_dir/add" >Add New</a></li>
          <li><a href="<?php echo $this->config->site_url();?>/candidates_dir" >List All</a></li>
          <li><!-- <a href="<?php echo base_url();?>index.php/candidates_dir/candidate_delete/<?php echo md5($detail_list['candidate_id']);?>">Delete this profile</a>--></li>
        </ul>
      </div>
      <div style="clear:both;"></div>
    </div>
    <div class="clearfix">
      <table width="100%" border="0" cellspacing="3" cellpadding="3" class="table">
        <?php if($msg === NULL) { ?>
        <tr>
          <td colspan="2" align="left" valign="top"><br />
            <?php echo $msg;?><br /></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="2" align="center" valign="middle"><div> <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#personalModal">Update Personal Details</a> || <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#eduModal">Add Education</a> || <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#jobModal">Add Profession</a> &nbsp;&nbsp; &nbsp;&nbsp;|| 
              &nbsp;&nbsp;  &nbsp;&nbsp; <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#langModal">Update Language</a> &nbsp;&nbsp; &nbsp;&nbsp;
              
              || 
              &nbsp;&nbsp; &nbsp;&nbsp; <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#primaryModal">Add Skills[Primary & Secondary]</a> || <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#skillModal">Add Skills</a> || <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#certModal">Add Certifications</a> </div></td>
        </tr>
        <tr>
          <td align="left" valign="top" colspan="2"><div class="row">
              <div class="col-sm-16">
                <div class="tab-head mar-spec">
                  <h3>Personal Details</h3>
                </div>
                <table width="95%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                  <tr>
                    <td width="18%">First Name : </td>
                    <td width="24%"><?php echo $formdata['first_name'];?></td>
                    <td width="20%">Nationality</td>
                    <td width="38%"><?php echo $formdata['nationality_name'];?></td>
                  </tr>
                  <tr>
                    <td width="18%">Mobile : </td>
                    <td width="24%"><?php echo $formdata['mobile'];?></td>
                    <td width="20%">Current Location</td>
                    <td width="38%"><?php echo $formdata['current_location_name'];?></td>
                  </tr>
                  <tr>
                    <td>Username/Email : </td>
                    <td><?php echo $formdata['username'];?></td>
                    <td>VISA Type</td>
                    <td><?php echo $formdata['visa_type'];?></td>
                  </tr>
                  <tr>
                    <td>Age : </td>
                    <td><?php echo $formdata['age'];?></td>
                    <td>Current CTC</td>
                    <td><?php echo  $this->config->item('currency_symbol');?>
                      <?php if(isset($job_search['current_ctc']))echo $job_search['current_ctc'];?></td>
                  </tr>
                  <tr>
                    <td>Gender :</td>
                    <td><?php if($formdata['gender']==1) echo 'Male'; if($formdata['gender']==0)echo 'Female';?></td>
                    <td>Expeced CTC</td>
                    <td><?php echo  $this->config->item('currency_symbol');?>
                      <?php if(isset($job_search['expected_ctc'])) echo $job_search['expected_ctc'];?></td>
                  </tr>
                  <tr>
                    <td>Registered On :</td>
                    <td><?php echo $formdata['reg_date'];?></td>
                    <td>Notice Period</td>
                    <td><?php if(isset($job_search['notice_period'])) echo $job_search['notice_period'];?>
                      Days</td>
                  </tr>
                  <tr>
                    <td>DoB :</td>
                    <td><?php echo $formdata['date_of_birth'];?></td>
                    <td>Total Experience</td>
                    <td><?php if(isset($job_search['total_experience'])) echo $job_search['total_experience'];?>
                      Years</td>
                  </tr>
                  <tr>
                    <td>Marital Status:</td>
                    <td><?php if($formdata['marital_status']==1) echo 'Married'; else echo 'Single';?></td>
                    <td><!-- Passport Number: -->Skills</td>
                    <td><!-- <?php echo $formdata['passportno'];?>-->
                      
                      <?php if(isset($formdata['skills'])) echo $formdata['skills'];?></td>
                  </tr>
                  <tr>
                    <td>Driving License</td>
                    <td><?php if($formdata['driving_license']==1) echo 'Yes'; if($formdata['driving_license']==0)echo 'No';?></td>
                    <td><!-- Passport Issued From -->Other Details</td>
                    <td><!-- <?php echo $formdata['passport_nationality_name'];?> -->
                      
                      <?php if(isset($formdata['fee_comments'])) echo $formdata['fee_comments'];?></td>
                  </tr>
                  <tr>
                    <td>License Issued From</td>
                    <td><?php if($formdata['driving_license']=='0'){ echo 'Nill';}else{ echo $formdata['driving_license_country_name'];}?></td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="4"><?php if(!empty($candidate_languages)){?>
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
                      <?php } ?></td>
                  </tr>
                  <?php if(is_array($candidate_locations)){?>
                  <tr>
                    <td colspan="4">Preferred Locations: <?php echo implode(',',$candidate_locations);?></td>
                  </tr>
                  <?php 				
                    }									
                    ?>
                  <?php if(is_array($candidate_industries)){?>
                  <tr>
                    <td colspan="4">Industry: <?php echo implode(',',$candidate_industries);?></td>
                  </tr>
                  <?php 				
                    }									
                    ?>
                  <?php if(is_array($candidate_functional_areas)){?>
                  <tr>
                    <td colspan="4">Functional Areas: <?php echo implode(',',$candidate_functional_areas);?></td>
                  </tr>
                  <?php 				
                    }									
                    ?>
                  <?php if(is_array($candidate_roles)){?>
                  <tr>
                    <td colspan="4">Designation: <?php echo implode(',',$candidate_roles);?></td>
                  </tr>
                  <?php 				
                    }									
                    ?>
                </table>
              </div>
              <div class="col-sm-16">
                <div class="tab-head mar-spec">
                  <h3>Photo & CV </h3>
                </div>
                <table width="95%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                  <tr>
                    <td width="22%"><?php if(file_exists('uploads/photos/'.$formdata['photo']) && $formdata['photo']!=''){?>
                      <span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$formdata['photo'];?>" style="width:158px;height:100px;"><br />
                      <br />
                      <a href="<?php echo site_url().'/candidates_dir/delete_photo/'.$candidate_id.'/';?>" onClick=" return confirm('Are you sure ? Delete Photo?');" style="color:#0033FF">Delete Photo</a>&nbsp;&nbsp;</span>
                      <?php }else{ ?>
                      <img src="<?php echo base_url().'uploads/no_photo.png';?>">
                      <?php } ?></td>
                    <td width="78%"><form class="form-horizontal form-bordered"  method="post" id="upload_cv_photo_frm" name="upload_cv_photo_frm" action="<?php echo $this->config->site_url();?>/candidates_dir/upload_cv_photo/<?php echo $formdata['candidate_id'];?>" enctype="multipart/form-data">
                        <input type="hidden" name="candidate_id" value="<?php echo $formdata['first_name'];?>" />
                        <table class="hori-form">
                          <tbody>
                            <tr>
                              <td>Upload Candidate CV</td>
                              <td><?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?></td>
                            </tr>
                            <tr>
                              <td>Upload Client CV</td>
                              <td><?php echo form_upload(array('name'=>'client_cv_file','class'=>'form-data'));?></td>
                            </tr>
                            <tr>
                              <td>Upload your Photo</td>
                              <td><?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?></td>
                            </tr>
                            <tr>
                              <td colspan="2"><span class="click-icons">
                                <input type="submit" class="attach-subs" value="Upload" id="save_candidate2"  style="width:180px;">
                                </span></td>
                            </tr>
                          </tbody>
                        </table>
                        <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
                        <div id="success"></div>
                      </form></td>
                  </tr>
                  <tr>
                    <td colspan="2"><!-- 
                                <a href="<?php echo base_url().'index.php/candidates_dir/print_cv/'.$candidate_id;?>" target="_blank" class="btn btn-info btn-sm">Print CV</a> -->
                      
                      <?php if($formdata['cv_file']!=''){?>
                      <a href="<?php echo base_url().'uploads/cvs/'.$formdata['cv_file'];?>" target="_blank" class="btn btn-success btn-sm">Download Candidate CV</a> <a href="<?php echo site_url().'/candidates_dir/delete_cv/'.$candidate_id.'/';?>" onClick=" return confirm('Are you sure ? Delete Candidate CV?');" class="btn btn-danger btn-sm">Delete Candidate CV</a>
                      <?php } ?>
                      <?php if($formdata['client_cv_file']!=''){?>
                      || <a href="<?php echo base_url().'uploads/client_cvs/'.$formdata['client_cv_file'];?>" target="_blank" class="btn btn-success btn-sm">Download Client CV</a> <a href="<?php echo site_url().'/candidates_dir/delete_client_cv/'.$candidate_id.'/';?>" onClick=" return confirm('Are you sure ? Delete Client CV?');" class="btn btn-danger btn-sm">Delete Client CV</a>
                      <?php } ?></td>
                  </tr>
                </table>
                <div class="table-responsive">
                  <table width="100%" border="0" cellpadding="1" cellspacing="1">
                    <?php if(is_array($candidate_skill)&& count($candidate_skill)>0){?>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                          <thead>
                            <tr>
                              <th>Skills</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php foreach($candidate_skill as $key => $val){?>
                                <?php echo $val['skill_name'];?>,
                                <?php } ?></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <?php } ?>
                    <?php if(is_array($candidate_certifications)&& count($candidate_certifications)>0){?>
                    <tr>
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
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
                        </table></td>
                    </tr>
                    <?php } ?>
                    <?php if(is_array($candidate_domain)&& count($candidate_domain)>0){?>
                    <tr>
                      <td align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
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
                        </table></td>
                    </tr>
                    <?php } ?>
                  </table>
                </div>
              </div>
            </div></td>
        </tr>
        
        <!--START Contract details and Language-->
        
        <?php if(count($category_name)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><div class="tab-head mar-spec">
              <h3>Designation</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"  class="borderTopNone"><table width="100%" border="1" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <td>Industry </td>
                  <td>Function/Role</td>
                </tr>
              </thead>
              <?php $orderids = array(0); $k=0;$i=0;  foreach($category_name as $category){ $flag = 0;?>
              <?php if(!in_array( $category['job_cat_id'],$orderids)){ array_push($orderids, $category['job_cat_id']); $flag = 1; $k++; ?>
              
                <td><?php echo $category['job_cat_name'];?></td>
                <td class="selector"><?php foreach($function_name as $function){?>
                  <?php $i++; if($category['job_cat_id']==$function['job_cat_id']) echo "<span>" .$function['func_area'] . "</span>";?>
                  <?php }?></td>
                <?php if($flag) echo '</tr>'; ?>
                <?php } }?>
            </table></td>
        </tr>
        <?php } ?>
        
        <!--START Technical skilla primary nad secondary-->
        
        <?php if(count($skills_primary)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><div class="tab-head mar-spec">
              <h3>Technical Skills Primary,Secondary</h3>
            </div></td>
        </tr>
        <tr>
          <td align="right" valign="top" class="borderTopNone"><table width="100%" border="1" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
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
            </table></td>
          <td align="right" valign="top" class="borderTopNone"><table width="95%" border="1" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
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
            </table></td>
        </tr>
        <?php }?>
        
        <!-------------------------
 Details------------------------>
        
        <?php if(count($education_details)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Education</h3>
            </div></td>
        </tr>
        <tr id="candidate_education2">
          <td colspan="2" align="center" valign="top" class="borderTopNone"><table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th>Level of study</th>
                  <th>Course</th>
                  <th>University</th>
                  <th>Year</th>
                  <th>Country</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($education_details as $key => $val){?>
                <tr>
                  <td><?php echo $val['level_name'];?></td>
                  <td><?php echo $val['course_name'];?></td>
                  <td><?php echo $val['univ_name'];?></td>
                  <td><?php echo $val['edu_year'];?></td>
                  <td><?php echo $val['country_name'];?></td>
                  <td><a href="<?php echo base_url().'index.php/candidates_dir/delete_candidate_edu/?id='.$val['eucation_id'];?>&candidate_id=<?php echo $candidate_id;?>" onClick="return confirm('Are you sure ? want to delete?');" class="btn btn-danger btn-xs">Delete</a> || <a href="javascript:void();" data-url="<?php echo base_url().'index.php/candidates_dir/loadEditEducationhtml/?edu_id='.$val['eucation_id'];?>&candidate_id=<?php echo $candidate_id;?>" id="edit_edu" class="btn btn-info btn-xs">Edit This</a></td>
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <?php if(count($job_history)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Professional Summary</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
              <tr>
                <td>Organization</td>
                <td>Designation</td>
                <td>From</td>
                <td>To</td>
                <td>Job Industry</td>
                <td>Functional Area</td>
                <td>Action</td>
              </tr>
              <?php foreach($job_history as $key => $val){?>
              <tr>
                <td><?php echo $val['organization'];?></td>
                <td><?php echo $val['designation'];?></td>
                <td><?php echo date('d M, Y',strtotime($val['from_date']));?></td>
                <td><?php if($val['present_job']==1){echo 'Till Date'; }else{ echo date('d M, Y',strtotime($val['to_date']));}?></td>
                <td><?php echo $val['job_cat_name'];?></td>
                <td><?php echo $val['func_area'];?></td>
                <td><a href="<?php echo base_url().'index.php/candidates_dir/delete_candidate_prof/?id='.$val['job_profile_id'];?>&candidate_id=<?php echo $candidate_id;?>" onClick="return confirm('Are you sure ? want to delete?');" class="btn btn-danger btn-xs">Delete</a> || 
                  
                  <!--    
                       <a href="<?php echo base_url().'index.php/candidates_dir/summary/'.$candidate_id.'/?edit_job=1&job_profile_id='.$val['job_profile_id'];?>&candidate_id=<?php echo $candidate_id;?>" id="edit_job_profile_url" class="btn btn-info btn-xs">Edit</a>  
                    
                       
                    
                    update with editor
                    --> 
                  <a href="javascript:void();" data-url="<?php echo base_url().'index.php/candidates_dir/loadEditJobhtml/?job_profile_id='.$val['job_profile_id'];?>&candidate_id=<?php echo $candidate_id;?>" id="edit_job_profile" class="btn btn-info btn-xs">Edit Profession</a></td>
              </tr>
              <tr>
                <td colspan="7"><?php echo $val['responsibility'];?></td>
              </tr>
              <tr>
                <td colspan="7" style="height:5px;background-color:#D4D4D4"></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <?php } ?>
        <?php if(count($contract)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Present Contract Details</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
              <tr>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Total Months</td>
                <td>Total Experience</td>
                <td>Action</td>
              </tr>
              <tr>
                <td><?php echo $contract['start_date'];?></td>
                <td><?php echo $contract['end_date'];?></td>
                <td><?php echo $contract['total_months'];?></td>
                <td><?php echo $contract['total_exp'];?></td>
                <td><a href="<?php echo base_url().'index.php/candidates_dir/delete_candidate_contract/?';?>candidate_id=<?php echo $candidate_id?>" id="delete_candidate_followup" >Delete</a></td>
              </tr>
            </table></td>
        </tr>
        <?php } ?>
        
        <!----------------Followup Details---------------------------->
        
        <?php if(count($followup_history)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>FollowUp History</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
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
                </tr>
              ;
              <?php } ?>
                </tbody>
              
            </table></td>
        </tr>
        <?php } ?>
        
        <!-----------------End Follow up details----------------------> 
        
        <!--     

    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>All Jobs</h3></div> </td></tr>
    
    <tr>
   		 <td colspan="2" align="center" valign="top" class="borderTopNone">    
    
            <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
            <thead>
                                    <tr>
                        <th>Jobs</th>
                        <th>Job Posted On </th>
                        <th>Expire On</th>
                        <th>Action</th>
                        </tr>
            </thead>
             	 <tbody>

                        <?php foreach($suggested_jobs as $job){?>
                        <tr>
                        <td width="75%"><a href="#"><?php echo $job['job_title'];?> </a><br><?php echo $job['company_name'];?></td>
                        <td width="10%"> <?php  echo $job['job_post_date'];?> </td>
                        <td width="10%"><?php  echo $job['job_expiry_date'];?> </td>          
                        <td width="5%"><?php if($job['applied']==1) { echo "<span class='btn btn-success btn-xs disabled'>Applied</span>"; }else{?> <a href="<?php echo $this->config->site_url();?>/candidates_dir/apply_job/<?php echo $candidate_id;?>/<?php  echo $job['job_id'];?>" title="Click here to apply job." class="btn btn-primary btn-xs"> Apply </a><?php } ?></td>
                        
                        </tr>
                 		 <?php  } ?>
                </tbody>
           </table>
      </td>
    </tr>
-->
        
        <?php if(count($candidate_complaints_summary)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><br />
            Queries </td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><table width="95%" border="1" cellspacing="3" cellpadding="3">
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
            </table></td>
        </tr>
        <?php } ?>
        
        <!--START APPLIED JOBS-->
        <?php if(!empty($applied_jobs)){ ?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Jobs Applied</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
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
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <!--END APPLIED JOBS--> 
        
        <!--START SHORTLISTED JOBS-->
        <?php if(!empty($shortlisted)){ ?>
        <tr>
          <td colspan="2" align="center" valign="top"><br>
            <div class="tab-head mar-spec">
              <h3>Jobs Shortlisetd</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
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
                  <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>--> 
                  
                </tr>
                <?php  } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <!--END SHORTLISTED JOBS--> 
        
        <!--START INTERVIEW JOBS-->
        <?php if(!empty($interview_list)){ ?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Interviews Scheduled</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
              <tbody>
                <tr>
                  <td>Jobs</td>
                  <td>Interview Date</td>
                </tr>
                <?php foreach($interview_list as $job){?>
                <tr>
                  <td width="44%"><a href="#"><?php echo $job['job_title'];?></a></td>
                  <td width="31%"><?php  echo date('Y-m-d',strtotime($job['interview_date']));?></td>
                  <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>--> 
                  
                </tr>
                <?php  } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <!--END INTERVIEW JOBS--> 
        
        <!--START SELECTED JOBS-->
        <?php if(!empty($jobs_selected)){ ?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Jobs Selected</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
              <tbody>
                <tr>
                  <td>Jobs</td>
                  <td>Selected Date</td>
                </tr>
                <?php foreach($jobs_selected as $job){?>
                <tr>
                  <td width="44%"><a href="#"><?php echo $job['job_title'];?></a></td>
                  <td width="31%"><?php  echo $job['select_date'];?></td>
                  <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>--> 
                  
                </tr>
                <?php  } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <!--END INTERVIEW JOBS--> 
        
        <!--START OFFER LETTER ISSUED JOBS-->
        <?php if(!empty($offer_letters_issued)){ ?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Offer Letters Issued Jobs</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
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
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <!--END OFFER LETTER ISSUED JOBS--> 
        
        <!--START  Offer Accepted and Joined JOBS-->
        <?php if(!empty($offer_accepted)){ ?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Offer Accepted and Joined Jobs</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
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
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <!--END  Offer Accepted and Joined JOBS--> 
        
        <!--START  INVOICE JOBS-->
        <?php if(!empty($invoice_generated)){ ?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Invoice Generated Jobs</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
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
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <!--END  INVOICE JOBS--> 
        
        <!--START USER AREA-->
        <?php if(count($all_calls)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>All Calls</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><table width="100%" border="1" cellspacing="1" cellpadding="0" class="table table-bordered table-condensed">
              <?php foreach($all_calls as $key => $call){?>
              <tr>
                <td width="20%"><?php echo $call['call_date'];?>,<?php echo $call['call_time'];?>, <?php echo $call['firstname'];?></td>
                <td>Status: <?php echo $call['call_notes'];?></td>
                <td><?php if($call['cur_job_status']==1)echo 'No Job';?>
                  <?php if($call['cur_job_status']==2)echo 'Working, But Need a Change';?>
                  <?php if($call['cur_job_status']==3)echo 'Not Interested';?>
                  <?php if($call['cur_job_status']==4)echo 'Seeking Good Opportunity';?>
                  <?php if($call['cur_job_status']==5)echo 'Need a change';?>
                  <?php if($call['cur_job_status']==6)echo 'Call after 1 Year';?>
                  <?php if($call['cur_job_status']==7)echo 'Call after this month ';?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <?php } ?>
        <?php if(count($all_notes)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>All Notes</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><table width="100%" border="1" cellspacing="1" cellpadding="0" class="table table-bordered table-condensed">
              <?php foreach($all_notes as $key => $note){?>
              <tr>
                <td width="20%"><?php echo $note['note_date'];?></td>
                <td><?php echo $note['title'];?> || <?php echo $note['notes'];?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <?php } ?>
        <?php if(count($all_messages)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>All Messages</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top" class="borderTopNone"><table width="100%" border="1" cellspacing="1" cellpadding="0" class="table table-bordered table-condensed">
              <?php foreach($all_messages as $key_msg => $main_message){?>
              <tr>
                <td width="20%"><?php echo $main_message['message_date'];?>, <?php echo $main_message['firstname'];?></td>
                <td><?php echo $main_message['message_text'];?></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <?php } ?>
        
        <!--USER AREA END-->
      </table>
      
      <!-----------------------MANAGE EMAIL---------------------->
      
      <div class="notes">
        <ul>
          <li id="tab_2btn">Send Message</li>
        </ul>
        <div class="table-tech specs note">
          <div class="new_notes">
            <p id="result"></p>
            <p id="deletemessage"></p>
            <?php echo $error;?>
            <p id="success"></p>
            <p id="emails"></p>
            <p id="emaildelete"></p>
            <form action="<?php echo $this->config->site_url();?>/candidates_dir/manage_email/<?php echo $candidate_id;?>" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onsubmit="return email_validate();" >
              <input type="hidden" value="<?php echo $candidate_id;?>" name="candidate_id" id="candidate_id">
              <input type="hidden" value="" name="subject" id="subject">
              <textarea name="email_text" cols="" rows="" class="text_area" id="email_text"></textarea>
              <span class="click-icons"><br />
              <input type="submit" name="sub3" id="sub3" class="attach-subs" value="Send">
              </span>
            </form>
          </div>
          <div style="clear:both;"></div>
        </div>
        <div style="clear:both;"></div>
      </div>
      <div class="notes">
        <div id="show_candidate_cv" style="overflow: scroll;">
          <?php if($formdata['cv_file']!=''){?>
          <iframe width="1200px;" scrolling="yes" height="800px;" src="https://docs.google.com/viewer?url=<?php echo urlencode(base_url().'uploads/cvs/'.$formdata['cv_file']);?>&embedded=true"></iframe>
          <?php } ?>
        </div>
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
</section>

<!--BEGIN EDUCATION MODAL-->

<div class="modal fade" id="personalModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="width:700px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notes">
            <ul>
              <li>Personal</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
                <form class="form-horizontal form-bordered"  method="post" id="update_candidate_profile" name="update_candidate_profile" action="<?php echo $this->config->site_url();?>/candidates_dir/update_candidate_profile/<?php echo $candidate_id;?>" onSubmit="return validate_profile_form();">
                  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                  <input type="hidden" name="last_name" value="">
                  <table class="hori-form">
                    <tbody>
                      <tr>
                        <td>Candidate Name</td>
                        <td colspan="3"><input style="width:300px;" placeholder="First Name"  type="text"  name="first_name" value="<?php echo $formdata['first_name']?>" id="first_name"></td>
                      </tr>
                      <tr>
                        <td>Mobile</td>
                        <td colspan="3"><input style="width:300px;" placeholder="Mobile"  type="text"  name="mobile" value="<?php echo $formdata['mobile']?>" id="mobile"></td>
                      </tr>
                      <tr>
                        <td>Gender</td>
                        <td colspan="3"><?php 
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
                                                ?></td>
                      </tr>
                      <tr>
                        <td>DoB</td>
                        <td colspan="3"><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" class="datepicker"                                 value="<?php echo $formdata['date_of_birth'];?>" placeholder="DoB"></td>
                      </tr>
                      <tr>
                        <td>Marital Status</td>
                        <td colspan="3"><?php 
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
                                            echo form_radio($data).'Single';
                                            ?></td>
                      </tr>
                      <tr>
                  <td>Payment Status</td>
                  <td><input type="radio" name="payment_status" value="1" <?php if($formdata['payment_status']==1) echo 'checked'; ?>>
                    &nbsp; Paid
                    <input type="radio" name="payment_status" value="2" <?php if($formdata['payment_status']==2) echo 'checked'; ?>>
                    &nbsp; Unpaid </td>
                </tr>
                      
                      <tr>
                        <td>Current CTC</td>
                        <td><input style="width:150px;" placeholder="CTC"  type="text"  name="current_ctc" value="<?php if(isset($job_search['current_ctc'])) echo $job_search['current_ctc']?>" id="current_ctc"></td>
                        <td>Expected CTC</td>
                        <td><input style="width:150px;" placeholder="Exp. CTC"  type="text"  name="expected_ctc" value="<?php if(isset($job_search['expected_ctc'])) echo $job_search['expected_ctc']?>" id="expected_ctc"></td>
                      </tr>
                      <tr>
                        <td>Notice Peiord</td>
                        <td><input style="width:100px;" placeholder="Notice"  type="text"  name="notice_period" value="<?php if(isset($job_search['notice_period'])) echo $job_search['notice_period']?>" id="notice_period">
                          Days</td>
                        <td>Total Experience</td>
                        <td><input style="width:100px;" placeholder="Total Exp"  type="text"  name="total_experience" value="<?php if(isset($job_search['total_experience'])) echo $job_search['total_experience']?>" id="total_experience">
                          Years</td>
                      </tr>
                      <tr>
                        <td>Nationality</td>
                        <td colspan="3"><?php echo form_dropdown('nationality',  $nationality_list,$formdata['nationality'],'class="form-control" id="nationality"');?></td>
                      </tr>
                      <tr>
                        <td>Present Location</td>
                        <td colspan="3"><?php echo form_dropdown('city_id',  $current_location_list,$formdata['city_id'],'class="form-control" id="visa_type_id"');?></td>
                      </tr>
                      <tr>
                        <td>Preferred Locations</td>
                        <td colspan="3"><?php echo form_dropdown('pref_city_id[]', $current_location_list,array_keys($candidate_locations),'class="js-example-basic-single" id="pref_city_id" multiple="multiple" style="height:300px;" ');?></td>
                      </tr>
                      <tr>
                        <td>Industry</td>
                        <td colspan="3"><?php echo form_dropdown('job_cat_id', $industries_list, array_keys($candidate_industries),'class="form-control" id="job_cat_id"');?></td>
                      </tr>
                      <tr>
                        <td>Function/Department</td>
                        <td colspan="3"><?php echo form_dropdown('func_id', $functional_list, array_keys($candidate_functional_areas),'class="form-control" id="func_id"');?></td>
                      </tr>
                      <tr>
                        <td>Role/Designation</td>
                        <td colspan="3"><?php echo form_dropdown('desig_id', $roles_list, array_keys($candidate_roles),'class="form-control" id="desig_id"');?></td>
                      </tr>
                      <tr>
                        <td>Visa Type</td>
                        <td colspan="3"><?php echo form_dropdown('visa_type_id',  $visa_type_list,$formdata['visa_type_id'],'class="form-control" id="visa_type_id"');?></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td colspan="3">Driving License ? &nbsp;
                          <input type="radio" name="driving_license" id="driving_license_yes" onClick="$('#driving_license_row').show();" value="1" <?php if($formdata['driving_license']=='1')echo 'checked';?>>
                          Yes 
                          ||
                          <input type="radio" name="driving_license" id="driving_license_no" onClick="$('#driving_license_row').hide();" value="0" <?php if($formdata['driving_license']=='0')echo 'checked';?>>
                          No </td>
                      </tr>
                      <tr id="driving_license_row" style="display:<?php if($formdata['driving_license']=='0')echo 'none';?>;">
                        <td>License Issued From</td>
                        <td colspan="3"><?php echo form_dropdown('driving_license_country',  $nationality_list,$formdata['driving_license_country'],'class="form-control" id="driving_license_country"');?></td>
                      </tr>
                      <tr>
                        <td>Job Status</td>
                        <td colspan="3"><?php echo form_dropdown('cur_job_status', $job_status, $formdata['cur_job_status'],'class="js-example-basic-single" id="cur_job_status"  id="country_id" ');?></td>
                      </tr>
                      <tr>
                        <td>Job Folder</td>
                        <td colspan="3"><?php echo form_dropdown('job_folder_id',  $job_folders,$formdata['job_folder_id'],'class="form-control" id="job_folder_id"');?></td>
                      </tr>
                      <tr>
                        <td colspan="4"><span class="click-icons">
                          <input type="submit" class="attach-subs" value="Update Profile" id="save_profile" style="width:180px;">
                          </span></td>
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
<div class="modal fade" id="eduModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notes">
            <ul>
              <li>Education</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
                <p id="result"></p>
                <p id="deletemessage"></p>
                <form class="form-horizontal form-bordered"  method="post" id="edu_history_frm" name="edu_history_frm" action="<?php echo $this->config->site_url();?>/candidates_dir/edu_history_2/<?php echo $candidate_id;?>" onSubmit="return candidate_validate();">
                  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                  <table class="hori-form">
                    <tbody>
                      <tr>
                        <td>Level of Study</td>
                        <td><?php echo form_dropdown('level_id',  $edu_level_list,'','class="form-control" id="level_id"');?></td>
                      </tr>
                      <tr>
                        <td>Course</td>
                        <td><?php echo form_dropdown('course_id',  $edu_course_list, '','class="form-control" id="course_id"');?></td>
                      </tr>
                      <tr>
                        <td>Specialization</td>
                        <td><?php echo form_dropdown('spcl_id',  $edu_spec_list, '','class="form-control" id="spcl_id"');?></td>
                      </tr>
                      <tr>
                        <td>University</td>
                        <td><?php echo form_dropdown('univ_id',  $edu_univ_list,'','class="form-control" id="univ_id"');?></td>
                      </tr>
                      <tr>
                        <td>Year</td>
                        <td><?php echo form_dropdown('edu_year',  $edu_years_list, '','class="form-control" id="edu_year"');?></td>
                      </tr>
                      <tr>
                        <td>Country</td>
                        <td><?php echo form_dropdown('edu_country',  $country_list, '','class="form-control" id="edu_country"');?></td>
                      </tr>
                      <tr>
                        <td>Course Type</td>
                        <td><?php echo form_dropdown('course_type_id',  $edu_course_type_list, '','class="form-control" id="course_type_id"');?></td>
                      </tr>
                      <!--  
                    <tr>
                    <td>Arrears</td>
                     <td> <input style="width:100px;" placeholder="arrears"  type="text"  name="arrears" value="" id="arrears"> </td>
                    </tr>
                    
                    <tr>
                    <td>Absence</td>
                     <td> <input style="width:100px;" placeholder="absesnse"  type="text"  name="absesnse" value="" id="absesnse"> </td>
                    </tr>
                    
                    <tr>
                    <td>Repeat</td>
                     <td> <input style="width:100px;" placeholder="repeat"  type="text"  name="repeat" value="" id="repeat"> </td>
                    </tr>
                    
                    <tr>
                    <td>Year Back</td>
                     <td> <input style="width:100px;" placeholder="year_back"  type="text"  name="year_back" value="" id="year_back"> </td>
                    </tr>
                    
                    <tr>
                    <td>Total %</td>
                     <td> <input style="width:100px;" placeholder="mark_percentage"  type="text"  name="mark_percentage" value="" id="mark_percentage"> </td>
                    </tr>
                    
                    <tr>
                    <td>Grade</td>
                     <td> <input style="width:100px;" placeholder="grade"  type="text"  name="grade" value="" id="mark_percentage"> </td>
                    </tr>
                    -->
                      <tr>
                        <td colspan="2"><span class="click-icons">
                          <input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;">
                          </span></td>
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

<!--END EDUCATION MODAL--> 

<!--BEGIN JOB MODAL-->

<div class="modal fade" id="jobModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notes">
            <ul>
              <li>Job History</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
                <p id="result"></p>
                <p id="deletemessage"></p>
                <form class="form-horizontal form-bordered"  method="post" id="job_history_frm" name="job_history_frm" action="<?php echo $this->config->site_url();?>/candidates_dir/job_history_2/<?php echo $candidate_id;?>" onSubmit="return job_validate();" >
                  <table class="hori-form">
                    <tbody>
                    <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                    <tr>
                      <td>Organization Name</td>
                      <td><input class="form-control hori" type="text" name="organization" value="" id="organization"></td>
                    </tr>
                    <tr>
                      <td>Designation</td>
                      <td><input class="form-control hori " type="text" name="designation" value="" id="designation"></td>
                    </tr>
                    <tr>
                      <td>Industry</td>
                      <td><?php echo form_dropdown('job_cat_id',  $industries_list, '','class="form-control" id="job_cat_id"');?></td>
                    </tr>
                    <tr>
                      <td>Function/Role</td>
                      <td><?php echo form_dropdown('func_id',  $functional_list, '','class="form-control" id="func_id"');?></td>
                    </tr>
                    <tr>
                      <td>Responsibilities</td>
                      <td><textarea name="responsibility" cols="" rows="" class="text_area" id="responsibility"></textarea></td>
                    </tr>
                    <tr>
                      <td>Is this your present job ?</td>
                      <td><label class="radio-inline">
                          <input type="radio" name="present_job" id="present_job" value="1">
                          Yes</label>
                        <label class="radio-inline">
                          <input type="radio" name="present_job" id="present_job" value="0" checked>
                          No</label></td>
                    </tr>
                    <tr>
                      <td>From Date</td>
                      <td><input type="text" name="from_date" id="datepickfrom" value="" placeholder="yyyy-mm-dd"></td>
                    </tr>
                    <tr>
                      <td>To Date</td>
                      <td><input type="text" name="to_date" id="datepickto" value="" placeholder="yyyy-mm-dd"></td>
                    </tr>
                    <tr>
                      <td colspan="2"><span class="click-icons">
                        <input type="submit" class="attach-subs" value="Save" id="save_jobs" style="width:180px;">
                        </span></td>
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

<!--END JOB MODAL--> 

<!--BEGIN LANG MODAL-->

<div class="modal fade" id="langModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notes">
            <ul>
              <li>Select Language</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
                <p id="result"></p>
                <p id="deletemessage"></p>
                <form class="form-horizontal form-bordered"  method="post" id="candidate_validate" name="candidate_validate" action="<?php echo $this->config->site_url();?>/candidates_dir/lang_history_2/<?php echo $candidate_id;?>">
                  <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>" />
                  <table class="hori-form">
                    <tbody>
                      <tr>
                        <td>Languages Known</td>
                        <td><?php foreach($lang_list as $lang){ ?>
                          <label style="font-weight:normal">
                            <input <?php   if (in_array($lang['lang_id'], $candidate_language)){ ?> checked="checked" <?php  } ?>  type="checkbox" name="lang[]"  value="<?php echo $lang['lang_id'];?>" />
                            &nbsp;<?php echo $lang['lang_name'];?></label>
                          &nbsp;&nbsp;&nbsp; <br>
                          <?php } ?></td>
                      </tr>
                      <tr>
                        <td colspan="2"><span class="click-icons">
                          <input type="submit" class="attach-subs" value="Update" id="edit_candidate2" style="width:180px;">
                          </span></td>
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

<!--END LANG MODAL------------------------------------------------> 

<!--BEGIN SKILL MODAL---------------------------------------------->

<div class="modal fade" id="skillModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notess">
            <ul>
              <li class="active">Tech.Skill</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
              <p id="result"></p>
              <p id="deletemessage"></p>
              <form class="form-horizontal form-bordered"  method="post" id="skill_form" name="skill_form" action="<?php echo $this->config->site_url();?>/candidates_dir/skills_2/<?php echo $candidate_id;?>" enctype="multipart/form-data">
                <table class="hori-form">
                  <tbody>
                    <tr>
                      <td>Technical Skills</td>
                      <td><select class="js-example-basic-multiple-cert" name="skills[]" multiple="multiple" id="multiple_skill" style="width:300px;;">
                          <option value="">Select Skill</option>
                          <?php foreach($all_child_skills as $skill){?>
                          <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                          <?php }?>
                        </select></td>
                    </tr>
                    
                    <!--/*<tr  id="skill-tr"  <?php if(empty($candidate_skills)){ ?> style="display:none" <?php }  ?>>        
            <td>&nbsp;</td>
            <td> 
                <select class="js-example-basic-multiple-cert" name="skills[]" multiple="multiple" id="multiple_skill" style="width:95%;">                    
                    <?php foreach($all_child_skills as $skill){?>
                    <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                    <?php }?>
                </select>
            </td>         
        </tr>*/-->
                    
                    <tr>
                      <td colspan="2"><span class="click-icons">
                        <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
                        </span></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
                </div>
                <div id="success"></div>
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

<!------------------END SKILL MODAL-----------------------------------------------------> 

<!--BEGIN CERTIFICATION MODAL---------------------------------------------->

<div class="modal fade" id="certModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notess">
            <ul>
              <li class="active">CERTIFICATIONS</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
              <p id="result"></p>
              <p id="deletemessage"></p>
              <form class="form-horizontal form-bordered"  method="post" id="cert_form" name="cert_form" action="<?php echo $this->config->site_url();?>/candidates_dir/add_certification/<?php echo $candidate_id;?>" enctype="multipart/form-data">
                <table class="hori-form">
                  <tbody>
                    <tr>
                      <td>Certifications</td>
                      <td><select class="js-example-basic-multiple-cert" name="cert[]" multiple="multiple" id="multiple_cert" style="width:300px;;">
                          <option value="">Select Certificate</option>
                          <?php foreach($cerifications as $cert){?>
                          <option <?php   if (in_array($cert['cert_id'], $candidate_certifications_id)){ ?> selected="selected" <?php  } ?>  value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td colspan="2"><span class="click-icons">
                        <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
                        </span></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
                </div>
                <div id="success"></div>
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

<!------------------END CERTIFICATION MODAL-----------------------------------------------------> 

<!--BEGIN FOLLOW UP MODAL---------------------------------------------->

<div class="modal fade" id="followupModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notess">
            <ul>
              <li class="active">FOLLOW UP</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
              <p id="result"></p>
              <p id="deletemessage"></p>
              <form class="form-horizontal form-bordered"  method="post" id="cert_form" name="cert_form" action="<?php echo $this->config->site_url();?>/candidates_dir/followup/<?php echo $candidate_id;?>" enctype="multipart/form-data">
                <table class="hori-form">
                  <tbody>
                    <tr>
                      <td>Enter Title</td>
                      <td><input name="followup_title" type="text" id="followup_title" class="text_box"></td>
                    </tr>
                    <tr>
                      <td>Enter Description</td>
                      <td><textarea name="followup_desc" cols="" rows="" class="text_area" id="followup_desc"></textarea></td>
                        </td>
                    </tr>
                    <tr>
                      <td>Schedule this for a date in future?</td>
                      <td><input type="checkbox" name="future_followup" value="1" id="future_followup"/>
                        &nbsp;Yes</td>
                        </td>
                    </tr>
                    <tr>
                      <td>Date</td>
                      <td><input type="text" name="flp_date_reminder" id="flp_date_reminder" readonly value="" style="width:100px;"/></td>
                        </td>
                    </tr>
                    <tr>
                      <td>Time</td>
                      <td><input type="text" name="flp_time_reminder" id="flp_time_reminder" value="" style="width:100px;"/>
                        &nbsp;eg. 10:15 AM</td>
                        </td>
                    </tr>
                    <tr>
                      <td>Responsibile by</td>
                      <td><?php echo form_dropdown('assigned_to',  $admin_user_list,'','id="assigned_to"  class="table-group-action-input form-control input-medium"');?>&nbsp;</td>
                        </td>
                    </tr>
                    <tr>
                      <td colspan="2"><span class="click-icons">
                        <input type="submit" class="attach-subs" onclick="return followup_validate();" value="Update" id=""  style="width:180px;">
                        </span></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
                </div>
                <div id="success"></div>
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

<!------------------END FOLLOWUP MODAL-----------------------------------------------------> 
<!--BEGIN CATEGORY AND FUNCTIONAL MODAL----------------------------------------------------->

<div class="modal fade" id="catModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notess">
            <ul>
              <li class="active">Category And Functional Area</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
              <p id="result"></p>
              <p id="deletemessage"></p>
              <form class="form-horizontal form-bordered"  method="post" id="edit_category_frm" name="edit_category_frm" action="<?php echo $this->config->site_url();?>/candidates_dir/editCategory/<?php echo $candidate_id;?>" enctype="multipart/form-data">
                <table class="hori-form">
                  <tbody>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Category</td>
                      <td><select class="js-example-basic-multiple-cert" name="category[]" multiple="multiple" id="multiple_category" style="width:300px;">
                          <?php foreach($industry_list as $category){?>
                          <option  <?php  if (in_array($category['job_cat_id'], $category_list)){ ?> selected="selected" <?php  } ?> 
                value="<?php echo $category['job_cat_id'];?>"><?php echo $category['job_cat_name'];?></option>
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td>Function/Role</td>
                      <td><select class="js-example-basic-multiple-cert" name="function[]" multiple="multiple" id="func_role_id" style="width:300px;">
                          <?php foreach($functional_list as $function){?>
                          <option <?php   if (in_array($function['func_id'], $function_list)){ ?> selected="selected" <?php  } ?>  
                value="<?php echo $function['func_id'];?>"><?php echo $function['func_area'];?></option>
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td colspan="2"><span class="click-icons">
                        <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
                        </span></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
                </div>
                <div id="success"></div>
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

<!--END CATEGORY AND FUNCTIONAL MODAL-------------------------------> 

<!--BEGIN PRIMARY AND SECONDARY  MODAL------------------------------>

<div class="modal fade" id="primaryModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notess">
            <ul>
              <li class="active">Key Skills</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
              <p id="result"></p>
              <p id="deletemessage"></p>
              <form class="form-horizontal form-bordered"  method="post" id="edit_skill_form" name="edit_skill_form" action="<?php echo $this->config->site_url();?>/candidates_dir/editSkills/<?php echo $candidate_id;?>" enctype="multipart/form-data">
                <table class="hori-form">
                  <tbody>
                    <tr> </tr>
                    <tr>
                      <td>Technical Skills Primary</td>
                      <td><select class="js-example-basic-multiple-cert" name="skills_primary[]" multiple="multiple" id="multiple_skill" style="width:400px;">
                          <?php foreach($all_child_skills as $skill){?>
                          <option <?php   if (in_array($skill['skill_id'], $candidate_skills_primary)){ ?> selected="selected" <?php  } ?>  
                    value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td>Technical Skills Secondary</td>
                      <td><select class="js-example-basic-multiple-cert" name="skills_secondary[]" multiple="multiple" id="multiple_skill" style="width:400px;">
                          <?php foreach($all_child_skills as $skill){?>
                          <option <?php   if (in_array($skill['skill_id'], $candidate_skills_secondary)){ ?> selected="selected" <?php  } ?>  
                    value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td colspan="2"><span class="click-icons">
                        <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
                        </span></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
                </div>
                <div id="success"></div>
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

<!--END PRIMARY AND SECONDARY  MODAL------------------------------> 

<!--BEGIN PRESENT CONTRACT  MODAL--------------------------------------->

<div class="modal fade" id="contractModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15"> </div>
          <div class="notess">
            <ul>
              <li class="active">Present Contract Details</li>
            </ul>
            <div class="table-tech  note" style="border:none;">
              <div class="new_notes">
              <p id="result"></p>
              <p id="deletemessage"></p>
              <form class="form-horizontal form-bordered"  method="post" id="add_contract_form" name="add_contract_form" action="<?php echo $this->config->site_url();?>/candidates_dir/add_contract_details/<?php echo $candidate_id;?>" enctype="multipart/form-data">
                <table class="hori-form">
                  <tbody>
                    <tr>
                      <td>Company</td>
                      <td><input class="form-control" placeholder="Company Name" type="text" name="company_name" 
                value="<?php if(!empty($contract)) echo $contract['company_name'];?>" id="company_name"></td>
                    </tr>
                    <tr>
                      <td>Start Date</td>
                      <td><input class="form-control" style="width:100px;" placeholder="Start Date"  type="text"  name="start_date" readonly
                value="<?php if(!empty($contract))echo $contract['start_date'];?>" id="start_date"></td>
                    </tr>
                    <tr>
                      <td>End Date</td>
                      <td><input class="form-control" style="width:100px;" placeholder="End Date"  type="text"  name="end_date" 
                value="<?php if(!empty($contract))echo $contract['end_date'];?>" 
                readonly="readonly" id="end_date"></td>
                    </tr>
                    <tr>
                      <td>Total Months</td>
                      <td><select name='total_months' id="total_months" class="form-control" style="width:200px;">
                          <option value="0">Select Total Months</option>
                          <?php  for($i=1;$i<=36;$i++){?>
                          <option value='<?php echo $i;?>' <?php if(!empty($contract)) echo ($i == $contract['total_months']? 'selected="selected"' : ''); ?>> <?php echo $i;?></option>
                          <?php } ?>
                        </select></td>
                    </tr>
                    <tr>
                      <td>Total Experience</td>
                      <td><select  name="total_exp" class="form-control" style="width:300px;">
                          <option value="">Total Experience </option>
                          <?php foreach($years_list as $key => $val){?>
                          <option <?php if(isset($contract['total_exp']) && $contract['total_exp']==$key){?> selected="selected" <?php } ?> value="<?php echo $key;?>"> <?php echo $val;?></option>
                          <?php }?>
                        </select></td>
                    </tr>
                    <tr>
                      <td>Present Status</td>
                      <td><select class="form-control" name="present_status"  id="present_status" style="width:95%;">
                          <option style="" value="">Select Status</option>
                          <option  <?php if((isset($contract['total_exp'])) && ($contract['present_status']==1)){ ?> selected="selected" <?php } ?> 
                        style="" value="1">No Job</option>
                          <option  <?php if((isset($contract['total_exp'])) && ($contract['present_status']==2)){ ?> selected="selected" <?php } ?> 
                        style="" value="2">Not interested in Job Change</option>
                          <option  <?php if((isset($contract['total_exp'])) && ($contract['present_status']==3)){ ?> selected="selected" <?php } ?> 
                        style="" value="3">Need a change</option>
                          <option  <?php if((isset($contract['total_exp'])) && ($contract['present_status']==4)){ ?> selected="selected" <?php } ?> 
                        style="" value="4">Call me after 1 year</option>
                          <option  <?php if((isset($contract['total_exp'])) && ($contract['present_status']==5)){ ?> selected="selected" <?php } ?> 
                        style="" value="5">Call me after this month</option>
                        </select></td>
                    </tr>
                    <tr>
                      <td colspan="2"><span class="click-icons">
                        <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
                        </span></td>
                    </tr>
                  </tbody>
                </table>
                <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
                </div>
                <div id="success"></div>
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

<!--END PRESENT CONTRACT  MODAL--------------------------------------->

<div class="modal fade" id="edit_education" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15">
            <div class="notes"> 
              <!--Followup-->
              <div class="new_notes" id="data_holder"> </div>
            </div>
          </div>
          <!-------------------------modal1 end------------------------------->
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="edit_job_profile_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15">
            <div class="notes"> 
              <!--Followup-->
              <div class="new_notes" id="job_data_holder"> </div>
            </div>
          </div>
          <!-------------------------modal1 end------------------------------->
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script> 
<script language="javascript">

<!--SCRIPT FOR SKILL MODAL BEGIN-->
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

<!--SCRIPT FOR SKILL MODAL END-->

<!--SCRIPT FOR JOB MODAL BEGIN-->
function job_validate() 
{
		if($('#organization').val()=='')
		{
			alert('Enter Organization');
			$('#organization').focus();
			return false;
		}   
	    return true;
    }
<!--SCRIPT FOR JOB MODAL END-->

<!--SCRIPT FOR EDUCATION MODAL BEGIN-->
   function candidate_validate() 
   {
	if($('#course_id').val()==0)
		{
			alert('Select course');
			$('#course_id').focus();
			return false;
		}
	    return true;
    }
	
// level study course filtering 

<!--SCRIPT FOR EDUCATION MODAL END-->
	
	function followup_validate() {
		if($('#followup_title').val()=='')
		{
			alert('Enter Your Title');
			$('#followup_title').focus();
			return false;
		}
	     return true;
    }
	
	  <!--File 1-->  
	$('.imageform1').on('change', function(e)
	{
		e.preventDefault();
		var img_path1 = '<?php echo base_url();?>assets/images/loader.gif';
		$("#loading").html('<img src="'+img_path1+'" alt="Uploading...." width="150" height="100"/>');
			$(this).ajaxSubmit({success:function(data)
			{ 
				 var img_path = '<?php echo base_url();?>uploads/photos/'+data;
				 $("#imgTab2").html('<img src="'+img_path+'" class="profile_img" width="158">');
				 $("#imgfoto").html('<a href="" class="attach-subs subs profile_btn">delete</a>');
				 $("#loading").html('');
			}	
		});
	});    
	
	  <!--File 1-->  
	$('.img1_validate').on('click', function(e)
	{
		e.preventDefault();
			$(this).ajaxSubmit({success:function(data)
			{ 
				$("#imgfoto").html('');
				var img_path = '<?php echo base_url();?>uploads/photos/'+data;
				$("#imgTab2").html('<img src="'+img_path+'" class="profile_img" width="158">');
			}	

		});
    });     
	 <!--File 1--> 	
});

	$('#multiple_category').change(function() 
	{
	
		jQuery('#func_role_id').html('');
		jQuery('#func_role_id').append('<option value="">Select Function</option');
			
		if($('#multiple_category').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_dir/getfunction_multiple/',
			  data: { category_id: $('#multiple_category').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#func_role_id').html('<option value="">Loading...</option');
					jQuery('#func_role_id').append();
			  },
			  
			  success:function(res){
			  
				  if(res.success==true)
				  {
					  create_checkbox(res);			
					  console.log(res['function_list']);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Please try again');
					jQuery('#func_role_id').html('');
					jQuery('#func_role_id').append('<option value="">Select Function</option');
			  }
			});	
	});
	
	function create_checkbox(res)
	{
		var function_list= res['function_list'];
		var count        = function_list['length'];
		
	
		if(count>0)
		{
		
		$('#func_role_id').val('');
		$('#func_role_id').html('');
		$('#func_role_id').append('<option value="">Select Skills</option>');
		for(var k=0;k<count;k++)
		{   
	
			var option	=	'<option value="'+function_list[k]['func_id']+'">'+function_list[k]['func_area']+'</option>';
			
			$('#func_role_id').append(option);
	
		}
		}
		else{
			
		}
			
	} 
}
 
</script> 
<script>

$(document).ready(function()
{
		
	$('#multiple_skill').addClass('form-control hori');
	$(".js-example-basic-multiple-cert").select2();
		
		$('#datepickfrom').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "c-100:c+100",
		});
		
		$('#datepickto').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "c-100:c+100",
		});
	
		$('#start_date').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "c-100:c+100",
		});
		
		$('#flp_date_reminder').datepicker({
			dateFormat: "yy-mm-dd",
			yearRange: "c-100:c+100",
		});
		
		$('#end_date').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "c-100:c+100",
		});
		

		
		$('#datepicker2').datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange: "c-100:c+100",
		});
		

// Function for delete candidate professional

	$(document).on('click', '#delete_candidate_prof', function(){																													
  if(window.confirm("Are You Sure to delete this data?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {	   			
				get_candidate_professional('<?php echo $candidate_id;?>');
	   	   }
	   }
	 }); 
  }
});


// Function for delete candidate present contract details
						
	$(document).on('click', '#delete_candidate_contract', function(){																													
  if(window.confirm("Are You Sure to delete this data?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {	   			

				get_present_contract('<?php echo $candidate_id;?>');
			
	   	   }
		  
	   }
			
	 }); 
  }
});

	$('#level_id').change(function() 
	{	

		jQuery('#course_id').html('');
		jQuery('#course_id').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_dir/getcourses/',
			  data: { level_study: $('#level_id').val(),int_val:1},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#course_id').html('');
					jQuery('#course_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#course_id').html('');
					  jQuery('#course_id').append(data.course_list);

				 /* sorting start hrre */
					var my_options = $("#course_id option");
					var selected = $("#course_id").val(); /* preserving original selection, step 1 */
					my_options.sort(function(a,b) {
						if (a.text > b.text) return 1;
						else if (a.text < b.text) return -1;
						else return 0
					})
					$("#course_id").empty().append( my_options );
					$("#course_id").val(selected); /* preserving original selection, step 2 */
				  /* sorting end hrre */					 
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#course_id').html('');
					jQuery('#course_id').append('<option value="">Select Course</option');
			  }
			});	
	});


 $("#add_job_link").click(function (){
                $('html, body').animate({
                    scrollTop: $("#add_job_history").offset().top
                }, 500);
            });

 $("#edit_mode_profession").click(function (){
	 
		alert('You are editing Professional History Now, Please update it or cancel to add new one.');
	 
                $('html, body').animate({
                    scrollTop: $("#add_job_history").offset().top
                }, 500);
   });

//candidate_cv(<?php echo $candidate_id;?>);
});


function validate_profile_form()
{
					  
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   

		var name_check=getValidName($('#first_name').val());
		
		if(name_check==false)
		{
			alert('Please enter valid name');
			$('#first_name').focus();
			return false;
		}
				
		if($('#mobile').val()=='')
		{
			alert('Enter mobile');
			$('#mobile').focus();
			return false;
		}

		var mobile_check=getValidNumber($('#mobile').val());

		if(mobile_check==false)
		{
			alert('Please enter valid mobile number');
			$('#mobile').focus();
			return false;
		}
			
		 if($('#driving_license_yes').is(':checked')) 
		 { 
			if($('#driving_license_country').val()=='')
			{
				alert("Please select country of Driving License issued"); 
				return false;
			}
		 }

	return true;
}

function getValidName(value)
	{
		var a = value;
		var filter = /^[a-z .-]+$/i;
		
		if (filter.test(a)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
		
function getValidNumber(value)
	{
		var a = value;
		var filter = /^[0-9-+]+$/;
		
		if (filter.test(a)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
function candidate_cv(candidate_id){
	
	$('#show_candidate_cv').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_dir/download_cv_content/"+candidate_id,
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

// VAlidate Email ADDRESS	
	function email_validate() 
	{
		if($('#email_text').val()=='')
		{
			alert('Enter Subject');
			$('#email_text').focus();
			return false;
		}
		return true;
	}

$(document).on('click', '#edit_edu', function()
{ 
	var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,
	   dataType: "html",
	   success: function (data) 
	   {	
			$('#data_holder').html(data);
   	   }			
	 }); 
	$('#edit_education').modal('show');	
});

$(document).on('click', '#edit_job_profile', function()
{ 
	var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,
	   dataType: "html",
	   success: function (data) 
	   {	
	   	
			$('#job_data_holder').html(data);					
   	   }			
	 }); 
	$('#edit_job_profile_modal').modal('show');	
});
	
</script>