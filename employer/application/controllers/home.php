<?php
//we need to call PHP's session object to access it through CI
class Home extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
   if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');
     $this->data['username'] = $session_data['username'];
	 $_SESSION['name']=$this->data['username'];
	 $_SESSION['logged_admin_id'] = $session_data['admin_id'];
	 $_SESSION['company_session'] = $session_data['admin_id'];
	 $_SESSION['admin_mail'] = $session_data['email'];
	 redirect('dashboard', 'refresh');
   }
   else
   {
     //If no session, redirect to login page
	  
     redirect('login', 'refresh');
   }
   if($this->session->userdata('logged_in_user'))
   {
     $session_data1 = $this->session->userdata('logged_in_user');
     //$this->data['username'] = $session_data['username'];
	 //$_SESSION['name']=$this->data['username'];
	 //$_SESSION['logged_admin_id'] = $session_data['admin_id'];
	 //$_SESSION['company_session'] = $session_data['admin_id'];
	 $_SESSION['admin_mail'] = $session_data['email'];
	 //redirect('dashboard', 'refresh');
   }
   else
   {
     //If no session, redirect to login page
	  
     redirect('login', 'refresh');
   }
 }
 
 function logout()
 {
   $this->session->unset_userdata('logged_in');
   //$this->session->unset_userdata('logged_in_user');
   session_destroy();
   redirect('home', 'refresh');
 }
 
}
 
?>