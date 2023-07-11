
<a href="#"  onClick="manage_shift_vacancy(<?php echo $candidate_id?>,<?php echo $prev_month;?>,<?php echo $prev_year;?>);" >Previous Month</a> ||  

<a href="#"  onClick="manage_shift_vacancy(<?php echo $candidate_id?>,<?php echo $next_month;?>,<?php echo $next_year;?>);" >Next</a><br>
        
        
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>candidates_ctc/update_shift_vacancy" id="shift_assignment_form" name="assignment_form"> 
        <input type="hidden" name="candidate_id" id="candidate_id" value="<?php echo $candidate_id?>">
        <input type="hidden" name="year" value="<?php echo $cur_year?>">
        <input type="hidden" name="month" value="<?php echo $cur_month?>">
        
<?php
//print_r($_POST);
$monthNames = Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
?>

<?php
$cMonth = $cur_month;
$cYear = $cur_year;
 
?>
        
<br>
<br>
<strong><?php echo $monthNames[$cMonth-1].' '.$cYear; ?></strong>
<br>
<br>

<?php 

$table_text='<table width="100%"  cellpadding="2" cellspacing="2" border="1">';
$table_text.='<tr>';
$table_text.='<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>';
$table_text.='<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>M</strong></td>';
$table_text.='<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>';
$table_text.='<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>W</strong></td>';
$table_text.='<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>T</strong></td>';
$table_text.='<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>F</strong></td>';
$table_text.='<td align="center" bgcolor="#999999" style="color:#FFFFFF"><strong>S</strong></td>';
$table_text.='</tr>';

 ?>

<?php 
$timestamp = mktime(0,0,0,$cMonth,1,$cYear);
$maxday = date("t",$timestamp);
$thismonth = getdate ($timestamp);
$startday = $thismonth['wday'];
for ($i=0; $i<($maxday+$startday); $i++) 
{	
    if(($i % 7) == 0 ) $table_text.='<tr>';
    if($i < $startday)
	{
		$table_text.='<td></td>';	
	}else 
    {			
		$dte=$cYear."-".sprintf("%02d",$cMonth)."-".sprintf("%02d",($i - $startday+1));
		$table_text.='<td  align="center" style="padding:25px;" valign="middle" height="20px">'. ($i - $startday + 1);
		
		$curent_avail_row=array();
		foreach($current_schedule as $avail_id => $avail_row) 
		{
			if($dte==$avail_row['avail_date'])
				$curent_avail_row=$avail_row;
		}
		
		if($dte>=date('Y-m-d'))
		{	
			if(isset($curent_avail_row['avail_date']) && $curent_avail_row['avail_date']==$dte)
					$table_text.='<br>&nbsp;<input type="checkbox" name="avail_id[]" value="'.$dte.'" checked="checked">&nbsp;Allocate&nbsp;';
				else
					$table_text.='<br>&nbsp;<input type="checkbox" name="avail_id[]" value="'.$dte.'">&nbsp;Allocate&nbsp;';
					
			$table_text.='<br><select style="width:125px;" name="shift_name[]">';
			$table_text.='<option value="0">Select Shift</option>';
			foreach($shift_list as $key => $val)
			{
				if(isset($curent_avail_row['shift_id']) && $curent_avail_row['shift_id']==$key)
					$table_text.='<option value="'.$key.'|'.$dte.'" selected>'.$val.'</option>';
				else
					$table_text.='<option value="'.$key.'|'.$dte.'">'.$val.'</option>';
			}
			$table_text.='</select>';
		}else
		{
			$table_text.='<br>-----<br>';
			$table_text.='Completed';
		}		
		$curent_avail_row=array();
		$table_text.='</td>';
    }
    if(($i % 7) == 6 ) $table_text.='</tr>';
}
$table_text.='</table>';
echo $table_text;
?>

         <span class="click-icons">
                  <input type="button" class="attach-subs" value="Update" id="save_shift_button" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>candidates_ctc/update_shift_vacancy" />
         </span>
</form>

