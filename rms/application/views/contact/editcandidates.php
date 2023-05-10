<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
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
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form" name="candidate_form" > 
  <?php echo form_hidden('candidateId', $formdata['candidate_id']);?>
<tr>
<td>Title</td>
<td> <?php 
				   $options = array(
                  '1'  => 'Mr.',
				  '3'  => 'Mis.',
				  '4'  => 'Miss.',
                  '2'    => 'Mrs');
				   echo form_dropdown('title', $options, $formdata['title']);
				  ?>  </td>
</tr>
<tr>
<td>First name</td>
<td><input class="form-control hori" type="text" name="first_name" value="<?php echo $formdata['first_name'];?>" id="first_name"></td>
</tr>
<tr>
<td>Last name</td>
<td><input class="form-control hori fo-icon-1" type="text" name="last_name" value="<?php echo $formdata['last_name'];?>" id="last_name"></td>
</tr>
<tr>
<td>Email</td>
<td><input class="form-control hori " type="text" readonly name="username" value="<?php echo $formdata['username'];?>" id="username"></td>
</tr>
<tr>
<td>Gender</td>
 <td> 
		<?php 
            $data = array(
            'name'        => 'gender',
            'id'          => 'gender',
            'value'       => '1',
            'checked'     => '',
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

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>Married</td>
    <td><input type="radio" name="marital_status" value="1" <?php if($formdata['marital_status']==1)echo 'checked="checked"';?>/></td>
    <td>Date of Marriage</td>
    <td><input type="text" name="marriage_date" id="datepicker" value="<?php echo $formdata['marriage_date'];?>" readonly placeholder="yyyy-mm-dd" /> </td>
  </tr>

<tr>
    <td>Engaged</td>
    <td><input type="radio" name="marital_status" value="2"  <?php if($formdata['marital_status']==2)echo 'checked="checked"';?> /></td>
    <td>Date of intented marriage</td>
    <td><input type="text" name="engaged_date" id="datepicker1" value="<?php echo $formdata['engaged_date'];?>" readonly placeholder="yyyy-mm-dd" /></td>
  </tr>
  
<tr>
    <td>Separated</td>
    <td><input type="radio" name="marital_status" value="3"  <?php if($formdata['marital_status']==3)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  

<tr>
    <td>Divorced</td>
    <td><input type="radio" name="marital_status" value="4"  <?php if($formdata['marital_status']==4)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>

<tr>
    <td>Widowed</td>
    <td><input type="radio" name="marital_status" value="5"  <?php if($formdata['marital_status']==5)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
<tr>
    <td>Never Married</td>
    <td><input type="radio" name="marital_status" value="6"  <?php if($formdata['marital_status']==6)echo 'checked="checked"';?>/></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
       
</table>

</td>
</tr>



<tr>
<td>Mobile Phone</td>
<td><input type="hidden" name="mobile_prefix" value="" id="mobile_prefix">
  <input style="width:200px;" type="text" name="mobile" maxlength="13" value="<?php echo $formdata['mobile'];?>" id="mobile">
</td>
</tr>

<tr>
<td>Date of Birth</td>
<td><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" value="<?php echo $formdata['date_of_birth'];?>" placeholder="Enter your DoB"></td>
</tr>

<tr>
<td>Age</td>
<td><input style="width:100px;" type="text" maxlength="2" name="age" value="<?php echo $formdata['age'];?>" placeholder="Age">[Just leave this if you enter a valid DoB, Age calculate automatically when save.]</td>
</tr>

<tr>
<td>No of children</td>
<td><input style="width:100px;" type="text" maxlength="2" name="children" value="<?php echo $formdata['children'];?>" placeholder="Children"></td>
</tr>

<tr>
<td>Branch Office</td>
<td><?php echo form_dropdown('branch_id',  $branch_list, $formdata['branch_id'],'class="form-control" id="branch_id"');?></td>
</tr>

<tr>
<td>Level of Study</td>
<td><?php echo form_dropdown('level_study',  $level_list, $formdata['level_study'],'class="form-control" id="level_study"');?></td>
</tr>

<tr>
<td>Program Interested</td>
<td><?php echo form_dropdown('course_id',  $edu_course_list, $formdata['course_id'],'class="form-control" id="course_id"');?></td>
</tr>

<tr>
  <td>Lead Status</td>
  <td>

<input id="reg_status" type="radio" name="reg_status" value="0" <?php if($formdata['reg_status']==0)echo 'checked="checked"';?>  />New &nbsp;
<input id="reg_status" type="radio" name="reg_status" value="1" <?php if($formdata['reg_status']==1)echo 'checked="checked"';?>  />Need Call &nbsp;
<input type="radio" name="reg_status" value="2" id="reg_status" <?php if($formdata['reg_status']==2)echo 'checked="checked"';?>  />called &nbsp;
<input id="reg_status" type="radio" name="reg_status" value="3" <?php if($formdata['reg_status']==3)echo 'checked="checked"';?>  />Waiting Feedback &nbsp;
<input type="radio" name="reg_status" value="4" id="reg_status" <?php if($formdata['reg_status']==4)echo 'checked="checked"';?>  />Not Interested &nbsp;
<input id="reg_status" type="radio" name="reg_status" value="5" <?php if($formdata['reg_status']==5)echo 'checked="checked"';?>  />Registered&nbsp;
<input id="reg_status" type="radio" name="reg_status" value="6" <?php if($formdata['reg_status']==6)echo 'checked="checked"';?>  />Cancelled
  
  
  </td>
</tr>


<tr>
  <td>Lead Opportunity</td>
  <td><input id="lead_opportunity" type="radio" name="lead_opportunity" value="1"  <?php if($formdata['lead_opportunity']==1)echo 'checked="checked"';?>  />Cold &nbsp;<input type="radio" name="lead_opportunity" value="2" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==2)echo 'checked="checked"';?> />Warm &nbsp;&nbsp;<input id="lead_opportunity" type="radio" name="lead_opportunity" value="3"  <?php if($formdata['lead_opportunity']==3)echo 'checked="checked"';?>  />Hot &nbsp;&nbsp;<input type="radio" name="lead_opportunity" value="0" id="lead_opportunity"  <?php if($formdata['lead_opportunity']==0)echo 'checked="checked"';?> />Unknown&nbsp;</td>
