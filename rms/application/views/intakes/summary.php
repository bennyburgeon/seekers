<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>
<div class="row">

<div class="col-md-12">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
<!--<div class="profile_top_right">
<br>
<a href="javascript:alert('Write Code');">Delete this Job</a>	&nbsp;&nbsp;&nbsp;
</div>-->
<div style="clear:both;"></div>
</div>


<div style="border:solid;height:auto;">

        <table border="0" cellpadding="3" cellspacing="3" width="100%">
            <tbody>
                <tr>
                <td width="50" colspan="2" align="left" valign="top"><br><br></td>
                </tr>
                
                
    
          
            <tr>
            	<td colspan="2" align="center" valign="top"><br>Intake Details </td>
            </tr>
            
            <tr>
            	<td colspan="2" align="center" valign="top">
                    <table border="1" cellpadding="3" cellspacing="3" width="95%">
                        <tbody>
                        
                            <tr>
                                <td width="40%"><span style="border-top:1px solid #EEEEEE;">Start Date</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $intake['intake_start'];?></span>&nbsp;</td>
                            </tr>
                            
                            <tr>
                                <td><span style="border-top:1px solid #EEEEEE;">End Date</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $intake['intake_end'];?></span>&nbsp;</td>
                            </tr>
                            

                            
                            <tr>
                                <td><span style="border-top:1px solid #EEEEEE;">Join Date</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $intake['join_date'];?></span>&nbsp;&nbsp;</td>
                            </tr>
                            
                            <tr>
                                <td><span style="border-top:1px solid #EEEEEE;">University</span></td>
								<td><span style="border-top:1px solid #EEEEEE;"><?php echo $intake['univ_name'];?></span>&nbsp;&nbsp;</td>
                            </tr>
                            
                            <tr>
                                <td><span style="border-top:1px solid #EEEEEE;">Campus</span></td>
                                <td><span style="border-top:1px solid #EEEEEE;"><?php echo $intake['college_name'];?></span></td>
                            </tr>
                           
                            
                        </tbody>
                    </table>
            	</td>
            </tr>
            
           
<tr id="candidate_intake1">

</tr>

<tr id="candidate_intake2">

</tr>


                        
</tbody>
</table>


<!--MODAL FOR PROGRAM DETAILS START------------------->
<div class="modal fade" id="myModalProgram" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="col-md-15">
          	 <div class="profile_top">
                <div class="profile_top_left">Program Details</div>
                    

                </div>
               </div> 
                
                <div class="notes">
                 	<div class="table-tech specs note">
        				<div class="new_notes">
        
                			<p id="result"></p>
                		<p id="deletemessage"></p>
       
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form_program" name="candidate_form_program" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id_program" value="">
                  <input type="hidden" name="intake_id" id="intake_id_program" value="">
                 
                 
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                             <td>Level of Study</td>
                             <td> <?php echo form_dropdown('level_id',  $edu_level_list, '','class="smallinput edu-field" id="level_id"');?> </td>
                        </tr>
                        
                        <tr>
                             <td>Course</td>
                 			<td> <?php echo form_dropdown('course_id',  $edu_course_list, '','class="smallinput edu-field" id="course_id_edu"');?> </td>

                        </tr>
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_program" style="width:180px;" 
                              data-url="<?php echo $this->config->site_url();?>/intakes/create_program" />

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
<!--MODAL FOR PROGRAM DETAISL END----------------------------->


</section>




<script type="text/javascript">

get_candidate_intake('<?php echo $intake['intake_id'];?>');
function get_candidate_intake(intake_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {intake_id:intake_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/intakes/get_candidate_intake/',
	
	   success: function(data){ 
		
		
			$('#candidate_intake1').html(data.data1);
			$('#candidate_intake2').html(data.data2);
	   }
			
	 }); 
}

