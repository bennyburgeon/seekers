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

<a href="<?php echo base_url();?>index.php/company_flp/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>

|| 
<a href="<?php echo base_url();?>index.php/company_flp/import_csv" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Import CSV</a>

 
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
-->

</div>
<form id="searchForm" action="" method="get" name="searchForm">
<table class="tool-table">
<tbody>


<tr>
<td width="30%"><?php echo form_dropdown('admin_id', $bde_list , $admin_id,'style="width:100px;" class="form-control"  id="admin_id" ');?> </td>
<!-- <td width="30%"><?php echo form_dropdown('ind_id', $industry_list , $ind_id,'style="width:100px;" class="form-control"  id="ind_id" ');?></td> -->
<td width="30%"><?php echo form_dropdown('flp_status', $lead_status_list , $flp_status,'style="width:125px;" class="form-control"  id="flp_status" ');?></td>
<td width="15%"><?php echo form_dropdown('status', $status_list , $status,'style="width:125px;" class="form-control"  id="status" ');?></td>

<td width="15%"><input type="text" style="width:100px;" id="flp_date_from" class="form-control p m-ctrl-medium date-picker" name="flp_date_from" value="<?php echo $flp_date_from; ?>" placeholder="Date From" /></td>

<td width="10%">
<input type="text" style="width:100px;" id="flp_date_to" class="form-control p m-ctrl-medium date-picker" name="flp_date_to" value="<?php echo $flp_date_to; ?>" placeholder="Date To" />
</td>
<td width="10%">
<?php echo form_dropdown('company_priority', $company_priority_list , $company_priority,'style="width:100px;" class="form-control"  id="company_priority" ');?>
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
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/company_flp/multidelete?rows=<?php echo $rows;?>" >
<table class="tool-table new">
<thead>
								<tr role="row" class="heading">
<th width="33"><div class="checker">BDE</div></th>
                                        <th width="380">Flp/ Notes</th>
                                         <th width="183">BDE</th>
                                    <th width="152">Flp. Date</th>
                                    <th width="141">Next. Date</th>
                                    <th width="174">Flp. Status</th>
                                    <th width="124">Created By</th>
                                    <th width="51">Folder</th>
                                   
                                </tr>
</thead>
<tbody>

<?php 		
if($records!=NULL)
{
	foreach($records as $result){ ?>
		<tr class="odd gradeX">
			<td>#</td>
			<td>
				<?php echo $result['flp_notes']?><br> 
                History:<a href="javascript:;" title="Get last history" onclick="get_calls_history(<?php echo $result['company_id'];?>);"  id="get_calls_company" class="btn btn-info btn-xs"> [<?php echo $result['company_name']?>]</a><br>
				</td>
<td><?php echo $result['firstname']?>
            </td>
            <td>
			
            <?php echo $result['flp_date']?></td>
            <td><?php echo $result['flp_next_date'];?></td>
            <td><?php if($result['flp_status']==1)echo 'We Have Openings';?><?php if($result['flp_status']==2)echo 'No Openings';?><?php if($result['flp_status']==3)echo 'Call after a month';?><?php if($result['flp_status']==4)echo 'Already have vendor';?><?php if($result['flp_status']==5)echo 'We have in house team';?><?php if($result['flp_status']==6)echo 'Became Client';?><?php if($result['flp_status']==7)echo 'Do not Disturb';?></p></td>
            <td><?php echo $result['created_by']?></td>
            <td><?php if($result['status']==1)echo 'Just a Lead';?><?php if($result['status']==2)echo 'In Process';?><?php if($result['status']==3)echo 'Clients';?></td>
            
            
            </tr>


		<?php
		}}else{?>
					<tr>
						<td colspan="8" align="center">
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
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company_flp/add_calls" id="calls_form" name="calls_form"> 
            
             		<input type="hidden" name="company_id" id="company_id" value="">
                <table class="hori-form">
                <tbody>
				<tr>
                   <td>Opportunity</td>
                   <td>
                   
                    <input id="flp_status" type="radio" name="flp_status" value="1"  />Contact Updated & Profile Sent<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="2"/>Followed up - Call Later<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="3"/>Positive Response - Need Follow up<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="4"/>Meeting Arranged & Proposal Sent<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="5"/>Active Client - Have Business<br>                    
                    <input id="flp_status" type="radio" name="flp_status" value="6"/>Inactive Client - Need Follow up<br>
                    <input id="flp_status" type="radio" name="flp_status" value="7"/>No Need to Follow up

   			 </td>
                 </tr>

                <tr>
                  <td>Lead Status</td>
                  <td>                    <input id="status" type="radio" name="status" value="1" />
                    Feed<br>                    
                    <input id="status" type="radio" name="status" value="2"/>
                    Lead<br>                    
                    <input id="status" type="radio" name="status" value="3"/>
                    Client
                    <br>
                    <input id="status" type="radio" name="status" value="4"/>Not Qualified<br>   </td>
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
                 <td><input type="text" name="flp_next_date" value="<?php echo date('Y-m-d',strtotime("+7 day")); ;?>" class="smallinput datepicker"  id="flp_next_date"  /></td>
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
                  data-url="<?php echo $this->config->site_url();?>/company_flp/add_calls" />
                 
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
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company_flp/add_jobs" id="jobs_form" name="calls_form"> 
            
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
                  data-url="<?php echo $this->config->site_url();?>/company_flp/add_jobs" />
				       
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
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company_flp/save_assignment" id="assignment_form" name="assignment_form"> 
            
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
                  data-url="<?php echo $this->config->site_url();?>/company_flp/save_assignment" />
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


<div style="clear:both;"></div>
</div>



<!-- Graph Data --> <br>
<br>

<div style="clear:both;"></div>
<div id="bde_to_lead_collection"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
<br />

<div id="lead_status_summary"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
<br />


<div id="followup_history"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
<br />

<div id="followup_status_summary"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div><br />
<br />

<div id="lead_opportunity"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
<br />

<!-- Graph Data --> 




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
		window.location.href = '<?php echo $this->config->site_url();?>/company_flp?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/company_flp?limit='+limits;
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
			url:"<?php echo base_url(); ?>index.php/company_flp/get_calls_history/?company_id=<?php echo $result['company_id'];?>",
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
	$('#flp_date_from').datepicker({
		dateFormat: "yy-mm-dd"
	});
	$('#flp_date_to').datepicker({
		dateFormat: "yy-mm-dd"
	});
});

