<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">
	<ul class="page-breadcrumb breadcrumb">
        <li> <a href="">Home</a></li>
        <li class="active">Current Openings</li>
      </ul></div>
</div>
<div class="row">

<div class="col-md-12">
<div class="profile_top">
<div class="profile_top_left">Jobs</div>

<div style="clear:both;"></div>
</div>



<div class="profile_bottom" id="leads" style="height:auto;">
<div class="tasks profile">
<div id="response"></div>
    <table>
      	<thead>
        	<tr>
            
                <th>Industry </th>
                <th></th>
               
                
        	</tr>
        </thead>
        <tbody>
			<?php 
				if(isset($industry) && !empty($industry))
				{
				 foreach($industry as $job)
				 {
					?>
            	<tr>
        			<td><?php echo $job->job_cat_name; ?></td>
                    <td><a href="<?php echo $this->config->base_url();?>index.php/home?industry_id=<?php echo $job->job_cat_id; ?>">View Jobs</a></td>
                     
                </tr>
		<?php } } ?>
        </tbody>
 </table>
</div>
<div class="tasks profile" style="margin-top:30px;">
    <table>
      	<thead>
        	<tr >
            
                <th>Country </th>
                <th></th>
               
                
        	</tr>
        </thead>
        <tbody>
			<?php 
				if(isset($country) && !empty($country))
				{
				 foreach($country as $job)
				 {
					?>
            	<tr>
        			<td><?php echo $job->country_name; ?></td>
                    <td><a href="<?php echo $this->config->base_url();?>index.php/home?country_id=<?php echo $job->country_id; ?>">View Jobs</a></td>
                     
                </tr>
		<?php } } ?>
        </tbody>
 </table>
 </div>
 <div class="tasks profile" style="margin-top:30px;">
  <table>
      	<thead>
        	<tr >
            
                <th>Company </th>
                <th ></th>
               
                
        	</tr>
        </thead>
        <tbody>
			<?php 
				if(isset($company) && !empty($company))
				{
				 foreach($company as $job)
				 {
					?>
            	<tr>
        			<td><?php echo $job->company_name; ?></td>
                    <td><a href="<?php echo $this->config->base_url();?>index.php/home?company_id=<?php echo $job->company_id; ?>">View Jobs</a></td>
                     
                </tr>
		<?php } } ?>
        </tbody>
 </table>

</div>
</div>
</div>
</div>


</div>
</div>
</div>
</section>






