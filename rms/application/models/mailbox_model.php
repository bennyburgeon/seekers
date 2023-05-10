<?php
/**
 * Mailbox_model Class extends CI_Model
 *
 * @package    Admin
 * @email_templates   Adminnistrator
 * @author     Gary
 * @link http://www.example.com/adminnistrator/admin_model.html
 */

class Mailbox_model extends CI_Model {

	
	function Mailbox_model() {
		parent::__construct();		
	}
	
	/**
	 * _delete function
	 *
	 * @access	protected
	 * @params	integer id, string table name
	 * @return	boolean
	 */
	protected function _delete($id, $table,$field)
	{		
		if($field=='message_id'){
			$this->db->query("delete from `pms_emailattachment` where `email_tableid` =".$id);	
			return $this->db->query("delete from `pms_emailmanagement` where `message_id` =".$id);	
		}else{
				$this->db->query("delete from `pms_emailattachment` where `email_tableid` =".$id);	
			    return $this->db->query("delete from `pms_emailmanagement` where `id`=".$id);
		}
	}

	function record_count() 
	{
		return $this->db->count_all('pms_emailmanagement');
	}

	function get_all_rows($limitStart,$numRecords){
		$get = $this->input->get ( NULL, TRUE );
		$fld = $this->input->get ('fld', TRUE );
		$sortby ='id desc';
		
		$res=$this->db->query("SELECT * FROM pms_emailmanagement order by $sortby limit $limitStart, $numRecords ");
		
		$arr = $res->result_array();
		return $arr;
	}
	
	/**
	 * _insert function
	 *
	 * @access	protected
	 * @params	array data, string table name
	 * @return	boolean
	 */
	 
	protected function _insert($data, $table)
	{		
		$this->db->set($data);
		if($this->db->insert($table) !== FALSE)
		{
			return TRUE;
		}

		return FALSE;
	}
	/**
	 * _update function
	 *
	 * @access	protected
	 * @params	integer id, array data, string table name
	 * @return	boolean
	 */
	protected function _update($id, $data, $table)
	{
		$this->db->where('id', $id);
		if($this->db->update($table, $data) !== FALSE)
		{
			return TRUE;
		}

		return FALSE;
	}
		
	
	/**
	 * count_messages function
	 * @access	Public
	 * @return	integer count
	 */
	public function count_messages_old()
	{
		return $this->db->count_all_results('pms_emailmanagement');
	}


	
	/**
	 * insert_update function
	 * @params	array data,integer id
	 * @access	Public
	 * @return	boolean
	 */
	public function insert_update($data, $id=NULL)
	{			
		if($id){
			$this->_update($id, $data, 'pms_emailmanagement');
			return true;
		}
		else{
			$this->_insert($data, 'pms_emailmanagement');
			return $lastinsertid =$this->db->insert_id();
		}

		
	}
	
	/**
	 * get_message_info function
	 * @params	integer id
	 * @access	Public
	 * @return	array
	 */
	public function get_message_info($id, $code='')
	{
		$query = $this->db->get_where('pms_emailmanagement',array('id'=>$id));
		if ($query->num_rows() > 0)
		{
			return $query->row_array();
		}
		return false;
	}
	

	public function get_message_detail($id, $code='')
	{
		
		$member_id=$_SESSION['admin_session'];
		$this->db->where_in('id',explode(',',$id));			
		//$this->db->where('sendar_userid',$member_id);	
		 $query = $this->db->get('pms_emailmanagement');
						
			if ($query->num_rows() > 0)
			{
		
				return $query->result();
			}
		
		return FALSE;
	}

	public function get_inbox_message_detail($id, $code='')
	{
		$member_id=$_SESSION['admin_session'];
		$this->db->select('subject');	
		$this->db->where('id',$id);		
		$this->db->where('to_userid',$member_id);	
		$this->db->from('pms_emailmanagement');			
		$query = $this->db->get(); 
		if($query->num_rows()>0)
		{
			$subject=$query->row();
			$this->db->where('subject',$subject->subject);	
			$this->db->where('to_userid',$member_id);	
			if($query = $this->db->get('pms_emailmanagement') )
			{						
				if ($query->num_rows() > 0)
				{
					return $query->result();
				}
			}
			return FALSE;		
		}						
	}

