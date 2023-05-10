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
                    <strong>Sucess !</strong> &nbsp;&nbsp;Details added successfully.
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
<a href="<?php echo base_url();?>index.php/clientmanager/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>

|| 
<a href="<?php echo base_url();?>index.php/clientmanager/import_csv" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Import CSV</a>


<a href="<?php echo base_url(); ?>index.php/clientmanager" id="clear_search" class="btn btn-primary btn-xs">Clear Search Filters</a>


</div>
<form id="searchForm" action="<?php echo base_url(); ?>index.php/clientmanager" method="get" name="searchForm">
<table width="48%" class="tool-table">
<tbody>


<tr>
<td width="30%"><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Company Name" value="<?php echo $searchterm != '' ? $searchterm: '' ;?>"     style="width: 100px;"> </td>
<td width="30%"><?php echo form_dropdown('ind_id', $industry_list , $ind_id,'style="width:100px;" class="form-control"  id="ind_id" ');?></td>
<td width="30%"><?php echo form_dropdown('flp_status', $lead_status_list , $flp_status,'style="width:125px;" class="form-control"  id="flp_status" ');?></td>
<td width="15%"><?php echo form_dropdown('status', $status_list , $status,'style="width:125px;" class="form-control"  id="status" ');?></td>

<td width="15%"><input type="text" style="width:100px;" id="date_added" class="form-control p m-ctrl-medium date-picker" name="date_added" value="<?php echo $date_added; ?>" placeholder="Created On" /></td>

<td width="15%"><input type="text" style="width:100px;" id="flp_next_date" class="form-control p m-ctrl-medium date-picker" name="flp_next_date" value="<?php echo $flp_next_date; ?>" placeholder="Flp Date" /></td>

<td width="10%">
<?php echo form_dropdown('company_priority', $company_priority_list , $company_priority,'style="width:100px;" class="form-control"  id="company_priority" ');?>
</td>
<td width="10%">
<?php echo form_dropdown('company_rating', $company_rating_list , $company_rating,'style="width:100px;" class="form-control"  id="company_rating" ');?>
</td>

<td width="10%">
<a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
</td>
</tr>


</tbody>
</table>

<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>

</div>
<div class="views_section">
<!-- 
<div class="view-drop">
<span><input type="checkbox" name="unassigned" value="1" <?php if($unassigned!='')echo 'checked';?>>&nbsp;Show Unassigned Only &nbsp;||&nbsp;Select BDE</span>&nbsp;
<?php echo form_dropdown('user_id', $bde_list , $user_id,'  id="user_id" ');?> 
</div>
-->
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>
</form>
<div style="clear:both;"></div>
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/clientmanager/multidelete?rows=<?php echo $rows;?>" >
<table class="tool-table new">
<thead>
								<tr role="row" class="heading">
<th width="24"><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                                        <th width="534"><a href="<?php echo $this->config->site_url()?>/clientmanager?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Company Name</a></th>
                                    <th width="399">Contact Details</th>
                                    <th width="166">Actions</th>
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
				<a href="<?php echo base_url();?>index.php/clientmanager/edit/<?php echo $result['company_id']?>" class="views" title="Edit This Company"><?php echo $result['company_name']?></a><br> 
				
				<?php if($result['total_flp']>0){ ?>
                <a href="javascript:;" title="Get list of all calls" onclick="get_calls_history(<?php echo $result['company_id'];?>);"  id="get_calls_company" class="btn btn-info btn-xs"> View Call History[<?php echo $result['total_flp']?>]</a>
				<?php }else{ ?>                
                 <a href="javascript:void();" title="No calls yet, please click on Call at right side to log calls." class="btn btn-info btn-xs">No Calls</a> 
				<?php } ?> 
                 || 
                
                Flp Date: <a href="javascript:void();" class="btn btn-success btn-xs"><?php echo $result['flp_date']?></a> ||  Next Date: <a href="javascript:void();" class="btn btn-warning btn-xs"><?php echo $result['flp_next_date'];?></a></p><br>
                
				 Lead Status: <p class="btn btn-primary btn-xs"> <?php if($result['flp_status']==1)echo 'We Have Openings';?><?php if($result['flp_status']==2)echo 'No Openings';?><?php if($result['flp_status']==3)echo 'Call after a month';?><?php if($result['flp_status']==4)echo 'Already have vendor';?><?php if($result['flp_status']==5)echo 'We have in house team';?><?php if($result['flp_status']==6)echo 'Became Client';?><?php if($result['flp_status']==7)echo 'Do not Disturb';?></p> 
                 
              
                 
                Total Jobs : <?php echo $result['total_jobs']?>
                 
                 </td>

            <td>
			
            Email:<a href="mailto:<?php echo $result['contact_email']?>?subject=test%20subject" class="btn btn-warning btn-xs"><?php echo $result['contact_email']?></a><br>
            
            Phone:<a href="javascript:void();" class="btn btn-success btn-xs"><?php echo $result['contact_phone']?></a> || Ext. <a href="javascript:void();" class="btn btn-success btn-xs"><?php echo $result['contact_phone_ext']?></a><br>
            
            Contact:<?php echo $result['contact_name']?><br>

			<?php 
				$host_ar=parse_url($result['company_website']);

			?>
		<a href="<?php if(isset($host_ar['path']) && $host_ar['path']!='')echo 'http://'.$host_ar['path']; if(isset($host_ar['host']) && $host_ar['host']!='') echo ''.$host_ar['host'];?>" target="_blank"><?php echo $result['company_website'];?></a>
        
        <br>
             <a href="javascript:;" title="Get All Contacts" onclick="get_all_contacts(<?php echo $result['company_id'];?>);"  id="get_all_contacts" class="btn btn-info btn-xs"> Show All Contacts</a>
        
        </td>
            
            <td>
            
            <a href="javascript:;" title="Make Calls" onclick="add_calls(<?php echo $result['company_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/clientmanager/add_calls/?company_id=<?php echo $result['company_id'];?>"  id="add_calls" class="btn btn-info btn-xs"> Calls</a>
			
            || 
            
            <a href="javascript:;" title="Add New Job" onclick="add_jobs(<?php echo $result['company_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/clientmanager/add_calls/?company_id=<?php echo $result['company_id'];?>"  id="add_jobs" class="btn btn-info btn-xs"> Add Job</a>
            <!-- 
            
             ||
             <a href="javascript:;" title="Assign this to BDE" onclick="assign_requirement(<?php echo $result['company_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/clientmanager/assign_requirement/?job_id=<?php echo $result['company_id'];?>"  id="assign_requirement" class="btn btn-info btn-xs"> Assign</a> 
         <?php if($result['status']==3){?>
                <br><br>
                <a href="javascript:void();" class="btn btn-success btn-xs disabled">Moved to Clients </a>
                
                <?php } ?>
                
                -->
                
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

