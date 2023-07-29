<div class="layout-page">
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar" >
   <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
      <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
      </a>
   </div>
   <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
      <!-- Search -->
      
      <!-- /Search -->
      <ul class="navbar-nav flex-row align-items-center ms-auto">
         <!-- <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
            <i class="bx bx-bell bx-sm"></i>
            <span class="badge bg-danger rounded-pill badge-notifications">5</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end py-0">
               <li class="dropdown-menu-header border-bottom">
                  <div class="dropdown-header d-flex align-items-center py-3">
                     <h5 class="text-body mb-0 me-auto">Messages</h5>
                     <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a>
                  </div>
               </li>
               <li class="dropdown-notifications-list scrollable-container">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item list-group-item-action dropdown-notifications-item">
                        <div class="d-flex">
                           <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                 <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle">
                              </div>
                           </div>
                           <div class="flex-grow-1">
                              <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                              <p class="mb-0">Won the monthly best seller gold badge</p>
                              <small class="text-muted">1h ago</small>
                           </div>
                           <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"><span class="badge badge-dot"></span></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"><span class="bx bx-x"></span></a>
                           </div>
                        </div>
                     </li>
                     
                     
                  </ul>
               </li>
               <li class="dropdown-menu-footer border-top">
                  <a href="javascript:void(0);" class="dropdown-item d-flex justify-content-center p-3">
                  View all Messages
                  </a>
               </li>
            </ul>
         </li> -->
         <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a class="nav-link dropdown-toggle hide-arrow" href="<?php echo $this->config->site_url();?>/candidates_all/summary" >
            My Profile
            </a>
         </li>
         <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a class="nav-link dropdown-toggle hide-arrow" href="<?php echo $this->config->site_url();?>/notifications" >
            Message
            </a>
         </li>
         <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a class="nav-link dropdown-toggle hide-arrow" href="<?php echo $this->config->site_url();?>/home" >
            All Jobs
            </a>
         </li>
         <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
            <a class="nav-link dropdown-toggle hide-arrow" href="<?php echo $this->config->site_url();?>/interviews/" >
            All Interviews
            </a>
         </li>
         <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
               <div class="avatar avatar-online">
                  
                  <?php if($detail_list['photo']!='' && file_exists($this->config->item('photo_upload_folder').$detail_list['photo'])){?>
                    <img src="<?php echo $this->config->item('photo_path').$detail_list['photo'];?>" alt class="w-px-40 h-auto rounded-circle" />
                                                <?php }else{ ?> 
                                                    <img src="<?php echo base_url().'assets/images/no_photo.png';?>" alt class="w-px-40 h-auto rounded-circle" />
                                                <?php } ?>
               
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
               <li>
                  <a class="dropdown-item" href="#">
                     <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                           <div class="avatar avatar-online">
                              <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                           </div>
                        </div>
                        <div class="flex-grow-1">
                           <span class="fw-semibold d-block">John Doe</span>
                           <small class="text-muted">Admin</small>
                        </div>
                     </div>
                  </a>
               </li>
               <li>
                  <div class="dropdown-divider"></div>
               </li>
               <li>
                  <a class="dropdown-item" href="#">
                  <i class="bx bx-user me-2"></i>
                  <span class="align-middle">My Profile</span>
                  </a>
               </li>
               <li>
                  <a class="dropdown-item" href="#">
                  <i class="bx bx-cog me-2"></i>
                  <span class="align-middle">Settings</span>
                  </a>
               </li>
               <li>
                  <a class="dropdown-item" href="#">
                  <span class="d-flex align-items-center align-middle">
                  <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                  <span class="flex-grow-1 align-middle">Billing</span>
                  <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                  </span>
                  </a>
               </li>
               <li>
                  <div class="dropdown-divider"></div>
               </li>
               <li>
                  <a class="dropdown-item" href="{{ route('logout') }}"  >
                  <i class="bx bx-power-off me-2"></i>
                  <span class="align-middle">Log Out</span>
                  </a>
               </li>
            </ul>
         </li>
      </ul>
      
   </div>
</nav>
<div class="content-wrapper">