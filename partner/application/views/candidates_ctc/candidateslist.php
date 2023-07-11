<style>

th{
	font-weight:bold; font-family:Verdana, Geneva, sans-serif; 
}
</style>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?> </li>
      </ul>
</div>
 		<div class="alert alert-success alert-dismissable hide" id="reset_msg">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Sucess !</strong>Reset Password Link Sent
        </div>
        <div class="alert alert-success alert-dismissable hide" id="reset_msg_error" style="color:#F00">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Oops !</strong>Reset Password Link not sent
        </div>
	<?php  if($this->input->get('csv')==1){ ?> 
        <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
        <strong>Sucess !</strong>csv file uploaded successfully.
        </div>
    <?php }?>
    <?php if($this->input->get('upload_err')==1){?> 
        <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
        <strong>upload failed.</strong>
        </div>
    <?php }?>
    <?php if($this->input->get('file_type_err')==1){?> 
        <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
        <strong>support csv file only.</strong>
        </div>
    <?php }?>
 	<?php if($this->input->get('ins')==1){?>  
               
          <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong>Sucess !</strong>record added successfully.
            </div>
             <?php } 
             if($this->input->get('multi')==1){?>  
           
          <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong>Records !</strong> Deleted successfully.
            </div>
            
          <?php } 
           if($this->input->get('del')==1){?> 
           <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong>record deleted..</strong>
            </div>
                 <?php }
                 
                 if($this->input->get('upd')==1){?>  
           
          <div class="alert alert-success alert-dismissable">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                <strong>Sucess !</strong>record updated successfully.
            </div>
          <?php }?>
            <?php if($this->session->flashdata('msg')){?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
        <strong><?php echo $this->session->flashdata('msg');?></strong>
    </div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">


<div class="right-btns">

<a href="<?php echo base_url();?>candidates_ctc/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
</div>


<!-- 
<div class="actions">
<a href="<?php echo site_url('candidates_ctc/import_csv');?>" class="btn btn-default btn-circle">
<i class="fa fa-plus"></i>
<span class="hidden-480">
Import CSV </span>
</a>
</div>
-->
<br>
<form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>candidates_ctc/">
        <table class="tool-table">
            <tbody>
            
                <tr>
                    <td><input class="form-control" type="text" name="search_name" id="search_name" value="<?php echo $search_name;?>" 
                    placeholder="Name" style="width: 150px;"></td>
                    
                    <td><input class="form-control" type="text" name="search_email" id="search_email" value="<?php echo $search_email;?>" 
                    placeholder="Email" style="width: 110px;"></td>
                    
                   <td><input class="form-control" type="text" name="search_mobile" id="search_mobile" value="<?php echo $search_mobile;?>" 
                   placeholder="Mobile" style="width: 130px;"></td>

				   <input type="hidden" name="skills" id="skills"/>
<!-- 
                    <td >
                        
                        <select class="form-control" onchange="myFunction();" id="parent"  style="width:150px;">
                        <option value="">Select  Skill</option>
                        <?php foreach($skill_list as $key => $val){?>
                        <option <?php if(isset($res1[0]['skill_id']) && $res1[0]['skill_id']==$key){?> selected="selected" <?php } ?> 
                        value="<?php echo $key;?>"><?php echo $val['skill_name'];?></option>
                        <?php }?>
                        </select>
                    </td>
    
                    <td>
                        <select class="js-example-basic-multiple-cert"  multiple="multiple" id="multiple_skill" style="width:150px;">
                        <option value="">Select  Skills</option>
                        <?php foreach($child_skills as $skill){?>
                        <option <?php   if (in_array($skill['skill_id'], $candidate_skills)){ ?> selected="selected" <?php  } ?> 
                         value="<?php echo $skill['skill_id'];?>"><?php echo $skill['skill_name'];?></option>
                        <?php }?>
                        </select>
                    
                    
                    </td>
                    
                    <td ><select class="form-control"  name="exp_years"  >
                      <option value="" >Exp. >=</option>
                      <?php foreach($years_list as $key => $val){?>
                      <option <?php if($exp_years !='' && $exp_years==$key){?> selected="selected" <?php } ?> 
                            value="<?php echo $key;?>"><?php echo $val;?></option>
                      <?php }?>
                    </select>
                      
                      
                    </td>
                    -->
                     <td><?php echo form_dropdown('job_folder_id',  $job_folders, $job_folder_id,'class="form-control " id="job_folder_id" style="width:150px"');?></td>	
                     
                     <td><?php echo form_dropdown('reg_status',  $reg_status_list, $reg_status,'class="form-control " id="reg_status" style="width:150px"');?></td>

<td>

 <?php echo form_dropdown('cur_job_status',  $job_status_list, $cur_job_status,'class="form-control " id="cur_job_status" style="width:150px"');?>
</td>
                    
                    
          <td>
                    <input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" />
                    </td>
                                                 
                </tr>
                
            </tbody>
        </table>
</form>  

<form name="form1" method="post" id="form1" action="#" >

<div class="sep-bar">
<div class="page">
</div>
<div class="page">
<table border="0">
<tr>
 <td> 
 <?php  echo form_dropdown('job_id',  $all_jobs_list, '','class="form-control" id="job_id" style="width:400px;"');?> 
 </td>
 <td> 
<input type="button" id="assign_to_job" value="Add To Job" class="btn btn-default btn-circle" />&nbsp;&nbsp;
 </td>
  <td> 
 <?php echo form_dropdown('cur_job_status',  $job_status_list, $cur_job_status,'class="form-control " id="cur_job_status" style="width:150px"');?>
 </td>	
  <td> &nbsp;&nbsp;
<input type="button" id="btn_change_status" value="Change Status" class="btn btn-default btn-circle" />
 </td>	
</tr>
</table>
</div>




<div class="views_section">

<div class="found"><span>Found total&nbsp; | <?php echo $total_rows;?> records</span></div>
</div>
</div>

<div style="clear:both;"></div>


<table class="tool-table new">
    <thead>
        <tr role="row" class="heading">
            <th width="20"><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
            <th width="102">Photo</th>
            <th width="384"><a href="<?php echo $this->config->site_url()?>/candidates_ctc?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>"> Name</a></th>

            
            <th width="102">CTC </th>
            <th width="92">ECTC</th>
            <th width="88" class="head0">Exp.</th>
             <th width="55" class="head0">Notice</th>
        </tr>
    </thead>

    <tbody>
    
    <?php if($records!=NULL)
    {
    $i=0;
    foreach($records as $result){ 
    $i+=1;
    ?>
    
        <tr class="odd gradeX">
        
            <td align="center"><input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['candidate_id']?>" ></td>
             <td>
                         <?php if($result['photo']!=''){?><img height="31" width="31" src="<?php echo base_url().'uploads/photos/'.$result['photo'];?>"><?php }else{ ?> 
                      
                       <img height="31" width="31" src="<?php echo base_url().'uploads/photos/no_photo.png';?>">
                       
                      <?php } ?>
             
             </td>
            <td>			
            <a href="<?php echo base_url();?>candidates_ctc/summary/<?php echo $result['candidate_id']?>" target="_blank" class="views" title="View"> <strong><?php echo $result['first_name']?></strong></a> 
            
             || <?php echo $result['username'];?> || <strong><?php echo $result['mobile'];?></strong>
             <br>Total Apps: <?php echo $result['total_job_apps'];?> || SL: <?php echo $result['total_shortlisted'];?> || Int:  <?php echo $result['total_interview'];?> || Int Rej:  <?php echo $result['total_interview_rej'];?> ||  Sel:  <?php echo $result['total_selection'];?> 
            
            <br>Education: <?php if($result['total_edu']>0)echo 'Updated';else echo 'Not Updated';?>
            <br>Job Profile: <?php if($result['total_job_profile']>0)echo 'Updated';else echo 'Not Updated';?>
            <br>Skills: <?php if($result['total_skills']>0)echo 'Updated';else echo 'Not Updated';?>
            <br>Job Status: <?php if($result['cur_job_status_name']!='')echo $result['cur_job_status_name'];else echo 'Not Updated';?> 
            <br> Last Udate: <?php echo $result['ctc_updated_on'];?>
            
            <br> Consultant Feedback:<?php if($result['consultant_feedback']!='')echo 'Updated';else echo 'Not Updated';?> 
            <br>
            
            <?php if($result['reg_status']=='0'){?>
               <br>
         <a href="#" class="btn btn-danger btn-xs"> Dont Know </a>
            || 
             <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=1">Open For Job</a> || 
             <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=2">Placed</a> || 
             <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=3">Black List</a>
            <?php } ?>

            <?php if($result['reg_status']=='1'){?>
               <br>
        <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=0">Dont Know</a> 
            || 
          <a href="#" class="btn btn-danger btn-xs">  Open For Job </a> || 
             <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=2">Placed</a> || 
             <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=3">Black List</a>
            <?php } ?>

<?php if($result['reg_status']=='2'){?>
               <br>
        <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=0">Dont Know</a> 
            || 
           <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=1">Open For Job</a> ||
            <a href="#" class="btn btn-danger btn-xs">  Placed </a>|| 
             <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=3">Black List</a>
            <?php } ?>

<?php if($result['reg_status']=='3'){?>
               <br>
        <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=0">Dont Know</a> 
            || 
           <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=1">Dont Know</a> ||
            <a class="btn btn-info btn-xs" href="<?php echo $this->config->site_url()?>candidates_ctc/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=2">Dont Know</a>  || 
          <a href="#" class="btn btn-danger btn-xs">   Black List </a>
            <?php } ?>                        
                        
              <br><br>

           
           <a href="javascript:;" title="Update & View Consultant's Feedback" onclick="add_consultant_feedback(<?php echo $result['candidate_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs/add_consultant_feedback/?candidate_id=<?php echo $result['candidate_id'];?>"  id="add_consultant_feedback" class="btn btn-<?php if($result['consultant_feedback']!='')echo 'info';else echo 'danger';?> btn-xs"> Consultant's Feedback</a> ||  
           
           <a href="javascript:;" title="Update & View Note" onclick="add_candidate_notes(<?php echo $result['candidate_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs/get_all_notes/?candidate_id=<?php echo $result['candidate_id'];?>"  id="add_candidate_notes" class="btn btn-<?php if($result['total_notes']>0)echo 'info';else echo 'danger';?> btn-xs"> Add Notes</a>
           
           ||
           
             <a href="javascript:;" title="Update candidate's availability" onclick="manage_shift_vacancy(<?php echo $result['candidate_id'];?>,<?php echo date('m')?>,<?php echo date('Y');?>);"  id="manage_shifts" class="btn btn-info btn-xs">Availability</a>
            </td>
           <td><?php echo number_format($result['current_ctc'],2);?> Lacs
           
         
           
           
           </td>
            <td><?php echo number_format($result['expected_ctc'],2);?> Lacs</td>
              <td><?php echo $result['total_experience'];?> Yrs</td>
               <td><?php echo $result['notice_period'];?> Days</td>
            
        </tr>
    
    <?php
    }}else{?>
    <tr>
    <td colspan="11" align="center">
    No Records Founds!!						</td>
    </tr>
    <?php } ?>
    </tbody>
</table>

</form>


<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit2">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
</div>
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>


<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
</div>

<div class="modal fade" id="consultant_feedback"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:800px;height:800px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br><h3>Consultants Feedback</h3>
         
         <div class="alert alert-info"><strong>Info!</strong>&nbsp;Update consultant's feedback from here. This will be showed to the client when submit a CV.</div>
         
        <div id="show_consultant_feedback" style="width:750px;height:600px;">Loading...</div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="candidates_notes"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:800px;height:200px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br><h3>Candidate Notes</h3>
         
         <div class="alert alert-info"><strong>Info!</strong>&nbsp;Update notes from here.</div>
         
        <div id="show_all_notes" style="width:750px;height:400px;">Loading...</div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="update_shift_vacancy" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document" style="width:1258px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div id="shift_data_holder"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<script>
$('#simple').hide();
$('#multiple_cert').addClass('form-control hori');
$('#multiple_skill').addClass('form-control hori');
$(".js-example-basic-multiple-cert").select2();

function myFunction()
	{
	
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
	function search_submit()
	{
		var multiple_skill	=	$('#multiple_skill').val();
		$('#skills').val(multiple_skill);
		
	}
	
$(document).ready(function()
{
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$('#selectall').click(function(event)
	{  
		if(this.checked) 
		{ 
		$('.checkboxes').each(function() { 
		this.checked = true; 
		});
		}else{
		$('.checkboxes').each(function() { 
		this.checked = false;  
		});        
		}
	});
	
	
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_ctc?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_ctc?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#assign_to_job").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a candidate to assign.");
		return false;
		}
		if(count_checked >0) {
			if($('#job_id').val() == 0){
				alert('Please Select a job');
				return false;
			}
			else{
				var checkboxes = document.getElementsByName('checkbox[]');
				var selectedArr = [];
				for (var i=0; i<checkboxes.length; i++) {
					if (checkboxes[i].checked) {
						selectedArr.push(checkboxes[i].value);
					}
				}
				$.ajax({
					type:"POST",
					url: "<?php echo $this->config->site_url();?>candidates_ctc/assign_job",
					data:{ 
							'selectedArr' : selectedArr,
							'job_id' : $('#job_id').val(),
					},
					success: function(msg) {
						if(msg>0){
							alert('successfully added');
							window.location='<?php echo $this->config->site_url();?>/candidates_ctc';
						}
						else{
							alert('Already assigned');
						}
					}
				});
			}
		}
	});


	$("#btn_change_status").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		
		if(count_checked == 0) 
		{
			alert("Please select a candidate to change status.");
			return false;
		}
		
		/*
		if (!$("input[name='cur_job_status']:checked").val()) {
			   alert('Please select status!');
				return false;
		}
		*/
		
		var checkboxes = document.getElementsByName('checkbox[]');
		
		var selectedArr = [];
		
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selectedArr.push(checkboxes[i].value);
			}
		}

		$.ajax({
			type:"POST",
			url: "<?php echo $this->config->site_url();?>candidates_ctc/change_status",
			data:{ 
					'selectedArr' : selectedArr,
					'cur_job_status' : $("#cur_job_status").val(),
			},
			success: function(msg) {
				if(msg>0)
				{
					alert('successfully changed');
					window.location='<?php echo $this->config->site_url();?>/candidates_ctc';
				}
				else{
					alert('Already assigned');
				}
			},
			error:function(){
					alert('Problem with server. Pelase try again');
			}
		});
	});
	
});
</script>

