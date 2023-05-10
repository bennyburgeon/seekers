
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>
<div class="row">

<div class="col-md-12">
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
          Applied Candidates</td>
      </tr>

     <tr id="candidate_applied" <?php  if(empty($applied_candidates)) { ?> class="hide" <?php } ?>>
    <td colspan="2" align="center" valign="top">
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="95%">
      <tbody >
        <?php foreach($applied_candidates as $candidate){?>
        <tr>
          <td width="30%"><a href="#" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>
          <td width="20%"><?php echo $candidate['username'];?></td> 
          <td width="15%"><?php echo $candidate['mobile'];?></td> 
          <td width="10%"><?php echo $candidate['skills'];?></td>          
          <td width="35%"><a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/intakes/create_program/?intake_candidate_id=<?php echo $candidate['intake_candidate_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['intake_id'];?>"  id="create_program" > Create Program </a>| <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/intakes/delete_applied_candidate/?job_app_id=<?php echo $candidate['intake_candidate_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['intake_id'];?>"  id="delete_applied_candidate" > Delete Application</a></td>
          
          </tr>
       	<?php } ?>
        </tbody>
    </table>
	 </td>
</tr>

    
        <tr>
                <td align="center" valign="top">&nbsp;
                </td>
        </tr>
                <tr>
                <td align="center" valign="top"><br>
                Filter Candidates Data
                </td>
        </tr>

        <tr>
                <td align="center" valign="">
                        &nbsp;
                        <?php echo form_open_multipart('intakes/addcandidate/'.$postdata['intake_id'], 'name="frmcandidate"');?> <input type="hidden" name="skills" id="skills"/>
                        <?php echo form_dropdown('job_cat_list', $jobcategory, $postdata['job_cat_id'],'id="job_cat_id"');?> &nbsp;
                        <?php echo form_dropdown('func_list', $functional, $postdata['func_id'], 'id="func_id"');?> &nbsp;
                        <select class="" onchange="myFunction();" id="parent"  style="width:150px;margin-bottom:20px;">
                        <option value="">Select Skill</option>
                        <?php foreach($skill_list as $key => $val){?>
                        <option <?php if(isset($res1[0]['skill_id']) && $res1[0]['skill_id']==$key){?> selected="selected" <?php } ?> value="<?php echo $key;?>"><?php echo $val['skill_name'];?></option>
                        <?php }?>
                        </select>
                        
                        <select class="js-example-basic-multiple-cert"  multiple="multiple" id="multiple_skill" style="width:200px;height:5px;">
                        
                        <?php foreach($child_skills as $skill){?>
                        <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?>  value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                        <?php }?>
                        </select>
                        <br/>
                        
                        <?php echo form_dropdown('level_id', $edu_level_list, $postdata['level_id'], 'style="width:200px;" id="level_id"');?> &nbsp;
                        <!--</td></tr><tr><td>-->    
                        <?php echo form_dropdown('course_id', $edu_course_list, $postdata['course_id'], 'style="width:200px;margin-bottom:15px;" id="course_id_edu" ');?> &nbsp;
                        
                       
                        <!--<?php echo form_dropdown('exp_years', $years_list, $postdata['exp_years'], 'style="width:200px;"');?> &nbsp;-->
                        <select class=""  name="exp_years"  style="width:200px;">
                        <option value="" >Select Experience </option>
                        <?php foreach($years_list as $key => $val){?>
                        <option <?php if($postdata['exp_years']!='' && $postdata['exp_years']==$key){?> selected="selected" <?php } ?> value="<?php echo $key;?>"><?php echo $val;?></option>
                        <?php }?>
                        </select><br/>
                                        Contract Start Date
                 <input type="text" name="contract_start_date" class=" datepicker" id="" value="<?php echo $postdata['contract_start_date']; ?>" />Contract End Date
                 <input type="text" name="contract_end_date" class=" datepicker" id="" value="<?php echo $postdata['contract_end_date']; ?>"  />
                        <br/>Certificate
                        <input type="hidden" name="cert" id="cert"/>
                        <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_cert"  style="width: 200px;padding:6px;">
                        <?php foreach($cerifications as $cert){?>
                        <option <?php   if (in_array($cert['cert_id'], $candidate_certifications)){ ?> selected="selected" <?php  } ?>  value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
                        <?php }?>
                        </select>
                        
                        <?php /*?><?php echo form_dropdown('country_list', $nationality, $postdata['country_id'], 'onChange="document.frmcandidate.country_id.value=this.value;"');?> &nbsp;
                        <?php */?>
                        <button class="radius3" onclick="search_submit();" id="applyfilter">Apply Filter</button>
                        
                        <!--</div>-->  <br>
                        <br>
                        
                        <?php echo form_hidden('intake_id', $postdata['intake_id']);?>
                        <?php echo form_hidden('job_cat_id', $postdata['job_cat_id']);?>
                        <?php echo form_hidden('func_id', $postdata['func_id']);?>
                        <?php /*?> <?php echo form_hidden('country_id', $postdata['country_id']);?>
                        <?php */?>  
                </td>
        </tr>
      <tr>
        <td align="center" valign="top"><br>
      	<br>
      	<form class="form-horizontal form-bordered" method="post" id="summary" name="summary" action="<?php echo base_url(); ?>index.php/intakes/addcandidate/<?php echo $postdata['intake_id'];?>"> 
      	<input name="job_id" value="<?php echo $postdata['intake_id'];?>" type="hidden">
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
            <th colspan="6" align="right"><button  title="table1">Add to intake</button></th>
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
            <th colspan="6"  align="right"><button class="addbutton radius3" title="table1">Add to intake</button></th>
            </tr>
      </tfoot>
    <tbody>
      <?php 
				foreach($candidates as $result){ 
			?>
      <tr>
        <td align="center"><input type="checkbox" id="delete_rec<?php echo $result['candidate_id']?>" name="delete_rec[]" value="<?php echo $result['candidate_id']?>" /></td>
        <td><?php echo $result['first_name'].' '.$result['last_name'];?></td>
        <td><?php echo $result['username']?></td>
        <td><?php echo $result['total_exp']?></td>
        <td class="center"><?php echo $result['skills']?></td>
        <td class="center">
          <?php if(file_exists('uploads/cvs/'.$result['cv_file']) && $result['cv_file']!=''){?>
          <a href="<?php echo $upload_root.'uploads/cvs/'.$result['cv_file'];?>" target="_blank">View</a>
          <?php } ?></td>
        
        </tr>
      <?php }?>
      
      
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
            	<li id="tab_2btn">Education</li>            
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
                  data-url="<?php echo $this->config->site_url();?>/intakes/addinterview2" />
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

<script type="text/javascript">

$(".js-example-basic-multiple-cert").select2();
$(".js-example-basic-multiple-skill").select2();
//onchange of job_category

	$('#job_cat_id').change(function() 
	{
	
		jQuery('#func_id').html('');
		jQuery('#func_id').append('<option value="">Select Functional Role</option');
			
		if($('#job_cat_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/intakes/getfunction/',
			  data: { category_id: $('#job_cat_id').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#func_id').html('');
					  jQuery('#func_id').append(data.function_list);

					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Please try again');
					jQuery('#func_id').html('');
					jQuery('#func_id').append('<option value="">Select Function</option');
			  }
			});	
	});
function myFunction()
{
	$(".js-example-basic-multiple-skill").hide();
	  var parnt =$('#parent').val();
	
	if(parnt!='')
	{
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
	 else{
		 	$('#multiple_skill').val('');
			$('#multiple_skill').html('');
	 }
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



$(document).on('click', '#create_program', function(){
														
  if(window.confirm("Are You Sure to Shortlist the Candidate?")){
  
	  var $url= $(this).attr('data-url');
	 
	 $.ajax({
	
	   type: 'POST',
	
	   url: $url,
	
	   success: function(data){
		   
			
		$('#candidate_shortlisted').html(data.data);
	   }
			
	 }); 
  }
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
				$('#candidate_applied').html(data.data);
	   	   }
		   else
		   {
			   alert('Cannot able to delete we have entry in shortlist');
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
$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});
	function search_submit()
	{
		var multiple_skill	=	$('#multiple_skill').val();
		$('#skills').val(multiple_skill);
		
		var multiple_cert	=	$('#multiple_cert').val();
		$('#cert').val(multiple_cert);
		
	}
	
	$('#level_id').change(function() 
	{
	
		jQuery('#course_id_edu').html('');
		jQuery('#course_id_edu').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_all/getcourses/',
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

				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#course_id_edu').html('');
					jQuery('#course_id_edu').append('<option value="">Select Course</option');
			  }
			});	
	});
</script>