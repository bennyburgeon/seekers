
<table width="100%" border="1">
  <tbody>
    <!--<tr>
      <td width="60%">Jobs List - Select jobs from here and add the candidate to those jobs.</td>
      <td width="40%">Candidate Profile</td>
    </tr>-->
    <tr>
      <td  width="50%" valign="top" align="left"><form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/candidates_all_dir/add_company" id="job_assignment_form" name="assignment_form" >
          <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id?>">
          Company Name: &nbsp;
          <input class="smallinput" type="text" name="company_name" value="" id="company_name" placeholder="Enter Company Name" style=" width: 75%; border-color: #e4e4e4;">
          <br>
          <br>
          Phone Number:&nbsp;&nbsp;&nbsp;&nbsp;
          <input class="smallinput" type="text" name="company_phone" value="" id="company_phone" placeholder="Enter Phone Number" onClick="company_phone" style=" width: 75%; border-color: #e4e4e4;"> 
          <br>
          <br>
          Interview Date:&nbsp;&nbsp;&nbsp;&nbsp;
          <input class="datepicker smallinput" type="text" name="interview_date" value="" id="interview_date" placeholder="Interview Date" onClick="interview_date" style=" width: 75%; border-color: #e4e4e4;"> 
          <br>
          <br>
          Interview Time:&nbsp;&nbsp;&nbsp;&nbsp;
          <input class="smallinput" type="text" name="interview_time" value="" id="interview_time" placeholder="Interview Time" onClick="interview_time" style=" width: 75%; border-color: #e4e4e4;"> 
          <br>
          <br>
          Venue:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input class="smallinput" type="text" name="location" value="" id="location" placeholder="Enter Location" onClick="location" style=" width: 75%; border-color: #e4e4e4;">                  
                     
          <br>
          <br>
          Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input class="smallinput" type="text" name="company_email" value="" id="company_email" placeholder="Enter Email" style=" width: 75%; border-color: #e4e4e4;" required>
          <br>
          <br>
          <input type="button" value="Shortlist" data-url="<?php echo $this->config->site_url();?>/candidates_all_dir/add_company" id="save_job_app_button" >
        </form>
         
        </td>
      <td align="left" valign="top"  width="50%"> Full Name:
        <?php  echo $candidate_profile['first_name'];?>
        <br>
        Email: 	 *********<br>
        Mobile: 	 *********<br>
        Gender:
        <?php  if($candidate_profile['gender']==1)echo 'Male';else echo 'Female';?>
        <br>
        Registered On:
        <?php  echo $candidate_profile['reg_date'];?>
        <br>
        Profile Updated On:
        <?php  echo $candidate_profile['status_updated_on'];?>
        <br>
        <br>
        <?php if(is_array($candidate_locations)){?>
        Preferred Locations: <?php echo implode(',',$candidate_locations);?> <br>
        <br>
        <?php 				
      }									
      ?>
        <?php if(is_array($candidate_industries)){?>
        Industries: <?php echo implode(',',$candidate_industries);?> <br>
        <br>
        <?php 				
      }									
      ?>
        <?php if(is_array($candidate_functional_areas)){?>
        Functional Area: <?php echo implode(',',$candidate_functional_areas);?> <br>
        <br>
        <?php 				
      }									
      ?>
        <?php if(is_array($candidate_roles)){?>
        Role/Designation: <?php echo implode(',',$candidate_roles);?> <br>
        <br>
        <?php 				
      }									
      ?>
        CTC Updated on:
        <?php  if(isset($job_search['ctc_updated_on']) && $job_search['ctc_updated_on']!='0000-00-00')echo $job_search['ctc_updated_on'];else echo 'Not Updated'?>
        <br>
        Total Experience:
        <?php  if(isset($job_search['total_experience'])) echo $job_search['total_experience'].' Years';else echo 'Not Updated';?>
        <br>
        Notice Period:
        <?php  if(isset($job_search['notice_period'])) echo $job_search['notice_period'].' Days';else echo 'Not Updated';?>
        <br>
        Current CTC:
        <?php if(isset($job_search['current_ctc'])){?>
        <?php echo  $this->config->item('currency_symbol');?> &nbsp;
        <?php  echo $job_search['current_ctc'];?>
        <?php }else{ echo 'Not Updated';}?>
        <br>
        Expected CTC:
        <?php if(isset($job_search['expected_ctc'])){?>
        <?php echo  $this->config->item('currency_symbol');?> &nbsp;
        <?php  echo $job_search['expected_ctc'];?>
        <?php }else{ echo 'Not Updated';}?>
        <br></td>
    </tr>
  </tbody>
</table>
<script>
$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});
</script>