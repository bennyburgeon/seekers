<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
  <div class="section-wrap">
    <div class="row">
      <div class="col-sm-12 pages"> <span> <a href="<?php echo $this->config->site_url()?>dashboard">Home</a></span> / <span>Products</span> </span> </div>
    </div>
    <?php if($this->input->get('ins')==1){?>
    <div class="alert alert-success alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
      <strong>Sucess !</strong>record added successfully. </div>
    <?php } 
if($this->input->get('del')==1){?>
    <div class="alert alert-success alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
      <strong>record deleted..</strong> </div>
    <?php }

if($this->input->get('update')==1){?>
    <div class="alert alert-success alert-dismissable">
      <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
      <strong>Sucess !</strong>record updated successfully. </div>
    <?php }?>
    <?php if($this->session->flashdata('pic')) { ?>
    <div class="alert alert-success"> 
      <script>alert("please select anyone");</script> 
    </div>
    <?php } ?>
    <div class="row">
      <div class="col-sm-12">
        <div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-2.png');?>" alt=""/>
          <h3><?php echo $page_head;?></h3>
        </div>
        <div class="table-tech specs">
          <div class="right-btns"> <a href="<?php echo base_url();?>products/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a> 
          <a style="height: 28px; padding: 4px;" href="<?php echo base_url(); ?>products" id="Clear_search" class="btn btn-primary btn-xs">Clear Search Filters</a>
           
            
          </div>
          <form id="searchForm" method="get" action="<?php  echo $this->config->site_url();?>products/">
            <table class="tool-table">
              <tbody>
                <tr>
                  <td width="185"><input class="form-control" type="text" name="searchterm" value="<?php echo $searchterm;?>" id="search_term" placeholder="Search Product Name" style="width: 185px;"></td>
                 
                  <td width="93"><input type="submit" class="btn btn-default btn-circle" value="Search" id="submit"></td>
                </tr>
                <!--</form>-->
              </tbody>
            </table>
          </form>
          <form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>products/multidelete?rows=<?php echo $rows;?>" >
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
                  <th width="41"> <input name="" type="checkbox" value="" id="selectall">
                    # </th>
                  <th width="260"> <a href="<?php echo $this->config->site_url();?>products?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';}?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Products Name</a></th>
                  <th width="116">Company Name</th>
                  <th width="116">Product Image</th>
                  <th width="80">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
		if($records!=NULL)
		  {
			  $i=0;
foreach($records as $result){ 
$i+=1;
?>
                <tr>
                  <td align="center"><input type="checkbox" name="checkbox[]"  class="checkboxes" value="<?php echo $result['product_id']?>" >
                    <?php echo $i;?></td>
                  <td><?php echo $result['product_name']?></td>
                  <td><?php echo $result['company_name']?></td>
                  <td><?php echo $result['product_url']?></td>
                  <td><a href="<?php echo base_url();?>products/edit/<?php echo $result['product_id']?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a> <a href="<?php echo base_url();?>products/delete/<?php echo $result['product_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a></td>
                </tr>
                <?php
		}}else{?>
                <tr>
                  <td colspan="5" align="center"> No Records Founds!! </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </form>
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
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
		window.location.href = '<?php echo $this->config->site_url();?>products?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>products?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>products?limit='+limits;
	});
	
});
</script>
