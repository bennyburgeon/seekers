<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
		<ul class="page-breadcrumb breadcrumb">
            <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
            <li><a href="<?php echo $this->config->site_url();?>/jobs">Intakes</a>
            <i class="icon-angle-right"></i>
            </li>
            <li><a href="#">Edit Intakes</a></li>
      </ul>
</div>

<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Edit Intakes</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
    <table class="hori-form">
        <tbody>
        
        <form action="<?php echo $this->config->site_url();?>/intakes/update" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmctype" name="frmentry" onSubmit="return validate();">
         <?php echo form_hidden('intake_id', $intake_details['intake_id']);?>
            	<tr>
                    <td>Intake Start Date</td>
                    <td><input style="width:250px;" type="text" readonly name="intake_start" id="intake_start" 
                    value="<?php echo $intake_details['intake_start'];?>" placeholder="Start Date" class="form-control"></td>
                    </td>
                </tr>
                
                <tr>
                    <td>Intake End Date</td>
                    <td> 
                    <input style="width:250px;" type="text" readonly name="intake_end" id="intake_end" value="<?php echo $intake_details['intake_end'];?>" 
                    placeholder="End Date" class="form-control"></td>
                    </td>
                </tr>
                
                <tr>
                    <td>Join Date</td>
                    <td>
                    <input style="width:250px;" type="text" readonly name="join_date" id="join_date" value="<?php echo $intake_details['join_date'];?>" 
                    placeholder="Start Date" class="form-control"></td>
                    </td>
                </tr>
                
                
                <tr>
                    <td>University</td>
                    <td> <?php echo form_dropdown('univ_id', $university, $intake_details['univ_id'],'class="form-control hori" id="univ_id" style="width:700px;"');?></td>
                    
                </tr>
                
                <tr>
                    <td>College</td>
                    <td>
                        <select class="form-control hori" id="campus_id" name="campus_id" style="width:700px;">                                   
                        <?php foreach($college_list as $key){ ?>
                        <option value="<?php echo $key['college_id'];?>" <?php echo ($key == $intake_details['college_id']? 'selected="selected"' : ''); ?>><?php echo $key['college_name'];?></option>
                        <?php } ?>
                        </select>
                    </td>
                </tr>
                
                
                <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="submit" class="attach-subs" value="Submit">
                    <a href="<?php echo $this->config->site_url();?>/intakes" class="attach-subs subs">Cancel</a>
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

<script type="text/javascript" src="<?php echo base_url('scripts/jquery.form.js');?>"></script>
<script>


$(".js-example-basic-multiple-cert").select2();
$(".js-example-basic-multiple-skill").select2();



function validate()
{
	if($('#intake_start').val()=='')
	{
		alert('Please enter Intake Start Date');
		$('#intake_start').focus();
		return false;
	}
	if($('#intake_end').val()=='')
	{
		alert('Please enter Intake End Date');
		$('#intake_end').focus();
		return false;
	}
	if($('#join_date').val()=='')
	{
		alert('Please enter Join Date');
		$('#join_date').focus();
		return false;
	}
	
	if($('#campus_id').val()=='')
	{
		alert('Please enter University and College');
		$('#campus_id').focus();
		return false;
	}
	
	return true;
}



//onchange of job_category

	$('#univ_id').change(function() 
	{
	
		jQuery('#campus_id').html('');
		jQuery('#campus_id').append('<option value="">Select College</option');
			
		if($('#univ_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/intakes/getcollege/',
			  data: { univ_id: $('#univ_id').val()},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#campus_id').html('');
					jQuery('#campus_id').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#campus_id').html('');
					  jQuery('#campus_id').append(data.college_list);

					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Please try again');
					jQuery('#campus_id').html('');
					jQuery('#campus_id').append('<option value="">Select Function</option');
			  }
			});	
	});



$(document).ready(function()
{
	$('#intake_end').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#join_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
	
	$('#intake_start').datepicker({
		dateFormat: "yy-mm-dd"
	});
});	
	
	

	

</script>	
