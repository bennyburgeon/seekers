<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{ 
		parent::__construct();
		$this->data['cur_page_name']=config_item('page_title').' Admin Login ';
		$this->data['current_page_head']='Admin Login';
		$this->data['errmsg']='';
		$this->data['copy_right']=config_item('copy_right');
	}
	
	public function index()
	{
		if(isset($_SESSION['candidate_session']) && $_SESSION['candidate_session']!='')
		{
			redirect('dashboard');
		}
		
		$this->data['errmsg']='';
		$this->data['job_id']='';


		if($this->input->get('job_id'))
		{
			$this->data['job_id']=$this->input->get('job_id');
		}
		
		if($this->input->post('username') && $this->input->post('password'))
		{
			$query = $this->db->query("SELECT candidate_id, username, password,first_name,last_name from pms_candidate where username='".$this->input->post('username')."' and password='".md5($this->input->post('password'))."'");
			
			if ($query->num_rows() > 0)
			{
			   $row = $query->row_array();
			   $_SESSION['candidate_session']=$row['candidate_id'];
			   $_SESSION['username']=$row['username'];
			   $_SESSION['password']=$row['password'];
			   $_SESSION['candidate_first_name']=$row['first_name'];
			   $_SESSION['candidate_last_name']=$row['last_name'];
			   
			   if($this->input->post('job_id')!='')
			   {
						redirect('home/job_details?job_id='.$this->input->post('job_id'));
			   }else
			   {
					redirect('dashboard');
			   }
			   
			}else
			{
			// $this->data['errmsg']='Invalid username or password';
				$this->data['errmsg']='<p style="margin-top:-11px">Invalid username or password</p>';
			}
		}
		
		$this->load->view('login/list',$this->data);
	}

	function admin()
	{
		$data['admin']= $this->db->query("SELECT * FROM pms_candidate WHERE group_id='0'");
		$this->load->view('include/header',$data);
	}
	
	function categoryChild($id)
	{
		$menu_array=array();
		$menu_array[]= array(	"id" => 1,
				"name"    => 'dashboard',
				"url"=> 'dashboard',
				"module_class" =>    '');

		$menu_array[]= array(	"id" => 1,
				"name"    => 'Profile',
				"url"=> 'dashboard',
				"module_class" =>    '');

		$menu_array[]= array(	"id" => 1,
				"name"    => 'Jobs',
				"url"=> 'dashboard',
				"module_class" =>    '');

		$menu_array[]= array(	"id" => 1,
				"name"    => 'Announcements',
				"url"=> 'dashboard',
				"module_class" =>    '');

		$menu_array[]= array(	"id" => 1,
				"name"    => 'Messages',
				"url"=> 'dashboard',
				"module_class" =>    '');
		return $menu_array;
	}	
}