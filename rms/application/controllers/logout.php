<?php
//we need to call PHP's session object to access it through CI
class Logout extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
        unset($_SESSION['admin_session']);
		unset($_SESSION['admin_username']);
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['group_id']);
		unset($_SESSION['firstname']);
		unset($_SESSION['lastname']);
		unset($_SESSION['address']);
		unset($_SESSION['admin_prof_img_url']);
   redirect('login');
 }
 
}
 
?>