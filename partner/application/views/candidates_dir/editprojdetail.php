<form class="form-horizontal form-bordered" action="<?php echo site_url('candidates_dir/update_project'); ?>"  method="post" id="update_job_form" name="update_job_form" >
  <input type="hidden" name="project_id"  value="<?php echo $project_id?>">
  <input type="hidden" name="candidate_id"  value="<?php echo $candidate_id?>">
  <table class="hori-form">
    <tbody>
      <tr>
        <td>Project Title</td>
        <td><input class="form-control hori" type="text" name="project_title" value="<?php echo $formdata['project_title'];?>" id="project_title"></td>
      </tr>
        <tr>
        <td>Project Url</td>
        <td><input class="form-control hori" type="text" name="project_links" value="<?php echo $formdata['project_links'];?>" id="project_links"></td>
      </tr>
        
           <tr>
        <td>Project Description</td>
        <td><input class="form-control hori" type="text" name="project_desc" value="<?php echo $formdata['project_desc'];?>" id="project_desc"></td>
      </tr>
        
           <tr>
        <td>Technologies Used</td>
        <td><input class="form-control hori" type="text" name="tech_used" value="<?php echo $formdata['tech_used'];?>" id="tech_used"></td>
      </tr>
    <tr>
      <td colspan="2"><span class="click-icons">
        <input type="submit" class="attach-subs" value="Update Project" id="update_job_profile" style="width:180px;">
       
        </span></td>
    </tr>
    </tbody>
    
  </table>
</form>
<script>

</script>