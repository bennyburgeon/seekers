<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/job_apps">Back to Listing</a><i class="fa fa-circle"></i> </li>
        <li class="active"><?php echo $page_head;?></li>
</ul>
</div>
<div class="row">



<div class="col-md-11">
<div class="profile_top">
<div class="profile_top_left">Job View</div>
<div class="profile_top_right">
<ul>
<li id="followup_btn">Follow up</li>
<li id="notes_btn">Notes</li>
<!--<li id="interviews_btn">Interviews</li>-->

</ul>
</div>
<div style="clear:both;"></div>
</div>



<div class="profile_bottom" id="followup">
<div class="tasks profile">

<div id="response"></div>
<?php 
 foreach($list as $followup_list1){?>
<div class="slider_redesign" id="tr_<?php echo $followup_list1['followup_id'];?>" >
<div class="side_adj second">

<h2>Followup Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $followup_list1['title'];?></h2>
<?php if($followup_list1['status_name']!=''){?>
<h2>Status:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $followup_list1['status_name'];?></h2>
<?php } ?>

<h2>Description:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $followup_list1['description'];?></h2>
<div class="date_edit">
<span class="dates"><?php echo date('Y F d',strtotime ($followup_list1['flp_date']));?></span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $followup_list1['followup_id'];?>" onClick="return validate(this.id)" >

</span>

</div>
</div>
</div>
<?php }?>


</div>
</div>

<div class="profile_bottom" id="notes">
<div class="tasks profile">
<div id="response1"></div>
<?php foreach($note_list as $note_list1){?>
<div class="slider_redesign" id="tr_<?php echo $note_list1['job_note_id'];?>">
<div class="side_adj second">

<h2>Note Title:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $note_list1['title'];?></h2>
<h2>Note Description:&nbsp;&nbsp;<?php echo $note_list1['notes'];?></h2>
<div class="date_edit">
<span class="dates"><?php echo date('Y F d',strtotime ($note_list1['note_date']));?></span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" onClick="return note_validate(this.id)" id="<?php echo $note_list1['job_note_id'];?>" >

</span>

</div>
</div>
</div>
<?php }?>

</div>
</div>


<div class="profile_bottom" id="interviews">
<div class="tasks profile">
<div id="response2"></div>


</div>
</div>

<div class="notes">
<ul>
<li id="tab_1btn">Followup</li>
<li id="tab_2btn">Notes</li>
<!--<li id="tab_3btn">Interview</li>-->
</ul>

   
<!--Followup-->

<div class="table-tech specs note" id="tab_1">
<div class="new_notes">
<!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
-->
<p id="result"></p>

<p id="deletemessage"></p>

        <form method="post" id="profile_followup" name="profile_followup" action="<?php  echo $this->config->site_url();?>/job_apps/followup" >
        
        <input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
          <input type="hidden" value="<?php echo $detail_list['job_id'];?>" name="job_id" id="job_id">
            <input type="hidden" value="<?php echo $detail_list['job_app_id'];?>" name="app_id" id="app_id">
            <table class="hori-form">
                <tbody>
                    <tr>
                    <td width="200">Enter Title</td>
                    <td width="139" colspan="2">
                    <input name="followup_title" type="text" id="followup_title" class="text_box">    </td>
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
        <input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
        <input type="hidden" value="<?php echo $detail_list['job_id'];?>" name="job_id" id="job_id">
        <input type="hidden" value="<?php echo $detail_list['job_app_id'];?>" name="app_id" id="app_id">
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
		    <!--Followup-->
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
				url: '<?php echo site_url('job_apps/followup'); ?>',
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
				url: '<?php echo site_url('job_apps/notes'); ?>',
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