<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_setting extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function strEncode($password) {
	        $result = md5(base64_encode(hash("sha256", md5(sha1(md5($password))), TRUE))); 
	        return $result;
	    }

		function checkOldPassword($people_id,$password_old){
	    	$query = $this->db->select('password')
	    					->from('people')
	    					->where('people_id', $people_id)
	    					->where('password', $this->strEncode($password_old))
	    					->get();
	    	if($query->num_rows() > 0 ) {
	            return true; 
	       	} else { return false; }
		}

		function change_password($people_id, $data){
			$datax = array(
				'people_id' => $people_id,
			);
			$this->db->where($datax);
	    	$this->db->update('people', $data);
	    	return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function getPhone_number($people_id){
			$query = $this->db->select('people_mobile')
				->from('people')
				->where('people_id', $people_id)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function getEmail_akun($people_id){
			$query = $this->db->select('people_email, username, last_ip, people_update_date')
				->from('people')
				->where('people_id', $people_id)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

	}
?>