<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">


<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/dasboard">Home</a> </li>
        <li class="active">Leave </li>
      </ul>
</div>

<?php if($this->input->get('ins')==1){?>                 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>record added successfully.
</div>
<?php } ?>

<?php if($this->input->get('del')==1){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>record deleted..</strong>
</div>
<?php }?>

<?php if($this->input->get('update')==1){?>  
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>record updated successfully.
</div>
<?php }?>

<?php if($this->input->get('status')==1){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Sucess !</strong>Status changed successfully..
</div>
<?php } ?> 

<?php if($this->input->get('del')==2){?> 
<div class="alert alert-success alert-dismissable">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong>Error!! <?php echo $_SESSION['related_module'] ?> exists under property</strong>
</div>
<?php } ?> 


<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/manage_leave/multidelete?rows=<?php echo $rows;?>" >

<div class="right-btns">
<a href="<?php echo base_url();?>index.php/manage_leave/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
</div>

<table class="tool-table">
<tbody>
<form id="searchForm">
<tr>
<td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Your Name" style="
    width: 185px;
"></td>

<td>
<a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
</td>
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
<table class="tool-table new">
<thead>
<tr>
<th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                         <th>
                         <a href="<?php echo $this->config->site_url();?>/manage_leave?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';}?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Name</a>
						 </th>
						 <th>From Date</th>
						  <th>To Date</th>
						  <th>Leave Type</th>
						  <th>Status</th>
						  <th>Approve</th>
						  <th>Approved By</th>
						  <th>Actions</th>
								
</tr>
</thead>
<tbody>
<?php 
		if($records!=NULL)
		  {
foreach($records as $result){ 
?>
		<tr>
			<td align="center"><input type="checkbox" name="checkbox[]"  class="checkboxes" value="<?php echo $result['leave_id']?>" ></td>
					<td><?php echo $result['firstname']?></td>
					<td><?php echo $result['date_from']?></td>
					<td><?php echo $result['date_to']?></td>
					<td><?php
					if($result['leave_type']==1){
						if($result['session_type']==1){ echo "Halfday (Morning)"; }
						else if($result['session_type']==2){ echo "Halfday (Afternoon)"; }
						 }
						else if($result['leave_type']==2){ echo "Fullday"; }
					//echo $result['leave_type']
					?>
					
					</td>
                    <td><?php if($result['leave_status']==1){ echo "Pending"; }
                    else if($result['leave_status']==2){ echo "Approved"; }
                    else if($result['leave_status']==3){ echo "Cancelled"; }
//                    echo $result['leave_status']$result['approved_by']
                    ?></td>
                    <td><?php if($result['leave_status']!=2){ ?><a href="<?php echo base_url();?>index.php/manage_leave/statchange/<?php echo $result['leave_id']?>"> Approve </a><?php } 
                    else echo "Approved"; ?></td>
                    <td><?php foreach($approved_by as $app)
                    {
						if($app->admin_id == $result['approved_by'])
						{
						echo $app->firstname;echo $app->lastname; 
						}
					}
                    //~ echo $result['fname']
                    ?></td>
                    
            <td>
             <a href="<?php echo base_url();?>index.php/manage_leave/edit/<?php echo $result['leave_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
			<a href="<?php echo base_url();?>index.php/manage_leave/delete/<?php echo $result['leave_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
		   </td>
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
</form>                           







<?php
//~ print_r($records);

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

<br/>
<br/>
<br/>
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
		echo "<td align='center' style='padding:25px;' valign='middle' height='20px'>". ($i - $startday + 1);
		
		
			$dte=$cYear."-".sprintf("%02d",$cMonth)."-".sprintf("%02d",($i - $startday+1));
			$qry="SELECT a.*, b.firstname, b.lastname FROM `pms_admin_leave` a, pms_admin_users b WHERE '$dte' >= date_from and '$dte' <= date_to and a.admin_id=b.admin_id and a.leave_status=2";
			$res=$this->db->query($qry);
			$rest=$res->result();
			if(isset($rest) && !empty($rest))
			{
				foreach($rest as $res)
				{
					echo "<br>".$res->firstname." ".$res->lastname;
				}
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
		window.location.href = '<?php echo $this->config->site_url();?>/manage_leave?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/manage_leave?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/manage_leave?limit='+limits;
	});
	
});
</script>
