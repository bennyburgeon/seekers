<div class="tasks profile">
<div id="responseapp"></div>
<div class="slider_redesign" id="tr_<?php echo $aplication_list['app_id'];?>">
<div class="side_adj second">

<h2>University Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $aplication_list['univ_name'];?></h2>
<h2>Course Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $aplication_list['course_name'];?></h2>

<h2>Application Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $aplication_list['status_name'];?></h2>
<h2>Applicatibn Details:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $aplication_list['app_details'];?></h2>

<div class="date_edit">
<span class="dates">Created On: <?php echo $aplication_list['app_created'];?></span>
<span class="edit_delete">
<a href="<?php echo base_url();?>index.php/candidates_all/candidate_programs/<?php echo $aplication_list['candidate_id'];?>?app_id=<?php echo $aplication_list['app_id'];?>"><img src="<?php echo base_url('assets/images/profile_edit.png');?>"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $aplication_list['app_id'];?>" onClick="return app_validate(this.id)" >
</span>

</div>
</div>
</div>

</div>
