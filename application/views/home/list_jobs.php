<form id="search_form" action="<?php echo site_url('home/'); ?>"  class="formular" name="search_form" method="get" enctype="multipart/form-data"><div class="joblisting">
      <div class="container"> 
      <div class="row">
          
        <div class="col-md-12">
          

          
          </div>  
          
          
          
<div class="col-md-4 col-lg-4 col-sm-12">
    <div class="panel panel-default filterstyle ">
              <div class="panel-heading"><i class="fa fa-filter" aria-hidden="true"></i>Search Filter
           <button type="button" onclick="window.location='<?php echo site_url('home/'); ?>';" class="btn btn-primary pull-right btn-sm">Clear Filters</button>
        
        </div>
              
              <div class="form-group col-xs-12">




  <label for="sel1">Country</label>
                           <?php echo form_dropdown('country_id',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="country_id"');?>                           
                           <label for="sel1">State</label>
                          <?php echo form_dropdown('state_id',  $state_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="state_id"');?>
                         
                          <label for="sel1">City:</label>
                          <?php echo form_dropdown('city_id',  $city_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="city_id"');?>
                         
                
                <label for="sel1">Industry</label>
                
       			<?php echo form_dropdown('job_cat_id',  $industry_list, $job_cat_id,' class="form-control input-sm" id="job_cat_id"');?>            
                <label for="location">Functional Area</label>
              <?php echo form_dropdown('func_id',  $func_list, $func_id,' class="form-control input-sm" id="func_id"');?>          
               <label for="location">Designation</label>
              <?php echo form_dropdown('desig_id',  $desig_list, $desig_id,' class="form-control input-sm" id="desig_id"');?>               
                <label for="location">Skills</label>
              <?php echo form_dropdown('skill_id',  $skill_list, $skill_id,' class="form-control input-sm" id="skill_id"');?> 
                <label for="location">Education Level</label>

 				<?php echo form_dropdown('level_id',  $edu_level_list, $level_id,' class="form-control input-sm"');?>
                    
				
                <label for="location">Experience</label>
 				<?php echo form_dropdown('total_exp_needed',  $experience, $total_exp_needed,' class="form-control input-sm"');?>
                
                <label for="location">Salary [AED  ]</label>
               <?php echo form_dropdown('salary_id',  $salary_list, $salary_id,' class="form-control input-sm"');?>
                
                
                <label for="location">Job Type</label>
                
                <div class="radio">                 
                   <label><input type="radio" name="job_type_id" value="1" <?php if($job_type_id==1)echo 'checked';?>>Full Time</label>
                  
                </div>
               
                <div class="radio">
                 <label><input type="radio" name="job_type_id" value="2" <?php if($job_type_id==2)echo 'checked';?>>Part Time</label>
                </div>
                
                <div class="radio">
                  <label><input type="radio" name="job_type_id"  value="3" <?php if($job_type_id==3)echo 'checked';?>>Hourly Basis</label>
                </div>
           		 
                 <div class="radio">
                  <label><input type="radio" name="job_type_id"  value="4" <?php if($job_type_id==4)echo 'checked';?>>Contract Job</label>
                </div>

            	<div class="radio">
                  <label><input type="radio" name="job_type_id"  value="5" <?php if($job_type_id==5)echo 'checked';?>>Weekly Basis</label>
                </div>   
            	<div class="radio">
                 <label><input type="radio" name="job_type_id"  value="6" <?php if($job_type_id==6)echo 'checked';?>>Monthly Basis</label>
                </div>  
                
                <!--                                                             
                <br />
                  <div class="form-group">
                  <label for="usr">Skills</label>
                  <input type="text" name="skill_id" class="form-control" value="" placeholder="PHP, HTML, JAVA etc." id="skill_id">
                </div>
                -->
                      <button type="submit" onclick="" class="btn btn-primary pull-right btn-sm filtrbtn">Filter</button>         
              </div>
            
            </div>
     
</div>   
          
          
 	<!-- item1 -->         
<div class="col-md-8 col-lg-8 col-sm-12">
<div class="option-bar">
                    <div class="row">
                        <div class="col-lg-6 col-md-7 col-sm-7">
                            <div class="sorting-options2">
                                <span class="sort">Sort by:</span>
                       <select class="form-control input-sm" name="list_order" tabindex="-98">
                                    <option value="1">Newest First</option>
                                    <option value="2">Oldest First</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5 col-sm-5">
                            <div class="sorting-options">
                                <a href="#" class="change-view-btn active-view-btn"><i class="fa fa-th-list"></i></a>
                                <a href="#" class="change-view-btn"><i class="fa fa-th-large"></i></a>
                            </div>
                        </div>
                    </div>
                </div>    
    
    
     <?php 
				if(isset($jobs) && !empty($jobs))
				{
				 foreach($jobs as $job)
				 {
		  ?>
    
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
                           <li><i class="fa fa-industry"></i>   <?php if($job['job_cat_name']!='')echo $job['job_cat_name'];else echo 'NA' ?> </li>
						   
						   <li><i class="fa fa-suitcase"></i><?php if($job['func_area']!='')echo ','.$job['func_area'];?> 
                           
                           </li>
                           <li><i class="fas fa-map-marker-alt"></i> City: <?php if($job['city_name']!='')echo $job['city_name'];else echo 'NA'; ?> &nbsp;&nbsp;Nationality:
						   <?php if($job['country_name']!='')echo $job['country_name'];else echo 'ANY'; ?>  </li>
                           <li><i class="far fa-calendar-alt"></i>   <?php echo date("d-m-Y", strtotime($job['job_post_date'])); ?></li>
                        </ul>
                        <div class="job-type full-time">
                           <a  href="#" >Job ID: LOGIS-<?php echo $job['job_id']; ?></a>
                        </div>
                     </div>
                     <p> <?php echo $job['desired_profile']; ?></p>
                     <div class="job-skill">
                        <div class="shareicon">
                        
                  
                            <a class="facebook"  href="http://facebook.com/logisticsjobsandcareers" target="_blank"><i class="fab fa-facebook-f"></i></a>

                            

                                  <a class="res_div" href="http://linkedin.com/company/logisticsjobs" target="_blank" ><i class="fab fa-linkedin"></i></a> 

                            

                           <a class="twitter" href="https://wa.me/971503860610" target="_blank"><i class="fab fa-whatsapp"></i></a>

                           

                            <a class="dribbble" href="http://instagram.com/seekershr" target="blank"><i class="  fab fa-instagram"></i></a>
                   
                        </div>
                        <a href="<?php echo $this->config->base_url();?>index.php/home/job_details?job_id=<?php echo md5($job['job_id']); ?>"> View & Apply <i class="fas fa-angle-double-right"></i> </a>
                     </div>
                  </div>
    
     <?php } }else{ ?>
 
 <div class="job-item featured-item" >
                     
                     <div class="job-info yes-logo">
                        <h3>
                           <a href="#">No Records Found</a>
                        </h3>
                        
                        
                     </div>
                     
                     <p> Change your search parameters and try again.</p>
                     
    
                  </div>
    
     <?php } ?>
    
    
    <?php echo $pagination;?>
    

    
    
   </div>             
  	<!-- item1 -->    
          
            
    
</div>  
</div>  
</div>
</form>