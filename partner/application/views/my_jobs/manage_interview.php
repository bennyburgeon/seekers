
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Manage Interviews</div>
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
	<td colspan="2" align="center" valign="top" id="short" <?php  if(empty($shortlisted)) { ?> class="hide" <?php } ?>><br>
    Candidates Shortlisted 
    </td>
</tr>

<tr id="candidate_shortlisted"  <?php  if(empty($shortlisted)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody>
        <?php foreach($shortlisted as $candidate){?>
        <tr>
          <td width="44%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>
          <td width="31%"><?php echo $candidate['skills'];?></td>          
         <td width="25%"> <a href='javascript:;'  onclick="interview(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" >Interview</a><?php /*?><a href="<?php echo base_url(); ?>my_jobs/addinterview/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $postdata['job_id'];?>">Interview</a><?php */?> |  <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_shortlisted_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_shortlisted_candidate" >Remove</a></td>
          </tr>

       <?php } ?>
        </tbody>
     </table>
    </td>
</tr>
      
  


<tr>
    <td colspan="2" align="center" valign="top" id="inter" <?php  if(empty($interview_list)) { ?> class="hide" <?php } ?>><br>
        Interviews Scheduled
    </td>
</tr>

<tr id="candidate_interview"  <?php  if(empty($interview_list)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    <table border="1" cellpadding="3" cellspacing="3" width="95%" >
          <tbody >
              <tr>
                    <td bgcolor="#CCCCCC">Candidate</td>
                    <td bgcolor="#CCCCCC">Interview Date</td>
                    <td bgcolor="#CCCCCC">Interview Time</td>
                    <td bgcolor="#CCCCCC">Location</td>
                   
                    <td bgcolor="#CCCCCC">Description</td>
               
              </tr>
              <?php foreach($interview_list as $interview){
                  $datetime = explode(" ",$interview['interview_date']);?>
                                                
              
                <tr>
                  <td width="13%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $interview['candidate_id']?>" target="_blank"><?php echo $interview['first_name'].' '.$interview['last_name'];?></a></td>
                  <td width="13%"><?php echo date("d-m-Y", strtotime($datetime[0]));?></td>
                  <td width="13%"><?php echo $interview['interview_time'];?></td>
                  <td width="14%"><?php echo $interview['location'];?></td>
                 
                  <td><a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/edit_interview/?job_app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="edit_interview" >Change</a> | <a href="javascript:;"  data-url="<?php echo base_url(); ?>my_jobs/delete_interview_candidate/?job_app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_interview_candidate" >Remove </a>| <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $interview['candidate_id']?>">Profile </a> | <a href="javascript:;"  <?php /*?>data-url="<?php echo base_url(); ?>my_jobs/select_candidate/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>"<?php */?>onclick="select_candidate(<?php echo $interview['candidate_id'];?>,<?php echo $interview['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" > Select </a></td>
                </tr>
            
        		<?php } ?> 
            
         </tbody>
    </table>
    </td>
</tr>

<tr>
<td colspan="2" align="center"> <?php  if((empty($interview_list)) && (empty($shortlisted)) ){?><h3> No Results For Listing  </h3> <?php }?> </td>
</tr>

</tbody>
</table>
</div>

<!---------- Modal1 for Interview--------------------->

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Education</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form3" name="candidate_form4"> 
             		<input type="hidden" name="candidate_id" id="candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="job_app_id" value="">    
                     <input type="hidden" name="job_id"  id="job_id" value="">      
               
                <table class="hori-form">
                <tbody>
                
                 <tr>
                <td>Interview Title</td>
                 <td><?php echo form_input(array('name'=>'title','id' =>'title', 'class' => 'smallinput'));?> </td>
                </tr>
                
                
                <tr>
                <td>Interview Type</td>
                <td><?php echo form_dropdown('interview_type_id', $interview_type,'','id = "type_id"');?></td>
                </tr>
                
                <tr>
                <td>Interview Status</td>
                 <td><?php echo form_dropdown('int_status_id', $int_status_id,'','id = "status_id"');?></td>
                </tr>
                
                <tr>
                <td>Location</td>
                 <td><?php echo form_input(array('name'=>'location','id'=>'location','class'=>'smallinput'));?></td>
                </tr>
                
                <tr>
                <td>Interview Date</td>
                 <td><input type="text" name="interview_date" class="smallinput datepicker" id="datepicker"  /></td>
                </tr>
                
                <tr>
                <td>Interview Time</td>
                 <td><?php echo form_dropdown('interview_time', $interview_time_ar);?></td>
                </tr>
                
                <tr>

                <td>Description</td>
                 <td><?php echo form_input(array('name'=>'description', 'id'=>'description','class' => 'smallinput'));?> </td>
                </tr>
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>my_jobs/addinterview2" />
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
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>


<!------------------------ modal4 for Select on interview schedule------------------>

<div class="modal fade" id="myModal3" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
          <div class="modal-body">
            <div class="profile_top">
                
                <form class="form-horizontal form-bordered"  method="post" id="candidate_form6" name="candidate_form6" > 
                  
                  <input type="hidden" name="candidate_id" id="candidate_id3"value="">
                  <input type="hidden" name="app_id" id="app_id3" value="">
                  <input type="hidden" name="job_id" id="job_id3" value="">
                  <table class="hori-form">
                    <tbody>
                        
                        <tr>
                            <td>Feedback</td>
                             <td><textarea name="feedback" cols="30" rows="4"></textarea></td>
                        </tr>
                        
                        
                        
                        <tr>
                          <td colspan="2">
                              <span class="click-icons">
                              <input type="button" class="attach-subs" value="Save" id="save_candidate6"  
                              data-url="<?php echo base_url(); ?>my_jobs/select_candidate/<?php echo $formdata['job_id'];?>/?app_id=<?php echo $interview['job_app_id'];?>&candidate_id=<?php echo $interview['candidate_id'];?>">
                              </span>
                          </td>
                	   </tr>
                      </tbody>
                  </table>
                
                </form>
                   
	<!--Followup-->

   </span>  
  </div>
</div>

<!------------------------ end modal4------------------------------->

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>


<script type="text/javascript">

$('input[type=text]').addClass('form-control');

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
			$('#status_id').val(data.interview_type_id);			
			$('#location').val(data.location);
			$('#datepicker').val(splitarray[0]);
			$('#description').val(data.description);
			$('#myModal').modal('show');
			
   		 }
			
	 }); 
 
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



$('#datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});


</script>

