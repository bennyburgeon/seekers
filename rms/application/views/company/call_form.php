<div class="col-md-15">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company/add_calls" id="calls_form" name="calls_form"> 
            
             		<input type="hidden" name="company_id" id="company_id" value="<?php echo $company_id;?>">
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Call Status</td>
                   <td>
                   
                    <input id="flp_status" type="radio" name="flp_status" value="1"  />Contact Updated & Profile Sent<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="2"/>Followed up - Call Later<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="3"/>Positive Response - Need Follow up<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="4"/>Meeting Arranged & Proposal Sent<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="5"/>Active Client - Have Business<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="6"/>Inactive Client - Need Follow up<br>
                    <input id="flp_status" type="radio" name="flp_status" value="7"/>No Need to Follow up

   			 </td>
                 </tr>

                <tr>
                  <td>Lead Status</td>
                  <td>                   
                    <input id="status" type="radio" name="status" value="1" />
                    Feed<br>                    
                    <input id="status" type="radio" name="status" value="2"/>
                    Lead<br>                    
                    <input id="status" type="radio" name="status" value="3"/>
                    Client
                    <br>
                    <input id="status" type="radio" name="status" value="4"/>Not Qualified<br>                    
                   </td>
                </tr>
                <tr>
                  <td>Priority</td>
                  <td><?php echo form_dropdown('company_priority',  $company_priority_list,'','class="form-control" id="company_priority"');?></td>
                </tr>
                <tr>
                  <td>Rate This Company</td>
                  <td><?php echo form_dropdown('company_rating',  $company_rating_list,'','class="form-control" id="company_rating"');?></td>
                </tr>
                <tr>
                <td>Call Date</td>
                 <td><input type="text" name="flp_date" value="<?php echo date('Y-m-d');?>" class="smallinput datepicker" id="flp_date"  /></td>
                </tr>
                                
                <tr>
                <td>Next Follow-up Date</td>
                 <td><input type="text" name="flp_next_date" value="<?php echo date('Y-m-d',strtotime("+7 day")); ;?>" class="smallinput datepicker" id="flp_next_date"  /></td>
                </tr>
                
                <tr>

                <td>Notes</td>
                 <td><?php echo form_input(array('name'=>'flp_notes', 'id'=>'flp_notes','class' => 'smallinput'));?> </td>
                </tr>

				 <tr>
                  <td>&nbsp;</td>
                 <td><?php echo form_checkbox(array('name'=>'create_task', 'value' => '1', 'id'=>'create_task','class' => 'smallinput'));?> Create Task</td>
                </tr>

				 <tr>
                  <td>Task Title</td>
                 <td><?php echo form_input(array('name'=>'task_title', 'id'=>'task_title','class' => 'smallinput'));?> </td>
                </tr>                                

				 <tr>
                  <td>Task Details</td>
                 <td><?php echo form_input(array('name'=>'task_desc', 'id'=>'task_desc','class' => 'smallinput'));?> </td>
                </tr> 

 				<tr>
                <td>Due On</td>
                 <td><input type="text" name="due_date" value="<?php echo date('Y-m-d',strtotime("+7 day")); ;?>" class="smallinput datepicker" readonly id="due_date"  /></td>
                </tr>
                
				 <tr>
                  <td> Assign Task To</td>
                 <td><?php echo form_dropdown('admin_id',  $admin_list,'','class="form-control" id="admin_id"');?> </td>
                </tr>
                                                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_calls" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/company/add_calls" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>            
            </form>
			
  </div>