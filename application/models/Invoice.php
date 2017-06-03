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

        $query = 'update invoice set service_tax = (service_tax+(0.14*base_amount)), sbc = (sbc + (0.005 * base_amount)), kkc = (kkc + (0.005 * base_amount)), base_amount = (base_amount+base_amount), total_amount = (total_amount + (base_amount + service_tax + sbc + kkc)), invoice_date = DATE_ADD(invoice_date,INTERVAL 30 DAY), next_payment_date = DATE_ADD(next_payment_date,INTERVAL 30 DAY), invoice_status = "Active", month = "'.$month.'", year = "'.$year.'" where payment_status = "Pending" and CURDATE() > invoice_date';
      	
      	$result = $this->db->query($query);
      	return $result;
      } 

      public function changepaymentstatus($customer_id){
        $query = 'update invoice set payment_status = "Paid", invoice_status = "Deactive" where circuit_id = "'.$customer_id.'" and payment_status = "Pending"';

        $result = $this->db->query($query);
        return $result;
      }

      public function addneworder($data){
        return $this->db->insert('orders', $data) ? true : false ; 
      }

  }
?>