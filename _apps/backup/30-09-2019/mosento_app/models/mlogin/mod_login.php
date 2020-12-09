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

	    function check_login($nik, $password){
	    	$password = $this->security->xss_clean($password);
	    	$datax = array( 'nik' => $nik, 'password' => $this->strEncode($password) );
	    	$query = $this->db->select('a.username, a.nik, a.status, a.nama, a.id_level')
					->from('mos_user a')
					->join('mos_user_level b', 'a.id_level = b.id_level AND b.level_status = 1', 'inner')
					->where($datax)
					->limit(1)
					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row_array(); 
	       	} else { return false; }
	    }

	    function update_last_login($nik, $data) {
	        $this->db->where('nik', $nik);
	        $this->db->update('mos_user', $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }


	}
?>