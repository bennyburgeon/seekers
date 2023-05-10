
<form id="register_form" action="<?php echo site_url('signup/save_registration'); ?>"  class="formular" name="register_form" method="post" enctype="multipart/form-data">

<input type="hidden" name="job_id" value="<?php echo $job_id?>">

  <input type="hidden" name="lead_source"  id="lead_source" value="2">  
    <input type="hidden" name="cur_job_status" value="3">
    
     <input type="hidden" name="passportno" value="">
     
      <input type="hidden" name="passportno" value="">
      <input type="hidden" name="passport_type" value="">
      <input type="hidden" name="issued_date" value="">
      <input type="hidden" name="expiry_date" value="">
      <input type="hidden" name="place_of_issue" value="">
 	  <input type="hidden" name="passport_nationality" value="">
      
      <input type="hidden" name="visa_nationality" value="">
      <input type="hidden" name="visa_start_date" value="">
      <input type="hidden" name="visa_end_date" value="">
      
      <input type="hidden" name="marital_status" value="0">
      
        <input type="hidden" name="visa_type_id" value="0">
        
         <input type="hidden" name="release_noc" value="0">
         
      
    <input type="hidden" name="lead_source"  id="lead_source" value="2">  
<div class="joblisting">
      <div class="container"> 
      <div class="row">
     
          
          
 
          
          
 	<!-- item1 -->         
