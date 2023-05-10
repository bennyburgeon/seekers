<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notifications extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	    if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');
		$this->load->model("notificationsmodel");
		$this->data['cur_page_name']=config_item('page_title').' Announcements ';
		$this->data['current_page_head']='Announcements';
		$this->data['page'] = 'notification';
		$this->data['module_head'] = 'Announcements';
		$this->data['module_explanation'] = 'add/edit/activate announcements from here.';
		
		$this->load->model("generalmodel");
		$this->load->model('workordermodel');

		$this->data['tasks'] =$this->generalmodel->get_tasks();
	//	$this->data['todos'] = $this->generalmodel->getTodos();
	//	$this->data['messages'] = $this->generalmodel->getMessages();
		$this->data['emails'] = $this->generalmodel->get_emails();
	}
	
	function editor($path,$width) 
	{
		//Loading Library For Ckeditor
		$this->load->library('ckeditor');
		$this->load->library('ckFinder');
		//configure base path of ckeditor folder 
		$this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
		$this->ckeditor-> config['toolbar'] = 'Full';
		$this->ckeditor->config['language'] = 'en';
		$this->ckeditor-> config['width'] = $width;
		//configure ckfinder with ckeditor config 
		$this->ckfinder->SetupCKEditor($this->ckeditor,$path); 
   }
   
	function index($offset = 0)
	{
		$this->load->library('pagination');
		$searchterm='';
		 $start=0;
		if(isset($_GET['limit'])){
			if($_GET['limit']!='')
			$limit= $_GET['limit'];
		 }
		 else{
		 	 $limit=50;
		 }
		$rows='';
		$this->load->model('notificationsmodel');
		
		// paging starts here
		
		if($this->input->get('sort_by')!='')
		{
		$sort_by=$this->input->get("sort_by");
		}
		else
		{
		$sort_by = 'asc';
		}
		if($this->input->get("rows")!='')
		{
		$start=$this->input->get("rows");
		}
		if($this->input->get("rows")!='')
		{
		$rows=$this->input->get("rows");
		}
		
		//if($this->input->get('searchterm')!='')
		//$searchterm=$this->input->get("searchterm");
		
		if(isset($_GET['searchterm'])){
			if($_GET['searchterm']!='')
			$searchterm= $_GET['searchterm'];
		}
		
		$this->data['total_rows']= $this->notificationsmodel->record_count($searchterm);
		$get = $this->input->get ( NULL, TRUE );
		$page = (int) $this->input->get ( 'rows', TRUE );
		$query_str ='';
		if($query_str=='')$query_str;
		
		$this->data['cur_page']=$this->router->class;
		$config['base_url'] = $this->config->item('base_url')."notifications/?sort_by=$sort_by&limit=$limit&searchterm=$searchterm$query_str";
		$config['page_query_string'] = TRUE;
		$config['total_rows'] = $this->data['total_rows'];
		$config['query_string_segment'] = 'rows';
		$config['per_page'] =$limit;
		$config['num_links'] = $this->data['total_rows'];
		$config['full_tag_open'] = ' <div class="pagination-centered"><ul class="pagination">';
		$config['first_link']=false;
		$config['last_link']=false;
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
		
		// paging ends here
		$this->data["records"] = $this->notificationsmodel->get_list($start,$limit,$searchterm,$sort_by);
		
		$this->data["sort_by"] = $sort_by;
		$this->data["rows"] = $rows;
		$this->data["searchterm"]=$searchterm;
			
		$this->data['module_action'] = 'Announcements';
		$this->data["page_head"]= "Announcements";
		$this->load->model('notificationsmodel');
		$this->data['page_head']= 'Manage Announcements';
		$limit=20;	
		$config['base_url'] = base_url().'notifications/?';
	
		$cnt	=	ceil($this->data['total_rows']/$limit);	
		$this->data['pages']=$cnt;
		$this->data['limit']=$limit;
		
		if($this->input->get('del')==1)$data['del']=1;
		if($this->input->get('upd')==1)$data['upd']=1;
		if($this->input->get('ins')==1)$data['ins']=1;

		$this->load->view('include/header',$this->data);
		$this->load->view('notifications/list',$this->data);				
		$this->load->view('include/footer',$this->data);
		
	}
	
	function add()
	{	
		$this->data['formdata']=array(
		'text_message'        =>  '',
		'message_from'   =>  '',
		'message_to'     =>  '',
		'message_date'   =>  '',
		);
		
		$this->data["admin_users_list"] = $this->notificationsmodel->admin_users_list();
		
		if($this->input->post('text_message'))
		{
			
			$this->form_validation->set_rules('text_message', 'Message', 'required');
			if ($this->form_validation->run() == TRUE)
			{
				$message_to=$this->input->post('message_to');
				
				foreach($message_to as $key => $val)
				{
					date_default_timezone_set('Asia/Calcutta');
					$msg_date = date('Y-m-d H:i:s');
						
						$data=array(
						'text_message'   =>  $this->input->post('text_message'),
						'message_from'   =>  14,
						'message_to'     =>  $val,
						'message_date'   =>  $msg_date,
						);
						$message_id=$this->notificationsmodel->insert_record($data);
				}										
				redirect('notifications/?ins=1');
			}
		}
		
		$this->data['page_head']= 'Add Messages';
		$this->data['module_action'] = 'Add Message';
		
		$path = '../js/ckfinder';
		
		$width = '1000px';
		
		$this->editor($path, $width);
			
		$this->load->view('include/header',$this->data);
		$this->load->view('notifications/add',$this->data);	
		$this->load->view('include/footer',$this->data);
		
	}

