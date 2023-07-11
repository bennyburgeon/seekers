<style>

th{
	font-weight:bold; font-family:Verdana, Geneva, sans-serif; 
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
				<strong>Success!</strong> record added successfully.
</div>
<?php } ?> 

<?php if($this->input->get('update')==1){?>  
 <div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>Success!</strong> record updated successfully.
</div>
<?php } ?>  
             
<?php if($this->input->get('del')==1){?> 
		<div class="alert alert-success">
				<button class="close" data-dismiss="alert">×</button>
				<strong>record deleted..</strong>
			</div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">


<div class="right-btns">
<a href="<?php echo base_url();?>index.php/shiftmanager/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>

<!-- 
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>

-->: 
</div>

<form id="searchForm" method="post" action="<?php  echo $this->config->site_url();?>/shiftmanager/">
<table class="tool-table">
<tbody>

<tr>
<td width="64"><?php echo form_dropdown('company_id', $company, $company_id,'class="form-control hori" id="company_id"  style="width: 300px;"');?></td>
<td width="64"><?php echo form_dropdown('band_id', $band_list, $band_id,'class="form-control hori" id="band_id"  style="width: 150px;"');?></td>
<td width="64"><?php echo form_dropdown('shift_id', $shift_list, $shift_id,'class="form-control hori" id="shift_id"  style="width: 150px;"');?></td>
<td width="64"><?php echo form_dropdown('desig_id', $roles_list, $desig_id,'class="form-control hori" id="desig_id"  style="width: 150px;"');?></td>

<td>
<input type="text" id="shift_date" name="shift_date" value="<?php echo $shift_date;?>" placeholder="" style="width:100px;" class="form-control" />
</td>

<td width="56">
<input type="submit" value="Search"></td>
</tr>

</tbody>
</table>
</form>

<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit1">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
</div>
<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>

<div style="clear:both;"></div>
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/shiftmanager/multidelete?rows=<?php echo $rows;?>" >
<table class="tool-table new">
 <thead>
	<tr role="row" class="heading">
		<th width="17"><div class="checker"><span>#<!-- <input type="checkbox" class="group-checkable" id="selectall">--></span></div></th>
		<th width="655"><a href="<?php echo $this->config->site_url()?>/shiftmanager?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&searchterm=<?php echo $searchterm;?>&rows=<?php echo $rows;?>">Shift Title</a></th>
		<th width="95">Posted On</th>	
		<th width="113">Shift Date</th>
		<th width="136">List/Unlist</th>
		<th width="265">Shift Status	</th>    			
	</tr>
 </thead>
 <tbody>

  	<?php 
	if($records!=NULL)
	{
		foreach($records as $result){ ?>
                        
		<tr class="odd gradeX">
		    <td>
              <div class="checker">
                <span>
                    <!-- <input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['client_shift_id']?>" > --> 
                    #
                </span>
              </div>
        	</td>
			<td><a href="#" class="views" title="Manage Job"><?php echo $result['shift_title']?></a><br>
			  <?php echo $result['company_name']?> || <?php echo $result['shift_name'];?>   <br>
              
              <?php if($result['first_name']!=''){?>		  
              Staff Name: <?php echo $result['first_name'];?> 
              <?php }else{?>
              Staff Name: Nill
              <?php } ?>
               <br>Shift: <?php echo $result['shift_name'];?> 
               <br>Role: <?php echo $result['desig_name'];?> 
               
			  </td>
			<td><?php echo $result['created_on']?></td>
            <td><?php echo $result['shift_date']?></td>
            <td>
            
             <?php if($result['shift_status_id']>1){ ?>
             Unlisted
             <?php }else{?>
             
				  <?php if($result['list_status']=='0'){?>
                  
                  <a href="<?php echo base_url();?>index.php/shiftmanager/changestat/<?php echo $result['client_shift_id'];?>?list_status=<?php if($result['list_status']=='0')echo '1';else echo '0';?>" onClick="return confirm('Are you sure, list this job ?');" class="btn btn-danger btn-xs"><?php if($result['list_status']=='0')echo 'List';else echo 'Unlist';?>
                    
                    <?php }else if($result['list_status']=='1'){?>
                    
                    <a href="<?php echo base_url();?>index.php/shiftmanager/changestat/<?php echo $result['client_shift_id'];?>?list_status=<?php if($result['list_status']=='0')echo '1';else echo '0';?>" onClick="return confirm('Are you sure, unilist this job ?');" class="btn btn-primary btn-xs"><?php if($result['list_status']=='0')echo 'List';else echo 'Unlist';?>
                    
                    <?php } ?>
                
				<?php } ?>
                </a>
              
            </td>            
           <td>
           
            <?php if($result['shift_status_id']==1){ ?>
             <a href="<?php echo base_url();?>index.php/shiftmanager/edit/<?php echo $result['client_shift_id']?>" class="views" title="Edit">Edit</a>
             ||
                <a href="<?php echo base_url();?>index.php/shiftmanager/delete/<?php echo $result['client_shift_id']?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?');"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
                -
          <?php } ?>
                       
         <?php if($result['shift_status_id']==1){ ?>
             
            
              ||
             
             
             <a href="javascript:;" title="Assign staff member" onclick="assign_requirement(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/assign_requirement/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="assign_requirement" class="btn btn-info btn-xs">Allocate</a>
            
            
        <?php }elseif($result['shift_status_id']==2){?>
        
        Allocated 
             
        || 
             <br>

                  <a href="javascript:;" title="Cancel this, staff not available" onclick="cancel_shift(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/cancel_shift/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="cancel_shift" class="btn btn-danger btn-xs">Cancel</a><br>
<br>

                     <a href="javascript:;" title="Cancel this, staff not available" onclick="drop_shift_client(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/drop_shift_client/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="drop_shift" class="btn btn-danger btn-xs"> Drop- By- Client</a><br>

<br>

          
              <a href="javascript:;" title="Cancel this, staff not available" onclick="skip_shift(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/skip_shift/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="skip_shift" class="btn btn-danger btn-xs">Skip Shift</a>
              
                
              <?php }elseif($result['shift_status_id']==3){?>
              
             Cancelled 
             
             || 
             
             
                    <a href="javascript:;" title="Re-assign" onclick="re_assign(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/re_assign/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="re_assign" class="btn btn-info btn-xs">Re-Assign</a>
              
               <?php }elseif($result['shift_status_id']==4){?>
              Re-Assigned || 
              <br>
 <a href="javascript:;" title="Cancel this, staff not available" onclick="cancel_shift(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/cancel_shift/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="cancel_shift" class="btn btn-danger btn-xs">Cancel</a><br>
<br>

                     <a href="javascript:;" title="Cancel this, staff not available" onclick="drop_shift_client(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/drop_shift_client/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="drop_shift" class="btn btn-danger btn-xs"> Drop- By- Client</a><br>

<br>
              
              <a href="javascript:;" title="Cancel this, staff not available" onclick="skip_shift(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/skip_shift/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="skip_shift" class="btn btn-danger btn-xs">Skip Shift</a>
              
              
                <?php }elseif($result['shift_status_id']==5){?>
                Skipped- By Staff
                
                <a href="javascript:;" title="Cancel this, staff not available" onclick="drop_shift_client(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/drop_shift_client/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="drop_shift" class="btn btn-danger btn-xs"> Drop- By- Client</a><br>
<br>
                 <a href="javascript:;" title="Re-Open the shift" onclick="re_open_shift(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/re_open_shift/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="re_open_shift" class="btn btn-success btn-xs">Re-Open</a>
                
                 <?php }elseif($result['shift_status_id']==6){?>
                
                 Closed by Client || 
                 <a href="javascript:;" title="Re-Open the shift" onclick="re_open_shift(<?php echo $result['client_shift_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/shiftmanager/re_open_shift/?client_shift_id=<?php echo $result['client_shift_id'];?>"  id="re_open_shift" class="btn btn-success btn-xs">Re-Open</a>
                  
                 <?php } ?>              
             
           </td>
	</tr>

	<?php
	}}else{?>
        <tr>
            <td colspan="9" align="center">
                No Records Founds!!
            </td>
        </tr>
	<?php } ?>
		
</tbody>

</table>
<?php echo $pagination; ?>
</form>                           



<div class="sep-bar">

<div class="views_section">
<div class="view-drop">
<span>View</span>
<select class="form-control drop" id="sel_limit2">
<option>Select</option>
<option>5</option>
<option>10</option>
</select>
<span>Records</span>
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

<div class="modal fade" id="assignment_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document" style="width:1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15" id="assignment_history">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/shiftmanager/save_assignment" id="assignment_form" name="assignment_form"> 
            
             		<input type="hidden" name="client_shift_id" id="client_shift_id" value="">
                    
                    <div id="data_holder">
                    
                <table class="hori-form">
                <tbody>
                <tr>
                  <td colspan="2">
					Loading...................
                  </td>
                </tr>
                </tbody>
                </table>  
                  
                </div>        
                <table class="hori-form">
                <tbody>
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Add to Shift" id="save_assignment_button" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/shiftmanager/save_assignment" />
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            </form>
			
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<div class="modal fade" id="re_assignment_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document"  style="width:1000px;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15" id="re_assignment_history">
        <form class="form-horizontal form-bordered"  method="post" action="<?php echo $this->config->site_url();?>/shiftmanager/save_re_assignment" id="re_assignment_form" name="re_assignment_form"> 
            
             		<input type="hidden" name="re_client_shift_id" id="re_client_shift_id" value="">
                    
                    <div id="re_assign_data_holder">
                    
                <table class="hori-form">
                <tbody>
                <tr>
                  <td colspan="2">
					Loading...................
                  </td>
                </tr>
                </tbody>
                </table>  
                  
                </div>        
                <table class="hori-form">
                <tbody>
                <tr>
                  <td colspan="2">
                  <span class="click-icons">
                  <input type="button" class="attach-subs" value="Add" id="save_re_assignment_button" style="width:180px;" 
                  data-url="<?php echo $this->config->site_url();?>/shiftmanager/save_re_assignment" />
                  </span>
                  </td>
                </tr>
                </tbody>
                </table>
            </form>
			
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>

<script>

$(document).ready(function()
{
	$('#shift_date').datepicker({
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
		window.location.href = '<?php echo $this->config->site_url();?>/shiftmanager?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/shiftmanager?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/shiftmanager?limit='+limits;
	});
	
});

function assign_requirement(client_shift_id)
{
	$('#client_shift_id').val(client_shift_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/shiftmanager/assign_requirement/?client_shift_id="+client_shift_id,
			data: $('#assignment_form').serialize(),
			method: "POST",
  			data: { client_shift_id : client_shift_id },
		    dataType: "html",
			success: function(data) 
			{				
				 $('#data_holder').html(data);
			}
		});
    $('#assignment_modal').modal();		
}

