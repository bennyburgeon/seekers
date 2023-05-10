<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">
<span>
<a href="<?php echo $this->config->site_url()?>/campus">Courses</a></span> / <span>Manage Campus</span></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3><?php echo $page_head;?></h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor"><form action="<?php echo $this->config->site_url();?>/campus/connect/<?php echo $formdata['campus_id'];?>" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
<table class="hori-form">
<tbody>
  
<?php echo form_hidden('campus_id', $formdata['campus_id']);?>

<tr>
<td><?php echo $formdata['campus_name'];?> | <?php echo $formdata['univ_name'];?></td>
<td>Select Programs</td>
</tr>

<tr>
<td width="50%">


<select multiple name="course_id[]" id="course_id" size="20" class="form-control">

<?php foreach($course_list as $level => $course){ ?>
	<optgroup label="<?php echo $level;?>">
	<?php foreach($course as $key => $val){ ?>
	<option value="<?php echo $val['course_id']?>"><?php echo $val['course_name']?></option>
	<?php     
    }
    ?>
</optgroup>
	<?php 
    }
    ?>
	</select>

</td>


 <td width="50%">
 
 <select multiple name="cur_course_id[]" id="cur_course_id" size="20" class="form-control">

<?php foreach($cur_course_list as $level => $course){ ?>
	<optgroup label="<?php echo $level;?>">
	<?php foreach($course as $key => $val){ ?>
	<option value="<?php echo $val['course_id']?>"><?php echo $val['course_name']?></option>
	<?php     
    }
    ?>
</optgroup>
	<?php 
    }
    ?>
	</select>
 
 
 </td>	
</tr>


<tr>
<td>Select and click on Add </td>
 <td>Select and click on Remove</td>	
</tr>


<tr>
<td><span class="click-icons">
  <input type="submit" class="attach-subs" name="add" value="Add">
</span></td>
<td><span class="click-icons">
  <input type="submit" class="attach-subs" name="remove" value="Remove">
</span></td>
</tr>

<tr>
<td colspan="2">
<span class="click-icons"><a href="<?php echo $this->config->site_url();?>/campus" class="attach-subs subs">Back</a></span></td>
</tr>
<tr>
  <td colspan="2">&nbsp;</td>
</tr>
</tbody>
</table>
</form>
<form action="<?php echo $this->config->site_url();?>/campus/connect/<?php echo $formdata['campus_id'];?>" class="form-horizontal form-bordered"  method="post" id="fee_entry" name="fee_entry" enctype="multipart/form-data">
<input type="hidden" name="campus_id" value="<?php echo $formdata['campus_id'];?>" />
  <table width="99%" border="1">
    <tr>
      <td width="6%">Total Sem</td>
      <td width="11%">Fee/Sem</td>
      <td width="8%">Annual/Fee</td>
      <td width="9%">Total Fee</td>
      <td width="7%">Living Cost</td>
      <td width="10%">Hr Rate</td>
      <td width="6%">Wkly Hrs</td>
      <td width="8%">IELTS</td>
      <td width="5%">PTE</td>
      <td width="4%">OET</td>
      <td width="4%">TOFEL</td>
      <td width="4%">Other</td>
      <td width="4%">School</td>
      <td width="6%">Extras</td>
      <td width="8%">Scholarship</td>
    </tr>

<?php 

