<?php echo $this->load->view('common/tiny-mce'); ?>
<body class="withvernav">
<div class="bodywrapper">
    
    
         <?php $this->view('common/top_menu'); ?>
    
    <!--topheader-->
    
    
    <!--header-->
    
    <?php $this->view('common/left_menu'); ?><!--leftmenu-->
    
    <!-- Form start from here -->
      <?php echo form_open_multipart('candidates_all/add', 'class="stdform"','id="frmcandidate"');?>	
    <div class="centercontent">
    
        <div class="pageheader">
            <h1 class="pagetitle">Add Candidate</h1>
            <div> <?php echo validation_errors();	?></div>
        </div><!--pageheader-->
        
        <!-- tab1 ----> 
            
            <div class="contenttitle2">
                    	<h3>Sample Tab</h3>
            </div>
            
            
            
        <div id="tabs" class="ui-tabs ui-widget ui-widget-content ui-corner-all">
        
                    <ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
                        <li class="ui-state-default ui-corner-top ui-tabs-selected ui-state-active"><a href="#tabs-1">Personal Details</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-2">Education</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-3">Employments</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-4">Skills</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-5">Projects</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-6">Profe. Cert.</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-7">Social Media</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-8">Awards</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-9">Groups</a></li> 
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-10">Activities</a></li>
                        <li class="ui-state-default ui-corner-top"><a href="#tabs-11">My CVs</a></li>
                    </ul>
                            <div id="tabs-1" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
                            <div id="contentwrapper" class="contentwrapper">
        <div id="validation" class="subcontent">
            	
                  

                    <p>
                        <label for="page_title">Title</label>
                        <span class="field">
                        
                  <?php 
				   $options = array(
                  '1'  => 'Mr.',
                  '2'    => 'Mrs');
				   echo form_dropdown('title', $options, $formdata['title']);
				  ?>                       
                     </span>
                    </p>
                    
                    <p>
                        <label for="page_title">First Name</label>
                        <span class="field"> <?php echo form_input(array('name'=>'first_name', 'class' => 'smallinput','value'=>$formdata['first_name']));?></span>
                    </p>
                                        
					<p>
                	<label>Last Name</label>
                        <span class="field">
                        <?php echo form_input(array('name'=>'last_name', 'class' => 'smallinput','value'=>$formdata['last_name']));?></span>
                	</p>

                	<label>Gender</label>
                        <span class="field">                        
                        <?php 
						
						$data = array(
						'name'        => 'gender',
						'id'          => 'gender',
						'value'       => '1',
						'checked'     => $formdata['gender'] == '1' ? 'TRUE' : 'FALSE',
						'style'       => 'margin:10px',
						);
						echo form_radio($data).'Male';
						$data = array(
							'name'        => 'gender',
							'id'          => 'gender',
							'value'       => '0',
							'checked'     => $formdata['gender'] == '0' ? 'TRUE' : 'FALSE',
							'style'       => 'margin:10px',
							);
						echo form_radio($data).'Female';
					?>						
                        </span>
                	</p>
                    
                	<label>Marital Status</label>
                        <span class="field">
						  <?php 
                           $options = array(
                          '1'  => 'Married',
                          '2'    => 'Single');
                           echo form_dropdown('marital_status', $options, $formdata['marital_status']);
                          ?>                       
                       </span>
                	</p>                    

                	<label>Date of Birth</label>
                        <span class="field">
                        <?php echo form_input(array('name'=>'date_of_birth','id' => 'datepicker','class'=>'width100', 'value'=>$formdata['date_of_birth']));?>
                     </span>
                	</p>
                    
                    <p>
                        <label for="page_title">Email</label>
                        <span class="field"> <?php echo form_input(array('name'=>'email', 'class' => 'smallinput','value'=>$formdata['email']));?></span>
                    </p>

                    <p>
                        <label for="page_title">Mobile Phone</label>
                        <span class="field">+<?php echo form_input(array('name'=>'mobile_prefix','class'=>'width100', 'value'=>$formdata['mobile_prefix']));?> - <?php echo form_input(array('name'=>'mobile', 'class' => 'width100','value'=>$formdata['mobile']));?></span>
                    </p>
                    
                    <p>
                        <label for="page_title">Land Phone</label>
                        <span class="field">+<?php echo form_input(array('name'=>'land_prefix','class'=>'width100', 'value'=>$formdata['land_prefix']));?> -<?php echo form_input(array('name'=>'land_phone', 'class' => 'width100','value'=>$formdata['land_phone']));?></span>
                    </p>                                        

                    <p>
                        <label for="page_title">Work Phone</label>
                        <span class="field">+<?php echo form_input(array('name'=>'work_prefix','class'=>'width100', 'value'=>$formdata['work_prefix']));?> -<?php echo form_input(array('name'=>'workphone', 'class' => 'width100','value'=>$formdata['workphone']));?></span>
                    </p>   
					
                    <p>
                        <label for="page_title">Fax</label>
                        <span class="field">+<?php echo form_input(array('name'=>'fax_prefix','class'=>'width100', 'value'=>$formdata['fax_prefix']));?> -<?php echo form_input(array('name'=>'fax', 'class' => 'width100','value'=>$formdata['fax']));?></span>
                    </p>   
					
                    <p>
                        <label for="page_title">Contact Address</label>
                        <span class="field"> <?php echo form_input(array('name'=>'address', 'class' => 'smallinput','value'=>$formdata['address']));?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Zip Code</label>
                        <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                    </p>

                    <p>
                        <label for="page_title">Religion</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  

                    <p>
                        <label for="page_title">Total Experience</label>
                        <span class="field"><?php echo form_dropdown('years', $years_list, $formdata['years']);?> &nbsp;<?php echo form_dropdown('months', $months_list, $formdata['months']);?></span>
                    </p>  
                          

                    <p>
                        <label for="page_title">Current Salary</label>
                        <span class="field"><?php echo form_input(array('name'=>'monthly_salary','class'=>'width100', 'value'=>$formdata['monthly_salary']));?> -<?php echo form_dropdown('currency_id', $currency_list, $formdata['currency_id']);?></span>
                    </p>  

                    <p>
                        <label for="page_title">Referred By</label>
                        <span class="field"><?php echo form_dropdown('ref_id', $ref_list, $formdata['ref_id']);?></span>
                    </p>  
                                                             
                    <p>
                        <label for="page_title">Nationality</label>
                        <span class="field"><?php echo form_dropdown('nationality', $country_list, $formdata['nationality']);?></span>
                    </p>  
                                        
                    <p>
                        <label for="page_title">Current Location</label>
                        <span class="field"><?php echo form_dropdown('current_location', $country_list, $formdata['current_location']);?></span>
                    </p> 

                    <p>
                        <label for="page_title">State</label>
                        <span class="field" id="statedrop">
                        <select name="state">
	                        <option value="">Select State</option>
                        </select>
                        </span>
                    </p>

                     <p>
                        <label for="page_title">City</label>
                        <span class="field" id="citydrop">
						<select name="city">
		                    <option value="">Select City</option>
                        </select>						                        
                        </span>
                    </p>

                    <p>
                        <label for="page_title">Username</label>
                        <span class="field"> <?php echo form_input(array('name'=>'username', 'class' => 'smallinput','value'=>$formdata['username']));?></span>
                    </p>                      
                    
                    <p>
                        <label for="page_title">Password</label>
                        <span class="field"> <?php echo form_input(array('name'=>'password', 'class' => 'smallinput','value'=>$formdata['password']));?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Driving License</label>
                        <span class="field"> <?php echo form_input(array('name'=>'driving_license', 'class' => 'smallinput','value'=>$formdata['driving_license']));?></span>
                    </p>  

 				<p>
                    <label>Upload Photo</label>
                    <span class="field"><?php echo form_upload(array('name'=>'photo','class'=>'smallinput', 'value'=>$formdata['photo']));?></span>
                </p>
                                                                     


            </div><!--subcontent-->


        
        
        </div>

                            </div>
                            <div id="tabs-2" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                    <p>
                        <label for="page_title">Level of Study</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>

                    <p>
                        <label for="page_title">Course</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Specialization</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">University</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Year</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Country</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Course Type</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>                                                                                                      

                    </div>
                    
                    <div id="tabs-3" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                    
                    <p>
                        <label for="page_title">Organization Name</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>

                    <p>
                        <label for="page_title">Designation</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Industry</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Function/Role</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Responsibilities</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">From Date</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">To Date</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p> 

                    <p>
                        <label for="page_title">Salary</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p> 

                    <p>
                        <label for="page_title">Is this your present job ?</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>                    
                    </div>

             <div id="tabs-4" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                    <p>
                        <label for="page_title">Skill Name</label>
                        <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                    </p>

                    <p>
                        <label for="page_title">Last Used</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>
                    <p>
                        <label for="page_title">Experience Year</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>
                    <p>
                        <label for="page_title">Experience - Month</label>
                        <span class="field"><?php echo form_dropdown('religion_id', $religion_list, $formdata['religion_id']);?></span>
                    </p>                     
             </div>
                            
                            <div id="tabs-5" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">

                            <p>
                                <label for="page_title">Client</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>

                            <p>
                                <label for="page_title">Start Date</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>

                            <p>
                                <label for="page_title">To Date</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>

                            <p>
                                <label for="page_title">Title</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>

                            <p>
                                <label for="page_title">Location</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Site - On or off site Name</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Nature of employment Name - temporary, permanant</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Details of project</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Role in this project</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Designation in this project</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Team Size - drop down</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Skill used in this project</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                        	</div>

                            <div id="tabs-6" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                            <p>
                                <label for="page_title">Organization - can be masters</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>

                            <p>
                                <label for="page_title">Skill Name</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>

                            <p>
                                <label for="page_title">Cert. Name</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Rank or Percentage</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Issued Date</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Valid Till</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            
                            <p>
                                <label for="page_title">Description</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>

                        	</div>

                            <div id="tabs-7" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                            <p>
                                <label for="page_title">Social Media - can be master</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Public Profile</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Public Name</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                    <p>
                        <label for="page_title">Google + </label>
                        <span class="field"> <?php echo form_input(array('name'=>'googleplus', 'class' => 'smallinput','value'=>$formdata['googleplus']));?></span>
                    </p>
                    
                    <p>
                        <label for="page_title">Twitter</label>
                        <span class="field"> <?php echo form_input(array('name'=>'twitter', 'class' => 'smallinput','value'=>$formdata['twitter']));?></span>
                    </p>  
                    
                    <p>
                        <label for="page_title">Facebook</label>
                        <span class="field"> <?php echo form_input(array('name'=>'facebook', 'class' => 'smallinput','value'=>$formdata['facebook']));?></span>
                    </p>
                                                              
                    <p>
                        <label for="page_title">Linkedinn Profile</label>
                        <span class="field"> <?php echo form_input(array('name'=>'linkedin', 'class' => 'smallinput','value'=>$formdata['linkedin']));?></span>
                    </p>                                 
                        	</div>

                            <div id="tabs-8" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                              <p>
                                <label for="page_title">Award Title</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Date</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Desc</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
            
                        	</div>

                            <div id="tabs-9" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                                 <p>
                                <label for="page_title">Grouop Name</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Link</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                            <p>
                                <label for="page_title">Group Description</label>
                                <span class="field"><?php echo form_input(array('name'=>'zipcode', 'class' => 'width100','value'=>$formdata['zipcode']));?></span>
                            </p>
                    
                        	</div>
                            <div id="tabs-10" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                                <div class="widgetbox">
                            <div class="title"><h3>Recent Activity</h3></div>
                            <div class="widgetcontent">
                                <ul class="recent_list">
                                    <li class="user new">
                                        <div class="msg">
                                            <a href="#">Justin Meller</a> added <a href="#">John Doe</a> as Admin.
                                        </div>
                                    </li>
                                    <li class="call new">
                                        <div class="msg">
                                            You missed a call from <a href="#">Porfirio</a>
                                        </div>
                                    </li>
                                    <li class="calendar new">
                                        <div class="msg">
                                            <a href="#">Katherine Kate</a> invited you in an event <a href="#">Rock Party</a>.
                                        </div>
                                    </li>
                                    <li class="settings">
                                        <div class="msg">
                                            <a href="#">Jane Doe</a> updated her profile.
                                        </div>
                                    </li>
                                    <li class="user">
                                        <div class="msg">
                                            <a href="#">Jet Lee</a> is now following you.
                                        </div>
                                    </li>
                                </ul>
                                <div class="msgmore"><a href="#">View All Activities</a></div>
                            </div><!--widgetcontent-->
                        </div> 
                        	</div>
                            <div id="tabs-11" class="ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide">
                               <div class="widgetbox">
                            <div class="title"><h3>Recent Activity</h3></div>
                            <div class="widgetcontent">
                                <ul class="recent_list">
                                    <li class="user new">
                                        <div class="msg">
                                            <a href="#">Justin Meller</a> added <a href="#">John Doe</a> as Admin.
                                        </div>
                                    </li>
                                    <li class="call new">
                                        <div class="msg">
                                            You missed a call from <a href="#">Porfirio</a>
                                        </div>
                                    </li>
                                    <li class="calendar new">
                                        <div class="msg">
                                            <a href="#">Katherine Kate</a> invited you in an event <a href="#">Rock Party</a>.
                                        </div>
                                    </li>
                                    <li class="settings">
                                        <div class="msg">
                                            <a href="#">Jane Doe</a> updated her profile.
                                        </div>
                                    </li>
                                    <li class="user">
                                        <div class="msg">
                                            <a href="#">Jet Lee</a> is now following you.
                                        </div>
                                    </li>
                                </ul>
                                <div class="msgmore"><a href="#">View All Activities</a></div>
                            </div><!--widgetcontent-->
                        </div>
                        	</div>
                            
		
        </div>
                            <p class="stdformbutton">
                        <?php echo form_submit(array('name'=>'addrec','value'=>'Add') );?>
                    </p>
                 
        <!-- tab ends here -->
        
         <?php echo form_close();?>
        
        <!--contentwrapper-->
	</div>
    
    <!-- form ends here-->
    
    <!-- centercontent -->
</div><!--bodywrapper-->
