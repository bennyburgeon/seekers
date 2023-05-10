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

			   if($this->input->get('del')==2){?> 
			   <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Cannot be deleted, jobs added already under this company.</strong>
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
<a href="<?php echo base_url();?>index.php/company/add?<?php echo $query_string;?>" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>

|| 
<a href="<?php echo base_url();?>index.php/company/import_csv" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Import CSV</a>


<a href="<?php echo base_url(); ?>index.php/company" id="clear_search" class="btn btn-primary btn-xs">Clear Search Filters</a>


</div>
<form id="searchForm" action="<?php echo base_url(); ?>index.php/company" method="get" name="searchForm">
<table width="47%" class="tool-table">
<tbody>


<tr>
<td width="17%"><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Company Name" value="<?php echo $searchterm != '' ? $searchterm: '' ;?>"     style="width: 100px;"> </td>
<td width="9%"><?php echo form_dropdown('ind_id', $industry_list , $ind_id,'style="width:100px;" class="form-control"  id="ind_id" ');?></td>
<td width="13%"><?php echo form_dropdown('flp_status', $lead_status_list , $flp_status,'style="width:125px;" class="form-control"  id="flp_status" ');?></td>
<td width="8%"><?php echo form_dropdown('status', $status_list , $status,'style="width:125px;" class="form-control"  id="status" ');?></td>

<td width="18%"><input type="text" style="width:100px;" id="date_added" class="form-control p m-ctrl-medium date-picker" name="date_added" value="<?php echo $date_added; ?>" placeholder="Created On" /></td>

<td width="17%"><input type="text" style="width:100px;" id="flp_next_date" class="form-control p m-ctrl-medium date-picker" name="flp_next_date" value="<?php echo $flp_next_date; ?>" placeholder="Flp Date" /></td>

<td width="3%">
<?php echo form_dropdown('company_rating', $company_rating_list , $company_rating,'style="width:100px;" class="form-control"  id="company_rating" ');?>
</td>

<td width="11%">
<a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
</td>
</tr>
<tr>
  <td><?php echo form_dropdown('country_id', $country_list , $country_id,'class="form-control"  id="country_id" ');?></td>
  <td><?php echo form_dropdown('state_id', $state_list , $state_id,'class="form-control"  id="state_id" ');?></td>
  <td><?php echo form_dropdown('city_id', $city_list , $city_id,'class="form-control"  id="city_id" ');?></td>
  <td><?php echo form_dropdown('building_location', $building_loc_list , $building_location,'class="form-control"  id="building_location" ');?></td>
 
  <td><?php echo form_dropdown('user_id', $bde_list , $user_id,' style="width:100px;" id="user_id" ');?></td>

<td>
<?php echo form_dropdown('company_priority', $company_priority_list , $company_priority,'style="width:100px;" class="form-control"  id="company_priority" ');?>
</td>
  <td  colspan="3"><input type="checkbox" name="unassigned" value="1" <?php if($unassigned!='')echo 'checked';?>>&nbsp;Show Unassigned </td>
</tr>


</tbody>
</table>

<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>

</div>
<div class="views_section">

<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>
</form>
<div style="clear:both;"></div>
<form name="frm_assignment" method="post" id="frm_assignment" action="<?php  echo $this->config->site_url();?>/company/multiple_assignment?rows=<?php echo $rows;?>" >
<table class="tool-table new">
<thead>
								<tr role="row" class="heading">
<th width="24"><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                                        <th width="534"><a href="<?php echo $this->config->site_url()?>/company?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Company Name</a></th>
                                    <th width="305">Contact Details</th>
                                    <th width="218">Assign To &nbsp;||&nbsp;<?php echo form_dropdown('user_id', $bde_list , $user_id,'  id="assign_admin_id" ');?></th>
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
					<input type="checkbox" name="company_id[]" class="checkboxes" value="<?php echo $result['company_id']?>" >
				</span>
				</div>
			</td>
			<td>
				<a target="_blank" href="<?php echo base_url();?>index.php/company/edit/<?php echo $result['company_id']?>" class="views" title="Edit This Company"><?php echo $result['company_name']?></a><br> 
				
				<?php if($result['total_flp']>0){ ?>
                <a href="javascript:;" title="Get list of all calls" onclick="get_calls_history(<?php echo $result['company_id'];?>);"  id="get_calls_company" class="btn btn-info btn-xs"> History[<?php echo $result['total_flp']?>]</a>
				<?php }else{ ?>                
                 <a href="javascript:void();" title="No calls yet, please click on Call at right side to log calls." class="btn btn-info btn-xs">No Calls</a> 
				<?php } ?> 
                 || 
                
                Flp Date: <a href="javascript:void();" class="btn btn-success btn-xs"><?php echo $result['flp_date']?></a> ||  Next Date: <a href="javascript:void();" class="btn btn-warning btn-xs"><?php echo $result['flp_next_date'];?></a> || Upd By: <p class="btn btn-primary btn-xs"> <?php echo $result['firstname']?></p><br><br>
                
				 Last Call Status: <p class="btn btn-primary btn-xs"> 
				 
				 <?php if($result['flp_status']==1)echo 'Contact Updated & Profile Sent';?>
				 <?php if($result['flp_status']==2)echo 'Followed up - Call Later';?>
				 <?php if($result['flp_status']==3)echo 'Positive Response - Need Follow up';?>
				 <?php if($result['flp_status']==4)echo 'Meeting Arranged & Proposal Sent';?>
				 <?php if($result['flp_status']==5)echo 'Active Client - Have Business';?>
				 <?php if($result['flp_status']==6)echo 'Inactive Client - Need Follow up';?>
				 <?php if($result['flp_status']==7)echo 'No Need to Follow up';?>
                 
                 </p> 
                 
                 
                 || Created By:<?php echo $result['created_by']?>|| Total Jobs : <?php echo $result['total_jobs']?>
                 <br>
                 Logo: <?php if($result['company_logo']!='')echo 'Uploaded';else echo 'Not Uploaded';?><br>
					Country:<?php echo $result['country_name']?> || State: <?php echo $result['state_name']?> | City: <?php echo $result['city_name']?><br>

				Industry: <?php echo $result['job_cat_name']?>

<br>


 
				 <?php if($result['company_priority']==1)echo 'Priority:  High';?>
				 <?php if($result['company_priority']==2)echo 'Priority: Medium';?>
				 <?php if($result['company_priority']==3)echo 'Priority: Low';?>
<br>
				 <?php if($result['status']==1)echo 'Lead Status:  Feed';?>
				 <?php if($result['status']==2)echo 'Lead Status: Lead';?>
				 <?php if($result['status']==3)echo 'Lead Status: Client';?>
                 <?php if($result['status']==3)echo 'Lead Status: Not Qualified';?>


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
            
            <a href="javascript:;" title="Make Calls" onclick="add_calls(<?php echo $result['company_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/company/add_calls/?company_id=<?php echo $result['company_id'];?>"  id="add_calls" class="btn btn-info btn-xs"> Calls</a>
||
            
             <a href="javascript:;" title="Assign this to BDE" onclick="assign_requirement(<?php echo $result['company_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/company/assign_requirement/?job_id=<?php echo $result['company_id'];?>"  id="assign_requirement" class="btn btn-info btn-xs"> Assign</a>
         <?php if($result['status']==3){?>
                <br><br>
                <a href="javascript:void();" class="btn btn-success btn-xs disabled">Moved to Clients </a>
                
                <?php } ?>
                
                || <a href="<?php echo base_url(); ?>index.php/company/edit/<?php echo $result['company_id'];?>" title="Edit"   id="edit_company" class="btn btn-info btn-xs"> Edit</a> 
                ||
                <a href="#" onClick="delete_company(<?php echo $result['company_id'];?>);" title="Delete This." id="delete_row" class="btn btn-info btn-xs"> Delete</a>
               
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
        	
      <div class="modal-body" id="call_form_holder">
        loading
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
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company/add_jobs" id="jobs_form" name="calls_form"> 
            
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
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/company/save_assignment" id="assignment_form" name="assignment_form"> 
            
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
                  data-url="<?php echo $this->config->site_url();?>/company/save_assignment" />
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
		window.location.href = '<?php echo $this->config->site_url();?>/company?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/company?limit='+limits;
	});
	
});
</script>

