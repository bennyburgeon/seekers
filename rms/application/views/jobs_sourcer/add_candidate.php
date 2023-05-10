<div class="col-md-12">
<div class="profile_top">
  <div class="profile_top_left"> <a href="<?php echo base_url();?>index.php/jobs_sourcer/manage/<?php echo $formdata['job_id'];?>">Summary</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url();?>index.php/jobs_sourcer/search_candidate/<?php echo $formdata['job_id'];?>">Search Candidates</a> &nbsp;&nbsp;&nbsp; 
    <!-- 
||
&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url();?>index.php/jobs_sourcer/send_mass_mail/<?php echo $formdata['job_id'];?>">Mass Email</a>	&nbsp;&nbsp;&nbsp; 
--> 
    ||&nbsp;&nbsp;&nbsp;
    Add New Candidate</div>
  <div style="clear:both;"></div>
</div>
<div class="col-md-2"></div>
<div class="col-md-8">

<table width="100%" border="0">
    <tbody>
  
  <tr>
    <td align="left" valign="top"><div class="profile_box">
        <h2>Add Candidate</h2>
        <br>
        <form name="quick_form" action="<?php echo base_url().'index.php/jobs_sourcer/add_candidate/';?><?php echo $formdata['job_id'];?>" method="post" onSubmit="return validate();" enctype="multipart/form-data">
          <input type="hidden" name="job_id" value="<?php echo $formdata['job_id'];?>">
          <table width="90%" border="1" bordercolor="#f4f4f4" align="center">
            <tbody>
              <tr>
                <td colspan="2">All detials like Industry, Skills etc will be taken from the JD automatically.</td>
              </tr>
              <tr>
                <td width="40%" align="left" valign="middle">Full Name</td>
                <td width="60%" align="left" valign="middle"><input type="text" class="form-control edu-field" name="first_name" placeholder="Full Name" id="first_name" value="" width="200px;" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle">Mobile</td>
                <td align="left" valign="middle"><input type="text" class="form-control edu-field" name="mobile" placeholder="Mobile" id="mobile" maxlength="11" value="" width="200px;" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle">Email</td>
                <td align="left" valign="middle"><input type="text" class="form-control edu-field" name="username" placeholder="Email" id="username" value="" width="200px;" /></td>
              </tr>
              <tr>
                <td align="left" valign="middle">Linkedin Profile</td>
                <td align="left" valign="middle"><input type="text" name="linkedin_url" class="form-control edu-field" placeholder="Linkedin" id="linkedin_url" value="" width="200px;" /></td>
              </tr>
            <strong> </strong>
            <tr>
              <td align="left" valign="middle">Highest Edu. Level</td>
              <td align="left" valign="middle"><select name="level_id" class="form-control edu-field" id="level_id">
                  <option value="" selected="selected">Select Education Level</option>
                  <option value="16">Certificate Course</option>
                  <option value="14">Diploma</option>
                  <option value="11">Graduate</option>
                  <option value="12">HSC</option>
                  <option value="10">Post Graduate</option>
                  <option value="15">Research</option>
                  <option value="13">SSLC</option>
                </select></td>
            </tr>
            <tr>
              <td align="left" valign="middle">Highest Edu.</td>
              <td align="left" valign="middle"><input type="text" name="course_name" class="form-control edu-field" placeholder="Education" id="course_name" value="" width="200px;" /></td>
            </tr>
            <tr>
              <td align="left" valign="middle">Present Company</td>
              <td align="left" valign="middle"><input type="text" name="company" class="form-control edu-field" placeholder="Company" id="company" value="" width="200px;" /></td>
            </tr>
            <tr>
              <td align="left" valign="middle">Designation</td>
              <td align="left" valign="middle"><input type="text" name="designation" class="form-control edu-field" placeholder="Designation" id="designation" value="" width="200px;" /></td>
            </tr>
            <tr>
              <td align="left" valign="middle">Date Period</td>
              <td align="left" valign="middle"><table width="90%" border="0">
                  <tbody>
                    <tr>
                      <td>From&nbsp;</td>
                      <td><input type="text" name="start_date" placeholder="yyyy-mm-dd" class="datepicker"  value="" width="100px;" readonly /></td>
                      <td>To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td><input type="text" name="end_date" placeholder="yyyy-mm-dd" class="datepicker"  value="" width="100px;" readonly /></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"></td>
            </tr>
            <tr>
              <td align="left" valign="middle">CTC &amp; Exp.</td>
              <td align="left" valign="middle"><table width="90%" border="0">
                  <tbody>
                    <tr>
                      <td>Cur.&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td><input type="text" name="cur_ctc" placeholder="Cur. CTC" id="cur_ctc" value="" width="100px;" /></td>
                      <td>Exp CTC.</td>
                      <td><input type="text" name="exp_ctc" placeholder="Expected CTC" id="exp_ctc" value="" width="100px;" /></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"></td>
            </tr>
            <tr>
              <td align="left" valign="middle">Notice Period &amp; Exp.</td>
              <td align="left" valign="middle"><table width="90%" border="0">
                  <tbody>
                    <tr>
                      <td>Notice</td>
                      <td><input type="text" name="notice_period" placeholder="Days" id="notice_period" value="" width="100px;" /></td>
                      <td>Experience</td>
                      <td><input type="text" name="exp_years" placeholder="Years" id="exp_years" value="" width="50px;" /></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"><?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?> <br>
                Please upload DOC, DOCX, PDF etc. Other formats will not be accepted. </td>
            </tr>
            <tr>
              <td colspan="2" align="left" valign="middle"><input type="submit" name="save_candidate" value="Add Profile"></td>
            </tr>
              </tbody>
            
          </table>
        </form>
        <script language="javascript">
