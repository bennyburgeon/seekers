<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
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
                    <strong>Records !</strong>record added successfully.
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
				

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">


<div class="right-btns">


<!-- 
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
-->

</div>
<form id="searchForm" action="" method="get" name="searchForm">
<table class="tool-table">
<tbody>


<tr>
<td width="30%"><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Company Name" value="<?php echo $searchterm != '' ? $searchterm: '' ;?>"     style="width: 185px;"> </td>
<td width="30%"><?php echo form_dropdown('ind_id', $industry_list , $ind_id,'style="width:150px;" class="form-control"  id="ind_id" ');?></td>
<td width="30%"><?php echo form_dropdown('flp_status', $lead_status_list , $flp_status,'style="width:125px;" class="form-control"  id="flp_status" ');?></td>
<td width="10%">
<?php echo form_dropdown('company_priority', $company_priority_list , $company_priority,'style="width:125px;" class="form-control"  id="company_priority" ');?>
</td>
<td width="10%">
<?php echo form_dropdown('company_rating', $company_rating_list , $company_rating,'style="width:125px;" class="form-control"  id="company_rating" ');?>
</td>

<td width="10%">
<a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
</td>
</tr>


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
<select class="form-control drop" id="sel_limit1">
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
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/company_agreements/multidelete?rows=<?php echo $rows;?>" >
<table class="tool-table new">
<thead>
								<tr role="row" class="heading">
<th width="24"><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                                        <th width="534"><a href="<?php echo $this->config->site_url()?>/company_agreements?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Company Name</a></th>
                                    <th width="299">Contact Details</th>
                                    <th width="171">Actions</th>
                                </tr>
</thead>
<tbody>

