<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_login extends CI_Model{

		function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function strEncode($password) { 
	        return $hasil = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9-_.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

		function check_login($nik, $password){
	    	$datax = array( 'bssID' => $this->pregRepn($nik), 'users_password' => $this->strEncode($password) );
	    	$query = $this->db->select('a.users_id, a.level_id, a.bssID, a.users_fullname, a.users_status')
				->from('WEB_1.dbo.users a')
				->join('HRD.dbo.TKaryawan b', 'a.bssID = b.NIK AND b.AKTIF = 0', 'inner')
				->where($datax)
				->limit(1)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row_array(); 
	       	} else { return false; }
	    }
	}
?>