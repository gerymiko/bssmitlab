<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_tlogin extends CI_Model {

		private $hrd;
		private $web1;

		function __construct() {
	        parent::__construct();
			$this->hrd  = $this->load->database('hrd', TRUE);
			$this->web1 = $this->load->database('web1', TRUE);
	        $this->load->database();
	    }

	    private static function strEncode($password) { 
	        $hasil = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
	        return $hasil;
	    }

	    function check_login($username, $password){
	    	$datax = array( 
	    		'a.users_status' => 1, 
	    		'users_username' => $username, 
	    		'users_password' => $this->strEncode($password),
	    		'type'			 => 'TIKET'
	    	);
	    	$query = $this->web1
					->from('users a')
					->join('users_level b', 'a.level_id = b.level_id', 'inner')
					->join('privileges c', 'a.users_id = c.user_id', 'inner')
					->join('section d', 'c.section_id = d.section_id', 'inner')
					->where($datax)
					->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row_array(); 
	       	} else { return false; }
	    }


	}
?>