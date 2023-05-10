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

        <div class="gragh-area"> 

           <?php if(count($latest_applications_list)>0){?>

          <h3>Shortlisted Candidates List</h3>

          <div class="tasks" style="border:1px solid #D3D3D3">

            <table>

              <thead>

                <tr>

                  <th width="55">Applied On</th>

                  <th width="114">Job ID</th>

                  <th width="85">Candidate</th>

                  <th width="124">CTC</th>

                  <th width="102">Expected</th>

                  <th width="56">Notice</th>

                  <th width="55">Total Exp.</th>

                </tr>

              </thead>

              <tbody>

                <?php foreach($latest_applications_list as $key => $val){?>

                <tr>

                  <td><?php echo ($val['applied_on']!='0000-00-00' && $val['applied_on']!='') ? date('d-m-Y', strtotime($val['applied_on'])) : '';?></td>

                  <td><?php echo $this->config->item('job_prefix'); ?>-<?php echo $val['job_id'];?>&nbsp;<a target="_blank" class="btn btn-warning btn-xs" href="<?php echo base_url(); ?>jobs/manage/<?php echo $val['job_id'];?>">View Job</a></td>

        <td><a href="<?php echo $this->config->item('client_cv_preview').'profile_rms?candidate_id='.md5($val['candidate_id']).'&job_app_id='.$val['job_app_id'];?>" title="View Profile" target="_blank"><?php echo $val['first_name'];?></a></td>

                  <td><?php echo  $this->config->item('currency_symbol');?>

                    <?php if(isset($val['current_ctc'])) echo number_format((double)$val['current_ctc'],0);else echo '0';?>

                    / Yr. </td>

                  <td><strong><?php echo  $this->config->item('currency_symbol');?>

                    <?php if(isset($val['expected_ctc'])) echo number_format((double)$val['expected_ctc'],0);else echo '0';?>

                    / Yr. </strong></td>

                  <td><strong><?php echo $val['notice_period'];?> Days</strong></td>

                  <td><?php echo $val['total_experience'];?> Yrs.</td>

                </tr>

                <?php } ?>

              </tbody>

            </table>

          </div>

          <br />

          <?php }?>

          

        <div class="modal fade" id="client_cv_modal"  role="dialog" aria-labelledby="enquiry-modal-label">

  <div class="modal-dialog" style="width:1200px;" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <div id="show_client_cv" style="overflow: scroll;"></div>

        

        <!-------------------------modal1 end------------------------------->

        <div style="clear:both;"></div>

      </div>

    </div>

  </div>

