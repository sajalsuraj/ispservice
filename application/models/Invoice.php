<?php
defined('BASEPATH') OR exit('No direct script access allowed');

  class Invoice extends CI_Model{

      function __construct(){
        parent::__construct();
      }

      public function createInvoice($data){
		  return $this->db->insert('invoice',$data) ? true : false ; 
      }

      public function getInvoiceByMonth($month, $status, $year){
        $this->db->select('*');
         $this->db->from('invoice as o, customer as c');
        $this->db->where('o.circuit_id = c.customer_id and o.month="'.$month.'" and o.year="'.$year.'" and   o.invoice_status="'.$status.'"');
        $query = $this->db->get();
        return $query->result();
            
      }

      public function changeStatus($month, $year){
      	$query = 'update invoice set invoice_status = "Active" where CURDATE() > invoice_date and month = '.$month.' and year='.$year.' and payment_status="Pending"';
      	$result = $this->db->query($query);
      	return $result;
      } 

  }
?>