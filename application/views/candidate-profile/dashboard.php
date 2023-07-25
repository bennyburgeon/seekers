
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
      <div class="col-md-12">
         <div class="row">

<!-- Resume headline -->
                  <div tabindex='2' id="resume_headline" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between" data-bs-toggle="offcanvas" data-bs-target="#resume_heading">
                           <h5 class="card-title m-0 me-2">Resume headline</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary ">Update</button>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                 <hr class="m-0" />
                                 <div class="col-md-12">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                          <br>
                                       <?php echo $headline['headline']?>
                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Resume headline end -->

<!-- personal details -->
                  <div tabindex='2' id="personal_details" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Personal Details</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#personal_details_add" aria-controls="offcanvasEnd" >Update</button>
                           </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-4">
                                 <div class="info-container">
                                    <ul class="list-unstyled">
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">First Name:</span>
                                          <span><?php echo $formdata['first_name'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Mobile:</span>
                                          <span><?php echo $formdata['mobile_prefix'].' '.$formdata['mobile'];?><?php if($formdata['mobile1']!='')echo ', '.$formdata['mobile_prefix1'].' '.$formdata['mobile1'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Username/Email :</span>
                                          <span><?php echo $formdata['username'];?>
                    <?php if($formdata['alternate_email']!='')echo '<br>'.$formdata['alternate_email'];?></span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="info-container">
                                    <ul class="list-unstyled">
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Marital Status:</span>
                                          <span><?php if($formdata['marital_status']==1) echo 'Married'; else echo 'Single';?></span>
                                       </li>
                                       
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Nationality:</span>
                                          <span><?php echo $formdata['nationality_name'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">State:</span>
                                          <span><?php echo $formdata['current_location_name'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Current Location:</span>
                                          <span><?php echo $formdata['current_location_name'];?></span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="info-container">
                                    <ul class="list-unstyled">
                                    <li class="mb-2">
                                          <span class="fw-bold me-2">Age : </span>
                                          <span><?php echo $formdata['age'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Gender:</span>
                                          <span><?php if($formdata['gender']==1) echo 'Male'; if($formdata['gender']==0)echo 'Female';?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">Registered On:</span>
                                          <span><?php echo $formdata['reg_date'];?></span>
                                       </li>
                                       <li class="mb-2">
                                          <span class="fw-bold me-2">DoB:</span>
                                          <span><?php echo $formdata['date_of_birth'];?></span>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- personal details end -->
<!-- Professional Summery -->
                  <div tabindex='2' id="professional_summery" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Professional Summery</h5>
                           <div class="dropdown">
                           <button  class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#professional_details_add" aria-controls="offcanvasEnd" >Update</button>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                 <hr class="m-0" />
                                 <div class="col-md-4">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Driving License:</span>
                                             <span><?php if($formdata['driving_license']==1) echo 'Yes'; if($formdata['driving_license']==0)echo 'No';?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">License Issued From:</span>
                                             <span class="badge bg-label-success"><?php if($formdata['driving_license']=='0'){ echo 'Nill';}else{ echo $formdata['driving_license_country_name'];}?></span>
                                          </li>
                                          
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Current Job Status: </span>
                                             <span><?php echo $formdata['cur_job_status_name'];?> </span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Linkedin Profile Link:</span>
                                             <span>
                                             <a href="<?php echo $formdata['linkedin_url'];?>" target="_blank"><?php echo $formdata['linkedin_url'];?></a> 
                                             
                                             </span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       
                                       <li class="mb-2">
                                             <span class="fw-bold me-2">VISA Type:</span>
                                             <span><?php echo $formdata['visa_type'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Current Salary:</span>
                                             <span><?php echo  $this->config->item('currency_symbol');?><?php if(isset($job_search['current_ctc']))echo $job_search['current_ctc'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Expeced Salary:</span>
                                             <span class="badge bg-label-success"><?php echo  $this->config->item('currency_symbol');?><?php if(isset($job_search['expected_ctc'])) echo $job_search['expected_ctc'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Notice Period:</span>
                                             <span><?php if(isset($job_search['notice_period'])) echo $job_search['notice_period'];?>
                    Days</span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Total Experience</span>
                                             <span><?php if(isset($job_search['total_experience'])) echo $job_search['total_experience'];?>                      Years</span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Skills:</span>
                                             <span><?php if(isset($formdata['skills'])) echo $formdata['skills'];?></span>
                                          </li>
                                          <li class="mb-2">
                                             <span class="fw-bold me-2">Reason to Leave:</span>
                                             <span><?php if(isset($job_search['reason_to_leave']) && $job_search['reason_to_leave']!='')echo $job_search['reason_to_leave'];else echo 'NA';?></span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Professional Summery end -->
<!-- Desired Jobs -->
                  <div tabindex='2'  id="desired_jobs" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Desired Jobs</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#update_desired_jobs" aria-controls="offcanvasEnd" >Update</button>
                           </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                                 
                                 <div class="col-md-12">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       <span class="badge bg-label-primary me-1">IT</span>
                                       <span class="badge bg-label-primary me-1">Software Development</span>
                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Resume headline end -->
<!-- Employment -->
                  <div tabindex='2' id="employment" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Employment</h5>
                           <div class="dropdown">
                           <button  class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#employment_details_add" aria-controls="offcanvasEnd" >Add</button>
                           </div>
                        </div>
                        <div class="card-body ">
                           <div class="row">
                           <?php foreach($job_history as $key => $val){?>
                                 <hr class="m-0" />
                                 <div class="col-md-6">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Designation :</span>
                                             <span><?php echo $val['desig_name'];?></span>
                                          </li>
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Organization :</span>
                                             <span><?php echo $val['organization'];?></span>
                                          </li>
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">From:</span><span><?php echo date('d M, Y',strtotime($val['from_date']));?></span>
                                             <span class="fw-bold me-2">To:</span><span><?php if($val['present_job']==1){echo 'Till Date'; }else{ echo date('d M, Y',strtotime($val['to_date']));}?></span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-5">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                         
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Industry :</span>
                                             <span><?php echo $val['job_cat_name'];?></span>
                                          </li>
                                          <li class="mb-1">
                                             <span class="fw-bold me-2">Function :</span>
                                             <span><?php echo $val['func_area'];?></span>
                                          </li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-1"> 
                                 <a  onclick="" id="edit_edu"><i class="bx bx-edit-alt me-2"></i></a>
                                 </div>
                                 <div class="col-md-12">
                                 <li class="mb-1">
                                             <span class="fw-bold me-2">Responsibilities :</span>
                                             <span><?php echo $val['responsibility'];?></span>
                                          </li>
                                 </div>
                                 <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Employment end -->
<!-- Education -->
                  <div tabindex='2' id="education" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Education</h5>
                           <div class="dropdown">
                           <button  class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#education_details_add" aria-controls="offcanvasEnd" >Add</button>
                           
                           </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach($education_details as $key => $val){?>
                                    <hr class="m-0" />
                                        <div class="col-md-6">
                                            <div class="info-container">
                                            <ul class="list-unstyled">
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Course :</span>
                                                    <span><?php echo $val['course_name'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Specialisation :</span>
                                                    <span><?php echo $val['spcl_name'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">University:</span>
                                                    <span><?php echo $val['univ_name'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Year:</span>
                                                    <span><?php echo $val['edu_year'];?></span>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="info-container">
                                            <ul class="list-unstyled">
                                                
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Level of study :</span>
                                                    <span><?php echo $val['level_name'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Course Type :</span>
                                                    <span><?php echo $val['course_type'];?></span>
                                                </li>
                                                <li class="mb-1">
                                                    <span class="fw-bold me-2">Country :</span>
                                                    <span><?php echo $val['country_name'];?></span>
                                                </li>
                                            </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-1"> 
                                        <a ><i class="bx bx-edit-alt me-2"></i></a>
                                        </div>
                                <?php } ?>
                            </div>
                        </div>
                     </div>
                  </div>
<!-- Education end-->
<!-- Skills -->
         <div tabindex='2' id="skills" class=" col-md-6 col-lg-12 order-2 mb-4">
            <div class="card h-100">
               <div class="card-header d-flex align-items-center justify-content-between">
                  <h5 class="card-title m-0 me-2">Skills</h5>
                  <div class="dropdown">
                  <button  class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#skills_add" aria-controls="offcanvasEnd" >Update</button>
                  </div>
               </div>
               <hr class="m-0" />
               <div class="card-body">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="info-container">
                           <ul class="list-unstyled">
                              <?php foreach($candidate_skill as $key => $val){?>
                              <span class="badge bg-label-primary me-1"><?php echo $val['skill_name'];?></span>
                              <?php } ?>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

<!-- Skills end -->
<!-- Other Details -->
                  <div tabindex='2' id="other_details" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2">Other Details</h5>
                           <div class="dropdown">
                              <button  class="btn btn-sm btn-outline-secondary" data-bs-toggle="offcanvas" data-bs-target="#other_details_add" aria-controls="offcanvasEnd" >Update</button>
                           </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                                 <div class="col-md-12">
                                    <div class="info-container">
                                       <ul class="list-unstyled">
                                       <?php if(isset($formdata['fee_comments'])) echo $formdata['fee_comments'];?>
                                       </ul>
                                    </div>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Other Details end -->
<!-- Photo & CV -->
                  <div tabindex='2' id="photo_cv" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                           <h5 class="card-title m-0 me-2 head">Photo & CV</h5>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                           <div class="row">
                           <div class="col-md-6">
                                       <div class="card-body">
                                          <div class="d-flex align-items-start align-items-sm-center gap-4">
                                          <label for="upload" class="" tabindex="0">
                                                <?php if($detail_list['photo']!='' && file_exists($this->config->item('photo_upload_folder').$detail_list['photo'])){?>
                                                <img src="<?php echo $this->config->item('photo_path').$detail_list['photo'];?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                                <?php }else{ ?> 
                                                <img src="<?php echo base_url().'assets/images/no_photo.png';?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                                                <?php } ?>
                                                </label>
                                                <div class="button-wrapper">
                                                         <form class="form-horizontal form-bordered"  method="post" id="upload_cv_photo_frm" name="upload_cv_photo_frm" action="<?php echo $this->config->site_url();?>/candidates_all/upload_cv_photo/" enctype="multipart/form-data"> 
                                                            <input type="hidden" name="candidate_id" value="<?php echo $formdata['candidate_id'];?>" />
                                                            <input type="file" id="upload" name="photo" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                                            <input type="submit" class="btn btn-primary me-2 mb-4" value="Upload" id="save_candidate2"  >   
                                                         </form>
                                                   <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                                      <i class="bx bx-reset d-block d-sm-none"></i>
                                                      <span class="d-none d-sm-block">Reset</span>
                                                   </button>
                                                   <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="card-body">
                                          <div class="col-md-12">
                                             <div class="row">
                                                <form class="form-horizontal form-bordered"  method="post" id="upload_cv_photo_frm" name="upload_cv_photo_frm" action="<?php echo $this->config->site_url();?>/candidates_all/upload_cv_photo/" enctype="multipart/form-data"> 
                                                <input type="hidden" name="candidate_id" value="<?php echo $formdata['candidate_id'];?>" />   
                                                <div class="col-md-8">
                                                      <input class="form-control" type="file" name="cv_file" id="formFile" />
                                                   </div>
                                                   <div class="col-md-4">
                                                   <input type="submit" class="btn btn-primary me-2 mb-4" value="Upload" id="save_candidate2"  >   
                                                   </div>
                                                </form>
                                             </div>
                                                <div class="col-md-8">
                                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                                      View Resume
                                                   </div>
                                                </div>
                                          </div>
                                       </div>
                                    </div> 
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Photo & CV end -->
         </div>
      </div>
   </div>
</div>
<!-- add resume heading -->
<div class="offcanvas offcanvas-end" style="width: 80%;" tabindex="-1" id="resume_heading" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Update Resume Headline</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <div class="card-body">
         <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/candidates_all/update_resume_headline/"  onSubmit="return validate_profile_form();">
            <div class="row">
               <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
               <div class="col-md-12">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2">Headline</span>
                           <textarea class="form-control" placeholder="headline"  type="text"  name="headline"  id="headline"><?php echo $headline['headline']?></textarea>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Update</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
      </form>
   </div>
</div>
<!-- add personal details -->
<div class="offcanvas offcanvas-end" style="width: 80%;" tabindex="-1" id="personal_details_add" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Update Presonal details</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body my-auto mx-0 flex-grow-0">
      <div class="card-body">
         <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/candidates_all/update_personal_profile/"  onSubmit="return validate_profile_form();">
            <div class="row">
               <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
               <div class="col-md-6">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2">Candidate Name</span>
                           <input class="form-control" placeholder="First Name"  type="text"  name="first_name" value="<?php echo $formdata['first_name']?>" id="first_name">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Mobile</span>
                           <table>
                              <tr>
                                 <td style="width: 30%;">
                                    <input type="text"  name="mobile_prefix" class="form-control" placeholder="Country Code" maxlength="5" value="+971" id="mobile_prefix">
                                 </td>
                                 <td>
                                    <input class="form-control" placeholder="Last Name" type="text" maxlength="10"  name="mobile" value="<?php echo $formdata['mobile']?>" id="mobile">
                                 </td>
                              </tr>
                           </table>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Alternate Mobile</span>
                           <table>
                              <tr>
                                 <td style="width: 30%;">
                                    <input type="text" name="mobile_prefix1" class="form-control" placeholder="Country Code" value="<?php echo $formdata['mobile_prefix1'];?>" maxlength="5" id="mobile_prefix1" >
                                 </td>
                                 <td>
                                    <input type="text" name="mobile1"  class="form-control" value="<?php echo $formdata['mobile1'];?>" placeholder="Mobile No. 2" maxlength="9" id="mobile1">
                                 </td>
                              </tr>
                           </table>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">DOB</span>
                           <input class="form-control"  type="date" name="date_of_birth" value="<?php echo $formdata['date_of_birth'];?>" id="html5-date-input" />
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Gender</span>
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
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Marital Status:</span>
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
                              echo form_radio($data).'Single';
                              ?> 
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2">Alternative E Mail ID</span>
                           <input type="text" value="<?php echo $formdata['alternate_email'];?>" name="alternate_email" placeholder="Alternative E Mail ID" maxlength="200" id="alternate_email" class="form-control"  />
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Nationality</span>
                           <?php echo form_dropdown('nationality',  $nationality_list,$formdata['nationality'],'class="form-control" id="visa_type_id"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Country of Residence</span>
                           <?php echo form_dropdown('country_id',  $country_list,$formdata['country_id'],'class="form-control" id="country_id_profile"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">State</span>
                           <?php echo form_dropdown('state_id',  $state_list,$formdata['state_id'],'class="form-control" id="state_id_profile"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">City</span>
                           <?php echo form_dropdown('city_id',  $city_list,$formdata['city_id'],'class="form-control" id="city_id_profile"');?>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Update</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
      </form>
   </div>
</div>
<!-- personal details end -->
<!-- add professional details -->
<div class="offcanvas offcanvas-end" style="width: 80%;" tabindex="-1" id="professional_details_add" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Update Professional details</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body  mx-0 flex-grow-0">
      <div class="card-body">
         <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form4" action="<?php echo $this->config->site_url();?>/candidates_all/update_professional_profile/"  onSubmit="return validate_profile_form();">
            <div class="row">
               <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
               <div class="col-md-6">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2">Driving License</span>
                           <input type="radio" name="driving_license" id="driving_license_yes" onClick="$('#driving_license_row').show();" value="1" <?php if($formdata['driving_license']=='1')echo 'checked';?>>Yes 
                           || 
                           <input type="radio" name="driving_license" id="driving_license_no" onClick="$('#driving_license_row').hide();" value="0" <?php if($formdata['driving_license']=='0')echo 'checked';?>>No
                        </li>
                        <li class="mb-2" id="driving_license_row" style="display:<?php if($formdata['driving_license']=='0')echo 'none';?>;">
                           <span class="fw-bold me-2">License Issued From</span>
                           <?php echo form_dropdown('driving_license_country',  $nationality_list,$formdata['driving_license_country'],'class="form-control" id="driving_license_country"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Current Job Status</span>
                           <?php echo form_dropdown('cur_job_status',  $cur_job_status_list, $formdata['cur_job_status'],' id="cur_job_status" data-placeholder="Filter by status" class="form-control input-sm"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Linkedin Profile Link</span>
                           <input type="text" class="form-control" value="<?php echo $formdata['linkedin_url'];?>" placeholder="Linkedin Profile" name="linkedin_url" id="linkedin_url">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Visa Type</span>
                           <?php echo form_dropdown('visa_type_id',  $visa_type_list,'','class="form-control" id="visa_type_id"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Skills</span>
                           <input placeholder="Skills" class="form-control" type="text"  name="skills" value="<?php if(isset($formdata['skills'])) echo $formdata['skills']?>" id="skills">
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2">Current Salary</span>
                           <input placeholder="CTC" class="form-control" type="text"  name="current_ctc" value="<?php if(isset($job_search['current_ctc'])) echo $job_search['current_ctc']?>" id="current_ctc">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Expeced Salary</span>
                           <input placeholder="Exp. CTC" class="form-control" type="text"  name="expected_ctc" value="<?php if(isset($job_search['expected_ctc'])) echo $job_search['expected_ctc']?>" id="expected_ctc">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Notice Period</span>
                           <input placeholder="Notice" class="form-control" type="text"  name="notice_period" value="<?php if(isset($job_search['notice_period'])) echo $job_search['notice_period']?>" id="notice_period">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Total Experience</span>
                           <input placeholder="Total Exp" class="form-control" type="text"  name="total_experience" value="<?php if(isset($job_search['total_experience'])) echo $job_search['total_experience']?>" id="total_experience">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Reason to Leave</span>
                           <input style="width:400px;" class="form-control" placeholder="Reason to Leave."  type="text"  name="reason_to_leave" value="<?php echo $job_search['reason_to_leave'] ?>" id="reason_to_leave">
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Update</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
      </form>
   </div>
</div>
<!-- professional details end -->


<!-- deisred jobs -->

<div class="offcanvas offcanvas-end" style="width: 50%;" tabindex="-1" id="update_desired_jobs" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Update Desired Jobs</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body  mx-0 flex-grow-0">
      <div class="card-body">
      <form class="form-horizontal form-bordered"  method="post" id="job_form" name="add_job_frm" action="<?php echo $this->config->site_url();?>/candidates_all/update_desired_job/"> 
      <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                <div class="row">
               <div class="col-md-12">
                  <div class="info-container">
                     <ul class="list-unstyled">
                            
            <select class="form-control js-example-basic-multiple-cert" multiple="multiple" name="skills[]" id="multiple_skill" > 
               <option value="">Select Skill</option>
               
               <?php foreach($functional_list_data as $functional){?>
               <option value="<?php echo $functional['func_id'];?>"><?php echo $functional['func_area'];?></option>
               <?php }?>
            </select>
                   
                     </ul>
                  </div>
               </div>
               
            </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Add</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
      </form>
   </div>
</div>
<!-- end desired jobs -->
<!-- add Education details -->
<div class="offcanvas offcanvas-end" style="width: 50%;" tabindex="-1" id="education_details_add" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Add Education details</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body  mx-0 flex-grow-0">
      <div class="card-body">
      <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/candidates_all/edu_history_2/<?php echo $candidate_id;?>" onSubmit="return candidate_validate();"> 
                <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                <div class="row">
               <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
               <div class="col-md-12">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2">Level of Study</span>
                           <?php echo form_dropdown('level_id',  $edu_level_list,'','class="form-control" id="level_id"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Course</span>
                           <?php echo form_dropdown('course_id',  $edu_course_list, '','class="form-control" id="course_id"');?> 
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Specialization</span>
                           <?php echo form_dropdown('spcl_id',  $edu_spec_list, '','class="form-control" id="spcl_id"');?> 
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">University</span>
                           <input placeholder="University" class="form-control"    type="text"  name="univ_name" value="" id="univ_name">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Year</span>
                           <?php echo form_dropdown('edu_year',  $edu_years_list, '','class="form-control" id="edu_year"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Country</span>
                           <?php echo form_dropdown('edu_country',  $country_list, '','class="form-control" id="edu_country"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Course Type</span>
                           <?php echo form_dropdown('course_type_id',  $edu_course_type_list, '','class="form-control" id="course_type_id"');?>
                        </li>
                     </ul>
                  </div>
               </div>
               
            </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Update</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
      </form>
   </div>
</div>
<div class="offcanvas offcanvas-end" style="width: 50%;" tabindex="-1" id="employment_details_add" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Add Employment details</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body  mx-0 flex-grow-0">
      <div class="card-body">
      <form class="form-horizontal form-bordered"  method="post" id="job_form" name="add_job_frm" action="<?php echo $this->config->site_url();?>/candidates_all/add_job_history/"> 
      <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                <div class="row">
               <div class="col-md-12">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2">Is this your present job ?</span>
                           <label class="radio-inline">
                        <input type="radio" name="present_job" id="present_job" value="1">Yes</label>
                        <label class="radio-inline">
                        <input type="radio" name="present_job" id="present_job" value="0" checked>No</label>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">From Date</span>
                           <input type="date" class="form-control" name="from_date" id="datepickfrom" value="" placeholder="yyyy-mm-dd">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">To Date</span>
                           <input type="date" name="to_date" id="datepickto" class="form-control" value="" placeholder="yyyy-mm-dd">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Organization Name</span>
                           <input class="form-control hori" type="text" name="organization" value="" id="add_organization">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Designation</span>
                           <input class="form-control hori " type="text" name="designation" value="" id="designation">
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Industry</span>
                           <td> <?php echo form_dropdown('job_cat_id',  $industries_list, '','class="form-control" id="job_cat_id"');?> 
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Function</span>
                           <?php echo form_dropdown('func_id',  $functional_list, '','class="form-control" id="func_id"');?>
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Designation</span>
                           <?php echo form_dropdown('desig_id',  $designation_list, '','class="form-control" id="desig_id"');?> 
                        </li>
                        <li class="mb-2">
                           <span class="fw-bold me-2">Responsibility</span>
                           <?php echo $this->ckeditor->editor('responsibility');?>
                        </li>
                     </ul>
                  </div>
               </div>
               
            </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Add</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
      </form>
   </div>
</div>
<div class="offcanvas offcanvas-end" style="width: 50%;" tabindex="-1" id="other_details_add" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Add Other details</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body  mx-0 flex-grow-0">
      <div class="card-body">
      <form class="form-horizontal form-bordered"  method="post" id="other_details_form" name="other_details_form" action="<?php echo $this->config->site_url();?>/candidates_all/update_otherdetails/"> 
      <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                <div class="row">
               <div class="col-md-12">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2">Other Details</span>
                           
                           <textarea class="form-control" id="fee_comments" name="fee_comments" ><?php if(isset($formdata['fee_comments'])) echo $formdata['fee_comments'];?></textarea>
                        </li>
                     </ul>
                  </div>
               </div>
               
            </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Add</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
      </form>
   </div>
</div>
<div class="offcanvas offcanvas-end" style="width: 50%;" tabindex="-1" id="skills_add" aria-labelledby="offcanvasEndLabel" >
   <div class="offcanvas-header">
      <h5 id="offcanvasEndLabel" class="offcanvas-title">Add Skills</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close" ></button>
   </div>
   <div class="offcanvas-body  mx-0 flex-grow-0">
      <div class="card-body">
      <form class="form-horizontal form-bordered"  method="post" id="form_update_tech_skill" name="form_update_tech_skill" action="<?php echo $this->config->site_url();?>/candidates_all/skills_2/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 
      <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                <div class="row">
               <div class="col-md-12">
                  <div class="info-container">
                     <ul class="list-unstyled">
                        <li class="mb-2">
                           <span class="fw-bold me-2"> Skills</span>
                           
            <select class="form-control js-example-basic-multiple-cert" multiple="multiple" name="skills[]" id="multiple_skill" > 
               <option value="">Select Skill</option>
               <?php foreach($all_child_skills as $skill){?>
               <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
               <?php }?>
            </select>
                        </li>
                     </ul>
                  </div>
               </div>
               
            </div>
      </div>
      <button type="submit" class="btn btn-primary mb-2 d-grid w-100">Add</button>
      <button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas" >
      Cancel
      </button>
      </form>
   </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script language="javascript">
   $(document).ready(function() {
      $(".js-example-basic-multiple-cert").select2();
});
   $(document).ready(function()
{
$('#level_id').change(function() 
	{	
		jQuery('#course_id').html('');
		jQuery('#course_id').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_all/getcourses/',
			  data: { level_study: $('#level_id').val()},
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
});


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
	yearRange: "c-100:c+100"
	});
	
$('#datepickto').datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	yearRange: "c-100:c+100"
	});
	
$('#datepicker2').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "c-100:c+100"

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
			  url: '<?php echo $this->config->site_url();?>/candidates_all/getcourses/',
			  data: { level_study: $('#level_id').val()},
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

$("#add_job_link").click(function ()
 {
	$('html, body').animate({
		scrollTop: $("#add_job_history").offset().top
	}, 500);
});

$("#edit_mode_profession").click(function ()
{
		alert('You are editing Professional History Now, Please update it or cancel to add new one.');
		$('html, body').animate({
			scrollTop: $("#add_job_history").offset().top
		}, 500);
});   

<?php if($edit_job_html!=''){?>
	$('html, body').animate({
		scrollTop: $("#add_job_history").offset().top
	}, 500);
<?php } ?>

});

// VAlidate Email ADDRESS	
function email_validate() 
{
		if($('#subject').val()=='')
		{
			alert('Enter Subject');
			$('#subject').focus();
			return false;
		} 
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

function validate_profile_form()
{
	
	if($('#first_name').val()=='')
		{
			alert('Enter Full Name');
			$('#first_name').focus();
			return false;
		} 
		

	if($('#password').val()!='' && $('#c_password').val()=='')
		{
			alert('Confirm your password');
			$('#c_password').focus();
			return false;
		} 

	if($('#password').val()!='' && $('#c_password').val()!=$('#password').val())
		{
			alert('Please enter correct password');
			$('#c_password').focus();
			return false;
		} 

	if($('#mobile').val()=='')
		{
			alert('Enter Mobile');
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

</script>
