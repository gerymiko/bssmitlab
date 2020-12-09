<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_profile extends CI_Model {

	    function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.@]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

        private static function strEncode($password) { 
            return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
        }

	    function getData_user($nik){
	    	$datax = array('a.bssID' => $this->pregRepn($nik));
			$query = $this->db->select('a.users_id, a.level_id, a.bssID, a.users_fullname, c.Nama as jabatan, a.users_email, a.users_mobile')
				->from('WEB_1.dbo.users a')
				->join('HRD.dbo.TKaryawan b', 'a.bssID = b.NIK', 'inner')
				->join('HRD.dbo.tjabatan c', 'b.KodeJB = c.KodeJB', 'inner')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function get_user_data($nik){
			$datax = array('a.bssID' => $this->pregRepn($nik));
			$query = $this->db->select('a.users_id, a.level_id, a.bssID, a.users_fullname, c.Nama as jabatan, b.KodeST, a.users_email, a.users_mobile')
				->from('WEB_1.dbo.users a')
				->join('HRD.dbo.TKaryawan b', 'a.bssID = b.NIK', 'inner')
				->join('HRD.dbo.tjabatan c', 'b.KodeJB = c.KodeJB', 'inner')
				->where($datax)
				->get()
				->result();
			return $query;
		}

		function get_old_password($nik, $old_pass){
			$datax = array('bssID' => $this->pregReps($nik), 'users_password' => $this->strEncode($this->pregReps($old_pass)));
			$query = $this->db->select('users_id')
				->from('WEB_1.dbo.users')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

		function get_detail_new_user($nik){
	    	$datax = array('bssID' => $this->pregRepn($nik));
			$query = $this->db->select('users_id, bssID, users_email, users_username, users_mobile, users_fullname, date_create')
				->from('WEB_1.dbo.users')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}

	}
?>