<script type="text/javascript">

$('input[type=text]').addClass('form-control');
/* interview related function modal window, add form, edit form etc. */

function add_calls(company_id)
{
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/company/get_call_form/",
			method: "POST",
  			data: { company_id : company_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#call_form_holder').html(data);
			}
		});
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
			url:"<?php echo base_url(); ?>index.php/company/get_calls_history/?company_id=<?php echo $result['company_id'];?>",
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

function delete_company(company_id)
{
	 	var cfm= confirm('Are you sure, delete this record?');
		if(cfm==false)return;
	   $.ajax({			
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/company/delete_company/',
			data: { company_id : company_id },
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success')
				 {	
					alert('Company Deleted Successfuly')
					location.reload();
				 }
				 else
				 {
					 alert('Some error occurred');
				 }
			}
		});
}

function assign_requirement(company_id)
{
	$('#assign_company_id').val(company_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/company/assign_requirement/?company_id="+company_id,
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

	$(document).on('change', '#assign_admin_id', function()
	{ 
		$("#frm_assignment").submit();
	});
	
function get_all_contacts(company_id){
	
	$('#show_all_contacts').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/company_calls/get_all_contacts/?company_id=<?php echo $result['company_id'];?>",
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

$('#country_id').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
			
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/company/getstate/',
		  data: { country_id: $('#country_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#state_id').html('');
				  $.each(data.state_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#state_id').append('<option value="'+ $.trim(index) +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#state_id').append('<option value="'+ $.trim(index) +'">'+ value +'</option');
				 });
						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Select State</option');
		  }
		});	
});
$('#state_id').change(function() {

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
		
	if($('#state_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/company/getcity/',
		  data: { state_id: $('#state_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#city_id').html('');
				  $.each(data.city_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#city_id').append('<option value="'+ $.trim(index) +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#city_id').append('<option value="'+ $.trim(index) +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Select City</option');
		  }
		});	
});


</script>