</div>

          

          

          

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

              <td bgcolor="#999999" style="color:#FFFFFF"><table width="100%"  cellspacing="0" cellpadding="0" border=1>

                  <tr>

                    <td width="50%" align="left"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $prev_month . "&year=" . $prev_year; ?>" style="color:#FFFFFF">Previous</a></td>

                    <td width="50%" align="right"><a href="<?php echo $_SERVER["PHP_SELF"] . "?month=". $next_month . "&year=" . $next_year; ?>" style="color:#FFFFFF">Next</a></td>

                  </tr>

                </table></td>

            </tr>

            <tr>

              <td align="center"><table width="100%"  cellpadding="2" cellspacing="2" border=1>

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

                </table></td>

            </tr>

          </table>

          

          <!-- Calendar end here -->

          

          <?php if(count($interviews_current_week)>0){?>

          <div class="tab-head mar-spec">

            <h3>Interviews Scheduled - This Week From <?php echo $start_date?> To <?php echo $end_date?></h3>

          </div>

          <div class="tasks" style="border:1px solid #D3D3D3">

            <table>

              <thead>

                <tr>

                  <th width="75">Interview On</th>

                  <th width="75">Job ID</th>

                  <th width="68">Candidate</th>

                  <th width="37">CTC</th>

                  <th width="85">Expected</th>

                  <th width="44">Notice</th>

                  <th width="55">Total Exp.</th>

                </tr>

              </thead>

              <tbody>

                <?php foreach($interviews_current_week as $key => $val){?>

                <tr>

                  <td><?php echo ($val['interview_date']!='0000-00-00' && $val['interview_date']!='') ? date('d-m-Y', strtotime($val['interview_date'])) : '';?></td>

                  <td><?php echo $this->config->item('job_prefix'); ?>-<?php echo $val['job_id'];?>&nbsp;<a target="_blank" class="btn btn-warning btn-xs" href="<?php echo base_url(); ?>jobs/manage/<?php echo $val['job_id'];?>">View Job</a></td>

                  <td><a href="<?php echo $this->config->item('client_cv_preview').'profile_rms?candidate_id='.md5($val['candidate_id']).'&job_app_id='.$val['job_app_id'];?>" title="View Profile" target="_blank"><?php echo $val['first_name'];?></a></td>

                  <td><?php echo  $this->config->item('currency_symbol');?>

                    <?php if(isset($val['current_ctc'])) echo number_format((double)$val['current_ctc'],2);else echo '0.00';?>

                    / Yr. </td>

                  <td><strong><?php echo  $this->config->item('currency_symbol');?>

                    <?php if(isset($val['expected_ctc'])) echo number_format((double)$val['expected_ctc'],2);else echo '0.00';?>

                    / Yr. </strong></td>

                  <td><strong><?php echo $val['notice_period'];?> Days</strong></td>

                  <td><?php echo $val['total_experience'];?> Yrs.</td>

                </tr>

                <?php } ?>

              </tbody>

            </table>

          </div>

          <br />

          <?php }?>

          <?php if(count($interviews_history)>0){?>

          <h3>Latest Interview History</h3>

          <div class="tasks" style="border:1px solid #D3D3D3">

            <table>

              <thead>

                <tr>

                  <th width="75">Applied On</th>

                  <th width="75">Job ID</th>

                  <th width="68">Candidate</th>

                  <th width="68">Interview Status</th>

                  <th width="37">CTC</th>

                  <th width="85">Expected</th>

                  <th width="44">Notice</th>

                  <th width="55">Total Exp.</th>

                </tr>

              </thead>

              <tbody>

                <?php foreach($interviews_history as $key => $val){?>

                <tr>

                  <td><?php echo ($val['interview_date']!='0000-00-00' && $val['interview_date']!='') ? date('d-m-Y', strtotime($val['interview_date'])) : '';?></td>

                  <td><?php echo $this->config->item('job_prefix'); ?>-<?php echo $val['job_id'];?>&nbsp;<a target="_blank" class="btn btn-warning btn-xs" href="<?php echo base_url(); ?>jobs/manage/<?php echo $val['job_id'];?>">View Job</a></td>

                  <td><a href="<?php echo $this->config->item('client_cv_preview').'profile_rms?candidate_id='.md5($val['candidate_id']).'&job_app_id='.$val['job_app_id'];?>" title="View Profile" target="_blank" title="View Profile"><?php echo $val['first_name'];?></a></td>

                  <td><?php if($val['app_status_id']==4) { echo 'Interview Scheduled'; }

				  else if($val['app_status_id']==5) { echo '<span style="color: #e60a33;"> Rejected </span>'; }

				  else if($val['app_status_id']>=6) { echo 'Selected'; } ?></td>

                  

                  <td><?php echo  $this->config->item('currency_symbol');?>

                    <?php if(isset($val['current_ctc'])) echo number_format((double)$val['current_ctc'],2);else echo '0.00';?>

                    / Yr. </td>

                  <td><strong><?php echo  $this->config->item('currency_symbol');?>

                    <?php if(isset($val['expected_ctc'])) echo number_format((double)$val['expected_ctc'],2);else echo '0.00';?>

                    / Yr. </strong></td>

                  <td><strong><?php echo $val['notice_period'];?> Days</strong></td>

                  <td><?php echo $val['total_experience'];?> Yrs.</td>

                </tr>

                <?php } ?>

              </tbody>

            </table>

          </div>

          <br />

          <?php }?>

         

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

<script>



function open_client_cv(candidate_id,job_id)

{

	$('#show_client_cv').html('');	

	 $.ajax({			

			type: 'POST',

			url:"<?php echo base_url(); ?>candidates_dir/client_cv/?view="+candidate_id,

			method: "POST",

  			data: { candidate_id : candidate_id,job_id : job_id },

		    dataType: "html",

			success: function(data) 

			{

				 $('#show_client_cv').html(data);

			}

		});

    $('#client_cv_modal').modal();

}



</script>