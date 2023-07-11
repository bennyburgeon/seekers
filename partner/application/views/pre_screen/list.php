<style>
th {
	font-weight: bold;
	font-family: Verdana, Geneva, sans-serif;
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
      <strong>Success!</strong> record added successfully. </div>
    <?php } ?>
    <?php if($this->input->get('update')==1){?>
    <div class="alert alert-success">
      <button class="close" data-dismiss="alert">×</button>
      <strong>Success!</strong> record updated successfully. </div>
    <?php } ?>
    <?php if($this->input->get('del')==1){?>
    <div class="alert alert-success">
      <button class="close" data-dismiss="alert">×</button>
      <strong>record deleted..</strong> </div>
    <?php } ?>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/>
          <h3><?php echo $page_head;?></h3>
        </div>
        <div class="table-tech specs">
          <div class="right-btns">
            <?php /*?><a href="<?php echo base_url();?>company/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a><?php */?>
            <!--<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>--> 
          </div>
          <form id="searchForm" method="post" action="<?php echo $this->config->site_url()?>pre_screen">
            <table class="tool-table">
              <tbody>
                <tr>
                <a href="<?php echo base_url(); ?>pre_screen" id="clear_search" class="btn btn-primary btn-xs">Clear Search Filters</a>
                  <td><input class="form-control" type="text" name="searchterm" id="search_term" placeholder="Search Candidate " value="<?php echo $searchterm != '' ? $searchterm: '' ;?>" style="width: 185px;"></td>
                  <td><input class="form-control datepicker" type="text" name="pre_screen_date" id="pre_screen_date" placeholder="Pre-Screen Date" value="<?php echo $pre_screen_date != '' ? $pre_screen_date : '' ;?>" style="width: 185px;"></td>
                 
                  <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" />
                  </td>
                </tr>
              </tbody>
            </table>
          </form>
          <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>pre_screen/multidelete?rows=<?php echo $rows;?>" >
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
                <tr role="row" class="heading"> 
                  
                  <!--		<th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>-->
                  
                  <th>Candidate Name</th>
                  <th>Company Name</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Payment Status</th>
                  <th>Knowledge Level</th>
                  <th>Feedback Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
	if($records!=NULL)
	{
		foreach($records as $result){ ?>
                <tr class="odd gradeX"> 
                  <!--		    <td>
              <div class="checker">
                <span>
                    <input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['interview_id']?>" >
                </span>
              </div>
        	</td>-->
                  <td><?php echo $result['first_name'];?></td>
                  <td><?php if($result['company_name']!='')echo $result['company_name'];else echo 'Nill';?></td>
                  <td><?php if($result['pre_screen_date']==0){echo '';}else{ echo date("d-m-Y", strtotime($result['pre_screen_date']));}?></td>
                  <td><?php if($result['pre_screen_time']!='')echo $result['pre_screen_time'];else echo 'Any Time';?></td>
                  <td><?php if($result['payment_status']== 0) echo 'NA'; elseif($result['payment_status']== 1) echo 'Paid';else if($result ['payment_status']== 2) echo 'Unpaid'; ?></td>
                  <td><?php if($result['knowledge_level']== 0) echo 'NA';elseif($result['knowledge_level']== 1) echo 'Good';elseif($result['knowledge_level']== 2) echo 'Average'; if($result ['knowledge_level']== 3) echo 'Not Good'; ?></td>
                  <td><?php if($result['feedback_status']== 0) echo 'NA';elseif($result['feedback_status']== 1) echo 'Confirm';elseif($result['feedback_status']== 2) echo 'May be Come'; if($result ['feedback_status']== 3) echo 'Not Interested'; elseif($result['feedback_status']== 4) echo 'Follow up';?></td>
                </tr>
                <?php
	}}else{?>
                <tr>
                  <td colspan="9" align="center"> No Records Founds!! </td>
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
		window.location.href = '<?php echo $this->config->site_url();?>pre_screen?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>pre_screen?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>pre_screen?limit='+limits;
	});
});
</script>
