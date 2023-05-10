
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered" action="<?php echo $this->config->site_url();?>/candidates_all/add_calls"  method="post" id="calls_form" name="calls_form"> 
            
             		<input type="hidden" name="candidate_id" id="call_candidate_id" value="<?php echo $candidate_id?>">
               
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Present Job Status</td>
                   <td>
                   
                    <input id="call_cur_job_status" type="radio" name="call_cur_job_status" value="1"  checked="checked" />No Job <br>                    
                    <input id="call_cur_job_status" type="radio" name="call_cur_job_status" value="2"/>Working, But Need a Change <br>                    
                    <input id="call_cur_job_status" type="radio" name="call_cur_job_status" value="3"/>Not Interested <br>                    
                    <input id="call_cur_job_status" type="radio" name="call_cur_job_status" value="4"/>Seeking Good Opportunity <br>                    
                    <input id="call_cur_job_status" type="radio" name="call_cur_job_status" value="5"/>Need a change <br>                    
                    <input id="call_cur_job_status" type="radio" name="call_cur_job_status" value="6"/>Call after 1 Year <br>
                    <input id="call_cur_job_status" type="radio" name="call_cur_job_status" value="7"/>Call after this month                     
    </td>
                 </tr>
                
                <tr>
                <td>Call Date</td>
                 <td><input type="text" name="call_date" class="smallinput datepicker" readonly id="datepicker" value="<?php echo date('Y-d-m');?>"  /></td>
                </tr>
                
                <tr>
                <td>Call Time</td>
                 <td><?php echo form_dropdown('call_time', $interview_time_ar);?></td>
                </tr>
                
                <tr>

                <td>Notes</td>
                 <td><?php echo form_input(array('name'=>'call_notes', 'id'=>'call_notes','class' => 'smallinput'));?> </td>
                </tr>
                
                <!-- 
                <tr>
                  <td colspan="2"><table width="100%" border="0">
                    <tbody>
                      <tr>
                        <td><input type="text" name="cur_ctc" class="smallinput" placeholder="Cur CTC"  /></td>
                        <td><input type="text" name="exp_ctc" class="smallinput" placeholder="EXP CTC" /></td>
                        <td><input type="text" name="exp_years" class="smallinput" placeholder="Total Exp" /></td>
                        <td><input type="text" name="notice_period" class="smallinput" placeholder="Notice"  /></td>
                      </tr>
                    </tbody>
                  </table></td>
                </tr>
                
                -->
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_calls" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/candidates_all/add_calls" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>

<table border="1">
    <tr>
        <td>Date</td>
        <td>Time</td>
        <td>Notes</td>
        <td>Job Status</td>
       <td> Updated By</td>
    </tr>
 <?php 		
if(count($records)>0)
{
	foreach($records as $key => $result){ 
?>   
    
      <tr>
        <td><?php echo $result['call_date'];?></td>
        <td><?php echo $result['call_time'];?></td>
        <td><?php echo $result['call_notes'];?></td>
         
        <td>
		<?php 
		if($result['cur_job_status']==0)echo 'Not Updated';
		if($result['cur_job_status']==1)echo 'No Job';
		if($result['cur_job_status']==2)echo 'Working, But Need a Change';
		if($result['cur_job_status']==3)echo 'Not Interested';
		if($result['cur_job_status']==4)echo 'Seeking Good Opportunity';
		if($result['cur_job_status']==5)echo 'Need a change ';
		if($result['cur_job_status']==6)echo 'Call after 1 Year';
		if($result['cur_job_status']==7)echo 'Call after this month ';?>
        </td>
        <td><?php echo $result['firstname'];?></td>
    </tr>
  <?php }} ?>
</table>


	
 