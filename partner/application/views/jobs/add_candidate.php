
<div class="col-md-12">

<div class="profile_top">
<div class="profile_top_left">
<a href="<?php echo base_url();?>jobs/manage/<?php echo $formdata['job_id'];?>">Summary</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp; 
<a href="<?php echo base_url();?>jobs/search_candidate/<?php echo $formdata['job_id'];?>">Search Candidates</a> &nbsp;&nbsp;&nbsp;	
<!-- 
||
&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url();?>jobs/send_mass_mail/<?php echo $formdata['job_id'];?>">Mass Email</a>	&nbsp;&nbsp;&nbsp; 
-->
||&nbsp;&nbsp;&nbsp;
Add From Other Jobs</div>  

<div style="clear:both;"></div>
</div>

<div>


<form name="quick_form" action="<?php echo base_url().'jobs/import_from_other_jobs/';?><?php echo $formdata['job_id'];?>" method="post" enctype="multipart/form-data">

<input type="hidden" name="cur_job_id" value="<?php echo $formdata['job_id'];?>">

<table width="95%" border="0" bordercolor="#f4f4f4" align="center" cellpadding="3" cellspacing="3">
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
                   <td width="5%" align="center"> <input type="checkbox" name="job_id[]" value="<?php echo $val['job_id'];?>"></td>
                   <td width="70%" align="left"><?php echo $val['job_title'];?><br><?php echo $val['company_name'];?></td>
                   <td width="13%" align="left">Total Apps: <?php echo $val['total_jobs']?></td>
                   <td width="12%" align="left">Total Rejected: <?php echo $val['total_rejected']?></td>
                 </tr>
                 <?php    
					}
				   }
				   
				   ?>
    <tr>
      <td colspan="4"><input type="radio" name="candidate_source" value="1" checked> 
        Take 
        All Applicants &nbsp;&nbsp;&nbsp;<input type="radio" name="candidate_source" value="2">&nbsp;&nbsp;&nbsp;Take Short Listed&nbsp;&nbsp;&nbsp;<input type="radio" name="candidate_source" value="3">&nbsp;&nbsp;&nbsp;Take Rejected&nbsp;&nbsp;&nbsp;<input type="radio" name="candidate_source" value="4">&nbsp;&nbsp;&nbsp;Take from Interview List</td>
      </tr>
    <tr>
      <td colspan="4"><input type="submit" name="import_candidate" value="Add from these Jobs"> </td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
  </tbody>
</table>

</form>

</div>
 <div style="clear:both;"></div>
</section>