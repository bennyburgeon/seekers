
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Job Application</div>
<div class="profile_top_right">
<br>

</div>
<div style="clear:both;"></div>
</div>


<div style="border:solid;height:auto;">

<table border="0" cellpadding="3" cellspacing="3" width="100%">

  <tbody>

      
      <tr>
        <td align="center" valign="top"><br>
         <div class="tab-head mar-spec"><h3>Job Applications</h3></div></td>`
      </tr>

      <tr id="candidate_applied" <?php  if(empty($applied_candidates)) { ?> class="hide" <?php } ?>>
    	<td colspan="2" align="center" valign="top">
    
    
            <table border="1" cellpadding="3" cellspacing="3" width="95%"  class="table table-bordered table-condensed">
              <tbody >
						<?php foreach($applied_candidates as $candidate){?>
                        <tr>
                          <td>Full Name</td>
                          <td>Email</td>
                          <td>Actions</td>
                        </tr>
                        <tr>
                            <td width="44%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>
                            <td width="31%"><?php echo $candidate['username'];?></td>          
                            <td width="25%">
                            
          

     <a href="javascript:;" title="Short List this candidate"  data-url="<?php echo base_url(); ?>jobs/shortlist_jquery/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="shortlisted_candidate" class="btn btn-info btn-xs"> Short List </a>
     							
        <a href="<?php echo base_url(); ?>jobs/reject_from_application/?job_app_id=<?php echo $candidate['job_app_id'];?>&job_id=<?php echo $formdata['job_id'];?>" title="Reject this candidate" id="reject_from_application" class="btn btn-warning btn-xs"> Reject</a>
         
        <a href="javascript:;" title="Delete this application"  data-url="<?php echo base_url(); ?>jobs/delete_applied_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_applied_candidate" class="btn btn-danger btn-xs btn-icon"><i class="fa fa-trash" aria-hidden="true"></i></a>
        
                        </td>
                        
                        </tr>
                        <?php } ?>
                </tbody>
            </table>
	 </td>
</tr>


      <tr>
        <td align="center" valign="top"><br>
         <div class="tab-head mar-spec"><h3>Candidates Shortlisted</h3></div></td>`
      </tr>

<tr id="candidate_shortlisted"  <?php  if(empty($shortlisted)) { ?> class="hide" <?php } ?>>

    <td colspan="2" align="center" valign="top">
    
    
        <table border="1" cellpadding="3" cellspacing="3" width="95%"  class="table table-bordered table-condensed">
            <tbody>
				<?php foreach($shortlisted as $candidate){?>
                <tr>
                  <td>Full Name</td>
                  <td>Skills</td>
                  <td>Actions</td>
                </tr>
                <tr>
                <td width="44%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>
                <td width="31%"><?php echo $candidate['skills'];?></td>          
                <td width="25%"> <a href='javascript:;'  onclick="interview(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" >Interview</a><?php /*?><a href="<?php echo base_url(); ?>jobs/addinterview/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $postdata['job_id'];?>">Interview</a><?php */?> |  <a href="javascript:;"  data-url="<?php echo base_url(); ?>jobs/delete_shortlisted_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="delete_shortlisted_candidate" >Remove</a></td>
                </tr>
                
                <?php } ?>
            </tbody>
        </table>
    </td>
</tr>      
</tbody>
</table>

<!---------------------------Modal for Interview------------------------->

<div class="modal fade" id="myModal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Job Applications</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes">
            
            <p id="result"></p>
            <p id="deletemessage"></p>
            
            
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form3" name="candidate_form3"> 
             		<input type="hidden" name="candidate_id" id="candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="job_app_id" value="">     
               		<input type="hidden" name="job_id"  id="job_id" value="">     
                <table class="hori-form">
                <tbody>
                
                <tr>
                <td>Interview Title</td>
                 <td><?php echo form_input(array('name'=>'title', 'class' => 'smallinput'));?> </td>
                </tr>
                
                
                <tr>
                <td>Interview Type</td>
                 <td><?php echo form_dropdown('interview_type_id', $interview_type);?></td>
                </tr>
                
                <tr>
                <td>Interview Status</td>
                 <td><?php echo form_dropdown('int_status_id', $int_status_id);?></td>
                </tr>
                
                <tr>
                <td>Location</td>
                 <td><?php echo form_input(array('name'=>'location','class'=>'smallinput'));?></td>
                </tr>
                
                <tr>
                <td>Interview Date</td>
                 <td><input type="text" name="interview_date" class="smallinput" id="datepicker" /></td>
                </tr>
                
                <tr>
                <td>Interview Time</td>
                 <td><?php echo form_dropdown('interview_time', $interview_time_ar);?></td>
                </tr>
                
                <tr>
                <td>Description</td>
                 <td><?php echo form_input(array('name'=>'description', 'class' => 'smallinput'));?> </td>
                </tr>
                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>jobs/addinterview2" />
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
 

<!-------------------End Modal-------------------------------------->



<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript">

$(".js-example-basic-multiple-cert").select2();
$(".js-example-basic-multiple-skill").select2();

function myFunction()
{
	$(".js-example-basic-multiple-skill").hide();
	  var parnt =$('#parent').val();
	 
	  $.ajax({
      type: "get",
      async: true,
      url: "<?php echo site_url('manage_data/child_skill'); ?>",
      data: {'id':parnt},
      dataType: "json",
      success: function(res) {
       
       create_checkbox(res);
     
     console.log(res['skillset']);
    
							} 
			});  
   }

function create_checkbox(res)
{ 
	var skillset=res['skillset'];
	var count=skillset['length'];
	

	if(count>0)
	{
	$('#skill-tr').show();
	$('#multiple_skill').val('');
	$('#multiple_skill').html('');
	$('#multiple_skill').append('<option value="">Select Skills</option>');
	for(var k=0;k<count;k++)
	{   
		//i+=1;
		//j=i%3;
		//var checks="<td><input type='checkbox' name='skills[]' value='add'/>"+skillset[k]['skill_name']+"</td>";
		var option	=	'<option value="'+skillset[k]['skill_id']+'">'+skillset[k]['skill_name']+'</option>';
		
		$('#multiple_skill').append(option);

	}
	}
	else{
		$('#skill-tr').hide();
		$('#multiple_skill').val('');
		$('#multiple_skill').html('');
	}
	
}


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


$('#datepicker').datepicker({
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
			   alert('Cannot able to delete we have entry in shortlist');
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

function search_submit()
{
	var multiple_skill	=	$('#multiple_skill').val();
	$('#skills').val(multiple_skill);
	
	var multiple_cert	=	$('#multiple_cert').val();
	$('#cert').val(multiple_cert);
	
}
</script>