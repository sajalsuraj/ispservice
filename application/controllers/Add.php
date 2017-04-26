<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller{

    public function __construct(){
      parent::__construct();
    }


    public function addCustomer(){ 

      
      $_POST['password'] = rand(00000000,99999999);
      $_POST['customer_id'] = rand(00000000,99999999);
      $_POST['status'] = "Active";
      $_POST['doj'] = date('Y-m-d');
      if (isset($_FILES["kyc_form"]["name"])) {
        $_POST['kyc_form'] = $_FILES["kyc_form"]["name"];
        $folder='./assets/kyc/';
        $target_file_img = $folder. basename($_FILES["kyc_form"]["name"]);
        move_uploaded_file($_FILES["kyc_form"]["tmp_name"], $target_file_img);
      }
      if (isset($_FILES["id_proof"]["name"])) {
        $_POST['id_proof'] = $_FILES["id_proof"][ "name" ];
        $folder= './assets/idproof/';
        $target_file_img = $folder. basename($_FILES["id_proof"]["name"]);
        move_uploaded_file($_FILES["id_proof"]["tmp_name"], $target_file_img);
      }
      if (isset($_FILES["address_proof"]["name"])) {
        $_POST['address_proof'] = $_FILES["address_proof"][ "name" ];
        $folder= './assets/addressproof/';
        $target_file_img = $folder. basename($_FILES["address_proof"]["name"]);
        move_uploaded_file($_FILES["address_proof"]["tmp_name"], $target_file_img);
      }

      if (isset($_FILES["profile_pic"]["name"])) {
        $_POST['profile_pic'] = $_FILES["profile_pic"][ "name" ];
        $folder= './assets/images/';
        $target_file_img = $folder. basename($_FILES["profile_pic"]["name"]);
        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file_img);
      }
      /*$data = array(

        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'address' => $this->input->post('address'),
        'city' => $this->input->post('city'),
        'state' => $this->input->post('state'),
        'pincode' => $this->input->post('pincode'),
        'email' => $this->input->post('email'),
        'phone' => $this->input->post('phone'),
        'connectivity_type' => $this->input->post('connectivity_type'),
        'ip_type' => $this->input->post('ip_type'),
        'ip_details' => $this->input->post('ip_details'),
        'login_id' => $this->input->post('login_id'),
        'data_plan' => $this->input->post('data_plan'),
        'billing_cycle' => $this->input->post('billing_cycle'),
        'billing_mode' => $this->input->post('billing_mode'),
        'eq_mode' => $this->input->post('eq_mode'),
        'eq_serial' => $this->input->post('eq_serial'),
        'eq_mac' => $this->input->post('eq_mac'),
        'eq_manufacture' => $this->input->post('eq_manufacture'),
        'kyc_form' => $this->input->post('kyc_form'),
        'id_proof' => $this->input->post('id_proof'),
        'address_proof' => $this->input->post('address_proof'),
        'password' => $password,
        'customer_id' => $customer_id

      );*/
     
      if($this->customer->createCustomer($_POST)){

         $data = array();
         $plan = $this->dataplan->getPlanByName($_POST['data_plan']);
         $data['invoice_no'] = "BC/".date('Y')."/".date('m')."/".rand(0000,9999);
         $data['circuit_id'] = $_POST['customer_id'];
         $date = date('Y-m-d');
         $data['month'] = date('m');
         $data['year'] = date('Y');
         $data['next_payment_date'] = date('Y-m-d', strtotime('+1 month', strtotime($date)));
         $data['invoice_date'] = date('Y-m-d', strtotime('-5 days', strtotime($data['next_payment_date'])));
         $data['order_no'] = "ISP/".$data['invoice_date']."/".$_POST['customer_id']."/".rand(0000,9999);
         $data['base_amount'] = $plan->price;
         $data['service_tax'] = 0.14 * intval($data['base_amount']);
         $data['sbc'] = 0.005 * intval($data['base_amount']);
         $data['kkc'] = 0.005 * intval($data['base_amount']);
         $data['total_amount'] = intval($data['base_amount']) + intval($data['service_tax']) + intval($data['sbc']) + intval($data['kkc']);
         $data['payment_status'] = "Pending";
         $data['invoice_status'] = "Deactive";

         if($this->invoice->createInvoice($data)){
            echo json_encode(['status' => true, 'message' => 'Customer added']);
         }
      }
      else{
        echo json_encode(['status' => false, 'message' => 'Customer not added']);
      }

    }

    public function addDataPlan(){

        $data = $this->dataplan->createDataPlan($_POST);
      
         if($data){
            echo json_encode(['status' => true, 'message' => 'DataPlan added']);
         }
         else{
            echo json_encode(['status' => false, 'message' => 'DataPlan not added']);
         }
    }

    public function addAdmin(){

        if (isset($_FILES["profile_pic"]["name"])) {
            $_POST['profile_pic'] = $_FILES["profile_pic"][ "name" ];
            $folder= './assets/images/';
            $target_file_img = $folder. basename($_FILES["profile_pic"]["name"]);
            move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file_img);
        }

         $_POST['status'] = "true";
         $_POST['user_id'] = rand(00000000,99999999);

         $data = $this->admin->addAdmin($_POST);
      
         
         if($data){
            echo json_encode(['status' => true, 'message' => 'User added']);
         }
         else{
            echo json_encode(['status' => false, 'message' => 'User not added']);
         }
    }

    public function createQuery(){

        $_POST['customer_id'] = $this->session->userdata('customer_user_id');
        $_POST['name'] = $this->session->userdata('customer_name'); 

        $data = $this->customer->createTicket($_POST);
      
         if($data){
            echo json_encode(['status' => true, 'message' => 'Ticket created']);
         }
         else{
            echo json_encode(['status' => false, 'message' => 'Ticket not created']);
         }
    }

    public function createMessage(){
        $data = $this->message->createMessage($_POST);
      
         if($data){
            echo json_encode(['status' => true]);
         }
         else{
            echo json_encode(['status' => false]);
         }
    }

    public function addBanner(){

        $_POST['status'] = "true";
        $_POST['banner_img'] = $_FILES["banner_img"][ "name" ];
         $folder= './assets/resources/images/slider/';
         $target_file_img = $folder. basename($_FILES["banner_img"]["name"]);
         move_uploaded_file($_FILES["banner_img"]["tmp_name"], $target_file_img);

        $data = $this->admin->addBanner($_POST);
      
         if($data){
            echo json_encode(['status' => true, 'message' => 'Banner Uploaded']);
         }
         else{
            echo json_encode(['status' => false, 'message' => 'Error while uploading']);
         }
    }

    public function addEvent(){

        $_POST['status'] = "true";
        $data = $this->admin->addEvent($_POST);
      
         if($data){
            echo json_encode(['status' => true, 'message' => 'Event Added']);
         }
         else{
            echo json_encode(['status' => false, 'message' => 'Error while adding']);
         }
    }
}


 ?>