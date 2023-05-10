<form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/candidates_all_dir/update_company" id="update_form" name="update_form" >
  <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id?>">
   <input type="hidden" name="company_id" id="company_id" value="">
  <table class="hori-form">
    <tbody>
      <tr>
        <td>Company Name</td>
        <td><input class="form-control hori " type="text" name="company_name" value="" id="company_name" readonly></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><input class="form-control hori " type="text" name="company_email" value="" id="company_email" readonly></td>
      </tr>
      <tr>
        <td>Company Number</td>
        <td><input class="form-control hori " type="text" name="company_phone" value="" id="company_phone" readonly></td>
      </tr>
      <tr>
        <td>Interview Date</td>
        <td><input class="datepicker form-control hori " type="text" name="interview_date" value="" id="interview_date"></td>
      </tr>
      <tr>
        <td>Interview Time</td>
        <td><input class="form-control hori " type="text" name="interview_time" value="" id="interview_time"></td>
      </tr>
      <tr>
        <td>Venue</td>
        <td><input class="form-control hori " type="text" name="location" value="" id="location"></td>
      </tr>
      
      <tr>
        <td colspan="2"><span class="click-icons">
          <input type="button" class="attach-subs" value="Update Data" id="save_company_updates" style="width:180px;" data-url="<?php echo $this->config->site_url();?>/candidates_all_dir/update_company_lists" />
               </tr>
      <tr>
        <td colspan="2"><table width="100%" border="1" id="main_course_table">
            <tbody>
              <tr bgcolor="#EBEBEB">
                <td width="5%">#</td>
                <td width="14%">Company</td>
                <td width="17%">Email</td>
                <td width="14%">Phone</td>
                <td width="11%">Interview Date</td>
                <td width="9%"> Time</td>
                <td width="16%">Venue</td>
                <td width="14%">Action</td>
              </tr>
              <?php 
	$i=0;
	foreach($shortlisted_data as $key => $val)
	{
		$i+=1;
	?>
              <tr id="tr_<?php echo $val['company_id'];?>">
                <td><?php echo $i;?></td>
                <td><?php echo $val['company_name'];?></td>
                <td><?php echo $val['company_email'];?></td>
                <td><?php echo $val['company_phone'];?></td>
                <td><?php echo $val['interview_date'];?></td>
                <td><?php echo $val['interview_time'];?></td>
                <td><?php echo $val['location'];?></td>
                <td><a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/candidates_all_dir/edit_shortlisted_lists/?candidate_id=<?php echo $val['candidate_id'];?>&company_id=<?php echo $val['company_id'];?>"  id="edit_shortlisted_lists" class="btn btn-primary btn-xs">Change</a> || <a href="javascript:;" class="btn btn-warning btn-xs" title="View Profile" onclick="delete_company(<?php echo $val['candidate_id'];?>,<?php echo $val['company_id'];?>);"> Delete</a></td>
              </tr>
              <?php 
	} 
	?>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</form>
<script>


function delete_company(candidate_id,company_id)
{
	 $.ajax({
			type: 'POST',
			url:"<?php echo $this->config->site_url()?>/candidates_all_dir/delete_company",
			method: "POST",
  			data: { candidate_id : candidate_id, company_id : company_id},
		    dataType: "json",
			success: function(data) 
			{
				 if(data.status == 'success'){		
						
					$('#tr_'+company_id).remove();
					alert('Application deleted sucessfully');
					
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});	
}
$(document).on('click', '#save_company_updates', function(){ 
		var $this = $(this);
		//var $url = $this.data('url');     	
		
        $.ajax({
			type: 'POST',
			url:"<?php echo $this->config->site_url()?>/candidates_all_dir/update_company_lists",
			method: "POST",
			data: $('#update_form').serialize(),
			dataType: "json",
			success: function(data) {
				
				 if(data.status == 'success'){		
								
					alert('Updated Successfully');
					//$("#company_short_data").html( "New program added." );
						$('#update_shift_vacancy').modal('hide');	
						//connect_with_jobs(data.candidate_id);	
					
					//location.reload();
					//$("#update_form").reset();
						return;
				 }
				 else
				 {
					 alert('Please Select Company');
				 }
			}
		});

	});
	
	

$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});

</script>