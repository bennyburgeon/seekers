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
          <form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>shortlist_summary/">
            <table class="tool-table" border="1">
              <tbody>
                <tr>
                  <td><input class="form-control hori job-field" type="text" name="search_name" id="search_name" placeholder="Name" value="<?php echo $search_name;?>" style="width: 300px;"></td>
                
                   <td colspan="2">Application Status:
                  <input type="radio" name="shortlist_status" value="0" <?php if($shortlist_status==0) echo 'checked'; ?>>All
                  <input type="radio" name="shortlist_status" value="1" <?php if($shortlist_status==1) echo 'checked'; ?>>Shortlisted
                  <input type="radio" name="shortlist_status" value="2" <?php if($shortlist_status==2) echo 'checked'; ?>>Not Shortlisted </td>
                  
                  <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" style="width:100px" />
                    <a style="margin-left:13px" href="<?php echo base_url(); ?>shortlist_summary" class="btn btn-default btn-circle" >Reset</a></td>
                </tr>
              </tbody>
            </table>
          </form>
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
              <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <table class="tool-table new" width="100%">
            <thead>
              <tr role="row" class="heading">
                <th width="5%">#</th>
                <th width="28%">Candidates</th>
                <th width="25%">Job Name</th>
                <th width="20%">Shortlisted Date</th>
                <th width="10%">Applied Date</th>
                <th width="12%">Date Difference</th>
              </tr>
            </thead>
            <tbody>
              <?php 		
if($records!=NULL)
{
	$i=0;
	foreach($records as $result){ 
	 $i+=1; 
    //print_r($records); exit();?>
              <tr class="odd gradeX">
                <td><?php echo $i;?></td>
                <td><strong><font color="#3366CC"><a href="<?php  echo $this->config->site_url();?>candidates_dir/summary/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['first_name']?> &nbsp; <?php echo $result['last_name']?></a></font></strong><br></td>
                <td><?php echo $result['job_title']; ?></td>
                <td <?php if($result['short_date']>0)echo 'bgcolor="#E3E3E3"';?>><?php echo ($result['short_date']!='0000-00-00' && $result['short_date']!='') ? '<b>'.date('d-m-Y', strtotime($result['short_date'])).'</b>' : 'Not Shortlisted';?></td>
                <td><?php echo ($result['applied_on']!='0000-00-00' && $result['applied_on']!='') ? '<b>'.date('d-m-Y', strtotime($result['applied_on'])).'</b>' : '';?></td>
                <td><?php if($result['short_date']=='' && $result['date_difference']>5) {
					  echo '<b style="color:red">'.$result['date_difference'].'</b>'; 
				  } else {
					   echo $result['date_difference']; ?></td>
                <?php } ?>
              </tr>
              <?php
		 }}else{?>
              <tr>
                <td colspan="12" align="center"> No Records Founds!! </td>
              </tr>
              <?php }?>
            </tbody>
          </table>
          <br>
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="views_section">
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
