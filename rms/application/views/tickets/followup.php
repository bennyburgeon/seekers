<link rel="stylesheet" href="<?php echo base_url();?>/assets/css/min.css">
<link href="http://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.4.33/example1/colorbox.min.css" rel="stylesheet"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script src="<?php echo base_url();?>/assets/css/jquery.colorbox-min.js"></script>
<div class="sidebar-area inner-page">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box2 boxs sides">
<p>Enter your personal details below:</p>
<input type="text" class="form-control pro" placeholder="Full Name">
<input type="text" class="form-control pro" placeholder="Email">
<input type="text" class="form-control pro" placeholder="Address">
<input type="text" class="form-control pro" placeholder="City/Town">
<select class="form-control pro">
<option value="">Country</option>
<option value="">Afghanistan</option>
<option value="">Albania</option>
</select>
<input type="text" class="form-control pro" placeholder="Username">
<input type="password" class="form-control pro" placeholder="password">
<input type="password" class="form-control pro" placeholder="Re-type Your Password">
<a href="#" class="attach-subs prof">Submit</a>
<div style="clear:both;"></div>
</div>
</div>
</div>

<!-- END PAGE HEADER-->

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

<div class="alert alert-error">
<button class="close" data-dismiss="alert">×</button>
<strong>record deleted..</strong>
</div>
<?php } ?>  



<section class="bot-sep">
	<div class="section-wrap">
		<a href="<?php echo $this->config->site_url()?>/tickets/add" class="support">New Support Request</a>
		<div style="clear:both;"></div>
		<div class="row">
			<div class="col-sm-12 pages"><a href="<?php echo $this->config->site_url()?>/tickets">Tickets</a>/ <span>Followup Tickets</span>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-8.png');?>" alt=""/><h3>Ticket <span class="form-horizontal">
			</span>Details</h3>
			</div>
			<div class="table-tech tic">
                <table class="ticket" id="comment">
                <tbody>
                <?php 
                foreach($followup_list as $followup){
                ?>
                
                <tr id="tm_<?php echo $followup['tkt_fp_id'] ?>" >
                <td class="ticket-border"><span class="bd-font">Title:</span><?php echo $followup['title'] ?><br /><span class="bd-font">Date:</span><?php echo $followup['tkt_fp_date'] ?></td>
                <td><span class="bd-font">Message:</span><p><?php echo $followup['tkt_fp_description'] ?></p></td>
                <td><input type="button" id="<?php echo $followup['tkt_fp_id'] ?>" onClick="del(this.id)" value="Delete"></td>
                
                </tr>
                <?php 
                }
                ?>
                
                
                <tr>
                <td class="ticket-border"><?php echo $logged_user_details['firstname'].' '.$logged_user_details['lastname'];?> <br><?php echo $logged_user_details['email'];?></td>
                <td>
                <span class="bd-font">Add Followup :</span>
                <form action="<?php echo $this->config->site_url()?>/tickets/addfllowup/<?php echo $row_ticket['ticket_id'];?>" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmadd" name="frmadd" >
                <span class="bd-font">Title</span>
                <br>
                <input type="text" id="title" name="title" value=""  placeholder="Enter Title" class="form-control" />
                <span class="bd-font">Description</span>
                <textarea class="form-control horizon" name="description" rows="6" id="description"></textarea>
                <span class="bd-font">Status</span><br>
                <?php echo form_dropdown('status',  $tickets_status_list,'','id="status"  class="table-group-action-input form-control input-medium"');?>
                <span class="bd-font">Date</span><br>
                <input type="text" id="date" name="date" data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" size="16" class="form-control date-picker">
                 <input name="tkt_fp_id" type="hidden" id="tkt_fp_id" value="0" />
                 <span class="bd-font">Send Email</span><br>
                 <div class="checkbox tic-kt"><input name="followup_mail" type="checkbox" id="send_mail" value="1" /></div>
                <br class="at-appear">
                			  <input type="submit" class="attach sub" id="exampleInputPassword2" value="submit" />

                </form>
                </td>
                <td></td>
                </tr>
                </tbody>
                </table>

			<div style="clear:both;"></div>
		</div>
	</div>
</div>
</div>
</section>
<script>
$(document).ready(function()
{
	$('#date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
		function followup_validate()
		 {
			
			if($('#title').val()=='')
			{
				alert('Please title');
				$('#title').focus();
				return false;
			}
			if($('#description').val()=='')
			{
				alert('Please description');
				$('#description').focus();
				return false;
			}
			if($('#status').val()=='')
			{
				alert('Please select status');
				$('#status').focus();
				return false;
			}	
			return true;
      }
		
       $("#frmadd").submit(function (e){
        e.preventDefault();
		var url = $(this).attr('action');
        var title=$('#title').val();
        var description=$('#description').val();
        var status=$('#status').val();
		var date=$('#date').val();
		var tkt_fp_id=$('#tkt_fp_id').val();
		var isTicketValid = followup_validate();
		if(isTicketValid) {
        $.ajax({
        type:"POST",
        url: url,
        data:{ title:title,
		description:description,
		status:status,
		date:date,
		tkt_fp_id:tkt_fp_id},	
        success: function(msg) {
		$("#deletemessage").html('');
        //$("#response").append(msg);
		//$("#comment").last().append(msg);
		$('#comment tr:last').before(msg);
		$("#result").html('<div class="alert alert-success"> Successfully Added</div>');
		<!--Text field empty-->
$('#title').val('');
		$('#description').val('');        }
        });//end Ajax
		}//end Validation
        });//end button click 
        
});	
function del(id){
		if(confirm('Are you sure you want to delete?')){
		var row = "#tm_"+id;
		 $.ajax({
        type:"POST",
        url: '<?php echo $this->config->site_url()?>/tickets/delfllowup',
        data:{ 
        tkt_fp_id:id,
        },
        success: function(msg) {
		$("#result").html('');
		$('#title').val('');
		$('#description').val('');
        $(row).fadeOut("slow");
		$("#deletemessage").html('<div class="alert alert-success"> Successfully Deleted</div>');
        }
        });//end Ajax
		}
		}
</script>		