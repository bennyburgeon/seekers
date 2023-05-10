<table width="300" border="1">
<tbody>
<tr id="tr_<?php echo $single_file['file_id'];?>"><td>
File Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $single_file['file_name'];?></td>
<td><input type="button" id="<?php echo $single_file['file_id'];?>" onClick="return validate(this.id)" value="Delete"></td>
</tr>
</tbody>
</table>





<script type="text/javascript">
	
        function validate(file_id){
	    if(confirm('Are you sure you want to delete?')){
	    var row = "#tr_"+file_id;
		
		$.ajax({
        type:"POST",
        url: '<?php echo site_url('candidates/deletefile'); ?>',
        data:{ 
        id:file_id,
        },
        success: function(msg) {
		$("#result4").html('');
        $(row).fadeOut("slow");
		$("#deletemessage4").html('<div class="alert alert-success">Record Deleted</div>');

        }
        });//end Ajax
		}
		}
        </script>