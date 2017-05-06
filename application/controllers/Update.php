<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller{

    public function __construct(){
      parent::__construct();
    } 

    public function customer(){

    		

    	   if(!empty($_FILES["kyc_form"]["name"])){
	    	  if(isset($_FILES["kyc_form"]["name"])) { 
		        $_POST['kyc_form'] = $_FILES["kyc_form"]["name"]; 
		        $folder='./assets/kyc/';
		        $target_file_img = $folder. basename($_FILES["kyc_form"]["name"]);
		        move_uploaded_file($_FILES["kyc_form"]["tmp_name"], $target_file_img);
		      }
		    }

		    if(!empty($_FILES["id_proof"]["name"])){
		      if(isset($_FILES["id_proof"]["name"])) {
		        $_POST['id_proof'] = $_FILES["id_proof"][ "name" ];
		        $folder= './assets/idproof/';
		        $target_file_img = $folder. basename($_FILES["id_proof"]["name"]);
		        move_uploaded_file($_FILES["id_proof"]["tmp_name"], $target_file_img);
		      }
		    }

		    if(!empty($_FILES["address_proof"]["name"])){
		      if(isset($_FILES["address_proof"]["name"])) {
		        $_POST['address_proof'] = $_FILES["address_proof"][ "name" ];
		        $folder= './assets/addressproof/';
		        $target_file_img = $folder. basename($_FILES["address_proof"]["name"]);
		        move_uploaded_file($_FILES["address_proof"]["tmp_name"], $target_file_img);
		      }
		    }

		    if(!empty($_FILES["profile_pic"]["name"])){
		      if (isset($_FILES["profile_pic"]["name"])) {
		        $_POST['profile_pic'] = $_FILES["profile_pic"][ "name" ];
		        $folder= './assets/images/';
		        $target_file_img = $folder. basename($_FILES["profile_pic"]["name"]);
		        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file_img);
		      }
		    }
	    

	    if(empty($_POST['first_name'])){
	        echo json_encode(['status' => false, 'message' => 'first name is empty']);
	    }
	    else if(empty($_POST['last_name'])){
	        echo json_encode(['status' => false, 'message' => 'last name is empty']);
	    }
	    else if(empty($_POST['father_name'])){
	        echo json_encode(['status' => false, 'message' => 'father name is empty']);
	    }
	    else if(empty($_POST['address'])){
	        echo json_encode(['status' => false, 'message' => 'address is empty']);
	    }
	    else if(empty($_POST['city'])){
	        echo json_encode(['status' => false, 'message' => 'city is empty']);
	    }
	    else if(empty($_POST['aadhar_no'])){
	        echo json_encode(['status' => false, 'message' => 'Aadhar no cannot be empty']);
	    }
	    else{
	    	if($this->customer->updateCustomer($_POST, $_GET['id'])){
				echo json_encode(['status' => true, 'message' => "Profile updated successfully"]);
			}
			else{
				echo json_encode(['status' => false, 'message' => "Not Updated"]);
			}
	    }
    }

    public function admin(){

    	 /*var_dump($_POST['tempPass']);
    	 var_dump($_POST['password']);*/
    	 if($_POST['tempPass'] == $_POST['password']){
    	 	unset($_POST['password']);
    	 	unset($_POST['tempPass']);
    	 }
    	 else if($_POST['tempPass'] != $_POST['password']){
    	 	unset($_POST['tempPass']);
    	 	$_POST['password'] = md5($_POST['password']);
    	 }
    	 
    	 if(!empty($_FILES["profile_pic"]["name"])){
		      if (isset($_FILES["profile_pic"]["name"])) {
		        $_POST['profile_pic'] = $_FILES["profile_pic"][ "name" ];
		        $folder= './assets/images/';
		        $target_file_img = $folder. basename($_FILES["profile_pic"]["name"]);
		        move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file_img);
		      }
		  }

		  if($this->admin->updateAdmin($_POST, $_GET['id'])){
			echo json_encode(['status' => true, 'message' => "Admin Details updated successfully"]);
		  }
		  else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		  }

    }

    public function dataplan(){


    	if(empty($_POST['plan_name'])){
	        echo json_encode(['status' => false, 'message' => 'Plan name is empty']);
	    }
	    else if(empty($_POST['price'])){
	        echo json_encode(['status' => false, 'message' => 'Price is empty']);
	    }
	    else if(empty($_POST['validity'])){
	        echo json_encode(['status' => false, 'message' => 'validity is empty']);
	    }
	    else if(empty($_POST['speed'])){
	        echo json_encode(['status' => false, 'message' => 'Speed is empty']);
	    }
	    else{
	    	if($this->dataplan->updateDataPlan($_POST, $_GET['id'])){  
				echo json_encode(['status' => true, 'message' => "Data plan updated successfully"]);
			}
			else{
				echo json_encode(['status' => false, 'message' => "Not Updated"]);
			}
	    }
    	
    }

    public function changepasswordSuperadmin(){  
    	if($this->admin->changepassword(md5($_POST['pass']), $_POST['id'])){  
			echo json_encode(['status' => true, 'message' => "Password updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function changepasswordCustomer(){
    	if($this->customer->changepassword(md5($_POST['pass']), $_POST['id'])){  
			echo json_encode(['status' => true, 'message' => "Password updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function changebannerstatus(){
    	if($this->admin->changeBannerStatus($_POST['status'], $_POST['id'])){  
			echo json_encode(['status' => true, 'message' => "Status updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function changeeventstatus(){
    	if($this->admin->changeEventStatus($_POST['status'], $_POST['id'])){  
			echo json_encode(['status' => true, 'message' => "Status updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function changeadminstatus(){
    	if($this->admin->changeAdminStatus($_POST['status'], $_POST['id'])){  
			echo json_encode(['status' => true, 'message' => "Status updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function invoicestatus(){
    	if($this->invoice->changeStatus($_POST['month'], $_POST['year'])){  
			echo json_encode(['status' => true, 'message' => "Status updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function event(){
    	if($this->admin->updateEvent($_POST, $_GET['id'])){  
			echo json_encode(['status' => true, 'message' => "Event updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function ticket(){
    	if($this->message->changeStatus($_POST['id'], $_POST['status'])){  
			echo json_encode(['status' => true, 'message' => "Ticket closed successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Error"]);
		}
    }
}