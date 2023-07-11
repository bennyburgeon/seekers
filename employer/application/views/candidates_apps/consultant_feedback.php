<form class="form-horizontal form-bordered"  method="post" id="add_consultant_feedback_frm"  action="<?php echo $this->config->site_url();?>/candidates_apps/add_consultant_feedback/<?php echo $candidate_id;?>"  name="add_consultant_feedback_frm"> 
            
             		<input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id;?>">
                    
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
                   <td>Candidate Package</td>
                   <td><?php echo form_dropdown('package_id', $package_list, $feedback['package_id'],'class="form-control hori" id="package_id"');?></td>
                 </tr>

				<tr>
                   <td colspan="2"><table width="100%" border="0">
                     <tbody>
                       <tr>
                         <td>CTC</td>
                         <td>Exp. CTC</td>
                         <td>Notice Period</td>
                         <td>Total Experience</td>
                       </tr>
                       <tr>
                         <td><input style="width:150px;" placeholder="CTC"  type="text"  name="current_ctc" value="<?php if(isset($feedback['current_ctc'])) echo $feedback['current_ctc']?>" id="current_ctc"></td>
                         <td><input style="width:150px;" placeholder="Exp. CTC"  type="text"  name="expected_ctc" value="<?php if(isset($feedback['expected_ctc'])) echo $feedback['expected_ctc']?>" id="expected_ctc"></td>
                         <td><input style="width:150px;" placeholder="Notice Period"  type="text"  name="notice_period" value="<?php if(isset($feedback['notice_period'])) echo $feedback['notice_period']?>" id="notice_period"></td>
                         <td><input style="width:150px;" placeholder="Total Exp."  type="text"  name="total_experience" value="<?php if(isset($feedback['total_experience'])) echo $feedback['total_experience']?>" id="total_experience"></td>
                       </tr>
                     </tbody>
                   </table></td>
                   
                 </tr>

				<tr>
                   <td colspan="2"><table width="100%" border="0">
                     <tbody>
                       <tr>
                         <td>10th Marks - Maths</td>
                         <td>12th Marks - Maths</td>
                         <td>Grad. Marks - Maths</td>
                         <td>PG. Marks - Maths</td>
                       </tr>
                       <tr>
                         <td><input style="width:150px;" placeholder="10th"  type="text"  name="maths_10th" value="<?php if(isset($feedback['maths_10th'])) echo $feedback['maths_10th']?>" id="maths_10th"></td>
                         <td><input style="width:150px;" placeholder="12th"  type="text"  name="maths_12th" value="<?php if(isset($feedback['maths_12th'])) echo $feedback['maths_12th']?>" id="maths_12th"></td>
                         <td><input style="width:150px;" placeholder="Grad."  type="text"  name="maths_grad" value="<?php if(isset($feedback['maths_grad'])) echo $feedback['maths_grad']?>" id="maths_grad"></td>
                         <td><input style="width:150px;" placeholder="PG."  type="text"  name="maths_post_grad" value="<?php if(isset($feedback['maths_post_grad'])) echo $feedback['maths_post_grad']?>" id="maths_post_grad"></td>
                       </tr>
                     </tbody>
                   </table></td>
                   
                 </tr>
                                                                                                                      
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="submit" class="attach-subs" value="Update Feedback" id="save_to_short_list" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/jobs/add_consultant_feedback" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            
            </form>

