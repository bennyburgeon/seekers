
 <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>candidates_own/update_job_vacancy" id="job_assignment_form" name="assignment_form"> 
        <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id?>">
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

<input type="button" value="Submit" data-url="<?php echo $this->config->site_url();?>candidates_own/update_job_vacancy" id="save_job_app_button" >
</form>