
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
<div class="profile_top_right">
<br>
<a href="<?php echo base_url();?>jobs/manage/<?php echo $formdata['job_id'];?>">Back to Summary</a>	&nbsp;&nbsp;&nbsp;
</div>
<div style="clear:both;"></div>
</div>


<div style="border:solid;height:auto;">

        <table border="0" cellpadding="3" cellspacing="3" width="100%">
            <tbody>
                
                <tr>
                <td colspan="2" align="center" valign="top">
                  <div class="tab-head mar-spec"><h3>Job Details</h3></div>
                </td>
                </tr>
                
                <tr>
                <td colspan="2" align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">

                        <tbody>
                            <tr>
                                <td width="19%"><span><strong>Job Title</strong></span></td>
                                <td width="27%"><span><?php echo $formdata['job_title'];?></span></td>
                                <td width="25%"><span>Job Type</span></td>
                                <td width="29%"><span><?php echo $formdata['job_type'];?></span></td>
                            </tr>
                            
                            <tr>
                                <td><span><strong>Company Name</strong></span></td>
                                <td><span><?php echo $formdata['company_name'];?></span></td>
                                <td><span>Job Level</span></td>
                                <td><span><?php echo $formdata['job_level'];?></span></td>
                            </tr>
                            
                            <tr>
                                 <td><span><strong>Job Industry</strong></span></td>
                                <td><span><?php echo $formdata['industry'];?></span></td>
                                <td><span>Job Category</span></td>
                                <td><span><?php echo $formdata['category'];?></span></td>

                            </tr>
                            
                            <tr>
                                <td><span><strong>Job Work Level</strong></span></td>
                                <td><span><?php echo $formdata['work_level'];?></span></td>
                                <td><span>Functional Area</span></td>
                                <td><span><?php echo $formdata['fun_area'];?></span></td>

                            </tr>
                            
                            <tr>
                               <td><span><strong>Salary</strong></span></td>
                                <td><span><?php echo $formdata['salary_level'];?></span></td>
                                <td><span>Location</span></td>
                                <td><span><?php echo $formdata['job_location'];?></span></td>

                            </tr>
                            
                            <tr>
                                 <td><span><strong>Download Brochure</strong></span></td>
                                <td><?php if(file_exists('uploads/brochure/'.$formdata['brochure']) && $formdata['brochure']!=''){?>
                                <a href="<?php echo $upload_root.'uploads/brochure/'.$formdata['brochure'];?>" target="_blank">Download</a>
                                <?php } ?></td>
                                <td><span>Vacancies</span></td>
                                <td><span><?php echo $formdata['vacancies'];?></span></td>

                            </tr>
                           
                            <tr>
                                 <td><span><strong>Resident Location</strong></span></td>
                                <td><span><?php echo $formdata['res_location'];?></span></td>
                                <td><span>Job Posting Date</span></td>
                                <td><span>Date</span></td>

                            </tr>
                            
                            <tr>
                                <td><span><strong>Nationality</strong></span></td>
                                <td><span><?php echo $formdata['country_name'];?></span></td>
                                <td><span>Expires on</span></td>
                                <td><span>Date</span></td>

                            </tr>
                           
                            <tr>
                                 <td><span><strong>Gender</strong></span></td>
                                <td><span>
                                <?php if($formdata['gender']==1)echo 'Male'; else echo 'Female';?>
                                </span></td>
                                <td>Exp. join date</td>
                                <td>Date</td>
                              
                            </tr>
                            
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    	</tbody>
            		</table>
             	 </td>
       		</tr>

<?php  if(!empty($active_seekers)) { ?>

    
            <tr>
              <td colspan="2" align="center" valign="top">
                <div class="tab-head mar-spec">
                  <h3>Job Seekers List</h3>
                </div>
               
              </td>
</tr>

<tr id="candidate_applied">
    <td colspan="2" align="center" valign="top">
    
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">

      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>App. Date</th>
          <th>Admin</th>
        
        </tr>
      </thead>

      <tbody >
        <?php foreach($active_seekers as $candidate){?>
        
        <tr>
          	<td width="24%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a>
</td>          
            <td width="14%"><?php echo $candidate['mobile'];?>
</td> 
            <td width="14%"><?php echo $candidate['username'];?>
 </td>
          
          <td width="12%"><?php echo $candidate['applied_on'];?>
</td>
          <td width="11%">sad</td>

          
          </tr>
     	<tr>
         <td colspan="5">
         <table width="100%" border="0">
  <tbody>
    <tr>
      <td valign="middle" align="left">   CTC == <strong><?php if($candidate['current_ctc']!='')echo $candidate['current_ctc'];else echo 'Nil'; ?></strong> | ECTC== <strong><?php if($candidate['expected_ctc']!='')echo $candidate['expected_ctc'];else echo 'Nil'; ?></strong> | NP== <strong><?php if($candidate['notice_period']!='')echo $candidate['notice_period'];else echo 'Nil'; ?></strong> | Exp== <strong><?php if($candidate['total_experience']!='')echo $candidate['total_experience'];else echo 'Nil'; ?></strong></td>
     
      <td valign="middle" align="right">

<a href="javascript:;" title="Send Job Description by Email"  data-url="<?php echo base_url(); ?>jobs/send_jd/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="send_jd"><span class="label label-default"><i class="fa fa-envelope" aria-hidden="true"></i></span></a>&nbsp;
            
<a href="<?php echo base_url(); ?>index.php/candidates_all/edit/<?php echo $candidate['candidate_id'];?>/" title="Edit Candidate Profile" target="_blank"  id="view_cv" class="btn btn-danger btn-xs btn-icon"><i class="fa fa-edit" aria-hidden="true"></i></a>

<a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" title="View Candiadte Summary" target="_blank" class="btn btn-xs btn-primary btn-icon"><i class="fa fa-eye" aria-hidden="true"></i></a>

<a href="<?php echo base_url();?>index.php/candidates_all/print_cv/<?php echo $candidate['candidate_id']?>"  title="Print CV" target="_blank" class="btn btn-xs btn-success btn-icon"><i class="fa fa-print" aria-hidden="true"></i></a>

<?php if($candidate['cv_file']!=''){?>
<a href="<?php echo base_url();?>index.php/candidates_all/download_cv/<?php echo $candidate['candidate_id']?>" title="Download CV" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i> CV</a>
<?php } ?>

<?php if($candidate['linkedin_url']!=''){?>
	<a href="<?php echo $candidate['linkedin_url']?>" title="View Linkedin Profile" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i>Lin</a>
<?php } ?>

  <!--   
            <span class="label label-default" title="Education"><i class="fa fa-book" aria-hidden="true"></i></span>
            
            &nbsp;
            <span class="label label-default" title="Skills"><i class="fa fa-star" aria-hidden="true"></i></span>
            &nbsp;
            <span class="label label-default" title="Experience"><i class="fa fa-trophy" aria-hidden="true"></i></span>
            
            -->

</td>
    </tr>
  </tbody>
</table>

      
                  
         </td>

        </tr>
          
          
       	<?php } ?>
        </tbody>
    </table>
    
	 </td>
</tr>

<?php } ?> 


                        
</tbody>
</table>


</div>
</div>
</section>


<script type="text/javascript">

$('input[type=text]').addClass('form-control');



$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});


</script>