foreach($cur_fee_list as $key => $val){

?>    
    <tr>
      <td colspan="15"><?php echo $val['course_name'];?> </td>
      </tr>
    <tr>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['total_semester'];?>" placeholder="Tot. Sem." style="width:70px;" /></td>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['fee_per_semester'];?>" placeholder="Fee/Sem" style="width:70px;" /></td>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['annual_tution_fee'];?>" placeholder="Annual Fee" style="width:90px;" /></td>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['total_tution_fee'];?>" placeholder="Total Fee" style="width:70px;" /></td>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['wkly_living_cost'];?>" placeholder="Living Cost" style="width:70px;" /></td>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['wkly_hourly_rate'];?>" placeholder="Hr Rate" style="width:70px;" /></td>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['wkly_total_hrs'];?>" placeholder="Wkly Hrs" style="width:70px;" /></td>
      <td>
      
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['ielts_overall'];?>" placeholder="OA" style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['ielts_r'];?>" placeholder="R" style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['ielts_w'];?>" placeholder="W" style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['ielts_l'];?>" placeholder="L" style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['ielts_s'];?>" placeholder="S" style="width:50px;" /></td>
      <td>
      
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['pte_overall'];?>" placeholder="OA" style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['pte_r'];?>" placeholder="R" style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['pte_w'];?>" placeholder="W" style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['pte_l'];?>" placeholder="L" style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['pte_s'];?>" placeholder="S" style="width:50px;" /></td>
        
      <td>
      
        <select name="<?php echo $key;?>[]" style="width:50px;">
            <option value="0" <?php if($val['tofel_overall']=='' || $val['tofel_overall']='0')echo 'selected="selected"';?>>Overall</option>
            <option value="1" <?php if($val['tofel_overall']=='1')echo 'selected="selected"';?>>A</option>
            <option value="2" <?php if($val['tofel_overall']=='2')echo 'selected="selected"';?>>B</option>
            <option value="3" <?php if($val['tofel_overall']=='3')echo 'selected="selected"';?>>C</option>
        </select>
        
        <select name="<?php echo $key;?>[]" style="width:50px;">
            <option value="0" <?php if($val['tofel_r']=='' || $val['tofel_r']='0')echo 'selected="selected"';?>>Read</option>
            <option value="1" <?php if($val['tofel_r']=='1')echo 'selected="selected"';?>>A</option>
            <option value="2" <?php if($val['tofel_r']=='2')echo 'selected="selected"';?>>B</option>
            <option value="3" <?php if($val['tofel_r']=='3')echo 'selected="selected"';?>>C</option>
        </select>
        
        <select name="<?php echo $key;?>[]" style="width:50px;">
            <option value="0" <?php if($val['tofel_w']=='' || $val['tofel_w']='0')echo 'selected="selected"';?>>Write</option>
            <option value="1" <?php if($val['tofel_w']=='1')echo 'selected="selected"';?>>A</option>
            <option value="2" <?php if($val['tofel_w']=='2')echo 'selected="selected"';?>>B</option>
            <option value="3" <?php if($val['tofel_w']=='3')echo 'selected="selected"';?>>C</option>
        </select>
        
        <select name="<?php echo $key;?>[]" style="width:50px;">
            <option value="0" <?php if($val['tofel_l']=='' || $val['tofel_l']='0')echo 'selected="selected"';?>>Listen</option>
            <option value="1" <?php if($val['tofel_l']=='1')echo 'selected="selected"';?>>A</option>
            <option value="2" <?php if($val['tofel_l']=='2')echo 'selected="selected"';?>>B</option>
            <option value="3" <?php if($val['tofel_l']=='3')echo 'selected="selected"';?>>C</option>
        </select>
        
        <select name="<?php echo $key;?>[]" style="width:50px;" placeholder="OA">
            <option value="0" <?php if($val['tofel_s']=='' || $val['tofel_s']='0')echo 'selected="selected"';?>>Speak</option>
            <option value="1" <?php if($val['tofel_s']=='1')echo 'selected="selected"';?>>A</option>
            <option value="2" <?php if($val['tofel_s']=='2')echo 'selected="selected"';?>>B</option>
            <option value="3" <?php if($val['tofel_s']=='3')echo 'selected="selected"';?>>C</option>
        </select>

	</td>

      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['oet_overall'];?>" placeholder="OA"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['oet_r'];?>" placeholder="R"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['oet_w'];?>" placeholder="W"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['oet_l'];?>" placeholder="L"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['oet_s'];?>" placeholder="S"  style="width:50px;" />   			</td>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['gre'];?>" placeholder="GRE"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['gmat'];?>" placeholder="GMAT"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['sat'];?>" placeholder="SAT"  style="width:50px;" /></td>
      <td><input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['10th'];?>" placeholder="10th"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['12th'];?>" placeholder="12th"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['total_percentage'];?>" placeholder="Total %"  style="width:50px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['grade'];?>" placeholder="Grade"  style="width:50px;" /></td>
      <td><input type="text" name="<?php echo $key;?>[]"  value="<?php echo $val['arrears'];?>" placeholder="Arrears" style="width:70px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['absense'];?>" placeholder="Absense" style="width:70px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['repeat'];?>" placeholder="Repeat" style="width:70px;" />
        <input type="text" name="<?php echo $key;?>[]" value="<?php echo $val['year_back'];?>" placeholder="Yr. Back" style="width:70px;" /></td>
      <td>
      <select name="<?php echo $key;?>[]" style="width:100px;" placeholder="OA">
        <option value="0" <?php if($val['scholarship']=='' || $val['scholarship']='0')echo 'selected="selected"';?>>Scholarship</option>
        <option value="1" <?php if($val['scholarship']=='1')echo 'selected="selected"';?>>30%</option>
        <option value="2" <?php if($val['scholarship']=='2')echo 'selected="selected"';?>>50%</option>
        <option value="3" <?php if($val['scholarship']=='3')echo 'selected="selected"';?>>100%</option>
      </select></td>
    </tr>
<?php } ?>   
  </table>

<input type="submit" name="fee_details" value="Update" />
 

</form>

<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
<script>
$(document).ready(function()
{
	$('#start_date').datepicker({
		dateFormat: "yy-mm-dd"
	});
});	

function validate()
{	
	if($('#course_name').val()=='')
	{
		alert('Please enter course name');
		$('#course_name').focus();
		return false;
	}
	
   
	if($('#level_study').val()=='')
	{
		alert('Please select level');
		$('#level_study').focus();
		return false;
	}
	if($('#type').val()==0)
	{
		alert('Please select type');
		$('#type').focus();
		return false;
	}

	return true;
}
</script>		

