<body class="withvernav">
<div class="bodywrapper">

 <!--- header starts here --> 
   
    <!--- header ends here --> 
     <?php $this->view('common/top_menu'); ?>
    <?php $this->view('common/left_menu'); ?>
    
    <!--leftmenu-->

  <div class="centercontent tables">
    
      <div id="contentwrapper" class="contentwrapper">
          <!--contenttitle-->
                          
                <div class="contenttitle2">
                	<h3><?php echo $page_head;?></h3>
                </div><!--contenttitle-->
                <?php if(isset($del) && $del==1){?>
                <div class="notibar msgsuccess">
                        <a class="close"></a>
                        <p>Records(s) deleted.</p>
        </div>
                 <?php } ?>
                <?php if(isset($ins) && $ins==1){?>
                <div class="notibar msgsuccess">
                        <a class="close"></a>
                        <p>New record added successfully.</p>
        </div>
                 <?php } ?>     
                <?php if(isset($upd) && $upd==1){?>
                <div class="notibar msgsuccess">
                        <a class="close"></a>
                        <p>Record updated successfully.</p>
        </div>
                 <?php } ?>                             
                <div class="tableoptions">
                 <button class="deletebutton radius3" title="table1" id="del_records" onClick="confirm_delete();">Delete Selected</button>&nbsp;
                 
                  <button class="radius3" onClick="window.location='<?php echo base_url();?>candidates_all/add'">Add New</button>
                   
                </div><!--tableoptions-->
       
           <?php echo form_open_multipart('candidates_all/delete/','name="stdform"');?>		
                    
       
        <table cellpadding="0" cellspacing="0" border="0" class="stdtable stdtablecb">
                    <colgroup>
                        <col class="con0" style="width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                    </colgroup>
                    <thead>
                        <tr>
                        	<th class="head0"><input type="checkbox" id="header" name="header" class="checkall" /></th>
                            <th class="head1">Candidate Name</th>
                            <th class="head1">Email</th>
                            <th class="head1">Mobile</th>
                            <th class="head1">Land Phone</th>
                            <th class="head1">Exp.</th>
                            <th class="head0">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        	<th class="head0"><input id="footer" type="checkbox" name="footer" class="checkall" /></th>
                            <th class="head1">Candidate Name</th>
                            <th class="head1">Email</th>
                            <th class="head1">Mobile</th>
                            <th class="head1">Land Phone</th>
                            <th class="head1">Exp.</th>
                            <th class="head0">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    
                    	<?php 
				foreach($records as $result){ 
			?>
                        <tr>
                        	<td align="center"><input type="checkbox" id="delete_rec" name="delete_rec[]" value="<?php echo $result['candidate_id']?>"/></td>
                            <td><?php echo $result['first_name'].' '.$result['last_name'];?></td>
                            <td><?php echo $result['username']?></td>
                            <td><?php echo $result['first_name'].' '.$result['last_name'];?></td>
                            <td><?php echo $result['first_name'].' '.$result['first_name'];?></td>
                            <td><?php echo $result['exp_years']?></td>
                            <td class="center"><a href="<?php echo base_url();?>candidates_all/edit/<?php echo $result['candidate_id']?>" class="edit">Edit</a> &nbsp;|&nbsp; <a href="<?php echo base_url();?>candidates_all/delete/<?php echo $result['candidate_id']?>" class="delete" onClick="return alert_delete();">Delete</a></td>
                        </tr>
                        
                        <?php
						}
						?>
                        
                        
                        <?php 
						if($total_rows==0){
						?>
                         <tr>
                        <td colspan="3" align="center">No records found</td>
                        </tr>
                        <?php } ?>
                    </tbody>
        </table>



<?php echo $pagination; ?>

         <?php echo form_close();?>
    </div><!--contentwrapper-->
        
  </div><!-- centercontent -->
    
    <script type="text/javascript">

jQuery(document).ready(function(){

	jQuery('.stdtablecb .checkall').click(function(){

		var parentTable = jQuery(this).parents('table');										   
		var ch = parentTable.find('tbody input[type=checkbox]');										 
		if(jQuery(this).is(':checked')) {
		
			//check all rows in table
			ch.each(function(){ 
				jQuery(this).attr('checked',true);
				jQuery(this).parent().addClass('checked');	//used for the custom checkbox style
				jQuery(this).parents('tr').addClass('selected');
			});
						
			//check both table header and footer
			parentTable.find('.checkall').each(function(){ jQuery(this).attr('checked',true); });
		
		} else {
			
			//uncheck all rows in table
			ch.each(function(){ 
				jQuery(this).attr('checked',false); 
				jQuery(this).parent().removeClass('checked');	//used for the custom checkbox style
				jQuery(this).parents('tr').removeClass('selected');
			});	
			
			//uncheck both table header and footer
			parentTable.find('.checkall').each(function(){ jQuery(this).attr('checked',false); });
		}
	});

});

function confirm_delete()
{
	var cnt=0;
	var del_rec=document.stdform.delete_rec;

	
	if(del_rec.length==undefined)
	{	
		if(del_rec.checked==true)
		{
			document.stdform.submit();
			return true;
		}else{		
			alert('Please select one record to delete');
			return false;
		}
	}


		for (i = 0; i < del_rec.length; i++)
		{
			if(del_rec[i].checked ==true)
			{
				var answer = confirm ("Are you sure to delete the records?");
				if (answer)	stdform.submit();
				return true;
			}
		}
	
	alert('Please select one record to delete')
	return false;
}
function alert_delete()
{
	var answer = confirm ("Are you sure to delete the records?");
	if (answer)
		return true;
	else
		return false;
}
</script>
</div><!--bodywrapper-->
</body>

