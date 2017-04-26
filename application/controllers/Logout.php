<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller{

    public function __construct(){
      parent::__construct();
    }

    public function logout(){
    	
    	if($this->session->userdata('type') == "superadmin" || $this->session->admin_userdata('type') == "subadmin"){
    		$this->session->unset_userdata('type');
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('user_id');
    		redirect('admin/login');
    	}

    }

    public function customerlogout(){
        
            $this->session->unset_userdata('customer_type');
            $this->session->unset_userdata('customer_name');
            $this->session->unset_userdata('customer_user_id');
            redirect('login'); 
        
    }
}