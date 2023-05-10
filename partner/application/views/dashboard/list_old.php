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
                <td><span class="total">Offer Letters</span><br>
                  <span class="total-content"><?php echo $offer_letters;?></span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="gragh-area"> 
          <!-- 
<?php if(count($latest_leads_list)>0){?>
 <div class="tasks" style="border:1px solid #D3D3D3">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Company</th>
                <th>Created by</th>
                <th>Contact Name</th>
                <th>Telephone</th>
                <th>Designation</th>
            </tr>
            </thead>
           
            <tbody>
            	<?php foreach($latest_leads_list as $key => $val){?>
                <tr>
                    <td><?php echo $val['date_added'];?></td>
                    <td><?php echo $val['company_name'];?></td>
                    <td><?php echo $val['firstname'];?></td>
                    <td><?php echo $val['contact_name'];?></td>
                    <td><?php echo $val['contact_phone'];?></td>
                    <td><?php echo $val['designation'];?></td>
                </tr>
                <?php } ?>
            
            
        </tbody>
    </table>
</div><br />
<?php }?>
-->
<div id="report_based_on_package"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
              <br />
              <div id="job_process_summary"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
              <br />
          <div id="total_jobs_industry_based"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <div id="total_jobs_functional_based"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <div id="total_jobs_designation_based"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <div id="candidate_profile_collection"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <div id="cur_job_status_summary"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <div id="cv_source_summary"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
          <br />
          <div id="candidate_to_industry"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
          <br />
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
          title: 'Job Status Summary',
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
