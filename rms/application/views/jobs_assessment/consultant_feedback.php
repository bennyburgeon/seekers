<form class="form-horizontal form-bordered"  method="post" id="add_consultant_feedback_frm"  action="<?php echo $this->config->site_url();?>/jobs_assessment/add_consultant_feedback/<?php echo $candidate_id;?>"  name="add_consultant_feedback_frm"> 
            
             		<input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id;?>">
                    <input type="hidden" name="job_id" id="candidate_id" value="<?php echo $job_id;?>">
                    
                <table class="hori-form">
                <tbody>

				<tr>
                   <td>Education</td>
                   <td><?php echo form_textarea(array('name'=>'feedback_education', 'value' => $feedback['feedback_education'], 'id'=>'feedback_education','style' => 'width:600px;height:50px;'));?></td>
                 </tr>

				<tr>
                   <td>Experience</td>
                   <td><?php echo form_textarea(array('name'=>'feedback_industry','value' => $feedback['feedback_industry'], 'id'=>'feedback_industry','style' => 'width:600px;height:50px;'));?></td>
                 </tr>
                 
				<tr>
                   <td>Skills</td>
                   <td><?php echo form_textarea(array('name'=>'feedback_skills', 'value' => $feedback['feedback_skills'], 'id'=>'feedback_skills','style' => 'width:600px;height:50px;'));?></td>
                 </tr>

				<tr>
                   <td>Salary</td>
                   <td><?php echo form_textarea(array('name'=>'feedback_salary', 'value' => $feedback['feedback_salary'], 'id'=>'feedback_salary','style' => 'width:600px;height:50px;'));?></td>
                 </tr>
                 

				<tr>
                   <td>General</td>
                   <td><?php echo form_textarea(array('name'=>'feedback_general','value' => $feedback['feedback_general'], 'id'=>'feedback_general','style' => 'width:600px;height:50px;'));?></td>
                 </tr>
                                                                                    
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="submit" class="attach-subs" value="Update Feedback" id="save_to_short_list" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs_assessment/add_consultant_feedback" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>

