

	<!-- Content -->

    

<div class="joblisting">

      <div class="container"> 

      <div class="row">

          

        <div class="col-md-12">

          



          

          </div>  

          

          

          

 	<!-- item1 -->         

<div class="col-md-8 col-lg-8 col-sm-12">

<div class="option-bar">

                    <div class="row">

                        <div class="col-lg-12">

                        <div class="top-companyhead">

                        

                    <?php 

					 if($job['show_company_details']==1 && $job['company_logo']!='' && file_exists('rms/company_logo/'.$job['company_logo'])){

					?>



					<h4><img alt="<?php echo $job['company_name'];?>" src="<?php echo base_url('rms/company_logo/'.$job['company_logo']);?>"> <?php echo $job['company_name'];?></h4> 

                                                

                            <div class="linksweb"> 

                            	<span><a href="<?php echo $job['company_website'];?>" target="_blank"><i class="fa fa-link"></i> View Website </a></span>

				<span><a href="<?php echo $job['contact_linkedin'];?>" target="_blank"><i class="fab fa-linkedin"></i>Linkedin Profile</a></span>

                            </div>  

                    <?php }else{ ?>

						  <h4>   <img src="<?php echo base_url('img/thumb-logo.jpg');?>"> Logis.AE</h4>                         

                                                      

                            <div class="linksweb"> 

                            	<span><a href="<?php echo $this->config->base_url();?>index.php/home"><i class="fa fa-link"></i> www.logis.ae </a></span>

				<span><a href="#"><i class="fab fa-twitter"></i>Linkedin Profile</a></span>

                            </div>  

					<?php } ?>

                          

                          



                            

                            

                              </div>

                          

                            

                  

                        </div>

                 

                    </div>

                </div>    

    



    

   

   

    

  



    

    

    

    <div class="job-item featured-item jobdetails" >



   <div class="job-info yes-logo">

      <h3>

       <?php echo $job['job_title']; ?>

           <a  href="#" >Full-Time</a>

      </h3>

     

      

 

       </div>

        

     <ul>

       <li><i class="fa fa-suitcase"></i> <?php echo $this->config->item('currency_symbol');?> <?php echo $job['salary_desc']; ?> </li>

          <li><i class="fas fa-map-marker-alt"></i>  City: <?php if($job['city_name']!='')echo $job['city_name'];else echo 'Na'; ?> </li>

       <li><i class="far fa-calendar-alt"></i>  <?php echo date("d-m-Y", strtotime($job['job_post_date'])); ?></li>

          <li>  <i class="fas fa-comment-dollar"></i> <strong> Salary:</strong>&nbsp;<?php if($job['salary_desc']>=1){?>Salary <?php echo $this->config->item('currency_symbol');?>  : <?php echo $job['salary_desc']; ?><?php }else{?>NA<?php } ?>    </li>

          <li> <i class="fa fa-graduation-cap icon_color" aria-hidden="true"></i> <strong>Eligibility:</strong> 

				<?php if($job['level_name']!='')echo $job['level_name'];else echo 'ANY'; ?></li>

          

          <li> <i class="fas fa-bullhorn" aria-hidden="true"></i><strong> Experience:</strong>&nbsp;    

		  <?php if($job['exp_range']!=''){ ?>

			  <?php echo $job['exp_range']; ?>

              <?php }else{ ?>

              NA

              <?php } ?>  </li>

       

       

        

          

           <li> <i class="fa fa-flag icon_color" aria-hidden="true"></i><strong> Nationality:</strong>&nbsp;

				<?php if($job['country_name']!='')echo $job['country_name'];else echo 'ANY'; ?>;  </li>

          

          

           <li> <i class="fa fa-calendar icon_color" aria-hidden="true"></i> <strong>Posted On:</strong> 

					  <?php echo date("F", strtotime($job['job_post_date'])); ?> <?php echo date("d", strtotime($job['job_post_date'])); ?>th<?php echo date(" Y", strtotime($job['job_post_date'])); ?> </li>

          

          <li>  <i class="fa fa-industry icon_color" aria-hidden="true"></i> <strong>Industry:</strong> 

                       

                <?php if($job['job_cat_name']!='')echo $job['job_cat_name'];else echo 'NA' ?> |  

				

                

                </li>

          <li>  <i class="fa fa-industry icon_color" aria-hidden="true"></i> <strong>Functional Area:</strong> 

                       

              

				

				<?php if($job['func_area']!='')echo ','.$job['func_area'];?> 

                

                </li>





          

      </ul>       

        

 <div class="jobdescriptions">
  <h5> Job Description   </h5>
       <?php echo $job['job_desc']; ?>
