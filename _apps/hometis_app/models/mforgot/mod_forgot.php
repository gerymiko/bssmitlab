<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_forgot extends CI_Model {

		private $sms;

		function __construct() {
	        parent::__construct();
	        $this->sms = $this->load->database('sms', TRUE);
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9-_.]/','', $string);
        }

        private static function pregRepn($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9]/','', $string);
        }

		function check_session_passgen($nik){
			$datax = array( 'pwdgen_users' => $this->pregRepn($nik), 'pwdgen_status' => 1 );
			$query = $this->db->select('pwdgen_users, pwdgen_expired, pwdgen_status')
				->from('password_generator')
				->where($datax)
				->order_by('pwdgen_date DESC')
				->limit(1)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	       	} else { return false; }
		}

	    function check_data($var){
			$query = $this->db->select('id, NIK, email, mobile, fullname, username')
				->from('mst_user')
				->where($var)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	       	} else { return false; }
		}

		function check_token($token){
			$datax = array( 'pwdgen_token' => $this->pregReps($token) );
			$query = $this->db->select('pwdgen_id, pwdgen_users, pwdgen_token, pwdgen_date, pwdgen_expired, pwdgen_status')
				->from('password_generator')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row();
	       	} else { return false; }
		}

		function get_detail_new_user($nik){
	    	$datax = array('NIK' => $this->pregRepn($nik));
			$query = $this->db->select('id, NIK, email, username, mobile, insert_time')
				->from('mst_user')
				->where($datax)
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