<script>
function csv_validate()
{	
	if($('#csvfile').val()=='')
	{
		alert("Please Select file");
		$('#csvfile').focus();
		return false;
	}   
	return true;
}


	$('#level_id').change(function() 
	{
	
		jQuery('#course_id_edu').html('');
		jQuery('#course_id_edu').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>candidates_ctc/getcourses/',
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
					 /* $.each(data.course_list, function (index, value) 
					  {
						  if(index=='')
							 jQuery('#course_id_edu').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#course_id_edu').append('<option value="'+ index +'">' + value + '</option');
					 });*/
					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
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
	
		
function resetpwd($id)
{
	var candidate_id =$id;
		
	$.ajax({
	
			type: 'POST',		
			data: {candidate_id:candidate_id},
			dataType: "json",		
			url: '<?php echo $this->config->site_url();?>candidates_ctc/resetpassword/',
			success: function(data){
			 if(data.data =='1')
			 {
				$('#reset_msg').removeClass('hide');
				$('html, body').animate({ scrollTop: $('#reset_msg').offset().top }, 'slow');
			 }
			 else
			 {
				$('#reset_msg_error').removeClass('hide');
				$('html, body').animate({ scrollTop: $('#reset_msg_error').offset().top }, 'slow'); }
	   }
			
	 }); 
}

function add_consultant_feedback(candidate_id){
	
	$('#show_consultant_feedback').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>candidates_ctc/open_consultant_feedback/"+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id},
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_consultant_feedback').html(data);
			}
			
		});
    $('#consultant_feedback').modal();
}