<!-- clientmanager follow up model start here -->

<div class="modal fade" id="calls_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/clientmanager/add_calls" id="calls_form" name="calls_form"> 
            
             		<input type="hidden" name="company_id" id="company_id" value="">
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Call Status</td>
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
                    <input id="status" type="radio" name="status" value="1" />New Lead<br>                    
                    <input id="status" type="radio" name="status" value="2"/>In Progress<br>                    
                    <input id="status" type="radio" name="status" value="3"/>Open Deal<br>
                    <input id="status" type="radio" name="status" value="4"/>Unqualified<br>                    
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
                 <td><input type="text" name="flp_date" value="<?php echo date('Y-m-d');?>" class="smallinput datepicker" id="flp_date"  /></td>
                </tr>
                                
                <tr>
                <td>Next Follow-up Date</td>
                 <td><input type="text" name="flp_next_date" value="<?php echo date('Y-m-d',strtotime("+7 day")); ;?>" class="smallinput datepicker" id="flp_next_date"  /></td>
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
                  <td> Assign Task To</td>
                 <td><?php echo form_dropdown('admin_id',  $admin_list,'','class="form-control" id="admin_id"');?> </td>
                </tr>
                                                
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Save" id="save_calls" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/clientmanager/add_calls" />
                 
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
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/clientmanager/add_jobs" id="jobs_form" name="calls_form"> 
            
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
                  data-url="<?php echo $this->config->site_url();?>/clientmanager/add_jobs" />
				       
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
        <br><h3>History</h3>
        <div id="show_followup_history"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="assignment_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15" id="assignment_history">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/clientmanager/save_assignment" id="assignment_form" name="assignment_form"> 
            
             		<input type="hidden" name="company_id" id="assign_company_id" value="">
                    
                    <div id="data_holder">
                    
                <table class="hori-form">
                <tbody>
                <tr>
                  <td colspan="2">
					Loading...................
                  </td>
                </tr>
                </tbody>
                </table>  
                  
                </div>        
                <table class="hori-form">
                <tbody>
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Assign to BDE" id="save_assignment_button" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/clientmanager/save_assignment" />
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

<div class="modal fade" id="all_contacts_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document" style="width:1082px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div id="show_all_contacts"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
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
		window.location.href = '<?php echo $this->config->site_url();?>/clientmanager?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/clientmanager?limit='+limits;
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
function get_calls_history(company_id){
	
	$('#show_followup_history').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/clientmanager/get_calls_history/?company_id=<?php echo $result['company_id'];?>",
			data: $('#calls_form').serialize(),
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

function call_validate() {
		return true;
		if($('#flp_notes').val()=='')
		{
			alert('Enter some notes');
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

$(document).ready(function(){
	$('#flp_next_date').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$('#date_added').datepicker({
		dateFormat: "yy-mm-dd"
	});
		

});

function assign_requirement(company_id)
{
	$('#assign_company_id').val(company_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/clientmanager/assign_requirement/?company_id="+company_id,
			data: $('#assignment_form').serialize(),
			method: "POST",
  			data: { company_id : company_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#data_holder').html(data);
			}
		});
    $('#assignment_modal').modal();		
}

$(document).on('click', '#save_assignment_button', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success')
				 {	
					$('#assignment_modal').modal('hide');	
					alert('Job sucessfully assigned.');				
					$("#assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

function get_all_contacts(company_id){
	
	$('#show_all_contacts').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/clientmanager/get_all_contacts/?company_id=<?php echo $result['company_id'];?>",
			data: $('#calls_form').serialize(),
			method: "POST",
  			data: { company_id : company_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_all_contacts').html(data);
			}
			
		});
    $('#all_contacts_modal').modal();
}

</script>