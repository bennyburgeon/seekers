<style>

    td.test {
    width:730px;
    padding: 0 5px 0 0;
    margin: 0;
    border: 0;
    }
   
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<section class="bot-sep">
    <div class="section-wrap">
        <div class="row">
        	<div class="col-sm-12 pages"><span>Home</span> / <span><?php echo $page_head;?></span></div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?></h3></div>
					<?php if(validation_errors()!=''){?> 
                    <div class="alert alert-success alert-danger">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong><?php echo validation_errors(); ?></strong>
                    </div>
                    <?php } ?>
                     
                    <div id ="step1">
                    <div class="table-tech specs hor">
                            <table class="hori-form">
                                <tbody>
                                    <form class="form-horizontal form-bordered"  method="post" id="candidate_form" name="candidate_form" action="<?php echo $this->config->site_url();?>candidates_apps/addCandidate"> 
                                    
                                    
                        <input type="hidden"  name="linkedin_url" value="" >
                        <input type="hidden" name="facebook_url" value="">		                         
                        <input type="hidden" name="last_name" value="">
                                            
                                            
                                        <tr>
                                            <td>Title</td>
                                            <td> <?php 
												$options = array(
												'1'  => 'Mr.',
												'3'  => 'Mis.',
												'4'  => 'Miss.',
												'2'  => 'Mrs');
												echo form_dropdown('title', $options, $formdata['title']);
												?>  
                                             </td>
                                        </tr>
                                        
                                        <tr>
                                            <td>Full Name</td>
                                            <td><input class="form-control hori" type="text" name="first_name" value="<?php echo $formdata['first_name'];?>" 
                                            id="first_name" placeholder="Enter your Full Name"></td>
                                        </tr>
                                     </tr>
                                        
                                        <tr>
                                        	<td>Email/Username</td>
                                            <td><input class="form-control hori " type="text" name="username"  value="" 
                                            id="username" placeholder="Enter your Email"><a href="javascript:;" id="check_email" onclick="return check_email();">Check Availabiltiy</a>&nbsp;&nbsp;&nbsp;<span id="check_msg"></span></td>
                                            
                                        </tr>
                                        
                                        <tr>
                                            <td>Password</td>
                                            <td><input class="form-control hori" type="password" name="password" value="" id="password" placeholder="">
                                            </td>
                                        </tr>
                                       
                                        <?php /*?><tr>
											<td>Confirm Password</td>
											<td><input class="form-control hori " type="password" name="cpassword" value="<?php echo $formdata['cpassword'];?>" 
											id="cpassword" placeholder="Enter your Confirm Password">
											</td>
                                        </tr><?php */?>
                                        
                                        <tr>
                                            <td>Gender</td>
                                            <td> 
												<?php 
                                                $data = array(
                                                'name'        => 'gender',
                                                'id'          => 'gender',
                                                'value'       => '1',
                                                'checked'     => '1',
                                                'style'       => 'margin:10px',
                                                );
                                                if($formdata['gender']=='1') $data['checked']='TRUE';
                                                echo form_radio($data).'Male';
                                                $data = array(
                                                'name'        => 'gender',
                                                'id'          => 'gender',
                                                'value'       => '0',
                                                'checked'     => '',
                                                'style'       => 'margin:10px',
                                                );
                                                if($formdata['gender']=='0') $data['checked']='TRUE';
                                                echo form_radio($data).'Female';
                                                ?> 
                                             </td>	
                                        </tr>
                                        
                                        <tr>
                                            <td>Marital Status</td>                                        
                                            <td> 
                                            <?php 
                                            $data = array(
                                            'name'        => 'marital_status',
                                            'id'          => 'marital_status',
                                            'value'       => '1',
                                            'checked'     => '',
                                            'style'       => 'margin:10px',
                                            );
                                            if($formdata['marital_status']=='1') $data['checked']='TRUE';
                                            echo form_radio($data).'Married';
                                            $data = array(
                                            'name'        => 'marital_status',
                                            'id'          => 'marital_status',
                                            'value'       => '6',
                                            'checked'     => '',
                                            'style'       => 'margin:10px',
                                            );
                                            if($formdata['marital_status']=='6') $data['checked']='TRUE';
                                            echo form_radio($data).'Single';
                                            ?> </td>	
                                        </tr>
                                        
                                        <tr>
                                            <td>Mobile Phone</td>
                                            <td><input type="hidden" name="mobile_prefix" value="" id="mobile_prefix">
                                            <input style="width:200px;"  type="text"  name="mobile" maxlength="13" placeholder="Mobile Phone" 
                                            value="<?php echo $formdata['mobile'];?>" id="mobile"></td>
                                        </tr>
                                        
                                        
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" 
                                            value="<?php echo $formdata['date_of_birth'];?>" placeholder="Enter your DOB"></td>
                                        </tr>

	
                                      <tr>
                                        <td>Salary &amp; Experience</td>
                                          <td><table width="100%" border="0">
                                            <tbody>
                                              <tr>
                                              <td>Cur CTC</td>
                                                <td>
