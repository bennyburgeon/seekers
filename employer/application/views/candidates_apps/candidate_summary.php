<section class="bot-sep">
<div class="section-wrap">
<div class="row">
  <div class="col-sm-12 pages">Home / Job Applications / <span>Profile</span></div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="profile_top">
      <div class="profile_top_left">Summary</div>
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
            <td align="left" valign="top" colspan="2">
          <div class="row">
            <div class="col-sm-16">
              <div class="tab-head mar-spec">
                <h3>Personal Details</h3>
              </div>
              
              
              <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
        <tr>
          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
        <tr>
          <td width="50%">Full name</td>
          <td width="50%"><?php echo $formdata['first_name'];?></td>
        </tr>
        <tr>
          <td>Father's Name</td>
          <td><?php echo $formdata['father_name'];?></td>
        </tr>
        <tr>
          <td>Mobile No</td>
          <td><?php echo $formdata['mobile'];?></td>
        </tr>
        <tr>
          <td>Email</td>
          <td><?php echo $formdata['username'];?></td>
        </tr>
        <tr>
          <td>Gender</td>
          <td><?php if($formdata['gender']==1) echo 'Male'; elseif($formdata['gender']==2)echo 'Female'; else echo 'not updated';?></td>
        </tr>
        <tr>
          <td>Age &amp; DoB</td>
          <td><?php echo ($formdata['date_of_birth']!='0000-00-00' && $formdata['date_of_birth']!='') ? date('d-m-Y',strtotime($formdata['date_of_birth'])) : 'Not Updated'; ?> || 
          <?php if($formdata['age']=='0') { echo 'not updated'; }else { echo $formdata['age'].' Years'; }?></td>
        </tr>
        <tr>
          <td>Marital Status</td>
          <td><?php if($formdata['marital_status']==1) echo 'Married'; else echo 'Single';?></td>
        </tr>
        <tr>
          <td>Qualification</td>
          <td><?php if($formdata['level_name']=='0' || $formdata['level_name']=='') { echo 'not updated'; }else { echo $formdata['level_name']; }?></td>
        </tr>
        <tr>
          <td>Course</td>
          <td><?php if($formdata['course']=='0') { echo 'not updated'; }else { echo $formdata['course_name']; }?></td>
        </tr>
        <tr>
          <td>Nationality</td>
          <td><?php if($formdata['nationality']=='0' || $formdata['nationality']=='') { echo 'not updated'; }else { echo $formdata['nationality_name']; }?></td>
        </tr>
        <tr>
          <td>State</td>
          <td><?php echo $formdata['state_name'];?></td>
        </tr>
        <tr>
          <td>City</td>
          <td><?php echo $formdata['city_name'];?></td>
        </tr>
        <tr>
          <td>Present Location</td>
          <td><?php if($formdata['current_location']=='0'){ echo 'Nill';}else{ echo $formdata['current_location_name'];}?></td>
        </tr>
        <tr>
          <td>Preferred Locations</td>
          <td><?php echo implode(',',$pref_candidate_locations);?></td>
        </tr>
        <tr>
          <td>Driving License</td>
          <td><?php if($formdata['driving_license']==1) echo 'Yes'; if($formdata['driving_license']==0)echo 'No';?>
          
          <?php if($formdata['driving_license']=='1'){ echo 'Issued From-'.$formdata['driving_license_country_name'];}?></td>
        </tr>
        <tr>
          <td>License Type</td>
          <td><?php if($formdata['licence_two']==1 || $formdata['licence_three']==1 || $formdata['licence_four']==1 || $formdata['licence_lmv']==1 || $formdata['licence_hmv']==1){?>
            <?php if($formdata['licence_two']==1)echo 'Two Wheeler';?>
            &nbsp;
            <?php if($formdata['licence_three']==1)echo 'Three Wheeler';?>
            &nbsp;
            <?php if($formdata['licence_four']==1)echo 'Four Wheeler';?>
            &nbsp;
            <?php if($formdata['licence_lmv']==1)echo 'LMV';?>
            &nbsp;
            <?php if($formdata['licence_hmv']==1)echo 'HMV';?>
            <?php } ?></td>
        </tr>
        <tr>
          <td>VISA Type</td>
          <td><?php echo $formdata['visa_type'];?></td>
        </tr>
        </table></td>
          <td width="50%" align="left" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
        <tr>
          <td width="50%">Job Status</td>
          <td width="50%"><?php echo $formdata['cur_job_status_name']?></td>
        </tr>
        <tr>
          <td>Notice Period</td>
          <td><?php if(isset($job_search['notice_period'])) echo $job_search['notice_period'];?>
