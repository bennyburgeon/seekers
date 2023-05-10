<section>
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / <span>Dashboard</span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-2.png');?>" alt=""/><h3>Dashboard</h3></div>
<div class="gragh-area">

<?php if(count($my_messages)>0){?>
 <div class="tasks" style="border:1px solid #D3D3D3">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Sent By</th>
                <th>Message</th>
            </tr>	
            </thead>
           
            <tbody>
            	<?php foreach($my_messages as $key => $val){?>
                <tr>
                    <td><?php echo $val['message_date'];?></td>
                    <td><?php if($val['admin_id']>0)echo $val['firstname'];else echo 'Me'?></td>
                    <td><?php echo $val['message_text'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>

<br />

<?php if(count($shortlisted)>0){?>
<h3>Apps Shortlisted </h3>
 <div class="tasks" style="border:1px solid #D3D3D3">
 
    <table>
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Job Title</th>
                <th>Candidate</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Short.Date</th>
               
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($shortlisted as $key => $val){?>
                <tr>
                    <td><?php echo $val['company_name'];?></td>
                    <td><?php echo $val['job_title'];?></td>
                    <td><?php echo $val['first_name'].$val['last_name'];?></td>
                    <td><?php echo $val['username'];?></td>
                    <td><?php echo $val['mobile'];?></td>
                    <td><?php echo $val['short_date'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>
<br />

<?php if(count($interview_list)>0){?>
<h3>Interviews </h3>
 <div class="tasks" style="border:1px solid #D3D3D3">
 
    <table>
        <thead>
            <tr>
                <th>Job</th>
                <th>Interview Type</th>
                <th>date</th>
                <th>Time</th>
                <th>Location</th>
                <th>Details</th>
               
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($interview_list as $key => $val){?>
                <tr>
                    <td><?php echo $val['job_title'];?></td>
                    <td><?php echo $val['interview_type'];?></td>
                    <td><?php echo $val['interview_date'];?></td>
                    <td><?php echo $val['interview_time'];?></td>
                    <td><?php echo $val['location'];?></td>
                    <td><?php echo $val['description'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>
<br />

<?php if(count($selected)>0){?>
<h3>Apps Selected </h3>
 <div class="tasks" style="border:1px solid #D3D3D3">
 
    <table>
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Job Title</th>
                <th>Candidate</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Select.Date</th>
               
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($selected as $key => $val){?>
                <tr>
                    <td><?php echo $val['company_name'];?></td>
                    <td><?php echo $val['job_title'];?></td>
                     <td><?php echo $val['first_name'].$val['last_name'];?></td>
                    <td><?php echo $val['username'];?></td>
                    <td><?php echo $val['mobile'];?></td>
                    <td><?php echo $val['select_date'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>
<br />
<?php if(count($offer)>0){?>
<h3> My Offers </h3>
 <div class="tasks" style="border:1px solid #D3D3D3">
 
    <table>
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Job Title</th>
                <th>Candidate</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Offer Issued.Date</th>
               
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($offer as $key => $val){?>
                <tr>
                    <td><?php echo $val['company_name'];?></td>
                    <td><?php echo $val['job_title'];?></td>
                     <td><?php echo $val['first_name'].$val['last_name'];?></td>
                    <td><?php echo $val['username'];?></td>
                    <td><?php echo $val['mobile'];?></td>
                    <td><?php echo $val['offer_date'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>
<br />
<?php if(count($accepted)>0){?>
<h3>Offers Letter Accepted </h3>
 <div class="tasks" style="border:1px solid #D3D3D3">
 
    <table>
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Job Title</th>
                <th>Candidate</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Offer Accept.Date</th>
               
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($accepted as $key => $val){?>
                <tr>
                    <td><?php echo $val['company_name'];?></td>
                    <td><?php echo $val['job_title'];?></td>
                     <td><?php echo $val['first_name'].$val['last_name'];?></td>
                    <td><?php echo $val['username'];?></td>
                    <td><?php echo $val['mobile'];?></td>
                    <td><?php echo $val['offer_accepted_date'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>
</div>


</div>



</div>
</div>

</div>
</div>
</section>

<!--scripts-->
<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.stickyfooter.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/animate_jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/maps.googleapis.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/map.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.canvasjs.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>

<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
 
</script>