<input class="form-control hori" style="width:100px;" type="text" name="current_ctc" value="<?php echo $formdata['current_ctc'];?>" placeholder="Cur. CTC">
</td>
 <td>Exp. CTC</td>
                                                <td><input class="form-control hori" style="width:100px;" type="text" name="expected_ctc" value="<?php echo $formdata['expected_ctc'];?>" placeholder="Exp. CTC"></td>
                                                 <td>Notice</td>
                                                <td><input class="form-control hori" style="width:100px;" type="text" name="notice_period" value="<?php echo $formdata['notice_period'];?>" placeholder="Notice"></td>
                                                 <td>Total Exp.</td>
                                                <td><input class="form-control hori" style="width:100px;" type="text" name="total_experience" value="<?php echo $formdata['total_experience'];?>" placeholder="Total Exp."></td>
                                              </tr>
                                            </tbody>
                                          </table></td>
                                      </tr>

				

				<tr>
                    <td>Select Any Job</td>
                     <td>	
                 <?php  echo form_dropdown('job_id',  $all_jobs_list, '','class="form-control" id="job_id" style="width:400px;"');?>
                     </td>
                </tr>
                
				 <tr>
                    <td>Profile Status</td>
                     <td>	
                   <?php echo form_dropdown('reg_status',  $reg_status_list, $formdata['reg_status'],'class="form-control " id="reg_status" style="width:150px"');?>
                     </td>
                </tr>
                

             <tr>
               <td>Present Location</td>
               <td><?php echo form_dropdown('city_id', $city_list, $formdata['city_id'],'class="js-example-basic-single" id="city_id"');?></td>
             </tr>
             
             <tr>
               <td>Preferred Locations</td>
               <td><?php echo form_dropdown('pref_city_id[]', $city_list, $formdata['pref_city_id'],'class="js-example-basic-single" id="pref_city_id" multiple="multiple" style="height:300px;"');?></td>
             </tr>
             
            <tr>                
            <td>Industry</td>
            <td>	
            <?php echo form_dropdown('job_cat_id', $industry_list, $formdata['job_cat_id'],'class="js-example-basic-single" id="job_cat_id"');?>
            </td>
            </tr>
                
                
            <tr>
            <td>Function/Department</td>
            <td>	
            <?php echo form_dropdown('func_id', $department_list, $formdata['func_id'],'class="js-example-basic-single" id="func_id"');?>
            </td>
            </tr>
                

                <tr>
                  <td>Role/Designation</td>
 				<td>
                	<?php echo form_dropdown('desig_id', $roles_list, $formdata['desig_id'],'class="js-example-basic-single" id="desig_id"');?>               </td>
 				</tr>
                
                <tr>
                
                    <td>Job Folder</td>
                     <td>	
                   <?php echo form_dropdown('job_folder_id', $job_folders, $formdata['job_folder_id'],'class="js-example-basic-single" id="job_folder_id"');?>
                     </td>
                </tr>
            
                <tr>
                   <td>Present Job Status</td>
                   <td>
                   <?php echo form_dropdown('cur_job_status', $job_status, $formdata['cur_job_status'],'class="js-example-basic-single" id="cur_job_status"  id="country_id" ');?>
                    </td>
                 </tr>
                            <!--       
                                       
<tr>
                    <td>Lead Source</td>
                    <td>
 <input id="lead_source" type="radio" name="lead_source" value="1"  <?php if($formdata['lead_source']==1)echo 'checked="checked"';?> />
  Recruiter 
                    &nbsp;
                    <input type="radio" name="lead_source" value="2" id="lead_source"  <?php if($formdata['lead_source']==2)echo 'checked="checked"';?>/>
                    Online/Web/Social &nbsp;&nbsp;
                    <input id="lead_source" type="radio" value="3" name="lead_source"   <?php if($formdata['lead_source']==3)echo 
                    'checked="checked"';?>  />
                    Vendor &nbsp;&nbsp;
                    <input type="radio" name="lead_source" value="4" id="lead_source" <?php if($formdata['lead_source']==4)echo 'checked="checked"';?> />
                    Mobile&nbsp;&nbsp; 
                    <input type="radio" name="lead_source" value="5" id="lead_source" <?php if($formdata['lead_source']==5)echo 'checked="checked"';?> />
                    No Idea! </td>
                </tr>
