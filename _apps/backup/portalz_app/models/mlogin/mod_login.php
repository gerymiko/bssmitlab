<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_login extends CI_Model{

		private $web1;

		function __construct(){
	        parent::__construct();
	        $this->web1 = $this->load->database('web1', TRUE);
	        $this->load->database();
	    }

	    private static function strEncode($password){ 
	        return $hasil = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

		function check_login($field, $param, $password){
	    	$password = $this->security->xss_clean($password);
	    	$datax = array( $this->pregReps($field) => $this->security->xss_clean($this->pregReps($param)), 'users_password' => $this->strEncode($password));
	    	$query = $this->web1->select('users_id, level_id, bssID, users_fullname, users_status, users_username')
				->from('users')
				->where($datax)
				->limit(1)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row_array(); 
	       	} else { return false; }
	    }
	}
?>