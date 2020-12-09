<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class Mod_account extends CI_Model {

		function __construct() {
	        parent::__construct();
	        $this->load->database();
	    }

	    private static function pregReps($string){ 
	        return $result = preg_replace('/[^a-zA-Z0-9- _.,]/','', $string);
	    }

	    private static function pregRepn($number){ 
	        return $result = preg_replace('/[^0-9]/','', $number);
	    }

        private static function strEncode($password) { 
	        return md5(base64_encode(hash("sha256", md5(md5(sha1($password))), TRUE))); 
	    }

	    function insert_data($table, $data) {
	        $this->db->insert($table, $data);
	        return ($this->db->affected_rows() != 1 ) ? false : true;
	    }

	    function edit_data($field, $id, $table, $data){
			$this->db->where($field, $this->pregRepn($id));
			$this->db->update($table, $data);
			return ( $this->db->affected_rows() != 1 ) ? false:true;
		}

	    function detail_serial($id){
	    	$datax = array( 'a.id_user' => $this->pregRepn($id), 'a.status' => 1, 'b.status' => 1 );
	    	$query = $this->db->select('b.id_desa, b.nama_desa, b.serial_number, a.id_user, a.fullname, a.mobile, a.email, a.username')
	    		->from('users a')
	    		->join('serial b', 'a.id_desa = b.id_desa', 'inner')
				->where($datax)
				->get();
			if($query->num_rows() > 0 ){
	            return $query->row(); 
	        } else { return false; }
	    }

	    function check_old_password($id, $password){
	    	$datax = array( 'id_user' => $this->pregRepn($id), 'password' => $this->strEncode($password) );
	    	$query = $this->db->select('password')
				->from('users')
				->where($datax)
				->get();
	    	if($query->num_rows() > 0 ) {
	            return $query->row(); 
	       	} else { return false; }
		}


	}
?>