<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"><?php echo $page_head;?> </li>
      </ul>
</div>
<?php  if($this->input->get('csv')==1){ ?> 
    <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>csv file uploaded successfully.
    </div>
<?php }?>
<?php if($this->input->get('upload_err')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>upload failed.</strong>
    </div>
<?php }?>
<?php if($this->input->get('file_type_err')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>support csv file only.</strong>
    </div>
<?php }?>

<?php if($this->input->get('moved')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Contact moved to candidates successfully</strong>
    </div>
<?php }?>
<?php if($this->input->get('dups')==1){?> 
	<div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Duplicate email and mobile number, the same already in the candidates list</strong>
    </div>
<?php }?>
 <?php if($this->input->get('ins')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Sucess !</strong>record added successfully.
                </div>
                 <?php } 
                 if($this->input->get('multi')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Records !</strong> Deleted successfully.
                </div>
                
              <?php } 
			   if($this->input->get('del')==1){?> 
			   <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>record deleted..</strong>
                </div>
			         <?php }
					 
					 if($this->input->get('upd')==1){?>  
               
			  <div class="alert alert-success alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
                    <strong>Sucess !</strong>record updated successfully.
                </div>
              <?php }?>
				

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">


<div class="right-btns">
<a href="<?php echo base_url();?>index.php/contact/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>

</div>


<form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>/contact/">
<table class="tool-table" border="0">
<tbody>

<tr>
  <td colspan="5"><table width="100%" border="0">
    <tbody>
      <tr>
        <td><input class="form-control" type="text" name="search_name" id="search_name" value="<?php echo $search_name;?>" placeholder="Name" style="width: 170px;"></td>
        <td><input class="form-control" type="text" name="search_email" id="search_email" value="<?php echo $search_email;?>" placeholder="Email"></td>
        <td><input class="form-control" type="text" name="search_mobile" id="search_mobile" value="<?php echo $search_mobile;?>" placeholder="Mobile" ></td>
        <td><?php  echo form_dropdown('lead_source',  $lead_source_list, $lead_source,'class="form-control" id="lead_source"');?></td>
        <td><?php  echo form_dropdown('branch_id',  $branch_list, $branch_id,'class="form-control" id="branch_id"');?></td>
        <td><input type="submit" id="submit" value="Search" class="btn btn-default btn-circle" /></td>
      </tr>
    </tbody>
  </table></td>
  </tr>
<tr>
<td colspan="5">
  <input id="lreg_status" type="radio" name="lreg_status" value="0"  <?php if($reg_status==0)echo 'checked="checked"';?>  />New &nbsp;
  <input id="lreg_status" type="radio" name="lreg_status" value="1"  <?php if($reg_status==1)echo 'checked="checked"';?>  />Need Call &nbsp;
  <input type="radio" name="lreg_status" id="lreg_status" value="2"  <?php if($reg_status==2)echo 'checked="checked"';?> />
  Called &nbsp;&nbsp;
<input id="lreg_status" type="radio" name="lreg_status" value="3"  <?php if($reg_status==3)echo 'checked="checked"';?>  />Waiting Feedback &nbsp;&nbsp;
  <input type="radio" name="lreg_status" id="lreg_status" value="4" <?php if($reg_status==4)echo 'checked="checked"';?> />Not Interested &nbsp;&nbsp;
  <input id="lreg_status" type="radio" name="lreg_status" value="5"  <?php if($reg_status==5)echo 'checked="checked"';?>  />Registered&nbsp;&nbsp;
  <input id="lreg_status" type="radio" name="lreg_status" value="6"  <?php if($reg_status==6)echo 'checked="checked"';?>  />Cancelled
  <input id="lreg_status" type="radio" name="lreg_status" value="-1"  <?php if($reg_status=='-1')echo 'checked="checked"';?>  />All</td>
</tr>
<tr>
  <td width="249"><input id="lead_assigned" type="radio" name="lead_assigned" value="1"  <?php if($lead_assigned==1)echo 'checked="checked"';?>  />
Assigned &nbsp;
<input type="radio" name="lead_assigned" value="2" id="lead_assigned"  <?php if($lead_assigned==2)echo 'checked="checked"';?> />
Unassigned
<input id="lead_assigned" type="radio" name="lead_assigned" value="-1"  <?php if($lead_assigned==-1)echo 'checked="checked"';?>  />
All 
  </td>
 
 
  <td width="172"><input id="lead_owner" type="radio" name="lead_owner" value="1"  <?php if($lead_owner==1)echo 'checked="checked"';?>  />
