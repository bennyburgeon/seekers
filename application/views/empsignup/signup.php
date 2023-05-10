<div class="joblisting">
  <div class="container"> 

  <div>
  <!-- item1 -->         
  <div class="col-md-8 col-lg-8 col-sm-12 mx-auto">
  
   <form action="<?php echo $this->config->site_url();?>/empsignup" class="form-horizontal" enctype="multipart/form-data" method="post" id="loginForm" name="frmentry" onSubmit="return validate_empsignup()"  >
    <?php
			$length = 18;
$randomletter = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, $length);
//echo $randomletter;
			 ?>
    <input type="hidden" name="company_hash" value="<?php echo $randomletter; ?>"/>

    <h2>Employer Registration</h2>
    <?php if($errmsg!=''){?>
    <div class="alert alert-success"><strong>
      <?php  echo  $errmsg;?>
      </strong></div>
    <?php } ?>
    <?php if($this->input->get('sent')==1){?>
    <strong>Sucess !</strong>Check your mail.
    <?php }?>
    <?php if($this->input->get('err')==1){?>
    <div class="alert alert-danger alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
      <strong>Enter Your Email.</strong> </div>
    <?php }?>
    
          
    <div class="panel panel-success filterstyle registerfrm "> 
        <div class="panel-headingsd"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i> Register Now</strong></div>

        <div class="panel-body">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-id-card-o" aria-hidden="true"></i> Personal Details</div>
            <div class="panel-body">
                <label for="sel1">Create Your Account</label> 

                <div class="form-group">
                  <label for="sel1">Email / Username</label>                  
             	<input type="text" id="contact_email" placeholder="Email" name="contact_email" class="form-control logins" value="">
                </div>

                <div class="form-group">
                  <label for="sel1">Create Password</label>                  
             	<input type="password" id="password" placeholder="Password" name="password" class="form-control logins" value="">
                </div>

                <div class="form-group">
                  <label for="sel1">Confirm Password</label>                  
             <input type="password" id="c_password" placeholder="Confirm Password" name="c_password" class="form-control logins" value="">
                </div>

                <div class="form-group">
                  <label for="sel1">Company</label>                  
             <input type="text" id="company_name" placeholder="Company Name" name="company_name" class="form-control logins" value="">
                </div>

                <div class="form-group">
                  <label for="sel1">Address</label>                  
              <input type="text" id="address" placeholder="Address" name="address" class="form-control logins" value="">
                </div>

                <div class="form-group">
                  <label for="sel1">State</label>                  
              <?php echo form_dropdown('state_id', $state_list , $formdata['state_id'],'class="form-control logins"  id="state_id" ');?>
                </div>

                <div class="form-group">
                  <label for="sel1">City</label>                  
               <?php echo form_dropdown('city_id', $city_list , $formdata['city_id'],'class="form-control logins"  id="city_id" ');?>
                </div>

                <div class="form-group">
                  <label for="sel1">Pincode</label>                  
                <input type="text" id="pincode" placeholder="Pincode" name="pincode" class="form-control logins" value="">
                </div>
                
                <div class="form-group">
                  <label for="sel1">Contact Name</label>                  
                <input type="text" id="contact_name" placeholder="Contact Name" name="contact_name" class="form-control logins" value="">
                </div>
                
                <div class="form-group">
                  <label for="sel1">Designation</label>                  
                 <input type="text" id="designation" placeholder="Designation" name="designation" class="form-control logins" value="">
                </div>
                
                
                <div class="form-group">
                  <label for="sel1">Land Line (Optional)</label>  
				  
				  <div class="input-group">
				  	<input type="text" id="stdcode" name="stdcode" placeholder="Std Code" class="form-control logins" style="width: 25%;">
					<input type="text" id="telephone" placeholder="Land Line" name="telephone" class="form-control logins" value="" style="width: 75%;">
					
				  </div>	
                </div>
                
                <div class="form-group">
                  <label for="sel1">Mobile</label>  
				  <div class="input-group">                
                  <input readonly type="text" id="ext" name="ext" value="+ 91" autocomplete="off" class="form-control logins"  style="width: 25%;" >
                  <input type="text" id="contact_phone"  placeholder="Mobile" name="contact_phone" class="form-control logins" value="" style="width: 75%;">
				  </div>
                </div>


                <div class="form-group">
                  <label for="sel1">GST (Optional)</label>                  
                  <input type="text" id="gstno" placeholder="GST No" name="gstno" class="form-control logins" value="">
                </div>

                
                <div class="form-group">
                  <label for="sel1">Industry</label>
                  <?php echo form_dropdown('ind_id', $industry_list , $formdata['ind_id'],'class="form-control logins"  id="ind_id" ');?>
                </div>
                
                <div class="form-group">
                    <label for="sel1">Logo</label>
                    <?php echo form_upload(array('name'=>'company_logo','class'=>'form-data','id'=>'company_logo'));?>
                </div>
            </div>
        </div>
      

            
            
        </div>
        <div class="row">
            <div class="col-sm-6" style="overflow:hidden;"> 
           <input type="checkbox" name="chk_terms" id="chk_terms" value="1"/>
           &nbsp;&nbsp;&nbsp; I Agree to <a target="_blank" href="<?php echo $this->config->item('home_url'); ?>terms">Terms & Conditions</a>                   
            </div>
        </div>                          
        <button type="submit" id="submit_form" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Register </strong></button>
         
    </div>
    </form>
  </div>

