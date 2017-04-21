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
            $query = $this->db->get_where('invoice', array('month' => $month, 'invoice_status' => $status, 'year' => $year))->result();
        return $query;
      }

      public function changeStatus($month, $year){
      	$query = 'update invoice set invoice_status = "Active" where CURDATE() > invoice_date and month = '.$month.' and year='.$year.' and payment_status="Pending"';
      	$result = $this->db->query($query);
      	return $result;
      } 
  }
?>