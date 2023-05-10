<style>
th {
	font-weight:bold;
	font-family:Verdana, Geneva, sans-serif;
}
</style>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">
<section class="bot-sep">
<div class="section-wrap">
  <div class="row">
    <ul class="page-breadcrumb breadcrumb">
      <li> <a href="<?php echo $this->config->site_url()?>">Home</a> </li>
      <li class="active"><?php echo $page_head;?> </li>
    </ul>
  </div>
  <div class="alert alert-success alert-dismissable hide" id="reset_msg">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>Reset Password Link Sent </div>
  <div class="alert alert-success alert-dismissable hide" id="reset_msg_error" style="color:#F00">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Oops !</strong>Reset Password Link not sent </div>
  <?php  if($this->input->get('csv')==1){ ?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>csv file uploaded successfully. </div>
  <?php }?>
  <?php if($this->input->get('upload_err')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>upload failed.</strong> </div>
  <?php }?>
  <?php if($this->input->get('file_type_err')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>support csv file only.</strong> </div>
  <?php }?>
  <?php if($this->input->get('ins')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>record added successfully. </div>
  <?php } 
             if($this->input->get('multi')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Records !</strong> Deleted successfully. </div>
  <?php } 
           if($this->input->get('del')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>record deleted..</strong> </div>
  <?php }
                 
                 if($this->input->get('upd')==1){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong>Sucess !</strong>record updated successfully. </div>
  <?php }?>
  <?php if($this->session->flashdata('msg')){?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button"></button>
    <strong><?php echo $this->session->flashdata('msg');?></strong> </div>
  <?php } ?>
  <div class="row">
    <div class="col-sm-12">
      <div class="tab-head mar-spec"><img src="<?php echo base_url(); ?>assets/images/head-icon-2.png" alt=""/>
        <h3><?php echo $page_head;?></h3>
      </div>
      <div class="table-tech specs">
        <div class="right-btns"> <a href="<?php echo base_url();?>index.php/candidates_all/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a> </div>
        
        <!-- 
