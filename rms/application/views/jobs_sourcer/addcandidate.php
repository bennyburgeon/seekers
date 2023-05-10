<body class="withvernav">
<div class="bodywrapper">

      <!--leftmenu-->
        
        
    <div class="centercontent tables">
    
        <div class="pageheader notab">
            <h1 class="pagetitle">Tables</h1>
            <span class="pagedesc">This is a sample description of a page</span>
            
        </div><!--pageheader-->
      <!--pageheader-->
        
<div id="contentwrapper" class="contentwrapper widgetpage">
                        <div class="contenttitle2">
                	<h3>Add Candidates to Job - #12 PHP Programmers</h3>
                </div><!--contenttitle-->

               <div class="tableoptions">
                	<button class="addbutton radius3" title="table1">Add to job</button> &nbsp;
                   <?php echo form_dropdown('job_cat_list', $jobcategory, $postdata['job_cat_id'],'onChange="document.frmcandidate.job_cat_id.value=this.value;"');?> &nbsp;
                    <?php echo form_dropdown('func_list', $functional, $postdata['func_id'], 'onChange="document.frmcandidate.func_id.value=this.value;"');?> &nbsp;
                    <?php echo form_dropdown('country_list', $nationality, $postdata['country_id'], 'onChange="document.frmcandidate.country_id.value=this.value;"');?> &nbsp;
                    
                    <button class="radius3" id="applyfilter">Apply Filter</button>
                </div>
				 <?php echo form_open_multipart('jobs_sourcer/addcandidate/'.$postdata['job_id'], 'name="frmcandidate"');?>
				 <?php echo form_hidden('job_id', $postdata['job_id']);?>
				 <?php echo form_hidden('job_cat_id', $postdata['job_cat_id']);?>
                 <?php echo form_hidden('func_id', $postdata['func_id']);?>
                 <?php echo form_hidden('country_id', $postdata['country_id']);?>
                 
                <table cellpadding="0" cellspacing="0" border="0" id="table1" class="stdtable stdtablecb">
                    <colgroup>
                        <col class="con0" style="width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        
                       
                    </colgroup>
                    <thead>
                        <tr>
                        	<th class="head0"><input type="checkbox" class="checkall" style="widows:100px;" /></th>
                            <th class="head1">Name</th>
                            <th class="head0">Email</th>
                            <th class="head1">Total Exp.</th>
                            <th class="head0">Skills</th>
                            <th class="head1">View CV</th>
                           
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        	<th class="head0"><input type="checkbox" class="checkall" /></th>
                            <th class="head1">Name</th>
                            <th class="head0">Email</th>
                            <th class="head1">Total Exp.</th>
                            <th class="head0">Skills</th>
                            <th class="head1">View CV</th>
                          
                        </tr>
                    </tfoot>
                    <tbody>
            <?php 
				foreach($candidates as $result){ 
			?>
                        <tr>
                        	<td align="center"><input type="checkbox" id="delete_rec<?php echo $result['candidate_id']?>" name="delete_rec[]" value="<?php echo $result['candidate_id']?>" /></td>
                            <td><?php echo $result['first_name'].' '.$result['last_name'];?></td>
                            <td><?php echo $result['username']?></td>
                            <td><?php echo $result['exp_years']?></td>
                            <td class="center"><?php echo $result['skills']?></td>
                            <td class="center">
							<?php if(file_exists('uploads/cvs/'.$result['cv_file']) && $result['cv_file']!=''){?>
                    		<a href="<?php echo $upload_root.'uploads/cvs/'.$result['cv_file'];?>" target="_blank">View</a>
                    		<?php } ?></td>
                            
                        </tr>
				<?php 
					}
				?>
                
                
                    </tbody>
                </table>

         <?php echo form_close();?>
                            
      </div><!--contentwrapper-->
        
	</div><!-- centercontent -->
    
    
</div><!--bodywrapper-->


<script>

jQuery('#applyfilter').click(function(){
	if(document.frmcandidate.job_cat_id.value=='' && document.frmcandidate.func_id.value=='' && document.frmcandidate.country_id.value=='')
	{
		alert('Please select catgory');
		return;
	}else
	{
		document.frmcandidate.submit();
		return;
	}
});

	///// new function for adding candidate /////
	jQuery('.addbutton').click(function()
	{
		var tb = jQuery(this).attr('title');							// get target id of table								   
		var sel = false;												//initialize to false as no selected row
		var ch = jQuery('#'+tb).find('tbody input[type=checkbox]');		//get each checkbox in a table
		//check if there is/are selected row in table
		ch.each(function(){						 
			if(jQuery(this).is(':checked')) 
			{
				sel = true;
				jQuery(this).parents('tr').fadeOut(function(){
					jQuery(this).remove();								//remove row when animation is finished
				});
			}
		});
		
		if(sel==false) 
			alert('No data selected');
		else
			document.frmcandidate.submit();
	});

function getXMLHTTP()
{
	var xmlhttp=false;	
	try{
			xmlhttp=new XMLHttpRequest();
		}
	catch(e)
	{		
		try
		{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e1)
			{
					xmlhttp=false;
			}
		}
	}
	return xmlhttp;
}

function addcandidates(candidate_id)
{
if(candidate_id<1) return;

var strURL="<?php echo base_url(); ?>index.php/jobs_sourcer/add_candidate_to_job/?candidate_id="+candidate_id + "&job_id=" + document.frmcandidate.job_id.value ;

alert(strURL);
return;
 var req = getXMLHTTP(); // fuction to get xmlhttp object
 if (req)
 {

  req.onreadystatechange = function()
 {
  if (req.readyState == 4) { //data is retrieved from server
   if (req.status == 200) { // which represents ok status                    
			 return true;			 
	  }
	  else
	  {
		 return false;
	  }
  }
  }
req.open("GET", strURL, true); //open url using get method
req.send(null);
 }
}

</script>

</body>


