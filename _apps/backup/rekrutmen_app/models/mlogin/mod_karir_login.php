<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_karir_login extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function strEncode($password) {
	        $hasil = md5(base64_encode(hash("sha256", md5(sha1(md5($password))), TRUE))); 
	        return $hasil;
	    }

	    function checkLogin($username, $password) {
			$user  = substr($username, 0, 20);
			$pass  = substr($password, 0, 50);
			$query = $this->db->select('people_id,username,password,active')
					->from('people')
					->where('username', $user)
					->where('password', $this->strEncode($pass))
					->limit(1)
					->get();
	        if ($query->num_rows() == 1) {
	            return $query->row_array();
	        } else { return false; } 
	    }

	    function changeStatusLogin($people_id, $data) {
	    	$datax = array('people_id' => $people_id);
	        $this->db->where($datax);
	        $this->db->update('people', $data);
	    }

	    function updateLastLogin($username, $data) {
	    	$datax = array('username' => $username);
	        $this->db->where($datax);
	        $this->db->update('people', $data);
	    }
	}
?>

