
<div class="col-md-9">
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
                <td colspan="2" align="center" valign="top">
                  <div class="tab-head mar-spec"><h3>Job Details</h3></div>
                </td>
                </tr>
                
                <tr>
                <td colspan="2" align="center" valign="top">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-condensed">

                        <tbody>
                            <tr>
                                <td width="19%"><span><strong>Job Title</strong></span></td>
                                <td width="27%"><span><?php echo $formdata['job_title'];?></span></td>
                                <td width="25%"><span>Job Type</span></td>
                                <td width="29%"><span><?php echo $formdata['job_type'];?></span></td>
                            </tr>
                            
                            <tr>
                                <td><span><strong>Company Name</strong></span></td>
                                <td><span><?php echo $formdata['company_name'];?></span></td>
                                <td><span>Job Level</span></td>
                                <td><span><?php echo $formdata['job_level'];?></span></td>
                            </tr>
                            
                            <tr>
                                 <td><span><strong>Job Industry</strong></span></td>
                                <td><span><?php echo $formdata['industry'];?></span></td>
                                <td><span>Job Category</span></td>
                                <td><span><?php echo $formdata['category'];?></span></td>

                            </tr>
                            
                            <tr>
                                <td><span><strong>Job Work Level</strong></span></td>
                                <td><span><?php echo $formdata['work_level'];?></span></td>
                                <td><span>Functional Area</span></td>
                                <td><span><?php echo $formdata['fun_area'];?></span></td>

                            </tr>
                            
                            <tr>
                               <td><span><strong>Salary</strong></span></td>
                                <td><span><?php echo $formdata['salary_level'];?></span></td>
                                <td><span>Location</span></td>
                                <td><span><?php echo $formdata['job_location'];?></span></td>

                            </tr>
                            
                            <tr>
                                 <td><span><strong>Download Brochure</strong></span></td>
                                <td><?php if(file_exists('uploads/brochure/'.$formdata['brochure']) && $formdata['brochure']!=''){?>
                                <a href="<?php echo $upload_root.'uploads/brochure/'.$formdata['brochure'];?>" target="_blank">Download</a>
                                <?php } ?></td>
                                <td><span>Vacancies</span></td>
                                <td><span><?php echo $formdata['vacancies'];?></span></td>

                            </tr>
                           
                            <tr>
                                 <td><span><strong>Resident Location</strong></span></td>
                                <td><span><?php echo $formdata['res_location'];?></span></td>
                                <td><span>Job Posting Date</span></td>

                                <td><span>Date</span></td>

                            </tr>
                            
                            <tr>
                                <td><span><strong>Nationality</strong></span></td>
                                <td><span><?php echo $formdata['country_name'];?></span></td>
                                <td><span>Expires on</span></td>
                                <td><span>Date</span></td>

                            </tr>
                           
                            <tr>
                                 <td><span><strong>Gender</strong></span></td>
                                <td><span>
                                <?php if($formdata['gender']==1)echo 'Male'; else echo 'Female';?>
                                </span></td>
                                <td>Exp. join date</td>
                                <td>Date</td>
                              
                            </tr>
                            
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                    	</tbody>
            		</table>
             	 </td>
       		</tr>

