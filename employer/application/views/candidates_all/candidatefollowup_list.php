<div id="response"></div>

<div class="slider_redesign" id="tr_<?php echo $single_list['candidate_follow_id'];?>">
<div class="side_adj second">

<h2>Followup Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $single_list['title'];?></h2>
<h2>Followup Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $single_list['status_name'];?></h2>
<h2>Followup Application:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $single_list['app_details'];?></h2>
<h2>Followup Description:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $single_list['description'];?></h2>
<div class="date_edit">
<span class="dates"><?php echo $single_list['flp_date'];?></span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $single_list['candidate_follow_id'];?>" onClick="return validate(this.id)" >
</span>

</div>
</div>
</div>

