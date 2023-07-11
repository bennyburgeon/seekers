<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>

<?php  if($this->input->get('csv')==1){ ?> 
    <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>csv file uploaded successfully.
    </div>
<?php }?>

<?php if($this->input->get('upload_err')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>upload failed.</strong>
    </div>
<?php }?>

<?php if($this->input->get('file_type_err')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>support csv file only.</strong>
    </div>
<?php }?>

 <?php if($this->input->get('ins')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Sucess !</strong>record added successfully.
                </div>
                 <?php } 
                 if($this->input->get('multi')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Records !</strong>record added successfully.
                </div>
                
              <?php } 
			   if($this->input->get('del')==1){?> 
			   <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>record deleted..</strong>
                </div>
			         <?php }
					 
					 if($this->input->get('upd')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Sucess !</strong>record updated successfully.
                </div>
              <?php }?>
				

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">


<div class="right-btns">

<!-- 

<a href="<?php echo base_url();?>index.php/jobs_flp/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>

|| 
<a href="<?php echo base_url();?>index.php/jobs_flp/import_csv" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Import CSV</a>

 
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
-->

</div>
<form id="searchForm" action="" method="get" name="searchForm">
<table class="tool-table">
<tbody>


<tr>
<td width="30%"><?php echo form_dropdown('admin_id', $bde_list , $admin_id,'style="width:100px;" class="form-control"  id="admin_id" ');?> </td>
<td width="30%"><?php echo form_dropdown('candidate_id', $candidate_list , $candidate_id,'style="width:150px;" class="form-control"  id="candidate_id" ');?></td>
<td width="30%"><?php echo form_dropdown('job_id', $jobs_list , $job_id,'style="width:100px;" class="form-control"  id="job_id" ');?></td>
<td width="15%"><?php echo form_dropdown('company_id', $company_list , $company_id,'style="width:200px;" class="form-control"  id="company_id" ');?></td>

<td width="15%"><input type="text" style="width:100px;" id="call_date_from" class="form-control p m-ctrl-medium date-picker" name="call_date_from" value="<?php echo $call_date_from; ?>" placeholder="Date From" /></td>

<td width="10%">
  <input type="text" style="width:100px;" id="call_date_to" class="form-control p m-ctrl-medium date-picker" name="call_date_to" value="<?php echo $call_date_to; ?>" placeholder="Date To" />
</td>
<td width="10%">
  <a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
</td>
</tr>


</tbody>
</table>
</form>
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
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/jobs_flp/multidelete?rows=<?php echo $rows;?>" >
<table class="tool-table new">
<thead>
								<tr role="row" class="heading">
<th width="33"><div class="checker">BDE</div></th>
                                        <th width="267">Flp/ Notes</th>
                                        <th width="169">Job</th>
                                        <th width="171">Candidate</th>
                                    <th width="68">Call Date</th>
                                    <th width="124">Recruiter</th>
                                    <th width="203">Present Status</th>
                                   
                                </tr>
</thead>
<tbody>

<?php 		
if($records!=NULL)
{
	foreach($records as $result){ ?>
		<tr class="odd gradeX">
			<td>#</td>
			<td>
			  <?php echo $result['call_notes']?><br> 
			  History:<a href="javascript:;" title="Get last history" onclick="get_calls_history(<?php echo $result['app_id'];?>);"  id="get_calls_job_app" class="btn btn-info btn-xs"> [View]</a><br>
			  </td>
			<td><?php echo $result['job_title']?></td>
			<td><?php echo $result['first_name']?></td>
<td>
  
  <?php echo $result['call_date']?></td>
            <td><?php echo $result['recruiter']?></td>
            <td><?php echo $result['job_status']?></td>
            
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


<div class="modal fade" id="content_history" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br><h3>History</h3>
        <div id="show_followup_history"></div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div style="clear:both;"></div>
</div>

<!-- Graph Data --> <br>
<br>

<div style="clear:both;"></div>
<div id="bde_calls_list"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
<br />

<div id="call_status_summary"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
<br />


<div id="followup_history"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
<br />

<div id="process_status_percentage"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div><br />
<br />

<div id="job_process_summary"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
<br />

<!-- Graph Data --> 




</div>


</div>



</div>




</section>
</div>


<script>

$(document).ready(function()
{

	$('#selectall').click(function(event)
	{  
		if(this.checked) 
		{ 
		$('.checkboxes').each(function() { 
		this.checked = true; 
		});
		}else{
		$('.checkboxes').each(function() { 
		this.checked = false;  
		});        
		}
	});
	
	$("#deleteall").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a data to delete.");
		return false;
		}
		if(count_checked >0) {
		if(confirm('Are You Sure?Delete Multiple Item')){
		$('#form1').submit();
		}
		}
	});
	
	$("#search").click(function()
	{
		$('#searchForm').submit(); 
	});
	
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/jobs_flp?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/jobs_flp?limit='+limits;
	});
	
});
</script>

<script type="text/javascript">

$('input[type=text]').addClass('form-control');
/* interview related function modal window, add form, edit form etc. */

