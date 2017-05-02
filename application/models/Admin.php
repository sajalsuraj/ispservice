<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Model{ 

	function __construct(){
	    parent::__construct();
	}

	public function login($data){
		$this->db->select('first_name, last_name, user_id, type, status');
        $query = $this->db->get_where('users', array('email_id' => $data['email_id'], 'password' => $data['password']))->row();
		return $query;
	}

	public function addAdmin($data){
		return $this->db->insert('users',$data) ? true : false ;
	}

    public function addBanner($data){
        return $this->db->insert('banner',$data) ? true : false ;
    }

    public function addEvent($data){
        return $this->db->insert('event',$data) ? true : false ;
    }

    public function getAdminByEmail($email){
        $this->db->select('*');
            $query = $this->db->get_where('users', array('email_id' => $email))->row();
        return $query;
    }

    public function getAllBanners(){
        $query = $this->db->get('banner');
        $data['result'] = $query->result();
        return $data; 
    }

    public function getAllEvents(){
        $query = $this->db->get('event');
        $data['result'] = $query->result();
        return $data; 
    }

	public function getAdmin($id){
        $this->db->select('*');
        $query = $this->db->get_where('users', array('user_id' => $id))->row();
        return $query;
    } 

    public function getEventById($id){
        $this->db->select('*');
        $query = $this->db->get_where('event', array('id' => $id))->row();
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

    public function changeBannerStatus($status, $id){
        $data = array(
           'status' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('banner', $data); 
        return true;
    }

    public function changeEventStatus($status, $id){
        $data = array(
           'status' => $status
        );
        $this->db->where('id', $id);
        $this->db->update('event', $data); 
        return true;
    }

    public function getAllQueries(){
        $query = $this->db->get('contact');
        $data['result'] = $query->result();
        return $data; 
    }

    public function getAllAdmin(){
        $query = $this->db->get('users');
        $data['result'] = $query->result();
        return $data; 
    }

    public function deleteBanner($id){
           $res = $this->db->delete('banner', array('id' => $id)); 
           return $res;
    }

    public function deleteEvent($id){
           $res = $this->db->delete('event', array('id' => $id)); 
           return $res;
    }

    public function deleteAdmin($id){
           $res = $this->db->delete('users', array('user_id' => $id)); 
           return $res;
    }

    public function updateEvent($data, $id){
        $this->db->where('id', $id);
        return $this->db->update('event', $data) ? true : false;
    }

    public function changeAdminStatus($status, $id){
        $data = array(
           'status' => $status
        );
        $this->db->where('user_id', $id);
        $this->db->update('users', $data); 
        return true;
    }

    public function updateAdmin($data, $id){
        $this->db->where('user_id', $id);
        return $this->db->update('users', $data) ? true : false;
    }
}

?>   