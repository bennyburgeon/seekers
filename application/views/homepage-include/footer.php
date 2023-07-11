   

     <!-- Site footer -->

    <footer class="site-footer">

      <div class="container">

        <div class="row">

          <div class="col-sm-12 col-md-6">

            <h6>About</h6>

            <p class="text-justify">Logis.ae provides employers with human capital solutions that result in measurably improved employee and organizational performance while minimizing employment practice risk.</p>

          </div>



 

          <div class="col-xs-6 col-md-3">

            <h6>Services</h6>

            <ul class="footer-links">



    



										

                                        <li><a href="<?php echo $this->config->base_url();?>index.php/cvwriting">CV Writing</a></li>

                                        <li><a href="<?php echo $this->config->base_url();?>index.php/jobalerts">Job Alerts</a></li>

                                        <li><a href="<?php echo $this->config->base_url();?>index.php/jobsearch"> Job Search Assistance </a></li>

                                        <li class="dropdown"><a href="<?php echo $this->config->base_url();?>index.php/webinar">Webinar ( Interview Training )</a></li>

						        

            </ul>

          </div>



          <div class="col-xs-6 col-md-3">

            <h6>Quick Links</h6>

            <ul class="footer-links">

              <li><a href="<?php echo $this->config->base_url();?>index.php/about">About Us</a></li>

              <li><a href="<?php echo $this->config->base_url();?>index.php/contact">Contact Us</a></li>

              <li><a href="<?php echo $this->config->base_url();?>index.php/terms">Terms & Conditions</a></li>

              <li><a href="<?php echo $this->config->base_url();?>index.php/privacy">Privacy Policy</a></li>

            </ul>

          </div>

        </div>

        <hr>

      </div>

      <div class="container">

        <div class="row">

          <div class="col-md-8 col-sm-6 col-xs-12">

            <p class="copyright-text">Copyright &copy; 2020 All Rights Reserved. 

          Developed by <a href="http://www.seekershr.com" target="_blank">Seekers Consultancy LLC, P.O Box 20893, Dubai, UAE</a>.

            </p>

          </div>



          <div class="col-md-4 col-sm-6 col-xs-12">

            <ul class="social-icons">

              <li><a class="facebook" target="_blank" href="http://facebook.com/seekershr"><i class="fab fa-facebook-f"></i></a></li>

              <li><a class="dribbble" target="_blank" href="http://linkedin.com/company/seekershr"><i class="fab fa-linkedin"></i></a></li>

              <li><a class="twitter" target="_blank" href="http://twitter.com/seekersgulf"><i class="fab fa-twitter"></i></a></li>

              <li><a class="dribbble" target="_blank" href="http://instagaram.com/seekershr"><i class="fab fa-instagram"></i></a></li>

               

            </ul>

          </div>

        </div>

      </div>

</footer> 

    

    

    

    <!--  Modal content for the above example -->

                        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="myModal">

                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

     <button type="button" class="closess" data-dismiss="modal" aria-label="Close">

                                            <span aria-hidden="true">&times;</span>

                                        </button>

                                    

                                    

                                 

                                   <div class="modal-body">

                                       <div class="jubly-bx">

                                       

                                           

                                           <div class="card mt-3 tab-card">

        <div class="card-header tab-card-header">

          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">

            <li class="nav-item">

                <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Candidate Sign In</a>

            </li>

            <li class="nav-item">

                <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">Employer Sign In</a>

            </li>

        

          </ul>

        </div>



        <div class="tab-content" id="myTabContent">

          <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">

        

     <div class="card card-signin ">

          <div class="card-body">

            <h5 class="card-title text-center">Candidate Sign In</h5>