<?php 		
if($records!=NULL)
{
	foreach($records as $result){ ?>
		<tr class="odd gradeX">
			<td>
				<div class="checker">
				<span>
					<input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['company_id']?>" >
				</span>
				</div>
			</td>
			<td>
				<a href="<?php echo base_url();?>index.php/company_agreements/edit/<?php echo $result['company_id']?>" class="views" title="Edit"><?php echo $result['company_name']?></a><br> 
				
				<?php if($result['total_flp']>0){ ?>
                <a href="javascript:;" title="Get last history" onclick="get_calls_history(<?php echo $result['company_id'];?>);"  id="get_calls_company" class="btn btn-info btn-xs"> History[<?php echo $result['total_flp']?>]</a>
				<?php }else{ ?>                
                 <a href="javascript:void();" title="<?php echo $result['flp_notes']?>" class="btn btn-info btn-xs">No Calls</a> 
				<?php } ?> 
                 || 
                
                Flp Date: <a href="javascript:void();" class="btn btn-success btn-xs"><?php echo $result['flp_date']?></a> ||  Next Date: <a href="javascript:void();" class="btn btn-warning btn-xs"><?php echo $result['flp_next_date'];?></a> || Upd By: <p class="btn btn-primary btn-xs"> <?php echo $result['firstname']?></p><br><br>
				 Lead Status:				 <p class="btn btn-primary btn-xs"> <?php if($result['flp_status']==1)echo 'We Have Openings';?><?php if($result['flp_status']==2)echo 'No Openings';?><?php if($result['flp_status']==3)echo 'Call after a month';?><?php if($result['flp_status']==4)echo 'Already have vendor';?><?php if($result['flp_status']==5)echo 'We have in house team';?><?php if($result['flp_status']==6)echo 'Became Client';?><?php if($result['flp_status']==7)echo 'Do not Disturb';?></p> || Created By:<?php echo $result['created_by']?>|| Total Jobs : <?php echo $result['total_jobs']?></td>

            <td>
			
            Email:<a href="mailto:<?php echo $result['contact_email']?>?subject=test%20subject" class="btn btn-warning btn-xs"><?php echo $result['contact_email']?></a><br>
            
            Phone:<a href="javascript:void();" class="btn btn-success btn-xs"><?php echo $result['contact_phone']?></a><br>
            
            Contact:<?php echo $result['contact_name']?><br>

			<?php 
				$host_ar=parse_url($result['company_website']);

			?>
		<a href="<?php if(isset($host_ar['path']) && $host_ar['path']!='')echo 'http://'.$host_ar['path']; if(isset($host_ar['host']) && $host_ar['host']!='') echo ''.$host_ar['host'];?>" target="_blank"><?php echo $result['company_website'];?></a></td>
            
            <td>
<!-- 
            <a href="javascript:;" title="Add New Job" onclick="add_jobs(<?php echo $result['company_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/company_agreements/add_calls/?company_id=<?php echo $result['company_id'];?>"  id="add_jobs" class="btn btn-info btn-xs">Add Job</a>
            
             || 
             
-->            
           
            <a href="javascript:;" title="Upload Agreement" onclick="add_agreement(<?php echo $result['company_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/company_agreements/add_calls/?company_id=<?php echo $result['company_id'];?>"  id="add_agreement" class="btn btn-info btn-xs">Agreement</a><br><br>
      <?php if($result['total_files']>0){?>
   <a href="javascript:;" title="Get agreements history" onclick="get_agreement_history(<?php echo $result['company_id'];?>);"  id="get_calls_company" class="btn btn-info btn-xs"> View Agreements</a>
      <?php } ?>
              </td>
            </tr>


		<?php
		}}else{?>
					<tr>
						<td colspan="4" align="center">
							No Records Founds!!
						</td>
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

<!-- company follow up model start here -->

<div class="modal fade" id="calls_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company_agreements/add_calls" id="calls_form" name="calls_form"> 
            
             		<input type="hidden" name="company_id" id="company_id" value="">
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Present Job Status</td>
                   <td>
                   
                    <input id="flp_status" type="radio" name="flp_status" value="1"  checked="checked" />We Have Openings<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="2"/>No Openings<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="3"/>Call after a month <br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="4"/>Already have vendor <br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="5"/>We have in house team <br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="6"/>Became Client <br>
                    <input id="flp_status" type="radio" name="flp_status" value="7"/>Do not Disturb
   			 </td>
                 </tr>

                <tr>
                  <td>Lead Status</td>
                  <td>                   
                    <input id="status" type="radio" name="status" value="1" />Just a Lead<br>                    
                    <input id="status" type="radio" name="status" value="2"/>In Process<br>                    
                    <input id="status" type="radio" name="status" value="3"/>Move to Client Folder <br>                    
                   </td>
                </tr>
                <tr>
                  <td>Priority</td>
                  <td><?php echo form_dropdown('company_priority',  $company_priority_list,'','class="form-control" id="company_priority"');?></td>
                </tr>
                <tr>
                  <td>Rate This Company</td>
                  <td><?php echo form_dropdown('company_rating',  $company_rating_list,'','class="form-control" id="company_rating"');?></td>
                </tr>
                <tr>
                <td>Call Date</td>
                 <td><input type="text" name="flp_date" value="<?php echo date('Y-m-d');?>" class="smallinput datepicker" readonly id="flp_date"  /></td>
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
                 <td><?php echo form_dropdown('admin_id',  $admin_list,'','class="form-control" id="admin_id"');?> </td>
                </tr>
                                                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_calls" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/company_agreements/add_calls" />
                 
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

<div class="modal fade" id="jobs_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company_agreements/add_jobs" id="jobs_form" name="calls_form"> 
            
             		<input type="hidden" name="company_id" id="jobs_company_id" value="">
                <table class="hori-form">
                <tbody>
				<tr>
				  <td>Post Date</td>
				  <td><input type="text" name="job_post_date" value="<?php echo date('Y-m-d');?>" class="smallinput datepicker" readonly id="job_post_date"  /></td>
				  </tr>
                                
                <tr>
                <td>Job Exp. Date</td>
                 <td><input type="text" name="job_expiry_date" value="<?php echo date('Y-m-d',strtotime("+30 day")); ;?>" class="smallinput datepicker" readonly id="job_expiry_date"  /></td>
                </tr>
                
                <tr>
                  <td>Job Title</td>
                  <td><?php echo form_input(array('name'=>'job_title', 'id'=>'job_title','class' => 'smallinput'));?> </td>
                </tr>                  
                
                <tr>
                  <td>Job Details</td>
                  <td><?php echo form_textarea(array('name'=>'job_desc', 'id'=>'job_desc','class' => 'smallinput', 'rows' => '5', 'cols' => '50'));?> </td>
                </tr>

				 <tr>
				   <td>Location</td>
				   <td><input type="text" name="job_location" value="" class="smallinput" id="job_location"  /></td>
				 </tr>

				 <tr>
				   <td>Vacancies</td>
				   <td><input type="text" name="vacancies" value="1" class="smallinput" id="vacancies"  /></td>
				 </tr>

				 <tr>
				   <td>Contact Name</td>
				   <td><input type="text" name="contact_name" value="" class="smallinput" id="contact_name"  /></td>
				 </tr>
                 

				 <tr>
				   <td>Contact Designation</td>
				   <td><input type="text" name="contact_designation" value="" class="smallinput" id="contact_designation"  /></td>
				 </tr>                                  

				 <tr>
				   <td>Contact Email</td>
				   <td><input type="text" name="contact_email" value="" class="smallinput" id="contact_email"  /></td>
				 </tr>  
                 

				 <tr>
				   <td>Contact Phone</td>
				   <td><input type="text" name="contact_phone" value="" class="smallinput" id="contact_phone"  /></td>
				 </tr>  
                                                   
                                 
				 <tr>
				   <td colspan="2">
				     <span class="click-icons">
				       <input type="button" class="attach-subs" value="Save" id="save_jobs" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/company/add_jobs" />
				       
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

<div class="modal fade" id="agreement_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company_agreements/add_agreement" id="agreement_form" name="agreement_form" enctype="multipart/form-data"> 
            
             		<input type="hidden" name="company_id" id="agreement_company_id" value="">
                <table class="hori-form">
                <tbody>
				<tr>
				  <td>Date of Ageement</td>
				  <td><input type="text" name="date_uploaded" value="<?php echo date('Y-m-d',strtotime("+30 day")); ;?>" class="smallinput datepicker" readonly id="date_uploaded"  /></td>
				  </tr>
                
                <tr>
                  <td>Notes</td>
                  <td><input type="text" name="agreement_note" value="Agreement" class="smallinput" id="agreement_note"  /></td>
                </tr>  
                 

				 <tr>
				   <td>Upload Document [PDF, DOC]</td>
				   <td><input type="file" name="agreement_file" value="" class="smallinput" id="agreement_file"  /></td>
				 </tr>  
                                                   
                                 
				 <tr>
				   <td colspan="2">
				     <span class="click-icons">
				       <input type="button" class="attach-subs" value="Upload Agreement" id="save_agreement" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/company_agreements/add_agreement" />
				       
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

<!--  end here -->


<div class="modal fade" id="content_history" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div id="show_followup_history"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="agreement_history" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div id="show_agreement_history"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<!--  end here -->


<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
</div>
<script>

$(document).ready(function()
{

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
	
	$("#deleteall").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a data to delete.");
		return false;
		}
		if(count_checked >0) {
		if(confirm('Are You Sure?Delete Multiple Item')){
		$('#form1').submit();
		}
		}
	});
	
	$("#search").click(function()
	{
		$('#searchForm').submit(); 
	});
	
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/company_agreements?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/company_agreements?limit='+limits;
	});
	
});
</script>

