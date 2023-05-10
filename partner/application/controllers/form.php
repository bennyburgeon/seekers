<?php

class Form extends CI_controller {

    function __construct() {
	
        parent::__construct();
    }

    function index() {
			  if(!isset($_SESSION['vendor_session']) || $_SESSION['vendor_session']=='')redirect('logout');

        $this->load->view('include/header');
        $this->load->view('form/list');
        $this->load->view('include/footer');
    }

}

?>