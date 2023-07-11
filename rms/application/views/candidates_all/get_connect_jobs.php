
<table width="100%" border="1">
  <tbody>
    <tr>
      <td>Jobs List - Select jobs from here and add the candidate to those jobs.</td>
    </tr>
    <tr>
      <td  width="60%" align="left" valign="top"><form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/candidates_all/update_job_vacancy" id="job_assignment_form" name="assignment_form">
          <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id?>">
          
          <div style="overflow: auto;height: 300px;">
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
          <?php echo $val['job_id'];?>&nbsp;<?php echo $val['job_title'];?> 
          <?php /* ?>( <?php echo "<span style='color:#3396d8;'>".$val['company_name']."</span>" ?> ) <?php */ ?>
          <br>
          <?php } ?>
              
              </div>
          <br>
          <input type="button" value="Add To These Jobs" data-url="<?php echo $this->config->site_url();?>/candidates_all/update_job_vacancy" id="save_job_app_button" >
        </form></td>
    </tr>
  </tbody>
</table>
