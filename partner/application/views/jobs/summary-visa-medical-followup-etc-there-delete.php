
<!--MODAL FOR CERT ATTEST BEGIN--------------------->
<div class="modal fade" id="myModalCert" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Certificate Attestation</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="cert_form" name="cert_form" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id_cert"value="">
                  <input type="hidden" name="app_id" id="app_id_cert" value="">
                  <input type="hidden" name="placement_id" id="placement_id_cert" value="">
                  <input type="hidden" name="job_id" id="job_id_cert" value="">
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                            <td>Title</td>
                             <td><input type="text" name="title" class="smallinput" id="title"/></td>
                        </tr>
                        
                        <tr>
                            <td>Status</td>
                             <td>
                                 <select name="status" class="smallinput form-control" id="status">
                                    <option value="">Select Status</option>
                                    <option value="1">Not Required</option>
                                    <option value="2">Required</option>
                                    <option value="3">Already Done</option>
                                    <option value="4">On Process</option>
                                    <option value="5">Completed</option>
                                 </select>
                             </td>
                        </tr>
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_cert" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>jobs/cert_attest" />
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

<!--MODAL FOR CERT ATTEST END-------------------->

<!--MODAL FOR VISA START------------------->
<div class="modal fade" id="myModalVisa" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Visa Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_visa" name="candidate_form_visa" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id4"value="">
                  <input type="hidden" name="app_id" id="app_id4" value="">
                  <input type="hidden" name="placement_id" id="placement_id4" value="">
                  <input type="hidden" name="job_id" id="job_id4" value="">
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                            <td> Date Received</td>
                             <td><input type="text" name="date" class="smallinput datepicker" id="datepicker" readonly /></td>
                        </tr>
                        
                        <tr>
                            <td>Visa Number</td>
                             <td><input type="text" name="number" class="smallinput"/></td>
                        </tr>
                        
                        <tr>
                            <td>Date of Issue</td>
                             <td><input type="text" name="date_issued" class="smallinput datepicker"readonly/></td>
                        </tr>
                        <tr>
                            <td>Date of Expiry</td>
                             <td><input type="text" name="date_expiry" class="smallinput datepicker" readonly/></td>
                        </tr>
                        <tr>
                             <td>Verified Passport Details?</td>
                             <td><input type="radio"  name="passport_verified" value="1">&nbsp;Yes&nbsp;
                             <input type="radio"  name="passport_verified" value="2" >&nbsp;No&nbsp;
                             
                        </tr>
                        

                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_visa" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>jobs/create_visa" />

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
<!--MODAL FOR VISA END----------------------------->

<!--MODAL FOR VISA DOCUMENT START-------------->
<div class="modal fade" id="myModalDoc" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Visa Process Document</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_doc" name="candidate_form_doc" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id_doc"value="">
                  <input type="hidden" name="app_id" id="app_id_doc" value="">
                  
                  <input type="hidden" name="job_id" id="job_id_doc" value="">
                  <table class="hori-form">
                    <tbody>
                        <tr>
                            <td>Mode of Send</td>
                             <td>                                 
                             	<select name="send_mode" class="smallinput form-control" id="send_mode">
                                    <option value="">Select Mode</option>
                                    <option value="1">Courier</option>
                                    <option value="2">Email</option>

                                 </select>
                               </td>
                        </tr>
                        <tr>
                            <td> Send By</td>

                             <td><input type="radio"  name="send_by" value="1">&nbsp;Company&nbsp;
                             <input type="radio"  name="send_by" value="2" >&nbsp;Candidate&nbsp;
                             
                        </tr>
                        
                        

                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_doc" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>jobs/create_doc" />

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
<!--MODAL FOR VISA DOCUMENT END------------------------------------------->

<!--MODAL FOR MEDICAL START-->
<div class="modal fade" id="myModalMedical" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Medical Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_medical" name="candidate_form_medical" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id5"value="">
                  <input type="hidden" name="app_id" id="app_id5" value="">
                  
                  <input type="hidden" name="job_id" id="job_id5" value="">
                  <table class="hori-form">
                    <tbody>
                        <tr>
                            <td>Title</td>
                             <td><input type="text" name="title" class="smallinput"/></td>
                        </tr>
                        <tr>
                            <td> Date</td>
                             <td><input type="text" name="date" class="smallinput datepicker" id="datepicker"/></td>
                        </tr>
                        
                        <tr>
                            <td>Description</td>
                             <td><textarea name="description" rows="4" cols="30"  class="smallinput" ></textarea></td>
                        </tr>
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_medical" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>jobs/create_medical" />

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
<!--MODAL FOR MEDICAL END-->

