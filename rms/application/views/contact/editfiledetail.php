<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>

<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/contact/editfiles" enctype="multipart/form-data"> 
<table class="hori-form">
<tbody>

<?php 

		 foreach($survey_result as $key => $val)
		 {
?>		 
<tr>
  <td>
<?php 
			echo $val['question_title'];
?>
</td>
 <td>
<?php 			
			foreach($val['answer'] as $answer_id => $answer_val)
			{
				if($survey_result[$key]['answer_value']!='' && $answer_val==$survey_result[$key]['answer_value'])
					echo '<input type="radio" name="qt_'.$val['question_id'].'" id="radio" value="'.$answer_val.'" checked="checked" />'.$answer_val;
				else
					echo '<input type="radio" name="qt_'.$val['question_id'].'" id="radio" value="'.$answer_val.'"/>'.$answer_val;
			}
?>
</td>
<?php } ?>
</tr>

<tr>
<td>Upload your CV</td>
 <td> 
 <?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?>
 </td>
</tr>
<tr>
<td>Upload your Photo</td>
 <td> 
 <?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?>
                                                        
 </td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Update & Done" id=""  style="width:180px;">
<input type="button" class="attach-subs subs" value="Back" id="step_back">
<a href="<?php echo $this->config->site_url();?>/contact" class="attach-subs subs">Skip</a>
<a href="<?php echo $this->config->site_url();?>/contact" class="attach-subs subs">Done</a>
</span>
</td>
</tr>
</tbody>
</table>
<input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id"></div>
<div id="success"></div>
</form>
<div style="clear:both;"></div>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script>

$('#candidate_form5').on('submit', function(e){
		e.preventDefault();
		//$("#preview").html('<img src="'+img_path+'" alt="Uploading...."/>');
		$(this).ajaxSubmit({success:function(data){ 
			
			if(($.trim(data)=='Add title')||($.trim(data) == 'Invalid file format')||($.trim(data) == 'Choose file')||($.trim(data) == 'Image file size max 1 MB')||($.trim(data) == 'failed')){
				alert(data);
			}
			else{
				//var img_path = '<?php echo base_url();?>assets/images/loader.gif';
				//$("#loading").html('<img src="'+img_path+'" alt="Uploading...." width="30" height="30"/>');
				$('#success').html('successfully uploaded');
				window.location.href = '<?php echo $this->config->site_url();?>/contact/';
			}	
		}
		});
});

$('#step_back').click(function(){

var candidateId = '<?php echo $candidate_id; ?>';
var dataStringprop = $("#candidate_form").serialize();
	$.ajax({
				type: "post",
				url: "<?php echo site_url('contact/step_back'); ?>"+'/'+candidateId,
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						$('#hdstep1').val(ret['SUCCESS_ID']);
						if(ret['STATUS']==1) {
							var img_path = '<?php echo base_url();?>assets/images/loader.gif';
							$("#step1").html('<img src="'+img_path+'" alt="Uploading...."/>');
							var id = ret['SUCCESS_ID'];
                            var site_url = "<?php echo site_url('contact/loadEditJobhtml'); ?>" +'/'+ id;
                            $("#step1").load(site_url, function() {
                                //alert("success step2");
                            });
						}
					}
					catch(e) {		
						alert('Exception occured while adding contact.');
					}		
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
				}

			});//end ajax

});

</script>
