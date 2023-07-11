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
          <div class="right-btns"> </div>
         
          <form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>candidates_rejection/">
            <table class="tool-table" border="1">
              <tbody>
                <tr>
                  <td><input class="form-control hori job-field" type="text" name="app_rej_search" id="app_rej_search" placeholder="Name" value="<?php echo $app_rej_search;?>" style="width: 300px;"></td>
                  
                  <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" style="width:100px" />
                    <a style="margin-left:13px" href="<?php echo base_url(); ?>candidates_rejection" class="btn btn-default btn-circle" >Reset</a></td>
                </tr>
              </tbody>
            </table>
          </form>
          
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $app_rej_count;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/multidelete?rows=<?php echo $rows;?>" >
            <table class="tool-table new" width="100%">
              <thead>
                <tr role="row" class="heading">
                  <th width="25%">Candidate Name</strong></th>
                  <th width="35%">Job Name</th>
                  <th width="25%">Rejected Reason</th>
                  <th width="15%">Rejected Date</th>
                </tr>
              </thead>
              <tbody>
                <?php 		
if($app_rej!=NULL)
{
	foreach($app_rej as $result){ 
	 if($result['app_status_id']=='2') { ?>
                <tr class="odd gradeX">
                  <td><strong><font color="#3366CC"><a href="<?php  echo $this->config->site_url();?>candidates_dir/summary/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['first_name']?> &nbsp; <?php echo $result['last_name']?></a></font></strong><br></td>
                  <td><?php echo $result['job_title']?><br><?php echo '<span style="color: #337ab7;">'.$result['company_name'].'</span>'; ?></td>
                  <td>
				    <?php if($result['reason_for_reject']==1)echo 'Lack of Education';?>
                    <?php if($result['reason_for_reject']==2)echo 'Not Qualified';?>
                    <?php if($result['reason_for_reject']==3)echo 'Not Skilled';?>
                    <?php if($result['reason_for_reject']==4)echo 'Not much experienced';?>
                    <?php if($result['reason_for_reject']==5)echo 'Need Industry/Skill Change';?>
                    <?php if($result['reason_for_reject']==6)echo 'Issue with Location';?>
                    <?php if($result['reason_for_reject']==7)echo 'Candidate Profile is not Good';?>
                    <?php if($result['reason_for_reject']==8)echo 'Bad Company Profile - Candidate Exprience ';?>
                    <?php if($result['reason_for_reject']==9)echo 'Looking for Good Company Profile';?>
                    <?php if($result['reason_for_reject']==10)echo 'Lack of Domain Experience';?>
                    <?php if($result['reason_for_reject']==11)echo 'Issues with Office Time';?>
                    <?php if($result['reason_for_reject']==12)echo 'Issues with Contract-Bond ';?>
                    <?php if($result['reason_for_reject']==13)echo 'Problem with Salary ';?>
                    <?php if($result['reason_for_reject']==14)echo 'Issues with Language';?>
                    <?php if($result['reason_for_reject']==15)echo 'No Response - Call/Email';?>
                    <?php if($result['reason_for_reject']==16)echo 'Problem with Notice Period';?>
                    <?php if($result['reason_for_reject']==17)echo 'Applied to Same Company';?>
                    <?php if($result['reason_for_reject']==18)echo 'Not Interested';?>
                    <?php if($result['reason_for_reject']==19)echo 'Interested - But in Wrong job App';?>
                    <?php if($result['reason_for_reject']==20)echo 'Dont Know!';?>
                    <?php if($result['reason_for_reject']==21)echo 'Call After Six Months';?>
                    <?php if($result['reason_for_reject']==22)echo 'Call After 1 Year';?>
                  </td>
                  <td><?php echo date('d-m-Y', strtotime($result['rejected_on'])); ?></td>
                </tr>
                <?php
		 }}}else{?>
                <tr>
                  <td colspan="12" align="center"> No Records Founds!! </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
            </form>
            
             <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $app_rej_count;?> records</span></div>
            </div>
          </div>
          <div class="modal fade" id="content_history" role="dialog" aria-labelledby="enquiry-modal-label">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <br>
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
          


<section class="bot-sep">
  <div class="section-wrap">
   <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/>
          <h3>Interview Rejection Report</h3>
        </div>
        <div class="table-tech specs">
          <div class="right-btns"> </div>
               <form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>candidates_rejection/">
            <table class="tool-table" border="1">
              <tbody>
                <tr>
                  <td><input class="form-control hori job-field" type="text" name="int_rej_search" id="int_rej_search" placeholder="Search Candidate Name" value="<?php echo $int_rej_search;?>" style="width: 300px;"></td>
                  
                  <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" style="width:100px" />
                    <a style="margin-left:13px" href="<?php echo base_url(); ?>candidates_rejection" class="btn btn-default btn-circle" >Reset</a></td>
                </tr>
              </tbody>
            </table>
          </form>
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $int_rej_count;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/multidelete?rows=<?php echo $rows;?>" >
                    
            <table class="tool-table new" width="100%">
              <thead>
                <tr role="row" class="heading">
                 <th width="25%">Candidate Name</strong></th>
                  <th width="35%">Job Name</th>
                  <th width="25%">Rejected Reason</th>
                  <th width="15%">Rejected Date</th>
                </tr>
              </thead>
              <tbody>
                <?php 		
if($int_rej!=NULL)
{
	foreach($int_rej as $result){ 
	 if($result['app_status_id']=='5') { ?>
                <tr class="odd gradeX">
                  <td><strong><font color="#3366CC"><a href="<?php  echo $this->config->site_url();?>candidates_dir/summary/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['first_name']?> &nbsp; <?php echo $result['last_name']?></a></font></strong><br></td>
                  <td><?php echo $result['job_title']?><br><?php echo '<span style="color: #337ab7;">'.$result['company_name'].'</span>'; ?></td>
                  <td>
				    <?php if($result['reject_reason_id']==1)echo 'Poor Performance';?>
                    <?php if($result['reject_reason_id']==2)echo 'Not Impressive';?>
                    <?php if($result['reject_reason_id']==3)echo 'Negative Attitude';?>
                    <?php if($result['reject_reason_id']==4)echo 'Being Dishonest';?>
                    <?php if($result['reject_reason_id']==5)echo 'Uninteresting Interview Answers';?>
                    <?php if($result['reject_reason_id']==6)echo 'Arriving Late';?>
                    <?php if($result['reject_reason_id']==7)echo 'Being Rude';?>
                    <?php if($result['reject_reason_id']==8)echo 'Not upto the mark';?>
                    <?php if($result['reject_reason_id']==9)echo 'Technical Rejection';?>
                    <?php if($result['reject_reason_id']==10)echo 'Salary expectations are not met';?>
                    <?php if($result['reject_reason_id']==11)echo 'No-show';?>
                  </td>
                  <td><?php echo date('d-m-Y', strtotime($result['rejected_on'])); ?></td>
                </tr>
                <?php
		 }}}else{?>
                <tr>
                  <td colspan="12" align="center"> No Records Founds!! </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
            
          </form>
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $int_rej_count;?> records</span></div>
            </div>
          </div>
          <div class="modal fade" id="content_history" role="dialog" aria-labelledby="enquiry-modal-label">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><!-------------------------modal1 end------------------------------->
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



<section class="bot-sep">
  <div class="section-wrap">
   <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/>
          <h3>Offer Rejection Report</h3>
        </div>
        <div class="table-tech specs">
          <div class="right-btns"> </div>
               <form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>candidates_rejection/">
            <table class="tool-table" border="1">
              <tbody>
                <tr>
                  <td><input class="form-control hori job-field" type="text" name="offer_rej_search" id="offer_rej_search" placeholder="Search Candidate Name" value="<?php echo $offer_rej_search;?>" style="width: 300px;"></td>
                  
                  <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" style="width:100px" />
                    <a style="margin-left:13px" href="<?php echo base_url(); ?>candidates_rejection" class="btn btn-default btn-circle" >Reset</a></td>
                </tr>
              </tbody>
            </table>
          </form>
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $offer_rej_count;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/multidelete?rows=<?php echo $rows;?>" >
                    
            <table class="tool-table new" width="100%">
              <thead>
                <tr role="row" class="heading">
                  <th width="25%">Candidate Name</strong></th>
                  <th width="35%">Job Name</th>
                  <th width="25%">Rejected Reason</th>
                </tr>
              </thead>
              <tbody>
                <?php 		
if($offer_rej!=NULL)
{
	foreach($offer_rej as $result){ 
	 if($result['app_status_id']=='8') { ?>
                <tr class="odd gradeX">
                  <td><strong><font color="#3366CC"><a href="<?php  echo $this->config->site_url();?>candidates_dir/summary/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['first_name']?> &nbsp; <?php echo $result['last_name']?></a></font></strong><br></td>
                  <td><?php echo $result['job_title']?><br><?php echo '<span style="color: #337ab7;">'.$result['company_name'].'</span>'; ?></td>
                  <td ><?php echo $result['reason']?></td>
                </tr>
                <?php
		 }}}else{?>
                <tr>
                  <td colspan="12" align="center"> No Records Founds!! </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
           </form>
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $offer_rej_count;?> records</span></div>
            </div>
          </div>
          <div class="modal fade" id="content_history" role="dialog" aria-labelledby="enquiry-modal-label">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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

 <!--<section class="bot-sep">
  <div class="section-wrap">
   <div class="row">
      <div class="col-sm-12">
       <br>
        <br>
        <div id="candidates_rejection_summary"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
        <br />
        
       
       </div>
    </div>
  </div>
  
</section>-->



<script src="<?php echo base_url('assets/js/custom.js');?>"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
	  
     
	  google.setOnLoadCallback(candidates_rejection_summary);
	 

			
function candidates_rejection_summary() 
{
       var data = google.visualization.arrayToDataTable([		
         ['BDEs', 'Total'],<?php foreach($candidates_rejection_summary as $key => $val){?> ['<?php if($val['total_count']>0)echo $val['status'];else echo 'NA';?> ',   <?php echo $val['total_count']?>],<?php } ?>
		 ]);

        var options = {
          title: 'Call Status Summary',
        };

        var chart = new google.visualization.PieChart(document.getElementById('candidates_rejection_summary'));
        chart.draw(data, options);
	        }


	  
</script>