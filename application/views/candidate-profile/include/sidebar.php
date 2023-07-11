<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
               <span class="app-brand-logo demo">
               <img src="<?php echo base_url('assets/images/logo.jpeg');?>" width="10%" height="100%" />
              </span>
            </a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
            <div class="user-avatar-section">
               <div class=" d-flex align-items-center flex-column">
                  
                  <?php if($detail_list['photo']!='' && file_exists($this->config->item('photo_upload_folder').$detail_list['photo'])){?>
                                                <img class="img-fluid rounded my-4" src="<?php echo $this->config->item('photo_path').$detail_list['photo'];?>" height="110" width="110" alt="User avatar" />
                                                <?php }else{ ?> 
                                                    <img class="img-fluid rounded my-4" src="<?php echo base_url().'assets/images/no_photo.png';?>" height="110" width="110" alt="User avatar" />
                                                
                                                <?php } ?>
                  <div class="user-info text-center">
                     <h4 class="mb-2"><?php echo $formdata['first_name'];?></h4>
                     <span class="badge bg-label-secondary"><?php echo $formdata['cur_job_status_name'];?></span>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center mb-1">
                  <span>Days</span>
                  <span>65% Completed</span>
               </div>
               <div class="progress mb-1" style="height: 8px;">
                  <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                  </div>
               </div>
            </div>
            <ul class="menu-inner py-1">
            <li class="menu-item">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Resume headline">My Profile</div>
                      </a>
                    </li>
                    <li class="menu-item">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Resume headline">View Jobs</div>
                      </a>
                    </li>
                    <li class="menu-item">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Resume headline">All Interviews</div>
                      </a>
                    </li>
                    <li class="menu-item">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Resume headline">My Messages</div>
                      </a>
                    </li>
               <li class="menu-item resume_headline">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Resume headline">Resume headline</div>
                      </a>
                    </li>
                    <li class="menu-item personal_details">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Personal Details">Personal Details</div>
                      </a>
                    </li>
                    <li class="menu-item professional_summery">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Professional Summery">Professional Summery </div>
                      </a>
                    </li>
                    <li class="menu-item desired_jobs">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Desired Jobs">Desired Jobs</div>
                      </a>
                    </li>
                    <li class="menu-item employment">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Employment">Employment</div>
                      </a>
                    </li>
                    <li class="menu-item education">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Education">Education</div>
                      </a>
                    </li>
                    <li class="menu-item skills">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Skills">Skills</div>
                      </a>
                    </li>
                    <li class="menu-item other_details">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Other Details">Other Details</div>
                      </a>
                    </li>
                    <li class="menu-item photo_cv">
                      <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-support"></i>
                        <div data-i18n="Photo & CV">Photo & CV</div>
                      </a>
                    </li>
            </ul>
        </aside>