<?php  if(!empty($suggestions_list)) { ?>

    
            <tr>
              <td colspan="2" align="center" valign="top">
                <div class="tab-head mar-spec">
                  <h3>Suggestions List</h3>
                </div>
                
              </td>
</tr>

<tr id="candidate_applied">
    <td colspan="2" align="center" valign="top">
    
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">

      <thead>
        <tr>
          <th>Name</th>
          <th>Mobile</th>
          <th>Email</th>
          <th>App. Date</th>
          <th>Admin</th>
        
        </tr>
      </thead>

      <tbody >
        <?php foreach($suggestions_list as $candidate){?>
        
        <tr>
          	<td width="24%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a>
</td>          
            <td width="14%"><?php echo $candidate['mobile'];?>
</td> 
            <td width="14%"><?php echo $candidate['username'];?>
 </td>
          
          <td width="12%">&nbsp;</td>
          <td width="11%">&nbsp;</td>

          
          </tr>
     	<tr>
         <td colspan="5">
         <table width="100%" border="0">
  <tbody>
    <tr>
      <td valign="middle" align="left">   CTC == <strong><?php if($candidate['current_ctc']!='')echo $candidate['current_ctc'];else echo 'Nil'; ?></strong> | ECTC== <strong><?php if($candidate['expected_ctc']!='')echo $candidate['expected_ctc'];else echo 'Nil'; ?></strong> | NP== <strong><?php if($candidate['notice_period']!='')echo $candidate['notice_period'];else echo 'Nil'; ?></strong> | Exp== <strong><?php if($candidate['total_experience']!='')echo $candidate['total_experience'];else echo 'Nil'; ?></strong></td>
     
      <td valign="middle" align="right">

 <a href="javascript:;" title="Send Job Description by Email"  data-url="<?php echo base_url(); ?>my_jobs/send_jd/?candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="send_jd"><span class="label label-default"><i class="fa fa-envelope" aria-hidden="true"></i></span></a>&nbsp;
            
<a href="<?php echo base_url(); ?>index.php/candidates_all/edit/<?php echo $candidate['candidate_id'];?>/" title="Edit Candidate Profile" target="_blank"  id="view_cv" class="btn btn-danger btn-xs btn-icon"><i class="fa fa-edit" aria-hidden="true"></i></a>

<a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" title="View Candiadte Summary" target="_blank" class="btn btn-xs btn-primary btn-icon"><i class="fa fa-eye" aria-hidden="true"></i></a>

<a href="<?php echo base_url();?>index.php/candidates_all/print_cv/<?php echo $candidate['candidate_id']?>"  title="Print CV" target="_blank" class="btn btn-xs btn-success btn-icon"><i class="fa fa-print" aria-hidden="true"></i></a>

<?php if($candidate['cv_file']!=''){?>
<a href="<?php echo base_url();?>index.php/candidates_all/download_cv/<?php echo $candidate['candidate_id']?>" title="Download CV" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i> CV</a>
<?php } ?>

<?php if($candidate['linkedin_url']!=''){?>
	<a href="<?php echo $candidate['linkedin_url']?>" title="View Linkedin Profile" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i>Lin</a>
<?php } ?>

  <!--   
            <span class="label label-default" title="Education"><i class="fa fa-book" aria-hidden="true"></i></span>
            
            &nbsp;
            <span class="label label-default" title="Skills"><i class="fa fa-star" aria-hidden="true"></i></span>
            &nbsp;
            <span class="label label-default" title="Experience"><i class="fa fa-trophy" aria-hidden="true"></i></span>
            
            -->

</td>
    </tr>
  </tbody>
</table>

      
                  
         </td>

        </tr>
          
          
       	<?php } ?>
        </tbody>
    </table>
    
	 </td>
</tr>

<?php } ?> 

                        
</tbody>
</table>


<!---------- Modal1 for Interview---------------------><!------------------------ modal4 for Select on interview schedule------------------><!------------------------ MODAL FOR ISSUE OFFER BEGIN------------------><!------------------------ MODAL FOR ISSUE OFFER END------------------>

<!------------------------ MODAL for REJECT OFFER------------------><!------------------------ REJECT ODFFER MODEL END------------------------------->

<!------------------------ modal2 for Accept offer------------------><!------------------------ modal3 for Invoice------------------></div>
</div>
</section>


<script type="text/javascript">

$('input[type=text]').addClass('form-control');

<!--  loading on window on load  --> 

<!---- Interview selection  list load, get selection, all selection related activities ----->
//get selected
get_select_candidate('<?php echo $formdata['job_id'];?>');
function get_select_candidate(job_id)
{ 
	$.ajax({
	   type: 'POST',
		data: {job_id:job_id},
		dataType: "json",
	   url: '<?php echo base_url(); ?>my_jobs/get_select_candidate/',
	   success: function(data){ 
			$('#candidate_schedule1').html(data.data1);
			$('#candidate_schedule2').html(data.data2);
	   }
	 }); 
}
function select_candidate(id1,id2,id3)
{
	$('#candidate_id_select').val(id1);
   	$('#app_id_select').val(id2);
	$('#job_id_select').val(id3);
    $('#select_candidate_modal').modal();
}

$(document).on('click', '#select_candidate_btn', function(){ 													 
		var $this = $(this);
		var $url = $this.data('url'); 
	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#select_candidate_form').serialize(),
			dataType: "json",
			success: function(data) {
	
				 if(data.status == 'success'){					 
					$('#select_candidate_modal').modal('hide');	
					$('#sel').removeClass();
					$('#candidate_selected').removeClass();
					$('#candidate_selected').html(data.data);
					$("#select_candidate_form").trigger( "reset" );
					get_select_candidate('<?php echo $formdata['job_id'];?>');					
				 }
				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});
	});