<!--MODAL FOR TICKET START-->
<div class="modal fade" id="myModalTicket" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Ticket & Travel Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_ticket" name="candidate_form_ticket" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id6"value="">
                  <input type="hidden" name="app_id" id="app_id6" value="">
                  
                  <input type="hidden" name="job_id" id="job_id6" value="">
                  <table class="hori-form">
                    <tbody>

                        <tr>
                            <td>eTicket Number</td>
                             <td><input type="text" name="number" class="smallinput"/></td>
                        </tr>
                        <tr>
                            <td> Date of Travel</td>
                             <td><input type="text" name="date" class="smallinput datepicker" id="datepicker"/></td>
                        </tr>
                        <tr>
                            <td> Boarding Sector</td>
                             <td><input type="text" name="boarding_sector" class="smallinput" id=""/></td>
                        </tr>
                        <tr>
                            <td>Flight Details</td>
                             <td><textarea name="description" rows="4" cols="30"  class="smallinput" ></textarea></td>
                        </tr>
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_ticket" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>jobs/create_ticket" />

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
<!--MODAL FOR TICKET END----------------------------------------->

<!--MODAL FOR TICKET FOLLOWUP START---------------------------------->

<div class="modal fade" id="myModalFollowup" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Ticket & Travel Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	
       
                
                 <form class="form-horizontal form-bordered"  method="post" id="candidate_form_followup" name="candidate_form_followup" enctype="multipart/form-data" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id_followup"value="">
                  <input type="hidden" name="app_id" id="app_id_followup" value="">
                  
                  <input type="hidden" name="job_id" id="job_id_followup" value="">
                  <table class="hori-form">
                   <tbody>

                        <tr>
                            <td>Travel Document</td>
                              <td><?php echo form_upload(array('name'=>'travel_document','class'=>'form-data'));?> </td>
                        </tr>
                        <tr>
                            <td>Mode of Send</td>
                             <td>                                 
                             	<select name="send_mode" class="smallinput form-control" id="send_mode" style="width:150px;">
                                    <option value="">Select Mode</option>
                                    <option value="1">Courier</option>
                                    <option value="2">Email</option>

                                 </select>
                               </td>
                        </tr>
                        <tr>
                            <td> Send By</td>

                             <td><input type="radio"  name="send_by" value="1">&nbsp;Company&nbsp;
                             <input type="radio"  name="send_by" value="2" >&nbsp;Candidate&nbsp;
                             
                        </tr>
                        <tr>
                            <td>Travel Follow Up</td>
                             <td><textarea name="travel_followup" rows="4" cols="30"  class="smallinput" ></textarea></td>
                        </tr>
                        <tr>
                            <td>Pick Up Follow Up</td>
                             <td><textarea name="pickup_followup" rows="4" cols="30"  class="smallinput"  ></textarea></td>
                        </tr>
                        <tr>
                            <td>Travel Confirmation</td>
                            <td><input type="radio"  name="travel_confirmation" value="1">&nbsp;Complete&nbsp;
                             <input type="radio"  name="travel_confirmation" value="2" >&nbsp;Uncomplete&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Send Email</td>
                            <td><input type="radio"  name="send_email" value="yes">&nbsp;Yes&nbsp;
                             <input type="radio"  name="send_email" value="no" >&nbsp;No&nbsp;</td>
                        </tr>
                        <tr>
                        <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="submit" class="attach-subs" value="Save" id="save_followup" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>jobs/create_followup" />

                              </span>
                          </td>
                	   </tr>
                      </tbody>
                  </table>
                
                </form>
                   
	<!--Followup-->

          
    
  </div>
</div>



<!------------------------ end modal3------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<script type="text/javascript">

get_visa_details('<?php echo $formdata['job_id'];?>');
function get_visa_details(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>jobs/get_visa_details/',
	
	   success: function(data){ 
		
		
			$('#visa_details1').html(data.data1);
			$('#visa_details2').html(data.data2);
	   }
			
	 }); 
}

