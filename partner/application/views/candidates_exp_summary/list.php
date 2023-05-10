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
          <form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>candidates_exp_summary/">
            <table class="tool-table" border="1">
              <tbody>
                <tr>
                  <td><input class="form-control hori job-field" type="text" name="search_name" id="search_name" placeholder="Name" value="<?php echo $search_name;?>" style="width: 300px;"></td>
                  <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" style="width:100px" />
                    <a style="margin-left:13px" href="<?php echo base_url(); ?>candidates_exp_summary" class="btn btn-default btn-circle" >Reset</a></td>
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
                <th width="8%">#</th>
                <th width="40%"><strong style="margin-top: 5px; margin-left: 8%; font-size: 18px;">Candidates who did not fill Experiance</strong></th>
                <th  width="20%">Registered Date</th>
                <th  width="20%">Emaild Date</th>
                <th  width="12%">Action</th>
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
                <td><?php echo $result['reg_date']; ?></td>
                
                <td <?php if($result['email_date']>0)echo 'bgcolor="#E3E3E3"';?>>
				<?php if($result['email_date']>0) {
				     echo $result['email_date'];
					 if($result['email_date_difference']>15){
						 echo '&nbsp; - &nbsp;(<b style="color:red;">'.$result['email_date_difference'].' Days</b>)';
					 }else{
						 echo '&nbsp; - &nbsp;(<b>'.$result['email_date_difference'].' Days</b>)';
					 }
				} else {
					 echo ' Email Not Sent';
				}
				?></td>
               
                <td><a href="<?php echo base_url(); ?>candidates_exp_summary/sentmail?candidate_id=<?php echo $result['candidate_id']; ?>" class="btn btn-info btn-xs" title="Send Email to Candidate">Send</a></td>
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