	/**
	 * message_read_status function
	 * @params	integer id
	 * @access	Public
	 * @return	boolean
	 */
	public function message_read_status($msgid){
		//$status_val=($status==1)? 0 :1;

		$data = array(
               'readstatus' => 1,               
            );
		$this->db->where_in('id', array($msgid));
		$this->db->update('pms_emailmanagement', $data); 
	}


	/**
	 * message_send_status function
	 * @params	integer id
	 * @access	Public
	 * @return	boolean
	 */
	public function setMessageStatus($msgid,$status){		
		$data = array(
               'email_status' =>$status,               
            );
		$this->db->where('id', $msgid);
		$this->db->update('pms_emailmanagement', $data); 
	}
	

	/**
	 * delete_message function
	 * @params	integer id
	 * @access	Public
	 * @return	boolean
	 */
	public function delete_message($id,$table,$field)
	{
		return $this->_delete($id,$table,$field);
	}

	
	/**
	 * message_delete_status function
	 * @params	integer id
	 * @access	Public
	 * @return	boolean
	 */
	public function message_delete_status($msgid,$msgtype)
	{				
		if($msgtype=='inbox'){				
			$field='id';
			 	$this->db->query("update `pms_emailmanagement` set `to_delete` = 1 where `id`=".$msgid);	
		}elseif($msgtype=='sent'){			
			$field='id';
				$this->db->query("update `pms_emailmanagement` set `from_delete` = 1 where `id`=".$msgid);	
		}elseif($msgtype=='trash'){	
			$field='id';
			return $this->delete_message($msgid,'pms_emailmanagement','');
		}elseif($msgtype=='draft'){			
			$field='id';
			    $this->db->query("update `pms_emailmanagement` set `from_delete` = 1 where `id`=".$msgid);	
		}else{
			return $this->delete_message($msgid,'pms_emailmanagement','');
		}
		/*$this->db->where_in($field, $msgid[0]);		
		$this->db->update('pms_emailmanagement', $data);*/
	}

	/**
	 * message_starred_status function
	 * @params	integer id
	 * @access	Public
	 * @return	boolean
	 */
	public function starred($msgid)
	{		
		if($msgid!=''){
			$member_id=$_SESSION['admin_session'];
			$val=explode('-',$msgid);
			$data['starred']=$val[1];
			$messageid=base64_decode($val[0]);
			$this->db->where_in('id', array($messageid));		
			$this->db->update('pms_emailmanagement', $data); 	
			return true;
		}else{
			return false;
		}
	}


	/**
	 * makeMsgUnread function
	 * @params	integer id
	 * @access	Public
	 * @return	boolean
	 */
	public function makeMsgUnread($msgid,$type='')
	{		//echo 'rgfgfgfguuuu';die;
		$data['readstatus']=0;	
		if($type!='' && $type=='all'){
			$this->db->where('id', $msgid);		
		}else{
			$this->db->where('id', $msgid);		
		}
		$this->db->update('pms_emailmanagement', $data); 
		//return true;
	}


	/**
	 * makeMsgUnread function
	 * @params	integer id
	 * @access	Public
	 * @return	boolean
	 */
	public function makeMsgread($msgid,$type='')
	{		
		$member_id=$_SESSION['admin_session'];	
		//echo 'rgfgfgfg';die;
		$data['readstatus']=1;	
		if($type!='' && $type=='all'){
			$this->db->where_in('id', $msgid);		
		}else{
			$this->db->where_in('id', $msgid);		
		}
		$this->db->update('pms_emailmanagement', $data); 
		//return true;
	}
	