function add_candidate_notes(candidate_id){
	
	$('#show_all_notes').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>candidates_ctc/get_all_notes/"+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id},
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_all_notes').html(data);
			}
			
		});
    $('#candidates_notes').modal();
}
</script>		

<script>

function manage_shift_vacancy(candidate_id,month,year)
{
	
	//$('#candidate_id').val(client_shift_id);
	$('#shift_data_holder').html('Loading..................');	
	 $.ajax({
			type: 'POST',
			url:"<?php echo $this->config->site_url()?>candidates_ctc/calendar_ci",
			data: $('#shift_assignment_form').serialize(),
			method: "POST",
  			data: { candidate_id : candidate_id, month : month, year : year },
		    dataType: "html",
			success: function(data) 
			{
				 $('#shift_data_holder').html(data);
			}
		});
    $('#update_shift_vacancy').modal();		
}

function shift_box_validate()
{
	var ret_val=true;
	var $select_boxes = $('select[name="shift_name[]"]');
	
    if ($('input[name^=avail_id]:checked').length >=1) 
	{		
		$("input[name^='avail_id']").each(function(i) {
			
		   if (this.checked) 
		   {
			   //alert($select_boxes.eq(i).val());
			   if($select_boxes.eq(i).val()=='0')
			   {				 
				  ret_val=false;
			   }
		   }
		});
    }
	
	if(ret_val==false)
	{
		alert('Plase make sure that you select the Shisft Name for all days you checked.');
	}
	return ret_val;
}

$(document).on('click', '#save_shift_button', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
		var $shift_check_valid=shift_box_validate();
		//alert($shift_check_valid);
		if($shift_check_valid==false)return false;
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#shift_assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					//$('#assignment_modal').modal('hide');	
					alert('Calendar updated');				
					//location.reload();
					//$("#assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

</script>