</div>  

 <div class="jobdescriptions">
         <h5> Desired Profile   </h5>
        <?php echo $job['desired_profile'];?>
</div>

 <div class="jobdescriptions">
 <ul>



<li>Work Level: <?php if($job['work_level']!='')echo $job['work_level'];else echo 'ANY'; ?></li>

<li>Current Location: <?php if($job['res_location']!='')echo $job['res_location'];else echo 'NA' ?></li>

             

<li>Salary <?php if($job['salary_desc']>=1){?>Salary <?php echo $this->config->item('currency_symbol');?>  : <?php echo $job['salary_desc']; ?><?php }else{?>NA<?php } ?></li>



<!-- <li>Vacancies:1</li> -->



<li> Posted on:



<?php echo date("F", strtotime($job['job_post_date'])); ?> <?php echo date("d", strtotime($job['job_post_date'])); ?>th<?php echo date(" Y", strtotime($job['job_post_date'])); ?>

</li> 

<li>Last date of Application: <?php echo date("F", strtotime($job['job_expiry_date'])); ?> <?php echo date("d", strtotime($job['job_expiry_date'])); ?>th<?php echo date(" Y", strtotime($job['job_expiry_date'])); ?> </li> 

<li>Expected Joining Date: 



<?php echo date("F", strtotime($job['exp_join_date'])); ?> <?php echo date("d", strtotime($job['exp_join_date'])); ?>th<?php echo date(" Y", strtotime($job['exp_join_date'])); ?>

</li>

<li>Eligibility:  <?php if($job['level_name']!='')echo $job['level_name'];else echo 'ANY'; ?></li> 





<li>Preferred Gender:<?php if($job['gender'] =='1')echo 'Female'; else if($job['gender'] == '2') echo 'Male'; else echo 'No Preference' ;?></li>

 

 

  <br>

  </ul>
 </div>        

    <?php 

	if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')

	{

?>



<?php if(isset($job['job_applied']) && $job['job_applied']>0){ ?>



<a href="#" class="btn btn-warning pull-right btn-xs" title="Already Applied for this Job">Welcome <?php echo $_SESSION['candidate_first_name'];?> !! Already Applied for this Job</a>



<?php }else{ ?>



<?php if($job['mode_of_application']==1){?>

<form id="apply_form" action="<?php echo site_url('home/apply_jobs'); ?>"  class="formular" name="apply_form" method="post" enctype="multipart/form-data">

 <input type="hidden" name="job_id"  id="job_id" value="<?php echo $job['job_id'];?>">

 <button type="submit" id="button_apply_jobs" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Apply </strong></button>

 </form>

 

<?php }elseif($job['mode_of_application']==2){ ?>    



 <a href="<?php echo $job['social_link']; ?>" target="_blank"> Apply for this Job  <i class="fas fa-angle-double-right"></i> </a>



<?php }elseif($job['mode_of_application']==3){ ?> 



 <a href="mailto:<?php echo $job['social_link_image']; ?>"> Apply for this Job  <i class="fas fa-angle-double-right"></i> </a>



<?php }elseif($job['mode_of_application']==4){ ?> 



Please Call<strong> <?php echo $job['social_comment']; ?></strong> for more details of the job and submitting your application.



<?php } ?>    



<?php 

	}}else{

?>



<div class="job-skill">

    <a href="<?php echo $this->config->base_url();?>index.php/signup/?job_id=<?php echo md5($job['job_id']); ?>"> Register & Apply for this Job  <i class="fas fa-angle-double-right"></i> </a>

    <a href="<?php echo $this->config->base_url();?>index.php/login/?job_id=<?php echo md5($job['job_id']); ?>"> Login & Apply for this Job  <i class="fas fa-angle-double-right"></i> </a>

      </div>  



  

<?php } ?> 

