<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Customer extends CI_Model{

      function __construct(){
        parent::__construct();
      }
      public function getAll(){

        $query = $this->db->get('customer');
        $data['result'] = $query->result();
        return $data; 

      }

      public function getListforExcel(){
        $query = $this->db->get('customer');
        return $query->result_array();
      }
 
      public function login($data){
        $this->db->select('first_name,last_name,customer_id, type');
            $query = $this->db->get_where('customer', array('email' => $data['email'], 'password' => $data['password'], 'type' => 'customer'))->row();
        return $query;
      }

      public function createCustomer($data){
        return $this->db->insert('customer',$data) ? true : false ;
      }

      public function contactUs($data){
        return $this->db->insert('contact',$data) ? true : false ;
      }

      public function updateCustomer($data,$customer_id){
        $this->db->where('customer_id', $customer_id);
        return $this->db->update('customer', $data) ? true : false;
      }

      public function deleteCustomer($id){
         $res = $this->db->delete('customer', array('customer_id' => $id)); 
         return $res;
      }

      public function getCustomerById($id){
        $this->db->select('*');
            $query = $this->db->get_where('customer', array('customer_id' => $id))->row();
        return $query;
      }

      public function getOrders(){
        $this->db->select('*');
        $this->db->from('orders as o, customer as c');
        $this->db->where('o.circuit_id = c.customer_id');

        $query = $this->db->get();
        return $query->result();
      }

      public function getAllOrders(){
        $query = $this->db->get('orders');
        $data['result'] = $query->result();
        return $data; 
      }

      public function getOrderById($id){ 
        $this->db->select('*');
        $this->db->from('orders as o, customer as c');
        $this->db->where('o.circuit_id = c.customer_id and o.order_no="'.$id.'"');

        $query = $this->db->get()->row();
        return $query;
      }

      public function checkPassword($pass, $id){
   
        $query = "SELECT CASE WHEN EXISTS
                (
                SELECT * FROM customer
                WHERE customer_id=".$this->db->escape($id)." and password=".$this->db->escape($pass)."
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
          $this->db->where('customer_id', $id);
          $this->db->update('customer', $data);
          return true;
      }
  }

?>
