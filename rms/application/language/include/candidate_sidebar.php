
<style>
.notess
{
width:100%;
min-height:400px;
border: 1px solid #aeaeae;
margin-top: 20px;
text-align: left;
color: #606162;
font-size: 13px;
}
.notess ul
{
width:100%;
margin:0;
padding:0;
list-style:none;	
}
.notess li:first-child
{
float:left;
border-bottom: 2px solid #439ffa;	
font-family:"Novecentowide-Medium";
width:143px;
text-align:center;
color: #606162;
font-size:14px;
line-height:50px;
margin-left:2px;
cursor:pointer;
}

#multiple_skill ul{
    box-sizing: border-box;
    list-style: outside none none;
    margin: 0;
    padding: 0 5px;
    width: 100%;	
	
}

#multiple_skill li{
	width:auto!important;
	line-height:27px!important;
    background-color: #e4e4e4;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: default;
    float: left;
    margin-right: 5px;
    margin-top: 5px;
    padding: 0 px;	
	
}
.select2-search--inline,.select2-selection__choice{
	width:auto!important;
	line-height:27px!important;
	font-family:inherit!important;
	font-size:inherit!important;
	font-weight:normal!important;
	
}
.notess li.active:first-child 
{
background-color:#30d57d;
color: #FFFFFF;
}
.notess li:nth-child(1)
{
margin-left:0%;
}


li.test
{ 
display:inline; 
width: auto;
  float: left;
  padding:5px;
}       
</style>

<section class="bot-sep">
<div class="section-wrap">
<div class="row">
<div class="col-sm-12 pages">Home / Features / <span>Profile</span></div>
</div>
<div class="row">
<div class="col-md-3">
<div class="profile_box">

<?php if($detail_list['photo']=='no_photo.png' or $detail_list['photo']==''){?>
<span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/no_photo.png'?>" class="profile_img" style="widtt:158px;"></span>	

<h2><?php echo $detail_list['first_name'];?></h2>

<div style="margin-left: -136px;margin-bottom: -30px;">

<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/img_update' style="margin-top: 19px;">
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload">
<img src="<?php echo base_url('assets/images/browse.png');?>">
<input type="file" class="upload"  name="photo" id="photo" />

</div>
</form>

</div>

<div style="margin-left: 136px;margin-bottom: -40px;">

<a href="<?php echo $this->config->site_url();?>/candidates_all" class="attach-subs subs">Back</a></span></td>
</div>


<div id="imgfoto" style="margin-top: -22px; margin-left: 76px;"></div>
<?php } else{?>

<span id="imgTab2"><img src="<?php echo base_url().'uploads/photos/'.$detail_list['photo'];?>" class="profile_img" style="width:158px;"></span>
<h2><?php echo $detail_list['first_name'];?></h2>

<div style="margin-top: 20px;margin-left: 30px;"> 

<div style="margin-left: -135px;">
<form id="imageform1" class="imageform1" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/img_update' style="margin-top: 19px;">
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload" id="imgfoto1">
<img src="<?php echo base_url('assets/images/browse.png');?>" >
<input type="file" class="upload"  name="photo" id="photo" />
</div>
</form>
</div>

<div style="margin-left: 78px;margin-top: -50px;">
<form id="img1_validate" class="img1_validate" method="post" enctype="multipart/form-data" action='<?php echo $this->config->site_url();?>/candidates_all/deletefile1' >
<input type="hidden" value="<?php echo $detail_list['candidate_id'];?>" name="candidate_id" id="candidate_id">
<div class="fileUpload" id="imgfoto">
<a href="" class="attach-subs subs profile_btn" >de	lete</a>
</div>
</form>
</div>
</div>	
	
<?php }	?>
<span id="loading"></span>

<ul style="margin-top: 73px;">

<li <?php if($page_head == 'summary'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/candidates_all/summary/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Summary</a></li>

<li <?php if($page_head == 'follow_up'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/candidates_all/candidate_view/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-1.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-1_hover.png');?>"></span>Follow-up</a></li>

<li <?php if($page_head == 'profile'){?>class='active'<?php }?>><a href="<?php echo $this->config->site_url();?>/candidates_all/edit/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Edit Profile</a></li>

<li <?php if($page_head == 'profile_info'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/cvfile/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Profile Info</a></li>


<li <?php if($page_head == 'education'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/edu_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Education</a></li>

<li <?php if($page_head == 'job_history'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/job_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Job History</a></li>

<li <?php if($page_head == 'lang_skill'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/lang_history/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Lang. Skill</a></li>

<li <?php if($page_head == 'tech_skill'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/skills/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Tech. Skill</a></li>

<li <?php if($page_head == 'certification'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/certifications/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Certifications</a></li>

<?php /*?><li><a href="<?php echo base_url();?>index.php/candidates_all/candidate_programs/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Programs</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/candidate_coe/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>CoE</a></li>

<li><a href="<?php echo base_url();?>index.php/candidates_all/candidate_visa/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>VISA</a></li>


<li><a href="<?php echo base_url();?>index.php/candidates_all/questionnaire/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Questionnaire</a></li><?php */?>

<li <?php if($page_head == 'manage_file'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/candidate_file/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Manage Files</a></li>

<li <?php if($page_head == 'email_sms'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/email_sms/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Email & SMS</a></li>

<li <?php if($page_head == 'complaints'){?>class='active'<?php }?>><a href="<?php echo base_url();?>index.php/candidates_all/tickets/<?php echo $detail_list['candidate_id'];?>"><span><img src="<?php echo base_url('assets/images/profile-icon-2.png');?>"></span><span><img src="<?php echo base_url('assets/images/profile-icon-2_hover.png');?>"></span>Complaints</a></li>
</ul>


</div>



</div>