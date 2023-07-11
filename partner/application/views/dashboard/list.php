<?php ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<div class="sidebar-area inner-pages">
  <div style="background-color: #2980b9; color: #f7f7f7; font-size: 14px; padding: 5px;" class="side-btn">Client Feedback</div>
  <div class="sidebar-2">
    <div class="profile_box2 sides">
      <h4>Client Feedback</h4>
      <table width="100%" border="0">
        <?php  if($client_feedback!='') { ?>
        <?php foreach($client_feedback as $key => $val) {  ?>
        <?php  if($val["client_notes"]!=NULL) { ?>
        <tr>
          <th width="20%">Date:</th>
          <td width="80%"><?php echo $val["feedback_date"]; ?></td>
        </tr>
        <tr>
          <th width="20%">Client:</th>
          <td width="80%"><?php echo $val["company_name"]; ?></td>
        </tr>
        <tr>
          <th width="20%">Feedback:</th>
          <td width="80%"><?php echo $val["client_notes"]; ?></td>
        </tr>
        <tr>
          <td colspan="2">---------------------------------------</td>
        </tr>
        <?php } ?>
        <?php }
	  } else{ ?>
        <tr>
          <td colspan="3" align="center"> No Fedbacks Found !! </td>
        </tr>
        <?php  }?>
      </table>
      <br>
    </div>
  </div>