<!---- end here  ----->

$(document).on('click', '#invoice_btn', function(){ 
		
		var $this = $(this);
		var $url = $this.data('url');       
     	
        $.ajax({
			
			type: 'POST',
			url: $url,
			data: $('#invoice_form').serialize(),
			dataType: "json",
			success: function(data) {

				 if(data.status == 'success'){

					$('#invoice_model').modal('hide');
					$('#invoice').removeClass();
					$('#candidate_invoice').removeClass();	
					$('#candidate_invoice').html(data.data);
					$("#invoice_form").trigger( "reset" );
					
				 }

				 else

				 {

					 alert('please Fill the data');}

			}
		});

	});
	
// get offer issued
get_offer_issued('<?php echo $formdata['job_id'];?>');
function get_offer_issued(job_id)
{ 
	$.ajax({	
	   type: 'POST',		
		data: {job_id:job_id},
		dataType: "json",		
	   url: '<?php echo base_url(); ?>my_jobs/get_offer_issued/',	
	   success: function(data){ 
			$('#candidate_offer1').html(data.data1);
			$('#candidate_offer2').html(data.data2);
	   }			
	 }); 
}

//get offer accepted
get_offer_accepted('<?php echo $formdata['job_id'];?>');
function get_offer_accepted(job_id)
{ 
	$.ajax({	
	   type: 'POST',		
		data: {job_id:job_id},
		dataType: "json",		
	   url: '<?php echo base_url(); ?>my_jobs/get_offer_accepted/',	
	   success: function(data){	
			$('#offer_accepted1').html(data.data1);
			$('#offer_accepted2').html(data.data2);
	   }			
	 });
}

$(document).on('click', '#shortlisted_candidate', function()
{
  if(window.confirm("Are You Sure to Shortlist the Candidate?"))
  {
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


$(document).on('click', '#send_jd', function()
{
  if(window.confirm("Are sou sure want to email candidate with Job Description?"))
  {  
	 var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   //alert(data.email); - how to access json array, data is object set and email is one of the keys
		   	alert('Emailed to '+data.candidate_name);
	   }
	 }); 
  }
});

$(document).on('click', '#send_shortlisted', function()
{
  if(window.confirm("Are sou sure want to email list to client?"))
  {  
	 var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   //alert(data.email); - how to access json array, data is object set and email is one of the keys
		   	alert('Emailed...');
	   }
	 }); 
  }
});

$(document).on('click', '#send_interview_list', function()
{
  if(window.confirm("Are sou sure want to email candidate list for interview?"))
  {  
	 var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){

		   //alert(data.email); - how to access json array, data is object set and email is one of the keys
		   	alert('Emailed....');
	   }
	 }); 
  }
});

/* interview related function modal window, add form, edit form etc. */

function add_interview(id1,id2,id3){
	$('#candidate_id').val(id1);
   	$('#job_app_id').val(id2);
	$('#job_id').val(id3);
    $('#interview_modal').modal();
}

$(document).on('click', '#save_interview', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#interview_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#interview_modal').modal('hide');					
					$('#inter').removeClass();
					$('#candidate_interview').removeClass();
					$('#candidate_interview').html(data.data);
					$("#interview_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});

	});
	
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
			$('#interview_modal').modal('show');			
   		 }			
	 }); 
});

<!-- Interview end here --> 



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
					get_offer_issued('<?php echo $formdata['job_id'];?>');
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
					get_offer_issued('<?php echo $formdata['job_id'];?>');

					$("#issue_offer_form").trigger( "reset" );
					
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
					get_offer_accepted('<?php echo $formdata['job_id'];?>');
					get_offer_issued('<?php echo $formdata['job_id'];?>');
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
	$('#invoice_model').modal('show');
}



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
		   else
		   {
			   alert('Cannot able to delete we have entry in shortlisted list.');
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
			   alert('Cannot able to delete we have entry in interview list');
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
					$('#candidate_interview').html(data.data);
				}				
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
				get_offer_issued('<?php echo $formdata['job_id'];?>');				
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
				get_offer_accepted('<?php echo $formdata['job_id'];?>');			
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in invoice ');
		   }
	   }
			
	 }); 
  }
});

$(document).on('click', '#delete_invoice_candidate', function(){																													
  if(window.confirm("Are You Sure to delete the invoice?")){  
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



</script>