//get certificate attestation
//get_cert_attest('<?php echo $formdata['job_id'];?>');
function get_cert_attest(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>jobs/get_cert_attest/',
	
	   success: function(data){
		
	
			$('#cert_attest1').html(data.data1);
			$('#cert_attest2').html(data.data2);
	   }
			
	 }); 
}
//get visa doc//
//get_visa_doc('<?php echo $formdata['job_id'];?>');
function get_visa_doc(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>jobs/get_visa_document/',
	
	   success: function(data){
		
	
			$('#visa_doc1').html(data.data1);
			$('#visa_doc2').html(data.data2);
	   }
			
	 }); 
}

//get medical doc
//get_medical_details('<?php echo $formdata['job_id'];?>');
function get_medical_details(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>jobs/get_medical_details/',
	
	   success: function(data){
		
	
			$('#medical_details1').html(data.data1);
			$('#medical_details2').html(data.data2);
	   }
			
	 }); 
}

//get_ticket_details('<?php echo $formdata['job_id'];?>');
function get_ticket_details(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>jobs/get_ticket_details/',
	
	   success: function(data){
		
	
			$('#ticket_details1').html(data.data1);
			$('#ticket_details2').html(data.data2);
	   }
			
	 }); 
}

//get_ticket_followup('<?php echo $formdata['job_id'];?>');
function get_ticket_followup(job_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {job_id:job_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>jobs/get_ticket_followup/',
	
	   success: function(data){
		
	
			$('#ticket_followup1').html(data.data1);
			$('#ticket_followup2').html(data.data2);
	   }
			
	 }); 
}


//SAVE CERT ATTEST
$(document).on('click', '#save_cert', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#cert_form').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalCert').modal('hide');
					get_cert_attest('<?php echo $formdata['job_id'];?>');

					$("#cert_form").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
//ISSUE OFFER SCRIPT ENDS

//SAVE VISA DOC DETAILS
$(document).on('click', '#save_doc', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_doc').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalDoc').modal('hide');
					get_visa_doc('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_doc").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

//SAVE MEDICAL DETAILS
$(document).on('click', '#save_medical', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_medical').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalMedical').modal('hide');
					get_medical_details('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_medical").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
//CREATE AND SAVE TICKET DETAILS BEGIN

$(document).on('click', '#save_ticket', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_ticket').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalTicket').modal('hide');
					get_ticket_details('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_ticket").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

//SAVE VISA DETAILS
$(document).on('click', '#save_visa', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_visa').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){

					$('#myModalVisa').modal('hide');
					get_visa_details('<?php echo $formdata['job_id'];?>');
					$("#candidate_form_visa").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

$(document).on('click', '#delete_attest', function(){																													
  if(window.confirm("Are You Sure to delete?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {	   			

			get_cert_attest('<?php echo $formdata['job_id'];?>');
			
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Visa Details ');
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

<!--DELETE VISA DETAILS BEGIN-->
$(document).on('click', '#delete_visa_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	if(data.status == 'success')
		 {
				get_visa_details('<?php echo $formdata['job_id'];?>');
		  }
		  else{
				alert('Cannot able to delete we have entry in Medical Details ');  
		  }
	   }
			
	 }); 
  }
});

<!-- DELETE VISA DOCUMENT-->

$(document).on('click', '#delete_visa_document', function(){																													
  if(window.confirm("Are You Sure to delete ?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	if(data.status == 'success')
		 {
				get_visa_doc('<?php echo $formdata['job_id'];?>');
		  }
		  else{
				alert('Cannot able to delete we have entry in Medical Details ');  
		  }
	   }
			
	 }); 
  }
});

<!--DELETE MEDICAL DETAILS BEGIN-->
$(document).on('click', '#delete_medical_candidate', function(){																													
  if(window.confirm("Are You Sure to delete ?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	if(data.status == 'success')
		 {

			get_medical_details('<?php echo $formdata['job_id'];?>');   	
				
		 }
		 else{
				alert('Cannot able to delete we have entry in Ticket & Travel Details ');  
		  }
	   }
			
	 }); 
  }
});

<!--DELETE TICKET DETAILS BEGIN-->
$(document).on('click', '#delete_ticket_candidate', function(){																													
  if(window.confirm("Are You Sure to delete ?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	 if(data.status == 'success')
		 {
			get_ticket_details('<?php echo $formdata['job_id'];?>');
		 }
		 else{
			 alert('Cannot able to delete we have entry in travel followup');
		 }
	   }
			
	 }); 
  }
});
<!--DELETE VISA DETAILS END-->

</script>