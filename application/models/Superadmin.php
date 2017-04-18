<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Model{ 

	function __construct(){
	    parent::__construct();
	}

	public function login($data){
		$this->db->select('first_name, last_name, user_id, type');
        $query = $this->db->get_where('users', array('email_id' => $data['email_id'], 'password' => $data['password'], 'type' => 'superadmin'))->row();
		return $query;
	}

	public function addSubAdmin($data){
		return $this->db->insert('users',$data) ? true : false ;
	}

	public function getSuperadmin($id){
        $this->db->select('*');
        $query = $this->db->get_where('users', array('user_id' => $id))->row();
        return $query;
    } 

    public function checkPassword($pass){
   
    	$query = "SELECT CASE WHEN EXISTS
                (
                SELECT * FROM users
                WHERE password=".$this->db->escape($pass)."
                )
                THEN 'TRUE'
                ELSE 'FALSE'
                END 
         AS my_result";
    	$result=$this->db->query($query);  
		$resulting_array=$result->row();
		return $resulting_array->my_result;
    }

    public function changepassword($pass, $id){
    	$data = array(
           'password' => $pass
        );
        $this->db->where('user_id', $id);
        $this->db->update('users', $data);
        return true;
    }

    public function getAllQueries(){
        $query = $this->db->get('contact');
        $data['result'] = $query->result();
        return $data; 
    }
}

?>   