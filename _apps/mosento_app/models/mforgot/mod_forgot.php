<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_forgot extends CI_Model {

		private $sms;

		function __construct() {
	        parent::__construct();
	        $this->sms = $this->load->database('sendsms', TRUE);
	        $this->load->database();
	    }

	    private static function pregReps($string) { 
            $result = preg_replace('/[^a-zA-Z0-9-_.]/','', $string);
            return $result;
        }

        private static function pregRepn($string) { 
            $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
            return $result;
        }

	    function insert_all($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function edit_data($id, $data){
			$this->db->where('pwdgen_id', $id);
			$this->db->update('password_generator', $data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function save_new_data($nik, $data){
			$this->db->where('nik', $this->pregRepn($nik));
			$this->db->update('mos_user',$data);
			return ($this->db->affected_rows() != 1 ) ? false : true;
		}

		function check_session_passgen($nik){
			$datax = array( 'pwdgen_users' => $this->pregRepn($nik), 'pwdgen_status' => 1 );
			$query = $this->db->select('pwdgen_users, pwdgen_expired, pwdgen_status')
				->from('password_generator')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

	    function check_data($var){
			$query = $this->db->select('nik, email, phone, nama, username')
				->from('mos_user')
				->where($var)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function check_token($token){
			$datax = array('pwdgen_token' => $this->pregReps($token) );
			$query = $this->db->select('pwdgen_id, pwdgen_users, pwdgen_token, pwdgen_date, pwdgen_expired, pwdgen_status')
				->from('password_generator')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function getData_user($nik){
			$query = $this->db->select('nik, nama, email, username, phone, last_ip, register_date, update_date')
				->from('mos_user')
				->where('nik', $nik)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function sendsms($content){
			$this->sms->insert('TSMSSend', $content);
			return ($this->sms->affected_rows() != 1 ) ? false:true;
		}

	}
?>