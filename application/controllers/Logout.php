<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{

    public function __construct(){
      parent::__construct();
    }

    function logout(){
    	if($this->session->userdata('type') == "customer"){
    		$this->session->sess_destroy();
    		redirect('customer/login');
    	}
    	else if($this->session->userdata('type') == "superadmin" || $this->session->userdata('type') == "subadmin"){
    		$this->session->sess_destroy();
    		redirect('admin/login');
    	}

    }
}