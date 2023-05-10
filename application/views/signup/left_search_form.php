<div class="col-sm-3">
            <div class="panel panel-default">
              <div class="panel-heading"><i class="fa fa-filter" aria-hidden="true"></i><strong> Search Filter</strong></div>
              <br />
              <div class="form-group col-xs-12">
   <button type="button" onClick="window.location='<?php echo site_url('home/'); ?>';" class="btn btn-primary pull-right btn-sm"><strong>Clear Filters</strong></button><br>
<br>

                <label for="sel1">Location</label>
                
				<?php echo form_dropdown('city_id',  $city_list, $city_id,' class="form-control input-sm"');?>
                 <br>
                <label for="sel1">Industry</label>
                
       			<?php echo form_dropdown('job_cat_id',  $industry_list, $job_cat_id,' class="form-control input-sm"');?>
               <br />
                <label for="location">Role</label>
              <?php echo form_dropdown('func_id',  $functional_list, $func_id,' class="form-control input-sm"');?>               
                <br />
                <label for="location">Education Level</label>

 				<?php echo form_dropdown('level_id',  $edu_level_list, $level_id,' class="form-control input-sm"');?>
                 
                <br />
                <label for="location">Job Type</label>
                
                <div class="radio">                 
                  <label><input type="radio" name="job_type_id" value="1" <?php if($job_type_id==1)echo 'checked';?>>Full Time</label>
                </div>
               
                <div class="radio">
                  <label><input type="radio" name="job_type_id" value="2" <?php if($job_type_id==2)echo 'checked';?>>Part Time</label>
                </div>
                
                <div class="radio">
                  <label><input type="radio" name="job_type_id"  value="3" <?php if($job_type_id==3)echo 'checked';?>>Hourly Basis</label>
                </div>
           		 
                 <div class="radio">
                  <label><input type="radio" name="job_type_id"  value="4" <?php if($job_type_id==4)echo 'checked';?>>Contract Job</label>
                </div>

            	<div class="radio">
                  <label><input type="radio" name="job_type_id"  value="5" <?php if($job_type_id==5)echo 'checked';?>>Weekly Basis</label>
                </div>   
            	<div class="radio">
                  <label><input type="radio" name="job_type_id"  value="6" <?php if($job_type_id==6)echo 'checked';?>>Monthly Basis</label>
                </div>  
                
                <!--                                                             
                <br />
                  <div class="form-group">
                  <label for="usr">Skills</label>
                  <input type="text" name="skill_id" class="form-control" value="<?php echo $skill_id; ?>" placeholder="PHP, HTML, JAVA etc." id="skill_id">
                </div>
                -->
                
                <br />
                <label for="location">Salary</label>
                <?php echo form_dropdown('salary_id',  $salary_list, $salary_id,' class="form-control input-sm"');?>
               
              </div>
              <div class="panel-body"><button type="submit" onClick="" class="btn btn-primary pull-right btn-sm"><strong>Filter</strong></button></div>
            </div>
          </div>