-->                                                        
                                         <tr>
                                            <td>Upload Candidate CV</td>
                                            <td> 
                                            <?php echo form_upload(array('name'=>'cv_file','class'=>'form-data'));?>
                                            </td>
                                            
                                        </tr>

										<tr>
                                            <td>Upload Client CV</td>
                                            <td> 
                                            <?php echo form_upload(array('name'=>'client_cv_file','class'=>'form-data'));?>
                                            </td>
                                            
                                        </tr>

										<tr>
                                            <td>Upload Photo</td>
                                            <td> 
                                            <?php echo form_upload(array('name'=>'photo','class'=>'form-data'));?>
                                            </td>
                                        </tr>
                                                                                                                        
                                        <tr>
                                            <td colspan="2">
                                            <span class="click-icons">
                                            <input type="submit" class="attach-subs" value="Save & Continue" id="save_candidate" style="width:180px;" 
                                            data-url="<?php echo $this->config->site_url();?>candidates_apps/addCandidate" />
                                            <a href="<?php echo $this->config->site_url();?>candidates_apps" class="attach-subs subs">Back</a></span></td>
                                            
                                            </span>
                                            </td>
                                       </tr>
                                    </form>
                                </tbody>
                            </table>
                    	<div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <!-- form ends here-->
    
    <!-- centercontent -->
    
</div><!--bodywrapper-->
<script>
function check_email()
{
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		var email=$('#username').val();					
		if($('#username').val()=='')
		{
			alert('Enter username');
			$('#username').focus();
			return false;
		}

		if(!pattern.test($('#username').val())){
			alert('Enter valid email');
			$('#username').focus();
			return false;
		}

		
			$.ajax({
				type: "post",
				url: "<?php echo $this->config->site_url();?>candidates_apps/check_email",
				cache: false,				
				data: {email:$('#username').val()},
				success: function(data){ 
					try{		
						var ret = jQuery.parseJSON(data);
						$('#check_msg').attr('style', ''); 
		   				$('#check_msg').hide();
						if(ret['STATUS']==0) 
						{
//doesnt;exist
							
                            $('#check_msg').html('<i>Email address not exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
			   				$('#check_msg').show();
                            
						}else if(ret['STATUS']==1)
						{
                            $('#check_msg').html('<i>Email address already exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
			   				$('#check_msg').show();
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
}

var userFlag = 0;
$( document ).ready(function() {
	$('#datepicker').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"
	});
	$('#datepicker1').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"

	});
	$('#datepicker2').datepicker({
		dateFormat: "yy-mm-dd",
				changeMonth: true,
      changeYear: true,
	  yearRange: "c-50:c+1"

	});


   
   
   
   


//END CHECK EMAIL

   function candidate_validate() {
		
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   
 
 		var name_check=getValidName($('#first_name').val());
		if(name_check==false)
		{
			alert('Please enter valid name');
			$('#first_name').focus();
			return false;
		}
		
		if($('#username').val()=='')
		{
			alert('Enter username');
			$('#username').focus();
			return false;
		}
		
		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		if(!pattern.test($('#username').val())){
			alert('Enter valid email');
			$('#username').focus();
			return false;
		}
		
		if($('#mobile').val()=='')
		{
			alert('Enter mobile');
			$('#mobile').focus();
			return false;
		}	
		
		var mobile_check=getValidNumber($('#mobile').val());
		if(mobile_check==false)
		{
			alert('Please enter valid mobile number');
			$('#mobile').focus();
			return false;
		}
		
	    return true;
    }



function getValidName(value)
	{
		var a = value;
		var filter = /^[a-z .-]+$/i;
		
		if (filter.test(a)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
function getValidNumber(value)
	{
		var a = value;
		var filter = /^[0-9-+]+$/;
		
		if (filter.test(a)) 
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
		
   $('#candidate_form').submit(function(evt){
		evt.preventDefault(); 
		var dataStringprop = $("#candidate_form").serialize();
		var $this = $(this);
		var $url =$('#save_candidate').data('url');       
     	var formData = new FormData(this);
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$.ajax({
				type: "post",
				url: $url,
				data:formData,
				cache:false,
				contentType: false,
				processData: false,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						$('#hdstep1').val(ret['SUCCESS_ID']);
						if(ret['STATUS']==1) 
						{

							var id = ret['SUCCESS_ID'];
                            
                            window.location.href = "<?php echo site_url('candidates_apps/summary'); ?>" +'/'+ id;

						}else if(ret['STATUS']==2)
						{
							alert('Email address already exist, please change and save again.');
							return;
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
		} //end contact valid
   });//end button click function save*/


    var now = new Date();
    var month = (now.getMonth() + 1);               
    var day = now.getDate();
    if(month < 10) 
        month = "0" + month;
    if(day < 10) 
        day = "0" + day;
    var today = now.getFullYear() + '-' + month + '-' + day;
    $('#password').val(today);


});   // end document.ready



</script>