get_program_details('<?php echo $intake['intake_id'];?>');
function get_program_details(intake_id)
{ 
	$.ajax({
	
	   type: 'POST',
		
		data: {intake_id:intake_id},

		dataType: "json",
		
	   url: '<?php echo base_url(); ?>index.php/intakes/get_program_details/',
	
	   success: function(data){ 
		
		
			$('#program_details1').html(data.data1);
			$('#program_details1').html(data.data2);
	   }
			
	 }); 
}

//onchange of level study

$('#level_id').change(function() 
	{
	
		jQuery('#course_id_edu').html('');
		jQuery('#course_id_edu').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/intakes/getcourses/',
			  data: { level_study: $('#level_id').val(),int_val:1},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#course_id_edu').html('');
					jQuery('#course_id_edu').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#course_id_edu').html('');
					  jQuery('#course_id_edu').append(data.course_list);

					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Please try again');
					jQuery('#course_id_edu').html('');
					jQuery('#course_id_edu').append('<option value="">Select Course</option');
			  }
			});	
	});

$('input[type=text]').addClass('form-control');

$(document).on('click', '#shortlisted_candidate', function(){
														
  if(window.confirm("Are You Sure to Shortlist the Candidate?")){
  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({
	
	   type: 'POST',
	
	   url: $url,
	
	   success: function(data){
		
			$('#short').removeClass();
			$('#candidate_shortlisted').removeClass();			
			$('#candidate_shortlisted').html(data.data);
	   }
			
	 }); 
  }
});



function interview(id1,id2,id3)
{
	$('#candidate_id').val(id1);
   	$('#job_app_id').val(id2);
	$('#job_id').val(id3);
    $('#myModal').modal();
}

