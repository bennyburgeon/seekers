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
    <strong>Sucess !</strong>csv file uploaded successfully. </div>
  <?php }?>
  <?php if($this->input->get('upload_err')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>upload failed.</strong> </div>
  <?php }?>
  <?php if($this->input->get('file_type_err')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>support csv file only.</strong> </div>
  <?php }?>
  <?php if($this->input->get('ins')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>record added successfully. </div>
  <?php } 
                 if($this->input->get('multi')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Records !</strong>record added successfully. </div>
  <?php } 
			   if($this->input->get('del')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>record deleted..</strong> </div>
  <?php }
					 
					 if($this->input->get('upd')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>record updated successfully. </div>
  <?php }?>
  <div class="row">
    <div class="col-sm-12">
      <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/>
        <h3><?php echo $page_head;?></h3>
      </div>
      <div class="table-tech specs">
        <div class="right-btns"> 
          
          <!-- 

<a href="<?php echo base_url();?>index.php/candidates_summary/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>

|| 
<a href="<?php echo base_url();?>index.php/candidates_summary/import_csv" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Import CSV</a>

 
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
--> 
          
        </div>
        <form id="searchForm" action="" method="get" name="searchForm">
          <table class="tool-table">
            <tbody>
              <tr>
                <td width="70%"><input class="form-control" type="text" name="search_name" id="search_name" value="<?php echo $search_name;?>" placeholder="Name" style="width: 300px;"></td>
                <td width="30%"><a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a> <a style="height: 28px; padding: 5px; margin-left: 12px;" href="<?php echo base_url(); ?>index.php/candidates_summary" id="clear_search" class="btn btn-primary btn-xs">Clear Search</a></td>
              </tr>
            </tbody>
          </table>
        </form>
        <div class="sep-bar">
          <div class="page"> <?php echo $pagination; ?> </div>
          <div class="views_section"> 
            <!--<div class="view-drop"> <span>View</span>
                <select class="form-control drop" id="sel_limit2">
                  <option>Select</option>
                  <option>5</option>
                  <option>10</option>
                </select>
                <span>Records</span> </div>-->
            <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div style="clear:both;"></div>
        <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/candidates_summary/multidelete?rows=<?php echo $rows;?>" >
          <table class="tool-table new">
            <thead>
              <tr role="row" class="heading">
                <th width="79">Registered On</th>
                <th width="110">Candidate</th>
                <th width="150">Job Name</th>
                <th width="107">Mobile</th>
                <th width="60">Profile Status</th>
              </tr>
            </thead>
            <tbody>
              <?php 		
if($records!=NULL)
{
	foreach($records as $result){ ?>
              <tr class="odd gradeX">
                <td><?php echo $result['reg_date']?></td>
                <td title=""><strong> <font color="#3366CC"> <?php echo $result['first_name']?></a><br>
                  </font> </strong> <br></td>
                  <td><?php echo $result['job_title']; ?></td>
                <td><?php echo $result['mobile']?></td>
                
                <!-- <progress style="font-size: 13px; height:15px;" value="<?php echo $result['reg_status'];?>" max="9" ></progress>-->
                <td><progress  style="font-size: 14px; height:15px;" value="<?php if($result['app_status_id']>1)echo $result['app_status_id'];else echo '1';?>" max="9" ></progress>
                  <br><?php echo $result['status_name'];?></td>
              </tr>
              <?php
		}}else{?>
              <tr>
                <td colspan="8" align="center"> No Records Founds!! </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </form>
        <div class="sep-bar">
          <div class="page"> <?php echo $pagination; ?> </div>
          <div class="views_section"> 
            <!--<div class="view-drop"> <span>View</span>
                <select class="form-control drop" id="sel_limit2">
                  <option>Select</option>
                  <option>5</option>
                  <option>10</option>
                </select>
                <span>Records</span> </div>-->
            <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
          </div>
        </div>
        <div style="clear:both;"></div>
        <div class="modal fade" id="content_history" role="dialog" aria-labelledby="enquiry-modal-label">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <br>
                <h3>History</h3>
                <div id="show_followup_history"></div>
                
                <!-------------------------modal1 end------------------------------->
                <div style="clear:both;"></div>
              </div>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div>
      </div>
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
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_summary?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_summary?limit='+limits;
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


function call_validate() {
		
		if($('#flp_notes').val()=='')
		{
			alert('Enter some text');
			$('#flp_notes').focus();
			return false;
		}   
	    return true;
    }

function job_validate() {
		
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


function assign_requirement(app_id)
{
	$('#assign_company_id').val(app_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_summary/assign_requirement/?app_id="+app_id,
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
<script src="<?php echo base_url('assets/js/custom.js');?>"></script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});

	  google.setOnLoadCallback(process_status_percentage);
	


function process_status_percentage() 
{
        var data = google.visualization.arrayToDataTable([		
         ['Status', 'Total Count'],<?php foreach($process_status_percentage as $key => $val){?> ['<?php if($val['status_name']!='')echo $val['status_name'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Candidates Status',
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
	  	    


</script> 
