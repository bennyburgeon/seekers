<?php

if(!empty($form_data)){

$count	=	(count($form_data)>3)?3:count($form_data);
for($i=0;$i<$count;$i++) { ?>

<div style="border:1px solid #aeaeae;margin-top:4%;padding:5px;" id="edu-div">

 <h4>Education Details</h4> 
<table class="hori-form">
<tbody>

<tr>
<td>Level of Study</td>
 <td><?php echo $form_data[$i]["level_name"]; ?></td>
</tr>
<tr>
<td>Course</td>
 <td><?php echo $form_data[$i]["course_name"]; ?> </td>
</tr>
<tr>
<td>Specialization/Industry</td>
 <td> <?php echo $form_data[$i]["spec_name"]; ?> </td>
</tr>



<tr>
<td>Grade</td>
 <td> <?php echo $form_data[$i]["grade"]; ?> </td>
</tr>
<tr>
<td colspan="2" id="step4-msg">

</td>
</tr>


<tr>
<td colspan="3">

<a class="pull-right edu-delete" title="Delete" data-id="<?php echo $form_data[$i]["eucation_id"]; ?>"  href="javascript:;">Delete</a>


</td>
</tr>
</tbody>
</table>


<div style="clear:both;"></div>
</div>
<?php } } ?>