	/**
	 * list_messages function
	 * @params	string table field name,string table field name,string value
	 * @access	Public
	 * @return	array
	 */
	public function list_messages($sort_by, $sort_order,$msgtype,$offset,$num)
	{	
		if($offset == ''){
     		$offset= 0;
		} else{
			$offset=$offset;
		}
		$this->db->select('pms_emailmanagement.*');		
		$member_id=1; //$_SESSION['admin_session'];	
		if($msgtype=='inbox'){						
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");
			$this->db->where('email_status','inbox');	
			$this->db->where('to_delete',0);	
			$this->db->order_by('message_date','DESC');
			$this->db->limit($num,$offset);
		}elseif($msgtype=='sent'){	
			
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");		
			$this->db->where('email_status','sent');	
			$this->db->where('from_delete',0);	
			$this->db->order_by('message_date','DESC');
			$this->db->limit($num,$offset);
		}elseif($msgtype=='trash'){			
			
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");
			$this->db->where("(to_delete = 1 OR from_delete = 1)");			
			$this->db->order_by('message_date','DESC');
			$this->db->limit($num,$offset);

		}elseif($msgtype=='draft'){																	
			$this->db->where('sendar_userid',$member_id);	
			$this->db->where("(email_status = 'draft' AND from_delete = 'failed')");	
			$this->db->where('from_delete',0);
			$this->db->order_by('message_date','DESC');
			$this->db->limit($num,$offset);

		}elseif($msgtype=='starred'){											
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");			
			$this->db->where('starred',1);
			$this->db->order_by('message_date','DESC');
			$this->db->limit($num,$offset);

		}elseif($msgtype=='search'){
			$searchmail=(isset($_GET['searchmail']) && !empty($_GET['searchmail'])) ? $_GET['searchmail']:'';			
			$this->db->where("(`to_userid` = ".$member_id." OR `sendar_userid` = ".$member_id.")");		
			$this->db->where("(`subject` LIKE '%".$searchmail."%' OR `message_text` LIKE '%".$searchmail."%')");
			$this->db->order_by('message_date','DESC');
			$this->db->limit($num,$offset);

		}else{
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");	
			$this->db->where('email_status','inbox');	
			$this->db->where('to_delete',0);	
			$this->db->order_by('message_date','DESC');
			$this->db->limit($num,$offset);
		}	
		$this->db->from('pms_emailmanagement');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$list=array();
		$i=0;
		if($query->num_rows()>0)
		{			
			foreach ($query->result() as $row)
			{							
				$id[$row->message_id][]=$row->id;
				$message_id[$row->message_id][]=$row->message_id;
				$email_status[$row->message_id][]=$row->email_status;
				$to_emailid[$row->message_id][]=$row->to_emailid;
				$sender_email[$row->message_id][]=$row->sender_email;
				$sender_name[$row->message_id][]=$row->sender_name;
				$readstatus[$row->message_id][]=$row->readstatus;
				$subject[$row->message_id][]=$row->subject;
				$starred[$row->message_id][]=$row->starred;
				$attach[$row->message_id][]=$row->attachment;
				$create_date[$row->message_id][]=$row->create_date;
				$message_date[$row->message_id][]=$row->message_date;

				$list[$row->message_id]['id']=implode(',',array_unique($id[$row->message_id]));
				$list[$row->message_id]['count']=count($id[$row->message_id]);
				$list[$row->message_id]['message_id']=implode(',',array_unique($message_id[$row->message_id]));
				$list[$row->message_id]['email_status']=implode(',',array_unique($email_status[$row->message_id]));
				$list[$row->message_id]['to_emailid']=implode(',',array_unique($to_emailid[$row->message_id]));
				$list[$row->message_id]['sender_email']=implode(',',array_unique($sender_email[$row->message_id]));
				$list[$row->message_id]['sender_name']=implode(',',array_unique($sender_name[$row->message_id]));
				$list[$row->message_id]['readstatus']=implode(',',array_unique($readstatus[$row->message_id]));
				$list[$row->message_id]['subject']=implode(',',array_unique($subject[$row->message_id]));
				$list[$row->message_id]['starred']=implode(',',array_unique($starred[$row->message_id]));
				$list[$row->message_id]['attach']=implode(',',array_unique($attach[$row->message_id]));
				$list[$row->message_id]['create_date']=implode(',',array_unique($create_date[$row->message_id]));
				$list[$row->message_id]['message_date']=implode(',',array_unique($message_date[$row->message_id]));
				$i++;
			}
			return $list;
			//echo '<pre>';print_r($list);die;
		}
		return false;
	}
	
