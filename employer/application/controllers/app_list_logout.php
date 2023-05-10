<?php
//we need to call PHP's session object to access it through CI
class App_list_logout extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
		unset($_SESSION['app_list_company_session']);
		unset($_SESSION['app_list_company_username']);
		unset($_SESSION['app_list_company_firstname']);
		unset($_SESSION['app_list_company_lastname']);
		unset($_SESSION['app_list_company_address']);
		unset($_SESSION['app_list_company_id']);
		unset($_SESSION['app_list_company_name']);	
				   		
		redirect('app_list_login');
 }
}
?>