<form action="<?php echo $this->config->site_url();?>/login" class="form-signin" enctype="multipart/form-data" method="post" id="TopLoginForm" name="TopLoginForm"  > 



            

            

              <div class="form-label-group">

                <input type="email" id="topCandidateUsername" class="form-control" name="username" placeholder="Email address" required="" autofocus>

              

              </div>



              <div class="form-label-group">

                <input type="password" id="topCandidatePassword" class="form-control" name="password" placeholder="Password" required="">

              

              </div>



              <div class="custom-control custom-checkbox mb-3">

                <input type="checkbox" class="custom-control-input" id="customCheck1">

                <label class="custom-control-label" for="customCheck1">Remember password</label>

              </div>



             <div class="custom-control custom-checkbox mb-3">

             <a href="<?php echo $this->config->site_url();?>/forgottonpassword" class="forgot">Forgot Password?</a>

             </div>

                            

              

              <button class="btn btn-lg btn-primary btn-block text-uppercase" onClick="top_login_validate()" type="burron">Login</button>

              <hr class="my-4">

 

            </form>

          </div>

        </div>

                                           

                                           

                                                        

          </div>

          <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">

    

                                           <div class="card card-signin ">

          <div class="card-body">

            <h5 class="card-title text-center">Employer Sign In</h5>

            

            <form action="<?php echo $this->config->base_url();?>employer/login" class="form-signin" enctype="multipart/form-data" method="post" id="TopEmpLoginForm" name="TopLoginForm"  > 

            

            

              <div class="form-label-group">

                <input type="text" id="TopEMPUsername" name="username" class="form-control" placeholder="Email address" required="" autofocus>

              

              </div>



              <div class="form-label-group">

                <input type="password" id="TopEMPPassword" name="password" class="form-control" placeholder="Password" required="">

              

              </div>



              <div class="custom-control custom-checkbox mb-3">

                <input type="checkbox" class="custom-control-input" id="customCheck11">

                <label class="custom-control-label" for="customCheck1">Remember password</label>

              </div>

              

     <button class="btn btn-lg btn-primary btn-block text-uppercase" onClick="top_emp_login_validate();" type="button">Login</button>

              <hr class="my-4">

            </form>

          </div>

        </div>

                                           

                                           

                                                       

          </div>

    



        </div>

      </div> 

                                           

                  

                                    </div>

                                </div><!-- /.modal-content -->

                            </div><!-- /.modal-dialog -->

                        </div><!-- /.modal -->



               </div><!-- /.modal -->

               

               

               <div class="modal fade bs-example-modal1-lg" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel1" aria-hidden="true" id="myModal1">

                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">

     <button type="button" class="closess" data-dismiss="modal" aria-label="Close">

                                            <span aria-hidden="true">&times;</span>

                                        </button>

                                    

                                    

                                 

                                   <div class="modal-body">

                                       <div class="jubly-bx">

                                       

                                           

                                           <div class="card mt-3 tab-card">

        <div class="card-header tab-card-header">

          <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">

            <li class="nav-item">

                <a class="nav-link active" id="four-tab" data-toggle="tab" href="#four" role="tab" aria-controls="Four" aria-selected="true">Candidate Registration</a>

            </li>

            

        

                 <li class="nav-item">

                 <a class="nav-link" id="three-tab" data-toggle="tab" href="#three" role="tab" aria-controls="Three" aria-selected="false">EmployerRegistration</a>

                 </li>

                              

          </ul>

        </div>



        <div class="tab-content" id="myTabContent">

          <div class="tab-pane fade show active p-3" id="four" role="tabpanel" aria-labelledby="four-tab">

        

     <div class="card card-signin ">

                                 <div class="card-body">

                                    <h5 class="card-title text-center">Register  as a Candidate</h5>

                                    <form class="form-signin">

                                       

                                       

                                       

                                       <button onclick="window.location='<?php echo $this->config->base_url();?>index.php/signup'" class="btn btn-lg btn-primary btn-block text-uppercase" type="button">Are you searching for a job ? click here </button>

                                       

                                      

                                      

                                    </form>

                                    <hr class="my-4">

                                    Logis.ae is a job portal exclusively for the Logistics and Supply Chain professoinals in UAE, managed by SeekersHR. Candidate with experience or qualifications in in Logistics & Supply Chain Sectors and searching for a job in UAE can also register. All other caniddates please visit and register at www.seekershr.com  

                                    

                                 </div>

                              </div>

                                           

                                                        

          </div>

          

          <div class="tab-pane fade p-3" id="three" role="tabpanel" aria-labelledby="three-tab">

        

     <div class="card card-signin ">

                                 <div class="card-body">

                                    <h5 class="card-title text-center">Register as an Employer</h5>

                                    <form class="form-signin">

                                       

                                       

                                       

                                       <button onclick="window.location='https://www.logis.ae/index.php/empsignup'" class="btn btn-lg btn-primary btn-block text-uppercase" type="button">Are you searching for candidates ? click here </button>

                                      

                                 

                                      

                                    </form>

                                     <hr class="my-4">

                                    Logis.ae is a job protal exculively for the employers and candidates in the Logistics and Supply Chain Sectors in UAE, managed by SeekersHR. Employers can post the job and get the right candidates easily and quickly as the portal is having only the screened candidates from this specific industry. 

                                    

                                 </div>

                              </div>

                                           

                                                        

          </div>

        

    



        </div>

      </div> 

                                           

                  

                                    </div>

                                </div><!-- /.modal-content -->

                            </div><!-- /.modal-dialog -->

                        </div><!-- /.modal -->



               </div>

               

               