$(document).on('click', '#save_assignment_button', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#assignment_modal').modal('hide');	
					alert('Shift sucessfully assigned to candidate');				
					location.reload();
					$("#assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});
	
function re_assign(client_shift_id)
{
	$('#re_client_shift_id').val(client_shift_id);
	$('#data_holder').html('Loading..................');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/shiftmanager/re_assign/?client_shift_id="+client_shift_id,
			data: $('#re_assignment_form').serialize(),
			method: "POST",
  			data: { client_shift_id : client_shift_id },
		    dataType: "html",
			success: function(data) 
			{				
				 $('#re_assign_data_holder').html(data);
			}
		});
    $('#re_assignment_modal').modal();		
}

$(document).on('click', '#save_re_assignment_button', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	

        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#re_assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){					
					$('#re_assignment_modal').modal('hide');	
					alert('Shift sucessfully assigned to candidate');				
					location.reload();
					$("#re_assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

function cancel_shift(client_shift_id)
{
	if(!confirm("Are you sure, remove staff from this shift ?"))return false;
	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/shiftmanager/cancel_shift/?client_shift_id="+client_shift_id,
			method: "POST",
  			data: { client_shift_id : client_shift_id },
		    dataType: "json",
			success: function(data) 
			{
				if(data.status == 'success')
				{					
					alert('Shift cancelled successfully.');		
					location.reload();		
				 }
				 else
				 {
					 alert('Some error happened.');
				 }
			}
		});	
}

