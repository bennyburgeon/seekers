<?php
//we need to call PHP's session object to access it through CI
class Logout extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
        unset($_SESSION['vendor_session']);
		unset($_SESSION['vendor_username']);
		unset($_SESSION['vendor_usernme']);
		unset($_SESSION['vendor_password']);
		//unset($_SESSION['group_id']);
		unset($_SESSION['vendor_firstname']);
		unset($_SESSION['vendor_lastname']);
		unset($_SESSION['vendor_address']);
		//unset($_SESSION['admin_prof_img_url']);
   redirect('login');
 }
 
}
 
?>