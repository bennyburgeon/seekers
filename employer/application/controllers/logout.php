<?php
//we need to call PHP's session object to access it through CI
class Logout extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
		unset($_SESSION['company_session']);
		unset($_SESSION['company_username']);
		unset($_SESSION['company_firstname']);
		unset($_SESSION['company_lastname']);
		unset($_SESSION['company_address']);
		unset($_SESSION['company_id']);
		unset($_SESSION['company_name']);			   		
		redirect('login');
 }
}
?>