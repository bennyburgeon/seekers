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
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>
<?php if($this->input->get('ins')==1){?>  

<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> record added successfully.
</div>
<?php } ?> 

<?php if($this->input->get('update')==1){?>  
 <div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> record updated successfully.
</div>
<?php } ?>  
             
<?php if($this->input->get('del')==1){?> 
		<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>record deleted..</strong>
			</div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/job_apps/multidelete?rows=<?php echo $rows;?>" >

<div class="right-btns">
<?php /*?><a href="<?php echo base_url();?>index.php/company/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a><?php */?>
<?php /*?><a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a><?php */?>
</div>

        <table class="tool-table">
            <tbody>
                <form id="searchForm">
                    <tr>
                        <td colspan="3"> <?php echo form_dropdown('search_term',  $jobs_list,'','id="search_term"  class="table-group-action-input form-control input-medium"');?></td>
                        
                        <td>
                        <a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
                        </td>
                    </tr>
                <!--</form>-->
            </tbody>
        </table>
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
<table class="tool-table new">
 <thead>
	<tr role="row" class="heading">
    	
		<?php /*?><th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th><?php */?>
		<th><a href="<?php echo $this->config->site_url()?>/jobs?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>
        &rows=<?php echo $rows;?>">Job Title</a></th>
        <th>Company Name</th>	
		<th>Candidate Name</th>
		<th>Applied Date</th>
        <th></th>
       
	</tr>
 </thead>
 <tbody>

  	<?php 
	if($records!=NULL)
	{
		foreach($records as $result){ ?>
                        
		<tr class="odd gradeX">
		    <?php /*?><td>
              <div class="checker">
                <span>
                    <input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['candidate_id']?>" >
                </span>
              </div>
        	</td><?php */?>
           
			<td><?php echo $result['job_title']?></td>
             <td><?php echo $result['company_name']?></td>
            <td><?php echo $result['first_name'].' '.$result['last_name']?></td>
            <td><?php echo date("d-m-Y", strtotime($result['applied_on']));?></td>
            
           <td><a href="<?php echo $this->config->site_url();?>/job_apps/job_view/?job_id=<?php echo $result['job_id'];?>&app_id=<?php echo $result['job_app_id'];?>&candidate_id=<?php echo $result['candidate_id'];?>">Follow-up</a></td>
	</tr>

	<?php
	}}else{?>
        <tr>
            <td colspan="9" align="center">
                No Records Founds!!
            </td>
        </tr>
	<?php } ?>
		
</tbody>

</table>
<?php echo $pagination; ?>
</form>                           



<div class="sep-bar">

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


<div class="notes">
<ul>
<li id="tab_1btn">Followup</li>
<!--<li id="tab_2btn">Notes</li>
-->

</ul>

   
<!--Followup-->

<div class="table-tech specs note" id="tab_1">
<div class="new_notes">
<!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
-->
<p id="result"></p>

<p id="deletemessage"></p>

        <form method="post" id="profile_followup" name="profile_followup" action="<?php  echo $this->config->site_url();?>/job_apps/followup" >
        
        
            <table class="hori-form">
                <tbody>
                    <tr>
                    <td width="200">Enter Title</td>
                    <td width="139" colspan="2">
                    <input name="followup_title" type="text" id="followup_title" class="text_box">    </td>
                    </tr>                   
                    
                    <tr>
                    <td>Job Application</td>
                    <td colspan="3"><select class="table-group-action-input form-control input-medium"  id="app_id" name="app_id">
                  
                    <?php if($records!=NULL){ foreach($records as $result){ ?>
                    <option value="<?php echo $result['job_app_id'];?>,<?php echo $result['job_id'];?>,<?php echo $result['candidate_id'];?>" ><?php echo $result['job_title'].'  '?> -<?php echo $result['first_name'].' '.$result['last_name']?></option>
                    <?php }}?>
                    </select></td>
                    </tr>
    
                    
                    <tr>
                    <td>Process status</td>
                    <td colspan="3"> <?php echo form_dropdown('status_id',  $status_list,'','id="status_idd"  class="table-group-action-input form-control input-medium"');?></td>
                    </tr>
                    
                    <tr>
                    <td>Enter Description</td>
                    <td colspan="2">
                    <textarea name="followup_desc" cols="" rows="" class="text_area" id="followup_desc"></textarea>    </td>
                    </tr>
                    
                    <tr>
                    <td colspan="4">Schedule this for a date in future?
                    <input type="checkbox" name="future_followup" value="1" id="future_followup"/>&nbsp;Yes</td>
                    </tr>
                    
                    <tr>
                    <td>Date</td>
                    <td colspan="3"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                    <tr>
                    <td><input type="text" name="flp_date_reminder" id="flp_date_reminder" readonly value="" style="width:100px;"/></td>
                    <td>Time</td>
                    <td><input type="text" name="flp_time_reminder" id="flp_time_reminder" value="" style="width:100px;"/>&nbsp;eg. 10:15 AM</td>
                    </tr>
                    </table></td>
                    </tr>
                    <tr>
                    <td>Responsibile by</td>
                    <td colspan="3"><?php echo form_dropdown('assigned_to',  $admin_user_list,'','id="assigned_to"  class="table-group-action-input form-control input-medium"');?>&nbsp;</td>
                    </tr>
                    
                    <tr>
                    <td colspan="3">
                    <span class="click-icons">
                    <input type="button" name="submit" id="submit" class="attach-subs" value="Save" >
                    <a href="#" class="attach-subs subs">Cancel</a>    </span>    </td>
                    </tr>
                </tbody>
            </table>
        </form>

</div>

<div style="clear:both;"></div>
</div>

<!--Followup-->

<!--Notes-->
<div class="table-tech specs note" id="tab_2">
<div class="new_notes">
<!--<div class="alert alert-warning"><strong>Warning!</strong> Your monthly traffic is reaching limit.</div>-->
<p id="result1"></p>

<p id="deletemessage1"></p>
    <form method="post" id="candidate_notes" name="candidate_notes" action="<?php  echo $this->config->site_url();?>/job_apps/notes" >
      <input type="hidden" value="<?php echo $record['job_app_id'];?>" name="app_id" id="app_id">
        <h3>Create New Note:</h3>
        <input name="note_title" type="text" class="text_box" id="note_title">
        
        <h3>Enter Description:</h3>
        <textarea name="note_desc" cols="" rows="" class="text_area" id="note_desc"></textarea>
        <span class="click-icons">
         <input type="button" name="sub1" id="sub1" class="attach-subs" value="Save" >
        <a href="" class="attach-subs subs">Cancel</a>
        </span>
    </form>
 </div>

<div style="clear:both;"></div>
</div>
 <!--Notes-->



<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>


<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script type="text/javascript">

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
	$("#search").click(function(){
		var searchterm = $('#search_term').val(); 
		var rows = '<?php echo $rows;?>';
		window.location.href = '<?php echo $this->config->site_url();?>/job_apps?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/job_apps?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/job_apps?limit='+limits;
	});
		
});

    $(document).ready(function (){
	function followup_validate() {
		if($('#followup_title').val()=='')
		{
			alert('Enter Your Title');
			$('#followup_title').focus();
			return false;
		}
		return true;
	}
		
    $('#submit').click(function()
	{
        var candidate_id=$('#candidate_id').val();
		var job_id=$('#job_id').val();
        var title=$('#followup_title').val();
		var status_id=$('#status_idd').val();
		var future_followup=$('#future_followup').val();
		var flp_date_reminder=$('#flp_date_reminder').val();
		var flp_time_reminder=$('#flp_time_reminder').val();
		var assigned_to=$('#assigned_to').val();
		var app_id=$('#app_id').val();
        var desc=$('#followup_desc').val();
		var isCandiadteValid = followup_validate();
		if(isCandiadteValid) {
			$.ajax({
				type:"POST",
				url: '<?php echo site_url('job_apps/followup_only'); ?>',
				data:{ 
					candidate_id:candidate_id,
					job_id:job_id,
					title: title,
					status_id:status_id,
					future_followup:future_followup,
					flp_date_reminder:flp_date_reminder,
					flp_time_reminder:flp_time_reminder,
					assigned_to:assigned_to,
					app_id:app_id,
					desc: desc,
				},
				success: function(msg) {
					$("#deletemessage").html('');
					$("#response").append(msg);
					$("#result").html('<div class="alert alert-success"><strong>Success!</strong> The page has been added.</div>');
					<!--Text field empty-->
					$('input[type="text"],textarea').val('');
				}
			});//end Ajax
		}//end Validation
    });//end button click 
});