function assign_requirement(company_id)
{
	$('#assign_company_id').val(company_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/company_flp/assign_requirement/?company_id="+company_id,
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
					alert('Updated...');				
					$("#assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

</script>

<!--scripts-->
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.stickyfooter.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/animate_jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/maps.googleapis.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/map.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.canvasjs.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
  <script>
  $(function() {
    $( ".datepicker" ).datepicker();
  });
  </script>
<script src="<?php echo base_url('assets/js/custom.js');?>"></script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	  
	 // google.setOnLoadCallback(branchwiseProcess);
      google.setOnLoadCallback(followup_history);

	  google.setOnLoadCallback(coursesOpted);
	  google.setOnLoadCallback(bde_to_lead_collection);
	  google.setOnLoadCallback(lead_status_summary);
	  google.setOnLoadCallback(lead_opportunity);
      function bde_to_lead_collection() {
       var data = google.visualization.arrayToDataTable([		
         ['Lead Status Name', 'Total'],<?php foreach($bde_to_lead_collection as $key => $val){?> ['<?php if($val['total_leads']!='')echo $val['firstname'];else echo 'NA';?> ',   <?php echo $val['total_leads']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Lead collection status from BDEs',
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('bde_to_lead_collection'));
        chart.draw(data, options);
	        }
			
	      function lead_status_summary() {
       var data = google.visualization.arrayToDataTable([		
         ['Lead Status Name', 'Total'],<?php foreach($lead_status_summary as $key => $val){?> ['<?php if($val['total_count']>0)echo $val['status'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Lead Conversion Summary',
        };

        var chart = new google.visualization.PieChart(document.getElementById('lead_status_summary'));
        chart.draw(data, options);
	        }

      function followup_history() {
		  
	  var data = new google.visualization.DataTable(); 
      data.addColumn('string', 'cdate');
      data.addColumn('number', 'total');
	 
	data.addRows([
	<?php foreach($followup_history as $key => $val){?> ['<?php echo $val['flp_date']?>',   <?php echo $val['total']?>],<?php } ?>	
	]);
	  
        var options = {
		  aggregationTarget: 'category', // group values in x-axis
		 

          title: 'Total Follow Up History', 
          hAxis: {showTextEvery: 122,
		  		  title: 'Date',
          		  logScale: false	
				  },
          vAxes: {0: {viewWindowMode:'explicit',
		  			  title: 'Total',
          			  logScale: false,
                      gridlines: {color: 'grey', count:6},
                      },
                  1: {gridlines: {color: 'transparent'},
				  	//	title: 'Count',
                      format:""},
                  },
        
          colors: ["red", "green", "orange","blue"],
          chartArea: {left:100,top:60,width:'85%',height:'60%'},
 		  legend: { position: 'none' },
		  interpolateNulls : true,		  		  
        };

        var chart = new google.visualization.LineChart(document.getElementById('followup_history'));
        chart.draw(data, options);
      }

function coursesOpted() {
        var data = google.visualization.arrayToDataTable([		
         ['Status', 'Total Count'],<?php foreach($followup_status_summary as $key => $val){?> ['<?php if($val['flp_status']!='')echo $val['flp_status'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Follow-up Status Summary',
          is3D: true,
		  slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
					18: {offset: 0.7},
					22: {offset: 0.6},
					25: {offset: 0.9},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('followup_status_summary'));
        chart.draw(data, options);
      }

  	  	    

  function lead_opportunity() {
       var data = google.visualization.arrayToDataTable([		
         ['Industry', 'Total'],<?php foreach($lead_opportunity as $key => $val){?> ['<?php if($val['job_cat_name']!='')echo $val['job_cat_name'];else echo 'Not Set';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Company - Industry Summary',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('lead_opportunity'));
        chart.draw(data, options);
      }	

	  
</script>

  
  
  