</div>

    

    

    

    

    

   </div>             

  	<!-- item1 -->    

          

            

   

    <div class="col-md-4 col-lg-4 col-sm-12">

   

        <div class="widget bx-rtls ">

			<h4>Overview</h4>



			<div class="job-overview">

				

				<ul>

					<li>

						<i class="fa fa-map-marker"></i>

						<div>

							<strong>Location:</strong>

							<span><?php if($job['city_name']!='')echo $job['city_name'];else echo 'NA' ?></span>

						</div>

					</li>

					<li>

						<i class="fa fa-user"></i>

						<div>

							<strong>Job Title:</strong>

							<span><?php echo $job['job_title']; ?></span>

						</div>

					</li>

                    <!-- 

					<li>

						<i class="far fa-clock"></i>

						<div>

							<strong>Hours:</strong>

							<span>NA</span>

						</div>

					</li>

                    -->

					<li>

						<i class="fas fa-comment-dollar"></i>

						<div>

							<strong>Salary:<?php echo $job['salary_desc']; ?></strong>

							<span><strong>AED</strong></span>

						</div>

					</li>

				</ul>

       

	

    <?php 

	if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')

	{

?>



<?php if(isset($job['job_applied']) && $job['job_applied']>0){ ?>



<a href="#" class="btn btn-warning pull-right btn-xs" title="Already Applied for this Job">Welcome <?php echo $_SESSION['candidate_first_name'];?> !! Already Applied for this Job</a>



<?php }else{ ?>



<?php if($job['mode_of_application']==1){?>

<form id="apply_form" action="<?php echo site_url('home/apply_jobs'); ?>"  class="formular" name="apply_form" method="post" enctype="multipart/form-data">

 <input type="hidden" name="job_id"  id="job_id" value="<?php echo $job['job_id'];?>">

 <button type="submit" id="button_apply_jobs" class="btn btn-info col-sm-12"><strong><i class="fa fa-paper-plane" aria-hidden="true"></i> Apply </strong></button>

 </form>

 

<?php }elseif($job['mode_of_application']==2){ ?>    



 <a href="<?php echo $job['social_link']; ?>" target="_blank"> Apply for this Job  <i class="fas fa-angle-double-right"></i> </a>



<?php }elseif($job['mode_of_application']==3){ ?> 



 <a href="mailto:<?php echo $job['social_link_image']; ?>"> Apply for this Job  <i class="fas fa-angle-double-right"></i> </a>



<?php }elseif($job['mode_of_application']==4){ ?> 



Please Call<strong> <?php echo $job['social_comment']; ?></strong> for more details of the job and submitting your application.



<?php } ?> 

    



<?php 

	}

?>

<?php 	

	}else{

?>





    <a href="<?php echo $this->config->base_url();?>index.php/signup/?job_id=<?php echo md5($job['job_id']); ?>"  class="applaythis"> Register & Apply for this Job  </a>



    <a href="<?php echo $this->config->base_url();?>index.php/login/?job_id=<?php echo md5($job['job_id']); ?>"  class="applaythis"> Login & Apply for this Job  </a>



<?php } ?>



			</div>



		</div>

        

          <div class="social-share-right  ">

              <h6> Share this job</h6>

        		 <div class="shareicon">

                 

                 

                            <a class="facebook"  href="http://facebook.com/logisticsjobsandcareers" target="_blank"><i class="fab fa-facebook-f"></i></a>

                            

                             <a class="res_div" href="http://linkedin.com/company/logisticsjobs" target="_blank"><i class="fab fa-linkedin"></i></a>

                            

                            <a class="twitter" href="https://wa.me/971503860610" target="_blank"><i class="fab fa-whatsapp"></i></a>

                           

                            <a class="dribbble" href="http://instagram.com/seekershr" target="blank"><i class="  fab fa-instagram"></i></a>

                   

                        </div>

         </div>

     

</div>              

          

          

          

          

    

</div>  </div>  </div>  

	<!-- Content -->    

       

       

       

       



<script type="text/javascript">



var job_id=0;

/* form validation */



  function candidate_validate() 

  {



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

		

		 if($('#driving_license_yes').is(':checked')) 

		 { 

			if($('#driving_license_country').val()=='')

			{

				alert("Please select country of Driving License issued"); 

				return false;

			}

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

	

$('#submit_form').click(function(evt) 

{

	   evt.preventDefault();

	   var isContactValid = candidate_validate();

			if(!isContactValid) 

		   {

				return false;

			}

	  	$.ajax({

				type: "post",

				url: "<?php echo $this->config->site_url();?>/home/check_email",

				cache: false,				

				data: {username:$('#username').val()},

				success: function(data){ 

					try{		

						var ret = jQuery.parseJSON(data);

						if(ret['STATUS']=='0') 

						{

							$('#register_form').submit();

							return true;

						}else if(ret['STATUS']=='1') 

						{

							alert('Email already exist. Please change.');

							return false;

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



</script>



<!-- Facebook like button -->












<!--  Linkedin Butoon -->



<!--  Linkedin Butoon end here -->





<!--  Twitter Butoon -->


