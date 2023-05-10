<?php 
class Payment_processmodel extends CI_Model {
	
	function __construct()
    {
		$this->admin_table = "pms_admin_users";
    }
	
	function add_package()
    {
		
		$package_amount=0;
		$package_exp_date='';
		$amount_per_job=0;
		
		if($this->input->post('package_id')==1) {
		   $package_exp_date     = date('Y-m-d', strtotime("+30 days"));
		   $package_amount		 = '300';
		   $amount_per_job		 = '300';
	   } 
		 else if($this->input->post('package_id')==2) {
		   $package_exp_date     = date('Y-m-d', strtotime("+90 days"));
		   $package_amount		 = '1250';
		   $amount_per_job		 = '250';
	   } 
		 else if($this->input->post('package_id')==3) {
		   $package_exp_date     = date('Y-m-d', strtotime("+180 days"));
		   $package_amount		 = '2250';
		   $amount_per_job		 = '225';
	   } 
		 else if($this->input->post('package_id')==4) {
		   $package_exp_date     = date('Y-m-d', strtotime("+360 days"));
		   $package_amount		 = '5000';
		   $amount_per_job		 = '200';
	    } 
		 else if($this->input->post('package_id')==5) {
		   $package_exp_date     = date('Y-m-d', strtotime("+360 days"));
		   $package_amount		 = '5000';
		   $amount_per_job		 = '200';
	    } 
		 else if($this->input->post('package_id')==6) {
		   $package_exp_date     = date('Y-m-d', strtotime("+360 days"));
		   $package_amount		 = '5000';
		   $amount_per_job		 = '200';
	    } 
		 else if($this->input->post('package_id')==7) {
		   $package_exp_date     = date('Y-m-d', strtotime("+360 days"));
		   $package_amount		 = '5000';
		   $amount_per_job		 = '200';
	   }  
	   
	    
		$company_id = $_SESSION['company_id'];
		$user_id    = $_SESSION['user_id'];
		$data =	array(
			'company_id'	 		   => $company_id,
			'user_id'   	 		   => $user_id,
			'package_id'  	 		   => $this->input->post('package_id'),
			'package_amount' 		   => $package_amount,
			'package_start_date'       => date('Y-m-d'),
			'package_exp_date'         => $package_exp_date,
			'amount_per_job'           => $amount_per_job,
			'emp_package_status'       => 0,			
			);
//print_r($data); exit();
		$this->db->where('emp_package_status',0);
		$this->db->where('company_id',$company_id);
		$this->db->delete('pms_employer_credits');
        $this->db->insert('pms_employer_credits', $data);
		$id = $this->db->insert_id();
		
		return $id;
    }
	
	function list_packages()
    {

        $query=$this->db->query("select * from pms_employer_ad_packages where package_status=1");
		return $query->result_array();
	}
	
	
	function selected_packages()
    {

        $query=$this->db->query("select a.*,b.package_name,b.total_job_ads,c.payment_status,a.emp_package_status from pms_employer_credits a inner join pms_employer_ad_packages b on a.package_id=b.package_id left join pms_company_users c on c.company_id=a.company_id where a.emp_package_status=1 and a.company_id=".$_SESSION['company_id']." order by a.emp_credit_id desc limit 0,1");
		return $query->result_array();
	}
	
	function select_payd_packages()
    {

        $query=$this->db->query("select a.*,b.package_name,b.total_job_ads,c.payment_status from pms_employer_credits a inner join pms_employer_ad_packages b on a.package_id=b.package_id left join pms_company_users c on c.company_id=a.company_id where a.emp_package_status=0 and a.company_id=".$_SESSION['company_id']);
		return $query->result_array();
	}
	
	
	function payment_summary()
    {
		//print_r($_POST); exit();
			
					
		$company_id = $_SESSION['company_id'];
		$user_id    = $_SESSION['user_id'];
		$data =	array(
		'company_id'   => $company_id,
		'fname'        => $this->input->post('firstname'),
		'email'        => $this->input->post('email'),
		'mobile'       => $this->input->post('phone'),
		'txnid'        => $this->input->post('txnid'),
		'amount'       => $this->input->post('amount'),
		'date'         => date("Y-m-d h:i:s A"),
		'status'       => 1,
		'username'     => $_SESSION['username'],
		);
//print_r($data); exit();
        $this->db->insert('pms_payment_summary', $data);
		$id = $this->db->insert_id();
		
		$datas =	array(
		'payment_status'       => 1,
		
		);
		$this->db->where('company_id', $company_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('pms_company_users', $datas);
		
		$datas =	array(
		'emp_package_status'       => 1,
		
		);
		$this->db->where('emp_package_status',0);
		$this->db->where('company_id',$company_id);
        $this->db->update('pms_employer_credits', $datas);
		
			return $id;
    }
	
	function invoice_list($id)
    {

        $query=$this->db->query("select * from pms_payment_summary where payment_id=".$id);
		return $query->row_array();
	}
	
	function user_details($id)
    {

        $query=$this->db->query("select * from pms_company where company_id=".$id);
		//return $query->result_array();
		return $query->row_array();
	}
	
	function ckeck_packages()
	{
		$query=$this->db->query("select a.emp_package_status,b.payment_status from pms_employer_credits a left join pms_company_users b on a.user_id=b.user_id where b.user_id=".$_SESSION['company_session']." order by a.emp_credit_id desc limit 0,1");

	  return $query->row_array();
	}
	
	
}
