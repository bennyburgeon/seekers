
<a href="#"  onClick="manage_shift_vacancy(1,<?php echo $prev_month;?>,<?php echo $prev_year;?>);" >Previous Month</a> ||  

<a href="#"  onClick="manage_shift_vacancy(1,<?php echo $next_month;?>,<?php echo $next_year;?>);" >Next</a><br>
        
        
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>interviews/update_shift_vacancy" id="assignment_form" name="assignment_form"> 
        <input type="hidden" name="candidate_id" id="candidate_id" value="1">
        <input type="hidden" name="year" value="<?php echo $cur_year?>">
        <input type="hidden" name="month" value="<?php echo $cur_month?>">
<?php 
echo $calendar;
?>
         <span class="click-icons">
                  <input type="button" class="attach-subs" value="Update" id="save_schedule_button" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>interviews/update_shift_vacancy" />
                  </span>
</form>
