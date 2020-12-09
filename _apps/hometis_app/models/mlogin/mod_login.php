<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_login extends CI_Model{

		function __construct(){
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function strEncode($password){ 
	        return $result = md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE)));
	    }

	    private static function pregReps($string){ 
            return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
        }

        private static function pregRepn($number){ 
            return $result = preg_replace('/[^0-9]/','', $number);
        }

	    function check_login($username, $password){
	    	$password = $this->security->xss_clean($password);
	    	$datax = array( 'a.username' => $this->security->xss_clean($username), 'a.password' => $this->strEncode($password) );
	    	$query = $this->db->select('b.id_user, a.fullname, a.status_active as status_account, a.NIK, a.mobile, b.id_module, b.site, b.status_active as status_akses_module, c.name as module_name, c.description as module_desc, c.status_active as status_module, d.id as id_system, d.name as system_name, d.description as system_desc, e.id_level, e.level_name')
	    			->from('mst_user a')
	    			->join('mst_user_module b', 'a.id = b.id_user AND b.status_active = 1', 'inner')
	    			->join('mst_system_module c', 'b.id_module = c.id AND AND c.status_active = 1 AND c.isDelete = 0')
	    			->join('mst_system d', 'c.id_system = d.id AND d.status_active = 1')
	    			->join('mst_user_level e', 'a.id_level = e.id_level AND e.level_status = 1', 'inner')
					->where($datax)
					->get();
	    	if($query->num_rows() > 0 ){
	            return $query->row_array(); 
	       	} else { return false; }
	    }


	}
?>