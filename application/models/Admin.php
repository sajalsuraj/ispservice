<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model{

	function __construct(){
	    parent::__construct();
	}

	public function login($data){
		$this->db->select('first_name, last_name, user_id, type');
        $query = $this->db->get_where('users', array('email_id' => $data['email_id'], 'password' => $data['password'], 'type' => 'subadmin'))->row();
		return $query; 
	}
}

?>   