<div class="actions">
<a href="<?php echo site_url('candidates_all/import_csv');?>" class="btn btn-default btn-circle">
<i class="fa fa-plus"></i>
<span class="hidden-480">
Import CSV </span>
</a>
</div>
--> 
        <br>
        <form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>/candidates_all/">
         <input type="hidden" name="skills" id="skills"/>
          <table class="tool-table" border="1">
            <tbody>
              <tr>
                <td><input class="form-control" type="text" name="search_name" id="search_name" value="<?php echo $search_name;?>" 
                    placeholder="Name" style="width: 150px;"></td>
                <td><input class="form-control" type="text" name="search_email" id="search_email" value="<?php echo $search_email;?>" 
                    placeholder="Email" style="width: 110px;"></td>
                <td><input class="form-control" type="text" name="search_mobile" id="search_mobile" value="<?php echo $search_mobile;?>" 
                   placeholder="Mobile" style="width: 130px;"></td>
               

                <!--EDUCATION FILTER-->
                <td ><?php echo form_dropdown('level_id',  $edu_level_list, $level_id,'class="form-control " id="level_id" style="width:150px"');?></td>
                <td><?php echo form_dropdown('course_id',  $edu_course_list, $course_id,'class="form-control " id="course_id_edu" style="width:150px"');?></td>
                <td><?php echo form_dropdown('spcl_id',  $edu_spec_list, $spcl_id,'class="form-control" id="spcl_id" style="width:150px"');?></td>
                <td><a style="background-color: #2980b9;" href="<?php echo base_url();?>index.php/candidates_all" class="attach-subs tools"> Reset </a></td>
            </tr>
              <tr>
                <td >                    
                  <?php echo form_dropdown('job_folder_id',  $job_folders, $job_folder_id,'class="form-control " id="job_folder_id" style="width:150px"');?>
                    </td>
                <!--END EDUCATION FILTER-->
                
                <td> <?php echo form_dropdown('cur_job_status',  $cur_job_status_list,$cur_job_status,' id="cur_job_status" data-placeholder="Filter by status" class="form-control input-sm"');?></td>
                <td><select class="form-control" id="lead_source" name="lead_source" style="width: 130px;">
                    <option <?php if($lead_source=='')echo 'selected="selected"';?> value="" >Lead Source</option>
                    <option <?php if($lead_source==1)echo 'selected="selected"';?> value="1">Recrutier</option>
                    <option <?php if($lead_source==2)echo 'selected="selected"';?> value="2">Online/Web/Social</option>
                    <option <?php if($lead_source==3)echo 'selected="selected"';?> value="3">Vendor</option>
                    <option <?php if($lead_source==4)echo 'selected="selected"';?> value="4">Mobile</option>
                    <option <?php if($lead_source==5)echo 'selected="selected"';?> value="5">No Idea!</option>
                  </select></td>
                <td><?php echo form_dropdown('driving_license_country',  $driving_license_country_list,   $driving_license_country,'class="form-control " id="driving_license_country" style="width:150px"');?></td>
                <td></td>
                <td><?php echo form_dropdown('job_cat_id',  $job_cat_list,   $job_cat_id,'class="form-control " id="job_cat_id" style="width:150px"');?></td>
                <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" /></td>
              </tr>
              <tr>
                <td ><select class="form-control"  name="exp_years_from"  >
                    <option value="" >Exp. From</option>
                    <?php foreach($years_list as $key => $val){?>
                    <option <?php if($exp_years_from !='' && $exp_years_from==$key){?> selected="selected" <?php } ?> 
                            value="<?php echo $key;?>"><?php echo $val;?></option>
                    <?php }?>
                  </select></td>
                <td><select class="form-control"  name="exp_years_to"  >
                    <option value="" >Exp. To</option>
                    <?php foreach($exp_years_to_list as $key => $val){?>
                    <option <?php if($exp_years_to !='' && $exp_years_to==$key){?> selected="selected" <?php } ?> 
                            value="<?php echo $key;?>"><?php echo $val;?></option>
                    <?php }?>
                  </select></td>
                <td><select class="form-control"  name="salary_from"  >
                    <option value="" >Salary From</option>
                    <?php foreach($salary_from_list as $key => $val){?>
                    <option <?php if($salary_from !='' && $salary_from==$key){?> selected="selected" <?php } ?> 
                            value="<?php echo $key;?>"><?php echo $val;?></option>
                    <?php }?>
                  </select></td>
                <td><select class="form-control"  name="salary_to"  >
                    <option value="" >Salary To</option>
                    <?php foreach($salary_to_list as $key => $val){?>
                    <option <?php if($salary_to !='' && $salary_to==$key){?> selected="selected" <?php } ?> 
                            value="<?php echo $key;?>"><?php echo $val;?></option>
                    <?php }?>
                  </select></td>
                <td><?php echo form_dropdown('visa_type',  $visa_type_list,   $visa_type,'class="form-control " id="visa_type" style="width:150px"');?></td>
                <td><?php echo form_dropdown('func_id',     $func_area_list, $func_id,'class="form-control " id="func_id" style="width:150px"');?></td>
                <td>&nbsp;</td>
              </tr>
              
              <tr>
                <td ><?php echo form_dropdown('nationality',  $nationality_list,   $nationality,'class="form-control " id="nationality" style="width:150px"');?></td>
                <td><?php echo form_dropdown('country_id',  $country_list,   $country_id,'class="form-control " id="country_id" style="width:150px"');?></td>
                <td><?php echo form_dropdown('state_id',  $state_list,   $state_id,'class="form-control " id="state_id" style="width:150px"');?></td>
                <td><?php echo form_dropdown('city_id',  $city_list,   $city_id,'class="form-control " id="city_id" style="width:150px"');?></td>
                <td><?php echo form_dropdown('marital_status',  $marital_status_list,   $marital_status,'class="form-control " id="marital_status" style="width:150px"');?></td>
                <td><?php echo form_dropdown('desig_id',    $desig_list, $desig_id,'class="form-control " id="desig_id" style="width:150px"');?></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td ><?php echo form_dropdown('gender',  $gender_list,   $gender,'class="form-control " id="gender" style="width:150px"');?></td>
                <td><input class="form-control" type="text" name="age_from" id="age_from" value="<?php echo $age_from;?>" 
                    placeholder="Age From" style="width: 150px;"></td>
                <td><input class="form-control" type="text" name="age_to" id="age_to" value="<?php echo $age_to;?>" 
                    placeholder="Age To" style="width: 150px;"></td>
                <td><?php echo form_dropdown('lang_id',  $language_list,   $lang_id,'class="form-control " id="lang_id" style="width:150px"');?></td>
                <td><input class="form-control" type="text" name="cur_employer" id="cur_employer" value="<?php echo $cur_employer;?>" 
                    placeholder="Search Employer" style="width: 150px;">                  &nbsp;</td>
                <td><?php echo form_dropdown('skil_id',    $skill_list, $skil_id,'class="form-control " id="skill_id" style="width:150px"');?></td>
                <td>&nbsp;</td>
              </tr>
              
              
              <!--</form>-->
            </tbody>
          </table>
        </form>
        <form name="form1" method="post" id="form1" action="#" >
          <div class="sep-bar">
            <div class="page"> <?php echo $pagination; ?> </div>
            <div class="page">
              <table border="0">
                <tr> 
                  <!-- <td> 
 <?php  echo form_dropdown('admin_id',  $admin_users_lists, $formdata['admin_id'],'class="form-control" id="admin_id"');?> 
 </td>
 <td> 
