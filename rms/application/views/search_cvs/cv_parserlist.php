
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?> </li>
      </ul>
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
    <strong>Upload Failed.</strong>
    </div>
<?php }?>
<?php if($this->input->get('file_type_err')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Support csv file only.</strong>
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
                    <strong>Record deleted..</strong>
                </div>
			         <?php }
					 
					 if($this->input->get('upd')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Sucess ! </strong>record updated successfully.
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




<form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>/search_cvs/">
<table class="tool-table">
<tbody>

<tr>
<td><input class="form-control" type="text" name="any_keywords" id="any_keywords" value="<?php echo $any_keywords;?>" placeholder="Any Keywords" style="width: 150px;;"></td>
<td><input class="form-control" type="text" name="all_keywords" id="search_name" value="<?php echo $all_keywords;?>" placeholder="All Keywords" style="width: 150px;"></td>

<td>

<input type="hidden" value="<?php echo $designation;?>" name="designation" id="designation"/>

<select class="js-example-basic-multiple-cert"  multiple="multiple" name="multiple_designation" id="multiple_designation" style="width:150px;">
    <option value="">Select  Designation</option>
    <?php foreach($designation_list as $key => $val){?>
    <option <?php   if (in_array($key, $candidate_designation)){ ?> selected="selected" <?php  } ?> 
     value="<?php echo $key;?>"><?php echo $val;?></option>
    <?php }?>
</select>
</td>


<td>
<input type="hidden" value="<?php echo $industry;?>" name="industry" id="industry"/>
<select class="js-example-basic-multiple-cert"  multiple="multiple" name="multiple_industry" id="multiple_industry" style="width:150px;">
    <option value="">Select  Industry</option>
    <?php foreach($industry_list as $key => $val){?>
    <option <?php   if (in_array($key, $candidate_industry)){ ?> selected="selected" <?php  } ?> 
     value="<?php echo $key;?>"><?php echo $val;?></option>
    <?php }?>
</select>

</td>

<td>
        <input type="hidden" name="skills" id="skills"/>
        <select class="js-example-basic-multiple-cert"  multiple="multiple" id="multiple_skill" style="width:150px;">
            <option value="">Select  Skills</option>
            <?php foreach($skill_list as $key => $val){?>
            <option <?php   if (in_array($key, $candidate_skills)){ ?> selected="selected" <?php  } ?> 
             value="<?php echo $key;?>"><?php echo $val;?></option>
            <?php }?>
            </select>
</td>



<td>

<input type="hidden" value="<?php echo $edu_level;?>" name="edu_level" id="edu_level"/>

<select class="js-example-basic-multiple-cert"  multiple="multiple" name="multiple_education_level" id="multiple_education_level" style="width:150px;">
    <?php foreach($edu_level_list as $key => $val){?>
    <option <?php   if (in_array($key, $candidate_edu_level)){ ?> selected="selected" <?php  } ?> 
     value="<?php echo $key;?>"><?php echo $val;?></option>
    <?php }?>
</select>
<td>
<input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" />
</td>
    
    

<!--EDUCATION FILTER-->



</tr>
<!--</form>-->
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
                <th><div class="checker">#</span></div></th>
                <th>Details</th>
                </tr>
        </thead>
        
        <tbody>
        
			<?php if($records!=NULL){ $i=0; foreach($records as $result){ $i+=1; ?>            
            	<tr class="odd gradeX">
            
                    <td align="center"><?php echo $i?></td>
                  <td>			
                    <?php echo $result['first_name']?>&nbsp; <div style="float:right;"> <?php echo $result['last_name']?>  Email: <strong>
					<?php echo $result['username'];?>&nbsp;</strong>&nbsp;|&nbsp;&nbsp; 
                    Mobile: <strong><?php echo $result['mobile'];?></strong></div>

<?php if($result['skill_set']!=''){?>                
<br>
<br>
Skills : <?php echo $result['skill_set'];?> 
<?php } ?>
<?php if($result['job_profile']!=''){?><br>
Employment : <?php echo $result['job_profile'];?> <?php } ?>

<?php if($result['job_profile']!=''){?><br>
Last Job App : <?php echo $result['job_apps'];?> <?php } ?>
<br><br>

<div style="float:left;">

<a href="javascript:;"  onclick="add_calls(<?php echo $result['candidate_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/candidates_all/add_calls/?candidate_id=<?php echo $result['candidate_id'];?>"  id="add_calls" class="btn btn-info btn-xs">Call Log</a> &nbsp;|| <a href="javascript:void();" class="btn btn-success btn-xs">Add a Job</a> || <a href="javascript:void();" class="btn btn-warning btn-xs">Update Contract</a>&nbsp;|| <a href="javascript:void();" class="btn btn-warning btn-xs"> &nbsp; CTC </a>&nbsp;|| <a href="javascript:void();" class="btn btn-warning btn-xs">Message</a>&nbsp;|| <a href="javascript:void();" class="btn btn-warning btn-xs">Notes</a>&nbsp;|| <a href="javascript:void();" class="btn btn-warning btn-xs">Folder</a>

</div>

<div style="float:right;">
<!-- 
<a href="<?php echo base_url();?>index.php/candidates_all/edit/<?php echo $result['candidate_id']?>" class="views" title="Edit">Edit Profile</a>&nbsp;
-->
<a href="javascript:void();" title="<?php echo $result['fl_title']?> || <?php echo $result['fl_desc']?>" class="btn btn-info btn-xs">Calls: [<?php echo $result['total_flp']?>] </a>&nbsp;|| Flp Date: <a href="javascript:void();" class="btn btn-success btn-xs">test</a> ||  Next Date: <a href="javascript:void();" class="btn btn-warning btn-xs">test</a> || Upd By: <p class="btn btn-primary btn-xs">test</p>
|| &nbsp;
 <a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $result['candidate_id']?>" target="_blank" class="views" title="View">View</a>
 
</div>


                  </td>
                </tr>
                    
                    <?php
                    }}else{?>
                    <tr>
                    	<td colspan="2" align="center"> No Records Founds!! </td>
            		</tr>
            		<?php } ?>
        </tbody>
    </table>
                             
</form>


<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
</div>


<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
</div>

<div class="modal fade" id="calls_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/search_cvs/add_follow_up" id="calls_form" name="calls_form"> 
            
             		<input type="hidden" name="candidate_id" id="candidate_id" value="">
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Present Job Status</td>
                   <td>
                   
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="1"  checked="checked" />No Job <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="2"/>Working, But Need a Change <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="3"/>Not Interested <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="4"/>Seeking Good Opportunity <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="5"/>Need a change <br>                    
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="6"/>Call after 1 Year <br>
                    <input id="cur_job_status" type="radio" name="cur_job_status" value="7"/>Call after this month                     
    </td>
                 </tr>

                <tr>
                <td>Call Date</td>
                 <td><input type="text" name="start_date" value="<?php echo date('Y-m-d');?>" class="smallinput datepicker" readonly id="start_date"  /></td>
                </tr>

<tr>
                  <td>Call Time</td>
                  <td><?php echo form_dropdown('call_time', $interview_time_ar);?></td>
                </tr>
                                                
                <tr>
                <td>Next Follow-up Date</td>
                 <td><input type="text" name="flp_next_date" value="<?php echo date('Y-m-d',strtotime("+7 day")); ;?>" class="smallinput datepicker" readonly id="flp_next_date"  /></td>
                </tr>
                
                <tr>

                <td>Notes</td>
                 <td><?php echo form_input(array('name'=>'flp_notes', 'id'=>'flp_notes','class' => 'smallinput'));?> </td>
                </tr>
				                 
				 <tr>
                  <td>&nbsp;</td>
                 <td><?php echo form_checkbox(array('name'=>'create_task', 'value' => '1', 'id'=>'create_task','class' => 'smallinput'));?> Create Task</td>
                </tr>

				 <tr>
                  <td>Task Title</td>
                 <td><?php echo form_input(array('name'=>'task_title', 'id'=>'task_title','class' => 'smallinput'));?> </td>
                </tr>                                

				 <tr>
                  <td>Task Details</td>
                 <td><?php echo form_input(array('name'=>'task_desc', 'id'=>'task_desc','class' => 'smallinput'));?> </td>
                </tr> 

 				<tr>
                <td>Due On</td>
                 <td><input type="text" name="due_date" value="<?php echo date('Y-m-d',strtotime("+7 day")); ;?>" class="smallinput datepicker" readonly id="due_date"  /></td>
                </tr>
                
				 <tr>
                  <td>Assign To</td>
                 <td><?php echo form_dropdown('admin_id',  $admin_list,'','style="width:300px;" id="admin_id"');?> </td>
                </tr>
                                                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="add_follow_up" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/search_cvs/add_follow_up" />
                 
                  </span>
                  </td>
                </tr>
                </tbody>
                </table> 
            </form>
			
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<script>




//$('#simple').hide();
//$('#multiple_cert').addClass('form-control hori');
//$('#multiple_skill').addClass('form-control hori');
$(".js-example-basic-multiple-cert").select2();

/*

function myFunction()
{
	alert('asdas');
	  var parnt =$('#parent').val();
	 parnt=487;
	 if(parnt!='')
	 {
		  $.ajax({
		  type: "get",
		  async: true,
		  url: "<?php echo site_url('search_cvs/get_all_skills'); ?>",
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

*/

function add_calls(candidate_id){
	$('#candidate_id').val(candidate_id);
    $('#calls_modal').modal();
}

function call_validate() {
		
		if($('#flp_notes').val()=='')
		{
			alert('Enter some text');
			$('#flp_notes').focus();
			return false;
		}   
	    return true;
    }
	
$(document).on('click', '#add_follow_up', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
		var isCallValid = call_validate();
		if(isCallValid==false)
		{
			return false;	
		}
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#calls_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#calls_modal').modal('hide');					
					location.reload();
					$("#calls_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

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

	var multiple_education_level	=	$('#multiple_education_level').val();
	$('#edu_level').val(multiple_education_level);

	var multiple_industry	=	$('#multiple_industry').val();
	$('#industry').val(multiple_industry);

	var multiple_designation	=	$('#multiple_designation').val();
	$('#designation').val(multiple_designation);

}

</script>


