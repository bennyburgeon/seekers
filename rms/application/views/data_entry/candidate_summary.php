<style>

.selector span:after {
   content: ' ';
    clear: right;
    display: block;
}

</style>
<style>
.notess
{
width:95%;
min-height:400px;
border: 1px solid #aeaeae;
margin-top: 20px;
text-align: left;
color: #606162;
font-size: 13px;
}
.notess ul
{
width:95%;
margin:0;
padding:0;
list-style:none;	
}
.notess li:first-child
{
float:left;
border-bottom: 2px solid #439ffa;	
font-family:"Novecentowide-Medium";
width:143px;
text-align:center;
color: #606162;
font-size:14px;
line-height:50px;
margin-left:2px;
cursor:pointer;
}

#multiple_skill ul{
    box-sizing: border-box;
    list-style: outside none none;
    margin: 0;
    padding: 0 5px;
    width: 95%;	
	
}

#multiple_skill li{
	width:auto!important;
	line-height:27px!important;
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 px;	
	
}
.select2-search--inline,.select2-selection__choice{
	width:auto!important;
	line-height:27px!important;
	font-family:inherit!important;
	font-size:inherit!important;
	font-weight:normal!important;
	
}
.notess li.active:first-child 
{
background-color:#30d57d;
color: #FFFFFF;
}
.notess li:nth-child(1)
{
margin-left:0%;
}


li.test
{ 
display:inline; 
width: auto;
  float: left;
  padding:5px;
}       
</style>
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>

 
<div class="row">
<div class="col-md-12">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
<div class="profile_top_right"><br />
<a href="<?php echo $this->config->site_url();?>/data_entry" >Back</a></span></td>&nbsp;&nbsp;|
<a href="<?php echo base_url();?>index.php/data_entry/candidate_delete/<?php echo md5($detail_list['candidate_id']);?>">Delete this profile</a>	&nbsp;&nbsp;&nbsp;
</div>
<div style="clear:both;"></div>
</div>


<div style="border:solid;height:auto;">