<script type="text/javascript">

$('input[type=text]').addClass('form-control');
/* interview related function modal window, add form, edit form etc. */

function add_calls(company_id)
{
	$('#company_id').val(company_id);
    $('#calls_modal').modal();
}
function add_jobs(company_id)
{
	$('#jobs_company_id').val(company_id);
    $('#jobs_modal').modal();
}

function add_agreement(company_id)
{
	$('#agreement_company_id').val(company_id);
    $('#agreement_modal').modal();
}

function get_calls_history(company_id){
	
	$('#show_followup_history').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/company_agreements/get_calls_history/",
			data: "",
			method: "POST",
  			data: { company_id : company_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_followup_history').html(data);
			}
			
		});
    $('#content_history').modal();
}

function get_agreement_history(company_id){
	
	$('#show_agreement_history').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/company_agreements/get_agreement_history/",
			data: "",
			method: "POST",
  			data: { company_id : company_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_agreement_history').html(data);
			}
			
		});
    $('#agreement_history').modal();
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

function job_validate() {
		
		if($('#job_title').val()=='')
		{
			alert('Job Title');
			$('#job_title').focus();
			return false;
		} 
		if($('#job_desc').val()=='')
		{
			alert('Job Description');
			$('#job_desc').focus();
			return false;
		} 		  
	    return true;
    }

function agreement_validate() 
{
		
		if($('#agreement_note').val()=='')
		{
			alert('Please add some text');
			$('#agreement_note').focus();
			return false;
		} 
	    return true;
    }
	
$(document).on('click', '#save_agreement', function()
{ 
		var $this = $(this);
		var $url = $this.data('url');     	

		var isCallValid = agreement_validate();
		if(isCallValid==false)
		{
			return false;	
		}
$('#agreement_form').submit()

	});
	
		
$(document).on('click', '#save_calls', function(){ 
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

$(document).on('click', '#save_jobs', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

		var isCallValid = job_validate();
		if(isCallValid==false)
		{
			return false;	
		}
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#jobs_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){	
				 alert('Job added successsfully');
				 $('#jobs_modal').modal('hide');					
				//	location.reload();
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
</script>