<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li><a href="<?php echo $this->config->site_url();?>designation">designation</a>
                            <i class="icon-angle-right"></i>
                            </li>
                            <li><a href="#">Add Designation</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Add Designation</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>

<form action="<?php echo $this->config->site_url();?>designation/add" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">


    

    <tr>
    <td>Industry</td>
    <td> <?php echo form_dropdown('job_cat_id', $industry_list, $formdata['job_cat_id'],'class="form-control hori" id="job_cat_id"');?>
    </td>
    </tr>
    
    <tr>
    <td>Functional Area</td>
    <td> <?php echo form_dropdown('func_id', $func_list, $formdata['func_id'],'class="form-control hori" id="func_id"');?>
    </td>
    </tr>
    
    <tr>
    <td>Designation</td>
    <td> <input type="text" id="desig_name" name="desig_name" value="<?php echo $formdata['desig_name'];?>" placeholder="" class="form-control" />
    </td>
    </tr>
    
    <tr>
    <td colspan="2">
    <span class="click-icons">
    <input type="submit" class="attach-subs" value="Submit">
    <a href="<?php echo $this->config->site_url();?>designation" class="attach-subs subs">Cancel</a>
    </span>
    </td>
    </tr>
    </form>

</tbody>
</table>
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<script>
function validate()
{
	if($('#job_cat_id').val()=='')
	{
		alert('Please select industry');
		$('#job_cat_id').focus();
		return false;
	}
	
	if($('#func_id').val()=='')
	{
		alert('Please select functional area');
		$('#func_id').focus();
		return false;
	}
	
	if($('#desig_name').val()=='')
	{
		alert('Please enter designation');
		$('#desig_name').focus();
		return false;
	}
	return true;
}

</script>	

<script type="text/javascript">
	$('#job_cat_id').change(function() {
		
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');
			
	if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>designation/get_functional_by_industry/',
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
</script>