
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Manage Invoice</div>
<div class="profile_top_right">
<br>
<a href="javascript:alert('Write Code');">Delete this Job</a>	&nbsp;&nbsp;&nbsp;
</div>
<div style="clear:both;"></div>
</div>


<div style="border:solid;height:auto;">

<table border="0" cellpadding="3" cellspacing="3" width="100%">

  <tbody><tr>
    <td width="50" colspan="2" align="left" valign="top"><br>
  <br></td>
  </tr>
    

  <tr>
    <td colspan="2" align="center" valign="top" id="accept" <?php  if(empty($offer_accepted)) { ?> class="hide" <?php } ?>><br>
      Offer Accepted and Joined in [Company Name]</td></tr>

<tr id="candidate_accept" <?php  if(empty($offer_accepted)) { ?> class="hide" <?php } ?>>
  <td colspan="2" align="center" valign="top">
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
          <tbody >
              <tr>
                    <td bgcolor="#CCCCCC">Candidate</td>
                    <td bgcolor="#CCCCCC">Accept Date</td>
                   
                    <td bgcolor="#CCCCCC">Feedback/Rate</td>
                    <td width="37%" bgcolor="#CCCCCC">Description</td>
              </tr>
              <?php foreach($offer_accepted as $accepted){?>
                                                
              
                <tr>
                    <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $accepted['candidate_id']?>" target="_blank"><?php echo $accepted['first_name'].' '.$accepted['last_name'];?></a></td>
                    <td width="13%"><?php echo date("d-m-Y", strtotime($accepted['offer_accepted_date']));?></td>
                   
                    <td width="13%">&nbsp;</td>
                    <td><a href="#" data-reveal-id="interview" data-animation="fade">Change</a> | <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_acceptcandidate/?job_id=<?php echo $formdata['job_id'];?>&app_id=<?php echo $accepted['app_id'];?>&candidate_id=<?php echo $accepted['candidate_id'];?>&placement_id=<?php echo $accepted['placement_id'];?>" id="delete_accept_candidate" >Remove </a>| <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $accepted['candidate_id']?>" target="_blank">Profile </a> | <a href='javascript:;' onclick="create_invoice(<?php echo $formdata['job_id'];?>,<?php echo $accepted['app_id'];?>,<?php echo $accepted['candidate_id'];?>,<?php echo $accepted['placement_id'];?>);" <?php /*?><a href="<?php echo base_url(); ?>index.php/jobs/create_invoice/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $accepted['app_id'];?>&candidate_id=<?php echo $accepted['candidate_id'];?>&placement_id=<?php echo $accepted['placement_id'];?>"<?php */?>> Create Invoice</a></td>
                </tr>
                
            <?php } ?> 
            
            </tbody>
       </table>  
    </td>
</tr>


<tr>
    <td colspan="2" align="center" valign="top" id="invoice" <?php  if(empty($invoice_generated)) { ?> class="hide" <?php } ?>><br>
      Invoice against this Job  [<a href="<?php echo base_url(); ?>index.php/jobs/create_invoice/<?php echo $formdata['job_id'];?>"> &nbsp;View All&nbsp; </a>]</td></tr>

<tr id="candidate_invoice" <?php  if(empty($invoice_generated)) { ?> class="hide" <?php } ?>>
  <td colspan="2" align="center" valign="top">
        <table border="1" cellpadding="3" cellspacing="3" width="95%">
          <tbody >
          
              <tr>
                <td bgcolor="#CCCCCC">Candidate</td>
                <td bgcolor="#CCCCCC">Invoice Date</td>
                <td bgcolor="#CCCCCC">Start Date</td>
                <td bgcolor="#CCCCCC">Due Date</td>
                <td bgcolor="#CCCCCC">Amt.</td>
                <td bgcolor="#CCCCCC">Status</td>
                 <td bgcolor="#CCCCCC">Created For</td>
                <td width="37%" bgcolor="#CCCCCC">Action</td>
              </tr>
              <?php foreach($invoice_generated as $invoice){?>                                                
              
                <tr>
                  <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $invoice['candidate_id']?>" target="_blank"><?php echo $invoice['first_name'].' '.$invoice['last_name'];?></a></td>
                  <td width="13%"><?php echo $invoice['invoice_date'];?></td>
                  <td width="14%"><?php echo $invoice['invoice_start_date'];?></td>
                  <td width="12%"><?php echo $invoice['invoice_due_date'];?></td>
                  <td width="11%"><?php echo $invoice['invoice_amount'];?></td>
                  <td width="11%"><?php if($invoice['invoice_status']=='1')echo 'Paid';if($invoice['invoice_status']=='2')echo 'Unpaid';if($invoice['invoice_status']=='3')echo 'Due';?></td>
                  <td width="11%"><?php if($invoice['client_candidate']=='1')echo 'Client';if($invoice['client_candidate']=='2')echo 'Candidate';?></td>
                 
                  <td>
                  
                  <a href="<?php echo base_url(); ?>index.php/jobs/create_invoice/?job_id=<?php echo $formdata['job_id'];?>/?placement_id=<?php echo $invoice['placement_id'];?>&invoice_id=<?php echo $invoice['invoice_id'];?>"> &nbsp;Edit&nbsp;</a>
                  
                   |<a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_invoice/?job_id=<?php echo $formdata['job_id'];?>&placement_id=<?php echo $invoice['placement_id'];?>&invoice_id=<?php echo $invoice['invoice_id'];?>"  id="delete_invoice_candidate" >Delete</a>
                           
                   |        
                   <a href="<?php echo base_url(); ?>index.php/candidates/summary/<?php echo $invoice['candidate_id'];?>/" target="_blank"> &nbsp;Profile&nbsp;</a>
                   
                   </td>
                </tr>
                
            <?php } ?> 
            
         </tbody>
      </table>  
   </td>
