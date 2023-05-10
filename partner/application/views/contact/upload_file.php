<div class="tasks profile">
<div id="imgTab"></div>
<div class="slider_redesign" id="tr_<?php echo $upload_list['file_id'];?>">
<div class="side_adj second">

<h2>File Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $upload_list['file_name'];?></h2>
<h2>File Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url().'upload/files/'.$upload_list['file_type'];?>" /><?php echo $upload_list['file_type'];?></a></h2>
<div class="date_edit">
<span class="dates">21 Jun 2015 at 02:30 PM</span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $upload_list['file_id'];?>" onClick="return img_validate(this.id)" >
</span>

</div>
</div>
</div>

</div>