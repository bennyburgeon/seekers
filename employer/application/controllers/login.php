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

		if(isset($_SESSION['company_session']) && $_SESSION['company_session']!='')
		{
			redirect('dashboard');
			//redirect('recent_apps');
		}
		$this->data['errmsg']='';
        
        $this->load->model('payment_processmodel');
        $this->data["list_packages"] = $this->payment_processmodel->list_packages();

		if($this->input->post('username') && $this->input->post('password'))
		{
			$query = $this->db->query("SELECT a.user_id,a.email, a.username, a.password,a.firstname,a.lastname,a.address, a.payment_status, b.company_id,b.company_name, b.contact_name, b.contact_email, b.contact_phone, a.package,c.package_exp_date, c.emp_package_status, c.emp_credit_id from pms_company_users a inner join pms_company b on a.company_id=b.company_id left join pms_employer_credits c on c.user_id=a.user_id where a.username='".$this->input->post('username')."' and a.password='".md5($this->input->post('password'))."' and a.status=1");
			
			//echo "SELECT a.user_id,a.email, a.username, a.password,a.firstname,a.lastname,a.address, a.payment_status, b.company_id,b.company_name, b.contact_name, b.contact_email, b.contact_phone, a.package,c.package_exp_date, c.emp_package_status, c.emp_credit_id from pms_company_users a inner join pms_company b on a.company_id=b.company_id left join pms_employer_credits c on c.user_id=a.user_id where a.username='".$this->input->post('username')."' and a.password='".md5($this->input->post('password'))."' and a.status=1";
			
			//print_r($_POST);
			//exit();
			if ($query->num_rows() > 0)
			{
			 $row = $query->row_array();
			
			//print_r($row);
			//exit();	
					  
					   $_SESSION['company_session']       		   =$row['user_id'];
					   $_SESSION['company_username']       		   =$row['email'];
					   $_SESSION['company_id']             		   =$row['company_id'];
					   $_SESSION['company_name']           		   =$row['company_name'];
					   $_SESSION['company_firstname']              =$row['firstname'];
					   $_SESSION['company_lastname']               =$row['lastname'];
					   $_SESSION['company_address']                =$row['address'];
					   $_SESSION['user_id']     				   =$row['user_id'];
					   $_SESSION['contact_name']				   =$row['contact_name'];
					   $_SESSION['contact_email']				   =$row['contact_email'];
					   $_SESSION['contact_phone']				   =$row['contact_phone'];
					   $_SESSION['package']      				   =$row['package'];
					   $_SESSION['username']   					   =$row['username'];
					   $_SESSION['password']  					   =$row['password'];
					   $_SESSION['company_id']  				   =$row['company_id'];
					   
					   redirect('dashboard');
				  	   
			}  else
			{
				$this->data['errmsg']='<p style="margin-top:-11px">Invalid username or password</p>';
			}
		} 
		if($this->input->get('ins')==1)
		{
			$this->data['errmsg']='<p style="margin-top:-11px">Registration completed. Please login.</p>';
		}
		
		
		$this->load->view('login/list',$this->data);
	}

}