$(document).on('click', '#save_candidate3', function(){ 

		var $this = $(this);

		var $url = $this.data('url');
     	
        $.ajax({
			
			type: 'POST',

			url: $url,

			data: $('#candidate_form3').serialize(),

			dataType: "json",

			success: function(data) {

				 if(data.status == 'success'){
					
					$('#myModal').modal('hide');					
					$('#inter').removeClass();
					$('#candidate_interview').removeClass();
					$('#candidate_interview').html(data.data);
					$("#candidate_form3").trigger( "reset" );
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});



function select_candidate(id1,id2,id3)
{
	$('#candidate_id3').val(id1);
   	$('#app_id3').val(id2);
	$('#job_id3').val(id3);
    $('#myModal3').modal();
}

$(document).on('click', '#save_candidate6', function(){ 
													 
		var $this = $(this);

		var $url = $this.data('url');
     	
        $.ajax({
			
			type: 'POST',

			url: $url,

			data: $('#candidate_form6').serialize(),

			dataType: "json",

			success: function(data) {

				 if(data.status == 'success'){
					 
					$('#myModal3').modal('hide');	
					$('#sel').removeClass();
					$('#candidate_selected').removeClass();
					$('#candidate_selected').html(data.data);
					$("#candidate_form3").trigger( "reset" );
					get_select_candidate('<?php echo $intake['intake_id'];?>');
					
				 }
				 else
				 {
					 alert('please Fill the data');
				 }

			}
		});

	});




function accept_offer(id1,id2,id3)
{
	$('#job_id1').val(id1);
	$('#app_id1').val(id2);
	$('#candidate_id1').val(id3);
    $('#myModal1').modal('show');
}

//REJECT OFFER SCRIPT BEGIN
//REJECT OFFER ONCLICK 
function reject_offer(id1,id2,id3)
{
	$('#job_id_reject').val(id1);
	$('#app_id_reject').val(id2);
	$('#candidate_id_reject').val(id3);
    $('#myModal_reject').modal('show');
}
//SAVE REJECT OFFER 
$(document).on('click', '#save_reject', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#reject_form').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModal_reject').modal('hide');
					get_offer_issued('<?php echo $intake['intake_id'];?>');

					$("#reject_form").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
//REJECT OFFER SCRIPT ENDS

//ISSUE OFFER SCRIPT BEGIN
//ONCLICK ISSUE OFFER
function issue_offer(id1,id2,id3)
{
	$('#job_id_io').val(id1);
	$('#app_id_io').val(id2);
	$('#candidate_id_io').val(id3);
    $('#issue_offer_modal').modal('show');
}


//SAVE OFFER ISSUE DETAILS
$(document).on('click', '#save_issue_offer', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#issue_offer_form').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#issue_offer_modal').modal('hide');
					get_offer_issued('<?php echo $intake['intake_id'];?>');

					$("#issue_offer_form").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
//ISSUE OFFER SCRIPT ENDS

//CREEATE CERT ATTEST
function cert_attest(id1,id2,id3,id4)
{
	$('#job_id_cert').val(id1);
	$('#app_id_cert').val(id2);
	$('#candidate_id_cert').val(id3);
	$('#placement_id_cert').val(id4);
	$('#myModalCert').modal('show');
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
					get_cert_attest('<?php echo $intake['intake_id'];?>');

					$("#cert_form").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
//ISSUE OFFER SCRIPT ENDS

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
					$("#candidate_form4").trigger( "reset" );
					get_offer_accepted('<?php echo $intake['intake_id'];?>');
					get_offer_issued('<?php echo $intake['intake_id'];?>');
				 }

				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});

	});


function create_invoice(id1,id2,id3,id4)
{
	$('#job_id2').val(id1);
	$('#app_id2').val(id2);
	$('#candidate_id2').val(id3);
	$('#placement_id2').val(id4);
	$('#myModal2').modal('show');
}

//CREEATE VISA
function create_program(id1,id2)
{
	$('#intake_id_program').val(id2);
	
	$('#candidate_id_program').val(id1);
	
	$('#myModalProgram').modal('show');
}


//CREEATE VISA
function create_visa(id1,id2,id3,id4)
{
	$('#job_id4').val(id1);
	$('#app_id4').val(id2);
	$('#candidate_id4').val(id3);
	$('#placement_id4').val(id4);
	$('#myModalVisa').modal('show');
}


//CREATE MEDICAL

function create_medical(id1,id2,id3)
{ 
	$('#job_id5').val(id1);
	$('#app_id5').val(id2);
	$('#candidate_id5').val(id3);
	
	$('#myModalMedical').modal('show');
}

//CREATE DOCUMENT

function create_document(id1,id2,id3)
{ 
	$('#job_id_doc').val(id1);
	$('#app_id_doc').val(id2);
	$('#candidate_id_doc').val(id3);
	
	$('#myModalDoc').modal('show');
}
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
					get_visa_doc('<?php echo $intake['intake_id'];?>');
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
					get_medical_details('<?php echo $intake['intake_id'];?>');
					$("#candidate_form_medical").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
//CREATE AND SAVE TICKET DETAILS BEGIN

function create_ticket(id1,id2,id3)
{ 
	$('#job_id6').val(id1);
	$('#app_id6').val(id2);
	$('#candidate_id6').val(id3);
	
	$('#myModalTicket').modal('show');
}


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
					get_ticket_details('<?php echo $intake['intake_id'];?>');
					$("#candidate_form_ticket").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

//CREATE AND SAVE TICKET DETAILS END

//CREATE AND SAVE TICKET FOLLOWUP BEGIN

function create_followup(id1,id2,id3)
{ 
	$('#job_id_followup').val(id1);
	$('#app_id_followup').val(id2);
	$('#candidate_id_followup').val(id3);
	
	$('#myModalFollowup').modal('show');
}


	$('#candidate_form_followup').submit(function(evt){
		evt.preventDefault(); 
		
		var $this = $(this);
		var $url =$('#save_followup').data('url');       
     	var formData = new FormData(this);
        $.ajax({
			
			type: 'POST',
			url: $url,
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			
			success: function(data) {

				 if(data.status == 'success'){ 

					$('#myModalFollowup').modal('hide');
					get_ticket_followup('<?php echo $intake['intake_id'];?>');
					$("#candidate_form_followup").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

//CREATE AND SAVE TICKET FOLLOW END

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
					get_visa_details('<?php echo $intake['intake_id'];?>');
					$("#candidate_form_visa").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

//SAVE PROGRAM DETAILS
$(document).on('click', '#save_program', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#candidate_form_program').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){

					$('#myModalProgram').modal('hide');
					get_program_details('<?php echo $intake['intake_id'];?>');
					$("#candidate_form_program").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});

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

$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});



$(document).on('click', '#delete_applied_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');	 
	
	$.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {			
				
				get_candidate_intake('<?php echo $intake['intake_id'];?>');
					
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in programlist');
			}
	   }
			
	 }); 
  }
});



