<?php 
	if($viewmessage!='' && $viewmessage>0){
		foreach($viewmessage as $list){
			$attachment=(isset($list->attachment) && !empty($list->attachment)) ? explode(',',$list->attachment) : '';
?>
<div class="inbox-header inbox-view-header">
	<h1 class="pull-left"><?php echo (isset($list->subject) && !empty($list->subject)) ? $list->subject : '';?> <a href="#">
	<?php echo ($this->session->userdata('navtitle') && $this->session->userdata('navtitle')!='') ? $this->session->userdata('navtitle') : 'Inbox';?> </a>
	</h1>
	<div class="pull-right">
		<i class="fa fa-print"></i>
	</div>
</div>
<div class="inbox-view-info">
	<div class="row">
		<div class="col-md-7">
		<!--	<img src="<?php echo  $this->config->item('assets_url'); ?>admin/layout/img/avatar1_small.jpg">	 find a way to show images of sender -->
			<?php if(isset($list->email_status) && !empty($list->email_status) && ($list->email_status=='inbox')){?>
				<span class="bold"><?php echo (isset($list->sender_name) && !empty($list->sender_name)) ? $list->sender_name : '';?> </span>
				<span>
				&#60;<?php echo (isset($list->sender_email) && !empty($list->sender_email)) ? $list->sender_email : '';?>&#62; </span>
				to <span class="bold">
				<?php echo (isset($list->to_emailid) && !empty($list->to_emailid)) ? getToName1($list->to_emailid,false) : '';?></span>
			<?php }else{?>
				<span class="bold"><?php echo (isset($list->sender_name) && !empty($list->sender_name)) ? getToName($list->sender_name,false) : '';?> </span>
				<span>
				&#60;<?php echo (isset($list->sender_email) && !empty($list->sender_email)) ? $list->sender_email : '';?>&#62; </span>
				to <span class="bold">
				me </span>
			<?php }?>
			on <?php echo (isset($list->message_date) && !empty($list->message_date)) ? date('H:i A d F Y',$list->message_date) : '';?>
		</div>
		<div class="col-md-5 inbox-info-btn">
			<div class="btn-group">
				<button class="btn blue reply-btn" messageid="<?php echo $list->id;?>">
				<i class="fa fa-reply"></i> Reply </button>
				<button class="btn blue dropdown-toggle" data-toggle="dropdown">
				<i class="fa fa-angle-down"></i>
				</button>
            
				<ul class="dropdown-menu pull-right">
					<li>
						<a href="javascript:;" id="reply_to" messageid="<?php echo $list->id;?>">
						<i class="fa fa-reply reply-btn"></i> Reply </a>
					</li>
					<li>
						<a href="javascript:;" id="forward_to" messageid="<?php echo $list->id;?>">
						<i class="fa fa-arrow-right reply-btn"></i> Forward </a>
					</li>	
					<li>
						<a href="<?php echo site_url('my_inbox/makeMsgUnread/'.$list->id)?>">
						<i class="fa fa-pencil"></i> Mark as Unread </a>
					</li>
					<li class="divider">
					</li>					
					<li>
						<a href="<?php echo site_url('my_inbox/deletemessage/'.$list->id.'/'.$list->email_status)?>">
						<i class="fa fa-trash-o"></i> Delete </a>
					</li>
					<li>
					</div>
				</div>
			</div>
		</div>
		<div class="inbox-view">
			<?php echo (isset($list->message_text) && !empty($list->message_text)) ? html_entity_decode($list->message_text) : '';?>
		</div>
		<hr>
		<div class="inbox-attached">			
			<?php 
				if(isset($attachment) && !empty($attachment) && count($attachment)>0){?>
				<!--div class="margin-bottom-15">
					<span>
					<?php echo count($attachment)?> attachments — </span>
					<a href="#">
					Download all attachments </a>
					<a href="#">
					View all images </a>
				</div-->
				<?php
					foreach($attachment as $file){
						if($file!='Thumbs.db'){
							$type=explode('.',$file);
							$filetype=array('jpg','jpeg','gif','png','doc','docx','xls','xlsx','bmp');
							if(!in_array($type[1],$filetype)){
								$filepath='';
							}else{
								$filepath=$this->config->item('assets_url')."global/plugins/jquery-file-upload/server/php/files/".$file;
							}
							$filerootpath=FCPATH.'/server/php/files/'.$file;
			?>
			<div class="margin-bottom-25">
				<img src="<?php echo $filepath;?>">
				<div>
					<strong><?php echo $file?></strong>
					<span>
					<?php echo formatbytes($filerootpath, "KB");?> </span>
					<a href="<?php echo $filepath;?>" target="_blank">
					View </a>
                    <?php if(file_exists($this->config->site_url('mailbox/download/'.$file))) { ?>
                        <a href="<?php echo $filepath;?>">
                        Download </a>
                    <?php }
					else { ?>
                    	<a href="javascript:void(0);">
						Download </a>
                    <?php } ?>
				</div>
			</div>
			<?php }}}?>			
		</div>
	<?php }}?>        