</tr>

<tr>
<td>How did you come to know us?</td>
<td><input class="form-control hori " type="text" name="lead_source" value="<?php echo $formdata['lead_source'];?>" placeholder="Lead Source"></td>
</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="button" class="attach-subs" value="Update & Continue" id="edit_candidate" style="width:180px;"><input type="button" class="attach-subs subs" value="Skip" id="skip">
<!--<input type="button" class="attach-subs subs" value="Skip" id="skip">-->
<a href="<?php echo $this->config->site_url();?>/contact/summary/<?php echo $formdata['candidate_id'] ?>" class="attach-subs subs">Done</a>
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
   function candidate_validate() {
		
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
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
	    return true;
    }
   $('#edit_candidate').click(function(){
		var dataStringprop = $("#candidate_form").serialize();
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$.ajax({
				type: "post",
				url: "<?php echo site_url('contact/editCandidate'); ?>",
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
                            var site_url = "<?php echo site_url('contact/loadEditContacthtml'); ?>" +'/'+ id;
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
		} //end contact valid
   });//end button click function save*/
});   // end document.ready
$('#skip').click(function(){
var candidateId = '<?php echo $formdata['candidate_id'] ?>';
var dataStringprop = $("#candidate_form").serialize();
	$.ajax({
				type: "post",
				url: "<?php echo site_url('contact/skip_step2'); ?>"+'/'+candidateId,
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
                            var site_url = "<?php echo site_url('contact/loadEditContacthtml'); ?>" +'/'+ id;
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


// level study course filtering 

	$('#level_study').change(function() 
	{	
		jQuery('#course_id').html('');
		jQuery('#course_id').append('<option value="">Select Course</option');
			
		if($('#level_study').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/contact/getcourses/',
			  data: { level_study: $('#level_study').val(),int_val:2},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#course_id').html('');
					jQuery('#course_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#course_id').html('');
					  $.each(data.course_list, function (index, value) 
					  {
						  if(index=='')
							 jQuery('#course_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#course_id').append('<option value="'+ index +'">' + value + '</option');
					 });
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#course_id').html('');
					jQuery('#course_id').append('<option value="">Select Course</option');
			  }
			});	
	});
	
//
</script>