<table width="95%" border="0" cellspacing="3" cellpadding="3">

          <tr>
            <td colspan="2" align="left" valign="top"><br />
        <?php echo $msg;?><br /></td>
          </tr>
          
          <tr>
            <td align="left" valign="top" width="50%">
            <div class="profile_box2">
            
            <table width="95%" border="0" cellspacing="1" cellpadding="1">
                  
                  <tr>
                    <td  bgcolor="#CCCCCC"><h4>About:</h4></td>
                    <td  bgcolor="#CCCCCC">&nbsp;</td>
                  </tr>
                 
                  <tr>
                    <td>Name : </td>
                    <td bgcolor="#CCCCCC"><?php echo $detail_list['first_name'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Mobile : </td>
                    <td bgcolor="#CCCCCC"><?php echo $detail_list['mobile'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Address : </td>
                    <td bgcolor="#CCCCCC"><?php echo $detail_list['address'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Username : </td>
                    <td bgcolor="#CCCCCC"><?php echo $detail_list['username'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Email :</td>
                    <td bgcolor="#CCCCCC"><?php echo $detail_list['username'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Age : </td>
                    <td bgcolor="#CCCCCC"><?php echo $detail_list['age'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Gender :</td>
                    <td bgcolor="#CCCCCC"><?php if($detail_list['gender']==1) echo 'Male'; if($detail_list['gender']==0)echo 'Female';?></td>
                  </tr>
                 
                  <tr>
                    <td>Registered On : </td>
                    <td bgcolor="#CCCCCC"><?php echo $detail_list['reg_date'];?></td>
                  </tr>
                  
                  <tr>
                    <td>DoB :</td>
                    <td bgcolor="#CCCCCC"> <?php echo $detail_list['date_of_birth'];?></td>
                  </tr>
                  
                  <tr>
                    <td>Interested Program: </td>
                    <td bgcolor="#CCCCCC"><?php echo $detail_list['course_name'];?></td>
                  </tr>
                 
                  <tr>
                    <td>Marital Status:</td>
                    <td bgcolor="#CCCCCC"><?php if($detail_list['marital_status']==1) echo 'Married'; if($detail_list['marital_status']==2)echo 'Engaged';if($detail_list['marital_status']==3)echo 'Separated';if($detail_list['marital_status']==4)echo 'Divorced';if($detail_list['marital_status']==5)echo 'Widowed';if($detail_list['marital_status']==6)echo 'Never Married';?><br />
                Number of Children: <?php echo $detail_list['children'];?></td>
                  </tr>
                 
                  <tr>
                    <td>Lead Source: </td>
                    <td bgcolor="#CCCCCC"> <?php echo $detail_list['lead_source'];?></td>
                  </tr>
                 
                  <tr>
                    <td colspan="2"><br />
                <br />
                                <a href="<?php echo base_url().'index.php/data_entry/print_cv/'.$candidate_id;?>" target="_blank" style="color:#0033FF">Print CV</a>
                <?php if($detail_list['cv_file']!=''){?> &nbsp;||&nbsp;<a href="<?php echo base_url().'uploads/cvs/'.$detail_list['cv_file'];?>" target="_blank" style="color:#0033FF">Download CV</a> &nbsp;||&nbsp;<a href="<?php echo site_url().'/candidates/delete_cv/'.$candidate_id.'/';?>" style="color:#0033FF">Delete CV</a> <?php } ?> </td>
                  </tr>
                  
                  <tr><td colspan="2">
                  
                   <?php if($detail_list['photo']!=''){?><span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$detail_list['photo'];?>" class="profile_img" style="width:158px;height:100px;"><br /><br /><a href="<?php echo site_url().'/candidates/delete_photo/'.$candidate_id.'/';?>" style="color:#0033FF">Delete Photo</a>&nbsp;&nbsp;</span> <?php } ?> 
                  
                  </td></tr>
                  
                  <tr><td>&nbsp;</td></tr>
                  <tr>
                      <td colspan="2">
                            <ul>
                                <li class="test"><a href="#" data-toggle="modal" data-target="#eduModal">Education</a></li>
                                <li class="test"><a href="#" data-toggle="modal" data-target="#jobModal">Job History</a></li> 
                                <li class="test"><a href="#" data-toggle="modal" data-target="#langModal">Lang. Skill</a></li>        
                                <li class="test"><a href="#" data-toggle="modal" data-target="#skillModal">Tech. Skill</a></li>
                                 <li class="test"><a href="#" data-toggle="modal" data-target="#primaryModal">Skills Primary,Secondary</a></li>
                                 <li class="test"><a href="#" data-toggle="modal" data-target="#certModal">Certifications</a></li>
                                <li class="test"><a href="#" data-toggle="modal" data-target="#catModal">Designation</a></li>
                                <li class="test"><img src="<?php echo base_url(); ?>assets/images/icon-5.png"/>&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#contractModal">Present Contract Details</a></li>        
                               <li class="test"><img src="<?php echo base_url(); ?>assets/images/icon-8.png"/>&nbsp;&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#followupModal">Follow Up</a></li>
                            </ul>
                        
                      </td>
                  </tr>
          
            </table>
          </div>
         </td>
    <td align="left" valign="top"><div class="profile_box2">
            
            <h4>Planning for Job Change:</h4>

            
            <?php if(isset($job_search['job_date']) && $job_search['job_date']!=0){?>
                When you are planning to search for a new job? : <?php echo $job_search['job_date'];?><br />
            <?php }else{ ?>
                When you are planning to search for a new job? : Not Updated.<br />
            
            <?php } ?>
            
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
            
            <?php if(isset($job_search['immediate_join']) && $job_search['immediate_join']!=''){?>
               Are you ready for an immediate joining ? : <?php if($job_search['immediate_join']==1){ echo 'Yes';}else if($job_search['immediate_join']==0){ echo 'No';}?><br />
            <?php }else{ ?>
            
            Are you ready for an immediate joining ?  : Not Updated.<br />
            <?php } ?>
            <br />
            <h4>Language Skill:</h4>

            
            <?php if(!empty($lang_details) && $lang_details[0]['eng_10th']!=''){?>
                Eng. 10th : <?php echo $lang_details[0]['eng_10th'];?><br />
            <?php }else{ ?>
                Eng. 10th : Not Updated.<br />
            
            <?php } ?>
            
            <?php if(!empty($lang_details) && $lang_details[0]['eng_12th']!=''){?>
                Eng. 12th : <?php echo $lang_details[0]['eng_12th'];?><br />
            <?php }else{ ?>
            
            Eng. 12th : Not Updated.<br />
            <?php } ?>
            
             <?php if(!empty($lang_details) && $lang_details[0]['eng_grad']!=''){?>
                Eng. Graduation : <?php echo $lang_details[0]['eng_grad'];?><br />
            <?php }else{ ?>
            
            Eng. Graduation  : Not Updated.<br />
            <?php } ?>
             <?php if(!empty($lang_details) && $lang_details[0]['eng_post_grad']!=''){?>
                Eng. Post Graduation : <?php echo $lang_details[0]['eng_post_grad'];?><br />
            <?php }else{ ?>
            
            Eng. Post Graduation  : Not Updated.<br />
            <?php } ?>
            
            <?php if(!empty($candidate_languages)){?>
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
            <?php } ?>
            <br />
<br />

<table width="95%" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td>
    	<table width="95%" border="0" cellspacing="1" cellpadding="1">
            <tr>
            	<td  bgcolor="#CCCCCC"><strong>Skills</strong></td>
            </tr>
            <?php foreach($candidate_skill as $key => $val){?>
            <tr>
           		<td><?php echo $val['skill_name'];?></td>
            </tr>
            <?php } ?>
 
		</table>
    </td>
    
    <td align="left" valign="top">
    	<table width="95%" border="0" cellspacing="1" cellpadding="1">
            <tr>
                <td  bgcolor="#CCCCCC"><strong>Certifications</strong></td>
            </tr>
             <?php foreach($candidate_certifications as $key => $val){?>
             <tr>
                 <td><?php echo $val['cert_name'];?></td>
             </tr>
  	
            <?php } ?>
    	</table>
   	</td>
    
        <td align="left" valign="top">
    	<table width="95%" border="0" cellspacing="1" cellpadding="1">
            <tr>
            	<td  bgcolor="#CCCCCC"><strong>Domain Knowledge</strong></td>
            </tr>
            <?php foreach($candidate_domain as $key => $val){?>
            <tr>
           		<td><?php echo $val['domain_name'];?></td>
            </tr>
            <?php } ?>
 
		</table>
   	</td>
  </tr>
      <!--<td>
    	<table width="95%" border="0" cellspacing="1" cellpadding="1">
            <tr>
            	<td  bgcolor="#CCCCCC"><strong>Domain Knowledge</strong></td>
            </tr>
            <?php foreach($candidate_skill as $key => $val){?>
            <tr>
           		<td><?php echo $val['skill_name'];?></td>
            </tr>
            <?php } ?>
 
		</table>
    </td>-->
    
    
  </tr>
</table>


</br>
 
    </div>
    </br>
   </td> 
  </tr>
      
  <tr>
    <td colspan="2" align="left" valign="top">
		<form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/data_entry/upload_cv_photo/<?php echo $detail_list['candidate_id'];?>" enctype="multipart/form-data"> 
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
        	
            <input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id">
        	<div id="success"></div>
        </form>
      </td>
    </tr>



<!--START Contract details and Language-->
    <tr>
    	<td>&nbsp;</td>
    </tr>
    <?php if(count($category_name)>0){?>
    	<tr>
    	<td colspan="2" align="center" valign="top"><br />Designation</td>
  	   </tr>
    
       <tr>
    	<td colspan="2" align="center" valign="top"> 
    
            <table width="95%" border="1" cellspacing="3" cellpadding="3">
                <tr>
    	
                    <td bgcolor="#CCCCCC">Category </td>
                     <td bgcolor="#CCCCCC">Function/Role</td>
                                       
                 </tr> 
                 
                  <?php $orderids = array(0); $k=0;$i=0;  foreach($category_name as $category){ $flag = 0;?>
               
               
                  <?php if(!in_array( $category['job_cat_id'],$orderids)){ array_push($orderids, $category['job_cat_id']); $flag = 1; $k++; ?>
                  
                 	<td><?php echo $category['job_cat_name'];?></td>
                 	<td class="selector">
                         <?php foreach($function_name as $function){?>  
                         	                  
                   				<?php $i++; if($category['job_cat_id']==$function['job_cat_id']) echo "<span>" .$function['func_area'] . "</span>";?>
                  		 <?php }?>
                     </td> 
					
               <?php if($flag) echo '</tr>'; ?>
                  
               <?php } }?>
                 
              
		  	</table> 
     	</td>
    </tr>
	<?php } ?>
    
    
  <!--START Technical skilla primary nad secondary-->

   <?php if(count($skills_primary)>0){?>
    <tr>
        <td colspan="2" align="center" valign="top"> <br />Technical Skills Primary,Secondary</td>
    </tr>
    
    <tr>
        <td align="right" valign="top"><br>        
        
            <table width="95%" border="1" cellspacing="1" cellpadding="1">
            
                <tr>
                	<td colspan="2" bgcolor="#CCCCCC">Primary Skills</td>    
                </tr>
                
                <?php foreach($skills_primary as $primary){ ?>
                
                <tr>
               	 <td><?php echo $primary['skill_name'];?></td>
                </tr>            
            
            <?php } ?>
            
            </table>
        
        
        <br>
        <br>
        </td>
        
        
        <td align="right" valign="top"><br>
        
        
        <table width="95%" border="1" cellspacing="1" cellpadding="1">
        
        <tr>
        <td colspan="2" bgcolor="#CCCCCC">Secondary Skills</td>    
        </tr>
        
        
        <?php foreach($skills_secondary as $secondary){ ?>
        
        <tr>
        <td><?php echo $secondary['skill_name'];?></td>
        </tr>            
        
        <?php } ?>
        </table>
        
        
        </td>
    </tr>
    <?php }?>
    
        
 
    
      
	
<!-------------------------Education Details------------------------>	


<tr id="candidate_education1"></tr>
<tr id="candidate_education2"></tr>


<!--END Education Details -->
	     

  <?php /*?> <tr>
    	<td colspan="2" align="center" valign="top"><br />Education </td>
   </tr>
  
   <tr>
    	<td colspan="2" align="center" valign="top"> 
    
            <table width="95%" border="1" cellspacing="3" cellpadding="3">
                  <tr>
                    <td bgcolor="#CCCCCC">Level of study</td>
                    <td bgcolor="#CCCCCC">Course</td>
                    <td bgcolor="#CCCCCC">Arrears</td>
                    <td bgcolor="#CCCCCC">Absense</td>
                    <td bgcolor="#CCCCCC">Repeat</td>
                    <td bgcolor="#CCCCCC">Year Back</td>
                    <td bgcolor="#CCCCCC">Percenage</td>
                  </tr>
         	 	 
				 <?php foreach($education_details as $key => $val){?>
                  <tr>
                    <td><?php echo $val['level_name'];?></td>
                    <td><?php echo $val['course_name'];?></td>
                    <td><?php echo $val['arrears'];?></td>
                    <td><?php echo $val['absesnse'];?></td>
                    <td><?php echo $val['repeat'];?></td>
                    <td><?php echo $val['year_back'];?></td>
                    <td><?php echo $val['mark_percentage'];?></td>
         		 </tr>
  			     <?php } ?>
		  	</table> 
     	</td>
    </tr>
	
<?php */?>



<!--------------------PROFESSIONAL SUMMARy----------------------->

	<tr id="candidate_professional1"></tr>
	<tr id="candidate_professional2"></tr>

 <!-----------------End PROFESSIONAL SUMMARy---------------------->	
	
	<?php /*?><?php if(count($job_history)>0){?>
    
    <tr>
    	<td colspan="2" align="center" valign="top"><br />Professional Summary</td>
    </tr>
      
    <tr>        
        <td colspan="2" align="center" valign="top">
            <table width="95%" border="1" cellspacing="3" cellpadding="3">
         
                  <tr>
                    <td bgcolor="#CCCCCC">Organization</td>
                    <td bgcolor="#CCCCCC">Designation</td>
                    <td bgcolor="#CCCCCC">Resp.</td>
                    <td bgcolor="#CCCCCC">From</td>
                    <td bgcolor="#CCCCCC">To</td>
                    <td bgcolor="#CCCCCC">Salary</td>
                    <td bgcolor="#CCCCCC">Job Industry</td>
                    <td bgcolor="#CCCCCC">Job Category</td>
                    <td bgcolor="#CCCCCC">Fun. Area</td>
                  </tr>
                 
                 
                  <?php foreach($job_history as $key => $val){?>
                  <tr>
                    <td><?php echo $val['organization'];?></td>
                    <td><?php echo $val['designation'];?></td>
                    <td><?php echo $val['responsibility'];?></td>
                    <td><?php echo $val['from_date'];?></td>
                    <td><?php if($val['present_job']==1){echo date('Y-m-d'); }else{ echo $val['to_date'];}?></td>
                    <td><?php echo $val['monthly_salary'];?></td>
                    <td><?php echo $val['job_cat_name'];?></td>
                    <td><?php echo $val['job_cat_name'];?></td>
                    <td><?php echo $val['func_area'];?></td>
                  </tr>
             <?php } ?>
           </table>  
        </td>
    </tr>
	<?php } ?><?php */?>
 
<!--------------------------START PROGRAM----------------------->
	<?php if(count($candidate_programs_summary)>0){?>
    
	<tr>
        <td colspan="2" align="center" valign="top"><br />
         Programs Selected   </td>
    </tr>

    <tr>
        <td colspan="2" align="center" valign="top">
        	<table width="95%" border="1" cellspacing="3" cellpadding="3">
                  <tr>
                    <td colspan="4" bgcolor="#CCCCCC">Program Details</td>
                    <td bgcolor="#CCCCCC">Campus</td>
                    <td bgcolor="#CCCCCC">University</td>
                    <td bgcolor="#CCCCCC">Level</td>
                    <td bgcolor="#CCCCCC">Course</td>
                  </tr>
                  <?php foreach($candidate_programs_summary as $key => $val){?>
                  <tr>
                    <td colspan="4"><?php echo $val['app_details'];?></td>
                    <td><?php echo $val['campus_name'];?></td>
                    <td><?php echo $val['univ_name'];?></td>
                    <td><?php echo $val['level_name'];?></td>
                    <td><?php echo $val['course_name'];?></td>
                  </tr>
     			 <?php } ?>
    		</table>  
        </td>
    </tr>

	<?php } ?>
    
    
    <!----------------Present Contract Details---------------------------->
    
    <tr id="candidate_contract1"></tr>
	<tr id="candidate_contract2"></tr>

 <!-----------------End Contract Details---------------------->	
	

	<?php /*?><?php if(count($contract)>0){?>
    
    <tr>
    	<td colspan="2" align="center" valign="top"><br />Present Contract Details</td>
    </tr>
      
    <tr>        
        <td colspan="2" align="center" valign="top">
            <table width="95%" border="1" cellspacing="3" cellpadding="3">
         
                  <tr>
                    <td bgcolor="#CCCCCC">Start Date</td>
                    <td bgcolor="#CCCCCC">End Date</td>
                    <td bgcolor="#CCCCCC">Total Months</td>
                    <td bgcolor="#CCCCCC">Total Experience</td>
                                       
                  </tr>
                 
                 
                 
                  <tr>
                    <td><?php echo $contract['start_date'];?></td>
                    <td><?php echo $contract['end_date'];?></td>
                    <td><?php echo $contract['total_months'];?></td>
                    <td><?php echo $contract['total_exp'];?></td>                    
                   
                  </tr>
          
           </table>  
        </td>
    </tr>
	<?php } ?><?php */?>
    
   
   <!----------------Followup Details---------------------------->
    
    <tr id="candidate_followup1"></tr>
	<tr id="candidate_followup2"></tr>

 <!-----------------End Follow up details---------------------->	
	
   
    
    
<!------------------------------START SUGGESTED JOBS------------------------>
    <tr>
        <td colspan="2" align="center" valign="top"><br>
         Suggested Jobs  </td></tr>
    
    <tr>
   		 <td colspan="2" align="center" valign="top">    
    
            <table border="1" cellpadding="3" cellspacing="3" width="95%">
             	 <tbody>
                        <tr>
                        <td  bgcolor="#CCCCCC">Jobs</td>
                        <td bgcolor="#CCCCCC">Job Posted On </td>
                        <td bgcolor="#CCCCCC">Expire On</td>
                        <td bgcolor="#CCCCCC">Action</td>
                        </tr>
                        <?php foreach($suggested_jobs as $job){?>
                        <tr>
                        <td width="30%"><a href="#"><?php echo $job['job_title'];?> </a></td>
                        <td width="30%"> <?php  echo $job['job_post_date'];?> </td>
                        <td width="25%"><?php  echo $job['job_expiry_date'];?> </td>          
                        <td width="15%"><?php if($job['applied']==1) { echo "Applied"; }else{?> <a href="<?php echo $this->config->site_url();?>/data_entry/apply_job/<?php echo $candidate_id;?>/<?php  echo $job['job_id'];?>" title="Click here to apply job."> Apply </a><?php } ?></td>
                        
                        </tr>
                 		 <?php  } ?>
                </tbody>
           </table>
      </td>
    </tr>

<!-----------------------------END SUGGESTED JOBS------------------>


	<?php if(count($candidate_coe_summary)>0){?>
        
    <tr>
        <td colspan="2" align="center" valign="top"><br />
          Certificate of Enrolment    </td>
    </tr>
    
    <tr>
         <td colspan="2" align="center" valign="top">
               <table width="95%" border="1" cellspacing="3" cellpadding="3">
                  <tr>
                    <td bgcolor="#CCCCCC">Program</td>
                    <td bgcolor="#CCCCCC">Course Code</td>
                    <td bgcolor="#CCCCCC">University</td>
                    <td bgcolor="#CCCCCC">Orientation date</td>
                    <td bgcolor="#CCCCCC">Start date</td>
                <td bgcolor="#CCCCCC">End date</td>
                
                  </tr>
                  <?php foreach($candidate_coe_summary as $key => $val){?>
                  <tr>
                    <td><?php echo $val['app_details'];?></td>
                    <td><?php echo $val['course_code'];?></td>
                    <td><?php echo $val['univ_name'];?></td>
                    <td><?php echo $val['orientation_date'];?></td>
                    <td><?php echo $val['start_date'];?></td>
                    <td><?php echo $val['end_date'];?></td>
                  </tr>
                  <?php } ?>
        	 </table>  
         </td>
     </tr>
     <?php } ?>


	<?php if(count($candidate_visa_summary)>0){?>
        
    <tr>
        <td colspan="2" align="center" valign="top"><br />
          Details of VISA    </td></tr>
    
    <tr>
        <td colspan="2" align="center" valign="top">
                <table width="95%" border="1" cellspacing="3" cellpadding="3">
                      <tr>
                        <td colspan="4" bgcolor="#CCCCCC">Program Details</td>
                        <td bgcolor="#CCCCCC">Date</td>
                        <td bgcolor="#CCCCCC">Travel Date</td>
                        <td bgcolor="#CCCCCC">Joining Date</td>
                        <td bgcolor="#CCCCCC">Details</td>
                      </tr>
                      <?php foreach($candidate_visa_summary as $key => $val){?>
                      <tr>
                        <td colspan="4"><?php echo $val['app_details'];?></td>
                        <td><?php echo $val['visa_apprv_date'];?></td>
                        <td><?php echo $val['travel_date'];?></td>
                        <td><?php echo $val['date_of_join'];?></td>
                        <td><?php echo $val['comments'];?></td>
                      </tr>
                      <?php } ?>
            	</table> 
         </td>
     </tr>
    
    <?php } ?>
      
    

	<?php if(count($candidate_files_summary)>0){?>
    
    <tr>
        <td colspan="2" align="center" valign="top"><br />
          Updated Files    </td></tr>    
    
    <tr>
        <td colspan="2" align="center" valign="top">
            <table width="95%" border="1" cellspacing="3" cellpadding="3">
                  <tr>
                    <td colspan="8" bgcolor="#CCCCCC">File Name</td>
                  </tr>
                  <?php foreach($candidate_files_summary as $key => $val){?>
                  <tr>
                    <td colspan="8"><?php echo $val['file_name'];?></td>
                  </tr>
                  <?php } ?>
        	</table>  
        </td>
    </tr>
    
    <?php } ?>


	<?php if(count($candidate_complaints_summary)>0){?>
    
    <tr>
        <td colspan="2" align="center" valign="top"><br />
          Queries    </td></tr>    
    
    <tr>
        <td colspan="2" align="center" valign="top">
                <table width="95%" border="1" cellspacing="3" cellpadding="3">
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
            </table>  
        </td>
     </tr>
    
    <?php } ?>
                        

      

  <!--START APPLIED JOBS-->
  <?php if(!empty($applied_jobs)){ ?>
<tr>
    <td colspan="2" align="center" valign="top"><br>
      Jobs Applied </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody>
      	 <tr>
    		<td  bgcolor="#CCCCCC">Jobs</td>
    		<td bgcolor="#CCCCCC">Applied On</td>
 		 </tr>
        <?php foreach($applied_jobs as $job){?>
        <tr>
          <td width="44%"><a href="#"><?php echo $job['job_title'];?></a></td>
          <td width="31%"><?php  echo $job['applied_on'];?></td>          
      <!--    <td width="25%"> <a href="<?php // echo base_url(); ?>index.php/jobs/shortlist/<?php //echo $formdata['job_id'];?>/?app_id=<?php //echo $candidate['job_app_id'];?>"> Short List </a> | <a href="<?php //echo base_url(); ?>index.php/jobs/reovecandidate/<?php // echo $candidate['job_app_id'];?>/?app_id=<?php //echo $formdata['job_id'];?>&candidate_id=<?php //echo $candidate['candidate_id'];?>">Delete Application</a></td>-->
          
          </tr>
         
                                    <?php  } ?>
        </tbody></table>
    
    
    
      </td>
    </tr>
<?php } ?>
<!--END APPLIED JOBS-->

<!--START SHORTLISTED JOBS-->
<?php if(!empty($shortlisted)){ ?>
<tr>
    <td colspan="2" align="center" valign="top"><br>
      Jobs Shortlisetd </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody>
      	 <tr>
    		<td  bgcolor="#CCCCCC">Jobs</td>
    		<td bgcolor="#CCCCCC">Shortlisted On</td>
 		 </tr>
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
<tr>
    <td colspan="2" align="center" valign="top"><br>
      Interviews Scheduled </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody>
      	 <tr>
    		<td  bgcolor="#CCCCCC">Jobs</td>
    		<td bgcolor="#CCCCCC">Interview Date</td>
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
<tr>
    <td colspan="2" align="center" valign="top"><br>
      Jobs Selected </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody>
      	 <tr>
    		<td  bgcolor="#CCCCCC">Jobs</td>
    		<td bgcolor="#CCCCCC">Selected Date</td>
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
<tr>
    <td colspan="2" align="center" valign="top"><br>
      Offer Letters Issued Jobs  </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody>
      	 <tr>
    		<td  bgcolor="#CCCCCC">Jobs</td>
    		<td bgcolor="#CCCCCC">Issued Date</td>
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
<tr>
    <td colspan="2" align="center" valign="top"><br>
      Offer Accepted and Joined  Jobs  </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody>
      	 <tr>
    		<td  bgcolor="#CCCCCC">Jobs</td>
    		<td bgcolor="#CCCCCC">Join Date</td>
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
<tr>
    <td colspan="2" align="center" valign="top"><br>
      Invoice Generated Jobs   </td></tr>

<tr>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody>
      	 <tr>
            <td bgcolor="#CCCCCC">Jobs</td>
            <td bgcolor="#CCCCCC">Invoice Date</td>
            <td bgcolor="#CCCCCC">Start Date</td>
            <td bgcolor="#CCCCCC">Due Date</td>
            <td bgcolor="#CCCCCC">Amt.</td>
            <td bgcolor="#CCCCCC">Status</td>
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
<tr>
        <td align="center" valign="top"><br>
    	<br>
    	<form class="form-horizontal form-bordered"  method="post" id="summary" name="summary" action="<?php echo $this->config->site_url();?>/data_entry/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate();"> 
    	<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
    
		<?php if(count($all_counselor)>0){?>
   	    <table width="95%" border="1" cellspacing="1" cellpadding="1">
    
                <tr>
                <td colspan="2">All Users</td>    
                </tr>
                
                <?php foreach($all_counselor as $key => $val){?>
                
                <tr>
                <td><input type="checkbox" name="admin_id[]" value="<?php echo $val['admin_id'];?>" id=""></td>
                <td><?php echo $val['firstname'];?></td>
                </tr>            
                
                <?php } ?>
                <tr>
                <td colspan="2"><input type="submit" name="action" value="Add"> 
                [Select and click on add to add more users]</td>
                </tr>
     </table>
     <?php } ?>
    </form>
    <br>
    <br>
  </td>
        
        
  <td align="left" valign="top"><br>
     <br>
    <form class="form-horizontal form-bordered"  method="post" id="summary1" name="summary1" action="<?php echo $this->config->site_url();?>/data_entry/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate1();"> 
    <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
   
   	 <table width="95%" border="1" cellspacing="1" cellpadding="1">
    
            <tr>
            <td colspan="2">List of users managing this candidate.</td>    
            </tr>
            
            <?php foreach($candidate_counselor as $key => $val){?>
            
            <tr>
            <td><input type="checkbox" name="admin_id[]" value="<?php echo $val['admin_id'];?>" id=""></td>
            <td><?php echo $val['firstname'];?></td>
            </tr>
            
            <?php } ?>
            <tr>
            <td colspan="2"><input type="submit" name="action" value="Remove"> 
            [Select and cliclk remove existing users]</td>
            </tr>
    </table>
    </form>
    <br>
    <br>
  </td>
  </tr>
  
 <!--USER AREA END-->
</table>


<!-----------------------MANAGE EMAIL---------------------->

<div class="notes">
<ul>
<li id="tab_2btn">Send Email</li>


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
    <form action="<?php echo $this->config->site_url();?>/data_entry/manage_email/<?php echo $candidate_id;?>" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onsubmit="return email_validate();" >  
    <input type="hidden" value="<?php echo $candidate_id;?>" name="candidate_id" id="candidate_id">


    <h3>Subject</h3>
    <input name="subject" id="subject" type="text" class="text_box">
    <h3>Email</h3>
    <textarea name="email_text" cols="" rows="" class="text_area" id="email_text"></textarea> 
    
     <span class="click-icons"><br />

    <input type="submit" name="sub3" id="sub3" class="attach-subs" value="Send">
    </span>
    </form>
    </div>
    
   
    <div style="clear:both;"></div>
    </div>

	

<!---------------------------END EMAIL------------------------------------->



<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>

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
    
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/data_entry/edu_history_2/<?php echo $candidate_id;?>" onSubmit="return candidate_validate();"> 
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
                     <td> <?php echo form_dropdown('edu_country',  $country_list, '','class="form-control" id="edu_country"');?> </td>
                    </tr>
                    <tr>
                    <td>Course Type</td>
                     <td> <?php echo form_dropdown('course_type_id',  $edu_course_type_list, '','class="form-control" id="course_type_id"');?> </td>
                    </tr>
                    
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
    
                
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/data_entry/job_history_2/<?php echo $candidate_id;?>" onSubmit="return job_validate();" > 
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
                    <td>Category</td>
                     <td> <?php echo form_dropdown('job_cat_id',  $industry_list, '','class="form-control" id="job_cat_id"');?> </td>
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
                    <td><input type="text" name="from_date" id="datepickfrom" value="" placeholder="Enter From Date Date YYYY-MM-DD"></td>
                </tr>
                
                <tr>
                    <td>To Date</td>
                    <td><input type="text" name="to_date" id="datepickto" value="" placeholder="Enter To Date Date YYYY-MM-DD"></td>
                </tr>
                
                <tr>
                    <td>Current Salary</td>
                    <td><input class="form-control hori " type="text" name="monthly_salary" value=""  id="monthly_salary">
                    <input type="hidden" name="currency_id" value="" /> </td>
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
               		 <td>Total Experience</td>
                     <td> <?php echo form_dropdown('exp_years',  $years_list, '','class="form-control" id="exp_years"');?>&nbsp; <?php echo form_dropdown('exp_months',  $months_list,'','class="form-control" id="exp_months"');?></td>	
                </tr>
                        
                <tr>   
                    <tr>
                    <td>Skills</td>
                    <td>
                    <input class="form-control hori " type="text" name="skills" id="skills" value="" placeholder="Enter your Skills ">
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
    
                
               <form class="form-horizontal form-bordered"  method="post" id="candidate_validate" name="candidate_validate" action="<?php echo $this->config->site_url();?>/data_entry/lang_history_2/<?php echo $candidate_id;?>">
                
                <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>" />
                
                <table class="hori-form">
                    <tbody>
                    
                    
                        <tr>
                          <td>10th Marks</td>
                            <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_10th" value="<?php if(!empty($lang_details) && $lang_details[0]['eng_10th']!=''){ echo $lang_details[0]['eng_10th']; }?>" id="eng_10th"></td>
                        </tr>
                        
                        <tr>
                          <td>12th Marks</td>
                            <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_12th" value="<?php if(!empty($lang_details) && $lang_details[0]['eng_12th']!=''){ echo $lang_details[0]['eng_12th']; }?>" id="eng_12th"></td>
                        </tr>
                        
                        <tr>
                          <td>Graduation Mark</td>
                            <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_grad" value="<?php if(!empty($lang_details) && $lang_details[0]['eng_grad']!=''){ echo $lang_details[0]['eng_grad']; }?>"  id="eng_grad"></td>
                        </tr>
                        
                        <tr>
                          <td>Post Graduation Mark</td>
                            <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_post_grad" value="<?php if(!empty($lang_details) && $lang_details[0]['eng_post_grad']!=''){ echo $lang_details[0]['eng_post_grad']; }?>"  id="eng_post_grad"></td>
                        </tr>
                        
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

<!--END LANG MODAL------------------------------------------------>

<!--BEGIN SKILL MODAL---------------------------------------------->

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
    
<form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/data_entry/skills_2/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

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
    
<form class="form-horizontal form-bordered"  method="post" id="cert_form" name="cert_form" action="<?php echo $this->config->site_url();?>/data_entry/add_certification/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

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


<!------------------END CERTIFICATION MODAL----------------------------------------------------->

<!--BEGIN FOLLOW UP MODAL---------------------------------------------->

<div class="modal fade" id="followupModal" role="dialog" aria-labelledby="enquiry-modal-label">
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
          <li class="active">FOLLOW UP</li>            
     	 </ul>
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
<form class="form-horizontal form-bordered"  method="post" id="cert_form" name="cert_form" action="<?php echo $this->config->site_url();?>/data_entry/followup/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

    <table class="hori-form">
    <tbody>
        <tr>
        	<td>Enter Title</td>
            <td>
				<input name="followup_title" type="text" id="followup_title" class="text_box">
            </td>
        </tr>
      
        <tr>
        	<td>Enter Description</td>
            <td>
                    <textarea name="followup_desc" cols="" rows="" class="text_area" id="followup_desc"></textarea>    </td>
            </td>
        </tr>
        
        <tr>
        	<td>Schedule this for a date in future?</td>
            <td>
                    <input type="checkbox" name="future_followup" value="1" id="future_followup"/>&nbsp;Yes</td>
            </td>
        </tr>
        
        <tr>
        	<td>Date</td>
            <td>
                    <input type="text" name="flp_date_reminder" id="flp_date_reminder" readonly value="" style="width:100px;"/></td>
            </td>
        </tr>
        <tr>
        	<td>Time</td>
            <td>
                    <input type="text" name="flp_time_reminder" id="flp_time_reminder" value="" style="width:100px;"/>&nbsp;eg. 10:15 AM</td>
            </td>
        </tr>
        <tr>
        	<td>Responsibile by</td>
            <td>
                    <?php echo form_dropdown('assigned_to',  $admin_user_list,'','id="assigned_to"  class="table-group-action-input form-control input-medium"');?>&nbsp;</td>
            </td>
        </tr>
   		<tr>
            <td colspan="2">
            <span class="click-icons">
            <input type="submit" class="attach-subs" onclick="return followup_validate();" value="Update" id=""  style="width:180px;">
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


<!------------------END FOLLOWUP MODAL----------------------------------------------------->
<!--BEGIN CATEGORY AND FUNCTIONAL MODAL----------------------------------------------------->

<div class="modal fade" id="catModal" role="dialog" aria-labelledby="enquiry-modal-label">
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
          <li class="active">Category And Functional Area</li>            
     	 </ul>
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
                
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/data_entry/editCategory/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

    <table class="hori-form">
    <tbody>
       <tr>
       <td>&nbsp;</td>
       </tr>
        <tr>
            <td>Category</td>
              <td> 
                <select class="js-example-basic-multiple-cert" name="category[]" multiple="multiple" id="multiple_category" style="width:300px;">
                
                <?php foreach($industry_list as $category){?>
                <option  <?php  if (in_array($category['job_cat_id'], $category_list)){ ?> selected="selected" <?php  } ?> 
                value="<?php echo $category['job_cat_id'];?>"><?php echo $category['job_cat_name'];?></option>
                <?php }?>
                </select>
            </td>
        </tr>
      
         <tr>
             <td>Function/Role</td>
             <td>
              <select class="js-example-basic-multiple-cert" name="function[]" multiple="multiple" id="func_role_id" style="width:300px;">
                
                <?php foreach($functional_list as $function){?>
                <option <?php   if (in_array($function['func_id'], $function_list)){ ?> selected="selected" <?php  } ?>  
                value="<?php echo $function['func_id'];?>"><?php echo $function['func_area'];?></option>
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
    
                
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/data_entry/editSkills/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

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
            
    <div class="notess">
       	<ul>
          <li class="active">Present Contract Details</li>            
     	 </ul>
        <div class="table-tech  note" style="border:none;">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
<form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/data_entry/add_contract_details/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

    <table class="hori-form">
    <tbody>
        <tr>
                <td>Company</td>
                <td><input class="form-control hori " placeholder="Company Name" type="text" name="company_name" 
                value="<?php if(!empty($contract)) echo $contract['company_name'];?>" id="company_name"> 
                </td>
        </tr>
                        
        <tr>
                <td>Start Date</td>
                <td>
                <input class="form-control " style="width:300px;" placeholder="Start Date"  type="text"  name="start_date" readonly="readonly"
                value="<?php if(!empty($contract))echo $contract['start_date'];?>" id="start_date">
                </td>
         </tr>
         
         <tr>
                <td>End Date</td>
                <td>
                <input class="form-control " style="width:300px;" placeholder="End Date"  type="text"  name="end_date" 
                value="<?php if(!empty($contract))echo $contract['end_date'];?>" 
                readonly="readonly" id="end_date">
                </td> 
         </tr>
         
         <tr>
                <td>Total Months</td>
                <td> <select name='total_months' id="total_months" class="form-control" style="width:300px;">
                <option value="0">Select Total Months</option>
                <?php  for($i=1;$i<=36;$i++){?>
                <option value='<?php echo $i;?>' <?php if(!empty($contract)) echo ($i == $contract['total_months']? 'selected="selected"' : ''); ?>>
				<?php echo $i;?></option>
                <?php } ?>
                
                </select>         
               
                </td>
            </tr>
            
            <tr>  
                <td>Total Experience</td>
                <td><select style="width:200px;"  name="total_exp" class="form-control" style="width:600px;">
                    <option value="">Total Experience </option>
                    <?php foreach($years_list as $key => $val){?>
                    <option <?php if(isset($contract['total_exp']) && $contract['total_exp']==$key){?> selected="selected" <?php } ?> value="<?php echo $key;?>">                    <?php echo $val;?></option>
                    <?php }?>
                    </select>
                </td>
            </tr> 
        
             <tr>
                <td>Present Status</td>
                <td>                
                    <select class="form-control" name="present_status"  id="present_status" style="width:95%;">
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


<!--END PRESENT CONTRACT  MODAL--------------------------------------->



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
function job_validate() {
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
		if($('#exp_years').val()=='')
		{
			alert('Add total experience');
			$('#edu_country').focus();
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
		if($('#edu_country').val()=='')
		{
			alert('Select Country');
			$('#edu_country').focus();
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

	$('#level_id').change(function() 
	{	
		jQuery('#course_id').html('');
		jQuery('#course_id').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/data_entry/getcourses/',
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
<!--SCRIPT FOR EDUCATION MODAL END-->

	function summary_validate() 
	{
		return true;
	}
	
	
	function summary_validate1() 
	{
		return true;
	}
	
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



	
	//onchange of job_category

	$('#multiple_category').change(function() 
	{
	
		jQuery('#func_role_id').html('');
		jQuery('#func_role_id').append('<option value="">Select Function</option');
			
		if($('#multiple_category').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/data_entry/getfunction_multiple/',
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
		
		
		
//get candidate education details

get_candidate_education('<?php echo $candidate_id;?>');
function get_candidate_education(candidate_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {candidate_id:candidate_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/data_entry/get_candidate_education/',
	
	   success: function(data){ 
		
		
			$('#candidate_education1').html(data.data1);
			$('#candidate_education2').html(data.data2);
	   }
			
	 }); 
}

// Function for delete candidate education details

$(document).on('click', '#delete_candidate_edu', function(){																													
  if(window.confirm("Are You Sure to delete this data?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {	   			

				get_candidate_education('<?php echo $candidate_id;?>');
			
	   	   }
		  
	   }
			
	 }); 
  }
});


// function for get the Professional summary

get_candidate_professional('<?php echo $candidate_id;?>');
function get_candidate_professional(candidate_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {candidate_id:candidate_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/data_entry/get_candidate_professional/',
	
	   success: function(data){ 
		
		
			$('#candidate_professional1').html(data.data1);
			$('#candidate_professional2').html(data.data2);
	   }
			
	 }); 
}

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


// function for get the present contract details

get_present_contract('<?php echo $candidate_id;?>');
function get_present_contract(candidate_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {candidate_id:candidate_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/data_entry/get_present_contract/',
	
	   success: function(data){ 
		
		
			$('#candidate_contract1').html(data.data1);
			$('#candidate_contract2').html(data.data2);
	   }
			
	 }); 
}

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


// function for get the candidate followup

get_candidate_followup('<?php echo $candidate_id;?>');
function get_candidate_followup(candidate_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {candidate_id:candidate_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/data_entry/get_candidate_followup/',
	
	   success: function(data){ 
		
		
			$('#candidate_followup1').html(data.data1);
			$('#candidate_followup2').html(data.data2);
	   }
			
	 }); 
}

// Function for delete candidate followup

$(document).on('click', '#delete_candidate_followup', function(){																													
  if(window.confirm("Are You Sure to delete this data?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {	   			

				get_candidate_followup('<?php echo $candidate_id;?>');
			
	   	   }
		  
	   }
			
	 }); 
  }
});


	
	
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
	
</script>