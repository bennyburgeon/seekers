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

</div>
<div style="clear:both;"></div>
</div>


<div class="clearfix"><br>

    <p class="btn btn-success btn-xs"> <?php echo $registation_msg;?></p>
<br>
<br>

   
    
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
            <div class="col-sm-6">
            
              <div class="tab-head mar-spec"><h3>About</h3></div>
                <table width="95%" border="0" cellspacing="1" cellpadding="1" class="table table-bordered table-condensed">
                 
                  <tr>
                    <td>Name : </td>
                    <td><?php echo $detail_list['first_name'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Mobile : </td>
                    <td><?php echo $detail_list['mobile'];?></td>
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
                    <td>DoB :</td>
                    <td> <?php echo $detail_list['date_of_birth'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Marital Status:</td>
                    <td><?php if($detail_list['marital_status']==1) echo 'Married'; if($detail_list['marital_status']==2)echo 'Engaged';if($detail_list['marital_status']==3)echo 'Separated';if($detail_list['marital_status']==4)echo 'Divorced';if($detail_list['marital_status']==5)echo 'Widowed';if($detail_list['marital_status']==6)echo 'Never Married';?><br />
             </td>
                  </tr>
                 
                  <tr>
                    <td colspan="2">

                <?php if($detail_list['cv_file']!='' && file_exists($this->config->item('cv_upload_folder').$detail_list['cv_file'])){?>
                                
                <a href="<?php echo$this->config->item('cv_path').$detail_list['cv_file'];?>" target="_blank" class="btn btn-success btn-sm">Download CV</a> <a href="<?php echo site_url().'/candidates_all/delete_cv/'.$candidate_id.'/';?>" onClick="return confirm('Are you sure ? want to delete?');" class="btn btn-danger btn-sm">Delete CV</a> <?php } ?></td>
                  </tr>
                  
                  <tr><td colspan="2">
                  
                   <?php if($detail_list['photo']!='' && file_exists($this->config->item('photo_upload_folder').$detail_list['photo'])){?><span id="imgTab2"><img src="<?php echo $this->config->item('photo_path').$detail_list['photo'];?>" class="profile_img" style="width:158px;height:100px;"><br /><br /><a href="<?php echo site_url().'/candidates_all/delete_photo/';?>" style="color:#0033FF" onClick="return confirm('Are you sure ? want to delete?');">Delete Photo</a>&nbsp;&nbsp;</span> <?php } ?> 
                  
                  </td></tr>         
            </table>
          </div>

          <div class="col-sm-6">
      <div class="profile_box2" style="margin-top: 15px;">
            
            <h4>Planning for Job Change:</h4>

            
           
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
            
            <h4>Language Skill:</h4>

            
            <?php if(!empty($candidate_languages)){?>
                Languages Known :
                <?php
                $language='';
                foreach($candidate_languages as $key => $val)
                {
                    $language	=	$language.$val.',';
                }
                echo rtrim($language, ",");
                ?>
                


                <br />
            <?php }else{ ?>
            
            Languages Known  : Not Updated.<br />
            <?php } ?>
            <br />
            <a href="#" data-toggle="modal" class="btn btn-success btn-xs" data-target="#langModal">Update Lang. Skill</a>
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
                <th>Skills || <a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#skillModal">Tech. Skill</a> || <a href="#" data-toggle="modal" class="btn btn-success btn-xs" data-target="#certModal">Certifications | </a></th>
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

    </div>
    </div>
</div><!--- .row -->

   </td> 
  </tr> 

           <tr>
    	<td colspan="2" align="center" valign="middle"><div><a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#personalModal">Update Personal Details</a></div></td>
    </tr>
          
  <tr>
    <td colspan="2" align="left" valign="top">
		<form class="form-horizontal form-bordered"  method="post" id="form_upload_cv" name="form_upload_cv" action="<?php echo $this->config->site_url();?>/candidates_all/upload_cv_photo/" enctype="multipart/form-data"> 
			<input type="hidden" name="candidate_id" value="<?php echo $detail_list['first_name'];?>" />
			<table class="hori-form">
			
                <tbody>
                    <tr>
                        <td>Upload your CV</td>
                        <td><?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?> </td>
                    </tr>
                    
                    <tr>
                        <td>Upload your Photo</td>
                        <td><?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?> </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2"><span class="click-icons"><input type="submit" class="attach-subs" value="Upload" id="save_candidate2"  style="width:180px;"></span></td>
                    </tr>
                    
                 </tbody>
             </table>
        	
            <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id"></form>
        	<div id="success"></div>
        </form>
      </td>
    </tr>
    
    
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

    <tr>
    	<td colspan="2" align="center" valign="middle"><div><a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#primaryModal">Add Primary/Secondary Skills</a></div></td>
    </tr>
        

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
							<th>Specialisation</th>
							<th>Course Type</th>
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
                    <td><?php echo $val['spcl_name'];?></td>
                    <td><?php echo $val['course_type'];?></td>
                    <td><?php echo $val['edu_year'];?></td>
                    <td><?php echo $val['country_name'];?></td>                    
                     <td>
                     
                     <a href="<?php echo base_url().'index.php/candidates_all/delete_candidate_edu/?id='.$val['eucation_id'];?>" onClick="return confirm('Are you sure ? want to delete?');" class="btn btn-danger btn-xs">X</a> || 
                     
                     <a href="javascript:void();" data-url="<?php echo base_url().'index.php/candidates_all/loadEditEducationhtml/?edu_id='.$val['eucation_id'];?>" id="edit_edu" class="btn btn-info btn-xs">Edit</a>  
                     </td>
                     
         		 </tr>
  			     <?php } ?>
                </tbody>
		  	</table> 

     	</td>
    </tr>
    
<?php } ?>    

     <tr>
    	<td colspan="2" align="center" valign="middle"><div><a href="#" class="btn btn-success btn-xs" data-toggle="modal" data-target="#eduModal">Add Education</a></div></td>
    </tr>
	
