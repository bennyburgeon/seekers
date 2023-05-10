
<!--search results--> 
<br />
<div class="container-fluid">
  <div class="container">
  
    <div class="panel panel-default">
    <div style="padding-right:10px;">
   
</div>
      <div class="panel-heading"><strong>
      
        <h4><i class="fa fa-share" aria-hidden="true"></i><strong> Profile Registration Completed</strong> </h4>
        </strong> 
        </div>
        
      <div class="panel-body">
      
        <div class="row box">
        
		<div class="col-sm-2"></div>
        
       <div class="col-sm-8">
            <div class="panel panel-success">
              <div class="panel-heading"><strong><i class="fa fa-user-circle-o" aria-hidden="true"></i>Thank you..</strong></div>
              <br />
              
              <div class="panel-body">
              
              
                        
                     <br>
<br>
<br>
<br>
<br>   
        <?php 
		
		if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
		{
		?>
             <br>You have successfully applied for job. We will get back to you soon.
                            
        <?php 
		}else{
		?>
          <br>You have successfully registered and applied for the job. We will get back to you soon.
      <?php 
		}
		?>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

                            
                          
              </div>
            </div>
          </div>
          

          
        </div>
        
      </div>
      
    </div>
  </div>
</div>

