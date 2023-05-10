<section>
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / <span>Dashboard</span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-2.png');?>" alt=""/><h3>summary</h3></div>
<div class="table-tech">



</div>


<div class="gragh-area">

<?php if(count($applications_list)>0){
	?>

<?php foreach($applications_list as $apps_list => $apps){?>
    <h3><?php echo $apps['job_title'];?></h3> All Applications
 <div class="tasks" style="border:1px solid #D3D3D3">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($apps['apps_list'] as $key => $val){?>
                <tr>
                    <td><?php echo $val['reg_date'];?></td>
                    <td> <a target="_blank" href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $val['candidate_id']?>">
					<?php echo $val['first_name'];?></td>
                    <td><?php echo $val['username'];?></td>
                    <td><?php echo $val['mobile'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>
<?php }?>

<?php if(count($contract_details)>0){?>
<h3>Contract Details </h3>
 <div class="tasks" style="border:1px solid #D3D3D3">
    <table>
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Contract Start Date</th>
                <th>Contract End Date</th>
                <th>Total Experience</th>
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($contract_details as $key => $val){?>
                <tr>
                    
                    <td> <a target="_blank" href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $val['candidate_id']?>"><?php echo $val['first_name'];?>
                    </a></td>
                    <td><?php echo $val['username'];?></td>
                    <td><?php echo $val['mobile'];?></td>
                    <td><?php echo $val['start_date'];?></td>
                    <td><?php echo $val['end_date'];?></td>
                    <td><?php echo $val['total_exp'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>



<?php if(count($candidate_matches)>0){?>
<h3> Latest Candidate Matches </h3>
 <div class="tasks" style="border:1px solid #D3D3D3">
 
    <table>
        <thead>
            <tr>
                
               
                <th>Candidate</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Job Title</th>
               
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($candidate_matches as $key => $val){?>
                <tr>
                   <td> <a target="_blank" href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $val['candidate_id']?>">
				   <?php echo $val['first_name']. $val['last_name'];?></td>
                    <td><?php echo $val['username'];?></td>
                    <td><?php echo $val['mobile'];?></td>
                    <td><?php echo $val['job_title'];?></td>

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
  <script>
  $(function() {
    $( ".datepicker" ).datepicker();
  });
  </script>
<script src="<?php echo base_url('assets/js/custom.js');?>"></script>


<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.load("visualization", "1", {packages:["corechart"]});
</script>