<?php if(count($job_history)>0){?>
    
    <tr>
    	<td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Professional Summary</h3></div></td>
    </tr>
      
    <tr>        
        <td colspan="2" align="center" valign="top">
           <table width="100%" border="1" cellspacing="3" cellpadding="3" class="table table-bordered table-condensed">
         
                  <tr>
                    <td>Organization</td>
                    <td>Designation</td>
                    <td>Resp.</td>
                    <td>From</td>
                    <td>To</td>
                    <td>Industry</td>
                    <td>Fun. Area</td>
                    <td>Action</td>
                  </tr>
                 
                 
                  <?php foreach($job_history as $key => $val){?>
                  <tr>
                    <td><?php echo $val['organization'];?></td>
                    <td><?php echo $val['designation'];?></td>
                    <td><?php echo $val['responsibility'];?></td>
                    <td><?php echo $val['from_date'];?></td>
                    <td><?php if($val['present_job']==1){echo date('Y-m-d'); }else{ echo $val['to_date'];}?></td>
                    <td><?php echo $val['job_cat_name'];?></td>
                    <td><?php echo $val['func_area'];?></td>
                    <td>
                    
                    <a href="<?php echo base_url().'index.php/candidates_all/delete_candidate_prof/?id='.$val['job_profile_id'];?>" onClick="return confirm('Are you sure ? want to delete?');" class="btn btn-danger btn-xs">X</a> ||           
                    
                    <!-- 
                    <a href="javascript:void();" data-url="<?php echo base_url().'index.php/candidates_all/loadEditJobhtml/?job_profile_id='.$val['job_profile_id'];?>&candidate_id=<?php echo $candidate_id;?>" id="edit_job_profile" class="btn btn-info btn-xs">Edit</a>  
					--> 
                       <a href="<?php echo base_url().'index.php/candidates_all/summary/?edit_job=1&job_profile_id='.$val['job_profile_id'];?>" id="edit_job_profile_url" class="btn btn-info btn-xs">Edit Profession</a>  
                                           
                    
                    </td>
                    
                  </tr>
             <?php } ?>
           </table>  
        </td>
    </tr>
	<?php } ?>
 
      <tr>
    	<td colspan="2" align="center" valign="middle">
        <div>
        <?php if($edit_job_html!=''){?>
        <a href="#" class="btn btn-success btn-xs" id="edit_mode_profession" >Update Profession</a>
		<?php }else{?>
        <a href="#" class="btn btn-success btn-xs" id="add_job_link" data-toggle="modal11" data-target="#jobModal">Add Profession</a>
        <?php } ?>
        </div></td>
    </tr>
    

    <!----------------Present Contract Details---------------------------->

 	<!-----------------End Contract Details---------------------->	

   
    

