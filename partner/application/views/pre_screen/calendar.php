<!-- Canlendar start here --> 
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

			$qry="SELECT a.first_name,a.candidate_id,b.job_app_id,b.candidate_id,c.interview_id,c.pre_screen_date,c.interview_time,c.int_status,e.first_name,e.last_name,f.int_status_name,g.interview_type FROM pms_jobs a INNER JOIN pms_job_apps b on b.candidate_id=a.candidate_id INNER JOIN pms_job_pre_screening c on c.job_app_id=b.job_app_id INNER JOIN pms_candidate e on b.candidate_id=e.candidate_id LEFT JOIN pms_candidate_interview_status f on f.int_status_id=c.int_status_id LEFT JOIN pms_candidate_interview_types g on c.interview_type_id=g.interview_type_id ";
			
			//$qry.=" where a.company_id=".$_SESSION['company_id'];
			$qry.=" and c.pre_screen_date='".$dte."'";
			
			$res=$this->db->query($qry);
			$rest=$res->result();
			
			if(isset($rest) && !empty($rest))
			{
				echo "<td  align='center' style='padding:25px;' valign='middle' height='20px'><a href='#' class='btn btn-warning btn-xs'>". ($i - $startday + 1).'</a>';
				
				foreach($rest as $res)
				{
					echo '<br><a href="#" title="'.$res->first_name.' || '.$res->interview_time.' || '.$res->int_status_name.' || '.$res->interview_type.'" class="btn btn-info btn-xs">'.$res->first_name.' '.$res->last_name.'</a>';
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

<!-- Calendar end here -->