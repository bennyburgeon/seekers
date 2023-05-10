<?php

if(!empty($form_data)){

$count	=	(count($form_data)>3)?3:count($form_data);
for($i=0;$i<$count;$i++) { ?>

<div style="border:1px solid #aeaeae;margin-top:4%;padding:5px;" >

 <h4>Job Details</h4> 
<table class="hori-form">
<tbody>

<tr>
<td>Organization Name</td>
 <td><?php echo $form_data[$i]["organization"]; ?></td>
</tr>
<tr>
<td>Designation</td>
 <td><?php echo $form_data[$i]["designation"]; ?> </td>
</tr>
<tr>
<td>Category</td>
 <td> <?php echo $form_data[$i]["industry"]; ?> </td>
</tr>



<tr>
<td>Function/Role</td>
 <td> <?php echo $form_data[$i]["function"]; ?> </td>
</tr>
<tr>
<td colspan="2" id="step4-msg">

</td>
</tr>
<tr>
<td colspan="3">

<a class="pull-right job-delete" title="Delete" data-id="<?php echo $form_data[$i]["job_profile_id"]; ?>"  href="javascript:;">Delete</a>


</td>
</tr>
</tbody>
</table>


<div style="clear:both;"></div>
</div>
<?php } } ?>