
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Complaints</div>

<div style="clear:both;"></div>
</div>



<div class="profile_bottom" id="leads">
<div class="tasks profile">

<div id="response"></div>
<?php 
 foreach($ticket_list as $ticket){?>
<div class="slider_redesign" id="tr_<?php echo $ticket['ticket_id'];?>" >

<div class="side_adj second">

<h2><?php echo $ticket['ticket_title'];?></h2>
<div class="date_edit">
<span class="dates"><?php echo date("Y/m/d");?></span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $ticket['ticket_id'];?>" onClick="return validate(this.id)" >

</span>

</div>
</div>
</div>
<?php }?>


</div>
</div>

<div class="notes">
<ul>
<li id="tab_2btn">Complaints</li>


</ul>

   
	<!--Followup-->

    <div class="table-tech specs note">
    <div class="new_notes">
   
    <p id="result"></p>
    <p id="deletemessage"></p>

    <?php echo $error;?>
    <p id="success"></p>
   <p id="emails"></p>
 <p id="emaildelete"></p>
    <form action="<?php echo $this->config->site_url();?>/candidates_all/tickets/<?php echo $detail_list['candidate_id'];?>" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onsubmit="return email_validate();" >  
    <input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">


    <h3>Title </h3>
    <input name="ticket_title" id="ticket_title" type="text" class="text_box">
    <h3>Description</h3>
    <textarea name="ticket_description" cols="" rows="" class="text_area" id="ticket_description"></textarea> 
     <h3>SMS Text</h3>
    <textarea name="sms_text" cols="" rows="" class="text_area" id="sms_text"></textarea> 
     <span class="click-icons"><input type="radio" name="send_type" id="send_type" value="1" checked="checked" />&nbsp;Email Only&nbsp;&nbsp;&nbsp;<input type="radio" id="send_type" name="send_type" value="2" />&nbsp;SMS Only&nbsp;&nbsp;&nbsp;<input type="radio" name="send_type" id="send_type" value="3" />&nbsp;Email & SMS&nbsp;&nbsp;&nbsp;</span>
    <span class="click-icons"><br />

    <input type="submit" name="sub3" id="sub3" class="attach-subs" value="Send">
    </span>
    </form>
    </div>
    
   
    <div style="clear:both;"></div>
    </div>

	<!--Followup-->



<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script type="text/javascript">

		function validate(ticket_id){

			var row = "#tr_" + ticket_id;
		
		if(confirm('Are you sure you want to delete?')){
	
		$.ajax({
			type:"POST",
			url: '<?php echo site_url('candidates_all/drop_ticket_item'); ?>',
			data:{ 
			ticket_id:ticket_id,
        },
        success: function(msg) {
			$("#result").html('');
			$(row).fadeOut("slow");
		   $("#deletemessage").html('<div class="alert alert-danger"><strong>Success!</strong> The data has been Deleted.</div>');
	
        }
        });//end Ajax
		}
		}


function email_validate() 
{
	if($('#send_type').val()==1)
	{
		if($('#ticket_title').val()=='')
		{
			alert('Enter Your ticket_title');
			$('#ticket_title').focus();
			return false;
		}
		if($('#ticket_description').val()=='')
		{
			alert('Enter Email');
			$('#ticket_description').focus();
			return false;
		}   
	}else if($('#send_type').val()==2)
	{
		if($('#sms_text').val()=='')
		{
			alert('Enter SMS Text');
			$('#sms_text').focus();
			return false;
		}  
	}else if($('#send_type').val()==3)
	{
		if($('#ticket_title').val()=='')
		{
			alert('Enter Your ticket_title');
			$('#ticket_title').focus();
			return false;
		}
		if($('#ticket_description').val()=='')
		{
			alert('Enter Email');
			$('#ticket_description').focus();
			return false;
		} 	
		if($('#sms_text').val()=='')
		{
			alert('Enter SMS Text');
			$('#sms_text').focus();
			return false;
		}  
	}
 return true;
}

$(document).ready(function()
{
	  <!--File 1-->  
		$('.imageform1').on('change', function(e)
		{
			e.preventDefault();
			var img_path1 = '<?php echo base_url();?>assets/images/loader.gif';
			$("#loading").html('<img src="'+img_path1+'" alt="Uploading...." width="150" height="100"/>');
				$(this).ajaxSubmit({success:function(data)
				{ 
					 var img_path = '<?php echo base_url();?>uploads/photos/'+data;
					 $("#imgTab2").html('<img src="'+img_path+'" class="profile_img" width="158">');
					 $("#imgfoto").html('<a href="" class="attach-subs subs profile_btn">delete</a>');
					 $("#loading").html('');
				}	
			});
		});     
	  <!--File 1-->  
		$('.img1_validate').on('click', function(e)
		{
			e.preventDefault();
				$(this).ajaxSubmit({success:function(data)
				{ 
					$("#imgfoto").html('');
					var img_path = '<?php echo base_url();?>uploads/photos/'+data;
					$("#imgTab2").html('<img src="'+img_path+'" class="profile_img" width="158">');
				}	
	
			});
	 });
	 <!--File 1--> 	
});


</script>
		 
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