<input type="button" id="assignAdmin" value="Assign" class="btn btn-default btn-circle" />&nbsp;&nbsp;
 </td>	-->
                  <td><select name="cur_job_statuss" id="cur_job_statuss">
                      <option value="1">No Job</option>
                      <option value="2">Working, But Need a Change</option>
                      <option value="3">Not Interested</option>
                      <option value="4">Seeking Good</option>
                      <option value="5">Need a change</option>
                      <option value="6">Call after 1 Year</option>
                      <option value="7">Call after this month</option>
                      <option value="8">job seeking / active</option>
                    </select></td>
                  <td>&nbsp;&nbsp;
                    <input type="button" id="btn_change_status" value="Change Status" class="btn btn-default btn-circle" /></td>
                </tr>
              </table>
            </div>
            <div class="views_section">
              <div class="found"><span>Found total&nbsp; | <?php echo $total_rows;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <table class="tool-table new" width="100%">
            <thead>
              <tr role="row" class="heading">
                <th width="8%"><div class="checker"><span>
                    <input type="checkbox" class="group-checkable" id="selectall">
                    </span></div></th>
                <th width="13%">Photo</th>
                
                <th width="39%"><a href="<?php echo $this->config->site_url()?>/candidates_all?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&sort_param=a.first_name&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>&cur_employer=<?php echo $cur_employer;?>&cur_job_status=<?php echo $cur_job_status;?>&lead_source=<?php echo $lead_source;?>&job_folder_id=<?php echo $job_folder_id;?>&job_cat_id=<?php echo $job_cat_id;?>&func_id=<?php echo $func_id;?>&desig_id=<?php echo $desig_id;?>&level_id=<?php echo $level_id;?>&course_id=<?php echo $course_id;?>&spcl_id=<?php echo $spcl_id;?>&exp_years_from=<?php echo $exp_years_from;?>&exp_years_to=<?php echo $exp_years_to;?>&salary_from=<?php echo $salary_from;?>&salary_to=<?php echo $salary_to;?>&marital_status=<?php echo $marital_status;?>&visa_type=<?php echo $visa_type;?>&gender=<?php echo $gender;?>&driving_license_country=<?php echo $driving_license_country;?>&nationality=<?php echo $nationality;?>&country_id=<?php echo $country_id;?>&state_id=<?php echo $state_id;?>&city_id=<?php echo $city_id;?>&age_from=<?php echo $age_from;?>&age_to=<?php echo $age_to;?>&lang_id=<?php echo $lang_id;?>">Candidate Name</a></th>
                
                <th width="13%"><a href="<?php echo $this->config->site_url()?>/candidates_all?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&sort_param=a.username&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>&cur_employer=<?php echo $cur_employer;?>&cur_job_status=<?php echo $cur_job_status;?>&lead_source=<?php echo $lead_source;?>&job_folder_id=<?php echo $job_folder_id;?>&job_cat_id=<?php echo $job_cat_id;?>&func_id=<?php echo $func_id;?>&desig_id=<?php echo $desig_id;?>&level_id=<?php echo $level_id;?>&course_id=<?php echo $course_id;?>&spcl_id=<?php echo $spcl_id;?>&exp_years_from=<?php echo $exp_years_from;?>&exp_years_to=<?php echo $exp_years_to;?>&salary_from=<?php echo $salary_from;?>&salary_to=<?php echo $salary_to;?>&marital_status=<?php echo $marital_status;?>&visa_type=<?php echo $visa_type;?>&gender=<?php echo $gender;?>&driving_license_country=<?php echo $driving_license_country;?>&nationality=<?php echo $nationality;?>&country_id=<?php echo $country_id;?>&state_id=<?php echo $state_id;?>&city_id=<?php echo $city_id;?>&age_from=<?php echo $age_from;?>&age_to=<?php echo $age_to;?>&lang_id=<?php echo $lang_id;?>">Email</a></th>
                
                <th width="9%"><a href="<?php echo $this->config->site_url()?>/candidates_all?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&sort_param=a.mobile&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>&cur_employer=<?php echo $cur_employer;?>&cur_job_status=<?php echo $cur_job_status;?>&lead_source=<?php echo $lead_source;?>&job_folder_id=<?php echo $job_folder_id;?>&job_cat_id=<?php echo $job_cat_id;?>&func_id=<?php echo $func_id;?>&desig_id=<?php echo $desig_id;?>&level_id=<?php echo $level_id;?>&course_id=<?php echo $course_id;?>&spcl_id=<?php echo $spcl_id;?>&exp_years_from=<?php echo $exp_years_from;?>&exp_years_to=<?php echo $exp_years_to;?>&salary_from=<?php echo $salary_from;?>&salary_to=<?php echo $salary_to;?>&marital_status=<?php echo $marital_status;?>&visa_type=<?php echo $visa_type;?>&gender=<?php echo $gender;?>&driving_license_country=<?php echo $driving_license_country;?>&nationality=<?php echo $nationality;?>&country_id=<?php echo $country_id;?>&state_id=<?php echo $state_id;?>&city_id=<?php echo $city_id;?>&age_from=<?php echo $age_from;?>&age_to=<?php echo $age_to;?>&lang_id=<?php echo $lang_id;?>">Mobile</a></th>
                
                <th width="4%"><a href="<?php echo $this->config->site_url()?>/candidates_all?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&sort_param=a.reg_date&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>&cur_employer=<?php echo $cur_employer;?>&cur_job_status=<?php echo $cur_job_status;?>&lead_source=<?php echo $lead_source;?>&job_folder_id=<?php echo $job_folder_id;?>&job_cat_id=<?php echo $job_cat_id;?>&func_id=<?php echo $func_id;?>&desig_id=<?php echo $desig_id;?>&level_id=<?php echo $level_id;?>&course_id=<?php echo $course_id;?>&spcl_id=<?php echo $spcl_id;?>&exp_years_from=<?php echo $exp_years_from;?>&exp_years_to=<?php echo $exp_years_to;?>&salary_from=<?php echo $salary_from;?>&salary_to=<?php echo $salary_to;?>&marital_status=<?php echo $marital_status;?>&visa_type=<?php echo $visa_type;?>&gender=<?php echo $gender;?>&driving_license_country=<?php echo $driving_license_country;?>&nationality=<?php echo $nationality;?>&country_id=<?php echo $country_id;?>&state_id=<?php echo $state_id;?>&city_id=<?php echo $city_id;?>&age_from=<?php echo $age_from;?>&age_to=<?php echo $age_to;?>&lang_id=<?php echo $lang_id;?>">Created</a></th>
                
                <th width="5%"><a href="<?php echo $this->config->site_url()?>/candidates_all?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&sort_param=a.status_updated_on&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>&cur_employer=<?php echo $cur_employer;?>&cur_job_status=<?php echo $cur_job_status;?>&lead_source=<?php echo $lead_source;?>&job_folder_id=<?php echo $job_folder_id;?>&job_cat_id=<?php echo $job_cat_id;?>&func_id=<?php echo $func_id;?>&desig_id=<?php echo $desig_id;?>&level_id=<?php echo $level_id;?>&course_id=<?php echo $course_id;?>&spcl_id=<?php echo $spcl_id;?>&exp_years_from=<?php echo $exp_years_from;?>&exp_years_to=<?php echo $exp_years_to;?>&salary_from=<?php echo $salary_from;?>&salary_to=<?php echo $salary_to;?>&marital_status=<?php echo $marital_status;?>&visa_type=<?php echo $visa_type;?>&gender=<?php echo $gender;?>&driving_license_country=<?php echo $driving_license_country;?>&nationality=<?php echo $nationality;?>&country_id=<?php echo $country_id;?>&state_id=<?php echo $state_id;?>&city_id=<?php echo $city_id;?>&age_from=<?php echo $age_from;?>&age_to=<?php echo $age_to;?>&lang_id=<?php echo $lang_id;?>">Updated</a></th>
                
                <th width="9%" class="head0">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php if($records!=NULL)
    {
    $i=0;
    foreach($records as $result){ 
    $i+=1;
    ?>
              <tr class="odd gradeX">
                <td align="center"><input type="checkbox" name="checkbox[]" class="checkboxes" value="<?php echo $result['candidate_id']?>" ></td>
                <td><?php if($result['photo']!=''){?>
                  <img height="31" width="31" src="<?php echo base_url().'uploads/photos/'.$result['photo'];?>">
                  <?php }else{ ?>
                  <img height="31" width="31" src="<?php echo base_url().'uploads/photos/no_photo.png';?>">
                  <?php } ?>
                  
       
                  
                  </td>
                <td><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $result['candidate_id']?>" class="views" title="View" target="_blank"><?php echo $result['first_name']?>&nbsp;<?php if($result['last_name']!='' & $result['last_name']!='0')echo $result['last_name']?></a>
                <br>Industry: <?php if($result['industry_name']!='')echo $result['industry_name'];else echo '<font color="#E40015">Not Updated</font>';?>
                
                 <br>Functional Area: <?php if($result['func_area']!='')echo $result['func_area'];else echo '<font color="#E40015">Not Updated</font>';?>
                 
                  <br>Designation: <?php if($result['designation']!='')echo $result['designation'];else echo '<font color="#E40015">Not Updated</font>';?>
                  
                   <br>Location: <?php if($result['location']!='')echo $result['location'];else echo '<font color="#E40015">Not Updated</font>';?>
                
                           <br>
                  Created: <?php echo $result['reg_date'];?>
                  <br>
                  Updated: <?php if($result['status_updated_on']!='0000-00-00')echo $result['status_updated_on'];else echo '<font color="#E40015">Not Updated</font>'?>
                  <br>
 <?php if($result['total_calls']>0){?>
        
        <a href="javascript:;" title="<?php echo $result['last_call_date'];?> | <?php echo $result['last_call_note'];?> | 
		<?php if($result['cur_job_status']==1)echo 'No Job';if($result['cur_job_status']==2)echo 'Working, But Need a Change';if($result['cur_job_status']==3)echo 'Not Interested';if($result['cur_job_status']==4)echo 'Seeking Good Opportunity';if($result['cur_job_status']==5)echo 'Need a change ';if($result['cur_job_status']==6)echo 'Call after 1 Year';if($result['cur_job_status']==7)echo 'Call after this month ';?>" onclick="open_notes_list(<?php echo $result['candidate_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/candidates_all/add_calls/?job_app_id=0&candidate_id=<?php echo $result['candidate_id'];?>&job_id=0"  id="add_calls" class="btn btn-info btn-xs"> Notes [<?php echo $result['total_calls'];?>] </a>
        
<?php }else{ ?>
        
<a href="javascript:;" title="No Calls Made" onclick="open_notes_list(<?php echo $result['candidate_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs/add_calls/?job_app_id=0&candidate_id=<?php echo $result['candidate_id'];?>&job_id=0"  id="add_calls" class="btn btn-danger btn-xs"> Add Notes [?] </a>
        
<?php } ?>
        
<a href="javascript:;" title="Update Consultant's Feedback" onclick="add_consultant_feedback(<?php echo $result['candidate_id'];?>,0);"  data-url="<?php echo base_url(); ?>index.php/candidates_all/add_consultant_feedback/?candidate_id=<?php echo $result['candidate_id'];?>"  id="add_consultant_feedback" class="btn btn-<?php if($result['consultant_feedback']!='')echo 'info';else echo 'danger';?> btn-xs"> Consultant's Feedback</a>
                  
                </td>
                <td><a href="mailto:<?php echo $result['username'];?>"><?php echo $result['username'];?></a></td>
                <td><?php echo $result['mobile_prefix'];?> ----------- <?php echo $result['mobile'];?></td>
                <td><?php echo $result['reg_date'];?></td>
                <td><?php if($result['status_updated_on']!='0000-00-00')echo $result['status_updated_on'];else echo '<font color="#E40015">Not Updated</font>'?></td>
                <td><a href="<?php echo base_url();?>index.php/candidates_all/summary/<?php echo $result['candidate_id']?>" class="views" title="View" target="_blank">Edit/Manage</a> &nbsp;|&nbsp; <a href="javascript:;" title="See the list of jobs" onclick="connect_with_jobs(<?php echo $result['candidate_id'];?>);"  id="manage_shortlists" class="btn btn-info btn-xs">Allocate Job</a> &nbsp;|&nbsp; <a onClick="return delete_candidate('<?php echo md5($result['candidate_id']);?>');" href="javascript:;" dataurl="<?php echo base_url();?>index.php/candidates_all/candidate_delete/<?php echo md5($result['candidate_id']);?>" class="views" title="Delete">Delete</a> 
                  
                  <!-- 
            &nbsp;|&nbsp;            
            <a href="<?php echo base_url();?>index.php/candidates_all/edit/<?php echo $result['candidate_id']?>" class="views" title="Edit">Edit</a> 
            
            |&nbsp;        
           <a href='javascript:;'  onclick="resetpwd(<?php echo $result['candidate_id']?>);" >Pwd</a> --></td>
              </tr>
              <?php
    }}else{?>
              <tr>
                <td colspan="10" align="center"> No Records Founds!! </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </form>
        <div class="modal fade" id="update_shift_vacancy" role="dialog" aria-labelledby="enquiry-modal-label">
          <div class="modal-dialog" role="document" style="width:700px;">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <br>
                <h3>All Jobs List</h3>
                <div id="shift_data_holder"></div>
                
                <!-------------------------modal1 end------------------------------->
                <div style="clear:both;"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="sep-bar">
          <div class="page"> <?php echo $pagination; ?> </div>
          <div class="views_section">
            <div class="view-drop"> <span>View</span>
              <select class="form-control drop" id="sel_limit2">
                <option>Select</option>
                <option>5</option>
                <option>10</option>
              </select>
              <span>Records</span> </div>
            <div class="found"><span>Found total <?php echo $total_rows;?> records</span></div>
          </div>
        </div>
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
</section>
</div>

<!-- notes model   --> 

<div class="modal fade" id="calls_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        	
      <div class="modal-body">
        <div class="col-md-15">
        
			<div class="notes">
            <ul>
            	<li id="tab_2btn">Calls</li>            
            </ul>
            <!--Followup-->
        
            <div class="table-tech specs note">
            <div class="new_notes_div" id="new_notes_div">
           
            
            
            
        </div>
        
             
        <!--Followup-->
          
      </div>
    </div>
  </div>
</div>
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<div class="modal fade" id="consultant_feedback"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:800px;height:600px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br><h3>Consultants Feedback</h3>
         
         <div class="alert alert-info"><strong>Info!</strong>&nbsp;Update consultant's feedback from here. This will be showed to the client when submit a CV.</div>
         
        <div id="show_consultant_feedback" style="width:750px;height:400px;">Loading...</div>
      
<!-------------------------modal1 end------------------------------->
<div style="clear:both;"></div>
</div>
</div>
</div>
</div>


<!-- notes model end here  --> 

<script>
    
    function connect_with_jobs(candidate_id)
{
	
	//$('#candidate_id').val(client_shift_id);
	$('#shift_data_holder').html('Loading..................');	
	 $.ajax({
			type: 'POST',
			url:"<?php echo $this->config->site_url()?>/candidates_all/connect_with_jobs",
			data: $('#job_assignment_form').serialize(),
			method: "POST",
  			data: { candidate_id : candidate_id,},
		    dataType: "html",
			success: function(data) 
			{
				 $('#shift_data_holder').html(data);
			}
		});
    $('#update_shift_vacancy').modal();		
}
    
 
    $(document).on('click', '#save_job_app_button', function(){
        
		var $this = $(this);
		var $url = $this.data('url');     	
		var $shift_check_valid=shift_box_validate();
		//alert($shift_check_valid);
		if($shift_check_valid==false)return false;
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#job_assignment_form').serialize(),
			dataType: "json",
			success: function(data) {
				
				 if(data.status == 'success'){					
					//$('#assignment_modal').modal('hide');	
					alert('Job application list updated');				
					//location.reload();
					//$("#assignment_modal").trigger( "reset" );
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});
    
    
    function shift_box_validate()
{
	var ret_val=true;
	var $select_boxes = $('select[name="shift_name[]"]');
	
    if ($('input[name^=avail_id]:checked').length >=1) 
	{		
		$("input[name^='avail_id']").each(function(i) {
			
		   if (this.checked) 
		   {
			   //alert($select_boxes.eq(i).val());
			   if($select_boxes.eq(i).val()=='0')
			   {				 
				  ret_val=false;
			   }
		   }
		});
    }
	
	if(ret_val==false)
	{
		alert('Plase make sure that you select the Shisft Name for all days you checked.');
	}
	return ret_val;
}
    
    
$('#simple').hide();
$('#multiple_cert').addClass('form-control hori');
$('#multiple_skill').addClass('form-control hori');
$(".js-example-basic-multiple-cert").select2();

function myFunction()
	{
	
	  var parnt =$('#parent').val();
	 
	 if(parnt!='')
	 {
		  $.ajax({
		  type: "get",
		  async: true,
		  url: "<?php echo site_url('manage_data/child_skill'); ?>",
		  data: {'id':parnt},
		  dataType: "json",
		  success: function(res) { 
		   
		   create_checkbox(res);
		 
		 console.log(res['skillset']);
		
								} 
				});
	 }
	 else{
		 	$('#multiple_skill').val('');
			$('#multiple_skill').html('');
	 }
   }

function create_checkbox(res)
{ 
	var skillset=res['skillset'];
	var count=skillset['length'];
	

	if(count>0)
	{
	$('#skill-tr').show();
	$('#multiple_skill').val('');
	$('#multiple_skill').html('');
	$('#multiple_skill').append('<option value="">Select Skills</option>');
	for(var k=0;k<count;k++)
	{   

		var option	=	'<option value="'+skillset[k]['skill_id']+'">'+skillset[k]['skill_name']+'</option>';
		
		$('#multiple_skill').append(option);

	}
	}
	else{
		$('#skill-tr').hide();
		$('#multiple_skill').val('');
		$('#multiple_skill').html('');
	}
	
}
	function search_submit()
	{
		var multiple_skill	=	$('#multiple_skill').val();
		$('#skills').val(multiple_skill);
		
	}
	
$(document).ready(function()
{
	$('.datepicker').datepicker({
		dateFormat: "yy-mm-dd"
	});

	$('#selectall').click(function(event)
	{  
		if(this.checked) 
		{ 
		$('.checkboxes').each(function() { 
		this.checked = true; 
		});
		}else{
		$('.checkboxes').each(function() { 
		this.checked = false;  
		});        
		}
	});
	
	
	$("#sel_limit1").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_all?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_all?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#assignAdmin").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a candidate to assign.");
		return false;
		}
		if(count_checked >0) {
			if($('#admin_id').val() == 0){
				alert('Please Select an Admin User');
			}
			else{
				var checkboxes = document.getElementsByName('checkbox[]');
				var selectedArr = [];
				for (var i=0; i<checkboxes.length; i++) {
					if (checkboxes[i].checked) {
						selectedArr.push(checkboxes[i].value);
					}
				}
				$.ajax({
					type:"POST",
					url: "<?php echo $this->config->site_url();?>/candidates_all/assignAdmin",
					data:{ 
							'selectedArr' : selectedArr,
							'admin_id' : $('#admin_id').val(),
					},
					success: function(msg) {
						if(msg>0){
						alert('successfully added');
						window.location='<?php echo $this->config->site_url();?>/candidates_all';
						}
						else{
						alert('Already assigned');
						}
					}
				});
			}
		}
	});


	$("#btn_change_status").click(function()
	 {  // triggred submit
        

		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		
		if(count_checked == 0) 
		{
			alert("Please select a candidate to assign.");
			return false;
		}
		
		/*
		if (!$("input[name='cur_job_status']:checked").val()) {
			   alert('Please select status!');
				return false;
		}
		*/
		
		var checkboxes = document.getElementsByName('checkbox[]');
		
		var selectedArr = [];
		
		for (var i=0; i<checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				selectedArr.push(checkboxes[i].value);
			}
		}
        
     
		$.ajax({
      
			type:"POST",
			url: "<?php echo $this->config->site_url();?>/candidates_all/change_status",
			data:{ 
					'selectedArr' : selectedArr,
					'cur_job_status' : $("#cur_job_statuss").val(),
               
			},
			success: function(msg) {
				if(msg>0)
				{
					alert('successfully changed');
					window.location='<?php echo $this->config->site_url();?>/candidates_all';
				}
				else{
					alert('Already assigned');
				}
			},
			error:function(){
					alert('Problem with server. Pelase try again');
			}
		});
	});
	
});
</script> 
<script>
function csv_validate()
{	
	if($('#csvfile').val()=='')
	{
		alert("Please Select file");
		$('#csvfile').focus();
		return false;
	}
   
	return true;
}
	$('#level_id').change(function() 
	{
	
		jQuery('#course_id_edu').html('');
		jQuery('#course_id_edu').append('<option value="">Select Course</option');
			
		if($('#level_id').val()=='')return;
			$.ajax({
			  type: 'POST',
			  url: '<?php echo $this->config->site_url();?>/candidates_all/getcourses/',
			  data: { level_study: $('#level_id').val(),int_val:1},
			  dataType: 'json',
			  
			  beforeSend:function(){
					jQuery('#course_id_edu').html('');
					jQuery('#course_id_edu').append('<option value="">Loading...</option');
			  },
			  
			  success:function(data){
			  
				  if(data.success==true)
				  {
					  jQuery('#course_id_edu').html('');
					  jQuery('#course_id_edu').append(data.course_list);
					 /* $.each(data.course_list, function (index, value) 
					  {
						  if(index=='')
							 jQuery('#course_id_edu').append('<option value="'+ index +'" selected="selected">' + value + '</option');
						 else
							 jQuery('#course_id_edu').append('<option value="'+ index +'">' + value + '</option');
					 });*/
					  //jQuery('#course_id_edu').append('<option value="">Select Course</option');
				  }else
				  {
					alert(data.success);
				  }
				},
			  
			  error:function(){
					alert('Problem with server. Pelase try again');
					jQuery('#course_id_edu').html('');
					jQuery('#course_id_edu').append('<option value="">Select Course</option');
			  }
			});	
	});
	
		
function resetpwd($id)
{
	var candidate_id =$id;
		
	$.ajax({
	
			type: 'POST',		
			data: {candidate_id:candidate_id},
			dataType: "json",		
			url: '<?php echo $this->config->site_url();?>/candidates_all/resetpassword/',
			success: function(data){
			 if(data.data =='1')
			 {
				$('#reset_msg').removeClass('hide');
				$('html, body').animate({ scrollTop: $('#reset_msg').offset().top }, 'slow');
			 }
			 else
			 {
				$('#reset_msg_error').removeClass('hide');
				$('html, body').animate({ scrollTop: $('#reset_msg_error').offset().top }, 'slow'); }
	   }
			
	 }); 
}


function open_notes_list(candidate_id)
{
	
	$('#new_notes_div').html('');	
	 $.ajax({
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_all/open_notes_list/",
			method: "POST",
  			data: { candidate_id : candidate_id},
		    dataType: "html",
			success: function(data) 
			{
				 $('#new_notes_div').html(data);
			}
			
		});
    $('#calls_modal').modal();
}


$(document).on('click', '#save_calls', function(){ 

		if($('#call_notes').val()=='')
		{
			//alert('Please enter notes');
			//$('#call_notes').focus();
			//return false;
		}

		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#calls_form').serialize(),
			dataType: "json",
			success: function(data) {
				alert('Added successfully');
				 if(data.status == 'success'){		
				 	$("#calls_form").trigger( "reset" );			
					$('#calls_modal').modal('hide');					
					location.reload();					
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});

function add_consultant_feedback(candidate_id,job_id){
	
	$('#show_consultant_feedback').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_all/open_consultant_feedback/"+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id,job_id : job_id },
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_consultant_feedback').html(data);
			}
			
		});
    $('#consultant_feedback').modal();
}

