
<?php if($this->input->get('del')==1){?> 
    <div class="alert alert-success alert-dismissable col-md-9">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Cannot able to delete we have entry in Interview</strong>
    </div>
<?php } ?>
<?php if($this->input->get('del')==2){?> 
    <div class="alert alert-success alert-dismissable col-md-9">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Record deleted..</strong>
    </div>
<?php } ?>

<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
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
                    <td align="left" valign="top"><br>
                    <br></td>
                </tr>
                <tr>
                    <td align="center" valign="top"><br>
                    Candidates Shortlisted For This Job</td></tr>
                    
                <tr>
                    <td align="center" valign="top">
                    
                    <table border="1" cellpadding="3" cellspacing="3" width="95%">
                        <tbody>
							<?php foreach($shortlisted_candidates as $candidate){?>
                            <tr>
                                <td width="44%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>
                                <td width="31%"><?php echo $candidate['skills'];?></td>          
                                <td width="25%"> <a href='javascript:;'  onclick="interview(<?php echo $candidate['candidate_id'];?>,<?php echo $candidate['job_app_id'];?>,<?php echo $formdata['job_id'];?>);" >Interview</a> |  <a href="<?php echo base_url(); ?>my_jobs/delete_shortlisted/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>" >Remove </a></td>
                            
                        
                            </tr>
                
                             <?php } ?>
            			</tbody>
    			    </table>    
                  </td>
               </tr>
    
                <tr>
                <td align="center" valign="top">&nbsp;</td>
                </tr>
                
                <tr>
                <td align="center" valign="top"><div class="tableoptions">Select from the list.
                </div>             
                
                </td>
                </tr>                        

  <tr>
    <td align="center" valign="top"><br>
  <br>
  <form class="form-horizontal form-bordered" method="post" id="summary" name="summary" action="<?php echo base_url(); ?>my_jobs/shortlist/<?php echo $postdata['job_id'];?>"> 
  <input name="job_id" value="<?php echo $postdata['job_id'];?>" type="hidden">
   <input name="app_id" value="<?php echo $postdata['app_id'];?>" type="hidden">
  <table cellpadding="0" cellspacing="0" border="1" id="table1" width="90%" class="stdtable stdtablecb">
    <colgroup>
      <col class="con0" style="width: 4%" />
      <col class="con1" />
      <col class="con0" />
      <col class="con1" />
      <col class="con0" />
      
      
      </colgroup>
    <thead>
      <tr>
        <th colspan="6" align="right"><button  title="table1">Short List</button></th>
        </tr>
      <tr>
        <th class="head0">&nbsp;</th>
        <th class="head1">Name</th>
        <th class="head0">Email</th>
        <th class="head1">Total Exp.</th>
        <th class="head0">Skills</th>
        <th class="head1">View CV</th>
        
        </tr>
      </thead>
    <tfoot>
      <tr>
        <th class="head0">&nbsp;</th>
        <th class="head1">Name</th>
        <th class="head0">Email</th>
        <th class="head1">Total Exp.</th>
        <th class="head0">Skills</th>
        <th class="head1">View CV</th>
        
        </tr>
      <tr>
        <th colspan="6"  align="right"><button class="addbutton radius3" title="table1">Short List</button></th>
        </tr>
      </tfoot>
    <tbody>
		  <?php foreach($applied_candidates as $result){?>
          <tr>
            <td align="center"><input type="checkbox" id="candidate_id<?php echo $result['candidate_id']?>" name="candidate_id[]" value="<?php echo $result['candidate_id']?>" /></td>
            <td>
            <input type="hidden" name="app_id[]" value="<?php echo $result['job_app_id']?>">
             <?php echo $result['first_name'].' '.$result['last_name'];?></td>
            <td><?php echo $result['username']?></td>
            <td><?php echo $result['exp_years']?></td>
            <td class="center"><?php echo $result['skills']?></td>
            <td class="center">
              <?php if(file_exists('uploads/cvs/'.$result['cv_file']) && $result['cv_file']!=''){?>
              <a href="<?php echo $upload_root.'uploads/cvs/'.$result['cv_file'];?>" target="_blank">View</a>
              <?php } ?></td>
            
            </tr>
          <?php 
					}
				?>
      
      
      </tbody>
    </table>
  </form>
  <br>
  <br>
  <br>
      <br>
      <br>
  <br></td>
    </tr>
</tbody></table>

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

</script>