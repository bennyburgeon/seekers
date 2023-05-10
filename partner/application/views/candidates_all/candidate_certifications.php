<div class="col-md-9">
    <div class="notes">
        <ul>
        <li id="tab_2btn">Certifications</li>
        
        
        </ul>
        
    
        <!--Followup-->
        
        <div class="table-tech specs note">
        <div class="new_notes">
        <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
        -->
        <p id="result"></p>
        <p id="deletemessage"></p>
        
        <?php echo $error;?>
        
            <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" 
            action="<?php echo $this->config->site_url();?>candidates_all/certifications/<?php echo $candidate_id;?>" enctype="multipart/form-data"> 
            
                <table class="hori-form">
                    <tbody>
                        <tr>
                        <?php 
                        $i=0;
                        foreach($certifications_list as $key => $val)
                        {
                        $i+=1;
                        $j=$i%3;
                        ?>
                        
                            <td><input type="checkbox" name="certifications[]" value="<?php echo $key?>" 
                            <?php if(in_array($key,$certifications_list_current))echo 'checked="checked"';?> /></td>
                            
                            <td><?php echo $val['cert_name'];?></td>
                        <?php if($j==0)echo '</tr><tr>';?>
                        <?php } ?>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                            <span class="click-icons">
                            <input type="submit" class="attach-subs" value="Update" id=""  style="width:180px;">
                            </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            	<input type="hidden" id="" value="<?php echo $candidate_id;?>" name="candidate_id"></div>
            	<div id="success"></div>
            </form>
        </div>
    
    
    <div style="clear:both;"></div>
</div>

	<!--Followup-->
<script src="<?php echo base_url('scripts/jquery.form.js');?>"></script>

<script language="javascript">
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


<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