<div class="col-md-8 col-lg-8 col-sm-12 mx-auto">
 
    

    <div class="panel panel-success filterstyle registerfrm ">
              <div class="panel-headingsd"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i> Register Now</strong></div>
              <br>
              
              <div class="panel-body">
              <div class="panel panel-info">
  <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Create Your Account</div>
  <div class="panel-body">
  
 <label for="sel1"><span style="color:#3500B9;"> <strong>Create Your Account:</strong> </span><span style="color:#DC0074;">*</span></label> 
  
                            <input type="text" name="username" value="" class="form-control input-sm" placeholder="Your Email ( Username )" id="username">
                            
							<a href="javascript:;" id="check_email" onclick="return check_email();">Check Availabiltiy</a>&nbsp;&nbsp;&nbsp;<span id="check_msg"></span>

							<br>
                            <br>

                              <div class="form-group">
                            <input type="password" class="form-control input-sm" name="password" placeholder="Create Password" id="password"><br>
                            <input type="password" class="form-control input-sm" name="c_password" placeholder="Confirm Password" id="c_password"><br>
                            </div>
                            
                            
                                                    <div class="panel panel-info">
                         <div class="panel-heading">
                         <i class="fa fa-id-card-o" aria-hidden="true"></i> Personal Details:<span style="color:#DC0074;">*</span>
                         </div>
                        <div class="panel-body">
                        
                        </div>
                        </div>
                      
                      
                      

                            <label for="sel1"><span style="color:#3500B9;"> <strong>Title: </strong></span></label> 
                                                         
                            <label class="radio-inline"><input type="radio" value="1" id="p_title" name="title" checked="">Mr.</label>
							<label class="radio-inline"><input type="radio" value="2" id="p_title" name="title">Ms.</label>
                            <label class="radio-inline"><input type="radio" value="3" id="p_title" name="title">Mrs.</label>
                            
                            <br>
                            
  							<input type="text" name="first_name" value="" class="form-control input-sm" placeholder="Your Full Name" id="first_name"><br>
    

                                                        
                            <div class="form-group">
                            
                            <!-- 
                             <input type="text" class="form-control input-sm" maxlength="2" name="age" placeholder="Age" id="age"><br>
							-->
                            
                            <input type="text" class="form-control input-sm" name="date_of_birth"  placeholder="yyyy-mm-dd" id="date_of_birth"><br>
                                                       
                            </div> 
                                                       
                            <label for="sel1"><span style="color:#3500B9;"> <strong>Gender: </strong></span></label>
                            
                            <label class="radio-inline"><input type="radio" value="1" id="gender_male" name="gender" checked="">Male</label>
							<label class="radio-inline"><input type="radio" value="2" id="gender_female" name="gender">Female</label><br>
                            
                          
      					<div class="form-group">
                          <label for="sel1"><span style="color:#3500B9;"> <strong>Nationality: </strong></span></label> <?php echo form_dropdown('nationality',  $nationality_list, '','data-placeholder="Filter by status" class="form-control input-sm"');?></div>
                        
                        <div class="form-group">
                           <label for="sel1"><span style="color:#3500B9;"> <strong>Country of Residence: </strong></span><span style="color:#DC0074;">*</span></label><?php echo form_dropdown('country_id',  $country_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="country_id"');?>
                           <label for="sel1"><span style="color:#3500B9;"> <strong>State: </strong></span> <span style="color:#DC0074;">*</span></label> <?php echo form_dropdown('state_id',  $state_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="state_id"');?>
                          <label for="sel1"><span style="color:#3500B9;"> <strong> City: </strong></span></label><?php echo form_dropdown('city_id',  $city_list, '','data-placeholder="Filter by status" class="form-control input-sm" id="city_id"');?>
                        </div>    

                       
                                                   
                            </div>
                            </div>


                                      
                        
                        <div class="panel panel-info">
                         <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Contact Details <span style="color:#DC0074;">*</span></div>
                        <div class="panel-body">
                        	
                     <div class="form-group">
                          
                          <label for="sel1"><span style="color:#3500B9;"> <strong>Mobile No. ( with WhatsApp ):</strong></span> <span style="color:#DC0074;">*</span></label> 
                           <div class="row">
                             
           <div class="col-sm-2">
           <input type="text" name="mobile_prefix" class="form-control input-sm" placeholder="Country Code" maxlength="5" value="+971" id="mobile_prefix">
          </div>
          
          <div class="col-sm-2">
                     
                     <select class="form-control input-sm" name="mobile_prefix_code" id="mobile_prefix_code">
                    
                     <option value="" selected>----</option>
                     <option value="50" selected>50</option>
                     <option value="55">55</option>
                     <option value="52">52</option>
                     <option value="54">54</option>
                     <option value="58">58</option>
                     <option value="56">56</option>
                     </select>
          </div>
                         <div class="col-sm-6"> 
                         
                      
                         
                         
                         <input type="text" name="mobile" class="form-control input-sm" placeholder="Mobile No. 1 ( with WhatsApp )" maxlength="9" id="mobile">( For eg. +971 501234567 )</div>
                         </div>
                          <label for="sel1"><span style="color:#3500B9;"> <strong>Alternative Mobile No.:</strong></span> </label>
                         
                           <div class="row">
                          <div class="col-sm-2">
                          
                          
                          
                           <input type="text" name="mobile_prefix1" class="form-control input-sm" placeholder="Country Code" value="+971" maxlength="5" id="mobile_prefix1"> 
                           </div>
                           
                           
          
                            <div class="col-sm-6"> 
                           <input type="text" name="mobile1" class="form-control input-sm" placeholder="Mobile No. 2" maxlength="20" id="mobile1">
                           ( For eg. +971 501234567 )
                          </div>
                          </div>
                        
                           <label for="sel1"><span style="color:#3500B9;"> <strong>Alternative E Mail ID ( Other than user ID ):</strong></span></label>
                          <input type="text" name="alternate_email" class="form-control input-sm" placeholder="Alternative E Mail ID" maxlength="200" id="alternate_email">
                          
                          
                        </div>
 
						</div>
                        
                            </div>
                            
                         
                            
                        <div class="panel panel-info">
                         <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Employment Details </div>
                        <div class="panel-body">
                        	
                            <div class="form-group">
                             
                          <label for="sel1"><span style="color:#3500B9;"> <strong>Total Years of Experience [Years.]:</strong></span></label><br>
                 <input type="text" name="total_experience" class="form-control input-sm" placeholder="Total Experience" maxlength="2" id="total_experience">
       						
                           
                        </div>
 
                         <div class="form-group">

                        <label for="sel1"> <span style="color:#3500B9;"> <strong>Current Company:( If employed currently )</strong></span></label>     <br>
 <input type="text" name="organization" class="form-control input-sm" placeholder="Current Employer" maxlength="200" id="organization">                       
                        
                        </div>
                          
						</div>
                        
                       <div class="form-group">
                          <label for="sel1"><span style="color:#3500B9;"> <strong>Target / Current Industry:</strong></span>  </label>
                          
                          <?php echo form_dropdown('job_cat_id',  $industry_list, '',' id="job_cat_id" data-placeholder="Filter by status" class="form-control input-sm"');?>                                                   
                            </div>
                            

                       <div class="form-group">
                          <label for="sel1"><span style="color:#3500B9;"> <strong>Functional Area:</strong></span> </label>
                          
                          <?php echo form_dropdown('func_id',  $func_list, '',' id="func_id" data-placeholder="Filter by status" class="form-control input-sm"');?>                                                   
                            </div>
                            
                       <div class="form-group">
                          <label for="sel1"><span style="color:#3500B9;"> <strong>Current Designation:</strong></span> </label>
                          
                          <?php echo form_dropdown('desig_id',  $desig_list, '',' id="desig_id" data-placeholder="Filter by status" class="form-control input-sm"');?>                                                   
                            </div>
                           
                           
                              <div class="form-group">               <label for="sel1"><span style="color:#3500B9;"> <strong>Expected Salary in AED:</strong></span>  </label><br>
                            
<div class="col-sm-6">
                   <input type="text" class="form-control input-sm" placeholder="Expected Salary " name="expected_ctc" id="expected_ctc">
                        </div>
                         
                         </div>   
                             

                              <div class="form-group">               
                              <label for="sel1"> <span style="color:#3500B9;"> <strong>Linkedin Profile ( URL ):</strong></span></label><br>
                            
						<div class="panelbody">
                     <input type="text" class="form-control input-sm" placeholder="Linkedin Profile" name="linkedin_url" id="linkedin_url">
                        </div>
                         
                         </div>  
                                                      
                             
                             
                                                        
                            </div>	
                        
                        <div class="form-group">               
                        <label for="sel1"><span style="color:#3500B9;"> <strong>Current job staus:</strong></span> </label><br>

						 <?php echo form_dropdown('cur_job_status',  $cur_job_status_list, '',' id="cur_job_status" data-placeholder="Filter by status" class="form-control input-sm"');?>
						
				</div>
                
                          <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          <label for="sel1"><span style="color:#3500B9;"> <strong>CV:</strong></span> </label>
                        </div></div>
                            <div class="col-sm-6" style="overflow:hidden;"> 
                            <?php echo form_upload(array('name'=>'cv_file','class'=>'class="btn btn-primary pull-right btn-sm"'));?>                        
                        </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-6"> <div class="form-group">
                          
                          <label for="sel1"><span style="color:#3500B9;"> <strong>Upload  Photo: </strong></span></label>
                        </div></div>
                            <div class="col-sm-6" style="overflow:hidden;"> 
                         <?php echo form_upload(array('name'=>'photo','class'=>'class="btn btn-primary"'));?>                        </div>
                            </div>
                          
   <button type="button" id="submit_signup_form" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Register </strong></button>
                 
              </div>
            </div>
    
   </div>             
  	<!-- item1 -->    
    
</div>  </div>  </div>
</form>
 