</div>             
<!-- item1 -->    
<script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
 
 
 <script>
    
    //document.addEventListener('contextmenu', event => event.preventDefault());
	
	$('#country_id111').change(function() {

	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');
		
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>empsignup/getstate/',
		  data: { country_id: $('#country_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#state_id').html('');
				  $.each(data.state_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#state_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#state_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Select State</option');
		  }
		});	
});
    
    $('#state_id1111').change(function() {

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
		
	if($('#state_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>empsignup/getcity/',
		  data: { state_id: $('#state_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#city_id').html('');
				  $.each(data.city_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#city_id').append('<option value="'+ index +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#city_id').append('<option value="'+ index +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Select City</option');
		  }
		});	
});

function validate_empsignup()
{
    
	
	if($('#contact_email').val()=='')
	{
		alert('Please enter Username / Email');
		$('#contact_email').focus();
		return false;
	}	
	
	
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

		if(!pattern.test($('#contact_email').val())){

			alert('Enter valid email');

			$('#contact_email').focus();

			return false;

		}

	
	
    if($('#password').val()=='')
	{
		alert('Please enter Password');
		$('#password').focus();
		return false;
	}	
	
	if($('#password').val()=='')
	{
		alert('Please enter Password');
		$('#password').focus();
		return false;
	}	
	
	if($('#c_password').val()!=$('#password').val())
		{
			alert('Password mismatch, please correct');
			$('#c_password').focus();
			return false;
		}
		
		if($('#company_name').val()=='')
	{
		alert('Please enter Company Name');
		$('#company_name').focus();
		return false;
	}
    
    if($('#address').val()=='')
	{
		alert('Please enter address');
		$('#address').focus();
		return false;
	}
    if($('#state_id').val()=='' || $('#state_id').val()==0)
	{
		alert('Please select your state');
		$('#state_id').focus();
		return false;
	}
    
    if($('#city_id').val()=='' || $('#city_id').val()==0)
	{
		alert('Please select your city');
		$('#city_id').focus();
		return false;
	}
    
    if($('#pincode').val()=='')
	{
		alert('Please enter your pincode');
		$('#pincode').focus();
		return false;
	}
    
    if($('#designation').val()=='')
	{
		alert('Please enter your designation');
		$('#designation').focus();
		return false;
	}
    
    if($('#ext').val()=='')
	{
		alert('Please enter Mobile extention');
		$('#ext').focus();
		return false;
	}
    
    if($('#contact_phone').val()=='')
	{
		alert('Please enter Mobile');
		$('#contact_phone').focus();
		return false;
	}
    
    var phoneno = /^\d{10}$/;
     if(!$('#contact_phone').val().match(phoneno))
        {
       alert('Please enter ten digit mobile number');
		$('#contact_phone').focus();
		return false;
     } 
	
	if($('#contact_name').val()=='')
	{
		alert('Please enter your name');
		$('#contact_name').focus();
		return false;
	}
	
		
	
	
   var terms = $("input#chk_terms");

        if (terms.is(":checked")) {
            send_data(terms.val());
        } else {
            alert("Please check Terms & Conditions");
        }	return false;
		
	
	//$('#loginForm').submit();	
	return true;
}

/*$( ":input" ).keypress(function( event ) {
  if ( event.which == 13 ) {
   //$('#loginForm').submit();
   validate();
  }
});*/

</script>
               
</div> 
</div>
</div>