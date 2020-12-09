<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_login extends CI_Model {

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function strEncode($password) { 
	        $hasil = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
	        return $hasil;
	    }

	    private static function pregReps($string){ 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number){ 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

	    function check_login($username, $password){
	    	$username = $this->security->xss_clean($this->pregReps($username));
	    	$password = $this->security->xss_clean($password);
	    	$datax = array('username' => $username, 'password' => $this->strEncode($password));
	    	$query = $this->db->select('id_user, id_desa, username, status, fullname')
				->from('users')
				->where($datax)
				->limit(1)
				->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row_array(); 
	       	} else { return false; }
	    }

	    function update_last_login($id_user, $data) {
	    	$datax = array('id_user' => $this->pregRepn($id_user));
	        $this->db->where($datax);
	        $this->db->update('users', $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	}
?>