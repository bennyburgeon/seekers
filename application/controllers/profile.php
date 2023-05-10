<?php

class Profile extends CI_controller {

    function __construct() {
	
        parent::__construct();
			  if(!isset($_SESSION['candidate_session']) || $_SESSION['candidate_session']=='')redirect('logout');

    }

    function index() {
		
        $this->load->view('include/header');
        $this->load->view('profile/list');
        $this->load->view('include/footer');
    }

}

?>