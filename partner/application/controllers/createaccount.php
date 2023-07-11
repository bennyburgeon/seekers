<?php

class Createaccount extends CI_controller {

    function __construct() {
	
        parent::__construct();
    }

    function index() {
	
		
      //  $this->load->view('include/header');
        $this->load->view('create_account/list');
        $this->load->view('include/footer');
    }

}

?>