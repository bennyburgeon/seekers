<form class="form-horizontal form-bordered"  method="post" id="add_consultant_feedback_frm"  action="<?php echo $this->config->site_url();?>candidates_apps/add_candidates_messages/<?php echo $candidate_id;?>"  name="add_consultant_feedback_frm" onSubmit="return validate();">
  <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id;?>">
  <table class="hori-form">
    <tbody>
     
      <tr>
        <td>Messages</td>
        <td><?php echo form_textarea(array('name'=>'message_text', '', 'id'=>'message_text','style' => 'width:600px;height:50px;'));?></td>
      </tr>
      <tr>
        <td colspan="2"><span class="click-icons">
          <input type="submit" class="attach-subs" value="Send" id="save_to_message" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/notifications/add" />
          </span></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="1">
            <tbody>
              <tr>
                <td>#</td>
                <td>Messages</td>
                <td>Sent By</td>
                <td>Date</td>
              </tr>
              <?php 
	$i=0;
	foreach($message_list as $key => $val)
	{
		$i+=1;
	?>
              <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $val['message_text'];?></td>
                <td><?php if($val['admin_id']>0)echo $val['firstname'];else echo 'Me'?></td>
                <td><?php echo $val['message_date'];?></td>
              </tr>
              <?php 
	} 
	?>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</form>
<script>
var teamnum = 0;
function validate()
{
	
	if($('#message_text').val()=='')
	{
		alert('Enter Messages');
		$('#message_text').focus();
		return false;
	}
	
	return true;
}
</script>