<style>
th {
	font-weight: bold;
	font-family: Verdana, Geneva, sans-serif;
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">

<!--<div class="section-wrap">
  <div class="row">
    <ul class="page-breadcrumb breadcrumb">
      <li> <a href="<?php //echo $this->config->site_url()?>">Home</a> </li>
      <li class="active"><?php //echo $page_head;?> </li>
    </ul>
  </div>-->

<div class="alert alert-success alert-dismissable hide" id="reset_msg">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>Sucess !</strong>Reset Password Link Sent </div>
<div class="alert alert-success alert-dismissable hide" id="reset_msg_error" style="color:#F00">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>Oops !</strong>Reset Password Link not sent </div>
<?php  if($this->input->get('csv')==1){ ?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>Sucess !</strong>csv file uploaded successfully. </div>
<?php }?>
<?php if($this->input->get('upload_err')==1){?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>upload failed.</strong> </div>
<?php }?>
<?php if($this->input->get('file_type_err')==1){?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>support csv file only.</strong> </div>
<?php }?>
<?php if($this->input->get('ins')==1){?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>Sucess !</strong>record added successfully. </div>
<?php } 
             if($this->input->get('multi')==1){?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>Records !</strong> Deleted successfully. </div>
<?php } 
           if($this->input->get('del')==1){?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>record deleted..</strong> </div>
<?php }
                 
                 if($this->input->get('upd')==1){?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong>Sucess !</strong>record updated successfully. </div>
<?php }?>
<?php if($this->session->flashdata('msg')){?>
<div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
  <strong><?php echo $this->session->flashdata('msg');?></strong> </div>
<?php } ?>
<div class="row">
  <div class="col-sm-12">
    <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/>
      <h3><?php echo $page_head;?></h3>
    </div>
    <div class="table-tech specs">
      <div class="right-btns"> <a href="<?php echo base_url(); ?>index.php/candidates_all_dir" id="clear_search" class="btn btn-primary btn-xs">Clear Search Filters</a> </div>
     
      <br>
      <form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>/candidates_all_dir/">
       
        <table class="tool-table" border="1">
          <tbody>
            <tr>
             <!-- <td><?php //echo form_dropdown('job_cat_id', $industry_list, $job_cat_id,' id="job_cat_id" style="width:130px"');?></td>-->
              <td><?php echo form_dropdown('expected_ctc_from',  $expected_ctc_from_array, $expected_ctc_from,' id="expected_ctc_from" style="width:100px"');?></td>
              <td><?php echo form_dropdown('desig_id', $roles_list, $desig_id,' id="desig_id"  style="width:105px"');?></td>
              <td><?php echo form_dropdown('notice_period_from',  $notice_period_from_array, $notice_period_from,' id="notice_period_from" style="width:160px"');?></td>
              <td><?php echo form_dropdown('pref_city_id', $pref_city_list, $pref_city_id,' id="pref_city_id"  style="width:100px"');?></td>
              <td><?php echo form_dropdown('level_id',  $edu_level_list, $level_id,' id="level_id" style="width:135px"');?></td>
              <td><?php echo form_dropdown('total_experience_from',  $total_experience_from_array, $total_experience_from,' id="total_experience_from" style="width:90px"');?></td>
              <td><?php echo form_dropdown('cur_job_status',  $job_status_list, $cur_job_status,' id="cur_job_status" style="width:120px"');?></td>
            </tr>
            <tr>
              <!--<td><?php //echo form_dropdown('func_id', $department_list, $desig_id,' id="func_id"  style="width:132px"');?></td>-->
              <td><?php echo form_dropdown('expected_ctc_to',  $expected_ctc_to_array, $expected_ctc_to,' id="expected_ctc_to" style="width:100px"');?></td>
              <td><?php echo form_dropdown('city_id', $city_list, $city_id,' id="city_id"  style="width:100px"');?></td>
              <td><?php echo form_dropdown('notice_period_to',  $notice_period_to_array, $notice_period_to,' id="notice_period_to" style="width:150px"');?></td>
              <td><input class="form-control" type="text" name="search_name" id="search_name" value="<?php echo $search_name;?>" 
                    placeholder="Name" style="width: 100px;"></td>
              <td><?php echo form_dropdown('course_id',  $edu_course_list, $course_id,' id="course_id_edu" style="width:123px"');?></td>
              <td><?php echo form_dropdown('total_experience_to',  $total_experience_to_array, $total_experience_to,' id="total_experience_to" style="width:90px"');?></td>
              <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" /></td>
            </tr>
          </tbody>
        </table>
      </form>
      <form name="form1" method="post" id="form1" action="#" >
        <div class="sep-bar">
          <div class="page"> </div>
          
          <!-- 
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
-->
          
          <div class="views_section">
            <div class="found"><span>Found total&nbsp; | <?php echo $total_rows;?> records</span></div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <table class="tool-table new">
          <thead>
            <tr role="row" class="heading">
              <th width="20"><div class="checker"><span>#</span></div></th>
              <th width="102">Photo</th>
              <th width="384"><a href="<?php echo $this->config->site_url()?>/candidates_all_dir?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>"> Name</a></th>
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
              <td align="center">#</td>
              <td><?php if($result['photo']!=''){?>
                <img height="31" width="31" src="<?php echo $this->config->item('rms_base_url').'/uploads/photos/'.$result['photo'];?>">
                <?php }else{ ?>
                <img height="31" width="31" src="<?php echo $this->config->item('rms_base_url').'uploads/photos/no_photo.png';?>">
                <?php } ?></td>
              <td><a href="#" class="views" title="View"><strong><?php echo $result['first_name']?></strong></a> 
                
                <!-- 
             <br>Total Apps: <?php echo $result['total_job_apps'];?> || SL: <?php echo $result['total_shortlisted'];?> || Int:  <?php echo $result['total_interview'];?> || Int Rej:  <?php echo $result['total_interview_rej'];?> ||  Sel:  <?php echo $result['total_selection'];?> 
            
            
            <br>Education: <?php if($result['total_edu']>0)echo 'Updated';else echo 'Not Updated';?>
            <br>Job Profile: <?php if($result['total_job_profile']>0)echo 'Updated';else echo 'Not Updated';?>
            <br>Skills: <?php if($result['total_skills']>0)echo 'Updated';else echo 'Not Updated';?>
           
            --> 
                
                <br>
                Industry:
                <?php if($result['candidate_industry']!='')echo $result['candidate_industry'];else echo 'Not Updated';?>
                <br>
                Functional Area:
                <?php if($result['candidate_functional']!='')echo $result['candidate_functional'];else echo 'Not Updated';?>
                <br>
                Role/Designation:
                <?php if($result['candidate_role']!='')echo $result['candidate_role'];else echo 'Not Updated';?>
                <br>
                <br>
                Job Status:
                <?php if($result['cur_job_status_name']!='')echo $result['cur_job_status_name'];else echo 'Not Updated';?>
                <br>
                Last CTC Udate:
                <?php if(isset($result['ctc_updated_on'])  && $result['ctc_updated_on']!='0000-00-00')echo $result['ctc_updated_on'];else echo 'Not Updated'?>
                <br>
                Last Profile Udate:
                <?php if(isset($result['status_updated_on'])  && $result['status_updated_on']!='0000-00-00')echo $result['status_updated_on'];else echo 'Not Updated'?>
                <br>
                Current CTC /Lakhs: <b><?php echo number_format($result['current_ctc'],2);?></b>&nbsp; || &nbsp;
                Expected CTC /Lakhs: <b><?php echo number_format($result['expected_ctc'],2);?></b>&nbsp; || &nbsp;
                Total Experience: <b><?php echo $result['total_experience'];?></b>&nbsp; || &nbsp;
                Notice Period: <b><?php echo $result['notice_period'];?> Days </b>&nbsp;<br>
                <br>
                
                <!-- DoB: <br>
                  Preferred Locations: 
                  <br>-->
                <a href="javascript:;" title="Update candidate's availability" onclick="manage_jobs(<?php echo $result['candidate_id'];?>);"  id="manage_shifts" class="btn btn-info btn-xs">Shortlist</a>
                
                <?php if($result['cv_file']!=''){?>
                || 
                <!-- rms_base_url --> 
                <a href="<?php echo $this->config->item('rms_base_url'); ?>uploads/cvs/<?php echo $result['cv_file'];?>" class="btn btn-danger btn-xs" target="_blank" title="View Profile">Download CV</a>
                <?php } ?>
                <?php if($result['cv_file']!=''){?>
                || <a href="javascript:;" class="btn btn-warning btn-xs" title="View Profile" onclick="open_client_cv_doc(<?php echo $result['candidate_id'];?>);"> View Doc CV</a> ||
                <?php } ?>
                <a href="javascript:;" class="btn btn-warning btn-xs" title="View Profile" onclick="open_client_cv(<?php echo $result['candidate_id'];?>,0);">Candidate Summary</a></td>
            </tr>
            <?php
    }}else{?>
            <tr>
              <td colspan="11" align="center"> No Records Founds!! </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="sep-bar">
        <div class="page"> <?php echo $pagination; ?> </div>
        <div class="views_section">
          <div class="view-drop"> <span>View</span>
            <select class="form-control drop" id="sel_limit2">
              <option>Select</option>
              <option>5</option>
              <option>10</option>
            </select>
            <span>Records</span> </div>
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
        <br>
        <h3>Consultants Feedback</h3>
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
        <br>
        <h3>Candidate Notes</h3>
        <div class="alert alert-info"><strong>Info!</strong>&nbsp;Update notes from here.</div>
        <div id="show_all_notes" style="width:750px;height:400px;">Loading...</div>
        
        <!-------------------------modal1 end------------------------------->
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="update_shift_vacancy" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document" style="width:1058px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <h3>Company Details</h3>
        <div id="shift_data_holder"></div>
        
        <!-------------------------modal1 end------------------------------->
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="client_cv_modal_doc"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:1200px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <h3>Candidate CV</h3>
        <div id="show_client_cv_doc" style="overflow: scroll;"></div>
        
        <!-------------------------modal1 end------------------------------->
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="client_cv_modal"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:1200px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div id="show_client_cv" style="overflow: scroll;"></div>
        
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
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_all_dir?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_all_dir?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
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
					url: "<?php echo $this->config->site_url();?>/candidates_all_dir/assign_job",
					data:{ 
							'selectedArr' : selectedArr,
							'job_id' : $('#job_id').val(),
					},
					success: function(msg) {
						if(msg>0){
							alert('successfully added');
							window.location='<?php echo $this->config->site_url();?>/candidates_all_dir';
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
			url: "<?php echo $this->config->site_url();?>/candidates_all_dir/change_status",
			data:{ 
					'selectedArr' : selectedArr,
					'cur_job_status' : $("#cur_job_status").val(),
			},
			success: function(msg) {
				if(msg>0)
				{
					alert('successfully changed');
					window.location='<?php echo $this->config->site_url();?>/candidates_all_dir';
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
			  url: '<?php echo $this->config->site_url();?>/candidates_all_dir/getcourses/',
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
			url: '<?php echo $this->config->site_url();?>/candidates_all_dir/resetpassword/',
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
			url:"<?php echo base_url(); ?>index.php/candidates_all_dir/open_consultant_feedback/"+candidate_id,
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
			url:"<?php echo base_url(); ?>index.php/candidates_all_dir/get_all_notes/"+candidate_id,
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

function manage_jobs(candidate_id)
{
	
	//$('#candidate_id').val(client_shift_id);
	$('#shift_data_holder').html('Loading..................');	
	 $.ajax({
			type: 'POST',
			url:"<?php echo $this->config->site_url()?>/candidates_all_dir/connect_with_jobs",
			data: $('#job_assignment_form').serialize(),
			method: "POST",
  			data: { candidate_id : candidate_id,},
		    dataType: "html",
			success: function(data) 
			{
				 $('#shift_data_holder').html(data);
			}
		});
    $('#update_shift_vacancy').modal();		
}


$(document).on('click', '#save_job_app_button', function(){ 
		var $this = $(this);
		var $url = $this.data('url'); 
		 $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#job_assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){	
				    alert('Job application list updated');				
				 	
					$('#update_shift_vacancy').modal('show');	
					location.reload();	
								
					//$('#inter').removeClass();
					//$('#candidate_interview').removeClass();
					//$('#candidate_interview').html(data.data);
					$("#job_assignment_form").trigger( "reset" );
				 }
				 else 
				 {
					 alert('please Fill the data');
				 }
			}
		});

	});
	
	
	
	function open_client_cv_doc(candidate_id)
{
	$('#show_client_cv_doc').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_all_dir/client_cv_doc/?view="+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id},
		    dataType: "html",
			success: function(data) 
			{
				
				 $('#show_client_cv_doc').html(data);
			}
		});
    $('#client_cv_modal_doc').modal();
}

//client cv from database
function open_client_cv(candidate_id,job_id)
{
	$('#show_client_cv').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_all_dir/client_cv/?view="+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id,job_id : job_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_client_cv').html(data);
			}
		});
    $('#client_cv_modal').modal();
}

</script>