</div>
<?php  ?>
<section>
  <div class="section-wrap">
    <div class="row">
      <div class="col-sm-12 pages">Home / <span>Dashboard</span></div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-2.png');?>" alt=""/>
          <h3>summary</h3>
        </div>
        <div class="table-tech">
          <table class="icon-table">
            <tbody>
              <tr>
                <td><span class="total">Total Candidates</span><br>
                  <span class="total-content"><?php echo $candidate_count;?></span></td>
                <td><span class="total">Total Job Apps</span><br>
                  <span class="total-content"><?php echo $application_count;?></span></td>
                <td><span class="total">Interviews</span><br>
                  <span class="total-content"><?php echo $total_interviews;?></span></td>
                <td><span class="total">Offer Lettes</span><br>
                  <span class="total-content"><?php echo $offer_letters;?></span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="gragh-area"> 
          
          <!--<div id="report_based_on_package"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
              <br />-->
          <div id="job_process_summary"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <!--<div id="total_jobs_industry_based"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <div id="total_jobs_functional_based"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <div id="total_jobs_designation_based"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />-->
          <div id="candidate_profile_collection"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <div id="cur_job_status_summary"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <!--<div id="cv_source_summary"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />--> 
          <br />
          <!-- <div id="candidate_to_industry"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />-->
          <?php /* if(count($latest_tasks)>0){?>
          <h3>My Tasks</h3>
          <div class="tasks" style="border:1px solid #D3D3D3">
            <table>
              <thead>
                <tr>
                  <th>Task Title</th>
                  <th>Priority</th>
                  <th>Status</th>
                  <th>Start Date</th>
                  <th>Due Date</th>
                  <th>Due Days</th>
                  <th>Last Flp Dt.</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($latest_tasks as $key => $result){?>
                <tr>
                  <td><?php if($result['lead_opportunity']==1){echo '<p style="color:#5BEF00">';}?>
                    <?php if($result['lead_opportunity']==2){echo '<p style="color:#2000F3">';}?>
                    <?php if($result['lead_opportunity']==3){echo '<p style="color:#F90000">';}?>
                    <?php if($result['lead_opportunity']==0){echo '<p style="color:##000">';}?>
                    <?php echo $result["task_title"]; ?>
                    </p></td>
                  <td><?php if($result["task_priority_id"]==1){ echo '<font color="#FF0000">'; echo $result["task_priority_name"];echo '</font>';}else{echo $result["task_priority_name"];} ?></td>
                  <td><?php echo $result["task_status_name"]; ?></td>
                  <td><?php if($result["start_date"]!='0000-00-00')echo date('d M',strtotime ($result["start_date"]));else echo 'Na';?></td>
                  <td><?php if($result["due_date"]!='0000-00-00')echo date('d M',strtotime ($result["due_date"]));else echo 'Na';?></td>
                  <td><?php if($result["flp_date_diff"]<0){?>
                    <font color="#FF0000"><b><?php echo $result["flp_date_diff"];?></b></font>
                    <?php }else{?>
                    <?php echo $result["flp_date_diff"];?>
                    <?php } ?></td>
                  <td><?php if($result["last_flp_date"]!=''){echo date('d M',strtotime ($result["last_flp_date"]));}else echo 'No Update';?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <br />
          <?php } */?>
          <?php if(count($my_latest_jobs)>0){?>
          <h3>Latest Jobs</h3>
          <div class="my_jobs" >
            <table class="tool-table new" width="100%">
              <thead>
                <tr role="row" class="heading">
                  <th width="5%"><div class="checker"><span>#<!-- <input type="checkbox" class="group-checkable" id="selectall">--></span></div></th>
                  <th width="25%">Job Title</a></th>
                  <th width="25%">Company</a></th>
                  <th width="15%">Posted On</th>
                  <th width="15%">Expires</th>
                </tr>
              </thead>
              <tbody>
                <?php 
			  $i=0;
	if($my_latest_jobs!=NULL)
	{
		foreach($my_latest_jobs as $result){ 
		$i+=1;
		?>
                <tr class="odd gradeX">
                  <td><?php echo $i; ?></td>
                  <td><span style="color:#6575e8;"><?php echo $result['job_title']?></span></td>
                  <td><?php echo $result['company_name'];?></td>
                  <td><?php echo ($result['job_post_date']!='0000-00-00' && $result['job_post_date']!='') ? date('d-m-Y', strtotime($result['job_post_date'])) : '';?></td>
                  <td><?php echo ($result['job_expiry_date']!='0000-00-00' && $result['job_expiry_date']!='') ? date('d-m-Y', strtotime($result['job_expiry_date'])) : '';?></td>
                </tr>
                <?php
	}}else{?>
                <tr>
                  <td colspan="9" align="center"> No Records Founds!! </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <br />
          <?php }?>
<?php if(count($latest_interviews)>0){?>
          <h3>Interviews Scheduled - This Week From <span style="color:#2980b9;"><?php echo $start_date?></span> to <span style="color:#2980b9;"><?php echo $end_date?></span> </h3>
          <div class="tasks" style="border:1px solid #D3D3D3">
            <table>
              <thead>
                <tr>
                  <th width="75">Job ID</th>
                  <th width="75">Job Title</th>
                  <th width="75">Interview On</th>
                  <th width="68">Candidate</th>
                  <th width="37">CTC</th>
                  <th width="85">Expected</th>
                  <th width="44">Notice</th>
                  <th width="55">Total Exp.</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($latest_interviews as $key => $val){?>
                <tr>
<td><?php echo $this->config->item('job_prefix'); ?>-<?php echo $val['job_id'];?></td>
<td><a target="_blank" class="btn btn-warning btn-xs" href="<?php echo base_url(); ?>my_jobs/manage/<?php echo $val['job_id'];?>"><?php echo $val['job_title'];?></a></td>
                  <td><?php echo ($val['interview_date']!='0000-00-00' && $val['interview_date']!='') ? date('d-m-Y', strtotime($val['interview_date'])) : '';?></td>
                  
                  <td><a href="<?php echo $this->config->item('client_cv_preview');?><?php echo md5($val['candidate_id']); ?>" title="View Profile" target="_blank"><?php echo $val['first_name'];?></a></td>
                  <td><?php echo  $this->config->item('currency_symbol');?>
                    <?php if(isset($val['current_ctc'])) echo number_format((double)$val['current_ctc'],2);else echo '0.00';?>
                    / Yr. </td>
                  <td><strong><?php echo  $this->config->item('currency_symbol');?>
                    <?php if(isset($val['expected_ctc'])) echo number_format((double)$val['expected_ctc'],2);else echo '0.00';?>
                    / Yr. </strong></td>
                  <td><strong><?php echo $val['notice_period'];?> Days</strong></td>
                  <td><?php echo $val['total_experience'];?> Yrs.</td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
          <br />
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
	  
	 // google.setOnLoadCallback(branchwiseProcess);
	  google.setOnLoadCallback(job_process_summary);
	 
      google.setOnLoadCallback(report_based_on_package);

	  google.setOnLoadCallback(cv_source_summary);
	  
	  google.setOnLoadCallback(total_jobs_industry_based);
	  
	  google.setOnLoadCallback(total_jobs_functional_based);
	  
	  google.setOnLoadCallback(total_jobs_designation_based);
	  
	  google.setOnLoadCallback(candidate_profile_collection);	  
	  
	  google.setOnLoadCallback(cur_job_status_summary);
	  
	  google.setOnLoadCallback(candidate_to_industry);
	  
      function total_jobs_industry_based() {
       var data = google.visualization.arrayToDataTable([		
         ['Industry', 'Total'],<?php foreach($total_jobs_industry_based as $key => $val){?> ['<?php if($val['total_count']!='')echo $val['job_cat_name'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Total jobs from Industry',
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('total_jobs_industry_based'));
        chart.draw(data, options);
	        }

	  function total_jobs_functional_based() {
       var data = google.visualization.arrayToDataTable([		
         ['Functional Area', 'Total'],<?php foreach($total_jobs_functional_based as $key => $val){?> ['<?php if($val['total_count']!='')echo $val['func_area'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Total jobs from Functional Area',
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('total_jobs_functional_based'));
        chart.draw(data, options);
	        }
			
	  function total_jobs_designation_based() {
       var data = google.visualization.arrayToDataTable([		
         ['Functional Area', 'Total'],<?php foreach($total_jobs_designation_based as $key => $val){?> ['<?php if($val['total_count']!='')echo $val['desig_name'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Total jobs from Designation',
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('total_jobs_designation_based'));
        chart.draw(data, options);
	        }
			
	      function cur_job_status_summary() {
       var data = google.visualization.arrayToDataTable([		
         ['Job Status', 'Total'],<?php foreach($cur_job_status_summary as $key => $val){?> ['<?php if($val['total_count']>0)echo $val['status'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Candidate\'s Availability Report',
        };

        var chart = new google.visualization.PieChart(document.getElementById('cur_job_status_summary'));
        chart.draw(data, options);
	        }

function candidate_profile_collection() 
{
	  var data = new google.visualization.DataTable(); 
      data.addColumn('string', 'cdate');
      data.addColumn('number', 'total');
	 
	data.addRows([
	<?php foreach($candidate_profile_collection as $key => $val){?> ['<?php echo $val['reg_date']?>',   <?php echo $val['total_nos']?>],<?php } ?>	
	]);
	  
        var options = {
		  aggregationTarget: 'category', // group values in x-axis
          title: 'Candidate Data Base Collection - Date Based Report', 
          hAxis: {showTextEvery: 10,
		  		  title: 'Date',
          		  logScale: false	
				  },
          vAxes: {0: {viewWindowMode:'explicit',
		  			  title: 'Total',
          			  logScale: false,
                      gridlines: {color: 'grey', count:6},
                      },
                  1: {gridlines: {color: 'transparent'},
				  	//	title: 'Count',
                      format:""},
                  },
          colors: ["red", "green", "orange","blue"],
          chartArea: {left:100,top:60,width:'85%',height:'60%'},
 		  legend: { position: 'none' },
		  interpolateNulls : true,		  		  
        };
        var chart = new google.visualization.LineChart(document.getElementById('candidate_profile_collection'));
        chart.draw(data, options);
      }
	  
	  
function cv_source_summary() {
        var data = google.visualization.arrayToDataTable([		
         ['Status', 'Total Count'],<?php foreach($cv_source_summary as $key => $val){?> ['<?php if($val['lead_source']!='')echo $val['lead_source'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'CV Source Summary',
          is3D: true,
		  slices: {  4: {offset: 0.2},
                    12: {offset: 0.3},
                    14: {offset: 0.4},
                    15: {offset: 0.5},
					18: {offset: 0.7},
					22: {offset: 0.6},
					25: {offset: 0.9},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('cv_source_summary'));
        chart.draw(data, options);
      }

  	  	    

  function candidate_to_industry() {
       var data = google.visualization.arrayToDataTable([		
         ['Industry', 'Total'],<?php foreach($candidate_to_industry as $key => $val){?> ['<?php if($val['job_cat_name']!='')echo $val['job_cat_name'];else echo 'Not Set';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Summary - Candidate to Industry',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('candidate_to_industry'));
        chart.draw(data, options);
      }
	  
	  
	  
 function report_based_on_package() {

       var data = google.visualization.arrayToDataTable([		

         ['Job Status', 'Total'],<?php foreach($report_based_on_package as $key => $val){?> ['<?php if($val['total_count']>0)echo $val['status'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>

		 ]);

        var options = {

          title: 'Package based Summary',

        };
  var chart = new google.visualization.PieChart(document.getElementById('report_based_on_package'));

        chart.draw(data, options);

	        }
			
			
	function job_process_summary() {

       var data = google.visualization.arrayToDataTable([		

         ['Job Status', 'Total'],<?php foreach($job_process_summary as $key => $val){?> ['<?php if($val['total_count']>0)echo $val['status'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>

		 ]);

        var options = {

          title: 'Job Process Summary',

        };
  var chart = new google.visualization.PieChart(document.getElementById('job_process_summary'));

        chart.draw(data, options);

	        }
	  			

	  
</script> 
