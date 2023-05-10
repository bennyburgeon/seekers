<div class="sidebar-area inner-pages">
<div class="side-btn"><img src="<?php echo base_url('assets/images/sidebar.png');?>"></div>
<div class="sidebar-2">
<div class="profile_box sides">
<ul>
<li class="active"><a href="#">Overview</a></li>
<li><a href="#">Account Settings</a></li>
</ul>
</div>
</div>
</div>
<section class="bot-sep">
<div class="section-wrap">
<div class="row">

<!-- BEGIN SAMPLE FORM PORTLET-->




<div class="col-sm-12 pages">
<a href="<?php echo $this->config->site_url();?>country">Country</a> / <?php echo $page_head;?></div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url('assets/images/head-icon-7.png');?>" alt=""/><h3>country form</h3></div>
<?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 
<div class="table-tech specs hor">
    <table class="hori-form">
    	 <tbody>
             <form action="<?php echo $this->config->site_url();?>country/add" class="form-horizontal form-bordered"  method="post" id="frmentry" 
             name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
               
                    <tr>
                        <td>Country Name</td>
                        <td>
                        <input type="text" placeholder="" class="form-control input-large" id="country_name" name="country_name" value="<?php echo $formdata['country_name'];?>" >
                        </td>
                    </tr>
					
                    <tr>
                        <td>Intl Code</td>
                        <td>
                        <input type="text" placeholder="" class="form-control input-large" id="intl_code" name="intl_code" value="<?php echo $formdata['intl_code'];?>" >
                        </td>
                    </tr>

<tr>
                        <td>Intl Prefix</td>
                        <td>
                        <input type="text" placeholder="" class="form-control input-large" id="intl_dial_prefix" name="intl_dial_prefix" value="<?php echo $formdata['intl_dial_prefix'];?>" >
                        </td>
                    </tr>                    
                                        
                    <tr>
                        <td>Status</td>
                        <td>
                        <label><input type="radio" name="status" id="optionsRadios1" value="1" <?php if($formdata['status']==1)echo 'checked="checked"';?> class="hor-check"> 
                        Active</label>
                        <label><input type="radio" name="status" id="optionsRadios2" value="0" <?php if($formdata['status']==0)echo 'checked="checked"';?> class="hor-check"> 
                        Inactive </label></td>
                    </tr>
                    
                    <tr>
                        <td>Visa</td>
                        <td> <?php echo $this->ckeditor->editor('visa',$formdata['visa']);?>
                        </td>
                    </tr>
                    
                     <tr>
                        <td>Medical</td>
                        <td> <?php echo $this->ckeditor->editor('medical',$formdata['medical']);?>
                        </td>
                    </tr>
                    
                     <tr>
                        <td>Docs Required</td>
                        <td> <?php echo $this->ckeditor->editor('docs_required',$formdata['docs_required']);?>
                        </td>
                    </tr>
                    
                     <tr>
                        <td>Visa Process</td>
                        <td> <?php echo $this->ckeditor->editor('visa_process',$formdata['visa_process']);?>
                        </td>
                    </tr>
                    
                   
                    <tr>
                        <td colspan="2">
                        <span class="click-icons">
                        <input type="submit" class="attach-subs" value="Submit">
                        <a href="<?php echo $this->config->site_url();?>country" class="attach-subs subs">Cancel</a>
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
<script type="text/javascript">
function validate()
{
	if($('#country_name').val()=='')
	{
		alert('Please enter country name');
		$('#country_name').focus();
		return false;
	}
	return true;
}
</script>		