// edxit and update pages here 

	function edit($id=null)
	{
		$this->data['formdata']=array(
		'not_title'    => '',
		'not_text'     => ''
		);
		
		if(!empty($id))
		{
			$this->db->where('not_id', $id);
			$query=$this->db->get('pms_notifications');
			$this->data['formdata']=$query->row_array();
			$this->data["list_unit"] = $this->notificationsmodel->list_unit();
			
			$data['page_head']= 'Edit Announcements';
			$this->data['module_action'] = 'Edit Announcements';
			$path = '../js/ckfinder';
		     $width = '700px';
		    $this->editor($path, $width);
			$this->load->view('include/header',$this->data);
			$this->load->view('notifications/edit',$this->data);	
			$this->load->view('include/footer',$this->data);
			
		}
	}
	
	function update($id=null)
	{
		$id = $this->input->post('not_id'); 
		$this->data["list_unit"] = $this->notificationsmodel->list_unit();
		if(!empty($id))
		{
			$this->form_validation->set_rules('not_title', 'Title', 'required');
			//$this->form_validation->set_rules('company_name_dup', 'Contact Name', 'callback_check_dups');
			if ($this->form_validation->run() == TRUE)
			{
				$id=$this->notificationsmodel->update_record($id);
				if($this->input->post('send_email') == 'on')
				{
					$email_text = $this->input->post('not_text'); 
					$unit_ids = $this->input->post('unit_id');
					foreach($unit_ids as $key=>$val)
					{
						$unit_data = $this->db->where('prop_unit_id',$val)->get('pms_property_unit')->row_array();
						if($unit_data['owner_email'] != '')
						{
							$email = $unit_data['owner_email'];
							$user = $unit_data['owner_name'];
							$this->sentmail($email,$email_text,$user);	
						}
					}
				}
				redirect('notifications/?upd=1');
			}else{
				$this->data['formdata']=array(
					'not_title'    => $this->input->post('not_title'),
					'not_text'     => $this->input->post('not_text')
				);
				$data['page_head']= 'Edit Announcements';
				$path = '../js/ckfinder';
		     $width = '700px';
		    $this->editor($path, $width);
				$this->load->view('include/header',$this->data);
				$this->load->view('notifications/edit',$this->data);	
				$this->load->view('include/footer',$this->data);
			}
		}else
		{
			redirect('notifications');
		}			
	}
	
	public function sentmail($email,$email_text,$user)
	{
		$query = $this->db->query("SELECT *  FROM pms_partners where customer_id =".$_SESSION['customer_id']);
		$row = $query->row_array();
		$subject    = 'Notification from Property Manager';
		$mail_body	=	'
		<!DOCTYPE html>
			<head>			
			<title>Test</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
			<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />			
			<style type="text/css">			
			body{width:100%;margin:0px;padding:0px;background:#3b3b3b;text-align:left;}
			html{width: 100%; }
			img {border:0px;text-decoration:none;display:block; outline:none;}
			a,a:hover{color:#FFF;text-decoration:none;}.ReadMsgBody{width: 100%; background-color: #ffffff;}.ExternalClass{width: 100%; background-color: #ffffff;}
			table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }  			
			img[class=imageScale]			{}			
			.main-bg{ background:#3b3b3b;}
			.divater-bottom{ border-bottom:#eeeff1 solid 1px;}
			.space1{padding:35px 35px 35px 35px;}
			.contact-space{padding:15px 24px 15px 24px;}
			table[class=social]{ text-align:right;}
			.contact-text{font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF; padding-left:4px;}
			.border-bg{ border-top:#67bd3c solid 4px;}
			.borter-inner-bottom{ border-bottom:#67bd3c solid 1px;}
			.borter-inner-top{ border-top:#37a166 solid 1px;}
			.borter-footer-bottom{ border-bottom:#ececec solid 1px; border-top:#67bd3c solid 3px;}
			.borte-footer-inner-borter{ border-bottom:#67bd3c solid 3px;}
			.header-space{padding:0px 20px 0px 20px;}			
			@media only screen and (max-width:640px)			
			{				
			body{width:auto!important;}
				.main{width:440px !important;margin:0px; padding:0px;}
				.two-left{width:440px !important; text-align: center!important;}
				.two-left-inner{width: 376px !important; text-align: center!important;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			
			@media only screen and (max-width:479px)
			{
				 body{width:auto!important;}
				.main{width:280px !important;margin:0px; padding:0px;}
				.two-left{width: 280px !important; text-align: center!important;}
				.two-left-inner{width: 216px !important; text-align: center!important;}
				.space1{padding:35px 0px 35px 0px;}
				table[class=social]{ width:100%; text-align:center; margin-top:20px;}
				table[class=contact]{ width:100%; text-align:center; font:12px;}
				.contact-space{padding:15px 0px 15px 0px;}
				.header-space{padding:30px 0px 30px 0px;}
			}
			</style>
			</head>			
			<body>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main-bg" style="background:#dcdcdc;">
			  <tr>
				<td align="center" valign="top" style="padding:50px 0px 50px 0px;">				
			  <!--  Main Table Start-->				
				<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top">					
					<!--  Header Part Start-->					
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:30px 20px 30px 20px;border-top:#67bd3c solid 4px;" class="border-bg"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="50%" align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"></td>
							<td width="50%" align="right" valign="middle" style="font:Bold 14px Arial, Helvetica, sans-serif; color:#FFF;">'.date("F d,Y",strtotime(date('Y-m-d'))).'</td>						  </tr>
						</table></td>
					  </tr>
					  </table>					  
					  <table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top" bgcolor="#FFFFFF" style="background:#FFF;"><table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF; padding-top:30px; padding-bottom:30px;" class="header-space">					
					 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">					   <tr>
			
						 <td align="center" valign="top">						 
						 <!--  Logo Part Start-->						 
						  <table border="0" align="left" cellpadding="0" cellspacing="0" class="two-left">					  <tr>
					   <td align="center" valign="middle" style="font:normal 12px Arial, Helvetica, sans-serif; color:#FFF;"><img src="'.$this->config->item('assets_url').'frontend/layout/img/logo.png" width="141" height="42" alt="" /></td>
					  </tr>
					</table>					
					<!--  Logo Part End-->
					
					<!--  Call Part Start-->
					<table  border="0" align="right" cellpadding="0" cellspacing="0" class="two-left">
			  <tr>				  <td align="center" valign="bottom" style="font:Bold 15px Arial, Helvetica, sans-serif; color:#67bd3c; padding-top:18px;"><span style="color:#3b3b3b;">Call Us :</span>'.$this->config->item("mobile").'
			  </tr>
			</table>
			<!--  Call Part End-->
						 
						 </td>
					   </tr>
					 </table></td>
					</tr>
				</table></td>
				</tr>
			</table>
			
			<!--  Banner Part Start-->
			<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
			  <tr>
				<td align="left" valign="top">&nbsp;</td>
				</tr>
			  <tr>
				<td align="left" valign="top">
				
				<!--  Banner Text Start-->
				<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="main">
				  <tr>
					<td align="left" valign="top" bgcolor="#67bd3c" style="background:#fff;  padding:12px 20px 12px 20px;" class="borter-inner-bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td align="left" valign="top" style="font:Normal 12px Arial, Helvetica, sans-serif; color:#67bd3c; padding:8px 0px 16px 4px; line-height:22px;"><p><strong>Dear '.$user.',</strong><br />
							<br />
						  '.$email_text.'
						  </p>
						  <p>Thank You ! <br>
						 Test.com</p></td>
						</tr>
					  </table></td>
				  </tr>
				  </table>
				<!--  Banner Text End-->
				
				</td>
			  </tr>
			</table>
			
			<!--  Banner Part End-->
			
			<!--  Header Part End-->
					  </td>
				  </tr>
				  
				  <tr>
					<td align="left" valign="top">
					
					<!--  Footer Part Start-->
					<table width="600" border="0" cellspacing="0" cellpadding="0" class="main">
					  
					  
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="font: normal 12px Arial, Helvetica, sans-serif;background:#fff; padding:16px 20px 14px 20px;border-bottom:#67bd3c solid 3px; line-height:22px;" class="borte-footer-inner-borter">
					 <p style="text-align:center; font-weight:bold;">5 stripes - your custom mixed organic cereals.</p><br />
			<br />
			<center>'.
				$this->config->item("address").'
			</center></p></td>
					  </tr>
					  <tr>
						<td align="left" valign="top" bgcolor="#67bd3c" style="background:#67bd3c; padding:16px 0px 14px 0px;border-bottom:#67bd3c solid 3px; " class="borte-footer-inner-borter">
						
						<!--  Social Media Part Start-->
						<table width="102" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$this->config->item("assets_url").'frontend/layout/img/facebook-icon.png" width="27" height="28" alt="" /></a></td>
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$this->config->item("assets_url").'frontend/layout/img/twitter-icon.png" width="27" height="28" alt="" /></a></td>
					 
			
							<td width="34" align="left" valign="top"><a href="#"><img src="'.$this->config->item("assets_url").'frontend/layout/img/linkedin-icon.png" width="27" height="28" alt="" /></a></td>
				
						  </tr>
						</table>
						<!--  Social Media Part End-->
						
						</td>
					  </tr>
					</table>
					<!--  Footer Part End-->
					
					</td>
				  </tr>
				</table>
				
				<!--  Main Table End-->
				
				</td>
			  </tr>
			</table>
			</body>			
			</html>
		';
		$name = $row['firstname']." ".$row['lastname'];
		$this->load->library('email');
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('logicsoftonline@gmail.com', $name);
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($mail_body);
		$this->email->send();
	}
	
	function delete($id=null)
	{
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		if(!empty($id))
		{
			$this->db->where('not_id', $id);
			$this->db->delete('pms_notifications'); 
			redirect('notifications/?rows='.$rows.'&del=1');
		}elseif(is_array($this->input->post('checkbox')))
		{
			 foreach ($this->input->post('checkbox') as $key => $val)
 				{
					$this->db->where('not_id', $val);
					$this->db->delete('pms_notifications'); 
				}
			redirect('notifications/?rows='.$rows.'&del=1');
		}
	}
	
	function multidelete(){
		$rows='';
		if($this->input->get("rows")!='')
		{
			$rows=$this->input->get("rows");
		}
		$id_arr = $this->input->post('checkbox');
		if(count($id_arr)>0){
			$this->load->model('notificationsmodel');
			$this->notificationsmodel->delete_multiple_record($id_arr);
			redirect('notifications/?rows='.$rows.'&del=1');
		}
		else{
			redirect('notifications');
		}
	}

}
?>
