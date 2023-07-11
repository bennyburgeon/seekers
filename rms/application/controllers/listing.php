<?php

class Listing extends CI_controller {

    function __construct() {
	
        parent::__construct();
    }

    function index() {
			  if(!isset($_SESSION['admin_session']) || $_SESSION['admin_session']=='')redirect('logout');

        $this->load->view('include/header');
        $this->load->view('listing/list');
        $this->load->view('include/footer');
    }

}

?>