My Contacts &nbsp;
<input id="lead_owner" type="radio" name="lead_owner" value="-1"  <?php if($lead_owner==-1)echo 'checked="checked"';?>  />
All 
  
  </td>
 <td width="144">&nbsp;</td>
  <td width="443"><input id="lead_opportunity" type="radio" name="lead_opportunity" value="1"  <?php if($lead_opportunity==1)echo 'checked="checked"';?>  />
    Cold &nbsp;
    <input type="radio" name="lead_opportunity" value="2" id="lead_opportunity"  <?php if($lead_opportunity==2)echo 'checked="checked"';?> />
    Warm &nbsp;&nbsp;
    <input id="lead_opportunity" type="radio" name="le`ad_opportunity" value="3"  <?php if($lead_opportunity==3)echo 'checked="checked"';?>  />
    Hot &nbsp;&nbsp;
    <input type="radio" name="lead_opportunity" value="0" id="lead_opportunity"  <?php if($lead_opportunity==0)echo 'checked="checked"';?> />
    Unknown&nbsp;
    <input type="radio" name="lead_opportunity" value="-1" id="lead_opportunity"  <?php if($lead_opportunity=='-1')echo 'checked="checked"';?> />
    All</td>
  <td width="59">&nbsp;</td>
  </tr>
<tr>
  <td colspan="5"><input id="date_range" type="radio" name="date_range" value="1"  <?php if($date_range==1)echo 'checked="checked"';?>  />
    Today
    &nbsp;
    
    <input id="date_range" type="radio" name="date_range" value="2"  <?php if($date_range==2)echo 'checked="checked"';?>  />
    Yesterday
    &nbsp;
    
    
    <input type="radio" name="date_range" value="3" id="date_range"  <?php if($date_range==3)echo 'checked="checked"';?> />
 This Week &nbsp;
    <input type="radio" name="date_range" value="4" id="date_range"  <?php if($date_range==4)echo 'checked="checked"';?> />
 Last Week &nbsp;
    <input type="radio" name="date_range" value="5" id="date_range"  <?php if($date_range==5)echo 'checked="checked"';?> />
 This Month &nbsp;

    <input type="radio" name="date_range" value="6" id="date_range"  <?php if($date_range==6)echo 'checked="checked"';?> />
 Last 30 days &nbsp;
 
  
    <input type="radio" name="date_range" value="7" id="date_range"  <?php if($date_range==7)echo 'checked="checked"';?> />
 Last month &nbsp;
 
    <input type="radio" name="date_range" value="8" id="date_range"  <?php if($date_range==8)echo 'checked="checked"';?> />
 Current year &nbsp;
 
    <input type="radio" name="date_range" value="9" id="date_range"  <?php if($date_range==9)echo 'checked="checked"';?> />
 Last year &nbsp;
    
    <input type="radio" name="date_range" value="-1" id="date_range"  <?php if($date_range==-1)echo 'checked="checked"';?> />
 All</td>
  </tr>
<!--</form>-->
</tbody>
</table>
</form>  
<br>

<form name="form1" method="post" id="form1" action="#" >

<div class="sep-bar">
<table border="0" width="100%">
<tr>
<td>Counselors</td>
 <td> 
 <?php  echo form_dropdown('admin_id',  $admin_users_lists, $formdata['admin_id'],'class="form-control" id="admin_id"');?> 
 </td>
 <td> 
&nbsp;&nbsp;<input type="button" id="assignAdmin" value="Assign" class="btn btn-default btn-circle" />&nbsp;&nbsp;
 </td>	
  <td> 

<input id="update_reg_status" type="radio" name="update_reg_status" value="0"/>New &nbsp;
<input id="update_reg_status" type="radio" name="update_reg_status" value="1"/>Need Call &nbsp;
<input type="radio" name="update_reg_status" value="2" id="update_reg_status"/>called &nbsp;
<input id="update_reg_status" type="radio" name="update_reg_status" value="3"/>Waiting Feedback &nbsp;
<input type="radio" name="update_reg_status" value="4" id="update_reg_status"/>Not Interested &nbsp;
<input id="update_reg_status" type="radio" name="update_reg_status" value="5"/>Registered&nbsp;
<input id="update_reg_status" type="radio" name="update_reg_status" value="6"/>Cancelled
  

 </td>	
  <td> &nbsp;&nbsp;
