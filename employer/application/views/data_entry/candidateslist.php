
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
				<?php if($this->session->flashdata('msg')){?>
		<div class="alert alert-success alert-dismissable">
			<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
		 	<strong><?php echo $this->session->flashdata('msg');?></strong>
		</div>
<?php } ?> 

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">

<form id="form1" name="form1" action="<?php echo $file_upload_url;?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="file_uploaded" value="1">

<input type="hidden" name="rps_folder_url" value="<?php echo $rps_folder_url?>">
<input type="hidden" name="file_upload_url" value="<?php echo $file_upload_url?>">
<input type="hidden" name="file_upload_folder" value="<?php echo $file_upload_folder?>">

<input type="hidden" name="redirect_after_upload" value="<?php echo $redirect_after_upload?>">

<input type="hidden" name="server_name" value="<?php echo $server_name?>">
<input type="hidden" name="db_name" value="<?php echo $db_name?>">
<input type="hidden" name="username" value="<?php echo $username?>">
<input type="hidden" name="password" value="<?php echo $password?>">

<table class="tool-table">
<tbody>

<tr>
<td>PDF/Doc File</td>
<td><input type="file" name="cv_file[]" multiple size="20" id="fileField"></td>
<td><input type="submit" value="Upload" class="btn btn-default btn-circle" ></td>
</tr>
</tbody>
</table>
</form>

<br>
<form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>/data_entry/">
<table class="tool-table">
<tbody>

<tr>
<td><input class="form-control" type="text" name="search_name" id="search_name" value="<?php echo $search_name;?>" placeholder="Name" style="width: 150px;"></td>
<td><input class="form-control" type="text" name="search_email" id="search_email" value="<?php echo $search_email;?>" placeholder="Email" style="width: 110px;"></td>
<td><input class="form-control" type="text" name="search_mobile" id="search_mobile" value="<?php echo $search_mobile;?>" placeholder="Mobile" style="width: 70px;"></td>

<td>
<select class="form-control" id="profile_status" name="profile_status" style="width: 130px;">
	<option <?php if($profile_status=='')echo 'selected="selected"';?> value="" >Select All </option>
   <option <?php if($profile_status==1)echo 'selected="selected"';?> value="1">Personal Details Missing</option>
    <option <?php if($profile_status==2)echo 'selected="selected"';?> value="2">Education Not Updated</option>
    <option <?php if($profile_status==3)echo 'selected="selected"';?> value="3">No Prof. History</option>
    <option <?php if($profile_status==4)echo 'selected="selected"';?> value="4">No Skills Added</option>
    <option <?php if($profile_status==5)echo 'selected="selected"';?> value="5">Need Designation</option>
    <option <?php if($profile_status==6)echo 'selected="selected"';?> value="6">No Contracts</option>
</select>

</td>

<td>
<input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" />
</td>
    
    

<!--EDUCATION FILTER-->



</tr>
<!--</form>-->
</tbody>
</table>
</form>  

<form name="form1" method="post" id="form1" action="#" >

<div class="sep-bar">
<div class="page">
<?php echo $pagination; ?>
</div>
<div class="page">
<table border="0">
<tr>

  	
  	
</tr>
</table>
</div>




<div class="views_section">

<div class="found"><span>Found total&nbsp; | <?php echo $total_rows;?> records</span></div>
</div>
</div>

<div style="clear:both;"></div>


    <table class="tool-table new">
        <thead>
            <tr role="row" class="heading">
                <th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                <th><a href="<?php echo $this->config->site_url()?>/data_entry?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>">Candidate Name</a></th>
                
                <th><a href="<?php echo $this->config->site_url()?>/data_entry?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>">Email</a></th>
                
                <th>Reg Date</th>
                <th><a href="<?php echo $this->config->site_url()?>/data_entry?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>">Mobile</a></th>
                <th class="head0">Actions</th>
                <th class="head0">Profile Status</th>
            </tr>
        </thead>
        
        <tbody>
        
			<?php if($records!=NULL){ $i=0; foreach($records as $result){ $i+=1; ?>            
            	<tr class="odd gradeX">
            
                    <td align="center"><input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['candidate_id']?>" ></td>
                    
                    <td>			
                    
                    <?php if($result['lead_opportunity']==1){echo '<p style="color:#5BEF00">';}?> 
                    <?php if($result['lead_opportunity']==2){echo '<p style="color:#2000F3">';}?> 
                    <?php if($result['lead_opportunity']==3){echo '<p style="color:#F90000">';}?>
                    <?php if($result['lead_opportunity']==0){echo '<p style="color:##000">';}?>
                    
                    <?php echo $result['first_name']?>&nbsp;<?php echo $result['last_name']?> 
                    </p>
                    
                    </td>
                    <td><?php echo $result['username'];?></td>
                    <td><?php echo $result['reg_date'];?></td>
                    <td><?php echo $result['mobile'];?></td>
                    
                    <td>
                    
                    <a href="<?php echo base_url();?>index.php/data_entry/summary/<?php echo $result['candidate_id']?>" class="views" title="View">Manage</a>&nbsp;|&nbsp;
                    <a href="<?php echo base_url();?>index.php/data_entry/edit/<?php echo $result['candidate_id']?>" class="views" title="Data Entry">Data Entry</a>
                    

                    </td>
                    <td><progress value="<?php echo array_sum($result['candidate_rating']);?>" style="color:#000;" title="Total Points- <?php echo array_sum($result['candidate_rating']);?>" max="100"></progress></td>
             	</tr>
                    
                    <?php
                    }}else{?>
                    <tr>
                    	<td colspan="9" align="center"> No Records Founds!! </td>
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
<script>
$('#simple').hide();

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
	
	
});
</script>