function delete_candidate(candidate_id){
	
	if(!confirm('Are you sure want to delete?'))return false;
	alert(candidate_id);
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_all/candidate_delete_ajax/",
			method: "POST",
  			data: { candidate_id : candidate_id,},
		    dataType: "json",
			success: function(data) 
			{
				 if(data.status == 'success'){								
					alert('Sucess. Deleted..');
					location.reload();
				 }
				 else
				 {
					 alert('Some error occured at server');
				 }
			}			
		});
}

$(document).on('click', '#save_consultant_feedback', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#add_consultant_feedback_frm').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){								
					alert('Sucess. Feedback Updated');	
					$('#consultant_feedback').modal('hide');
					location.reload();
				 }
				 else
				 {
					 alert('Please Fill the data');
				 }
			}
		});

	});
	
	
	
</script> 
<script type="text/javascript">
	$('#country_id').change(function() {
		
	jQuery('#state_id').html('');
	jQuery('#state_id').append('<option value="">Select State</option');

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');

			
	if($('#country_id').val()=='')return;

		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getstate/',
		  data: { country_id: $('#country_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#state_id').html('');
				  $.each(data.state_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#state_id').append('<option value="'+ $.trim(index) +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#state_id').append('<option value="'+ $.trim(index) +'">'+ value +'</option');
				 });
						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#state_id').html('');
				jQuery('#state_id').append('<option value="">Select State</option');
		  }
		});	
});
	$('#state_id').change(function() {

	jQuery('#city_id').html('');
	jQuery('#city_id').append('<option value="">Select City</option');
        
   
		
	if($('#state_id').val()=='')return;
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/getcity/',
		  data: { state_id: $('#state_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Loading...</option');

		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#city_id').html('');
				  $.each(data.city_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#city_id').append('<option value="'+ $.trim(index) +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#city_id').append('<option value="'+ $.trim(index) +'">' + value + '</option');
				 });
                  
                  
                  jQuery('#city_idd').html('');
				  $.each(data.city_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#city_idd').append('<option value="'+ $.trim(index) +'" selected="selected">' + value + '</option');
					 else
						 jQuery('#city_idd').append('<option value="'+ $.trim(index) +'">' + value + '</option');
				 });
			  }else
			  {
			  	alert(data.success);
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#city_id').html('');
				jQuery('#city_id').append('<option value="">Select City</option');
		  }
		});	
});
</script>

