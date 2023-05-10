<section class="bot-sep">
<div class="section-wrap">
<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->

<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active"><?php echo $page_head;?></li>
      </ul>
</div>


<div class="row">
<div class="col-sm-12">
<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-7.png" alt=""/><h3>college form</h3></div>
 <?php if(validation_errors()!=''){?> 
<div class="alert alert-success alert-danger">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
<strong><?php echo validation_errors(); ?></strong>
</div>
<?php } ?> 
<div class="table-tech specs hor">
    <table class="hori-form">
        <tbody>
            <form action="<?php echo $this->config->site_url();?>/manage_college/update" class="form-horizontal form-bordered"  method="post" id="frmentry" name="frmentry" onSubmit="return validate();" enctype="multipart/form-data"> 
            <?php echo form_hidden('college_id', $formdata["college_id"]);?>
                <tr>
                    <td>College Name</td>
                    <td><input type="text" placeholder="Enter College Name" value="<?php echo $formdata["college_name"] ?>"  name="college_name" id="college_name" class="form-control"></td>
                </tr>
                
                <?php /*?><tr>
                    <td>Inline Radio</td>
                    <td>
                    
                    <div class="radio-list">
                    <label class="radio-inline">
                    <div class="radio" id="uniform-optionsRadios4"><span><input type="radio" <?php if($formdata["status"]==1){echo 'checked="checked"';} ?> value="1" id="optionsRadios4" name="status"></span></div> Active </label>
                    <label class="radio-inline">
                    <div class="radio" id="uniform-optionsRadios5"><span><input type="radio" <?php if($formdata["status"]==0){echo 'checked="checked"';} ?> value="0" id="optionsRadios5" name="status"></span></div> Inactive </label>
                    
                    </div>
                    </td>
                </tr><?php */?>
               
                <tr>
                    <td colspan="2">
                    <span class="click-icons">
                    <input type="submit" class="attach-subs" value="Submit">
                    <a href="<?php echo $this->config->site_url();?>/manage_college" class="attach-subs subs">Cancel</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">
function validate()
{
	if($('#college_name').val()=='' )
 {
  alert('Please enter Certifiaction name');
  $('#college_name').focus();
  return false;
 }
}
</script>