
<div class="col-md-9">
<div class="profile_top">
<div class="profile_top_left">Manage Files</div>

<div style="clear:both;"></div>
</div>

<div class="profile_bottom" id="leads">
<div class="tasks profile">

<div id="response"></div>
<?php 
 foreach($file_list as $cv_fileist1){?>
<div class="slider_redesign" id="tr_<?php echo $cv_fileist1['file_id'];?>" >

<div class="side_adj second">

<h2><?php echo $cv_fileist1['file_name'];?></h2>
<div class="date_edit">
<span class="dates"><?php echo $cv_fileist1['upload_date'];?> | <a href="<?php echo base_url('uploads/photos/');?>/<?php echo $cv_fileist1['file_type'];?>" target="_blank">Download </a></span>
<span class="edit_delete">
<img src="<?php echo base_url('assets/images/profile_delete.png');?>" id="<?php echo $cv_fileist1['file_id'];?>" onClick="return validate(this.id)" >

</span>

</div>
</div>
</div>
<?php }?>


</div>
</div>

<div class="notes">
<ul>
<li id="tab_2btn">Upload File</li>


</ul>

   
	<!--Followup-->

    <div class="table-tech specs note">
    <div class="new_notes">
    <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
    -->
    <p id="result"></p>
    <p id="deletemessage"></p>

    <?php echo $error;?>

    <form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>candidates_all/candidate_file/<?php echo $candidate_id;?>'  onsubmit="return check_title();">
    <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>"/>

    <h3>FIle Name:</h3>
    <input type="text" name="title" id="title" class="text_box">
    <table class="hori-form">
    <tbody>
    <tr>
    <td>File Upload</td>
    <td>
        <input type="file" class="upload" name="photo" id="photo"/>
    </td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit"  class="attach-subs" value="Upload" id="upload_but"/>

    </span>
    </td>
    </tr>
    </tbody>
    </table>
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

function check_title() 
{
	if($('#title').val()=='')
	{
		alert('Please add a name for the file.');
		$('#title').focus();
		return false;
	}
	 return true;
}

function validate(file_id)
{
		if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+file_id;
		$.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/deletefile'); ?>',
        data:{ 
        file_id:file_id,
        },
        success: function(msg) {
		$("#result").html('');
        $(row).fadeOut("slow");
	   $("#deletemessage").html('<div class="alert alert-danger"><strong>Success!</strong> The data has been Deleted.</div>');

        }
        });//end Ajax
		}
		}
         <!--Followup-->


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
