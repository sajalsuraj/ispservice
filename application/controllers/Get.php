<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get extends CI_Controller{

    public function __construct(){
      parent::__construct();
    } 

    
    public function adminLogin(){
    	
	     $data = $this->admin->login($_POST);
	    
	     if($data != NULL){
	     	$newdata = array(
			        'name'  =>  $data->first_name." ".$data->last_name,
			        'user_id'     => $data->user_id,
			        'type' => $data->type 
			);

			$this->session->set_userdata($newdata);

			echo json_encode(['status' => true, 'message' => 'Successful Login']);
	     }
	     else{
	     	echo json_encode(['status' => false, 'message' => 'Unsuccessful Login']);
	     }
    }//end-function

    public function getAllDataPlans(){

    	$data = $this->dataplan->getAll();

    	if($data != NULL){
    		echo json_encode($data);
    	}
    	else{
    		echo json_encode($data);
    	}
    }//end function
  
    public function getAllBanners(){

        $data = $this->admin->getAll();

        if($data != NULL){
            echo json_encode($data);
        }
        else{
            echo json_encode($data);
        }
    }//end function

    public function customerLogin(){
    	
	     $data = $this->customer->login($_POST);
	    
	     if($data != NULL){
	     	$newdata = array(
			        'name'  =>  $data->first_name." ".$data->last_name,
			        'user_id'     => $data->customer_id,
			        'type' => $data->type
			);

			$this->session->set_userdata($newdata);

			echo json_encode(['status' => true, 'message' => 'Successful Login']);
	     }
	     else{
	     	echo json_encode(['status' => false, 'message' => 'Unsuccessful Login']);
	     }  	
    }//end function

    public function getCustomerDetails(){
    	$data = $this->customer->getCustomerById($_POST['id']);
    	echo json_encode(['status'=> true, 'data' => $data]); 
    } 

    public function getDataplan(){
    	$data = $this->dataplan->getPlanById($_POST['id']);
    	echo json_encode(['status'=> true, 'data' => $data]);
    }

    public function getorder(){
    	$data = $this->customer->getOrderById($_POST['id']);
    	echo json_encode(['status'=> true, 'data' => $data]);
    }

    public function checkSuperadminpass(){
    	$data = $this->superadmin->checkPassword($_POST['oldpass']);
    	echo json_encode(['data' => $data]);
    }

    public function checkCustomerpass(){
    	$data = $this->customer->checkPassword($_POST['oldpass'], $_POST['id']);
    	echo json_encode(['data' => $data]);
    }

    public function recoverpassword(){

        $data = $this->customer->getCustomerByEmail($_POST['email']);

        if($data == NULL){
            echo json_encode(['status'=> false, 'data' => "Email ID doesn't exist!"]); 
        }
        else{
            var_dump($data);
            $msg = "Greetings from ISP Service. Your password is ".$data->password;

            // use wordwrap() if lines are longer than 70 characters
            $msg = wordwrap($msg,70);

            $headers = "From: sajal.suraj@suved.co". "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
            // send email
            mail($data->email,"Password Recovery - ".$data->first_name." ".$data->last_name,$msg, $headers);

        }

    }

}