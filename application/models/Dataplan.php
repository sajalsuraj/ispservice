<?php

	class Dataplan extends CI_Model{

		function __construct(){

		  parent::__construct();

		}

		public function getAll(){
		  $query = $this->db->get('data_plan');
		  $data['result'] = $query->result();
		  return $data;
		}

		public function createDataPlan($data){
		  return $this->db->insert('data_plan',$data) ? true : false ;
		}

		public function updateDataPlan($data, $id){
		  $this->db->where('id', $id);
          return $this->db->update('data_plan', $data) ? true : false;
		}

		public function deleteDataplan($id){
	       $res = $this->db->delete('data_plan', array('id' => $id)); 
	       return $res;
	    }

		public function getPlanById($id){
	        $this->db->select('*');
	        $query = $this->db->get_where('data_plan', array('id' => $id))->row();
	        return $query;
	    }
	}
?>
