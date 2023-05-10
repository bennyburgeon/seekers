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
         
          <!--<form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>candidates_rejection/">
            <table class="tool-table" border="1">
              <tbody>
                <tr>
                  <td><input class="form-control hori job-field" type="text" name="search_name" id="search_name" placeholder="Name" value="<?php echo $search_name;?>" style="width: 300px;"></td>
                  <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" style="width:100px" />
                    <a style="margin-left:13px" href="<?php echo base_url(); ?>candidates_rejection" class="btn btn-default btn-circle" >Reset</a></td>
                </tr>
              </tbody>
            </table>
          </form>-->
          
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/multidelete?rows=<?php echo $rows;?>" >
            <table class="tool-table new" width="100%">
              <thead>
                <tr role="row" class="heading">
                  <th width="100%"><strong style="margin-top: 5px; margin-left: 42%; font-size: 18px;">Application Rejection</strong></th>
                </tr>
              </thead>
              <tbody>
                <?php 		
if($records!=NULL)
{
	foreach($records as $result){ 
	 if($result['app_status_id']=='2') { ?>
                <tr class="odd gradeX">
                  <td><strong><font color="#3366CC"><a href="<?php  echo $this->config->site_url();?>candidates_dir/summary/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['first_name']?> &nbsp; <?php echo $result['last_name']?></a></font></strong><br></td>
                </tr>
                <?php
		 }}}else{?>
                <tr>
                  <td colspan="12" align="center"> No Records Founds!! </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
            <br>
            <br>
            <table class="tool-table new" width="100%">
              <thead>
                <tr role="row" class="heading">
                  <th width="100%"><strong style="margin-top: 5px; margin-left: 42%; font-size: 18px;">Interview Rejection</strong></th>
                </tr>
              </thead>
              <tbody>
                <?php 		
if($records!=NULL)
{
	foreach($records as $result){ 
	 if($result['app_status_id']=='5') { ?>
                <tr class="odd gradeX">
                  <td><strong><font color="#3366CC"><a href="<?php  echo $this->config->site_url();?>candidates_dir/summary/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['first_name']?> &nbsp; <?php echo $result['last_name']?></a></font></strong><br></td>
                </tr>
                <?php
		 }}}else{?>
                <tr>
                  <td colspan="12" align="center"> No Records Founds!! </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
            <br>
            <br>
            <table class="tool-table new" width="100%">
              <thead>
                <tr role="row" class="heading">
                  <th width="100%"><strong style="margin-top: 5px; margin-left: 42%; font-size: 18px;">Offer Rejection</strong></th>
                </tr>
              </thead>
              <tbody>
                <?php 		
if($records!=NULL)
{
	foreach($records as $result){ 
	 if($result['app_status_id']=='8') { ?>
                <tr class="odd gradeX">
                  <td><strong><font color="#3366CC"><a href="<?php  echo $this->config->site_url();?>candidates_dir/summary/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['first_name']?> &nbsp; <?php echo $result['last_name']?></a></font></strong><br></td>
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
              <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
            </div>
          </div>
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
        
        <!-- Graph Data --> <br>
        <br>
        <div id="candidates_rejection_summary"  style="height:300px;width:1150px;border:1px solid #D3D3D3"> </div>
        <br />
        
        <!-- Graph Data --> 
        
      </div>
    </div>
  </div>
</section>
</div>
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
          title: 'Candidates Rejection Summary',
        };

        var chart = new google.visualization.PieChart(document.getElementById('candidates_rejection_summary'));
        chart.draw(data, options);
	        }


	  
</script>