<script type="text/javascript">
	$('#job_cat_id').change(function() {
		
	jQuery('#func_id').html('');
	jQuery('#func_id').append('<option value="">Select Functional Area</option');
			
	//if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/get_functional_by_industry/',
		  data: { job_cat_id: $('#job_cat_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#func_id').html('');
				  $.each(data.func_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#func_id').append('<option value="'+ $.trim(index) +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#func_id').append('<option value="'+ $.trim(index) +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#func_id').html('');
				jQuery('#func_id').append('<option value="">Select Functional Area</option');
		  }
		});	
});


$('#func_id').change(function() {
		
	jQuery('#desig_id').html('');
	jQuery('#desig_id').append('<option value="">Select Designation</option');
			
	//if($('#job_cat_id').val()=='')return;
	
		$.ajax({
		  type: 'POST',
		  url: '<?php echo $this->config->site_url();?>/candidates_all/get_designation_by_function/',
		  data: { func_id: $('#func_id').val()},
		  dataType: 'json',
		  
		  beforeSend:function(){
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Loading...</option');
		  },
		  
		  success:function(data){
			  if(data.success==true)
			  {
				  jQuery('#desig_id').html('');
				  $.each(data.desig_list, function (index, value) 
				  {
					  if(index=='')
						 jQuery('#desig_id').append('<option value="'+ $.trim(index) +'" selected="selected">'+ value +'</option');
					 else
						 jQuery('#desig_id').append('<option value="'+ $.trim(index) +'">'+ value +'</option');
				 });						
			  }
		 	},
		  
		  error:function(){
				alert('Problem with server. Pelase try again');
				jQuery('#desig_id').html('');
				jQuery('#desig_id').append('<option value="">Select Designation</option');
		  }
		});	
});
</script>