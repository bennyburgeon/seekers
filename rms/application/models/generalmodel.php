<?php

class Generalmodel extends CI_Model{

	var $table_inbox	      = "";
	var $table_notification	  = "";
	var $table_tasks	      = "";	
	
	function __construct()
	{
		$this->table_inbox         = "pms_email_msgs";
		$this->table_message  = "pms_message";
		$this->table_tasks         = "pms_tasks";
	}

	function get_tasks()
	{
		$query = $this->db->query("select task_id, task_title from ".$this->table_tasks." limit 0,10");
		return $query->result_array();
	}
	
	function get_messages()
	{
		$query = $this->db->query("select not_id, not_title from ".$this->table_message." limit 0,10");
		return $query->result_array();
	}
	
	function get_emails()
	{
		$query = $this->db->query("select email_id,email_from,email_sub from ".$this->table_inbox." limit 0,10");
		return $query->result_array();
	}	

	function getEmails(){
		$query = $this->db->query("SELECT a.* FROM pms_email_msgs a WHERE a.user_id=".$_SESSION['admin_session']);
		return $query->result_array();
	}
	
	function getMessages(){
		$query = $this->db->query("SELECT a.message,b.firstname,b.admin_prof_img_url FROM pms_message  a inner join pms_admin_users b on a.created_by=b.admin_id where a.send_to=".$_SESSION['admin_session']);
		return $query->result_array();
	}
	
	function getTasks(){
		$query = $this->db->query("SELECT a.* FROM pms_tasks a inner join pms_task_team b on a.task_id=b.task_id WHERE  a.status = 1 and b.user_id=".$_SESSION['admin_session']);
		return $query->result_array();
	}
	function getTodos(){
		$query = $this->db->query("SELECT a.*,b.* FROM pms_todo a inner join pms_todo_description b on a.todo_id=b.todo_id WHERE  a.user_id=".$_SESSION['admin_session']);
		return $query->result_array();
	}		
}
?>