<script src="<?php echo base_url('js/jquery-3.5.1.min.js');?>"></script> <!-- jQuery -->

<script src="<?php echo base_url('js/bootstrap.bundle.min.js');?>"></script>

<script src="<?php echo base_url('js/navik.menu.js');?>"></script> <!-- Navik navigation jQuery -->

<script src="<?php echo base_url('js/custom.js');?>"></script> <!-- Custom jQuery -->





<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

  $( function() {

    $( "#date_of_birth" ).datepicker({

	dateFormat: "yy-mm-dd",

      changeMonth: true,

      changeYear: true,

       yearRange: "c-80:c+1"

    });

  } );

  </script>



<script>

    

    $(".burger-menu").click(function(){

  $(".submenu-top-border").toggleClass("open");

});





    </script>

    

    	<script>



function top_login_validate()

{

	

	if($('#topCandidateUsername').val()=='')

	{

		alert('Please enter Username');

		$('#topCandidateUsername').focus();

		return false;

	}

    else if($('#topCandidatePassword').val()=='')

	{

		alert('Please enter Password');

		$('#topCandidatePassword').focus();

		return false;

	}

	else{

		$('#TopLoginForm').submit();

	}

	

	//return true;

}



$( ":input" ).keypress(function( event ) {

  if ( event.which == 13 ) {

   //$('#loginForm').submit();

   validate();

  }

});



</script>				



<script>



function top_emp_login_validate()

{

	

	if($('#TopEMPUsername').val()=='')

	{

		alert('Please enter Username');

		$('#TopEMPUsername').focus();

		return false;

	}

    else if($('#TopEMPPassword').val()=='')

	{

		alert('Please enter Password');

		$('#TopEMPPassword').focus();

		return false;

	}

	else{

		$('#TopEmpLoginForm').submit();

	}

	

	//return true;

}



$( ":input" ).keypress(function( event ) {

  if ( event.which == 13 ) {

   //$('#loginForm').submit();

   validate();

  }

});



</script>	



 <script type="text/javascript">



var job_id=0;

