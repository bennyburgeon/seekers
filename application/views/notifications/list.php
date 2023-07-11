<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<ul class="page-breadcrumb breadcrumb">
        <li> <a href="<?php echo $this->config->site_url()?>/dasboard">Home</a><i class="fa fa-circle"></i> </li>
        <li class="active">Notifications </li>
      </ul>
</div>

<?php if($this->input->get('ins')==1){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Sucess !</strong> one record added. </div>
          <?php } ?>
          <?php if($this->input->get('upd')==1){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Sucess !</strong> record updated. </div>
          <?php } ?>
          <?php if($this->input->get('del')==1){?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Delete !</strong> record(s) deleted. </div>
          <?php }  else if($this->input->get('del')==2){ ?>
          <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
            <strong>Error !</strong> Cannot delete records, related records found. </div>
          <?php } ?> 

<div class="row">
<div class="col-sm-12">


<div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/><h3><?php echo $page_head;?></h3></div>


<div class="table-tech specs">
<form name="form1" method="post" id="form1" action="<?php  echo $this->config->site_url();?>/notifications/delete?rows=<?php echo $rows;?>" >


<div style="clear:both;"></div>
<table class="tool-table new">
<thead>
<tr>
<th><div class="checker"><span><input type="checkbox" class="group-checkable" id="selectall"></span></div></th>
                         <th>
								Date</th>
 <th>Sent By</th>
 <th>Message</th>
</tr>
</thead>
<tbody>

<?php 
	if($records!=NULL)
						  {
    foreach($records as $key => $val){ 
    ?>
    <tr>
    <td>
	<div class="checker">
    	<span>
    		#
        </span>
	</div>
</td>
    <td><?php echo $val['message_date'];?></td>
	<td>
	
    <?php if($val['admin_id']>0){ ?>
           <span class="btn btn-success btn-xs disabled"><?php echo $val['recruiter']; ?></span>			
			<?php }else{ ?>
            <span class="btn btn-primary btn-xs disabled">Its Me..</span>
            <?php } ?>
    
    </td>
	<td><?php echo $val['message_text'];?></td>

    
    </tr>
    <?php }
  }else{?>
									<tr>
										<td colspan="8" align="center">
											No Records Founds!!
										</td>
									</tr>
						   <?php } ?>    </tbody>

</table>
<br>
<br>
</form>                           
<div class="notes">
<ul>
<li id="tab_2btn">Send Message</li>
</ul>

   
	<!--Followup-->

    <div class="table-tech specs note">

    <div class="new_notes">
   
    <p id="result"></p>
    <p id="deletemessage"></p>

 
    <form action="<?php echo $this->config->site_url();?>/notifications/manage_message/" class="form-horizontal" enctype="multipart/form-data" method="post" id="frmentry" name="frmentry" onsubmit="return email_validate();" >  
 

    <h3>Message</h3>
    <textarea name="message_text" cols="" rows="" class="text_area" id="message_text"></textarea> 
    
     <span class="click-icons"><br />

    <input type="submit" name="sub3" id="sub3" class="attach-subs" value="Send">
    </span>
    </form>
    </div>
   
    <div style="clear:both;"></div>
    </div>

	

<!---------------------------END EMAIL------------------------------------->



<div style="clear:both;"></div>
</div>
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>
</section>
</div>
<script>
	function email_validate() 
	{
		if($('#message_text').val()=='')
		{
			alert('Enter Details');
			$('#message_text').focus();
			return false;
		} 
		return true;
	}
</script>
