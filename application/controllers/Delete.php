<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller{

    public function __construct(){
      parent::__construct();
    }

    public function deleteDataplan(){ 

    	if($this->dataplan->deleteDataplan($_POST['id'])){
    		echo json_encode(['status' => true, 'message' => 'Plan details deleted successfully']);
    	}
    	else{
    		echo json_encode(['status' => false, 'message' => 'Unable to delete']);
    	}

    } 

    public function deleteCustomer(){

    	if($this->customer->deleteCustomer($_POST['id'])){
    		echo json_encode(['status' => true, 'message' => 'Customer details deleted successfully']);
    	}
    	else{
    		echo json_encode(['status' => false, 'message' => 'Unable to delete']);
    	}

    } 

    public function deleteBanner(){

        if($this->admin->deleteBanner($_POST['id'])){
            echo json_encode(['status' => true, 'message' => 'Banner deleted successfully']);
        }
        else{
            echo json_encode(['status' => false, 'message' => 'Unable to delete']);
        }

    } 
}