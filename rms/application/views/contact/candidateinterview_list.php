<div class="tasks profile">
<div id="response2"></div>
<div class="slider_redesign" id="tr_<?php echo $interview_list['interview_id'];?>">
<div class="side_adj second">

<h2>Interview title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list['title'];?></h2>
<h2>Description:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list['description'];?></h2>
<h2>Interview Date:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list['interview_date'];?></h2>
<h2>Interview Time:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list['interview_time'];?></h2>
<h2>Duration:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list['duration'];?></h2>
<h2>Interview Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list['interview_type'];?></h2>
<h2>Interview Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $interview_list['int_status_name'];?></h2>
<h2>Interview Location:&nbsp;<?php echo $interview_list['location'];?></h2>
<div class="date_edit">
<span class="dates">21 Jun 2015 at 02:30 PM</span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $interview_list['interview_id'];?>" onClick="return int_validate(this.id)" >
</span>

</div>
</div>
</div>

</div>
