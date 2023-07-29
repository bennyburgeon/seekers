
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
      <div class="col-md-12">
         <div class="row">

<!-- notification -->
                 
                  <div tabindex='2' id="resume_headline" class=" col-md-6 col-lg-12 order-2 mb-4">
                     <div class="card h-100">
                        <div class="card">
                           <h5 class="card-header">My Interview
                              
                           </h5>
                           
                           <div class="table-responsive text-nowrap">
                              <table class="table">
                              <thead class="table-light">
                                 <tr>
                                 <th>Company Name</th>	
                                <th>Candidate Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Interview Type</th>	
                                <th>Interview Status</th>
                                 </tr>
                              </thead>
                              <tbody class="table-border-bottom-0">
                                <?php 
                                if($records!=NULL)
                                {
                                foreach($records as $result){ ?>
                                                
                                <tr class="odd gradeX">
                                <!--		    <td>
                                        <div class="checker">
                                        <span>
                                            <input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['interview_id']?>" >
                                        </span>
                                        </div>
                                    </td>-->
                                    <td><?php echo $result['job_title']?></td>
                                    <td><?php //echo $result['company_name']?>Seekers</td>
                                    
                                    <td><?php echo $result['first_name'].' '.$result['last_name']?></td>
                                    <td><?php if($result['interview_date']==0){echo '';}else{ echo date("d-m-Y", strtotime($result['interview_date']));}?></td>
                                    <td><?php echo $result['interview_time'];?></td>
                                    <td><?php echo $result['interview_type'];?></td>
                                    <td><?php echo $result['int_status_name'];?></td>
                                    </tr>

                                <?php
                                }}else{?>
                                <tr>
                                    <td colspan="7" align="center">
                                        No Records Founds!!
                                    </td>
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




   </script>
