
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Manage Offer</div>
<div class="profile_top_right">
<br>
<a href="javascript:alert('Write Code');">Delete this Job</a>	&nbsp;&nbsp;&nbsp;
</div>
<div style="clear:both;"></div>
</div>


<div style="border:solid;height:auto;">

    <table border="0" cellpadding="3" cellspacing="3" width="100%">
    
      <tbody>
          
            <tr>
            	<td width="50" colspan="2" align="left" valign="top"><br><br></td>
            </tr>
            
            
           <tr>
    <td colspan="2" align="center" valign="top" id="sel" <?php  if(empty($candidates_selected)) { ?> class="hide" <?php } ?>><br>Candidates Selected</td>
</tr>

<tr id="candidate_selected" <?php  if(empty($candidates_selected)) { ?> class="hide" <?php } ?>>
    <td colspan="2" align="center" valign="top">
            <table border="1" cellpadding="3" cellspacing="3" width="95%">
                  <tbody >
                  <tr>
                     	<td bgcolor="#CCCCCC">Candidate</td>
                        <td bgcolor="#CCCCCC">Select Date</td>
                        
                        <td bgcolor="#CCCCCC">Feedback/Rate</td>
                        <td width="37%" bgcolor="#CCCCCC">Description</td>
                  </tr>
                  <?php foreach($candidates_selected as $selected){?>
                                                    
                  
                    <tr>
                      <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $selected['candidate_id']?>" target="_blank"><?php echo $selected['first_name'].' '.$selected['last_name'];?></a></td>
                      <td width="13%"><?php echo date("d-m-Y", strtotime($selected['select_date']));?></td>
                     
                       <td width="13%"><?php echo $selected['feedback'];?></td>
                      <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_selectedcandidate/?job_app_id=<?php echo $selected['app_id'];?>&candidate_id=<?php echo $selected['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_selected_candidate" >Remove </a>| <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $selected['candidate_id']?>" target="_blank"> Profile </a> | <a href="javascript:;" data-url="<?php echo base_url(); ?>my_jobs/issue_offer/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $selected['app_id'];?>&candidate_id=<?php echo $selected['candidate_id'];?>"id="issue_offer"> Issue Offer </a></td>
                    </tr>
                    
                <?php } ?> 
                    
                    </tbody>
            </table>  
     </td>
</tr>


<tr>
    <td colspan="2" align="center" valign="top" id="offer" <?php  if(empty($offer_letters_issued)) { ?> class="hide" <?php } ?>><br>
      Offer Letters Issued for Candidates below
    </td>
</tr>

<tr id="candidate_offer" <?php  if(empty($offer_letters_issued)) { ?> class="hide" <?php } ?>>
    <td colspan="2" align="center" valign="top">
        <table border="1" cellpadding="3" cellspacing="3" width="95%">
              <tbody >
              <tr>
                    <td bgcolor="#CCCCCC">Candidate</td>
                    <td bgcolor="#CCCCCC">Offer Date</td>
                   
                    <td bgcolor="#CCCCCC">Feedback/Rate</td>
                    <td width="37%" bgcolor="#CCCCCC">Description</td>
              </tr>
              
			  <?php foreach($offer_letters_issued as $offerletter){?>
              
                <tr>
                    <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $offerletter['candidate_id']?>" target="_blank"><?php echo $offerletter['first_name'].' '.$offerletter['last_name'];?></a></td>
                    <td width="13%"><?php echo date("d-m-Y", strtotime($offerletter['offer_date']));?></td>
                   <td></td>
                    <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_offercandidate/?job_app_id=<?php echo $offerletter['app_id'];?>&candidate_id=<?php echo $offerletter['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_offer_candidate" >Remove </a>| <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $offerletter['candidate_id']?>" target="_blank"> Profile </a> | <a href='javascript:;' onclick="accept_offer(<?php echo $formdata['job_id'];?>,<?php echo $offerletter['app_id'];?>,<?php echo $offerletter['candidate_id'];?>);" <?php /*?>href="<?php echo base_url(); ?>my_jobs/accept_offer/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $offerletter['app_id'];?>&candidate_id=<?php echo $offerletter['candidate_id'];?>"<?php */?>> Accept Offer </a></td>
                </tr>
                
            <?php } ?> 
                
             </tbody>
        </table>  
     </td>
</tr>

<tr>
<td colspan="2" align="center"> <?php  if((empty($candidates_selected)) && (empty($offer_letters_issued)) ){?><h3> No Results For Listing  </h3> <?php }?> </td>
</tr>
   </tbody>
</table>



<!------------------------ modal2 for Accept offer------------------>

<div class="modal fade" id="myModal1" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
            
                </div>
            
    <div class="notes">
        <div class="table-tech specs note">
        	<div class="new_notes">
        
                <p id="result"></p>
                <p id="deletemessage"></p>
    
                
               <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form4"> 
             		<input type="hidden" name="candidate_id" id="candidate_id1" value="">
                    <input type="hidden" name="app_id"  id="app_id1" value="">    
                     <input type="hidden" name="job_id"  id="job_id1" value="">      
                
                <table class="hori-form">
                	<tbody>

                        <tr>
                            <td>Offer Issued on</td>
                            <td><input type="text" name="offer_issued_date" class="smallinput datepicker" id="datepicker"  /></td>
                        </tr>
                        
                        <tr>
                        <td>Offer Accepted Date</td>
                         <td><input type="text" name="offer_accepted_date" class="smallinput datepicker" id="datepicker" /></td>
                        </tr>
                        
                        <tr>
                        <td>Planned Join Date</td>
                           <td><input type="text" name="join_date" class="datepicker" id="datepicker"  /></td>
                        </tr>
                        
                        <tr>
                        <td>Monthly Salary Offered</td>
                         <td><?php echo form_input(array('name'=>'monthly_salary_offered', 'class' => 'smallinput'));?>  </td>
                        </tr>
                        
                        <tr>
                        <td>Total CTC</td>
                         <td><?php echo form_input(array('name'=>'total_ctc', 'class' => 'smallinput'));?> </td>
                        </tr>
                        
                        <tr>
                        <td>Min. Contract Months</td>
                         <td><?php echo form_input(array('name'=>'min_contract_months', 'class' => 'smallinput'));?> </td>
                        </tr>
                        
                        
                      <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_candidate4" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>my_jobs/accept_offer2" />
                              <?php /*?><input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;"><?php */?>
                              </span>
                          </td>
                	   </tr>
                    </tbody>
              </table>
                        
        </form>
    </div>
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>

<!------------------------ end modal2------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>


<script type="text/javascript">

$('input[type=text]').addClass('form-control');


$(document).on('click', '#issue_offer', function(){
														
  if(window.confirm("Are You Sure to Issue the Offer?")){
  
	  var $url= $(this).attr('data-url');	 
	  $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){ 
	   
			$('#offer').removeClass();
			$('#candidate_offer').removeClass();	
			$('#candidate_offer').html(data.data);
	   }
			
	 }); 
  }
});