	/**
	 * get_emails_count function
	 * @params	string table field name,string table field name,string value
	 * @access	Public
	 * @return	array
	 */
	public function get_emails_count($msgtype)
	{
		$this->db->where('email_status','inbox');
		$query = $this->db->get('pms_emailmanagement');
		$emaipmsount = $query->num_rows();
		return $emaipmsount;
	}
	
	public function count_messages($msgtype)
	{	
		$this->db->select('pms_emailmanagement.*');		
		$member_id=$_SESSION['admin_session'];	
		if($msgtype=='inbox'){						
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");
			$this->db->where('email_status','inbox');	
			$this->db->where('to_delete',0);	
			$this->db->order_by('message_date','DESC');
		}elseif($msgtype=='sent'){	
			
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");		
			$this->db->where('email_status','sent');	
			$this->db->where('from_delete',0);	
			$this->db->order_by('message_date','DESC');
		}elseif($msgtype=='trash'){			
			
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");
			$this->db->where("(to_delete = 1 OR from_delete = 1)");			
			$this->db->order_by('message_date','DESC');

		}elseif($msgtype=='draft'){																	
			$this->db->where('sendar_userid',$member_id);	
			$this->db->where("(email_status = 'draft' AND from_delete = 'failed')");	
			$this->db->where('from_delete',0);
			$this->db->order_by('message_date','DESC');

		}elseif($msgtype=='starred'){											
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");			
			$this->db->where('starred',1);
			$this->db->order_by('message_date','DESC');

		}elseif($msgtype=='search'){
			$searchmail=(isset($_GET['searchmail']) && !empty($_GET['searchmail'])) ? $_GET['searchmail']:'';			
			$this->db->where("(`to_userid` = ".$member_id." OR `sendar_userid` = ".$member_id.")");		
			$this->db->where("(`subject` LIKE '%".$searchmail."%' OR `message_text` LIKE '%".$searchmail."%')");					
			$this->db->order_by('message_date','DESC');

		}else{
			$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");	
			$this->db->where('email_status','inbox');	
			$this->db->where('to_delete',0);	
			$this->db->order_by('message_date','DESC');
		}	
		$this->db->from('pms_emailmanagement');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$list=array();
		$i=0;
		if($query->num_rows()>0)
		{			
			foreach ($query->result() as $row)
			{							
				$id[$row->message_id][]=$row->id;
				$message_id[$row->message_id][]=$row->message_id;
				$email_status[$row->message_id][]=$row->email_status;
				$to_emailid[$row->message_id][]=$row->to_emailid;
				$sender_email[$row->message_id][]=$row->sender_email;
				$sender_name[$row->message_id][]=$row->sender_name;
				$readstatus[$row->message_id][]=$row->readstatus;
				$subject[$row->message_id][]=$row->subject;
				$starred[$row->message_id][]=$row->starred;
				$attach[$row->message_id][]=$row->attachment;

				$list[$row->message_id]['id']=implode(',',array_unique($id[$row->message_id]));
				$list[$row->message_id]['count']=count($id[$row->message_id]);
				$list[$row->message_id]['message_id']=implode(',',array_unique($message_id[$row->message_id]));
				$list[$row->message_id]['email_status']=implode(',',array_unique($email_status[$row->message_id]));
				$list[$row->message_id]['to_emailid']=implode(',',array_unique($to_emailid[$row->message_id]));
				$list[$row->message_id]['sender_email']=implode(',',array_unique($sender_email[$row->message_id]));
				$list[$row->message_id]['sender_name']=implode(',',array_unique($sender_name[$row->message_id]));
				$list[$row->message_id]['readstatus']=implode(',',array_unique($readstatus[$row->message_id]));
				$list[$row->message_id]['subject']=implode(',',array_unique($subject[$row->message_id]));
				$list[$row->message_id]['starred']=implode(',',array_unique($starred[$row->message_id]));
				$list[$row->message_id]['attach']=implode(',',array_unique($attach[$row->message_id]));
				$i++;
			}
			return count($list);
			//echo '<pre>';print_r($list);die;
		}
		return false;
	}
	
