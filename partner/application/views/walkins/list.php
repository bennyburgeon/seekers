<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active"><?php echo $page_head;?> </li>
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
          <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>walkins/multidelete?rows=<?php echo $rows;?>" >
          <div class="right-btns"> <a href="<?php echo base_url();?>walkins/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a> <a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a> </div>

            <div class="sep-bar">
              <div class="page"> <?php echo $pagination; ?> </div>
              <div class="views_section">
                <div class="view-drop"> <span>View</span>
                  <select class="form-control drop" id="sel_limit1">
                    <option>Select</option>
                    <option>5</option>
                    <option>10</option>
                  </select>
                  <span>Records</span> </div>
                <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
              </div>
            </div>
            <div style="clear:both;"></div>
            <table class="tool-table new">
              <thead>
                <tr>
                  <th><div class="checker"><span>
                      <input type="checkbox" class="group-checkable" id="selectall">
                      </span></div></th>
                  <th>Title
                  <th> Status </th>
                  <th> Actions </th>
                </tr>
              </thead>
              <tbody>
                <?php 		if($records!=NULL)
		  {
foreach($records as $result){ ?>
                <tr class="odd gradeX">
                  <td><div class="checker"> <span>
                      <input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['interview_id']?>" >
                      </span> </div></td>
                  <td><?php echo $result["job_title"]; ?><br>
                    <?php echo $result["company_name"]; ?><br>
                    Date From:<strong><?php echo ($result['interview_date_from']!='0000-00-00' && $result['interview_date_from']!='') ? date('d-m-Y', strtotime($result["interview_date_from"])) : ''; ?> To <?php echo ($result['interview_date_to']!='0000-00-00' && $result['interview_date_to']!='') ? date('d-m-Y', strtotime($result["interview_date_to"])) : ''; ?></strong>,  Time From:<strong><?php echo $result["interview_time_from"]; ?> To <?php echo $result["interview_time_to"]; ?></strong><br>
                    Venue: <?php echo $result["venue"]; ?><br>
                    Contact: <?php echo $result["contact_name"]; ?> | <?php echo $result["contact_email"]; ?> | <?php echo $result["contact_phone"]; ?> <br>
                    <?php if(trim($result["file_name"])!='')echo 'Map Uploaded';else 'Not Uploaded'; ?></td>
                  <td><?php if($result['int_status']=='1'){?>
                    <a href="<?php  echo $this->config->site_url();?>walkins/changestat/<?php echo $result['interview_id']?>?int_status=0"> <span class="label label-sm label-success">Active</span></a>
                    <?php }elseif($result['int_status']=='0'){?>
                    <a href="<?php  echo $this->config->site_url();?>walkins/changestat/<?php echo $result['interview_id']?>?int_status=1" ><span class="label label-sm label-danger">Blocked </span></a>
                    <?php } ?></td>
                  <td><a href="<?php echo base_url();?>walkins/edit/<?php echo $result['interview_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a></td>
                </tr>
                <?php
		}}else{?>
                <tr>
                  <td colspan="12" align="center"> No Records Founds!! </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php echo $pagination; ?>
          </form>
          <div class="sep-bar">
            <div class="views_section">
              <div class="view-drop"> <span>View</span>
                <select class="form-control drop" id="sel_limit2">
                  <option>Select</option>
                  <option>5</option>
                  <option>10</option>
                </select>
                <span>Records</span> </div>
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
		window.location.href = '<?php echo $this->config->site_url();?>walkins?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>walkins?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>walkins?limit='+limits;
	});
	
});
</script>