function skip_shift(client_shift_id)
{
	if(!confirm("Are you sure, skip this shift ?"))return false;
	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/shiftmanager/skip_shift/?client_shift_id="+client_shift_id,
			method: "POST",
  			data: { client_shift_id : client_shift_id },
		    dataType: "json",
			success: function(data) 
			{
				if(data.status == 'success')
				{					
					alert('Shift cancelled successfully.');		
					location.reload();		
				 }
				 else
				 {
					 alert('Some error happened.');
				 }
			}
		});	
}

function drop_shift_client(client_shift_id)
{
	if(!confirm("Are you sure, drop this shift ?"))return false;
	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/shiftmanager/drop_shift_client/?client_shift_id="+client_shift_id,
			method: "POST",
  			data: { client_shift_id : client_shift_id },
		    dataType: "json",
			success: function(data) 
			{
				if(data.status == 'success')
				{					
					alert('Shift cancelled successfully.');	
					location.reload();			
				 }
				 else
				 {
					 alert('Some error happened.');
				 }
			}
		});	
}

function re_open_shift(client_shift_id)
{
	if(!confirm("Are you sure, re-open this shift ?"))return false;
	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/shiftmanager/re_open_shift/?client_shift_id="+client_shift_id,
			method: "POST",
  			data: { client_shift_id : client_shift_id },
		    dataType: "json",
			success: function(data) 
			{
				if(data.status == 'success')
				{					
					alert('Shift re-opened successfully.');	
					location.reload();			
				 }
				 else
				 {
					 alert('Some error happened.');
				 }
			}
		});	
}

// write new function for re-assign - duplicate the assignment
// 
</script>
