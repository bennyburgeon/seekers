<?php
//we need to call PHP's session object to access it through CI
class Logout extends CI_Controller {
 
 function __construct()
 {
   parent::__construct();
 }
 
 function index()
 {
        unset($_SESSION['candidate_session']);
		unset($_SESSION['username']);
		unset($_SESSION['username']);
		unset($_SESSION['password']);
		unset($_SESSION['group_id']);
		unset($_SESSION['candidate_first_name']);
		unset($_SESSION['candidate_last_name']);
		unset($_SESSION['address']);
   redirect('home');
 }
 
}
 
?>