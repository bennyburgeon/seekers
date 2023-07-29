
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
      <div class="col-md-12">
         <div class="row">

<!-- notification -->
                  <div class="dropdown">
                     <button  class="btn btn-sm btn-outline-secondary ">New</button>
                  </div>
                  <div tabindex='2' id="resume_headline" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card">
                           <h5 class="card-header">My Message
                              
                           </h5>
                           
                           <div class="table-responsive text-nowrap">
                              <table class="table">
                              <thead class="table-light">
                                 <tr>
                                    <th>Date</th>
                                    <th>Sent By</th>
                                    <th>Message</th>
                                 </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                 <?php if($records!=NULL){
                                    foreach($records as $key => $val){ ?>
                                    <tr>
                                       
                                    <td><?php echo $val['message_date'];?></td>
                                    <td>
                                       <?php if($val['admin_id']>0){ ?>
                                       <span class="btn btn-success btn-xs disabled"><?php echo $val['recruiter']; ?></span>			
                                       <?php }else{ ?>
                                       <span class="btn btn-primary btn-xs disabled">Its Me..</span>
                                       <?php } ?>
                                    </td>
                                    <td><?php echo $val['message_text'];?></td>
                                    </tr>
                                 <?php }
                                 }else{?>
                                 <tr>
                                    <td colspan="8" align="center"> No Records Founds!!</td>
                                 </tr>
                                 <?php } ?>    
                              </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
<!-- Notification end -->

         </div>
      </div>
   </div>
</div>






<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script language="javascript">

$(document).ready(function(){
   $(document).on('click', '#edit_edu', function(){ 
      var $url= $(this).attr('data-url');	 
      $.ajax({	
         type: 'POST',	
         url: $url,
         dataType: "html",
         success: function (data) {	
            
            $('#data_holder').html(data);
         }			
      }); 
      $('#modalCenter').modal('show');	
   });
});


   </script>
