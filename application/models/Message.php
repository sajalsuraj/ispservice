<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Model{

    public function __construct(){
      parent::__construct();
    }

    public function createMessage($data){

        return $this->db->insert('message',$data) ? true : false ;

    }

    public function getMessages($ticketId){
    	$this->db->select('m.message, c.first_name, c.profile_pic, m.sender_type, c1.subject, m.created_at');
        $this->db->from('customer as c, message as m, contact as c1');
        $this->db->where('m.ticket_id = "'.$ticketId.'" and m.ticket_id = c1.id and c1.customer_id = c.customer_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCustomerdetail($ticketId){
    	$this->db->select('t.id, c.first_name, c.last_name, t.subject, t.status');
    	$this->db->from('customer as c, contact as t');
        $this->db->where('t.id = "'.$ticketId.'" and t.customer_id = c.customer_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function changeStatus($ticketId, $status){
          $data = array(
             'status' => $status
          );
          $this->db->where('id', $ticketId);
          $this->db->update('contact', $data);
          return true;
    }
}
?>