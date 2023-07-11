<section>
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / <span>Dashboard</span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-2.png');?>" alt=""/><h3>summary</h3></div>
<div class="table-tech">
<table class="icon-table">
<tbody>
<tr>
<td><span class="total">Total Applications</span><br><span class="total-content"><?php echo $application_count;?></span></td>
<td><span class="total">Follow up</span><br><span class="total-content"><?php echo $follow_up_count;?></span></td>
<td><span class="total">Courses</span><br><span class="total-content"><?php echo $course_count;?></span></td>
<td><span class="total">Total Candidates</span><br><span class="total-content"><?php echo $candidate_count;?></span></td>
</tr>
</tbody>
</table>
</div>

<div class="gragh-area">
<div id="follow_up_graph"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
<br />
<br />
<div id="branchwiseProcess"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div><br />
<br /><br />
<div id="university_opted"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
<br /><br />
<div id="sales_branch"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div><br />
<br />

<div id="courses_opted"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
</div>


</div>
</div>
<div class="row">

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
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(followupHistory);
	  google.setOnLoadCallback(branchwiseProcess);
	  google.setOnLoadCallback(drawChart12);
	  google.setOnLoadCallback(salesInBranch);
	  google.setOnLoadCallback(coursesOpted);
	  
      function followupHistory() {
		  
	  var data = new google.visualization.DataTable(); 
      data.addColumn('string', 'cdate');
      data.addColumn('number', 'total');
	 
	data.addRows([
	<?php foreach($follow_up_history as $key => $val){?> ['<?php echo $val['flp_date']?>',   <?php echo $val['total']?>],<?php } ?>	
	]);
	  
        var options = {
		  aggregationTarget: 'category', // group values in x-axis
		 

          title: 'Follow up history', 
          hAxis: {showTextEvery: 122,
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

        var chart = new google.visualization.LineChart(document.getElementById('follow_up_graph'));
        chart.draw(data, options);
      }
	  


      function branchwiseProcess() {
		  
	  var data = new google.visualization.DataTable(); 

      data.addColumn('string', 'Date');
      data.addColumn('number', 'THIRUVANANTHAPURAM');
      data.addColumn('number', 'KOTTAYAM');
      data.addColumn('number', 'CALICUT');
	  data.addColumn('number', 'KOCHI');
	  data.addColumn('number', 'THRISSUR');
	  	 	 	 
	data.addRows([
	
	<?php foreach($all_branch_history as $key => $val){?> ['<?php echo $key;?>', <?php echo $val['THIRUVANANTHAPURAM']?>,<?php echo $val['KOTTAYAM']?>,<?php echo $val['CALICUT']?>, <?php echo $val['KOCHI']?>,  <?php echo $val['THRISSUR']?>], <?php } ?>	
		
	]);
	  
        var options = {
		  aggregationTarget: 'category', // group values in x-axis		 
		  chartArea: {left:100,top:60,width:'80%',height:'60%'},
          title: 'An overview of all followup in all branches',  
		  legend: { position: 'top' },
          hAxis: {showTextEvery: 54,
		  		 // title: 'Date',
          		  logScale: false	
				  },
		  vAxes: {0: {viewWindowMode:'explicit',
		  			  title: 'Follow up',
          			  logScale: false,
                      gridlines: {color: 'grey', count:6},
                      },
                  1: {gridlines: {color: 'transparent'},
				  		title: 'Total in all branches',
                      format:""},
                  },
 				series: {0: {lineWidth: 2, targetAxisIndex:0},
                  		 1:{lineDashStyle:[1,1], targetAxisIndex:0},
                  		 2:{lineDashStyle:[1,1], targetAxisIndex:0},
  						 3:{lineDashStyle:[1,1], targetAxisIndex:0},
					     4:{type:'area', lineDashStyle:[1,1], targetAxisIndex:1},
                 }, 
	           colors: ["red", "green", "orange","blue","purple"],
		  interpolateNulls : true,		  		  
        };

      var chart = new google.visualization.LineChart(document.getElementById('branchwiseProcess'));
      chart.draw(data, options); 
}


	function drawChart12() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', '--');
      data.addColumn('number', '--');
	data.addColumn({ type: 'string', role: 'annotation' });
      data.addRows([
	  <?php foreach($univ_opted as $key => $val){?> ['<?php echo $val['univ_name']?>',   <?php echo $val['total']?> ,  "<?php echo $val['total']?>"],<?php } ?>
	
      ]);

      var options = {
		  bar: {groupWidth: "90%"},
	  	legend:{position:'none'},
		width:1050,
        title: 'Report on Universities opted by candidates',
        hAxis: {
          title: 'University',
        },
        vAxis: {
		
		minValue: 90,
		maxValue: 110,
		gridlines:{
			count:8,
		},
          title: 'Number of Candidates'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('university_opted'));

      chart.draw(data, options);
    }

function salesInBranch() {
        var data = google.visualization.arrayToDataTable([		
         ['Branch', 'Total Candidates'],<?php foreach($sales_branch as $key => $val){?> ['<?php echo $val['branch_name']?>',   <?php echo $val['totalsale']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Number of inquiries in Branches',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('sales_branch'));
        chart.draw(data, options);
      }

function coursesOpted() {
        var data = google.visualization.arrayToDataTable([		
         ['Branch', 'Total Candidates'],<?php foreach($courses_opted as $key => $val){?> ['<?php if($val['course_name']!='')echo $val['course_name'];else echo 'Not Decided/Not Assinged';?> ',   <?php echo $val['total']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Courses Opted by Candidates',
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

        var chart = new google.visualization.PieChart(document.getElementById('courses_opted'));
        chart.draw(data, options);
      }
	  	  
</script>
