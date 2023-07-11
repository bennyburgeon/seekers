
<tr id="tm_<?php echo $followup_list['tkt_fp_id'] ?>">
<td class="ticket-border"><span class="bd-font"><span class="bd-font">Title:</span><?php echo $followup_list['title'] ?></span><br /><span class="bd-font">Date:</span><?php echo $followup_list['tkt_fp_date'] ?></td>
<td><?php echo $followup_list['tkt_fp_description'] ?></td>
<td><input type="button" id="<?php echo $followup_list['tkt_fp_id'] ?>" onClick="del(this.id)" value="Delete"></td>

</tr>

	