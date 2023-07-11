<?php
class Payment_process extends CI_controller
 {
	
     function __construct()
	 {
        parent::__construct();
	  if(!isset($_SESSION['company_session']) || $_SESSION['company_session']=='')redirect('logout');
		$this->data['cur_page']=$this->router->class;
		$this->load->model('payment_processmodel');
     }

     function index()
	 {		 
	 	$this->load->model('payment_processmodel');
		$this->data["list_packages"] = $this->payment_processmodel->list_packages();
		$this->data["selected_packages"] = $this->payment_processmodel->selected_packages();
		$this->data["packages"] = $this->payment_processmodel->select_payd_packages();
			
		$this->load->view('include/header', $this->data);
		$this->load->view('payment_process/success', $this->data);
		$this->load->view('include/footer', $this->data);
          
     }
	 
	 function add_package()
	{   
		$ckeck_packages = array();
		$this->data['errmsg']='';
		$this->load->model('payment_processmodel');
		$ckeck_packages = $this->payment_processmodel->ckeck_packages();	
         if(isset($ckeck_packages['emp_package_status']) && isset($ckeck_packages['payment_status']))
         {
		if($ckeck_packages['emp_package_status']==1 && $ckeck_packages['payment_status']==1)
				  
			{
				redirect('payment_process/?error=1');
			} 
         }
			
		$id=$this->payment_processmodel->add_package();
		redirect('payment_process');
			
	}
	
	function cancel()
	{
		
		$this->db->where('emp_package_status',0);
		$this->db->where('company_id',$_SESSION['company_id']);
		$this->db->delete('pms_employer_credits');
		redirect('payment_process');
						
	}
	
	
	function payment_summary()
	{
		
		$this->load->model('payment_processmodel');
		$this->data['errmsg']='';
		$id=$this->payment_processmodel->payment_summary();
		$_SESSION['payment_id']=$id;
		
		//redirect('login/?ins=1');
		redirect('payment_process/invoice');
						
	}
	
	function invoice()
	{
		if(isset($_SESSION['payment_id']))
		{
		$this->data['errmsg']='';
		$id = $_SESSION['payment_id'];
		
		$this->data["invoice"] = $this->payment_processmodel->invoice_list($id);
		$id=$this->data["invoice"]["company_id"];
		$this->data["user_details"] = $this->payment_processmodel->user_details($id);
		
		//$this->load->view('payment/header',$this->data);
		$this->load->view('payment_process/invoice',$this->data);
		//$this->load->view('payment/footer',$this->data);
		}
		else{
		redirect('payment_process');
		}
	}
	
			
	}