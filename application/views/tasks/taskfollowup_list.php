<tr id="tr_<?php echo $followup_list['task_fl_id'] ?>">
<td><?php echo $followup_list['task_fl_title'] ?></td>
<td><?php echo $followup_list['task_fl_desc'] ?></td>
<td><?php echo $followup_list['task_fl_date'] ?></td>
<td><?php echo $followup_list['task_status'] ?></td>
<td><input type="button" id="<?php echo $followup_list['task_fl_id'] ?>" onClick="del(this.id)" value="Delete"></td>
</tr>
