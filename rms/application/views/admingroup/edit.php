<section class="bot-sep">
<div class="section-wrap">
<div class="row">
 <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active">Admin Edit Group </li>
      </ul>

</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Edit</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
      <form role="form" action="<?php echo $this->config->site_url();?>/admingroup/update"  enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();"> 
                                        <?php echo form_hidden('user_grp_id', $formdata["user_grp_id"]);?>
<tr>
<td>Admin group Name</td>
<td> <input type="text" placeholder="Enter Group Name" value="<?php echo $formdata["user_grp_name"] ?>"  name="user_grp_name" id="user_grp_name" class="form-control"></td>
</tr>
<tr>
<td>Inlin Ratio</td>
<td>

 <label class="radio-inline">
      <input type="radio" name="status" value="1" <?php if($formdata['status']==1){?> checked <?php } ?> >Active</label>
    <label class="radio-inline">
   <input type="radio" name="status"  value="0" <?php if($formdata['status']==0){?> checked <?php } ?> >Inactive</label>


</tr>
<tr>
<td>Permission Setting</td>
 <td> <input type="checkbox" id="selectall" name="selectall" value="">
														<?php
                                                        function create_html( $records, $html='',$admin_modules) {
                                                        $html .='<ul>';
                                                        foreach($records as $result){ 
                                                        if(is_array($admin_modules) && in_array($result["id"],$admin_modules))
                                                        {
                                                        $checked = 'checked="checked"';
                                                        }
                                                        else {$checked = '';}
                                                        $html .= '<li><input type="checkbox" '.$checked.' name="modules[]" value="'.$result["id"].'" id="'.str_replace(".","-",$result["count"]).'" >'.$result["name"];
                                                        
                                                        if(count($result["sub"])>0){
                                                        $html = create_html( $result["sub"], $html,$admin_modules);
                                                        $html.= '</li>';
                                                        }
                                                        else
                                                        {
                                                        $html.= '</li>';
                                                        }
                                                        
                                                        }
                                                        $html .='</ul>';
                                                        return $html;
                                                        }
                                                        
                                                        print create_html( $modules,'',$admin_modules );
                                                        ?> 
 </td>
</tr>


<tr>
<td colspan="2">
<span class="click-icons">
<input type="submit" class="attach-subs" value="Submit">
<a href="<?php echo $this->config->site_url();?>/admingroup" class="attach-subs subs">Cancel</a>
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
	if($('#user_grp_name').val()=='' )
 {
  alert('Please enter Group name');
  $('#email').focus();
  return false;
 }
 
	
 
}
</script>
