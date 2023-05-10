<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webcr extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index($offset = 0)
	{
		$data = array('success' => false, 'username' => 'false', 'mobile' => 'not-checked');	
		echo json_encode($data);
		exit();
	}
	
}
?>