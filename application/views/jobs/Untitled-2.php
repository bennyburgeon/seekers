<form class="form-horizontal form-bordered"  method="post" id="candidate_form4" name="candidate_form4" action="http://localhost/placement/admin/index.php/jobs/create_invoice/4" onSubmit="return candidate_validate();"> 
  
  <input type="hidden" name="candidate_id" value="37">
  <input type="hidden" name="app_id" value="1">
  <input type="hidden" name="placement_id" value="2">
  
<table class="hori-form">
<tbody>



<tr>
<td>Invoice Date</td>
 <td><input type="text" name="invoice_date" value="" class="smallinput"  /> </td>
</tr>

<tr>
<td>Invoice Start Date</td>
 <td><input type="text" name="invoice_start_date 	" value="" class="smallinput"  /> </td>
</tr>

<tr>
<td>Invoice Due Date</td>
 <td><input type="text" name="invoice_due_date" value="" class="smallinput"  /> </td>
</tr>

<tr>
<td>Replacement Date</td>
 <td><input type="text" name="replacement_date" value="" class="smallinput"  />  </td>
</tr>

<tr>
<td>Invoice Amount</td>
 <td><input type="text" name="invoice_amount" value="" class="smallinput"  /> </td>
</tr>

<tr>
<td>Invoice Status</td>
 <td><input type="radio"  name="invoice_status" value="1">&nbsp;Paid&nbsp;<input type="radio"  name="invoice_status" value="2"  checked>&nbsp;Unpaid&nbsp;<input type="radio"  name="invoice_status" value="3">&nbsp;Due</td>
</tr>


<tr>
  <td colspan="2">
  <span class="click-icons">
  <input type="submit" class="attach-subs" value="Save" id="save_candidate3" style="width:180px;">
  </span>
  </td>
</tr>
</tbody>
</table>

</form>