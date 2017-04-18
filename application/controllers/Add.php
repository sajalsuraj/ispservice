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

      $_POST['kyc_form'] = $_FILES["kyc_form"][ "name" ];
      $folder= base_url().'assets/kyc/';
      $target_file_img = $folder. basename($_FILES["kyc_form"]["name"]);
      move_uploaded_file($_FILES["kyc_form"]["tmp_name"], $target_file_img);

      $_POST['id_proof'] = $_FILES["id_proof"][ "name" ];
      $folder= base_url().'assets/idproof/';
      $target_file_img = $folder. basename($_FILES["id_proof"]["name"]);
      move_uploaded_file($_FILES["id_proof"]["tmp_name"], $target_file_img);

      $_POST['address_proof'] = $_FILES["address_proof"][ "name" ];
      $folder= base_url().'assets/addressproof/';
      $target_file_img = $folder. basename($_FILES["address_proof"]["name"]);
      move_uploaded_file($_FILES["address_proof"]["tmp_name"], $target_file_img);
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
         echo json_encode(['status' => true, 'message' => 'Customer added']);
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

         $_POST['password'] = rand(00000000,99999999);
         $_POST['type'] = "subadmin";
         $_POST['user_id'] = rand(00000000,99999999);
         $data = $this->superadmin->addSubAdmin($_POST);
      
         
         if($data){
            echo json_encode(['status' => true, 'message' => 'User added']);
         }
         else{
            echo json_encode(['status' => false, 'message' => 'User not added']);
         }
    }

    public function createQuery(){

        $_POST['customer_id'] = $this->session->userdata('user_id');
        $_POST['name'] = $this->session->userdata('name'); 

        $data = $this->customer->contactUs($_POST);
      
         if($data){
            echo json_encode(['status' => true, 'message' => 'Query created']);
         }
         else{
            echo json_encode(['status' => false, 'message' => 'Query not created']);
         }
    }
}


 ?>