<input type="button" id="btn_change_status" value="Change Status" class="btn btn-default btn-circle" />
 </td>	
</tr>
</table>


<div class="views_section">
<div class="view-drop">

<?php echo $pagination; ?>

</div>
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>

<div style="clear:both;"></div>


<table class="tool-table new">
<thead>
							<tr role="row" class="heading">
<th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                                <th><a href="<?php echo $this->config->site_url()?>/contact?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>">Candidate Name</a></th>
                                
                                  <th><a href="<?php echo $this->config->site_url()?>/contact?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>">Email</a></th>
                                         
                                         <th>Branch</th>
                                         <th>Reg. Date</th>
                                         <th>Source</th>
                                          <th><a href="<?php echo $this->config->site_url()?>/contact?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>">Mobile</a></th>
                            <th class="head0">Actions</th>
							</tr>
			  </thead>
                            
                    <tbody>
                    
        <?php 		if($records!=NULL)
		  {
		  $i=0;
foreach($records as $result){ 
$i+=1;
?>
                    
                    <tr class="odd gradeX">
                    
                   <td align="center"><input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['candidate_id']?>" ></td>
                  
            <td><?php echo $result['first_name']?>&nbsp;<?php echo $result['last_name']?></td>
			<td><?php echo $result['username'];?></td>
            <td><?php echo $result['branch_name'];?></td>
            <td><?php echo $result['reg_date'];?></td>
            <td><?php echo $result['lead_source'];?></td>
			<td><?php echo $result['mobile'];?></td>
                    
            <td>
              
              <a href="<?php echo base_url();?>index.php/contact/summary/<?php echo $result['candidate_id']?>" class="views" title="View">Manage</a>&nbsp;|&nbsp;
              
              <a href="<?php echo base_url();?>index.php/contact/edit/<?php echo $result['candidate_id']?>" class="views" title="Edit">Edit</a>  <!--       
			<a href="#" class="views" title="Delete"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a> -->
            </td>
                    </tr>
                    
                <?php
		}}else{?>
					<tr>
						<td colspan="10" align="center">
							No Records Founds!!						</td>
					</tr>
		   <?php } ?>
                    </tbody>
</table>
                         
</form>


<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">

</div>
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
	


	
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/contact?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/contact?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#assignAdmin").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a candidate to assign.");
		return false;
		}
		
		if(count_checked >0) {
			if($('#admin_id').val() == 0){
				alert('Please Select an Admin User');
			}
			else{
				var checkboxes = document.getElementsByName('checkbox[]');
				var selectedArr = [];
				for (var i=0; i<checkboxes.length; i++) {
					if (checkboxes[i].checked) {
						selectedArr.push(checkboxes[i].value);
					}
				}
				$.ajax({
					type:"POST",
					url: "<?php echo $this->config->site_url();?>/contact/assignAdmin",
					data:{ 
							'selectedArr' : selectedArr,
							'admin_id' : $('#admin_id').val(),
					},
					success: function(msg) {
						if(msg>0){
						alert('successfully added');
						window.location='<?php echo $this->config->site_url();?>/contact';
						}
						else{
						alert('Already assigned');
						}
					}
				});
			}
		}
	});


	$("#btn_change_status").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) 
		{
			alert("Please select a candidate to assign.");
			return false;
		}
		if (!$("input[name='update_reg_status']:checked").val()) {
			   alert('Please select status!');
				return false;
		}
		
		var checkboxes = document.getElementsByName('checkbox[]');
		
		var selectedArr = [];
		
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selectedArr.push(checkboxes[i].value);
			}
		}

		$.ajax({
			type:"POST",
			url: "<?php echo $this->config->site_url();?>/contact/change_status",
			data:{ 
					'selectedArr' : selectedArr,
					'reg_status' : $("input[name='update_reg_status']:checked").val(),
			},
			success: function(msg) {
				if(msg>0){
				alert('successfully changed');
				window.location='<?php echo $this->config->site_url();?>/contact';
				}
				else{
				alert('Already assigned');
				}
			},
			error:function(){
					alert('Problem with server. Pelase try again');
			}
		});
	});
	
});
</script>

<script>
function csv_validate()
{	
	if($('#csvfile').val()=='')
	{
		alert("Please Select file");
		$('#csvfile').focus();
		return false;
	}
   
	return true;
}


</script>		