$(document).on('click', '#delete_shortlisted_candidate', function(){
																													
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
					$('#short').addClass('hide');
					$('#candidate_shortlisted').addClass('hide');
					
				} 
				else
				{
					
					$('#candidate_shortlisted').html(data.data);
				}
				
				
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Interview');
			}
	   }
			
	 }); 
  }
});


$(document).on('click', '#delete_interview_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');	 
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   
		   if(data.status == 'success')
		   {	if(data.count == 0)
				{
					$('#inter').addClass('hide');
					$('#candidate_interview').addClass('hide');
					
				} 
				else
				{
					$('#candidate_interview').html(data.data);}
				
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in SelectedList');
			}
	   }
			
	 }); 
  }
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

				get_offer_issued('<?php echo $intake['intake_id'];?>');
				
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Offer Accepted');
			}
	   }
			
	 }); 
  }
});

//ADD TO JOB BEGIN
$(document).on('click', '#add_to_job', function(){																													
 if(window.confirm("Are You Sure to add the Candidate to this Job?")){
  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {		

				if(data.count == 0)
				{
					$('#apply').addClass('hide');
					$('#candidate_applied').addClass('hide');
					
				} 
				else
				{
				
					$('#candidate_applied').html(data.data);
				}
				
	   	   }

	   }
			
	 }); 
 }
});

//ADD TO JOB END
$(document).on('click', '#delete_accept_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the Candidate?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){		   
		   if(data.status == 'success')
		   {	   			

			get_offer_accepted('<?php echo $intake['intake_id'];?>');
			
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in Visa Details ');
			}
	   }
			
	 }); 
  }
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

			get_cert_attest('<?php echo $intake['intake_id'];?>');
			
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
				get_visa_details('<?php echo $intake['intake_id'];?>');
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
				get_visa_doc('<?php echo $intake['intake_id'];?>');
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

			get_medical_details('<?php echo $intake['intake_id'];?>');   	
				
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
			get_ticket_details('<?php echo $intake['intake_id'];?>');
		 }
		 else{
			 alert('Cannot able to delete we have entry in travel followup');
		 }
	   }
			
	 }); 
  }
});
<!--DELETE VISA DETAILS END-->

<!--DELETE TICKET FOLLOWUP BEGIN-->
$(document).on('click', '#delete_followup', function(){																													
  if(window.confirm("Are You Sure to delete ?")){  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){	
	   	 if(data.status == 'success')
		 {
			get_ticket_followup('<?php echo $intake['intake_id'];?>');
		 }
		 else{
			 alert('Cannot able to delete we have entry in Invoice ');
		 }
	   }
			
	 }); 
  }
});
<!--DELETE FOLLOWUP END-->

$(document).on('click', '#edit_interview', function(){																													
 
	var $url= $(this).attr('data-url');
	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   datatype: 'json',
	  

	   success: function (data) {
			
			var selectedDateTime = data.interview_date;
			var splitarray = new Array(); 
			splitarray= selectedDateTime.split(" "); 
			
			$('#job_app_id').val(data.job_app_id);
			$('#candidate_id').val(data.candidate_id);
			$('#title').val(data.title);
			$('#type_id').val(data.interview_type_id);
			$('#status_id').val(data.int_status_id);			
			$('#location').val(data.location);
			$('#datepicker').val(splitarray[0]);
			$('#description').val(data.description);
			$('#myModal').modal('show');
			
   		 }
			
	 }); 
 
});





</script>

