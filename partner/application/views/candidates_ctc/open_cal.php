
<a href="#" onClick="manage_shift_vacancy(<?php echo $candidate_id?>,<?php echo $month?>,<?php echo $year?>);" >Open</a>

<div class="modal fade" id="update_shift_vacancy" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document" style="width:1082px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div id="shift_data_holder"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<script>

function manage_shift_vacancy(candidate_id,month,year)
{
	//$('#candidate_id').val(client_shift_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo $this->config->site_url()?>candidates_ctc/calendar_ci?month="+month+"&year="+year,
			data: $('#shift_assignment_form').serialize(),
			method: "POST",
  			data: { candidate_id : candidate_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#shift_data_holder').html(data);
			}
		});
    $('#update_shift_vacancy').modal();		
}

$(document).on('click', '#save_shift_button', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#shift_assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					//$('#assignment_modal').modal('hide');	
					alert('Calendar updated');				
					//location.reload();
					//$("#assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

</script>