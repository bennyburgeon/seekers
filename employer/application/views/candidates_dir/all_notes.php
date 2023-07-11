<form class="form-horizontal form-bordered"  method="post" id="add_consultant_feedback_frm"  action="<?php echo $this->config->site_url();?>/candidates_dir/add_candidates_notes/<?php echo $candidate_id;?>"  name="add_consultant_feedback_frm"> 
            
             		<input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id;?>">
                    
                <table class="hori-form">
                <tbody>

				<tr>
                   <td>Title</td>
                   <td><?php echo form_textarea(array('name'=>'title', '', '','style' => 'width:600px;height:50px;'));?></td>
                 </tr>

				<tr>
                   <td>Notes</td>
                   <td><?php echo form_textarea(array('name'=>'notes', '', '','style' => 'width:600px;height:50px;'));?></td>
                 </tr>

<tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="submit" class="attach-subs" value="Update Feedback" id="save_to_short_list" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs/add_consultant_feedback" />
                 
                  </span>
                  </td>
                </tr>			

				<tr>
                   <td colspan="2">
                   
                   <table width="100%" border="1">
  <tbody>
    <tr>
      <td>#</td>
      <td>Title</td>
      <td>Notes</td>
      <td>Date</td>
    </tr>
    <?php 
	$i=0;
	foreach($note_list as $key => $val)
	{
		$i+=1;
	?>
    <tr>
     <td><?php echo $i;?></td>
      <td><?php echo $val['title'];?></td>
      <td><?php echo $val['notes'];?></td>
      <td><?php echo $val['note_date'];?></td>
     
    </tr>
    <?php 
	} 
	?>    
  </tbody>
</table>
   
                   
                   
                   </td>
                   
                 </tr>
                                                                                                                      
                
                </tbody>
                </table>
            
            </form>