&nbsp;Days</td>
        </tr>
        <tr>
          <td>Total Experience</td>
          <td><?php if(isset($job_search['total_experience'])) echo $job_search['total_experience'];?>
Years</td>
        </tr>
        <tr>
          <td>Current Salary</td>
          <td><?php echo  $this->config->item('currency_symbol');?>
            <?php if(isset($job_search['current_ctc']))echo number_format($job_search['current_salary'],0);?>
&nbsp; / Year</td>
        </tr>
        <tr>
          <td>Expected Salary</td>
          <td><?php echo  $this->config->item('currency_symbol');?>
            <?php if(isset($job_search['expected_ctc'])) echo number_format($job_search['expected_salary'],0);?>
&nbsp; / Year</td>
        </tr>
        <tr>
          <td>Is Negotiable</td>
          <td><?php if($job_search['salary_negotiable']=='1'){echo 'Yes';}elseif($job_search['salary_negotiable']=='2'){echo 'No';}?></td>
        </tr>
        <tr>
          <td>Salary Proof</td>
          <td><?php if($job_search['salary_proof']=='0'){echo 'No Proof';}elseif($job_search['salary_proof']=='1'){echo 'Bank Statement';}elseif($job_search['salary_proof']=='2'){echo 'Salary Slip';}elseif($job_search['salary_proof']=='3'){echo 'Salary Ceritificate';}?></td>
        </tr>
        <tr>
          <td>Ref Name</td>
          <td><?php echo $job_search['ref_name'];?></td>
        </tr>
        <tr>
          <td>Ref. Mobile</td>
          <td><?php echo $job_search['ref_mobile'];?></td>
        </tr>
        <tr>
          <td>Ref Designation</td>
          <td><?php echo $job_search['ref_desig'];?></td>
        </tr>
        <tr>
          <td>Industry</td>
          <td><?php if(is_array($candidate_industries)){?><?php echo implode(',',$candidate_industries);?><?php } ?></td>
        </tr>
        <tr>
          <td>Functional Area</td>
          <td><?php if(is_array($candidate_functional_areas)){?><?php echo implode(',',$candidate_functional_areas);?><?php } ?></td>
        </tr>
        <tr>
          <td>Designation/Role</td>
          <td><?php if(is_array($candidate_roles)){?><?php echo $formdata['desig']; ?><?php echo $formdata['desig']; ?><?php } ?></td>
        </tr>
        <tr>
          <td>Abroad Preference</td>
          <td><?php if($job_search['abroad_preference']=='1'){echo 'Yes';}elseif($job_search['abroad_preference']=='2'){echo 'No';}?></td>
        </tr>
        <tr>
          <td>Preferred Time to Call</td>
          <td><?php echo $formdata['time_to_call'];?></td>
        </tr>
        <tr>
          <td>Payment Status</td>
          <td><?php if($formdata['payment_status']=='1'){echo 'Paid';}elseif($formdata['payment_status']=='2'){echo 'Unpaid';}else echo 'NA' ?></td>
        </tr>
        <tr>
          <td>CV Source</td>
          <td>
                    <?php 
					if($formdata['lead_source']=='1')
					{echo 'Naukri';}
					elseif($formdata['lead_source']=='2')
					{echo 'Linkedin';}
					elseif($formdata['lead_source']=='3')
					{echo 'Facebook';}
					elseif($formdata['lead_source']=='4')
					{echo 'Own Database';}
					elseif($formdata['lead_source']=='5')
					{echo 'Website';}
					elseif($formdata['lead_source']=='6')
					{echo 'Whatsapp';}
					elseif($formdata['lead_source']=='7')
					{echo 'Quikr';}
					else echo 'NA' 
					?></td>
        </tr>
        <tr>
          <td>Job Folder</td>
          <td><?php echo $formdata['job_folder_name'];?></td>
        </tr>
       
          </table></td>
        </tr>
       