function validate()
{
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
	if($('#first_name').val()=='')
	{
		alert('Please Enter Full Name');
		$('#first_name').focus();
		return false;
	}

	if($('#mobile').val()=='')
	{
		alert('Please Enter Mobile');
		$('#mobile').focus();
		return false;
	}			
	if($('#username').val()=='')
	{
		alert('Please Enter Username or Email');
		$('#username').focus();
		return false;
	}


	
	if(!pattern.test($('#username').val())){
		alert('Please Enter valid email');
		$('#username').focus();
		return false;
	}

	return true;
}

$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});


</script> 
      </div></td>
   <!-- <td  align="left" valign="top"><div class="profile_box">
        <h2>Add From Other Applications</h2>
        <br>
        <form name="quick_form" action="<?php echo base_url().'index.php/jobs_sourcer/import_from_other_jobs/';?><?php echo $formdata['job_id'];?>" method="post" enctype="multipart/form-data">
          <input type="hidden" name="cur_job_id" value="<?php echo $formdata['job_id'];?>">
          <table width="95%" border="1" bordercolor="#f4f4f4" align="center" cellpadding="3" cellspacing="3">
            <tbody>
              <tr>
                <td colspan="4">Bring all candidates from other job applications</td>
              </tr>
              <?php 
				   
				   foreach($job_change_list as $key => $val)
				   {
					   if($val['total_jobs']>0){
					?>
              <tr>
                <td width="8%" align="center"><input type="checkbox" name="job_id[]" value="<?php echo $val['job_id'];?>"></td>
                <td width="46%" align="left"><?php echo $val['job_title'];?><br>
                  <?php echo $val['company_name'];?></td>
                <td width="23%" align="left">Total Apps: <?php echo $val['total_jobs']?></td>
                <td width="23%" align="left">Total Rejected: <?php echo $val['total_rejected']?></td>
              </tr>
              <?php    
					}
				   }
				   
				   ?>
              <tr>
                <td colspan="4"><input type="radio" name="candidate_source" value="1" checked>
                  Take 
                  All Applicants &nbsp;&nbsp;&nbsp;
                  <input type="radio" name="candidate_source" value="2">
                  &nbsp;&nbsp;&nbsp;Take Short Listed&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="candidate_source" value="3">
                  &nbsp;&nbsp;&nbsp;Take Rejected&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="candidate_source" value="4">
                  &nbsp;&nbsp;&nbsp;Take from Interview List</td>
              </tr>
              <tr>
                <td colspan="4"><input type="submit" name="import_candidate" value="Add from these Jobs"></td>
              </tr>
              <tr>
                <td colspan="4">&nbsp;</td>
              </tr>
            </tbody>
          </table>
        </form>
      </div></td> -->
  </tr>
    </tbody>
  
</table>
</div>
<div class="col-md-2"></div>
</div>
</section>
