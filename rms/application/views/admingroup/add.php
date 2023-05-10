<section class="bot-sep">
<div class="section-wrap">
<div class="row">
 <ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
        <li class="active">Admin Add Group </li>
      </ul>

</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>Add  Group</h3></div>

 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 

<div class="table-tech specs hor">
<table class="hori-form">
<tbody>
 <form role="form" action="<?php echo $this->config->site_url();?>/admingroup/add"  enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onSubmit="return validate();">  
<tr>
<td>Admin group Name</td>
<td> <input type="text" placeholder="Enter Group Name" value="<?php echo $formdata["user_grp_name"] ?>"  name="user_grp_name" id="user_grp_name" class="form-control"></td>
</tr>
<tr>
<td>Inlin Ratio</td>
<td><label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios4"><span><input type="radio" checked="" value="1" id="optionsRadios4" name="status"></span></div> Active </label>
                                        <label class="radio-inline">
                                        <div class="radio" id="uniform-optionsRadios5"><span><input type="radio" value="0" id="optionsRadios5" name="status"></span></div> Inactive </label></td>
</tr>
<tr>
<td>Permission Setting</td>
 <td> <input type="checkbox" id="selectall" name="selectall" value="">                                                         <?php
                                                    function create_html( $records, $html='') 
                                                    {
                                                    $html .='<ul>';
                                                    foreach($records as $result){ 
                                                    $html .= '<li><input type="checkbox" name="modules[]" value="'.$result["id"].'" id="'.str_replace(".","-",$result["count"]).'" >'.$result["name"];
                                                    
                                                    if(count($result["sub"])>0)
                                                    {
                                                    $html = create_html( $result["sub"], $html);
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
                                                    print create_html( $modules,'' );
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
  $('#user_grp_name').focus();
  return false;
 }
 
	
 
}
</script>