<!--- followup------>
		 
<!--Notes-->
$(document).ready(function (){
	function notes_validate() {
		if($('#note_title').val()=='')
		{
			alert('Enter Note Title');
			$('#note_title').focus();
			return false;
		}
		if($('#note_desc').val()=='')
		{
			alert('Enter Your Notes');
			$('#note_desc').focus();
			return false;
		}   
		
		return true;
	}
	
	$('#sub1').click(function(){
		var candidate_id=$('#candidate_id').val();
		var job_id=$('#job_id').val();
		var app_id=$('#app_id').val();
		var title=$('#note_title').val();
		var note=$('#note_desc').val();
		var isCandiadte_noteValid = notes_validate();
		if(isCandiadte_noteValid) {
			$.ajax({
				type:"POST",
				url: '<?php echo site_url('job_apps/notes_only'); ?>',
				data:{ 
					candidate_id:candidate_id,
					job_id   :job_id,
					app_id   :app_id,
					title: title,
					note: note,
				},
				success: function(msg) {
					$("#deletemessage1").html('');
					$("#response1").append(msg);
					$("#result1").html('<div class="alert alert-success"><strong>Success!</strong> The page has been added.</div>');
					<!--Text field empty-->
					$('input[type="text"],textarea').val('');
				}
			});//end Ajax
		}//end Validation
	});//end button click 
});

function note_validate(note_id){
	if(confirm('Are you sure you want to delete?')){
	var row = "#tr_"+note_id;
		$.ajax({
			type:"POST",
			url: '<?php echo site_url('candidates_all/drop_notes'); ?>',
			data:{ 
				candidate_note_id:note_id,
			},
			success: function(msg) {
				$("#result1").html('');
				$('input[type="text"],textarea').val('');
				$(row).fadeOut("slow");
				$("#deletemessage1").html('<div class="alert alert-success"><strong>Success!</strong> The page has been Deleted.</div>');
		
			}
		});//end Ajax
	}
}
<!--Notes-->  
	
 </script>
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

<script>

$(document).ready(function()
{
	$('#interview_date').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$('#flp_date_reminder').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
});
</script>