function accept_offer(id1,id2,id3)
{
	$('#job_id1').val(id1);
	$('#app_id1').val(id2);
	$('#candidate_id1').val(id3);
    $('#myModal1').modal('show');
}

$(document).on('click', '#save_candidate4', function(){ 

		var $this = $(this);
		var $url = $this.data('url');
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form4').serialize(),
			dataType: "json",

			success: function(data) {

				 if(data.status == 'success'){

					$('#myModal1').modal('hide');
					$('#accept').removeClass();
					$('#candidate_accept').removeClass();	
					$('#candidate_accept').html(data.data);
					$("#candidate_form4").trigger( "reset" );
					
				 }

				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});

	});

$(document).on('click', '#delete_selected_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {			
				if(data.count == 0)
				{
					$('#sel').addClass('hide');
					$('#candidate_selected').addClass('hide');
					
				} 
				else
				{
					$('#candidate_selected').html(data.data);
				}
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in OfferIssued');
			}
	   }
			
	 }); 
  }
});


$(document).on('click', '#delete_offer_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){
  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {		
				if(data.count == 0)
				{
					$('#offer').addClass('hide');
					$('#candidate_offer').addClass('hide');
					
				} 
				else
				{
					$('#candidate_offer').html(data.data);
				}
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Offer Accepted');
			}
	   }
			
	 }); 
  }
});

$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});



</script>