/* form validation */

  function candidate_validate_signup() {
		if($('#username').val()=='')
		{
			alert('Enter Username/Email');
			$('#username').focus();
			return false;
		}

		var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;

		if(!pattern.test($('#username').val())){
			alert('Enter valid email');
			$('#username').focus();
			return false;
		}
		
		if($('#password').val()=='')
		{
			alert('Enter Password');
			$('#password').focus();
			return false;
		}
		
		if($('#c_password').val()=='')
		{
			alert('Confirm Your Password');
			$('#c_password').focus();
			return false;
		}

		if($('#c_password').val()!=$('#password').val())
		{
			alert('Password mismatch, please correct');
			$('#c_password').focus();
			return false;
		}
				
		if($('#first_name').val()=='')
		{
			alert('Enter first name');
			$('#first_name').focus();
			return false;
		}   

		if($('#country_id').val()=='')
		{
			alert('Select Country');
			$('#country_id').focus();
			return false;
		}  

		if($('#state_id').val()=='')
		{
			alert('Select State');
			$('#state_id').focus();
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


/* form validation ends here */

$('#submit_signup_form').click(function(evt) 
{
	   evt.preventDefault();
	   var isContactValid = candidate_validate_signup();
	if(!isContactValid) 
		   {
				return false;
		   }
	  	$.ajax({
				type: "post",
				url: "<?php echo $this->config->site_url();?>/signup/check_email",
				cache: false,				
				data: {username:$('#username').val()},
				success: function(data){ 
					try{		
						var ret = jQuery.parseJSON(data);
						if(ret['status']=='1') 
						{
							alert('Email already exist. Please change.');
							return false;
						}else 
						{
							$('#register_form').submit();
							return true;
						}
					}
					catch(e) {		
						alert('Exception occured while chekcing email duplication');
						return false;
					}	
				},
				error: function(){						
					alert('An Error has been found on Ajax request from duplicate check [Email]');
					return false;
				}
			});//end ajax
});


function check_email()
{
	var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
		var email=$('#username').val();					
		if($('#username').val()=='')
		{
			alert('Enter Username or Email');
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
				url: "<?php echo $this->config->site_url();?>/signup/check_email",
				cache: false,				
				data: {username:$('#username').val()},
				success: function(data){ 
					try{		
						var ret = jQuery.parseJSON(data);
						$('#check_msg').attr('style', ''); 
		   				$('#check_msg').hide();
						if(ret['status']==0) 
						{
                            $('#check_msg').html('<i>Email address does not exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
			   				$('#check_msg').show();
							alert('Email / Username available !');
							return true;
						}else if(ret['status']==1)
						{
                            $('#check_msg').html('<i>Email address already exist.</i>');
			   				$('#check_msg').css('color','#2B983F');
			   				$('#check_msg').show();
							alert('Email exists, please change, or click login -> change password to get access.');
							return false;
						}
					}
					catch(e) {		
						alert('Exception occured while adding contact.');
						return false;
					}	
				},
				error: function(){						
					alert('An Error has been found on Ajax request from contact save');
					return false;
				}
			});//end ajax
}



</script>

<script type="text/javascript">

$('#country_id').change(function() {



	jQuery('#state_id').html('');

	jQuery('#state_id').append('<option value="">Select State</option');



	jQuery('#city_id').html('');

	jQuery('#city_id').append('<option value="">Select City</option');

			

	if($('#country_id').val()=='')return;



		$.ajax({

		  type: 'POST',

		  url: '<?php echo $this->config->site_url();?>/signup/getstate/',

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

						 jQuery('#state_id').append('<option value="'+ $.trim(index) +'" selected="selected">'+ value +'</option');

					 else

						 jQuery('#state_id').append('<option value="'+ $.trim(index) +'">'+ value +'</option');

				 });

						

			  }

		 	},

		  

		  error:function(){

				alert('Problem with server. Pelase try again');

				jQuery('#state_id').html('');

				jQuery('#state_id').append('<option value="">Select State</option');

		  }

		});	

});

$('#state_id').change(function() {



	jQuery('#city_id').html('');

	jQuery('#city_id').append('<option value="">Select City</option');

		

	if($('#state_id').val()=='')return;



		$.ajax({

		  type: 'POST',

		  url: '<?php echo $this->config->site_url();?>/signup/getcity/',

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

						 jQuery('#city_id').append('<option value="'+ $.trim(index) +'" selected="selected">' + value + '</option');

					 else

						 jQuery('#city_id').append('<option value="'+ $.trim(index) +'">' + value + '</option');

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





function candidate_contact_form() {



		if($('#full_name').val()=='')

		{

			alert('Enter your full name');

			$('#full_name').focus();

			return false;

		}

	    return true;

    }

    

</script>	


<script type="text/javascript">
	$('#job_cat_id').change(function() {

	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');

	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');	
		
	//if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/home/get_functional_by_industry/',
		  data: { job_cat_id: $('#job_cat_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  
				  jQuery('#func_id').html('');
				  $.each(data.func_list, function (index, value) 
				  {
					  	//alert(index);
					  if(index=='')
						 jQuery('#func_id').append('<option value="'+ $.trim(index) +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#func_id').append('<option value="'+ $.trim(index) +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Select Functional Area</option');
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Select Designation</option');
		  }
		});	
});

	$('#func_id').change(function() {
		
	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');
			
	//if($('#func_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/home/get_designation_by_function/',
		  data: { func_id: $('#func_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#desig_id').html('');
				  $.each(data.desig_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#desig_id').append('<option value="'+ $.trim(index) +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#desig_id').append('<option value="'+ $.trim(index) +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Select Designation</option');
		  }
		});	
});


$('#desig_id').change(function() {
		
	jQuery('#skill_id').html('');
	jQuery('#skill_id').append('<option value="">Select Skills</option');
			
	//if($('#desig_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/home/get_skills_by_designation/',
		  data: { desig_id: $('#desig_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#skill_id').html('');
				jQuery('#skill_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#skill_id').html('');
				  $.each(data.skill_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#skill_id').append('<option value="'+ $.trim(index) +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#skill_id').append('<option value="'+ $.trim(index) +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#skill_id').html('');
				jQuery('#skill_id').append('<option value="">Select Skills</option');
		  }
		});	
});

</script>


</body>

<script src="//code.tidio.co/wmsfineoexa8gftjrheytlpggjcgenlv.js" async></script>

</html>