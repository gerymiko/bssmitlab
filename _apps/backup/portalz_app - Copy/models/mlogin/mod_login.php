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

	    private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

	    function check_login($username, $password){
	    	$password = $this->security->xss_clean($password);
	    	$datax = array( 'users_username' => $this->security->xss_clean($username), 'users_password' => $this->strEncode($password), 'type' => 'PORTAL' );
	    	$query = $this->web1->select('users_id, level_id, bssID, users_fullname, users_username, is_login, users_status, last_ip')
					->from('users')
					->where($datax)
					->or_where('bssID', $this->pregReps($username))
					->limit(1)
					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row_array(); 
	       	} else { return false; }
	    }

	    function update_last_login($users, $data){
	        $this->web1->where('users_id', $users);
	        $this->web1->update('users', $data);
	        return ($this->web1->affected_rows() != 1 ) ? false : true;
	    }


	}
?>