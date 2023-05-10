<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_inbox extends CI_Controller {

	public function My_inbox()
	{ 
		parent::__construct();		
			  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');

		$this->data['cur_page_name']=config_item('page_title').' My Inbox ';
		$this->data['current_page_head']='My Inbox';
		$this->data['page'] = 'inbox';
		$this->data['module_head'] = 'Manage Emails';
		$this->data['module_explanation'] = 'send and receive emails.';
		
		$this->load->helper('url');		
		$this->load->model('mailbox_model');
		$this->load->helper('emailmanagment');				
		$this->load->helper('text');	
		$this->load->library('pagination');	
		$this->getinbox();
	}

	
	public function index()
	{ 
		$this->data['module_action'] = 'My Inbox';		
		$this->data["page_head"]= "My Inbox";
		  
		// take count of all mail boxes
        $this->data['inbox_count'] = $this->mailbox_model->count_messages('inbox');
        $this->data['sent_count'] = $this->mailbox_model->count_messages('sent');
        $this->data['draft_count'] = $this->mailbox_model->count_messages('draft');
        $this->data['trash_count'] = $this->mailbox_model->count_messages('trash');
        $this->data['starred_count'] = $this->mailbox_model->count_messages('starred');
        $this->data['search_count'] = $this->mailbox_model->count_messages('search');
		// count end here 
		$this->data['menu_flow_visted']=0;
		//$this->data['menu']=$this->load->view('includes/menu',$this->data,true);
		//$this->data['menu_flow']=$this->load->view("includes/flow",$this->data,true);
		
		//$this->load->view('inbox/inbox_header',$this->data);
		$this->load->view('include/header',$this->data);
		$this->load->view('inbox/inbox',$this->data);//first inbox page
		$this->load->view('include/footer',$this->data);
		//$this->load->view('inbox/inbox_footer',$this->data);		
	}

	public function getPagination()
	{
		// paging starts here

		$this->data['total_rows']= $this->mailbox_model->record_count();
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$arr_query = array();
		$query_str = implode("&", $arr_query);
		$this->data['cur_page']=$this->router->class;

		$config['base_url'] = $this->config->item('base_url')."my_inbox/?$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] = 10;
		$config['num_links'] = 5;
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['full_tag_close'] = '</ul></div>';
		$this->pagination->initialize($config);
		$pagination=$this->pagination->create_links();
		// paging ends here
		
		return $pagination;
		
		$this->data['all_contacts']=$this->mailbox_model->get_all_rows ( intval ( $page ), $config ['per_page'] );
		
	}
	public function inbox_compose()
	{
		$this->load->view('inbox/compose-email');
	}

    public function send_message() {

        if ($this->input->post('send') != '' && $this->input->post('send') == 'sendmsg') {
            $this->sendmails();
        } elseif ($this->input->post('draft') != '' && $this->input->post('draft') == 'draftmsg') {
            $this->draftmails();
        } elseif ($this->input->post('discard') != '' && $this->input->post('discard') == 'discardmsg') {
            if ($this->input->post('id') != '' && $this->input->post('id') > 0) {
                $msgid = $this->input->post('id');
                $this->db->delete('pms_emailmanagement', array('id' => $msgid));
            }
            redirect("my_inbox");
        }
    }
	
	public function inbox_view($msgtype = 'inbox', $sort_by = 'create_date', $sort_order = 'desc', $offSet = '')
	{
	
		if(isset($_POST['pageID']))
		{
			$offSet = $_POST['pageID'];
		} else {
			$offSet = 0;
		}
		//GET LISTINGS / EMAILS COUNT
		$listings_count = $this->mailbox_model->get_emails_count($msgtype);
		// pagination
		//$offset = $this->uri->segment(3);
		$data['num'] = $offSet;
		$data['presentpage'] = $offSet;
		$config['total_rows'] = $listings_count;
		$data['list_count']=$listings_count;
		$config['per_page'] = 5;	
		$config['uri_segment'] = 3;
		$config['base_url'] = base_url().'my_inbox/inbox_view/';
		$config['num_links'] = 3;
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['prev_link'] = 'Prev';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_link'] = 'Next';
		$config['full_tag_close'] = '</ul></div>';
		$this->pagination->initialize($config);
		$this->data['pagination']=$this->pagination->create_links();
		//$this->data['pagination']=$this->getPagination();
        $this->data['message'] = $this->mailbox_model->list_messages($sort_by, $sort_order, $msgtype,$offSet,$config['per_page']);

        $this->load->view('inbox/all-emails', $this->data);
	}
	
	public function inbox_reply()
	{
 		if ($this->input->post('message_id') != '') {
            $this->data['replyof']= $this->mailbox_model->get_message_info($this->input->post('message_id'));
            $this->load->view('inbox/reply-email', $this->data);
        }else
		{
			echo 'error';
		}
	}

	public function inbox_load_msg()
	{
		//echo $this->input->get('messageid')
		$messageid = base64_decode($this->input->get('message_id'));
        if ($messageid != '') {
           $this->message['viewmessage'] = $this->mailbox_model->get_message_detail($messageid);
           $this->mailbox_model->message_read_status($messageid);
             $this->load->view('inbox/view-email', $this->message);
        }
        		
	}
	public function inbox_search($msgtype = 'inbox', $sort_by = 'create_date', $sort_order = 'desc', $offset = 0)
	{
		/*if(trim($this->input->post('searchTerm')) != '')
		{
			$searchTerm = $this->input->post('searchTerm');
		} else {
			$searchTerm = 'ALL';
		}*/
        $searchTerm = $_POST['searchTerm'];
		// take count of all mail boxes
        /*$this->data['inbox_count'] = $this->mailbox_model->count_messages('inbox');
        $this->data['sent_count'] = $this->mailbox_model->count_messages('sent');
        $this->data['draft_count'] = $this->mailbox_model->count_messages('draft');
        $this->data['trash_count'] = $this->mailbox_model->count_messages('trash');
        $this->data['starred_count'] = $this->mailbox_model->count_messages('starred');
        $this->data['search_count'] = $this->mailbox_model->count_messages('search');*/
		// count end here 
		
		$this->data['pagination']=$this->getPagination();
		/*$this->load->view('inbox/inbox_header',$this->data);
		$this->load->view('includes/menu',$this->data);
		$this->load->view('inbox/inbox_footer',$this->data);*/
		$this->data['message'] = $this->mailbox_model->inbox_search_messages($searchTerm, $sort_by, $sort_order, $msgtype);
		$this->load->view('inbox/all-emails', $this->data);
	}	

	 public function getinbox(){
		//$member_id=1; //$this->session->userdata('member_id');
		$member_id = $_SESSION['vendor_session'];
		

		
		if($member_id!='' && $member_id>0){
			$inboxid = $this->mailbox_model->getInboxEmailDetail($member_id);	
			//print_r($inboxid);
			//exit();
			$this->load->library('Imapemail',$inboxid);		
			$mails = array();

			// Get some mail
			$mailsIds = $this->mailbox->searchMailBox('ALL');
			
			if(!$mailsIds) {
				die('Mailbox is empty');
			}

			//$mailId = end($mailsIds);
			foreach($mailsIds as $id){
				$mail = $this->mailbox->getMail($id);
				$cc = $mail->cc;
				$ccemail=array();
				foreach($cc as $cckey=>$objcc) {
						$ccemail[] = $cckey;					
				}
				$bccemail=array();
				if(isset($mail->bcc)){
					$bcc = $mail->bcc;				
					foreach($bccemail as $bcckey=>$objbcc) {
							$bccemail[] = $bcckey;					
					}
				}
				$data = array(				
					'to_userid' =>$member_id,
					'to_emailid' => $mail->toString ,
					'to_name'=>$mail->toString,
					'cc' => implode(',',$ccemail) ,
					'bcc' => implode(',',$bccemail) ,				
					'sender_email'=>$mail->fromAddress,
					'sender_name'=>$mail->fromName,
					'subject'=>str_replace('Re:','',$mail->subject),
					'message_text'=>$mail->textHtml,
					//'message_id'=>$mail->id,
					'server_mailid'=>$mail->id,
					'email_status' =>'inbox',								
					'create_date' => date("Y-m-d"),
					'message_date'=>time(),
				);
				
				$this->db->where('to_userid',$member_id);
				$this->db->where('server_mailid',$mail->id);
				$this->db->from('pms_emailmanagement');
				
				$query = $this->db->get();  						
				if($query->num_rows()==0)
				{
					$this->db->select('message_id');
					$this->db->where('to_userid',$member_id);
					$this->db->where('to_emailid',$mail->toString);
					$this->db->where('subject',str_replace('Re:','',$mail->subject));
					$this->db->where('create_date',date('Y-m-d'));
					$this->db->from('pms_emailmanagement');
					$query1 = $this->db->get();  
					if($query1->num_rows()>0)
					{						
						$data['message_id']=$query1->row()->message_id;						
					}else{
						$data['message_id']=$mail->id;
					}

					$this->db->insert('pms_emailmanagement', $data);
					
					$lastinsertid=$this->db->insert_id();
					
					if($mail->getAttachments()!='' && count($mail->getAttachments())>0){
						foreach($mail->getAttachments() as $attachfile){					
							$imagedata = array(				
								'image_id' =>$attachfile->id,
								'image_name' => $attachfile->name,
								'image_path' => $attachfile->filePath,
								'email_tableid' => $lastinsertid,																		
								'create_date'=>date('Y-m-d',strtotime($mail->date)),
								'modify_date'=>date('Y-m-d',strtotime($mail->date)),
							);
							$imagedata[] = $attachfile->name;						
						}
						$this->db->where('id',$lastinsertid);
						$this->db->update('pms_emailattachment', array('attachment'=>implode(',',$imagedata))); 
					}
				}
			}
		 }else{
			 return false;
		 }
	 }

    public function sendmails() {

        $member_id = $_SESSION['vendor_session'];
        $this->form_validation->set_rules('to', 'To', 'xss_clean|trim|required');
     //   $this->form_validation->set_rules('subject', 'Subject', 'xss_clean|trim|required');
        //$this->form_validation->set_rules('message_text', 'Body', 'xss_clean|trim|required');		
        if ($this->form_validation->run() === TRUE) {
            $to = ($this->input->post('to') != '') ? $this->input->post('to') : '';
            $cc = ($this->input->post('cc') != '') ? $this->input->post('cc') : '';
            $bcc = ($this->input->post('bcc') != '') ? $this->input->post('bcc') : '';
            $message_id = ($this->input->post('message_id') != '') ? $this->input->post('message_id') : time();
            $attachfiles = ($this->input->post('attachfiles') != '' && count($this->input->post('attachfiles')) > 0) ? implode(',', $this->input->post('attachfiles')) : '';
            $msgdetail = array(
                'to_emailid' => $to,
                'cc' => $cc,
                'bcc' => $bcc,
                'sendar_userid' => $member_id,
                'sender_email' => 'shaijotm@gmail.com', // $_SESSION['admin_mail'],
                'sender_name' => 'Shyjo Mathew',    //$_SESSION['name']
                'subject' => $this->input->post('subject'),
                'message_text' => $this->input->post('message_text'),
                'attachment' => $attachfiles,
                'message_id' => $message_id,
                'create_date' => date("Y-m-d"),
                'message_date' => time(),
            );
            if ($this->input->post('id') != '' && $this->input->post('id') > 0) {
                $this->mailbox_model->insert_update($msgdetail, $this->input->post('id'));
                $lastinsertid = $this->input->post('id');
            } else {
                $lastinsertid = $this->mailbox_model->insert_update($msgdetail);
            }
			$attacharray = array();
			if($lastinsertid)
			{
				if(!empty($attachfiles))
				{
					$this->db->where('email_tableid',$lastinsertid)->delete('pms_emailattachment');
					$attachfiles = $this->input->post('attachfiles');
					foreach($attachfiles as $key=>$val)
					{
						$data['image_id'] = "2147483647";
						$data['image_name'] = $val;
						$data['image_path'] = $this->config->item('assets_url')."plugins/jquery-file-upload/server/php/files/".$val;
						$data['email_tableid'] = $lastinsertid;
						$data['create_date'] = date('Y-m-d H:i:s');
						$data['modify_date'] = date('Y-m-d H:i:s');
						$this->db->insert('pms_emailattachment',$data);
						//$attacharray[] = $this->config->item('assets_url')."global/plugins/jquery-file-upload/server/php/files/".$val;
					}
				}	
			}
            if ($lastinsertid) {
                $to = $this->input->post('to');
                $cc = $this->input->post('cc');
                $bcc = $this->input->post('bcc');
                $subject = $this->input->post('subject');
                $message = $this->input->post('message_text');
                $from = 'Shyjo Mathew';     //$_SESSION['name']   // changehere
                $sendarname = 'Shyjo Mathew';   // $_SESSION['name'] // changehere
				if($subject == '')$subject = $_SESSION['name']." Mylandlord";
             	$attachtment =$this->mailbox_model->getAttachmentMail($lastinsertid,'fromid');
				$sendmail = send_mails_new($to, $from, $subject, $message, $attachtment,$bcc='',$cc);
                //$sendmail = send_mails($to, $subject, $message, $from, $cc = '', $bcc = '', $attachtment, $sendarname);
                //$sendmail=true;
                if ($sendmail) {
                    $msgstatus = ($this->input->post('email_status') != '') ? $this->input->post('email_status') : 'sent';
                    $this->session->set_flashdata('success', 'Email sent successfully.');
                } else {
                    $msgstatus = 'failed';
                    $this->session->set_flashdata('error', 'Failed');
                }
                $this->mailbox_model->setMessageStatus($lastinsertid, $msgstatus);
            } else {
                $this->session->set_flashdata('error', 'Failed');
            }
            redirect('my_inbox');
            exit;
        }
    }

    public function draftmails() {
        $member_id = 1;
        $to = ($this->input->post('to') != '') ? $this->input->post('to') : '';
        $cc = ($this->input->post('cc') != '') ? $this->input->post('cc') : '';
        $bcc = ($this->input->post('bcc') != '') ? $this->input->post('bcc') : '';
        $message_id = ($this->input->post('message_id') != '') ? $this->input->post('message_id') : time();
        $attachfiles = ($this->input->post('attachfiles') != '' && count($this->input->post('attachfiles')) > 0) ? implode(',', $this->input->post('attachfiles')) : '';
        
		$msgdetail = array(
            'to_emailid' => $to,
            'cc' => $cc,
            'bcc' => $bcc,
            'sendar_userid' => $member_id,
            'sender_email' => 'email',
            'sender_name' => 'sender name',
            'subject' => $this->input->post('subject'),
            'message_text' => $this->input->post('message_text'),
            'attachment' => $attachfiles,
            'message_id' => $message_id,
            'email_status' => 'draft',
            'create_date' => date("Y-m-d"),
            'message_date' => time(),
        );
		
        if ($this->input->post('id') != '' && $this->input->post('id') > 0) {
            $msgid = $this->input->post('id');
        } else {
            $msgid = '';
        }
        $lastinsertid = $this->mailbox_model->insert_update($msgdetail, $msgid);
        if ($lastinsertid) {
            $this->session->set_flashdata('success', 'Email saved succesfully');
        } else {
            $this->session->set_flashdata('error', 'Failed');
        }
        redirect("my_inbox");
        exit;
    }

    public function draft_compose() {
		 // $draftmsg = $this->mailbox_model->get_message_info($messageid);
		$messageid = base64_decode($this->input->get('message_id'));
        if ($messageid != '') {
           $this->data['message'] = $this->mailbox_model->get_message_info($messageid);
		  // print_r($this->data['message']);
           $this->mailbox_model->message_read_status($messageid);
           $this->load->view('inbox/draft-compose', $this->data);
        }
        			 
    }

    //Delete Message
    public function delete($msgid = '', $msgtype = '') 
	{
        if (isset($_POST['tableid']) && !empty($_POST['tableid'])) 
		{
            $array = explode(',', $_POST['tableid']);
			
            if ($array != '' && !empty($array) && count($array) > 0) 
			{
				$login_id = 1;
				$inboxid = $this->mailbox_model->getInboxEmailDetail($login_id);
				$this->load->library('imapemail', $inboxid);
                foreach ($array as $val ) 
				{
					$val = base64_decode($val);
				    $query = $this->db->query("select * from pms_emailmanagement where id = '".$val."'");
					if($query->num_rows()>0){
						$data = $query->row_array(); 
						$this->mailbox->deleteMail($data['server_mailid']);
						$this->mailbox_model->message_delete_status($val, $msgtype);
					}
                }
				echo 'success';
            }
        }
    }

    //Delete Message
    public function deletemessage($msgid = '', $msgtype = '') {
        $this->mailbox_model->message_delete_status($msgid, $msgtype);
        redirect('my_inbox');
        exit;
    }

    //starred Message
    public function starred() {
        if (isset($_POST['tableid']) && !empty($_POST['tableid'])) {
            $this->mailbox_model->starred($_POST['tableid']);
            echo 'success';
            exit;
        }
    }

    //unread Message
    public function makeMsgUnread($msgid = '') {
        if ($msgid != '' && $msgid > 0) {
            $this->mailbox_model->makeMsgUnread($msgid);
			redirect('my_inbox');
        } elseif (isset($_POST['tableid']) && !empty($_POST['tableid'])) {
            $array = explode(',', $_POST['tableid']);
            if ($array != '' && !empty($array) && count($array) > 0) {
                foreach ($array as $val) {
                    $val= base64_decode($val);
                    $this->mailbox_model->makeMsgUnread($val, 'all');
                }
            }
            echo 'success';
            exit;
        }
    }

    //unread Message
    public function makeMsgread($msgid = '') {
        if ($msgid != '' && $msgid > 0) {
            $this->mailbox_model->makeMsgread($msgid);
            redirect($this->config->item('prevous_url'));
            exit;
        } elseif (isset($_POST['tableid']) && !empty($_POST['tableid'])) {
            $array = explode(',', $_POST['tableid']);
            if ($array != '' && !empty($array) && count($array) > 0) {
                foreach ($array as $val) {
                    echo $val . '<br>';
                    $ids[] = base64_decode($val);
                    $this->mailbox_model->makeMsgread($ids, 'all');
                }
            }
            echo 'success';
            exit;
        }
    }


    public function forward() {
        if ($this->input->post('message_id')) {
            $this->data['forward_to'] = $this->mailbox_model->get_message_info($this->input->post('message_id'));
            $this->load->view('inbox/forward-email', $this->data);
        }
        return false;
    }
	
    //Download Attachment
    public function download($attachment) {
        $this->load->helper('download');
        $data = file_get_contents($this->config->item('assets_url')."global/plugins/jquery-file-upload/server/php/files/".$attachment); // Read the file's contents
        $name = $attachment;
        force_download($name, $data);
    }

    public function autoSavedData() {
        $member_id = $_SESSION['customer_id'];
        $currentDateTime = date("Y-m-d : H:i:s", time());
        $to = ($this->input->post('to') != '') ? $this->input->post('to') : '';
        $cc = ($this->input->post('cc') != '') ? $this->input->post('cc') : '';
        $bcc = ($this->input->post('bcc') != '') ? $this->input->post('bcc') : '';
        $attachfiles = ($this->input->post('attachfiles') != '' && count($this->input->post('attachfiles')) > 0) ? implode(',', $this->input->post('attachfiles')) : '';
        $msgdetail = array(
            'to_emailid' => $to,
            'cc' => $cc,
            'bcc' => $bcc,
            'sendar_userid' => $member_id,
            'sender_email' => $_SESSION['email'],
            'sender_name' => $_SESSION['customer_name'],
            'subject' => $this->input->post('subject'),
            'message_text' => $this->input->post('message_text'),
            'attachment' => $attachfiles,
            'email_status' => 'draft',
            'create_date' => $currentDateTime,
            'message_date' => time(),
        );
        if (!$this->input->post('draftmode')) {
            $replyof = ($this->input->post('reply_of') != '') ? $this->input->post('reply_of') : '';
            $forwardof = ($this->input->post('forward_of') != '') ? $this->input->post('forward_of') : '';
            $msgdetail['replyof'] = $replyof;
            $msgdetail['forwardof'] = $forwardof;
        }

        if ($this->input->post('email_tableid') != '' && $this->input->post('email_tableid') > 0) {
            $msgid = $this->input->post('email_tableid');
        } else {
            $msgid = '';
        }
        if ($msgid != '' && $msgid > 0) {
            $this->mailbox_model->insert_update($msgdetail, $msgid);
            $lastinsertid = $msgid;
        } else {
            $lastinsertid = $this->mailbox_model->insert_update($msgdetail);
        }

        if ($lastinsertid) {
            echo 'yes-' . $lastinsertid;
            die;
        }
	}
	 function test(){
        $to = 'prashantkorat14@gmail.com';
        $subject = 'this is test';
        $message = 'this is test msg body'; 
        $from = 'prince143sexy@gmail.com'; 
        $cc = ''; 
        $bcc = '';
        $filetoattach = ''; 
        $sendarname = 'asd';
        $files = array();
        $files = array('http://isc.stuorg.iastate.edu/wp-content/uploads/sample.jpg', 'http://isc.stuorg.iastate.edu/wp-content/uploads/sample.jpg');
        send_mails_new($to, $from, $subject, $message, $files);
        
        
    }

	 
}