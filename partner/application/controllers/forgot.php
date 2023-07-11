<?php

class Forgot extends CI_controller {

    function __construct() {
	
        parent::__construct();
    }

    function index() {
		
      //  $this->load->view('include/header');
        $this->load->view('forgot/list');
        $this->load->view('include/footer');
    }

}

?>