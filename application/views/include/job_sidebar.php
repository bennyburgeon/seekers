
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>
<div class="row">
<div class="col-md-3">
<div class="profile_box">

<ul>

<li <?php if($current_head == 'summary'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/manage/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>

<li <?php if($current_head == 'job_apps'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/job_apps/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Job Applications</a></li>

<li <?php if($current_head == 'add_candidate'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/addcandidate/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Manage Candidates</a></li>

<li <?php if($current_head == 'add_candidate'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/active_seekers/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Active job Seekers</a></li>

<li <?php if($current_head == 'add_candidate'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/suggestions/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Candidate Suggestions</a></li>
<!-- 
<li <?php if($current_head == 'add_candidate'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/all_rejections/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>All Rejections</a></li>


<li <?php if($current_head == 'send_mass_mail'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/upcoming_contracts/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Upcoming Contracts</a></li>
-->

<li <?php if($current_head == 'send_mass_mail'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/send_mass_mail/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Mass Email</a></li>


<li <?php if($current_head == 'shortlist'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/shortlist/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Candidates Shortlisted</a></li>

<li <?php if($current_head == 'interview'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/manage_interview/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Manage Interviews</a></li>


<li <?php if($current_head == 'offer'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/manage_offer/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Offer Letters</a></li>

<li <?php if($current_head == 'invoice'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/jobs/manage_invoice/<?php echo $formdata['job_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Invoices</a></li>


</ul>

</div>

<div class="profile_box">

Add Candidate<br>

<form name="quick_form" action="<?php echo base_url().'index.php/jobs/add_candidate/';?><?php echo $formdata['job_id'];?>" method="post" onSubmit="return validate();" enctype="multipart/form-data">

<input type="hidden" name="job_id" value="<?php echo $formdata['job_id'];?>">

<table width="90%" border="1" align="center">
  <tbody>
    <tr>
      <td>All detials like Industry, Skills etc will be taken from the JD automatically.</td>
    </tr>
      
    <tr>
      <td>Full Name</td>
    </tr>
    <tr>
      <td align="left"><input type="text" name="first_name" placeholder="Full Name" id="first_name" value="" width="200px;" /></td>
    </tr>
    <tr>
      <td>Mobile</td>
    </tr>
    <tr>
     <td><input type="text" name="mobile" placeholder="Mobile" id="mobile" value="" width="200px;" /></td>
    </tr>
    <tr>
      <td>Email</td>
    </tr>
    <tr>
      <td><input type="text" name="username" placeholder="Email" id="username" value="" width="200px;" /></td>
    </tr>

    <tr>
      <td>Linkedin Profile</td>
    </tr>
    <tr>
      <td><input type="text" name="linkedin_url" placeholder="Linkedin" id="linkedin_url" value="" width="200px;" /></td>
    </tr><strong>
    </strong>    
    <tr>
      <td>Highest Edu. Level</td>
    </tr>
    <tr>
      <td><select name="level_id" class="form-control edu-field" id="level_id">
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
      <td>Highest Edu.</td>
    </tr>
    <tr>
      <td><input type="text" name="course_name" placeholder="Education" id="course_name" value="" width="200px;" /></td>
    </tr>
    <tr>
      <td>Present Company</td>
    </tr>
    <tr>
      <td><input type="text" name="company" placeholder="Company" id="company" value="" width="200px;" /></td>
    </tr>
    <tr>
      <td>Designation</td>
    </tr>
    <tr>
      <td><input type="text" name="designation" placeholder="Designation" id="designation" value="" width="200px;" /></td>
    </tr>

    <tr>
      <td>Date Period</td>
    </tr>
    <tr>
      <td><table width="100%" border="0">
        <tbody>
          <tr>
            <td>Fr</td>
            <td><input type="text" name="start_date" placeholder="yyyy-mm-dd" id="start_date" value="" width="100px;" /></td>
            <td>To</td>
            <td><input type="text" name="end_date" placeholder="yyyy-mm-dd" id="end_date" value="" width="100px;" /></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
        
    <tr>
      <td>CTC &amp; Exp.</td>
    </tr>
    <tr>
      <td><table width="100%" border="0">
        <tbody>
          <tr>
            <td>Cur.</td>
            <td><input type="text" name="cur_ctc" placeholder="Cur. CTC" id="cur_ctc" value="" width="100px;" /></td>
            <td>Exp.</td>
            <td><input type="text" name="exp_ctc" placeholder="Exp. CTC" id="exp_ctc" value="" width="100px;" /></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td>Notice Period &amp; Exp.</td>
    </tr>
    <tr>
      <td><table width="100%" border="0">
        <tbody>
          <tr>
            <td>Notice</td>
            <td><input type="text" name="notice_period" placeholder="Notice" id="notice_period" value="" width="100px;" /></td>
            <td>Exp.</td>
            <td><input type="text" name="exp_years" placeholder="Exp." id="exp_years" value="" width="100px;" /></td>
            </tr>
          </tbody>
        </table></td>
    </tr>
    <tr>
      <td></td>
    </tr>
    <tr>
      <td><?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td><input type="submit" name="save_candidate" value="Add"> </td>
    </tr>

  </tbody>
</table>

</form>
<script language="javascript">
function validate()
{
	if(document.quick_form.first_name.value=='')
	{
		alert('Please enter first name');
		document.quick_form.first_name.focus();
		return false;		
	}
	if(document.quick_form.username.value=='')
	{
		alert('Please enter email');
		document.quick_form.username.focus();
		return false;		
	}
	return true;
}
</script>,

</div>

</div>




