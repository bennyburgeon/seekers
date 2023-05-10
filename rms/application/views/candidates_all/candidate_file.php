<section class="bot-sep">
<div class="section-wrap">
<div class="row">

<style>
.preview
{
width:200px;
border:solid 1px #dedede;
padding:10px;
}
#preview
{
color:#cc0000;
font-size:12px
}
</style>
<div id="loading"></div>

<div style="width:600px">
<form id="imageform" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/savefile'>
<table class="hori-form">
    <tbody>
        
        	<tr>
            <td>Enter a Title</td>
            <td><input type="text" name="title" id="title"/></td>
        </tr>
        <tr>
			<td>Upload Your File</td>
            <td> <input type="file" name="photo" id="photo" /></td>
            <td> <input type="hidden" name="candidate_id" value="<?php echo $candidate_id;?>" /></td>
        </tr>    
		<tr>
        	<td><input type="submit" class="finish btn btn-info" value="Upload" id="upload_but"/></td>
        </tr>    
	</tbody>
</table>

<div id='success'></div>
</form><br/>
<div id='preview'>

<table class="tool-table new" >

	<thead>
		<tr>
            <th>Tilte</th>
            <th>Action</th>
		</tr>
    </thead>  
        <tbody>
<p id="imgTab"></p>
    <?php if(count($file_list)>0){
		foreach ($file_list as $files){
		?>
			<tr id="tr_<?php echo $files['file_id'];?>">
            <td><?php echo $files['file_name'];?></td>
			<td>
			<a href="javascript:void(0)" onclick="return validate_del(this.id)" class="btn btn-danger btn-xs" id="<?php  echo $files['file_id'];?>"> <i class="fa fa-trash-o"></i>Delete</a>
			</td>
			</tr>
		 <?php  
		 }  
	 }else{?>
         <tr id="no_data">
          <td colspan="8" align="center">
           No Records Found!!
          </td>
         </tr>
     <?php } ?>
     </tbody>
</table>

</div>
<div id="loading"></div>
</div>
</section>
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script>

$('#imageform').on('submit', function(e){
		e.preventDefault();
		$(this).ajaxSubmit({success:function(data){ 
			
			if(($.trim(data)=='Enter Your Title')||($.trim(data) == 'Invalid file format')||($.trim(data) == 'Choose file')||($.trim(data) == 'Image file size max 1 MB')||($.trim(data) == 'failed')){
				alert(data);
			}
			else{
				var img_path = '<?php echo base_url();?>assets/images/loader.gif';
				$("#loading").html('<img src="'+img_path+'" alt="Uploading...." width="30" height="30"/>');
				$("#no_data").remove();
				$("#imgTab").last().append(data);
				$('#success').html('<div class="alert alert-success"> Successfully Added</div>');
				$('#title').val('');
				$("#loading").html('');
			}	
		}
		});
});
function validate_del(id){
	if(confirm('Are you sure you want to delete?')){
		var row = "#tr_"+id;
		$.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates_all/deletefile'); ?>',
        data:{ 
        id:id,
        },
        success: function(msg) {
				var img_path = '<?php echo base_url();?>assets/images/loader.gif';
				$("#loading").html('<img src="'+img_path+'" alt="Uploading...." width="30" height="30"/>');
		$("#success").html('');
		$('#success').html('successfully deleted');
		$('input[type="text"],textarea').val('');
        $(row).fadeOut("slow");
		$("#deletemessage").html('<div class="alert alert-success">Record Deleted</div>');
		
        }
        });//end Ajax
		
	}
	else{
	}
}


</script>
