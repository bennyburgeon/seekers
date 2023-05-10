<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Datepicker - Display month &amp; year menus</title>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/select2/select2.css"/>
<!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL STYLES  for editor-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-summernote/summernote.css">
<!-- END PAGE LEVEL STYLES for editor -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url();?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/css/plugins.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url();?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">


<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="<?php echo base_url();?>assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css">


<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/pages/css/todo.css"/>
<link href="<?php echo base_url();?>assets/admin/pages/css/timeline.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
<!-- BEGIN:File Upload Plugin CSS files-->

<!-- END:File Upload Plugin CSS files-->
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/admin/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>assets/admin/pages/css/inbox.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">


  
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 
</head>
<body>
 
<p>Date: <input type="text" class="datepicker" name="date_from"></p>
 <input type="hidden" name="image1" id='image1' value='' />
 

 
<div id="line_chart" style="width: 900px; height: 300px;"></div><br>




<div id="chart_div" style="display:none;" class="chart_div"></div>
<br>
<br>
<br>



<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
		  
	  var data = new google.visualization.DataTable(); 
      data.addColumn('date', 'cdate');
      data.addColumn('number', 'opens');
      data.addColumn('number', 'highs');
      data.addColumn('number', 'lows');
      data.addColumn('number', 'closes');
	  data.addColumn('number', 'settles');
	 
	 data.addRows([[new Date(2015-05-29),64.50,64.20,64.10,65.00,64.50],[new Date(2015-05-28),63.40,63.50,63.50,63.30,63.40],[new Date(2015-05-27),64.50,62.60,62.50,62.20,62.40],[new Date(2015-05-26),64.00,62.30,62.00,62.00,61.30],[new Date(2015-05-25),62.50,61.00,60.70,60.75,59.90],[new Date(2015-05-22),61.50,60.50,61.40,59.70,59.50],[new Date(2015-05-21),60.70,60.50,60.50,60.40,59.40],[new Date(2015-05-20),60.10,60.50,60.50,60.40,59.40],[new Date(2015-05-19),61.50,61.50,61.50,61.40,61.30],[new Date(2015-05-18),62.00,62.00,61.80,62.00,62.00],[new Date(2015-05-15),61.30,61.20,60.80,60.70,60.40],[new Date(2015-05-14),61.00,60.40,60.50,60.50,60.40],[new Date(2015-05-13),61.50,61.60,61.20,61.00,61.00],[new Date(2015-05-12),61.50,61.70,61.00,60.95,61.00],[new Date(2015-05-11),61.20,61.70,61.10,61.00,61.00],[new Date(2015-05-08),60.70,60.80,60.40,59.85,59.80],[new Date(2015-05-07),61.00,60.30,60.40,60.10,59.05],[new Date(2015-05-06),61.00,61.00,60.70,60.65,60.05],[new Date(2015-04-30),58.50,58.50,58.20,58.15,57.55],[new Date(2015-04-29),57.65,57.10,56.80,56.80,55.05],[new Date(2015-04-28),58.20,57.70,57.50,57.20,56.90],[new Date(2015-04-27),57.00,57.10,56.60,56.70,56.60],[new Date(2015-04-24),55.30,55.50,54.60,55.00,55.00],[new Date(2015-04-23),55.00,55.00,55.00,55.00,54.70],[new Date(2015-04-22),54.80,55.00,54.90,54.70,54.70],[new Date(2015-04-21),55.00,55.00,55.00,54.95,54.85],[new Date(2015-04-20),54.00,53.90,53.70,53.50,53.40],[new Date(2015-04-17),53.90,53.90,54.00,53.50,53.90],[new Date(2015-04-16),54.00,54.15,54.00,54.00,53.95],[new Date(2015-04-10),53.90,53.50,53.70,53.60,53.50]]);
 
//new Date(2015,00),300,350,280,110,160]
	  
         var options = {
		  aggregationTarget: 'category', // group values in x-axis
		 
		  chartArea: {left:20,top:0,width:'50%',height:'75%'},
          title: 'Title Goes Here', 
          hAxis: {showTextEvery: 1,
		  		  title: 'Date - hAxis',
          		  logScale: false	
				  },
          vAxes: {0: {viewWindowMode:'explicit',
		  			  title: 'Date',
          			  logScale: false,
                      gridlines: {color: 'grey'},
                      },
                  1: {gridlines: {color: 'yellow'},
				  		title: 'Count',
                      format:""},
                  },
          series: {0: {type:'bars',targetAxisIndex:0},
                   1:{type:'line',targetAxisIndex:0},
                   2:{type:'scatter',targetAxisIndex:0},
				   3:{type:'radar',targetAxisIndex:0},
				   4:{type:'area',targetAxisIndex:1},
                  },
          colors: ["red", "green", "orange","blue","purple","yellow"],
          chartArea:{left:100,top:100, width:700, height:150},
        };

      var chart = new google.visualization.ComboChart(document.getElementById('line_chart'));

	// Wait for the chart to finish drawing before calling the getImageURI() method.
      google.visualization.events.addListener(chart, 'ready', function () 
	  {
		$('#image1').val(chart.getImageURI());
		send_details('image1','image1');
      });
	  	  
        chart.draw(data, options);
      }

function send_details(chartNum,chartHolder)
{
   $.ajax({
      type: "post",
		url: "<?php echo site_url('test'); ?>/image_create",
		cache: false,
		data: chartNum+"="+encodeURIComponent($('#'+chartHolder).val())+"&chartnum="+chartNum,
		success: function(json){						
		try{
			//window.open('<?php echo site_url();?>/wkly_reports/output_pdf','myWindow');
		}catch(e) {		
			alert('Exception occured on pdf generation.');
		}
		},
		error: function(){
			alert('An Error has been found on Ajax request on pdf generation');
		}
   });

}
</script>

 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>
  $(function() {
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  dateFormat: "yy-mm-dd"
    });
  });
  </script>
  
  <?php echo $pagination;?>
  
</body>
</html>