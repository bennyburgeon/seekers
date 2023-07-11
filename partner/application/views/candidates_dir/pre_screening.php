
<table width="100%" border="1">
  <tbody>
    <tr>
      <td width="50%">Jobs List - Select jobs from here and add the candidate to those jobs.</td>
      <td width="50%">Candidate Profile</td>
    </tr>
    <tr>
    
      <td  width="50%" align="left" valign="top">
      
      <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>candidates_dir/update_job_vacancy" id="job_assignment_form" name="assignment_form">
          <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id?>">
          <div style="max-height: 500px; overflow-x: auto;" >
          <?php 
foreach($jobs_list as $key => $val)
{
?>
          <?php if($val['total_apps']>0){?>
          <p href="javascript:;" class="btn btn-danger btn-xs"> Applied</p>
          <input type="checkbox" disabled name="job_id[]" value="<?php echo $val['job_id'];?>">
          <?php }else{?>
          <input type="checkbox" name="job_id[]" value="<?php echo $val['job_id'];?>">
          <?php } ?>
          &nbsp;<?php echo $val['job_title'];?><br>
          <?php } ?>
          <br>
          </div>
          <input style="margin-left: 30%;" type="button" value="Add To These Jobs" data-url="<?php echo $this->config->site_url();?>candidates_dir/update_job_vacancy" id="save_job_app_button" >
        </form>
         
         </td>
       
      <td align="left" valign="top"  width="50%">
      
      <form class="form-horizontal form-bordered"  method="post" id="pre_screening_form" name="pre_screening_form" action="<?php echo $this->config->site_url();?>candidates_dir/add_pre_screening">
          <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>" />
          <input type="hidden" name="pre_screen_id" id="pre_screen_id" value="<?php echo $pre_screening['pre_screen_id'] ;?>" />
          Full Name:
          <input type="text" name="first_name" value="<?php echo $pre_screening['first_name'];?>" style="margin-left: 14%; margin-bottom: 2%; width: 60%;" />
          <br>
          Mobile:
          <input type="text" name="mobile" value="<?php echo $pre_screening['mobile'];?>" style="margin-left: 18%; margin-bottom: 2%; width: 60%;" />
          <br>
          Recruiter Name: <?php echo form_dropdown('admin_id', $admin_list, $pre_screening['admin_id'],'id="admin_id",  style="margin-left: 7%; margin-bottom: 2%; width: 60%;" ');?> <br>
          Company: <?php echo form_dropdown('company_id', $company_list, $pre_screening['company_id'],'id="company_id", style="margin-left: 15%; margin-bottom: 2%; width: 60%;" ');?> <br>
          Pre Screen Date:
          <input type="text" class="datepicker" name="pre_screen_date" placeholder="Select Date" value="<?php echo ($pre_screening['pre_screen_date']!='0000-00-00' && $pre_screening['pre_screen_date']!='') ? date('d-m-Y', strtotime($pre_screening['pre_screen_date'])) : '';?>"  style="margin-left: 6%; margin-bottom: 2%; width: 60%;"/>
          <br>
          Pre Screen Time:
          <input type="text" name="pre_screen_time" value="<?php echo $pre_screening['pre_screen_time'];?>" style="margin-left: 6%; margin-bottom: 2%; width: 60%;" />
          <br>
          Pre Screen Venue:
          <input type="text" name="pre_screen_venue" value="<?php echo $pre_screening['pre_screen_venue'];?>" style="margin-left: 4%; margin-bottom: 2%; width: 60%;" />
          <br>
          Payment Status:
          <input style="margin-left: 7%;" type="radio" name="payment_status" value="1" <?php if($pre_screening['payment_status']==1) echo 'checked';?> />
          Paid
          <input type="radio" name="payment_status" value="2" <?php if($pre_screening['payment_status']==2) echo 'checked';?> />
          Unpaid <br>
          Arrival Date:
          <input type="text" class="datepicker" name="arrival_date" placeholder="Select Arrival Date" value="<?php echo ($pre_screening['arrival_date']!='0000-00-00' && $pre_screening['arrival_date']!='') ? date('d-m-Y', strtotime($pre_screening['arrival_date'])) : '';?>" style="margin-left: 13%; margin-bottom: 2%; width: 60%;" />
          <br>
          Knowledge Level:
          <input style="margin-left: 7%;" type="radio" name="knowledge_level" value="1" <?php if($pre_screening['knowledge_level']==1) echo 'checked';?> />
          Good
          <input type="radio" name="knowledge_level" value="2" <?php if($pre_screening['knowledge_level']==2) echo 'checked';?> />
          Average
          <input type="radio" name="knowledge_level" value="3" <?php if($pre_screening['knowledge_level']==3) echo 'checked';?> />
          Not Good <br>
          Candidate Description:
          <input type="text" name="pre_screen_feedback" value="<?php echo $pre_screening['pre_screen_feedback'];?>" style="margin-left: 0%; margin-bottom: 2%; width: 60%;" />
          <br>
          Feedback:
          <input style="margin-left: 7%;" type="radio" name="feedback_status" value="1" <?php if($pre_screening['feedback_status']==1) echo 'checked';?> />
          Confirm
          <input type="radio" name="feedback_status" value="2" <?php if($pre_screening['feedback_status']==2) echo 'checked';?> />
          May be Come
          <input type="radio" name="feedback_status" value="3" <?php if($pre_screening['feedback_status']==3) echo 'checked';?> />
          Not Interested
          <input type="radio" name="feedback_status" value="4" <?php if($pre_screening['feedback_status']==4) echo 'checked';?> />
          Follow up <br><br>
          <input type="submit" class="attach-subs" value="Add Pre Screening" id="save_pre_screening" style="width:180px; margin-left: 30%;"data-url="<?php echo $this->config->site_url();?>candidates_dir/add_pre_screening" />
          <br>
        </form></td>
    </tr>
  </tbody>
</table>
<script>           
$('.datepicker').datepicker({
		format : "dd-mm-yyyy",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});
</script>
