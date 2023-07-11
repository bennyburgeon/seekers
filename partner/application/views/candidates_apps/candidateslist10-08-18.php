<style>
th {
	font-weight: bold;
	font-family: Verdana, Geneva, sans-serif;
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
        <div class="right-btns"> <a href="<?php echo base_url();?>index.php/candidates_apps/add" class="attach-subs tools"><img src="<?php echo base_url('assets/images/plus.png');?>">Add New</a> || <a href="<?php echo base_url(); ?>index.php/candidates_apps" id="clear_search" class="btn btn-primary btn-xs">Clear Search Filters</a> </div>
        
        <!-- 
<div class="actions">
<a href="<?php echo site_url('candidates_apps/import_csv');?>" class="btn btn-default btn-circle">
<i class="fa fa-plus"></i>
<span class="hidden-480">
Import CSV </span>
</a>
</div>
--> 
        <br>
        <form id="searchForm" method="get" action="<?php echo $this->config->site_url()?>/candidates_apps/">
          <!-- 

                    
                    <input class="form-control" type="text" name="search_email" id="search_email" value="<?php echo $search_email;?>" 
                    placeholder="Email" style="width: 100px;">
                    
                    
                    <input class="form-control" type="text" name="search_mobile" id="search_mobile" value="<?php echo $search_mobile;?>" 
                   placeholder="Mobile" style="width: 100px;">
                   -->
          <table class="tool-table" border="1">
            <tbody>
              <tr>
                <td><?php echo form_dropdown('job_cat_id', $industry_list, $job_cat_id,' id="job_cat_id" style="width:80px"');?></td>
                <td><?php echo form_dropdown('func_id', $department_list, $desig_id,' id="func_id"  style="width:85px"');?></td>
                <td><?php echo form_dropdown('desig_id', $roles_list, $desig_id,' id="desig_id"  style="width:100px"');?></td>
                <td><?php echo form_dropdown('reg_status',  $reg_status_list, $reg_status,'  id="reg_status" style="width:120px"');?></td>
                <td><?php echo form_dropdown('expected_ctc_from',  $expected_ctc_from_array, $expected_ctc_from,' id="expected_ctc_from" style="width:105px"');?></td>
                <td><?php echo form_dropdown('notice_period_from',  $notice_period_from_array, $notice_period_from,' id="notice_period_from" style="width:110px"');?></td>
                <td><?php echo form_dropdown('total_experience_from',  $total_experience_from_array, $total_experience_from,' id="total_experience_from" style="width:100px"');?></td>
                <td><?php echo form_dropdown('level_id',  $edu_level_list, $level_id,' id="level_id" style="width:120px"');?></td>
                <td><?php echo form_dropdown('pref_city_id', $pref_city_list, $pref_city_id,' id="pref_city_id"  style="width:90px"');?></td>
              </tr>
              <tr>
                <td><?php echo form_dropdown('job_folder_id',  $job_folders, $job_folder_id,' id="job_folder_id" style="width:80px"');?></td>
                <td><?php echo form_dropdown('cur_job_status',  $job_status_list, $cur_job_status,' id="cur_job_status" style="width:85px"');?></td>
                <td><?php echo form_dropdown('city_id', $city_list, $city_id,' id="city_id"  style="width:100px"');?></td>
                <td><input class="form-control" type="text" name="search_name" id="search_name" value="<?php echo $search_name;?>" 
                    placeholder="Name" style="width: 120px;"></td>
                <td><?php echo form_dropdown('expected_ctc_to',  $expected_ctc_to_array, $expected_ctc_to,' id="expected_ctc_to" style="width:100px"');?></td>
                <td><?php echo form_dropdown('notice_period_to',  $notice_period_to_array, $notice_period_to,' id="notice_period_to" style="width:100px"');?></td>
                <td><?php echo form_dropdown('total_experience_to',  $total_experience_to_array, $total_experience_to,' id="total_experience_to" style="width:105px"');?></td>
                <td><?php echo form_dropdown('course_id',  $edu_course_list, $course_id,' id="course_id_edu" style="width:123px"');?></td>
                <td><input type="submit" id="submit" onclick="search_submit();" value="Search" class="btn btn-default btn-circle" /></td>
              </tr>
            </tbody>
          </table>
        </form>
        <form name="form1" method="post" id="form1" action="#" >
          <div class="sep-bar">
            <div class="page"> </div>
            
            <!-- 
<div class="page">
<table border="0">
<tr>
 <td> 
 <?php  echo form_dropdown('job_id',  $all_jobs_list, '','class="form-control" id="job_id" style="width:400px;"');?> 
 </td>
 <td> 
<input type="button" id="assign_to_job" value="Add To Job" class="btn btn-default btn-circle" />&nbsp;&nbsp;
 </td>
  <td> 
 <?php echo form_dropdown('cur_job_status',  $job_status_list, $cur_job_status,'class="form-control " id="cur_job_status" style="width:150px"');?>
 </td>	
  <td> &nbsp;&nbsp;
<input type="button" id="btn_change_status" value="Change Status" class="btn btn-default btn-circle" />
 </td>	
</tr>
</table>
</div>
-->
            
            <div class="views_section">
              <div class="found"><span>Found total&nbsp; | <?php echo $total_rows;?> records</span></div>
            </div>
          </div>
          <div style="clear:both;"></div>
          <table class="tool-table new">
            <thead>
              <tr role="row" class="heading">
                <th width="20"><div class="checker"><span>
                    <input type="checkbox" class="group-checkable" id="selectall">
                    </span></div></th>
                <th width="125">Photo</th>
                <th width="395"><a href="<?php echo $this->config->site_url()?>/candidates_apps?sort_by=<?php if($sort_by=='asc'){echo 'desc';}else{echo 'asc';};?>&limit=<?php echo $limit;?>&search_name=<?php echo $search_name;?>&search_email=<?php echo $search_email;?>&search_mobile=<?php echo $search_mobile;?>&rows=<?php echo $rows;?>"> Name</a></th>
                <th width="105">CTC /Lakhs</th>
                <th width="137">ECTC/Lakhs</th>
                <th width="74" class="head0">Exp./Yr</th>
                <th width="80" class="head0">Notice</th>
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
                  <?php } ?></td>
                <td><a href="<?php echo base_url();?>index.php/candidates_apps/summary/<?php echo $result['candidate_id']?>" target="_blank" class="views" title="View"> <strong><?php echo $result['first_name']?></strong></a> || <?php echo $result['username'];?> || <strong><?php echo $result['mobile'];?></strong> 
                  
                  <!-- 
             <br>Total Apps: <?php echo $result['total_job_apps'];?> || SL: <?php echo $result['total_shortlisted'];?> || Int:  <?php echo $result['total_interview'];?> || Int Rej:  <?php echo $result['total_interview_rej'];?> ||  Sel:  <?php echo $result['total_selection'];?> 
            
            
            <br>Education: <?php if($result['total_edu']>0)echo 'Updated';else echo 'Not Updated';?>
            <br>Job Profile: <?php if($result['total_job_profile']>0)echo 'Updated';else echo 'Not Updated';?>
            <br>Skills: <?php if($result['total_skills']>0)echo 'Updated';else echo 'Not Updated';?>
            --> 
            <br>
                  Job: <?php if($result['job_title']!='')echo $result['job_title'];else echo 'Not Updated';?>
                  <br>
                  Job Status: <?php if($result['cur_job_status_name']!='')echo $result['cur_job_status_name'];else echo 'Not Updated';?>
                  
                  <!-- 
            <br> Last CTC Udate: <?php echo $result['ctc_updated_on'];?>
            <br> Last Profile Udate: <?php echo $result['status_updated_on'];?>
                        <br>
			
            <br> Industry:<?php if($result['candidate_industry']!='')echo $result['candidate_industry'];else echo 'Not Updated';?> 
            
            <br> Functional Area:<?php if($result['candidate_functional']!='')echo $result['candidate_functional'];else echo 'Not Updated';?>
            <br> Role/Designation:<?php if($result['candidate_role']!='')echo $result['candidate_role'];else echo 'Not Updated';?>
            <br>
            
            <?php if($result['client_cv_file']==''){?>
             <br>

             <a href="<?php echo base_url();?>index.php/candidates_apps/summary/<?php echo $result['candidate_id']?>" target="_blank" title="Client CV not uploaded" id="open_candidate_profile" class="btn btn-danger btn-xs">Client CV not uploaded</a>
<br>
             <?php } ?>
            -->
                  
                  <?php if($result['reg_status']=='0'){?>
                  <br>
                  <strong>Dont Know</strong> || <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=1">Open For Job</a> || <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=2">Placed</a> || <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=3">Black Listed</a>
                  <?php } ?>
                  <?php if($result['reg_status']=='1'){?>
                  <br>
                  <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=0">Dont Know</a> || <strong>Open For Job</strong> || <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=2">Placed</a> || <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=3">Black Listed</a>
                  <?php } ?>
                  <?php if($result['reg_status']=='2'){?>
                  <br>
                  <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=0">Dont Know</a> || <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=1">Open For Job</a> || <strong> Placed</strong>|| <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=3">Black List</a>
                  <?php } ?>
                  <?php if($result['reg_status']=='3'){?>
                  <br>
                  <a href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=0">Dont Know</a> || <a  href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=1">Open for Job</a> || <a  href="<?php echo $this->config->site_url()?>/candidates_apps/change_profile_status/<?php echo $result['candidate_id'];?>?reg_status=2">Placed</a> || <strong>Black Listed </strong>
                  <?php } ?>
                  <br>
                  <br>
                  
                  <!-- 
           <a href="javascript:;" title="Update & View Consultant's Feedback" onclick="add_consultant_feedback(<?php echo $result['candidate_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs/add_consultant_feedback/?candidate_id=<?php echo $result['candidate_id'];?>"  id="add_consultant_feedback" class="btn btn-<?php if($result['consultant_feedback']!='')echo 'info';else echo 'danger';?> btn-xs"> Consultant's Feedback</a> ||  
           --> 
                  <a href="javascript:;" title="Update & View Note" onclick="add_candidate_notes(<?php echo $result['candidate_id'];?>);"  data-url="<?php echo base_url(); ?>index.php/jobs/get_all_notes/?candidate_id=<?php echo $result['candidate_id'];?>"  id="add_candidate_notes" class="btn btn-<?php if($result['total_notes']>0)echo 'info';else echo 'danger';?> btn-xs"> Add Notes</a> || <a href="javascript:;" title="Shortlist Candidates, see the list of jobs" onclick="connect_with_jobs(<?php echo $result['candidate_id'];?>);"  id="manage_shortlists" class="btn btn-info btn-xs">Change Interview</a> ||
                  
                  
                  <?php if($result['total_interview_rej']==0  && $result['total_selection']==0){?>
                  
                  <a href="javascript:;" onclick="select_candidate(<?php echo $result['candidate_id'];?>,<?php echo $result['job_app_id'];?>);" class="btn btn-primary btn-xs"> Select </a> || 
                  
                  <a href="javascript:;" onclick="reject_interview_fn(<?php echo $result['candidate_id'];?>,<?php echo $result['job_app_id'];?>,<?php echo $result['interview_id'];?>);" id="reject_interview" class="btn btn-danger btn-xs">Reject </a> || 
                  
                  <a href="javascript:;"  data-url="<?php echo base_url(); ?>index.php/candidates_apps/edit_interview/?job_app_id=<?php echo $result['job_app_id'];?>&candidate_id=<?php echo $result['candidate_id'];?>"  id="edit_interview" class="btn btn-primary btn-xs">Change</a>
                  <?php }else{ ?>
                  
                  <?php if($result['total_selection']>0){?>
                  <a href="javascript:;" data-url="">Selected </a>
                  <?php }elseif($result['total_interview_rej']>0){ ?>
                  <a href="javascript:;" data-url="">Rejected </a>
                  <?php } ?>
                  <?php } ?>
                  <?php if($result['client_cv_file']!=''){?>
                  || <a href="javascript:;" class="btn btn-warning btn-xs" title="View Profile" onclick="open_client_cv_doc(<?php echo $result['candidate_id'];?>);"> View Client CV</a>
                  <?php } ?></td>
                <td><?php echo number_format($result['current_ctc'],2);?></td>
                <td><?php echo number_format($result['expected_ctc'],2);?></td>
                <td><?php echo $result['total_experience'];?></td>
                <td><?php echo $result['notice_period'];?> Days</td>
              </tr>
              <?php
    }}else{?>
              <tr>
                <td colspan="11" align="center"> No Records Founds!! </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </form>
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
<div class="modal fade" id="consultant_feedback"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:800px;height:800px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <h3>Consultants Feedback</h3>
        <div class="alert alert-info"><strong>Info!</strong>&nbsp;Update consultant's feedback from here. This will be showed to the client when submit a CV.</div>
        <div id="show_consultant_feedback" style="width:750px;height:600px;">Loading...</div>
        
        <!-------------------------modal1 end------------------------------->
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="candidates_notes"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:800px;height:200px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <h3>Candidate Notes</h3>
        <div class="alert alert-info"><strong>Info!</strong>&nbsp;Update notes from here.</div>
        <div id="show_all_notes" style="width:750px;height:400px;">Loading...</div>
        
        <!-------------------------modal1 end------------------------------->
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="update_shift_vacancy" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document" style="width:1058px;">
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
<div class="modal fade" id="client_cv_modal_doc"  role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" style="width:1200px;" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <h3>Client's CV</h3>
        <div id="show_client_cv_doc" style="overflow: scroll;"></div>
        
        <!-------------------------modal1 end------------------------------->
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="select_candidate_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="profile_top">
            <form class="form-horizontal form-bordered"  method="post" id="select_candidate_form" name="select_candidate_form" action="<?php echo base_url(); ?>index.php/candidates_apps/select_candidate/"  >
              <input type="hidden" name="candidate_id" id="candidate_id_select"value="">
              <input type="hidden" name="app_id" id="app_id_select" value="">
              <table class="hori-form">
                <tbody>
                  <tr>
                    <td>Feedback</td>
                    <td><textarea name="feedback" cols="30" rows="4"></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2"><span class="click-icons">
                      <input type="button" class="attach-subs" value="Save" id="select_candidate_btn"  
                             data-url="<?php echo base_url(); ?>index.php/candidates_apps/select_candidate/" />
                      </span></td>
                  </tr>
                </tbody>
              </table>
            </form>
            
            <!--Followup--> 
            
            </span> </div>
        </div>
        
        <!------------------------ end modal4------------------------------->
        
        <div style="clear:both;"></div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="reject_interview_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15">
            <div class="notes">
              <ul>
                <li id="tab_2btn">Reject</li>
              </ul>
              <!--Followup-->
              
              <div class="table-tech specs note">
                <div class="new_notes"> 
                  <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
                  <p id="result"></p>
                  <p id="deletemessage"></p>
                  <form class="form-horizontal form-bordered"  method="post" id="reject_interview_form" name="interview_form" action="<?php echo base_url(); ?>index.php/candidates_apps/reject_interview">
                    <input type="hidden" id="reject_candidate_id" name="candidate_id" value="">
                    <input type="hidden" id="reject_job_app_id"  name="job_app_id" value="">
                    <input type="hidden" id="reject_interview_id"  name="interview_id" value="">
                    <table class="hori-form">
                      <tbody>
                        <tr>
                          <td>Reason</td>
                          <td><input type="radio" name="reject_reason_id" value="1" checked>
                            Poor Performance<br>
                            <input type="radio" name="reject_reason_id" value="2">
                            Not Impressive<br>
                            <input type="radio" name="reject_reason_id" value="3">
                            Negative Attitude<br>
                            <input type="radio" name="reject_reason_id" value="4">
                            Being Dishonest<br>
                            <input type="radio" name="reject_reason_id" value="5">
                            Uninteresting Interview Answers.<br>
                            <input type="radio" name="reject_reason_id" value="6">
                            Arriving late.<br>
                            <input type="radio" name="reject_reason_id" value="7">
                            Being Rude<br>
                            <input type="radio" name="reject_reason_id" value="8">
                            Not upto the mark <br>
                            <input type="radio" name="reject_reason_id" value="9">
                            Technical Rejection<br>
                            <input type="radio" name="reject_reason_id" value="10">
                            Salary expectations are not met </td>
                        </tr>
                        <tr>
                          <td>Date</td>
                          <td><input type="text" name="rejected_on" value="<?php echo date('Y-m-d');?>" class="smallinput datepicker" id="rejected_on"  /></td>
                        </tr>
                        <tr>
                          <td>Notes</td>
                          <td><textarea name="reject_notes" cols="40" rows="10" id="reject_notes" style="width:400px;height:100px;"></textarea></td>
                        </tr>
                        <tr>
                          <td colspan="2"><span class="click-icons">
                            <input type="button" class="attach-subs" value="Reject" id="reject_interview_button" style="width:180px;" 
                  data-url="<?php echo base_url(); ?>index.php/candidates_apps/reject_interview"/>
                            </span></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
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
<div class="modal fade" id="interview_modal" role="dialog" aria-labelledby="enquiry-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div class="modal-body">
          <div class="col-md-15">
            <div class="notes">
              <ul>
                <li id="tab_2btn">Interview</li>
              </ul>
              <!--Followup-->
              
              <div class="table-tech specs note">
                <div class="new_notes"> 
                  <!--<div class="alert alert-info"><strong>Info!</strong> You have 198 unread messages.</div>
            -->
                  <p id="result"></p>
                  <p id="deletemessage"></p>
                  <form class="form-horizontal form-bordered"  method="post" id="interview_form" name="interview_form" action="<?php echo base_url(); ?>index.php/candidates_apps/addinterview">
                    <input type="hidden" name="candidate_id" id="int_candidate_id" value="">
                    <input type="hidden" name="job_app_id"  id="int_job_app_id" value="">
                    <input type="hidden" name="job_id"  id="int_job_id" value="">
                    <table class="hori-form">
                      <tbody>
                        <tr>
                          <td>Interview Title</td>
                          <td><?php echo form_input(array('name'=>'title','id' =>'int_title', 'class' => 'smallinput'));?></td>
                        </tr>
                        <tr>
                          <td>Interview Type</td>
                          <td><?php echo form_dropdown('interview_type_id', $interview_type,'','id = "int_type_id"');?></td>
                        </tr>
                        <tr>
                          <td>Interview Status</td>
                          <td><?php echo form_dropdown('int_status_id', $int_status_id,'','id = "int_status_id"');?></td>
                        </tr>
                        <tr>
                          <td>Location</td>
                          <td><?php echo form_input(array('name'=>'location','id'=>'int_location','class'=>'smallinput'));?></td>
                        </tr>
                        <tr>
                          <td>Interview Date</td>
                          <td><input type="text" name="interview_date" class="smallinput datepicker" id="int_datepicker"  /></td>
                        </tr>
                        <tr>
                          <td>Interview Time</td>
                          <td><?php echo form_dropdown('interview_time', $interview_time, '','id="interview_time"');?></td>
                        </tr>
                        <tr>
                          <td>Description</td>
                          <td><?php echo form_input(array('name'=>'description', 'id'=>'int_description','class' => 'smallinput'));?></td>
                        </tr>
                        <tr>
                          <td colspan="2"><span class="click-icons">
                            <input type="button" class="attach-subs" value="Save" id="save_interview" style="width:180px;" 
                  data-url="<?php echo base_url(); ?>index.php/candidates_apps/addinterview" />
                            </span></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
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
<script>
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
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_apps?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#sel_limit2").change(function(){
		var limits = $(this).find(":selected").val();
				var search_name = $('#search_name').val(); 
		var search_email = $('#search_email').val(); 
		var search_mobile = $('#search_mobile').val();
		var reg_status = $('#reg_status').val();
		window.location.href = '<?php echo $this->config->site_url();?>/candidates_apps?limit='+limits+'&search_name='+search_name+'&search_email='+search_email+'&search_mobile='+search_mobile+'&reg_status='+reg_status;
	});
	
	$("#assign_to_job").click(function()
	 {  // triggred submit
		var count_checked = $("[name='checkbox[]']:checked").length; // count the checked
		if(count_checked == 0) {
		alert("Please select a candidate to assign.");
		return false;
		}
		if(count_checked >0) {
			if($('#job_id').val() == 0){
				alert('Please Select a job');
				return false;
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
					url: "<?php echo $this->config->site_url();?>/candidates_apps/assign_job",
					data:{ 
							'selectedArr' : selectedArr,
							'job_id' : $('#job_id').val(),
					},
					success: function(msg) {
						if(msg>0){
							alert('successfully added');
							window.location='<?php echo $this->config->site_url();?>/candidates_apps';
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
			alert("Please select a candidate to change status.");
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
			url: "<?php echo $this->config->site_url();?>/candidates_apps/change_status",
			data:{ 
					'selectedArr' : selectedArr,
					'cur_job_status' : $("#cur_job_status").val(),
			},
			success: function(msg) {
				if(msg>0)
				{
					alert('successfully changed');
					window.location='<?php echo $this->config->site_url();?>/candidates_apps';
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
			  url: '<?php echo $this->config->site_url();?>/candidates_apps/getcourses/',
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
			url: '<?php echo $this->config->site_url();?>/candidates_apps/resetpassword/',
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

function add_consultant_feedback(candidate_id){
	
	$('#show_consultant_feedback').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_apps/open_consultant_feedback/"+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id},
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_consultant_feedback').html(data);
			}
			
		});
    $('#consultant_feedback').modal();
}

function add_candidate_notes(candidate_id){
	
	$('#show_all_notes').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_apps/get_all_notes/"+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id},
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_all_notes').html(data);
			}
			
		});
    $('#candidates_notes').modal();
}
</script> 
<script>

function connect_with_jobs(candidate_id)
{
	
	//$('#candidate_id').val(client_shift_id);
	$('#shift_data_holder').html('Loading..................');	
	 $.ajax({
			type: 'POST',
			url:"<?php echo $this->config->site_url()?>/candidates_apps/connect_with_jobs",
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
					connect_with_jobs(data.candidate_id);			
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

function open_client_cv_doc(candidate_id)
{
	$('#show_client_cv_doc').html('');	
	 $.ajax({			
			type: 'POST',
			url:"<?php echo base_url(); ?>index.php/candidates_apps/client_cv_doc/?view="+candidate_id,
			method: "POST",
  			data: { candidate_id : candidate_id},
		    dataType: "html",
			success: function(data) 
			{
				 $('#show_client_cv_doc').html(data);
			}
		});
    $('#client_cv_modal_doc').modal();
}

function select_candidate(id1,id2)
{
	$('#candidate_id_select').val(id1);
   	$('#app_id_select').val(id2);
    $('#select_candidate_modal').modal();
}

$(document).on('click', '#select_candidate_btn', function(){ 													 
		var $this = $(this);
		var $url = $this.data('url'); 
	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#select_candidate_form').serialize(),
			dataType: "json",
			success: function(data) {
	
				 if(data.status == 'success'){					
				 alert('status changed');
				 $('#select_candidate_modal').modal('hide');  
				 location.reload();
				 }
				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});
	});
	
	
function reject_interview_fn(id1,id2,id3)
{
	$('#reject_candidate_id').val(id1);
	$('#reject_job_app_id').val(id2);
	$('#reject_interview_id').val(id3);
    $('#reject_interview_modal').modal('show');
}

$(document).on('click', '#reject_interview_button', function(){																													
  if(window.confirm("Are You Sure to reject this Candidate?")){  
	  var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   data: $('#reject_interview_form').serialize(),
	   success: function(data){		   
		   if(data.status == 'success')
		   {	
		   		$("#reject_interview_form").trigger( "reset" );
				$('#reject_interview_modal').modal('hide');
				location.reload();
			} 
		   else
		   {
			   alert('Cannot able to delete we have entry in Selected List');
		   }
	   }			
	 }); 
  }
});

$(document).on('click', '#edit_interview', function(){ 
	var $url= $(this).attr('data-url');	 
	 $.ajax({	
	   type: 'POST',	
	   url: $url,	
	   datatype: 'json',
	   success: function (data) {			
			var selectedDateTime = data.interview_date;
			var splitarray = new Array(); 
			splitarray= selectedDateTime.split(" "); 			
			$('#int_job_app_id').val(data.job_app_id);
			$('#int_candidate_id').val(data.candidate_id);
			$('#int_title').val(data.title);
			$('#interview_date').val(data.interview_date);
			$('#int_type_id').val(data.interview_type_id);
			$('#int_status_id').val(data.int_status_id);
			$('#interview_time').val(data.interview_time);			
			$('#int_location').val(data.location);
			$('#int_datepicker').val(splitarray[0]);
			$('#int_description').val(data.description);
			$('#interview_modal').modal('show');			
   		 }			
	 }); 
});
$(document).on('click', '#save_interview', function(){ 
		var $this = $(this);
		var $url = $this.data('url');     	
        $.ajax({			
			type: 'POST',
			url: $url,
			data: $('#interview_form').serialize(),
			dataType: "json",
			success: function(data) {
				 if(data.status == 'success'){				
				 	location.reload();
					$('#interview_modal').modal('hide');					
					//$('#inter').removeClass();
					//$('#candidate_interview').removeClass();
					//$('#candidate_interview').html(data.data);
					$("#interview_form").trigger( "reset" );
				 }
				 else
				 {
					 alert('please Fill the data');
				 }
			}
		});

	});

</script>