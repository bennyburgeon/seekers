<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
    <div id ="step2">
        <div class="table-tech specs hor">
        
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" 
            action="<?php echo $this->config->site_url();?>/candidates_all/addfiles/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 
           
                <table class="hori-form">
                    <tbody>
                    
                        <tr>
                            <td>Do you have any family members in Australia ?</td>
                            <td><input type="radio" name="qt_1" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_1" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        
                        <tr>
                            <td>Do you have any immediate family members in your home country ?</td>
                            <td><input type="radio" name="qt_2" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_2" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                       
                        <tr>
                            <td>Have you ever held a VISA to travel to Australia or any other country?</td>
                            <td><input type="radio" name="qt_3" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_3" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        <tr>
                            <td>Have you ever been refused an entry permit or visa to Australia or any other country?</td>
                            <td><input type="radio" name="qt_4" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_4" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        <tr>
                            <td>Have you ever  had a visa cancelled in Australia or overseas ?</td>
                            <td><input type="radio" name="qt_5" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_5" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        <tr>
                            <td>Have you ever  been Removed or Deported from Australia or overseas?</td>
                            <td><input type="radio" name="qt_6" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_6" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        <tr>
                            <td>Are you intending to bring a partner or any children into Australia?</td>
                            <td><input type="radio" name="qt_7" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_7" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Have they ever held a visa to travel to Australia?</td>
                            <td><input type="radio" name="qt_8" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_8" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Have they even been refused a visa into Australia?</td>
                            <td><input type="radio" name="qt_9" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_9" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Have they ever had a visa cancelled in Australia or overseas?</td>
                            <td><input type="radio" name="qt_10" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_10" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Have they ever been removed or deported from Australia or overseas?</td>
                            <td><input type="radio" name="qt_11" id="radio" value="No" />
                            No 
                            <input type="radio" name="qt_11" id="radio2" value="Yes" />
                            Yes</td>
                        </tr>
                        
                        
                        <tr>
                            <td>Upload your CV</td>
                            <td> 
                            <?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?> </td>
                        </tr>
                       
                        <tr>
                            <td>Upload your Photo</td>
                            <td> 
                            <?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?> </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                            <span class="click-icons">
                            <input type="submit" class="attach-subs" value="Save & Done" id="save_candidate2"  style="width:180px;">
                            <a href="<?php echo $this->config->site_url();?>/candidates_all/summary/<?php echo $candidate_id;?>" class="attach-subs subs">Done</a></span></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="candidate_id" value="<?php echo $candidate_id;?>" name="candidate_id"></div>
                <div id="success"></div>
            </form>
        	<div style="clear:both;"></div>
        </div>
    </div>
<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script>

$('#candidate_form5').on('submit', function(e){
var candidateId = '<?php echo $candidate_id ?>';
		e.preventDefault();
		//$("#preview").html('<img src="'+img_path+'" alt="Uploading...."/>');
		$(this).ajaxSubmit({success:function(data){ 
			
			if(($.trim(data)=='Choose cv file')||($.trim(data) == 'Choose photo')||($.trim(data) == 'Choose file')||($.trim(data) == 'Image file size max 1 MB')||($.trim(data) == 'failed')){
				alert(data);
			}
			else{
				//var img_path = '<?php echo base_url();?>assets/images/loader.gif';
				//$("#loading").html('<img src="'+img_path+'" alt="Uploading...." width="30" height="30"/>');
				$('#success').html('successfully uploaded');
				//$("#step1").html(data);
				window.location.href = '<?php echo $this->config->site_url();?>/candidates_all/summary/<?php echo $candidate_id;?>';
			}	
		}
		});
});
</script>
