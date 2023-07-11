<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mobile extends CI_Controller {

	function __construct()
	{
		
	}
	
	function index($offset = 0)
	{
		//$data = array('success' => false, 'username' => 'false', 'mobile' => 'not-checked');	
		echo json_encode($_POST);
	}
}
?>