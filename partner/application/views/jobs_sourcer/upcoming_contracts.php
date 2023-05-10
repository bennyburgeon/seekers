
<div class="col-md-12">
<div class="profile_top">
<div class="profile_top_left">Summary</div>
<div class="profile_top_right">
<br>
<a href="<?php echo base_url();?>index.php/jobs/manage/<?php echo $postdata['job_id'];?>">Back to Summary</a>	&nbsp;&nbsp;&nbsp;
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
    
    
    <table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
      <tbody >
        <?php foreach($applied_candidates as $candidate){?>
        <tr>
          <td width="44%"><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $candidate['candidate_id']?>" target="_blank"><?php echo $candidate['first_name'].' '.$candidate['last_name'];?></a></td>
          <td width="45%"><?php echo $candidate['username'];?></td>          
          <td width="11%">

     <a href="javascript:;" title="Short List this candidate"  data-url="<?php echo base_url(); ?>index.php/jobs/shortlist2/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="shortlisted_candidate" class="btn btn-info btn-xs"> Short List </a>
          
          | 

   <a href="javascript:;" title="Delete this application"  data-url="<?php echo base_url(); ?>index.php/jobs/delete_applied_candidate/?job_app_id=<?php echo $candidate['job_app_id'];?>&candidate_id=<?php echo $candidate['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"   id="delete_applied_candidate" class="btn btn-danger btn-xs btn-icon"><i class="fa fa-trash" aria-hidden="true"></i></a>
             
          </td>
          
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
                      
                        <?php echo form_open_multipart('jobs/addcandidate/'.$postdata['job_id'], 'name="frmcandidate"');?> <input type="hidden" name="skills" id="skills"/>
                        <!-- 
						<?php echo form_dropdown('job_cat_id', $jobcategory, $postdata['job_cat_id'],'id="job_cat_id"');?> &nbsp;
                        <?php echo form_dropdown('func_id', $functional, $postdata['func_id'], 'id="func_id"');?> &nbsp;
                        -->
                        
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
                        </select>
        <!--                 
                        <br/>
                                        Contract Start Date
                 <input type="text" name="contract_start_date" class=" datepicker" id="" value="<?php echo $postdata['contract_start_date']; ?>" />Contract End Date
                 <input type="text" name="contract_end_date" class=" datepicker" id="" value="<?php echo $postdata['contract_end_date']; ?>"  />
                        <br/>
        -->           
                        
                        Certificate
                        <input type="hidden" name="cert" id="cert"/>
                        <select class="js-example-basic-multiple-cert" multiple="multiple" id="multiple_cert"  style="width: 200px;padding:6px;">
                        <?php foreach($cerifications as $cert){?>
                        <option <?php   if (in_array($cert['cert_id'], $candidate_certifications)){ ?> selected="selected" <?php  } ?>  value="<?php echo $cert['cert_id'];?>"><?php echo $cert['cert_name'];?></option>
                        <?php }?>
                        </select>
                        
                       
                        <button class="radius3" onclick="search_submit();" id="applyfilter">Apply Filter</button>
                        
                        <!--</div>-->  <br>
                        <br>
                        
                        <?php echo form_hidden('job_id', $postdata['job_id']);?>
                        <?php /*?> <?php echo form_hidden('country_id', $postdata['country_id']);?>
                        <?php */?>  
                        <?php echo form_close();?>
                        
                </td>
        </tr>                        

      <tr>
        <td align="center" valign="top"><br>
        <?php echo $pagination; ?> &nbsp;&nbsp;
      	<br>
      	<form class="form-horizontal form-bordered" method="post" id="summary" name="summary" action="<?php echo base_url(); ?>index.php/jobs/addcandidate/<?php echo $postdata['job_id'];?>"> 
      	<input name="job_id" value="<?php echo $postdata['job_id'];?>" type="hidden">
      	<table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
        	<colgroup>
          		<col class="con0" style="width: 4%" />
          		<col class="con1" />
          		<col class="con0" />
          		<col class="con1" />
          		<col class="con0" />
          </colgroup>
        <thead>
          <tr>
            <th colspan="5" align="right"><button name="add_to_job" value="1"  title="table1">Add to job</button> | <button name="invite_to_job" value="1"  title="table1">Invite to job</button></th>
            <th width="17%" align="right">  Total Records - <?php echo $total_rows;?></th>
            </tr>
          <tr>
            <th width="3%" class="head0">&nbsp;</th>
            <th width="32%" class="head1">Name</th>
            <th width="26%" class="head0">Email</th>
            <th width="8%" class="head1">Total Exp.</th>
            <th width="14%" class="head0">Skills</th>
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
            <th colspan="5"  align="right"><button name="add_to_job" value="1"  title="table1">Add to job</button> | <button name="invite_to_job" value="1"  title="table1">Invite to job</button></th>
            <th  align="right">Total Records - <?php echo $total_rows;?></th>
            </tr>
      </tfoot>
    <tbody>
      <?php 
				foreach($candidates as $result){ 
			?>
      <tr>
        <td align="center"><input type="checkbox" id="candidate_id<?php echo $result['candidate_id']?>" name="candidate_id[]" value="<?php echo $result['candidate_id']?>" /></td>
        <td><a href="<?php echo base_url();?>index.php/candidates_all/edit/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['first_name'].' '.$result['last_name'];?></a><?php if(($result['candidate_id']==$result['emailed']) && $result['emailed']!=''){?>&nbsp;&nbsp;&nbsp;<a href="javascript:;" title="Add to Applications" class="btn btn-info btn-xs">Emailed </a><?php } ?></td>
        <td><?php echo $result['username']?></td>
        <td><?php echo $result['exp_years']?></td>
        <td class="center"> <?php if(file_exists('uploads/cvs/'.$result['cv_file']) && $result['cv_file']!=''){?>
          <a href="<?php echo $upload_root.'uploads/cvs/'.$result['cv_file'];?>" target="_blank">View</a>
          <?php } ?></td>
        <td class="center">
        
        <a href="javascript:;" title="Add to Applications"  data-url="<?php echo base_url(); ?>index.php/jobs/add_candidate_to_job/?candidate_id=<?php echo $result['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="add_candidate_to_job" class="btn btn-info btn-xs"> Add to Job </a>
        
            |  <a href="javascript:;" title="Send Job Description by Email"  data-url="<?php echo base_url(); ?>index.php/jobs/send_jd/?candidate_id=<?php echo $result['candidate_id'];?>&job_id=<?php echo $formdata['job_id'];?>"  id="send_jd"><span class="label label-default"><i class="fa fa-envelope" aria-hidden="true"></i></span></a>&nbsp;
            
<a href="<?php echo base_url(); ?>index.php/candidates_all/edit/<?php echo $result['candidate_id'];?>/" title="Edit Candidate Profile" target="_blank"  id="view_cv" class="btn btn-danger btn-xs btn-icon"><i class="fa fa-edit" aria-hidden="true"></i></a>

<a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $result['candidate_id']?>" title="View Candiadte Summary" target="_blank" class="btn btn-xs btn-primary btn-icon"><i class="fa fa-eye" aria-hidden="true"></i></a>

<a href="<?php echo base_url();?>index.php/candidates_all/print_cv/<?php echo $result['candidate_id']?>"  title="Print CV" target="_blank" class="btn btn-xs btn-success btn-icon"><i class="fa fa-print" aria-hidden="true"></i></a>

<?php if($result['cv_file']!=''){?>
<a href="<?php echo base_url();?>index.php/candidates_all/download_cv/<?php echo $result['candidate_id']?>" title="Download CV" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i> CV</a>
<?php } ?>

<?php if($result['linkedin_url']!=''){?>
	<a href="<?php echo $result['linkedin_url']?>" title="View Linkedin Profile" target="_blank" class="btn btn-xs btn-info"><i class="fa fa-file-text" aria-hidden="true"></i>Lin</a>
<?php } ?>
         </td>
        
        </tr>     
      <?php }?>
      
      
      </tbody>
    </table>
  </form>
  <br>
 <?php echo $pagination; ?> &nbsp;&nbsp; `
  <br>
      <br>
      <br>
  <br></td>
    </tr>
</tbody></table>

<!---------------------------Modal for Interview------------------------->

  
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
			  url: '<?php echo $this->config->site_url();?>/jobs/getfunction/',
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

$(document).on('click', '#add_candidate_to_job', function()
{
  if(window.confirm("Are sou sure want to add candidate to this Job?"))
  {  
	 var $url= $(this).attr('data-url');	
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   //alert(data.email); - how to access json array, data is object set and email is one of the keys
		   	alert('Emailed to '+data.candidate_name);
			location.reload(true)
	   }
	 }); 
  }
});



$(document).on('click', '#shortlisted_candidate', function(){
														
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