<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_login extends CI_Model{

		function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function strEncode($password) { 
            return $result = md5(md5(md5(sha1($password))));
	    }

	    private static function pregReps($string) { 
	        return $result = preg_replace('/[^a-zA-Z0-9-_.]/','', $string);
	    }

	    private static function pregRepn($number) { 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

		function check_login($nik, $password, $site){
	    	$datax = array( 'a.nik' => $this->pregRepn($nik), 'a.password' => $this->strEncode($password), 'd.site' => $this->pregReps($site), 'd.id_module' => 1 );
	    	$query = $this->db->select('a.id_user, a.idx, a.nik, a.fullname, a.status_active, c.id_level, d.site')
				->from('master_user a')
				->join('master_level_dtl b', 'a.idx = b.idx AND b.status_active = 1', 'inner')
				->join('master_level_hdr c', 'b.id_level = c.id_level AND c.status_active = 1', 'inner')
				->join('master_user_module d', 'a.id_user = d.id_user AND d.status_active = 1', 'inner')
				->join('master_site e', 'd.site = e.code AND e.status_active = 1', 'inner')
				->where($datax)
				->limit(1)
				->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row_array(); 
	       	} else { return false; }
	    }
	}
?>