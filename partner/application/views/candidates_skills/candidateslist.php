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

<a href="<?php echo base_url();?>index.php/candidates_skills/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
</div>


<!-- 
<div class="actions">
<a href="<?php echo site_url('candidates_skills/import_csv');?>" class="btn btn-default btn-circle">
<i class="fa fa-plus"></i>
<span class="hidden-480">
Import CSV </span>
</a>
</div>
-->
<br>
<form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>/candidates_skills/">
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

<td>

 <?php echo form_dropdown('cur_job_status',  $job_status, $cur_job_status,'class="form-control " id="cur_job_status" style="width:150px"');?>
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
<?php echo $pagination; ?>
</div>
<div class="page">
<table border="0">
<tr>
 <td> 
 <?php  echo form_dropdown('admin_id',  $admin_users_lists, $formdata['admin_id'],'class="form-control" id="admin_id"');?> 
 </td>
 <td> 
<input type="button" id="assignAdmin" value="Assign" class="btn btn-default btn-circle" />&nbsp;&nbsp;
 </td>
  <td> 
 <?php echo form_dropdown('cur_job_status',  $job_status, $cur_job_status,'class="form-control " id="cur_job_status" style="width:150px"');?>
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
            <th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
            <th>Photo</th>
            <th><a href="<?php echo $this->config->site_url()?>/candidates_skills?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>">Candidate Name</a></th>
            
            
            <th><a href="<?php echo $this->config->site_url()?>/candidates_skills?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>">Email</a></th>
            
            <th>Mobile</th>
            <th>CTC</th>
            <th>ECTC</th>
            <th class="head0">Exp.</th>
             <th class="head0">Notice</th>
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
            <a href="<?php echo base_url();?>index.php/candidates_skills/summary/<?php echo $result['candidate_id']?>" class="views" title="View"> <?php echo $result['first_name']?></a> 
            </td>
           
            <td><?php echo $result['username'];?></td>
            <td><?php echo $result['mobile'];?></td>
            <td><?php echo $result['current_ctc'];?></td>
            <td><?php echo $result['expected_ctc'];?></td>
              <td><?php echo $result['total_experience'];?></td>
               <td><?php echo $result['notice_period'];?></td>
            
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
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_skills?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_skills?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#assignAdmin").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a candidate to assign.");
		return false;
		}
		if(count_checked >0) {
			if($('#admin_id').val() == 0){
				alert('Please Select an Admin User');
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
					url: "<?php echo $this->config->site_url();?>/candidates_skills/assignAdmin",
					data:{ 
							'selectedArr' : selectedArr,
							'admin_id' : $('#admin_id').val(),
					},
					success: function(msg) {
						if(msg>0){
						alert('successfully added');
						window.location='<?php echo $this->config->site_url();?>/candidates_skills';
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
			url: "<?php echo $this->config->site_url();?>/candidates_skills/change_status",
			data:{ 
					'selectedArr' : selectedArr,
					'cur_job_status' : $("#cur_job_status").val(),
			},
			success: function(msg) {
				if(msg>0)
				{
					alert('successfully changed');
					window.location='<?php echo $this->config->site_url();?>/candidates_skills';
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
			  url: '<?php echo $this->config->site_url();?>/candidates_skills/getcourses/',
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
			url: '<?php echo $this->config->site_url();?>/candidates_skills/resetpassword/',
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


</script>		

