<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_list_login extends CI_Controller {

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

		if(isset($_SESSION['app_list_company_session']) && $_SESSION['app_list_company_session']!='')
		{
			redirect('candidates_list');
			
		}
		$this->data['errmsg']='';

		if($this->input->post('username') && $this->input->post('password'))
		{
			$query = $this->db->query("SELECT a.user_id,a.email, a.username, a.password,a.firstname,a.lastname,a.address,b.company_id,b.company_name from pms_company_users a inner join pms_company b on a.company_id=b.company_id where a.username='".$this->input->post('username')."' and a.password='".md5($this->input->post('password'))."' and a.status=1");
			
			if ($query->num_rows() > 0)
			{
			   $row = $query->row_array();
			   $_SESSION['app_list_company_session']        =$row['user_id'];
			   $_SESSION['app_list_company_username']       =$row['email'];
			   $_SESSION['app_list_company_id']             =$row['company_id'];
			   $_SESSION['app_list_company_name']           =$row['company_name'];
			   $_SESSION['app_list_company_firstname']              =$row['firstname'];
			   $_SESSION['app_list_company_lastname']               =$row['lastname'];
			   $_SESSION['app_list_company_address']                =$row['address'];
			 
			   redirect('candidates_list');
			}else
			{
				$this->data['errmsg']='<p style="margin-top:-11px">Invalid username or password</p>';
			}
		}
		if($this->input->get('ins')==1)
		{
			$this->data['errmsg']='<p style="margin-top:-11px">Registration completed. Please login.</p>';
		}
		$this->load->view('app_list_login/list',$this->data);
	}

}