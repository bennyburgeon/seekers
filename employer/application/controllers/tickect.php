<?php

class Tickect extends CI_controller {

    function __construct() {
	
        parent::__construct();
			  if(!isset($_SESSION['company_session']) || $_SESSION['company_session']=='')redirect('logout');

    }

    function index() {
		
        $this->load->view('include/header');
        $this->load->view('tickect/list');
        $this->load->view('include/footer');
    }

}

?>