</table>
      
      
      <?php if(count($cand_language)>0){?>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
      <thead>
        <tr>
          <div class="tab-head mar-spec">
            <h3>Languages Known</h3>
            </div>
        </tr>
      </thead>
      <tbody>
      <th>Languages</th>
      <th>Read</th>
      <th>Write</th>
      <th>Speak</th>
        <?php foreach($cand_language as $key => $val){?>
        <tr>
          <td><?php echo $val['lang_name'];?></td>
          <td><?php if($val['read_status']==1) echo 'Yes'; else echo 'No';?></td>
          <td><?php if($val['write_status']==1) echo 'Yes'; else echo 'No';?></td>
          <td><?php if($val['speak_status']==1) echo 'Yes'; else echo 'No';?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
       <?php } ?>   
      
            </div>
            <div class="col-sm-16">

                            <div class="tab-head mar-spec">
                <h3>Photo & CV </h3>
              </div>
              <table width="95%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                <tr>
                  <td width="22%"><?php if(file_exists('uploads/photos/'.$formdata['photo']) && $formdata['photo']!=''){?>
                    <span id="imgTab2"><img srupload_cv_photoc="<?php echo base_url().'uploads/photos/'.$formdata['photo'];?>" style="width:158px;height:100px;"><br />
                    <br />
                    &nbsp;&nbsp;</span>
                    <?php }else{ ?>
                    <img src="<?php echo base_url().'uploads/no_photo.png';?>">
                    <?php } ?></td>
                  <td width="78%"><?php if($formdata['cv_file']!=''){?> <a href="<?php echo $this->config->item('cv_path')?><?php echo $formdata['cv_file'];?>" target="_blank" class="btn btn-success btn-sm">Download Candidate CV</a><?php }else{ ?>No CV Uploaded<?php } ?></td>
                </tr>
                <tr>
                  <td colspan="2">

            </td>
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
                    <td align="left" valign="top">
                    <table width="100%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                        <thead>
                        <tr>
                          <div class="tab-head mar-spec">
                            <h3>Certifications</h3>
                            </div>
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
          </div>
            </td>
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
                  <th>Mark Percentage</th>
                  <th>Country</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach($education_details as $key => $val){?>
                <tr>
                  <td><?php echo $val['level_name'];?></td>
                  <td><?php echo $val['course'];?></td>
                  <td><?php echo $val['univ'];?></td>
                  <td><?php echo $val['edu_year'];?></td>
                  <td><?php echo $val['mark_percentage']."%";?></td>
                  <td><?php echo $val['edu_country'];?></td>
                
                </tr>
                <?php } ?>
              </tbody>
            </table></td>
        </tr>
        <?php } ?>
        <?php if(count($job_history)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top">
          <div class="tab-head mar-spec">
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
                <td>Monthly Salary</td>
               
              </tr>
              <?php foreach($job_history as $key => $val){?>
              <tr>
                <td><?php echo $val['organization'];?></td>
                <td><?php echo $val['desig_name'];?></td>
                <td><?php if($val['from_date']!='0000-00-00' && $val['from_date']!='')echo date('Y-m-d', strtotime($val['from_date']));?></td>
                <td><?php if($val['present_job']==1){echo 'Till Date'; }else if($val['to_date']!='0000-00-00' && $val['to_date']!='')echo date('Y-m-d', strtotime($val['to_date']));?></td>
                <td><?php echo $val['job_cat_name'];?></td>
                <td><?php echo $val['func_area'];?></td>
                <td><?php echo $val['monthly_salary'];?></td>
                
              </tr>
              <tr>
                <td colspan="7">Responsibility: <?php echo $val['responsibility'];?></td>
              </tr>
              <tr>
                <td colspan="8" style="height:5px;background-color:#D4D4D4"></td>
              </tr>
              <?php } ?>
            </table></td>
        </tr>
        <?php } ?>
        <?php if(count($proj_history)>0){?>
        <tr>
          <td colspan="2" align="center" valign="top"><div class="tab-head mar-spec">
              <h3>Project Summary</h3>
            </div></td>
        </tr>
        <tr>
          <td colspan="2" align="center" valign="top"><table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
              <tr>
                <td>Project Title</td>
                <td>Project Url</td>
                <td>Project Description</td>
                <td>Technologies Used</td>
               
              </tr>
              <?php foreach($proj_history as $key => $val){?>
              <tr>
                <td><?php echo $val['project_title'];?></td>
                <td><?php echo $val['project_links'];?></td>
                <td><?php echo $val['project_desc'];?></td>
                <td><?php echo $val['tech_used'];?></td>
               
              </tr>
              <?php } ?>
              
            
              
            </table></td>
        </tr>
        <?php } ?>

        

        
      </table>
      
     
      
    </div>
  </div>
</div>
</section>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script> 
