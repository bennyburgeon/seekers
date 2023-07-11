<table class="table table-striped table-advance table-hover">
<thead>
<tr>
	<th colspan="3">
		<input type="checkbox" class="mail-checkbox mail-group-checkbox">
		<div class="btn-group">
			<a class="btn btn-sm blue dropdown-toggle" href="javascript:;" data-toggle="dropdown">
			More <i class="fa fa-angle-down"></i>
			</a>
			<ul class="dropdown-menu">
				<li>
					<a href="javascript:void(0);" id="readall" onclick="readAll()">
					<i class="fa fa-pencil"></i> Mark as Read </a>
				</li>
				<li>
					<a href="javascript:void(0);" id="unreadall" onclick="unreadAll()">
					<i class="fa fa-pencil"></i> Mark as UnRead </a>
				</li>
				<li class="divider">
				</li>
				<li>
					<a href="javascript:void(0);" id="deleteall" onclick="deleteMail()">
					<i class="fa fa-trash-o"></i> Delete </a>
				</li>
			</ul>
		</div>
	</th>
	<th class="pagination-control" colspan="3">
		<span class="pagination-info">
        <?php echo $pagination;?>
		</span>
		
	</th>
</tr>
</thead>
<tbody>

		<?php		
        //echo '<pre>';print_r($message);die;
        $email_status=($this->session->userdata('navtitle') && $this->session->userdata('navtitle')!='') ? $this->session->userdata('navtitle') : '';
        if(isset($message) && !empty($message)){
            foreach($message as $list)
			{
             
			    $id=(isset($list['id']) && !empty($list['id'])) ? base64_encode($list['id']) : 0;		
			    $subject=(isset($list['subject']) && !empty($list['subject'])) ? $list['subject'] : '(no-subject)';						
			    $toname='';//(isset($list->toname) && !empty($list->toname)) ? $list->toname : 'N/A';		
			    $date=(isset($list['create_date']) && !empty($list['create_date'])) ? explode(',',$list['create_date']) : '';
			    $message_count=(isset($list['count']) && !empty($list['count']) && $list['count']>1) ? '('.$list['count'].')' : '';
			    $readstatus=(isset($list['readstatus']) && !empty($list['readstatus'])) ? $list['readstatus'] : '';
			    $email_status=(isset($list['email_status']) && !empty($list['email_status'])) ? $list['email_status'] : '';
			    $starred=(isset($list['starred']) && $list['starred']!='') ? explode(',',$list['starred']) : 0;
				$attachment=(isset($list['attach']) && $list['attach']!='') ? $list['attach'] : '';
                        
                if($readstatus==0){
                    $class="class='unread'";											
                }else{
                    $class='';											
                }
        
                if($email_status=='inbox'){
                    $sender_name=(isset($list['sender_name']) && !empty($list['sender_name'])) ? $list['sender_name'] : 'N/A';	
                }elseif($email_status=='sent'){
                    $sender_name=(isset($list['to_emailid']) && !empty($list['to_emailid'])) ? $list['to_emailid'] : 'N/A';	
                }else{
                    $sender_name=(isset($list['sender_name']) && !empty($list['sender_name'])) ? $list['sender_name'] : 'N/A';	
                }		
        ?>
        <tr <?php echo $class?> data-messageid="<?php echo $id;?>">
            <td class="inbox-small-cells">
                <input type="checkbox" class="mail-checkbox" name="mail_checkbox[]" value="<?php echo $id?>">
            </td>	
            <?php if(isset($starred[0]) && $starred[0]==1){?>
            <td class="inbox-small-cells">
                <i class="fa fa-star inbox-started" id="<?php echo $id.'-'.'0'?>"></i>
            </td>
            <?php }else{?>
            <td class="inbox-small-cells">
                <i class="fa fa-star" id="<?php echo $id.'-'.'1'?>"></i>
            </td>
            <?php }?>
            
            <?php if($email_status=='draft'){?>
                    <td class="view-messages hidden-xs">
                        <a href="javascript:;" style="text-decoration:none;"><span style="color:red">Draft</span></a>
                    </td>
                    <td class="view-messages">
                         <?php echo $subject;?>
                    </td>      
                    <?php if($attachment!=''){?>
                    <td class="view-messages inbox-small-cells">
                        <i class="fa fa-paperclip"></i>
                    </td>
                    <?php }else{ ?>
                    <td class="view-messages inbox-small-cells"></td>
                    <?php }?>
                    <td class="view-messages text-right">
                         <?php echo date('d F',strtotime($date[0]));?>
                    </td>                  
            <?php }else{?>
                    <td class="view-message hidden-xs">
                         <?php echo $sender_name.$message_count;?>
                    </td>
                    <td class="view-message">
                         <?php echo $subject;?>
                    </td>
                    <?php if($attachment!=''){?>
                    <td class="view-message inbox-small-cells">
                        <i class="fa fa-paperclip"></i>
                    </td>
                    <?php }else{ ?>
                    <td class="view-message inbox-small-cells"></td>
                    <?php }?>
                    <td class="view-message text-right">
                         <?php echo date('d F',strtotime($date[0]));?>
                    </td>
            <?php }?>

        </tr>
        <?php }}else{?>
        <tr><td colspan='6'>No messages matched your search</td></tr>
        <?php }?>
</tbody>
</table>

