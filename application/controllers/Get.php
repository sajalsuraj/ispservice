<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');
class Get extends CI_Controller{

    public function __construct(){
      parent::__construct();
    } 

    public function encrypt($ENTEXT, $key) 
    { 
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, substr(bin2hex($key), -32),
            $ENTEXT, MCRYPT_MODE_ECB, mcrypt_create_iv(
            mcrypt_get_iv_size( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB),
                              MCRYPT_DEV_URANDOM)))); 
    } 

    public function decrypt($DETEXT, $key) 
    {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, substr(bin2hex($key), -32),
           base64_decode($DETEXT), MCRYPT_MODE_ECB, 
           mcrypt_create_iv(mcrypt_get_iv_size( 
                           MCRYPT_RIJNDAEL_256,
                          MCRYPT_MODE_ECB), MCRYPT_DEV_URANDOM))); 
    } 

    public function adminLogin(){   

         $_POST['password'] = md5($_POST['password']);
    	
	     $data = $this->admin->login($_POST);  
	    
	     if($data != NULL){
            if($data->status == "false"){
                echo json_encode(['status' => "disabled", 'message' => 'Unsuccessful Login']);
            }
            else if($data->status == "true"){ 
                $newdata = array(
                    'name'  =>  $data->first_name." ".$data->last_name,
                    'user_id'     => $data->user_id,
                    'type' => $data->type 
                );

                $this->session->set_userdata($newdata);   

                echo json_encode(['status' => true, 'message' => 'Successful Login']);
            }
	     	
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
    	
         $_POST['password'] = md5($_POST['password']);
	     $data = $this->customer->login($_POST);
	    
	     if($data != NULL){
	     	$newdata = array(
			        'customer_name'  =>  $data->first_name." ".$data->last_name,
			        'customer_user_id'     => $data->customer_id,
			        'customer_type' => $data->type
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
    	$data = $this->customer->getOrderByInvoiceId($_POST['id']);
    	echo json_encode(['status'=> true, 'data' => $data]);
    }


    public function getIndividualOrder(){
        $data = $this->customer->getOrderByCustomer($_POST['id']);
        echo json_encode(['status'=> true, 'data' => $data]);
    }

    public function checkSuperadminpass(){
    	$data = $this->admin->checkPassword(md5($_POST['oldpass'])); 
    	echo json_encode(['data' => $data]);
    }

    public function checkCustomerpass(){
    	$data = $this->customer->checkPassword(md5($_POST['oldpass']), $_POST['id']);
    	echo json_encode(['data' => $data]);
    }

    public function recoverpassword(){

        $data = $this->customer->getCustomerByEmail($_POST['email']);
        if($data == NULL){
            echo json_encode(['status'=> false, 'data' => "Email ID doesn't exist!"]); 
        } 
        else{

            $updArr = array();
            $encrypted = $this->encrypt($data->customer_id, ENCRYPTION_KEY);
            $updArr['hashpassword'] = hash('ripemd160', rand(00000000,99999999));
            $updArr['hashexpirationtime'] = date("Y-m-d G:i:s", strtotime('+3 hours'));


            if($this->customer->updateHash($updArr, $data->customer_id)){ 
                $msg = "Greetings from ISP Service. To change your password, please click on this link ".base_url()."changepass?p=".$updArr['hashpassword']."&user=".$encrypted."";

                // use wordwrap() if lines are longer than 70 characters
                $msg = wordwrap($msg,70);

                $headers = "From: noreply@ackanina.com". "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                // send email
                
                $mail = mail($_POST['email'],"Password Recovery - ".$data->first_name." ".$data->last_name,$msg, $headers);
                
                if(!$mail) {   
                     echo "Error";   
                } else {
                    
                    echo json_encode(['status'=> true, 'data' => "A link for password recovery has been sent to this email ID. Please check your email. Thank you"]);
                }
            }
        }
    }

    public function checkExpirationTime(){
  
        $user_id = $this->decrypt($_POST['user'], ENCRYPTION_KEY);
        
       
        $user = $this->admin->checkExpirationTime(date("Y-m-d G:i:s"), $user_id);

        if($user == NULL){
            echo json_encode(['status'=> false, 'data' => "Data doesn't exist"]); 
        }
        else{
            echo json_encode(['status'=> true, 'data' => $user]); 
        }
    }

    public function checkCustomerExpirationTime(){
  
        $user_id = $this->decrypt($_POST['user'], ENCRYPTION_KEY);

       
        $user = $this->customer->checkExpirationTime(date("Y-m-d G:i:s"), $user_id);
        if($user == NULL){
            echo json_encode(['status'=> false, 'data' => "Data doesn't exist"]); 
        }
        else{
            echo json_encode(['status'=> true, 'data' => $user]); 
        }
    }

    public function recoveradminpassword(){

        $data = $this->admin->getAdminByEmail($_POST['email_id']);

        if($data == NULL){
            echo json_encode(['status'=> false, 'data' => "Email ID doesn't exist!"]); 
        } 
        else{

            $updArr = array();
            $encrypted = $this->encrypt($data->user_id, ENCRYPTION_KEY);
            $updArr['hashpassword'] = hash('ripemd160', rand(00000000,99999999));
            $updArr['hashexpirationtime'] = date("Y-m-d G:i:s", strtotime('+3 hours'));


            if($this->admin->updateHash($updArr, $data->user_id)){ 
                $msg = "Greetings from ISP Service. To change your password, please click on this link ".base_url()."admin/changeadminpass?p=".$updArr['hashpassword']."&user=".$encrypted."";

                // use wordwrap() if lines are longer than 70 characters
                $msg = wordwrap($msg,70);

                $headers = "From: noreply@ackanina.com". "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
                // send email
                
                $mail = mail($_POST['email_id'],"Password Recovery - ".$data->first_name." ".$data->last_name,$msg, $headers);
                
                if(!$mail) {   
                     echo "Error";   
                } else {
                    
                    echo json_encode(['status'=> true, 'data' => "A link for password recovery has been sent to this email ID. Please check your email. Thank you"]);
                }
            }
        }
    }

    public function getAllOrders(){
        $data = $this->customer->getAllOrders($_POST['month'], $_POST['year']);
        if(sizeOf($data) > 0){
            echo json_encode(['status'=> true, 'data' => $data]);
        }
        else{
            echo json_encode(['status'=> false, 'data' => ""]);
        }
    }

    public function getInvoices(){
        $data = $this->invoice->getInvoiceByMonth($_POST['month'], $_POST['invoice_status'], $_POST['year']);
        if(sizeOf($data) > 0){
            echo json_encode(['status'=> true, 'data' => $data]);
        }
        else{
            echo json_encode(['status'=> false, 'data' => ""]);
        }
    }

    public function getEventById(){
        $data = $this->admin->getEventById($_POST['id']);
        echo json_encode(['status'=> true, 'data' => $data]);
    }

    public function getAdminById(){
        $data = $this->admin->getAdmin($_POST['id']);
        echo json_encode(['status'=> true, 'data' => $data]);
    }


}