</tr>

<tr>
<td colspan="2" align="center"> <?php  if((empty($invoice_generated)) && (empty($offer_accepted)) ){?><h3> No Results For Listing  </h3> <?php }?> </td>
</tr>
              
  </tbody></table>



<!------------------------ modal2 for Invoice------------------>

<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Invoice List</div>
                    
                
                <?php /*?><div class="profile_bottom" id="leads">
                    
                          <div class="slider_redesign" id="tr_1" >
                        
                            <div class="side_adj second">
                            <?php foreach($invoice_list2 as $invoice_list){?>
                                <h2><?php echo $invoice_list['first_name'];?></h2>
                                <p>Offer Issued On:<?php echo $invoice_list['offer_issued_date'];?></p>
                                <p>Accepted On: <?php echo $invoice_list['offer_accepted_date'];?></p>
                                <p>Join Date: <?php echo $invoice_list['join_date'];?></p>
                                <p>Monthly Salary: <?php echo $invoice_list['monthly_salary_offered'];?></p>
                                <p>CTC: <?php echo $invoice_list['total_ctc'];?></p>
                                <?php if (isset($invoice_list['invoice_date'])){?><p>Invoice On: <?php echo $invoice_list['invoice_date'];?></p><?php }?>
                                 <?php if (isset($invoice_list['invoice_date'])){?><p>Start From: <?php echo $invoice_list['invoice_start_date'];?></p><?php }?>
                                 <?php if (isset($invoice_list['invoice_date'])){?><p>Due On: <?php echo $invoice_list['invoice_due_date'];?></p><?php }?>
                                 <?php if (isset($invoice_list['invoice_date'])){?><p>Amount: <?php echo $invoice_list['invoice_amount'];?></p><?php }?>
                                <?php if (isset($invoice_list['invoice_date'])){?><p>Status: <?php if($invoice_list['invoice_status']=='1') echo 'Paid';if($invoice_list['invoice_status']=='2') echo 'Unpaid';if($invoice_list['invoice_status']=='3') echo 'Due';?></p><?php }?>
                           <?php }?>
                            
                            </div>
                	   </div>
                
               	     </div><?php */?>
                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id2"value="">
                  <input type="hidden" name="app_id" id="app_id2" value="">
                  <input type="hidden" name="placement_id" id="placement_id2" value="">
                  <input type="hidden" name="job_id" id="job_id2" value="">
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                            <td>Invoice Date</td>
                             <td><input type="text" name="invoice_date" class="smallinput datepicker" id="datepicker"  required/></td>
                        </tr>
                        
                        <tr>
                            <td>Invoice Start Date</td>
                             <td><input type="text" name="invoice_start_date" class="smallinput datepicker" id="datepicker"  /></td>
                        </tr>
                        
                        <tr>
                            <td>Invoice Due Date</td>
                             <td><input type="text" name="invoice_due_date" class="smallinput datepicker" id="datepicker" /></td>
                        </tr>
                        
                        <tr>
                            <td>Replacement Date</td>
                            <td><input type="text" name="replacement_date" class="smallinput datepicker" id="datepicker" /></td>
                        </tr>
                        
                        <tr>
                            <td>Invoice Amount</td>
                             <td><?php echo form_input(array('name'=>'invoice_amount', 'class' => 'smallinput'));?> </td>
                        </tr>
                        
                        <tr>
                             <td>Invoice Status</td>
                             <td><input type="radio"  name="invoice_status" value="1">&nbsp;Paid&nbsp;<input type="radio"  name="invoice_status" value="2"  checked>&nbsp;Unpaid&nbsp;<input type="radio"  name="invoice_status" value="3">&nbsp;Due</td>
                        </tr>
                        
                        <tr>
                             <td>Created For</td>
                             <td><input type="radio"  name="client_candidate" value="1">&nbsp;Client&nbsp;
                             <input type="radio"  name="client_candidate" value="2"  checked>&nbsp;Candidate&nbsp;</td>
                        </tr>
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_candidate5" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/jobs/create_invoice2" />
                              <?php /*?><input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;"><?php */?>
                              </span>
                          </td>
                	   </tr>
                      </tbody>
                  </table>
                
                </form>
                   
	<!--Followup-->

          
      </div>
    </div>
  </div>
</div>

<!------------------------ end modal3------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>

<script type="text/javascript">

$('input[type=text]').addClass('form-control');


function create_invoice(id1,id2,id3,id4)
{
	$('#job_id2').val(id1);
	$('#app_id2').val(id2);
	$('#candidate_id2').val(id3);
	$('#placement_id2').val(id4);
	$('#myModal2').modal('show');
}

$(document).on('click', '#save_candidate5', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form5').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){

					$('#myModal2').modal('hide');
					$('#invoice').removeClass();
					$('#candidate_invoice').removeClass();	
					$('#candidate_invoice').html(data.data);
					$("#candidate_form5").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

$(document).on('click', '#delete_accept_candidate', function(){																													
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
					$('#accept').addClass('hide');
					$('#candidate_accept').addClass('hide');
					
				} 
				else
				{
					$('#candidate_accept').html(data.data);
				}
	   	   }
		   else
		   {
			   alert('Cannot able to delete ');
			}
	   }
			
	 }); 
  }
});

$(document).on('click', '#delete_invoice_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   	if(data.count == 0)
				{
					$('#invoice').addClass('hide');
					$('#candidate_invoice').addClass('hide');
					
				} 
				else
				{
					$('#candidate_invoice').html(data.data);	   	
				}  
	   }
			
	 }); 
  }
});


$('.datepicker').datepicker({
		format : "dd-mm-yyyy",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});



</script>

