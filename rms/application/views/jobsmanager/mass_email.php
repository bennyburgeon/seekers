
<div class="col-md-12">


<div class="profile_top">
<div class="profile_top_left">
<a href="<?php echo base_url();?>index.php/jobsmanager/manage/<?php echo $formdata['job_id'];?>">Summary</a>&nbsp;&nbsp;&nbsp;||&nbsp;&nbsp;&nbsp; 
<a href="<?php echo base_url();?>index.php/jobsmanager/search_candidate/<?php echo $formdata['job_id'];?>">Search Candidates</a> &nbsp;&nbsp;&nbsp;||	&nbsp;&nbsp;&nbsp;
Mass Email	&nbsp;&nbsp;&nbsp; ||&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url();?>index.php/jobsmanager/add_candidate/<?php echo $formdata['job_id'];?>">Add New Candidate</a>	&nbsp;&nbsp;&nbsp; ||</div>  

<div style="clear:both;"></div>
</div>



<div >

<table border="0" cellpadding="3" cellspacing="3" width="100%">

  <tbody>
      
        <tr>
                <td align="center" valign="">
<form class="form-horizontal form-bordered" method="post" id="summary" name="summary" action="<?php echo base_url(); ?>index.php/jobsmanager/send_mass_mail/<?php echo $postdata['job_id'];?>"> 
      	<input name="job_id" value="<?php echo $postdata['job_id'];?>" type="hidden">
                        <table width="100%" border="0"  cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td colspan="2" align="center" valign="middle"><br>
        <br>

        <textarea name="emails_list" cols="100" rows="5" id="textarea"></textarea></td>
    </tr>
    <tr>
      <td width="45%" align="right" valign="middle">  <button class="radius3" onclick="search_submit();" id="applyfilter">Send Emails</button></td>
      <td width="55%" align="left" valign="middle">[Use  &quot; ,&quot; to separate]</td>
    </tr>
  </tbody>
</table>
 </form>
                        
                </td>
        </tr>                        

      <tr>
        <td align="center" valign="top">
       <br>
<br>

      	<table border="1" cellpadding="3" cellspacing="3" width="100%" class="table table-bordered table-condensed">
        	<colgroup>
          		<col class="con0" style="width: 4%" />
          		<col class="con1" />
          		<col class="con0" />
          		<col class="con1" />
          		<col class="con0" />
          </colgroup>
        <thead>
          <tr>
            <th colspan="6" align="right"><?php echo $pagination; ?> &nbsp;&nbsp;</th>
            </tr>
          <tr>
            <th width="2%" class="head0">&nbsp;</th>
            <th width="35%" class="head1">Name</th>            
            <th width="30%" class="head0">Email</th>
            <th width="12%" class="head1">Sent On</th>
            <th width="9%" class="head0">Opened On</th>
            <th width="12%" class="head1">Action</th>
            </tr>
        </thead>
        
        <tfoot>
          <tr>
            <th class="head0">&nbsp;</th>
            <th class="head1">Name</th>            
            <th class="head0">Email</th>
            <th class="head1">Sent On</th>
            <th class="head0">Opened On</th>
            <th class="head1">&nbsp;</th>
            </tr>
          <tr>
            <th colspan="6"  align="right"><?php echo $pagination; ?> &nbsp;&nbsp; `</th>
            </tr>
      </tfoot>
    <tbody>
      <?php 
				foreach($candidates as $result){ 
			?>
      <tr>
        <td align="center">&nbsp;</td>
        <td><a href="<?php echo base_url();?>index.php/candidates_all/edit/<?php echo $result['candidate_id']?>" target="_blank"><?php echo $result['candidate_name'];?></a><?php if($result['email_status']==1){?>&nbsp;&nbsp;&nbsp;<a href="javascript:;" title="Emailed" class="btn btn-info btn-xs">Emailed </a><?php } ?>

<?php if($result['email_status']==2){?>&nbsp;&nbsp;&nbsp;
<a href="javascript:;" title="Opened" id="reject_from_application" class="btn btn-warning btn-xs"> Opened</a><?php } ?>

<?php if($result['email_status']==3){?>&nbsp;&nbsp;&nbsp;
<a href="javascript:;" title="Registered" class="btn btn-primary btn-xs">Registered</a>
<?php } ?>
        
        </td>       
        <td><?php echo $result['email']?></td>
        <td><?php echo $result['date_sent']?></td>
        <td class="center"><?php if($result['date_opened']!='0000-00-00')echo $result['date_opened'];else echo 'Not Opened'?></td>
         <td>
         <?php if($result['candidate_id']>0){?>
<a href="<?php echo base_url(); ?>index.php/candidates_all/edit/<?php echo $result['candidate_id'];?>/" title="Edit Candidate Profile" target="_blank"  id="view_cv" class="btn btn-danger btn-xs btn-icon"><i class="fa fa-edit" aria-hidden="true"></i></a>

<a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $result['candidate_id']?>" title="View Candiadte Summary" target="_blank" class="btn btn-xs btn-primary btn-icon"><i class="fa fa-eye" aria-hidden="true"></i></a>

<a href="<?php echo base_url();?>index.php/candidates_all/print_cv/<?php echo $result['candidate_id']?>"  title="Print CV" target="_blank" class="btn btn-xs btn-success btn-icon"><i class="fa fa-print" aria-hidden="true"></i></a>
  		<?php }?>
  
           </td>
        </tr>     
      <?php }?>
      
      
      </tbody>
    </table>
</td>
    </tr>
</tbody></table>



  
</section>

<script type="text/javascript">

$(document).on('click', '#send_jd', function()
{
  if(window.confirm("Are sou sure want to email candidate with Job Description?"))
  {  
	 var $url= $(this).attr('data-url');	
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   success: function(data){
		   //alert(data.email); - how to access json array, data is object set and email is one of the keys
		   	alert('Emailed to '+data.candidate_name);
	   }
	 }); 
  }
});

</script>