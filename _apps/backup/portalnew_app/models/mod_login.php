<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_login extends CI_Model {

		private $web1;

		var $table2 = 'users';

	    function __construct() {
	        parent::__construct();
	        $this->web1 = $this->load->database('ext3', TRUE);
	        $this->load->database();
	    }

	    //LOGIN

	    private static function strEncode($password) { 
	        $hasil = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
	        return $hasil;
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
            return $result;
        }

        private static function pregRepn($number) { 
            $result = preg_replace('/[^0-9]/','', $number);
            return $result;
        }

	    function checkLogin($username,$password) {
	    	$this->web1->select('users_id, level_id, bssID, users_fullname, users_email, users_mobile, users_username, date_login, last_login, is_login, users_status, last_ip');
	        $this->web1->where('users_username', $username);
	        $this->web1->or_where('bssID', $this->pregRepn($username));
	        $this->web1->where('users_password', $this->strEncode($password));
	        $query = $this->web1->get($this->table2, 1);
	        if ($query->num_rows() == 1) :
	            return $query->row_array();
	        else : return false; 
	        endif;
	    }

	    function isLogin($user,$data) {
	        $this->web1->where('users_id', $user);
	        $this->web1->update($this->table2, $data);
	    }

	    function updateLastLogin($username,$data) {
	        $this->web1->where('users_username', $username);
	        $this->web1->update($this->table2, $data);
	    }

	    function insertLogs($datos){
	    	$this->web1->insert('web_logs', $datos);
			return ($this->web1->affected_rows() != 1 ) ? false:true;
	    }
	}
?>