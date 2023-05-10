<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">


<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/dashboard">Home</a><i class="fa fa-circle"></i> </li>
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
    <strong>record deleted..</strong>
    </div>

<?php }
else if($this->input->get('del')==2){?> 
	
    <div class="alert alert-success alert-dismissable" style="color:#F00;">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
	<strong>record cannot be deleted ,entry in candidates..</strong>
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
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/skill_mgmt/multidelete?rows=<?php echo $rows;?>" >

<div class="right-btns">
<a href="<?php echo base_url();?>index.php/skill_mgmt/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a>
<a href="#" id="deleteall" class="attach-subs tools"><img src="<?php echo base_url('assets/images/deletes_new.png');?>">Delete</a>
</div>

<form id="searchForm">

<table class="tool-table">
            <tbody>
                
                    <tr>
                        <td colspan="3"> <?php echo form_dropdown('search_term',  $skill_list,$searchterm,'id="search_term"  class="table-group-action-input form-control input-medium"');?></td>
                        
                        <td>
                        <a href="#" class="se-reset"><img src="<?php echo base_url('assets/images/search.png');?>" id="search"></a>
                        </td>
                    </tr>

            </tbody>
        </table>
        
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

<table class="tool-table new">
    <thead>
        <tr>
            <th><input name="" type="checkbox" value="" id="selectall"></th>
            <th> Order </th>
            <th> Skill Name </th>
            <th> Status </th>        
            <th>Actions</th>        
        </tr>
    </thead>
    <tbody>
   			 <?php  foreach($records as $result){  ?> 
    
            <tr>
                    <td><input type="checkbox" class="checkboxes"  name="checkbox[]" value="<?php echo $result['id']?>"/></td>
                    <td><a href="#"><?php echo $result["count"];?></a></td>
                    <td><?php echo $result["name"];?></td>
                    <td> 
                    <?php if($result['active']==1){?>
                    
                    <a class="label label-sm label-success" href="<?php echo $this->config->site_url()?>/skill_mgmt/changestat/<?php echo $result["id"];?>?active=0">Active</a>
                    <?php } ?>
                    <?php if($result['active']==0){?>
                    
                    <a class="label label-sm label-danger" href="<?php echo $this->config->site_url()?>/skill_mgmt/changestat/<?php echo $result["id"];?>?active=1">Inactive</a>
                    <?php } ?>
                    </td>
                    
                    <td>
                    <a href="<?php echo base_url();?>index.php/skill_mgmt/edit/<?php echo $result["id"];?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
            <a href="<?php echo base_url();?>index.php/skill_mgmt/delete/<?php echo $result["id"];?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
                    </td>
            </tr>
            
            <?php if(is_array($result['sub'])){?>                                
            <?php  foreach($result['sub'] as $sub_menu){  ?>
            
            <tr>  
            
                    <td><input type="checkbox" class="checkboxes"  name="checkbox[]" value="<?php echo $sub_menu['id']?>"/></td>                     	           
                    <td><?php echo $sub_menu["count"];?></td>
                    <td> -->&nbsp;&nbsp;<?php echo $sub_menu["name"];?></td>
                    
                    <td>  
                    <?php if($sub_menu['active']==1){?>
                    
                    <a class="label label-sm label-success" href="<?php echo $this->config->site_url()?>/skill_mgmt/changestat/<?php echo $sub_menu["id"];?>?active=0">Active</a>
                    <?php } ?>
                    <?php if($sub_menu['active']==0){?>                                    
                    <a class="label label-sm label-danger" href="<?php echo $this->config->site_url()?>/skill_mgmt/changestat/<?php echo $sub_menu["id"];?>?active=1">Inactive</a>
                    <?php } ?>
                    </td>      
                    <td>
                    <a href="<?php echo $this->config->site_url()?>/skill_mgmt/edit/<?php echo $sub_menu["id"];?>" class="views" title="Edit"><img src="<?php echo base_url('assets/images/edits.png');?>"></a>
                    <a href="<?php echo $this->config->site_url()?>/skill_mgmt/delete/<?php echo $sub_menu["id"];?>" class="views" title="Delete" onclick="return confirm('Are you sure you want to delete?')"><img src="<?php echo base_url('assets/images/deletes.png');?>"></a>
                    
                    </td>
            </tr>
    
			<?php } ?>
            
            <?php } ?>
            
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
	$("#search").click(function(){
		var searchterm = $('#search_term').val(); 
		var rows = '<?php echo $rows;?>';
		window.location.href = '<?php echo $this->config->site_url();?>/skill_mgmt?searchterm='+searchterm;
	});
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/skill_mgmt?limit='+limits;
	});
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
		window.location.href = '<?php echo $this->config->site_url();?>/skill_mgmt?limit='+limits;
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
