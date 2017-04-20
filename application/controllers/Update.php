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
	      
		if($this->customer->updateCustomer($_POST, $_GET['id'])){
			echo json_encode(['status' => true, 'message' => "Profile updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function dataplan(){
    	if($this->dataplan->updateDataPlan($_POST, $_GET['id'])){  
			echo json_encode(['status' => true, 'message' => "Data plan updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function changepasswordSuperadmin(){
    	if($this->admin->changepassword($_POST['pass'], $_POST['id'])){  
			echo json_encode(['status' => true, 'message' => "Password updated successfully"]);
		}
		else{
			echo json_encode(['status' => false, 'message' => "Not Updated"]);
		}
    }

    public function changepasswordCustomer(){
    	if($this->customer->changepassword($_POST['pass'], $_POST['id'])){  
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
}