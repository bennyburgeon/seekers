
<section class="bot-sep">
  <div class="section-wrap">
    
    <div class="row">
      <div class="col-sm-12">
        <div class="alert alert-success alert-danger">
          
        <div class="table-tech specs hor">
          <table class="hori-form">
            <tbody>
            <form action="<?php echo $this->config->site_url();?>signup/add" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
            
           <tr>
                <td>Job Title</td>
                <td><input type="text" id="job_title" name="job_title" value="<?php echo $formdata['job_title'];?>" placeholder="" class="form-control hori" /></td>
              </tr>
              
         
              <tr>
                <td colspan="2"><span class="click-icons">
                  <input type="submit" class="attach-subs" value="Submit">
                  <a href="<?php echo $this->config->site_url();?>my_jobs" class="attach-subs subs">Cancel</a> </span></td>
              </tr>
            </form>
              </tbody>
            
          </table>
          <div style="clear:both;"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript">

function validate()
{
	if($('#job_title').val()=='')
	{
		alert('Please enter job title');
		$('#job_title').focus();
		return false;
	}
	
	else if($('#company_id').val()== 0)
	{
		alert('Please select company name');
		$('#company_id').focus();
		return false;
	}
	
	if($('#parent').val()=='')
	{
		alert('Please Select skill name');
		$('#parent').focus();
		return false;
	}
	
	
	return true;
}
</
