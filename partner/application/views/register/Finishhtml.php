<script src="<?php echo base_url('assets/js/jquery-1.11.3.min.js');?>"></script>
<div id ="step2">
<div class="table-tech specs hor">

  <form class="form-horizontal form-bordered"  method="post" id="candidate_form5" name="candidate_form5" action="<?php echo $this->config->site_url();?>/register/addfiles" enctype="multipart/form-data"> 
<table class="hori-form">
<tbody>
<?php  $base=$this->config->base_url();
	   $str=str_replace("register","candidate",$base); ?>
<tr>
<td><span>Successfully Completed Your Profile!Go to<a href="<?php echo $str; ?>"> Login </a>page.</span></td>
</tr>

</tbody>
</table>
<div id="success"></div>
</form>
<div style="clear:both;"></div>
</div>
</div>
