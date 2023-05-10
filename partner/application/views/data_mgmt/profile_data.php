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
  <form class="form-horizontal form-bordered"  method="post" id="candidate_form" name="candidate_form" > 
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
<td><input class="form-control hori" type="text" name="first_name" value="<?php echo $formdata['first_name'];?>" id="first_name" placeholder="Enter your First name"></td>
</tr>
<tr>
<td>Last name</td>
<td><input class="form-control hori fo-icon-1" type="text" name="last_name" value="<?php echo $formdata['last_name'];?>" id="last_name" placeholder="Enter your Last name"></td>
</tr>
<tr>
<td>Email</td>
<td><input class="form-control hori " type="text" name="username" value="<?php echo $formdata['username'];?>" id="username" placeholder="Enter your Email"></td>
</tr>
<tr>
<td>Password</td>
<td><input class="form-control hori " type="password" name="password" value="<?php echo $formdata['password'];?>" id="password" placeholder="Enter your Password"></td>
</tr>
<tr>
<td>Confirm Password</td>
<td><input class="form-control hori " type="password" name="cpassword" value="<?php echo $formdata['cpassword'];?>" id="cpassword" placeholder="Enter your Confirm Password"></td>
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
        ?> </td>	
</tr>

<tr>
<td>Marital Status</td>
<td>

<table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td>Married</td>
    <td><input type="radio" name="marital_status" value="1" <?php if($formdata['marital_status']==1)echo 'checked="checked"';?>/></td>
    <td>Date of Marriage</td>
    <td><input type="text" name="marriage_date" readonly id="datepicker" value="" placeholder="yyyy-mm-dd" /> </td>
  </tr>

<tr>
    <td>Engaged</td>
    <td><input type="radio" name="marital_status" readonly value="2"  <?php if($formdata['marital_status']==2)echo 'checked="checked"';?> /></td>
    <td>Date of intented marriage</td>
    <td><input type="text" name="engaged_date" id="datepicker1" value="" placeholder="yyyy-mm-dd" /></td>
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
</table></td>
</tr>

<tr>
<td>Mobile Phone</td>
<td><input type="hidden" name="mobile_prefix" value="" id="mobile_prefix">
  <input style="width:200px;"  type="text"  name="mobile" maxlength="13" placeholder="Mobile Phone" value="<?php echo $formdata['mobile'];?>" id="mobile"></td>
</tr>


<tr>
<td>Date of Birth</td>
<td><input style="width:200px;" type="text" readonly name="date_of_birth" id="datepicker2" value="<?php echo $formdata['date_of_birth'];?>" placeholder="Enter your DoB"></td>
</tr>

<tr>
<td>Age</td>
<td><input style="width:100px;" type="text" name="age" maxlength="2" value="<?php echo $formdata['age'];?>" placeholder="Age"> [Just leave this if you enter a valid DoB, Age calculate automatically when save.]</td>
</tr>

<tr>
<td>No of children</td>
<td><input style="width:100px;" type="text" maxlength="2" name="children" value="<?php echo $formdata['children'];?>" placeholder="Children"></td>
</tr>



<tr>
  <td>Assign This Lead to - </td>
  <td><?php  echo form_dropdown('admin_id',  $admin_users_lists, $formdata['admin_id'],'class="form-control" id="admin_id"');?></td>
</tr>





<tr>
  <td>Lead Status</td>
  <td><input id="reg_status" type="radio" name="reg_status" value="1"  <?php if($formdata['reg_status']==1)echo 'checked="checked"';?>  />Leads &nbsp;<input type="radio" name="reg_status" value="2" id="reg_status"  <?php if($formdata['reg_status']==2)echo 'checked="checked"';?> />Registered &nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="3"  <?php if($formdata['reg_status']==3)echo 'checked="checked"';?>  />Closed &nbsp;&nbsp;<input type="radio" name="reg_status" value="4" id="reg_status"  <?php if($formdata['reg_status']==4)echo 'checked="checked"';?> />On Hold &nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="5"  <?php if($formdata['reg_status']==5)echo 'checked="checked"';?>  />Cancelled&nbsp;&nbsp;<input id="reg_status" type="radio" name="reg_status" value="6"  <?php if($formdata['reg_status']==6)echo 'checked="checked"';?>  />Migration</td>
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
<input type="button" class="attach-subs" value="Save & Continue" id="save_candidate" style="width:180px;">
</span></td>
</tr>
<tr>
<td>
<div class="right-btns">
<a href="<?php echo site_url('data_mgmt'); ?>" class="attach-subs tools"><img src="http://localhost/recruitment-hub/admin/assets/images/plus.png">Back to Listing</a>
</div>

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
/*
		if($('#password').val()=='')
		{
			alert('Enter password');
			$('#password').focus();
			return false;
		}   
		if($('#cpassword').val()=='')
		{
			alert('Enter confirm password');
			$('#cpassword').focus();
			return false;
		}
		if( $('#password').val()!=$('#cpassword').val())
		{
			alert('Did Not Matching For Change Password');
			$('#cpassword').focus();
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
		*/		
	    return true;
    }
   $('#save_candidate').click(function(){
		var dataStringprop = $("#candidate_form").serialize();
		var isContactValid = candidate_validate();
		if(isContactValid) {
			$.ajax({
				type: "post",
				url: "<?php echo site_url('data_mgmt/addCandidate'); ?>",
				cache: false,				
				data: dataStringprop,
				success: function(json){
					try{		
						var ret = jQuery.parseJSON(json);
						$('#hdstep1').val(ret['SUCCESS_ID']);
						if(ret['STATUS']==1) 
						{

							var id = ret['SUCCESS_ID'];
                            
                            window.location.href = "<?php echo site_url('data_mgmt/profile_entry'); ?>" +'/'+ id;

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
});   // end document.ready






</script>