<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_login extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function strEncode($password){ 
	        return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
	    }

	    function check_login($nik, $password){
	    	$password = $this->security->xss_clean($password);
	    	$datax = array( 'a.nik' => $nik, 'a.password' => $this->strEncode($password) );
	    	$query = $this->db->select('a.id_user, a.nik, a.status_active, a.fullname, a.id_level, b.name as level_name')
				->from('mos_user a')
				->join('mos_user_level b', 'a.id_level = b.id_level AND b.status_active = 1', 'inner')
				->where($datax)
				->limit(1)
				->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row_array(); 
	       	} else { return false; }
	    }

	}
?>