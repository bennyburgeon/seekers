      <!-- Content -->
      <div class="joblisting">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2>  <span> Find the </span> right job. Right now. </h2>
               </div>
               
                 <?php 
				if(isset($jobs) && !empty($jobs))
				{
				 foreach($jobs as $job)
				 {
		  ?>
               
               <!-- item1 -->         
               <div class="col-md-6 col-sm-12">
                  <div class="job-item featured-item" >
                     <div class="job-image">
                         <?php 
					 if($job['show_company_details']==1 && $job['company_logo']!='' && file_exists('rms/company_logo/'.$job['company_logo'])){
					?>

					   <img alt="<?php echo $job['company_name'];?>" src="<?php echo base_url('rms/company_logo/'.$job['company_logo']);?>">
                    
                    <?php }else{ ?>
					
                       <img alt="Logis" src="<?php echo base_url('img/thumb-logo.jpg');?>">	 
						 
					<?php } ?>
                     
                     
                     </div>
                     <div class="job-info yes-logo">
                        <h3>
                           
                            <a href="<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>"><?php echo $job['job_title']; ?> </a> 
                            
                            
                        </h3>
                        
                         <p> <?php 
					 if($job['show_company_details']==1){
					?>

					   <?php echo $job['company_name'];?>
                    
                    <?php }else{ ?>
					
                    Logis.ae
						 
					<?php } ?>
                     </p>
                     
                        <ul>
                           <li><i class="fa fa-industry"></i>  <?php if($job['job_cat_name']!='')echo $job['job_cat_name'];else echo 'NA' ?> 
                             </li>
                             <li><i class="fa fa-suitcase"></i><?php if($job['func_area']!='')echo ','.$job['func_area'];?> </li>
                           <li><i class="fas fa-map-marker-alt"></i>  <?php if($job['city_name']!='')echo $job['city_name'];else echo 'NA'; ?>, <?php if($job['country_name']!='')echo $job['country_name'];else echo 'ANY'; ?>   </li>
                           <li><i class="far fa-calendar-alt"></i>  <?php echo date("d-m-Y", strtotime($job['job_post_date'])); ?></li>
                        </ul>
                        <div class="job-type full-time">
                           <a  href="<?php echo $this->config->base_url();?>index.php/home" >Job ID: LOGIS-<?php echo $job['job_id']; ?></a>
                        </div>
                     </div>
                     <p> <?php echo $job['desired_profile']; ?></p>
                     <div class="job-skill">
                        <div class="shareicon">
                 

                            <a class="facebook"  href="http://facebook.com/logisticsjobsandcareers" target="_blank"><i class="fab fa-facebook-f"></i></a>

                            

                                  <a class="res_div" href="http://linkedin.com/company/logisticsjobs" target="_blank"><i class="fab fa-linkedin"></i></a> 

                            

                           <a class="twitter" href="https://wa.me/971503860610" target="_blank"><i class="fab fa-whatsapp"></i></a>

                           

                            <a class="dribbble" href="http://instagram.com/seekershr" target="blank"><i class="  fab fa-instagram"></i></a>
                   
                   
                 
                        </div>
                        <a href="<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>"> View & Apply <i class="fas fa-angle-double-right"></i> </a>
                     </div>
                  </div>
               </div>
               <!-- item1 -->    
               
               <?php 
			   
			   }} 
			   
			   ?>
               
            </div>
         </div>
      </div>
      <!-- Content -->    
      <div class="needhelp">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2> Need Any Help? </h2>
               </div>
               <div class="col-md-4">
                  <div class="info-box-1">
                     <div class="utf-icon-box-circle">
                        <div class="utf-icon-box-circle-inner"> <i class="fab fa-rocketchat"></i></div>
                     </div>
                     <h4>Chat to Us Online</h4>
                     <p>Chat to us online if you have any question.</p>
                     <a href="javascript:void(0);" >Click Here to Chat <i class="fas fa-angle-double-right"></i></a> 
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="info-box-1">
                     <div class="utf-icon-box-circle">
                        <div class="utf-icon-box-circle-inner"> <i class="fas fa-phone"></i></div>
                     </div>
                     <h4>Our Support Agent</h4>
                     <p>Our support agent will work with you to meet your lending needs.</p>
                     <a href="javascript:void(0);" >Contact us <i class="fas fa-angle-double-right"></i></a> 
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="info-box-1">
                     <div class="utf-icon-box-circle">
                        <div class="utf-icon-box-circle-inner"> <i class="fab fa-blogger"></i></div>
                     </div>
                     <h4>Read Latest Blog Post</h4>
                     <p>Visit our Blog page and know more about news and career tips</p>
                     <a href="javascript:void(0);" >Read Blog Post  <i class="fas fa-angle-double-right"></i></a> 
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Content -->     
      <div class="blogbox">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <h2> Our Services </h2>
               </div>
               <div class="col-md-4">
                  <div class="blogitems">
                     <img src="<?php echo base_url('img/b1.jpg');?>">
                     <div class="post-content">
                        <h3 > <a href="<?php echo $this->config->base_url();?>index.php/cvwriting">Professional CV Writing</a></h3>
                        <p> emplome.com will help you to draft professional and impressive standard resumes, visual resumes and video resumes. Resumes introduce you to the potential employers, and hold the power to make or break careers. It is desired to be very </p>
                        <div class="post-bottom">
                        
                           <a class="post-read-more theme-color" href="<?php echo $this->config->base_url();?>index.php/cvwriting">Read more<i class="ion-arrow-right-c"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="blogitems">
                     <img src="<?php echo base_url('img/b2.jpg');?>">
                     <div class="post-content">
                        <h3 > <a href="<?php echo $this->config->base_url();?>index.php/jobalerts"> Job Alerts </a></h3>
                        <p>
                           Job alerts will help the candidates to catch up as and when a good opportunity comes in which suits the candidate’s profile... Job alerts will help the candidates to catch up as and when a good opportunity comes in which suits the candidate’s profile... 
                        </p>
                        <div class="post-bottom">
                           
                           <a class="post-read-more theme-color" href="<?php echo $this->config->base_url();?>index.php/jobalerts">Read more<i class="ion-arrow-right-c"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="blogitems">
                     <img src="<?php echo base_url('img/b3.jpg');?>">
                     <div class="post-content">
                        <h3 > <a href="<?php echo $this->config->base_url();?>index.php/cvsearch">CV Database Search</a></h3>
                        <p> Employers can search within millions of CVs in emplome.com and find the right candidates quickly!
                           All industries and job categories covered and instantly access the candidate. Subscribe CV Database Search online today.
                        </p>
                        <div class="post-bottom">
                           
                           <a class="post-read-more theme-color" href="<?php echo $this->config->base_url();?>index.php/cvsearch">Read more<i class="ion-arrow-right-c"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>