	public function getInboxEmailDetail($memberid){
	
		$this->db->where('admin_id',$memberid);			
		if($query = $this->db->get('pms_admin_users') )
		{					
			if ($query->num_rows() > 0)
			{
				return $query->row_array();
			}
		}
		return FALSE;
	}

	
	public function getAttachmentMail($msgid){
		
		$member_id=1; //$_SESSION['admin_session'];	
				
		$this->db->select('pms_emailattachment.image_path');
		$this->db->join('pms_emailmanagement', 'pms_emailmanagement.id = pms_emailattachment.email_tableid AND pms_emailmanagement.id='.$msgid);					
		$this->db->from('pms_emailattachment');				
		$query = $this->db->get();
		$attach = array();
		if($query->num_rows()>0)
		{
			$data = $query->result_array();
			for($i=0;$i<count($data);$i++)
			{
				$attach[] = $data[$i]['image_path'];
			}
			return $attach;
		}
		return FALSE;
	}

	public function inbox_search_messages($searchTerm, $sort_by, $sort_order, $msgtype)
	{	
		$this->db->select('pms_emailmanagement.*');		
		$member_id=1; //$_SESSION['admin_session'];					
		$this->db->where("(to_userid = ".$member_id." OR sendar_userid = ".$member_id.")");
		$this->db->where('email_status','inbox');	
		$this->db->where('to_delete',0);
		$this->db->or_like('sender_email',$searchTerm);
		$this->db->or_like('to_emailid',$searchTerm);
		$this->db->or_like('sender_name',$searchTerm);
		$this->db->or_like('message_text',$searchTerm);
		$this->db->or_like('subject',$searchTerm);
		$this->db->order_by('message_date','DESC');
		$this->db->from('pms_emailmanagement');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$list=array();
		$i=0;
		if($query->num_rows()>0)
		{			
			foreach ($query->result() as $row)
			{							
				$id[$row->message_id][]=$row->id;
				$message_id[$row->message_id][]=$row->message_id;
				$email_status[$row->message_id][]=$row->email_status;
				$to_emailid[$row->message_id][]=$row->to_emailid;
				$sender_email[$row->message_id][]=$row->sender_email;
				$sender_name[$row->message_id][]=$row->sender_name;
				$readstatus[$row->message_id][]=$row->readstatus;
				$subject[$row->message_id][]=$row->subject;
				$starred[$row->message_id][]=$row->starred;
				$attach[$row->message_id][]=$row->attachment;
				$create_date[$row->message_id][]=$row->create_date;
				$message_date[$row->message_id][]=$row->message_date;

				$list[$row->message_id]['id']=implode(',',array_unique($id[$row->message_id]));
				$list[$row->message_id]['count']=count($id[$row->message_id]);
				$list[$row->message_id]['message_id']=implode(',',array_unique($message_id[$row->message_id]));
				$list[$row->message_id]['email_status']=implode(',',array_unique($email_status[$row->message_id]));
				$list[$row->message_id]['to_emailid']=implode(',',array_unique($to_emailid[$row->message_id]));
				$list[$row->message_id]['sender_email']=implode(',',array_unique($sender_email[$row->message_id]));
				$list[$row->message_id]['sender_name']=implode(',',array_unique($sender_name[$row->message_id]));
				$list[$row->message_id]['readstatus']=implode(',',array_unique($readstatus[$row->message_id]));
				$list[$row->message_id]['subject']=implode(',',array_unique($subject[$row->message_id]));
				$list[$row->message_id]['starred']=implode(',',array_unique($starred[$row->message_id]));
				$list[$row->message_id]['attach']=implode(',',array_unique($attach[$row->message_id]));
				$list[$row->message_id]['create_date']=implode(',',array_unique($create_date[$row->message_id]));
				$list[$row->message_id]['message_date']=implode(',',array_unique($message_date[$row->message_id]));
				$i++;
			}
			return $list;
			//echo '<pre>';print_r($list);die;
		}
		return false;
	}
		
}