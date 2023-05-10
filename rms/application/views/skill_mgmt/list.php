<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">


<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/dashboard">Home</a> </li>
        <li class="active">Admin module list </li>
      </ul>
</div>

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
    <strong>Success !</strong>record added successfully.
    </div>

<?php } 

if($this->input->get('multi')==1){?> 
    <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>records deleted successfully</strong>
    </div>
<?php }

else if($this->input->get('multi')==2){?> 
	
    <div class="alert alert-success alert-dismissable" style="color:#F00;">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
	<strong>some are cannot be deleted ,depend on other records..</strong>
	</div>

<?php }
if($this->input->get('del')==1){?> 
    <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Record deleted..</strong>
    </div>

<?php }
else if($this->input->get('del')==2){?> 
	
    <div class="alert alert-success alert-dismissable" style="color:#F00;">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
	<strong>Record cannot be deleted ,entry in candidates..</strong>
	</div>
<?php }
else if($this->input->get('del')==3){?> 
	
    <div class="alert alert-success alert-dismissable" style="color:#F00;">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
	<strong>Record cannot be deleted , child skill exists..</strong>
	</div>
<?php }

if($this->input->get('upd')==1){?>  

    <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Success !</strong>record updated successfully.
    </div>
<?php }?>
				

<div class="row">
<div class="col-sm-12">

<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>
<div class="table-tech specs">


<div class="right-btns">
<a href="<?php echo $this->config->site_url();?>/skill_mgmt/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
</div>

<form id="searchForm" method="get" action="<?php echo $this->config->site_url();?>/skill_mgmt" enctype="multipart/form-data">

<table class="tool-table">
            <tbody>
                
                    <tr>
                    
                    <td>
                    <input class="form-control" type="text" name="searchterm" value="<?php echo $searchterm?>" id="search_term" placeholder="Search Skill" style="width: 185px;">
                    </td>
					<td><?php echo form_dropdown('job_cat_id', $industry_list , $job_cat_id,'style="width:200px;" class="form-control"  id="job_cat_id" ');?></td>
					<td><?php echo form_dropdown('func_id', $func_list , $func_id,'style="width:200px;" class="form-control"  id="func_id" ');?></td>
                    <td><?php echo form_dropdown('desig_id', $desig_list , $desig_id,'style="width:200px;" class="form-control"  id="desig_id" ');?></td>
                    
<td>
    
                    <td>
                     <input type="submit" value="Search"></td>
                    <td>
                      <a href="<?php echo $this->config->site_url();?>/skill_mgmt" class="btn btn-primary btn-xs">Clear Search</a></td>
                </tr>
            </tbody>
        </table>
        
        </form> 
        
<div class="sep-bar">
<div class="page">

<?php echo $pagination; ?>
</div>
<div class="views_section">

<div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
</div>
</div>

<div style="clear:both;"></div>

<form id="form1" method="post" action="<?php echo $this->config->site_url();?>/skill_mgmt/delete" enctype="multipart/form-data">

<table class="tool-table new">
    <thead>
        <tr>
            <th width="5%"><input name="" type="checkbox" value="" id="selectall"></th>
            <th width="30%"> Skill Name </th>
            <!--   <th> Status </th>         -->
            <th width="10%">Actions</th>        
        </tr>
    </thead>
    <tbody>
   			 <?php  foreach($records as $result){  ?> 
    
            <tr>
                    <td><input type="checkbox" class="checkboxes"  name="checkbox[]" value="<?php echo $result['skill_id']?>"/></td>
                   
                    <td><?php echo $result["skill_name"];?></td>
                   <!-- 
                    <td> 
                    <?php if($result['active']==1){?>
                    
                    <a class="label label-sm label-success" href="<?php echo $this->config->site_url()?>/skill_mgmt/changestat/<?php echo $result["skill_id"];?>?active=0">Active</a>
                    <?php } ?>
                    <?php if($result['active']==0){?>
                    
                    <a class="label label-sm label-danger" href="<?php echo $this->config->site_url()?>/skill_mgmt/changestat/<?php echo $result["skill_id"];?>?active=1">Inactive</a>
                    <?php } ?>
                    </td>
                    -->
                    <td>
                    <a href="<?php echo $this->config->site_url();?>/skill_mgmt/edit/<?php echo $result["skill_id"];?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
            <a href="<?php echo $this->config->site_url();?>/skill_mgmt/delete/<?php echo $result["skill_id"];?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
                    </td>
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
		//alert(count_checked);
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
	
});
</script>
<script>
function validate_multiple_delete(){
	var i, chks = document.getElementsByName('groupid[]');
	for (i = 0; i < chks.length; i++){
		if (chks[i].checked){
			return true;
		}else{
			alert('No item selected');
			return false;
		}
	}
}	
</script>
<script type="text/javascript">
	$('#job_cat_id').change(function() {
		
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');
			
	//if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/skill_mgmt/get_functional_by_industry/',
		  data: { job_cat_id: $('#job_cat_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#func_id').html('');
				  $.each(data.func_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#func_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#func_id').append('<option value="'+ index +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Select Functional Area</option');
		  }
		});	
});

	$('#func_id').change(function() {
		
	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');
			
	//if($('#func_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/skill_mgmt/get_designation_by_function/',
		  data: { func_id: $('#func_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#desig_id').html('');
				  $.each(data.desig_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#desig_id').append('<option value="'+ index +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#desig_id').append('<option value="'+ index +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Select Designation</option');
		  }
		});	
});
</script>