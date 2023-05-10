<form class="form-horizontal form-bordered"  method="post" id="add_candidates_tasks"  action="<?php echo $this->config->site_url();?>candidates_dir/add_candidates_tasks/<?php echo $candidate_id;?>"  name="add_candidates_tasks">
  <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id;?>">
  <input type="hidden" name="task_id" id="task_id" value="">
    <input type="hidden" name="edit_flag" id="edit_flag" value="">
  <table class="hori-form">
    <tbody>
      <tr>
        <td>Task Title</td>
        <td><input name="task_title" type="text" class="form-control" id="task_title" value="" maxlength="200" placeholder="Enter Your Task Title" /></td>
      </tr>
      <tr>
        <td>Start Date</td>
        <td><input type="text" id="start_date" class="datepicker form-control p m-ctrl-medium date-picker" name="start_date" value="" placeholder="Start Date" /></td>
      </tr>
      <tr>
        <td>Due Date</td>
        <td><input type="text" id="due_date" class="form-control m-wrap m-ctrl-medium date-picker" name="due_date" value="" placeholder="Due Date" /></td>
      </tr>
      <tr>
        <td>Task Priority</td>
        <td><?php echo form_dropdown('task_priority_id',  $task_priority_list,'','class="form-control" id="task_priority_id"');?></td>
      </tr>
      <tr>
        <td>Task Status</td>
        <td><?php echo form_dropdown('task_status_id',  $task_status_list,'','class="form-control" id="task_status_id"');?></td>
      </tr>
      <tr>
        <td>Task Description</td>
        <td><?php echo form_textarea(array('name'=>'task_desc', '', 'id'=>'task_desc','style' => 'width:600px;height:50px;'));?></td>
      </tr>
      <tr>
        <td>Admin user</td>
        <td><?php echo form_dropdown('admin_id',  $admin_list,'','class="form-control" id="admin_id"');?></td>
      </tr>
      <tr>
      <tr>
        <td colspan="2"><span class="click-icons">
          <input type="submit" class="attach-subs" value="Add Task" id="save_tasks" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>candidates_dir/add_candidates_tasks" />
                  <input type="button" class="attach-subs" data-dismiss="modal"  value="Cancel" id="cancel_task" style="width:180px;" />
          </span></td>
      </tr>
      <tr>
        <td colspan="2"><table width="100%" border="1">
            <tbody>
              <tr>
                <th>Task Title</th>
                <th>Priority</th>
                <th>User</th>
                <th>Created</th>
                <th>Status</th>
                <th>Start </th>
                <th>Due On</th>
                <th>Due Days</th>
                <th>Last Flp Dt.</th>
                <th>Actions</th>
              </tr>
              <?php 
	$i=0;
	foreach($task_list as $key => $val)
	{
		$i+=1;
	?>
              <tr>
               <td><?php echo $val["task_title"]; ?></td>
                  <td ><?php if($val["task_priority_id"]==1){ echo '<font color="#FF0000">'; echo $val["task_priority_name"];echo '</font>';}else{echo $val["task_priority_name"];} ?></td>
                  <td ><?php echo $val["username"]; ?></td>
                  <td ><?php echo $val["creator"]; ?></td>
                  <td><?php if($val["task_status_id"]==1){ echo '<font color="#FF0000">'; echo $val["task_status_name"];echo '</font>';}else{echo '<font color="#2A9E21">'; echo $val["task_status_name"]; } ?></td>
                  <td><?php if($val["start_date"]!='0000-00-00')echo date('d M',strtotime ($val["start_date"]));else echo 'Na';?></td>
                  <td><?php if($val["due_date"]!='0000-00-00')echo date('d M',strtotime ($val["due_date"]));else echo 'Na';?></td>
                 
                  <td><?php if($val["flp_date_diff"]<0){?>
                    <font color="#FF0000"><?php echo $val["flp_date_diff"];?></font>
                    <?php }else{?>
                    <?php echo $val["flp_date_diff"];?>
                    <?php } ?></td>
                  <td><?php if($val["last_flp_date"]!=''){echo date('d M',strtotime ($val["last_flp_date"]));}else echo 'No Update';?></td>
                  
                  <td><a href="javascript:;"  data-url="<?php echo base_url(); ?>candidates_dir/edit_task/?task_id=<?php echo $val['task_id'];?>&candidate_id=<?php echo $val['candidate_id'];?>"  id="edit_task" class="btn btn-primary btn-xs">Edit</a>
                   <a href="<?php echo base_url();?>candidates_dir/delete_task/<?php echo $val['task_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
                   
                  
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

$('#start_date').datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	yearRange: "c-100:c+100"
	});
	
$('#due_date').datepicker({
	dateFormat: "yy-mm-dd",
	changeMonth: true,
	changeYear: true,
	yearRange: "c-100:c+100"
	});

</script>