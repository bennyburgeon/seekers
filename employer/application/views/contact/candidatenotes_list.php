<div class="tasks profile">
<div id="response1"></div>
<div class="slider_redesign" id="tr_<?php echo $note_list['candidate_note_id'];?>">
<div class="side_adj second">

<h2>Note Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $note_list['title'];?></h2>
<h2>Note Description:&nbsp;&nbsp;<?php echo $note_list['notes'];?></h2>
<div class="date_edit">
<span class="dates">21 Jun 2015 at 02:30 PM</span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" onClick="return note_validate(this.id)" id="<?php echo $note_list['candidate_note_id'];?>" >
</span>

</div>
</div>
</div>

</div>