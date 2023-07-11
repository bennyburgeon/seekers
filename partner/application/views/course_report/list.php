<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<div class="sidebar-area inner-pages">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box2 sides">
<h4>About:</h4>
<p>Lorem ipsum dolor sit amet diam nonummy nibh dolore.</p>
<h4>Contact:</h4>
<ul>
<li>Company Name</li>
<li>+97 254 2563 889</li>
<li>214 5454 878</li>
<li>4th Avenue, 2nd Street</li>
<li>somebody@test.com</li>
<li><a href="#">www.website.in</a></li>
<li class="social-p">
<a href="#"><img src="<?php echo base_url('assets/images/p_icon8.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon9.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon10.png');?>"></a>
<a href="#"><img src="<?php echo base_url('assets/images/p_icon11.png');?>"></a>
</li>
</ul>
</div>

</div>
</div>

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/dasboard">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active">Courses </li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">



<form id="searchForm">
<table class="tool-table">
<tbody>
<tr>

</tr>
<!--</form>-->
</tbody>
</table>
<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit1">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
</div>
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>

<div style="clear:both;"></div>

<div id="branchwiseProcess"  style="height:300px;width:1100px;border:1px solid #D3D3D3"> </div>
<br>
<br>
<div class="tasks" style="border:1px solid #D3D3D3">
<table>
<thead>
<tr>
<th>No.</th>
<th>Task Title</th>
<th>Start Date</th>
<th>End Date</th>
<th>Status</th>
<th>Priority</th>
</tr>
</thead>
<tbody>

<?php foreach($records as $key => $val){?>


<tr>
<td>285</td>
<td>Testing from scratch pad</td>
<td>2016-02-16</td>
<td>2016-02-17</td>
<td>Open</td>
<td>Medium</td>
</tr>
<?php } ?>

</tbody>
</table>
</div>
</form>                           



<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit2">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
</div>
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>


<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script>

$(document).ready(function()
{
	$("#search").click(function(){
		var searchterm = $('#search_term').val(); 
		var rows = '<?php echo $rows;?>';
		window.location.href = '<?php echo $this->config->site_url();?>/course_report?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/course_report?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/course_report?limit='+limits;
	});
	
});


google.load("visualization", "1", {packages:["corechart"]});
	  
	  google.setOnLoadCallback(branchwiseProcess);


function branchwiseProcess() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', '--');
      data.addColumn('number', '--');
	data.addColumn({ type: 'string', role: 'annotation' });
      data.addRows([
	   ['Nelson Marlborough Institute of Technology (NMIT)',   47 ,  "47"], ['Kerala University of Health Sciences ',   39 ,  "39"], ['Queensland University of Technology',   28 ,  "28"], ['Queensland Institute of Business & Technology (QIBT)',   21 ,  "21"], ['Eynesbury College',   16 ,  "16"], ['Indian Institute of Science',   14 ,  "14"], ['Edenz College',   14 ,  "14"], ['Southern Cross University',   13 ,  "13"], ['Dr. M G R Educational and Research Institute University ',   12 ,  "12"], ['Hindustan Institute of Technology and Science (Hindustan University)',   10 ,  "10"], ['James Cook University',   10 ,  "10"], ['University of Mysore',   10 ,  "10"], ['Dr. N T R University of Health Sciences',   7 ,  "7"], ['University of Mumbai',   6 ,  "6"], ['Latrobe University',   4 ,  "4"],	
      ]);

      var options = {
		  bar: {groupWidth: "90%"},
	  	legend:{position:'none'},
		width:1050,
        title: 'Report on Universities opted by candidates [Top 15]',
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
        document.getElementById('branchwiseProcess'));

      chart.draw(data, options);
    }
	
</script>
