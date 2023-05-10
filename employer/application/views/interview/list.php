<style>

th{
	font-weight:bold; font-family:Verdana, Geneva, sans-serif; 
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>
<?php if($this->input->get('ins')==1){?>  

<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> record added successfully.
</div>
<?php } ?> 

<?php if($this->input->get('update')==1){?>  
 <div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> record updated successfully.
</div>
<?php } ?>  
             
<?php if($this->input->get('del')==1){?> 
		<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>record deleted..</strong>
			</div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">

<div class="right-btns">
<?php /*?><a href="<?php echo base_url();?>index.php/company/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a><?php */?>
<!--<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>-->
</div>
<form id="searchForm" method="post" action="<?php echo $this->config->site_url()?>/interviews">
 <table class="tool-table">
    <tbody>
      
        <tr>
            <td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Job Title " value="<?php echo $searchterm != '' ? $searchterm: '' ;?>" style="width: 185px;"></td>
            <td><input class="form-control datepicker" type="text" name="from_date" id="from_date" placeholder="From Date" value="<?php echo $from_date != '' ? $from_date : '' ;?>" style="width: 185px;"></td>
            <td><input class="form-control datepicker" type="text" name="to_date" id="to_date" placeholder="To Date " value="<?php echo $to_date != '' ? $to_date : '' ;?>" style="width: 185px;"></td>
            
            <td>
            <input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" />
            </td>
        </tr>
      
    </tbody>
</table>           
</form>  

        
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/interviews/multidelete?rows=<?php echo $rows;?>" >        
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


<table class="tool-table new">
 <thead>
	<tr role="row" class="heading">
    	
     <th>Candidate Name</th>
        <th>Date</th>
        <th>Time</th>
		<th>Interview Type</th>	
        <th>Interview Status</th>	
        <th>Status</th>	
	</tr>

 </thead>
 <tbody>

  	<?php 
	if($records!=NULL)
	{
		foreach($records as $result){ ?>
                        
		<tr class="odd gradeX">
            <td title="<?php echo $result['job_title']?>"><?php echo $result['first_name'].' '.$result['last_name']?><br>UNIC-<?php echo $result['job_id']?></td>
            <td><?php if($result['interview_date']==0){echo '';}else{ echo date("d-m-Y", strtotime($result['interview_date']));}?></td>
            <td><?php echo $result['interview_time'];?></td>
            <td><?php echo $result['interview_type'];?></td>
            <td><?php echo $result['int_status_name'];?></td>
            <td><?php if($result['int_status']== 0) echo 'Scheduled';else if($result ['int_status']== 1) echo 'Selected'; else if($result ['int_status']== 2) echo 'Rejected';?></td>
            

	</tr>

	<?php
	}}else{?>
        <tr>
            <td colspan="8" align="center">
                No Records Founds!!
            </td>
        </tr>
	<?php } ?>
		
</tbody>

</table>


<?php echo $pagination; ?>
</form>                           

<br>

<?php

$monthNames = Array("January", "February", "March", "April", "May", "June", "July", 
"August", "September", "October", "November", "December");
?>
<?php
if (!isset($_REQUEST["month"])) $_REQUEST["month"] = date("n");
if (!isset($_REQUEST["year"])) $_REQUEST["year"] = date("Y");
?>
<?php
$cMonth = $_REQUEST["month"];
$cYear = $_REQUEST["year"];
 
$prev_year = $cYear;
$next_year = $cYear;
$prev_month = $cMonth-1;
$next_month = $cMonth+1;
 
if ($prev_month == 0 ) {
    $prev_month = 12;
    $prev_year = $cYear - 1;
}
if ($next_month == 13 ) {
    $next_month = 1;
    $next_year = $cYear + 1;
}
?>

<table width="1100" border=1>
<tr align="center">
<td bgcolor="#999999" style="color:#FFFFFF">
<table width="100%"  cellspacing="0" cellpadding="0" border=1>
<tr>
<td width="50%" align="left">  <a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" style="color:#FFFFFF">Previous</a></td>
<td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>" style="color:#FFFFFF">Next</a>  </td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="center">
<table width="100%"  cellpadding="2" cellspacing="2" border=1>
<tr align="center">
<td colspan="7" bgcolor="#999999" style="color:#FFFFFF"><strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong></td>
</tr>
<tr>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>M</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>W</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>F</strong></td>
<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>
</tr>
<?php 
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
echo "<br>";
for ($i=0; $i<($maxday+$startday); $i++) 
	{
	
    if(($i % 7) == 0 ) echo "<tr>";
    if($i < $startday) echo "<td></td>";
    else 
    {
			
			$dte=$cYear."-".sprintf("%02d",$cMonth)."-".sprintf("%02d",($i - $startday+1));

			$qry="SELECT a.job_title,a.job_id,b.job_app_id,b.candidate_id,c.interview_id,c.interview_date,c.interview_time,c.int_status,e.first_name,e.last_name,f.int_status_name,g.interview_type FROM pms_jobs a INNER JOIN pms_job_apps b on b.job_id=a.job_id INNER JOIN pms_job_apps_interviews c on c.job_app_id=b.job_app_id INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id LEFT JOIN pms_candidate_interview_status f on f.int_status_id=c.int_status_id LEFT JOIN pms_candidate_interview_types g on c.interview_type_id=g.interview_type_id ";
			
			$qry.=" where a.company_id=".$_SESSION['company_id'];
			$qry.=" and c.interview_date='".$dte."'";
			
			$res=$this->db->query($qry);
			$rest=$res->result();
			
			if(isset($rest) && !empty($rest))
			{
				echo "<td  align='center' style='padding:25px;' valign='middle' height='20px'><a href='#' class='btn btn-warning btn-xs'>". ($i - $startday + 1).'</a>';
				
				foreach($rest as $res)
				{
					echo '<br><a href="#" title="'.$res->job_title.' || '.$res->interview_time.' || '.$res->int_status_name.' || '.$res->interview_type.'" class="btn btn-info btn-xs">'.$res->first_name.' '.$res->last_name.'</a>';
				}
			}else
			{
				echo "<td  align='center' style='padding:25px;' valign='middle' height='20px'>". ($i - $startday + 1);
			}
		echo "</td>";
	
    }
    
    if(($i % 7) == 6 ) echo "</tr>";
	}
?>
</table>
</td>
</tr>
</table>


<div class="sep-bar">

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


<script>

$(document).ready(function()
{
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd"
	});

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
	$("#search").click(function(){
		var searchterm = $('#search_term').val(); 
		var rows = '<?php echo $rows;?>';
		window.location.href = '<?php echo $this->config->site_url();?>/interviews?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/interviews?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/interviews?limit='+limits;
	});
});
</script>
