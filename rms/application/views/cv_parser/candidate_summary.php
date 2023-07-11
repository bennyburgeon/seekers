
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

<?php if($this->input->get('upd')==1){?>  

<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> Contract details updated successfully.
</div>
<?php } ?> 

<div class="row">

<div class="col-md-12">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
<div class="profile_top_right"><br />
<a href="<?php echo $this->config->site_url();?>/cv_parser" >Back</a></span></td>&nbsp;&nbsp;|
<a href="<?php echo base_url();?>index.php/cv_parser/candidate_delete/<?php echo md5($detail_list['candidate_id']);?>">Delete this profile</a>	&nbsp;&nbsp;&nbsp;
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
                <?php if($detail_list['cv_file']!=''){?><a href="<?php echo base_url().'uploads/cvs/'.$detail_list['cv_file'];?>" target="_blank" style="color:#0033FF">Download CV</a> &nbsp;||&nbsp;<a href="<?php echo site_url().'/cv_parser/delete_cv/'.$candidate_id.'/';?>" style="color:#0033FF">Delete CV</a> <?php } ?> </td>
                  </tr>
                  
                  <tr><td colspan="2">
                  
                   <?php if($detail_list['photo']!=''){?><span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$detail_list['photo'];?>" class="profile_img" style="width:158px;height:100px;"><br /><br /><a href="<?php echo site_url().'/cv_parser/delete_photo/'.$candidate_id.'/';?>" style="color:#0033FF">Delete Photo</a>&nbsp;&nbsp;</span> <?php } ?> 
                  
                  </td></tr>
                  
                  <tr><td colspan="2">
                        <ul><li class="test"><a href="#" data-toggle="modal" data-target="#eduModal">Education</a></li>
                        <li class="test"><a href="#" data-toggle="modal" data-target="#jobModal">Job History</a></li> 
                        <li class="test"><a href="#" data-toggle="modal" data-target="#langModal">Lang. Skill</a></li>        
                        <li class="test"><a href="#" data-toggle="modal" data-target="#skillModal">Tech. Skill</a></li></ul>
                    
                  </td></tr>
          
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

            
            <?php if($detail_list['eng_10th']!=''){?>
                Eng. 10th : <?php echo $detail_list['eng_10th'];?><br />
            <?php }else{ ?>
                Eng. 10th : Not Updated.<br />
            
            <?php } ?>
            
            <?php if($detail_list['eng_12th']!=''){?>
                Eng. 12th : <?php echo $detail_list['eng_12th'];?><br />
            <?php }else{ ?>
            
            Eng. 12th : Not Updated.<br />
            <?php } ?>
            
            <?php if($detail_list['eng_grad']!=''){?>
                Eng. Graduation : <?php echo $detail_list['eng_grad'];?><br />
            <?php }else{ ?>
            
            Eng. Graduation  : Not Updated.<br />
            <?php } ?>
            <?php if($detail_list['eng_post_grad']!=''){?>
                Eng. Post Graduation : <?php echo $detail_list['eng_post_grad'];?><br />
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
    <td align="left" valign="top">
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
		<form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/cv_parser/upload_cv_photo/<?php echo $detail_list['candidate_id'];?>" enctype="multipart/form-data"> 
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
    <?php if(count($lang_details)>0){?>
       <tr>
    	<td colspan="2" align="center" valign="top"> 
    
            <table width="95%" border="1" cellspacing="3" cellpadding="3">
                <tr>
                	<td  colspan="6" align="center" bgcolor="#CCCCCC">All Language Details</td> 
                </tr>
                <tr> 
                	<td  colspan="2" align="center" ></td>              
                    <td  align="center" >Reading</td>    
                    <td  align="center">Listening</td>    
                    <td  align="center" >Writing</td>    
                    <td  align="center" >Speaking</td>        
                </tr>
                
                <?php foreach($lang_details as $lang){?>             
                <tr>
                    <td >PTE</td>
                    <td style="width:80px;"><?php echo $lang['eng_pte'];?></td>
                     <td ><?php echo $lang['eng_pte_reading'];?></td>
                    <td ><?php echo $lang['eng_pte_listening'];?></td>
                    <td ><?php echo $lang['eng_pte_writing'];?></td>
                    <td ><?php echo $lang['eng_pte_speaking'];?></td>
                </tr>  
                
                <tr>
                    <td>IELTS</td>
                    <td ><?php echo $lang['eng_ielts'];?></td>
                    <td ><?php echo $lang['eng_ielts_reading'];?></td>
                    <td ><?php echo $lang['eng_ielts_listening'];?></td>
                    <td ><?php echo $lang['eng_ielts_writing'];?></td>
                    <td ><?php echo $lang['eng_ielts_speaking'];?></td>
                </tr> 
                
                <tr>
                    <td >OET</td>
                    <td ><?php echo $lang['eng_oet'];?></td>
                    <td ><?php echo $lang['eng_oet_reading'];?></td>
                    <td ><?php echo $lang['eng_oet_listening'];?></td>
                    <td ><?php echo $lang['eng_oet_writing'];?></td>
                    <td ><?php echo $lang['eng_oet_speaking'];?></td>
                </tr>  
                
                <tr>
                    <td >TOFEL</td>
                    <td ><?php echo $lang['eng_tofel'];?></td>
                    <td ><?php echo $lang['eng_tofel_reading'];?></td>
                    <td ><?php echo $lang['eng_tofel_listening'];?></td>
                    <td ><?php echo $lang['eng_tofel_writing'];?></td>
                    <td ><?php echo $lang['eng_tofel_speaking'];?></td>
                </tr>  
                
                <tr>
                    <td >GRE</td>
                    <td colspan="5"><?php echo $lang['eng_gre'];?></td>
                </tr>  
                
                <tr>
                    <td >GMAT</td>
                    <td colspan="5"><?php echo $lang['eng_gmat'];?></td>
                </tr>  
                
                <tr>
                    <td >SAT</td>
                    <td colspan="5"><?php echo $lang['eng_sat'];?></td>
                </tr>  
                
                <tr>
                    <td >10th Marks</td>
                    <td colspan="5"><?php echo $lang['eng_10th'];?></td>
                </tr>  
                
                <tr>
                    <td >12th Marks</td>
                    <td colspan="5"><?php echo $lang['eng_12th'];?></td>
                </tr>  
                
                <tr>
                    <td >Eng Grad</td>
                    <td colspan="5"><?php echo $lang['eng_grad'];?></td>
                </tr>  
                
                <tr>
                    <td >Eng Post Grad</td>
                    <td colspan="5"><?php echo $lang['eng_post_grad'];?></td>
                </tr>           
           <?php }?> 
                
     </table>    
  </td>   
 </tr>
  <?php } ?>          
        
 

<!--START Profile Completion and Profile assessment-->  

 
      
	<tr>
    	<?php if(count($profile_completion)>0){?>
        <td align="center" valign="top"><br>
    	<br>
    	<form class="form-horizontal form-bordered"  method="post" id="summary" name="summary" action="<?php echo $this->config->site_url();?>/cv_parser/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate();"> 
    	<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
    
		
   	    <table width="90%" border="1" cellspacing="1" cellpadding="1">
    
                <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">Profile Completion Status</td>    
                </tr>
                
                
                <tr>
                    <td style="width:150px">Personal</td>
                    <td style="width:150px"><?php if($profile_completion['profile_stat_1'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>  
                
                <tr>
                    <td>Address</td>
                    <td ><?php if($profile_completion['profile_stat_2'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr> 
                
                <tr>
                    <td >Education</td>
                    <td ><?php if($profile_completion['profile_stat_3'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>    
                
                <tr>
                    <td >Profession</td>
                    <td ><?php if($profile_completion['profile_stat_4'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>  
                
                <tr>
                    <td >Language</td>
                    <td ><?php if($profile_completion['profile_stat_5'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>  
                
                <tr>
                    <td >Tech Skills</td>
                    <td ><?php if($profile_completion['profile_stat_6'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>  
                
                <tr>
                    <td >Certification</td>
                    <td ><?php if($profile_completion['profile_stat_7'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>  
                
                <tr>
                    <td >Projects</td>
                    <td ><?php if($profile_completion['profile_stat_8'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>  
                
                <tr>
                    <td >Sports</td>
                    <td ><?php if($profile_completion['profile_stat_9'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>  
                
                <tr>
                    <td >Social</td>
                    <td ><?php if($profile_completion['profile_stat_10'] == 1) echo 'Yes';else  echo 'No'?></td>
                </tr>         
                
                
                
     </table>
    
    </form>
    <br>
    <br>
  </td>
   <?php } ?>      
        
 <?php if(count($profile_assessment)>0){?>
        <td align="center" valign="top"><br>
    	<br>
    	<form class="form-horizontal form-bordered"  method="post" id="summary" name="summary" action="<?php echo $this->config->site_url();?>/cv_parser/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate();"> 
    	<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
    
		
   	    <table width="90%" border="1" cellspacing="1" cellpadding="1">
    
                <tr>
                <td colspan="2" align="center" bgcolor="#CCCCCC">Profile Assessment Status</td>    
                </tr>
                
                
                <tr>
                    <td style="width:150px">Language</td>
                    <td style="width:150px"><?php if($profile_assessment['language'] == 1) echo 'Poor';
					else if($profile_assessment['language'] == 2) echo 'Marginal';
					else if($profile_assessment['language'] == 3) echo 'Fair';
					else if($profile_assessment['language'] == 4) echo 'Satisfactory';
					else if($profile_assessment['language'] == 5) echo 'Average';
					else if($profile_assessment['language'] == 6) echo 'Good';
					else if($profile_assessment['language'] == 7) echo 'Very Good';
					else if($profile_assessment['language'] == 8) echo 'Excellent';
					else if($profile_assessment['language'] == 9) echo 'Outstanding';
					else if($profile_assessment['language'] == 10) echo 'Exceptional';?></td>
                </tr>  
                
                <tr>
                    <td>Attitude</td>
                    <td ><?php if($profile_assessment['attitude'] == 1) echo 'Poor';
					else if($profile_assessment['attitude'] == 2) echo 'Marginal';
					else if($profile_assessment['attitude'] == 3) echo 'Fair';
					else if($profile_assessment['attitude'] == 4) echo 'Satisfactory';
					else if($profile_assessment['attitude'] == 5) echo 'Average';
					else if($profile_assessment['attitude'] == 6) echo 'Good';
					else if($profile_assessment['attitude'] == 7) echo 'Very Good';
					else if($profile_assessment['attitude'] == 8) echo 'Excellent';
					else if($profile_assessment['attitude'] == 9) echo 'Outstanding';
					else if($profile_assessment['attitude'] == 10) echo 'Exceptional';?></td>
                </tr> 
                
                <tr>
                    <td >Tech Skills</td>
                    <td ><?php if($profile_assessment['tech_skills'] == 1) echo 'Poor';
					else if($profile_assessment['tech_skills'] == 2) echo 'Marginal';
					else if($profile_assessment['tech_skills'] == 3) echo 'Fair';
					else if($profile_assessment['tech_skills'] == 4) echo 'Satisfactory';
					else if($profile_assessment['tech_skills'] == 5) echo 'Average';
					else if($profile_assessment['tech_skills'] == 6) echo 'Good';
					else if($profile_assessment['tech_skills'] == 7) echo 'Very Good';
					else if($profile_assessment['tech_skills'] == 8) echo 'Excellent';
					else if($profile_assessment['tech_skills'] == 9) echo 'Outstanding';
					else if($profile_assessment['tech_skills'] == 10) echo 'Exceptional';?></td>
                </tr>    
                
                <tr>
                    <td >Ind. Exp.</td>
                    <td ><?php if($profile_assessment['personality'] == 1) echo 'Poor';
					else if($profile_assessment['personality'] == 2) echo 'Marginal';
					else if($profile_assessment['personality'] == 3) echo 'Fair';
					else if($profile_assessment['personality'] == 4) echo 'Satisfactory';
					else if($profile_assessment['personality'] == 5) echo 'Average';
					else if($profile_assessment['personality'] == 6) echo 'Good';
					else if($profile_assessment['personality'] == 7) echo 'Very Good';
					else if($profile_assessment['personality'] == 8) echo 'Excellent';
					else if($profile_assessment['personality'] == 9) echo 'Outstanding';
					else if($profile_assessment['personality'] == 10) echo 'Exceptional';?></td>
                </tr>  
                
                <tr>
                    <td >Personality</td>
                    <td ><?php if($profile_assessment['personality'] == 1) echo 'Poor';
					else if($profile_assessment['personality'] == 2) echo 'Marginal';
					else if($profile_assessment['personality'] == 3) echo 'Fair';
					else if($profile_assessment['personality'] == 4) echo 'Satisfactory';
					else if($profile_assessment['personality'] == 5) echo 'Average';
					else if($profile_assessment['personality'] == 6) echo 'Good';
					else if($profile_assessment['personality'] == 7) echo 'Very Good';
					else if($profile_assessment['personality'] == 8) echo 'Excellent';
					else if($profile_assessment['personality'] == 9) echo 'Outstanding';
					else if($profile_assessment['personality'] == 10) echo 'Exceptional';?></td>
                </tr>  
                
                <tr>
                    <td >Interaction</td>
                    <td ><?php if($profile_assessment['interaction'] == 1) echo 'Poor';
					else if($profile_assessment['interaction'] == 2) echo 'Marginal';
					else if($profile_assessment['interaction'] == 3) echo 'Fair';
					else if($profile_assessment['interaction'] == 4) echo 'Satisfactory';
					else if($profile_assessment['interaction'] == 5) echo 'Average';
					else if($profile_assessment['interaction'] == 6) echo 'Good';
					else if($profile_assessment['interaction'] == 7) echo 'Very Good';
					else if($profile_assessment['interaction'] == 8) echo 'Excellent';
					else if($profile_assessment['interaction'] == 9) echo 'Outstanding';
					else if($profile_assessment['interaction'] == 10) echo 'Exceptional';?></td>
                </tr>  
                
                <tr>
                    <td >Team Work</td>
                    <td ><?php if($profile_assessment['team_work'] == 1) echo 'Poor';
					else if($profile_assessment['team_work'] == 2) echo 'Marginal';
					else if($profile_assessment['team_work'] == 3) echo 'Fair';
					else if($profile_assessment['team_work'] == 4) echo 'Satisfactory';
					else if($profile_assessment['team_work'] == 5) echo 'Average';
					else if($profile_assessment['team_work'] == 6) echo 'Good';
					else if($profile_assessment['team_work'] == 7) echo 'Very Good';
					else if($profile_assessment['team_work'] == 8) echo 'Excellent';
					else if($profile_assessment['team_work'] == 9) echo 'Outstanding';
					else if($profile_assessment['team_work'] == 10) echo 'Exceptional';?></td>
                </tr>  
                
                <tr>
                    <td >Cop. Exp</td>
                    <td ><?php if($profile_assessment['corporate_exp'] == 1) echo 'Poor';
					else if($profile_assessment['corporate_exp'] == 2) echo 'Marginal';
					else if($profile_assessment['corporate_exp'] == 3) echo 'Fair';
					else if($profile_assessment['corporate_exp'] == 4) echo 'Satisfactory';
					else if($profile_assessment['corporate_exp'] == 5) echo 'Average';
					else if($profile_assessment['corporate_exp'] == 6) echo 'Good';
					else if($profile_assessment['corporate_exp'] == 7) echo 'Very Good';
					else if($profile_assessment['corporate_exp'] == 8) echo 'Excellent';
					else if($profile_assessment['corporate_exp'] == 9) echo 'Outstanding';
					else if($profile_assessment['corporate_exp'] == 10) echo 'Exceptional';?></td>
                </tr>  
                
                <tr>
                    <td >Edu. Abroad</td>
                    <td ><?php if($profile_assessment['overseas_edu'] == 1) echo 'Poor';
					else if($profile_assessment['overseas_edu'] == 2) echo 'Marginal';
					else if($profile_assessment['overseas_edu'] == 3) echo 'Fair';
					else if($profile_assessment['overseas_edu'] == 4) echo 'Satisfactory';
					else if($profile_assessment['overseas_edu'] == 5) echo 'Average';
					else if($profile_assessment['overseas_edu'] == 6) echo 'Good';
					else if($profile_assessment['overseas_edu'] == 7) echo 'Very Good';
					else if($profile_assessment['overseas_edu'] == 8) echo 'Excellent';
					else if($profile_assessment['overseas_edu'] == 9) echo 'Outstanding';
					else if($profile_assessment['overseas_edu'] == 10) echo 'Exceptional';?></td>
                </tr>  
                
                <tr>
                    <td >Migration</td>
                    <td ><?php if($profile_assessment['migration'] == 1) echo 'Poor';
					else if($profile_assessment['migration'] == 2) echo 'Marginal';
					else if($profile_assessment['migration'] == 3) echo 'Fair';
					else if($profile_assessment['migration'] == 4) echo 'Satisfactory';
					else if($profile_assessment['migration'] == 5) echo 'Average';
					else if($profile_assessment['migration'] == 6) echo 'Good';
					else if($profile_assessment['migration'] == 7) echo 'Very Good';
					else if($profile_assessment['migration'] == 8) echo 'Excellent';
					else if($profile_assessment['migration'] == 9) echo 'Outstanding';
					else if($profile_assessment['migration'] == 10) echo 'Exceptional';?></td>
                </tr>         
                
                
                
     </table>
    
    </form>
    <br>
    <br>
  </td>
   <?php } ?>      
</tr>
 

 <!---------------------Education--------------------->
	
	<?php if(count($education_details)>0){?>     

   <tr>
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
	<?php } ?>
    

<!----------------professional Summary-------------->

	<?php if(count($job_history)>0){?>
    
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
	<?php } ?>
    
    
<!----------------Present Contract Details-------------->

	<?php if(count($contract_details)>0){?>
    
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
                    <td bgcolor="#CCCCCC">Action</td>
                    
                  </tr>
                 
                 
                 
                  <tr>
                    <td><?php echo $contract_details['start_date'];?></td>
                    <td><?php echo $contract_details['end_date'];?></td>
                    <td><?php echo $contract_details['total_months'];?></td>
                    
                    <td><a href="#" data-toggle="modal" data-target="#contractModal">Change</a></td>
                  </tr>
          
           </table>  
        </td>
    </tr>
	<?php } ?>
    
    <!-----------------suggested Jobs--------------->

	<?php if(count($candidate_programs_summary)>0){?>
    
	 <tr>
        <td colspan="2" align="center" valign="top"><br>
         Suggested Jobs  </td>
    </tr>
    
    <tr>
   		 <td colspan="2" align="center" valign="top">    
    
            <table border="1" cellpadding="3" cellspacing="3" width="95%">
             	 <tbody>
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
                 </tbody>
    		</table>  
        </td>
    </tr>

	<?php } ?>


    
    
    

<!--Certificate of enrolement------->


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
     
<!--------------------Details of visa-------->


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
      
 <!---------------Updated Files----------------->   

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
<td colspan="2" align="center" valign="top"><br>Jobs Applied </td>
</tr>

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
        </tbody>
    </table>
  </td>
</tr>
<?php } ?>
<!--END APPLIED JOBS-->

<!--START SHORTLISTED JOBS-->
<?php if(!empty($shortlisted)){ ?>
<tr>
<td colspan="2" align="center" valign="top"><br>
Jobs Shortlisetd </td>
</tr>

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
            </tbody>
       	</table>
    </td>
</tr>
<?php } ?>
<!--END SHORTLISTED JOBS-->

<!--START INTERVIEW JOBS-->
<?php if(!empty($interview_list)){ ?>
<tr>
<td colspan="2" align="center" valign="top"><br>
Interviews Scheduled 
</td>
</tr>

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
            </tbody>
       </table>
    </td>
</tr>
<?php } ?>
<!--END INTERVIEW JOBS-->

<!--START SELECTED JOBS-->
<?php if(!empty($jobs_selected)){ ?>
<tr>
<td colspan="2" align="center" valign="top"><br>
Jobs Selected 
</td>
</tr>

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
            </tbody>
        </table>
	</td>
</tr>
<?php } ?>
<!--END INTERVIEW JOBS-->


<!--START OFFER LETTER ISSUED JOBS-->
<?php if(!empty($offer_letters_issued)){ ?>
<tr>
<td colspan="2" align="center" valign="top"><br>
Offer Letters Issued Jobs  
</td>
</tr>

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
            </tbody>
        </table>   
    
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
            </tbody>
        </table>
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
            <td width="13%"><a href="<?php echo base_url(); ?>index.php/cv_parser/summary/<?php echo $invoice['candidate_id'];?>/" target="_blank">
            <?php echo $invoice['job_title'];?></a></td>
            <td width="13%"><?php echo $invoice['invoice_date'];?></td>
            <td width="14%"><?php echo $invoice['invoice_start_date'];?></td>
            <td width="12%"><?php echo $invoice['invoice_due_date'];?></td>
            <td width="11%"><?php echo $invoice['invoice_amount'];?></td>
            <td width="11%"><?php if($invoice['invoice_status']=='1')echo 'Paid';if($invoice['invoice_status']=='2')echo 'Unpaid';if($invoice['invoice_status']=='3')
			echo 'Due';?></td>
            
        </tr>
        
		<?php } ?> 
        </tbody>
     </table>
  </td>
</tr>
<?php } ?>
<!--END  INVOICE JOBS-->

<!--START USER AREA-->
<tr>
        <td align="center" valign="top"><br>
    	<br>
    	<form class="form-horizontal form-bordered"  method="post" id="summary" name="summary" action="<?php echo $this->config->site_url();?>/cv_parser/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate();"> 
    	<input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>">
    
		<?php if(count($all_counselor)>0){?>
   	    <table width="90%" border="1" cellspacing="1" cellpadding="1" >
    
                <tr >
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
    <form class="form-horizontal form-bordered"  method="post" id="summary1" name="summary1" action="<?php echo $this->config->site_url();?>/cv_parser/summary/<?php echo $candidate_id;?>" onSubmit="return summary_validate1();"> 
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
    
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/cv_parser/edu_history_2/<?php echo $candidate_id;?>" onSubmit="return candidate_validate();"> 
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

<!------------------------ end modal------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>

<!--END EDUCATION MODAL-->


<!--BEGIN JOB MODAL----->

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
    
                
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="<?php echo $this->config->site_url();?>/cv_parser/job_history_2/<?php echo $candidate_id;?>" onSubmit="return job_validate();" > 
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

<!------------------------ end modal------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>

<!--END JOB MODAL------------------------->

<!--BEGIN LANG MODAL-------------------->

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
    
                
           <form class="form-horizontal form-bordered"  method="post" id="candidate_validate" name="candidate_validate" action="<?php echo $this->config->site_url();?>/cv_parser/lang_history_2/<?php echo $candidate_id;?>">
            
            <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>" />
            
                <table class="hori-form">
                    <tbody>
                    
                        <tr>
                        <td>Nationality</td>
                        <td><?php echo form_dropdown('passport_nationality',  $country_list, $formdata['passport_nationality'],'class="form-control" id="passport_nationality"');?></td>
                        </tr>                    
                        
                        <tr>
                        <td>10th Marks</td>
                        <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_10th" value="<?php echo $formdata['eng_10th'];?>" id="eng_10th"></td>
                        </tr>
                        
                        <tr>
                        <td>12th Marks</td>
                        <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_12th" value="<?php echo $formdata['eng_12th'];?>" id="eng_12th"></td>
                        </tr>
                        
                        <tr>
                        <td>Graduation Mark</td>
                        <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_grad" value="<?php echo $formdata['eng_grad'];?>" id="eng_grad"></td>
                        </tr>
                        
                        <tr>
                        <td>Post Graduation Mark</td>
                        <td><input class="form-control hori " placeholder="Total %" type="text" name="eng_post_grad" value="<?php echo $formdata['eng_post_grad'];?>" 
                        id="eng_post_grad"></td>
                        </tr>
                        
                        <tr>
                        <td>Languages Known</td>
                        <td>
                        <?php foreach($lang_list as $lang){ ?>
                        <label style="font-weight:normal"><input <?php   if (in_array($lang['lang_id'], $candidate_language)){ ?> checked="checked" <?php  } ?>  
                        type="checkbox" name="lang[]"  value="<?php echo $lang['lang_id'];?>" />&nbsp;<?php echo $lang['lang_name'];?></label>&nbsp;&nbsp;&nbsp;
                        
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

<!--END LANG MODAL------------------------->

<!--BEGIN SKILL MODAL------------------------>

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
    
                
     <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" 
     action="<?php echo $this->config->site_url();?>/cv_parser/skills_2/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 

    <table class="hori-form">
        <tbody>
            <tr>
                <td>Technical Skills</td>
                <td> <select class="form-control" onchange="myFunction();" id="parent">
                <option value="">Select Skill</option>
                <?php foreach($skill_list as $key => $val){?>
                <option <?php if(isset($res1[0]['skill_id']) && $res1[0]['skill_id']==$key){?> selected="selected" <?php } ?> 
                value="<?php echo $key;?>"><?php echo $val['skill_name'];?></option>
                <?php }?>
                </select>
                </td>
            </tr>
          
            <tr  id="skill-tr"  <?php if(empty($candidate_skills)){ ?> style="display:none" <?php }  ?>>        
                <td>&nbsp;</td>
                <td> 
                <select class="js-example-basic-multiple-cert" name="skills[]" multiple="multiple" id="multiple_skill" style="width:95%;">                    
                <?php foreach($child_skills as $skill){?>
                <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?> 
                style="" value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
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

<!------------------------ end modal------------------------------>

<div style="clear:both;"></div>
</div>
</div>
</div>

<!--END Skill MODAL----------------------------------------->

<!--BEGIN Contract MODAL------------------------------------------->

<div class="modal fade" id="contractModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
        <div class="modal-body">
        <div class="col-md-15">
        
        </div>
            
        <div class="notess ">
        <ul>
        <li class="active">Present Contract Details</li>            
        </ul>
        <div class="table-tech  note" style="border:none;">
        <div class="new_notes">
        
        <p id="result"></p>
        <p id="deletemessage"></p>
    
            
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" 
            action="<?php echo $this->config->site_url();?>/cv_parser/change_contract_details/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 
            
                <table class="hori-form">
                    <tbody>
                        <tr>
                            <td>Start Date</td>
                            <td><input class="form-control hori datepicker" placeholder="Start Date" type="text" name="start_date" 
                            value="<?php echo $contract_details['start_date'];?>" id="start_date"></td>
                        </tr>
                        
                        <tr>
                            <td>End Date</td>
                            <td><input class="form-control hori datepicker" placeholder="End Date" type="text" name="end_date" 
                            value="<?php echo $contract_details['end_date'];?>" id="end_date"></td>
                        </tr>
                        
                        <tr>
                            <td>Total Months</td>
                            <td><input class="form-control hori " placeholder="Total Months" type="text" name="total_months" 
                            value="<?php echo $contract_details['total_months'];?>" id="total_months"> 
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

<!------------------------ end modal------------------------------->


<div style="clear:both;"></div>
</div>
</div>
</div>

<!--END Contract MODAL--------------------------------------------------->



<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script language="javascript">

<!--SCRIPT FOR SKILL MODAL BEGIN-->
$('#multiple_skill').addClass('form-control hori');
$(".js-example-basic-multiple-cert").select2();

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
			  url: '<?php echo $this->config->site_url();?>/cv_parser/getcourses/',
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

$(document).ready(function()
{
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

 $('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});
 
 //onchange of job_category

	$('#job_cat_id').change(function() 
	{
	
		jQuery('#func_id').html('');
		jQuery('#func_id').append('<option value="">Select Function</option');
			
		if($('#job_cat_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/cv_parser/getfunction/',
			  data: { category_id: $('#job_cat_id').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#func_id').html('');
					  jQuery('#func_id').append(data.function_list);

					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Please try again');
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Select Function</option');
			  }
			});	
	});
</script>