<!-----------------------------END SUGGESTED JOBS------------------>

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
        </tbody>
        </table>
    
    
      </td>
    </tr>
<?php } ?>
<!--END APPLIED JOBS-->

<!--START SHORTLISTED JOBS-->
<?php if(!empty($shortlisted)){ ?>
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>Jobs Shortlisetd</h3></div></td></tr>
    
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
          <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>-->
              
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
      <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>-->
          
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
      <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>-->
          
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

<!--START USER AREA-->
    <tr><td colspan="2" align="center" valign="top"><div class="tab-head mar-spec"><h3>All Messages</h3></div> </td></tr>
	<tr><td colspan="2" align="center" valign="top" class="borderTopNone">
						 <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
						<thead>
							<tr>
							<td colspan="6">List of Messages</td>

							</tr>
                           </thead>
                           <tbody>
        
  <td align="left" valign="top">
      
   	 <table width="100%" border="1" cellspacing="1" cellpadding="0" class="table table-bordered table-condensed">

            <?php foreach($all_messages as $key_msg => $main_message){?>
            <tr>
            <td width="20%">
			<?php echo $main_message['message_date'];?>
            </td>
            <td><?php echo $main_message['message_text'];?>
            
            <br>
			<?php if($main_message['admin_id']>0){ ?>
           <span class="btn btn-success btn-xs disabled"><?php echo $main_message['recruiter']; ?></span>			
			<?php }else{ ?>
            <span class="btn btn-primary btn-xs disabled">Its Me..</span>
            <?php } ?>
            
            </td>
            </tr>
            <?php } ?>
            
    </table>


  </td>
  </tr>
  
 <!--USER AREA END-->
</table>


<!-----------------------MANAGE EMAIL---------------------->

<div class="notes">
<ul>
<li id="tab_2btn">Send Message</li>
</ul>

   
	<!--Followup-->

    <div class="table-tech specs note">

    <div class="new_notes">
   
    <p id="result"></p>
    <p id="deletemessage"></p>

    <?php echo $error;?>
    
    <p id="success"></p>
    <p id="emails"></p>
    <p id="emaildelete"></p>
 
    <form action="<?php echo $this->config->site_url();?>/candidates_all/manage_email/<?php echo $candidate_id;?>" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onsubmit="return email_validate();" >  
 
    <input type="hidden" value="<?php echo $candidate_id;?>" name="candidate_id" id="candidate_id">
    <h3>Message</h3>
    <textarea name="email_text" cols="" rows="" class="text_area" id="email_text"></textarea> 
    
     <span class="click-icons"><br />

    <input type="submit" style="width:250px;" name="sub3" id="sub3" class="attach-subs" value="Send Message to Recruiter">
    
    </span>
    </form>
    </div>
   
    <div style="clear:both;"></div>
    </div>



    	

<!---------------------------END EMAIL------------------------------------->



<div style="clear:both;"></div>

<div class="notes" id="add_job_history">
     
        <ul>
          <li>Job History</li>            
     	 </ul>
       
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
    <?php if($edit_job_html!=''){?>
    
	<?php echo $edit_job_html;?>
        
    <?php }else{?>
               <form class="form-horizontal form-bordered"  method="post" id="job_form" name="add_job_frm" action="<?php echo $this->config->site_url();?>/candidates_all/add_job_history/"> 
	<table class="hori-form">
			<tbody>

               <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                <tr>
                    <td>Organization Name</td>
                    <td><input class="form-control hori" type="text" name="organization" value="" id="add_organization"></td>
                </tr>
               
                <tr>
                    <td>Designation</td>
                    <td><input class="form-control hori " type="text" name="designation" value="" id="designation"></td>
                </tr>
                
                <tr>
                    <td>Industry</td>
                     <td> <?php echo form_dropdown('job_cat_id',  $industries_list, '','class="form-control" id="job_cat_id"');?> </td>
                </tr>
                
                
                <tr>
                    <td>Function/Role</td>
                     <td> <?php echo form_dropdown('func_id',  $functional_list, '','class="form-control" id="func_id"');?> </td>
                </tr>                
                
                <tr>
                    <td>Responsibilities</td>
                    <td>
                    <?php echo $this->ckeditor->editor('responsibility');?>
                    </td>
                </tr>

                
                <tr>
                    <td>Is this your present job ?</td>
                    <td> 
                         <label class="radio-inline">
                        <input type="radio" name="present_job" id="present_job" value="1">Yes</label>
                        <label class="radio-inline">
                        <input type="radio" name="present_job" id="present_job" value="0" checked>No</label>                                
                     </td>
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
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="submit" class="attach-subs" value="Add Job" id="save_job_history" style="width:180px;">
                    </span>
                    </td>
                </tr>
                
          </tbody>
     </table>
        
        </form>
    <?php }?>
        
    </div>
        <!--Followup-->
          
      </div>
    </div>
    
</div>

</div>
</div>
</div>
</section>



<!--BEGIN PERSONAL MODAL-->

<div class="modal fade" id="personalModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
           
                </div>
            
    <div class="notes">
       	<ul>
          <li>Personal</li>            
     	 </ul>
       
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
    
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/candidates_all/update_candidate_profile/"> 
               
               
               <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
               
               
                    <table class="hori-form">
                   
                    <tbody>
                    
                    <tr>
                    <td>Candidate Name</td>
                     <td>  <input style="width:300px;" placeholder="First Name"  type="text"  name="first_name" value="<?php echo $formdata['first_name']?>" id="first_name"> </td>
                    </tr>

                    <tr>
                    <td>Candidate Last Name</td>
                     <td>  <input style="width:300px;" placeholder="Last Name"  type="text"  name="last_name" value="<?php echo $formdata['last_name']?>" id="last_name"> </td>
                    </tr>
                    <tr>

                    <tr>
                    <td>Mobile</td>
                     <td>  <input style="width:300px;" placeholder="Last Name"  type="text"  name="mobile" value="<?php echo $formdata['mobile']?>" id="last_name"> </td>
                    </tr>
                    <tr>
                                        
                    <td>Age</td>
                     <td><input style="width:50px;" placeholder="Age"  type="text"  name="age" value="<?php echo $formdata['age']?>" id="age"></td>
                    </tr>
                    <tr>
                    <td>Gender</td>
                     <td><?php 
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
                     <td><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" class="datepicker"
                                            value="<?php echo $formdata['date_of_birth'];?>" placeholder="DoB"></td>
                    </tr>
                    <tr>
                    <td>Marital Status</td>
                     <td>        <?php 
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
                                            echo form_radio($data).'Never Married';
                                            ?> </td>
                    </tr>

                    <tr>
                    <td>Current CTC</td>
                     <td><input style="width:100px;" placeholder="CTC"  type="text"  name="current_ctc" value="<?php if(isset($job_search['current_ctc'])) echo $job_search['current_ctc']?>" id="current_ctc"></td>
                    </tr>
                   
                    <tr>
                    <td>Expected CTC</td>
                     <td><input style="width:100px;" placeholder="Exp. CTC"  type="text"  name="expected_ctc" value="<?php if(isset($job_search['expected_ctc'])) echo $job_search['expected_ctc']?>" id="expected_ctc"></td>
                    </tr>
                    
                    <tr>
                    <td>Notice Peiord</td>
                     <td><input style="width:100px;" placeholder="Notice"  type="text"  name="notice_period" value="<?php if(isset($job_search['notice_period'])) echo $job_search['notice_period']?>" id="notice_period"></td>
                    </tr>
                    
                    <tr>
                    <td>Total Experience</td>
                     <td><input style="width:100px;" placeholder="Total Exp"  type="text"  name="total_experience" value="<?php if(isset($job_search['total_experience'])) echo $job_search['total_experience']?>" id="total_experience"></td>
                    </tr>

                    <tr>
                    <td>Passport Number</td>
                     <td> <input style="width:200px;" placeholder="Passport No."  type="text"  name="passportno" value="<?php echo $formdata['passportno']?>" id="repeat"> </td>
                    </tr>

                    <tr>
                    <td>Nationality</td>
                     <td><?php echo form_dropdown('nationality',  $nationality_list,'','class="form-control" id="visa_type_id"');?></td>
                    </tr>

                    <tr>
                    <td>Current Location</td>
                     <td><?php echo form_dropdown('current_location',  $current_location_list,'','class="form-control" id="visa_type_id"');?></td>
                    </tr>

                                        
                    <tr>
                    <td>Visa Type</td>
                     <td><?php echo form_dropdown('visa_type_id',  $visa_type_list,'','class="form-control" id="visa_type_id"');?></td>
                    </tr>
                                        
                    <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="submit" class="attach-subs" value="Update Profile" id="save_profile" style="width:180px;">
                    </span>
                    </td>
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

<!--BEGIN EDUCATION MODAL-->

<div class="modal fade" id="eduModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
           
                </div>
            
    <div class="notes">
       	<ul>
          <li>Education</li>            
     	 </ul>
       
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/candidates_all/edu_history_2/<?php echo $candidate_id;?>" onSubmit="return candidate_validate();"> 
                <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
                    <table class="hori-form">
                   
                    <tbody>
                    
                    <tr>
                    <td>Level of Study</td>
                     <td> <?php echo form_dropdown('level_id',  $edu_level_list,'','class="form-control" id="level_id"');?> </td>
                    </tr>
                    <tr>
                    <td>Course</td>
                     <td> <?php echo form_dropdown('course_id',  $edu_course_list, '','class="form-control" id="course_id"');?> </td>
                    </tr>
                    <tr>
                    <td>Specialization</td>
                     <td> <?php echo form_dropdown('spcl_id',  $edu_spec_list, '','class="form-control" id="spcl_id"');?> </td>
                    </tr>
                    <tr>
                    <td>University</td>
                     <td> <?php echo form_dropdown('univ_id',  $edu_univ_list,'','class="form-control" id="univ_id"');?> </td>
                    </tr>
                    <tr>
                    <td>Year</td>
                     <td> <?php echo form_dropdown('edu_year',  $edu_years_list, '','class="form-control" id="edu_year"');?> </td>
                    </tr>
                    <tr>
                    <td>Country</td>
                     <td><?php echo form_dropdown('edu_country',  $country_list, '','class="form-control" id="edu_country"');?> </td>
                    </tr>
                    <tr>
                    <td>Course Type</td>
                     <td> <?php echo form_dropdown('course_type_id',  $edu_course_type_list, '','class="form-control" id="course_type_id"');?> </td>
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
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;">
                    </span>
                    </td>
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
        <div class="col-md-15">
           
                </div>
            
    <div class="notes">
       	<ul>

          <li>Job History</li>            
     	 </ul>
       
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
                
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/candidates_all/job_history_2/<?php echo $candidate_id;?>" onSubmit="return job_validate();" > 
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
                     <td> <?php echo form_dropdown('job_cat_id',  $industries_list, '','class="form-control" id="job_cat_id"');?> </td>
                </tr>
                
                <tr>
                    <td>Function/Role</td>
                     <td> <?php echo form_dropdown('func_id',  $functional_list, '','class="form-control" id="func_id"');?> </td>
                </tr>                
                
                <tr>
                    <td>Responsibilities</td>
                    <td><input class="form-control hori " type="text" name="responsibility" value="" id="responsibility"></td>
                </tr>
                
                <tr>
                    <td>From Date</td>
                    <td><input type="text" name="from_date" id="datepickfrom" value="" placeholder="YYYY-MM-DD"></td>
                </tr>
                
                <tr>
                    <td>To Date</td>
                    <td><input type="text" name="to_date" id="datepickto" value="" placeholder="YYYY-MM-DD"></td>
                </tr>
                
                <tr>
                    <td>Is this your present job ?</td>
                    <td> 
                         <label class="radio-inline">
                        <input type="radio" name="present_job" id="present_job" value="1">Yes</label>
                        <label class="radio-inline">
                        <input type="radio" name="present_job" id="present_job" value="0">No</label>                                
                     </td>
				</tr>
                
               
                                              
                <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="submit" class="attach-subs" value="Save" id="save_candidate4" style="width:180px;">
                    </span>
                    </td>
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
        <div class="col-md-15">
           
                </div>
            
        <div class="notes">
            <ul>
              <li>Lang.Skill</li>            
             </ul>
            <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
                
               <form class="form-horizontal form-bordered"  method="post" id="candidate_validate" name="candidate_validate" action="<?php echo $this->config->site_url();?>/candidates_all/lang_history_2/<?php echo $candidate_id;?>">
                
                <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>" />
                
                <table class="hori-form">
                    <tbody>
                    
                        
                        <tr>
                            <td>Languages Known</td>
                            <td>
                            <?php foreach($lang_list as $lang){ ?>
                                <label style="font-weight:normal"><input <?php   if (in_array($lang['lang_id'], $candidate_language)){ ?> checked="checked" <?php  } ?>  type="checkbox" name="lang[]"  value="<?php echo $lang['lang_id'];?>" />&nbsp;<?php echo $lang['lang_name'];?></label>&nbsp;&nbsp;&nbsp;
                                

                            <?php } ?>
                            </td>
                        </tr>                    
                    
                        <tr>
                            <td colspan="2">
                            <span class="click-icons">
                            <input type="submit" class="attach-subs" value="Update" id="edit_candidate2" style="width:180px;">
                            </span>
                            </td>
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



<div class="modal fade" id="skillModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
           
                </div>
            
    <div class="notess">
       	<ul>
          <li class="active">Tech.Skill</li>            
     	 </ul>
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
<form class="form-horizontal form-bordered"  method="post" id="form_update_tech_skill" name="form_update_tech_skill" action="<?php echo $this->config->site_url();?>/candidates_all/skills_2/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

    <table class="hori-form">
    <tbody>
        <tr>
        	<td>Technical Skills</td>
            <td>
                 <select class="js-example-basic-multiple-cert" name="skills[]" multiple="multiple" id="multiple_skill" style="width:300px;;"> 
                <option value="">Select Skill</option>
                    <?php foreach($all_child_skills as $skill){?>
                    <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                    <?php }?>
                </select>
            </td>
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
            <td colspan="2">
            <span class="click-icons">
            <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
            </span>
            </td>
    	</tr>
        
     </tbody>
  	</table>
    <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id"></div>
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
        <div class="col-md-15">
           
                </div>
            
    <div class="notess">
       	<ul>
          <li class="active">CERTIFICATIONS</li>            
     	 </ul>
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
<form class="form-horizontal form-bordered"  method="post" id="cert_form" name="cert_form" action="<?php echo $this->config->site_url();?>/candidates_all/add_certification/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

    <table class="hori-form">
    <tbody>
        <tr>
        	<td>Certifications</td>
            <td>
                 <select class="js-example-basic-multiple-cert" name="cert[]" multiple="multiple" id="multiple_cert" style="width:300px;;"> 
                <option value="">Select Certificate</option>
                    <?php foreach($cerifications as $cert){?>
                    <option <?php   if (in_array($cert['cert_id'], $candidate_certifications_id)){ ?> selected="selected" <?php  } ?>  value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
                    <?php }?>
                </select>
            </td>
        </tr>
      

        
   		<tr>
            <td colspan="2">
            <span class="click-icons">
            <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
            </span>
            </td>
    	</tr>
        
     </tbody>
  	</table>
    <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
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


<!------------------END FOLLOWUP MODAL----------------------------------------------------->
<!--BEGIN CATEGORY AND FUNCTIONAL MODAL----------------------------------------------------->

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
        <div class="col-md-15">
           
                </div>
            
    <div class="notess">
       	<ul>
          <li class="active">Technical Skills Primary,Secondary</li>            
     	 </ul>
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
                
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/candidates_all/editSkills/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

    <table class="hori-form">
    <tbody>
         <tr>
                </tr>
                <tr>
                    <td>Technical Skills Primary</td>
                    <td> 
                    <select class="js-example-basic-multiple-cert" name="skills_primary[]" multiple="multiple" id="multiple_skill" style="width:400px;">
                    
                    <?php foreach($all_child_skills as $skill){?>
                    <option <?php   if (in_array($skill['skill_id'], $candidate_skills_primary)){ ?> selected="selected" <?php  } ?>  
                    value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                    <?php }?>
                    </select>
                    </td>

                </tr>
                <tr>
                    <td>Technical Skills Secondary</td>
                    <td> 
                    <select class="js-example-basic-multiple-cert" name="skills_secondary[]" multiple="multiple" id="multiple_skill" style="width:400px;">
                    
                    <?php foreach($all_child_skills as $skill){?>
                    <option <?php   if (in_array($skill['skill_id'], $candidate_skills_secondary)){ ?> selected="selected" <?php  } ?>  
                    value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                    <?php }?>
                    </select>
                    </td>

                </tr>
        
   		<tr>
            <td colspan="2">
            <span class="click-icons">
            <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
            </span>
            </td>
    	</tr>
        
     </tbody>
  	</table>
    <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id"></div>
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
        <div class="col-md-15">
           
                </div>
            
    
    </div>
  </div>
</div>

<!------------------------ end modal2------------------------------->

<div style="clear:both;"></div>
</div>
</div>

<!-- start here -->

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
 <div class="new_notes" id="data_holder">
     
            
        </div>
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
 <div class="new_notes" id="job_data_holder">
     
            
        </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</div>


<!--  Add Profession from here  -->


<!--  Add Profession - end here  -->


<!-- end her e--> 

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script language="javascript">

function myFunction()
{
	  var parent =$('#parent').val();
	 if(parent!='')
	 {
		  $.ajax({
		  type: "get",
		  async: true,
		  url: "<?php echo site_url('manage_data/child_skill'); ?>",
		  data: {'id':parent},
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
		/*
		if($('#designation').val()=='')
		{
			alert('Enter Designation');
			$('#designation').focus();
			return false;
		}
		if($('#datepickfrom').val()=='')
		{
			alert('Add from date');
			$('#datepickfrom').focus();
			return false;
		}   
		if($('#datepickto').val()=='')
		{
			alert('Add to date');
			$('#datepickto').focus();
			return false;
		}
		if($('#monthly_salary').val()=='')
		{
			alert('Add monthly salary');
			$('#monthly_salary').focus();
			return false;
		}   
		if($('#skills').val()=='')
		{
			alert('Add your skills');
			$('#course_type_id').focus();
			return false;
		}
		*/
	    return true;
    }
<!--SCRIPT FOR JOB MODAL END-->

<!--SCRIPT FOR EDUCATION MODAL BEGIN-->
   function candidate_validate() 
   {
/*		if($('#level_id').val()==0)
		{
			alert('Select Level');
			$('#level_id').focus();
			return false;
		}   
*/		if($('#course_id').val()==0)
		{
			alert('Select course');
			$('#course_id').focus();
			return false;
		}
/*		if($('#spcl_id').val()==0)
		{
			alert('Select specialization');
			$('#spcl_id').focus();
			return false;
		}   
		if($('#univ_id').val()==0)
		{
			alert('Select University');
			$('#univ_id').focus();
			return false;
		}
		if($('#edu_year').val()==0)
		{
			alert('Select year');
			$('#edu_year').focus();
			return false;
		}   

		if($('#course_type_id').val()==0)
		{
			alert('Select Course type');
			$('#course_type_id').focus();
			return false;
		}
*/	    return true;
    }
	
// level study course filtering 

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
	
	//onchange of job_category

	$('#multiple_category').change(function() 
	{
	
		jQuery('#func_role_id').html('');
		jQuery('#func_role_id').append('<option value="">Select Function</option');
			
		if($('#multiple_category').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_all/getfunction_multiple/',
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
		yearRange: "c-50:c+1"
		});
		
	$('#datepickto').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		yearRange: "c-50:c+1"
		});
	
	$('#start_date').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
		
		});

	$('#flp_date_reminder').datepicker({
			dateFormat: "yy-mm-dd"
		});
		
	$('#end_date').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,
	
		});
		
	$('#datepicker1').datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange: "c-50:c+1"
	
		});
		
	$('#datepicker2').datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			myearRange: "c-50:c+1"
	
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
	
</script>