function add_calls(app_id)
{
	$('#app_id').val(app_id);
    $('#calls_modal').modal();
}

function add_jobs(app_id)
{
	$('#jobs_company_id').val(app_id);
    $('#jobs_modal').modal();
}

function get_calls_history(app_id){
	
	$('#show_followup_history').html('');	
	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/jobs_flp/get_calls_history/",
			data: $('#calls_form').serialize(),
			method: "POST",
  			data: { app_id : app_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_followup_history').html(data);
			}
			
		});
    $('#content_history').modal();
}

function call_validate() 
{
		if($('#flp_notes').val()=='')
		{
			alert('Enter some text');
			$('#flp_notes').focus();
			return false;
		}   
	    return true;
    }

function job_validate() 
{
		if($('#job_title').val()=='')
		{
			alert('Job Title');
			$('#job_title').focus();
			return false;
		} 
		if($('#job_desc').val()=='')
		{
			alert('Job Description');
			$('#job_desc').focus();
			return false;
		} 		  
	    return true;
    }
	
$(document).on('click', '#save_calls', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

		var isCallValid = call_validate();
		if(isCallValid==false)
		{
			return false;	
		}
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#calls_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#calls_modal').modal('hide');					
					location.reload();
					$("#calls_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

$(document).on('click', '#save_jobs', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

		var isCallValid = job_validate();
		if(isCallValid==false)
		{
			return false;	
		}
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#jobs_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){	
				 alert('Job added successsfully');
				 $('#jobs_modal').modal('hide');					
				//	location.reload();
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});
	
$('.datepicker').datepicker({
		format : "yyyy-mm-dd",
        autoclose: true,
        todayBtn: true,
        todayHighlight: true
});

$(document).ready(function(){
	$('#call_date_from').datepicker({
		dateFormat: "yy-mm-dd"
	});
	$('#call_date_to').datepicker({
		dateFormat: "yy-mm-dd"
	});
});

function assign_requirement(app_id)
{
	$('#assign_company_id').val(app_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/jobs_flp/assign_requirement/?app_id="+app_id,
			data: $('#assignment_form').serialize(),
			method: "POST",
  			data: { app_id : app_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#data_holder').html(data);
			}
		});
    $('#assignment_modal').modal();		
}

$(document).on('click', '#save_assignment_button', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success')
				 {	
					$('#assignment_modal').modal('hide');	
					alert('Updated...');				
					$("#assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

</script>

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
	  
      google.setOnLoadCallback(followup_history);
	  google.setOnLoadCallback(process_status_percentage);
	  google.setOnLoadCallback(bde_to_lead_collection);
	  google.setOnLoadCallback(call_status_summary);
	  google.setOnLoadCallback(job_process_summary);
	 
function bde_to_lead_collection() {
       var data = google.visualization.arrayToDataTable([		
         ['Lead Status Name', 'Total'],<?php foreach($bde_calls_list as $key => $val){?> ['<?php if($val['total_leads']!='')echo $val['firstname'];else echo 'NA';?> ',   <?php echo $val['total_leads']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Calls by BDEs',
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('bde_calls_list'));
        chart.draw(data, options);
	        }
			
function call_status_summary() 
{
       var data = google.visualization.arrayToDataTable([		
         ['BDEs', 'Total'],<?php foreach($call_status_summary as $key => $val){?> ['<?php if($val['total_count']>0)echo $val['status'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Call Status Summary',
        };

        var chart = new google.visualization.PieChart(document.getElementById('call_status_summary'));
        chart.draw(data, options);
	        }

function followup_history() 
{
		  
	  var data = new google.visualization.DataTable(); 
      data.addColumn('string', 'cdate');
      data.addColumn('number', 'total');
	 
	data.addRows([
	<?php foreach($followup_history as $key => $val){?> ['<?php echo $val['call_date']?>',   <?php echo $val['total']?>],<?php } ?>	
	]);
	  
        var options = {
		  aggregationTarget: 'category', // group values in x-axis
		 

          title: 'All Calls History-Total Calls Per Day', 
          hAxis: {showTextEvery: 4,
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

        var chart = new google.visualization.LineChart(document.getElementById('followup_history'));
        chart.draw(data, options);
}

function process_status_percentage() 
{
        var data = google.visualization.arrayToDataTable([		
         ['Status', 'Total Count'],<?php foreach($process_status_percentage as $key => $val){?> ['<?php if($val['process_category']!='')echo $val['process_category'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Conversion - From Application to Invoice - Percentage',
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

        var chart = new google.visualization.PieChart(document.getElementById('process_status_percentage'));
        chart.draw(data, options);
}

  	  	    

  function job_process_summary() {
       var data = google.visualization.arrayToDataTable([		
         ['Industry', 'Total'],<?php foreach($job_process_summary as $key => $val){?> ['<?php if($val['process_category']!='')echo $val['process_category'];else echo 'Not Set';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Conversion - From Application to Invoice - Numbers',
          pieHole: 0.4,
        };

        var chart = new google.visualization.BarChart(document.getElementById('job_process_summary'));
        chart.draw(data, options);
      }	
	  
</script>

  
  
  