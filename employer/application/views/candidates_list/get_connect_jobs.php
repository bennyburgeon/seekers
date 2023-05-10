
<table width="100%" border="1">
  <tbody>
    <tr>
      <td width="60%">Walkins List - Select jobs from here and add the candidate to those jobs.</td>
      <td width="40%">Candidate Profile</td>
    </tr>
    <tr>
      <td  width="60%" align="left" valign="top"><form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/candidates_list/apply_for_interview" id="job_assignment_form" name="assignment_form">
          <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id?>">
          <?php 
foreach($jobs_list as $key => $val)
{
?>
          <?php if($val['total_apps']>0){?>
          <p href="javascript:;" class="btn btn-danger btn-xs"> Applied</p>
          <input type="checkbox" disabled name="job_id[]" value="<?php echo $val['job_id'];?>">
          <?php }else{?>
          <input type="checkbox" name="job_id[]" value="<?php echo $val['job_id'];?>">
          <?php } ?>
          &nbsp;<?php echo $val['job_title'];?><br>
          <?php } ?> <br>
<br>

          <input type="button" value="Add To These Jobs" data-url="<?php echo $this->config->site_url();?>/candidates_list/apply_for_interview" id="save_job_app_button" >
        </form></td>
        
      <td align="left" valign="top"  width="40%"> Full Name:
        <?php  echo $candidate_profile['first_name'];?>
        <br>
        Email:
        <?php  echo $candidate_profile['username'];?>
        <br>
        Mobile:
        <?php  echo $candidate_profile['mobile'];?>
        <br>
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
        <?php  echo $job_search['ctc_updated_on'];?>
        <br>
        Total Experience:
        <?php  echo $job_search['total_experience'];?>
        Years<br>
        Notice Period:
        <?php  echo $job_search['notice_period'];?>
        Days<br>
        Current CTC: <?php echo  $this->config->item('currency_symbol');?> &nbsp;
        <?php  echo $job_search['current_ctc'];?>
        <br>
        Expected CTC: <?php echo  $this->config->item('currency_symbol');?> &nbsp;
        <?php  echo $job_search['expected_ctc'];?>
        <br></td>
    </tr>
  </tbody>
</table>
